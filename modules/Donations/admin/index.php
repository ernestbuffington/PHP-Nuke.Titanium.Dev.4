<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (!defined('ADMIN_FILE')) {
    die('Access Denied');
}

global $prefix, $db, $admin_file, $admdata;
$module_name = basename(dirname(dirname(__FILE__)));

$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='$module_name'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < count($admins); $i++) {
    if ($admdata['name'] == $admins[$i] && !empty($row['admins'])) {
        $auth_user = 1;
    }
}

define_once('NUKE_DONATIONS', dirname(dirname(__FILE__)) . '/');
define_once('NUKE_DONATIONS_INCLUDES', NUKE_DONATIONS . '/includes/');
define_once('NUKE_DONATIONS_ADMIN', dirname(__FILE__) . '/');
define_once('NUKE_DONATIONS_ADMIN_INCLUDES', NUKE_DONATIONS_ADMIN . 'includes/');

include_once(NUKE_DONATIONS_ADMIN_INCLUDES . 'base.php');

if ($admdata['radminsuper'] != 1 && $auth_user != 1) {
    DisplayError($lang_donate['ACCESS_DENIED']);
}

if (!empty($file)){
    //Look for . / \ and kick it out
    if (preg_match('/.*?(\/|\.|\\\)/i',$file)) {
        DisplayError($lang_donate['ACCESS_DENIED']);
    }
}

function Main($file) {
    global $lang_donate;
    head_open($lang_donate['DONATIONS']);
    config_select();
    if(!empty($file)) {
        if(file_exists(NUKE_DONATIONS_ADMIN_INCLUDES.$file.'.php')){
            include_once(NUKE_DONATIONS_ADMIN_INCLUDES.$file.'.php');
        }
    }
    foot_close();
}

if(!isset($file))
$file = '';

Main($file);

?>