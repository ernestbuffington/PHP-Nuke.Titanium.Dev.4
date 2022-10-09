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

    $pagetitle = ": "._USERADMIN." - "._FINDUSER;
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    title(""._USERADMIN." - "._FINDUSER);
    amain();
    echo "<br />\n";
    if (isset($xusername) AND !empty($xusername)) {
        $sql = "SELECT * FROM ".$user_prefix."_users WHERE username='$xusername'";
    } elseif (isset($xuser_id) AND !empty($xuser_id)) {
        $sql = "SELECT * FROM ".$user_prefix."_users WHERE user_id='$xuser_id'";
    } elseif (isset($xuser_email) AND !empty($xuser_email)) {
        $sql = "SELECT * FROM ".$user_prefix."_users WHERE user_email='$xuser_email'";
    }
    if($db->sql_numrows($db->sql_query($sql)) > 0) {
        $chnginfo = $db->sql_fetchrow($db->sql_query($sql));
        OpenTable();
        echo "<center><table border='0'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._USERID.":</td><td><strong>".$chnginfo['user_id']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td><strong>".$chnginfo['username']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NAME.":</td><td><strong>".$chnginfo['name']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><strong><a href='".$chnginfo['user_website']."' target='_blank'>".$chnginfo['user_website']."</a></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td><strong><a href='mailto:".$chnginfo['user_email']."'>".$chnginfo['user_email']."</a></strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FAKEEMAIL.":</td><td><strong>".$chnginfo['femail']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ICQ.":</td><td><strong>".$chnginfo['user_icq']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._AIM.":</td><td><strong>".$chnginfo['user_aim']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._YIM.":</td><td><strong>".$chnginfo['user_yim']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._MSNM.":</td><td><strong>".$chnginfo['user_msnm']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._LOCATION.":</td><td><strong>".$chnginfo['user_from']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._OCCUPATION.":</td><td><strong>".$chnginfo['user_occ']."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._INTERESTS.":</td><td><strong>".$chnginfo['user_interests']."</strong></td></tr>\n";
        if ($chnginfo['user_viewemail'] ==1) { $cuv = _YES; } else { $cuv = _NO; }
        echo "<tr><td bgcolor='$bgcolor2'> "._SHOWMAIL.":</td><td><strong>$cuv</strong></td></tr>\n";
        if ($chnginfo['newsletter'] == 1) { $cnl = _YES; } else { $cnl = _NO; }
        echo "<tr><td bgcolor='$bgcolor2'>"._NEWSLETTER.":</td><td><strong>$cnl</strong></td></tr>\n";
        $chnginfo[user_sig] = str_replace("\r\n", "<br />", $chnginfo['user_sig']);
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._SIGNATURE.":</td><td><strong>".$chnginfo['user_sig']."</strong></td></tr>\n";
        echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
        echo "<input type='hidden' name='op' value='modifyUser'>\n";
        echo "<input type='hidden' name='chng_uid' value='".$chnginfo['user_id']."'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._MODIFY."'></td></tr>\n";
        echo "</form>\n";
        echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._RETURN."'></td></tr>\n";
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