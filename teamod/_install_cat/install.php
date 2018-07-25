<?php
/***************************************************************************
 *							install.php
 *							-----------
 *	begin		: 25/08/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 1.0.3 - 31/10/2005
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
include($config->url('includes/sql_parse'));
include($config->url('includes/class_install'));
include($config->url('includes/class_forums'));
include($config->url('includes/class_cp'));

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
<tr><td align="justify" class="row1"><?php echo '<img src="./install_pic.jpg" align="left" border="0" />'; ?><?php echo sprintf($page->lang('CH_welcome_explain'), CH_CURRENT_VERSION); ?><br /><br /><br /></td></tr>
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
//-- new install & upgrades
	'CH_welcome',
	'CH_previous_version',
	'CH_founder',
	'CH_dbstruct',
	'CH_upg_data',

//-- new install only
	'CH_cache',
	'CH_config',
	'CH_presets',
	'CH_topic_icons',
	'CH_topic_attributes',
	'CH_categories',
	'CH_sync_topics',
	'CH_sync_forums',
	'CH_sync_users',

//-- new install & upgrades
	'CH_resume',
	'CH_anon_user',
	'CH_orphean_groups',
	'CH_individual_groups_surnumerous',
	'CH_individual_groups',
	'CH_surnumerous_membership',
	'CH_founder_req',
	'CH_system_groups',
	'CH_user_groups_sync',

	'CH_patch_panels',
	'CH_import_pgauths',
	'CH_import_fauths',

	'CH_ptifo',

//-- end of process
	'CH_end',
);

// parms (not set is : type => TYPE_INT, default => 0)
$parms_def = array(
	'step' => array('list' => &$steps),
	'chpv' => array('type' => TYPE_NO_HTML, 'default' => ''),
	'fnd' => '',
	'fndreq' => '',
	'dbs' => '',
	'dbd' => '',
	'upr' => '',
	'uta' => '',

	'cache' => '',
	'cpr' => '',
	'cti' => '',
	'cta' => '',
	'ccfg' => '',
	'ccat' => '',
	'tt' => '',
	'tf' => '',
	'tu' => '',

	'anon' => '',
	'og' => '',
	'tgs' => '',
	'tg' => '',
	'ti' => '',
	'tms' => '',

	'pp' => '',
	'ipa' => '',
	'ifad' => '',
	'ifav' => '',

	'ptifo' => '',
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

// data
$founder_id = 0;
$founder_name = '';

// start
$page = new page($requester);
$page->set_parms($parms);
$page->sub_title = 'CH_code_name';

// set version
$lang['Script_title'] = sprintf($lang['Script_title'], CH_CURRENT_VERSION);
$lang['CH_code_name'] = '"The Halloween cruising of the Mary-Celeste" edition';

// log in
$session = new light_session();
$session->log_in(ADMIN);

// send welcome
if ( step() == 'CH_welcome' )
{
	$page->header();
	next_step();
	welcome_form();
	$page->footer();
}

// detect CH
if ( step() == 'CH_previous_version' )
{
	$sql = 'SELECT config_value
				FROM ' . CONFIG_TABLE . '
				WHERE config_name = \'mod_cat_hierarchy\'';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	if ( $row = $db->sql_fetchrow($result) )
	{
		$parms['chpv'] = $row['config_value'];
	}
	next_step();
}
if ( !empty($parms['chpv']) )
{
	$page->output(sprintf($page->lang('CH_previous_version'), $parms['chpv']));
}

// get founder
if ( (step() == 'CH_founder') || ($parms['fnd'] && $parms['fndreq']) )
{
	$done = false;
	$possible_founders = array();

	// a previous version of CH is installed : the founder so is the Board_founder group moderator
	if ( !empty($parms['chpv']) )
	{
		$sql = 'SELECT config_value
					FROM ' . CONFIG_TABLE . '
					WHERE config_name = \'group_founder\'';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		if ( $row = $db->sql_fetchrow($result) )
		{
			$group_founder = intval($row['config_value']);
			if ( !empty($group_founder) )
			{
				$sql = 'SELECT u.user_id, u.username
							FROM ' . GROUPS_TABLE . ' g, ' . USERS_TABLE . ' u
							WHERE g.group_id = ' . $group_founder . '
								AND u.user_id = g.group_moderator
								AND u.user_active = ' . true;
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				if ( $row = $db->sql_fetchrow($result) )
				{
					$founder_id = intval($row['user_id']);
					if ( !empty($founder_id) )
					{
						$founder_name = $row['username'];
						$done = true;
					}
					$parms['fnd'] = -1;
				}
			}
		}
	}

	// previous CH install not complete, or no previous CH
	if ( !$done )
	{
		$sql = 'SELECT user_id, username
					FROM ' . USERS_TABLE . '
					WHERE user_level = ' . ADMIN . '
						AND user_active = ' . true . '
					ORDER BY user_id';
		if ( !empty($parms['fnd']) )
		{
			$sql .= ' LIMIT ' . (intval($parms['fnd']) - 1) . ', 1';
		}
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		while ( $row = $db->sql_fetchrow($result) )
		{
			$possible_founders[ intval($row['user_id']) ] = $row['username'];
		}
		if ( empty($possible_founders) )
		{
			$sql = 'SELECT username
						FROM ' . USERS_TABLE . '
						WHERE user_id = ' . $session->user_id;
			$result = $db->sql_query($sql, false, __LINE__, __FILE__);
			if ( $row = $db->sql_fetchrow($result) )
			{
				$possible_founders[$session->user_id] = $row['username'];
			}
			else
			{
				critical_error('CH_no_founder');
			}
		}
		$count_possible_founders = count($possible_founders);
		if ( $count_possible_founders == 1 )
		{
			if ( empty($parms['fnd']) )
			{
				$parms['fnd'] = 1;
			}
			@reset($possible_founders);
			list($founder_id, $founder_name) = @each($possible_founders);
			$done = !empty($founder_id);
		}
	}

	// possible founders array contains more than one founder : send a form
	if ( !$done )
	{
		$page->header();
		founder_form($possible_founders);
		$page->footer();
	}
	if ( step() == 'CH_founder' )
	{
		next_step();
	}
}
if ( !empty($parms['fnd']) && !empty($parms['fndreq']) )
{
	$page->output(sprintf($page->lang('CH_founder_is'), $founder_id, $founder_name));
}

// create or upgrade the database structure
if ( step() == 'CH_dbstruct' )
{
	$sql_struct = array();
	if ( !$sql_layer = $db->get_layer() )
	{
		critical_error('CH_db_not_supported');
	}
	$remove_remarks = $sql_layer['COMMENTS'];
	$delimiter = $sql_layer['DELIM'];
	$delimiter_basic = $sql_layer['DELIM_BASIC'];

	// read the sql instructions
	$data = '';
	switch ( $parms['chpv'] )
	{
		// upgrade from a previous version
		case '2.1.0f':
			$dbms_schema = 'schemas/' . $sql_layer['SCHEMA'] . '_upg_from_2_1_0f.sql';
			$wdata = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema));
			if ( $wdata )
			{
				$data .= "\n" . trim($wdata);
				unset($wdata);
			}

		case '2.1.1':
			$dbms_schema = 'schemas/' . $sql_layer['SCHEMA'] . '_upg_from_2_1_1RC5.sql';
			$wdata = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema));
			if ( $wdata )
			{
				$data .= "\n" . trim($wdata);
				unset($wdata);
			}

		case '2.1.1RC6':
			$dbms_schema = 'schemas/' . $sql_layer['SCHEMA'] . '_upg_from_2_1_1RC6.sql';
			$wdata = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema));
			if ( $wdata )
			{
				$data .= "\n" . trim($wdata);
				unset($wdata);
			}
			break;

		case '2.1.2':
			break;

		// new install
		default:
			$dbms_schema = 'schemas/' . $sql_layer['SCHEMA'] . '_full_2_1_2.sql';
			$wdata = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema));
			if ( $wdata )
			{
				$data .= "\n" . trim($wdata);
				unset($wdata);
			}
			break;
	}

	// parse the data
	if ( !empty($data) )
	{
		$data = preg_replace('/phpbb_/', $table_prefix, $data);
		$data = $remove_remarks($data);
		$sql_struct = split_sql_file($data, $delimiter);
		unset($data);
	}

	// process the sql
	$count_sql_struct = count($sql_struct);
	for ( $i = 0; $i < $count_sql_struct; $i++ )
	{
		$sql = trim($sql_struct[$i]);
		if ( !empty($sql) )
		{
			if ( !$db->sql_query($sql, false, __LINE__, __FILE__, false) )
			{
				$page->error(sprintf($page->lang('CH_sql_already_done'), $sql));
			}
		}
	}

	// ok for this one
	$parms['dbs'] = true;
	next_step();
	$page->loop();
}
if ( !empty($parms['dbs']) )
{
	$page->output(empty($parms['chpv']) ? 'CH_dbstruct_done' : 'CH_dbstruct_upgraded');
}

// populate the database
if ( step() == 'CH_upg_data' )
{
	switch( $parms['chpv'] )
	{
		case '2.1.0f':
			//--------------------------
			// auths presets creation
			//--------------------------
			// create header
			$fields = array(
				'preset_type' => 'f',
				'preset_name' => 'Preset_guest_posting',
			);
			$db->sql_statement($fields);
			$sql = 'INSERT INTO ' . PRESETS_TABLE . '
						(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);
			$preset_id = $db->sql_nextid();

			// create a guest preset
			$db->sql_stack_reset();
			$db->sql_stack_fields = 'preset_id, preset_auth, preset_value';
			$db->sql_stack_values = array(
				'(' . $preset_id . ', \'auth_view\', 1)', '(' . $preset_id . ', \'auth_read\', 1)', '(' . $preset_id . ', \'auth_post\', 1)', '(' . $preset_id . ', \'auth_reply\', 1)',
			);
			$db->sql_stack_insert(PRESETS_DATA_TABLE, false, __LINE__, __FILE__);
			$parms['upr'] = true;

			//--------------------------
			// topic title attribute
			//--------------------------
			$sql = 'TRUNCATE TABLE ' . TOPICS_ATTR_TABLE;
			$db->sql_query($sql, false, __LINE__, __FILE__);
			$db->sql_stack_reset();
			$db->sql_stack_fields = 'attr_name, attr_fname, attr_fimg, attr_tname, attr_timg, attr_order, attr_field, attr_cond, attr_value, attr_auth';
			$db->sql_stack_values = array(
				'(\'Topic_Moved\', \'Topic_Moved\', \'folder_moved\', \'Topic_Moved\', \'\', 80, \'topic_moved_id\', \'GT\', 0, \'\')',
				'(\'Topic_Locked\', \'Topic_locked\', \'folder_locked\', \'Topic_Locked\', \'topic_locked_tiny\', 30, \'topic_status\', \'GT\', 0, \'\')',
				'(\'Topic_Global_Announcement\', \'Topic_Global_Announcement\', \'folder_global\', \'Post_Global_Announcement\', \'\', 70, \'topic_type\', \'GE\', 3, \'\')',
				'(\'Topic_Announcement\', \'Topic_Announcement\', \'folder_announce\', \'Post_Announcement\', \'\', 60, \'topic_type\', \'EQ\', 2, \'\')',
				'(\'Topic_Sticky\', \'Topic_Sticky\', \'folder_sticky\', \'Post_Sticky\', \'\', 50, \'topic_type\', \'EQ\', 1, \'\')',
				'(\'Topic_Poll\', \'Topic_Poll\', \'\', \'Topic_Poll\', \'topic_poll_tiny\', 20, \'topic_vote\', \'GT\', 0, \'\')',
				'(\'Topic_Attached\', \'Topic_Attached\', \'\', \'Topic_Attached\', \'\', 10, \'topic_attachment\', \'GT\', 0, \'\')',
				'(\'Topic_calendar\', \'Topic_calendar\', \'folder_calendar\', \'Topic_calendar\', \'topic_calendar_tiny\', 40, \'topic_calendar_time\', \'GT\', 0, \'\')',
			);
			$db->sql_stack_insert(TOPICS_ATTR_TABLE, false, __LINE__, __FILE__);
			$parms['uta'] = true;

		case '2.1.1':
		case '2.1.1RC6':
		case '2.1.2':

			break;
	}
	next_step($parms['chpv'] ? 'CH_resume' : '');
	$page->loop();
}
if ( !empty($parms['upr']) )
{
	$page->output('CH_guests_preset_added');
}
if ( !empty($parms['uta']) )
{
	$page->output('CH_db_topics_attribute_done');
}

// -------------------------------------
//
// there starts new install specific work
//
// -------------------------------------

// check if cache/ directory is writable
if ( step() == 'CH_cache' )
{
	list($sec, $usec) = explode(' ', microtime());
	mt_srand((float) $sec + ((float) $usec * 100000));
	$cache_id = md5(uniqid(mt_rand(), true));

	// create the file
	$file = $page->root . 'cache/tst_cache.php';
	@unlink($file);
	$handle = @fopen($file, 'w');
	@flock($handle, LOCK_EX);
	@fwrite($handle, $cache_id);
	@flock($handle, LOCK_UN);
	@fclose($handle);
	@umask(0000);
	@chmod($filename, 0666);

	// reread
	$data = @fread(@fopen($file, 'r'), @filesize($file));
	@unlink($file);
	$parms['cache'] = ($data == $cache_id) ? 2 : 1;
	next_step();
}
switch ( $parms['cache'] )
{
	case 1:
		$page->output('CH_caches_not_available');
		break;
	case 2:
		$page->output('CH_caches_available');
		break;
}
$cache_set = ($parms['cache'] == 1) ? 1 : 0;

// populate config table
if ( step() == 'CH_config' )
{
	// update cache switch in config table
	$sql = 'UPDATE ' . CONFIG_TABLE . '
				SET config_static = 1 
				WHERE config_name NOT IN(\'record_online_users\', \'record_online_date\')';
	$db->sql_query($sql, false, __LINE__, __FILE__);

	// config set definition
	$config_set = array(
		// stats
		'stat_total_posts' => array('config_value' => 0, 'config_static' => 0),
		'stat_total_topics' => array('config_value' => 0, 'config_static' => 0),
		'stat_total_users' => array('config_value' => 0, 'config_static' => 0),
		'stat_last_user' => array('config_value' => 0, 'config_static' => 0),
		'stat_last_username' => array('config_value' => 0, 'config_static' => 0),

		// board level
		'site_fav_icon' => array('config_value' => 'images/favicon.ico', 'config_static' => 1),
		'keep_unreads' => array('config_value' => 0, 'config_static' => 1),
		'keep_unreads_over' => array('config_value' => 0, 'config_static' => 1),
		'smart_date' => array('config_value' => 1, 'config_static' => 1),
		'smart_date_over' => array('config_value' => 0, 'config_static' => 1),
		'icons_path' => array('config_value' => 'images/icons/', 'config_static' => 1),

		'topics_split_global' => array('config_value' => 0, 'config_static' => 1),
		'topics_split_announces' => array('config_value' => 0, 'config_static' => 1),
		'topics_split_stickies' => array('config_value' => 0, 'config_static' => 1),

		'default_duration' => array('config_value' => 7, 'config_static' => 1),

		'pagination_min' => array('config_value' => 5, 'config_static' => 1),
		'pagination_max' => array('config_value' => 11, 'config_static' => 1),
		'pagination_percent' => array('config_value' => 10, 'config_static' => 1),

		'topic_title_length' => array('config_value' => 60, 'config_static' => 1),
		'sub_title_length' => array('config_value' => 100,  'config_static' => 1),

		// forum level
		'index_fav_icon' => array('config_value' => 'images/favicon.gif', 'config_static' => 1),
		'topics_sort' => array('config_value' => 'lastpost', 'config_static' => 1),
		'topics_order' => array('config_value' => 'DESC', 'config_static' => 1),
		'topics_sort_over' => array('config_value' => 0, 'config_static' => 1),
		'last_topic_title_length' => array('config_value' => 25, 'config_static' => 1),
		'index_pack' => array('config_value' => 0, 'config_static' => 1),
		'index_pack_over' => array('config_value' => 0, 'config_static' => 1),
		'index_split' => array('config_value' => 0, 'config_static' => 1),
		'index_split_over' => array('config_value' => 0, 'config_static' => 1),
		'board_box' => array('config_value' => 1, 'config_static' => 1),
		'board_box_over' => array('config_value' => 0, 'config_static' => 1),

		// cache (cfg cache, cache path & cache key have to remain dynamic)
		'cache_key' => array('config_value' => md5(uniqid(rand())), 'config_static' => 0),
		'cache_path' => array('config_value' => 'cache/', 'config_static' => 0),
		'cache_disabled_cfg' => array('config_value' => $cache_set, 'config_static' => 0),
		'cache_disabled_f' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_mods' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_themes' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_ranks' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_words' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_smilies' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_icons' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_cp_patches' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_disabled_cp_panels' => array('config_value' => $cache_set, 'config_static' => 1),

		// users caches level time markers
		'cache_time_f' => array('config_value' => 0, 'config_static' => 1),
		'cache_time_m' => array('config_value' => 0, 'config_static' => 1),
		'cache_time_g' => array('config_value' => 0, 'config_static' => 1),
		'cache_time_fjbox' => array('config_value' => 0, 'config_static' => 1),

		// template cache
		'cache_disabled_template' => array('config_value' => $cache_set, 'config_static' => 1),
		'cache_check_template' => array('config_value' => 1, 'config_static' => 1),
	);

	// do some cleaning
	$sql = 'DELETE FROM ' . CONFIG_TABLE . '
				WHERE config_name IN(\'' . implode('\', \'', array_keys($config_set)) . '\')';
	$db->sql_query($sql, false, __LINE__, __FILE__);

	// re insert config data
	$count_config_set = count($config_set);
	$db->sql_stack_reset();
	foreach ( $config_set as $config_name => $config_data )
	{
		$fields = array(
			'config_name' => $config_name,
			'config_value' => $config_data['config_value'],
			'config_static' => $config_data['config_static'],
		);
		$db->sql_stack_statement($fields);
	}
	$db->sql_stack_insert(CONFIG_TABLE, false, __LINE__, __FILE__);

	// recache
	$config->read(true);
	$parms['ccfg'] = true;
	next_step();
}
if ( !empty($parms['ccfg']) )
{
	$page->output('CH_db_config_done');
}

// populate presets table
if ( step() == 'CH_presets' )
{
	// do some cleaning
	$sql = 'DELETE FROM ' . PRESETS_DATA_TABLE;
	$db->sql_query($sql, false, __LINE__, __FILE__);
	$sql = 'DELETE FROM ' . PRESETS_TABLE;
	$db->sql_query($sql, false, __LINE__, __FILE__);

	// define presets
	$presets = array(
		'f' => array(
			'Preset_read_only' => array('auth_read', 'auth_view'),
			'Preset_read_post_vote' => array('auth_delete', 'auth_edit', 'auth_post', 'auth_read', 'auth_reply', 'auth_view', 'auth_vote'),
			'Preset_moderator' => array('auth_announce', 'auth_delete', 'auth_edit', 'auth_global_announce', 'auth_mod', 'auth_mod_display', 'auth_pollcreate', 'auth_post', 'auth_read', 'auth_reply', 'auth_sticky', 'auth_view', 'auth_vote'),
			'Preset_moderator_hidden' => array('auth_announce', 'auth_delete', 'auth_edit', 'auth_global_announce', 'auth_mod', 'auth_pollcreate', 'auth_post', 'auth_read', 'auth_reply', 'auth_sticky', 'auth_view', 'auth_vote'),
			'Preset_admin' => array('auth_announce', 'auth_delete', 'auth_edit', 'auth_global_announce', 'auth_mod', 'auth_pollcreate', 'auth_post', 'auth_read', 'auth_reply', 'auth_sticky', 'auth_view', 'auth_vote', 'auth_manage'),
			'Preset_guest_posting' => array('auth_view', 'auth_read', 'auth_post', 'auth_reply'),
			'None' => array(),
		),
		'm' => array(
			'Preset_access' => array('access'),
			'None' => array(),
		),
		'g' => array(
			'Preset_admin' => array('ucp_edit_i18n', 'ucp_edit_layout', 'ucp_edit_posting', 'ucp_edit_privacy', 'ucp_edit_profile', 'ucp_edit_topicread'),
			'Preset_view' => array('ucp_view_profile'),
			'None' => array(),
		),
	);

	// read presets and create them
	foreach ( $presets as $preset_type => $preset_data )
	{
		foreach ( $preset_data as $preset_name => $preset_auths )
		{
			// create header
			$fields = array(
				'preset_type' => $preset_type,
				'preset_name' => $preset_name,
			);
			$db->sql_statement($fields);
			$sql = 'INSERT INTO ' . PRESETS_TABLE . '
						(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);
			$preset_id = $db->sql_nextid();

			// details
			$count_preset_auths = count($preset_auths);
			for ( $i = 0; $i < $count_preset_auths; $i++ )
			{
				// create details
				$fields = array(
					'preset_id' => $preset_id,
					'preset_auth' => $preset_auths[$i],
					'preset_value' => 1,
				);
				$db->sql_statement($fields);
				$sql = 'INSERT INTO ' . PRESETS_DATA_TABLE . '
						(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
				$db->sql_query($sql, false, __LINE__, __FILE__);
			}
		}
	}

	$parms['cpr'] = true;
	next_step();
}
if ( !empty($parms['cpr']) )
{
	$page->output('CH_db_presets_done');
}

// populate topic icons table
if ( step() == 'CH_topic_icons' )
{
	$sql = 'TRUNCATE TABLE ' . ICONS_TABLE;
	$db->sql_query($sql, false, __LINE__, __FILE__);
	$db->sql_stack_reset();
	$db->sql_stack_fields = 'icon_name, icon_url, icon_auth, icon_types, icon_order';
	$db->sql_stack_values = array(
		'(\'icon_note\', \'images/icons/icon1.gif\', \'\', \'0\', 10)',
		'(\'icon_important\', \'images/icons/icon2.gif\', \'\', \'1\', 20)',
		'(\'icon_idea\', \'images/icons/icon3.gif\', \'\', \'\', 30)',
		'(\'icon_warning\', \'images/icons/icon4.gif\', \'\', \'2, 3\', 40)',
		'(\'icon_question\', \'images/icons/icon5.gif\', \'\', \'\', 50)',
		'(\'icon_cool\', \'images/icons/icon6.gif\', \'\', \'\', 60)',
		'(\'icon_funny\', \'images/icons/icon7.gif\', \'\', \'\', 70)',
		'(\'icon_angry\', \'images/icons/icon8.gif\', \'\', \'\', 80)',
		'(\'icon_sad\', \'images/icons/icon9.gif\', \'\', \'\', 90)',
		'(\'icon_mocker\', \'images/icons/icon10.gif\', \'\', \'\', 100)',
		'(\'icon_shocked\', \'images/icons/icon11.gif\', \'\', \'\', 110)',
		'(\'icon_complicity\', \'images/icons/icon12.gif\', \'\', \'\', 120)',
		'(\'icon_bad\', \'images/icons/icon13.gif\', \'\', \'\', 130)',
		'(\'icon_great\', \'images/icons/icon14.gif\', \'\', \'\', 140)',
		'(\'icon_disgusting\', \'images/icons/icon15.gif\', \'\', \'\', 150)',
		'(\'icon_winner\', \'images/icons/icon16.gif\', \'\', \'\', 160)',
		'(\'icon_impressed\', \'images/icons/icon17.gif\', \'\', \'\', 170)',
		'(\'icon_roleplay\', \'images/icons/icon18.gif\', \'\', \'\', 180)',
		'(\'icon_fight\', \'images/icons/icon19.gif\', \'\', \'\', 190)',
		'(\'icon_loot\', \'images/icons/icon20.gif\', \'\', \'\', 200)',
		'(\'icon_picture\', \'images/icons/icon21.gif\', \'auth_mod\', \'\', 210)',
		'(\'icon_calendar\', \'images/icons/icon22.gif\', \'auth_mod\', \'\', 220)',
	);
	$db->sql_stack_insert(ICONS_TABLE, false, __LINE__, __FILE__);

	$parms['cti'] = true;
	next_step();
}
if ( !empty($parms['cti']) )
{
	$page->output('CH_db_topic_icons_done');
}

// populate topic attributes table
if ( step() == 'CH_topic_attributes' )
{
	$sql = 'TRUNCATE TABLE ' . TOPICS_ATTR_TABLE;
	$db->sql_query($sql, false, __LINE__, __FILE__);
	$db->sql_stack_reset();
	$db->sql_stack_fields = 'attr_name, attr_fname, attr_fimg, attr_tname, attr_timg, attr_order, attr_field, attr_cond, attr_value, attr_auth';
	$db->sql_stack_values = array(
		'(\'Topic_Moved\', \'Topic_Moved\', \'folder_moved\', \'Topic_Moved\', \'\', 80, \'topic_moved_id\', \'GT\', 0, \'\')',
		'(\'Topic_Locked\', \'Topic_locked\', \'folder_locked\', \'Topic_Locked\', \'topic_locked_tiny\', 30, \'topic_status\', \'GT\', 0, \'\')',
		'(\'Topic_Global_Announcement\', \'Topic_Global_Announcement\', \'folder_global\', \'Post_Global_Announcement\', \'\', 70, \'topic_type\', \'GE\', 3, \'\')',
		'(\'Topic_Announcement\', \'Topic_Announcement\', \'folder_announce\', \'Post_Announcement\', \'\', 60, \'topic_type\', \'EQ\', 2, \'\')',
		'(\'Topic_Sticky\', \'Topic_Sticky\', \'folder_sticky\', \'Post_Sticky\', \'\', 50, \'topic_type\', \'EQ\', 1, \'\')',
		'(\'Topic_Poll\', \'Topic_Poll\', \'\', \'Topic_Poll\', \'topic_poll_tiny\', 20, \'topic_vote\', \'GT\', 0, \'\')',
		'(\'Topic_Attached\', \'Topic_Attached\', \'\', \'Topic_Attached\', \'\', 10, \'topic_attachment\', \'GT\', 0, \'\')',
		'(\'Topic_calendar\', \'Topic_calendar\', \'folder_calendar\', \'Topic_calendar\', \'topic_calendar_tiny\', 40, \'topic_calendar_time\', \'GT\', 0, \'\')',
	);
	$db->sql_stack_insert(TOPICS_ATTR_TABLE, false, __LINE__, __FILE__);
	$parms['cta'] = true;
	next_step();
	$page->loop();
}
if ( !empty($parms['cta']) )
{
	$page->output('CH_db_topics_attribute_done');
}

// create forums with cats & reorder all
if ( step() == 'CH_categories' )
{
	// identify the fields from a previous version
	$sql = 'SELECT cat_main
				FROM ' . CATEGORIES_TABLE . '
				LIMIT 1';
	$cat_main_id = $db->sql_query($sql, false, __LINE__, __FILE__, false) ? true : false;
	$sql = 'SELECT cat_main_type
				FROM ' . CATEGORIES_TABLE . '
				LIMIT 1';
	$cat_main_type = $db->sql_query($sql, false, __LINE__, __FILE__, false) ? true : false;
	$sql = 'SELECT main_type
				FROM ' . FORUMS_TABLE . '
				LIMIT 1';
	$forum_main_type = $db->sql_query($sql, false, __LINE__, __FILE__, false) ? true : false;

	// update the forum type in forums table
	$sql = 'UPDATE ' . FORUMS_TABLE . '
				SET forum_type = \'' . POST_FORUM_URL . '\'';
	$db->sql_query($sql, false, __LINE__, __FILE__);

	$fields = array(
		'forum_type' => POST_LINK_URL,
		'forum_link_start' => empty($config->data['board_startdate']) ? time() : intval($config->data['board_startdate']),
	);
	$db->sql_statement($fields);
	$sql = 'UPDATE ' . FORUMS_TABLE . '
				SET ' . $db->sql_update . '
				WHERE (forum_link <> \'\' AND forum_link IS NOT NULL)';
	$db->sql_query($sql, false, __LINE__, __FILE__);

	// get last forum id
	$sql = 'SELECT MAX(forum_id) as last_forum_id
				FROM ' . FORUMS_TABLE;
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$row = $db->sql_fetchrow($result);
	$last_forum_id = intval($row['last_forum_id']);

	// init the tree
	$tree = array();

	// read forums
	$sql = 'SELECT *
				FROM ' . FORUMS_TABLE . '
				ORDER BY forum_order';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	while ( $row = $db->sql_fetchrow($result) )
	{
		$main_id = intval($row['cat_id']);
		$main_type = $forum_main_type && !empty($main_id) ? $row['main_type'] : POST_CAT_URL;
		$tree[POST_FORUM_URL][ intval($row['forum_id']) ] = array('forum_id' => $row['forum_id'], 'main_type' => $main_type, 'main_id' => $main_id, 'order' => $row['forum_order']);
	}

	// read categories
	$sql = 'SELECT *
				FROM ' . CATEGORIES_TABLE . '
				ORDER BY cat_order';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$db->sql_stack_reset();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$last_forum_id++;
		$main_id = $cat_main_id ? intval($row['cat_main']) : 0;
		$main_type = $cat_main_type && !empty($main_id) ? $row['cat_main_type'] : POST_CAT_URL;
		$tree[POST_CAT_URL][ intval($row['cat_id']) ] = array('forum_id' => $last_forum_id, 'main_type' => $main_type, 'main_id' => $main_id, 'order' => $row['cat_order']);

		// create the forum with the cat
		$fields = array(
			'forum_id' => $last_forum_id,
			'forum_name' => $row['cat_title'],
			'forum_main' => 0,
			'forum_type' => POST_CAT_URL,
			'forum_order' => 0,
		);
		$db->sql_stack_statement($fields);
	}
	$db->sql_stack_insert(FORUMS_TABLE, false, __LINE__, __FILE__);

	// now we have the cats and the forums, get all parent ids
	$subs = array();
	if ( !empty($tree) )
	{
		foreach ( $tree as $type => $tdata )
		{
			if ( !empty($tdata) )
			{
				foreach ( $tdata as $key => $data )
				{
					$parent_id = !empty($data['main_id']) && isset($tree[ $data['main_type'] ][ $data['main_id'] ]) ? intval($tree[ $data['main_type'] ][ $data['main_id'] ]['forum_id']) : 0;
					if ( !isset($subs[$parent_id]) )
					{
						$subs[$parent_id] = array();
					}
					$subs[$parent_id][] = $data['forum_id'];
					$order[$parent_id][] = $data['order'];
				}
			}
		}
	}
	if ( !empty($subs) )
	{
		foreach ( $subs as $parent_id => $sub_ids )
		{
			if ( !empty($sub_ids) )
			{
				array_multisort($order[$parent_id], $subs[$parent_id]);
				$subs[$parent_id] = array_values($subs[$parent_id]);
			}
		}
	}

	// reorder all of this
	function build_tree($cur_id=0, $parent_id=0)
	{
		global $tree, $subs;

		// add the level
		if ( !empty($cur_id) )
		{
			$tree[] = array('id' => $cur_id, 'main' => $parent_id);
		}
		for ( $i = 0; $i < count($subs[$cur_id]); $i++ )
		{
			build_tree($subs[$cur_id][$i], $cur_id);
		}
	}
	$tree = array();
	build_tree();
	unset($subs);

	// now we can update the whole tree
	if ( $count_tree = count($tree) )
	{
		$last_order = 0;
		for ( $i = 0; $i < $count_tree; $i++ )
		{
			$last_order += 10;
			$fields = array(
				'forum_main' => $tree[$i]['main'],
				'forum_order' => $last_order,
			);
			$db->sql_statement($fields);
			$sql = 'UPDATE ' . FORUMS_TABLE . '
						SET ' . $db->sql_update . '
						WHERE forum_id = ' . intval($tree[$i]['id']);
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
	}
	unset($tree);

	// recache all
	$forums = new forums();
	$forums->read(true);
	unset($forums);

	// ok, go next
	$parms['chcat'] = true;
	next_step();
	$page->loop();
}
if ( !empty($parms['chcat']) )
{
	$page->output('CH_db_categories_done');
}

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
	$sql = 'SELECT forum_id, forum_topics, forum_posts
				FROM ' . FORUMS_TABLE;
	$result = $db->sql_query($sql, false, __LINE__, __FILE);
	$total_topics = $total_posts = 0;
	$forums = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$forums[] = intval($row['forum_id']);
		$total_topics += intval($row['forum_topics']);
		$total_posts += intval($row['forum_posts']);
	}

	// store the posts & topics counts
	$config->set('stat_total_topics', $total_topics);
	$config->set('stat_total_posts', $total_posts);

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

	// force global announces auth requirement
	$sql = 'UPDATE ' . FORUMS_TABLE . '
				SET auth_global_announce = 5
				WHERE auth_global_announce = 0';
	$db->sql_query($sql, false, __LINE__, __FILE__);

	next_step();
	$page->loop();
}
if ( !empty($parms['tf']) )
{
	$page->output(sprintf($page->lang('CH_db_forums_sync'), $parms['tf']));
}

// synchronise users stats and data
if ( step() == 'CH_sync_users' )
{
	$sql = 'SELECT user_id, username
				FROM ' . USERS_TABLE . '
				WHERE user_id <> ' . ANONYMOUS . '
				ORDER BY user_id DESC';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$total = intval($db->sql_numrows($result));
	$row = $db->sql_fetchrow($result);
	$config->set('stat_total_users', $total);
	$config->set('stat_last_user', intval($row['user_id']));
	$config->set('stat_last_username', $row['username']);

	$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_unread_topics = NULL, user_unread_date = user_lastvisit';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$parms['tu'] = intval($db->sql_affectedrows($result));
	next_step();
}
if ( !empty($parms['tu']) )
{
	$page->output(sprintf($page->lang('CH_db_users_sync'), $parms['tu']));
}


// from here we resume on both upgrade and new installs
if ( step() == 'CH_resume' )
{
	next_step();
	$config->read(true);
}

// check anonymous user
if ( step() == 'CH_anon_user' )
{
	// verify anonymous user
	$sql = 'SELECT user_id
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . ANONYMOUS;
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	if ( !$row = $db->sql_fetchrow($result) )
	{
		// user anonymous is missing
		$fields = array(
			'user_id' => ANONYMOUS,
			'user_active' => 0,
			'username' => 'Anonymous',
			'user_password' => '',
			'user_session_time' => 0,
			'user_session_page' => 0,
			'user_lastvisit' => 0,
			'user_regdate' => empty($config->data['board_startdate']) ? time() : intval($config->data['board_startdate']),
			'user_level' => 0,
			'user_posts' => 0,
			'user_timezone' => intval($config->data['board_timezone']),
			'user_style' => 0,
			'user_lang' => '',
			'user_dateformat' => $config->data['default_dateformat'],
			'user_new_privmsg' => 0,
			'user_unread_privmsg' => 0,
			'user_last_privmsg' => 0,
			'user_emailtime' => 0,
			'user_viewemail' => 0,
			'user_attachsig' => 0,
			'user_allowhtml' => 0,
			'user_allowbbcode' => 1,
			'user_allowsmile' => 1,
			'user_allowavatar' => 1,
			'user_allow_pm' => 0,
			'user_allow_viewonline' => 1,
			'user_notify' => 0,
			'user_notify_pm' => 1,
			'user_popup_pm' => 0,
			'user_rank' => 0,
			'user_avatar' => '',
			'user_avatar_type' => 0,
			'user_email' => '',
			'user_icq' => '',
			'user_website' => '',
			'user_from' => '',
			'user_sig' => '',
			'user_sig_bbcode_uid' => '',
			'user_aim' => '',
			'user_yim' => '',
			'user_msnm' => '',
			'user_occ' => '',
			'user_interests' => '',
			'user_actkey' => '',
			'user_newpasswd' => '',
		);
		$db->sql_statement($fields);
		$sql = 'INSERT INTO ' . USERS_TABLE . '
					(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
		$db->sql_query($sql, false, __LINE__, __FILE__);
		$parms['anon'] = true;
	}
	next_step();
}
if ( $parms['anon'] )
{
	$page->output('CH_anonymous_user_created');
}

// orphean groups : individual groups that are not linked to a user
if ( step() == 'CH_orphean_groups' )
{
	$sql = 'SELECT g.group_id
				FROM ' . GROUPS_TABLE . ' g
					LEFT JOIN ' . USER_GROUP_TABLE . ' ug
						ON ug.group_id = g.group_id
				WHERE ug.group_id IS NULL
					AND g.group_single_user = ' . TRUE;
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$group_ids = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$group_ids[] = intval($row['group_id']);
	}
	if ( $parms['og'] = count($group_ids) )
	{
		$sql = 'DELETE FROM ' . GROUPS_TABLE . '
					WHERE group_id IN(' . implode(', ', $group_ids) . ')';
		$db->sql_query($sql, false, __LINE__, __FILE__);
	}
	next_step();
}
if ( !empty($parms['og']) )
{
	$page->output(sprintf($page->lang('CH_orphean_groups_deleted'), $parms['og']));
}

// get user having more than one individual groups
if ( step() == 'CH_individual_groups_surnumerous' )
{
	$rows_a_turn = ceil(ROWS_A_TURN / 10);
	$sql = 'SELECT ug.user_id, MIN(ug.group_id) AS lower_group_id, SUM(g.group_single_user) AS total_single
				FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
				WHERE g.group_id = ug.group_id
					AND g.group_single_user = ' . TRUE . '
				GROUP BY ug.user_id
				HAVING SUM(g.group_single_user) > 1';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);

	// count
	$parms['tgs'] = max(intval($parms['tgs']), $remaining + 1);
	$percent_done = empty($remaining) ? 100 : 100 - round(doubleval($remaining * 100) / ($parms['tgs'] - 1));
	if ( $remaining >= $rows_a_turn )
	{
		percent_box(sprintf($page->lang('CH_individual_groups_surnumerous_percent'), $parms['tgs'] - 1 - $remaining, $parms['tgs'] - 1), $percent_done);
	}

	// read
	$user_ids = array();
	$i = 0;
	while ( ($row = $db->sql_fetchrow($result)) && ($i < $rows_a_turn) )
	{
		$user_ids[ intval($row['user_id']) ] = intval($row['lower_group_id']);
		$i++;
	}
	if ( !empty($user_ids) )
	{
		$group_ids = array();
		foreach ( $user_ids as $user_id => $group_id )
		{
			// read groups membership
			$sql = 'SELECT ug.group_id
						FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
						WHERE ug.user_id = ' . $user_id . '
							AND ug.group_id <> ' . $group_id . '
							AND g.group_id = ug.group_id
							AND g.group_single_user = ' . TRUE;
			$result = $db->sql_query($sql, false, __LINE__, __FILE__);
			while ( $row = $db->sql_fetchrow($result) )
			{
				$group_ids[] = intval($row['group_id']);
			}
		}
		if ( !empty($group_ids) )
		{
			// delete membership
			$sql = 'DELETE FROM ' . USER_GROUP_TABLE . '
						WHERE group_id IN(' . implode(', ', $group_ids) . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);

			// delete groups
			$sql = 'DELETE FROM ' . GROUPS_TABLE . '
						WHERE group_id IN(' . implode(', ', $group_ids) . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
	}
	$remaining -= $rows_a_turn;
	if ( $remaining > 0 )
	{
		$page->loop($parms);
	}
	next_step();
	$page->loop();
}
if ( !empty($parms['tgs']) )
{
	$page->output(sprintf($page->lang('CH_individual_groups_surnumerous'), $parms['tgs'] - 1));
}

// individual groups missing
if ( step() == 'CH_individual_groups' )
{
	$sql = 'SELECT u.user_id, SUM(g.group_single_user) AS total_single
				FROM ' . USERS_TABLE . ' u 
					LEFT JOIN ' . USER_GROUP_TABLE . ' ug
						ON ug.user_id = u.user_id
					LEFT JOIN ' . GROUPS_TABLE . ' g
						ON g.group_id = ug.group_id
							AND g.group_single_user = ' . TRUE . '
				GROUP BY user_id
				HAVING SUM(g.group_single_user) IS NULL';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);

	// count
	$remaining = $db->sql_numrows($result);
	$parms['tg'] = max(intval($parms['tg']), $remaining + 1);
	$percent_done = empty($remaining) ? 100 : 100 - round(doubleval($remaining * 100) / ($parms['tg'] - 1));
	if ( $remaining >= ROWS_A_TURN )
	{
		percent_box(sprintf($page->lang('CH_individual_groups_percent'), $parms['tg'] - 1 - $remaining, $parms['tg'] - 1), $percent_done);
	}

	// read
	$user_ids = array();
	$i = 0;
	while ( ($row = $db->sql_fetchrow($result)) && ($i < ROWS_A_TURN) )
	{
		$user_ids[] = intval($row['user_id']);
		$i++;
	}
	if ( $count_user_ids = count($user_ids) )
	{
		for ( $i = 0; $i < $count_user_ids; $i++ )
		{
			// create groups
			$fields = array(
				'group_name' => ($user_ids[$i] == ANONYMOUS) ? 'Group_anonymous' : '',
				'group_description' => ($user_ids[$i] == ANONYMOUS) ? 'Group_anonymous_desc' : 'Personal User',
				'group_status' => ($user_ids[$i] == ANONYMOUS) ? GROUP_SYSTEM : GROUP_STANDARD,
				'group_single_user' => true,
				'group_moderator' => 0,
			);
			$db->sql_statement($fields);
			$sql = 'INSERT INTO ' . GROUPS_TABLE . '
						(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);
			$group_id = $db->sql_nextid();

			// create user group link
			$fields = array(
				'user_id' => $user_ids[$i],
				'group_id' => $group_id,
				'user_pending' => false,
			);
			$db->sql_statement($fields);
			$sql = 'INSERT INTO ' . USER_GROUP_TABLE . '
						(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
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
if ( !empty($parms['tg']) )
{
	$page->output(sprintf($page->lang('CH_individual_groups_created'), $parms['tg'] - 1));
}

// surnumerous membership
if ( step() == 'CH_surnumerous_membership' )
{
	$rows_a_turn = ceil(ROWS_A_TURN / 2);
	$sql = 'SELECT user_id, group_id, COUNT(user_id) AS count_user_id, MAX(user_pending) AS max_user_pending
				FROM ' . USER_GROUP_TABLE . '
				GROUP BY user_id, group_id
				HAVING COUNT(user_id) > 1';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);

	// count
	$remaining = $db->sql_numrows($result);
	$parms['tms'] = max(intval($parms['tms']), $remaining + 1);
	$percent_done = empty($remaining) ? 100 : 100 - round(doubleval($remaining * 100) / ($parms['tms'] - 1));
	if ( $remaining >= ROWS_A_TURN )
	{
		percent_box(sprintf($page->lang('CH_surnumerous_membership_percent'), $parms['tms'] - 1 - $remaining, $parms['tms'] - 1), $percent_done);
	}

	// read
	$links = array();
	$i = 0;
	while ( ($row = $db->sql_fetchrow($result)) && ($i < $rows_a_turn) )
	{
		$links[] = array('u' => intval($row['user_id']), 'g' => intval($row['group_id']), 'p' => intval($row['max_user_pending']));
		$i++;
	}
	if ( $count_links = count($links) )
	{
		for ( $i = 0; $i < $count_links; $i++ )
		{
			$sql = 'DELETE FROM ' . USER_GROUP_TABLE . '
						WHERE user_id = ' . $links[$i]['u'] . '
							AND group_id = ' . $links[$i]['g'];
			$db->sql_query($sql, false, __LINE__, __FILE__);
			$fields = array(
				'user_id' => $links[$i]['u'],
				'group_id' => $links[$i]['g'],
				'user_pending' => $links[$i]['p'],
			);
			$db->sql_statement($fields);
			$sql = 'INSERT INTO ' . USER_GROUP_TABLE . '
						(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
	}
	$remaining -= $rows_a_turn;
	if ( $remaining > 0 )
	{
		$page->loop($parms);
	}
	next_step();
	$page->loop();
}
if ( !empty($parms['tms']) )
{
	$page->output(sprintf($page->lang('CH_surnumerous_membership'), $parms['tms'] - 1));
}

// reclaim board founder
if ( step() == 'CH_founder_req' )
{
	// reset user_id cache on groups
	$fields = array(
		'group_user_id' => 0,
		'group_user_list' => '',
	);
	$db->sql_statement($fields);
	$sql = 'UPDATE ' . GROUPS_TABLE . '
				SET ' . $db->sql_update;
	$db->sql_query($sql, false, __LINE__, __FILE__);

	$parms['fndreq'] = true;
	next_step();
	$page->loop();
}

// create/recreate system groups
if ( step() == 'CH_system_groups' )
{
	$sys_groups = array(
		'group_founder' => array('group_id' => 0, 'group_name' => 'Board_founder'),
		'group_admin' => array('group_id' => 0, 'group_name' => 'Group_admin'),
		'group_registered' => array('group_id' => 0, 'group_name' => 'Group_registered'),
		'group_anonymous' => array('group_id' => 0, 'group_name' => 'Group_anonymous'),
	);

	// search the groups in config table
	$sql = 'SELECT config_name, config_value
				FROM ' . CONFIG_TABLE . '
				WHERE config_name IN(\'' . implode('\', \'', array_keys($sys_groups)) . '\')';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	while ( $row = $db->sql_fetchrow($result) )
	{
		$sys_groups[ $row['config_name'] ]['group_id'] = intval($row['config_value']);
	}

	// get anonymous group
	$sql = 'SELECT ug.group_id
				FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
				WHERE ug.user_id = ' . ANONYMOUS . '
					AND g.group_id = ug.group_id
					AND g.group_single_user = ' . TRUE;
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	if ( $row = $db->sql_fetchrow($result) )
	{
		$sys_groups['group_anonymous']['group_id'] = intval($row['group_id']);
	}
	else
	{
		$page->critical_error('CH_anonymous_group_missing');
	}

	// check missing groups reading groups table on name
	$group_names = array();
	foreach ( $sys_groups as $config_name => $data )
	{
		if ( empty($data['group_id']) )
		{
			$group_names[ $data['group_name'] ] = $config_name;
		}
	}
	if ( !empty($group_names) )
	{
		$sql = 'SELECT group_id, group_name
					FROM ' . GROUPS_TABLE . '
					WHERE group_name IN(\'' . implode('\', \'', array_keys($group_names)) . '\')
						AND group_status = ' . GROUP_SYSTEM;
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		while ( $row = $db->sql_fetchrow($result) )
		{
			$sys_groups[ $group_names[ $row['group_name'] ] ]['group_id'] = intval($row['group_id']);
		}
	}

	// create or update groups
	$config->begin_transaction();
	foreach ( $sys_groups as $config_name => $data )
	{
		switch ( $config_name )
		{
			// update anonymous group
			case 'group_anonymous':
				$fields = array(
					'group_name' => 'Group_anonymous',
					'group_description' => 'Group_anonymous_desc',
					'group_type' => GROUP_OPEN,
					'group_status' => GROUP_SYSTEM,
					'group_moderator' => 0,
					'group_single_user' => true,
					'group_user_id' => ANONYMOUS,
					'group_user_list' => '',
				);
				$db->sql_statement($fields);
				$sql = 'UPDATE ' . GROUPS_TABLE . '
							SET ' . $db->sql_update . '
							WHERE group_id = ' . $data['group_id'];
				$db->sql_query($sql, false, __LINE__, __FILE__);
				break;

			// update or create other groups
			default:
				$fields = array(
					'group_name' => $data['group_name'],
					'group_description' => $data['group_name'] . '_desc',
					'group_type' => GROUP_CLOSED,
					'group_moderator' => $founder_id,
					'group_status' => GROUP_SYSTEM,
					'group_single_user' => false,
					'group_user_id' => 0,
					'group_user_list' => '',
				);
				$db->sql_statement($fields);
				if ( empty($data['group_id']) )
				{
					$sql = 'INSERT INTO ' . GROUPS_TABLE . '
								(' . $db->sql_fields . ') VALUES (' . $db->sql_values . ')';
					$db->sql_query($sql, false, __LINE__, __FILE__);
					$sys_groups[$config_name]['group_id'] = $db->sql_nextid();
				}
				else
				{
					$sql = 'UPDATE ' . GROUPS_TABLE . '
								SET ' . $db->sql_update . '
								WHERE group_id = ' . $data['group_id'];
					$db->sql_query($sql, false, __LINE__, __FILE__);
				}
				break;
		}
		$config->set($config_name, $sys_groups[$config_name]['group_id'], true);
	}
	$config->end_transaction();

	// populate the founder group
	$sql = 'DELETE FROM ' . USER_GROUP_TABLE . '
				WHERE group_id = ' . intval($sys_groups['group_founder']['group_id']) . '
					AND user_id = ' . $founder_id;
	$db->sql_query($sql, false, __LINE__, __FILE__);

	$fields = array(
		'group_id' => $sys_groups['group_founder']['group_id'],
		'user_id' => $founder_id,
		'user_pending' => false,
	);
	$db->sql_statement($fields);
	$sql = 'INSERT INTO ' . USER_GROUP_TABLE . '
				(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
	$db->sql_query($sql, false, __LINE__, __FILE__, false);

	// read the current admin groups
	if ( !empty($parms['chpv']) )
	{
		$sql = 'SELECT DISTINCT user_id
					FROM ' . USER_GROUP_TABLE . '
					WHERE group_id IN(' . $sys_groups['group_admin']['group_id'] . ', ' . $sys_groups['group_founder']['group_id'] . ')
						AND user_pending <> ' . TRUE . '
					GROUP BY user_id';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$user_ids = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( $row['user_id'] != ANONYMOUS )
			{
				$user_ids[] = intval($row['user_id']);
			}
		}
		if ( !empty($user_ids) )
		{
			// update level
			$sql = 'UPDATE ' . USERS_TABLE . '
						SET user_level = ' . ADMIN . '
						WHERE user_id IN(' . implode(', ', $user_ids) . ')
							AND user_active = ' . TRUE;
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
	}

	// clear the admin group
	$sql = 'DELETE FROM ' . USER_GROUP_TABLE . '
				WHERE group_id = ' . $sys_groups['group_admin']['group_id'];
	$db->sql_query($sql, false, __LINE__, __FILE__);

	// populate the admin group
	$sql = 'SELECT user_id
				FROM ' . USERS_TABLE . '
				WHERE user_level = ' . ADMIN . '
					AND user_active = ' . TRUE;
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	while ( $row = $db->sql_fetchrow($result) )
	{
		$fields = array(
			'group_id' => $sys_groups['group_admin']['group_id'],
			'user_id' => intval($row['user_id']),
			'user_pending' => false,
		);
		$db->sql_statement($fields);
		$sql = 'INSERT INTO ' . USER_GROUP_TABLE . '
					(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
		$db->sql_query($sql, false, __LINE__, __FILE__, false);
	}

	// clear the registered group
	$sql = 'DELETE FROM ' . USER_GROUP_TABLE . '
				WHERE group_id = ' . $sys_groups['group_registered']['group_id'];
	$db->sql_query($sql, false, __LINE__, __FILE__);

	// next
	next_step();
}
$page->output('CH_system_groups_done');

// link users to individual groups
if ( step() == 'CH_user_groups_sync' )
{
	$rows_a_turn = ceil(ROWS_A_TURN / 4);
	$sql = 'SELECT group_id
				FROM ' . GROUPS_TABLE . '
				WHERE group_user_id = 0
					AND group_single_user = ' . TRUE;
	// count
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$remaining = $db->sql_numrows($result);
	$parms['ti'] = max(intval($parms['ti']), $remaining + 1);
	$percent_done = empty($remaining) ? 100 : 100 - round(doubleval($remaining * 100) / ($parms['ti'] - 1));
	if ( $remaining >= $rows_a_turn )
	{
		percent_box(sprintf($page->lang('CH_user_groups_percent'), $parms['ti'] - 1 - $remaining, $parms['ti'] - 1), $percent_done);
	}

	// read
	$sql = 'SELECT ig.group_id, iug.user_id, ug.group_id AS membership_group_id
				FROM ' . GROUPS_TABLE . ' ig, ' . USER_GROUP_TABLE . ' iug
					LEFT JOIN ' . USER_GROUP_TABLE . ' ug
						ON ug.user_id = iug.user_id
							AND ug.user_pending <> ' . TRUE . '
				WHERE ig.group_user_id = 0
					AND ig.group_single_user = ' . TRUE . '
					AND iug.group_id = ig.group_id
				ORDER BY iug.user_id';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$group_ids = array();
	while ( ($row = $db->sql_fetchrow($result)) && (count($group_ids) < $rows_a_turn) )
	{
		if ( !isset($group_ids[ intval($row['group_id']) ]) )
		{
			$group_ids[ intval($row['group_id']) ] = array('user_id' => intval($row['user_id']), 'group_user_list' => array());
			if ( $row['user_id'] != ANONYMOUS )
			{
				$group_ids[ intval($row['group_id']) ]['group_user_list'][] = intval($config->data['group_registered']);
			}
		}
		$group_ids[ intval($row['group_id']) ]['group_user_list'][] = intval($row['membership_group_id']);
	}

	// read
	if ( !empty($group_ids) )
	{
		foreach ( $group_ids as $group_id => $data )
		{
			if ( !empty($data['group_user_list']) )
			{
				sort($data['group_user_list']);
			}
			$fields = array(
				'group_user_id' => $data['user_id'],
				'group_user_list' => empty($data['group_user_list']) ? '' : ',' . implode(',', $data['group_user_list']) . ',',
			);
			$db->sql_statement($fields);
			$sql = 'UPDATE ' . GROUPS_TABLE . '
						SET ' . $db->sql_update . '
						WHERE group_id = ' . $group_id;
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
	}
	$remaining -= $rows_a_turn;
	if ( $remaining > 0 )
	{
		$page->loop($parms);
	}
	next_step();

	// one last turn to reset the probable time overflow
	$page->loop();
}
if ( !empty($parms['ti']) )
{
	$page->output(sprintf($page->lang('CH_user_groups_created'), $parms['ti'] - 1));
}

// patch panels
if ( step() == 'CH_patch_panels' )
{
	$cp_panels = new cp_panels();
	$cp_panels->read();
	$cp_panels->patch();
	$parms['pp'] = true;
	next_step();
}
if ( !empty($parms['pp']) )
{
	$page->output('CH_panels_patched');
}

// import panels auths (shouldn't be required as already done by the patch process)
if ( step() == 'CH_import_pgauths' )
{
	// read current panels auth defs
	$sql = 'SELECT auth_type, auth_name, auth_order, auth_title
				FROM ' . AUTHS_DEF_TABLE . '
				ORDER BY auth_type, auth_order';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$auths_def = array();
	$last_order = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$auths_def[ $row['auth_type'] ][ $row['auth_name'] ] = true;
		$last_order[ $row['auth_type'] ] = intval($row['auth_order']);
	}

	// auths to add
	$auths_to_add = array();
	if ( !isset($auths_def[POST_PANELS_URL]['auth_manage']) )
	{
		$auths_to_add[POST_PANELS_URL]['auth_manage'] = true;
	}
	if ( !isset($auths_def[POST_PANELS_URL]['access']) )
	{
		$auths_to_add[POST_PANELS_URL]['access'] = true;
	}

	// get auths from panels
	$sql = 'SELECT DISTINCT panel_auth_type, panel_auth_name
				FROM ' . CP_PANELS_TABLE . '
				WHERE panel_auth_type <> \'\'
					AND panel_auth_name <> \'\'
				GROUP BY panel_auth_type, panel_auth_name';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	while ( $row = $db->sql_fetchrow($result) )
	{
		if ( !isset($auths_def[ $row['panel_auth_type'] ][ $row['panel_auth_name'] ]) )
		{
			$auths_to_add[ $row['panel_auth_type'] ][ $row['panel_auth_name'] ] = true;
		}
	}

	// get auths from fields (can only be groups type)
	$sql = 'SELECT field_attr
				FROM ' . CP_FIELDS_TABLE . '
				WHERE field_attr LIKE \'%field_auth%\'
					AND field_name <> \'\'';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	while ( $row = $db->sql_fetchrow($result) )
	{
		// unpack data
		$field = unserialize(stripslashes($row['field_attr']));

		// check auths
		if ( !empty($field['field_auth']) )
		{
			if ( is_array($field['field_auth']) )
			{
				$count_auths_names = count($field['field_auth']);
				for ( $i = 0; $i < $count_auths_names; $i++ )
				{
					if ( !isset($auths_def[POST_GROUPS_URL][ $field['field_auth'][$i] ]) )
					{
						$auths_to_add[POST_GROUPS_URL][ $field['field_auth'][$i] ] = true;
					}
				}
			}
			else
			{
				if ( !isset($auths_def[POST_GROUPS_URL][ $field['field_auth'] ]) )
				{
					$auths_to_add[POST_GROUPS_URL][ $field['field_auth'] ] = true;
				}
			}
		}
	}

	// add the auths defs
	$db->sql_stack_reset();
	foreach ( $auths_to_add as $auth_type => $data )
	{
		if ( !isset($last_order[$auth_type]) )
		{
			$last_order[$auth_type] = 0;
		}
		if ( !empty($data) )
		{
			foreach ( $data as $auth_name => $dummy )
			{
				if ( !isset($auths_def[$auth_type][$auth_name]) )
				{
					$last_order[$auth_type] += 10;
					$fields = array(
						'auth_type' => $auth_type,
						'auth_name' => $auth_name,
						'auth_desc' => $auth_name,
						'auth_title' => false,
						'auth_order' => $last_order[$auth_type],
					);
					// prepare insert rows
					$db->sql_stack_statement($fields);
				}
			}
		}
	}
	if ( !empty($db->sql_stack_values) )
	{
		$db->sql_stack_insert(AUTHS_DEF_TABLE, false, __LINE__, __FILE__);
		$parms['ipa'] = true;
	}
	next_step();
	$page->loop();
}
if ( !empty($parms['ipa']) )
{
	$page->output('CH_panels_auths_def_added');
}

// import forums auths
if ( step() == 'CH_import_fauths' )
{
	// read current forum auth defs
	$sql = 'SELECT auth_name, auth_order, auth_title
				FROM ' . AUTHS_DEF_TABLE . '
				WHERE auth_type = \'' . POST_FORUM_URL . '\'
				ORDER BY auth_order';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$auths_def = array();
	$last_order = 0;
	while ( $row = $db->sql_fetchrow($result) )
	{
		if ( !$row['auth_title'] )
		{
			$auths_def[ $row['auth_name'] ] = true;
		}
		$last_order = intval($row['auth_order']);
	}

	// get auths def from auth.php (original phpBB auths) and add the new that don't require phpBB forums table auth field
	$no_req_auths_def = array('auth_mod', 'auth_mod_display', 'auth_manage');
	$phpbb_auths_def = array_merge(get_forums_auths_def(), $no_req_auths_def);

	// create auths defs
	$count_phpbb_auths_def = count($phpbb_auths_def);
	$auth_names = array();
	$auth_fields = array();
	$db->sql_stack_reset();
	for ( $i = 0; $i < $count_phpbb_auths_def; $i++ )
	{
		$auth_name = $phpbb_auths_def[$i];
		if ( !isset($auths_def[$auth_name]) )
		{
			$last_order += 10;
			$fields = array(
				'auth_type' => POST_FORUM_URL,
				'auth_name' => $auth_name,
				'auth_desc' => $auth_name,
				'auth_title' => false,
				'auth_order' => $last_order,
			);
			$db->sql_stack_statement($fields);
			$auth_names[] = $auth_name;
			if ( !in_array($auth_name, $no_req_auths_def) )
			{
				$auth_fields[] = $auth_name;
			}
		}
	}
	if ( !empty($db->sql_stack_values) )
	{
		$db->sql_stack_insert(AUTHS_DEF_TABLE, false, __LINE__, __FILE__);
		$parms['ifad'] = true;
	}

	// set values
	if ( empty($parms['chpv']) && ($count_auth_names = count($auth_names)) )
	{
		// read authed groups
		$sql = 'SELECT *
					FROM ' . AUTH_ACCESS_TABLE . '
					ORDER BY forum_id';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$acls = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			for ( $i = 0; $i < $count_auth_names; $i++ )
			{
				$auth_name = $auth_names[$i];

				// adjust some auths
				if ( $auth_name = 'auth_mod_display' )
				{
					$row[$auth_name] = $row['auth_mod'];
				}
				if ( $row[$auth_name] )
				{
					if ( !isset($acls[ intval($row['forum_id']) ]) )
					{
						$acls[ $row['forum_id'] ] = array();
					}
					if ( !isset($acls[ intval($row['forum_id']) ][$auth_name]) )
					{
						$acls[ intval($row['forum_id']) ][$auth_name] = array();
					}
					$acls[ intval($row['forum_id']) ][$auth_name][] = intval($row['group_id']);
				}
			}
		}
		$db->sql_freeresult($result);

		$count_auth_fields = count($auth_fields);
		$sql = 'SELECT forum_id' . (empty($auth_fields) ? '' : ', ' . implode(', ', $auth_fields)) . '
					FROM ' . FORUMS_TABLE;
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$db->sql_stack_reset();
		while ( $row = $db->sql_fetchrow($result) )
		{
			// check requirements
			for ( $i = 0; $i < $count_auth_names; $i++ )
			{
				switch ( $auth_names[$i] )
				{
					case 'auth_mod':
						$auth_req = AUTH_ACL;
						break;
					case 'auth_mod_display':
						$auth_req = AUTH_MOD;
						break;
					case 'auth_manage':
						$auth_req = AUTH_ADMIN;
						break;
					default:
						$auth_req = $row[ $auth_names[$i] ];
						break;
				}
				$group_ids = array();
				switch ( $auth_req )
				{
					case AUTH_ALL:
						$group_ids[] = intval($config->data['group_anonymous']);
					case AUTH_REG:
						$group_ids[] = intval($config->data['group_registered']);
						break;
					case AUTH_MOD:
					case AUTH_ACL:
						$auth_name = ($auth_req == AUTH_MOD) ? 'auth_mod' : $auth_names[$i];
						if ( !empty($acls[ intval($row['forum_id']) ][$auth_name]) )
						{
							$group_ids = $acls[ intval($row['forum_id']) ][$auth_name];
						}
						// we don't want to display admin as moderators
						if ( $auth_names[$i] == 'auth_mod_display' )
						{
							break;
						}
					case AUTH_ADMIN:
						$group_ids[] = intval($config->data['group_admin']);
						break;
				}

				// build the sql request
				if ( !empty($group_ids) )
				{
					$count_group_ids = count($group_ids);
					for ( $j = 0; $j < $count_group_ids; $j++ )
					{
						$fields = array(
							'group_id' => $group_ids[$j],
							'obj_type' => POST_FORUM_URL,
							'obj_id' => intval($row['forum_id']),
							'auth_name' => $auth_names[$i],
							'auth_value' => true,
						);
						$db->sql_stack_statement($fields);
					}
				}
			}

			// create the auths access
			if ( !empty($db->sql_stack_values) )
			{
				$db->sql_stack_insert(AUTHS_TABLE, false, __LINE__, __FILE__);
				$parms['ifav'] = true;
			}
		}
	}

	next_step();
	$page->loop();
}
if ( !empty($parms['ifad']) )
{
	$page->output('CH_forum_auths_def_added');
}
if ( !empty($parms['ifav']) )
{
	$page->output('CH_forum_auths_values_added');
}

if ( step() == 'CH_ptifo' )
{
	$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_style = 0';
	$db->sql_query($sql, false, __LINE__, __FILE__);

	$sql = 'SELECT themes_id
				FROM ' . THEMES_TABLE . '
				WHERE template_name = \'ptifo\'';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	if ( $row = $db->sql_fetchrow($result) )
	{
		$ptifo_id = intval($row['themes_id']);
		$parms['ptifo'] = 1;
	}
	else
	{
		$fields = array(
			'template_name' => 'ptifo',
			'style_name' => 'ptifo',
			'images_pack' => '',
			'custom_tpls' => '',
			'head_stylesheet' => 'ptifo.css',
			'body_background' => '',
			'body_bgcolor' => '',
			'body_text' => '',
			'body_link' => '',
			'body_vlink' => '',
			'body_alink' => '',
			'body_hlink' => '',
			'tr_color1' => '',
			'tr_color2' => '',
			'tr_color3' => '',
			'tr_class1' => '',
			'tr_class2' => '',
			'tr_class3' => '',
			'th_color1' => '',
			'th_color2' => '',
			'th_color3' => '',
			'th_class1' => '',
			'th_class2' => '',
			'th_class3' => '',
			'td_color1' => '',
			'td_color2' => '',
			'td_color3' => '',
			'td_class1' => '',
			'td_class2' => '',
			'td_class3' => '',
			'fontface1' => '',
			'fontface2' => '',
			'fontface3' => '',
			'fontsize1' => 0,
			'fontsize2' => 0,
			'fontsize3' => 0,
			'fontcolor1' => '444444',
			'fontcolor2' => '006600',
			'fontcolor3' => 'FFA34F',
			'span_class1' => '',
			'span_class2' => '',
			'span_class3' => '',
			'img_size_poll' => 0,
			'img_size_privmsg' => 0,
		);
		$db->sql_statement($fields);
		$sql = 'INSERT INTO ' . THEMES_TABLE . '
					(' . $db->sql_fields . ') VALUES(' . $db->sql_values . ')';
		$db->sql_query($sql, false, __LINE__, __FILE__);
		$ptifo_id = $db->sql_nextid();
		$parms['ptifo'] = 2;
	}
	$config->set('default_style', $ptifo_id);
	next_step();
}
if ( $parms['ptifo'] == 1 )
{
	$page->output('CH_ptifo_default');
}
if ( $parms['ptifo'] == 2 )
{
	$page->output('CH_ptifo_installed');
}

// all is done, recache
if ( step() == 'CH_end' )
{
	$sql = 'DELETE FROM ' . USERS_CACHE_TABLE;
	$db->sql_query($sql, false, __LINE__, __FILE__);

	$config->read(true);
	$forums = new forums();
	$forums->read(true);

	$config->set('mod_cat_hierarchy', CH_CURRENT_VERSION, true);

	$page->error(empty($parms['chpv']) ? 'CH_install_done' : 'CH_install_upgraded');
	$page->critical_error('CH_return_to_board');
}

// send page
$page->header();
$page->footer();

?>