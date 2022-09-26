<?php

// eXtreme Styles mod cache. Generated on Sun, 25 Sep 2022 12:55:46 +0000 (time=1664110546)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">


<?php

$privmsg_extensions_count = ( isset($this->_tpldata['privmsg_extensions.']) ) ?  sizeof($this->_tpldata['privmsg_extensions.']) : 0;
for ($privmsg_extensions_i = 0; $privmsg_extensions_i < $privmsg_extensions_count; $privmsg_extensions_i++)
{
 $privmsg_extensions_item = &$this->_tpldata['privmsg_extensions.'][$privmsg_extensions_i];
 $privmsg_extensions_item['S_ROW_COUNT'] = $privmsg_extensions_i;
 $privmsg_extensions_item['S_NUM_ROWS'] = $privmsg_extensions_count;

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
  <tr> 
    <td valign="top" align="center" width="100%"> 
      <table height="40" cellspacing="2" cellpadding="2" border="0">
        <tr valign="middle"> 
          <td><?php echo isset($this->vars['INBOX_IMG']) ? $this->vars['INBOX_IMG'] : $this->lang('INBOX_IMG'); ?></td>
          <td><span class="cattitle"><?php echo isset($this->vars['INBOX_LINK']) ? $this->vars['INBOX_LINK'] : $this->lang('INBOX_LINK'); ?></span></td>
          <td><?php echo isset($this->vars['SENTBOX_IMG']) ? $this->vars['SENTBOX_IMG'] : $this->lang('SENTBOX_IMG'); ?></td>
          <td><span class="cattitle"><?php echo isset($this->vars['SENTBOX_LINK']) ? $this->vars['SENTBOX_LINK'] : $this->lang('SENTBOX_LINK'); ?></span></td>
          <td><?php echo isset($this->vars['OUTBOX_IMG']) ? $this->vars['OUTBOX_IMG'] : $this->lang('OUTBOX_IMG'); ?></td>
          <td><span class="cattitle"><?php echo isset($this->vars['OUTBOX_LINK']) ? $this->vars['OUTBOX_LINK'] : $this->lang('OUTBOX_LINK'); ?></span></td>
          <td><?php echo isset($this->vars['SAVEBOX_IMG']) ? $this->vars['SAVEBOX_IMG'] : $this->lang('SAVEBOX_IMG'); ?></td>
          <td><span class="cattitle"><?php echo isset($this->vars['SAVEBOX_LINK']) ? $this->vars['SAVEBOX_LINK'] : $this->lang('SAVEBOX_LINK'); ?></span></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br clear="all" />
<?php

} // END privmsg_extensions

if(isset($privmsg_extensions_item)) { unset($privmsg_extensions_item); } 

?>
<form action="<?php echo isset($this->vars['S_POST_ACTION']) ? $this->vars['S_POST_ACTION'] : $this->lang('S_POST_ACTION'); ?>" method="post" name="post" <?php echo isset($this->vars['S_FORM_ENCTYPE']) ? $this->vars['S_FORM_ENCTYPE'] : $this->lang('S_FORM_ENCTYPE'); ?>>
<?php echo isset($this->vars['POST_PREVIEW_BOX']) ? $this->vars['POST_PREVIEW_BOX'] : $this->lang('POST_PREVIEW_BOX'); ?>
<?php echo isset($this->vars['ERROR_BOX']) ? $this->vars['ERROR_BOX'] : $this->lang('ERROR_BOX'); ?>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
    <?php

