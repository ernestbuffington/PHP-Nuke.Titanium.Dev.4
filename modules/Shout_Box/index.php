<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

// ==========================================
// PHP-NUKE: Shout Box
// ==========================
//
// Copyright (c) 2003-2005 by Aric Bolf (SuperCat)
// http://www.OurScripts.net
//
// Copyright (c) 2002 by Quiecom
// http://www.Quiecom.com
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation
// ===========================================

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       08/10/2005
      NukeSentinel                             v2.4.2       02/01/2006
-=[Mod]=-
      Advanced Username Color                  v1.0.5       10/29/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._SHOUTHISTORY;

global $db, $user, $prefix, $username, $nsnst_const, $userinfo, $cache;

global $username;
$username = $userinfo['username'];
if (empty($username)) { $username = "Anonymous"; }

include_once(NUKE_MODULES_DIR.'Shout_Box/shout.php');

global $conf;
if ((($conf = $cache->load('conf', 'shoutbox')) == false) || empty($conf)) {
    $sql = "SELECT * FROM `".$prefix."_shoutbox_conf`";
    $result = $db->sql_query($sql);
    $conf = $db->sql_fetchrow($result);
    $cache->save('conf', 'shoutbox', $conf);
    $db->sql_freeresult($result);
}

$Action = (isset($_REQUEST['Action'])) ? $_REQUEST['Action'] : '';

if ($Action == "AJAX") { die(); }

//do IP test then ban if on list
/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                       v2.4.2 ]
 ******************************************************/
$uip = $nsnst_const['remote_ip'];
/*****[END]********************************************
 [ Base:    NukeSentinel                       v2.4.2 ]
 ******************************************************/
if($conf['ipblock'] == "yes") {
    $sql = "SELECT * FROM ".$prefix."_shoutbox_ipblock";
    $ipresult = $db->sql_query($sql);
    while ($badips = $db->sql_fetchrow($ipresult)) {
        if (preg_match("/\*/i", $badips['name'])) { // Allow for Subnet bans like 123.456.*
            $badipsArray = explode(".",$badips['name']);
            $uipArray = explode(".",$uip);
            $i = 0;
            foreach($badipsArray as $badipsPart) {
                if ($badipsPart == "*") { $Action = "UserBanned"; break; }
                if ($badipsPart != $uipArray[$i] && $badipsPart != "*") { break; }
                $i++;
            }
        } else {
            if($uip == $badips['name']) { $Action = "UserBanned"; break; }
        }
    }
}

//do name test then ban if on list (only applies to registered users)
if($conf['nameblock'] == "yes" && $Action != "UserBanned") {
    $sql = "SELECT * FROM ".$prefix."_shoutbox_nameblock";
    $nameresult = $db->sql_query($sql);
    while ($badname = $db->sql_fetchrow($nameresult)) {
        if($username == $badname['name']) { $Action = "UserBanned"; break; }
    }
}

