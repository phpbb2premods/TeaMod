<?php
/***************************************************************************
 *							admin_settings.php
 *							------------------
 *	begin		: 08/10/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.6 - 30/04/2005
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

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Configuration+'] = "$file";
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($config->url('includes/class_form'));
include($config->url('includes/class_cp'));

// define the control panel
$cp_name = 'acp';

// return messages & other urls settings
$cp_requester = 'admin/admin_settings';
$cp_parms = array();

// layout switches
$cp_no_navigation = false;
$cp_no_menus = false;

// right side title
$cp_panel_name = '';

// button var name
$cp_submit_button = 'submit_form';
$cp_cancel_button = 'cancel_form';
$cp_delete_button = 'delete_form';

// read panels and apply patches if available
$cp_panels = new cp_panels();
$cp_panels->read();
$cp_panels->patch();

// no panels : end there
if ( empty($cp_panels->keys) )
{
	message_die(GENERAL_MESSAGE, 'No_options');
}

// retrieve auths
$user->get_cache(POST_PANELS_URL);

// search for the $cp_name panel_id
$cp_panel_id = $cp_panels->search(0, $cp_name);

// we don't need any viewed user for auth check
$view_user = '';
if ( !$cp_panels->auth($cp_panel_id, $view_user) )
{
	message_die(GENERAL_ERROR, 'Not_Authorised');
}

// get the first level menus
$panels = $cp_panels->get_menu($cp_panel_id);
$menus = array();
if ( !empty($panels) )
{
	foreach ( $panels as $shortcut => $panel_id )
	{
		if ( $cp_panels->auth($panel_id, $view_user) )
		{
			$menus[$shortcut] = $panel_id;
		}
	}
}
if ( empty($menus) )
{
	message_die(GENERAL_ERROR, 'Not_Authorised');
}

// get the menus parm
$menu_id = _read('mode', TYPE_NO_HTML);
if ( empty($menu_id) || !isset($menus[$menu_id]) )
{
	$found = false;
	foreach ( $menus as $shortcut => $id )
	{
		$found = !empty($menu_id) || !$cp_panels->data[$id]['panel_hidden'];
		if ( $found )
		{
			$menu_id = $shortcut;
			break;
		}
	}
	if ( !$found )
	{
		$menu_id = '';
	}
}
if ( empty($menu_id) )
{
	message_die(GENERAL_MESSAGE, 'Not_Authorised');
}

// get the second level menus
$panels = $cp_panels->get_menu($menus[$menu_id]);
$sub_menus = array();
if ( !empty($panels) )
{
	foreach ( $panels as $shortcut => $panel_id )
	{
		if ( $cp_panels->auth($panel_id, $view_user) )
		{
			$sub_menus[$shortcut] = $panel_id;
		}
	}
}
$dft_sub = '';
if ( empty($sub_menus) )
{
	$sub_menus[$menu_id] = $menus[$menu_id];
	$dft_sub = $menu_id;
}

// get sub-menu parm
$subm_id = _read('sub', TYPE_NO_HTML, $dft_sub);
if ( empty($subm_id) || !isset($sub_menus[$subm_id]) )
{
	$found = false;
	foreach ( $sub_menus as $shortcut => $id )
	{
		$found = !empty($subm_id) || !$cp_panels->data[$id]['panel_hidden'];
		if ( $found )
		{
			$subm_id = $shortcut;
			break;
		}
	}
	if ( !$found )
	{
		$subm_id = '';
	}
}
if ( empty($subm_id) )
{
	message_die(GENERAL_MESSAGE, 'Not_Authorised');
}

// prepare navigation
$navigation->add('Admin_control_panel', '', $cp_requester);
$navigation->add( $cp_panels->data[ $menus[$menu_id] ]['panel_name'], '', $cp_requester, $cp_parms + array('mode' => $menu_id));
if ( $menu_id != $subm_id )
{
	$navigation->add( $cp_panels->data[ $sub_menus[$subm_id] ]['panel_name'], '', $cp_requester, $cp_parms + array('mode' => $menu_id, 'sub' => $subm_id));
}

// init fields
$fields = array();

// include the specified files
$file = $config->url((empty($cp_panels->data[ $sub_menus[$subm_id] ]['panel_file']) ? 'includes/' . $cp_name . '/' . $cp_name . '_generic' : $cp_panels->data[ $sub_menus[$subm_id] ]['panel_file']));
if ( !file_exists($file) )
{
	// send "no options"
	$cp_panels->display_empty();
}
else
{
	// get the fields
	$sql = 'SELECT *
				FROM ' . CP_FIELDS_TABLE . '
				WHERE panel_id = ' . intval($sub_menus[$subm_id]) . '
				ORDER BY field_order';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	$fields = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		// do some tweaking regarding dynamical data
		if ( !empty($row['field_name']) )
		{
			// unpack data
			$field = unserialize(stripslashes($row['field_attr']));

			// check auths
			$authed = true;
			if ( !empty($field['field_auth']) )
			{
				$auth_type = POST_GROUPS_URL;
				$auth_name = $field['field_auth'];
				if ( $view_user->data['user_id'] == ANONYMOUS )
				{
					$group_user_list = array(GROUP_ANONYMOUS);
				}
				else if ( $view_user->data['user_id'] == $user->data['user_id'] )
				{
					$group_user_list = array(GROUP_OWN);
				}
				else
				{
					$group_user_list = $view_user->get_groups_list();
				}
				$authed = $user->auth($auth_type, $auth_name, $group_user_list);
			}

			if ( $authed )
			{
				$fields[ $row['field_name'] ] = $field;
				if ( !empty($fields[ $row['field_name'] ]['class_file']) )
				{
					@include_once($config->url($fields[ $row['field_name'] ]['class_file']));
				}
				foreach ( $fields[ $row['field_name'] ] as $key => $val )
				{
					if ( !empty($val) && is_string($val) && preg_match('/^\[/', $val) )
					{
						$var_check = explode(', ', preg_replace('/^\[([^\]]*)\](.*)/i', '\1, \2', $val));
						if ( !empty($var_check[1]) && preg_match('/^\[/', $var_check[1]) )
						{
							$file_check = explode(', ', preg_replace('/^\[([^\]]*)\](.*)/i', '\1, \2', $var_check[1]));
							if ( !empty($file_check[1]) )
							{
								$var_check[1] = $file_check[1];
								$var_check[2] = $file_check[0];
							}
						}
						if ( (count($var_check) > 1) && !empty($var_check[0]) && !empty($var_check[1]) )
						{
							if ( !empty($var_check[2]) )
							{
								@include_once($config->url($var_check[2]));
							}
							$entity_name = $var_check[1];
							switch ( $var_check[0] )
							{
								case 'var':
									$res = '';
									if ( isset($$entity_name) )
									{
										$res = $$entity_name;
									}
									$fields[ $row['field_name'] ][$key] = $res;
									break;
								case 'func':
									$res = '';
									if ( function_exists($entity_name) )
									{
										$res = $entity_name();
									}
									$fields[ $row['field_name'] ][$key] = $res;
									break;
							}
						}
					}
				}
			}
		}
	}

	// include the file
	include($file);
}

// display constants
$template->assign_vars(array(
	'L_TITLE' => $user->lang('General_Config'),
	'L_TITLE_EXPLAIN' => $user->lang('Config_explain'),

	'L_MENU' => $user->lang('Configuration'),
	'L_FORM' => empty($cp_panel_name) ? $user->lang($cp_panels->data[ $sub_menus[$subm_id] ]['panel_name']) : $user->lang($cp_panel_name),

	'L_SUBMIT' => $user->lang('Submit'),
	'I_SUBMIT' => $user->img('cmd_submit'),
	'SUBMIT' => $cp_submit_button,

	'L_CANCEL' => $user->lang('Cancel'),
	'I_CANCEL' => $user->img('cmd_cancel'),
	'CANCEL' => $cp_cancel_button,

	'L_DELETE' => $user->lang('Delete'),
	'I_DELETE' => $user->img('cmd_delete'),
	'DELETE' => $cp_delete_button,

	'I_SPACER' => $user->img('spacer'),
	'S_ACTION' => $config->url($cp_requester, '', true),
));

// display nav
if ( !$cp_no_navigation )
{
	$navigation->display('nav', false);
}

// display menu
if ( !$cp_no_menus )
{
	$cp_panels->display_menus($menus, $sub_menus, $menu_id, $subm_id, $cp_requester, $cp_parms, 'CP_MENUS_BOX');
}

// hide some values on form
_hide($cp_parms + array('mode' => $menu_id));
if ( $subm_id != $menu_id )
{
	_hide('sub', $subm_id);
}
_hide_set();

// send all to browser
$template->pparse('body');
include($config->url('admin/page_footer_admin'));

?>