<h1>{L_AUTH_TITLE}</h1>

<h2>{L_USERNAME}: {USERNAME}</h2>

<form method="post" action="{S_AUTH_ACTION}">

<p>{L_AUTH_EXPLAIN}</p>

<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
    <tr>
        <th width="30%" class="thCornerL">{L_FIELD_NAME}</th>
        <th class="thTop">{L_ALLOW}</th>
        <th class="thTop">{L_DEFAULT}</th>
        <th class="thCornerR">{L_DENY}</th>
    </tr>
    <!-- BEGIN xdata -->
    <tr>
        <td class="row3" align="center">{xdata.NAME}</td>
        <td class="row1" align="center">
            <input name="xd_{xdata.CODE_NAME}" value="{AUTH_ALLOW}" type="radio" {xdata.ALLOW_CHECKED}/>
        </td>
        <td class="row2" align="center">
            <input name="xd_{xdata.CODE_NAME}" value="{AUTH_DEFAULT}" type="radio" {xdata.DEFAULT_CHECKED}/>
        </td>
        <td class="row3" align="center">
            <input name="xd_{xdata.CODE_NAME}" value="{AUTH_DENY}" type="radio" {xdata.DENY_CHECKED}/>
        </td>
    </tr>
    <!-- END xdata -->
    <tr>
        <td colspan="4" class="catBottom" align="center">{S_HIDDEN_FIELDS}
            <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
            &nbsp;&nbsp;
            <input type="reset" value="{L_RESET}" class="liteoption" name="reset" />
        </td>
    </tr>
</table>
</form>