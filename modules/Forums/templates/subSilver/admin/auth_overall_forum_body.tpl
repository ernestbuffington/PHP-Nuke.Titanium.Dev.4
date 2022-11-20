<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script src="../templates/subSilver/images/auth_overall_forum/overlib.js"></script>
<script src="../templates/subSilver/images/auth_overall_forum/admin_overall_forumauth.js"></script>
<h1>{L_FORUM_TITLE}</h1>

<p>{L_FORUM_EXPLAIN}</p>

<form method="post" action="{S_FORUM_ACTION}"><table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
		<th class="thHead" colspan="14">{L_FORUM_TITLE}</th>
	</tr>
	<tr>
	  <td class="row1" align="center" valign="middle" colspan="14">
	  		<table width="50%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
				<tr>
					<td class="row1">
						<!-- BEGIN authedit -->
						<a href="javascript:void(0);" onClick="return start_edit('{authedit.VALUE}', '{authedit.NAME}');" class="gen"><img src="../templates/subSilver/images/auth_overall_forum/{authedit.NAME}.gif">&nbsp;{authedit.NAME}</a><br />
						<!-- END authedit -->
					</td><td class="row2">
						<a href="javascript:void(0);" onClick="return start_restore();" class="gen">{L_FORUM_OVERALL_RESTORE}</a><br /><br />
						<a href="javascript:void(0);" onClick="return stop_edit();" class="gen">{L_FORUM_OVERALL_STOP}</a>
					</td>
				</tr>
				<tr>
					<td class="row3" colspan="2"><span class="gensmall">{L_FORUM_EXPLAIN_EDIT}</span></td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- BEGIN catrow -->
	<tr>
		<td class="catLeft" width="100%"><span class="cattitle"><b><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></b></span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">View</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Read</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Post</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Reply</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Edit</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Del</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Sticky</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Ann</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Global</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Vote</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Poll </span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Attach</span></td>
		<td class="cat" align="center" valign="middle"><span class="gen">Download</span></td>
	</tr>
	<!-- BEGIN forumrow -->
	<tr> 
		<td class="row1"><span class="gen">{catrow.forumrow.FORUM_NAME}</span></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_VIEW_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_VIEW_IMG}',{catrow.forumrow.FORUM_ID},'VIEW');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_VIEW" name="auth[{catrow.forumrow.FORUM_ID}][VIEW]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_READ_IMG}.gif"  onClick="return change_auth(this,'{catrow.forumrow.AUTH_READ_IMG}',{catrow.forumrow.FORUM_ID},'READ');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_READ" name="auth[{catrow.forumrow.FORUM_ID}][READ]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_POST_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_POST_IMG}',{catrow.forumrow.FORUM_ID},'POST');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_POST" name="auth[{catrow.forumrow.FORUM_ID}][POST]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_REPLY_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_REPLY_IMG}',{catrow.forumrow.FORUM_ID},'REPLY');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_REPLY" name="auth[{catrow.forumrow.FORUM_ID}][REPLY]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_EDIT_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_EDIT_IMG}',{catrow.forumrow.FORUM_ID},'EDIT');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_EDIT" name="auth[{catrow.forumrow.FORUM_ID}][EDIT]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_DELETE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_DELETE_IMG}',{catrow.forumrow.FORUM_ID},'DELETE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_DELETE" name="auth[{catrow.forumrow.FORUM_ID}][DELETE]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_STICKY_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_STICKY_IMG}',{catrow.forumrow.FORUM_ID},'STICKY');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_STICKY" name="auth[{catrow.forumrow.FORUM_ID}][STICKY]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_ANNOUNCE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_ANNOUNCE_IMG}',{catrow.forumrow.FORUM_ID},'ANNOUNCE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_ANNOUNCE" name="auth[{catrow.forumrow.FORUM_ID}][ANNOUNCE]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_ANNOUNCE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_ANNOUNCE_IMG}',{catrow.forumrow.FORUM_ID},'GLOBALANNOUNCE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_GLOBALANNOUNCE" name="auth[{catrow.forumrow.FORUM_ID}][GLOBALANNOUNCE]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_VOTE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_VOTE_IMG}',{catrow.forumrow.FORUM_ID},'VOTE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_VOTE" name="auth[{catrow.forumrow.FORUM_ID}][VOTE]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_POLLCREATE_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_POLLCREATE_IMG}',{catrow.forumrow.FORUM_ID},'POLLCREATE');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_POLLCREATE" name="auth[{catrow.forumrow.FORUM_ID}][POLLCREATE]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_ATTACHMENTS_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_ATTACHMENTS_IMG}',{catrow.forumrow.FORUM_ID},'ATTACHMENTS');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_ATTACHMENTS" name="auth[{catrow.forumrow.FORUM_ID}][ATTACHMENTS]"></td>
		<td class="row2"><img src="../templates/subSilver/images/auth_overall_forum/{catrow.forumrow.AUTH_DOWNLOAD_IMG}.gif" onClick="return change_auth(this,'{catrow.forumrow.AUTH_DOWNLOAD_IMG}',{catrow.forumrow.FORUM_ID},'DOWNLOAD');"><input type="hidden" id="auth_{catrow.forumrow.FORUM_ID}_DOWNLOAD" name="auth[{catrow.forumrow.FORUM_ID}][DOWNLOAD]"></td>
	</tr>
	<!-- END forumrow -->
	<!-- END catrow -->
	<tr>
		<td colspan="14" class="catBottom" align="center"><input type="submit" class="liteoption" name="submit" value="{L_SUBMIT}" /></td>
	</tr>
</table></form>
