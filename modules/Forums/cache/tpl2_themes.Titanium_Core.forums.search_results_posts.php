<?php

// eXtreme Styles mod cache. Generated on Wed, 21 Dec 2022 14:49:39 +0000 (time=1671634179)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<table border="0" cellpadding="4" cellspacing="1" style="width: 100%">
  <tr> 
    <td><?php echo isset($this->vars['L_SEARCH_MATCHES']) ? $this->vars['L_SEARCH_MATCHES'] : $this->lang('L_SEARCH_MATCHES'); ?></td>
  </tr>
</table>

<table border="0" cellpadding="4" cellspacing="1" style="width: 100%">
  <tr> 
    <td><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>
  </tr>
</table>

<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%">
  <tr> 
    <td class="catHead" style="width:15%" nowrap="nowrap"><?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?></td>
    <td class="catHead" style="width:85%" nowrap="nowrap"><?php echo isset($this->vars['L_MESSAGE']) ? $this->vars['L_MESSAGE'] : $this->lang('L_MESSAGE'); ?></td>
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
    <td class="catHead" colspan="2"><img src="<?php echo isset($searchresults_item['FORUM_FOLDER_IMG']) ? $searchresults_item['FORUM_FOLDER_IMG'] : ''; ?>" />&nbsp;<?php echo isset($this->vars['L_TOPIC']) ? $this->vars['L_TOPIC'] : $this->lang('L_TOPIC'); ?>:&nbsp;<a href="<?php echo isset($searchresults_item['U_TOPIC']) ? $searchresults_item['U_TOPIC'] : ''; ?>" class="topictitle"><?php echo isset($searchresults_item['TOPIC_TITLE']) ? $searchresults_item['TOPIC_TITLE'] : ''; ?></a></td>
  </tr>
  <tr> 
    <td valign="top" class="row1" rowspan="2" style="width:15%">
      <?php echo isset($searchresults_item['POSTER_NAME']) ? $searchresults_item['POSTER_NAME'] : ''; ?><br /><br />
      <?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?>: <?php echo isset($searchresults_item['TOPIC_REPLIES']) ? $searchresults_item['TOPIC_REPLIES'] : ''; ?><br />
      <?php echo isset($this->vars['L_VIEWS']) ? $this->vars['L_VIEWS'] : $this->lang('L_VIEWS'); ?>: <?php echo isset($searchresults_item['TOPIC_VIEWS']) ? $searchresults_item['TOPIC_VIEWS'] : ''; ?>
    </td>
    <td style="width:85%" valign="top" class="row1">
      <img src="<?php echo isset($searchresults_item['MINI_POST_IMG']) ? $searchresults_item['MINI_POST_IMG'] : ''; ?>" width="12" height="9" alt="<?php echo isset($searchresults_item['L_MINI_POST_ALT']) ? $searchresults_item['L_MINI_POST_ALT'] : ''; ?>" title="<?php echo isset($searchresults_item['L_MINI_POST_ALT']) ? $searchresults_item['L_MINI_POST_ALT'] : ''; ?>" border="0" /><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?>:&nbsp;<a href="<?php echo isset($searchresults_item['U_FORUM']) ? $searchresults_item['U_FORUM'] : ''; ?>"><?php echo isset($searchresults_item['FORUM_NAME']) ? $searchresults_item['FORUM_NAME'] : ''; ?></a>&nbsp;<?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?>: <?php echo isset($searchresults_item['POST_DATE']) ? $searchresults_item['POST_DATE'] : ''; ?>&nbsp;<?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?>: <a href="<?php echo isset($searchresults_item['U_POST']) ? $searchresults_item['U_POST'] : ''; ?>"><?php echo isset($searchresults_item['POST_SUBJECT']) ? $searchresults_item['POST_SUBJECT'] : ''; ?></a></td>
  </tr>
  <tr>
    <td valign="top" class="row1"><span class="postbody"><?php echo isset($searchresults_item['MESSAGE']) ? $searchresults_item['MESSAGE'] : ''; ?></span></td>
  </tr>
  <?php

} // END searchresults

if(isset($searchresults_item)) { unset($searchresults_item); } 

?>
  <tr> 
    <td class="catBottom" colspan="2" height="28" align="center">&nbsp; </td>
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
