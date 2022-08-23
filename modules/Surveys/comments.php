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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       01/17/2006
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

define('NUKE_BASE_MODULES', preg_replace('/modules/i', '', dirname(dirname(__FILE__))));

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- '._SURVEYS;

function format_url($comment) {
    global $nukeurl;

    unset($location);
    $comment = $comment;
    $links = array();
    $hrefs = array();
    $pos = 0;
    while (!(($pos = strpos($comment,"<",$pos)) === false)) {
    $pos++;
    $endpos = strpos($comment,">",$pos);
    $tag = substr($comment,$pos,$endpos-$pos);
    $tag = trim($tag);
    if (isset($location)) {
            if (!strcasecmp(strtok($tag," "),"/A")) {
            $link = substr($comment,$linkpos,$pos-1-$linkpos);
            $links[] = $link;
            $hrefs[] = $location;
            unset($location);
            }
        $pos = $endpos+1;
    } else {
        if (!strcasecmp(strtok($tag," "),"A")) {
        if (preg_match("/HREF[ \t\n\r\v]*=[ \t\n\r\v]*\"([^\"]*)\"/i",$tag,$regs));
        else if (preg_match("/HREF[ \t\n\r\v]*=[ \t\n\r\v]*([^ \t\n\r\v]*)/i",$tag,$regs));
        else $regs[1] = "";
        if ($regs[1]) {
                $location = $regs[1];
        }
        $pos = $endpos+1;
        $linkpos = $pos;
        } else {
        $pos = $endpos+1;
        }
    }
    }
    for ($i=0; $i<sizeof($links); $i++) {
    if (!stristr($hrefs[$i], "http://")) {
        $hrefs[$i] = $nukeurl;
    } elseif (!stristr($hrefs[$i], "mailto://")) {
        $href = explode("/",$hrefs[$i]);
        $href = " [$href[2]]";
        $comment = str_replace(">$links[$i]</a>", "title='$hrefs[$i]'> $links[$i]</a>$href", $comment);
    }
    }
    return($comment);
}

function modone() {
    global $admin, $moderate, $module_name;
    if((is_admin() && $moderate == 1) || ($moderate==2)) echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">";
}

function modtwo($tid, $score, $reason) {
    global $admin, $user, $moderate, $reasons;
    if(((is_admin() && $moderate == 1) || ($moderate == 2)) && ($user)) {
        echo " | <select name=dkn$tid>";
        for($i=0, $maxi=sizeof($reasons); $i<$maxi; $i++) {
            echo "<option value=\"$score:$i\">$reasons[$i]</option>\n";
        }
        echo "</select>";
    }
}

function modthree($pollID, $mode, $order, $thold=0) {
    global $admin, $user, $moderate;
    if(((is_admin() && ($moderate == 1)) || ($moderate==2)) && ($user)) echo "<center><input type=hidden name=pollID value=$pollID><input type=hidden name=mode value=$mode><input type=hidden name=order value=$order><input type=hidden name=thold value=$thold>
    <input type=hidden name=op value=moderate>
    <input type=image src=images/menu/moderate.gif border=0></form></center>";
}

function navbar($pollID, $title, $thold, $mode, $order) {
    global $user, $bgcolor1, $bgcolor2, $textcolor1, $textcolor2, $anonpost, $pollcomm, $prefix, $db, $module_name, $userinfo, $cookie;
    OpenTable();
    $pollID = intval($pollID);
    $query = $db->sql_query("SELECT pollID FROM ".$prefix."_pollcomments WHERE pollID='$pollID'");
    if(!$query) $count = 0; else $count = $db->sql_numrows($query);
    $row = $db->sql_fetchrow($db->sql_query("SELECT pollTitle FROM ".$prefix."_poll_desc WHERE pollID='$pollID'"));
    $title = stripslashes(check_html($row['pollTitle'], "nohtml"));
    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
        }
        if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
        }
        if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }
    echo "\n\n<!-- COMMENTS NAVIGATION BAR START -->\n\n";
    echo "<table width=\"99%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n";
    if($title) {
        echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><span class=\"content\" color=\"$textcolor1\">\"$title\" | ";
        if(is_user()) {
            echo "<a href=\"modules.php?name=Your_Account&amp;op=editcomm\"><font color=\"$textcolor1\">"._CONFIGURE."</font></a>";
        } else {
            echo "<a href=\"modules.php?name=Your_Account\"><font color=\"$textcolor1\">"._LOGINCREATE."</font></a>";
        }
        if(($count==1)) {
            echo " | <strong>$count</strong> "._COMMENT."</span></td></tr>\n";
        } else {
            echo " | <strong>$count</strong> "._COMMENTS."</span></td></tr>\n";
        }
    }
    echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\" width=\"100%\">\n";
    if (($pollcomm) AND ($mode != "nocomments")) {
        if ($anonpost==1 OR (isset($admin) AND is_mod_admin($module_name)) OR is_user()) {
            if (!isset($pid)) { $pid = 0; }
            echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">"
            ."<input type=\"hidden\" name=\"pid\" value=\"$pid\">"
            ."<input type=\"hidden\" name=\"pollID\" value=\"$pollID\">"
            ."<input type=\"hidden\" name=\"op\" value=\"Reply\">"
            ."<input type=\"submit\" value=\""._REPLYMAIN."\"></td></form></tr>";
        }
    }
    echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><span class=\"tiny\">"._COMMENTSWARNING."</span></td></tr>\n"
      ."</table>"
      ."\n\n<!-- COMMENTS NAVIGATION BAR END -->\n\n";
    CloseTable();
    if ($anonpost == 0 AND !is_user()) {
        echo "<br />";
      OpenTable();
      echo "<center>"._NOANONCOMMENTS."</center>";
      CloseTable();
    }
}

