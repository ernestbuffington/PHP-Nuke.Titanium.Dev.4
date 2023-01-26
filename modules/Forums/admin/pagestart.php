<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                               pagestart.php
 *                            -------------------
 *   begin                : Thursday, Aug 2, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: pagestart.php,v 1.1.2.9 2005/06/26 14:39:30 acydburn Exp
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Functions                      v1.5.0       12/14/2005
-=[Mod]=-
      Admin IP Lock                            v2.1.0       06/24/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

define('IN_ADMIN', true);
define('FORUM_ADMIN', true);
include(dirname(dirname(dirname(dirname(__FILE__)))) .  "/mainfile.php");
$phpbb_root_path = './../';
include(NUKE_FORUMS_DIR.'common.php');

/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.1.0 ]
 ******************************************************/

/*=====
  For more information on how to use this please see the help file in the help/features folder
  =====*/

include(NUKE_BASE_DIR.'ips.php');

if(isset($ips) && is_array($ips)) {
    $ip_check = implode('|^',$ips);
    if (!preg_match("/^".$ip_check."/",$_SERVER['REMOTE_ADDR']))
    {
        unset($aid);
        unset($admin);
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        global $cookie;
        $name = (isset($cookie[1]) && !empty($cookie[1])) ? $cookie[1] : _ANONYMOUS;
        log_write('admin', $name.' used invalid IP address attempted to access the forum admin area', 'Security Breach');
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        die('Invalid IP<br />Access denied');
    }
    define('ADMIN_IP_LOCK',true);
}

/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.1.0 ]
 ******************************************************/

//
// Do a check to see if the nuke user is still valid.
//

global $admin, $cookie;

$admin = base64_decode($admin);
$admin = explode(":", $admin);

if(!is_user()):
  if (isset($_SERVER["HTTP_REFERER"]))
  header("Location: " . $_SERVER["HTTP_REFERER"]);
endif;

$admin_info = get_admin_field(array('name', 'pwd', 'radminsuper'), $admin[0]);
$user_info = get_user_field(array('user_id', 'user_password', 'user_level'), $cookie[1], true);

if(!(
	#Check to see if they are a site administrator with Forum Module access
	($admin[1] == $admin_info['pwd'] && !empty($admin_info['pwd']) && is_mod_admin('Forums'))
	OR
	#Checks to see if they are a standard forum admin
	(is_user() && ($cookie[2] == $user_info['user_password']) && !empty($user_info['user_password']) && ($user_info['user_level'] == ADMIN))
))
{
    unset($cookie);
    unset($admin);
    message_die(GENERAL_MESSAGE, "You are not authorized to administer this board");
}
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

if ( empty($no_page_header) )
{
        // Not including the pageheader can be neccesarry if META tags are
        // needed in the calling script.
        include('./page_header_admin.'.$phpEx);
}

