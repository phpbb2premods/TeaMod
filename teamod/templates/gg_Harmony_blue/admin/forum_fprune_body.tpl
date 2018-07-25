<script language="JavaScript" type="text/javascript">
<!--
	function branch_set(root_id)
	{
		checked = false;
		id = -1;
		last_id = -1;
		for ( i = 0; i < document.post.elements.length; i++ )
		{
			if ( id < 0 )
			{
				if ( (document.post.elements[i].name == 'forum_ids[]') && (document.post.elements[i].value == root_id) )
				{
					id = document.post.elements[i].value;
					checked = document.post.elements[i].checked;
				}
			}
			if ( id >= 0 )
			{
				if ( last_id < 0 )
				{
					if ( document.post.elements[i].name == 'last_child_ids[' + id + ']' )
					{
						last_id = document.post.elements[i].value;
					}
				}
				if ( id == last_id )
				{
					break;
				}
				if ( document.post.elements[i].name == 'forum_ids[]' )
				{
					document.post.elements[i].checked = checked;
					if ( document.post.elements[i].value == last_id )
					{
						break;
					}
				}
			}
		}
	}
//-->
</script>

<!-- BEGIN in_admin -->
<h1>{L_TITLE}</h1>

<p>{L_EXPLAIN}</p>
<!-- END in_admin -->

<form action="{S_ACTION}" method="post" name="post">
<table width="100%" cellpadding="2" cellspacing="1" border="0">
<tr>
	<td width="100%"><span class="gen">
		<b>{L_PRUNE_DAYS}:</b>&nbsp;<input type="text" name="prune_days" value="{PRUNE_DAYS}" class="post" size="4" />&nbsp;{L_DAYS}
	</span></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="1" border="0" class="forumline">
<tr>
	<th class="thCornerL" nowrap="nowrap">&nbsp;{L_SELECT}&nbsp;</th>
	<th class="thTop" height="25" nowrap="nowrap" width="100%">&nbsp;{L_FORUM}&nbsp;</th>
	<th width="70" class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	<th width="70" class="thCornerR" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
</tr>
<tr>
	<td><table cellpadding="0" cellspacing="0" border="0" width="100%">
	<!-- BEGIN row -->
	<tr>
		<td height="25" align="center" class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><span class="gensmall">
			<!-- BEGIN forum --><input type="checkbox" name="forum_ids[]" value="{row.FORUM_ID}" onClick="javascript:branch_set({row.FORUM_ID})" /><input type="hidden" name="last_child_ids[{row.FORUM_ID}]" value="{row.LAST_CHILD_ID}" /><!-- END forum -->
		</span></td>
	</tr>
	<!-- END row -->
	</table></td>

	<td><table cellpadding="0" cellspacing="0" border="0" width="100%">
	<!-- BEGIN row -->
	<tr>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" height="25">
			<table cellpadding="0" cellspacing="0" width="100%"><tr>
			<td><img src="{I_SPACER}" border="0" width="4" alt="" /></td>
			<!-- BEGIN inc --><td><img src="{row.inc.I_INC}" border="0" alt="" /></td><!-- END inc -->
			<td width="100%" nowrap="nowrap"><span class="forumlink"><!-- BEGIN root_ELSE -->&nbsp;<!-- END root_ELSE -->
				<!-- BEGIN nav_icon --><img src="{row.I_NAV_ICON}" border="0" alt="" />&nbsp;<!-- END nav_icon -->
				<!-- BEGIN edit --><a href="{row.U_EDIT}" class="forumlink" title="{row.FORUM_DESC}"><!-- END edit -->{row.FORUM_NAME}<!-- BEGIN edit --></a><!-- END edit -->&nbsp;
				<!-- BEGIN root_ELSE -->&nbsp;[<img src="{row.I_FORUM_FOLDER}" title="{row.L_FORUM_FOLDER}" alt="" border="0" />]<!-- END root_ELSE -->
			</span></td>
			</tr></table>
		</td>
	</tr>
	<!-- END row -->
	</table></td>

	<td><table cellpadding="0" cellspacing="0" border="0" width="100%">
	<!-- BEGIN row -->
	<tr>
		<td height="25" align="center" class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><span class="gen">&nbsp;
			<!-- BEGIN prune -->{row.PRUNED_TOPICS}<!-- END prune -->&nbsp;
		</span></td>
	</tr>
	<!-- END row -->
	</table></td>

	<td><table cellpadding="0" cellspacing="0" border="0" width="100%">
	<!-- BEGIN row -->
	<tr>
		<td height="25" align="center" class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><span class="gen">&nbsp;
			<!-- BEGIN prune -->{row.PRUNED_POSTS}<!-- END prune -->&nbsp;
		</td>
	</tr>
	<!-- END row -->
	</table></td>
</tr>
<tr>
	<td class="catBottom" colspan="4" align="center" valign="middle">{S_HIDDEN_FIELDS}<span class="gensmall">&nbsp;
		<!-- BEGIN buttons --><input type="image" name="{buttons.BUTTON}" src="{buttons.I_BUTTON}" alt="{buttons.L_BUTTON}" title="{buttons.L_BUTTON}" <!-- BEGIN accesskey -->accesskey="{buttons.S_BUTTON}"<!-- END accesskey --> />&nbsp;<!-- END buttons -->
	</span></td>
</tr>
</table>
</form>
<br clear="all" />
