<?php

/**
*****************************************************************************************
** PHP-AN602  (Titanium Edition) v1.0.0 - Project Start Date 11/04/2022 Friday 4:09 am **
*****************************************************************************************
** https://an602.86it.us/
** https://github.com/php-an602/php-an602
** https://an602.86it.us/index.php (DEMO)
** Apache License, Version 2.0, MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File steps/6.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

require_once(SETUP_INCLUDE_DIR."configdata.php");
require_once(SETUP_UDL_DIR."database.php");
function is_email($email) {
        return preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\\-+)|([A-Za-z0-9]+\\.+)|([A-Za-z0-9]+\\++))*[A-Za-z0-9]+@((\\w+\\-+)|(\\w+\\.))*\\w{1,63}\\.[a-zA-Z]{2,6}$/",(string) $email);
}

$db = new sql_db($db_host, $db_user, $db_pass, $db_name, $db_persistency);
$can_proceed = false;
$errors = ["username" => false, "usernamelong" => false, "password" => false, "passwordconf" => false, "email" => false];
    $sql = "SELECT * FROM ".$db_prefix."_config LIMIT 1;";
    $configquery = $db->sql_query($sql);
    if (!$configquery) die("Configuration not found! Make sure you have installed phpMyBitTorrent correctly.");
    if (!$row = $db->sql_fetchrow($configquery)) die("phpMyBitTorrent not correctly installed! Ensure you have run setup.php or config_default.sql!!");
    $give_sign_up_credit = $row['give_sign_up_credit'];
    $force_passkey = ($row["force_passkey"] == "true") ? true : false;
    $db->sql_freeresult($configquery);
if (!isset($postback)) {
        $username = $email = $fullname = "";
        $showpanel = true;
} else {

        $can_proceed = true;
        if (!isset($username) OR $username == "") {
                $username = "";
                $errors["username"] = true;
                $can_proceed = false;
        } elseif (strlen((string) $username) > 25) {
                $username = substr((string) $username,0,25);
                $errors["usernamelong"] = true;
                $can_proceed = false;
        }
        if (!isset($password) OR $password == "") {
                $errors["password"] = true;
                $can_proceed = false;
        }
        if (isset($password) AND $password != $passwordconf) {
                $errors["passwordconf"] = true;
                $can_proceed = false;
        }
        if (!isset($email) OR !is_email($email)) {
                $errors["email"] = true;
                $can_proceed = false;
        }
        if (!isset($fullname) OR $fullname == "") $fullname = "NULL";
        else $fullname = "'".addslashes((string) $fullname)."'";
    if($force_passkey)
    {
            $passkey = ", '".RandomAlpha(32)."'";
            $passkeyrow = ', passkey';
    }
    else
    {
        $passkeyrow = NULL;
        $passkey = NULL;
    }
}
if (!$can_proceed) $showpanel = true;
else $showpanel = false;

if ($showpanel) {
        echo "<input type=\"hidden\" name=\"step\" value=\"6\" />\n";

        echo "<p align=\"center\"><font size=\"5\">"._step6."</font></p>\n";
        echo "<p>&nbsp;</p>\n";
        echo "<p>"._step6explain."</p>\n";
        echo "<p>&nbsp;</p>\n";

        //Show form
        echo "<table width=\"100%\">\n";

        //Username
        echo "<tr><td><p>"._username."</p></td><td><p><input type=\"text\" name=\"username\" value=\"".$username."\" size=\"40\" />";
        if ($errors["username"]) echo "<br />\n<font class=\"err\">"._usernamereq."</font>";
        elseif ($errors["usernamelong"]) echo "<br />\n<font class=\"err\">"._usernametoolong."</font>";
        echo "</p></td>";

        //Password
        echo "<tr><td><p>"._password."</p></td><td><p><input type=\"password\" name=\"password\" size=\"40\" />";
        if ($errors["password"]) echo "<br />\n<font class=\"err\">"._passwordreq."</font>";
        echo "</p></td>";

        //Confirm Password
        echo "<tr><td><p>"._passwordconf."</p></td><td><p><input type=\"password\" name=\"passwordconf\" size=\"40\" />";
        if ($errors["passwordconf"]) echo "<br />\n<font class=\"err\">"._passwordnomatch."</font>";
        echo"</p></td>";

        //Email
        echo "<tr><td><p>"._email."</p></td><td><p><input type=\"text\" name=\"email\" value=\"".$email."\" size=\"40\" />";
        if ($errors["email"]) echo "<br />\n<font class=\"err\">"._emailinvalid."</font>";
        echo"</p></td>";

        //Full Name
        echo "<tr><td><p>"._fullname."</p></td><td><p><input type=\"text\" name=\"fullname\" value=\"".$fullname."\" size=\"40\" /></p></td>";

        echo "</table>\n";

        echo "<p><input type=\"submit\" name=\"postback\" value=\""._nextstep."\" /></p>\n";
}

if ($can_proceed) {
        //Run Query
        //Full name has already been escaped
        //We don't care of the act_key field because it serves only as activation code
        $act_key = base64_encode(microtime());
        $sql = "INSERT INTO `".$db_prefix."_user_group` (`group_id`, `user_id`, `group_leader`, `user_pending`) VALUES ('5', '1', '0', '0');";
        $db->sql_query($sql) or nuke_sqlerror($sql);
        $sql = "INSERT INTO ".$db_prefix."_users (id, username, clean_username, password, email, name, uploaded, active".$passkeyrow.", act_key, level, can_do, user_rank, user_type, regdate) VALUES(1, '".addslashes((string) $username)."','".addslashes(strtolower((string) $username))."','".md5((string) $password)."','".addslashes((string) $email)."', ".$fullname.", '".$give_sign_up_credit."', 1".$passkey.",'".$act_key."', 'admin', '5', '1', '3', NOW());";
        if (!$db->sql_query($sql)) {
                //Error
                $err = $db->sql_error();
                echo "<p>";
                echo "<font class=\"err\">";
                echo _nuke_sql_error1.htmlspecialchars($sql);
                echo "<br />" ;
                echo _nuke_sql_error2.$err["code"];
                echo "<br />";
                echo _nuke_sql_error3.$err["message"];
                echo "</font></p>";
        } else
        {
            //Login Admin
            $session_time = time() + 31_536_000;
            $cookiedata = ['1', addslashes((string) $username), md5((string) $password), $act_key];
            if ($use_rsa)
            {
                require_once("../include/rsalib.php");
                $rsa = New RSA($rsa_modulo, $rsa_public, $rsa_private);
                $cookiedata = $rsa->encrypt($cookiedata);
            }
            else
            {
                $cookiedata = base64_encode($cookiedata);
            }
            setcookie("btuser",(string) $cookiedata, ['expires' => $session_time, 'path' => (string) $cookiepath, 'domain' => (string) $cookiedomain, 'secure' => 0]);

                //Go ahead
                header("Location: index.php?step=7&language=".$language);
                die();
                echo "<p>"._step6complete."</p>";

                echo "<input type=\"hidden\" name=\"step\" value=\"7\" />\n";
                echo "<p><input type=\"submit\" value=\""._nextstep."\" /></p>\n";
        }

}

//$db->sql_query("",END_TRANSACTION);
$db->sql_close();

?>
