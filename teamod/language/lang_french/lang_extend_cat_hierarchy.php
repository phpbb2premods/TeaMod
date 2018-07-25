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
	$lang['02_Styles'] = 'Th�mes';
	$lang['03_Prune'] = 'D�lestage';
	$lang['Configuration+'] = 'Configuration +';

	$lang['View_details'] = 'Voir le d�tail';
	$lang['change_view'] = 'Changer de vue';
	$lang['Forum_edit_explain'] = 'Le formulaire ci-dessous vous permet de modifier un forum (ou une cat�gorie).';
	$lang['Forum_create_explain'] = 'Le formulaire ci-dessous vous permet de cr�er un forum (ou une cat�gorie).';
	$lang['Forum_type'] = 'Type du forum';
	$lang['Forum_main'] = 'Forum de rattachement';
	$lang['Forum_order'] = 'Positionner ce forum apr�s';
	$lang['Move_contents_explain'] = 'Choisissez le forum qui accueillera tout le contenu du forum � supprimer (messages et sous-forums).';
	$lang['Forum_style'] = 'Th�me utilis� pour l\'affichage de ce forum';
	$lang['Forum_style_explain'] = 'Ce th�me sera utilis� � la place de celui choisi par l\'utilisateur ou celui mis par d�faut pour tous les forums. Choisissez "Aucun" si vous ne voulez pas de th�me sp�cifique.';
	$lang['Images'] = 'Images';
	$lang['Images_explain'] = 'Vous pouvez utiliser aussi bien une URL qu\'une image pr�sente dans le tableau $images[] (cf. template/<i>votre_template</i>/<i>votre_template</i>.cfg).';
	$lang['Forum_nav_icon'] = 'Ic�ne de navigation';
	$lang['Forum_nav_icon_explain'] = 'Cette ic�ne apparaitra devant le titre du forum dans le flux de navigation (Index du forum &raquo forum 1 &raquo ...).';
	$lang['Forum_icon'] = 'Image du forum';
	$lang['Forum_icon_explain'] = 'Cette image apparaitra devant le nom du forum sur la page d\'index.';
	$lang['Forum_link_hit_count'] = 'Compter les appels';
	$lang['Forum_subs_hidden'] = 'Cacher la liste des sous-forums';
	$lang['Forum_subs_hidden_explain'] = 'Laisser cach� la liste des sous-forums qui appara�t sous les noms des forums sur la page d\'index.';

	$lang['Topics_per_page_explain'] = 'Choisissez 0 pour utiliser la valeur par d�faut d�finie par la configuration g�n�rale ou le choix de l\'utilisateur.';
	$lang['Topics_sort'] = 'Trier les sujets par';
	$lang['Topics_sort_explain'] = 'Choisissez la m�thode de tri des sujets pour ce forum. Choisissez "Aucun" pour utiliser la valeur par d�faut d�finie par la configuration g�n�rale ou les choix de l\'utilisateur.';
	$lang['Topics_split_in_box'] = 'Nouvelle bo�te';
	$lang['Topics_split_title_only'] = 'S�parer uniquement par un titre';
	$lang['Topics_split_global'] = 'S�parer les annonces g�n�rales des annonces normales';
	$lang['Topics_split_announces'] = 'S�parer les annonces des post-its et des sujets standards';
	$lang['Topics_split_stickies'] = 'S�parer les post-its des sujets standards';

	$lang['Index_layout'] = 'Pr�sentation des sous-forums';
	$lang['Last_topic_title_length'] = 'Longueur du titre du dernier sujet sur l\'index';
	$lang['Last_topic_title_length_explain'] = 'Choisissez la longueur en nombre de caract�res des titres des derniers messages affich�s sur la page d\'index, de mani�re � �viter une d�formation de celle-ci due � des titres trop long. Renseignez cette valeur � 0 si vous ne d�sirez pas raccourcir ces titres.';
	$lang['Override_user_choice'] = 'Passer outre le choix des utilisateurs';

	$lang['Board_box_content'] = 'Annonces du forum';
	$lang['Board_box_content_explain'] = 'Choisissez quel type d\'annonces vous souhaitez voir appara�tre dans la bo�te "Annonces du forum".';
	$lang['Do_not_display'] = 'Ne rien afficher';
	$lang['Global_Parent_announces'] = 'Annonces g�n�rales plus annonces des forums de rattachement';
	$lang['Global_Childs_announces'] = 'Annonces g�n�rales plus annonces des sous-forums';
	$lang['Global_Branch_announces'] = 'Annonces g�n�rales plus annonces de la section';

	$lang['Default_setup'] = 'Valeur par d�faut ou choix de l\'utilisateur';

	$lang['Forum_not_empty'] = 'Il reste des messages dans ce forum : d�placez les ou supprimez les avant de modifier le type de ce forum.';
	$lang['Root_delete_deny'] = 'Vous ne pouvez pas supprimer l\'index des forums.';
	$lang['Attach_to_link_denied'] = 'Vous ne pouvez pas d�placer le contenu d\'un forum vers un forum de type lien.';
	$lang['Empty_move_to'] = 'Choisissez un forum de destination pour le contenu du forum � supprimer, ou choisissez "Tout supprimer" pour d�truire ce contenu.';
	$lang['Forums_resync_done'] = 'Le forum et ses sous-forums ont �t� synchronis�s.';

	$lang['Copy'] = 'Copier';
	$lang['Details'] = 'D�tail';
	$lang['Group'] = 'Groupe';
	$lang['Selected'] = 'S�lectionn�';

	// caches management
	$lang['Caches'] = 'Caches';
	$lang['Cache_admin'] = 'Administration des caches';
	$lang['Cache_admin_explain'] = 'Vous pouvez ici activer, d�sactiver ou renouveler les caches utilis�s par le forum.';
	$lang['Click_return_cacheadmin'] = 'Cliquez %sici%s pour retourner � l\'administration des caches.';

	$lang['Table_caches'] = 'Caches g�n�riques';
	$lang['Template_cache'] = 'Cache des templates';
	$lang['Cache_path'] = 'R�pertoire des caches';
	$lang['Cache_path_explain'] = 'Chemin relatif � votre r�pertoire phpBB o� les fichiers caches seront stock�s, par exemple cache/.';
	$lang['Check_setup'] = 'Tester le r�pertoire';

	$lang['Cache_regen'] = 'R�g�n�rer le cache';
	$lang['Cache_last_generation'] = 'Derni�re r�g�n�ration';

	$lang['Enable_cache_config'] = 'Activer la mise en cache de la configuration';
	$lang['Enable_cache_forums'] = 'Activer la mise en cache des forums';
	$lang['Enable_cache_moderators'] = 'Activer la mise en cache de la liste des mod�rateurs';
	$lang['Enable_cache_topics_attr'] = 'Activer la mise en cache de la liste des titres des sujets';
	$lang['Enable_cache_themes'] = 'Activer la mise en cache des th�mes';
	$lang['Enable_cache_ranks'] = 'Activer la mise en cache des rangs';
	$lang['Enable_cache_words'] = 'Activer la mise en cache de la liste des mots censur�s';
	$lang['Enable_cache_smilies'] = 'Activer la mise en cache de la liste des �motic�nes';
	$lang['Enable_cache_icons'] = 'Activer la mise en cache de la liste des ic�nes de messages';
	$lang['Enable_cache_cp_patches'] = 'Activer la mise en cache des patchs sur les panneaux de contr�le';
	$lang['Enable_cache_cp_panels'] = 'Activer la mise en cache de la d�finition des panneaux de contr�le';
	$lang['Enable_cache_template'] = 'Activer la mise en cache des templates';
	$lang['Check_recent_tpl'] = 'V�rifier si les fichiers .tpl ont chang�';

	$lang['Cache_failed_config'] = 'La mise en cache de la configuration a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_forums'] = 'La mise en cache des forums a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_moderators'] = 'La mise en cache de la liste des mod�rateurs a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_topics_attr'] = 'La mise en cache des attributs de sujet a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_themes'] = 'La mise en cache des th�mes a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_ranks'] = 'La mise en cache des rangs a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_words'] = 'La mise en cache de la liste des mots censur�s a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_smilies'] = 'La mise en cache de la liste des �motic�nes a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_icons'] = 'La mise en cache de la liste des ic�nes de messages a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_cp_patches'] = 'La mise en cache des patchs sur les panneaux de contr�le a �chou�. Le cache a �t� d�sactiv�.';
	$lang['Cache_failed_cp_panels'] = 'La mise en cache de la d�finition des panneaux de contr�le a �chou�. Le cache a �t� d�sactiv�.';

	$lang['Cache_succeed_config'] = 'La mise en cache de la configuration a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_forums'] = 'La mise en cache des forums a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_moderators'] = 'La mise en cache de la liste des mod�rateurs a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_topics_attr'] = 'La mise en cache des attributs de sujet a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_themes'] = 'La mise en cache des th�mes a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_ranks'] = 'La mise en cache des rangs a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_words'] = 'La mise en cache de la liste des mots censur�s a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_smilies'] = 'La mise en cache de la liste des �motic�nes a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_icons'] = 'La mise en cache de la liste des ic�nes de messages a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_cp_patches'] = 'La mise en cache des patchs sur les panneaux de contr�le a abouti. Le cache a �t� activ�.';
	$lang['Cache_succeed_cp_panels'] = 'La mise en cache de la d�finition des panneaux de contr�le a abouti. Le cache a �t� activ�.';

	$lang['User_caches'] = 'Cache de niveau utilisateur';
	$lang['Cache_fauths'] = 'Permission d\'acc�s aux forums';
	$lang['Cache_fjbox'] = 'Liste d�roulante des forums';
	$lang['Cache_groups_list'] = 'Cache de la liste des groupes des utilisateurs';
	$lang['Groups_list_sync'] = 'La liste des groupes de chaque utilisateur a �t� resynchronis�e.';

	$lang['Board_stats_caches'] = 'Cache des statistiques d\'utilisation du forum';
	$lang['Total_topics'] = 'Total des sujets';
	$lang['Last_user'] = 'Dernier utilisateur enregistr�';
	$lang['Board_stats_sync'] = 'Les caches des statistiques d\'utilisation du forum ont �t� synchronis�s.';

	$lang['Check_results'] = 'Tester les r�sultats';
	$lang['Cache_path_not_found'] = 'Le r�pertoire des caches n\'a pas �t� trouv�. Le test s\'est arr�t� l� et les caches sur les tables ont �t� d�sactiv�s.';
	$lang['Cache_path_found'] = 'Le r�pertoire de stockage des caches a �t� trouv�.';
	$lang['Cache_create_unavailable'] = 'La cr�ation de nouveaux caches n\'est pas disponible sur votre syst�me.';
	$lang['Cache_filelist'] = 'T�l�chargez dans le r�pertoire des caches des fichiers vides nomm�s : %s, et appliquez un CHMOD 666 dessus. Les caches non disponibles ont �t� d�sactiv�s.';
	$lang['Cache_sysfile_missing'] = 'Le fichier "sys_tests.dta" n�cessaire aux tests n\'a pas �t� trouv�. T�l�chargez le dans le r�pertoire des caches, et appliquez un CHMOD 666 dessus. Le test s\'est arr�t�.';
	$lang['Cache_write_disabled'] = 'Le programme n\'a pas �t� en mesure de r�inscrire le fichier de test (%s). Ajustez le CHMOD du fichier et/ou du r�pertoire � 666 au moins. Le test s\'est arr�t� ici et les caches non disponibles ont �t� d�sactiv�s.';
	$lang['Cache_io_unavailable'] = 'Le programme n\'a pas �t� en mesure de r�inscrire ou de lire le fichier de test (%s). Les caches non disponibles ont �t� d�sactiv�s.';
	$lang['Cache_successfull'] = 'Tous les tests ont �t� pass�s avec succ�s. Vous pouvez activer les caches sur les tables.';

	$lang['Cache_regenerated'] = 'Le cache a �t� marqu� pour r�g�n�ration.';
	$lang['Cache_setup_updated'] = 'La configuration des caches a �t� mise � jour.';

	// message icon admin
	$lang['Icons_settings'] = 'Ic�nes de message';
	$lang['Icons_admin'] = 'Gestion des ic�nes de message';
	$lang['Icons_admin_explain'] = 'Vous pouvez ici �diter, supprimer, cr�er et trier les ic�nes utilis�es devant le titre des messages.';
	$lang['Icons_create'] = 'Ajouter une ic�ne de messages';
	$lang['Icons_create_explain'] = 'Ici vous pouvez ajouter une nouvelle ic�ne de messages.';
	$lang['Icons_edit'] = 'Editer une ic�ne de messages';
	$lang['Icons_edit_explain'] = 'Ici vous pouvez modifier la d�finition d\'une ic�ne de messages et de ses privil�ges.';
	$lang['Icons_delete'] = 'Supprimer une ic�ne de messages';
	$lang['Icons_delete_explain'] = 'Ici vous pouvez supprimer la d�finition d\'une ic�ne de messages.';

	$lang['Icons_box'] = 'Pr�visualisation du choix des ic�nes lors de la cr�ation d\'un message';
	$lang['Icons_types'] = 'Par d�faut pour';
	$lang['Icons_usage'] = 'Utilisation';
	$lang['No_icons_create'] = 'Aucune ic�ne n\'est disponible. Cliquez sur "Cr�er" pour en ajouter une.';

	$lang['Icon_not_exists'] = 'Cette ic�ne n\'existe pas.';
	$lang['Click_return_iconsadmin'] = 'Cliquez %sici%s pour retourner � la gestion des ic�nes de messages.';

	$lang['Icon_name'] = 'Nom de l\'ic�ne';
	$lang['Icon_name_explain'] = 'Vous pouvez utiliser une cl� du tableau $lang[] (cf. language/lang_<i>votre_language</i>/lang_*.php), ou entrer le nom en clair.';
	$lang['Icon_url'] = 'URI de l\'ic�ne';
	$lang['Icon_url_explain'] = 'Choisissez une ic�ne dans la liste d�roulante.';
	$lang['Icon_auth'] = 'Autorisation n�cessaire';
	$lang['Icon_auth_explain'] = 'Choisissez quelle autorisation sera n�cessaire pour utiliser cette ic�ne.';
	$lang['Icon_types'] = 'Ic�ne par d�faut par type de sujets';
	$lang['Icon_types_explain'] = 'Choisissez pour quel type de sujets cette ic�ne sera utilis�e par d�faut lorsqu\'aucune n\'aura �t� choisie par l\'auteur du message.';
	$lang['Icon_replace'] = 'Remplacer par l\'ic�ne';
	$lang['Icon_replace_explain'] = 'Choisissez une ic�ne pour remplacer dans les messages celle � supprimer. Choisissez "Aucun" si vous ne d�sirez pas les remplacer par une autre.';
	$lang['Icon_after'] = 'Positionner cette ic�ne apr�s';

	$lang['Icon_created'] = 'L\'ic�ne a �t� ajout�e.';
	$lang['Icon_edited'] = 'L\'ic�ne a �t� mise � jour.';
	$lang['Icon_deleted'] = 'L\'ic�ne a �t� supprim�e.';

	$lang['Top'] = '___ D�but ___';

	// topics attributes admin
	$lang['Topics_attr_settings'] = 'Attributs de sujet';
	$lang['Topics_attr_admin'] = 'Gestion des attributs de sujet';
	$lang['Topics_attr_admin_explain'] = 'Ici vous pouvez modifier, supprimer, cr�er et trier les libell�s et ic�nes utilis�s devant le titre des sujets.';
	$lang['Topics_attr_create'] = 'Cr�er un attribut de sujet';
	$lang['Topics_attr_create_explain'] = 'Ici vous pouvez cr�er un nouvel attribut de sujet. Vous pouvez utiliser les cl�s du tableau $lang[] pour les l�gendes. Les images seront choisies parmis celles enregistr�es dans le tableau $images[] (voir templates/<i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['Topics_attr_edit'] = 'Modifier un attribut de sujet';
	$lang['Topics_attr_edit_explain'] = 'Ici vous pouvez modifier la d�finition et les droits d\'un attribut de sujet. Les images seront choisies parmis celles enregistr�es dans le tableau $images[] (voir templates/<i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['Topics_attr_delete'] = 'Supprimer un attribut de sujet';
	$lang['Topics_attr_delete_explain'] = 'Ici vous pouvez supprimer un attribut de sujet.';

	$lang['Topics_attr_folder'] = 'Ic�nes principales';
	$lang['Topics_attr_title'] = 'Titre';
	$lang['Topics_attr_name'] = 'Nom de l\'attribut';
	$lang['Topics_attr_name_explain'] = 'Renseignez ici le nom de l\'attribut de sujet que vous voulez voir apparaitre dans les listes d�roulantes.';
	$lang['Topics_attr_fname'] = 'Libell� souris';
	$lang['Topics_attr_fname_explain'] = 'Renseignez ici le nom de l\'attribut de sujet qui apparait lorsque la souris passe sur l\'ic�ne principale.';
	$lang['Topics_attr_fimg'] = 'Ic�ne principale';
	$lang['Topics_attr_fimg_explain'] = 'Choisissez l\'ic�ne principale qui sera utilis�e lorsque la condition sera remplie.';
	$lang['Topics_attr_tname'] = 'Etiquette';
	$lang['Topics_attr_tname_explain'] = 'Renseignez ici le libell� de l\'�tiquette qui sera ajout�e au titre du sujet.';
	$lang['Topics_attr_timg'] = 'Ic�ne �tiquette';
	$lang['Topics_attr_timg_explain'] = 'Lorsque fournie, cette ic�ne sera utilis�e � la place de l\'�tiquette.';
	$lang['Topics_attr_field'] = 'Condition d\'utilisation';
	$lang['Topics_attr_field_explain'] = 'Renseignez ici la condition sous laquelle l\'attribut de sujet sera retenu.';
	$lang['Topics_attr_auth'] = 'Autorisation n�cessaire';
	$lang['Topics_attr_auth_explain'] = 'Choisissez quelle autorisation sera n�cessaire pour utiliser cet attribut. Cette derni�re n\'est utilis�e que pour les sous-types de sujet.';

	$lang['Topics_attr_ttype'] = 'Type de sujet';
	$lang['Topics_attr_tsubtype'] = 'Sous-type de sujet';
	$lang['Topics_attr_tmoved'] = 'Sujet traceur';
	$lang['Topics_attr_tstatus'] = 'Sujet verrouill�';
	$lang['Topics_attr_tvote'] = 'Sondage';
	$lang['Topics_attr_tattach'] = 'Sujet avec des fichiers joints';
	$lang['Topics_attr_tcalendar'] = 'Ev�nement du calendrier';

	$lang['Topics_attr_after'] = 'La priorit� de l\'ic�ne principale est juste inf�rieure �';
	$lang['Topics_attr_replace'] = 'Remplacer par l\'attribut de sujet';
	$lang['Topics_attr_replace_explain'] = 'Choisissez un sous-type pour remplacer celui � supprimer sur les sujets. Choisissez "Aucun" si vous ne d�sirez pas le remplacer : il sera alors supprim� des sujets.';

	$lang['Topics_attr_not_exists'] = 'Cet attribut de sujet n\'existe pas.';
	$lang['Topics_attr_created'] = 'L\'attribut de sujet a �t� cr��.';
	$lang['Topics_attr_edited'] = 'L\'attribut de sujet a �t� modifi�.';
	$lang['Topics_attr_deleted'] = 'L\'attribut de sujet a �t� supprim�.';

	$lang['Click_return_topics_attr_admin'] = 'Cliquez %sici%s pour retourner � la gestion des attributs de sujet.';

	// styles management
	$lang['Submit_styles'] = 'Valider le th�me';
	$lang['Images_pack'] = 'Pack d\'images';
	$lang['Images_pack_explain'] = 'Saisissez ici le nom du fichier <i>template</i>.cfg dans lequel est stock� la d�finition des images que vous d�sirez utiliser (par exemple: <i>subSilver/subSilver.cfg</i>).<br />Laissez ce champ vide pour utiliser le fichier par d�faut du template.';
	$lang['Custom_tpls'] = 'R�pertoire des fichiers personnalis�s';
	$lang['Custom_tpls_explain'] = 'Saisissez le r�pertoire dans lequel sont stock�s les fichiers .tpl personnalis�s que vous d�sirez utiliser (par exemple, si ces fichiers se trouvent dans <i>templates/subSilver/customs</i>, saisissez <i>customs</i>).<br />Laissez ce champ vide si vous n\'utilisez pas de fichier .tpl personnalis�.';
	$lang['Stylesheet_explain'] = 'Nom du fichier contenant la d�finition de la feuille de style (.css) utilis�e pour ce th�me.';
	$lang['Images_pack_not_found'] = 'Le pack d\'images n\'a pas �t� trouv�.';
	$lang['Custom_tpls_not_found'] = 'Le r�pertoire des fichiers .tpl personnalis�s n\'a pas �t� trouv�.';
	$lang['Head_stylesheet_not_found'] = 'Le fichier contenant la d�finition de la feuille de style (.css) n\'a pas �t� trouv�.';

	// panels
	$lang['Admin_control_panel'] = 'Panneau de gestion de la configuration (ACP)';
	$lang['User_control_panel'] = 'Panneau de contr�le utilisateur';
	$lang['Group_control_panel'] = 'Panneau de contr�le des groupes';

	// config
	$lang['Topics_options'] = 'Options des sujets';
	$lang['Messages_options'] = 'Options de lecture';
	$lang['Click_return_msgopt'] = 'Cliquez %sici%s pour retourner aux options de lecture.';
	$lang['Click_return_topicopt'] = 'Cliquez %sici%s pour retourner aux options des sujets.';
	$lang['Click_return_layout'] = 'Cliquez %sici%s pour retourner aux options de pr�sentation des sous-forums.';
	$lang['Keep_unreads_explain'] = 'Choisissez "Oui" pour conserver l\'indicateur "message non lu" dans un cooky, "Stock�s dans la base de donn�e" pour les m�moriser sur le profil utilisateur.';
	$lang['Keep_unreads_in_db'] = 'Stock�s dans la base de donn�es';
	$lang['Icons_path'] = 'R�pertoire des ic�nes de messages';
	$lang['Icons_path_explain'] = 'La valeur initiale est "images/icons/".';
	$lang['Default_duration'] = 'Dur�e par d�faut d\'une annonce';
	$lang['Default_duration_explain'] = 'Dur�e par d�faut propos�e lors de la cr�ation d\'une nouvelle annonce.';
	$lang['Site_fav_icon'] = 'Ic�ne du site pour les favoris des navigateurs ("favicon")';
	$lang['Site_fav_icon_explain'] = 'Cette ic�ne apparaitra dans les "favoris" du navigateur de vos visiteurs devant le nom de votre site. Elle doit �tre un fichier .ico, de taille 16x16 pixels.';
	$lang['Pagination_min'] = 'Nombre minimal de pages dans la pagination';
	$lang['Pagination_max'] = 'Nombre maximal de pages dans la pagination';
	$lang['Pagination_percent'] = 'Pourcentage de pages dans la pagination';

	// sub-title
	$lang['Topic_title_length'] = 'Longueur du titre du sujet sur l\'index';
	$lang['Topic_title_length_explain'] = 'Choisissez la longueur en nombre de caract�res des titres des messages affich�s sur la page d\'index et les forums.';
	$lang['Sub_title_length'] = 'Longueur du sous-titre (description) du sujet sur l\'index';
	$lang['Sub_title_length_explain'] = 'Choisissez la longueur en nombre de caract�res des sous-titres (description) des messages affich�s sur la page d\'index et les forums. Renseignez cette valeur � 0 si vous ne d�sirez pas afficher les sous-titres.';

	// versions check
	$lang['version_checked'] = '&nbsp;&nbsp;&nbsp;&raquo; <b>%s</b>: version que vous utilisez: <b>%s</b>, derni�re version disponible: <b>%s</b>.';
	$lang['version_not_checked'] = '&nbsp;&nbsp;&nbsp;&raquo; <b>%s</b>: version que vous utilisez: <b>%s</b>.';
	$lang['Unknown'] = 'Inconnue';
}

