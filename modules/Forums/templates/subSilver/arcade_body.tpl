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
{HEADINGARCADE}
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td align="left" valign="middle" width="100%">
        <span class="nav">
            <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
        </span>
        <span class="nav">&nbsp;>&nbsp;{NAV_DESC}>&nbsp;{CATTITLE}</span>
      </td>
    </tr>
  </table>
{WHOISPLAYING}
<br />
  <!-- BEGIN arcade_search -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr>
    <td align="left" valign="bottom"><span class="maintitle">{arcade_search.L_SEARCH_MATCHES}</span><br /></td>
  </tr>
</table>
    <!-- END arcade_search -->

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
    <th class="thTop" colspan="{ARCADE_COL}" nowrap="nowrap">&nbsp;{L_ARCADE}&nbsp;</th>
  </tr>
  <!-- BEGIN use_category_mod -->
  <tr> 
    <td class="cat" colspan="{ARCADE_COL}" nowrap="nowrap" align="center"><span class="cattitle">{CATTITLE}</span></td>
  </tr>
  <!-- END use_category_mod -->
  <tr> 
    <td class="cat" height="28" align="center" colspan="2"><span class="cattitle">{L_GAME}</span></td>
    <td class="cat" nowrap="nowrap" align="center"><span class="cattitle">{L_HIGHSCORE}</span></td>
    <td class="cat" nowrap="nowrap" align="center"><span class="cattitle">{L_YOURSCORE}</span></td>
    <td class="cat" colspan="{ARCADE_COL1}" nowrap="nowrap" align="center"><span class="cattitle">{L_DESC}</span></td>
  </tr>
<!-- BEGIN favrow -->

<tr>
    <td class="cat" colspan="6"><span class="cattitle">{FAV}</span></td>
</tr>
      
      <!-- BEGIN fav_row -->
      <tr>
            <td class="row1" width="35">{favrow.fav_row.GAMEPICF}</td>
            
            <td class="row1" width="100" align="center">
                        <span class='genmed'>{favrow.fav_row.GAMELINKF}</span><br />
                        <span class='genmed'>{favrow.fav_row.GAMEPOPUPLINKF}</span><br />
                        <span class='gensmall'>{favrow.fav_row.GAMESETF}</span>
            </td>
            
            <td class="row1" width="150" align="center" valign="center" >
                <span class='gen'>{favrow.fav_row.NORECORDF}
                <!-- BEGIN recordrow -->
                <strong>{favrow.fav_row.HIGHSCOREF}</strong></span><span class='gensmall'>   {favrow.fav_row.HIGHUSERF}<br/>{favrow.fav_row.DATEHIGHF}
                <!-- END recordrow -->
                 </span>
            </td>
            
            <td class="row1" width="150" align="center" valign="center" >
                <span class='gen'>{favrow.fav_row.NOSCOREF}
                <!-- BEGIN yourrecordrow -->
                <strong>{favrow.fav_row.YOURHIGHSCOREF}{favrow.fav_row.IMGFIRSTF}</strong></span><span class='gensmall'><br/>{favrow.fav_row.YOURDATEHIGHF}
                <!-- END yourrecordrow -->
    <!-- BEGIN playrecordrow -->
    <strong>{favrow.fav_row.CLICKPLAY}</strong>
       <!-- END playrecordrow -->
                </span>   
            </td>
            
            <td class="row1" align="center" valign="center">
                <table width="100%">
                    <tr>
                         <td align="center">
                            <span class="name">{favrow.fav_row.GAMEDESCF}</span>
                         </td>
                        <td width="25">{favrow.fav_row.URL_SCOREBOARDF}</td>
                    </tr>
                </table>
              </td>
              
          
             <td class="row1" align="center" valign="center">
             {favrow.fav_row.DELFAVORI}
             </td>
</tr>         
<!-- END fav_row -->
<br />
<tr>
    <td class="cat" colspan="6"><span class="cattitle">{L_GAME}</span></td>
</tr>
<!-- END favrow -->
  <!-- BEGIN gamerow -->
  <tr> 
    <td class="row1" height="25" width='35' align='center'>{gamerow.GAMEPIC}</td>
    <td class="row1" height="25">
        <span class='genmed'>{gamerow.GAMELINK}</span><br />
        <span class='genmed'>{gamerow.GAMEPOPUPLINK}</span><br />
        <span class='gensmall'>{gamerow.GAMESET}</span>
    </td>
    <td class="row1" align="center" valign="center" >
        <span class='gen'>
        {gamerow.NORECORD}
      <!-- BEGIN recordrow -->
    <strong>{gamerow.HIGHSCORE}</strong></span><span class='gensmall'>&nbsp;&nbsp;{gamerow.HIGHUSER}<br/>{gamerow.DATEHIGH}
       <!-- END recordrow -->
        </span>
       
    </td>
    <td class="row1" align="center" valign="center" >
    <span class='gen'>
        {gamerow.NOSCORE}
      <!-- BEGIN yourrecordrow -->
    <strong>{gamerow.YOURHIGHSCORE}{gamerow.IMGFIRST}</strong></span><span class='gensmall'><br/>{gamerow.YOURDATEHIGH}
       <!-- END yourrecordrow -->
    <!-- BEGIN playrecordrow -->
    <strong>{gamerow.CLICKPLAY}</strong>
       <!-- END playrecordrow -->

        </span>   
    </td>
    <td class="row1" align="center" valign="center">
        <table width="100%">
        <tr>
         <td align="center">
        <span class="name">{gamerow.GAMEDESC}</span>
         </td>
         <td width="25">{gamerow.URL_SCOREBOARD}</td>
        </tr>
        </table>
    </td>
{gamerow.ADD_FAV}
  </tr>
  <!-- END gamerow -->
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td align="left" valign="middle" nowrap="nowrap"><span class="nav">{PAGE_NUMBER}</span></td>
        <td align="right" valign="middle"><span class="nav">{PAGINATION}</span></td>
    </tr>
</table>
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
    <td align="center">[&nbsp;{URL_ARCADE}]&nbsp;-&nbsp;[&nbsp;{URL_BESTSCORES}]&nbsp;-&nbsp;[&nbsp;{MANAGE_COMMENTS}]</td>
   </tr>
  </table>