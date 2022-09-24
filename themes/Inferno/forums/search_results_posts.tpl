<div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<table border="0" cellpadding="4" cellspacing="1" style="width: 100%">
  <tr> 
    <td>{L_SEARCH_MATCHES}</td>
  </tr>
</table>

<table border="0" cellpadding="4" cellspacing="1" style="width: 100%">
  <tr> 
    <td><a href="{U_INDEX}">{L_INDEX}</a></td>
  </tr>
</table>

<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%">
  <tr> 
    <td class="catHead" style="width:15%" nowrap="nowrap">{L_AUTHOR}</td>
    <td class="catHead" style="width:85%" nowrap="nowrap">{L_MESSAGE}</td>
  </tr>
  <!-- BEGIN searchresults -->
  <tr> 
    <td class="catHead" colspan="2"><img src="{searchresults.FORUM_FOLDER_IMG}" />&nbsp;{L_TOPIC}:&nbsp;<a href="{searchresults.U_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a></td>
  </tr>
  <tr> 
    <td valign="top" class="row1" rowspan="2" style="width:15%">
      {searchresults.POSTER_NAME}<br /><br />
      {L_REPLIES}: {searchresults.TOPIC_REPLIES}<br />
      {L_VIEWS}: {searchresults.TOPIC_VIEWS}
    </td>
    <td style="width:85%" valign="top" class="row1">
      <img src="{searchresults.MINI_POST_IMG}" width="12" height="9" alt="{searchresults.L_MINI_POST_ALT}" title="{searchresults.L_MINI_POST_ALT}" border="0" />{L_FORUM}:&nbsp;<a href="{searchresults.U_FORUM}">{searchresults.FORUM_NAME}</a>&nbsp;{L_POSTED}: {searchresults.POST_DATE}&nbsp;{L_SUBJECT}: <a href="{searchresults.U_POST}">{searchresults.POST_SUBJECT}</a></td>
  </tr>
  <tr>
    <td valign="top" class="row1"><span class="postbody">{searchresults.MESSAGE}</span></td>
  </tr>
  <!-- END searchresults -->
  <tr> 
    <td class="catBottom" colspan="2" height="28" align="center">&nbsp; </td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td align="left" valign="top"><span class="nav">{PAGE_NUMBER}</span></td>
    <td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}</span><br /><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>

</tr>
</tbody>
</table>
</div>
