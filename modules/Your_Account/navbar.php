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
   die('You can\'t access this file directly...');
}

require_once("modules/Your_Account/includes/constants.php");

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if (is_user()) {
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

global $prefix, $db, $user_prefix, $ya_config, $thmcount;

// menelaos: removed because it is already called in /modules/Your_Account/includes/mainfileend.php
$ya_config = ya_get_configs();

    function menuimg($gfile) 
	{
        $ThemeSel = get_theme();
	    if (file_exists("themes/$ThemeSel/images/menu/$gfile"))
        $menuimg = "themes/$ThemeSel/images/menu/$gfile";
        else 
        $menuimg = "modules/Your_Account/images/$gfile";
        return($menuimg);
    }

    # Set TD widths
    $tds = 3;
    $handle = opendir('themes');
    
	while($file = readdir($handle)): 
	  if((!preg_match("/[\.]/",$file))) 
      $thmcount++; 
	endwhile;
    
	closedir($handle);
    if(is_active("Private_Messages")) 
    $tds++; 
    
	if(is_active("Journal")) 
    $tds++; 
    
	if(($thmcount > 1) AND ($ya_config["allowusertheme"] == 0)) 
	$tds++; 
	    
	if($articlecomm == 1) 
	$tds++; 
	    
	if($ya_config["allowuserdelete"] == 1) 
    $tds++; 
	    
	$tdwidth = (int) ((100/$tds));
    # END Set TD widths

    function nav($main_up=0) 
	{
        global $module_name, $admin, $ya_config, $thmcount, $tdwidth, $articlecomm;
        echo "<table border=\"0\" width=\"100%\" align=\"center\"><tr>\n";

        $menuimg = menuimg("info.png");
        echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=edituser\"><img src=\"$menuimg\" border=\"0\" alt=\""._CHANGEYOURINFO."\" title=\""._CHANGEYOURINFO."\"></a><br />\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=edituser\">"._ACCTCHANGE."</a>\n";
        echo "</td>\n";
        $menuimg = menuimg("home.png");
        echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=edithome\"><img src=\"$menuimg\" border=\"0\" alt=\""._CHANGEHOME."\" title=\""._CHANGEHOME."\"></a><br />\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=edithome\">"._ACCTHOME."</a>\n";
        echo "</td>\n";
        if ($articlecomm == 1):
            $menuimg = menuimg("comments.png");
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=editcomm\"><img src=\"$menuimg\" border=\"0\" alt=\""._CONFIGCOMMENTS."\" title=\""._CONFIGCOMMENTS."\"></a><br />\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=editcomm\">"._ACCTCOMMENTS."</a>\n";
            echo "</td>\n";
        endif;
        if (is_active("Private_Messages")): 
            $menuimg = menuimg("messages.png");
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Private_Messages\"><img src=\"$menuimg\" border=\"0\" alt=\""._PRIVATEMESSAGES."\" title=\""._PRIVATEMESSAGES."\"></a><br />\n";
            echo "<a href=\"modules.php?name=Private_Messages\">"._MESSAGES."</a>\n";
            echo "</td>\n";
        endif;
        if (is_active("Journal")): 
            $menuimg = menuimg("journal.png");
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Journal&amp;file=edit\"><img src=\"$menuimg\" border=\"0\" alt=\""._JOURNAL."\" title=\""._JOURNAL."\"></a><br />\n";
            echo "<a href=\"modules.php?name=Journal&amp;file=edit\">"._ACCTJOURNAL."</a>\n";
            echo "</td>\n";
        endif;
        if (($thmcount > 1) AND ($ya_config["allowusertheme"] == 0)): 
            $menuimg = menuimg("themes.png");
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=chgtheme\"><img src=\"$menuimg\" border=\"0\" alt=\""._SELECTTHETHEME."\" title=\""._SELECTTHETHEME."\"></a><br />\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=chgtheme\">"._ACCTTHEME."</a>\n";
            echo "</td>\n";
        endif;
        if ($ya_config["allowuserdelete"] == 1): 
            $menuimg = menuimg("delete.png");
            echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=delete\"><img src=\"$menuimg\" border=\"0\" alt=\""._DELETEACCT."\" height=\"48\" width=\"48\"></a><br />\n";
            echo "<a href=\"modules.php?name=Your_Account&amp;op=delete\">"._DELETEACCT."</a>\n";
            echo "</td>\n";
        endif;
        $menuimg = menuimg("exit.png");
		echo "<td width=\"$tdwidth%\" valign=\"top\" align=\"center\" class=\"content\">\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=logout\"><img src=\"$menuimg\" border=\"0\" alt=\""._LOGOUTEXIT."\" title=\""._LOGOUTEXIT."\"></a><br />\n";
        echo "<a href=\"modules.php?name=Your_Account&amp;op=logout\">"._ACCTEXIT."</a>\n";
        echo "</td>\n";
        echo "</tr></table>";
		if ($main_up != 1) 
	    echo "<br /><center>[ <a href=\"modules.php?name=Your_Account\">"._RETURNACCOUNT."</a> ]</center>\n"; 
    }
}
?>
