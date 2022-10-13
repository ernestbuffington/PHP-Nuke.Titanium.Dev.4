
<form method="post" action="modules.php?name=Forums&file=search&mode=results">
  <input type="hidden" name="search_forum" value="{FORUM_ID}">
  <input type="hidden" name="show_results" value="topics">
  <input type="hidden" name="search_terms" value="any">
  <input type="hidden" name="search_fields" value="all">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center" class="tablein">
	<tr> 
	  <td align="left" valign="bottom" colspan="2"><a class="maintitle" href="{U_VIEW_FORUM}">{FORUM_NAME}</a><br /><span class="gensmall"><b>{L_MODERATOR}: {MODERATORS}<br /><br />{LOGGED_IN_USER_LIST}</b></span></td>
	  <td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall"><b>{PAGINATION}</b></span></td>
	</tr>
	<tr> 
	  <td align="left" valign="middle" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
	  <td align="left" valign="middle" class="nav" width="100%"><span class="nav">   <a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
	  <td align="right" valign="bottom" class="nav" nowrap="nowrap"><span class="gensmall">{L_SEARCH_FOR}: </span><input class="liteoption" type="text" name="search_keywords" value="" size="20" maxlength="150" />&nbsp;<input type="submit" name="submit" value="{L_GO}" alt="{L_SUBMIT_SEARCH}" class="liteoption" /><br /><span class="gensmall"><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></span></td>
	</tr>
  </table>

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr> 
	  <th colspan="2" align="center" height="25" class="thCornerL" nowrap="nowrap"> {L_TOPICS} </th>
	  <th width="50" align="center" class="thTop" nowrap="nowrap"> {L_REPLIES} </th>
	  <th width="100" align="center" class="thTop" nowrap="nowrap"> {L_AUTHOR} </th>
	  <th width="50" align="center" class="thTop" nowrap="nowrap"> {L_VIEWS} </th>
	  <th align="center" class="thCornerR" nowrap="nowrap"> {L_LASTPOST} </th>
	</tr>
	<!-- BEGIN topicrow -->
	<!-- mod : split topic type -->
	<!-- BEGIN topictype -->
	<tr>
	  <td colspan="6" align="left" class="catLeft"><span class="cattitle">{topicrow.topictype.TITLE}</span></td>
	</tr>
	<!-- END topictype -->
<!-- fin mod : split topic type -->
	<tr> 
	  <td class="row1" align="center" valign="middle" width="20"><img src="{topicrow.TOPIC_FOLDER_IMG}"  alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
	  <td class="row2" width="100%" onMouseOver=this.style.backgroundColor="#17242F" onMouseOut=this.style.backgroundColor="#1E2C39" onclick="window.location.href='{topicrow.U_VIEW_TOPIC}'"><span class="topictitle">{topicrow.NEWEST_POST_IMG}{topicrow.TOPIC_ATTACHMENT_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" class="topictitle">{topicrow.TOPIC_TITLE}</a></span><span class="gensmall"><br />
		{topicrow.GOTO_PAGE}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.REPLIES}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="name">{topicrow.TOPIC_AUTHOR}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.VIEWS}</span></td>
	  <td class="row3Right" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topicrow.LAST_POST_TIME}<br />{topicrow.LAST_POST_AUTHOR} {topicrow.LAST_POST_IMG}</span></td>
	</tr>
	<!-- END topicrow -->
	<!-- BEGIN switch_no_topics -->
	<tr> 
	  <td class="row1" colspan="6" height="30" align="center" valign="middle"><span class="gen">{L_NO_TOPICS}</span></td>
	</tr>
	<!-- END switch_no_topics -->
	</form>
<form method="post" action="{S_POST_DAYS_ACTION}">
	<tr> 
	  <td class="catBottom" align="center" valign="middle" colspan="6" height="28"><span class="genmed">{L_DISPLAY_TOPICS}: {S_SELECT_TOPIC_DAYS}  
		<input type="submit" class="liteoption" value="{L_GO}" name="submit" />
		</span></td>
	</tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2" class="tablein">
	<tr> 
	  <td align="left" valign="middle" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
	  <td align="left" valign="middle" width="100%"><span class="nav">   <a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span></td>
	  <td align="right" valign="middle" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span> 
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

<table width="100%" cellspacing="1" border="0" align="center" cellpadding="3" class="tablein">
	<tr>
		<td align="left" class="row1" valign="top"><table cellspacing="3" cellpadding="0" border="0">
			<tr>
				<td width="20" align="left"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}"  /></td>
				<td class="gensmall">{L_NEW_POSTS}</td>
				<td>  </td>
				<td width="20" align="center"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}"  /></td>
				<td class="gensmall">{L_NO_NEW_POSTS}</td>
				<td>  </td>
				<td width="20" align="center"><img src="{FOLDER_GLOBAL_ANNOUNCE_IMG}" alt="{L_GLOBAL_ANNOUNCEMENT}" width="19" height="18" /></td>
        <td class="gensmall">{L_GLOBAL_ANNOUNCEMENT}</td>
			</tr>
			<tr> 
				<td width="20" align="center"><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}"  /></td>
				<td class="gensmall">{L_NEW_POSTS_HOT}</td>
				<td>  </td>
				<td width="20" align="center"><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}"  /></td>
				<td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
				<td>  </td>
				<td width="20" align="center"><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" width="19" height="18" /></td>
        <td class="gensmall">{L_ANNOUNCEMENT}</td>
			</tr>
			<tr>
				<td class="gensmall"><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_TOPIC_LOCKED}"  /></td>
				<td class="gensmall">{L_NEW_POSTS_LOCKED}</td>
				<td>  </td>
				<td class="gensmall"><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_TOPIC_LOCKED}"  /></td>
				<td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
				<td>&nbsp;&nbsp;</td>
        <td width="20" align="center"><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" width="19" height="18" /></td>
        <td class="gensmall">{L_STICKY}</td>
			</tr>
		</table></td>
		<td class="row1" align="right"><span class="gensmall">{S_AUTH_LIST}</span></td>
	</tr>
</table>
