<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: 4nWhoIsOnline
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team - Nuke-Evolution.com

   Filename      : who.php
   Author        : See below
   Improved by   : LombudXa (Rodmar) (www.evolved-Systems.net)
   Version       : 1.0.5 (Based on 4nWhoIsOnline Version 0.91)
   Date          : 12.18.2005 (mm.dd.yyyy)

   Description   : 4nWhoIsOnline shows the current visitors online with
                   their resolved DNS name and country.
*************************************************************************/
/* Based on 4nWhoIsOnline Version 0.91 (german & english)               */
/* for phpNUKE Version 6.5 - 6.7 (www.phpnuke.org)                      */
/* ==================================================================== */
/* By WarpSpeed (Marco Wiesler) (warpspeed@4thDimension.de) @ Jun/2oo3  */
/* http://www.warp-speed.de @ 4thDimension.de Networking                */
/* ==================================================================== */
/* Based on:                                                            */
/* Admin AddOn v3.0                                                     */
/* ================                                                     */
/* Author: Jack Kozbial                                                 */
/* Web: http://www.internetintl.com                                     */
/* ==================================================================== */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      CNBYA Modifications                      v1.0.0       07/05/2005
      Advanced Username Color                  v1.0.5       10/28/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $prefix, $db, $bgcolor2, $sitename, $bgcolor1, $prefix, $language, $multilingual, $user, $admin, $bgcolor, $admin_file, $user_prefix, $admdata, $nsnst_const;

