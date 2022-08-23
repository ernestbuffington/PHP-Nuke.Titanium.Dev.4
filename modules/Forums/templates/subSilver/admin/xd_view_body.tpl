<h1>{L_XDATA_ADMIN}</h1>

<p>{L_FORM_DESCRIPTION}</p>
<br />

<table border="0" cellpadding="4" cellspacing="1" width="80%" class="forumline" align="center">
    <tr>
        <th align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_FIELD_NAME}&nbsp;</th>
        <th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_FIELD_TYPE}&nbsp;</th>
        <th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_MOVE}&nbsp;</th>
        <th align="center" class="thCornerR" nowrap="nowrap">&nbsp;{L_OPERATIONS}&nbsp;</th>
    </tr>
    <!-- BEGIN xd_field -->
    <tr>
        <td class="row1" align="center" valign="middle">{xd_field.FIELD_NAME}</td>
        <td class="row2" align="center" valign="middle">{xd_field.FIELD_TYPE}</td>
        <td class="row1" align="center" valign="middle">
              <a href="{xd_field.U_MOVE_UP}">{L_MOVE_UP}</a><br />
              <a href="{xd_field.U_MOVE_DOWN}">{L_MOVE_DOWN}</a>
        </td>
        <td class="row2" align="center" valign="middle">
            <a href="{xd_field.U_EDIT}">{L_EDIT}</a><br />
            <!-- BEGIN normal -->
            <a href="{xd_field.U_DELETE}">{L_DELETE}</a>
            <!-- END normal -->
        </td>
    </tr>
    <!-- END xd_field -->
    <!-- BEGIN switch_no_fields -->
    <tr>
        <td colspan="4" class="row1" align="center" valign="middle" height="30">{L_NO_FIELDS}</td>
    </tr>
    <!-- END switch_no_fields -->
    <tr>
        <td class="catBottom" colspan="4" align="center" height="20">&nbsp;<a href="{U_ADD_FIELD}">{L_ADD_FIELD}</a>&nbsp;</td>
    </tr>
</table>
<br />