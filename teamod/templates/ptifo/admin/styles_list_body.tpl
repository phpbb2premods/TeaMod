
<h1>{L_STYLES_TITLE}</h1>

<p>{L_STYLES_TEXT}</p>

<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th class="thCornerL">{L_STYLE}</th>
		<th class="thTop">{L_TEMPLATE}</th>
		<th class="thTop">{L_EDIT}</th>
		<th colspan="2" class="thCornerR">{L_DELETE}</th>
	</tr>
	<!-- BEGIN styles -->
	<tr>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->">{styles.STYLE_NAME}</td>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->">{styles.TEMPLATE_NAME}</td>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><a href="{styles.U_STYLES_EDIT}">{L_EDIT}</a></td>
		<td class="<!-- BEGIN light -->row1<!-- BEGINELSE light -->row2<!-- END light -->"><a href="{styles.U_STYLES_DELETE}">{L_DELETE}</a></td>
	</tr>
	<!-- END styles -->
</table>