$switch_not_privmsg_count = ( isset($this->_tpldata['switch_not_privmsg.']) ) ?  sizeof($this->_tpldata['switch_not_privmsg.']) : 0;
for ($switch_not_privmsg_i = 0; $switch_not_privmsg_i < $switch_not_privmsg_count; $switch_not_privmsg_i++)
{
 $switch_not_privmsg_item = &$this->_tpldata['switch_not_privmsg.'][$switch_not_privmsg_i];
 $switch_not_privmsg_item['S_ROW_COUNT'] = $switch_not_privmsg_i;
 $switch_not_privmsg_item['S_NUM_ROWS'] = $switch_not_privmsg_count;

?> 
    <?php if ($this->vars['PARENT_FORUM']) {  ?> -> <a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a> <?php } ?>
    -> <a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a>
    <!-- // Begin View Topic Name While Posting MOD -->
    <?php

$reply_mode_count = ( isset($switch_not_privmsg_item['reply_mode.']) ) ? sizeof($switch_not_privmsg_item['reply_mode.']) : 0;
for ($reply_mode_i = 0; $reply_mode_i < $reply_mode_count; $reply_mode_i++)
{
 $reply_mode_item = &$switch_not_privmsg_item['reply_mode.'][$reply_mode_i];
 $reply_mode_item['S_ROW_COUNT'] = $reply_mode_i;
 $reply_mode_item['S_NUM_ROWS'] = $reply_mode_count;

?>
    -> <a href="<?php echo isset($this->vars['U_VIEW_TOPIC']) ? $this->vars['U_VIEW_TOPIC'] : $this->lang('U_VIEW_TOPIC'); ?>"><?php echo isset($this->vars['TOPIC_SUBJECT']) ? $this->vars['TOPIC_SUBJECT'] : $this->lang('TOPIC_SUBJECT'); ?></a>
    <?php

} // END reply_mode

if(isset($reply_mode_item)) { unset($reply_mode_item); } 

?>
    <!-- // End View Topic Name While Posting MOD -->
    </td>
    <?php

} // END switch_not_privmsg

if(isset($switch_not_privmsg_item)) { unset($switch_not_privmsg_item); } 

?>
  </tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  <tr> 
    <td style="height:30px; text-align:center;" class="catHead" colspan="2"><?php echo isset($this->vars['L_POST_A']) ? $this->vars['L_POST_A'] : $this->lang('L_POST_A'); ?></th>
  </tr>
  <?php

$switch_username_select_count = ( isset($this->_tpldata['switch_username_select.']) ) ?  sizeof($this->_tpldata['switch_username_select.']) : 0;
for ($switch_username_select_i = 0; $switch_username_select_i < $switch_username_select_count; $switch_username_select_i++)
{
 $switch_username_select_item = &$this->_tpldata['switch_username_select.'][$switch_username_select_i];
 $switch_username_select_item['S_ROW_COUNT'] = $switch_username_select_i;
 $switch_username_select_item['S_NUM_ROWS'] = $switch_username_select_count;

?>
  <tr> 
    <td class="row1"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></td>
    <td class="row2"><input type="text" class="post" tabindex="1" name="username" style="width:30%; padding-left:7px; letter-spacing:1px;" maxlength="25" value="<?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?>" /></td>
  </tr>
  <?php

} // END switch_username_select

if(isset($switch_username_select_item)) { unset($switch_username_select_item); } 

?>
  <?php

$switch_privmsg_count = ( isset($this->_tpldata['switch_privmsg.']) ) ?  sizeof($this->_tpldata['switch_privmsg.']) : 0;
for ($switch_privmsg_i = 0; $switch_privmsg_i < $switch_privmsg_count; $switch_privmsg_i++)
{
 $switch_privmsg_item = &$this->_tpldata['switch_privmsg.'][$switch_privmsg_i];
 $switch_privmsg_item['S_ROW_COUNT'] = $switch_privmsg_i;
 $switch_privmsg_item['S_NUM_ROWS'] = $switch_privmsg_count;

?>
  <tr> 
    <td class="row1"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></td>
    <td class="row2"><input type="text" class="post" name="username" style="width:30%; padding-left:7px; letter-spacing:1px;" tabindex="1" value="<?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?>" />&nbsp;<input style="border:1px solid black; cursor:pointer; text-transform: uppercase;" type="submit" name="usersubmit" value="<?php echo isset($this->vars['L_FIND_USERNAME']) ? $this->vars['L_FIND_USERNAME'] : $this->lang('L_FIND_USERNAME'); ?>" class="liteoption" onclick="window.open('<?php echo isset($this->vars['U_SEARCH_USER']) ? $this->vars['U_SEARCH_USER'] : $this->lang('U_SEARCH_USER'); ?>', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></td>
  </tr>
  <?php

} // END switch_privmsg

if(isset($switch_privmsg_item)) { unset($switch_privmsg_item); } 

?>
  <!-- Start add - Custom mass PM MOD -->
  <?php

