<h1>{L_AUTH_TITLE}</h1>

<h2>{L_USER_OR_GROUPNAME}: {USERNAME}</h2>

<form method="post" action="{S_AUTH_ACTION}">

<!-- BEGIN switch_user_auth -->
<p>{USER_GROUP_MEMBERSHIPS}</p>
<!-- END switch_user_auth -->

<!-- BEGIN switch_group_auth -->
<p>{GROUP_MEMBERSHIP}</p>
<!-- END switch_group_auth -->
<h2>{L_PERMISSIONS}</h2>

<p>{L_AUTH_EXPLAIN}</p>

  <table cellspacing="1" width="70%" cellpadding="4" border="0" align="center" class="forumline">
    <tr> 
      <th width="60%" class="thCornerL">{L_CATEGORIES}</th>
      <th class="thTop">{L_PERMISSIONS}</th>
    </tr>
    <!-- BEGIN categorie -->
    <tr> 
      <td class="{categorie.ROW_CLASS}" align="center">{categorie.CATTITLE}</td>
      <td class="{categorie.ROW_CLASS}" align="center">{categorie.S_AUTH}</td>
    </tr>
    <!-- END categorie -->
    <tr>
      <td colspan="2" class="catBottom" align="center">{S_HIDDEN_FIELDS} 
        <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
        &nbsp;&nbsp; 
        <input type="reset" value="{L_RESET}" class="liteoption" name="reset" />
      </td>
    </tr>
  </table>
</form>