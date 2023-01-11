<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 13:22:49 +0000 (time=1672320169)

?><br />

<table class="arcadeThHead" width="100%" cellpadding="2" cellspacing="1" border="0" align="center">
  <tr> 
    <td class="arcadeRow1"><span class="cattitle">&nbsp;<?php echo isset($this->vars['L_WHOISPLAYING']) ? $this->vars['L_WHOISPLAYING'] : $this->lang('L_WHOISPLAYING'); ?></span></td>
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
    <td class="arcadeRow1 arcadeTitleLink" valign="top">
    <?php echo isset($whoisplaying_row_item['GAME']) ? $whoisplaying_row_item['GAME'] : ''; ?>&nbsp;:
    <?php echo isset($whoisplaying_row_item['PLAYER_LIST']) ? $whoisplaying_row_item['PLAYER_LIST'] : ''; ?>
    </td>
  </tr>
<?php

} // END whoisplaying_row

if(isset($whoisplaying_row_item)) { unset($whoisplaying_row_item); } 

?>
</table>
<div align="center" style="padding-top:6px;">
</div>