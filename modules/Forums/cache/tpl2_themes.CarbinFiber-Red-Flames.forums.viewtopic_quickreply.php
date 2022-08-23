<?php

// eXtreme Styles mod cache. Generated on Sun, 14 Mar 2021 16:11:27 +0000 (time=1615738287)

?><?php

$switch_open_qr_yes_count = ( isset($this->_tpldata['switch_open_qr_yes.']) ) ?  sizeof($this->_tpldata['switch_open_qr_yes.']) : 0;
for ($switch_open_qr_yes_i = 0; $switch_open_qr_yes_i < $switch_open_qr_yes_count; $switch_open_qr_yes_i++)
{
 $switch_open_qr_yes_item = &$this->_tpldata['switch_open_qr_yes.'][$switch_open_qr_yes_i];
 $switch_open_qr_yes_item['S_ROW_COUNT'] = $switch_open_qr_yes_i;
 $switch_open_qr_yes_item['S_NUM_ROWS'] = $switch_open_qr_yes_count;

?>
<div id="sqr" style="display: show; position: relative; ">
<?php

} // END switch_open_qr_yes

if(isset($switch_open_qr_yes_item)) { unset($switch_open_qr_yes_item); } 

?>
<?php

$switch_open_qr_no_count = ( isset($this->_tpldata['switch_open_qr_no.']) ) ?  sizeof($this->_tpldata['switch_open_qr_no.']) : 0;
for ($switch_open_qr_no_i = 0; $switch_open_qr_no_i < $switch_open_qr_no_count; $switch_open_qr_no_i++)
{
 $switch_open_qr_no_item = &$this->_tpldata['switch_open_qr_no.'][$switch_open_qr_no_i];
 $switch_open_qr_no_item['S_ROW_COUNT'] = $switch_open_qr_no_i;
 $switch_open_qr_no_item['S_NUM_ROWS'] = $switch_open_qr_no_count;

?>
<div id="sqr" style="display: none; position: relative; ">
<?php

} // END switch_open_qr_no

if(isset($switch_open_qr_no_item)) { unset($switch_open_qr_no_item); } 

?>
<form action="<?php echo isset($this->vars['S_POST_ACTION']) ? $this->vars['S_POST_ACTION'] : $this->lang('S_POST_ACTION'); ?>" method="post" name="post">
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead acenter" colspan="2" height="25"><?php echo isset($this->vars['L_QUICK_REPLY']) ? $this->vars['L_QUICK_REPLY'] : $this->lang('L_QUICK_REPLY'); ?></span></td>
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
    <td class="row2"><input type="text" tabindex="1" name="username" style="width:30%; padding-left:7px;" maxlength="25" value="<?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?>" /></td>
  </tr>
  <?php

} // END switch_username_select

if(isset($switch_username_select_item)) { unset($switch_username_select_item); } 

?>
  <tr>
    <td class="row1" width="22%"><?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?></td>
    <td class="row2" width="78%"><input type="text" tabindex="2" name="subject" maxlength="60" style="width:98.8%; padding-left:7px;" value="<?php echo isset($this->vars['SUBJECT']) ? $this->vars['SUBJECT'] : $this->lang('SUBJECT'); ?>" /></td>
  </tr>
  <tr> 
    <td colspan="2" class="row2" valign="top"> 
      <table id="posttable" width="100%" border="0" cellspacing="0" cellpadding="0" valign="top" class="forumline">
        <tr> 
          <td><?php echo isset($this->vars['BB_BOX']) ? $this->vars['BB_BOX'] : $this->lang('BB_BOX'); ?></td>
        </tr>          
      </table>
    </td>
  </tr>
  <?php

