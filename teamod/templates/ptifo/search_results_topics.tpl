<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr> 
	<td align="left" valign="bottom"><span class="maintitle">{L_SEARCH_MATCHES}
	</span><br /></td>
</tr>
</table>

{NAVIGATION_BOX}

<!-- BEGIN forum_header -->
<table border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
	<td width="100%" valign="bottom"><span class="gensmall">
		<!-- BEGIN pagination --><b>{forum_header.pagination.L_PAGE_OF}</b>&nbsp;{forum_header.pagination.L_COUNT}<!-- END pagination -->
	</span></td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">&nbsp;
<!-- BEGIN pagination -->
		<!-- BEGIN unique_ELSE --><b>{forum_header.pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
		<!-- BEGIN previous --><b><a href="{forum_header.pagination.U_PREVIOUS}" class="gensmall">{forum_header.pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
		<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{forum_header.pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{forum_header.pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
		<!-- BEGIN next --><b>&nbsp;<a href="{forum_header.pagination.U_NEXT}" class="gensmall">{forum_header.pagination.L_NEXT}</a></b><!-- END next -->
<!-- END pagination -->
	</span></td>
</tr>
</table>
<!-- END forum_header -->
<!-- INCLUDE topics_row_box.tpl -->
<!-- BEGIN forum_header -->
<table border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
	<td width="100%" valign="bottom"><span class="gensmall">
		<!-- BEGIN pagination --><b>{forum_header.pagination.L_PAGE_OF}</b>&nbsp;{forum_header.pagination.L_COUNT}<!-- END pagination -->
	</span></td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">&nbsp;
<!-- BEGIN pagination -->
		<!-- BEGIN unique_ELSE --><b>{forum_header.pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
		<!-- BEGIN previous --><b><a href="{forum_header.pagination.U_PREVIOUS}" class="gensmall">{forum_header.pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
		<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{forum_header.pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{forum_header.pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
		<!-- BEGIN next --><b>&nbsp;<a href="{forum_header.pagination.U_NEXT}" class="gensmall">{forum_header.pagination.L_NEXT}</a></b><!-- END next -->
<!-- END pagination -->
	</span></td>
</tr>
</table>
<!-- END forum_header -->

{NAVIGATION_BOX}

{JUMPBOX}
