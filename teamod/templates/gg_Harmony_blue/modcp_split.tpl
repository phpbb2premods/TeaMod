<table width="100%" cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td>
			<form method="post" action="{S_SPLIT_ACTION}">
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
		<td class="catHead" height="27" align="center" colspan="8"><span class="cattitle">
			<a href="{U_MOD_CP}" class="cattitle">{L_MOD_CP}</a>
		</span></td>
	</tr>
	<tr>
		<td class="row1" colspan="8"><span class="gensmall">{L_SPLIT_TOPIC_EXPLAIN}</span></td>
	</tr>
	<tr>
		<th class="thHead" height="25" nowrap="nowrap" colspan="3">{L_SPLIT_TOPIC}</th>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="gen">{L_SPLIT_SUBJECT}</span></td>
		<td class="row2" colspan="2"><input class="post" type="text" size="35" style="width: 350px" maxlength="60" name="subject" /></td>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="gen">{L_SPLIT_FORUM}</span></td>
		<td class="row2" colspan="2">{S_FORUM_SELECT}</td>
	</tr>
	<tr>
		<td class="catHead" height="28" colspan="3"> 
			<table width="60%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="50%" align="center"> 
						<input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />
					</td>
					<td width="50%" align="center"> 
						<input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th class="thLeft" nowrap="nowrap">{L_AUTHOR}</th>
		<th nowrap="nowrap">{L_MESSAGE}</th>
		<th class="thRight" nowrap="nowrap">{L_SELECT}</th>
	</tr>
	<!-- BEGIN postrow -->
	<tr>
		<td class="{postrow.ROW_CLASS}" align="left" valign="top"><span class="name"><a name="{postrow.U_POST_ID}"></a>{postrow.POSTER_NAME}</span></td>
		<td class="{postrow.ROW_CLASS}" width="100%" valign="top"> 
			<table width="100%" cellpadding="3" cellspacing="0" border="0">
				<tr>
					<td valign="middle"><img src="{I_POST}" alt="{L_POST}"><span class="postdetails">{L_POSTED}: 
					{postrow.POST_DATE}&nbsp;&nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</span></td>
				</tr>
				<tr>
					<td valign="top"> 
						<hr size="1" />
					<span class="postbody">{postrow.MESSAGE}</span></td> 
				</tr>
			</table>
		</td>
		<td class="{postrow.ROW_CLASS}" width="5%" align="center">{postrow.S_SPLIT_CHECKBOX}</td>
	</tr>
	<tr>
		<td class="row3" height="1" colspan="3"><img src="{I_SPACER}" width="1" height="1" alt="."></td>
	</tr>
	<!-- END postrow -->
	<tr>
		<td class="catBottom" height="28" colspan="3"> 
			<table width="60%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="50%" align="center"> 
						<input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />
					</td>
					<td width="50%" align="center"> 
						<input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" />
					{S_HIDDEN_FIELDS} </td>
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
<table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</form></table>
