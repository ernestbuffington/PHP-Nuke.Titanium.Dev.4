<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

$rp = strtolower(str_replace ('index.php', '', realpath('index.php')));
include_once(NUKE_BASE_DIR.'header.php');
$ip_sets = abget_configs();
OpenTable();
OpenMenu(_AB_ADMINISTRATION);
mastermenu();
CarryMenu();
blankmenu();
CloseMenu();
CloseTable();

OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABMainSave" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" colspan="2"><strong>'._AB_GENERALSETTINGS.'</strong></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_078).' '._AB_SHOWRIGHT.':</td>'."\n";
echo '<td><select name="xshow_right">'."\n";
$selshow1 = $selshow2 = "";
if($ip_sets['show_right']==0) { $selshow1 = ' selected="selected"'; } else { $selshow2 = ' selected="selected"'; }
echo '<option value="0"'.$selshow1.'>'._AB_NO.'</option>'."\n";
echo '<option value="1"'.$selshow2.'>'._AB_YES.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_114).' '._AB_TESTSWITCH.':</td>'."\n";
$seltest1 = $seltest2 = "";
if($ip_sets['test_switch'] == 1) { $seltest2 = ' selected="selected"'; } else { $seltest1 = ' selected="selected"'; }
echo '<td><select name="xtest_switch">'."\n";
echo '<option value="0"'.$seltest1.'>'._AB_NO.'</option>'."\n";
echo '<option value="1"'.$seltest2.'>'._AB_YES.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_048).' '._AB_DISABLESWITCH.':</td>'."\n";
$seldable1 = $seldable2 = "";
if($ip_sets['disable_switch'] == 1) { $seldable2 = ' selected="selected"'; } else { $seldable1 = ' selected="selected"'; }
echo '<td><select name="xdisable_switch">'."\n";
echo '<option value="0"'.$seldable1.'>'._AB_ENABLED.'</option>'."\n";
echo '<option value="1"'.$seldable2.'>'._AB_DISABLED.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_003).' '._AB_SITESWITCH.':</td>'."\n";
echo '<td><select name="xsite_switch">'."\n";
$sel1 = $sel2 = "";
if($ip_sets['site_switch']==1) { $sel2 = ' selected="selected"'; } else { $sel1 = ' selected="selected"'; }
echo '<option value="0"'.$sel1.'>'._AB_SITEENABLED.'</option>'."\n";
echo '<option value="1"'.$sel2.'>'._AB_SITEDISABLED.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_004).' '._AB_TEMPLATE.':</td>'."\n";
echo '<td><select name="xsite_reason">'."\n";
$templatedir = dir(NUKE_INCLUDE_DIR.'nukesentinel/abuse');
$templatelist = "";
while($func=$templatedir->read()) {
  if(substr($func, 0, 6) == "admin_") {
    $templatelist .= "$func ";
  }
}
closedir($templatedir->handle);
$templatelist = explode(" ", $templatelist);
sort($templatelist);
for($i=0; $i < sizeof($templatelist); $i++) {
  if($templatelist[$i]!="") {
    $bl = str_replace("admin_","",$templatelist[$i]);
    $bl = str_replace(".tpl","",$bl);
    $bl = str_replace("_"," ",$bl);
    echo '<option';
    if($templatelist[$i]==$ip_sets['site_reason']) { echo ' selected="selected"'; }
    echo ' value="'.$templatelist[$i].'">'.ucfirst($bl).'</option>'."\n";
  }
}
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_068).' '._AB_HELPSWITCH.':</td>'."\n";
$selhelp1 = $selhelp2 = "";
if($ip_sets['help_switch'] == 1) { $selhelp2 = ' selected="selected"'; } else { $selhelp1 = ' selected="selected"'; }
echo '<td><select name="xhelp_switch">'."\n";
echo '<option value="0"'.$selhelp1.'>'._AB_ONMOUSEOVER.'</option>'."\n";
echo '<option value="1"'.$selhelp2.'>'._AB_ONMOUSECLICK.'</option>'."\n";
echo '</select></td></tr>'."\n";
$seldns1 = $seldns2 = "";
echo '<tr><td valign="top">'.help_img(_AB_HELP_086).' '._AB_IPLOOKUPSITE.':</td>'."\n";