function DisplayKids ($tid, $mode, $order=0, $thold=0, $level=0, $dummy=0, $tblwidth=99) {
    global $datetime, $user, $cookie, $bgcolor1, $reasons, $anonymous, $anonpost, $commentlimit, $prefix, $module_name, $db, $userinfo, $user_prefix;

    $comments = 0;
    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }
    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason FROM ".$prefix."_pollcomments WHERE pid = '$tid' order by date, tid");
    if ($mode == 'nested') {
        /* without the tblwidth variable, the tables run off the screen with netscape
           in nested mode in long threads so the text can't be read. */
    while($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
            $r_date = $row['date'];
            $r_name = stripslashes($row['name']);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $r_name_color = UsernameColor($r_name);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $r_email = stripslashes($row['email']);
            $r_host_name = $row['host_name'];
            $r_subject = stripslashes(check_html($row['subject'], "nohtml"));
            $r_comment = stripslashes($row['comment']);
            $r_score = intval($row['score']);
            $r_reason = intval($row['reason']);
            if($r_score >= $thold) {
                if (!isset($level)) {
                } else {
                    if (!$comments) {
                        echo "<ul>";
                        $tblwidth -= 5;
                    }
                }
                $comments++;
                if (!preg_match("/[a-z0-9]/i",$r_name)) $r_name = $anonymous;
                if (!preg_match("/[a-z0-9]/i",$r_subject)) $r_subject = "["._NOSUBJECT."]";
            // enter hex color between first two appostrophe for second alt bgcolor
                $r_bgcolor = ($dummy%2)?"":"#E6E6D2";
                echo "<a name=\"$r_tid\">";
                echo "<table width=90% border=0><tr bgcolor=\"$bgcolor1\"><td>";
                formatTimestamp($r_date);
                if ($r_email) {
                    echo "<p><strong>$r_subject</strong> <span class=content>";
                    if($userinfo['noscore'] == 0) {
                        echo "("._SCORE." $r_score";
                        if($r_reason>0) echo ", $reasons[$r_reason]";
                        echo ")";
                    }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    echo "<br />"._BY." <a href=\"mailto:$r_email\">$r_name_color</a> <span class=content><strong>($r_email)</strong></span> "._ON." $datetime";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                } else {
                    echo "<p><strong>$r_subject</strong> <span class=content>";
                    if($userinfo['noscore'] == 0) {
                        echo "("._SCORE." $r_score";
                        if($r_reason>0) echo ", $reasons[$r_reason]";
                        echo ")";
                    }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    echo "<br />"._BY." $r_name_color "._ON." $datetime";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                }
                if ($r_name != $anonymous) {
                    $row2 = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$r_name'"));
                    $r_uid = intval($row2['user_id']);
                    echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$r_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$r_uid\">"._SENDAMSG."</a>) ";
                }
                $row_url = $db->sql_fetchrow($db->sql_query("SELECT user_website FROM ".$user_prefix."_users WHERE username='$r_name'"));
                $url = stripslashes($row_url['user_website']);
                if ($url != "http://" AND !empty($url) AND stristr($url, "http://")) { echo "<a href=\"$url\" target=\"new\">$url</a> "; }
                echo "</span></td></tr><tr><td>";
                if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                elseif(strlen($r_comment) > $commentlimit) echo substr("$r_comment", 0, $commentlimit)."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                else echo $r_comment;
                echo "</td></tr></table><br /><p>";
                if ($anonpost==1 OR is_mod_admin($module_name) OR is_user()) {
                    echo "<span class=content color=\"$bgcolor2\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$r_tid&amp;pollID=$r_pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
                }
                modtwo($r_tid, $r_score, $r_reason);
                echo " ]</span><p>";
                DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
            }
        }
    } elseif ($mode == 'flat') {
        while($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
            $r_date = $row['date'];
            $r_name = stripslashes($row['name']);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $r_name_color = UsernameColor($r_name);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $r_email = stripslashes($row['email']);
            $r_host_name = $row['host_name'];
            $r_subject = stripslashes(check_html($row['subject'], "nohtml"));
            $r_comment = stripslashes($row['comment']);
            $r_score = intval($row['score']);
            $r_reason = intval($row['reason']);
            if($r_score >= $thold) {
                if (!preg_match("/[a-z0-9]/i",$r_name)) $r_name = $anonymous;
                if (!preg_match("/[a-z0-9]/i",$r_subject)) $r_subject = "["._NOSUBJECT."]";
                echo "<a name=\"$r_tid\">";
                echo "<hr /><table width=99% border=0><tr bgcolor=\"$bgcolor1\"><td>";
                formatTimestamp($r_date);
                if ($r_email) {
                    echo "<p><strong>$r_subject</strong> <span class=content>";
                    if($userinfo['noscore'] == 0) {
                        echo "("._SCORE." $r_score";
                        if($r_reason>0) echo ", $reasons[$r_reason]";
                        echo ")";
                    }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    echo "<br />"._BY." <a href=\"mailto:$r_email\">$r_name_color</a> <span class=content><strong>($r_email)</strong></span> "._ON." $datetime";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                 } else {
                    echo "<p><strong>$r_subject</strong> <span class=content>";
                    if($userinfo['noscore'] == 0) {
                        echo "("._SCORE." $r_score";
                        if($r_reason>0) echo ", $reasons[$r_reason]";
                        echo ")";
                    }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                    echo "<br />"._BY." $r_name_color "._ON." $datetime";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                }
                if ($r_name != $anonymous) {
                    $row3 = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$r_name'"));
                    $ruid = intval($row3['user_id']);
                    echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$r_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a>) ";
                }
                $row_url2 = $db->sql_fetchrow($db->sql_query("SELECT user_website FROM ".$user_prefix."_users WHERE username='$r_name'"));
                $url = $row_url2['user_website'];
                if ($url != "http://" AND !empty($url) AND preg_match("#http://#i", $url)) { echo "<a href=\"$url\" target=\"new\">$url</a> "; }
                echo "</span></td></tr><tr><td>";
                if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                elseif(strlen($r_comment) > $commentlimit) echo substr("$r_comment", 0, $commentlimit)."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
                else echo $r_comment;
                echo "</td></tr></table><br /><p><span class=content color=\"$bgcolor2\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$r_tid&amp;pollID=$r_pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
                modtwo($r_tid, $r_score, $r_reason);
                echo " ]</span><p>";
                DisplayKids($r_tid, $mode, $order, $thold);
            }
        }
    } else {
        while($row = $db->sql_fetchrow($result)) {
            $r_tid = intval($row['tid']);
            $r_pid = intval($row['pid']);
            $r_pollID = intval($row['pollID']);
            $r_date = $row['date'];
            $r_name = stripslashes($row['name']);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $r_name_color = UsernameColor($r_name);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $r_email = stripslashes($row['email']);
            $r_host_name = $row['host_name'];
            $r_subject = stripslashes(check_html($row['subject'], "nohtml"));
            $r_comment = stripslashes($row['comment']);
            $r_score = intval($row['score']);
            $r_reason = intval($row['reason']);
            if($r_score >= $thold) {
                if (isset($level) && !$comments) {
                  echo "<ul>";
                }
                $comments++;
                if (!preg_match("/[a-z0-9]/i",$r_name)) $r_name = $anonymous;
                if (!preg_match("/[a-z0-9]/i",$r_subject)) $r_subject = "["._NOSUBJECT."]";
                formatTimestamp($r_date);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                echo "<li><span class=\"content\"><a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=showreply&amp;tid=$r_tid&amp;pollID=$r_pollID&amp;pid=$r_pid&amp;mode=$mode&amp;order=$order&amp;thold=$thold#$r_tid\">$r_subject</a> "._BY." $r_name_color "._ON." $datetime</span><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1);
            }
        }
    }
    if ($level && $comments) {
        echo "</ul>";
    }

}

