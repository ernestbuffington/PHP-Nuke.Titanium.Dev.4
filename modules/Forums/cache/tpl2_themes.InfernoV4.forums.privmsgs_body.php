<?php

// eXtreme Styles mod cache. Generated on Mon, 03 May 2021 03:13:57 +0000 (time=1620011637)

?><script>
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

<form method="post" name="privmsg_list" action="<?php echo isset($this->vars['S_PRIVMSGS_ACTION']) ? $this->vars['S_PRIVMSGS_ACTION'] : $this->lang('S_PRIVMSGS_ACTION'); ?>">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left" valign="middle"><?php echo isset($this->vars['POST_PM_IMG']) ? $this->vars['POST_PM_IMG'] : $this->lang('POST_PM_IMG'); ?></td>
    <!-- Start add - Custom mass PM MOD -->
    <td align="left" valign="middle"><?php echo isset($this->vars['MASS_PM_IMG']) ? $this->vars['MASS_PM_IMG'] : $this->lang('MASS_PM_IMG'); ?></td>
    <!-- End add - Custom mass PM MOD -->
    <td align="left" width="100%"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>
    <td align="right" nowrap="nowrap">
      <?php echo isset($this->vars['L_DISPLAY_MESSAGES']) ? $this->vars['L_DISPLAY_MESSAGES'] : $this->lang('L_DISPLAY_MESSAGES'); ?>: <select name="msgdays"><?php echo isset($this->vars['S_SELECT_MSG_DAYS']) ? $this->vars['S_SELECT_MSG_DAYS'] : $this->lang('S_SELECT_MSG_DAYS'); ?></select><input type="submit" value="<?php echo isset($this->vars['L_GO']) ? $this->vars['L_GO'] : $this->lang('L_GO'); ?>" name="submit_msgdays" class="liteoption" />
    </td>
  </tr>
</table>

