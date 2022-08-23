<?php

// eXtreme Styles mod cache. Generated on Mon, 22 Mar 2021 20:03:47 +0000 (time=1616443427)

?><table width="<?php echo isset($this->vars['GLANCE_TABLE_WIDTH']) ? $this->vars['GLANCE_TABLE_WIDTH'] : $this->lang('GLANCE_TABLE_WIDTH'); ?>" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <?php

$switch_glance_news_count = ( isset($this->_tpldata['switch_glance_news.']) ) ?  sizeof($this->_tpldata['switch_glance_news.']) : 0;
for ($switch_glance_news_i = 0; $switch_glance_news_i < $switch_glance_news_count; $switch_glance_news_i++)
{
 $switch_glance_news_item = &$this->_tpldata['switch_glance_news.'][$switch_glance_news_i];
 $switch_glance_news_item['S_ROW_COUNT'] = $switch_glance_news_i;
 $switch_glance_news_item['S_NUM_ROWS'] = $switch_glance_news_count;

?>
  <tr>
    <td class="catHead acenter" style="font-weight: bold;">+</td>
    <td class="catHead" colspan="3">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
          <td><?php echo isset($this->vars['NEWS_HEADING']) ? $this->vars['NEWS_HEADING'] : $this->lang('NEWS_HEADING'); ?></td>
          <td class="aright"><?php echo isset($switch_glance_news_item['PREV_URL']) ? $switch_glance_news_item['PREV_URL'] : ''; ?>&nbsp;&nbsp;<?php echo isset($switch_glance_news_item['NEXT_URL']) ? $switch_glance_news_item['NEXT_URL'] : ''; ?>&nbsp;&nbsp;</td>
        </tr>
      </table>
    </td>
    <td class="catHead acenter" style="width: 100px;"><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?></td>
    <!-- <td class="catHead acenter" style="width: 100px;"><?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?></td> -->
    <td class="catHead acenter" style="width: 50px;"><?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?></td>
    <td class="catHead" style="width: 250px;"><?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?></td>
  </tr>
  <?php

$switch_news_on_count = ( isset($switch_glance_news_item['switch_news_on.']) ) ? sizeof($switch_glance_news_item['switch_news_on.']) : 0;
for ($switch_news_on_i = 0; $switch_news_on_i < $switch_news_on_count; $switch_news_on_i++)
{
 $switch_news_on_item = &$switch_glance_news_item['switch_news_on.'][$switch_news_on_i];
 $switch_news_on_item['S_ROW_COUNT'] = $switch_news_on_i;
 $switch_news_on_item['S_NUM_ROWS'] = $switch_news_on_count;

?>
  <tbody id="phpbbGlance_news">
  <?php

} // END switch_news_on

if(isset($switch_news_on_item)) { unset($switch_news_on_item); } 

?>
  <?php

$switch_news_off_count = ( isset($switch_glance_news_item['switch_news_off.']) ) ? sizeof($switch_glance_news_item['switch_news_off.']) : 0;
for ($switch_news_off_i = 0; $switch_news_off_i < $switch_news_off_count; $switch_news_off_i++)
{
 $switch_news_off_item = &$switch_glance_news_item['switch_news_off.'][$switch_news_off_i];
 $switch_news_off_item['S_ROW_COUNT'] = $switch_news_off_i;
 $switch_news_off_item['S_NUM_ROWS'] = $switch_news_off_count;

?>
  <tbody id="phpbbGlance_news" style="display: none;">
  <?php

} // END switch_news_off

if(isset($switch_news_off_item)) { unset($switch_news_off_item); } 

?>    
  <?php

} // END switch_glance_news

if(isset($switch_glance_news_item)) { unset($switch_glance_news_item); } 

?>
  <?php

