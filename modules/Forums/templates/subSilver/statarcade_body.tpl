<!-- index phrase display -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td align="left" valign="middle" width="100%">
        <span class="nav">
            <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
        </span>
      </td>
    </tr>
  </table>

<table width="100%" cellpadding="5" cellspacing="0" border="0" class="bodyline">
<tr> 
    <th class="thTop" colspan="4" nowrap="nowrap">&nbsp;{L_STATS}&nbsp;</th>
</tr>
<tr> 
<td class="row1" colspan="4" align="center">{USER_AVATAR}</td>
</tr>

<tr>
    <td class="row1" colspan="4" align="center">[{URL_ARCADE}]&nbsp;-&nbsp;[{URL_BESTSCORES}]</td>
</tr>
  <!-- BEGIN blkligne -->
  <TR>
     <!-- BEGIN blkcolonne -->
     <TD class="row1" valign="top" width="50%">
         <!-- BEGIN blkgame -->
        <fieldset>
             <legend align=center><span class="gensmall">{blkligne.blkcolonne.blkgame.GAMENAME}</span></legend>
                        <span class="gensmall">{blkligne.blkcolonne.blkgame.L_NBSET}</span>
                    <span class="gensmall">{blkligne.blkcolonne.blkgame.NBSET}</span><br />

                        <span class="gensmall">{blkligne.blkcolonne.blkgame.L_TPSSET}</span>
                <span class="gensmall">{blkligne.blkcolonne.blkgame.TPSSET}</span><br />
    
                        <span class="gensmall">{blkligne.blkcolonne.blkgame.L_TPSMOY}</span>
                <span class="gensmall">{blkligne.blkcolonne.blkgame.TPSMOY}</span><br />

                    <span class="gensmall">{blkligne.blkcolonne.blkgame.L_POSGAME}</span>
                <span class="gensmall">{blkligne.blkcolonne.blkgame.POSGAME}&nbsp;&nbsp;</span>{blkligne.blkcolonne.blkgame.IMGFIRST}<br />

                <span class="gensmall">{blkligne.blkcolonne.blkgame.L_HIGHSCR}</span>
                <span class="gensmall">{blkligne.blkcolonne.blkgame.HIGHSCR}</span><br />

                <span class="gensmall">{blkligne.blkcolonne.blkgame.L_DATHIGHSCR}</span>
                <span class="gensmall">{blkligne.blkcolonne.blkgame.DATHIGHSCR}</span><br />
                </fieldset>
        <!-- END blkgame -->
     </TD>
     <!-- END blkcolonne -->
  </TR>
  <!-- END blkligne -->
</TABLE>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td align="left" valign="middle" nowrap="nowrap"><span class="nav">{PAGE_NUMBER}</span></td>
        <td align="right" valign="middle"><span class="nav">{PAGINATION}</span></td>
    </tr>
</table>