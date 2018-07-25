<?php
/***************************************************************************
 *							calendar_scheduler.php - CH edition
 *							----------------------
 *	begin		: 06/12/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.2 - 15/05/2005
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
define('IN_CALENDAR', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.' . $phpEx);

include($config->url('includes/class_forums'));
include($config->url('includes/class_calendar'));

// date is in user format
$date = sprintf('%08d', _read('date', TYPE_INT));
$date = (intval($date) < 19700102) || (intval($date) >= 20700101) ? 0 : mktime( 0, 0, 0, intval(substr($date, 4, 2)), intval(substr($date, 6, 2)), intval(substr($date, 0, 4)));

// from pull down lists
$year = _read('year', TYPE_INT);
$month = _read('month', TYPE_INT);
$day = _read('day', TYPE_INT);
if ( ($month > 0) && ($month <= 12) && ($year >= 1970) && ($year < 2070) )
{
	$date = mktime( 0, 0, 0, $month, $day, $year);
	if ( date('m', $date) <> $month )
	{
		$date = mktime( 0, 0, 0, $month, 01, $year);
	}
}

// next/previous from input buttons
if ( intval($date) )
{
	$aamm = date('Ym', $date);
	if ( _button('next') && ($aamm >= 197001) && ($aamm < 206912) )
	{
		$date = mktime( 0, 0, 0, date('m', $date) + 1, 01, $year);
	}
	if ( _button('prev') && ($aamm > 197001) && ($aamm <= 206912) )
	{
		$date = mktime( 0, 0, 0, date('m', $date), 00, $year);
	}
}

// hour
$hour = _read('hour', TYPE_INT);
if ( ($hour < 0) || ($hour > 24) )
{
	$hour = 0;
}

// read forums
$forums = new forums();
$forums->read();
$forum_id = _read(POST_FORUM_URL, TYPE_INT);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// check auths
$user->get_cache(POST_FORUM_URL);
if ( !$user->auth(POST_FORUM_URL, 'auth_read', $forum_id) )
{
	$forum_id = 0;
}

// navigation
$navigation = new navigation();
$navigation->add('Calendar', '', 'calendar', array(POST_FORUM_URL => $forum_id, 'date' => empty($date) ? 0 : date('Ymd', $date)), '');
$navigation->add('Calendar_scheduler', '', 'calendar_scheduler', array(POST_FORUM_URL => $forum_id, 'date' => date('Ymd', $date), 'hour' => $hour), '');
$navigation->display();

// send the calendar box
$calendar_scheduler = new calendar_scheduler();
$calendar_scheduler->display($date, $hour, $forum_id);

// send board header
$page_title = $user->lang('Calendar_scheduler');
include($config->url('includes/page_header'));

// system
$template->assign_vars(array(
	'S_ACTION' => $config->url('calendar_scheduler', '', true),
));
_hide('date', $date);
_hide_set();

// send to browser
$template->set_filenames(array('body' => 'calendar_scheduler_body.tpl'));
$template->pparse('body');
include($config->url('includes/page_tail'));

?>