//
// lang_main
//

// generic
$lang['No_valid_action'] = 'L\'action que vous essayez de r�aliser n\'est pas reconnue.';
$lang['User_delete_deny'] = 'Vous n\'�tes pas autoris� � supprimer cet utilisateur.';
$lang['Auth_read_required'] = 'Seuls les utilisateurs disposant de droits sp�ciaux peuvent acc�der aux messages de ce forum.';
$lang['Registration_required'] = 'Vous devez vous enregistrer pour acc�der aux messages de ce forum.';

// index display
$lang['Cat_no_subs'] = 'Cette cat�gorie n\'a pas de sous-forum rattach�.';
$lang['Click_return_parent'] = 'Cliquez %sici%s pour retourner au forum de rattachement.';
$lang['View_group'] = 'Voir les informations sur le groupe';
$lang['Subforums'] = 'Sous-forums';
$lang['Link'] = 'Lien';
$lang['Forum_link_visited'] = 'Ce lien a �t� visit� %d fois <br />depuis %s';
$lang['Board_announces'] = 'Annonces du forum';

$lang['Important_topics'] = 'Messages importants';
$lang['Global_Announces'] = 'Annonces g�n�rales';
$lang['Announces'] = 'Annonces';
$lang['Stickies'] = 'Post-its';

