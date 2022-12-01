<form method="post" action="{S_MODE_ACTION}" name="post">
<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
  <tr>
    <td class="catHead">
      <table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
        <tr>
          <td class="row1" style="text-align: center; width: 33.3%;">{L_SELECT_SORT_METHOD}&nbsp;{S_MODE_SELECT}&nbsp;{S_ORDER_SELECT}&nbsp;<input type="submit" name="submit" value="{L_GO}" style="cursor: pointer;" class="liteoption" /></td>
          <td class="catHead" style="text-align: center; width: 33.3%;">{L_PAGE_TITLE}</td>
          <td class="row1" style="width: 33.3%;">
          <span>
            <span class="tooltip icon-sprite icon-info" style="float: left; margin-top: 2px;" title="{U_SEARCH_EXPLAIN}"></span><input type="text" class="post" name="username" maxlength="25" size="20" tabindex="1" value="" />&nbsp;<input type="submit" name="submituser" value="{L_LOOK_UP}" style="cursor: pointer;" class="mainoption" /></td>
          </span>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" style="width: 100%;">
      <table style="width:100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">
        <tr>
          <!-- BEGIN alphanumsearch -->
          <td class="row3" style="text-align: center; width: {alphanumsearch.SEARCH_SIZE};"><a href="{alphanumsearch.SEARCH_LINK}">{alphanumsearch.SEARCH_TERM}</a></td>
          <!-- END alphanumsearch -->
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row3" style="width: 100%;">
      <table style="width:100%;" border="0" cellpadding="0" cellspacing="0" class="forumline">
        <tr>
          <td valign="top">
            <table style="width:100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">
              <tr>
                <td class="catHead acenter" style="width: 5%;">#</td>
                <td class="catHead acenter" style="width: 25%;">{L_USERNAME}</td>
                <td class="catHead acenter" style="width: 25%;">{L_FROM}</td>
                <td class="catHead acenter" style="width: 5%;">{L_AGE}</td>                
                <td class="catHead acenter" style="width: 10%;">{L_POSTS}</td>
                <td class="catHead acenter" style="width: 10%;">{L_JOINED}</td>
                <td class="catHead acenter" style="width: 10%;">{L_LAST_VISIT}</td>
                <td class="catHead acenter" style="width: 10%;">{L_ONLINE_STATUS}</td>
              </tr>
              <!-- BEGIN no_username -->
              <tr> 
                <td class="row1" colspan="8" style="text-align: center; text-transform: uppercase;">{no_username.NO_USER_ID_SPECIFIED}</td>
              </tr>
              <!-- END no_username -->
              <!-- BEGIN memberrow -->
              <tr>
                <td class="{memberrow.ROW_CLASS} acenter">{memberrow.ROW_NUMBER}</td>
                <td class="{memberrow.ROW_CLASS}">
                  <span style="float: left; margin: 2px;"><a href="{memberrow.U_VIEWPROFILE}">{memberrow.USERNAME}</a></span>
                  <span style="float: right;">{memberrow.GENDER}{memberrow.WWW}{memberrow.FACEBOOK}{memberrow.PM}</span>
                </td>
                <td class="{memberrow.ROW_CLASS}">{memberrow.FLAG}{memberrow.FROM}</td>
                <td class="{memberrow.ROW_CLASS} acenter">{memberrow.AGE}</td>                
                <td class="{memberrow.ROW_CLASS} acenter">{memberrow.POSTS}</td>
                <td class="{memberrow.ROW_CLASS} acenter">{memberrow.JOINED}</td>
                <td class="{memberrow.ROW_CLASS} acenter">{memberrow.LAST_ACTIVE}</td>
                <td class="{memberrow.ROW_CLASS} acenter">{memberrow.STATUS}</td>
              </tr>
              <!-- END memberrow -->
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>       
    <td class="catBottom" style="font-size: 13px; text-align: right;"><!-- BEGIN pagination --> <!-- IF pagination.TOTAL < pagination.PERPAGE --><!-- ELSE -->{pagination.PAGINATION}<!-- ENDIF --><!-- END pagination --></td>      
  </tr>
</table>
</form>