<form name="form" method="post" action="{FORM_ACTION}">
<table width="60%" cellpadding="1" cellspacing="1" border="0" align="center">
  <tr>
        <td align="center"><span class="genmed">{L_SHOWING_POSTS} <strong>{STATUS}</strong></span></td>
  </tr>
  <tr>
        <td align="center"><span class="gensmall">{L_SELECT_MODE}
                                                  [ <a href="{FORM_ACTION}&mode=today" class="mainmenu">{L_TODAY}</a> ]
                                                  [ <a href="{FORM_ACTION}&mode=yesterday" class="mainmenu">{L_YESTERDAY}</a> ]
                                                  [ <a href="{FORM_ACTION}&mode=last24" class="mainmenu">{L_LAST24}</a> ]
                                                  [ <a href="{FORM_ACTION}&mode=lastweek" class="mainmenu">{L_LASTWEEK}</a> ]
                                                  [ {L_LAST} <input type="hidden" name="mode" value="lastXdays" />
                                                                   <input type="text" name="amount_days" size="2" value="{AMOUNT_DAYS}" maxlength="3" class="post" />
                                                                   <a href="javascript:document.form.submit();" class="mainmenu">{L_DAYS}</a> ]</span></td>
  </tr>
</table></form>

<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
  <tr>
        <td><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
</table>

<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center" class="forumline">
  <tr>
        <th colspan="5">{L_RECENT_TITLE}</th>
  </tr>
  <!-- BEGIN recent -->
  <tr> 
        <td class="{recent.ROW_CLASS}" align="center" valign="middle"><img src="{recent.TOPIC_FOLDER_IMG}" alt="{recent.TOPIC_FOLDER_ALT}" title="{recent.TOPIC_FOLDER_ALT}" /></td>
        <td class="{recent.ROW_CLASS}" nowrap="nowrap"><span class="topictitle">{recent.NEWEST_IMG}{recent.TOPIC_TYPE}<a href="{recent.U_VIEW_TOPIC}" class="topictitle">{recent.TOPIC_TITLE}</a></span>
                                                                                       <span class="gensmall">{recent.GOTO_PAGE}<br />{recent.FIRST_TIME}{recent.FIRST_AUTHOR}</span></td>
        <td class="{recent.ROW_CLASS}" width="10%" align="left"><span class="postdetails">&nbsp;{recent.L_REPLIES}: {recent.REPLIES}
                                                                                                   <br />&nbsp;{recent.L_VIEWS}: {recent.VIEWS}</span></td>
        <td class="{recent.ROW_CLASS}" width="25%" nowrap="nowrap">&nbsp;<span class="genmed"><a href="{recent.U_VIEW_FORUM}" class="genmed">{recent.FORUM_NAME}</span></td>
        <td class="{recent.ROW_CLASS}" align="right" width="20%" nowrap="nowrap"><span class="gensmall"> {recent.LAST_URL} {recent.LAST_TIME}&nbsp;&nbsp;
                                                                                                                             <br />{recent.LAST_AUTHOR}</span>&nbsp;&nbsp;</td>
  </tr>
  <!-- END recent -->
  <!-- BEGIN switch_no_topics -->
  <tr>
        <td colspan="5" class="row1" align="center" height="28"><span class="gen"><i>{L_NO_TOPICS}</i></span></td>
  </tr>
  <!-- END switch_no_topics -->
  <tr>
        <td colspan="5" class="catBottom" height="28">&nbsp;</td>
  </tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
        <td><span class="nav">{PAGE_NUMBER}</span></td>
        <td align="right"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>