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
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die ('Access Denied');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
include(NUKE_MODULES_DIR.$module_name.'/public/functions_welcome_pm.php');
include(NUKE_MODULES_DIR.$module_name.'/public/custom_functions.php');
include(NUKE_INCLUDE_DIR. 'constants.php');
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

if(is_mod_admin($module_name)) {

    if ($add_email != $add_email2) {
        include_once(NUKE_BASE_DIR.'header.php');
		OpenTable();
	    echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
        echo "<span class='content'>"._EMAILDIFFERENT."<br /><br />"._GOBACK."</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
    $add_email = strtolower($add_email);
    ya_userCheck($add_uname);
    ya_mailCheck($add_email);
    ya_passCheck($add_pass, $add_pass2);
    $add_name = ya_fixtext($realname);
    if(empty($add_name)) { $add_name = $add_uname; }
    $add_femail = ya_fixtext($add_femail);
    $add_url = check_html($add_url);
    if (!preg_match("#http://#i", $add_url) AND !empty($add_url)) { $add_url = "http://$add_url"; }
    $add_user_sig = str_replace("<br />", "\r\n", $add_user_sig);
    $add_user_sig = ya_fixtext($add_user_sig);
    $add_user_from = ya_fixtext($add_user_from);
    $add_user_occ = ya_fixtext($add_user_occ);
    $add_user_interest = ya_fixtext($add_user_interest);
    $add_user_viewemail = intval($add_user_viewemail);
    $add_newsletter = intval($add_newsletter);
    $user_points = intval($user_points);
    if (empty($stop)) {
        $user_password = $add_pass;
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $add_pass = md5($add_pass);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $user_regdate = date("M d, Y");
        list($newest_uid) = $db->sql_fetchrow($db->sql_query("SELECT max(user_id) AS newest_uid FROM ".$user_prefix."_users"));
        if ($newest_uid == "-1") { $new_uid = 1; } else { $new_uid = $newest_uid+1; }
        $sql = "INSERT INTO ".$user_prefix."_users ";
        $sql .= "(user_id, name, username, user_email, femail, user_website, user_regdate, user_from, user_occ, user_interests, user_viewemail, user_avatar, user_avatar_type, user_sig, user_password, newsletter, broadcast, popmeson";
        //if ($Version_Num > 6.9) { $sql .= ", points"; }
        $sql .= ") ";
        $sql .= "VALUES ('$new_uid', '$add_name', '$add_uname', '$add_email', '$add_femail', '$add_url', '$user_regdate', '$add_user_from', '$add_user_occ', '$add_user_intrest', '$add_user_viewemail', 'gallery/blank.png', '3', '$add_user_sig', '$add_pass', '$add_newsletter', '1', '0'";
        //if ($Version_Num > 6.9) { $sql .= ", '$add_points'"; }
        $sql .= ")";
        $result = $db->sql_query($sql);
        if (count($nfield) > 0) {
         foreach ($nfield as $key => $var) {
         $nfield[$key] = ya_fixtext($nfield[$key]);
           if (($db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_value WHERE fid='$key' AND uid = '$new_uid'"))) == 0) {
          $sql = "INSERT INTO ".$user_prefix."_cnbya_value (uid, fid, value) VALUES ('$new_uid', '$key','$nfield[$key]')";
          $db->sql_query($sql);
          }
          else {
            $db->sql_query("UPDATE ".$user_prefix."_cnbya_value SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$new_uid'");
          }
         }
        }

        if (!$result) {
            $pagetitle = ": "._USERADMIN;
            include_once(NUKE_BASE_DIR.'header.php');
			OpenTable();
	        echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
	        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	        CloseTable();
	        echo "<br />";
            title(_USERADMIN);
            OpenTable();
            echo "<center><strong>"._ERRORSQL."</strong></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            return;
        } else {
/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
            send_pm($new_uid, $add_uname);
            init_group($new_uid);
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
            if ($ya_config['servermail'] == 0) {
                $message = _WELCOMETO." $sitename!<br /><br />";
                $message .= _YOUUSEDEMAIL." ($add_email) "._TOREGISTER." $sitename.<br /><br />";
                $message .= _FOLLOWINGMEM."<br />"._UNICKNAME." $add_uname<br />"._UPASSWORD." $user_password";
                $subject = _ACCOUNTCREATED;
                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'From: '.$adminmail,                    
                    'Reply-To: '.$adminmail,
                    'Return-Path: '.$adminmail
                );
                phpmailer( $user_email, $subject, $message, $headers );
            }
            if (isset($min)) { $xmin = "&min=$min"; }
            if (isset($xop)) { $xxop = "&op=$xop"; }
            redirect("modules.php?name=$module_name&file=admin"."$xxop"."$xmin");
        }
    } else {
        $pagetitle = ": "._USERADMIN;
        include_once(NUKE_BASE_DIR.'header.php');
		OpenTable();
	    echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        title(_USERADMIN);
        amain();
        echo "<br />\n";
        OpenTable();
        echo "<strong>$stop</strong>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        return;
    }

}

?>