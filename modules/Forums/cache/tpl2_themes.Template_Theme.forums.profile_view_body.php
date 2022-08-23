<?php

// eXtreme Styles mod cache. Generated on Fri, 23 Apr 2021 14:55:13 +0000 (time=1619189713)

?><table style="width: 100%" cellpadding="4" cellspacing="1" border="1" class="forumline">
  <tr>
    <td class="catHead" style="height: 30px; text-align: center;" colspan="5"><span style="font-weight:bold;"><?php echo isset($this->vars['L_VIEWING_PROFILE']) ? $this->vars['L_VIEWING_PROFILE'] : $this->lang('L_VIEWING_PROFILE'); ?></span></td>
  </tr>
  <tr>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Profile&mode=editprofile">Change my Info</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Your_Account&amp;op=edithome">Change Home</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Private_Messages">Messages</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Your_Account&amp;op=chgtheme">Change Theme</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Your_Account&amp;op=logout">Logout</a></td>
  </tr>
  <?php if ($this->vars['USER_RANK_01']) {  ?>
  <tr>
    <td class="catHead" style="letter-spacing: 1px; text-align: center; height:10px;" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td class="row1" style="text-align: center"><?php echo isset($this->vars['USER_RANK_01_IMG']) ? $this->vars['USER_RANK_01_IMG'] : $this->lang('USER_RANK_01_IMG'); ?><?php echo isset($this->vars['USER_RANK_01']) ? $this->vars['USER_RANK_01'] : $this->lang('USER_RANK_01'); ?></td>
    <td class="row1" style="text-align: center"><?php echo isset($this->vars['USER_RANK_02_IMG']) ? $this->vars['USER_RANK_02_IMG'] : $this->lang('USER_RANK_02_IMG'); ?><?php echo isset($this->vars['USER_RANK_02']) ? $this->vars['USER_RANK_02'] : $this->lang('USER_RANK_02'); ?></td>
    <td class="row1" style="text-align: center"><?php echo isset($this->vars['USER_RANK_03_IMG']) ? $this->vars['USER_RANK_03_IMG'] : $this->lang('USER_RANK_03_IMG'); ?><?php echo isset($this->vars['USER_RANK_03']) ? $this->vars['USER_RANK_03'] : $this->lang('USER_RANK_03'); ?></td>
    <td class="row1" style="text-align: center"><?php echo isset($this->vars['USER_RANK_04_IMG']) ? $this->vars['USER_RANK_04_IMG'] : $this->lang('USER_RANK_04_IMG'); ?><?php echo isset($this->vars['USER_RANK_04']) ? $this->vars['USER_RANK_04'] : $this->lang('USER_RANK_04'); ?></td>
    <td class="row1" style="text-align: center"><?php echo isset($this->vars['USER_RANK_05_IMG']) ? $this->vars['USER_RANK_05_IMG'] : $this->lang('USER_RANK_05_IMG'); ?><?php echo isset($this->vars['USER_RANK_05']) ? $this->vars['USER_RANK_05'] : $this->lang('USER_RANK_05'); ?></td>
  </tr>
  <?php } ?>

  <tr>
    <td class="catHead" style="letter-spacing: 1px; text-align: center; height:10px;" colspan="5">&nbsp;</td>
  </tr>

  <tr>
    <td class="row1" colspan="5" valign="top">
      <table style="width: 100%" cellpadding="1" cellspacing="1" border="1">
       <tr>
         <td style="width: 50%" valign="top">
           <table style="width: 100%" cellpadding="4" cellspacing="1" border="1" class="forumline">
             <tr>
               <td class="center catHead textbold" colspan="2"><?php echo isset($this->vars['L_AVATAR']) ? $this->vars['L_AVATAR'] : $this->lang('L_AVATAR'); ?></td>
             </tr>
             <tr>
               <td class="center row1" colspan="2"><?php echo isset($this->vars['AVATAR_IMG']) ? $this->vars['AVATAR_IMG'] : $this->lang('AVATAR_IMG'); ?></td>
             </tr>
             <tr>
               <td class="catHead textbold" colspan="2"><?php echo isset($this->vars['L_FORUM_INFO']) ? $this->vars['L_FORUM_INFO'] : $this->lang('L_FORUM_INFO'); ?></td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_JOINED']) ? $this->vars['L_JOINED'] : $this->lang('L_JOINED'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['JOINED']) ? $this->vars['JOINED'] : $this->lang('JOINED'); ?></td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_USER_LAST_VISIT']) ? $this->vars['L_USER_LAST_VISIT'] : $this->lang('L_USER_LAST_VISIT'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['USER_LAST_VISIT']) ? $this->vars['USER_LAST_VISIT'] : $this->lang('USER_LAST_VISIT'); ?></td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_TOTAL_POSTS']) ? $this->vars['L_TOTAL_POSTS'] : $this->lang('L_TOTAL_POSTS'); ?></td>
               <td class="row1" style="width: 70%"><a href="<?php echo isset($this->vars['U_SEARCH_USER']) ? $this->vars['U_SEARCH_USER'] : $this->lang('U_SEARCH_USER'); ?>"><?php echo isset($this->vars['POSTS']) ? $this->vars['POSTS'] : $this->lang('POSTS'); ?></a> (<?php echo isset($this->vars['POST_DAY_STATS']) ? $this->vars['POST_DAY_STATS'] : $this->lang('POST_DAY_STATS'); ?> | <?php echo isset($this->vars['POST_PERCENT_STATS']) ? $this->vars['POST_PERCENT_STATS'] : $this->lang('POST_PERCENT_STATS'); ?>)</td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_REPUTATION']) ? $this->vars['L_REPUTATION'] : $this->lang('L_REPUTATION'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['REPUTATION']) ? $this->vars['REPUTATION'] : $this->lang('REPUTATION'); ?></td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_ONLINE_STATUS']) ? $this->vars['L_ONLINE_STATUS'] : $this->lang('L_ONLINE_STATUS'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['ONLINE_STATUS']) ? $this->vars['ONLINE_STATUS'] : $this->lang('ONLINE_STATUS'); ?></td>
             </tr>

             <tr>
               <td class="catHead textbold" colspan="2"><?php echo isset($this->vars['L_CONTACT_DETAILS']) ? $this->vars['L_CONTACT_DETAILS'] : $this->lang('L_CONTACT_DETAILS'); ?></td>
             </tr>
             <?php if ($this->vars['WWW']) {  ?>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_WEBSITE']) ? $this->vars['L_WEBSITE'] : $this->lang('L_WEBSITE'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['WWW']) ? $this->vars['WWW'] : $this->lang('WWW'); ?></td>
             </tr>
             <?php } ?>
             <?php if ($this->vars['EMAIL']) {  ?>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_EMAIL_ADDRESS']) ? $this->vars['L_EMAIL_ADDRESS'] : $this->lang('L_EMAIL_ADDRESS'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['EMAIL']) ? $this->vars['EMAIL'] : $this->lang('EMAIL'); ?></td>
             </tr>
             <?php } ?>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_PM']) ? $this->vars['L_PM'] : $this->lang('L_PM'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['PM']) ? $this->vars['PM'] : $this->lang('PM'); ?></td>
             </tr>
           </table>
         </td>
         <td style="width: 50%" valign="top">
           <table style="width: 100%" cellpadding="4" cellspacing="1" border="1" class="forumline">
             <tr>
               <td class="catHead textbold" colspan="2""><?php echo isset($this->vars['L_ADDITIONAL_INFO']) ? $this->vars['L_ADDITIONAL_INFO'] : $this->lang('L_ADDITIONAL_INFO'); ?></td>
             </tr>
             <?php

