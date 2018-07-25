<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

<table class="forumline" cellpadding="2" cellspacing="2" align="center" border="0">
	<tr>
		<td valign="middle">{INBOX_IMG}</td>
		<td valign="middle"><span class="cattitle">{INBOX} &nbsp;</span></td>
		<td valign="middle">{SENTBOX_IMG}</td>
		<td valign="middle"><span class="cattitle">{SENTBOX} &nbsp;</span></td>
		<td valign="middle">{OUTBOX_IMG}</td>
		<td valign="middle"><span class="cattitle">{OUTBOX} &nbsp;</span></td>
		<td valign="middle">{SAVEBOX_IMG}</td>
		<td valign="middle"><span class="cattitle">{SAVEBOX}</span></td>
	</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="5"><img src="{I_SPACER}" height="5" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table width="100%" cellpadding="2" cellspacing="2" border="0">
<form method="post" action="{S_PRIVMSGS_ACTION}">
	<tr>
		<td valign="middle">{REPLY_PM_IMG}</td>
	</tr>
</table>

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<th class="thHead" colspan="3" nowrap="nowrap">{BOX_NAME} :: {L_MESSAGE}</th>
	</tr>
	<tr>
		<td class="row2" nowrap="nowrap"><span class="genmed">{L_FROM}:</span></td>
		<td class="row2" width="100%" colspan="2"><span class="genmed">{MESSAGE_FROM}</span></td>
	</tr>
	<tr>
		<td class="row2" nowrap="nowrap"><span class="genmed">{L_TO}:</span></td>
		<td class="row2" width="100%" colspan="2"><span class="genmed">{MESSAGE_TO}</span></td>
	</tr>
	<tr>
		<td class="row2" nowrap="nowrap"><span class="genmed">{L_POSTED}:</span></td>
		<td class="row2" width="100%" colspan="2"><span class="genmed">{POST_DATE}</span></td>
	</tr>
	<tr>
		<td class="row2" nowrap="nowrap"><span class="genmed">{L_SUBJECT}:</span></td>
		<td class="row2" width="100%"><span class="genmed">{POST_SUBJECT}</span><span class="gensmall">{POST_SUB_TITLE}</span></td>
		<td class="row2" align="right" nowrap="nowrap"> {QUOTE_PM_IMG} {EDIT_PM_IMG}</td>
	</tr>
	<tr>
		<td valign="top" colspan="3" class="row1"><span class="postbody">{MESSAGE}<!-- BEGIN postrow -->{postrow.ATTACHMENTS}<!-- END postrow --></span>
	  </td>
	</tr>
	<tr>
		<td class="row1" width="78%" height="28" valign="bottom" colspan="3"> 
			<table height="18" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td valign="middle" nowrap="nowrap">{PROFILE_IMG} {PM_IMG} {EMAIL_IMG} 
						{WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG}</td>
					<td>&nbsp;</td>
					<td valign="top" nowrap="nowrap">
						<script language="JavaScript" type="text/javascript">
						<!-- 
							if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
								document.write('{ICQ_IMG}');
							else
								document.write('<div style="position:relative"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px">{ICQ_STATUS_IMG}</div></div>');
						//-->
						</script><noscript>{ICQ_IMG}</noscript>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="catBottom" height="28" align="right" colspan="3">{S_HIDDEN_FIELDS}
			<input type="submit" name="save" value="{L_SAVE_MSG}" class="liteoption" />
			&nbsp; 
			<input type="submit" name="delete" value="{L_DELETE_MSG}" class="liteoption" />
			<!-- BEGIN switch_attachments -->
		&nbsp;
		<input type="submit" name="pm_delete_attach" value="{L_DELETE_ATTACHMENTS}" class="liteoption" />
		<!-- END switch_attachments -->
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

<table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<td>{REPLY_PM_IMG}</td>
		<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</form>
</table>

<table width="100%" align="center" cellspacing="2" border="0">
	<tr>
		<td align="right" valign="top">{JUMPBOX}</td>
	</tr>
</table>
