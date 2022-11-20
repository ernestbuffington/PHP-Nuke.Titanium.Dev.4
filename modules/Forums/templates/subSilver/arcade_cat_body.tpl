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
        <span class="nav">>&nbsp;{L_ARCADE}</span>
      </td>
    </tr>
  </table>
{WHOISPLAYING}
<br />
<!-- BEGIN favrow -->
<table width="100%" cellpadding="2" cellspacing="3" border="0"> 
    <tr>
    <td>
        
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
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
</table>
</td></tr>
</table> 
<!-- END favrow --> 
  <table width="100%" cellpadding="2" cellspacing="3" border="0">
<!-- BEGIN cat_row -->
    <tr>
    <td>
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
        <td class="row1" width="35">{cat_row.game_row.GAMEPIC}</td>
        <td class="row1" width="100" align="center">
        <span class='genmed'>{cat_row.game_row.GAMELINK}</span><br />
        <span class='genmed'>{cat_row.game_row.GAMEPOPUPLINK}</span><br />
        <span class='gensmall'>{cat_row.game_row.GAMESET}</span>
        </td>
    <td class="row1" width="150" align="center" valign="center" >
        <span class='gen'>
        {cat_row.game_row.NORECORD}
      <!-- BEGIN recordrow -->
    <strong>{cat_row.game_row.HIGHSCORE}</strong></span><span class='gensmall'>&nbsp;&nbsp;{cat_row.game_row.HIGHUSER}<br/>{cat_row.game_row.DATEHIGH}
       <!-- END recordrow -->
        </span>
       
    </td>
    <td class="row1" width="150" align="center" valign="center" >
    <span class='gen'>
        {cat_row.game_row.NOSCORE}
      <!-- BEGIN yourrecordrow -->
    <strong>{cat_row.game_row.YOURHIGHSCORE}{cat_row.game_row.IMGFIRST}</strong></span><span class='gensmall'><br/>{cat_row.game_row.YOURDATEHIGH}
       <!-- END yourrecordrow -->
     <!-- BEGIN playrecordrow -->
    <strong>{cat_row.game_row.CLICKPLAY}</strong>
       <!-- END playrecordrow -->

        </span>   
    </td>
    <td class="row1" align="center" valign="center">
        <table width="100%">
        <tr>
         <td align="center">
        <span class="name">{cat_row.game_row.GAMEDESC}</span>
         </td>
         <td width="25">{cat_row.game_row.URL_SCOREBOARD}</td>
        </tr>
        </table>
      </td>
 {cat_row.game_row.ADD_FAV}
      </tr>
<!-- END game_row -->
      <tr>
        <td class="row2" colspan="{ARCADE_COL}" align="{cat_row.LINKCAT_ALIGN}"><span class="gensmall"><a href="{cat_row.U_ARCADE}">{cat_row.L_ARCADE}</a></span></td>
      </tr>
      </table>
    </TD>  
    </tr>
<!-- END cat_row -->
    </table>
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
<td align="center">[&nbsp;{URL_ARCADE}]&nbsp;-&nbsp;[&nbsp;{URL_BESTSCORES}]&nbsp;-&nbsp;[&nbsp;{MANAGE_COMMENTS}]</td>
   </tr>
  </table>