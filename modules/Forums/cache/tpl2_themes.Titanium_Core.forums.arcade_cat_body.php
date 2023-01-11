<?php

// eXtreme Styles mod cache. Generated on Tue, 03 Jan 2023 09:38:35 +0000 (time=1672738715)

?><script>
var win = null;

function Arcade_Popup(mypage,myname,w,h,scroll)
{
  LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
  TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
  settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',status='+scroll+',resizable=yes';
  win = window.open(mypage,myname,settings);
}
</script>
<!-- index phrase display -->

<!-- HEADINGARCADE START -->
<?php echo isset($this->vars['HEADINGARCADE']) ? $this->vars['HEADINGARCADE'] : $this->lang('HEADINGARCADE'); ?>
<!-- HEADINGARCADE END -->

<!-- Arcade -> Games START -->
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="arcadeRow1" align="left" valign="middle" width="100%">
&nbsp;<a class="arcadeTitleLink" href="modules.php?name=Forums&file=arcade">Arcade</a><i class="arcadeArrow fas fa-arrow-right" aria-hidden="true"></i> 
<span class="arcadeTextPink"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span>                        
</td>
</tr>
</table>
<!-- Arcade -> Games END -->

<?php echo isset($this->vars['WHOISPLAYING']) ? $this->vars['WHOISPLAYING'] : $this->lang('WHOISPLAYING'); ?>

<!-- padding between Arcade header and favorites tables START -->
<div align="center" style="padding-top:17px;">
</div>
<!-- padding between Arcade header and favorites tables END -->

<?php

