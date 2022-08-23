<?php

// eXtreme Styles mod cache. Generated on Mon, 22 Aug 2022 02:39:37 +0000 (time=1661135977)

?>  <tr>
    <td class="row2" colspan="2"><br />
      <form method="POST" action="<?php echo isset($this->vars['S_POLL_ACTION']) ? $this->vars['S_POLL_ACTION'] : $this->lang('S_POLL_ACTION'); ?>">
      <table cellspacing="0" cellpadding="4" border="0" style="margin: auto">
        <tr>
          <td style="text-align: center"><?php echo isset($this->vars['POLL_QUESTION']) ? $this->vars['POLL_QUESTION'] : $this->lang('POLL_QUESTION'); ?></td>
        </tr>
        <tr>
          <td align="center">
            <table cellspacing="0" cellpadding="2" border="0">
              <?php

$poll_option_count = ( isset($this->_tpldata['poll_option.']) ) ?  sizeof($this->_tpldata['poll_option.']) : 0;
for ($poll_option_i = 0; $poll_option_i < $poll_option_count; $poll_option_i++)
{
 $poll_option_item = &$this->_tpldata['poll_option.'][$poll_option_i];
 $poll_option_item['S_ROW_COUNT'] = $poll_option_i;
 $poll_option_item['S_NUM_ROWS'] = $poll_option_count;

?>
              <tr>
                <td><input type="radio" name="vote_id" value="<?php echo isset($poll_option_item['POLL_OPTION_ID']) ? $poll_option_item['POLL_OPTION_ID'] : ''; ?>" />&nbsp;</td>
                <td><?php echo isset($poll_option_item['POLL_OPTION_CAPTION']) ? $poll_option_item['POLL_OPTION_CAPTION'] : ''; ?></td>
              </tr>
              <?php

} // END poll_option

if(isset($poll_option_item)) { unset($poll_option_item); } 

?>
            </table>
          </td>
        </tr>
        <tr>
          <td><input type="submit" name="submit" value="<?php echo isset($this->vars['L_SUBMIT_VOTE']) ? $this->vars['L_SUBMIT_VOTE'] : $this->lang('L_SUBMIT_VOTE'); ?>" class="liteoption" /></td>
        </tr>
        <tr>                        
          <td><a href="<?php echo isset($this->vars['U_VIEW_RESULTS']) ? $this->vars['U_VIEW_RESULTS'] : $this->lang('U_VIEW_RESULTS'); ?>"><?php echo isset($this->vars['L_VIEW_RESULTS']) ? $this->vars['L_VIEW_RESULTS'] : $this->lang('L_VIEW_RESULTS'); ?></a></td>
        </tr>
      </table>
      <?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
      </form>
    </td>
  </tr>