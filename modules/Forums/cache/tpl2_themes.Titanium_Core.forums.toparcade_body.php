<?php

// eXtreme Styles mod cache. Generated on Tue, 01 Nov 2022 04:46:00 +0000 (time=1667277960)

?><!-- index phrase display -->
<?php echo isset($this->vars['HALL_OF_FAME']) ? $this->vars['HALL_OF_FAME'] : $this->lang('HALL_OF_FAME'); ?>
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
          <td align="left" valign="middle" width="100%">
                <span class="nav">
                        <a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
                </span>
                <span class="nav">&nbsp;->&nbsp;<?php echo isset($this->vars['NAV_DESC']) ? $this->vars['NAV_DESC'] : $this->lang('NAV_DESC'); ?></span>
                <span class="nav">&nbsp;->&nbsp;<?php echo isset($this->vars['L_TOPARCADE_FIVE']) ? $this->vars['L_TOPARCADE_FIVE'] : $this->lang('L_TOPARCADE_FIVE'); ?></span>
          </td>
    </tr>
  </table>

<table width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline">
<tr> 
        <th class="thTop" colspan="4" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_ARCADE']) ? $this->vars['L_ARCADE'] : $this->lang('L_ARCADE'); ?>&nbsp;</th>
</tr>

  <?php

$blkligne_count = ( isset($this->_tpldata['blkligne.']) ) ?  sizeof($this->_tpldata['blkligne.']) : 0;
for ($blkligne_i = 0; $blkligne_i < $blkligne_count; $blkligne_i++)
{
 $blkligne_item = &$this->_tpldata['blkligne.'][$blkligne_i];
 $blkligne_item['S_ROW_COUNT'] = $blkligne_i;
 $blkligne_item['S_NUM_ROWS'] = $blkligne_count;

?>
  <tr>
     <?php

$blkcolonne_count = ( isset($blkligne_item['blkcolonne.']) ) ? sizeof($blkligne_item['blkcolonne.']) : 0;
for ($blkcolonne_i = 0; $blkcolonne_i < $blkcolonne_count; $blkcolonne_i++)
{
 $blkcolonne_item = &$blkligne_item['blkcolonne.'][$blkcolonne_i];
 $blkcolonne_item['S_ROW_COUNT'] = $blkcolonne_i;
 $blkcolonne_item['S_NUM_ROWS'] = $blkcolonne_count;

?>
         <td valign="top">
                 <?php

$blkgame_count = ( isset($blkcolonne_item['blkgame.']) ) ? sizeof($blkcolonne_item['blkgame.']) : 0;
for ($blkgame_i = 0; $blkgame_i < $blkgame_count; $blkgame_i++)
{
 $blkgame_item = &$blkcolonne_item['blkgame.'][$blkgame_i];
 $blkgame_item['S_ROW_COUNT'] = $blkgame_i;
 $blkgame_item['S_NUM_ROWS'] = $blkgame_count;

?>
                <table width="100%" cellpadding="2" cellspacing="1" class="bodyline">
                 <tr>
                         <td class="row2" colspan="3" align="center"><span class="gensmall"><?php echo isset($blkgame_item['GAMENAME']) ? $blkgame_item['GAMENAME'] : ''; ?></span></td>
                 </tr>
                 <?php

$blkscore_count = ( isset($blkgame_item['blkscore.']) ) ? sizeof($blkgame_item['blkscore.']) : 0;
for ($blkscore_i = 0; $blkscore_i < $blkscore_count; $blkscore_i++)
{
 $blkscore_item = &$blkgame_item['blkscore.'][$blkscore_i];
 $blkscore_item['S_ROW_COUNT'] = $blkscore_i;
 $blkscore_item['S_NUM_ROWS'] = $blkscore_count;

?>
                 <tr>
                   <td class="row1" align="center" width="20"><span class="gensmall"><?php echo isset($blkscore_item['POS']) ? $blkscore_item['POS'] : ''; ?></span></td>
                   <td class="row1" width="100" align="center"><span class="gensmall"><?php echo isset($blkscore_item['SCORE']) ? $blkscore_item['SCORE'] : ''; ?></span></td>
                   <td class="row1" align="center"><span class="gensmall"><?php echo isset($blkscore_item['USERNAME']) ? $blkscore_item['USERNAME'] : ''; ?></span></td>
                 </tr>
                 <?php

} // END blkscore

if(isset($blkscore_item)) { unset($blkscore_item); } 

?>
                </table>
                <?php

} // END blkgame

if(isset($blkgame_item)) { unset($blkgame_item); } 

?>
         </td>
         <?php

} // END blkcolonne

if(isset($blkcolonne_item)) { unset($blkcolonne_item); } 

?>
  </tr>
  <?php

} // END blkligne

if(isset($blkligne_item)) { unset($blkligne_item); } 

?>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
        <tr>
                <td align="left" valign="middle" nowrap="nowrap"><span class="nav"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></span></td>
                <td align="right" valign="middle"><span class="nav"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></span></td>
        </tr>
</table>