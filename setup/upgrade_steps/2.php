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
** File upgrade_steps/2.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

$template->set_custom_template('../setup/style/upgrade', 'database.html');
$template->set_filenames(['index'=>'database.html']);
$op         = request_var('op', '');
if($op == 'backup')
{
    $today = getdate();
    $day = $today['mday'];
    if ($day < 10) {
        $day = "0$day";
    }
    $month = $today['mon'];
    if ($month < 10) {
        $month = "0$month";
    }
    $year = $today['year'];
    $hour = $today['hours'];
    $min = $today['minutes'];
    $sec = "00";
    $name = $db_name."-".$day."-".$month."-".$year;
    if($name = backup_tables('*',true,true,$name))
    {
        $wite = 'BACKUP_SUCCESS';
        $pass = true;
    }
    else
    {
        $wite = 'FILE_WRITE_FAIL';
        $pass = false;
    }
        $template->assign_vars(['BTMVERSION'        => $user->lang[$wite], 'LANGIMG'           => $langpic, 'STEPIMG'           => $stepimg, 'NAME'              => $name, 'SITE_URL'          => $siteurl, 'OPSYSIMG'          => $os . ".png", 'S_LANG'            => $language, 'DONE'              => $pass]);
}
else
{
}
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
