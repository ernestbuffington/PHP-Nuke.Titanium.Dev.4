<h1>{L_LOG_CONFIG_TITLE}</h1>

<p>{L_LOG_CONFIG_TITLE_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="2">{L_GENERAL_LOG_CONFIG}</th>
    </tr>
    <tr>
        <td class="row1">{L_ALLOW_OTHER_ADMIN}<br /><span class="gensmall">{L_ALLOW_OTHER_ADMIN_EXPLAIN}</span></td>
        <td class="row2"><input type="radio" name="all_admin" value="0" {S_DISALLOW_ALL_ADMIN} />{L_DISABLED}&nbsp; &nbsp;<input type="radio" name="all_admin" value="1" {S_ALLOW_ALL_ADMIN} />{L_ENABLED}</td>
    </tr>
    <tr> 
        <td class="row1">{L_ADD_ADMIN_USERNAME}<br /><span class="gensmall">{L_USERNAME_ADD_ADMIN_EXPLAIN}</span></td>
        <td class="row2">{S_ADD_ADMIN}&nbsp;<input type="submit" name="add_admin" value="{L_ADD}" class="liteoption" /></td>
    </tr>
    <tr>
        <td class="row1">{L_DELETE_ADMIN_USERNAME}<br /><span class="gensmall">{L_USERNAME_DELETE_ADMIN_EXPLAIN}</span></td>
        <td class="row2">{S_DELETE_ADMIN}&nbsp;<input type="submit" name="delete_admin" value="{L_DELETE}" class="liteoption" /></td>
    </tr>
        <tr>
        <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
        </td>
    </tr>
</table>
</form>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="2">{L_PRUNE_LOG}</th>
    </tr>
    <tr> 
        <td class="row1">{L_PRUNE}<br /><span class="gensmall">{L_PRUNE_EXPLAIN}</span></td>
        <td class="row2"><input type="text" name="prune_days" size="5" class="liteoption" />&nbsp;<input type="submit" name="do_prune" value="{L_DO_PRUNE}" class="mainoption" /></td>
    </tr>
</table>
</form>
<br clear="all" />