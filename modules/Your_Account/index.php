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
/* v1.0                                                                          */
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

$pnt_module = basename(dirname(__FILE__));

require_once("modules/Your_Account/includes/constants.php");

if (!defined('CNBYA')) die('CNBYA protection');

include_once(NUKE_MODULES_DIR.$pnt_module.'/includes/functions.php');

# menelaos: removed because it is already called in /modules/Your_Account/includes/mainfileend.php
$ya_config = ya_get_configs();

get_lang($pnt_module);
$titanium_userpage = 1;

global $cookie;

$titanium_username = Fix_Quotes($_REQUEST['username']);
$redirect = $_REQUEST['redirect'];
$titanium_module = $_REQUEST['module'];
$user_password = $_REQUEST['user_password'];
$mode = $_REQUEST['mode'];
$t = $_REQUEST['t'];
$p = $_REQUEST['p'];

include(NUKE_MODULES_DIR.$pnt_module.'/navbar.php');
include(NUKE_MODULES_DIR.$pnt_module.'/includes/cookiecheck.php');

function ya_expire() 
{
    global $ya_config, $titanium_db, $titanium_user_prefix;
    
	if ($ya_config['expiring']!=0):
        
		$past = time()-$ya_config['expiring'];
        $res = $titanium_db->sql_query("SELECT user_id FROM ".$titanium_user_prefix."_users_temp WHERE time < '$past'");
        
		while (list($uid) = $titanium_db->sql_fetchrow($res)):
          $uid = intval($uid);
          $titanium_db->sql_query("DELETE FROM ".$titanium_user_prefix."_users_temp WHERE user_id = $uid");
          $titanium_db->sql_query("DELETE FROM ".$titanium_user_prefix."_cnbya_value_temp WHERE uid = '$uid'");
        endwhile;
        
        $titanium_db->sql_query("OPTIMIZE TABLE ".$titanium_user_prefix."_cnbya_value_temp");
        $titanium_db->sql_query("OPTIMIZE TABLE ".$titanium_user_prefix."_users_temp");
    
	endif;
}

