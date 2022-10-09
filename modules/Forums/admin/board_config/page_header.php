<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : page_header.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      DHTML Admin Menu                         v1.0.1       08/31/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "head" => "admin/board_config/page_header.tpl")
);

if ( $new['use_dhtml'] )
{
        $template->assign_block_vars('use_dhtml', array());
}

$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
     "DHTML_DISPLAY" => $dhtml_display,
    "DHTML_HAND" => $dhtml_hand,
    "DHTML_ONCLICK" => $dhtml_onclick,
/*****[END]********************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
    "S_CONFIG_ACTION" => append_sid('admin_board.php'),

    "L_YES" => $lang['Yes'],
    "L_NO" => $lang['No'],
    "L_ENABLED" => $lang['Enabled'],
    "L_DISABLED" => $lang['Disabled'],

    "L_CONFIGURATION_TITLE" => $lang['General_Config'],
    "L_CONFIGURATION_EXPLAIN" => $lang['Config_explain'])
);

$template->pparse("head");

?>