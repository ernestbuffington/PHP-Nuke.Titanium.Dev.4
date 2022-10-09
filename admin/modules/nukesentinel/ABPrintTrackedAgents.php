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
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTTRACKEDAGENTS;
echo "<title>$pagetitle</title>\n";
$theme_Sel = get_theme();
include_once("themes/$theme_Sel/theme.php");
echo "<LINK REL='StyleSheet' HREF='themes/$theme_Sel/style/style.css' TYPE='text/css' MEDIA='screen'>\n";
echo "</head><body>\n";
echo "<h1 align='center'>$pagetitle</h1>\n";
if(!isset($modfilter)) $modfilter='';
$totalselected = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`user_agent`) FROM `".$prefix."_nsnst_tracked_ips` $modfilter GROUP BY 1"));
if($totalselected > 0) {
  echo "<table summary='' align='center' border='2' cellpadding='2' cellspacing='2'>\n";
  echo "<tr>\n";
  echo "<td><strong>"._AB_USERAGENT."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_IPSTRACKED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_LASTVIEWED."</strong></td>\n";
  echo "<td align='center'><strong>"._AB_HITS."</strong></td>\n";
  $result = $db->sql_query("SELECT `user_agent`, MAX(`date`), COUNT(*) FROM `".$prefix."_nsnst_tracked_ips` GROUP BY 1");
  while(list($user_agent, $lastview, $hits) = $db->sql_fetchrow($result)){
    echo "<tr>";
    echo "<td>$user_agent</td>";
    $trackedips = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$user_agent'"));
    echo "<td align='center'>$trackedips</td>\n";
    echo "<td align='center'>".date("Y-m-d \@ H:i:s",$lastview)."</td>";
    echo "<td align='center'>$hits</td>";
    echo "</tr>";
  }
  $db->sql_freeresult($result);
  // End IP Stats
  echo "</table>";
} else {
  echo "<center><strong>"._AB_NOUSERS."</strong></center>\n";
}
echo "</body></html>\n";

?>