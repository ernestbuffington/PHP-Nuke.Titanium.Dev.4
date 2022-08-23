<h1>{L_LANG_CP_TITLE}</h1>

<p>{L_LANG_CP_EXPLAIN}</p>

<form method="post" action="{S_ACTION}">

{EDIT_LANG_PANEL}
<br />
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr>
        <th class="thHead" colspan="6">{L_LANG_CP_TITLE}</th>
    </tr>
    <tr>
        <td class="catLeft" width="50%"><span class="gen"><input type="text" class="post" size="20" name="new_language" />&nbsp;<input type="submit" name="new_lang_submit" value="{L_CREATE_NEW_LANG}" class="liteoption" /></span></td> <!-- create new language, possible to choose an existing language as schema -->
        <td class="cat" width="5%" align="center" valign="middle"><span class="gen">&nbsp;</span></td>
        <td class="cat" align="center" valign="middle"><span class="gen"><a href="{U_NEW_LANG_IMPORT}">{L_IMPORT_NEW_LANGUAGE}</a></span></td> <!-- import: only add complete new languages -->
        <!--<td class="cat" align="center" valign="middle"><span class="gen"><a href="{U_LANG_COMPLETE_IMPORT}">L_COMPLETE_IMPORT</a></span></td>--> <!-- import: overwriting all other languages -->
        <td class="catRight" align="center" valign="middle"><span class="gen"><a href="{U_LANG_COMPLETE_EXPORT}">{L_COMPLETE_EXPORT}</a></span></td> <!-- export: export everything -->
    </tr>
    <!-- BEGIN langrow -->
    <tr>
        <td class="row2" width="50%"><strong><span class="gensmall"><a href="{langrow.U_COLLAPSE_DECOLLAPSE}" class="gensmall">{langrow.L_COLLAPSE_DECOLLAPSE}</a></span></strong><span class="cattitle">&nbsp;{langrow.LANGUAGE}</span></td> <!-- Language Title, collapse/decollapse, default: collapsed -->
        <td class="row2" align="center" valign="middle"><span class="gen"><input type="submit" name="delete_complete_lang[{langrow.LANGUAGE}]" value="{L_DELETE_LANG}" class="liteoption" /></span></td> <!-- Delete language for all modules -->
        <td class="row2" align="center" valign="middle"><span class="gen"><a href="{langrow.U_LANG_COMPLETE_EDIT}">{L_EDIT}</a></span></td> <!-- Edit language for all modules -->
        <!--<td class="row2" align="center" valign="middle"><span class="gen"><a href="{langrow.U_LANG_COMPLETE_IMPORT}">L_IMPORT</a></span></td>--> <!-- Import/Update complete current language -->
        <td class="row2" align="center" valign="middle"><span class="gen"><a href="{langrow.U_LANG_COMPLETE_EXPORT}">{L_COMPLETE_LANG_EXPORT}</a></span></td> <!-- Export complete current language -->
    </tr>
    <!-- BEGIN modulerow -->
    <tr> 
        <td class="row2" width="50%"><span class="gen">{langrow.modulerow.MODULE_NAME}</span><br /><span class="gensmall">{langrow.modulerow.MODULE_DESC}</span></td> <!-- Module Description -->
        <td class="row1" align="center" valign="middle"><span class="gen">{langrow.modulerow.INFORMATIONS}</span></td>
        <td class="row2" align="center" valign="middle"><span class="gen"><a href="{langrow.modulerow.U_LANG_EDIT}">{L_EDIT}</a></span></td> <!-- Edit Language for this Module -->
        <!--<td class="row2" align="center" valign="middle"><span class="gen"><a href="{langrow.modulerow.U_LANG_IMPORT}">L_IMPORT</a></span></td>--> <!-- Import/Update language for current Module -->
        <td class="row1" align="center" valign="middle"><span class="gen"><a href="{langrow.modulerow.U_LANG_EXPORT}">{L_EXPORT_MODULE}</a></span></td> <!-- Export Language for current module -->
    </tr>
    <!-- END modulerow -->
    <tr>
        <td colspan="5" height="1" class="spaceRow"><img src="../templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
    <!-- END langrow -->
    <tr>
        <td colspan="5" height="1" class="spaceRow"><img src="../templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
</table>
</form>