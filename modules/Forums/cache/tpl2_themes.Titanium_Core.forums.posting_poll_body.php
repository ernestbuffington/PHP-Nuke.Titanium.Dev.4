<?php

// eXtreme Styles mod cache. Generated on Wed, 02 Jun 2021 09:20:57 +0000 (time=1622625657)

?>  <tr>
    <td class="catHead" colspan="2" style="text-align: center;"><?php echo isset($this->vars['L_ADD_A_POLL']) ? $this->vars['L_ADD_A_POLL'] : $this->lang('L_ADD_A_POLL'); ?></td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="text-align: center;"><?php echo isset($this->vars['L_ADD_POLL_EXPLAIN']) ? $this->vars['L_ADD_POLL_EXPLAIN'] : $this->lang('L_ADD_POLL_EXPLAIN'); ?></td>
  </tr>
  <tr>
    <td class="row1"><?php echo isset($this->vars['L_POLL_QUESTION']) ? $this->vars['L_POLL_QUESTION'] : $this->lang('L_POLL_QUESTION'); ?></td>
    <td class="row2"><input type="text" name="poll_title" size="50" maxlength="255" class="post" value="<?php echo isset($this->vars['POLL_TITLE']) ? $this->vars['POLL_TITLE'] : $this->lang('POLL_TITLE'); ?>" /></td>
  </tr>
  <?php

$poll_option_rows_count = ( isset($this->_tpldata['poll_option_rows.']) ) ?  sizeof($this->_tpldata['poll_option_rows.']) : 0;
for ($poll_option_rows_i = 0; $poll_option_rows_i < $poll_option_rows_count; $poll_option_rows_i++)
{
 $poll_option_rows_item = &$this->_tpldata['poll_option_rows.'][$poll_option_rows_i];
 $poll_option_rows_item['S_ROW_COUNT'] = $poll_option_rows_i;
 $poll_option_rows_item['S_NUM_ROWS'] = $poll_option_rows_count;

?>
  <tr>
    <td class="row1"><?php echo isset($this->vars['L_POLL_OPTION']) ? $this->vars['L_POLL_OPTION'] : $this->lang('L_POLL_OPTION'); ?></td>
    <td class="row2"><input type="text" name="poll_option_text[<?php echo isset($poll_option_rows_item['S_POLL_OPTION_NUM']) ? $poll_option_rows_item['S_POLL_OPTION_NUM'] : ''; ?>]" size="50" class="post" maxlength="255" value="<?php echo isset($poll_option_rows_item['POLL_OPTION']) ? $poll_option_rows_item['POLL_OPTION'] : ''; ?>" /> &nbsp;<input type="submit" name="edit_poll_option" value="<?php echo isset($this->vars['L_UPDATE_OPTION']) ? $this->vars['L_UPDATE_OPTION'] : $this->lang('L_UPDATE_OPTION'); ?>" class="liteoption" /> <input type="submit" name="del_poll_option[<?php echo isset($poll_option_rows_item['S_POLL_OPTION_NUM']) ? $poll_option_rows_item['S_POLL_OPTION_NUM'] : ''; ?>]" value="<?php echo isset($this->vars['L_DELETE_OPTION']) ? $this->vars['L_DELETE_OPTION'] : $this->lang('L_DELETE_OPTION'); ?>" class="liteoption" /></td>
  </tr>
  <?php

} // END poll_option_rows

if(isset($poll_option_rows_item)) { unset($poll_option_rows_item); } 

?>
  <tr>
    <td class="row1"><?php echo isset($this->vars['L_POLL_OPTION']) ? $this->vars['L_POLL_OPTION'] : $this->lang('L_POLL_OPTION'); ?></td>
    <td class="row2"><input type="text" name="add_poll_option_text" size="50" maxlength="255" class="post" value="<?php echo isset($this->vars['ADD_POLL_OPTION']) ? $this->vars['ADD_POLL_OPTION'] : $this->lang('ADD_POLL_OPTION'); ?>" /> &nbsp;<input type="submit" name="add_poll_option" value="<?php echo isset($this->vars['L_ADD_OPTION']) ? $this->vars['L_ADD_OPTION'] : $this->lang('L_ADD_OPTION'); ?>" class="liteoption" /></td>
  </tr>
  <tr>
    <td class="row1"><?php echo isset($this->vars['L_POLL_LENGTH']) ? $this->vars['L_POLL_LENGTH'] : $this->lang('L_POLL_LENGTH'); ?></td>
    <td class="row2"><input type="text" name="poll_length" size="3" maxlength="3" class="post" value="<?php echo isset($this->vars['POLL_LENGTH']) ? $this->vars['POLL_LENGTH'] : $this->lang('POLL_LENGTH'); ?>" />&nbsp;<?php echo isset($this->vars['L_DAYS']) ? $this->vars['L_DAYS'] : $this->lang('L_DAYS'); ?>&nbsp;<?php echo isset($this->vars['L_POLL_LENGTH_EXPLAIN']) ? $this->vars['L_POLL_LENGTH_EXPLAIN'] : $this->lang('L_POLL_LENGTH_EXPLAIN'); ?></td>
  </tr>
  <tr>
    <td class="row1"><?php echo isset($this->vars['L_POLL_TOGGLE']) ? $this->vars['L_POLL_TOGGLE'] : $this->lang('L_POLL_TOGGLE'); ?></td>
    <td class="row2"><input type="checkbox" name="poll_view_toggle" value="1" <?php echo isset($this->vars['POLL_TOGGLE_CHECKED']) ? $this->vars['POLL_TOGGLE_CHECKED'] : $this->lang('POLL_TOGGLE_CHECKED'); ?> />&nbsp;<?php echo isset($this->vars['L_POLL_TOGGLE_EXPLAIN']) ? $this->vars['L_POLL_TOGGLE_EXPLAIN'] : $this->lang('L_POLL_TOGGLE_EXPLAIN'); ?></td>
  </tr>
  <?php

$switch_poll_delete_toggle_count = ( isset($this->_tpldata['switch_poll_delete_toggle.']) ) ?  sizeof($this->_tpldata['switch_poll_delete_toggle.']) : 0;
for ($switch_poll_delete_toggle_i = 0; $switch_poll_delete_toggle_i < $switch_poll_delete_toggle_count; $switch_poll_delete_toggle_i++)
{
 $switch_poll_delete_toggle_item = &$this->_tpldata['switch_poll_delete_toggle.'][$switch_poll_delete_toggle_i];
 $switch_poll_delete_toggle_item['S_ROW_COUNT'] = $switch_poll_delete_toggle_i;
 $switch_poll_delete_toggle_item['S_NUM_ROWS'] = $switch_poll_delete_toggle_count;

?>
  <tr>
    <td class="row1"><?php echo isset($this->vars['L_POLL_DELETE']) ? $this->vars['L_POLL_DELETE'] : $this->lang('L_POLL_DELETE'); ?></td>
    <td class="row2"><input type="checkbox" name="poll_delete" /></td>
  </tr>
  <?php

} // END switch_poll_delete_toggle

if(isset($switch_poll_delete_toggle_item)) { unset($switch_poll_delete_toggle_item); } 

?>