<div style="text-align: left; background-color :#000000; width: 100%;" align="center">
<table width="98%" style="background-color:#000000; height:100%;" class="forumline rounded-corners" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<!--MOD GLANCE BEGIN -->{GLANCE_OUTPUT}<!-- MOD GLANCE END -->
<!-- BEGIN show_global_marquee -->
<table style="text-align: left; background-color :#000000; width: 100%;" cellpadding="3" cellspacing="1" border="0" class="forumline rounded-corners"> 
  <tr> 
     <td class="catHead"><span class="cattitle">{GLOBAL_TITLE}</span></td> 
  </tr> 
  <tr> 
     <td class="row1">
     	<div class="messages<!-- BEGIN enable --> imarquee<!-- END enable --><!-- BEGIN disable --> acenter<!-- END disable -->">{GLOBAL_ANNOUNCEMENT}</div>     	
     </td> 
  </tr> 
</table>

<!-- END show_global_marquee -->

<table style="text-align: left; background-color :#000000; width: 100%;" cellpadding="4" cellspacing="1" border="0" class="forumline rounded-corners">
  <!-- BEGIN catrow -->
  <tr> 
    <td class="catHead cattitle3" colspan="<!-- IF SHOW_LAST_POST_AVATAR == 1 -->6<!-- ELSE -->5<!-- ENDIF -->"><span class="cattitle3">{catrow.CAT_DESC}</span></td>
  </tr>
  <!-- BEGIN forumrow -->
  <!-- IF ! forumrow.PARENT -->
  <tr>  	
	<td class="row1 acenter" style="width: 72px;"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>

  <!-- IF catrow.forumrow.FORUM_ICON_IMG -->
	<td class="row1 acenter" style="width: 72px;">{catrow.forumrow.FORUM_ICON_IMG}</td>
	<!-- ENDIF -->
	<td class="row1"
    <!-- IF ! catrow.forumrow.FORUM_ICON_IMG --> colspan="2"
    <!-- ENDIF -->>
	  <a{catrow.forumrow.FORUM_COLOR} href="{catrow.forumrow.U_VIEWFORUM}"
      <!-- IF catrow.forumrow.FORUM_LINK_COUNT --> target="_blank"
      <!-- ENDIF -->>
      {catrow.forumrow.FORUM_NAME}</a><br />
	  <span class="cattitle">{catrow.forumrow.FORUM_DESC}</span>
	  <!-- IF catrow.forumrow.MODERATORS -->
	  <br />{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}<br />
    <!-- ELSE -->
    <br />
	  <!-- ENDIF -->
	  <!-- BEGIN sub -->
	  <!-- DEFINE $HAS_SUB = 1 -->
	  <!-- IF catrow.forumrow.sub.NUM > 0 -->
	  <!-- ELSE -->
	  {L_SUBFORUMS}:
	  <!-- <br /> -->
	  <!-- ENDIF -->
	  {catrow.forumrow.sub.LAST_POST_SUB} <a href="{catrow.forumrow.sub.U_VIEWFORUM}" <!-- IF catrow.forumrow.sub.UNREAD -->class="topic-new"<!-- ENDIF --> {catrow.forumrow.sub.FORUM_COLOR} title="{catrow.forumrow.sub.FORUM_DESC_HTML}">{catrow.forumrow.sub.FORUM_NAME}</a>&nbsp;
	  <!-- END sub -->
	</td>
	<!-- BEGIN switch_forum_link_off -->
	<!-- <td class="row2 acenter">{catrow.forumrow.TOTAL_TOPICS}</td>
	<td class="row2 acenter">{catrow.forumrow.TOTAL_POSTS}</td> -->
	<td class="row1 acenter" style="width: 120px;">{catrow.forumrow.TOTAL_TOPICS} Topics<br />{catrow.forumrow.TOTAL_POSTS} Posts</td>
	<!-- IF SHOW_LAST_POST_AVATAR && catrow.forumrow.LAST_POST_COUNT != 0 -->
	<td class="row1 acenter" style="width: 72px;"><img class="rounded-corners-last-post" src="{catrow.forumrow.LAST_POST_AVATAR}" style="max-width: 48px; max-height: 48px" border="0"></td>
	<!-- ENDIF -->  
    <td class="row1 lastpost"<!-- IF catrow.forumrow.LAST_POST_COUNT == 0 && SHOW_LAST_POST_AVATAR == 1 --> colspan="2"<!-- ELSE -->  style="width: 250px;"<!-- ENDIF --> nowrap="nowrap">{catrow.forumrow.LAST_POST}{catrow.forumrow.LAST_POSTTIME}<br />{catrow.forumrow.LAST_POST_USERNAME}</td>
	<!-- END switch_forum_link_off -->
	<!-- BEGIN switch_forum_link_on -->
	<td class="row1" align="center" valign="middle" height="50" colspan="<!-- IF SHOW_LAST_POST_AVATAR == 1 -->3<!-- ELSE -->2<!-- ENDIF -->">{catrow.forumrow.FORUM_LINK_COUNT}</td>
	<!-- END switch_forum_link_on -->	
  </tr>
  <!-- ENDIF -->  
  <!-- END forumrow -->

  <!-- END catrow -->
