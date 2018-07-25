<?php
//-- mod : categories hierarchy ------------------------------------------------
//-- mod : dhtml admin slide menu -------------------------------------------
/***************************************************************************
 *                             (admin) index.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: index.php,v 1.40.2.8 2005/09/18 16:17:20 acydburn Exp $
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

define('IN_PHPBB', 1);

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

// ---------------
// Begin functions
//
function inarray($needle, $haystack)
{ 
	for($i = 0; $i < sizeof($haystack); $i++ )
	{ 
		if( $haystack[$i] == $needle )
		{ 
			return true; 
		} 
	} 
	return false; 
}
//
// End functions
// -------------

//
// Generate relevant output
//
if( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'left' )
{
	$dir = @opendir(".");

	$setmodules = 1;
	while( $file = @readdir($dir) )
	{
//-- mod : categories hierarchy ------------------------------------------------
//-- add
		if ( in_array(str_replace('.' . $phpEx, '', $file), $denied_scripts) )
		{
			$file = '';
		}
//-- fin mod : categories hierarchy --------------------------------------------
		if( preg_match("/^admin_.*?\." . $phpEx . "$/", $file) )
		{
			include('./' . $file);
		}
	}

	@closedir($dir);

	unset($setmodules);

	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
		"body" => "admin/index_navigate.tpl")
	);

	$template->assign_vars(array(
		"U_FORUM_INDEX" => append_sid("../index.$phpEx"),
		"U_ADMIN_INDEX" => append_sid("index.$phpEx?pane=right"),
//+MOD: DHTML Menu for ACP
		'COOKIE_NAME'	=> $board_config['cookie_name'],
		'COOKIE_PATH'	=> $board_config['cookie_path'],
		'COOKIE_DOMAIN'	=> $board_config['cookie_domain'],
		'COOKIE_SECURE'	=> $board_config['cookie_secure'],
//-MOD: DHTML Menu for ACP
		"L_FORUM_INDEX" => $lang['Main_index'],
		"L_ADMIN_INDEX" => $lang['Admin_Index'], 
		"L_PREVIEW_FORUM" => $lang['Preview_forum'])
	);

	ksort($module);
//+MOD: DHTML Menu for ACP
	$menu_cat_id = 0;
//-MOD: DHTML Menu for ACP
	while( list($cat, $action_array) = each($module) )
	{
		$cat = ( !empty($lang[$cat]) ) ? $lang[$cat] : preg_replace("/_/", " ", $cat);

		$template->assign_block_vars("catrow", array(
//+MOD: DHTML Menu for ACP
			'MENU_CAT_ID' => $menu_cat_id,
			'MENU_CAT_ROWS' => count($action_array),
//-MOD: DHTML Menu for ACP
		"ADMIN_CATEGORY" => $cat)
		);

		ksort($action_array);

		$row_count = 0;
		while( list($action, $file)	= each($action_array) )
		{
			$row_color = ( !($row_count%2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($row_count%2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$action = ( !empty($lang[$action]) ) ? $lang[$action] : preg_replace("/_/", " ", $action);

			$template->assign_block_vars("catrow.modulerow", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class, 
//+MOD: DHTML Menu for ACP
				'ROW_COUNT' => $row_count,
//-MOD: DHTML Menu for ACP
				"ADMIN_MODULE" => $action,
				"U_ADMIN_MODULE" => append_sid($file))
			);
			$row_count++;
		}
//+MOD: DHTML Menu for ACP
		$menu_cat_id++;
//-MOD: DHTML Menu for ACP
	}

	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);
}
elseif( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'right' )
{

	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
		"body" => "admin/index_body.tpl")
	);

	$template->assign_vars(array(
		"L_WELCOME" => $lang['Welcome_phpBB'],
		"L_ADMIN_INTRO" => $lang['Admin_intro'],
		"L_FORUM_STATS" => $lang['Forum_stats'],
		"L_WHO_IS_ONLINE" => $lang['Who_is_Online'],
		"L_USERNAME" => $lang['Username'],
		"L_LOCATION" => $lang['Location'],
		"L_LAST_UPDATE" => $lang['Last_updated'],
		"L_IP_ADDRESS" => $lang['IP_Address'],
		"L_STATISTIC" => $lang['Statistic'],
		"L_VALUE" => $lang['Value'],
		"L_NUMBER_POSTS" => $lang['Number_posts'],
		"L_POSTS_PER_DAY" => $lang['Posts_per_day'],
		"L_NUMBER_TOPICS" => $lang['Number_topics'],
		"L_TOPICS_PER_DAY" => $lang['Topics_per_day'],
		"L_NUMBER_USERS" => $lang['Number_users'],
		"L_USERS_PER_DAY" => $lang['Users_per_day'],
		"L_BOARD_STARTED" => $lang['Board_started'],
		"L_AVATAR_DIR_SIZE" => $lang['Avatar_dir_size'],
		"L_DB_SIZE" => $lang['Database_size'], 
		"L_FORUM_LOCATION" => $lang['Forum_Location'],
		"L_STARTED" => $lang['Login'],
		"L_GZIP_COMPRESSION" => $lang['Gzip_compression'])
	);

	//
	// Get forum statistics
	//
	$total_posts = get_db_stat('postcount');
	$total_users = get_db_stat('usercount');
	$total_topics = get_db_stat('topiccount');

	$start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);

	$boarddays = ( time() - $board_config['board_startdate'] ) / 86400;

	$posts_per_day = sprintf("%.2f", $total_posts / $boarddays);
	$topics_per_day = sprintf("%.2f", $total_topics / $boarddays);
	$users_per_day = sprintf("%.2f", $total_users / $boarddays);

	$avatar_dir_size = 0;

	if ($avatar_dir = @opendir($phpbb_root_path . $board_config['avatar_path']))
	{
		while( $file = @readdir($avatar_dir) )
		{
			if( $file != "." && $file != ".." )
			{
				$avatar_dir_size += @filesize($phpbb_root_path . $board_config['avatar_path'] . "/" . $file);
			}
		}
		@closedir($avatar_dir);

		//
		// This bit of code translates the avatar directory size into human readable format
		// Borrowed the code from the PHP.net annoted manual, origanally written by:
		// Jesse (jesse@jess.on.ca)
		//
		if($avatar_dir_size >= 1048576)
		{
			$avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . " MB";
		}
		else if($avatar_dir_size >= 1024)
		{
			$avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . " KB";
		}
		else
		{
			$avatar_dir_size = $avatar_dir_size . " Bytes";
		}

	}
	else
	{
		// Couldn't open Avatar dir.
		$avatar_dir_size = $lang['Not_available'];
	}

	if($posts_per_day > $total_posts)
	{
		$posts_per_day = $total_posts;
	}

	if($topics_per_day > $total_topics)
	{
		$topics_per_day = $total_topics;
	}

	if($users_per_day > $total_users)
	{
		$users_per_day = $total_users;
	}

	//
	// DB size ... MySQL only
	//
	// This code is heavily influenced by a similar routine
	// in phpMyAdmin 2.2.0
	//
	if( preg_match("/^mysql/", SQL_LAYER) )
	{
		$sql = "SELECT VERSION() AS mysql_version";
		if($result = $db->sql_query($sql))
		{
			$row = $db->sql_fetchrow($result);
			$version = $row['mysql_version'];

			if( preg_match("/^(3\.23|4\.|5\.)/", $version) )
			{
				$db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)|(5\.)/", $version) ) ? "`$dbname`" : $dbname;

				$sql = "SHOW TABLE STATUS 
					FROM " . $db_name;
				if($result = $db->sql_query($sql))
				{
					$tabledata_ary = $db->sql_fetchrowset($result);

					$dbsize = 0;
					for($i = 0; $i < count($tabledata_ary); $i++)
					{
						if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
						{
							if( $table_prefix != "" )
							{
								if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
								{
									$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
								}
							}
							else
							{
								$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
							}
						}
					}
				} // Else we couldn't get the table status.
			}
			else
			{
				$dbsize = $lang['Not_available'];
			}
		}
		else
		{
			$dbsize = $lang['Not_available'];
		}
	}
	else if( preg_match("/^mssql/", SQL_LAYER) )
	{
		$sql = "SELECT ((SUM(size) * 8.0) * 1024.0) as dbsize 
			FROM sysfiles"; 
		if( $result = $db->sql_query($sql) )
		{
			$dbsize = ( $row = $db->sql_fetchrow($result) ) ? intval($row['dbsize']) : $lang['Not_available'];
		}
		else
		{
			$dbsize = $lang['Not_available'];
		}
	}
	else
	{
		$dbsize = $lang['Not_available'];
	}

	if ( is_integer($dbsize) )
	{
		if( $dbsize >= 1048576 )
		{
			$dbsize = sprintf("%.2f MB", ( $dbsize / 1048576 ));
		}
		else if( $dbsize >= 1024 )
		{
			$dbsize = sprintf("%.2f KB", ( $dbsize / 1024 ));
		}
		else
		{
			$dbsize = sprintf("%.2f Bytes", $dbsize);
		}
	}

	$template->assign_vars(array(
		"NUMBER_OF_POSTS" => $total_posts,
		"NUMBER_OF_TOPICS" => $total_topics,
		"NUMBER_OF_USERS" => $total_users,
		"START_DATE" => $start_date,
		"POSTS_PER_DAY" => $posts_per_day,
		"TOPICS_PER_DAY" => $topics_per_day,
		"USERS_PER_DAY" => $users_per_day,
		"AVATAR_DIR_SIZE" => $avatar_dir_size,
		"DB_SIZE" => $dbsize, 
		"GZIP_COMPRESSION" => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'])
	);
	//
	// End forum statistics
	//

	//
	// Get users online information.
	//
	$sql = "SELECT u.user_id, u.username, u.user_session_time, u.user_session_page, s.session_logged_in, s.session_ip, s.session_start 
		FROM " . USERS_TABLE . " u, " . SESSIONS_TABLE . " s
		WHERE s.session_logged_in = " . TRUE . " 
			AND u.user_id = s.session_user_id 
			AND u.user_id <> " . ANONYMOUS . " 
			AND s.session_time >= " . ( time() - 300 ) . " 
		ORDER BY u.user_session_time DESC";
//-- mod : categories hierarchy ------------------------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT u.user_allow_viewonline, u.user_level, s.session_page, ', $sql);
//-- fin mod : categories hierarchy --------------------------------------------
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain regd user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_reg = $db->sql_fetchrowset($result);

	$sql = "SELECT session_page, session_logged_in, session_time, session_ip, session_start   
		FROM " . SESSIONS_TABLE . "
		WHERE session_logged_in = 0
			AND session_time >= " . ( time() - 300 ) . "
		ORDER BY session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain guest user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_guest = $db->sql_fetchrowset($result);

//-- mod : categories hierarchy ------------------------------------------------
//-- delete
/*
	$sql = "SELECT forum_name, forum_id
		FROM " . FORUMS_TABLE;
	if($forums_result = $db->sql_query($sql))
	{
		while($forumsrow = $db->sql_fetchrow($forums_result))
		{
			$forum_data[$forumsrow['forum_id']] = $forumsrow['forum_name'];
		}
	}
	else
	{
		message_die(GENERAL_ERROR, "Couldn't obtain user/online forums information.", "", __LINE__, __FILE__, $sql);
	}
*/
//-- add
	// includes
	include($config->url('includes/class_forums'));
	include($config->url('includes/class_stats'));

	// read forums
	$forums = new forums();
	$forums->read();
	foreach ( $forums->data as $id => $data )
	{
		$forum_data[$id] = $user->lang($data['forum_name']);
	}

	// prepare stats
	$stats = new stats();
	$user_levels = $stats->get_user_levels();

	// get user auths
	$user->get_cache(POST_FORUM_URL);
