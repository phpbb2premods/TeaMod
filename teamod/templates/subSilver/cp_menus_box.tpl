<table cellpadding="4" cellspacing="1" border="0" width="100%" class="forumline">
<tr>
	<th class="thHead">{L_MENU}</th>
</tr>
<!-- BEGIN option --><!-- BEGIN active -->
<tr>
	<td height="25" class="row1"><span class="gensmall">
		<b>{option.L_OPTION}</b></span>
		<!-- BEGIN subs --><hr /><table cellspacing="0" cellpadding="2" border="0" width="100%"><!-- END subs -->
			<!-- BEGIN sub --><!-- BEGIN select -->
			<tr>
				<td width="10" align="right"><span class="gensmall"><b>&raquo;</b>
				</span></td>
				<td nowrap="nowrap"><span class="gensmall" style="font-weight: bold;">{option.active.sub.L_OPTION}<br />
				</span></td>
			</tr>
			<!-- BEGINELSE select -->
			<tr>
				<td width="10" align="right"><span class="gensmall">&raquo;
				</span></td>
				<td nowrap="nowrap" onMouseOver="this.style.cursor='pointer'; this.style.fontWeight='bold';" onMouseOut="this.style.cursor='pointer'; this.style.fontWeight='normal';" onClick="location.href='{option.active.sub.U_OPTION}';"><span class="gensmall"><a href="{option.active.sub.U_OPTION}" class="gensmall">{option.active.sub.L_OPTION}</a><br />
				</span></td>
			</tr>
			<!-- END select --><!-- END sub -->
		<!-- BEGIN subs --></table><!-- END subs -->
	</td>
</tr>
<!-- BEGINELSE active -->
<tr>
	<td height="25" class="row2" onMouseOver="this.style.cursor='pointer'; this.className='row1'" onMouseOut="this.className='row2';" onClick="location.href='{option.U_OPTION}';"><span class="gensmall">
		<a href="{option.U_OPTION}" class="gensmall"><b>{option.L_OPTION}</b></a>
	</span></td>
</tr>
<!-- END active --><!-- END option -->
</table>