<form name="status" action="{S_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
        <td align="left">
            <span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span>
        </td>
        <td align="right" nowrap="nowrap">
            <span class="genmed">
              <select name="status">
                <option value="1"{S_OPEN}>{L_OPENED}</option>
                <option value="2"{S_CLOSED}>{L_CLOSED}</option>
                <option value="all"{S_ALL}>{L_ALL}</option>
            </select>&nbsp; 
            <input type="submit" name="submit" value="{L_DISPLAY}" class="liteoption" />
            </span>
        </td>
    </tr>
</table>
</form>

<form action="{S_ACTION}" method="post">
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
    <tr>
        <th height="25">{L_ACTION}</th>
        <th>{L_POST}</th>
        <th>{L_COMMENTS}</th>
        <th>{L_STATUS}</th>
      <th>{L_LAST_ACTION_COMMENTS}</th>
    </tr>
    <!-- BEGIN postrow -->
    <tr>
        <td class="{postrow.ROW_CLASS}" width="40" align="center"><input type="checkbox" name="p[]" value="{postrow.REPORT_ID}" />&nbsp;<span class="genmed"><a href="{postrow.U_CLOSE_REPORT}">{postrow.L_CLOSE_REPORT}</a></span></td>
        <td class="{postrow.ROW_CLASS}" width="200"><a href="{postrow.U_VIEW_POST}" class="topictitle">{postrow.TOPIC_TITLE}</a><br /><span class="genmed">{postrow.FORUM}</span></td>
        <td class="{postrow.ROW_CLASS}" width="350"><span class="gen">{postrow.REPORTER} <i>({postrow.DATE})</i><br /><hr />{postrow.COMMENTS}</span></td>
        <td class="{postrow.ROW_CLASS}" width="130" align="center"><span class="genmed">{postrow.LAST_ACTION}</span></td>
        <td class="{postrow.ROW_CLASS}" width="300" align="center"><span class="gen">{postrow.LAST_ACTION_COMMENTS}</span></td>
    </tr>
    <!-- END postrow -->
    <tr>
        <td class="catbottom" colspan="5" height="28" align="center"><span class="genmed">{DELETED_REPORTS}</span></td>
    </tr>
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