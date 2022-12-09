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

    if (!empty($username) AND empty($user_email)) {
        $sql = "SELECT username, user_email, user_password, user_level FROM ".$user_prefix."_users WHERE username='$username' LIMIT 1";
    } elseif (empty($username) AND !empty($user_email)) {
        $sql = "SELECT username, user_email, user_password, user_level FROM ".$user_prefix."_users WHERE user_email='$user_email' LIMIT 1";
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
// removed by menelaos dot hetnet dot nl
//      title(_USERREGLOGIN);
        Show_CNBYA_menu();
        OpenTable();
        echo "<center><span class='title'>"._YA_MUSTSUPPLY."</span></center>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
    $result = $db->sql_query($sql);
    if($db->sql_numrows($result) == 0) {
        include_once(NUKE_BASE_DIR.'header.php');

// removed by menelaos dot hetnet dot nl
//      title(_USERREGLOGIN);
        Show_CNBYA_menu();
        OpenTable();
        echo "<center><span class='title'>"._SORRYNOUSERINFO."</span></center>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {

        if ($ya_config['servermail'] == 0) {
/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
            $host_name = $nsnst_const['remote_ip'];
/*****[END]********************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
            $row = $db->sql_fetchrow($result);
            $user_name = $row['username'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_level = $row['user_level'];
            if ($user_level > 0) 
            {
                $areyou = substr($user_password, 0, 10);
                if ($areyou == $code) 
                {
                    $newpass = YA_MakePass();
                    $language_define_for_user_pass_subject = "User Password for for %s";
                    $language_define_for_user_pass = "The user account {USERNAME} at {SITENAME} has this email associated with it.<br /><br />A Web user from {IP_ADDRESS} has just requested that password be sent.<br /><br />Your new Password is {NEW_PASSWORD}<br /><br />You can change it after you login at<br />{MODULE_URL}<br /><br />If you didn't ask for this, don't worry. You are seeing this message, not 'them'. If this was an error just login with your new password.<br /><br />{EMAIL_SIG}";

                    $email_data = array(
                        'sitename'      => $sitename,
                        'username'      => $user_name,
                        'ip_address'    => $identify->get_ip(),
                        'password'      => $newpass,

                        'email'         => $user_email,
                        'subject'       => sprintf($language_define_for_user_pass_subject, ((!empty($username)) ? $user_name : $user_email)),
                        'reply_to'      => $adminmail,
                        'from'          => $adminmail,
                        'module_url'    => $nukeurl.'/modules.php?name='.$module_name,
                        'signature'     => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : ''
                    );

                    $content = str_replace( '{USERNAME}', $email_data['username'], $language_define_for_user_pass );
                    $content = str_replace( '{SITENAME}', $email_data['sitename'], $content );                    
                    $content = str_replace( '{IP_ADDRESS}', $email_data['ip_address'], $content );
                    $content = str_replace( '{NEW_PASSWORD}', $email_data['password'], $content );
                    $content = str_replace( '{MODULE_URL}', $email_data['module_url'], $content );
                    $content = str_replace( '{EMAIL_SIG}', $email_data['signature'], $content );

                    $headers = array(
                        'From: '.$email_data['sitename'].' <'.$email_data['from'].'>',
                        'Reply-To: '.$email_data['sitename'].' <'.$email_data['reply_to'].'>',
                        'Content-Type: text/html; charset=UTF-8'
                    );

                    phpmailer( $email_data['email'], $email_data['subject'], $content, $headers );
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                    $cryptpass = md5($newpass);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                    if (!empty($username)) {
                        $query = "UPDATE ".$user_prefix."_users SET user_password='$cryptpass' WHERE username='$username'";
                    } else if (!empty($user_email)) {
                        $query = "UPDATE ".$user_prefix."_users SET user_password='$cryptpass' WHERE user_email='$user_email'";
                    }
                    include_once(NUKE_BASE_DIR.'header.php');
                    OpenTable();
                    if (!$db->sql_query($query)) { echo "<center>"._UPDATEFAILED."</center><br />"; }
                    echo "<center><strong>"._PASSWORD4." ";
                    if (!empty($username)) { echo "'$user_name'"; } else if (!empty($user_email)) { echo "'$user_email'"; }
                    echo " "._MAILED."</strong><br /><br />"._GOBACK."</center>";
                    CloseTable();
                    include_once(NUKE_BASE_DIR.'footer.php');
                } else {
                    $language_define_for_pass_lost_subject = "Confirmation Code for %s";
                    $language_define_for_pass_lost = "The user account {USERNAME} at {SITENAME} has this email associated with it.<br /><br />A Web user from {IP_ADDRESS} has just requested a Confirmation Code to change the password.<br /><br />Your Confirmation Code is: {CODE}<br /><br />With this code you can now assign a new password at<br />{PASSWORD_LOST_URL}<br /><br />If you didn't ask for this, don't worry. Just delete this Email.<br /><br />{EMAIL_SIG}";

                    $email_data = array(
                        'sitename'      => $sitename,
                        'username'      => $user_name,
                        'ip_address'    => $identify->get_ip(),
                        'code'          => substr($user_password, 0, 10),

                        'email'         => $user_email,
                        'subject'       => sprintf($language_define_for_pass_lost_subject, ((!empty($username)) ? $user_name : $user_email)),
                        'reply_to'      => $adminmail,
                        'from'          => $adminmail,
                        'password_url'  => $nukeurl."/modules.php?name=$module_name&op=pass_lost",
                        'signature'     => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : ''
                    );

                    $content = str_replace( '{USERNAME}', $email_data['username'], $language_define_for_pass_lost );
                    $content = str_replace( '{SITENAME}', $email_data['sitename'], $content );                    
                    $content = str_replace( '{IP_ADDRESS}', $email_data['ip_address'], $content );
                    $content = str_replace( '{CODE}', $email_data['code'], $content );
                    $content = str_replace( '{PASSWORD_LOST_URL}', $email_data['password_url'], $content );
                    $content = str_replace( '{EMAIL_SIG}', $email_data['signature'], $content );

                    $headers = array(
                        'From: '.$email_data['sitename'].' <'.$email_data['from'].'>',
                        'Reply-To: '.$email_data['sitename'].' <'.$email_data['reply_to'].'>',
                        'Content-Type: text/html; charset=UTF-8'
                    );

                    phpmailer( $email_data['email'], $email_data['subject'], $content, $headers );
                    include_once(NUKE_BASE_DIR.'header.php');
                    OpenTable();
                    echo "<center><strong>"._CODEFOR." ";
                    if (!empty($username)) { echo "'$user_name'"; } else if (!empty($user_email)) { echo "'$user_email'"; }
                    echo " "._MAILED."</strong><br /><br />"._GOBACK."</center>";
                    CloseTable();
                    include_once(NUKE_BASE_DIR.'footer.php');
                }
            } elseif ($user_level == 0) {
                include_once(NUKE_BASE_DIR.'header.php');
                title(_USERREGLOGIN);
                OpenTable();
                echo "<center><span class='title'>"._ACCSUSPENDED."</span></center>\n";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
            } elseif ($user_level == -1) {
                include_once(NUKE_BASE_DIR.'header.php');
                title(_USERREGLOGIN);
                OpenTable();
                echo "<center><span class='title'>"._ACCDELETED."</span></center>\n";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
            }
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            title(_USERREGLOGIN);
            OpenTable();
            echo "<center>"._SERVERNOMAIL."</center>\n";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }

    }

?>