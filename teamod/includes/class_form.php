<?php
/***************************************************************************
 *							class_form.php
 *							--------------
 *	begin		: 05/09/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.12 - 23/10/2005
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

//
// basic form
//

class form
{
	var $fields;
	var $mode;
	var $width;
	var $buttons;

	function form(&$fields, $width=true)
	{
		$this->width = $width;
		$this->fields = array();
		$this->buttons = array(
			'submit_form' => array('txt' => 'Submit', 'img' => 'cmd_submit', 'key' => 'cmd_submit'),
		);
		if ( !empty($fields) )
		{
			foreach ( $fields as $field_name => $field_data )
			{
				$class = class_exists('field_' . $field_data['type']) ? 'field_' . $field_data['type'] : 'field_varchar';
				$this->fields[$field_name] = new $class($field_name, $field_data);
			}
		}
	}

	function process($mode='', $submit=false, $cancel=false, $tpl_switch='')
	{
		$this->init($mode);
		if ( _button('submit_form') || (isset($this->buttons['delete_form']) && _button('delete_form')) || $submit )
		{
			$this->check();
			$this->validate();
		}
		if ( !_button('cancel_form') || $cancel )
		{
			$this->display($tpl_switch);
		}
	}

	function init($mode='')
	{
		$this->mode = $mode;
	}

	function check()
	{
		foreach ( $this->fields as $field_name => $field )
		{
			$this->fields[$field_name]->check();
		}
	}

	function validate()
	{
	}

	function display($tpl_switch='')
	{
		global $template, $config, $user;

		$tpl_switch = empty($tpl_switch) ? 'FORM' : $tpl_switch;
		$template->set_filenames(array('form' => 'form_fields.tpl'));
		if ( $this->width )
		{
			$template->assign_vars(array(
				'FORM_WIDTH' => ' width="40%"',
			));
		}
		foreach ( $this->fields as $field_name => $field )
		{
			$this->fields[$field_name]->display();
		}
		display_buttons($this->buttons);
		$template->assign_var_from_handle($tpl_switch, 'form');
	}

	function set_buttons($buttons)
	{
		$this->buttons = empty($buttons) ? array() : $buttons;
	}
}

class generic_form extends form
{
	var $requester;
	var $parms;
	var $return_message;

	function generic_form($requester, $parms, $return_message)
	{
		$this->requester = $requester;
		$this->parms = $parms;
		$this->return_message = $return_message;
	}

	function init_form(&$fields)
	{
		parent::form($fields);
	}

	function display()
	{
		global $template, $config;

		// display the form
		parent::display();

		// add titles
		$template->assign_vars(array(
			'S_ACTION' => $config->url($this->requester, '', true),
		));

		// hide parms
		if ( !empty($this->parms) )
		{
			foreach ( $this->parms as $parm => $value )
			{
				_hide($parm, $value, true);
			}
		}

		return true;
	}
}

// basic auto form (used by auto-generated panels)
class auto_form extends form
{
	var $requester;
	var $return_msg;
	var $return_parms;
	var $table_data;

	function auto_form(&$table_data, &$fields, $requester, $return_msg, $return_parms=array())
	{
		$this->table_data = $table_data;
		$this->requester = $requester;
		$this->return_msg = $return_msg;
		$this->return_parms = $return_parms;

		// retrieve values from data
		if ( !empty($fields) )
		{
			foreach ( $fields as $field_name => $field_data )
			{
				if ( !empty($field_data['field']) )
				{
					$fields[$field_name]['value'] = $this->table_data[ $field_data['field'] ];
				}
				if ( !empty($field_data['sub_fields']) && is_array($field_data['sub_fields']) )
				{
					foreach ( $field_data['sub_fields'] as $sub_field_name => $sub_field_table_field )
					{
						$fields[$field_name]['sub_values'][$sub_field_name] = $this->table_data[$sub_field_table_field];
					}
				}
			}
		}

		// init the fields
		parent::form($fields);
	}

	function process()
	{
		$this->init();
		if ( _button('submit_form') || _button('delete_form') )
		{
			$this->check();
			$this->validate();
		}
		$this->display();
	}

	function check()
	{
		global $error, $error_msg;
		global $config;

		// check fields
		parent::check();

		// halt on error
		if ( $error )
		{
			message_return($error_msg, $this->return_msg, $config->url($this->requester, $this->return_parms, true), 10);
		}
	}

	function validate()
	{
		global $db, $config;

		$fields = array();
		foreach ( $this->fields as $field_name => $field )
		{
			if ( !empty($field->data['field']) )
			{
				$fields[ $field->data['field'] ] = $field->value;
			}
			if ( !empty($field->data['sub_fields']) && is_array($field->data['sub_fields']) )
			{
				foreach ( $field->data['sub_fields'] as $sub_field_name => $sub_field_table_field )
				{
					$fields[$sub_field_table_field] = $field->data['sub_values'][$sub_field_name];
				}
			}
		}
		if ( !empty($fields) )
		{
			$this->update_table($fields);
		}
	}

	function update_table(&$fields)
	{
	}
}

//
// basic field definition
//

class field
{
	var $name;
	var $data;
	var $type;
	var $value;

	function field($field_name, &$field_data)
	{
		$this->name = $field_name;
		$this->data = $field_data;
		$this->type = $field_data['type'];
		$this->init();
	}

	function init()
	{
		if ( !isset($this->data['output']) )
		{
			$this->data['output'] = false;
		}
		if ( !isset($this->data['value']) )
		{
			$this->data['value'] = '';
		}
		if ( !isset($this->data['combined']) )
		{
			$this->data['combined'] = false;
		}
		if ( !isset($this->data['in_row']) )
		{
			$this->data['in_row'] = false;
		}
		if ( isset($this->data['over']) && $this->data['over'] )
		{
			$this->data['cell'] = true;
			$this->data['cell.align'] = isset($this->data['over.center']) && $this->data['over.center'] ? ' align="center"' : '';
			$this->data['cell.colspan'] = ' colspan="2"';
			$this->data['cell.light'] = true;
			$this->data['cell.width'] = isset($this->data['width']) ? $this->data['width'] : '';
		}
		if ( !isset($this->data['cell']) )
		{
			$this->data['cell'] = false;
		}
		if ( !isset($this->data['title']) )
		{
			$this->data['title'] = $this->data['legend'];
		}
		$this->value = $this->data['output'] ? $this->data['value'] : $this->get_value($this->data['value']);
	}

	function get_value($value)
	{
		return _read($this->name, TYPE_NO_HTML, $value);
	}

	function display()
	{
		global $db, $config, $template, $user;

		// field is hidden
		if ( isset($this->data['hidden']) && $this->data['hidden'] )
		{
			$template->assign_block_vars('field.hidden', array(
				'NAME' => $this->name,
				'VALUE' => addslashes(stripslashes($this->value)),
			));
			return;
		}

		// javascript included
		if ( !empty($this->data['javascript']) )
		{
			$template->assign_block_vars('javascript', array(
				'U_JAVASCRIPT' => strrchr($this->data['javascript'], '.') == '.js' ? $config->root . $this->data['javascript'] : $config->url($this->data['javascript']),
			));
		}

		// set a new field
		$template->set_switch('field', !$this->data['combined']);
		$template->set_switch('field.table_row', !$this->data['combined'] && !$this->data['in_row']);

		// display legend
		$field_values = $this->field_values();
		if ( !$this->data['combined'] && !$this->data['cell'])
		{
			$template->assign_block_vars('field.legend', $field_values);
			$this->field_switches('legend');
		}
		if ( $this->data['cell'] && !$this->data['combined'] && !$this->data['hidden'] )
		{
			$template->assign_block_vars('field.table_cell', array(
				'ALIGN' => $this->data['cell.align'],
				'COLSPAN' => $this->data['cell.colspan'],
				'WIDTH' => $this->data['cell.width'],
			));
			$template->set_switch('field.table_cell.light', !isset($this->data['cell.light']) || $this->data['cell.light']);
			$template->set_switch('field.table_cell.new_row', $this->data['cell.new_row']);
			$template->set_switch('field.table_cell.close_row', $this->data['cell.close_row']);
		}

		// display
		$template->assign_block_vars('field.data', $field_values);
		$this->field_switches('data');

		// display value
		if ( $this->data['output'] )
		{
			$template->set_switch('field.data.' . $this->type . '_output');
			$this->field_switches('data.' . $this->type . '_output');
		}
		else
		{
			$template->set_switch('field.data.' . $this->type . '_input');
			$this->field_switches('data.' . $this->type . '_input');
			$this->display_options();
		}
	}

	function field_values()
	{
		global $user, $config;
		return array(
			'LEGEND' => !empty($this->data['legend']) ? $user->lang($this->data['legend']) : '',
			'EXPLAIN' => !empty($this->data['explain']) ? $user->lang($this->data['explain']) : '',
			'WIDTH' => !empty($this->data['width']) ? _un_htmlspecialchars($this->data['width']) : '',
			'IMAGE' => !empty($this->data['image']) ? $user->img($this->data['image']) : '',
			'TITLE' => !empty($this->data['title']) ? $user->lang($this->data['title']) : '',
			'HTML' => !empty($this->data['html']) ? _un_htmlspecialchars($this->data['html']) : '',
			'NAME' => $this->name,
			'VALUE' => $this->get_displayed_value(),
			'POST_VALUE' => !empty($this->data['post_value']) ? $user->lang($this->data['post_value']) : '',
			'LENGTH' => (!isset($this->data['length']) || empty($this->data['length'])) ? 50 : $this->data['length'],
			'U_LINK' => (!isset($this->data['link']) || empty($this->data['link'])) ? '' : $this->data['link'],
		);
	}

	function field_switches($level='')
	{
		global $template;
		$template->set_switch('field.' . $level . '.explain', !empty($this->data['explain']));
		$template->set_switch('field.' . $level . '.image', !empty($this->data['image']));
		$template->set_switch('field.' . $level . '.link', !empty($this->data['link']));
		$template->set_switch('field.' . $level . '.linefeed', isset($this->data['linefeed']) && $this->data['linefeed']);
		$template->set_switch('field.' . $level . '.bold', isset($this->data['bold']) && $this->data['bold']);
	}

	function get_displayed_value()
	{
		return $this->value;
	}

	function display_options()
	{
	}

	function check()
	{
		global $user;
		global $error, $error_msg;

		// only fields sat for input
		if ( !$this->data['output'] )
		{
			// minimal length
			if ( !empty($this->data['length_mini']) && (strlen(trim($this->value)) < intval($this->data['length_mini'])) )
			{
				// check if empty allowed
				if ( !$this->data['empty_allowed'] || (strlen(trim($this->value)) > 0) )
				{
					// generate auto error messages
					if ( empty($this->data['length_mini_error']) )
					{
						_error( $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . (strlen(trim($this->value)) ? $user->lang('length_mini_error') : $user->lang('empty_error')));
					}
					// error messages granted
					else
					{
						_error( $this->data['length_mini_error']);
					}
				}
			}

			// maximal length
			if ( !empty($this->data['length_maxi']) && (strlen(trim($this->value)) > intval($this->data['length_maxi'])) )
			{
				_error( (empty($this->data['length_maxi_error']) ? $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('length_maxi_error') : $this->data['length_maxi_error']));
			}

			// minimal value
			if ( !empty($this->data['value_mini']) && ($this->value < $this->data['value_mini']) )
			{
				_error( (empty($this->data['value_mini_error']) ? $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('value_mini_error') : $this->data['value_mini_error']));
			}

			// maximal value
			if ( isset($this->data['value_maxi']) && strlen($this->data['value_maxi']) && ($this->value < $this->data['value_maxi']) )
			{
				_error( (empty($this->data['value_maxi_error']) ? $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('value_maxi_error') : $this->data['value_maxi_error']));
			}
		}
	}
}

//
// basic field list definition (and also drop down list)
//

class field_list extends field
{
	function get_value($value)
	{
		return _read($this->name, TYPE_NO_HTML, $value, $this->data['options']);
	}

	function get_displayed_value()
	{
		global $user;

		if ( $this->data['output'] )
		{
			$value = (isset($this->data['options.no_translate']) && $this->data['options.no_translate']) ? $this->data['options'][$this->value] : $user->lang($this->data['options'][$this->value]);
		}
		else
		{
			$value = '';
			if ( !empty($this->data['options']) )
			{
				foreach ( $this->data['options'] as $val => $desc )
				{
					$selected = ($val == $this->value) ? ' selected="selected"' : '';
					$value .= '<option value="' . $val . '"' . $selected . '>' . ((isset($this->data['options.no_translate']) && $this->data['options.no_translate']) ? $desc : $user->lang($desc)) . '</option>';
				}
			}
		}
		return $value;
	}

	function check()
	{
		global $user;
		global $error, $error_msg;

		// standard check
		parent::check();

		// only fields sat for input
		if ( !$this->data['output'] )
		{
			if ( empty($this->data['options']) )
			{
				_error( (empty($this->data['options_empty_error']) ? $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('options_empty_error') : $this->data['options_empty_error']));
			}
			// list check
			$int_val = sprintf('%s', intval($this->value));
			$float_val = sprintf('%01.2f', doubleval($this->value));
			if ( !isset($this->data['options'][$this->value]) && !isset($this->data['options'][$int_val]) && !isset($this->data['options'][$float_val]) )
			{
				_error( (empty($this->data['options_error']) ? $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': '. $user->lang('options_error') : $this->data['options_error']));
			}
		}
	}
}

//
// fields for sub panels
//

class field_table extends field
{
	function init()
	{
		$this->type = ($this->data['action'] == 'open') ? 'table_open' : 'table_close';
	}

	function display()
	{
		global $template;

		$template->set_switch('field');
		$template->set_switch('field.table_row', false);

		if ( $this->type == 'table_open' )
		{
			// display table
			$template->assign_block_vars('field.table_open', array(
				'WIDTH' => empty($this->data['width']) ? '' : _un_htmlspecialchars($this->data['width']),
				'PADDING' => !isset($this->data['padding']) ? 4 : intval($this->data['padding']),
			));
			if ( !empty($this->data['class']) )
			{
				$template->set_switch('field.table_open.class_' . $this->data['class']);
			}
			$template->set_switch('field.table_open.new_row', isset($this->data['new_row']) && $this->data['new_row']);
			$template->set_switch('field.table_open.new_column', isset($this->data['new_column']) && $this->data['new_column']);
		}
		else
		{
			$template->set_switch('field.table_close');
			$template->set_switch('field.table_close.close_column', isset($this->data['new_column']) && $this->data['new_column']);
			$template->set_switch('field.table_close.close_row', isset($this->data['new_row']) && $this->data['new_row']);
		}
	}
}

//
// fields spaning form
//

class field_title extends field
{
	function display()
	{
		global $db, $template, $user;

		// set a new field
		$template->set_switch('field');
		$template->set_switch('field.table_row');

		// display legend
		$template->assign_block_vars('field.title', array(
			'LEGEND' => $user->lang($this->data['legend']),
		));
	}
}

class field_sub_title extends field
{
	function display()
	{
		global $db, $template, $user;

		// set a new field
		$template->set_switch('field');
		$template->set_switch('field.table_row');

		// display legend
		$template->assign_block_vars('field.sub_title', array(
			'LEGEND' => $user->lang($this->data['legend']),
		));
	}
}

class field_comment extends field
{
	function display()
	{
		global $db, $template, $user;

		// set a new field
		$template->set_switch('field');
		$template->set_switch('field.table_row');

		// display legend
		$template->assign_block_vars('field.comment', array(
			'LEGEND' => $user->lang($this->data['legend']),
		));
	}
}

class field_comment_light extends field
{
	function display()
	{
		global $db, $template, $user;

		// set a new field
		$template->set_switch('field');
		$template->set_switch('field.table_row');

		// display legend
		$template->assign_block_vars('field.comment_light', array(
			'LEGEND' => $user->lang($this->data['legend']),
		));
	}
}

class field_mini_comment extends field
{
	function init()
	{
		$this->data['output'] = true;
		parent::init();
	}
}


//
// let's start real fields
//

class field_varchar extends field
{
	function init()
	{
		parent::init();
		$this->type = 'varchar';
	}
}

class field_varchar_comment extends field
{
	function init()
	{
		parent::init();
		$this->data['output'] = true;
		$this->data['combined'] = true;
	}
}

class field_int extends field
{
	function get_value($value)
	{
		return _read($this->name, TYPE_INT, $value);
	}
}

class field_text extends field
{
	function get_displayed_value()
	{
		return str_replace('<', '&lt;', str_replace('>', '&gt;', str_replace('<br />', "\n", $this->data['output'] ? $this->value : _un_htmlspecialchars($this->value))));
	}
}

class field_text_html extends field_text
{
	function get_value($value)
	{
		$value = $this->data['output'] ? $value : str_replace('<', '&lt;', str_replace('>', '&gt;', str_replace('<br />', "\n", $value)));
		return _read($this->name, '', trim($value));
	}
	function get_displayed_value()
	{
		return $this->data['output'] ? $this->value : _un_htmlspecialchars($this->value);
	}
	function init()
	{
		parent::init();
		$this->type = 'text';
	}
}

class field_url extends field
{
	function init()
	{
		parent::init();
		$this->type = 'varchar';
	}
	function check()
	{
		global $user;
		global $error, $error_msg;

		if ( $this->data['output'] || empty($this->value) )
		{
			return;
		}

		// external url
		if ( preg_match('#^(mailto\:|(news|(ht|f)tp(s?))\:\/\/)#i', $this->value) )
		{
			if ( !preg_match('#^(mailto\:|(news|(ht|f)tp(s?))\:\/\/)[a-z0-9\-_]+\.([a-z0-9\-_]+\.)?[a-z]+#i', $this->value) )
			{
				_error((empty($this->data['url_error']) ? $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('url_error') : $this->data['url_error']));
			}
		}
		else
		{
			if ( ($this->value != '#') && !preg_match('#^[a-z0-9\-\.\/_]+\.([a-z0-9\-_]+\.)?[a-z]+#i', $this->value) )
			{
				_error((empty($this->data['url_error']) ? $user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('url_error') : $this->data['url_error']));
			}
		}
	}
}

class field_internal_dir extends field_varchar
{
	function check()
	{
		global $error, $error_msg;
		global $config, $user;

		parent::check();
		if ( !$error )
		{
			// check the url
			if ( !is_dir($config->root . $this->value) )
			{
				_error($user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('Not_a_valid_directory'));
			}
		}
	}
}

class field_internal_script extends field_varchar
{
	function check()
	{
		global $error, $error_msg;
		global $config, $user;

		parent::check();

		// check the url
		if ( !$error && !empty($this->value) )
		{
			$file = (strrchr($this->value, '.') == '.js') ? $config->root . $this->value : $config->url($this->value);
			if ( !@file_exists($file) || @is_dir($file) || @is_link($file) )
			{
				_error($user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('Not_a_valid_script'));
			}
		}
	}
}

class field_image extends field
{
	function init()
	{
		parent::init();
		$this->data['output'] = true;
	}
}

class field_button extends field
{
}

class field_radio_list extends field_list
{
	function get_displayed_value()
	{
		global $user;
		return (isset($this->data['output']) && $this->data['output']) ? $user->lang($this->data['options'][$this->value]) : '';
	}

	function display_options()
	{
		global $template, $user;
		if ( !empty($this->data['options']) )
		{
			foreach ( $this->data['options'] as $val => $desc )
			{
				$template->assign_block_vars('field.data.' . $this->type . '_input.option', array(
					'SELECTED' => ($val == $this->value) ? ' checked="checked"' : '',
					'VALUE' => $val,
					'DESC' => $user->lang($desc),
				));
				$template->set_switch('field.data.' . $this->type . '_input.option.linefeed', isset($this->data['options.linefeed']) && $this->data['options.linefeed']);
			}
		}
	}
}

class field_radio_list_comment extends field_radio_list
{
	function init()
	{
		parent::init();
		$this->data['combined'] = true;
	}
}

class field_checkbox_list extends field
{
	function init()
	{
		parent::init();
	}

	function display()
	{
		// display legend and value
		parent::display();

		// display value
		if ( $this->data['output'] )
		{
			$this->display_options();
		}
	}

	function get_value($value)
	{
		// something is displayed, search what
		if ( _button($this->name . '_dsp') )
		{
			$form_values = _read($this->name, '', '', '', true);
			$count_values = count($form_values);
			$value = array();
			for ( $i = 0; $i < $count_values; $i++ )
			{
				if ( isset($this->data['options'][ $form_values[$i] ]) )
				{
					$value[] = $form_values[$i];
				}
			}
		}
		else if ( empty($value) )
		{
			$value = array();
		}
		return $value;
	}

	function display_options()
	{
		global $template, $user;

		if ( !empty($this->data['options']) )
		{
			$in_out = $this->data['output'] ? '_output' : '_input'; 
			foreach ( $this->data['options'] as $val => $desc )
			{
				if ( in_array($val, $this->value) || !$this->data['output'] )
				{
					$template->assign_block_vars('field.data.' . $this->type . $in_out . '.option', array(
						'SELECTED' => in_array($val, $this->value) ? ' checked="checked"' : '',
						'VALUE' => $val,
						'DESC' => $user->lang($desc),
					));
					$template->set_switch('field.data.' . $this->type . $in_out . '.option.linefeed', $this->data['options.linefeed']);
				}
			}
		}
	}
}

class field_mini_link extends field
{
	function init()
	{
		parent::init();
		$this->data['output'] = true;
	}
}

class field_date_unix extends field
{
	var $fields;
	var $order;

	function field_date_unix($name, $data)
	{
		global $config, $user;

		if ( !$data['output'] )
		{
			$this->order['y'] = strpos(' ' . strtolower($user->data['user_dateformat']), 'y')-1;
			$this->order['m'] = (strpos(' ' . strtolower($user->data['user_dateformat']), 'm')-1 >= 0) ? strpos(' ' . strtolower($user->data['user_dateformat']), 'm')-1 : strpos(' ' . $user->data['user_dateformat'], 'n')-1;
			$this->order['d'] = (strpos(' ' . $user->data['user_dateformat'], 'd')-1 >= 0) ? strpos(' ' . $user->data['user_dateformat'], 'd')-1 : strpos(' ' . $user->data['user_dateformat'], 'j')-1;
			asort($this->order);
			$this->order = array_flip(array_keys($this->order));

			// declare the fields
			foreach ($this->order as $frag => $pos)
			{
				$others = array_flip(array('Y', 'M', 'D'));
				unset($others[strtoupper($frag)]);
				$others = array_keys($others);
				$sub_data = $data;
				$sub_data['combined'] = $pos ? true : (isset($sub_data['combined']) ? $sub_data['combined'] : false);
				$sub_data['type'] = 'list';
				$sub_data['legend'] = $pos ? '' : $data['legend'];
				$sub_data['explain'] = $pos || !isset($data['explain']) ? '' : $data['explain'];
				$sub_data['value'] = $this->get_orig_value($frag, $data);
				$sub_data['options'] = $this->get_list($frag, $data);
				$sub_data['html'] = 'onChange="if (this.options[selectedIndex].value <= 0) {this.form.' . $name . '_' . $others[0] . '.value = 0; this.form.' . $name . '_' . $others[1] . '.value = 0; };"';
				$sub_data['options.no_translate'] = ($frag == 'd');
				$this->fields[$frag] = new field_list($name . '_' . strtoupper($frag), $sub_data);
			}

			// add javascript links
			$hour = $data['options.end_date'] ? 23 : 0;
			$minute = $data['options.end_date'] ? 59 : 0;
			$second = $data['options.end_date'] ? 59 : 0;
			$now = $user->cvt_sys_to_user_date(time());
			$today = mktime($hour, $minute, $second, date('m', $now), date('d', $now), date('Y', $now));
			$one_week = mktime($hour, $minute, $second, date('m', $now), date('d', $now)+7, date('Y', $now));
			$one_month = mktime($hour, $minute, $second, date('m', $now)+1, date('d', $now), date('Y', $now));
			$fields = array(
				$name . '_today' => array('type' => 'mini_link', 'legend' => 'Today', 'value' => '#', 'combined' => true, 'linefeed' => true, 'post_value' => ' :: ', 'html' => ' onClick="document.post.' . $name . '_D.value = ' . date('d', $today) . '; document.post.' . $name . '_M.value = ' . date('m', $today) . '; document.post.' . $name . '_Y.value = ' . date('Y', $today) . ';"'),
				$name . '_one_week' => array('type' => 'mini_link', 'legend' => '7_Days', 'value' => '#', 'combined' => true, 'post_value' => ' :: ', 'html' => ' onClick="document.post.' . $name . '_D.value = ' . date('d', $one_week) . '; document.post.' . $name . '_M.value = ' . date('m', $one_week) . '; document.post.' . $name . '_Y.value = ' . date('Y', $one_week) . ';"'),
				$name . '_one_month' => array('type' => 'mini_link', 'legend' => '1_Month', 'value' => '#', 'combined' => true, 'html' => ' onClick="document.post.' . $name . '_D.value = ' . date('d', $one_month) . '; document.post.' . $name . '_M.value = ' . date('m', $one_month) . '; document.post.' . $name . '_Y.value = ' . date('Y', $one_month) . ';"'),
			);
			foreach ( $fields as $field_name => $field )
			{
				$this->fields[$field_name] = new field_mini_link($field_name, $field);
			}
		}
		parent::field($name, $data);
	}

	function force_value($value)
	{
		if ( $this->data['output'] )
		{
			$this->value = $value;
		}
		else
		{
			$this->value = $value;
			$data = $this->data;
			$data['value'] = $this->value;
			foreach ($this->order as $frag => $pos)
			{
				$this->fields[$frag]->value = $this->get_orig_value($frag, $data);
			}
		}
	}

	function get_orig_value($frag, &$data)
	{
		$res = 0;
		$value = $data['value'];
		if ( $value < 0 )
		{
			return ($frag == 'm') ? -1 : 0;
		}
		if ( !empty($value) )
		{
			switch ( $frag )
			{
				case 'y':
					$res = intval(date('Y', $value));
					break;
				case 'm':
					$res = intval(date('m', $value));
					break;
				case 'd':
					$res = intval(date('d', $value));
					break;
			}
		}
		return $res;
	}

	function get_list($frag, &$data)
	{
		global $config;
		$list = array();
		switch ($frag)
		{
			case 'd':
				$list = array(0 => '--');
				for ( $i = 1; $i <= 31; $i++ )
				{
					$list[] = sprintf('%02d', $i);
				}
				break;
			case 'm':
				$list = empty($data['options.specials']) ? array(0 => '---------------') : $data['options.specials'];
				$list += array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
				break;
			case 'y':
				$floor_year = empty($data['options.floor']) ? 0 : date('Y', $data['options.floor']);
				if ( $floor_year < 1971 )
				{
					$floor_year = 1971;
				}
				$list = array(0 => '----');
				for ($i = $floor_year; $i < 2038; $i++ )
				{
					$list[$i] = $i;
				}
				break;
		}
		return $list;
	}

	function get_value($value)
	{
		global $user;

		// limit value
		if ( $value < 0 )
		{
			$value = -1;
		}

		// we retrieve there a user timestamp
		$year = $this->fields['y']->value;
		$month = $this->fields['m']->value;
		$day = $this->fields['d']->value;

		// check for special values and timestamp doable
		if ( $month < 0 )
		{
			$res = -1;
			$this->force_value($res);
			return $res;
		}
		if ( ($year <= 1971) || ($year > 2037) || ($month == 0) || ($day == 0) )
		{
			$res = 0;
			$this->force_value($res);
			return $res;
		}
		// get the date
		if ( $this->data['options.end_date'] )
		{
			$res = mktime(0, 0, 0, $month, $day + 1, $year) - 1;
		}
		else
		{
			$res = mktime(0, 0, 0, $month, $day, $year);
		}

		// apply the floor asked
		if ( !empty($this->data['options.floor']) && ($res < intval($this->data['options.floor'])) )
		{
			$res = $this->data['options.floor'];
			$this->force_value($res);
			return $res;
		}

		// return the date converted into a sys timestamp
		return $res;
	}

	function check()
	{
		global $error, $error_msg;
		global $user;

		// do basic checks
		foreach ($this->order as $frag => $pos)
		{
			$this->fields[$frag]->check();
		}
		if ( !$error )
		{
			// retrieve date field
			$year = $this->fields['y']->value;
			$month = $this->fields['m']->value;
			$day = $this->fields['d']->value;
			if ( $month < 0 )
			{
				$month = 0;
			}
			// date forever or never correct ?
			if ( ($year * $month * $day == 0) && ($year + $month + $day != 0) )
			{
				_error($user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('Date_not_valid'));
			}
			// check if it is a date
			else if ( !empty($year) && !checkdate($month, $day, $year) )
			{
				_error($user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('Date_not_valid'));
			}
		}
	}

	function display()
	{
		global $user;

		if ( $this->data['output'] )
		{
			$this->type = 'varchar';
			$sav_value = $this->value;
			$this->value = $user->date($this->value);
			parent::display();
			$this->type = $this->data['type'];
			$this->value = $sav_value;
		}
		else
		{
			foreach ($this->fields as $field_name => $field)
			{
				$field->display();
			}
		}
	}
}

class field_timestamp extends field
{
	var $fields;
	var $order;
	var $h_fmt;

	// value is in user format
	function field_timestamp($name, $data)
	{
		global $config, $user;

		if ( !$data['output'] )
		{
			$this->order['y'] = strpos(' ' . strtolower($user->data['user_dateformat']), 'y')-1;
			$this->order['m'] = (strpos(' ' . strtolower($user->data['user_dateformat']), 'm')-1 >= 0) ? strpos(' ' . strtolower($user->data['user_dateformat']), 'm')-1 : strpos(' ' . $user->data['user_dateformat'], 'n')-1;
			$this->order['d'] = (strpos(' ' . $user->data['user_dateformat'], 'd')-1 >= 0) ? strpos(' ' . $user->data['user_dateformat'], 'd')-1 : strpos(' ' . $user->data['user_dateformat'], 'j')-1;
			asort($this->order);
			$this->order = array_flip(array_keys($this->order + array_flip(array('h', 'i'))));

			// get hour fmt
			$this->h_fmt = 'H';
			if ( strpos(' ' . $user->data['user_dateformat'], 'a') )
			{
				$this->h_fmt = 'h a';
			}
			else if ( strpos(' ' . $user->data['user_dateformat'], 'A') )
			{
				$this->h_fmt = 'h A';
			}

			// declare the fields
			foreach ($this->order as $frag => $pos)
			{
				$others = array_flip(array('Y', 'M', 'D', 'H', 'I'));
				unset($others[strtoupper($frag)]);
				$others = array_keys($others);
				$sub_data = $data;
				$sub_data['combined'] = $pos ? true : $sub_data['combined'];
				$sub_data['type'] = 'list';
				$sub_data['legend'] = $pos ? '' : $data['legend'];
				$sub_data['explain'] = $pos ? '' : $data['explain'];
				$sub_data['value'] = $this->get_orig_value($frag, $data);
				$sub_data['options'] = $this->get_list($frag, $data);
				$sub_data['html'] = 'onChange="if (this.options[selectedIndex].value < ' . (in_array($frag, array('h', 'i')) ? '0' : '1') . ') {';
				for ( $i = 0; $i < 4; $i++ )
				{
					if ( in_array($others[$i], array('H', 'I')) )
					{
						$sub_data['html'] .= 'this.form.' . $name . '_' . $others[$i] . '.value = -1; ';
					}
					else
					{
						$sub_data['html'] .= 'this.form.' . $name . '_' . $others[$i] . '.value = 0; ';
					}
				}
				$sub_data['html'] .= '};"';
				$sub_data['options.no_translate'] = in_array(strtolower($frag), array('d', 'h', 'i'));
				$sub_data['post_value'] = ($pos == 2) ? '&nbsp;' : (($pos == 3) ? 'hh' : (($pos == 4) ? 'mm' : ''));
				$this->fields[$frag] = new field_list($name . '_' . strtoupper($frag), $sub_data);
			}

			// add javascript links
			$hour = $data['options.end_date'] ? 23 : 0;
			$minute = $data['options.end_date'] ? 59 : 0;
			$second = $data['options.end_date'] ? 59 : 0;
			$now = $user->cvt_sys_to_user_date(time());
			$today = mktime($hour, $minute, $second, date('m', $now), date('d', $now), date('Y', $now));
			$one_week = mktime($hour, $minute, $second, date('m', $now), date('d', $now)+7, date('Y', $now));
			$one_month = mktime($hour, $minute, $second, date('m', $now)+1, date('d', $now), date('Y', $now));
			$fields = array(
				$name . '_today' => array('type' => 'mini_link', 'legend' => 'Today', 'value' => '#', 'combined' => true, 'linefeed' => true, 'post_value' => ' :: ', 'html' => ' onClick="document.post.' . $name . '_D.value = ' . date('d', $today) . '; document.post.' . $name . '_M.value = ' . date('m', $today) . '; document.post.' . $name . '_Y.value = ' . date('Y', $today) . '; document.post.' . $name . '_H.value = ' . date('H', $today) . '; document.post.' . $name . '_I.value = ' . date('i', $today) . ';"'),
				$name . '_one_week' => array('type' => 'mini_link', 'legend' => '7_Days', 'value' => '#', 'combined' => true, 'post_value' => ' :: ', 'html' => ' onClick="document.post.' . $name . '_D.value = ' . date('d', $one_week) . '; document.post.' . $name . '_M.value = ' . date('m', $one_week) . '; document.post.' . $name . '_Y.value = ' . date('Y', $one_week) . '; document.post.' . $name . '_H.value = ' . date('H', $one_week) . '; document.post.' . $name . '_I.value = ' . date('i', $one_week) . ';"'),
				$name . '_one_month' => array('type' => 'mini_link', 'legend' => '1_Month', 'value' => '#', 'combined' => true, 'html' => ' onClick="document.post.' . $name . '_D.value = ' . date('d', $one_month) . '; document.post.' . $name . '_M.value = ' . date('m', $one_month) . '; document.post.' . $name . '_Y.value = ' . date('Y', $one_month) . '; document.post.' . $name . '_H.value = ' . date('H', $one_month) . '; document.post.' . $name . '_I.value = ' . date('i', $one_month) . ';"'),
			);
			foreach ( $fields as $field_name => $field )
			{
				$this->fields[$field_name] = new field_mini_link($field_name, $field);
			}
		}
		parent::field($name, $data);
	}

	function force_value($value)
	{
		if ( $this->data['output'] )
		{
			$this->value = $value;
		}
		else
		{
			$this->value = $value;
			$data = $this->data;
			$data['value'] = $this->value;
			foreach ($this->order as $frag => $pos)
			{
				$this->fields[$frag]->value = $this->get_orig_value($frag, $data);
			}
		}
	}

	function get_orig_value($frag, &$data)
	{
		$res = 0;
		$value = $data['value'];
		if ( $value < 0 )
		{
			return in_array($frag, array('h', 'i')) ? -1 : 0;
		}
		if ( !empty($value) )
		{
			switch ( $frag )
			{
				case 'y':
					$res = intval(date('Y', $value));
					break;
				case 'm':
					$res = intval(date('m', $value));
					break;
				case 'd':
					$res = intval(date('d', $value));
					break;
				case 'h':
					$res = intval(date('H', $value));
					break;
				case 'i':
					$res = intval(date('i', $value));
					break;
			}
		}
		return $res;
	}

	function get_list($frag, &$data)
	{
		global $config;
		$list = array();
		switch ($frag)
		{
			case 'h':
				// take an arbitrary date
				$date = mktime(0, 0, 0, 01, 01, 2005);
				$list = array(-1 => '--');
				for ( $i = 0; $i <= 23; $i++ )
				{
					$list[$i] = date($this->h_fmt, $date);
					$date += 3600;
				}
				break;
			case 'i':
				$list = array(-1 => '--');
				for ( $i = 0; $i <= 59; $i++ )
				{
					$list[$i] = sprintf('%02d', $i);
				}
				break;
			case 'd':
				$list = array(0 => '--');
				for ( $i = 1; $i <= 31; $i++ )
				{
					$list[$i] = sprintf('%02d', $i);
				}
				break;
			case 'm':
				$list = empty($data['options.specials']) ? array(0 => '---------------') : $data['options.specials'];
				$list += array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
				break;
			case 'y':
				$floor_year = empty($data['options.floor']) ? 0 : date('Y', $data['options.floor']);
				if ( $floor_year < 1971 )
				{
					$floor_year = 1971;
				}
				$list = array(0 => '----');
				for ($i = $floor_year; $i < 2038; $i++ )
				{
					$list[$i] = $i;
				}
				break;
		}
		return $list;
	}

	function get_value($value)
	{
		global $user;

		// limit value
		if ( $value < 0 )
		{
			$value = -1;
		}

		// we retrieve there a user timestamp
		$year = $this->fields['y']->value;
		$month = $this->fields['m']->value;
		$day = $this->fields['d']->value;
		$hour = $this->fields['h']->value;
		$minute = $this->fields['i']->value;

		// check for special values and timestamp doable
		if ( $hour < 0 )
		{
			$hour = -1;
		}
		if ( $minute < 0 )
		{
			$minute = -1;
		}
		if ( ($year <= 1971) || ($year > 2037) || ($month == 0) || ($day == 0) )
		{
			$res = -1;
			$this->force_value($res);
			return $res;
		}
		// get the date converted into a sys timestamp
		if ( $this->data['options.end_date'] )
		{
			if ( ($hour < 0) || ($minute < 0) )
			{
				$res = mktime(0, 0, 0, $month, $day + 1, $year) - 1;
			}
			else
			{
				$res = mktime($hour, $minute, 59, $month, $day, $year);
			}
		}
		else
		{
			if ( ($hour < 0) || ($minute < 0) )
			{
				$res = mktime(0, 0, 0, $month, $day, $year);
			}
			else
			{
				$res = mktime($hour, $minute, 0, $month, $day, $year);
			}
		}

		// apply the floor asked
		if ( !empty($this->data['options.floor']) && ($res < intval($this->data['options.floor'])) )
		{
			$res = $this->data['options.floor'];
			$this->force_value($res);
			return $res;
		}

		return $res;
	}

	function check()
	{
		global $error, $error_msg;
		global $user;

		// do basic checks
		foreach ($this->order as $frag => $pos)
		{
			$this->fields[$frag]->check();
		}
		if ( !$error )
		{
			// retrieve date field
			$year = $this->fields['y']->value;
			$month = $this->fields['m']->value;
			$day = $this->fields['d']->value;
			$hour = $this->fields['h']->value;
			$minute = $this->fields['i']->value;
			if ( $hour < 0 )
			{
				$hour = 0;
			}
			if ( $minute < 0 )
			{
				$minute = 0;
			}

			// date forever or never correct ?
			if ( ($year * $month * $day == 0) && ($year + $month + $day != 0) )
			{
				_error($user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('Date_not_valid'));
			}
			// check if it is a date
			else if ( !empty($year) && (!checkdate($month, $day, $year) || ($hour < 0) || ($hour > 23) || ($minute < 0) || ($minute > 59)) )
			{
				_error($user->lang(empty($this->data['legend']) ? $this->name : $this->data['legend']) . ': ' . $user->lang('Date_not_valid'));
			}
		}
	}

	function display()
	{
		global $user;

		if ( $this->data['output'] )
		{
			$this->type = 'varchar';
			$sav_value = $this->value;
			$this->value = empty($this->value) ? 0 : $user->date($this->value);
			parent::display();
			$this->type = $this->data['type'];
			$this->value = $sav_value;
		}
		else
		{
			foreach ($this->fields as $field_name => $field)
			{
				$field->display();
			}
		}
	}
}

?>