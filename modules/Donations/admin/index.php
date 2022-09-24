<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (!defined('ADMIN_FILE')) {
    die('Access Denied');
}

global $titanium_prefix, $titanium_db, $admin_file, $admdata;
$titanium_module_name = basename(dirname(dirname(__FILE__)));

$row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT title, admins FROM ".$titanium_prefix."_modules WHERE title='$titanium_module_name'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < count($admins); $i++) {
    if ($admdata['name'] == $admins[$i] && !empty($row['admins'])) {
        $auth_user = 1;
    }
}

define('NUKE_DONATIONS', dirname(dirname(__FILE__)) . '/');
define('NUKE_DONATIONS_INCLUDES', NUKE_DONATIONS . '/includes/');
define('NUKE_DONATIONS_ADMIN', dirname(__FILE__) . '/');
define('NUKE_DONATIONS_ADMIN_INCLUDES', NUKE_DONATIONS_ADMIN . 'includes/');

include_once(NUKE_DONATIONS_ADMIN_INCLUDES . 'base.php');

if ($admdata['radminsuper'] != 1 && $auth_user != 1) {
    DisplayError($titanium_lang_donate['ACCESS_DENIED']);
}

if (!empty($file)){
    //Look for . / \ and kick it out
    if (preg_match('/.*?(\/|\.|\\\)/i',$file)) {
        DisplayError($titanium_lang_donate['ACCESS_DENIED']);
    }
}

function Main($file) {
    global $titanium_lang_donate;
    head_open($titanium_lang_donate['DONATIONS']);
    config_select();
    if(!empty($file)) {
        if(file_exists(NUKE_DONATIONS_ADMIN_INCLUDES.$file.'.php')){
            include_once(NUKE_DONATIONS_ADMIN_INCLUDES.$file.'.php');
        }
    }
    foot_close();
}

Main($file);

?>