<form method="post" action="{S_POST_DAYS_ACTION}">
  <!-- index phrase display -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td align="left" valign="middle" width="100%">
        <span class="nav">
            <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
            {NAV_CAT_DESC}&nbsp;>
        </span>
        <span class="nav">{GAMENAME}</span>
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
      <th align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_POS}&nbsp;</th>
      <th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_USER}&nbsp;</th>
      <th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_SCORE}&nbsp;</th>
      <th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
    </tr>
    <!-- BEGIN scorerow -->
    <tr> 
      <td class="row1" align="center" width="80"><span class="postdetails">{scorerow.POS}</span></td>
      <td class="row2" align="center" valign="middle" nowrap="nowrap">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
         <td align=center><span class="postdetails">{scorerow.PLAYER}</span></td>
         <td width="25" align="center">{scorerow.URL_STATS}</td>
        </tr>
        </table>
      </td>      
      <td class="row3" align="center" valign="middle"><span class="postdetails">{scorerow.SCORE}</span></td>
      <td class="row2" align="center" valign="middle"><span class="name">{scorerow.DATE}</span></td>
    </tr>
    <!-- END scorerow -->
  </table>
 <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
    <td align="center">[{URL_ARCADE}]&nbsp;-&nbsp;[{URL_BESTSCORES}]</td>
   </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
            <td align="right" valign="middle" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
    </tr>
    <tr>
      <td align="left" colspan="2"><span class="nav">{PAGE_NUMBER}</span></td>
    </tr>
  </table>
</form>