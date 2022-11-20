<strong><div align="center">{L_UACP} :: {USERNAME}</div></strong>

<script>
    //
    // Should really check the browser to stop this whining ...
    //
    function select_switch(status)
    {
        for (i = 0; i < document.attach_list.length; i++)
        {
            document.attach_list.elements[i].checked = status;
        }
    }
</script>

<form method="post" name="attach_list" action="{S_MODE_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
      <td align="left" nowrap="nowrap">
      <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td class="nav" align="left"><a class="nav" href="{U_INDEX}">{L_INDEX}</a></td>
    </tr>
</table>
        </td>
      <td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
        <input type="submit" name="submit" value="{L_SUBMIT}" class="titaniumbutton" />
        </span>
      </td>
    </tr>
  </table>
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
    <tr> 
      <td class="catHead acenter">#</td>
      <td class="catHead acenter">{L_FILENAME}</td>
      <td class="catHead acenter">{L_FILECOMMENT}</td>
      <td class="catHead acenter">{L_EXTENSION}</td>
      <td class="catHead acenter">{L_SIZE}</td>
      <td class="catHead acenter">{L_DOWNLOADS}</td>
      <td class="catHead acenter">{L_POST_TIME}</td>
      <td class="catHead acenter">{L_POSTED_IN_TOPIC}</td>
      <td class="catHead acenter">{L_DELETE}</td>
    </tr>
    <!-- BEGIN attachrow -->
    <tr> 
      <td class="{attachrow.ROW_CLASS} acenter">{attachrow.ROW_NUMBER}</td>
      <td class="{attachrow.ROW_CLASS} acenter"><a href="{attachrow.U_VIEW_ATTACHMENT}" target="_blank">{attachrow.FILENAME}</a></td>
      <td class="{attachrow.ROW_CLASS} acenter">{attachrow.COMMENT}</td>
      <td class="{attachrow.ROW_CLASS} acenter">{attachrow.EXTENSION}</td>
      <td class="{attachrow.ROW_CLASS} acenter" valign="middle">{attachrow.SIZE}</td>
      <td class="{attachrow.ROW_CLASS} acenter" valign="middle">{attachrow.DOWNLOAD_COUNT}</td>
      <td class="{attachrow.ROW_CLASS} acenter" valign="middle">{attachrow.POST_TIME}</td>
      <td class="{attachrow.ROW_CLASS} acenter" valign="middle">{attachrow.POST_TITLE}</td>
      <td class="{attachrow.ROW_CLASS} acenter">{attachrow.S_DELETE_BOX}</td>
      {attachrow.S_HIDDEN}
    </tr>
    <!-- END attachrow -->
    <tr> 
      <td class="catBottom aright" colspan="9"> 
        <input type="submit" name="delete" value="{L_DELETE_MARKED}" class="titaniumbutton" />
      </td>
    </tr>
  </table>

  {S_USER_HIDDEN}

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
      <td class="aright" valign="top" nowrap="nowrap"><a href="javascript:select_switch(true);">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);">{L_UNMARK_ALL}</a></td>
    </tr>
  </table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
    <td>{PAGE_NUMBER}</td>
    <td class="aright">{PAGINATION}</td>
  </tr>
</table></form>