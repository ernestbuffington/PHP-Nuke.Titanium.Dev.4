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
    die ('Access Denied');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(is_mod_admin($module_name)) {

  $pagetitle = ": "._USERADMIN." - "._USERUPDATE;
  include_once(NUKE_BASE_DIR.'header.php');
  OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
  title(_USERADMIN." - "._USERUPDATE);
  amain();
  echo "<br />\n";
    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_users_temp WHERE user_id='$chng_uid'");
    if($db->sql_numrows($result) > 0) {
    $chnginfo = $db->sql_fetchrow($result);
    OpenTable();
    echo "<center><table border='0'><form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._USERID.":</td><td><strong><input type='text' value='$chnginfo[user_id]' size='40' disabled=disabled style='color=#000000;background-color: #FFFFFF'></strong></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td><input type='text' name='chng_uname' value=".$chnginfo['username']." size='40' style='color=#000000;background-color: #FFFFFF'> <strong>"._YA_CHNGRISK."</strong></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":</td><td bgcolor='$bgcolor1'><input type='text' name='chng_realname' value='$chnginfo[realname]' size='40' maxlength='60' style='color=#000000;background-color: #FFFFFF'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td><input type='text' name='chng_email' value='$chnginfo[user_email]' size='40' maxlength='60' style='color=#000000;background-color: #FFFFFF'></td></tr>\n";

    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE need <> '0' ORDER BY pos");
    while ($sqlvalue = $db->sql_fetchrow($result)) {
        $t = $sqlvalue[fid];
        $result1 = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_value_temp WHERE uid='$chng_uid' AND fid='$t'");
        while ($tmpsqlvalue = $db->sql_fetchrow($result1)) {
            $tmp_value=$tmpsqlvalue[value];
            $value2 = explode("::", $sqlvalue[value]);
            if (substr($sqlvalue[name],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue[name];
            if (count($value2) == 1) { 
                echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
                echo "<input type='text' name='nfield[$t]' value='".$tmp_value."' size='40' maxlength='$sqlvalue[size]'></td></tr>\n";
            } else {
                echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
                echo "<select name='nfield[$t]'>\n";
                for ($i = 0; $i<count($value2); $i++) {
                    if (trim($chnginfo[$sqlvalue[name]]) == trim($value2[$i])) $sel = "selected"; else $sel = "";
                    echo "<option value=\"".trim($value2[$i])."\" $sel>$value2[$i]</option>\n";
                }
            echo "</select>";
            echo "</td></tr>\n";
            }
        }
    }

    echo "<tr><td bgcolor='$bgcolor2'>"._REGDATE.":</td><td><input type='text' value='$chnginfo[user_regdate]' size='40' disabled=disabled style='color=#000000;background-color: #FFFFFF'></td></tr>\n";
    $chnginfo['time'] = date("D M j H:i T Y", $chnginfo['time']);
    echo "<tr><td bgcolor='$bgcolor2'>"._YA_APPROVE2.":</td><td><input type='text' value='$chnginfo[time]' size='40' disabled=disabled style='color=#000000;background-color: #FFFFFF'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._CHECKNUM.":</td><td><input type='text' value=".$chnginfo['check_num']." size='40' disabled=disabled style='color=#000000;background-color: #FFFFFF'></td></tr>\n";
    echo "<tr><td colspan=\"2\" align=\"left\"><br />\n";

        echo "<table cellspacing=\"0\" cellpadding=\"0\" border='0'><tr>\n";
        echo "<td>\n";
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
        echo "<input type='submit' value='"._RETURN."'></td>\n";
        echo "<td width=\"3\"></td>\n";
        echo "<td>\n";
        echo "<input type='hidden' name='chng_uid'  value='$chng_uid'>\n";
        echo "<input type='hidden' name='old_uname' value='$chnginfo[username]'>\n";
        echo "<input type='hidden' name='old_email' value='$chnginfo[user_email]'>\n";
        echo "<input type='hidden' name='op'        value='modifyTempConf'>\n";
        if (isset($query)) { echo "<input type='hidden' name='query' value='$query'>\n"; }
        if (isset($min))   { echo "<input type='hidden' name='min' value='$min'>\n"; }
        if (isset($xop))   { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
        echo "<input type='submit' value='"._SAVECHANGES."'></td></form>\n";
        echo "<td width=\"3\"></td><td>\n";
            if ($ya_config['useactivate'] == 0) {
                echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'><td>\n";
                if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
                if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
                echo "<input type='hidden' name='op' value='approveUserConf'>\n";
                echo "<input type='hidden' name='apr_uid' value='".$chnginfo['user_id']."'>\n";
                echo "<input type='submit' value='"._YA_APPROVE."'></td></form>\n";
            } else {
                echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'><td>\n";
                if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
                if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
                echo "<input type='hidden' name='op' value='activateUser'>\n";
                echo "<input type='hidden' name='act_uid' value='".$chnginfo['user_id']."'>\n";
                echo "<input type='submit' value='"._YA_ACTIVATE."'></td></form>\n";
            }
        echo "</tr></table>\n";

    echo "</td></tr><tr><td colspan=\"2\"><strong>"._NOTE."</strong>\n";
    echo "</td></tr><tr><td colspan=\"2\"><strong>"._YA_APPROVENOTE."</strong>\n";
    echo "</td></tr><tr><td colspan=\"2\"><strong>"._YA_ACTIVATENOTE."</strong>\n";

    echo "</td></form></tr></table></center>\n";
    echo "<br />\n";

    CloseTable();
  } else {
    OpenTable();
    echo "<center><strong>"._USERNOEXIST."</strong></center>\n";
    CloseTable();
  }
  include_once(NUKE_BASE_DIR.'footer.php');

}

?>