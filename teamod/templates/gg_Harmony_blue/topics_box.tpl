<!-- BEGIN forum_header -->
<table width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<td><span class="mainPost">
			<a href="{forum_header.U_VIEW_FORUM}" title="{forum_header.FORUM_DESC}" class="mainPost">{forum_header.FORUM_NAME}</a>
			</span><span class="gensmall"><br />
			<!-- BEGIN moderators --><b>{L_MODERATORS}:&nbsp;</b><!-- BEGIN mod --><a href="{forum_header.moderators.mod.U_MOD}" title="{forum_header.moderators.mod.L_MOD_TITLE}" class="gensmall">{forum_header.moderators.mod.L_MOD}</a><!-- BEGIN sep -->, <!-- END sep --><!-- END mod --><!-- END moderators -->
		</span></td>
	</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<td valign="bottom" nowrap="nowrap"><a href="{U_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}"><img src="{I_POST_NEW_TOPIC}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
		<td width="100%" valign="bottom"><span class="gensmall">
			<!-- BEGIN pagination --><b>{forum_header.pagination.L_PAGE_OF}</b>&nbsp;{forum_header.pagination.L_COUNT}<!-- END pagination -->
		</span></td>
		<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">
			<!-- BEGIN mark --><a href="{forum_header.U_MARK_READ}" class="gensmall">{forum_header.L_MARK_READ}</a><br /><!-- END mark -->
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
<table width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<td valign="top" nowrap="nowrap"><a href="{U_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}"><img src="{I_POST_NEW_TOPIC}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
		<td width="100%" valign="top"><span class="gensmall">
			<!-- BEGIN pagination --><b>{forum_header.pagination.L_PAGE_OF}</b>&nbsp;{forum_header.pagination.L_COUNT}<!-- END pagination -->
		</span></td>
		<td align="right" valign="top" nowrap="nowrap"><span class="gensmall">
			<!-- BEGIN pagination -->
			<!-- BEGIN unique_ELSE --><b>{forum_header.pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
			<!-- BEGIN previous --><b><a href="{forum_header.pagination.U_PREVIOUS}" class="gensmall">{forum_header.pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
			<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{forum_header.pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{forum_header.pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
			<!-- BEGIN next --><b>&nbsp;<a href="{forum_header.pagination.U_NEXT}" class="gensmall">{forum_header.pagination.L_NEXT}</a></b><!-- END next -->
			<!-- BEGIN unique_ELSE --><br /><!-- END unique_ELSE -->
			<!-- END pagination -->
			<!-- BEGIN mark --><a href="{forum_header.U_MARK_READ}" class="gensmall">{forum_header.L_MARK_READ}</a><!-- END mark -->
		</span></td>
	</tr>
</table>
<!-- END forum_header -->
