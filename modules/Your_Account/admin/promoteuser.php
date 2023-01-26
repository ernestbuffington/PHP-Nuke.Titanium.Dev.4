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

    if (is_mod_admin('super')) {

    list($uname, $rname, $email, $site, $upass) = $db->sql_fetchrow($db->sql_query("SELECT username, name, user_email, user_website, user_password FROM ".$user_prefix."_users WHERE user_id='$chng_uid'"));
    $pagetitle = ": "._USERADMIN." - "._PROMOTEUSER;
    include_once(NUKE_BASE_DIR.'header.php');
    title(_USERADMIN." - "._PROMOTEUSER);
    amain();
    echo "<br />\n";
if ($Version_Num >= 7.5) { 
    OpenTable();
    echo "<center><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
    echo "<input type='hidden' name='op' value='promoteUserConf'>\n";
    echo "<tr><td align=center>"._SURE2PROMOTE." <strong>$uname<i>($chng_uid)</i></strong>?</td></tr>\n";
    echo "<tr><td><table border='0'>";
    echo "<tr><td bgcolor='$bgcolor2'>"._NAME.":</td><td colspan='3'><input type='text' name='add_name' size='30' maxlength='50' value='$rname'> <span class='tiny'>"._REQUIREDNOCHANGE."</span></td></tr>";
    echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td colspan='3'><input type='text' name='add_aid' size='30' maxlength='30' value='$uname'> <span class='tiny'>"._REQUIRED."</span></td></tr>";
    echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td colspan='3'><input type='text' name='add_email' size='30' maxlength='60' value='$email'> <span class='tiny'>"._REQUIRED."</span></td></tr>";
    echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td colspan='3'><input type='text' name='add_url' size='30' maxlength='60' value='$site'></td></tr>";
    //[vecino398(curt)]  www.vecino398.com -Modification- 
    echo "<tr><td bgcolor='$bgcolor2' valign='top'>" . _PERMISSIONS . ":</td>"; 
    $result = $db->sql_query("SELECT mid, title FROM ".$prefix."_modules ORDER BY title ASC"); 
    while ($row = $db->sql_fetchrow($result)) { 
        $title = str_replace("_", " ", $row['title']); 
        if (file_exists("modules/$row[title]/admin/index.php") AND file_exists("modules/$row[title]/admin/links.php") AND file_exists("modules/$row[title]/admin/case.php")) { 
            echo "<td><input type=\"checkbox\" name=\"auth_modules[]\" value=\"$row[mid]\"> $title</td>"; 
            if ($a == 2) { 
                echo "</tr><tr><td>&nbsp;</td>"; 
                $a = 0; 
            } else { 
                $a++; 
            } 
        } 
    } 
    echo "</tr><tr><td>&nbsp;</td>" 
        ."<td><input type=\"checkbox\" name=\"add_radminsuper\" value=\"1\"> <strong>" . _SUPERUSER . "</strong></td>" 
        ."</tr>"; 
/////////////////////END/////////////////////////////
    echo "<input type='hidden' name='add_password' value='$upass'>";
    echo "</table></td></tr>";
    echo "<tr><td align=center><input type='submit' value='"._PROMOTEUSER."'></td><tr>\n";
    echo "</form>\n";
    echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
    if (isset($query)) { echo "<input type='hidden' name='query' value='$query'>\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
    echo "<input type='hidden' name='chng_uid' value='$chng_uid'>\n";
    echo "<tr><td align='center'><input type='submit' value='"._CANCEL."'></td></tr>\n";
    echo "</form>\n";
    echo "</table></center>\n";
    CloseTable();
} elseif($Version_Num == 7.4) { 
 OpenTable();
    echo "<center><span class=\"option\"><strong>" . _SURE2PROMOTE . "</strong></span></center>"
    ."<form action=\"modules.php?name=$module_name&amp;file=admin\" method=\"post\">"
    ."<table border=\"0\">"
    ."<tr><td>" . _NAME . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_name\" size=\"30\" maxlength=\"50\" value='$rname'> <span class=\"tiny\">" . _REQUIREDNOCHANGE . "</span></td></tr>"
    ."<tr><td>" . _NICKNAME . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_aid\" size=\"30\" maxlength=\"30\" value='$uname'> <span class=\"tiny\">" . _REQUIRED . "</span></td></tr>"
    ."<tr><td>" . _EMAIL . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_email\" size=\"30\" maxlength=\"60\" value='$email'> <span class=\"tiny\">" . _REQUIRED . "</span></td></tr>"
    ."<tr><td>" . _URL . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_url\" size=\"30\" maxlength=\"60\" value='$site'></td></tr>";
if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
    echo "<input type='hidden' name='op' value='promoteUserConf'>\n";
    if ($multilingual == 1) {
    echo "<tr><td>" . _LANGUAGE . ":</td><td colspan=\"3\">"
        ."<select name=\"add_admlanguage\">";
    $handle=opendir('language');
    while ($file = readdir($handle)) {
        if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
            $langFound = $matches[1];
            $languageslist .= "$langFound ";
        }
    }
    closedir($handle);
    $languageslist = explode(" ", $languageslist);
    sort($languageslist);
    for ($i=0; $i < count($languageslist); $i++) {
        if($languageslist[$i]!="") {
        echo "<option value=\"$languageslist[$i]\" ";
        if($languageslist[$i]==$language) echo "selected";
        echo ">".ucfirst($languageslist[$i])."</option>\n";
        }
    }
    echo "<option value=\"\">" . _ALL . "</option></select></td></tr>";
    } else {
    echo "<input type=\"hidden\" name=\"add_admlanguage\" value=\"\">";
    }
    echo "<tr><td>" . _PERMISSIONS . ":</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminarticle\" value=\"1\"> " . _BLOGS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radmintopic\" value=\"1\"> " . _TOPICS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminuser\" value=\"1\"> " . _USERS . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminsurvey\" value=\"1\"> " . _SURVEYS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminlink\" value=\"1\"> " . _WEBLINKS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminfaq\" value=\"1\"> " . _FAQ . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radmindownload\" value=\"1\"> " . _DOWNLOAD . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminreviews\" value=\"1\"> " . _REVIEWS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminnewsletter\" value=\"1\"> " . _NEWSLETTER . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminforum\" value=\"1\"> " . _BBFORUM . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radmincontent\" value=\"1\"> " . _CONTENT . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminency\" value=\"1\"> " . _ENCYCLOPEDIA . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminsuper\" value=\"1\"> <strong>" . _SUPERUSER . "</strong></td>"
    ."</tr>"
        ."<input type='hidden' name='add_password' value='$upass'>"
    ."<tr><td><input type=\"submit\" value=\"" . _PROMOTEUSER . "\"></td></tr>"
    ."</table></form>";
    CloseTable();
} else { # 7.3 to?
OpenTable();
    echo "<center><span class=\"option\"><strong>" . _SURE2PROMOTE . "</strong></span></center>"
    ."<form action=\"modules.php?name=$module_name&amp;file=admin\" method=\"post\">"
    ."<table border=\"0\">"
    ."<tr><td>" . _NAME . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_name\" size=\"30\" maxlength=\"50\"> <span class=\"tiny\">" . _REQUIREDNOCHANGE . "</span></td></tr>"
    ."<tr><td>" . _NICKNAME . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_aid\" size=\"30\" maxlength=\"30\"> <span class=\"tiny\">" . _REQUIRED . "</span></td></tr>"
    ."<tr><td>" . _EMAIL . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_email\" size=\"30\" maxlength=\"60\"> <span class=\"tiny\">" . _REQUIRED . "</span></td></tr>"
    ."<tr><td>" . _URL . ":</td>"
    ."<td colspan=\"3\"><input type=\"text\" name=\"add_url\" size=\"30\" maxlength=\"60\"></td></tr>";
if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop'>\n"; }
    echo "<input type='hidden' name='op' value='promoteUserConf'>\n";
    if ($multilingual == 1) {
    echo "<tr><td>" . _LANGUAGE . ":</td><td colspan=\"3\">"
        ."<select name=\"add_admlanguage\">";
    $handle=opendir('language');
    while ($file = readdir($handle)) {
        if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
            $langFound = $matches[1];
            $languageslist .= "$langFound ";
        }
    }
    closedir($handle);
    $languageslist = explode(" ", $languageslist);
    sort($languageslist);
    for ($i=0; $i < count($languageslist); $i++) {
        if($languageslist[$i]!="") {
        echo "<option value=\"$languageslist[$i]\" ";
        if($languageslist[$i]==$language) echo "selected";
        echo ">".ucfirst($languageslist[$i])."</option>\n";
        }
    }
    echo "<option value=\"\">" . _ALL . "</option></select></td></tr>";
    } else {
    echo "<input type=\"hidden\" name=\"add_admlanguage\" value=\"\">";
    }
    echo "<tr><td>" . _PERMISSIONS . ":</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminarticle\" value=\"1\"> " . _BLOGS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radmintopic\" value=\"1\"> " . _TOPICS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminuser\" value=\"1\"> " . _USERS . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminsurvey\" value=\"1\"> " . _SURVEYS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminsection\" value=\"1\"> " . _SECTIONS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminlink\" value=\"1\"> " . _WEBLINKS . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminephem\" value=\"1\"> " . _EPHEMERIDS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminfaq\" value=\"1\"> " . _FAQ . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radmindownload\" value=\"1\"> " . _DOWNLOAD . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminreviews\" value=\"1\"> " . _REVIEWS . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminnewsletter\" value=\"1\"> " . _NEWSLETTER . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminforum\" value=\"1\"> " . _BBFORUM . "</td>"
    ."</tr><tr><td>&nbsp;</td>"
    ."<td><input type=\"checkbox\" name=\"add_radmincontent\" value=\"1\"> " . _CONTENT . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminency\" value=\"1\"> " . _ENCYCLOPEDIA . "</td>"
    ."<td><input type=\"checkbox\" name=\"add_radminsuper\" value=\"1\"> <strong>" . _SUPERUSER . "</strong></td>"
    ."</tr>"
        ."<input type='hidden' name='add_password' value='$upass'>"
    ."<tr><td><input type=\"submit\" value=\"" . _PROMOTEUSER . "\"></td></tr>"
    ."</table></form>";
    CloseTable();
}
    include_once(NUKE_BASE_DIR.'footer.php');

} else {
    redirect("../../../index.php");
    die ();
}

?>