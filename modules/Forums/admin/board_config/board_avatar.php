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

/*****[CHANGES]**********************************************************
-=[Mod]=-
       Default avatar                           v1.1.0       06/30/2005
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "avatar" => "admin/board_config/board_avatar.tpl")
);

$avatars_local_yes = ( $new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_local_no = ( !$new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_remote_yes = ( $new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_remote_no = ( !$new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_upload_yes = ( $new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";
$avatars_upload_no = ( !$new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";
/*****[BEGIN]******************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
$default_avatar_guests = ($new['default_avatar_set'] == '0') ? "checked=\"checked\"" : "";
$default_avatar_users = ($new['default_avatar_set'] == '1') ? "checked=\"checked\"" : "";
$default_avatar_both = ($new['default_avatar_set'] == '2') ? "checked=\"checked\"" : "";
$default_avatar_none = ($new['default_avatar_set'] == '3') ? "checked=\"checked\"" : "";
/*****[END]********************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);
    
//Language Template variables
$template->assign_vars(array(
    "L_AVATAR_SETTINGS" => $lang['Avatar_settings'],
/*****[BEGIN]******************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
    "L_DEFAULT_AVATAR" => $lang['Default_avatar'],
    "L_DEFAULT_AVATAR_EXPLAIN" => $lang['Default_avatar_explain'],
    "L_DEFAULT_AVATAR_GUESTS" => $lang['Default_avatar_guests'],
    "L_DEFAULT_AVATAR_USERS" => $lang['Default_avatar_users'],
    "L_DEFAULT_AVATAR_BOTH" => $lang['Default_avatar_both'],
    "L_DEFAULT_AVATAR_NONE" => $lang['Default_avatar_none'],
/*****[END]********************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
    "L_ALLOW_LOCAL" => $lang['Allow_local'],
    "L_ALLOW_REMOTE" => $lang['Allow_remote'],
    "L_ALLOW_REMOTE_EXPLAIN" => $lang['Allow_remote_explain'],
    "L_ALLOW_UPLOAD" => $lang['Allow_upload'],
    "L_MAX_FILESIZE" => $lang['Max_filesize'],
    "L_MAX_FILESIZE_EXPLAIN" => $lang['Max_filesize_explain'],
    "L_MAX_AVATAR_SIZE" => $lang['Max_avatar_size'],
    "L_MAX_AVATAR_SIZE_EXPLAIN" => $lang['Max_avatar_size_explain'],
    "L_AVATAR_STORAGE_PATH" => $lang['Avatar_storage_path'],
    "L_AVATAR_STORAGE_PATH_EXPLAIN" => $lang['Avatar_storage_path_explain'],
    "L_AVATAR_GALLERY_PATH" => $lang['Avatar_gallery_path'],
    "L_AVATAR_GALLERY_PATH_EXPLAIN" => $lang['Avatar_gallery_path_explain'],
));

//Data Template Variables
$template->assign_vars(array(
    "AVATARS_LOCAL_YES" => $avatars_local_yes,
    "AVATARS_LOCAL_NO" => $avatars_local_no,
    "AVATARS_REMOTE_YES" => $avatars_remote_yes,
    "AVATARS_REMOTE_NO" => $avatars_remote_no,
    "AVATARS_UPLOAD_YES" => $avatars_upload_yes,
    "AVATARS_UPLOAD_NO" => $avatars_upload_no,
    "AVATAR_FILESIZE" => $new['avatar_filesize'],
    "AVATAR_MAX_HEIGHT" => $new['avatar_max_height'],
    "AVATAR_MAX_WIDTH" => $new['avatar_max_width'],
    "AVATAR_PATH" => $new['avatar_path'],
    "AVATAR_GALLERY_PATH" => $new['avatar_gallery_path'],
/*****[BEGIN]******************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
    "DEFAULT_AVATAR_GUESTS_URL" => $new['default_avatar_guests_url'],
    "DEFAULT_AVATAR_USERS_URL" => $new['default_avatar_users_url'],
    "DEFAULT_AVATAR_GUESTS" => $default_avatar_guests,
    "DEFAULT_AVATAR_USERS" => $default_avatar_users,
    "DEFAULT_AVATAR_BOTH" => $default_avatar_both,
    "DEFAULT_AVATAR_NONE" => $default_avatar_none,
/*****[END]********************************************
 [ Mod:     Default avatar                     v1.1.0 ]
 ******************************************************/
 ));
$template->pparse("avatar");

?>