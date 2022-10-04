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
    $result = $pnt_db->sql_query("SELECT user_id, user_password, user_email FROM ".$pnt_user_prefix."_users WHERE username='$check'");
    $row = $pnt_db->sql_fetchrow($result);
    $vuid = $row['user_id'];
    $ccpass = $row['user_password'];
    $tuemail = strtolower($row['user_email']);
    $pnt_user_sig = str_replace("<br />", "\r\n", $pnt_user_sig);
    $pnt_user_sig = ya_fixtext($pnt_user_sig);
    $pnt_user_email = strtolower($pnt_user_email);
    $pnt_user_email = ya_fixtext($pnt_user_email);
    $femail = ya_fixtext($femail);
    $pnt_user_website = ya_fixtext($pnt_user_website);
    $bio = ya_fixtext($bio);
    $pnt_user_icq = ya_fixtext($pnt_user_icq);
    $pnt_user_aim = ya_fixtext($pnt_user_aim);
    $pnt_user_yim = ya_fixtext($pnt_user_yim);
    $pnt_user_msnm = ya_fixtext($pnt_user_msnm);
    $pnt_user_occ = ya_fixtext($pnt_user_occ);
    $pnt_user_from = ya_fixtext($pnt_user_from);
    $pnt_user_interests = ya_fixtext($pnt_user_interests);
    $realname = ya_fixtext($realname);
    $pnt_user_dateformat = ya_fixtext($pnt_user_dateformat);
    $newsletter = intval($newsletter);
    $pnt_user_viewemail = intval($pnt_user_viewemail);
    $pnt_user_allow_viewonline = intval($pnt_user_allow_viewonline);
    $pnt_user_timezone = intval($pnt_user_timezone);
    if ($ya_config['allowmailchange'] < 1) {
        if ($tuemail != $pnt_user_email) { ya_mailCheck($pnt_user_email); }
    }
    if ($user_password > "" OR $vpass > "") { ya_passCheck($user_password, $vpass); }

        $result = $pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_cnbya_field WHERE need = '3' ORDER BY pos");
        while ($sqlvalue = $pnt_db->sql_fetchrow($result)) {
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

    if (empty($stop) AND ($pnt_user_id == $vuid) AND ($check2 == $ccpass)) {
        if (!preg_match("#http://#i", $pnt_user_website) AND !empty($pnt_user_website)) {
            $pnt_user_website = "http://$pnt_user_website";
        }
        if ($bio) { filter_text($bio); $bio = $EditedMessage; $bio = Fix_Quotes($bio); }
        if (!empty($user_password)) {
            global $cookie;
            $pnt_db->sql_query("LOCK TABLES ".$pnt_user_prefix."_users, ".$pnt_user_prefix."_cnbya_value WRITE");
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $user_password = md5($user_password);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/

            if ( ($ya_config['emailvalidate'] == '0') OR ($tuemail == $pnt_user_email) ) {
                $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET name='$realname', user_email='$pnt_user_email', femail='$femail', user_website='$pnt_user_website', user_password='$user_password', bio='$bio', user_icq='$pnt_user_icq', user_occ='$pnt_user_occ', user_from='$pnt_user_from', user_interests='$pnt_user_interests', user_sig='$pnt_user_sig', user_aim='$pnt_user_aim', user_yim='$pnt_user_yim', user_msnm='$pnt_user_msnm', newsletter='$newsletter', user_viewemail='$pnt_user_viewemail', user_allow_viewonline='$pnt_user_allow_viewonline', user_notify='$pnt_user_notify', user_notify_pm='$pnt_user_notify_pm', user_popup_pm='$pnt_user_popup_pm', user_attachsig='$pnt_user_attachsig', user_allowbbcode='$pnt_user_allowbbcode', user_allowhtml='$pnt_user_allowhtml', user_allowsmile='$pnt_user_allowsmile', user_timezone='$pnt_user_timezone', user_dateformat='$pnt_user_dateformat' WHERE user_id='$pnt_user_id'");
            } else {
                $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET name='$realname', femail='$femail', user_website='$pnt_user_website', user_password='$user_password', bio='$bio', user_icq='$pnt_user_icq', user_occ='$pnt_user_occ', user_from='$pnt_user_from', user_interests='$pnt_user_interests', user_sig='$pnt_user_sig', user_aim='$pnt_user_aim', user_yim='$pnt_user_yim', user_msnm='$pnt_user_msnm', newsletter='$newsletter', user_viewemail='$pnt_user_viewemail', user_allow_viewonline='$pnt_user_allow_viewonline', user_notify='$pnt_user_notify', user_notify_pm='$pnt_user_notify_pm', user_popup_pm='$pnt_user_popup_pm', user_attachsig='$pnt_user_attachsig', user_allowbbcode='$pnt_user_allowbbcode', user_allowhtml='$pnt_user_allowhtml', user_allowsmile='$pnt_user_allowsmile', user_timezone='$pnt_user_timezone', user_dateformat='$pnt_user_dateformat' WHERE user_id='$pnt_user_id'");
                $datekey = date("F Y");
                $check_num = substr(md5(hexdec($datekey) * hexdec($cookie[2]) * hexdec($sitekey) * hexdec($pnt_user_email) * hexdec($tuemail)), 2, 10);
                $finishlink = "$nukeurl/modules.php?name=$pnt_module&op=changemail&id=$pnt_user_id&mail=$pnt_user_email&check_num=$check_num";
                $message .= _CHANGEMAIL1." $tuemail "._CHANGEMAIL2." $pnt_user_email"._CHANGEMAIL3." $sitename.<br /><br />";
                $message .= _CHANGEMAILFIN."<br /><br />$finishlink<br /><br />";
                $subject = _CHANGEMAILSUB;
                ya_mail($pnt_user_email, $subject, $message, '');
            }

            if (count($nfield) > 0) {
              foreach ($nfield as $key => $var) {
                  if (($pnt_db->sql_numrows($pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_cnbya_value WHERE fid='$key' AND uid = '$pnt_user_id'"))) == 0) {
                  $sql = "INSERT INTO ".$pnt_user_prefix."_cnbya_value (uid, fid, value) VALUES ('$pnt_user_id', '$key','$nfield[$key]')";
                  $pnt_db->sql_query($sql);
                }
                else {
                $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_cnbya_value SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$pnt_user_id'");
                }
              }
            }

            $sql = "SELECT * FROM ".$pnt_user_prefix."_users WHERE username='$pnt_username' AND user_password='$user_password'";
            $result = $pnt_db->sql_query($sql);
            if ($pnt_db->sql_numrows($result) == 1) {
                $userinfo = $pnt_db->sql_fetchrow($result);
                yacookie($userinfo[user_id],$userinfo[username],$userinfo[user_password],$userinfo[storynum],$userinfo[umode],$userinfo[uorder],$userinfo[thold],$userinfo[noscore],$userinfo[ublockon],$userinfo[theme],$userinfo[commentmax]);
            } else {
                echo "<center>"._SOMETHINGWRONG."</center><br />";
            }
            $pnt_db->sql_query("UNLOCK TABLES");
        } else {
            $pnt_db->sql_query("LOCK TABLES ".$pnt_user_prefix."_users,".$pnt_user_prefix."_cnbya_value WRITE");

        if ( ($ya_config['emailvalidate'] == '0') OR ($tuemail == $pnt_user_email) ) {
            $q = "UPDATE ".$pnt_user_prefix."_users SET name='$realname', user_email='$pnt_user_email', femail='$femail', user_website='$pnt_user_website', bio='$bio', user_icq='$pnt_user_icq', user_occ='$pnt_user_occ', user_from='$pnt_user_from', user_interests='$pnt_user_interests', user_sig='$pnt_user_sig', user_aim='$pnt_user_aim', user_yim='$pnt_user_yim', user_msnm='$pnt_user_msnm', newsletter='$newsletter', user_viewemail='$pnt_user_viewemail', user_allow_viewonline='$pnt_user_allow_viewonline', user_notify='$pnt_user_notify', user_notify_pm='$pnt_user_notify_pm', user_popup_pm='$pnt_user_popup_pm', user_attachsig='$pnt_user_attachsig', user_allowbbcode='$pnt_user_allowbbcode', user_allowhtml='$pnt_user_allowhtml', user_allowsmile='$pnt_user_allowsmile', user_timezone='$pnt_user_timezone', user_dateformat='$pnt_user_dateformat' WHERE user_id='$pnt_user_id'";
                $pnt_db->sql_query($q);
            } else {

                $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET name='$realname', femail='$femail', user_website='$pnt_user_website', bio='$bio', user_icq='$pnt_user_icq', user_occ='$pnt_user_occ', user_from='$pnt_user_from', user_interests='$pnt_user_interests', user_sig='$pnt_user_sig', user_aim='$pnt_user_aim', user_yim='$pnt_user_yim', user_msnm='$pnt_user_msnm', newsletter='$newsletter', user_viewemail='$pnt_user_viewemail', user_allow_viewonline='$pnt_user_allow_viewonline', user_notify='$pnt_user_notify', user_notify_pm='$pnt_user_notify_pm', user_popup_pm='$pnt_user_popup_pm', user_attachsig='$pnt_user_attachsig', user_allowbbcode='$pnt_user_allowbbcode', user_allowhtml='$pnt_user_allowhtml', user_allowsmile='$pnt_user_allowsmile', user_timezone='$pnt_user_timezone', user_dateformat='$pnt_user_dateformat' WHERE user_id='$pnt_user_id'");
                $datekey = date("F Y");
                $check_num = substr(md5(hexdec($datekey) * hexdec($cookie[2]) * hexdec($sitekey) * hexdec($pnt_user_email) * hexdec($tuemail)), 2, 10);

                $finishlink = "$nukeurl/modules.php?name=$pnt_module&op=changemail&id=$pnt_user_id&mail=$pnt_user_email&check_num=$check_num";
                $message .= _CHANGEMAIL1." $tuemail "._CHANGEMAIL2." $pnt_user_email"._CHANGEMAIL3." $sitename.<br /><br />";
                $message .= _CHANGEMAILFIN."<br /><br />$finishlink<br /><br />";
                $subject = _CHANGEMAILSUB;
                ya_mail($pnt_user_email, $subject, $message, '');
        }

        if (count($nfield) > 0) {
                 foreach ($nfield as $key => $var) {
                  if (($pnt_db->sql_numrows($pnt_db->sql_query("SELECT * FROM ".$pnt_user_prefix."_cnbya_value WHERE fid='$key' AND uid = '$pnt_user_id'"))) == 0) {
                      $sql = "INSERT INTO ".$pnt_user_prefix."_cnbya_value (uid, fid, value) VALUES ('$pnt_user_id', '$key','$nfield[$key]')";
                      $pnt_db->sql_query($sql);
                  }
                  else {
                  $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_cnbya_value SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$pnt_user_id'");
                  }
              }
        }

            $pnt_db->sql_query("UNLOCK TABLES");
        }
        redirect_titanium("modules.php?name=$pnt_module");
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
        echo "<span class='content'>$stop<br /><br />"._GOBACK."</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

?>