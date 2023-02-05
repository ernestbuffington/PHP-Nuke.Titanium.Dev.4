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
** File steps/2.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

echo "<input type=\"hidden\" name=\"step\" value=\"3\" />\n";

echo "<p align=\"center\"><font size=\"5\">"._step2."</font></p>\n";

echo "<p>&nbsp;</p>\n";
echo "<p align=\"center\">"._gpllicense."</p>\n";
echo "<p align=\"center\"><textarea rows=\"10\" cols=\"60\">";
readfile("gpl.txt");
echo "</textarea></p>\n";
echo "<p align=\"center\"><input type=\"radio\" name=\"gpl\" value=\"yes\" />"._iagree." <input type=\"radio\" name=\"gpl\" value=\"no\" />"._idontagree."</p>\n";

echo "<p>&nbsp</p>\n";
echo "<p align=\"center\">"._lgpllicense."</p>\n";
echo "<p align=\"center\"><textarea rows=\"10\" cols=\"60\">";
readfile("lgpl.txt");
echo "</textarea></p>\n";
echo "<p align=\"center\"><input type=\"radio\" name=\"lgpl\" value=\"yes\" />"._iagree." <input type=\"radio\" name=\"lgpl\" value=\"no\" />"._idontagree."</p>\n";

if (isset($error)) echo "<p><font class\"err\">"._step2fail."</font></p>";

echo "<p><input type=\"submit\" value=\""._nextstep."\" /></p>\n";

?>