$lang['Post_Global_Announcement'] = 'Annonce g�n�rale';

$lang['Hot_topic'] = 'Populaire';
$lang['Own_topic'] = 'Vous avez particip� � cette discussion';

$lang['Topic_Moved'] = 'D�plac�';
$lang['Topic_Poll'] = 'Sondage';
$lang['Topic_Locked'] = 'Verrouill�';
$lang['Topic_Global_Announcement'] = 'Annonce g�n�rale';
$lang['Topic_Announcement'] = 'Annonce';
$lang['Topic_Sticky'] = 'Post-it';
$lang['Topic_Attached'] = 'Fichier joint';

$lang['First_Post'] = 'Premier message';
$lang['No_topics'] = 'Il n\'y a pas de message dans ce forum.';
$lang['Topics_count'] = '[%s sujets]';
$lang['Posts_count'] = '[%s messages]';
$lang['Topics_count_1'] = '[%s sujet]';
$lang['Posts_count_1'] = '[%s message]';

$lang['Legend'] = 'L�gende';
$lang['Not_available'] = 'Non disponible';

$lang['Announce_ends'] = 'Date de fin de l\'annonce: %s';

// date extended
$lang['Today'] = 'Aujourd\'hui';
$lang['Yesterday'] = 'Hier';
$lang['Today_at'] = 'Aujourd\'hui, � %s';
$lang['Yesterday_at'] = 'Hier, � %s';

