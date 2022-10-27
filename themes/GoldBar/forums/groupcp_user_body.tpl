<!-- BEGIN groups title -->
{GROUPS_TITLE}
<!-- END groups title -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td></td>
  </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <!-- BEGIN switch_groups_joined -->
  <tr> 
    <th colspan="2" align="center" class="thHead" height="25">{L_GROUP_MEMBERSHIP_DETAILS}</th>
  </tr>
  <!-- BEGIN switch_groups_member -->
  <tr> 
    <td class="row1">{L_YOU_BELONG_GROUPS}</td>
    <td class="row2" align="right">
      <form method="post" action="{S_USERGROUP_ACTION}">
      <table width="90%" cellspacing="0" cellpadding="0" border="0">
            <td width="40%">{GROUP_MEMBER_SELECT}</td>
            <td align="center" width="30%"> 
              <input type="submit" value="{L_VIEW_INFORMATION}" class="titaniumbutton" />
              {S_HIDDEN_FIELDS}
            </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
  <!-- END switch_groups_member -->
  <!-- BEGIN switch_groups_pending -->
  <tr> 
    <td class="row1">{L_PENDING_GROUPS}</td>
    <td class="row2" align="right"> 
      <form method="post" action="{S_USERGROUP_ACTION}">
      <table width="90%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="40%">{GROUP_PENDING_SELECT}</td>
            <td align="center" width="30%"> 
              <input type="submit" value="{L_VIEW_INFORMATION}" class="titaniumbutton" />
              {S_HIDDEN_FIELDS}
            </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
  <!-- END switch_groups_pending -->
  <!-- END switch_groups_joined -->
  <!-- BEGIN switch_groups_remaining -->
  <tr> 
    <th colspan="2" align="center" class="thHead" height="25">{L_JOIN_A_GROUP}</th>
  </tr>
  <tr> 
    <td class="row1">{L_SELECT_A_GROUP}</td>
    <td class="row2" align="right"> 
      <form method="post" action="{S_USERGROUP_ACTION}">
      <table width="90%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td width="40%">{GROUP_LIST_SELECT}</td>
            <td align="center" width="30%"> 
              <input type="submit" value="{L_VIEW_INFORMATION}" class="titaniumbutton" />
              {S_HIDDEN_FIELDS}
            </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
  <!-- END switch_groups_remaining -->
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td align="right" valign="top">{S_TIMEZONE}</td>
  </tr>
</table>

<br />

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>