$switch_admin_notes_count = ( isset($this->_tpldata['switch_admin_notes.']) ) ?  sizeof($this->_tpldata['switch_admin_notes.']) : 0;
for ($switch_admin_notes_i = 0; $switch_admin_notes_i < $switch_admin_notes_count; $switch_admin_notes_i++)
{
 $switch_admin_notes_item = &$this->_tpldata['switch_admin_notes.'][$switch_admin_notes_i];
 $switch_admin_notes_item['S_ROW_COUNT'] = $switch_admin_notes_i;
 $switch_admin_notes_item['S_NUM_ROWS'] = $switch_admin_notes_count;

?>
             <?php if ($this->vars['ADMIN_NOTES']) {  ?>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_ADMIN_NOTES']) ? $this->vars['L_ADMIN_NOTES'] : $this->lang('L_ADMIN_NOTES'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['ADMIN_NOTES']) ? $this->vars['ADMIN_NOTES'] : $this->lang('ADMIN_NOTES'); ?></td>
             </tr>
             <?php } ?>
             <?php

} // END switch_admin_notes

if(isset($switch_admin_notes_item)) { unset($switch_admin_notes_item); } 

?>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_LOCATION']) ? $this->vars['L_LOCATION'] : $this->lang('L_LOCATION'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['LOCATION']) ? $this->vars['LOCATION'] : $this->lang('LOCATION'); ?></td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%"><?php echo isset($this->vars['L_GENDER']) ? $this->vars['L_GENDER'] : $this->lang('L_GENDER'); ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($this->vars['GENDER']) ? $this->vars['GENDER'] : $this->lang('GENDER'); ?></td>
             </tr>
             <?php

