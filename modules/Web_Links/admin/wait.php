<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Submissions Block
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : wait.php
   Author        : Quake
   Version       : 2.0.0
   Date          : 09/02/2006 (dd-mm-yyyy)

   Notes         : Overview about submissions and other useful information
                   about your website.
************************************************************************/

if(!defined('NUKE_EVO')) {
    exit;
}

global $admin_file, $titanium_db, $titanium_prefix, $titanium_cache;

$titanium_module_name = basename(dirname(dirname(__FILE__)));

if(is_active($titanium_module_name)) {
    $content .= "<div align=\"left\"><strong><u><span class=\"content\">"._AWL."</span>:</u></strong></div>";
    if(($numbrokenl = $titanium_cache->load('numbrokenl', 'submissions')) === false) {
        $result = $titanium_db->sql_query("SELECT COUNT(*) FROM ".$titanium_prefix."_links_modrequest WHERE brokenlink='1'");
        list($numbrokenl) = $titanium_db->sql_fetchrow($result, SQL_NUM);
        $titanium_db->sql_freeresult($result);
        $titanium_cache->save('numbrokenl', 'submissions', $numbrokenl);
    }
    if(($nummodreql = $titanium_cache->load('nummodreql', 'submissions')) === false) {
        $result = $titanium_db->sql_query("SELECT COUNT(*) FROM ".$titanium_prefix."_links_modrequest WHERE brokenlink='0'");
        list($nummodreql) = $titanium_db->sql_fetchrow($result, SQL_NUM);
        $titanium_db->sql_freeresult($result);
        $titanium_cache->save('nummodreql', 'submissions', $nummodreql);
    }
    if(($numwaitl = $titanium_cache->load('numwaitl', 'submissions')) === false) {
        $result = $titanium_db->sql_query("SELECT COUNT(*) FROM ".$titanium_prefix."_links_newlink");
        list($numwaitl) = $titanium_db->sql_fetchrow($result, SQL_NUM);
        $titanium_db->sql_freeresult($result);
        $titanium_cache->save('numwaitl', 'submissions', $numwaitl);
    }
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">"._BROKENLINKS."</a>:&nbsp;<strong>$numbrokenl</strong><br />";
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=LinksListModRequests\">"._MODREQLINKS."</a>:&nbsp;<strong>$nummodreql</strong><br />";
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=Links\">"._WLINKS."</a>:&nbsp;<strong>$numwaitl</strong><br />";
}

?>