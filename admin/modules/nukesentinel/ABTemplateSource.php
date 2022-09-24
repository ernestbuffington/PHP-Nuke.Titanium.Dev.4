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

if(empty($phpbb2_template)) { $phpbb2_template = "abuse_default.tpl"; }
$filename = NUKE_INCLUDE_DIR.'nukesentinel/abuse/'.$phpbb2_template;
if(!file_exists($filename)) { $filename = NUKE_INCLUDE_DIR.'nukesentinel/abuse/abuse_default.tpl'; }
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
OpenMenu(_AB_VIEWTEMPLATE);
mastermenu();
CarryMenu();
templatemenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
echo '<center class="title">'._AB_SOURCEOF.' '.$phpbb2_template.'<br /></center>'."\n";
echo '<center class="content"><strong>'._AB_NOTEDITOR.'</strong></center><br />'."\n";
$handle = @fopen($filename, "r");
$phpbb2_templatefile = fread($handle, filesize($filename));
@fclose($handle);
echo '<center><textarea rows="30" cols="70" readonly="readonly">'.htmlentities($phpbb2_templatefile, ENT_QUOTES).'</textarea></center>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>