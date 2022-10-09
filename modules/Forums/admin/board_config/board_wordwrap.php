<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_wordwrap.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "wordwrap" => "admin/board_config/board_wordwrap.tpl")
);

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$wrap_enable_yes = ( $new['wrap_enable'] ) ? "checked=\"checked\"" : "";
$wrap_enable_no = ( !$new['wrap_enable'] ) ? "checked=\"checked\"" : "";
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/


//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
    "L_WRAP_TITLE" => $lang['wrap_title'],
    "L_ENABLE_WRAP" => $lang['wrap_enable'],
    "L_WRAP_MIN" => $lang['wrap_min'],
    "L_WRAP_MAX" => $lang['wrap_max'],
    "L_WRAP_DEF" => $lang['wrap_def'],
    "L_WRAP_UNITS" => $lang['wrap_units'],
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
));

//Data Template Variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
    "WRAP_ENABLE" => $wrap_enable_yes,
    "WRAP_DISABLE" => $wrap_enable_no,
    "WRAP_MIN" => $new['wrap_min'],
    "WRAP_DEF" => $new['wrap_def'],
    "WRAP_MAX" => $new['wrap_max'],
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
));
$template->pparse("wordwrap");

?>