<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 13:23:00 +0000 (time=1672320180)

?><script>
function resize_avatar(image)
{
  if (<?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?>>0)
  {
        if (image.width > <?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?> ) image.width=<?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?> ;
  }
}
</script>
<!-- index phrase display --> 
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="bodyline">
<tr> 
<th class="arcadeThTop left" height="28" align="left" width="33.3%">&nbsp;<a class="arcadeTitleLink" href="modules.php?name=Forums&file=arcade">Arcade</a><i class="arcadeArrow fas fa-arrow-right" aria-hidden="true"></i> 
<?php echo isset($this->vars['CAT_TITLE']) ? $this->vars['CAT_TITLE'] : $this->lang('CAT_TITLE'); ?><i class="arcadeArrow fas fa-arrow-right" aria-hidden="true"></i> <span class="arcadeTextPink"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span> </th>
        <th class="arcadeThTop" height="28" align="center" width="33.3%"><span class="arcadeText"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span></th></th>
        <th class="arcadeThTop" height="28" align="center" width="33.3%"><span class="arcadeText">High Score Winners</span></th>
  </tr>
  <tr>
<td align="center" width="100%" colspan="3">
<div align="center" style="padding-top:6px;">
</div>
<div align="right">
<table width="100%">
                        
<?php

$avatar_best_player_left_count = ( isset($this->_tpldata['avatar_best_player_left.']) ) ?  sizeof($this->_tpldata['avatar_best_player_left.']) : 0;
for ($avatar_best_player_left_i = 0; $avatar_best_player_left_i < $avatar_best_player_left_count; $avatar_best_player_left_i++)
{
 $avatar_best_player_left_item = &$this->_tpldata['avatar_best_player_left.'][$avatar_best_player_left_i];
 $avatar_best_player_left_item['S_ROW_COUNT'] = $avatar_best_player_left_i;
 $avatar_best_player_left_item['S_NUM_ROWS'] = $avatar_best_player_left_count;

?>
<td align="center" valign="top" width="450"> 
 <div align="left">
 <table width="450" border="0" class="bodyline" cellpadding="2" cellspacing="1" > 

 <tr> 
 <td class="arcadeRow1" align="center" colspan="3"><span class="arcadeTextWhite"><?php echo isset($this->vars['L_ACTUAL_WINNER']) ? $this->vars['L_ACTUAL_WINNER'] : $this->lang('L_ACTUAL_WINNER'); ?></span></td> 
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><?php echo isset($this->vars['FIRST_AVATAR']) ? $this->vars['FIRST_AVATAR'] : $this->lang('FIRST_AVATAR'); ?></td> 
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><strong><span class="arcadeTextWhite"><?php echo isset($this->vars['BEST_USER_NAME']) ? $this->vars['BEST_USER_NAME'] : $this->lang('BEST_USER_NAME'); ?></span></strong></td> 
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['GAMES_PLAYED']) ? $this->vars['GAMES_PLAYED'] : $this->lang('GAMES_PLAYED'); ?></span></td>
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['BEST_TIME']) ? $this->vars['BEST_TIME'] : $this->lang('BEST_TIME'); ?></span></td>
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['BEST_USER_DATE']) ? $this->vars['BEST_USER_DATE'] : $this->lang('BEST_USER_DATE'); ?></span></td> 
 </tr>

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed"><?php echo isset($this->vars['COMMENTS']) ? $this->vars['COMMENTS'] : $this->lang('COMMENTS'); ?></span></td> 

 <tr> 
 <td class="arcadeRow2" width="288" class="row1" align="center" colspan="3"><span class="genmed"><strong>Hi-Score<br /><strong><span class="w3-tag w3-round w3-green w3-border w3-border-pink"><?php echo isset($this->vars['HIGHSCORE']) ? $this->vars['HIGHSCORE'] : $this->lang('HIGHSCORE'); ?></span></strong></strong></span></td> 
 </tr>

 <tr> 
 <td class="arcadeRow1" width="288" class="row1" align="center" colspan="3">&nbsp;</td> 
 </tr>

 </tr>  
 </table>
 </div>




</td>
<?php

} // END avatar_best_player_left

if(isset($avatar_best_player_left_item)) { unset($avatar_best_player_left_item); } 

?>
<td class="bodyline" align="center" valign="top"></br>
<?php

$game_type_V5_count = ( isset($this->_tpldata['game_type_V5.']) ) ?  sizeof($this->_tpldata['game_type_V5.']) : 0;
for ($game_type_V5_i = 0; $game_type_V5_i < $game_type_V5_count; $game_type_V5_i++)
{
 $game_type_V5_item = &$this->_tpldata['game_type_V5.'][$game_type_V5_i];
 $game_type_V5_item['S_ROW_COUNT'] = $game_type_V5_i;
 $game_type_V5_item['S_NUM_ROWS'] = $game_type_V5_count;

?>
<div id="container"> </div>

       <script>
          window.RufflePlayer = {
            config: {
              autoplay: "on",
            wmode: "transparent",
            scale: "showAll",
              unmuteOverlay: "hidden",
            }
          };
       </script>
                 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0">
                        <param name="movie" value="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>?arcade_hash=<?php echo isset($this->vars['GAMEHASH']) ? $this->vars['GAMEHASH'] : $this->lang('GAMEHASH'); ?>">
                        <param name="quality" value="high">
                        <param name="menu" value="false">
                        <embed src="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>?arcade_hash=<?php echo isset($this->vars['GAMEHASH']) ? $this->vars['GAMEHASH'] : $this->lang('GAMEHASH'); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash">
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
<div id="container"> </div>

       <script>
          window.RufflePlayer = {
            config: {
              autoplay: "on",
            wmode: "transparent",
            scale: "showAll",
              unmuteOverlay: "hidden",
            }
          };
       </script>            
                 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0">
                        <param name="movie" value="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>">
                        <param name="quality" value="high">
                        <param name="menu" value="false">

                        <embed src="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>"  pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash">
                        </embed>
                </object>
            <?php

} // END game_type_V2