<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
  <tr>
    <td class="catHead" colspan="4" style="text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['L_INBOX']) ? $this->vars['L_INBOX'] : $this->lang('L_INBOX'); ?></td>
  </tr>

  <?php if ($this->vars['BOX_SIZE_STATUS']) {  ?>
  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%;">
        <tr>
          <td colspan="2"><?php echo isset($this->vars['BOX_SIZE_STATUS']) ? $this->vars['BOX_SIZE_STATUS'] : $this->lang('BOX_SIZE_STATUS'); ?> <?php echo isset($this->vars['L_INBOX_PERCENTAGE']) ? $this->vars['L_INBOX_PERCENTAGE'] : $this->lang('L_INBOX_PERCENTAGE'); ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <progress alt="<?php echo isset($this->vars['BOX_SIZE_STATUS']) ? $this->vars['BOX_SIZE_STATUS'] : $this->lang('BOX_SIZE_STATUS'); ?>" title=<?php echo isset($this->vars['BOX_SIZE_STATUS']) ? $this->vars['BOX_SIZE_STATUS'] : $this->lang('BOX_SIZE_STATUS'); ?>" style="-webkit-appearance: progress-bar; box-sizing: border-box; display: inline-block; height: 15px; width: 100%;" value="<?php echo isset($this->vars['INBOX_LIMIT_PERCENT']) ? $this->vars['INBOX_LIMIT_PERCENT'] : $this->lang('INBOX_LIMIT_PERCENT'); ?>" max="100"></progress>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%;">
        <tr>
          <td colspan="2"><?php echo isset($this->vars['ATTACH_BOX_SIZE_STATUS']) ? $this->vars['ATTACH_BOX_SIZE_STATUS'] : $this->lang('ATTACH_BOX_SIZE_STATUS'); ?></td>
        </tr>
        <tr>
          <td colspan="2"><progress alt="<?php echo isset($this->vars['ATTACH_BOX_SIZE_STATUS']) ? $this->vars['ATTACH_BOX_SIZE_STATUS'] : $this->lang('ATTACH_BOX_SIZE_STATUS'); ?>" title="<?php echo isset($this->vars['ATTACH_BOX_SIZE_STATUS']) ? $this->vars['ATTACH_BOX_SIZE_STATUS'] : $this->lang('ATTACH_BOX_SIZE_STATUS'); ?>" style="-webkit-appearance: progress-bar; box-sizing: border-box; display: inline-block; height: 15px; width: 100%;" value="<?php echo isset($this->vars['ATTACHBOX_LIMIT_PERCENT']) ? $this->vars['ATTACHBOX_LIMIT_PERCENT'] : $this->lang('ATTACHBOX_LIMIT_PERCENT'); ?>" max="100"></progress></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="catHead" colspan="4" style="height: 10px;">&nbsp;</td>
  </tr>
  <?php } ?>

  <tr>
    <td class="row1" style="width: 25%;"><span style="float: left;"><?php echo isset($this->vars['INBOX']) ? $this->vars['INBOX'] : $this->lang('INBOX'); ?></span><span style="float: right;">(<?php echo isset($this->vars['TOTAL_INBOX']) ? $this->vars['TOTAL_INBOX'] : $this->lang('TOTAL_INBOX'); ?>)</span></td>
    <td class="row1" style="width: 25%;"><span style="float: left;"><?php echo isset($this->vars['SENTBOX']) ? $this->vars['SENTBOX'] : $this->lang('SENTBOX'); ?></span><span style="float: right;">(<?php echo isset($this->vars['TOTAL_SENTBOX']) ? $this->vars['TOTAL_SENTBOX'] : $this->lang('TOTAL_SENTBOX'); ?>)</span></td>
    <td class="row1" style="width: 25%;"><span style="float: left;"><?php echo isset($this->vars['OUTBOX']) ? $this->vars['OUTBOX'] : $this->lang('OUTBOX'); ?></span><span style="float: right;">(<?php echo isset($this->vars['TOTAL_OUTBOX']) ? $this->vars['TOTAL_OUTBOX'] : $this->lang('TOTAL_OUTBOX'); ?>)</span></td>
    <td class="row1" style="width: 25%;"><span style="float: left;"><?php echo isset($this->vars['SAVEBOX']) ? $this->vars['SAVEBOX'] : $this->lang('SAVEBOX'); ?></span><span style="float: right;">(<?php echo isset($this->vars['TOTAL_SAVEBOX']) ? $this->vars['TOTAL_SAVEBOX'] : $this->lang('TOTAL_SAVEBOX'); ?>)</span></td>
  </tr>

  <!-- SPACING -->
  <tr>
    <td class="catHead" colspan="4" style="height: 10px;">&nbsp;</td>
  </tr>

  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
        <tr>
          <td class="catHead" style="text-align: center; width: 5%;"><?php echo isset($this->vars['L_FLAG']) ? $this->vars['L_FLAG'] : $this->lang('L_FLAG'); ?></td>
          <td class="catHead" style="width: 50%;"><?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?></td>
          <td class="catHead" style="width: 20%;"><?php echo isset($this->vars['L_FROM_OR_TO']) ? $this->vars['L_FROM_OR_TO'] : $this->lang('L_FROM_OR_TO'); ?></td>
          <td class="catHead" style="width: 20%;"><?php echo isset($this->vars['L_DATE']) ? $this->vars['L_DATE'] : $this->lang('L_DATE'); ?></td>
          <td class="catHead" style="text-align: center; width: 5%;"><?php echo isset($this->vars['L_MARK']) ? $this->vars['L_MARK'] : $this->lang('L_MARK'); ?></td>
        </tr>
        <?php

$listrow_count = ( isset($this->_tpldata['listrow.']) ) ?  sizeof($this->_tpldata['listrow.']) : 0;
for ($listrow_i = 0; $listrow_i < $listrow_count; $listrow_i++)
{
 $listrow_item = &$this->_tpldata['listrow.'][$listrow_i];
 $listrow_item['S_ROW_COUNT'] = $listrow_i;
 $listrow_item['S_NUM_ROWS'] = $listrow_count;

?>
        <tr>
          <td class="row1" style="text-align: center; width: 5%;"><img src="<?php echo isset($listrow_item['PRIVMSG_FOLDER_IMG']) ? $listrow_item['PRIVMSG_FOLDER_IMG'] : ''; ?>" alt="<?php echo isset($listrow_item['L_PRIVMSG_FOLDER_ALT']) ? $listrow_item['L_PRIVMSG_FOLDER_ALT'] : ''; ?>" title="<?php echo isset($listrow_item['L_PRIVMSG_FOLDER_ALT']) ? $listrow_item['L_PRIVMSG_FOLDER_ALT'] : ''; ?>" /></td>
          <td class="row1" style="width: 50%;"><a href="<?php echo isset($listrow_item['U_READ']) ? $listrow_item['U_READ'] : ''; ?>"><?php echo isset($listrow_item['SUBJECT']) ? $listrow_item['SUBJECT'] : ''; ?></a></td>
          <td class="row1" style="width: 20%;"><a href="<?php echo isset($listrow_item['U_FROM_USER_PROFILE']) ? $listrow_item['U_FROM_USER_PROFILE'] : ''; ?>"><?php echo isset($listrow_item['FROM']) ? $listrow_item['FROM'] : ''; ?></a></td>
          <td class="row1" style="width: 20%;"><?php echo isset($listrow_item['DATE']) ? $listrow_item['DATE'] : ''; ?></td>
          <td class="row1" style="text-align: center; width: 5%;"><input class="checkbox" type="checkbox" style="cursor: pointer;" name="mark[]" value="<?php echo isset($listrow_item['S_MARK_ID']) ? $listrow_item['S_MARK_ID'] : ''; ?>"></td>
        </tr>
        <?php

} // END listrow

