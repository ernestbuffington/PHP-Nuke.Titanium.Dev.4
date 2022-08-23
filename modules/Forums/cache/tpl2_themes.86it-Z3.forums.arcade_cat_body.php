<?php

// eXtreme Styles mod cache. Generated on Wed, 14 Apr 2021 11:49:47 +0000 (time=1618400987)

?><script language="Javascript">
var win = null;

function Arcade_Popup(mypage,myname,w,h,scroll)
{
  LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
  TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
  settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',status='+scroll+',resizable=yes';
  win = window.open(mypage,myname,settings);
}
</script>
 <!-- affichage de la phrase d'index -->
<?php echo isset($this->vars['HEADINGARCADE']) ? $this->vars['HEADINGARCADE'] : $this->lang('HEADINGARCADE'); ?>
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
          <td align="left" valign="middle" width="100%">
                <span class="nav">
                        <a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
                </span>
                <span class="nav">&nbsp;->&nbsp;<?php echo isset($this->vars['L_ARCADE']) ? $this->vars['L_ARCADE'] : $this->lang('L_ARCADE'); ?></span>
          </td>
    </tr>
  </table>
<?php echo isset($this->vars['WHOISPLAYING']) ? $this->vars['WHOISPLAYING'] : $this->lang('WHOISPLAYING'); ?>
<br />
<?php

