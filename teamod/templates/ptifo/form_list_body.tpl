<!-- BEGIN in_admin -->
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>
<!-- END in_admin -->

<!-- BEGIN warning -->
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
	<th class="thHead">{warning.WARNING_TITLE}</th>
</tr>
<tr>
	<td class="row1" align="center"><span class="gen"><br />{warning.WARNING_MSG}<br /><br /></span></td>
</tr>
</table>
<br class="nav" />
<!-- END warning -->

<!-- BEGIN main_include -->
{main_include.TPL}
<!-- END main_include -->

<!-- BEGIN standalone -->
<form method="post" action="{S_ACTION}" name="post">
{NAVIGATION_BOX}
<!-- BEGINELSE standalone -->
<tr><td class="row3" align="center">
<!-- END standalone -->
<table cellspacing="1" cellpadding="4" border="0" width="100%" align="center" class="forumline">
<tr>
	<!-- BEGIN cell_header -->
	<th class="<!-- BEGIN only -->thHead<!-- END only --><!-- BEGIN left -->thCornerL<!-- END left --><!-- BEGIN middle -->thTop<!-- END middle --><!-- BEGIN right -->thCornerR<!-- END right -->">{cell_header.LEGEND}</th>
	<!-- END cell_header -->
</tr>
{LIST}
<!-- BEGIN list_empty -->
<tr>
	<td class="row1" height="35" align="center" colspan="{COUNT_CELLS}"><span class="gen">{L_EMPTY}
	</span></td>
</tr>
<!-- END list_empty -->
<tr>
	<td class="catBottom" align="center" colspan="{COUNT_CELLS}"><span class="gensmall">&nbsp;<!-- BEGIN standalone -->{S_HIDDEN_FIELDS}<!-- END standalone -->
		<!-- BEGIN buttons -->
		<input type="image" name="{buttons.BUTTON}" src="{buttons.I_BUTTON}" border="0" alt="{buttons.L_BUTTON}" title="{buttons.L_BUTTON}" />
		<!-- END buttons -->
	&nbsp;</span></td>
</tr>
</table>
<!-- BEGIN standalone -->
</form><br clear="all" />
<!-- BEGINELSE standalone -->
</td></tr>
<!-- END standalone -->
