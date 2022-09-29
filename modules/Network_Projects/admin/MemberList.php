<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/

global $titanium_db2;

if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }

$pagetitle = _NETWORK_TITLE.' v'.$pj_config['version_number'].' - '._NETWORK_MEMBERS.': '._NETWORK_MEMBERLIST;

include_once(NUKE_BASE_DIR.'header.php');

pjadmin_menu(_NETWORK_MEMBERS.": "._NETWORK_MEMBERLIST);

$memberresult = $titanium_db2->sql_query("SELECT `member_id`, `member_name` FROM `".$network_prefix."_members` ORDER BY `member_name`");
$member_total = $titanium_db2->sql_numrows($memberresult);

OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='3' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._NETWORK_MEMBEROPTIONS."</strong></nobr></td></tr>\n";
$pjimage = pjimage("options.png", $titanium_module_name);
echo "<tr><td><img src='$pjimage'></td><td colspan=2 width='100%'><nobr><a href='".$admin_file.".php?op=MemberAdd'>"._NETWORK_MEMBERADD."</a></nobr></td></tr>\n";
$pjimage = pjimage("stats.png", $titanium_module_name);
echo "<tr><td><img src='$pjimage'></td><td colspan=2 width='100%'><nobr>"._NETWORK_MEMBERS.": <strong>$member_total</strong></nobr></td></tr>\n";
echo "</table>\n";

echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>\n";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._NETWORK_MEMBERS."</strong></a></td><td align='center' bgcolor='$bgcolor2'><strong>"._NETWORK_FUNCTIONS."</strong></td></tr>\n";

if($member_total != 0)
{
  while(list($member_id, $member_name) = $titanium_db2->sql_fetchrow($memberresult)) 
  {
    $pjimage = pjimage("member.png", $titanium_module_name);
    echo "<tr><td><img src='$pjimage'></td><td width='100%'>$member_name</td>\n";
    echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=MemberEdit&amp;member_id=$member_id'>"._NETWORK_EDIT."</a>";
    echo " | <a href='".$admin_file.".php?op=MemberRemove&amp;member_id=$member_id'>"._NETWORK_DELETE."</a> ]</nobr></td></tr>\n";
  }
} 
else 
{
  echo "<tr><td width='100%' colspan='3' align='center'>"._NETWORK_NOMEMBERS."</td></tr>\n";
}
echo "</table>\n";

CloseTable();

pj_copy();

include_once(NUKE_BASE_DIR.'footer.php');
?>
