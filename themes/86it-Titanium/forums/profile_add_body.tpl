<form action="{S_PROFILE_ACTION}" {s_form_enctype} method="post">

{ERROR_BOX}

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
    </tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
    <tr>
        <th class="thHead" colspan="2" height="25" valign="middle">{L_REGISTRATION_INFO}</th>
    </tr>
    <tr>
        <td class="row1" width="38%"><span class="gen">{L_USERNAME}: *</span></td>
        <td class="row2"><input type="text" class="post" style="width:200px" name="username" size="25" maxlength="25" value="{USERNAME}" /></td>
    </tr>
    <tr>
        <td class="row1" width="38%"><span class="gen">{L_NAME}</span></td>
        <td class="row2"><input type="text" class="post" style="width:200px" name="rname" size="25" maxlength="25" value="{RNAME}" /></td>
    </tr>
    <tr>
        <td class="row1"><span class="gen">{L_EMAIL_ADDRESS}: *</span></td>
        <td class="row2"><input type="text" class="post" style="width:200px" name="email" size="25" maxlength="255" value="{EMAIL}" /></td>
    </tr>
    <!-- Start add - Gender MOD -->
    <tr> 
        <td class="row1"><span class="gen">{L_GENDER}:</span></td> 
        <td class="row2"> 
        <input type="radio" {lock_gender} name="gender" value="0" {gender_no_specify_checked}/> 
        <span class="gen">{L_GENDER_NOT_SPECIFY}</span>&nbsp;&nbsp; 
        <input type="radio" name="gender" value="1" {gender_male_checked}/> 
        <span class="gen">{L_GENDER_MALE}</span>&nbsp;&nbsp; 
        <input type="radio" name="gender" value="2" {gender_female_checked}/> 
        <span class="gen">{L_GENDER_FEMALE}</span></td> 
    </tr>
    <!-- End add - Gender MOD -->
	<!-- BEGIN birthday_required -->
	<tr>
	  <td class="row1"><span class="gen">{L_BIRTHDAY}: *</span></td>
	  <td class="row2">{BIRTHDAY_INTERFACE}</td>
	</tr>
	<!-- END birthday_required -->
    <!-- BEGIN switch_edit_profile -->
    <tr>
      <td class="row1"><span class="gen">{L_CURRENT_PASSWORD}: *</span><br />
        <span class="gensmall">{L_CONFIRM_PASSWORD_EXPLAIN}</span></td>
      <td class="row2">
        <input type="password" class="post" style="width: 200px" name="cur_password" size="25" maxlength="100" value="{CUR_PASSWORD}" />
      </td>
    </tr>
    <!-- END switch_edit_profile -->
    <!-- BEGIN switch_ya_merge -->
    <tr>
      <td class="row1"><span class="gen">{L_NEW_PASSWORD}: *</span><br />
        <span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
      <td class="row2" nowrap="nowrap"> 
		<script language="JavaScript" type="text/javascript">
		<!--
		// Password security
		function check_pw(pw_to_check) 
		{
			var counter_to_check = 0;
			var minlength_to_check = 6;
		
			if (pw_to_check.length >= minlength_to_check)
			{
				counter_to_check = counter_to_check + 1;
			}
			if (pw_to_check.match(/[A-Z\Ä\Ö\Ü]/))
			{
				counter_to_check = counter_to_check + 2;
			}
			if (pw_to_check.match(/[a-z\ä\ö\ü\ß]/))
			{
				counter_to_check = counter_to_check + 1;
			}
			if (pw_to_check.match(/[0-9]/))
			{
				counter_to_check = counter_to_check + 2;
			}
            if (pw_to_check.match(/[\.\,\?\!\%\*\_\#\:\;\~\\&\$\§\€\@\/\=\+\-\(\)\[\]\|\<\>]/)) 
            { 
               counter_to_check = counter_to_check + 2; 
            } 
			if (pw_to_check == document.getElementsByName('username').username.value)
			{
				counter_to_check = 0;
			}
			if (pw_to_check == document.getElementsByName('email').email.value)
			{
				counter_to_check = 0;
			}

			if (counter_to_check <= 2)
			{
				document.getElementsByName('holder_pw')[0].style.backgroundColor = 'red';
				document.getElementsByName('holder_pw')[0].style.color = 'black';
				document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
				document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL1}';
			}
			else if (counter_to_check <= 4)
			{
				document.getElementsByName('holder_pw')[0].style.backgroundColor = 'yellow';
				document.getElementsByName('holder_pw')[0].style.color = 'black';
				document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
				document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL2}';
			}
			else if (counter_to_check <= 5)
			{
				document.getElementsByName('holder_pw')[0].style.backgroundColor = 'green';
				document.getElementsByName('holder_pw')[0].style.color = 'white';
				document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
				document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL3}';
			}
			else if (counter_to_check <= 7)
			{
				document.getElementsByName('holder_pw')[0].style.backgroundColor = 'green';
				document.getElementsByName('holder_pw')[0].style.color = 'white';
				document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
				document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL4}';
			}
			else if (counter_to_check == 8)
			{
				document.getElementsByName('holder_pw')[0].style.backgroundColor = 'green';
				document.getElementsByName('holder_pw')[0].style.color = 'white';
				document.getElementsByName('holder_pw')[0].style.border = '1px solid black';
				document.getElementsByName('holder_pw')[0].value = '{L_PASSWORD_SECURITY_LEVEL5}';
			}
		}
		//-->
		</script>
		<input onkeyup="check_pw(this.value);" onfocus="check_pw(this.value);" type="password" class="post" style="width: 200px" name="new_password" size="25" maxlength="32" value="{NEW_PASSWORD}" />
		<span class="gensmall"><a href="{U_FAQ}#39" tabindex="98" target="_phpbbfaq"></a></span> 

      </td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_CONFIRM_PASSWORD}: * </span><br />
        <span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
      <td class="row2">
        <input type="password" class="post" style="width: 200px" name="password_confirm" size="25" maxlength="100" value="{PASSWORD_CONFIRM}" />
      </td>
    </tr>
    <!-- END switch_ya_merge -->
    <!-- BEGIN switch_silent_password -->
    <input type="hidden" name="new_password" value="{NEW_PASSWORD}" />
    <input type="hidden" name="password_confirm" value="{PASSWORD_CONFIRM}" />
    <!-- END switch_silent_password -->
    <tr>
      <td class="catSides" colspan="2" height="28">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="25" valign="middle">{L_PROFILE_INFO}</th>
    </tr>
    <tr> 
      <td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
    </tr>    
    <tr>
      <td class="row2" colspan="2"><span class="gensmall">{L_PROFILE_INFO_NOTICE}</span></td>
    </tr>
	<tr>
	  <td class="row1"><span class="gen">{L_MYSPACE}:</span></td>
	  <td class="row2">
		<input type="text" class="post"style="width: 200px"  name="myspace" size="25" maxlength="255" value="{MYSPACE}" />
	  </td>
	</tr>  
	<tr>
	  <td class="row1"><span class="gen">{L_FACEBOOK}:</span></td>
	  <td class="row2">
		<input type="text" class="post"style="width: 200px"  name="userfacebook" size="25" maxlength="255" value="{FACEBOOK}" />
	  </td>
	</tr>      
