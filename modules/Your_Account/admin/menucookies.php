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

    $pagetitle = ": "._COOKIECONFIG;
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    title(_COOKIECONFIG);
    amain();
    echo "<br />\n";
    OpenTable();
    echo "<center><table style='margin:auto' width=\"100%\" border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<tr><form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    echo "<td align='center' bgcolor='$bgcolor3' colspan='2'><strong>"._YA_COOKIECONFIG."</strong></td></tr>\n";
    echo "<tr><td align='center' colspan='2'>&nbsp;</td></tr>\n";
    
    // menelaos: enables the cookiecheck routines to see if the users browser is cookieenabled
    echo "<tr><td align='right' bgcolor='$bgcolor2' valign='top'>"._COOKIECHECKNOTE1."</td><td>\n";
    if ($ya_config['cookiecheck']==0) { $ck1 = ""; $ck2 = " checked"; } else { $ck1 = " checked"; $ck2 = ""; }
    echo "<input type='radio' name='xcookiecheck' value='1'$ck1>"._YES." &nbsp;";
    echo "<input type='radio' name='xcookiecheck' value='0'$ck2>"._NO." &nbsp;("._COOKIECHECKNOTE2.")</td></tr>\n";

    // menelaos: enables admins to enable or disable the option for users to delete their cookies
    echo "<tr><td align='right' bgcolor='$bgcolor2' valign='top'>"._COOKIECLEANERNOTE1."</td><td>\n";
    if ($ya_config['cookiecleaner']==0) { $ck1 = ""; $ck2 = " checked"; } else { $ck1 = " checked"; $ck2 = ""; }
    echo "<input type='radio' name='xcookiecleaner' value='1'$ck1>"._YES." &nbsp;";
    echo "<input type='radio' name='xcookiecleaner' value='0'$ck2>"._NO." &nbsp;("._COOKIECLEANERNOTE2.")</td></tr>\n";

    echo "<tr><td align='right' bgcolor='$bgcolor2' valign='top'>"._COOKIETIMELIFE."</td><td><select name='xcookietimelife'>\n";
    echo "<option value='-'"; if($ya_config['cookietimelife']=='-') {echo " selected";} echo ">- "._YA_COOKIELOGOUTPAG."</option>\n";
    echo "<option value='0'"; if($ya_config['cookietimelife']=='0') {echo " selected";} echo ">0 "._YA_COOKIEAUTOLOGOUT."</option>\n";
    echo "<option value='30'"; if($ya_config['cookietimelife']==30) {echo " selected";} echo ">30 "._YA_SECONDS."</option>";
    echo "<option value='60'"; if($ya_config['cookietimelife']==60) {echo " selected";} echo ">1 "._YA_MINUTE."</option>";
    echo "<option value='300'"; if($ya_config['cookietimelife']==300) {echo " selected";} echo ">5 "._YA_MINUTES."</option>";
    echo "<option value='900'"; if($ya_config['cookietimelife']==900) {echo " selected";} echo ">15 "._YA_MINUTES."</option>";
    echo "<option value='1800'"; if($ya_config['cookietimelife']==1800) {echo " selected";} echo ">30 "._YA_MINUTES."</option>";
    echo "<option value='2700'"; if($ya_config['cookietimelife']==2700) {echo " selected";} echo ">45 "._YA_MINUTES."</option>";
    echo "<option value='3600'"; if($ya_config['cookietimelife']==3600) {echo " selected";} echo ">1 "._YA_HOUR."</option>";
    echo "<option value='7200'"; if($ya_config['cookietimelife']==7200) {echo " selected";} echo ">2 "._YA_HOURS."</option>"; 
    echo "<option value='10800'"; if($ya_config['cookietimelife']==10800) {echo " selected";} echo ">3 "._YA_HOURS."</option>";
    echo "<option value='14400'"; if($ya_config['cookietimelife']==14400) {echo " selected";} echo ">4 "._YA_HOURS."</option>";
    echo "<option value='18000'"; if($ya_config['cookietimelife']==18000) {echo " selected";} echo ">5 "._YA_HOURS."</option>";
    echo "<option value='36000'"; if($ya_config['cookietimelife']==36000) {echo " selected";} echo ">10 "._YA_HOURS."</option>";
    echo "<option value='72000'"; if($ya_config['cookietimelife']==72000) {echo " selected";} echo ">20 "._YA_HOURS."</option>";
    echo "<option value='86400'"; if($ya_config['cookietimelife']==86400) {echo " selected";} echo ">1 "._YA_DAY."</option>";
    echo "<option value='172800'"; if($ya_config['cookietimelife']==172800) {echo " selected";} echo ">2 "._YA_DAYS."</option>";
    echo "<option value='259200'"; if($ya_config['cookietimelife']==259200) {echo " selected";} echo ">3 "._YA_DAYS."</option>";
    echo "<option value='345600'"; if($ya_config['cookietimelife']==345600) {echo " selected";} echo ">4 "._YA_DAYS."</option>";
    echo "<option value='432000'"; if($ya_config['cookietimelife']==432000) {echo " selected";} echo ">5 "._YA_DAYS."</option>"; 
    echo "<option value='518400'"; if($ya_config['cookietimelife']==518400) {echo " selected";} echo ">6 "._YA_DAYS."</option>";
    echo "<option value='604800'"; if($ya_config['cookietimelife']==604800) {echo " selected";} echo ">1 "._YA_WEEK."</option>";
    echo "<option value='1209600'"; if($ya_config['cookietimelife']==1209600) {echo " selected";} echo ">2 "._YA_WEEKS."</option>";
    echo "<option value='1814400'"; if($ya_config['cookietimelife']==1814400){echo " selected";} echo ">3 "._YA_WEEKS."</option>";
    echo "<option value='2592000'"; if($ya_config['cookietimelife']==2592000) {echo " selected";} echo ">1 "._YA_MONTH."</option>";
    for ($i = 2; $i<=12; $i++) {
    $k = $i * 2592000;
    echo "<option value=$k"; if ($ya_config['cookietimelife'] == $k) { echo " selected"; } echo">$i "._YA_MONTHS."</option>";
    }
    echo "</select><br />("._COOKIETIMELIFENOTE.")</td></tr>\n";

    echo "<tr><td align='right' bgcolor='$bgcolor2'>"._COOKIEPATH."<br />("._COOKIEPATHNOTE1.")</td>\n<td>";
    echo "<input type='text' name='xcookiepath' size='39' value='".$ya_config['cookiepath']."'><br />("._COOKIEPATHNOTE2.")</td></tr>\n";

    echo "<tr><td align='right' bgcolor='$bgcolor2' valign='top'>"._COOKIEINACTIVITY."</td><td><select name='xcookieinactivity'>\n";
    echo "<option value='-'"; if ($ya_config['cookieinactivity'] == '-') { echo " selected"; }    echo ">- "._YA_COOKIEINACTNOTUSER."</option>\n";
    echo "<option value='0'"; if ($ya_config['cookieinactivity'] == '0') { echo " selected"; }    echo ">0 "._YA_COOKIEDELCOOKIE."</option>\n";
    echo "<option value='30'"; if ($ya_config['cookieinactivity'] == 30) { echo " selected"; } echo">30 "._YA_SECONDS."</option>";
    echo "<option value='60'"; if ($ya_config['cookieinactivity'] == 60) { echo " selected"; } echo">1 "._YA_MINUTE."</option>";
    echo "<option value='120'"; if ($ya_config['cookieinactivity'] == 120) { echo " selected"; } echo">2 "._YA_MINUTES."</option>";
    echo "<option value='180'"; if ($ya_config['cookieinactivity'] == 180) { echo " selected"; } echo">3 "._YA_MINUTES."</option>";
    echo "<option value='240'"; if ($ya_config['cookieinactivity'] == 240) { echo " selected"; } echo">4 "._YA_MINUTES."</option>";

    echo "<option value='300'"; if ($ya_config['cookieinactivity'] == 300) { echo " selected"; } echo">5 "._YA_MINUTES."</option>";
    echo "<option value='900'"; if ($ya_config['cookieinactivity'] == 900) { echo " selected"; } echo">15 "._YA_MINUTES."</option>";
    echo "<option value='1800'"; if ($ya_config['cookieinactivity'] == 1800) { echo " selected"; } echo">30 "._YA_MINUTES."</option>";
    echo "<option value='2700'"; if ($ya_config['cookieinactivity'] == 2700) { echo " selected"; } echo">45 "._YA_MINUTES."</option>";
    echo "<option value='3600'"; if ($ya_config['cookieinactivity'] == 3600) { echo " selected"; } echo">1 "._YA_HOUR."</option>";
    echo "</select></td></tr>\n";

    echo "<input type='hidden' name='op' value='CookieConfigSave'>";
    echo "<tr><td align='center' colspan='2'>&nbsp;</td></tr>\n";
    echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td>";
    echo "</tr></form></table></center>";
    echo "<br />";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

?>