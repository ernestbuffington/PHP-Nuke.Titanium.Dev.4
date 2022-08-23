<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_signature.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Advance Signature Divider Control        v1.0.0       06/16/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "signature" => "admin/board_config/board_signature.tpl")
);

/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
$new['sig_line'] = str_replace('"', '&quot;', $new['sig_line']);
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
 
//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
    "L_SIG_TITLE" => $lang['sig_title'],
    "L_SIG_EXPLAIN" => $lang['sig_explain'],
    "L_SIG_INPUT" => $lang['sig_divider'],
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
    "L_MAX_SIG_LENGTH" => $lang['Max_sig_length'],
    "L_MAX_SIG_LENGTH_EXPLAIN" => $lang['Max_sig_length_explain'],
));

//Data Template Variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
    "SIG_DIVIDERS" => $new['sig_line'],
/*****[END]********************************************
 [ Mod:     Advance Signature Divider Control  v1.0.0 ]
 ******************************************************/
    "SIG_SIZE" => $new['max_sig_chars'],
 ));
$template->pparse("signature");

?>