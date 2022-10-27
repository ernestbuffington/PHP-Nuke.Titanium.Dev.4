<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">
{ERROR_BOX}
<table width="100%" cellspacing="1" cellpadding="4" border="0" align="center">
  <tr>
    <td align="left"><a href="{U_INDEX}">{L_INDEX}</a></td>
  </tr>
</table>
<!--	REGISTRATION INFO	-->
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style=" text-align: center; text-transform: uppercase;" valign="middle">{L_REGISTRATION_INFO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_USERNAME}</span>
      <span class="evo-sprite about tooltip float-right" title="Required Field"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" style="width:250px" name="username" size="25" maxlength="25" value="{USERNAME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;"><span style="margin-top: 2px;">{L_NAME}</span></td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" style="width:250px" name="rname" size="25" maxlength="25" value="{RNAME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_EMAIL_ADDRESS}</span>
      <span class="evo-sprite about tooltip float-right" title="Required Field"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" style="width:250px" name="email" size="25" maxlength="255" value="{EMAIL}" autocomplete='email' /></td>
  </tr>
  <!-- Start add - Gender MOD -->
  <tr> 
    <td class="row1" style="width: 50%;">{L_GENDER}</td> 
    <td class="row2" style="width: 50%;"> 
      <input type="radio" name="gender" value="0" {GENDER_NO_SPECIFY_CHECKED}/>{L_GENDER_NOT_SPECIFY}&nbsp;&nbsp; 
      <input type="radio" name="gender" value="1" {GENDER_MALE_CHECKED}/>{L_GENDER_MALE}&nbsp;&nbsp; 
      <input type="radio" name="gender" value="2" {GENDER_FEMALE_CHECKED}/>{L_GENDER_FEMALE}
    </td> 
  </tr>
  <!-- End add - Gender MOD -->
  <!-- BEGIN birthday_required -->
	<tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BIRTHDAY}</span>
      <span class="evo-sprite about tooltip float-right" title="Required Field"></span>
    </td>
    <td class="row2" style="width: 50%;">{BIRTHDAY_INTERFACE}</td>
	</tr>
	<!-- END birthday_required -->
  <!-- BEGIN switch_edit_profile -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_CURRENT_PASSWORD}</span>
      <span class="evo-sprite about tooltip float-right" title="Required Field"></span>
      <span class="evo-sprite help tooltip float-right" title="{L_CONFIRM_PASSWORD_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input autocomplete="off" type="password" class="post" style="width: 250px" name="cur_password" size="25" maxlength="100" value="{CUR_PASSWORD}" /></td>
  </tr>
  <!-- END switch_edit_profile -->
  <!-- BEGIN switch_ya_merge -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_NEW_PASSWORD}</span>
      <span class="evo-sprite about tooltip float-right" title="Required Field"></span>
      <span class="evo-sprite help tooltip float-right" title="{L_PASSWORD_IF_CHANGED}"></span>
    </td>
    <td class="row2" style="width: 50%;" nowrap="nowrap">    
      <input autocomplete="off" type="password" class="post passwordJQ" style="width: 250px" name="new_password" size="25" maxlength="32" value="{NEW_PASSWORD}" data-indicator="pwindicator" />
    </td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_CONFIRM_PASSWORD}</span>
      <span class="evo-sprite about tooltip float-right" title="Required Field"></span>
      <span class="evo-sprite help tooltip float-right" title="{L_PASSWORD_CONFIRM_IF_CHANGED}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input autocomplete="off" type="password" class="post" style="width: 250px" name="password_confirm" size="25" maxlength="100" value="{PASSWORD_CONFIRM}" /></td>
  </tr>
  <!-- END switch_ya_merge -->
  <!-- <tr>
    <td class="row1" style="width: 50%;"><span class="gen" style="display: inline-block; float: left; margin-top: 2px;">{L_PASSWORD_STRENGTH_EXPLAIN}</span></td>
    <td class="row2" style="width: 50%;">
      <div id="pwindicator">
      <div class="strength-bar">
        <span class="label"></span>
        <span class="percent"></span>
      </div>
      </div>
    </td>
  </tr> -->
  <!-- BEGIN switch_silent_password -->
  <input type="hidden" name="new_password" value="{NEW_PASSWORD}" />
  <input type="hidden" name="password_confirm" value="{PASSWORD_CONFIRM}" />
  <!-- END switch_silent_password -->
  <tr>
    <td class="catBottom" colspan="2" style="height: 30px;">&nbsp;</td>
  </tr>
