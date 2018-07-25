<!-- BEGIN in_admin -->
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>
<!-- END in_admin -->

<!-- BEGIN javascript -->
<script language="JavaScript" type="text/javascript" src="{javascript.U_JAVASCRIPT}"></script>
<!-- END javascript -->

<!-- BEGIN warning -->
<table class="forumline" width="100%" align="center" cellpadding="4" cellspacing="1" border="0">
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

{NAVIGATION_BOX}

<table width="100%" cellpadding="0" cellspacing="2" border="0"><form action="{S_ACTION}" method="post" name="post" {S_FORM_HTML}>
	<tr>
		<td width="200" valign="top">{CP_MENUS_BOX}</td>
		<td valign="top">
			<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
				<tr>
					<th class="thHead" colspan="2">{L_FORM}</th>
				</tr>
				{FORM}
				<!-- BEGIN empty -->
				<tr>
					<td class="row1" colspan="2" height="30" align="center"><span class="gen">
						{L_EMPTY}
					</span></td>
				</tr>
				<!-- END empty -->
				<tr>
					<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<span class="gensmall">&nbsp;
						<!-- BEGIN buttons --><input type="image" src="{buttons.I_BUTTON}" name="{buttons.BUTTON}" title="{buttons.L_BUTTON}" <!-- BEGIN accesskey -->accesskey="{buttons.S_BUTTON}"<!-- END accesskey --> />&nbsp;<!-- END buttons -->
					</span></td>
				</tr>
			</table>
			<table class="shadow" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
					<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
					<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
				</tr>
			</table>
		</td>
	</tr>
</form></table>

<!-- BEGIN in_admin -->
<br clear="all" />
<!-- END in_admin -->
