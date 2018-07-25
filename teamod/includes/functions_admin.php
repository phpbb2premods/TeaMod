<?php
//-- mod : categories hierarchy ------------------------------------------------
//-- mod : attachmod -----------------------------------------------------------
/***************************************************************************
 *                            functions_admin.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: functions_admin.php,v 1.5.2.5 2005/09/14 19:16:21 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

//
// Simple version of jumpbox, just lists authed forums
//
function make_forum_select($box_name, $ignore_forum = false, $select_forum = '')
{
//-- mod : categories hierarchy ------------------------------------------------
//-- delete
/*
	global $db, $userdata;

	$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$sql = 'SELECT f.forum_id, f.forum_name
		FROM ' . CATEGORIES_TABLE . ' c, ' . FORUMS_TABLE . ' f
		WHERE f.cat_id = c.cat_id 
		ORDER BY c.cat_order, f.forum_order';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Couldn not obtain forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_list = '';
	while( $row = $db->sql_fetchrow($result) )
	{
		if ( $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] )
		{
			$selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
			$forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>' . $row['forum_name'] . '</option>';
		}
	}

	$forum_list = ( $forum_list == '' ) ? '<option value="-1">-- ! No Forums ! --</option>' : '<select name="' . $box_name . '">' . $forum_list . '</select>';
*/
//-- add
	global $config, $forums, $user;

	$front_pic = $forums->get_front_pic();
	if ( !empty($front_pic) )
	{
		$forum_list = '';
		foreach ( $front_pic as $cur_id => $front )
		{
			$selected = !empty($select_forum) && ($select_forum == $cur_id) ? ' selected="selected"' : '';
			$forum_list .= '<option value="' . (($cur_id >= 0) ? $cur_id : -1) . '"' . $selected . '>';
			$count_front = strlen($front);
			for ( $i = 0; $i < $count_front; $i++ )
			{
				$forum_list .= $user->lang('tree_pic_' . $front[$i]);
			}
			if ( $cur_id >= 0 )
			{
				$forum_list .= $user->lang($forums->data[$cur_id]['forum_name']);
			}
			$forum_list .= '</option>';
		}
	}
	else
	{
		$forum_list = '<option value="-1">' . $user->lang('None') . '</option>';
	}
	$forum_list = '<select name="' . $box_name . '">' . $forum_list . '</select>';
//-- fin mod : categories hierarchy --------------------------------------------

	return $forum_list;
}

//
// Synchronise functions for forums/topics
//
//-- mod : categories hierarchy ------------------------------------------------
// here we added
//	, $differ=false
//-- modify
function sync($type, $id = false, $differ=false)
//-- fin mod : categories hierarchy --------------------------------------------
{
	global $db;

	switch($type)
	{
		case 'all forums':
			$sql = "SELECT forum_id
				FROM " . FORUMS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get forum IDs', '', __LINE__, __FILE__, $sql);
			}

			while( $row = $db->sql_fetchrow($result) )
			{
				sync('forum', $row['forum_id']);
			}
		   	break;

		case 'all topics':
			$sql = "SELECT topic_id
				FROM " . TOPICS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
			}

			while( $row = $db->sql_fetchrow($result) )
			{
				sync('topic', $row['topic_id']);
			}
			break;

	  	case 'forum':
//-- mod : categories hierarchy ------------------------------------------------
//-- delete
/*
			$sql = "SELECT MAX(post_id) AS last_post, COUNT(post_id) AS total 
				FROM " . POSTS_TABLE . "  
				WHERE forum_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				$last_post = ( $row['last_post'] ) ? $row['last_post'] : 0;
				$total_posts = ($row['total']) ? $row['total'] : 0;
			}
			else
			{
				$last_post = 0;
				$total_posts = 0;
			}

			$sql = "SELECT COUNT(topic_id) AS total
				FROM " . TOPICS_TABLE . "
				WHERE forum_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic count', '', __LINE__, __FILE__, $sql);
			}

			$total_topics = ( $row = $db->sql_fetchrow($result) ) ? ( ( $row['total'] ) ? $row['total'] : 0 ) : 0;

			$sql = "UPDATE " . FORUMS_TABLE . "
				SET forum_last_post_id = $last_post, forum_posts = $total_posts, forum_topics = $total_topics
				WHERE forum_id = $id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update forum', '', __LINE__, __FILE__, $sql);
			}
*/
//-- add
			if ( empty($id) )
			{
				global $config;

				// count topics
				$sql = 'SELECT COUNT(topic_id) AS total_topics
							FROM ' . TOPICS_TABLE;
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				$row = $db->sql_fetchrow($result);
				$total_topics = intval($row['total_topics']);

				// count posts
				$sql = 'SELECT COUNT(post_id) AS total_posts
							FROM ' . POSTS_TABLE;
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				$row = $db->sql_fetchrow($result);
				$total_posts = intval($row['total_posts']);

				$config->set('stat_total_topics', $total_topics);
				$config->set('stat_total_posts', $total_posts);
			}
			else
			{
				// count topics
				$sql = 'SELECT COUNT(topic_id) AS total_topics
							FROM ' . TOPICS_TABLE . '
							WHERE forum_id = ' . $id;
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				$row = $db->sql_fetchrow($result);
				$total_topics = intval($row['total_topics']);

				// count posts
				$sql = 'SELECT COUNT(post_id) AS total_posts
							FROM ' . POSTS_TABLE . '
							WHERE forum_id = ' . $id;
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				$row = $db->sql_fetchrow($result);
				$total_posts = intval($row['total_posts']);

				// get last post
				$sql = 'SELECT t.topic_last_post_id, t.topic_title, t.topic_last_poster, t.topic_last_username, t.topic_last_time, u.username
							FROM ' . TOPICS_TABLE . ' t
								LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = t.topic_last_poster
							WHERE forum_id = ' . $id . '
								AND topic_moved_id = 0
							ORDER BY topic_last_post_id DESC
							LIMIT 1';
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				$row = $db->sql_fetchrow($result);
				$fields = array(
					'forum_topics' => $total_topics,
					'forum_posts' => $total_posts,
					'forum_last_post_id' => intval($row['topic_last_post_id']),
					'forum_last_title' => $row['topic_title'],
					'forum_last_poster' => intval($row['topic_last_poster']),
					'forum_last_username' => (($row['topic_last_poster'] != ANONYMOUS) && !empty($row['username'])) ? $row['username'] : $row['topic_last_username'],
					'forum_last_time' => intval($row['topic_last_time']),
				);
				$db->sql_statement($fields);
				$sql = 'UPDATE ' . FORUMS_TABLE . '
							SET ' . $db->sql_update . '
							WHERE forum_id = ' . $id;
				$db->sql_query($sql, false, __LINE__, __FILE__);
				if ( !$differ )
				{
					sync('forum');
				}
			}