</table>
<!--	REGISTRATION INFO	-->
<br />
<!--	PROFILE INFORMATION		-->
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style=" text-align: center; text-transform: uppercase;" valign="middle">{L_PROFILE_INFO}</td>
  </tr>
  <tr> 
    <td class="catHead" colspan="2" style=" text-align: center; text-transform: uppercase;">{L_PROFILE_INFO_NOTICE}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_FACEBOOK}</span>
      <span class="evo-sprite help tooltip-html float-right" title="<img src='images/facebook-id.png' style='height: 22px; width: 287px;' alt='0' border='0' /><br />{L_FACEBOOK_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" name="facebook" style="width: 250px;" maxlength="255" value="{FACEBOOK}" /></td>
  </tr>      
  <!-- BEGIN xdata -->
  <!-- BEGIN switch_is_website -->
  <tr>
    <td class="row1" style="width: 50%;">{L_WEBSITE}</td>
    <td class="row2" style="width: 50%;" style="width: 50%;"><input type="text" class="post" style="width: 250px" name="website" size="25" maxlength="255" value="{WEBSITE}" /></td>
  </tr>
  <!-- END switch_is_website -->
  <!-- BEGIN switch_is_location -->
  <tr>
    <td class="row1" style="width: 50%;">{L_LOCATION}</td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" style="width: 250px"  name="location" size="25" maxlength="100" value="{LOCATION}" /></td>
  </tr>
  <!-- FLAGHACK-start -->
  <tr>
    <td class="row1" style="width: 50%;">{L_FLAG}</td>
    <td class="row2" style="width: 50%;">{FLAG_SELECT}&nbsp;<span class="countries {FLAG_START}"></span></td>
  </tr>
  <!-- FLAGHACK-end -->
  <!-- END switch_is_location -->
  <!-- BEGIN switch_is_occupation -->
  <tr>
    <td class="row1" style="width: 50%;">{L_OCCUPATION}</td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" style="width: 250px" name="occupation" maxlength="100" value="{OCCUPATION}" /></td>
  </tr>
  <!-- END switch_is_occupation -->
  <!-- BEGIN switch_is_interests -->
  <tr>
    <td class="row1" style="width: 50%;">{L_INTERESTS}</td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" style="width: 250px" name="interests" maxlength="150" value="{INTERESTS}" /></td>
  </tr>
<!-- END switch_is_interests -->
<!-- BEGIN switch_is_signature -->
  <tr>
    <td class="row1" style="width: 50%;">{L_EXTRA_INFO}</td>
    <td class="row2" style="width: 50%;"><textarea class="post" style="height: 140px; width: 98%;" name='extra_info' />{EXTRA_INFO}</textarea></td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{SIG_DESC}</td>
    <td class="row2" style="width: 50%;"><input style="cursor: pointer;" type="button" value="{SIG_BUTTON_DESC}" onclick="window.location.href='{SIG_EDIT_LINK}'" /></td>
  </tr>
  <!-- END switch_is_signature -->
  <!-- BEGIN switch_type_date -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{xdata.NAME}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{xdata.DESCRIPTION}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" class="post"style="width: 200px" name="{xdata.CODE_NAME}" size="35" maxlength="{xdata.MAX_LENGTH}" value="{xdata.VALUE}" /></td>
  </tr>
  <!-- END switch_type_date -->
  <!-- BEGIN switch_type_text -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{xdata.NAME}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{xdata.DESCRIPTION}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" class="post" style="width: 250px" name="{xdata.CODE_NAME}" maxlength="{xdata.MAX_LENGTH}" value="{xdata.VALUE}" /></td>
  </tr>
  <!-- END switch_type_text -->
  <!-- BEGIN switch_type_textarea -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{xdata.NAME}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{xdata.DESCRIPTION}"></span>
    </td>
    <td class="row2" style="width: 50%;"><textarea name="{xdata.CODE_NAME}" style="height: 140px; width: 98%;" class="post">{xdata.VALUE}</textarea></td>
  </tr>
  <!-- END switch_type_textarea -->
  <!-- BEGIN switch_type_checkbox -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{xdata.NAME}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{xdata.DESCRIPTION}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="checkbox" name="{xdata.CODE_NAME}" {xdata.switch_type_checkbox.CHECKED} /></td>
  </tr>
	<!-- END switch_type_checkbox -->
  <!-- BEGIN switch_type_select -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{xdata.NAME}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{xdata.DESCRIPTION}"></span>
    </td>
    <td class="row2" style="width: 50%;">
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
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{xdata.NAME}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{xdata.DESCRIPTION}"></span>
    </td>
    <td class="row2" style="width: 50%;">
      <!-- BEGIN options -->
      <input type="radio" name="{xdata.CODE_NAME}" value="{xdata.switch_type_radio.options.OPTION}" {xdata.switch_type_radio.options.CHECKED} />{xdata.switch_type_radio.options.OPTION}<br />
      <!-- END options -->
    </td>
  </tr>
  <!-- END switch_type_radio -->
  <!-- END xdata -->
  <tr>
    <td class="catBottom" colspan="2" style="height: 30px;">&nbsp;</td>
  </tr>
