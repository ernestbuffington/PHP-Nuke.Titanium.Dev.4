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
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    include_once(NUKE_BASE_DIR.'header.php');
    $ya_user_email = strtolower($ya_user_email);
    ya_userCheck($ya_username);
    ya_mailCheck($ya_user_email);
    $user_regdate = date("M d, Y");
    if (!isset($stop)) {
        $datekey    = date("F j");
        $rcode    = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
        $code    = substr($rcode, 2, $ya_config['codesize']);

        if (GDSUPPORT AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 3 OR $ya_config['usegfxcheck'] == 4 OR $ya_config['usegfxcheck'] == 6)) {

            redirect("modules.php?name=$module_name");
            exit;
        }
        //mt_srand ((double)microtime()*1000000);
		mt_srand(0, MT_RAND_MT19937);
        $maxran    = 1000000;
        $check_num    = mt_rand(0, $maxran);
        $check_num    = md5($check_num);
        $time    = time();
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $new_password = md5($user_password);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $ya_username = check_html($ya_username, 'nohtml');
        $ya_realname = check_html($ya_realname, 'nohtml');
        $ya_user_email = check_html($ya_user_email, 'nohtml');
        list($newest_uid)    = $db->sql_fetchrow($db->sql_query("SELECT max(user_id) AS newest_uid FROM ".$user_prefix."_users_temp"));
        if ($newest_uid == "-1") { $new_uid = 1; } else { $new_uid = $newest_uid+1; }
        $result = $db->sql_query("INSERT INTO ".$user_prefix."_users_temp (user_id, username, realname, user_email, user_password, user_regdate, check_num, time) VALUES ($new_uid, '$ya_username', '$ya_realname', '$ya_user_email', '$new_password', '$user_regdate', '$check_num', '$time')");

        if ( is_array($nfield) ):

            if ((count($nfield) > 0) AND ($result)) {
                foreach ($nfield as $key => $var) {
                $db->sql_query("INSERT INTO ".$user_prefix."_cnbya_value_temp (uid, fid, value) VALUES ('$new_uid', '$key','$nfield[$key]')");
                }
            }

        endif;

        if(!$result) {
            OpenTable();
            echo ""._ADDERROR."<br />";
            CloseTable();
        } else {
            if ($ya_config['servermail'] == 0) {
                $message     = _WELCOMETO." $sitename ($nukeurl)!<br /><br />";
                $message    .= _YOUUSEDEMAIL." $ya_user_email "._TOAPPLY." $sitename ($nukeurl).<br /><br />";
                $message    .= _WAITAPPROVAL."<br /><br />";
                $message    .= _FOLLOWINGMEM."<br />"._UNICKNAME." $ya_username<br />"._UREALNAME." $ya_realname<br />"._UPASSWORD." $user_password";
                $subject     = _APPLICATIONSUB;
                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'From: '.$adminmail,                    
                    'Reply-To: '.$adminmail,
                    'Return-Path: '.$adminmail
                );
                phpmailer( $ya_user_email, $subject, $message, $headers );
            }
            title(_USERAPPLOGIN);
            OpenTable();
            echo "<center><strong>"._ACCOUNTRESERVED."</strong><br /><br />";
            echo ""._YOUAREPENDING."";
            echo "<br /><br />";
            echo ""._THANKSAPPL." $sitename!</center>";
            CloseTable();
            if ($ya_config['sendaddmail'] == 1 AND $ya_config['servermail'] == 0) {
/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
                $from_ip = $nsnst_const['remote_ip'];
/*****[END]********************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
                $subject     = "$sitename - "._MEMAPL;
                $message     = "$ya_username "._YA_APLTO." $sitename "._YA_FROM." $from_ip.<br />";
                $message    .= "-----------------------------------------------------------<br />";
                $message    .= _YA_NOREPLY;
                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'From: '.$ya_user_email,                    
                    'Reply-To: '.$ya_user_email,
                    'Return-Path: '.$ya_user_email
                );
                phpmailer( $adminmail, $subject, $message, $headers );
            }
        }
    } else {
        echo "$stop";
    }
    include_once(NUKE_BASE_DIR.'footer.php');

?>