<h1>{L_TITLE}</h1>

<p>{L_EXPLAIN}</p>

<table width="100%" cellpadding="6" cellspacing="1" border="0" class="forumline">
<tr>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap" colspan="2">{L_DESCRIPTION}</th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap">{L_ACTION}</th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap">{L_DELETE}</th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap">{L_DEPLACE}</th>
    <th class="thTop" height="25" valign="middle" nowrap="nowrap">{L_SYNCHRO}</th>
</tr>
<!-- BEGIN arcade_catrow -->
<tr>
 <td class="row1" >{arcade_catrow.ARCADE_CATTITLE}</td>
 <td class="row2" width="20" align="center">{arcade_catrow.ARCADE_CAT_NBELMT}</td>
 <td class="row1" align="center">
 <a href="{arcade_catrow.U_EDIT}">{L_EDIT}</a><br />
  <a href="{arcade_catrow.U_MANAGE}">{L_MANAGE}</a>
 </td>
 <td class="row2" align="center"><a href="{arcade_catrow.U_DELETE}">{L_DELETE}</a></td>
 <td class="row1" align="center">
 <a href="{arcade_catrow.U_UP}">{arcade_catrow.L_UP}</a>
 <a href="{arcade_catrow.U_DOWN}">{arcade_catrow.L_DOWN}</a>
 </td>
 <td class="row2" align="center"><a href="{arcade_catrow.U_SYNCHRO}">{L_SYNCHRO}</a></td>
</tr>
<!-- END arcade_catrow -->
<form action="{S_ACTION}" method="post">{S_HIDDEN_FIELDS} 
    <tr>
        <td class="cat" height="28" align="center" valign="middle" colspan="7">
        <input type="submit" name="{S_SUBMIT}" value="{L_NEWCAT}" class="mainoption" />
        </td>
    </tr>
</form>
</table>
<br />