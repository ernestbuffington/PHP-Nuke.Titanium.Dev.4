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
      NukeSentinel                             v2.5.00      07/11/2006
      Evolution Functions                      v1.5.0       12/20/2005
-=[Mod]=-
      Finished Redirection                     v1.0.0       06/28/2003
      Welcome PM                               v2.0.0       07/22/2005
      XData                                    v0.1.1       08/09/2005
      Initial Usergroup                        v1.0.1       09/01/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ('You can\'t access this file directly...');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(!isset($_SESSION)) { session_start(); }

if (!isset($_SESSION['YA1']) || !isset($_SESSION['YA2'])) {
    global $debugger;
    $debugger->handle_error('Session not valid for user: Name - '.Fix_Quotes($ya_username).' Email - '.Fix_Quotes($femail), 'Error');
    redirect_titanium('modules.php?name='.$pnt_module.'&op=new_user');
}
unset($_SESSION['YA1']);
unset($_SESSION['YA2']);

include(NUKE_INCLUDE_DIR. 'constants.php');
include(NUKE_BASE_DIR. 'header.php');

/*****[BEGIN]******************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    define_once('XDATA', true);
    include_once(dirname(__FILE__).'/custom_functions.php');
/*****[END]********************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
    include_once(dirname(__FILE__).'/functions_welcome_pm.php');
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
    $ya_user_email = strtolower($ya_user_email);

//     if (GDSUPPORT AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 3 OR $ya_config['usegfxcheck'] == 4 OR $ya_config['usegfxcheck'] == 6)) {

    $pnt_user_regdate = date("M d, Y");
    if (!isset($stop)) {
        $ya_username = ya_fixtext($ya_username);
        $ya_user_email = ya_fixtext($ya_user_email);
        if ($result = $pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_users WHERE `username`='$ya_username' OR `user_email`='$ya_user_email'")) {
            if ($row = $pnt_db->sql_fetchrow($result)) {
                if (isset($row['username']) || isset($row['user_email'])) {
                    if ($row['username'] ==  $ya_username || $row['user_email'] == $ya_user_email) {
                        redirect_titanium("modules.php?name=$pnt_module");
                        exit;
                    }
                }
            }
        }
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $new_password = md5($user_password);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $realname = ya_fixtext($realname);
        $femail = ya_fixtext($femail);
        $pnt_user_website = check_html($pnt_user_website);
        if (!preg_match("#http://#i", $pnt_user_website) AND !empty($pnt_user_website)) { $pnt_user_website = "http://$pnt_user_website"; }
        $bio = str_replace("<br />", "\r\n", $bio);
        $bio = ya_fixtext($bio);
        $pnt_user_sig = str_replace("<br />", "\r\n", $pnt_user_sig);
        $pnt_user_sig = ya_fixtext($pnt_user_sig);
        $pnt_user_occ = ya_fixtext($pnt_user_occ);
        $pnt_user_from = ya_fixtext($pnt_user_from);
        $pnt_user_interests = ya_fixtext($pnt_user_interests);
        $pnt_user_dateformat = ya_fixtext($pnt_user_dateformat);
        $newsletter = intval($newsletter);
        $pnt_user_viewemail = intval($pnt_user_viewemail);
        $pnt_user_allow_viewonline = intval($pnt_user_allow_viewonline);
        $pnt_user_timezone = intval($pnt_user_timezone);
/*****[BEGIN]******************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
        $xdata = array();
        $xd_meta = get_xd_metadata();
        foreach ($xd_meta as $name => $info)
        {
            if ( isset($HTTP_POST_VARS[$name]) && $info['handle_input'] )
            {
                $xdata[$name] = trim($HTTP_POST_VARS[$name]);
                $xdata[$name] = str_replace('<br />', "\n", $xdata[$name]);
            }
        }
/*****[END]********************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
        list($phpbb2_newest_uid) = $pnt_db->sql_fetchrow($pnt_db->sql_query("SELECT max(user_id) AS newest_uid FROM ".$pnt_user_prefix."_users"));
        if ($phpbb2_newest_uid == "-1") { $new_uid = 1; } else { $new_uid = $phpbb2_newest_uid+1; }
        $lv = time();
        $result = $pnt_db->sql_query("INSERT INTO ".$pnt_user_prefix."_users (user_id, name, username, user_email, user_avatar, user_regdate, user_viewemail, user_password, user_lang, user_lastvisit) VALUES ($new_uid, '$ya_username', '$ya_username', '$ya_user_email', 'gallery/blank.png', '$pnt_user_regdate', '0', '$new_password', '$language', '$lv')");

        if ((count($nfield) > 0) AND ($result)) {
          foreach ($nfield as $key => $var) {
              $pnt_db->sql_query("INSERT INTO ".$pnt_user_prefix."_cnbya_value (uid, fid, value) VALUES ('$new_uid', '$key','$nfield[$key]')");
          }
        }

    $pnt_db->sql_query("LOCK TABLES ".$pnt_user_prefix."_users WRITE");
    $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET user_avatar='gallery/blank.png', user_avatar_type='3', user_lang='$language', user_lastvisit='$lv', umode='nested' WHERE user_id='$new_uid'");

    $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET username='$ya_username', name='$realname', user_email='$ya_user_email', femail='$femail', user_website='$pnt_user_website', user_from='$pnt_user_from', user_occ='$pnt_user_occ', user_interests='$pnt_user_interests', newsletter='$newsletter', user_viewemail='$pnt_user_viewemail', user_allow_viewonline='$pnt_user_allow_viewonline', user_timezone='$pnt_user_timezone', user_dateformat='$pnt_user_dateformat', user_sig='$pnt_user_sig', bio='$bio', user_password='$new_password', user_regdate='$pnt_user_regdate' WHERE user_id='$new_uid'");

    $pnt_db->sql_query("UNLOCK TABLES");
    $sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
            VALUES ('', 'Personal User', '1', '0')";
    if ( !($result = $pnt_db->sql_query($sql)) )
    {
        DisplayError('Could not insert data into groups table<br />'.$sql);
    }

    $group_id = $pnt_db->sql_nextid();

    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
        VALUES ('$new_uid', '$group_id', '0')";
    if( !($result = $pnt_db->sql_query($sql)) )
    {
        DisplayError('Could not insert data into user_group table<br />'.$sql);
    }
/*****[BEGIN]******************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    foreach ($xdata as $code_name => $value)
    {
        set_user_xdata($new_uid, $code_name, $value);
    }
/*****[END]********************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    if(!$result) {
        OpenTable();
        echo _ADDERROR."<br />";
        CloseTable();
    } else {
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
        init_group($new_uid);
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
        if ($ya_config['servermail'] == 0) {
                $message = _WELCOMETO." $sitename ($nukeurl)!<br /><br />";
                $message .= _YOUUSEDEMAIL." $ya_user_email "._TOREGISTER." $sitename.<br /><br />";
                $message .= _FOLLOWINGMEM."<br />"._UNICKNAME." $ya_username<br />"._UPASSWORD." $user_password";
                $subject = _REGISTRATIONSUB;

                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'From: '.$adminmail,                    
                    'Reply-To: '.$adminmail,
                    'Return-Path: '.$adminmail
                );

                evo_phpmailer( $ya_user_email, $subject, $message, $headers );
            }
            title(_USERREGLOGIN);
            OpenTable();
            $result = $pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_users WHERE username='$ya_username' AND user_password='$new_password'");
            if ($pnt_db->sql_numrows($result) == 1) {
                $userinfo = $pnt_db->sql_fetchrow($result);
                yacookie($userinfo['user_id'],$userinfo['username'],$userinfo['user_password'],$userinfo['storynum'],$userinfo['umode'],$userinfo['uorder'],$userinfo['thold'],$userinfo['noscore'],$userinfo['ublockon'],$userinfo['theme'],$userinfo['commentmax']);
// menelaos: i wonder if this cookie is set correctly
// menelaos: refresh of location? The next line causes multiple accounts to be loaded into the database, this has to be fixed
//              echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=/modules.php?name=$pnt_module\">";
                echo "<center><strong>$userinfo[username]:</strong> "._ACTMSG2."</center>";
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
            if ($ya_config['sendaddmail'] == 1 AND $ya_config['servermail'] == 0) {
                // $from  = "From: $ya_user_email\n";
                // $from .= "Reply-To: $ya_user_email\n";
                // $from .= "Return-Path: $ya_user_email\n";
                // $subject = "$sitename - "._MEMADD;
                // $from_ip = $nsnst_const['remote_ip'];
                // $message = "$ya_username has been added to $sitename. from $from_ip<br />";
                // $message .= "-----------------------------------------------------------<br />";
                // $message .= _YA_NOREPLY;
                // evo_mail($adminmail, $subject, $message, $from);

                $subject = "$sitename - "._MEMACT;
                $from_ip = $nsnst_const['remote_ip'];
                $message  = "$ya_username has been added to $sitename "._YA_FROM." $from_ip<br />";
                $message .= "-----------------------------------------------------------<br />";
                $message .= _YA_NOREPLY;

                $headers = array(
                    'From: '.$ya_user_email,
                    'Content-Type: text/html; charset=UTF-8',
                    'Reply-To: '.$ya_user_email,
                    'Return-Path: '.$ya_user_email
                );

                evo_phpmailer( $adminmail, $subject, $message, $headers );
            }
/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
            send_pm($new_uid,$ya_username);
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
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
        }
    } else {
        echo $stop;
    }
    include(NUKE_BASE_DIR . 'footer.php');

?>