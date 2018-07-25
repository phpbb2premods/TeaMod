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
$lang['Calendar_event'] = 'Evénement du calendrier';
$lang['Calendar_event_explain'] = 'Si vous ne voulez pas que ce sujet soit un événement du calendrier, laissez les dates égales à --- .';
$lang['Calendar_time'] = 'Début de l\'événement du calendrier le';
$lang['Calendar_stop'] = 'Fin de l\'événement du calendrier le';
$lang['Calendar_date_not_valid'] = 'La date entrée pour l\'événement du calendrier ne définie pas une durée.';
$lang['Calendar_single_date'] = 'Démarrage de l\'événement %s pour un jour';
$lang['Calendar_from_to'] = 'Evénement du %s au %s';

$lang['auth_calendar'] = 'Créer de nouveaux événements dans le calendrier';
$lang['Rules_calendar_can'] = 'Vous <b>pouvez</b> poster des événements du calendrier dans ce forum';
$lang['Rules_calendar_cannot'] = 'Vous <b>ne pouvez pas</b> poster des événements du calendrier dans ce forum';
$lang['Click_return_calendar'] = 'Cliquez %sici%s pour retourner au paramétrage du calendrier';

$lang['Calendar_settings'] = 'Paramétrage du Calendrier';
$lang['Calendar_week_start'] = 'Premier jour de la semaine';
$lang['Calendar_header_cells'] = 'Nombre de jours à afficher sur l\'entête du forum (0 pour ne rien afficher)';
$lang['Calendar_title_length'] = 'Longueur des titres affichés dans les cases du calendrier';
$lang['Calendar_text_length'] = 'Longueur du texte affiché dans la fenêtre volante';
$lang['Calendar_display_open'] = 'Afficher le calendrier ouvert sur l\'entête du forum';
$lang['Calendar_overview'] = 'Afficher le texte du sujet sur l\'entête du forum';
$lang['Calendar_nb_row'] = 'Nombre maximal d\'événements par jour affichés sur l\'entête du forum';
$lang['Calendar_use_java'] = 'Utiliser les routines Java pour afficher le calendrier';

$lang['Calendar_all_events'] = 'Tous les événements';

?>