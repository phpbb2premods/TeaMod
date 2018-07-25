<script language="javascript" type="text/javascript">
<!--

function checkForm() {
	if (document.post.message.value.length < 2) {
		alert('{L_EMPTY_MESSAGE}');
		return false;
	} else {
		return true;
	}
}

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

<div id="qp_box" style="display:<!-- BEGIN qp_show -->block<!-- BEGINELSE qp_show -->none<!-- END qp_show -->;position:relative;">
  <form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)">
	<table border="0" cellpadding="3" cellspacing="1" width="40%" class="forumline">
	  <tr>
		<th class="thHead" colspan="2" height="25">{L_QP_TITLE}</th>
	  </tr>
	  <!-- BEGIN switch_username_select -->
	  <tr> 
		<td class="row1"><span class="gen"><b>{L_USERNAME}</b>&nbsp;</span>
			<span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" />
		</span></td>
	  </tr>
	  <!-- END switch_username_select -->
	  <tr> 
		<td class="row1" valign="top" nowrap="nowrap" align="left"><span class="genmed">
			<textarea class="post" name="message" rows="7" cols="35" style="width:425px" tabindex="2" wrap="virtual">{MESSAGE}</textarea>
		</span></td>
	  </tr>
	  <tr>
	  	<td class="catBottom" align="center" height="28" colspan="2">{S_HIDDEN_FORM_FIELDS}
			<input type="submit" tabindex="5" name="preview" class="liteoption" value="{L_PREVIEW}" />
			<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
		</td>
	  </tr>
	</table>
  </form>
</div>