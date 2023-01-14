<?php
/*=============================================================================== 
   PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 ================================================================================*/

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke              */
/* ============================================                                  */
/*                                                                               */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                              */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                         */
/*                                                                               */
/* Contact author: escudero@phpnuke.org.br                                       */
/* International Support Forum: http://ravenphpscripts.com/forum76.html          */
/*                                                                               */
/* This program is free software. You can redistribute it and/or modify          */
/* it under the terms of the GNU General Public License as published by          */
/* the Free Software Foundation; either version 2 of the License.                */
/*                                                                               */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion  */
/*********************************************************************************/

/*****[CHANGES]*******************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      NukeSentinel                             v2.5.00      07/11/2006
      Evolution Functions                      v1.5.0       12/20/2005
-=[Mod]=-
      Forum Logout                             v1.0.0       07/27/2005
      YA Merge                                 v1.0.0       07/28/2005
      User IP Lock                             v1.0.0       11/30/2005
 *********************************************************************************/

if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

$module_name = basename(dirname(__FILE__));

require_once("modules/Your_Account/includes/constants.php");

if (!defined('CNBYA')) die('CNBYA protection');

include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

# menelaos: removed because it is already called in /modules/Your_Account/includes/mainfileend.php
$ya_config = ya_get_configs();

get_lang($module_name);
$userpage = 1;

global $cookie;

if(!isset($op))
$op = '';

if (isset($_REQUEST['username'])) 
{
  $username = Fix_Quotes($_REQUEST['username']);
}

if (isset($_REQUEST['redirect'])) 
{
  $redirect = $_REQUEST['redirect'];
}

if (isset($_REQUEST['module'])) 
{
  $module = $_REQUEST['module'];
}

if (isset($_REQUEST['user_password'])) 
{
  $user_password = $_REQUEST['user_password'];
}

if (isset($_REQUEST['mode'])) 
{
  $mode = $_REQUEST['mode'];
}

if (isset($_REQUEST['t'])) 
{
  $t = $_REQUEST['t'];
}

if (isset($_REQUEST['p'])) 
{
  $p = $_REQUEST['p'];
}

include(NUKE_MODULES_DIR.$module_name.'/navbar.php');
include(NUKE_MODULES_DIR.$module_name.'/includes/cookiecheck.php');

function ya_expire() 
{
    global $ya_config, $db, $user_prefix;
    
	if ($ya_config['expiring']!=0):
        
		$past = time()-$ya_config['expiring'];
        $res = $db->sql_query("SELECT user_id FROM ".$user_prefix."_users_temp WHERE time < '$past'");
        
		while (list($uid) = $db->sql_fetchrow($res)):
          $uid = intval($uid);
          $db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE user_id = $uid");
          $db->sql_query("DELETE FROM ".$user_prefix."_cnbya_value_temp WHERE uid = '$uid'");
        endwhile;
        
        $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_cnbya_value_temp");
        $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users_temp");
    
	endif;
}

