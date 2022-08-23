<?php

// eXtreme Styles mod cache. Generated on Wed, 14 Apr 2021 11:48:51 +0000 (time=1618400931)

?><table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
   <tr>
      <td width="100%" colspan="2" valign="top">
      <!-- MOD GLANCE BEGIN -->
      <?php echo isset($this->vars['GLANCE_OUTPUT']) ? $this->vars['GLANCE_OUTPUT'] : $this->lang('GLANCE_OUTPUT'); ?>
      <!-- MOD GLANCE END -->
   </tr>
</table>
<form method="post" action="<?php echo isset($this->vars['S_POST_DAYS_ACTION']) ? $this->vars['S_POST_DAYS_ACTION'] : $this->lang('S_POST_DAYS_ACTION'); ?>">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
      <td align="left" valign="bottom" colspan="2"><?php echo isset($this->vars['FORUM_ICON_IMG']) ? $this->vars['FORUM_ICON_IMG'] : $this->lang('FORUM_ICON_IMG'); ?><a class="maintitle" href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a><br /><span class="gensmall"><strong><?php echo isset($this->vars['L_MODERATOR']) ? $this->vars['L_MODERATOR'] : $this->lang('L_MODERATOR'); ?>: <?php echo isset($this->vars['MODERATORS']) ? $this->vars['MODERATORS'] : $this->lang('MODERATORS'); ?><br /><br /><?php echo isset($this->vars['LOGGED_IN_USER_LIST']) ? $this->vars['LOGGED_IN_USER_LIST'] : $this->lang('LOGGED_IN_USER_LIST'); ?></strong></span></td>
      <td align="right" valign="bottom" class="gensmall boldme" nowrap="nowrap"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td>
    </tr>
    <tr> 
      <td align="left" valign="middle" width="50"><a href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['POST_IMG']) ? $this->vars['POST_IMG'] : $this->lang('POST_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>" /></a></td>
      <td align="left" valign="middle" class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a><?php if ($this->vars['PARENT_FORUM']) {  ?> -> <a class="nav" href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a> <?php } ?> -> <a class="nav" href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></span></td>
      <td align="right" valign="bottom" class="nav" nowrap="nowrap"><span class="gensmall"><a href="<?php echo isset($this->vars['U_MARK_READ']) ? $this->vars['U_MARK_READ'] : $this->lang('U_MARK_READ'); ?>"><?php echo isset($this->vars['L_MARK_TOPICS_READ']) ? $this->vars['L_MARK_TOPICS_READ'] : $this->lang('L_MARK_TOPICS_READ'); ?></a></span></td>
    </tr>
  </table>

<?php

$catrow_count = ( isset($this->_tpldata['catrow.']) ) ?  sizeof($this->_tpldata['catrow.']) : 0;
for ($catrow_i = 0; $catrow_i < $catrow_count; $catrow_i++)
{
 $catrow_item = &$this->_tpldata['catrow.'][$catrow_i];
 $catrow_item['S_ROW_COUNT'] = $catrow_i;
 $catrow_item['S_NUM_ROWS'] = $catrow_count;

?>
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;<?php echo isset($catrow_item['CAT_DESC']) ? $catrow_item['CAT_DESC'] : ''; ?>&nbsp;</th>
	<th width="50" class="fixcell" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?>&nbsp;</th>
	<th width="50" class="fixcell" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?>&nbsp;</th>
	<th class="fixcell" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?>&nbsp;</th>
  </tr>
  <?php

$forumrow_count = ( isset($catrow_item['forumrow.']) ) ? sizeof($catrow_item['forumrow.']) : 0;
for ($forumrow_i = 0; $forumrow_i < $forumrow_count; $forumrow_i++)
{
 $forumrow_item = &$catrow_item['forumrow.'][$forumrow_i];
 $forumrow_item['S_ROW_COUNT'] = $forumrow_i;
 $forumrow_item['S_NUM_ROWS'] = $forumrow_count;

?>
  <tr> 
	<td class="row1" align="center" valign="middle" height="50"><img src="<?php echo isset($forumrow_item['FORUM_FOLDER_IMG']) ? $forumrow_item['FORUM_FOLDER_IMG'] : ''; ?>" alt="<?php echo isset($forumrow_item['L_FORUM_FOLDER_ALT']) ? $forumrow_item['L_FORUM_FOLDER_ALT'] : ''; ?>" title="<?php echo isset($forumrow_item['L_FORUM_FOLDER_ALT']) ? $forumrow_item['L_FORUM_FOLDER_ALT'] : ''; ?>" /></td>
	<td class="row1" width="100%" height="50" onmouseover="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/block.png)'" onmouseout="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/b.png)'"><span class="forumlink"> <a href="<?php echo isset($forumrow_item['U_VIEWFORUM']) ? $forumrow_item['U_VIEWFORUM'] : ''; ?>" class="forumlink<?php if ($forumrow_item['UNREAD']) {  ?> topic-new<?php } ?>"><?php echo isset($forumrow_item['FORUM_NAME']) ? $forumrow_item['FORUM_NAME'] : ''; ?></a><br />
	  </span> <span class="genmed"><?php echo isset($forumrow_item['FORUM_DESC']) ? $forumrow_item['FORUM_DESC'] : ''; ?><br />
	  </span><span class="gensmall"><?php echo isset($forumrow_item['L_MODERATOR']) ? $forumrow_item['L_MODERATOR'] : ''; ?> <?php echo isset($forumrow_item['MODERATORS']) ? $forumrow_item['MODERATORS'] : ''; ?></span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall"><?php echo isset($forumrow_item['TOPICS']) ? $forumrow_item['TOPICS'] : ''; ?></span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall"><?php echo isset($forumrow_item['POSTS']) ? $forumrow_item['POSTS'] : ''; ?></span></td>
	<td class="row2" align="center" valign="middle" height="50" nowrap="nowrap"> <span class="gensmall"><?php echo isset($forumrow_item['LAST_POST']) ? $forumrow_item['LAST_POST'] : ''; ?></span></td>
  </tr>
  <?php

} // END forumrow

if(isset($forumrow_item)) { unset($forumrow_item); } 

?>
</table>
<br />
<?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>

<?php if ($this->vars['NUM_TOPICS'] || ! $this->vars['HAS_SUBFORUMS']) {  ?>

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
    <tr> 
      <th colspan="3" align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?>&nbsp;</th>
      <th width="50" align="center" class="fixcell" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?>&nbsp;</th>
      <th width="100" align="center" class="fixcell" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?>&nbsp;</th>
      <th width="50" align="center" class="fixcell" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_VIEWS']) ? $this->vars['L_VIEWS'] : $this->lang('L_VIEWS'); ?>&nbsp;</th>
      <th align="center" class="fixcell" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?>&nbsp;</th>
    </tr>
    <?php

$topicrow_count = ( isset($this->_tpldata['topicrow.']) ) ?  sizeof($this->_tpldata['topicrow.']) : 0;
for ($topicrow_i = 0; $topicrow_i < $topicrow_count; $topicrow_i++)
{
 $topicrow_item = &$this->_tpldata['topicrow.'][$topicrow_i];
 $topicrow_item['S_ROW_COUNT'] = $topicrow_i;
 $topicrow_item['S_NUM_ROWS'] = $topicrow_count;

?>
    <?php

$divider_count = ( isset($topicrow_item['divider.']) ) ? sizeof($topicrow_item['divider.']) : 0;
for ($divider_i = 0; $divider_i < $divider_count; $divider_i++)
{
 $divider_item = &$topicrow_item['divider.'][$divider_i];
 $divider_item['S_ROW_COUNT'] = $divider_i;
 $divider_item['S_NUM_ROWS'] = $divider_count;

?>
    <tr> 
       <td class="catHead" colspan="7" height="28"><span class="cattitle"><?php echo isset($divider_item['L_DIV_HEADERS']) ? $divider_item['L_DIV_HEADERS'] : ''; ?></span></td>
    </tr>
    <?php

} // END divider

if(isset($divider_item)) { unset($divider_item); } 

?>
    <tr> 
      <td class="row1" align="center" valign="middle" width="20"><img src="<?php echo isset($topicrow_item['TOPIC_FOLDER_IMG']) ? $topicrow_item['TOPIC_FOLDER_IMG'] : ''; ?>" alt="<?php echo isset($topicrow_item['L_TOPIC_FOLDER_ALT']) ? $topicrow_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" title="<?php echo isset($topicrow_item['L_TOPIC_FOLDER_ALT']) ? $topicrow_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" /></td>
      <td class="row1" align="center" valign="middle" width="20"><?php echo isset($topicrow_item['ICON']) ? $topicrow_item['ICON'] : ''; ?></td>
<td class="row1" width="100%"  onmouseover="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/block.png)'" onmouseout="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/b.png)'" onclick="window.location.href='<?php echo isset($topicrow_item['U_VIEW_TOPIC']) ? $topicrow_item['U_VIEW_TOPIC'] : ''; ?>'"><span class="topictitle"><?php echo isset($topicrow_item['NEWEST_POST_IMG']) ? $topicrow_item['NEWEST_POST_IMG'] : ''; ?><?php echo isset($topicrow_item['TOPIC_ATTACHMENT_IMG']) ? $topicrow_item['TOPIC_ATTACHMENT_IMG'] : ''; ?><?php echo isset($topicrow_item['TOPIC_TYPE']) ? $topicrow_item['TOPIC_TYPE'] : ''; ?><a href="<?php echo isset($topicrow_item['U_VIEW_TOPIC']) ? $topicrow_item['U_VIEW_TOPIC'] : ''; ?>" class="topictitle"><?php echo isset($topicrow_item['TOPIC_TITLE']) ? $topicrow_item['TOPIC_TITLE'] : ''; ?></a></span><span class="gensmall"><br />

        <?php echo isset($topicrow_item['GOTO_PAGE']) ? $topicrow_item['GOTO_PAGE'] : ''; ?></span></td>
      <td class="row2" align="center" valign="middle"><span class="postdetails"><?php echo isset($topicrow_item['REPLIES']) ? $topicrow_item['REPLIES'] : ''; ?></span></td>
      <td class="row3" align="center" valign="middle"><span class="name"><?php echo isset($topicrow_item['TOPIC_AUTHOR']) ? $topicrow_item['TOPIC_AUTHOR'] : ''; ?></span></td>
      <td class="row2" align="center" valign="middle"><span class="postdetails"><?php echo isset($topicrow_item['VIEWS']) ? $topicrow_item['VIEWS'] : ''; ?></span></td>
      <td class="row3" align="center" valign="middle" nowrap="nowrap"><span class="postdetails"><?php echo isset($topicrow_item['LAST_POST_TIME']) ? $topicrow_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($topicrow_item['LAST_POST_AUTHOR']) ? $topicrow_item['LAST_POST_AUTHOR'] : ''; ?> <?php echo isset($topicrow_item['LAST_POST_IMG']) ? $topicrow_item['LAST_POST_IMG'] : ''; ?></span></td>
    </tr>
    <?php

} // END topicrow

if(isset($topicrow_item)) { unset($topicrow_item); } 

?>
    <?php

$switch_no_topics_count = ( isset($this->_tpldata['switch_no_topics.']) ) ?  sizeof($this->_tpldata['switch_no_topics.']) : 0;
for ($switch_no_topics_i = 0; $switch_no_topics_i < $switch_no_topics_count; $switch_no_topics_i++)
{
 $switch_no_topics_item = &$this->_tpldata['switch_no_topics.'][$switch_no_topics_i];
 $switch_no_topics_item['S_ROW_COUNT'] = $switch_no_topics_i;
 $switch_no_topics_item['S_NUM_ROWS'] = $switch_no_topics_count;

?>
    
    <tr> 
      <td class="row1" colspan="7" height="30" align="center" valign="middle"><span class="gen"><?php echo isset($this->vars['L_NO_TOPICS']) ? $this->vars['L_NO_TOPICS'] : $this->lang('L_NO_TOPICS'); ?></span></td>
    </tr>
    <?php

} // END switch_no_topics

if(isset($switch_no_topics_item)) { unset($switch_no_topics_item); } 

?>
    <tr> 
      <td class="catBottom" align="center" valign="middle" colspan="7" height="28"><span class="genmed"><?php echo isset($this->vars['L_DISPLAY_TOPICS']) ? $this->vars['L_DISPLAY_TOPICS'] : $this->lang('L_DISPLAY_TOPICS'); ?>:&nbsp;<?php echo isset($this->vars['S_SELECT_TOPIC_DAYS']) ? $this->vars['S_SELECT_TOPIC_DAYS'] : $this->lang('S_SELECT_TOPIC_DAYS'); ?>&nbsp; <?php echo isset($this->vars['S_DISPLAY_ORDER']) ? $this->vars['S_DISPLAY_ORDER'] : $this->lang('S_DISPLAY_ORDER'); ?>
        <input type="submit" class="liteoption" value="<?php echo isset($this->vars['L_GO']) ? $this->vars['L_GO'] : $this->lang('L_GO'); ?>" name="submit" />
        </span></td>
    </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
      <td align="left" valign="middle" style ="width: 50;"><a href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['POST_IMG']) ? $this->vars['POST_IMG'] : $this->lang('POST_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>" /></a></td>
      <td align="left" valign="middle" style ="width: 100%;" ><span class="nav">&nbsp;&nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a><?php if ($this->vars['PARENT_FORUM']) {  ?> -> <a class="nav" href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a><?php } ?> -> <a class="nav" href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></span></td>
      <td align="right" valign="middle" nowrap="nowrap"><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span><br /><table><tr><td class="nav"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td></tr></table> 
        </td>
    </tr>
    <tr>
      <td align="left" colspan="3"><span class="nav"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></span></td>
    </tr>
  </table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="right"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
    <tr>
        <td align="left" valign="top">
		<table cellspacing="3" cellpadding="0" border="0" width="874" height="100%">
            <tr>
        <td width="29" align="left"><img src="<?php echo isset($this->vars['FOLDER_NEW_IMG']) ? $this->vars['FOLDER_NEW_IMG'] : $this->lang('FOLDER_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_NEW_POSTS']) ? $this->vars['L_NEW_POSTS'] : $this->lang('L_NEW_POSTS'); ?>" /></td>
          <td class="gensmall" width="145">New Posts</td>
          <td width="12">&nbsp;&nbsp;</td>
          <td width="30" align="center"><img src="<?php echo isset($this->vars['FOLDER_IMG']) ? $this->vars['FOLDER_IMG'] : $this->lang('FOLDER_IMG'); ?>" alt="<?php echo isset($this->vars['L_NO_NEW_POSTS']) ? $this->vars['L_NO_NEW_POSTS'] : $this->lang('L_NO_NEW_POSTS'); ?>" /></td>
          <td class="gensmall" width="183">No New Posts</td>
          <td width="12">&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="30" align="center"><img src="<?php echo isset($this->vars['FOLDER_GLOBAL_ANNOUNCE_IMG']) ? $this->vars['FOLDER_GLOBAL_ANNOUNCE_IMG'] : $this->lang('FOLDER_GLOBAL_ANNOUNCE_IMG'); ?>" alt="<?php echo isset($this->vars['L_GLOBAL_ANNOUNCEMENT']) ? $this->vars['L_GLOBAL_ANNOUNCEMENT'] : $this->lang('L_GLOBAL_ANNOUNCEMENT'); ?>" /></td>
          <td class="gensmall" width="175">Old Global Announcement</td>
          <!-- End replacement - Global announcement MOD -->
          <td class="gensmall" width="16"><img src="<?php echo isset($this->vars['FOLDER_GLOBAL_ANNOUNCE_NEW_IMG']) ? $this->vars['FOLDER_GLOBAL_ANNOUNCE_NEW_IMG'] : $this->lang('FOLDER_GLOBAL_ANNOUNCE_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_STICKY']) ? $this->vars['L_STICKY'] : $this->lang('L_STICKY'); ?>" /></td>
          <td class="gensmall" width="187">New Global Announcement</td>
          <td class="gensmall" width="13">&nbsp;</td>
        </tr>
        <tr>
          <td width="29" align="center"><img src="<?php echo isset($this->vars['FOLDER_HOT_NEW_IMG']) ? $this->vars['FOLDER_HOT_NEW_IMG'] : $this->lang('FOLDER_HOT_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_NEW_POSTS_HOT']) ? $this->vars['L_NEW_POSTS_HOT'] : $this->lang('L_NEW_POSTS_HOT'); ?>" /></td>
          <td class="gensmall" width="145">New Posts [Popular]</td>
          <td width="12">&nbsp;&nbsp;</td>
          <td width="30" align="center"><img src="<?php echo isset($this->vars['FOLDER_HOT_IMG']) ? $this->vars['FOLDER_HOT_IMG'] : $this->lang('FOLDER_HOT_IMG'); ?>" alt="<?php echo isset($this->vars['L_NO_NEW_POSTS_HOT']) ? $this->vars['L_NO_NEW_POSTS_HOT'] : $this->lang('L_NO_NEW_POSTS_HOT'); ?>" /></td>
          <td class="gensmall" width="183">No New Posts [Popular]</td>
          <td width="12">&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="30" align="center"><img src="<?php echo isset($this->vars['FOLDER_ANNOUNCE_IMG']) ? $this->vars['FOLDER_ANNOUNCE_IMG'] : $this->lang('FOLDER_ANNOUNCE_IMG'); ?>" alt="<?php echo isset($this->vars['L_ANNOUNCEMENT']) ? $this->vars['L_ANNOUNCEMENT'] : $this->lang('L_ANNOUNCEMENT'); ?>" /></td>
          <td class="gensmall" width="175">Old Regular Announcement</td>
          <!-- End replacement - Global announcement MOD -->
          <td class="gensmall" width="16"><img src="<?php echo isset($this->vars['FOLDER_ANNOUNCE_NEW_IMG']) ? $this->vars['FOLDER_ANNOUNCE_NEW_IMG'] : $this->lang('FOLDER_ANNOUNCE_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_STICKY']) ? $this->vars['L_STICKY'] : $this->lang('L_STICKY'); ?>" /></td>
          <td class="gensmall" width="187">New Regular Announcements</td>
          <td class="gensmall" width="13">&nbsp;</td>
        </tr>
        <tr>
          <td width="29" align="center"><img src="<?php echo isset($this->vars['FOLDER_LOCKED_NEW_IMG']) ? $this->vars['FOLDER_LOCKED_NEW_IMG'] : $this->lang('FOLDER_LOCKED_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_NEW_POSTS_LOCKED']) ? $this->vars['L_NEW_POSTS_LOCKED'] : $this->lang('L_NEW_POSTS_LOCKED'); ?>" /></td>
          <td class="gensmall" width="145">New Posts [Locked]
          <td width="12">&nbsp;&nbsp;</td>
          <td width="30" align="center"><img src="<?php echo isset($this->vars['FOLDER_LOCKED_IMG']) ? $this->vars['FOLDER_LOCKED_IMG'] : $this->lang('FOLDER_LOCKED_IMG'); ?>" alt="<?php echo isset($this->vars['L_NO_NEW_POSTS_LOCKED']) ? $this->vars['L_NO_NEW_POSTS_LOCKED'] : $this->lang('L_NO_NEW_POSTS_LOCKED'); ?>" /></td>
          <td class="gensmall" width="183">No New Posts [Lockaed]</td>
          <!-- Start add - Global announcement MOD -->
          <td width="12">&nbsp;&nbsp;</td>
          <td width="30" align="center"><img src="<?php echo isset($this->vars['FOLDER_STICKY_IMG']) ? $this->vars['FOLDER_STICKY_IMG'] : $this->lang('FOLDER_STICKY_IMG'); ?>" alt="<?php echo isset($this->vars['L_STICKY']) ? $this->vars['L_STICKY'] : $this->lang('L_STICKY'); ?>" /></td>
          <td class="gensmall" width="175"><?php echo isset($this->vars['L_STICKY']) ? $this->vars['L_STICKY'] : $this->lang('L_STICKY'); ?></td>
          <!-- End add - Global announcement MOD -->
          <td class="gensmall" width="16">&nbsp;</td>
          <td class="gensmall" width="187">&nbsp;</td>
          <td class="gensmall" width="13">&nbsp;</td>
        </tr>
        <tr>
          <td width="29" align="center">&nbsp;</td>
          <td class="gensmall" width="145">&nbsp;<td width="12">&nbsp;</td>
          <td width="30" align="center">&nbsp;</td>
          <td class="gensmall" width="183">&nbsp;</td>
          <td width="12">&nbsp;</td>
          <td width="30" align="center">&nbsp;</td>
          <td class="gensmall" width="175">&nbsp;</td>
          <td class="gensmall" width="16">&nbsp;</td>
          <td class="gensmall" width="187">&nbsp;</td>
          <td class="gensmall" width="13">&nbsp;</td>
        </tr>
        <tr>
          <td width="29" align="center">&nbsp;</td>
          <td class="gensmall" width="145">&nbsp;<td width="12">&nbsp;</td>
          <td width="30" align="center">&nbsp;</td>
          <td class="gensmall" width="183">&nbsp;</td>
          <td width="12">&nbsp;</td>
          <td width="30" align="center">&nbsp;</td>
          <td class="gensmall" width="175">&nbsp;</td>
          <td class="gensmall" width="16">&nbsp;</td>
          <td class="gensmall" width="187">&nbsp;</td>
          <td class="gensmall" width="13">&nbsp;</td>
        </tr>
        </table></td>
        <td align="right"><span class="gensmall"><?php echo isset($this->vars['S_AUTH_LIST']) ? $this->vars['S_AUTH_LIST'] : $this->lang('S_AUTH_LIST'); ?></span></td>
    </tr>
</table>

<?php } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
	<td align="right"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>
<?php } ?>