$switch_groupmsg_count = ( isset($this->_tpldata['switch_groupmsg.']) ) ?  sizeof($this->_tpldata['switch_groupmsg.']) : 0;
for ($switch_groupmsg_i = 0; $switch_groupmsg_i < $switch_groupmsg_count; $switch_groupmsg_i++)
{
 $switch_groupmsg_item = &$this->_tpldata['switch_groupmsg.'][$switch_groupmsg_i];
 $switch_groupmsg_item['S_ROW_COUNT'] = $switch_groupmsg_i;
 $switch_groupmsg_item['S_NUM_ROWS'] = $switch_groupmsg_count;

?>
  <tr> 
    <td class="row1"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></td>
    <td class="row2"><?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?></td>
  </tr>
  <?php

} // END switch_groupmsg

if(isset($switch_groupmsg_item)) { unset($switch_groupmsg_item); } 

?>
  <!-- End add - Custom mass PM MOD -->
  <tr> 
    <td class="row1" style="width: 20%"><?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?></td>
    <td class="row2" style="width: 80%"><input type="text" name="subject" size="45" maxlength="60" style="width:98.8%; fpadding-left:7px; letter-spacing:1px;" tabindex="2" class="post" value="<?php echo isset($this->vars['SUBJECT']) ? $this->vars['SUBJECT'] : $this->lang('SUBJECT'); ?>" /></td>
  </tr>
  <?php

$switch_icon_checkbox_count = ( isset($this->_tpldata['switch_icon_checkbox.']) ) ?  sizeof($this->_tpldata['switch_icon_checkbox.']) : 0;
for ($switch_icon_checkbox_i = 0; $switch_icon_checkbox_i < $switch_icon_checkbox_count; $switch_icon_checkbox_i++)
{
 $switch_icon_checkbox_item = &$this->_tpldata['switch_icon_checkbox.'][$switch_icon_checkbox_i];
 $switch_icon_checkbox_item['S_ROW_COUNT'] = $switch_icon_checkbox_i;
 $switch_icon_checkbox_item['S_NUM_ROWS'] = $switch_icon_checkbox_count;

?>
  <tr>
    <td valign="top" class="row1"><?php echo isset($this->vars['L_ICON_TITLE']) ? $this->vars['L_ICON_TITLE'] : $this->lang('L_ICON_TITLE'); ?></td>
    <td class="row2">
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <?php

$row_count = ( isset($switch_icon_checkbox_item['row.']) ) ? sizeof($switch_icon_checkbox_item['row.']) : 0;
for ($row_i = 0; $row_i < $row_count; $row_i++)
{
 $row_item = &$switch_icon_checkbox_item['row.'][$row_i];
 $row_item['S_ROW_COUNT'] = $row_i;
 $row_item['S_NUM_ROWS'] = $row_count;

?>
        <tr>
          <td nowrap="nowrap">
            <?php

$cell_count = ( isset($row_item['cell.']) ) ? sizeof($row_item['cell.']) : 0;
for ($cell_i = 0; $cell_i < $cell_count; $cell_i++)
{
 $cell_item = &$row_item['cell.'][$cell_i];
 $cell_item['S_ROW_COUNT'] = $cell_i;
 $cell_item['S_NUM_ROWS'] = $cell_count;

?>
            <input style="cursor:pointer;" type="radio" name="post_icon" value="<?php echo isset($cell_item['ICON_ID']) ? $cell_item['ICON_ID'] : ''; ?>"<?php echo isset($cell_item['ICON_CHECKED']) ? $cell_item['ICON_CHECKED'] : ''; ?>>&nbsp;<?php echo isset($cell_item['ICON_IMG']) ? $cell_item['ICON_IMG'] : ''; ?>&nbsp;&nbsp;
            <?php

} // END cell

if(isset($cell_item)) { unset($cell_item); } 

?>
          </td>
        </tr>
        <?php

} // END row

if(isset($row_item)) { unset($row_item); } 

?>
      </table>
    </td>
  </tr>
  <?php

} // END switch_icon_checkbox

if(isset($switch_icon_checkbox_item)) { unset($switch_icon_checkbox_item); } 

