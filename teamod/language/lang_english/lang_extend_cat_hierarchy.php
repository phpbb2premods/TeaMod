<?php
/***************************************************************************
 *						lang_extend_cat_hierarchy.php [English]
 *						---------------------------------------
 *	begin				: 08/10/2004
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.12 - 21/08/2005
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

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_cat_hierarchy'] = 'Categories Hierarchy';
	$lang['Extended_template_CH'] = 'Extended template CH edition';

	// admin_forums
	$lang['01_Manage'] = 'Management';
	$lang['02_Styles'] = 'Styles';
	$lang['03_Prune'] = 'Pruning';
	$lang['Configuration+'] = 'Configuration +';

	$lang['View_details'] = 'View details';
	$lang['change_view'] = 'Change view';
	$lang['Forum_edit_explain'] = 'The form below will allow you to edit a forum (or category).';
	$lang['Forum_create_explain'] = 'The form below will allow you to create a forum (or category).';
	$lang['Forum_type'] = 'Forum type';
	$lang['Forum_main'] = 'Parent forum';
	$lang['Forum_order'] = 'Position this forum after';
	$lang['Move_contents_explain'] = 'Choose a forum to where move all contents (topics and sub-forums).';
	$lang['Forum_style'] = 'Style used to display this forum';
	$lang['Forum_style_explain'] = 'This style will be used in place of the user or default style. Choose "None" if you don\'t want to override them.';
	$lang['Images'] = 'Images';
	$lang['Images_explain'] = 'You can use either an url or an images[] key entry (check template/<i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['Forum_nav_icon'] = 'Navigation icon';
	$lang['Forum_nav_icon_explain'] = 'This icon will appear in front of the forum name in the navigation sentences (Forum index &raquo forum 1 &raquo ...).';
	$lang['Forum_icon'] = 'Forum image';
	$lang['Forum_icon_explain'] = 'This image will appear in front of the forum name in the forum cell of the index page.';
	$lang['Forum_link_hit_count'] = 'Count forum hits';
	$lang['Forum_subs_hidden'] = 'Hide sub-forums list';
	$lang['Forum_subs_hidden_explain'] = 'Allow to hide the sub-forums list appearing under the forum name in the forum cell of the index page.';

	$lang['Topics_per_page_explain'] = 'Set the value to 0 to use the default configuration or user choice.';
	$lang['Topics_sort'] = 'Sort topics by';
	$lang['Topics_sort_explain'] = 'Select the sort method you want for this forum. Leave "None" to use the default or the user settings.';
	$lang['Topics_split_in_box'] = 'New box';
	$lang['Topics_split_title_only'] = 'Split with only a title row header';
	$lang['Topics_split_global'] = 'Split global announcements from regular announcements';
	$lang['Topics_split_announces'] = 'Split Announcements from regular et sticky topics';
	$lang['Topics_split_stickies'] = 'Split Stickies from regular topics';

	$lang['Index_layout'] = 'Sub-forums Layout';
	$lang['Last_topic_title_length'] = 'Title length of the last topic on index';
	$lang['Last_topic_title_length_explain'] = 'Set the number of chars you want to display for the last topic title on index to prevent the layer to be screw with too long titles. Set it to 0 if you don\'t want to cut the titles.';
	$lang['Override_user_choice'] = 'Override user choice';

	$lang['Board_box_content'] = 'Board announcements setup';
	$lang['Board_box_content_explain'] = 'Choose what kind of announcements you want to display in the board announcements box.';
	$lang['Do_not_display'] = 'Do not display';
	$lang['Global_Parent_announces'] = 'Global and parent-forums announcements';
	$lang['Global_Childs_announces'] = 'Global and sub-forums announcements';
	$lang['Global_Branch_announces'] = 'Global and whole-section announcements';

	$lang['Default_setup'] = 'Default configuration or user choice';

	$lang['Forum_not_empty'] = 'There is still topics standing in this forum : move or delete them before changing the type.';
	$lang['Root_delete_deny'] = 'You can not delete the forum index.';
	$lang['Attach_to_link_denied'] = 'You can not move contents to a link.';
	$lang['Empty_move_to'] = 'Please choose a forum to move contents or "Delete All" to delete them.';
	$lang['Forums_resync_done'] = 'The forum and its sub-forums have been re-synchronised.';

	$lang['Copy'] = 'Copy';
	$lang['Details'] = 'Details';
	$lang['Group'] = 'Group';
	$lang['Selected'] = 'Selected';

	// caches management
	$lang['Caches'] = 'Caches';
	$lang['Cache_admin'] = 'Caches administration';
	$lang['Cache_admin_explain'] = 'Here you can enable, disabled or renew data caches used by the board.';
	$lang['Click_return_cacheadmin'] = 'Click %sHere%s to return to the caches administration.';

	$lang['Table_caches'] = 'Generic level caches';
	$lang['Template_cache'] = 'Template Cache';
	$lang['Cache_path'] = 'Caches directory';
	$lang['Cache_path_explain'] = 'Path under your phpBB root directory where will stand the cache files, e.g. cache/';
	$lang['Check_setup'] = 'Check the directory';

	$lang['Cache_regen'] = 'Regenerate the cache';
	$lang['Cache_last_generation'] = 'Data last regeneration';

	$lang['Enable_cache_config'] = 'Enable config table cache';
	$lang['Enable_cache_forums'] = 'Enable forums table cache';
	$lang['Enable_cache_moderators'] = 'Enable moderators list cache';
	$lang['Enable_cache_topics_attr'] = 'Enable topic title attributes list cache';
	$lang['Enable_cache_themes'] = 'Enable themes table cache';
	$lang['Enable_cache_ranks'] = 'Enable ranks table cache';
	$lang['Enable_cache_words'] = 'Enable words censorship table cache';
	$lang['Enable_cache_smilies'] = 'Enable smilies table cache';
	$lang['Enable_cache_icons'] = 'Enable icons table cache';
	$lang['Enable_cache_cp_patches'] = 'Enable installed control panels patches table cache';
	$lang['Enable_cache_cp_panels'] = 'Enable control panels definitions table cache';
	$lang['Enable_cache_template'] = 'Enable cache template';
	$lang['Check_recent_tpl'] = 'Check if .tpl files have changed';

	$lang['Cache_failed_config'] = 'Config table cache failed. The cache has been disabled.';
	$lang['Cache_failed_forums'] = 'Forums table cache failed. The cache has been disabled.';
	$lang['Cache_failed_moderators'] = 'Moderators list cache failed. The cache has been disabled.';
	$lang['Cache_failed_topics_attr'] = 'Topic title attributes list cache failed. The cache has been disabled.';
	$lang['Cache_failed_themes'] = 'Themes table cache failed. The cache has been disabled.';
	$lang['Cache_failed_ranks'] = 'Ranks table cache failed. The cache has been disabled.';
	$lang['Cache_failed_words'] = 'Words censorship table cache failed. The cache has been disabled.';
	$lang['Cache_failed_smilies'] = 'Smilies table cache failed. The cache has been disabled.';
	$lang['Cache_failed_icons'] = 'Icons table cache failed. The cache has been disabled.';
	$lang['Cache_failed_cp_patches'] = 'Installed control panels patches table cache failed. The cache has been disabled.';
	$lang['Cache_failed_cp_panels'] = 'Control panels definitions table cache failed. The cache has been disabled.';

	$lang['Cache_succeed_config'] = 'Config table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_forums'] = 'Forums table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_moderators'] = 'Moderators list cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_topics_attr'] = 'Topic title attributes list cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_themes'] = 'Themes table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_ranks'] = 'Ranks table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_words'] = 'Words censorship table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_smilies'] = 'Smilies table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_icons'] = 'Icons table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_cp_patches'] = 'Installed control panels patches table cache succeed. The cache has been enabled.';
	$lang['Cache_succeed_cp_panels'] = 'Control panels definitions table cache succeed. The cache has been enabled.';

	$lang['User_caches'] = 'User level caches';
	$lang['Cache_fauths'] = 'Forums access permissions cache';
	$lang['Cache_fjbox'] = 'Forums jumpbox cache';
	$lang['Cache_groups_list'] = 'Groups membership cache';
	$lang['Groups_list_sync'] = 'The users groups membership caches have been synchronised.';

	$lang['Board_stats_caches'] = 'Board statistics caches';
	$lang['Total_topics'] = 'Total topics';
	$lang['Last_user'] = 'Last registered user';
	$lang['Board_stats_sync'] = 'The board statistics caches have been synchronised.';

	$lang['Check_results'] = 'Check results';
	$lang['Cache_path_not_found'] = 'The cache directory was not found. The check has ended there, and the generic level caches has been disabled.';
	$lang['Cache_path_found'] = 'The cache directory was found.';
	$lang['Cache_create_unavailable'] = 'The creation of new caches is not available on your system.';
	$lang['Cache_filelist'] = 'Please upload empty files named: %s, and CHMOD them to 666. Unavailable caches has been for now disallowed.';
	$lang['Cache_sysfile_missing'] = 'The file "sys_tests.dta" dedicated to tests has not been found. Please upload it to your system and CHMOD it to 666. The check has ended there.';
	$lang['Cache_write_disabled'] = 'The script wasn\'t able to write onto the test file (%s). Please adjust the CHMOD for the file and/or the directory (it should be at least 644). The check has ended there, unavailable caches has been for now disallowed.';
	$lang['Cache_io_unavailable'] = 'The script wasn\'t able to write or read the test file (%s). Unavailable caches has been for now disallowed.';
	$lang['Cache_successfull'] = 'All tests has been passed successfully. You can use the table caches.';

	$lang['Cache_regenerated'] = 'The cache has been marked for regeneration.';
	$lang['Cache_setup_updated'] = 'The caches setup has been updated.';

	// message icon admin
	$lang['Icons_settings'] = 'Message icons';
	$lang['Icons_admin'] = 'Message icons management';
	$lang['Icons_admin_explain'] = 'Here you can edit, delete, create and re-order icons used in front of messages title.';
	$lang['Icons_create'] = 'Create a message icon';
	$lang['Icons_create_explain'] = 'Here you register a new icon for the messages.';
	$lang['Icons_edit'] = 'Edit a message icon';
	$lang['Icons_edit_explain'] = 'Here you can modify the message icon definition and priviledges.';
	$lang['Icons_delete'] = 'Delete a message icon';
	$lang['Icons_delete_explain'] = 'Here you can delete a message icon.';

	$lang['Icons_box'] = 'Sample of posting box';
	$lang['Icons_types'] = 'Default for';
	$lang['Icons_usage'] = 'Usage';
	$lang['No_icons_create'] = 'No icons are available for the messages. Please hit "Create" to add some.';

	$lang['Icon_not_exists'] = 'This icon does not exist';
	$lang['Click_return_iconsadmin'] = 'Click %sHere%s to return to Message icons administration.';

	$lang['Icon_name'] = 'Icon name';
	$lang['Icon_name_explain'] = 'You can use a lang entry key (check your language/lang_<i>your_language</i>/lang_*.php), or enter directly the icon name.';
	$lang['Icon_url'] = 'Icon URI';
	$lang['Icon_url_explain'] = 'Pick up an icon in the dropw down list.';
	$lang['Icon_auth'] = 'Authorisation required';
	$lang['Icon_auth_explain'] = 'Choose which authorisation will be required to use this icon.';
	$lang['Icon_types'] = 'Default for topic type';
	$lang['Icon_types_explain'] = 'Choose for which topic types this icon will be displayed when none has been choosen by the poster.';
	$lang['Icon_replace'] = 'Replace with icon';
	$lang['Icon_replace_explain'] = 'Choose an icon to replace in posts and topics the one to delete. Choose "None" to reset messages icons.';
	$lang['Icon_after'] = 'Move this icon after';

	$lang['Icon_created'] = 'The icon has been created.';
	$lang['Icon_edited'] = 'The icon has been edited.';
	$lang['Icon_deleted'] = 'The icon has been deleted.';

	$lang['Top'] = '___Top___';

	// topics attributes admin
	$lang['Topics_attr_settings'] = 'Topic title attributes';
	$lang['Topics_attr_admin'] = 'Topic title attributes management';
	$lang['Topics_attr_admin_explain'] = 'Here you can edit, delete, create and re-order text and icons used in front of topic titles.';
	$lang['Topics_attr_create'] = 'Create a topic title attribute';
	$lang['Topics_attr_create_explain'] = 'Here you register a new topic title attribute. You can use $lang entry keys for legends. Images will be picked up from the $images entries (Check templates/<i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['Topics_attr_edit'] = 'Edit a topic title attribute';
	$lang['Topics_attr_edit_explain'] = 'Here you can modify the topic title attribute definition and priviledges. Images will be picked up from the $images entries (Check templates/<i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['Topics_attr_delete'] = 'Delete a topics title attribute';
	$lang['Topics_attr_delete_explain'] = 'Here you can delete a topic title attribute.';

	$lang['Topics_attr_folder'] = 'Folder';
	$lang['Topics_attr_title'] = 'Title';
	$lang['Topics_attr_name'] = 'Attribute name';
	$lang['Topics_attr_name_explain'] = 'Set here the attribute name you want to see in the drop down lists.';
	$lang['Topics_attr_fname'] = 'Mouseover folder name';
	$lang['Topics_attr_fname_explain'] = 'Set here the name the folder image will have when the mouse will be over it.';
	$lang['Topics_attr_fimg'] = 'Folder image';
	$lang['Topics_attr_fimg_explain'] = 'This will be the folder image used when the condition will be fullfilled.';
	$lang['Topics_attr_tname'] = 'Tag';
	$lang['Topics_attr_tname_explain'] = 'This will be the tag used in front of the topic title.';
	$lang['Topics_attr_timg'] = 'Tag image';
	$lang['Topics_attr_timg_explain'] = 'If provided, the image will be displayed in place of the tag.';
	$lang['Topics_attr_field'] = 'Topics field to check';
	$lang['Topics_attr_field_explain'] = 'Set here the condition that will be used to check the topic title attribute.';
	$lang['Topics_attr_auth'] = 'Authorisation required';
	$lang['Topics_attr_auth_explain'] = 'Choose which authorisation will be required to use this topic attribute. This one is only use for the topic sub type.';

	$lang['Topics_attr_ttype'] = 'Topic type';
	$lang['Topics_attr_tsubtype'] = 'Topic sub type';
	$lang['Topics_attr_tmoved'] = 'Shadow topic';
	$lang['Topics_attr_tstatus'] = 'Topic is locked';
	$lang['Topics_attr_tvote'] = 'Topic has a poll';
	$lang['Topics_attr_tattach'] = 'Topic has an attached file';
	$lang['Topics_attr_tcalendar'] = 'Topic is a calendar event';

	$lang['Topics_attr_after'] = 'Folder image priority is just less than';
	$lang['Topics_attr_replace'] = 'Replace with attribute';
	$lang['Topics_attr_replace_explain'] = 'Choose a sub type to replace in topics the one to delete. Choose "None" to reset this sub type in topic using it.';

	$lang['Topics_attr_not_exists'] = 'This topic title attribute does not exist.';
	$lang['Topics_attr_created'] = 'The topic title attribute has been created.';
	$lang['Topics_attr_edited'] = 'The topic title attribute has been edited.';
	$lang['Topics_attr_deleted'] = 'The topic title attribute has been deleted.';

	$lang['Click_return_topics_attr_admin'] = 'Click %sHere%s to return to Topic title attributes administration.';

	// styles management
	$lang['Submit_styles'] = 'Submit style';
	$lang['Images_pack'] = 'Images pack';
	$lang['Images_pack_explain'] = 'Enter here the <i>template</i>.cfg file where stands the images definition you want to use (ie.: <i>subSilver/subSilver.cfg</i>).<br />Leave it blank to use the template images pack.';
	$lang['Custom_tpls'] = 'Customised template files directory';
	$lang['Custom_tpls_explain'] = 'Enter here the directory where can be found the customised .tpl files you want to use (ie if the customised .tpl files are located in <i>templates/subSilver/customs</i>, enter <i>customs</i>).<br />Leave it blank if you don\'t use customised tpls.';
	$lang['Stylesheet_explain'] = 'Filename for CSS stylesheet to use for this theme.';
	$lang['Images_pack_not_found'] = 'The images pack you entered has not be found.';
	$lang['Custom_tpls_not_found'] = 'The customised template files directory has not be found.';
	$lang['Head_stylesheet_not_found'] = 'The CSS stylesheet has not be found.';

	// panels
	$lang['Admin_control_panel'] = 'Administration control panel';
	$lang['User_control_panel'] = 'User control panel';
	$lang['Group_control_panel'] = 'Group control panel';

	// config
	$lang['Topics_options'] = 'Topics options';
	$lang['Messages_options'] = 'Messages options';
	$lang['Click_return_msgopt'] = 'Click %sHere%s to return to messages options.';
	$lang['Click_return_topicopt'] = 'Click %sHere%s to return to topics options.';
	$lang['Click_return_layout'] = 'Click %sHere%s to return to forums layout.';
	$lang['Keep_unreads_explain'] = 'Choose "Yes" to keep the unread flags in a cookie, "in database" to keep them in the user profile.';
	$lang['Keep_unreads_in_db'] = 'Saved in database';
	$lang['Icons_path'] = 'Messages icons path';
	$lang['Icons_path_explain'] = 'Default value is "images/icons/".';
	$lang['Default_duration'] = 'Announcements default duration';
	$lang['Default_duration_explain'] = 'Default duration proposed while writing an announcement.';
	$lang['Site_fav_icon'] = 'Site favorite icon';
	$lang['Site_fav_icon_explain'] = 'This icon is the one appearing in front of the site name of your browser bookmarks. It has to be a .ico file, 16x16 pixels.';
	$lang['Pagination_min'] = 'Minimal number of pages in pagination';
	$lang['Pagination_max'] = 'Maximal number of pages in pagination';
	$lang['Pagination_percent'] = 'Percentage of pages in pagination';

	// sub-title
	$lang['Topic_title_length'] = 'Title length of the topic title on index';
	$lang['Topic_title_length_explain'] = 'Set the number of chars you want to display for the topic title on index.';
	$lang['Sub_title_length'] = 'Title length of the sub-title (description) on index';
	$lang['Sub_title_length_explain'] = 'Set the number of chars you want to display for the sub-title (description) on index. Set it to 0 if you doesn\'t want to use the sub-title on the board.';

	// versions check
	$lang['version_checked'] = '&nbsp;&nbsp;&nbsp;&raquo; <b>%s</b>: your version is <b>%s</b>, last available version is <b>%s</b>';
	$lang['version_not_checked'] = '&nbsp;&nbsp;&nbsp;&raquo; <b>%s</b>: your version is <b>%s</b>';
	$lang['Unknown'] = 'Unknown';
}

//
// lang_main
//

// generic
$lang['No_valid_action'] = 'The action you are trying to perform is not supported.';
$lang['User_delete_deny'] = 'You are not allowed to delete this user.';
$lang['Auth_read_required'] = 'Only users users granted special access can access topics in this forum.';
$lang['Registration_required'] = 'You must register to access topics in this forum.';

// index display
$lang['Cat_no_subs'] = 'This category has no sub-forums.';
$lang['Click_return_parent'] = 'Click %sHere%s to return to the parent forum.';
$lang['View_group'] = 'View group informations';
$lang['Subforums'] = 'Sub-forums';
$lang['Link'] = 'Link';
$lang['Forum_link_visited'] = 'This link has been visited %d times <br />since %s';
$lang['Board_announces'] = 'Board Announcements';

$lang['Important_topics'] = 'Important topics';
$lang['Global_Announces'] = 'Global Announcements';
$lang['Announces'] = 'Announcements';
$lang['Stickies'] = 'Stickies';

$lang['Post_Global_Announcement'] = 'Global announcement';

$lang['Hot_topic'] = 'Popular';
$lang['Own_topic'] = 'You have posted in this topic';

$lang['Topic_Moved'] = 'Moved';
$lang['Topic_Poll'] = 'Poll';
$lang['Topic_Locked'] = 'Locked';
$lang['Topic_Global_Announcement'] = 'Global announcement';
$lang['Topic_Announcement'] = 'Announcement';
$lang['Topic_Sticky'] = 'Sticky';
$lang['Topic_Attached'] = 'Attachment';

$lang['First_Post'] = 'First Post';
$lang['No_topics'] = 'There are no posts in this forum.';
$lang['Topics_count'] = '[%s Topics]';
$lang['Posts_count'] = '[%s Posts]';
$lang['Topics_count_1'] = '[%s Topic]';
$lang['Posts_count_1'] = '[%s Post]';

$lang['Legend'] = 'Legend';
$lang['Not_available'] = 'Not available';

$lang['Announce_ends'] = 'Announcement end: %s';

// date extended
$lang['Today'] = 'Today';
$lang['Yesterday'] = 'Yesterday';
$lang['Today_at'] = 'Today, at %s';
$lang['Yesterday_at'] = 'Yesterday, at %s';

// auto form error messages
$lang['empty_error'] = 'the value must be filled.';
$lang['length_mini_error'] = 'the value is too short.';
$lang['length_maxi_error'] = 'the value is too long.';
$lang['value_mini_error'] = 'the value must be greater.';
$lang['value_maxi_error'] = 'the value must be lower.';
$lang['options_error'] = 'the value choosen is not available in the list.';
$lang['options_empty_error'] = 'no value available for this field.';
$lang['url_error'] = 'this is not a valid url.';
$lang['Date_not_valid'] = 'This is not a valid date';
$lang['Not_a_valid_directory'] = 'This is not a valid directory';
$lang['Not_a_valid_script'] = 'This is not a valid script';
$lang['Only_numeric_allowed'] = 'Only numerics are allowed';

// tree drawing
$lang['tree_pic_' . TREE_HSPACE] = '&nbsp;&nbsp;&nbsp;&nbsp;';
$lang['tree_pic_' . TREE_VSPACE] = '|&nbsp;&nbsp;&nbsp;';
$lang['tree_pic_' . TREE_CROSS] = '|___';
$lang['tree_pic_' . TREE_CLOSE] = '|___';

// modcp
$lang['Move_to_forum_error'] = 'The target forum you choose is a category or a link, so can not contain topics.';

// search
$lang['No_such_forum'] = 'No such forum. Please select an existing forum.';
$lang['Search_in_forum'] = 'Search in forum';
$lang['Search_no_subs'] = 'Do not include sub-forums in the search scope';

// posting
$lang['Message_icon'] = 'Message icons';
$lang['No_icon'] = 'No icon';
$lang['Topic_duration'] = 'Announcement ending date';
$lang['Topic_duration_explain'] = 'This is the date an announcement will stop to appear in other forums as a global announcement or a board announcement.';
$lang['Topic_duration_special'] = 'Choose "Never displayed" to never show this announcement elsewhere than in its own forum. <br />Choose "Always displayed" to display it forever.';
$lang['Never_displayed'] = 'Never displayed';
$lang['Always_displayed'] = 'Always displayed';
$lang['New_post_meanwhile_reply'] = 'A new reply has been posted or the last post has been deleted while you were replying. Check the "Topic review" at bottom of this page, and resubmit your post if appropriate.';
$lang['New_post_meanwhile_edit'] = 'A new reply has been posted or the last post has been deleted while you were editing.';

// icons title
$lang['icon_none'] = 'No icon';
$lang['icon_note'] = 'Note';
$lang['icon_important'] = 'Important';
$lang['icon_idea'] = 'Idea';
$lang['icon_warning'] = 'Warning !';
$lang['icon_question'] = 'Question';
$lang['icon_cool'] = 'Cool';
$lang['icon_funny'] = 'Funny';
$lang['icon_angry'] = 'Grrrr !';
$lang['icon_sad'] = 'Snif !';
$lang['icon_mocker'] = 'Hehehe !';
$lang['icon_shocked'] = 'Oooh !';
$lang['icon_complicity'] = 'Complicity';
$lang['icon_bad'] = 'Bad !';
$lang['icon_great'] = 'Great !';
$lang['icon_disgusting'] = 'Beark !';
$lang['icon_winner'] = 'Gniark !';
$lang['icon_impressed'] = 'Oh yes !';
$lang['icon_roleplay'] = 'Roleplay';
$lang['icon_fight'] = 'Fight';
$lang['icon_loot'] = 'Loot';
$lang['icon_picture'] = 'Picture';
$lang['icon_calendar'] = 'Calendar event';

// settings
$lang['No_options'] = 'No options available.';
$lang['Click_return_prefs'] = 'Click %sHere%s to return to your preferences.';
$lang['Topic_read'] = 'Reading topics';
$lang['Board_layout'] = 'Board layout';
$lang['Default'] = 'Default';
$lang['Keep_unreads'] = 'Keep messages unread';
$lang['Keep_unreads_dft_explain'] = 'Choose "Yes" to keep unread topics alive for your next visit.';
$lang['Topics_sort'] = 'Sort topics by';
$lang['Topics_sort_dft_explain'] = 'Select the default sort method.';
$lang['Smart_date'] = 'Smart date';
$lang['Smart_date_explain'] = 'Display "Today" or "Yesterday" in messages dates.';
$lang['Board_box_display'] = 'Display Board announcements box';
$lang['Index_pack'] = 'Pack sub-categories';
$lang['Index_pack_explain'] = 'If set, categories will appear with a forum layer.';
$lang['Index_split'] = 'Split sub-categories';
$lang['Index_split_explain'] = 'If set, categories will be splited from each other. This setup is ignored if "Pack sub-categories" is On.';

// standard prefs
$lang['Internationalisation'] = 'Internationalisation';
$lang['Posting_messages'] = 'Posting a message';
$lang['Privacy_choices'] = 'Privacy choices';

// user levels
$lang['Administrator'] = 'Administrator';
$lang['User'] = 'User';

// stats extended
$lang['Past_guests'] = 'Guests visits count';
$lang['Stats_display_past'] = 'Display visits historic on index';

$lang['Past_users_zero_total'] = 'There has been no users online within the last 24 hours :: ';
$lang['Past_user_total'] = 'There has been 1 user online within the last 24 hours :: ';
$lang['Past_users_total'] = 'There has been <b>%d</b> users online within the last 24 hours :: ';

$lang['Hour_users_zero_total'] = 'There has been no users online within the current hour :: ';
$lang['Hour_user_total'] = 'There has been 1 user online within the current hour :: ';
$lang['Hour_users_total'] = 'There has been <b>%d</b> users online within the current hour :: ';
$lang['Hour_visits'] = '(%s within the current hour)';

// unmark topics
$lang['Topic_unmarked_read'] = 'The topic has been marked unread';
$lang['Topic_unmark_read'] = 'Mark the topic unread';
$lang['Post_unmark_read'] = 'Mark this post and the followings unread';

// sub-title
$lang['Sub_title'] = 'Subject description';
$lang['Sub_title_desc'] = 'Description: %s';

// run stats
$lang['Stat_surround'] = '[ %s ]';
$lang['Stat_sep'] = ' - ';
$lang['Stat_page_duration'] = 'Time: %.4fs';
$lang['Stat_local_duration'] = 'local trace: %.4fs';
$lang['Stat_part_php'] = 'PHP: %.2d%%';
$lang['Stat_part_sql'] = 'SQL: %.2d%%';
$lang['Stat_queries_total'] = 'Queries: %2d (%.4fs)';
$lang['Stat_queries_db'] = 'db: %2d (%.4fs)';
$lang['Stat_queries_cache'] = 'cache: %2d (%.4fs/%.4fs)';
$lang['Stat_gzip_enable'] = 'GZIP on';
$lang['Stat_debug_enable'] = 'Debug on';
$lang['Stat_request'] = 'Request';
$lang['Stat_line'] = 'Line:&nbsp;%d';
$lang['Stat_cache'] = 'cache:&nbsp;%.4fs';
$lang['Stat_db'] = 'db:&nbsp;%.4fs';
$lang['Stat_table'] = 'Table';
$lang['Stat_type'] = 'Type';
$lang['Stat_possible_keys'] = 'Possible keys';
$lang['Stat_key'] = 'Used key';
$lang['Stat_key_len'] = 'Key length';
$lang['Stat_ref'] = 'Ref.';
$lang['Stat_rows'] = 'Rows';
$lang['Stat_Extra'] = 'Comment';
$lang['Stat_Comment'] = 'Comment';
$lang['Stat_id'] = 'Id';
$lang['Stat_select_type'] = 'Select type';

// debug
$lang['dbg_location'] = 'Location';
$lang['dbg_line'] = 'Line';
$lang['dbg_file'] = 'File';
$lang['dbg_empty'] = 'Empty';
$lang['dbg_backtrace'] = 'Back trace';
$lang['dbg_requester'] = 'Requester';

// operand
$lang['Less'] = 'Less than';
$lang['Less_equal'] = 'Less or Equal to';
$lang['Equal'] = 'Equal to';
$lang['Greater_equal'] = 'Greater or Equal to';
$lang['Greater'] = 'Greater than';
$lang['Not_equal'] = 'Not equal to';

// topic title attribute
$lang['Topic_sub_type'] = 'Add a tag to the title';

// calendar
$lang['Topic_calendar'] = 'Event';

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
$lang['UTC_DST'] = 'UTC %s %s (DST in action)';
$lang['UTC'] = 'UTC %s %s';
$lang['dst'] = 'Summertime';
$lang['dst_explain'] = 'Adjust the time for summer (add 1 hour in summer)';
$lang['tz_suggest'] = 'Synchronise';
$lang['tz_suggest_explain'] = 'Try to find your closest timezone';

?>