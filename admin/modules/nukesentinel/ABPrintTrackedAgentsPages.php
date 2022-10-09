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
$pagetitle = _AB_NUKESENTINEL.": "._AB_AGENTTRACKING;
echo "<title>$pagetitle</title>\n";
$theme_Sel = get_theme();
include_once("themes/$theme_Sel/theme.php");
echo "<LINK REL='StyleSheet' HREF='themes/$theme_Sel/style/style.css' TYPE='text/css' MEDIA='screen'>\n";
echo "</head><body>\n";
echo "<h1 align='center'>$pagetitle</h1>\n";
$tid=intval($tid);
list($uname) = $db->sql_fetchrow($db->sql_query("SELECT `user_agent` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
# default values if none set
echo "<center><strong>$uname</strong></center><br />";
echo "<table summary='' align='center' cellpadding='2' cellspacing='2' border='2'>\n";
echo "<tr>";
echo "<td nowrap><strong>"._AB_PAGEVIEWED."</strong></td>";
echo "<td nowrap><strong>"._AB_HITDATE."</strong></td>";
$result = $db->sql_query("SELECT `page`, `date` FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$uname' ORDER BY `date` DESC");
while(list($page, $date_time) = $db->sql_fetchrow($result)){
  echo "<tr>\n";
  echo "<td>$page</td>\n";
  echo "<td>".date("Y-m-d \@ H:i:s",$date_time)."</td>\n";
  echo "</tr>\n";
}
$db->sql_freeresult($result);
echo "</table>";
echo "</body></html>\n";

?>