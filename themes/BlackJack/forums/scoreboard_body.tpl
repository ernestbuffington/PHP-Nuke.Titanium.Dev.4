<form method="post" action="{S_POST_DAYS_ACTION}">
  <!-- index phrase display -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td align="left" valign="middle" width="100%">
        <a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}&nbsp;<i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;" aria-hidden="true"></i>&nbsp;
                
                {GAMENAME}
          </td>
    </tr>
  </table>

  <!-- affichage "nouveau" | modérateurs + utilisateurs | "marquer lu" et pagination -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
        <tr>
          <td align="right" valign="bottom" nowrap>
                <span class="gensmall">
                        <strong>{PAGINATION}</strong>
                </span>
          </td>
        </tr>
  </table>

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr> 
          <th align="center" width="25" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_POS}&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;{L_USER}&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;{L_SCORE}&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
        </tr>

        </tr>
       </table>
        <!-- BEGIN scorerow -->
          <table width="100%">


          <td class="row1" align="center" width="100"><font color="gold" size="5"><i class="bi bi-trophy"></i></font>&nbsp;&nbsp;<font size="5">{scorerow.POS}{scorerow.TROPHY} 
			   </font></td>
			   
	   
          <td class="row3" align="left" width="250"><font size="4">&nbsp;{scorerow.PLAYER_AVATAR}&nbsp;&nbsp;{scorerow.PLAYER}</font></td>
          <td class="row1" align="center" width="50">{scorerow.URL_STATS}</td>
          <td class="row3" align="center" width="244"><font size="2">USER SCORE</font></br> <font size="4">{scorerow.SCORE}</font></td>
          <td class="row1" align="left" width="235">&nbsp;<font size="3"><i class="bi bi-calendar2-check"></i>&nbsp;{scorerow.DATE}</font></td>
          <td class="row1" align="center" width="826">&nbsp;</td>
                </tr>
                </table>
        <!-- END scorerow -->

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr> 
          <th align="center" width="25" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_POS}&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;{L_USER}&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;{L_SCORE}&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
        </tr>

        </tr>
       </table>

       <div align="center" style="padding-top:6px;">
       </div>
 <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td align="center">[ {URL_ARCADE} ]&nbsp;-&nbsp;[ {URL_BESTSCORES} ]</td>
   </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
        <tr> 
                    <td align="right" valign="middle" nowrap="nowrap">{S_TIMEZONE}<br />{PAGINATION}</td>
        </tr>
        <tr>
          <td align="left" colspan="2">{PAGE_NUMBER}</td>
        </tr>
  </table>
</form>