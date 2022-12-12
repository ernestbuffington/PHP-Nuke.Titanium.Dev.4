<?php
/*=======================================================================
 PHP-Nuke Titanium : Nuke-Evolution | Enhanced and Advnanced
 =======================================================================*/

/************************************************************************
   Nuke-Evolution    : Server Info Administration
   PHP-Nuke Titanium : Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
   Copyright (c) 2022 by The PHP-Nuke Titanium Group

   Filename      : avatar.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)
   
   Notes         : Evo User Block Username Module
************************************************************************/

if(!defined('NUKE_EVO')): 
  exit("Illegal File Access");
endif;

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