?>
  <tr> 
    <td colspan="2" class="row2" valign="top"> 
      <table id="posttable" width="100%" border="0" cellspacing="0" cellpadding="0" valign="top" class="forumline">
        <tr valign="middle"> 
          <td valign="center"><?php echo isset($this->vars['BB_BOX']) ? $this->vars['BB_BOX'] : $this->lang('BB_BOX'); ?></td>
        </tr>          
      </table>
    </td>
  </tr>

  <!-- START posting options -->
  <tr> 
    <td class="row1" style="vertical-align: top"><?php echo isset($this->vars['L_OPTIONS']) ? $this->vars['L_OPTIONS'] : $this->lang('L_OPTIONS'); ?><span class="tooltip-html icon-sprite icon-info" title="<?php echo isset($this->vars['HTML_STATUS']) ? $this->vars['HTML_STATUS'] : $this->lang('HTML_STATUS'); ?><br /><?php echo isset($this->vars['BBCODE_STATUS']) ? $this->vars['BBCODE_STATUS'] : $this->lang('BBCODE_STATUS'); ?><br /><?php echo isset($this->vars['SMILIES_STATUS']) ? $this->vars['SMILIES_STATUS'] : $this->lang('SMILIES_STATUS'); ?>"></span></td>
    <td class="row2" style="vertical-align: top"> 
        <?php

$switch_html_checkbox_count = ( isset($this->_tpldata['switch_html_checkbox.']) ) ?  sizeof($this->_tpldata['switch_html_checkbox.']) : 0;
for ($switch_html_checkbox_i = 0; $switch_html_checkbox_i < $switch_html_checkbox_count; $switch_html_checkbox_i++)
{
 $switch_html_checkbox_item = &$this->_tpldata['switch_html_checkbox.'][$switch_html_checkbox_i];
 $switch_html_checkbox_item['S_ROW_COUNT'] = $switch_html_checkbox_i;
 $switch_html_checkbox_item['S_NUM_ROWS'] = $switch_html_checkbox_count;

?>
        <input type="checkbox" name="disable_html" <?php echo isset($this->vars['S_HTML_CHECKED']) ? $this->vars['S_HTML_CHECKED'] : $this->lang('S_HTML_CHECKED'); ?> value="ON" /> <?php echo isset($this->vars['L_DISABLE_HTML']) ? $this->vars['L_DISABLE_HTML'] : $this->lang('L_DISABLE_HTML'); ?>
        <?php

} // END switch_html_checkbox

if(isset($switch_html_checkbox_item)) { unset($switch_html_checkbox_item); } 

?>
        <?php

$switch_bbcode_checkbox_count = ( isset($this->_tpldata['switch_bbcode_checkbox.']) ) ?  sizeof($this->_tpldata['switch_bbcode_checkbox.']) : 0;
for ($switch_bbcode_checkbox_i = 0; $switch_bbcode_checkbox_i < $switch_bbcode_checkbox_count; $switch_bbcode_checkbox_i++)
{
 $switch_bbcode_checkbox_item = &$this->_tpldata['switch_bbcode_checkbox.'][$switch_bbcode_checkbox_i];
 $switch_bbcode_checkbox_item['S_ROW_COUNT'] = $switch_bbcode_checkbox_i;
 $switch_bbcode_checkbox_item['S_NUM_ROWS'] = $switch_bbcode_checkbox_count;

?>
        | <input type="checkbox" name="disable_bbcode" <?php echo isset($this->vars['S_BBCODE_CHECKED']) ? $this->vars['S_BBCODE_CHECKED'] : $this->lang('S_BBCODE_CHECKED'); ?> value="ON" /> <?php echo isset($this->vars['L_DISABLE_BBCODE']) ? $this->vars['L_DISABLE_BBCODE'] : $this->lang('L_DISABLE_BBCODE'); ?>
        <?php

} // END switch_bbcode_checkbox

if(isset($switch_bbcode_checkbox_item)) { unset($switch_bbcode_checkbox_item); } 

?>
        <?php

$switch_smilies_checkbox_count = ( isset($this->_tpldata['switch_smilies_checkbox.']) ) ?  sizeof($this->_tpldata['switch_smilies_checkbox.']) : 0;
for ($switch_smilies_checkbox_i = 0; $switch_smilies_checkbox_i < $switch_smilies_checkbox_count; $switch_smilies_checkbox_i++)
{
 $switch_smilies_checkbox_item = &$this->_tpldata['switch_smilies_checkbox.'][$switch_smilies_checkbox_i];
 $switch_smilies_checkbox_item['S_ROW_COUNT'] = $switch_smilies_checkbox_i;
 $switch_smilies_checkbox_item['S_NUM_ROWS'] = $switch_smilies_checkbox_count;

?>
        | <input type="checkbox" name="disable_smilies" <?php echo isset($this->vars['S_SMILIES_CHECKED']) ? $this->vars['S_SMILIES_CHECKED'] : $this->lang('S_SMILIES_CHECKED'); ?> value="ON" /> <?php echo isset($this->vars['L_DISABLE_SMILIES']) ? $this->vars['L_DISABLE_SMILIES'] : $this->lang('L_DISABLE_SMILIES'); ?>
        <?php

} // END switch_smilies_checkbox

