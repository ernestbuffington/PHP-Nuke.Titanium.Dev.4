<script>
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
{HEADINGARCADE}
<!-- HEADINGARCADE END -->

<!-- Arcade -> Games START -->
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="arcadeRow1" align="left" valign="middle" width="100%">
&nbsp;<a class="arcadeTitleLink" href="modules.php?name=Forums&file=arcade">Arcade</a><i class="arcadeArrow fas fa-arrow-right" aria-hidden="true"></i> 
<span class="arcadeTextPink">{L_GAME}</span>                        
</td>
</tr>
</table>
<!-- Arcade -> Games END -->

{WHOISPLAYING}

<!-- padding between Arcade header and favorites tables START -->
<div align="center" style="padding-top:17px;">
</div>
<!-- padding between Arcade header and favorites tables END -->

<!-- BEGIN favrow -->
<!-- BEGIN favorites table -->
<table width="100%" cellpadding="2" cellspacing="3" border="0"> 
<tr>
<td>

<!-- game favorites table START -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<td class="arcadeRow1" colspan="6"><span class="arcadeTitlePink">{FAV}</span></td>
</tr>
         
<!-- BEGIN fav_row -->
<tr>

<!-- game pics favorites favrow.fav_row.GAMEPICF START -->
<td class="arcadeRow1" width="35">{favrow.fav_row.GAMEPICF}</td>
<!-- game pics favorites favrow.fav_row.GAMEPICF END -->
                       
<td class="arcadeRow1" width="100" align="center">

<!-- main game link favorites favrow.fav_row.GAMELINKF START -->
{favrow.fav_row.GAMELINKF}<br />
<!-- main game link favorites favrow.fav_row.GAMELINKF END -->

<!-- main game popup link favorites favrow.fav_row.GAMEPOPUPLINKF START -->
<span class='genmed'>{favrow.fav_row.GAMEPOPUPLINKF}</span><br />
<!-- main game popup link favorites favrow.fav_row.GAMEPOPUPLINKF END -->

<!-- how many game plays favorites favrow.fav_row.GAMESETF START -->
{favrow.fav_row.GAMESETF}
<!-- how many game plays favorites favrow.fav_row.GAMESETF END -->

</td>
                        
<td class="arcadeRow1" width="150" align="center" valign="center" >

<!-- BEGIN recordrow -->
<!-- High score favorites col 3 favrow.fav_row.NORECORDF and favrow.fav_row.HIGHSCOREF START -->
<span class='gen'>{favrow.fav_row.NORECORDF}{favrow.fav_row.HIGHSCOREF}</span>
<!-- High score favorites col 3 favrow.fav_row.NORECORDF and favrow.fav_row.HIGHSCOREF END -->
</br>
<!-- High score username favorites col 3 favrow.fav_row.HIGHUSERF START -->
{favrow.fav_row.HIGHUSERF}
<!-- High score username favorites col 3 favrow.fav_row.HIGHUSERF END -->
<br />
<!-- High score date favorites col 3 favrow.fav_row.DATEHIGHF START -->
{favrow.fav_row.DATEHIGHF}
<!-- High score date favorites col 3 favrow.fav_row.DATEHIGHF END -->

<!-- END recordrow -->

</td>
                        
<td class="arcadeRow1" width="150" align="center" valign="center" >

<!-- NO WINNER favrow.fav_row.NOSCOREF START -->
{favrow.fav_row.NOSCOREF}
<!-- NO WINNER favrow.fav_row.NOSCOREF END -->

<!-- BEGIN yourrecordrow -->
<!-- game trophy image for 1st place winners only favrow.fav_row.IMGFIRSTF START -->
<strong>{favrow.fav_row.IMGFIRSTF}
<div align="center" style="padding-top:2px;">
</div>
<!-- game trophy image for 1st place winners only favrow.fav_row.IMGFIRSTF END -->

