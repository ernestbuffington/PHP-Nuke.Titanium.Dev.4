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

redirect("modules/Forums/admin/admin_xdata_fields.php?mode=add");

   /* $pagetitle = ": "._USERADMIN." - "._ADDFILED;
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    title(_USERADMIN." - "._ADDFIELD);
    amain();
    echo "<br />\n";
    OpenTable();

    echo "<center><table border='0'>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    echo "<tr><td bgcolor='$bgcolor2'>ID</td><td bgcolor='$bgcolor2'>"._FIELDNAME."*</td><td bgcolor='$bgcolor2'>"._FIELDVALUE."**</td><td bgcolor='$bgcolor2'>"._FIELDSIZE."</td><td bgcolor='$bgcolor2'>"._FIELDNEED."</td><td bgcolor='$bgcolor2'>"._FIELDVPOS."</td><td bgcolor='$bgcolor2'>"._YA_PUBLIC."</td><td bgcolor='$bgcolor2'>"._FIELDDEL."</td></tr>\n";
    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field ORDER BY pos");
    while ($sqlvalue = $db->sql_fetchrow($result)) {
    $t = $sqlvalue[fid];
    echo "<tr><td bgcolor='$bgcolor2'>$sqlvalue[fid]</td><td bgcolor='$bgcolor2'><input type='text' name='field_name[$t]' value='$sqlvalue[name]' size='20' maxlength='20'></td><td bgcolor='$bgcolor2'><input type='text' name='field_value[$t]' value='$sqlvalue[value]' size='20' maxlength=$sqlvalue[size]></td><td bgcolor='$bgcolor2'><input type='text' name='field_size[$t]' value='$sqlvalue[size]' size='4' maxlength='4'></td><td bgcolor='$bgcolor2'>";
    echo "<select name='field_need[$t]'>\n";
        if ($sqlvalue['need'] == 1) $sel = "selected"; else $sel = "";
    echo "<option value=1 $sel>"._NEED1."</option>\n";
        if ($sqlvalue['need'] == 2) $sel = "selected"; else $sel = "";
    echo "<option value=2 $sel>"._NEED2."</option>\n";
        if ($sqlvalue['need'] == 3) $sel = "selected"; else $sel = "";
    echo "<option value=3 $sel>"._NEED3."</option>\n";
        if ($sqlvalue['need'] == 0) $sel = "selected"; else $sel = "";
    echo "<option value=0 $sel>"._NEED0."</option>\n";
    echo "</select>";
    echo "</td><td bgcolor='$bgcolor2'><input type='text' name='field_pos[$t]' value='$sqlvalue[pos]' size='3' maxlength='3'></td>\n";
    echo "<td bgcolor='$bgcolor2'><select name='field_public[$t]'>\n";
        if ($sqlvalue['public'] == '1') $sel = "selected"; else $sel = "";
    echo "<option value=1 $sel>"._YA_PUBLIC."</option>\n";
        if ($sqlvalue['public'] == '0') $sel = "selected"; else $sel = "";
    echo "<option value=0 $sel>"._YA_PRIVATE."</option>\n";
    echo "</select></td>\n";
    echo "<td bgcolor='$bgcolor2'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=delField&amp;fid=$t'>"._FIELDDEL."</a></td></tr>\n";
    }
    echo "<tr><td bgcolor='$bgcolor2'>&nbsp;</td><td bgcolor='$bgcolor2'><input type='text' name='mfield_name' size='20' maxlength='20'></td><td bgcolor='$bgcolor2'><input type='text' name='mfield_value' size='20' maxlength='255'></td><td bgcolor='$bgcolor2'><input type='text' name='mfield_size' size='4' maxlength='4'></td><td bgcolor='$bgcolor2'>";
    echo "<select name='mfield_need'>\n";
        echo "<option value='1' selected>"._NEED1."</option>\n";
        echo "<option value='2'>"._NEED2."</option>\n";
        echo "<option value='3'>"._NEED3."</option>\n";
        echo "<option value='0'>"._NEED0."</option>\n";
    echo "</select>";
    echo "</td><td bgcolor='$bgcolor2'><input type='text' name='mfield_pos' size=3 maxlength='3'></td>\n";
    echo "<td bgcolor='$bgcolor2'><select name='mfield__public'>\n";
        echo "<option value=1 selected>"._YA_PUBLIC."</option>\n";
        echo "<option value=0 >"._YA_PRIVATE."</option>\n";
    echo "</select></td>\n";
    echo "<td bgcolor='$bgcolor2'>&nbsp;</td></tr>\n";

    echo "<tr><td align='center' colspan='8'><br />";
        OpenTable();
        echo "</td><td align=\"center\">"._NAMECOMENT."<br />"._VALUECOMENT."</td><td>\n";
        CloseTable();
    echo "</td></tr><tr><td align='center' colspan='8'>";
    echo "<input type='submit' value='"._ADDFIELD."'>\n";
    echo "<input type='hidden' name='op' value='saveaddField'>\n";
    echo "</td></tr></form>\n";
//    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    echo "<tr><td align='center' colspan='8'><input type='submit' value='"._CANCEL."'></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');*/

}

?>