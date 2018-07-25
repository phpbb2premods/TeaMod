<?php
//-- add-on : recent posts desactivable via acp --------------------------------
//-- mod : quick post ES -------------------------------------------------------
/***************************************************************************
 *							admin_forums.php
 *							----------------
 *	begin		: 08/10/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.11 - 21/08/2005
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

/* ------------------------------------------------------------------------------
To add new fields to the details form :
after having added the fields to the forums table and see the includes/class_forums to make them read
-----------------
- add their definition to the $forum_fields[] array (parm 'field' refer to the forum field table),
- add them to the contextual fields lists array : $forms[]

- if these fields have default values in the config table, 
add the definition of the config entries as cfg_* form fields (don't forget 'field' parm),
and this field to the $forms['root'] array

* $forms['root'] is the form builded when editing forum 0 (root index)
* $forms['delete'] is the form builded to confirm delete
* $forms[POST_FORUM_URL] is the form to edit forum type forums
* $forms[POST_CAT_URL] is the form to edit category type forums
* $forms[POST_LINK_URL] is the form to edit link type forums
------------------------------------------------------------------------------ */

define('IN_PHPBB', 1);
define('NAV_SEPARATOR', '&raquo;');

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	// little tip to sort options ;)
	$module['Forums']['01_Manage'] = $file;
	$module['Forums']['02_Styles'] = $file . '?dsp=style';
	$module['Forums']['03_Prune'] = $file . '?dsp=fprune';
	return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($config->url('includes/class_form'));
include($config->url('includes/functions_admin'));
include($config->url('includes/prune'));
include($config->url('includes/class_forums'));
include($config->url('includes/class_topics'));

// values allowed for 'mode=' parm
$mode_allowed = array(
	'' => array('title' => 'Forum_admin', 'explain' => 'Forum_admin_explain'),
	'moveup' => '',
	'movedw' => '',
	'edit' => array('title' => 'Edit_forum', 'explain' => 'Forum_edit_explain'),
	'create' => array('title' => 'Create_forum', 'explain' => 'Forum_create_explain'),
	'delete' => array('title' => 'Forum_delete', 'explain' => 'Forum_delete_explain'),
	'sync' => '',
);

// lists
$forum_types = array(
	POST_FORUM_URL => 'Forum',
	POST_CAT_URL => 'Category',
	POST_LINK_URL => 'Link',
);

$forum_status = array(
	FORUM_UNLOCKED => 'Status_unlocked',
	FORUM_LOCKED => 'Status_locked',
);

$list_no_yes = array(
	0 => 'No',
	1 => 'Yes',
);

$list_yes_no = array(
	1 => 'Yes',
	0 => 'No',
);

$list_default_yes_no = array(
	0 => 'Default_setup',
	1 => 'Yes',
	2 => 'No',
);

// get topics sort/order lists
$topics = new topics();
$list_topics_sort = array();
foreach ( $topics->sort_fields as $sort_name => $data )
{
	$list_topics_sort[$sort_name] = $data['txt'];
}

$list_topics_order = array(
	'ASC' => 'Sort_Ascending', 
	'DESC' => 'Sort_Descending'
);

// get style list
if ( empty($themes) )
{
	$themes = new themes();
	$themes->read();
}
$list_styles = array();
if ( !empty($themes->data) )
{
	foreach ( $themes->data as $theme_id => $themes_data )
	{
		$list_styles[$theme_id] = $themes_data['style_name'];
	}
}

// board box values
$list_board_box = array(
	BOARD_GLOBAL_ANNOUNCES => 'Global_Announces',
	BOARD_PARENT_ANNOUNCES => 'Global_Parent_announces',
	BOARD_CHILD_ANNOUNCES => 'Global_Childs_announces',
	BOARD_BRANCH_ANNOUNCES => 'Global_Branch_announces',
);

// fields def
$forum_fields = array(
	// all fields relative to forums, cats and links except auths
	'forum_type' => array('type' => 'list', 'legend' => 'Forum_type', 'field' => 'forum_type', 'options' => $forum_types, 'html' => ' onChange="this.form.submit();"'),
	'forum_name' => array('type' => 'varchar', 'legend' => 'Forum_name', 'field' => 'forum_name', 'length_mini' => 1),
	'forum_desc' => array('type' => 'text_html', 'legend' => 'Forum_desc', 'field' => 'forum_desc'),
	'forum_main' => array('type' => 'list', 'legend' => 'Forum_main', 'field' => 'forum_main', 'html' => ' onChange="this.form.submit();"'),
	'forum_order' => array('type' => 'list', 'legend' => 'Forum_order', 'field' => 'forum_order'),
	'forum_status' => array('type' => 'radio_list', 'legend' => 'Forum_status', 'field' => 'forum_status', 'options' => $forum_status),
//-- mod : quick post es -------------------------------------------------------
//-- add
	'forum_quick_post' => array('type' => 'radio_list', 'legend' => 'qp_quick_post', 'field' => 'forum_quick_post', 'options' => $list_yes_no),
//-- fin mod : quick post es ---------------------------------------------------
	'link_title' => array('type' => 'sub_title', 'legend' => 'Link'),
	'forum_link' => array('type' => 'url', 'legend' => 'Link', 'field' => 'forum_link', 'length_mini' => 1),
	'forum_link_hit_count' => array('type' => 'radio_list', 'legend' => 'Forum_link_hit_count', 'field' => 'forum_link_hit_count', 'options' => $list_yes_no),

	'board_box_title' => array('type' => 'sub_title', 'legend' => 'Board_announces'),
	'forum_board_box' => array('type' => 'list', 'legend' => 'Board_box_content', 'explain' => 'Board_box_content_explain', 'options' => array(0 => 'Default_setup') + $list_board_box, 'field' => 'forum_board_box'),
	'forum_subs_hidden' => array('type' => 'radio_list', 'legend' => 'Forum_subs_hidden', 'explain' => 'Forum_subs_hidden_explain', 'field' => 'forum_subs_hidden', 'options' => $list_no_yes),

	'topics_options_title' => array('type' => 'sub_title', 'legend' => 'Topics_options'),
	'forum_topics_sort' => array('type' => 'list', 'legend' => 'Topics_sort', 'explain' => 'Topics_sort_explain', 'options' => array('' => 'None') + $list_topics_sort, 'field' => 'forum_topics_sort'),
	'forum_topics_order' => array('type' => 'list', 'options' => array('' => 'None') + $list_topics_order, 'field' => 'forum_topics_order', 'combined' => true),
	'forum_topics_ppage' => array('type' => 'int', 'legend' => 'Topics_per_page', 'explain' => 'Topics_per_page_explain', 'field' => 'forum_topics_ppage'),

	'icon_title' => array('type' => 'sub_title', 'legend' => 'Images'),
	'icon_comment' => array('type' => 'comment', 'legend' => 'Images_explain'),
	'forum_nav_icon' => array('type' => 'varchar', 'legend' => 'Forum_nav_icon', 'explain' => 'Forum_nav_icon_explain', 'field' => 'forum_nav_icon'),
	'forum_icon' => array('type' => 'varchar', 'legend' => 'Forum_icon', 'explain' => 'Forum_icon_explain', 'field' => 'forum_icon'),

	'layout_title' => array('type' => 'sub_title', 'legend' => 'Index_layout'),
	'forum_style' => array('type' => 'list', 'legend' => 'Forum_style', 'explain' => 'Forum_style_explain', 'options' => array(0 => 'None') + $list_styles, 'field' => 'forum_style'),
	'forum_index_pack' => array('type' => 'radio_list', 'legend' => 'Index_pack', 'explain' => 'Index_pack_explain', 'options' => $list_default_yes_no, 'field' => 'forum_index_pack', 'options.linefeed' => true),
	'forum_index_split' => array('type' => 'radio_list', 'legend' => 'Index_split', 'explain' => 'Index_split_explain', 'options' => $list_default_yes_no, 'field' => 'forum_index_split', 'options.linefeed' => true),

	'prune_title' => array('type' => 'sub_title', 'legend' => 'Forum_pruning'),
	'forum_prune' => array('type' => 'radio_list', 'legend' => 'Enabled', 'field' => 'prune_enable', 'options' => $list_no_yes),
	'prune_days' => array('type' => 'int', 'legend' => 'prune_days', 'post_value' => 'Days', 'field' => 'prune_days'),
	'prune_freq' => array('type' => 'int', 'legend' => 'prune_freq', 'post_value' => 'Days', 'field' => 'prune_freq'),

	// root forum : data are stored in config table
	'cfg_name' => array('type' => 'varchar', 'legend' => 'Forum_name', 'value' => 'Forum_index', 'output' => true),
	'cfg_desc' => array('type' => 'varchar', 'legend' => 'Site_name', 'field' => 'sitename', 'length_mini' => 1),
	'cfg_status' => array('type' => 'radio_list', 'legend' => 'Board_disable', 'explain' => 'Board_disable_explain', 'options' => $list_no_yes, 'field' => 'board_disable'),
	'cfg_nav_icon' => array('type' => 'varchar', 'legend' => 'Forum_nav_icon', 'explain' => 'Forum_icon_explain', 'field' => 'index_fav_icon'),
//-- add-on : recent posts desactivable via acp --------------------------------
//-- add
	'cfg_recent_posts_active' => array('type' => 'radio_list', 'legend' => 'recent_posts_active', 'explain' => 'recent_posts_active_explain', 'options' => $list_no_yes, 'field' => 'recent_posts_active'),
//-- fin add-on : recent posts desactivable via acp ----------------------------
);