//-- fin mod : categories hierarchy --------------------------------------------

	$reg_userid_ary = array();

	if( count($onlinerow_reg) )
	{
		$registered_users = 0;

		for($i = 0; $i < count($onlinerow_reg); $i++)
		{
			if( !inarray($onlinerow_reg[$i]['user_id'], $reg_userid_ary) )
			{
				$reg_userid_ary[] = $onlinerow_reg[$i]['user_id'];

				$username = $onlinerow_reg[$i]['username'];

//-- mod : categories hierarchy ------------------------------------------------
//-- delete
/*
				if( $onlinerow_reg[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
				{
					$registered_users++;
					$hidden = FALSE;
				}
				else
				{
					$hidden_users++;
					$hidden = TRUE;
				}

				if( $onlinerow_reg[$i]['user_session_page'] < 1 )
*/
//-- add
				$row = $onlinerow_reg[$i];
				if ( $row['user_allow_viewonline'] )
				{
					$registered_users++;
				}
				else
				{
					$hidden_users++;
				}
				if ( $row['user_allow_viewonline'] || ($row['user_id'] == $user->data['user_id']) || ($user->data['user_level'] == ADMIN) || ($user->auth(POST_FORUM_URL, 'auth_mod', intval($row['session_page'])) && ($row['user_level'] != ADMIN)) )
				{
					$hidden = false;
					$style = isset($user_levels[ $row['user_level'] ]) ? $user_levels[ $row['user_level'] ]['style'] : $user_levels[USER]['style'];
					$username = sprintf(($row['user_allow_viewonline'] ? (empty($style) ? '%s' : '<span' . $style . '>%s</span>') : '<i' . $style . '>%s</i>'), $row['username']);
				}
				else
				{
					$hidden = true;
				}

				// display the page
				if ( ($row['session_page'] < 1) || !$user->auth(POST_FORUM_URL, 'auth_view', intval($row['session_page'])) )
//-- fin mod : categories hierarchy --------------------------------------------
				{
					switch($onlinerow_reg[$i]['user_session_page'])
					{
						case PAGE_INDEX:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_POSTING:
							$location = $lang['Posting_message'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_LOGIN:
							$location = $lang['Logging_on'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_SEARCH:
							$location = $lang['Searching_forums'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PROFILE:
							$location = $lang['Viewing_profile'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWONLINE:
							$location = $lang['Viewing_online'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWMEMBERS:
							$location = $lang['Viewing_member_list'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PRIVMSGS:
							$location = $lang['Viewing_priv_msgs'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_FAQ:
							$location = $lang['Viewing_FAQ'];
							$location_url = "index.$phpEx?pane=right";
							break;
						default:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
					}
				}
				else
				{
					$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_reg[$i]['user_session_page']);
					$location = $forum_data[$onlinerow_reg[$i]['user_session_page']];
				}

				$row_color = ( $registered_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( $registered_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

				$reg_ip = decode_ip($onlinerow_reg[$i]['session_ip']);

				$template->assign_block_vars("reg_user_row", array(
					"ROW_COLOR" => "#" . $row_color,
					"ROW_CLASS" => $row_class,
					"USERNAME" => $username, 
					"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['session_start'], $board_config['board_timezone']), 
					"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['user_session_time'], $board_config['board_timezone']),
					"FORUM_LOCATION" => $location,
					"IP_ADDRESS" => $reg_ip, 

					"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$reg_ip", 
					"U_USER_PROFILE" => append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $onlinerow_reg[$i]['user_id']),
					"U_FORUM_LOCATION" => append_sid($location_url))
				);
//-- mod : categories hierarchy ------------------------------------------------
//-- add
				$template->set_switch('reg_user_row.light', $registered_users % 2);
//-- fin mod : categories hierarchy --------------------------------------------
			}
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_REGISTERED_USERS_BROWSING" => $lang['No_users_browsing'])
		);
	}

	//
	// Guest users
	//
	if( count($onlinerow_guest) )
	{
		$guest_users = 0;

		for($i = 0; $i < count($onlinerow_guest); $i++)
		{
			$guest_userip_ary[] = $onlinerow_guest[$i]['session_ip'];
			$guest_users++;

			if( $onlinerow_guest[$i]['session_page'] < 1 )
			{
				switch( $onlinerow_guest[$i]['session_page'] )
				{
					case PAGE_INDEX:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_POSTING:
						$location = $lang['Posting_message'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_LOGIN:
						$location = $lang['Logging_on'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_SEARCH:
						$location = $lang['Searching_forums'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PROFILE:
						$location = $lang['Viewing_profile'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWONLINE:
						$location = $lang['Viewing_online'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWMEMBERS:
						$location = $lang['Viewing_member_list'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PRIVMSGS:
						$location = $lang['Viewing_priv_msgs'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_FAQ:
						$location = $lang['Viewing_FAQ'];
						$location_url = "index.$phpEx?pane=right";
						break;
					default:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
				}
			}
			else
			{
				$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_guest[$i]['session_page']);
				$location = $forum_data[$onlinerow_guest[$i]['session_page']];
			}

			$row_color = ( $guest_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( $guest_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

			$guest_ip = decode_ip($onlinerow_guest[$i]['session_ip']);

			$template->assign_block_vars("guest_user_row", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				"USERNAME" => $lang['Guest'],
				"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_start'], $board_config['board_timezone']), 
				"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_time'], $board_config['board_timezone']),
				"FORUM_LOCATION" => $location,
				"IP_ADDRESS" => $guest_ip, 

				"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$guest_ip", 
				"U_FORUM_LOCATION" => append_sid($location_url))
			);
//-- mod : categories hierarchy ------------------------------------------------
//-- add
			$template->set_switch('guest_user_row.light', $guest_users % 2);
//-- fin mod : categories hierarchy --------------------------------------------
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_GUESTS_BROWSING" => $lang['No_users_browsing'])
		);
	}

	// Check for new version
//-- mod : categories hierarchy ------------------------------------------------
//-- delete
/*
	$current_version = explode('.', '2' . $board_config['version']);
	$minor_revision = (int) $current_version[2];

	$errno = 0;
	$errstr = $version_info = '';

	if ($fsock = @fsockopen('www.phpbb.com', 80, $errno, $errstr, 10))
	{
		@fputs($fsock, "GET /updatecheck/20x.txt HTTP/1.1\r\n");
		@fputs($fsock, "HOST: www.phpbb.com\r\n");
		@fputs($fsock, "Connection: close\r\n\r\n");

		$get_info = false;
		while (!@feof($fsock))
		{
			if ($get_info)
			{
				$version_info .= @fread($fsock, 1024);
			}
			else
			{
				if (@fgets($fsock, 1024) == "\r\n")
				{
					$get_info = true;
				}
			}
		}
		@fclose($fsock);

		$version_info = explode("\n", $version_info);
		$latest_head_revision = (int) $version_info[0];
		$latest_minor_revision = (int) $version_info[2];
		$latest_version = (int) $version_info[0] . '.' . (int) $version_info[1] . '.' . (int) $version_info[2];

		if ($latest_head_revision == 2 && $minor_revision == $latest_minor_revision)
		{
			$version_info = '<p style="color:green">' . $lang['Version_up_to_date'] . '</p>';
		}
		else
		{
			$version_info = '<p style="color:red">' . $lang['Version_not_up_to_date'];
			$version_info .= '<br />' . sprintf($lang['Latest_version_info'], $latest_version) . ' ' . sprintf($lang['Current_version_info'], '2' . $board_config['version']) . '</p>';
		}
	}
	else
	{
		if ($errstr)
		{
			$version_info = '<p style="color:red">' . sprintf($lang['Connect_socket_error'], $errstr) . '</p>';
		}
		else
		{
			$version_info = '<p>' . $lang['Socket_functions_disabled'] . '</p>';
		}
	}
	
	$version_info .= '<p>' . $lang['Mailing_list_subscribe_reminder'] . '</p>';
*/
//-- add
	// installed mods
	$mod_installed = array(
		'phpBB group' => array(
			'server' => 'www.phpbb.com',
			'root' => '/updatecheck/',
			'file' => '20x.txt',
			'page' => 'http://www.phpbb.com/downloads.php',
			'protocol' => 'phpBB',
			'infos' => 'Mailing_list_subscribe_reminder',
			'mods' => array(
				'version' => array('head' => '2', 'desc' => 'phpBB'),
			),
		),
		'Ptirhiik' => array(
			'server' => 'ptifo.clanmckeen.com',
			'root' => '/download/',
			'file' => 'versions.dta',
			'page' => 'http://ptifo.clanmckeen.com/download.php',
			'protocol' => 'native',
			'mods' => array(
				'mod_cat_hierarchy' => array('desc' => 'Lang_extend_cat_hierarchy'),
				'mod_topic_calendar_CH' => array('desc' => 'Lang_extend_calendar'),
				'mod_extended_tpl_CH' => array('desc' => 'Extended_template_CH'),
			),
		),
	);

	// we don't want to check at any time : do it only once a day
	define('VERSION_CHECK_DELAY', 86400);
	$now = time();
	$version_check_delay = intval($config->data['version_check_delay']);
	$check = _button('vchk') || empty($version_check_delay) || (($now - $version_check_delay) > VERSION_CHECK_DELAY);

	// try to open the files
	$mod_available = array();
	$version_info = '';
	foreach ( $mod_installed as $provider => $provided )
	{
		if ( $check )
		{
			$config->set('version_check_delay', $now, true);
			$mod_installed[$provider]['errno'] = 0;
			$mod_installed[$provider]['errstr'] = '';
			if ( $fsock = @fsockopen($provided['server'], 80, $mod_installed[$provider]['errno'], $mod_installed[$provider]['errstr'], 10) )
			{
				@fputs($fsock, "GET " . $provided['root'] . $provided['file'] . " HTTP/1.1\r\n");
				@fputs($fsock, "HOST: " . $provided['server'] . "\r\n");
				@fputs($fsock, "Connection: close\r\n\r\n");

				$get_info = false;
				$available = '';
				while ( !@feof($fsock) )
				{
					if ( $get_info )
					{
						$available .= @fread($fsock, 1024);
					}
					else
					{
						if ( @fgets($fsock, 1024) == "\r\n" )
						{
							$get_info = true;
						}
					}
				}
				@fclose($fsock);

				$available = empty($available) ? array() : explode("\n", $available);
				$count_available = count($available);
				switch ( $provided['protocol'] )
				{
					case 'native':
						for ( $i = 0; $i < $count_available; $i++ )
						{
							$str = trim(str_replace(array("\r", "\n"), array('', ''), $available[$i]));
							$line = empty($str) ? array() : explode(':', $str);
							$mod_name = trim($line[0]);
							$mod_version = trim($line[1]);
							if ( !empty($mod_name) && !empty($mod_version) && isset($mod_installed[$provider]['mods'][$mod_name]) )
							{
								$mod_installed[$provider]['mods'][$mod_name]['version'] = $mod_version;
							}
						}
						break;
					case 'phpBB':
						for ( $i = 0; $i < $count_available; $i++ )
						{
							$str = trim(str_replace("\r", '', $available[$i]));
							$available[$i] = (int) $str;
						}
						$mod_name = _first_key($mod_installed[$provider]['mods']);
						$mod_version = implode('.', $available);
						if ( !empty($mod_name) && !empty($mod_version) && isset($mod_installed[$provider]['mods'][$mod_name]) )
						{
							$mod_installed[$provider]['mods'][$mod_name]['version'] = $mod_version;
						}
						break;
				}
			}
		}

		// display actualized data
		$u_provider = empty($mod_installed[$provider]['page']) ? $provider : '<a href="' . $mod_installed[$provider]['page'] . '" target="_blank">' . $provider . '</a>';
		if ( $mod_installed[$provider]['errno'] )
		{
			if ( $mod_installed[$provider]['errstr'] )
			{
				$version_info .= '<p style="color:red">' . $u_provider . ': ' . sprintf($user->lang('Connect_socket_error'), $mod_installed[$provider]['errstr']) . '<br />';
			}
			else
			{
				$version_info .= '<p>' . $u_provider . ': ' . $user->lang('Socket_functions_disabled') . '<br />';
			}
		}
		else
		{
			$version_info .= '<p style="color:blue"><b><u>' . $u_provider . '</u></b><br />';
		}

		// dump the mods
		if ( !empty($mod_installed[$provider]['mods']) )
		{
			foreach ( $mod_installed[$provider]['mods'] as $mod_name => $mod_data )
			{
				if ( isset($config->data[$mod_name]) )
				{
					$current_version = $mod_installed[$provider]['mods'][$mod_name]['head'] . $config->data[$mod_name];
					if ( isset($mod_installed[$provider]['mods'][$mod_name]['version']) )
					{
						$color = '<span style="color:' . (isset($config->data[$mod_name]) ? ($mod_installed[$provider]['mods'][$mod_name]['version'] == $current_version ? 'green' : 'red') : 'brown') . '">%s</span>';
					}
					else
					{
						$color = '%s';
					}
					$version_info .= sprintf($color, sprintf($user->lang(isset($mod_installed[$provider]['mods'][$mod_name]['version']) ? 'version_checked' : 'version_not_checked'), $user->lang($mod_installed[$provider]['mods'][$mod_name]['desc']), isset($config->data[$mod_name]) ? $current_version : $user->lang('Unknown'), $mod_installed[$provider]['mods'][$mod_name]['version'])) . '<br />';
				}
			}
		}
		$version_info .= '</p>';
		if ( !empty($mod_installed[$provider]['infos']) )
		{
			$version_info .= '<p>' . $user->lang($mod_installed[$provider]['infos']) . '</p>';
		}
	}
	$version_info = '<a href="' . $config->url('admin/index', array('pane' => 'right', 'vchk' => true), true) . '" class="gen"><img src="' . $user->img('cmd_check') . '" border="0" class="absbottom" /></a><br /><br />' . $version_info;
//-- fin mod : categories hierarchy --------------------------------------------
	

	$template->assign_vars(array(
		'VERSION_INFO'	=> $version_info,
		'L_VERSION_INFORMATION'	=> $lang['Version_information'])
	);

	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);

}
else
{
	//
	// Generate frameset
	//
	$template->set_filenames(array(
		"body" => "admin/index_frameset.tpl")
	);

	$template->assign_vars(array(
		"S_FRAME_NAV" => append_sid("index.$phpEx?pane=left"),
		"S_FRAME_MAIN" => append_sid("index.$phpEx?pane=right"))
	);

	header ("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	$template->pparse("body");

	$db->sql_close();
	exit;

}

?>