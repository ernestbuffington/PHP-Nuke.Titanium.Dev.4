<h1>{L_PACKAGE_MODULE}</h1>

<p>{L_PACKAGE_MODULE_EXPLAIN}</p>

<form method="post" action="{S_ACTION}">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center" width="50%">
    <tr> 
      <td class="catHead" colspan="2" align="center" height="28"><span class="cattitle">{L_PACKAGE_MODULE}</span> 
      </td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_SELECT_INFO_FILE}</span></td>
        <td class="row1">{S_INFO_FILE}</td>
    </tr>
    <tr>
        <td class="row2"><span class="gen">{L_SELECT_LANG_FILE}</span></td>
        <td class="row2">{S_LANG_FILE}</td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_SELECT_MODULE_FILE}</span></td>
        <td class="row1">{S_PHP_FILE}</td>
    </tr>
    <tr>
        <td class="row2">{L_PACKAGE_NAME}</td>
        <td class="row2"><input type="text" size="20" maxlength="50" name="pak_name" value="" /></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input class="mainoption" name="submit" type="submit" value="{L_CREATE}" /></td>
    </tr>
</table></form>