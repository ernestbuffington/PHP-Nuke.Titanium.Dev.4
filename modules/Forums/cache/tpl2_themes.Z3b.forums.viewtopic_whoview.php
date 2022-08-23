<?php

// eXtreme Styles mod cache. Generated on Thu, 15 Apr 2021 17:44:08 +0000 (time=1618508648)

?><form method="post" action="<?php echo isset($this->vars['S_MODE_ACTION']) ? $this->vars['S_MODE_ACTION'] : $this->lang('S_MODE_ACTION'); ?>" name="post">
<table border="0" cellpadding="0" cellspacing="1" class="col-12">
  <tr>
  	<td colspan="6">
  	  <table border="0" cellpadding="0" cellspacing="1" class="col-12">
  	  	<tr> 
	      <td class="col-6"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>
	      <td class="col-6 right"><?php echo isset($this->vars['L_SELECT_SORT_METHOD']) ? $this->vars['L_SELECT_SORT_METHOD'] : $this->lang('L_SELECT_SORT_METHOD'); ?>:&nbsp;<?php echo isset($this->vars['S_MODE_SELECT']) ? $this->vars['S_MODE_SELECT'] : $this->lang('S_MODE_SELECT'); ?>&nbsp;&nbsp;<?php echo isset($this->vars['L_ORDER']) ? $this->vars['L_ORDER'] : $this->lang('L_ORDER'); ?>&nbsp;<?php echo isset($this->vars['S_ORDER_SELECT']) ? $this->vars['S_ORDER_SELECT'] : $this->lang('S_ORDER_SELECT'); ?>&nbsp;&nbsp;<input type="submit" name="submit" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" class="liteoption" /></td>
	    </tr>
  	  </table>
  	</td>
  </tr>
  <tr>
  	<td align="center" class="catHead wtf col-12" colspan="6">List of all users who have viewed this topic</td>
  </tr>
  <tr>
    <td class="catHead center">#</td>
    <td class="catHead center"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></td>
    <td class="catHead center"><?php echo isset($this->vars['L_FROM']) ? $this->vars['L_FROM'] : $this->lang('L_FROM'); ?></td>              
    <td class="catHead center"><?php echo isset($this->vars['L_TOPIC_COUNT']) ? $this->vars['L_TOPIC_COUNT'] : $this->lang('L_TOPIC_COUNT'); ?></td>
    <td class="catHead center"><?php echo isset($this->vars['L_LAST_VIEWED']) ? $this->vars['L_LAST_VIEWED'] : $this->lang('L_LAST_VIEWED'); ?></td>
    <td class="catHead center"><?php echo isset($this->vars['L_ONLINE_STATUS']) ? $this->vars['L_ONLINE_STATUS'] : $this->lang('L_ONLINE_STATUS'); ?></td>
  </tr>
  <?php

$memberrow_count = ( isset($this->_tpldata['memberrow.']) ) ?  sizeof($this->_tpldata['memberrow.']) : 0;
for ($memberrow_i = 0; $memberrow_i < $memberrow_count; $memberrow_i++)
{
 $memberrow_item = &$this->_tpldata['memberrow.'][$memberrow_i];
 $memberrow_item['S_ROW_COUNT'] = $memberrow_i;
 $memberrow_item['S_NUM_ROWS'] = $memberrow_count;

?>
  <tr>
  	<td class="row1 center"><?php echo isset($memberrow_item['ROW_NUMBER']) ? $memberrow_item['ROW_NUMBER'] : ''; ?></td>
  	<td class="row1">
  		<span style="float: left; margin: 2px;"><a href="<?php echo isset($memberrow_item['U_VIEWPROFILE']) ? $memberrow_item['U_VIEWPROFILE'] : ''; ?>"><?php echo isset($memberrow_item['USERNAME']) ? $memberrow_item['USERNAME'] : ''; ?></a></span>
  		<span style="float: right;"><?php echo isset($memberrow_item['WWW']) ? $memberrow_item['WWW'] : ''; ?><?php echo isset($memberrow_item['FACEBOOK']) ? $memberrow_item['FACEBOOK'] : ''; ?><?php echo isset($memberrow_item['PM']) ? $memberrow_item['PM'] : ''; ?></span>
  	</td>
  	<td class="row1"><?php echo isset($memberrow_item['FLAG']) ? $memberrow_item['FLAG'] : ''; ?><?php echo isset($memberrow_item['FROM']) ? $memberrow_item['FROM'] : ''; ?></td>
  	<td class="row1 center"><?php echo isset($memberrow_item['VIEW_COUNT']) ? $memberrow_item['VIEW_COUNT'] : ''; ?></td>
  	<td class="row1 center"><?php echo isset($memberrow_item['VIEW_TIME']) ? $memberrow_item['VIEW_TIME'] : ''; ?></td>
  	<td class="row1 center"><?php echo isset($memberrow_item['ONLINE_STATUS']) ? $memberrow_item['ONLINE_STATUS'] : ''; ?></td>
  </tr>
  <?php

} // END memberrow

if(isset($memberrow_item)) { unset($memberrow_item); } 

?>
  <tr>
  	<td class="catBottom" colspan="6">&nbsp;</td>
  </tr>
</table>
</form>