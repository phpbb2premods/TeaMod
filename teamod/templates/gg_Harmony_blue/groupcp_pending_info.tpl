<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="2"><img src="{I_SPACER}" height="2" border="0" alt=""></td>
	</tr>
</table>

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
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
		<td class="catSides" height="28" colspan="8"><span class="cattitle">{L_PENDING_MEMBERS}</span></td>
	</tr>
	<!-- BEGIN pending_members_row -->
	<tr>
		<td class="{pending_members_row.ROW_CLASS}" align="center"> {pending_members_row.PM_IMG} 
		</td>
		<td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen"><a href="{pending_members_row.U_VIEWPROFILE}" class="gen">{pending_members_row.USERNAME}</a></span></td>
		<td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.POSTS}</span></td>
		<td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.FROM}</span></td>
		<td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.EMAIL_IMG}</span></td>
		<td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.WWW_IMG}&nbsp;</span></td>
		<td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gensmall"> <input type="checkbox" name="pending_members[]" value="{pending_members_row.USER_ID}" checked="checked" /></span></td>
	</tr>
	<!-- END pending_members_row -->
	<tr>
		<td class="cat" align="right" colspan="8"><span class="cattitle"> 
			<input type="submit" name="approve" value="{L_APPROVE_SELECTED}" class="mainoption" />
			&nbsp; 
			<input type="submit" name="deny" value="{L_DENY_SELECTED}" class="liteoption" />
		</span></td>
	</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="7"><img src="{I_SPACER}" height="7" border="0" alt=""></td>
	</tr>
</table>
