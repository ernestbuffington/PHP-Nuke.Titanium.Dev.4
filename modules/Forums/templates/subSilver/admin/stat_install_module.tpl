<h1>{L_INSTALL_MODULE}</h1>

<p>{L_INSTALL_MODULE_EXPLAIN}</p>

<!-- BEGIN switch_select_module -->

<form method="post" action="{S_ACTION}">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="50%">
    <tr> 
      <td class="catHead" colspan="1" align="center" height="28"><span class="cattitle">{L_SELECT_MODULE}</span></td>
    </tr>
    <tr>
        <td class="row1" align="center"><span class="gen">{S_SELECT_MODULE}</span></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="1" align="center">{S_SELECT_HIDDEN_FIELDS}
        <input class="mainoption" name="submit" type="submit" value="{L_SUBMIT}" /></td>
    </tr>
</table></form>

<!-- END switch_select_module -->

<!-- BEGIN switch_upload_module -->

<form method="post" action="{S_ACTION}" enctype="multipart/form-data">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="50%">
    <tr> 
      <td class="catHead" colspan="1" align="center" height="28"><span class="cattitle">{L_UPLOAD_MODULE}</span></td>
    </tr>
    <tr>
        <td class="row1" align="center"><span class="gen"><input type="file" name="package" size="20" value="" class="post"></span></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="1" align="center">{S_UPLOAD_HIDDEN_FIELDS}
        <input class="mainoption" name="submit" type="submit" value="{L_SUBMIT}" /></td>
    </tr>
</table></form>

<!-- END switch_upload_module -->

<!-- BEGIN switch_install_module -->

<form method="post" action="{S_ACTION}">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="99%">
    <tr> 
      <td class="catHead" colspan="2" align="center" height="28"><span class="cattitle">{L_INSTALL_MODULE}</span></td>
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
        <td class="row1" align="left"><span class="gen">{L_REQUIRED_STATS_VERSION}</span></td>
        <td class="row2" align="left"><span class="gen">{STATS_VERSION}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_INSTALLED_STATS_VERSION}</span></td>
        <td class="row2" align="left"><span class="gen">{INSTALLED_STATS_VERSION}</span></td>
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
        <td class="row2" align="left"><span class="gen">{MODULE_URL}</span></td>
    </tr>
    <tr>
        <td class="row1" align="left"><span class="gen">{L_UPDATE_URL}</span></td>
        <td class="row2" align="left"><span class="gen">{UPDATE_URL}</span></td>
    </tr>
    <tr> 
      <th class="thLeft">&nbsp;{L_PROVIDED_LANGUAGE}&nbsp;</th>
      <th class="thRight">&nbsp;{L_INSTALL_LANGUAGE}&nbsp;</th>
    </tr>
<!-- END switch_install_module -->
<!-- BEGIN languages -->
    <tr>
        <td class="row1" align="left"><span class="gen">{languages.MODULE_LANGUAGE}</span></td>
        <td class="row2" align="left"><input type="checkbox" name="checked_languages[]" value="{languages.MODULE_LANGUAGE}" checked="checked"></td>
    </tr>
<!-- END languages -->
<!-- BEGIN switch_install_module -->    
    <tr>
        <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}
        <input class="mainoption" name="submit" type="submit" value="{L_INSTALL}" /></td>
    </tr>
</table></form>

<!-- END switch_install_module -->