$favrow_count = ( isset($this->_tpldata['favrow.']) ) ?  sizeof($this->_tpldata['favrow.']) : 0;
for ($favrow_i = 0; $favrow_i < $favrow_count; $favrow_i++)
{
 $favrow_item = &$this->_tpldata['favrow.'][$favrow_i];
 $favrow_item['S_ROW_COUNT'] = $favrow_i;
 $favrow_item['S_NUM_ROWS'] = $favrow_count;

?>
<!-- BEGIN favorites table -->
<table width="100%" cellpadding="2" cellspacing="3" border="0"> 
<tr>
<td>

<!-- game favorites table START -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<td class="arcadeRow1" colspan="6"><span class="arcadeTitlePink"><?php echo isset($this->vars['FAV']) ? $this->vars['FAV'] : $this->lang('FAV'); ?></span></td>
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

<!-- game pics favorites favrow.fav_row.GAMEPICF START -->
<td class="arcadeRow1" width="35"><?php echo isset($fav_row_item['GAMEPICF']) ? $fav_row_item['GAMEPICF'] : ''; ?></td>
<!-- game pics favorites favrow.fav_row.GAMEPICF END -->
                       
<td class="arcadeRow1" width="100" align="center">

<!-- main game link favorites favrow.fav_row.GAMELINKF START -->
<?php echo isset($fav_row_item['GAMELINKF']) ? $fav_row_item['GAMELINKF'] : ''; ?><br />
<!-- main game link favorites favrow.fav_row.GAMELINKF END -->

<!-- main game popup link favorites favrow.fav_row.GAMEPOPUPLINKF START -->
<span class='genmed'><?php echo isset($fav_row_item['GAMEPOPUPLINKF']) ? $fav_row_item['GAMEPOPUPLINKF'] : ''; ?></span><br />
<!-- main game popup link favorites favrow.fav_row.GAMEPOPUPLINKF END -->

<!-- how many game plays favorites favrow.fav_row.GAMESETF START -->
<?php echo isset($fav_row_item['GAMESETF']) ? $fav_row_item['GAMESETF'] : ''; ?>
<!-- how many game plays favorites favrow.fav_row.GAMESETF END -->

</td>
                        
<td class="arcadeRow1" width="150" align="center" valign="center" >

<?php

$recordrow_count = ( isset($fav_row_item['recordrow.']) ) ? sizeof($fav_row_item['recordrow.']) : 0;
for ($recordrow_i = 0; $recordrow_i < $recordrow_count; $recordrow_i++)
{
 $recordrow_item = &$fav_row_item['recordrow.'][$recordrow_i];
 $recordrow_item['S_ROW_COUNT'] = $recordrow_i;
 $recordrow_item['S_NUM_ROWS'] = $recordrow_count;

?>
<!-- High score favorites col 3 favrow.fav_row.NORECORDF and favrow.fav_row.HIGHSCOREF START -->
<span class='gen'><?php echo isset($fav_row_item['NORECORDF']) ? $fav_row_item['NORECORDF'] : ''; ?><?php echo isset($fav_row_item['HIGHSCOREF']) ? $fav_row_item['HIGHSCOREF'] : ''; ?></span>
<!-- High score favorites col 3 favrow.fav_row.NORECORDF and favrow.fav_row.HIGHSCOREF END -->
</br>
<!-- High score username favorites col 3 favrow.fav_row.HIGHUSERF START -->
<?php echo isset($fav_row_item['HIGHUSERF']) ? $fav_row_item['HIGHUSERF'] : ''; ?>
<!-- High score username favorites col 3 favrow.fav_row.HIGHUSERF END -->
<br />
<!-- High score date favorites col 3 favrow.fav_row.DATEHIGHF START -->
<?php echo isset($fav_row_item['DATEHIGHF']) ? $fav_row_item['DATEHIGHF'] : ''; ?>
<!-- High score date favorites col 3 favrow.fav_row.DATEHIGHF END -->

<?php

} // END recordrow

if(isset($recordrow_item)) { unset($recordrow_item); } 

?>

</td>
                        
<td class="arcadeRow1" width="150" align="center" valign="center" >

<!-- NO WINNER favrow.fav_row.NOSCOREF START -->
<?php echo isset($fav_row_item['NOSCOREF']) ? $fav_row_item['NOSCOREF'] : ''; ?>
<!-- NO WINNER favrow.fav_row.NOSCOREF END -->

<?php

$yourrecordrow_count = ( isset($fav_row_item['yourrecordrow.']) ) ? sizeof($fav_row_item['yourrecordrow.']) : 0;
for ($yourrecordrow_i = 0; $yourrecordrow_i < $yourrecordrow_count; $yourrecordrow_i++)
{
 $yourrecordrow_item = &$fav_row_item['yourrecordrow.'][$yourrecordrow_i];
 $yourrecordrow_item['S_ROW_COUNT'] = $yourrecordrow_i;
 $yourrecordrow_item['S_NUM_ROWS'] = $yourrecordrow_count;

?>
<!-- game trophy image for 1st place winners only favrow.fav_row.IMGFIRSTF START -->
<strong><?php echo isset($fav_row_item['IMGFIRSTF']) ? $fav_row_item['IMGFIRSTF'] : ''; ?>
<div align="center" style="padding-top:2px;">
</div>
<!-- game trophy image for 1st place winners only favrow.fav_row.IMGFIRSTF END -->

<!-- Your high score and date for favorites favrow.fav_row.YOURHIGHSCOREF and favrow.fav_row.YOURDATEHIGHF START -->
<?php echo isset($fav_row_item['YOURHIGHSCOREF']) ? $fav_row_item['YOURHIGHSCOREF'] : ''; ?></strong><br /><?php echo isset($fav_row_item['YOURDATEHIGHF']) ? $fav_row_item['YOURDATEHIGHF'] : ''; ?>
<!-- Your high score and date for favorites favrow.fav_row.YOURHIGHSCOREF and favrow.fav_row.YOURDATEHIGHF END -->
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
<!-- Click to play favorites only favrow.fav_row.CLICKPLAY START -->
<strong><?php echo isset($fav_row_item['CLICKPLAY']) ? $fav_row_item['CLICKPLAY'] : ''; ?></strong>
<!-- Click to play favorites only favrow.fav_row.CLICKPLAY END -->
<?php

} // END playrecordrow

if(isset($playrecordrow_item)) { unset($playrecordrow_item); } 

?>
</td>
                        
<td class="arcadeRow1" align="center" valign="center">

<table width="100%">
<tr>

<td align="center">
<!-- game description for favorites favrow.fav_row.GAMEDESCF START -->
<?php echo isset($fav_row_item['GAMEDESCF']) ? $fav_row_item['GAMEDESCF'] : ''; ?>
<!-- game description for favorites favrow.fav_row.GAMEDESCF END -->
</td>

<!-- scoreboard link for each game favrow.fav_row.URL_SCOREBOARDF START -->
<td width="25"><?php echo isset($fav_row_item['URL_SCOREBOARDF']) ? $fav_row_item['URL_SCOREBOARDF'] : ''; ?></td>
<!-- scoreboard link for each game favrow.fav_row.URL_SCOREBOARDF END -->

</tr>
</table>
<!-- game favorites table END -->






</td>
                          
<td class="arcadeRow1" align="center" valign="center">
<!-- delete or remove a game from your favorites START -->
<?php echo isset($fav_row_item['DELFAVORI']) ? $fav_row_item['DELFAVORI'] : ''; ?>
<!-- delete or remove a game from your favorites END -->
</td>

</tr>                 
<?php

} // END fav_row

if(isset($fav_row_item)) { unset($fav_row_item); } 

?>
</table>
<!-- END favorites table -->

</td></tr>
</table> 
<?php

} // END favrow

