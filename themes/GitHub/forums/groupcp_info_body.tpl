<form action="{S_GROUPCP_ACTION}" method="post">
<!-- BEGIN groups title -->
{GROUPS_LIST_INFO}
<!-- END groups title -->
<table border="0" cellpadding="4" cellspacing="1" class="acenter" style="width: 100%">
    <tr>
        <td class="aleft"><span class="over-ride">{GROUPS_LINK}{GROUPS_LIST_INFO_LINK}</span></td>
    </tr>
</table>

<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%">
    <tr> 
        <td class="catHead acenter" colspan="2">{L_GROUP_INFORMATION}</td>
    </tr>
    <tr> 
        <td class="row1" width="20%"><span class="over-ride"><strong>{L_GROUP_NAME}:</strong></span></td>
        <td class="row2"><span class="over-ride">{GROUP_NAME}</span></td>
    </tr>
    <tr> 
        <td class="row1" width="20%"><span class="over-ride"><strong>{L_GROUP_DESC}:</strong></span></td>
        <td class="row2"><span class="over-ride">{GROUP_DESC}</span></td>
    </tr>
    <tr> 
        <td class="row1" width="20%"><span class="over-ride"><strong>{L_GROUP_MEMBERSHIP}:</strong></span></td>
        <td class="row2"><span class="over-ride">{GROUP_DETAILS}</span>
        <!-- BEGIN switch_subscribe_group_input -->
        <input class="btn-hover-two" type="submit" name="joingroup" value="{L_JOIN_GROUP}" />
        <!-- END switch_subscribe_group_input -->
        <!-- BEGIN switch_unsubscribe_group_input -->
        <input class="btn-hover-two" type="submit" name="unsub" value="{L_UNSUBSCRIBE_GROUP}" />
        <!-- END switch_unsubscribe_group_input -->
        </td>
    </tr>
    <!-- BEGIN switch_mod_option -->
    <tr> 
        <td class="row1" width="20%"><span class="over-ride"><strong>{L_GROUP_TYPE}:</strong></span></td>
        <td class="row2" align="left"><input style="vertical-align: middle" type="radio" name="group_type" value="{S_GROUP_OPEN_TYPE}" {S_GROUP_OPEN_CHECKED}/>&nbsp;<span class="over-ride">{L_GROUP_OPEN}</span>&nbsp;<input style="vertical-align: middle" type="radio" name="group_type" value="{S_GROUP_CLOSED_TYPE}" {S_GROUP_CLOSED_CHECKED}/>&nbsp;<span class="over-ride">{L_GROUP_CLOSED}</span>&nbsp;<input style="vertical-align: middle" type="radio" name="group_type" value="{S_GROUP_HIDDEN_TYPE}" {S_GROUP_HIDDEN_CHECKED}/>&nbsp;<span class="over-ride">{L_GROUP_HIDDEN}</span>&nbsp;<input class="btn-hover-two" type="submit" name="groupstatus" value="{L_UPDATE}" /></td>
    </tr>
    <!-- END switch_mod_option -->
</table>
{S_HIDDEN_FIELDS}
</form>

<br />

<form action="{S_GROUPCP_ACTION}" method="post" name="post">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
    <tr> 
      <td class="catHead acenter" style="width: 10%;">{L_PM}</td>
      <td class="catHead">{L_USERNAME}</td>
      <td class="catHead acenter">{L_POSTS}</td>
      <td class="catHead" align="center">{L_FROM}</td>
      <td class="catHead acenter">{L_EMAIL}</td>
      <td class="catHead acenter">{L_ONLINE_STATUS}</td>
      <td class="catHead acenter">{L_WEBSITE}</td>
      <td class="catHead acenter" style="width: 8%;">{L_SELECT}</td>
    </tr>
    <tr> 
      <td class="catSides" colspan="8">{L_GROUP_MODERATOR}</td>
    </tr>
    <tr> 
      <td class="row1 acenter"> {MOD_PM_IMG} </td>
      <td class="row1">{MOD_CURRENT_AVATAR}<a href="{U_MOD_VIEWPROFILE}">{MOD_USERNAME}</a></td>
      <td class="row1 acenter" valign="middle">{MOD_POSTS}</td>
      <td class="row1" align="center">{MOD_FLAG}{MOD_FROM}
        <!-- <table border="0">
          <tr>
            <td align="center" width="90%"><span class="gen">{MOD_FROM}</span></td>
            <td align="right">{MOD_FLAG}</td>
          </tr>
        </table> -->
      </td>
      <td class="row1 acenter" valign="middle">{MOD_EMAIL_IMG}</td>
      <td class="row1 acenter" valign="middle">{MOD_ONLINE_STATUS}</td>
      <td class="row1 acenter">{MOD_WWW_IMG}</td>
      <td class="row1 acenter">&nbsp;</td>
    </tr>
    <tr> 
      <td class="catSides" colspan="8" height="28">{L_GROUP_MEMBERS}</td>
    </tr>
    <!-- BEGIN member_row -->
    <tr> 
      <td class="{member_row.ROW_CLASS} acenter"> {member_row.PM_IMG} </td>
      <td class="{member_row.ROW_CLASS}">{member_row.CURRENT_AVATAR} <a href="{member_row.U_VIEWPROFILE}">{member_row.USERNAME}</a></td>
      <td class="{member_row.ROW_CLASS} acenter">{member_row.POSTS}</td>
      <td class="{member_row.ROW_CLASS}" align="center">{member_row.FLAG}{member_row.FROM}</td>
      <td class="{member_row.ROW_CLASS} acenter" valign="middle">{member_row.EMAIL_IMG}</td>
      <td class="{member_row.ROW_CLASS} acenter" valign="middle">{member_row.ONLINE_STATUS}</td>
      <td class="{member_row.ROW_CLASS} acenter">{member_row.WWW_IMG}</td>
      <td class="{member_row.ROW_CLASS} acenter"> 
      <!-- BEGIN switch_mod_option -->
      <input type="checkbox" name="members[]" value="{member_row.USER_ID}" /> 
      <!-- END switch_mod_option -->
      </td>
    </tr>
    <!-- END member_row -->

    <!-- BEGIN switch_no_members -->
    <tr> 
      <td class="row1" colspan="8" align="center">{L_NO_MEMBERS}</td>
    </tr>
    <!-- END switch_no_members -->

    <!-- BEGIN switch_hidden_group -->
    <tr> 
      <td class="row1" colspan="8" align="center">{L_HIDDEN_MEMBERS}</td>
    </tr>
    <!-- END switch_hidden_group -->

    <!-- BEGIN switch_mod_option -->
    <tr>
        <td class="catBottom" colspan="8" align="right">
            <span class="cattitle"><input type="submit" name="remove" value="{L_REMOVE_SELECTED}" class="btn-hover-one" /></span>
        </td>
    </tr>
    <!-- END switch_mod_option -->
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr>
        <td align="left" valign="top">
        <!-- BEGIN switch_mod_option -->
        <br /><input type="text"  class="post" name="username" maxlength="50" size="20" />&nbsp;<input type="submit" name="add" value="{L_ADD_MEMBER}" class="btn-hover-one" /><br /><br /> 
        <!-- END switch_mod_option -->
        {PAGE_NUMBER}</td>
        <td align="right" valign="top">{PAGINATION}</td>
    </tr>
</table>

{PENDING_USER_BOX}

{S_HIDDEN_FIELDS}</form>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>