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
      Finished Redirection                     v1.0.0       06/28/2005
      Initial Usergroup                        v1.0.1       09/06/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    $ya_username = trim(check_html($ya_username, 'nohtml'));
    $check_num = trim(check_html($check_num, 'nohtml'));
    $ya_time = intval($ya_time);
    $result = $pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_users_temp WHERE username='$ya_username' AND check_num='$check_num' AND time='$ya_time'");
    if ($pnt_db->sql_numrows($result) == 1) {
        $row = $pnt_db->sql_fetchrow($result);
        $pnt_username = $row['username'];
        $pnt_user_email = $row['user_email'];
        $pnt_user_regdate = $row['user_regdate'];
        $user_password = $row['user_password'];
        $realname = ya_fixtext($realname);
        if(empty($realname)) { $realname = $row['username']; }
        $pnt_user_sig = str_replace("<br />", "\r\n", $pnt_user_sig);
        $pnt_user_sig = ya_fixtext($pnt_user_sig);
        $pnt_user_email = ya_fixtext($pnt_user_email);
        $femail = ya_fixtext($femail);
        $pnt_user_website = ya_fixtext($pnt_user_website);
        if (!preg_match("#http://#i", $pnt_user_website) AND !empty($pnt_user_website)) { $pnt_user_website = "http://$pnt_user_website"; }
        $bio = str_replace("<br />", "\r\n", $bio);
        $bio = ya_fixtext($bio);
        $pnt_user_occ = ya_fixtext($pnt_user_occ);
        $pnt_user_from = ya_fixtext($pnt_user_from);
        $pnt_user_interests = ya_fixtext($pnt_user_interests);
        $pnt_user_dateformat = ya_fixtext($pnt_user_dateformat);
        $newsletter = intval($newsletter);
        $pnt_user_viewemail = intval($pnt_user_viewemail);
        $pnt_user_allow_viewonline = intval($pnt_user_allow_viewonline);
        $pnt_user_timezone = intval($pnt_user_timezone);
        list($latest_uid) = $pnt_db->sql_fetchrow($pnt_db->sql_query("SELECT max(user_id) AS latest_uid FROM ".$pnt_user_prefix."_users"));
        if ($latest_uid == "-1") { $new_uid = 1; } else { $new_uid = $latest_uid+1; }
        $lv = time();
        $pnt_db->sql_query("LOCK TABLES ".$pnt_user_prefix."_users WRITE");
        $pnt_db->sql_query("INSERT INTO ".$pnt_user_prefix."_users (user_id, user_avatar, user_avatar_type, user_lang, user_lastvisit, umode) VALUES ($new_uid, 'gallery/blank.png', '3', '$language', '$lv', 'nested')");
        $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET username='$pnt_username', name='$realname', user_email='$pnt_user_email', femail='$femail', user_website='$pnt_user_website', user_from='$pnt_user_from', user_occ='$pnt_user_occ', user_interests='$pnt_user_interests', newsletter='$newsletter', user_viewemail='$pnt_user_viewemail', user_allow_viewonline='$pnt_user_allow_viewonline', user_timezone='$pnt_user_timezone', user_dateformat='$pnt_user_dateformat', user_sig='$pnt_user_sig', bio='$bio', user_password='$user_password', user_regdate='$pnt_user_regdate' WHERE user_id='$new_uid'");
        $pnt_db->sql_query("UNLOCK TABLES");
        $pnt_db->sql_query("DELETE FROM ".$pnt_user_prefix."_users_temp WHERE username='$pnt_username'");

        $res = $pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_cnbya_value_temp WHERE uid = '$row[user_id]'");
        while ($sqlvalue = $pnt_db->sql_fetchrow($res)) {
         $pnt_db->sql_query("INSERT INTO ".$pnt_user_prefix."_cnbya_value (uid, fid, value) VALUES ('$new_uid', '$sqlvalue[fid]','$sqlvalue[value]')");
        }
        $pnt_db->sql_query("DELETE FROM ".$pnt_user_prefix."_cnbya_value_temp WHERE uid='$row[user_id]'");
        $pnt_db->sql_query("OPTIMIZE TABLE ".$pnt_user_prefix."_cnbya_value_temp");

        $pnt_db->sql_query("OPTIMIZE TABLE ".$pnt_user_prefix."_users_temp");
        include_once(NUKE_BASE_DIR.'header.php');
/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
        include('modules/Your_Account/public/functions_welcome_pm.php');
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
        title(""._ACTIVATIONYES."");
        OpenTable();
        $result = $pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_users WHERE username='$pnt_username' AND user_password='$user_password'");
        if ($pnt_db->sql_numrows($result) == 1) {
/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
            send_pm($new_uid,$ya_username);
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
            $userinfo = $pnt_db->sql_fetchrow($result);
            yacookie($userinfo['user_id'],$userinfo['username'],$userinfo['user_password'],$userinfo['storynum'],$userinfo['umode'],$userinfo['uorder'],$userinfo['thold'],$userinfo['noscore'],$userinfo['ublockon'],$userinfo['theme'],$userinfo['commentmax']);
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
            include('modules/Your_Account/public/custom_functions.php');
            init_group($new_uid);
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
            // CurtisH (clh@curtishancock.com <clh@curtishancock.com>)
            //echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=$nukeurl\">";
            //echo "<center><strong>$row[username]:</strong> "._ACTMSG2."</center>";
            echo "<meta http-equiv=\"refresh\" content=\"modules.php?name=Your_Account\">";
            echo "<center><strong>$row[username]:</strong> "._ACTMSG."</center>";
/*****[BEGIN]******************************************
 [ Mod:     Finished Redirection               v1.0.0 ]
 ******************************************************/
            $complete = 1;
/*****[END]********************************************
 [ Mod:     Finished Redirection               v1.0.0 ]
 ******************************************************/
        } else {
            echo "<center>"._SOMETHINGWRONG."</center><br />";
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
/*****[BEGIN]******************************************
 [ Mod:     Finished Redirection               v1.0.0 ]
 ******************************************************/
        if($complete) {
         header("Refresh: 3; URL=index.php");
         exit();
        }
/*****[END]********************************************
 [ Mod:     Finished Redirection               v1.0.0 ]
 ******************************************************/
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        title(""._ACTIVATIONERROR."");
        OpenTable();
        echo "<center>"._ACTERROR."</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }

?>