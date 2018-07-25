<?php
/***************************************************************************
 *							resync.php
 *							----------
 *	begin		: 29/10/2005
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 1.0.0 - 29/10/2005
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
define('IN_INSTALL', true);
$phpbb_root_path = './../';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($config->url('includes/class_install'));
include($config->url('includes/class_forums'));

// script def
$requester = 'install_cat/' . basename(__FILE__, '.' . $phpEx);

// constants
define('ROWS_A_TURN', 500);

// tpls
function welcome_form()
{
	global $page;
?><form name="post" method="post" action="<?php echo $page->url(); ?>"><br /><br /><div align="center"><table cellpadding="4" cellspacing="1" border="0" width="80%" class="background">
<tr><th><?php echo sprintf($page->lang('CH_welcome'), CH_CURRENT_VERSION); ?></th></tr>
<tr><td align="justify" class="row1"><br /><?php echo sprintf($page->lang('CH_welcome_explain'), CH_CURRENT_VERSION); ?><br /><br /><br /></td></tr>
<tr><td align="center" class="row2"><?php echo $page->lang('CH_start'); ?>: <input name="submit" type="submit" value="<?php echo $page->lang('CH_proceed'); ?>" /></td></tr>
</table></div><?php $page->hide(); ?></form>
<?php
}

function founder_form($possible_founders)
{
	global $page;
?><form name="post" method="post" action="<?php echo $page->url(); ?>"><br /><br /><div align="center"><table cellpadding="4" cellspacing="1" border="0" width="80%" class="background">
<tr><th><?php echo $page->lang('CH_choose_founder'); ?></th></tr>
<tr><td align="center" class="row1"><br /><br />
<?php echo $page->lang('CH_founder'); ?>: <select name="fnd"><?php

	$i = 0;
	foreach ( $possible_founders as $id => $name )
	{
		$i++;
?><option value="<?php echo $i; ?>"><?php echo $name; ?></option><?php
	}

?></select> <input name="select" type="submit" value="<?php echo $page->lang('CH_select'); ?>" />
<br /><br /></td></tr>
</table></div><?php $page->hide(); ?></form>
<?php
}

function percent_box($title, $percent)
{
	global $page;
	$mult = 2;
	$page->output('<table cellpadding="1" cellspacing="0" border="0"><tr><td>' . $title . ':&nbsp;</td><td style="width: ' . (100 * $mult) . 'px; height: 13px; background-color: #FEFEFF; border: 1px #98AAB1 solid;"><div style="width: ' . ($percent * $mult). 'px; height: 13px; background-color: #00D000;"></div></td></tr></table>');
}

// steps
$steps = array(
	'CH_sync_topics',
	'CH_sync_forums',
	'CH_end',
);

// parms (not set is : type => TYPE_INT, default => 0)
$parms_def = array(
	'step' => array('list' => &$steps),
	'tt' => '',
	'tf' => '',
);

// step functions
function step()
{
	global $parms, $steps;
	return $steps[ $parms['step'] ];
}
function next_step($step='')
{
	global $page, $parms, $steps;
	if ( !empty($step) )
	{
		$t_steps = array_flip($steps);
		$parms['step'] = $t_steps[$step];
	}
	else
	{
		$parms['step']++;
	}
	$page->set_parms($parms);
}

//--------------------------------------
//
// Start of the process
//
//--------------------------------------

// parms reading
$parms = array();
foreach ( $parms_def as $parm => $data )
{
	$type = empty($data) || !isset($data['type']) ? TYPE_INT : $data['type'];
	$default = empty($data) || !isset($data['default']) ? (($type == TYPE_INT) ? 0 : '') : $data['default'];
	$list = empty($data) || !isset($data['list']) ? '' : $data['list'];
	$parms[$parm] = _read($parm, $type, $default, $list);
}

// start
$page = new page($requester);
$page->set_parms($parms);

// set version
$lang['Script_title'] = 'Resync topics - Categories Hierarchy ' . CH_CURRENT_VERSION;

// log in
$session = new light_session();
$session->log_in(ADMIN);

// synchronise topics
if ( step() == 'CH_sync_topics' )
{
	$sql = 'SELECT t.topic_id, t.topic_type, t.topic_time, fp.post_username AS first_username, lp.poster_id AS last_poster, lp.post_username AS last_username, lp.post_time AS last_time
				FROM ' . TOPICS_TABLE . ' t
					LEFT JOIN ' . POSTS_TABLE . ' fp ON fp.post_id = t.topic_first_post_id
					LEFT JOIN ' . POSTS_TABLE . ' lp ON lp.post_id = t.topic_last_post_id
				WHERE t.topic_last_time = 0
					AND t.topic_moved_id = 0';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$remaining = $db->sql_numrows($result);
	$parms['tt'] = max(intval($parms['tt']), $remaining + 1);
	$percent_done = empty($remaining) ? 100 : 100 - round(doubleval($remaining * 100) / ($parms['tt'] - 1));
	if ( $remaining >= ROWS_A_TURN )
	{
		// send percent box
		percent_box(sprintf($page->lang('CH_db_topics_percent_sync'), $parms['tt'] - 1 - $remaining, $parms['tt'] - 1), $percent_done);
	}

	$i = 0;
	while ( ($row = $db->sql_fetchrow($result)) && ($i < ROWS_A_TURN) )
	{
		$fields = array(
			'topic_first_username' => $row['first_username'],
			'topic_last_poster' => intval($row['last_poster']),
			'topic_last_username' => $row['last_username'],
			'topic_last_time' => intval($row['last_time']),
		);
		if ( $row['topic_type'] == POST_ANNOUNCE )
		{
			$fields += array(
				'topic_duration' => intval($row['topic_time']),
			);
		}
		$db->sql_statement($fields);
		$sql = 'UPDATE ' . TOPICS_TABLE . '
					SET ' . $db->sql_update . '
					WHERE topic_id = ' . $row['topic_id'];
		$db->sql_query($sql, false, __LINE__, __FILE__);
		$i++;
	}
	$remaining -= ROWS_A_TURN;
	if ( $remaining > 0 )
	{
		$page->loop($parms);
	}
	next_step();

	// one last turn to reset the probable time overflow
	$page->loop();
}
if ( !empty($parms['tt']) )
{
	$page->output(sprintf($page->lang('CH_db_topics_sync'), $parms['tt'] - 1));
}

// synchronise forums & posts count
if ( step() == 'CH_sync_forums' )
{
	// read forum ids
	$sql = 'SELECT forum_id
				FROM ' . FORUMS_TABLE;
	$result = $db->sql_query($sql, false, __LINE__, __FILE);
	$forums = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$forums[] = intval($row['forum_id']);
	}

	// synchronise last post data
	$count_forums = count($forums);
	for ( $i = 0; $i < $count_forums; $i++ )
	{
		$sql = 'SELECT t.topic_title, t.topic_last_post_id, t.topic_last_poster, t.topic_last_username, t.topic_last_time, u.username
					FROM ' . TOPICS_TABLE . ' t
						LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = t.topic_last_poster
					WHERE forum_id = ' . $forums[$i] . '
					ORDER BY t.topic_last_post_id DESC
					LIMIT 1';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$row = $db->sql_fetchrow($result);
		$fields = array(
			'forum_last_title' => $row['topic_title'],
			'forum_last_poster' => intval($row['topic_last_poster']),
			'forum_last_username' => (($row['topic_last_poster'] == ANONYMOUS) || empty($row['username'])) ? $row['topic_last_username'] : $row['username'],
			'forum_last_time' => intval($row['topic_last_time']),
		);
		$db->sql_statement($fields);
		$sql = 'UPDATE ' . FORUMS_TABLE . '
					SET ' . $db->sql_update . '
					WHERE forum_id = ' . $forums[$i];
		$db->sql_query($sql, false, __LINE__, __FILE__);
	}

	$parms['tf'] = $count_forums + 1;
	next_step();
	$page->loop();
}
if ( !empty($parms['tf']) )
{
	$page->output(sprintf($page->lang('CH_db_forums_sync'), $parms['tf'] - 1));
}

// all is done, recache
if ( step() == 'CH_end' )
{
	$page->critical_error('CH_return_to_board');
}

// send page
$page->header();
$page->footer();

?>