switch($op): 
    case "username_check":
        include(NUKE_MODULES_DIR.$module_name.'/public/check.php');
        break;
    case "activate":
        include(NUKE_MODULES_DIR.$module_name.'/public/activate.php');
    break;
    case "avatarlist":
        if (is_user())
        include(NUKE_MODULES_DIR.$module_name.'/public/avatarlist.php');
        else 
        notuser();
    break;
    case "avatarsave":
        if (is_user())
        include(NUKE_MODULES_DIR.$module_name.'/public/avatarsave.php');
        else 
        notuser();
    break;
    case "avatarlinksave":
        if (is_user())
        include(NUKE_MODULES_DIR.$module_name.'/public/avatarlinksave.php');
        else
        notuser();
    break;
    case "delete":
        if ($ya_config['allowuserdelete'] == 1) 
        include(NUKE_MODULES_DIR.$module_name.'/public/delete.php');
        else 
        disabled();
    break;
    case "deleteconfirm":
        if ($ya_config['allowuserdelete'] == 1) 
        include(NUKE_MODULES_DIR.$module_name.'/public/deleteconfirm.php');
        else 
        disabled();
    break;
    case "editcomm":
        include(NUKE_MODULES_DIR.$module_name.'/public/editcomm.php');
    break;
    case "edithome":
        include(NUKE_MODULES_DIR.$module_name.'/public/edithome.php');
    break;
    case "edittheme":
    break;
    case "changemail":
        include(NUKE_MODULES_DIR.$module_name.'/public/changemail.php');
        changemail();
    break;
    case "chgtheme":
        if ($ya_config['allowusertheme']==0) 
        include(NUKE_MODULES_DIR.$module_name.'/public/chngtheme.php');
        else 
        disabled();
    break;
    case "edituser":
        //include(NUKE_MODULES_DIR.$module_name.'/public/edituser.php'); (WHY WAS THIS TAKEN OUT?????) Assholes not commenting their changes!
        
		# Mod: YA Merge v1.0.0 START
        redirect("modules.php?name=Profile&mode=editprofile");
        exit;
        # Mod: YA Merge v1.0.0 END
    break;
    case "login":
        # Base: NukeSentinel v2.5.00 START
        global $nsnst_const, $user_prefix;
        # Base: NukeSentinel v2.5.00 END

       /**
        * Security Mod: IPHUB VPN & Proxy blocker
        * @since 2.0.9e
        */
        
		# if (get_evo_option('iphub_status', 'int') == 1):  
        #     // include_once(NUKE_BASE_DIR.'header.php');  
        #     block_vpn_proxy_user();
        #     // include_once(NUKE_BASE_DIR.'footer.php');
        # endif;

        # Mod: User IP Lock v1.0.0 START
        if(!compare_ips($username)):
            DisplayError('Your IP is not valid for this user');
            exit;
        endif;
        # Mod: User IP Lock v1.0.0 END

        $result  = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE username='$username'");
        $setinfo = $db->sql_fetchrow($result);
        
		# menelaos: check of the member agreed with the TOS and update the database field
        if (($ya_config['tos'] == intval(1)) AND ($_POST['tos_yes'] == intval(1))): 
        $db->sql_query("UPDATE ".$user_prefix."_users SET agreedtos='1' WHERE username='$username'");
        endif;
		
		if(isset($redirect))
		$forward = str_replace("redirect=", "", "$redirect");
        
		if (preg_match("#privmsg#", $forward)): 
		$pm_login = "active";
		endif; 
        
   if ($db->sql_numrows($result) == 0): 
          
		  include_once(NUKE_BASE_DIR.'header.php');
          
		  Show_CNBYA_menu();
          
		  OpenTable();
          echo "<div align=\"center\"><span class='title'>"._SORRYNOUSERINFO."</span></div>\n";
          CloseTable();
          
		  include_once(NUKE_BASE_DIR.'footer.php');
         
          elseif($db->sql_numrows($result) == 1 
		  AND $setinfo['user_id'] != 1 
		  AND !empty($setinfo['user_password']) 
		  AND $setinfo['user_active'] >0 AND $setinfo['user_level'] >0): 
        
          $dbpass         = $setinfo['user_password'];
          $non_crypt_pass = $user_password;
          $old_crypt_pass = crypt($user_password,substr($dbpass,0,2));
          
		  # Base: Evolution Functions v1.5.0 START
          $new_pass = EvoCrypt($user_password);
          # Base: Evolution Functions v1.5.0 START

          $new_pass = md5($user_password);
          $evo_crypt = EvoCrypt($user_password);
          
		  //Reset to md5x1
          if (($dbpass == $evo_crypt) 
		  || (($dbpass == $non_crypt_pass) 
		  || ($dbpass == $old_crypt_pass))): 
		  
            $db->sql_query("UPDATE ".$user_prefix."_users SET user_password='$new_pass' WHERE username='$username'");
            $result = $db->sql_query("SELECT user_password FROM ".$user_prefix."_users WHERE username='$username'");
            list($dbpass) = $db->sql_fetchrow($result);
          
		  endif;
          
		  if ($dbpass != $new_pass): 
            
			# Does it need another md5?
        	if (md5($dbpass) == $new_pass): 
			
                $db->sql_query("UPDATE ".$user_prefix."_users SET user_password='$new_pass' WHERE username='$username'");
                $result = $db->sql_query("SELECT user_password FROM ".$user_prefix."_users WHERE username='$username'");
                
				list($dbpass) = $db->sql_fetchrow($result);
                
				if ($dbpass != $new_pass): 
                    redirect("modules.php?name=$module_name&stop=1");
                    return;
                endif;
			
			else: 
        	    redirect("modules.php?name=$module_name&stop=1");
                return;
        	endif;
         
		 endif;
         
		 # Mod: Advanced Security Code Control v1.0.0 START
         $gfxchk = array(2,4,5,7);

         if (!security_code_check($_POST['g-recaptcha-response'], $gfxchk)):
            redirect("modules.php?name=$module_name&stop=1");
            exit;
         # Mod: Advanced Security Code Control v1.0.0 END

		 else: 
            # menelaos: show a member the current TOS if he has not agreed yet
            if (($ya_config['tos'] == intval(1)) AND ($ya_config['tosall'] == intval(1)) AND ($setinfo['agreedtos'] != intval(1))): 
                if($_POST['tos_yes'] != intval(1)): 
                include(NUKE_MODULES_DIR.$module_name.'/public/ya_tos.php');
                exit;
                endif;
            endif;
            // menelaos: show a member the current TOS if he has not agreed yet

            yacookie($setinfo['user_id'], 
			        $setinfo['username'], 
		 $new_pass, $setinfo['storynum'], 
		               $setinfo['umode'], 
					  $setinfo['uorder'], 
					   $setinfo['thold'], 
					 $setinfo['noscore'], 
					$setinfo['ublockon'], 
					   $setinfo['theme'], 
				  $setinfo['commentmax']);
      
	   # Base: NukeSentinel v2.5.00 START
       $uname = $nsnst_const['remote_ip'];
       # Base: NukeSentinel v2.5.00 START
      
	   $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$uname' AND guest='1'");
       $db->sql_query("UPDATE ".$user_prefix."_users SET last_ip='$uname' WHERE username='$username'");
        
	   endif;

      // menelaos: the cookiecheck is run here
      if ($ya_config['cookiecheck']==1): 
      $cookiecheck    = yacookiecheckresults();
      endif;
	  
	  if (!empty($pm_login)): 
      redirect("modules.php?name=Private_Messages&file=index&folder=inbox");
	  elseif(!empty($t)):  
      redirect("modules.php?name=Forums&file=$forward&mode=$mode&t=$t");
	  elseif (!empty($p)):  
      redirect("modules.php?name=Forums&file=$forward&mode=$mode&p=$p");
	  elseif(empty($redirect)): 
	      if ($board_config['loginpage'] == 1): 
          redirect("modules.php?name=Your_Account&op=userinfo&bypass=1&username=$username");
          else:
          redirect("modules.php?name=Forums");
          endif;
 	  elseif(!empty($module)): 
            redirect("modules.php?name=$module");
	  elseif(empty($mode)): 

          if(!empty($f)) 
          redirect("modules.php?name=Forums&file=$forward&f=$f");
		  else 
          redirect("modules.php?name=Forums&file=$forward");
            
         
	  else: 
      redirect("modules.php?name=Forums&file=$forward&mode=$mode&f=$f");
      endif;
		
   elseif($db->sql_numrows($result) == 1 AND ($setinfo['user_level'] < 1 OR $setinfo['user_active'] < 1)):
            
			include_once(NUKE_BASE_DIR.'header.php');
            Show_CNBYA_menu();
            OpenTable();
            
			if ($setinfo['user_level'] == 0): 
            echo "<br /><div align=\"center\"><span class=\"title\"><strong>"._ACCSUSPENDED."</strong></span></div><br />\n";
            elseif ($setinfo['user_level'] == -1): 
            echo "<br /><div align=\"center\"><span class=\"title\"><strong>"._ACCDELETED."</strong></span></div><br />\n";
            else:
            echo "<br /><div align=\"center\"><span class=\"title\"><strong>"._SORRYNOUSERINFO."</strong></span></div><br />\n";
            endif;
			
        CloseTable();
		
        include_once(NUKE_BASE_DIR.'footer.php');
   else:
   redirect("modules.php?name=$module_name&stop=1");
   endif;
		
   break;
   case "logout":
        global $cookie, $db, $prefix;
        
		$r_uid = $cookie[0];
        $r_username = $cookie[1];
        
		setcookie("user");
        
		if (trim($ya_config['cookiepath']) != ''): 
		# correct the problem of path change
		setcookie("user","expired",time()-604800,"$ya_config[cookiepath]"); 
        endif;
		
		$db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_username'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_session");
        $sql = "SELECT session_id FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'";
        $row = $db->sql_fetchrow($db->sql_query($sql));
        $db->sql_query("DELETE FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_bbsessions");

        # Mod: Forum Logout v1.0.0 START
        global $board_config;
        
		$cookiename = $board_config['cookie_name'];
        $cookiepath = $board_config['cookie_path'];
        $cookiedomain = $board_config['cookie_domain'];
        $cookiesecure = $board_config['cookie_secure'];
        $current_time = time();
        
		setcookie($cookiename.'_data','', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
        setcookie($cookiename.'_sid','', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
        # Mod: Forum Logout v1.0.0 END

        $user = "";

        if (!empty($redirect)): 
            redirect("modules.php?name=$redirect");
            exit;
		else: 
            redirect("modules.php?name=Your_Account");
            exit;
        endif;

    break;
    case "mailpasswd":
        include(NUKE_MODULES_DIR.$module_name.'/public/mailpass.php');
    break;
    case "new_user":
    if (is_user()): 
    mmain($user);
    else:
	  # if new user registration is allowed 
      if ($ya_config['allowuserreg']==0):
	    # if coppa is required 
        if ($ya_config['coppa'] == intval(1)): 
           if($_POST['coppa_yes']!= intval(1)): 
              include(NUKE_MODULES_DIR.$module_name.'/public/ya_coppa.php');
                exit;
           endif;
        endif;
		# if terms of service is required 
		if ($ya_config['tos'] == intval(1)): 
          if($_POST['tos_yes'] != intval(1)): 
            include(NUKE_MODULES_DIR.$module_name.'/public/ya_tos.php');
            exit;
          endif;
        endif;
		# if coppa is not required
        if ($ya_config['coppa'] !== intval(1)
		# or if coppa is required 
		OR $ya_config['coppa'] == intval(1) 
		# if coppa post variable is set to yes 
		AND $_POST['coppa_yes'] = intval(1)):
		  if ($ya_config['tos'] !== intval(1) 
		  OR $ya_config['tos'] == intval(1) 
		  AND $_POST['tos_yes'] = intval(1)):
		     # if admin approval is required 
             if ($ya_config['requireadmin'] == 1) 
             include(NUKE_MODULES_DIR.$module_name.'/public/new_user1.php');
			 # if admin approval is not required and user activate not enabled 
			 elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) 
             include(NUKE_MODULES_DIR.$module_name.'/public/new_user2.php');
			 # if admin approval is not required and user activate is required 
			 elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1) 
             //include(NUKE_MODULES_DIR.$module_name.'/public/new_user3.php');
			 include(NUKE_MODULES_DIR.$module_name.'/public/new_user_registration_no_validation.php');
          endif;
        endif;
      else: 
        disabled();
      endif;
    endif;
    break;
    case "new_confirm":
        if (is_user()): 
            mmain($user);
        else:
            if ($ya_config['allowuserreg']==0):
                if ($ya_config['requireadmin'] == 1):
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm1.php');
                elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0):
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm2.php');
                elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1):
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_confirm3.php');
                endif;
            else:
                disabled();
            endif;
        endif;
    break;
    case "new_finish":
        ya_expire();
		if (is_user()): 
        mmain($user);
		else: 
		    if ($ya_config['allowuserreg']==0): 
                
				if($ya_config['requireadmin'] == 1): 
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish1.php');
				elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0): 
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish2.php');
				elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1): 
                    include(NUKE_MODULES_DIR.$module_name.'/public/new_finish3.php');
                endif;
			else: 
                disabled();
            endif;
		endif;
    break;
    case "pass_lost":
        include(NUKE_MODULES_DIR.$module_name.'/public/passlost.php');
    break;
   case "saveactivate":
        include(NUKE_MODULES_DIR.$module_name.'/public/saveactivate.php');
    break;
    case "savecomm":
        if (is_user()) 
        include(NUKE_MODULES_DIR.$module_name.'/public/savecomm.php');
        else 
        notuser();
    break;
    case "savehome":
        if (is_user())
        include(NUKE_MODULES_DIR.$module_name.'/public/savehome.php');
        else 
        notuser();
    break;
    case "savetheme":
        if (is_user()):
            if ($ya_config['allowusertheme']==0) 
            include(NUKE_MODULES_DIR.$module_name.'/public/savetheme.php');
            else 
            disabled();
        else:
            notuser();
        endif;
    break;
    case "saveuser":
        if (is_user()) 
        include(NUKE_MODULES_DIR.$module_name.'/public/saveuser.php');
        else 
        notuser();
    break;
    case "userinfo":
        # Mod: YA Merge v1.0.0 START
        list($uid) = $db->sql_ufetchrow('SELECT user_id FROM '.$user_prefix.'_users WHERE username="'.$username.'"', SQL_NUM);
        redirect("modules.php?name=Profile&mode=viewprofile&u=".$uid);
        exit;
        # Mod: YA Merge v1.0.0 END
    break;
    case "ShowCookiesRedirect":
        ShowCookiesRedirect();
    break;
    case "ShowCookies":
        ShowCookies();
    break;
    case "DeleteCookies":
        DeleteCookies();
    break;
    default:
        mmain($user);
    break;
endswitch;
?>