// forms fields : per forum_type : fields used to build the form
//-- add-on : recent posts desactivable via acp --------------------------------
// here we added
//	'cfg_recent_posts_active',
//-- modify
$forms = array(
	'root' => array(
		'cfg_name', 'cfg_desc', 'cfg_status', 'cfg_nav_icon', 'cfg_recent_posts_active',
	),
//-- fin add-on : recent posts desactivable via acp ----------------------------
	'delete' => array(
		'forum_type', 'forum_name', 'forum_desc', 'forum_main', 'forum_status',
	),
//-- mod : quick post es -------------------------------------------------------
// here we added
//	, 'forum_quick_post'
//-- modify
	POST_FORUM_URL => array(
		'forum_type', 'forum_name', 'forum_desc', 'forum_status', 'forum_quick_post', 'forum_main', 'forum_order',
		'board_box_title', 'forum_board_box',
		'topics_options_title', 'forum_topics_sort', 'forum_topics_order', 'forum_topics_ppage',
		'icon_title', 'icon_comment', 'forum_nav_icon', 'forum_icon',
		'layout_title', 'forum_style', 'forum_index_pack', 'forum_index_split', 'forum_subs_hidden',
		'prune_title', 'forum_prune', 'prune_days', 'prune_freq',
	),
//-- fin mod : quick post es ---------------------------------------------------
	POST_CAT_URL => array(
		'forum_type', 'forum_name', 'forum_desc', 'forum_main', 'forum_order',
		'board_box_title', 'forum_board_box',
		'icon_title', 'icon_comment', 'forum_nav_icon', 'forum_icon',
		'layout_title', 'forum_style', 'forum_index_pack', 'forum_index_split', 'forum_subs_hidden',
	),
	POST_LINK_URL => array(
		'forum_type', 'forum_name', 'forum_desc', 'forum_main', 'forum_order',
		'link_title', 'forum_link', 'forum_link_hit_count',
		'icon_title', 'icon_comment', 'forum_nav_icon', 'forum_icon',
		'layout_title', 'forum_subs_hidden',
	),
);

//
// edit/create/delete forums form
//
class form_forum_det extends form
{
	var $requester;
	var $forum_id;
	var $dsp;

	function form_forum_det($requester, $mode='', $forum_id=0, $dsp='')
	{
		global $db, $config, $forums, $user;
		global $forum_types, $forms, $forum_fields;

		// parms
		$this->requester = $requester;
		$this->mode = $mode;
		$this->forum_id = intval($forum_id);
		$this->dsp = $dsp;

		// verify ability to edit forum
		if ( !$user->auth(POST_FORUM_URL, 'auth_manage', $forum_id) )
		{
			$l_link = 'Click_return_forumadmin';
			$u_link = $config->url($this->requester, array(POST_FORUM_URL => $forums->data[$this->forum_id]['forum_main'], 'dsp' => $this->dsp), true);
			message_return('Not_Authorised', $l_link, $u_link);
		}

		// get values from table
		if ( $this->mode == 'create' )
		{
			$previous = (empty($this->forum_id) || empty($forums->data[$this->forum_id]['subs']) ) ? $this->forum_id : $forums->data[$this->forum_id]['subs'][ ( count($forums->data[$this->forum_id]['subs']) - 1) ];
			$data = array('forum_type' => POST_FORUM_URL, 'forum_main' => $this->forum_id, 'forum_order' => $previous, 'prune_days' => 7, 'prune_freq' => 1);
		}
		else if ( empty($this->forum_id) )
		{
			$data = &$config->data;
		}
		else
		{
			$sql = 'SELECT *
						FROM ' . FORUMS_TABLE . '
						WHERE forum_id = ' . $this->forum_id;
			$result = $db->sql_query($sql, false, __LINE__, __FILE__);
			$data = $db->sql_fetchrow($result);
			$data['forum_order'] = $forums->get_previous_id($this->forum_id);

			// get prune information
			$sql = 'SELECT *
						FROM ' . PRUNE_TABLE . '
						WHERE forum_id = ' . $this->forum_id;
			$result = $db->sql_query($sql, false, __LINE__, __FILE__);
			$row = $db->sql_fetchrow($result);
			$data['prune_days'] = $row['prune_days'] ? $row['prune_days'] : 7;
			$data['prune_freq'] = $row['prune_freq'] ? $row['prune_freq'] : 1;
		}

		// get forum type
		$forum_type = (empty($this->forum_id) && ($this->mode != 'create')) ? 'root' : (($this->mode == 'delete') ? 'delete' : _read('forum_type', TYPE_NO_HTML, $data['forum_type'], $forum_types));

		// set values for form
		$form_fields = array();
		$count_fields = count($forms[$forum_type]);
		for ( $i = 0; $i < $count_fields; $i++ )
		{
			$form_fields[ $forms[$forum_type][$i] ] = $forum_fields[ $forms[$forum_type][$i] ];
			if ( isset($form_fields[ $forms[$forum_type][$i] ]['field']) )
			{
				$form_fields[ $forms[$forum_type][$i] ]['value'] = $data[ $form_fields[ $forms[$forum_type][$i] ]['field'] ];
				if ( $this->mode == 'delete' )
				{
					$form_fields[ $forms[$forum_type][$i] ]['output'] = true;
				}
			}
		}

		// get parent forums lists
		if ( $this->mode == 'create' )
		{
			$form_fields['forum_main']['options'] = $forums->get_forum_list($forums->get_front_pic('all'));
		}
		else if ( !empty($this->forum_id) )
		{
			// delete form
			if ( $this->mode == 'delete' )
			{
				$nav = '';
				$cur_id = $this->forum_id;
				while ( $cur_id > 0 )
				{
					$cur_id = intval($forums->data[$cur_id]['forum_main']);
					$nav = $user->lang($forums->data[$cur_id]['forum_name']) . (empty($nav) ? '' : '&nbsp;' . NAV_SEPARATOR . '&nbsp;') . $nav;
				}
				$form_fields['forum_main'] = array('type' => 'varchar', 'legend' => 'Forum_main', 'value' => $nav, 'output' => true);
				$form_fields['move_contents'] = array('type' => 'list', 'legend' => 'Move_contents', 'explain' => 'Move_contents_explain', 'value' => -1);
				$form_fields['move_contents']['options'] = array(-1 => 'Delete_all', -2 => '---------------') + $forums->get_forum_list($forums->get_front_pic('except', $this->forum_id));
			}

			// get all forums except the branch
			else
			{
				$form_fields['forum_main']['options'] = $forums->get_forum_list($forums->get_front_pic('except', $this->forum_id));
			}
		}

		// get order list
		if ( isset($form_fields['forum_main']) && !$form_fields['forum_main']['output'] )
		{
			// we need to get the current forum_main, so read the form
			$forum_main = _read('forum_main', TYPE_INT, $form_fields['forum_main']['value'], $form_fields['forum_main']['options']);

			// get the sub-forums list of this forum_main
			$form_fields['forum_order']['options'] = $forums->get_forum_list($forums->get_front_pic('only', $forum_main, $this->forum_id));

			// creation or forum_main changed : get the last sub of this new main
			if ( ($this->mode == 'create') || ($forums->data[$this->forum_id]['forum_main'] != $forum_main) )
			{
				if ( !empty($form_fields['forum_order']['options']) )
				{
					$tkeys = array_keys($form_fields['forum_order']['options']);
					$form_fields['forum_order']['value'] = $tkeys[ (count($tkeys)-1) ];
					unset($tkeys);
				}
			}

			// update or delete, forum_main unchanged
			else
			{
				$form_fields['forum_order']['value'] = $forums->get_previous_id($this->forum_id, false);
			}
		}

		// declare fields
		parent::form($form_fields);
	}

