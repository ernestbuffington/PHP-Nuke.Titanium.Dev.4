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
** File steps/0.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

if (!defined('INSETUP'))
    die ("You Can't Access this File Directly");

echo "<p align=\"center\"><font size=\"5\">Please Select your Language:</font></p>\n";
echo "<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">\n";

$langdir = opendir("language");
$maxtd   = 3;
$td      = 0;

while ($langfile = readdir($langdir)) {
        if (!preg_match("/\.php$/",$langfile)) continue;
        if ($td == 0) echo "<tr>";
        $lang = substr($langfile,0,strpos($langfile,"."));
        echo "<td><div align=\"center\"><a href=\"index.php?step=1&language=".$lang."\"><img src=\"language/".$lang.".png\" border=\"0\" alt=\"".ucwords($lang)."\" /></a></div></td>\n";

        $td++;
        if ($td == $maxtd) {
                echo "</tr>";
                $td = 0;
        }
}
if ($td != 0) echo "</tr>";
closedir($langdir);
echo "</table>\n";

?>