$xdata_count = ( isset($this->_tpldata['xdata.']) ) ?  sizeof($this->_tpldata['xdata.']) : 0;
for ($xdata_i = 0; $xdata_i < $xdata_count; $xdata_i++)
{
 $xdata_item = &$this->_tpldata['xdata.'][$xdata_i];
 $xdata_item['S_ROW_COUNT'] = $xdata_i;
 $xdata_item['S_NUM_ROWS'] = $xdata_count;

?>
             <tr>
               <td class="row1" style="width: 30%" nowrap="nowrap"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></td>
               <td class="row1" style="width: 70%"><?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?></td>
             </tr>
             <?php

} // END xdata

if(isset($xdata_item)) { unset($xdata_item); } 

?> 

			 <?php if ($this->vars['USER_SIG']) {  ?>
             <tr>
               <td class="catHead textbold" colspan="2"><?php echo isset($this->vars['L_USERS_SIGNATURE']) ? $this->vars['L_USERS_SIGNATURE'] : $this->lang('L_USERS_SIGNATURE'); ?></td>
             </tr>
             <tr>
               <td class="row1" colspan="2"><?php echo isset($this->vars['USER_SIG']) ? $this->vars['USER_SIG'] : $this->lang('USER_SIG'); ?></td>
             </tr>
             <?php } ?>

            <?php

$user_extra_count = ( isset($this->_tpldata['user_extra.']) ) ?  sizeof($this->_tpldata['user_extra.']) : 0;
for ($user_extra_i = 0; $user_extra_i < $user_extra_count; $user_extra_i++)
{
 $user_extra_item = &$this->_tpldata['user_extra.'][$user_extra_i];
 $user_extra_item['S_ROW_COUNT'] = $user_extra_i;
 $user_extra_item['S_NUM_ROWS'] = $user_extra_count;

?>
             <tr>
              <td class="catHead textbold" colspan="2"><?php echo isset($this->vars['L_EXTRA_INFO']) ? $this->vars['L_EXTRA_INFO'] : $this->lang('L_EXTRA_INFO'); ?></td>
            </tr>
            <tr>
              <td class="row1" colspan="2"><?php echo isset($this->vars['EXTRA_INFO']) ? $this->vars['EXTRA_INFO'] : $this->lang('EXTRA_INFO'); ?></td>
            </tr>
            <?php

} // END user_extra

if(isset($user_extra_item)) { unset($user_extra_item); } 

?>


			<?php

$switch_user_admin_count = ( isset($this->_tpldata['switch_user_admin.']) ) ?  sizeof($this->_tpldata['switch_user_admin.']) : 0;
for ($switch_user_admin_i = 0; $switch_user_admin_i < $switch_user_admin_count; $switch_user_admin_i++)
{
 $switch_user_admin_item = &$this->_tpldata['switch_user_admin.'][$switch_user_admin_i];
 $switch_user_admin_item['S_ROW_COUNT'] = $switch_user_admin_i;
 $switch_user_admin_item['S_NUM_ROWS'] = $switch_user_admin_count;

?>
             <tr>
              <td class="catHead textbold" colspan="2"><?php echo isset($this->vars['L_USER_ADMIN_FOR']) ? $this->vars['L_USER_ADMIN_FOR'] : $this->lang('L_USER_ADMIN_FOR'); ?></td>
            </tr>
            <tr>
              <td class="row1" colspan="2"><?php echo isset($this->vars['EDIT_THIS_USER']) ? $this->vars['EDIT_THIS_USER'] : $this->lang('EDIT_THIS_USER'); ?></td>
            </tr>
            <tr>
              <td class="row1" colspan="2"><?php echo isset($this->vars['BAN_THIS_USER_IP']) ? $this->vars['BAN_THIS_USER_IP'] : $this->lang('BAN_THIS_USER_IP'); ?></td>
            </tr>
            <tr>
              <td class="row1" colspan="2"><?php echo isset($this->vars['SUSPEND_THIS_USER']) ? $this->vars['SUSPEND_THIS_USER'] : $this->lang('SUSPEND_THIS_USER'); ?></td>
            </tr>
            <tr>
              <td class="row1" colspan="2"><?php echo isset($this->vars['DELETE_THIS_USER']) ? $this->vars['DELETE_THIS_USER'] : $this->lang('DELETE_THIS_USER'); ?></td>
            </tr>
			<?php

} // END switch_user_admin

if(isset($switch_user_admin_item)) { unset($switch_user_admin_item); } 

?>
           </table>
         </td>
       </tr>
      </table>
    </td>
  </tr>
</table>
<br />