<script>
function toggle_check_all()
{
    var archive_text = "archive_id";
    
    for (var i=0; i < document.msgrow_values.elements.length; i++)
    {
        var checkbox_element = document.msgrow_values.elements[i];
        if ((checkbox_element.name !== 'check_all_del_box') && (checkbox_element.name !== 'check_all_arch_box') && (checkbox_element.type === 'checkbox'))
        {
            if (checkbox_element.name.search("archive_id") !== -1)
            {        
                checkbox_element.checked = document.msgrow_values.check_all_arch_box.checked;
            }
            else
            {            
                checkbox_element.checked = document.msgrow_values.check_all_del_box.checked;            
            }
        }
    }
}
</script>
<!-- BEGIN statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="1" align="center">
    <tr> 
      <td align="center">{L_STATUS}<br /><strong>{I_STATUS_MESSAGE}</strong></td>
    </tr>
  </table>
<!-- END statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
      <td align="left"><span class="maintitle">{L_PAGE_NAME}</span>
          <br /><span class="gensmall"><strong>{L_VERSION} {VERSION}
          </strong></span><br /><br />
      <span class="genmed">{L_PAGE_DESC}</span><br /><br />{URL_SWITCH_MODE}</td>
    </tr>
</table>
  
<form method="post" action="{S_MODE_ACTION}" name="sort_and_pmtype">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
    <td width="40%"><span class="gen"><strong>{L_UTILS}</strong></span><ul><li>
    <a href="{URL_ORPHAN}" class="genmed">{L_REMOVE_OLD}</a>
    <li><a href="{URL_SENT}" class="genmed">{L_REMOVE_SENT}</a>
    <li><a href="{URL_ALL}" class="genmed">{L_REMOVE_ALL}</a></ul></td>
        <td align="right" nowrap="nowrap"><span class="genmed">{L_FILTER_BY}:&nbsp;{S_PMTYPE_SELECT}</span><br /><br /><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}</span>
        <br /><br /><span class="genmed">{L_TO}:&nbsp;<input type="text" class="post" size="10" maxlength="32" name="filter_to" value="{S_FILTER_TO}">&nbsp;&nbsp;{L_FROM}:&nbsp;<input type="text" class="post" size="10" maxlength="32" name="filter_from" value="{S_FILTER_FROM}"></span>
        </td>
        <td align="center" valign="middle" rowspan="2"><input type="submit" name="submit" value="{L_SORT}" class="liteoption"></td>
    </tr><tr>      <td><input type="hidden" name="mode" value="{S_MODE}">&nbsp;</td>
    <td align="right" valign="top" nowrap="nowrap">
        </td>
    </tr>
  </table></form>
{PM_MESSAGE}
<form method="post" action="{S_MODE_ACTION}" name="msgrow_values">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
    <td valign="top"><span class="nav">{PAGE_NUMBER}</span></td>
    <td align="right" valign="top"><span class="nav">{PAGINATION}&nbsp;</span><br />&nbsp;</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
    <td style="height: 30px; width: 5%; text-align: center" class="catHead">{L_DELETE}<br /><input type="checkbox" name="check_all_del_box" onClick="JavaScript:{JS_ARCHIVE_COMMENT_1}check_all_arch_box.checked = false;{JS_ARCHIVE_COMMENT_2} toggle_check_all();"></td>
<!-- BEGIN archive_avail_switch -->
      <td class="catHead" width="5%">{L_ARCHIVE}<br /><input type="checkbox" name="check_all_arch_box" onClick="JavaScript:check_all_del_box.checked = false; toggle_check_all();"></td>
<!-- END archive_avail_switch -->
      <td class="catHead" align="left">{L_SUBJECT}</td>
      <td class="catHead">{L_FROM}</td>
      <td class="catHead">{L_TO}</td>
      <td class="catHead">{L_SENT_DATE}</td>
      <td class="catHead">{L_PM_TYPE}</td>
    </tr>
    <!-- BEGIN empty_switch -->
    <tr><td colspan="6" class="row1" align="center">{L_NO_PMS}</td></tr>
    <!-- END empty_switch -->
    <!-- BEGIN msgrow -->
    <tr>  
    <td class="{msgrow.ROW_CLASS}" align="center"><input type="checkbox" name="delete_id_{msgrow.PM_ID}" onClick="JavaScript:{JS_ARCHIVE_COMMENT_1}archive_id_{msgrow.PM_ID}.checked = false{JS_ARCHIVE_COMMENT_2};"></td>
<!-- BEGIN archive_avail_switch_msg -->
      <td class="{msgrow.ROW_CLASS}" align="center"><input type="checkbox" name="archive_id_{msgrow.PM_ID}" onClick="JavaScript:delete_id_{msgrow.PM_ID}.checked = false;"></td>
<!-- END archive_avail_switch_msg -->
      <td class="{msgrow.ROW_CLASS}" align="left"><a href="{msgrow.U_INLINE_VIEWMSG}" onClick="{msgrow.U_VIEWMSG}">{msgrow.SUBJECT}</a></td>
      <td class="{msgrow.ROW_CLASS}" valign="middle">{msgrow.FROM}{msgrow.FROM_IP}</td>
      <td class="{msgrow.ROW_CLASS}" valign="middle">{msgrow.TO}</td>
      <td class="{msgrow.ROW_CLASS}" valign="middle">{msgrow.DATE}</td>
      <td class="{msgrow.ROW_CLASS}" valign="middle">{msgrow.PM_TYPE}</td>
    </tr>
    <!-- END msgrow -->
    <tr> 
      <td class="catbottom" colspan="6" height="28" align="center">
      <input type="hidden" name="mode" value="{S_MODE}">
      <input type="submit" value="{L_SUBMIT}" class="mainoption">
      &nbsp;&nbsp;
      <input type="reset" value="{L_RESET}" class="liteoption"></td>
    </tr>
  </table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
    <td valign="bottom"><span class="nav">{PAGE_NUMBER}</span></td>
    <td align="right" valign="bottom">&nbsp;<br />{PAGINATION}</td>
  </tr>
</table></form>
<hr />
<strong>{L_OPTIONS}</strong> <!--<span class="gensmall">(<a href="">About These</a>)</span>--><br />
{L_PM_VIEW_TYPE} - {URL_INLINE_MESSAGE_TYPE} | {URL_POPUP_MESSAGE_TYPE}<br />
{L_SHOW_IP} - {URL_SHOW_IP_ON} | {URL_SHOW_IP_OFF}<br />
{L_ROWS_PER_PAGE} ({L_CURRENT}: {CURRENT_ROWS}) - {URL_ROWS_PLUS_5} | {URL_ROWS_MINUS_5}<br />
{L_ARCHIVE_FEATURE} - {URL_ARCHIVE_ENABLE_LINK} | {URL_ARCHIVE_DISABLE_LINK}