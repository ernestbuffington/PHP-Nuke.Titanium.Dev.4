<?php

// eXtreme Styles mod cache. Generated on Mon, 31 Oct 2022 22:25:52 +0000 (time=1667255152)

?>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="3" class="forumline">
	<tr>
		<td colspan="6" class="catHead"><span class="cattitle"><?php echo isset($this->vars['L_RELATED_TOPICS']) ? $this->vars['L_RELATED_TOPICS'] : $this->lang('L_RELATED_TOPICS'); ?></span></td>
	</tr>
	<tr>
		<th colspan="2" align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?>&nbsp;</th>
		<th width="50" align="center" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?>&nbsp;</th>
		<th width="100" align="center" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?>&nbsp;</th>
		<th width="50" align="center" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_VIEWS']) ? $this->vars['L_VIEWS'] : $this->lang('L_VIEWS'); ?>&nbsp;</th>
		<th width="180" align="center" class="thCornerR" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?>&nbsp;</th>
	</tr>
	<?php

$topicrow_count = ( isset($this->_tpldata['topicrow.']) ) ?  sizeof($this->_tpldata['topicrow.']) : 0;
for ($topicrow_i = 0; $topicrow_i < $topicrow_count; $topicrow_i++)
{
 $topicrow_item = &$this->_tpldata['topicrow.'][$topicrow_i];
 $topicrow_item['S_ROW_COUNT'] = $topicrow_i;
 $topicrow_item['S_NUM_ROWS'] = $topicrow_count;

?>
	<tr>
		<td class="row1" align="center" valign="middle" width="20"><img src="<?php echo isset($topicrow_item['TOPIC_FOLDER_IMG']) ? $topicrow_item['TOPIC_FOLDER_IMG'] : ''; ?>" alt="<?php echo isset($topicrow_item['L_TOPIC_FOLDER_ALT']) ? $topicrow_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" title="<?php echo isset($topicrow_item['L_TOPIC_FOLDER_ALT']) ? $topicrow_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" /></td>
		<td class="row1"><span class="topictitle"><?php echo isset($topicrow_item['NEWEST_POST_IMG']) ? $topicrow_item['NEWEST_POST_IMG'] : ''; ?><?php echo isset($topicrow_item['TOPIC_TYPE']) ? $topicrow_item['TOPIC_TYPE'] : ''; ?><a href="<?php echo isset($topicrow_item['U_VIEW_TOPIC']) ? $topicrow_item['U_VIEW_TOPIC'] : ''; ?>" class="topictitle"><?php echo isset($topicrow_item['TOPIC_TITLE']) ? $topicrow_item['TOPIC_TITLE'] : ''; ?></a></span></td>
		<td class="row2" align="center" valign="middle"><span class="postdetails"><?php echo isset($topicrow_item['REPLIES']) ? $topicrow_item['REPLIES'] : ''; ?></span></td>
		<td class="row3" align="center" valign="middle"><span class="name"><?php echo isset($topicrow_item['TOPIC_AUTHOR']) ? $topicrow_item['TOPIC_AUTHOR'] : ''; ?></span></td>
		<td class="row2" align="center" valign="middle"><span class="postdetails"><?php echo isset($topicrow_item['VIEWS']) ? $topicrow_item['VIEWS'] : ''; ?></span></td>
		<td class="row3Right" align="center" valign="middle" nowrap="nowrap"><span class="postdetails"><?php echo isset($topicrow_item['LAST_POST_TIME']) ? $topicrow_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($topicrow_item['LAST_POST_AUTHOR']) ? $topicrow_item['LAST_POST_AUTHOR'] : ''; ?> <?php echo isset($topicrow_item['LAST_POST_IMG']) ? $topicrow_item['LAST_POST_IMG'] : ''; ?></span></td>
	</tr>
	<?php

} // END topicrow

if(isset($topicrow_item)) { unset($topicrow_item); } 

?>
	<tr>
		<td class="catBottom" align="center" valign="middle" colspan="6" height="28">&nbsp;</td>
	</tr>
</table>
