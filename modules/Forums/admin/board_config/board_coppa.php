<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_coppa.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "coppa" => "admin/board_config/board_coppa.tpl")
);

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
    "L_COPPA_SETTINGS" => $lang['COPPA_settings'],
    "L_COPPA_FAX" => $lang['COPPA_fax'],
    "L_COPPA_MAIL" => $lang['COPPA_mail'],
    "L_COPPA_MAIL_EXPLAIN" => $lang['COPPA_mail_explain'],
));

//Data Template Variables
$template->assign_vars(array(
    "COPPA_MAIL" => $new['coppa_mail'],
    "COPPA_FAX" => $new['coppa_fax'],
 ));
$template->pparse("coppa");

?>