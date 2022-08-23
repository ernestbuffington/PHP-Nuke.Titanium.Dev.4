<?php

// eXtreme Styles mod cache. Generated on Tue, 14 Dec 2021 11:33:27 +0000 (time=1639481607)

?><table class="forumline" width="100%" cellspacing="1" cellpadding="4" border="0">
  <tr> 
    <td class="catHead" style="height: 25px; text-align: center;"><?php echo isset($this->vars['L_PREVIEW']) ? $this->vars['L_PREVIEW'] : $this->lang('L_PREVIEW'); ?></th>
  </tr>
  <tr> 
    <td class="row1"><img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/icon_minipost.gif" alt="<?php echo isset($this->vars['L_POST']) ? $this->vars['L_POST'] : $this->lang('L_POST'); ?>" /><span class="postdetails"><?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?>: <?php echo isset($this->vars['POST_DATE']) ? $this->vars['POST_DATE'] : $this->lang('POST_DATE'); ?> &nbsp;&nbsp;&nbsp; <?php echo isset($this->vars['L_POST_SUBJECT']) ? $this->vars['L_POST_SUBJECT'] : $this->lang('L_POST_SUBJECT'); ?>: <?php echo isset($this->vars['POST_SUBJECT']) ? $this->vars['POST_SUBJECT'] : $this->lang('POST_SUBJECT'); ?></span></td>
  </tr>
  <tr> 
    <td class="row1">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tfixed clear">
        <tr>
          <td><span class="postbody"><?php echo isset($this->vars['MESSAGE']) ? $this->vars['MESSAGE'] : $this->lang('MESSAGE'); ?></span><?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?><?php echo isset($this->vars['ATTACHMENTS']) ? $this->vars['ATTACHMENTS'] : $this->lang('ATTACHMENTS'); ?><?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td class="spaceRow" height="1"><img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<br />