<?php
//--------------------------------------------------
// Patch file:	patch_acp_config_ch.php
// Patch time:	Mon 22 Nov 2004, 00:00 (GMT)
//--------------------------------------------------

if ( !defined('IN_PHPBB') )
{
	die('Hack attempt');
}

// header
$patch_version = '1.0.0';
$patch_date = '20041208';
$patch_author = 'Ptirhiik';
$patch_ref = 'Added options to config table for Categories 2.1.0 mod';

// panels and fields
$patch_data = array(
	'acp' => array(
		'name' => 'Admin_control_panel',
		'options' => array(

			'config' => array(
				'name' => 'Configuration',
				'options' => array(

					'topicopt' => array(
						'name' => 'Topics_options',
						'file' => 'includes/acp/acp_generic',
						'fields' => array(
								'topics_sort' => array('type' => 'list', 'legend' => 'Topics_sort', 'explain' => 'Topics_sort_dft_explain', 'options' => '[func]get_list_topics_sort', 'field' => 'topics_sort'),
								'topics_order' => array('type' => 'list', 'options' => '[var]list_topics_order', 'field' => 'topics_order', 'combined' => '1'),
								'topics_sort_over' => array('type' => 'radio_list_comment', 'legend' => 'Override_user_choice', 'options' => '[var]list_no_yes', 'field' => 'topics_sort_over', 'linefeed' => '1'),
								'topics_ppage' => array('type' => 'int', 'legend' => 'Topics_per_page', 'field' => 'topics_per_page', 'value_mini' => '1'),
								'pagination_min' => array('type' => 'int', 'legend' => 'Pagination_min', 'field' => 'pagination_min', 'value_mini' => '5'),
								'pagination_max' => array('type' => 'int', 'legend' => 'Pagination_max', 'field' => 'pagination_max', 'value_mini' => 5),
								'pagination_percent' => array('type' => 'int', 'legend' => 'Pagination_percent', 'field' => 'pagination_percent', 'value_mini' => 5, 'post_value' => '%'),
								'split_global' => array('type' => 'radio_list', 'legend' => 'Topics_split_global', 'options'=>array('No', 'Topics_split_in_box', 'Topics_split_title_only'),'options.linefeed' => '1', 'field' => 'topics_split_global'),
								'split_announces' => array('type' => 'radio_list', 'legend' => 'Topics_split_announces', 'options'=>array('No', 'Topics_split_in_box'),'options.linefeed' => '1', 'field' => 'topics_split_announces'),
								'split_stickies' => array('type' => 'radio_list', 'legend' => 'Topics_split_stickies', 'options'=>array('No', 'Topics_split_in_box', 'Topics_split_title_only'),'options.linefeed' => '1', 'field' => 'topics_split_stickies'),
						),
					),

					'msgopt' => array(
						'name' => 'Messages_options',
						'file' => 'includes/acp/acp_generic',
						'fields' => array(
								'keep_unreads' => array('type' => 'radio_list', 'legend' => 'Keep_unreads', 'explain' => 'Keep_unreads_explain', 'options'=>array('No', 'Yes', 'Keep_unreads_in_db'),'field' => 'keep_unreads'),
								'keep_unreads_over' => array('type' => 'radio_list_comment', 'legend' => 'Override_user_choice', 'options' => '[var]list_no_yes', 'field' => 'keep_unreads_over', 'linefeed' => '1'),
								'smart_date' => array('type' => 'radio_list', 'legend' => 'Smart_date', 'explain' => 'Smart_date_explain', 'options' => '[var]list_no_yes', 'field' => 'smart_date'),
								'smart_date_over' => array('type' => 'radio_list_comment', 'legend' => 'Override_user_choice', 'options' => '[var]list_no_yes', 'field' => 'smart_date_over', 'linefeed' => '1'),
								'icons_path' => array('type' => 'internal_dir', 'legend' => 'Icons_path', 'explain' => 'Icons_path_explain', 'field' => 'icons_path', 'length_mini' => '1'),
						),
					),

					'layout' => array(
						'name' => 'Board_layout',
						'file' => 'includes/acp/acp_generic',
						'fields' => array(
								'site_fav_icon' => array('type' => 'varchar', 'legend' => 'Site_fav_icon', 'explain' => 'Site_fav_icon_explain', 'field' => 'site_fav_icon'),
								'default_style' => array('type' => 'list', 'legend' => 'Default_style', 'options' => '[func]get_list_styles', 'field' => 'default_style'),
								'override_user_style' => array('type' => 'radio_list_comment', 'legend' => 'Override_style', 'options' => '[var]list_no_yes', 'field' => 'override_user_style', 'linefeed' => '1'),
								'index_pack' => array('type' => 'radio_list', 'legend' => 'Index_pack', 'explain' => 'Index_pack_explain', 'options' => '[var]list_no_yes', 'field' => 'index_pack'),
								'index_pack_over' => array('type' => 'radio_list_comment', 'legend' => 'Override_user_choice', 'options' => '[var]list_no_yes', 'field' => 'index_pack_over', 'linefeed' => '1'),
								'index_split' => array('type' => 'radio_list', 'legend' => 'Index_split', 'explain' => 'Index_split_explain', 'options' => '[var]list_no_yes', 'field' => 'index_split'),
								'index_split_over' => array('type' => 'radio_list_comment', 'legend' => 'Override_user_choice', 'options' => '[var]list_no_yes', 'field' => 'index_split_over', 'linefeed' => '1'),
								'board_box' => array('type' => 'list', 'legend' => 'Board_box_content', 'explain' => 'Board_box_content_explain', 'options'=>array('Do_not_display', 'Global_Announces', 'Global_Parent_announces', 'Global_Childs_announces', 'Global_Branch_announces'),'field' => 'board_box'),
								'board_box_over' => array('type' => 'radio_list_comment', 'legend' => 'Override_user_choice', 'options' => '[var]list_no_yes', 'field' => 'board_box_over', 'linefeed' => '1'),
								'default_duration' => array('type' => 'int', 'legend' => 'Default_duration', 'explain' => 'Default_duration_explain', 'post_value' => 'Days', 'field' => 'default_duration'),
								'last_topic_title_length' => array('type' => 'int', 'legend' => 'Last_topic_title_length', 'explain' => 'Last_topic_title_length_explain', 'field' => 'last_topic_title_length'),
								'topic_title_length' => array('type' => 'int', 'legend' => 'Topic_title_length', 'explain' => 'Topic_title_length_explain', 'field' => 'topic_title_length'),
								'sub_title_length' => array('type' => 'int', 'legend' => 'Sub_title_length', 'explain' => 'Sub_title_length_explain', 'field' => 'sub_title_length'),
								'stats_display_past' => array('type' => 'radio_list', 'legend' => 'Stats_display_past', 'options' => '[var]list_no_yes', 'field' => 'stats_display_past'),
						),
					),
				),
			),
		),
	),
);


// auths definitions
$patch_auths = array(
	POST_PANELS_URL => array(
		'auth_manage' => array(),
		'access' => array(
			GROUP_ADMIN => array('acp' => true, 'acp.config' => true, 'acp.config.topicopt' => true, 'acp.config.msgopt' => true, 'acp.config.layout' => true),
		),
	),
);


?>