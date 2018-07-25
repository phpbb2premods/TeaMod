<?php
/***************************************************************************
 *						lang_CH_install.php [French]
 *						----------------------------
 *	begin				: 31/08/2005
 *	copyright			: Ptirhiik & Gilgraf (GGWeb-fr.com)
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.1 - 31/08/2005
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
	'SQL_error' => '<b><u>La requ�te SQL ne s\'est pas termin�e correctement:</u></b><ul><li><b>motif:</b> %s<li><b>fichier:</b> %s, <b>ligne:</b> %s<li><b>requ�te:</b><hr /> %s<hr /></ul>',
	'Login_required' => 'Vous devez vous connecter',
	'Login_title' => 'Connexion',
	'Login_failed' => 'La connexion a �chou�. V�rifiez le nom d\'utilisateur et le mot de passe que vous avez entr�, puis recommencez.',
	'Login_username' => 'Nom d\'utilisateur',
	'Login_password' => 'Mot de passe',
	'Login_submit' => 'Connexion',
	'Login_admin' => 'Vous devez �tre administrateur pour continuer.',
	'Login_mod' => 'Vous devez �tre administrateur ou mod�rateur pour continuer.',
	'Error_resume_explain' => 'Ce sont seulement des avertissements : Cliquez sur "Poursuivre" pour continuer :',
	'Error_resume' => 'Poursuivre',

// shared with groups repair tool
	// founder
	'CH_choose_founder' => 'Veuillez choisir qui sera le fondateur',
	'CH_founder' => 'Fondateur',
	'CH_select' => 'S�lectionner',
	'CH_founder_is' => 'Le fondateur est %d : %s',

	// system groups
	'CH_anonymous_user_created' => 'L\'utilisateur anonyme �tait manquant, il a �t� cr��.',
	'CH_orphean_groups_deleted' => '%d groupes individuels orphelins ont �t� supprim�s.',
	'CH_individual_groups_surnumerous_percent' => 'La suppression des groupes individuels en surnombre est en cours : %d de %d',
	'CH_individual_groups_surnumerous' => 'Des groupes individuels en surnombre pour %d utilisateurs ont �t� supprim�s.',
	'CH_individual_groups_percent' => 'La cr�ation des groupes individuels manquants est en cours : %d de %d',
	'CH_individual_groups_created' => '%d groupes individuels manquants ont �t� cr��s.',
	'CH_surnumerous_membership_percent' => 'La suppression des liens utilisateurs/groupes individuels en surnombre est en cours : %d de %d',
	'CH_surnumerous_membership' => '%d liens utilisateurs/groupes individuels en surnombre ont �t� supprim�s.',

	'CH_system_groups_done' => 'Les groupes syst�me ont �t� contr�l�s.',
	'CH_user_groups_percent' => 'Le contr�le des liens utilisateurs/groupes individuels est en cours : %d of %d',
	'CH_user_groups_created' => '%d groupes individuels ont �t� attach�s aux utilisateurs. Les adh�sions ont �t� enregistr�es pour les groupes individuels.',

	// welcome page
	'CH_start' => 'Cliquez sur "D�marrer" pour lancer la migration',
	'CH_proceed' => 'D�marrer',

// categories hierarchy install
	'Script_title' => 'Utilitaire de migration de Categories Hierarchy %s',

	// welcome page
	'CH_welcome' => 'Bienvenue dans l\'utilitaire de migration de Categories hierarchy %s',
	'CH_welcome_explain' => 'Cet utilitaire est con�u pour ajouter les nouveaux champs n�cessaires au fonctionnement du module. Il cr�era �galement quelques nouvelles entr�es dans la configuration, vous pourrez y acc�der � l\'aide de votre Panneau d\'Administration/Configuration +. Les entr�es de cette configuration vous permettront d\'activer ou de d�sactiver un certain nombre de nouvelles fonctionnalit�s, n\'h�sitez pas � les consulter une fois la migration termin�e :).',

	// version
	'CH_previous_version' => 'La version %s de Categories Hierarchy a �t� d�tect�e.',

	// database structure
	'CH_dbstruct_done' => 'La structure de la base de donn�es a �t� modifi�e.',
	'CH_dbstruct_upgraded' => 'La structure de la base de donn�es a �t� mise � jour.',
	'CH_sql_already_done' => 'La requ�te SQL a �chou� (peut-�tre d�j� r�alis�e) : %s',

	// upgrade data
	'CH_guests_preset_added' => 'Le pr�r�glage "Lit, �crit et vote" pour les invit�s a �t� ajout�.',

	// cache checking
	'CH_caches_not_available' => 'Le dossier cache/ n\'existe pas, les fichiers des caches ne peuvent pas �tre enregistr�s. Les processus des caches ont �t� d�sactiv�s.',
	'CH_caches_available' => 'Le dossier cache/ existe, les fichiers des caches peuvent �tre enregistr�s. Les processus des caches ont �t� activ�s.',

	// db population
	'CH_db_config_done' => 'La table config a �t� reconstruite.',
	'CH_db_presets_done' => 'La table des pr�r�glages des autorisations a �t� reconstruite.',
	'CH_db_topic_icons_done' => 'La table des ic�nes de sujets a �t� reconstruite.',
	'CH_db_topics_attribute_done' => 'Les attributs de sujets ont �t� ajout�s.',
	'CH_db_categories_done' => 'La table des cat�gories a �t� d�plac�e dans la table des forums.',
	'CH_db_topics_percent_sync' => 'La synchronisation des sujets est en cours : %d de %d',
	'CH_db_topics_sync' => '%d sujets ont �t� synchronis�s.',
	'CH_db_forums_sync' => '%d forums ont �t� synchronis�s.',
	'CH_db_users_sync' => '%d utilisateurs ont �t� synchronis�s.',

	// auths, panels
	'CH_panels_patched' => 'Les panneaux ont �t� mis � jour.',
	'CH_panels_auths_def_added' => 'Les d�finitions des autorisations des panneaux et des champs ont �t� import�es.',
	'CH_forum_auths_def_added' => 'Les d�finitions des autorisations du forum ont �t� import�es.',
	'CH_forum_auths_values_added' => 'Les configurations des autorisations du forum ont �t� import�es.',

	// templates
	'CH_ptifo_default' => 'Le template Ptifo a �t� configur� comme th�me par d�faut.',
	'CH_ptifo_installed' => 'Le template Ptifo a �t� install� et configur� comme th�me par d�faut.',

	// critical errors
	'CH_no_founder' => '<b><u>/!\</u> Personne ne peut �tre fondateur. Ceci est une erreur grave, rapportez svp. <u>/!\</u></b>',
	'CH_db_not_supported' => '<b><u>/!\</u> La base de donn�es utilis�e n\'est pas support�e par Categories Hierarchy. <u>/!\</u></b>',
	'CH_anonymous_group_missing' => '<b><u>/!\</u> Malgr� une tentative de cr�ation, le groupe individuel Anonymous est toujours manquant. Ceci est une erreur grave, rapportez svp. <u>/!\</u></b>',

	// end messages
	'CH_install_upgraded' => 'Votre installation de Categories Hierarchy a �t� mise � jour dans sa derni�re version.<br /><br />Veuillez supprimer le dossier install_cat/.',
	'CH_install_done' => 'L\'installation de Categories Hierarchy est maintenant compl�te.<br /><br />Veuillez supprimer le dossier install_cat/.',
	'CH_return_to_board' => '<br />Nous vous remercions d\'avoir choisi Categories Hierarchy,<br /><a href="http://ptifo.clanmckeen.com" target="_blank">Ptirhiik</a> et <a href="http://ggweb-fr.com" target="_blank">Gilgraf</a><hr />Cliquez <a href="../">ici</a> pour retourner � l\'Index du forum.<hr />',
);

?>