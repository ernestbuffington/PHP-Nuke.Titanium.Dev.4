<?php

// eXtreme Styles mod cache. Generated on Sun, 02 Oct 2022 22:01:09 +0000 (time=1664748069)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<!--MOD GLANCE BEGIN --><?php echo isset($this->vars['GLANCE_OUTPUT']) ? $this->vars['GLANCE_OUTPUT'] : $this->lang('GLANCE_OUTPUT'); ?><!-- MOD GLANCE END -->

<!-- PAGINATION START -->
<table style="width: 100%;" cellspacing="2" cellpadding="2" border="0">

  <tr> 

    <td style="text-align: left; vertical-align: bottom" colspan="2"><a class="maintitle" href="<?php echo isset($this->vars['U_VIEW_TOPIC']) ? $this->vars['U_VIEW_TOPIC'] : $this->lang('U_VIEW_TOPIC'); ?>"><?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?></a></strong><br /><br /><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?>

  </tr> 


</table>
<!-- PAGINATION END -->

<!-- TOP BUTTONS START -->
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
    <td style="width: 100%; text-align: left;">&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a><?php if ($this->vars['PARENT_FORUM']) {  ?> <i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;"></i> <a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a><?php } ?> <i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;"></i> <a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></td>
  </tr>
    <tr> 
    </td>
  <td>&nbsp;
  </td>
  </tr> 

</table>
<!-- TOP BUTTONS END -->

<!-- VIEWTOPIC POST START -->

<table border="0" class="forumline" cellspacing="1" cellpadding="3" style="width: 100%;">
  <!-- TOPIC PAGINATION START --> 
  <tr style="text-align:right;">
    <td class="catHead" colspan="2">
       <span style="float: left;">&larr; <a href="<?php echo isset($this->vars['U_VIEW_OLDER_TOPIC']) ? $this->vars['U_VIEW_OLDER_TOPIC'] : $this->lang('U_VIEW_OLDER_TOPIC'); ?>"><?php echo isset($this->vars['L_VIEW_PREVIOUS_TOPIC']) ? $this->vars['L_VIEW_PREVIOUS_TOPIC'] : $this->lang('L_VIEW_PREVIOUS_TOPIC'); ?></a></span>
       <span style="float: right;"><a href="<?php echo isset($this->vars['U_VIEW_NEWER_TOPIC']) ? $this->vars['U_VIEW_NEWER_TOPIC'] : $this->lang('U_VIEW_NEWER_TOPIC'); ?>"><?php echo isset($this->vars['L_VIEW_NEXT_TOPIC']) ? $this->vars['L_VIEW_NEXT_TOPIC'] : $this->lang('L_VIEW_NEXT_TOPIC'); ?></a> &rarr;</span>
    </td>
  </tr>
  <!-- TOPIC PAGINATION END -->
  <!-- POLL DISPLAY START -->
  <?php echo isset($this->vars['POLL_DISPLAY']) ? $this->vars['POLL_DISPLAY'] : $this->lang('POLL_DISPLAY'); ?>
  <!-- POLL DISPLAY END -->

  <?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?>
  <tr>
    <td class="catHead">
      <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
          <td><a href="<?php echo isset($postrow_item['U_MINI_POST']) ? $postrow_item['U_MINI_POST'] : ''; ?>"><i class="bi bi-info-square"></i>
</a><?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?> </td>
          <td style="text-align: right;"><i class="bi bi-alarm"></i>&nbsp;<?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?>:&nbsp;<?php echo isset($postrow_item['POST_DATE']) ? $postrow_item['POST_DATE'] : ''; ?>&nbsp;<?php echo isset($postrow_item['QUOTE_IMG']) ? $postrow_item['QUOTE_IMG'] : ''; ?> <?php echo isset($postrow_item['EDIT_IMG']) ? $postrow_item['EDIT_IMG'] : ''; ?> <?php echo isset($postrow_item['DELETE_IMG']) ? $postrow_item['DELETE_IMG'] : ''; ?> <?php echo isset($postrow_item['IP_IMG']) ? $postrow_item['IP_IMG'] : ''; ?> <?php echo isset($postrow_item['REPORT_IMG']) ? $postrow_item['REPORT_IMG'] : ''; ?></td>
        </tr>
      </table>
    </td>
    <td class="catHead" style="width: 200px" nowrap="nowrap"><a name="<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>"></a><?php echo isset($postrow_item['POSTER_FROM_FLAG']) ? $postrow_item['POSTER_FROM_FLAG'] : ''; ?><span class="viewtopic_username"><?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?></td>
  </tr>
  <tr>
  	<!-- POST MESSAGE START -->
  	<td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" style="vertical-align: top;">
      <table class="tfixed clear" border="0" cellspacing="1" cellpadding="3" style="width: 100%;">
        <tr>
          <td colspan="2" height="100%" valign="top">
            <span class="postbody"><?php echo isset($postrow_item['MESSAGE']) ? $postrow_item['MESSAGE'] : ''; ?></span>
            <?php echo isset($postrow_item['ATTACHMENTS']) ? $postrow_item['ATTACHMENTS'] : ''; ?>
            <span class="postbody"></span>
          </td>
        </tr> 
        <tr> 
          <td colspan="2">
            <span class="postbody"><?php echo isset($postrow_item['SIGNATURE']) ? $postrow_item['SIGNATURE'] : ''; ?></span>
            <?php if ($postrow_item['EDITED_MESSAGE']) {  ?>
            <div><br /><br /><i class="fa fa-pencil-square-o" aria-hidden="true" style="float: left;"></i><span style="float: left;">&nbsp;<?php echo isset($postrow_item['EDITED_MESSAGE']) ? $postrow_item['EDITED_MESSAGE'] : ''; ?></span></div>
            <?php } ?>
          </td>
        </tr>
      </table>
  	</td>
  	<!-- POST MESSAGE END -->
  	<!-- POSTER INFORMATION START -->
  	<td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" style="padding: 8px; text-align: center; vertical-align: top;">
      <p>
      <?php

$switch_showavatars_count = ( isset($postrow_item['switch_showavatars.']) ) ? sizeof($postrow_item['switch_showavatars.']) : 0;
for ($switch_showavatars_i = 0; $switch_showavatars_i < $switch_showavatars_count; $switch_showavatars_i++)
{
 $switch_showavatars_item = &$postrow_item['switch_showavatars.'][$switch_showavatars_i];
 $switch_showavatars_item['S_ROW_COUNT'] = $switch_showavatars_i;
 $switch_showavatars_item['S_NUM_ROWS'] = $switch_showavatars_count;

?><?php echo isset($postrow_item['POSTER_AVATAR']) ? $postrow_item['POSTER_AVATAR'] : ''; ?></p>
      <p><?php

} // END switch_showavatars

if(isset($switch_showavatars_item)) { unset($switch_showavatars_item); } 

?>
        <br />
        <?php echo isset($postrow_item['USER_RANK_01_IMG']) ? $postrow_item['USER_RANK_01_IMG'] : ''; ?>
        <?php echo isset($postrow_item['USER_RANK_02_IMG']) ? $postrow_item['USER_RANK_02_IMG'] : ''; ?>
        <?php echo isset($postrow_item['USER_RANK_03_IMG']) ? $postrow_item['USER_RANK_03_IMG'] : ''; ?>
        <?php echo isset($postrow_item['USER_RANK_04_IMG']) ? $postrow_item['USER_RANK_04_IMG'] : ''; ?>
        <?php echo isset($postrow_item['USER_RANK_05_IMG']) ? $postrow_item['USER_RANK_05_IMG'] : ''; ?> 
        <br />
        <?php if ($postrow_item['USER_RANK_01']) {  ?>
      </p>
      <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($this->vars['L_RANK_TITLE']) ? $this->vars['L_RANK_TITLE'] : $this->lang('L_RANK_TITLE'); ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['USER_RANK_01']) ? $postrow_item['USER_RANK_01'] : ''; ?></span>
      </div>
      <?php } ?>
      <?php if ($postrow_item['USER_RANK_02']) {  ?>
      <div style="height: 19px">
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['USER_RANK_02']) ? $postrow_item['USER_RANK_02'] : ''; ?></span>
      </div>
      <?php } ?>
      <?php if ($postrow_item['USER_RANK_03']) {  ?>
      <div style="height: 19px">
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['USER_RANK_03']) ? $postrow_item['USER_RANK_03'] : ''; ?></span>
      </div>
      <?php } ?>
      <?php if ($postrow_item['USER_RANK_04']) {  ?>
      <div style="height: 19px">
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['USER_RANK_04']) ? $postrow_item['USER_RANK_04'] : ''; ?></span>
      </div>
      <?php } ?>
      <?php if ($postrow_item['USER_RANK_05']) {  ?>
      <div style="height: 19px">
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['USER_RANK_05']) ? $postrow_item['USER_RANK_05'] : ''; ?></span>
      </div>
      <?php } ?>
      <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($this->vars['L_POST_COUNT']) ? $this->vars['L_POST_COUNT'] : $this->lang('L_POST_COUNT'); ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['POSTER_POSTS']) ? $postrow_item['POSTER_POSTS'] : ''; ?></span>
      </div>
      <?php if ($this->vars['REPUTATION']) {  ?>
      <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($this->vars['L_REPUTATION']) ? $this->vars['L_REPUTATION'] : $this->lang('L_REPUTATION'); ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['REPUTATION']) ? $postrow_item['REPUTATION'] : ''; ?></span>
      </div>
      <?php } ?>
      <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($this->vars['L_JOINED']) ? $this->vars['L_JOINED'] : $this->lang('L_JOINED'); ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['POSTER_JOINED']) ? $postrow_item['POSTER_JOINED'] : ''; ?></span>
      </div>
      <!-- <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($this->vars['L_LAST_ACTIVITY']) ? $this->vars['L_LAST_ACTIVITY'] : $this->lang('L_LAST_ACTIVITY'); ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['USER_LAST_VISIT']) ? $postrow_item['USER_LAST_VISIT'] : ''; ?></span>
      </div> -->
      <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($this->vars['L_STATUS']) ? $this->vars['L_STATUS'] : $this->lang('L_STATUS'); ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['POSTER_ONLINE_STATUS']) ? $postrow_item['POSTER_ONLINE_STATUS'] : ''; ?></span>
      </div>
      <?php if ($postrow_item['POSTER_GENDER']) {  ?>
      <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($this->vars['L_GENDER']) ? $this->vars['L_GENDER'] : $this->lang('L_GENDER'); ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($postrow_item['POSTER_GENDER']) ? $postrow_item['POSTER_GENDER'] : ''; ?></span>
      </div> 
      <?php } ?>

      <?php

