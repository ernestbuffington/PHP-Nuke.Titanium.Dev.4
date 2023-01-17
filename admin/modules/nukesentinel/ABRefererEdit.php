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
OpenMenu(_AB_EDITREFERER);
mastermenu();
CarryMenu();
referermenu();
CloseMenu();
CloseTable();

OpenTable();
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_referers` WHERE `rid`='".$rid."' LIMIT 0,1"));
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABRefererEditSave" />'."\n";
echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
echo '<input type="hidden" name="rid" value="'.$rid.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_REFERER.':</strong></td>'."\n";
echo '<td><input type="text" name="referer" size="32" maxlength="256" value="'.$getIPs['referer'].'" /></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="'._AB_EDITREFERER.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>