function DisplayBabies ($tid, $level=0, $dummy=0) {
    global $userinfo, $datetime, $anonymous, $prefix, $db, $module_name;

    $comments = 0;
    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason FROM ".$prefix."_pollcomments WHERE pid = '$tid' order by date, tid");
    while($row = $db->sql_fetchrow($result)) {
        $r_tid = intval($row['tid']);
        $r_pid = intval($row['pid']);
        $r_pollID = intval($row['pollID']);
        $r_date = $row['date'];
        $r_name = stripslashes($row['name']);
        $r_email = stripslashes($row['email']);
        $r_host_name = $row['host_name'];
        $r_subject = stripslashes(check_html($row['subject'], "nohtml"));
        $r_comment = stripslashes($row['comment']);
        $r_score = intval($row['score']);
        $r_reason = intval($row['reason']);
        if (!isset($level)) {
        } else {
            if (!$comments) {
                echo "<ul>";
            }
        }
        $comments++;
        if (!preg_match("/[a-z0-9]/i",$r_name)) { $r_name = $anonymous; }
        if (!preg_match("/[a-z0-9]/i",$r_subject)) { $r_subject = "["._NOSUBJECT."]"; }
        formatTimestamp($r_date);
        echo "<a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=showreply&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">$r_subject</a><span class=\"content\"> "._BY." $r_name "._ON." $datetime<br />";
        DisplayBabies($r_tid, $level+1, $dummy+1);
    }
    if ($level && $comments) {
        echo "</ul>";
    }
}

