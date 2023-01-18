<div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<!--MOD GLANCE BEGIN -->{GLANCE_OUTPUT}<!-- MOD GLANCE END -->
<form method="post" action="{S_POST_DAYS_ACTION}">
<table class="rounded-corners" width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left" valign="bottom" colspan="2"><a class="maintitle" href="{U_VIEW_FORUM}">{FORUM_NAME}</a><br /><strong>{L_MODERATOR}: {MODERATORS}<br />{LOGGED_IN_USER_LIST}</strong></td>
    <td align="right" valign="bottom" class="gensmall boldme" nowrap="nowrap">{PAGINATION}</td>
  </tr>
   <tr> 
    <td align="center" height="6" colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <td align="left" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
    <td align="left" valign="middle" width="100%">&nbsp;&nbsp;<a href="{U_INDEX}">{L_INDEX}</a>
    <!-- IF PARENT_FORUM --> 
    <a href="{U_VIEW_PARENT_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {PARENT_FORUM_NAME}</a> 
    <!-- ENDIF --> 
    <a href="{U_VIEW_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {FORUM_NAME}</a>
    </td>
    <td align="right" valign="bottom" nowrap="nowrap"><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></td>
  </tr>
  <tr> 
    <td align="center" height="6" colspan="3">&nbsp;</td>
  </tr>
</table>

<!-- BEGIN catrow -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline rounded-corners">
 
  <!-- BEGIN forumrow -->
  
  <!-- END forumrow -->
</table>
<!-- END catrow -->
<!-- IF NUM_TOPICS || ! HAS_SUBFORUMS -->
  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline rounded-corners">
    <tr> 
      <td class="catHead" colspan="3" style="text-align: center" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</td>
      <td class="catHead" style="text-align: center; width: 50px;" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</td>
      <td class="catHead" style="text-align: center; width: 50px;" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</td>
      <td class="catHead" style="text-align: center; width: 200px;" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</td>
    </tr>
    <!-- BEGIN topicrow -->
    <!-- BEGIN divider -->
    <tr> 
       <td class="catHead" colspan="6"><span class="cattitle">{topicrow.divider.L_DIV_HEADERS}</span></td>
    </tr>
    <!-- END divider -->
    <tr> 
      <td class="row1" style="text-align: center; width: 40px;"><img src="{topicrow.TOPIC_FOLDER_IMG}" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
      <!-- IF topicrow.ICON_ID > 0 -->      
      <td class="row1" style="text-align: center; width: 40px;">{topicrow.ICON}</td>
      <td class="row1">
      	{topicrow.NEWEST_POST_IMG}{topicrow.TOPIC_ATTACHMENT_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}">{topicrow.TOPIC_TITLE}</a><br />
      	<!-- <div style="float: left; width: auto; text-align: left; max-width: 100%;">by {topicrow.TOPIC_AUTHOR}</div> -->
      	<div style="float: right; text-align: right; width: auto;">{topicrow.GOTO_PAGE}</div>
      <!-- ELSE -->
      <td class="row1" colspan="2">
      	{topicrow.NEWEST_POST_IMG}{topicrow.TOPIC_ATTACHMENT_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}">{topicrow.TOPIC_TITLE}</a><br />
      	<!-- <span class="gensmall"><br />{topicrow.GOTO_PAGE} -->
      	<!-- <div style="float: left; width: auto; text-align: left; max-width: 100%;">by {topicrow.TOPIC_AUTHOR}</div> -->
      	<div style="float: right; text-align: right; width: auto;">{topicrow.GOTO_PAGE}</div>
      </td>
      <!-- ENDIF -->
      <td class="row1" align="center" valign="middle">{topicrow.REPLIES}</td>
      <td class="row1" align="center" valign="middle">{topicrow.VIEWS}</td>
      <!-- <td class="row1" style="text-align: right;" nowrap="nowrap">{topicrow.LAST_POST_TIME}<br />{topicrow.LAST_POST_AUTHOR} {topicrow.LAST_POST_IMG}</td> -->
      <td class="row1 lastpost" style="width: 250px;" nowrap="nowrap">{topicrow.LAST_POST_IMG} {topicrow.LAST_POST_TIME}<br />{topicrow.LAST_POST_AUTHOR}</td>
    </tr>
    <!-- END topicrow -->
    <!-- BEGIN switch_no_topics -->    
    <tr> 
      <td class="row1 acenter" colspan="6" valign="middle">{L_NO_TOPICS}</td>
    </tr>
    <!-- END switch_no_topics -->
    <tr> 
    <td class="catBottom" colspan="6" height="28">
      <table cellspacing="0" cellpadding="0" border="0" style="float: right;">
        <tr>
          <td>
            {L_DISPLAY_TOPICS}:&nbsp;{S_SELECT_TOPIC_DAYS}&nbsp; {S_DISPLAY_ORDER}<input type="submit" class="titaniumbutton" value="{L_GO}" name="submit" />
          </td>
        </tr>
      </table>
    </td>
  </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
      <td align="left" valign="middle" style ="width: 50px;">&nbsp;</td>
      <td align="left" valign="middle" style ="width: 100%;" >&nbsp;</td>
      <td class="aright" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr> 
      <td align="left" valign="middle" style ="width: 50px;"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
      <td align="left" valign="middle" style ="width: 100%;" >&nbsp;&nbsp;<a href="{U_INDEX}">{L_INDEX}</a>
      <!-- IF PARENT_FORUM --> 
      <a href="{U_VIEW_PARENT_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {PARENT_FORUM_NAME}</a> 
      <!-- ENDIF --> 
      <a href="{U_VIEW_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {FORUM_NAME}</a>
      <br />{catrow.forumrow.FORUM_DESC}
      </td>
      <td class="aright" valign="middle" nowrap="nowrap">{S_TIMEZONE}<br /><table><tr><td>{PAGINATION}</td></tr></table> 
        </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">{PAGE_NUMBER}</td>
    </tr>
  </table>