if(stristr($ip_sets['lookup_link'], "dnsquery.org/")) { $seldns1 = ' selected="selected"'; } elseif(stristr($ip_sets['lookup_link'], "ipchecking.com/")) { $seldns2 = ' selected="selected"'; } else { $seldns3 = ' selected="selected"'; }



echo '<td><select name="xlookup_link">'."\n";
echo '<option value="https://dnsquery.org/ipwhois/"'.$seldns1.'>'._AB_SEL1.'</option>"'."\n";
echo '<option value="http://www.ipchecking.com/?ip="'.$seldns2.'>'._AB_SEL2.'</option>'."\n";
echo '<option value="'.$admin_file.'.php?op=ABIpCheck&domain="'.$seldns3.'>'._AB_SEL3.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_047).' '._AB_FORCENUKEURL.':</td>'."\n";
echo '<td><select name="xforce_nukeurl">'."\n";
$selforce1 = $selforce2 = "";
if($ip_sets['force_nukeurl']==0) { $selforce1 = ' selected="selected"'; } else { $selforce2 = ' selected="selected"'; }
echo '<option value="0"'.$selforce1.'>'._AB_NO.'</option>'."\n";
echo '<option value="1"'.$selforce2.'>'._AB_YES.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_118).' '._AB_PAGEDELAY.':</td>'."\n";
echo '<td><select name="xpage_delay">'."\n";
$i=1;
while($i<=10) {
  echo '<option value="'.$i.'"';
  if($ip_sets['page_delay']==$i) { echo ' selected="selected"'; }
  echo '>'.$i.'</option>'."\n";
  $i++;
}
echo '</select> '._AB_INSECONDS.'</td></tr>'."\n";

echo '<tr><td valign="top">'.help_img(_AB_HELP_072).' '._AB_FLOODDELAY.':</td>'."\n";
echo '<td><select name="xflood_delay">'."\n";
$i=1;
while($i<=5) {
  echo '<option value="'.$i.'"';
  if($ip_sets['flood_delay']==$i) { echo ' selected="selected"'; }
  echo '>'.$i.'</option>'."\n";
  $i++;
}
echo '</select> '._AB_INSECONDS.'<br />'._AB_FLOODNOTE.'</td></tr>'."\n";