//-- fin mod : categories hierarchy --------------------------------------------
			break;

		case 'topic':
//-- mod : attachmod -----------------------------------------------------------
//-- add
			if ( defined('CH_mod_attachmod') )
			{
				attachment_sync_topic($id);
			}
//-- fin mod : attachmod -------------------------------------------------------
//-- mod : categories hierarchy ------------------------------------------------
//-- delete
/*
			$sql = "SELECT MAX(post_id) AS last_post, MIN(post_id) AS first_post, COUNT(post_id) AS total_posts
				FROM " . POSTS_TABLE . "
				WHERE topic_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				if ($row['total_posts'])
				{
					// Correct the details of this topic
					$sql = 'UPDATE ' . TOPICS_TABLE . ' 
						SET topic_replies = ' . ($row['total_posts'] - 1) . ', topic_first_post_id = ' . $row['first_post'] . ', topic_last_post_id = ' . $row['last_post'] . "
						WHERE topic_id = $id";

					if (!$db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not update topic', '', __LINE__, __FILE__, $sql);
					}
				}
				else
				{
					// There are no replies to this topic
					// Check if it is a move stub
					$sql = 'SELECT topic_moved_id 
						FROM ' . TOPICS_TABLE . " 
						WHERE topic_id = $id";

					if (!($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
					}

					if ($row = $db->sql_fetchrow($result))
					{
						if (!$row['topic_moved_id'])
						{
							$sql = 'DELETE FROM ' . TOPICS_TABLE . " WHERE topic_id = $id";
			
							if (!$db->sql_query($sql))
							{
								message_die(GENERAL_ERROR, 'Could not remove topic', '', __LINE__, __FILE__, $sql);
							}
						}
					}

					$db->sql_freeresult($result);
				}
			}
*/
//-- add
			// prepare return : we don't touch first post data until a first post exists because of shadow topics
			$fields = array(
				'topic_replies' => 0,
				'topic_first_post_id' => 0,
				'topic_last_post_id' => 0,
				'topic_last_poster' => 0,
				'topic_last_username' => '',
				'topic_last_time' => 0,
			);
			// read topic counts
			$sql = 'SELECT MAX(post_id) AS topic_last_post_id, MIN(post_id) AS topic_first_post_id, COUNT(post_id) AS topic_replies
						FROM ' . POSTS_TABLE . '
						WHERE topic_id = ' . intval($id);
			$result = $db->sql_query($sql, false, __LINE__, __FILE__);
			if ( $row = $db->sql_fetchrow($result) )
			{
				$fields = array_merge($fields, $row);
				if ( !empty($fields['topic_replies']) )
				{
					$fields['topic_replies']--;
				}
				else
				{
					// remove shadow topics
					$sql = 'DELETE FROM ' . TOPICS_TABLE . '
								WHERE topic_id = ' . intval($id) . '
									AND topic_moved_id <> 0';
					$db->sql_query($sql, false, __LINE__, __FILE__);
					return;
				}
			}

			// read topic first & last post
			if ( !empty($fields['topic_last_post_id']) || !empty($fields['topic_first_post_id']) )
			{
				$sql = 'SELECT post_id, poster_id, post_username, post_time
							FROM ' . POSTS_TABLE . '
							WHERE topic_id = ' . intval($id) . '
								AND post_id IN(' . intval($fields['topic_first_post_id']) . ', ' . intval($fields['topic_last_post_id']) . ')';
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				while ( $row = $db->sql_fetchrow($result) )
				{
					if ( $row['post_id'] == intval($fields['topic_last_post_id']) )
					{
						$fields = array_merge($fields, array(
							'topic_last_poster' => $row['poster_id'],
							'topic_last_username' => $row['post_username'],
							'topic_last_time' => $row['post_time'],
						));
					}
					if ( $row['post_id'] == intval($fields['topic_first_post_id']) )
					{
						$fields = array_merge($fields, array(
							'topic_poster' => $row['poster_id'],
							'topic_first_username' => $row['post_username'],
							'topic_time' => $row['post_time'],
						));
					}
				}
			}
			$db->sql_statement($fields);
			$sql = 'UPDATE ' . TOPICS_TABLE . '
						SET ' . $db->sql_update . '
						WHERE topic_id = ' . intval($id);
			$db->sql_query($sql, false, __LINE__, __FILE__);
//-- fin mod : categories hierarchy --------------------------------------------
			break;
	}
	
	return true;
}

?>