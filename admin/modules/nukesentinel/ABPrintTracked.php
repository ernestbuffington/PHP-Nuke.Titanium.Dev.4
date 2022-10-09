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
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTTRACKEDIPS;
echo "<title>$pagetitle</title>\n";
$theme_Sel = get_theme();
include_once("themes/$theme_Sel/theme.php");
echo "<LINK REL='StyleSheet' HREF='themes/$theme_Sel/style/style.css' TYPE='text/css' MEDIA='screen'>\n";
echo "</head><body>\n";
if (!isset($modfilter)) $modfilter='';
echo "<h1 align='center'>$pagetitle</h1>\n";
$totalselected = $db->sql_numrows($db->sql_query("SELECT `username`, `ip_addr`, `ip_long`, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` GROUP BY 1,2,3"));
if($totalselected > 0) {
  echo "<table summary='' align='center' cellpadding='2' cellspacing='2' border='2'>\n";
  echo "<tr>\n";
  echo "<td><strong>"._AB_USER."</strong></td>\n";
  echo "<td><strong>"._AB_IPADDRESS."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_COUNTRY."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_HOSTNAME."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_LASTVIEWED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_HITS."</strong></td>\n";
  $result = $db->sql_query("SELECT `user_id`, `username`, `ip_addr`, `ip_long`, MAX(`date`), COUNT(*), MIN(`tid`), `c2c` FROM `".$prefix."_nsnst_tracked_ips` $modfilter GROUP BY 2,3,4 ORDER BY `ip_addr`");
  while(list($userid,$username,$ipaddr,$ip_long,$lastview,$hits,$tid,$c2c) = $db->sql_fetchrow($result)){
    echo "<tr>";
      $username = UsernameColor($username);
    if($userid != 1) {
      echo "<td>$username</td>";
    } else {
      echo "<td>&nbsp;</td>";
    }
    echo "<td>$ipaddr</td>";
    $countrytitleinfo = abget_countrytitle($c2c);
    echo "<td align='center'>".$countrytitleinfo['country']."</td>";
    echo "<td align='center'>$ip_long</td>";
    echo "<td align='center'>".date("Y-m-d \@ H:i:s",$lastview)."</td>";
    echo "<td align='center'>$hits</td>";
    echo "</tr>";
  }
  $db->sql_freeresult($result);
  // End IP Stats
  echo "</table>";
} else {
  echo "<center><strong>"._AB_NOIPS."</strong></center>\n";
}
echo "</body></html>\n";

?>