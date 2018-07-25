<?php
/***************************************************************************
 *							acp_generic.php
 *							---------------
 *	begin		: 08/10/2004
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	Version		: 0.0.2 - 21/08/2005
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
	die('Hack attempt');
}

// no fields in form : end there
if ( empty($fields) )
{
	// send "no options" with left side menus
	$cp_panels->display_empty();
	return;
}

class config_auto_form extends auto_form
{
	function update_table(&$fields)
	{
		global $config;

		$config->begin_transaction();
		foreach ( $fields as $name => $value )
		{
			$config->set($name, $value);
		}
		$config->end_transaction();

		// recache forums
		include_once($config->url('includes/class_forums'));
		$forums = new forums();
		$forums->read(true);

		// send achievement message
		message_return('Config_updated', $this->return_msg, $config->url($this->requester, $this->return_parms, true));
	}
}

// instantiate the form
$form = new config_auto_form($config->data, $fields, $cp_requester, 'Click_return_' . $subm_id, $cp_parms + (($menu_id == $subm_id) ? array('mode' => $menu_id) : array('mode' => $menu_id, 'sub' => $subm_id)));
$form->process();
$template->set_filenames(array('body' => 'cp_generic.tpl'));

?>