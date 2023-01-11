<?php

// eXtreme Styles mod cache. Generated on Fri, 06 Jan 2023 23:54:14 +0000 (time=1673049254)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<!--MOD GLANCE BEGIN --><?php echo isset($this->vars['GLANCE_OUTPUT']) ? $this->vars['GLANCE_OUTPUT'] : $this->lang('GLANCE_OUTPUT'); ?><!-- MOD GLANCE END -->
<form method="post" action="<?php echo isset($this->vars['S_POST_DAYS_ACTION']) ? $this->vars['S_POST_DAYS_ACTION'] : $this->lang('S_POST_DAYS_ACTION'); ?>">
<table class="rounded-corners" width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left" valign="bottom" colspan="2"><a class="maintitle" href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a><br /><strong><?php echo isset($this->vars['L_MODERATOR']) ? $this->vars['L_MODERATOR'] : $this->lang('L_MODERATOR'); ?>: <?php echo isset($this->vars['MODERATORS']) ? $this->vars['MODERATORS'] : $this->lang('MODERATORS'); ?><br /><?php echo isset($this->vars['LOGGED_IN_USER_LIST']) ? $this->vars['LOGGED_IN_USER_LIST'] : $this->lang('LOGGED_IN_USER_LIST'); ?></strong></td>
    <td align="right" valign="bottom" class="gensmall boldme" nowrap="nowrap"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td>
  </tr>
   <tr> 
    <td align="center" height="6" colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <td align="left" width="50"><a href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['POST_IMG']) ? $this->vars['POST_IMG'] : $this->lang('POST_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>" /></a></td>
    <td align="left" valign="middle" width="100%">&nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
    <?php if ($this->vars['PARENT_FORUM']) {  ?> 
    <a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><i class="fa-solid fa-arrow-right fa-lg"></i> <?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a> 
    <?php } ?> 
    <a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><i class="fa-solid fa-arrow-right fa-lg"></i> <?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a>
    </td>
    <td align="right" valign="bottom" nowrap="nowrap"><a href="<?php echo isset($this->vars['U_MARK_READ']) ? $this->vars['U_MARK_READ'] : $this->lang('U_MARK_READ'); ?>"><?php echo isset($this->vars['L_MARK_TOPICS_READ']) ? $this->vars['L_MARK_TOPICS_READ'] : $this->lang('L_MARK_TOPICS_READ'); ?></a></td>
  </tr>
  <tr> 
    <td align="center" height="6" colspan="3">&nbsp;</td>
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
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline rounded-corners">
 
  <?php

$forumrow_count = ( isset($catrow_item['forumrow.']) ) ? sizeof($catrow_item['forumrow.']) : 0;
for ($forumrow_i = 0; $forumrow_i < $forumrow_count; $forumrow_i++)
{
 $forumrow_item = &$catrow_item['forumrow.'][$forumrow_i];
 $forumrow_item['S_ROW_COUNT'] = $forumrow_i;
 $forumrow_item['S_NUM_ROWS'] = $forumrow_count;

?>
  
  <?php

} // END forumrow

if(isset($forumrow_item)) { unset($forumrow_item); } 

?>
</table>
<?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>
<?php if ($this->vars['NUM_TOPICS'] || ! $this->vars['HAS_SUBFORUMS']) {  ?>
  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline rounded-corners">
    <tr> 
      <td class="catHead" colspan="3" style="text-align: center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?>&nbsp;</td>
      <td class="catHead" style="text-align: center; width: 50px;" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?>&nbsp;</td>
      <td class="catHead" style="text-align: center; width: 50px;" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_VIEWS']) ? $this->vars['L_VIEWS'] : $this->lang('L_VIEWS'); ?>&nbsp;</td>
      <td class="catHead" style="text-align: center; width: 200px;" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?>&nbsp;</td>
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
       <td class="catHead" colspan="6"><span class="cattitle"><?php echo isset($divider_item['L_DIV_HEADERS']) ? $divider_item['L_DIV_HEADERS'] : ''; ?></span></td>
    </tr>
    <?php

} // END divider

if(isset($divider_item)) { unset($divider_item); } 

?>
    <tr> 
      <td class="row1" style="text-align: center; width: 40px;"><img src="<?php echo isset($topicrow_item['TOPIC_FOLDER_IMG']) ? $topicrow_item['TOPIC_FOLDER_IMG'] : ''; ?>" alt="<?php echo isset($topicrow_item['L_TOPIC_FOLDER_ALT']) ? $topicrow_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" title="<?php echo isset($topicrow_item['L_TOPIC_FOLDER_ALT']) ? $topicrow_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" /></td>
      <?php if ($topicrow_item['ICON_ID'] > 0) {  ?>      
      <td class="row1" style="text-align: center; width: 40px;"><?php echo isset($topicrow_item['ICON']) ? $topicrow_item['ICON'] : ''; ?></td>
      <td class="row1">
      	<?php echo isset($topicrow_item['NEWEST_POST_IMG']) ? $topicrow_item['NEWEST_POST_IMG'] : ''; ?><?php echo isset($topicrow_item['TOPIC_ATTACHMENT_IMG']) ? $topicrow_item['TOPIC_ATTACHMENT_IMG'] : ''; ?><?php echo isset($topicrow_item['TOPIC_TYPE']) ? $topicrow_item['TOPIC_TYPE'] : ''; ?><a href="<?php echo isset($topicrow_item['U_VIEW_TOPIC']) ? $topicrow_item['U_VIEW_TOPIC'] : ''; ?>"><?php echo isset($topicrow_item['TOPIC_TITLE']) ? $topicrow_item['TOPIC_TITLE'] : ''; ?></a><br />
      	<!-- <div style="float: left; width: auto; text-align: left; max-width: 100%;">by <?php echo isset($topicrow_item['TOPIC_AUTHOR']) ? $topicrow_item['TOPIC_AUTHOR'] : ''; ?></div> -->
      	<div style="float: right; text-align: right; width: auto;"><?php echo isset($topicrow_item['GOTO_PAGE']) ? $topicrow_item['GOTO_PAGE'] : ''; ?></div>
      <?php } else { ?>
      <td class="row1" colspan="2">
      	<?php echo isset($topicrow_item['NEWEST_POST_IMG']) ? $topicrow_item['NEWEST_POST_IMG'] : ''; ?><?php echo isset($topicrow_item['TOPIC_ATTACHMENT_IMG']) ? $topicrow_item['TOPIC_ATTACHMENT_IMG'] : ''; ?><?php echo isset($topicrow_item['TOPIC_TYPE']) ? $topicrow_item['TOPIC_TYPE'] : ''; ?><a href="<?php echo isset($topicrow_item['U_VIEW_TOPIC']) ? $topicrow_item['U_VIEW_TOPIC'] : ''; ?>"><?php echo isset($topicrow_item['TOPIC_TITLE']) ? $topicrow_item['TOPIC_TITLE'] : ''; ?></a><br />
      	<!-- <span class="gensmall"><br /><?php echo isset($topicrow_item['GOTO_PAGE']) ? $topicrow_item['GOTO_PAGE'] : ''; ?> -->
      	<!-- <div style="float: left; width: auto; text-align: left; max-width: 100%;">by <?php echo isset($topicrow_item['TOPIC_AUTHOR']) ? $topicrow_item['TOPIC_AUTHOR'] : ''; ?></div> -->
      	<div style="float: right; text-align: right; width: auto;"><?php echo isset($topicrow_item['GOTO_PAGE']) ? $topicrow_item['GOTO_PAGE'] : ''; ?></div>
      </td>
      <?php } ?>
      <td class="row1" align="center" valign="middle"><?php echo isset($topicrow_item['REPLIES']) ? $topicrow_item['REPLIES'] : ''; ?></td>
      <td class="row1" align="center" valign="middle"><?php echo isset($topicrow_item['VIEWS']) ? $topicrow_item['VIEWS'] : ''; ?></td>
      <!-- <td class="row1" style="text-align: right;" nowrap="nowrap"><?php echo isset($topicrow_item['LAST_POST_TIME']) ? $topicrow_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($topicrow_item['LAST_POST_AUTHOR']) ? $topicrow_item['LAST_POST_AUTHOR'] : ''; ?> <?php echo isset($topicrow_item['LAST_POST_IMG']) ? $topicrow_item['LAST_POST_IMG'] : ''; ?></td> -->
      <td class="row1 lastpost" style="width: 250px;" nowrap="nowrap"><?php echo isset($topicrow_item['LAST_POST_IMG']) ? $topicrow_item['LAST_POST_IMG'] : ''; ?> <?php echo isset($topicrow_item['LAST_POST_TIME']) ? $topicrow_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($topicrow_item['LAST_POST_AUTHOR']) ? $topicrow_item['LAST_POST_AUTHOR'] : ''; ?></td>
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
      <td class="row1 acenter" colspan="6" valign="middle"><?php echo isset($this->vars['L_NO_TOPICS']) ? $this->vars['L_NO_TOPICS'] : $this->lang('L_NO_TOPICS'); ?></td>
    </tr>
    <?php

} // END switch_no_topics

