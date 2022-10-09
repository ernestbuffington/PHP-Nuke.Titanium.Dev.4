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
            <input type="text" name="field_name" value="{NAME}" />
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_DESCRIPTION}</span>
        </td>
        <td class="row2">
            <textarea name="field_desc" style="width: 300px" rows="3" cols="30">{DESCRIPTION}</textarea>
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_TYPE}</span>
        </td>
        <td class="row2">
            <select name="field_type">
                <option value="text" {TEXT_SELECTED}>{L_TEXT}</option>
                <option value="textarea" {TEXTAREA_SELECTED}>{L_TEXTAREA}</option>
                <option value="radio" {RADIO_SELECTED}>{L_RADIO}</option>
                <option value="select" {SELECT_SELECTED}>{L_SELECT}</option>
				<option value="checkbox" {CHECKBOX_SELECTED}>{L_CHECKBOX}</option>
                <option value="custom" {CUSTOM_SELECTED}>{L_CUSTOM}</option>
								<option value="date" {DATE_SELECTED}>{L_DATE}</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_LENGTH}</span><br />
            <span class="gensmall">{L_LENGTH_EXPLAIN}</span>
        </td>
        <td class="row2">
            <input type="text" name="field_length" value="{LENGTH}" />
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_VALUES}</span><br />
            <span class="gensmall">{L_VALUES_EXPLAIN}</span>
        </td>
        <td class="row2">
            <textarea name="field_values" value="{VALUES}" rows="6" cols="30" style="width: 300px">{VALUES}</textarea>
        </td>
    </tr>

    <tr>
        <td class="row1">
            <span class="gen">{L_ALLOW_BBCODE}</span>
        </td>
        <td class="row2">
            <input type="radio" name="allow_bbcode" value="1"{ALLOW_BBCODE_YES_CHECKED} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
            <input type="radio" name="allow_bbcode" value="0"{ALLOW_BBCODE_NO_CHECKED} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_ALLOW_SMILIES}</span>
        </td>
        <td class="row2">
            <input type="radio" name="allow_smilies" value="1"{ALLOW_SMILIES_YES_CHECKED} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
            <input type="radio" name="allow_smilies" value="0"{ALLOW_SMILIES_NO_CHECKED} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_ALLOW_HTML}</span>
        </td>
        <td class="row2">
            <input type="radio" name="allow_html" value="1"{ALLOW_HTML_YES_CHECKED} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
            <input type="radio" name="allow_html" value="0"{ALLOW_HTML_NO_CHECKED} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_VIEWTOPIC}</span>
        </td>
        <td class="row2">
            <input type="radio" name="viewtopic" value="1"{VIEWTOPIC_YES_CHECKED} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
            <input type="radio" name="viewtopic" value="0"{VIEWTOPIC_NO_CHECKED} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_SIGNUP}</span>
        </td>
        <td class="row2">
            <input type="radio" name="signup" value="1"{SIGNUP_YES_CHECKED} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
            <input type="radio" name="signup" value="0"{SIGNUP_NO_CHECKED} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;
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
    <tr>
        <td class="row1">
            <span class="gen">{L_DISPLAY_TYPE}</span><br />
            <span class="gensmall">{L_DISPLAY_PROFILE_EXPLAIN}</span>
        </td>
        <td class="row2">
            <input type="radio" name="display_viewprofile" value="1"{DISPLAY_PROFILE_NORMAL_CHECKED} /><span class="gen">{L_NORMAL}</span>&nbsp;&nbsp;
            <input type="radio" name="display_viewprofile" value="0"{DISPLAY_PROFILE_NONE_CHECKED} /><span class="gen">{L_NONE}</span>&nbsp;&nbsp;
            <input type="radio" name="display_viewprofile" value="2"{DISPLAY_PROFILE_ROOT_CHECKED} /><span class="gen">{L_ROOT}</span>
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_DISPLAY_TYPE}</span><br />
            <span class="gensmall">{L_DISPLAY_POSTING_EXPLAIN}</span>
        </td>
        <td class="row2">
            <input type="radio" name="display_posting" value="1"{DISPLAY_POSTING_NORMAL_CHECKED} /><span class="gen">{L_NORMAL}</span>&nbsp;&nbsp;
            <input type="radio" name="display_posting" value="0"{DISPLAY_POSTING_NONE_CHECKED} /><span class="gen">{L_NONE}</span>&nbsp;&nbsp;
            <input type="radio" name="display_posting" value="2"{DISPLAY_POSTING_ROOT_CHECKED} /><span class="gen">{L_ROOT}</span>
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_CODE_NAME}</span><br />
            <span class="gensmall">{L_CODE_NAME_EXPLAIN}</span>
        </td>
        <td class="row2">
            <input type="text" name="new_code_name" value="{CODE_NAME}" size="25" />
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_HANDLE_INPUT}</span><br />
            <span class="gensmall">{L_HANDLE_INPUT_EXPLAIN}</span>
        </td>
        <td class="row2">
            <input type="radio" name="handle_input" value="1"{HANDLE_INPUT_YES_CHECKED} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
            <input type="radio" name="handle_input" value="0"{HANDLE_INPUT_NO_CHECKED} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td class="row1">
            <span class="gen">{L_REGEXP}</span><br />
            <span class="gensmall">{L_REGEXP_EXPLAIN}</span>
        </td>
        <td class="row2">
			<input type="radio" name="regexp" value="none" {REGEXP_NONE_CHECKED} /><span class="gen">{L_NONE}</span>&nbsp;&nbsp;<br />
		
			<input type="radio" name="regexp" value="numbers" {REGEXP_NUMBERS_CHECKED} /><span class="gen">{L_NUMBERS}</span>&nbsp;&nbsp;<br />
			<input type="radio" name="regexp" value="letters" {REGEXP_LETTERS_CHECKED} /><span class="gen">{L_LETTERS}</span>&nbsp;&nbsp;<br />
			<input type="radio" name="regexp" value="custom" {REGEXP_CUSTOM_CHECKED} /><span class="gen">{L_CUSTOM}: <input type="text" name="regexp_custom" value="{REGEXP_CUSTOM}" /></span>&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td class="row1">
			<span class="gen">{L_MANDITORY}</span>
		</td>
		<td class="row2">
			<input type="radio" name="manditory" value="1" {MANDITORY_YES_CHECKED} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
			<input type="radio" name="manditory" value="0" {MANDITORY_NO_CHECKED} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
      <td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
    </tr>
</table>

{S_HIDDEN_FIELDS}

</form>