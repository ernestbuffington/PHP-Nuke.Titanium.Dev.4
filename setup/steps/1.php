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
** File steps/1.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

echo "<input type=\"hidden\" name=\"step\" value=\"2\" />\n";

echo "<p align=\"center\"><font size=\"5\">"._step1."</font></p>\n";

function err() {
        echo "<font class=\"err\">"._error."</font>";
}
function warn() {
        echo "<font class=\"warn\">"._warning."</font>";
}
function ok() {
        echo "<font class=\"ok\">"._ok."</font>";
}

$error = false;
$warn = false;

echo "<p>";

//PHP Version
echo _phpvercheck;
echo " - ". phpversion();
echo " - ";
if (phpversion() < "8.1") {
        $error = true;
        err();
        echo " - "._phpverfail;
} else ok();
echo "<br />";

//ZLib
echo _zlibcheck;
echo " - ";
if (!extension_loaded("zlib")) {
        $warn = true;
        warn();
        echo " - "._zlibfail;
} else ok();
echo "<br />";

//MySQL
echo _mysqlcheck;
echo " - ";
if (!extension_loaded("mysql") AND !extension_loaded("mysqli")) {
        $error = true;
        err();
        echo " - "._mysqlfail;
} else {
        ok();
        echo " - ";
        if(extension_loaded("mysql"))
        {
			echo "The MySql Extension is no longer supported!";
        }
        else
        {
            echo "MySqli " . mysqli_get_client_info();
        }
}

echo "<br />";


//Checking against PHP's DOM XML
echo _domxmlcheck;
echo " - ";
if (phpversion() < '5' AND !extension_loaded("domxml")) {
        $warn = true;
        warn();
        echo " - "._domxmlnotinstalled;
        echo "<br />\n";
        echo _domxmlload;
        if (!dl((PHP_OS=="WINNT"||PHP_OS=="WIN32") ? "../include/extensions/domxml.dll" : "../include/extensions/domxml.so")) {
                $error = true;
                err();
                echo " - "._domxmlcantload;
        }
} else ok();

echo "<br />";

//External
echo _externalcheck;
echo " - ";
$fp = fopen(SETUP_URL_CHECK,"r");
if (!$fp) {
        $warn = true;
        warn();
        echo " - "._externalfail;
} else ok();
fclose($fp);

echo "<br />";

//Just checking the operating system
echo _oscheck . " - ". PHP_OS;

echo '<br />';

echo _udp_check;
echo " - ";
if(!getscrapedata('udp://tracker.coppersurfer.tk:6969/scrape', false, [utf8_decode('Ñd>[÷lzÜ5ÉE')=>preg_replace_callback('/./s', "hex_esc", str_pad(utf8_decode('Ñd>[÷lzÜ5ÉE'),20))]))
{
warn();
echo '<br />';
echo _udpfail;
}
else
ok();

echo '<br />';

echo _cachefolder;
echo " - ";
if (!is__writable(SETUP_CACHE_DIR))
{
    err();
    $error = true;
    echo '<br />';
    echo _cache_fail;
}
else
ok();

echo '<br />';

echo _avatarfolder;
echo " - ";
if (!is__writable(SETUP_FORUM_AVATARS_DIR))
{
warn();
echo '<br />';
echo _avatarfail;
}
else
ok();

echo '<br />';

echo _forum_avatars;
echo " - ";
if (!is__writable(SETUP_FORUM_FILE_DIR))
{
warn();
echo '<br />';
echo _forum_avatars_fail;
}
else
ok();

echo '<br />';

echo _google_site_map;
echo " - ";
if (!is__writable(SETUP_GOOGLE_SITE_MAP_DIR))
{
err();
$warn = true;
$error = true;
echo '<br />';
echo _google_site_map_fail;
}
else
ok();

echo '<br />';

echo _image_repository_folder;
echo " - ";
if (!is__writable(SETUP_IMAGE_REPOSITORY_DIR))
{
warn();
echo '<br />';
echo _image_repository_folder_fail;
}
else
ok();

echo '<br />';

echo _file_repository_folder;
echo " - ";
if (!is__writable(SETUP_FILE_REPOSITORY_DIR))
{
warn();
echo '<br />';
echo _file_repository_folder_fail;
}
else
ok();

echo '<br />';

echo _log_folder;
echo " - ";
if (!is__writable(SETUP_LOG_DIR))
{
warn();
echo '<br />';
echo _log_folder_fail;
}
else
ok();

echo "</p>";

if (!$error) {
        if ($warn) echo "<p>"._step1warn."</p>\n";
        echo "<p><input type=\"submit\" value=\""._nextstep."\" /></p>\n";
} else echo "<p align=\"center\">"._step1fail."</p>\n;";

?>
