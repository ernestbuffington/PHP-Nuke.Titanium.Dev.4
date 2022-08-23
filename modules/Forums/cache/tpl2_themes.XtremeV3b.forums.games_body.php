<?php

// eXtreme Styles mod cache. Generated on Sun, 14 Mar 2021 11:35:12 +0000 (time=1615721712)

?><script language="JavaScript">
function resize_avatar(image)
{
  if (<?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?>>0)
  {
        if (image.width > <?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?> ) image.width=<?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?> ;
  }
}
</script>
  <!-- affichage de la phrase d'index -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
          <td align="left" valign="middle" width="100%">
                <span class="nav">
                        <a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>&nbsp;->&nbsp;<?php echo isset($this->vars['NAV_DESC']) ? $this->vars['NAV_DESC'] : $this->lang('NAV_DESC'); ?>&nbsp;->&nbsp;<?php echo isset($this->vars['CAT_TITLE']) ? $this->vars['CAT_TITLE'] : $this->lang('CAT_TITLE'); ?>&nbsp;>
                </span>
                <span class="nav"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span>
          </td>
    </tr>
  </table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="bodyline">
  <tr> 
        <th class="thTop" height="28" align="center"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></th>
  </tr>
  <tr>
         <td align="center">
                <table width="100%">
                        <tr>
        <?php

$avatar_best_player_left_count = ( isset($this->_tpldata['avatar_best_player_left.']) ) ?  sizeof($this->_tpldata['avatar_best_player_left.']) : 0;
for ($avatar_best_player_left_i = 0; $avatar_best_player_left_i < $avatar_best_player_left_count; $avatar_best_player_left_i++)
{
 $avatar_best_player_left_item = &$this->_tpldata['avatar_best_player_left.'][$avatar_best_player_left_i];
 $avatar_best_player_left_item['S_ROW_COUNT'] = $avatar_best_player_left_i;
 $avatar_best_player_left_item['S_NUM_ROWS'] = $avatar_best_player_left_count;

?>
            <td align="center" valign="top"> 
               <table width="100%" class="bodyline" cellpadding="2" cellspacing="1" > 
               <tr> 
                  <td class="row2" align="center" colspan="3"><span class="cattitle"><?php echo isset($this->vars['L_ACTUAL_WINNER']) ? $this->vars['L_ACTUAL_WINNER'] : $this->lang('L_ACTUAL_WINNER'); ?></span></td> 
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3"><?php echo isset($this->vars['FIRST_AVATAR']) ? $this->vars['FIRST_AVATAR'] : $this->lang('FIRST_AVATAR'); ?></td> 
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><strong><?php echo isset($this->vars['BEST_USER_NAME']) ? $this->vars['BEST_USER_NAME'] : $this->lang('BEST_USER_NAME'); ?></strong></span></td> 
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['GAMES_PLAYED']) ? $this->vars['GAMES_PLAYED'] : $this->lang('GAMES_PLAYED'); ?></span></td>
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['BEST_TIME']) ? $this->vars['BEST_TIME'] : $this->lang('BEST_TIME'); ?></span></td>
               </tr> 

               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['BEST_USER_DATE']) ? $this->vars['BEST_USER_DATE'] : $this->lang('BEST_USER_DATE'); ?></span></td> 
               </tr>
                   <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['COMMENTS']) ? $this->vars['COMMENTS'] : $this->lang('COMMENTS'); ?></span></td> 

               </tr>  
               </table>
               <br />
               
               <table width="100%" class="bodyline" cellpadding="2" cellspacing="1" >
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><strong>Hi-Score<br /><big><?php echo isset($this->vars['HIGHSCORE']) ? $this->vars['HIGHSCORE'] : $this->lang('HIGHSCORE'); ?></big></strong></span></td> 
               </tr>
               </table>
            </td>
        <?php

} // END avatar_best_player_left

if(isset($avatar_best_player_left_item)) { unset($avatar_best_player_left_item); } 

?>
            <td class="bodyline" align="center"> 
            <?php