if(isset($listrow_item)) { unset($listrow_item); } 

?>
        <?php

$switch_no_messages_count = ( isset($this->_tpldata['switch_no_messages.']) ) ?  sizeof($this->_tpldata['switch_no_messages.']) : 0;
for ($switch_no_messages_i = 0; $switch_no_messages_i < $switch_no_messages_count; $switch_no_messages_i++)
{
 $switch_no_messages_item = &$this->_tpldata['switch_no_messages.'][$switch_no_messages_i];
 $switch_no_messages_item['S_ROW_COUNT'] = $switch_no_messages_i;
 $switch_no_messages_item['S_NUM_ROWS'] = $switch_no_messages_count;

?>
        <tr> 
          <td class="row1" colspan="5" align="center" valign="middle"><?php echo isset($this->vars['L_NO_MESSAGES']) ? $this->vars['L_NO_MESSAGES'] : $this->lang('L_NO_MESSAGES'); ?></td>
        </tr>
        <?php

} // END switch_no_messages

if(isset($switch_no_messages_item)) { unset($switch_no_messages_item); } 

?>
        <tr>
          <td class="catBottom" colspan="4" style="text-align: right;">
            <?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
            <input type="submit" name="save" value="<?php echo isset($this->vars['L_SAVE_MARKED']) ? $this->vars['L_SAVE_MARKED'] : $this->lang('L_SAVE_MARKED'); ?>" class="mainoption" />
            <input type="submit" name="delete" value="<?php echo isset($this->vars['L_DELETE_MARKED']) ? $this->vars['L_DELETE_MARKED'] : $this->lang('L_DELETE_MARKED'); ?>" class="liteoption" />
            <input type="submit" name="deleteall" value="<?php echo isset($this->vars['L_DELETE_ALL']) ? $this->vars['L_DELETE_ALL'] : $this->lang('L_DELETE_ALL'); ?>" class="liteoption" />
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
    <td align="left" valign="middle"><span class="nav"><?php echo isset($this->vars['POST_PM_IMG']) ? $this->vars['POST_PM_IMG'] : $this->lang('POST_PM_IMG'); ?></span></td>
    <!-- Start add - Custom mass PM MOD -->
    <td align="left" valign="middle"><span class="nav"><?php echo isset($this->vars['MASS_PM_IMG']) ? $this->vars['MASS_PM_IMG'] : $this->lang('MASS_PM_IMG'); ?></span></td>
    <!-- End add - Custom mass PM MOD -->
    <td align="left" valign="middle" width="100%"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></td>
    <td align="right" valign="top" nowrap="nowrap">
      <a href="javascript:select_switch(true);"><?php echo isset($this->vars['L_MARK_ALL']) ? $this->vars['L_MARK_ALL'] : $this->lang('L_MARK_ALL'); ?></a> :: <a href="javascript:select_switch(false);"><?php echo isset($this->vars['L_UNMARK_ALL']) ? $this->vars['L_UNMARK_ALL'] : $this->lang('L_UNMARK_ALL'); ?></a>
      <?php if ($this->vars['PAGINATION']) {  ?>
      <br /><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?>
      <?php } ?>
      <br /><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?>
    </td>
  </tr>
</table>
</form>

<!-- <table width="100%" border="0">
  <tr> 
    <td style="text-align: right;"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table> -->

</tr>
</tbody>
</table>
</div>
