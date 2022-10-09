<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $prefix, $db, $user, $admin, $ab_config, $currentlang;

$usemarquee = 1;
$scrolldirection = "Down";
$content = "";
$content .= "<table border=1><tr><td align=\"center\" valign=\"top\"> "._AB_LIST."</td></tr></table><hr />\n";
$content .= "<marquee Behavior=\"Scroll\" Direction=\"$scrolldirection\" Height=\"150\" ScrollAmount=\"1\" ScrollDelay=\"75\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\"><br />";
$result = $db->sql_query("SELECT `ip_addr`, `reason` FROM `".$prefix."_nsnst_blocked_ips` ORDER BY `date` DESC LIMIT 30");
while (list($ip_addr, $ip_reason) = $db->sql_fetchrow($result)) {
  if((is_admin() AND $ab_config['display_link']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_link']==2) OR $ab_config['display_link']==3) {
    $lookupip = str_replace("*", "0", $ip_addr);
    $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$ab_config['lookup_link']."$lookupip\" target=\"_blank\">$ip_addr</a>\n";
  } else {
    $content .= "<strong><big>&middot;</big></strong>&nbsp;$ip_addr\n";
  }
  if((is_admin() AND $ab_config['display_reason']==1) OR ((is_user() OR is_admin()) AND $ab_config['display_reason']==2) OR $ab_config['display_reason']==3) {
    $result2 = $db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='$ip_reason'");
    list($reason) = $db->sql_fetchrow($result2);
    $db->sql_freeresult($result2);
    $reason = str_replace("Abuse-","",$reason);
    $content .= "&nbsp;-&nbsp;$reason\n";
  }
  $content .= "<br />\n";
}
$db->sql_freeresult($result);
$content .= "</marquee><br />";
$content .= "<hr /><center><a href=\"http://nukescripts.86it.us\" target=\"_blank\">"._AB_NUKESENTINEL." ".$ab_config['version_number']."</a></center>\n";

?>