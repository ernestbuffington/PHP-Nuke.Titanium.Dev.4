<form action="{S_ACTION}" method="post" name="post">
{S_HIDDEN_FORM_FIELDS}
<table width="50%" cellspacing="1" cellpadding="5" border="0" class="forumline" align="center">
  <tr>
  	<th class="thHead" nowrap="nowrap" colspan="2">{L_TITLE}</th>
  </tr>
  <tr>
    <td class="row3" colspan="2"><span class="genmed">{L_EXPLAIN}</span></td>
  </tr>
  <!-- BEGIN switch_report_post_on -->
  <tr>
    <td class="row1" nowrap="nowrap" width="50%"><span class="genmed">{L_INFO}:<br />{L_DATE}:<br />{L_USER}:</span></td>
    <td class="row2" nowrap="nowrap" width="50%"><span class="genmed">{INFO}<br />{DATE}<br /><a href="{USERLINK}">{USERNAME}</a></span></td>
  </tr>
  <!-- END switch_report_post_on -->
  <!-- BEGIN switch_report_post_off -->
  <tr>
    <td class="row1" nowrap="nowrap" width="50%" valign="middle"><span class="genmed">{L_INFO}</span></td>
    <td class="row2" nowrap="nowrap" width="50%"><span class="genmed"><input type="text" name="info" size="45" maxlength="80" style="width:200px" tabindex="1" class="post" value="{INFO}"/></span></td>
  </tr>
  <tr>
    <td class="row1" nowrap="nowrap" width="50%"><span class="genmed">{L_DATE}:<br />{L_USER}:</span></td>
    <td class="row2" nowrap="nowrap" width="50%"><span class="genmed">{DATE}<br /><a href="{USERLINK}">{USERNAME}</a></span></td>
  </tr>
  <!-- END switch_report_post_off -->
  <tr>
    <td class="row3" colspan="2"><textarea name="message" maxlength="255" rows="5" cols="35" wrap="virtual" style="width:100%" tabindex="2" class="post"></textarea></td>
  </tr>
  <tr>
    <td class="row3" colspan="2" align="center"><input type="submit" accesskey="s" tabindex="3" name="submit" class="mainoption" value="{L_SUBMIT}" /></td>
  </tr>
</table>
</form>
