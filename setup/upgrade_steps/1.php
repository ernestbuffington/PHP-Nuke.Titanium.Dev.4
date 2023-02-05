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
** File upgrade_steps/1.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

$template->set_custom_template('../setup/style/upgrade', 'front.html');
$template->set_filenames(['index'=>'front.html']);
$dbadd = ['table' => [], 'row' => []];
$dbupdate = [];
//$tables = array('avatar_config');
$html = '';
//die($db_name);
    foreach($tables as $val)
    {
        $sql = "SELECT `COLUMN_NAME`, `COLUMN_TYPE`, `COLUMN_DEFAULT`, `CHARACTER_SET_NAME`, `COLLATION_NAME`, `COLUMN_KEY`, `IS_NULLABLE`, `EXTRA` FROM information_schema.columns WHERE `Table_name` = '{$db_prefix}_{$val}' AND `TABLE_SCHEMA` = '{$db_name}' ";
        //die($sql);
        $var = $db->sql_query($sql);
        if (!$db->sql_numrows($var))
        {
            $dbadd['table'][] = $val;
        }
        else
        {
            while ($row = $db->sql_fetchrow($var))
            {
/*$html .= "            '" . $row['COLUMN_NAME'] . "'   => array(\n";
$html .= "              'name'          => '" . $row['COLUMN_NAME'] . "',\n";
$html .= "              'TYPE'          => '" . str_replace("'","\'",$row['COLUMN_TYPE']) . "',\n";
$html .= "              'Collation'     => '" . $row['COLLATION_NAME'] . "',\n";
$html .= "              'Characterset'  => '" . $row['CHARACTER_SET_NAME'] . "',\n";
$html .= "              'Default'       => '" . (($row['IS_NULLABLE'] == 'YES')? 'NULL' : $row['COLUMN_DEFAULT']) . "',\n";
$html .= "              'NULL'          => " . (($row['IS_NULLABLE'] == 'YES')? '\'\'' : '\'NOT NULL\'') . ",\n";
$html .= "              'Key'           => '" . $row['COLUMN_KEY'] . "',\n";
$html .= "              'Extra'         => '" . $row['EXTRA'] . "',\n";
$html .= "              'ADD'           => 'ALTER TABLE `avatar_config` ADD `" . $row['COLUMN_NAME'] . "` " . str_replace("'","\'",$row['COLUMN_TYPE']) . "" . (($row['CHARACTER_SET_NAME'])? " CHARACTER SET " . $row['CHARACTER_SET_NAME'] : '') . "" . (($row['COLLATION_NAME'])? " COLLATE " . $row['COLLATION_NAME'] : '') . "" . (($row['IS_NULLABLE'] == 'YES')? '' : ' NOT NULL ') . " DEFAULT " . (($row['IS_NULLABLE'] == 'YES')? ' NULL ' : "\'" . $row['COLUMN_DEFAULT'] . "\'") . "',\n";
$html .= "              'ALTER'         => 'ALTER TABLE `avatar_config` CHANGE `" . $row['COLUMN_NAME'] . "` `" . $row['COLUMN_NAME'] . "` " . str_replace("'","\'",$row['COLUMN_TYPE']) . "" . (($row['CHARACTER_SET_NAME'])? " CHARACTER SET " . $row['CHARACTER_SET_NAME'] : '') . "" . (($row['COLLATION_NAME'])? " COLLATE " . $row['COLLATION_NAME'] : '') . " DEFAULT " . (($row['IS_NULLABLE'] == 'YES')? ' NULL ' : "\'" . $row['COLUMN_DEFAULT'] . "\'") . "',\n";
$html .= "              ),\n";*/
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
    //die($html);
$tchan = count($dbadd['table']);
$rchan = count($dbadd['row']);
$ralt  = count($dbupdate);
        $template->assign_vars(['BTMVERSION'        => sprintf($user->lang['NOTICE_DB_CHANGES_ND'],$tchan,$rchan,$ralt), 'LANGIMG'           => $langpic, 'STEPIMG'           => $stepimg, 'OPSYSIMG'          => $os . ".png", 'S_LANG'            => $language]);
$handle = 'index';
$user->set_lang('httperror',$user->ulanguage);
if (extension_loaded('zlib')){ ob_end_clean();}
if (function_exists('ob_gzhandler') && !ini_get('zlib.output_compression'))
    ob_start('ob_gzhandler');
else
    ob_start();
ob_implicit_flush(0);
$template->display($handle);
die();
?>
