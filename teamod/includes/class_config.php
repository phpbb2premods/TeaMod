<?php
//-- mod : BBcode Box Reloaded (BBcBxR) CH Edition -----------------------------
//-- fix CQ du 6 nov 2005 pour CH 2.1.4-----------------------------------------
/***************************************************************************
 *							class_config.php
 *							----------------
 *	begin		: 25/08/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *   Version      : 0.0.24 - 06/11/2005
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

//--------------
// debug
// I strongly recommand to let those lines commented 
// and to uncomment them only at debug purpose
//--------------
define('DEBUG_RUN_STATS', true); // uncomment this line to see the run stats
// define('DEBUG_SQL', true); // uncomment this line to see the sql dump
// define('DEBUG_SQL_ADMIN', true); // uncomment this line to see the sql dump in admin
// define('DEBUG_MESSAGES', true); // uncomment this line to dump who has sent an information messages
// define('DEBUG_TEMPLATE', true); // uncomment this line to add a comment with the tpl name
//--------------

define('CH_CURRENT_VERSION', '2.1.4');

// tables
define('USERS_CACHE_TABLE', $table_prefix . 'users_cache');
define('PRESETS_TABLE', $table_prefix . 'presets');
define('PRESETS_DATA_TABLE', $table_prefix . 'presets_data');
define('ICONS_TABLE', $table_prefix . 'icons');
define('CP_PATCHES_TABLE', $table_prefix . 'cp_patches');
define('CP_PANELS_TABLE', $table_prefix . 'cp_panels');
define('CP_FIELDS_TABLE', $table_prefix . 'cp_fields');
define('AUTHS_TABLE', $table_prefix . 'auths');
define('AUTHS_DEF_TABLE', $table_prefix . 'auths_def');
define('TOPICS_ATTR_TABLE', $table_prefix . 'topics_attr');
//-- mod : bbcode box reloaded -------------------------------------------------
//-- add
define('BBC_BOX_TABLE', $table_prefix . 'bbc_box');
//-- fin mod : bbcode box reloaded ---------------------------------------------
define('POST_AUTHS_URL', 'a');
define('POST_FIELDS_URL', 'd');
define('POST_PANELS_URL', 'm');
define('POST_LINK_URL', 'l');

// special group
define('NO_GROUP', -9999999);
define('GROUP_OWN', -3);
define('GROUP_ALL', -4);
define('GROUP_FRIENDS', -5);
define('GROUP_FOES', -6);

// define group status
define('GROUP_STANDARD', 0);
define('GROUP_SYSTEM', 3);
define('GROUP_SPECIAL', 5);

// data type
define('TYPE_INT', 1);
define('TYPE_NO_HTML', 2);
define('TYPE_NO_TAGS', 3);
define('TYPE_FLOAT', 4);
define('TYPE_HTML', 5);

// tree drawing
define('TREE_HSPACE', 'H');
define('TREE_VSPACE', 'V');
define('TREE_CROSS', 'X');
define('TREE_CLOSE', 'C');

// 3- & 4- boolean
define('DENY', 2);
define('FORCE', 4);

// keep unread
define('KEEP_UNREAD_DB', 2);

// board announces
define('BOARD_GLOBAL_ANNOUNCES', 1);
define('BOARD_PARENT_ANNOUNCES', 2);
define('BOARD_CHILD_ANNOUNCES', 3);
define('BOARD_BRANCH_ANNOUNCES', 4);

// global announces split title only
define('SPLIT_IN_BOX', 1);
define('TITLE_ONLY', 2);

// message mode
define('USE_DEFAULT', 0);
define('BY_PM', 1);
define('BY_MAIL', 2);

// calendar
define('POST_BIRTHDAY', 9);
define('POST_CALENDAR', 10);
$calendar_days_of_week = array(
	'0' => 'Sunday',
	'1' => 'Monday',
	'2' => 'Tuesday',
	'3' => 'Wednesday',
	'4' => 'Thursday',
	'5' => 'Friday',
	'6' => 'Saturday',
);

// denied admin scripts : yes of course, everybody have read the mod install description...
$denied_scripts = !defined('IN_ADMIN') ? array() : array(
	'admin_forum_prune',
	'admin_forumauth',
	'admin_ug_auth',
);

// debug
function _dump($message, $location='', $line='', $file='')
{
	global $lang;

	if ( empty($lang) )
	{
		$lang = array(
			'dbg_location' => 'Location',
			'dbg_line' => 'Line',
			'dbg_file' => 'File',
			'dbg_empty' => 'Empty',
		);
	}

	echo '<div class="gen"><pre>' . ( empty($location) ? '' : '<u><b>' . $lang['dbg_location'] . ':</b> ' . $location . '</u>' . ( empty($line) ? '' : ' ' . $lang['dbg_line'] . ': ' . $line ) . ( empty($file) ? '' : ' ' . $lang['dbg_file'] . ': ' . $file ) . '<br />');
	if ( empty($message) )
	{
		echo $lang['dbg_empty'];
	}
	else if ( is_array($message) || is_object($message) )
	{
		print_r($message);
	}
	else
	{
		echo str_replace("\t", '&nbsp;&nbsp;', htmlspecialchars($message));
	}
	echo '</pre></div>';
}

function convert_microtime($time)
{
	list($usec, $sec) = explode(' ', $time);
	return ( (float)$usec + (float)$sec );
}

function _marker_start()
{
	global $trc_loc_start;
	$trc_loc_start = microtime();
}

function _marker_stop()
{
	global $trc_loc_end;
	$trc_loc_end = microtime();
}

// various sys func
function _first_key($ary)
{
	if ( empty($ary) || !is_array($ary) )
	{
		return false;
	}
	@reset($ary);
	list($res, ) = @each($ary);
	return $res;
}

function _type_cast($val, $type, $list=array(), $escape_html=true)
{
	switch ( $type )
	{
		case TYPE_INT: // integer
			$val = intval($val);
			break;
		case TYPE_FLOAT: // numeric
			$val = doubleval($val);
			break;
		case TYPE_NO_HTML: // no slashes nor html
			if ( $escape_html )
			{
				$val = htmlspecialchars(trim($val));
				break;
			}
		case TYPE_NO_TAGS: // ie username
			if ( $escape_html )
			{
				$val = htmlspecialchars(strip_tags(phpbb_rtrim($val, '\\')));
				break;
			}
		default:
			if ( !$escape_html )
			{
				$val = _un_htmlspecialchars($val);
			}
			break;
	}
	if ( !empty($list) )
	{
		$str_val = htmlspecialchars((string) $val);
		$int_val = sprintf('%s', intval($val));
		$float_val = sprintf('%01.2f', doubleval($val));
		if ( isset($list[$str_val]) )
		{
			$val = $str_val;
		}
		else if ( isset($list[$int_val]) )
		{
			$val = $int_val;
		}
		else if ( isset($list[$float_val]) )
		{
			$val = $float_val;
		}
		else
		{
			$val = '';
		}
		if ( !isset($list[$val]) )
		{
			$val = _first_key($list);
		}
		$int_val = sprintf('%s', intval($val));
		$float_val = sprintf('%01.2f', doubleval($val));
		if ( $val == $int_val )
		{
			$val = intval($val);
		}
		else if ( $val == $float_val )
		{
			$val = doubleval($val);
		}
	}
	return $val;
}

function _read($var, $type='', $dft='', $list=array(), $no_strip=false)
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS;

	// adjust with dft
	$res = _type_cast($dft, $type, $list, false);

	// read $_* value
	if ( !empty($var) )
	{
		// read parm
		if ( isset($HTTP_POST_VARS[$var]) || isset($HTTP_GET_VARS[$var]) )
		{
			$res = isset($HTTP_POST_VARS[$var]) ? $HTTP_POST_VARS[$var] : $HTTP_GET_VARS[$var];
			if ( !$no_strip )
			{
				$res = trim(stripslashes($res));
			}
		}
	}
	$res = _type_cast($res, $type, $list);
	return $res;
}

function _button($var)
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS;

	// image buttons return an _x and _y value in the $_POST array
	if ( isset($HTTP_POST_VARS[$var . '_x']) && isset($HTTP_POST_VARS[$var . '_y']) )
	{
		$HTTP_POST_VARS[$var] = true;
		unset($HTTP_POST_VARS[$var . '_x']);
		unset($HTTP_POST_VARS[$var . '_y']);
	}
	return (isset($HTTP_POST_VARS[$var]) && !empty($HTTP_POST_VARS[$var])) || (isset($HTTP_GET_VARS[$var]) && intval($HTTP_GET_VARS[$var]));
}

function _hide($key, $value='', $force_empty=false)
{
	global $s_hidden_fields;
	if ( !empty($key) && is_array($key) )
	{
		foreach ( $key as $sub_key => $value )
		{
			_hide($sub_key, $value);
		}
	}
	else if ( (!empty($key) && !empty($value)) || $force_empty )
	{
		$s_hidden_fields .= '<input type="hidden" name="' . addslashes(stripslashes($key)) . '" value="' . addslashes(stripslashes($value)) . '" />';
	}
}

function _hide_set($tpl_varname='S_HIDDEN_FIELDS')
{
	global $s_hidden_fields, $template;
	$template->assign_vars(array($tpl_varname => $s_hidden_fields));
}

function _clean_html($str)
{
	return ereg_replace('<[^>]+>', '', str_replace('<br />', "\n", $str));
}

// borrowed from function_search : quickly remove BBcode.
function _clean_bbcode($str)
{
	$str = preg_replace('/\[img:[a-z0-9]{10,}\].*?\[\/img:[a-z0-9]{10,}\]/', ' ', $str);
	$str = preg_replace('/\[\/?url(=.*?)?\]/', ' ', $str);
	$str = preg_replace('/\[\/?[a-z\*=\+\-]+(\:?[0-9a-z]+)?:[a-z0-9]{10,}(\:[a-z0-9]+)?=?.*?\]/', ' ', $str);
	return $str;
}

function _censor($str)
{
	global $censored_words;

	// read data if not already done
	$censored_words->read();
	if ( count($censored_words->data) )
	{
		$str = preg_replace(array_keys($censored_words->data), array_values($censored_words->data), $str);
	}
	return $str;
}

// reverse what htmlspecialchars does, plus replace <br /> with \n
function _un_htmlspecialchars($str)
{
	static $rev_html_translation_table;

	if ( empty($rev_html_translation_table) )
	{
		$rev_html_translation_table = function_exists('get_html_translation_table') ? array_flip(get_html_translation_table(HTML_ENTITIES)) : array('&amp;' => '&', '&#039;' => '\'', '&quot;' => '"', '&lt;' => '<', '&gt;' => '>');
	}
	return strtr(str_replace('<br />', "\n", $str), $rev_html_translation_table);
}

function _format($var, $root=true)
{
	return is_array($var) ? _format_array($var, $root) : (is_integer($var) || is_bool($var) ? intval($var) : '\'' . str_replace('\'', '\\\'', str_replace('\\', '\\\\', preg_replace('/[\n\r]+/', '<br />', htmlspecialchars($var)))) . '\'');
}

function _format_array($var, $root=false)
{
	$res = '';
	if ( !empty($var) )
	{
		foreach ( $var as $key => $val )
		{
			$res .= ( empty($res) ? '' : ', ') . ( is_string($key) ? _format($key, false) . ' => ' : '' ) . _format($val, false);
		}
	}
	return $root ? $res : 'array(' . $res . ')';
}

function _error($key)
{
	global $user;
	global $error, $error_msg;

	if ( !$error )
	{
		$error_msg = '';
	}

	$error = true;
	$error_msg .= ( empty($error_msg) ? '' : '<br /><br />' ) . $user->lang($key);
}

function _warning($key)
{
	global $user;
	global $warning, $warning_msg;

	if ( !$warning )
	{
		$warning_msg = '';
	}

	$warning = true;
	$warning_msg .= ( empty($warning_msg) ? '' : '<br /><br />' ) . $user->lang($key);
}

function message_return($message, $return_txt='', $return_url='', $delay=5)
{
	global $template, $config, $user;

	define('IN_MESSAGE_RETURN', true);

	$message = empty($message) ? '' : (defined('IN_ADMIN') ? '<br />' : '') . $user->lang($message) . '<br /><br />';
	$message .= empty($return_txt) ? '' : sprintf($user->lang($return_txt), '<a href="' . $return_url . '">', '</a>') . '<br /><br />';
	$message .= sprintf($user->lang('Click_return_index'), '<a href="' . (defined('IN_ADMIN') ? $config->url('admin/index', array('pane' => 'right'), true) : $config->url('index', '', true)) . '">', '</a>');
	if ( empty($return_url) )
	{
		$return_url = $config->url('index', '', true);
	}
	if ( defined('DEBUG_MESSAGES') )
	{
		$message .= '<br /><br /></span></td></tr><tr><td class="cat" align="center"><span class="cattitle">' . $user->lang('dbg_backtrace') . '</span></td></tr><tr><td class="row1"><span class="gen">';
		if ( function_exists('debug_backtrace') )
		{
			$dbg = debug_backtrace();
			$count_dbg = count($dbg);
			for ( $i = 0; $i < $count_dbg; $i++ )
			{
				$message .= '<br /><b>' . $user->lang('dbg_requester') . ':</b> ' . basename($dbg[$i]['file']) . '[ ' . $dbg[$i]['line'] . ' ].' . $dbg[$i]['function'] . '(' . (empty($dbg[$i]['args']) ? '' : stripslashes(_format($dbg[$i]['args']))) . ')';
			}
		}
	}
	else
	{
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="' . intval($delay) . ';url=' . $return_url . '">',
		));
	}
	message_die(GENERAL_MESSAGE, $message);
}

function display_buttons($buttons, $tpl_switch='')
{
	global $config, $user, $template;

	if ( !empty($buttons) )
	{
		$tpl_switch .= (empty($tpl_switch) ? '' : '.') . 'buttons';
		foreach ( $buttons as $name => $data )
		{
			$tpl_fields = array(
				'U_BUTTON' => empty($data['url']) ? '' : $config->url($data['url'], $data['parms'], true),
				'L_BUTTON' => $user->lang($data['txt']),
				'I_BUTTON' => $user->img($data['img']),
				'S_BUTTON' => empty($data['key']) ? '' : $user->lang($data['key']),
				'BUTTON' => $name,
			);
			$template->assign_block_vars($tpl_switch, $tpl_fields);
			$template->set_switch($tpl_switch . '.accesskey', !empty($data['key']));
		}
	}
}

// config
class cache_config extends cache
{
	function row_process(&$rows, $id)
	{
		$rows[$id] = $rows[$id]['config_value'];
	}
}

class config_class
{
	var $data;
	var $data_time;
	var $from_cache;
	var $dynamic;
	var $root;
	var $ext;
	var $differ;
	var $recache;

	function config_class()
	{
		global $phpbb_root_path, $phpEx;

		$this->data = array();
		$this->data_time = 0;
		$this->from_cache = false;
		$this->dynamic = array();
		$this->root = &$phpbb_root_path;
		$this->ext = &$phpEx;
		$this->recache = $this->differ = false;
	}

	function read($force=false)
	{
		global $db;

		// get dynamic values
		$sql = 'SELECT config_name, config_value
					FROM ' . CONFIG_TABLE . '
					WHERE config_static = 0';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__, false);
		if ( !$result )
		{
			return false;
		}
		$this->data_time = time();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$this->data[ $row['config_name'] ] = $row['config_value'];
			$this->dynamic[ $row['config_name'] ] = true;
		}

		// default values
		if ( empty($this->data['cache_path']) )
		{
			$this->data['cache_path'] = 'cache/';
			$this->dynamic['cache_path'] = true;
		}

		// get static values
		$db_cached = new cache_config('dta_config', $this->data['cache_path'], $this->data['cache_disabled_cfg']);
		$sql = 'SELECT config_name, config_value
					FROM ' . CONFIG_TABLE . '
					WHERE config_static = ' . true;
		$data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force, 'config_name');
		if ( !empty($data) )
		{
			$this->data = array_merge($this->data, $data);
			unset($data);
			$this->data_time = $db_cached->data_time;
		}
		$this->from_cache = $db_cached->from_cache;

		// define constants for system groups
		define('GROUP_FOUNDER', $this->data['group_founder']);
		define('GROUP_ADMIN', $this->data['group_admin']);
		define('GROUP_REGISTERED', $this->data['group_registered']);
		define('GROUP_ANONYMOUS', $this->data['group_anonymous']);

		return true;
	}

	function begin_transaction()
	{
		$this->differ = true;
	}

	function set($config_name, $config_value, $static=false)
	{
		global $db;

		$this->dynamic[$config_name] = isset($this->data[$config_name]) ? (isset($this->dynamic[$config_name]) ? $this->dynamic[$config_name] : false) : !$static;
		$fields = array(
			'config_name' => $config_name,
			'config_value' => $config_value,
			'config_static' => !$this->dynamic[$config_name],
		);
		$db->sql_statement($fields);
		if ( !isset($this->data[$config_name]) )
		{
			$sql = 'INSERT INTO ' . CONFIG_TABLE . '
						(' . $db->sql_fields . ') VALUES (' . $db->sql_values . ')';
		}
		else
		{
			$sql = 'UPDATE ' . CONFIG_TABLE . '
						SET ' . $db->sql_update . '
						WHERE config_name = \'' . $db->sql_escape_string($config_name) . '\'';
		}
		$db->sql_query($sql, false, __LINE__, __FILE__);
		$this->data[$config_name] = $config_value;
		if ( !$this->dynamic[$config_name] )
		{
			if ( !$this->differ )
			{
				$this->read(true);
				$this->recache = false;
			}
			else
			{
				$this->recache = true;
			}
		}
	}

	function end_transaction()
	{
		if ( $this->differ && $this->recache )
		{
			$this->read(true);
		}
		$this->recache = $this->differ = false;
	}

	function url($basename, $parms=array(), $add_sid=false, $fragments='', $force=false, $external=false)
	{
		global $SID;
		static $script_path;

		$url_parms = '';
		if ( empty($parms) )
		{
			$parms = array();
		}
		if ( $add_sid && empty($parms['sid']) )
		{
			$parms['sid'] = substr($SID, strlen('sid='));
		}
		if ( !empty($parms) )
		{
			foreach ( $parms as $key => $val )
			{
				if ( !empty($key) && (!empty($val) || $force) )
				{
					$url_parms .= (empty($url_parms) ? '?' : '&amp;') . $key . '=' . $val;
				}
			}
		}
		if ( !empty($fragments) )
		{
			$url_parms .= (empty($url_parms) ? '?#' : '#') . $fragments;
		}
		if ( $external && empty($script_path) )
		{
			$script_path = $this->get_script_path();
		}
		return ($external ? $script_path : trim(ereg('^\.\/', $this->root) && $add_sid ? preg_replace('#^(\.\/)(.*)$#', '\2', $this->root) : $this->root)) . $basename . '.' . $this->ext . $url_parms;
	}

	function get_script_path()
	{
		$server_name = (empty($this->data['cookie_secure']) ? 'http://' : 'https://') . trim($this->data['server_name']);
		$server_port = ($this->data['server_port'] == 80 ? '' : ':' . trim($this->data['server_port'])) . '/';
		$script_path = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($this->data['script_path']));
		$script_path = $server_name . $server_port . (empty($script_path) ? '' : $script_path . '/');
		return $script_path;
	}
}

class themes
{
	var $data;
	var $data_time;
	var $from_cache;

	function read($force=false)
	{
		global $config;

		$db_cached = new cache('dta_themes', $config->data['cache_path'], $config->data['cache_disabled_themes']);
		$sql = 'SELECT * 
					FROM ' . THEMES_TABLE;
		$this->data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force, 'themes_id');
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;
	}
}

class ranks
{
	var $data_time;
	var $from_cache;

	function read($force=false)
	{
		global $config;

		$db_cached = new cache('dta_ranks', $config->data['cache_path'], $config->data['cache_disabled_ranks']);
		$sql = 'SELECT * 
					FROM ' . RANKS_TABLE . '
					ORDER BY rank_special, rank_min';
		$data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force);
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;

		return $data;
	}
}

class cache_words extends cache
{
	function row_process(&$rows, &$row_id)
	{
		$row = $rows[$row_id];
		unset($rows[$row_id]);
		$row_id = '#\b(' . str_replace('\*', '\w*?', preg_quote($row['word'], '#')) . ')\b#i';
		$rows[$row_id] = $row['replacement'];
	}
}

class words
{
	var $data;
	var $data_time;
	var $from_cache;
	var $data_flag;

	function read($force=false)
	{
		global $config;

		if ( !$force && $this->data_flag )
		{
			return $this->data;
		}
		$db_cached = new cache_words('dta_words', $config->data['cache_path'], $config->data['cache_disabled_words']);
		$sql = 'SELECT * 
					FROM ' . WORDS_TABLE;
		$this->data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force, 'word');
		$this->data_flag = true;
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;

		return $this->data;
	}
}

class smilies
{
	var $data;
	var $data_time;
	var $from_cache;
	var $data_flag;

	function read($force=false)
	{
		global $config;

		if ( !$force && $this->data_flag )
		{
			return $this->data;
		}
		$db_cached = new cache('dta_smilies', $config->data['cache_path'], $config->data['cache_disabled_smilies']);
		$sql = 'SELECT * 
					FROM ' . SMILIES_TABLE . '
					ORDER BY smilies_id';
		$this->data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force);
		$this->data_flag = true;
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;

		return $this->data;
	}
}

class icons_cache extends cache
{
	var $types;

	function pre_process(&$rows)
	{
		$this->types = array();
	}

	function row_process(&$rows, &$row_id)
	{
		if ( ($rows[$row_id]['icon_types'] === '0') || !empty($rows[$row_id]['icon_types']) )
		{
			$rows[$row_id]['icon_types'] = explode(', ', $rows[$row_id]['icon_types']);
			$count_types = count($rows[$row_id]['icon_types']);
			for ($i = 0; $i < $count_types; $i++ )
			{
				$this->types[ $rows[$row_id]['icon_types'][$i] ] = $row_id;
			}
		}
		else
		{
			$rows[$row_id]['icon_types'] = array();
		}
	}

	function post_process(&$rows)
	{
		$rows['types'] = serialize($this->types);
	}
}

class icons
{
	var $data;
	var $types;
	var $data_time;
	var $from_cache;
	var $data_flag;
	var $allowed;
	var $allowed_flag;

	function read($force=false)
	{
		global $config;

		if ( !$force && $this->data_flag )
		{
			return $this->data;
		}
		$db_cached = new icons_cache('dta_icons', $config->data['cache_path'], $config->data['cache_disabled_icons']);
		$sql = 'SELECT * 
					FROM ' . ICONS_TABLE . '
					ORDER BY icon_order';
		$this->data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force, 'icon_id');
		if ( !empty($this->data['types']) )
		{
			$this->types = unserialize(stripslashes($this->data['types']));
			unset($this->data['types']);
		}
		else
		{
			$this->types = array();
		}
		$this->data_flag = true;
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;
		$this->allowed_flag = false;
	}

	function get_allowed($forum_id)
	{
		global $user;

		if ( $this->allowed_flag )
		{
			return;
		}

		$this->allowed = array();
		if ( !empty($this->data) )
		{
			foreach ( $this->data as $icon_id => $icon )
			{
				if ( empty($icon['icon_auth']) || $user->auth(POST_FORUM_URL, $icon['icon_auth'], $forum_id) )
				{
					$this->allowed[] = $icon_id;
				}
			}
		}
		$this->allowed_flag = true;
	}

	function display($box='ICON_BOX', $icon_id=0)
	{
		global $template, $user;

		if ( empty($this->allowed) )
		{
			return false;
		}

		// number per row
		$number_per_row = 10;

		// get icon box
		$template->set_filenames(array('icon_box' => 'posting_icon_box.tpl'));
		$template->assign_vars(array(
			'L_ICONS' => $user->lang('Message_icon'),
		));
		$template->set_switch('icons', !empty($this->allowed));

		// display the template
		$count_allowed = count($this->allowed);
		for ( $i = 0; $i < $count_allowed; $i++ )
		{
			if ( ($i % $number_per_row) == 0 )
			{
				$template->set_switch('icons.row');
			}
			$template->assign_block_vars('icons.row.cell', array(
				'ICON_ID' => $this->allowed[$i],
				'I_ICON' => $user->img($this->data[ $this->allowed[$i] ]['icon_url']),
				'L_ICON' => $user->lang($this->data[ $this->allowed[$i] ]['icon_name']),
			));
			$template->set_switch('icons.row.cell.selected', ($this->allowed[$i] == $icon_id));
			$template->set_switch('icons.row.cell.img');
		}

		// add icon "none"
		if ( ($i % $number_per_row) == 0 )
		{
			$template->set_switch('icons.row');
		}
		$template->assign_block_vars('icons.row.cell', array(
			'ICON_ID' => 0,
			'I_ICON' => '',
			'L_ICON' => $user->lang('No_icon'),
			'S_SPAN' => ($count_allowed > 1) && (10-($i % 10) > 1) ? ' colspan="' . min(10-($i % 10), $count_allowed+1) . '"' : '',
		));
		$template->set_switch('icons.row.cell.selected', ($icon_id == 0));
		$template->set_switch('icons.row.cell.img', false);
		$template->assign_var_from_handle($box, 'icon_box');
	}

	function topic_title($tpl_level, $icon_id, $topic_type, $first_post=true)
	{
		global $user, $template;

		if ( !$this->data_flag )
		{
			$this->read();
		}
		$topic_type = intval($topic_type);

		$template->assign_vars(array(
			'L_ICON' => $user->lang('Message_icon'),
		));

		if ( empty($icon_id) && $first_post)
		{
			$icon_id = empty($this->types[$topic_type]) ? 0 : $this->types[$topic_type];
		}
		$res = false;
		if ( !empty($this->data[$icon_id]['icon_url']) )
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'msg_icon', array(
				'L_ICON' => $user->lang($this->data[$icon_id]['icon_name']),
				'I_ICON' => $user->img($this->data[$icon_id]['icon_url']),
			));
			$res = true;
		}
		else
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'msg_icon_ELSE', array());
			$res = false;
		}

		return $res;
	}
}

class front_calendar
{
	var $installed;

	function front_calendar()
	{
		global $config;

		$this->installed = $config->data['mod_topic_calendar_CH'];
	}

	function topic_title($tpl_level, $from, $dur)
	{
		global $template, $user;

		if ( !$this->installed )
		{
			return;
		}

		$template->assign_vars(array(
			'L_CALENDAR_EVENT' => $user->lang('Calendar_event'),
		));

		$res = false;
		if ( !empty($from) )
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'calendar_event', array(
				'S_CALENDAR_EVENT' => sprintf($user->lang(((empty($dur) || ($dur == 86399)) ? 'Calendar_single_date' : 'Calendar_from_to')), $user->date($from), $user->date($from + $dur)),
			));
			$res = true;
		}
		else
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'calendar_event_ELSE', array());
			$res = false;
		}

		return $res;
	}
}

class front_sub_title
{
	function topic_title($tpl_level, $sub_title, $display, $highlight_match='')
	{
		global $template, $user, $theme;

		$template->assign_vars(array(
			'L_SUB_TITLE' => $user->lang('Sub_title'),
		));

		$res = false;
		if ( $display && !empty($sub_title) )
		{
			$sub_title = _censor($sub_title);
			if ( $highlight_match )
			{
				// This was shamelessly 'borrowed' from volker at multiartstudio dot de
				// via php.net's annotated manual
				$sub_title = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace('#\b(" . str_replace('\\', '\\\\', addslashes($highlight_match)) . ")\b#i', '<span style=\"color:#" . $theme['fontcolor3'] . "\"><b>\\\\1</b></span>', '\\0')", '>' . $sub_title . '<'), 1, -1));
			}
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'sub_title', array(
				'SUB_TITLE' => $sub_title,
			));
			$res = true;
		}
		else
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'sub_title_ELSE', array());
			$res = false;
		}

		return $res;
	}
}

class front_announce
{
	function topic_title($tpl_level, $from, $to, $display=true)
	{
		global $template, $user;

		$res = false;
		if ( ($to > max($from, time())) && $display )
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'announce', array(
				'S_ANNOUNCE' => sprintf($user->lang('Announce_ends'), $user->date($to)),
			));
			$res = true;
		}
		else
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'announce_ELSE', array());
			$res = false;
		}
	}
}

class topics_attr
{
	var $data_time;
	var $from_cache;
	var $allowed;
	var $allowed_flag;

	function read($force=false)
	{
		global $config;

		if ( !$force && !empty($this->data) )
		{
			return;
		}

		$db_cached = new cache('dta_topics_attr', $config->data['cache_path'], $config->data['cache_disabled_topics_attr']);
		$sql = 'SELECT * 
					FROM ' . TOPICS_ATTR_TABLE . '
					ORDER BY attr_order DESC';
		$this->data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force, 'attr_id');
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;
		$this->allowed_flag = false;

		$this->data[] = array(
			'attr_added' => true,
			'attr_id' => 0,
			'attr_name' => 'Topic',
			'attr_fimg' => 'folder',
			'attr_order' => 0,
			'attr_field' => 'topic_type',
		);
	}

	function get_attr($row)
	{
		global $config, $user, $images;

		if ( empty($this->data) )
		{
			$this->read();
		}

		// search attributes
		$types_attr = array();

		// browse the attributes and get the relevant ones
		foreach ( $this->data as $attr_id => $data )
		{
			$res = empty($data['attr_field']);
			if ( !$res )
			{
				switch( $data['attr_cond'] )
				{
					case 'LT':
						$res = $row[ $data['attr_field'] ] < $data['attr_value'];
						break;
					case 'LE':
						$res = $row[ $data['attr_field'] ] <= $data['attr_value'];
						break;
					case 'EQ':
						$res = $row[ $data['attr_field'] ] == $data['attr_value'];
						break;
					case 'GE':
						$res = $row[ $data['attr_field'] ] >= $data['attr_value'];
						break;
					case 'GT':
						$res = $row[ $data['attr_field'] ] > $data['attr_value'];
						break;
					case 'NE':
						$res = $row[ $data['attr_field'] ] != $data['attr_value'];
						break;
					case '':
						$res = ($data['attr_field'] != 'topic_sub_type') || (($data['attr_field'] == 'topic_sub_type') && ($row['topic_sub_type'] == $attr_id));
						break;
				}
				// attchmod specificity
				if ( $res && ($data['attr_field'] == 'topic_attachment') )
				{
					global $attach_config;

					if ( intval($attach_config['disable_mod']) || !$user->auth(POST_FORUM_URL, 'auth_download', $row['forum_id']) )
					{
						$res = false;
					}
					else
					{
						if ( empty($this->data[$attr_id]['attr_timg']) )
						{
							$this->data[$attr_id]['attr_timg'] = 'topic_attach_tiny';
						}
						if ( empty($images[ $this->data[$attr_id]['attr_timg'] ]) )
						{
							$images[ $this->data[$attr_id]['attr_timg'] ] = $attach_config['topic_icon'];
						}
					}
				}
				// moved specificities
				if ( $res && ($data['attr_field'] == 'topic_status') && ($row['topic_moved_id'] > 0) )
				{
					$res = false;
				}
			}
			if ( $res )
			{
				$types_attr[] = $attr_id;
			}
		}

		// ok, now let's get folder entry (we always have the added "standard topic" entry) retaining the first having a valid folder image
		$count_types_attr = count($types_attr);
		$folder_id = $types_attr[ ($count_types_attr - 1) ];
		for ( $i = 0; $i < $count_types_attr; $i++ )
		{
			if ( isset($images[ $this->data[ $types_attr[$i] ]['attr_fimg'] ]) )
			{
				$folder_id = $types_attr[$i];
				$i = $count_types_attr;
				break;
			}
		}

		// let's deal with own and hot for the folder img
		$res = array(0 => array('txt' => empty($this->data[$folder_id]['attr_fname']) ? array() : array($this->data[$folder_id]['attr_fname']), 'img' => $this->data[$folder_id]['attr_fimg']));

		// topic popular
		$hot = ($row['topic_replies'] >= $config->data['hot_threshold']);
		if ( $hot && isset($images[$res[0]['img'] . '_hot']) )
		{
			$res[0]['img'] .= '_hot';
		}

		// topic with new posts
		if ( $row['topic_unread'] )
		{
			if ( isset($images[$res[0]['img'] . '_new']) )
			{
				$res[0]['img'] .= '_new';
			}
			$res[0]['txt'][] = $hot ? 'New_posts_hot' : 'New_posts';
		}
		else
		{
			$res[0]['txt'][] = $hot ? 'No_new_posts_hot' : 'No_new_posts';
		}

		// topic the user has replied to
		if ( $row['topic_own'] )
		{
			if ( isset($images[$res[0]['img'] . '_own']) )
			{
				$res[0]['img'] .= '_own';
			}
			$res[0]['txt'][] = 'Own_topic';
		}

		// add other attributes
		$count_types_attr = count($types_attr);
		for ( $i = 0; $i < $count_types_attr; $i++ )
		{
			if ( $types_attr[$i] != $folder_id )
			{
				$res[] = array('txt' => $this->data[ $types_attr[$i] ]['attr_tname'], 'img' => !empty($this->data[ $types_attr[$i] ]['attr_timg']) && isset($images[ $this->data[ $types_attr[$i] ]['attr_timg'] ]) ? $this->data[ $types_attr[$i] ]['attr_timg'] : '');
			}
		}
		return $res;
	}

	function get_allowed($attr_field, $forum_id=0)
	{
		global $user;

		if ( empty($this->data) )
		{
			$this->read();
		}
		if ( $this->allowed_flag )
		{
			return;
		}
		$this->allowed = array(0 => 'None');
		foreach ( $this->data as $attr_id => $data )
		{
			if ( ($data['attr_field'] == $attr_field) && (empty($data['attr_auth']) || $user->auth(POST_FORUM_URL, $data['attr_auth'], $forum_id)) )
			{
				$this->allowed[$attr_id] = $data['attr_name'];
			}
		}
		$this->allowed_flag = true;
	}

	function topic_title($tpl_level, $topic_sub_type, $force_txt=false)
	{
		global $template, $user, $images;

		if ( !empty($topic_sub_type) )
		{
			if ( empty($this->data) )
			{
				$this->read();
			}
		}

		$res = false;
		if ( !empty($topic_sub_type) && isset($this->data[$topic_sub_type]) && (!empty($this->data[$topic_sub_type]['attr_tname']) || !empty($this->data[$topic_sub_type]['attr_timg'])) )
		{
			$img = !empty($this->data[$topic_sub_type]['attr_timg']) && isset($images[ $this->data[$topic_sub_type]['attr_timg'] ]);
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'sub_type', array(
				'L_SUB_TYPE' => empty($this->data[$topic_sub_type]['attr_tname']) ? '' : ($img || $force_txt ? _clean_html($user->lang($this->data[$topic_sub_type]['attr_tname'])) : $user->lang($this->data[$topic_sub_type]['attr_tname'])),
				'I_SUB_TYPE' => $img ? $user->img($this->data[$topic_sub_type]['attr_timg']) : '',
			));
			$template->set_switch((empty($tpl_level) ? '' : $tpl_level . '.') . 'sub_type.txt', !empty($this->data[$topic_sub_type]['attr_tname']) && (!$img || $force_txt));
			$template->set_switch((empty($tpl_level) ? '' : $tpl_level . '.') . 'sub_type.img', $img && !$force_txt);
			$res = true;
		}
		else
		{
			$template->assign_block_vars((empty($tpl_level) ? '' : $tpl_level . '.') . 'sub_type_ELSE', array());
			$res = false;
		}

		return $res;
	}
}

class front_title
{
	var $front_sub_title;
	var $front_announce;
	var $front_calendar;

	function front_title()
	{
		$this->front_sub_title = new front_sub_title();
		$this->front_announce = new front_announce();
		$this->front_calendar = new front_calendar();
	}

	function set($tpl_level, $row, $first_post=true, $highlight_match='')
	{
		global $config, $template;
		global $icons, $topics_attr;

		// fields :
		// topic_type, topic_sub_type, topic_time, topic_duration, topic_calendar_time, topic_calendar_duration
		// post_icon, post_sub_title

		$res = $first_post || !empty($row['post_subject']);

		// message icon
		$type = $first_post ? (($row['topic_type'] > POST_NORMAL) ? $row['topic_type'] : ($row['topic_calendar_time'] ? POST_CALENDAR : POST_NORMAL)) : POST_NORMAL;
		$res |= $icons->topic_title($tpl_level, $row['post_icon'], $type, $first_post);

		// sub title
		if ( $first_post && !empty($row['topic_sub_title']) )
		{
			$row['post_sub_title'] = $row['topic_sub_title'];
		}
		$res |= $this->front_sub_title->topic_title($tpl_level, $row['post_sub_title'], intval($config->data['sub_title_length']), $highlight_match);

		if ( $first_post )
		{
			// topic sub type
			$res |= $topics_attr->topic_title($tpl_level, $row['topic_sub_type']);

			// announce
			$res |= $this->front_announce->topic_title($tpl_level, $row['topic_time'], $row['topic_duration']);

			// calendar
			$res |= $this->front_calendar->topic_title($tpl_level, $row['topic_calendar_time'], $row['topic_calendar_duration']);
		}

		$template->set_switch($tpl_level . (empty($tpl_level) ? '' :  '.') . 'title', $res);
	}
}

class navigation
{
	var $data;
	var $root_count;
	var $requester;
	var $displayed;

	function navigation($requester='')
	{
		$this->requester = empty($requester) ? 'index' : $requester;
		$this->clear();
		$this->root_count = count($this->data);
		$this->displayed = false;
	}

	function clear()
	{
		global $config;

		$this->data = array();
		$this->add('Forum_index', $config->data['sitename'], $this->requester, '', $config->data['index_fav_icon']);
	}

	function add($name, $desc='', $url, $parms='', $img='')
	{
		$this->data[] = array('name' => $name, 'desc' => $desc, 'url' => $url, 'parms' => $parms, 'img' => $img);
	}

	function display($tpl_switch='nav', $root=true)
	{
		global $template, $config, $user;

		$count_data = count($this->data);
		for ( $i = 0; $i < $count_data; $i++ )
		{
			if ( ($i >= $this->root_count) || $root )
			{
				$template->assign_block_vars($tpl_switch, array(
					'U_NAV' => $config->url($this->data[$i]['url'], $this->data[$i]['parms'], true),
					'L_NAV' => $user->lang($this->data[$i]['name']),
					'L_NAV_DESC' => _clean_html($user->lang($this->data[$i]['desc'])),
					'I_NAV' => $user->img($this->data[$i]['img']),
				));
				$template->set_switch($tpl_switch . '.img', !empty($this->data[$i]['img']));
				$template->set_switch($tpl_switch . '.sep', $i < ($count_data-1));
			}
		}
		if ( $tpl_switch == 'nav' )
		{
			$template->set_filenames(array(
				'navigation_box' => 'navigation_box.tpl',
				'navigation_only_box' => 'navigation_only_box.tpl',
			));
			$template->assign_var_from_handle('NAVIGATION_BOX', 'navigation_box');
			$template->assign_var_from_handle('NAVIGATION_ONLY_BOX', 'navigation_only_box');
		}
		$this->displayed = true;
	}
}

class pagination
{
	var $requester;
	var $parms;
	var $start;

	// constructor
	function pagination($requester='', $parms='', $varname='')
	{
		$this->requester = $requester;
		$this->parms = empty($parms) ? array() : $parms;
		$this->varname = empty($varname) ? 'start' : $varname;
	}

	function get_forks($total_items, $item_per_page, $current_item)
	{
		global $config;

		// get the number of pages
		$total_pages = ceil($total_items / $item_per_page);
		if ( $total_pages == 1 )
		{
			return '';
		}

		// limits: 
		// - scope_min & scope_max are the limits for the number of pages displayed
		// - the percentage is applied to the total items to get the scope
		$scope_min = empty($config->data['pagination_min']) ? 5 : intval($config->data['pagination_min']); // 2 on sides + current page
		$scope_max = empty($config->data['pagination_max']) ? 11 : intval($config->data['pagination_max']); // 5 on sides + current page
		$scope_percent = empty($config->data['pagination_percent']) ? 10 : intval($config->data['pagination_percent']); // 10 %

		// center on the current page : $scope is half the number of page around the current page ($middle)
		$scope = ceil((min(max(intval($total_items * $scope_percent / 100), $scope_max), $scope_min) - 1) / 2);
		$middle = floor($current_item / $item_per_page);

		// get forks limits
		$left_end = min($scope, $total_pages-1);
		$middle_start = max($middle-$scope, $scope, 0);
		$middle_end = min( $middle + $scope, $total_pages-$scope );
		$right_start = max( $total_pages-$scope-1, 0 );

		// middle get over edges
		$is_left = $middle_start > $left_end+$scope;
		$is_right = $middle_end+$scope < $right_start;
		if ( !$is_left )
		{
			$middle_start = 0;
		}
		if ( !$is_right )
		{
			$middle_end = $total_pages-1;
		}

		// store forks
		$forks = array();
		if ( $is_left )
		{
			$forks[] = array(0, $left_end);
		}
		$forks[] = array($middle_start, $middle_end);
		if ( $is_right )
		{
			$forks[] = array($right_start, $total_pages-1);
		}
		return $forks;
	}

	function display($tpl_switch, $total_items, $item_per_page, $current_item, $page_1=true, $item_name_count='', $item_total_count=0)
	{
		global $template, $config, $user;

		if ( empty($item_per_page) )
		{
			$item_per_page = 50;
		}
		$pages = $this->get_forks($total_items, $item_per_page, $current_item);
		$current_page = floor($current_item / $item_per_page);
		$total_pages = ceil($total_items / $item_per_page);
		$res = '';

		$n_count = !empty($item_total_count) ? $item_total_count : $total_items;
		$l_count = ($n_count == 1) ? $item_name_count . '_1' : $item_name_count;

		if ( ($total_pages > 1) || (($total_pages == 1) && $page_1) )
		{
			$template->assign_block_vars($tpl_switch, array(
				'START_FIELD' => $this->varname,
				'START' => $current_page * $item_per_page,

				'U_PREVIOUS' => $config->url($this->requester, $this->parms + array($this->varname => (($current_page > 0) ? ($current_page-1) * $item_per_page : 0)), true),
				'L_PREVIOUS' => $user->lang('Previous'),
				'I_PREVIOUS' => $user->img('left_arrow'),
				'PREVIOUS' => ($current_page > 0) ? ($current_page-1) * $item_per_page : 0,

				'U_NEXT' => $config->url($this->requester, $this->parms + array($this->varname => (($current_page+1 < $total_pages) ? ($current_page+1) * $item_per_page : ($total_pages-1) * $item_per_page)), true),
				'L_NEXT' => $user->lang('Next'),
				'I_NEXT' => $user->img('right_arrow'),
				'NEXT' => ($current_page+1 < $total_pages) ? ($current_page+1) * $item_per_page : ($total_pages-1) * $item_per_page,

				'L_GOTO' => $user->lang('Goto_page'),
				'I_GOTO' => $user->img('icon_gotopost'),
				'L_PAGE_OF' => sprintf($user->lang('Page_of'), $current_page+1, $total_pages),
				'L_COUNT' => sprintf($user->lang($l_count), $n_count),
			));
			$template->set_switch($tpl_switch . '.previous', $current_page > 0);
			$template->set_switch($tpl_switch . '.next', ($current_page+1) < $total_pages);
			$template->set_switch($tpl_switch . '.unique', ($total_pages <= 1) );

			// dump the forks
			if ( $total_pages > 1 )
			{
				$first = true;
				$count_pages = count($pages);
				for ( $j = 0; $j < $count_pages; $j++ )
				{
					if ( !$first )
					{
						// send "...,"
						$template->set_switch($tpl_switch . '.page_number');
						$template->set_switch($tpl_switch . '.page_number.number', false);
					}
					for ( $k = $pages[$j][0]; $k <= $pages[$j][1]; $k++ )
					{
						$last = ($j == $count_pages - 1) && ($k == $pages[$j][1]);
						$template->assign_block_vars($tpl_switch . '.page_number', array(
							'U_PAGE' => $config->url($this->requester, $this->parms + array($this->varname => $k * $item_per_page), true),
							'PAGE' => ($k + 1),
							'START' => ($k * $item_per_page),
							'L_SEP' => $last ? '' : ', ',
						));
						$template->set_switch($tpl_switch . '.page_number.number');
						$template->set_switch($tpl_switch . '.page_number.number.current', ($k == $current_page));
						$template->set_switch($tpl_switch . '.page_number.number.sep', !$last);
						$first = false;
					}
				}
			}
		}
	}
}

?>