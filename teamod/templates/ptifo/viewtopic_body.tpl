
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
		<a href="{U_VIEW_OLDER_TOPIC}" class="gensmall"><img src="{I_VIEW_PREVIOUS_TOPIC}" border="0" title="{L_VIEW_PREVIOUS_TOPIC}" alt="{L_VIEW_PREVIOUS_TOPIC}" hspace="2" /></a><!-- BEGIN watch --><a href="{U_WATCH_TOPIC}" class="gensmall"><img src="{I_WATCH_TOPIC}" border="0" title="{L_WATCH_TOPIC}" alt="{L_WATCH_TOPIC}" hspace="2" /></a><!-- END watch --><!-- BEGIN unmark_read --><a href="{U_UNREAD_TOPIC}" class="gensmall"><img src="{I_UNREAD_TOPIC}" border="0" title="{L_UNREAD_TOPIC}" alt="{L_UNREAD_TOPIC}" hspace="2" /></a><!-- END unmark_read --><a href="{U_VIEW_NEWER_TOPIC}" class="gensmall"><img src="{I_VIEW_NEXT_TOPIC}" border="0" title="{L_VIEW_NEXT_TOPIC}" alt="{L_VIEW_NEXT_TOPIC}" hspace="2" /></a>
<!-- BEGIN pagination -->
		<!-- BEGIN unique_ELSE --><br /><b>{pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
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
		<a name="{postrow.U_POST_ID}"></a><b>{postrow.POSTER_NAME}</b></span><br /><span class="postdetails">{postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />{postrow.POSTER_FROM}<br />
	</span></td>
	<td height="100%" class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" width="100%" valign="top">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
		<!-- BEGIN title -->
		<tr><td valign="top"><span class="postbody">
		<!-- END title -->
			<!-- BEGIN msg_icon --><img src="{postrow.msg_icon.I_ICON}" border="0" title="{postrow.msg_icon.L_ICON}" class="absbottom" alt="" />&nbsp;<!-- END msg_icon -->
			<!-- BEGIN sub_type --><!-- BEGIN img --><img src="{postrow.sub_type.I_SUB_TYPE}" border="0" alt="{postrow.sub_type.L_SUB_TYPE}" title="{postrow.sub_type.L_SUB_TYPE}" class="absbottom" /><!-- END img --><!-- BEGIN txt --><b>[{postrow.sub_type.L_SUB_TYPE}]</b><!-- END txt -->&nbsp;<!-- END sub_type -->
			<!-- BEGIN title --><b>{postrow.POST_SUBJECT}</b><br /></span><span class="postdetails"><!-- END title -->
			<!-- BEGIN sub_title -->{postrow.sub_title.SUB_TITLE}<br /><!-- END sub_title -->
			<!-- BEGIN announce -->{postrow.announce.S_ANNOUNCE}<br /><!-- END announce -->
			<!-- BEGIN calendar_event -->{postrow.calendar_event.S_CALENDAR_EVENT}<br /><!-- END calendar_event -->
		<!-- BEGIN title -->
		</span><hr /></td></tr>
		<!-- END title -->
		<tr><td height="100%" valign="top"><span class="postbody">
			{postrow.MESSAGE}{postrow.ATTACHMENTS}<br />
		</span></td></tr>
		<tr><td valign="bottom">
			<div class="postdetails" align="right">
				<a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" hspace="2" /></a><b>{L_POSTED}:</b>&nbsp;{postrow.POST_DATE}{postrow.EDITED_MESSAGE}
			</div><div class="postbody" style="text-align: bottom">
				{postrow.SIGNATURE}
			</div>
		</td></tr>
		</table>
	</td>
</tr>
<tr>
	<td height="18" colspan="2" class="catlight" width="100%" valign="bottom" nowrap="nowrap">
		<table cellspacing="0" cellpadding="0" border="0"><tr>
			<td height="18" valign="middle" nowrap="nowrap">&nbsp;{postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG}<script language="JavaScript" type="text/javascript"><!-- 
	if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
		document.write(' {postrow.ICQ_IMG}');
	else
		document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');
			//--></script><noscript>{postrow.ICQ_IMG}</noscript></td>
			<td height="18" valign="middle" align="right" nowrap="nowrap" width="100%"> {postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG} <!-- BEGIN unmark_read --><a href="{postrow.U_UNREAD_POST}" class="gensmall"><img src="{I_UNREAD}" border="0" alt="{L_UNREAD_POST}" title="{L_UNREAD_POST}" /></a><!-- END unmark_read --> <a href="#top" class="nav"><img src="{I_BACK_TO_TOP}" title="{L_BACK_TO_TOP}" alt="{L_BACK_TO_TOP}" border="0" /></a>&nbsp;</td>
		</tr></table>
	</td>
</tr>
<tr> 
	<td class="spaceRow" colspan="2" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
</tr>
<!-- END postrow -->
<tr align="center">
	<td class="catBottom" colspan="2" height="28" align="center"><form method="post" action="{S_POST_DAYS_ACTION}"><span class="gensmall">
		{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;<input type="image" src="{I_GO}" value="{L_GO}" name="submit" align="top" />
	</span></form></td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td align="left" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a>
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
		<a href="{U_VIEW_OLDER_TOPIC}" class="gensmall"><img src="{I_VIEW_PREVIOUS_TOPIC}" border="0" title="{L_VIEW_PREVIOUS_TOPIC}" alt="{L_VIEW_PREVIOUS_TOPIC}" hspace="2" /></a><!-- BEGIN watch --><a href="{U_WATCH_TOPIC}" class="gensmall"><img src="{I_WATCH_TOPIC}" border="0" title="{L_WATCH_TOPIC}" alt="{L_WATCH_TOPIC}" hspace="2" /></a><!-- END watch --><!-- BEGIN unmark_read --><a href="{U_UNREAD_TOPIC}" class="gensmall"><img src="{I_UNREAD_TOPIC}" border="0" title="{L_UNREAD_TOPIC}" alt="{L_UNREAD_TOPIC}" hspace="2" /></a><!-- END unmark_read --><a href="{U_VIEW_NEWER_TOPIC}" class="gensmall"><img src="{I_VIEW_NEXT_TOPIC}" border="0" title="{L_VIEW_NEXT_TOPIC}" alt="{L_VIEW_NEXT_TOPIC}" hspace="2" /></a>
	</span></td>
</tr>
</table>
<!-- BEGIN qp_form -->{QP_BOX}<!-- END qp_form -->
{NAVIGATION_BOX}

<table width="100%" cellspacing="2" border="0" align="center">
<tr>
	<td valign="top" nowrap="nowrap" align="left">{S_TOPIC_ADMIN}</td>
	<td align="right" width="100%" valign="top" nowrap="nowrap">
		{JUMPBOX}
		<span class="gensmall"><br />{S_AUTH_LIST}
	</span></td>
</tr>
</table>
