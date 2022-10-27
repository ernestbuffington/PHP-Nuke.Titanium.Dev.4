<form name="status" action="{S_ACTION}" method="post">
<table border="0" cellpadding="4" cellspacing="1" style="width: 100%">
    <tr> 
        <td><a href="{U_INDEX}">{L_INDEX}</a></td>
        <td align="right" nowrap="nowrap">
          <select name="status">
            <option value="1"{S_OPEN}>{L_OPENED}</option>
            <option value="2"{S_CLOSED}>{L_CLOSED}</option>
            <option value="all"{S_ALL}>{L_ALL}</option>
          </select>&nbsp;<input type="submit" name="submit" value="{L_DISPLAY}" class="titaniumbutton" />
        </td>
    </tr>
</table>
</form>

<form action="{S_ACTION}" method="post">
<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%">
  <tr>
    <td class="catHead acenter" height="25">{L_ACTION}</td>
    <td class="catHead acenter">{L_POST}</td>
    <td class="catHead acenter">{L_COMMENTS}</td>
    <td class="catHead acenter">{L_STATUS}</td>
    <td class="catHead acenter">{L_LAST_ACTION_COMMENTS}</td>
  </tr>
  <!-- BEGIN postrow -->
  <tr>
    <td class="{postrow.ROW_CLASS} acenter" width="40"><input type="checkbox" name="p[]" value="{postrow.REPORT_ID}" />&nbsp;<a href="{postrow.U_CLOSE_REPORT}">{postrow.L_CLOSE_REPORT}</a></td>
    <td class="{postrow.ROW_CLASS}" width="200"><a href="{postrow.U_VIEW_POST}" class="topictitle">{postrow.TOPIC_TITLE}</a><br />{postrow.FORUM}</td>
    <td class="{postrow.ROW_CLASS}" width="350">{postrow.REPORTER} <em>({postrow.DATE})</em><br /><hr />{postrow.COMMENTS}</td>
    <td class="{postrow.ROW_CLASS} acenter" width="130">{postrow.LAST_ACTION}</td>
    <td class="{postrow.ROW_CLASS} acenter" width="300">{postrow.LAST_ACTION_COMMENTS}</td>
  </tr>
  <!-- END postrow -->
  <!-- <tr>
    <td class="catbottom acenter" colspan="5">{DELETED_REPORTS}</td>
  </tr> -->
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td align="left">
            <span class="genmed">
            <select name="mode">
                <option value="">{L_SELECT_ONE}</option>
                <option value="close">{L_CLOSE}</option>
                <option value="open">{L_OPEN}</option>
                <option value="delete">{L_DELETE}</option>
            </select>&nbsp;
            <input type="submit" value="{L_SUBMIT}" class="mainoption" /> 
            </span>
        </td>
        <td align="right" nowrap="nowrap">
            <span class="genmed"><a href="{U_OPT_OUT}">{L_OPT_OUT}</a></span>
        </td>
    </tr>
</table>
</form>