<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

function changemail() {
    global $db, $user_prefix, $module_name, $sitekey, $user, $stop, $cookie, $userinfo;

    $get_id = $_GET['id'];
    $check_num = $_GET['check_num'];
    $newmail = $_GET['mail'];

    include_once(NUKE_BASE_DIR.'header.php');
    title(_CHANGEMAILTITLE);
    opentable();
    ya_mailCheck($newmail);
    list($get_username, $tuemail) = $db -> sql_fetchrow($db -> sql_query("SELECT username, user_email FROM ".$user_prefix."_users WHERE user_id = '$get_id'"));
    $datekey = date("F Y");
    $check_num2 = substr(md5(hexdec($datekey) * hexdec($userinfo['user_password']) * hexdec($sitekey) * hexdec($newmail) * hexdec($tuemail)), 2, 10);
    if ((is_user()) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo[user_password] == $cookie[2])) {
        if ($stop == '') {
            if ( (strtolower($userinfo['username']) == strtolower($get_username)) AND ($check_num2 == $check_num) ) {
                $result = $db->sql_query("UPDATE ".$user_prefix."_users SET user_email='$newmail' WHERE user_id='$get_id'");
                if ($result) echo ""._CHANGEMAILOK.""; else echo ""._CHANGEMAILNOT."";
            } else {
                echo ""._CHANGEMAILNOT."";
            }
        } else {
            echo "$stop";
        }
    } else echo ""._CHANGEMAILNOTUSER."";
    
    closetable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

?>