	function process()
	{
		$this->init();
		if ( _button('submit_form') )
		{
			$this->check();
			$this->validate();
		}
		if ( !_button('cancel_form') )
		{
			$this->display();
		}
	}

	function init()
	{
	}

	function display()
	{
		global $db, $template, $config, $user, $forums;
		global $mode_allowed;

		// buttons
		$this->set_buttons(array(
			'submit_form' => array('txt' => ($this->mode == 'delete') ? 'Delete' : 'Submit', 'img' => ($this->mode == 'delete') ? 'cmd_delete' : 'cmd_submit', 'key' => ($this->mode == 'delete') ? 'cmd_delete' : 'cmd_submit'),
			'cancel_form' => array('txt' => 'Cancel', 'img' => 'cmd_cancel', 'key' => 'cmd_cancel'),
		));

		// display the form
		parent::display();

		// set constants
		$template->assign_vars(array(
			'L_TITLE' => $user->lang($mode_allowed[$this->mode]['title']),
			'L_TITLE_EXPLAIN' => $user->lang($mode_allowed[$this->mode]['explain']),
			'L_FORM' => $user->lang($mode_allowed[$this->mode]['title']),
			'S_ACTION' => $config->url($this->requester, '', true),
		));
		_hide(array(POST_FORUM_URL => $this->forum_id, 'mode' => $this->mode, 'dsp' => $this->dsp));
		_hide_set();

		// send the display
		$forums->display_nav($this->forum_id);
		$template->set_filenames(array('body' => 'form_body.tpl'));
		$template->pparse('body');
	}

	function check()
	{
		global $db, $config, $user;
		global $error, $error_msg;

		// individual check
		parent::check();
		if ( !$error )
		{
			if ( $this->mode == 'delete' )
			{
				if ( empty($this->forum_id) )
				{
					_error('Root_delete_deny');
				}
				else if ( $this->fields['move_contents']->value >= 0 )
				{
					// move to a link denied
					if ( $forums->data[ $this->fields['move_contents']->value ]['forum_type'] == POST_LINK_URL )
					{
						_error('Attach_to_link_denied');
					}
					// index or categories : only if not topics remain
					else if ( empty($this->fields['move_contents']->value) || ($forums->data[ $this->fields['move_contents']->value ]['forum_type'] == POST_CAT_URL) )
					{
						// check if there are topics
						$sql = 'SELECT *
									FROM ' . TOPICS_TABLE . '
									WHERE forum_id = ' . intval($this->forum_id) . '
									LIMIT 1';
						$result = $db->sql_query($sql, false, __LINE__, __FILE__);
						if ( $row = $db->sql_fetchrow($result) )
						{
							_error('Forum_not_empty');
						}
					}
				}
				else if ( $this->fields['move_contents']->value < -1 )
				{
					_error('Empty_move_to');
				}

				// check auth regarding the target
				if ( !$error && !$user->auth(POST_FORUM_URL, 'auth_manage', $this->fields['move_contents']->value) )
				{
					_error('Not_Authorised');
				}
			}
			if ( !empty($this->forum_id) || ($this->mode == 'create') )
			{
				// check forum
				switch ( $this->fields['forum_type']->value )
				{
					case POST_FORUM_URL:
						if ( $this->fields['forum_prune']->value && (empty($this->fields['prune_days']->value) || empty($this->fields['prune_freq']->value)) )
						{
							_error('Set_prune_data');
						}
						break;
					case POST_CAT_URL:
					case POST_LINK_URL:
						if ( $this->mode != 'create' )
						{
							$sql = 'SELECT *
										FROM ' . TOPICS_TABLE . '
										WHERE forum_id = ' . $this->forum_id . '
										LIMIT 1';
							$result = $db->sql_query($sql, false, __LINE__, __FILE__);
							if ( $row = $db->sql_fetchrow($result) )
							{
								_error('Forum_not_empty');
							}
						}
						break;
				}

				// check auth regarding the target
				if ( !$error && (($this->mode == 'create') || ($this->fields['forum_main']->value != $this->fields['forum_main']->data['value'])) && !$user->auth(POST_FORUM_URL, 'auth_manage', $this->fields['forum_main']->value) )
				{
					_error('Not_Authorised');
				}
			}
		}

		// halt on error
		if ( $error )
		{
			$u_link = $config->url($this->requester, array(POST_FORUM_URL => $this->forum_id, 'mode' => $this->mode, 'dsp' => $this->dsp), true);
			$l_link = 'Click_return_forumadmin';
			message_return($error_msg, $l_link, $u_link, 10);
		}
	}

