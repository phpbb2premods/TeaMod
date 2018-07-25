<?php
/***************************************************************************
 *						lang_extend_recent_posts_active.php [French]
 *						-----------------------------------
 *	begin				: 29/10/2005
 *	copyright			: LuTzKiLLeR
 *	email				: lutzkiller@gmail.com.com
 *
 *	version				: 1.0.0 - 29/10/2005
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
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_recent_posts_active'] = 'Add-on disable Recent posts mod via ACP';

	$lang['recent_posts_active'] = 'Activer l\'affichage des 5 derniers messages';
	$lang['recent_posts_active_explain'] = 'Ceci permet d\'activer ou non l\'affichage des 5 derniers messages sur l\'index du forum.';
}

?>