<!-- Your high score and date for favorites favrow.fav_row.YOURHIGHSCOREF and favrow.fav_row.YOURDATEHIGHF START -->
{favrow.fav_row.YOURHIGHSCOREF}</strong><br />{favrow.fav_row.YOURDATEHIGHF}
<!-- Your high score and date for favorites favrow.fav_row.YOURHIGHSCOREF and favrow.fav_row.YOURDATEHIGHF END -->
<!-- END yourrecordrow -->

<!-- BEGIN playrecordrow -->
<!-- Click to play favorites only favrow.fav_row.CLICKPLAY START -->
<strong>{favrow.fav_row.CLICKPLAY}</strong>
<!-- Click to play favorites only favrow.fav_row.CLICKPLAY END -->
<!-- END playrecordrow -->
</td>
                        
<td class="arcadeRow1" align="center" valign="center">

<table width="100%">
<tr>

<td align="center">
<!-- game description for favorites favrow.fav_row.GAMEDESCF START -->
{favrow.fav_row.GAMEDESCF}
<!-- game description for favorites favrow.fav_row.GAMEDESCF END -->
</td>

<!-- scoreboard link for each game favrow.fav_row.URL_SCOREBOARDF START -->
<td width="25">{favrow.fav_row.URL_SCOREBOARDF}</td>
<!-- scoreboard link for each game favrow.fav_row.URL_SCOREBOARDF END -->

</tr>
</table>
<!-- game favorites table END -->






</td>
                          
<td class="arcadeRow1" align="center" valign="center">
<!-- delete or remove a game from your favorites START -->
{favrow.fav_row.DELFAVORI}
<!-- delete or remove a game from your favorites END -->
</td>

</tr>                 
<!-- END fav_row -->
</table>
<!-- END favorites table -->

</td></tr>
</table> 
<!-- END favrow -->

<!-- spacer between favorites and game tables START -->
<div align="center" style="padding-top:17px;"></div> 
<!-- spacer between favorites and game tables END -->

  <table width="100%" cellpadding="2" cellspacing="3" border="0">
<!-- BEGIN cat_row -->
    <tr>
        <td>
        <!-- padding between Arcade Tables START -->
              <div align="center" style="padding-top:17px;">
        </div>
        <!-- padding between Arcade Tables END -->
          <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
          <tr>
            <td class="arcadeRow1" colspan="{ARCADE_COL}"><span class="arcadeTitlePink">{cat_row.CATTITLE} Games</span></td>
          </tr>
<tr> 
<td class="arcadeRow2" height="28" align="center" colspan="2"><span class="cattitle">{L_GAME}</span></td> 
<td class="arcadeRow2" nowrap="nowrap" align="center"><span class="cattitle">{L_HIGHSCORE}</span></td> 
<td class="arcadeRow2" nowrap="nowrap" align="center"><span class="cattitle">{L_YOURSCORE}</span></td> 
<td class="arcadeRow2" nowrap="nowrap" align="center" colspan="{ARCADE_COL1}"><span class="cattitle">{L_DESC}</span></td> 

</tr>
<!-- BEGIN game_row -->
<tr>

<td class="arcadeRow1" width="35">{cat_row.game_row.GAMEPIC}</td>

<td class="arcadeRow1" width="100" align="center">
<!-- game title link in regular arcade table START -->
{cat_row.game_row.GAMELINK}<br />
<!-- game title link in regular arcade table END -->

<!-- game title pop up link in regular arcade table START -->
{cat_row.game_row.GAMEPOPUPLINK}<br />
<!-- game title pop up link in regular arcade table END -->

<!-- how many game plays START -->
{cat_row.game_row.GAMESET}
<!-- how many game plays END -->

</td>

<td class="arcadeRow1" width="150" align="center" valign="center" >

<!-- NO CHAMPION START -->
{cat_row.game_row.NORECORD}
<!-- NO CHAMPION END -->

<!-- BEGIN recordrow -->

<!-- high score user badge START -->
<span class='gensmall'>&nbsp;&nbsp;<strong>{cat_row.game_row.HIGHSCORE}</strong><br />
<!-- high score user badge END -->