	function validate()
	{
		global $db, $template, $config, $user, $forums;

		// forums table
		if ( !empty($this->forum_id) || ($this->mode == 'create') )
		{
			// get fields from display
			$fields = array();
			if ( $this->mode != 'delete' )
			{
				foreach ( $this->fields as $field_name => $field )
				{
					if ( !$field->data['output'] && !empty($field->data['field']) && !in_array($field_name, array('prune_days', 'prune_freq')) )
					{
						switch ( $field_name )
						{
							case 'prune_days':
							case 'prune_freq':
								// do nothing : this is not the forums table
								break;

							case 'forum_order':
								// if creation, affect a new forum order, else this branch will be move further
								if ( $this->mode == 'create' )
								{
									$fields[ $field->data['field'] ] = ($field->value == $this->fields['forum_main']->value) ? $forums->data[ $this->fields['forum_main']->value ]['forum_order'] + 5 : $forums->data[ $forums->data[$field->value]['last_child_id'] ]['forum_order'] + 5;
								}
								break;

							default:
								$fields[ $field->data['field'] ] = $field->value;
								break;
						}
					}
				}
			}

			// creation
			if ( $this->mode == 'create' )
			{
				// get a new forum_id
				$sql = 'SELECT MAX(forum_id) AS last_forum_id
							FROM ' . FORUMS_TABLE;
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				$row = $db->sql_fetchrow($result);
				$this->forum_id = intval($row['last_forum_id']) + 1;

				// create the forum
				$fields['forum_id'] = $this->forum_id;
				if ( $fields['forum_type'] == POST_LINK_URL )
				{
					$fields['forum_link_start'] = time();
				}
				$db->sql_statement($fields);
				$sql = 'INSERT INTO ' . FORUMS_TABLE . '
							(' . $db->sql_fields . ') VALUES (' . $db->sql_values . ')';
				$db->sql_query($sql, false, __LINE__, __FILE__);

				// get the groups having the manage auth onto the parent
				$sql = 'SELECT DISTINCT group_id
							FROM ' . AUTHS_TABLE . '
							WHERE obj_type = \'' . POST_FORUM_URL . '\'
								AND obj_id = ' . intval($this->fields['forum_main']->value) . '
								AND auth_name = \'auth_manage\'';
				$result = $db->sql_query($sql, false, __LINE__, __FILE__);
				$group_ids = array();
				while ( $row = $db->sql_fetchrow($result) )
				{
					$group_ids[] = $row['group_id'];
				}

				// copy all auths from these groups
				if ( !empty($group_ids) )
				{
					$sql = 'SELECT group_id, obj_type, auth_name, auth_value
								FROM ' . AUTHS_TABLE . '
								WHERE group_id IN(' . implode(', ', $group_ids) . ')
									AND obj_type = \'' . POST_FORUM_URL . '\'
									AND obj_id = ' . intval($this->fields['forum_main']->value);
					$result = $db->sql_query($sql, false, __LINE__, __FILE__);
					$db->sql_stack_reset();
					while ( $row = $db->sql_fetchrow($result) )
					{
						$auth_fields = array_merge($row, array('obj_id' => intval($this->forum_id)));
						$db->sql_stack_statement($auth_fields);
					}
					$db->sql_stack_insert(AUTHS_TABLE, false, __LINE__, __FILE__);
				}

				// create the prune table
				if ( $this->fields['forum_prune']->value )
				{
					$fields = array(
						'forum_id' => $this->forum_id,
						'prune_days' => $this->fields['prune_days']->value,
						'prune_freq' => $this->fields['prune_freq']->value,
					);
					$db->sql_statement($fields);
					$sql = 'INSERT INTO ' . PRUNE_TABLE . '
								(' . $db->sql_fields . ') VALUES (' . $db->sql_values . ')';
					$db->sql_query($sql, false, __LINE__, __FILE__);
				}

				// renum the forums table
				$forums->renum();

				// all done : recache (including auths & jumpbox)
				$forums->read(true);
				$now = $forums->data_time;
				$config->set('cache_time_' . POST_FORUM_URL, $now);
				$config->set('cache_time_' . POST_FORUM_URL . 'jbox', $now);
			}

			// delete
			if ( $this->mode == 'delete' )
			{
				// first renum without the deleted ones to get all forum ids to delete
				$delete_root = true;
				$delete_branch = ($this->fields['move_contents']->value == -1);
				$new_main_id = $delete_branch ? 0 : $this->fields['move_contents']->value;
				$after_id = $delete_branch ? 0 : (empty($this->data[$new_main_id]['subs']) ? $new_main_id : $this->data[$new_main_id]['subs'][ (count($this->data[$new_main_id]['subs'])-1) ]);
				$deleted_ids = $forums->move($this->forum_id, $after_id, $delete_root, $delete_branch, $new_main_id);

				$count_deleted_ids = count($deleted_ids);
				if ( !empty($deleted_ids) )
				{
					// delete forums
					$sql_where = ($count_deleted_ids > 1) ? 'IN(' . implode(', ', $deleted_ids) . ')' : '= ' . $deleted_ids[0];
					$sql = 'DELETE FROM ' . FORUMS_TABLE . '
								WHERE forum_id ' . $sql_where;
					$db->sql_query($sql, false, __LINE__, __FILE__);

					// delete auths
					$sql = 'DELETE FROM ' . AUTHS_TABLE . '
								WHERE obj_type = \'' . POST_FORUM_URL . '\'
									AND obj_id ' . $sql_where;
					$db->sql_query($sql, false, __LINE__, __FILE__);

					// delete prune table
					$sql = 'DELETE FROM ' . PRUNE_TABLE . '
								WHERE forum_id ' . $sql_where;
					$db->sql_query($sql, false, __LINE__, __FILE__);

					// delete topics and relatives
					if ( $delete_branch )
					{
						// read polls to delete
						$sql = 'SELECT v.vote_id
									FROM ' . VOTE_DESC_TABLE . ' v, ' . TOPICS_TABLE . ' t
									WHERE t.forum_id ' . $sql_where . '
										AND v.topic_id = t.topic_id';
						$result = $db->sql_query($sql, false, __LINE__, __FILE__);
						$sql_vote_ids = '';
						while ( $row = $db->sql_fetchrow($result) )
						{
							$sql_vote_ids .= (empty($sql_vote_ids) ? '' : ', ') . $row['vote_id'];
						}
						if ( !empty($sql_vote_ids) )
						{
							$sql = 'DELETE FROM ' . VOTE_RESULTS_TABLE . '
										WHERE vote_id IN (' . $sql_vote_ids . ')';
							$db->sql_query($sql, false, __LINE__, __FILE__);

							$sql = 'DELETE FROM ' . VOTE_USERS_TABLE . '
										WHERE vote_id IN (' . $sql_vote_ids . ')';
							$db->sql_query($sql, false, __LINE__, __FILE__);

							$sql = 'DELETE FROM ' . VOTE_DESC_TABLE . '
										WHERE vote_id IN (' . $sql_vote_ids . ')';
							$db->sql_query($sql, false, __LINE__, __FILE__);
						}
				
						// delete other table using the standard prune
						for ( $i = 0; $i < $count_deleted_ids; $i++ )
						{
							prune($deleted_ids[$i], 0, true); // Delete everything from forum
						}
					}
					// move topics and relatives
					else
					{
						$sql = 'UPDATE ' . TOPICS_TABLE . '
									SET forum_id = ' . $new_main_id . '
									WHERE forum_id = ' . $this->forum_id;
						$db->sql_query($sql, false, __LINE__, __FILE__);

						$sql = 'UPDATE ' . POSTS_TABLE . '
									SET forum_id = ' . $new_main_id . '
									WHERE forum_id = ' . $this->forum_id;
						$db->sql_query($sql, false, __LINE__, __FILE__);

						// resynchronised the forum
						sync('forum', $new_main_id);
					}
				}

				// reset moderators status
				$moderators = new moderators();
				$moderators->set_users_status();
				unset($moderators);

				// all done : recache (including auths & jumpbox)
				$forums->read(true);
				$now = $forums->data_time;
				$config->set('cache_time_' . POST_FORUM_URL, $now);
				$config->set('cache_time_' . POST_FORUM_URL . 'jbox', $now);
			}

			if ( $this->mode == 'edit' )
			{
				// forum link and hits count becomes activate
				if ( ($fields['forum_type'] == POST_LINK_URL) && $fields['forum_link_hit_count'] )
				{
					// the forums wasn't a link, or the hits count wasn't activated, or the start time was null
					if ( ($forums->data[$this->forum_id]['forum_type'] != POST_LINK_URL) || !$forums->data[$this->forum_id]['forum_link_hit_count'] || empty($forums->data[$this->forum_id]['forum_link_start']) )
					{
						$fields['forum_link_hit'] = 0;
						$fields['forum_link_start'] = time();
					}
				}

				// this is not a forum link, or the hits count is not activated
				else
				{
					$fields['forum_link_hit'] = 0;
					$fields['forum_link_start'] = 0;
				}

				// update the forum
				$db->sql_statement($fields);
				$sql = 'UPDATE ' . FORUMS_TABLE . '
							SET ' . $db->sql_update . '
							WHERE forum_id = ' . $this->forum_id;
				$db->sql_query($sql, false, __LINE__, __FILE__);

				// update the prune table
				if ( $this->fields['forum_prune']->value )
				{
					$fields = array(
						'forum_id' => $this->forum_id,
						'prune_days' => $this->fields['prune_days']->value,
						'prune_freq' => $this->fields['prune_freq']->value,
					);
					$db->sql_statement($fields);

					// get current id
					$sql = 'SELECT prune_id
								FROM ' . PRUNE_TABLE . '
								WHERE forum_id = ' . $this->forum_id;
					$result = $db->sql_query($sql, false, __LINE__, __FILE__);
					if ( $row = $db->sql_fetchrow($result) )
					{
						$sql = 'UPDATE ' . PRUNE_TABLE . '
									SET ' . $db->sql_update . '
									WHERE prune_id = ' . intval($row['prune_id']);
						$db->sql_query($sql, false, __LINE__, __FILE__);
					}
					else
					{
						$sql = 'INSERT INTO ' . PRUNE_TABLE . '
									(' . $db->sql_fields . ') VALUES (' . $db->sql_values . ')';
						$db->sql_query($sql, false, __LINE__, __FILE__);
					}
				}
				else
				{
					$sql = 'DELETE FROM ' . PRUNE_TABLE . '
								WHERE forum_id = ' . $this->forum_id;
					$db->sql_query($sql, false, __LINE__, __FILE__);
				}

				// move the branch to place
				if ( isset($this->fields['forum_order']) )
				{
					$after_id = ($this->fields['forum_order']->value == $this->fields['forum_main']->value) ? $this->fields['forum_main']->value : $forums->data[ $this->fields['forum_order']->value ]['last_child_id'];
					$forums->move($this->forum_id, $after_id, false, false, $this->fields['forum_main']->value);
				}

				// all done : recache (including auths & jumpbox)
				$forums->read(true);
				$now = $forums->data_time;
				$config->set('cache_time_' . POST_FORUM_URL, $now);
				$config->set('cache_time_' . POST_FORUM_URL . 'jbox', $now);
			}

			// send achievement message
			message_return('Forums_updated', 'Click_return_forumadmin', $config->url($this->requester, array(POST_FORUM_URL => intval($forums->data[$this->forum_id]['forum_main']), 'dsp' => $this->dsp), true));
		}

		// config table
		else
		{
			$config->begin_transaction();
			foreach ( $this->fields as $field_name => $field )
			{
				if ( isset($field->data['field']) )
				{
					$config->set($field->data['field'], $field->value);
				}
			}
			$config->end_transaction();

			// all done : recache forums
			$forums->read(true);

			// send achievement message
			message_return('Config_updated', 'Click_return_forumadmin', $config->url($this->requester, array(POST_FORUM_URL => intval($forums->data[$this->forum_id]['forum_main']), 'dsp' => $this->dsp), true));
		}
	}
}

