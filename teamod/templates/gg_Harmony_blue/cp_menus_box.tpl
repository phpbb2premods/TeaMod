<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<th class="thHead">{L_MENU}</th>
	</tr>
<!-- BEGIN option --><!-- BEGIN active -->
	<tr>
		<td class="row1" height="25"><span class="gensmall">
			<b>{option.L_OPTION}</b></span>
			<!-- BEGIN subs --><hr /><table width="100%" cellpadding="2" cellspacing="0" border="0"><!-- END subs -->
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
		<td class="row2" height="25" onMouseOver="this.style.cursor='pointer'; this.className='row1'" onMouseOut="this.className='row2';" onClick="location.href='{option.U_OPTION}';"><span class="gensmall">
			<a href="{option.U_OPTION}" class="gensmall"><b>{option.L_OPTION}</b></a>
		</span></td>
	</tr>
<!-- END active --><!-- END option -->
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>
