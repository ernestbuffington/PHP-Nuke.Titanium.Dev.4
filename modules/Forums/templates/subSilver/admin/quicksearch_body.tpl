<h1>{L_SEARCHS_TITLE}</h1>

<p class="gen">{L_SEARCHS_TEXT}</p>

<form method="post" action="{S_SEARCHS_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
    <tr>
        <th class="thCornerL">{L_SEARCH_NAME}</th>
        <th class="thTop">{L_EDIT}</th>
        <th class="thCornerR">{L_DELETE}</th>
    </tr>
    <!-- BEGIN addsearch -->
    <tr>
        <td class="{addsearch.ROW_CLASS}" align="center"><span class="gen">{addsearch.SEARCH_NAME}</span></td>
        <td class="{addsearch.ROW_CLASS}" align="center"><span class="gen"><a href="{addsearch.U_SEARCH_EDIT}">{L_EDIT}</a></span></td>
        <td class="{addsearch.ROW_CLASS}" align="center"><span class="gen"><a href="{addsearch.U_SEARCH_DELETE}">{L_DELETE}</a></span></td>
    </tr>
    <!-- END addsearch -->            
    <tr>
        <td class="catBottom" align="center" colspan="6"><input type="submit" class="mainoption" name="add" value="{L_ADD_SEARCH}" /></td>
    </tr>
</table></form>