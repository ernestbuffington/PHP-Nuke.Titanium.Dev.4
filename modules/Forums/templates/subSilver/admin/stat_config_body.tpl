<h1>{L_CONFIG_TITLE}</h1>

<p>{L_CONFIG_EXPLAIN}</p>

{ERROR_BOX}

<table class="forumline" align="center" width="45%">
    <tr>
        <th class="thHead">{L_MESSAGES}</th>
    </tr>
    <tr>
        <td class="row3"><span class="gen">{MESSAGE}</td>
    </tr>
</table>
<form action="{S_ACTION}" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="2">{L_CONFIGURATION}</th>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_RETURN_LIMIT}</span><br /><span class="gensmall">{L_RETURN_LIMIT_EXPLAIN}</span></td>
        <td class="row2"><input type="text" size="10" maxlength="10" name="return_limit" value="{RETURN_LIMIT}" /></td>
    </tr>
<!--    <tr>
      <th class="thHead" colspan="2">L_LANGUAGE_CONFIGURATION</th>
    </tr>-->
    <tr>
      <th class="thHead" colspan="2">{L_RESET_SETTINGS_TITLE}</th>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_RESET_CACHE}</span><br /><span class="gensmall">{L_RESET_CACHE_EXPLAIN}</span></td>
        <td class="row2"><input type="checkbox" name="reset_cache" /></td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_RESET_VIEW_COUNT}</span><br /><span class="gensmall">{L_RESET_VIEW_COUNT_EXPLAIN}</span></td>
        <td class="row2"><input type="checkbox" name="reset_view_count" /></td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_RESET_INSTALL_DATE}</span><br /><span class="gensmall">{L_RESET_INSTALL_DATE_EXPLAIN}</span></td>
        <td class="row2"><input type="checkbox" name="reset_install_date" /></td>
    </tr>
    <tr>
        <td class="row1">{L_PURGE_MODULE_DIRECTORY}<br /><span class="gensmall">{L_PURGE_MODULE_DIRECTORY_EXPLAIN}</span></td>
        <td class="row2"><input type="checkbox" name="purge_module_directory" /></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
    </tr>
</table></form>

<br />
<div align="center"><span class="copyright">{VERSION_INFO}<br />{INSTALL_INFO}<br />{VIEWED_INFO}</span></div>

<br clear="all" />