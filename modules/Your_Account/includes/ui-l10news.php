<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/11/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    // Last 10 Comments
    if ($articlecomm == 1) {
        $result6 = $db->sql_query("SELECT tid, sid, subject FROM ".$prefix."_blogs_comments WHERE name='$usrinfo[username]' ORDER BY tid DESC LIMIT 0,10");
        if (($db->sql_numrows($result6) > 0)) {
            echo "<br />";
            OpenTable();
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $usrcolor = UsernameColor($usrinfo['username']);
            echo "<strong>".$usrcolor."'s "._LAST10COMMENT.":</strong><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            while($row6 = $db->sql_fetchrow($result6)) {
                $tid = $row6['tid'];
                $sid = $row6['sid'];
                $subject = $row6['subject'];
                echo "<li><a href=\"modules.php?name=News&amp;file=article&amp;thold=-1&amp;mode=flat&amp;order=0&amp;sid=$sid#$tid\">$subject</a><br />";
            }
            CloseTable();
        }
    }
    // Last 10 Submissions
    $result7 = $db->sql_query("SELECT sid, title FROM ".$prefix."_blogs WHERE informant='$usrinfo[username]' ORDER BY sid DESC LIMIT 0,10");
    if (($db->sql_numrows($result7) > 0)) {
        echo "<br />";
        OpenTable();
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $usrcolor = UsernameColor($usrinfo['username']);
        echo "<strong>".$usrcolor."'s "._LAST10SUBMISSION.":</strong><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        while($row7 = $db->sql_fetchrow($result7)) {
            $sid = $row7['sid'];
            $title = $row7['title'];
            echo "<li><a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a><br />";
        }
        CloseTable();
    }

?>