<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_once.php
   Author        : Technocrat (www.php-nuke-titanium.86it.us)
   Version       : 1.0.0
   Date          : 06.12.2006 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
       Default avatar                           v1.1.0       06/30/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "once" => "admin/board_config/board_once.tpl")
);
$show_sig_once_yes = ( $new['show_sig_once'] ) ? "checked=\"checked\"" : "";
$show_sig_once_no = ( !$new['show_sig_once'] ) ? "checked=\"checked\"" : "";
$show_avatar_once_yes = ( $new['show_avatar_once'] ) ? "checked=\"checked\"" : "";
$show_avatar_once_no = ( !$new['show_avatar_once'] ) ? "checked=\"checked\"" : "";
$show_rank_once_yes = ( $new['show_rank_once'] ) ? "checked=\"checked\"" : "";
$show_rank_once_no = ( !$new['show_rank_once'] ) ? "checked=\"checked\"" : "";

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
    "L_ONCE_SETTINGS" => $lang['once_settings'],
    "L_SHOW_SIG_ONCE" => $lang['show_sig_once'],
    "L_SHOW_AVATAR_ONCE" => $lang['show_avatar_once'],
    "L_SHOW_RANK_ONCE" => $lang['show_rank_once']
));

//Data Template Variables
$template->assign_vars(array(
    "SHOW_SIG_ONCE_YES" => $show_sig_once_yes,
    "SHOW_SIG_ONCE_NO" => $show_sig_once_no,
    "SHOW_AVATAR_ONCE_YES" => $show_avatar_once_yes,
    "SHOW_AVATAR_ONCE_NO" => $show_avatar_once_no,
    "SHOW_RANK_ONCE_YES" => $show_rank_once_yes,
    "SHOW_RANK_ONCE_NO" => $show_rank_once_no
 ));
$template->pparse("once");

?>