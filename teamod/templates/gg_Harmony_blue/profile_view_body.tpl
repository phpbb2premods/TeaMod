<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table class="forumline" width="100%" align="center" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<th class="thHead" height="25" nowrap="nowrap" colspan="2">{L_VIEWING_PROFILE}</th>
	</tr>
	<tr>
		<td class="catLeft" width="40%" height="28" align="center"><b><span class="gen">{L_AVATAR}</span></b></td>
		<td class="catRight" width="60%" align="center"><b><span class="gen">{L_ABOUT_USER}</span></b></td>
	</tr>
	<tr>
		<td class="row1" height="6" align="center" valign="top">{AVATAR_IMG}<br /><span class="postdetails">{POSTER_RANK}</span></td>
		<td class="row1" valign="top" rowspan="3">
			<table width="100%" cellpadding="3" cellspacing="1" border="0">
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_JOINED}:</span></td>
					<td class="row1" width="100%"><b><span class="gen">{JOINED}</span></b></td>
				</tr>
				<tr>
					<td align="right" valign="top" nowrap="nowrap"><span class="gen">{L_TOTAL_POSTS}:</span></td>
					<td class="row1" valign="top"><b><span class="gen">{POSTS}</span></b><br /><span class="genmed">[{POST_PERCENT_STATS} / {POST_DAY_STATS}]</span> <br /><span class="genmed"><a href="{U_SEARCH_USER}" class="genmed">{L_SEARCH_USER_POSTS}</a></span></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_LOCATION}:</span></td>
					<td class="row1"><b><span class="gen">{LOCATION}</span></b></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_WEBSITE}:</span></td>
					<td class="row1"><span class="gen"><b>{WWW}</b></span></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_OCCUPATION}:</span></td>
					<td class="row1"><b><span class="gen">{OCCUPATION}</span></b></td>
				</tr>
				<tr>
					<td align="right" valign="top" nowrap="nowrap"><span class="gen">{L_INTERESTS}:</span></td>
					<td class="row1"><b><span class="gen">{INTERESTS}</span></b></td>
				</tr>
				<!-- BEGIN switch_upload_limits -->
		<tr>
			<td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_UPLOAD_QUOTA}:</span></td>
			<td>
				<table width="175" cellspacing="1" cellpadding="2" border="0" class="bodyline">
					<tr>
						<td colspan="3" width="100%" class="row2">
							<table cellspacing="0" cellpadding="1" border="0">
								<tr>
									<td bgcolor="{T_TD_COLOR2}"><img src="{I_SPACER}" width="{UPLOAD_LIMIT_IMG_WIDTH}" height="8" alt="{UPLOAD_LIMIT_PERCENT}" /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="33%" class="row1"><span class="gensmall">0%</span></td>
						<td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
						<td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
					</tr>
				</table>
				<b><span class="genmed">[{UPLOADED} / {QUOTA} / {PERCENT_FULL}]</span> </b><br />
				<span class="genmed"><a href="{U_UACP}" class="genmed">{L_UACP}</a></span></td>
			</td>
		</tr>
		<!-- END switch_upload_limits -->
			</table>
		</td>
	</tr>
	<tr>
		<td class="catLeft" height="28" align="center"><b><span class="gen">{L_CONTACT} {USERNAME} </span></b></td>
	</tr>
	<tr>
		<td class="row1" valign="top">
			<table width="100%" cellpadding="3" cellspacing="1" border="0">
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_EMAIL_ADDRESS}:</span></td>
					<td class="row1" width="100%" valign="middle"><b><span class="gen">{EMAIL_IMG}</span></b></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_PM}:</span></td>
					<td class="row1" valign="middle"><b><span class="gen">{PM_IMG}</span></b></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_MESSENGER}:</span></td>
					<td class="row1" valign="middle"><span class="gen">{MSN}</span></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_YAHOO}:</span></td>
					<td class="row1" valign="middle"><span class="gen">{YIM_IMG}&nbsp;</span></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_AIM}:</span></td>
					<td class="row1" valign="middle"><span class="gen">{AIM_IMG}</span></td>
				</tr>
				<tr>
					<td align="right" valign="middle" nowrap="nowrap"><span class="gen">{L_ICQ_NUMBER}:</span></td>
					<td class="row1">
						<script language="JavaScript" type="text/javascript">
						<!-- 
							if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
								document.write(' {ICQ_IMG}');
							else
								document.write('<table cellspacing="0" cellpadding="0" border="0"><tr><td nowrap="nowrap"><div style="position:relative;height:18px"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{ICQ_STATUS_IMG}</div></div></td></tr></table>');
						//-->
						</script><noscript>{ICQ_IMG}</noscript>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

<table cellpadding="0" width="100%" cellspacing="0" border="0">
	<tr>
		<td height="5" align="center"><img src="{I_SPACER}" height="5" border="0" alt=""></td>
	</tr>
</table>

<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="right" valign="top">{JUMPBOX}</td>
	</tr>
</table>
