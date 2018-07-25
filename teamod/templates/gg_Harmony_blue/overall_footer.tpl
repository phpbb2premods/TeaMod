			<!-- BEGIN user_is_admin -->
			<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td height="5"><img src="{I_SPACER}" height="5" border="0" alt=""></td>
				</tr>
				<tr>
					<td align="center">
						<a href="{U_ADMIN_LINK}" class="mainmenu"><img src="{I_ADMIN_LINK}" border="0" alt="{L_ADMIN_LINK}" align="middle" hspace="3" />{L_ADMIN_LINK}</a>
					</td>
				</tr>
			</table>
			<!-- END user_is_admin -->

			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td height="10"><img src="{I_SPACER}" height="10" border="0" alt=""></td>
				</tr>
			</table>
			<table class="forumline" width="100%" align="center" cellpadding="2" cellspacing="0" border="0">
				<tr>
					<td class="spaceRow" height="1" colspan="5"><img src="{I_SPACER}" height="1" border="0" alt=""></td>
				</tr>
				<tr>
					<td class="titleLegend" align="center"><a href="#" onClick="dom_toggle.toggle('copyright_display','copyright_open_close', '{I_DOWN_ARROW}', '{I_UP_ARROW}'); return false;" class="postdetails"><img src="{I_TOGGLE_ICON}" id="copyright_open_close" hspace="2" border="0" /></a><span class="postdetails">{L_COPYRIGHT}</span></td>
				</tr>
				<tr>
					<tbody id="copyright_display" style="display:{TOGGLE_STATUS}">
						<td class="row1" align="center"><span class="copyright">
<!--
	We request you retain the full copyright notice below including the link to www.phpbb.com.
	This not only gives respect to the large amount of time given freely by the developers
	but also helps build interest, traffic and use of phpBB 2.0. If you cannot (for good
	reason) retain the full copyright we request you at least leave in place the 
	Powered by phpBB line, with phpBB linked to www.phpbb.com. If you refuse
	to include even this then support on our forums may be affected. 

	The phpBB Group : 2002
// -->
							Powered by <a href="http://www.phpbb.com/" target="_phpbb" class="copyright">phpBB</a> &copy; 2001-2005 phpBB Group<br />
							{TRANSLATION_INFO}<br />
							Categories Hierarchy {CH_VERSION} &copy; 2003-2005 <a href="http://ptifo.clanmckeen.com/" target="_blank" class="copyright">Ptirhiik</a> RPGnet-Fr<br />
							Harmony Blue Theme v1.0.0 created by <a href="http://ggweb-fr.com/" target="_new" class="copyright">GGWeb-FR Design</a> &copy; 2005 GGWeb-FR<br />{PHPBB_VERSION1}
						</span></td>
					</tbody>
				</tr>
			</table>
			<table class="shadow" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
					<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
					<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<a name="bottom"></a>

<!-- INCLUDE stat_run_body.tpl -->
</body>
</html>
