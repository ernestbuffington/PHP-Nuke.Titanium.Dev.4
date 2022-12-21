<table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
   <tr>
      <td width="100%" colspan="2" valign="top">
      <!-- MOD GLANCE BEGIN -->
      {GLANCE_OUTPUT}
      <!-- MOD GLANCE END -->
	  </td>
   </tr>
</table>
<script language="Javascript" type="text/javascript">
<!--
    function open_postreview(ref)
    {
        height = screen.height / 3;
        width = screen.width / 2;
        window.open(ref, '_phpbbpostreview', 'HEIGHT=' + height + ',WIDTH=' + width + ',resizable=yes,scrollbars=yes');
        return;
    }
//-->
</script>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td align="left" valign="bottom" colspan="2"><a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a><br />
<span class="gensmall"><strong>{PAGINATION}</strong>
</td>
</tr>
</table>
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
<table style="width: 100%;" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td align="left" valign="bottom" nowrap="nowrap">
<span class="nav">
<!-- TOPIC BUTTON (NEW POST) --><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a><!-- TOPIC BUTTON (NEW POST) -->
<!-- TOPIC BUTTON (REPLY POST) --><a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a><!-- TOPIC BUTTON (REPLY POST) -->
<!-- TOPIC BUTTON (PRINT POST) --><a target="_blank" href="{U_PRINTER_TOPIC}"><img src="{PRINTER_IMG}" border="0" alt="{L_PRINTER_TOPIC}" align="middle" /></a><!-- TOPIC BUTTON (PRINT POST) -->
<!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) --><a href="{U_WHOVIEW_TOPIC}"><img src="{WHOVIEW_IMG}" border="0" alt="{L_WHOVIEW_ALT}" align="middle" /></a><!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
<!-- BEGIN thanks_button -->
<!-- TOPIC BUTTON (THANK POST) --><a href="{thanks_button.U_THANK_TOPIC}"><img src="{thanks_button.THANK_IMG}" border="0" alt="{thanks_button.L_THANK_TOPIC}" align="middle" /></a><!-- TOPIC BUTTON (THANK POST) -->
<!-- END thanks_button -->
</span>
</td>
<td style="width: 100%; text-align: left;">
&nbsp;<a href="{U_INDEX}"> {L_INDEX}</a>
<!-- IF PARENT_FORUM --> -> 
<a href="{U_VIEW_PARENT_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {PARENT_FORUM_NAME}</a> 
<!-- ENDIF --> 
<a href="{U_VIEW_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {FORUM_NAME}</a>
</td>
</tr>
<tr> 
</td>
</tr> 
</table>
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>

<table class="forumline rounded-corners" width="100%" cellspacing="1" cellpadding="3" border="0">
<tr>
<td class="catHead" colspan="2">
<span style="float: left;"><a href="{U_VIEW_OLDER_TOPIC}"><i class="fa-solid fa-arrow-left fa-lg"></i> {L_VIEW_PREVIOUS_TOPIC}</a></span>
<span style="float: right;"><a href="{U_VIEW_NEWER_TOPIC}">{L_VIEW_NEXT_TOPIC} <i class="fa-solid fa-arrow-right fa-lg"></i></a></span>
</td>
</tr>
{POLL_DISPLAY} 
<tr>
<!-- BEGIN postrow -->
<td align="middle" class="catHead" width="13%"><strong><a name="{postrow.U_POST_ID}">{postrow.POSTER_NAME}</a></strong></td>
<td class="catHead" style="width: 100%" align="right">
<a name="{postrow.U_POST_ID}0"></a>{postrow.QUOTE_IMG} 
{postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG} {postrow.REPORT_IMG}</td>
</tr>
<tr> 
<td width="150" align="center" valign="top" class="{postrow.ROW_CLASS}">
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
{postrow.POSTER_AVATAR}
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
{postrow.USER_RANK_01_IMG}
{postrow.USER_RANK_02_IMG}
{postrow.USER_RANK_03_IMG}
{postrow.USER_RANK_04_IMG}
{postrow.USER_RANK_05_IMG}
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
Joined {postrow.POSTER_JOINED}
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
{postrow.REPUTATION}
<!-- BEGIN xdata -->
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
{postrow.POSTER_ONLINE_STATUS_IMG}
</td>
<td class="{postrow.ROW_CLASS}" height="100%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="100%" valign="top"><span class="postbody">
<td class="{postrow.ROW_CLASS}" style="padding: 8px; vertical-align: top">
{TOPIC_TITLE}</br>
<a href="{postrow.U_MINI_POST}"><i class="bi bi-file-text"></i></a> by {postrow.POSTER_NAME} <i class="bi bi-caret-right"></i> {postrow.POST_DATE}</br></br>
<span class="postbody">{postrow.MESSAGE}</span></br>
{postrow.ATTACHMENTS}</br>
<span class="postbody">{postrow.SIGNATURE}</span></br>
</td>
<!-- Start add - Bottom aligned signature MOD -->
</tr> 
</table>

</td>
</tr>
<tr> 
<td class="{postrow.ROW_CLASS}" width="150" align="center" valign="middle"><a href="#top">{L_BACK_TO_TOP}</a></td>
<td class="{postrow.ROW_CLASS}" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" width="18">
<tr> 
<td valign="middle" nowrap="nowrap">
{postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.FACEBOOK_IMG}</td>
</tr>
</table>