if(isset($game_type_V2_item)) { unset($game_type_V2_item); } 

?>

                                </td>
                                <td align="left" valign="top" width="450">
                                <?php

$avatar_best_player_right_count = ( isset($this->_tpldata['avatar_best_player_right.']) ) ?  sizeof($this->_tpldata['avatar_best_player_right.']) : 0;
for ($avatar_best_player_right_i = 0; $avatar_best_player_right_i < $avatar_best_player_right_count; $avatar_best_player_right_i++)
{
 $avatar_best_player_right_item = &$this->_tpldata['avatar_best_player_right.'][$avatar_best_player_right_i];
 $avatar_best_player_right_item['S_ROW_COUNT'] = $avatar_best_player_right_i;
 $avatar_best_player_right_item['S_NUM_ROWS'] = $avatar_best_player_right_count;

?>
                       			<div align="right">
                       <table width="450" class="bodyline" cellpadding="2" cellspacing="1"> 
                       <tr> 
                          <td class="row2" align="center" colspan="3"><span class="cattitle"><?php echo isset($this->vars['L_ACTUAL_WINNER']) ? $this->vars['L_ACTUAL_WINNER'] : $this->lang('L_ACTUAL_WINNER'); ?></span></td> 
                       </tr> 
                               <tr> 
                                  <td class="row1" align="center" colspan="3"><?php echo isset($this->vars['FIRST_AVATAR']) ? $this->vars['FIRST_AVATAR'] : $this->lang('FIRST_AVATAR'); ?></td> 
                       </tr> 
                       <tr> 
                          <td class="row1" align="center" colspan="3"><strong><font size="2"><?php echo isset($this->vars['BEST_USER_NAME']) ? $this->vars['BEST_USER_NAME'] : $this->lang('BEST_USER_NAME'); ?></font></strong></td>
                       </tr> 
                       </table>
                                </div>
                                <table><tr><td></td></tr></table> 
                                <?php

} // END avatar_best_player_right

if(isset($avatar_best_player_right_item)) { unset($avatar_best_player_right_item); } 

?>

                                        <table width="450" class="bodyline" cellpadding="2" cellspacing="1" >
                                        <tr>
                                                <td class="arcadeRow1" align="center" colspan="3"><span class="arcadeTextWhite"><?php echo isset($this->vars['L_TOP']) ? $this->vars['L_TOP'] : $this->lang('L_TOP'); ?></span></td>
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
                                        <td class="arcadeRow2" align="center"><span class="arcadeTextWhite"><font color="gold" size="5"><i class="bi bi-trophy"></i></font></span>&nbsp;&nbsp;<span class="arcadeTextWhite"><font size="5"><?php echo isset($scorerow_item['POS']) ? $scorerow_item['POS'] : ''; ?><?php echo isset($scorerow_item['TROPHY']) ? $scorerow_item['TROPHY'] : ''; ?></font></span></td>
                                        <td class="arcadeRow2" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                         <td align=center><span class="arcadeText"><?php echo isset($scorerow_item['USERNAME']) ? $scorerow_item['USERNAME'] : ''; ?></span></td>
                                                         <td width="25" align="center"><?php echo isset($scorerow_item['URL_STATS']) ? $scorerow_item['URL_STATS'] : ''; ?></td>
                                                        </tr>
                                                        </table>
                                        </td>
                                        <td class="arcadeRow2" align="center"><span class="w3-tag w3-round w3-green w3-border w3-border-pink"><?php echo isset($scorerow_item['SCORE']) ? $scorerow_item['SCORE'] : ''; ?></span></td>
                                        </tr>
                                        <?php

} // END scorerow

if(isset($scorerow_item)) { unset($scorerow_item); } 

?>
                                        </table>
                                </td>
                        </tr>
                </table>
         		</div>
         
 </tr>
</table>
<?php echo isset($this->vars['WHOISPLAYING']) ? $this->vars['WHOISPLAYING'] : $this->lang('WHOISPLAYING'); ?>
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td class="arcadeRow1"><div align="center"><span class="arcadePink">[ <?php echo isset($this->vars['URL_ARCADE']) ? $this->vars['URL_ARCADE'] : $this->lang('URL_ARCADE'); ?> ]</span>&nbsp;-&nbsp;<span class="arcadePink">[ <?php echo isset($this->vars['URL_BESTSCORES']) ? $this->vars['URL_BESTSCORES'] : $this->lang('URL_BESTSCORES'); ?> ]</span>&nbsp;-&nbsp;<span class="arcadePink">[ <?php echo isset($this->vars['URL_SCOREBOARD']) ? $this->vars['URL_SCOREBOARD'] : $this->lang('URL_SCOREBOARD'); ?> ]</span>&nbsp;-&nbsp;<span class="arcadePink">[ 
		<?php echo isset($this->vars['MANAGE_COMMENTS']) ? $this->vars['MANAGE_COMMENTS'] : $this->lang('MANAGE_COMMENTS'); ?> ]</span></div></td>
   </tr>
  </table>