<!-- BEGIN xdata -->
<!-- BEGIN switch_is_icq -->
    <tr>
      <td class="row1"><span class="gen">{L_ICQ_NUMBER}:</span></td>
      <td class="row2">
        <input type="text" name="icq" class="post" style="width: 100px"  size="10" maxlength="15" value="{ICQ}" />
      </td>
    </tr>
<!-- END switch_is_icq -->
<!-- BEGIN switch_is_aim -->
    <tr>
      <td class="row1"><span class="gen">{L_AIM}:</span></td>
      <td class="row2">
        <input type="text" class="post" style="width: 150px"  name="aim" size="20" maxlength="255" value="{AIM}" />
      </td>
    </tr>
<!-- END switch_is_aim -->
<!-- BEGIN switch_is_msn -->
    <tr>
      <td class="row1"><span class="gen">{L_MESSENGER}:</span></td>
      <td class="row2">
        <input type="text" class="post" style="width: 150px"  name="msn" size="20" maxlength="255" value="{MSN}" />
      </td>
    </tr>
<!-- END switch_is_msn -->
<!-- BEGIN switch_is_yim -->
    <tr>
      <td class="row1"><span class="gen">{L_YAHOO}:</span></td>
      <td class="row2">
        <input type="text" class="post" style="width: 150px"  name="yim" size="20" maxlength="255" value="{YIM}" />
      </td>
    </tr>