$news_count = ( isset($this->_tpldata['news.']) ) ?  sizeof($this->_tpldata['news.']) : 0;
for ($news_i = 0; $news_i < $news_count; $news_i++)
{
 $news_item = &$this->_tpldata['news.'][$news_i];
 $news_item['S_ROW_COUNT'] = $news_i;
 $news_item['S_NUM_ROWS'] = $news_count;

?>
  <tr>
    <td class="<?php echo isset($news_item['ROW_CLASS']) ? $news_item['ROW_CLASS'] : ''; ?>" style="text-align: center; width: 40px;"><a href="<?php echo isset($news_item['TOPIC_LINK']) ? $news_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($news_item['BULLET']) ? $news_item['BULLET'] : ''; ?></a></td>
    <?php if ($news_item['ICON_ID'] > 0) {  ?>
    <td class="<?php echo isset($news_item['ROW_CLASS']) ? $news_item['ROW_CLASS'] : ''; ?>" style="text-align: center;"><?php echo isset($news_item['ICON']) ? $news_item['ICON'] : ''; ?></td>
    <td class="<?php echo isset($news_item['ROW_CLASS']) ? $news_item['ROW_CLASS'] : ''; ?>" colspan="2"><a href="<?php echo isset($news_item['TOPIC_LINK']) ? $news_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($news_item['TOPIC_TITLE']) ? $news_item['TOPIC_TITLE'] : ''; ?></a><br /><span class="textmed"><?php echo isset($news_item['TOPIC_POSTER']) ? $news_item['TOPIC_POSTER'] : ''; ?></span></td>
    <?php } else { ?>
    <td class="<?php echo isset($news_item['ROW_CLASS']) ? $news_item['ROW_CLASS'] : ''; ?>" colspan="3"><a href="<?php echo isset($news_item['TOPIC_LINK']) ? $news_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($news_item['TOPIC_TITLE']) ? $news_item['TOPIC_TITLE'] : ''; ?></a><br /><span class="textmed"><?php echo isset($news_item['TOPIC_POSTER']) ? $news_item['TOPIC_POSTER'] : ''; ?></span></td>
    <?php } ?>
    <td class="<?php echo isset($news_item['ROW_CLASS']) ? $news_item['ROW_CLASS'] : ''; ?>" style="text-align: left;"><a<?php echo isset($news_item['FORUM_COLOR']) ? $news_item['FORUM_COLOR'] : ''; ?> href="<?php echo isset($news_item['FORUM_LINK']) ? $news_item['FORUM_LINK'] : ''; ?>"><?php echo isset($news_item['FORUM_TITLE']) ? $news_item['FORUM_TITLE'] : ''; ?></a></td>
    <!-- <td class="row1" style="text-align: left;"></td> --> <!-- <?php echo isset($news_item['TOPIC_POSTER']) ? $news_item['TOPIC_POSTER'] : ''; ?> -->
    <td class="<?php echo isset($news_item['ROW_CLASS']) ? $news_item['ROW_CLASS'] : ''; ?>" style="width: 120px; text-align: center;"><?php echo isset($news_item['TOPIC_REPLIES']) ? $news_item['TOPIC_REPLIES'] : ''; ?></td>
    <td class="<?php echo isset($news_item['ROW_CLASS']) ? $news_item['ROW_CLASS'] : ''; ?> lastpost"><?php echo isset($news_item['LAST_POST_IMG']) ? $news_item['LAST_POST_IMG'] : ''; ?><?php echo isset($news_item['TOPIC_TIME']) ? $news_item['TOPIC_TIME'] : ''; ?><br /><?php echo isset($news_item['LAST_POSTER']) ? $news_item['LAST_POSTER'] : ''; ?></td>
  </tr>
  <?php

} // END news

if(isset($news_item)) { unset($news_item); } 

?>
  <!-- <tr> 
    <td class="spaceRow" colspan="7" style="height: 10px">&nbsp;</td>
  </tr> -->
  <?php

$switch_glance_recent_count = ( isset($this->_tpldata['switch_glance_recent.']) ) ?  sizeof($this->_tpldata['switch_glance_recent.']) : 0;
for ($switch_glance_recent_i = 0; $switch_glance_recent_i < $switch_glance_recent_count; $switch_glance_recent_i++)
{
 $switch_glance_recent_item = &$this->_tpldata['switch_glance_recent.'][$switch_glance_recent_i];
 $switch_glance_recent_item['S_ROW_COUNT'] = $switch_glance_recent_i;
 $switch_glance_recent_item['S_NUM_ROWS'] = $switch_glance_recent_count;

?>
  <tr>
    <td class="catHead">&nbsp;</td>
    <td class="catHead" colspan="3">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
          <td><?php echo isset($this->vars['RECENT_HEADING']) ? $this->vars['RECENT_HEADING'] : $this->lang('RECENT_HEADING'); ?></td>
          <td class="aright"><?php echo isset($switch_glance_recent_item['PREV_URL']) ? $switch_glance_recent_item['PREV_URL'] : ''; ?>&nbsp;&nbsp;<?php echo isset($switch_glance_recent_item['NEXT_URL']) ? $switch_glance_recent_item['NEXT_URL'] : ''; ?>&nbsp;&nbsp;</td>
        </tr>
      </table>
    </td>
    <td class="catHead acenter" style="width: 190px;"><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?></td>
    <td class="catHead acenter" style="width: 50px;"><?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?></td>
    <td class="catHead" style="width: 250px;"><?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?></td>
  </tr>
  <?php

$switch_recent_on_count = ( isset($switch_glance_recent_item['switch_recent_on.']) ) ? sizeof($switch_glance_recent_item['switch_recent_on.']) : 0;
for ($switch_recent_on_i = 0; $switch_recent_on_i < $switch_recent_on_count; $switch_recent_on_i++)
{
 $switch_recent_on_item = &$switch_glance_recent_item['switch_recent_on.'][$switch_recent_on_i];
 $switch_recent_on_item['S_ROW_COUNT'] = $switch_recent_on_i;
 $switch_recent_on_item['S_NUM_ROWS'] = $switch_recent_on_count;

?>
  <tbody id="phpbbGlance_recent">
  <?php

} // END switch_recent_on

if(isset($switch_recent_on_item)) { unset($switch_recent_on_item); } 

?>
  <?php

$switch_recent_off_count = ( isset($switch_glance_recent_item['switch_recent_off.']) ) ? sizeof($switch_glance_recent_item['switch_recent_off.']) : 0;
for ($switch_recent_off_i = 0; $switch_recent_off_i < $switch_recent_off_count; $switch_recent_off_i++)
{
 $switch_recent_off_item = &$switch_glance_recent_item['switch_recent_off.'][$switch_recent_off_i];
 $switch_recent_off_item['S_ROW_COUNT'] = $switch_recent_off_i;
 $switch_recent_off_item['S_NUM_ROWS'] = $switch_recent_off_count;

?>
  <tbody id="phpbbGlance_recent" style="display: none;">
  <?php

} // END switch_recent_off

if(isset($switch_recent_off_item)) { unset($switch_recent_off_item); } 

?>
  <?php

} // END switch_glance_recent

