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
OpenMenu(_AB_ADDIP2COUNTRY);
mastermenu();
CarryMenu();
ip2cmenu();
CloseMenu();
CloseTable();

OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABIP2CountryAddSave" />'."\n";
echo '<input type="hidden" name="xop" value="'.isset($xop).'" />'."\n";
echo '<input type="hidden" name="sip" value="'.isset($sip).'" />'."\n";
echo '<input type="hidden" name="min" value="'.isset($min).'" />'."\n";
echo '<input type="hidden" name="column" value="'.isset($column).'" />'."\n";
echo '<input type="hidden" name="direction" value="'.isset($direction).'" />'."\n";
echo '<input type="hidden" name="showcountry" value="'.isset($showcountry).'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" class="content" colspan="2">'._AB_ADDIP2COUNTRYS.'</td></tr>'."\n";
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
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_COUNTRY.':</strong></td>'."\n";
echo '<td><select name="xc2c">'."\n";
$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_countries` ORDER BY `c2c`");
while($countryrow = $db->sql_fetchrow($result)) {
  echo '<option value="'.$countryrow['c2c'].'">'.strtoupper($countryrow['c2c']).' - '.$countryrow['country'].'</option>'."\n";
}
echo '</select></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="checkbox" name="another" value="1" checked="checked" />'._AB_ADDANOTHERRANGE.'</td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="'._AB_ADDIP2COUNTRY.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>