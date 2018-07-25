<!-- BEGIN stat_run_table -->
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="5"><img src="{I_SPACER}" height="5" border="0" alt=""></td>
	</tr>
</table>
<table class="bodyline" width="100%" cellpadding="2" cellspacing="1" border="0">
	<tr>
		<td align="center" colspan="2"><span class="gensmall">
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
			<table class="bodyline" width="100%" cellpadding="2" cellspacing="1">
				<tr>
					<td class="row3"><span class="gensmall">{L_STAT_REQUEST}
					</span></td>
				</tr>
				<tr>
					<td class="row1"><span class="gensmall">&nbsp;{stat_run.STAT_REQUEST}&nbsp;
					</span></td>
				</tr>
			</table>
			<!-- BEGIN explain -->
			<table class="bodyline" width="100%" cellpadding="2" cellspacing="1">
				<tr>
					<!-- BEGIN cell -->
					<td class="row3" align="center"><span class="gensmall">&nbsp;
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
<br clear="all" />
<!-- END stat_run_table -->