// auto form error messages
$lang['empty_error'] = 'la valeur doit �tre renseign�e.';
$lang['length_mini_error'] = 'la valeur est trop courte.';
$lang['length_maxi_error'] = 'la valeur est trop longue.';
$lang['value_mini_error'] = 'la valeur est trop petite.';
$lang['value_maxi_error'] = 'la valeur est trop grande.';
$lang['options_error'] = 'la valeur choisie n\'est pas disponible dans la liste.';
$lang['options_empty_error'] = 'aucune valeur n\'est disponible pour ce champ.';
$lang['url_error'] = 'ce n\'est pas une URL valide.';
$lang['Date_not_valid'] = 'ce n\'est pas une date valide.';
$lang['Not_a_valid_directory'] = 'ce n\'est pas un r�pertoire valide.';
$lang['Not_a_valid_script'] = 'ce n\'est le nom d\'un script valide.';
$lang['Only_numeric_allowed'] = 'seuls les caract�res num�riques sont autoris�s.';

// tree drawing
$lang['tree_pic_' . TREE_HSPACE] = '&nbsp;&nbsp;&nbsp;&nbsp;';
$lang['tree_pic_' . TREE_VSPACE] = '|&nbsp;&nbsp;&nbsp;';
$lang['tree_pic_' . TREE_CROSS] = '|___';
$lang['tree_pic_' . TREE_CLOSE] = '|___';

