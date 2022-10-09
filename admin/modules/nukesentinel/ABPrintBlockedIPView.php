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
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTIP;
echo "<title>$pagetitle</title>\n";
$theme_Sel = get_theme();
include_once("themes/$theme_Sel/theme.php");
echo "<LINK REL='StyleSheet' HREF='themes/$theme_Sel/style/style.css' TYPE='text/css' MEDIA='screen'>\n";
echo "</head><body>\n";
echo "<h1 align='center'>$pagetitle</h1>\n";
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$xIPs' LIMIT 0,1"));
$getIPs['date'] = date("Y-m-d H:i:s",$getIPs['date']);
list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
$lookupip = str_replace("*", "0", $xIPs);
echo "<table summary='' align='center' border='1' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td><strong>"._AB_BLOCKEDIP.":</strong></td><td>$xIPs</td></tr>";
echo "<tr><td><strong>"._AB_USER.":</strong></td><td>".$getIPs['username']."</td></tr>";
echo "<tr><td><strong>"._AB_AGENT.":</strong></td><td>".$getIPs['user_agent']."</td></tr>";
echo "<tr><td><strong>"._AB_BLOCKEDON.":</strong></td><td>".$getIPs['date']."</td></tr>";
echo "<tr><td valign='top'><strong>"._AB_NOTES.":</strong></td><td>".$getIPs['notes']."</td></tr>\n";
echo "<tr><td><strong>"._AB_REASON.":</strong></td><td>".$getIPs['reason']."</td></tr>\n";
echo "<tr><td colspan='2'>&nbsp;</td></tr>\n";
$getIPs['query_string'] = htmlentities(base64_decode($getIPs['query_string']));
$getIPs['query_string'] = str_replace("%20", " ", $getIPs['query_string']);
$getIPs['query_string'] = str_replace("/**/", "/* */", $getIPs['query_string']);
echo "<tr><td><strong>"._AB_QUERY.":</strong></td><td> ".$getIPs['query_string']."</td></tr>\n";
echo "<tr><td><strong>"._AB_X_FORWARDED.":</strong></td><td>".$getIPs['x_forward_for']."</td></tr>\n";
echo "<tr><td><strong>"._AB_CLIENT_IP.":</strong></td><td>".$getIPs['client_ip']."</td></tr>\n";
echo "<tr><td><strong>"._AB_REMOTE_ADDR.":</strong></td><td>".$getIPs['remote_addr']."</td></tr>\n";
echo "<tr><td><strong>"._AB_REMOTE_PORT.":</strong></td><td>".$getIPs['remote_port']."</td></tr>\n";
echo "<tr><td><strong>"._AB_REQUEST_METHOD.":</strong></td><td>".$getIPs['request_method']."</td></tr>\n";
$countrytitleinfo = abget_countrytitle($getIPs['c2c']);
echo "<tr><td><strong>"._AB_COUNTRY.":</strong></td><td>".$countrytitleinfo['country']."</td></tr>\n";
echo "</table>\n";
echo "</body></html>\n";

?>