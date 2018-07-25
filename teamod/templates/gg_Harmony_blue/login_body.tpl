<table width="100%" cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td>
			<form action="{S_LOGIN_ACTION}" method="post" target="_top">
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>
 
{NAVIGATION_BOX}

<table class="forumline" width="100%" align="center" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<td class="catHead" height="27" align="center"><span class="cattitle">
			&nbsp;{L_LOGIN}&nbsp;
		</span></td>
	</tr>
	<tr>
		<th class="thHead" height="25" nowrap="nowrap">{L_ENTER_PASSWORD}</th>
	</tr>
	<tr>
		<td class="row1">
			<table width="100%" cellpadding="3" cellspacing="1" border="0">
				<tr>
					<td width="45%" align="right"><span class="gen">{L_USERNAME}:</span></td>
					<td> 
						<input type="text" class="post" name="username" size="25" maxlength="40" value="{USERNAME}" />
					</td>
				</tr>
				<tr>
					<td align="right"><span class="gen">{L_PASSWORD}:</span></td>
					<td> 
						<input type="password" class="post" name="password" size="25" maxlength="32" />
					</td>
				</tr>
			  <!-- BEGIN switch_allow_autologin -->
				<tr align="center">
					<td colspan="2"><span class="gen">{L_AUTO_LOGIN}: <input type="checkbox" name="autologin" checked="checked" /></span></td>
				</tr>
			  <!-- END switch_allow_autologin -->
				<tr align="center">
					<td colspan="2">{S_HIDDEN_FIELDS}<input type="submit" name="login" class="mainoption" value="{L_LOGIN}" /></td>
				</tr>
				<tr align="center">
					<td colspan="2"><span class="gensmall"><a href="{U_SEND_PASSWORD}" class="gensmall">{L_SEND_PASSWORD}</a></span></td>
				</tr>
			</table>
		</td>
	</tr>
</form></table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>
