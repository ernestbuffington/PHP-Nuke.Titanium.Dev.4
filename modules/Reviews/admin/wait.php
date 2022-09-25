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

global $admin_file, $titanium_db, $titanium_prefix, $cache;

$titanium_module_name = basename(dirname(dirname(__FILE__)));

if(is_active($titanium_module_name)) {
    $content .= "<div align=\"left\"><strong><u><span class=\"content\">"._AREV."</span>:</u></strong></div>";
    if(($numwaitreviews = $cache->load('numwaitreviews', 'submissions')) === false) {
        list($numwaitreviews) = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT COUNT(*) FROM ".$titanium_prefix."_reviews_add"), SQL_NUM);
        $cache->save('numwaitreviews', 'submissions', $numwaitreviews);
    }
    $content .= "<img src=\"images/arrow.gif\" alt=\"\" />&nbsp;<a href=\"".$admin_file.".php?op=reviews\">"._WREVIEWS."</a>:&nbsp;<strong>$numwaitreviews</strong><br />";
}

?>