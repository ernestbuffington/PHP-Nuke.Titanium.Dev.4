<?php 
/*======================================================================= 
  PHP-Nuke Titanium : Enhanced and Advanced JOHN 3:16
 =======================================================================*/

/*======================================================================= 
  This is a re-write of new_user3.php from CNB Your Account
  Copyright (c) 2022 by Brandon Maintenance Management LLC
  PHP-Nuke Titanium https://www.php-nuke-titanium.86it.us/
  Contact Author: ernest.buffington@gmail.com
  
  Thank you Bob Marion, menelaos61, and Escudero for the concept and ideas!
  We will take it from here Bubba Dee

  This program is free software. You can redistribute it and/or modify         
  it under the terms of the GNU General Public License as published by         
  the Free Software Foundation; either version 2 of the License.               

 =======================================================================*/

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author(s): menelaos61, escudero@phpnuke.org.br                       */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account the official successor of NSN Your Account by Bob Marion     */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Password Strength Meter                  v4.0.3       07/12/2021
      XData                                    v4.0.3       07/12/2021
	  PHP 8.1 Patched                          v4.0.3       12/12/2022
-=[Last Updated]=-
      12/12/2022  4:33 am Ernest Allen Buffington
      12/12/2022 11:33 am Ernest Allen Buffington
 ************************************************************************/

if(!defined('MODULE_FILE')):
 die("You can't access this file directly...");
endif;

if(!defined('CNBYA')): 
 die('CNBYA protection');
endif;

if(!isset($_SESSION)): 
  session_start(); 
endif;

unset($_SESSION['YA1']);
unset($_SESSION['YA2']);

$_SESSION['YA1'] = true;

