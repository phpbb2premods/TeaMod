<?php
//-- mod : recent topics ------------------------------------------------------
//-- add-on : recent posts desactivable via acp --------------------------------
//-- mod : attachmod -----------------------------------------------------------
/***************************************************************************
 *							index.php
 *							---------
 *	begin		: 25/08/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.7 - 31/10/2005
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

include($config->url('includes/class_forums'));
include($config->url('includes/class_topics'));
include($config->url('includes/class_stats'));

// read parms
$forum_id = _read(POST_FORUM_URL, TYPE_INT);
$mark_allowed = array('forums' => POST_FORUM_URL, 'topics' => POST_TOPIC_URL);
$mark = _read('mark', TYPE_NO_HTML, '', array('' => '') + $mark_allowed);

// read forums
$forums = new forums();
$forums->read();
//
// Start session management
//
$userdata = session_pagestart($user_ip, empty($forum_id) ? PAGE_INDEX : $forum_id);
init_userprefs($userdata);
//
// End session management
//

// init objects
$user->get_cache(array(POST_FORUM_URL, POST_FORUM_URL . 'jbox'));

// check user access
if ( !$user->auth(POST_FORUM_URL, 'auth_view', $forum_id) )
{
	if ( !$user->data['session_logged_in'] )
	{
		redirect($config->url('login', array('redirect' => str_replace('?', '&amp;', $config->url('index', array(POST_FORUM_URL => $forum_id)))), true));
	}
	message_return('Forum_not_exist');
}

// link forum type
if ( $forums->data[$forum_id]['forum_type'] == POST_LINK_URL )
{
	if ( empty($forums->data[$forum_id]['forum_link']) )
	{
		message_return('Not_available');
	}
	if ( $forums->data[$forum_id]['forum_link_hit_count'] )
	{
		$sql = 'UPDATE ' . FORUMS_TABLE . '
					SET forum_link_hit = forum_link_hit + 1
					WHERE forum_id = ' . $forum_id;
		$db->sql_query($sql, false, __LINE__, __FILE__);
	}
	redirect($forums->data[$forum_id]['forum_link']);
}

// process mark actions
if ( $mark )
{
	$forums->mark($mark_allowed[$mark], $forum_id);
}

// actualize data (required for pruning action)
$forums->refresh($forum_id);

// forum prune
if ( $user->auth(POST_FORUM_URL, 'auth_mod', $forum_id) && $config->data['prune_enable'] )
{
	if ( ($forums->data[$forum_id]['prune_next'] < time()) && $forums->data[$forum_id]['prune_enable'] )
	{
		include($config->url('includes/prune'));
		require($config->url('includes/functions_admin'));
		auto_prune($forum_id);
	}
}

// Mozilla navigation bar
if ( !empty($forum_id) )
{
	$nav_links['top'] = array(
		'url' => $config->url('index', '', true),
		'title' => $forums->data[$forum_id]['forum_name'],
	);
	$nav_links['up'] = array(
		'url' => $config->url('index', array(POST_FORUM_URL => intval($forums->data[$forum_id]['forum_main'])), true),
		'title' => $forums->data[ intval($forums->data[$forum_id]['forum_main']) ]['forum_name'],
	);
}
//
// Start output of page
//
$page_title = empty($forum_id) ? $user->lang('Index') . ' - ' . $config->data['sitename'] : $user->lang('View_forum') . ' - ' . $user->lang($forums->data[$forum_id]['forum_name']);
//-- add-on : recent posts desactivable via acp --------------------------------
if ( $board_config['recent_posts_active'] )
{
//-- mod : recent topics -------------------------------------------------------
//-- add
// get last topics replied
if ( !empty($forums->data[$forum_id]['subs']) )
{
	include($config->url('includes/class_topics_recent'));
	$last_topics = new topics_recent();
	$last_topics->read($forum_id);
	$topics_recent = $last_topics->get_display(true, false, 'New_posts');
	unset($last_topics);
	$template->assign_vars(array(
		'LAST_TOPICS' => $topics_recent,
	));
	$template->set_switch('last_topics_spacing', !empty($topics_recent));
	unset($topics_recent);
}
//-- fin mod : recent topics ---------------------------------------------------
}
//-- fin add-on : recent posts desactivable via acp ----------------------------
// get topics for this forum (and section announces if asked)
$topics = new topics();
$topics->read($forum_id);

// board announces
$board_topics = $topics->get_display(true, false);

// forum topics
$forum_topics = $topics->get_display(false, ($forums->data[$forum_id]['forum_type'] == POST_FORUM_URL));

// display forums
$forums->display($forum_id);

// if nothing to display, send message
if ( empty($forum_topics) && !$forums->displayed )
{
	if ( empty($forum_id) && empty($board_topics) )
	{
		message_die(GENERAL_MESSAGE, $user->lang('No_forums'));
	}
	if ( !empty($forum_id) )
	{
		$parent = intval($forums->data[$forum_id]['forum_main']);
		$l_link = empty($parent) ? '' : 'Click_return_parent';
		$u_link = empty($parent) ? '' : $config->url('index', array(POST_FORUM_URL => $parent), true);
		message_return('Cat_no_subs', $l_link, $u_link);
	}
}

// forum rules
$s_auth_can = '';
if ( $forums->data[$forum_id]['forum_type'] == POST_FORUM_URL )
{
	$s_auth_can = ($user->auth(POST_FORUM_URL, 'auth_post', $forum_id) ? $user->lang('Rules_post_can') : $user->lang('Rules_post_cannot')) . '<br />';
	$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_reply', $forum_id) ? $user->lang('Rules_reply_can') : $user->lang('Rules_reply_cannot')) . '<br />';
	$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_edit', $forum_id) ? $user->lang('Rules_edit_can') : $user->lang('Rules_edit_cannot')) . '<br />';
	$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_delete', $forum_id) ? $user->lang('Rules_delete_can') : $user->lang('Rules_delete_cannot')) . '<br />';
	$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_vote', $forum_id) ? $user->lang('Rules_vote_can') : $user->lang('Rules_vote_cannot')) . '<br />';
	if ( !empty($config->data['mod_topic_calendar_CH']) )
	{
		$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_calendar', $forum_id) ? $user->lang('Rules_calendar_can') : $user->lang('Rules_calendar_cannot')) . '<br />';
	}
//-- mod : attachmod -----------------------------------------------------------
//-- add
	if ( defined('CH_mod_attachmod') )
	{
		$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_attachments', $forum_id) ? sprintf($user->lang('Rules_attach_can'), '<a href="' . $config->url('attach_rules', array(POST_FORUM_URL => $forum_id), true) . '" target="_blank">', '</a>') : $user->lang('Rules_attach_cannot')) . '<br />';
		$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_download', $forum_id) ? $user->lang('Rules_download_can') : $user->lang('Rules_download_cannot')) . '<br />';
	}
//-- fin mod : attachmod -------------------------------------------------------

	$s_auth_can .= ($user->auth(POST_FORUM_URL, 'auth_mod', $forum_id) ? sprintf($user->lang('Rules_moderate'), '<a href="' . $config->url('modcp', array(POST_FORUM_URL => $forum_id, 'start' => _read('start', TYPE_INT), 'sid' => $user->data['session_id']), true) . '">', '</a>') : '') . '<br />';

}

// send to template
$template->assign_vars(array(
	'BOARD_TOPICS' => $board_topics,
	'FORUM_TOPICS' => $forum_topics,
	'U_MARK_READ' => $config->url('index', array(POST_FORUM_URL => $forum_id, 'mark' => 'forums'), true),
	'L_MARK_READ' => $user->lang('Mark_all_forums'),
	'I_MARK_READ' => $user->img('forum_mark_read'),
	'S_AUTH_LIST' => $s_auth_can,

	'FORUM_IMG' => $user->img('forum'),
	'FORUM_NEW_IMG' => $user->img('forum_new'),
	'FORUM_LOCKED_IMG' => $user->img('forum_locked'),
	'FORUM_LINK_IMG' => $user->img('link'),

	'FOLDER_IMG' => $user->img('folder'),
	'FOLDER_NEW_IMG' => $user->img('folder_new'),
	'FOLDER_HOT_IMG' => $user->img('folder_hot'),
	'FOLDER_LOCKED_IMG' => $user->img('folder_locked'),
	'FOLDER_OWN_IMG' => $user->img('folder_own'),
	'FOLDER_STICKY_IMG' => $user->img('folder_sticky'),
	'FOLDER_ANNOUNCE_IMG' => $user->img('folder_announce'),
	'FOLDER_CALENDAR_IMG' => $user->img('folder_calendar'),
	'FOLDER_MOVED_IMG' => $user->img('folder_moved'),

	'L_NO_NEW_POSTS' => $user->lang('No_new_posts'),
	'L_NEW_POSTS' => $user->lang('New_posts'),
	'L_FORUM_LOCKED' => $user->lang('Forum_is_locked'),
	'L_FORUM_LINK' => $user->lang('Link'),

	'L_TOPIC_MOVED' => $user->lang('Topic_Moved'),
	'L_TOPIC_HOT' => $user->lang('Hot_topic'),
	'L_TOPIC_LOCKED' => $user->lang('Topic_Locked'),
	'L_TOPIC_OWN' => $user->lang('Own_topic'),
	'L_STICKY' => $user->lang('Post_Sticky'),
	'L_ANNOUNCEMENT' => $user->lang('Post_Announcement'),

	'S_ACTION' => $config->url('index', array(POST_FORUM_URL => $forum_id), true),
));
$template->set_switch('mark', $forums->displayed && $user->data['session_logged_in']);
$template->set_switch('forum_legend', $forums->data[$forum_id]['forum_type'] != POST_FORUM_URL);
$template->set_switch('board_topics_spacing', !empty($board_topics));
$template->set_switch('forums_spacing', $forums->displayed && !empty($forum_topics));
$template->set_switch('forum_topics_spacing', !empty($forum_topics));

// stats
$stats = new stats();
$stats->display($forum_id);

// jumpbox
make_jumpbox('index', $forum_id);

// display nav
$forums->display_nav($forum_id);

// Generate the page
include($config->url('includes/page_header'));
$template->set_filenames(array('body' => 'index_body.tpl'));
$template->pparse('body');
include($config->url('includes/page_tail'));

?>