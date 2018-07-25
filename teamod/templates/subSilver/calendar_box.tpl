<!-- BEGIN java -->
<script language="JavaScript" type="text/javascript" src="./includes/js_dom_toggle.js"></script>
<script language="Javascript" type="text/javascript" src="./includes/js_dom_overview.js"></script>
<!-- BEGIN cal_event -->
<div class="dom_overview_abshidden" id="cal_event_{java.cal_event.EVENT_ID}"><table class="bodyline" width="300" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td><table width="100%"><tr><td>
		{java.cal_event.MESSAGE}
	</td></tr></table></td>
</tr>
</table></div>
<!-- END cal_event -->
<!-- END java -->

<!-- BEGIN full_month_ELSE --><!-- BEGIN java -->
<table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td align="right" width="100%"><span class="mainmenu">
		<a href="#" onClick="dom_toggle.toggle('calrow','calrow_pic', '{DOWN_ARROW}', '{UP_ARROW}'); return false;" class="gensmall"><img src="{TOGGLE_ICON}" id="calrow_pic" hspace="2" border="0" />{L_CALENDAR}</a>
	</span></td>
	<td width="2"><img src="{I_SPACER}" width="2" /></td>
</tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" border="0"><tr><tbody id="calrow" style="display:{TOGGLE_STATUS}"><td>
<!-- END java --><!-- END full_month_ELSE -->

<table align="center" cellpadding="0" cellspacing="1" border="0" width="100%" class="forumline">
<!-- BEGIN full_month -->
<tr>
	<td align="center" class="catHead" colspan="{SPAN_ALL}" width="100%"><table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td nowrap="nowrap"><span class="nav">&nbsp;&nbsp;</span></td>
		<td class="bodyline" nowrap="nowrap"><span class="nav">
			&nbsp;<a href="{U_PREC}" class="nav">&laquo;</a>&nbsp;
		</span></td>
		<td width="100%" align="center"><span class="gensmall">
			<select name="month" onchange="this.form.submit();">{S_MONTH}</select>
			<select name="year" onchange="this.form.submit();">{S_YEAR}</select>
			&nbsp;&nbsp;
			<select name="{POST_FORUM_URL}" onchange="this.form.submit();">{S_FORUM_LIST}</select>
			&nbsp;<input type="submit" value="{L_GO}" class="liteoption" />
		</span></td>
		<td class="bodyline" nowrap="nowrap"><span class="nav">
			&nbsp;<a href="{U_NEXT}" class="nav">&raquo;</a>&nbsp;
		</span></td>
		<td nowrap="nowrap"><span class="nav">&nbsp;&nbsp;</span></td>
	</tr>
	</table></td>
</tr>
<tr>
	<!-- BEGIN cal_cell -->
	<th width="{WIDTH}%" nowrap="nowrap" <!-- BEGIN left --> class="thLeft"<!-- END left --><!-- BEGIN regular --><!-- END regular --><!-- BEGIN right --> class="thRight"<!-- END right -->>
		&nbsp;{full_month.cal_cell.L_DAY}&nbsp;
	</th>
	<!-- END cal_cell -->
</tr>
<!-- BEGINELSE full_month -->
<tr>
	<td colspan="{SPAN_ALL}"><table align="center" cellpadding="4" cellspacing="0" border="0" width="100%"><tr>
		<th class="thHead" align="center" width="100%"><a href="{U_CALENDAR}" title="{L_CALENDAR_ALT}"><img src="{I_CALENDAR_LRG}" border="0" alt="{L_CALENDAR_ALT}" hspace="3" class="absbottom" /></a>{L_CALENDAR}</th>
	</tr></table></td>
