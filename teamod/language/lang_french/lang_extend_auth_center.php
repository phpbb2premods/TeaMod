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
$lang['Group_anonymous'] = 'Invit�s';
$lang['Group_anonymous_desc'] = 'Utilisateurs non enregistr�s';
$lang['Group_registered'] = 'Membres';
$lang['Group_registered_desc'] = 'Utilisateurs enregistr�s';
$lang['No_such_group'] = 'Ce groupe n\'existe pas';
$lang['Change_sysgroup_type_denied'] = 'Ce groupe doit avoir un statut au minimum clos.';
$lang['Manage_group_denied'] = 'Vous n\'�tes pas autoris� � modifier la d�finition de ce groupe.';

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_auth_center'] = 'Administration des permissions';

	// complementary for group management
	$lang['Board_founder_explain'] = 'Note : le groupe des Administrateurs principaux ne requi�rent pas de permissions : il les a naturellement toutes.';
	$lang['Delete_sysgroup_denied'] = 'Vous ne pouvez pas supprimer un groupe syst�me.';
	$lang['Change_sysgroup_denied'] = 'Vous ne pouvez pas modifier le statut syst�me de ce groupe.';
	$lang['Unknown_group_sysstatus'] = 'Statut syst�me inconnu.';
	$lang['System_group'] = 'Groupe syst�me';

	// main panel name
	$lang['Panels_index'] = 'Index des panneaux';
	$lang['phpbb_acp'] = 'Panneau d\'administration de phpBB';

	// direct entry for the menu
	$lang['Auths_Center'] = 'Administration des permissions';
	$lang['Control_panels'] = 'Panneaux de contr�le';
	$lang['10_Permissions_manager'] = 'Permissions/Gestionnaires';
	$lang['11_Permissions_managed'] = 'Permissions/Objets g�r�s';

	// auth values
	$lang['Auth_not_authorised'] = ' -- ';
	$lang['Auth_authorised'] = 'Autoris�';
	$lang['Auth_denied'] = 'Interdit m�me si autoris� par ailleurs';
	$lang['Auth_forced'] = 'Autoris� m�me si interdit par ailleurs';

	// forums auths list
	$lang['auth_view'] = 'Voir le forum';
	$lang['auth_read'] = 'Lire les messages';
	$lang['auth_post'] = 'Cr�er de nouveaux sujets';
	$lang['auth_reply'] = 'R�pondre � des sujets existants';
	$lang['auth_edit'] = 'Editer ses propres messages';
	$lang['auth_delete'] = 'Supprimer ses propres messages';
	$lang['auth_sticky'] = 'Cr�er des post-its';
	$lang['auth_announce'] = 'Cr�er des annonces';
	$lang['auth_global_announce'] = 'Cr�er des annonces g�n�rales';
	$lang['auth_vote'] = 'Voter';
	$lang['auth_pollcreate'] = 'Cr�er de nouveaux sondages';
	$lang['auth_mod'] = 'Editer et supprimer les messages autres que les siens (mod�rer)';
	$lang['auth_mod_display'] = 'Etre affich� comme mod�rateur du forum';
	$lang['auth_attachments'] = 'Joindre des fichiers';
	$lang['auth_download'] = 'R�cup�rer des fichiers joints';
	$lang['auth_manage'] = 'Administrer ce forum';

	// panels auths list
	$lang['Access'] = 'Acc�der � ce panneau';

	// groups auths list
	$lang['ucp_edit_profile'] = 'Editer le profil';
	$lang['ucp_edit_privacy'] = 'Editer les informations priv�es';
	$lang['ucp_edit_i18n'] = 'Editer les options d\'internationalisation';
	$lang['ucp_edit_posting'] = 'Editer les options de postage';
	$lang['ucp_edit_topicread'] = 'Editer les options de lecture';
	$lang['ucp_edit_layout'] = 'Editer les options de pr�sentation du forum';

	// presets
	$lang['Auths_presets'] = 'Pr�r�glage des permissions';
	$lang['Presets_not_found'] = 'Pr�r�glage non trouv�';
	$lang['Preset_name'] = 'Nom du pr�r�glage';
	$lang['Preset_name_explain'] = 'Exporter : si vous choisissez un nom existant, le pr�r�glage ayant ce nom sera mis � jour ; si les autorisations choisies correspondent � un pr�r�glage existant, son nom sera mis � jour ; dans les autres cas, le pr�r�glage sera cr��.';
	$lang['Export_preset'] = 'Exporter sous forme de pr�r�glage';
	$lang['Delete_preset'] = 'Supprimer ce pr�r�glage';
	$lang['Preset_changed'] = 'Ces autorisations correspondent � un pr�r�glage existant : v�rifiez le nom de ce pr�r�glage et confirmez votre action.';
	$lang['Preset_name_empty'] = 'Vous devez choisir un nom de pr�r�glage pour aboutir dans cette action.';
	$lang['Preset_name_exists'] = 'Ce nom de pr�r�glage est d�j� utilis�.';
	$lang['Preset_created'] = 'Pr�r�glage cr��.';
	$lang['Preset_updated'] = 'Pr�r�glage mis � jour.';
	$lang['Preset_deleted'] = 'Pr�r�glage supprim�.';
	$lang['Submit_presets'] = 'Valider les pr�r�glages';

	// presets name
	$lang['Custom'] = 'Personnalis�';
	$lang['None'] = ' -- aucun -- ';

	// forums
	$lang['Preset_read_post_vote'] = 'Lit, �crit et vote';
	$lang['Preset_read_only'] = 'Lit uniquement';
	$lang['Preset_moderator'] = 'Mod�re';
	$lang['Preset_moderator_hidden'] = 'Mod�re (non affich�)';
	$lang['Preset_admin'] = 'Administre';
	$lang['Preset_guest_posting'] = 'Invit� - �crit et r�pond';

	// panels
	$lang['Preset_access'] = 'Acc�de';

	// groups
	$lang['Preset_view'] = 'Voit';

	// generic return message
	$lang['Click_return_auths'] = 'Cliquez %sici%s pour retourner � la gestion des permissions';
	$lang['No_objects'] = 'Aucun objet g�r�';

	// group selection
	$lang['Select_source_groups'] = 'Choisir un gestionnaire (Utilisateur ou Groupe)';
	$lang['Select_source_groups_explain'] = 'Choisissez le groupe ou l\'utisateur auquel vous voulez accorder des autorisations.';
	$lang['Select_target_groups'] = 'Choisissez un utilisateur ou un groupe � g�rer';
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
	$lang['Auth_center_explain'] = 'Ici vous pourrez g�rer les permissions utilis�es par le forum.';
	$lang['Click_return_auth_center'] = 'Cliquez %sici%s pour retourner � l\'administration des autorisations';

	$lang['Select_auth_type_dir'] = 'Choisir le type de permission et l\'action';
	$lang['Auth_type'] = 'Type de permission';
	$lang['Forum_auth_type'] = 'Forum';
	$lang['Panel_auth_type'] = 'Panneau de contr�le';
	$lang['Group_auth_type'] = 'utilisateur ou groupe';

	$lang['Auth_direction'] = 'Voir les permissions par';
	$lang['Manager'] = 'Gestionnaire (Utilisateur ou Groupe)';
	$lang['Object_managed'] = 'Objet g�r� (%s)';

	// overviews
	$lang['Panels_managed'] = 'Panneau de contr�le g�r�';
	$lang['Forums_managed'] = 'Forum g�r�';
	$lang['Group_managed'] = 'Utilisateur ou Groupe g�r�';
	$lang['Group_manager'] = 'Utilisateur ou Groupe gestionnaire';
	$lang['No_groups'] = 'Aucun groupe ou utilisateur n\'a �t� choisi. Cliquez sur Ajouter pour en ajouter.';
	$lang['Add_group'] = 'Ajouter un nouveau groupe ou utilisateur';
	$lang['Usergroup_members_legend'] = '<b>L�gende:</b>&nbsp;<b>nom</b> = ce groupe a des autorisations';
	$lang['Group_members_legend'] = '<b>L�gende:</b>&nbsp;<b>nom</b> = cet utilisateur a des autorisations individuelles';

	// forums overview
	$lang['Click_return_overviewforums'] = 'Cliquez %sici%s pour retourner � la vue synth�tique des forums.';
	$lang['Overview_forums'] = 'Vue synth�tique des forums (par Utilisateur ou Groupe gestionnaire)';
	$lang['Overview_forums_explain'] = 'Ici vous pouvez accorder les autorisations aux forums.';
	$lang['Please_confirm'] = 'V�rifiez la saisie, puis confirmez votre action';

	// panels overview
	$lang['Click_return_overviewpanels'] = 'Cliquez %sici%s pour retourner � la vue synth�tique des panneaux.';
	$lang['Overview_panels'] = 'Vue synth�tique des panneaux (par Utilisateur ou Groupe gestionnaire)';
	$lang['Overview_panels_explain'] = 'Ici vous pouvez accorder les autorisations aux panneaux.';

	// groups overview
	$lang['Click_return_overviewgroups'] = 'Cliquez %sici%s pour retourner � la vue synth�tique des groupes.';
	$lang['Overview_groups'] = 'Vue synth�tique des groupes (par Utilisateur ou Groupe gestionnaire)';
	$lang['Overview_groups_explain'] = 'Ici vous pouvez accorder les autorisations aux groupes.';

	// forums reversed overviewed
	$lang['Click_return_overviewforums_rev'] = 'Cliquez %sici%s pour retourner � la vue synth�tique invers�e des forums.';
	$lang['Overview_rev_forums'] = 'Vue synth�tique invers�e des forums (par forum g�r�)';
	$lang['Overview_rev_forums_explain'] = 'Ici vous pouvez accorder les autorisations de gestion � tous les groupes pour le forum choisi.';

	// panels reversed overviewed
	$lang['Click_return_overviewpanels_rev'] = 'Cliquez %sici%s pour retourner � la vue synth�tique invers�e des panneaux.';
	$lang['Overview_rev_panels'] = 'Vue synth�tique invers�e des panneaux (par panneau g�r�)';
	$lang['Overview_rev_panels_explain'] = 'Ici vous pouvez accorder les autorisations de gestion � tous les groupes pour le panneau choisi.';

	// groups reversed overviewed
	$lang['Click_return_overviewgroups_rev'] = 'Cliquez %sici%s pour retourner � la vue synth�tique invers�e des groupes.';
	$lang['Overview_rev_groups'] = 'Vue synth�tique invers�e des groupes (par Utilisateur ou Groupe g�r�)';
	$lang['Overview_rev_groups_explain'] = 'Ici vous pouvez accorder les autorisations de gestion � tous les groupes pour le groupe choisi.';

	// edit forum auths details
	$lang['Click_return_edit_auth_forums'] = 'Cliquez %sici%s pour retourner au d�tail des permissions du forum.';
	$lang['Edit_forums_auth'] = 'D�tail des permissions du forum';
	$lang['Edit_forums_auth_explain'] = 'Ici vous pouvez d�finir les permissions pour ce forum, et cr�er, mettre � jour ou supprimer les pr�r�glages.';

	// edit panel auths details
	$lang['Click_return_edit_auth_panels'] = 'Cliquez %sici%s pour retourner au d�tail des permissions du panneau.';
	$lang['Edit_panels_auth'] = 'D�tail des permissions du panneau';
	$lang['Edit_panels_auth_explain'] = 'Ici vous pouvez d�finir les permissions pour ce panneau, et cr�er, mettre � jour ou supprimer les pr�r�glages.';
	$lang['No_such_panel'] = 'Le panneau demand� n\'existe pas.';

	// edit group auths details
	$lang['Click_return_edit_auth_groups'] = 'Cliquez %sici%s pour retourner au d�tail des permissions du groupe.';
	$lang['Edit_groups_auth'] = 'D�tail des permissions du groupe';
	$lang['Edit_groups_auth_explain'] = 'Ici vous pouvez d�finir les permissions pour ce groupe, et cr�er, mettre � jour ou supprimer les pr�r�glages.';

	// auths definitions
	$lang['Definition'] = 'D�finition';
	$lang['Auths_definition'] = 'D�finition des permissions';
	$lang['Auths_definition_explain'] = 'Ici vous pouvez �diter, ajouter ou supprimer des d�finitons de permissions.';
	$lang['Click_return_auths_def'] = 'Cliquez %sici%s pour retourner � la gestion des d�finitions des permissions';
	$lang['Create_auths_def'] = 'Cr�er une nouvelle d�finition de permissions';
	$lang['Create_auths_def_explain'] = 'Ici vous pouvez cr�er une nouvelle d�finition de permissions.';
	$lang['Edit_auths_def'] = 'Editer une d�finition de permissions';
	$lang['Edit_auths_def_explain'] = 'Ici vous pouvez �diter une d�finition de permissions.';
	$lang['Delete_auths_def'] = 'Supprimer une d�finition de permissions';
	$lang['Delete_auths_def_explain'] = 'Ici vous pouvez supprimer une d�finition de permissions.';
	$lang['Import_auths_def'] = 'Importer les d�finitions de permissions';
	$lang['Select_auth_type'] = 'Choisir un type de permissions';
	$lang['No_auths_def'] = 'Aucune d�finition de permissions cr�es pour l\'instant. <br />Pressez "Cr�er" pour en cr�er une, <br />"R�gen" pour importer les d�finitions des autorisations existantes.';
	$lang['No_such_auth_type'] = 'Le type de permissions que vous avez demand� n\'existe pas.';

	// importing auths defs and forums auths
	$lang['Forums_auths_def_imported'] = 'Les d�finitions des permissions de type forum ont �t� import�es.';
	$lang['Forums_auths_def_done'] = 'Il n\'y avait pas de nouvelle d�finition de permissions de type forum � importer.';
	$lang['Forums_auths_imported'] = 'Les autorisations aux forums ont �t� import�es �galement.';
	$lang['Panels_auths_def_imported'] = 'Les d�finitions des permissions de type panneau ont �t� import�es.';
	$lang['Panels_auths_def_done'] = 'Il n\'y avait pas de nouvelle d�finition de permissions de type panneau � importer.';
	$lang['Groups_auths_def_imported'] = 'Les d�finitions des permissions de type groupe ont �t� import�es.';
	$lang['Groups_auths_def_done'] = 'Il n\'y avait pas de nouvelle d�finition de permissions de type groupe � importer.';

	// auths def detail
	$lang['No_such_auth_id'] = 'La d�finition de la permission que vous demandez n\'existe pas.';
	$lang['Auth_name'] = 'Nom de la permission';
	$lang['Auth_name_explain'] = 'Il s\'agit du nom symbolique utilis� par les programmes pour tester l\'autorisation.';
	$lang['Auth_desc'] = 'Description de la permission';
	$lang['Auth_title'] = 'Titre';
	$lang['Auth_title_explain'] = 'Renseigner ce champ � "Oui" fera de cette d�finition un titre au sein des listes de permissions.';
	$lang['Auth_order'] = 'Positionner cette d�finition apr�s';

	// update messages
	$lang['Auths_def_created'] = 'La d�finition de cette permission a �t� cr��e.';
	$lang['Auths_def_updated'] = 'La d�finition de cette permission a �t� mise � jour.';
	$lang['Auths_def_deleted'] = 'La d�finition de cette permission a �t� supprim�e (ainsi que les autorisations aff�rantes).';
}

?>