if(isset($switch_no_topics_item)) { unset($switch_no_topics_item); } 

?>
    <tr> 
    <td class="catBottom" colspan="6" height="28">
      <table cellspacing="0" cellpadding="0" border="0" style="float: right;">
        <tr>
          <td>
            <?php echo isset($this->vars['L_DISPLAY_TOPICS']) ? $this->vars['L_DISPLAY_TOPICS'] : $this->lang('L_DISPLAY_TOPICS'); ?>:&nbsp;<?php echo isset($this->vars['S_SELECT_TOPIC_DAYS']) ? $this->vars['S_SELECT_TOPIC_DAYS'] : $this->lang('S_SELECT_TOPIC_DAYS'); ?>&nbsp; <?php echo isset($this->vars['S_DISPLAY_ORDER']) ? $this->vars['S_DISPLAY_ORDER'] : $this->lang('S_DISPLAY_ORDER'); ?><input type="submit" class="titaniumbutton" value="<?php echo isset($this->vars['L_GO']) ? $this->vars['L_GO'] : $this->lang('L_GO'); ?>" name="submit" />
          </td>
        </tr>
      </table>
    </td>
  </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
      <td align="left" valign="middle" style ="width: 50px;">&nbsp;</td>
      <td align="left" valign="middle" style ="width: 100%;" >&nbsp;</td>
      <td class="aright" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr> 
      <td align="left" valign="middle" style ="width: 50px;"><a href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><img src="<?php echo isset($this->vars['POST_IMG']) ? $this->vars['POST_IMG'] : $this->lang('POST_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>" /></a></td>
      <td align="left" valign="middle" style ="width: 100%;" >&nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
      <?php if ($this->vars['PARENT_FORUM']) {  ?> 
      <a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><i class="fa-solid fa-arrow-right fa-lg"></i> <?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a> 
      <?php } ?> 
      <a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><i class="fa-solid fa-arrow-right fa-lg"></i> <?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a>
      <br /><?php echo isset($forumrow_item['FORUM_DESC']) ? $forumrow_item['FORUM_DESC'] : ''; ?>
      </td>
      <td class="aright" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?><br /><table><tr><td><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td></tr></table> 
        </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></td>
    </tr>
  </table>

