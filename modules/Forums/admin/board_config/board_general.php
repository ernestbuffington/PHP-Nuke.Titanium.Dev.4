<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: DHTML Forum Config Admin
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : board_general.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.0
   Date          : 09.10.2005 (mm.dd.yyyy)

   Description   : Enhanced General Admin Configuration with DHTML menu.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
       Report Posts                             v1.0.2       06/14/2005
       Disable Board Message                    v1.0.0       07/06/2005
       Disable Board Admin Override             v0.1.1       07/06/2005
       Limit smilies per post                   v1.0.2       07/24/2005
       Advanced Time Management                 v2.2.0       07/26/2005
       DHTML Admin Menu                         v1.0.1       08/31/2005
       Quick Search                             v3.0.1       08/23/2005
       Forum Admin Style Selection              v1.0.0       10/01/2005
       Theme Management                         v1.0.2       10/01/2005
       Online/Offline/Hidden                    v2.2.7       01/24/2006
	   Scrolling Global Announcement on Index   v1.0.1
 ************************************************************************/

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    'general' => 'admin/board_config/board_general.tpl')
);
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
$new['global_announcement'] = str_replace('"', '&quot;', $new['global_announcement']); 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/
$new['site_desc'] = str_replace('"', '&quot;', $new['site_desc']);
$new['sitename'] = str_replace('"', '&quot;', strip_tags($new['sitename']));

