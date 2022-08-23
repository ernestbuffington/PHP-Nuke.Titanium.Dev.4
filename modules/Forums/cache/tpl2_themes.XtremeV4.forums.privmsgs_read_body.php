<?php

// eXtreme Styles mod cache. Generated on Wed, 28 Apr 2021 22:05:07 +0000 (time=1619647507)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
    <?php if ($this->vars['MESSAGE_FROM_ID'] != 1) {  ?>
    <td><?php echo isset($this->vars['REPLY_PM_IMG']) ? $this->vars['REPLY_PM_IMG'] : $this->lang('REPLY_PM_IMG'); ?></td>
    <?php } ?>
    <td style="width: 100%;">&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>
  </tr>
</table>

<form method="post" action="<?php echo isset($this->vars['S_PRIVMSGS_ACTION']) ? $this->vars['S_PRIVMSGS_ACTION'] : $this->lang('S_PRIVMSGS_ACTION'); ?>">
<table style="width: 100%; table-layout: fixed;" border="0" cellpadding="4" cellspacing="1" class="forumline">
  <tr>
    <td class="catHead" colspan="4" style="text-align: center; text-transform: uppercase;"><?php echo isset($this->vars['BOX_NAME']) ? $this->vars['BOX_NAME'] : $this->lang('BOX_NAME'); ?> :: <?php echo isset($this->vars['L_MESSAGE']) ? $this->vars['L_MESSAGE'] : $this->lang('L_MESSAGE'); ?></td>
  </tr>
  <tr>
    <td class="row1" style="width: 25%;"><?php echo isset($this->vars['INBOX']) ? $this->vars['INBOX'] : $this->lang('INBOX'); ?></td>
    <td class="row1" style="width: 25%;"><?php echo isset($this->vars['SENTBOX']) ? $this->vars['SENTBOX'] : $this->lang('SENTBOX'); ?></td>
    <td class="row1" style="width: 25%;"><?php echo isset($this->vars['OUTBOX']) ? $this->vars['OUTBOX'] : $this->lang('OUTBOX'); ?></td>
    <td class="row1" style="width: 25%;"><?php echo isset($this->vars['SAVEBOX']) ? $this->vars['SAVEBOX'] : $this->lang('SAVEBOX'); ?></td>
  </tr>
  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%; table-layout: fixed;" border="0" cellpadding="4" cellspacing="1" class="forumline">
        <tr>
          <td class="row1" style="width: 20%; text-align: right"><?php echo isset($this->vars['L_FROM']) ? $this->vars['L_FROM'] : $this->lang('L_FROM'); ?></td>
          <td class="row1" colspan="2"><?php echo isset($this->vars['MESSAGE_FROM']) ? $this->vars['MESSAGE_FROM'] : $this->lang('MESSAGE_FROM'); ?><?php if ($this->vars['MESSAGE_FROM_ID'] != 1) {  ?>&nbsp;<?php echo isset($this->vars['POSTER_FROM_ONLINE_STATUS']) ? $this->vars['POSTER_FROM_ONLINE_STATUS'] : $this->lang('POSTER_FROM_ONLINE_STATUS'); ?><?php } ?></td>
        </tr>
        <tr>
          <td class="row1" style="width: 20%; text-align: right"><?php echo isset($this->vars['L_TO']) ? $this->vars['L_TO'] : $this->lang('L_TO'); ?></td>
          <td class="row1" colspan="2"><?php echo isset($this->vars['MESSAGE_TO']) ? $this->vars['MESSAGE_TO'] : $this->lang('MESSAGE_TO'); ?>&nbsp;<?php echo isset($this->vars['POSTER_TO_ONLINE_STATUS']) ? $this->vars['POSTER_TO_ONLINE_STATUS'] : $this->lang('POSTER_TO_ONLINE_STATUS'); ?></td>
        </tr>
        <tr>
          <td class="row1" style="width: 20%; text-align: right"><?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?></td>
          <td class="row1" colspan="2"><?php echo isset($this->vars['POST_DATE']) ? $this->vars['POST_DATE'] : $this->lang('POST_DATE'); ?></td>
        </tr>
        <tr>
          <td class="row1" style="width: 20%; text-align: right"><?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?></td>
          <td class="row1"><?php echo isset($this->vars['POST_SUBJECT']) ? $this->vars['POST_SUBJECT'] : $this->lang('POST_SUBJECT'); ?></td>
          <td class="row1" style="width: 20%; text-align: center"><?php if ($this->vars['MESSAGE_FROM_ID'] != 1) {  ?><?php echo isset($this->vars['QUOTE_PM_IMG']) ? $this->vars['QUOTE_PM_IMG'] : $this->lang('QUOTE_PM_IMG'); ?> <?php } ?><?php echo isset($this->vars['EDIT_PM_IMG']) ? $this->vars['EDIT_PM_IMG'] : $this->lang('EDIT_PM_IMG'); ?></td>
        </tr>
        <tr>
          <td class="row1" colspan="3"><span class="postbody"><?php echo isset($this->vars['MESSAGE']) ? $this->vars['MESSAGE'] : $this->lang('MESSAGE'); ?></span><?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?><?php echo isset($this->vars['ATTACHMENTS']) ? $this->vars['ATTACHMENTS'] : $this->lang('ATTACHMENTS'); ?><?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?></td>
        </tr>
        <tr>
          <td class="row1" colspan="3"><?php echo isset($this->vars['PROFILE_IMG']) ? $this->vars['PROFILE_IMG'] : $this->lang('PROFILE_IMG'); ?> <?php echo isset($this->vars['PM_IMG']) ? $this->vars['PM_IMG'] : $this->lang('PM_IMG'); ?> <?php echo isset($this->vars['EMAIL_IMG']) ? $this->vars['EMAIL_IMG'] : $this->lang('EMAIL_IMG'); ?> <?php echo isset($this->vars['WWW_IMG']) ? $this->vars['WWW_IMG'] : $this->lang('WWW_IMG'); ?></td>
        </tr>
        <tr>
          <td class="catBottom" colspan="3" height="28" align="right"> <?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?><input type="submit" name="save" value="<?php echo isset($this->vars['L_SAVE_MSG']) ? $this->vars['L_SAVE_MSG'] : $this->lang('L_SAVE_MSG'); ?>" class="liteoption" />&nbsp;<input type="submit" name="delete" value="<?php echo isset($this->vars['L_DELETE_MSG']) ? $this->vars['L_DELETE_MSG'] : $this->lang('L_DELETE_MSG'); ?>" class="liteoption" /><?php

