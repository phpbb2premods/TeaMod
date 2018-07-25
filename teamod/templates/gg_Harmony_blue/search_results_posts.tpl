<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>
<table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
  <tr>
		<td align="left" valign="bottom"><span class="mainSearch">{L_SEARCH_MATCHES}</span></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="1"><img src="{I_SPACER}" height="1" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<!-- BEGIN pagination -->
<table width="100%" cellpadding="2" cellspacing="0" border="0">
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

<table class="forumline" width="100%" align="center" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<th class="thCornerL" width="150" height="25" nowrap="nowrap">{L_AUTHOR}</th>
		<th class="thCornerR" width="100%" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>
	<!-- BEGIN searchresults -->
	<tr>
		<td class="catHead" height="28" colspan="2"><span class="topictitle"><a href="{searchresults.U_TOPIC}" class="topictitle"><img src="{I_TOPIC}" border="0" alt="" align="absmiddle" /></a>&nbsp; {L_TOPIC}:
			<!-- BEGIN sub_type -->
			<!-- BEGIN img -->
			<img src="{searchresults.sub_type.I_SUB_TYPE}" border="0" alt="{searchresults.sub_type.L_SUB_TYPE}" title="{searchresults.sub_type.L_SUB_TYPE}" align="absmiddle" />
			<!-- END img -->
			<!-- BEGIN txt -->
			<b>[{searchresults.sub_type.L_SUB_TYPE}]</b>
			<!-- END txt -->
			<!-- END sub_type -->
			<a href="{searchresults.U_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a>
		</span></td>
	</tr>
	<tr>
		<td class="row1" width="150" align="left" valign="top" rowspan="2"><span class="name"><b>{searchresults.POSTER_NAME}</b></span><br />
			<br />
			<span class="postdetails">{L_REPLIES}: <b>{searchresults.TOPIC_REPLIES}</b><br />
			{L_VIEWS}: <b>{searchresults.TOPIC_VIEWS}</b></span><br />
		</td>
		<td class="row1" width="100%" valign="top"><span class="postdetails">
			<img src="{searchresults.MINI_POST_IMG}" width="12" height="9" alt="{searchresults.L_MINI_POST_ALT}" title="{searchresults.L_MINI_POST_ALT}" border="0" />
			{L_POSTED}: {searchresults.POST_DATE}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_SUBJECT}:
			<!-- BEGIN msg_icon --><img src="{searchresults.msg_icon.I_ICON}" border="0" title="{searchresults.msg_icon.L_ICON}" class="absbottom" />&nbsp;<!-- END msg_icon -->
			<!-- BEGIN sub_type --><!-- BEGIN img --><img src="{searchresults.sub_type.I_SUB_TYPE}" border="0" alt="{searchresults.sub_type.L_SUB_TYPE}" title="{searchresults.sub_type.L_SUB_TYPE}" class="absbottom" />&nbsp;<!-- END img --><!-- BEGIN txt --><b>[{searchresults.sub_type.L_SUB_TYPE}]</b>&nbsp;<!-- END txt --><!-- END sub_type -->
			<b><a href="{searchresults.U_POST}">{searchresults.POST_SUBJECT}</a></b>
			<!-- BEGIN sub_title --><br />{L_SUB_TITLE}: {searchresults.sub_title.SUB_TITLE}<!-- END sub_title -->
			<!-- BEGIN announce --><br />{searchresults.announce.S_ANNOUNCE}<!-- END announce -->
			<!-- BEGIN calendar_event --><br />{searchresults.calendar_event.S_CALENDAR_EVENT}<!-- END calendar_event -->
			<br />{L_FORUM}:&nbsp;
			<!-- BEGIN nav --><a href="{searchresults.nav.U_NAV}" title="{searchresults.nav.L_NAV_DESC}" class="postdetails">{searchresults.nav.L_NAV}</a><!-- BEGIN sep --> &raquo;&nbsp;<!-- END sep --><!-- END nav -->
		</span></td>
	</tr>
	<tr>
		<td class="row1" valign="top"><span class="postbody">{searchresults.MESSAGE}</span></td>
	</tr>
	<!-- END searchresults -->
	<tr>
		<td class="catBottom" height="28" align="center" colspan="2">&nbsp;&nbsp;</td>
	</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

<!-- BEGIN pagination -->
<table width="100%" cellpadding="2" cellspacing="0" border="0">
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

<table width="100%" align="center" cellspacing="2" border="0">
	<tr>
		<td align="right" valign="top">{JUMPBOX}</td>
	</tr>
</table>
