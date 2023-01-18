<form method="post" action="{S_SPLIT_ACTION}">
<table cellspacing="2" cellpadding="2" border="0">
  <tr>
  	<td>
    &nbsp;<a href="{U_INDEX}"> {L_INDEX}</a>
    <!-- IF PARENT_FORUM --> -> 
    <a href="{U_VIEW_PARENT_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {PARENT_FORUM_NAME}</a> 
    <!-- ENDIF --> 
    <a href="{U_VIEW_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {FORUM_NAME}</a>
    </td>
  </tr>
</table>

<table cellpadding="4" cellspacing="1" border="0" class="col-12 forumline">
  <tr> 
    <td class="catHead center" colspan="3" nowrap="nowrap">{L_SPLIT_TOPIC}</td>
  </tr>
  <tr> 
    <td class="center row1" colspan="3">{L_SPLIT_TOPIC_EXPLAIN}</td>
  </tr>
  <tr> 
    <td class="row1" nowrap="nowrap">{L_SPLIT_SUBJECT}</td>
    <td class="row1" colspan="2"><input type="text" size="35" style="width: 350px" maxlength="100" name="subject" class="post" /></td>
  </tr>
  <tr> 
    <td class="row1" nowrap="nowrap">{L_SPLIT_FORUM}</td>
    <td class="row1" colspan="2">{S_FORUM_SELECT}</td>
  </tr>
</table>

<table cellpadding="4" cellspacing="1" border="0" class="col-12 forumline" style="table-layout: fixed;">
  <tr> 
    <td class="catHead col-2">{L_AUTHOR}</td>
    <td class="catHead col-9">{L_MESSAGE}</td>
    <td class="catHead center col-1">{L_SELECT}</td>
  </tr>
  <!-- BEGIN postrow -->
  <tr> 
    <td align="left" valign="top" class="{postrow.ROW_CLASS}"><span class="name"><a name="{postrow.U_POST_ID}"></a>{postrow.POSTER_NAME}</span></td>
    <td width="100%" valign="top" class="{postrow.ROW_CLASS}"> 
      <table width="100%" cellspacing="0" cellpadding="3" border="0" style="table-layout: fixed;">
        <tr> 
          <td valign="middle"><img src="themes/{THEME_NAME}/forums/images/icon_minipost.gif" alt="{L_POST}">{L_POSTED}: {postrow.POST_DATE}&nbsp;&nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</td>
        </tr>
        <tr> 
          <td valign="top"><hr size="1" /><span class="postbody">{postrow.MESSAGE}</span></td> 
        </tr>
      </table>
    </td>
    <td class="center col-1 {postrow.ROW_CLASS}">{postrow.S_SPLIT_CHECKBOX}</td>
  </tr>
  <tr> 
    <td colspan="3" height="1" class="row3"><img src="themes/{THEME_NAME}/forums/images/spacer.gif" width="1" height="1" alt="."></td>
  </tr>
  <!-- END postrow -->
  <tr> 
    <td class="catHead center" colspan="3"><input class="titaniumbutton" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />&nbsp;<input class="titaniumbutton" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" /></td>
  </tr>
</table>
{S_HIDDEN_FIELDS}
</form>