$xdata_count = ( isset($postrow_item['xdata.']) ) ? sizeof($postrow_item['xdata.']) : 0;
for ($xdata_i = 0; $xdata_i < $xdata_count; $xdata_i++)
{
 $xdata_item = &$postrow_item['xdata.'][$xdata_i];
 $xdata_item['S_ROW_COUNT'] = $xdata_i;
 $xdata_item['S_NUM_ROWS'] = $xdata_count;

?>
      <div style="height: 19px">
        <span style="float: left; font-size: 12px;"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></span>
        <span style="float: right; font-size: 12px;"><?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?></span>
      </div>
      <?php

} // END xdata

if(isset($xdata_item)) { unset($xdata_item); } 

?>

  	</td>
  	<!-- POSTER INFORMATION END -->
  </tr>
  <tr>
    <td class="catBottom" colspan="2"><?php echo isset($postrow_item['PROFILE_IMG']) ? $postrow_item['PROFILE_IMG'] : ''; ?> <?php echo isset($postrow_item['PM_IMG']) ? $postrow_item['PM_IMG'] : ''; ?> <?php echo isset($postrow_item['EMAIL_IMG']) ? $postrow_item['EMAIL_IMG'] : ''; ?> <?php echo isset($postrow_item['WWW_IMG']) ? $postrow_item['WWW_IMG'] : ''; ?> <?php echo isset($postrow_item['FACEBOOK_IMG']) ? $postrow_item['FACEBOOK_IMG'] : ''; ?> <?php echo isset($postrow_item['SEARCH_IMG']) ? $postrow_item['SEARCH_IMG'] : ''; ?></td>
  </tr>
  <?php

