<h1>{L_MANAGE_MODULES}</h1>

<p>{L_MANAGE_MODULES_EXPLAIN}</p>

<form method="post" action="{S_ACTION}">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr>
        <th class="thHead" colspan="5">{L_MANAGE_MODULES}</th>
    </tr>
    <!-- BEGIN modulerow -->
    <tr> 
        <td class="row2"><span class="gen"><a href="{modulerow.U_VIEW_MODULE}" target="_new">{modulerow.MODULE_NAME}</a></span><br /><span class="gensmall">{modulerow.MODULE_DESC}</span></td>
        <td class="row1" align="center" valign="middle"><span class="gen"><a href="{modulerow.U_MODULE_EDIT}">{L_EDIT}</a></span></td>
        <td class="row2" align="center" valign="middle"><span class="gen"><a href="{modulerow.U_MODULE_DELETE}">{L_DELETE}</a></span></td>
        <td class="row1" align="center" valign="middle"><span class="gen"><a href="{modulerow.U_MODULE_MOVE_UP}">{L_MOVE_UP}</a> <br /> <a href="{modulerow.U_MODULE_MOVE_DOWN}">{L_MOVE_DOWN}</a></span></td>
        <td class="row2" align="center" valign="middle"><span class="gen"><a href="{modulerow.U_MODULE_ACTIVATE}">{modulerow.ACTIVATE}</a></span></td>
    </tr>
    <!-- END modulerow -->
    <tr>
        <td colspan="5" height="1" class="spaceRow"><img src="../templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
</table></form>