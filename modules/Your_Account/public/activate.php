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
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    if ($ya_config['expiring']!=0) {
        $past = time()-$ya_config['expiring'];
        $res = $db->sql_query("SELECT user_id FROM ".$user_prefix."_users_temp WHERE time < '$past'");
        while (list($uid) = $db->sql_fetchrow($res)) {
                  $uid = intval($uid);
          $db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE user_id = $uid");
          $db->sql_query("DELETE FROM ".$user_prefix."_cnbya_value_temp WHERE uid = '$uid'");
        }
        
        $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_cnbya_value_temp");
        $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users_temp");
    }

    $username  = trim(check_html($username, 'nohtml'));
    $check_num = trim(check_html($check_num, 'nohtml'));
    $result    = $db->sql_query("SELECT * FROM ".$user_prefix."_users_temp WHERE username='$username' AND check_num='$check_num'");
    if ($db->sql_numrows($result) == 1) {
        $row_act = $db->sql_fetchrow($result);
    $ya_username = $row_act['username'];
    $ya_realname = $row_act['realname'];
    $ya_useremail = $row_act['user_email'];
    $ya_time = $row_act['time'];
        $lv = time();
        include_once(NUKE_BASE_DIR.'header.php');
        title(_PERSONALINFO);
        OpenTable();
        echo "<table class='forumline' cellpadding=\"3\" cellspacing=\"3\" border=\"0\" width='100%'>\n";
        echo "<tr><td align=\"center\" bgcolor='$bgcolor2' colspan=\"2\"><strong>"._FORACTIVATION."</strong>:</td></tr>\n";
        echo "<form name=\"Register\" action=\"modules.php?name=$module_name\" method=\"post\">\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._USRNICKNAME.":</td><td bgcolor='$bgcolor1'>$ya_username</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":<br />"._REQUIRED."</td><td bgcolor='$bgcolor1'>";
        echo "<input type=\"text\" name=\"realname\" value=\"$ya_realname\" size=\"50\" maxlength=\"60\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._UREALEMAIL.":</td>";
        echo "<td bgcolor='$bgcolor1'>$ya_useremail</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._UFAKEMAIL.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"femail\" value=\"\" size=\"50\" maxlength=\"255\"><br />"._EMAILPUBLIC."</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YOURHOMEPAGE.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_website\" value=\"\" size=\"50\" maxlength=\"255\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YICQ.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_icq\" value=\"\" size=\"30\" maxlength=\"100\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YAIM.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_aim\" value=\"\" size=\"30\" maxlength=\"100\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YYIM.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_yim\" value=\"\" size=\"30\" maxlength=\"100\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YMSNM.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_msnm\" value=\"\" size=\"30\" maxlength=\"100\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YLOCATION.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_from\" value=\"\" size=\"30\" maxlength=\"100\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YOCCUPATION.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_occ\" value=\"\" size=\"30\" maxlength=\"100\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YINTERESTS.":<br />"._OPTIONAL."</td>";
        echo "<td bgcolor='$bgcolor1'><input type=\"text\" name=\"user_interests\" value=\"\" size=\"30\" maxlength=\"100\"></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._RECEIVENEWSLETTER.":</td><td bgcolor='$bgcolor1'><select name='newsletter'>";
        echo "<option value=\"1\">"._YES."</option><option value=\"0\" selected>"._NO."</option></select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ALWAYSSHOWEMAIL.":</td><td bgcolor='$bgcolor1'><select name='user_viewemail'>";
        echo "<option value=\"1\">"._YES."</option><option value=\"0\" selected>"._NO."</option></select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._HIDEONLINE.":</td><td bgcolor='$bgcolor1'><select name='user_allow_viewonline'>";
        echo "<option value=\"0\">"._YES."</option><option value=\"1\" selected>"._NO."</option></select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FORUMSTIME."</td><td bgcolor='$bgcolor1'><select name='user_timezone'>";
        $utz = date("Z");
        $utz = round($utz/3600);
        for ($i=-12; $i<13; $i++) {
            if ($i == 0) {
                $dummy = "GMT";
            } else {
                if (!preg_match("/[\-]/", $i)) { $i = "+$i"; }
                $dummy = "GMT $i "._HOURS."";
            }
            if ($utz == $i) {
                echo "<option name=\"user_timezone\" value=\"$i\" selected>$dummy</option>";
            } else {
                echo "<option name=\"user_timezone\" value=\"$i\">$dummy</option>";
            }
        }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FORUMSDATE.":<br />"._FORUMSDATEMSG."</td><td bgcolor='$bgcolor1'>";
        echo "<input type=\"text\" name=\"user_dateformat\" value=\"D M d, Y g:i a\" size='15' maxlength='14'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._SIGNATURE.":<br />"._OPTIONAL."<br />"._NOHTML."</td>";
        echo "<td bgcolor='$bgcolor1'><textarea wrap=\"virtual\" cols=\"50\" rows=\"5\" name=\"user_sig\">$userinfo[user_sig]</textarea><br />"._255CHARMAX."</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EXTRAINFO.":<br />"._OPTIONAL."<br />"._NOHTML."</td>";
        echo "<td bgcolor='$bgcolor1'><textarea wrap=\"virtual\" cols=\"50\" rows=\"5\" name=\"bio\">$userinfo[bio]</textarea><br />"._CANKNOWABOUT."</td></tr>\n";
        echo "<input type=\"hidden\" name=\"ya_username\" value=\"$ya_username\">";
        echo "<input type=\"hidden\" name=\"check_num\" value=\"$check_num\">\n";
        echo "<input type=\"hidden\" name=\"ya_time\" value=\"$ya_time\">\n";
        echo "<input type=\"hidden\" name=\"op\" value=\"saveactivate\">";
        echo "<tr><td bgcolor='$bgcolor1' colspan='2' align='center'><input type=\"submit\" value=\""._SAVECHANGES."\"></td></tr>\n";
        echo "</form>\n";
        echo "</table>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        title(""._ACTIVATIONERROR."");
        OpenTable();
        echo "<center>"._ACTERROR."</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }

?>