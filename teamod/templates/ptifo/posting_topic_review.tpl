
<!-- BEGIN switch_inline_mode -->
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr> 
		<td class="catHead" height="28" align="center"><b><span class="cattitle">{L_TOPIC_REVIEW}</span></b></td>
	</tr>
	<tr>
		<td class="row1"><iframe width="100%" height="300" src="{U_REVIEW_TOPIC}" >
<!-- END switch_inline_mode -->

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

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thCornerL" width="22%" height="26">{L_AUTHOR}</th>
		<th class="thCornerR">{L_MESSAGE}</th>
	</tr>
	<!-- BEGIN postrow -->
	<tr>
		<td width="22%" align="left" valign="top" class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><span class="name"><b>{postrow.POSTER_NAME}</b></span></td>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" height="28" valign="top">
			<!-- BEGIN title -->
			<div class="postbody">
			<!-- END title -->
				<!-- BEGIN msg_icon --><img src="{postrow.msg_icon.I_ICON}" border="0" title="{postrow.msg_icon.L_ICON}" align="top" alt="" />&nbsp;<!-- END msg_icon -->
				<!-- BEGIN sub_type --><!-- BEGIN img --><img src="{postrow.sub_type.I_SUB_TYPE}" border="0" alt="{postrow.sub_type.L_SUB_TYPE}" title="{postrow.sub_type.L_SUB_TYPE}" align="top" /><!-- END img --><!-- BEGIN txt --><b>[{postrow.sub_type.L_SUB_TYPE}]</b><!-- END txt -->&nbsp;<!-- END sub_type -->
			<!-- BEGIN title -->
				<b>{postrow.POST_SUBJECT}</b>
			</div>
			<div class="postdetails">
			<!-- END title -->
				<!-- BEGIN sub_title -->{postrow.sub_title.SUB_TITLE}<br /><!-- END sub_title -->
				<!-- BEGIN announce -->{postrow.announce.S_ANNOUNCE}<br /><!-- END announce -->
				<!-- BEGIN calendar_event -->{postrow.calendar_event.S_CALENDAR_EVENT}<br /><!-- END calendar_event -->
			<!-- BEGIN title -->
			<hr /></div>
			<!-- END title -->
			<div class="postbody">
				{postrow.MESSAGE}{postrow.ATTACHMENTS}
			</div><div class="postdetails" align="right">
				<br /><img src="{postrow.MINI_POST_IMG}" align="top" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" hspace="2" />{L_POSTED}: {postrow.POST_DATE}
			</div>
		</td>
	</tr>
	<tr> 
		<td colspan="2" height="1" class="spaceRow"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
	</tr>
	 <!-- END postrow -->
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

<!-- BEGIN switch_inline_mode -->
		</iframe></td>
	</tr>
</table>
<!-- END switch_inline_mode -->
