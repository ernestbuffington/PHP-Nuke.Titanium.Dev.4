<?php

// eXtreme Styles mod cache. Generated on Wed, 21 Dec 2022 14:35:32 +0000 (time=1671633332)

?><table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
   <tr>
      <td width="100%" colspan="2" valign="top">
      <!-- MOD GLANCE BEGIN -->
      <?php echo isset($this->vars['GLANCE_OUTPUT']) ? $this->vars['GLANCE_OUTPUT'] : $this->lang('GLANCE_OUTPUT'); ?>
      <!-- MOD GLANCE END -->
	  </td>
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
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td align="left" valign="bottom" colspan="2"><a class="maintitle" href="<?php echo isset($this->vars['U_VIEW_TOPIC']) ? $this->vars['U_VIEW_TOPIC'] : $this->lang('U_VIEW_TOPIC'); ?>"><?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?></a><br />
<span class="gensmall"><strong><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></strong>
</td>
</tr>
</table>
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
<table style="width: 100%;" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td align="left" valign="bottom" nowrap="nowrap">
<span class="nav">
<!-- TOPIC BUTTON (NEW POST) --><a href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['POST_IMG']) ? $this->vars['POST_IMG'] : $this->lang('POST_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>" align="middle" /></a><!-- TOPIC BUTTON (NEW POST) -->
<!-- TOPIC BUTTON (REPLY POST) --><a href="<?php echo isset($this->vars['U_POST_REPLY_TOPIC']) ? $this->vars['U_POST_REPLY_TOPIC'] : $this->lang('U_POST_REPLY_TOPIC'); ?>"><img src="<?php echo isset($this->vars['REPLY_IMG']) ? $this->vars['REPLY_IMG'] : $this->lang('REPLY_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_REPLY_TOPIC']) ? $this->vars['L_POST_REPLY_TOPIC'] : $this->lang('L_POST_REPLY_TOPIC'); ?>" align="middle" /></a><!-- TOPIC BUTTON (REPLY POST) -->
<!-- TOPIC BUTTON (PRINT POST) --><a target="_blank" href="<?php echo isset($this->vars['U_PRINTER_TOPIC']) ? $this->vars['U_PRINTER_TOPIC'] : $this->lang('U_PRINTER_TOPIC'); ?>"><img src="<?php echo isset($this->vars['PRINTER_IMG']) ? $this->vars['PRINTER_IMG'] : $this->lang('PRINTER_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_PRINTER_TOPIC']) ? $this->vars['L_PRINTER_TOPIC'] : $this->lang('L_PRINTER_TOPIC'); ?>" align="middle" /></a><!-- TOPIC BUTTON (PRINT POST) -->
<!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) --><a href="<?php echo isset($this->vars['U_WHOVIEW_TOPIC']) ? $this->vars['U_WHOVIEW_TOPIC'] : $this->lang('U_WHOVIEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['WHOVIEW_IMG']) ? $this->vars['WHOVIEW_IMG'] : $this->lang('WHOVIEW_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_WHOVIEW_ALT']) ? $this->vars['L_WHOVIEW_ALT'] : $this->lang('L_WHOVIEW_ALT'); ?>" align="middle" /></a><!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
<?php

$thanks_button_count = ( isset($this->_tpldata['thanks_button.']) ) ?  sizeof($this->_tpldata['thanks_button.']) : 0;
for ($thanks_button_i = 0; $thanks_button_i < $thanks_button_count; $thanks_button_i++)
{
 $thanks_button_item = &$this->_tpldata['thanks_button.'][$thanks_button_i];
 $thanks_button_item['S_ROW_COUNT'] = $thanks_button_i;
 $thanks_button_item['S_NUM_ROWS'] = $thanks_button_count;

?>
<!-- TOPIC BUTTON (THANK POST) --><a href="<?php echo isset($thanks_button_item['U_THANK_TOPIC']) ? $thanks_button_item['U_THANK_TOPIC'] : ''; ?>"><img src="<?php echo isset($thanks_button_item['THANK_IMG']) ? $thanks_button_item['THANK_IMG'] : ''; ?>" border="0" alt="<?php echo isset($thanks_button_item['L_THANK_TOPIC']) ? $thanks_button_item['L_THANK_TOPIC'] : ''; ?>" align="middle" /></a><!-- TOPIC BUTTON (THANK POST) -->
<?php

} // END thanks_button

