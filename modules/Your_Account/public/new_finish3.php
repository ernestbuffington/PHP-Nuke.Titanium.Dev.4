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
    redirect('modules.php?name='.$module_name.'&op=new_user');
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

    $user_regdate = date("M d, Y");
    if (!isset($stop)) {
        $ya_username = ya_fixtext($ya_username);
        $ya_user_email = ya_fixtext($ya_user_email);
        if ($result = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE `username`='$ya_username' OR `user_email`='$ya_user_email'")) {
            if ($row = $db->sql_fetchrow($result)) {
                if (isset($row['username']) || isset($row['user_email'])) {
                    if ($row['username'] ==  $ya_username || $row['user_email'] == $ya_user_email) {
                        redirect("modules.php?name=$module_name");
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
        $user_website = check_html($user_website);
        if (!preg_match("#http://#i", $user_website) AND !empty($user_website)) { $user_website = "http://$user_website"; }
        $bio = str_replace("<br />", "\r\n", $bio);
        $bio = ya_fixtext($bio);
        $user_sig = str_replace("<br />", "\r\n", $user_sig);
        $user_sig = ya_fixtext($user_sig);
        $user_occ = ya_fixtext($user_occ);
        $user_from = ya_fixtext($user_from);
        $user_interests = ya_fixtext($user_interests);
        $user_dateformat = ya_fixtext($user_dateformat);
        $newsletter = intval($newsletter);
        $user_viewemail = intval($user_viewemail);
        $user_allow_viewonline = intval($user_allow_viewonline);
        $user_timezone = intval($user_timezone);
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
        list($newest_uid) = $db->sql_fetchrow($db->sql_query("SELECT max(user_id) AS newest_uid FROM ".$user_prefix."_users"));
        if ($newest_uid == "-1") { $new_uid = 1; } else { $new_uid = $newest_uid+1; }
        $lv = time();
        $result = $db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, 
		                                                                 name, 
																	 username, 
																   user_email, 
																  user_avatar, 
																 user_regdate, 
															   user_viewemail, 
															    user_password, 
																    user_lang, 
															   user_lastvisit) 
	   
	   VALUES ($new_uid, 
	     '$ya_username', 
		 '$ya_username', 
	   '$ya_user_email', 
	'gallery/blank.png', 
	    '$user_regdate', 
		            '0', 
		'$new_password', 
		    '$language', 
			      '$lv')");
        
		# PHP Warning:  count(): Parameter must be an array or an object that implements Countable
		# added $nfield = array(); - TheGhost 10/20/2022
		
		$nfield = array();
        
		if ((count($nfield) > 0) AND ($result)) {
          foreach ($nfield as $key => $var) {
              $db->sql_query("INSERT INTO ".$user_prefix."_cnbya_value (uid, fid, value) VALUES ('$new_uid', '$key','$nfield[$key]')");
          }
        }

    $db->sql_query("LOCK TABLES ".$user_prefix."_users WRITE");
    $db->sql_query("UPDATE ".$user_prefix."_users SET user_avatar='gallery/blank.png', user_avatar_type='3', user_lang='$language', user_lastvisit='$lv', umode='nested' WHERE user_id='$new_uid'");

    $db->sql_query("UPDATE ".$user_prefix."_users SET username='$ya_username', 
	                                                         name='$realname', 
												  user_email='$ya_user_email', 
												             femail='$femail', 
												 user_website='$user_website', 
												       user_from='$user_from', 
													     user_occ='$user_occ', 
											 user_interests='$user_interests', 
											         newsletter='$newsletter', 
											 user_viewemail='$user_viewemail', 
							   user_allow_viewonline='$user_allow_viewonline', 
							                   user_timezone='$user_timezone', 
										   user_dateformat='$user_dateformat', 
										                 user_sig='$user_sig', 
														           bio='$bio', 
											    user_password='$new_password', 
												  user_regdate='$user_regdate' WHERE user_id='$new_uid'");

    $db->sql_query("UNLOCK TABLES");
	
    $sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
            VALUES ('', 'Personal User', '1', '0')";
    
	if ( !($result = $db->sql_query($sql)) )
    {
        DisplayError('Could not insert data into groups table<br />'.$sql);
    }

    $group_id = $db->sql_nextid();

    $sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
        VALUES ('$new_uid', '$group_id', '0')";
    if( !($result = $db->sql_query($sql)) )
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

                phpmailer( $ya_user_email, $subject, $message, $headers );
            }
            title(_USERREGLOGIN);
            OpenTable();
            
			$result = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE username='$ya_username' AND user_password='$new_password'");
            
			if ($db->sql_numrows($result) == 1) 
			{
				
                $userinfo = $db->sql_fetchrow($result);
                
				yacookie($userinfo['user_id'],
				        $userinfo['username'],
				   $userinfo['user_password'],
				        $userinfo['storynum'],
				           $userinfo['umode'],
						  $userinfo['uorder'],
						   $userinfo['thold'],
						 $userinfo['noscore'],
						$userinfo['ublockon'],
						   $userinfo['theme'],
					  $userinfo['commentmax']);

// menelaos: i wonder if this cookie is set correctly
// menelaos: refresh of location? The next line causes multiple accounts to be loaded into the database, this has to be fixed
//              echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=/modules.php?name=$module_name\">";
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

                phpmailer( $adminmail, $subject, $message, $headers );
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
			include(NUKE_BASE_DIR . 'footer.php');
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