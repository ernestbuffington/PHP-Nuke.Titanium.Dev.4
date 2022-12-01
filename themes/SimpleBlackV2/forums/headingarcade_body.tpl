<script language="JavaScript">
function resize_avatar(image)
{
  if ({MAXSIZE_AVATAR}>0)
  {
        if (image.width > {MAXSIZE_AVATAR} ) image.width={MAXSIZE_AVATAR} ;
  }
}
</script>

<table width="100%" cellpadding="1" cellspacing="2" border="0">
   <tr>
      <td width="100%">
<table width="100%" cellpadding="0" cellspacing="1" border="0" class="forumline">
   <tr>
      <td align="center" colspan="3" class="forumline2" width="60%"><strong>{ARCADE_ANNOUNCEMENT}</strong></td>
   </tr>

   <tr>
      <td align="center"class="rowpic" width="25%"><span class="cattitle">{L_TOP}</span></td>
      <td align="center"class="rowpic" width="60%"><span class="cattitle">{L_RECENT}</span></td>
      <td align="center"class="rowpic" width="15%"><span class="cattitle">{L_USER_INFO}</span></td>
   </tr>

   <tr>
      <td class="row1" width="25%" rowspan="2" height="93">
<table width="100%" cellpadding="0" cellspacing="1" border="0" class="forumline" align="center">
   <tr>
      <td class="row1pic" align="center" width="25%"><span class="gensmall"><strong>#</strong></span></td>
      <td class="row1pic" align="center" width="50%"><span class="gensmall"><strong>{L_ARCADE_USER}</strong></span></td>
      <td class="row1pic" align="center" width="25%"><span class="gensmall"><strong>{L_WINS}</strong></span></td>
   </tr>
                              
<!-- BEGIN player_row -->
   <tr>
      <td align="center" class="row2" height="2" width="25%" class="gensmall"><span class="gensmall">{player_row.CLASSEMENT}</span></td>
      <td align="center" class="row1" height="2" class="gensmall" width="50%"><span class="gensmall">{player_row.USERNAME}</span></td>
      <td align="center" class="row2" height="2" width="25%"><span class="gensmall">{player_row.VICTOIRES}</span></td>   
   </tr>
<!-- END player_row -->
</table>
      </td>
      <td class="row1" align="center" height="20%">
<table width="99%" cellpadding="0" cellspacing="2" border="0">
   <tr>
      <td width="99%">
<table width="99%" cellpadding="0" cellspacing="1" border="0" class="forumline">
   <tr>
      <td align="center" class="row1pic" width="722"><span class="cattitle">{L_LAST_FIVE}</span></td>
   </tr>
   <tr>
      <td class="row1" width="722" height="44">
<table width="100%" cellpadding="0" cellspacing="1" border="0" class="">
<!-- BEGIN arcaderow2 -->
 <tbody>
   <tr>
      <td vAlign=top width="100%">
<table cellSpacing="1" cellPadding="0" width="100%" border="0">
 <tbody>
<!-- BEGIN bestscore2 -->
   <tr>
      <td class="{arcaderow2.bestscore2.CLASS}" align=left width="85%" valign="top">&nbsp;<span class=smallfont><strong>&#8226;</strong>&nbsp;</span><span class="gensmall">{arcaderow2.bestscore2.L_HEADING_CHAMP}</span></td>
      <td class="{arcaderow2.bestscore2.CLASS}" noWrap align=right width="15%" valign="top"><span class="gensmall">{arcaderow2.bestscore2.LAST_SCOREDATE}</span><font size=1> </font></td>
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
       <td class="row1" align="center" valign="center" width="15%" rowspan="2" height="93">
          <span class="cattitle">{USERNAME}<br />{POSTER_RANK}<br />{RANK_IMG}<br /></span><span class="text">{AVATAR_IMG}</span><br /><br />
          <span class="gensmall"><img src="modules/Forums/templates/subSilver/images/couronne.gif">{ARCADE_VICTOIRES}</span><br />
          <span class="text"><strong>{L_ARCADE_TOTAL_PLAYS}</strong></span><br />
          <span class="text">{ARCADE_TOTAL_PLAYS}</span><br />
          <span class="text"><strong>{L_ARCADE_TOTAL_TIME}</strong></span><br />
          <span class="text">{ARCADE_TOTAL_TIME}</span>
       </td>
   </tr>
          
   <tr>
       <td class="row1" width="60%" height="80%" align="center">
<table cellspacing="0" cellpadding="0" width="99%" valign="top" align="center" border="0">
   <tr>
      <td align="center" class="row1pic" width="722"><span class="cattitle">{L_LAST_RECORDED}</span></td>
   </tr>
<!-- BEGIN arcaderow3 -->
 <tbody>
   <tr>
      <td vAlign=top  width="100%" valign="top">
<table valign="top" cellspacing="1" cellpadding="2" width="100%" border="0">
 <tbody>
<!-- BEGIN score3 -->
   <tr>
      <td align="left" class="alt1" valign="top" width="85%"><span class="gensmall"><span class=smallfont><strong>&#8226;</strong> </span><span class="gensmall">{arcaderow3.score3.L_LAST_SCORE}</span></td>
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
       </td>
   </tr>
</table>

<table align="center" width="99%" cellpadding="1" cellspacing="1" border="0" class="forumline">
   <tr>
<form action="modules.php?name=Forums&file=arcade_search" method="post">
      <td align='center' class='row1'><strong>{L_SEARCH_ARCADE}:</strong> <select name="searchin"><option selected value="name">{L_GAME_NAME}</option><option value="desc">{L_GAME_DESCRIPTION}</option></select>&nbsp;<input type="text" name="srchstring" size="35" title="{L_SEARCH_DESCRIPTION}">&nbsp;<input type="submit" value="Search"><br /><br />
       <a href="modules.php?name=Forums&amp;file=arcade_search&amp;x=1"><strong>[ {L_NO_PLAY} ]</strong></a>&nbsp;&nbsp;<a href="modules.php?name=Forums&amp;file=arcade_search&amp;x=2"><strong>[ {L_GAMES_NEWEST} ]</strong></a></td>
</form>
   </tr>
</table>