$game_type_V5_count = ( isset($this->_tpldata['game_type_V5.']) ) ?  sizeof($this->_tpldata['game_type_V5.']) : 0;
for ($game_type_V5_i = 0; $game_type_V5_i < $game_type_V5_count; $game_type_V5_i++)
{
 $game_type_V5_item = &$this->_tpldata['game_type_V5.'][$game_type_V5_i];
 $game_type_V5_item['S_ROW_COUNT'] = $game_type_V5_i;
 $game_type_V5_item['S_NUM_ROWS'] = $game_type_V5_count;

?>
                 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="<?php echo isset($this->vars['GAME_WIDTH']) ? $this->vars['GAME_WIDTH'] : $this->lang('GAME_WIDTH'); ?>" height="<?php echo isset($this->vars['GAME_HEIGHT']) ? $this->vars['GAME_HEIGHT'] : $this->lang('GAME_HEIGHT'); ?>">
                        <param name="movie" value="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>?arcade_hash=<?php echo isset($this->vars['GAMEHASH']) ? $this->vars['GAMEHASH'] : $this->lang('GAMEHASH'); ?>">
                        <param name="quality" value="high">
                        <param name="menu" value="false">
                        <embed src="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>?arcade_hash=<?php echo isset($this->vars['GAMEHASH']) ? $this->vars['GAMEHASH'] : $this->lang('GAMEHASH'); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo isset($this->vars['GAME_WIDTH']) ? $this->vars['GAME_WIDTH'] : $this->lang('GAME_WIDTH'); ?>" height="<?php echo isset($this->vars['GAME_HEIGHT']) ? $this->vars['GAME_HEIGHT'] : $this->lang('GAME_HEIGHT'); ?>">
                        </embed>
                </object>
            <?php

} // END game_type_V5

if(isset($game_type_V5_item)) { unset($game_type_V5_item); } 

?>
            <?php

$game_type_V2_count = ( isset($this->_tpldata['game_type_V2.']) ) ?  sizeof($this->_tpldata['game_type_V2.']) : 0;
for ($game_type_V2_i = 0; $game_type_V2_i < $game_type_V2_count; $game_type_V2_i++)
{
 $game_type_V2_item = &$this->_tpldata['game_type_V2.'][$game_type_V2_i];
 $game_type_V2_item['S_ROW_COUNT'] = $game_type_V2_i;
 $game_type_V2_item['S_NUM_ROWS'] = $game_type_V2_count;

?>
                 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="<?php echo isset($this->vars['GAME_WIDTH']) ? $this->vars['GAME_WIDTH'] : $this->lang('GAME_WIDTH'); ?>" height="<?php echo isset($this->vars['GAME_HEIGHT']) ? $this->vars['GAME_HEIGHT'] : $this->lang('GAME_HEIGHT'); ?>">
                        <param name="movie" value="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>">
                        <param name="quality" value="high">
                        <param name="menu" value="false">
                        <embed src="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>"  pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo isset($this->vars['GAME_WIDTH']) ? $this->vars['GAME_WIDTH'] : $this->lang('GAME_WIDTH'); ?>" height="<?php echo isset($this->vars['GAME_HEIGHT']) ? $this->vars['GAME_HEIGHT'] : $this->lang('GAME_HEIGHT'); ?>">
                        </embed>
                </object>
            <?php

} // END game_type_V2

if(isset($game_type_V2_item)) { unset($game_type_V2_item); } 

?>

                                </td>
                                <td align="left" valign="top">
                                <?php

