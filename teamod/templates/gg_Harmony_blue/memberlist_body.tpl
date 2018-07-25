<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
<form method="post" action="{S_MODE_ACTION}">
	<tr>
		<td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
			<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
		</span></td>
	</tr>
</table>
<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<th class="thCornerL" height="25" nowrap="nowrap">#</th>
		<th class="thTop" nowrap="nowrap">{L_PM}</th>
		<th class="thTop" nowrap="nowrap">{L_USERNAME}</th>
		<th class="thTop" nowrap="nowrap">{L_EMAIL}</th>
		<th class="thTop" nowrap="nowrap">{L_FROM}</th>
		<th class="thTop" nowrap="nowrap">{L_JOINED}</th>
		<th class="thTop" nowrap="nowrap">{L_POSTS}</th>
		<th class="thCornerR" nowrap="nowrap">{L_WEBSITE}</th>
	</tr>
	<!-- BEGIN memberrow -->
	<tr>
		<td class="{memberrow.ROW_CLASS}" align="center"><span class="gen">&nbsp;{memberrow.ROW_NUMBER}&nbsp;</span></td>
		<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.PM_IMG}&nbsp;</td>
		<td class="{memberrow.ROW_CLASS}" align="center"><span class="gen"><a href="{memberrow.U_VIEWPROFILE}" class="gen">{memberrow.USERNAME}</a></span></td>
		<td class="{memberrow.ROW_CLASS}" align="center" valign="middle">&nbsp;{memberrow.EMAIL_IMG}&nbsp;</td>
		<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{memberrow.FROM}</span></td>
		<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{memberrow.JOINED}</span></td>
		<td class="{memberrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{memberrow.POSTS}</span></td>
		<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.WWW_IMG}&nbsp;</td>
	</tr>
	<!-- END memberrow -->
	<tr>
		<td class="catBottom" height="28" colspan="8">&nbsp;</td>
	</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

<table width="100%" cellspacing="2" border="0">
	<tr>
		<td align="left"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right"><span class="nav">{PAGINATION}</span></td>
	</tr>
</form></table>

<table width="100%" align="center" cellspacing="2" border="0">
	<tr>
		<td valign="top" align="right">{JUMPBOX}</td>
	</tr>
</table>
