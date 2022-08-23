<?php

// eXtreme Styles mod cache. Generated on Sun, 14 Mar 2021 11:35:12 +0000 (time=1615721712)

?><br />

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline" align="center">
  <tr> 
    <td class="cat"><span class="cattitle"><?php echo isset($this->vars['L_WHOISPLAYING']) ? $this->vars['L_WHOISPLAYING'] : $this->lang('L_WHOISPLAYING'); ?></span></td>
  </tr>
<?php

$whoisplaying_row_count = ( isset($this->_tpldata['whoisplaying_row.']) ) ?  sizeof($this->_tpldata['whoisplaying_row.']) : 0;
for ($whoisplaying_row_i = 0; $whoisplaying_row_i < $whoisplaying_row_count; $whoisplaying_row_i++)
{
 $whoisplaying_row_item = &$this->_tpldata['whoisplaying_row.'][$whoisplaying_row_i];
 $whoisplaying_row_item['S_ROW_COUNT'] = $whoisplaying_row_i;
 $whoisplaying_row_item['S_NUM_ROWS'] = $whoisplaying_row_count;

?>
  <tr>
    <td class="<?php echo isset($whoisplaying_row_item['CLASS']) ? $whoisplaying_row_item['CLASS'] : ''; ?>" valign="top">
    <span class="gensmall">
    <?php echo isset($whoisplaying_row_item['GAME']) ? $whoisplaying_row_item['GAME'] : ''; ?>&nbsp;:
    <?php echo isset($whoisplaying_row_item['PLAYER_LIST']) ? $whoisplaying_row_item['PLAYER_LIST'] : ''; ?>
    </span>
    </td>
  </tr>
<?php

} // END whoisplaying_row

if(isset($whoisplaying_row_item)) { unset($whoisplaying_row_item); } 

?>
</table>