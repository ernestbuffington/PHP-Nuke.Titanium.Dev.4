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
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTPROTECTEDRANGES;
echo "<title>$pagetitle</title>\n";
$theme_Sel = get_theme();
include_once("themes/$theme_Sel/theme.php");
echo "<LINK REL='StyleSheet' HREF='themes/$theme_Sel/style/style.css' TYPE='text/css' MEDIA='screen'>\n";
echo "</head><body>\n";
echo "<h1 align='center'>$pagetitle</h1>\n";
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges`"));
if($totalselected > 0) {
  echo "<table summary='' align='center' border='2' cellpadding='2' cellspacing='2'>\n";
  echo "<tr>\n";
  echo "<td><strong>"._AB_IPLO."</strong></td>\n";
  echo "<td><strong>"._AB_IPHI."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_COUNTRY."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_DATE."</strong></td>\n";
  echo "</tr>\n";
  $result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_protected_ranges` ORDER BY `ip_lo`");
  while($getIPs = $db->sql_fetchrow($result)) {
    $getIPs['ip_lo_ip'] = long2ip($getIPs['ip_lo']);
    $getIPs['ip_hi_ip'] = long2ip($getIPs['ip_hi']);
    $countrytitleinfo = abget_countrytitle($getIPs['c2c']);
    echo "<tr>\n";
    echo "<td>".$getIPs['ip_lo_ip']."</td>\n";
    echo "<td>".$getIPs['ip_hi_ip']."</td>\n";
    echo "<td align='center'>".$countrytitleinfo['country']."</td>\n";
    echo "<td align='center'>".date("Y-m-d \@ H:i:s",$getIPs['date'])."</td>\n";
    echo "</tr>\n";
  }
  echo "</table>\n";
} else {
  echo "<center><strong>"._AB_NORANGES."</strong></center>\n";
}
echo "</body></html>\n";

?>