<?php
/***************************************************************************
 *						lang_CH_install.php [English]
 *						-----------------------------
 *	begin				: 15/08/2005
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.1 - 21/08/2005
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
	die('Hacking attempt');
}

$lang = array(
//system
	'SQL_error' => '<b><u>SQL request not achieved:</u></b><ul><li><b>reason:</b> %s<li><b>file:</b> %s, <b>line:</b> %s<li><b>request:</b><hr /> %s<hr /></ul>',
	'Login_required' => 'You must log in',
	'Login_title' => 'Login',
	'Login_failed' => 'Login failed. Check the username and the password you\'ve typed in, then retry.',
	'Login_username' => 'Username',
	'Login_password' => 'Password',
	'Login_submit' => 'Log me in',
	'Login_admin' => 'You must be an administrator to go further.',
	'Login_mod' => 'You must be an administrator or a moderator to go further.',
	'Error_resume_explain' => 'These are warnings only : press "Resume" to continue :',
	'Error_resume' => 'Resume',

// shared with groups repair tool
	// founder
	'CH_choose_founder' => 'Please choose who will be the founder',
	'CH_founder' => 'Founder',
	'CH_select' => 'Select',
	'CH_founder_is' => 'The founder is %d : %s',

	// system groups
	'CH_anonymous_user_created' => 'The anonymous user was missing and so had been created.',
	'CH_orphean_groups_deleted' => '%d orphan individual groups have been deleted.',
	'CH_individual_groups_surnumerous_percent' => 'Cleaning surnumerous individual groups in progress : %d of %d',
	'CH_individual_groups_surnumerous' => 'Surnumerous individual groups for %d users have been removed.',
	'CH_individual_groups_percent' => 'Missing individual groups creation in progress : %d of %d',
	'CH_individual_groups_created' => '%d missing individual groups have been created.',
	'CH_surnumerous_membership_percent' => 'Cleaning surnumerous groups links in progress : %d of %d',
	'CH_surnumerous_membership' => '%d surnumerous groups link have been removed.',

	'CH_system_groups_done' => 'The system groups have been processed.',
	'CH_user_groups_percent' => 'Link individual groups to users in progress : %d of %d',
	'CH_user_groups_created' => '%d individual groups have been linked to users, and their membership has been registered to their individual group.',

	// welcome page
	'CH_start' => 'Click "Proceed" to start',
	'CH_proceed' => 'Proceed',

// categories hierarchy install
	'Script_title' => 'Categories Hierarchy %s migration tool',

	// welcome page
	'CH_welcome' => 'Welcome to the Categories hierarchy %s migration tool.',
	'CH_welcome_explain' => 'This tool is designed to fill the new fields added by the mod. It will create some new config entries also, you will be able to access through your Administration Control Panel/Configuration +. This config entries are made to enable or disable a number of new functionalities, so be sure to visit it after having succeded in the migration :).',

	// version
	'CH_previous_version' => 'Categories Hierarchy version %s has been detected.',

	// database structure
	'CH_dbstruct_done' => 'The database structure has been modified.',
	'CH_dbstruct_upgraded' => 'The database structure has been upgraded.',
	'CH_sql_already_done' => 'SQL request failed (maybe already done) : %s',

	// upgrade data
	'CH_guests_preset_added' => '"Guests posting" preset has been added.',

	// cache checking
	'CH_caches_not_available' => 'The cache/ directory is not available to store caches. Caches processes are so disabled.',
	'CH_caches_available' => 'The cache/ directory is available to store caches. Caches processes are so enabled.',

	// db population
	'CH_db_config_done' => 'Config table has been populated.',
	'CH_db_presets_done' => 'The authorisations presets table has been populated.',
	'CH_db_topic_icons_done' => 'The topic icons table has been populated.',
	'CH_db_topics_attribute_done' => 'Topics attributes have been added.',
	'CH_db_categories_done' => 'Categories table has been moved to forums table.',
	'CH_db_topics_percent_sync' => 'Topics synchronisation in progress : %d of %d',
	'CH_db_topics_sync' => '%d topics have been synchronised.',
	'CH_db_forums_sync' => '%d forums have been synchronised.',
	'CH_db_users_sync' => '%d users have been synchronised.',

	// auths, panels
	'CH_panels_patched' => 'The panels have been patched.',
	'CH_panels_auths_def_added' => 'Authorisation definitions from panels and fields have been imported.',
	'CH_forum_auths_def_added' => 'Forum authorisation definitions have been imported.',
	'CH_forum_auths_values_added' => 'Forum authorisation settings have been imported.',

	// templates
	'CH_ptifo_default' => 'Ptifo template has been set as default style.',
	'CH_ptifo_installed' => 'Ptifo template has been installed and set as default style.',

	// critical errors
	'CH_no_founder' => '<b><u>/!\</u> Nobody can be the founder. This is a severe issue, please report. <u>/!\</u></b>',
	'CH_db_not_supported' => '<b><u>/!\</u> The database used is not supported by Categories Hierarchy. <u>/!\</u></b>',
	'CH_anonymous_group_missing' => '<b><u>/!\</u> Despite a creation attempt, the Anonymous individual group is still missing. This is a severe issue, please report. <u>/!\</u></b>',

	// end messages
	'CH_install_upgraded' => 'Your installation of Categories Hierarchy has been upgraded to its last version.<br /><br />Please delete the install_cat/ directory.',
	'CH_install_done' => 'The installation of Categories Hierarchy is now completed.<br /><br />Please delete the install_cat/ directory.',
	'CH_return_to_board' => '<br />Thanks for choosing Categories Hierarchy,<br /><a href="http://ptifo.clanmckeen.com" target="_blank">Ptirhiik</a> and <a href="http://ggweb-fr.com" target="_blank">Gilgraf</a><hr />Click <a href="../">Here</a> to return to Board index.<hr />',
);

?>