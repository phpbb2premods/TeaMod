<table class="forumline" width="100%" align="center" cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td class="spaceRow" height="1"><img src="{I_SPACER}" height="1" border="0" alt=""></td>
	</tr>
	<tr>
		<td align="left" valign="bottom"><span class="gensmall">
			<!-- BEGIN switch_user_logged_in -->{LAST_VISIT_DATE}<br /><!-- END switch_user_logged_in -->
			{CURRENT_TIME}<br />
			{S_TIMEZONE}
		</span></td>
	</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<td><span class="mainPost">
			<a class="mainPost" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a>
			</span><span class="gensmall"><br />
			<!-- BEGIN moderators --><b>{L_MODERATORS}:&nbsp;</b><!-- BEGIN mod --><a href="{moderators.mod.U_MOD}" title="{moderators.mod.L_MOD_TITLE}" class="gensmall">{moderators.mod.L_MOD}</a><!-- BEGIN sep -->, <!-- END sep --><!-- END mod --><!-- END moderators -->
		</span></td>
	</tr>
</table>

<table width="100%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<td align="left" nowrap="nowrap"><span class="nav">
			<a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a>
		</span></td>
		<td width="100%" valign="bottom"><span class="gensmall">
			<!-- BEGIN pagination --><b>{pagination.L_PAGE_OF}</b>&nbsp;{pagination.L_COUNT}<!-- END pagination -->
		</span></td>
		<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">
			<!-- BEGIN watch -->
			<!-- BEGIN image -->
			<a href="{U_WATCH_TOPIC}" class="gensmall"><img src="{I_WATCH_TOPIC}" border="0" title="{L_WATCH_TOPIC}" alt="{L_WATCH_TOPIC}" /></a>
			<!-- END image -->
			<!-- BEGIN image_ELSE -->
			</span><a href="{U_WATCH_TOPIC}" class="gensmall">{L_WATCH_TOPIC}</a>
			<!-- END image_ELSE -->
			<!-- END watch -->
			<!-- BEGIN unmark_read -->
			<a href="{U_UNREAD_TOPIC}" class="gensmall"><img src="{I_UNREAD_TOPIC}" width="10" height="10" alt="{L_UNREAD_TOPIC}" border="0" /></a> 
			<!-- END unmark_read -->
			<a href="{U_VIEW_OLDER_TOPIC}" class="gensmall"><img src="{I_VIEW_PREVIOUS_TOPIC}" width="10" height="10" alt="{L_VIEW_PREVIOUS_TOPIC}" border="0" /></a> <a href="{U_VIEW_NEWER_TOPIC}" class="gensmall"><img src="{I_VIEW_NEXT_TOPIC}" width="10" height="10" alt="{L_VIEW_NEXT_TOPIC}" border="0" /></a><br/>
			<!-- BEGIN pagination -->
			<!-- BEGIN unique_ELSE --><b>{pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
			<!-- BEGIN previous --><b><a href="{pagination.U_PREVIOUS}" class="gensmall">{pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
			<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
			<!-- BEGIN next --><b>&nbsp;<a href="{pagination.U_NEXT}" class="gensmall">{pagination.L_NEXT}</a></b><!-- END next -->
			<!-- END pagination -->
		</span></td>
	</tr>
</table>

<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	{POLL_DISPLAY}
<!-- BEGIN postrow -->
	<tr>
		<td class="catBottom" width="100%" height="28" valign="bottom" nowrap="nowrap" colspan="2">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td align="left" valign="middle" nowrap="nowrap"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="genmini">&nbsp;</span><span class="postdetails">{L_POSTED}: {postrow.POST_DATE}</td>
					<td align="right" valign="middle" nowrap="nowrap">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG} <!-- BEGIN unmark_read --><a href="{postrow.U_UNREAD_POST}" class="gensmall"><img src="{I_UNREAD}" border="0" alt="{L_UNREAD_POST}" title="{L_UNREAD_POST}" /></a><!-- END unmark_read --> <a href="#top" class="nav"><img src="{I_GO_TO_TOP}" width="16" height="18" alt="{L_BACK_TO_TOP}" title="{L_BACK_TO_TOP}" border="0" /></a> <a href="#bottom" class="nav"><img src="{I_GO_TO_BOTTOM}" width="16" height="18" alt="{L_BACK_TO_BOTTOM}" title="{L_BACK_TO_BOTTOM}" border="0" /></a>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- BEGIN title -->
	<tr>
		<td class="row1" width="100%" height="25" valign="top" colspan="2">
			<span class="postdetails">{L_POST_SUBJECT}:
	<!-- END title -->
			<!-- BEGIN msg_icon -->
			<img src="{postrow.msg_icon.I_ICON}" border="0" title="{postrow.msg_icon.L_ICON}" align="absbottom" />
			<!-- END msg_icon -->
			<!-- BEGIN sub_type -->
			<!-- BEGIN img -->
			<img src="{postrow.sub_type.I_SUB_TYPE}" border="0" alt="{postrow.sub_type.L_SUB_TYPE}" title="{postrow.sub_type.L_SUB_TYPE}" align="absbottom" />
			<!-- END img -->
			<!-- BEGIN txt -->
			<b>[{postrow.sub_type.L_SUB_TYPE}]</b>
			<!-- END txt -->
			<!-- END sub_type -->
	<!-- BEGIN title -->
			<span class="genmed"><b>{postrow.POST_SUBJECT}</b></span>
	<!-- END title -->
	<!-- BEGIN sub_title -->
			<br />{L_SUB_TITLE}: {postrow.sub_title.SUB_TITLE}
	<!-- END sub_title -->
	<!-- BEGIN announce -->
			<br />{postrow.announce.S_ANNOUNCE}
	<!-- END announce -->
	<!-- BEGIN calendar_event -->
			<br />{postrow.calendar_event.S_CALENDAR_EVENT}
	<!-- END calendar_event -->
	<!-- BEGIN title -->
			</span>
		</td>
	</tr>
	<!-- END title -->
	<tr>
		<th class="thCornerL" width="150" nowrap="nowrap">{L_AUTHOR}</th>
		<th class="thCornerR" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>
	<tr>
		<!-- BEGIN light -->
		<td class="row1" width="150" align="left" valign="top">
		<!-- END light -->
		<!-- BEGIN light_ELSE -->
		<td class="row2" width="150" align="left" valign="top">
		<!-- END light_ELSE -->
		<span class="name"><a name="{postrow.U_POST_ID}"></a><b>{postrow.POSTER_NAME}</b></span><br /><span class="postdetails">{postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />{postrow.POSTER_FROM}</span></td>
		<!-- BEGIN light -->
		<td class="row1" width="100%" height="100%" valign="top">
		<!-- END light -->
		<!-- BEGIN light_ELSE -->
		<td class="row2" width="100%" height="100%" valign="top">
		<!-- END light_ELSE -->
			<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td height="100%" valign="top" colspan="2"><span class="postbody">{postrow.MESSAGE}{postrow.ATTACHMENTS}</span></td>
				</tr>
				<tr>
					<td colspan="2"><span class="postdetails"><i>{postrow.EDITED_MESSAGE}</i></span><span class="postbody"></span><span class="postbody">{postrow.SIGNATURE}</span></td> 
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<!-- BEGIN light -->
		<td class="catBottom" width="100%" height="28" align="left" valign="bottom" nowrap="nowrap" colspan="2">
		<!-- END light -->
		<!-- BEGIN light_ELSE -->
		<td class="catBottom" width="100%" height="28" align="left" valign="bottom" nowrap="nowrap" colspan="2">
		<!-- END light_ELSE -->
			<table width="18" height="18" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td valign="middle" nowrap="nowrap"><span class="genmini">&nbsp;<a href="#top" class="nav"><img src="{I_GO_TO_TOP}" width="16" height="18" alt="{L_BACK_TO_TOP}" title="{L_BACK_TO_TOP}" border="0" /></a></span> <span class="genmini"><a href="#bottom" class="nav"><img src="{I_GO_TO_BOTTOM}" width="16" height="18" alt="{L_BACK_TO_BOTTOM}" title="{L_BACK_TO_BOTTOM}" border="0" /></a></span> {postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG}
						<script language="JavaScript" type="text/javascript">
							<!-- 
							if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
								document.write(' {postrow.ICQ_IMG}');
							else
								document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');
							//-->
						</script>
						<noscript>{postrow.ICQ_IMG}</noscript>
					</td>
				</tr>
			</table>
		</tr>
		<tr>
			<td class="spaceRow" height="1" colspan="2"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
		</tr>
<!-- END postrow -->
		<tr align="center">
			<td class="catBottom" height="28" colspan="2">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr><form method="post" action="{S_POST_DAYS_ACTION}">
						<td align="center"><span class="gensmall">{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;<input type="submit" value="{L_GO}" class="liteoption" name="submit" /></span></td>
					</form></tr>
				</table>
			</td>
		</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

<table width="100%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<td align="left" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a>
		<!-- BEGIN qp_form -->
		<!-- BEGIN qp_button -->
		&nbsp;&nbsp;<a href="{qp_form.qp_button.U_QUICK_POST}"><img src="{qp_form.qp_button.I_QUICK_POST}" border="0" alt="{qp_form.qp_button.L_QUICK_POST_ALT}" align="middle" /></a>
		<!-- END qp_button -->
		<!-- END qp_form -->
		</span></td>
		<td width="100%" valign="top"><span class="gensmall">
			<!-- BEGIN pagination --><b>{pagination.L_PAGE_OF}</b>&nbsp;{pagination.L_COUNT}<!-- END pagination -->
		</span></td>
		<td align="right" valign="top" nowrap="nowrap"><span class="gensmall">
			<!-- BEGIN pagination -->
			<!-- BEGIN unique_ELSE --><b>{pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
			<!-- BEGIN previous --><b><a href="{pagination.U_PREVIOUS}" class="gensmall">{pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
			<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
			<!-- BEGIN next --><b>&nbsp;<a href="{pagination.U_NEXT}" class="gensmall">{pagination.L_NEXT}</a></b><!-- END next -->
			<!-- BEGIN unique_ELSE --><br /><!-- END unique_ELSE -->
			<!-- END pagination -->
			<!-- BEGIN watch -->
			<!-- BEGIN image -->
			<a href="{U_WATCH_TOPIC}" class="gensmall"><img src="{I_WATCH_TOPIC}" border="0" title="{L_WATCH_TOPIC}" alt="{L_WATCH_TOPIC}" /></a>
			<!-- END image -->
			<!-- BEGIN image_ELSE -->
			<a href="{U_WATCH_TOPIC}" class="gensmall">{L_WATCH_TOPIC}</a>
			<!-- END image_ELSE -->
			<!-- END watch -->
			<!-- BEGIN unmark_read -->
			<a href="{U_UNREAD_TOPIC}" class="gensmall"><img src="{I_UNREAD_TOPIC}" width="10" height="10" alt="{L_UNREAD_TOPIC}" border="0" /></a> 
			<!-- END unmark_read -->
			<a href="{U_VIEW_OLDER_TOPIC}" class="gensmall"><img src="{I_VIEW_PREVIOUS_TOPIC}" width="10" height="10" alt="{L_VIEW_PREVIOUS_TOPIC}" border="0" /></a> <a href="{U_VIEW_NEWER_TOPIC}" class="gensmall"><img src="{I_VIEW_NEXT_TOPIC}" width="10" height="10" alt="{L_VIEW_NEXT_TOPIC}" border="0" /></a><br/>
		</span></td>
	</tr>
</table>
<!-- BEGIN qp_form -->
{QP_BOX}
<!-- END qp_form -->
{NAVIGATION_BOX}

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="2"><img src="{I_SPACER}" height="2" border="0" alt=""></td>
	</tr>
</table>

<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td nowrap="nowrap">{JUMPBOX}</td>
		<td width="100%" align="right"><span class="mainmenu"><a href="#" onClick="dom_toggle.toggle('legend_display','legend_open_close', '{I_DOWN_ARROW}', '{I_UP_ARROW}'); return false;" class="gensmall"><img src="{I_TOGGLE_ICON}" id="legend_open_close" hspace="2" border="0" />{L_LEGEND_DISPLAY}</a></span></td>
	</tr>
	<tr>
		<tbody id="legend_display" style="display:{TOGGLE_STATUS}">
			<td colspan="2">
				<table class="forumline" width="100%" align="center" cellpadding="2" cellspacing="0" border="0">
					<tr>
						<td class="spaceRow" height="1" colspan="3"><img src="{I_SPACER}" height="1" border="0" alt=""></td>
					</tr>
					<tr>
						<td class="titleLegend" colspan="2">&nbsp;<b>{L_LEGEND}</b></td>
						<td class="titleLegend" align="right"><b>{L_PERMISSIONS}</b>&nbsp;</td>
					</tr>
					<tr>
						<td class="rowLegend" valign="bottom" nowrap="nowrap">{S_TOPIC_ADMIN}</td>
						<td class="rowLegend" align="right" colspan="2">
							<table cellpadding="0" cellspacing="3" border="0">
								<tr>
									<td><span class="gensmall">{S_AUTH_LIST}</span></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table class="shadow" with="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
						<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
						<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
					</tr>
				</table>
			</td>
		</tbody>
	</tr>
</table>
