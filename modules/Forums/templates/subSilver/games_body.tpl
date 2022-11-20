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
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td align="left" valign="middle" width="100%">
        <span class="nav">
            <a href="{U_INDEX}" class="nav">{L_INDEX}</a>&nbsp;>&nbsp;{NAV_DESC}&nbsp;>&nbsp;{CAT_TITLE}&nbsp;>
        </span>
        <span class="nav">{L_GAME}</span>
      </td>
    </tr>
  </table>
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="bodyline">
  <tr> 
    <th class="thTop" height="28" align="center">{L_GAME}</th>
  </tr>
  <tr>
     <td align="center">
        <table width="100%">
            <tr>
    <!-- BEGIN avatar_best_player_left -->
            <td align="center" valign="top"> 
               <table width="100%" class="bodyline" cellpadding="2" cellspacing="1" > 
               <tr> 
                  <td class="row2" align="center" colspan="3"><span class="cattitle">{L_ACTUAL_WINNER}</span></td> 
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3">{FIRST_AVATAR}</td> 
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><strong>{BEST_USER_NAME}</strong></span></td> 
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed">{GAMES_PLAYED}</span></td>
               </tr> 
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed">{BEST_TIME}</span></td>
               </tr> 

               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed">{BEST_USER_DATE}</span></td> 
               </tr>
           <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed">{COMMENTS}</span></td> 

               </tr>  
               </table>
               <br />
               
               <table width="100%" class="bodyline" cellpadding="2" cellspacing="1" >
               <tr> 
                  <td class="row1" align="center" colspan="3"><span class="genmed"><strong>Hi-Score<br /><big>{HIGHSCORE}</big></strong></span></td> 
               </tr>
               </table>
            </td>
    <!-- END avatar_best_player_left -->
            <td class="bodyline" align="center"> 
            <!-- BEGIN game_type_V5 -->
         <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="{GAME_WIDTH}" height="{GAME_HEIGHT}">
            <param name="movie" value="modules/Forums/games/{SWF_GAME}?arcade_hash={GAMEHASH}">
            <param name="quality" value="high">
            <param name="menu" value="false">
            <embed src="modules/Forums/games/{SWF_GAME}?arcade_hash={GAMEHASH}" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="{GAME_WIDTH}" height="{GAME_HEIGHT}">
            </embed>
        </object>
            <!-- END game_type_V5 -->
            <!-- BEGIN game_type_V2 -->
         <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="{GAME_WIDTH}" height="{GAME_HEIGHT}">
            <param name="movie" value="modules/Forums/games/{SWF_GAME}">
            <param name="quality" value="high">
            <param name="menu" value="false">
            <embed src="modules/Forums/games/{SWF_GAME}"  pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="{GAME_WIDTH}" height="{GAME_HEIGHT}">
            </embed>
        </object>
            <!-- END game_type_V2 -->

                </td>
                <td align="left" valign="top">
                <!-- BEGIN avatar_best_player_right -->
                   <table width="100%" class="bodyline" cellpadding="2" cellspacing="1"> 
                   <tr> 
                      <td class="row2" align="center" colspan="3"><span class="cattitle">{L_ACTUAL_WINNER}</span></td> 
                   </tr> 
                       <tr> 
                          <td class="row1" align="center" colspan="3">{FIRST_AVATAR}</td> 
                   </tr> 
                   <tr> 
                      <td class="row1" align="center" colspan="3"><span class="genmed"><strong>{BEST_USER_NAME}</strong></span></td>
                   </tr> 
                   </table>
                <table><tr><td></td></tr></table> 
                <!-- END avatar_best_player_right -->

                    <table width="100%" class="bodyline" cellpadding="2" cellspacing="1" >
                    <tr>
                        <td class="row2" align="center" colspan="3"><span class="cattitle">{L_TOP}</span></td>
                    </tr>
                                        <!-- BEGIN scorerow -->
                    <tr>
                    <td class="row1" align="center"><span class="gensmall">{scorerow.POS}</span></td>
                    <td class="row1" align="center">
                            <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                             <td align=center><span class="gensmall">{scorerow.USERNAME}</span></td>
                             <td width="25" align="center">{scorerow.URL_STATS}</td>
                            </tr>
                            </table>
                    </td>
                    <td class="row1" align="center"><span class='gensmall'>{scorerow.SCORE}</span></td>
                    </tr>
                                        <!-- END scorerow -->
                    </table>
                </td>
            </tr>
        </table>
     </td>
 </tr>
</table>
{WHOISPLAYING}
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
    <td align="center">[{URL_ARCADE}]&nbsp;-&nbsp;[{URL_BESTSCORES}]&nbsp;-&nbsp;[{URL_SCOREBOARD}]&nbsp;-&nbsp;[&nbsp;{MANAGE_COMMENTS}]</td>
   </tr>
  </table>