if(isset($thanks_button_item)) { unset($thanks_button_item); } 

?>
</span>
</td>
<td style="width: 100%; text-align: left;">
&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"> <?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
<?php if ($this->vars['PARENT_FORUM']) {  ?> -> 
<a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><i class="fa-solid fa-arrow-right fa-lg"></i> <?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a> 
<?php } ?> 
<a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><i class="fa-solid fa-arrow-right fa-lg"></i> <?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a>
</td>
</tr>
<tr> 
</td>
</tr> 
</table>
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>

<table class="forumline rounded-corners" width="100%" cellspacing="1" cellpadding="3" border="0">
<tr>
<td class="catHead" colspan="2">
<span style="float: left;"><a href="<?php echo isset($this->vars['U_VIEW_OLDER_TOPIC']) ? $this->vars['U_VIEW_OLDER_TOPIC'] : $this->lang('U_VIEW_OLDER_TOPIC'); ?>"><i class="fa-solid fa-arrow-left fa-lg"></i> <?php echo isset($this->vars['L_VIEW_PREVIOUS_TOPIC']) ? $this->vars['L_VIEW_PREVIOUS_TOPIC'] : $this->lang('L_VIEW_PREVIOUS_TOPIC'); ?></a></span>
<span style="float: right;"><a href="<?php echo isset($this->vars['U_VIEW_NEWER_TOPIC']) ? $this->vars['U_VIEW_NEWER_TOPIC'] : $this->lang('U_VIEW_NEWER_TOPIC'); ?>"><?php echo isset($this->vars['L_VIEW_NEXT_TOPIC']) ? $this->vars['L_VIEW_NEXT_TOPIC'] : $this->lang('L_VIEW_NEXT_TOPIC'); ?> <i class="fa-solid fa-arrow-right fa-lg"></i></a></span>
</td>
</tr>
<?php echo isset($this->vars['POLL_DISPLAY']) ? $this->vars['POLL_DISPLAY'] : $this->lang('POLL_DISPLAY'); ?> 
<tr>
<?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?>
<td align="middle" class="catHead" width="13%"><strong><a name="<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>"><?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?></a></strong></td>
<td class="catHead" style="width: 100%" align="right">
<a name="<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>0"></a><?php echo isset($postrow_item['QUOTE_IMG']) ? $postrow_item['QUOTE_IMG'] : ''; ?> 
<?php echo isset($postrow_item['EDIT_IMG']) ? $postrow_item['EDIT_IMG'] : ''; ?> <?php echo isset($postrow_item['DELETE_IMG']) ? $postrow_item['DELETE_IMG'] : ''; ?> <?php echo isset($postrow_item['IP_IMG']) ? $postrow_item['IP_IMG'] : ''; ?> <?php echo isset($postrow_item['REPORT_IMG']) ? $postrow_item['REPORT_IMG'] : ''; ?></td>
</tr>
<tr> 
<td width="150" align="center" valign="top" class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>">
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
<?php echo isset($postrow_item['POSTER_AVATAR']) ? $postrow_item['POSTER_AVATAR'] : ''; ?>
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
<?php echo isset($postrow_item['USER_RANK_01_IMG']) ? $postrow_item['USER_RANK_01_IMG'] : ''; ?>
<?php echo isset($postrow_item['USER_RANK_02_IMG']) ? $postrow_item['USER_RANK_02_IMG'] : ''; ?>
<?php echo isset($postrow_item['USER_RANK_03_IMG']) ? $postrow_item['USER_RANK_03_IMG'] : ''; ?>
<?php echo isset($postrow_item['USER_RANK_04_IMG']) ? $postrow_item['USER_RANK_04_IMG'] : ''; ?>
<?php echo isset($postrow_item['USER_RANK_05_IMG']) ? $postrow_item['USER_RANK_05_IMG'] : ''; ?>
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
Joined <?php echo isset($postrow_item['POSTER_JOINED']) ? $postrow_item['POSTER_JOINED'] : ''; ?>
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
<?php echo isset($postrow_item['REPUTATION']) ? $postrow_item['REPUTATION'] : ''; ?>
<!-- BEGIN xdata -->
<div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
<?php echo isset($postrow_item['POSTER_ONLINE_STATUS_IMG']) ? $postrow_item['POSTER_ONLINE_STATUS_IMG'] : ''; ?>
</td>
<td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" height="100%" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="100%" valign="top"><span class="postbody">
<td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" style="padding: 8px; vertical-align: top">
<?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?></br>
<a href="<?php echo isset($postrow_item['U_MINI_POST']) ? $postrow_item['U_MINI_POST'] : ''; ?>"><i class="bi bi-file-text"></i></a> by <?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?> <i class="bi bi-caret-right"></i> <?php echo isset($postrow_item['POST_DATE']) ? $postrow_item['POST_DATE'] : ''; ?></br></br>
<span class="postbody"><?php echo isset($postrow_item['MESSAGE']) ? $postrow_item['MESSAGE'] : ''; ?></span></br>
<?php echo isset($postrow_item['ATTACHMENTS']) ? $postrow_item['ATTACHMENTS'] : ''; ?></br>
<span class="postbody"><?php echo isset($postrow_item['SIGNATURE']) ? $postrow_item['SIGNATURE'] : ''; ?></span></br>
</td>
<!-- Start add - Bottom aligned signature MOD -->
</tr> 
</table>

