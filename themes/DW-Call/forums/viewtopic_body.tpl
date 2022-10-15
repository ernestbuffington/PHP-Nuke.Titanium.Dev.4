<table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
   <tr>
      <td width="100%" colspan="2" valign="top">
      <!-- MOD GLANCE BEGIN -->
      {GLANCE_OUTPUT}
      <!-- MOD GLANCE END -->
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

<table width="100%" cellspacing="2" cellpadding="2">
  <tr> 
    <td align="left" valign="bottom" colspan="2">
		Topic Title:<a class="maintitle" href="{U_VIEW_TOPIC}"> &nbsp;&nbsp;{TOPIC_TITLE}</a>
		<!--IF PAGINATION-->
        {PAGINATION}
		<!--ENDIF-->
	</td>
  </tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0" style="padding: 0px 0px 10px 0px;">
  <tr> 
    <td align="left" valign="bottom" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle"></a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="{U_PRINTER_TOPIC}"><img src="{PRINTER_IMG}" border="0" alt="{L_PRINTER_TOPIC}" align="middle" /></a></span></td>
    <td align="right" valign="bottom" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
      -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
  </tr>
</table>
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
    <tr align="right">
        <td class="catHead" colspan="2" height="28"><span class="nav"><a href="{U_VIEW_OLDER_TOPIC}" class="nav">{L_VIEW_PREVIOUS_TOPIC}</a> :: <a href="{U_VIEW_NEWER_TOPIC}" class="nav">{L_VIEW_NEXT_TOPIC}</a> &nbsp;</span></td>
    </tr>
    {POLL_DISPLAY} 
    <tr>
        <th class="thLeft" width="200" height="26" nowrap="nowrap">{L_AUTHOR}</th>
        <th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
    </tr>
    <!-- BEGIN postrow -->
    <tr> 
        <td width="15%" align="center" valign="center" class="{postrow.ROW_CLASS}" style="vertical-align: top; padding: 8px;"><span class="name"><a name="{postrow.U_POST_ID}"></a><br /><strong>{postrow.POSTER_NAME}<hr /><br /></strong></span><span class="postdetails">{postrow.POSTER_RANK}
        <!-- BEGIN switch_showavatars --><center>{postrow.POSTER_AVATAR}</center><!-- END switch_showavatars -->
        <br /><hr /><br />
      <center>
      {postrow.USER_RANK_01_IMG}
      {postrow.USER_RANK_02_IMG}
      {postrow.USER_RANK_03_IMG}
      {postrow.USER_RANK_04_IMG}
      {postrow.USER_RANK_05_IMG}
      <br />
      <hr />
      <br />
      <!-- IF postrow.USER_RANK_01 -->
      <div class="clearfix">
        <span style="float: left;">{L_RANK_TITLE}</span>
        <span style="float: right;">{postrow.USER_RANK_01}</span>
      </div>
      <!-- ENDIF -->
      <!-- IF postrow.USER_RANK_02 -->
      <div class="clearfix">
        <span style="float: right;">{postrow.USER_RANK_02}</span>
      </div>
      <!-- ENDIF -->
      <!-- IF postrow.USER_RANK_03 -->
      <div class="clearfix">
        <span style="float: right;">{postrow.USER_RANK_03}</span>
      </div>
      <!-- ENDIF -->
      <!-- IF postrow.USER_RANK_04 -->
      <div class="clearfix">
        <span style="float: right;">{postrow.USER_RANK_04}</span>
      </div>
      <!-- ENDIF -->
      <!-- IF postrow.USER_RANK_05 -->
      <div class="clearfix">
        <span style="float: right;">{postrow.USER_RANK_05}</span>
      </div>
      <!-- ENDIF -->
      <div class="clearfix">
        <span style="float: left;">{L_POST_COUNT}</span>
        <span style="float: right;">{postrow.POSTER_POSTS}</span>
      </div>
      <!-- IF REPUTATION -->
      <div class="clearfix">
        <span style="float: left;">{L_REPUTATION}</span>
        <span style="float: right;">{postrow.REPUTATION}</span>
      </div>
      <!-- ENDIF -->
      <div class="clearfix">
        <span style="float: left;">{L_JOINED}</span>
        <span style="float: right;">{postrow.POSTER_JOINED}</span>
      </div>
      <!-- <div style="height: 19px">
        <span style="float: left;">{L_LAST_ACTIVITY}</span>
        <span style="float: right;">{postrow.USER_LAST_VISIT}</span>
      </div> -->
      <div class="clearfix">
        <span style="float: left;">{L_STATUS}</span>
        <span style="float: right;">{postrow.POSTER_ONLINE_STATUS}</span>
      </div>
      <!-- IF postrow.POSTER_GENDER -->
      <div class="clearfix">
        <span style="float: left;">{L_GENDER}</span>
        <span style="float: right;">{postrow.POSTER_GENDER}</span>
      </div> 
      <!-- ENDIF -->
        <!-- BEGIN xdata -->
        <br />{postrow.xdata.NAME}: {postrow.xdata.VALUE}
        <!-- END xdata -->
        </span></td>
        <td class="{postrow.ROW_CLASS}" width="100%" height="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="40%" align="left" style="padding: 30px 4px 2px 4px;"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">{L_POSTED}:&nbsp;{postrow.POST_DATE}<hr /></span></td>
                <td width="60%" align="left" style="padding: 30px 4px 2px 4px;"><span class="postdetails">{L_POST_SUBJECT}:{postrow.POST_SUBJECT}<hr /></span></td>
            <tr>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" height="100%" valign="top" style="padding: 10px 10px 35px 10px;"><span class="postbody"><div id="postwrap">{postrow.MESSAGE}</span>{postrow.ATTACHMENTS}<span class="postbody"><br /></div></span></td>
                </tr>
                <!-- Start add - Bottom aligned signature MOD -->
                <tr>
                        <td colspan="2" style="padding: 0px 0px 2px 15px;"><SPAN CLASS="postbody">{postrow.SIGNATURE}</SPAN><SPAN CLASS="genmed">{postrow.EDITED_MESSAGE}</SPAN></td> 
                <!-- End add - Bottom aligned signature MOD -->
            </tr>
        </table></td>
        </tr>
            <tr>
                <td class="{postrow.ROW_CLASS}" width="100%" colspan="2" valign="bottom" align="right" nowrap="nowrap" style="padding: 3px 10px 3px 0px;">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG} {postrow.REPORT_IMG}</td>
    </tr>
    <tr> 
        <td class="{postrow.ROW_CLASS}" width="150" align="middle" valign="top" style="padding-top: 5px;"><span class="nav"><a href="#top" class="nav">{L_BACK_TO_TOP}</a></span></td>
        <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="bottom" align="right" nowrap="nowrap" style="padding: 3px 10px 5px 0px;"><table cellspacing="0" cellpadding="0" border="0" width="18">
            <tr> 
                <td valign="middle" nowrap="nowrap">{postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG}</td>
            </tr>
        </table></td>
    </tr>
    <tr>
          <td colspan="2" class="{postrow.ROW_CLASS}" width="100%" style="padding: 4%;"><hr /><hr /></td>
    </tr>
