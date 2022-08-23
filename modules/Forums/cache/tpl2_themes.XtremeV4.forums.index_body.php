<?php

// eXtreme Styles mod cache. Generated on Tue, 18 May 2021 19:44:26 +0000 (time=1621367066)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<!--MOD GLANCE BEGIN --><?php echo isset($this->vars['GLANCE_OUTPUT']) ? $this->vars['GLANCE_OUTPUT'] : $this->lang('GLANCE_OUTPUT'); ?><!-- MOD GLANCE END -->
<?php

$show_global_marquee_count = ( isset($this->_tpldata['show_global_marquee.']) ) ?  sizeof($this->_tpldata['show_global_marquee.']) : 0;
for ($show_global_marquee_i = 0; $show_global_marquee_i < $show_global_marquee_count; $show_global_marquee_i++)
{
 $show_global_marquee_item = &$this->_tpldata['show_global_marquee.'][$show_global_marquee_i];
 $show_global_marquee_item['S_ROW_COUNT'] = $show_global_marquee_i;
 $show_global_marquee_item['S_NUM_ROWS'] = $show_global_marquee_count;

?>
<table style="width: 100%;" cellpadding="3" cellspacing="1" border="0" class="forumline"> 
  <tr> 
     <td class="catHead"><span class="cattitle"><?php echo isset($this->vars['GLOBAL_TITLE']) ? $this->vars['GLOBAL_TITLE'] : $this->lang('GLOBAL_TITLE'); ?></span></td> 
  </tr> 
  <tr> 
     <td class="row1">
     	<div class="messages<?php

$enable_count = ( isset($show_global_marquee_item['enable.']) ) ? sizeof($show_global_marquee_item['enable.']) : 0;
for ($enable_i = 0; $enable_i < $enable_count; $enable_i++)
{
 $enable_item = &$show_global_marquee_item['enable.'][$enable_i];
 $enable_item['S_ROW_COUNT'] = $enable_i;
 $enable_item['S_NUM_ROWS'] = $enable_count;

?> imarquee<?php

} // END enable

if(isset($enable_item)) { unset($enable_item); } 

?><?php

$disable_count = ( isset($show_global_marquee_item['disable.']) ) ? sizeof($show_global_marquee_item['disable.']) : 0;
for ($disable_i = 0; $disable_i < $disable_count; $disable_i++)
{
 $disable_item = &$show_global_marquee_item['disable.'][$disable_i];
 $disable_item['S_ROW_COUNT'] = $disable_i;
 $disable_item['S_NUM_ROWS'] = $disable_count;

?> acenter<?php

} // END disable

if(isset($disable_item)) { unset($disable_item); } 

?>"><?php echo isset($this->vars['GLOBAL_ANNOUNCEMENT']) ? $this->vars['GLOBAL_ANNOUNCEMENT'] : $this->lang('GLOBAL_ANNOUNCEMENT'); ?></div>     	
     </td> 
  </tr> 
</table>
<br />
<?php

} // END show_global_marquee

if(isset($show_global_marquee_item)) { unset($show_global_marquee_item); } 

?>

<table style="width: 100%;" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <?php