</table>
<!--	PROFILE INFORMATION		-->
<br />
<!--	PREFERENCES		-->
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style=" text-align: center; text-transform: uppercase;" valign="middle">{L_PREFERENCES}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_GLANCE_SHOW}</td>
    <td class="row2" style="width: 50%;">{GLANCE_SHOW}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_HIDE_IMAGES}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="hide_images" value="1" {HIDE_IMAGES_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="hide_images" value="0" {HIDE_IMAGES_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_PUBLIC_VIEW_EMAIL}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_HIDE_USER}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="hideonline" value="1" {HIDE_USER_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="hideonline" value="0" {HIDE_USER_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_BIRTHDAY_DISPLAY}</td>
    <td class="row2" style="width: 50%;">
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
    <td class="row1" style="width: 50%;">{L_BDAY_SEND_GREETING}<br />{L_BDAY_SEND_GREETING_EXPLAIN}</td>
    <td class="row2" style="width: 50%;">
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
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_NOTIFY_ON_REPLY}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_NOTIFY_ON_REPLY_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_NOTIFY_ON_PRIVMSG}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} />{L_NO}</td>
  </tr>
  <!-- Start add - Custom mass PM MOD -->
  <!-- BEGIN switch_can_disable_mass_pm -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_ENABLE_MASS_PM}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_ENABLE_MASS_PM_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;">
      <input type="radio" name="allow_mass_pm" value="4" {ALLOW_MASS_PM_NOTIFY_CHECKED}/>{L_YES}&nbsp;&nbsp;<input type="radio" name="allow_mass_pm" value="2" {ALLOW_MASS_PM_CHECKED}/>{L_NO}&nbsp;&nbsp;<input type="radio" name="allow_mass_pm" value="0" {DISABLE_MASS_PM_CHECKED}/>{L_NO_MASS_PM}
    </td>
  </tr>
  <!-- END switch_can_disable_mass_pm -->
  <!-- BEGIN switch_can_not_disable_mass_pm -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_ENABLE_MASS_PM}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_ENABLE_MASS_PM_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="radio" name="allow_mass_pm" value="4" {ALLOW_MASS_PM_NOTIFY_CHECKED}/>{L_YES}&nbsp;&nbsp;<input type="radio" name="allow_mass_pm" value="2" {ALLOW_MASS_PM_CHECKED}/>{L_NO}</td>
  </tr>
  <!-- END switch_can_not_disable_mass_pm -->
  <!-- End add - Custom mass PM MOD -->
  <!-- <tr>
    <td class="row1" style="width: 50%;">
      <span class="gen" style="display: inline-block; float: left; margin-top: 2px;">{L_POPUP_ON_PRIVMSG}</span>
      <span class="tooltip icon-sprite icon-info" title="{L_POPUP_ON_PRIVMSG_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} />{L_NO}</td>
  </tr> -->
  <tr>
    <td class="row1" style="width: 50%;">{L_ALWAYS_ADD_SIGNATURE}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_ALWAYS_ALLOW_BBCODE}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_ALWAYS_ALLOW_HTML}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} />{L_NO}</td>
  </tr>
  <!-- BEGIN birthday_optional -->
  <tr>
    <td class="row1" style="width: 50%;">{L_BIRTHDAY}</td>
    <td class="row2" style="width: 50%;">{BIRTHDAY_INTERFACE}</td>
  </tr>
	<!-- END birthday_optional -->
  <tr>
    <td class="row1" style="width: 50%;">{L_ALWAYS_ALLOW_SMILIES}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_SHOW_AVATARS}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="showavatars" value="1" {SHOW_AVATARS_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="showavatars" value="0" {SHOW_AVATARS_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_SHOW_SIGNATURES}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="showsignatures" value="1" {SHOW_SIGNATURES_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="showsignatures" value="0" {SHOW_SIGNATURES_NO} />{L_NO}</td>
    </tr>
    <tr>
    <td class="row1" style="width: 50%;">{L_NEWSLETTER}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="newsletter" value="1" {NEWSLETTER_YES} />{L_YES}&nbsp;&nbsp;<input type="radio" name="newsletter" value="0" {NEWSLETTER_NO} />{L_NO}</td>
  </tr>
  <!-- BEGIN force_word_wrapping -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_WORD_WRAP}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_WORD_WRAP_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" name="user_wordwrap" value="{WRAP_ROW}" size="2" maxlength="2" class="post" /> {L_WORD_WRAP_EXTRA}</td>
  </tr>
  <!-- END force_word_wrapping -->
  <tr>
    <td class="row1" style="width: 50%;">{L_BOARD_LANGUAGE}</td>
    <td class="row2" style="width: 50%;">{LANGUAGE_SELECT}</td>
  </tr>
    <tr>
    <td class="row1" style="width: 50%;">{L_BOARD_STYLE}</td>
    <td class="row2" style="width: 50%;">{STYLE_SELECT}</td>
  </tr>
  <!-- Start replacement - Advanced time management MOD -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_TIME_MODE}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_TIME_MODE_TEXT}"></span>
    </td>
    <td class="row2" style="width: 50%;">
      {L_TIME_MODE_AUTO}<br /><input type="radio" name="time_mode" value="6" {TIME_MODE_FULL_PC_CHECKED}/>
      {L_TIME_MODE_FULL_PC}&nbsp;&nbsp;<br /><input type="radio" name="time_mode" value="4" {TIME_MODE_SERVER_PC_CHECKED}/>
      {L_TIME_MODE_SERVER_PC}&nbsp;&nbsp;<br /><input type="radio" name="time_mode" value="3" {TIME_MODE_FULL_SERVER_CHECKED}/>
      {L_TIME_MODE_FULL_SERVER}<br /><br />
      {L_TIME_MODE_MANUAL}<br />
      &nbsp;&nbsp;{L_TIME_MODE_DST}:<input type="radio" name="time_mode" value="1" {TIME_MODE_MANUAL_DST_CHECKED}/>{L_YES}{L_TIME_MODE_DST_ON}&nbsp;<input type="radio" name="time_mode" value="0" {TIME_MODE_MANUAL_CHECKED}/><span class="gen">{L_NO}{L_TIME_MODE_DST_OFF}</span>&nbsp;<input type="radio" name="time_mode" value="2" {TIME_MODE_SERVER_SWITCH_CHECKED}/>{L_TIME_MODE_DST_SERVER}<br />
      &nbsp;&nbsp;{L_TIME_MODE_DST_TIME_LAG}: <input type="text" name="dst_time_lag" value="{DST_TIME_LAG}" maxlength="3" size="3" class="post" />{L_TIME_MODE_DST_MN}<br />
      &nbsp;&nbsp;{L_TIME_MODE_TIMEZONE}: {TIMEZONE_SELECT}
    </td>
  </tr>
  <!-- End replacement - Advanced time management MOD -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_DATE_FORMAT}</span>
      <span class="evo-sprite help tooltip-interact float-right" title="{L_DATE_FORMAT_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" name="dateformat" value="{DATE_FORMAT}" maxlength="14" class="post" /></td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" style="height: 30px;">&nbsp;</td>
  </tr>
