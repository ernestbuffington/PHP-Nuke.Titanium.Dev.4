<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 18:36:12 +0000 (time=1672338972)

?><form name="status" action="<?php echo isset($this->vars['S_ACTION']) ? $this->vars['S_ACTION'] : $this->lang('S_ACTION'); ?>" method="post">
<table border="0" cellpadding="4" cellspacing="1" style="width: 100%">
    <tr> 
        <td><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>
        <td align="right" nowrap="nowrap">
          <select name="status">
            <option value="1"<?php echo isset($this->vars['S_OPEN']) ? $this->vars['S_OPEN'] : $this->lang('S_OPEN'); ?>><?php echo isset($this->vars['L_OPENED']) ? $this->vars['L_OPENED'] : $this->lang('L_OPENED'); ?></option>
            <option value="2"<?php echo isset($this->vars['S_CLOSED']) ? $this->vars['S_CLOSED'] : $this->lang('S_CLOSED'); ?>><?php echo isset($this->vars['L_CLOSED']) ? $this->vars['L_CLOSED'] : $this->lang('L_CLOSED'); ?></option>
            <option value="all"<?php echo isset($this->vars['S_ALL']) ? $this->vars['S_ALL'] : $this->lang('S_ALL'); ?>><?php echo isset($this->vars['L_ALL']) ? $this->vars['L_ALL'] : $this->lang('L_ALL'); ?></option>
          </select>&nbsp;<input type="submit" name="submit" value="<?php echo isset($this->vars['L_DISPLAY']) ? $this->vars['L_DISPLAY'] : $this->lang('L_DISPLAY'); ?>" class="titaniumbutton" />
        </td>
    </tr>
</table>
</form>

<form action="<?php echo isset($this->vars['S_ACTION']) ? $this->vars['S_ACTION'] : $this->lang('S_ACTION'); ?>" method="post">
<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%">
  <tr>
    <td class="catHead acenter" height="25"><?php echo isset($this->vars['L_ACTION']) ? $this->vars['L_ACTION'] : $this->lang('L_ACTION'); ?></td>
    <td class="catHead acenter"><?php echo isset($this->vars['L_POST']) ? $this->vars['L_POST'] : $this->lang('L_POST'); ?></td>
    <td class="catHead acenter"><?php echo isset($this->vars['L_COMMENTS']) ? $this->vars['L_COMMENTS'] : $this->lang('L_COMMENTS'); ?></td>
    <td class="catHead acenter"><?php echo isset($this->vars['L_STATUS']) ? $this->vars['L_STATUS'] : $this->lang('L_STATUS'); ?></td>
    <td class="catHead acenter"><?php echo isset($this->vars['L_LAST_ACTION_COMMENTS']) ? $this->vars['L_LAST_ACTION_COMMENTS'] : $this->lang('L_LAST_ACTION_COMMENTS'); ?></td>
  </tr>
  <?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?>
  <tr>
    <td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?> acenter" width="40"><input type="checkbox" name="p[]" value="<?php echo isset($postrow_item['REPORT_ID']) ? $postrow_item['REPORT_ID'] : ''; ?>" />&nbsp;<a href="<?php echo isset($postrow_item['U_CLOSE_REPORT']) ? $postrow_item['U_CLOSE_REPORT'] : ''; ?>"><?php echo isset($postrow_item['L_CLOSE_REPORT']) ? $postrow_item['L_CLOSE_REPORT'] : ''; ?></a></td>
    <td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" width="200"><a href="<?php echo isset($postrow_item['U_VIEW_POST']) ? $postrow_item['U_VIEW_POST'] : ''; ?>" class="topictitle"><?php echo isset($postrow_item['TOPIC_TITLE']) ? $postrow_item['TOPIC_TITLE'] : ''; ?></a><br /><?php echo isset($postrow_item['FORUM']) ? $postrow_item['FORUM'] : ''; ?></td>
    <td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" width="350"><?php echo isset($postrow_item['REPORTER']) ? $postrow_item['REPORTER'] : ''; ?> <em>(<?php echo isset($postrow_item['DATE']) ? $postrow_item['DATE'] : ''; ?>)</em><br /><hr /><?php echo isset($postrow_item['COMMENTS']) ? $postrow_item['COMMENTS'] : ''; ?></td>
    <td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?> acenter" width="130"><?php echo isset($postrow_item['LAST_ACTION']) ? $postrow_item['LAST_ACTION'] : ''; ?></td>
    <td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?> acenter" width="300"><?php echo isset($postrow_item['LAST_ACTION_COMMENTS']) ? $postrow_item['LAST_ACTION_COMMENTS'] : ''; ?></td>
  </tr>
  <?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?>
  <!-- <tr>
    <td class="catbottom acenter" colspan="5"><?php echo isset($this->vars['DELETED_REPORTS']) ? $this->vars['DELETED_REPORTS'] : $this->lang('DELETED_REPORTS'); ?></td>
  </tr> -->
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td align="left">
            <span class="genmed">
            <select name="mode">
                <option value=""><?php echo isset($this->vars['L_SELECT_ONE']) ? $this->vars['L_SELECT_ONE'] : $this->lang('L_SELECT_ONE'); ?></option>
                <option value="close"><?php echo isset($this->vars['L_CLOSE']) ? $this->vars['L_CLOSE'] : $this->lang('L_CLOSE'); ?></option>
                <option value="open"><?php echo isset($this->vars['L_OPEN']) ? $this->vars['L_OPEN'] : $this->lang('L_OPEN'); ?></option>
                <option value="delete"><?php echo isset($this->vars['L_DELETE']) ? $this->vars['L_DELETE'] : $this->lang('L_DELETE'); ?></option>
            </select>&nbsp;
            <input type="submit" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" class="mainoption" /> 
            </span>
        </td>
        <td align="right" nowrap="nowrap">
            <span class="genmed"><a href="<?php echo isset($this->vars['U_OPT_OUT']) ? $this->vars['U_OPT_OUT'] : $this->lang('U_OPT_OUT'); ?>"><?php echo isset($this->vars['L_OPT_OUT']) ? $this->vars['L_OPT_OUT'] : $this->lang('L_OPT_OUT'); ?></a></span>
        </td>
    </tr>
</table>
</form>