// modcp
$lang['Move_to_forum_error'] = 'Le forum de destination que vous avez choisi est une cat�gorie ou un lien, il ne peut donc pas accueillir de messages.';

// search
$lang['No_such_forum'] = 'Ce forum n\'existe pas. Merci de choisir dans la liste un forum existant.';
$lang['Search_in_forum'] = 'Recherche dans le forum';
$lang['Search_no_subs'] = 'Ne pas inclure les sous-forums dans le champ de recherche';

// posting
$lang['Message_icon'] = 'Ic�nes de message';
$lang['No_icon'] = 'Aucune ic�ne';
$lang['Topic_duration'] = 'Date de fin de l\'annonce';
$lang['Topic_duration_explain'] = 'Il s\'agit de la date � partir de laquelle une annonce cessera d\'appara�tre dans les autres forums comme une annonce g�n�rale ou une annonce des forums.';
$lang['Topic_duration_special'] = 'Choisissez "Jamais affich�e" pour ne jamais afficher cette annonce ailleurs que sur son forum d\'origine. <br />Choisissez "Toujours affich�e" pour ne pas que l\'annonce prenne fin.';
$lang['Never_displayed'] = 'Jamais affich�e';
$lang['Always_displayed'] = 'Toujours affich�e';
$lang['New_post_meanwhile_reply'] = 'Un nouveau message a �t� post� pendant que vous r�digiez le v�tre. V�rifiez la revue du sujet sur cette page, puis ressoumettez-le.';
$lang['New_post_meanwhile_edit'] = 'Un nouveau message a �t� post� ou le dernier message a �t� supprim� pendant que vous r�digiez le v�tre.';

