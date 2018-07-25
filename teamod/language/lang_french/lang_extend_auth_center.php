<?php
/***************************************************************************
 *						lang_extend_auth_center.php [French]
 *						------------------------------------
 *	begin				: 26/10/2004
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.8 - 21/08/2005
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

// group selection
$lang['Click_return_select_groups'] = 'Cliquez %sici%s pour retourner au choix des groupes.';
$lang['Select_groups'] = 'Choisissez un groupe ou un utilisateur';

// special groups
$lang['Group_own'] = 'Profil propre';
$lang['Group_own_desc'] = 'Utilisateur agissant sur son propre profil';

// system groups
$lang['Board_founder'] = 'Administrateurs principaux';
$lang['Board_founder_desc'] = 'Administrateurs principaux du forum';
$lang['Group_admin'] = 'Administrateurs';
$lang['Group_admin_desc'] = 'Utilisateurs administrant le forum';
$lang['Group_anonymous'] = 'Invités';
$lang['Group_anonymous_desc'] = 'Utilisateurs non enregistrés';
$lang['Group_registered'] = 'Membres';
$lang['Group_registered_desc'] = 'Utilisateurs enregistrés';
$lang['No_such_group'] = 'Ce groupe n\'existe pas';
$lang['Change_sysgroup_type_denied'] = 'Ce groupe doit avoir un statut au minimum clos.';
$lang['Manage_group_denied'] = 'Vous n\'êtes pas autorisé à modifier la définition de ce groupe.';

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_auth_center'] = 'Administration des permissions';

	// complementary for group management
	$lang['Board_founder_explain'] = 'Note : le groupe des Administrateurs principaux ne requièrent pas de permissions : il les a naturellement toutes.';
	$lang['Delete_sysgroup_denied'] = 'Vous ne pouvez pas supprimer un groupe système.';
	$lang['Change_sysgroup_denied'] = 'Vous ne pouvez pas modifier le statut système de ce groupe.';
	$lang['Unknown_group_sysstatus'] = 'Statut système inconnu.';
	$lang['System_group'] = 'Groupe système';

	// main panel name
	$lang['Panels_index'] = 'Index des panneaux';
	$lang['phpbb_acp'] = 'Panneau d\'administration de phpBB';

	// direct entry for the menu
	$lang['Auths_Center'] = 'Administration des permissions';
	$lang['Control_panels'] = 'Panneaux de contrôle';
	$lang['10_Permissions_manager'] = 'Permissions/Gestionnaires';
	$lang['11_Permissions_managed'] = 'Permissions/Objets gérés';

	// auth values
	$lang['Auth_not_authorised'] = ' -- ';
	$lang['Auth_authorised'] = 'Autorisé';
	$lang['Auth_denied'] = 'Interdit même si autorisé par ailleurs';
	$lang['Auth_forced'] = 'Autorisé même si interdit par ailleurs';

	// forums auths list
	$lang['auth_view'] = 'Voir le forum';
	$lang['auth_read'] = 'Lire les messages';
	$lang['auth_post'] = 'Créer de nouveaux sujets';
	$lang['auth_reply'] = 'Répondre à des sujets existants';
	$lang['auth_edit'] = 'Editer ses propres messages';
	$lang['auth_delete'] = 'Supprimer ses propres messages';
	$lang['auth_sticky'] = 'Créer des post-its';
	$lang['auth_announce'] = 'Créer des annonces';
	$lang['auth_global_announce'] = 'Créer des annonces générales';
	$lang['auth_vote'] = 'Voter';
	$lang['auth_pollcreate'] = 'Créer de nouveaux sondages';
	$lang['auth_mod'] = 'Editer et supprimer les messages autres que les siens (modérer)';
	$lang['auth_mod_display'] = 'Etre affiché comme modérateur du forum';
	$lang['auth_attachments'] = 'Joindre des fichiers';
	$lang['auth_download'] = 'Récupérer des fichiers joints';
	$lang['auth_manage'] = 'Administrer ce forum';

	// panels auths list
	$lang['Access'] = 'Accéder à ce panneau';

	// groups auths list
	$lang['ucp_edit_profile'] = 'Editer le profil';
	$lang['ucp_edit_privacy'] = 'Editer les informations privées';
	$lang['ucp_edit_i18n'] = 'Editer les options d\'internationalisation';
	$lang['ucp_edit_posting'] = 'Editer les options de postage';
	$lang['ucp_edit_topicread'] = 'Editer les options de lecture';
	$lang['ucp_edit_layout'] = 'Editer les options de présentation du forum';

	// presets
	$lang['Auths_presets'] = 'Prérèglage des permissions';
	$lang['Presets_not_found'] = 'Prérèglage non trouvé';
	$lang['Preset_name'] = 'Nom du prérèglage';
	$lang['Preset_name_explain'] = 'Exporter : si vous choisissez un nom existant, le prérèglage ayant ce nom sera mis à jour ; si les autorisations choisies correspondent à un prérèglage existant, son nom sera mis à jour ; dans les autres cas, le prérèglage sera créé.';
	$lang['Export_preset'] = 'Exporter sous forme de prérèglage';
	$lang['Delete_preset'] = 'Supprimer ce prérèglage';
	$lang['Preset_changed'] = 'Ces autorisations correspondent à un prérèglage existant : vérifiez le nom de ce prérèglage et confirmez votre action.';
	$lang['Preset_name_empty'] = 'Vous devez choisir un nom de prérèglage pour aboutir dans cette action.';
	$lang['Preset_name_exists'] = 'Ce nom de prérèglage est déjà utilisé.';
	$lang['Preset_created'] = 'Prérèglage créé.';
	$lang['Preset_updated'] = 'Prérèglage mis à jour.';
	$lang['Preset_deleted'] = 'Prérèglage supprimé.';
	$lang['Submit_presets'] = 'Valider les prérèglages';

	// presets name
	$lang['Custom'] = 'Personnalisé';
	$lang['None'] = ' -- aucun -- ';

	// forums
	$lang['Preset_read_post_vote'] = 'Lit, écrit et vote';
	$lang['Preset_read_only'] = 'Lit uniquement';
	$lang['Preset_moderator'] = 'Modère';
	$lang['Preset_moderator_hidden'] = 'Modère (non affiché)';
	$lang['Preset_admin'] = 'Administre';
	$lang['Preset_guest_posting'] = 'Invité - écrit et répond';

	// panels
	$lang['Preset_access'] = 'Accède';

	// groups
	$lang['Preset_view'] = 'Voit';

	// generic return message
	$lang['Click_return_auths'] = 'Cliquez %sici%s pour retourner à la gestion des permissions';
	$lang['No_objects'] = 'Aucun objet géré';

	// group selection
	$lang['Select_source_groups'] = 'Choisir un gestionnaire (Utilisateur ou Groupe)';
	$lang['Select_source_groups_explain'] = 'Choisissez le groupe ou l\'utisateur auquel vous voulez accorder des autorisations.';
	$lang['Select_target_groups'] = 'Choisissez un utilisateur ou un groupe à gérer';
	$lang['Select_target_groups_explain'] = 'Choisissez le groupe ou l\'utilisateur pour lequel vous voulez accorder des autorisations.';

	// forum selection
	$lang['Click_return_select_forums'] = 'Cliquez %sici%s pour retourner au choix d\'un forum.';
	$lang['Select_target_forums'] = 'Choisir un forum';
	$lang['Select_target_forums_explain'] = 'Choisissez le forum pour lequel vous voulez accorder des autorisations.';

	// panel selection
	$lang['Select_panels'] = 'Choisir un panneau';
	$lang['Click_return_select_panels'] = 'Cliquez %sici%s pour retourner au choix d\'un panneau.';
	$lang['Select_target_panels'] = 'Choisir un panneau';
	$lang['Select_target_panels_explain'] = 'Choisissez le panneau pour lequel vous voulez accorder des autorisations.';
	$lang['Panel_name'] = 'Nom du panneau';
	$lang['Panel_shortcut'] = 'Raccourci';

	// auth type & direction selection
	$lang['Auth_center'] = 'Administration des permissions';
	$lang['Auth_center_explain'] = 'Ici vous pourrez gérer les permissions utilisées par le forum.';
	$lang['Click_return_auth_center'] = 'Cliquez %sici%s pour retourner à l\'administration des autorisations';

	$lang['Select_auth_type_dir'] = 'Choisir le type de permission et l\'action';
	$lang['Auth_type'] = 'Type de permission';
	$lang['Forum_auth_type'] = 'Forum';
	$lang['Panel_auth_type'] = 'Panneau de contrôle';
	$lang['Group_auth_type'] = 'utilisateur ou groupe';

	$lang['Auth_direction'] = 'Voir les permissions par';
	$lang['Manager'] = 'Gestionnaire (Utilisateur ou Groupe)';
	$lang['Object_managed'] = 'Objet géré (%s)';

	// overviews
	$lang['Panels_managed'] = 'Panneau de contrôle géré';
	$lang['Forums_managed'] = 'Forum géré';
	$lang['Group_managed'] = 'Utilisateur ou Groupe géré';
	$lang['Group_manager'] = 'Utilisateur ou Groupe gestionnaire';
	$lang['No_groups'] = 'Aucun groupe ou utilisateur n\'a été choisi. Cliquez sur Ajouter pour en ajouter.';
	$lang['Add_group'] = 'Ajouter un nouveau groupe ou utilisateur';
	$lang['Usergroup_members_legend'] = '<b>Légende:</b>&nbsp;<b>nom</b> = ce groupe a des autorisations';
	$lang['Group_members_legend'] = '<b>Légende:</b>&nbsp;<b>nom</b> = cet utilisateur a des autorisations individuelles';

	// forums overview
	$lang['Click_return_overviewforums'] = 'Cliquez %sici%s pour retourner à la vue synthétique des forums.';
	$lang['Overview_forums'] = 'Vue synthétique des forums (par Utilisateur ou Groupe gestionnaire)';
	$lang['Overview_forums_explain'] = 'Ici vous pouvez accorder les autorisations aux forums.';
	$lang['Please_confirm'] = 'Vérifiez la saisie, puis confirmez votre action';

	// panels overview
	$lang['Click_return_overviewpanels'] = 'Cliquez %sici%s pour retourner à la vue synthétique des panneaux.';
	$lang['Overview_panels'] = 'Vue synthétique des panneaux (par Utilisateur ou Groupe gestionnaire)';
	$lang['Overview_panels_explain'] = 'Ici vous pouvez accorder les autorisations aux panneaux.';

	// groups overview
	$lang['Click_return_overviewgroups'] = 'Cliquez %sici%s pour retourner à la vue synthétique des groupes.';
	$lang['Overview_groups'] = 'Vue synthétique des groupes (par Utilisateur ou Groupe gestionnaire)';
	$lang['Overview_groups_explain'] = 'Ici vous pouvez accorder les autorisations aux groupes.';

	// forums reversed overviewed
	$lang['Click_return_overviewforums_rev'] = 'Cliquez %sici%s pour retourner à la vue synthétique inversée des forums.';
	$lang['Overview_rev_forums'] = 'Vue synthétique inversée des forums (par forum géré)';
	$lang['Overview_rev_forums_explain'] = 'Ici vous pouvez accorder les autorisations de gestion à tous les groupes pour le forum choisi.';

	// panels reversed overviewed
	$lang['Click_return_overviewpanels_rev'] = 'Cliquez %sici%s pour retourner à la vue synthétique inversée des panneaux.';
	$lang['Overview_rev_panels'] = 'Vue synthétique inversée des panneaux (par panneau géré)';
	$lang['Overview_rev_panels_explain'] = 'Ici vous pouvez accorder les autorisations de gestion à tous les groupes pour le panneau choisi.';

	// groups reversed overviewed
	$lang['Click_return_overviewgroups_rev'] = 'Cliquez %sici%s pour retourner à la vue synthétique inversée des groupes.';
	$lang['Overview_rev_groups'] = 'Vue synthétique inversée des groupes (par Utilisateur ou Groupe géré)';
	$lang['Overview_rev_groups_explain'] = 'Ici vous pouvez accorder les autorisations de gestion à tous les groupes pour le groupe choisi.';

	// edit forum auths details
	$lang['Click_return_edit_auth_forums'] = 'Cliquez %sici%s pour retourner au détail des permissions du forum.';
	$lang['Edit_forums_auth'] = 'Détail des permissions du forum';
	$lang['Edit_forums_auth_explain'] = 'Ici vous pouvez définir les permissions pour ce forum, et créer, mettre à jour ou supprimer les prérèglages.';

	// edit panel auths details
	$lang['Click_return_edit_auth_panels'] = 'Cliquez %sici%s pour retourner au détail des permissions du panneau.';
	$lang['Edit_panels_auth'] = 'Détail des permissions du panneau';
	$lang['Edit_panels_auth_explain'] = 'Ici vous pouvez définir les permissions pour ce panneau, et créer, mettre à jour ou supprimer les prérèglages.';
	$lang['No_such_panel'] = 'Le panneau demandé n\'existe pas.';

	// edit group auths details
	$lang['Click_return_edit_auth_groups'] = 'Cliquez %sici%s pour retourner au détail des permissions du groupe.';
	$lang['Edit_groups_auth'] = 'Détail des permissions du groupe';
	$lang['Edit_groups_auth_explain'] = 'Ici vous pouvez définir les permissions pour ce groupe, et créer, mettre à jour ou supprimer les prérèglages.';

	// auths definitions
	$lang['Definition'] = 'Définition';
	$lang['Auths_definition'] = 'Définition des permissions';
	$lang['Auths_definition_explain'] = 'Ici vous pouvez éditer, ajouter ou supprimer des définitons de permissions.';
	$lang['Click_return_auths_def'] = 'Cliquez %sici%s pour retourner à la gestion des définitions des permissions';
	$lang['Create_auths_def'] = 'Créer une nouvelle définition de permissions';
	$lang['Create_auths_def_explain'] = 'Ici vous pouvez créer une nouvelle définition de permissions.';
	$lang['Edit_auths_def'] = 'Editer une définition de permissions';
	$lang['Edit_auths_def_explain'] = 'Ici vous pouvez éditer une définition de permissions.';
	$lang['Delete_auths_def'] = 'Supprimer une définition de permissions';
	$lang['Delete_auths_def_explain'] = 'Ici vous pouvez supprimer une définition de permissions.';
	$lang['Import_auths_def'] = 'Importer les définitions de permissions';
	$lang['Select_auth_type'] = 'Choisir un type de permissions';
	$lang['No_auths_def'] = 'Aucune définition de permissions crées pour l\'instant. <br />Pressez "Créer" pour en créer une, <br />"Régen" pour importer les définitions des autorisations existantes.';
	$lang['No_such_auth_type'] = 'Le type de permissions que vous avez demandé n\'existe pas.';

	// importing auths defs and forums auths
	$lang['Forums_auths_def_imported'] = 'Les définitions des permissions de type forum ont été importées.';
	$lang['Forums_auths_def_done'] = 'Il n\'y avait pas de nouvelle définition de permissions de type forum à importer.';
	$lang['Forums_auths_imported'] = 'Les autorisations aux forums ont été importées également.';
	$lang['Panels_auths_def_imported'] = 'Les définitions des permissions de type panneau ont été importées.';
	$lang['Panels_auths_def_done'] = 'Il n\'y avait pas de nouvelle définition de permissions de type panneau à importer.';
	$lang['Groups_auths_def_imported'] = 'Les définitions des permissions de type groupe ont été importées.';
	$lang['Groups_auths_def_done'] = 'Il n\'y avait pas de nouvelle définition de permissions de type groupe à importer.';

	// auths def detail
	$lang['No_such_auth_id'] = 'La définition de la permission que vous demandez n\'existe pas.';
	$lang['Auth_name'] = 'Nom de la permission';
	$lang['Auth_name_explain'] = 'Il s\'agit du nom symbolique utilisé par les programmes pour tester l\'autorisation.';
	$lang['Auth_desc'] = 'Description de la permission';
	$lang['Auth_title'] = 'Titre';
	$lang['Auth_title_explain'] = 'Renseigner ce champ à "Oui" fera de cette définition un titre au sein des listes de permissions.';
	$lang['Auth_order'] = 'Positionner cette définition après';

	// update messages
	$lang['Auths_def_created'] = 'La définition de cette permission a été créée.';
	$lang['Auths_def_updated'] = 'La définition de cette permission a été mise à jour.';
	$lang['Auths_def_deleted'] = 'La définition de cette permission a été supprimée (ainsi que les autorisations afférantes).';
}

?>