//
// forums lists
//
class forums_admin extends forums
{
	var $dsp;

	function forums_admin($requester)
	{
		parent::forums();
		$this->requester = $requester;
	}

	function init($dsp = '')
	{
		$this->dsp = $dsp;
	}

	function display($forum_id=0, $results=array())
	{
		global $template, $config, $user;

		if ( in_array($this->dsp, array('style', 'fprune')) )
		{
			$this->display_flat($results);
			$tpl_switch = '';
		}
		else
		{
			// force auth view
			parent::display($forum_id);
			$tpl_switch = 'indexrow.footer.command';
		}
		$this->display_buttons($forum_id, $tpl_switch);

		$template->assign_vars(array(
			'L_FORUM' => $user->lang('Forum'),
			'L_ACTION' => $user->lang('Action'),

			'L_COPY' => $user->lang('Copy'),
			'I_COPY' => $user->img('cmd_mini_copy'),
			'L_MOVE_UP' => $user->lang('Move_up'),
			'I_MOVE_UP' => $user->img('cmd_up_arrow'),
			'L_MOVE_DOWN' => $user->lang('Move_down'),
			'I_MOVE_DOWN' => $user->img('cmd_down_arrow'),
			'I_CREATE' => $user->img($this->dsp ? 'cmd_mini_create' : 'cmd_create'),
			'L_CREATE' => $user->lang('Create_new'),
			'I_EDIT' => $user->img($this->dsp ? 'cmd_mini_edit' : 'cmd_edit'),
			'L_EDIT' => $user->lang('Edit'),
			'I_DELETE' => $user->img($this->dsp ? 'cmd_mini_delete' : 'cmd_delete'),
			'L_DELETE' => $user->lang('Delete'),
			'I_SYNCHRO' => $user->img($this->dsp ? 'cmd_mini_synchro' : 'cmd_synchro'),
			'L_SYNCHRO' => $user->lang('Resync'),
			'SPACER' => $user->img('spacer'),
		));
	}

