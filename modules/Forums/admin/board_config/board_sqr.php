<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_sqr.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Super Quick Reply                        v1.3.2       09/08/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "sqr" => "admin/board_config/board_sqr.tpl")
);

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$quickreply_yes = ( $new['allow_quickreply'] ) ? "checked=\"checked\"" : "";
$quickreply_no = ( !$new['allow_quickreply'] ) ? "checked=\"checked\"" : "";

$anonymous_sqr_mode_basic = ( $new['anonymous_sqr_mode']==0 ) ? 'checked="checked"' : '';
$anonymous_sqr_mode_advanced = ( $new['anonymous_sqr_mode']!=0 ) ? 'checked="checked"' : '';

$anonymous_sqr_select = quick_reply_select($new['anonymous_show_sqr'], 'anonymous_show_sqr');
$anonymous_open_sqr_yes = ( $new['anonymous_open_sqr'] ) ? "checked=\"checked\"" : "";
$anonymous_open_sqr_no = ( !$new['anonymous_open_sqr'] ) ? "checked=\"checked\"" : "";
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
 
//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
    "L_SQR_SETTINGS" => $lang['SQR_settings'],
    "L_ALLOW_QUICK_REPLY" => $lang['Allow_quick_reply'],
    "L_ANONYMOUS_SHOW_SQR" => $lang['Anonymous_show_SQR'],
    "L_ANONYMOUS_SQR_MODE" => $lang['Anonymous_SQR_mode'],
    "L_ANONYMOUS_SQR_MODE_BASIC" => $lang['Quick_reply_mode_basic'],
    "L_ANONYMOUS_OPEN_SQR" => $lang['Anonymous_open_SQR'],
    "L_ANONYMOUS_SQR_MODE_ADVANCED" => $lang['Quick_reply_mode_advanced'],
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
));

//Data Template Variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
    "ANONYMOUS_SQR_SELECT" => $anonymous_sqr_select,
    "QUICKREPLY_YES" => $quickreply_yes,
    "QUICKREPLY_NO" => $quickreply_no,
    "ANONYMOUS_SQR_MODE_BASIC" => $anonymous_sqr_mode_basic,
    "ANONYMOUS_SQR_MODE_ADVANCED" => $anonymous_sqr_mode_advanced,
    "ANONYMOUS_OPEN_SQR_YES" => $anonymous_open_sqr_yes,
    "ANONYMOUS_OPEN_SQR_NO" => $anonymous_open_sqr_no,
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
 ));
$template->pparse("sqr");

?>