<?php

/***************************************************************************
 *							class_calendar.php
 *							------------------
 *	begin		: 01/12/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.6 - 03/10/2005
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

//-------------------------------
// registration of event type :
// class => file
//-------------------------------
$calendar_event_types = array(
	'calendar_event_topics' => 'class_calendar_topics',
	'calendar_event_birthday' => 'class_calendar_birthday',
	'calendar_event_hollyday' => 'class_calendar_hollyday',
);

// read valid modules
$calendar_modules = array();
foreach ( $calendar_event_types as $module_class => $module_file )
{
	if ( !empty($module_file) )
	{
		@include_once($config->url('includes/' . $module_file));
	}
	if ( class_exists($module_class) )
	{
		$calendar_modules[] = $module_class;
	}
}
//-------------------------------
// output a user date
function format_user_date($time, $fmt)
{
	global $lang;
	return strtr(date($fmt, $time), $lang['datetime']);
}

// get user date day
function day_user_date($time, $inc=0)
{
	return mktime(0, 0, 0, date('m', $time), date('d', $time) + $inc, date('Y', $time));
}
//-------------------------------

class calendar_event_queue
{
	var $queue;
	var $map;

	function calendar_event_queue()
	{
		$this->queue = array();
		$this->map = array();
	}

	//
	// map events per day
	//
	function map($start_date, $end_date)
	{
		global $config, $user;

		// init
		$this->map = array();
		if ( empty($this->queue) )
		{
			return false;
		}

		// fill the map with the date
		$cur = day_user_date($start_date);
		while ( $cur < $end_date )
		{
			$this->map[$cur] = array();
			$cur = day_user_date($cur, +1);
		}
		if ( empty($this->map) )
		{
			return false;
		}
		$count_map = count($this->map);
		$map_keys = array_keys($this->map);
		$rev_map_keys = array_flip($map_keys);

		// build a list per date
		$event_classes = array_keys($this->queue);
		$count_event_classes = count($event_classes);
		for ( $i = 0; $i < $count_event_classes; $i++ )
		{
			$event_class = $event_classes[$i];
			if ( !empty($this->queue[$event_class]) )
			{
				$count_events = count($this->queue[$event_class]->data);
				for ( $j = 0; $j < $count_events; $j++ )
				{
					$row = &$this->queue[$event_class]->data[$j];
					$event_start = max($user->cvt_sys_to_user_date($row['event_start']), $start_date);
					$event_end = min($user->cvt_sys_to_user_date($row['event_end']), $end_date);

					$offset_date = $event_start == $start_date ? $event_start : day_user_date($event_start);

					// find the first available spot in the mapped day
					$count_map_offset_date = count($this->map[$offset_date]);
					$map_offset = $count_map_offset_date;
					$found = false;
					if ( $count_map_offset_date )
					{
						for ( $k = 0; ($k < $count_map_offset_date) && !$found; $k++)
						{
							if ( $this->map[$offset_date][$k] == -1 )
							{
								$found = true;
								$map_offset = $k;
							}
						}
					}

					// mark the offset as used for the whole event period
					$idx_offset = isset($rev_map_keys[$offset_date]) ? $rev_map_keys[$offset_date] : -1;
					while ( ($idx_offset >= 0) && ($offset_date <= $event_end) )
					{
						for ( $k = count($this->map[$offset_date]); $k <= $map_offset; $k++ )
						{
							$this->map[$offset_date][$k] = -1;
						}
						$this->map[$offset_date][$map_offset] = array('event_class' => $event_class, 'event_idx' => $j);
						$idx_offset++;
						if ( $idx_offset >= $count_map )
						{
							$idx_offset = -1;
						}
						$offset_date = $map_keys[$idx_offset];
					}
				}
			}
		}
	}

	//
	// display a week row for the index, or the full month view page
	//
	function display($start_date, $selected_date, $nb_rows, $nb_cells, $full_month, $start_inc, $with_text, $with_bbcode)
	{
		global $template, $config, $user;

		// get the number of lines per cell
		$nb_lines_per_cell = intval($config->data['calendar_nb_row']);

		// get the mapped dates
		$map_dates = array_keys($this->map);
		$count_map_dates = count($map_dates);
		$offset_map_date = 0 - $start_inc;

		// get today offset for the user
		$selected_date = day_user_date($selected_date);

		// display
		for ( $i = 0; $i < $nb_rows; $i++ )
		{
			$row_sent = false;
			for ( $j = 0; $j < $nb_cells; $j++ )
			{
				// date out of range
				$blank_start = $offset_map_date < 0;
				$blank_end = $offset_map_date >= $count_map_dates;

				// empty cells
				if ( $blank_start || $blank_end )
				{
					if ( $blank_start )
					{
						// compute the cell to span
						$span = $start_inc;
						$j = $start_inc;
						$offset_map_date = 0;
					}

					// date greater than end
					if ( $blank_end )
					{
						// compute the cell to span
						$span = $nb_cells-$j;
						$j = $nb_cells;
					}

					// send empty cells
					if ( $blank_start || (($span > 0) && ($span < $nb_cells)) )
					{
						if ( !$row_sent )
						{
							$template->set_switch('cal_row');
							$row_sent = true;
						}
						$template->assign_block_vars('cal_row.cal_cell', array(
							'WIDTH' => floor(100 / $nb_cells) * $span,
							'SPAN' => $span,
						));
						$template->set_switch('cal_row.cal_cell.empty');
					}
				}

				// filled cells
				if ( !$blank_end )
				{
					if ( !$row_sent )
					{
						$template->set_switch('cal_row');
						$row_sent = true;
					}
					$offset_date = $map_dates[$offset_map_date];
					$template->assign_block_vars('cal_row.cal_cell', array(
						'WIDTH' => floor(100 / $nb_cells),
						'DATE' => format_user_date($offset_date, $full_month ? $user->data['user_dateformat_short'] : $user->data['user_dateformat_medium'], false),
						'U_DATE' => $config->url('calendar_scheduler', array('date' => date('Ymd', $offset_date), POST_FORUM_URL => $forum_id), true),

						'EVENT_DATE' => $offset_date,
						'TOGGLE_STATUS' => 'none',
						'TOGGLE_ICON' => $user->img('down_arrow'),
					));
					$template->set_switch('cal_row.cal_cell.filled');

					$template->set_switch('cal_row.cal_cell.active', $selected_date == $offset_date);
					$template->set_switch('cal_row.cal_cell.filled.active', $selected_date == $offset_date);

					// send events
					$count_map = count($this->map[$offset_date]);
					for ( $k = 0; $k < $count_map; $k++ )
					{
						$content = isset($this->map[$offset_date][$k]) && is_array($this->map[$offset_date][$k]);
						if ( $content )
						{
							$event_class = $this->map[$offset_date][$k]['event_class'];
							$event_idx = $this->map[$offset_date][$k]['event_idx'];
							$this->queue[$event_class]->display_one_item($event_idx, 'cal_row.cal_cell.filled._event', $with_text, $with_bbcode, false, false, false);
						}
						else
						{
							$template->set_switch('cal_row.cal_cell.filled._event');
							$template->set_switch('cal_row.cal_cell.filled._event._content', false);
						}

						// we gonna have an overflow
						if ( $count_map > $nb_lines_per_cell )
						{
							// we are on the last line displayed
							$template->set_switch('cal_row.cal_cell.filled._event._more', $k == ($nb_lines_per_cell - 1));
							if ( $k == ($nb_lines_per_cell - 1) )
							{
								$template->set_switch('cal_row.cal_cell.filled._event._more.java', $with_bbcode);
							}

							// we are on the first line hidden
							$template->set_switch('cal_row.cal_cell.filled._event._more_header', $k == $nb_lines_per_cell);

							// we are on the last line hidden
							$template->set_switch('cal_row.cal_cell.filled._event._more_footer', $k == ($count_map-1));
						}
					}
				}

				// next map cell
				$offset_map_date++;
			}
		}
	}
}

class calendar_month_event_queue extends calendar_event_queue
{
	function display($start_date, $selected_date, $nb_rows, $nb_cells, $full_month, $start_inc, $with_text=true, $with_bbcode=true)
	{
		global $template, $config, $user;

		// get the mapped dates
		$map_dates = array_keys($this->map);
		$count_map_dates = count($map_dates);
		$offset_map_date = 0 - $start_inc;

		// get today offset for the user
		$selected_date = day_user_date($selected_date);

		// send java
		$template->set_switch('java', $with_bbcode);

		// display
		$color = false;
		for ( $i = 0; $i < $nb_rows; $i++ )
		{
			$color = !$color;
			$row_sent = false;
			for ( $j = 0; $j < $nb_cells; $j++ )
			{
				// date out of range
				$blank_start = $offset_map_date < 0;
				$blank_end = $offset_map_date >= $count_map_dates;

				// empty cells
				if ( $blank_start || $blank_end )
				{
					if ( $blank_start )
					{
						// compute the cell to span
						$span = $start_inc;
						$j = $start_inc;
						$offset_map_date = 0;
					}

					// date greater than end
					if ( $blank_end )
					{
						// compute the cell to span
						$span = $nb_cells-$j;
						$j = $nb_cells;
					}

					// send empty cells
					if ( $blank_start || (($span > 0) && ($span < $nb_cells)) )
					{
						if ( !$row_sent )
						{
							$template->set_switch('cal_row');
							$row_sent = true;
						}
						$template->assign_block_vars('cal_row.cal_cell', array(
							'WIDTH' => floor(100 / $nb_cells) * $span,
							'SPAN' => $span,
						));
						$template->set_switch('cal_row.cal_cell.empty');
					}
				}

				// filled cells
				if ( !$blank_end )
				{
					if ( !$row_sent )
					{
						$template->set_switch('cal_row');
						$row_sent = true;
					}
					$offset_date = $map_dates[$offset_map_date];
					$template->assign_block_vars('cal_row.cal_cell', array(
						'WIDTH' => floor(100 / $nb_cells),
						'DAY' => format_user_date($offset_date, 'd'),
						'L_DATE' => format_user_date($offset_date, $user->data['user_dateformat_medium']),
						'U_DATE' => $config->url('calendar_scheduler', array('date' => date('Ymd', $offset_date), POST_FORUM_URL => _read(POST_FORUM_URL, TYPE_INT)), true),
					));
					if ( $selected_date == $offset_date )
					{
						$template->set_switch('cal_row.cal_cell.active');
					}
					else
					{
						$template->set_switch('cal_row.cal_cell.light', $color);
					}

					// send events
					$count_map = count($this->map[$offset_date]);
					$content = false;
					for ( $k = 0; $k < $count_map; $k++ )
					{
						if ( isset($this->map[$offset_date][$k]) && is_array($this->map[$offset_date][$k]) )
						{
							$first = false;
							if ( !$content )
							{
								$content = true;
								$first = true;
								$template->set_switch('cal_row.cal_cell.filled');
								if ( $with_bbcode )
								{
									$day_id = date('Ymd', $offset_date);
									$tpl_var = array(
										'DAY_ID' => $day_id,
										'L_DATE' => format_user_date($offset_date, $user->data['user_dateformat_medium']),
										'U_DATE' => $config->url('calendar_scheduler', array('date' => date('Ymd', $offset_date), POST_FORUM_URL => _read(POST_FORUM_URL, TYPE_INT)), true),
									);
									$template->assign_block_vars('java.day', $tpl_var);
									$template->assign_block_vars('cal_row.cal_cell.filled.java', $tpl_var);
								}
								else
								{
									$template->set_switch('cal_row.cal_cell.filled.java', false);
								}
							}
							$event_class = $this->map[$offset_date][$k]['event_class'];
							$event_idx = $this->map[$offset_date][$k]['event_idx'];
							$this->queue[$event_class]->display_one_item($event_idx, $with_bbcode ? 'cal_row.cal_cell.filled.java._event' : 'cal_row.cal_cell.filled.java_ELSE._event', $with_text, $with_bbcode, true, $day_id);
						}
					}
					if ( !$content )
					{
						$template->set_switch('cal_row.cal_cell.filled', false);
					}
				}

				// next map cell
				$offset_map_date++;
			}
		}


		// template
		$template->set_filenames(array('_calendar_month_box' => 'calendar_month_box.tpl'));
		$template->assign_block_vars('left_side', array(
			'BOX' => $template->get_pparse('_calendar_month_box'),
		));
		$template->set_switch('left_side.first');
	}

	function display_list($start_time, $end_time)
	{
		global $user;

		// prepare the list
		$event_classes = array_keys($this->queue);
		$count_event_classes = count($event_classes);
		$list = array();
		for ( $i = 0; $i < $count_event_classes; $i++ )
		{
			$list[ $event_classes[$i] ] = array();
		}

		// get the day starting time
		$offset_date = day_user_date($start_time);
		$count_map = count($this->map[$offset_date]);
		for ( $i = 0; $i < $count_map; $i++ )
		{
			if ( isset($this->map[$offset_date][$i]) && is_array($this->map[$offset_date][$i]) )
			{
				$event_class = $this->map[$offset_date][$i]['event_class'];
				$event_idx = $this->map[$offset_date][$i]['event_idx'];
				$event_start = $user->cvt_sys_to_user_date($this->queue[$event_class]->data[$event_idx]['event_start']);
				$event_end = $user->cvt_sys_to_user_date($this->queue[$event_class]->data[$event_idx]['event_end']);
				if ( ($event_start < $end_time) && ($event_end >= $start_time) )
				{
					$list[$event_class][] = $event_idx;
				}
			}
		}
		for ( $i = 0; $i < $count_event_classes; $i++ )
		{
			$this->queue[ $event_classes[$i] ]->display_list($start_time, $end_time, $list[ $event_classes[$i] ], $i == 0);
		}
	}
}

class calendar_event
{
	var $data;
	var $total;
	var $tpl_loaded;
	var $calendar_event_queue;

	function calendar_event(&$calendar_event_queue)
	{
		$this->data = array();
		$this->total = array();
		$this->tpl_loaded = false;
		$this->calendar_event_queue = &$calendar_event_queue;
	}
}

class calendar
{
	var $start_date;
	var $end_date;
	var $with_text;
	var $with_bbcode;
	var $forum_id;

	var $full_month;
	var $nb_cells;
	var $nb_rows;
	var $start_inc;

	function calendar()
	{
		global $config, $template, $user;

		// settings
		$settings = array(
			'calendar_header_cells' => 7,
			'calendar_display_open' => false,
			'calendar_overview' => false,
			'calendar_use_java' => true,
			'calendar_title_length' => 30,
			'calendar_text_length' => 200,
			'calendar_week_start' => 1,
			'calendar_nb_row' => 5,
		);

		// create config values
		if ( empty($config->data['calendar_title_length']) || empty($config->data['calendar_nb_row']) )
		{
			$config->begin_transaction();
			foreach ( $settings as $key => $value )
			{
				$config->set($key, $value, true);
			}
			$config->end_transaction();
		}

		// get user prefs
		foreach ( $settings as $key => $value )
		{
			if ( !empty($user->data['user_' . $key]) )
			{
				$config->data[$key] = $user->data['user_' . $key];
			}
		}

		// set the user date short format
		$this->set_user_date_format();

		// header
		$template->assign_vars(array(
			'U_CALENDAR' => $config->url('calendar', '', true),
			'L_CALENDAR' => $user->lang('Calendar'),
			'I_CALENDAR' => $user->img('menu_calendar'),
			'L_CALENDAR_ALT' => $user->lang('Calendar_event'),
		));
		$template->set_switch('topic_calendar');
	}

	// date is a user format date
	function display($tpl_var, $date=0, $forum_id=0, $full_month=false)
	{
		global $config, $user, $template;
		global $calendar_modules;

		$this->forum_id = intval($forum_id);
		$this->full_month = $full_month;
		$this->nb_cells = $this->full_month ? 7 : intval($config->data['calendar_header_cells']);
		$this->with_text = $config->data['calendar_overview'] || $this->full_month;
		$this->with_bbcode = $config->data['calendar_use_java'];

		// halt here if single row, no java and header closed
		if ( (!$this->with_bbcode && !$config->data['calendar_display_open'] && !$this->full_month) || empty($this->nb_cells) )
		{
			return '';
		}

		// the date entered is a user date : pull it to the begining of the day for the user
		if ( empty($date) || (date('Ymd', $date) < 19700102) )
		{
			$date = $user->cvt_sys_to_user_date(time());
		}
		$date = day_user_date($date);

		// the full month is displayed
		if ( $this->full_month )
		{
			// pull the dates to the first of the month & next month
			$this->start_date = mktime(0, 0, 0, date('m', $date), 01, date('Y', $date));
			$this->end_date = mktime(0, 0, 0, date('m', $this->start_date) + 1, 01, date('Y', $this->start_date));

			// get the number of cells per line, the offset of the first day, and the number of rows (a day can have 23 to 25 hours : DST, so use round())
			$offset = isset($config->data['calendar_week_start']) ? intval($config->data['calendar_week_start']) : 1;
			$this->start_inc = date('w', $this->start_date) - $offset;
			if ( $this->start_inc < 0 )
			{
				$this->start_inc = $this->nb_cells + $this->start_inc;
			}
			$this->nb_rows = intval(($this->start_inc + round(($this->end_date - $this->start_date) / 86400)) / $this->nb_cells) + 1;
		}

		// only a row is displayed
		else
		{
			// set the start date to the day before the date selected
			$this->start_date = day_user_date($date, - 1);
			$this->end_date = day_user_date($this->start_date, $this->nb_cells);

			// get the number of cells & rows per line, and the offset of the first day
			$this->start_inc = 0;
			$this->nb_rows = 1;
		}

		// init event queue
		$calendar_event_queue = new calendar_event_queue();

		// browse calendar event types
		$count_calendar_modules = count($calendar_modules);
		for ( $i = 0; $i < $count_calendar_modules; $i++ )
		{
			$event_type = $calendar_modules[$i];
			$$event_type = new $event_type($calendar_event_queue);
			$$event_type->read($this->start_date, $this->end_date, $this->with_text, $this->forum_id);
		}

		// map the events
		$calendar_event_queue->map($this->start_date, $this->end_date);

		// display
		$this->display_legend();
		$calendar_event_queue->display($this->start_date, $user->cvt_sys_to_user_date(time()), $this->nb_rows, $this->nb_cells, $this->full_month, $this->start_inc, $this->with_text, $this->with_bbcode);

		// template
		$template->set_filenames(array('_calendar_body' => 'calendar_box.tpl'));
		$template->assign_var_from_handle($tpl_var, '_calendar_body');
	}

	// $date is a user format date
	function display_legend()
	{
		global $config, $template, $user, $forums;

		// set the full month & overview switch
		$template->set_switch('full_month', $this->full_month);
		$template->set_switch('java', $this->with_bbcode);

		// full month header
		if ( $this->full_month )
		{
			// day name header
			$set_of_days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			$offset = intval($config->data['calendar_week_start']);
			for ( $i = 0; $i < $this->nb_cells; $i++ )
			{
				if ( $offset >= $this->nb_cells )
				{
					$offset = 0;
				}
				$template->assign_block_vars('full_month.cal_cell', array(
					'WIDTH' => floor(100 / $this->nb_cells),
					'L_DAY' => $user->lang($set_of_days[$offset]),
				));
				$offset++;
				if ( $i == 0 )
				{
					$template->set_switch('full_month.cal_cell.left');
				}
				else if ( $i == ($this->nb_cells - 1) )
				{
					$template->set_switch('full_month.cal_cell.right');
				}
				else
				{
					$template->set_switch('full_month.cal_cell.regular');
				}
			}

			// next/previous month
			$prev = date('Ym', $this->start_date) > 197101 ? date('Ymd', mktime(0, 0, 0, date('m', $this->start_date), 00, date('Y', $this->start_date))) : date('Ymd', $this->start_date);
			$next = date('Ym', $this->start_date) < 206912 ? date('Ymd', mktime(0, 0, 0, date('m', $this->start_date) + 1, 01, date('Y', $this->start_date))) : date('Ymd', $this->start_date);

			// header fields
			$template->assign_vars(array(
				'S_MONTH' => $this->get_select_monthes($this->start_date),
				'S_YEAR' => $this->get_select_years($this->start_date),
				'S_FORUM_LIST' => $forums->get_jumpbox(true, $this->forum_id),
				'POST_FORUM_URL' => POST_FORUM_URL,
				'L_GO' => $user->lang('Go'),
				'I_GO' => $user->img('cmd_mini_submit'),

				'U_PREC' => $config->url('calendar', array('date' => $prev, POST_FORUM_URL => $this->forum_id), true),
				'L_PREC' => $user->lang('Previous'),
				'I_PREC' => $user->img('cmd_previous'),
				'U_NEXT' => $config->url('calendar', array('date' => $next, POST_FORUM_URL => $this->forum_id), true),
				'L_NEXT' => $user->lang('Next'),
				'I_NEXT' => $user->img('cmd_next'),
			));
		}
		// single row header
		else
		{
			$template->assign_vars(array(
				'I_CALENDAR_LRG' => $user->img('icon_calendar'),
			));
			if ( $this->with_bbcode )
			{
				$template->assign_vars(array(
					'TOGGLE_ICON' => $config->data['calendar_display_open'] ? $user->img('up_arrow') : $user->img('down_arrow'),
					'TOGGLE_STATUS' => $config->data['calendar_display_open'] ? '' : 'none',
				));
			}
			$template->set_switch('full_month_ELSE.java', $this->with_bbcode);
		}

		// header
		$template->assign_vars(array(
			'UP_ARROW' => $user->img('up_arrow'),
			'DOWN_ARROW' => $user->img('down_arrow'),

			'ACTION' => $config->url('calendar', '', true),
			'SPAN_ALL' => $this->nb_cells,
			'WIDTH' => floor(100 / $this->nb_cells),
		));
	}

	function get_select_monthes($date)
	{
		global $user;

		// build select list for month
		$month = intval(date('m', $date));
		$options = '';
		$monthes = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		for ( $i = 0; $i < 12; $i++ )
		{
			$selected = ($month == ($i + 1)) ? ' selected="selected"' : '';
			$options .= '<option value="' . ($i + 1) . '"' . $selected . '>' . $user->lang($monthes[$i]) . '</option>';
		}
		return $options;
	}

	function get_select_years($date)
	{
		// buid select list for year
		$year = intval(date('Y', $date));
		$options = '';
		for ( $i = 1971; $i < 2070; $i++ )
		{
			$selected = ($year == $i) ? ' selected="selected"' : '';
			$options .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
		}
		return $options;
	}

	function set_user_date_format()
	{
		global $user;

		$user->data['user_date_order'] = array(
			'y' => strpos(' ' . strtolower($user->data['user_dateformat']), 'y')-1,
			'm' => (strpos(' ' . strtolower($user->data['user_dateformat']), 'm')-1 >= 0) ? strpos(' ' . strtolower($user->data['user_dateformat']), 'm')-1 : strpos(' ' . $user->data['user_dateformat'], 'n')-1,
			'd' => (strpos(' ' . $user->data['user_dateformat'], 'd')-1 >= 0) ? strpos(' ' . $user->data['user_dateformat'], 'd')-1 : strpos(' ' . $user->data['user_dateformat'], 'j')-1,
			'D' => strpos(' ' . $user->data['user_dateformat'], 'D')-1,
		);
		asort($user->data['user_date_order']);
		$user->data['user_date_order'] = array_flip(array_keys($user->data['user_date_order']));
		$pres = array('y' => 'Y', 'm' => 'M', 'd' => 'd', 'D' => 'D');
		$user->data['user_dateformat_short'] = '';
		$user->data['user_dateformat_medium'] = '';
		foreach ( $user->data['user_date_order'] as $key => $dummy )
		{
			if ( $key != 'D' )
			{
				$user->data['user_dateformat_short'] .= (empty($user->data['user_dateformat_short']) ? '' : ' ') . $pres[$key];
			}
			$user->data['user_dateformat_medium'] .= (empty($user->data['user_dateformat_short']) ? '' : ' ') . $pres[$key];
		}
	}
}

class calendar_scheduler extends calendar
{
	var $start_time;
	var $end_time;

	function calendar_scheduler()
	{
		parent::calendar();
		$this->with_text = false;
	}

	// date is a user format date
	function display($date=0, $hour=0, $forum_id=0)
	{
		global $config, $user;
		global $calendar_modules;

		$this->forum_id = intval($forum_id);
		$this->full_month = true;
		$this->nb_cells = 7;
		$this->with_text = false;
		$this->with_bbcode = $config->data['calendar_use_java'];

		// the date entered is a user date : pull it to the begining of the day for the user
		if ( empty($date) || (date('Ymd', $date) < 19700102) )
		{
			$date = $user->cvt_sys_to_user_date(time());
		}
		$date = day_user_date($date);

		// pull the dates to the first of the month & next month
		$this->start_date = mktime(0, 0, 0, date('m', $date), 01, date('Y', $date));
		$this->end_date = mktime(0, 0, 0, date('m', $this->start_date) + 1, 01, date('Y', $this->start_date));

		// whole day
		if ( ($hour < 1) || ($hour > 24) )
		{
			$this->start_time = day_user_date($date);
			$this->end_time = day_user_date($date, +1);
		}
		// one hour in the day
		else
		{
			$this->start_time = mktime($hour - 1, 0, 0, date('m', $date), date('d', $date), date('Y', $date));
			$this->end_time = $this->start_time + 3600;
		}

		//
		// display the month box
		//

		// get the number of cells per line, the offset of the first day, and the number of rows (a day can have 23 to 25 hours : DST, so use round())
		$offset = isset($config->data['calendar_week_start']) ? intval($config->data['calendar_week_start']) : 1;
		$this->start_inc = date('w', $this->start_date) - $offset;
		if ( $this->start_inc < 0 )
		{
			$this->start_inc = $this->nb_cells + $this->start_inc;
		}
		$this->nb_rows = intval(($this->start_inc + round(($this->end_date - $this->start_date) / 86400)) / $this->nb_cells) + 1;

		// init event queue
		$calendar_event_queue = new calendar_month_event_queue();

		// browse calendar event types
		$count_calendar_modules = count($calendar_modules);
		for ( $i = 0; $i < $count_calendar_modules; $i++ )
		{
			$event_type = $calendar_modules[$i];
			$$event_type = new $event_type($calendar_event_queue);
			$$event_type->read($this->start_date, $this->end_date, $this->with_text, $this->forum_id);
		}

		// map the events
		$calendar_event_queue->map($this->start_date, $this->end_date);

		// display
		$this->display_legend($calendar_event_queue);
		$calendar_event_queue->display($this->start_date, $this->start_time, $this->nb_rows, $this->nb_cells, $this->full_month, $this->start_inc, $this->with_text, $this->with_bbcode);

		//
		// display the events lists
		//
		$calendar_event_queue->display_list($this->start_time, $this->end_time);
	}

	// $date is a user format date
	function display_legend(&$calendar_event_queue, $single=true)
	{
		global $config, $template, $user, $forums;

		// day name header
		$set_of_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$set_of_days = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
		$offset = intval($config->data['calendar_week_start']);
		for ( $i = 0; $i < $this->nb_cells; $i++ )
		{
			if ( $offset >= $this->nb_cells )
			{
				$offset = 0;
			}
			$template->assign_block_vars('cal_cell', array(
				'WIDTH' => floor(100 / $this->nb_cells),
				'L_DAY' => $user->lang($set_of_days[$offset]),
			));
			$offset++;
			if ( $i == 0 )
			{
				$template->set_switch('cal_cell.left');
			}
			else if ( $i == ($this->nb_cells - 1) )
			{
				$template->set_switch('cal_cell.right');
			}
			else
			{
				$template->set_switch('cal_cell.regular');
			}
		}

		// next/previous month
		$prev = date('Ym', $this->start_date) > 197101 ? date('Ymd', mktime(0, 0, 0, date('m', $this->start_date), 00, date('Y', $this->start_date))) : date('Ymd', $this->start_date);
		$next = date('Ym', $this->start_date) < 206912 ? date('Ymd', mktime(0, 0, 0, date('m', $this->start_date) + 1, 01, date('Y', $this->start_date))) : date('Ymd', $this->start_date);

		// header fields
		$template->assign_vars(array(
			'L_MONTH' => $user->lang($set_of_months[ (date('m', $this->start_date) - 1) ]),
			'YEAR' => date('Y', $this->start_date),
		));
		$template->assign_vars(array(
			'S_MONTH' => $this->get_select_monthes($this->start_date),
			'S_YEAR' => $this->get_select_years($this->start_date),
			'S_FORUM_LIST' => $forums->get_jumpbox(true, $this->forum_id),
			'POST_FORUM_URL' => POST_FORUM_URL,
			'L_GO' => $user->lang('Go'),
			'I_GO' => $user->img('cmd_mini_submit'),

			'U_PREC' => $config->url('calendar_scheduler', array('date' => $prev, POST_FORUM_URL => $this->forum_id), true),
			'L_PREC' => $user->lang('Previous'),
			'I_PREC' => $user->img('cmd_previous'),
			'U_NEXT' => $config->url('calendar_scheduler', array('date' => $next, POST_FORUM_URL => $this->forum_id), true),
			'L_NEXT' => $user->lang('Next'),
			'I_NEXT' => $user->img('cmd_next'),
		));
		$template->set_switch('selector', $single);
	}
}

?>