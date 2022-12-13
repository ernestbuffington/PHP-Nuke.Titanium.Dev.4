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
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion  */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Password Strength Meter                  v1.0.0       07/12/2005
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

    include_once(NUKE_BASE_DIR.'header.php');
    /**
     * Security Mod: IPHUB VPN & Proxy blocker
     * @since 2.0.9e
     */
    block_vpn_proxy_user();
    title(_USERAPPLOGIN);
    OpenTable();
	
	print '<div align="center" style="padding-top:14px;">';
    print '</div>';
	
    echo "<form action='modules.php?name=$module_name' method='post' name='newuser'>\n";
    echo "<table class=\"rounded-corners\" style='margin:auto' cellpadding='3' cellspacing='3' border='0'>\n";
    echo "<tr><td align='center' bgcolor='$bgcolor1' colspan='2'><div class=\"textbold\">"._REGNEWUSER."</div></td></tr>\n";
   
    echo '<tr><td style="background-color: '.$bgcolor1.';">&nbsp;</td>'.PHP_EOL;
	echo '<td style="background-color: '.$bgcolor1.';">&nbsp;</td></tr>'.PHP_EOL;   
    
	echo "<tr><td style=\"background-color: $bgcolor2;\"><div class=\"textbold\">"._NICKNAME.":</div>"._REQUIRED."</td><td style=\"background-color: $bgcolor1;\"><input type='text' name='ya_username' id='username_input' size='15' maxlength='".$ya_config['nick_max']."'>&nbsp;<span id=\"username_check_result\"></span><br /><span class='tiny'>("._YA_NICKLENGTH.")</span></td></tr>\n";
// menelaos: by request: added realname to the registration form
    echo "<tr><td style=\"background-color: $bgcolor2;\"><div class=\"textbold\">"._UREALNAME.":</div>"._OPTIONAL."</td><td style=\"background-color: $bgcolor1;\"><input type='text' name='ya_realname' size='40' maxlength='60'><br /><span class='tiny'>"._YA_REALNAMENOTE."</span></td></tr>\n";

    echo "<tr><td style=\"background-color: $bgcolor2;\"><div class=\"textbold\">"._EMAIL.":</div>"._REQUIRED."</td><td style=\"background-color: $bgcolor1;\"><input type='text' name='ya_user_email' size='40' maxlength='255'>&nbsp;<span class='tiny'></span></td></tr>\n";

    // menelaos: added configurable doublecheck email routine
    if ($ya_config['doublecheckemail']==1) {
    echo "<tr><td style=\"background-color: $bgcolor2;\"><div class=\"textbold\">"._RETYPEEMAIL.":</div></td><td style=\"background-color: $bgcolor1;\"><input type='text' name='ya_user_email2' size='40' maxlength='255'></td></tr>\n";
    } else {
    echo "<input type='hidden' name='ya_user_email2' value='ya_user_email'>\n";
    }
	# start Nuke Honeypot
	if (file_exists('./includes/honeypot/hp_new_user1.php')) {
		include_once './includes/honeypot/hp_new_user1.php';
	}
    # end Nuke Honeypot

    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE (need = '2') OR (need = '3') ORDER BY pos");
        while ($sqlvalue = $db->sql_fetchrow($result)) {
          $t = $sqlvalue['fid'];
          $value2 = explode("::", (string) $sqlvalue['value']);
          if (substr((string) $sqlvalue['name'],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue['name'];
          if (count($value2) == 1) {
            echo "<tr><td style=\"background-color: $bgcolor2;\">$name_exit</td><td style=\"background-color: $bgcolor3;\">";
            echo "<input type='text' name='nfield[$t]' size='20' maxlength='$sqlvalue[size]'>\n";
            } else {
            echo "<tr><td style=\"background-color: $bgcolor2;\">$name_exit</td><td style=\"background-color: $bgcolor3;\">";
            echo "<select name='nfield[$t]'>\n";
                for ($i = 0; $i<count($value2); $i++) {
                echo "<option value=\"".trim($value2[$i])."\">".trim($value2[$i])."</option>\n";
                }
              echo "</select>";
          }
            if (($sqlvalue['need']) > 1) echo"&nbsp;<span class='tiny'>"._REQUIRED."</span>";
              echo "</td></tr>\n";
        }
    echo "<tr><td style=\"vertical-align: top; background-color: $bgcolor2;\"><div class=\"textbold\">"._PASSWORD.":</div></td><td style=\"background-color: $bgcolor1;\"><input type='password' name='user_password' size='10' maxlength='".$ya_config['pass_max']."' onkeyup='chkpwd(newuser.user_password.value)' onblur='chkpwd(newuser.user_password.value)' onmouseout='chkpwd(newuser.user_password.value)'>";
/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
    echo "<table width='300' cellpadding='2' cellspacing='0' border='1' bgcolor='#EBEBEB' style='border-collapse: collapse;'><tr>
          <td id='td1' width='100' align='center'><div ID='div1'></div></td>
          <td id='td2' width='100' align='center'><div ID='div2'></div></td>
          <td id='td3' width='100' align='center'><div ID='div3'>"._PSM_NOTRATED."</div></td>
          <td id='td4' width='100' align='center'><div ID='div4'></div></td>
          <td id='td5' width='100' align='center'><div ID='div5'></div></td>
          </tr></table><div ID='divTEMP'></div>";
   echo _PSM_CLICK." <a href=\"javascript:strengthhelp()\">"._PSM_HERE."</a> "._PSM_HELP."<br />";
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
    echo "<br /><span class='tiny'>("._BLANKFORAUTO.")</span><br /><span class='tiny'>("._YA_PASSLENGTH.")</span></td></tr>\n";
    echo "<tr><td style=\"vertical-align: top; background-color: $bgcolor2;\"><div class=\"textbold\">"._RETYPEPASSWORD.":</div></td><td style=\"background-color: $bgcolor1;\"><input type='password' name='user_password2' size='10' maxlength='".$ya_config['pass_max']."'><br /><span class='tiny'>("._BLANKFORAUTO.")</span><br /><span class='tiny'>("._YA_PASSLENGTH.")</span></td></tr>\n";
    
	$gfxchk = [3, 4, 6, 7];
    
	$gfx = security_code($gfxchk, 'normal'); //Size - compact || normal
    
	if(!empty($gfx)) {
        echo "<tr><td style=\"background-color: $bgcolor2;\" colspan='2' style='text-align:center;'><div align=\"center\">".$gfx."</div></td></tr>";
    }
	
	# start Nuke Honeypot
	if (file_exists('./includes/honeypot/hp_new_user2.php')) {
	include_once './includes/honeypot/hp_new_user2.php';
	}
	# end Nuke Honeypot	
    echo "<input type='hidden' name='op' value='new_confirm'>\n";
    echo "<tr><td align='right' style=\"background-color: $bgcolor1;\" colspan='2'><input type='submit' value='"._YA_CONTINUE."'></td></tr>\n";
    echo "</table></form>\n";
    echo "<br />\n";
    echo _WAITAPPROVAL."<br /><br />\n";
    echo _COOKIEWARNING."<br />\n";
    
	/*
	echo _ASREGUSER."<br />\n";
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