	function display_buttons($forum_id=0, $tpl_switch='')
	{
		global $user, $config, $template;

		switch ( $this->dsp )
		{
			case 'style':
			case 'fprune':
				$buttons = array(
					'submit_list' => array('txt' => ($this->dsp == 'style') ? 'Submit_styles' : 'Do_Prune', 'img' => 'cmd_submit', 'key' => 'cmd_submit'),
				);
				break;
			default:
				$buttons = array(
					'create' => array('txt' => 'Create', 'img' => 'cmd_create', 'key' => 'cmd_create', 'url' => $this->requester, 'parms' => array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'create')),
					'edit' => array('txt' => 'Edit', 'img' => 'cmd_edit', 'key' => 'cmd_edit', 'url' => $this->requester, 'parms' => array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'edit')),
					'delete' => array('txt' => 'Delete', 'img' => 'cmd_delete', 'key' => 'cmd_delete', 'url' => $this->requester, 'parms' => array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'delete')),
					'synchro' => array('txt' => 'Resync', 'img' => 'cmd_synchro', 'key' => 'cmd_synchro', 'url' => $this->requester, 'parms' => array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'sync')),
				);
				if ( empty($forum_id) )
				{
					unset($buttons['delete']);
				}
				break;
		}
		display_buttons($buttons, $tpl_switch);
	}

	function display_flat($results)
	{
		global $db, $template, $config, $user, $list_styles;

		$front_pic = $this->get_front_pic('all');
		$color = false;
		foreach ( $front_pic as $forum_id => $front )
		{
			$authed = $user->auth(POST_FORUM_URL, 'auth_manage', $forum_id);
			$color = !$color;
			if ( $forum_id >= 0 )
			{
				// themes list
				$options = '';
				if ( $this->dsp == 'style' )
				{
					if ( ($this->data[$forum_id]['forum_type'] != POST_LINK_URL) && $authed )
					{
						$list = array(0 => 'None') + $list_styles;
						foreach ( $list as $theme_id => $style_name )
						{
							$selected = ($theme_id == $this->data[$forum_id]['forum_style']) ? ' selected="selected"' : '';
							$options .= '<option value="' . $theme_id . '"' . $selected . '>' . $user->lang($style_name) . '</option>';
						}
					}
				}

				// send to template
				$folder_img = $this->get_folder_img($forum_id, true);
				$template->assign_block_vars('row', array(
					'FORUM_ID' => $forum_id,
					'LAST_CHILD_ID' => $this->data[$forum_id]['last_child_id'],
					'L_FORUM_FOLDER' => $user->lang($folder_img['txt']),
					'I_FORUM_FOLDER' => $user->img($folder_img['img']),
					'I_NAV_ICON' => $user->img($this->data[$forum_id]['forum_nav_icon']),
					'FORUM_NAME' => $user->lang($this->data[$forum_id]['forum_name']),
					'FORUM_DESC' => _clean_html($user->lang($this->data[$forum_id]['forum_desc'])),
					'S_PROPAG_VAR' => $options,
					'PRUNED_TOPICS' => empty($results) ? '' : intval($results[$forum_id]['topics']),
					'PRUNED_POSTS' => empty($results) ? '' : intval($results[$forum_id]['posts']),

					'U_CREATE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'create'), true),
					'U_EDIT' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'edit'), true),
					'U_DELETE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'delete'), true),
					'U_SYNCHRO' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'sync'), true),
					'U_MOVE_UP' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'moveup'), true),
					'U_MOVE_DOWN' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'dsp' => $this->dsp, 'mode' => 'movedw'), true),
				));
				$template->set_switch('row.forum');
				$template->set_switch('row.root', empty($forum_id));
				$template->set_switch('row.show_propag', !empty($options) && ($this->dsp == 'style'));
				$template->set_switch('row.prune', !empty($results[$forum_id]));
			}
			else
			{
				$template->set_switch('row');
			}
			$template->set_switch('row.light', $color);
			$template->set_switch('row.nav_icon', ($forum_id >= 0) && !empty($this->data[$forum_id]['forum_nav_icon']));
			$template->set_switch('row.command', ($forum_id >= 0) && $authed);
			$template->set_switch('row.edit', ($forum_id > 0) && $authed);
			if ( ($forum_id >= 0) && $authed )
			{
				$template->set_switch('row.command.root', ($forum_id == 0));
			}
			$count_front = strlen($front);
			for ( $i = 0; $i < $count_front; $i++ )
			{
				$template->assign_block_vars('row.inc', array(
					'L_INC' => $user->lang('tree_pic_' . $front[$i]),
					'I_INC' => $user->img('tree_pic_' . $front[$i]),
				));
			}

			$template->assign_vars(array(
				'L_PROPAG_VAR' => ($this->dsp == 'style') ? $user->lang('Style') : '',
				'PROPAG_VAR' => ($this->dsp == 'style') ? 'styles' : '',
			));
		}
	}

	function display_empty($forum_id=0)
	{
		global $template;

		$template->set_switch('indexrow');
		$template->set_switch('indexrow.header');
		$template->set_switch('indexrow.empty');
		$template->set_switch('indexrow.footer');
		$template->set_switch('indexrow.footer.command');
	}

	function display_a_cat($forum_id, $with_header, &$moderators, $footer_only=false)
	{
		global $template, $config, $user;

		$tpl_fields = array();
		if ( !$footer_only )
		{
			$tpl_fields = array(
				'U_VIEWCAT' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id), true),
				'CAT_DESC' => $user->lang($this->data[$forum_id]['forum_name']),
				'DESC' =>  $user->lang($this->data[$forum_id]['forum_desc']),
				'FORUM_ICON' => empty($this->data[$forum_id]['forum_icon']) ? '' : $user->img($this->data[$forum_id]['forum_icon']),
				'U_CREATE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'create'), true),
				'U_EDIT' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'edit'), true),
				'U_DELETE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'delete'), true),
				'U_SYNCHRO' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'sync'), true),
				'U_MOVE_UP' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'moveup'), true),
				'U_MOVE_DOWN' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'movedw'), true),
			);
		}

		// send line
		$template->set_switch('indexrow');
		$template->assign_block_vars('indexrow.cat', $tpl_fields);

		// send block footer if required
		$template->set_switch('indexrow.cat.footer', $footer_only);
		if ( $footer_only )
		{
			return;
		}

		// send data
		$template->set_switch('indexrow.cat.row');

		// send forum icon
		$template->set_switch('indexrow.cat.row.forum_icon', !empty($this->data[$forum_id]['forum_icon']));

		// send block header if required
		$template->set_switch('indexrow.cat.header', $with_header);

		// display subforums
		$count_subs = count($this->data[$forum_id]['subs']);
		for ( $i = 0; $i < $count_subs; $i++ )
		{
			$cur_id = $this->data[$forum_id]['subs'][$i];
			$this->display_a_forum($cur_id, false, $moderators);
		}
	}

	function display_a_forum($forum_id, $with_header, &$moderators, $footer_only=false)
	{
		global $template, $config, $user;

		// send line
		$tpl_fields = array();
		if ( !$footer_only )
		{
			$folder_img = $this->get_folder_img($forum_id);
			$tpl_fields = array(
				'I_FORUM_FOLDER' => $user->img($folder_img['img']),
				'L_FORUM_FOLDER' => $user->lang($folder_img['txt']),
				'U_VIEWFORUM' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id), true),
				'FORUM_NAME' => $user->lang($this->data[$forum_id]['forum_name']),
				'FORUM_DESC' => $user->lang($this->data[$forum_id]['forum_desc']),
				'FORUM_ICON' => empty($this->data[$forum_id]['forum_icon']) ? '' : $user->img($this->data[$forum_id]['forum_icon']),
				'TOPICS' => $this->data[$forum_id]['sum_forum_topics'],
				'POSTS' => $this->data[$forum_id]['sum_forum_posts'],

				'U_CREATE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'create'), true),
				'U_EDIT' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'edit'), true),
				'U_DELETE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'delete'), true),
				'U_SYNCHRO' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'sync'), true),
				'U_MOVE_UP' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'moveup'), true),
				'U_MOVE_DOWN' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'movedw'), true),
			);
		}

		// send all to template
		$template->set_switch('indexrow');
		$template->assign_block_vars('indexrow.forum', $tpl_fields);

		// send block footer if required
		$template->set_switch('indexrow.forum.footer', $footer_only);
		if ( $footer_only )
		{
			return;
		}

		// send data
		$template->set_switch('indexrow.forum.row');

		// send forum icon
		$template->set_switch('indexrow.forum.row.forum_icon', !empty($this->data[$forum_id]['forum_icon']));

		// send moderators
		$this->moderators->display('indexrow.forum.row.moderators', $forum_id);

		// send subforums
		$this->display_subs_list('indexrow.forum.row', $forum_id, true);

		// send block header if required
		$template->set_switch('indexrow.forum.header', $with_header);
	}

	function display_a_link($forum_id, $with_header, &$moderators, $footer_only=false)
	{
		global $template, $config, $user;

		$tpl_fields = array();
		if ( !$footer_only )
		{
			$folder_img = $this->get_folder_img($forum_id);
			$tpl_fields = array(
				'I_FORUM_FOLDER' => $user->img($folder_img['img']),
				'L_FORUM_FOLDER' => $user->lang($folder_img['txt']),
				'U_VIEWFORUM' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id), true),
				'FORUM_NAME' => $user->lang($this->data[$forum_id]['forum_name']),
				'FORUM_DESC' => $user->lang($this->data[$forum_id]['forum_desc']),
				'FORUM_ICON' => empty($this->data[$forum_id]['forum_icon']) ? '' : $user->img($this->data[$forum_id]['forum_icon']),
				'HITS' => $this->data[$forum_id]['forum_link_hit_count'] ? sprintf($user->lang('Forum_link_visited'), $this->data[$forum_id]['forum_link_hit'], $user->date($this->data[$forum_id]['forum_link_start'])) : '',

				'U_CREATE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'create'), true),
				'U_EDIT' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'edit'), true),
				'U_DELETE' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'delete'), true),
				'U_SYNCHRO' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'sync'), true),
				'U_MOVE_UP' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'moveup'), true),
				'U_MOVE_DOWN' => $config->url($this->requester, array(POST_FORUM_URL => $forum_id, 'mode' => 'movedw'), true),
			);
		}
		$template->set_switch('indexrow');
		$template->assign_block_vars('indexrow.link', $tpl_fields);

		// send block footer if required
		$template->set_switch('indexrow.link.footer', $footer_only);
		if ( $footer_only )
		{
			return;
		}

		// send data
		$template->set_switch('indexrow.link.row');

		// send forum icon
		$template->set_switch('indexrow.link.row.forum_icon', !empty($this->data[$forum_id]['forum_icon']));

		// send subforums
		$this->display_subs_list('indexrow.link.row', $forum_id, true);

		// send block header if required
		$template->set_switch('indexrow.link.header', $with_header);
	}

	function get_forum_list($front_pic)
	{
		global $user;

		$res = array();
		if ( !empty($front_pic) )
		{
			foreach ( $front_pic as $cur_id => $front )
			{
				$count_front = strlen($front);
				$options = '';
				for ( $i = 0; $i < $count_front; $i++ )
				{
					$options .= $user->lang('tree_pic_' . $front[$i]);
				}
				if ( $cur_id >= 0 )
				{
					$options .= $user->lang($this->data[$cur_id]['forum_name']);
				}
				$res[$cur_id] = $options;
			}
		}
		return $res;
	}

	function get_previous_id($forum_id=0, $care_of_subs=true)
	{
		// already at root : previous is itself
		if ( empty($forum_id) )
		{
			$res = $forum_id;
		}
		else
		{
			$forum_main = $this->data[$forum_id]['forum_main'];

			// no subs yet (not possible) : previous is main
			if ( empty($this->data[$forum_main]['subs']) )
			{
				$res = $forum_id;
			}
			else
			{
				// find previous pos
				$tsubs = array_flip($this->data[$forum_main]['subs']);
				$i = $tsubs[$forum_id] - 1;
				// already in first position : previous is main
				if ( $i < 0 )
				{
					$res = $forum_main;
				}
				// get previous
				else
				{
					$res = $care_of_subs ? $this->data[ $this->data[$forum_main]['subs'][$i] ]['last_child_id'] : $this->data[$forum_main]['subs'][$i];
				}
			}
		}
		return $res;
	}

	function get_next_id($forum_id=0)
	{
		// already at root : next is root
		if ( empty($forum_id) )
		{
			$res = $forum_id;
		}
		else
		{
			$forum_main = $this->data[$forum_id]['forum_main'];

			// no subs (not possible btw :)) : next is itself
			if ( empty($this->data[$forum_main]['subs']) )
			{
				$res = $forum_id;
			}
			else
			{
				// find next child
				$tsubs = array_flip($this->data[$forum_main]['subs']);
				$i = $tsubs[$forum_id] + 1;
				// already in last position : next is itself
				if ( $i >= count($this->data[ $this->data[$forum_id]['forum_main'] ]['subs']) )
				{
					$res = $forum_id;
				}
				// get next
				else
				{
					$res = $this->data[ $this->data[$forum_main]['subs'][$i] ]['last_child_id'];
				}
			}
		}
		return $res;
	}

	// used for move, update and delete
	function move($forum_id, $after_id, $delete_root=false, $delete_branch=false, $new_main_id=0)
	{
		global $db, $user, $config;

		if ( $forum_id == $after_id )
		{
			return false;
		}
		if ( !$user->auth(POST_FORUM_URL, 'auth_manage', $forum_id) )
		{
			global $dsp;

			$l_link = 'Click_return_forumadmin';
			$u_link = $config->url($this->requester, array(POST_FORUM_URL => $this->data[$forum_id]['forum_main'], 'dsp' => $dsp), true);
			message_return('Not_Authorised', $l_link, $u_link);
		}
		$deleted_forum_ids = array();

		// get the min and the max position of the branch to move
		$tkeys = array_flip($this->keys);
		$min = $tkeys[ $forum_id ];
		$max = $tkeys[ $this->data[$forum_id]['last_child_id'] ];
		unset($tkeys);

		// re-order forums
		$update = false;
		$order = -10;
		$count_forums = count($this->keys);
		for ( $i = 0; $i < $count_forums; $i++ )
		{
			// ignore branch to move
			if ( ($i >= $min) && ($i <= $max) )
			{
				$update = true;
				if ( $delete_branch || (($i == $min) && $delete_root) )
				{
					$deleted_forum_ids[] = $this->keys[$i];
				}
			}

			// point of insertion
			if ( $this->keys[$i] == $after_id )
			{
				$order += 10;
				if ( !empty($this->keys[$i]) && $update )
				{
					$sql = 'UPDATE ' . FORUMS_TABLE . '
								SET forum_order = ' . $order . '
								WHERE forum_id = ' . $this->keys[$i];
					$db->sql_query($sql, false, __LINE__, __FILE__);
				}
				$update = true;

				if ( !$delete_branch )
				{
					// insert branch
					$start = $min;
					if ( $delete_root )
					{
						$start++;
						$new_main = ', forum_main = ' . $new_main_id;
						$subs = empty($this->data[$forum_id]['subs']) ? array() : array_flip($this->data[$forum_id]['subs']);
					}
					for ( $j = $start; $j <= $max; $j++ )
					{
						$order += 10;
						if ( $delete_root && isset($subs[ $this->keys[$j] ]) )
						{
							$sql_main = $new_main;
						}
						$sql = 'UPDATE ' . FORUMS_TABLE . '
									SET forum_order = ' . $order . $sql_main . '
									WHERE forum_id = ' . $this->keys[$j];
						$db->sql_query($sql, false, __LINE__, __FILE__);
					}
				}
			}
			// process all what isn't at the insert point or belonging to the branch to move
			else if ( ($i < $min) || ($i > $max) )
			{
				$order += 10;
				// something has been moved before this one : update order
				if ( !empty($this->keys[$i]) && $update )
				{
					$sql = 'UPDATE ' . FORUMS_TABLE . '
								SET forum_order = ' . $order . '
								WHERE forum_id = ' . $this->keys[$i];
					$db->sql_query($sql, false, __LINE__, __FILE__);
				}
			}
		}

		return $deleted_forum_ids;
	}

	// used for insertion
	function renum()
	{
		global $db;

		// read all forums sorted
		$sql = 'SELECT forum_id
					FROM ' . FORUMS_TABLE . '
					ORDER BY forum_order';
		$result = $db->sql_query($sql, false, __LINE__, __FILE__);
		$forum_ids = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$forum_ids[] = intval($row['forum_id']);
		}
		$db->sql_freeresult($result);

		// renum them
		$order = 0;
		$count_forum_ids = count($forum_ids);
		for ( $i = 0; $i < $count_forum_ids; $i++ )
		{
			if ( !empty($forum_ids[$i]) )
			{
				$order += 10;
				$sql = 'UPDATE ' . FORUMS_TABLE . '
							SET forum_order = ' . $order . '
							WHERE forum_id = ' . $forum_ids[$i];
				$db->sql_query($sql, false, __LINE__, __FILE__);
			}
		}
	}
}

