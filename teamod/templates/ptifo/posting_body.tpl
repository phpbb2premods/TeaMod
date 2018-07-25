
<!-- BEGIN privmsg_extensions -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
  <tr> 
	<td valign="top" align="center" width="100%"> 
	  <table height="40" cellspacing="2" cellpadding="2" border="0">
		<tr valign="middle"> 
		  <td>{INBOX_IMG}</td>
		  <td><span class="cattitle">{INBOX_LINK}&nbsp;&nbsp;</span></td>
		  <td>{SENTBOX_IMG}</td>
		  <td><span class="cattitle">{SENTBOX_LINK}&nbsp;&nbsp;</span></td>
		  <td>{OUTBOX_IMG}</td>
		  <td><span class="cattitle">{OUTBOX_LINK}&nbsp;&nbsp;</span></td>
		  <td>{SAVEBOX_IMG}</td>
		  <td><span class="cattitle">{SAVEBOX_LINK}&nbsp;&nbsp;</span></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>

<br clear="all" />
<!-- END privmsg_extensions -->

<!-- BEGIN switch_standalone -->
<!-- INCLUDE bbc_js_box.tpl -->
<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)" {S_FORM_ENCTYPE}>

{NAVIGATION_BOX}
<!-- END switch_standalone -->

<!-- BEGIN switch_not_privmsg -->
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
	<td align="left" valign="bottom"><span class="maintitle">
		<a class="maintitle" href="{U_TITLE}">{TITLE}</a>
	</span></td>
</tr>
</table>
<!-- END switch_not_privmsg -->

{POST_PREVIEW_BOX}
{ERROR_BOX}

<!-- BEGIN switch_standalone -->
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr> 
		<th class="thHead" colspan="2" height="25"><b>{L_POST_A}</b></th>
	</tr>
<!-- END switch_standalone -->
	<!-- BEGIN switch_username_select -->
	<tr> 
		<td class="row1"><span class="gen"><b>{L_USERNAME}</b></span></td>
		<td class="row2"><span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /></span></td>
	</tr>
	<!-- END switch_username_select -->
	<!-- BEGIN switch_privmsg -->
	<tr> 
		<td class="row1"><span class="gen"><b>{L_USERNAME}</b></span></td>
		<td class="row2"><span class="genmed"><input type="text"  class="post" name="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" />&nbsp;<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></span></td>
	</tr>
	<!-- END switch_privmsg -->
	<!-- BEGIN switch_subject -->
	<tr> 
	  <td class="row1" width="22%"><span class="gen"><b>{L_SUBJECT}</b></span></td>
	  <td class="row2" width="78%"> <span class="gen"> 
		<input type="text" name="subject" size="45" maxlength="{SUBJECT_LENGTH}" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" />
		</span> </td>
	</tr>
	<!-- END switch_subject -->
	<!-- BEGIN switch_sub_title -->
	<tr> 
		<td class="row1"><span class="gen"><b>{L_SUB_TITLE}</b></span></td>
		<td class="row2"><span class="gen">
			<input type="text" name="sub_title" size="45" maxlength="{SUB_TITLE_LENGTH}" style="width:450px" tabindex="2" class="post" value="{SUB_TITLE}" />
		</span></td>
	</tr>
	<!-- END switch_sub_title -->
	<!-- BEGIN switch_explain -->
	<tr>
		<td class="row3" colspan="2"><span class="gensmall">{L_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_explain -->
	{ICON_BOX}
	<tr> 
	  <td class="row1" valign="top"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
		  <tr> 
			<td><span class="gen"><b>{L_MESSAGE_BODY}</b></span> </td>
		  </tr>
		  <tr> 
			<td valign="middle" align="center"><br />
			  <table width="100" border="0" cellspacing="0" cellpadding="5">
				<tr align="center"> 
				  <td colspan="{S_SMILIES_COLSPAN}"><span class="gensmall"><b>{L_EMOTICONS}</b></span></td>
				</tr>
				<!-- BEGIN smilies_row -->
				<tr align="center" valign="middle"> 
				  <!-- BEGIN smilies_col -->
				  <td><a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
				  <!-- END smilies_col -->
				</tr>
				<!-- END smilies_row -->
				<!-- BEGIN switch_smilies_extra -->
				<tr align="center"> 
				  <td colspan="{S_SMILIES_COLSPAN}"><span class="topictitle"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies" class="topictitle">{L_MORE_SMILIES}</a></span></td>
				</tr>
				<!-- END switch_smilies_extra -->
			  </table>
			</td>
		  </tr>
		</table>
	  </td>
	  <td class="row2" valign="top"><table cellspacing="0" cellpadding="2" border="0">
		<!-- INCLUDE bbc_display_box.tpl -->
		<tr>
			<td><textarea name="message" rows="15" cols="76" wrap="virtual" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea></td>
		</tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1" valign="top"><span class="gen"><b>{L_OPTIONS}</b></span><br /><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
	  <td class="row2">
		<table cellspacing="0" cellpadding="1" border="0">
		  <!-- BEGIN switch_html_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
			</td>
			<td><span class="gen">{L_DISABLE_HTML}</span></td>
		  </tr>
		  <!-- END switch_html_checkbox -->
		  <!-- BEGIN switch_bbcode_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
			</td>
			<td><span class="gen">{L_DISABLE_BBCODE}</span></td>
		  </tr>
		  <!-- END switch_bbcode_checkbox -->
		  <!-- BEGIN switch_smilies_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} />
			</td>
			<td><span class="gen">{L_DISABLE_SMILIES}</span></td>
		  </tr>
		  <!-- END switch_smilies_checkbox -->
		  <!-- BEGIN switch_signature_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} />
			</td>
			<td><span class="gen">{L_ATTACH_SIGNATURE}</span></td>
		  </tr>
		  <!-- END switch_signature_checkbox -->
		  <!-- BEGIN switch_notify_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="notify" {S_NOTIFY_CHECKED} />
			</td>
			<td><span class="gen">{L_NOTIFY_ON_REPLY}</span></td>
		  </tr>
		  <!-- END switch_notify_checkbox -->
		  <!-- BEGIN switch_delete_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="delete" />
			</td>
			<td><span class="gen">{L_DELETE_POST}</span></td>
		  </tr>
		  <!-- END switch_delete_checkbox -->
		  <!-- BEGIN switch_type_toggle -->
		  <tr> 
			<td></td>
			<td><span class="gen">{S_TYPE_TOGGLE}</span></td>
		  </tr>
		  <!-- END switch_type_toggle -->
		</table>
	  </td>
	</tr>
	{POSTING_FORM}
	{ATTACHBOX}
	{POLLBOX} 
<!-- BEGIN switch_standalone -->
<tr> 
	<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FORM_FIELDS}
		<input type="image" src="{I_PREVIEW}" accesskey="v" tabindex="5" name="preview" value="{L_PREVIEW}" />&nbsp;
		<input type="image" src="{I_SUBMIT}" accesskey="s" tabindex="6" name="post" value="{L_SUBMIT}" />&nbsp;
		<input type="image" src="{I_CANCEL}" accesskey="x" tabindex="7" name="cancel" value="{L_CANCEL}" />
	</td>
</tr>
</table>
<!-- END switch_standalone -->

<!-- BEGIN switch_standalone -->
{NAVIGATION_BOX}
</form>

{JUMPBOX}

<br class="nav" />
<!-- END switch_standalone -->

{TOPIC_REVIEW_BOX}
