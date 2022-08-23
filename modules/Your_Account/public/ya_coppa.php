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

/********************************************************/
/* COPPA Pluggin sixonetonoffun http://www.netflake.com */
/* Minimal basic COPPA Compliance mod for CNBYA         */
/********************************************************/

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

$coppa=intval($_POST['coppa_yes']);
if (isset($_POST['coppa_yes']) AND $ya_config['coppa'] == intval(1)) {
    $coppa=intval($_POST['coppa_yes']); 
    if($coppa != intval(1)){
        include_once(NUKE_BASE_DIR.'header.php');
        title(_USERAPPLOGIN);
        OpenTable();
        echo "<img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\" alt=\"\"><center>"._YACOPPA2."</center></td>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\">"._YACOPPA1."</center><P>\n";
        echo "<font color=\"#FF3333\">"._YACOPPA4."</font>\n";
        echo "<font color=\"#FF3333\">"._YACOPPAFAX."</font>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

  $sel1 = "checked";
  $sel2 = "";
  include_once(NUKE_BASE_DIR.'header.php');
  title(_USERAPPLOGIN);
  OpenTable();
  echo "<img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\" alt=\"\"><center>"._YACOPPA2."</center></td>\n";
  CloseTable();
  echo "<br />";
OpenTable();
  OpenTable();
  echo "<form name=\"coppa1\" action=\"modules.php?name=$module_name&amp;op=new_user\" method=\"POST\">\n";
  echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\"><tr>\n";
  echo "<td align=\"center\" colspan=\"2\" class=\"title\">"._YACOPPA1."<P></td></tr>\n";
  echo "<tr><td align=\"center\" colspan=\"2\" ><p class=\"content\">"._YACOPPA3."<P></td></tr>\n";
  echo "<tr><td align=\"right\">"._YES."&nbsp;</td><td align=\"left\"><input type=\"radio\" name=\"coppa_yes\" value='1' $sel2></td></tr>\n";
  echo "<tr><td align=\"right\">"._NO."&nbsp;</td><td align=\"left\"><input type=\"radio\" name=\"coppa_yes\" value='0' $sel1></td></tr>\n";
  echo "<tr><td align=\"center\" colspan=\"2\"><br /><input type=\"submit\" value='"._YA_CONTINUE."'>\n";
  echo "</td></tr>";
  echo "</table></form>\n";
  CloseTable();
CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');

?>