</form>
<div style="padding-top:15px; padding-bottom:15px; text-align: center; background-color :#000000;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="aright">{JUMPBOX}</td>
  </tr>
</table>
<div style="padding-top:15px; padding-bottom:15px; text-align: center; background-color :#000000;">
<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
    <tr>
        <td align="left" valign="top">
          <table cellspacing="3" cellpadding="0" border="0">
            <tr>
            
        <td width="20" align="center">
		<img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" width="32" height="32" />
          </td>
          <td>&nbsp;{L_NEW_POSTS}
          </td>
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" width="32" height="32" />
          </td> 
          <td>&nbsp;{L_NO_NEW_POSTS}
          </td>
          <td>&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="20" align="center"><p>
			<img src="{FOLDER_GLOBAL_ANNOUNCE_IMG}" alt="{L_GLOBAL_ANNOUNCEMENT}" width="32" height="32" /></p>
          </td>
          <td>&nbsp;
            {L_GLOBAL_ANNOUNCEMENT}           </td>
          <!-- End replacement - Global announcement MOD -->

        </tr>
        <tr>
          <td width="20" align="center">
			<img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" width="32" height="32" />
          </td>
          <td>&nbsp;{L_NEW_POSTS_HOT}
          </td>
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" width="32" height="32" />
          </td>
          <td>&nbsp;{L_NO_NEW_POSTS_HOT}
          </td>
          <td>&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="20" align="center"><p>
			<img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" width="32" height="32" /></p>
          </td>
          <td>&nbsp;
            {L_ANNOUNCEMENT}           </td>
          <!-- End replacement - Global announcement MOD -->
        </tr>
        <tr>
          <td width="20" align="center"><p>
			<img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" width="32" height="32" /></p></td>
          <td>&nbsp;{L_NEW_POSTS_LOCKED}
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" width="32" height="32" /></td>
          <td>&nbsp;{L_NO_NEW_POSTS_LOCKED}</td>
          <!-- Start add - Global announcement MOD -->
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" width="32" height="32" /></td>
          <td>&nbsp;
            {L_STICKY}</td>
          <!-- End add - Global announcement MOD -->
        </tr>
        </table></td>
        <td class="aright">{S_AUTH_LIST}</td>
    </tr>
</table>

<!-- ELSE -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
	<td class="aright">{JUMPBOX}</td>
  </tr>
</table>
<!-- ENDIF -->
</tr>
</tbody>
</table>
</div>