<!-- BEGIN switch_spacer -->
    <tr> 
        <td class="spaceRow" colspan="2" height="1"><img src="modules/Forums/templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
<!-- END switch_spacer -->
<!-- BEGIN move_message -->
<tr>
        <td class="row3" colspan="2"><span class="postdetails">{postrow.move_message.MOVE_MESSAGE}</span></td>
</tr>
<!-- END move_message -->
<!-- END postrow -->
<td class="catBottom" colspan="2" height="28" style="padding: 50px 5px 10px 0px">
    <table cellspacing="0" cellpadding="0" border="0" style="float: right;">
        <tr>
          <td>
            <form method="post" action="{S_POST_DAYS_ACTION}">
              {L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}{S_SELECT_POST_ORDER} <input type="submit" value="{L_GO}" class="liteoption" name="submit" />
            </form>
          </td>
        </tr>
    </table>
  </td>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center"><br />
  <tr> 
      <td align="left" valign="bottom" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
      ->&nbsp;&nbsp;<a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span>
  </tr>
</td>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center"><br />
  <tr> 
    <td align="left" valign="middle" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a>
    <!-- BEGIN switch_quick_reply -->
	&nbsp;&nbsp;<a href="{U_POST_SQR_TOPIC}"><img src="{SQR_IMG}" border="0" alt="{L_POST_SQR_TOPIC}" align="middle" /></a>
    <!-- END switch_quick_reply -->
	&nbsp;&nbsp;<a target="_blank" href="{U_PRINTER_TOPIC}"><img src="{PRINTER_IMG}" border="0" alt="{L_PRINTER_TOPIC}" align="middle" /></a>
    </span></td>
    <td align="right" valign="middle" nowrap="nowrap"><span class="genmed">{S_TIMEZONE}</span><span class="nav">{PAGINATION}</span></td> 
  </tr>
  <tr>
    <td align="left" colspan="3"><span class="nav"><br />{PAGE_NUMBER}</span></td>
  </tr>
</table>
<br />
<!-- BEGIN switch_quick_reply -->
    {QRBODY}
<!-- END switch_quick_reply -->

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td width="40%" valign="top" nowrap="nowrap" align="left"><span class="gensmall">{S_WATCH_TOPIC}</span><br />
      &nbsp;<br />
      {S_TOPIC_ADMIN}</td>
    <td align="right" valign="top" nowrap="nowrap">{JUMPBOX}<span class="gensmall">{S_AUTH_LIST}</span></td>
  </tr>
</table>