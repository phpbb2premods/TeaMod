<form name="calendar_scheduler" method="post" action="{S_ACTION}">
{NAVIGATION_BOX}

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
	<td valign="top">
		<!-- BEGIN left_side -->
		<!-- BEGIN first_ELSE --><br class="gensmall" /><!-- END first_ELSE -->
		{left_side.BOX}
		<!-- END left_side -->
	</td>
	<td><span class="gensmall">&nbsp;</span></td>
	<td valign="top" width="100%">
		<!-- BEGIN right_side -->
		<!-- BEGIN first_ELSE --><br class="gensmall" /><!-- END first_ELSE -->
		{right_side.BOX}
		<!-- END right_side -->
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
	<td align="right" valign="bottom" nowrap="nowrap">{S_HIDDEN_FIELDS}
	</td>
</tr>
</table>
</form>