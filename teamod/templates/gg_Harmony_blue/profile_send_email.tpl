<script language="JavaScript" type="text/javascript">
<!--
function checkForm(formObj) {

	formErrors = false;    

	if (formObj.message.value.length < 2) {
		formErrors = "{L_EMPTY_MESSAGE_EMAIL}";
	}
	else if ( formObj.subject.value.length < 2)
	{
		formErrors = "{L_EMPTY_SUBJECT_EMAIL}";
	}

	if (formErrors) {
		alert(formErrors);
		return false;
	}
}
//-->
</script>

<table width="100%" cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td>
			<form action="{S_POST_ACTION}" method="post" name="post" onSubmit="return checkForm(this)">
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

{ERROR_BOX}

{NAVIGATION_BOX}

<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<th class="thHead" height="25" colspan="2"><b>{L_SEND_EMAIL_MSG}</b></th>
	</tr>
	<tr>
		<td class="row1" width="22%"><span class="gen"><b>{L_RECIPIENT}</b></span></td>
		<td class="row2" width="78%"><span class="gen"><b>{USERNAME}</b></span> </td>
	</tr>
	<tr>
		<td class="row1" width="22%"><span class="gen"><b>{L_SUBJECT}</b></span></td>
		<td class="row2" width="78%"><span class="gen"><input type="text" name="subject" size="45" maxlength="100" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" /></span> </td>
	</tr>
	<tr>
		<td class="row1" valign="top"><span class="gen"><b>{L_MESSAGE_BODY}</b></span><br /><span class="gensmall">{L_MESSAGE_BODY_DESC}</span></td>
		<td class="row2"><span class="gen"><textarea name="message" rows="25" cols="40" wrap="virtual" style="width:500px" tabindex="3" class="post">{MESSAGE}</textarea></span></td>
	</tr>
	<tr>
		<td class="row1" valign="top"><span class="gen"><b>{L_OPTIONS}</b></span></td>
		<td class="row2">
			<table cellpadding="1" cellspacing="0" border="0">
				<tr>
					<td><input type="checkbox" name="cc_email"  value="1" checked="checked" /></td>
					<td><span class="gen">{L_CC_EMAIL}</span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="catBottom" height="28" align="center" colspan="2">{S_HIDDEN_FIELDS}<input type="submit" tabindex="6" name="submit" class="mainoption" value="{L_SEND_EMAIL}" /></td>
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
		<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</form></table>

<table width="100%" align="center" cellspacing="2" border="0">
	<tr>
		<td valign="top" align="right">{JUMPBOX}</td>
	</tr>
</table>
