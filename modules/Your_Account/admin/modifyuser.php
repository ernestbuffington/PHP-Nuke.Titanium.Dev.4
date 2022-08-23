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
$result = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_id='$chng_uid' OR username='$chng_uid'");
if($db->sql_numrows($result) > 0) {
    $chnginfo = $db->sql_fetchrow($result);

    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field");
    while ($sqlvalue = $db->sql_fetchrow($result)) {
        list($value) = $db->sql_fetchrow( $db->sql_query("SELECT value FROM ".$user_prefix."_cnbya_value WHERE fid ='$sqlvalue[fid]' AND uid = '$chnginfo[user_id]'"));
        $chnginfo[$sqlvalue[name]] = $value;
    }

    OpenTable();
    echo "<center><table border='0'>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._USERID.":</td><td><strong>".$chnginfo['user_id']."</strong></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td><input type='text' name='chng_uname' value='".$chnginfo['username']."' size='20'><br /><strong>"._YA_CHNGRISK."</strong></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":</td><td><input type='text' name='chng_name' value='".$chnginfo['name']."' size='45' maxlength='60'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><input type='text' name='chng_url' value='".$chnginfo['user_website']."' size='45' maxlength='60'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td><input type='text' name='chng_email' value='".$chnginfo['user_email']."' size='45' maxlength='60'> <span class='tiny'>"._REQUIRED."</span></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._FAKEEMAIL.":</td><td><input type='text' name='chng_femail' value='".$chnginfo['femail']."' size='45' maxlength='60'></td></tr>\n";

        $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE need <> '0' ORDER BY pos");
        while ($sqlvalue = $db->sql_fetchrow($result)) {
          $t = $sqlvalue['fid'];
          $value2 = explode("::", $sqlvalue[value]);
          if (substr($sqlvalue['name'],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue['name'];
          if (count($value2) == 1) {
            echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'><input type='text' name='nfield[$t]' value='".$chnginfo[$sqlvalue['name']]."' size='20' maxlength='$sqlvalue[size]'></td></tr>\n";
          } else {
            echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
            echo "<select name='nfield[$t]'>\n";
             for ($i = 0; $i<count($value2); $i++) {
              if (trim($chnginfo[$sqlvalue['name']]) == trim($value2[$i])) $sel = "selected"; else $sel = "";
              echo "<option value=\"".trim($value2[$i])."\" $sel>$value2[$i]</option>\n";
            }
            echo "</select>";
            echo "</td></tr>\n";
          }
        }

    echo "<tr><td bgcolor='$bgcolor2'>"._LOCATION.":</td><td><input type='text' name='chng_user_from' value='".$chnginfo['user_from']."' size='25' maxlength='60'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._OCCUPATION.":</td><td><input type='text' name='chng_user_occ' value='".$chnginfo['user_occ']."' size='25' maxlength='60'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._INTERESTS.":</td><td><input type='text' name='chng_user_interests' value='".$chnginfo['user_interests']."' size='25' maxlength='255'></td></tr>\n";
    if ($chnginfo['user_viewemail'] ==1) { $cuv = "checked"; } else { $cuv = ""; }
    echo "<tr><td bgcolor='$bgcolor2'>"._OPTION.":</td><td><input type='checkbox' name='chng_user_viewemail' value='1' $cuv> "._ALLOWUSERS."</td></tr>\n";
    if ($chnginfo['newsletter'] == 1) { $cnl = "checked"; } else { $cnl = ""; }
    echo "<tr><td bgcolor='$bgcolor2'>"._NEWSLETTER.":</td><td><input type='checkbox' name='chng_newsletter' value='1' $cnl> "._YES."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._SIGNATURE.":</td><td><textarea name='chng_user_sig' rows='6' cols='45'>".$chnginfo['user_sig']."</textarea></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._PASSWORD.":</td><td><input type='password' name='chng_pass' size='12' maxlength='12'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._RETYPEPASSWD.":</td><td><input type='password' name='chng_pass2' size='12' maxlength='12'> <span class='tiny'>"._FORCHANGES."</span></td></tr>\n";
    echo "<input type='hidden' name='chng_avatar' value='".$chnginfo['user_avatar']."'>\n";
    echo "<input type='hidden' name='chng_uid' value='$chng_uid'>\n";
    echo "<input type='hidden' name='old_uname' value='".$chnginfo['username']."'>\n";
    echo "<input type='hidden' name='old_email' value='".$chnginfo['user_email']."'>\n";
    echo "<input type='hidden' name='op' value='modifyUserConf'>\n";
    if (isset($query)) { echo "<input type='hidden' name='query' value='$query'>\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
    echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td></tr>\n";
    echo "</form>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    if (isset($query)) { echo "<input type='hidden' name='query' value='$query'>\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
    echo "<tr><td align='center' colspan='2'><input type='submit' value='"._CANCEL."'></td></tr>\n";
    echo "</form>\n";
    echo "</table></center>\n";
    CloseTable();
} else {
    OpenTable();
    echo "<center><strong>"._USERNOEXIST."</strong></center>\n";
    CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');

}

?>