$favrow_count = ( isset($this->_tpldata['favrow.']) ) ?  sizeof($this->_tpldata['favrow.']) : 0;
for ($favrow_i = 0; $favrow_i < $favrow_count; $favrow_i++)
{
 $favrow_item = &$this->_tpldata['favrow.'][$favrow_i];
 $favrow_item['S_ROW_COUNT'] = $favrow_i;
 $favrow_item['S_NUM_ROWS'] = $favrow_count;

?>
<table width="100%" cellpadding="2" cellspacing="3" border="0"> 
        <tr>
        <td>
                
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
        <td class="cat" colspan="6"><span class="cattitle"><?php echo isset($this->vars['FAV']) ? $this->vars['FAV'] : $this->lang('FAV'); ?></span></td>
</tr>
          
          <?php

$fav_row_count = ( isset($favrow_item['fav_row.']) ) ? sizeof($favrow_item['fav_row.']) : 0;
for ($fav_row_i = 0; $fav_row_i < $fav_row_count; $fav_row_i++)
{
 $fav_row_item = &$favrow_item['fav_row.'][$fav_row_i];
 $fav_row_item['S_ROW_COUNT'] = $fav_row_i;
 $fav_row_item['S_NUM_ROWS'] = $fav_row_count;

?>
          <tr>
                        <td class="row1" width="35"><?php echo isset($fav_row_item['GAMEPICF']) ? $fav_row_item['GAMEPICF'] : ''; ?></td>
                        
                        <td class="row1" width="100" align="center">
                        <span class='genmed'><?php echo isset($fav_row_item['GAMELINKF']) ? $fav_row_item['GAMELINKF'] : ''; ?></span><br />
                        <span class='genmed'><?php echo isset($fav_row_item['GAMEPOPUPLINKF']) ? $fav_row_item['GAMEPOPUPLINKF'] : ''; ?></span><br />
                        <span class='gensmall'><?php echo isset($fav_row_item['GAMESETF']) ? $fav_row_item['GAMESETF'] : ''; ?></span>
                        </td>
                        
                        <td class="row1" width="150" align="center" valign="center" >
                                <span class='gen'><?php echo isset($fav_row_item['NORECORDF']) ? $fav_row_item['NORECORDF'] : ''; ?>
                                <?php

$recordrow_count = ( isset($fav_row_item['recordrow.']) ) ? sizeof($fav_row_item['recordrow.']) : 0;
for ($recordrow_i = 0; $recordrow_i < $recordrow_count; $recordrow_i++)
{
 $recordrow_item = &$fav_row_item['recordrow.'][$recordrow_i];
 $recordrow_item['S_ROW_COUNT'] = $recordrow_i;
 $recordrow_item['S_NUM_ROWS'] = $recordrow_count;

?>
                                <strong><?php echo isset($fav_row_item['HIGHSCOREF']) ? $fav_row_item['HIGHSCOREF'] : ''; ?></strong></span><span class='gensmall'>   <?php echo isset($fav_row_item['HIGHUSERF']) ? $fav_row_item['HIGHUSERF'] : ''; ?><br /><?php echo isset($fav_row_item['DATEHIGHF']) ? $fav_row_item['DATEHIGHF'] : ''; ?>
                                <?php

} // END recordrow

if(isset($recordrow_item)) { unset($recordrow_item); } 

?>
                                 </span>
                        </td>
                        
                        <td class="row1" width="150" align="center" valign="center" >
                                <span class='gen'><?php echo isset($fav_row_item['NOSCOREF']) ? $fav_row_item['NOSCOREF'] : ''; ?>
                                <?php

$yourrecordrow_count = ( isset($fav_row_item['yourrecordrow.']) ) ? sizeof($fav_row_item['yourrecordrow.']) : 0;
for ($yourrecordrow_i = 0; $yourrecordrow_i < $yourrecordrow_count; $yourrecordrow_i++)
{
 $yourrecordrow_item = &$fav_row_item['yourrecordrow.'][$yourrecordrow_i];
 $yourrecordrow_item['S_ROW_COUNT'] = $yourrecordrow_i;
 $yourrecordrow_item['S_NUM_ROWS'] = $yourrecordrow_count;

?>
                                <strong><?php echo isset($fav_row_item['YOURHIGHSCOREF']) ? $fav_row_item['YOURHIGHSCOREF'] : ''; ?><?php echo isset($fav_row_item['IMGFIRSTF']) ? $fav_row_item['IMGFIRSTF'] : ''; ?></strong></span><span class='gensmall'><br /><?php echo isset($fav_row_item['YOURDATEHIGHF']) ? $fav_row_item['YOURDATEHIGHF'] : ''; ?>
                                <?php

} // END yourrecordrow

if(isset($yourrecordrow_item)) { unset($yourrecordrow_item); } 

?>
                                 <?php

$playrecordrow_count = ( isset($fav_row_item['playrecordrow.']) ) ? sizeof($fav_row_item['playrecordrow.']) : 0;
for ($playrecordrow_i = 0; $playrecordrow_i < $playrecordrow_count; $playrecordrow_i++)
{
 $playrecordrow_item = &$fav_row_item['playrecordrow.'][$playrecordrow_i];
 $playrecordrow_item['S_ROW_COUNT'] = $playrecordrow_i;
 $playrecordrow_item['S_NUM_ROWS'] = $playrecordrow_count;

?>
                                <strong><?php echo isset($fav_row_item['CLICKPLAY']) ? $fav_row_item['CLICKPLAY'] : ''; ?></strong>
                                   <?php

} // END playrecordrow

if(isset($playrecordrow_item)) { unset($playrecordrow_item); } 

?>
                                </span>   
                        </td>
                        
                        <td class="row1" align="center" valign="center">
                                <table width="100%">
                                        <tr>
                                                 <td align="center">
                                                        <span class="name"><?php echo isset($fav_row_item['GAMEDESCF']) ? $fav_row_item['GAMEDESCF'] : ''; ?></span>
                                                 </td>
                                                <td width="25"><?php echo isset($fav_row_item['URL_SCOREBOARDF']) ? $fav_row_item['URL_SCOREBOARDF'] : ''; ?></td>
                                        </tr>
                                </table>
                          </td>
                          
                  
                         <td class="row1" align="center" valign="center">
                         <?php echo isset($fav_row_item['DELFAVORI']) ? $fav_row_item['DELFAVORI'] : ''; ?>
                         </td>
</tr>                 
<?php

} // END fav_row

if(isset($fav_row_item)) { unset($fav_row_item); } 

?>
</table>
</td></tr>
</table> 
<?php

} // END favrow

if(isset($favrow_item)) { unset($favrow_item); } 

?> 
  <table width="100%" cellpadding="2" cellspacing="3" border="0">
<?php