</table>
<!--	PREFERENCES 	-->
<br />
<!--	QUICK REPLY PANEL	-->
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style=" text-align: center; text-transform: uppercase;" valign="middle">{L_QUICK_REPLY_PANEL}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_SHOW_QUICK_REPLY}</td>
    <td class="row2" style="width: 50%;">{QUICK_REPLY_SELECT}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_QUICK_REPLY_MODE}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="quickreply_mode" value="0" {QUICK_REPLY_MODE_BASIC} />{L_QUICK_REPLY_MODE_BASIC}&nbsp;&nbsp;<input type="radio" name="quickreply_mode" value="1" {QUICK_REPLY_MODE_ADVANCED} />{L_QUICK_REPLY_MODE_ADVANCED}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_OPEN_QUICK_REPLY}</td>
    <td class="row2" style="width: 50%;"><input type="radio" name="open_quickreply" value="1" {OPEN_QUICK_REPLY_YES} />{L_YES}<input type="radio" name="open_quickreply" value="0" {OPEN_QUICK_REPLY_NO} />{L_NO}</td>
  </tr>
  <!-- BEGIN switch_avatar_block -->
  <tr>
    <td class="catBottom" colspan="2" style="height: 30px;">&nbsp;</td>
  </tr>
</table>
<br />

