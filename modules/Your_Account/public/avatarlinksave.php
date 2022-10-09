<?php
/*=============================================================================== 
   PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 ================================================================================*/

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke              */
/* ============================================                                  */
/*                                                                               */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                              */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                         */
/*                                                                               */
/* Contact author: escudero@phpnuke.org.br                                       */
/* International Support Forum: http://ravenphpscripts.com/forum76.html          */
/*                                                                               */
/* This program is free software. You can redistribute it and/or modify          */
/* it under the terms of the GNU General Public License as published by          */
/* the Free Software Foundation; either version 2 of the License.                */
/*                                                                               */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion  */
/*********************************************************************************/

/*****[CHANGES]*******************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 *********************************************************************************/
if(!defined('MODULE_FILE')) die ("You can't access this file directly...");

if(!defined('CNBYA')) die('CNBYA protection');
    global $cookie, $userinfo;
	
    include_once(NUKE_BASE_DIR.'header.php');
    
	title(_YA_AVATARSUCCESS);
    
	OpenTable();
    nav();
    CloseTable();
    
	OpenTable();
    
    $direktori = $board_config['avatar_gallery_path']; 

    if (!preg_match("#https#", $avatar)):  
    $avatar="https://$avatar"; 
    endif;

    $db->sql_query("UPDATE ".$user_prefix."_users SET user_avatar='$avatar', user_avatar_type='2' WHERE username='$cookie[1]'");
    echo "<div align=\"center\"><span class=\"content\">"._YA_AVATARFOR." ".$cookie[1]." "._YA_SAVED."</span></div><br />";
    
	if (preg_match("/(https)/", $avatar)): 
      echo "<div align=\"center\">"._YA_NEWAVATAR.":<br /><img alt=\"\" src=\"$avatar\"><br />";
      echo "[ <a href=\"modules.php?name=$module_name&amp;op=edituser\">"._YA_BACKPROFILE."</a> | <a href=\"modules.php?name=$module_name\">"._YA_DONE."</a> ]</div>";
	elseif($avatar): 
      echo "<div align=\"center\">"._YA_NEWAVATAR.":<br /><img alt=\"\" src=\"$direktori/$avatar\"><br />";
      echo "[ <a href=\"modules.php?name=$module_name&amp;op=edituser\">"._YA_BACKPROFILE."</a> | <a href=\"modules.php?name=$module_name\">"._YA_DONE."</a> ]</div>";
    endif;
    
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
?>
