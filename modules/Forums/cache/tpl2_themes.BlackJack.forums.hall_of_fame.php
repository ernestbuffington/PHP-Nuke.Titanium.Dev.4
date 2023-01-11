<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 13:24:09 +0000 (time=1672320249)

?><table width="100%" cellpadding="5" cellspacing="1" border="0" class="bodyline" align="center">
  <tr> 
          <th class="thTop" colspan="6"><?php echo isset($this->vars['L_LONGEST_SCORE']) ? $this->vars['L_LONGEST_SCORE'] : $this->lang('L_LONGEST_SCORE'); ?></th>
  </tr>
  <tr>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_RANK']) ? $this->vars['L_RANK'] : $this->lang('L_RANK'); ?></strong></td>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></strong></td>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_ARCADE_USER']) ? $this->vars['L_ARCADE_USER'] : $this->lang('L_ARCADE_USER'); ?></strong></td>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_SCORE']) ? $this->vars['L_SCORE'] : $this->lang('L_SCORE'); ?></strong></td>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_HELD_TIME']) ? $this->vars['L_HELD_TIME'] : $this->lang('L_HELD_TIME'); ?></strong></td>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_DATE']) ? $this->vars['L_DATE'] : $this->lang('L_DATE'); ?></strong></td>
  </tr>
<?php

$record_row_count = ( isset($this->_tpldata['record_row.']) ) ?  sizeof($this->_tpldata['record_row.']) : 0;
for ($record_row_i = 0; $record_row_i < $record_row_count; $record_row_i++)
{
 $record_row_item = &$this->_tpldata['record_row.'][$record_row_i];
 $record_row_item['S_ROW_COUNT'] = $record_row_i;
 $record_row_item['S_NUM_ROWS'] = $record_row_count;

?>
  <tr>
                <td align='center' class='row1'><?php echo isset($record_row_item['COUNT']) ? $record_row_item['COUNT'] : ''; ?></td>
                <td align='center' class='row1'><?php echo isset($record_row_item['GAME_NAME']) ? $record_row_item['GAME_NAME'] : ''; ?></td>
                <td align='center' class='row1'><?php echo isset($record_row_item['USERNAME']) ? $record_row_item['USERNAME'] : ''; ?></td>
                <td align='center' class='row1'><?php echo isset($record_row_item['HIGHSCORE']) ? $record_row_item['HIGHSCORE'] : ''; ?></td>
                <td align='center' class='row1'><?php echo isset($record_row_item['HELD_TIME']) ? $record_row_item['HELD_TIME'] : ''; ?></td>
                <td align='center' class='row1'><?php echo isset($record_row_item['HIGHSCORE_DATE']) ? $record_row_item['HIGHSCORE_DATE'] : ''; ?></td>
  </tr>

<?php

} // END record_row

if(isset($record_row_item)) { unset($record_row_item); } 

?>
</table>
<br />