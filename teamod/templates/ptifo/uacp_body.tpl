
<script language="Javascript" type="text/javascript">
	//
	// Should really check the browser to stop this whining ...
	//
	function select_switch(status)
	{
		for (i = 0; i < document.attach_list.length; i++)
		{
			document.attach_list.elements[i].checked = status;
		}
	}
</script>

<form method="post" name="attach_list" action="{S_MODE_ACTION}">
	{NAVIGATION_BOX}
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
		<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
		</span></td>
	</tr>
  </table>
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr> 
	  <th height="25" class="thCornerL">#</th>
	  <th class="thTop">{L_FILENAME}</th>
	  <th class="thTop">{L_FILECOMMENT}</th>
	  <th class="thTop">{L_EXTENSION}</th>
	  <th class="thTop">{L_SIZE}</th>
	  <th class="thTop">{L_DOWNLOADS}</th>
	  <th class="thTop">{L_POST_TIME}</th>
	  <th class="thTop">{L_POSTED_IN_TOPIC}</th>
	  <th class="thCornerR">{L_DELETE}</th>
	</tr>
	<!-- BEGIN attachrow -->
	<tr> 
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center"><span class="gen">&nbsp;{attachrow.ROW_NUMBER}&nbsp;</span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center"><span class="gen"><a href="{attachrow.U_VIEW_ATTACHMENT}" class="gen" target="_blank">{attachrow.FILENAME}</a></span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center"><span class="gen">{attachrow.COMMENT}</span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center"><span class="gen">{attachrow.EXTENSION}</span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center" valign="middle"><span class="gen"><b>{attachrow.SIZE}</b></span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center" valign="middle"><span class="gen"><b>{attachrow.DOWNLOAD_COUNT}</b></span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center" valign="middle"><span class="gensmall">{attachrow.POST_TIME}</span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center" valign="middle"><span class="gen">{attachrow.POST_TITLE}</span></td>
	  <td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="center">{attachrow.S_DELETE_BOX}</td>
	  {attachrow.S_HIDDEN}
	</tr>
	<!-- END attachrow -->
	<tr> 
	  <td class="catBottom" colspan="9" height="28" align="right"> 
		<input type="submit" name="delete" value="{L_DELETE_MARKED}" class="liteoption" />
	  </td>
	</tr>
  </table>

  {S_USER_HIDDEN}

<!-- BEGIN pagination -->
<table border="0" cellpadding="2" cellspacing="0" width="100%">
<tr>
	<td width="100%"><span class="gensmall">
		<b>{pagination.L_PAGE_OF}</b>&nbsp;{pagination.L_COUNT}
	</span></td>
	<td align="right" nowrap="nowrap"><span class="gensmall">&nbsp;
		<!-- BEGIN unique_ELSE --><b>{pagination.L_GOTO}:&nbsp;</b><!-- END unique_ELSE -->
		<!-- BEGIN previous --><b><a href="{pagination.U_PREVIOUS}" class="gensmall">{pagination.L_PREVIOUS}</a>&nbsp;</b><!-- END previous -->
		<!-- BEGIN page_number --><b><!-- BEGIN number --><!-- BEGIN current_ELSE --><a href="{pagination.page_number.U_PAGE}" class="gensmall"><!-- END current_ELSE -->{pagination.page_number.PAGE}<!-- BEGIN current_ELSE --></a><!-- END current_ELSE --><!-- BEGIN sep -->, <!-- END sep --><!-- BEGINELSE number -->..., <!-- END number --></b><!-- END page_number -->
		<!-- BEGIN next --><b>&nbsp;<a href="{pagination.U_NEXT}" class="gensmall">{pagination.L_NEXT}</a></b><!-- END next -->
	</span></td>
</tr>
</table>
<!-- END pagination -->

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	  <td align="right" valign="top" nowrap="nowrap"><b><span class="gensmall"><a href="javascript:select_switch(true);" class="gensmall">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);" class="gensmall">{L_UNMARK_ALL}</a></span></b></td>
	</tr>
  </table>

</form>
