<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_glance.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      At a Glance Options                      v1.0.0       08/17/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "glance" => "admin/board_config/board_glance.tpl")
);

/*****[BEGIN]******************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
$glance_show = glance_option_select($new['glance_show'], "glance_show");
$glance_show_override_yes = ( $new['glance_show_override'] ) ? "checked = \"checked\"" : "";
$glance_show_override_no = ( !$new['glance_show_override'] ) ? "checked = \"checked\"" : "";
$glance_auth_read_yes = ( $new['glance_auth_read'] ) ? "checked = \"checked\"" : "";
$glance_auth_read_no = ( !$new['glance_auth_read'] ) ? "checked = \"checked\"" : "";


$alternate_row_class_yes = ( $new['glance_rowclass'] ) ? "checked = \"checked\"" : "";
$alternate_row_class_no = ( !$new['glance_rowclass'] ) ? "checked = \"checked\"" : "";
/*****[END]********************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
    "L_GLANCE_SHOW" => $lang['glance_show'],
    "L_GLANCE_TITLE" => $lang['glance_title'],
    "L_GLANCE_OVERRIDE_TITLE" => $lang['glance_override_title'],
    "L_GLANCE_NEWS_EXPLAIN" => $lang['glance_news_explain'],
    "L_GLANCE_NUM_NEWS_EXPLAIN" => $lang['glance_num_news_explain'],
    "L_GLANCE_NUM_EXPLAIN" => $lang['glance_num_explain'],
    "L_GLANCE_IGNORE_FORUMS" => $lang['glance_ignore_forums_explain'],
    "L_GLANCE_TABLE_WIDTH" => $lang['glance_table_width_explain'],
    "L_GLANCE_AUTH_READ_EXPLAIN" => $lang['glance_auth_read_explain'],
    "L_GLANCE_TOPIC_LENGTH_EXPLAIN" => $lang['glance_topic_length_explain'],

    "L_GLANCE_ALTERNATE_ROW" => $lang['glance_alternate_row'],
    "L_GLANCE_ALTERNATE_ROW_EXPLAIN" => $lang['glance_alternate_row_explain'],
/*****[END]********************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
));

//Data Template Variables
$template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
    "GLANCE_SELECT" => $glance_show,
    "GLANCE_SHOW_OVERRIDE_YES" => $glance_show_override_yes,
    "GLANCE_SHOW_OVERRIDE_NO" => $glance_show_override_no,
    "GLANCE_AUTH_READ_YES" => $glance_auth_read_yes,
    "GLANCE_AUTH_READ_NO" => $glance_auth_read_no,
    "GLANCE_NEWS_ID" => $new['glance_news_id'],
    "GLANCE_NUM_NEWS" => $new['glance_num_news'],
    "GLANCE_NUM" => $new['glance_num'],
    "GLANCE_IGNORE_FORUMS" => $new['glance_ignore_forums'],
    "GLANCE_TABLE_WIDTH" => $new['glance_table_width'],
    "GLANCE_TOPIC_LENGTH" => $new['glance_topic_length'],

    "GLANCE_ALTERNATE_YES" => $alternate_row_class_yes,
    "GLANCE_ALTERNATE_NO" => $alternate_row_class_no,
/*****[END]********************************************
 [ Mod:   At a Glance Option                   v1.0.0 ]
 ******************************************************/
));
$template->pparse("glance");

?>