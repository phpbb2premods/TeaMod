 
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left" valign="bottom"><span class="maintitle">{L_SEARCH_MATCHES}</span><br /></td>
  </tr>
</table>

{NAVIGATION_BOX}

<!-- BEGIN pagination -->
<table border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
	<td width="100%" valign="bottom"><span class="gensmall">
		<b>{pagination.L_PAGE_OF}</b>&nbsp;{pagination.L_COUNT}
	</span></td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">&nbsp;
		<!-- BEGIN unique_ELSE --><b>{pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
		<!-- BEGIN previous --><b><a href="{pagination.U_PREVIOUS}" class="gensmall">{pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
		<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
		<!-- BEGIN next --><b>&nbsp;<a href="{pagination.U_NEXT}" class="gensmall">{pagination.L_NEXT}</a></b><!-- END next -->
	</span></td>
</tr>
</table>
<!-- END pagination -->

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline" align="center">
<tr>
	<th width="150" height="25" class="thCornerL" nowrap="nowrap">{L_AUTHOR}</th>
	<th width="100%" class="thCornerR" nowrap="nowrap">{L_MESSAGE}</th>
</tr>
<!-- BEGIN searchresults -->
<tr>
	<td class="catHead" colspan="2" height="28"><span class="topictitle">
		&nbsp;{L_TOPIC}:&nbsp;<a href="{searchresults.U_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a>
	</span></td>
</tr>
<tr>
	<td width="150" align="left" valign="top" class="row1"><span class="name">
		<b>{searchresults.POSTER_NAME}</b><br /><br />
	</span><span class="postdetails">
		{L_REPLIES}: <b>{searchresults.TOPIC_REPLIES}</b><br />
		{L_VIEWS}: <b>{searchresults.TOPIC_VIEWS}</b><br />
	</span></td>
	<td width="100%" valign="top" class="row1">
		<!-- BEGIN title -->
		<div class="postbody"><b>
		<!-- END title -->
			<!-- BEGIN msg_icon --><img src="{searchresults.msg_icon.I_ICON}" border="0" title="{searchresults.msg_icon.L_ICON}" class="absbottom" alt="" />&nbsp;<!-- END msg_icon -->
			<!-- BEGIN sub_type --><!-- BEGIN img --><img src="{searchresults.sub_type.I_SUB_TYPE}" border="0" alt="{searchresults.sub_type.L_SUB_TYPE}" title="{searchresults.sub_type.L_SUB_TYPE}" class="absbottom" alt="" /><!-- END img --><!-- BEGIN txt --><b>[{searchresults.sub_type.L_SUB_TYPE}]</b><!-- END txt -->&nbsp;<!-- END sub_type -->
		<!-- BEGIN title -->
			<a href="{searchresults.U_POST}">{searchresults.POST_SUBJECT}</a><br />
		</b></div>
		<!-- END title -->
		<div class="postdetails">
			<!-- BEGIN sub_title -->{searchresults.sub_title.SUB_TITLE}<br /><!-- END sub_title -->
			<!-- BEGIN announce -->{searchresults.announce.S_ANNOUNCE}<br /><!-- END announce -->
			<!-- BEGIN calendar_event -->{searchresults.calendar_event.S_CALENDAR_EVENT}<br /><!-- END calendar_event -->
			<b>{L_FORUM}:&nbsp;</b><!-- BEGIN nav --><a href="{searchresults.nav.U_NAV}" title="{searchresults.nav.L_NAV_DESC}" class="postdetails">{searchresults.nav.L_NAV}</a><!-- BEGIN sep --> &raquo;&nbsp;<!-- END sep --><!-- END nav --><br />
		<hr /></div>
		<div class="postbody">
			{searchresults.MESSAGE}
		</div><div class="postdetails" align="right">
			<br /><img src="{searchresults.MINI_POST_IMG}" align="top" alt="{searchresults.L_MINI_POST_ALT}" title="{searchresults.L_MINI_POST_ALT}" border="0" hspace="2" />{L_POSTED}: {searchresults.POST_DATE}
		</div>
	</td>
</tr>
<tr>
	<td colspan="2" height="1" class="spaceRow"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
</tr>
<!-- END searchresults -->
<tr> 
	<td class="catBottom" colspan="2" height="28" align="center">&nbsp; </td>
</tr>
</table>

<!-- BEGIN pagination -->
<table border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
	<td width="100%" valign="top"><span class="gensmall">
		<b>{pagination.L_PAGE_OF}</b>&nbsp;{pagination.L_COUNT}
	</span></td>
	<td align="right" valign="top" nowrap="nowrap"><span class="gensmall">&nbsp;
		<!-- BEGIN unique_ELSE --><b>{pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
		<!-- BEGIN previous --><b><a href="{pagination.U_PREVIOUS}" class="gensmall">{pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
		<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
		<!-- BEGIN next --><b>&nbsp;<a href="{pagination.U_NEXT}" class="gensmall">{pagination.L_NEXT}</a></b><!-- END next -->
	</span></td>
</tr>
</table>
<!-- END pagination -->

{NAVIGATION_BOX}

{JUMPBOX}
