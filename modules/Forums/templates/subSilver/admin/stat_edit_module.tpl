<h1>{L_EDIT_MODULE}</h1>

<p>{L_EDIT_MODULE_EXPLAIN}</p>

<table class="forumline" align="center" width="45%">
    <tr>
        <th class="thHead">{L_MESSAGES}</th>
    </tr>
    <tr>
        <td class="row3"><span class="gen">{MESSAGE}</td>
    </tr>
</table>
<br />

<form action="{S_ACTION}" method="post">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="99%">
    <tr> 
      <td class="catHead" colspan="2" align="center" height="28"><span class="cattitle">{L_EDIT_MODULE}</span></td>
    </tr>
    <tr> 
      <td class="spaceRow" colspan="2" align="center"><span class="gen">-&gt;&nbsp;<a href="{U_PREVIEW_MODULE}" target="_blank" class="gen">{L_PREVIEW_MODULE}</a>&nbsp;&lt;-</span></td>
    </tr>
    <tr>
      <th class="thHead" colspan="2">{L_CONFIGURATION}</th>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_UPDATE_TIME}</span><br /><span class="gensmall">{L_UPDATE_TIME_EXPLAIN}</span></td>
        <td class="row2"><input type="text" size="10" maxlength="10" name="update_time" value="{UPDATE_TIME}" class="post" /></td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_CLEAR_MODULE_CACHE}</span><br /><span class="gensmall">{L_CLEAR_MODULE_CACHE_EXPLAIN}</span></td>
        <td class="row2"><input type="checkbox" name="clear_module_cache" /></td>
    </tr>
<!-- BEGIN module_admin_fields -->
    <tr>
        <td class="row1"><span class="gen">{module_admin_fields.L_TITLE}</span><br /><span class="gensmall">{module_admin_fields.L_EXPLAIN}</span></td>
        <td class="row2">{module_admin_fields.S_OPTION_FIELD}</td>
    </tr>
<!-- END module_admin_fields -->
    <tr>
        <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
    </tr>
</table>
<br />
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="99%">
    <tr> 
      <td class="catHead" colspan="2" align="center" height="28"><span class="cattitle">{L_PERMISSIONS}</span></td>
    </tr>
    <tr> 
      <td class="spaceRow" colspan="2" align="center"><span class="gensmall">{L_PERMISSIONS_TITLE}</span></td>
    </tr>
    <tr>
        <td class="row1" align="right"><span class="gen"><input type="checkbox" name="perm_all" {PERM_ALL} /></span></td>
        <td class="row2"><span class="gen">{L_PERM_ALL}</span></td>
    </tr>
    <tr>
        <td class="row1" align="right"><span class="gen"><input type="checkbox" name="perm_reg" {PERM_REG} /></span></td>
        <td class="row2"><span class="gen">{L_PERM_REG}</span></td>
    </tr>
    <tr>
        <td class="row1" align="right"><span class="gen"><input type="checkbox" name="perm_mod" {PERM_MOD} /></span></td>
        <td class="row2"><span class="gen">{L_PERM_MOD}</span></td>
    </tr>
    <tr>
        <td class="row1" align="right"><span class="gen"><input type="checkbox" name="perm_admin" {PERM_ADMIN} /></span></td>
        <td class="row2"><span class="gen">{L_PERM_ADMIN}</span></td>
    </tr>
    <tr> 
      <td class="spaceRow" colspan="2" align="center"><span class="gensmall">{L_GROUPS_TITLE}</span></td>
    </tr>
    <tr> 
        <td class="row1">{L_ADDED_GROUPS}</td>
        <td class="row2">{S_SELECTED_GROUPS}&nbsp;
<!-- BEGIN switch_groups_selected -->
<input type="submit" name="delete_group" value="{L_REMOVE}" class="liteoption" /></td>
<!-- END switch_groups_selected -->
    </tr>
    <tr> 
        <td class="row1">{L_GROUPS}</td>
        <td class="row2">{S_GROUP_SELECT}&nbsp;
<!-- BEGIN switch_groups_there -->
<input type="submit" name="add_group" value="{L_ADD}" class="liteoption" /></td>
<!-- END switch_groups_there -->
        </td>
    </tr>
    <tr>
        <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
    </tr>
</table>
</form>
<br />
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="99%">
    <tr> 
      <td class="catHead" colspan="2" align="center" height="28"><span class="cattitle">{L_MODULE_INFORMATIONS}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_MODULE_NAME}</span></td>
        <td class="row2" align="left"><span class="gen">{MODULE_NAME}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_MODULE_DESCRIPTION}</span></td>
        <td class="row2" align="left"><span class="gen">{MODULE_DESCRIPTION}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_MODULE_VERSION}</span></td>
        <td class="row2" align="left"><span class="gen">{MODULE_VERSION}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_MODULE_AUTHOR}</span></td>
        <td class="row2" align="left"><span class="gen">{MODULE_AUTHOR}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_AUTHOR_EMAIL}</span></td>
        <td class="row2" align="left"><span class="gen">{AUTHOR_EMAIL}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_MODULE_URL}</span></td>
        <td class="row2" align="left"><span class="gen"><a href="{U_MODULE_URL}" target="_blank">{MODULE_URL}</a></span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_UPDATE_URL}</span></td>
        <td class="row2" align="left"><span class="gen"><a href="{U_UPDATE_URL}" target="_blank">{UPDATE_URL}</a></span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_MODULE_LANGUAGES}</span></td>
        <td class="row2" align="left"><span class="gen">{MODULE_LANGUAGES}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_MODULE_STATUS}</span></td>
        <td class="row2" align="left"><span class="gen">{MODULE_STATUS}</span></td>
    </tr>
</table>
<br />

<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="99%">
<form action="{S_ACTION_UPDATE}" method="post" enctype="multipart/form-data">
    <tr> 
      <td class="catHead" colspan="2" align="center" height="28"><span class="cattitle">{L_UPDATE_MODULE}</span></td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_SELECT_MODULE}</span></td>
        <td class="row2"><span class="gen">{S_SELECT_MODULE}</span></td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_UPLOAD_MODULE}</span></td>
        <td class="row2"><input type="file" name="package" size="20" value="" class="post"></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="2" align="center">{S_SELECT_HIDDEN_FIELDS}{S_UPLOAD_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_UPDATE}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
    </tr>
</table></form>