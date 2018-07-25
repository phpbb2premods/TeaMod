<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">
{META}
{NAV_LINKS}
<title>{SITENAME} :: {PAGE_TITLE}</title>
<link rel="stylesheet" href="templates/subSilver/{T_HEAD_STYLESHEET}" type="text/css">
<link rel="stylesheet" href="{HYPERCELL_SHEET}/hypercell.css" type="text/css">
<!--[if IE]>
<style type="text/css">
/* This experiment is try to emulate the :hover pseudo-class
   and its dynamic effect on Internet Explorer 5+, because IE support
   :hover only on A (anchor) element */
.hccRow, .hccRow-new, .hccRow-lock,
.hccRow-announce, .hccRow-new-announce,
.hccRow-sticky, .hccRow-new-sticky,
.hccRow-hot, .hccRow-new-hot, .hccRow-link,
.row3Right, .hccRow-right, .hccRow-new-right, .hccRow-lock-right,
.hccRow-announce-right, .hccRow-new-announce-right,
.hccRow-sticky-right, .hccRow-new-sticky-right,
.hccRow-hot-right, .hccRow-new-hot-right { behavior: url("{HYPERCELL_SHEET}/hover.htc"); }
</style>
<![endif]-->
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
<!-- start gradualshine script -->
<style type="text/css">
<!--
.gradualshine { filter:alpha(opacity=30); -moz-opacity:0.3; }
-->
</style>
<script language="javascript" type="text/javascript" src="templates/gradualshine.js"></script>
<!-- end gradualshine script -->
<link rel="stylesheet" href="{BBC_BOX_SHEET}" type="text/css">
<script language="javascript" src="templates/bbc_box/fade.js" type="text/javascript"></script>
</head>
<body bgcolor="{T_BODY_BGCOLOR}" text="{T_BODY_TEXT}" link="{T_BODY_LINK}" vlink="{T_BODY_VLINK}">

<a name="top"></a>

<table width="100%" cellspacing="0" cellpadding="10" border="0" align="center"> 
	<tr> 
		<td class="bodyline">
			
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr> 
				<td><a href="{U_INDEX}"><img src="{I_LOGO}" border="0" alt="{L_INDEX}" vspace="1" /></a></td>
				<td align="center" width="100%" valign="middle"><span class="maintitle">{SITENAME}</span><br /><span class="gen">{SITE_DESCRIPTION}<br />&nbsp; </span> 
				<table cellspacing="0" cellpadding="2" border="0">
					<tr> 
						<td align="center" valign="top" nowrap="nowrap"><span class="mainmenu">&nbsp;<a href="{U_FAQ}" class="mainmenu"><img src="{I_FAQ}" width="12" height="13" border="0" alt="{L_FAQ}" hspace="3" />{L_FAQ}</a></span><span class="mainmenu">&nbsp; &nbsp;<a href="{U_SEARCH}" class="mainmenu"><img src="{I_SEARCH}" width="12" height="13" border="0" alt="{L_SEARCH}" hspace="3" />{L_SEARCH}</a>&nbsp; &nbsp;<a href="{U_MEMBERLIST}" class="mainmenu"><img src="{I_MEMBERLIST}" width="12" height="13" border="0" alt="{L_MEMBERLIST}" hspace="3" />{L_MEMBERLIST}</a>&nbsp; &nbsp;<a href="{U_GROUP_CP}" class="mainmenu"><img src="{I_GROUP_CP}" width="12" height="13" border="0" alt="{L_USERGROUPS}" hspace="3" />{L_USERGROUPS}</a>&nbsp; 
						<!-- BEGIN switch_user_logged_out -->
						&nbsp;<a href="{U_REGISTER}" class="mainmenu"><img src="{I_REGISTER}" width="12" height="13" border="0" alt="{L_REGISTER}" hspace="3" />{L_REGISTER}</a></span>&nbsp;
						<!-- END switch_user_logged_out -->
						</td>
					</tr>
					<tr>
						<td height="25" align="center" valign="top" nowrap="nowrap"><span class="mainmenu">&nbsp;<a href="{U_PROFILE}" class="mainmenu"><img src="{I_PROFILE}" width="12" height="13" border="0" alt="{L_PROFILE}" hspace="3" />{L_PROFILE}</a>&nbsp; &nbsp;<a href="{U_PREFERENCES}" class="mainmenu"><img src="{I_PREFERENCES}" width="12" height="13" border="0" alt="{L_PREFERENCES}" hspace="3" />{L_PREFERENCES}</a>&nbsp; &nbsp;<a href="{U_PRIVATEMSGS}" class="mainmenu"><img src="{PRIVMSG_IMG}" width="12" height="13" border="0" alt="{PRIVATE_MESSAGE_INFO}" hspace="3" />{PRIVATE_MESSAGE_INFO}</a>&nbsp; &nbsp;<a href="{U_LOGIN_LOGOUT}" class="mainmenu"><img src="{LOG_IMG}" width="12" height="13" border="0" alt="{L_LOGIN_LOGOUT}" hspace="3" />{L_LOGIN_LOGOUT}</a>&nbsp;</span></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

		<br />
{CALENDAR_BOX}