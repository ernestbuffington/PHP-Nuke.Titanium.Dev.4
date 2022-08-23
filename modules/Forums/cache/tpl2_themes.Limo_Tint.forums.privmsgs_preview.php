<?php

// eXtreme Styles mod cache. Generated on Tue, 06 Apr 2021 05:36:17 +0000 (time=1617687377)

?><table border="0" cellpadding="4" cellspacing="1" style="width: 100%; table-layout: fixed" class="forumline">
  <tr> 
    <td class="catHead" colspan="2" style="height: 25px; text-align: center"><?php echo isset($this->vars['L_PREVIEW']) ? $this->vars['L_PREVIEW'] : $this->lang('L_PREVIEW'); ?></td>
  </tr>
  <tr> 
    <td class="row1" style="width: 20%; text-align: right;"><?php echo isset($this->vars['L_FROM']) ? $this->vars['L_FROM'] : $this->lang('L_FROM'); ?></td>
    <td class="row1" style="width: 80%"><?php echo isset($this->vars['MESSAGE_FROM']) ? $this->vars['MESSAGE_FROM'] : $this->lang('MESSAGE_FROM'); ?></td>
  </tr>
  <tr> 
    <td class="row1" style="width: 20%; text-align: right;"><?php echo isset($this->vars['L_TO']) ? $this->vars['L_TO'] : $this->lang('L_TO'); ?></td>
    <td class="row1" style="width: 80%"><?php echo isset($this->vars['MESSAGE_TO']) ? $this->vars['MESSAGE_TO'] : $this->lang('MESSAGE_TO'); ?></td>
  </tr>
  <tr> 
    <td class="row1" style="width: 20%; text-align: right;"><?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?></td>
    <td class="row1" style="width: 80%"><?php echo isset($this->vars['POST_DATE']) ? $this->vars['POST_DATE'] : $this->lang('POST_DATE'); ?></td>
  </tr>
  <tr> 
    <td class="row1" style="width: 20%; text-align: right;"><?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?></td>
    <td class="row1" style="width: 80%"><?php echo isset($this->vars['POST_SUBJECT']) ? $this->vars['POST_SUBJECT'] : $this->lang('POST_SUBJECT'); ?></td>
  </tr>
  <tr> 
    <td valign="top" colspan="2" class="row1"><span class="postbody"><?php echo isset($this->vars['MESSAGE']) ? $this->vars['MESSAGE'] : $this->lang('MESSAGE'); ?></span><?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?><?php echo isset($this->vars['ATTACHMENTS']) ? $this->vars['ATTACHMENTS'] : $this->lang('ATTACHMENTS'); ?> <?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?></td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" style="height: 25px">&nbsp;</td>
  </tr>
</table>
<br />