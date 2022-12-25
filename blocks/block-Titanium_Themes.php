<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
 
/************************************************************************
   PHP-Nuke Titanium v3.0.0
   ======================================================================
   Copyright (c) 2019 by The PHP-Nuke Titanium Team
  
   Filename      : block-Titanium_Themes.php
   Author        : Ernest Buffington / JeFFb68CAM 
   Websites      : (hub.86it,us)      /(www.Evo-Mods.com)
   Version       : 3.0.0
   Date          : 08.13.2019 (mm.dd.yyyy)
                                                                        
   Notes         : Simple block to allow theme selection from homepage
************************************************************************/
if(!defined('NUKE_TITANIUM')) 
exit;

global $module_name, $userinfo;

if(is_user()):
	if(empty($module_name)):
	$module_name = main_module();
	endif;
    $content  = "<div align=\"center\"><br />\n"; 
    $content .= "<form action=\"modules.php?name=$module_name\" method=\"post\">";
    $content .= "<input type=\"hidden\" name=\"chngtheme\" value=\"1\"/>\n";
	$content .= "<input type=\"hidden\" name=\"user_id\" value=\"$userinfo[user_id]\">";
	$content .= "<input type=\"hidden\" name=\"op\" value=\"savetheme\">";
    $content .= GetThemeSelect('theme', 'user_themes', false, 'onChange=submit();');
    $content .= "</form>\n"; 
    $content .= "</div><br />\n";
else:
	if(empty($module_name)):
	$module_name = main_module();
	endif;
    $content  = "<div align=\"center\"><br />\n"; 
    $content .= "<form action=\"modules.php?name=$module_name\" method=\"post\">";
    $content .= GetThemeSelect('tpreview', 'user_themes', false, 'onChange=submit();', get_theme(), 0);
    $content .= "</form>\n"; 
    $content .= "</div><br />\n";
endif;
?>
