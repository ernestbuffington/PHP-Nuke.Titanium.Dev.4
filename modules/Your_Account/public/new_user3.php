<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Password Strength Meter                  v1.0.0       07/12/2005
      XData                                    v0.1.1       08/09/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(!isset($_SESSION)) { session_start(); }

unset($_SESSION['YA1']);
unset($_SESSION['YA2']);

$_SESSION['YA1'] = true;

function tz_select($default, $select_name = 'timezone')
{
        $lang['tz']['-12'] = 'GMT - 12 Hours';
        $lang['tz']['-11'] = 'GMT - 11 Hours';
        $lang['tz']['-10'] = 'GMT - 10 Hours';
        $lang['tz']['-9'] = 'GMT - 9 Hours';
        $lang['tz']['-8'] = 'GMT - 8 Hours';
        $lang['tz']['-7'] = 'GMT - 7 Hours';
        $lang['tz']['-6'] = 'GMT - 6 Hours';
        $lang['tz']['-5'] = 'GMT - 5 Hours';
        $lang['tz']['-4'] = 'GMT - 4 Hours';
        $lang['tz']['-3.5'] = 'GMT - 3.5 Hours';
        $lang['tz']['-3'] = 'GMT - 3 Hours';
        $lang['tz']['-2'] = 'GMT - 2 Hours';
        $lang['tz']['-1'] = 'GMT - 1 Hours';
        $lang['tz']['0'] = 'GMT';
        $lang['tz']['1'] = 'GMT + 1 Hour';
        $lang['tz']['2'] = 'GMT + 2 Hours';
        $lang['tz']['3'] = 'GMT + 3 Hours';
        $lang['tz']['3.5'] = 'GMT + 3.5 Hours';
        $lang['tz']['4'] = 'GMT + 4 Hours';
        $lang['tz']['4.5'] = 'GMT + 4.5 Hours';
        $lang['tz']['5'] = 'GMT + 5 Hours';
        $lang['tz']['5.5'] = 'GMT + 5.5 Hours';
        $lang['tz']['6'] = 'GMT + 6 Hours';
        $lang['tz']['6.5'] = 'GMT + 6.5 Hours';
        $lang['tz']['7'] = 'GMT + 7 Hours';
        $lang['tz']['8'] = 'GMT + 8 Hours';
        $lang['tz']['9'] = 'GMT + 9 Hours';
        $lang['tz']['9.5'] = 'GMT + 9.5 Hours';
        $lang['tz']['10'] = 'GMT + 10 Hours';
        $lang['tz']['11'] = 'GMT + 11 Hours';
        $lang['tz']['12'] = 'GMT + 12 Hours';
        $lang['tz']['13'] = 'GMT + 13 Hours';

        if ( !isset($default) )
        {
                $default == $sys_timezone;
        }
        $tz_select = '<select name="user_timezone">';

        while( list($offset, $zone) = @each($lang['tz']) )
        {
                $selected = ( $offset == $default ) ? ' selected="selected"' : '';
                $tz_select .= '<option value="' . $offset . '"' . $selected . '>' . str_replace('GMT', 'UTC', $zone) . '</option>';
        }
        $tz_select .= '</select>';

        return $tz_select;
}

