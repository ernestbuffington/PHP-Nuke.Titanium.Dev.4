<h1>{L_XDATA_ADMIN}</h1>
<br />

<form action="{U_FORM_ACTION}" method="post">

<table border="0" cellpadding="4" cellspacing="1" width="80%" class="forumline" align="center">
    <tr>
        <th align="center" height="25" class="thHead" nowrap="nowrap" colspan="2">&nbsp;{L_BASIC_OPTIONS}&nbsp;</th>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_NAME}</span>
        </td>
        <td class="row2">
            <span class="gen">{NAME}</span>
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_DEFAULT_AUTH}</span><br />
            <span class="gensmall">{L_DEFAULT_AUTH_EXPLAIN}</span>
        </td>
        <td class="row2">
            <input type="radio" name="default_auth" value="{AUTH_ALLOW}"{DEFAULT_AUTH_ALLOW_CHECKED} /><span class="gen">{L_ALLOW}</span><br />
            <input type="radio" name="default_auth" value="{AUTH_DENY}"{DEFAULT_AUTH_DENY_CHECKED} /><span class="gen">{L_DENY}</span><br />
        </td>
    </tr>
    <tr>
      <td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
    </tr>
</table>

<br />

<table border="0" cellpadding="4" cellspacing="1" width="80%" class="forumline" align="center">
    <tr>
        <th align="center" height="25" class="thHead" nowrap="nowrap" colspan="2">&nbsp;{L_ADVANCED_OPTIONS}&nbsp;</th>
    </tr>
    <tr>
        <td colspan="2" class="row3" height="35" align="center">{L_ADVANCED_NOTICE}</td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_DISPLAY_TYPE}</span><br />
            <span class="gensmall">{L_DISPLAY_REGISTER_EXPLAIN}</span>
        </td>
        <td class="row2">
            <input type="radio" name="display_register" value="1"{DISPLAY_REGISTER_NORMAL_CHECKED} /><span class="gen">{L_NORMAL}</span>&nbsp;&nbsp;
            <input type="radio" name="display_register" value="0"{DISPLAY_REGISTER_NONE_CHECKED} /><span class="gen">{L_NONE}</span>&nbsp;&nbsp;
            <input type="radio" name="display_register" value="2"{DISPLAY_REGISTER_ROOT_CHECKED} /><span class="gen">{L_ROOT}</span>
        </td>
    </tr>
</table>

<input type="hidden" name="field_name" value="{NAME}" />
<input type="hidden" name="field_desc" value="{DESCRIPTION}" />
<input type="hidden" name="field_length" value="{LENGTH}" />
<input type="hidden" name="field_type" value="special" />
<input type="hidden" name="field_values" value="{VALUES}" />
<input type="hidden" name="display_viewprofile" value="0" />
<input type="hidden" name="display_posting" value="0" />
<input type="hidden" name="new_code_name" value="{CODE_NAME}" />
<input type="hidden" name="handle_input" value="0" />
<input type="hidden" name="regexp" value="" />
{S_HIDDEN_FIELDS}

</form>