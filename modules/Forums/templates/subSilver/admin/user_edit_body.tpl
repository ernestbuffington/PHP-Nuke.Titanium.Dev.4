<h1>{L_USER_TITLE}</h1>

<p>{L_USER_EXPLAIN}</p>

{ERROR_BOX}

<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">
  <table width="98%" cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
    <tr>
      <td class="catHead" colspan="2">{L_REGISTRATION_INFO}</th>
    </tr>
    <tr>
      <td class="row2" colspan="2">{L_ITEMS_REQUIRED}</td>
    </tr>
    <tr>
      <td class="row1" width="38%">
        <span style="display: inline-block; float: left; margin-top: 2px;">{L_USERNAME}</span>
        <span class="tooltip evo-sprite about float-right" title="{L_REQUIRED}"></span>
      </td>
      <td class="row2"><input class="post" type="text" name="username" size="35" maxlength="40" value="{USERNAME}" /></td>
    </tr>
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;">{L_EMAIL_ADDRESS}</span>
        <span class="tooltip evo-sprite about float-right" title="{L_REQUIRED}"></span>
      </td>
      <td class="row2"><input class="post" type="text" name="email" size="35" maxlength="255" value="{EMAIL}" /></td>
    </tr>
	<!-- BEGIN birthday_required -->
	<tr>
      <td class="row1">{L_BIRTHDAY}: *</td>
      <td class="row2">{BIRTHDAY_INTERFACE}</td>
	</tr>
	<!-- END birthday_required -->
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;">{L_NEW_PASSWORD}</span>
        <span class="tooltip evo-sprite about float-right" title="{L_REQUIRED}"></span>
        <span class="tooltip evo-sprite help float-right" title="{L_PASSWORD_IF_CHANGED}"></span>
      </td>
      <td class="row2"><input class="post" type="password" name="password" size="35" maxlength="32" value="" /></td>
    </tr>
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;">{L_CONFIRM_PASSWORD}</span>
        <span class="tooltip evo-sprite help float-right" title="{L_PASSWORD_CONFIRM_IF_CHANGED}"></span>
      </td>
      <td class="row2"><input class="post" type="password" name="password_confirm" size="35" maxlength="32" value="" /></td>
    </tr>
    <tr>
      <td class="catsides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2">{L_PROFILE_INFO}</th>
    </tr>
    <tr>
      <td class="row2" colspan="2">{L_PROFILE_INFO_NOTICE}</td>
    </tr>
    <tr>
      <td class="row1">{L_REPUTATION}</td>
      <td class="row2"><input class="post" type="text" name="reputation" size="10" maxlength="15" value="{REPUTATION}" /></td>
    </tr>
	<tr>
	  <td class="row1">{L_FACEBOOK}</td>
	  <td class="row2"><input class="post" type="text" name="facebook" size="35" maxlength="255" value="{FACEBOOK}" /></td>
	</tr>        
<!-- BEGIN xdata -->
<!-- BEGIN switch_is_website -->
    <tr>
      <td class="row1">{L_WEBSITE}</td>
      <td class="row2"><input class="post" type="text" name="website" size="35" maxlength="255" value="{WEBSITE}" /></td>
    </tr>
<!-- END switch_is_website -->
<!-- BEGIN switch_is_location -->
    <tr>
      <td class="row1">{L_LOCATION}</td>
      <td class="row2"><input class="post" type="text" name="location" size="35" maxlength="100" value="{LOCATION}" /></td>
    </tr>
<!-- FLAGHACK-start -->
    <tr>
      <td class="row1">{L_FLAG}</td>
      <td class="row2">
        <table cellspacing="0" celpadding="0">
          <tr>
            <td>{FLAG_SELECT}</td>
            <td>
              <!-- <img src="../../../images/flags/{FLAG_START}" width="16" height="11" name="user_flag" /> -->
              <span class="countries {FLAG_START}"></span>
            </td>
          </tr>
        </table>
      </td>
	</tr>
<!-- FLAGHACK-end -->
<!-- END switch_is_location -->
<!-- BEGIN switch_is_occupation -->
    <tr>
      <td class="row1">{L_OCCUPATION}</td>
      <td class="row2"><input class="post" type="text" name="occupation" size="35" maxlength="100" value="{OCCUPATION}" /></td>
    </tr>
