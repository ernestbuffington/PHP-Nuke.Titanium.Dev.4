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
/********************************************************/
/* HTTP Authentication Using PHP CGI and Apache         */
/* CGIAdminAuth.php                                     */
/* By: Raven PHP Scripts                                */
/* http://www.ravenphpscripts.com                       */
/* Copyright © 2004 by Raven PHP Scripts                */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

$pagetitle = _AB_NUKESENTINEL.": "._AB_CGIAUTHSETUP;
include_once(NUKE_BASE_DIR.'header.php');
title($pagetitle);
OpenTable();
$rp = strtolower(str_replace('index.php', '', realpath('index.php')));
$staccess = str_replace($rp, "", $ab_config['staccess_path']);
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr>'."\n";
echo '<td>'."\n";
echo _AB_SAVEIN.' <strong>'.$ab_config['htaccess_path'].' :</strong><br /><br />'."\n";
echo '<textarea rows="19" cols="44" readonly="readonly" style="font-family:Courier New;">'."\n";
echo '#-------------------------------------------'."\n";
echo '# Start of NukeSentinel(tm) '.$admin_file.'.php Auth'."\n";
echo '#-------------------------------------------'."\n";
echo '&lt;Files '.$staccess.'&gt;'."\n";
echo '  deny from all'."\n";
echo '&lt;/Files&gt;'."\n";
echo "\n";
echo '&lt;Files '.$admin_file.'.php&gt;'."\n";
echo '  &lt;Limit GET POST PUT&gt;'."\n";
echo '    require valid-user'."\n";
echo '  &lt;/Limit&gt;'."\n";
echo '  AuthName "Restricted by NukeSentinel(tm)"'."\n";
echo '  AuthType Basic'."\n";
echo '  AuthUserFile '.$ab_config['staccess_path']."\n";
echo '&lt;/Files&gt;'."\n";
echo '#-------------------------------------------'."\n";
echo '# End of NukeSentinel(tm) '.$admin_file.'.php Auth'."\n";
echo '#-------------------------------------------</textarea>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";
echo '</table>'."\n";
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>