$disable_board_yes = ( $new['board_disable'] ) ? 'checked="checked"' : '';
$disable_board_no = ( !$new['board_disable'] ) ? 'checked="checked"' : '';
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
$disable_board_adminview_yes = ( $new['board_disable_adminview'] ) ? 'checked="checked"' : '';
$disable_board_adminview_no = ( !$new['board_disable_adminview'] ) ? 'checked="checked"' : '';
/*****[END]********************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
$dhtml_yes = ( $new['use_dhtml'] ) ? 'checked="checked"' : '';
$dhtml_no = ( !$new['use_dhtml'] ) ? 'checked="checked"' : '';
/*****[END]********************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
$admin_style_theme = ($new['use_theme_style']) ? 'checked="checked"' : '';
$admin_style_default = (!$new['use_theme_style']) ? 'checked="checked"' : '';
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/

$activation_none = ( $new['require_activation'] == USER_ACTIVATION_NONE ) ? 'checked="checked"' : '';
$activation_user = ( $new['require_activation'] == USER_ACTIVATION_SELF ) ? 'checked="checked"' : '';
$activation_admin = ( $new['require_activation'] == USER_ACTIVATION_ADMIN ) ? 'checked="checked"' : '';

$board_email_form_yes = ( $new['board_email_form'] ) ? 'checked="checked"' : '';
$board_email_form_no = ( !$new['board_email_form'] ) ? 'checked="checked"' : '';

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
$style_select = style_select('default_Theme');
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

$override_user_style_yes = ( $new['override_user_style'] ) ? 'checked="checked"' : '';
$override_user_style_no = ( !$new['override_user_style'] ) ? 'checked="checked"' : '';

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
$quick_search_enable_yes = ( $new['quick_search_enable'] ) ? 'checked="checked"' : '';
$quick_search_enable_no = ( !$new['quick_search_enable'] ) ? 'checked="checked"' : '';
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/

$lang_select = language_select($new['default_lang'], 'default_lang', NUKE_MODULES_DIR.'Forums/language');

/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
switch ($new['default_time_mode'])
{
    case MANUAL_DST:
        $time_mode_manual_dst_checked='checked="checked"';
        break;
    case SERVER_SWITCH:
        $time_mode_server_switch_checked='checked="checked"';
        break;
    case FULL_SERVER:
        $time_mode_full_server_checked='checked="checked"';
        break;
    case SERVER_PC:
        $time_mode_server_pc_checked='checked="checked"';
        break;
    case FULL_PC:
        $time_mode_full_pc_checked='checked="checked"';
        break;
    default:
        $time_mode_manual_checked='checked="checked"';
}
$timezone_select = tz_select($new['board_timezone'], 'board_timezone');
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
$enable_global_yes = ( $new['global_enable'] ) ? "checked=\"checked\"" : ""; 
$enable_global_no = ( !$new['global_enable'] ) ? "checked=\"checked\"" : ""; 

$marquee_disable_yes = ( $new['marquee_disable'] ) ? "checked=\"checked\"" : ""; 
$marquee_disable_no = ( !$new['marquee_disable'] ) ? "checked=\"checked\"" : ""; 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/
 
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/

$prune_yes = ( $new['prune_enable'] ) ? 'checked="checked"' : '';
$prune_no = ( !$new['prune_enable'] ) ? 'checked="checked"' : '';

/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
$report_email_yes = ( $new['report_email'] ) ? 'checked="checked"' : '';
$report_email_no = ( !$new['report_email'] ) ? 'checked="checked"' : '';
/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/

$namechange_yes = ( $new['allow_namechange'] ) ? 'checked="checked"' : '';
$namechange_no = ( !$new['allow_namechange'] ) ? 'checked="checked"' : '';

//General Template variables
$template->assign_vars(array(
    'DHTML_ID' => 'c' . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(
    'L_GENERAL_SETTINGS' => $lang['General_settings'],
    'L_SERVER_NAME' => $lang['Server_name'],
    'L_SERVER_PORT' => $lang['Server_port'],
    'L_SERVER_PORT_EXPLAIN' => $lang['Server_port_explain'],
    'L_SCRIPT_PATH' => $lang['Script_path'],
    'L_SCRIPT_PATH_EXPLAIN' => $lang['Script_path_explain'],
    'L_SITE_NAME' => $lang['Site_name'],
    'L_SITE_DESCRIPTION' => $lang['Site_desc'],
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
   'L_GLOBAL_TITLE' => $lang['Global_title'], 
   'L_GLOBAL_TITLE_EXPLAIN' => $lang['Global_title_explain'], 
   'L_GLOBAL' => $lang['Global'], 
   'L_GLOBAL_EXPLAIN' => $lang['Global_explain'], 
   'L_ENABLE_GLOBAL' => $lang['Enable_global'], 
   'L_ENABLE_GLOBAL_EXPLAI' => $lang['Enable_global_explain'], 
   'L_DISABLE_MARQUEE' => $lang['Global_marquee_effect'], 
   'L_DISABLE_MARQUEE_EXPLAIN' => $lang['Global_marquee_effect_explain'], 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/
    'L_DHTML' => $lang['dhtml_menu'],
    'L_DHTML_EXPLAIN' => $lang['dhtml_menu_explain'],
/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
    'L_ADMIN_STYLE' => $lang['admin_style'],
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
    'L_DISABLE_BOARD' => $lang['Board_disable'],
    'L_DISABLE_BOARD_EXPLAIN' => $lang['Board_disable_explain'],
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
    'L_DISABLE_BOARD_ADMINVIEW' => $lang['Board_disable_adminview'],
    'L_DISABLE_BOARD_ADMINVIEW_EXPLAIN' => $lang['Board_disable_adminview_explain'],
/*****[END]********************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
    'L_DISABLE_BOARD_MSG' => $lang['Board_disable_msg'],
    'L_DISABLE_BOARD_MSG_EXPLAIN' => $lang['Board_disable_msg_explain'],
/*****[END]********************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
    'L_ACCT_ACTIVATION' => $lang['Acct_activation'],
    'L_NONE' => $lang['Acc_None'],
    'L_USER' => $lang['Acc_User'],
    'L_ADMIN' => $lang['Acc_Admin'],
    'L_VISUAL_CONFIRM' => $lang['Visual_confirm'],
    'L_VISUAL_CONFIRM_EXPLAIN' => $lang['Visual_confirm_explain'],
    'L_BOARD_EMAIL_FORM' => $lang['Board_email_form'],
    'L_BOARD_EMAIL_FORM_EXPLAIN' => $lang['Board_email_form_explain'],
    'L_ENABLED' => $lang['Enabled'],
    'L_DISABLED' => $lang['Disabled'],
    'L_FLOOD_INTERVAL' => $lang['Flood_Interval'],
    'L_MAX_LOGIN_ATTEMPTS'         => $lang['Max_login_attempts'],
		'L_MAX_LOGIN_ATTEMPTS_EXPLAIN'   => $lang['Max_login_attempts_explain'],
		'L_LOGIN_RESET_TIME'         => $lang['Login_reset_time'],
		'L_LOGIN_RESET_TIME_EXPLAIN'   => $lang['Login_reset_time_explain'],
    'L_SEARCH_FLOOD_INTERVAL' => $lang['Search_Flood_Interval'],
    'L_SEARCH_FLOOD_INTERVAL_EXPLAIN' => $lang['Search_Flood_Interval_explain'],
		'MAX_LOGIN_ATTEMPTS'         => $new['max_login_attempts'],
    'LOGIN_RESET_TIME'            => $new['login_reset_time'],
    'L_FLOOD_INTERVAL_EXPLAIN' => $lang['Flood_Interval_explain'],
/*****[BEGIN]******************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
    'L_MAX_SMILIES' => $lang['Max_smilies'],
/*****[END]********************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
    'L_TOPICS_PER_PAGE' => $lang['Topics_per_page'],
    'L_POSTS_PER_PAGE' => $lang['Posts_per_page'],
    'L_HOT_THRESHOLD' => $lang['Hot_threshold'],
    'L_DEFAULT_STYLE' => $lang['Default_style'],
    'L_OVERRIDE_STYLE' => $lang['Override_style'],
    'L_OVERRIDE_STYLE_EXPLAIN' => $lang['Override_style_explain'],
/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
    'L_QUICK_SEARCH_ENABLE' => $lang['Quick_search_enable'],
    'L_QUICK_SEARCH_ENABLE_EXPLAIN' => $lang['Quick_search_enable_explain'],
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
    'L_DEFAULT_LANGUAGE' => $lang['Default_language'],
    'L_DATE_FORMAT' => $lang['Date_format'],
    'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'],
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
    'L_TIME_MODE' => $lang['time_mode'],
    'L_TIME_MODE_TEXT' => $lang['time_mode_text'],
    'L_TIME_MODE_MANUAL' => $lang['time_mode_manual'],
    'L_TIME_MODE_DST' => $lang['time_mode_dst'],
    'L_TIME_MODE_DST_SERVER' => $lang['time_mode_dst_server'],
    'L_TIME_MODE_DST_TIME_LAG' => $lang['time_mode_dst_time_lag'],
    'L_TIME_MODE_DST_MN' => $lang['time_mode_dst_mn'],
    'L_TIME_MODE_TIMEZONE' => $lang['time_mode_timezone'],
    'L_TIME_MODE_AUTO' => $lang['time_mode_auto'],
    'L_TIME_MODE_FULL_SERVER' => $lang['time_mode_full_server'],
    'L_TIME_MODE_SERVER_PC' => $lang['time_mode_server_pc'],
    'L_TIME_MODE_FULL_PC' => $lang['time_mode_full_pc'],
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
    'L_ONLINE_TIME' => $lang['Online_time'],
    'L_ONLINE_TIME_EXPLAIN' => $lang['Online_time_explain'],
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
    'L_ENABLE_PRUNE' => $lang['Enable_prune'],
/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
    'L_REPORT_EMAIL' => $lang['Report_email'],
/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
    'L_ALLOW_NAME_CHANGE' => $lang['Allow_name_change'])
);

if(!isset($time_mode_manual_checked))
$time_mode_manual_checked = '';

if(!isset($time_mode_manual_dst_checked))
$time_mode_manual_dst_checked = '';

if(!isset($time_mode_server_switch_checked))
$time_mode_server_switch_checked = '';

if(!isset($time_mode_full_server_checked))
$time_mode_full_server_checked = '';

if(!isset($time_mode_server_pc_checked))
$time_mode_server_pc_checked ='';

if(!isset($time_mode_full_pc_checked))
$time_mode_full_pc_checked ='';

//Data Template Variables
$template->assign_vars(array(
    'SERVER_NAME' => $new['server_name'],
    'SERVER_PORT' => $new['server_port'],
    'SCRIPT_PATH' => $new['script_path'],
    'SITENAME' => $new['sitename'],
    'SITE_DESCRIPTION' => $new['site_desc'],
/*****[BEGIN]******************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/ 
   'GLOBAL_TITLE' => $new['global_title'], 
   'GLOBAL_ANNOUNCEMENT' => $new['global_announcement'], 
   'S_ENABLE_GLOBAL_YES' => $enable_global_yes, 
   'S_ENABLE_GLOBAL_NO' => $enable_global_no, 
   'S_DISABLE_MARQUEE_YES' => $marquee_disable_yes, 
   'S_DISABLE_MARQUEE_NO' => $marquee_disable_no, 
/*****[END]********************************************
 [ Mod:    Scrolling Global Announcement        v1.0.1]
 ******************************************************/
    'S_DISABLE_BOARD_YES' => $disable_board_yes,
    'S_DISABLE_BOARD_NO' => $disable_board_no,
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
    'S_DISABLE_BOARD_ADMINVIEW_YES' => $disable_board_adminview_yes,
    'S_DISABLE_BOARD_ADMINVIEW_NO' => $disable_board_adminview_no,