$switch_attachments_count = ( isset($this->_tpldata['switch_attachments.']) ) ?  sizeof($this->_tpldata['switch_attachments.']) : 0;
for ($switch_attachments_i = 0; $switch_attachments_i < $switch_attachments_count; $switch_attachments_i++)
{
 $switch_attachments_item = &$this->_tpldata['switch_attachments.'][$switch_attachments_i];
 $switch_attachments_item['S_ROW_COUNT'] = $switch_attachments_i;
 $switch_attachments_item['S_NUM_ROWS'] = $switch_attachments_count;

?>&nbsp;<input type="submit" name="pm_delete_attach" value="<?php echo isset($this->vars['L_DELETE_ATTACHMENTS']) ? $this->vars['L_DELETE_ATTACHMENTS'] : $this->lang('L_DELETE_ATTACHMENTS'); ?>" class="liteoption" /><?php

} // END switch_attachments

if(isset($switch_attachments_item)) { unset($switch_attachments_item); } 

?></td>
        </tr>
        <?php if ($this->vars['MESSAGE_FROM_ID'] != 1) {  ?>
        <?php echo isset($this->vars['ROPM_QUICKREPLY_OUTPUT']) ? $this->vars['ROPM_QUICKREPLY_OUTPUT'] : $this->lang('ROPM_QUICKREPLY_OUTPUT'); ?>
        <?php } ?> 
      </table>
    </td>
  </tr>
  <tr>
    <td class="catBottom" colspan="4">&nbsp;</td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <?php if ($this->vars['MESSAGE_FROM_ID'] != 1) {  ?>
    <td><?php echo isset($this->vars['REPLY_PM_IMG']) ? $this->vars['REPLY_PM_IMG'] : $this->lang('REPLY_PM_IMG'); ?></td>
    <?php } ?>
    <td align="right" valign="top"><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span></td>
  </tr>
</table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td valign="top" align="right"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>

</tr>
</tbody>
</table>
</div>