// icons title
$lang['icon_none'] = 'Aucune ic�ne';
$lang['icon_note'] = 'Note';
$lang['icon_important'] = 'Important';
$lang['icon_idea'] = 'Id�e';
$lang['icon_warning'] = 'Attention !';
$lang['icon_question'] = 'Question';
$lang['icon_cool'] = 'D�tente';
$lang['icon_funny'] = 'Marrant';
$lang['icon_angry'] = 'Grrrr !';
$lang['icon_sad'] = 'Snif !';
$lang['icon_mocker'] = 'H�h�h� !';
$lang['icon_shocked'] = 'Oooh !';
$lang['icon_complicity'] = 'Complice';
$lang['icon_bad'] = 'Nul !';
$lang['icon_great'] = 'G�nial !';
$lang['icon_disgusting'] = 'Beurk !';
$lang['icon_winner'] = 'Gniark !';
$lang['icon_impressed'] = 'Ah oui !';
$lang['icon_roleplay'] = 'Histoire';
$lang['icon_fight'] = 'Combat';
$lang['icon_loot'] = 'Butin';
$lang['icon_picture'] = 'Image';
$lang['icon_calendar'] = 'Ev�nement du calendrier';

// settings
$lang['No_options'] = 'Aucune option n\'est disponible.';
$lang['Click_return_prefs'] = 'Cliquez %sici%s pour retourner au r�glage de vos pr�f�rences.';
$lang['Topic_read'] = 'Lecture des sujets';
$lang['Board_layout'] = 'Pr�sentation du forum';
$lang['Default'] = 'D�faut';
$lang['Keep_unreads'] = 'Se souvenir des messages non lus';
$lang['Keep_unreads_dft_explain'] = 'Choisissez "Oui" pour retrouver � votre prochaine visite les messages non lus marqu�s comme tels.';
$lang['Topics_sort'] = 'Trier les sujets par';
$lang['Topics_sort_dft_explain'] = 'Choisissez la m�thode de tri des sujets dans les forums.';
$lang['Smart_date'] = 'Hier/aujourd\'hui';
$lang['Smart_date_explain'] = 'Afficher "Hier" et "Aujourd\'hui" plut�t que la date dans les messages.';
$lang['Board_box_display'] = 'Afficher les annonces des forums';
$lang['Index_pack'] = 'R�duire l\'affichage des sous-cat�gories';
$lang['Index_pack_explain'] = 'Lorsqu\'activ�, les sous-cat�gories appara�tront sous la forme de forums.';
$lang['Index_split'] = 'S�parer les sous-cat�gories';
$lang['Index_split_explain'] = 'Lorsqu\'activ�, les cat�gories sont s�par�es les unes des autres. NB.: ce r�glage est rendu inactif par la r�duction de l\'affichage des sous-cat�gories.';

