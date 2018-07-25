<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr> 
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>
 
{NAVIGATION_BOX}

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
<form action="{S_GROUPCP_ACTION}" method="post">
	<tr>
		<th class="thHead" height="25" colspan="7">{L_GROUP_INFORMATION}</th>
	</tr>
	<tr>
		<td class="row1" width="20%"><span class="gen">{L_GROUP_NAME}:</span></td>
		<td class="row2"><span class="gen"><b>{GROUP_NAME}</b></span></td>
	</tr>
	<tr>
		<td class="row1" width="20%"><span class="gen">{L_GROUP_DESC}:</span></td>
		<td class="row2"><span class="gen">{GROUP_DESC}</span></td>
	</tr>
	<tr>
		<td class="row1" width="20%"><span class="gen">{L_GROUP_MEMBERSHIP}:</span></td>
		<td class="row2"><span class="gen">{GROUP_DETAILS} &nbsp;&nbsp;
			<!-- BEGIN switch_subscribe_group_input -->
			<input class="mainoption" type="submit" name="joingroup" value="{L_JOIN_GROUP}" />
			<!-- END switch_subscribe_group_input -->
			<!-- BEGIN switch_unsubscribe_group_input -->
			<input class="mainoption" type="submit" name="unsub" value="{L_UNSUBSCRIBE_GROUP}" />
			<!-- END switch_unsubscribe_group_input -->
		</span></td>
	</tr>
	<!-- BEGIN switch_mod_option -->
	<tr>
		<td class="row1" width="20%"><span class="gen">{L_GROUP_TYPE}:</span></td>
		<td class="row2"><span class="gen"><input type="radio" name="group_type" value="{S_GROUP_OPEN_TYPE}" {S_GROUP_OPEN_CHECKED} /> {L_GROUP_OPEN} &nbsp;&nbsp;<input type="radio" name="group_type" value="{S_GROUP_CLOSED_TYPE}" {S_GROUP_CLOSED_CHECKED} />	{L_GROUP_CLOSED} &nbsp;&nbsp;<input type="radio" name="group_type" value="{S_GROUP_HIDDEN_TYPE}" {S_GROUP_HIDDEN_CHECKED} />	{L_GROUP_HIDDEN} &nbsp;&nbsp; <input class="mainoption" type="submit" name="groupstatus" value="{L_UPDATE}" /></span></td>
	</tr>
	<!-- END switch_mod_option -->
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

{S_HIDDEN_FIELDS}

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="7"><img src="{I_SPACER}" height="7" border="0" alt=""></td>
	</tr>
</table>

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
</form>
<form action="{S_GROUPCP_ACTION}" method="post" name="post">
	<tr>
		<th class="thCornerL" height="25">{L_PM}</th>
		<th class="thTop">{L_USERNAME}</th>
		<th class="thTop">{L_POSTS}</th>
		<th class="thTop">{L_FROM}</th>
		<th class="thTop">{L_EMAIL}</th>
		<th class="thTop">{L_WEBSITE}</th>
		<th class="thCornerR">{L_SELECT}</th>
	</tr>
	<tr>
		<td class="catSides" height="28" colspan="8"><span class="cattitle">{L_GROUP_MODERATOR}</span></td>
	</tr>
	<tr>
		<td class="row1" align="center"> {MOD_PM_IMG} </td>
		<td class="row1" align="center"><span class="gen"><a href="{U_MOD_VIEWPROFILE}" class="gen">{MOD_USERNAME}</a></span></td>
		<td class="row1" align="center" valign="middle"><span class="gen">{MOD_POSTS}</span></td>
		<td class="row1" align="center" valign="middle"><span class="gen">{MOD_FROM}</span></td>
		<td class="row1" align="center" valign="middle"><span class="gen">{MOD_EMAIL_IMG}</span></td>
		<td class="row1" align="center">{MOD_WWW_IMG}&nbsp;</td>
		<td class="row1" align="center"> &nbsp; </td>
	</tr>
	<tr>
		<td class="catSides" height="28" colspan="8"><span class="cattitle">{L_GROUP_MEMBERS}</span></td>
	</tr>
	<!-- BEGIN member_row -->
	<tr>
		<td class="{member_row.ROW_CLASS}" align="center"> {member_row.PM_IMG} </td>
		<td class="{member_row.ROW_CLASS}" align="center"><span class="gen"><a href="{member_row.U_VIEWPROFILE}" class="gen">{member_row.USERNAME}</a></span></td>
		<td class="{member_row.ROW_CLASS}" align="center"><span class="gen">{member_row.POSTS}</span></td>
		<td class="{member_row.ROW_CLASS}" align="center"><span class="gen"> {member_row.FROM} 
		</span></td>
		<td class="{member_row.ROW_CLASS}" align="center" valign="middle"><span class="gen">{member_row.EMAIL_IMG}</span></td>
		<td class="{member_row.ROW_CLASS}" align="center"> {member_row.WWW_IMG}&nbsp;</td>
		<td class="{member_row.ROW_CLASS}" align="center">&nbsp;
		<!-- BEGIN switch_mod_option -->
		<input type="checkbox" name="members[]" value="{member_row.USER_ID}" />
		<!-- END switch_mod_option -->
		&nbsp;</td>
	</tr>
	<!-- END member_row -->

	<!-- BEGIN switch_no_members -->
	<tr>
		<td class="row1" colspan="7" align="center"><span class="gen">{L_NO_MEMBERS}</span></td>
	</tr>
	<!-- END switch_no_members -->

	<!-- BEGIN switch_hidden_group -->
	<tr>
		<td class="row1" colspan="7" align="center"><span class="gen">{L_HIDDEN_MEMBERS}</span></td>
	</tr>
	<!-- END switch_hidden_group -->

	<!-- BEGIN switch_mod_option -->
	<tr>
		<td class="catBottom" align="right" colspan="8">
			<span class="cattitle"><input type="text" class="post" name="username" maxlength="50" size="20" />&nbsp;<input type="submit" name="add" value="{L_ADD_MEMBER}" class="mainoption" style="width: 160px" />&nbsp;<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" style="width: 180px" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=180,resizable=yes,WIDTH=400');return false;" />&nbsp;&nbsp;&nbsp;<input type="submit" name="remove" value="{L_REMOVE_SELECTED}" class="mainoption" style="width: 180px" /></span>
		</td>
	</tr>
	<!-- END switch_mod_option -->
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
</table>

{PENDING_USER_BOX}

{S_HIDDEN_FIELDS}

<table width="100%" align="center" cellspacing="2" border="0">
</form>
	<tr>
		<td valign="top" align="right">{JUMPBOX}</td>
	</tr>
</table>
