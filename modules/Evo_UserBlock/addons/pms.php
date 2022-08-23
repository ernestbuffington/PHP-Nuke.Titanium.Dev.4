<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : pms.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block PMs Module
************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

global $evouserinfo_addons, $evouserinfo_pms, $lang_evo_userblock;

if (is_user()):

    global $userinfo;    
    $evouserinfo_pms  = '<div style="padding-left: 10px;">';
    $evouserinfo_pms .= '  <i class="fas fa-envelope" aria-hidden="true"></i>&nbsp;'.$lang_evo_userblock['BLOCK']['PMS']['INBOX'].'<span style="float:right"><a title="'.$lang_evo_userblock['BLOCK']['PMS']['OPEN_INBOX'].'" href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a></span>';
    $evouserinfo_pms .= '</div>';

endif;

?>