<!-- END switch_is_yim -->
<!-- BEGIN switch_is_website -->
    <tr>
      <td class="row1"><span class="gen">{L_WEBSITE}:</span></td>
      <td class="row2">
        <input type="text" class="post" style="width: 200px"  name="website" size="25" maxlength="255" value="{WEBSITE}" />
      </td>
    </tr>
<!-- END switch_is_website -->
<!-- BEGIN switch_is_location -->
    <tr>
      <td class="row1"><span class="gen">{L_LOCATION}:</span></td>
      <td class="row2">
        <input type="text" class="post" style="width: 200px"  name="location" size="25" maxlength="100" value="{LOCATION}" />
      </td>
    </tr>
<!-- FLAGHACK-start -->
	<tr>
	  <td class="row1"><span class="gen">{L_FLAG}:</span></td>
	  <td class="row2">
	  <span class="gensmall">
		<table>
		  <tr>
		    <td>{FLAG_SELECT}&nbsp;</td>
	  	    <td><img src="images/flags/{FLAG_START}" width="16" height="11" name="user_flag" /></td>
		  </tr>
		</table>
	  </span>
	  </td>
	</tr>
<!-- FLAGHACK-end -->
<!-- END switch_is_location -->
<!-- BEGIN switch_is_occupation -->
    <tr>
      <td class="row1"><span class="gen">{L_OCCUPATION}:</span></td>
      <td class="row2">
        <input type="text" class="post" style="width: 200px"  name="occupation" size="25" maxlength="100" value="{OCCUPATION}" />
      </td>
    </tr>
<!-- END switch_is_occupation -->
<!-- BEGIN switch_is_interests -->
    <tr>
      <td class="row1"><span class="gen">{L_INTERESTS}:</span></td>
      <td class="row2">
        <input type="text" class="post" style="width: 200px"  name="interests" size="35" maxlength="150" value="{INTERESTS}" />
      </td>
    </tr>
<!-- END switch_is_interests -->
<!-- BEGIN switch_is_signature -->
    <tr>
      <td class="row1"><span class="gen">{L_EXTRA_INFO}</span></td>
      <td class="row2">
        <textarea wrap='virtual' class="post" cols='50' rows='5' name='extra_info' />{EXTRA_INFO}</textarea>
      </td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{SIG_DESC}:</span></td>
      <td class="row2">
        <input type="button" value="{SIG_BUTTON_DESC}" onclick="window.location.href='{SIG_EDIT_LINK}'" />
      </td>
    </tr>
