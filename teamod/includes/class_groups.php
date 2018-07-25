<?php
/***************************************************************************
 *							class_groups.php
 *							----------------
 *	begin		: 05/09/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.6 - 21/08/2005
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

// special groups
$special_groups = array(
	GROUP_OWN => array('group_status' => GROUP_SPECIAL, 'group_name' => 'Group_own', 'group_description' => 'Group_own_desc', 'group_single_user' => true),
);

// group class
class groups
{
	var $data;
	var $root_id;

	function groups()
	{
		$this->data = array();
		$this->root_id = NO_GROUP;
	}

	// here we expect $groups[$group_id] = something
	function read(&$groups)
	{
		global $db;
		global $special_groups;

		$this->data = array();
		if ( empty($groups) )
		{
			return;
		}

		$w_groups = array();
		foreach ( $groups as $group_id => $group_data )
		{
			$w_groups[ intval($group_id) ] = $group_data;
		}
		$groups = $w_groups;

		// read special groups
		foreach ( $special_groups as $group_id => $group_data )
		{
			if ( isset($groups[ intval($group_id) ]) )
			{
				$this->data[ intval($group_id) ] = $group_data;
			}
		}

		// read other groups
		$sql = 'SELECT g.group_id, g.group_status, g.group_name, g.group_description, g.group_single_user, u.user_id, u.username, u.user_level
					FROM ' . GROUPS_TABLE . ' g
						LEFT JOIN ' . USERS_TABLE . ' u
							ON u.user_id = g.group_user_id
					WHERE g.group_id IN(' . implode(', ', array_keys($groups)) . ')
					ORDER BY g.group_status DESC, u.username, g.group_name';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		while ( $row = $db->sql_fetchrow($result) )
		{
			$fields = array(
				'group_status' => $row['group_status'],
				'group_name' => $row['group_name'],
				'group_description' => $row['group_description'],
			);
			if ( $row['group_single_user'] && !empty($row['user_id']) )
			{
				$fields += array(
					'group_single_user' => true,
					'user_id' => intval($row['user_id']),
					'username' => $row['username'],
					'user_level' => $row['user_level'],
				);
			}
			else
			{
				$fields += array(
					'group_single_user' => false,
				);
			}
			$this->data[ intval($row['group_id']) ] = $fields;
		}
	}

	function clear_cache($cache_id)
	{
		global $db;
		global $special_groups;

		$all = isset($this->data[GROUP_REGISTERED]);
		if ( !$all && !empty($special_groups) )
		{
			foreach ( $special_groups as $group_id => $group_data )
			{
				if ( $all = isset($this->data[$group_id]) )
				{
					break;
				}
			}
		}

		// registered and special groups cover everybody
		if ( $all )
		{
			$sql = 'DELETE FROM ' . USERS_CACHE_TABLE . '
						WHERE cache_id = \'' . $cache_id . '\'';
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
		else
		{
			// select other groups users
			if ( !empty($this->data) )
			{
				$sql = 'SELECT user_id
							FROM ' . USER_GROUP_TABLE . '
							WHERE group_id IN(' . implode(', ', array_keys($this->data)) . ')
								AND user_pending <> ' . true;
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				while ( $row = $db->sql_fetchrow($result) )
				{
					$user_ids[ intval($row['user_id']) ] = true;
				}
			}

			// delete users caches
			if ( !empty($user_ids) )
			{
				$sql = 'DELETE FROM ' . USERS_CACHE_TABLE . '
							WHERE cache_id LIKE \'' . $cache_id . '%\'
								AND user_id IN(' . implode(', ', array_keys($user_ids)) . ')';
				$db->sql_query($sql, false, __LINE__, __FILE__);
			}
		}
	}

	function resync_users_list($sys_groups=array())
	{
		global $db;

		if ( empty($sys_groups) )
		{
			$sys_groups = array(
				'GROUP_FOUNDER' => GROUP_FOUNDER,
				'GROUP_ADMIN' => GROUP_ADMIN,
				'GROUP_REGISTERED' => GROUP_REGISTERED,
				'GROUP_ANONYMOUS' => GROUP_ANONYMOUS,
			);
		}

		// is there remaining unsynchronized groups ?
		$sql = 'SELECT group_id
					FROM ' . GROUPS_TABLE . '
					WHERE group_single_user = ' . true . '
						AND group_user_id = 0
					LIMIT 1';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		if ( !$row = $db->sql_fetchrow($result) )
		{
			// no remaining unsynchronized group : prepare to synchronize all
			$fields = array(
				'group_user_id' => 0,
				'group_user_list' => '',
			);
			$db->sql_statement($fields);
			$sql = 'UPDATE ' . GROUPS_TABLE . '
						SET ' . $db->sql_update . '
						WHERE group_single_user = ' . true;
			$db->sql_query($sql, false, __LINE__, __FILE__);			
		}

		// get all groups membership for individual group not yet updated
		$sql = 'SELECT ig.group_id AS user_group_id, iug.user_id, ug.group_id
					FROM ' . GROUPS_TABLE . ' ig, ' . USER_GROUP_TABLE . ' iug, ' . USER_GROUP_TABLE . ' ug
					WHERE ig.group_single_user = ' . true . '
						AND ig.group_user_id = 0
						AND iug.group_id = ig.group_id
						AND ug.user_id = iug.user_id
						AND ug.user_pending <> ' . true . '
					ORDER BY iug.user_id, ug.group_id';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$prev = array();
		$first = true;
		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( empty($prev) || ($prev['user_id'] != intval($row['user_id'])) )
			{
				// update
				$this->resync_user_list($prev, $sys_groups);

				// reset
				$prev = array(
					'group_id' => intval($row['user_group_id']),
					'user_id' => intval($row['user_id']),
					'group_user_list' => array(),
				);
			}
			$prev['group_user_list'][ intval($row['group_id']) ] = true;
		}

		// update last one
		$this->resync_user_list($prev, $sys_groups);

		// delete unlinked individual groups
		$sql = 'DELETE FROM ' . GROUPS_TABLE . '
					WHERE group_single_user = ' . true . '
						AND group_user_id = 0';
		$db->sql_query($sql, false, __LINE__, __FILE__);
	}

	function resync_user_list($data, $sys_groups=array())
	{
		global $db;

		if ( empty($data) )
		{
			return;
		}
		if ( empty($sys_groups) )
		{
			$sys_groups = array(
				'GROUP_FOUNDER' => GROUP_FOUNDER,
				'GROUP_ADMIN' => GROUP_ADMIN,
				'GROUP_REGISTERED' => GROUP_REGISTERED,
				'GROUP_ANONYMOUS' => GROUP_ANONYMOUS,
			);
		}

		// process
		if ( $data['user_id'] == ANONYMOUS )
		{
			$data['group_user_list'][ intval($sys_groups['GROUP_ANONYMOUS']) ] = true;
		}
		else
		{
			$data['group_user_list'][ intval($sys_groups['GROUP_REGISTERED']) ] = true;
		}
		if ( !empty($data['group_user_list']) )
		{
			ksort($data['group_user_list']);
		}

		// update the group row
		$fields = array(
			'group_user_id' => intval($data['user_id']),
			'group_user_list' => empty($data['group_user_list']) ? '' : ',' . implode(',', array_keys($data['group_user_list'])) . ',',
		);
		$db->sql_statement($fields);
		$sql = 'UPDATE ' . GROUPS_TABLE . '
					SET ' . $db->sql_update . '
					WHERE group_id = ' . intval($data['group_id']);
		$db->sql_query($sql, false, __LINE__, __FILE__);
	}
}

?>