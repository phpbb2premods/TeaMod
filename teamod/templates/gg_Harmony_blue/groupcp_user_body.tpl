<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
	<!-- BEGIN switch_groups_joined -->
	<tr>
		<th class="thHead" height="25" align="center" colspan="2">{L_GROUP_MEMBERSHIP_DETAILS}</th>
	</tr>
	<!-- BEGIN switch_groups_member -->
	<tr>
		<td class="row1"><span class="gen">{L_YOU_BELONG_GROUPS}</span></td>
		<td class="row2" align="right"> 
			<table width="90%" cellpadding="0" cellspacing="0" border="0">
				<tr><form method="get" action="{S_USERGROUP_ACTION}">
					<td width="40%"><span class="gensmall">{GROUP_MEMBER_SELECT}</span></td>
					<td width="30%" align="center"> 
						<input type="submit" value="{L_VIEW_INFORMATION}" class="liteoption" />{S_HIDDEN_FIELDS}
					</td>
				</form></tr>
			</table>
		</td>
	</tr>
	<!-- END switch_groups_member -->
	<!-- BEGIN switch_groups_pending -->
	<tr>
		<td class="row1"><span class="gen">{L_PENDING_GROUPS}</span></td>
		<td class="row2" align="right"> 
			<table width="90%" cellpadding="0" cellspacing="0" border="0">
				<tr><form method="get" action="{S_USERGROUP_ACTION}">
					<td width="40%"><span class="gensmall">{GROUP_PENDING_SELECT}</span></td>
					<td width="30%" align="center"> 
						<input type="submit" value="{L_VIEW_INFORMATION}" class="liteoption" />{S_HIDDEN_FIELDS}
					</td>
				</form></tr>
			</table>
		</td>
	</tr>
	<!-- END switch_groups_pending -->
	<!-- END switch_groups_joined -->
	<!-- BEGIN switch_groups_remaining -->
	<tr>
		<th class="thHead" height="25" align="center" colspan="2">{L_JOIN_A_GROUP}</th>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_SELECT_A_GROUP}</span></td>
		<td class="row2" align="right"> 
			<table width="90%" cellpadding="0" cellspacing="0" border="0">
				<tr><form method="get" action="{S_USERGROUP_ACTION}">
					<td width="40%"><span class="gensmall">{GROUP_LIST_SELECT}</span></td>
					<td width="30%" align="center"> 
						<input type="submit" value="{L_VIEW_INFORMATION}" class="liteoption" />{S_HIDDEN_FIELDS}
					</td>
				</form></tr>
			</table>
		</td>
	</tr>
	<!-- END switch_groups_remaining -->
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
		<td align="left"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</table>

<table width="100%" align="center" cellspacing="2" border="0">
	<tr>
		<td align="right" valign="top">{JUMPBOX}</td>
	</tr>
</table>
