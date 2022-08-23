<h1>{L_FORUM_TITLE}</h1>

<p>{L_FORUM_EXPLAIN}</p>

<form method="post" action="{S_FORUM_ACTION}"><table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr>
        <th class="thHead" colspan="8">{L_FORUM_TITLE}</th>
    </tr>
    <!-- BEGIN catrow -->
    <tr>
        <td class="catLeft" colspan="4"><strong><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></strong></td>
        <td class="cat" align="center" valign="middle"><a href="{catrow.U_CAT_EDIT}">{L_EDIT}</a></td>
        <td class="cat" align="center" valign="middle"><a href="{catrow.U_CAT_DELETE}">{L_DELETE}</a></td>
        <td class="cat" align="center" valign="middle" nowrap="nowrap"><a href="{catrow.U_CAT_MOVE_UP}">{L_MOVE_UP}</a> <a href="{catrow.U_CAT_MOVE_DOWN}">{L_MOVE_DOWN}</a></td>
        <td class="catRight" align="center" valign="middle">&nbsp;</td>
    </tr>
    <!-- BEGIN forumrow -->
    <tr> 
		<td class="row1" align="center" valign="middle">{catrow.forumrow.FORUM_ICON_IMG}</td>
		<td class="row2">
		<span {catrow.forumrow.STYLE}>
			<a href="{catrow.forumrow.U_VIEWFORUM}" target="_new" {catrow.forumrow.FORUM_COLOR}>{catrow.forumrow.FORUM_NAME}</a>
		</span>
		<br />
		<span {catrow.forumrow.STYLE}>{catrow.forumrow.FORUM_DESC}</span>
		</td>
        <td class="row1" align="center" valign="middle">{catrow.forumrow.NUM_TOPICS}</td>
        <td class="row2" align="center" valign="middle">{catrow.forumrow.NUM_POSTS}</td>
        <td class="row1" align="center" valign="middle"><a href="{catrow.forumrow.U_FORUM_EDIT}">{L_EDIT}</a></td>
        <td class="row2" align="center" valign="middle"><a href="{catrow.forumrow.U_FORUM_DELETE}">{L_DELETE}</a></td>
        <td class="row1" align="center" valign="middle"><a href="{catrow.forumrow.U_FORUM_MOVE_UP}">{L_MOVE_UP}</a> <br /> <a href="{catrow.forumrow.U_FORUM_MOVE_DOWN}">{L_MOVE_DOWN}</a></span></td>
        <td class="row2" align="center" valign="middle"><a href="{catrow.forumrow.U_FORUM_RESYNC}">{L_RESYNC}</a></td>
    </tr>
    <!-- END forumrow -->
    <tr>
        <td colspan="8" class="row2"><input type="text" name="{catrow.S_ADD_FORUM_NAME}" /> <input type="submit" class="liteoption"  name="{catrow.S_ADD_FORUM_SUBMIT}" value="{L_CREATE_FORUM}" /></td>
    </tr>
    <tr>
        <td colspan="8" height="1" class="spaceRow"><img src="../templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
    <!-- END catrow -->
    <tr>
        <td colspan="8" class="catBottom"><input type="text" name="categoryname" /> <input type="submit" class="liteoption"  name="addcategory" value="{L_CREATE_CATEGORY}" /></td>
    </tr>
</table></form>