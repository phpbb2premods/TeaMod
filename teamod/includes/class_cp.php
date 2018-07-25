<?php
/***************************************************************************
 *							class_cp.php
 *							------------
 *	begin		: 30/09/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.11 - 23/10/2005
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

//-------------------------------------
// lists and basic relatives functions
//-------------------------------------
$list_no_yes = array(
	0 => 'No',
	1 => 'Yes',
);

$list_reverse_no_yes = array(
	1 => 'No',
	0 => 'Yes',
);

$list_dft_yes_deny = array(
	0 => 'Default',
	1 => 'Yes',
	DENY => 'No',
);

//
// time zone
//
function get_list_timezone()
{
	global $lang;

	$list_timezone = array();
	if ( !empty($lang['tz']) )
	{
		foreach ( $lang['tz'] as $offset => $zone )
		{
			$list_timezone[ sprintf('%01.2f', $offset) ] = sprintf($lang['UTC'], $offset < 0 ? '-' : '+', floatval(abs($offset)));
		}
	}
	return $list_timezone;
}

//
// date format
//
function get_list_dateformat()
{
	global $user;

	$list_dateformat = array(
		'D m d, Y g:i a' => '',
		'D d-m-Y, H:i' => '',
		'M Y, D d, g:i a' => '',
		'D d M Y, H:i' => '',
		'd M Y g:i a' => '',
		'd M Y H:i' => '',
		'D M d, Y g:i a' => '',
		'D M d, Y H:i' => '',
	);
	$now = time();
	foreach ( $list_dateformat as $fmt => $dummy )
	{
		$list_dateformat[$fmt] = $user->date($now, $fmt, false);
	}
	$list_dateformat = array('' => 'Custom') + $list_dateformat;

	return $list_dateformat;
}

//
// topics sort/order list
//
function get_list_topics_sort()
{
	global $config;

	include_once($config->url('includes/class_topics'));
	$topics = new topics();
	$list_topics_sort = array();
	foreach ( $topics->sort_fields as $sort_name => $data )
	{
		$list_topics_sort[$sort_name] = $data['txt'];
	}
	return $list_topics_sort;
}

function get_list_topics_sort_dft()
{
	return array('' => 'Default') + get_list_topics_sort();
}

$list_topics_order = array(
	'ASC' => 'Sort_Ascending', 
	'DESC' => 'Sort_Descending'
);
$list_topics_order_dft = array('' => 'Default') + $list_topics_order;

//
// styles list
//
function get_list_styles()
{
	global $themes;

	if ( empty($themes) )
	{
		$themes = new themes();
		$themes->read();
	}
	$list_styles = array(); // array(0 => 'Default');
	if ( !empty($themes->data) )
	{
		foreach ( $themes->data as $theme_id => $themes_data )
		{
			$list_styles[$theme_id] = $themes_data['style_name'];
		}
	}
	return $list_styles;
}

function get_list_styles_dft()
{
	return array('' => 'Default') + get_list_styles();
}

//
// langs list
//
function get_list_langs()
{
	global $config;

	$dir = opendir($config->root . 'language');
	$list_langs = array();
	while ( $file = readdir($dir) )
	{
		if ( preg_match('#^lang_#i', $file) && is_dir(@phpbb_realpath($config->root . 'language' . '/' . $file)) )
		{
			$filename = trim(str_replace('lang_', '', $file));
			$list_langs[$filename] = ucfirst(preg_replace('/\[(.*?)_(.*)\]/', '[ \\1 - \\2 ]', preg_replace('/^(.*?)_(.*)$/', '\\1 [ \\2 ]', $filename)));
		}
	}
	closedir($dir);
	@asort($list_langs);

	return $list_langs;
}

//-------------------------------------
// panels & patches classes
//-------------------------------------
class cp_panels_cache extends cache
{
	function pre_process(&$rows)
	{
		$rows[0] = array('last_child_id' => 0, 'panel_order' => 0);
	}

	function row_process(&$rows, $row_id)
	{
		$rows[$row_id]['last_child_id'] = $row_id;
		$rows[$row_id]['subs'] = array();
		if ( !empty($row_id) )
		{
			$rows[ intval($rows[$row_id]['panel_main']) ]['subs'][] = $row_id;
			if ( empty($rows[$row_id]['panel_auth_type']) )
			{
				$rows[$row_id]['panel_auth_type'] = POST_PANELS_URL;
				$rows[$row_id]['panel_auth_name'] = 'access';
			}
		}
	}

	function post_process(&$rows)
	{
		// overwrite panel root def.
		$rows[0] = array_merge($rows[0], array(
			'panel_id' => 0,
			'panel_name' => 'Panels_index',
		));

		// get keys and last branch panel id
		$keys = array_keys($rows);
		$count_keys = count($keys);
		for ( $i = $count_keys-1; $i > 0; $i-- )
		{
			$cur_id = $keys[$i];
			$main_id = $rows[$cur_id]['panel_main'];
			if ( $rows[ $rows[$cur_id]['last_child_id'] ]['panel_order'] > $rows[ $rows[$main_id]['last_child_id'] ]['panel_order'] )
			{
				$rows[$main_id]['last_child_id'] = $rows[$cur_id]['last_child_id'];
			}
		}
	}
}

class cp_panels
{
	var $data;
	var $data_time;
	var $from_cache;
	var $data_flag;
	var $keys;

	var $panels_patched;
	var $auths_def;
	var $auths_def_added;

	function cp_panels()
	{
		$this->data = '';
		$this->data_time = '';
		$this->from_cache = '';
		$this->data_flag = '';
		$this->keys = '';
		$this->panels_patched = '';
	}

	function read($force=false)
	{
		global $config;

		if ( !$force && $this->data_flag )
		{
			return $this->data;
		}
		$db_cached = new cp_panels_cache('dta_cp_panels', $config->data['cache_path'], $config->data['cache_disabled_cp_panels']);
		$sql = 'SELECT *
					FROM ' . CP_PANELS_TABLE . '
					ORDER BY panel_order';
		$this->data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force, 'panel_id');
		$this->data_flag = true;
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;
		$this->keys = empty($this->data) ? array() : array_keys($this->data);
	}

	function renum()
	{
		// build the subs informations
		$this->keys = array_keys($this->data);
		$count_keys = count($this->keys);
		for ( $i = 0; $i < $count_keys; $i++ )
		{
			$this->data[ $this->keys[$i] ]['subs'] = array();
			if ( !empty($this->keys[$i]) )
			{
				$main_id = $this->data[ $this->keys[$i] ]['panel_main'];
				$this->data[$main_id]['subs'][] = $this->keys[$i];
			}
		}
		$order = 0;
		$this->renum_order(0, $order);
	}

	function renum_order($panel_id, &$order)
	{
		$this->data[$panel_id]['panel_order'] = $order;
		$count_subs = count($this->data[$panel_id]['subs']);
		for ( $i = 0; $i < $count_subs; $i++ )
		{
			$order += 10;
			$this->renum_order($this->data[$panel_id]['subs'][$i], $order);
		}
	}

	function get_menu($main_id)
	{
		$res = array();
		$count_subs = count($this->data[$main_id]['subs']);
		for ( $i = 0; $i < $count_subs; $i++ )
		{
			$sub_id = $this->data[$main_id]['subs'][$i];
			$res[ $this->data[$sub_id]['panel_shortcut'] ] = $sub_id;
		}
		return $res;
	}

	function auth($panel_id, &$view_user)
	{
		global $db, $user;

		if ( empty($panel_id) )
		{
			return false;
		}
		if ( empty($this->data[$panel_id]['panel_auth_type']) )
		{
			return true;
		}
		$is_auth = false;
		switch ( $this->data[$panel_id]['panel_auth_type'] )
		{
			// auth based on groups
			case POST_GROUPS_URL:
				if ( !empty($view_user) && !empty($view_user->data) )
				{
					if ( $view_user->data['user_id'] == ANONYMOUS )
					{
						$obj_ids = array(GROUP_ANONYMOUS);
					}
					else if ( $view_user->data['user_id'] == $user->data['user_id'] )
					{
						$obj_ids = array(GROUP_OWN);
					}
					else
					{
						$obj_ids = $view_user->get_groups_list();
					}

					// check auths
					$is_auth = $user->auth($this->data[$panel_id]['panel_auth_type'], $this->data[$panel_id]['panel_auth_name'], $obj_ids);
				}
				break;

			// auth based on panels
			case POST_PANELS_URL:
				$is_auth = $user->auth($this->data[$panel_id]['panel_auth_type'], $this->data[$panel_id]['panel_auth_name'], $panel_id);
				break;
		}
		return $is_auth;
	}

	function display_menus(&$menus, &$sub_menus, $menu_id, $subm_id, $requester, $parms='', $tpl_box='')
	{
		global $template, $config, $user;

		if ( empty($menus) )
		{
			return;
		}
		if ( empty($parms) )
		{
			$parms = array();
		}
		foreach ( $menus as $cur_shortcut => $cur_panel )
		{
			if ( !$this->data[$cur_panel]['panel_hidden'] )
			{
				$template->assign_block_vars('option', array(
					'L_OPTION' => $user->lang($this->data[$cur_panel]['panel_name']),
					'U_OPTION' => $config->url($requester, $parms + array('mode' => $cur_shortcut), true),
				));
				$template->set_switch('option.active', $cur_shortcut == $menu_id);
				if ( ($cur_shortcut == $menu_id) && (count($sub_menus) > 1) && ($sub_menus[$subm_id] != $cur_panel) )
				{
					// check if a not hidden panel is present
					$not_hidden = false;
					foreach ( $sub_menus as $sub_shortcut => $sub_panel )
					{
						$not_hidden = !$this->data[$sub_panel]['panel_hidden'];
						if ( $not_hidden )
						{
							break;
						}
					}

					// send the sub menu
					if ( $not_hidden )
					{
						$template->set_switch('option.active.subs');
						foreach ( $sub_menus as $sub_shortcut => $sub_panel )
						{
							if ( !$this->data[$sub_panel]['panel_hidden'] )
							{
								$template->assign_block_vars('option.active.sub', array(
									'L_OPTION' => $user->lang($this->data[$sub_panel]['panel_name']),
									'U_OPTION' => $config->url($requester, $parms + array('mode' => $cur_shortcut, 'sub' => $sub_shortcut), true),
								));
								$template->set_switch('option.active.sub.select', $sub_shortcut == $subm_id);
							}
						}
					}
				}
			}
		}

		// send to display
		if ( !empty($tpl_box) )
		{
			$template->set_filenames(array('cp_menus_box' => 'cp_menus_box.tpl'));
			$template->assign_var_from_handle($tpl_box, 'cp_menus_box');
		}
	}

	function display_empty($empty='')
	{
		global $template, $user;

		if ( empty($empty) )
		{
			$empty = 'No_options';
		}

		// send "no options"
		$template->set_filenames(array('body' => 'cp_generic.tpl'));
		$template->assign_vars(array(
			'L_EMPTY' => $user->lang($empty),
		));
		$template->set_switch('empty');
	}

	function search($main_id, $panel_shortcut)
	{
		if ( empty($this->data[$main_id]['subs']) )
		{
			return 0;
		}
		$count_cps = count($this->data[$main_id]['subs']);
		$found = false;
		$panel_id = 0;
		for ( $i = 0; $i < $count_cps; $i++ )
		{
			$sub_id = $this->data[$main_id]['subs'][$i];
			$found = ($this->data[$sub_id]['panel_shortcut'] == $panel_shortcut);
			if ( $found )
			{
				return $sub_id;
			}
		}
		return 0;
	}

	function patch()
	{
		global $db, $config, $user;

		$cp_patches = new cp_patches();
		$cp_patches->read();
		$now = time();
		$patches = $cp_patches->patches_handle();

		// process the patches
		$count_patches = count($patches);
		if ( $count_patches )
		{
			// get existing auths list
			$this->auths_def = new auth_class();
			$this->auths_def->read();
			$this->auths_def_added = array();

			// process
			for ( $i = 0; $i < $count_patches; $i++ )
			{
				$this->panels_patched = array();
				$this->node_handle(0, $patches[$i]['options']);

				// does some auths have been sat ?
				if ( !empty($this->panels_patched) || !empty($patches[$i]['auths']) )
				{
					$this->auths_handle($this->panels_patched, $patches[$i]['auths']);
				}
			}

			// reorder
			$order = -10;
			$this->reorder(0, $order);

			// recache
			$this->read(true);
			$config->begin_transaction();
			$config->set('cache_time_' . POST_PANELS_URL, $now);
			$config->set('cache_time_' . POST_GROUPS_URL, $now);
			$config->end_transaction();

			// new auths def
			if ( !empty($this->auths_def_added) )
			{
				$db->sql_stack_reset();
				foreach ( $this->auths_def_added as $auth_type => $auth_names )
				{
					if ( !empty($auth_names) )
					{
						foreach ( $auth_names as $auth_name => $dummy )
						{
							$fields = array(
								'auth_type' => $auth_type,
								'auth_name' => $auth_name,
								'auth_desc' => ($user->lang($auth_name) == $auth_name) ? '' : $auth_name,
								'auth_title' => false,
								'auth_order' => 9999999,
							);
							$db->sql_stack_statement($fields);
						}
					}
				}
				if ( !empty($db->sql_stack_values) )
				{
					$db->sql_stack_insert(AUTHS_DEF_TABLE, false, __LINE__, __FILE__);

					// renum & recache auths def
					$this->auths_def->renum();
					$this->auths_def->read(true);
				}
			}
			unset($this->auths_def);
			unset($this->auths_def_added);

			// rechache user
			$user->get_cache(array(POST_PANELS_URL, POST_GROUPS_URL));

			// recache moderators (a group may become invisible)
			include_once($config->url('includes/class_forums'));
			$moderators = new moderators();
			$moderators->set_users_status();
			$moderators->read(true);
			unset($moderators);
		}
	}

	function node_handle($main_id, $patches)
	{
		if ( empty($patches) )
		{
			return;
		}

		// get shorcuts of this level
		$shortcuts = array();
		foreach ( $patches as $panel_shortcut => $panel_data )
		{
			if ( !empty($panel_shortcut) && !empty($panel_data) )
			{
				// search panel
				$panel_id = $this->search($main_id, $panel_shortcut);

				// update or panel
				if ( !isset($panel_data['name']) )
				{
					$panel_data['name'] = '';
				}
				if ( !isset($panel_data['file']) )
				{
					$panel_data['file'] = '';
				}
				if ( !isset($panel_data['auth']) )
				{
					$panel_data['auth'] = array();
				}
				if ( !isset($panel_data['hidden']) )
				{
					$panel_data['hidden'] = false;
				}
				$panel_id = $this->update($main_id, $panel_id, $panel_shortcut, $panel_data);

				// update or create auths
				if ( !empty($panel_data['auth']) )
				{
					$this->panels_patched[] = $panel_id;
				}

				// update or create fields
				if ( !empty($panel_data['fields']) )
				{
					$this->fields_handle($panel_id, $panel_data['fields']);
				}

				// store shortcuts
				$shortcuts[$panel_shortcut] = $panel_id;
			}
		}

		// process sub-level
		if ( !empty($shortcuts) )
		{
			foreach ($shortcuts as $panel_shortcut => $panel_id )
			{
				if ( !empty($patches[$panel_shortcut]['options']) )
				{
					$this->node_handle($panel_id, $patches[$panel_shortcut]['options']);
				}
			}
		}
	}

	function update($main_id, $panel_id, $panel_shortcut, $panel_data)
	{
		global $db;

		// panel fields
		$fields = array(
			'panel_shortcut' => $panel_shortcut,
			'panel_name' => empty($panel_data['name']) ? ucfirst($panel_shortcut) : $panel_data['name'],
			'panel_main' => $main_id,
			'panel_order' => 99999,
		);
		if ( !empty($panel_data['file']) )
		{
			$fields += array(
				'panel_file' => $panel_data['file'],
			);
		}
		if ( !empty($panel_data['auth']) )
		{
			$fields += array(
				'panel_auth_type' => _first_key($panel_data['auth']),
				'panel_auth_name' => $panel_data['auth'][ _first_key($panel_data['auth']) ],
			);
			foreach ( $panel_data['auth'] as $auth_type => $auth_name )
			{
				if ( !isset($this->auths_def->keys[$auth_type][$auth_name]) )
				{
					if ( !isset($this->auths_def_added[$auth_type]) )
					{
						$this->auths_def_added[$auth_type] = array();
					}
					$this->auths_def_added[$auth_type][$auth_name] = true;
				}
			}
		}
		if ( !empty($panel_data['hidden']) )
		{
			$fields += array(
				'panel_hidden' => true,
			);
		}
		$db->sql_statement($fields);
		if ( empty($panel_id) )
		{
			// we need to create the table row in order to get the new id
			$sql = 'INSERT INTO ' . CP_PANELS_TABLE . '
						(' . $db->sql_fields . ') VALUES (' . $db->sql_values . ')';
			$db->sql_query($sql, false, __LINE__, __FILE__);

			// get panel id
			$panel_id = $db->sql_nextid();

			// add it to memory cp_panels
			$fields += array('panel_id' => $panel_id);
			$this->data[$panel_id] = $fields;
			$this->data[$main_id]['subs'][] = $panel_id;
		}
		else
		{
			$sql = 'UPDATE ' . CP_PANELS_TABLE . '
						SET ' . $db->sql_update . '
						WHERE panel_id = ' . intval($panel_id);
			$db->sql_query($sql, false, __LINE__, __FILE__);

			// update memory cp_panels
			$this->data[$panel_id] = array_merge($this->data[$panel_id], $fields);
		}

		// return the panel id (in case of creation ie)
		return $panel_id;
	}

	function fields_handle($panel_id, &$fields_def)
	{
		global $db;

		// no fields to process : end there
		if ( empty($fields_def) )
		{
			return;
		}

		// get the current fields
		$sql = 'SELECT field_name, field_id, field_order
					FROM ' . CP_FIELDS_TABLE . '
					WHERE panel_id = ' . intval($panel_id) . '
					ORDER BY panel_id, field_order';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$current_fields_def = array();
		$last_order = 0;
		while ( $row = $db->sql_fetchrow($result) )
		{
			$current_fields_def[ $row['field_name'] ] = array('field_id' => $row['field_id'], 'field_order' => $row['field_order']);
			if ( $row['field_order'] > $last_order )
			{
				$last_order = $row['field_order'];
			}
		}

		// process the new fields
		$db->sql_stack_reset();
		foreach ( $fields_def as $field_name => $field_attr )
		{
			$last_order += 10;
			$fields = array(
				'field_name' => $field_name,
				'panel_id' => $panel_id,
				'field_order' => empty($current_fields_def[$field_name]) ? $last_order : $current_fields_def[$field_name]['field_order'],
				'field_attr' => serialize($field_attr),
			);
			if ( !isset($current_fields_def[$field_name]) )
			{
				$db->sql_stack_statement($fields);
			}
			else
			{
				$db->sql_statement($fields);
				$sql = 'UPDATE ' . CP_FIELDS_TABLE . '
							SET ' . $db->sql_update . '
							WHERE field_id = ' . intval($current_fields_def[$field_name]['field_id']);
				$db->sql_query($sql, false, __LINE__, __FILE__);
			}

			// get new auths def
			if ( !empty($field_attr['field_auth']) )
			{
				$auth_type = POST_GROUPS_URL;
				$auth_name = $field_attr['field_auth'];
				if ( !isset($this->auths_def->keys[$auth_type][$auth_name]) )
				{
					if ( !isset($this->auths_def_added[$auth_type]) )
					{
						$this->auths_def_added[$auth_type] = array();
					}
					$this->auths_def_added[$auth_type][$auth_name] = true;
				}
			}
		}
		$db->sql_stack_insert(CP_FIELDS_TABLE, false, __LINE__, __FILE__);

		// renum fields
		$sql = 'SELECT field_id
					FROM ' . CP_FIELDS_TABLE . '
					WHERE panel_id = ' . intval($panel_id) . '
					ORDER BY panel_id, field_order';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$last_order = 0;
		while ( $row = $db->sql_fetchrow($result) )
		{
			$last_order += 10;
			$sql = 'UPDATE ' . CP_FIELDS_TABLE . '
						SET field_order = ' . $last_order . '
						WHERE field_id = ' . intval($row['field_id']);
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}
	}

	function auths_handle(&$panels, &$auth_defs)
	{
		global $db, $config;

		// prepare sql requests
		$delete_rows = array();
		$db->sql_stack_reset();

		// patch auths
		if ( !empty($auth_defs) )
		{
			foreach ( $auth_defs as $auth_type => $auth_names_data )
			{
				if ( !empty($auth_names_data) )
				{
					// build the tree name of each panel
					if ( ($auth_type == POST_PANELS_URL) && !empty($this->data) )
					{
						$tree = array();
						foreach ( $this->data as $panel_id => $panel_data )
						{
							if ( !empty($panel_id) )
							{
								$tree[$panel_id] = empty($panel_id) ? '' : $tree[ $panel_data['panel_main'] ] . (empty($tree[ $panel_data['panel_main'] ]) ? '' : '.') . $panel_data['panel_shortcut'];
							}
						}
						$tree = empty($tree) ? array() : array_flip($tree);
					}
					foreach ( $auth_names_data as $auth_name => $auth_groups_data )
					{
						// add the auth definition
						if ( !isset($this->auths_def->keys[$auth_type][$auth_name]) )
						{
							if ( !isset($this->auths_def_added[$auth_type]) )
							{
								$this->auths_def_added[$auth_type] = array();
							}
							$this->auths_def_added[$auth_type][$auth_name] = true;
						}

						// add the groups auths
						if ( !empty($auth_groups_data) )
						{
							foreach ( $auth_groups_data as $group_id => $auth_objs_data )
							{
								if ( !empty($auth_objs_data) )
								{
									$obj_ids = array();
									foreach ( $auth_objs_data as $obj_id => $auth_value )
									{
										if ( $auth_type == POST_PANELS_URL )
										{
											$obj_id = intval($tree[$obj_id]);
										}
										if ( !empty($obj_id) || ($auth_type != POST_PANELS_URL) )
										{
											$obj_ids[] = $obj_id;
											$fields = array(
												'obj_type' => $auth_type,
												'auth_name' => $auth_name,
												'group_id' => $group_id,
												'obj_id' => $obj_id,
												'auth_value' => $auth_value,
											);
											$db->sql_stack_statement($fields);
										}
									}
									if ( !empty($obj_ids) )
									{
										$delete_rows[] = '(obj_type = \'' . $auth_type . '\' AND auth_name = \'' . $auth_name . '\' AND group_id = ' . $group_id . ' AND obj_id' . ((count($auth_objs_data) == 1) ? ' = ' . $obj_ids[0] : ' IN(' . implode(', ', $obj_ids) . ')') . ')';
									}
								}
							}
						}
					}
				}
			}
		}

		// delete auths to replace
		if ( !empty($delete_rows) )
		{
			$sql = 'DELETE FROM ' . AUTHS_TABLE . '
						WHERE ' . implode("\n" . ' OR ', $delete_rows);
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}

		// create new auths
		$db->sql_stack_insert(AUTHS_TABLE, false, __LINE__, __FILE__);
	}

	function reorder($panel_id, &$order)
	{
		global $db;

		$order += 10;

		// update this panel
		if ( !empty($panel_id) )
		{
			$sql = 'UPDATE ' . CP_PANELS_TABLE . '
						SET panel_order = ' . intval($order) . '
						WHERE panel_id = ' . intval($panel_id);
			$db->sql_query($sql, false, __LINE__, __FILE__);
		}

		// process sub panels
		$count_subs = empty($this->data[$panel_id]['subs']) ? 0 : count($this->data[$panel_id]['subs']);
		for ( $i = 0; $i < $count_subs; $i++ )
		{
			$this->reorder($this->data[$panel_id]['subs'][$i], $order);
		}
	}
}

class cp_patches
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
		$db_cached = new cache('dta_cp_patches', $config->data['cache_path'], $config->data['cache_disabled_cp_patches']);
		$sql = 'SELECT *
					FROM ' . CP_PATCHES_TABLE . '
					ORDER BY patch_id';
		$this->data = $db_cached->sql_query($sql, __LINE__, __FILE__, $force, 'patch_id');
		$this->data_flag = true;
		$this->data_time = $db_cached->data_time;
		$this->from_cache = $db_cached->from_cache;
	}

	function patches_handle()
	{
		global $db, $config;

		// read all patches known
		$keys = array();
		if ( !empty($this->data) )
		{
			foreach ( $this->data as $patch_id => $data )
			{
				$keys[ $data['patch_file'] ] = $patch_id;
			}
		}

		// explore patches and retain new
		$dir = @opendir($config->root . 'includes/_cp_patches');
		$patches = array();
		$patches_date = array();
		$patches_file = array();
		while ( $file = @readdir($dir) )
		{
			if ( !is_dir(@phpbb_realpath($config->root . 'includes/_cp_patches/' . $file)) && !is_link(@phpbb_realpath($config->root . 'includes/_cp_patches/' . $file)) )
			{
				if ( preg_match('/^patch_.*?\.' . $config->ext . '$/', $file) )
				{
					$patch_version = '';
					$patch_date = 0;
					$patch_author = '';
					$patch_ref = '';
					$patch_auths = array();
					$patch_data = array();
					include($config->root . 'includes/_cp_patches/' . $file);
					if ( (!empty($patch_data) || !empty($patch_auths)) && (!isset($keys[$file]) || ($patch_date > $this->data[ $keys[$file] ]['patch_date'])) )
					{
						$patches[$file] = array(
							'version' => $patch_version,
							'date' => $patch_date,
							'author' => $patch_author,
							'ref' => $patch_ref,
							'auths' => $patch_auths,
							'options' => $patch_data,
						);
						$patches_date[$file] = $patch_date;
						$patches_file[$file] = $file;
					}
				}
			}
		}
		@closedir($dir);

		// nothing to do, end there
		if ( empty($patches) )
		{
			return array();
		}

		// update patches to apply
		$now = time();
		$res = array();
		array_multisort($patches_date, $patches_file, $patches);
		unset($patches_file);
		unset($patches_date);

		// store patches track
		$db->sql_stack_reset();
		foreach ( $patches as $file => $patch )
		{
			$fields = array(
				'patch_file' => $file,
				'patch_date' => $patch['date'],
				'patch_author' => $patch['author'],
				'patch_ref' => $patch['ref'],
				'patch_time' => $now,
				'patch_version' => $patch['version'],
			);
			if ( isset($keys[$file]) )
			{
				$db->sql_statement($fields);
				$sql = 'UPDATE ' . CP_PATCHES_TABLE . '
							SET ' . $db->sql_update . '
							WHERE patch_id = ' . intval($keys[$file]);
				$db->sql_query($sql, false, __LINE__, __FILE__);
			}
			else
			{
				$db->sql_stack_statement($fields);
			}

			// prepare return
			if ( !empty($patch['options']) || !empty($patch['auths']) )
			{
				$res[] = $patch;
			}
		}
		$db->sql_stack_insert(CP_PATCHES_TABLE, false, __LINE__, __FILE__);

		// recache patches
		$this->read(true);

		return $res;
	}
}

?>