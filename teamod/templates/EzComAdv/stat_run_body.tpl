<!-- BEGIN stat_run_table -->
<br class="nav" />

<table width="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
   		<td width="11" height="11"><img src="templates/EzComAdv/images/coin_hg2.jpg"></td>
        <td height="11" width="100%" background="templates/EzComAdv/images/bordhau2.jpg"></td>
        <td width="11" height="11"><img src="templates/EzComAdv/images/coin_hd2.jpg"></td>
   </tr>
   <tr>
		<td width="11" background="templates/EzComAdv/images/bordgau2.jpg"></td>
		<td>
		
<table cellpadding="2" cellspacing="1" border="0" width="100%" class="bodyline">
<tr>
	<td colspan="2" align="center"><span class="gensmall">
	{L_STAT_PAGE_DUR}{L_STAT_QUERIES}{L_STAT_SETUP}
	</span></td>
</tr>
<!-- END stat_run_table -->
<!-- BEGIN stat_run -->
<tr>
	<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><span class="gensmall">
		{stat_run.STAT_FILE}<br />
		{stat_run.STAT_LINE}<br />
		<!-- BEGIN cached -->{stat_run.STAT_TIME_CACHE}<br /><!-- END cached -->
		{stat_run.STAT_TIME_DB}<br />
		</span>
	</td>
	<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->">
		<table cellpadding="2" cellspacing="1" width="100%" class="bodyline">
		<tr><td class="row3"><span class="gensmall">{L_STAT_REQUEST}
		</span></td></tr><tr><td class="row1"><span class="gensmall">&nbsp;{stat_run.STAT_REQUEST}&nbsp;
		</span></td></tr>
		</table>
		<!-- BEGIN explain -->
		<table cellpadding="2" cellspacing="1" width="100%" class="bodyline">
		<tr>
			<!-- BEGIN cell -->
			<td align="center" class="row3"><span class="gensmall">&nbsp;
				{stat_run.explain.cell.STAT_LEGEND}&nbsp;
			</span></td>
			<!-- END cell -->
		</tr>
		<!-- BEGIN table -->
		<tr>
			<!-- BEGIN cell -->
			<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><span class="gensmall">&nbsp;
				{stat_run.explain.table.cell.STAT_VALUE}&nbsp;
			</span></td>
			<!-- END cell -->
		</tr>
		<!-- END table -->
		</table>
		<!-- END explain -->
	</td>
</tr>
<!-- END stat_run -->
<!-- BEGIN stat_run_table -->
</table>

<td width="11" background="templates/EzComAdv/images/borddroit2.jpg"></td>
	</tr>
	<tr>
		<td width="11" height="11"><img src="templates/EzComAdv/images/coin_bg2.jpg"></td>
		<td height="11" width="100%" background="templates/EzComAdv/images/bordbas2.jpg"></td>
		<td width="11" height="11"><img src="templates/EzComAdv/images/coin_bg2.jpg"></td>
	</tr>
</table>

<br clear="all" />
<!-- END stat_run_table -->