function tz_select($default, $select_name = 'timezone')
{
        $lang = [];
        $sys_timezone = null;
        $lang['tz']['-12']  = 'GMT - 12 Hours';
        $lang['tz']['-11']  = 'GMT - 11 Hours';
        $lang['tz']['-10']  = 'GMT - 10 Hours';
        $lang['tz']['-9']   = 'GMT - 9 Hours';
        $lang['tz']['-8']   = 'GMT - 8 Hours';
        $lang['tz']['-7']   = 'GMT - 7 Hours';
        $lang['tz']['-6']   = 'GMT - 6 Hours';
        $lang['tz']['-5']   = 'GMT - 5 Hours';
        $lang['tz']['-4']   = 'GMT - 4 Hours';
        $lang['tz']['-3.5'] = 'GMT - 3.5 Hours';
        $lang['tz']['-3']   = 'GMT - 3 Hours';
        $lang['tz']['-2']   = 'GMT - 2 Hours';
        $lang['tz']['-1']   = 'GMT - 1 Hours';
        $lang['tz']['0']    = 'GMT';
        $lang['tz']['1']    = 'GMT + 1 Hour';
        $lang['tz']['2']    = 'GMT + 2 Hours';
        $lang['tz']['3']    = 'GMT + 3 Hours';
        $lang['tz']['3.5']  = 'GMT + 3.5 Hours';
        $lang['tz']['4']    = 'GMT + 4 Hours';
        $lang['tz']['4.5']  = 'GMT + 4.5 Hours';
        $lang['tz']['5']    = 'GMT + 5 Hours';
        $lang['tz']['5.5']  = 'GMT + 5.5 Hours';
        $lang['tz']['6']    = 'GMT + 6 Hours';
        $lang['tz']['6.5']  = 'GMT + 6.5 Hours';
        $lang['tz']['7']    = 'GMT + 7 Hours';
        $lang['tz']['8']    = 'GMT + 8 Hours';
        $lang['tz']['9']    = 'GMT + 9 Hours';
        $lang['tz']['9.5']  = 'GMT + 9.5 Hours';
        $lang['tz']['10']   = 'GMT + 10 Hours';
        $lang['tz']['11']   = 'GMT + 11 Hours';
        $lang['tz']['12']   = 'GMT + 12 Hours';
        $lang['tz']['13']   = 'GMT + 13 Hours';

        if(!isset($default)):
          $default == $sys_timezone;
        endif;
        $tz_select = '<select name="user_timezone">';

		foreach($lang['tz'] as $offset => $zone):
          $selected = ( $offset == $default ) ? ' selected="selected"' : '';
          $tz_select .= '<option value="' . $offset . '"' . $selected . '>' . str_replace('GMT', 'UTC', (string) $zone) . '</option>';
        endforeach;
        $tz_select .= '</select>';

        return $tz_select;
}

    # Mod: XData v0.1.1 START
    define_once('XDATA', true);
    include_once(NUKE_MODULES_DIR.'Your_Account/public/custom_functions.php');
    # Mod: XData v0.1.1 END

    include_once(NUKE_BASE_DIR.'header.php');

    /**
	 * This was in Nuke Evolution - No real harm in keeping it!
     * Security Mod: IPHUB VPN & Proxy blocker
     * @since v2.0.9e of Nuke-Evolution
	 * I think CoRpSE was the fella who added this.
	 * It does not work 100% as I have logged in with a VPN numerous times.
     */
    block_vpn_proxy_user();

	OpenTable();

	print '<div align="center" style="padding-top:14px;">';
    print '</div>';
    
	echo '<form action="modules.php?name='.$module_name.'" method="post" name="newuser">'.PHP_EOL;
	
    echo '<table class="rounded-corners" style="background-color: '.$bgcolor1.'; border: 0.1px solid '.$bgcolor3.'; padding: 1px 0.1px; margin:auto" cellpadding="4" cellspacing="4" border="1">'.PHP_EOL;
	
    echo '<tr><td style="background-color: '.$bgcolor1.'; border: 0.1px solid '.$bgcolor2.'; text-align: center; border-collapse: collapse;" colspan="2"><div align="center"><h1>'._REGNEWUSER.'</h1></div></td></tr>'.PHP_EOL;
	
    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._NICKNAME.':</div><span 
	     style="color: red; font-size: 13px; font-weight: bold; font-style: italic;">&nbsp;&nbsp;'._REQUIRED.'</span></td>
	     <td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="ya_username" size="15" id="username_input" 
		 maxlength='.$ya_config['nick_max'].'>&nbsp;<span id="username_check_result"></span>&nbsp;<span style="color: red; font-size: 13px; font-weight: bold; 
		 font-style: italic;">'._REQUIRED.'</span><br /><span style="color: '.$textcolor1.'; font-size: 13px; font-style: italic;">('._YA_NICKLENGTH.')</span></td></tr>'.PHP_EOL;

    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._UREALNAME.':</div><span style="color: lime; font-size: 13px; font-weight: bold; 
		 font-style: italic;">&nbsp;&nbsp;'._OPTIONAL.'</span> </td><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="ya_realname" 
		 size="40" maxlength="60"></td></tr>'.PHP_EOL;

    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._EMAIL.':</div><span style="color: red; font-size: 13px; font-weight: bold; 
		 font-style: italic;">&nbsp;&nbsp;'._REQUIRED.'</span></td><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="ya_user_email" size="40" 
		 maxlength="255">&nbsp;<span style="color: red; font-size: 13px; font-weight: bold; 
		 font-style: italic;">'._REQUIRED.'</span></td></tr>'.PHP_EOL;

    # menelaos: added configurable doublecheck email routine
    if($ya_config['doublecheckemail']==1): 
      echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._RETYPEEMAIL.':</div></td><td 
	  style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="ya_user_email2" size="40" maxlength="255"></td></tr>'.PHP_EOL;
	else: 
      echo '<input type="hidden" name="ya_user_email2" value="ya_user_email">'.PHP_EOL;
    endif;

	# Nuke Honeypot - CoRpSE START
	# CoRpSE had this loading twice and I removed one of them...
	if(file_exists('./includes/honeypot/hp_new_user1.php')):
	  include_once './includes/honeypot/hp_new_user1.php';
	endif;
    # Nuke Honeypot - CoRpSE END

    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE (need = '2') OR (need = '3') ORDER BY pos");
	
    while ($sqlvalue = $db->sql_fetchrow($result)): 
	
      $t = $sqlvalue[\FID];
      $value2 = explode("::", (string) $sqlvalue[\VALUE]);
        
		if(substr((string) $sqlvalue[\NAME],0,1)=='_'): 
		  eval( "\$name_exit = $sqlvalue[name];"); 
		else: 
		  $name_exit = $sqlvalue[\NAME];
        endif;    
			
		  if(count($value2) == 1): 
		  
              echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';">'.$name_exit.'</td><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';">'.PHP_EOL;
              echo '<input type="text" name="nfield[$t]" size="20" maxlength="'.$sqlvalue[size].'">'.PHP_EOL;
           
		  else: 
		  
              echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';">'.$name_exit.'</td><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';">'.PHP_EOL;
              echo '<select name="nfield[$t]">'.PHP_EOL;
                
				for($i = 0; $i<count($value2); $i++): 
                  echo '<option value="'.trim($value2[$i]).'">'.trim($value2[$i]).'</option>'.PHP_EOL;
                endfor;
                echo '</select>'.PHP_EOL;

          endif;
            
			if(($sqlvalue[\NEED]) > 1): 
			  echo '&nbsp;<span class="tiny">'._REQUIRED.'</span>'.PHP_EOL;
			endif;
            
			echo '</td></tr>'.PHP_EOL;
    
	endwhile;

    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.'; padding-top: 4; vertical-align: top;"><div class="textbold">&nbsp;&nbsp;'._PASSWORD.':</div></td><td 
	style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="password" name="user_password" size="10" maxlength="'.$ya_config['pass_max'].'" 
	onkeyup="chkpwd(newuser.user_password.value)" onblur="chkpwd(newuser.user_password.value)" onmouseout="chkpwd(newuser.user_password.value)">'.PHP_EOL;
    
	# Mod: Password Strength Meter v1.0.0 START
    echo '<table style="background-color: red; border-collapse: collapse;" width="300" cellpadding="2" cellspacing="0" border="1"><tr>
          <td height="18" id="td1" width="100"><div align="center" ID="div1"></div></td>
          <td height="18" id="td2" width="100"><div align="center" ID="div2"></div></td>
          <td height="18" id="td3" width="100"><div align="center" ID="div3">'._PSM_NOTRATED.'</div></td>
          <td height="18" id="td4" width="100"><div align="center" ID="div4"></div></td>
          <td height="18" id="td5" width="100"><div align="center" ID="div5"></div></td>
          </tr></table><div ID="divTEMP"></div>'.PHP_EOL;
		  
    //THIS WAS OVERKILL SO WE REMOVED IT - PEOPLE ARE SMART ENOUGH TO MAKE A PASSWORD!
	//echo _PSM_CLICK." <a href=\"javascript:strengthhelp()\">"._PSM_HERE."</a> "._PSM_HELP."<br />";
	# Mod: Password Strength Meter v1.0.0 END

    echo '<span style="color: '.$textcolor1.'; font-size: 13px; font-style: italic;">('._BLANKFORAUTO.')</span><br /><span style="color: '.$textcolor1.'; font-size: 13px; 
	     font-style: italic;">('._YA_PASSLENGTH.')</span></td></tr>'.PHP_EOL;
	
    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.'; padding-top: 4; vertical-align: top;"><div class="textbold">&nbsp;&nbsp;'._RETYPEPASSWORD.':</div></td><td 
	style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="password" name="user_password2" size="10" maxlength="'.$ya_config['pass_max'].'"><br /><span 
	style="color: '.$textcolor1.'; font-size: 13px; font-style: italic;">('._BLANKFORAUTO.')</span><br /><span style="color: '.$textcolor1.'; font-size: 13px; font-style: italic;">('._YA_PASSLENGTH.')</span></td></tr>'.PHP_EOL;

	echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._UFAKEMAIL.':</div><span style="color: lime; font-size: 13px; font-weight: bold; 
		 font-style: italic;">&nbsp;&nbsp;'._OPTIONAL.'</span></td><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="femail" size="40" 
		 maxlength="255"><br /><span style="color: '.$textcolor1.'; font-size: 13px; font-style: italic;">'._EMAILPUBLIC.'</span></td></tr>'.PHP_EOL;

	# Mod: XData v0.1.1 START
    $xd_meta = get_xd_metadata();
    foreach($xd_meta as $code_name => $info): 
	
        if($info['display_register'] == XD_DISPLAY_NORMAL && $info['signup']):
        
            $value = isset($xdata[$code_name]) ? str_replace('"', '&quot;', (string) $xdata[$code_name]) : ''.PHP_EOL;
            $length = ( $info['field_length'] > 0) ? ( $info['field_length'] ) : ''.PHP_EOL;

            switch($info['field_type']):
            
                case 'text':
                    $value = isset($xdata[$code_name]) ? str_replace('"', '&quot;', (string) $xdata[$code_name]) : ''.PHP_EOL;
                    $length = ( $info['field_length'] > 0) ? ( $info['field_length'] ) : ''.PHP_EOL;
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td>
                          <td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" class="post"style="width: 200px" name="'.$code_name.'" 
						  size="35" maxlength="'.$length .'" value="'.$value.'" /></td></tr>'.PHP_EOL;
                    break;

                case 'textarea':
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td>
                          <td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><textarea name="'.$code_name.'"style="width: 300px"  
						  rows="6" cols="30" class="post">'.$value.'</textarea></td></tr>'.PHP_EOL;
                    break;

                case 'radio':
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td><td 
					      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';">'.PHP_EOL;
                    
					foreach ($info['values_array'] as $option):
                      $select = ($xdata[$code_name] == $option) ? 'selected="selected"' : ''.PHP_EOL;
                      echo '<input type="radio" name="'.$code_name.'" value="'.$option.'" '.$select.' /> <span class="gen">'.$option.'</span><br />'.PHP_EOL;
                    endforeach;
                    
					echo '</td></tr>';
                    break;

                case 'select':
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td><td 
					      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';">'.PHP_EOL;
                    
					echo '<select name="'.$code_name.'">'.PHP_EOL;
                    
					foreach($info['values_array'] as $option):
                        $select = ($xdata[$code_name] == $option) ? 'selected="selected"' : ''.PHP_EOL;
                        echo '<option value="'.$option.'" '.$select.'>'.$option.'</option>'.PHP_EOL;
                    endforeach;
					
                    echo '</select></td></tr>';
                    break;
            endswitch;
        
        elseif($info['display_register'] == XD_DISPLAY_ROOT):
        
            switch($code_name):
				case "website":
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._YOURHOMEPAGE.':</div><span 
					      style="color: lime; font-size: 13px; font-weight: bold; font-style: italic;">&nbsp;&nbsp;'._OPTIONAL.'</span></td><td 
					      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="user_website" size="40" maxlength="255"></td></tr>'.PHP_EOL;
                break;
                case "location":
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._YLOCATION.':</div><span 
					      style="color: lime; font-size: 13px; font-weight: bold; font-style: italic;">&nbsp;&nbsp;'._OPTIONAL.'</span></td><td 
					      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="user_from" size="30" maxlength="100"></td></tr>'.PHP_EOL;
                break;
                case "occupation":
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._YOCCUPATION.':</div><span 
					      style="color: lime; font-size: 13px; font-weight: bold; font-style: italic;">&nbsp;&nbsp;'._OPTIONAL.'</span></td><td 
					      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="user_occ" size="30" maxlength="100"></td></tr>'.PHP_EOL;
                break;
                case "interests":
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._YINTERESTS.':</div><span 
					      style="color: lime; font-size: 13px; font-weight: bold; font-style: italic;">&nbsp;&nbsp;'._OPTIONAL.'</span></td><td 
					      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="user_interests" size="30" maxlength="100"></td></tr>'.PHP_EOL;
                break;
                case "signature":
                    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._SIGNATURE.':</div><span 
					      style="color: lime; font-size: 13px; font-weight: bold; font-style: italic;">&nbsp;&nbsp;'._OPTIONAL.'</span><br />&nbsp;&nbsp;'._NOHTML.'</td><td 
					      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><textarea cols="50" rows="5" name="user_sig"></textarea><br /><span 
						  style="color: '.$textcolor1.'; font-size: 13px; font-style: italic;">'._255CHARMAX.'</span></td></tr>'.PHP_EOL;
                break;
            endswitch;
        endif;
    endforeach;
	# Mod: XData v0.1.1 END

    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._RECEIVENEWSLETTER.':</div></td><td 
	      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><select name="newsletter"><option value="1" selected>'._YES.'</option><option 
		  value="0">'._NO.'</option></select></td></tr>'.PHP_EOL;

    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._ALWAYSSHOWEMAIL.':</div></td><td 
	      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><select name="user_viewemail"><option value="1" selected>'._YES.'</option><option value="0">'._NO.'</option></select></td></tr>'.PHP_EOL;

    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._HIDEONLINE.':</div></td><td 
	      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><select name="user_allow_viewonline"><option value="0">'._YES.'</option><option 
		  value="1" selected>'._NO.'</option></select></td></tr>'.PHP_EOL;

    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._FORUMSTIME.':</div></td><td 
	      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';">'.PHP_EOL;
	global $board_config;
    echo tz_select($board_config['board_timezone'], 'timezone');
    echo "</td></tr>\n";
	
	echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._FORUMSDATE.':</div></td><td 
	      style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><input type="text" name="user_dateformat" 
	      value="D M d, Y g:i a" size="15" maxlength="14">'._FORUMSDATEMSG.'</td></tr>'.PHP_EOL;
	
    echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><div class="textbold">&nbsp;&nbsp;'._EXTRAINFO.':</div>&nbsp;
	     <span style="color: lime; font-weight: bold; font-size: 13px; font-style: italic;">'._OPTIONAL.'</span><br />&nbsp;&nbsp;'._NOHTML.'</td><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';"><textarea cols="50" rows="5" name="bio"></textarea><br />
		 <span style="color: '.$textcolor1.'; font-size: 13px; font-style: italic;">'._CANKNOWABOUT.'</span></td></tr>'.PHP_EOL;

    $gfxchk = [3, 4, 6, 7];
    $gfx = security_code($gfxchk, 'normal'); //Size - compact || normal
    
	if(!empty($gfx)): 
        echo '<tr><td style="background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';" colspan="2"><div align="center">'.$gfx.'</div></td></tr>'.PHP_EOL;
    endif;

	# Nuke Honeypot - CoRpSE START
	if(file_exists('./includes/honeypot/hp_new_user2.php')):
	  include_once './includes/honeypot/hp_new_user2.php';
	endif;
    # Nuke Honeypot - CoRpSE END

    echo '<input type="hidden" name="op" value="new_confirm">'.PHP_EOL;
    echo '<tr><td style="text-align: center; background-color: '.$bgcolor2.'; border: 0.1px solid '.$bgcolor1.';" colspan="2"><input type="submit" value="'._YA_CONTINUE.'"></td></tr>'.PHP_EOL;
    echo '</table></form>'.PHP_EOL;
    
   	print '<div align="center" style="padding-top:4px;">';
    print '</div>';

	echo '<div align="center"><span style="color: red; font-size: 13px; font-style: italic;">'._COOKIEWARNING.'</span></div>'.PHP_EOL;

   	print '<div align="center" style="padding-top:4px;">';
    print '</div>';
    
    /*
	echo ""._ASREGUSER."<br />\n";
	echo "<ul>\n";
    echo "<li>"._ASREG1."\n";
    echo "<li>"._ASREG2."\n";
    echo "<li>"._ASREG3."\n";
    echo "<li>"._ASREG4."\n";
    echo "<li>"._ASREG5."\n";
    $handle=opendir('themes');
    while ($file = readdir($handle)) {
        if ((!preg_match("/[\.]/",$file) AND file_exists("themes/$file/theme.php"))) { $thmcount++; }
    }
    closedir($handle);
    if ($thmcount > 1) { echo "<li>"._ASREG6."\n"; }
    $sql = "SELECT custom_title FROM ".$prefix."_modules WHERE active='1' AND view='1' AND inmenu='1'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $custom_title = $row['custom_title'];
        if (!empty($custom_title)) { echo "<li>"._ACCESSTO." $custom_title\n"; }
    }
    $sql = "SELECT title FROM ".$prefix."_blocks WHERE active='1' AND view='1'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $b_title = $row['title'];
        if (!empty($b_title)) { echo "<li>"._ACCESSTO." $b_title\n"; }
    }
    if (is_active("Journal")) { echo "<li>"._CREATEJOURNAL."\n"; }
    if ($my_headlines == 1) { echo "<li>"._READHEADLINES."\n"; }
    echo "<li>"._ASREG7."\n";
    echo "</ul>\n";
    
	echo _REGISTERNOW."<br />\n";
    echo _WEDONTGIVE."<br /><br />\n";
    */
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

?>
