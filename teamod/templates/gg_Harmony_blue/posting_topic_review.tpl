<!-- BEGIN switch_inline_mode -->
<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<td class="catHead" height="28" align="center"><b><span class="cattitle">{L_TOPIC_REVIEW}</span></b></td>
	</tr>
	<tr>
		<td class="row1"><iframe width="100%" height="300" src="{U_REVIEW_TOPIC}">
<!-- END switch_inline_mode -->
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

			<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
				<tr>
					<th class="thCornerL" width="22%" height="26">{L_AUTHOR}</th>
					<th class="thCornerR">{L_MESSAGE}</th>
				</tr>
				<!-- BEGIN postrow -->
				<tr>
					<td class="{postrow.ROW_CLASS}" width="22%" align="left" valign="top"><span class="name"><b>{postrow.POSTER_NAME}</b></span></td>
					<td class="{postrow.ROW_CLASS}" height="28" valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="100%"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /><span class="postdetails">{L_POSTED}: {postrow.POST_DATE}<span class="gen">&nbsp;</span>&nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}:
									<!-- BEGIN msg_icon --><img src="{postrow.msg_icon.I_ICON}" border="0" title="{postrow.msg_icon.L_ICON}" class="absbottom" />&nbsp;<!-- END msg_icon -->
									<!-- BEGIN sub_type --><!-- BEGIN img --><img src="{postrow.sub_type.I_SUB_TYPE}" border="0" alt="{postrow.sub_type.L_SUB_TYPE}" title="{postrow.sub_type.L_SUB_TYPE}" class="absbottom" />&nbsp;<!-- END img --><!-- BEGIN txt --><b>[{postrow.sub_type.L_SUB_TYPE}]</b>&nbsp;<!-- END txt --><!-- END sub_type -->
									{postrow.POST_SUBJECT}
									<!-- BEGIN sub_title --><br />{L_SUB_TITLE}: {postrow.sub_title.SUB_TITLE}<!-- END sub_title -->
									<!-- BEGIN announce --><br />{postrow.announce.S_ANNOUNCE}<!-- END announce -->
									<!-- BEGIN calendar_event --><br />{postrow.calendar_event.S_CALENDAR_EVENT}<!-- END calendar_event -->
								</span></td>
							</tr>
							<tr>
								<td colspan="2"><hr /></td>
							</tr>
							<tr>
								<td colspan="2"><span class="postbody">{postrow.MESSAGE}{postrow.ATTACHMENTS}</span></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="spaceRow" height="1" colspan="2"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
				</tr>
				<!-- END postrow -->
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

<!-- BEGIN switch_inline_mode -->
		</iframe></td>
	</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>
<!-- END switch_inline_mode -->

<br />
