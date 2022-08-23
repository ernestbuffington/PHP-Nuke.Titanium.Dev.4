<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr>
        <th class="thHead" colspan="4">{LANGUAGE}</th>
    </tr>
<!-- BEGIN modules -->
    <tr>
        <td class="cat" colspan="4" align="center"><span class="cattitle">{modules.MODULE_NAME}</span></th>
    </tr>
    <tr> 
      <th class="thLeft">&nbsp;{L_LANGUAGE_KEY}&nbsp;</th>
      <th>&nbsp;{L_LANGUAGE_VALUE}&nbsp;</th>
      <th>&nbsp;{L_UPDATE}&nbsp;</th>
      <th class="thRight">&nbsp;{L_DELETE}&nbsp;</th>
    </tr>
<!-- BEGIN language_entries -->    
    <tr> 
        <td class="row2"><span class="gen">{modules.language_entries.KEY}</span></td>
        <td class="row1" width="60%" align="center" valign="middle"><span class="gen"><input type="text" style="width:90%" name="lang_entry[{LANGUAGE}][{modules.language_entries.MODULE_ID}][{modules.language_entries.KEY}]" value="{modules.language_entries.VALUE}" class="post" /></td>
        <td class="row2" align="center" valign="middle"><span class="gen"><input type="submit" class="liteoption" name="update[{LANGUAGE}][{modules.language_entries.MODULE_ID}][{modules.language_entries.KEY}]" value="{L_UPDATE}" /></span></td>
        <td class="row1" align="center" valign="middle"><span class="gen"><input type="submit" class="liteoption" name="delete[{LANGUAGE}][{modules.language_entries.MODULE_ID}][{modules.language_entries.KEY}]" value="{L_DELETE}" /></span></td>
    </tr>
<!-- END language_entries -->
    <tr>
        <td colspan="4" height="1" class="spaceRow"><img src="../templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
    <tr> 
        <td class="row2"><span class="gen"><input type="text" name="add_key" class="post" /></span></td>
        <td class="row1" width="60%" align="center" valign="middle"><span class="gen"><input type="text" style="width:90%" name="add_value" class="post" /></td>
        <td class="row2" align="center" valign="middle" colspan="2"><span class="gen"><input type="submit" class="liteoption" name="add_new_key[{LANGUAGE}][{modules.MODULE_ID}]" value="{L_ADD_NEW_KEY}" /></span></td>
    </tr>
<!-- END modules -->
    <tr>
        <td colspan="4" class="row2"><input type="submit" class="liteoption" name="update_all_lang" value="{L_UPDATE_ALL}" /></td>
    </tr>
</table>