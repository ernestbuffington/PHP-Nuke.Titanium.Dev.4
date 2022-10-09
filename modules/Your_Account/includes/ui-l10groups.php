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
      Group Colors                             v1.0.0       10/20/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

// Group Memberships
$result = $db->sql_query("SELECT ug.group_id, g.group_name FROM ".$prefix."_bbuser_group ug INNER JOIN ".$prefix."_bbgroups g ON (g.group_id = ug.group_id AND g.group_single_user = 0) WHERE ug.user_pending = 0 AND ug.user_id = ".$usrinfo['user_id']);
if ($db->sql_numrows($result) > 0) {
    echo "<br />";
    OpenTable();
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $usrcolor = UsernameColor($usrinfo['username']);
    echo "<strong>".$usrcolor."'s "._MEMBERGROUPS.":</strong><br />\n";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    while(list($gid, $gname) = $db->sql_fetchrow($result)) {
/*****[BEGIN]******************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/
        $grpcolor = GroupColor($gname);
        echo "<li><a href=\"modules.php?name=Groups&amp;g=$gid\">".$grpcolor."</a>";
/*****[END]********************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/
        if(is_mod_admin($module_name)) { echo "&nbsp;($gid)"; }
    }
    CloseTable();
}

?>