if(isset($switch_smilies_checkbox_item)) { unset($switch_smilies_checkbox_item); } 

?>
        <?php

$switch_signature_checkbox_count = ( isset($this->_tpldata['switch_signature_checkbox.']) ) ?  sizeof($this->_tpldata['switch_signature_checkbox.']) : 0;
for ($switch_signature_checkbox_i = 0; $switch_signature_checkbox_i < $switch_signature_checkbox_count; $switch_signature_checkbox_i++)
{
 $switch_signature_checkbox_item = &$this->_tpldata['switch_signature_checkbox.'][$switch_signature_checkbox_i];
 $switch_signature_checkbox_item['S_ROW_COUNT'] = $switch_signature_checkbox_i;
 $switch_signature_checkbox_item['S_NUM_ROWS'] = $switch_signature_checkbox_count;

?>
        <br /><input type="checkbox" name="attach_sig" <?php echo isset($this->vars['S_SIGNATURE_CHECKED']) ? $this->vars['S_SIGNATURE_CHECKED'] : $this->lang('S_SIGNATURE_CHECKED'); ?> value="ON" /> <?php echo isset($this->vars['L_ATTACH_SIGNATURE']) ? $this->vars['L_ATTACH_SIGNATURE'] : $this->lang('L_ATTACH_SIGNATURE'); ?> <span class="gensmall"><?php echo isset($this->vars['L_ATTACH_SIGNATURE_HELP']) ? $this->vars['L_ATTACH_SIGNATURE_HELP'] : $this->lang('L_ATTACH_SIGNATURE_HELP'); ?></span>
        <?php

} // END switch_signature_checkbox

if(isset($switch_signature_checkbox_item)) { unset($switch_signature_checkbox_item); } 

?>
        <?php

$switch_notify_checkbox_count = ( isset($this->_tpldata['switch_notify_checkbox.']) ) ?  sizeof($this->_tpldata['switch_notify_checkbox.']) : 0;
for ($switch_notify_checkbox_i = 0; $switch_notify_checkbox_i < $switch_notify_checkbox_count; $switch_notify_checkbox_i++)
{
 $switch_notify_checkbox_item = &$this->_tpldata['switch_notify_checkbox.'][$switch_notify_checkbox_i];
 $switch_notify_checkbox_item['S_ROW_COUNT'] = $switch_notify_checkbox_i;
 $switch_notify_checkbox_item['S_NUM_ROWS'] = $switch_notify_checkbox_count;

?>
        <br /><input type="checkbox" name="notify" <?php echo isset($this->vars['S_NOTIFY_CHECKED']) ? $this->vars['S_NOTIFY_CHECKED'] : $this->lang('S_NOTIFY_CHECKED'); ?> value="ON" /> <?php echo isset($this->vars['L_NOTIFY_ON_REPLY']) ? $this->vars['L_NOTIFY_ON_REPLY'] : $this->lang('L_NOTIFY_ON_REPLY'); ?>
        <?php

} // END switch_notify_checkbox

if(isset($switch_notify_checkbox_item)) { unset($switch_notify_checkbox_item); } 

?>
        <?php

$switch_delete_checkbox_count = ( isset($this->_tpldata['switch_delete_checkbox.']) ) ?  sizeof($this->_tpldata['switch_delete_checkbox.']) : 0;
for ($switch_delete_checkbox_i = 0; $switch_delete_checkbox_i < $switch_delete_checkbox_count; $switch_delete_checkbox_i++)
{
 $switch_delete_checkbox_item = &$this->_tpldata['switch_delete_checkbox.'][$switch_delete_checkbox_i];
 $switch_delete_checkbox_item['S_ROW_COUNT'] = $switch_delete_checkbox_i;
 $switch_delete_checkbox_item['S_NUM_ROWS'] = $switch_delete_checkbox_count;

?>
        <br /><input type="checkbox" name="delete" value="ON" /> <?php echo isset($this->vars['L_DELETE_POST']) ? $this->vars['L_DELETE_POST'] : $this->lang('L_DELETE_POST'); ?>
        <?php

} // END switch_delete_checkbox

