<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : pms.php
   Author(s)     : TheGhost aka Ernest Buffington (php-nuke-titanium.86it.us), Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0 to 1.0.1
   Last Date     : 10.02.2022 (mm.dd.yyyy)
   Date          : 05.19.2005 (mm.dd.yyyy)
   Notes         : Titanium/Evo User Block PMs Module
************************************************************************/
if(!defined('NUKE_EVO')){die("Illegal File Access");}
global $evouserinfo_addons, $evouserinfo_pms, $lang_evo_userblock;
$one = "<i style=\"font-size: 17px; color: white\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='white'\" class=\"fas fa-envelope\"></i>";
if(has_new_or_unread_private_messages() > 0):
$two = " <a class='modules' href='modules.php?name=Private_Messages' target='_self'> $one My InBox (".has_new_or_unread_private_messages().")</a>";
else:
$two = " <a class='modules' href='modules.php?name=Private_Messages' target='_self'> $one My InBox (0)</a>";
endif;
if (is_user()):
    global $userinfo;    
    $evouserinfo_pms  = '<div style="padding-left: 10px;">';
	$evouserinfo_pms .= $two."";
	$evouserinfo_pms .= '</div>';
endif;
?>