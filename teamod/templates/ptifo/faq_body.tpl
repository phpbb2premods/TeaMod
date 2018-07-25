
{NAVIGATION_BOX}

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
<tr>
	<th class="thHead">{L_FAQ_TITLE}</th>
</tr>
<tr>
	<td class="row1"><span class="gen">
		<!-- BEGIN faq_block_link -->
		<b>{faq_block_link.BLOCK_TITLE}</b><br />
		<!-- BEGIN faq_row_link -->
		<a href="#p{faq_block_link.faq_row_link.U_FAQ_ID}" class="postlink">{faq_block_link.faq_row_link.FAQ_LINK}</a><br />
		<!-- END faq_row_link -->
		<br />
		<!-- END faq_block_link -->
	</span></td>
</tr>
<tr>
	<td class="catBottom" height="28">&nbsp;</td>
</tr>
</table>

<br clear="all" />

<!-- BEGIN faq_block -->
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
<tr>
	<td class="catHead" height="28" align="center"><span class="cattitle">{faq_block.BLOCK_TITLE}</span></td>
</tr>
<!-- BEGIN faq_row -->  
<tr> 
	<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->" align="left" valign="top"><span class="postbody">
		<a name="p{faq_block.faq_row.U_FAQ_ID}"></a><b>{faq_block.faq_row.FAQ_QUESTION}</b><br />
		{faq_block.faq_row.FAQ_ANSWER}<br />
		<a class="postlink" href="#top">{L_BACK_TO_TOP}</a>
	</span></td>
</tr>
<tr>
	<td class="spaceRow" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
</tr>
<!-- END faq_row -->
</table>

<br clear="all" />
<!-- END faq_block -->

<br clear="all" />

{JUMPBOX}