$switch_spacer_count = ( isset($postrow_item['switch_spacer.']) ) ? sizeof($postrow_item['switch_spacer.']) : 0;
for ($switch_spacer_i = 0; $switch_spacer_i < $switch_spacer_count; $switch_spacer_i++)
{
 $switch_spacer_item = &$postrow_item['switch_spacer.'][$switch_spacer_i];
 $switch_spacer_item['S_ROW_COUNT'] = $switch_spacer_i;
 $switch_spacer_item['S_NUM_ROWS'] = $switch_spacer_count;

?>
  </table>
  <br />
  <table border="0" class="forumline" cellspacing="1" cellpadding="3" style="width: 100%;">
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
      <table class="forumline" cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <th class="thLeft"><?php echo isset($thanks_item['THANKFUL']) ? $thanks_item['THANKFUL'] : ''; ?></th>
        </tr>
        <tr>
          <td class="row2" valign="top" align="left">
            <span id="hide_thank" style="display: block;" class="gensmall"><a href="javascript:void(0);" onclick="postThank('show')"><?php echo isset($thanks_item['THANKS_TOTAL']) ? $thanks_item['THANKS_TOTAL'] : ''; ?></a> <?php echo isset($thanks_item['THANKED']) ? $thanks_item['THANKED'] : ''; ?></span>
            <span id="show_thank" style="display: none;" class="gensmall"><?php echo isset($thanks_item['THANKS']) ? $thanks_item['THANKS'] : ''; ?><br /><br /><div align="right"><a href="javascript:void(0);" onclick="postThank('hide')">[ <?php echo isset($thanks_item['HIDE']) ? $thanks_item['HIDE'] : ''; ?> ]</a></div></span>
          </td> 
        </tr>
      </table>
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
  <?php if ($postrow_item['INLINE_AD']) {  ?>
  <tr>
    <td class="inlinead row1" colspan="2" style="vertical-align: top;"><?php echo isset($postrow_item['INLINE_AD']) ? $postrow_item['INLINE_AD'] : ''; ?></td>    
  </tr>
  <tr>
    <td class="spaceRow" colspan="2" style="height: 10px;">&nbsp;</td>
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
    <td colspan="2" class="row3" style="text-align: center;">
      <?php echo isset($postrow_item['INLINE_AD']) ? $postrow_item['INLINE_AD'] : ''; ?>
    </td>
  </tr>
  <?php } ?>
  <?php

} // END switch_ad_style2

