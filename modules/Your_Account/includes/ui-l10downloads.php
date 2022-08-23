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

// Last 10 Download Links Approved

// menelaos: changed these routines to fist check if the database table exist
$checktable = $db->sql_fetchrow($db->sql_query("SHOW TABLES LIKE '".$prefix."_downloads_downloads'"));
if ($checktable == 1) {
    if($checkrow['Msg_type']!="error") {
        $result9 = $db->sql_query("SELECT lid, title, date FROM ".$prefix."_downloads_downloads where submitter='$usrinfo[username]' order by date DESC limit 0,10");
        if (($db->sql_numrows($result9) > 0)) {
            echo "<br />";
            OpenTable();
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $usrcolor = UsernameColor($usrinfo['username']);
            echo "<strong>".$usrcolor."'s "._LAST10DOWNLOAD.":</strong><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            while(list($lid, $title, $date) = $db->sql_fetchrow($result9)) {
                echo "<li><a href=\"modules.php?name=Downloads&amp;op=getit&amp;lid=$lid\">$title</a> ($lid) - $date<br />";
            }
            CloseTable();
        }
    }
} 

?>