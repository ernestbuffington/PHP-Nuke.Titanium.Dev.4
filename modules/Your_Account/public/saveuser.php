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
      Evolution Functions                      v1.5.0       12/20/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    $stop = "";
    global $cookie;
    $check = $cookie[1];
    $check2 = $cookie[2];
    $result = $titanium_db->sql_query("SELECT user_id, user_password, user_email FROM ".$titanium_user_prefix."_users WHERE username='$check'");
    $row = $titanium_db->sql_fetchrow($result);
    $vuid = $row['user_id'];
    $ccpass = $row['user_password'];
    $tuemail = strtolower($row['user_email']);
    $titanium_user_sig = str_replace("<br />", "\r\n", $titanium_user_sig);
    $titanium_user_sig = ya_fixtext($titanium_user_sig);
    $titanium_user_email = strtolower($titanium_user_email);
    $titanium_user_email = ya_fixtext($titanium_user_email);
    $femail = ya_fixtext($femail);
    $titanium_user_website = ya_fixtext($titanium_user_website);
    $bio = ya_fixtext($bio);
    $titanium_user_icq = ya_fixtext($titanium_user_icq);
    $titanium_user_aim = ya_fixtext($titanium_user_aim);
    $titanium_user_yim = ya_fixtext($titanium_user_yim);
    $titanium_user_msnm = ya_fixtext($titanium_user_msnm);
    $titanium_user_occ = ya_fixtext($titanium_user_occ);
    $titanium_user_from = ya_fixtext($titanium_user_from);
    $titanium_user_interests = ya_fixtext($titanium_user_interests);
    $realname = ya_fixtext($realname);
    $titanium_user_dateformat = ya_fixtext($titanium_user_dateformat);
    $newsletter = intval($newsletter);
    $titanium_user_viewemail = intval($titanium_user_viewemail);
    $titanium_user_allow_viewonline = intval($titanium_user_allow_viewonline);
    $titanium_user_timezone = intval($titanium_user_timezone);
    if ($ya_config['allowmailchange'] < 1) {
        if ($tuemail != $titanium_user_email) { ya_mailCheck($titanium_user_email); }
    }
    if ($user_password > "" OR $vpass > "") { ya_passCheck($user_password, $vpass); }

        $result = $titanium_db->sql_query("SELECT * FROM ".$titanium_user_prefix."_cnbya_field WHERE need = '3' ORDER BY pos");
        while ($sqlvalue = $titanium_db->sql_fetchrow($result)) {
          $t = $sqlvalue[fid];
          if (empty($nfield[$t])) {
            include_once(NUKE_BASE_DIR.'header.php');
            opentable();
            if (substr($sqlvalue[name],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue[name];
            echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
            echo "<span class='content'>"._YA_FILEDNEED1."$name_exit"._YA_FILEDNEED2."<br /><br />"._GOBACK."</span></center>";
            closetable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
          };
        }

    if (empty($stop) AND ($titanium_user_id == $vuid) AND ($check2 == $ccpass)) {
        if (!preg_match("#http://#i", $titanium_user_website) AND !empty($titanium_user_website)) {
            $titanium_user_website = "http://$titanium_user_website";
        }
        if ($bio) { filter_text($bio); $bio = $EditedMessage; $bio = Fix_Quotes($bio); }
        if (!empty($user_password)) {
            global $cookie;
            $titanium_db->sql_query("LOCK TABLES ".$titanium_user_prefix."_users, ".$titanium_user_prefix."_cnbya_value WRITE");
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $user_password = md5($user_password);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/

            if ( ($ya_config['emailvalidate'] == '0') OR ($tuemail == $titanium_user_email) ) {
                $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET name='$realname', user_email='$titanium_user_email', femail='$femail', user_website='$titanium_user_website', user_password='$user_password', bio='$bio', user_icq='$titanium_user_icq', user_occ='$titanium_user_occ', user_from='$titanium_user_from', user_interests='$titanium_user_interests', user_sig='$titanium_user_sig', user_aim='$titanium_user_aim', user_yim='$titanium_user_yim', user_msnm='$titanium_user_msnm', newsletter='$newsletter', user_viewemail='$titanium_user_viewemail', user_allow_viewonline='$titanium_user_allow_viewonline', user_notify='$titanium_user_notify', user_notify_pm='$titanium_user_notify_pm', user_popup_pm='$titanium_user_popup_pm', user_attachsig='$titanium_user_attachsig', user_allowbbcode='$titanium_user_allowbbcode', user_allowhtml='$titanium_user_allowhtml', user_allowsmile='$titanium_user_allowsmile', user_timezone='$titanium_user_timezone', user_dateformat='$titanium_user_dateformat' WHERE user_id='$titanium_user_id'");
            } else {
                $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET name='$realname', femail='$femail', user_website='$titanium_user_website', user_password='$user_password', bio='$bio', user_icq='$titanium_user_icq', user_occ='$titanium_user_occ', user_from='$titanium_user_from', user_interests='$titanium_user_interests', user_sig='$titanium_user_sig', user_aim='$titanium_user_aim', user_yim='$titanium_user_yim', user_msnm='$titanium_user_msnm', newsletter='$newsletter', user_viewemail='$titanium_user_viewemail', user_allow_viewonline='$titanium_user_allow_viewonline', user_notify='$titanium_user_notify', user_notify_pm='$titanium_user_notify_pm', user_popup_pm='$titanium_user_popup_pm', user_attachsig='$titanium_user_attachsig', user_allowbbcode='$titanium_user_allowbbcode', user_allowhtml='$titanium_user_allowhtml', user_allowsmile='$titanium_user_allowsmile', user_timezone='$titanium_user_timezone', user_dateformat='$titanium_user_dateformat' WHERE user_id='$titanium_user_id'");
                $datekey = date("F Y");
                $check_num = substr(md5(hexdec($datekey) * hexdec($cookie[2]) * hexdec($sitekey) * hexdec($titanium_user_email) * hexdec($tuemail)), 2, 10);
                $finishlink = "$nukeurl/modules.php?name=$titanium_module_name&op=changemail&id=$titanium_user_id&mail=$titanium_user_email&check_num=$check_num";
                $message .= _CHANGEMAIL1." $tuemail "._CHANGEMAIL2." $titanium_user_email"._CHANGEMAIL3." $sitename.<br /><br />";
                $message .= _CHANGEMAILFIN."<br /><br />$finishlink<br /><br />";
                $subject = _CHANGEMAILSUB;
                ya_mail($titanium_user_email, $subject, $message, '');
            }

            if (count($nfield) > 0) {
              foreach ($nfield as $key => $var) {
                  if (($titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM ".$titanium_user_prefix."_cnbya_value WHERE fid='$key' AND uid = '$titanium_user_id'"))) == 0) {
                  $sql = "INSERT INTO ".$titanium_user_prefix."_cnbya_value (uid, fid, value) VALUES ('$titanium_user_id', '$key','$nfield[$key]')";
                  $titanium_db->sql_query($sql);
                }
                else {
                $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_cnbya_value SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$titanium_user_id'");
                }
              }
            }

            $sql = "SELECT * FROM ".$titanium_user_prefix."_users WHERE username='$titanium_username' AND user_password='$user_password'";
            $result = $titanium_db->sql_query($sql);
            if ($titanium_db->sql_numrows($result) == 1) {
                $userinfo = $titanium_db->sql_fetchrow($result);
                yacookie($userinfo[user_id],$userinfo[username],$userinfo[user_password],$userinfo[storynum],$userinfo[umode],$userinfo[uorder],$userinfo[thold],$userinfo[noscore],$userinfo[ublockon],$userinfo[theme],$userinfo[commentmax]);
            } else {
                echo "<center>"._SOMETHINGWRONG."</center><br />";
            }
            $titanium_db->sql_query("UNLOCK TABLES");
        } else {
            $titanium_db->sql_query("LOCK TABLES ".$titanium_user_prefix."_users,".$titanium_user_prefix."_cnbya_value WRITE");

        if ( ($ya_config['emailvalidate'] == '0') OR ($tuemail == $titanium_user_email) ) {
            $q = "UPDATE ".$titanium_user_prefix."_users SET name='$realname', user_email='$titanium_user_email', femail='$femail', user_website='$titanium_user_website', bio='$bio', user_icq='$titanium_user_icq', user_occ='$titanium_user_occ', user_from='$titanium_user_from', user_interests='$titanium_user_interests', user_sig='$titanium_user_sig', user_aim='$titanium_user_aim', user_yim='$titanium_user_yim', user_msnm='$titanium_user_msnm', newsletter='$newsletter', user_viewemail='$titanium_user_viewemail', user_allow_viewonline='$titanium_user_allow_viewonline', user_notify='$titanium_user_notify', user_notify_pm='$titanium_user_notify_pm', user_popup_pm='$titanium_user_popup_pm', user_attachsig='$titanium_user_attachsig', user_allowbbcode='$titanium_user_allowbbcode', user_allowhtml='$titanium_user_allowhtml', user_allowsmile='$titanium_user_allowsmile', user_timezone='$titanium_user_timezone', user_dateformat='$titanium_user_dateformat' WHERE user_id='$titanium_user_id'";
                $titanium_db->sql_query($q);
            } else {

                $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET name='$realname', femail='$femail', user_website='$titanium_user_website', bio='$bio', user_icq='$titanium_user_icq', user_occ='$titanium_user_occ', user_from='$titanium_user_from', user_interests='$titanium_user_interests', user_sig='$titanium_user_sig', user_aim='$titanium_user_aim', user_yim='$titanium_user_yim', user_msnm='$titanium_user_msnm', newsletter='$newsletter', user_viewemail='$titanium_user_viewemail', user_allow_viewonline='$titanium_user_allow_viewonline', user_notify='$titanium_user_notify', user_notify_pm='$titanium_user_notify_pm', user_popup_pm='$titanium_user_popup_pm', user_attachsig='$titanium_user_attachsig', user_allowbbcode='$titanium_user_allowbbcode', user_allowhtml='$titanium_user_allowhtml', user_allowsmile='$titanium_user_allowsmile', user_timezone='$titanium_user_timezone', user_dateformat='$titanium_user_dateformat' WHERE user_id='$titanium_user_id'");
                $datekey = date("F Y");
                $check_num = substr(md5(hexdec($datekey) * hexdec($cookie[2]) * hexdec($sitekey) * hexdec($titanium_user_email) * hexdec($tuemail)), 2, 10);

                $finishlink = "$nukeurl/modules.php?name=$titanium_module_name&op=changemail&id=$titanium_user_id&mail=$titanium_user_email&check_num=$check_num";
                $message .= _CHANGEMAIL1." $tuemail "._CHANGEMAIL2." $titanium_user_email"._CHANGEMAIL3." $sitename.<br /><br />";
                $message .= _CHANGEMAILFIN."<br /><br />$finishlink<br /><br />";
                $subject = _CHANGEMAILSUB;
                ya_mail($titanium_user_email, $subject, $message, '');
        }

        if (count($nfield) > 0) {
                 foreach ($nfield as $key => $var) {
                  if (($titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM ".$titanium_user_prefix."_cnbya_value WHERE fid='$key' AND uid = '$titanium_user_id'"))) == 0) {
                      $sql = "INSERT INTO ".$titanium_user_prefix."_cnbya_value (uid, fid, value) VALUES ('$titanium_user_id', '$key','$nfield[$key]')";
                      $titanium_db->sql_query($sql);
                  }
                  else {
                  $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_cnbya_value SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$titanium_user_id'");
                  }
              }
        }

            $titanium_db->sql_query("UNLOCK TABLES");
        }
        redirect_titanium("modules.php?name=$titanium_module_name");
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
        echo "<span class='content'>$stop<br /><br />"._GOBACK."</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

?>