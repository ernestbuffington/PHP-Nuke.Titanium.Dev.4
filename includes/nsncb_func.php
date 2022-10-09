<?php

/********************************************************/
/* NSN Center Blocks                                    */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/* Ported for Nuke-Evolution by Quake                   */
/* http://www.evo-mods.com                              */
/* Additional Porting by co0kz & Rodmar                 */
/* http://www.cookie-creations.net                      */
/* http://www.evolved-Systems.net                       */
/********************************************************/
/* Original by: Richard Benfield                        */
/* http://www.benfield.ws                               */
/********************************************************/
/* Caching system and static variabeles by Quake        */
/* http://www.evo-mods.com                              */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/29/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

define("NSNCBLOCKS_IS_LOADED", TRUE);

// Load required lang file
global $language;
if(!isset($lang)) { $lang = $language; }
if(!preg_match("/\./","$lang") AND file_exists(NUKE_LANGUAGE_DIR.'cblocks/lang-'.$lang.'.php')) {
  require_once(NUKE_LANGUAGE_DIR.'cblocks/lang-'.$lang.'.php');
} else {
  require_once(NUKE_LANGUAGE_DIR.'cblocks/lang-english.php');
}

function cb_blocks($rid) {
    global $prefix, $db, $cache;
    static $cb_blocks;
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v1.0.0 ]
 ******************************************************/
    if(!isset($cb_blocks)) {
        if(!($cb_blocks = $cache->load('cb_blocks', 'config'))) {
/*****[END]********************************************
 [ Base:    Caching System                     v1.0.0 ]
 ******************************************************/
            $result = $db->sql_query("SELECT * FROM `".$prefix."_nsncb_blocks`");
            while($row = $db->sql_fetchrow($result)) {
                $cb_blocks[$row['rid']][] = $row;
            }
            $db->sql_freeresult($result);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v1.0.0 ]
 ******************************************************/
            $cache->save('cb_blocks', 'config', $cb_blocks);
        }
/*****[END]********************************************
 [ Base:    Caching System                     v1.0.0 ]
 ******************************************************/
    }
    foreach($cb_blocks[$rid] as $row) {
        $title = $row['title'];
        $filename = $row['filename'];
        $content = $row['content'];
        if(empty($filename) AND $content > "") {
            themecenterbox($title, $content);
        } elseif($filename > "" AND empty($content)) {
            $file = @file_exists(NUKE_BLOCKS_DIR.$filename);
            if(!$file) {
                $content = _BLOCKPROBLEM;
            } else {
                include(NUKE_BLOCKS_DIR.$filename);
            }
            if(empty($content)) { $content = _BLOCKPROBLEM2; }
            themecenterbox($title, $content);
        } elseif(empty($filename) AND empty($content)) {
            $content = _BLOCKPROBLEM2;
            themecenterbox($title, $content);
        }
    }
}

function CBSample($set) {
    global $db, $prefix;
    $cbinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsncb_config` WHERE `cgid`='$set'"));
    if($cbinfo['height'] <> "0") { $cheight = "height='".$cbinfo['height']."' "; } else { $cheight = ""; }
    OpenTable();
    echo "<table width='100%' ".$cheight."border='0' cellspacing='1' cellpadding='0' bgcolor='$bgcolor2'><tr><td valign='top'>\n";
    echo "<table width='100%' ".$cheight."border='0' cellspacing='1' cellpadding='4' bgcolor='$bgcolor1'><tr>";
    $result3 = $db->sql_query("SELECT * FROM `".$prefix."_nsncb_blocks` WHERE `cgid`='$set' ORDER BY `cbid`");
    while($cbidinfo = $db->sql_fetchrow($result3)) {
        if($cbidinfo['cbid'] <= $cbinfo['count']) {
            if($cbidinfo['wtype'] == '0') {
                echo "<td width='".$cbidinfo['width']."' valign='top' align='center'>\n";
            } else {
                echo "<td width='".$cbidinfo['width']."%' valign='top' align='center'>\n";
            }
            cb_blocks($cbidinfo['rid']);
            echo "</td>\n";
        }
    }
    echo "</tr></table>\n";
    echo "</td></tr></table>\n";
    CloseTable();
    echo "<br />";
}

function CBMenu() {
    global $admin_file;
    OpenTable();
    echo "<center>";
    echo "<a href='".$admin_file.".php?op=CenterBlocksSet1'>"._CB_CONFIG1."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=CenterBlocksSet2'>"._CB_CONFIG2."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=CenterBlocksSet3'>"._CB_CONFIG3."</a><br />\n";
    echo "<a href='".$admin_file.".php?op=CenterBlocksSet4'>"._CB_CONFIG4."</a><br />\n";
    echo "</center>";
    CloseTable();
}

?>