</td>
</tr>
<tr> 
<td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" width="150" align="center" valign="middle"><a href="#top"><?php echo isset($this->vars['L_BACK_TO_TOP']) ? $this->vars['L_BACK_TO_TOP'] : $this->lang('L_BACK_TO_TOP'); ?></a></td>
<td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" width="18">
<tr> 
<td valign="middle" nowrap="nowrap">
<?php echo isset($postrow_item['PROFILE_IMG']) ? $postrow_item['PROFILE_IMG'] : ''; ?> <?php echo isset($postrow_item['PM_IMG']) ? $postrow_item['PM_IMG'] : ''; ?> <?php echo isset($postrow_item['EMAIL_IMG']) ? $postrow_item['EMAIL_IMG'] : ''; ?> <?php echo isset($postrow_item['WWW_IMG']) ? $postrow_item['WWW_IMG'] : ''; ?> <?php echo isset($postrow_item['FACEBOOK_IMG']) ? $postrow_item['FACEBOOK_IMG'] : ''; ?></td>
</tr>
</table>

</td>
</tr>
<?php

$switch_spacer_count = ( isset($postrow_item['switch_spacer.']) ) ? sizeof($postrow_item['switch_spacer.']) : 0;
for ($switch_spacer_i = 0; $switch_spacer_i < $switch_spacer_count; $switch_spacer_i++)
{
 $switch_spacer_item = &$postrow_item['switch_spacer.'][$switch_spacer_i];
 $switch_spacer_item['S_ROW_COUNT'] = $switch_spacer_i;
 $switch_spacer_item['S_NUM_ROWS'] = $switch_spacer_count;

?>
<tr> 

<td colspan="2">
<div style="padding-top:1px; padding-bottom:1px; text-align: center; background-color :transparent;"></div>
</td>

</tr>
<?php

} // END switch_spacer

if(isset($switch_spacer_item)) { unset($switch_spacer_item); } 

?>
<?php

$move_message_count = ( isset($postrow_item['move_message.']) ) ? sizeof($postrow_item['move_message.']) : 0;
for ($move_message_i = 0; $move_message_i < $move_message_count; $move_message_i++)
{
 $move_message_item = &$postrow_item['move_message.'][$move_message_i];
 $move_message_item['S_ROW_COUNT'] = $move_message_i;
 $move_message_item['S_NUM_ROWS'] = $move_message_count;

?>
<tr>
<td class="row3" colspan="2"><span class="postdetails"><?php echo isset($move_message_item['MOVE_MESSAGE']) ? $move_message_item['MOVE_MESSAGE'] : ''; ?></span></td>
</tr>
<?php

} // END move_message

if(isset($move_message_item)) { unset($move_message_item); } 

