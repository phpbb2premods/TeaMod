
<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left" valign="bottom"><span class="gensmall">
	<!-- BEGIN switch_user_logged_in -->{LAST_VISIT_DATE}<br /><!-- END switch_user_logged_in -->
	{CURRENT_TIME}<br />
	{S_TIMEZONE}
	</span></td>
  </tr>
</table>

<br class="nav" />

{NAVIGATION_BOX}

<table border="0" cellpadding="4" cellspacing="1" width="100%">
<tr> 
	<td><span class="maintitle">
		<a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a>
	</span><span class="gensmall"><br />
		<!-- BEGIN moderators --><b>{L_MODERATORS}:&nbsp;</b><!-- BEGIN mod --><a href="{moderators.mod.U_MOD}" title="{moderators.mod.L_MOD_TITLE}" class="gensmall">{moderators.mod.L_MOD}</a><!-- BEGIN sep -->, <!-- END sep --><!-- END mod --><!-- END moderators -->
	</span></td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td align="left" valign="bottom" nowrap="nowrap"><span class="nav">
		<a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a>
	</span></td>
	<td width="100%" valign="bottom"><span class="gensmall">
		<!-- BEGIN pagination --><b>{pagination.L_PAGE_OF}</b>&nbsp;{pagination.L_COUNT}<!-- END pagination -->
	</span></td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">
		<!-- BEGIN watch --><a href="{U_WATCH_TOPIC}" class="gensmall"><!-- BEGIN image --><img src="{I_WATCH_TOPIC}" border="0" title="{L_WATCH_TOPIC}" alt="{L_WATCH_TOPIC}" /><!-- BEGINELSE image -->{L_WATCH_TOPIC}<!-- END image --></a><br /><!-- END watch -->
		<!-- BEGIN unmark_read --><a href="{U_UNREAD_TOPIC}" class="gensmall">{L_UNREAD_TOPIC}</a>&nbsp;::&nbsp;<!-- END unmark_read -->
		<a href="{U_VIEW_OLDER_TOPIC}" class="gensmall">{L_VIEW_PREVIOUS_TOPIC}</a> :: <a href="{U_VIEW_NEWER_TOPIC}" class="gensmall">{L_VIEW_NEXT_TOPIC}</a><br />
