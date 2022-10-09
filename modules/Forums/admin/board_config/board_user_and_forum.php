<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_avatar.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "user_and_forum" => "admin/board_config/board_user_and_forum.tpl")
);

$html_tags = $new['allow_html_tags'];

$html_yes = ( $new['allow_html'] ) ? "checked=\"checked\"" : "";
$html_no = ( !$new['allow_html'] ) ? "checked=\"checked\"" : "";

$bbcode_yes = ( $new['allow_bbcode'] ) ? "checked=\"checked\"" : "";
$bbcode_no = ( !$new['allow_bbcode'] ) ? "checked=\"checked\"" : "";

$smile_yes = ( $new['allow_smilies'] ) ? "checked=\"checked\"" : "";
$smile_no = ( !$new['allow_smilies'] ) ? "checked=\"checked\"" : "";

$allow_autologin_yes = ($new['allow_autologin']) ? 'checked="checked"' : '';
$allow_autologin_no = (!$new['allow_autologin']) ? 'checked="checked"' : '';

$loginindexpage_yes = ($new['loginpage']) ? 'checked="checked"' : '';
$loginindexpage_no = (!$new['loginpage']) ? 'checked="checked"' : '';

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
$smilies_in_titles_yes = ( $new['smilies_in_titles'] ) ? "checked=\"checked\"" : "";
$smilies_in_titles_no = ( !$new['smilies_in_titles'] ) ? "checked=\"checked\"" : "";
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
$last_post_avatar_yes = ( $new['last_post_avatar'] ) ? "checked=\"checked\"" : "";
$last_post_avatar_no = ( !$new['last_post_avatar'] ) ? "checked=\"checked\"" : "";
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:  Hide Images and Links                 v1.0.0 ]
 ******************************************************/
$show_images_yes = ( $new['hide_images'] ) ? "checked = \"checked\"" : "";
$show_images_no = ( !$new['hide_images'] ) ? "checked = \"checked\"" : "";
$show_links_yes = ( $new['hide_links'] ) ? "checked = \"checked\"" : "";
$show_links_no = ( !$new['hide_links'] ) ? "checked = \"checked\"" : "";
$show_emails_yes = ( $new['hide_emails'] ) ? "checked = \"checked\"" : "";
$show_emails_no = ( !$new['hide_emails'] ) ? "checked = \"checked\"" : "";
/*****[END]********************************************
 [ Mod:  Hide Images and Links                 v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
$allow_view_select = allow_view_select($new['logs_view_level']);
$show_edited_logs_yes = ($new['show_edited_logs']) ? "checked=\"checked\"" : "";
$show_edited_logs_no = (!$new['show_edited_logs']) ? "checked=\"checked\"" : "";
$show_locked_logs_yes = ($new['show_locked_logs']) ? "checked=\"checked\"" : "";
$show_locked_logs_no = (!$new['show_locked_logs']) ? "checked=\"checked\"" : "";
$show_unlocked_logs_yes = ($new['show_unlocked_logs']) ? "checked=\"checked\"" : "";
$show_unlocked_logs_no = (!$new['show_unlocked_logs']) ? "checked=\"checked\"" : "";
$show_splitted_logs_yes = ($new['show_splitted_logs']) ? "checked=\"checked\"" : "";
$show_splitted_logs_no = (!$new['show_splitted_logs']) ? "checked=\"checked\"" : "";
$show_moved_logs_yes = ($new['show_moved_logs']) ? "checked=\"checked\"" : "";
$show_moved_logs_no = (!$new['show_moved_logs']) ? "checked=\"checked\"" : "";
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
    "L_ABILITIES_SETTINGS" => $lang['Abilities_settings'],
    "L_MAX_POLL_OPTIONS" => $lang['Max_poll_options'],
    "L_ALLOW_HTML" => $lang['Allow_HTML'],
    "L_ALLOW_BBCODE" => $lang['Allow_BBCode'],
    "L_ALLOWED_TAGS" => $lang['Allowed_tags'],
    "L_ALLOWED_TAGS_EXPLAIN" => $lang['Allowed_tags_explain'],
    "L_ALLOW_SMILIES" => $lang['Allow_smilies'],
    "L_ALLOW_AUTOLOGIN" => $lang['Allow_autologin'],
    "L_ALLOW_AUTOLOGIN_EXPLAIN" => $lang['Allow_autologin_explain'],
    "L_AUTOLOGIN_TIME" => $lang['Autologin_time'],
    "L_AUTOLOGIN_TIME_EXPLAIN" => $lang['Autologin_time_explain'],
    "L_LOGIN_PAGE" => $lang['Login_page'],
    "L_LOGIN_PAGE_EXPLAIN" => $lang['Login_page_explain'],      
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
    "L_SMILIES_IN_TITLES" => $lang['smilies_in_titles'],
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
    "L_LAST_POSTER_AVATAR" => $lang['last_poster_avatar'],
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:  Hide Images and Links                 v1.0.0 ]
 ******************************************************/
    "L_HIDE_IMAGES" => $lang['hide_images'],
    "L_HIDE_LINKS" => $lang['hide_links'],
    "L_HIDE_EMAILS" => $lang['hide_emails'],