/*****[END]********************************************
 [ Mod:     Disable Board Admin Override       v0.1.1 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
    'DISABLE_BOARD_MSG' => $new['board_disable_msg'],
/*****[END]********************************************
 [ Mod:     Disable Board Message              v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
    'DHTML_YES' => $dhtml_yes,
    'DHTML_NO' => $dhtml_no,
/*****[END]********************************************
 [ Mod:     DHTML Admin Menu                   v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
    'ADMIN_STYLE_THEME' => $admin_style_theme,
    'ADMIN_STYLE_DEFAULT' => $admin_style_default,
/*****[END]********************************************
 [ Mod:     Forum Admin Style Selection        v1.0.0 ]
 ******************************************************/
    'ACTIVATION_NONE' => USER_ACTIVATION_NONE,
    'ACTIVATION_NONE_CHECKED' => $activation_none,
    'ACTIVATION_USER' => USER_ACTIVATION_SELF,
    'ACTIVATION_USER_CHECKED' => $activation_user,
    'ACTIVATION_ADMIN' => USER_ACTIVATION_ADMIN,
    'ACTIVATION_ADMIN_CHECKED' => $activation_admin,
    'BOARD_EMAIL_FORM_ENABLE' => $board_email_form_yes,
    'BOARD_EMAIL_FORM_DISABLE' => $board_email_form_no,
    'FLOOD_INTERVAL' => $new['flood_interval'],
    'SEARCH_FLOOD_INTERVAL' => $new['search_flood_interval'],