$catrow_count = ( isset($this->_tpldata['catrow.']) ) ?  sizeof($this->_tpldata['catrow.']) : 0;
for ($catrow_i = 0; $catrow_i < $catrow_count; $catrow_i++)
{
 $catrow_item = &$this->_tpldata['catrow.'][$catrow_i];
 $catrow_item['S_ROW_COUNT'] = $catrow_i;
 $catrow_item['S_NUM_ROWS'] = $catrow_count;

?>
  <tr> 
    <td class="catHead cattitle3" colspan="<?php if ($this->vars['SHOW_LAST_POST_AVATAR'] == 1) {  ?>6<?php } else { ?>5<?php } ?>"><span class="cattitle3"><?php echo isset($catrow_item['CAT_DESC']) ? $catrow_item['CAT_DESC'] : ''; ?></span></td>
  </tr>
  <?php

$forumrow_count = ( isset($catrow_item['forumrow.']) ) ? sizeof($catrow_item['forumrow.']) : 0;
for ($forumrow_i = 0; $forumrow_i < $forumrow_count; $forumrow_i++)
{
 $forumrow_item = &$catrow_item['forumrow.'][$forumrow_i];
 $forumrow_item['S_ROW_COUNT'] = $forumrow_i;
 $forumrow_item['S_NUM_ROWS'] = $forumrow_count;

?>
  <?php if (! $forumrow_item['PARENT']) {  ?>
  <tr>  	
	<td class="row1 acenter" style="width: 72px;"><img src="<?php echo isset($forumrow_item['FORUM_FOLDER_IMG']) ? $forumrow_item['FORUM_FOLDER_IMG'] : ''; ?>" alt="<?php echo isset($forumrow_item['L_FORUM_FOLDER_ALT']) ? $forumrow_item['L_FORUM_FOLDER_ALT'] : ''; ?>" title="<?php echo isset($forumrow_item['L_FORUM_FOLDER_ALT']) ? $forumrow_item['L_FORUM_FOLDER_ALT'] : ''; ?>" /></td>

  <?php if ($forumrow_item['FORUM_ICON_IMG']) {  ?>
	<td class="row1 acenter" style="width: 72px;"><?php echo isset($forumrow_item['FORUM_ICON_IMG']) ? $forumrow_item['FORUM_ICON_IMG'] : ''; ?></td>
	<?php } ?>
	<td class="row1"<?php if (! $forumrow_item['FORUM_ICON_IMG']) {  ?> colspan="2"<?php } ?>>
	  <a<?php echo isset($forumrow_item['FORUM_COLOR']) ? $forumrow_item['FORUM_COLOR'] : ''; ?> href="<?php echo isset($forumrow_item['U_VIEWFORUM']) ? $forumrow_item['U_VIEWFORUM'] : ''; ?>"<?php if ($forumrow_item['FORUM_LINK_COUNT']) {  ?> target="_blank"<?php } ?>><?php echo isset($forumrow_item['FORUM_NAME']) ? $forumrow_item['FORUM_NAME'] : ''; ?></a><br />
	  <span class="cattitle"><?php echo isset($forumrow_item['FORUM_DESC']) ? $forumrow_item['FORUM_DESC'] : ''; ?></span>
	  <?php if ($forumrow_item['MODERATORS']) {  ?>
	  <br /><?php echo isset($forumrow_item['L_MODERATOR']) ? $forumrow_item['L_MODERATOR'] : ''; ?>: <?php echo isset($forumrow_item['MODERATORS']) ? $forumrow_item['MODERATORS'] : ''; ?><br />
    <?php } else { ?>
    <br />
	  <?php } ?>
	  <?php

$sub_count = ( isset($forumrow_item['sub.']) ) ? sizeof($forumrow_item['sub.']) : 0;
for ($sub_i = 0; $sub_i < $sub_count; $sub_i++)
{
 $sub_item = &$forumrow_item['sub.'][$sub_i];
 $sub_item['S_ROW_COUNT'] = $sub_i;
 $sub_item['S_NUM_ROWS'] = $sub_count;

?>
	  <?php $this->_tpldata['DEFINE']['.']['HAS_SUB'] = 1; ?>
	  <?php if ($sub_item['NUM'] > 0) {  ?>
	  <?php } else { ?>
	  <?php echo isset($this->vars['L_SUBFORUMS']) ? $this->vars['L_SUBFORUMS'] : $this->lang('L_SUBFORUMS'); ?>:
	  <!-- <br /> -->
	  <?php } ?>
	  <?php echo isset($sub_item['LAST_POST_SUB']) ? $sub_item['LAST_POST_SUB'] : ''; ?> <a href="<?php echo isset($sub_item['U_VIEWFORUM']) ? $sub_item['U_VIEWFORUM'] : ''; ?>" <?php if ($sub_item['UNREAD']) {  ?>class="topic-new"<?php } ?> <?php echo isset($sub_item['FORUM_COLOR']) ? $sub_item['FORUM_COLOR'] : ''; ?> title="<?php echo isset($sub_item['FORUM_DESC_HTML']) ? $sub_item['FORUM_DESC_HTML'] : ''; ?>"><?php echo isset($sub_item['FORUM_NAME']) ? $sub_item['FORUM_NAME'] : ''; ?></a>&nbsp;
	  <?php

} // END sub

if(isset($sub_item)) { unset($sub_item); } 

?>
	</td>
	<?php

$switch_forum_link_off_count = ( isset($forumrow_item['switch_forum_link_off.']) ) ? sizeof($forumrow_item['switch_forum_link_off.']) : 0;
for ($switch_forum_link_off_i = 0; $switch_forum_link_off_i < $switch_forum_link_off_count; $switch_forum_link_off_i++)
{
 $switch_forum_link_off_item = &$forumrow_item['switch_forum_link_off.'][$switch_forum_link_off_i];
 $switch_forum_link_off_item['S_ROW_COUNT'] = $switch_forum_link_off_i;
 $switch_forum_link_off_item['S_NUM_ROWS'] = $switch_forum_link_off_count;

?>
	<!-- <td class="row2 acenter"><?php echo isset($forumrow_item['TOTAL_TOPICS']) ? $forumrow_item['TOTAL_TOPICS'] : ''; ?></td>
	<td class="row2 acenter"><?php echo isset($forumrow_item['TOTAL_POSTS']) ? $forumrow_item['TOTAL_POSTS'] : ''; ?></td> -->
	<td class="row1 acenter" style="width: 120px;"><?php echo isset($forumrow_item['TOTAL_TOPICS']) ? $forumrow_item['TOTAL_TOPICS'] : ''; ?> Topics<br /><?php echo isset($forumrow_item['TOTAL_POSTS']) ? $forumrow_item['TOTAL_POSTS'] : ''; ?> Posts</td>
	<?php if ($this->vars['SHOW_LAST_POST_AVATAR'] && $forumrow_item['LAST_POST_COUNT'] != 0) {  ?>
	<td class="row1 acenter" style="width: 72px;"><img class="rounded-corners-last-post" src="<?php echo isset($forumrow_item['LAST_POST_AVATAR']) ? $forumrow_item['LAST_POST_AVATAR'] : ''; ?>" style="max-width: 48px; max-height: 48px" border="0"></td>
	<?php } ?>  
    <td class="row1 lastpost"<?php if ($forumrow_item['LAST_POST_COUNT'] == 0 && $this->vars['SHOW_LAST_POST_AVATAR'] == 1) {  ?> colspan="2"<?php } else { ?>  style="width: 250px;"<?php } ?> nowrap="nowrap"><?php echo isset($forumrow_item['LAST_POST']) ? $forumrow_item['LAST_POST'] : ''; ?><?php echo isset($forumrow_item['LAST_POSTTIME']) ? $forumrow_item['LAST_POSTTIME'] : ''; ?><br /><?php echo isset($forumrow_item['LAST_POST_USERNAME']) ? $forumrow_item['LAST_POST_USERNAME'] : ''; ?></td>
	<?php

} // END switch_forum_link_off

if(isset($switch_forum_link_off_item)) { unset($switch_forum_link_off_item); } 

?>
	<?php

$switch_forum_link_on_count = ( isset($forumrow_item['switch_forum_link_on.']) ) ? sizeof($forumrow_item['switch_forum_link_on.']) : 0;
for ($switch_forum_link_on_i = 0; $switch_forum_link_on_i < $switch_forum_link_on_count; $switch_forum_link_on_i++)
{
 $switch_forum_link_on_item = &$forumrow_item['switch_forum_link_on.'][$switch_forum_link_on_i];
 $switch_forum_link_on_item['S_ROW_COUNT'] = $switch_forum_link_on_i;
 $switch_forum_link_on_item['S_NUM_ROWS'] = $switch_forum_link_on_count;

?>
	<td class="row1" align="center" valign="middle" height="50" colspan="<?php if ($this->vars['SHOW_LAST_POST_AVATAR'] == 1) {  ?>3<?php } else { ?>2<?php } ?>"><?php echo isset($forumrow_item['FORUM_LINK_COUNT']) ? $forumrow_item['FORUM_LINK_COUNT'] : ''; ?></td>
	<?php

} // END switch_forum_link_on

if(isset($switch_forum_link_on_item)) { unset($switch_forum_link_on_item); } 

?>	
  </tr>
  <?php } ?>  
  <?php

} // END forumrow

if(isset($forumrow_item)) { unset($forumrow_item); } 

?>

  <?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>
  
</table>

<br />

<div style="text-align: center"><?php

$switch_user_logged_in_count = ( isset($this->_tpldata['switch_user_logged_in.']) ) ?  sizeof($this->_tpldata['switch_user_logged_in.']) : 0;
for ($switch_user_logged_in_i = 0; $switch_user_logged_in_i < $switch_user_logged_in_count; $switch_user_logged_in_i++)
{
 $switch_user_logged_in_item = &$this->_tpldata['switch_user_logged_in.'][$switch_user_logged_in_i];
 $switch_user_logged_in_item['S_ROW_COUNT'] = $switch_user_logged_in_i;
 $switch_user_logged_in_item['S_NUM_ROWS'] = $switch_user_logged_in_count;

?><a href="<?php echo isset($this->vars['U_MARK_READ']) ? $this->vars['U_MARK_READ'] : $this->lang('U_MARK_READ'); ?>"><?php echo isset($this->vars['L_MARK_FORUMS_READ']) ? $this->vars['L_MARK_FORUMS_READ'] : $this->lang('L_MARK_FORUMS_READ'); ?></a><?php

} // END switch_user_logged_in

if(isset($switch_user_logged_in_item)) { unset($switch_user_logged_in_item); } 

?></div>

<br />

<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%">
  <tr> 
    <td class="catHead"><a href="<?php echo isset($this->vars['U_VIEWONLINE']) ? $this->vars['U_VIEWONLINE'] : $this->lang('U_VIEWONLINE'); ?>"><?php echo isset($this->vars['L_WHO_IS_ONLINE']) ? $this->vars['L_WHO_IS_ONLINE'] : $this->lang('L_WHO_IS_ONLINE'); ?></a></td>
  </tr>
  <tr> 
    <td class="row1"><?php echo isset($this->vars['TOTAL_POSTS']) ? $this->vars['TOTAL_POSTS'] : $this->lang('TOTAL_POSTS'); ?><br /><?php echo isset($this->vars['TOTAL_USERS']) ? $this->vars['TOTAL_USERS'] : $this->lang('TOTAL_USERS'); ?><br /><?php echo isset($this->vars['NEWEST_USER']) ? $this->vars['NEWEST_USER'] : $this->lang('NEWEST_USER'); ?></td>
  </tr>
  <tr> 
    <td class="row1"><?php echo isset($this->vars['TOTAL_USERS_ONLINE']) ? $this->vars['TOTAL_USERS_ONLINE'] : $this->lang('TOTAL_USERS_ONLINE'); ?><br /><?php echo isset($this->vars['L_ONLINE_EXPLAIN']) ? $this->vars['L_ONLINE_EXPLAIN'] : $this->lang('L_ONLINE_EXPLAIN'); ?><br /><br /><?php echo isset($this->vars['RECORD_USERS']) ? $this->vars['RECORD_USERS'] : $this->lang('RECORD_USERS'); ?><br /><br /><?php echo isset($this->vars['L_LEGEND']) ? $this->vars['L_LEGEND'] : $this->lang('L_LEGEND'); ?>: <?php

$colors_count = ( isset($this->_tpldata['colors.']) ) ?  sizeof($this->_tpldata['colors.']) : 0;
for ($colors_i = 0; $colors_i < $colors_count; $colors_i++)
{
 $colors_item = &$this->_tpldata['colors.'][$colors_i];
 $colors_item['S_ROW_COUNT'] = $colors_i;
 $colors_item['S_NUM_ROWS'] = $colors_count;

?><?php echo isset($colors_item['GROUPS']) ? $colors_item['GROUPS'] : ''; ?><?php

} // END colors

if(isset($colors_item)) { unset($colors_item); } 

?><br /><br /><?php echo isset($this->vars['LOGGED_IN_USER_LIST']) ? $this->vars['LOGGED_IN_USER_LIST'] : $this->lang('LOGGED_IN_USER_LIST'); ?></td>
  </tr>
  <tr> 
	<td class="row1"><?php echo isset($this->vars['USERS_OF_THE_DAY_LIST']) ? $this->vars['USERS_OF_THE_DAY_LIST'] : $this->lang('USERS_OF_THE_DAY_LIST'); ?></td>
  </tr>
  <?php

$birthdays_count = ( isset($this->_tpldata['birthdays.']) ) ?  sizeof($this->_tpldata['birthdays.']) : 0;
for ($birthdays_i = 0; $birthdays_i < $birthdays_count; $birthdays_i++)
{
 $birthdays_item = &$this->_tpldata['birthdays.'][$birthdays_i];
 $birthdays_item['S_ROW_COUNT'] = $birthdays_i;
 $birthdays_item['S_NUM_ROWS'] = $birthdays_count;

?>
  <tr>
	<td class="catHead"><?php echo isset($this->vars['L_TODAYS_BIRTHDAYS']) ? $this->vars['L_TODAYS_BIRTHDAYS'] : $this->lang('L_TODAYS_BIRTHDAYS'); ?></td>
  </tr>
  <tr> 
	<td class="row1">
	  <table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td align="left" width="100%"><?php echo isset($this->vars['BIRTHDAYS']) ? $this->vars['BIRTHDAYS'] : $this->lang('BIRTHDAYS'); ?><?php

$upcoming_count = ( isset($birthdays_item['upcoming.']) ) ? sizeof($birthdays_item['upcoming.']) : 0;
for ($upcoming_i = 0; $upcoming_i < $upcoming_count; $upcoming_i++)
{
 $upcoming_item = &$birthdays_item['upcoming.'][$upcoming_i];
 $upcoming_item['S_ROW_COUNT'] = $upcoming_i;
 $upcoming_item['S_NUM_ROWS'] = $upcoming_count;

?><br /><?php echo isset($this->vars['UPCOMING']) ? $this->vars['UPCOMING'] : $this->lang('UPCOMING'); ?><?php

} // END upcoming

if(isset($upcoming_item)) { unset($upcoming_item); } 

?></td>
	  	</tr>
	  </table>
	</td>
  </tr>
  <?php

} // END birthdays

if(isset($birthdays_item)) { unset($birthdays_item); } 

?>
</table>

<br />

<table border="0" cellpadding="4" cellspacing="1" style="margin: auto">
  <tr> 
    <td width="20" align="center"><img src="<?php echo isset($this->vars['FORUM_IMG']) ? $this->vars['FORUM_IMG'] : $this->lang('FORUM_IMG'); ?>" alt="<?php echo isset($this->vars['L_NO_NEW_POSTS']) ? $this->vars['L_NO_NEW_POSTS'] : $this->lang('L_NO_NEW_POSTS'); ?>" /></td>
    <td>&nbsp;&nbsp;<?php echo isset($this->vars['L_NO_NEW_POSTS']) ? $this->vars['L_NO_NEW_POSTS'] : $this->lang('L_NO_NEW_POSTS'); ?></td>
    <td>&nbsp;&nbsp;</td>
    <td width="20" align="center"><img src="<?php echo isset($this->vars['FORUM_NEW_IMG']) ? $this->vars['FORUM_NEW_IMG'] : $this->lang('FORUM_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_NEW_POSTS']) ? $this->vars['L_NEW_POSTS'] : $this->lang('L_NEW_POSTS'); ?>"/></td>
    <td>&nbsp;&nbsp;<?php echo isset($this->vars['L_NEW_POSTS']) ? $this->vars['L_NEW_POSTS'] : $this->lang('L_NEW_POSTS'); ?></td>
    <td>&nbsp;&nbsp;</td>    
    <td width="20" align="center"><img src="<?php echo isset($this->vars['FORUM_LOCKED_IMG']) ? $this->vars['FORUM_LOCKED_IMG'] : $this->lang('FORUM_LOCKED_IMG'); ?>" alt="<?php echo isset($this->vars['L_FORUM_LOCKED']) ? $this->vars['L_FORUM_LOCKED'] : $this->lang('L_FORUM_LOCKED'); ?>" /></td>
    <td>&nbsp;&nbsp;<?php echo isset($this->vars['L_FORUM_LOCKED']) ? $this->vars['L_FORUM_LOCKED'] : $this->lang('L_FORUM_LOCKED'); ?></td>
  </tr>
</table>
</tr>
</tbody>
</table>
</div>