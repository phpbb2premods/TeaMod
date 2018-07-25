<?php
/***************************************************************************
 *							class_topics_recent.php
 *							-----------------------
 *	begin		: 11/09/2005
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.1 - 11/09/2005
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

class topics_recent extends topics
{
	function read($forum_id=0, $exclude_current=true)
	{
		global $db, $user, $config, $forums;

		// forum id
		$this->forum_id = isset($forums->data[ intval($forum_id) ]) ? intval($forum_id) : 0;

		// number of topics to display
		$ppage = intval($config->data['total_recent']) ? intval($config->data['total_recent']) : 5;

		// get authed forums
		$min_id = $this->forum_id;
		$max_id = $forums->data[$min_id]['last_child_id'];

		// get excluded forums
		$tkeys = array_flip($forums->keys);
		$min_idx = $tkeys[$min_id];
		$max_idx = $tkeys[$max_id];
		unset($tkeys);
		$exclude_forums = array();
		$something = false;
		for ( $i = $min_idx; $i <= $max_idx; $i++ )
		{
			if ( !$user->auth(POST_FORUM_URL, 'auth_read', $forums->keys[$i]) || (($i == $min_idx) && $exclude_current) )
			{
				$exclude_forums[] = $forums->keys[$i];
			}
			else
			{
				$something = true;
			}
		}

		// halt on no forum authed
		if ( !$something )
		{
			return false;
		}

		// set branch range
		$auth_sql = '(f.forum_order BETWEEN ' . intval($forums->data[$min_id]['forum_order']) . ' AND ' . intval($forums->data[$max_id]['forum_order']) . ')';

		// exclude unreadable forums
		if ( !empty($exclude_forums) )
		{
			$auth_sql .= count($exclude_forums) > 1 ? ' AND f.forum_id NOT IN(' . implode(', ', $exclude_forums) . ')' : ' AND f.forum_id <> ' . $exclude_forums[0];
			unset($exclude_forums);
		}

		// read topics
		$sql = 'SELECT t.*
					FROM ' . TOPICS_TABLE . ' t, ' . FORUMS_TABLE . ' f
					WHERE f.forum_id = t.forum_id
						AND ' . $auth_sql . '
					ORDER BY t.topic_last_time DESC
					LIMIT ' . $ppage;

		// read results
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		if ( $this->total_topics = $db->sql_numrows($result) )
		{
			// get cookie data
			$user->read_cookies();
		}
		$this->pre_process();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$this->row_process($row);
			$this->data_ext[ $row['topic_id'] ] = $row;
		}
		$db->sql_freeresult($result);

		// get complementary data
		$this->post_process();
	}
}

?>