if(isset($switch_delete_checkbox_item)) { unset($switch_delete_checkbox_item); } 

?>    
        <?php

$switch_topic_glance_priority_count = ( isset($this->_tpldata['switch_topic_glance_priority.']) ) ?  sizeof($this->_tpldata['switch_topic_glance_priority.']) : 0;
for ($switch_topic_glance_priority_i = 0; $switch_topic_glance_priority_i < $switch_topic_glance_priority_count; $switch_topic_glance_priority_i++)
{
 $switch_topic_glance_priority_item = &$this->_tpldata['switch_topic_glance_priority.'][$switch_topic_glance_priority_i];
 $switch_topic_glance_priority_item['S_ROW_COUNT'] = $switch_topic_glance_priority_i;
 $switch_topic_glance_priority_item['S_NUM_ROWS'] = $switch_topic_glance_priority_count;

?>
        <br /><input type="checkbox" name="topic_glance_priority" <?php echo isset($this->vars['TOPIC_GLANCE_PRIORITY_CHECKED']) ? $this->vars['TOPIC_GLANCE_PRIORITY_CHECKED'] : $this->lang('TOPIC_GLANCE_PRIORITY_CHECKED'); ?> value="1" /> <?php echo isset($this->vars['L_TOPIC_GLANCE_PRIORITY']) ? $this->vars['L_TOPIC_GLANCE_PRIORITY'] : $this->lang('L_TOPIC_GLANCE_PRIORITY'); ?> <span class="gensmall"><?php echo isset($this->vars['L_TOPIC_GLANCE_PRIORITY_HELP']) ? $this->vars['L_TOPIC_GLANCE_PRIORITY_HELP'] : $this->lang('L_TOPIC_GLANCE_PRIORITY_HELP'); ?></span>
        <?php

} // END switch_topic_glance_priority

if(isset($switch_topic_glance_priority_item)) { unset($switch_topic_glance_priority_item); } 

?>
        <?php

$switch_lock_topic_count = ( isset($this->_tpldata['switch_lock_topic.']) ) ?  sizeof($this->_tpldata['switch_lock_topic.']) : 0;
for ($switch_lock_topic_i = 0; $switch_lock_topic_i < $switch_lock_topic_count; $switch_lock_topic_i++)
{
 $switch_lock_topic_item = &$this->_tpldata['switch_lock_topic.'][$switch_lock_topic_i];
 $switch_lock_topic_item['S_ROW_COUNT'] = $switch_lock_topic_i;
 $switch_lock_topic_item['S_NUM_ROWS'] = $switch_lock_topic_count;

?>
        <br /><input type="checkbox" name="lock" <?php echo isset($this->vars['S_LOCK_CHECKED']) ? $this->vars['S_LOCK_CHECKED'] : $this->lang('S_LOCK_CHECKED'); ?> value="ON" /> <?php echo isset($this->vars['L_LOCK_TOPIC']) ? $this->vars['L_LOCK_TOPIC'] : $this->lang('L_LOCK_TOPIC'); ?>
        <?php

} // END switch_lock_topic

if(isset($switch_lock_topic_item)) { unset($switch_lock_topic_item); } 

?>
        <?php

$switch_unlock_topic_count = ( isset($this->_tpldata['switch_unlock_topic.']) ) ?  sizeof($this->_tpldata['switch_unlock_topic.']) : 0;
for ($switch_unlock_topic_i = 0; $switch_unlock_topic_i < $switch_unlock_topic_count; $switch_unlock_topic_i++)
{
 $switch_unlock_topic_item = &$this->_tpldata['switch_unlock_topic.'][$switch_unlock_topic_i];
 $switch_unlock_topic_item['S_ROW_COUNT'] = $switch_unlock_topic_i;
 $switch_unlock_topic_item['S_NUM_ROWS'] = $switch_unlock_topic_count;

?>
        <br /><input type="checkbox" name="unlock" <?php echo isset($this->vars['S_UNLOCK_CHECKED']) ? $this->vars['S_UNLOCK_CHECKED'] : $this->lang('S_UNLOCK_CHECKED'); ?> value="ON" /> <?php echo isset($this->vars['L_UNLOCK_TOPIC']) ? $this->vars['L_UNLOCK_TOPIC'] : $this->lang('L_UNLOCK_TOPIC'); ?>
        <?php

} // END switch_unlock_topic

