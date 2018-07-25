
	<tr>
		<td class="catHead" height="27" align="center" colspan="2"><span class="cattitle">&nbsp;{L_POLL}&nbsp;::&nbsp;{TOPIC_TITLE}&nbsp;</span></td>
	</tr>
	<tr>
		<td class="row2" colspan="2"><form method="POST" action="{S_POLL_ACTION}"><table align="center" cellpadding="4" cellspacing="0" border="0">
				<tr>
					<td align="center"><span class="gen"><b>{POLL_QUESTION}</b></span></td>
				</tr>
				<tr>
					<td align="center">
						<table cellpadding="2" cellspacing="0" border="0">
							<!-- BEGIN poll_option -->
							<tr>
								<td><input type="radio" name="vote_id" value="{poll_option.POLL_OPTION_ID}" />&nbsp;</td>
								<td><span class="gen">{poll_option.POLL_OPTION_CAPTION}</span></td>
							</tr>
							<!-- END poll_option -->
						</table>
					</td>
				</tr>
				<tr>
					<td align="center">
						<input type="submit" name="submit" value="{L_SUBMIT_VOTE}" class="liteoption" />
					</td>
				</tr>
				<tr>
			  	<td align="center"><span class="gensmall"><b><a href="{U_VIEW_RESULTS}" class="gensmall">{L_VIEW_RESULTS}</a></b></span></td>
				</tr>
		</form></table>{S_HIDDEN_FIELDS}</td>
	</tr>
