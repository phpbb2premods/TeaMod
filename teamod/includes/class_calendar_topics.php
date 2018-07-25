<?php

/***************************************************************************
 *							class_calendar_topics.php
 *							-------------------------
 *	begin		: 12/02/2005
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.7 - 19/10/2005
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

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

include_once($config->url('includes/functions_post'));
include_once($config->url('includes/bbcode'));
include_once($config->url('includes/class_topics'));

class calendar_event_topics extends calendar_event
{
	var $topic_title_length;
	var $topic_text_length;
	var $front_title;
	var $forum_id;

	var $calendar_event_queue;

	function calendar_event_topics(&$calendar_event_queue)
	{
		global $config;

		parent::calendar_event($calendar_event_queue);

		$this->topic_title_length = empty($config->data['calendar_title_length']) ? 30 : intval($config->data['calendar_title_length']);
		$this->topic_text_length = empty($config->data['calendar_text_length']) ? 200 : intval($config->data['calendar_text_length']);
		$this->front_title = new front_title();
		$this->user_data = array();
	}

	function read($start_date, $end_date, $with_text=true, $forum_id=0)
	{
		global $db, $config, $user, $forums;

		$this->calendar_event_queue->queue[POST_TOPIC_URL] = &$this;
		$this->forum_id = intval($forum_id);

		// read forums and auths relative to
		if ( empty($forums) )
		{
			include_once($config->url('includes/class_forums'));
			$forums = new forums();
			$forums->read();
		}
		if ( !isset($user->cache[POST_FORUM_URL]) )
		{
			$user->get_cache(POST_FORUM_URL);
		}

		// get the list of authorized forums
		$auth_sql = '';

		// check forum id
		if ( !isset($forums->data[$forum_id]) || !$user->auth(POST_FORUM_URL, 'auth_read', $forum_id) )
		{
			return;
		}

		// get min and max forum ids for the branch asked
		$min_id = intval($forum_id);
		$max_id = $forums->data[$forum_id]['last_child_id'];

		// get excluded forums
		$tkeys = array_flip($forums->keys);
		$min_idx = $tkeys[$min_id];
		$max_idx = $tkeys[$max_id];
		unset($tkeys);
		$exclude_forums = array();
		$something = false;
		for ( $i = $min_idx; $i <= $max_idx; $i++ )
		{
			if ( !$user->auth(POST_FORUM_URL, 'auth_read', $forums->keys[$i]) )
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
			return;
		}

		// set branch range
		$auth_sql = empty($forum_id) ? '' : sprintf(' AND (f.forum_order BETWEEN %d AND %d)', intval($forums->data[$min_id]['forum_order']), intval($forums->data[$max_id]['forum_order']));

		// exclude unreadable forums
		if ( !empty($exclude_forums) )
		{
			$auth_sql .= count($exclude_forums) > 1 ? ' AND t.forum_id NOT IN(' . implode(', ', $exclude_forums) . ')' : ' AND t.forum_id <> ' . $exclude_forums[0];
			unset($exclude_forums);
		}

		// add the forums table if required
		$fields = array(
			't.*',
		);
		$sql_tables = empty($forum_id) ? '' : ', ' . FORUMS_TABLE . ' f';
		$sql_where = empty($forum_id) ? $auth_sql : ' AND f.forum_id = t.forum_id' . $auth_sql;
		if ( $with_text )
		{
			$fields = array_merge($fields, array(
				'p.enable_bbcode',
				'p.enable_html',
				'p.enable_smilies',
				'pt.post_text',
				'pt.bbcode_uid',
			));
			$sql_tables .= ', ' . POSTS_TABLE . ' p, ' . POSTS_TEXT_TABLE . ' pt';
			$sql_where .= ' AND p.post_id = t.topic_first_post_id AND pt.post_id = t.topic_first_post_id';
		}
		$sql = 'SELECT ' . implode(', ', $fields) . '
					FROM ' . TOPICS_TABLE . ' t' . $sql_tables . '
					WHERE t.topic_calendar_time <> 0
						AND t.topic_status <> ' . TOPIC_MOVED . '
						AND t.topic_calendar_time < ' . $user->cvt_user_to_sys_date(intval($end_date)) . '
						AND (t.topic_calendar_time + t.topic_calendar_duration) >= ' . $user->cvt_user_to_sys_date(intval($start_date)) . $sql_where . '
					ORDER BY t.topic_calendar_time, t.topic_calendar_duration DESC, t.topic_type DESC, t.topic_last_post_id DESC';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);

		// read data
		$user_ids = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			// if required, prepare the overview window
			if ( $with_text && !empty($row['post_text']) && !empty($this->topic_text_length) )
			{
				$message = $row['post_text'];

				// remove html escape
				$message = unprepare_message($message);
				$message = str_replace('<br />', "\n", $message);

				// remove bbcode uid
				if ( !empty($row['bbcode_uid']) )
				{
					$message = preg_replace('/\:(([a-z0-9]:)?)' . $row['bbcode_uid'] . '/s', '', $message);

					// replace img with url
					$message = str_replace(array('[img]', '[/img]'), array('[url]', '[/url]'), $message);
				}

				// short the message
				$message = substr($message, 0, $this->topic_text_length);

				// re-add bbCode
				$row['post_text'] = prepare_message($message, $row['enable_html'], $row['enable_bbcode'], $row['enable_smilies'], $row['bbcode_uid']);
			}

			// do some standardization
			$row['post_icon'] = $row['topic_icon'];
			$row['event_start'] = $row['topic_calendar_time'];
			$row['event_end'] = $row['topic_calendar_time'] + (empty($row['topic_calendar_duration']) ? 86399 : $row['topic_calendar_duration']);

			// get users
			$row['topic_poster'] = intval($row['topic_poster']);
			$row['topic_last_poster'] = intval($row['topic_last_poster']);
			if ( !in_array($row['topic_poster'], array(0, ANONYMOUS)) && !isset($this->user_data[ $row['topic_poster'] ]) )
			{
				$user_ids[ $row['topic_poster'] ] = true;
			}
			if ( !in_array($row['topic_last_poster'], array(0, ANONYMOUS)) && !isset($this->user_data[ $row['topic_last_poster'] ]) )
			{
				$user_ids[ $row['topic_last_poster'] ] = true;
			}

			// add this row
			$this->data[] = $row;
			$count++;
		}
		$db->sql_freeresult($result);

		// read users
		$user->read_pool($user_ids);
	}

	function display_one_item($idx, $tpl_level, $with_text, $with_bbcode, $title_only, $day_id)
	{
		global $config, $user, $template;

		if ( !isset($this->data[$idx]) )
		{
			return false;
		}
		$title = _un_htmlspecialchars(_censor($this->data[$idx]['topic_title']));
		$short_title = (strlen($title) > $this->topic_title_length + 3) ? substr($title, 0, $this->topic_title_length) . '...' : $title;
		$title = htmlspecialchars($title);
		$short_title = htmlspecialchars($short_title);

		// basic values
		$tpl_values = array(
			'U_EVENT' => $config->url('viewtopic', array(POST_TOPIC_URL => $this->data[$idx]['topic_id']), true),
			'I_EVENT' => $user->img('icon_tiny_topic'),
			'L_EVENT' => $user->lang('Topic'),
			'TITLE' => $short_title,
			'FULL_TITLE' => $title,
		);

		// overview
		if ( $title_only )
		{
			if ( $with_bbcode && $first )
			{
				$template->assign_block_vars('java.day', array('DAY_ID' => $day_id));
				$template->assign_block_vars($tpl_level, array('DAY_ID' => $day_id));
			}
			$template->assign_block_vars($with_bbcode ? 'java.day._event' : $tpl_level, $tpl_values);
		}
		else
		{
			$message = $this->get_message($idx, $with_text, $with_bbcode);
			if ( $with_bbcode )
			{
				$event_id = POST_TOPIC_URL . '_' . $idx;
				$template->assign_block_vars($tpl_level, $tpl_values + array(
					'EVENT_ID' => $event_id,
				));
				if ( !isset($this->data[$idx]['event_sent']) || !$this->data[$idx]['event_sent'] )
				{
					$template->assign_block_vars('java.cal_event', array(
						'EVENT_ID' => $event_id,
						'MESSAGE' => $message,
					));
					$this->data[$idx]['event_sent'] = true;
				}
			}
			else
			{
				$template->assign_block_vars($tpl_level, $tpl_values + array(
					'MESSAGE' => $message,
				));
			}
			$template->set_switch($tpl_level . '._content');
			$template->set_switch($tpl_level . '._content.java', $with_bbcode);
		}
	}

	function get_message($idx, $with_text, $with_bbcode)
	{
		global $config, $template, $user, $forums, $icons, $topics_attr;

		// message parsing
		$text = '';
		if ( $with_text && !empty($this->data[$idx]['post_text']) )
		{
			if ( $with_bbcode )
			{
				// parse the message
				$text = $this->data[$idx]['post_text'];
				if ( !$config->data['allow_html'] && $this->data[$idx]['enable_html'] )
				{
					$text = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $text);
				}
				if ( !empty($this->data[$idx]['bbcode_uid']) )
				{
					$text = $config->data['allow_bbcode'] ? bbencode_second_pass($text, $this->data[$idx]['bbcode_uid']) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $text);
				}
				if ( $config->data['allow_smilies'] )
				{
					$text = smilies_pass($text);
				}
				$text = _censor(preg_replace("/[\n\r]{1,2}/", '<br />', $text));
			}
			else
			{
				$text = _clean_bbcode(_clean_html($this->data[$idx]['post_text']));
				$text = str_replace('"', '&quot;', _censor(preg_replace("/[\n\r]{1,2}/", '<br />', $text)));
			}
		}

		// process the template
		$sav_tpl = array();
		$template->save($sav_tpl);
		$template->destroy();
		$template->assign_vars(array(
			'L_SUBJECT' => $user->lang('Subject'),
			'TOPIC_TITLE' => _censor($this->data[$idx]['topic_title']),
			'U_TOPIC' => $config->url('viewtopic', array(POST_TOPIC_URL => $this->data[$idx]['topic_id']), true),
			'L_AUTHOR' => $user->lang('Author'),
			'AUTHOR' => !empty($this->data[$idx]['topic_first_username']) ? $this->data[$idx]['topic_first_username'] : (($this->data[$idx]['topic_poster'] == ANONYMOUS) || !isset($user->pool[ $this->data[$idx]['topic_poster'] ]) ? $user->lang('Guest') : $user->pool[ $this->data[$idx]['topic_poster'] ]['username']),
			'L_TOPIC_DATE' => $user->lang('Date'),
			'TOPIC_DATE' => $user->date($this->data[$idx]['topic_time']),
			'L_FORUM' => $user->lang('Forum'),
			'MESSAGE' => $text,
			'L_VIEWS' => $user->lang('Views'),
			'VIEWS' => $this->data[$idx]['topic_views'],
			'L_REPLIES' => $user->lang('Replies'),
			'REPLIES' => $this->data[$idx]['topic_replies'],
		));
		$template->set_switch('text', $with_text && !empty($text));

		// enhance topic title
		$this->front_title->set('', $this->data[$idx]);
		$forums->display_nav($this->data[$idx]['forum_id'], 'nav', true);

		$no_debug = $template->no_debug;
		$template->no_debug = true;
		if ( !$this->tpl_loaded )
		{
			$template->set_filenames(array('_cal_overview_topic' => $with_bbcode ? 'calendar_overview_topic.tpl' : 'calendar_overview_topic_txt.tpl'));
		}
		$message = $template->get_pparse('_cal_overview_topic');
		$template->no_debug = $no_debug;
		if ( !$with_bbcode )
		{
			// do some cleaning for the text-mode overview
			$message = str_replace(array('<br />', '&nbsp;', '<', '>', '"'), array("\n", ' ', '&lt;', '&gt;', '&quot;'), preg_replace("/[\n\r]{1,2}/", '', $message));
		}
		$template->restore($sav_tpl);

		return $message;
	}

	function display_list($start_date, $end_date, $event_idxs, $first)
	{
		global $template, $config, $user;

		$all_events = ($end_date - $start_date > 3600);
		$topics = new calendar_topics_list('calendar_scheduler', $start_date, $all_events);
		$topics->read($this->data, $event_idxs, $this->forum_id);
		$upper_box = true;
		$display_empty = true;
		$forced_title = format_user_date($start_date, _read('hour', TYPE_INT) <= 0 ? $user->data['user_dateformat_medium'] : $user->data['user_dateformat']);
		$template->assign_block_vars('right_side', array(
			'BOX' => $topics->get_display($upper_box, $display_empty, $forced_title),
		));
		$template->set_switch('right_side.first', $first);
		_hide('day', date('d', $start_date));
	}
}

class calendar_topics_list extends topics
{
	var $date;
	var $all_events;
	var $forum_id;

	function calendar_topics_list($requester, $start_date, $all_events)
	{
		parent::topics($requester);

		$this->date = $start_date;
		$this->all_events = $all_events;
	}

	function read(&$data, $idxs, $forum_id=0)
	{
		global $db, $user;

		$this->forum_id = intval($forum_id);

		if ( empty($idxs) )
		{
			return;
		}

		// get the topics data
		$this->data_ext = array();
		$count_idxs = count($idxs);
		$user_ids = array();
		$chk_topics_own = array();
		for ( $i = 0; $i < $count_idxs; $i++ )
		{
			$topic_id = $data[ $idxs[$i] ]['topic_id'];
			$this->data_ext[$topic_id] = &$data[ $idxs[$i] ];

			if ( !empty($this->data_ext[$topic_id]['topic_poster']) && ($this->data_ext[$topic_id]['topic_poster'] != ANONYMOUS) )
			{
				$user_ids[ $this->data_ext[$topic_id]['topic_poster'] ][] = $topic_id;
			}
			if ( !empty($this->data_ext[$topic_id]['topic_last_poster']) && ($this->data_ext[$topic_id]['topic_last_poster'] != ANONYMOUS) )
			{
				$user_ids[ $this->data_ext[$topic_id]['topic_last_poster'] ][] = $topic_id;
			}

			// get the topics to check for "you have posted in this topic"
			if ( $user->data['session_logged_in'] )
			{
				$this->data_ext[$topic_id]['topic_own'] = ($this->data_ext[$topic_id]['topic_poster'] == $user->data['user_id']) || ($this->data_ext[$topic_id]['topic_last_poster'] == $user->data['user_id']);
				if ( !$this->data_ext[$topic_id]['topic_own'] )
				{
					$chk_topics_own[] = $topic_id;
				}
			}
		}

		// read the pertinent users
		$user->read_pool($user_ids);

		// search topics the viewer has posted in
		if ( !empty($chk_topics_own) )
		{
			$sql = 'SELECT DISTINCT topic_id
						FROM ' . POSTS_TABLE . '
						WHERE poster_id = ' . intval($user->data['user_id']) . '
							AND topic_id IN(' . implode(', ', $chk_topics_own) . ')';
			$result = $db->sql_query($sql, false, __LINE__, __FILE__);
			while ( $row = $db->sql_fetchrow($result) )
			{
				$this->data_ext[ $row['topic_id'] ]['topic_own'] = true;
			}
			$db->sql_freeresult($result);
		}

		// parms for pagination
		$this->total_topics = count($this->data_ext);
		$this->parms['ppage'] = $this->total_topics;
	}

	function get_display($upper_box=false, $display_empty=false, $forced_title='')
	{
		global $template, $forums, $user;

		// prepare result
		$res = '';

		// check if we display something
		if ( $display_empty || ($upper_box && !empty($this->data_ext)) || (!$upper_box && !empty($this->data)) )
		{
			// save and reset template
			$save_tpl = array();
			$template->save($save_tpl);

			// choose tpl
			$template->set_filenames(array('topics_box' => 'topics_row_box.tpl'));

			// send display
			$this->display($upper_box, $display_empty, $forced_title);
			$template->assign_vars(array(
				'L_NO_TOPICS' => $user->lang('No_search_match'),
			));

			// get result
			$res = $template->get_pparse('topics_box');

			// restore template
			$template->restore($save_tpl);
		}
		return $res;
	}

	function bottom_line($empty=false)
	{
		global $template, $user, $forums;

		$template->set_switch('topicrow');
		$template->set_switch('topicrow.bottom');
		$template->set_switch('topicrow.bottom.no_topics', $empty);
		$template->assign_vars(array(
			'L_SELECT_FORM' => $user->lang('Select'),
			'S_FORUM_LIST' => $forums->get_jumpbox(true, $this->forum_id),
			'POST_FORUM_URL' => POST_FORUM_URL,
			'L_GO' => $user->lang('Go'),
			'I_GO' => $user->img('cmd_mini_submit'),
			'S_HOURS' => $this->get_hours(),
		));
		$template->set_filenames(array('bottom_row' => 'calendar_topics_bottom_sched.tpl'));
		$template->assign_var_from_handle('BOTTOM_ROW', 'bottom_row');
	}

	function get_hours()
	{
		global $user;

		$fmt = 'H:00';
		if ( strpos(' ' . $user->data['user_dateformat'], 'a') )
		{
			$fmt = 'h a';
		}
		else if ( strpos(' ' . $user->data['user_dateformat'], 'A') )
		{
			$fmt = 'h A';
		}
		// let's set an arbitrary date
		$date = mktime(0, 0, 0, 01, 01, 2005);

		$select = $this->all_events ? 0 : date('H', $this->date) + 1;
		$options = '<option value="0"' . ( empty($select) ? ' selected="selected"' : '') . '>' . $user->lang('Calendar_all_events') . '</option>';
		for ( $i = 1; $i <= 24; $i++ )
		{
			$selected = ($select == $i) ? ' selected="selected"' : '';
			$options .= '<option value="' . $i . '"' . $selected . '>' . format_user_date($date, $fmt) . '</option>';
			$date += 3600;
		}
		return $options;
	}
}

?>