<?php
/***************************************************************************
 *						lang_extend_cat_hierarchy.php [French]
 *						--------------------------------------
 *	begin				: 08/10/2004
 *	copyright			: Ptirhiik & Gilgraf (GGWeb-fr.com)
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.12 - 21/08/2005
 *  translation			: Gilgraf, Ptirhiik
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

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_cat_hierarchy'] = 'Categories Hierarchy';
	$lang['Extended_template_CH'] = 'Extended template CH edition';

	// admin_forums
	$lang['01_Manage'] = 'Gestion';
	$lang['02_Styles'] = 'Thèmes';
	$lang['03_Prune'] = 'Délestage';
	$lang['Configuration+'] = 'Configuration +';

	$lang['View_details'] = 'Voir le détail';
	$lang['change_view'] = 'Changer de vue';
	$lang['Forum_edit_explain'] = 'Le formulaire ci-dessous vous permet de modifier un forum (ou une catégorie).';
	$lang['Forum_create_explain'] = 'Le formulaire ci-dessous vous permet de créer un forum (ou une catégorie).';
	$lang['Forum_type'] = 'Type du forum';
	$lang['Forum_main'] = 'Forum de rattachement';
	$lang['Forum_order'] = 'Positionner ce forum après';
	$lang['Move_contents_explain'] = 'Choisissez le forum qui accueillera tout le contenu du forum à supprimer (messages et sous-forums).';
	$lang['Forum_style'] = 'Thème utilisé pour l\'affichage de ce forum';
	$lang['Forum_style_explain'] = 'Ce thème sera utilisé à la place de celui choisi par l\'utilisateur ou celui mis par défaut pour tous les forums. Choisissez "Aucun" si vous ne voulez pas de thème spécifique.';
	$lang['Images'] = 'Images';
	$lang['Images_explain'] = 'Vous pouvez utiliser aussi bien une URL qu\'une image présente dans le tableau $images[] (cf. template/<i>votre_template</i>/<i>votre_template</i>.cfg).';
	$lang['Forum_nav_icon'] = 'Icône de navigation';
	$lang['Forum_nav_icon_explain'] = 'Cette icône apparaitra devant le titre du forum dans le flux de navigation (Index du forum &raquo forum 1 &raquo ...).';
	$lang['Forum_icon'] = 'Image du forum';
	$lang['Forum_icon_explain'] = 'Cette image apparaitra devant le nom du forum sur la page d\'index.';
	$lang['Forum_link_hit_count'] = 'Compter les appels';
	$lang['Forum_subs_hidden'] = 'Cacher la liste des sous-forums';
	$lang['Forum_subs_hidden_explain'] = 'Laisser caché la liste des sous-forums qui apparaît sous les noms des forums sur la page d\'index.';

	$lang['Topics_per_page_explain'] = 'Choisissez 0 pour utiliser la valeur par défaut définie par la configuration générale ou le choix de l\'utilisateur.';
	$lang['Topics_sort'] = 'Trier les sujets par';
	$lang['Topics_sort_explain'] = 'Choisissez la méthode de tri des sujets pour ce forum. Choisissez "Aucun" pour utiliser la valeur par défaut définie par la configuration générale ou les choix de l\'utilisateur.';
	$lang['Topics_split_in_box'] = 'Nouvelle boîte';
	$lang['Topics_split_title_only'] = 'Séparer uniquement par un titre';
	$lang['Topics_split_global'] = 'Séparer les annonces générales des annonces normales';
	$lang['Topics_split_announces'] = 'Séparer les annonces des post-its et des sujets standards';
	$lang['Topics_split_stickies'] = 'Séparer les post-its des sujets standards';

	$lang['Index_layout'] = 'Présentation des sous-forums';
	$lang['Last_topic_title_length'] = 'Longueur du titre du dernier sujet sur l\'index';
	$lang['Last_topic_title_length_explain'] = 'Choisissez la longueur en nombre de caractères des titres des derniers messages affichés sur la page d\'index, de manière à éviter une déformation de celle-ci due à des titres trop long. Renseignez cette valeur à 0 si vous ne désirez pas raccourcir ces titres.';
	$lang['Override_user_choice'] = 'Passer outre le choix des utilisateurs';

	$lang['Board_box_content'] = 'Annonces du forum';
	$lang['Board_box_content_explain'] = 'Choisissez quel type d\'annonces vous souhaitez voir apparaître dans la boîte "Annonces du forum".';
	$lang['Do_not_display'] = 'Ne rien afficher';
	$lang['Global_Parent_announces'] = 'Annonces générales plus annonces des forums de rattachement';
	$lang['Global_Childs_announces'] = 'Annonces générales plus annonces des sous-forums';
	$lang['Global_Branch_announces'] = 'Annonces générales plus annonces de la section';

	$lang['Default_setup'] = 'Valeur par défaut ou choix de l\'utilisateur';

	$lang['Forum_not_empty'] = 'Il reste des messages dans ce forum : déplacez les ou supprimez les avant de modifier le type de ce forum.';
	$lang['Root_delete_deny'] = 'Vous ne pouvez pas supprimer l\'index des forums.';
	$lang['Attach_to_link_denied'] = 'Vous ne pouvez pas déplacer le contenu d\'un forum vers un forum de type lien.';
	$lang['Empty_move_to'] = 'Choisissez un forum de destination pour le contenu du forum à supprimer, ou choisissez "Tout supprimer" pour détruire ce contenu.';
	$lang['Forums_resync_done'] = 'Le forum et ses sous-forums ont été synchronisés.';

	$lang['Copy'] = 'Copier';
	$lang['Details'] = 'Détail';
	$lang['Group'] = 'Groupe';
	$lang['Selected'] = 'Sélectionné';

	// caches management
	$lang['Caches'] = 'Caches';
	$lang['Cache_admin'] = 'Administration des caches';
	$lang['Cache_admin_explain'] = 'Vous pouvez ici activer, désactiver ou renouveler les caches utilisés par le forum.';
	$lang['Click_return_cacheadmin'] = 'Cliquez %sici%s pour retourner à l\'administration des caches.';

	$lang['Table_caches'] = 'Caches génériques';
	$lang['Template_cache'] = 'Cache des templates';
	$lang['Cache_path'] = 'Répertoire des caches';
	$lang['Cache_path_explain'] = 'Chemin relatif à votre répertoire phpBB où les fichiers caches seront stockés, par exemple cache/.';
	$lang['Check_setup'] = 'Tester le répertoire';

	$lang['Cache_regen'] = 'Régénérer le cache';
	$lang['Cache_last_generation'] = 'Dernière régénération';

	$lang['Enable_cache_config'] = 'Activer la mise en cache de la configuration';
	$lang['Enable_cache_forums'] = 'Activer la mise en cache des forums';
	$lang['Enable_cache_moderators'] = 'Activer la mise en cache de la liste des modérateurs';
	$lang['Enable_cache_topics_attr'] = 'Activer la mise en cache de la liste des titres des sujets';
	$lang['Enable_cache_themes'] = 'Activer la mise en cache des thèmes';
	$lang['Enable_cache_ranks'] = 'Activer la mise en cache des rangs';
	$lang['Enable_cache_words'] = 'Activer la mise en cache de la liste des mots censurés';
	$lang['Enable_cache_smilies'] = 'Activer la mise en cache de la liste des émoticônes';
	$lang['Enable_cache_icons'] = 'Activer la mise en cache de la liste des icônes de messages';
	$lang['Enable_cache_cp_patches'] = 'Activer la mise en cache des patchs sur les panneaux de contrôle';
	$lang['Enable_cache_cp_panels'] = 'Activer la mise en cache de la définition des panneaux de contrôle';
	$lang['Enable_cache_template'] = 'Activer la mise en cache des templates';
	$lang['Check_recent_tpl'] = 'Vérifier si les fichiers .tpl ont changé';

	$lang['Cache_failed_config'] = 'La mise en cache de la configuration a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_forums'] = 'La mise en cache des forums a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_moderators'] = 'La mise en cache de la liste des modérateurs a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_topics_attr'] = 'La mise en cache des attributs de sujet a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_themes'] = 'La mise en cache des thèmes a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_ranks'] = 'La mise en cache des rangs a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_words'] = 'La mise en cache de la liste des mots censurés a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_smilies'] = 'La mise en cache de la liste des émoticônes a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_icons'] = 'La mise en cache de la liste des icônes de messages a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_cp_patches'] = 'La mise en cache des patchs sur les panneaux de contrôle a échoué. Le cache a été désactivé.';
	$lang['Cache_failed_cp_panels'] = 'La mise en cache de la définition des panneaux de contrôle a échoué. Le cache a été désactivé.';

	$lang['Cache_succeed_config'] = 'La mise en cache de la configuration a abouti. Le cache a été activé.';
	$lang['Cache_succeed_forums'] = 'La mise en cache des forums a abouti. Le cache a été activé.';
	$lang['Cache_succeed_moderators'] = 'La mise en cache de la liste des modérateurs a abouti. Le cache a été activé.';
	$lang['Cache_succeed_topics_attr'] = 'La mise en cache des attributs de sujet a abouti. Le cache a été activé.';
	$lang['Cache_succeed_themes'] = 'La mise en cache des thèmes a abouti. Le cache a été activé.';
	$lang['Cache_succeed_ranks'] = 'La mise en cache des rangs a abouti. Le cache a été activé.';
	$lang['Cache_succeed_words'] = 'La mise en cache de la liste des mots censurés a abouti. Le cache a été activé.';
	$lang['Cache_succeed_smilies'] = 'La mise en cache de la liste des émoticônes a abouti. Le cache a été activé.';
	$lang['Cache_succeed_icons'] = 'La mise en cache de la liste des icônes de messages a abouti. Le cache a été activé.';
	$lang['Cache_succeed_cp_patches'] = 'La mise en cache des patchs sur les panneaux de contrôle a abouti. Le cache a été activé.';
	$lang['Cache_succeed_cp_panels'] = 'La mise en cache de la définition des panneaux de contrôle a abouti. Le cache a été activé.';

	$lang['User_caches'] = 'Cache de niveau utilisateur';
	$lang['Cache_fauths'] = 'Permission d\'accès aux forums';
	$lang['Cache_fjbox'] = 'Liste déroulante des forums';
	$lang['Cache_groups_list'] = 'Cache de la liste des groupes des utilisateurs';
	$lang['Groups_list_sync'] = 'La liste des groupes de chaque utilisateur a été resynchronisée.';

	$lang['Board_stats_caches'] = 'Cache des statistiques d\'utilisation du forum';
	$lang['Total_topics'] = 'Total des sujets';
	$lang['Last_user'] = 'Dernier utilisateur enregistré';
	$lang['Board_stats_sync'] = 'Les caches des statistiques d\'utilisation du forum ont été synchronisés.';

	$lang['Check_results'] = 'Tester les résultats';
	$lang['Cache_path_not_found'] = 'Le répertoire des caches n\'a pas été trouvé. Le test s\'est arrêté là et les caches sur les tables ont été désactivés.';
	$lang['Cache_path_found'] = 'Le répertoire de stockage des caches a été trouvé.';
	$lang['Cache_create_unavailable'] = 'La création de nouveaux caches n\'est pas disponible sur votre système.';
	$lang['Cache_filelist'] = 'Téléchargez dans le répertoire des caches des fichiers vides nommés : %s, et appliquez un CHMOD 666 dessus. Les caches non disponibles ont été désactivés.';
	$lang['Cache_sysfile_missing'] = 'Le fichier "sys_tests.dta" nécessaire aux tests n\'a pas été trouvé. Téléchargez le dans le répertoire des caches, et appliquez un CHMOD 666 dessus. Le test s\'est arrêté.';
	$lang['Cache_write_disabled'] = 'Le programme n\'a pas été en mesure de réinscrire le fichier de test (%s). Ajustez le CHMOD du fichier et/ou du répertoire à 666 au moins. Le test s\'est arrêté ici et les caches non disponibles ont été désactivés.';
	$lang['Cache_io_unavailable'] = 'Le programme n\'a pas été en mesure de réinscrire ou de lire le fichier de test (%s). Les caches non disponibles ont été désactivés.';
	$lang['Cache_successfull'] = 'Tous les tests ont été passés avec succès. Vous pouvez activer les caches sur les tables.';

	$lang['Cache_regenerated'] = 'Le cache a été marqué pour régénération.';
	$lang['Cache_setup_updated'] = 'La configuration des caches a été mise à jour.';

	// message icon admin
	$lang['Icons_settings'] = 'Icônes de message';
	$lang['Icons_admin'] = 'Gestion des icônes de message';
	$lang['Icons_admin_explain'] = 'Vous pouvez ici éditer, supprimer, créer et trier les icônes utilisées devant le titre des messages.';
	$lang['Icons_create'] = 'Ajouter une icône de messages';
	$lang['Icons_create_explain'] = 'Ici vous pouvez ajouter une nouvelle icône de messages.';
	$lang['Icons_edit'] = 'Editer une icône de messages';
	$lang['Icons_edit_explain'] = 'Ici vous pouvez modifier la définition d\'une icône de messages et de ses privilèges.';
	$lang['Icons_delete'] = 'Supprimer une icône de messages';
	$lang['Icons_delete_explain'] = 'Ici vous pouvez supprimer la définition d\'une icône de messages.';

	$lang['Icons_box'] = 'Prévisualisation du choix des icônes lors de la création d\'un message';
	$lang['Icons_types'] = 'Par défaut pour';
	$lang['Icons_usage'] = 'Utilisation';
	$lang['No_icons_create'] = 'Aucune icône n\'est disponible. Cliquez sur "Créer" pour en ajouter une.';

	$lang['Icon_not_exists'] = 'Cette icône n\'existe pas.';
	$lang['Click_return_iconsadmin'] = 'Cliquez %sici%s pour retourner à la gestion des icônes de messages.';

	$lang['Icon_name'] = 'Nom de l\'icône';
	$lang['Icon_name_explain'] = 'Vous pouvez utiliser une clé du tableau $lang[] (cf. language/lang_<i>votre_language</i>/lang_*.php), ou entrer le nom en clair.';
	$lang['Icon_url'] = 'URI de l\'icône';
	$lang['Icon_url_explain'] = 'Choisissez une icône dans la liste déroulante.';
	$lang['Icon_auth'] = 'Autorisation nécessaire';
	$lang['Icon_auth_explain'] = 'Choisissez quelle autorisation sera nécessaire pour utiliser cette icône.';
	$lang['Icon_types'] = 'Icône par défaut par type de sujets';
	$lang['Icon_types_explain'] = 'Choisissez pour quel type de sujets cette icône sera utilisée par défaut lorsqu\'aucune n\'aura été choisie par l\'auteur du message.';
	$lang['Icon_replace'] = 'Remplacer par l\'icône';
	$lang['Icon_replace_explain'] = 'Choisissez une icône pour remplacer dans les messages celle à supprimer. Choisissez "Aucun" si vous ne désirez pas les remplacer par une autre.';
	$lang['Icon_after'] = 'Positionner cette icône après';

	$lang['Icon_created'] = 'L\'icône a été ajoutée.';
	$lang['Icon_edited'] = 'L\'icône a été mise à jour.';
	$lang['Icon_deleted'] = 'L\'icône a été supprimée.';

	$lang['Top'] = '___ Début ___';

	// topics attributes admin
	$lang['Topics_attr_settings'] = 'Attributs de sujet';
	$lang['Topics_attr_admin'] = 'Gestion des attributs de sujet';
	$lang['Topics_attr_admin_explain'] = 'Ici vous pouvez modifier, supprimer, créer et trier les libellés et icônes utilisés devant le titre des sujets.';
	$lang['Topics_attr_create'] = 'Créer un attribut de sujet';
	$lang['Topics_attr_create_explain'] = 'Ici vous pouvez créer un nouvel attribut de sujet. Vous pouvez utiliser les clés du tableau $lang[] pour les légendes. Les images seront choisies parmis celles enregistrées dans le tableau $images[] (voir templates/<i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['Topics_attr_edit'] = 'Modifier un attribut de sujet';
	$lang['Topics_attr_edit_explain'] = 'Ici vous pouvez modifier la définition et les droits d\'un attribut de sujet. Les images seront choisies parmis celles enregistrées dans le tableau $images[] (voir templates/<i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['Topics_attr_delete'] = 'Supprimer un attribut de sujet';
	$lang['Topics_attr_delete_explain'] = 'Ici vous pouvez supprimer un attribut de sujet.';

	$lang['Topics_attr_folder'] = 'Icônes principales';
	$lang['Topics_attr_title'] = 'Titre';
	$lang['Topics_attr_name'] = 'Nom de l\'attribut';
	$lang['Topics_attr_name_explain'] = 'Renseignez ici le nom de l\'attribut de sujet que vous voulez voir apparaitre dans les listes déroulantes.';
	$lang['Topics_attr_fname'] = 'Libellé souris';
	$lang['Topics_attr_fname_explain'] = 'Renseignez ici le nom de l\'attribut de sujet qui apparait lorsque la souris passe sur l\'icône principale.';
	$lang['Topics_attr_fimg'] = 'Icône principale';
	$lang['Topics_attr_fimg_explain'] = 'Choisissez l\'icône principale qui sera utilisée lorsque la condition sera remplie.';
	$lang['Topics_attr_tname'] = 'Etiquette';
	$lang['Topics_attr_tname_explain'] = 'Renseignez ici le libellé de l\'étiquette qui sera ajoutée au titre du sujet.';
	$lang['Topics_attr_timg'] = 'Icône étiquette';
	$lang['Topics_attr_timg_explain'] = 'Lorsque fournie, cette icône sera utilisée à la place de l\'étiquette.';
	$lang['Topics_attr_field'] = 'Condition d\'utilisation';
	$lang['Topics_attr_field_explain'] = 'Renseignez ici la condition sous laquelle l\'attribut de sujet sera retenu.';
	$lang['Topics_attr_auth'] = 'Autorisation nécessaire';
	$lang['Topics_attr_auth_explain'] = 'Choisissez quelle autorisation sera nécessaire pour utiliser cet attribut. Cette dernière n\'est utilisée que pour les sous-types de sujet.';

	$lang['Topics_attr_ttype'] = 'Type de sujet';
	$lang['Topics_attr_tsubtype'] = 'Sous-type de sujet';
	$lang['Topics_attr_tmoved'] = 'Sujet traceur';
	$lang['Topics_attr_tstatus'] = 'Sujet verrouillé';
	$lang['Topics_attr_tvote'] = 'Sondage';
	$lang['Topics_attr_tattach'] = 'Sujet avec des fichiers joints';
	$lang['Topics_attr_tcalendar'] = 'Evènement du calendrier';

	$lang['Topics_attr_after'] = 'La priorité de l\'icône principale est juste inférieure à';
	$lang['Topics_attr_replace'] = 'Remplacer par l\'attribut de sujet';
	$lang['Topics_attr_replace_explain'] = 'Choisissez un sous-type pour remplacer celui à supprimer sur les sujets. Choisissez "Aucun" si vous ne désirez pas le remplacer : il sera alors supprimé des sujets.';

	$lang['Topics_attr_not_exists'] = 'Cet attribut de sujet n\'existe pas.';
	$lang['Topics_attr_created'] = 'L\'attribut de sujet a été créé.';
	$lang['Topics_attr_edited'] = 'L\'attribut de sujet a été modifié.';
	$lang['Topics_attr_deleted'] = 'L\'attribut de sujet a été supprimé.';

	$lang['Click_return_topics_attr_admin'] = 'Cliquez %sici%s pour retourner à la gestion des attributs de sujet.';

	// styles management
	$lang['Submit_styles'] = 'Valider le thème';
	$lang['Images_pack'] = 'Pack d\'images';
	$lang['Images_pack_explain'] = 'Saisissez ici le nom du fichier <i>template</i>.cfg dans lequel est stocké la définition des images que vous désirez utiliser (par exemple: <i>subSilver/subSilver.cfg</i>).<br />Laissez ce champ vide pour utiliser le fichier par défaut du template.';
	$lang['Custom_tpls'] = 'Répertoire des fichiers personnalisés';
	$lang['Custom_tpls_explain'] = 'Saisissez le répertoire dans lequel sont stockés les fichiers .tpl personnalisés que vous désirez utiliser (par exemple, si ces fichiers se trouvent dans <i>templates/subSilver/customs</i>, saisissez <i>customs</i>).<br />Laissez ce champ vide si vous n\'utilisez pas de fichier .tpl personnalisé.';
	$lang['Stylesheet_explain'] = 'Nom du fichier contenant la définition de la feuille de style (.css) utilisée pour ce thème.';
	$lang['Images_pack_not_found'] = 'Le pack d\'images n\'a pas été trouvé.';
	$lang['Custom_tpls_not_found'] = 'Le répertoire des fichiers .tpl personnalisés n\'a pas été trouvé.';
	$lang['Head_stylesheet_not_found'] = 'Le fichier contenant la définition de la feuille de style (.css) n\'a pas été trouvé.';

	// panels
	$lang['Admin_control_panel'] = 'Panneau de gestion de la configuration (ACP)';
	$lang['User_control_panel'] = 'Panneau de contrôle utilisateur';
	$lang['Group_control_panel'] = 'Panneau de contrôle des groupes';

	// config
	$lang['Topics_options'] = 'Options des sujets';
	$lang['Messages_options'] = 'Options de lecture';
	$lang['Click_return_msgopt'] = 'Cliquez %sici%s pour retourner aux options de lecture.';
	$lang['Click_return_topicopt'] = 'Cliquez %sici%s pour retourner aux options des sujets.';
	$lang['Click_return_layout'] = 'Cliquez %sici%s pour retourner aux options de présentation des sous-forums.';
	$lang['Keep_unreads_explain'] = 'Choisissez "Oui" pour conserver l\'indicateur "message non lu" dans un cooky, "Stockés dans la base de donnée" pour les mémoriser sur le profil utilisateur.';
	$lang['Keep_unreads_in_db'] = 'Stockés dans la base de données';
	$lang['Icons_path'] = 'Répertoire des icônes de messages';
	$lang['Icons_path_explain'] = 'La valeur initiale est "images/icons/".';
	$lang['Default_duration'] = 'Durée par défaut d\'une annonce';
	$lang['Default_duration_explain'] = 'Durée par défaut proposée lors de la création d\'une nouvelle annonce.';
	$lang['Site_fav_icon'] = 'Icône du site pour les favoris des navigateurs ("favicon")';
	$lang['Site_fav_icon_explain'] = 'Cette icône apparaitra dans les "favoris" du navigateur de vos visiteurs devant le nom de votre site. Elle doit être un fichier .ico, de taille 16x16 pixels.';
	$lang['Pagination_min'] = 'Nombre minimal de pages dans la pagination';
	$lang['Pagination_max'] = 'Nombre maximal de pages dans la pagination';
	$lang['Pagination_percent'] = 'Pourcentage de pages dans la pagination';

	// sub-title
	$lang['Topic_title_length'] = 'Longueur du titre du sujet sur l\'index';
	$lang['Topic_title_length_explain'] = 'Choisissez la longueur en nombre de caractères des titres des messages affichés sur la page d\'index et les forums.';
	$lang['Sub_title_length'] = 'Longueur du sous-titre (description) du sujet sur l\'index';
	$lang['Sub_title_length_explain'] = 'Choisissez la longueur en nombre de caractères des sous-titres (description) des messages affichés sur la page d\'index et les forums. Renseignez cette valeur à 0 si vous ne désirez pas afficher les sous-titres.';

	// versions check
	$lang['version_checked'] = '&nbsp;&nbsp;&nbsp;&raquo; <b>%s</b>: version que vous utilisez: <b>%s</b>, dernière version disponible: <b>%s</b>.';
	$lang['version_not_checked'] = '&nbsp;&nbsp;&nbsp;&raquo; <b>%s</b>: version que vous utilisez: <b>%s</b>.';
	$lang['Unknown'] = 'Inconnue';
}

//
// lang_main
//

// generic
$lang['No_valid_action'] = 'L\'action que vous essayez de réaliser n\'est pas reconnue.';
$lang['User_delete_deny'] = 'Vous n\'êtes pas autorisé à supprimer cet utilisateur.';
$lang['Auth_read_required'] = 'Seuls les utilisateurs disposant de droits spéciaux peuvent accèder aux messages de ce forum.';
$lang['Registration_required'] = 'Vous devez vous enregistrer pour accéder aux messages de ce forum.';

// index display
$lang['Cat_no_subs'] = 'Cette catégorie n\'a pas de sous-forum rattaché.';
$lang['Click_return_parent'] = 'Cliquez %sici%s pour retourner au forum de rattachement.';
$lang['View_group'] = 'Voir les informations sur le groupe';
$lang['Subforums'] = 'Sous-forums';
$lang['Link'] = 'Lien';
$lang['Forum_link_visited'] = 'Ce lien a été visité %d fois <br />depuis %s';
$lang['Board_announces'] = 'Annonces du forum';

$lang['Important_topics'] = 'Messages importants';
$lang['Global_Announces'] = 'Annonces générales';
$lang['Announces'] = 'Annonces';
$lang['Stickies'] = 'Post-its';

$lang['Post_Global_Announcement'] = 'Annonce générale';

$lang['Hot_topic'] = 'Populaire';
$lang['Own_topic'] = 'Vous avez participé à cette discussion';

$lang['Topic_Moved'] = 'Déplacé';
$lang['Topic_Poll'] = 'Sondage';
$lang['Topic_Locked'] = 'Verrouillé';
$lang['Topic_Global_Announcement'] = 'Annonce générale';
$lang['Topic_Announcement'] = 'Annonce';
$lang['Topic_Sticky'] = 'Post-it';
$lang['Topic_Attached'] = 'Fichier joint';

$lang['First_Post'] = 'Premier message';
$lang['No_topics'] = 'Il n\'y a pas de message dans ce forum.';
$lang['Topics_count'] = '[%s sujets]';
$lang['Posts_count'] = '[%s messages]';
$lang['Topics_count_1'] = '[%s sujet]';
$lang['Posts_count_1'] = '[%s message]';

$lang['Legend'] = 'Légende';
$lang['Not_available'] = 'Non disponible';

$lang['Announce_ends'] = 'Date de fin de l\'annonce: %s';

// date extended
$lang['Today'] = 'Aujourd\'hui';
$lang['Yesterday'] = 'Hier';
$lang['Today_at'] = 'Aujourd\'hui, à %s';
$lang['Yesterday_at'] = 'Hier, à %s';

// auto form error messages
$lang['empty_error'] = 'la valeur doit être renseignée.';
$lang['length_mini_error'] = 'la valeur est trop courte.';
$lang['length_maxi_error'] = 'la valeur est trop longue.';
$lang['value_mini_error'] = 'la valeur est trop petite.';
$lang['value_maxi_error'] = 'la valeur est trop grande.';
$lang['options_error'] = 'la valeur choisie n\'est pas disponible dans la liste.';
$lang['options_empty_error'] = 'aucune valeur n\'est disponible pour ce champ.';
$lang['url_error'] = 'ce n\'est pas une URL valide.';
$lang['Date_not_valid'] = 'ce n\'est pas une date valide.';
$lang['Not_a_valid_directory'] = 'ce n\'est pas un répertoire valide.';
$lang['Not_a_valid_script'] = 'ce n\'est le nom d\'un script valide.';
$lang['Only_numeric_allowed'] = 'seuls les caractères numériques sont autorisés.';

// tree drawing
$lang['tree_pic_' . TREE_HSPACE] = '&nbsp;&nbsp;&nbsp;&nbsp;';
$lang['tree_pic_' . TREE_VSPACE] = '|&nbsp;&nbsp;&nbsp;';
$lang['tree_pic_' . TREE_CROSS] = '|___';
$lang['tree_pic_' . TREE_CLOSE] = '|___';

// modcp
$lang['Move_to_forum_error'] = 'Le forum de destination que vous avez choisi est une catégorie ou un lien, il ne peut donc pas accueillir de messages.';

// search
$lang['No_such_forum'] = 'Ce forum n\'existe pas. Merci de choisir dans la liste un forum existant.';
$lang['Search_in_forum'] = 'Recherche dans le forum';
$lang['Search_no_subs'] = 'Ne pas inclure les sous-forums dans le champ de recherche';

// posting
$lang['Message_icon'] = 'Icônes de message';
$lang['No_icon'] = 'Aucune icône';
$lang['Topic_duration'] = 'Date de fin de l\'annonce';
$lang['Topic_duration_explain'] = 'Il s\'agit de la date à partir de laquelle une annonce cessera d\'apparaître dans les autres forums comme une annonce générale ou une annonce des forums.';
$lang['Topic_duration_special'] = 'Choisissez "Jamais affichée" pour ne jamais afficher cette annonce ailleurs que sur son forum d\'origine. <br />Choisissez "Toujours affichée" pour ne pas que l\'annonce prenne fin.';
$lang['Never_displayed'] = 'Jamais affichée';
$lang['Always_displayed'] = 'Toujours affichée';
$lang['New_post_meanwhile_reply'] = 'Un nouveau message a été posté pendant que vous rédigiez le vôtre. Vérifiez la revue du sujet sur cette page, puis ressoumettez-le.';
$lang['New_post_meanwhile_edit'] = 'Un nouveau message a été posté ou le dernier message a été supprimé pendant que vous rédigiez le vôtre.';

// icons title
$lang['icon_none'] = 'Aucune icône';
$lang['icon_note'] = 'Note';
$lang['icon_important'] = 'Important';
$lang['icon_idea'] = 'Idée';
$lang['icon_warning'] = 'Attention !';
$lang['icon_question'] = 'Question';
$lang['icon_cool'] = 'Détente';
$lang['icon_funny'] = 'Marrant';
$lang['icon_angry'] = 'Grrrr !';
$lang['icon_sad'] = 'Snif !';
$lang['icon_mocker'] = 'Héhéhé !';
$lang['icon_shocked'] = 'Oooh !';
$lang['icon_complicity'] = 'Complice';
$lang['icon_bad'] = 'Nul !';
$lang['icon_great'] = 'Génial !';
$lang['icon_disgusting'] = 'Beurk !';
$lang['icon_winner'] = 'Gniark !';
$lang['icon_impressed'] = 'Ah oui !';
$lang['icon_roleplay'] = 'Histoire';
$lang['icon_fight'] = 'Combat';
$lang['icon_loot'] = 'Butin';
$lang['icon_picture'] = 'Image';
$lang['icon_calendar'] = 'Evénement du calendrier';

// settings
$lang['No_options'] = 'Aucune option n\'est disponible.';
$lang['Click_return_prefs'] = 'Cliquez %sici%s pour retourner au réglage de vos préférences.';
$lang['Topic_read'] = 'Lecture des sujets';
$lang['Board_layout'] = 'Présentation du forum';
$lang['Default'] = 'Défaut';
$lang['Keep_unreads'] = 'Se souvenir des messages non lus';
$lang['Keep_unreads_dft_explain'] = 'Choisissez "Oui" pour retrouver à votre prochaine visite les messages non lus marqués comme tels.';
$lang['Topics_sort'] = 'Trier les sujets par';
$lang['Topics_sort_dft_explain'] = 'Choisissez la méthode de tri des sujets dans les forums.';
$lang['Smart_date'] = 'Hier/aujourd\'hui';
$lang['Smart_date_explain'] = 'Afficher "Hier" et "Aujourd\'hui" plutôt que la date dans les messages.';
$lang['Board_box_display'] = 'Afficher les annonces des forums';
$lang['Index_pack'] = 'Réduire l\'affichage des sous-catégories';
$lang['Index_pack_explain'] = 'Lorsqu\'activé, les sous-catégories apparaîtront sous la forme de forums.';
$lang['Index_split'] = 'Séparer les sous-catégories';
$lang['Index_split_explain'] = 'Lorsqu\'activé, les catégories sont séparées les unes des autres. NB.: ce réglage est rendu inactif par la réduction de l\'affichage des sous-catégories.';

// standard prefs
$lang['Internationalisation'] = 'Internationalisation';
$lang['Posting_messages'] = 'Options de postage';
$lang['Privacy_choices'] = 'Options de confidentialité';

// user levels
$lang['Administrator'] = 'Administrateur';
$lang['User'] = 'Utilisateur';

// stats extended
$lang['Past_guests'] = 'Décompte des visites des invités';
$lang['Stats_display_past'] = 'Afficher l\'historique des visites sur la page d\'index';

$lang['Past_users_zero_total'] = 'Il n\'y a pas eu de visites durant les dernières 24 heures :: ';
$lang['Past_user_total'] = 'Il y a eu une visite durant les dernières 24 heures :: ';
$lang['Past_users_total'] = 'Il y a eu <b>%d</b> visiteurs durant les dernières 24 heures :: ';

$lang['Hour_users_zero_total'] = 'Il n\'y a pas eu de visite durant l\'heure en cours :: ';
$lang['Hour_user_total'] = 'Il y a eu un visiteur durant l\'heure en cours :: ';
$lang['Hour_users_total'] = 'Il y a eu <b>%d</b> visiteurs durant l\'heure en cours :: ';
$lang['Hour_visits'] = '(%s durant l\'heure en cours)';

// unmark topics
$lang['Topic_unmarked_read'] = 'Le sujet a été marqué comme non lu.';
$lang['Topic_unmark_read'] = 'Marquer le sujet comme non lu';
$lang['Post_unmark_read'] = 'Marque ce message et les suivants dans ce sujet comme non lus';

// sub-title
$lang['Sub_title'] = 'Description du sujet';
$lang['Sub_title_desc'] = 'Description: %s';

// run stats
$lang['Stat_surround'] = '[ %s ]';
$lang['Stat_sep'] = ' - ';
$lang['Stat_page_duration'] = 'Temps: %.4fs';
$lang['Stat_local_duration'] = 'trace locale: %.4fs';
$lang['Stat_part_php'] = 'PHP: %.2d%%';
$lang['Stat_part_sql'] = 'SQL: %.2d%%';
$lang['Stat_queries_total'] = 'Requêtes: %2d (%.4fs)';
$lang['Stat_queries_db'] = 'bd: %2d (%.4fs)';
$lang['Stat_queries_cache'] = 'cache: %2d (%.4fs/%.4fs)';
$lang['Stat_gzip_enable'] = 'GZIP activé';
$lang['Stat_debug_enable'] = 'Déboguage activé';
$lang['Stat_request'] = 'Requête';
$lang['Stat_line'] = 'Ligne:&nbsp;%d';
$lang['Stat_cache'] = 'cache:&nbsp;%.4fs';
$lang['Stat_db'] = 'bd:&nbsp;%.4fs';
$lang['Stat_table'] = 'Table';
$lang['Stat_type'] = 'Type';
$lang['Stat_possible_keys'] = 'Clés possibles';
$lang['Stat_key'] = 'Clé utilisée';
$lang['Stat_key_len'] = 'Longueur';
$lang['Stat_ref'] = 'Réf.';
$lang['Stat_rows'] = 'Lignes';
$lang['Stat_Extra'] = 'Commentaire';
$lang['Stat_Comment'] = 'Commentaire';
$lang['Stat_id'] = 'Id';
$lang['Stat_select_type'] = 'Type du Select';

// debug
$lang['dbg_location'] = 'Position';
$lang['dbg_line'] = 'Ligne';
$lang['dbg_file'] = 'Fichier';
$lang['dbg_empty'] = 'Pas de valeur';
$lang['dbg_backtrace'] = 'Trace/Rapport des opérations';
$lang['dbg_requester'] = 'Demandeur';

// operand
$lang['Less'] = 'Moins que';
$lang['Less_equal'] = 'Moins ou égal à';
$lang['Equal'] = 'Egal à';
$lang['Greater_equal'] = 'Plus grand ou égal à';
$lang['Greater'] = 'Plus grand que';
$lang['Not_equal'] = 'Différent de';

// topic title attribute
$lang['Topic_sub_type'] = 'Ajouter une étiquette au sujet';

// calendar
$lang['Topic_calendar'] = 'Evénement';

// access key commands (keyboard shortcuts)
$lang['cmd_submit'] = 's';
$lang['cmd_select'] = 's';
$lang['cmd_delete'] = 'x';
$lang['cmd_edit'] = 'e';
$lang['cmd_create'] = 'c';
$lang['cmd_cancel'] = 'a';
$lang['cmd_synchro'] = 'y';
$lang['cmd_add_group'] = 'g';
$lang['cmd_regen'] = 'r';
$lang['cmd_preview'] = 'p';
$lang['cmd_up'] = '-';
$lang['cmd_down'] = '+';
$lang['cmd_export'] = 'o';

// timezone
$lang['UTC_DST'] = 'UTC %s %s (DST en action)';
$lang['UTC'] = 'UTC %s %s';
$lang['dst'] = 'Heure d\'été';
$lang['dst_explain'] = 'Ajuster l\'heure pour l\'été (ajoute 1 heure en été).';
$lang['tz_suggest'] = 'Synchroniser';
$lang['tz_suggest_explain'] = 'Essayer de trouver votre format d\'heure le plus finement possible';

//---------------------------
//------- AJOUT ATTRIBUTS ---
//---------------------------
$lang['attr_coeur'] = '[Coup de Coeur]';
$lang['attr_prise'] = '[Electrique]';
$lang['attr_couleur'] = '[haut en couleur]';
$lang['attr_img'] = '[vidéo(s)]';
$lang['attr_lien'] = '[Lien cool]';
$lang['att_son'] = '[Bon son]';
$lang['att_ann'] = 'Annulé';
$lang['att_attn'] = 'En Attente';
$lang['att_cours'] = '[A Voir]';
$lang['att_info'] = '[INFO]';
$lang['att_inst'] = '[Travaux]';
$lang['att_jeu'] = '[Sympa]';
$lang['att_list'] = '[Listing]';
$lang['att_pub'] = '[Lecture]';
$lang['att_rea'] = '[RŽalisation]';
$lang['att_tem'] = '[Peinture/Dessin]';
$lang['att_son2'] = '[Transféré]';
$lang['att_valid'] = '[NumŽrique]';
?>