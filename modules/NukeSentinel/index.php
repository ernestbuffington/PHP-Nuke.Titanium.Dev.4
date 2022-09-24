<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeSentinel™                                        */
/* By: NukeScripts™ (http://nukescripts.86it.us)        */
/* Copyright (c) 2000-2008 by NukeScripts™              */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/ 
if(!defined('MODULE_FILE')) die ('You can\'t access this file directly...');
define('NUKESENTINEL_PUBLIC',true);
$titanium_module_name = basename(dirname(__FILE__));
$ab_config = abget_configs();
$checkrow = $titanium_db->sql_numrows($titanium_db->sql_query('SELECT `ip_lo` FROM `'.$titanium_prefix.'_nsnst_ip2country` LIMIT 0,1'));
if($checkrow > 0) $tableexist = 1; else $tableexist = 0; 
if(!isset($op)) $op='';
if($op == 'STIP2C' AND $tableexist != 1) $op = 'STIndex';
if(!$op) $op = 'STIndex';
include_once(NUKE_MODULES_DIR.$titanium_module_name.'/public/functions.php');
switch($op):
  case 'STIndex':include(NUKE_MODULES_DIR.$titanium_module_name.'/public/STIndex.php');break; 
  case 'STIPS':include(NUKE_MODULES_DIR.$titanium_module_name.'/public/STIPS.php');break;
  case 'STRanges':include(NUKE_MODULES_DIR.$titanium_module_name.'/public/STRanges.php');break;
  case 'STReferers':include(NUKE_MODULES_DIR.$titanium_module_name.'/public/STReferers.php');break;
  case 'STIP2C':include(NUKE_MODULES_DIR.$titanium_module_name.'/public/STIP2C.php');break;
endswitch;
?>
