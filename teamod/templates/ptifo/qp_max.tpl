<script language="javascript" type="text/javascript">
<!--

var form_name = 'post';
var text_name = 'message';

<!-- BEGIN qp_bbcode -->
// Define the bbCode tags
bbcode = new Array();
bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]');
imageTag = false;

// Helpline messages
b_help = "{L_BBCODE_B_HELP}";
i_help = "{L_BBCODE_I_HELP}";
u_help = "{L_BBCODE_U_HELP}";
q_help = "{L_BBCODE_Q_HELP}";
c_help = "{L_BBCODE_C_HELP}";
l_help = "{L_BBCODE_L_HELP}";
o_help = "{L_BBCODE_O_HELP}";
p_help = "{L_BBCODE_P_HELP}";
w_help = "{L_BBCODE_W_HELP}";
a_help = "{L_BBCODE_A_HELP}";
e_help = "{L_BBCODE_E_HELP}";
s_help = "{L_BBCODE_S_HELP}";
f_help = "{L_BBCODE_F_HELP}";
e_help = "{L_BBCODE_E_HELP}";
<!-- END qp_bbcode -->

function checkForm() {
	if (document.post.message.value.length < 2) {
		alert('{L_EMPTY_MESSAGE}');
		return false;
	} else {
		return true;
	}
}

<!-- BEGIN qp_more -->
function quoteSelection() {
	theSelection = false;

	if (navigator.appName == "Netscape") {
		theSelection = document.getSelection();
	} else if (navigator.appName == "Microsoft Internet Explorer") {
		theSelection = document.selection.createRange().text;
	}

	if (theSelection) {
		emoticon('[quote]' + theSelection + '[/quote]');
		document.post.message.focus();
		theSelection = '';
		return;
	} else {
		alert('{L_NO_TEXT_SELECTED}');
	}
}
<!-- END qp_more -->

function qp_switch(id) {
	if (document.getElementById) {
		if (document.getElementById(id).style.display == "none"){
			document.getElementById(id).style.display = 'block';
		} else {
			document.getElementById(id).style.display = 'none';
		}
	} else {
		if (document.layers) {
			if (document.id.display == "none"){
				document.id.display = 'block';
			} else {
				document.id.display = 'none';
			}
		} else {
			if (document.all.id.style.visibility == "none"){
				document.all.id.style.display = 'block';
			} else {
				document.all.id.style.display = 'none';
			}
		}
	}
}
//-->
</script>
<!-- BEGIN qp_bbcode --><script language="javascript" type="text/javascript" src="templates/editor.js"></script><!-- END qp_bbcode -->

