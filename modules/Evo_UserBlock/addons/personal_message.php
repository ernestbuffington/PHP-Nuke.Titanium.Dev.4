<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : personal_message.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Personal Message Module
************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

global $evouserinfo_personal_message;

function evouserinfo_personal_message () {
    global $evouserinfo_personal_message, $evouserinfo_addons;
    $evouserinfo_personal_message = $evouserinfo_addons['personal_message_message'];
    
    if (is_user()) {
        global $userinfo;
        $uname = UsernameColor($userinfo['username']);
    } else {
        $uname = $titanium_lang_evo_userblock['BLOCK']['GOOD_AFTERNOON']['ANON'];
    }
    global $sitename;
    $evouserinfo_personal_message = str_replace('%site%', $sitename, $evouserinfo_personal_message );
    $evouserinfo_personal_message = str_replace('%name%', $uname, $evouserinfo_personal_message );
}

evouserinfo_personal_message();
?>