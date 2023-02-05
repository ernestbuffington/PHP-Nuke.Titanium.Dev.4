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
** And Joe Robertson (aka joeroberts/Black_Heart) for Bit Torrent Manager Contribution!
** And Technocrat for the Nuke Evolution Contributions
** And The Mortal, and CoRpSE for the Nuke Evolution Xtreme Contributions
** Project Leaders: TheGhost, NukeSheriff, TheWolf, CodeBuzzard, CyBorg, and  Pipi
** File upgrade.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

if (!ini_get('display_errors'))
{
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
}

define("IN_NUKE",true);
define("IN_PMBT",true);
define('INSETUP',true);
define('PMBT_ROOT',str_replace('setup','',__DIR__));

set_include_path(PMBT_ROOT);
ini_set('include_path',PMBT_ROOT);

require_once(SETUP_INCLUDE_DIR."configdata.php");
require_once("include/db/database.php");

$phpEx = 'php';
$data = '';

$db = new sql_db($db_host, $db_user, $db_pass, $db_name, $db_persistency) or die("Class error");

if(!$db->db_connect_id) {
        die("d14:failure reason26:Cannot connect to databasee");
}

//This way we protect database authentication against hacked mods
unset($db_host,$db_user,$db_pass,$db_persistency);

$sql = "SELECT * FROM ".$db_prefix."_config LIMIT 1;";

$configquery = $db->sql_query($sql);

if (!$configquery) die($sql."PHP-Nuke Titanium not correctly installed! Ensure you have run setup!!");
if (!$row = $db->sql_fetchrow($configquery)) die("PHP-Nuke Titanium not correctly installed! Ensure you have run setup!!");
$sitename = $row["sitename"];
$siteurl = $row["siteurl"];
$admin_email = $row["admin_email"];
$language = $row["language"];
$theme = $row["theme"];
$version = $row["version"];


require_once'include/class.cache.php';
require_once("include/functions.php");
require_once("include/class.user.php");
if ($use_rsa) require_once("include/rsalib.php");
if ($use_rsa) $rsa = New RSA($rsa_modulo, $rsa_public, $rsa_private);
if(!isset($_COOKIE["btuser"]))$_COOKIE["btuser"] = '';
$user = new User($_COOKIE["btuser"]);
$theme = $user->theme;
$user->set_lang('admin/install',$user->ulanguage);
function sql_add($check, $td, $rd, $arr, $dos)
{
	global $db, $db_prefix;
	$sql = "SELECT * FROM " . $db_prefix . "_" . $td . " WHERE `" . $check . "` = '" . $rd . "' LIMIT 1;";
	$vna = $db->sql_query($sql);
	if (!$db->sql_numrows($vna))
	{
		$db->sql_query("INSERT INTO `" . $db_prefix . "_" . $td . "` " . $dos . "  VALUES (" . $arr . ")");
	}
}
/* backup the db OR just a table */
function backup_tables($tables = '*',$struc=false,$data=false,$name='backup')
{
    global $db;
	//get all of the tables
	$return = '';
	if($tables == '*')
	{
		$tables = [];
		$result = $db->sql_query('SHOW TABLES');
		while($row = $db->sql_fetchrow($result))
		{
			foreach($row as $var=>$val)$table = $val;
			$tables[] = $table;
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',(string) $tables);
	}

	//cycle through
	foreach($tables as $table)
	{
		$result = $db->sql_query('SELECT * FROM ' . $table);
		$num_fields = $db->sql_numfields($result);
		if($struc)$return.= 'DROP TABLE '.$table.';';
		$row2 = $db->sql_fetchrow($db->sql_query('SHOW CREATE TABLE '.$table));
		if($struc)$return.= "\n\n".$row2['Create Table'].";\n\n";

		if($data){
		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = $db->fetch_array($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes((string) $row[$j]);
					$row[$j] = preg_replace("/\\n/","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		}
		$return.="\n\n\n";
	}
	//save file
	mkdir("../backups");
	$handle = fopen('../backups/'.$name.'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	$zipname = "../backups/{$name}.zip";
	passthru("nice -n 16 zip -q -r {$zipname} ../backups ");
	unlink("../backups/{$name}.sql");
	$f=fopen('../backups/'.$name.'.zip',"r");
	if($f)
	{
		fclose($f);
		return $name;
	}
		return false;
}
function stepimage() {
        global $step, $gpl, $lgpl, $truestep;
        switch ($step) {
                case "0": {
                        return "Language.png";
                }
                case "1": {
                        return "Requirements.png";
                }
                case "2": {
                        return "License.png";
                }
                case "3": {
                        if ((!isset($gpl) OR $gpl != "yes" OR !isset($lgpl) OR $lgpl != "yes") AND !isset($truestep)) return "License.png";
                        else return "Database.png";
                }
                case "4": {
                        return "Install.png";
                }
                case "5": {
                        return "Settings.png";
                }
                case "6": {
                        return "Admin.png";
                }
                case "7": {
                        return "Runtime.png";
                }
                case "8": {
                        return "Runtime.png";
                }
                case "9": {
                        return "Runtime.png";
                }
        }
}
include('setup/class.template.php');
require_once("include/actions.php");
require_once("include/user.functions.php");
include('include/auth.php');
include('setup/convert/data.php');
$auth = new auth();
$auth->acl($user);
$template = new Template();
if(!$auth->acl_get('a_server'))
{
	$user->set_lang('common',$user->ulanguage);
	$user->set_lang('admin/install',$user->ulanguage);
	$template->set_custom_template('../setup/style/upgrade', 'message_body.html');
	$template->set_filenames(['message_body'=>'message_body.html']);
	$template->assign_vars(['S_ERROR'   => true, 'S_FORWARD' => '', 'TITTLE_M'  => $user->lang['BT_ERROR'], 'MESSAGE'   => $user->lang['LOGIN_SITE']]);
	$handle = 'message_body';

	$template->display($handle);
	die();
}
$config = ['load_tplcompile'	=> '1'];
$template->set_custom_template('../setup/style/upgrade', 'index.html');
$template->set_filenames(['index'=>'index.html']);
$step			= request_var('step', 0);
$stepimg = stepimage();
$stepimg = "graphics/".$stepimg;
$language			= request_var('language', '');
if (isset($language) AND $language != "" AND is_readable("../language/admin/install/".$language.".php")) {
	$user->set_lang('common',$language);
	$user->set_lang('admin/install',$language);
	$langpic = "language/".$language.".png";
} else $langpic = "graphics/blank.gif";
/*
Operating System Analysis
Useful for setup help
*/
if (strtoupper(substr(PHP_OS,0,3)) == "WIN") $os = "Windows";
else $os = "Linux";
#INTERFACE HERE
require_once("upgrade_steps/".$step.".php");
die();
?>
