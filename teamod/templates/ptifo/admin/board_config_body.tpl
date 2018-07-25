<script language="JavaScript" type="text/javascript" src="../includes/js_dom_menus.js"></script>

<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post">
<table cellpadding="0" cellspacing="2" border="0" width="100%">
<tr><td width="100%" colspan="2" valign="top"><a href="{S_CONFIG_ACTION}" class="nav">{L_CONFIGURATION_TITLE}</a></td></tr>
<tr><td width="200" valign="top">

<table id="left_part" style="display:none" cellpadding="4" cellspacing="1" border="0" class="forumline" width="200">
<tr>
	<th class="thHead">{L_CONFIGURATION_TITLE}</th>
</tr>
<tr>
	<td height="25" class="row1">
		<span class="gensmall"><b>{L_CONFIGURATION_TITLE}</b></span><hr />
		<table cellspacing="0" cellpadding="2" border="0" width="100%">
		<tr>
			<td width="10" align="right"><div id="generalinfo_flag" class="gensmall" style="font-weight: bold;">&raquo;</div></td>
			<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="dom_menu.set('generalinfo'); return false;"><div id="generalinfo_opt" class="gensmall" style="font-weight: bold;">{L_GENERAL_SETTINGS}</div></td>
		</tr>
		<tr>
			<td width="10" align="right"><div id="cookiesinfo_flag" class="gensmall">&raquo;</div></td>
			<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="dom_menu.set('cookiesinfo'); return false;"><div id="cookiesinfo_opt" class="gensmall">{L_COOKIE_SETTINGS}</div></td>
		</tr>
		<tr>
			<td width="10" align="right"><div id="pminfo_flag" class="gensmall">&raquo;</div></td>
			<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="dom_menu.set('pminfo'); return false;"><div id="pminfo_opt" class="gensmall">{L_PRIVATE_MESSAGING}</div></td>
		</tr>
		<tr>
			<td width="10" align="right"><div id="basicinfo_flag" class="gensmall">&raquo;</div></td>
			<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="dom_menu.set('basicinfo'); return false;"><div id="basicinfo_opt" class="gensmall">{L_ABILITIES_SETTINGS}</div></td>
		</tr>
		<tr>
			<td width="10" align="right"><div id="avatarinfo_flag" class="gensmall">&raquo;</div></td>
			<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="dom_menu.set('avatarinfo'); return false;"><div id="avatarinfo_opt" class="gensmall">{L_AVATAR_SETTINGS}</div></td>
		</tr>
		<tr>
			<td width="10" align="right"><div id="coppainfo_flag" class="gensmall">&raquo;</div></td>
			<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="dom_menu.set('coppainfo'); return false;"><div id="coppainfo_opt" class="gensmall">{L_COPPA_SETTINGS}</div></td>
		</tr>
		<tr>
			<td width="10" align="right"><div id="emailinfo_flag" class="gensmall">&raquo;</div></td>
			<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="dom_menu.set('emailinfo'); return false;"><div id="emailinfo_opt" class="gensmall">{L_EMAIL_SETTINGS}</div></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="spaceRow"><img src="{I_SPACER}" border="0" alt="" /></td>
</tr>
</table>

</td><td valign="top" width="100%">

