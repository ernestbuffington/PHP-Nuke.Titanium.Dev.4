<form action="{S_PROFILE_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
</table>
<div class="forum-wrap">
		<div class="fw-pos-1">
			<div class="fw-pos-1-inner"></div>
		</div>
		<div class="fw-pos-2">
			<div class="fw-pos-2-inner clearfix">
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
    <tr> 
      <th class="thHead" colspan="{S_COLSPAN}" height="25" valign="middle" style="padding: 30px 0px 10px 0px;">{L_AVATAR_GALLERY}</th>
    </tr>
    <tr> 
      <td class="catBottom" align="center" valign="middle" colspan="6" height="28" style="padding: 10px 0px 10px 0px;"><span class="genmed">{L_CATEGORY}:&nbsp;{S_CATEGORY_SELECT}&nbsp;<input type="submit" class="liteoption" value="{L_GO}" name="avatargallery" /></span></td>
    </tr>
    <!-- BEGIN avatar_row -->
    <tr> 
    <!-- BEGIN avatar_column -->
        <td class="row1" align="center" style="padding: 12px 0px 10px 0px;"><img src="{avatar_row.avatar_column.AVATAR_IMAGE}" alt="{avatar_row.avatar_column.AVATAR_NAME}" title="{avatar_row.avatar_column.AVATAR_NAME}" /></td>
    <!-- END avatar_column -->
    </tr>
    <tr>
    <!-- BEGIN avatar_option_column -->
        <td class="row2" align="center" style="padding: 12px 0px 10px 0px;"><input type="checkbox" name="avatarselect" value="{avatar_row.avatar_option_column.S_OPTIONS_AVATAR}" /></td>
    <!-- END avatar_option_column -->
    </tr>

    <!-- END avatar_row -->
    <tr> 
      <td class="catBottom" colspan="{S_COLSPAN}" align="center" height="28">{S_HIDDEN_FIELDS} 
        <input type="submit" name="submitavatar" value="{L_SELECT_AVATAR}" class="mainoption" />
        &nbsp;&nbsp; 
        <input type="submit" name="cancelavatar" value="{L_RETURN_PROFILE}" class="liteoption" />
      </td>
    </tr>
  </table>
</form>
</div>
		</div>
		<div class="fw-pos-3">
			<div class="fw-pos-3-inner"></div>
		</div>
	</div>