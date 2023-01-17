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
OpenMenu(_AB_ADDPROTECTED);
mastermenu();
CarryMenu();
protectedmenu();
CloseMenu();
CloseTable();

OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABProtectedAddSave" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" class="content" colspan="2">'._AB_ADDPROTECTEDS.'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPLO.':</strong></td>'."\n";
echo '<td><input type="text" name="xip_lo[0]" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[1]" size="4" value="0" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[2]" size="4" value="0" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_lo[3]" size="4" value="0" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_IPHI.':</strong></td>'."\n";
echo '<td><input type="text" name="xip_hi[0]" size="4" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[1]" size="4" value="255" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[2]" size="4" value="255" maxlength="3" style="text-align: center;" />'."\n";
echo '. <input type="text" name="xip_hi[3]" size="4" value="255" maxlength="3" style="text-align: center;" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._AB_NOTES.':</strong></td><td><textarea name="xnotes" rows="10" cols="60">'._AB_ADDBY.' '.$aid.'</textarea></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_COUNTRY.':</strong></td>'."\n";
echo '<td><select name="xc2c">'."\n";
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_countries` ORDER BY `c2c`");
while($countryrow = $db->sql_fetchrow($result)) {
  echo '<option value="'.$countryrow['c2c'].'">'.strtoupper($countryrow['c2c']).' - '.$countryrow['country'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="checkbox" name="another" value="1" checked="checked" />'._AB_ADDANOTHERRANGE.'</td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="'._AB_ADDPROTECTED.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>