function DisplayTopic ($pollID, $pid=0, $tid=0, $mode="thread", $order=0, $thold=0, $level=0, $nokids=0) {
    global $title, $bgcolor1, $bgcolor2, $bgcolor3, $hr, $user, $datetime, $cookie, $admin, $commentlimit, $anonymous, $reasons, $anonpost, $foot1, $foot2, $foot3, $foot4, $prefix, $module_name, $db, $admin_file, $userinfo, $user_prefix;

    include_once(NUKE_BASE_DIR.'header.php');
    $count_times = 0;

    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }

    $q = "select tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason FROM ".$prefix."_pollcomments WHERE pollID='$pollID' and pid='$pid'";
    if(!empty($thold)) {
        $q .= " and score>='$thold'";
    } else {
        $q .= " and score>='0'";
    }
    if ($order==1) $q .= " order by date desc";
    if ($order==2) $q .= " order by score desc";
    $something = $db->sql_query($q);
    $num_tid = $db->sql_numrows($something);
    navbar($pollID, $title, $thold, $mode, $order);
    modone();
    while ($count_times < $num_tid) {
        echo "<br />";
        OpenTable();
        $row_q = $db->sql_fetchrow($something);
        $tid = intval($row_q['tid']);
        $pid = intval($row_q['pid']);
        $pollID = intval($row_q['pollID']);
        $date = $row_q['date'];
        $c_name = stripslashes($row_q['name']);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $c_name_color = UsernameColor($c_name);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $email = stripslashes($row_q['email']);
        $host_name = $row_q['host_name'];
        $subject = stripslashes(check_html($row_q['subject'], "nohtml"));
        $comment = stripslashes($row_q['comment']);
        $score = intval($row_q['score']);
        $reason = intval($row_q['reason']);
        if (empty($c_name)) { $c_name = $anonymous; }
        if (empty($subject)) { $subject = "["._NOSUBJECT."]"; }
        echo "<a name=\"$tid\">";
        echo "<table width=99% border=0><tr bgcolor=\"$bgcolor1\"><td width=500>";
        formatTimestamp($date);
        if ($email) {
            echo "<p><strong>$subject</strong> <span class=content>";
            if($userinfo['noscore'] == 0) {
                echo "("._SCORE." $score";
                if($reason>0) echo ", $reasons[$reason]";
                echo ")";
            }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            echo "<br />"._BY." <a href=\"mailto:$email\">$c_name_color</a> <strong>($email)</strong> "._ON." $datetime";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        } else {
            echo "<p><strong>$subject</strong> <span class=content>";
            if($userinfo['noscore'] == 0) {
                echo "("._SCORE." $score";
                if($reason>0) echo ", $reasons[$reason]";
                echo ")";
            }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            echo "<br />"._BY." $c_name_color "._ON." $datetime";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        }

    // If you are admin you can see the Poster IP address (you have this right, no?)
    // with this you can see who is flaming you... ha-ha-ha

        $journal = '';
        if (is_active("Journal")) {
            $row = $db->sql_fetchrow($db->sql_query("SELECT jid FROM ".$prefix."_journal WHERE aid='$c_name' AND status='yes' order by pdate,jid DESC limit 0,1"));
            $jid = intval($row['jid']);
            if (!empty($jid) AND isset($jid)) {
                $journal = " | <a href=\"modules.php?name=Journal&amp;file=display&amp;jid=$jid\">"._JOURNAL."</a>";
            } else {
                $journal = '';
            }
        }
        if ($c_name != $anonymous) {
            $row2 = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$c_name'"));
            $r_uid = intval($row2['user_id']);
            echo "<br />(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$c_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$r_uid\">"._SENDAMSG."</a>$journal) ";
        }
        $row_url = $db->sql_fetchrow($db->sql_query("SELECT user_website FROM ".$user_prefix."_users WHERE username='$c_name'"));
        $url = stripslashes($row_url['user_website']);
        if ($url != "http://" AND !empty($url) AND stristr($url, "http://")) { echo "<a href=\"$url\" target=\"new\">$url</a> "; }

        if(is_mod_admin($module_name)) {
            $row3 = $db->sql_fetchrow($db->sql_query("SELECT host_name FROM ".$prefix."_pollcomments WHERE tid='$tid'"));
            $host_name = $row3['host_name'];
            echo "<br /><strong>(IP: $host_name)</strong>";
        }

        echo "</span></td></tr><tr><td>";
        if((isset($userinfo['commentmax'])) && (strlen($comment) > $userinfo['commentmax'])) echo substr("$comment", 0, $userinfo['commentmax'])."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
        elseif(strlen($comment) > $commentlimit) echo substr($comment, 0, $commentlimit)."<br /><br /><strong><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$pollID&amp;tid=$tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></strong>";
        else echo $comment;
        echo "</td></tr></table><br /><p>";
        if ($anonpost==1 OR is_mod_admin($module_name) OR is_user()) {
            echo "<span class=\"content\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$tid&amp;pollID=$pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
        }
        if ($pid != 0) {
            $row4 = $db->sql_fetchrow($db->sql_query("SELECT pid FROM ".$prefix."_pollcomments WHERE tid='$pid'"));
            $erin = intval($row4['pid']);
            echo "| <a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$pollID&amp;pid=$erin&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._PARENT."</a>";
        }
        modtwo($tid, $score, $reason);

        if(is_mod_admin($module_name)) {
            echo " | <a href=\"".$admin_file.".php?op=RemovePollComment&amp;tid=$tid&amp;pollID=$pollID\">"._DELETE."</a> ]</span><p>";
        } elseif ($anonpost != 0 OR is_mod_admin($module_name) OR is_user()) {
            echo " ]</span><p>";
        }

        DisplayKids($tid, $mode, $order, $thold, $level);
        echo "</ul>";
        if($hr) echo "<hr noshade size=1>";
        echo "</p>";
        $count_times += 1;
        CloseTable();
    }
    modthree($pollID, $mode, $order, $thold);
    if($pid==0) return array($pollID, $pid, $subject);
    else include_once(NUKE_BASE_DIR.'footer.php');
}