</form>
<div style="padding-top:15px; padding-bottom:15px; text-align: center; background-color :#000000;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="aright"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>
<div style="padding-top:15px; padding-bottom:15px; text-align: center; background-color :#000000;">
<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
    <tr>
        <td align="left" valign="top">
          <table cellspacing="3" cellpadding="0" border="0">
            <tr>
            
        <td width="20" align="center">
		<img src="<?php echo isset($this->vars['FOLDER_NEW_IMG']) ? $this->vars['FOLDER_NEW_IMG'] : $this->lang('FOLDER_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_NEW_POSTS']) ? $this->vars['L_NEW_POSTS'] : $this->lang('L_NEW_POSTS'); ?>" width="32" height="32" />
          </td>
          <td>&nbsp;<?php echo isset($this->vars['L_NEW_POSTS']) ? $this->vars['L_NEW_POSTS'] : $this->lang('L_NEW_POSTS'); ?>
          </td>
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="<?php echo isset($this->vars['FOLDER_IMG']) ? $this->vars['FOLDER_IMG'] : $this->lang('FOLDER_IMG'); ?>" alt="<?php echo isset($this->vars['L_NO_NEW_POSTS']) ? $this->vars['L_NO_NEW_POSTS'] : $this->lang('L_NO_NEW_POSTS'); ?>" width="32" height="32" />
          </td> 
          <td>&nbsp;<?php echo isset($this->vars['L_NO_NEW_POSTS']) ? $this->vars['L_NO_NEW_POSTS'] : $this->lang('L_NO_NEW_POSTS'); ?>
          </td>
          <td>&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="20" align="center"><p>
			<img src="<?php echo isset($this->vars['FOLDER_GLOBAL_ANNOUNCE_IMG']) ? $this->vars['FOLDER_GLOBAL_ANNOUNCE_IMG'] : $this->lang('FOLDER_GLOBAL_ANNOUNCE_IMG'); ?>" alt="<?php echo isset($this->vars['L_GLOBAL_ANNOUNCEMENT']) ? $this->vars['L_GLOBAL_ANNOUNCEMENT'] : $this->lang('L_GLOBAL_ANNOUNCEMENT'); ?>" width="32" height="32" /></p>
          </td>
          <td>&nbsp;
            <?php echo isset($this->vars['L_GLOBAL_ANNOUNCEMENT']) ? $this->vars['L_GLOBAL_ANNOUNCEMENT'] : $this->lang('L_GLOBAL_ANNOUNCEMENT'); ?>           </td>
          <!-- End replacement - Global announcement MOD -->

        </tr>
        <tr>
          <td width="20" align="center">
			<img src="<?php echo isset($this->vars['FOLDER_HOT_NEW_IMG']) ? $this->vars['FOLDER_HOT_NEW_IMG'] : $this->lang('FOLDER_HOT_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_NEW_POSTS_HOT']) ? $this->vars['L_NEW_POSTS_HOT'] : $this->lang('L_NEW_POSTS_HOT'); ?>" width="32" height="32" />
          </td>
          <td>&nbsp;<?php echo isset($this->vars['L_NEW_POSTS_HOT']) ? $this->vars['L_NEW_POSTS_HOT'] : $this->lang('L_NEW_POSTS_HOT'); ?>
          </td>
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="<?php echo isset($this->vars['FOLDER_HOT_IMG']) ? $this->vars['FOLDER_HOT_IMG'] : $this->lang('FOLDER_HOT_IMG'); ?>" alt="<?php echo isset($this->vars['L_NO_NEW_POSTS_HOT']) ? $this->vars['L_NO_NEW_POSTS_HOT'] : $this->lang('L_NO_NEW_POSTS_HOT'); ?>" width="32" height="32" />
          </td>
          <td>&nbsp;<?php echo isset($this->vars['L_NO_NEW_POSTS_HOT']) ? $this->vars['L_NO_NEW_POSTS_HOT'] : $this->lang('L_NO_NEW_POSTS_HOT'); ?>
          </td>
          <td>&nbsp;&nbsp;</td>
          <!-- Start replacement - Global announcement MOD -->
          <td width="20" align="center"><p>
			<img src="<?php echo isset($this->vars['FOLDER_ANNOUNCE_IMG']) ? $this->vars['FOLDER_ANNOUNCE_IMG'] : $this->lang('FOLDER_ANNOUNCE_IMG'); ?>" alt="<?php echo isset($this->vars['L_ANNOUNCEMENT']) ? $this->vars['L_ANNOUNCEMENT'] : $this->lang('L_ANNOUNCEMENT'); ?>" width="32" height="32" /></p>
          </td>
          <td>&nbsp;
            <?php echo isset($this->vars['L_ANNOUNCEMENT']) ? $this->vars['L_ANNOUNCEMENT'] : $this->lang('L_ANNOUNCEMENT'); ?>           </td>
          <!-- End replacement - Global announcement MOD -->
        </tr>
        <tr>
          <td width="20" align="center"><p>
			<img src="<?php echo isset($this->vars['FOLDER_LOCKED_NEW_IMG']) ? $this->vars['FOLDER_LOCKED_NEW_IMG'] : $this->lang('FOLDER_LOCKED_NEW_IMG'); ?>" alt="<?php echo isset($this->vars['L_NEW_POSTS_LOCKED']) ? $this->vars['L_NEW_POSTS_LOCKED'] : $this->lang('L_NEW_POSTS_LOCKED'); ?>" width="32" height="32" /></p></td>
          <td>&nbsp;<?php echo isset($this->vars['L_NEW_POSTS_LOCKED']) ? $this->vars['L_NEW_POSTS_LOCKED'] : $this->lang('L_NEW_POSTS_LOCKED'); ?>
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="<?php echo isset($this->vars['FOLDER_LOCKED_IMG']) ? $this->vars['FOLDER_LOCKED_IMG'] : $this->lang('FOLDER_LOCKED_IMG'); ?>" alt="<?php echo isset($this->vars['L_NO_NEW_POSTS_LOCKED']) ? $this->vars['L_NO_NEW_POSTS_LOCKED'] : $this->lang('L_NO_NEW_POSTS_LOCKED'); ?>" width="32" height="32" /></td>
          <td>&nbsp;<?php echo isset($this->vars['L_NO_NEW_POSTS_LOCKED']) ? $this->vars['L_NO_NEW_POSTS_LOCKED'] : $this->lang('L_NO_NEW_POSTS_LOCKED'); ?></td>
          <!-- Start add - Global announcement MOD -->
          <td>&nbsp;&nbsp;</td>
          <td width="20" align="center">
			<img src="<?php echo isset($this->vars['FOLDER_STICKY_IMG']) ? $this->vars['FOLDER_STICKY_IMG'] : $this->lang('FOLDER_STICKY_IMG'); ?>" alt="<?php echo isset($this->vars['L_STICKY']) ? $this->vars['L_STICKY'] : $this->lang('L_STICKY'); ?>" width="32" height="32" /></td>
          <td>&nbsp;
            <?php echo isset($this->vars['L_STICKY']) ? $this->vars['L_STICKY'] : $this->lang('L_STICKY'); ?></td>
          <!-- End add - Global announcement MOD -->
        </tr>
        </table></td>
        <td class="aright"><?php echo isset($this->vars['S_AUTH_LIST']) ? $this->vars['S_AUTH_LIST'] : $this->lang('S_AUTH_LIST'); ?></td>
    </tr>
</table>

<?php } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
	<td class="aright"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>
<?php } ?>
</tr>
</tbody>
</table>
</div>