</table>

<div style="padding-top:15px; padding-bottom:15px; text-align: center; background-color :#000000;">
<!-- BEGIN switch_user_logged_in -->
<a class="buttonlink" href="{U_MARK_READ}">{L_MARK_FORUMS_READ}</a><!-- END switch_user_logged_in -->
</div>

<table style="text-align: left; background-color :transparent;" class="forumline rounded-corners">
  <tr> 
    <td class="catHead"><a style="text-align: center; background-color :#000000;" class="SMALLbuttonlink" href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></td>
  </tr>
  <tr> 
    <td class="row1">{TOTAL_POSTS}<br />{TOTAL_USERS}<br />{NEWEST_USER}</td>
  </tr>
  <tr> 
    <td class="row1">{TOTAL_USERS_ONLINE}<br />{L_ONLINE_EXPLAIN}<br /><br />{RECORD_USERS}<br /><br />{L_LEGEND}: <!-- BEGIN colors -->{colors.GROUPS}<!-- END colors --><br /><br />{LOGGED_IN_USER_LIST}</td>
  </tr>
  <tr> 
	<td class="row1">{USERS_OF_THE_DAY_LIST}</td>
  </tr>
  <!-- BEGIN birthdays -->
  <tr>
	<td class="catHead">{L_TODAYS_BIRTHDAYS}</td>
  </tr>
  <tr> 
	<td class="row1">
	  <table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td align="left" width="100%">{BIRTHDAYS}<!-- BEGIN upcoming --><br />{UPCOMING}<!-- END upcoming --></td>
	  	</tr>
	  </table>
	</td>
  </tr>
  <!-- END birthdays -->
</table>



<table style="text-align: left; background-color :#000000;" class="forum_footer_icons" border="0" cellpadding="4" cellspacing="1" style="margin: auto">
  <tr> 
    <td width="20" align="center"><img src="{FORUM_IMG}" alt="{L_NO_NEW_POSTS}" /></td>
    <td>&nbsp;&nbsp;{L_NO_NEW_POSTS}</td>
    <td>&nbsp;&nbsp;</td>
    <td width="20" align="center"><img src="{FORUM_NEW_IMG}" alt="{L_NEW_POSTS}"/></td>
    <td>&nbsp;&nbsp;{L_NEW_POSTS}</td>
    <td>&nbsp;&nbsp;</td>    
    <td width="20" align="center"><img src="{FORUM_LOCKED_IMG}" alt="{L_FORUM_LOCKED}" /></td>
    <td>&nbsp;&nbsp;{L_FORUM_LOCKED}</td>
  </tr>
</table>

</tr>
</tbody>
</table>
</div>