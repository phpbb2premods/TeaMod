 
	<tr>
		<td class="catHead" height="27" align="center" colspan="2"><span class="cattitle">&nbsp;{L_POLL}&nbsp;::&nbsp;{TOPIC_TITLE}&nbsp;</span></td>
	</tr>
	<tr>
		<td class="row2" colspan="2">
			<table cellpadding="4" align="center" cellspacing="0" border="0">
				<tr>
					<td align="center" colspan="4"><span class="gen"><b>{POLL_QUESTION}</b></span></td>
				</tr>
				<tr>
					<td align="center"> 
						<table cellpadding="2" cellspacing="0" border="0">
							<!-- BEGIN poll_option -->
							<tr>
								<td><span class="gen">{poll_option.POLL_OPTION_CAPTION}</span></td>
								<td> 
									<table cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td><img src="{poll_option.POLL_OPTION_IMG_LEFT}" width="4" alt="" height="12" /></td>
											<td><img src="{poll_option.POLL_OPTION_IMG}" width="{poll_option.POLL_OPTION_IMG_WIDTH}" height="12" alt="{poll_option.POLL_OPTION_PERCENT}" /></td>
											<td><img src="{poll_option.POLL_OPTION_IMG_RIGHT}" width="4" alt="" height="12" /></td>
										</tr>
									</table>
								</td>
								<td align="center"><b><span class="gen">&nbsp;{poll_option.POLL_OPTION_PERCENT}&nbsp;</span></b></td>
								<td align="center"><span class="gen">[ {poll_option.POLL_OPTION_RESULT} ]</span></td>
							</tr>
							<!-- END poll_option -->
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4"><span class="gen"><b>{L_TOTAL_VOTES} : {TOTAL_VOTES}</b></span></td>
				</tr>
			</table>
	  </td>
	</tr>
