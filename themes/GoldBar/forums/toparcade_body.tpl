<!-- index phrase display -->
{HALL_OF_FAME}
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
          <td align="left" valign="middle" width="100%">
                <span class="nav">
                        <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
                </span>
                <span class="nav">&nbsp;->&nbsp;{NAV_DESC}</span>
                <span class="nav">&nbsp;->&nbsp;{L_TOPARCADE_FIVE}</span>
          </td>
    </tr>
  </table>

<table width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline">
<tr> 
        <th class="thTop" colspan="4" nowrap="nowrap">&nbsp;{L_ARCADE}&nbsp;</th>
</tr>

  <!-- BEGIN blkligne -->
  <tr>
     <!-- BEGIN blkcolonne -->
         <td valign="top">
                 <!-- BEGIN blkgame -->
                <table width="100%" cellpadding="2" cellspacing="1" class="bodyline">
                 <tr>
                         <td class="row2" colspan="3" align="center"><span class="gensmall">{blkligne.blkcolonne.blkgame.GAMENAME}</span></td>
                 </tr>
                 <!-- BEGIN blkscore -->
                 <tr>
                   <td class="row1" align="center" width="20"><span class="gensmall">{blkligne.blkcolonne.blkgame.blkscore.POS}</span></td>
                   <td class="row1" width="100" align="center"><span class="gensmall">{blkligne.blkcolonne.blkgame.blkscore.SCORE}</span></td>
                   <td class="row1" align="center"><span class="gensmall">{blkligne.blkcolonne.blkgame.blkscore.USERNAME}</span></td>
                 </tr>
                 <!-- END blkscore -->
                </table>
                <!-- END blkgame -->
         </td>
         <!-- END blkcolonne -->
  </tr>
  <!-- END blkligne -->
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
        <tr>
                <td align="left" valign="middle" nowrap="nowrap"><span class="nav">{PAGE_NUMBER}</span></td>
                <td align="right" valign="middle"><span class="nav">{PAGINATION}</span></td>
        </tr>
</table>