if(isset($switch_unlock_topic_item)) { unset($switch_unlock_topic_item); } 

?>
        <?php

$switch_Welcome_PM_count = ( isset($this->_tpldata['switch_Welcome_PM.']) ) ?  sizeof($this->_tpldata['switch_Welcome_PM.']) : 0;
for ($switch_Welcome_PM_i = 0; $switch_Welcome_PM_i < $switch_Welcome_PM_count; $switch_Welcome_PM_i++)
{
 $switch_Welcome_PM_item = &$this->_tpldata['switch_Welcome_PM.'][$switch_Welcome_PM_i];
 $switch_Welcome_PM_item['S_ROW_COUNT'] = $switch_Welcome_PM_i;
 $switch_Welcome_PM_item['S_NUM_ROWS'] = $switch_Welcome_PM_count;

?>
        <br /><input type="checkbox" name="w_pm" <?php echo isset($this->vars['S_WELCOME_PM']) ? $this->vars['S_WELCOME_PM'] : $this->lang('S_WELCOME_PM'); ?> value="ON" /> <?php echo isset($this->vars['L_WELCOME_PM']) ? $this->vars['L_WELCOME_PM'] : $this->lang('L_WELCOME_PM'); ?>
        <?php

} // END switch_Welcome_PM

if(isset($switch_Welcome_PM_item)) { unset($switch_Welcome_PM_item); } 

?>
    </td>        
  </tr>
  <?php

$switch_type_toggle_count = ( isset($this->_tpldata['switch_type_toggle.']) ) ?  sizeof($this->_tpldata['switch_type_toggle.']) : 0;
for ($switch_type_toggle_i = 0; $switch_type_toggle_i < $switch_type_toggle_count; $switch_type_toggle_i++)
{
 $switch_type_toggle_item = &$this->_tpldata['switch_type_toggle.'][$switch_type_toggle_i];
 $switch_type_toggle_item['S_ROW_COUNT'] = $switch_type_toggle_i;
 $switch_type_toggle_item['S_NUM_ROWS'] = $switch_type_toggle_count;

?>
  <?php if ($this->vars['S_TYPE_TOGGLE']) {  ?>
  <tr> 
    <td class="row1"><?php echo isset($this->vars['L_TYPE_TOGGLE']) ? $this->vars['L_TYPE_TOGGLE'] : $this->lang('L_TYPE_TOGGLE'); ?></td>
    <td class="row2"> 
        <?php echo isset($this->vars['S_TYPE_TOGGLE']) ? $this->vars['S_TYPE_TOGGLE'] : $this->lang('S_TYPE_TOGGLE'); ?><br />
    </td>        
  </tr>
  <?php } ?>
  <?php

} // END switch_type_toggle

if(isset($switch_type_toggle_item)) { unset($switch_type_toggle_item); } 

?>
  <!-- END posting options -->
  <?php echo isset($this->vars['ATTACHBOX']) ? $this->vars['ATTACHBOX'] : $this->lang('ATTACHBOX'); ?>
  <?php echo isset($this->vars['POLLBOX']) ? $this->vars['POLLBOX'] : $this->lang('POLLBOX'); ?> 
  <tr> 
    <td style="height:30px; text-align:center;" class="catBottom" colspan="2">
      <?php echo isset($this->vars['S_HIDDEN_FORM_FIELDS']) ? $this->vars['S_HIDDEN_FORM_FIELDS'] : $this->lang('S_HIDDEN_FORM_FIELDS'); ?>
      <input type="submit" tabindex="5" name="preview" id="preview" class="liteoption" value="<?php echo isset($this->vars['L_PREVIEW']) ? $this->vars['L_PREVIEW'] : $this->lang('L_PREVIEW'); ?>" />
      <input type="submit" id="submit" accesskey="s" tabindex="6" name="post" class="liteoption" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" />
    </td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td align="right" valign="top"><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span></td>
  </tr>
</table>
</form>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>

<?php echo isset($this->vars['TOPIC_REVIEW_BOX']) ? $this->vars['TOPIC_REVIEW_BOX'] : $this->lang('TOPIC_REVIEW_BOX'); ?>
</tr>
</tbody>
</table>
</div>
