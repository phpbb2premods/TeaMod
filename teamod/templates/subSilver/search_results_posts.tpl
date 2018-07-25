 
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
	<td class="catHead" colspan="2" height="28"><span class="topictitle"><img src="{I_TOPIC}" alt="" align="middle">&nbsp; {L_TOPIC}:&nbsp;<a href="{searchresults.U_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a></span></td>
  </tr>
  <tr> 
	<td width="150" align="left" valign="top" class="row1" rowspan="2"><span class="name"><b>{searchresults.POSTER_NAME}</b></span><br />
	  <br />
	  <span class="postdetails">{L_REPLIES}: <b>{searchresults.TOPIC_REPLIES}</b><br />
	  {L_VIEWS}: <b>{searchresults.TOPIC_VIEWS}</b></span><br />
	</td>
	<td width="100%" valign="top" class="row1"><span class="postdetails">
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
	<td valign="top" class="row1"><span class="postbody">{searchresults.MESSAGE}</span></td>
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

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
