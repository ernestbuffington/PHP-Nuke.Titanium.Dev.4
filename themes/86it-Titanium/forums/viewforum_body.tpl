<table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
   <tr>
      <td width="100%" colspan="2" valign="top">
      <!-- MOD GLANCE BEGIN -->
      {GLANCE_OUTPUT}
      <!-- MOD GLANCE END -->
   </tr>
</table>
<form method="post" action="{S_POST_DAYS_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
      <td align="left" valign="bottom" colspan="2">{FORUM_ICON_IMG}<a class="maintitle" href="{U_VIEW_FORUM}">{FORUM_NAME}</a><br /><span class="gensmall"><strong>{L_MODERATOR}: {MODERATORS}<br /><br />{LOGGED_IN_USER_LIST}</strong></span></td>
      <td align="right" valign="bottom" class="gensmall boldme" nowrap="nowrap">{PAGINATION}</td>
    </tr>
    <tr> 
      <td align="left" valign="middle" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
      <td align="left" valign="middle" class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a><!-- IF PARENT_FORUM --> -> <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> <!-- ENDIF --> -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
      <td align="right" valign="bottom" class="nav" nowrap="nowrap"><span class="gensmall"><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></span></td>
    </tr>
  </table>

<!-- BEGIN catrow -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{catrow.CAT_DESC}&nbsp;</th>
	<th width="50" class="fixcell" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	<th width="50" class="fixcell" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
	<th class="fixcell" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
  </tr>
  <!-- BEGIN forumrow -->
  <tr> 
	<td class="row1" align="center" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
	<td class="row1" width="100%" height="50" onmouseover="this.style.backgroundImage='url(../themes/86it-Titanium/images/backgrounds/block.png)'" onmouseout="this.style.backgroundImage='url(../themes/86it-Titanium/images/backgrounds/b.png)'"><span class="forumlink"> <a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink<!-- IF catrow.forumrow.UNREAD --> topic-new<!-- ENDIF -->">{catrow.forumrow.FORUM_NAME}</a><br />
	  </span> <span class="genmed">{catrow.forumrow.FORUM_DESC}<br />
	  </span><span class="gensmall">{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
	<td class="row2" align="center" valign="middle" height="50" nowrap="nowrap"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
  </tr>
  <!-- END forumrow -->
</table>
<br />
<!-- END catrow -->

<!-- IF NUM_TOPICS || ! HAS_SUBFORUMS -->

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
    <tr> 
      <th colspan="3" align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
      <th width="50" align="center" class="fixcell" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
      <th width="100" align="center" class="fixcell" nowrap="nowrap">&nbsp;{L_AUTHOR}&nbsp;</th>
      <th width="50" align="center" class="fixcell" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</th>
      <th align="center" class="fixcell" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
    </tr>
    <!-- BEGIN topicrow -->
    <!-- BEGIN divider -->
    <tr> 
       <td class="catHead" colspan="7" height="28"><span class="cattitle">{topicrow.divider.L_DIV_HEADERS}</span></td>
    </tr>
    <!-- END divider -->
    <tr> 
      <td class="row1" align="center" valign="middle" width="20"><img src="{topicrow.TOPIC_FOLDER_IMG}" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
      <td class="row1" align="center" valign="middle" width="20">{topicrow.ICON}</td>
<td class="row1" width="100%"  onmouseover="this.style.backgroundImage='url(../themes/86it-Titanium/images/backgrounds/block.png)'" onmouseout="this.style.backgroundImage='url(../themes/86it-Titanium/images/backgrounds/b.png)'" onclick="window.location.href='{topicrow.U_VIEW_TOPIC}'"><span class="topictitle">{topicrow.NEWEST_POST_IMG}{topicrow.TOPIC_ATTACHMENT_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" class="topictitle">{topicrow.TOPIC_TITLE}</a></span><span class="gensmall"><br />

        {topicrow.GOTO_PAGE}</span></td>
      <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.REPLIES}</span></td>
      <td class="row3" align="center" valign="middle"><span class="name">{topicrow.TOPIC_AUTHOR}</span></td>
      <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.VIEWS}</span></td>
      <td class="row3" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topicrow.LAST_POST_TIME}<br />{topicrow.LAST_POST_AUTHOR} {topicrow.LAST_POST_IMG}</span></td>
    </tr>
    <!-- END topicrow -->
    <!-- BEGIN switch_no_topics -->
    
    <tr> 
      <td class="row1" colspan="7" height="30" align="center" valign="middle"><span class="gen">{L_NO_TOPICS}</span></td>
    </tr>
    <!-- END switch_no_topics -->
    <tr> 
      <td class="catBottom" align="center" valign="middle" colspan="7" height="28"><span class="genmed">{L_DISPLAY_TOPICS}:&nbsp;{S_SELECT_TOPIC_DAYS}&nbsp; {S_DISPLAY_ORDER}
        <input type="submit" class="liteoption" value="{L_GO}" name="submit" />
        </span></td>
    </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
      <td align="left" valign="middle" style ="width: 50;"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
      <td align="left" valign="middle" style ="width: 100%;" ><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a><!-- IF PARENT_FORUM --> -> <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a><!-- ENDIF --> -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
      <td align="right" valign="middle" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><table><tr><td class="nav">{PAGINATION}</td></tr></table> 
        </td>
    </tr>
    <tr>
      <td align="left" colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
    </tr>
  </table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="right">{JUMPBOX}</td>
  </tr>
</table>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
    <tr>
        <td align="left" valign="top"><table cellspacing="3" cellpadding="0" border="0">
            <tr>
        <td width="20" align="left"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" /></td>
          <td class="gensmall">{L_NEW_POSTS}</td>
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" /></td>
          <td class="gensmall">{L_NO_NEW_POSTS}</td>
          <td>&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="20" align="center"><img src="{FOLDER_GLOBAL_ANNOUNCE_IMG}" alt="{L_GLOBAL_ANNOUNCEMENT}" /></td>
          <td class="gensmall">{L_GLOBAL_ANNOUNCEMENT}</td>
          <!-- End replacement - Global announcement MOD -->
        </tr>
        <tr>
          <td width="20" align="center"><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" /></td>
          <td class="gensmall">{L_NEW_POSTS_HOT}</td>
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center"><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" /></td>
          <td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
          <td>&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="20" align="center"><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" /></td>
          <td class="gensmall">{L_ANNOUNCEMENT}</td>
          <!-- End replacement - Global announcement MOD -->
        </tr>
        <tr>
          <td width="20" align="center"><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" /></td>
          <td class="gensmall">{L_NEW_POSTS_LOCKED}
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center"><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" /></td>
          <td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
          <!-- Start add - Global announcement MOD -->
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center"><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" /></td>
          <td class="gensmall">{L_STICKY}</td>
          <!-- End add - Global announcement MOD -->
        </tr>
        </table></td>
        <td align="right"><span class="gensmall">{S_AUTH_LIST}</span></td>
    </tr>
</table>

<!-- ELSE -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
	<td align="right">{JUMPBOX}</td>
  </tr>
</table>
<!-- ENDIF -->