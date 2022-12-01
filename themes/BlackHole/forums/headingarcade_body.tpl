<script>
function resize_avatar(image)
{
  if ({MAXSIZE_AVATAR}>0)
  {
        if (image.width > {MAXSIZE_AVATAR} ) image.width={MAXSIZE_AVATAR} ;
  }
}
</script>
 <table width="100%" cellpadding="2" cellspacing="3" border="0">

    <tr>
        <td width="100%">
          <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
          <tr>
               <td colspan="3" class="arcadeRow1" width="100%"><p align="center"><a href="modules.php?name=Forums&amp;file=arcade"><img 
               width="269" src="images/arcade_mod/arcade_logo.png" border="0"></a></p></td>
          </tr>

          <tr>
            <td class="arcadeRow1" width="25%"><p align="center"><span class="arcadeText">{L_TOP}</span></p></td>
            <td class="arcadeRow1" width="60%"><p align="center"><span class="arcadeText">{L_RECENT}</span></p></td>
            <td class="arcadeRow1" width="15%"><p align="center"><span class="arcadeText">{L_USER_INFO}</span></p></td>
          </tr>

          <tr>
            <td class="arcadeRow1" width="25%" rowspan="2" height="93" align="center" valign="top">
                         <table height="1%" width="100%" cellpadding="0" cellspacing="1" border="0" class="forumline" align="center">
                   <tr>
                            <td class="cat" align="center" width="25%"><p align="center"><span class="arcadeTextWhite">Rank</span></td>
                         <td class="cat" align="center" width="50%"><p align="center"><span class="arcadeTextWhite">{L_ARCADE_USER}</span></td>
                         <td class="cat" align="center" width="25%"><p align="center"><span class="arcadeTextWhite">{L_WINS}</span></td>
               </tr>
                              
                   <!-- BEGIN player_row -->
                   <tr>
                        <td class="row2" align="center" height="2" width="25%" class="gensmall"><p align="center"><img width="15" src="modules/Forums/templates/subSilver/images/couronne.gif" align="absmiddle"><span class="arcadeTextWhite">{player_row.CLASSEMENT}</span></td>
                      <td class="row1" align="center" height="2" class="gensmall" width="50%"><p align="center"><span class="arcadeTopTenHeader">{player_row.USERNAME}</span></td>
                        <td class="row2" height="2" align="center" width="25%"><p align="center"><span class="arcadeTextWhite w3-badge w3-blue">{player_row.VICTOIRES}</span></td>   
                   </tr>
                      <!-- END player_row -->
            </table>

            </td>
            <td class="arcadeRow1" align="center" height="20%" valign="top">
            
            <table height="100" width="100%" cellpadding="2" cellspacing="3" border="0">
            <tr>
            <td width="100%" valign="top">
            
            <table width="100%" height="20%" cellpadding="2" cellspacing="1" border="0" class="bodyline">
            <tr>
            <td class="row3" width="100%" align="center" valign="top"><p align="center"><span class="arcadeTextWhite">{L_LAST_FIVE}</span></p></td>
            </tr>
            <tr>
            <td class="row1" width="100%" height="44" align="center" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="">
                <!-- BEGIN arcaderow2 -->
              <tbody>
              <tr>
                <td vAlign=top  width="100%">
                  <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <tbody>
                                    <!-- BEGIN bestscore2 -->
                            <tr>
                              <td class="{arcaderow2.bestscore2.CLASS}"  align=left width="85%" valign="top"><p>&nbsp;<span class="arcadeTextWhite"> {arcaderow2.bestscore2.L_HEADING_CHAMP}</span></p></td>
                              <td class="{arcaderow2.bestscore2.CLASS}"  noWrap align=right width="15%" valign="top"><p><span class="arcadeTextWhite">{arcaderow2.bestscore2.LAST_SCOREDATE}</span><font size=1> </font></p></td>
                                     </tr>
                                 <!-- END bestscore2 --> 
                           </tbody>
                           </table>
                     </td>
                  </tr>
                  </tbody>
                    <!-- END arcaderow2 --> 
                                                                </table>
                                                    </td>
                                                  </tr>
                                          </table>
                                </td>  
                        </tr>
                        </table>
                </td>
                
        <td class="row1" align="center" valign="top" width="15%" rowspan="2" height="93"><p align="center">
<!-- padding between Arcade Tables and links at the bottom of the Arcade Page START -->
<div align="center" style="padding-top:22px;">
</div>
<!-- padding between Arcade Tables and links at the bottom of the Arcade Page END -->
                        <span class="arcadeTextWhite"></span>{AVATAR_IMG}<br /><br />{USERNAME}<br /></br>
                        <span class="arcadeTextWhite"> <img width="15" src="modules/Forums/templates/subSilver/images/couronne.gif">{ARCADE_VICTOIRES}</span><br />
                        <span class="arcadeTextWhite">{L_ARCADE_TOTAL_PLAYS}</span><br />
                        <span class="arcadeTextWhite">{ARCADE_TOTAL_PLAYS}</span></br><br />
                        <span class="arcadeTextWhite"><strong>{L_ARCADE_TOTAL_TIME}</strong></span><br />
                        {ARCADE_TOTAL_TIME}</p>
        </td>
   </tr>
          
   <tr>
        <td class="arcadeRow1" width="60%" height="80%" align="center" valign="top">
                <table cellSpacing="0" cellPadding="0" width="100%" vAlign="top" align="center" border="0">
                        <tr><td></td></tr>
          <tr>
            <td class="row3" width="100%" align="left" valign="top"><p align="center"><span class="arcadeTextWhite">{L_LAST_RECORDED}</span></p></td>
          </tr>
                    <!-- BEGIN arcaderow3 -->
              <tbody>
              <tr>
                <td vAlign=top  width="100%" valign="top">
                  
                  <table vAlign=top cellSpacing="0" cellPadding="0" width="100%" border="0">
                    <tbody>
                             <!-- BEGIN score3 -->
                    <tr>
                      <td class="row2" vAlign=top align=left width="85%"><p><span class="arcadeTextWhite"> {arcaderow3.score3.L_LAST_SCORE}</span></p></td>
                    </tr>
                           <!-- END score3 --> 
                           </tbody>
                         </table>
                    </td>
                  </tr>
                  </tbody>
                    <!-- END arcaderow3 --> 
                </table>

                </td>
          </tr>

          </table>
        
        </tr>

    </table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="forumline" align="center">
<tr><form action="modules.php?name=Forums&file=arcade_search" method="post">
<td align='center' class='arcadeRow1'><strong>{L_SEARCH_ARCADE}:</strong> <select name="searchin"><option selected value="name">{L_GAME_NAME}</option><option value="desc">{L_GAME_DESCRIPTION}</option></select>&nbsp;<input type="text" name="srchstring" size="35" title="{L_SEARCH_DESCRIPTION}">&nbsp;<input type="submit" value="Search"><br />
<span class="arcadeTextPink">[</span><a class="arcadeTitleLink" href="modules.php?name=Forums&file=arcade">Arcade</a><span class="arcadeTextPink">]</span>
<span class="arcadeTextPink">[</span><a class="arcadeTitleLink" href="modules.php?name=Forums&amp;file=arcade_search&amp;x=1">{L_NO_PLAY}</a><span class="arcadeTextPink">]</span>&nbsp;&nbsp;<span class="arcadeTextPink">[</span><a class="arcadeTitleLink" href="modules.php?name=Forums&amp;file=arcade_search&amp;x=2">{L_GAMES_NEWEST}</a><span class="arcadeTextPink">]</span></td>
</form>
</tr>
</table>