if(isset($favrow_item)) { unset($favrow_item); } 

?>

<!-- spacer between favorites and game tables START -->
<div align="center" style="padding-top:17px;"></div> 
<!-- spacer between favorites and game tables END -->

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
        <!-- padding between Arcade Tables START -->
              <div align="center" style="padding-top:17px;">
        </div>
        <!-- padding between Arcade Tables END -->
          <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
          <tr>
            <td class="arcadeRow1" colspan="<?php echo isset($this->vars['ARCADE_COL']) ? $this->vars['ARCADE_COL'] : $this->lang('ARCADE_COL'); ?>"><span class="arcadeTitlePink"><?php echo isset($cat_row_item['CATTITLE']) ? $cat_row_item['CATTITLE'] : ''; ?> Games</span></td>
          </tr>
<tr> 
<td class="arcadeRow2" height="28" align="center" colspan="2"><span class="cattitle"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span></td> 
<td class="arcadeRow2" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['L_HIGHSCORE']) ? $this->vars['L_HIGHSCORE'] : $this->lang('L_HIGHSCORE'); ?></span></td> 
<td class="arcadeRow2" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['L_YOURSCORE']) ? $this->vars['L_YOURSCORE'] : $this->lang('L_YOURSCORE'); ?></span></td> 
<td class="arcadeRow2" nowrap="nowrap" align="center" colspan="<?php echo isset($this->vars['ARCADE_COL1']) ? $this->vars['ARCADE_COL1'] : $this->lang('ARCADE_COL1'); ?>"><span class="cattitle"><?php echo isset($this->vars['L_DESC']) ? $this->vars['L_DESC'] : $this->lang('L_DESC'); ?></span></td> 

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

<td class="arcadeRow1" width="35"><?php echo isset($game_row_item['GAMEPIC']) ? $game_row_item['GAMEPIC'] : ''; ?></td>

<td class="arcadeRow1" width="100" align="center">
<!-- game title link in regular arcade table START -->
<?php echo isset($game_row_item['GAMELINK']) ? $game_row_item['GAMELINK'] : ''; ?><br />
<!-- game title link in regular arcade table END -->

<!-- game title pop up link in regular arcade table START -->
<?php echo isset($game_row_item['GAMEPOPUPLINK']) ? $game_row_item['GAMEPOPUPLINK'] : ''; ?><br />
<!-- game title pop up link in regular arcade table END -->

<!-- how many game plays START -->
<?php echo isset($game_row_item['GAMESET']) ? $game_row_item['GAMESET'] : ''; ?>
<!-- how many game plays END -->

</td>

<td class="arcadeRow1" width="150" align="center" valign="center" >

<!-- NO CHAMPION START -->
<?php echo isset($game_row_item['NORECORD']) ? $game_row_item['NORECORD'] : ''; ?>
<!-- NO CHAMPION END -->

<?php

$recordrow_count = ( isset($game_row_item['recordrow.']) ) ? sizeof($game_row_item['recordrow.']) : 0;
for ($recordrow_i = 0; $recordrow_i < $recordrow_count; $recordrow_i++)
{
 $recordrow_item = &$game_row_item['recordrow.'][$recordrow_i];
 $recordrow_item['S_ROW_COUNT'] = $recordrow_i;
 $recordrow_item['S_NUM_ROWS'] = $recordrow_count;

?>

<!-- high score user badge START -->
<span class='gensmall'>&nbsp;&nbsp;<strong><?php echo isset($game_row_item['HIGHSCORE']) ? $game_row_item['HIGHSCORE'] : ''; ?></strong><br />
<!-- high score user badge END -->

<!-- high score user name cat_row.game_row.HIGHUSER START -->
<strong><?php echo isset($game_row_item['HIGHUSER']) ? $game_row_item['HIGHUSER'] : ''; ?></strong><br />
<!-- high score user name cat_row.game_row.HIGHUSER END -->

<?php echo isset($game_row_item['DATEHIGH']) ? $game_row_item['DATEHIGH'] : ''; ?>
<?php

} // END recordrow

if(isset($recordrow_item)) { unset($recordrow_item); } 

?>
</span>
</td>

<td class="arcadeRow1" width="150" align="center" valign="center" >
<!-- NO CHAMPION cat_row.game_row.NOSCORE START -->
<?php echo isset($game_row_item['NOSCORE']) ? $game_row_item['NOSCORE'] : ''; ?>
<!-- NO CHAMPION cat_row.game_row.NOSCORE END -->

<!-- game trophy image for 1st place winners only cat_row.game_row.IMGFIRST START -->
<strong><?php echo isset($game_row_item['IMGFIRST']) ? $game_row_item['IMGFIRST'] : ''; ?>
<!-- game trophy image for 1st place winners only cat_row.game_row.IMGFIRST END -->

