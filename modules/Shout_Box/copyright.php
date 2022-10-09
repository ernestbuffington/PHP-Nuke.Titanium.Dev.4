<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

define('CP_INCLUDE_DIR', dirname(dirname(dirname(__FILE__))));
require_once(CP_INCLUDE_DIR.'/includes/showcp.php');

// To have the Copyright window work in your module just fill the following
// required information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)
// NOTE: in $download_location PLEASE give the direct download link to the file!!!

$author_name = "Aric Bolf (SuperCat) / Updated & AJAX'ed by Technocrat (nuke-evolution.com)";
$author_email = "webmaster (at) ourscripts (dot) net";
$author_homepage = "http://www.ourscripts.net";
$license = "GNU/GPL";
$download_location = "http://www.ourscripts.net";
$module_version = "8.6.0";
$module_description = "Let the visitors to your site speak up! The block is very easy to use, the shout history module lets everyone see and search all previous shouts. The admin area controls it all. Compatability for browsers including Firefox, Opera, NS, IE, Safari, Konquerer, and Mozilla make this a cross platform application. This ensures a great user experience! What a great way to let others build content on your site! Administration area to control what people can say and do. Add your own smilies too! Censor words people find offensive. Uses the PHP-Nuke SQL abstraction layer. Auto scrolls with mouseover scroller controls. Includes both .sql and .php SQL installers, SQL repair tool, Setup and Security monitor, full URL support, anonymous nicks censoring, no cloning registered nicknames, spam/flood protection, error reporting, ban users by IP or nickname, uses theme CSS, server time offset, history uses forum avatars, and more!";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

show_copyright($author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description);

?>