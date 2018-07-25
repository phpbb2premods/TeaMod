<?php
/***************************************************************************
 *							class_auth.php
 *							--------------
 *	begin		: 26/08/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.6 - 04/12/2004
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

//
// this is a limited version of auth class
//
class auth_class
{
	var $data;
	var $keys;

	function read($force=false)
	{
		global $db;

		$sql = 'SELECT *
					FROM ' . AUTHS_DEF_TABLE . '
					ORDER BY auth_type, auth_order';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$this->data = array();
		$this->keys = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$this->data[ $row['auth_id'] ] = $row;
			if ( empty($this->keys[ $row['auth_type'] ]) )
			{
				$this->keys[ $row['auth_type'] ] = array();
			}
			$this->keys[ $row['auth_type'] ][ $row['auth_name'] ] = $row['auth_id'];
		}
	}

	function renum()
	{
		global $db;

		// re-read
		$sql = 'SELECT *
					FROM ' . AUTHS_DEF_TABLE . '
					ORDER BY auth_type, auth_order';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$this->data = array();
		$this->keys = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$this->data[ $row['auth_id'] ] = $row;
			if ( empty($this->keys[ $row['auth_type'] ]) )
			{
				$this->keys[ $row['auth_type'] ] = array();
			}
			$this->keys[ $row['auth_type'] ][ $row['auth_name'] ] = $row['auth_id'];
		}

		// renum all
		if ( !empty($this->keys) )
		{
			foreach ( $this->keys as $auth_type => $auth_names )
			{
				$order = 0;
				if ( !empty($auth_names) )
				{
					foreach ( $auth_names as $auth_name => $auth_id )
					{
						$order += 10;
						$sql = 'UPDATE ' . AUTHS_DEF_TABLE . '
									SET auth_order = ' . intval($order) . '
									WHERE auth_id = ' . intval($auth_id);
						$db->sql_query($sql, false, __LINE__, __FILE__);
					}
				}
			}
		}

		// regenerate the cache if any
		$this->read(true);
	}

	function get(&$view_user, $types, &$cache, &$cache_time)
	{
		// init return
		$auth_caches = array();

		// get only auths caches to process
		$count_types = count($types);
		for ( $i = 0; $i < $count_types; $i++ )
		{
			// auth are coded on 1 char, other cache names are longer (ie fjbox)
			if ( strlen($types[$i]) == 1 )
			{
				$auth_caches[] = $types[$i];
			}
			// raz other caches
			else
			{
				$cache[ $types[$i] ] = array();
				$cache_time[ $types[$i] ] = 0;
			}
		}

		// process auths caches
		if ( !empty($auth_caches) )
		{
			$this->get_auths($view_user, $auth_caches, $cache, $cache_time);
		}
		return $auth_caches;
	}

	function get_auths(&$view_user, $types, &$cache, &$cache_time)
	{
		global $db;

		// time marker
		$now = time();

		// get groups the user belongs too ($group_user_list can't be empty)
		$group_user_list = $view_user->get_groups_list();

		// read auths
		$sql = 'SELECT obj_type, obj_id, auth_name, MAX(auth_value) AS auth_solved
					FROM ' . AUTHS_TABLE . '
					WHERE group_id IN(' . implode(', ', $group_user_list) . ')
						AND obj_type IN(\'' . implode('\', \'', $types) . '\')
					GROUP BY obj_type, obj_id, auth_name';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$auth_defs = array();
		$auth_vals = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( $row['auth_solved'] > 0 )
			{
				$obj_type = $row['obj_type'];
				$obj_id = intval($row['obj_id']);
				$auth_name = $row['auth_name'];

				// main init
				if ( !isset($auth_defs[$obj_type]) )
				{
					$auth_defs[$obj_type] = array();
					$auth_vals[$obj_type] = array();
				}

				// add auth defs if required
				if ( !isset($auth_defs[$obj_type][$auth_name]) )
				{
					$auth_defs[$obj_type][$auth_name] = count($auth_defs[$obj_type]);
				}
				$auth_id = intval($auth_defs[$obj_type][$auth_name]);

				// init obj auths
				if ( !isset($auth_vals[$obj_type][$obj_id]) )
				{
					$auth_vals[$obj_type][$obj_id] = array();
				}

				// store auth value
				$auth_vals[$obj_type][$obj_id][$auth_id] = $row['auth_solved'];
			}
		}
		$db->sql_freeresult($result);

		// force root forum to be viewed and readed
		if ( in_array(POST_FORUM_URL, $types) )
		{
			if ( !isset($auth_defs[POST_FORUM_URL]) )
			{
				$auth_defs[POST_FORUM_URL] = array();
				$auth_vals[POST_FORUM_URL] = array();
			}
			if ( !isset($auth_values[POST_FORUM_URL][0]) )
			{
				$auth_values[POST_FORUM_URL][0] = array();
			}

			// view
			if ( !isset($auth_defs[POST_FORUM_URL]['auth_view']) )
			{
				$auth_defs[POST_FORUM_URL]['auth_view'] = count($auth_defs[POST_FORUM_URL]);
			}
			$auth_id = intval($auth_defs[POST_FORUM_URL]['auth_view']);
			$auth_vals[POST_FORUM_URL][0][$auth_id] = true;

			// read
			if ( !isset($auth_defs[POST_FORUM_URL]['auth_read']) )
			{
				$auth_defs[POST_FORUM_URL]['auth_read'] = count($auth_defs[POST_FORUM_URL]);
			}
			$auth_id = intval($auth_defs[POST_FORUM_URL]['auth_read']);
			$auth_vals[POST_FORUM_URL][0][$auth_id] = true;
		}

		// fill the caches
		$count_types = count($types);
		for ( $i = 0; $i < $count_types; $i++ )
		{
			$cache_time[ $types[$i] ] = $now;
			$cache[ $types[$i] ] = empty($auth_defs[ $types[$i] ]) ? array() : array('def' => $auth_defs[ $types[$i] ], 'val' => $auth_vals[ $types[$i] ]);
		}
	}
}

?>