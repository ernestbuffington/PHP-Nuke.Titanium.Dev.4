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
/* v1.0                                                                 */
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
-=[Fixes]=-
      Completely rewritten module              v1.0.0       08/24/2005
-=[Mod]=-
      Extended Surveys Admin Interface         v1.0.0       08/24/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

$pnt_module = basename(dirname(__FILE__));
get_lang($pnt_module);

if(isset($pollID)) $pollID = intval($pollID);
if(isset($voteID)) $voteID = intval($voteID);

if(!isset($pollID)) {
    include_once(NUKE_BASE_DIR.'header.php');
    pollList();
    include_once(NUKE_BASE_DIR.'footer.php');
} elseif(isset($forwarder)) {
    pollCollector($pollID, $voteID, $forwarder);
} elseif($op == 'results' && $pollID > 0) {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<center><span class=\"title\"><strong>"._CURRENTPOLLRESULTS."</strong></span></center>";
    CloseTable();
    echo "<br /><table border='0' width='100%'><tr><td width='70%' valign='top'>";
    OpenTable();
    pollResults($pollID);
    CloseTable();
    echo "</td><td>&nbsp;</td><td width='30%' valign='top'>";
    OpenTable();
    echo "<strong>"._LAST5POLLS." $sitename</strong><br /><br />";
    if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=$userinfo[umode]"; }
    if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=$userinfo[uorder]"; }
    if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=$userinfo[thold]"; }
    $resu = $titanium_db->sql_query("SELECT pollID, pollTitle, voters FROM ".$titanium_prefix."_poll_desc WHERE artid='0' ORDER BY timeStamp DESC LIMIT 1,6");
    while (list($plid, $pltitle, $plvoters) = $titanium_db->sql_fetchrow($resu)) {
        if ($pollID == $plid) {
            echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;$pltitle ($plvoters "._LVOTES.")<br /><br />";
        } else {
            echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<a href=\"modules.php?name=$pnt_module&amp;op=results&amp;pollID=$plid$r_options\">$pltitle</a> ($plvoters "._LVOTES.")<br /><br />";
        }
    }
    $titanium_db->sql_freeresult($resu);
    echo "<a href=\"modules.php?name=$pnt_module\"><strong>"._MOREPOLLS."</strong></a>";
    CloseTable();
    echo "</td></tr></table>";
    if ($pollcomm && $mode != "nocomments") {
        echo "<br /><br />";
        include(NUKE_MODULES_DIR.$pnt_module."/comments.php");
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} elseif($voteID > 0) {
    pollCollector($pollID, $voteID);
} elseif($pollID != pollLatest()) {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<center><span class=\"option\"><strong>"._SURVEY."</strong></span></center>";
    CloseTable();
    echo "<br /><br /><table border=\"0\" align=\"center\"><tr><td>";
    pollMain($pollID);
    echo "</td></tr></table>";
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<center><span class=\"option\"><strong>"._CURRENTSURVEY."</strong></span></center>";
    CloseTable();
    echo "<br /><br /><table border=\"0\" align=\"center\"><tr><td>";
    pollMain(pollLatest());
    echo "</td></tr></table>";
    include_once(NUKE_BASE_DIR.'footer.php');
}

/*********************************************************/
/* Functions                                             */
/*********************************************************/

function pollMain($pollID) {
    global $boxTitle, $boxContent, $pollcomm, $titanium_user, $titanium_prefix, $titanium_db, $pnt_module;
    if(!isset($pollID)) $pollID = 1;
    include_once(NUKE_MODULES_DIR.$pnt_module.'/includes/pollblock.php');
    global $content;
    themesidebox(_SURVEY, $content, "poll1");
}

function pollLatest() {
    global $titanium_prefix, $multilingual, $currentlang, $titanium_db;
    $querylang = "";
    if ($multilingual) { $querylang = "AND planguage='$currentlang' OR planguage=''"; }
    $result = $titanium_db->sql_query("SELECT pollID FROM ".$titanium_prefix."_poll_desc WHERE artid='0' $querylang ORDER BY pollID DESC LIMIT 1");
    $pollID = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    return($pollID[0]);
}

function pollCollector($pollID, $voteID, $forwarder) {
    global $titanium_prefix, $titanium_db, $titanium_config, $identify;
    $ip = $identify->get_ip();
    $number_of_days = intval($titanium_config['poll_days']);
    $past = time()-86400*$number_of_days;
    $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_poll_check WHERE time < $past");
    $result = $titanium_db->sql_query("SELECT ip FROM ".$titanium_prefix."_poll_check WHERE ip='$ip' AND pollID='$pollID'");
    list($ips) = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    if ($ip != $ips) {
        $ctime = time();
        $titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_poll_check (ip, time, pollID) VALUES ('$ip', '$ctime', '$pollID')");
        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_poll_data SET optionCount=optionCount+1 WHERE pollID='$pollID' AND voteID='$voteID'");
        if (!empty($voteID)) {
            $titanium_db->sql_query("UPDATE ".$titanium_prefix."_poll_desc SET voters=voters+1 WHERE pollID='$pollID'");
        }
    }
    redirect_titanium("$forwarder");
    exit;
}

function pollList() {
    global $titanium_user, $titanium_prefix, $multilingual, $currentlang, $admin, $titanium_db, $pnt_module, $admin_file;

    $r_options = '';
    if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=$userinfo[umode]"; }
    if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=$userinfo[uorder]"; }
    if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=$userinfo[thold]"; }
    $editing = '';

    OpenTable();
    echo "<center><span class=\"title\"><strong>"._PASTSURVEYS."</strong></span></center>";
    echo "<table border=\"0\" cellpadding=\"8\"><tr><td>";
    $querylang = "";
    if ($multilingual) { $querylang = "AND planguage='$currentlang' OR planguage=''"; }
    $result = $titanium_db->sql_query("SELECT pollID, pollTitle, voters FROM ".$titanium_prefix."_poll_desc WHERE artid='0' $querylang ORDER BY timeStamp DESC");
    while(list($plID, $plTitle, $voters) = $titanium_db->sql_fetchrow($result)) {
        if (is_mod_admin($pnt_module)) { $editing = ' - <a href="'.$admin_file.'.php?op=PollEdit&amp;pollID='.$plID.'">Edit</a>'; }
        echo "<img src=\"images/arrow.gif\" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\">&nbsp;<a href=\"modules.php?name=$pnt_module&amp;pollID=$plID\">$plTitle</a> ";
        echo "(<a href=\"modules.php?name=$pnt_module&amp;op=results&amp;pollID=$plID$r_options\">"._RESULTS."</a> - $voters "._LVOTES."$editing)<br />\n";
    }
    $titanium_db->sql_freeresult($result);
    echo "</td></tr></table><br />";
    CloseTable();
}

function pollResults($pollID) {
    global $resultTableBgColor, $resultBarFile, $Default_Theme, $titanium_user, $titanium_prefix, $titanium_db, $admin, $pnt_module, $admin_file;

    if(!isset($pollID)) $pollID = 1;
    $result = $titanium_db->sql_query("SELECT pollID, pollTitle, artid FROM ".$titanium_prefix."_poll_desc WHERE pollID='$pollID'");
    $holdtitle = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    echo "<strong>$holdtitle[1]</strong><br /><br />";

    $result = $titanium_db->sql_query("SELECT SUM(optionCount) FROM ".$titanium_prefix."_poll_data WHERE pollID='$pollID'");
    list($sum) = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    echo "<table border=\"0\">";

    /* cycle through all options */
    $result = $titanium_db->sql_query("SELECT optionText, optionCount FROM ".$titanium_prefix."_poll_data WHERE pollID='$pollID' AND optionText!='' ORDER BY voteID");
    while(list($optionText, $optionCount) = $titanium_db->sql_fetchrow($result)) {
        echo "<tr><td>$optionText</td>";
        $percent = 0;
        if($sum) {
            $percent = 100 * $optionCount / $sum;
        }
        echo "<td>";
        $percentInt = (int)$percent * 4 * 1;
        $percent2 = (int)$percent;
        $ThemeSel = get_theme();
        if (file_exists('themes/'.$ThemeSel."/images/survey_leftbar.gif") AND file_exists('themes/'.$ThemeSel."/images/survey_mainbar.gif") AND file_exists('themes/'.$ThemeSel."/images/survey_rightbar.gif")) {
            $l_size = @getimagesize('themes/'.$ThemeSel.'/images/survey_leftbar.gif');
            $m_size = @getimagesize('themes/'.$ThemeSel.'/images/survey_mainbar.gif');
            $r_size = @getimagesize('themes/'.$ThemeSel.'/images/survey_rightbar.gif');
            $leftbar = "survey_leftbar.gif";
            $mainbar = "survey_mainbar.gif";
            $rightbar = "survey_rightbar.gif";
        } else {
            $l_size = @getimagesize('themes/'.$ThemeSel.'/images/leftbar.gif');
            $m_size = @getimagesize('themes/'.$ThemeSel.'/images/mainbar.gif');
            $r_size = @getimagesize('themes/'.$ThemeSel.'/images/rightbar.gif');
            $leftbar = "leftbar.gif";
            $mainbar = "mainbar.gif";
            $rightbar = "rightbar.gif";
        }
        if (file_exists('themes/'.$ThemeSel.'/images/survey_mainbar_d.gif')) {
            $m1_size = @getimagesize('themes/'.$ThemeSel.'/images/survey_mainbar_d.gif');
            $mainbar_d = "survey_mainbar_d.gif";
            if ($percent2 > 0 AND $percent2 <= 23) {
                $salto = "<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$percentInt\">";
            } elseif ($percent2 > 24 AND $percent2 < 50) {
                $a = $percentInt - 100;
                $salto = "<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\">";
            } elseif ($percent2 > 49 AND $percent2 < 75) {
                $a = $percentInt - 200;
                $salto = "<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\">";
            } elseif ($percent2 > 74 AND $percent2 <= 100) {
                $a = $percentInt - 300;
                $salto = "<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
                        ."<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\">";
            }
        }
        if ($percent > 0) {
            echo "<img src=\"".'themes/'.$ThemeSel."/images/$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
            if (file_exists("".'themes/'.$ThemeSel."/images/survey_mainbar_d.gif")) {
                echo "$salto";
            } else {
                echo "<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" height=\"$m_size[1]\" width=\"$percentInt\" alt=\"$percent2 %\" title=\"$percent2 %\">";
            }
            echo "<img src=\"".'themes/'.$ThemeSel."/images/$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
        } else {
            echo "<img src=\"".'themes/'.$ThemeSel."/images/$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
            if (!file_exists("".'themes/'.$ThemeSel."/images/survey_mainbar_d.gif")) {
                echo "<img src=\"".'themes/'.$ThemeSel."/images/$mainbar\" height=\"$m_size[1]\" width=\"$m_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
            }
            echo "<img src=\"".'themes/'.$ThemeSel."/images/$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
        }
        printf(" %.2f%% (%s)", $percent, $optionCount);
        echo "</td></tr>";
    }
    $titanium_db->sql_freeresult($result);
    echo "</table><br />";
    echo "<center><span class=\"content\">";
    echo "<strong>"._TOTALVOTES." $sum</strong><br />";
    echo "<br /><br />";
    $article = "";
    if ($holdtitle[3] > 0) { $article = "<br /><br />"._GOBACK; }
    echo "[ <a href=\"modules.php?name=$pnt_module&amp;pollID=$pollID\">"._VOTING."</a> | "
        ."<a href=\"modules.php?name=$pnt_module\">"._OTHERPOLLS."</a> ] $article </span></center>";
    if (is_mod_admin($pnt_module)) {
        echo '<br /><center>[ <a href="'.$admin_file.'.php?op=CreatePoll">'._ADD.'</a> | <a href="'.$admin_file.'.php?op=PollEdit&amp;pollID='.$pollID.'">'._EDIT.'</a> ]</center>';
    }
    return(1);
}

?>