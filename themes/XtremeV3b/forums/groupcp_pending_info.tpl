<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
    <tr> 
      <th class="thCornerL" height="25">{L_PM}</th>
      <th class="thTop">{L_USERNAME}</th>
      <th class="thTop">{L_POSTS}</th>
      <th class="thTop">{L_FROM}</th>
      <th class="thTop">{L_EMAIL}</th>
      <th class="thTop">{L_ONLINE_STATUS}</th>
      <th class="thTop">{L_WEBSITE}</th>
      <th class="thCornerR">{L_SELECT}</th>
    </tr>
    <tr> 
      <td class="catSides" colspan="9" height="28"><span class="cattitle">{L_PENDING_MEMBERS}</span></td>
    </tr>
    <!-- BEGIN pending_members_row -->
    <tr> 
      <td class="{pending_members_row.ROW_CLASS}" align="center"> {pending_members_row.PM_IMG} 
      </td>
      <td class="{pending_members_row.ROW_CLASS}" align="left"><span class="gen">{pending_members_row.CURRENT_AVATAR} <a href="{pending_members_row.U_VIEWPROFILE}" class="gen">{pending_members_row.USERNAME}</a></span></td>
      <td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.POSTS}</span></td>
      <td class="{pending_members_row.ROW_CLASS}" align="center" valign="middle">
        <table border="0">
          <tr>
            <td align="left"><span class="gen">{pending_members_row.FROM}</span></td>
          </tr>
        </table>
      </td>
      <td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.EMAIL_IMG}</span></td>
      <td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.ONLINE_STATUS}</span></td>
      <td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gen">{pending_members_row.WWW_IMG}</span></td>
      <td class="{pending_members_row.ROW_CLASS}" align="center"><span class="gensmall"> <input type="checkbox" name="pending_members[]" value="{pending_members_row.USER_ID}" /></span></td>
    </tr>
    <!-- END pending_members_row -->
    <tr> 
      <td class="cat" colspan="9" align="right"><span class="cattitle"> 
        <input type="submit" name="approve" value="{L_APPROVE_SELECTED}" class="btn-hover-one" />
        &nbsp; 
        <input type="submit" name="deny" value="{L_DENY_SELECTED}" class="btn-hover-one" />
        </span></td>
    </tr>
</table>