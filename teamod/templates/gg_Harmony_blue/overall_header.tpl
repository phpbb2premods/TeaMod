<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="Author" content="http://www.ggweb-fr.com" />
{META}
{NAV_LINKS}
<title>{SITENAME} :: {PAGE_TITLE}</title>
<link rel="stylesheet" href="templates/gg_Harmony_blue/{T_HEAD_STYLESHEET}" type="text/css">
<!-- BEGIN switch_enable_pm_popup -->
<script language="Javascript" type="text/javascript">
<!--
	if ( {PRIVATE_MESSAGE_NEW_FLAG} )
	{
		window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
	}
//-->
</script>
<!-- END switch_enable_pm_popup -->
<script language="JavaScript" type="text/javascript" src="templates/gg_Harmony_blue/js_dom_toggle.js"></script>
<!-- start gradualshine script -->
<style type="text/css">
<!--
.gradualshine { filter:alpha(opacity=30); -moz-opacity:0.3; }
-->
</style>
<script language="javascript" type="text/javascript" src="templates/gradualshine.js"></script>
<!-- end gradualshine script -->
<link rel="stylesheet" href="{HYPERCELL_SHEET}/hypercell.css" type="text/css">
<!--[if IE]>
<style type="text/css">
/* This experiment is try to emulate the :hover pseudo-class
   and its dynamic effect on Internet Explorer 5+, because IE support
   :hover only on A (anchor) element */
.hccRow, .hccRow-new, .hccRow-lock,
.hccRow-announce, .hccRow-new-announce,
.hccRow-sticky, .hccRow-new-sticky,
.hccRow-hot, .hccRow-new-hot,
.row3Right, .hccRow-right, .hccRow-new-right, .hccRow-lock-right,
.hccRow-announce-right, .hccRow-new-announce-right,
.hccRow-sticky-right, .hccRow-new-sticky-right,
.hccRow-hot-right, .hccRow-new-hot-right { behavior: url("{HYPERCELL_SHEET}/hover.htc"); }
</style>
<![endif]-->
<link rel="stylesheet" href="{BBC_BOX_SHEET}" type="text/css">
<script language="javascript" src="templates/bbc_box/fade.js" type="text/javascript"></script>
</head>

<body bgcolor="#E2E4EB" text="#000000" link="#5569A7" vlink="#5569A7">

<a name="top"></a>

<table width="100%" align="center" cellpadding="10" cellspacing="0" border="0"> 
	<tr>
		<td class="bodyline">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="spaceRow" height="7"><img src="{I_SPACER}" height="7" border="0" alt=""></td>
				</tr>
				<tr>
					<td class="spaceLine" height="1"><img src="{I_SPACER}" height="1" border="0" alt=""></td>
				</tr>
			</table>
			<table class="topbkg" width="100%" height="100" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>&nbsp;</td>
					<td><a href="{U_INDEX}"><img src="{I_LOGO}" width="286" height="100" border="0" alt="{L_INDEX}"></a></td>
					<td align="center" width="100%" valign="middle"><span class="headertitle">{SITENAME}</span><br /><span class="headersubtitle">{SITE_DESCRIPTION}</span></td>
					<td align="right" width="100%" valign="middle"><img src="{I_LOGO_HARMONY}" width="286" height="100" border="0" alt=""></td>
					<td>&nbsp;&nbsp;</td>
				</tr>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="spaceLine" height="1"><img src="{I_SPACER}" height="1" border="0" alt=""></td>
				</tr>
				<tr>
					<td class="spaceRow" height="6"><img src="{I_SPACER}" height="6" border="0" alt=""></td>
				</tr>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="navbar" align="center">
						&nbsp;<a href="{U_FAQ}"><img src="{I_FAQ}" width="12" height="12" border="0" alt="{L_FAQ}" hspace="3" />{L_FAQ}</a>
						&#8226&nbsp;<a href="{U_SEARCH}"><img src="{I_SEARCH}" width="12" height="12" border="0" alt="{L_SEARCH}" hspace="3" />{L_SEARCH}</a>
						&#8226&nbsp;<a href="{U_MEMBERLIST}"><img src="{I_MEMBERLIST}" width="12" height="12" border="0" alt="{L_MEMBERLIST}" hspace="3" />{L_MEMBERLIST}</a>
						&#8226&nbsp;<a href="{U_GROUP_CP}"><img src="{I_GROUP_CP}" width="12" height="12" border="0" alt="{L_USERGROUPS}" hspace="3" />{L_USERGROUPS}</a>
						<!-- BEGIN topic_calendar -->&#8226&nbsp;<a href="{U_CALENDAR}"><img src="{I_CALENDAR}" width="12" height="12" border="0" alt="{L_CALENDAR}" hspace="3" />{L_CALENDAR}</a>&nbsp;<!-- END topic_calendar -->
					</td>
				</tr>
				<tr>
					<td class="navbar" align="center">
						<!-- BEGIN switch_user_logged_out -->
						&nbsp;<a href="{U_REGISTER}"><img src="{I_REGISTER}" width="12" height="12" border="0" alt="{L_REGISTER}" hspace="3" />{L_REGISTER}</a>
						<!-- BEGINELSE switch_user_logged_out -->
						&nbsp;<a href="{U_PROFILE}"><img src="{I_PROFILE}" width="12" height="12" border="0" alt="{L_PROFILE}" hspace="3" />{L_PROFILE}</a>
						&#8226&nbsp;<a href="{U_PREFERENCES}"><img src="{I_PREFERENCES}" width="12" height="12" border="0" alt="{L_PREFERENCES}" hspace="3" />{L_PREFERENCES}</a>
						<!-- END switch_user_logged_out -->
						&#8226&nbsp;<a href="{U_PRIVATEMSGS}"><img src="{PRIVMSG_IMG}" width="12" height="12" border="0" alt="{PRIVATE_MESSAGE_INFO}" hspace="3" />{PRIVATE_MESSAGE_INFO}</a>
						&#8226&nbsp;<a href="{U_LOGIN_LOGOUT}"><img src="<!-- BEGIN switch_user_logged_out -->{I_LOGIN}<!-- BEGINELSE switch_user_logged_out -->{I_LOGOUT}<!-- END switch_user_logged_out -->" width="12" height="12" border="0" alt="{L_LOGIN_LOGOUT}" hspace="3" />{L_LOGIN_LOGOUT}</a>&nbsp;
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
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td height="6"><img src="{I_SPACER}" height="6" border="0" alt=""></td>
				</tr>
			</table>