//------------------------------------------------------------------------------
//
// Main process
//
//------------------------------------------------------------------------------

$requester = 'admin/admin_forums';

// init user and forums
$forums = new forums_admin($requester);
$forums->read();
$user->get_cache(POST_FORUM_URL);

//
// get parms
//
$dsp = _read('dsp', TYPE_NO_HTML, '', array_flip(array('', 'flat', 'style', 'fprune')));
$mode = _read('mode', TYPE_NO_HTML, '',  $mode_allowed);
$forum_id = _read(POST_FORUM_URL, TYPE_INT);

//
// edit/create/delete a forum
//
if ( ($mode == 'edit') || ($mode == 'create') || ($mode == 'delete') )
{
	if ( _button('cancel_form') )
	{
		$forum_id = ($mode == 'create') ? $forum_id : intval($forums->data[$forum_id]['forum_main']);
		$mode = '';
	}
	else
	{
		// send the form
		$form = new form_forum_det($requester, $mode, $forum_id, $dsp);
		$form->process();
		if ( !_button('cancel_form') )
		{
			include($config->url('admin/page_footer_admin'));
		}
	}
}

//
// move a forum up and down
//
if ( ($mode == 'moveup') || ($mode == 'movedw') )
{
	if ( $mode == 'moveup' )
	{
		$previous_id = $forums->get_previous_id($forum_id, false);
		if ( $previous_id != intval($forums->data[$forum_id]['forum_main']) )
		{
			$previous_id = $forums->get_previous_id($previous_id);
		}
	}
	$forums->move($forum_id, (($mode == 'moveup') ? $previous_id : $forums->get_next_id($forum_id)));

	// recache
	$forums->read(true);
	$now = $forums->data_time;
	$config->set('cache_time_' . POST_FORUM_URL . 'jbox', $now);

	// display the parent forum to see all subs
	if ( !empty($forum_id) )
	{
		$forum_id = $forums->data[$forum_id]['forum_main'];
	}
	$mode = '';
}