<!-- high score user name cat_row.game_row.HIGHUSER START -->
<strong>{cat_row.game_row.HIGHUSER}</strong><br />
<!-- high score user name cat_row.game_row.HIGHUSER END -->

{cat_row.game_row.DATEHIGH}
<!-- END recordrow -->
</span>
</td>

<td class="arcadeRow1" width="150" align="center" valign="center" >
<!-- NO CHAMPION cat_row.game_row.NOSCORE START -->
{cat_row.game_row.NOSCORE}
<!-- NO CHAMPION cat_row.game_row.NOSCORE END -->

<!-- game trophy image for 1st place winners only cat_row.game_row.IMGFIRST START -->
<strong>{cat_row.game_row.IMGFIRST}
<!-- game trophy image for 1st place winners only cat_row.game_row.IMGFIRST END -->

<!-- padding between trophy and your high score date START -->
<div align="center" style="padding-top:2px;">
</div>
<!-- padding between trophy and your high score date END -->

<!-- Your high score and date of high score cat_row.game_row.YOURHIGHSCORE and cat_row.game_row.YOURDATEHIGH START -->
{cat_row.game_row.YOURHIGHSCORE}</strong><br />{cat_row.game_row.YOURDATEHIGH}
<!-- Your high score and date of high score cat_row.game_row.YOURHIGHSCORE and cat_row.game_row.YOURDATEHIGH END -->

<!-- click to play START cat_row.game_row.CLICKPLAY -->
{cat_row.game_row.CLICKPLAY}
<!-- click to play cat_row.game_row.CLICKPLAY END -->

</td>

<td class="arcadeRow1" align="center" valign="center">

<table width="100%">
<tr>
<td align="center">
<!-- game description for regular game list cat_row.game_row.GAMEDESC START -->
{cat_row.game_row.GAMEDESC}
<!-- game description for regular game list cat_row.game_row.GAMEDESC END -->
</td>

<!-- link to current game scoreboard cat_row.game_row.URL_SCOREBOARD START -->
<td width="25">{cat_row.game_row.URL_SCOREBOARD}</td>
<!-- link to current game scoreboard cat_row.game_row.URL_SCOREBOARD END -->

</tr>
</table>

</td>
<!-- Add game to favorites cat_row.game_row.ADD_FAV START -->
 {cat_row.game_row.ADD_FAV}
<!-- Add game to favorites cat_row.game_row.ADD_FAV END -->
</tr>
<!-- END game_row -->
<tr>

<!-- View all games for this category cat_row.U_ARCADE and cat_row.L_ARCADE START -->
<td class="arcadeRow1" colspan="{ARCADE_COL}" align="{cat_row.LINKCAT_ALIGN}"><a class="arcadeTitlePink" href="{cat_row.U_ARCADE}">{cat_row.L_ARCADE}</a></td>
<!-- View all games for this category cat_row.U_ARCADE and cat_row.L_ARCADE END -->
</tr>

</table>
</td>  
</tr>
<!-- END cat_row -->
</table>


<!-- padding between Arcade Tables and links at the bottom of the Arcade Page START -->
<div align="center" style="padding-top:17px;">
</div>
<!-- padding between Arcade Tables and links at the bottom of the Arcade Page END -->


<table width="100%" cellpadding="5" cellspacing="1" border="0">
<tr>
<!-- [ Arcade ] - [ All Games High Scores ] - [ Comments ] URL_ARCADE URL_BESTSCORES MANAGE_COMMENTS START -->
<td class="arcadeRow1" align="center">[&nbsp;{URL_ARCADE}]&nbsp;-&nbsp;[&nbsp;{URL_BESTSCORES}]&nbsp;-&nbsp;[&nbsp;{MANAGE_COMMENTS}]</td>
<!-- [ Arcade ] - [ All Games High Scores ] - [ Comments ] URL_ARCADE URL_BESTSCORES MANAGE_COMMENTS END -->
</tr>
</table>