$avatar_best_player_right_count = ( isset($this->_tpldata['avatar_best_player_right.']) ) ?  sizeof($this->_tpldata['avatar_best_player_right.']) : 0;
for ($avatar_best_player_right_i = 0; $avatar_best_player_right_i < $avatar_best_player_right_count; $avatar_best_player_right_i++)
{
 $avatar_best_player_right_item = &$this->_tpldata['avatar_best_player_right.'][$avatar_best_player_right_i];
 $avatar_best_player_right_item['S_ROW_COUNT'] = $avatar_best_player_right_i;
 $avatar_best_player_right_item['S_NUM_ROWS'] = $avatar_best_player_right_count;

?>
                       <table width="100%" class="bodyline" cellpadding="2" cellspacing="1"> 
                       <tr> 
                          <td class="row2" align="center" colspan="3"><span class="cattitle"><?php echo isset($this->vars['L_ACTUAL_WINNER']) ? $this->vars['L_ACTUAL_WINNER'] : $this->lang('L_ACTUAL_WINNER'); ?></span></td> 
                       </tr> 
                               <tr> 
                                  <td class="row1" align="center" colspan="3"><?php echo isset($this->vars['FIRST_AVATAR']) ? $this->vars['FIRST_AVATAR'] : $this->lang('FIRST_AVATAR'); ?></td> 
                       </tr> 
                       <tr> 
                          <td class="row1" align="center" colspan="3"><span class="genmed"><strong><?php echo isset($this->vars['BEST_USER_NAME']) ? $this->vars['BEST_USER_NAME'] : $this->lang('BEST_USER_NAME'); ?></strong></span></td>
                       </tr> 
                       </table>
                                <table><tr><td></td></tr></table> 
                                <?php

} // END avatar_best_player_right

if(isset($avatar_best_player_right_item)) { unset($avatar_best_player_right_item); } 

?>

                                        <table width="100%" class="bodyline" cellpadding="2" cellspacing="1" >
                                        <tr>
                                                <td class="row2" align="center" colspan="3"><span class="cattitle"><?php echo isset($this->vars['L_TOP']) ? $this->vars['L_TOP'] : $this->lang('L_TOP'); ?></span></td>
                                        </tr>
                                        <?php

$scorerow_count = ( isset($this->_tpldata['scorerow.']) ) ?  sizeof($this->_tpldata['scorerow.']) : 0;
for ($scorerow_i = 0; $scorerow_i < $scorerow_count; $scorerow_i++)
{
 $scorerow_item = &$this->_tpldata['scorerow.'][$scorerow_i];
 $scorerow_item['S_ROW_COUNT'] = $scorerow_i;
 $scorerow_item['S_NUM_ROWS'] = $scorerow_count;

?>
                                        <tr>
                                        <td class="row1" align="center"><span class="gensmall"><?php echo isset($scorerow_item['POS']) ? $scorerow_item['POS'] : ''; ?></span></td>
                                        <td class="row1" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                         <td align=center><span class="gensmall"><?php echo isset($scorerow_item['USERNAME']) ? $scorerow_item['USERNAME'] : ''; ?></span></td>
                                                         <td width="25" align="center"><?php echo isset($scorerow_item['URL_STATS']) ? $scorerow_item['URL_STATS'] : ''; ?></td>
                                                        </tr>
                                                        </table>
                                        </td>
                                        <td class="row1" align="center"><span class='gensmall'><?php echo isset($scorerow_item['SCORE']) ? $scorerow_item['SCORE'] : ''; ?></span></td>
                                        </tr>
                                        <?php

} // END scorerow

if(isset($scorerow_item)) { unset($scorerow_item); } 

?>
                                        </table>
                                </td>
                        </tr>
                </table>
         </td>
 </tr>
</table>
<?php echo isset($this->vars['WHOISPLAYING']) ? $this->vars['WHOISPLAYING'] : $this->lang('WHOISPLAYING'); ?>
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td align="center">[<?php echo isset($this->vars['URL_ARCADE']) ? $this->vars['URL_ARCADE'] : $this->lang('URL_ARCADE'); ?>]&nbsp;-&nbsp;[<?php echo isset($this->vars['URL_BESTSCORES']) ? $this->vars['URL_BESTSCORES'] : $this->lang('URL_BESTSCORES'); ?>]&nbsp;-&nbsp;[<?php echo isset($this->vars['URL_SCOREBOARD']) ? $this->vars['URL_SCOREBOARD'] : $this->lang('URL_SCOREBOARD'); ?>]&nbsp;-&nbsp;[&nbsp;<?php echo isset($this->vars['MANAGE_COMMENTS']) ? $this->vars['MANAGE_COMMENTS'] : $this->lang('MANAGE_COMMENTS'); ?>]</td>
   </tr>
  </table>