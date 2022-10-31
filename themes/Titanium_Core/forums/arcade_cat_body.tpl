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
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="bodyline">
<tr> 
<th class="arcadeThTop left" height="28" align="left" width="33.3%">&nbsp;<a class="arcadeTitleLink" href="modules.php?name=Forums&file=arcade">Arcade</a><i class="arcadeArrow fas fa-arrow-right" aria-hidden="true"></i> 
<span class="arcadeTextPink">{L_GAME}</span></th>
</tr>
<tr>
<td align="center" width="100%" colspan="3">
<div align="center" style="padding-top:6px;">
</div>
<div align="right">
<table width="100%">
{WHOISPLAYING}
<br />
<!-- BEGIN favrow -->
<table width="100%" cellpadding="2" cellspacing="3" border="0"> 
        <tr>
        <td>
                
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
        <td class="arcadeRow1" colspan="6"><span class="arcadeTitlePink">{FAV}</span></td>
</tr>
          
          <!-- BEGIN fav_row -->
          <tr>
                        <td class="arcadeRow1" width="35">{favrow.fav_row.GAMEPICF}</td>
                        
                        <td class="arcadeRow1" width="240" align="center">
                        {favrow.fav_row.GAMELINKF}<br />
                        <span class='genmed'>{favrow.fav_row.GAMEPOPUPLINKF}</span><br />
                        <span class='arcadeTextWhite'>Plays {favrow.fav_row.GAMESETF}</span>
                        </td>
                        
                        <td class="arcadeRow1" width="238" align="center" valign="center" >
                                <span class='arcadeTextWhite'>{favrow.fav_row.NORECORDF}
                                <!-- BEGIN recordrow -->
                                <strong>{favrow.fav_row.HIGHSCOREF}</strong></span><span class='gensmall'>   {favrow.fav_row.HIGHUSERF}<br />{favrow.fav_row.DATEHIGHF}
                                <!-- END recordrow -->
                                 </span>
                        </td>
                        
                        <td class="arcadeRow1" width="150" align="center" valign="center" >
                                <span class='gen'>{favrow.fav_row.NOSCOREF}
                                <!-- BEGIN yourrecordrow -->
                                <strong><span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">{favrow.fav_row.YOURHIGHSCOREF}</span>{favrow.fav_row.IMGFIRSTF}</strong></span><span class='gensmall'><br />{favrow.fav_row.YOURDATEHIGHF}
                                <!-- END yourrecordrow -->
                                 <!-- BEGIN playrecordrow -->
                                <strong>{favrow.fav_row.CLICKPLAY}</strong>
                                   <!-- END playrecordrow -->
                                </span>   
                        </td>
                        
                        <td class="arcadeRow1" align="center" valign="center">
                                <table width="100%">
                                        <tr>
                                                 <td align="center">
                                                        <span class="arcadeTextDescription">{favrow.fav_row.GAMEDESCF}</span>
                                                 </td>
                                                <td width="25">{favrow.fav_row.URL_SCOREBOARDF}</td>
                                        </tr>
                                </table>
                          </td>
                          
                  
                         <td width="8%" class="arcadeRow1" align="center" valign="center">
                         {favrow.fav_row.DELFAVORI}
                         </td>


</tr>                 

<!-- END fav_row -->
<tr>
<td class="arcadeRow1" colspan="6"><span class="cattitle">&nbsp;</span></td>
</tr>
</table>
<div align="center" style="padding-top:24px;">
</div>
</td></tr>
</table> 
<!-- END favrow --> 
  <table width="100%" cellpadding="2" cellspacing="3" border="0">
<!-- BEGIN cat_row -->
    <tr>
        <td>
          <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
          <tr>
            <td class="arcadeRow1" colspan="{ARCADE_COL}"><span class="arcadeTitlePink">{cat_row.CATTITLE} Games</span></td>
          </tr>
<tr> 
<td class="arcadeRow1" height="28" align="center" colspan="2"><span class="cattitle">{L_GAME}</span></td> 
<td class="arcadeRow1" nowrap="nowrap" align="center"><span class="cattitle">{L_HIGHSCORE}</span></td> 
<td class="arcadeRow1" nowrap="nowrap" align="center"><span class="cattitle">{L_YOURSCORE}</span></td> 
<td class="arcadeRow1" nowrap="nowrap" align="center" colspan="{ARCADE_COL1}"><span class="cattitle">{L_DESC}</span></td> 

</tr>
<!-- BEGIN game_row -->
          <tr>
            <td class="arcadeRow1" width="35">{cat_row.game_row.GAMEPIC}</td>
            <td class="arcadeRow1" width="240" align="center">
                <span class='arcadeTitleLink'>{cat_row.game_row.GAMELINK}</span><br />
                <span class='genmed'>{cat_row.game_row.GAMEPOPUPLINK}</span><br />
                <span class='arcadeTextWhite'>Plays {cat_row.game_row.GAMESET}</span>
                </td>
        <td class="arcadeRow1" width="238" align="center" valign="center" >
                <span class='gen'>
                {cat_row.game_row.NORECORD}
          <!-- BEGIN recordrow -->
        <strong><span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">{cat_row.game_row.HIGHSCORE}</strong></span><span class='arcadeTextWhite'>{cat_row.game_row.HIGHUSER}&nbsp;&nbsp;<img src="modules/Forums/templates/subSilver/images/couronne.gif" align="absmiddle"><br />{cat_row.game_row.DATEHIGH}
           <!-- END recordrow -->
            </span>
           
        </td>
        <td class="arcadeRow1" width="150" align="center" valign="center" >
        <span class='arcadeTextWhite'>
            {cat_row.game_row.NOSCORE}
          <!-- BEGIN yourrecordrow -->
        <strong><span class="genmed w3-tag w3-round w3-green w3-border w3-border-pink">{cat_row.game_row.YOURHIGHSCORE}</span>{cat_row.game_row.IMGFIRST}</strong></span><span class='gensmall'><br />{cat_row.game_row.YOURDATEHIGH}
           <!-- END yourrecordrow -->
         <!-- BEGIN playrecordrow -->
        <strong>{cat_row.game_row.CLICKPLAY}</strong>
           <!-- END playrecordrow -->

            </span>   
        </td>
        <td class="arcadeRow1" align="center" valign="center">
                <table width="100%">
                <tr>
                 <td align="center">
                <span class="arcadeTextDescription">{cat_row.game_row.GAMEDESC}</span>
                 </td>
                 <td width="25">{cat_row.game_row.URL_SCOREBOARD}</td>
            </tr>
                </table>
          </td>
 {cat_row.game_row.ADD_FAV}
          </tr>
<!-- END game_row -->
          <tr>
            <td class="arcadeRow1" colspan="{ARCADE_COL}" align="{cat_row.LINKCAT_ALIGN}"><span class="arcadeTitleLink"><a href="{cat_row.U_ARCADE}">{cat_row.L_ARCADE}</a></span></td>
          </tr>
          </table>
        <div align="center" style="padding-top:17px;">
        </div>
        </td>  
        </tr>
<!-- END cat_row -->
    </table>
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
<td class="arcadeRow1" align="center"><span class="arcadePink">[</span>&nbsp;{URL_ARCADE}<span class="arcadePink">]</span>&nbsp;-&nbsp;<span class="arcadePink">[</span>&nbsp;{URL_BESTSCORES}<span class="arcadePink">]</span>&nbsp;-&nbsp;<span class="arcadePink">[</span>&nbsp;{MANAGE_COMMENTS}<span class="arcadePink">]</span></td>
   </tr>
  </table>