/*****[END]********************************************
 [ Mod:  Hide Images and Links                 v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
    "L_SHOW_EDITED_LOGS" => $lang['show_edited_logs'],
    "L_SHOW_LOCKED_LOGS" => $lang['show_locked_logs'],
    "L_SHOW_UNLOCKED_LOGS" => $lang['show_unlocked_logs'],
    "L_SHOW_SPLITTED_LOGS" => $lang['show_splitted_logs'],
    "L_SHOW_MOVED_LOGS" => $lang['show_moved_logs'],
    "L_ALLOW_VIEW" => $lang['allow_logs_view'],
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
    "L_SMILIES_PATH" => $lang['Smilies_path'],
    "L_SMILIES_PATH_EXPLAIN" => $lang['Smilies_path_explain'],
/*****[BEGIN]******************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
    "L_IMAGE_RESIZE_WIDTH" => $lang['image_resize_width'],
    "L_IMAGE_RESIZE_HEIGHT" => $lang['image_resize_height'],
/*****[END]********************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
));

//Data Template Variables
$template->assign_vars(array(
    "MAX_POLL_OPTIONS" => $new['max_poll_options'],
    "HTML_TAGS" => $html_tags,
    "HTML_YES" => $html_yes,
    "HTML_NO" => $html_no,
    "BBCODE_YES" => $bbcode_yes,
    "BBCODE_NO" => $bbcode_no,
    "SMILE_YES" => $smile_yes,
    "SMILE_NO" => $smile_no,
    'ALLOW_AUTOLOGIN_YES' => $allow_autologin_yes,
    'ALLOW_AUTOLOGIN_NO' => $allow_autologin_no,
    'LOGINPAGE_YES' => $loginindexpage_yes,
    'LOGINPAGE_NO' => $loginindexpage_no,        
    'AUTOLOGIN_TIME' => (int) $new['max_autologin_time'],
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
    "SMILES_IN_TITLES_YES" => $smilies_in_titles_yes,
    "SMILES_IN_TITLES_NO" => $smilies_in_titles_no,
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
    "AVATAR_ON_INDEX_YES" => $last_post_avatar_yes,
    "AVATAR_ON_INDEX_NO" => $last_post_avatar_no,
/*****[END]********************************************
 [ Mod:    Forum Index Avatar Mod                 v1.0]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:  Hide Images and Links                 v1.0.0 ]
 ******************************************************/
    "HIDE_IMAGES_YES" => $show_images_yes,
    "HIDE_IMAGES_NO" => $show_images_no,
    "HIDE_LINKS_YES" => $show_links_yes,
    "HIDE_LINKS_NO" => $show_links_no,
    "HIDE_EMAILS_YES" =>$show_emails_yes,
    "HIDE_EMAILS_NO" => $show_emails_no,
/*****[END]********************************************
 [ Mod:  Hide Images and Links                 v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
    "SHOW_EDITED_LOGS_YES" => $show_edited_logs_yes,
    "SHOW_EDITED_LOGS_NO" => $show_edited_logs_no,
    "SHOW_LOCKED_LOGS_YES" => $show_locked_logs_yes,
    "SHOW_LOCKED_LOGS_NO" => $show_locked_logs_no,
    "SHOW_UNLOCKED_LOGS_YES" => $show_unlocked_logs_yes,
    "SHOW_UNLOCKED_LOGS_NO" => $show_unlocked_logs_no,
    "SHOW_SPLITTED_LOGS_YES" => $show_splitted_logs_yes,
    "SHOW_SPLITTED_LOGS_NO" => $show_splitted_logs_no,
    "SHOW_MOVED_LOGS_YES" => $show_moved_logs_yes,
    "SHOW_MOVED_LOGS_NO" => $show_moved_logs_no,
    "ALLOW_VIEW_SELECT" => $allow_view_select,
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
    "SMILIES_PATH" => $new['smilies_path'],
/*****[BEGIN]******************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
    "IMAGE_RESIZE_WIDTH" => $new['image_resize_width'],
    "IMAGE_RESIZE_HEIGHT" => $new['image_resize_height'],
/*****[END]********************************************
 [ Mod:   Resize Posted Images                 v2.4.5 ]
 ******************************************************/
 ));
$template->pparse("user_and_forum");

?>