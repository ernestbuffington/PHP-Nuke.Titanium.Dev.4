<script>
function resize_avatar(image)
{
  if ({MAXSIZE_AVATAR}>0)
  {
        if (image.width > {MAXSIZE_AVATAR} ) image.width={MAXSIZE_AVATAR} ;
  }
}
</script>
<!-- index phrase display --> 
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="bodyline">
<tr> 
<th class="arcadeThTop left" height="28" align="left" width="33.3%">&nbsp;<a class="arcadeTitleLink" href="modules.php?name=Forums&file=arcade">Arcade</a><i class="arcadeArrow fas fa-arrow-right" aria-hidden="true"></i> 
{CAT_TITLE}<i class="arcadeArrow fas fa-arrow-right" aria-hidden="true"></i> <span class="arcadeTextPink">{L_GAME}</span> </th>
        <th class="arcadeThTop" height="28" align="center" width="33.3%"><span class="arcadeText">{L_GAME}</span></th></th>
        <th class="arcadeThTop" height="28" align="center" width="33.3%"><span class="arcadeText">High Score Winners</span></th>
  </tr>
  <tr>
<td align="center" width="100%" colspan="3">
<div align="center" style="padding-top:6px;">
</div>
<div align="right">
<table width="100%">
                        
<!-- BEGIN avatar_best_player_left -->
<td align="center" valign="top" width="450"> 
 <div align="left">
 <table width="450" border="0" class="bodyline" cellpadding="2" cellspacing="1" > 

 <tr> 
 <td class="arcadeRow1" align="center" colspan="3"><span class="arcadeTextWhite">{L_ACTUAL_WINNER}</span></td> 
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3">{FIRST_AVATAR}</td> 
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><strong><span class="arcadeTextWhite">{BEST_USER_NAME}</span></strong></td> 
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed">{GAMES_PLAYED}</span></td>
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed">{BEST_TIME}</span></td>
 </tr> 

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed">{BEST_USER_DATE}</span></td> 
 </tr>

 <tr> 
 <td class="arcadeRow2" align="center" colspan="3"><span class="genmed">{COMMENTS}</span></td> 

 <tr> 
 <td class="arcadeRow2" width="288" class="row1" align="center" colspan="3"><span class="genmed"><strong>Hi-Score<br /><strong><span class="w3-tag w3-round w3-green w3-border w3-border-pink">{HIGHSCORE}</span></strong></strong></span></td> 
 </tr>

 <tr> 
 <td class="arcadeRow1" width="288" class="row1" align="center" colspan="3">&nbsp;</td> 
 </tr>

 </tr>  
 </table>
 </div>




</td>
<!-- END avatar_best_player_left -->
<td class="bodyline" align="center" valign="top"></br>
<!-- BEGIN game_type_V5 -->
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
                        <param name="movie" value="modules/Forums/games/{SWF_GAME}?arcade_hash={GAMEHASH}">
                        <param name="quality" value="high">
                        <param name="menu" value="false">
                        <embed src="modules/Forums/games/{SWF_GAME}?arcade_hash={GAMEHASH}" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash">
                        </embed>
                </object>
            <!-- END game_type_V5 -->
            <!-- BEGIN game_type_V2 -->
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
                        <param name="movie" value="modules/Forums/games/{SWF_GAME}">
                        <param name="quality" value="high">
                        <param name="menu" value="false">

                        <embed src="modules/Forums/games/{SWF_GAME}"  pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash">
                        </embed>
                </object>
            <!-- END game_type_V2 -->

                                </td>
                                <td align="left" valign="top" width="450">
                                <!-- BEGIN avatar_best_player_right -->
                       			<div align="right">
                       <table width="450" class="bodyline" cellpadding="2" cellspacing="1"> 
                       <tr> 
                          <td class="row2" align="center" colspan="3"><span class="cattitle">{L_ACTUAL_WINNER}</span></td> 
                       </tr> 
                               <tr> 
                                  <td class="row1" align="center" colspan="3">{FIRST_AVATAR}</td> 
                       </tr> 
                       <tr> 
                          <td class="row1" align="center" colspan="3"><strong><font size="2">{BEST_USER_NAME}</font></strong></td>
                       </tr> 
                       </table>
                                </div>
                                <table><tr><td></td></tr></table> 
                                <!-- END avatar_best_player_right -->

                                        <table width="450" class="bodyline" cellpadding="2" cellspacing="1" >
                                        <tr>
                                                <td class="arcadeRow1" align="center" colspan="3"><span class="arcadeTextWhite">{L_TOP}</span></td>
                                        </tr>
                                        <!-- BEGIN scorerow -->
                                        <tr>
                                        <td class="arcadeRow2" align="center"><span class="arcadeTextWhite"><font color="gold" size="5"><i class="bi bi-trophy"></i></font></span>&nbsp;&nbsp;<span class="arcadeTextWhite"><font size="5">{scorerow.POS}{scorerow.TROPHY}</font></span></td>
                                        <td class="arcadeRow2" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                         <td align=center><span class="arcadeText">{scorerow.USERNAME}</span></td>
                                                         <td width="25" align="center">{scorerow.URL_STATS}</td>
                                                        </tr>
                                                        </table>
                                        </td>
                                        <td class="arcadeRow2" align="center"><span class="w3-tag w3-round w3-green w3-border w3-border-pink">{scorerow.SCORE}</span></td>
                                        </tr>
                                        <!-- END scorerow -->
                                        </table>
                                </td>
                        </tr>
                </table>
         		</div>
         
 </tr>
</table>
{WHOISPLAYING}
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td class="arcadeRow1"><div align="center"><span class="arcadePink">[ {URL_ARCADE} ]</span>&nbsp;-&nbsp;<span class="arcadePink">[ {URL_BESTSCORES} ]</span>&nbsp;-&nbsp;<span class="arcadePink">[ {URL_SCOREBOARD} ]</span>&nbsp;-&nbsp;<span class="arcadePink">[ 
		{MANAGE_COMMENTS} ]</span></div></td>
   </tr>
  </table>