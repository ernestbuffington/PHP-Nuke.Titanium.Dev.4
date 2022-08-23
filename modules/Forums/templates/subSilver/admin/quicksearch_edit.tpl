<h1>{L_SEARCHS_TITLE}</h1>

<p class="gen">{L_SEARCHS_TEXT}</p>

<form action="{S_SEARCH_ACTION}" method="post"><table class="forumline" cellpadding="4" cellspacing="1" border="0" align="center" width="100%">
    <tr>
        <th class="thTop" colspan="2">{SEARCH_NMAE}</th>
    </tr>
    <tr>
        <td class="row1" width="50%"><span class="gen">{L_SEARCH_NMAE}</span><br /><span class="gensmall">{L_SEARCH_NMAE_EXPLAIN}</span></td>
        <td class="row2"><input class="post" type="text" name="search_name" size="55" maxlength="255" value="{SEARCH_NMAE}" /></td>
    </tr>
    <tr>
        <td class="row1" colspan="2"><span class="gen">{L_SEARCH_URL}</span><br /><span class="gensmall">{L_SEARCH_URL_EXPLAIN}</span></td>
    </tr>
    <tr>
        <td class="row1"><input class="post" type="text" name="search_url1" size="55" maxlength="255" value="{SEARCH_URL1}" /></td>
        <td class="row2"><input class="post" type="text" name="search_url2" size="55" maxlength="255" value="{SEARCH_URL2}" /></td>
    </tr>
    <tr>
        <td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
    </tr>
</table>
{S_HIDDEN_FIELDS}</form>