function searchHistory($where, $sbsearchtext, $results, $style, $order, $page) {
    global $db, $prefix, $username, $userinfo, $board_config;
    include_once(NUKE_BASE_DIR.'header.php');

    $sbsearchtext = htmlspecialchars($sbsearchtext, ENT_QUOTES);

    // search form
    OpenTable();
    showSearchBox($sbsearchtext, $where, $style, $results, $order);
    echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";
    echo "<tr><td align=\"center\"><a href=\"modules.php?name=Shout_Box&amp;page=1\">"._SHOUTHISTORY."</a></td></tr></table>";
    CloseTable();
    echo "<br />";
    // show results
    OpenTable();
    if ($results > 50) { $results = 50; }
    if ($results < 10) { $results = 10; }

    echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";
    echo "<tr><td align=\"center\"><span class=\"title\">"._SEARCHRESULTS."</span></td></tr>\n";
    //echo "<tr><td><table cellpadding=\"0\" width=\"100%\" cellspacing=\"0\" border=\"0\"><tr><td width=\"50%\" align=\"right\"><img width=\"50\" height=\"39\" src=\"modules/Shout_Box/history.gif\" alt=\"\" /></td><td width=\"50%\" align=\"left\" valign=\"middle\"><span class=\"title\">"._SEARCHRESULTS."</span></td></tr></table></td></tr>\n";
    // build SQL query based on user choices
    //$sql = "SELECT * FROM ".$prefix."_shoutbox_shouts WHERE name='$sbsearchtext' ORDER BY id DESC LIMIT $results";
    // search by Nicknames only
    if ($where == 'Nicknames') {
        $SearchArray = explode(" ",$sbsearchtext);
        $c = count($SearchArray);
        $d = 0;
        $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` WHERE `name`";
        if (is_array($SearchArray)) {
            foreach($SearchArray as $SearchPart) {
                $d++;
                if ($style == 'Exact') {
                    $sql .= "='".$SearchPart."'";
                } else {
                    $sql .= " LIKE '%".$SearchPart."%'";
                }
                if ($d < $c) { $sql .= " AND `name`"; }
            }
        }
    } elseif ($where == 'Both') {
    // search by Nicknames and Shouts
        if ($style == 'Exact') {
            $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` WHERE `name`='".$sbsearchtext."' OR `comment`='".$sbsearchtext."'";
        } else {
            $SearchArray = explode(" ", $sbsearchtext);
            $c = count($SearchArray);
            $d = 0;
            $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` WHERE `name`";
            foreach($SearchArray as $SearchPart) {
                $d++;
                $sql .= " LIKE '%".$SearchPart."%' OR comment LIKE '%".$SearchPart."%'";
                if ($d < $c) { $sql .= " OR `name`"; }
            }
        }
    } else {
    // search by Shouts only
        if ($style == 'Exact') {
            $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` WHERE `comment` LIKE '%".$sbsearchtext."%'";
        } else {
            $SearchArray = explode(" ",$sbsearchtext);
            $c = count($SearchArray);
            $d = 0;
            $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` WHERE `comment`";
            foreach($SearchArray as $SearchPart) {
                $d++;
                $sql .= " LIKE '%".$SearchPart."%'";
                if ($d < $c) { $sql .= " AND `comment`"; }
            }
        }
    }
    if ((empty($order)) || ($order == 'newest')) { $sql .= " ORDER BY `id` DESC"; }
    else { $sql .= " ORDER BY `id` ASC"; }
    $sql .= " LIMIT $results";
    // end building SQL query
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows > 0) {
        global $conf;
        $flag = 1;

        $ThemeSel = get_theme();
        $sql = "SELECT `menuColor1`, `menuColor2` FROM `".$prefix."_shoutbox_themes` WHERE `themeName`='$ThemeSel'";
        $resultT = $db->sql_query($sql);
        $rowColor = $db->sql_fetchrow($resultT);
        $db->sql_freeresult($resultT);

        while ($row = $db->sql_fetchrow($result)) {
            if ($flag == 1) { $bgcolor = $rowColor['menuColor1']; }
            if ($flag == 2) { $bgcolor = $rowColor['menuColor2']; }
            $comment = str_replace('src=', 'src="', $row['comment']);
            $comment = str_replace('.gif>', '.gif" alt="" />', $comment);
            $comment = str_replace('.jpg>', '.jpg" alt="" />', $comment);
            $comment = str_replace('.png>', '.png" alt="" />', $comment);
            $comment = str_replace('.bmp>', '.bmp" alt="" />', $comment);

            // BB code [b]word[/b] [i]word[/i] [u]word[/u]
            if ((preg_match("#[b]#i", $comment)) && (preg_match("#[/b]#i", $comment)) && (substr_count($comment,"[b]") == substr_count($comment,"[/b]"))) {
                $comment = str_replace("[b]","<span style=\"font-weight: bold\">",$comment);
                $comment = str_replace("[/b]","</span>",$comment);
            }
            if ((preg_match("#[i]#i", $comment)) && (preg_match("#[/i]#i", $comment)) && (substr_count($comment,"[i]") == substr_count($comment,"[/i]"))) {
                $comment = str_replace("\[i\]","<span style=\"font-style: italic\">",$comment);
                $comment = str_replace("\[\/i\]","</span>",$comment);
            }
            if ((preg_match("#[u]#i", $comment)) && (preg_match("#[/u]#i", $comment)) && (substr_count("$comment","[u]") == substr_count($comment,"[/u]"))) {
                $comment = str_replace("[u]","<span style=\"text-decoration: underline\">",$comment);
                $comment = str_replace("[/u]","</span>",$comment);
            }

            $sqlN = "SELECT `user_avatar`, `username` FROM `".$prefix."_users` WHERE `username`='".$row['name']."'";
            $nameresultN = $db->sql_query($sqlN);
            $rowN = $db->sql_fetchrow($nameresultN);
            $db->sql_freeresult($nameresultN);

            // Disallow Anonymous users from seeing links to users' accounts
            if ($username == "Anonymous") {
                if (!empty($rowN['user_avatar']) && $rowN['user_avatar'] != "blank.gif" && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {
                    echo "<tr><td style=\"background-color: $bgcolor;\">";
                    echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";
                    echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";
                    $row_avatar = $rowN['user_avatar'];
                    $av_found = findAvatar($row_avatar);
                    echo $av_found;
                    echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\">";
                    echo "<strong>$row[name]:</strong> $comment";
                    if ($conf['date'] == "yes") {
                        if (!empty($row['timestamp'])) {
                            // reads unix timestamp && formats it to the viewer's timezone
                            if (is_user()) {
                                $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                                echo "<br />$unixTime";
                            } else {
                                $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                                echo "<br />$unixTime";
                            }
                        } else {
                            echo "<br />".$row['date']."&nbsp;".$row['time'];
                        }
                    }
                    echo "</td></tr></table>";
                    echo "</td></tr>\n";
                } else {
                    echo "<tr><td style=\"background-color: $bgcolor;\">";
                    echo "<strong>".$row['name'].":</strong> $comment";
                    if ($conf['date'] == "yes") {
                        if (!empty($row['timestamp'])) {
                            // reads unix timestamp && formats it to the viewer's timezone
                            if (is_user()) {
                                $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                                echo "<br />$unixTime";
                            } else {
                                $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                                echo "<br />$unixTime";
                            }
                        } else {
                            echo "<br />".$row['date']."&nbsp;".$row['time'];
                        }
                    }
                    echo "</td></tr>\n";
                }
            } else {
                // check to see if nickname is a user in the DB && not Anonymous
                if (is_array($rowN) && $rowN['username'] != "Anonymous") {
                    if (($rowN['user_avatar']) && ($rowN['user_avatar'] != "blank.gif") && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {
                        echo "<tr><td style=\"background-color: $bgcolor;\">";
                        echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";
                        echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";
                        $row_avatar = $rowN['user_avatar'];
                        $av_found = findAvatar($row_avatar);
                        echo $av_found;
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\"><strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\">" . UsernameColor($row['name']) . "</a>:</strong> $comment<br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        if ($conf['date'] == "yes") {
                            if (!empty($row['timestamp'])) {
                                // reads unix timestamp && formats it to the viewer's timezone
                                if (is_user()) {
                                    $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                                    echo $unixTime;
                                } else {
                                    $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                                    echo "$unixTime";
                                }
                            } else {
                                echo $row['date']."&nbsp;".$row['time'];
                            }
                        }
                        // registered users edit/delete posts
                        if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {
                            echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=".$row['id']."&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=".$row['id']."&amp;page=$page\">"._DELETE."</a> &#93;";
                        }
                        echo "</td></tr></table>";
                        echo "</td></tr>\n";
                    } else {
                        echo "<tr><td style=\"background-color: $bgcolor;\">";
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        echo "<strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\">" . UsernameColor($row['name']) . "</a>:</strong> $comment<br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                        if ($conf['date'] == "yes") {
                            if (!empty($row['timestamp'])) {
                                // reads unix timestamp && formats it to the viewer's timezone
                                if (is_user()) {
                                    $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                                    echo $unixTime;
                                } else {
                                    $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                                    echo $unixTime;
                                }
                            } else {
                                echo $row['date']."&nbsp;".$row['time'];
                            }
                        }
                        // registered users edit/delete posts
                        if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {
                            echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=".$row['id']."&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=".$row['id']."&amp;page=$page\">"._DELETE."</a> &#93;";
                        }
                        echo "</td></tr>\n";
                    }
                } else {
                    echo "<tr><td style=\"background-color: $bgcolor;\">";
                    echo "<strong>$row[name]:</strong> $comment";
                    if ($conf['date'] == "yes") {
                        if (!empty($row['timestamp'])) {
                            // reads unix timestamp && formats it to the viewer's timezone
                            if (is_user()) {
                                $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                                echo "<br />$unixTime";
                            } else {
                                $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                                echo "<br />$unixTime";
                            }
                        } else {
                            echo "<br />".$row['date']."&nbsp;".$row['time'];
                        }
                    }
                    echo "</td></tr>\n";
                }
            }
            if ($flag == 1) { $flag = 2; }
            elseif ($flag == 2) { $flag =1; }
        }
        $db->sql_freeresult($result);
    } else {
        echo "<tr><td><table cellpadding=\"3\" cellspacing=\"0\" border=\"1\" align=\"center\">\n";
        echo "<tr><td align=\"center\">"._NORESULTS."</td></tr></table></td></tr>";
    }
    echo "</table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function showSearchBox($sbsearchtext, $where, $style, $results, $order) {
    echo "<form name=\"shoutform3\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\">\n";
    echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"95%\" border=\"0\" align=\"center\">\n";
    echo "<tr><td align=\"center\"><span class=\"title\">"._SEARCHBOX."</span></td></tr>\n";
    //echo "<tr><td width=\"50%\" align=\"right\"><img width=\"50\" height=\"39\" src=\"modules/Shout_Box/search.jpg\" alt=\"\" /></td><td width=\"50%\" align=\"left\" valign=\"middle\"><span class=\"title\">"._SEARCHBOX."</span></td></tr>\n";
    echo "<tr><td colspan=\"2\" align=\"center\" nowrap=\"nowrap\" valign=\"middle\">";

    if (($where == 'Shouts') || (empty($where))) { $wSEL1 = " selected=\"selected\""; } else { $wSEL1 = ''; }
    if ($where == 'Nicknames') { $wSEL2 = " selected=\"selected\""; } else { $wSEL2 = ''; }
    if ($where == 'Both') { $wSEL3 = " selected=\"selected\""; } else { $wSEL3 = ''; }
    echo "<select name=\"where\">
    <option value=\"Shouts\"$wSEL1>"._SHOUTS."</option>
    <option value=\"Nicknames\"$wSEL2>"._SBNICKNAMES."</option>
    <option value=\"Both\"$wSEL3>"._SBBOTH."</option></select>&nbsp;&nbsp;";

    if (($style == 'Exact') || (empty($style))) { $sSEL1 = " selected=\"selected\""; } else { $sSEL1 = ''; }
    if ($style == 'Any') { $sSEL2 = " selected=\"selected\""; } else { $sSEL2 = ''; }
    echo "<select name=\"style\">
    <option value=\"Exact\"$sSEL1>"._EXACTPHRASE."</option>
    <option value=\"Any\"$sSEL2>"._FUZZY."</option>
    </select>&nbsp;&nbsp;";

    if (($results == 10) || (empty($results))) { $rSEL10 = " selected=\"selected\""; } else { $rSEL10 = ''; }
    if ($results == 20) { $rSEL20 = " selected=\"selected\""; } else { $rSEL20 = ''; }
    if ($results == 30) { $rSEL30 = " selected=\"selected\""; } else { $rSEL30 = ''; }
    if ($results == 50) { $rSEL50 = " selected=\"selected\""; } else { $rSEL50 = ''; }
    echo "<select name=\"results\">
    <option value=\"10\"$rSEL10>10 "._SBRESULTS."</option>
    <option value=\"20\"$rSEL20>20 "._SBRESULTS."</option>
    <option value=\"30\"$rSEL30>30 "._SBRESULTS."</option>
    <option value=\"50\"$rSEL50>50 "._SBRESULTS."</option></select>&nbsp;&nbsp;";

    if (($order == 'newest') || (empty($order))) { $oSEL1 = " selected=\"selected\""; } else { $oSEL1 = ''; }
    if ($order == 'oldest') { $oSEL2 = " selected=\"selected\""; } else { $oSEL2 = ''; }
    echo "<select name=\"order\">
    <option value=\"newest\"$oSEL1>"._NEWESTFIRST."</option>
    <option value=\"oldest\"$oSEL2>"._OLDESTFIRST."</option></select>";

    echo "</td></tr><tr><td colspan=\"2\" align=\"center\" nowrap=\"nowrap\" valign=\"middle\">";
    echo "<input type=\"text\" name=\"sbsearchtext\" value=\"$sbsearchtext\" size=\"53\" maxlength=\"100\" />&nbsp;&nbsp;";
    echo "<input type=\"hidden\" name=\"Action\" value=\"Search\" /><input type=\"submit\" name=\"button\" value=\""._SBSEARCH."\" /></td></tr>";
    echo "</table></form>";
}

function shoutDelete($page, $shoutID) {
    global $db, $username, $prefix, $conf;
    if ($conf['delyourlastpost'] == "yes" && !empty($shoutID)) {
        $sql = "SELECT `name` FROM `".$prefix."_shoutbox_shouts` WHERE `id`='$shoutID'";
        $nameresult = $db->sql_query($sql);
        $row = $db->sql_fetchrow($nameresult);
        $db->sql_freeresult($nameresult);
        if ($row['name'] == $username) {
            $sqlD = "DELETE FROM `".$prefix."_shoutbox_shouts` WHERE `id`='$shoutID'";
            $db->sql_query($sqlD);
        }
    }
    header("Location: modules.php?name=Shout_Box&page=$page");
    exit;
}

function shoutEdit($page, $shoutID, $ShoutError) {
    global $db, $prefix, $conf, $username;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    if ($conf['delyourlastpost'] == "yes" && !empty($shoutID)) {
        $sql = "SELECT `name`, `comment` FROM `".$prefix."_shoutbox_shouts` WHERE `id`='$shoutID'";
        $nameresult = $db->sql_query($sql);
        $row = $db->sql_fetchrow($nameresult);
        $db->sql_freeresult($nameresult);
        if ($row['name'] == $username) {
            // strip out link code here (added back in later if saved)
            $ShoutComment = $row['comment'];
            $ShoutComment = str_replace("&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"", "",$ShoutComment);
            $ShoutComment = str_replace("&#91;<a rel=\"nofollow\" href=\"", "",$ShoutComment);
            $ShoutComment = str_replace("&#91;<a target=\"_blank\" href=\"", "",$ShoutComment);
            $ShoutComment = str_replace("&#91;<a href=\"", "",$ShoutComment);
            $ShoutComment = str_replace("\">URL</a>&#93;", "",$ShoutComment);
            $ShoutComment = str_replace("\">FTP</a>&#93;", "",$ShoutComment);
            $ShoutComment = str_replace("\">IRC</a>&#93;", "",$ShoutComment);
            $ShoutComment = str_replace("\">TeamSpeak</a>&#93;", "",$ShoutComment);
            $ShoutComment = str_replace("\">AIM</a>&#93;", "",$ShoutComment);
            $ShoutComment = str_replace("\">Gopher</a>&#93;", "",$ShoutComment);
            $ShoutComment = str_replace("\">E-Mail</a>&#93;", "",$ShoutComment);

            $i = 0;
            $ShoutNew = '';
            $ShoutArray = explode(" ",$ShoutComment);
            foreach($ShoutArray as $ShoutPart) {
                if (preg_match("#mailto:#i", $ShoutPart)) { // find mailto:
                    $ShoutPart = str_replace("mailto:", "",$ShoutPart); // strip out mailto:
                    $ShoutPart = str_replace("%", " ",$ShoutPart);
                    $ShoutPart = trim($ShoutPart);
                    // decode address to ascii
                    $c = 0;
                    $AddyArray = explode(" ",$ShoutPart);
                    foreach($AddyArray as $AddyPart) {
                        $AddyNew[$c] = chr(hexdec($AddyPart));
                        $c++;
                    }
                    $ShoutPart = implode("",$AddyNew);
                    $ShoutNew[$i] = "mailto:$ShoutPart"; // add mailto: back in
                } else { $ShoutNew[$i] = $ShoutPart; }
                $i++;
            }
            $ShoutComment = implode(" ",$ShoutNew);

            // strip smilies code here (added back in later if saved)
            $sql = "SELECT * FROM `".$prefix."_shoutbox_emoticons`";
            $eresult = $db->sql_query($sql);
            while ($emoticons = $db->sql_fetchrow($eresult)) {
                $ShoutComment = str_replace($emoticons['image'],$emoticons['text'],$ShoutComment);
            }
            $db->sql_freeresult($eresult);

            echo "<form name=\"shoutedit\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\">\n";
            echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";
            echo "<tr><td align=\"center\"><span class=\"title\">"._SHOUTBOXEDIT."<br /><br /></span></td></tr>\n";
            if (($ShoutError) && ($ShoutError != 'none')) {
                echo "<tr><td style=\"background: #FF3333;\"><strong>"._SB_NOTE.":</strong> $ShoutError</td></tr>";
            }
            echo "<tr><td align=\"center\"><input type=\"hidden\" name=\"shoutID\" value=\"$shoutID\" /><input type=\"text\" name=\"ShoutComment\" size=\"70\" value=\"$ShoutComment\" maxlength=\"2500\" />";
            echo "<input type=\"hidden\" name=\"page\" value=\"$page\" /><input type=\"hidden\" name=\"Action\" value=\"Save\" />&nbsp;&nbsp;<input type=\"submit\" name=\"button\" value=\""._UPDATE."\" /></td></tr>";
            echo "<tr><td align=\"center\"><a href=\"modules.php?name=Shout_Box&amp;page=$page\">"._SHOUTHISTORY."</a></td></tr>";
            echo "</table></form>";
        } else {
            echo _EDITINGOTHERSDISALLOWED;
        }
    } else {
        echo _EDITINGDISABLEDBYADMIN;
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function shoutSave($page, $shoutID, $ShoutComment) {
    global $db, $username, $prefix, $conf;
    if ($conf['delyourlastpost'] == "yes" && !empty($shoutID)) {
        $sql = "SELECT `name` FROM `".$prefix."_shoutbox_shouts` WHERE `id`='$shoutID'";
        $nameresult = $db->sql_query($sql);
        $row = $db->sql_fetchrow($nameresult);
        $db->sql_freeresult($nameresult);
        if ($row['name'] == $username) {
            $ShoutComment = trim($ShoutComment); // remove whitespace off ends of shout
            $ShoutComment = preg_replace('/\s+/', ' ', $ShoutComment); // convert double spaces in middle of shout to single space
            $num = strlen($ShoutComment);
            if ($num < 1) { $ShoutError = _SHOUTTOOSHORT; }
            if ($num > 2500) { $ShoutError = _SHOUTTOOLONG; }
            if (!$ShoutComment) { $ShoutError = _NOSHOUT; }
            if ($ShoutComment == _SB_MESSAGE) { $ShoutError = _NOSHOUT; }
            $ShoutComment = str_replace(" [.] ", ".",$ShoutComment);
            if (preg_match("#.xxx#i", $ShoutComment) && $conf['blockxxx'] == "yes") {
                $ShoutError = _XXXBLOCKED;
                $ShoutComment = '';
            }
            if (preg_match("#javascript:(.*)#i", $ShoutComment)) {
                $ShoutError = _JSINSHOUT;
                $ShoutComment = '';
            }

            $ShoutComment = htmlspecialchars($ShoutComment, ENT_QUOTES);
            $ShoutComment = str_replace("&amp;amp;", "&amp;",$ShoutComment);

            // Scan for links in the shout. If there is, replace it with [URL] or block it if disallowed
            $i = 0;
            $ShoutNew = '';
            $ShoutArray = explode(" ",$ShoutComment);
            if (is_array($ShoutArray)) {
                foreach($ShoutArray as $ShoutPart) {
                    if (is_array($ShoutPart) == TRUE) { $ShoutPart = $ShoutPart[0]; }
                    if (preg_match("#http://#i", $ShoutPart)) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        // fix for users adding text to the beginning of links: HACKhttp://www.website.com
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"http://");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
                    } elseif (preg_match("#ftp://#", $ShoutPart)) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"ftp://");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">FTP</a>&#93;";
                    } elseif (preg_match("#irc://#i", $ShoutPart)) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"irc://");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">IRC</a>&#93;";
                    } elseif (preg_match("#teamspeak://#i", $ShoutPart)) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"teamspeak://");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">TeamSpeak</a>&#93;";
                    } elseif (preg_match("#aim:goim#i", $ShoutPart)) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"aim:goim");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">AIM</a>&#93;";
                    } elseif (preg_match("#gopher://#i", $ShoutPart)) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"gopher://");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">Gopher</a>&#93;";
                    } elseif (preg_match("#mailto:#i", $ShoutPart)) {
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"mailto:");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        // email encoding to stop harvesters
                        $ShoutPart = bin2hex($ShoutPart);
                        $ShoutPart = chunk_split($ShoutPart, 2, '%');
                        $ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
                        $ShoutNew[$i] = "&#91;<a href=\"$ShoutPart\">E-Mail</a>&#93;";
                    } elseif (preg_match("#www.#i", $ShoutPart)) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        $ShoutPartL = strtolower($ShoutPart);
                        $spot = strpos($ShoutPartL,"www.");
                        if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
                        $ShoutPart = "http://" . $ShoutPart;
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
                    } elseif (preg_match('#@#i', $ShoutPart) && preg_match('/[\.]/i', $ShoutPart)) {
                        //     \b[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}\b

                        // email encoding to stop harvesters
                        $ShoutPart = bin2hex($ShoutPart);
                        $ShoutPart = chunk_split($ShoutPart, 2, '%');
                        $ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
                        $ShoutNew[$i] = "&#91;<a href=\"mailto:$ShoutPart\">E-Mail</a>&#93;";
                    } elseif ((preg_match("/\.(us|tv|cc|ws|ca|de|jp|ro|be|fm|ms|tc|ph|dk|st|ac|gs|vg|sh|kz|as|lt|to)/i", substr($ShoutPart, -3,3))) || (preg_match("/\.(com|net|org|mil|gov|biz|pro|xxx)/i", substr($ShoutPart, -4,4))) || (preg_match("/\.(info|name|mobi)/i", substr($ShoutPart, -5,5))) || (preg_match("/\.(co\.uk|co\.za|co\.nz|co\.il)/i", substr($ShoutPart, -6,6)))) {
                        if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
                        $ShoutPart = "http://" . $ShoutPart;
                        $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
                    } elseif (strlen(html_entity_decode($ShoutPart, ENT_QUOTES)) > 21) {
                        $ShoutNew[$i] = htmlspecialchars(wordwrap(html_entity_decode($ShoutPart, ENT_QUOTES), 21, " ", 1), ENT_QUOTES);
                        $ShoutNew[$i] = str_replace("[ b]", " [b]",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[b ]", " [b]",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[ /b]", "[/b] ",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[/ b]", "[/b] ",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[/b ]", "[/b] ",$ShoutNew[$i]);

                        $ShoutNew[$i] = str_replace("[ i]", " [i]",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[i ]", " [i]",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[ /i]", "[/i] ",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[/ i]", "[/i] ",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[/i ]", "[/i] ",$ShoutNew[$i]);

                        $ShoutNew[$i] = str_replace("[ u]", " [u]",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[u ]", " [u]",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[ /u]", "[/u] ",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[/ u]", "[/u] ",$ShoutNew[$i]);
                        $ShoutNew[$i] = str_replace("[/u ]", "[/u] ",$ShoutNew[$i]);
                    } else { $ShoutNew[$i] = $ShoutPart; }
                    $i++;
                }
            }
            if (empty($ShoutError)) { $ShoutComment = implode(" ",$ShoutNew); }

            //Smilies from database
            $ShoutArrayReplace = explode(" ",$ShoutComment);
            $ShoutArrayScan = $ShoutArrayReplace;
            $sql = "SELECT * FROM `".$prefix."_shoutbox_emoticons`";
            $eresult = $db->sql_query($sql);
            while ($emoticons = $db->sql_fetchrow($eresult)) {
                $i = 0;
                foreach($ShoutArrayScan as $ShoutPart) {
                    if ($ShoutPart == $emoticons['text']) { $ShoutArrayReplace[$i] = $emoticons['image']; }
                    $i++;
                }
            }
            $ShoutComment = implode(" ",$ShoutArrayReplace);

            //look for bad words, then censor them.
            if($conf['censor'] == "yes") {
                $ShoutArrayReplace = explode(" ",$ShoutComment);
                $ShoutArrayScan = $ShoutArrayReplace;
                $sql = "SELECT * FROM `".$prefix."_shoutbox_censor`";
                $cresult = $db->sql_query($sql);
                while ($censor = $db->sql_fetchrow($cresult)) {
                    $i = 0;
                    foreach($ShoutArrayScan as $ShoutPart) {
                        $ShoutPart = strtolower($ShoutPart);
                        $censor['text'] = strtolower($censor['text']);
                        if ($ShoutPart == $censor['text']) { $ShoutArrayReplace[$i] = $censor['replacement']; }
                        $i++;
                    }
                }
                $ShoutComment = implode(" ",$ShoutArrayReplace);

                /*
                // Phrase censor - Needs work before implementing
                $sql = "SELECT * FROM ".$prefix."_shoutbox_emoticons";
                $eresult = $db->sql_query($sql);
                while ($emoticons = $db->sql_fetchrow($eresult)) {
                    $ShoutComment = str_replace($emoticons[1],$emoticons[2],$ShoutComment);
                }
                */
            }

            if (!$ShoutError) {
                $sqlU = "UPDATE `".$prefix."_shoutbox_shouts` set `comment`='$ShoutComment' WHERE `id`='$shoutID'";
                $db->sql_query($sqlU);
            } else {
                header("Location: modules.php?name=Shout_Box&Action=Edit&shoutID=$shoutID&page=$page&ShoutError=$ShoutError");
                exit;
            }
        }
    }
    header("Location: modules.php?name=Shout_Box&page=$page");
    exit;
}

function findAvatar($row_avatar) {
    global $db, $prefix;
    // Find avatar path
    // modules/Forums/images/avatars/gallery
    $sql = "SELECT * FROM `".$prefix."_bbconfig` WHERE `config_name`='avatar_gallery_path'";
    $result = $db->sql_query($sql);
    $avatar_gallery_path = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    // modules/Forums/images/avatars
    $sql = "SELECT * FROM ".$prefix."_bbconfig WHERE config_name='avatar_path'";
    $result = $db->sql_query($sql);
    $avatar_path = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    if (preg_match('#http://#i',$row_avatar) == TRUE) {
        // offsite avatars
        $AvatarFound = "<img src=\"$row_avatar\" alt=\"\" /></td>";
    } else {
        $agp = $avatar_gallery_path['config_value'].'/'.$row_avatar;
        $ap = $avatar_path['config_value'].'/'.$row_avatar;
        if (file_exists($agp) == TRUE) {
            $AvatarFound = "<img src=\"".$avatar_gallery_path['config_value']."/$row_avatar\" alt=\"\" /></td>";
        } elseif (file_exists($ap) == TRUE) {
            $AvatarFound = "<img src=\"".$avatar_path['config_value']."/$row_avatar\" alt=\"\" /></td>";
        } else {
            $AvatarFound = "<img src=\"".$avatar_path['config_value']."/blank.gif\" alt=\"\" /></td>";
        }
    }
    return $AvatarFound;
}

function showHistory($page) {
    global $db, $prefix, $username, $userinfo, $board_config;
    include_once(NUKE_BASE_DIR.'header.php');
    global $conf;

    // count number of shouts in DB
    $sql = "SELECT id FROM ".$prefix."_shoutbox_shouts";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    $db->sql_freeresult($result);
    $shout_pages = 1;
    $shoutsViewed = $conf['shoutsperpage'];
    while ($numrows >= $shoutsViewed) {
        $shout_pages++;
        $numrows = ($numrows - $shoutsViewed);
    }
    if ($shout_pages == 0) { $shout_pages = 1; }
    if (!$page) { $page = 1; }
    if ($page < 1) { $page = 1; }
    if ($page > $shout_pages) { $page = $shout_pages; }
    if ($page > 1) {
        $offset = ($page * $shoutsViewed);
        $offset1 = ($offset - $shoutsViewed);
    } else { $offset1 = 0; }

    // search form
    OpenTable();
    $sbsearchtext = '';
    $where = '';
    $style = '';
    $results = '';
    $order = '';
    showSearchBox($sbsearchtext, $where, $style, $results, $order);
    CloseTable();
    echo "<br />";
    OpenTable();
    $flag = 1;

    $ThemeSel = get_theme();
    $sql = "SELECT `menuColor1`, `menuColor2` FROM `".$prefix."_shoutbox_themes` WHERE `themeName`='$ThemeSel'";
    $result = $db->sql_query($sql);
    $rowColor = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    echo "<form name=\"shoutform2\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\">\n";
    echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";
    echo "<tr><td align=\"center\"><span class=\"title\">"._SHOUTBOXHISTORY."</span></td></tr>\n";
    //echo "<tr><td><table cellpadding=\"0\" width=\"100%\" cellspacing=\"0\" border=\"0\"><tr><td width=\"45%\" align=\"right\"><img width=\"50\" height=\"39\" src=\"modules/Shout_Box/history.gif\" alt=\"\" /></td><td width=\"55%\" align=\"left\" valign=\"middle\"><span class=\"title\">"._SHOUTBOXHISTORY."</span></td></tr></table></td></tr>\n";
    $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` ORDER BY `id` DESC LIMIT ".$offset1.",$shoutsViewed";
    $resultt = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($resultt)) {
        if ($flag == 1) { $bgcolor = $rowColor['menuColor1']; }
        if ($flag == 2) { $bgcolor = $rowColor['menuColor2']; }
        $comment = str_replace('src=', 'src="', $row['comment']);
        $comment = str_replace('.gif>', '.gif" alt="" />', $comment);
        $comment = str_replace('.jpg>', '.jpg" alt="" />', $comment);
        $comment = str_replace('.png>', '.png" alt="" />', $comment);
        $comment = str_replace('.bmp>', '.bmp" alt="" />', $comment);

        // BB code [b]word[/b] [i]word[/i] [u]word[/u]
        if ((preg_match("#[b]#i", $comment)) && (preg_match("#[/b]#i", $comment)) && (substr_count($comment,"[b]") == substr_count($comment,"[/b]"))) {
            $comment = str_replace("[b]","<span style=\"font-weight: bold\">",$comment);
            $comment = str_replace("[/b]","</span>",$comment);
        }
        if ((preg_match("#[i]#i", $comment)) && (preg_match("#[/i]#i", $comment)) && (substr_count($comment,"[i]") == substr_count($comment,"[/i]"))) {
            $comment = str_replace("[i]","<span style=\"font-style: italic\">",$comment);
            $comment = str_replace("[/i]","</span>",$comment);
        }
        if ((preg_match("#[u]#i", $comment)) && (preg_match("#[/u]#i", $comment)) && (substr_count($comment,"[u]") == substr_count($comment,"[/u]"))) {
            $comment = str_replace("[u]","<span style=\"text-decoration: underline\">",$comment);
            $comment = str_replace("[/u]","</span>",$comment);
        }

        $sqlN = "SELECT `user_avatar`, `username` FROM `".$prefix."_users` WHERE username='$row[name]'";
        $nameresultN = $db->sql_query($sqlN);
        $rowN = $db->sql_fetchrow($nameresultN);
        $db->sql_freeresult($nameresultN);

        // Disallow Anonymous users from seeing links to users' accounts
        if ($username == "Anonymous") {
            if (!empty($rowN['user_avatar']) && ($rowN['user_avatar'] != "blank.gif") && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {
                echo "<tr><td style=\"background-color: $bgcolor;\">";
                echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";
                echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";
                $row_avatar = $rowN['user_avatar'];
                $av_found = findAvatar($row_avatar);
                echo "$av_found";
                echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\">";
                echo "<strong>$row[name]:</strong> $comment";
                if ($conf['date'] == "yes") {
                    if (!empty($row['timestamp'])) {
                        // reads unix timestamp && formats it to the viewer's timezone
                        if (is_user()) {
                            $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                            echo "<br />$unixTime";
                        } else {
                            $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                            echo "<br />$unixTime";
                        }
                    } else {
                        echo "<br />".$row['date']."&nbsp;".$row['time'];
                    }
                }
                echo "</td></tr></table>";
                echo "</td></tr>\n";
            } else {
                echo "<tr><td style=\"background-color: $bgcolor;\">";
                echo "<strong>$row[name]:</strong> $comment";
                if ($conf['date'] == "yes") {
                    if (!empty($row['timestamp'])) {
                        // reads unix timestamp && formats it to the viewer's timezone
                        if (is_user()) {
                            $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                            echo "<br />$unixTime";
                        } else {
                            $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                            echo "<br />$unixTime";
                        }
                    } else {
                        echo "<br />".$row['date']."&nbsp;".$row['time'];
                    }
                }
                echo "</td></tr>\n";
            }
        } else {
            // check to see if nickname is a user in the DB && not Anonymous
            if (is_array($rowN) && ($rowN['username'] != "Anonymous")) {
                if (!empty($rowN['user_avatar']) && ($rowN['user_avatar'] != "blank.gif") && ($rowN['user_avatar'] != "gallery/blank.gif") && (stristr($rowN['user_avatar'],'.') == TRUE)) {
                    echo "<tr><td style=\"background-color: $bgcolor;\">";
                    echo "<table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\" border=\"0\">";
                    echo "<tr><td valign='top' style=\"background-color: $bgcolor;\">";
                    $row_avatar = $rowN['user_avatar'];
                    $av_found = findAvatar($row_avatar);
                    echo "$av_found";
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    echo "<td valign='top' width='100%' style=\"background-color: $bgcolor;\"><strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\">" . UsernameColor($row['name']) . "</a>:</strong> $comment<br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    if ($conf['date'] == "yes") {
                        if (!empty($row['timestamp'])) {
                            // reads unix timestamp && formats it to the viewer's timezone
                            if (is_user()) {
                                $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                                echo $unixTime;
                            } else {
                                $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                                echo $unixTime;
                            }
                        } else {
                            echo $row['date']."&nbsp;".$row['time'];
                        }
                    }
                    // registered users edit/delete posts
                    if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {
                        echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=".$row['id']."&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=".$row['id']."&amp;page=$page\">"._DELETE."</a> &#93;";
                    }
                    echo "</td></tr></table>";
                    echo "</td></tr>\n";
                } else {
                    echo "<tr><td style=\"background-color: $bgcolor;\">";
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    echo "<strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['name']."\">" . UsernameColor($row['name']) . "</a>:</strong> $comment<br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    if ($conf['date'] == "yes") {
                        if (!empty($row['timestamp'])) {
                            // reads unix timestamp && formats it to the viewer's timezone
                            if (is_user()) {
                                $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                                echo "$unixTime";
                            } else {
                                $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                                echo $unixTime;
                            }
                        } else {
                            echo "$row[date]&nbsp;$row[time]";
                        }
                    }
                    // registered users edit/delete posts
                    if (($conf['delyourlastpost'] == "yes") && ($username == $row['name'])) {
                        echo " &#91; <a title=\""._EDIT."\" href=\"modules.php?name=Shout_Box&amp;Action=Edit&amp;shoutID=".$row['id']."&amp;page=$page\">"._EDIT."</a> | <a title=\""._DELETE."\" href=\"modules.php?name=Shout_Box&amp;Action=Delete&amp;shoutID=".$row['id']."&amp;page=$page\">"._DELETE."</a> &#93;";
                    }
                    echo "</td></tr>\n";
                }
            } else {
                echo "<tr><td style=\"background-color: $bgcolor;\">";
                echo "<strong>$row[name]:</strong> $comment";
                if ($conf['date'] == "yes") {
                    if (!empty($row['timestamp'])) {
                            // reads unix timestamp && formats it to the viewer's timezone
                        if (is_user()) {
                            $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                            echo "<br />$unixTime";
                        } else {
                            $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                            echo "<br />$unixTime";
                        }
                    } else {
                        echo "<br />".$row['date']."&nbsp;".$row['time'];
                    }
                }
                echo "</td></tr>\n";
            }
        }
        if ($flag == 1) { $flag = 2; }
        elseif ($flag == 2) { $flag =1; }
    }
    echo "<tr><td align=\"center\">";
    $num1 = ($page-4);
    if ($num1 < 1) { $num1 = 1; }
    $num2 = ($num1+8);
    if ($num2 > $shout_pages) { $num2 = $shout_pages; }
    $num5 = ($num2-8);
    if ($num5 < $num1) {
        $num1 = $num5;
        if ($num1 < 1) { $num1 = 1; }
    }
    $num3 = ($page-1);
    $num4 = ($page+1);
    $menuLinks = '';

    $count = $num1;
    while ($count <= $shout_pages && $count <= $num2) {
        if ($count == $page) {
            $menuLinks .= "<strong>$count</strong>";
        } else {
            $menuLinks .= "<a href=\"modules.php?name=Shout_Box&amp;page=$count\">$count</a>";
        }
        if ($count < $num2) { $menuLinks .= "&nbsp;&nbsp;"; }
        $count++;
    }

    $menuLinks .= "<br /><br />";
    if ($page > 1) {
        $menuLinks .= "<a href=\"modules.php?name=Shout_Box&amp;page=$num3\">"._PREVIOUS."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
    }
    if ($page != $shout_pages) {
        $menuLinks .= _PAGE." $page / <a href=\"modules.php?name=Shout_Box&amp;page=$shout_pages\">$shout_pages</a>\n";
    } else {
        $menuLinks .= _PAGE." $page / $shout_pages\n";
    }
    if ($page < $shout_pages) {
        $menuLinks .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"modules.php?name=Shout_Box&amp;page=$num4\">"._NEXT."</a>\n";
    }
    echo "$menuLinks";
    echo "</td></tr></table></form>";
    // End menu build
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function showBanned() {
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<br /><p class=\"title\" align=\"center\"><strong>"._YOUAREBANNEDM."</strong></p><br />";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$page = (isset($_REQUEST['page'])) ? (int)$_REQUEST['page'] : 1;
$shoutID = (isset($_REQUEST['shoutID'])) ? (int)$_REQUEST['shoutID'] : '';
$where = (isset($_POST['where'])) ? $_POST['where'] : '';
$sbsearchtext = (isset($_POST['sbsearchtext'])) ? $_POST['sbsearchtext'] : '';
$results = (isset($_POST['results'])) ? (int)$_POST['results'] : 0;
$order = (isset($_POST['order'])) ? $_POST['order'] : '';
$style = (isset($_POST['style'])) ? $_POST['style'] : '';
$ShoutError = (isset($_REQUEST['ShoutError'])) ? $_REQUEST['ShoutError'] : '';
$ShoutComment = (isset($_POST['ShoutComment'])) ? $_POST['ShoutComment'] : '';

switch($Action) {

        case "UserBanned":
        showBanned();
        break;

        case "Search":
        searchHistory($where, $sbsearchtext, $results, $style, $order, $page);
        break;

        case "Delete":
        shoutDelete($page, $shoutID);
        break;

        case "Edit":
        if (empty($ShoutError)) { $ShoutError = 'none'; }
        shoutEdit($page, $shoutID, $ShoutError);
        break;

        case "Save":
        shoutSave($page, $shoutID, $ShoutComment);
        break;

        default:
        showHistory($page);
        break;

}

?>