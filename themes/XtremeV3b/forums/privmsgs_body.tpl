<script>
// "select all" change
nuke_jq( document ).ready(function($) 
{
  $("#select_all").change(function()
  {
      var status = this.checked;
      $('.checkbox').each(function()
      {
          this.checked = status; 
      });
  });

  $('.checkbox').change(function()
  {
      if(this.checked == false)
      {
          $("#select_all")[0].checked = false; 
      }
      
      if ($('.checkbox:checked').length == $('.checkbox').length )
      {
          $("#select_all")[0].checked = true; 
      }
  });
});
</script>
<div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<form method="post" name="privmsg_list" action="{S_PRIVMSGS_ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td width="77%" align="left" valign="middle">{POST_PM_IMG} {MASS_PM_IMG}<strong>&nbsp;<a href="{U_HINDEX}">{L_INDEXHOME}</a></strong> <i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;"></i><strong> Private Messages</strong> {PAGE_NUMBER}</td>
    <td width="23%" align="right" nowrap="nowrap">
      {L_DISPLAY_MESSAGES}: <select name="msgdays">{S_SELECT_MSG_DAYS}</select><input type="submit" value="{L_GO}" name="submit_msgdays" class="titaniumbutton" />
    </td>
  </tr>
</table>

<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
  <tr>
    <td class="catHead" colspan="4" style="text-align: center; text-transform: uppercase;">{L_INBOX}</td>
  </tr>

  <!-- IF BOX_SIZE_STATUS -->
  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%;">
        <tr>
          <td colspan="2">{BOX_SIZE_STATUS} {L_INBOX_PERCENTAGE}</td>
        </tr>
        <tr> 
          <td colspan="2">
            <progress alt="{BOX_SIZE_STATUS}" title={BOX_SIZE_STATUS}" style="-webkit-appearance: progress-bar; box-sizing: border-box; display: inline-block; height: 5px; width: 100%; background-color: #f3f3f3;" value="{INBOX_LIMIT_PERCENT}" max="100"></progress>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%;">
        <tr>
          <td colspan="2">{ATTACH_BOX_SIZE_STATUS}</td>
        </tr>
        <tr>
          <td colspan="2"><progress alt="{ATTACH_BOX_SIZE_STATUS}" title="{ATTACH_BOX_SIZE_STATUS}" style="-webkit-appearance: progress-bar; box-sizing: border-box; display: inline-block; height: 5px; width: 100%;" value="{ATTACHBOX_LIMIT_PERCENT}" max="100"></progress></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="catHead" colspan="4" style="height: 10px;">&nbsp;</td>
  </tr>
  <!-- ENDIF -->

  <tr>
    <td class="row1" style="width: 25%;"><span style="float: left;">{INBOX}</span><span style="float: right;">({TOTAL_INBOX})</span></td>
    <td class="row1" style="width: 25%;"><span style="float: left;">{SENTBOX}</span><span style="float: right;">({TOTAL_SENTBOX})</span></td>
    <td class="row1" style="width: 25%;"><span style="float: left;">{OUTBOX}</span><span style="float: right;">({TOTAL_OUTBOX})</span></td>
    <td class="row1" style="width: 25%;"><span style="float: left;">{SAVEBOX}</span><span style="float: right;">({TOTAL_SAVEBOX})</span></td>
  </tr>

  <!-- SPACING -->
  <tr>
    <td class="catHead" colspan="4" style="height: 10px;">&nbsp;</td>
  </tr>

  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
        <tr>
          <td class="catHead" style="text-align: center; width: 5%;">{L_FLAG}</td>
          <td class="catHead" style="width: 50%;">{L_SUBJECT}</td>
          <td class="catHead" style="width: 20%;">{L_FROM_OR_TO}</td>
          <td class="catHead" style="width: 20%;">{L_DATE}</td>
          <td class="catHead" style="text-align: center; width: 5%;">{L_MARK}</td>
        </tr>
        <!-- BEGIN listrow -->
        <tr>
          <td class="row1" style="text-align: center; width: 5%;"><img src="{listrow.PRIVMSG_FOLDER_IMG}" alt="{listrow.L_PRIVMSG_FOLDER_ALT}" title="{listrow.L_PRIVMSG_FOLDER_ALT}" /></td>
          <td class="row1" style="width: 50%;"><a href="{listrow.U_READ}">{listrow.SUBJECT}</a></td>
          <td class="row1" style="width: 20%;"><a href="{listrow.U_FROM_USER_PROFILE}">{listrow.FROM}</a></td>
          <td class="row1" style="width: 20%;">{listrow.DATE}</td>
          <td class="row1" style="text-align: center; width: 5%;"><input class="checkbox" type="checkbox" style="cursor: pointer;" name="mark[]" value="{listrow.S_MARK_ID}"></td>
        </tr>
        <!-- END listrow -->
        <!-- BEGIN switch_no_messages -->
        <tr> 
          <td class="row1" colspan="5" align="center" valign="middle">{L_NO_MESSAGES}</td>
        </tr>
        <!-- END switch_no_messages -->
        <tr>
          <td class="catBottom" colspan="4" style="text-align: right;">
            {S_HIDDEN_FIELDS}
            <input type="submit" name="save" value="{L_SAVE_MARKED}" class="titaniumbutton" />
            <input type="submit" name="delete" value="{L_DELETE_MARKED}" class="titaniumbutton" />
            <input type="submit" name="deleteall" value="{L_DELETE_ALL}" class="titaniumbutton" />
          </td>
          <td class="catBottom"><i><input type="checkbox" id="select_all" style="cursor: pointer;"/> Select All</i></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="catBottom" colspan="4">&nbsp;</td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td width="73%" align="left" valign="middle">{POST_PM_IMG} {MASS_PM_IMG}<strong>&nbsp;<a href="{U_HINDEX}">{L_INDEXHOME}</a></strong> <i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;"></i><strong> Private Messages</strong> {PAGE_NUMBER}</td>
    <!-- Start add - Custom mass PM MOD -->
    <!-- End add - Custom mass PM MOD -->
    <td width="27%" align="right" valign="top" nowrap="nowrap">
      <a href="javascript:select_switch(true);">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);">{L_UNMARK_ALL}</a>
      <!-- IF PAGINATION -->
      <br />{PAGINATION}
      <!-- ENDIF -->
      <br />{S_TIMEZONE}
    </td>
  </tr>
</table>
</form>

<!-- <table width="100%" border="0">
  <tr> 
    <td style="text-align: right;">{JUMPBOX}</td>
  </tr>
</table> -->

</tr>
</tbody>
</table>
</div>