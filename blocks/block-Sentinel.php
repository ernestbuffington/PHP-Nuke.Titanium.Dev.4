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

if(!defined('NUKE_EVO')) exit;

global $db, $prefix, $ab_config, $currentlang;

$content = '';
$result = $db->sql_query('SELECT `ip_addr`, `reason` FROM `'.$prefix.'_nsnst_blocked_ips` ORDER BY `date` DESC LIMIT 0,10');
while (list($ip_addr, $ip_reason) = $db->sql_fetchrow($result)) {
  if((is_admin() AND $ab_config['display_link']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_link']==2) OR $ab_config['display_link']==3) {
    $lookupip = str_replace('*', '0', $ip_addr);
    $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$ip_addr.'</a>'."\n";
  } else {
    $content .= '<strong><big>&middot;</big></strong>&nbsp;'.$ip_addr."\n";
  }
  if((is_admin() AND $ab_config['display_reason']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_reason']==2) OR $ab_config['display_reason']==3) {
    $result2 = $db->sql_query('SELECT `reason` FROM `'.$prefix.'_nsnst_blockers` WHERE `blocker`=\''.$ip_reason.'\' LIMIT 0,1');
    list($reason) = $db->sql_fetchrow($result2);
    $reason = str_replace('Abuse-','',$reason);
    $content .= '&nbsp;-&nbsp;'.$reason."\n";
  }
  $db->sql_freeresult($result2);
  $content .= '<br />'."\n";
}
$db->sql_freeresult($result);
$content .= '<hr /><center><a href="http://nukescripts.86it.us" target="_blank">'._AB_NUKESENTINEL.'</a></center>'."\n";

?>