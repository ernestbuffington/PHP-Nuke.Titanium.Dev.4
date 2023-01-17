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
OpenMenu(_AB_EDITIP);
mastermenu();
CarryMenu();
blockedipmenu();
CloseMenu();
CloseTable();

OpenTable();
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$xIPs' LIMIT 0,1"));
$getIPs['date'] = date("Y-m-d H:i:s",$getIPs['date']);
$getIPs['expires'] = round(($getIPs['expires'] - time()) / 86400);
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABBlockedIPEditSave" />'."\n";
echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
echo '<input type="hidden" name="sip" value="'.$sip.'" />'."\n";
echo '<input type="hidden" name="old_xIPs" value="'.$xIPs.'" />'."\n";
echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" colspan="2">'._AB_EDITIPS.'</td></tr>'."\n";
$tip = explode(".", $xIPs);
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPBLOCKED.':</strong></td>'."\n";
echo '<td><input type="text" name="xip[0]" value="'.$tip[0].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip[1]" value="'.$tip[1].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip[2]" value="'.$tip[2].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip[3]" value="'.$tip[3].'" size="4" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_USERID.':</strong></td><td><input type="text" name="xuser_id" size="10" value="'.$getIPs['user_id'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_USERNAME.':</strong></td><td><input type="text" name="xusername" size="20" value="'.$getIPs['username'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_AGENT.':</strong></td><td><input type="text" name="xuser_agent" size="40" value="'.$getIPs['user_agent'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_BLOCKEDON.':</strong></td><td><input type="text" name="xdatetime" size="30" value="'.$getIPs['date'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_EXPIRESIN.':</strong></td><td><select name="xexpires">'."\n";
echo '<option value="0"';
if($getIPs['expires']==0) { echo ' selected="selected"'; }
echo '>'._AB_PERMENANT.'</option>'."\n";
$i=1;
while($i<=365) {
  echo '<option value="'.$i.'"';
  if($getIPs['expires']==$i) { echo ' selected="selected"'; }
  $expiredate = date("Y-m-d", time() + ($i * 86400));
  echo '>'.$i.' ('.$expiredate.')</option>'."\n";
  $i++;
}
echo '</select><br />'."\n";
echo _AB_EXPIRESINS.'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_COUNTRY.':</strong></td>'."\n";
echo '<td><select name="xc2c">'."\n";
echo '<option value="00">'._AB_SELECTCOUNTRY.'</option>'."\n";
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_countries` ORDER BY `c2c`");
while($countryrow = $db->sql_fetchrow($result)) {
  echo '<option value="'.$countryrow['c2c'].'"';
  if($countryrow['c2c'] == $getIPs['c2c']) { echo ' selected="selected"'; }
  echo '>'.strtoupper($countryrow['c2c']).' - '.$countryrow['country'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td><textarea name="xnotes" rows="10" cols="60">'.$getIPs['notes'].'</textarea></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REASON.':</strong></td><td><select name="xreason">'."\n";
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` ORDER BY `block_name`");
while($blockerrow = $db->sql_fetchrow($result)) {
  echo '<option value="'.$blockerrow['blocker'].'"';
  if($getIPs['reason']==$blockerrow['blocker']) { echo ' selected="selected"'; }
  echo '>'.$blockerrow['reason'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" colspan="2">&nbsp;</td></tr>'."\n";
$getIPs['query_string'] = htmlentities(base64_decode($getIPs['query_string']));
$getIPs['query_string'] = str_replace("%20", " ", $getIPs['query_string']);
$getIPs['query_string'] = str_replace("/**/", "/* */", $getIPs['query_string']);
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_QUERY.':</strong></td><td>'.info_img("<strong>"._AB_QUERY.":</strong> ".$getIPs['query_string']).'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_X_FORWARDED.':</strong></td><td>'.$getIPs['x_forward_for'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_CLIENT_IP.':</strong></td><td>'.$getIPs['client_ip'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_ADDR.':</strong></td><td>'.$getIPs['remote_addr'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REMOTE_PORT.':</strong></td><td>'.$getIPs['remote_port'].'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REQUEST_METHOD.':</strong></td><td>'.$getIPs['request_method'].'</td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>