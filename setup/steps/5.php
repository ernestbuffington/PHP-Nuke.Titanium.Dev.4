<?php
/**

*****************************************************************************************
** PHP-Nuke Titanium v4.0.4 - Project Start Date 11/04/2022 Friday 4:09 am             **
*****************************************************************************************
** https://www.php-nuke-titanium.86it.us
** https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4
** https://www.php-nuke-titanium.86it.us/index.php (DEMO)
** Apache License, Version 2.0. MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File steps/5.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')

**/
require_once("setup_config.php");
require_once("functions.php");
require_once(SETUP_NUKE_INCLUDES_DIR.'functions_selects.php');
require_once(SETUP_INCLUDE_DIR."configdata.php");
require_once(SETUP_UDL_DIR."database.php");

global $db_type, $db_host, $db_user, $db_pass, $db_name, $db_prefix, $db_persistency, $use_rsa, $rsa_modulo, $rsa_public, $rsa_private, $uploads_dir;
global $step, $next_step, $install_lang, $server_check;

    $db = new sql_db($db_host, $db_user, $db_pass, $db_name, $db_persistency);

    $_SESSION['dbhost'] = $db_host;
    $_SESSION['dbuser'] = $db_user;
    $_SESSION['dbpass'] = $db_pass;
    $_SESSION['dbname'] = $db_name;
    $_SESSION['dbtype'] = $db_type;
    $_SESSION['user_prefix'] = $db_prefix;
	$_SESSION['prefix'] = $db_prefix;

if (!$server_check = mysqli_connect($_SESSION['dbhost'], $_SESSION['dbuser'], $_SESSION['dbpass'], $_SESSION['dbname'])){
        die ($install_lang['couldnt_connect'] . mysqli_error($server_check));
}

$confirm = $_POST['confirm'] ?? '';
    if (!$confirm){

		$plorp = substr(strrchr((string) $_SERVER['REQUEST_URI'],'/'), 1);
		$script_uri = substr((string) $_SERVER['REQUEST_URI'], 0, - strlen($plorp));
		$script_uri = rtrim($script_uri, '/');

		$http_scheme = $_SERVER['REQUEST_SCHEME'] ?: 'http';

		echo '<form action="" method="post">';
		echo '<div align="center"><div style="color:white;"><strong>'.$nuke_name.' '.$install_lang['installer_heading'].' '.$step.' '.$install_lang['installer_heading2'].' '.$total_steps.'</strong></div></div>';
		echo '<fieldset><legend><div style="color:white;">'.$install_lang['setup_admin'].'</div></legend>';
		echo '  <dl>';
		echo '    <dt><label><div style="color:white;">'.$install_lang['admin_nick'].'</div></label></dt>';
		echo '    <dd><input type="text" name="admin_nick" size="40" class="input" required /></dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label><div style="color:white;">'.$install_lang['admin_pass'].'</div></label></dt>';
		echo '    <dd><input type="password" name="admin_pass" size="40" class="input" required /></dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label><div style="color:white;">'.$install_lang['admin_cpass'].'</div></label></dt>';
		echo '    <dd><input type="password" name="admin_cpass" size="40" class="input" required /></dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label><div style="color:white;">'.$install_lang['admin_email'].'</div></label></dt>';
		echo '    <dd><input type="text" name="admin_email" size="40" class="input" required /></dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label><div style="color:white;">'.$install_lang['admin_web'].'</div></label></dt>';
		echo '    <dd><input type="text" name="admin_website" size="40" class="input" value="'.$http_scheme.'://'.$_SERVER['SERVER_NAME'].'" required /></dd>';
		echo '  </dl>';
		echo '</fieldset>';
		echo '<div align="center"><input type="hidden" name="step" value="'.$step.'"><input type="submit" class="button" name="confirm" value="'.$install_lang['confirm_data'].'"></div>';
		echo '</form>';
	} else {
		echo '<form action="" method="post">';
		echo '<div align="center"><div style="color:white;"><strong>'.$nuke_name.' '.$install_lang['installer_heading'].' '.$step.' '.$install_lang['installer_heading2'] . " ".$total_steps.'</strong></div></div>';
		echo '<fieldset><legend><div style="color:white;">'.$install_lang['admin_check'].'</div></legend>';
		echo '<div style="text-align: left;">';
		echo validate_admin();
		echo '</div>';
		echo '</fieldset>';
		echo '</form>';
	}
?>
