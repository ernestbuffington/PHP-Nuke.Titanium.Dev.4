<script>
    //
    // Taking from the Attachment MOD of Acyd Burn
    //
    function select(status)
    {
        for (i = 0; i < document.log_list.length; i++)
        {
            document.log_list.elements[i].checked = status;
        }
    }
</script>

<h1>{L_LOG_ACTIONS_TITLE}</h1>

<p>{L_LOG_ACTION_EXPLAIN}</p>

<span class="gen">{GROUPS}</span><br />

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <form method="post" action="{S_MODE_ACTION}">
    <tr>
        <td align="right" nowrap="nowrap" colspan="2"><span class="genmed">{L_CHOOSE_SORT} :&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;</span>
        <input type="submit" name="submit" value="{L_GO}" class="liteoption" />
        </td>
    </tr>
    </form>
</table>

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<form method="post" name="log_list" action="{S_MODE_ACTION}">
<tr>
        <th>{L_ID_LOG}</th>
        <th>{L_ACTION}</th>
        <th>{L_TOPIC}</th>
        <th>{L_DONE_BY}</th>
        <th>{L_USER_IP}</th>
        <th>{L_DATE}</th>
        <th>{L_DELETE_LOG}</th>
</tr>
<!-- BEGIN record_row -->
<tr>
        <td class="row2"><center>{record_row.ID_LOG}</center></td>
        <td class="row1"><center>{record_row.ACTION}</center></td>
        <td class="row2"><center>{record_row.TOPIC}&nbsp;&nbsp;&nbsp;{record_row.TOPIC_IMG}</center></td>
        <td class="row1"><center>{record_row.USERNAME}</center></td>
        <td class="row2"><center><a href="{record_row.U_WHOIS_IP}" target="_blank">{record_row.USER_IP}</a></center></td>
        <td class="row1"><center>{record_row.DATE}</center></td>
        <td class="row2" align="center" valign="middle"><input type="checkbox" name="log_list[]" value="{record_row.ID_LOG}" /></td>
</tr>
<!-- END record_row -->
<tr>
 <td class="catHead" colspan="9" height="28" align="right"> 
        <input type="submit" name="delete" class="liteoption" value="{L_DELETE}" />
        <input type="submit" name="{L_CANCEL}" class="liteoption" value="{L_CANCEL}" onClick="self.location.href='{S_CANCEL_ACTION}'" />
      </td>
</tr>
<tr> 
      <td class="catBottom" colspan="9" height="28" align="right"><strong><span class="gensmall"><a href="javascript:select(true);" class="gensmall">{L_MARK_ALL}</a> :: <a href="javascript:select(false);" class="gensmall">{L_UNMARK_ALL}</a></span></strong></td>
    </tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
    <td><span class="nav">{PAGE_NUMBER}</span></td>
    <td align="right"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>
</form>

<br clear="all">