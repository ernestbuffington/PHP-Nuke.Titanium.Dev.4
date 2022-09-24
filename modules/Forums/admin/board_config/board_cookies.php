<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_cookies.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$phpbb2_template->set_filenames(array(
    "cookies" => "admin/board_config/board_cookies.tpl")
);

$cookie_secure_yes = ( $new['cookie_secure'] ) ? "checked=\"checked\"" : "";
$cookie_secure_no = ( !$new['cookie_secure'] ) ? "checked=\"checked\"" : "";

//General Template variables
$phpbb2_template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$phpbb2_template->assign_vars(array(
    "L_COOKIE_SETTINGS" => $titanium_lang['Cookie_settings'],
    "L_COOKIE_SETTINGS_EXPLAIN" => $titanium_lang['Cookie_settings_explain'],
    "L_COOKIE_DOMAIN" => $titanium_lang['Cookie_domain'],
    "L_COOKIE_NAME" => $titanium_lang['Cookie_name'],
    "L_COOKIE_PATH" => $titanium_lang['Cookie_path'],
    "L_COOKIE_SECURE" => $titanium_lang['Cookie_secure'],
    "L_COOKIE_SECURE_EXPLAIN" => $titanium_lang['Cookie_secure_explain'],
    "L_SESSION_LENGTH" => $titanium_lang['Session_length'],
));

//Data Template Variables
$phpbb2_template->assign_vars(array(
    "COOKIE_DOMAIN" => $new['cookie_domain'],
    "COOKIE_NAME" => $new['cookie_name'],
    "COOKIE_PATH" => $new['cookie_path'],
    "SESSION_LENGTH" => $new['session_length'],
    "S_COOKIE_SECURE_ENABLED" => $cookie_secure_yes,
    "S_COOKIE_SECURE_DISABLED" => $cookie_secure_no,
 ));
$phpbb2_template->pparse("cookies");

?>