<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System 
 ========================================================================

 Nuke-Evo Base          :   2.1.0
 Nuke-Evo Version       :   RC3
 Nuke-Evo Build         :   463
 Nuke-Evo Patch         :   0
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   04-May-2009

 Copyright (c) 2007 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $db, $prefix, $startdate, $ab_config, $currentlang, $cache, $cache_debug;

static $total_hits;

$hits = 0;
$content  = '';

if(!($total_hits = $cache->load('total_website_hits', 'titanium_hits'))) {
$result = $db->sql_ufetchrow('SELECT `count` FROM `'._COUNTER_TABLE.'` WHERE `type`="total" AND `var`="hits" LIMIT 1');
$total_hits = $result['count'];
$db->sql_freeresult($result);
$cache->save('total_website_hits', 'titanium_hits', $total_hits);
$hits = $total_hits;
if($cache_debug === 1)
$content .= '<div align="center">Saving zf1 Cache...</div></br>';
$content .= "<div style='text-align: center; width: 100%;'>\n";
$content .= "<p style='text-align: center;'>We Have Recieved</p>\n";
$content .= "<p style='text-align: center; font-weight: bold; font-size: large;'><a href='modules.php?name=Statistics'>".number_format ( $hits , 0 , "." , "," )."</a></p>";
$content .= "<p style='text-align: center;'>Page Views Since</br>".$startdate."</p>\n";
$content .= "</div>\n";
}
else
{
if($cache_debug === 1)	
$content .= '<div align="center">Loading zf1 Cache...</div></br>';
$content .= "<div style='text-align: center; width: 100%;'>\n";
$content .= "<p style='text-align: center;'>We Have Recieved</p>\n";
$content .= "<p style='text-align: center; font-weight: bold; font-size: large;'><a href='modules.php?name=Statistics'>".number_format ( $total_hits , 0 , "." , "," )."</a></p>";
$content .= "<p style='text-align: center;'>Page Views Since</br>".$startdate."</p>\n";
$content .= "</div>\n";
}

