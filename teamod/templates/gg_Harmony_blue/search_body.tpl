<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="4"><img src="{I_SPACER}" height="4" border="0" alt=""></td>
	</tr>
</table>

{NAVIGATION_BOX}

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
<form action="{S_SEARCH_ACTION}" method="POST">
	<tr>
		<th class="thHead" height="25" colspan="4">{L_SEARCH_QUERY}</th>
	</tr>
	<tr>
		<td class="row1" width="50%" colspan="2"><span class="gen">{L_SEARCH_KEYWORDS}</span><br /><span class="gensmall">{L_SEARCH_KEYWORDS_EXPLAIN}</span></td>
		<td class="row2" valign="top" colspan="2"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_keywords" size="30" /><br /><input type="radio" name="search_terms" value="any" checked="checked" /> {L_SEARCH_ANY_TERMS}<br /><input type="radio" name="search_terms" value="all" /> {L_SEARCH_ALL_TERMS}</span></td>
	</tr>
	<tr>
		<td class="row1" colspan="2"><span class="gen">{L_SEARCH_AUTHOR}</span><br /><span class="gensmall">{L_SEARCH_AUTHOR_EXPLAIN}</span></td>
		<td class="row2" valign="middle" colspan="2"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_author" size="30" /></span></td>
	</tr>
	<tr>
		<td class="row1" colspan="2"><span class="gen">{L_SEARCH_FORUM}&nbsp;</span></td>
		<td class="row2" colspan="2"><span class="genmed"><select class="post" name="search_forum">{S_FORUM_OPTIONS}</select></span><span class="gensmall"><br /><input name="no_subs" type="checkbox" value="1" {S_NO_SUBS} />{L_NO_SUBS}</span></td>
	</tr>
	<tr>
		<th class="thHead" height="25" colspan="4">{L_SEARCH_OPTIONS}</th>
	</tr>
	<tr>
		<td class="row1" align="right" nowrap="nowrap"><span class="gen">{L_SEARCH_PREVIOUS}&nbsp;</span></td>
		<td class="row2" valign="middle"><span class="genmed"><select class="post" name="search_time">{S_TIME_OPTIONS}</select><br /><input type="radio" name="search_fields" value="all" checked="checked" /> {L_SEARCH_MESSAGE_TITLE}<br /><input type="radio" name="search_fields" value="msgonly" /> {L_SEARCH_MESSAGE_ONLY}</span></td>
		<td class="row1" align="right"><span class="gen">{L_SORT_BY}&nbsp;</span></td>
		<td class="row2" valign="middle" nowrap="nowrap"><span class="genmed"><select class="post" name="sort_by">{S_SORT_OPTIONS}</select><br /><input type="radio" name="sort_dir" value="ASC" /> {L_SORT_ASCENDING}<br /><input type="radio" name="sort_dir" value="DESC" checked="checked" /> {L_SORT_DESCENDING}</span>&nbsp;</td>
	</tr>
	<tr>
		<td class="row1" align="right" nowrap="nowrap"><span class="gen">{L_DISPLAY_RESULTS}&nbsp;</span></td>
		<td class="row2" nowrap="nowrap"><input type="radio" name="show_results" value="posts" /><span class="genmed">{L_POSTS}<input type="radio" name="show_results" value="topics" checked="checked" />{L_TOPICS}</span></td>
		<td class="row1" align="right"><span class="gen">{L_RETURN_FIRST}</span></td>
		<td class="row2"><span class="genmed"><select class="post" name="return_chars">{S_CHARACTER_OPTIONS}</select> {L_CHARACTERS}</span></td>
	</tr>
	<tr>
		<td class="catBottom" height="28" align="center" colspan="4">{S_HIDDEN_FIELDS}<input class="liteoption" type="submit" value="{L_SEARCH}" /></td>
	</tr>
</table>
<table class="shadow" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="shleft"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shbottom"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
		<td class="shright"><img src="{I_SPACER}" alt="" width="8" height="4" /></td>
	</tr>
</table>

<table width="100%" cellspacing="2" border="0">
	<tr>
		<td align="left"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</form></table>

<table width="100%" align="center" cellspacing="2" border="0">
	<tr>
		<td align="right" valign="top">{JUMPBOX}</td>
	</tr>
</table>