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

$tid = intval($tid);
$tidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_ADDIP);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();

OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABTrackedAddSave" />'."\n";
echo '<input type="hidden" name="tidinfo[c2c]" value="'.$tidinfo['c2c'].'" />'."\n";
echo '<input type="hidden" name="tidinfo[date]" value="'.time().'" />'."\n";
echo '<input type="hidden" name="tidinfo[old_ip]" value="'.$tidinfo['ip_addr'].'" />'."\n";
echo '<input type="hidden" name="tidinfo[query_string]" value="'.$tidinfo['page'].'" />'."\n";
echo '<input type="hidden" name="tidinfo[x_forward_for]" value="'.$tidinfo['x_forward_for'].'" />'."\n";
echo '<input type="hidden" name="tidinfo[client_ip]" value="'.$tidinfo['client_ip'].'" />'."\n";
echo '<input type="hidden" name="tidinfo[remote_addr]" value="'.$tidinfo['remote_addr'].'" />'."\n";
echo '<input type="hidden" name="tidinfo[remote_port]" value="'.$tidinfo['remote_port'].'" />'."\n";
echo '<input type="hidden" name="tidinfo[request_method]" value="'.$tidinfo['request_method'].'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" colspan="2">'._AB_ADDIPS.'</td></tr>'."\n";
$tip = explode(".", $tidinfo['ip_addr']);
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPBLOCKED.':</strong></td>'."\n";
echo '<td><input type="text" name="xip[0]" value="'.$tip[0].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip[1]" value="'.$tip[1].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip[2]" value="'.$tip[2].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip[3]" value="'.$tip[3].'" size="4" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_USERID.':</strong></td><td><input type="text" name="tidinfo[user_id]" size="20" value="'.$tidinfo['user_id'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_USERNAME.':</strong></td><td><input type="text" name="tidinfo[username]" size="20" value="'.$tidinfo['username'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_AGENT.':</strong></td><td><input type="text" name="tidinfo[user_agent]" size="40" value="'.$tidinfo['user_agent'].'" /></td></tr>'."\n";
$tidinfo['date'] = date("Y-m-d H:i:s",time());
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_DATE.':</strong></td><td>'.$tidinfo['date'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_EXPIRESIN.':</strong></td><td><select name="tidinfo[expires]">'."\n";
echo '<option value="0">'._AB_PERMENANT.'</option>'."\n";
$i=1;
while($i<=365) {
  $expiredate = date("Y-m-d", time() + ($i * 86400));
  echo '<option value="'.$i.'">'.$i.' ('.$expiredate.')</option>'."\n";
  $i++;
}
echo '</select><br />'."\n";
echo _AB_EXPIRESINS.'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td><textarea name="tidinfo[notes]" rows="10" cols="60">'.$getIPs['notes'].'</textarea></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REASON.':</strong></td><td><select name="tidinfo[reason]">'."\n";
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` ORDER BY `block_name`");
while($blockerrow = $db->sql_fetchrow($result)) {
  echo '<option value="'.$blockerrow['blocker'].'">'.$blockerrow['reason'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" colspan="2">&nbsp;</td></tr>'."\n";
$tidinfo['page'] = str_replace("%20", " ", $tidinfo['page']);
$tidinfo['page'] = str_replace("/**/", "/* */", $tidinfo['page']);
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_QUERY.':</strong></td><td>'.info_img("<strong>"._AB_QUERY.":</strong> ".$tidinfo['page']).'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_X_FORWARDED.':</strong></td><td>'.$tidinfo['x_forward_for'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_CLIENT_IP.':</strong></td><td>'.$tidinfo['client_ip'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_ADDR.':</strong></td><td>'.$tidinfo['remote_addr'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_PORT.':</strong></td><td>'.$tidinfo['remote_port'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REQUEST_METHOD.':</strong></td><td>'.$tidinfo['request_method'].'</td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_ADDIP.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>