function singlecomment($tid, $pollID, $mode, $order, $thold) {
    include_once(NUKE_BASE_DIR.'header.php');
    global $userinfo, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $anonpost, $admin, $anonymous, $prefix, $db, $module_name;

    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
            $mode = $userinfo['umode'];
        } else {
            $mode = "thread";
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
            $order = $userinfo['uorder'];
        } else {
            $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
            $thold = $userinfo['thold'];
        } else {
            $thold = 0;
        }
    }

    $tid = intval($tid);
    $pollID = intval($pollID);
    $row = $db->sql_fetchrow($db->sql_query("SELECT date, name, email, subject, comment, score, reason FROM ".$prefix."_pollcomments WHERE tid='$tid' and pollID='$pollID'"));
    $date = $row['date'];
    $name = stripslashes($row['name']);
    $email = stripslashes($row['email']);
    $subject = stripslashes(check_html($row['subject'], "nohtml"));
    $comment = stripslashes($row['comment']);
    $score = intval($row['score']);
    $reason = intval($row['reason']);
    $titlebar = "<strong>$subject</strong>";
    if(empty($name)) $name = $anonymous;
    if(empty($subject)) $subject = "["._NOSUBJECT."]";
    modone();
    echo "<table width=99% border=0><tr bgcolor=\"$bgcolor1\"><td width=500>";
    formatTimestamp($date);
    if($email) echo "<p><strong>$subject</strong> <span class=content>("._SCORE." $score)<br />"._BY." <a href=\"mailto:$email\"><font color=\"$bgcolor2\">$name</font></a> <span class=content><strong>($email)</strong></span> "._ON." $datetime";
    else echo "<p><strong>$subject</strong> <span class=content>("._SCORE." $score)<br />"._BY." $name "._ON." $datetime";
    echo "</td></tr><tr><td>$comment</td></tr></table><br /><p><span class=content color=\"$bgcolor2\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$tid&amp;pollID=$pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a> | <a href=\"modules.php?name=$module_name&amp;pollID=$pollID\">"._ROOT."</a>";
    modtwo($tid, $score, $reason);
    echo " ]";
    modthree($pollID, $mode, $order, $thold);
    include_once(NUKE_BASE_DIR.'footer.php');
}

