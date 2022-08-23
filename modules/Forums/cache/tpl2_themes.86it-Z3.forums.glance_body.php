<?php

// eXtreme Styles mod cache. Generated on Wed, 14 Apr 2021 11:42:55 +0000 (time=1618400575)

?><span class="gen"><br /></span>
<table width="<?php echo isset($this->vars['GLANCE_TABLE_WIDTH']) ? $this->vars['GLANCE_TABLE_WIDTH'] : $this->lang('GLANCE_TABLE_WIDTH'); ?>" cellpadding="2" cellspacing="1" border="0" class="forumline" align="center">
    <?php

$switch_glance_news_count = ( isset($this->_tpldata['switch_glance_news.']) ) ?  sizeof($this->_tpldata['switch_glance_news.']) : 0;
for ($switch_glance_news_i = 0; $switch_glance_news_i < $switch_glance_news_count; $switch_glance_news_i++)
{
 $switch_glance_news_item = &$this->_tpldata['switch_glance_news.'][$switch_glance_news_i];
 $switch_glance_news_item['S_ROW_COUNT'] = $switch_glance_news_i;
 $switch_glance_news_item['S_NUM_ROWS'] = $switch_glance_news_count;

?>
    <tr>
        <th class="thCornerL" height="28" align="center" width="30">
            +
        </th>
        <th class="thTop" height="28" align="left">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><th align="left">
                <?php echo isset($this->vars['NEWS_HEADING']) ? $this->vars['NEWS_HEADING'] : $this->lang('NEWS_HEADING'); ?>
                </th>
                <th align="right">
                    <?php echo isset($switch_glance_news_item['PREV_URL']) ? $switch_glance_news_item['PREV_URL'] : ''; ?>&nbsp;&nbsp;<?php echo isset($switch_glance_news_item['NEXT_URL']) ? $switch_glance_news_item['NEXT_URL'] : ''; ?>&nbsp;&nbsp;
                </th>
            </tr>
            </table>
        </th>
        <th class="fixcell" width="100" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?>&nbsp;</th>
        <th class="fixcell" width="100" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?>&nbsp;</th>
        <th class="fixcell" width="50" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?>&nbsp;</th>
        <th class="fixcell" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?>&nbsp;</th>
    </tr>

    <?php

$switch_news_on_count = ( isset($switch_glance_news_item['switch_news_on.']) ) ? sizeof($switch_glance_news_item['switch_news_on.']) : 0;
for ($switch_news_on_i = 0; $switch_news_on_i < $switch_news_on_count; $switch_news_on_i++)
{
 $switch_news_on_item = &$switch_glance_news_item['switch_news_on.'][$switch_news_on_i];
 $switch_news_on_item['S_ROW_COUNT'] = $switch_news_on_i;
 $switch_news_on_item['S_NUM_ROWS'] = $switch_news_on_count;

?>
    <tbody id="phpbbGlance_news" style="display: ;">
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
        <td nowrap="nowrap" valign="middle" class="row1" align="center" width="30"><a href="<?php echo isset($news_item['TOPIC_LINK']) ? $news_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($news_item['BULLET']) ? $news_item['BULLET'] : ''; ?></a></td>
        <td valign="middle" width="100%" class="row1" onmouseover="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/block.png)'" onmouseout="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/b.png)'"><span class="genmed"><a href="<?php echo isset($news_item['TOPIC_LINK']) ? $news_item['TOPIC_LINK'] : ''; ?>" class="genmed"><?php echo isset($news_item['TOPIC_TITLE']) ? $news_item['TOPIC_TITLE'] : ''; ?></a></span></td>
        <td valign="middle" class="row2" nowrap="nowrap" align="center"><span class="genmed"><a href="<?php echo isset($news_item['FORUM_LINK']) ? $news_item['FORUM_LINK'] : ''; ?>" class="genmed"><?php echo isset($news_item['FORUM_TITLE']) ? $news_item['FORUM_TITLE'] : ''; ?></a></span></td>
        <td valign="middle" class="row3" nowrap="nowrap" align="center"><span class="genmed"><?php echo isset($news_item['TOPIC_POSTER']) ? $news_item['TOPIC_POSTER'] : ''; ?></span></td>
        <td valign="middle" class="row2" nowrap="nowrap" align="center"><span class="genmed"><?php echo isset($news_item['TOPIC_REPLIES']) ? $news_item['TOPIC_REPLIES'] : ''; ?></span></td>
        <td valign="middle" class="row3" nowrap="nowrap" align="center"><span class="genmed"><?php echo isset($news_item['TOPIC_TIME']) ? $news_item['TOPIC_TIME'] : ''; ?><br /><?php echo isset($news_item['LAST_POSTER']) ? $news_item['LAST_POSTER'] : ''; ?></span></td>
    </tr>
    <?php

} // END news

if(isset($news_item)) { unset($news_item); } 

?>

    <tr> 
        <td class="spaceRow" colspan="6" height="1"><img src="themes/86it-Z3/forums/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>

    <?php

$switch_glance_recent_count = ( isset($this->_tpldata['switch_glance_recent.']) ) ?  sizeof($this->_tpldata['switch_glance_recent.']) : 0;
for ($switch_glance_recent_i = 0; $switch_glance_recent_i < $switch_glance_recent_count; $switch_glance_recent_i++)
{
 $switch_glance_recent_item = &$this->_tpldata['switch_glance_recent.'][$switch_glance_recent_i];
 $switch_glance_recent_item['S_ROW_COUNT'] = $switch_glance_recent_i;
 $switch_glance_recent_item['S_NUM_ROWS'] = $switch_glance_recent_count;

?>
    <tr>
        <th class="thCornerL" height="28" align="center" width="30">&nbsp;

        </th>
        <th class="thTop" height="28" align="left">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><th align="left">
                <?php echo isset($this->vars['RECENT_HEADING']) ? $this->vars['RECENT_HEADING'] : $this->lang('RECENT_HEADING'); ?>
                </th>
                <th align="right">
                    <?php echo isset($switch_glance_recent_item['PREV_URL']) ? $switch_glance_recent_item['PREV_URL'] : ''; ?>&nbsp;&nbsp;<?php echo isset($switch_glance_recent_item['NEXT_URL']) ? $switch_glance_recent_item['NEXT_URL'] : ''; ?>&nbsp;&nbsp;
                </th>
            </tr>
            </table>
        </th>
        <th class="fixcell" width="100" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?>&nbsp;</th>
        <th class="fixcell" width="100" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?>&nbsp;</th>
        <th class="fixcell" width="50" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?>&nbsp;</th>
        <th class="fixcell" align="center" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?>&nbsp;</th>
    </tr>

    <?php

$switch_recent_on_count = ( isset($switch_glance_recent_item['switch_recent_on.']) ) ? sizeof($switch_glance_recent_item['switch_recent_on.']) : 0;
for ($switch_recent_on_i = 0; $switch_recent_on_i < $switch_recent_on_count; $switch_recent_on_i++)
{
 $switch_recent_on_item = &$switch_glance_recent_item['switch_recent_on.'][$switch_recent_on_i];
 $switch_recent_on_item['S_ROW_COUNT'] = $switch_recent_on_i;
 $switch_recent_on_item['S_NUM_ROWS'] = $switch_recent_on_count;

?>
    <tbody id="phpbbGlance_recent" style="display: ;">
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
        <td nowrap="nowrap" valign="middle" class="row1" align="center" width="30"><a href="<?php echo isset($recent_item['TOPIC_LINK']) ? $recent_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($recent_item['BULLET']) ? $recent_item['BULLET'] : ''; ?></a></td>
        <td valign="middle" width="100%" class="row1" onmouseover="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/block.png)'" onmouseout="this.style.backgroundImage='url(../themes/86it-Z3/images/backgrounds/b.png)'"><span class="genmed"><a href="<?php echo isset($recent_item['TOPIC_LINK']) ? $recent_item['TOPIC_LINK'] : ''; ?>" class="genmed"><?php echo isset($recent_item['TOPIC_TITLE']) ? $recent_item['TOPIC_TITLE'] : ''; ?></a></span></td>
        <td valign="middle" class="row2" nowrap="nowrap" align="center"><span class="genmed"><a href="<?php echo isset($recent_item['FORUM_LINK']) ? $recent_item['FORUM_LINK'] : ''; ?>" class="genmed"><?php echo isset($recent_item['FORUM_TITLE']) ? $recent_item['FORUM_TITLE'] : ''; ?></a></span></td>
        <td valign="middle" class="row3" nowrap="nowrap" align="center"><span class="genmed"><?php echo isset($recent_item['TOPIC_POSTER']) ? $recent_item['TOPIC_POSTER'] : ''; ?></span></td>
        <td valign="middle" class="row2" nowrap="nowrap" align="center"><span class="genmed"><?php echo isset($recent_item['TOPIC_REPLIES']) ? $recent_item['TOPIC_REPLIES'] : ''; ?></span></td>
        <td valign="middle" class="row3" nowrap="nowrap" align="center"><span class="genmed"><?php echo isset($recent_item['LAST_POST_TIME']) ? $recent_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($recent_item['LAST_POSTER']) ? $recent_item['LAST_POSTER'] : ''; ?></span></td>
    </tr>
    <?php

} // END recent

if(isset($recent_item)) { unset($recent_item); } 

?>
</table>
<span class="gen"><br /></span>