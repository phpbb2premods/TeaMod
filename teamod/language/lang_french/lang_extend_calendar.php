<?php
/***************************************************************************
 *						lang_extend_calendar.php [French]
 *						------------------------
 *	begin				: 10/12/2004
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.2 - 29/03/2005
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
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_calendar'] = 'Topic Calendar';
}

$lang['Calendar'] = 'Calendrier';
$lang['Calendar_scheduler'] = 'Agenda';
$lang['Calendar_event'] = 'Ev�nement du calendrier';
$lang['Calendar_event_explain'] = 'Si vous ne voulez pas que ce sujet soit un �v�nement du calendrier, laissez les dates �gales � --- .';
$lang['Calendar_time'] = 'D�but de l\'�v�nement du calendrier le';
$lang['Calendar_stop'] = 'Fin de l\'�v�nement du calendrier le';
$lang['Calendar_date_not_valid'] = 'La date entr�e pour l\'�v�nement du calendrier ne d�finie pas une dur�e.';
$lang['Calendar_single_date'] = 'D�marrage de l\'�v�nement %s pour un jour';
$lang['Calendar_from_to'] = 'Ev�nement du %s au %s';

$lang['auth_calendar'] = 'Cr�er de nouveaux �v�nements dans le calendrier';
$lang['Rules_calendar_can'] = 'Vous <b>pouvez</b> poster des �v�nements du calendrier dans ce forum';
$lang['Rules_calendar_cannot'] = 'Vous <b>ne pouvez pas</b> poster des �v�nements du calendrier dans ce forum';
$lang['Click_return_calendar'] = 'Cliquez %sici%s pour retourner au param�trage du calendrier';

$lang['Calendar_settings'] = 'Param�trage du Calendrier';
$lang['Calendar_week_start'] = 'Premier jour de la semaine';
$lang['Calendar_header_cells'] = 'Nombre de jours � afficher sur l\'ent�te du forum (0 pour ne rien afficher)';
$lang['Calendar_title_length'] = 'Longueur des titres affich�s dans les cases du calendrier';
$lang['Calendar_text_length'] = 'Longueur du texte affich� dans la fen�tre volante';
$lang['Calendar_display_open'] = 'Afficher le calendrier ouvert sur l\'ent�te du forum';
$lang['Calendar_overview'] = 'Afficher le texte du sujet sur l\'ent�te du forum';
$lang['Calendar_nb_row'] = 'Nombre maximal d\'�v�nements par jour affich�s sur l\'ent�te du forum';
$lang['Calendar_use_java'] = 'Utiliser les routines Java pour afficher le calendrier';

$lang['Calendar_all_events'] = 'Tous les �v�nements';

?>