?>
<?php

$thanks_count = ( isset($postrow_item['thanks.']) ) ? sizeof($postrow_item['thanks.']) : 0;
for ($thanks_i = 0; $thanks_i < $thanks_count; $thanks_i++)
{
 $thanks_item = &$postrow_item['thanks.'][$thanks_i];
 $thanks_item['S_ROW_COUNT'] = $thanks_i;
 $thanks_item['S_NUM_ROWS'] = $thanks_count;

?>
<tr>
<td colspan="2" class="row2">
<div style="padding-top:1px; padding-bottom:1px; text-align: center; background-color :transparent;"></div>

<table cellspacing="1" cellpadding="3" border="0" width="100%">
<tr>
<th class="thLeft"><?php echo isset($thanks_item['THANKFUL']) ? $thanks_item['THANKFUL'] : ''; ?></th>
</tr>
<tr>
<td class="row2" valign="top" align="left">
<span id="hide_thank" style="display: block;" class="medium"><a href="javascript:void(0);" onclick="postThank('show')"><?php echo isset($thanks_item['THANKS_TOTAL']) ? $thanks_item['THANKS_TOTAL'] : ''; ?></a> <?php echo isset($thanks_item['THANKED']) ? $thanks_item['THANKED'] : ''; ?></span>
<span id="show_thank" style="display: none;" class="medium"><?php echo isset($thanks_item['THANKS']) ? $thanks_item['THANKS'] : ''; ?><br /><br /><div align="right"><a href="javascript:void(0);" onclick="postThank('hide')">[ <?php echo isset($thanks_item['HIDE']) ? $thanks_item['HIDE'] : ''; ?> ]</a></div></span>
</td>	
</tr>
</table>
<div style="padding-top:1px; padding-bottom:1px; text-align: center; background-color :transparent;"></div>
</td>
</tr>
<?php

} // END thanks

if(isset($thanks_item)) { unset($thanks_item); } 

?>
<!-- START Inline Banner Ad -->
<?php

$switch_ad_count = ( isset($postrow_item['switch_ad.']) ) ? sizeof($postrow_item['switch_ad.']) : 0;
for ($switch_ad_i = 0; $switch_ad_i < $switch_ad_count; $switch_ad_i++)
{
 $switch_ad_item = &$postrow_item['switch_ad.'][$switch_ad_i];
 $switch_ad_item['S_ROW_COUNT'] = $switch_ad_i;
 $switch_ad_item['S_NUM_ROWS'] = $switch_ad_count;

?>
<tr>
  <td width="150" align="left" valign="top" class="row3"><span class="name"><strong><?php echo isset($postrow_item['L_SPONSOR']) ? $postrow_item['L_SPONSOR'] : ''; ?></strong></span><br /></td>
  <td class="row1" height="28" valign="top">
    <?php echo isset($postrow_item['INLINE_AD']) ? $postrow_item['INLINE_AD'] : ''; ?>
  </td>
</tr>
<tr>
  <td colspan="2" height="1">
  <div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
  </td>
</tr>
<?php

} // END switch_ad

if(isset($switch_ad_item)) { unset($switch_ad_item); } 

?>
<?php

$switch_ad_style2_count = ( isset($postrow_item['switch_ad_style2.']) ) ? sizeof($postrow_item['switch_ad_style2.']) : 0;
for ($switch_ad_style2_i = 0; $switch_ad_style2_i < $switch_ad_style2_count; $switch_ad_style2_i++)
{
 $switch_ad_style2_item = &$postrow_item['switch_ad_style2.'][$switch_ad_style2_i];
 $switch_ad_style2_item['S_ROW_COUNT'] = $switch_ad_style2_i;
 $switch_ad_style2_item['S_NUM_ROWS'] = $switch_ad_style2_count;

?>
<tr>
  <td colspan="2" class="row3">
    <?php echo isset($postrow_item['INLINE_AD']) ? $postrow_item['INLINE_AD'] : ''; ?>
  </td>
</tr>
<?php

} // END switch_ad_style2

if(isset($switch_ad_style2_item)) { unset($switch_ad_style2_item); } 