<div id="qp_box" style="display:<!-- BEGIN qp_show -->block<!-- BEGINELSE qp_show -->none<!-- END qp_show -->;position:relative;">
  <form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)">
	<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	  <tr>
		<th class="thHead" colspan="2" height="25">{L_QP_TITLE}</th>
	  </tr>
	  <!-- BEGIN username_select -->
	  <tr> 
		<td class="row1"><span class="gen"><b>{L_USERNAME}</b></span></td>
		<td class="row2"><span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /></span></td>
	  </tr>
	  <!-- END username_select -->
	  <!-- BEGIN qp_subject -->
	  <tr> 
		<td class="row1" width="22%"><span class="gen"><b>{L_SUBJECT}</b></span></td>
		<td class="row2" width="78%"><input class="post" style="width:450px" type="text" name="subject" size="45" maxlength="{SUBJECT_LENGTH}" tabindex="2" value="{SUBJECT}" /></td>
	  </tr>
	  <!-- END qp_subject -->
	  <tr>
		<td class="row1" valign="middle">
		<!-- BEGIN qp_smilies -->
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
		  <tr> 
			<td valign="middle" align="center">
			<table width="100" border="0" cellspacing="0" cellpadding="5">
			  <tr align="center"> 
				<td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><b>{L_EMOTICONS}</b></td>
			  </tr>
			  <!-- BEGIN smilies_row -->
			  <tr align="center" valign="middle"> 
				<!-- BEGIN smilies_col -->
				<td><img src="{qp_smilies.smilies_row.smilies_col.SMILEY_IMG}" border="0" onmouseover="this.style.cursor='pointer';" onclick="emoticon('{qp_smilies.smilies_row.smilies_col.SMILEY_CODE}');" alt="{qp_smilies.smilies_row.smilies_col.SMILEY_DESC}" title="{qp_smilies.smilies_row.smilies_col.SMILEY_DESC}" /></td>
				<!-- END smilies_col -->
			  </tr>
			  <!-- END smilies_row -->
			  <!-- BEGIN smilies_extra -->
			  <tr align="center"> 
				<td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies" class="nav">{L_MORE_SMILIES}</a></span></td>
			  </tr>
			  <!-- END smilies_extra -->
			</table></td>
		  </tr>
		</table>
		<!-- END qp_smilies -->
		</td>
		<td class="row2"><table cellspacing="0" cellpadding="2" border="0">
		  <!-- BEGIN qp_bbcode -->
		  <tr align="center" valign="middle">
			<td><table width="100%" cellspacing="0" cellpadding="0" border="0">
			  <tr>
				<td><input type="button" class="button" accesskey="b" name="addbbcode0" value=" B " style="font-weight:bold; width: 30px" onclick="bbstyle(0)" onmouseover="helpline('b')" /></td>
				<td><input type="button" class="button" accesskey="i" name="addbbcode2" value=" i " style="font-style:italic; width: 30px" onclick="bbstyle(2)" onmouseover="helpline('i')" /></td>
				<td><input type="button" class="button" accesskey="u" name="addbbcode4" value=" u " style="text-decoration: underline; width: 30px" onclick="bbstyle(4)" onmouseover="helpline('u')" /></td>
				<td><input type="button" class="button" accesskey="q" name="addbbcode6" value="Quote" style="width: 50px" onclick="bbstyle(6)" onmouseover="helpline('q')" /></td>
				<td><input type="button" class="button" accesskey="c" name="addbbcode8" value="Code" style="width: 40px" onclick="bbstyle(8)" onmouseover="helpline('c')" /></td>
				<td><input type="button" class="button" accesskey="l" name="addbbcode10" value="List" style="width: 40px" onclick="bbstyle(10)" onmouseover="helpline('l')" /></td>
				<td><input type="button" class="button" accesskey="o" name="addbbcode12" value="List=" style="width: 40px" onclick="bbstyle(12)" onmouseover="helpline('o')" /></td>
				<td><input type="button" class="button" accesskey="p" name="addbbcode14" value="Img" style="width: 40px"  onclick="bbstyle(14)" onmouseover="helpline('p')" /></td>
				<td><input type="button" class="button" accesskey="w" name="addbbcode16" value="URL" style="text-decoration: underline; width: 40px" onclick="bbstyle(16)" onmouseover="helpline('w')" /></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><table width="100%" cellspacing="0" cellpadding="0" border="0">
			  <tr>
				<td><span class="genmed"> &nbsp;{L_FONT_SIZE}:</span> {S_FONT_SIZE_TYPES}</td>
				<td class="gensmall" nowrap="nowrap" align="right"><a href="javascript:bbstyle(-1)" onmouseover="helpline('a')">{L_BBCODE_CLOSE_TAGS}</a></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><table width="100%" cellspacing="0" cellpadding="0" border="0">
			  <tr>
				<td><script language="javascript" type="text/javascript"><!--
					colorPalette('h', 17, 5)
				//--></script></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td><input class="helpline" type="text" name="helpbox" maxlength="100" style="width:450px; font-size:10px" value="{L_STYLES_TIP}" /></td>
		  </tr>
		  <!-- END qp_bbcode -->
		  <tr>
			<td><textarea name="message" rows="15" cols="76" wrap="virtual" style="width:450px" tabindex="3" class="post" <!-- BEGIN qp_bbcode -->onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"<!-- END qp_bbcode -->>{MESSAGE}</textarea></td>
		  </tr>
		</table></td>
	  </tr>
	  <tr>
	  	<td class="row1" <!-- BEGIN qp_more -->rowspan="2"<!-- END qp_more -->valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		  	<td valign="top"><span class="gensmall"><b>{L_OPTIONS}</b></span><br />
		  	<span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
		  </tr>
		</table></td>
		<td class="row2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <!-- BEGIN html_checkbox -->
		  <tr>
			<td><input type="checkbox" name="disable_html" {S_HTML_CHECKED} /></td>
			<td width="100%"><span class="gensmall">{L_DISABLE_HTML}</span></td>
		  </tr>
		  <!-- END html_checkbox -->
		  <!-- BEGIN bbcode_checkbox -->
		  <tr>
			<td><input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} /></td>
			<td width="100%"><span class="gensmall">{L_DISABLE_BBCODE}</span></td>
		  </tr>
		  <!-- END bbcode_checkbox -->
		  <!-- BEGIN smilies_checkbox -->
		  <tr>
			<td><input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} /></td>
			<td width="100%"><span class="gensmall">{L_DISABLE_SMILIES}</span></td>
		  </tr>
		  <!-- END smilies_checkbox -->
		</table></td>
	  </tr>
	  <!-- BEGIN qp_more -->
	  <tr>
	  	<td class="row2" valign="top"><span class="gensmall"><a href="javascript:qp_switch('qp_options');" />{L_QP_OPTIONS}</a></span><br />
	  	<div id="qp_options" style="display:none; position:relative;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		  	<td><input type="checkbox" name="quoteselected" onclick="javascript:quoteSelection()" onblur="checked=''" /></td>
		  	<td width="100%"><span class="gensmall">{L_QUOTE_SELECTED}</td>
		  </tr>
		  <!-- BEGIN user_logged_in -->
		  <tr>
			<td><input type="checkbox" name="attach_sig" {qp_more.user_logged_in.ATTACH_SIGNATURE} /></td>
			<td width="100%"><span class="gensmall">{L_ATTACH_SIGNATURE}</span></td>
		  </tr>
		  <tr>
			<td><input type="checkbox" name="notify" {qp_more.user_logged_in.NOTIFY_ON_REPLY} /></td>
			<td width="100%"><span class="gensmall">{L_NOTIFY_ON_REPLY}</span></td>
		  </tr>
		  <!-- END user_logged_in -->
		</table></div>
		</td>
	  </tr>
	  <!-- END qp_more -->
	  <tr>
	  	<td class="catBottom" align="center" height="28" colspan="2">{S_HIDDEN_FORM_FIELDS}
			<input type="submit" tabindex="5" name="preview" class="liteoption" value="{L_PREVIEW}" />
			<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
		</td>
	  </tr>
	</table>
  </form>
</div>