<!-- BEGIN pagination -->
		<!-- BEGIN unique_ELSE --><b>{pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
		<!-- BEGIN previous --><b><a href="{pagination.U_PREVIOUS}" class="gensmall">{pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
		<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
		<!-- BEGIN next --><b>&nbsp;<a href="{pagination.U_NEXT}" class="gensmall">{pagination.L_NEXT}</a></b><!-- END next -->
<!-- END pagination -->
	</span></td>
</tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
	{POLL_DISPLAY}
	<tr>
		<th class="thCornerL" width="150" nowrap="nowrap">{L_AUTHOR}</th>
		<th class="thCornerR" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>
	<!-- BEGIN postrow -->
	<tr> 
		<td width="150" align="left" valign="top" class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><span class="name">
			<a name="{postrow.U_POST_ID}"></a><b>{postrow.POSTER_NAME}</b>
		</span><br /><span class="postdetails">
			{postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />{postrow.POSTER_FROM}
		</span><br /></td>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" width="100%" height="28" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">{L_POSTED}: {postrow.POST_DATE}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_POST_SUBJECT}:
					<!-- BEGIN msg_icon --><img src="{postrow.msg_icon.I_ICON}" border="0" title="{postrow.msg_icon.L_ICON}" class="absbottom" />&nbsp;<!-- END msg_icon -->
					<!-- BEGIN sub_type --><!-- BEGIN img --><img src="{postrow.sub_type.I_SUB_TYPE}" border="0" alt="{postrow.sub_type.L_SUB_TYPE}" title="{postrow.sub_type.L_SUB_TYPE}" class="absbottom" /><!-- END img --><!-- BEGIN txt --><b>[{postrow.sub_type.L_SUB_TYPE}]</b><!-- END txt -->&nbsp;<!-- END sub_type -->
					{postrow.POST_SUBJECT}
					<!-- BEGIN sub_title --><br />{L_SUB_TITLE}: {postrow.sub_title.SUB_TITLE}<!-- END sub_title -->
					<!-- BEGIN announce --><br />{postrow.announce.S_ANNOUNCE}<!-- END announce -->
					<!-- BEGIN calendar_event --><br />{postrow.calendar_event.S_CALENDAR_EVENT}<!-- END calendar_event -->
				</span></td>
				<td valign="top" nowrap="nowrap">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG}<!-- BEGIN unmark_read -->&nbsp;<a href="{postrow.U_UNREAD_POST}" class="gensmall"><img src="{I_UNREAD}" border="0" alt="{L_UNREAD_POST}" title="{L_UNREAD_POST}" /></a><!-- END unmark_read -->
				</td>
			</tr>
			<tr> 
				<td colspan="2"><hr /></td>
			</tr>
			<tr>
				<td colspan="2"><span class="postbody">{postrow.MESSAGE}{postrow.ATTACHMENTS}</span><span class="postbody">{postrow.SIGNATURE}</span><span class="gensmall">{postrow.EDITED_MESSAGE}</span></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" width="150" align="left" valign="middle"><span class="nav">
			<a href="#top" class="nav">{L_BACK_TO_TOP}</a>
		</span></td>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" width="100%" height="28" valign="bottom" nowrap="nowrap">
			<table cellspacing="0" cellpadding="0" border="0" style="height: 18px" width="18">
			<tr>
				<td valign="middle" nowrap="nowrap">{postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG}<script language="JavaScript" type="text/javascript"><!-- 

	if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
		document.write(' {postrow.ICQ_IMG}');
	else
		document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');

				//--></script><noscript>{postrow.ICQ_IMG}</noscript></td>
			</tr></table>
		</td>
	</tr>
	<tr> 
		<td class="spaceRow" colspan="2" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END postrow -->
	<tr align="center"> 
		<td class="catBottom" colspan="2" height="28"><table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td align="center"><form method="post" action="{S_POST_DAYS_ACTION}"><span class="gensmall">{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;<input type="submit" value="{L_GO}" class="liteoption" name="submit" /></span></form></td>
			</tr>
		</table></td>
	</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td align="left" valign="top" nowrap="nowrap"><span class="nav">
		<a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a>
		<!-- BEGIN qp_form --><!-- BEGIN qp_button -->&nbsp;&nbsp;<a href="{qp_form.qp_button.U_QUICK_POST}"><img src="{qp_form.qp_button.I_QUICK_POST}" border="0" alt="{qp_form.qp_button.L_QUICK_POST_ALT}" align="middle" /></a><!-- END qp_button --><!-- END qp_form -->
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
		<!-- BEGIN unmark_read --><a href="{U_UNREAD_TOPIC}" class="gensmall">{L_UNREAD_TOPIC}</a>&nbsp;::&nbsp;<!-- END unmark_read -->
		<a href="{U_VIEW_OLDER_TOPIC}" class="gensmall">{L_VIEW_PREVIOUS_TOPIC}</a> :: <a href="{U_VIEW_NEWER_TOPIC}" class="gensmall">{L_VIEW_NEXT_TOPIC}</a><br />
		<!-- BEGIN watch --><a href="{U_WATCH_TOPIC}" class="gensmall"><!-- BEGIN image --><img src="{I_WATCH_TOPIC}" border="0" title="{L_WATCH_TOPIC}" alt="{L_WATCH_TOPIC}" /><!-- BEGINELSE image -->{L_WATCH_TOPIC}<!-- END image --></a><!-- END watch -->
	</span></td>
</tr>
</table>
<!-- BEGIN qp_form -->{QP_BOX}<!-- END qp_form -->
{NAVIGATION_BOX}

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
	<td width="40%" valign="top" nowrap="nowrap" align="left">{S_TOPIC_ADMIN}</td>
	<td align="right" valign="top" nowrap="nowrap">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td nowrap="nowrap" align="right">{JUMPBOX}</td>
		</tr>
		</table><br /><span class="gensmall">{S_AUTH_LIST}
	</span></td>
  </tr>
</table>
