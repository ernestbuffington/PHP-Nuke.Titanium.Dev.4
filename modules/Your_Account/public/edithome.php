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
if (!defined('MODULE_FILE')) 
exit ("You can't access this file directly...");

if (!defined('CNBYA')) 
exit('CNBYA protection');

    global $cookie, $userinfo;
    if((is_user()) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])):
        include_once(NUKE_BASE_DIR.'header.php');
        title(_HOMECONFIG);
        if(empty($userinfo['theme'])) { $userinfo['theme'] = "$Default_Theme"; }
        OpenTable();
        echo "<form action=\"modules.php?name=$module_name\" method=\"post\">";
        if ($user_news == 1):
            echo "<strong>"._BLOGPOSTSINHOME."</strong> "._MAX127." ";
            echo "<input type=\"text\" name=\"storynum\" size=\"4\" maxlength=\"3\" value=\"$userinfo[storynum]\">";
            echo "<br /><br />";
        else:
            echo "<input type=\"hidden\" name=\"storynum\" value=\"$storyhome\">";
        endif;
        echo "<input type=\"hidden\" name=\"username\" value=\"$userinfo[username]\">";
        echo "<input type=\"hidden\" name=\"user_id\" value=\"$userinfo[user_id]\">";
        echo "<input type=\"hidden\" name=\"op\" value=\"savehome\">";
        echo "<input type=\"submit\" value=\""._SAVECHANGES."\">";
        echo "</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    else: 
        mmain($user);
    endif;
?>