<!-- END switch_is_occupation -->
<!-- BEGIN switch_is_interests -->
    <tr>
      <td class="row1">{L_INTERESTS}</td>
      <td class="row2"><input class="post" type="text" name="interests" size="35" maxlength="150" value="{INTERESTS}" /></td>
    </tr>
<!-- Start add - Gender MOD -->
    <tr> 
      <td class="row1">{L_GENDER}</td> 
      <td class="row2"> 
      <input type="radio" name="gender" value="0" {GENDER_NO_SPECIFY_CHECKED}/> {L_GENDER_NOT_SPECIFY}&nbsp;&nbsp; 
      <input type="radio" name="gender" value="1" {GENDER_MALE_CHECKED}/> {L_GENDER_MALE}&nbsp;&nbsp; 
      <input type="radio" name="gender" value="2" {GENDER_FEMALE_CHECKED}/> {L_GENDER_FEMALE}</td> 
    </tr>
<!-- End add - Gender MOD -->
<!-- END switch_is_interests -->
<!-- BEGIN switch_is_signature -->
	<!-- BEGIN birthday_optional -->
    <tr>
	  <td class="row1">{L_BIRTHDAY}</td>
	  <td class="row2">{BIRTHDAY_INTERFACE}</td>
	</tr>
	<!-- END birthday_optional -->
    <tr>
      <td class="row1">
        <span style="display: inline-block; float: left; margin-top: 2px;">{L_SIGNATURE}</span>
        <span class="tooltip evo-sprite help float-right" title="{L_SIGNATURE_EXPLAIN}"></span>
      </td>
      <td class="row2"><textarea class="post" name="signature" rows="6" cols="45">{SIGNATURE}</textarea></td>
    </tr>
<!-- END switch_is_signature -->
    <!-- BEGIN switch_type_text -->
    <tr>
      <td class="row1">{xdata.NAME}<br />{xdata.DESCRIPTION}</td>
      <td class="row2"><input type="text" class="post" style="width: 200px" name="{xdata.CODE_NAME}" size="35" maxlength="{xdata.MAX_LENGTH}" value="{xdata.VALUE}" /></td>
    </tr>
    <!-- END switch_type_text -->
    <!-- BEGIN switch_type_textarea -->
    <tr>
      <td class="row1">{xdata.NAME}<br />{xdata.DESCRIPTION}</td>
      <td class="row2"><textarea name="{xdata.CODE_NAME}" style="width: 300px"  rows="6" cols="30" class="post">{xdata.VALUE}</textarea></td>
    </tr>
    <!-- END switch_type_textarea -->
    <!-- BEGIN switch_type_checkbox -->
      <td class="row1">{xdata.NAME}<br />{xdata.DESCRIPTION}</td>
      <td class="row2"><input type="checkbox" name="{xdata.CODE_NAME}" {xdata.switch_type_checkbox.CHECKED} /></td>
    <!-- END switch_type_checkbox -->
    <!-- BEGIN switch_type_select -->
    <tr>
      <td class="row1">{xdata.NAME}<br />{xdata.DESCRIPTION}</td>
      <td class="row2">
         <select name="{xdata.CODE_NAME}">
           <!-- BEGIN options -->
           <option value="{xdata.switch_type_select.options.OPTION}" {xdata.switch_type_select.options.SELECTED}>{xdata.switch_type_select.options.OPTION}</option>
           <!-- END options -->
         </select>
      </td>
    </tr>
    <!-- END switch_type_select -->
    <!-- BEGIN switch_type_radio -->
    <tr>
      <td class="row1">{xdata.NAME}<br />{xdata.DESCRIPTION}</td>
      <td class="row2">
         <!-- BEGIN options -->
         <input type="radio" name="{xdata.CODE_NAME}" value="{xdata.switch_type_radio.options.OPTION}" {xdata.switch_type_radio.options.CHECKED} /> {xdata.switch_type_radio.options.OPTION}<br />
         <!-- END options -->
      </td>
    </tr>
    <!-- END switch_type_radio -->
