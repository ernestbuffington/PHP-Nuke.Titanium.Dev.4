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
** File upgrade_steps/3.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

$template->set_custom_template('../setup/style/upgrade', 'upgrade.html');
$template->set_filenames(['index'=>'upgrade.html']);
$handle = 'index';
$user->set_lang('admin/install',$user->ulanguage);
$dbadd = ['table' => [], 'row' => []];
$dbupdate = [];
    foreach($tables as $val)
    {
        $sql = "Select COLUMN_NAME, COLUMN_TYPE, COLUMN_DEFAULT, CHARACTER_SET_NAME, COLLATION_NAME, COLUMN_KEY, IS_NULLABLE, EXTRA  FROM information_schema.columns where Table_name = '{$db_prefix}_{$val}' AND TABLE_SCHEMA = '{$db_name}' ";
        $var = $db->sql_query($sql);
        if (!$db->sql_numrows($var))
        {
            $dbadd['table'][] = $val;
        }
        else
        {
            while ($row = $db->sql_fetchrow($var))
            {
                if(!isset($table_schema[$val][$row['COLUMN_NAME']]))
                continue;
                $alter = false;
                if($table_schema[$val][$row['COLUMN_NAME']]['TYPE'] != $row['COLUMN_TYPE'])
                {
                $alter = true;
                }
                if($table_schema[$val][$row['COLUMN_NAME']]['Collation'] != $row['COLLATION_NAME'])
                {
                $alter = true;
                }
                if($table_schema[$val][$row['COLUMN_NAME']]['Characterset'] != $row['CHARACTER_SET_NAME'])
                {
                $alter = true;
                }
                if($table_schema[$val][$row['COLUMN_NAME']]['Default'] != (($row['IS_NULLABLE'] == 'YES')? 'NULL' : $row['COLUMN_DEFAULT']))
                {
                $alter = true;
                }
                if($table_schema[$val][$row['COLUMN_NAME']]['NULL'] != (($row['IS_NULLABLE'] == 'YES')? '' : 'NOT NULL'))
                {
                $alter = true;
                }
                if($table_schema[$val][$row['COLUMN_NAME']]['Key'] != $row['COLUMN_KEY'])
                {
                $alter = true;
                }
                if($table_schema[$val][$row['COLUMN_NAME']]['Extra'] != $row['EXTRA'])
                {
                $alter = true;
                }
                if($alter)$dbupdate[] = $table_schema[$val][$row['COLUMN_NAME']]['ALTER'];
                unset($table_schema[$val][$row['COLUMN_NAME']]);
            }
            if((is_countable($table_schema[$val]) ? count($table_schema[$val]) : 0) <= '0')
            {
                unset($table_schema[$val]);
            }
            else
            {
                foreach($table_schema[$val] as $con)
                {
                $dbadd['row'][] = $con['ADD'];
                }
            }
        }
    }
    //die(print_r($dbadd['table']));
$tchan = count($dbadd['table']);
$rchan = count($dbadd['row']);
$ralt  = count($dbupdate);
$fp = fopen('../setup/sql/install-'.$db_type.".sql","r");
$installscript = "";
if($fp)
{
    while (!feof($fp)) $installscript .= @fgets($fp,1000);
    @fclose($fp);
    unset($fp);
}
$scripts = explode(";",$installscript);
$sql_schema = [];
unset($installscript);
foreach ($scripts as $script) {
    if (!preg_match('/^CREATE TABLE IF NOT EXISTS `#prefix#_([\\w]*)`[^;]*$/sim', $script, $matches)) continue;
    $matches[0] = $matches[0] . ";"; //Splitting string removes semicolon
    $script = str_replace("#prefix#",$db_prefix,$matches[0]);
    $sql_schema[$matches[1]] = $script;
}
$sql_table = [];
#insert new tables
//die(print_r($dbadd['table']));
$passtables = $dbadd['table'];
foreach($passtables as $val)
{
    $db->sql_query($sql_schema[$val]);
}
#Update Rows as needed
foreach($dbupdate as $val)
{
    $var = str_replace("ALTER TABLE `", "ALTER TABLE `" . $db_prefix . "_", (string) $val);
    $db->sql_query($var);
}
#Add Missing Rows
$passrow = $dbadd['table'];
foreach($passrow as $val)
{
    $var = str_replace("ALTER TABLE `", "ALTER TABLE `" . $db_prefix . "_", (string) $val);
    $db->sql_query($var);
}
#Add Missing information
$tupd = $table_vals;
foreach($tupd as $var=>$val)
{
    $table = $var;
    $check = $val['check'];
    foreach($val['van'] as $v=>$d)
    {
        sql_add($check, $table, $d, $val['add'][$v], $val['asvas']);
    }
    //$db->sql_query($vas);
}
       $template->assign_vars(['BTMVERSION'        => sprintf($user->lang['INLINE_UPDATE_SUCCESSFUL'],$tchan,$rchan,$ralt), 'LANGIMG'           => $langpic, 'STEPIMG'           => $stepimg, 'OPSYSIMG'          => $os . ".png"]);
if (extension_loaded('zlib')){ ob_end_clean();}
if (function_exists('ob_gzhandler') && !ini_get('zlib.output_compression'))
    ob_start('ob_gzhandler');
else
    ob_start();
ob_implicit_flush(0);
$template->display($handle);
die();
