<?php

// eXtreme Styles mod cache. Generated on Tue, 01 Nov 2022 04:46:09 +0000 (time=1667277969)

?><!-- index phrase display -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
          <td align="left" valign="middle" width="100%">
               
          </td>
    </tr>
  </table>

<table width="100%" cellpadding="5" cellspacing="0" border="0" class="bodyline">
<tr> 
        <th class="arcadeThTop" colspan="4" nowrap="nowrap"><img width="269" src="images/arcade_mod/arcade_logo.png" border="0"></a></th>
</tr>
<tr> 
<td class="arcadeRow2" colspan="4" align="center"><div align="center" style="padding-top:6px;"></div><?php echo isset($this->vars['USER_AVATAR']) ? $this->vars['USER_AVATAR'] : $this->lang('USER_AVATAR'); ?><a href="modules.php?name=Forums&amp;file=arcade"></a></br><?php echo isset($this->vars['L_STATS']) ? $this->vars['L_STATS'] : $this->lang('L_STATS'); ?></td>
</tr>

<tr>
        <td class="arcadeRow1" colspan="4" align="center"><span class="arcadePink">[</span> <?php echo isset($this->vars['URL_ARCADE']) ? $this->vars['URL_ARCADE'] : $this->lang('URL_ARCADE'); ?> <span class="arcadePink">]</span>&nbsp;-&nbsp;<span class="arcadePink">[</span> <?php echo isset($this->vars['URL_BESTSCORES']) ? $this->vars['URL_BESTSCORES'] : $this->lang('URL_BESTSCORES'); ?> <span class="arcadePink">]</span></td>
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
         <td style="padding-top:15px" class="arcadeRow2" valign="top" width="50%">
                 <?php

$blkgame_count = ( isset($blkcolonne_item['blkgame.']) ) ? sizeof($blkcolonne_item['blkgame.']) : 0;
for ($blkgame_i = 0; $blkgame_i < $blkgame_count; $blkgame_i++)
{
 $blkgame_item = &$blkcolonne_item['blkgame.'][$blkgame_i];
 $blkgame_item['S_ROW_COUNT'] = $blkgame_i;
 $blkgame_item['S_NUM_ROWS'] = $blkgame_count;

?>
                <fieldset class="fieldset">
                         <legend align=center><span class="arcadeFieldsetTitle"><i class="bi bi-link"></i> <?php echo isset($blkgame_item['GAMENAME']) ? $blkgame_item['GAMENAME'] : ''; ?> <i class="bi bi-link"></i>
                        <legend align=left><span class="arcadeFieldset"><?php echo isset($blkgame_item['L_NBSET']) ? $blkgame_item['L_NBSET'] : ''; ?>
                        <?php echo isset($blkgame_item['NBSET']) ? $blkgame_item['NBSET'] : ''; ?></span></legend>

                        <legend align=left><span class="arcadeFieldset"><?php echo isset($blkgame_item['L_TPSSET']) ? $blkgame_item['L_TPSSET'] : ''; ?>
                        <?php echo isset($blkgame_item['TPSSET']) ? $blkgame_item['TPSSET'] : ''; ?></span></legend>
        
                        <legend align=left><span class="arcadeFieldset"><?php echo isset($blkgame_item['L_TPSMOY']) ? $blkgame_item['L_TPSMOY'] : ''; ?>
                        <?php echo isset($blkgame_item['TPSMOY']) ? $blkgame_item['TPSMOY'] : ''; ?></span></legend>

                        <legend align=left><span class="arcadeFieldset"><?php echo isset($blkgame_item['L_POSGAME']) ? $blkgame_item['L_POSGAME'] : ''; ?>
                        <?php echo isset($blkgame_item['POSGAME']) ? $blkgame_item['POSGAME'] : ''; ?>&nbsp;&nbsp;<?php echo isset($blkgame_item['IMGFIRST']) ? $blkgame_item['IMGFIRST'] : ''; ?></span></legend>

                        <legend align=left><span class="arcadeFieldset"><?php echo isset($blkgame_item['L_HIGHSCR']) ? $blkgame_item['L_HIGHSCR'] : ''; ?>
                        <?php echo isset($blkgame_item['HIGHSCR']) ? $blkgame_item['HIGHSCR'] : ''; ?></span></legend>

                        <legend align=left><span class="arcadeFieldset"><?php echo isset($blkgame_item['L_DATHIGHSCR']) ? $blkgame_item['L_DATHIGHSCR'] : ''; ?>
                        <span class="gensmall-arcade"><?php echo isset($blkgame_item['DATHIGHSCR']) ? $blkgame_item['DATHIGHSCR'] : ''; ?></span></legend>
                        </span></legend>
                </fieldset>
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
                <td align="left" valign="middle" nowrap="nowrap"><span class="arcade-nav"></br><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></span></td>
                <td align="right" valign="middle"><span class="arcade-nav"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></span></td>
        </tr>
</table>