$switch_advanced_qr_count = ( isset($this->_tpldata['switch_advanced_qr.']) ) ?  sizeof($this->_tpldata['switch_advanced_qr.']) : 0;
for ($switch_advanced_qr_i = 0; $switch_advanced_qr_i < $switch_advanced_qr_count; $switch_advanced_qr_i++)
{
 $switch_advanced_qr_item = &$this->_tpldata['switch_advanced_qr.'][$switch_advanced_qr_i];
 $switch_advanced_qr_item['S_ROW_COUNT'] = $switch_advanced_qr_i;
 $switch_advanced_qr_item['S_NUM_ROWS'] = $switch_advanced_qr_count;

?>
  <tr>
    <td class="row1" valign="top"><?php echo isset($this->vars['L_OPTIONS']) ? $this->vars['L_OPTIONS'] : $this->lang('L_OPTIONS'); ?></span><br /><?php echo isset($this->vars['HTML_STATUS']) ? $this->vars['HTML_STATUS'] : $this->lang('HTML_STATUS'); ?><br /><?php echo isset($this->vars['BBCODE_STATUS']) ? $this->vars['BBCODE_STATUS'] : $this->lang('BBCODE_STATUS'); ?><br /><?php echo isset($this->vars['SMILIES_STATUS']) ? $this->vars['SMILIES_STATUS'] : $this->lang('SMILIES_STATUS'); ?></td>
    <td class="row2">
      <table cellspacing="0" cellpadding="1" border="0">
        <?php

$switch_html_checkbox_count = ( isset($switch_advanced_qr_item['switch_html_checkbox.']) ) ? sizeof($switch_advanced_qr_item['switch_html_checkbox.']) : 0;
for ($switch_html_checkbox_i = 0; $switch_html_checkbox_i < $switch_html_checkbox_count; $switch_html_checkbox_i++)
{
 $switch_html_checkbox_item = &$switch_advanced_qr_item['switch_html_checkbox.'][$switch_html_checkbox_i];
 $switch_html_checkbox_item['S_ROW_COUNT'] = $switch_html_checkbox_i;
 $switch_html_checkbox_item['S_NUM_ROWS'] = $switch_html_checkbox_count;

?>
        <tr> 
          <td><input type="checkbox" name="disable_html" <?php echo isset($this->vars['S_HTML_CHECKED']) ? $this->vars['S_HTML_CHECKED'] : $this->lang('S_HTML_CHECKED'); ?> value="ON" /></td>
          <td><?php echo isset($this->vars['L_DISABLE_HTML']) ? $this->vars['L_DISABLE_HTML'] : $this->lang('L_DISABLE_HTML'); ?></td>
        </tr>
        <?php

} // END switch_html_checkbox

if(isset($switch_html_checkbox_item)) { unset($switch_html_checkbox_item); } 

?>
        <?php

$switch_bbcode_checkbox_count = ( isset($switch_advanced_qr_item['switch_bbcode_checkbox.']) ) ? sizeof($switch_advanced_qr_item['switch_bbcode_checkbox.']) : 0;
for ($switch_bbcode_checkbox_i = 0; $switch_bbcode_checkbox_i < $switch_bbcode_checkbox_count; $switch_bbcode_checkbox_i++)
{
 $switch_bbcode_checkbox_item = &$switch_advanced_qr_item['switch_bbcode_checkbox.'][$switch_bbcode_checkbox_i];
 $switch_bbcode_checkbox_item['S_ROW_COUNT'] = $switch_bbcode_checkbox_i;
 $switch_bbcode_checkbox_item['S_NUM_ROWS'] = $switch_bbcode_checkbox_count;

?>
        <tr> 
          <td><input type="checkbox" name="disable_bbcode" <?php echo isset($this->vars['S_BBCODE_CHECKED']) ? $this->vars['S_BBCODE_CHECKED'] : $this->lang('S_BBCODE_CHECKED'); ?> value="ON" /></td>
          <td><?php echo isset($this->vars['L_DISABLE_BBCODE']) ? $this->vars['L_DISABLE_BBCODE'] : $this->lang('L_DISABLE_BBCODE'); ?></td>
        </tr>
        <?php

} // END switch_bbcode_checkbox

if(isset($switch_bbcode_checkbox_item)) { unset($switch_bbcode_checkbox_item); } 

?>
        <?php

$switch_smilies_checkbox_count = ( isset($switch_advanced_qr_item['switch_smilies_checkbox.']) ) ? sizeof($switch_advanced_qr_item['switch_smilies_checkbox.']) : 0;
for ($switch_smilies_checkbox_i = 0; $switch_smilies_checkbox_i < $switch_smilies_checkbox_count; $switch_smilies_checkbox_i++)
{
 $switch_smilies_checkbox_item = &$switch_advanced_qr_item['switch_smilies_checkbox.'][$switch_smilies_checkbox_i];
 $switch_smilies_checkbox_item['S_ROW_COUNT'] = $switch_smilies_checkbox_i;
 $switch_smilies_checkbox_item['S_NUM_ROWS'] = $switch_smilies_checkbox_count;

?>
        <tr> 
          <td><input type="checkbox" name="disable_smilies" <?php echo isset($this->vars['S_SMILIES_CHECKED']) ? $this->vars['S_SMILIES_CHECKED'] : $this->lang('S_SMILIES_CHECKED'); ?> value="ON" /></td>
          <td><?php echo isset($this->vars['L_DISABLE_SMILIES']) ? $this->vars['L_DISABLE_SMILIES'] : $this->lang('L_DISABLE_SMILIES'); ?></td>
        </tr>
        <?php

} // END switch_smilies_checkbox

if(isset($switch_smilies_checkbox_item)) { unset($switch_smilies_checkbox_item); } 

?>
        <?php

$switch_signature_checkbox_count = ( isset($switch_advanced_qr_item['switch_signature_checkbox.']) ) ? sizeof($switch_advanced_qr_item['switch_signature_checkbox.']) : 0;
for ($switch_signature_checkbox_i = 0; $switch_signature_checkbox_i < $switch_signature_checkbox_count; $switch_signature_checkbox_i++)
{
 $switch_signature_checkbox_item = &$switch_advanced_qr_item['switch_signature_checkbox.'][$switch_signature_checkbox_i];
 $switch_signature_checkbox_item['S_ROW_COUNT'] = $switch_signature_checkbox_i;
 $switch_signature_checkbox_item['S_NUM_ROWS'] = $switch_signature_checkbox_count;

?>
        <tr> 
          <td><input type="checkbox" name="attach_sig" <?php echo isset($this->vars['S_SIGNATURE_CHECKED']) ? $this->vars['S_SIGNATURE_CHECKED'] : $this->lang('S_SIGNATURE_CHECKED'); ?> value="ON" /></td>
          <td><?php echo isset($this->vars['L_ATTACH_SIGNATURE']) ? $this->vars['L_ATTACH_SIGNATURE'] : $this->lang('L_ATTACH_SIGNATURE'); ?>&nbsp;<?php echo isset($this->vars['L_ATTACH_SIGNATURE_HELP']) ? $this->vars['L_ATTACH_SIGNATURE_HELP'] : $this->lang('L_ATTACH_SIGNATURE_HELP'); ?></td>
        </tr>
        <?php

} // END switch_signature_checkbox

if(isset($switch_signature_checkbox_item)) { unset($switch_signature_checkbox_item); } 

?>
        <?php

$switch_notify_checkbox_count = ( isset($switch_advanced_qr_item['switch_notify_checkbox.']) ) ? sizeof($switch_advanced_qr_item['switch_notify_checkbox.']) : 0;
for ($switch_notify_checkbox_i = 0; $switch_notify_checkbox_i < $switch_notify_checkbox_count; $switch_notify_checkbox_i++)
{
 $switch_notify_checkbox_item = &$switch_advanced_qr_item['switch_notify_checkbox.'][$switch_notify_checkbox_i];
 $switch_notify_checkbox_item['S_ROW_COUNT'] = $switch_notify_checkbox_i;
 $switch_notify_checkbox_item['S_NUM_ROWS'] = $switch_notify_checkbox_count;

?>
        <tr> 
          <td><input type="checkbox" name="notify" <?php echo isset($this->vars['S_NOTIFY_CHECKED']) ? $this->vars['S_NOTIFY_CHECKED'] : $this->lang('S_NOTIFY_CHECKED'); ?> value="ON" /></td>
          <td><?php echo isset($this->vars['L_NOTIFY_ON_REPLY']) ? $this->vars['L_NOTIFY_ON_REPLY'] : $this->lang('L_NOTIFY_ON_REPLY'); ?></td>
        </tr>
        <?php

} // END switch_notify_checkbox

if(isset($switch_notify_checkbox_item)) { unset($switch_notify_checkbox_item); } 

?>
        <?php

$switch_lock_topic_count = ( isset($switch_advanced_qr_item['switch_lock_topic.']) ) ? sizeof($switch_advanced_qr_item['switch_lock_topic.']) : 0;
for ($switch_lock_topic_i = 0; $switch_lock_topic_i < $switch_lock_topic_count; $switch_lock_topic_i++)
{
 $switch_lock_topic_item = &$switch_advanced_qr_item['switch_lock_topic.'][$switch_lock_topic_i];
 $switch_lock_topic_item['S_ROW_COUNT'] = $switch_lock_topic_i;
 $switch_lock_topic_item['S_NUM_ROWS'] = $switch_lock_topic_count;

?>
        <tr> 
          <td><input type="checkbox" name="lock" <?php echo isset($this->vars['S_LOCK_CHECKED']) ? $this->vars['S_LOCK_CHECKED'] : $this->lang('S_LOCK_CHECKED'); ?> value="ON" /></td>
          <td><?php echo isset($this->vars['L_LOCK_TOPIC']) ? $this->vars['L_LOCK_TOPIC'] : $this->lang('L_LOCK_TOPIC'); ?></td>
        </tr>
        <?php

} // END switch_lock_topic

if(isset($switch_lock_topic_item)) { unset($switch_lock_topic_item); } 

?>
        <?php

$switch_unlock_topic_count = ( isset($switch_advanced_qr_item['switch_unlock_topic.']) ) ? sizeof($switch_advanced_qr_item['switch_unlock_topic.']) : 0;
for ($switch_unlock_topic_i = 0; $switch_unlock_topic_i < $switch_unlock_topic_count; $switch_unlock_topic_i++)
{
 $switch_unlock_topic_item = &$switch_advanced_qr_item['switch_unlock_topic.'][$switch_unlock_topic_i];
 $switch_unlock_topic_item['S_ROW_COUNT'] = $switch_unlock_topic_i;
 $switch_unlock_topic_item['S_NUM_ROWS'] = $switch_unlock_topic_count;

?>
        <tr> 
          <td><input type="checkbox" name="unlock" <?php echo isset($this->vars['S_UNLOCK_CHECKED']) ? $this->vars['S_UNLOCK_CHECKED'] : $this->lang('S_UNLOCK_CHECKED'); ?> value="ON" /></td>
          <td><?php echo isset($this->vars['L_UNLOCK_TOPIC']) ? $this->vars['L_UNLOCK_TOPIC'] : $this->lang('L_UNLOCK_TOPIC'); ?></td>
        </tr>
        <?php

} // END switch_unlock_topic

if(isset($switch_unlock_topic_item)) { unset($switch_unlock_topic_item); } 

?>
      </table>
    </td>
  </tr>
  <?php

} // END switch_advanced_qr

if(isset($switch_advanced_qr_item)) { unset($switch_advanced_qr_item); } 

?>
  <tr> 
    <td class="catBottom" colspan="2" align="center" height="28">
      <?php echo isset($this->vars['S_HIDDEN_FORM_FIELDS']) ? $this->vars['S_HIDDEN_FORM_FIELDS'] : $this->lang('S_HIDDEN_FORM_FIELDS'); ?>
      <input style="cursor:pointer;" type="submit" tabindex="5" name="preview" id="preview" class="mainoption" value="<?php echo isset($this->vars['L_PREVIEW']) ? $this->vars['L_PREVIEW'] : $this->lang('L_PREVIEW'); ?>" />
      <input style="cursor:pointer;" type="submit" id="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" />
    </td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td class="aright" valign="top"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></td>
  </tr>
</table>
</form>
</div>