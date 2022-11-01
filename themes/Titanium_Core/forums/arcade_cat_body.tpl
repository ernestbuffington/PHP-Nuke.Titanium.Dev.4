<script language="Javascript">
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
{HEADINGARCADE}
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
          <td align="left" valign="middle" width="100%">
                <span class="nav">
                        <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
                </span>
                <span class="nav">&nbsp;->&nbsp;{L_ARCADE}</span>
          </td>
    </tr>
  </table>
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
                
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<td class="cat" colspan="6"><span class="cattitle">{FAV}</span></td>
</tr>
         
<!-- BEGIN fav_row -->
<tr>
<td class="arcadeRow1" width="35">{favrow.fav_row.GAMEPICF}</td>
                       
<td class="arcadeRow1" width="100" align="center">
<span class='genmed'>{favrow.fav_row.GAMELINKF}</span><br />
<span class='genmed'>{favrow.fav_row.GAMEPOPUPLINKF}</span><br />
<span class='gensmall'>{favrow.fav_row.GAMESETF}</span>
</td>
                        
<td class="arcadeRow1" width="150" align="center" valign="center" >
<span class='gen'>{favrow.fav_row.NORECORDF}

<!-- BEGIN recordrow -->
<strong>{favrow.fav_row.HIGHSCOREF}</strong></span><span class='gensmall'>   {favrow.fav_row.HIGHUSERF}<br />{favrow.fav_row.DATEHIGHF}</span>
<!-- END recordrow -->

</td>
                        
<td class="arcadeRow1" width="150" align="center" valign="center" >

{favrow.fav_row.NOSCOREF}
<!-- BEGIN yourrecordrow -->
<!-- game trophy image START -->
<strong>{favrow.fav_row.IMGFIRSTF}
<div align="center" style="padding-top:2px;">
</div>
<!-- game trophy image END -->
{favrow.fav_row.YOURHIGHSCOREF}</strong><br />{favrow.fav_row.YOURDATEHIGHF}
<!-- END yourrecordrow -->

<!-- BEGIN playrecordrow -->
<strong>{favrow.fav_row.CLICKPLAY}</strong>
<!-- END playrecordrow -->
</td>
                        
<td class="arcadeRow1" align="center" valign="center">

<table width="100%">
<tr>

<td align="center">
<!-- game description for favorites START -->
{favrow.fav_row.GAMEDESCF}
<!-- game description for favorites START -->
</td>

<!-- scoreboard link for each game START -->
<td width="25">{favrow.fav_row.URL_SCOREBOARDF}</td>
<!-- scoreboard link for each game START -->
</tr>
</table>

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
    <div align="center" style="padding-top:17px;">
        </div> 
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
            <td class="cat" colspan="{ARCADE_COL}"><span class="cattitle">{cat_row.CATTITLE}</span></td>
          </tr>
<tr> 
<td class="cat" height="28" align="center" colspan="2"><span class="cattitle">{L_GAME}</span></td> 
<td class="cat" nowrap="nowrap" align="center"><span class="cattitle">{L_HIGHSCORE}</span></td> 
<td class="cat" nowrap="nowrap" align="center"><span class="cattitle">{L_YOURSCORE}</span></td> 
<td class="cat" nowrap="nowrap" align="center" colspan="{ARCADE_COL1}"><span class="cattitle">{L_DESC}</span></td> 

</tr>
<!-- BEGIN game_row -->
          <tr>
            <td class="arcadeRow1" width="35">{cat_row.game_row.GAMEPIC}</td>
            <td class="arcadeRow1" width="100" align="center">
                <span class='genmed'>{cat_row.game_row.GAMELINK}</span><br />
                <span class='genmed'>{cat_row.game_row.GAMEPOPUPLINK}</span><br />
                <span class='gensmall'>{cat_row.game_row.GAMESET}</span>
                </td>
        <td class="arcadeRow1" width="150" align="center" valign="center" >
                <span class='gen'>
                {cat_row.game_row.NORECORD}
          <!-- BEGIN recordrow -->
        <strong>{cat_row.game_row.HIGHSCORE}</strong></span><span class='gensmall'>&nbsp;&nbsp;{cat_row.game_row.HIGHUSER}<br />{cat_row.game_row.DATEHIGH}
           <!-- END recordrow -->
            </span>
           
        </td>

 <td class="arcadeRow1" width="150" align="center" valign="center" >

{cat_row.game_row.NOSCORE}
<!-- BEGIN yourrecordrow -->
<strong>{cat_row.game_row.IMGFIRST}
<div align="center" style="padding-top:2px;">
</div>
{cat_row.game_row.YOURHIGHSCORE}</strong><br />{cat_row.game_row.YOURDATEHIGH}
<!-- END yourrecordrow -->

<!-- BEGIN playrecordrow -->
{cat_row.game_row.CLICKPLAY}
<!-- END playrecordrow -->

</td>


<td class="arcadeRow1" align="center" valign="center">
<table width="100%">
<tr>
<td align="center">
<!-- game description for added favorites START -->
{cat_row.game_row.GAMEDESC}
<!-- game description for added favorites END -->
</td>
<td width="25">{cat_row.game_row.URL_SCOREBOARD}</td>
</tr>
</table>
</td>

<!-- Add game to favorites START -->
 {cat_row.game_row.ADD_FAV}
<!-- Add game to favorites END -->

</tr>
<!-- END game_row -->
<tr>

<!-- View all games for this category START -->
<td class="arcadeRow1" colspan="{ARCADE_COL}" align="{cat_row.LINKCAT_ALIGN}"><a class="arcadeTitlePink" href="{cat_row.U_ARCADE}">{cat_row.L_ARCADE}</a></td>
<!-- View all games for this category END -->
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
   <!-- [ Arcade ] - [ All Games High Scores ] - [ Comments ] START -->
   <td class="arcadeRow1" align="center">[&nbsp;{URL_ARCADE}]&nbsp;-&nbsp;[&nbsp;{URL_BESTSCORES}]&nbsp;-&nbsp;[&nbsp;{MANAGE_COMMENTS}]</td>
   <!-- [ Arcade ] - [ All Games High Scores ] - [ Comments ] END -->
   </tr>
  </table>