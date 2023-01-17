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

include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_VIEWIP);
mastermenu();
CarryMenu();
blockedipmenu();
CloseMenu();
CloseTable();

OpenTable();
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$xIPs' LIMIT 0,1"));
$getIPs['date'] = date("Y-m-d H:i:s",$getIPs['date']);
list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
$lookupip = str_replace("*", "0", $xIPs);
$getIPs['query_string'] = htmlentities(base64_decode($getIPs['query_string']));
$getIPs['query_string'] = str_replace("%20", " ", $getIPs['query_string']);
$getIPs['query_string'] = str_replace("/**/", "/* */", $getIPs['query_string']);
$getIPs['get_string'] = htmlentities(base64_decode($getIPs['get_string']));
$getIPs['get_string'] = str_replace("%20", " ", $getIPs['get_string']);
$getIPs['get_string'] = str_replace("/**/", "/* */", $getIPs['get_string']);
$getIPs['post_string'] = htmlentities(base64_decode($getIPs['post_string']));
$getIPs['post_string'] = str_replace("%20", " ", $getIPs['post_string']);
$getIPs['post_string'] = str_replace("/**/", "/* */", $getIPs['post_string']);
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_BLOCKEDIP.':</strong></td><td><a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$xIPs.'</a></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_USER.':</strong></td><td>'.UsernameColor($getIPs['username']).'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_AGENT.':</strong></td><td>'.$getIPs['user_agent'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_BLOCKEDON.':</strong></td><td>'.$getIPs['date'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td>'.$getIPs['notes'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REASON.':</strong></td><td>'.$getIPs['reason'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" colspan="2">&nbsp;</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_QUERY.':</strong></td><td>'.info_img("<strong>"._AB_QUERY.":</strong> ".$getIPs['query_string']).'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_GET.':</strong></td><td>'.info_img("<strong>"._AB_GET.":</strong> ".$getIPs['get_string']).'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_POST.':</strong></td><td>'.info_img("<strong>"._AB_POST.":</strong> ".$getIPs['post_string']).'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_X_FORWARDED.':</strong></td><td>'.$getIPs['x_forward_for'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_CLIENT_IP.':</strong></td><td>'.$getIPs['client_ip'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_ADDR.':</strong></td><td>'.$getIPs['remote_addr'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_PORT.':</strong></td><td>'.$getIPs['remote_port'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REQUEST_METHOD.':</strong></td><td>'.$getIPs['request_method'].'</td></tr>'."\n";
echo '<tr><td align="center" colspan="2">'._GOBACK.'</td></tr>'."\n";
echo '</table>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>