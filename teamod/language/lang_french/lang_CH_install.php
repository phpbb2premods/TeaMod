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
	'SQL_error' => '<b><u>La requête SQL ne s\'est pas terminée correctement:</u></b><ul><li><b>motif:</b> %s<li><b>fichier:</b> %s, <b>ligne:</b> %s<li><b>requête:</b><hr /> %s<hr /></ul>',
	'Login_required' => 'Vous devez vous connecter',
	'Login_title' => 'Connexion',
	'Login_failed' => 'La connexion a échoué. Vérifiez le nom d\'utilisateur et le mot de passe que vous avez entré, puis recommencez.',
	'Login_username' => 'Nom d\'utilisateur',
	'Login_password' => 'Mot de passe',
	'Login_submit' => 'Connexion',
	'Login_admin' => 'Vous devez être administrateur pour continuer.',
	'Login_mod' => 'Vous devez être administrateur ou modérateur pour continuer.',
	'Error_resume_explain' => 'Ce sont seulement des avertissements : Cliquez sur "Poursuivre" pour continuer :',
	'Error_resume' => 'Poursuivre',

// shared with groups repair tool
	// founder
	'CH_choose_founder' => 'Veuillez choisir qui sera le fondateur',
	'CH_founder' => 'Fondateur',
	'CH_select' => 'Sélectionner',
	'CH_founder_is' => 'Le fondateur est %d : %s',

	// system groups
	'CH_anonymous_user_created' => 'L\'utilisateur anonyme était manquant, il a été créé.',
	'CH_orphean_groups_deleted' => '%d groupes individuels orphelins ont été supprimés.',
	'CH_individual_groups_surnumerous_percent' => 'La suppression des groupes individuels en surnombre est en cours : %d de %d',
	'CH_individual_groups_surnumerous' => 'Des groupes individuels en surnombre pour %d utilisateurs ont été supprimés.',
	'CH_individual_groups_percent' => 'La création des groupes individuels manquants est en cours : %d de %d',
	'CH_individual_groups_created' => '%d groupes individuels manquants ont été créés.',
	'CH_surnumerous_membership_percent' => 'La suppression des liens utilisateurs/groupes individuels en surnombre est en cours : %d de %d',
	'CH_surnumerous_membership' => '%d liens utilisateurs/groupes individuels en surnombre ont été supprimés.',

	'CH_system_groups_done' => 'Les groupes système ont été contrôlés.',
	'CH_user_groups_percent' => 'Le contrôle des liens utilisateurs/groupes individuels est en cours : %d of %d',
	'CH_user_groups_created' => '%d groupes individuels ont été attachés aux utilisateurs. Les adhésions ont été enregistrées pour les groupes individuels.',

	// welcome page
	'CH_start' => 'Cliquez sur "Démarrer" pour lancer la migration',
	'CH_proceed' => 'Démarrer',

// categories hierarchy install
	'Script_title' => 'Utilitaire de migration de Categories Hierarchy %s',

	// welcome page
	'CH_welcome' => 'Bienvenue dans l\'utilitaire de migration de Categories hierarchy %s',
	'CH_welcome_explain' => 'Cet utilitaire est conçu pour ajouter les nouveaux champs nécessaires au fonctionnement du module. Il créera également quelques nouvelles entrées dans la configuration, vous pourrez y accéder à l\'aide de votre Panneau d\'Administration/Configuration +. Les entrées de cette configuration vous permettront d\'activer ou de désactiver un certain nombre de nouvelles fonctionnalités, n\'hésitez pas à les consulter une fois la migration terminée :).',

	// version
	'CH_previous_version' => 'La version %s de Categories Hierarchy a été détectée.',

	// database structure
	'CH_dbstruct_done' => 'La structure de la base de données a été modifiée.',
	'CH_dbstruct_upgraded' => 'La structure de la base de données a été mise à jour.',
	'CH_sql_already_done' => 'La requête SQL a échoué (peut-être déjà réalisée) : %s',

	// upgrade data
	'CH_guests_preset_added' => 'Le préréglage "Lit, écrit et vote" pour les invités a été ajouté.',

	// cache checking
	'CH_caches_not_available' => 'Le dossier cache/ n\'existe pas, les fichiers des caches ne peuvent pas être enregistrés. Les processus des caches ont été désactivés.',
	'CH_caches_available' => 'Le dossier cache/ existe, les fichiers des caches peuvent être enregistrés. Les processus des caches ont été activés.',

	// db population
	'CH_db_config_done' => 'La table config a été reconstruite.',
	'CH_db_presets_done' => 'La table des préréglages des autorisations a été reconstruite.',
	'CH_db_topic_icons_done' => 'La table des icônes de sujets a été reconstruite.',
	'CH_db_topics_attribute_done' => 'Les attributs de sujets ont été ajoutés.',
	'CH_db_categories_done' => 'La table des catégories a été déplacée dans la table des forums.',
	'CH_db_topics_percent_sync' => 'La synchronisation des sujets est en cours : %d de %d',
	'CH_db_topics_sync' => '%d sujets ont été synchronisés.',
	'CH_db_forums_sync' => '%d forums ont été synchronisés.',
	'CH_db_users_sync' => '%d utilisateurs ont été synchronisés.',

	// auths, panels
	'CH_panels_patched' => 'Les panneaux ont été mis à jour.',
	'CH_panels_auths_def_added' => 'Les définitions des autorisations des panneaux et des champs ont été importées.',
	'CH_forum_auths_def_added' => 'Les définitions des autorisations du forum ont été importées.',
	'CH_forum_auths_values_added' => 'Les configurations des autorisations du forum ont été importées.',

	// templates
	'CH_ptifo_default' => 'Le template Ptifo a été configuré comme thème par défaut.',
	'CH_ptifo_installed' => 'Le template Ptifo a été installé et configuré comme thème par défaut.',

	// critical errors
	'CH_no_founder' => '<b><u>/!\</u> Personne ne peut être fondateur. Ceci est une erreur grave, rapportez svp. <u>/!\</u></b>',
	'CH_db_not_supported' => '<b><u>/!\</u> La base de données utilisée n\'est pas supportée par Categories Hierarchy. <u>/!\</u></b>',
	'CH_anonymous_group_missing' => '<b><u>/!\</u> Malgré une tentative de création, le groupe individuel Anonymous est toujours manquant. Ceci est une erreur grave, rapportez svp. <u>/!\</u></b>',

	// end messages
	'CH_install_upgraded' => 'Votre installation de Categories Hierarchy a été mise à jour dans sa dernière version.<br /><br />Veuillez supprimer le dossier install_cat/.',
	'CH_install_done' => 'L\'installation de Categories Hierarchy est maintenant complète.<br /><br />Veuillez supprimer le dossier install_cat/.',
	'CH_return_to_board' => '<br />Nous vous remercions d\'avoir choisi Categories Hierarchy,<br /><a href="http://ptifo.clanmckeen.com" target="_blank">Ptirhiik</a> et <a href="http://ggweb-fr.com" target="_blank">Gilgraf</a><hr />Cliquez <a href="../">ici</a> pour retourner à l\'Index du forum.<hr />',
);

?>