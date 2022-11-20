<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
  <tr> 
    <th class="thHead" colspan="2" height="25" nowrap="nowrap">{L_VIEWING_PROFILE}</th>
  </tr>
  <tr> 
    <td class="catLeft" width="40%" height="28" align="center"><strong><span class="gen">{L_AVATAR}</span></strong></td>
    <td class="catRight" width="60%"><strong><span class="gen">{L_ABOUT_USER}</span></strong>
    <!-- BEGIN switch_user_admin -->
    <span class="gen">&nbsp;(<a target="_admin" href="{U_ADMIN_PROFILE}" class="gen">{L_USER_ADMIN_FOR} {USERNAME}</a>)</span>
    <!-- END switch_user_admin -->
    </td>
  </tr>
  <tr> 
    <td class="row1" height="6" valign="top" align="center">{AVATAR_IMG}<br /><span class="postdetails">{POSTER_RANK}</span></td>
    <td class="row1" rowspan="3" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_JOINED}:&nbsp;</span></td>
          <td width="100%"><strong><span class="gen">{JOINED}</span></strong></td>
        </tr>
        <tr> 
          <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_TOTAL_POSTS}:&nbsp;</span></td>
          <td valign="top"><strong><span class="gen">{POSTS}</span></strong><br /><span class="genmed">[{POST_PERCENT_STATS} / {POST_DAY_STATS}]</span> <br /><span class="genmed"><a href="{U_SEARCH_USER}" class="genmed">{L_SEARCH_USER_POSTS}</a></span></td>
        </tr>
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_LOCATION}:&nbsp;</span></td>
          <td><strong><span class="gen">{LOCATION}</span></strong></td>
        </tr>
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_WEBSITE}:&nbsp;</span></td>
          <td><span class="gen"><strong>{WWW}</strong></span></td>
        </tr>
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_OCCUPATION}:&nbsp;</span></td>
          <td><strong><span class="gen">{OCCUPATION}</span></strong></td>
        </tr>
        <tr> 
          <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_INTERESTS}:</span></td>
          <td> <strong><span class="gen">{INTERESTS}</span></strong></td>
        </tr>
<!--BEGIN Arcade 3.0.2-->        
      <tr>
        <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_ARCADE}:</span></td>
        <td><strong><span class="gen">{URL_STATS}</span></strong></td>
      </tr>
<!-- END Arcade 3.0.2 -->              
<!-- BEGIN switch_admin_notes -->
		<tr>
		  <td valign="top" align="right" nowrap="nowrap"><span class="gen"><b>{L_ADMIN_NOTES}:</b></span></td>
		  <td> <span class="gen">{ADMIN_NOTES}</span></td>
		</tr>
<!-- END switch_admin_notes -->        
<!-- BEGIN xdata -->
<tr>
  <td valign="top" align="right" nowrap="nowrap"><span class="gen">{xdata.NAME}:</span></td>
  <td> <strong><span class="gen">{xdata.VALUE}</span></strong></td>
</tr>
<!-- END xdata -->        
<!-- BEGIN switch_upload_limits -->
        <tr> 
            <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_UPLOAD_QUOTA}:</span></td>
            <td> 
                <table width="175" cellspacing="1" cellpadding="2" border="0" class="bodyline">
                <tr> 
                    <td colspan="3" width="100%" class="row2">
                        <table cellspacing="0" cellpadding="1" border="0">
                        <tr> 
                            <td bgcolor="{T_TD_COLOR2}"><img src="templates/subSilver/images/spacer.gif" width="{UPLOAD_LIMIT_IMG_WIDTH}" height="8" alt="{UPLOAD_LIMIT_PERCENT}" /></td>
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr> 
                    <td width="33%" class="row1"><span class="gensmall">0%</span></td>
                    <td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
                    <td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
                </tr>
                </table>
                <strong><span class="genmed">[{UPLOADED} / {QUOTA} / {PERCENT_FULL}]</span> </strong><br />
                <span class="genmed"><a href="{U_UACP}" class="genmed">{L_UACP}</a></span></td>
            </td>
        </tr>
        <!-- END switch_upload_limits -->        
<!-- BEGIN show_groups -->
        <tr>
          <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_GROUPS}:</span></td>
          <td> <strong><span class="gen">{GROUPS}</span></strong></td>
        </tr>
<!-- END show_groups -->        
      </table>
    </td>
  </tr>
  <tr> 
    <td class="catLeft" align="center" height="28"><strong><span class="gen">{L_CONTACT} {USERNAME} </span></strong></td>
  </tr>
  <tr> 
    <td class="row1" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen">{L_EMAIL_ADDRESS}:</span></td>
          <td class="row1" valign="middle" width="100%"><strong><span class="gen">{EMAIL_IMG}</span></strong></td>
        </tr>
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_PM}:</span></td>
          <td class="row1" valign="middle"><strong><span class="gen">{PM_IMG}</span></strong></td>
        </tr>
        <tr>
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen"> {L_MESSENGER}:</span></td>
          <td class="row1" valign="middle" width="100%"><span class="gen">{MSN_IMG}</span></td>
        </tr>
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_YAHOO}:</span></td>
          <td class="row1" valign="middle"><span class="gen">{YIM_IMG}</span></td>
        </tr>
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_AIM}:</span></td>
          <td class="row1" valign="middle"><span class="gen">{AIM_IMG}</span></td>
        </tr>
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_ICQ_NUMBER}:</span></td>
          <td class="row1"><script><!-- 

        if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
            document.write(' {ICQ_IMG}');
        else
            document.write('<table cellspacing="0" cellpadding="0" border="0"><tr><td nowrap="nowrap"><div style="position:relative;height:18px"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{ICQ_STATUS_IMG}</div></div></td></tr></table>');
          
          //--></script><noscript>{ICQ_IMG}</noscript></td>
        </tr>
<tr> 
            <td valign="middle" nowrap="nowrap" align="right"><span class="gen">{L_ONLINE_STATUS}:</span></td>
            <td class="row1" valign="middle"><span class="gen">{ONLINE_STATUS}</span></td>
        </tr>        
      </table>
    </td>
  </tr>
<!-- BEGIN user_extra -->
<tr>
    <td class="catLeft" align="center" height="28" colspan="2"><strong><span class="gen">{L_EXTRA_INFO}</span></strong></td>
</tr>
<tr>
    <td class="row1" colspan="2"><table width="100%" border="0">
        <tr><td>{EXTRA_INFO}</td></tr>
    </table></td>
</tr>
<!-- END user_extra -->  
<!-- BEGIN user_sig -->
    <tr>
        <td class="catLeft" align="center" height="28" colspan="2"><strong><span class="gen">{L_SIG}</span></strong></td>
    </tr>
  <tr>
    <td class="row1" valign="top" colspan="2"><table width="100%" border="0">
        <tr><td>{USER_SIG}</td></tr>
    </table></td>
  </tr>
  <!-- END user_sig -->  
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td align="right"><span class="nav"><br />{JUMPBOX}</span></td>
  </tr>
</table>