<!-- END switch_is_signature -->
    <!-- BEGIN switch_type_date -->
    <tr>
      <td class="row1">
        <span class="gen">{xdata.NAME}</span><br /><span class="gensmall">{xdata.DESCRIPTION}</span>
      </td>
      <td class="row2">
        <input type="text" class="post"style="width: 200px" name="{xdata.CODE_NAME}" size="35" maxlength="{xdata.MAX_LENGTH}" value="{xdata.VALUE}" />
      </td>
    </tr>
    <!-- END switch_type_date -->
    <!-- BEGIN switch_type_text -->
    <tr>
      <td class="row1">
        <span class="gen">{xdata.NAME}</span><br /><span class="gensmall">{xdata.DESCRIPTION}</span>
      </td>
      <td class="row2">
        <input type="text" class="post" style="width: 200px" name="{xdata.CODE_NAME}" size="35" maxlength="{xdata.MAX_LENGTH}" value="{xdata.VALUE}" />
      </td>
    </tr>
    <!-- END switch_type_text -->
    <!-- BEGIN switch_type_textarea -->
    <tr>
      <td class="row1">
        <span class="gen">{xdata.NAME}</span><br /><span class="gensmall">{xdata.DESCRIPTION}</span>
      </td>
      <td class="row2">
        <textarea name="{xdata.CODE_NAME}" style="width: 300px"  rows="6" cols="30" class="post">{xdata.VALUE}</textarea>
      </td>
    </tr>
    <!-- END switch_type_textarea -->
    <!-- BEGIN switch_type_checkbox -->
      	<td class="row1">
        	<span class="gen">{xdata.NAME}</span><br /><span class="gensmall">{xdata.DESCRIPTION}</span>
	</td>
	<td class="row2">
		<input type="checkbox" name="{xdata.CODE_NAME}" {xdata.switch_type_checkbox.checked} /><br>
	</td>
	<!-- END switch_type_checkbox -->
    <!-- BEGIN switch_type_select -->
    <tr>
      <td class="row1">
        <span class="gen">{xdata.NAME}</span><br /><span class="gensmall">{xdata.DESCRIPTION}</span>
      </td>
      <td class="row2">
         <select name="{xdata.CODE_NAME}">
           <!-- BEGIN options -->
           <option value="{xdata.switch_type_select.options.OPTION}" {xdata.switch_type_select.options.selected}>{xdata.switch_type_select.options.OPTION}</option>
           <!-- END options -->
         </select>
      </td>
    </tr>
    <!-- END switch_type_select -->
    <!-- BEGIN switch_type_radio -->
    <tr>
      <td class="row1">
        <span class="gen">{xdata.NAME}</span><br /><span class="gensmall">{xdata.DESCRIPTION}</span>
      </td>
      <td class="row2">
         <!-- BEGIN options -->
         <input type="radio" name="{xdata.CODE_NAME}" value="{xdata.switch_type_radio.options.OPTION}" {xdata.switch_type_radio.options.checked} />
         <span class="gen">{xdata.switch_type_radio.options.OPTION}</span><br />
         <!-- END options -->
      </td>
    </tr>
    <!-- END switch_type_radio -->
