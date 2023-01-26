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
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $cookie, $prefix, $multilingual, $currentlang, $db, $user, $userinfo;

$querylang = ($multilingual) ? "AND (alanguage='$currentlang' OR alanguage='')" : '';

$today = getdate();

$day = $today['mday'];

if ($day < 10) 
{
    $day = "0$day";
}

$month = $today['mon'];

if ($month < 10) 
{
    $month = "0$month";
}

$year = $today['year'];

$tdate = "$year-$month-$day";

list($sid, $title) = $db->sql_ufetchrow("SELECT sid, title FROM ".$prefix."_blogs WHERE (datePublished LIKE '%$tdate%') $querylang ORDER BY counter DESC LIMIT 0,1", SQL_NUM);

$fsid = intval($sid);

$ftitle = stripslashes($title);

$content = "<span class=\"content\">";

if ((!$fsid) AND (!$ftitle)) 
{
    $content .= _NOBIGSTORY."</span>";
} 
else 
{
    $content .= _BIGSTORY."<br /><br />";

    if (!isset($mode) OR empty($mode)) 
	{
        $mode = (!empty($userinfo['umode'])) ? $userinfo['umode'] : "thread";
    }
    
	if (!isset($order) OR empty($order)) 
	{
        $order = (!empty($userinfo['uorder'])) ? $userinfo['uorder'] : 0;
    }
    
	if (!isset($thold) OR empty($thold)) 
	{
        $thold = (!empty($userinfo['thold'])) ? $userinfo['thold'] : 0;
    }
    
	$r_options = '';
    $r_options .= "&amp;mode=".$mode;
    $r_options .= "&amp;order=".$order;
    $r_options .= "&amp;thold=".$thold;
    $content .= "<a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$fsid$r_options\">$ftitle</a></span>";
}
?>
