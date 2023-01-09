<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
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
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

require_once(NUKE_MODULES_DIR.$module_name.'/functions.php');

include_once(NUKE_BASE_DIR.'header.php');

$year = isset($_GET['year']) ? intval($_GET['year']) : 0;
$month = isset($_GET['month']) ? intval($_GET['month']) : 0;
$date = isset($_GET['date']) ? intval($_GET['date']) : 0;

switch(strtolower(isset($op))) {
    case 'stats':   Stats();                        break;
    case 'yearly':  YearlyStats($year);             break;
    case 'monthly': MonthlyStats($year,$month);     break;
    case 'daily':   DailyStats($year,$month,$date); break;
    default:        Stats_Main();                   break;
}

include_once(NUKE_BASE_DIR.'footer.php');

?>