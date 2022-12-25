<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_topic_view.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Customized Topic Status                  v1.0.0       08/25/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "topic_view" => "admin/board_config/board_topic_view.tpl")
);

/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
$locked_html_close = $new['locked_view_close'];
$locked_html_open = $new['locked_view_open'];
$global_html_open =  $new['global_view_open'];
$global_html_close =  $new['global_view_close'];
$announcement_html_close =  $new['announce_view_close'];
$announcement_html_open =  $new['announce_view_open'];
$sticky_html_open =  $new['sticky_view_open'];
$sticky_html_close =  $new['sticky_view_close'];
$moved_html_open =  $new['moved_view_open'];
$moved_html_open =  $new['moved_view_open'];
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
    "L_TOPIC_VIEW_SETTINGS" => $lang['topic_view_settings'],
    "L_TOPIC_EXPLAIN" => $lang['topic_explain'],
    "L_MOVED" => $lang['moved'],
    "L_LOCKED" => $lang['locked'],
    "L_STICKY" => $lang['sticky'],
    "L_GLOBAL" => $lang['global'],
    "L_ANNOUNCE" => $lang['announce'],
    "L_CURRENT" => $lang['current'],
    "L_CURRENT_EXPLAIN" => $lang['current_explain'],
    "L_TAG" => $lang['tag'],
    "L_TAG_EXPLAIN" => $lang['tag_explain'],
    "L_TOPIC_TITLE" => $lang['topic_title'],
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
));

//Data Template Variables
if(!isset($announce_html_open))
$announce_html_open = '';

if(!isset($announce_html_close))
$announce_html_close = '';

$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
    "MOVED_VIEW_OPEN" => $new['moved_view_open'],
    "MOVED_VIEW_CLOSE" => $new['moved_view_close'],
    "LOCKED_VIEW_OPEN" => $new['locked_view_open'],
    "LOCKED_VIEW_CLOSE" => $new['locked_view_close'],
    "GLOBAL_VIEW_CLOSE" => $new['global_view_close'],
    "GLOBAL_VIEW_OPEN" => $new['global_view_open'],
    "ANNOUNCE_VIEW_OPEN" => $new['announce_view_open'],
    "ANNOUNCE_VIEW_CLOSE" => $new['announce_view_close'],
    "STICKY_VIEW_CLOSE" => $new['sticky_view_close'],
    "STICKY_VIEW_OPEN" => $new['sticky_view_open'],
    "LOCKED_CURRENT_HTML" => "<xmp>".$locked_html_open. " " . $lang['locked'] . $locked_html_close."</xmp>",
    "STICKY_CURRENT_HTML" => "<xmp>".$sticky_html_open. " " . $lang['sticky'] .$sticky_html_close."</xmp>",
    "ANNOUNCE_CURRENT_HTML" => "<xmp>".$announce_html_open. " " . $lang['announce'] .$announce_html_close."</xmp>",
    "GLOBAL_CURRENT_HTML" => "<xmp>".$global_html_open. " " . $lang['global'] .$global_html_close."</xmp>",
    "LOCKED_CURRENT" => "".$new['locked_view_open']. " " . $lang['locked'] .$new['locked_view_close']."",
    "STICKY_CURRENT" => "".$new['sticky_view_open']. " " . $lang['sticky'] .$new['sticky_view_close']."",
    "ANNOUNCE_CURRENT" => "".$new['announce_view_open']. " " . $lang['announce'] .$new['announce_view_close']."",
    "GLOBAL_CURRENT" => "".$new['global_view_open']. " " . $lang['global'] .$new['global_view_close']."",
    "MOVED_CURRENT" => "".$new['moved_view_open']. " " . $lang['moved'] .$new['moved_view_close']."",
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
 ));
$template->pparse("topic_view");

?>