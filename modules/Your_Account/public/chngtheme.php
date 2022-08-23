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
      Theme Management                         v1.0.2       12/14/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    global $cookie, $userinfo;
    if ((is_user()) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
        include_once(NUKE_BASE_DIR.'header.php');
        title(_THEMESELECTION);
        // OpenTable();
        // nav();
        // CloseTable();
        // echo "<br />";
        OpenTable();
        echo "<center>";
        echo "<form action=\"modules.php?name=$module_name\" method=\"post\">";
        echo "<strong>"._SELECTTHEME."</strong><br />";
/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
        echo GetThemeSelect('theme');
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
        echo "<br />";
        echo ""._THEMETEXT1."<br />";
        echo ""._THEMETEXT2."<br />";
        echo ""._THEMETEXT3."<br /><br />";
        echo "<input type=\"hidden\" name=\"user_id\" value=\"$userinfo[user_id]\">";
        echo "<input type=\"hidden\" name=\"op\" value=\"savetheme\">";
        echo "<input type=\"submit\" value=\""._SAVECHANGES."\">";
        echo "</form>";
        echo "</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        mmain($user);
    }

?>