</tr>
<!-- END full_month -->
<!-- BEGIN cal_row -->
<tr style="height: 94px">
	<!-- BEGIN cal_cell -->
	<!-- BEGIN empty --><td class="row3" colspan="{cal_row.cal_cell.SPAN}" width="{cal_row.cal_cell.WIDTH}%">&nbsp;
	</td><!-- END empty -->
	<!-- BEGIN filled -->
	<td valign="top" <!-- BEGIN active --> class="bodyline" width="{WIDTH}%"<!-- END active -->>
		<table cellpadding="2" cellspacing="0" border="0" width="100%" style="height: 100%">
		<tr>
			<td class="<!-- BEGIN active -->row1<!-- BEGINELSE active -->row2<!-- END active -->" align="center" nowrap="nowrap"><span class="genmed">
				<a href="{cal_row.cal_cell.U_DATE}" title="{cal_row.cal_cell.DATE}" class="genmed"><!-- BEGIN active --><b><!-- END active -->{cal_row.cal_cell.DATE}<!-- BEGIN active --></b><!-- END active --></a>
			</span></td>
		</tr>
		<tr style="height: 100%">
			<td <!-- BEGIN active_ELSE -->class="row1"<!-- END active_ELSE --> valign="top">
				<table cellspacing="0" cellpadding="0" width="100%">
				<!-- BEGIN _event -->
				<!-- BEGIN _more_header --><tbody id="calcell_{cal_row.cal_cell.EVENT_DATE}" style="display:{cal_row.cal_cell.TOGGLE_STATUS}"><!-- END _more_header -->
				<tr>
					<td nowrap="nowrap"><span class="genmed">
						<!-- BEGIN _content -->
						<img src="{cal_row.cal_cell.filled._event.I_EVENT}" title="{cal_row.cal_cell.filled._event.L_EVENT}" alt="{cal_row.cal_cell.filled._event.L_EVENT}" border="0" hspace="2" align="middle" />
						<!-- BEGIN java -->
						<a href="{cal_row.cal_cell.filled._event.U_EVENT}" class="genmed" onMouseOver="dom_overview.show('cal_event_{cal_row.cal_cell.filled._event.EVENT_ID}');">{cal_row.cal_cell.filled._event.TITLE}</a>
						<!-- BEGINELSE java -->
						<a href="{cal_row.cal_cell.filled._event.U_EVENT}" class="genmed" title="{cal_row.cal_cell.filled._event.MESSAGE}">{cal_row.cal_cell.filled._event.TITLE}</a>
						<!-- END java -->
						<!-- BEGINELSE _content -->
						&nbsp;
						<!-- END _content -->
					</span></td>
					<td align="right" nowrap="nowrap"><span class="gensmall">&nbsp;
						<!-- BEGIN _more --><!-- BEGIN java -->
						<a href="#" onClick="dom_toggle.toggle('calcell_{cal_row.cal_cell.EVENT_DATE}','calcell_pic_{cal_row.cal_cell.EVENT_DATE}', '{DOWN_ARROW}', '{UP_ARROW}'); return false;" title="{L_MORE}" class="gensmall">...<img src="{cal_row.cal_cell.TOGGLE_ICON}" id="calcell_pic_{cal_row.cal_cell.EVENT_DATE}" hspace="2" border="0" /></a>
						<!-- BEGINELSE java -->
						<a href="{cal_row.cal_cell.U_DATE}" title="{L_MORE}" class="gensmall">...<img src="{cal_row.cal_cell.TOGGLE_ICON}" id="calcell_pic_{cal_row.cal_cell.EVENT_DATE}" hspace="2" border="0" /></a>
						<!-- END java --><!-- END _more -->
					</span></td>
				</tr>
				<!-- BEGIN _more_footer --></tbody><!-- END _more_footer -->
				<!-- END _event -->
				</table>
			</td>
		</tr>
		</table>
	</td>
	<!-- END filled -->
	<!-- END cal_cell -->
</tr>
<!-- END cal_row -->
<!-- BEGIN full_month -->
<tr>
	<td class="catBottom" colspan="{SPAN_ALL}"><span class="gensmall">&nbsp;
	</span></td>
</tr>
<!-- END full_month -->
</table>

<!-- BEGIN full_month_ELSE -->
<br class="nav" />
<!-- BEGIN java -->
</td></tbody></tr></table>
<!-- END java -->
<!-- END full_month_ELSE -->
