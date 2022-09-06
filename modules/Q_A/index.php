<?php
#########################################################################
# Network Q & A                                                         #
#                                                                       #
# This program is free software. You can redistribute it and/or modify  #
# it under the terms of the GNU General Public License as published by  #
# the Free Software Foundation; either version 2 of the License.        #
#########################################################################
if (!defined('MODULE_FILE')) 
{
   die ("You can't access this file directly...");
}

global $network_prefix, $db, $cookie, $user, $theme_name;

$index = 1;

require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$pagetitle = "86it Developers Network - My ". _MARKSTITLE;

include("header.php");
//include("/pages/home/home.php");
header('Location: pages/home/home.php');
include("footer.php");
?>
