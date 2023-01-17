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
OpenMenu(_AB_ADDSTRING);
mastermenu();
CarryMenu();
stringmenu();
CloseMenu();
CloseTable();

OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABStringAddSave" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_STRING.':</strong></td>'."\n";
echo '<td><input type="text" name="string" size="32" maxlength="256" /></td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="checkbox" name="another" value="1" checked="checked" />'._AB_ADDANOTHERSTRING.'</td></tr>'."\n";
echo '<tr><td colspan="2" align="center"><input type="submit" value="'._AB_ADDSTRING.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>