<!-- padding between trophy and your high score date START -->
<div align="center" style="padding-top:2px;">
</div>
<!-- padding between trophy and your high score date END -->

<!-- Your high score and date of high score cat_row.game_row.YOURHIGHSCORE and cat_row.game_row.YOURDATEHIGH START -->
<?php echo isset($game_row_item['YOURHIGHSCORE']) ? $game_row_item['YOURHIGHSCORE'] : ''; ?></strong><br /><?php echo isset($game_row_item['YOURDATEHIGH']) ? $game_row_item['YOURDATEHIGH'] : ''; ?>
<!-- Your high score and date of high score cat_row.game_row.YOURHIGHSCORE and cat_row.game_row.YOURDATEHIGH END -->

<!-- click to play START cat_row.game_row.CLICKPLAY -->
<?php echo isset($game_row_item['CLICKPLAY']) ? $game_row_item['CLICKPLAY'] : ''; ?>
<!-- click to play cat_row.game_row.CLICKPLAY END -->

</td>

<td class="arcadeRow1" align="center" valign="center">

<table width="100%">
<tr>
<td align="center">
<!-- game description for regular game list cat_row.game_row.GAMEDESC START -->
<?php echo isset($game_row_item['GAMEDESC']) ? $game_row_item['GAMEDESC'] : ''; ?>
<!-- game description for regular game list cat_row.game_row.GAMEDESC END -->
</td>

<!-- link to current game scoreboard cat_row.game_row.URL_SCOREBOARD START -->
<td width="25"><?php echo isset($game_row_item['URL_SCOREBOARD']) ? $game_row_item['URL_SCOREBOARD'] : ''; ?></td>
<!-- link to current game scoreboard cat_row.game_row.URL_SCOREBOARD END -->

</tr>
</table>

</td>
<!-- Add game to favorites cat_row.game_row.ADD_FAV START -->
 <?php echo isset($game_row_item['ADD_FAV']) ? $game_row_item['ADD_FAV'] : ''; ?>
<!-- Add game to favorites cat_row.game_row.ADD_FAV END -->
</tr>
<?php

} // END game_row

if(isset($game_row_item)) { unset($game_row_item); } 

?>
<tr>

<!-- View all games for this category cat_row.U_ARCADE and cat_row.L_ARCADE START -->
<td class="arcadeRow1" colspan="<?php echo isset($this->vars['ARCADE_COL']) ? $this->vars['ARCADE_COL'] : $this->lang('ARCADE_COL'); ?>" align="<?php echo isset($cat_row_item['LINKCAT_ALIGN']) ? $cat_row_item['LINKCAT_ALIGN'] : ''; ?>"><a class="arcadeTitlePink" href="<?php echo isset($cat_row_item['U_ARCADE']) ? $cat_row_item['U_ARCADE'] : ''; ?>"><?php echo isset($cat_row_item['L_ARCADE']) ? $cat_row_item['L_ARCADE'] : ''; ?></a></td>
<!-- View all games for this category cat_row.U_ARCADE and cat_row.L_ARCADE END -->
</tr>

</table>
</td>  
</tr>
<?php

} // END cat_row

if(isset($cat_row_item)) { unset($cat_row_item); } 

?>
</table>


<!-- padding between Arcade Tables and links at the bottom of the Arcade Page START -->
<div align="center" style="padding-top:17px;">
</div>
<!-- padding between Arcade Tables and links at the bottom of the Arcade Page END -->


<table width="100%" cellpadding="5" cellspacing="1" border="0">
<tr>
<!-- [ Arcade ] - [ All Games High Scores ] - [ Comments ] URL_ARCADE URL_BESTSCORES MANAGE_COMMENTS START -->
<td class="arcadeRow1" align="center">[&nbsp;<?php echo isset($this->vars['URL_ARCADE']) ? $this->vars['URL_ARCADE'] : $this->lang('URL_ARCADE'); ?>]&nbsp;-&nbsp;[&nbsp;<?php echo isset($this->vars['URL_BESTSCORES']) ? $this->vars['URL_BESTSCORES'] : $this->lang('URL_BESTSCORES'); ?>]&nbsp;-&nbsp;[&nbsp;<?php echo isset($this->vars['MANAGE_COMMENTS']) ? $this->vars['MANAGE_COMMENTS'] : $this->lang('MANAGE_COMMENTS'); ?>]</td>
<!-- [ Arcade ] - [ All Games High Scores ] - [ Comments ] URL_ARCADE URL_BESTSCORES MANAGE_COMMENTS END -->
</tr>
</table>