if (is_mod_admin()) {

include(NUKE_BASE_DIR.'header.php');

OpenTable();
print '<div align="center" style="padding-top:6px;">';
print '</div>';
$serverdate = FormatDate($board_config['default_dateformat'], time(), $board_config['board_timezone']);

echo("<p align=\"center\"><strong>$sitename</strong> - " . _4nwho00 . "<br /><br />" . _4nwho01 . "<a href=\"" . $admin_file . ".php\">".$admlang['global']['header_return']."</a><br /><br />" . _4nwho02 . "$serverdate</p>");

echo ("<center><img src=\"images/4nwho/group-3.gif\" valign=\"middle\" height=\"14\" width=\"17\" alt=\"" . _4nwho03 . "\">" . _4nwho03 . "</center><br />");


echo ("<center><img src=\"images/4nwho/info.gif\" valign=\"middle\" border=\"0\" alt=\"" . _4nwho13 . "\">&nbsp;=&nbsp;" . _4nwho13 . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"images/4nwho/edit.gif\" valign=\"middle\" border=\"0\" alt=\"" . _4nwho08 . "\">&nbsp;=&nbsp;" . _4nwho08 . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"images/4nwho/delete.gif\" valign=\"middle\" border=\"0\" alt=\"" . _4nwho20 . "\">&nbsp;=&nbsp;" . _4nwho20 . "</center>");

echo ("<br /><table width=\"100%\" border=\"1\" cellspacing=\"2\" cellpadding=\"2\"><tr><td><strong>" . _4nwho04 . "</strong></td><td><strong>" . _4nwho05 . "</strong></td><td><strong>" . _4nwho06 . "</strong></td><td><strong>" . _4nwho10 . "</strong></td><td><strong>" . _4nwho07 . "</strong></td></tr>");
$result3 = $db->sql_query("SELECT uname, host_addr, starttime, guest FROM " . $prefix . "_session");

while (list($uname, $host_addr, $time, $guest) = $db->sql_fetchrow($result3)) {

if($guest == 0 || $guest == 2) {

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $usercolor = UsernameColor($uname);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:    CNBYA Modifications                 v1.0.0 ]
 ******************************************************/
        $uname = "<img src=\"images/4nwho/ur-member.gif\" valign=\"middle\" border=\"0\" alt=\"$uname\">&nbsp;$usercolor&nbsp;&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\"><img src=\"images/4nwho/info.gif\" valign=\"middle\" border=\"0\" alt=\"" . _4nwho13 . "\"></a><a href=\"modules.php?name=Your_Account&amp;file=admin&amp;op=modifyUser&amp;chng_uid=$uname\"><img src=\"images/4nwho/edit.gif\" valign=\"middle\" border=\"0\" alt=\"" . _4nwho08 . "\"></a>&nbsp;<a href=\"modules.php?name=Your_Account&amp;file=admin&amp;op=deleteUser&amp;chng_uid=$uname\"><img src=\"images/4nwho/delete.gif\" valign=\"middle\" border=\"0\" alt=\"" . _4nwho20 . "\"></a>";
/*****[END]********************************************
 [ Mod:    CNBYA Modifications                 v1.0.0 ]
 ******************************************************/
}
if($guest == 1) {
        $uname = "<img src=\"images/4nwho/ur-anony.gif\" valign=\"middle\" border=\"0\" alt=\"" . _4nwho14 . "\">&nbsp;" . _4nwho14 . "";
}
if($guest == 3) {
        $uname = "<img src=\"images/4nwho/ur-anony.gif\" valign=\"middle\" border=\"0\" alt=\"".$uname."\">&nbsp;".$uname;
}

// Ip fix for localhost - Quake (beta 2) 12-12-2005 14:31:10
if($host_addr == 'none') {
  $host_addr = '127.0.0.1';
}

$host = gethostbyaddr($host_addr);

$array = explode(".", $host);

$top_domain = $array[count($array)-1];

$country = "";

switch($top_domain) {
case 'aero':$country="Aeronautics"; break;
case 'arpa':$country="ARPANet/USA"; break;
case 'biz':$country="Business"; break;
case 'com':$country="Commercial"; break;
case 'coop':$country="Cooperative Associations"; break;
case 'edu':$country="Education"; break;
case 'gov':$country="Government/USA"; break;
case 'info':$country="Info"; break;
case 'int':$country="Oganization established by an International Teaty"; break;
case 'jobs':$country="Human Resource"; break;
case 'mil':$country="Military/USA"; break;
case 'museum':$country="Museum"; break;
case 'name':$country="Individuals"; break;
case 'net':$country="Network"; break;
case 'org':$country="Organization/USA"; break;
case 'pro':$country="Credentialed Professionals"; break;
case 'travel':$country="Travel Industry"; break;
case 'eu':$country="European Union"; break;
case 'un':$country="United Nations"; break;
case 'ad':$country="Andorra"; break;
case 'ae':$country="United Arab Emirates"; break;
case 'af':$country="Afghanistan"; break;
case 'ag':$country="Antigua & Barbuda"; break;
case 'ai':$country="Anguilla"; break;
case 'al':$country="Albania"; break;
case 'am':$country="Armenia"; break;
case 'an':$country="Netherlands Antilles"; break;
case 'ao':$country="Angola"; break;
case 'aq':$country="Antarctica"; break;
case 'ar':$country="Argentina"; break;
case 'as':$country="American Samoa"; break;
case 'at':$country="Austria"; break;
case 'au':$country="Australia"; break;
case 'aw':$country="Aruba"; break;
case 'ax':$country="Aaland Islands"; break;
case 'az':$country="Azerbaijan"; break;
case 'ba':$country="Bosnia-Herzegovina"; break;
case 'bb':$country="Barbados"; break;
case 'bd':$country="Bangladesh"; break;
case 'be':$country="Belgium"; break;
case 'bf':$country="Burkina Faso"; break;
case 'bg':$country="Bulgaria"; break;
case 'bh':$country="Bahrain"; break;
case 'bi':$country="Burundi"; break;
case 'bj':$country="Benin"; break;
case 'bm':$country="Bermuda"; break;
case 'bn':$country="Brunei Darussalam"; break;
case 'bo':$country="Bolivia"; break;
case 'br':$country="Brasil"; break;
case 'bs':$country="Bahamas"; break;
case 'bt':$country="Bhutan"; break;
case 'bv':$country="Bouvet Island"; break;
case 'bw':$country="Botswana"; break;
case 'by':$country="Belarus"; break;
case 'bz':$country="Belize"; break;
case 'ca':$country="Canada"; break;
case 'cc':$country="Cocos (Keeling) Islands"; break;
case 'cd':$country="Congo, Democratic Republic Of The"; break;
case 'cf':$country="Central African Republic"; break;
case 'cg':$country="Congo, People's Republic Of The"; break;
case 'ch':$country="Switzerland"; break;
case 'ci':$country="Ivory Coast"; break;
case 'ck':$country="Cook Islands"; break;
case 'cl':$country="Chile"; break;
case 'cm':$country="Cameroon"; break;
case 'cn':$country="China"; break;
case 'co':$country="Colombia"; break;
case 'cr':$country="Costa Rica"; break;
case 'cs':$country="Czechoslovakia"; break;
case 'cu':$country="Cuba"; break;
case 'cv':$country="Cape Verde"; break;
case 'cx':$country="Christmas Island"; break;
case 'cy':$country="Cyprus"; break;
case 'cz':$country="Czech Republic"; break;
case 'de':$country="Germany"; break;
case 'dj':$country="Djibouti"; break;
case 'dk':$country="Denmark"; break;
case 'dm':$country="Dominica"; break;
case 'do':$country="Dominican Republic"; break;
case 'dz':$country="Algeria"; break;
case 'ec':$country="Ecuador"; break;
case 'ee':$country="Estonia"; break;
case 'eg':$country="Egypt"; break;
case 'eh':$country="Western Sahara"; break;
case 'er':$country="Eritrea"; break;
case 'es':$country="Spain"; break;
case 'et':$country="Ethiopia"; break;
case 'fi':$country="Finland"; break;
case 'fj':$country="Fiji"; break;
case 'fk':$country="Falkland Islands (Malvibas)"; break;
case 'fm':$country="Micronesia"; break;
case 'fo':$country="Faroe Islands"; break;
case 'fr':$country="France"; break;
case 'fx':$country="France, Metropolitan"; break;
case 'ga':$country="Gabon"; break;
case 'gb':$country="Great Britain"; break;
case 'gd':$country="Grenada"; break;
case 'ge':$country="Georgia"; break;
case 'gf':$country="French Guiana"; break;
case 'gh':$country="Ghana"; break;
case 'gi':$country="Gibralta"; break;
case 'gl':$country="Greenland"; break;
case 'gm':$country="Gambia"; break;
case 'gn':$country="Guinea"; break;
case 'gp':$country="Guadeloupe (French)"; break;
case 'gq':$country="Equatorial Guinea"; break;
case 'gr':$country="Greece"; break;
case 'gs':$country="South Georgia & South Sandwich Islands"; break;
case 'gt':$country="Guatemala"; break;
case 'gu':$country="Guam (US)"; break;
case 'gw':$country="Guinea Bissau"; break;
case 'gy':$country="Guyana"; break;
case 'hk':$country="Hong Kong"; break;
case 'hm':$country="Heard & McDonald Islands"; break;
case 'hn':$country="Honduras"; break;
case 'hr':$country="Croatia"; break;
case 'ht':$country="Haiti"; break;
case 'hu':$country="Hungary"; break;
case 'id':$country="Indonesia"; break;
case 'ie':$country="Ireland"; break;
case 'il':$country="Israel"; break;
case 'in':$country="India"; break;
case 'io':$country="British Indian Ocean Territories"; break;
case 'iq':$country="Iraq"; break;
case 'ir':$country="Iran"; break;
case 'is':$country="Iceland"; break;
case 'it':$country="Italy"; break;
case 'jm':$country="Jamaica"; break;
case 'jo':$country="Jordan"; break;
case 'jp':$country="Japan"; break;
case 'ke':$country="Kenya"; break;
case 'kg':$country="Kyrgyz Republic"; break;
case 'kh':$country="Cambodia"; break;
case 'ki':$country="Kiribati"; break;
case 'km':$country="Comoros"; break;
case 'kn':$country="Saint Kitts Nevis Anguilla"; break;
case 'kp':$country="Korea, North"; break;
case 'kr':$country="Korea, South"; break;
case 'kw':$country="Kuwait"; break;
case 'ky':$country="Cayman Islands"; break;
case 'kz':$country="Kazachstan"; break;
case 'la':$country="Laos"; break;
case 'lb':$country="Lebanon"; break;
case 'lc':$country="Saint Lucia"; break;
case 'li':$country="Liechtenstein"; break;
case 'lk':$country="Sri Lanka"; break;
case 'lr':$country="Liberia"; break;
case 'ls':$country="Lesotho"; break;
case 'lt':$country="Lithuania"; break;
case 'lu':$country="Luxembourg"; break;
case 'lv':$country="Latvia"; break;
case 'ly':$country="Libya"; break;
case 'ma':$country="Morocco"; break;
case 'mc':$country="Monaco"; break;
case 'md':$country="Moldova"; break;
case 'mg':$country="Madagascar"; break;
case 'mh':$country="Marshall Islands"; break;
case 'mk':$country="Macedonia"; break;
case 'ml':$country="Mali"; break;
case 'mm':$country="Myanmar"; break;
case 'mn':$country="Mongolia"; break;
case 'mo':$country="Macau"; break;
case 'mp':$country="Northern Mariana Islands"; break;
case 'mq':$country="Martinique (French)"; break;
case 'mr':$country="Mauretania"; break;
case 'ms':$country="Montserrat"; break;
case 'mt':$country="Malta"; break;
case 'mu':$country="Mauritius"; break;
case 'mv':$country="Maldives"; break;
case 'mw':$country="Malawi"; break;
case 'mx':$country="Mexico"; break;
case 'my':$country="Malaysia"; break;
case 'mz':$country="Mozambique"; break;
case 'na':$country="Namibia"; break;
case 'nc':$country="New Caledonia (French)"; break;
case 'ne':$country="Niger"; break;
case 'nf':$country="Norfolk Island"; break;
case 'ng':$country="Nigeria"; break;
case 'ni':$country="Nicaragua"; break;
case 'nl':$country="Netherlands"; break;
case 'no':$country="Norway"; break;
case 'np':$country="Nepal"; break;
case 'nr':$country="Nauru"; break;
case 'nt':$country="Saudiarab. Irak)"; break;
case 'nu':$country="Niue"; break;
case 'nz':$country="New Zealand"; break;
case 'om':$country="Oman"; break;
case 'pa':$country="Panama"; break;
case 'pe':$country="Peru"; break;
case 'pf':$country="French Polynesia"; break;
case 'pg':$country="Papua New Guinea"; break;
case 'ph':$country="Philippines"; break;
case 'pk':$country="Pakistan"; break;
case 'pl':$country="Poland"; break;
case 'pm':$country="Saint Pierre & Miquelon"; break;
case 'pn':$country="Pitcairn"; break;
case 'pr':$country="Puerto Rico (US)"; break;
case 'pt':$country="Portugal"; break;
case 'pw':$country="Palau"; break;
case 'py':$country="Paraguay"; break;
case 'qa':$country="Qatar"; break;
case 're':$country="Reunion (French)"; break;
case 'ro':$country="Romania"; break;
case 'ru':$country="Russian Federation"; break;
case 'rw':$country="Rwanda"; break;
case 'sa':$country="Saudi Arabia"; break;
case 'sb':$country="Salomon Islands"; break;
case 'sc':$country="Seychelles"; break;
case 'sd':$country="Sudan"; break;
case 'se':$country="Sweden"; break;
case 'sg':$country="Singapore"; break;
case 'sh':$country="Saint Helena"; break;
case 'si':$country="Slovenia"; break;
case 'sj':$country="Svalbard & Jan Mayen"; break;
case 'sk':$country="Slovakia"; break;
case 'sl':$country="Sierra Leone"; break;
case 'sm':$country="San Marino"; break;
case 'sn':$country="Senegal"; break;
case 'so':$country="Somalia"; break;
case 'sr':$country="Suriname"; break;
case 'st':$country="Sao Tome & Principe"; break;
case 'su':$country="Soviet Union"; break;
case 'sv':$country="El Salvador"; break;
case 'sy':$country="Syria"; break;
case 'sz':$country="Swaziland"; break;
case 'tc':$country="Turks & Caicos Islands"; break;
case 'td':$country="Chad"; break;
case 'tf':$country="French Southern Territories"; break;
case 'tl':$country="Timor-leste"; break;
case 'tg':$country="Togo"; break;
case 'th':$country="Thailand"; break;
case 'tj':$country="Tadjikistan"; break;
case 'tk':$country="Tokelau"; break;
case 'tm':$country="Turkmenistan"; break;
case 'tn':$country="Tunisia"; break;
case 'to':$country="Tonga"; break;
case 'tp':$country="East Timor"; break;
case 'tr':$country="Turkey"; break;
case 'tt':$country="Trinidad & Tobago"; break;
case 'tv':$country="Tuvalu"; break;
case 'tw':$country="Taiwan"; break;
case 'tz':$country="Tanzania"; break;
case 'ua':$country="Ukraine"; break;
case 'ug':$country="Uganda"; break;
case 'uk':$country="United Kingdom"; break;
case 'um':$country="United States Minor Outlying Islands"; break;
case 'us':$country="United States"; break;
case 'uy':$country="Uruguay"; break;
case 'uz':$country="Uzbekistan"; break;
case 'va':$country="Vatican City State"; break;
case 'vc':$country="St Vincent & Grenadines"; break;
case 've':$country="Venezuela"; break;
case 'vg':$country="Virgin Islands, British"; break;
case 'vi':$country="Virgin Islands, American"; break;
case 'vn':$country="Vietnam"; break;
case 'vu':$country="Vanuatu"; break;
case 'wf':$country="Wallis & Futuna Islands"; break;
case 'ws':$country="Samoa"; break;
case 'xe':$country="England"; break;
case 'xs':$country="Scotland"; break;
case 'xw':$country="Wales"; break;
case 'ye':$country="Yemen"; break;
case 'yt':$country="Mayotte"; break;
case 'yu':$country="Yugoslavia"; break;
case 'za':$country="South Africa"; break;
case 'zm':$country="Zambia"; break;
case 'zr':$country="Zaire"; break;
case 'zw':$country="Zimbabwe"; break;
default:

if (is_numeric($host))
    $country = "" . _4nwho16 . "";
else
    $country = "" . _4nwho15 . "";
}
echo ("<tr><td>$uname</td>");

if($guest == 0 || $guest == 2) {
    echo ("<td><img src=\"images/4nwho/green_dot.gif\" valign=\"middle\" alt=\"\">&nbsp;&nbsp;$host_addr</td><td>");
}else{
    echo ("<td><img src=\"images/4nwho/red_dot.gif\" valign=\"middle\" alt=\"\">&nbsp;&nbsp;$host_addr</td><td>");
}
echo ("<img src=\"images/4nwho/star.gif\" valign=\"middle\" alt=\"\">&nbsp;&nbsp;$host</td><td>");
if ( strstr($host, "aol")) {
    echo ("<img src=\"images/4nwho/center_l.gif\" valign=\"middle\" alt=\"\">&nbsp;&nbsp;America Online</td>");
} else {
    echo ("<img src=\"images/4nwho/center_l.gif\" valign=\"middle\" alt=\"\">&nbsp;&nbsp;$country</td>");
}
$unixtime = time() - $time;
if($unixtime < 60){
    $sec=$unixtime;
    $min=0;
    $hour=0;
} else if($unixtime < 3600){
    $sec=$unixtime%60;
    $hour=0;
    $min_t = explode('.', number_format($unixtime/60,2));
    $min=$min_t[0];
} else if($unixtime >= 216000){
    $hour_t = explode('.',number_format($unixtime/216000,2));
    $hour=$hour_t[0];
    $sec=$unixtime%60;
    $min_te = $unixtime%216000;
    $min_t = explode('.',number_format($min_te/60,2));
    $min=$min_t[0];
}
if($guest == 0 || $guest == 2) {
    echo ("<td><img src=\"images/4nwho/green_dot.gif\" valign=\"middle\" alt=\"\">&nbsp;&nbsp;$hour hour : $min min : $sec sec </td>");
}else{
    echo ("<td><img src=\"images/4nwho/red_dot.gif\" valign=\"middle\" alt=\"\">&nbsp;&nbsp;$hour hour : $min min : $sec sec </td>");
  }
}
echo ("</tr></table><br />");