switch($op): 
    case "username_check":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/check.php');
        break;
    case "activate":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/activate.php');
    break;
    case "avatarlist":
        if (is_user())
        include(NUKE_MODULES_DIR.$pnt_module.'/public/avatarlist.php');
        else 
        notuser();
    break;
    case "avatarsave":
        if (is_user())
        include(NUKE_MODULES_DIR.$pnt_module.'/public/avatarsave.php');
        else 
        notuser();
    break;
    case "avatarlinksave":
        if (is_user())
        include(NUKE_MODULES_DIR.$pnt_module.'/public/avatarlinksave.php');
        else
        notuser();
    break;
    case "delete":
        if ($ya_config['allowuserdelete'] == 1) 
        include(NUKE_MODULES_DIR.$pnt_module.'/public/delete.php');
        else 
        disabled();
    break;
    case "deleteconfirm":
        if ($ya_config['allowuserdelete'] == 1) 
        include(NUKE_MODULES_DIR.$pnt_module.'/public/deleteconfirm.php');
        else 
        disabled();
    break;
    case "editcomm":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/editcomm.php');
    break;
    case "edithome":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/edithome.php');
    break;
    case "edittheme":
    break;
    case "changemail":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/changemail.php');
        changemail();
    break;
    case "chgtheme":
        if ($ya_config['allowusertheme']==0) 
        include(NUKE_MODULES_DIR.$pnt_module.'/public/chngtheme.php');
        else 
        disabled();
    break;
    case "edituser":
        //include(NUKE_MODULES_DIR.$pnt_module.'/public/edituser.php'); (WHY WAS THIS TAKEN OUT?????) Assholes not commenting their changes!
        
		# Mod: YA Merge v1.0.0 START
        redirect_titanium("modules.php?name=Profile&mode=editprofile");
        exit;
        # Mod: YA Merge v1.0.0 END
    break;
    case "login":
        # Base: NukeSentinel v2.5.00 START
        global $nsnst_const, $titanium_user_prefix;
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
        if(!compare_ips($titanium_username)):
            DisplayError('Your IP is not valid for this user');
            exit;
        endif;
        # Mod: User IP Lock v1.0.0 END

        $result  = $titanium_db->sql_query("SELECT * FROM ".$titanium_user_prefix."_users WHERE username='$titanium_username'");
        $setinfo = $titanium_db->sql_fetchrow($result);
        
		# menelaos: check of the member agreed with the TOS and update the database field
        if (($ya_config['tos'] == intval(1)) AND ($_POST['tos_yes'] == intval(1))): 
        $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET agreedtos='1' WHERE username='$titanium_username'");
        endif;
		
		$forward = str_replace("redirect=", "", "$redirect");
        
		if (preg_match("#privmsg#", $forward)): 
		$pm_login = "active";
		endif; 
        
   if ($titanium_db->sql_numrows($result) == 0): 
          
		  include_once(NUKE_BASE_DIR.'header.php');
          
		  Show_CNBYA_menu();
          
		  OpenTable();
          echo "<div align=\"center\"><span class='title'>"._SORRYNOUSERINFO."</span></div>\n";
          CloseTable();
          
		  include_once(NUKE_BASE_DIR.'footer.php');
         
          elseif($titanium_db->sql_numrows($result) == 1 
		  AND $setinfo['user_id'] != 1 
		  AND !empty($setinfo['user_password']) 
		  AND $setinfo['user_active'] >0 AND $setinfo['user_level'] >0): 
        
          $titanium_dbpass     = $setinfo['user_password'];
          $non_crypt_pass = $user_password;
          $old_crypt_pass = crypt($user_password,substr($titanium_dbpass,0,2));
          
		  # Base: Evolution Functions v1.5.0 START
          $new_pass = EvoCrypt($user_password);
          # Base: Evolution Functions v1.5.0 START

          $new_pass = md5($user_password);
          $evo_crypt = EvoCrypt($user_password);
          
		  //Reset to md5x1
          if (($titanium_dbpass == $evo_crypt) 
		  || (($titanium_dbpass == $non_crypt_pass) 
		  || ($titanium_dbpass == $old_crypt_pass))): 
		  
            $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET user_password='$new_pass' WHERE username='$titanium_username'");
            $result = $titanium_db->sql_query("SELECT user_password FROM ".$titanium_user_prefix."_users WHERE username='$titanium_username'");
            list($titanium_dbpass) = $titanium_db->sql_fetchrow($result);
          
		  endif;
          
		  if ($titanium_dbpass != $new_pass): 
            
			# Does it need another md5?
        	if (md5($titanium_dbpass) == $new_pass): 
			
                $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET user_password='$new_pass' WHERE username='$titanium_username'");
                $result = $titanium_db->sql_query("SELECT user_password FROM ".$titanium_user_prefix."_users WHERE username='$titanium_username'");
                
				list($titanium_dbpass) = $titanium_db->sql_fetchrow($result);
                
				if ($titanium_dbpass != $new_pass): 
                    redirect_titanium("modules.php?name=$pnt_module&stop=1");
                    return;
                endif;
			
			else: 
        	    redirect_titanium("modules.php?name=$pnt_module&stop=1");
                return;
        	endif;
         
		 endif;
         
		 # Mod: Advanced Security Code Control v1.0.0 START
         $gfxchk = array(2,4,5,7);

         if (!security_code_check($_POST['g-recaptcha-response'], $gfxchk)):
            redirect_titanium("modules.php?name=$pnt_module&stop=1");
            exit;
         # Mod: Advanced Security Code Control v1.0.0 END

		 else: 
            # menelaos: show a member the current TOS if he has not agreed yet
            if (($ya_config['tos'] == intval(1)) AND ($ya_config['tosall'] == intval(1)) AND ($setinfo['agreedtos'] != intval(1))): 
                if($_POST['tos_yes'] != intval(1)): 
                include(NUKE_MODULES_DIR.$pnt_module.'/public/ya_tos.php');
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
      
	   $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_session WHERE uname='$uname' AND guest='1'");
       $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET last_ip='$uname' WHERE username='$titanium_username'");
        
	   endif;

      // menelaos: the cookiecheck is run here
      if ($ya_config['cookiecheck']==1): 
      $cookiecheck    = yacookiecheckresults();
      endif;
	  
	  if (!empty($pm_login)): 
      redirect_titanium("modules.php?name=Private_Messages&file=index&folder=inbox");
	  elseif(!empty($t)):  
      redirect_titanium("modules.php?name=Forums&file=$forward&mode=$mode&t=$t");
	  elseif (!empty($p)):  
      redirect_titanium("modules.php?name=Forums&file=$forward&mode=$mode&p=$p");
	  elseif(empty($redirect)): 
	      if ($phpbb2_board_config['loginpage'] == 1): 
          redirect_titanium("modules.php?name=Your_Account&op=userinfo&bypass=1&username=$titanium_username");
          else:
          redirect_titanium("modules.php?name=Forums");
          endif;
 	  elseif(!empty($titanium_module)): 
            redirect_titanium("modules.php?name=$titanium_module");
	  elseif(empty($mode)): 

          if(!empty($f)) 
          redirect_titanium("modules.php?name=Forums&file=$forward&f=$f");
		  else 
          redirect_titanium("modules.php?name=Forums&file=$forward");
            
         
	  else: 
      redirect_titanium("modules.php?name=Forums&file=$forward&mode=$mode&f=$f");
      endif;
		
   elseif($titanium_db->sql_numrows($result) == 1 AND ($setinfo['user_level'] < 1 OR $setinfo['user_active'] < 1)):
            
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
   redirect_titanium("modules.php?name=$pnt_module&stop=1");
   endif;
		
   break;
   case "logout":
        global $cookie, $titanium_db, $titanium_prefix;
        
		$r_uid = $cookie[0];
        $r_username = $cookie[1];
        
		setcookie("user");
        
		if (trim($ya_config['cookiepath']) != ''): 
		# correct the problem of path change
		setcookie("user","expired",time()-604800,"$ya_config[cookiepath]"); 
        endif;
		
		$titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_session WHERE uname='$r_username'");
        $titanium_db->sql_query("OPTIMIZE TABLE ".$titanium_prefix."_session");
        $sql = "SELECT session_id FROM ".$titanium_prefix."_bbsessions WHERE session_user_id='$r_uid'";
        $row = $titanium_db->sql_fetchrow($titanium_db->sql_query($sql));
        $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_bbsessions WHERE session_user_id='$r_uid'");
        $titanium_db->sql_query("OPTIMIZE TABLE ".$titanium_prefix."_bbsessions");

        # Mod: Forum Logout v1.0.0 START
        global $phpbb2_board_config;
        
		$cookiename = $phpbb2_board_config['cookie_name'];
        $cookiepath = $phpbb2_board_config['cookie_path'];
        $cookiedomain = $phpbb2_board_config['cookie_domain'];
        $cookiesecure = $phpbb2_board_config['cookie_secure'];
        $current_time = time();
        
		setcookie($cookiename.'_data','', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
        setcookie($cookiename.'_sid','', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
        # Mod: Forum Logout v1.0.0 END

        $titanium_user = "";

        if (!empty($redirect)): 
            redirect_titanium("modules.php?name=$redirect");
            exit;
		else: 
            redirect_titanium("modules.php?name=Your_Account");
            exit;
        endif;

    break;
    case "mailpasswd":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/mailpass.php');
    break;
    case "new_user":
    if (is_user()): 
    mmain($titanium_user);
    else:
	  # if new user registration is allowed 
      if ($ya_config['allowuserreg']==0):
	    # if coppa is required 
        if ($ya_config['coppa'] == intval(1)): 
           if($_POST['coppa_yes']!= intval(1)): 
              include(NUKE_MODULES_DIR.$pnt_module.'/public/ya_coppa.php');
                exit;
           endif;
        endif;
		# if terms of service is required 
		if ($ya_config['tos'] == intval(1)): 
          if($_POST['tos_yes'] != intval(1)): 
            include(NUKE_MODULES_DIR.$pnt_module.'/public/ya_tos.php');
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
             include(NUKE_MODULES_DIR.$pnt_module.'/public/new_user1.php');
			 # if admin approval is not required and user activate not enabled 
			 elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) 
             include(NUKE_MODULES_DIR.$pnt_module.'/public/new_user2.php');
			 # if admin approval is not required and user activate is required 
			 elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1) 
             include(NUKE_MODULES_DIR.$pnt_module.'/public/new_user3.php');
          endif;
        endif;
      else: 
        disabled();
      endif;
    endif;
    break;
    case "new_confirm":
        if (is_user()): 
            mmain($titanium_user);
        else:
            if ($ya_config['allowuserreg']==0):
                if ($ya_config['requireadmin'] == 1):
                    include(NUKE_MODULES_DIR.$pnt_module.'/public/new_confirm1.php');
                elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0):
                    include(NUKE_MODULES_DIR.$pnt_module.'/public/new_confirm2.php');
                elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1):
                    include(NUKE_MODULES_DIR.$pnt_module.'/public/new_confirm3.php');
                endif;
            else:
                disabled();
            endif;
        endif;
    break;
    case "new_finish":
        ya_expire();
		if (is_user()): 
        mmain($titanium_user);
		else: 
		    if ($ya_config['allowuserreg']==0): 
                
				if($ya_config['requireadmin'] == 1): 
                    include(NUKE_MODULES_DIR.$pnt_module.'/public/new_finish1.php');
				elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0): 
                    include(NUKE_MODULES_DIR.$pnt_module.'/public/new_finish2.php');
				elseif ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 1): 
                    include(NUKE_MODULES_DIR.$pnt_module.'/public/new_finish3.php');
                endif;
			else: 
                disabled();
            endif;
		endif;
    break;
    case "pass_lost":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/passlost.php');
    break;
   case "saveactivate":
        include(NUKE_MODULES_DIR.$pnt_module.'/public/saveactivate.php');
    break;
    case "savecomm":
        if (is_user()) 
        include(NUKE_MODULES_DIR.$pnt_module.'/public/savecomm.php');
        else 
        notuser();
    break;
    case "savehome":
        if (is_user())
        include(NUKE_MODULES_DIR.$pnt_module.'/public/savehome.php');
        else 
        notuser();
    break;
    case "savetheme":
        if (is_user()):
            if ($ya_config['allowusertheme']==0) 
            include(NUKE_MODULES_DIR.$pnt_module.'/public/savetheme.php');
            else 
            disabled();
        else:
            notuser();
        endif;
    break;
    case "saveuser":
        if (is_user()) 
        include(NUKE_MODULES_DIR.$pnt_module.'/public/saveuser.php');
        else 
        notuser();
    break;
    case "userinfo":
        # Mod: YA Merge v1.0.0 START
        list($uid) = $titanium_db->sql_ufetchrow('SELECT user_id FROM '.$titanium_user_prefix.'_users WHERE username="'.$titanium_username.'"', SQL_NUM);
        redirect_titanium("modules.php?name=Profile&mode=viewprofile&u=".$uid);
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
        mmain($titanium_user);
    break;
endswitch;
?>
