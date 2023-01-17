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
OpenMenu(_AB_ADDRANGE);
mastermenu();
CarryMenu();
blockedrangemenu();
CloseMenu();
CloseTable();

OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABBlockedRangeAddSave" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr bgcolor="'.$bgcolor1.'"><td align="center" class="content" colspan="2">'._AB_ADDRANGES.'</td></tr>'."\n";
if(isset($ip_lo)) { $tip_lo = explode(".", $ip_lo); } else { $tip_lo[0]=""; $tip_lo[1]=$tip_lo[2]=$tip_lo[3]="0"; }
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPLO.':</strong></td>'."\n";
echo '<td><input type="text" name="xip_lo[0]" value="'.$tip_lo[0].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[1]" value="'.$tip_lo[1].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[2]" value="'.$tip_lo[2].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[3]" value="'.$tip_lo[3].'" size="4" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
if(isset($ip_hi)) { $tip_hi = explode(".", $ip_hi); } else { $tip_hi[0]=""; $tip_hi[1]=$tip_hi[2]=$tip_hi[3]="255"; }
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPHI.':</strong></td>'."\n";
echo '<td><input type="text" name="xip_hi[0]" value="'.$tip_hi[0].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[1]" value="'.$tip_hi[1].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[2]" value="'.$tip_hi[2].'" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[3]" value="'.$tip_hi[3].'" size="4" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_EXPIRESIN.':</strong></td><td><select name="xexpires">'."\n";
echo '<option value="0">'._AB_PERMENANT.'</option>'."\n";
$i=1;
while($i<=365) {
  $expiredate = date("Y-m-d", time() + ($i * 86400));
  echo '<option value="'.$i.'">'.$i.' ('.$expiredate.')</option>'."\n";
  $i++;
}
echo '</select><br />'."\n";
echo _AB_EXPIRESINS.'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td><textarea name="xnotes" rows="10" cols="60">'._AB_ADDBY.' '.$aid.'</textarea></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REASON.':</strong></td><td><select name="xreason">'."\n";
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blockers` ORDER BY `block_name`");
while($blockerrow = $db->sql_fetchrow($result)) {
  echo '<option value="'.$blockerrow['blocker'].'">'.$blockerrow['reason'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_COUNTRY.':</strong></td>'."\n";
echo '<td><select name="xc2c">'."\n";
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_countries` ORDER BY `c2c`");
while($countryrow = $db->sql_fetchrow($result)) {
  echo '<option value="'.$countryrow['c2c'].'"';
  if(isset($tc2c) AND $tc2c == strtolower($countryrow['c2c'])) { echo ' selected="selected"'; }
  echo '>'.strtoupper($countryrow['c2c']).' - '.$countryrow['country'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="checkbox" name="another" value="1" checked="checked" />'._AB_ADDANOTHERRANGE.'</td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="'._AB_ADDRANGE.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>