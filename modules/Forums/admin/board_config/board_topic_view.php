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

$phpbb2_template->set_filenames(array(
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
$phpbb2_template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$phpbb2_template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
    "L_TOPIC_VIEW_SETTINGS" => $titanium_lang['topic_view_settings'],
    "L_TOPIC_EXPLAIN" => $titanium_lang['topic_explain'],
    "L_MOVED" => $titanium_lang['moved'],
    "L_LOCKED" => $titanium_lang['locked'],
    "L_STICKY" => $titanium_lang['sticky'],
    "L_GLOBAL" => $titanium_lang['global'],
    "L_ANNOUNCE" => $titanium_lang['announce'],
    "L_CURRENT" => $titanium_lang['current'],
    "L_CURRENT_EXPLAIN" => $titanium_lang['current_explain'],
    "L_TAG" => $titanium_lang['tag'],
    "L_TAG_EXPLAIN" => $titanium_lang['tag_explain'],
    "L_TOPIC_TITLE" => $titanium_lang['topic_title'],
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
));

//Data Template Variables
$phpbb2_template->assign_vars(array(
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
    "LOCKED_CURRENT_HTML" => "<xmp>".$locked_html_open. " " . $titanium_lang['locked'] . $locked_html_close."</xmp>",
    "STICKY_CURRENT_HTML" => "<xmp>".$sticky_html_open. " " . $titanium_lang['sticky'] .$sticky_html_close."</xmp>",
    "ANNOUNCE_CURRENT_HTML" => "<xmp>".$announce_html_open. " " . $titanium_lang['announce'] .$announce_html_close."</xmp>",
    "GLOBAL_CURRENT_HTML" => "<xmp>".$global_html_open. " " . $titanium_lang['global'] .$global_html_close."</xmp>",
    "LOCKED_CURRENT" => "".$new['locked_view_open']. " " . $titanium_lang['locked'] .$new['locked_view_close']."",
    "STICKY_CURRENT" => "".$new['sticky_view_open']. " " . $titanium_lang['sticky'] .$new['sticky_view_close']."",
    "ANNOUNCE_CURRENT" => "".$new['announce_view_open']. " " . $titanium_lang['announce'] .$new['announce_view_close']."",
    "GLOBAL_CURRENT" => "".$new['global_view_open']. " " . $titanium_lang['global'] .$new['global_view_close']."",
    "MOVED_CURRENT" => "".$new['moved_view_open']. " " . $titanium_lang['moved'] .$new['moved_view_close']."",
/*****[END]********************************************
 [ Mod:     Customized Topic Status            v1.0.0 ]
 ******************************************************/
 ));
$phpbb2_template->pparse("topic_view");

?>