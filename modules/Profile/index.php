<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
/***************************************************************************
 *                                profile.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: profile.php,v 1.193.2.5 2004/11/18 17:49:37 acydburn Exp
 ***************************************************************************/
/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Users Reputations System
-=[Mod]=-
      Signature Editor/Preview Deluxe          v1.0.0       06/22/2005
      Birthdays                                v3.0.0
      Admin delete users & posts               v1.0.5       05/29/2009
 ************************************************************************/
if (!defined('MODULE_FILE')) 
exit('You can\'t access this file directly...');

if (!isset($popup)){
    $module_name = basename(dirname(__FILE__));
    require(NUKE_FORUMS_DIR.'nukebb.php');
}
else
{
    $phpbb_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
include($phpbb_root_path . 'reputation_common.'.$phpEx);
include('includes/functions_reputation.'.$phpEx);
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PROFILE);
init_userprefs($userdata);
//
// End session management
//
/*****[BEGIN]******************************************
 [ Mod:   Admin delete user with all postings v.1.0.5 ]
 ******************************************************/
if(isset($userdata['session_logged_in']))
{ 
  if($userdata['session_logged_in'] && $userdata['user_level'] == ADMIN)
  {
	include($phpbb_root_path.'language/lang_' . $userdata['user_lang'] . '/lang_user_delete.'.$phpEx);
  }
}
/*****[END]********************************************
 [ Mod:   Admin delete user with all postings v.1.0.5 ]
 ******************************************************/
// session id check
if (!empty($_POST['sid']) || !empty($_GET['sid']))
{
        $sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
}
else
{
        $sid = '';
}

//
// Set default email variables
//
//$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
//$script_name = ( $script_name != '' ) ? $script_name . '/profile.'.$phpEx : 'profile.'.$phpEx;
$script_name = 'modules.php?name=Profile';
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

$server_url = $server_protocol . $server_name . $server_port . $script_name;

// -----------------------
// Page specific functions
//
function gen_rand_string($hash)
{
 	$rand_str = dss_rand();

 	return ( $hash ) ? md5($rand_str) : substr($rand_str, 0, 8);
}
//
// End page specific functions
// ---------------------------

//
// Start of program proper
//
		if(!isset($_GET['mode']))
		$_GET['mode'] = '';

		if(!isset($_GET['check_num']))
		$_GET['check_num'] = '';

        $mode      = ( isset($_GET['mode']) ) ? $_GET['mode'] : $_POST['mode'];
        $mode      = htmlspecialchars($mode);
        $check_num = ( isset($_GET['check_num']) ) ? $_GET['check_num'] : $_POST['check_num'];

        if (!$mode) {
                if ( !is_user() )
                {
                    $mode = "register";
                    redirect('modules.php?name=Your_Account&op=new_user');
                    exit;
                } else {
                    $mode = "editprofile";
                    include(NUKE_INCLUDE_DIR.'usercp_register.php');
                    exit;
                }
        }
        if($mode == 'viewprofile')
        {
          include(NUKE_INCLUDE_DIR.'usercp_viewprofile.php');
          exit;
        }
		elseif($mode == 'register' && ($check_num || isset($_POST['submit']))) 
		{
                include(NUKE_INCLUDE_DIR.'usercp_register.php');
                exit;
        } 
		elseif($mode == 'register' && !$check_num) 
		{
                redirect('modules.php?name=Your_Account&op=new_user');
        } 
		else if($mode == 'editprofile')
        {
           if(!is_user() && $mode == 'editprofile'):
              $header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/",$_SERVER["SERVER_SOFTWARE"])) ? "Refresh: 0; URL=" : "Location: ";
              redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=editprofile", true));
              exit;
           endif;
         include("includes/usercp_register.php");
         exit;
        }
/*****[BEGIN]******************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
        else if ( $mode == 'signature' )
        {
            if ( !is_user() && $mode == 'signature' )
            {
                $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", $_SERVER("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
                redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=signature", true));
                exit;
            }

            include(NUKE_INCLUDE_DIR.'usercp_signature.'.$phpEx);
            exit;
        }
/*****[END]********************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
        else if ( $mode == 'confirm' )
        {
            // Visual Confirmation
            if ( is_user() )
            {
                exit;
            }

            exit;
        }
        else if ( $mode == 'sendpassword' )
        {
            include(NUKE_INCLUDE_DIR.'usercp_sendpasswd.'.$phpEx);
            exit;
        }
        else if ( $mode == 'activate' )
        {
            include(NUKE_INCLUDE_DIR.'usercp_activate.'.$phpEx);
            exit;
        }
        else if ( $mode == 'email' )
        {
            include(NUKE_INCLUDE_DIR.'usercp_email.'.$phpEx);
            exit;
        }

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
		else if ( $mode == 'birthday_popup' )
		{
			$gen_simple_header = TRUE;

			$page_title = $lang['View_Birthdays'];
			include('includes/page_header.'.$phpEx);

			// reuse the pm popup box template
			$template->set_filenames(array(
				'body' => 'privmsgs_popup.tpl')
			);

			$template->assign_vars(array(
				'L_CLOSE_WINDOW' => $lang['Close_window'],
				'L_MESSAGE' => sprintf($lang['Birthday_popup'],$board_config['sitename']))
			);

			$template->pparse('body');

			include('includes/page_tail.'.$phpEx);
			exit;
		}
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
        include('includes/usercp_register.'.$phpEx);
