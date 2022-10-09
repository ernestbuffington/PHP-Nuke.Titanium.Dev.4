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

    global $cookie;
    include_once(NUKE_BASE_DIR.'header.php');
    $check = $cookie[1];
    $result = $db->sql_query("SELECT user_id, username, user_password FROM ".$user_prefix."_users WHERE username='$check'");
    list($uid, $uname, $pass) = $db->sql_fetchrow($result);
    OpenTable();
    echo "<center><span class=\"option\">"._SUREDELETE."<br /><a href=\"modules.php?name=$module_name&amp;op=deleteconfirm&amp;uid=$uid&amp;code=$pass\"><strong>"._YES."</strong></a> "._OR." <a href=\"modules.php?name=$module_name\"><strong>"._NO."</strong></a></span></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

?>