// standard prefs
$lang['Internationalisation'] = 'Internationalisation';
$lang['Posting_messages'] = 'Options de postage';
$lang['Privacy_choices'] = 'Options de confidentialit�';

// user levels
$lang['Administrator'] = 'Administrateur';
$lang['User'] = 'Utilisateur';

// stats extended
$lang['Past_guests'] = 'D�compte des visites des invit�s';
$lang['Stats_display_past'] = 'Afficher l\'historique des visites sur la page d\'index';

$lang['Past_users_zero_total'] = 'Il n\'y a pas eu de visites durant les derni�res 24 heures :: ';
$lang['Past_user_total'] = 'Il y a eu une visite durant les derni�res 24 heures :: ';
$lang['Past_users_total'] = 'Il y a eu <b>%d</b> visiteurs durant les derni�res 24 heures :: ';

$lang['Hour_users_zero_total'] = 'Il n\'y a pas eu de visite durant l\'heure en cours :: ';
$lang['Hour_user_total'] = 'Il y a eu un visiteur durant l\'heure en cours :: ';
$lang['Hour_users_total'] = 'Il y a eu <b>%d</b> visiteurs durant l\'heure en cours :: ';
$lang['Hour_visits'] = '(%s durant l\'heure en cours)';

// unmark topics
$lang['Topic_unmarked_read'] = 'Le sujet a �t� marqu� comme non lu.';
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
$lang['Stat_queries_total'] = 'Requ�tes: %2d (%.4fs)';
$lang['Stat_queries_db'] = 'bd: %2d (%.4fs)';
$lang['Stat_queries_cache'] = 'cache: %2d (%.4fs/%.4fs)';
$lang['Stat_gzip_enable'] = 'GZIP activ�';
$lang['Stat_debug_enable'] = 'D�boguage activ�';
$lang['Stat_request'] = 'Requ�te';
$lang['Stat_line'] = 'Ligne:&nbsp;%d';
$lang['Stat_cache'] = 'cache:&nbsp;%.4fs';
$lang['Stat_db'] = 'bd:&nbsp;%.4fs';
$lang['Stat_table'] = 'Table';
$lang['Stat_type'] = 'Type';
$lang['Stat_possible_keys'] = 'Cl�s possibles';
$lang['Stat_key'] = 'Cl� utilis�e';
$lang['Stat_key_len'] = 'Longueur';
$lang['Stat_ref'] = 'R�f.';
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
$lang['dbg_backtrace'] = 'Trace/Rapport des op�rations';
$lang['dbg_requester'] = 'Demandeur';