$cat_row_count = ( isset($this->_tpldata['cat_row.']) ) ?  sizeof($this->_tpldata['cat_row.']) : 0;
for ($cat_row_i = 0; $cat_row_i < $cat_row_count; $cat_row_i++)
{
 $cat_row_item = &$this->_tpldata['cat_row.'][$cat_row_i];
 $cat_row_item['S_ROW_COUNT'] = $cat_row_i;
 $cat_row_item['S_NUM_ROWS'] = $cat_row_count;

?>
    <tr>
        <td>
          <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
          <tr>
            <td class="cat" colspan="<?php echo isset($this->vars['ARCADE_COL']) ? $this->vars['ARCADE_COL'] : $this->lang('ARCADE_COL'); ?>"><span class="cattitle"><?php echo isset($cat_row_item['CATTITLE']) ? $cat_row_item['CATTITLE'] : ''; ?></span></td>
          </tr>
<tr> 
<td class="cat" height="28" align="center" colspan="2"><span class="cattitle"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span></td> 
<td class="cat" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['L_HIGHSCORE']) ? $this->vars['L_HIGHSCORE'] : $this->lang('L_HIGHSCORE'); ?></span></td> 
<td class="cat" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['L_YOURSCORE']) ? $this->vars['L_YOURSCORE'] : $this->lang('L_YOURSCORE'); ?></span></td> 
<td class="cat" nowrap="nowrap" align="center" colspan="<?php echo isset($this->vars['ARCADE_COL1']) ? $this->vars['ARCADE_COL1'] : $this->lang('ARCADE_COL1'); ?>"><span class="cattitle"><?php echo isset($this->vars['L_DESC']) ? $this->vars['L_DESC'] : $this->lang('L_DESC'); ?></span></td> 

</tr>
<?php

$game_row_count = ( isset($cat_row_item['game_row.']) ) ? sizeof($cat_row_item['game_row.']) : 0;
for ($game_row_i = 0; $game_row_i < $game_row_count; $game_row_i++)
{
 $game_row_item = &$cat_row_item['game_row.'][$game_row_i];
 $game_row_item['S_ROW_COUNT'] = $game_row_i;
 $game_row_item['S_NUM_ROWS'] = $game_row_count;

?>
          <tr>
            <td class="row1" width="35"><?php echo isset($game_row_item['GAMEPIC']) ? $game_row_item['GAMEPIC'] : ''; ?></td>
            <td class="row1" width="100" align="center">
                <span class='genmed'><?php echo isset($game_row_item['GAMELINK']) ? $game_row_item['GAMELINK'] : ''; ?></span><br />
                <span class='genmed'><?php echo isset($game_row_item['GAMEPOPUPLINK']) ? $game_row_item['GAMEPOPUPLINK'] : ''; ?></span><br />
                <span class='gensmall'><?php echo isset($game_row_item['GAMESET']) ? $game_row_item['GAMESET'] : ''; ?></span>
                </td>
        <td class="row1" width="150" align="center" valign="center" >
                <span class='gen'>
                <?php echo isset($game_row_item['NORECORD']) ? $game_row_item['NORECORD'] : ''; ?>
          <?php

$recordrow_count = ( isset($game_row_item['recordrow.']) ) ? sizeof($game_row_item['recordrow.']) : 0;
for ($recordrow_i = 0; $recordrow_i < $recordrow_count; $recordrow_i++)
{
 $recordrow_item = &$game_row_item['recordrow.'][$recordrow_i];
 $recordrow_item['S_ROW_COUNT'] = $recordrow_i;
 $recordrow_item['S_NUM_ROWS'] = $recordrow_count;

?>
        <strong><?php echo isset($game_row_item['HIGHSCORE']) ? $game_row_item['HIGHSCORE'] : ''; ?></strong></span><span class='gensmall'>&nbsp;&nbsp;<?php echo isset($game_row_item['HIGHUSER']) ? $game_row_item['HIGHUSER'] : ''; ?><br /><?php echo isset($game_row_item['DATEHIGH']) ? $game_row_item['DATEHIGH'] : ''; ?>
           <?php

} // END recordrow

if(isset($recordrow_item)) { unset($recordrow_item); } 

?>
            </span>
           
        </td>
        <td class="row1" width="150" align="center" valign="center" >
        <span class='gen'>
                <?php echo isset($game_row_item['NOSCORE']) ? $game_row_item['NOSCORE'] : ''; ?>
          <?php

$yourrecordrow_count = ( isset($game_row_item['yourrecordrow.']) ) ? sizeof($game_row_item['yourrecordrow.']) : 0;
for ($yourrecordrow_i = 0; $yourrecordrow_i < $yourrecordrow_count; $yourrecordrow_i++)
{
 $yourrecordrow_item = &$game_row_item['yourrecordrow.'][$yourrecordrow_i];
 $yourrecordrow_item['S_ROW_COUNT'] = $yourrecordrow_i;
 $yourrecordrow_item['S_NUM_ROWS'] = $yourrecordrow_count;

?>
        <strong><?php echo isset($game_row_item['YOURHIGHSCORE']) ? $game_row_item['YOURHIGHSCORE'] : ''; ?><?php echo isset($game_row_item['IMGFIRST']) ? $game_row_item['IMGFIRST'] : ''; ?></strong></span><span class='gensmall'><br /><?php echo isset($game_row_item['YOURDATEHIGH']) ? $game_row_item['YOURDATEHIGH'] : ''; ?>
           <?php

} // END yourrecordrow

if(isset($yourrecordrow_item)) { unset($yourrecordrow_item); } 

?>
         <?php

$playrecordrow_count = ( isset($game_row_item['playrecordrow.']) ) ? sizeof($game_row_item['playrecordrow.']) : 0;
for ($playrecordrow_i = 0; $playrecordrow_i < $playrecordrow_count; $playrecordrow_i++)
{
 $playrecordrow_item = &$game_row_item['playrecordrow.'][$playrecordrow_i];
 $playrecordrow_item['S_ROW_COUNT'] = $playrecordrow_i;
 $playrecordrow_item['S_NUM_ROWS'] = $playrecordrow_count;

?>
        <strong><?php echo isset($game_row_item['CLICKPLAY']) ? $game_row_item['CLICKPLAY'] : ''; ?></strong>
           <?php

} // END playrecordrow

if(isset($playrecordrow_item)) { unset($playrecordrow_item); } 

?>

            </span>   
        </td>
        <td class="row1" align="center" valign="center">
                <table width="100%">
                <tr>
                 <td align="center">
                <span class="name"><?php echo isset($game_row_item['GAMEDESC']) ? $game_row_item['GAMEDESC'] : ''; ?></span>
                 </td>
                 <td width="25"><?php echo isset($game_row_item['URL_SCOREBOARD']) ? $game_row_item['URL_SCOREBOARD'] : ''; ?></td>
            </tr>
                </table>
          </td>
 <?php echo isset($game_row_item['ADD_FAV']) ? $game_row_item['ADD_FAV'] : ''; ?>
          </tr>
<?php

} // END game_row

