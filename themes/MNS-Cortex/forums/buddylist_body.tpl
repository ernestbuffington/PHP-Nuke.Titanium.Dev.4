
<script language="Javascript" type="text/javascript">
//
// Should really check the browser to stop this whining ...
//
function select_switch(status) {
	for (i = 0; i<document.post.length; i++) {
		document.post.elements[i].checked = status;
		}
	}
</script>

<table width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
  <tr>
	<td align="left" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_BUDDYLIST}" class="nav">{L_BUDDYLIST}</a></span></td>
        <td align="right" nowrap><span class="nav"><a href="{U_BUDDY_WHO_ME}" class="nav">{L_BUDDY_WHO_ME}</a></span></td>
  </tr>
</table>

<form method="post" name="post" action="{S_BUDDYLIST_ACTION}">
  <table border="0" cellspacing="1" cellpadding="3" width="100%" class="forumline">
	<tr>
	  <th colspan="4" align="center" class="thTop" nowrap="nowrap">{L_ONLINE}</th>
	</tr>
	<tr>
	  <td width="30%" class="catLeft" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_BUDDY}&nbsp;</span></b></td>
	  <td width="30%" class="cat" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_PM}&nbsp;</span></b></td>
	  <td width="30%" class="cat" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_EMAIL}&nbsp;</span></b></td>
	  <td width="10%" class="catRight" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_MARK}&nbsp;</span></b></td>
	</tr>
	<!-- BEGIN listrow_online -->
	<tr>
	  <td width="30%" valign="middle" align="center" class="{listrow_online.ROW_CLASS}"><span class="name">{listrow_online.BUDDY_URL}</span></td>
	  <td width="30%" align="center" valign="middle" class="{listrow_online.ROW_CLASS}"><span class="postdetails">{listrow_online.PM_IMG}</span></td>
	  <td width="30%" align="center" valign="middle" class="{listrow_online.ROW_CLASS}"><span class="postdetails">{listrow_online.EMAIL_IMG}</span></td>
	  <td width="10%" align="center" valign="middle" class="{listrow_online.ROW_CLASS}"><span class="postdetails"><input type="checkbox" name="mark[]" value="{listrow_online.S_MARK_ID}" /></span></td>
	</tr>
	<!-- END listrow_online -->
	<!-- BEGIN switch_no_buddies_online -->
	<tr>
	  <td class="row1" colspan="4" height="25" align="center" valign="middle"><span class="gen">{L_NO_BUDDIES_ONLINE}</span></td>
	</tr>
	<!-- END switch_no_buddies_online -->
	<tr>
	  <td class="catBottom" colspan="4" height="28">&nbsp;</td>
	</tr>
	<tr>
	  <th colspan="4" align="center" class="thTop" nowrap="nowrap">{L_OFFLINE}</th>
	</tr>
	<tr>
	  <td width="30%" class="catLeft" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_BUDDY}&nbsp;</span></b></td>
	  <td width="30%" class="cat" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_PM}&nbsp;</span></b></td>
	  <td width="30%" class="cat" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_EMAIL}&nbsp;</span></b></td>
	  <td width="10%" class="catRight" nowrap="nowrap"><b><span class="genmed">&nbsp;{L_MARK}&nbsp;</span></b></td>
	</tr>
	<!-- BEGIN listrow_offline -->
	<tr>
	  <td width="30%" valign="middle" align="center" class="{listrow_offline.ROW_CLASS}"><span class="name">{listrow_offline.BUDDY_URL}</span></td>
	  <td width="30%" align="center" valign="middle" class="{listrow_offline.ROW_CLASS}"><span class="postdetails">{listrow_offline.PM_IMG}</span></td>
	  <td width="30%" align="center" valign="middle" class="{listrow_offline.ROW_CLASS}"><span class="postdetails">{listrow_offline.EMAIL_IMG}</span></td>
	  <td width="10%" align="center" valign="middle" class="{listrow_offline.ROW_CLASS}"><span class="postdetails"><input type="checkbox" name="mark[]" value="{listrow_offline.S_MARK_ID}" /></span></td>
	</tr>
	<!-- END listrow_offline -->
	<!-- BEGIN switch_no_buddies_offline -->
	<tr>
	  <td class="row1" colspan="4" height="25" align="center" valign="middle"><span class="gen">{L_NO_BUDDIES_OFFLINE}</span></td>
	</tr>
	<!-- END switch_no_buddies_offline -->
	<tr>
	  <td class="catBottom" colspan="4" height="28" align="right"> {S_HIDDEN_FIELDS}
		<input type="submit" name="remove" value="{L_REMOVE_MARKED}" class="liteoption" />
		&nbsp;
		<input type="submit" name="removeall" value="{L_REMOVE_ALL}" class="liteoption" />
	  </td>
	</tr>
  </table>

  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
	  <td align="left" valign="middle" width="100%"><span class="genmed"><input type="text" class="post" name="username" maxlength="50" size="20" />&nbsp;<input type="submit" name="add" value="{L_ADD_MEMBER}" class="mainoption" />&nbsp;<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></span></td>
	  <td align="right" valign="top" nowrap="nowrap"><b><span class="gensmall"><a href="javascript:select_switch(true);" class="gensmall">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);" class="gensmall">{L_UNMARK_ALL}</a></span></b><br /><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
  </table>
</form>

<table width="100%" border="0">
  <tr>
	<td align="right" valign="top">{JUMPBOX}</td>
  </tr>
</table>