</td>
</tr>
<!-- BEGIN switch_spacer -->
<tr> 

<td colspan="2">
<div style="padding-top:1px; padding-bottom:1px; text-align: center; background-color :transparent;"></div>
</td>

</tr>
<!-- END switch_spacer -->
<!-- BEGIN move_message -->
<tr>
<td class="row3" colspan="2"><span class="postdetails">{postrow.move_message.MOVE_MESSAGE}</span></td>
</tr>
<!-- END move_message -->
<!-- BEGIN thanks -->
<tr>
<td colspan="2" class="row2">
<div style="padding-top:1px; padding-bottom:1px; text-align: center; background-color :transparent;"></div>

<table cellspacing="1" cellpadding="3" border="0" width="100%">
<tr>
<th class="thLeft">{postrow.thanks.THANKFUL}</th>
</tr>
<tr>
<td class="row2" valign="top" align="left">
<span id="hide_thank" style="display: block;" class="medium"><a href="javascript:void(0);" onclick="postThank('show')">{postrow.thanks.THANKS_TOTAL}</a> {postrow.thanks.THANKED}</span>
<span id="show_thank" style="display: none;" class="medium">{postrow.thanks.THANKS}<br /><br /><div align="right"><a href="javascript:void(0);" onclick="postThank('hide')">[ {postrow.thanks.HIDE} ]</a></div></span>
</td>	
</tr>
</table>
<div style="padding-top:1px; padding-bottom:1px; text-align: center; background-color :transparent;"></div>
</td>
</tr>
<!-- END thanks -->
<!-- START Inline Banner Ad -->
<!-- BEGIN switch_ad -->
<tr>
  <td width="150" align="left" valign="top" class="row3"><span class="name"><strong>{postrow.L_SPONSOR}</strong></span><br /></td>
  <td class="row1" height="28" valign="top">
    {postrow.INLINE_AD}
  </td>
</tr>
<tr>
  <td colspan="2" height="1">
  <div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
  </td>
</tr>
<!-- END switch_ad -->
<!-- BEGIN switch_ad_style2 -->
<tr>
  <td colspan="2" class="row3">
    {postrow.INLINE_AD}
  </td>
</tr>
<!-- END switch_ad_style2 -->
<!-- END Inline Banner Ad -->    
<!-- END postrow -->
    <tr align="center"> 
        <td class="catBottom" colspan="2" height="28"><table cellspacing="0" cellpadding="0" border="0">
            <tr><td align="center"><form method="post" action="{S_POST_DAYS_ACTION}"><span class="gensmall">{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}{S_SELECT_POST_ORDER}<input type="submit" value="{L_GO}" class="liteoption" name="submit" /></span></form></td></tr>
        </table></td>
    </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left" valign="middle" nowrap="nowrap">
      <span class="nav">
        <a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>
        <a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a>
        
        <!-- BEGIN switch_quick_reply -->
        <a href="{U_POST_SQR_TOPIC}"><img src="{SQR_IMG}" border="0" alt="{L_POST_SQR_TOPIC}" align="middle" /></a>
        <!-- END switch_quick_reply -->
        <a target="_blank" href="{U_PRINTER_TOPIC}"><img src="{PRINTER_IMG}" border="0" alt="{L_PRINTER_TOPIC}" align="middle" /></a>
        <!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
        <a href="{U_WHOVIEW_TOPIC}"><img src="{WHOVIEW_IMG}" border="0" alt="{L_WHOVIEW_ALT}" align="middle" /></a>
        <!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
        <!-- BEGIN thanks_button -->
        <a href="{thanks_button.U_THANK_TOPIC}"><img src="{thanks_button.THANK_IMG}" border="0" alt="{thanks_button.L_THANK_TOPIC}" align="middle" /></a>
        <!-- END thanks_button -->
         <td style="width: 100%; text-align: left;">&nbsp;&nbsp;<a href="{U_INDEX}">{L_INDEX}</a>
         <!-- IF PARENT_FORUM --> 
         <i class="fa-solid fa-arrow-right fa-lg"></i> 
         <a href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a>
         <!-- ENDIF --> 
         <a href="{U_VIEW_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> 
         {FORUM_NAME}</a></td></td>
      </span>
<br/>
    </td>
    
    <td align="right" valign="top" nowrap="nowrap">{S_TIMEZONE}<br /><br />{PAGINATION}</td>
  </tr>
  <tr>
    <td align="left" colspan="3">{PAGE_NUMBER}</td>
  </tr>
</table>

<!-- BEGIN switch_quick_reply -->
    {QRBODY}
<!-- END switch_quick_reply -->
<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td width="40%" valign="top" nowrap="nowrap" align="left">{S_WATCH_TOPIC}<br />{S_EMAIL_TOPIC}<br />
      &nbsp;<br />
      {S_TOPIC_ADMIN}</td>
    <td align="right" valign="top" nowrap="nowrap">{JUMPBOX}
    <div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
    {S_AUTH_LIST}</td>
  </tr>
</table>

{RELATED_TOPICS}