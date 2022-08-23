<?php

// eXtreme Styles mod cache. Generated on Sat, 29 May 2021 21:54:25 +0000 (time=1622325265)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left" valign="bottom"><span class="maintitle"><?php echo isset($this->vars['L_SEARCH_MATCHES']) ? $this->vars['L_SEARCH_MATCHES'] : $this->lang('L_SEARCH_MATCHES'); ?></span><br /></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
  <tr> 
    <th width="4%" height="25" class="thCornerL" nowrap="nowrap">&nbsp;</th>
    <th class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?>&nbsp;</th>
    <th class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?>&nbsp;</th>
    <th class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?>&nbsp;</th>
    <th class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?>&nbsp;</th>
    <th class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_VIEWS']) ? $this->vars['L_VIEWS'] : $this->lang('L_VIEWS'); ?>&nbsp;</th>
    <th class="thCornerR" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?>&nbsp;</th>
  </tr>
  <?php

$searchresults_count = ( isset($this->_tpldata['searchresults.']) ) ?  sizeof($this->_tpldata['searchresults.']) : 0;
for ($searchresults_i = 0; $searchresults_i < $searchresults_count; $searchresults_i++)
{
 $searchresults_item = &$this->_tpldata['searchresults.'][$searchresults_i];
 $searchresults_item['S_ROW_COUNT'] = $searchresults_i;
 $searchresults_item['S_NUM_ROWS'] = $searchresults_count;

?>
  <tr> 
    <td class="row1" align="center" valign="middle"><img src="<?php echo isset($searchresults_item['TOPIC_FOLDER_IMG']) ? $searchresults_item['TOPIC_FOLDER_IMG'] : ''; ?>" width="19" height="18" alt="<?php echo isset($searchresults_item['L_TOPIC_FOLDER_ALT']) ? $searchresults_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" title="<?php echo isset($searchresults_item['L_TOPIC_FOLDER_ALT']) ? $searchresults_item['L_TOPIC_FOLDER_ALT'] : ''; ?>" /></td>
    <td class="row1"><span class="forumlink"><a href="<?php echo isset($searchresults_item['U_VIEW_FORUM']) ? $searchresults_item['U_VIEW_FORUM'] : ''; ?>" class="forumlink"><?php echo isset($searchresults_item['FORUM_NAME']) ? $searchresults_item['FORUM_NAME'] : ''; ?></a></span></td>
    <td class="row2"><span class="topictitle"><?php echo isset($searchresults_item['NEWEST_POST_IMG']) ? $searchresults_item['NEWEST_POST_IMG'] : ''; ?><?php echo isset($searchresults_item['TOPIC_TYPE']) ? $searchresults_item['TOPIC_TYPE'] : ''; ?><a href="<?php echo isset($searchresults_item['U_VIEW_TOPIC']) ? $searchresults_item['U_VIEW_TOPIC'] : ''; ?>" class="topictitle"><?php echo isset($searchresults_item['TOPIC_TITLE']) ? $searchresults_item['TOPIC_TITLE'] : ''; ?></a></span><br /><span class="gensmall"><?php echo isset($searchresults_item['GOTO_PAGE']) ? $searchresults_item['GOTO_PAGE'] : ''; ?></span></td>
    <td class="row1" align="center" valign="middle"><span class="name"><?php echo isset($searchresults_item['TOPIC_AUTHOR']) ? $searchresults_item['TOPIC_AUTHOR'] : ''; ?></span></td>
    <td class="row2" align="center" valign="middle"><span class="postdetails"><?php echo isset($searchresults_item['REPLIES']) ? $searchresults_item['REPLIES'] : ''; ?></span></td>
    <td class="row1" align="center" valign="middle"><span class="postdetails"><?php echo isset($searchresults_item['VIEWS']) ? $searchresults_item['VIEWS'] : ''; ?></span></td>
    <td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails"><?php echo isset($searchresults_item['LAST_POST_TIME']) ? $searchresults_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($searchresults_item['LAST_POST_AUTHOR']) ? $searchresults_item['LAST_POST_AUTHOR'] : ''; ?> <?php echo isset($searchresults_item['LAST_POST_IMG']) ? $searchresults_item['LAST_POST_IMG'] : ''; ?></span></td>
  </tr>
  <?php

} // END searchresults

if(isset($searchresults_item)) { unset($searchresults_item); } 

?>
  <tr> 
    <td class="catBottom" colspan="7" height="28" valign="middle">&nbsp; </td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td align="left" valign="top"><span class="nav"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></span></td>
    <td align="right" valign="top" nowrap="nowrap"><span class="nav"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></span><br /><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>

</tr>
</tbody>
</table>
</div>