if(isset($game_row_item)) { unset($game_row_item); } 

?>
          <tr>
            <td class="row2" colspan="<?php echo isset($this->vars['ARCADE_COL']) ? $this->vars['ARCADE_COL'] : $this->lang('ARCADE_COL'); ?>" align="<?php echo isset($cat_row_item['LINKCAT_ALIGN']) ? $cat_row_item['LINKCAT_ALIGN'] : ''; ?>"><span class="gensmall"><a href="<?php echo isset($cat_row_item['U_ARCADE']) ? $cat_row_item['U_ARCADE'] : ''; ?>"><?php echo isset($cat_row_item['L_ARCADE']) ? $cat_row_item['L_ARCADE'] : ''; ?></a></span></td>
          </tr>
          </table>
        </td>  
        </tr>
<?php

} // END cat_row

if(isset($cat_row_item)) { unset($cat_row_item); } 

?>
    </table>
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
<td align="center">[&nbsp;<?php echo isset($this->vars['URL_ARCADE']) ? $this->vars['URL_ARCADE'] : $this->lang('URL_ARCADE'); ?>]&nbsp;-&nbsp;[&nbsp;<?php echo isset($this->vars['URL_BESTSCORES']) ? $this->vars['URL_BESTSCORES'] : $this->lang('URL_BESTSCORES'); ?>]&nbsp;-&nbsp;[&nbsp;<?php echo isset($this->vars['MANAGE_COMMENTS']) ? $this->vars['MANAGE_COMMENTS'] : $this->lang('MANAGE_COMMENTS'); ?>]</td>
   </tr>
  </table>