<!-- BEGIN user_row -->
<script>
  nuke_jq(function($)
  {
  	// var user_id = '{user_row.USER_ID}';
  	$('#user{user_row.USER_ID}').click(function() 
  	{
    	$('.user{user_row.USER_ID}').toggle();
    });

  	$('toggle_button').click(function() 
  	{
    	$('.toogleme').toggle();
	});

  });
</script>
<!-- END user_row -->
<form action="{S_ACTION}" method="post">
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
    <td class="catHead" colspan="8" style="height: 35px; text-align: center; text-transform: uppercase;">{L_TITLE}</td>
  </tr>
  <tr>
    <td class="row1" colspan="8" style="width: 100%;">
      <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
        <tr>
          <td class="row1" style="width: 100%;">{L_DESCRIPTION}</td>
          <td class="row1" align="right" nowrap="nowrap">{L_FILTER}</td>
          <td class="row1" nowrap="nowrap"><input type="text" size="20" value="{S_FILTER}" name="filter"></td>
          <td class="row1" nowrap="nowrap">
            <select name="find_by" class="post">
              <option value="find_username"{SELECTED_FIND_USERNAME}>{L_SORT_USERNAME}</option>
              <option value="find_user_email"{SELECTED_FIND_EMAIL}>{L_SORT_EMAIL}</option>
              <option value="find_user_website"{SELECTED_FIND_WEBSITE}>{L_SORT_WEBSITE}</option>
		    </select>
		  </td>
          <td class="row1" align="right" nowrap="nowrap">{L_SORT_BY}</td>
          <td class="row1" nowrap="nowrap">
            <select name="sort" class="post">
              <option value="user_id"{SELECTED_USER_ID}>{L_SORT_USER_ID}</option>
              <option value="user_active"{SELECTED_ACTIVE}>{L_SORT_ACTIVE}</option>
              <option value="username"{SELECTED_USERNAME}>{L_SORT_USERNAME}</option>
              <option value="user_regdate"{SELECTED_JOINED}>{L_SORT_JOINED}</option>
              <option value="user_session_time"{SELECTED_ACTIVTY}>{L_SORT_ACTIVTY}</option>
              <option value="user_level"{SELECTED_USER_LEVEL}>{L_SORT_USER_LEVEL}</option>
              <option value="user_posts"{SELECTED_POSTS}>{L_SORT_POSTS}</option>
              <option value="user_rank"{SELECTED_RANK}>{L_SORT_RANK}</option>
              <option value="user_email"{SELECTED_EMAIL}>{L_SORT_EMAIL}</option>
              <option value="user_website"{SELECTED_WEBSITE}>{L_SORT_WEBSITE}</option>
		    </select>
		  </td>
          <td class="row1" nowrap="nowrap">
            <select name="order" class="post">
              <option value="ASC"{SELECTED_ASCENDING}>{L_ASCENDING}</option>
              <option value="DESC"{SELECTED_DESCENDING}>{L_DESCENDING}</option>
            </select>
          </td>
          <td class="row1" nowrap="nowrap">{L_SHOW}</td>
          <td class="row1" nowrap="nowrap"><input type="text" size="5" value="{S_SHOW}" name="show"></td>
          <td class="row1" nowrap="nowrap">{S_HIDDEN_FIELDS}<input type="submit" value="{S_SORT}" name="change_sort" class="liteoption"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="catHead" colspan="8" style="height: 35px; text-align: center; text-transform: uppercase;">&nbsp;</td>
  </tr>
  <tr>
    <td class="row1" colspan="8">
      <table style="width: 100%;" cellpadding="4" cellspacing="1" border="0" class="forumline">  
        <tr>
          <!-- BEGIN alphanumsearch -->
          <td class="catHead" style="height: 35px; text-align: center; width: {alphanumsearch.SEARCH_SIZE};"><a href="{alphanumsearch.SEARCH_LINK}" class="genmed">{alphanumsearch.SEARCH_TERM}</a></td>
          <!-- END alphanumsearch -->
        </tr>
      </table>
    </td>    
  </tr> 
  <tr>
    <td class="catHead" colspan="2" style="height: 35px; text-align: center; width: 13%;">&nbsp;</td>
    <td class="catHead" style="height: 35px; text-align: center; width: 25%;">{L_USERNAME}</td>
    <td class="catHead" style="height: 35px; text-align: center; width: 6%;">{L_ACTIVE}</td>
    <td class="catHead" style="height: 35px; text-align: center; width: 15%;">{L_JOINED}</td>
    <td class="catHead" style="height: 35px; text-align: center; width: 15%;">{L_ACTIVTY}</td>
    <td class="catHead" style="height: 35px; text-align: center; width: 6%;">{L_POSTS}</td>
    <td class="catHead" style="height: 35px; text-align: center; width: 20%;">{L_WEBSITE}</td>
  </tr>
  <!-- BEGIN user_row -->
  <tr>
    <td class="row1" style="height: 35px; text-align: center;"><input type="checkbox" name="{S_USER_VARIABLE}[]" value="{user_row.USER_ID}"></td>
    <td class="row1" style="height: 35px; text-align: center;"><a href="javascript:void(0);" id="user{user_row.USER_ID}">{L_OPEN_CLOSE}</a></td>
    <td class="row1" style="height: 35px;"><a href="{user_row.U_PROFILE}" target="_blank" {user_row.STYLE_COLOR}>{user_row.USERNAME}</a></td>
    <td class="row1" style="height: 35px; text-align: center;">{user_row.ACTIVE}</td>
    <td class="row1" style="height: 35px;">{user_row.JOINED}</td>
    <td class="row1" style="height: 35px;">{user_row.LAST_ACTIVITY}</td>
    <td class="row1" style="height: 35px; text-align: center;">{user_row.POSTS}</td>
    <td class="row1" style="height: 35px;">{user_row.U_WEBSITE}</td>
  </tr>

  <tr class="user{user_row.USER_ID} toogleme" style="display: none;">
    <!-- <td class="{user_row.ROW_CLASS}" colspan="1">&nbsp;</td> -->
    <td class="{user_row.ROW_CLASS}" colspan="8">
      <table style="width: 100%;" cellpadding="4" cellspacing="1" border="0" class="forumline">
        <tr>
          <td class="{user_row.ROW_CLASS}" style="height: 35px; width: 33.3%;"><span style="font-weight: bold;">{L_RANK}:</span> {user_row.RANK} &nbsp; {user_row.I_RANK}</td>
          <td class="{user_row.ROW_CLASS}" style="height: 35px; width: 33.3%;"><span style="font-weight: bold;">{L_GROUP}:</span>
            <!-- BEGIN group_row -->
              <a href="{user_row.group_row.U_GROUP}" class="gen" target="_blank">{user_row.group_row.GROUP_NAME}</a> ({user_row.group_row.GROUP_STATUS})<br />
            <!-- END group_row -->
            <!-- BEGIN no_group_row -->
              {user_row.no_group_row.L_NONE}<br />
            <!-- END no_group_row -->
          </td>
          <td class="{user_row.ROW_CLASS}" style="height: 35px; width: 33.3%;"><span style="font-weight: bold;">{L_POSTS}:</span> {user_row.POSTS} &nbsp; <a href="{user_row.U_SEARCH}" target="_blank">{L_FIND_ALL_POSTS}</a></span></td>
        </tr>
        <tr>
          <td class="{user_row.ROW_CLASS}" colspan="3" style="height: 35px;"><span style="font-weight: bold;">{L_WEBSITE}:</span> <a href="{user_row.U_WEBSITE}" target="_blank">{user_row.U_WEBSITE}</a></span></td>
        </tr>
        <tr>
          <td class="{user_row.ROW_CLASS}"><a href="{user_row.U_MANAGE}">{L_MANAGE}</a><br /><a href="{user_row.U_PERMISSIONS}">{L_PERMISSIONS}</a><br /><a href="mailto:{user_row.EMAIL}">{L_EMAIL} [ {user_row.EMAIL} ]</a><br /><a href="{user_row.U_PM}">{L_PM}</a></td>
          <td colspan="2" class="{user_row.ROW_CLASS}">{user_row.I_AVATAR}</td>
        </tr>
      </table>
    </td>
  </tr>
  <!-- END user_row -->
  <tr>
    <td class="catbottom" colspan="5">
      <select name="mode" class="post">
        <option value="">{L_SELECT}</option>
        <option value="delete">{L_DELETE}</option>
        <option value="ban">{L_BAN}</option>
        <option value="activate">{L_ACTIVATE_DEACTIVATE}</option>
        <option value="group">{L_ADD_GROUP}</option>
      </select>
      <input type="submit" name="go" value="{L_GO}" class="mainoption">
    </td>
    <td class="catbottom" colspan="1" style="text-align: center;">{PAGE_NUMBER}</td>
    <td class="catbottom" colspan="2" style="text-align: right;">{PAGINATION}</td>
  </tr>
</table>

<!-- <table width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<td align="left" width="50%"><span class="gen">{PAGE_NUMBER}</span></td>
		<td align="right" width="50%"><span class="gen">{PAGINATION}</span></td>
	</tr>
</table> -->
</form>

<br clear="all" />
