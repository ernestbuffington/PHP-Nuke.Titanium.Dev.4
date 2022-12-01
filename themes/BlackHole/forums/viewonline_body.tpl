<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><a href="{U_INDEX}">{L_INDEX}</a></td>
  </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
    <th width="35%" class="thCornerL" height="25">&nbsp;{L_USERNAME}&nbsp;</th>
    <th width="25%" class="thTop">&nbsp;{L_LAST_UPDATE}&nbsp;</th>
    <th width="40%" class="thCornerR">&nbsp;{L_FORUM_LOCATION}&nbsp;</th>
  </tr>
  <tr> 
    <td class="catSides" colspan="3" height="28">{TOTAL_REGISTERED_USERS_ONLINE}</td>
  </tr>
  <!-- BEGIN reg_user_row -->
  <tr> 
    <td width="35%" class="{reg_user_row.ROW_CLASS}"><a href="{reg_user_row.U_USER_PROFILE}">{reg_user_row.USERNAME}</a></td>
    <td width="25%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">{reg_user_row.LASTUPDATE}</td>
    <td width="40%" class="{reg_user_row.ROW_CLASS}"><a href="{reg_user_row.U_FORUM_LOCATION}">{reg_user_row.FORUM_LOCATION}</a></td>
  </tr>
  <!-- END reg_user_row -->
  <!-- <tr> 
    <td colspan="3" height="1" class="row3">&nbsp;</td>
  </tr> -->
  <tr> 
    <td class="catSides" colspan="3" height="28">{TOTAL_GUEST_USERS_ONLINE}</td>
  </tr>
  <!-- BEGIN guest_user_row -->
  <tr> 
    <td width="35%" class="{guest_user_row.ROW_CLASS}">{guest_user_row.USERNAME}</td>
    <td width="25%" align="center" nowrap="nowrap" class="{guest_user_row.ROW_CLASS}">{guest_user_row.LASTUPDATE}</td>
    <td width="40%" class="{guest_user_row.ROW_CLASS}"><a href="{guest_user_row.U_FORUM_LOCATION}">{guest_user_row.FORUM_LOCATION}</a></td>
  </tr>
  <!-- END guest_user_row -->
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td align="left" valign="top">{L_ONLINE_EXPLAIN}</td>
    <td align="right" valign="top">{S_TIMEZONE}</td>
  </tr>
</table>

<br />

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>