/*****[BEGIN]******************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    define_once('XDATA', true);
    include_once(NUKE_MODULES_DIR.'Your_Account/public/custom_functions.php');
/*****[END]********************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    include_once(NUKE_BASE_DIR.'header.php');

    /**
     * Security Mod: IPHUB VPN & Proxy blocker
     * @since 2.0.9e
     */
    block_vpn_proxy_user();

    title(_USERREGLOGIN);
    OpenTable();
    echo "<form action='modules.php?name=$module_name' method='post' name='newuser'>\n";
    echo "<table style='margin:auto' cellpadding='3' cellspacing='3' border='0'>\n";
    echo "<tr><td align='center' bgcolor='$bgcolor1' colspan='2'><div class=\"textbold\">"._REGNEWUSER."</div></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._NICKNAME.":</div>"._REQUIRED."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_username' size='15' id='username_input' maxlength='".$ya_config['nick_max']."'>&nbsp;<span id=\"username_check_result\"></span>&nbsp;<span class='tiny'>"._REQUIRED."</span><br /><span class='tiny'>("._YA_NICKLENGTH.")</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._UREALNAME.":</div>"._OPTIONAL." </td><td bgcolor='$bgcolor1'><input type='text' name='ya_realname' size='40' maxlength='60'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._EMAIL.":</div>"._REQUIRED."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_email' size='40' maxlength='255'>&nbsp;<span class='tiny'>"._REQUIRED."</span></td></tr>\n";

    // menelaos: added configurable doublecheck email routine
    if ($ya_config['doublecheckemail']==1) {
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._RETYPEEMAIL.":</div></td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_email2' size='40' maxlength='255'></td></tr>\n";
    } else {
    echo "<input type='hidden' name='ya_user_email2' value='ya_user_email'>\n";
    }
	# start Nuke Honeypot
	if (file_exists('./includes/honeypot/hp_new_user1.php')) {
		include_once './includes/honeypot/hp_new_user1.php';
	}
    # end Nuke Honeypot

	if (file_exists('./includes/honeypot/hp_new_user1.php')) {
		include_once './includes/honeypot/hp_new_user1.php';
	}

    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE (need = '2') OR (need = '3') ORDER BY pos");
        while ($sqlvalue = $db->sql_fetchrow($result)) {
          $t = $sqlvalue[fid];
          $value2 = explode("::", $sqlvalue[value]);
          if (substr($sqlvalue[name],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue[name];
          if (count($value2) == 1) {
            echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
            echo "<input type='text' name='nfield[$t]' size='20' maxlength='$sqlvalue[size]'>\n";
            } else {
            echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
            echo "<select name='nfield[$t]'>\n";
                for ($i = 0; $i<count($value2); $i++) {
                echo "<option value=\"".trim($value2[$i])."\">".trim($value2[$i])."</option>\n";
                }
              echo "</select>";
          }
            if (($sqlvalue[need]) > 1) echo"&nbsp;<span class='tiny'>"._REQUIRED."</span>";
              echo "</td></tr>\n";
        }

    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._PASSWORD.":</div></td><td bgcolor='$bgcolor1'><input type='password' name='user_password' size='10' maxlength='".$ya_config['pass_max']."' onkeyup='chkpwd(newuser.user_password.value)' onblur='chkpwd(newuser.user_password.value)' onmouseout='chkpwd(newuser.user_password.value)'>";
/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
    echo "<table width='300' cellpadding='2' cellspacing='0' border='1' bgcolor='#EBEBEB' style='border-collapse: collapse;'><tr>
          <td height='18' id='td1' width='100' align='center'><div ID='div1'></div></td>
          <td height='18' id='td2' width='100' align='center'><div ID='div2'></div></td>
          <td height='18' id='td3' width='100' align='center'><div ID='div3'>"._PSM_NOTRATED."</div></td>
          <td height='18' id='td4' width='100' align='center'><div ID='div4'></div></td>
          <td height='18' id='td5' width='100' align='center'><div ID='div5'></div></td>
          </tr></table><div ID='divTEMP'></div>";
   echo _PSM_CLICK." <a href=\"javascript:strengthhelp()\">"._PSM_HERE."</a> "._PSM_HELP."<br />";
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
    echo "<span class='tiny'>("._BLANKFORAUTO.")</span><br /><span class='tiny'>("._YA_PASSLENGTH.")</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._RETYPEPASSWORD.":</div></td><td bgcolor='$bgcolor1'><input type='password' name='user_password2' size='10' maxlength='".$ya_config['pass_max']."'><br /><span class='tiny'>("._BLANKFORAUTO.")</span><br /><span class='tiny'>("._YA_PASSLENGTH.")</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._UFAKEMAIL.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='femail' size='40' maxlength='255'><br />"._EMAILPUBLIC."</td></tr>\n";
/*****[BEGIN]******************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    $xd_meta = get_xd_metadata();
    while ( list($code_name, $info) = each($xd_meta) )
    {
            if ($info['display_register'] == XD_DISPLAY_NORMAL && $info['signup'])
            {
                $value = isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : '';
                $length = ( $info['field_length'] > 0) ? ( $info['field_length'] ) : '';

                switch ($info['field_type'])
                {
                    case 'text':
                        $value = isset($xdata[$code_name]) ? str_replace('"', '&quot;', $xdata[$code_name]) : '';
                        $length = ( $info['field_length'] > 0) ? ( $info['field_length'] ) : '';
                        echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td>
                                <td bgcolor="'.$bgcolor1.'"><input type="text" class="post"style="width: 200px" name="'.$code_name.'" size="35" maxlength="'.$length .'" value="'.$value.'" /></td></tr>';
                        break;

                    case 'textarea':
                        echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td>
                                <td bgcolor="'.$bgcolor1.'"><textarea name="'.$code_name.'"style="width: 300px"  rows="6" cols="30" class="post">'.$value.'</textarea></td></tr>';
                        break;

                    case 'radio':
                        echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td><td bgcolor="'.$bgcolor1.'">';
                        while ( list( , $option) = each($info['values_array']) )
                        {
                            $select = ($xdata[$code_name] == $option) ? 'selected="selected"' : '';
                            echo '<input type="radio" name="'.$code_name.'" value="'.$option.'" '.$select.' /> <span class="gen">'.$option.'</span><br />';
                        }
                        echo '</td></tr>';
                        break;

                    case 'select':
                        echo '<tr><td bgcolor="'.$bgcolor2.'"><div class="textbold">'.$info['field_name'].':</div>'.$info['field_desc'].'</td><td bgcolor="'.$bgcolor1.'">';
                        echo '<select name="'.$code_name.'">';
                        while ( list( , $option) = each($info['values_array']) )
                        {
                            $select = ($xdata[$code_name] == $option) ? 'selected="selected"' : '';
                            echo '<option value="'.$option.'" '.$select.'>'.$option.'</option>';
                        }
                        echo '</select></td></tr>';
                        break;
                }
            }
            elseif ($info['display_register'] == XD_DISPLAY_ROOT)
            {
                switch ($code_name) {
                    case "icq":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YICQ.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_icq' size='30' maxlength='100'></td></tr>\n";
                    break;
                    case "aim":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YAIM.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_aim' size='30' maxlength='100'></td></tr>\n";
                    break;
                    case "msn":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YMSNM.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_msnm' size='30' maxlength='100'></td></tr>\n";
                    break;
                    case "yim":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YYIM.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_yim' size='30' maxlength='100'></td></tr>\n";
                    break;
                    case "website":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YOURHOMEPAGE.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_website' size='40' maxlength='255'></td></tr>\n";
                    break;
                    case "location":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YLOCATION.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_from' size='30' maxlength='100'></td></tr>\n";
                    break;
                    case "occupation":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YOCCUPATION.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_occ' size='30' maxlength='100'></td></tr>\n";
                    break;
                    case "interests":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._YINTERESTS.":</div>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_interests' size='30' maxlength='100'></td></tr>\n";
                    break;
                    case "signature":
                        echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._SIGNATURE.":</div>"._OPTIONAL."<br />"._NOHTML."</td><td bgcolor='$bgcolor1'><textarea cols='50' rows='5' name='user_sig'></textarea><br />"._255CHARMAX."</td></tr>\n";
                    break;
                }
            }
    }
/*****[END]********************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._RECEIVENEWSLETTER.":</div></td><td bgcolor='$bgcolor1'><select name='newsletter'><option value='1' selected>"._YES."</option><option value='0'>"._NO."</option></select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._ALWAYSSHOWEMAIL.":</div></td><td bgcolor='$bgcolor1'><select name='user_viewemail'><option value='1' selected>"._YES."</option><option value='0'>"._NO."</option></select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._HIDEONLINE.":</div></td><td bgcolor='$bgcolor1'><select name='user_allow_viewonline'><option value='0'>"._YES."</option><option value='1' selected>"._NO."</option></select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._FORUMSTIME.":</div></td><td bgcolor='$bgcolor1'>";
    global $board_config;
    echo tz_select($board_config['board_timezone'], 'timezone');
    echo "</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._FORUMSDATE.":</div>"._FORUMSDATEMSG."</td><td bgcolor='$bgcolor1'><input type='text' name='user_dateformat' value='D M d, Y g:i a' size='15' maxlength='14'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\">"._EXTRAINFO.":</div>"._OPTIONAL."<br />"._NOHTML."</td><td bgcolor='$bgcolor1'><textarea cols='50' rows='5' name='bio'></textarea><br />"._CANKNOWABOUT."</td></tr>\n";

    $gfxchk = array(3,4,6,7);
    $gfx = security_code($gfxchk, 'normal'); //Size - compact || normal
    if(!empty($gfx)) {
        echo "<tr><td bgcolor='$bgcolor2' colspan='2'><center>".$gfx."</center></td></tr>";
    }
    # start Nuke Honeypot
	if (file_exists('./includes/honeypot/hp_new_user2.php')) {
	include_once './includes/honeypot/hp_new_user2.php';
	}
	# end Nuke Honeypot	
    echo "<input type='hidden' name='op' value='new_confirm'>\n";
    echo "<tr><td align='right' bgcolor='$bgcolor1' colspan='2'><input type='submit' value='"._YA_CONTINUE."'></td></tr>\n";
    echo "</table></form>\n";
    echo "<br />\n";
    echo ""._COOKIEWARNING."<br />\n";
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
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

?>