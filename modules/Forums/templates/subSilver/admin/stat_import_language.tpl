<h1>{L_IMPORT_LANGUAGE}</h1>

<p>{L_IMPORT_LANGUAGE_EXPLAIN}</p>

<!-- BEGIN switch_select_lang -->

<form method="post" action="{S_ACTION}">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="50%">
    <tr> 
      <td class="catHead" colspan="1" align="center" height="28"><span class="cattitle">{L_SELECT_LANGUAGE}</span></td>
    </tr>
    <tr>
        <td class="row1" align="center"><span class="gen">{S_SELECT_LANGUAGE}</span></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="1" align="center">{S_SELECT_HIDDEN_FIELDS}
        <input class="mainoption" name="submit" type="submit" value="{L_SUBMIT}" /></td>
    </tr>
</table></form>

<!-- END switch_select_lang -->

<!-- BEGIN switch_upload_lang -->

<form method="post" action="{S_ACTION}" enctype="multipart/form-data">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="50%">
    <tr> 
      <td class="catHead" colspan="1" align="center" height="28"><span class="cattitle">{L_UPLOAD_LANGUAGE}</span></td>
    </tr>
    <tr>
        <td class="row1" align="center"><span class="gen"><input type="file" name="package" size="20" value="" class="post"></span></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="1" align="center">{S_UPLOAD_HIDDEN_FIELDS}
        <input class="mainoption" name="submit" type="submit" value="{L_SUBMIT}" /></td>
    </tr>
</table></form>

<!-- END switch_upload_lang -->

<!-- BEGIN switch_install_language -->

<form method="post" action="{S_ACTION}">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="99%">
    <tr> 
      <td class="catHead" colspan="2" align="center" height="28"><span class="cattitle">{L_INSTALL_LANGUAGE}</span></td>
    </tr>
    <tr> 
      <th class="thLeft" align="left" width="10%">&nbsp;{L_LANGUAGE}&nbsp;</th>
      <th class="thRight" align="center">&nbsp;{L_MODULES}&nbsp;</th>
    </tr>
<!-- END switch_install_language -->
<!-- BEGIN languages -->
    <tr>
        <td class="row1" align="left" colspan="2"><span class="gen">{languages.LANGUAGE}</span></td>
    </tr>
<!-- BEGIN modules -->
    <tr>
        <td class="row2" align="center" colspan="2"><span class="gen">{languages.modules.MODULE}</span></td>
    </tr>
<!-- END modules -->
<!-- END languages -->
<!-- BEGIN switch_install_language -->    
    <tr>
        <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}
        <input class="mainoption" name="submit" type="submit" value="{L_INSTALL}" /></td>
    </tr>
</table></form>

<!-- END switch_install_language -->