echo '<tr><td>'.help_img(_AB_HELP_001).' '._AB_DISPLAYLINK.':</td>'."\n";
echo '<td><select name="xdisplay_link">'."\n";
$sel1 = $sel2 = $sel3 = $sel4 = "";
if($ip_sets['display_link']==1) { $sel2 = ' selected="selected"'; }
elseif($ip_sets['display_link']==2) { $sel3 = ' selected="selected"'; }
elseif($ip_sets['display_link']==3) { $sel4 = ' selected="selected"'; }
else { $sel1 = ' selected="selected"'; }
echo '<option value="0"'.$sel1.'>'._AB_NONE.'</option>'."\n";
echo '<option value="1"'.$sel2.'>'._AB_ADMINSONLY.'</option>'."\n";
echo '<option value="2"'.$sel3.'>'._AB_USERS.'</option>'."\n";
echo '<option value="3"'.$sel4.'>'._AB_VISITORS.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_002).' '._AB_DISPLAYREASON.':</td>'."\n";
echo '<td><select name="xdisplay_reason">'."\n";
$sel1 = $sel2 = $sel3 = $sel4 = "";
if($ip_sets['display_reason']==1) { $sel2 = ' selected="selected"'; }
elseif($ip_sets['display_reason']==2) { $sel3 = ' selected="selected"'; }
elseif($ip_sets['display_reason']==3) { $sel4 = ' selected="selected"'; }
else { $sel1 = ' selected="selected"'; }
echo '<option value="0"'.$sel1.'>'._AB_NONE.'</option>'."\n";
echo '<option value="1"'.$sel2.'>'._AB_ADMINSONLY.'</option>'."\n";
echo '<option value="2"'.$sel3.'>'._AB_USERS.'</option>'."\n";
echo '<option value="3"'.$sel4.'>'._AB_VISITORS.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_044).' '._AB_PROXYBLOCKER.':</td>'."\n";
$selproxy1 = $selproxy2 = $selproxy3 = $selproxy4 = "";
if($ip_sets['proxy_switch'] == 1) { $selproxy2 = ' selected="selected"'; }
elseif($ip_sets['proxy_switch'] == 2) { $selproxy3 = ' selected="selected"'; }
elseif($ip_sets['proxy_switch'] == 3) { $selproxy4 = ' selected="selected"'; }
else { $selproxy1 = ' selected="selected"'; }
echo '<td><select name="xproxy_switch">'."\n";
echo '<option value="0"'.$selproxy1.'>'._AB_OFF.'</option>'."\n";
echo '<option value="1"'.$selproxy2.'>'._AB_PROXYLITE.'</option>'."\n";
echo '<option value="2"'.$selproxy3.'>'._AB_PROXYMILD.'</option>'."\n";
echo '<option value="3"'.$selproxy4.'>'._AB_PROXYSTRONG.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_045).' '._AB_TEMPLATE.':</td>'."\n";
echo '<td><select name="xproxy_reason">'."\n";
$templatedir = dir(NUKE_INCLUDE_DIR.'nukesentinel/abuse');
$templatelist = "";
while($func=$templatedir->read()) {
  if(substr($func, 0, 6) == "abuse_") {
    $templatelist .= "$func ";
  }
}
closedir($templatedir->handle);
$templatelist = explode(" ", $templatelist);
sort($templatelist);
for($i=0; $i < sizeof($templatelist); $i++) {
  if($templatelist[$i]!="") {
    $bl = str_replace("abuse_","",$templatelist[$i]);
    $bl = str_replace(".tpl","",$bl);
    $bl = str_replace("_"," ",$bl);
    echo '<option';
    if($templatelist[$i]==$ip_sets['proxy_reason']) { echo ' selected="selected"'; }
    echo ' value="'.$templatelist[$i].'">'.ucfirst($bl).'</option>'."\n";
  }
}
echo '</select></td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_042).' '._AB_SELFEXPIRE.':</td>'."\n";
$selexpire1 = $selexpire2 = "";
if($ip_sets['self_expire'] == 1) { $selexpire2 = ' selected="selected"'; } else { $selexpire1 = ' selected="selected"'; }
echo '<td><select name="xself_expire">'."\n";
echo '<option value="0"'.$selexpire1.'>'._AB_OFF.'</option>'."\n";
echo '<option value="1"'.$selexpire2.'>'._AB_ON.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_056).' '._AB_SANTYPROTECTION.':</td>'."\n";
$selsanty1 = $selsanty2 = "";
if($ip_sets['santy_protection'] == 1) { $selsanty2 = ' selected="selected"'; } else { $selsanty1 = ' selected="selected"'; }
echo '<td><select name="xsanty_protection">'."\n";
echo '<option value="0"'.$selsanty1.'>'._AB_OFF.'</option>'."\n";
echo '<option value="1"'.$selsanty2.'>'._AB_ON.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_046).' '._AB_PREVENTDOS.':</td>'."\n";
$seldos1 = $seldos2 = "";
if($ip_sets['prevent_dos'] == 1) { $seldos2 = ' selected="selected"'; } else { $seldos1 = ' selected="selected"'; }
echo '<td><select name="xprevent_dos">'."\n";
echo '<option value="0"'.$seldos1.'>'._AB_OFF.'</option>'."\n";
echo '<option value="1"'.$seldos2.'>'._AB_ON.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><strong>'._AB_ADMINISTRATIVE.'</strong></td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_007).' '._AB_ADMINAUTH.':</td>'."\n";
$apass = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` WHERE `password_md5`='' OR `password`='' OR `password_crypt`=''"));
$sapi_name = strtolower(php_sapi_name());
$selauth1 = $selauth2 = $selauth3 = "";
if($ip_sets['http_auth'] == 1) { $selauth2 = ' selected="selected"'; }
else if($ip_sets['http_auth'] == 2) { $selauth3 = ' selected="selected"'; }
else { $selauth1 = ' selected="selected"'; }
echo '<td><select name="xhttp_auth">'."\n";
echo '<option value="0"'.$selauth1.'>'._AB_OFF.'</option>'."\n";
if(strpos($sapi_name,"cgi")===FALSE && ini_get("register_globals")) {
  echo '<option value="1"'.$selauth2.'>'._AB_HTTPAUTH.'</option>'."\n";
}
echo '<option value="2"'.$selauth3.'>'._AB_CGIAUTH.'</option>'."\n";
echo '</select>';
if($apass > 0) { echo '<br /><strong>'._AB_SETPASSWORDS.'</strong>'; }
echo '</td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_005).' '._AB_HTACCESSPATH.':</td>'."\n";
echo '<td>';
if(stristr($_SERVER['SERVER_SOFTWARE'], "apache")) {
  echo '<input type="text" name="xhtaccess_path" size="50" value="'.$ip_sets['htaccess_path'].'" />';
  echo '<br />'._AB_NORMALLY.': '.$rp.'.htaccess';
  if($ip_sets['htaccess_path']>"") {
    $httest = is_writable($ip_sets['htaccess_path']);
    if(!$httest) { echo '<br /><strong>'._AB_HTWARNING.'</strong>'; }
  }
} else {
  echo '<br /><strong>'._AB_NOTSUPPORTED.'</strong><input type="hidden" name="xhtaccess_path" value="" />';
}
echo '</td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_057).' '._AB_STACCESSPATH.':<br /><a href="'.$admin_file.'.php?op=ABCGIAuth" target="_blank">'._AB_CGIAUTHSETUP.'</a></td>'."\n";
echo '<td>';
if(stristr($_SERVER['SERVER_SOFTWARE'], "apache")) { 
  echo '<input type="text" name="xstaccess_path" size="50" value="'.$ip_sets['staccess_path'].'" />';
  echo '<br />'._AB_NORMALLY.': '.$rp.'.staccess';
  if($ip_sets['staccess_path']>"") {
    $sttest = is_writable($ip_sets['staccess_path']);
    if(!$sttest) { echo '<br /><strong>'._AB_STWARNING.'</strong>'; }
  }
} else {
  echo '<br /><strong>'._AB_NOTSUPPORTED.'</strong><input type="hidden" name="xstaccess_path" value="" />';
}
echo '</td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_119).' '._AB_FTACCESSPATH.':</td>'."\n";
echo '<td>';
if(stristr($_SERVER['SERVER_SOFTWARE'], "Apache")) {
  echo '<input type="text" name="xftaccess_path" size="50" value="'.$ip_sets['ftaccess_path'].'" />';
  echo '<br />'._AB_NORMALLY.': '.$rp.'.ftaccess';
  if($ip_sets['ftaccess_path'] > "") {
    $fttest = is_writable($ip_sets['ftaccess_path']);
    if(!$fttest) { echo '<br /><strong>'._AB_FTWARNING.'</strong>'; }
  }
} else {
  echo '<strong>'._AB_NOTAVAILABLE.'</strong><input type="hidden" name="xftaccess_path" value="" />';
}
echo '</td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_121).' '._AB_DUMPDIRECTORY.':<br /></td>'."\n";
echo '<td>';
  echo '<input type="text" name="xdump_directory" size="50" value="'.$ip_sets['dump_directory'].'" />';
  echo '<br />'._AB_NORMALLY.': includes/cache/ - '._AB_RELATIVEONLY;
  if($ip_sets['dump_directory'] > "") {
    $cachetest = is_writable($ip_sets['dump_directory']);
    if(!$cachetest) { echo '<br /><strong>'._AB_DUMPWARNING.'</strong>'; }
  }
echo '</td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_067).' '._AB_CRYPTSALT.':</td>'."\n";
echo '<td><input type="text" name="xcrypt_salt" size="3" maxlength="2" value="'.$ip_sets['crypt_salt'].'" /></td></tr>'."\n";
echo '<tr><td valign="top">'.help_img(_AB_HELP_006).' '._AB_ADMINLIST.':</td>'."\n";
echo '<td><textarea name="xadmin_contact" rows="10" cols="60">'.$ip_sets['admin_contact'].'</textarea></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><strong>'._AB_IPTRACKERSETTINGS.'</strong></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_050).' '._AB_IPTRACKER.':</td>'."\n";
echo '<td><select name="xtrack_active">'."\n";
$sel1 = $sel2 = "";
if($ip_sets['track_active']==0) { $sel1 = ' selected="selected"'; } else { $sel2 = ' selected="selected"'; }
echo '<option value="0"'.$sel1.'>'._AB_OFF.'</option>'."\n";
echo '<option value="1"'.$sel2.'>'._AB_ON.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_051).' '._AB_MAXIMUMDAYS.':</td>'."\n";
echo '<td><select name="xtrack_max">'."\n";
$selmax='';
if($ip_sets['track_max']==0) { $selmax = _AB_UNLIMITED; }
echo '<option value="0"'.$selmax.'>'._AB_UNLIMITED.'</option>'."\n";
$i=1;
while($i<=31) {
  $j = $i * 86400;
  echo '<option value="'.$j.'"';
  if($ip_sets['track_max']==$j) { echo ' selected="selected"'; }
  echo '>'.$i.'</option>'."\n";
  $i++;
}
echo '</select></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><strong>'._AB_BLOCKEDPAGE.'</strong></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_008).' '._AB_IPSPERPAGE.':</td>'."\n";
echo '<td><input type="text" name="xblock_perpage" size="5" value="'.$ip_sets['block_perpage'].'" /></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_009).' '._AB_SORTCOLUMN.':</td>'."\n";
echo '<td><select name="xblock_sort_column">'."\n";
$selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $selcolumn5 = "";
if($ip_sets['block_sort_column'] == "expires") { $selcolumn2 = ' selected="selected"'; }
elseif($ip_sets['block_sort_column'] == "date") { $selcolumn3 = ' selected="selected"'; }
elseif($ip_sets['block_sort_column'] == "reason") { $selcolumn4 = ' selected="selected"'; }
elseif($ip_sets['block_sort_column'] == "c2c") { $selcolumn5 = ' selected="selected"'; }
else { $selcolumn1 = ' selected="selected"'; }
echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPBLOCKED.'</option>'."\n";
echo '<option value="expires"'.$selcolumn2.'>'._AB_EXPIRES.'</option>'."\n";
echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
echo '<option value="reason"'.$selcolumn4.'>'._AB_REASON.'</option>'."\n";
echo '<option value="c2c"'.$selcolumn5.'>'._AB_C2CODE.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_010).' '._AB_SORTDIRECTION.':</td>'."\n";
echo '<td><select name="xblock_sort_direction">'."\n";
$seldirection1 = $seldirection2 = "";
if($ip_sets['block_sort_direction'] == "desc") { $seldirection2 = ' selected="selected"'; }
else { $seldirection1 = ' selected="selected"'; }
echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><strong>'._AB_TRACKEDPAGE.'</strong></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_053).' '._AB_IPSPERPAGE.':</td>'."\n";
echo '<td><input type="text" name="xtrack_perpage" size="5" value="'.$ip_sets['track_perpage'].'" /></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_054).' '._AB_SORTCOLUMN.':</td>'."\n";
echo '<td><select name="xtrack_sort_column">'."\n";
$selcolumn1 = $selcolumn2 = $selcolumn3 = $selcolumn4 = $selcolumn5 = $selcolumn6 = "";
if($ip_sets['track_sort_column'] == "date") { $selcolumn3 = ' selected="selected"'; }
elseif($ip_sets['track_sort_column'] == "username") { $selcolumn4 = ' selected="selected"'; }
elseif($ip_sets['track_sort_column'] == 5) { $selcolumn5 = ' selected="selected"'; }
elseif($ip_sets['track_sort_column'] == "c2c") { $selcolumn6 = ' selected="selected"'; }
else { $selcolumn1 = ' selected="selected"'; }
echo '<option value="ip_long"'.$selcolumn1.'>'._AB_IPTRACKED.'</option>'."\n";
echo '<option value="date"'.$selcolumn3.'>'._AB_DATE.'</option>'."\n";
echo '<option value="username"'.$selcolumn4.'>'._AB_USERNAME.'</option>'."\n";
echo '<option value="5"'.$selcolumn5.'>'._AB_HITS.'</option>'."\n";
echo '<option value="c2c"'.$selcolumn6.'>'._AB_C2CODE.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td>'.help_img(_AB_HELP_055).' '._AB_SORTDIRECTION.':</td>'."\n";
echo '<td><select name="xtrack_sort_direction">'."\n";
$seldirection1 = $seldirection2 = "";
if($ip_sets['track_sort_direction'] == "desc") { $seldirection2 = ' selected="selected"'; }
else { $seldirection1 = ' selected="selected"'; }
echo '<option value="asc"'.$seldirection1.'>'._AB_ASC.'</option>'."\n";
echo '<option value="desc"'.$seldirection2.'>'._AB_DESC.'</option>'."\n";
echo '</select></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>