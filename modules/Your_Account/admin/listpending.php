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

    $pagetitle = ": "._USERADMIN." - "._WAITINGUSERS;
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    title(_USERADMIN.": "._WAITINGUSERS);
    amain();
    echo "<br />\n";
    OpenTable();
    if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$ya_config['perpage'];
    $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users_temp"));
    echo "<table style='margin:auto' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
    echo "<tr bgcolor='$bgcolor2'>\n<td><strong>"._USERNAME." ("._USERID.")</strong></td>\n";
    echo "<td align='center'><strong>"._UREALNAME."</strong></td>\n";
    echo "<td align='center'><strong>"._EMAIL."</strong></td>\n";
    echo "<td align='center'><strong>"._REGDATE."</strong></td>\n";
    echo "<td align='center'><strong>"._FUNCTIONS."</strong></td>\n</tr>\n";
    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_users_temp ORDER BY username LIMIT $min,".$ya_config['perpage']."");
    while($chnginfo = $db->sql_fetchrow($result)) {
        echo "<tr bgcolor='$bgcolor1'>\n<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
        echo "<input type='hidden' name='min' value='$min'>\n";
        echo "<input type='hidden' name='xop' value='$op'>\n";
        echo "<input type='hidden' name='apr_uid' value='".$chnginfo['user_id']."'>\n";
        echo "<input type='hidden' name='act_uid' value='".$chnginfo['user_id']."'>\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."'>\n";
        echo "<td>".$chnginfo['username']." (".$chnginfo['user_id'].")</td>\n";
        echo "<td align='center'>".$chnginfo['realname']."</td>\n";
        echo "<td align='center'>".$chnginfo['user_email']."</td>\n";
        echo "<td align='center'>".$chnginfo['user_regdate']."</td>\n";
        echo "<td align='center'><select name='op'>\n";
        echo "<option value='detailsTemp' selected='selected'>"._DETUSER."</option>\n";
        echo "<option value='approveUser'>"._YA_APPROVE."</option>\n";
        echo "<option value='activateUser'>"._YA_ACTIVATE."</option>\n";
        echo "<option value='modifyTemp'>"._MODIFY."</option>\n";
        echo "<option value='denyUser'>"._DENY."</option>\n";
        echo "<option value='resendMail'>"._RESEND."</option>\n";
        echo "</select><input type='submit' value='"._OK."'>\n";
        echo "</td></form></tr>\n";
    }
    echo "";
    echo "</td></table>\n";
    echo "<br />\n";
    yapagenums($op, $totalselected, $ya_config['perpage'], $max, "", "", "", "");
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

?>