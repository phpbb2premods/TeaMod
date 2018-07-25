<!-- BEGIN java -->
<script language="JavaScript" type="text/javascript" src="./includes/js_dom_toggle.js"></script>
<script language="Javascript" type="text/javascript" src="./includes/js_dom_overview.js"></script>
<!-- BEGIN day -->
<div class="dom_overview_abshidden" id="cal_event_{java.day.DAY_ID}"><table class="bodyline" width="300" cellspacing="2" cellpadding="1" border="0"><tr><td><table class="forumline" width="100%" border="0" cellpadding="2" cellspacing="1">
<tr>
	<td class="catHead"><span class="cattitle">
		&nbsp;<a href="{java.day.U_DATE}" class="cattitle">{java.day.L_DATE}</a>&nbsp;
	</span></td>
</tr>
<tr>
	<td class="row1"><span class="gen">&nbsp;
		<!-- BEGIN _event --><img src="{java.day._event.I_EVENT}" title="{java.day._event.L_EVENT}" alt="{java.day._event.L_EVENT}" border="0" hspace="2" align="middle" /><a href="{java.day._event.U_EVENT}" class="gen">{java.day._event.FULL_TITLE}</a><br /><!-- END _event -->
	</span></td>
</tr>
</table></td></tr></table></div>
<!-- END day -->
<!-- END java -->

<table cellpadding="2" cellspacing="1" border="0" class="forumline" width="200">
<tr>
	<th class="thHead" colspan="7">{L_MONTH}&nbsp;{YEAR}</th>
</tr>
<!-- BEGIN selector -->
<tr>
	<td class="catSides" colspan="7" align="center" nowrap="nowrap"><table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="100%" align="center" nowrap="nowrap"><span class="gensmall">
			<select name="month" onchange="this.form.submit();">{S_MONTH}</select>
			<select name="year" onchange="this.form.submit();">{S_YEAR}</select>
			<input type="submit" value="{L_GO}" class="liteoption" />
		</span></td>
	</tr>
	</table></td>
</tr>
<!-- END selector -->
<tr>
	<!-- BEGIN cal_cell -->
	<td align="center" width="{cal_cell.WIDTH}%" class="<!-- BEGIN left -->catLeft<!-- END left --><!-- BEGIN regular -->cat<!-- END regular --><!-- BEGIN right -->catRight<!-- END right -->"><span class="gensmall">
		<b>{cal_cell.L_DAY}</b>
	</span></td>
	<!-- END cal_cell -->
</tr>
<!-- BEGIN cal_row -->
<tr style="height: 25px">
	<!-- BEGIN cal_cell -->
	<!-- BEGIN empty --><td class="row3" colspan="{cal_row.cal_cell.SPAN}" width="{cal_row.cal_cell.WIDTH}%" align="center"><span class="genmed">&nbsp;<!-- END empty -->
	<!-- BEGIN active --><td class="bodyline" width="{cal_row.cal_cell.WIDTH}%" align="center"><span class="genmed"><!-- END active -->
	<!-- BEGIN light --><td class="row1" width="{cal_row.cal_cell.WIDTH}%" align="center"><span class="genmed"><!-- END light -->
	<!-- BEGIN light_ELSE --><td class="row2" width="{cal_row.cal_cell.WIDTH}%" align="center"><span class="genmed"><!-- END light_ELSE -->
		<!-- BEGIN filled -->
		<!-- BEGIN java -->
		<a href="{cal_row.cal_cell.U_DATE}" onMouseOver="dom_overview.show('cal_event_{cal_row.cal_cell.filled.java.DAY_ID}');" class="genmed"><b>{cal_row.cal_cell.DAY}</b></a>
		<!-- BEGINELSE java -->
		<a href="{cal_row.cal_cell.U_DATE}" title="<!-- BEGIN _event -->o {cal_row.cal_cell.filled.java_ELSE._event.FULL_TITLE}<!-- END _event -->" class="genmed"><b>{cal_row.cal_cell.DAY}</b></a>
		<!-- END java -->
		<!-- END filled -->
		<!-- BEGIN filled_ELSE -->
		<a href="{cal_row.cal_cell.U_DATE}" title="" class="genmed">{cal_row.cal_cell.DAY}</a>
		<!-- END filled_ELSE -->
	</span></td>
	<!-- END cal_cell -->
</tr>
<!-- END cal_row -->
<!-- BEGIN selector -->
<tr>
	<td class="catBottom" colspan="7" align="center"><table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="bodyline" nowrap="nowrap"><span class="nav">
			&nbsp;<a href="{U_PREC}" class="nav">&laquo;</a>&nbsp;
		</span></td>
		<td width="100%" align="center"><span class="gensmall">&nbsp;
		</span></td>
		<td class="bodyline" nowrap="nowrap"><span class="nav">
			&nbsp;<a href="{U_NEXT}" class="nav">&raquo;</a>&nbsp;
		</span></td>
	</tr>
	</table></td>
</tr>
<!-- END selector -->
</table>