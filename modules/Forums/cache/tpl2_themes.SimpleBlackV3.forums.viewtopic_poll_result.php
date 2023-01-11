<?php

// eXtreme Styles mod cache. Generated on Wed, 21 Dec 2022 15:52:00 +0000 (time=1671637920)

?><tr> 
  <td class="row2" colspan="2"><br />
    <table cellspacing="0" cellpadding="4" border="0" style="margin: auto">
      <tr> 
        <td colspan="4" align="center"><?php echo isset($this->vars['POLL_QUESTION']) ? $this->vars['POLL_QUESTION'] : $this->lang('POLL_QUESTION'); ?></td>
      </tr>
      <?php

$poll_option_count = ( isset($this->_tpldata['poll_option.']) ) ?  sizeof($this->_tpldata['poll_option.']) : 0;
for ($poll_option_i = 0; $poll_option_i < $poll_option_count; $poll_option_i++)
{
 $poll_option_item = &$this->_tpldata['poll_option.'][$poll_option_i];
 $poll_option_item['S_ROW_COUNT'] = $poll_option_i;
 $poll_option_item['S_NUM_ROWS'] = $poll_option_count;

?>
      <tr>
        <td>[ <?php echo isset($poll_option_item['POLL_OPTION_RESULT']) ? $poll_option_item['POLL_OPTION_RESULT'] : ''; ?> ]&nbsp;[ <?php echo isset($poll_option_item['POLL_OPTION_PERCENT_VALUE']) ? $poll_option_item['POLL_OPTION_PERCENT_VALUE'] : ''; ?> ]&nbsp;<?php echo isset($poll_option_item['POLL_OPTION_CAPTION']) ? $poll_option_item['POLL_OPTION_CAPTION'] : ''; ?> <br /><?php echo isset($poll_option_item['POLL_PROGRESS_BAR']) ? $poll_option_item['POLL_PROGRESS_BAR'] : ''; ?></td>
      </tr>
      <?php

} // END poll_option

if(isset($poll_option_item)) { unset($poll_option_item); } 

?>
      <tr> 
        <td colspan="4" style="text-align: center"><?php echo isset($this->vars['L_TOTAL_VOTES']) ? $this->vars['L_TOTAL_VOTES'] : $this->lang('L_TOTAL_VOTES'); ?> : <?php echo isset($this->vars['TOTAL_VOTES']) ? $this->vars['TOTAL_VOTES'] : $this->lang('TOTAL_VOTES'); ?></td>
      </tr>
    </table>
    <br />
  </td>
</tr>