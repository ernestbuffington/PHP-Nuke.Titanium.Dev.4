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

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
echo '<html>'."\n";
echo '<head>'."\n";
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTTRACKEDAGENTS;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
if(!isset($modfilter)) $modfilter='';
$totalselected = $pnt_db->sql_numrows($pnt_db->sql_query("SELECT DISTINCT(`user_agent`) FROM `".$pnt_prefix."_nsnst_tracked_ips` GROUP BY 1"));
if($totalselected > 0) {
  echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td><strong>'._AB_USERAGENT.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_IPSTRACKED.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_LASTVIEWED.'</strong></td>'."\n";
  echo '<td align="center"><strong>'._AB_HITS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $pnt_db->sql_query("SELECT `user_agent`, MAX(`date`), COUNT(*) FROM `".$pnt_prefix."_nsnst_tracked_ips` GROUP BY 1");
  while(list($pnt_user_agent, $lastview, $hits) = $pnt_db->sql_fetchrow($result)){
    $trackedips = $pnt_db->sql_numrows($pnt_db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$pnt_prefix."_nsnst_tracked_ips` WHERE `user_agent`='$pnt_user_agent'"));
    $pnt_user_agent = wordwrap($pnt_user_agent, 50, "\n", true);
    $pnt_user_agent = str_replace("&amp;amp;", "&amp;", htmlentities($pnt_user_agent, ENT_QUOTES));
    $pnt_user_agent = str_replace("\n", "<br />\n", $pnt_user_agent);
    echo '<tr bgcolor="#ffffff">'."\n";
    echo '<td>'.$pnt_user_agent.'</td>'."\n";
    echo '<td align="center">'.$trackedips.'</td>'."\n";
    echo '<td align="center">'.date("Y-m-d \@ H:i:s",$lastview).'</td>'."\n";
    echo '<td align="center">'.$hits.'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
} else {
  echo '<center><strong>'._AB_NOAGENTS.'</strong></center>'."\n";
}
echo '</body>'."\n";
echo '</html>';

?>