if(isset($switch_glance_recent_item)) { unset($switch_glance_recent_item); } 

?>
  <?php

$recent_count = ( isset($this->_tpldata['recent.']) ) ?  sizeof($this->_tpldata['recent.']) : 0;
for ($recent_i = 0; $recent_i < $recent_count; $recent_i++)
{
 $recent_item = &$this->_tpldata['recent.'][$recent_i];
 $recent_item['S_ROW_COUNT'] = $recent_i;
 $recent_item['S_NUM_ROWS'] = $recent_count;

?>
  <tr>
    <td class="<?php echo isset($recent_item['ROW_CLASS']) ? $recent_item['ROW_CLASS'] : ''; ?>" style="text-align: center; width: 40px;"><a href="<?php echo isset($recent_item['TOPIC_LINK']) ? $recent_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($recent_item['BULLET']) ? $recent_item['BULLET'] : ''; ?></a></td>
    <?php if ($recent_item['ICON_ID'] > 0) {  ?>
    <td class="<?php echo isset($recent_item['ROW_CLASS']) ? $recent_item['ROW_CLASS'] : ''; ?>" style="text-align: center; width: 40px;"><?php echo isset($recent_item['ICON']) ? $recent_item['ICON'] : ''; ?></td>
    <td class="<?php echo isset($recent_item['ROW_CLASS']) ? $recent_item['ROW_CLASS'] : ''; ?>" colspan="2"><a href="<?php echo isset($recent_item['TOPIC_LINK']) ? $recent_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($recent_item['TOPIC_TITLE']) ? $recent_item['TOPIC_TITLE'] : ''; ?></a><br /><span class="textmed"><?php echo isset($recent_item['TOPIC_POSTER']) ? $recent_item['TOPIC_POSTER'] : ''; ?></span></td>
    <?php } else { ?>
    <td class="<?php echo isset($recent_item['ROW_CLASS']) ? $recent_item['ROW_CLASS'] : ''; ?>" colspan="3"><a href="<?php echo isset($recent_item['TOPIC_LINK']) ? $recent_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($recent_item['TOPIC_TITLE']) ? $recent_item['TOPIC_TITLE'] : ''; ?></a><br /><span class="textmed"><?php echo isset($recent_item['TOPIC_POSTER']) ? $recent_item['TOPIC_POSTER'] : ''; ?></span></td>
    <?php } ?>
    <td class="<?php echo isset($recent_item['ROW_CLASS']) ? $recent_item['ROW_CLASS'] : ''; ?>"><a<?php echo isset($recent_item['FORUM_COLOR']) ? $recent_item['FORUM_COLOR'] : ''; ?> href="<?php echo isset($recent_item['FORUM_LINK']) ? $recent_item['FORUM_LINK'] : ''; ?>"><?php echo isset($recent_item['FORUM_TITLE']) ? $recent_item['FORUM_TITLE'] : ''; ?></a></td>
    <td class="<?php echo isset($recent_item['ROW_CLASS']) ? $recent_item['ROW_CLASS'] : ''; ?> acenter"><?php echo isset($recent_item['TOPIC_REPLIES']) ? $recent_item['TOPIC_REPLIES'] : ''; ?></td>
    <td class="<?php echo isset($recent_item['ROW_CLASS']) ? $recent_item['ROW_CLASS'] : ''; ?> lastpost"><?php echo isset($recent_item['LAST_POST_IMG']) ? $recent_item['LAST_POST_IMG'] : ''; ?> <?php echo isset($recent_item['LAST_POST_TIME']) ? $recent_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($recent_item['LAST_POSTER']) ? $recent_item['LAST_POSTER'] : ''; ?></td>
  </tr>
  <?php

} // END recent

if(isset($recent_item)) { unset($recent_item); } 

?>
</table>
<br />