if(!isset($DataOnlineWho))
$DataOnlineWho = '';

if(!isset($numUsersOnline))
$numUsersOnline = 0;

$resultws = $db->sql_query("SELECT uname, guest FROM " . $prefix . "_session WHERE guest=1 OR guest=3");
$guest_online_count = $db->sql_numrows($resultws);
$result4thd = $db->sql_query("SELECT uname, guest FROM " . $prefix . "_session WHERE guest=0 OR guest=2");
$member_online_count = $db->sql_numrows($result4thd);
$DataOnlineWho .= "<img src=\"images/4nwho/group-1.gif\" height=\"14\" width=\"17\" alt=\"" . _4nwho03 . "\">&nbsp;&nbsp;" . _4nwho17 . "&nbsp;<strong>$guest_online_count</strong>&nbsp;" . _4nwho18 . "&nbsp;<strong>$member_online_count</strong>&nbsp;" . _4nwho19 . "";
    if (is_user()) {
        list($user_id) = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM " . $user_prefix . "_users WHERE username='$uname'"));
        }
$result2 = $db->sql_query("SELECT uname FROM " . $prefix . "_session WHERE guest='0' OR guest='2' ORDER BY uname ASC");
$member_online_count = $db->sql_numrows($result2);
    if (is_user()) {
       list($user_id) = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM " . $user_prefix . "_users WHERE username='$uname'"));
     } else {
$result2 = $db->sql_query("SELECT uname FROM " . $prefix . "_session WHERE guest='0' OR guest='2' ORDER BY uname ASC");
$member_online_count = $db->sql_numrows($result2);
     }
    if ($numUsersOnline>0) {
    while($row = $db->sql_fetchrow($unameResult)) {
      $uname = $row["uname"];
           }
        }
echo ("<center>[&nbsp;<a href=\"" . $admin_file . ".php?op=who\">" . _4nwho09 . "</a>&nbsp;]</center>\n");


list($lastuser) = $db->sql_fetchrow($db->sql_query("SELECT username FROM " . $user_prefix . "_users ORDER BY user_id DESC limit 0,1"));
$totalmembers = $db->sql_numrows($db->sql_query("SELECT * FROM " . $user_prefix . "_users"));
$totalmem = number_format($totalmembers, 0);

  echo ("<center>$DataOnlineWho</center>\n");
  echo ("<br /><center>" . _4nwho11 . ": <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$lastuser\"><strong>$lastuser</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . _4nwho12 . ": <strong>$totalmem</strong></center>\n");


// START - Please do not edit and/or delete this lines - THANKS!

echo ("<center>" . _4nwhocopy . "</center>\n");
print '<div align="center" style="padding-top:6px;">';
print '</div>';
CloseTable();

// END - Please do not edit and/or delete this lines - THANKS!
include(NUKE_BASE_DIR.'footer.php');

} 
else 
{
    echo "Access Denied";
}
?>