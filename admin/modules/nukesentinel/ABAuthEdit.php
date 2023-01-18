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

if(is_god($admin)) {
  include_once(NUKE_BASE_DIR.'header.php');
  $sapi_name = strtolower(php_sapi_name());
  OpenTable();
  OpenMenu(_AB_EDITADMINS);
  mastermenu();
  CarryMenu();
  authmenu();
  CloseMenu();
  CloseTable();

  OpenTable();
  $admin_row = abget_admin($a_aid);
  echo '<form action="'.$admin_file.'.php" method="post">'."\n";
  echo '<input type="hidden" name="a_aid" value="'.$a_aid.'" />'."\n";
  echo '<input type="hidden" name="op" value="ABAuthEditSave" />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_ADMIN.':</strong></td>';
  echo '<td><strong>'.UsernameColor($a_aid).'</strong></td></tr>'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_AUTHLOGIN.':</strong></td>';
  echo '<td><input type="text" name="xlogin" size="20" maxlength="25" value="'.$admin_row['login'].'" /></td></tr>'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_PASSWORD.':</strong></td>';
  echo '<td><input type="text" name="xpassword" size="20" maxlength="20" value="'.$admin_row['password'].'" /></td></tr>'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_PROTECTED.':</strong></td>';
  $sel1=$sel2='';
  if($admin_row['protected']==0) { $sel1 = ' selected="selected"'; } else { $sel2 = ' selected="selected"'; }
  echo '<td><select name="xprotected">'."\n";
  echo '<option value="0"'.$sel1.'>'._AB_NOTPROTECTED.'</option>'."\n";
  echo '<option value="1"'.$sel2.'>'._AB_ISPROTECTED.'</option>'."\n";
  echo '</select></td></tr>'."\n";
  echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
  echo '</table>'."\n";
  echo '</form>'."\n";
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>