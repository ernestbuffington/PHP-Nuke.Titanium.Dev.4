
<form method="post" action="{S_MODE_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	  <td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;{L_FORUM}&nbsp;{S_FORUM_SELECT}&nbsp;&nbsp;
		<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
		</span></td>
	</tr>
  </table>

  {ERROR_BOX}
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr> 
	  <th height="25" class="thCornerL" nowrap="nowrap">#</th>
	  <th class="thTop" nowrap="nowrap">{L_FILENAME}</th>
	  <th class="thTop" nowrap="nowrap">{L_FILECOMMENT}</th>
	  <th class="thTop" nowrap="nowrap">{L_SIZE}</th>
	  <th class="thTop" nowrap="nowrap">{L_DOWNLOADS}</th>
	  <th class="thTop" nowrap="nowrap">{L_POST_TIME}</th>
	  <th class="thCornerR" nowrap="nowrap">{L_POSTED_IN_TOPIC}</th>
	</tr>

   <!-- BEGIN attachrow --> 
   <tr> 
	<td class="{attachrow.ROW_CLASS}" align="center"><span class="gen">&nbsp;{attachrow.ROW_NUMBER}&nbsp;</span></td>
	<td class="{attachrow.ROW_CLASS}" align="center"><span class="gen">{attachrow.VIEW_ATTACHMENT}</span></td> 
	<td class="{attachrow.ROW_CLASS}" align="center"><span class="gen"><b>{attachrow.COMMENT}</b></span></td> 
	<td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gen"><b>{attachrow.SIZE}</b></span></td> 
	<td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gen"><b>{attachrow.DOWNLOAD_COUNT}</b></span></td> 
	<td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{attachrow.POST_TIME}</span></td> 
	<td class="{attachrow.ROW_CLASS}" align="center" valign="middle"><span class="gen">{attachrow.POST_TITLE}</span></td> 
   </tr> 
	<!-- END attachrow --> 
	<tr> 
	  <td class="catbottom" colspan="8" height="28">&nbsp;</td>
	</tr>
  </table>
  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	  <td align="right" valign="top"></td>
	</tr>
  </table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
	<td><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>

</form>