<!-- END xdata -->
    <tr>
       <td class="row1">{L_GLANCE_SHOW}</td>
       <td class="row2">{GLANCE_SHOW}</td>
    </tr>
    <tr>
      <td class="row1">{L_HIDE_IMAGES}</td>
      <td class="row2">
        <input type="radio" name="hide_images" value="1" {HIDE_IMAGES_YES} /> {L_YES}
        <input type="radio" name="hide_images" value="0" {HIDE_IMAGES_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="catsides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2">{L_PREFERENCES}</th>
    </tr>
    <tr>
      <td class="row1">{L_PUBLIC_VIEW_EMAIL}</td>
      <td class="row2">
        <input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} /> {L_YES}
        <input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_HIDE_USER}</td>
      <td class="row2">
        <input type="radio" name="hideonline" value="1" {HIDE_USER_YES} /> {L_YES}
        <input type="radio" name="hideonline" value="0" {HIDE_USER_NO} /> {L_NO}
      </td>
    </tr>
	<tr>
	  <td class="row1">{L_BIRTHDAY_DISPLAY}
	  <td class="row2">
	    <select name="birthday_display">
	      <option value="{BIRTHDAY_ALL}"{BIRTHDAY_ALL_SELECTED}>{L_BIRTHDAY_ALL}</option>
	      <option value="{BIRTHDAY_DATE}"{BIRTHDAY_DATE_SELECTED}>{L_BIRTHDAY_YEAR}</option>
	      <option value="{BIRTHDAY_AGE}"{BIRTHDAY_AGE_SELECTED}>{L_BIRTHDAY_AGE}</option>
	      <option value="{BIRTHDAY_NONE}"{BIRTHDAY_NONE_SELECTED}>{L_BIRTHDAY_NONE}</option>
	    </select>
	  </td>
	</tr>
	<!-- BEGIN birthdays_greeting -->
	<tr>
	  <td class="row1">{L_BDAY_SEND_GREETING}:<br />{L_BDAY_SEND_GREETING_EXPLAIN}</td>
	  <td class="row2">
		  <input type="radio" name="bday_greeting" value="0" {BDAY_NONE_ENABLED} /> {L_NONE}&nbsp;&nbsp;
		  <!-- BEGIN birthdays_email -->
		  <input type="radio" name="bday_greeting" value="{BDAY_EMAIL}" {BDAY_EMAIL_ENABLED} /> {L_EMAIL}&nbsp;&nbsp;
		  <!-- END birthdays_email -->
		  <!-- BEGIN birthdays_pm -->
		  <input type="radio" name="bday_greeting" value="{BDAY_PM}" {BDAY_PM_ENABLED} /> {L_PM}&nbsp;&nbsp;
		  <!-- END birthdays_pm -->
		  <!-- BEGIN birthdays_popup -->
		  <input type="radio" name="bday_greeting" value="{BDAY_POPUP}" {BDAY_POPUP_ENABLED} /> {L_POPUP}&nbsp;&nbsp;
		  <!-- END birthdays_popup -->
	  </td>
	</tr>
	<!-- END birthdays_greeting -->
    <tr>
      <td class="row1">{L_NOTIFY_ON_REPLY}</td>
      <td class="row2">
        <input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} /> {L_YES}
        <input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} /> {L_NO}</td>
    </tr>
    <tr>
      <td class="row1">{L_NOTIFY_ON_PRIVMSG}</td>
      <td class="row2">
        <input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} /> {L_YES}
        <input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_POPUP_ON_PRIVMSG}</td>
      <td class="row2">
        <input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} /> {L_YES}
        <input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_ALWAYS_ADD_SIGNATURE}</td>
      <td class="row2">
        <input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} /> {L_YES}
        <input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_ALWAYS_ALLOW_BBCODE}</td>
      <td class="row2">
        <input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} /> {L_YES}
        <input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_ALWAYS_ALLOW_HTML}</td>
      <td class="row2">
        <input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} /> {L_YES}
        <input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_ALWAYS_ALLOW_SMILIES}</td>
      <td class="row2">
        <input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} /> {L_YES}
        <input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_SHOW_AVATARS}</td>
      <td class="row2">
        <input type="radio" name="showavatars" value="1" {SHOW_AVATARS_YES} /> {L_YES}
        <input type="radio" name="showavatars" value="0" {SHOW_AVATARS_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_SHOW_SIGNATURES}</span></td>
      <td class="row2">
        <input type="radio" name="showsignatures" value="1" {SHOW_SIGNATURES_YES} /> {L_YES}
        <input type="radio" name="showsignatures" value="0" {SHOW_SIGNATURES_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_WORD_WRAP}<br />{L_WORD_WRAP_EXPLAIN}</td>
      <td class="row2"><input type="text" name="user_wordwrap" value="{WRAP_ROW}" size="2" maxlength="2" class="post" /> {L_WORD_WRAP_EXTRA}</td>
    </tr>
    <tr>
      <td class="row1">{L_BOARD_LANGUAGE}</td>
      <td class="row2">{LANGUAGE_SELECT}</td>
    </tr>
    <tr>
      <td class="row1">{L_BOARD_STYLE}</td>
      <td class="row2">{STYLE_SELECT}</td>
    </tr>
    <!-- Start replacement - Advanced time management MOD -->
    <tr>
        <td class="row1">
          <span style="display: inline-block; float: left; margin-top: 2px;">{L_TIME_MODE}</span>
          <span class="tooltip-html evo-sprite help float-right" title="{L_TIME_MODE_TEXT}"></span>
        </td>
        <td class="row2" nowrap="nowrap">
            {L_TIME_MODE_AUTO}<br /><input type="radio" name="time_mode" value="6" {TIME_MODE_FULL_PC_CHECKED}/>
            {L_TIME_MODE_FULL_PC}<br /><input type="radio" name="time_mode" value="4" {TIME_MODE_SERVER_PC_CHECKED}/>
            {L_TIME_MODE_SERVER_PC}<br /><input type="radio" name="time_mode" value="3" {TIME_MODE_FULL_SERVER_CHECKED}/>
            {L_TIME_MODE_FULL_SERVER}<br /><br />
            {L_TIME_MODE_MANUAL}<br />
            {L_TIME_MODE_DST}
            <input type="radio" name="time_mode" value="1" {TIME_MODE_MANUAL_DST_CHECKED}/>{L_YES}{L_TIME_MODE_DST_ON}&nbsp;
            <input type="radio" name="time_mode" value="0" {TIME_MODE_MANUAL_CHECKED}/>{L_NO}{L_TIME_MODE_DST_OFF}&nbsp;
            <input type="radio" name="time_mode" value="2" {TIME_MODE_SERVER_SWITCH_CHECKED}/>{L_TIME_MODE_DST_SERVER}<br />
            {L_TIME_MODE_DST_TIME_LAG} 
            <input type="text" name="dst_time_lag" value="{DST_TIME_LAG}" maxlength="3" size="3" class="post" />{L_TIME_MODE_DST_MN}<br />
            {L_TIME_MODE_TIMEZONE} {TIMEZONE_SELECT}</td>
    </tr>
        <!-- End replacement - Advanced time management MOD -->
    <tr>
      <td class="row1">
         <span style="display: inline-block; float: left; margin-top: 2px;">{L_DATE_FORMAT}</span>
         <span class="tooltip-interact evo-sprite help float-right" title="{L_DATE_FORMAT_EXPLAIN}"></span>
      </td>
      <td class="row2"><input class="post" type="text" name="dateformat" value="{DATE_FORMAT}" maxlength="16" /></td>
    </tr>
    <tr>
      <td class="catSides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="12" valign="middle">{L_QUICK_REPLY_PANEL}</th>
    </tr>
    <tr>
      <td class="row1">{L_SHOW_QUICK_REPLY}</td>
      <td class="row2">{QUICK_REPLY_SELECT}</td>
    </tr>
    <tr>
      <td class="row1">{L_QUICK_REPLY_MODE}</td>
      <td class="row2">
        <input type="radio" name="quickreply_mode" value="0" {QUICK_REPLY_MODE_BASIC} /> {L_QUICK_REPLY_MODE_BASIC}
        <input type="radio" name="quickreply_mode" value="1" {QUICK_REPLY_MODE_ADVANCED} /> {L_QUICK_REPLY_MODE_ADVANCED}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_OPEN_QUICK_REPLY}</td>
      <td class="row2">
        <input type="radio" name="open_quickreply" value="1" {OPEN_QUICK_REPLY_YES} /> {L_YES}&nbsp;&nbsp;
        <input type="radio" name="open_quickreply" value="0" {OPEN_QUICK_REPLY_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="catSides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="12" valign="middle">{L_AVATAR_PANEL}</th>
    </tr>
    <tr align="center">
      <td class="row1" colspan="2">
        <table width="70%" cellspacing="2" cellpadding="0" border="0">
          <tr>
            <td width="65%">{L_AVATAR_EXPLAIN}</td>
            <td align="center">{L_CURRENT_IMAGE}<br />{AVATAR}<br /><input type="checkbox" name="avatardel" />&nbsp;{L_DELETE_AVATAR}</td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- BEGIN avatar_local_upload -->
    <tr>
      <td class="row1">{L_UPLOAD_AVATAR_FILE}</td>
      <td class="row2"><input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" /><input type="file" name="avatar" class="post" style="width: 200px" /></td>
    </tr>
    <!-- END avatar_local_upload -->
    <!-- BEGIN avatar_remote_upload -->
    <tr>
      <td class="row1">{L_UPLOAD_AVATAR_URL}</td>
      <td class="row2"><input class="post" type="text" name="avatarurl" size="40" style="width: 200px" /></td>
    </tr>
    <!-- END avatar_remote_upload -->
    <!-- BEGIN avatar_remote_link -->
    <tr>
      <td class="row1">{L_LINK_REMOTE_AVATAR}</td>
      <td class="row2"><input class="post" type="text" name="avatarremoteurl" size="40" style="width: 200px" /></td>
    </tr>
    <!-- END avatar_remote_link -->
    <!-- BEGIN avatar_local_gallery -->
    <tr>
      <td class="row1">{L_AVATAR_GALLERY}</td>
      <td class="row2"><input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="liteoption" /></td>
    </tr>
    <!-- END avatar_local_gallery -->
    <tr>
      <td class="catSides" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2">{L_SPECIAL}</th>
    </tr>
    <tr>
      <td class="row1" colspan="2"><{L_SPECIAL_EXPLAIN}</td>
    </tr>
    <tr>
      <td class="row1">{L_UPLOAD_QUOTA}</td>
      <td class="row2">{S_SELECT_UPLOAD_QUOTA}</td>
    </tr>
    <tr>
      <td class="row1">{L_PM_QUOTA}</td>
      <td class="row2">{S_SELECT_PM_QUOTA}</td>
    </tr>
    <tr>
      <td class="row1">{L_USER_ACTIVE}</td>
      <td class="row2">
        <input type="radio" name="user_status" value="1" {USER_ACTIVE_YES} /> {L_YES}
        <input type="radio" name="user_status" value="0" {USER_ACTIVE_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_ALLOW_PM}</td>
      <td class="row2">
        <input type="radio" name="user_allowpm" value="1" {ALLOW_PM_YES} /> {L_YES}
        <input type="radio" name="user_allowpm" value="0" {ALLOW_PM_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_ALLOW_AVATAR}</td>
      <td class="row2">
        <input type="radio" name="user_allowavatar" value="1" {ALLOW_AVATAR_YES} /> {L_YES}
        <input type="radio" name="user_allowavatar" value="0" {ALLOW_AVATAR_NO} /> {L_NO}
      </td>
    </tr>
    <tr>
      <td class="row1">{L_USER_POSTS}</td>
      <td class="row2"><input type="text" name="user_posts" value="{USER_POSTS}"></select></td>
    </tr>
    <tr>
      <td class="row1">{L_SELECT_RANK1}</td>
      <td class="row2"><select name="user_rank">{RANK1_SELECT_BOX}</select></td>
	</tr>
	<tr>
		<td class="row1">{L_SELECT_RANK2}</td>
		<td class="row2"><select name="user_rank2">{RANK2_SELECT_BOX}</select></td>
	</tr>
	<tr>
		<td class="row1">{L_SELECT_RANK3}</td>
		<td class="row2"><select name="user_rank3">{RANK3_SELECT_BOX}</select></td>
	</tr>
	<tr>
		<td class="row1">{L_SELECT_RANK4}</td>
		<td class="row2"><select name="user_rank4">{RANK4_SELECT_BOX}</select></td>
	</tr>
	<tr>
		<td class="row1">{L_SELECT_RANK5}</td>
		<td class="row2"><select name="user_rank5">{RANK5_SELECT_BOX}</select></td>
	</tr>
   <tr>
      <td class="row1">{L_ADMIN_NOTES}</td>
      <td class="row2"><textarea class="post" name="user_admin_notes" rows="6" cols="45">{ADMIN_NOTES}</textarea></td>
   </tr>    
    <tr>
      <td class="row1">{L_DELETE_USER}?</td>
      <td class="row2"><input type="checkbox" name="deleteuser"> {L_DELETE_USER_EXPLAIN}</td>
    </tr>
    <tr>
      <td class="catBottom" colspan="2" align="center">
        {S_HIDDEN_FIELDS}
        <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
        <input type="reset" value="{L_RESET}" class="liteoption" />
      </td>
    </tr>
 </table>
</form>