function reply ($pid, $pollID, $mode, $order, $thold) {
    include_once(NUKE_BASE_DIR.'header.php');
    global $userinfo, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $AllowableHTML, $anonymous, $prefix, $anonpost, $module_name, $db;

    if (!isset($mode) OR empty($mode)) {
        if(isset($userinfo['umode'])) {
          $mode = $userinfo['umode'];
        } else {
          $mode = 'thread';
        }
    }
    if (!isset($order) OR empty($order)) {
        if(isset($userinfo['uorder'])) {
          $order = $userinfo['uorder'];
        } else {
          $order = 0;
        }
    }
    if (!isset($thold) OR empty($thold)) {
        if(isset($userinfo['thold'])) {
          $thold = $userinfo['thold'];
        } else {
          $thold = 0;
        }
    }

    $pid = intval($pid);
    $pollID = intval($pollID);
    $order = htmlentities($order);
    $thold = htmlentities($thold);
    $mode = htmlentities($mode);
    if ($anonpost == 0 AND !is_user()) {
    OpenTable();
    echo "<center><span class=title><strong>"._SURVEYCOM."</strong></span></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center>"._NOANONCOMMENTS."<br /><br />"._GOBACK."</center>";
    CloseTable();
    } else {
    if($pid!=0) {
        list($date, $name, $email, $subject, $comment, $score) = $db->sql_fetchrow($db->sql_query("SELECT date, name, email, subject, comment, score FROM ".$prefix."_pollcomments WHERE tid='$pid'"));
                $score = intval($score);
    } else {
        list($subject) = $db->sql_fetchrow($db->sql_query("SELECT pollTitle FROM ".$prefix."_poll_desc WHERE pollID='$pollID'"));
    }
    if(empty($comment)) {
        $comment = $temp_comment;
    }
    $titlebar = "<strong>$subject</strong>";
    if(empty($name)) $name = $anonymous;
    if(empty($subject)) $subject = "["._NOSUBJECT."]";
    formatTimestamp($date);
    OpenTable();
    echo "<center><span class=\"title\"><strong>"._SURVEYCOM."</strong></span></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><span class=\"content\"><strong>$subject</strong></center><br />";
    if (empty($comment)) {
        echo "<center><i>"._DIRECTCOM."</i></span></center><br />";
    } else {
        echo "<br />$comment</span>";
    }
    CloseTable();
    if(!isset($pid) || !isset($pollID)) { echo "Something is not right. This message is just to keep things FROM messing up down the road"; exit(); }
    if($pid == 0) {
        list($subject) = $db->sql_fetchrow($db->sql_query("SELECT pollTitle FROM ".$prefix."_poll_desc WHERE pollID='$pollID'"));
    } else {
        list($subject) = $db->sql_fetchrow($db->sql_query("SELECT subject FROM ".$prefix."_pollcomments WHERE tid='$pid'"));
    }
    echo "<br />";
    OpenTable();
    echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">";
    echo "<span class=\"content\"><strong>"._YOURNAME.":</strong></span> ";
    if (is_user()) {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $username_color = UsernameColor($cookie[1]);
        echo "<span class=\"content\"><a href=\"modules.php?name=Your_Account\">$username_color</a> [ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</span>";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    } else {
        echo "<span class=\"content\">$anonymous</span>";
        $xanonpost=1;
    }
    echo "<br /><br /><span class=\"content\"><strong>"._SUBJECT.":</strong></span><br />";
    if (!stristr($subject,"Re:")) $subject = "Re: ".substr($subject,0,81)."";
    echo "<INPUT TYPE=\"text\" NAME=\"subject\" SIZE=50 maxlength=85 value=\"$subject\"><br />";
    echo "<br /><br /><span class=\"content\"><strong>"._UCOMMENT.":</strong></span><br />"
        ."<TEXTAREA wrap=virtual cols=50 rows=10 name=comment></TEXTAREA><br />";
        echo "<br />";
        if (is_user() AND ($anonpost == 1)) { echo "<INPUT type=checkbox name=xanonpost> "._POSTANON."<br />"; }
        echo "<INPUT type=\"hidden\" name=\"pid\" value=\"$pid\">"
        ."<INPUT type=\"hidden\" name=\"pollID\" value=\"$pollID\">"
        ."<INPUT type=\"hidden\" name=\"mode\" value=\"$mode\">"
        ."<INPUT type=\"hidden\" name=\"order\" value=\"$order\">"
        ."<INPUT type=\"hidden\" name=\"thold\" value=\"$thold\">"
        ."<INPUT type=\"hidden\" name=\"posttype\" value=\"plaintex\">"
        ."<br /><INPUT type=submit name=op value=\""._PREVIEW."\"> "
        ."<INPUT type=submit name=op value=\""._OK."\"> "
        ."</FORM>";
    CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
}

function replyPreview ($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype) {
    include_once(NUKE_BASE_DIR.'header.php');
    global $userinfo, $user, $cookie, $AllowableHTML, $anonymous, $module_name;

    if (!isset($mode) OR empty($mode)) {
                    if(isset($userinfo['umode'])) {
                      $mode = $userinfo['umode'];
                    } else {
                      $mode = "thread";
                    }
    }
    if (!isset($order) OR empty($order)) {
                    if(isset($userinfo['uorder'])) {
                      $order = $userinfo['uorder'];
                    } else {
                      $order = 0;
                    }
    }
    if (!isset($thold) OR empty($thold)) {
                    if(isset($userinfo['thold'])) {
                      $thold = $userinfo['thold'];
                    } else {
                      $thold = 0;
                    }
    }

    $subject = stripslashes(check_html($subject, "nohtml"));
    $comment = stripslashes(check_html($comment));
    $pid = intval($pid);
    $pollID = intval($pollID);
    if (!isset($pid) || !isset($pollID)) {
        die(_NOTRIGHT);
    }
    OpenTable();
    echo "<center><span class=\"title\"><strong>"._SURVEYCOMPRE."</strong></span></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<strong>$subject</strong><br />";
    echo "<span class=content>"._BY." ";
    if (is_user()) {
        echo $cookie[1];
    } else {
        echo $anonymous;
    }
    echo "</span><br /><br />";
    if ($posttype=="exttrans") {
        echo nl2br(htmlspecialchars($comment));
    } elseif ($posttype=="plaintext") {
        echo nl2br($comment);
    } else {
        echo $comment;
    }
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">"
        ."<span class=\"content\"><strong>"._YOURNAME.":</strong></span> ";
    if (is_user()) {
        echo "<span class=\"content\"><a href=\"modules.php?name=Your_Account\">$cookie[1]</a> <span class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</span>";
    } else {
        echo "<span class=\"content\">$anonymous</span>";
    }
    echo "<br /><br /><span class=\"content\"><strong>"._SUBJECT.":</strong></span><br />"
        ."<INPUT TYPE=\"text\" name=\"subject\" size=\"50\" maxlength=\"85\" value=\"$subject\"><br /><br />"
        ."<P><span class=\"content\"><strong>"._UCOMMENT.":</strong></span><br />"
        ."<TEXTAREA wrap=\"virtual\" cols=\"50\" rows=\"10\" name=\"comment\">$comment</TEXTAREA><br />";
        echo "<br />";
    if (($xanonpost) AND ($anonpost == 1)) {
        echo "<INPUT type=\"checkbox\" name=\"xanonpost\" checked> "._POSTANON."<br />";
    } elseif ((is_user()) AND ($anonpost == 1)) {
        echo "<INPUT type=\"checkbox\" name=\"xanonpost\"> "._POSTANON."<br />";
    }
    echo "<INPUT type=\"hidden\" name=\"pid\" value=\"$pid\">"
        ."<INPUT type=\"hidden\" name=\"pollID\" value=\"$pollID\"><INPUT type=\"hidden\" name=\"mode\" value=\"$mode\">"
        ."<INPUT type=\"hidden\" name=\"order\" value=\"$order\"><INPUT type=\"hidden\" name=\"thold\" value=\"$thold\">"
        ."<br /><INPUT type=submit name=op value=\""._PREVIEW."\"> "
        ."<INPUT type=submit name=op value=\""._OK."\"><INPUT type=\"hidden\" name=\"posttype\" value=\"plaintex\"></FORM>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function CreateTopic ($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype) {
    global $userinfo, $user, $userinfo, $EditedMessage, $cookie, $prefix, $pollcomm, $anonpost, $db, $module_name;

                  if (!isset($mode) OR empty($mode)) {
                    if(isset($userinfo['umode'])) {
                      $mode = $userinfo['umode'];
                    } else {
                      $mode = "thread";
                    }
                  }
                  if (!isset($order) OR empty($order)) {
                    if(isset($userinfo['uorder'])) {
                      $order = $userinfo['uorder'];
                    } else {
                      $order = 0;
                    }
                  }
                  if (!isset($thold) OR empty($thold)) {
                    if(isset($userinfo['thold'])) {
                      $thold = $userinfo['thold'];
                    } else {
                      $thold = 0;
                    }
                  }

    $author = Fix_Quotes($author);
    $subject = Fix_Quotes(filter_text($subject, "nohtml"));
    $comment = format_url($comment);
    if ($posttype=="exttrans") {
        $comment = Fix_Quotes(nl2br(htmlspecialchars(check_words($comment))));
    } elseif ($posttype=="plaintext") {
        $comment = Fix_Quotes(nl2br(filter_text($comment)));
    } else {
        $comment = Fix_Quotes(filter_text($comment));
    }
    if ((is_user()) && (!$xanonpost)) {
    $name = $userinfo['username'];
    $email = $userinfo['femail'];
    $url = $userinfo['user_website'];
    $score = 1;
    } else {
    $name = "";
    $email = "";
    $url = "";
    $score = 0;
    }
    $ip = identify::get_ip();
    $pollID = intval($pollID);
    $result = $db->sql_query("SELECT count(*) FROM ".$prefix."_poll_desc WHERE pollID='$pollID'");
    $fake = $db->sql_numrows($result);
    if ($fake == 1) {
    if ((($anonpost == 0) AND (is_user())) OR ($anonpost == 1)) {
        $db->sql_query("insert into ".$prefix."_pollcomments values (NULL, '$pid', '$pollID', now(), '$name', '$email', '$url', '$ip', '$subject', '$comment', '$score', '0')");
    } else {
        echo "Nice try...";
        exit;
    }
    } else {
    include_once(NUKE_BASE_DIR.'header.php');
    echo "According to my records, the topic you are trying "
        ."to reply to does not exist. If you're just trying to be "
        ."annoying, well then too bad.";
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
    }
    if ($pollcomm == 1) {
    if (isset($userinfo['umode'])) $options .= "&amp;mode=".$userinfo['umode']; else $options .= "&amp;mode=thread";
    if (isset($userinfo['uorder'])) $options .= "&amp;order=".$userinfo['uorder']; else $options .= "&amp;order=0";
    if (isset($userinfo['thold'])) $options .= "&amp;thold=".$userinfo['thold']; else $options .= "&amp;thold=0";
    } else {
    $options = "";
    }
    redirect("modules.php?name=$module_name&op=results&pollID=$pollID$options");
}

// Quake - start
if (isset($sid)) { $sid = intval($sid); } else { $sid = ''; }
if (isset($pollID)) { $pollID = intval($pollID); } else { $pollID = ''; }
if (isset($tid)) { $tid = intval($tid); } else { $tid = ''; }
if (isset($pid)) { $pid = intval($pid); } else { $pid = ''; }
if (isset($order)) { $order = intval($order); }
if (isset($thold)) { $thold = intval($thold); }

if (!isset($mode) OR empty($mode)) {
  if(isset($userinfo['umode'])) {
    $mode = $userinfo['umode'];
  } else {
    $mode = 'thread';
  }
}
if (!isset($order) OR empty($order)) {
  if(isset($userinfo['uorder'])) {
    $order = $userinfo['uorder'];
  } else {
    $order = 0;
  }
}
if (!isset($thold) OR empty($thold)) {
  if(isset($userinfo['thold'])) {
    $thold = $userinfo['thold'];
  } else {
    $thold = 0;
  }
}

switch($op) {

    case "Reply":
        reply($pid, $pollID, $mode, $order, $thold);
        break;

    case _PREVIEW:
        replyPreview ($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype);
        break;

    case _OK:
        CreateTopic($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold, $posttype);
        break;

    case "moderate":
        global $module_name;
        include_once(NUKE_BASE_MODULES.'mainfile.php');
        if((is_mod_admin($module_name)) || ($moderate==2)) {
            while(list($tdw, $emp) = each($_POST)) {
                $tdw = intval($tdw);
                if (stristr($tdw,"dkn")) {
                    $emp = explode(":", $emp);
                    if($emp[1] != 0) {
                        $tdw = str_replace("dkn", "", $tdw);
                        $emp[0] = intval($emp[0]);
                        $emp[1] = intval($emp[1]);
                        $tdw = intval($tdw);
                        $q = "UPDATE ".$prefix."_pollcomments SET";
                        if(($emp[1] == 9) && ($emp[0]>=0)) { # Overrated
                            $q .= " score=score-1 WHERE tid='$tdw'";
                        } elseif (($emp[1] == 10) && ($emp[0]<=4)) { # Underrated
                            $q .= " score=score+1 WHERE tid='$tdw'";
                        } elseif (($emp[1] > 4) && ($emp[0]<=4)) {
                            $q .= " score='score+1', reason='$emp[1]' WHERE tid='$tdw'";
                        } elseif (($emp[1] < 5) && ($emp[0] > -1)) {
                            $q .= " score='score-1', reason='$emp[1]' WHERE tid='$tdw'";
                        } elseif (($emp[0] == -1) || ($emp[0] == 5)) {
                            $q .= " reason='$emp[1]' WHERE tid='$tdw'";
                        }
                        if(strlen($q) > 20) $db->sql_query($q);
                    }
                }
            }
        }
        redirect("modules.php?name=$module_name&op=results&pollID=$pollID");
        break;

    case "showreply":
        DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
        break;

    default:
        global $module_name, $mode, $userinfo, $order, $thold;
        if ((isset($tid)) && (!isset($pid))) {
            singlecomment($tid, $pollID, $mode, $order, $thold);
        } elseif (!isset($pid)) {
            redirect("modules.php?name=$module_name&op=results&pollID=$pollID&mode=$mode&order=$order&thold=$thold");
        } else {
            if(!isset($pid)) $pid=0;
            if(!isset($tid)) $tid=0;
            DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
        }
    break;
}

?>