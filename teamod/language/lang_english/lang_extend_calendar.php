<?php
/***************************************************************************
 *						lang_extend_calendar.php [English]
 *						------------------------
 *	begin				: 10/12/2004
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.2 - 29/03/2005
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
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_calendar'] = 'Topic Calendar';
}

$lang['Calendar'] = 'Calendar';
$lang['Calendar_scheduler'] = 'Scheduler';
$lang['Calendar_event'] = 'Calendar';
$lang['Calendar_event_explain'] = 'If you don\'t want this topic to be a calendar event, leave the dates equal to --- .';
$lang['Calendar_time'] = 'Calendar event begins at';
$lang['Calendar_stop'] = 'Calendar event ends at';
$lang['Calendar_date_not_valid'] = 'The date entered for calendar event are not defining a duration.';
$lang['Calendar_single_date'] = 'Event starting %s for one day';
$lang['Calendar_from_to'] = 'Event from %s to %s';

$lang['auth_calendar'] = 'Create new calendar events';
$lang['Rules_calendar_can'] = 'You <b>can</b> post calendar events in this forum';
$lang['Rules_calendar_cannot'] = 'You <b>cannot</b> post calendar events in this forum';
$lang['Click_return_calendar'] = 'Click %sHere%s to return to the calendar settings';

$lang['Calendar_settings'] = 'Calendar settings';
$lang['Calendar_week_start'] = 'First day of the week';
$lang['Calendar_header_cells'] = 'Number of cells to display on the board header (0 for no display)';
$lang['Calendar_title_length'] = 'Length of the title displayed in the calendar cells';
$lang['Calendar_text_length'] = 'Length of the text displayed in the overview windows';
$lang['Calendar_display_open'] = 'Display the calendar row on the board header opened';
$lang['Calendar_overview'] = 'Display the topic text on the board header';
$lang['Calendar_nb_row'] = 'Number of row per day on the board header';
$lang['Calendar_use_java'] = 'Use java routines to display the calendar';

$lang['Calendar_all_events'] = 'All events';

?>