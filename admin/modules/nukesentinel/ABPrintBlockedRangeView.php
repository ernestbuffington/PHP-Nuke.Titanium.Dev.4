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
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTRANGE;
echo "<title>$pagetitle</title>\n";
$theme_Sel = get_theme();
include_once("themes/$theme_Sel/theme.php");
echo "<LINK REL='StyleSheet' HREF='themes/$theme_Sel/style/style.css' TYPE='text/css' MEDIA='screen'>\n";
echo "</head><body>\n";
echo "<h1 align='center'>$pagetitle</h1>\n";
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1"));
$getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
$getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
echo "<table summary='' align='center' border='2' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td><strong>"._AB_IPLO.":</strong></td><td>".$getIPs['ip_lo_ip']."</td></tr>\n";
echo "<tr><td><strong>"._AB_IPHI.":</strong></td><td>".$getIPs['ip_hi_ip']."</td></tr>\n";
if($getIPs['expires']==0) { $getIPs['expires'] =_AB_PERMENANT; } else { $getIPs['expires'] = date("Y-m-d \@ H:i:s", $getIPs['expires']); }
echo "<tr><td><strong>"._AB_EXPIRES.":</strong></td><td>".$getIPs['expires']."</td></tr>\n";
echo "<tr><td valign='top'><strong>"._AB_NOTES.":</strong></td><td>".$getIPs['notes']."</td></tr>\n";
$blockerrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
echo "<tr><td><strong>"._AB_REASON.":</strong></td><td>".$blockerrow['reason']."</td></tr>\n";
$countryrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_countries` WHERE `c2c`='".$getIPs['c2c']."' LIMIT 0,1"));
echo "<tr><td><strong>"._AB_COUNTRY.":</strong></td><td>".$countryrow['country']."</td></tr>\n";
echo "</table>\n";
echo "</body></html>\n";

?>