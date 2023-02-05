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
** File graphics/graphics.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

if (!defined('INSETUP'))
    die ("Error 404 - Page Not Found");

function makeheader() {
        global $step;
        echo "<table border=\"0\" width=\"780\" height=\"176\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
        <td width=\"356\" rowspan=\"2\" height=\"183\"><img height=\"183\" alt=\"\" src=\"graphics/1.jpg\" width=\"356\"></td><td 
		width=\"424\" height=\"91\"><img height=\"91\" alt=\"\" src=\"graphics/2.jpg\" width=\"424\" hspace=\"0\" vspace=\"0\"></td>
        </tr>
        <tr>
        <td width=\"424\" height=\"92\"><img height=\"64\" alt=\"\" src=\"graphics/3.jpg\" width=\"102\" border=\"0\"><img height=\"64\" alt=\"\" 
		src=\"graphics/4.jpg\" width=\"63\" border=\"0\"><img height=\"64\" alt=\"\" src=\"graphics/5.jpg\" width=\"55\" border=\"0\"><img 
		height=\"64\" alt=\"\" src=\"graphics/6.jpg\" width=\"145\" border=\"0\"><img height=\"64\" alt=\"\" src=\"graphics/7.jpg\" width=\"59\"><br /><img height=\"28\" alt=\"\" src=\"graphics/8.jpg\" width=\"424\"></td>
        </tr>
        </table>\n";
}


function makefooter() {
        echo '<div align="center">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" height="43">
        <tr>
        <td colspan=6 style="background:url(graphics/11.jpg)" width="622" height="43">
        <div style="padding-top:5px"></div>
		<span style="font-size: x-small; color:#FFFFFF;">
		&nbsp;&nbsp;Copyright 2002-2022 The PHP-Nuke Titanium Group. All rights reserved.</br>
        &nbsp;&nbsp;Distributed under The Apache License, Version 2.0</br>
        &nbsp;&nbsp;Distributed also under the MIT license.
        </span>
        </td>
        <td width="34" height="43">
        <a href="https://www.php-nuke-titanium.86it.us/index.php"><img src="graphics/12.jpg" width="34" height="43" alt="" border="0" /></a></td>
        <td width="30" height="43">
        <a href="https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4"><img src="graphics/13.jpg" width="30" height="43" alt="" border="0" /></a></td>
        <td width="35" height="43">
        <a href="mailto:support@an602.86it.us"><img src="graphics/14.jpg" width="35" height="43" alt="" border="0" /></a></td>
        <td width="59" height="43">
        <img src="graphics/15.jpg" width="59" height="43" alt="" /></td>
        </tr>
        </table></div>




';
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
?>