if(isset($switch_ad_style2_item)) { unset($switch_ad_style2_item); } 

?>
  <!-- END Inline Banner Ad --> 
  <?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?>
  <tr> 
    <td class="catBottom" colspan="2" height="28">
      <table cellspacing="0" cellpadding="0" border="0" style="float: right;">
        <tr>
          <td>
            <form method="post" action="<?php echo isset($this->vars['S_POST_DAYS_ACTION']) ? $this->vars['S_POST_DAYS_ACTION'] : $this->lang('S_POST_DAYS_ACTION'); ?>">
              <?php echo isset($this->vars['L_DISPLAY_POSTS']) ? $this->vars['L_DISPLAY_POSTS'] : $this->lang('L_DISPLAY_POSTS'); ?>: <?php echo isset($this->vars['S_SELECT_POST_DAYS']) ? $this->vars['S_SELECT_POST_DAYS'] : $this->lang('S_SELECT_POST_DAYS'); ?><?php echo isset($this->vars['S_SELECT_POST_ORDER']) ? $this->vars['S_SELECT_POST_ORDER'] : $this->lang('S_SELECT_POST_ORDER'); ?> <input type="submit" value="<?php echo isset($this->vars['L_GO']) ? $this->vars['L_GO'] : $this->lang('L_GO'); ?>" class="titaniumbutton" name="submit" />
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
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
         <td style="width: 100%; text-align: left;">&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a><?php if ($this->vars['PARENT_FORUM']) {  ?> <i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;"></i> <a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a><?php } ?> <i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;"></i> <a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></td>
      </span>
<br/>
    </td>
    
    <td align="right" valign="top" nowrap="nowrap"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?><br /><br /><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td>
  </tr>
  <tr>
    <td style="text-align: left;" colspan="2"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></td>
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
    <td style="width: 50%; vertical-align: top"><br/><?php echo isset($this->vars['S_WATCH_TOPIC']) ? $this->vars['S_WATCH_TOPIC'] : $this->lang('S_WATCH_TOPIC'); ?><br /><?php echo isset($this->vars['S_EMAIL_TOPIC']) ? $this->vars['S_EMAIL_TOPIC'] : $this->lang('S_EMAIL_TOPIC'); ?><br />&nbsp;<br /><?php echo isset($this->vars['S_TOPIC_ADMIN']) ? $this->vars['S_TOPIC_ADMIN'] : $this->lang('S_TOPIC_ADMIN'); ?></td>
    <td style="width: 50%; vertical-align: top; text-align: right;"><?php echo isset($this->vars['S_AUTH_LIST']) ? $this->vars['S_AUTH_LIST'] : $this->lang('S_AUTH_LIST'); ?></td>
  </tr>
</table>

<!-- VIEWTOPIC POST END -->
</tr>
</tbody>
</table>
</div>