<!-- END xdata -->
    <tr>
      <td class="catSides" colspan="2" height="28">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="25" valign="middle">{L_PREFERENCES}</th>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_GLANCE_SHOW}</span></td>
      <td class="row2">{GLANCE_SHOW}</td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_HIDE_IMAGES}</span></td>
      <td class="row2">
        <input type="radio" name="hide_images" value="1" {hide_images_yes} />
        <span class="gen">{L_YES}</span>
        <input type="radio" name="hide_images" value="0" {hide_images_no} />
        <span class="gen">{L_NO}</span>
      </td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_PUBLIC_VIEW_EMAIL}:</span></td>
      <td class="row2">
        <input type="radio" name="viewemail" value="1" {view_email_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="viewemail" value="0" {view_email_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_HIDE_USER}:</span></td>
      <td class="row2">
        <input type="radio" name="hideonline" value="1" {hide_user_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="hideonline" value="0" {hide_user_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
	<tr>
	  <td class="row1"><span class="gen">{L_BIRTHDAY_DISPLAY}:</span></td>
	  <td class="row2"><span class="gen">
	    <select name="birthday_display">
	      <option value="{BIRTHDAY_ALL}"{birthday_all_selected}>{L_BIRTHDAY_ALL}</option>
	      <option value="{BIRTHDAY_DATE}"{birthday_date_selected}>{L_BIRTHDAY_YEAR}</option>
	      <option value="{BIRTHDAY_AGE}"{birthday_age_selected}>{L_BIRTHDAY_AGE}</option>
	      <option value="{BIRTHDAY_NONE}"{birthday_none_selected}>{L_BIRTHDAY_NONE}</option>
	    </select>
	  </td>
	</tr>
	<!-- BEGIN birthdays_greeting -->
	<tr>
	  <td class="row1"><span class="gen">{L_BDAY_SEND_GREETING}:</span><br /><span class="gensmall">{L_BDAY_SEND_GREETING_EXPLAIN}</span></td>
	  <td class="row2"><span class="gen">
		  <input type="radio" name="bday_greeting" value="0" {bday_none_enabled} /> {L_NONE}&nbsp;&nbsp;
		  <!-- BEGIN birthdays_email -->
		  <input type="radio" name="bday_greeting" value="{BDAY_EMAIL}" {bday_email_enabled} /> {L_EMAIL}&nbsp;&nbsp;
		  <!-- END birthdays_email -->
		  <!-- BEGIN birthdays_pm -->
		  <input type="radio" name="bday_greeting" value="{BDAY_PM}" {bday_pm_enabled} /> {L_PM}&nbsp;&nbsp;
		  <!-- END birthdays_pm -->
		  <!-- BEGIN birthdays_popup -->
		  <input type="radio" name="bday_greeting" value="{BDAY_POPUP}" {bday_popup_enabled} /> {L_POPUP}&nbsp;&nbsp;
		  <!-- END birthdays_popup -->
	  </span></td>
	</tr>
	<!-- END birthdays_greeting -->
    <tr>
      <td class="row1"><span class="gen">{L_NOTIFY_ON_REPLY}:</span><br />
        <span class="gensmall">{L_NOTIFY_ON_REPLY_EXPLAIN}</span></td>
      <td class="row2">
        <input type="radio" name="notifyreply" value="1" {notify_reply_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="notifyreply" value="0" {notify_reply_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_NOTIFY_ON_PRIVMSG}:</span></td>
      <td class="row2">
        <input type="radio" name="notifypm" value="1" {notify_pm_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="notifypm" value="0" {notify_pm_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <!-- Start add - Custom mass PM MOD -->
    <!-- BEGIN switch_can_disable_mass_pm -->
    <tr>
        <td class="row1"><span class="gen">{L_ENABLE_MASS_PM}:</span><br />
        <span class="gensmall">{L_ENABLE_MASS_PM_EXPLAIN}</span></td>
        <td class="row2">
        <input type="radio" name="allow_mass_pm" value="4" {allow_mass_pm_notify_checked}/>
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="allow_mass_pm" value="2" {allow_mass_pm_checked}/>
        <span class="gen">{L_NO}</span>&nbsp;&nbsp;
        <input type="radio" name="allow_mass_pm" value="0" {disable_mass_pm_checked}/>
        <span class="gen">{L_NO_MASS_PM}</span></td>
    </tr>
    <!-- END switch_can_disable_mass_pm -->

    <!-- BEGIN switch_can_not_disable_mass_pm -->
    <tr>
        <td class="row1"><span class="gen">{L_ENABLE_MASS_PM}:</span><br />
        <span class="gensmall">{L_ENABLE_MASS_PM_EXPLAIN}</span></td>
        <td class="row2">
        <input type="radio" name="allow_mass_pm" value="4" {allow_mass_pm_notify_checked}/>
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="allow_mass_pm" value="2" {allow_mass_pm_checked}/>
        <span class="gen">{L_NO}</span></td>
    </tr>
    <!-- END switch_can_not_disable_mass_pm -->
    <!-- End add - Custom mass PM MOD -->
    <tr>
      <td class="row1"><span class="gen">{L_POPUP_ON_PRIVMSG}:</span><br /><span class="gensmall">{L_POPUP_ON_PRIVMSG_EXPLAIN}</span></td>
      <td class="row2">
        <input type="radio" name="popup_pm" value="1" {popup_pm_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="popup_pm" value="0" {popup_pm_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_ALWAYS_ADD_SIGNATURE}:</span></td>
      <td class="row2">
        <input type="radio" name="attachsig" value="1" {always_add_signature_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="attachsig" value="0" {always_add_signature_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_BBCODE}:</span></td>
      <td class="row2">
        <input type="radio" name="allowbbcode" value="1" {always_allow_bbcode_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="allowbbcode" value="0" {always_allow_bbcode_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_HTML}:</span></td>
      <td class="row2">
        <input type="radio" name="allowhtml" value="1" {always_allow_html_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="allowhtml" value="0" {always_allow_html_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
	<!-- BEGIN birthday_optional -->
	<tr>
	  <td class="row1"><span class="gen">{L_BIRTHDAY}:</span></td>
	  <td class="row2">{BIRTHDAY_INTERFACE}</td>
	</tr>
	<!-- END birthday_optional -->
    <tr>
      <td class="row1"><span class="gen">{L_ALWAYS_ALLOW_SMILIES}:</span></td>
      <td class="row2">
        <input type="radio" name="allowsmilies" value="1" {always_allow_smilies_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="allowsmilies" value="0" {always_allow_smilies_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_SHOW_AVATARS}:</span></td>
      <td class="row2">
        <input type="radio" name="showavatars" value="1" {show_avatars_yes} />
        <span class="gen">{L_YES}</span>
        <input type="radio" name="showavatars" value="0" {show_avatars_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_SHOW_SIGNATURES}:</span></td>
      <td class="row2">
        <input type="radio" name="showsignatures" value="1" {show_signatures_yes} />
        <span class="gen">{L_YES}</span>
        <input type="radio" name="showsignatures" value="0" {show_signatures_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_NEWSLETTER}:</span></td>
      <td class="row2">
        <input type="radio" name="newsletter" value="1" {newsletter_yes} />
        <span class="gen">{L_YES}</span>&nbsp;&nbsp;
        <input type="radio" name="newsletter" value="0" {newsletter_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <!-- BEGIN force_word_wrapping -->
    <tr>
      <td class="row1"><span class="gen">{L_WORD_WRAP}:</span><br /><span class="gensmall">{L_WORD_WRAP_EXPLAIN}</span></td>
      <td class="row2"><span class="gensmall"><input type="text" name="user_wordwrap" value="{WRAP_ROW}" size="2" maxlength="2" class="post" /> {L_WORD_WRAP_EXTRA}</span></td>
    </tr>
    <!-- END force_word_wrapping -->
    <tr>
      <td class="row1"><span class="gen">{L_BOARD_LANGUAGE}:</span></td>
      <td class="row2"><span class="gensmall">{LANGUAGE_SELECT}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_BOARD_STYLE}:</span></td>
      <td class="row2"><span class="gensmall">{STYLE_SELECT}</span></td>
    </tr>
        <!-- Start replacement - Advanced time management MOD -->
    <tr>
        <td class="row1"><span class="gen">{L_TIME_MODE}:</span><br />
            <span class="gensmall">{L_TIME_MODE_TEXT}</span></td>
        <td class="row2">
            <span class="gen">{L_TIME_MODE_AUTO}</span><br />
            <input type="radio" name="time_mode" value="6" {time_mode_full_pc_checked}/>
        <span class="gen">{L_TIME_MODE_FULL_PC}</span>&nbsp;&nbsp;<br />
            <input type="radio" name="time_mode" value="4" {time_mode_server_pc_checked}/>
        <span class="gen">{L_TIME_MODE_SERVER_PC}</span>&nbsp;&nbsp;<br />
            <input type="radio" name="time_mode" value="3" {time_mode_full_server_checked}/>
            <span class="gen">{L_TIME_MODE_FULL_SERVER}</span>
            <br /><br />
            <span class="gen">{L_TIME_MODE_MANUAL}</span><br />
        <span class="gen">&nbsp;&nbsp;{L_TIME_MODE_DST}:</span><input type="radio" name="time_mode" value="1" {time_mode_manual_dst_checked}/><span class="gen">{L_YES}{L_TIME_MODE_DST_ON}</span>&nbsp;<input type="radio" name="time_mode" value="0" {time_mode_manual_checked}/><span class="gen">{L_NO}{L_TIME_MODE_DST_OFF}</span>&nbsp;<input type="radio" name="time_mode" value="2" {time_mode_server_switch_checked}/><span class="gen">{L_TIME_MODE_DST_SERVER}</span><br />
        <span class="gen">&nbsp;&nbsp;{L_TIME_MODE_DST_TIME_LAG}: </span><input type="text" name="dst_time_lag" value="{DST_TIME_LAG}" maxlength="3" size="3" class="post" /><span class="gen">{L_TIME_MODE_DST_MN}</span><br />
        <span class="gen">&nbsp;&nbsp;{L_TIME_MODE_TIMEZONE}: </span><span class="gensmall">{TIMEZONE_SELECT}</span></td>
    </tr>
        <!-- End replacement - Advanced time management MOD -->
    <tr>
      <td class="row1"><span class="gen">{L_DATE_FORMAT}:</span><br />
        <span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
      <td class="row2">
        <input type="text" name="dateformat" value="{DATE_FORMAT}" maxlength="14" class="post" />
      </td>
    </tr>
    <tr>
      <td class="catSides" colspan="2"><span class="cattitle">&nbsp;</span></td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="12" valign="middle">{L_QUICK_REPLY_PANEL}</th>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_SHOW_QUICK_REPLY}:</span></td>
      <td class="row2">{QUICK_REPLY_SELECT}</td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_QUICK_REPLY_MODE}:</span></td>
      <td class="row2">
        <input type="radio" name="quickreply_mode" value="0" {quick_reply_mode_basic} />
        <span class="gen">{L_QUICK_REPLY_MODE_BASIC}</span>&nbsp;&nbsp;
        <input type="radio" name="quickreply_mode" value="1" {quick_reply_mode_advanced} />
        <span class="gen">{L_QUICK_REPLY_MODE_ADVANCED}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="gen">{L_OPEN_QUICK_REPLY}:</span></td>
      <td class="row2">
        <input type="radio" name="open_quickreply" value="1" {open_quick_reply_yes} />
        <span class="gen">{L_YES}</span>
        <input type="radio" name="open_quickreply" value="0" {open_quick_reply_no} />
        <span class="gen">{L_NO}</span></td>
    </tr>
    <!-- BEGIN switch_avatar_block -->
    <tr>
      <td class="catSides" colspan="2" height="28">&nbsp;</td>
    </tr>
    <tr>
      <th class="thSides" colspan="2" height="12" valign="middle">{L_AVATAR_PANEL}</th>
    </tr>
    <tr>
        <td class="row1" colspan="2"><table width="70%" cellspacing="2" cellpadding="0" border="0" align="center">
            <tr>
                <td width="65%"><span class="gensmall">{L_AVATAR_EXPLAIN}</span></td>
                <td align="center"><span class="gensmall">{L_CURRENT_IMAGE}</span><br />{AVATAR}<br /><input type="checkbox" name="avatardel" />&nbsp;<span class="gensmall">{L_DELETE_AVATAR}</span></td>
            </tr>
        </table></td>
    </tr>
    <!-- BEGIN switch_avatar_local_upload -->
    <tr>
        <td class="row1"><span class="gen">{L_UPLOAD_AVATAR_FILE}:</span></td>
        <td class="row2"><input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" /><input type="file" name="avatar" class="post" style="width:200px" /></td>
    </tr>
    <!-- END switch_avatar_local_upload -->
    <!-- BEGIN switch_avatar_remote_upload -->
    <tr>
        <td class="row1"><span class="gen">{L_UPLOAD_AVATAR_URL}:</span><br /><span class="gensmall">{L_UPLOAD_AVATAR_URL_EXPLAIN}</span></td>
        <td class="row2"><input type="text" name="avatarurl" size="40" class="post" style="width:200px" /></td>
    </tr>
    <!-- END switch_avatar_remote_upload -->
    <!-- BEGIN switch_avatar_remote_link -->
    <tr>
        <td class="row1"><span class="gen">{L_LINK_REMOTE_AVATAR}:</span><br /><span class="gensmall">{L_LINK_REMOTE_AVATAR_EXPLAIN}</span></td>
        <td class="row2"><input type="text" name="avatarremoteurl" size="40" class="post" style="width:200px" /></td>
    </tr>
    <!-- END switch_avatar_remote_link -->
    <!-- BEGIN switch_avatar_local_gallery -->
    <tr>
        <td class="row1"><span class="gen">{L_AVATAR_GALLERY}:</span></td>
        <td class="row2"><input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="liteoption" /></td>
    </tr>
    <!-- END switch_avatar_local_gallery -->
    <!-- END switch_avatar_block -->
    <tr>
        <td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
    </tr>
</table>

</form>