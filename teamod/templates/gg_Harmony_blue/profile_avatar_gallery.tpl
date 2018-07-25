<table width="100%" cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td>
			<form action="{S_PROFILE_ACTION}" method="post">
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<th class="thHead" height="25" valign="middle" colspan="{S_COLSPAN}">{L_AVATAR_GALLERY}</th>
	</tr>
	<tr>
		<td class="catBottom" height="28" align="center" valign="middle" colspan="6"><span class="genmed">{L_CATEGORY}:&nbsp;{S_CATEGORY_SELECT}&nbsp;<input type="submit" class="liteoption" value="{L_GO}" name="avatargallery" /></span></td>
	</tr>
	<!-- BEGIN avatar_row -->
	<tr>
		<!-- BEGIN avatar_column -->
		<td class="row1" align="center"><img src="{avatar_row.avatar_column.AVATAR_IMAGE}" alt="{avatar_row.avatar_column.AVATAR_NAME}" title="{avatar_row.avatar_column.AVATAR_NAME}" /></td>
		<!-- END avatar_column -->
	</tr>
	<tr>
		<!-- BEGIN avatar_option_column -->
		<td class="row2" align="center"><input type="radio" name="avatarselect" value="{avatar_row.avatar_option_column.S_OPTIONS_AVATAR}" /></td>
		<!-- END avatar_option_column -->
	</tr>
	<!-- END avatar_row -->
	<tr>
		<td class="catBottom" height="28" align="center" colspan="{S_COLSPAN}">{S_HIDDEN_FIELDS}
			<input type="submit" name="submitavatar" value="{L_SELECT_AVATAR}" class="mainoption" />
			&nbsp;&nbsp; 
			<input type="submit" name="cancelavatar" value="{L_RETURN_PROFILE}" class="liteoption" />
		</td>
	</tr>
</form></table>