/*****[BEGIN]******************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
    'MAX_SMILIES' => $new['max_smilies'],
/*****[END]********************************************
 [ Mod:    Limit smilies per post              v1.0.2 ]
 ******************************************************/
    'TOPICS_PER_PAGE' => $new['topics_per_page'],
    'POSTS_PER_PAGE' => $new['posts_per_page'],
    'HOT_TOPIC' => $new['hot_threshold'],
    'STYLE_SELECT' => $style_select,
    'OVERRIDE_STYLE_YES' => $override_user_style_yes,
    'OVERRIDE_STYLE_NO' => $override_user_style_no,
/*****[BEGIN]******************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
    'S_QUICK_SEARCH_ENABLE_YES' => $quick_search_enable_yes,
    'S_QUICK_SEARCH_ENABLE_NO' => $quick_search_enable_no,
/*****[END]********************************************
 [ Mod:     Quick Search                       v3.0.1 ]
 ******************************************************/
    'LANG_SELECT' => $lang_select,
    'DEFAULT_DATEFORMAT' => $new['default_dateformat'],
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
    'TIME_MODE_MANUAL_CHECKED' => $time_mode_manual_checked,
    'TIME_MODE_MANUAL_DST_CHECKED' => $time_mode_manual_dst_checked,
    'TIME_MODE_SERVER_SWITCH_CHECKED' => $time_mode_server_switch_checked,
    'TIME_MODE_FULL_SERVER_CHECKED' => $time_mode_full_server_checked,
    'TIME_MODE_SERVER_PC_CHECKED' => $time_mode_server_pc_checked,
    'TIME_MODE_FULL_PC_CHECKED' => $time_mode_full_pc_checked,
    'DST_TIME_LAG' => $new['default_dst_time_lag'],
    'TIMEZONE_SELECT' => $timezone_select,
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
    'ONLINE_TIME' => $new['online_time'],
/*****[END]********************************************
 [ Mod:    Online/Offline/Hidden               v2.2.7 ]
 ******************************************************/
    'PRUNE_YES' => $prune_yes,
    'PRUNE_NO' => $prune_no,
/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
    'REPORT_EMAIL_YES' => $report_email_yes,
    'REPORT_EMAIL_NO' => $report_email_no,
/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
    'NAMECHANGE_YES' => $namechange_yes,
    'NAMECHANGE_NO' => $namechange_no
));
$template->pparse('general');

?>