//
// resynchronize forums
//
if ( $mode == 'sync' )
{
	if ( !empty($forums->keys) )
	{
		$tkeys = array_flip($forums->keys);
		$min = $tkeys[ $forum_id ];
		$max = $tkeys[ $forums->data[$forum_id]['last_child_id'] ];
		unset($tkeys);
		for ( $i = $max; $i >= $min; $i-- )
		{
			sync('forum', $forums->keys[$i], !empty($i));
		}
		message_return('Forums_resync_done', 'Click_return_forumadmin', $config->url($requester, array(POST_FORUM_URL => $forum_id, 'dsp' => $dsp), true));

		if ( !empty($forum_id) )
		{
			$forum_id = $forums->data[$forum_id]['forum_main'];
		}
	}
	$mode = '';
}

//
// index (list of forums)
//
if ( $mode == '' )
{
	// refresh forums info
	$forums->init($dsp);
	$forums->refresh($dsp ? 0 : $forum_id);

	// check if submit pressed
	$results = array();
	$prune_days = _read('prune_days', TYPE_INT, 7);
	if ( _button('submit_list') )
	{
		switch ( $dsp )
		{
			// style view
			case 'style':
				// read styles from form
				$style_ids = _read('styles', '', '', '', true);

				// keep only valid changed styles
				$new_style_ids = array();
				if ( !empty($style_ids) )
				{
					foreach ( $style_ids as $cur_id => $style_id )
					{
						if ( isset($forums->data[$cur_id]) && ($forums->data[$cur_id]['forum_style'] != $style_id) )
						{
							if ( (empty($style_id) && !empty($cur_id)) || isset($themes->data[$style_id]) )
							{
								if ( $user->auth(POST_FORUM_URL, 'auth_manage', $cur_id) )
								{
									$new_style_ids[$cur_id] = $style_id;
								}
							}
						}
					}
				}

				// update forums
				if ( !empty($new_style_ids) )
				{
					$config->begin_transaction();
					foreach ( $new_style_ids as $cur_id => $style_id )
					{
						if ( empty($cur_id) && !empty($style_id) )
						{
							$config->set('default_style', $style_id);
						}
						else
						{
							$fields = array(
								'forum_style' => $style_id,
							);
							$db->sql_statement($fields);
							$sql = 'UPDATE ' . FORUMS_TABLE . '
										SET ' . $db->sql_update . '
										WHERE forum_id = ' . $cur_id;
							$db->sql_query($sql, false, __LINE__, __FILE__);
						}
					}

					// all done : recache (including auths & jumpbox)
					$forums->read(true);
					$now = $forums->data_time;
					$config->set('cache_time_' . POST_FORUM_URL, $now);
					$config->set('cache_time_' . POST_FORUM_URL . 'jbox', $now);
					$config->end_transaction();

					// send achievement message
					message_return('Forums_updated', 'Click_return_forumadmin', $config->url($requester, array('dsp' => $dsp), true));
				}
				break;

			// pruning view
			case 'fprune':
				// get prune date (in days)
				$prune_date = time() - ($prune_days * 86400);

				// get forums choosen
				$forum_ids = _read('forum_ids', '', '', '', true);
				$count_forum_ids = count($forum_ids);
				$prune_ids = array();
				for ( $i = 0; $i < $count_forum_ids; $i++ )
				{
					if ( isset($forums->data[ intval($forum_ids[$i]) ]) && $user->auth(POST_FORUM_URL, 'auth_manage', intval($forum_ids[$i])) )
					{
						$prune_ids[] = intval($forum_ids[$i]);
					}
				}
				$forum_ids = array();
				$count_prune_ids = count($prune_ids);
				$results = array();
				for ( $i = 0; $i < $count_prune_ids; $i++ )
				{
					$results[ $prune_ids[$i] ] = prune($prune_ids[$i], $prune_date);
					sync('forum', $prune_ids[$i]);
				}
				break;
		}
	}

	// display forums
	$template->assign_vars(array(
		'L_TITLE' => ($dsp == 'fprune') ? $user->lang('Forum_Prune') : $user->lang($mode_allowed[$mode]['title']),
		'L_TITLE_EXPLAIN' => ($dsp == 'fprune') ? $user->lang('Forum_Prune_explain') : $user->lang($mode_allowed[$mode]['explain']),
		'L_TOPICS' => $user->lang('Topics'),
		'L_POSTS' => $user->lang('Posts'),
		'L_SELECT' => $user->lang('Select'),
		'L_CHANGE_VIEW' => $user->lang('change_view'),
		'U_CHANGE_VIEW' => $config->url($requester, array('dsp' => ($dsp == 'style') ? '' : 'style'), true),
		'L_PRUNE_DAYS' => $user->lang('Prune_topics_not_posted'),
		'L_DAYS' => $user->lang('Days'),

		'PRUNE_DAYS' => $prune_days,

		'S_ACTION' => $config->url($requester, '', true),
	));
	_hide(array('mode' => $mode, POST_FORUM_URL => $forum_id, 'dsp' => $dsp));
	_hide_set();
	if ( !$dsp )
	{
		$template->set_switch('change_view');
		$forums->display_nav($forum_id);
	}

	$forums->display($forum_id, $results);
	switch ( $dsp )
	{
		case 'style':
			$tpl = 'admin/forum_flat_body.tpl';
			break;
		case 'fprune':
			$tpl = 'admin/forum_fprune_body.tpl';
			break;
		default:
			$tpl = 'admin/forum_index_body.tpl';
			break;
	}
	$template->set_filenames(array('body' => $tpl));
	$template->pparse('body');
	include($config->url('admin/page_footer_admin'));
}

?>