<!-- {L_SCEDITOR_PANEL} -->
<!-- IF SCEDITOR_STATE == 'sceditor' -->
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style=" text-align: center; text-transform: uppercase;" valign="middle">{L_SCEDITOR_PANEL}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 50%;">{L_SCEDITOR_STATE}</td>
    <td class="row2" style="width: 50%;">{SCEDITOR_SELECT}</td>
  </tr>
</table>
<br />
<!-- ENDIF -->

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style=" text-align: center; text-transform: uppercase;" valign="middle">{L_AVATAR_PANEL}</td>
  </tr>
  <tr>
    <td class="row1" colspan="2">
      <table width="70%" cellspacing="2" cellpadding="0" border="0" align="center">
        <tr>
          <td width="65%">{L_AVATAR_EXPLAIN}</td>
          <td align="center">{L_CURRENT_IMAGE}<br />{AVATAR}<br /><input type="checkbox" name="avatardel" />&nbsp;{L_DELETE_AVATAR}</td>
        </tr>
      </table>
    </td>
  </tr>
  <!-- BEGIN switch_avatar_local_upload -->
  <tr>
    <td class="row1" style="width: 50%;">{L_UPLOAD_AVATAR_FILE}:</td>
    <td class="row2" style="width: 50%;"><input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" /><input type="file" name="avatar" class="post" style="width: 100%;" /></td>
  </tr>
  <!-- END switch_avatar_local_upload -->
  <!-- BEGIN switch_avatar_remote_upload -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_UPLOAD_AVATAR_URL}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_UPLOAD_AVATAR_URL_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" name="avatarurl" class="post" style="width: 100%;" /></td>
  </tr>
  <!-- END switch_avatar_remote_upload -->
  <!-- BEGIN switch_avatar_remote_link -->
  <tr>
    <td class="row1" style="width: 50%;">
      <span  style="display: inline-block; float: left; margin-top: 2px;">{L_LINK_REMOTE_AVATAR}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_LINK_REMOTE_AVATAR_EXPLAIN}"></span>
    </td>
    <td class="row2" style="width: 50%;"><input type="text" name="avatarremoteurl" class="post" style="width: 100%;" /></td>
  </tr>
  <!-- END switch_avatar_remote_link -->
  <!-- BEGIN switch_avatar_local_gallery -->
  <tr>
    <td class="row1" style="width: 50%;">{L_AVATAR_GALLERY}</td>
    <td class="row2" style="width: 50%;"><input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="titaniumbutton" /></td>
  </tr>
  <!-- END switch_avatar_local_gallery -->
  <!-- END switch_avatar_block -->
  <tr>
    <td class="catBottom" colspan="2" style=" text-align: center;">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="titaniumbutton" /></td>
  </tr>
</table>
<!--	QUICK REPLY PANEL	-->
</form>