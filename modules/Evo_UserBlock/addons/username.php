<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : username.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Username Module
************************************************************************/

if(!defined('NUKE_EVO')) 
exit ("Illegal File Access");

global $evouserinfo_addons, $evouserinfo_username;

if(is_user()):
    global $userinfo;
    $evouserinfo_uname = UsernameColor($userinfo['username']);
else: 
    global $lang_evo_userblock;
    $evouserinfo_uname = $lang_evo_userblock['BLOCK']['ANON'];
endif;

if($evouserinfo_addons['username_center'] == 'yes'):
    $evouserinfo_username = "<div align=\"center\">";
    $evouserinfo_username .= $evouserinfo_uname;
    $evouserinfo_username .= "<br /><br /></div>";
else: 
    $evouserinfo_username = $evouserinfo_uname;
endif;
?>
