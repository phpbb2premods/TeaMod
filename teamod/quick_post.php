<?php
/***************************************************************************
 * quick_post.php
 * --------------
 * begin	: Thursday, June 09, 2005
 * copyright	: reddog - http://www.reddevboard.com
 * version	: 1.0.3 (05/10/03)
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

define('IN_PHPBB', true);
$phpbb_root_path = './';

// initialize vars
$qp_lvl = ( $user->data['user_level'] != ADMIN ) ? false : true;
$qp_logged = ( $user->data['session_logged_in'] ) ? true : false;
$qp_show = $qp_subject = $qp_bbcode = $qp_smilies = $qp_more = 0;
$user_qp = $user_qp_show = $user_qp_subject = $user_qp_bbcode = $user_qp_smilies = $user_qp_more = 0;
$anon_qp = $anon_qp_show = $anon_qp_subject = $anon_qp_bbcode = $anon_qp_smilies = $anon_qp_more = 0;

//config data
if (!empty($config->data['users_qp_settings']))
{
	list($config->data['user_qp'], $config->data['user_qp_show'], $config->data['user_qp_subject'], $config->data['user_qp_bbcode'], $config->data['user_qp_smilies'], $config->data['user_qp_more']) = explode('-', $config->data['users_qp_settings']);
}

if (!empty($config->data['anons_qp_settings']))
{
	list($anon_qp, $anon_qp_show, $anon_qp_subject, $anon_qp_bbcode, $anon_qp_smilies, $anon_qp_more) = explode('-', $config->data['anons_qp_settings']);
}

// user data
if (!empty($user->data['user_qp_settings']))
{
	list($user_qp, $user_qp_show, $user_qp_subject, $user_qp_bbcode, $user_qp_smilies, $user_qp_more) = explode('-', $user->data['user_qp_settings']);
}

// set toggles for various options
$html_on = ( !$config->data['allow_html'] ) ? 0 : ( ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_html']) ) ? 0 : TRUE ) : ( ( $user->data['user_id'] == ANONYMOUS ) ? $config->data['allow_html'] : $user->data['user_allowhtml'] ) );
$bbcode_on = ( !$config->data['allow_bbcode'] ) ? 0 : ( ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $user->data['user_id'] == ANONYMOUS ) ? $config->data['allow_bbcode'] : $user->data['user_allowbbcode'] ) );
$smilies_on = ( !$config->data['allow_smilies'] ) ? 0 : ( ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_smilies']) ) ? 0 : TRUE ) : ( ( $user->data['user_id'] == ANONYMOUS ) ? $config->data['allow_smilies'] : $user->data['user_allowsmile'] ) );

// main process
if ( !( ( !$is_auth['auth_reply'] || $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) && $user->data['user_level'] != ADMIN ) )
{
	// show quick post form
	if (
		$config->data['user_qp'] && $user_qp && $qp_logged ||
		$anon_qp && !$qp_logged ||
		$user_qp && $qp_lvl )
	{
		$template->set_switch('qp_form');
	}

	$attach_sig = ( ($user->data['session_logged_in']) ? $user->data['user_attachsig'] : 0 ) ? 'checked="checked"' : '';
	$notify_user = ( ($user->data['session_logged_in']) ? $user->data['user_notify'] : 0 ) ? 'checked="checked"' : '';

	$hidden_form_fields = '<input type="hidden" name="sid" value="' . $user->data['session_id'] . '">';
	$hidden_form_fields .= '<input type="hidden" name="mode" value="reply" />';
	$hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';

	// ensure categories hierarchy v2.1.x compliancy
	if ( !empty($config->data['mod_cat_hierarchy']) )
	{
		$hidden_form_fields .= '<input type="hidden" name="last_post" value="' . $forum_topic_data['topic_last_post_id'] . '" />';
	}

	// html toggle selection
	$html_status = (!empty($config->data['allow_html'])) ? $user->lang('HTML_is_ON') : $user->lang('HTML_is_OFF');
	$template->set_switch('html_checkbox', !empty($config->data['allow_html']));

	// bbcode toggle selection
	$bbcode_status = (!empty($config->data['allow_bbcode'])) ? $user->lang('BBCode_is_ON') : $user->lang('BBCode_is_OFF');
	$template->set_switch('bbcode_checkbox', !empty($config->data['allow_bbcode']));

	// smilies toggle selection
	$smilies_status = (!empty($config->data['allow_smilies'])) ? $user->lang('Smilies_are_ON') : $user->lang('Smilies_are_OFF');
	$template->set_switch('smilies_checkbox', !empty($config->data['allow_smilies']));

	// check quick post options and display its
	$dta_users = array('user_qp_show', 'user_qp_subject', 'user_qp_bbcode', 'user_qp_smilies', 'user_qp_more');
	$dta_anons = array('anon_qp_show', 'anon_qp_subject', 'anon_qp_bbcode', 'anon_qp_smilies', 'anon_qp_more');

	for($i = 0; $i < count($dta_users); $i++)
	{
		if (
			$config->data[$dta_users[$i]] && $$dta_users[$i] && $qp_logged ||
			$$dta_anons[$i] && !$qp_logged ||
			$$dta_users[$i] && $qp_lvl )
		{
			$qp_action = str_replace('user_', '', $dta_users[$i]);
			$$qp_action = 1;
			$template->set_switch($qp_action);

			if ( !empty($qp_more) && $user->data['session_logged_in'] )
			{
				$template->assign_block_vars('qp_more.user_logged_in', array(
					'ATTACH_SIGNATURE' => $attach_sig,
					'NOTIFY_ON_REPLY' => $notify_user)
				);
			}
		}
	}

	// display button
	if ( !$qp_show )
	{
		$quick_post_url = 'javascript:qp_switch(\'qp_box\');';
		$quick_post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $user->img('reply_locked') : $user->img('quick_post');

		$template->assign_block_vars('qp_form.qp_button', array(
			'I_QUICK_POST' => $quick_post_img,
			'L_QUICK_POST_ALT' => $user->lang('qp_quick_post'),
			'U_QUICK_POST' => $quick_post_url,
		));
	}
	
	// username select
	$template->set_switch('username_select', empty($user->data['session_logged_in']));

	// font size combobox
	$size_types_text = array($user->lang('font_tiny'), $user->lang('font_small'), $user->lang('font_normal'), $user->lang('font_large'), $user->lang('font_huge'));
	$size_types = array('7', '9', '12', '18', '24');

	$select_font_size = '<select name="addbbcodefontsize" onchange="bbfontstyle(\'[size=\' + this.form.addbbcodefontsize.options[this.form.addbbcodefontsize.selectedIndex].value + \']\', \'[/size]\');this.form.addbbcodefontsize.selectedIndex = 2;" onmouseover="helpline(\'f\')">';
	for($i = 0; $i < count($size_types_text); $i++)
	{
		$selected = ( $i == 2 ) ? ' selected="selected"' : '';
		$select_font_size .= '<option value="' . $size_types[$i] . '"' . $selected . '>' . $size_types_text[$i] . '</option>';
	}
	$select_font_size .= '</select>';

	// font color combobox
	$font_types_text = array($user->lang('color_default'), $user->lang('color_dark_red'), $user->lang('color_red'), $user->lang('color_orange'), $user->lang('color_brown'), $user->lang('color_yellow'), $user->lang('color_green'), $user->lang('color_olive'), $user->lang('color_cyan'), $user->lang('color_blue'), $user->lang('color_dark_blue'), $user->lang('color_indigo'), $user->lang('color_violet'), $user->lang('color_white'), $user->lang('color_black'));
	$font_types = array($theme['fontcolor1'], 'darkred', 'red', 'orange', 'brown', 'yellow', 'green', 'olive', 'cyan', 'blue', 'darkblue', 'indigo', 'violet', 'white', 'black');

	$select_font_color = '<select name="addbbcodefontcolor" onchange="bbfontstyle(\'[color=\' + this.form.addbbcodefontcolor.options[this.form.addbbcodefontcolor.selectedIndex].value + \']\', \'[/color]\');this.form.addbbcodefontcolor.selectedIndex = 0;" onmouseover="helpline(\'s\')">';
	for($i = 0; $i < count($font_types_text); $i++)
	{
		$selected = ( $i == 0 ) ? ' selected="selected"' : '';
		$select_font_color .= '<option style="color:' . $font_types[$i] . '" value="' . $font_types[$i] . '"' . $selected . '>' . $font_types_text[$i] . '</option>';
	}
	$select_font_color .= '</select>';

	// generate smilies box
	if (!empty($qp_smilies))
	{
		generate_smilies_box();
	}

        // sent to template
        $template->assign_vars(array(
		'HTML_STATUS' => $html_status,
		'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . $config->url('faq', array('mode' => 'bbcode'), true) . '" target="_phpbbcode">', '</a>'),
		'SMILIES_STATUS' => $smilies_status,

		'L_OPTIONS' => $user->lang('Options'),
		'L_DISABLE_HTML' => $user->lang('Disable_HTML_post'),
		'L_DISABLE_BBCODE' => $user->lang('Disable_BBCode_post'),
		'L_DISABLE_SMILIES' => $user->lang('Disable_Smilies_post'),
		'U_MORE_SMILIES' => $config->url('posting', array('mode' => 'smilies'), true),
		'L_MORE_SMILIES' => $user->lang('More_emoticons'),
		'L_ATTACH_SIGNATURE' => $user->lang('Attach_signature'),
		'L_NOTIFY_ON_REPLY' => $user->lang('Notify'),
		'L_QUOTE_SELECTED' => $user->lang('qp_quote_selected'),
		'L_NO_TEXT_SELECTED' => $user->lang('qp_quote_empty'),

		'L_BBCODE_B_HELP' => $user->lang('bbcode_b_help'),
		'L_BBCODE_I_HELP' => $user->lang('bbcode_i_help'),
		'L_BBCODE_U_HELP' => $user->lang('bbcode_u_help'),
		'L_BBCODE_Q_HELP' => $user->lang('bbcode_q_help'),
		'L_BBCODE_C_HELP' => $user->lang('bbcode_c_help'),
		'L_BBCODE_L_HELP' => $user->lang('bbcode_l_help'),
		'L_BBCODE_O_HELP' => $user->lang('bbcode_o_help'),
		'L_BBCODE_P_HELP' => $user->lang('bbcode_p_help'),
		'L_BBCODE_W_HELP' => $user->lang('bbcode_w_help'),
		'L_BBCODE_A_HELP' => $user->lang('bbcode_a_help'),
		'L_BBCODE_E_HELP' => $user->lang('bbcode_e_help'),
		'L_BBCODE_S_HELP' => $user->lang('bbcode_s_help'),
		'L_BBCODE_F_HELP' => $user->lang('bbcode_f_help'),

		'L_FONT_COLOR' => $user->lang('Font_color'),
		'L_FONT_SIZE' => $user->lang('Font_size'),
		'L_BBCODE_CLOSE_TAGS' => $user->lang('Close_Tags'),
		'L_STYLES_TIP' => $user->lang('Styles_tip'),

		'S_FONT_SIZE_TYPES' => $select_font_size,
		'S_FONT_COLOR_TYPES' => $select_font_color,

                'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '',
		'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '',
		'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '',
	));
}

// generate the page
$template->assign_vars(array(
	'L_EMPTY_MESSAGE' => $user->lang('Empty_message'),
	'L_QP_TITLE' => $user->lang('qp_quick_post'),
	'L_QP_OPTIONS' => $user->lang('qp_options'),
	'L_USERNAME' => $user->lang('Username'),
	'L_SUBJECT' => $user->lang('Subject'),
	'L_MESSAGE_BODY' => $user->lang('Message_body'),
	'L_PREVIEW' => $user->lang('Preview'),
	'L_SUBMIT' => $user->lang('Submit'),

	'S_POST_ACTION' => $config->url('posting', '', true),
	'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);

// send the display
$qp_lite = (!$qp_subject && !$qp_bbcode && !$qp_smilies && !$qp_more) ? true : false;
$template->set_filenames(array('qp_box' => ($qp_lite) ? 'qp_lite.tpl' : 'qp_max.tpl'));
$template->assign_var_from_handle('QP_BOX', 'qp_box');

// ------------------
// Begin function block
//
function generate_smilies_box()
{
        global $db, $config, $template, $user;

	$inline_columns = 4;
	$inline_rows = 5;

	$sql = "SELECT emoticon, code, smile_url
		FROM " . SMILIES_TABLE . "
		ORDER BY smilies_id";
	if ($result = $db->sql_query($sql))
	{
		$num_smilies = 0;
		$rowset = array();
		while ($row = $db->sql_fetchrow($result))
		{
			if (empty($rowset[$row['smile_url']]))
			{
				$rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
				$rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
				$num_smilies++;
			}
		}

		if ($num_smilies)
		{
			$smilies_count = min(19, $num_smilies);
			$smilies_split_row = $inline_columns - 1;

			$s_colspan = 0;
			$row = 0;
			$col = 0;

			while (list($smile_url, $data) = @each($rowset))
			{
				$template->set_switch('qp_smilies.smilies_row', empty($col));

				$template->assign_block_vars('qp_smilies.smilies_row.smilies_col', array(
					'SMILEY_CODE' => $data['code'],
					'SMILEY_IMG' => $config->data['smilies_path'] . '/' . $smile_url,
					'SMILEY_DESC' => $data['emoticon'])
				);

				$s_colspan = max($s_colspan, $col + 1);

				if ($col == $smilies_split_row)
				{
					if ($row == $inline_rows - 1)
					{
						break;
					}
					$col = 0;
					$row++;
				}
				else
				{
					$col++;
				}
			}

			if ($num_smilies > $inline_rows * $inline_columns)
			{
				$template->set_switch('qp_smilies.smilies_extra');

				$template->assign_vars(array(
					'L_MORE_SMILIES' => $user->lang('More_emoticons'),
					'U_MORE_SMILIES' => $config->url('posting', array('mode' => 'smilies'), true),
				));
			}

			$template->assign_vars(array(
				'L_EMOTICONS' => $user->lang('Emoticons'),
				'L_CLOSE_WINDOW' => $user->lang('Close_window'),
				'S_SMILIES_COLSPAN' => $s_colspan)
			);
		}
	}

}
//
// End function block
// ------------------

?>