// operand
$lang['Less'] = 'Moins que';
$lang['Less_equal'] = 'Moins ou �gal �';
$lang['Equal'] = 'Egal �';
$lang['Greater_equal'] = 'Plus grand ou �gal �';
$lang['Greater'] = 'Plus grand que';
$lang['Not_equal'] = 'Diff�rent de';

// topic title attribute
$lang['Topic_sub_type'] = 'Ajouter une �tiquette au sujet';

// calendar
$lang['Topic_calendar'] = 'Ev�nement';

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
$lang['dst'] = 'Heure d\'�t�';
$lang['dst_explain'] = 'Ajuster l\'heure pour l\'�t� (ajoute 1 heure en �t�).';
$lang['tz_suggest'] = 'Synchroniser';
$lang['tz_suggest_explain'] = 'Essayer de trouver votre format d\'heure le plus finement possible';

//---------------------------
//------- AJOUT ATTRIBUTS ---
//---------------------------
$lang['attr_coeur'] = '[Coup de Coeur]';
$lang['attr_prise'] = '[Electrique]';
$lang['attr_couleur'] = '[haut en couleur]';
$lang['attr_img'] = '[vid�o(s)]';
$lang['attr_lien'] = '[Lien cool]';
$lang['att_son'] = '[Bon son]';
$lang['att_ann'] = 'Annul�';
$lang['att_attn'] = 'En Attente';
$lang['att_cours'] = '[A Voir]';
$lang['att_info'] = '[INFO]';
$lang['att_inst'] = '[Travaux]';
$lang['att_jeu'] = '[Sympa]';
$lang['att_list'] = '[Listing]';
$lang['att_pub'] = '[Lecture]';
$lang['att_rea'] = '[R�alisation]';
$lang['att_tem'] = '[Peinture/Dessin]';
$lang['att_son2'] = '[Transf�r�]';
$lang['att_valid'] = '[Num�rique]';
?>