?>
<!-- END Inline Banner Ad -->    
<?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?>
    <tr align="center"> 
        <td class="catBottom" colspan="2" height="28"><table cellspacing="0" cellpadding="0" border="0">
            <tr><td align="center"><form method="post" action="<?php echo isset($this->vars['S_POST_DAYS_ACTION']) ? $this->vars['S_POST_DAYS_ACTION'] : $this->lang('S_POST_DAYS_ACTION'); ?>"><span class="gensmall"><?php echo isset($this->vars['L_DISPLAY_POSTS']) ? $this->vars['L_DISPLAY_POSTS'] : $this->lang('L_DISPLAY_POSTS'); ?>: <?php echo isset($this->vars['S_SELECT_POST_DAYS']) ? $this->vars['S_SELECT_POST_DAYS'] : $this->lang('S_SELECT_POST_DAYS'); ?><?php echo isset($this->vars['S_SELECT_POST_ORDER']) ? $this->vars['S_SELECT_POST_ORDER'] : $this->lang('S_SELECT_POST_ORDER'); ?><input type="submit" value="<?php echo isset($this->vars['L_GO']) ? $this->vars['L_GO'] : $this->lang('L_GO'); ?>" class="liteoption" name="submit" /></span></form></td></tr>
        </table></td>
    </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left" valign="middle" nowrap="nowrap">
      <span class="nav">
        <a href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['POST_IMG']) ? $this->vars['POST_IMG'] : $this->lang('POST_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>" align="middle" /></a>
        <a href="<?php echo isset($this->vars['U_POST_REPLY_TOPIC']) ? $this->vars['U_POST_REPLY_TOPIC'] : $this->lang('U_POST_REPLY_TOPIC'); ?>"><img src="<?php echo isset($this->vars['REPLY_IMG']) ? $this->vars['REPLY_IMG'] : $this->lang('REPLY_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_REPLY_TOPIC']) ? $this->vars['L_POST_REPLY_TOPIC'] : $this->lang('L_POST_REPLY_TOPIC'); ?>" align="middle" /></a>
        
        <?php

$switch_quick_reply_count = ( isset($this->_tpldata['switch_quick_reply.']) ) ?  sizeof($this->_tpldata['switch_quick_reply.']) : 0;
for ($switch_quick_reply_i = 0; $switch_quick_reply_i < $switch_quick_reply_count; $switch_quick_reply_i++)
{
 $switch_quick_reply_item = &$this->_tpldata['switch_quick_reply.'][$switch_quick_reply_i];
 $switch_quick_reply_item['S_ROW_COUNT'] = $switch_quick_reply_i;
 $switch_quick_reply_item['S_NUM_ROWS'] = $switch_quick_reply_count;

?>
        <a href="<?php echo isset($this->vars['U_POST_SQR_TOPIC']) ? $this->vars['U_POST_SQR_TOPIC'] : $this->lang('U_POST_SQR_TOPIC'); ?>"><img src="<?php echo isset($this->vars['SQR_IMG']) ? $this->vars['SQR_IMG'] : $this->lang('SQR_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_SQR_TOPIC']) ? $this->vars['L_POST_SQR_TOPIC'] : $this->lang('L_POST_SQR_TOPIC'); ?>" align="middle" /></a>
        <?php

} // END switch_quick_reply

if(isset($switch_quick_reply_item)) { unset($switch_quick_reply_item); } 

?>
        <a target="_blank" href="<?php echo isset($this->vars['U_PRINTER_TOPIC']) ? $this->vars['U_PRINTER_TOPIC'] : $this->lang('U_PRINTER_TOPIC'); ?>"><img src="<?php echo isset($this->vars['PRINTER_IMG']) ? $this->vars['PRINTER_IMG'] : $this->lang('PRINTER_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_PRINTER_TOPIC']) ? $this->vars['L_PRINTER_TOPIC'] : $this->lang('L_PRINTER_TOPIC'); ?>" align="middle" /></a>
        <!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
        <a href="<?php echo isset($this->vars['U_WHOVIEW_TOPIC']) ? $this->vars['U_WHOVIEW_TOPIC'] : $this->lang('U_WHOVIEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['WHOVIEW_IMG']) ? $this->vars['WHOVIEW_IMG'] : $this->lang('WHOVIEW_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_WHOVIEW_ALT']) ? $this->vars['L_WHOVIEW_ALT'] : $this->lang('L_WHOVIEW_ALT'); ?>" align="middle" /></a>
        <!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
        <?php

$thanks_button_count = ( isset($this->_tpldata['thanks_button.']) ) ?  sizeof($this->_tpldata['thanks_button.']) : 0;
for ($thanks_button_i = 0; $thanks_button_i < $thanks_button_count; $thanks_button_i++)
{
 $thanks_button_item = &$this->_tpldata['thanks_button.'][$thanks_button_i];
 $thanks_button_item['S_ROW_COUNT'] = $thanks_button_i;
 $thanks_button_item['S_NUM_ROWS'] = $thanks_button_count;

?>
        <a href="<?php echo isset($thanks_button_item['U_THANK_TOPIC']) ? $thanks_button_item['U_THANK_TOPIC'] : ''; ?>"><img src="<?php echo isset($thanks_button_item['THANK_IMG']) ? $thanks_button_item['THANK_IMG'] : ''; ?>" border="0" alt="<?php echo isset($thanks_button_item['L_THANK_TOPIC']) ? $thanks_button_item['L_THANK_TOPIC'] : ''; ?>" align="middle" /></a>
        <?php

} // END thanks_button

if(isset($thanks_button_item)) { unset($thanks_button_item); } 

?>
         <td style="width: 100%; text-align: left;">&nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
         <?php if ($this->vars['PARENT_FORUM']) {  ?> 
         <i class="fa-solid fa-arrow-right fa-lg"></i> 
         <a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a>
         <?php } ?> 
         <a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><i class="fa-solid fa-arrow-right fa-lg"></i> 
         <?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></td></td>
      </span>
<br/>
    </td>
    
    <td align="right" valign="top" nowrap="nowrap"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?><br /><br /><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td>
  </tr>
  <tr>
    <td align="left" colspan="3"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></td>
  </tr>
</table>

<?php

$switch_quick_reply_count = ( isset($this->_tpldata['switch_quick_reply.']) ) ?  sizeof($this->_tpldata['switch_quick_reply.']) : 0;
for ($switch_quick_reply_i = 0; $switch_quick_reply_i < $switch_quick_reply_count; $switch_quick_reply_i++)
{
 $switch_quick_reply_item = &$this->_tpldata['switch_quick_reply.'][$switch_quick_reply_i];
 $switch_quick_reply_item['S_ROW_COUNT'] = $switch_quick_reply_i;
 $switch_quick_reply_item['S_NUM_ROWS'] = $switch_quick_reply_count;

?>
    <?php echo isset($this->vars['QRBODY']) ? $this->vars['QRBODY'] : $this->lang('QRBODY'); ?>
<?php

} // END switch_quick_reply

if(isset($switch_quick_reply_item)) { unset($switch_quick_reply_item); } 

?>
<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td width="40%" valign="top" nowrap="nowrap" align="left"><?php echo isset($this->vars['S_WATCH_TOPIC']) ? $this->vars['S_WATCH_TOPIC'] : $this->lang('S_WATCH_TOPIC'); ?><br /><?php echo isset($this->vars['S_EMAIL_TOPIC']) ? $this->vars['S_EMAIL_TOPIC'] : $this->lang('S_EMAIL_TOPIC'); ?><br />
      &nbsp;<br />
      <?php echo isset($this->vars['S_TOPIC_ADMIN']) ? $this->vars['S_TOPIC_ADMIN'] : $this->lang('S_TOPIC_ADMIN'); ?></td>
    <td align="right" valign="top" nowrap="nowrap"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?>
    <div style="padding-top:6px; padding-bottom:6px; text-align: center; background-color :transparent;"></div>
    <?php echo isset($this->vars['S_AUTH_LIST']) ? $this->vars['S_AUTH_LIST'] : $this->lang('S_AUTH_LIST'); ?></td>
  </tr>
</table>

<?php echo isset($this->vars['RELATED_TOPICS']) ? $this->vars['RELATED_TOPICS'] : $this->lang('RELATED_TOPICS'); ?>