<table id="generalinfo" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1" width="38%">{L_SERVER_NAME}</td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="server_name" value="{SERVER_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SERVER_PORT}<br /><span class="gensmall">{L_SERVER_PORT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SCRIPT_PATH}<br /><span class="gensmall">{L_SCRIPT_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" name="script_path" value="{SCRIPT_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SITE_NAME}<br /><span class="gensmall">{L_SITE_NAME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="sitename" value="{SITENAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SITE_DESCRIPTION}</td>
		<td class="row2"><input class="post" type="text" size="40" maxlength="255" name="site_desc" value="{SITE_DESCRIPTION}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD}<br /><span class="gensmall">{L_DISABLE_BOARD_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ACCT_ACTIVATION}</td>
		<td class="row2"><input type="radio" name="require_activation" value="{ACTIVATION_NONE}" {ACTIVATION_NONE_CHECKED} />{L_NONE}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_USER}" {ACTIVATION_USER_CHECKED} />{L_USER}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_ADMIN}" {ACTIVATION_ADMIN_CHECKED} />{L_ADMIN}</td>
	</tr>
	<tr>
		<td class="row1">{L_VISUAL_CONFIRM}<br /><span class="gensmall">{L_VISUAL_CONFIRM_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="enable_confirm" value="1" {CONFIRM_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="enable_confirm" value="0" {CONFIRM_DISABLE} />{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_AUTOLOGIN}<br /><span class="gensmall">{L_ALLOW_AUTOLOGIN_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="allow_autologin" value="1" {ALLOW_AUTOLOGIN_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="allow_autologin" value="0" {ALLOW_AUTOLOGIN_NO} />{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOLOGIN_TIME} <br /><span class="gensmall">{L_AUTOLOGIN_TIME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="{AUTOLOGIN_TIME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_BOARD_EMAIL_FORM}<br /><span class="gensmall">{L_BOARD_EMAIL_FORM_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} /> {L_ENABLED}&nbsp;&nbsp;<input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} /> {L_DISABLED}</td>
	</tr>
	<tr>
		<td class="row1">{L_FLOOD_INTERVAL} <br /><span class="gensmall">{L_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_LOGIN_ATTEMPTS}<br /><span class="gensmall">{L_MAX_LOGIN_ATTEMPTS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="max_login_attempts" value="{MAX_LOGIN_ATTEMPTS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LOGIN_RESET_TIME}<br /><span class="gensmall">{L_LOGIN_RESET_TIME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="login_reset_time" value="{LOGIN_RESET_TIME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_TOPICS_PER_PAGE}</td>
		<td class="row2"><input class="post" type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_POSTS_PER_PAGE}</td>
		<td class="row2"><input class="post" type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_HOT_THRESHOLD}</td>
		<td class="row2"><input class="post" type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_STYLE}</td>
		<td class="row2">{STYLE_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_STYLE}<br /><span class="gensmall">{L_OVERRIDE_STYLE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_LANGUAGE}</td>
		<td class="row2">{LANG_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_DATE_FORMAT}<br /><span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="default_dateformat" value="{DEFAULT_DATEFORMAT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SYSTEM_TIMEZONE}</td>
		<td class="row2">{TIMEZONE_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_GZIP}</td>
		<td class="row2"><input type="radio" name="gzip_compress" value="1" {GZIP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="gzip_compress" value="0" {GZIP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_PRUNE}</td>
		<td class="row2"><input type="radio" name="prune_enable" value="1" {PRUNE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="prune_enable" value="0" {PRUNE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"><input type="image" src="{I_SUBMIT}" accesskey="{S_SUBMIT}" name="submit" alt="{L_SUBMIT}" /></td>
	</tr>

</table>

<table id="cookiesinfo" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2">{L_QP_SETTINGS}</th>
	</tr>
	<!-- BEGIN quick_post -->
	<tr>
		<td class="row1">{quick_post.L_QP_TITLE}<br /><span class="gensmall">{quick_post.L_QP_DESC}</span></td>
		<td class="row2" width="45%"><table width="100%" cellspacing="0" cellpadding="0" border="0">
		  <tr>
		  	<td><span class="gensmall">{L_QP_USER}</span></td>
		  	<td width="100%"><input type="radio" name="{quick_post.USER_QP_VAR}" value="1" {quick_post.USER_QP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="{quick_post.USER_QP_VAR}" value="0" {quick_post.USER_QP_NO} /> {L_NO}</td>
		  <tr>
			<td><span class="gensmall">{L_QP_ANON}</span></td>
			<td width="100%"><input type="radio" name="{quick_post.ANON_QP_VAR}" value="1" {quick_post.ANON_QP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="{quick_post.ANON_QP_VAR}" value="0" {quick_post.ANON_QP_NO} /> {L_NO}</td>
		  </tr>
		</table></td>
	</tr>
	<!-- END quick_post -->
	<tr>
		<th class="thHead" colspan="2">Hypercell onClick</th>
	</tr>
	<tr>
	   <td class="row1">{L_HYPERCELL_ONCLICK}</td> 
	   <td class="row2"><input type="radio" name="hypercell_onclick" value="1" {HYPERCELL_ONCLICK_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="hypercell_onclick" value="0" {HYPERCELL_ONCLICK_NO} /> {L_NO}</td> 
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_COOKIE_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_COOKIE_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="row1" width="38%">{L_COOKIE_DOMAIN}</td>
		<td class="row2"><input class="post" type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_NAME}</td>
		<td class="row2"><input class="post" type="text" maxlength="16" name="cookie_name" value="{COOKIE_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_PATH}</td>
		<td class="row2"><input class="post" type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COOKIE_SECURE}<br /><span class="gensmall">{L_COOKIE_SECURE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />{L_DISABLED}&nbsp; &nbsp;<input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />{L_ENABLED}</td>
	</tr>
	<tr>
		<td class="row1">{L_SESSION_LENGTH}</td>
		<td class="row2"><input class="post" type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"><input type="image" src="{I_SUBMIT}" accesskey="{S_SUBMIT}" name="submit" alt="{L_SUBMIT}" /></td>
	</tr>

</table><table id="pminfo" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">

	<tr>
		<th class="thHead" colspan="2">{L_PRIVATE_MESSAGING}</th>
	</tr>
	<tr>
		<td class="row1" width="38%">{L_DISABLE_PRIVATE_MESSAGING}</td>
		<td class="row2"><input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />{L_ENABLED}&nbsp; &nbsp;<input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />{L_DISABLED}</td>
	</tr>
	<tr>
		<td class="row1">{L_INBOX_LIMIT}</td>
		<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SENTBOX_LIMIT}</td>
		<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SAVEBOX_LIMIT}</td>
		<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"><input type="image" src="{I_SUBMIT}" accesskey="{S_SUBMIT}" name="submit" alt="{L_SUBMIT}" /></td>
	</tr>

</table><table id="basicinfo" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">

	<tr>
	  <th class="thHead" colspan="2">{L_ABILITIES_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1" width="38%">{L_MAX_POLL_OPTIONS}</td>
		<td class="row2"><input class="post" type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_HTML}</td>
		<td class="row2"><input type="radio" name="allow_html" value="1" {HTML_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_html" value="0" {HTML_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOWED_TAGS}<br /><span class="gensmall">{L_ALLOWED_TAGS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_BBCODE}</td>
		<td class="row2"><input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SMILIES}</td>
		<td class="row2"><input type="radio" name="allow_smilies" value="1" {SMILE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_smilies" value="0" {SMILE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SMILIES_PATH} <br /><span class="gensmall">{L_SMILIES_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="smilies_path" value="{SMILIES_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_SIG}</td>
		<td class="row2"><input type="radio" name="allow_sig" value="1" {SIG_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_sig" value="0" {SIG_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_SIG_LENGTH}<br /><span class="gensmall">{L_MAX_SIG_LENGTH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="5" maxlength="4" name="max_sig_chars" value="{SIG_SIZE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_NAME_CHANGE}</td>
		<td class="row2"><input type="radio" name="allow_namechange" value="1" {NAMECHANGE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_namechange" value="0" {NAMECHANGE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"><input type="image" src="{I_SUBMIT}" accesskey="{S_SUBMIT}" name="submit" alt="{L_SUBMIT}" /></td>
	</tr>

</table><table id="avatarinfo" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">

	<tr>
	  <th class="thHead" colspan="2">{L_AVATAR_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1" width="38%">{L_ALLOW_LOCAL}</td>
		<td class="row2"><input type="radio" name="allow_avatar_local" value="1" {AVATARS_LOCAL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_local" value="0" {AVATARS_LOCAL_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_REMOTE} <br /><span class="gensmall">{L_ALLOW_REMOTE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="allow_avatar_remote" value="1" {AVATARS_REMOTE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_remote" value="0" {AVATARS_REMOTE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_UPLOAD}</td>
		<td class="row2"><input type="radio" name="allow_avatar_upload" value="1" {AVATARS_UPLOAD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_upload" value="0" {AVATARS_UPLOAD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_FILESIZE}<br /><span class="gensmall">{L_MAX_FILESIZE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="4" maxlength="10" name="avatar_filesize" value="{AVATAR_FILESIZE}" /> Bytes</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_AVATAR_SIZE} <br />
			<span class="gensmall">{L_MAX_AVATAR_SIZE_EXPLAIN}</span>
		</td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="avatar_max_height" value="{AVATAR_MAX_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="avatar_max_width" value="{AVATAR_MAX_WIDTH}"></td>
	</tr>
	<tr>
		<td class="row1">{L_AVATAR_STORAGE_PATH} <br /><span class="gensmall">{L_AVATAR_STORAGE_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="avatar_path" value="{AVATAR_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_AVATAR_GALLERY_PATH} <br /><span class="gensmall">{L_AVATAR_GALLERY_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="avatar_gallery_path" value="{AVATAR_GALLERY_PATH}" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"><input type="image" src="{I_SUBMIT}" accesskey="{S_SUBMIT}" name="submit" alt="{L_SUBMIT}" /></td>
	</tr>

</table><table id="coppainfo" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">

	<tr>
	  <th class="thHead" colspan="2">{L_COPPA_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1" width="38%">{L_COPPA_FAX}</td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="coppa_fax" value="{COPPA_FAX}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COPPA_MAIL}<br /><span class="gensmall">{L_COPPA_MAIL_EXPLAIN}</span></td>
		<td class="row2"><textarea name="coppa_mail" rows="5" cols="30">{COPPA_MAIL}</textarea></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"><input type="image" src="{I_SUBMIT}" accesskey="{S_SUBMIT}" name="submit" alt="{L_SUBMIT}" /></td>
	</tr>

</table><table id="emailinfo" border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">

	<tr>
	  <th class="thHead" colspan="2">{L_EMAIL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1" width="38%">{L_ADMIN_EMAIL}</td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_EMAIL_SIG}<br /><span class="gensmall">{L_EMAIL_SIG_EXPLAIN}</span></td>
		<td class="row2"><textarea name="board_email_sig" rows="5" cols="30">{EMAIL_SIG}</textarea></td>
	</tr>
	<tr>
		<td class="row1">{L_USE_SMTP}<br /><span class="gensmall">{L_USE_SMTP_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="smtp_delivery" value="1" {SMTP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="smtp_delivery" value="0" {SMTP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_SERVER}</td>
		<td class="row2"><input class="post" type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_USERNAME}<br /><span class="gensmall">{L_SMTP_USERNAME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SMTP_PASSWORD}<br /><span class="gensmall">{L_SMTP_PASSWORD_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"><input type="image" src="{I_SUBMIT}" accesskey="{S_SUBMIT}" name="submit" alt="{L_SUBMIT}" /></td>
	</tr>

</table>

</td></tr></table>{S_HIDDEN_FIELDS}
</form>

<br clear="all" />

<script language="JavaScript" type="text/javascript">
<!--//
	// instantiate
	dom_menu = new _dom_menu(['generalinfo', 'cookiesinfo', 'pminfo', 'basicinfo', 'avatarinfo', 'coppainfo', 'emailinfo']);
//-->
</script>