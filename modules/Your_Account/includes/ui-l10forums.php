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

    // Last 10 Forum Topics
    $result8 = $db->sql_query("SELECT t.topic_id, t.topic_title, f.forum_name, t.forum_id FROM ".$prefix."_bbtopics t, ".$prefix."_bbforums f WHERE t.forum_id=f.forum_id AND t.topic_poster='$usrinfo[user_id]' AND auth_view<'2' AND auth_read<'2' AND auth_post<'2' order by t.topic_time DESC LIMIT 0,10");
    if (($db->sql_numrows($result8) > 0)) {
        echo "<br />";
        OpenTable();
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $usrcolor = UsernameColor($usrinfo['username']);
        echo "<strong>".$usrcolor."'s "._LAST10BBTOPIC.":</strong><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        while(list($topic_id, $topic_title, $forum_name, $forum_id) = $db->sql_fetchrow($result8)) {
            echo "<li><a href=\"modules.php?name=Forums&amp;file=viewforum&amp;f=$forum_id\">$forum_name</a> &#187; <a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;t=$topic_id\">$topic_title</a><br />";
        }
        CloseTable();
    }

    // Last 10 Forum Posts
    $result12 = $db->sql_query("SELECT p.post_id, r.post_subject, f.forum_name, p.forum_id FROM ".$prefix."_bbposts p, ".$prefix."_bbposts_text r, ".$prefix."_bbforums f WHERE p.forum_id=f.forum_id AND r.post_id=p.post_id AND p.poster_id='$usrinfo[user_id]' AND auth_view<'2' AND auth_read<'2' AND auth_post<'2' order by p.post_time DESC LIMIT 0,10");
    if (($db->sql_numrows($result12) > 0)) {
        echo "<br />";
        OpenTable();
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $usrcolor = UsernameColor($usrinfo['username']);
        echo "<strong>$usrcolor's "._LAST10BBPOST.":</strong><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        while(list($post_id, $post_subject, $forum_name, $forum_id) = $db->sql_fetchrow($result12)) {
            if(empty($post_subject)) { $post_subject = _NOPOSTSUBJECT; }
            echo "<li><a href=\"modules.php?name=Forums&amp;file=viewforum&amp;f=$forum_id\">$forum_name</a> &#187; <a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$post_id#$post_id\">$post_subject</a><br />";
        }
        CloseTable();
    }

?>