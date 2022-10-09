<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2008 by NukeScripts Network       */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
echo "<html><head>\n";
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTBLOCKEDIPS;
echo "<title>$pagetitle</title>\n";
$theme_Sel = get_theme();
include_once("themes/$theme_Sel/theme.php");
echo "<LINK REL='StyleSheet' HREF='themes/$theme_Sel/style/style.css' TYPE='text/css' MEDIA='screen'>\n";
echo "</head><body>\n";
echo "<h1 align='center'>$pagetitle</h1>\n";
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips`"));
if($totalselected > 0) {
  echo "<table summary='' align='center' border='2' cellpadding='2' cellspacing='2'>\n";
  echo "<tr>\n";
  echo "<td><strong>"._AB_IPBLOCKED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_COUNTRY."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_DATE."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_EXPIRES."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_REASON."</strong></td>\n";
  echo "</tr>\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` ORDER BY `ip_addr`");
  while($getIPs = $db->sql_fetchrow($result)) {
    list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
    $getIPs['reason'] = str_replace("Abuse-", "", $getIPs['reason']);
    $bdate = date("Y-m-d @ H:i:s", $getIPs['date']);
    $lookupip = str_replace("*", "0", $getIPs['ip_addr']);
    if($getIPs['expires']==0) { $bexpire = _AB_PERMENANT; } else { $bexpire = date("Y-m-d @ H:i:s", $getIPs['expires']); }
    list($bname) = $db->sql_fetchrow($db->sql_query("SELECT `username` FROM `".$user_prefix."_users` WHERE `user_id`='".$getIPs['user_id']."' LIMIT 0,1"));
    echo "<tr>\n";
    $qs = htmlentities(base64_decode($getIPs['query_string']));
    $qs = str_replace("%20", " ", $qs);
    $qs = str_replace("/**/", "/* */", $qs);
    $qs = str_replace("&", "<br />&", $qs);
    $ua = $getIPs['user_agent'];
    $ua = htmlentities($ua, ENT_QUOTES);
    echo "<td>".$getIPs['ip_addr']."</td>\n";
    $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
    echo "<td align='center'>".$countrytitleinfo['country']."</td>\n";
    echo "<td align='center'>$bdate</td>\n";
    echo "<td align='center'>$bexpire</td>\n";
    echo "<td align='center'>".$getIPs['reason']."</td>\n";
    echo "</tr>\n";
  }
  echo "</table>\n";
} else {
  echo "<center><strong>"._AB_NOIPS."</strong></center>\n";
}
echo "</body></html>\n";

?>