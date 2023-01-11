<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

// ==========================================
// PHP-NUKE: Shout Box
// ==========================
//
// Copyright (c) 2003-2005 by Aric Bolf (SuperCat)
// http://www.OurScripts.net
//
// Copyright (c) 2002 by Quiecom
// http://www.Quiecom.com
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation
// ===========================================

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       08/10/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       10/29/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $prefix, $db, $cache;

$module_name = basename(dirname(dirname(__FILE__)));

if (!is_mod_admin($module_name)) 
{
  die("Access Denied");
}

global $currentlang, $sbURL;

if ($currentlang) 
{
  include_once(NUKE_MODULES_DIR.$module_name.'/lang-admin/lang-'.$currentlang.'.php');
} 
else 
{
  include_once(NUKE_MODULES_DIR.$module_name.'/lang-admin/lang-english.php');
}

include_once(NUKE_MODULES_DIR.'Shout_Box/shout.php');

$ThemeSel = get_theme();

global $rowColor;

if (!($rowColor = $cache->load('theme_'.$ThemeSel, 'titanium_shoutbox'))) 
{
    $sql = "SELECT * FROM `".$prefix."_shoutbox_themes` WHERE themeName='$ThemeSel'";
    $result = $db->sql_query($sql);
    $rowColor = $db->sql_fetchrow($result);
    $cache->save('theme_'.$ThemeSel, 'titanium_shoutbox', $rowColor);
    $db->sql_freeresult($result);
}

global $shout_conf;

if (!($shout_conf = $cache->load('conf', 'titanium_shoutbox')))
{
    $sql = "SELECT * FROM `".$prefix."_shoutbox_conf`";
    $result = $db->sql_query($sql);
    $shout_conf = $db->sql_fetchrow($result);
    $cache->save('conf', 'titanium_shoutbox', $shout_conf);
}


$sbURL = 'index.php?url=';

function LinkAdmin() 
{
  global $admin_file;
  OpenTable();
  echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=shout\">" . _SHOUT_ADMIN_HEADER . "</a> ]</div>\n";
  echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SHOUT_RETURNMAIN . "</a> ]</div>\n";
  CloseTable();
}

# Start Shout Box 'Menu' code
function ShoutBoxAdminMenu($ShoutMenuOptionActive) 
{
    global $admin_file, $rowColor;

    OpenTable();
    
	$rowColor['border'] = $rowColor['border'] ?? 'none';
	$rowColor['menuColor2'] = $rowColor['menuColor2'] ?? '#000000';
	$rowColor['menuColor1'] = $rowColor['menuColor1'] ?? '#000000';
	
	echo '<br /><div align="center" class="title">'._SHOUTADMIN.'</div><br />'.PHP_EOL;

    echo '<div align="center"><table align="center" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color: none;" nowrap="nowrap">'.PHP_EOL;
    echo '<table align="center" cellpadding="0" cellspacing="1" border="0"><tr><td style="background-color: none;" nowrap="nowrap">'.PHP_EOL;
    echo '<table align="center" cellpadding="1" cellspacing="2" border="0"><tr style="cursor: hand; text-align: center;">'.PHP_EOL;

    echo '<td style="background-color: none;"><table cellpadding="6" cellspacing="0" border="0"><tr>'.PHP_EOL;

    if($ShoutMenuOptionActive == 1) 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=manageShouts">'._MANAGESHOUTS.'</a>&nbsp;&nbsp;</td></tr></table></td>';
	else 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=manageShouts">'._MANAGESHOUTS.'</a>&nbsp;&nbsp;</td></tr></table></td>';

    echo '<td style="background-color: none;"><table cellpadding="6" cellspacing="0" border="0"><tr>'.PHP_EOL;
    
	if ($ShoutMenuOptionActive == 2) 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxLayout">'._SB_LAYOUT.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;
	else 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxLayout">'._SB_LAYOUT.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;

    echo '<td style="background-color: '.$rowColor['border'].';"><table cellpadding="6" cellspacing="0" border="0"><tr>'.PHP_EOL;
    
	if ($ShoutMenuOptionActive == 3) 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxThemeing">'._SB_THEMEING.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;
	else 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxThemeing">'._SB_THEMEING.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;

    echo '<td style="background-color: '.$rowColor['border'].';"><table cellpadding="6" cellspacing="0" border="0"><tr>'.PHP_EOL;
    
	if ($ShoutMenuOptionActive == 4) 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxPermissions">'._SB_PERMISSIONS.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;
	else 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxPermissions">'._SB_PERMISSIONS.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;

    echo "<td style=\"background-color: ".$rowColor['border'].";\"><table cellpadding=\"6\" cellspacing=\"0\" border=\"0\"><tr>";
    
	if ($ShoutMenuOptionActive == 5) 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=manageemoticons">'._SB_EMOTICONS.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;
	else 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=manageemoticons">'._SB_EMOTICONS.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;

    echo "<td style=\"background-color: ".$rowColor['border'].";\"><table cellpadding=\"6\" cellspacing=\"0\" border=\"0\"><tr>";
    
	if ($ShoutMenuOptionActive == 6) 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=managecensor">'._SB_CENSOR.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;
	else 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=managecensor">'._SB_CENSOR.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;

    echo "<td style=\"background-color: ".$rowColor['border'].";\"><table cellpadding=\"6\" cellspacing=\"0\" border=\"0\"><tr>";
    
	if ($ShoutMenuOptionActive == 7) 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxBans">'._SB_BANS.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;
	else 
      echo '<td style="background-color: none;"><a class="buttonlink" href="'.$admin_file.'.php?op=shout&amp;Submit=ShoutBoxBans">'._SB_BANS.'</a>&nbsp;&nbsp;</td></tr></table></td>'.PHP_EOL;

    echo "</tr></table>\n";
    echo "</td></tr></table></td></tr></table></div>";

    CloseTable();
    
}
# End Shout Box 'Menu' code

// Start 'Manage Shouts' code (Default page)

function manageShouts($page, $pruned) {
    global $prefix, $db, $admin, $admin_file, $sbURL, $module_name, $shout_conf, $rowColor, $userinfo, $board_config;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $ShoutMenuOptionActive = 1;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    OpenTable();

    $conf = $shout_conf;

    $sql = "SELECT aCount FROM ".$prefix."_shoutbox_manage_count WHERE admin='$admin[0]'";
    $resultA = $db->sql_query($sql);
    $aCount = $db->sql_fetchrow($resultA);
    if (empty($aCount['aCount'])) {
        $sql = "INSERT INTO ".$prefix."_shoutbox_manage_count (admin, aCount) VALUES ('$admin[0]','10')";
        $db->sql_query($sql);
        $aCount['aCount'] = 10;
    }

    echo "<form name=\"manageShouts1\" action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><div class=\"content\">";
    echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr><td style=\"background-color: ".$rowColor['border'].";\">";
    echo "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\"><tr style=\"background-color: ".$rowColor['menuColor1'].";\" align=\"center\">";
    echo "<td width=\"10%\"><strong>"._SB_NICKNAME."</strong></td>";
    echo "<td><strong>"._SB_SHOUT."</strong></td>";
    echo "<td width=\"16%\"><strong>"._SB_DATE." &amp; "._SB_TIME."</strong></td>";
    echo "<td width=\"5%\"><strong>"._DELETE."</strong></td>";
    echo "<td width=\"5%\"><strong>"._EDIT."</strong></td>";
    echo "<td width=\"5%\"><strong>"._BAN."</strong></td>";
    echo "</tr>";

    $sql = "SELECT `id` FROM `".$prefix."_shoutbox_shouts`";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    $db->sql_freeresult($result);
    $numrows2 = $numrows;
    $shout_pages = 1;
    $shoutsViewed = $aCount['aCount'];
    while ($numrows >= $shoutsViewed) {
        $shout_pages++;
        $numrows = ($numrows - $shoutsViewed);
    }
    if ($shout_pages == 0) { $shout_pages = 1; }
    if (!$page) { $page = 1; }
    if ($page < 1) { $page = 1; }
    if ($page > $shout_pages) { $page = $shout_pages; }
    if ($page > 1) {
        $offset = ($page * $shoutsViewed);
        $offset1 = ($offset - $shoutsViewed);
    } else { $offset1 = 0; }

    $shgroup1 = ($page*$aCount['aCount']);
    $shgroup1 = ($shgroup1-$aCount['aCount']);
    $shgroup1 = ($shgroup1+1);
    if ($shgroup1 < 1) { $shgroup1 = 1; }
    $shgroup2 = ($shgroup1-1);

    $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` ORDER BY `id` DESC LIMIT ".$offset1.",".$aCount['aCount'];
    $nameresult = $db->sql_query($sql);
    $x = 1;
    while ($shout = $db->sql_fetchrow($nameresult)) {
        $comment = str_replace('src=', 'src="', $shout['comment']);
        $comment = str_replace('.gif>', '.gif" alt="" />', $comment);
        $comment = str_replace('.jpg>', '.jpg" alt="" />', $comment);
        $comment = str_replace('.png>', '.png" alt="" />', $comment);
        $comment = str_replace('.bmp>', '.bmp" alt="" />', $comment);
        /*$comment = str_replace("http:", "".$sbURL."http:", $comment);
        $comment = str_replace("ftp:", "".$sbURL."ftp:", $comment);*/

        // BB code [b]word[/b] [i]word[/i] [u]word[/u]
        if ((preg_match("#[b]#i", $comment)) && (preg_match("#[/b]#i", $comment)) && (substr_count($comment,"[b]") == substr_count($comment,"[/b]"))) {
            $comment = str_replace("[b]","<span style=\"font-weight: bold\">",$comment);
            $comment = str_replace("[/b]","</span>",$comment);
        }
        if ((preg_match("#[i]#i", $comment)) && (preg_match("#[/i]#i", $comment)) && (substr_count($comment,"[i]") == substr_count($comment,"[/i]"))) {
            $comment = str_replace("[i]","<span style=\"font-style: italic\">",$comment);
            $comment = str_replace("[/i]","</span>",$comment);
        }
        if ((preg_match("#[u]#i", $comment)) && (preg_match("#[/u]#i", $comment)) && (substr_count($comment,"[u]") == substr_count($comment,"[/u]"))) {
            $comment = str_replace("[u]","<span style=\"text-decoration: underline\">",$comment);
            $comment = str_replace("[/u]","</span>",$comment);
        }

        // check to see if nickname is a user in the DB
        $sql = "SELECT * FROM `".$prefix."_users` WHERE `username`='".$shout['name']."'";
        $nameresult2 = $db->sql_query($sql);
        $row = $db->sql_fetchrow($nameresult2);
        if ($row && $shout['name'] != "Anonymous" && $shout['comment'] != "Anonymous") {
/*****[BEGIN]******************************************
 [ Mod:     Advanced Username Color            v1.0.5 ]
 ******************************************************/
            echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td nowrap=\"nowrap\"><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$shout[name]\">" . UsernameColor($shout['name']) . "</a></td><td>$comment</td>";
        } else {
            echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td nowrap=\"nowrap\">" . UsernameColor($shout['name']) . "</td><td>".$comment."</td>";
/*****[END]********************************************
 [ Mod:     Advanced Username Color            v1.0.5 ]
 ******************************************************/
        }

        echo "<td nowrap=\"nowrap\">";
        if (!empty($shout['timestamp'])) {
            // reads unix timestamp and formats it to the viewer's timezone
            if (is_user()) {
                $unixTime = FormatDate($userinfo['user_dateformat'], $shout['timestamp'], $userinfo['user_timezone']);
                echo $unixTime;
            } else {
                $unixTime = FormatDate($board_config['default_dateformat'], $shout['timestamp'], $board_config['board_timezone']);
                echo "$unixTime";
            }
        } else {
            echo $shout['date']."&nbsp;".$shout['time'];
        }
        echo "</td>";

        echo "<td align=\"center\"><input type=\"hidden\" name=\"sr$x\" value=\"".$shout['id']."\" /><input type=\"checkbox\" name=\"shr$x\" /></td><td align=\"center\"><a title=\"Edit\" href=\"".$admin_file.".php?op=shout&amp;Submit=ShoutEdit&amp;shoutID=".$shout['id']."&amp;page=$page\">"._EDIT."</a></td>";

        if ($shout['ip'] != 'noip') {
            $sql = "SELECT * FROM `".$prefix."_shoutbox_ipblock` WHERE `name`='".$shout['ip']."' ";
            $nameIPresult = $db->sql_query($sql);
            $nameIProw = $db->sql_fetchrow($nameIPresult);
            $db->sql_freeresult($nameIPresult);
            if ($nameIProw) {
                echo "<td><strong>"._SB_BANNED."</strong></td></tr>";
            } else {
                echo "<td align=\"center\"><a title=\""._BAN."\" href=\"".$admin_file.".php?op=shout&amp;Submit=ban&amp;bid=".$shout['id']."&amp;page=$page\">"._BAN."</a></td></tr>";
            }
        } else {
            echo "<td>&nbsp;</td></tr>";
        }
        $x++;
        $shgroup2++;
    }
    $db->sql_freeresult($nameresult);
    echo "</table></td></tr></table><br />";

    echo "<table cellpadding=\"3\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr>";
    echo "<td width=\"1%\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"adminDropCount2\">";
    if ($aCount['aCount'] == '10') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($aCount['aCount'] == '15') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    if ($aCount['aCount'] == '20') { $SEL3 = " selected=\"selected\""; } else { $SEL3 = ""; }
    if ($aCount['aCount'] == '25') { $SEL4 = " selected=\"selected\""; } else { $SEL4 = ""; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=adminDropCount&amp;aCount=10&amp;page=$page\"$SEL1>10</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=adminDropCount&amp;aCount=15&amp;page=$page\"$SEL2>15</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=adminDropCount&amp;aCount=20&amp;page=$page\"$SEL3>20</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=adminDropCount&amp;aCount=25&amp;page=$page\"$SEL4>25</option></select></td>";

    echo "<td width=\"9%\" nowrap=\"nowrap\">"._VIEWINGSHOUTS.": $shgroup1 - $shgroup2<br />"._TOTALSHOUTS.": $numrows2</td>";

    echo "<td width=\"90%\" align=\"center\" nowrap=\"nowrap\">";
    $num1 = ($page-4);
    if ($num1 < 1) { $num1 = 1; }
    $num2 = ($num1+8);
    if ($num2 > $shout_pages) { $num2 = $shout_pages; }
    $num5 = ($num2-8);
    if ($num5 < $num1) {
        $num1 = $num5;
        if ($num1 < 1) { $num1 = 1; }
    }
    $num3 = ($page-1);
    $num4 = ($page+1);
    $menuLinks = "";

    $count = $num1;
    while ($count <= $shout_pages AND $count <= $num2) {
        if ($count == $page) {
            $menuLinks .= "<strong>$count</strong>";
        } else {
            $menuLinks .= "<a href=\"".$admin_file.".php?op=shout&Submit=manageShouts&amp;page=$count\">$count</a>";
        }
        if ($count < $num2) { $menuLinks .= "&nbsp;&nbsp;"; }
        $count++;
    }

    $menuLinks .= "<br /><br />";
    if ($page > 1) {
        $menuLinks .= "<a href=\"".$admin_file.".php?op=shout&Submit=manageShouts&amp;page=$num3\">"._PREVIOUS."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
    }
    if ($page != $shout_pages) {
        $menuLinks .= _PAGE." $page / <a href=\"".$admin_file.".php?op=shout&Submit=manageShouts&amp;page=$shout_pages\">$shout_pages</a>\n";
    } else {
        $menuLinks .= _PAGE." $page / $shout_pages\n";
    }
    if ($page < $shout_pages) {
        $menuLinks .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=shout&Submit=manageShouts&amp;page=$num4\">"._NEXT."</a>\n";
    }
    echo "$menuLinks";
    echo "</td>";

    echo "<td width=\"10%\" nowrap=\"nowrap\" align=\"right\">";
    echo "<input type=\"hidden\" name=\"listnum\" value=\"$aCount[aCount]\" /><input type=\"hidden\" name=\"Submit\" value=\"shremove\" /><input type=\"hidden\" name=\"page\" value=\"$page\" /><input type=\"submit\" name=\"button\" value=\""._REMOVECHECKEDSHOUTS."\" /></td>";
    echo "</tr></table></div></form>";
    CloseTable();
    
    OpenTable();
    echo "<br /><div align=\"center\" class=\"title\">"._SB_PRUNESHOUTS."</div><br />";
    if ($pruned > 0) {
        echo "<div align=\"center\" class=\"content\"><strong>$pruned</strong> "._SB_SHOUTSPRUNED."</div><br />";
    }
    echo "<center><form name=\"shoutPrune1\" action=\"\" method=\"post\" style=\"margin-bottom: 0px;\">"._SB_PRUNESHOUTSOLDERTHAN."&nbsp;&nbsp;<input type=\"hidden\" name=\"page\" value=\"$page\" /><input type=\"text\" name=\"pruneDays\" value=\"\" maxlength=\"3\" size=\"5\" />&nbsp;&nbsp;"._SB_DAYS."&nbsp;&nbsp;<input type=\"hidden\" name=\"Submit\" value=\"pruneSubmit\" /><input type=\"submit\" name=\"button\" value=\""._SB_DOPRUNE."\" /></form></center>";

    $sql = "SELECT `id` FROM `".$prefix."_shoutbox_shouts` WHERE `timestamp`=''";
    $resultTS = $db->sql_query($sql);
    $TSrows = $db->sql_numrows($resultTS);
    $db->sql_freeresult($resultTS);
    if ($TSrows > 0) {
        echo "<br /><br /><strong>NOTE:</strong> The prune feature only works on shouts that use the new unix timestamp format. You currently have <strong>$TSrows</strong> shouts that are using the old format. Please run the conversion tool that came in the Shout_Box.zip to update your shouts.";
    }
    CloseTable();
    
    OpenTable();
    $sql = "SELECT `id`, `name`, `comment`, `timestamp`, `stickySlot` FROM `nuke_shoutbox_sticky` WHERE `stickySlot`=0";
	$stickyResultA = $db->sql_query($sql);
    $stickyRowA = $db->sql_fetchrow($stickyResultA);
    $db->sql_freeresult($stickyResultA);
    
	$sql = "SELECT `id`, `name`, `comment`, `timestamp`, `stickySlot` FROM `nuke_shoutbox_sticky` WHERE `stickySlot`=1";
    $stickyResultB = $db->sql_query($sql);
    $stickyRowB = $db->sql_fetchrow($stickyResultB);
    $db->sql_freeresult($stickyResultB);
    
	global $userinfo;
    
	echo "<br /><div align=\"center\" class=\"title\">"._SB_STICKYSHOUTS."</div><br />";
    if(!isset($stickyRowA['name']))
	$stickyRowA['name'] = $userinfo['username'];
	if(!isset($stickyRowB['name']))
	$stickyRowB['name'] = $userinfo['username'];

	$stickyRowA['comment'] = $stickyRowA['comment'] ?? '';
	$stickyRowB['comment'] = $stickyRowB['comment'] ?? '';
	
	echo "<center><table align=\"center\" cellpadding=\"5\" cellspacing=\"0\" border=\"0\"><tr><td>".$stickyRowA['name']."&nbsp;&nbsp;</td><td nowrap=\"nowrap\"><form name=\"shoutAdmin20\" action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><input type=\"hidden\" name=\"page\" value=\"$page\" /><input type=\"text\" name=\"stickyShout\" value=\"".$stickyRowA['comment']."\" maxlength=\"150\" size=\"75\" />&nbsp;&nbsp;<input type=\"hidden\" name=\"stickyUsername\" value=\"".$stickyRowA['name']."\" /><input type=\"hidden\" name=\"Submit\" value=\"stickySubmit\" /><input type=\"hidden\" name=\"stickySlot\" value=\"0\" /><input type=\"submit\" name=\"button\" value=\""._SB_SUBMIT."\" /></form></td></tr><tr>";
	
	echo "<td>&nbsp;</td></td></tr>";
	
	echo "<td>".$stickyRowB['name']."&nbsp;&nbsp;</td><td nowrap=\"nowrap\"><form name=\"shoutAdmin21\" action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><input type=\"hidden\" name=\"page\" value=\"$page\" /><input type=\"text\" name=\"stickyShout\" value=\"".$stickyRowB['comment']."\" maxlength=\"150\" size=\"75\" />&nbsp;&nbsp;<input type=\"hidden\" name=\"stickyUsername\" value=\"".$stickyRowB['name']."\" /><input type=\"hidden\" name=\"Submit\" value=\"stickySubmit\" /><input type=\"hidden\" name=\"stickySlot\" value=\"1\" /><input type=\"submit\" name=\"button\" value=\""._SB_SUBMIT."\" /></form></td></tr></table></center>";
    CloseTable();
    // YOU MAY NOT REMOVE, EDIT, OR MARK OUT THE FOLLOWING PAYPAL CODE. IT IS PART OF OUR COPYRIGHT.
    
    OpenTable();
    //echo "<p align=\"center\" class=\"title\">OurScripts.net needs your support!</p>";
    //echo "<p align=\"center\" class=\"content\">Open Source software costs money and time to develop.</p>";
    //echo "<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">";
    //echo "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\" />";
    //echo "<input type=\"hidden\" name=\"business\" value=\"donate@ourscripts.86it.us\" />";
    //echo "<input type=\"hidden\" name=\"item_name\" value=\"Donation to ourscripts.86it.us\" />";
    //echo "<input type=\"hidden\" name=\"no_shipping\" value=\"1\" />";
    //echo "<input type=\"hidden\" name=\"cn\" value=\"Comments\" /><p align=\"center\">";
    //echo "<input type=\"image\" src=\"modules/$module_name/images/paypal.gif\" alt=\"Please donate. Thank you!\" name=\"submit\" title=\"Please donate. Thank you!\" /></p></form><p align=\"center\" class=\"content\">Our community appreciates your monitary support!</p>";
	
	echo "<p align=\"center\" class=\"content\">Released under the <a target=\"_blank\" href=\"".$sbURL."http://www.gnu.org\">GNU/GPL license</a> and distributed by <a target=\"_blank\" href=\"".$sbURL."https://php-nuke-titanium.86it.us\">The Titanium Group</a>.<br />Copyright &copy; 2002-2023 by SuiteSoft Solutions. All rights reserved.</p>";
    CloseTable();
    // END OF COPYRIGHT.
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function pruneSubmit($pruneDays, $page) {
    global $prefix, $db, $admin_file;
    if ($pruneDays > 0 AND is_numeric($pruneDays)) {
        $pruneDays = round($pruneDays);
        if ($pruneDays > 0) {
            $timestamp = time();
            $pruneDays = $pruneDays * 86400;
            $newTimestamp = $timestamp - $pruneDays;

            $sql = "SELECT `id` FROM `".$prefix."_shoutbox_shouts`";
            $result = $db->sql_query($sql);
            $shoutsBefore = $db->sql_numrows($result);
            $db->sql_freeresult($result);

            $sql = "DELETE FROM `".$prefix."_shoutbox_shouts` WHERE `timestamp` <> '' AND `timestamp` < $newTimestamp";
            $db->sql_query($sql);

            $sql = "SELECT `id` FROM `".$prefix."_shoutbox_shouts`";
            $result = $db->sql_query($sql);
            $shoutsAfter = $db->sql_numrows($result);

            $pruned = ($shoutsBefore-$shoutsAfter);
        }
    }
    if (empty($pruned) || $pruned < 0) { $pruned = 0; }
    header("Location: ".$admin_file.".php?op=shout&Submit=manageShouts&page=$page&pruned=$pruned");
    exit;
}

function stickySubmit($stickyShout, $stickyUsername, $stickySlot, $page) {
    global $prefix, $db, $admin_file, $shout_conf;
    if ($stickyShout) {
        $conf = $shout_conf;

        if ($conf['timeOffset'] == 0) {
            $timestamp = time();
        } elseif (strstr($conf['timeOffset'], '+')) {
            $sbTimeMultiplier = str_replace('+', '', $conf['timeOffset']);
            $sbTimeOffset = $sbTimeMultiplier * 3600;
            $sbTimeTemp = time();
            $timestamp = ($sbTimeTemp + $sbTimeOffset);
        } else {
            $sbTimeMultiplier = str_replace('-', '', $conf['timeOffset']);
            $sbTimeOffset = $sbTimeMultiplier * 3600;
            $sbTimeTemp = time();
            $timestamp = ($sbTimeTemp - $sbTimeOffset);
        }

        $stickyShout = htmlspecialchars($stickyShout, ENT_QUOTES);
        $stickyShout = str_replace("&amp;amp;", "&amp;",$stickyShout);

        $sql = "SELECT * FROM `".$prefix."_shoutbox_sticky` WHERE `stickySlot`='$stickySlot'";
        $stickyResult = $db->sql_query($sql);
        $stickyRow = $db->sql_fetchrow($stickyResult);
        $db->sql_freeresult($stickyResult);
        
		if ($stickyRow) {
			$sql = "UPDATE `nuke_shoutbox_sticky` SET `name`='".$stickyRow['name']."',`comment`='".$stickyShout."',`timestamp`='".$timestamp."' WHERE `stickySlot`='".$stickySlot."'";
        } else {
            $sql = "INSERT INTO `".$prefix."_shoutbox_sticky` (name, comment, timestamp, stickySlot) VALUES ('$stickyUsername','$stickyShout','$timestamp','$stickySlot')";
        }
    } else {
        $sql = "DELETE FROM `".$prefix."_shoutbox_sticky` WHERE `stickySlot`='$stickySlot'";
    }
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=manageShouts&page=$page");
    exit;
}

function ShoutEdit($shoutID, $page, $ShoutError) 
{
    global $prefix, $db, $admin_file;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $ShoutMenuOptionActive = 1;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);

    OpenTable();

    $sql = "SELECT `comment` FROM `".$prefix."_shoutbox_shouts` WHERE `id`='$shoutID'";
    $nameresult = $db->sql_query($sql);
    $row = $db->sql_fetchrow($nameresult);
    $db->sql_freeresult($nameresult);

    // strip out link code here (added back in later if saved)
    $ShoutComment = $row['comment'];
    $ShoutComment = str_replace("&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"", "",(string) $ShoutComment);
    $ShoutComment = str_replace("&#91;<a rel=\"nofollow\" href=\"", "",(string) $ShoutComment);
    $ShoutComment = str_replace("&#91;<a target=\"_blank\" href=\"", "",(string) $ShoutComment);
    $ShoutComment = str_replace("&#91;<a href=\"", "",(string) $ShoutComment);
    $ShoutComment = str_replace("\">URL</a>&#93;", "",(string) $ShoutComment);
    $ShoutComment = str_replace("\">FTP</a>&#93;", "",(string) $ShoutComment);
    $ShoutComment = str_replace("\">IRC</a>&#93;", "",(string) $ShoutComment);
    $ShoutComment = str_replace("\">TeamSpeak</a>&#93;", "",(string) $ShoutComment);
    $ShoutComment = str_replace("\">AIM</a>&#93;", "",(string) $ShoutComment);
    $ShoutComment = str_replace("\">Gopher</a>&#93;", "",(string) $ShoutComment);
    $ShoutComment = str_replace("\">E-Mail</a>&#93;", "",(string) $ShoutComment);

    $i = 0;
    $ShoutNew = '';
    $ShoutArray = explode(" ",$ShoutComment);
	$ShoutNew = [];
	$AddyNew = [];
	
    if (is_array($ShoutArray)) {
        foreach($ShoutArray as $ShoutPart) {
            if (preg_match("#mailto:#i", $ShoutPart)) { // find mailto:
                $ShoutPart = str_replace("mailto:", "",(string) $ShoutPart); // strip out mailto:
                $ShoutPart = str_replace("%", " ",(string) $ShoutPart);
                $ShoutPart = trim($ShoutPart);
                // decode address to ascii
                $c = 0;
                $AddyArray = explode(" ",$ShoutPart);
                if (is_array($AddyArray)) {
                    foreach($AddyArray as $AddyPart) {
                        $AddyNew[$c] = chr(hexdec($AddyPart));
                        $c++;
                    }
                }
                $ShoutPart = implode("",$AddyNew);
                $ShoutNew[$i] = "mailto:$ShoutPart"; // add mailto: back in
            } 
			else 
			{ 
			  if(!isset($ShoutPart))
			  $ShoutPart = '';
			  
			  $ShoutNew[$i] = $ShoutPart; 
			}
            $i++;
        }
    }
    $ShoutComment = implode(" ",$ShoutNew);

    // strip smilies code here (added back in later if saved)
    $sql = "SELECT * FROM `".$prefix."_shoutbox_emoticons`";
    $eresult = $db->sql_query($sql);
    while ($emoticons = $db->sql_fetchrow($eresult)) {
        $ShoutComment = str_replace($emoticons['image'],$emoticons['text'],$ShoutComment);
    }
    $db->sql_freeresult($eresult);

    echo "<form name=\"adminshoutedit\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\">\n";
    echo "<table cellpadding=\"3\" cellspacing=\"0\" width=\"90%\" border=\"0\" align=\"center\">\n";
    echo "<tr><td align=\"center\"><span class=\"title\">"._EDITSHOUT."<br /><br /></span></td></tr>\n";
    
	if (($ShoutError) && ($ShoutError != 'none')) 
	{
        echo "<tr><td style=\"background: #FF3333;\"><strong>"._SB_NOTE.":</strong> $ShoutError</td></tr>";
    }
    
	echo "<tr><td align=\"center\"><input type=\"hidden\" name=\"shoutID\" value=\"$shoutID\" /><input type=\"text\" name=\"ShoutComment\" size=\"70\" value=\"$ShoutComment\" maxlength=\"2500\" /><input type=\"hidden\" name=\"page\" value=\"$page\" /><input type=\"hidden\" name=\"Submit\" value=\"ShoutSave\" />&nbsp;&nbsp;<input type=\"submit\" name=\"button\" value=\""._UPDATE."\" /></td></tr><tr><td align=\"center\"><a href=\"".$admin_file.".php?op=shout&amp;Submit=manageShouts&page=$page\">"._CANCELEDIT."</a></td></tr></table></form>\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function ShoutSave($shoutID, $ShoutComment, $page) {
    global $prefix, $db, $admin_file, $shout_conf;
    $conf = $shout_conf;

    $ShoutComment = trim($ShoutComment); // remove whitespace off ends of shout
    $ShoutComment = preg_replace('/\s+/', ' ', $ShoutComment); // convert double spaces in middle of shout to single space
    $num = strlen($ShoutComment);
    if ($num < 1) { $ShoutError = _SHOUTTOOSHORT; }
    if ($num > 2500) { $ShoutError = _SHOUTTOOLONG; }
    if (!$ShoutComment) { $ShoutError = _NOSHOUT; }
    if ($ShoutComment == _SB_MESSAGE) { $ShoutError = _NOSHOUT; }
    $ShoutComment = str_replace(" [.] ", ".",$ShoutComment);
    if (preg_match("#.xxx#i", $ShoutComment) && $conf['blockxxx'] == "yes") {
        $ShoutError = _XXXBLOCKED;
        $ShoutComment = '';
    }
    if (preg_match("#javascript:(.*)#i", $ShoutComment)) {
        $ShoutError =_JSINSHOUT;
        $ShoutComment = "";
    }

    $ShoutComment = htmlspecialchars($ShoutComment, ENT_QUOTES);
    $ShoutComment = str_replace("&amp;amp;", "&amp;",$ShoutComment);

    // Scan for links in the shout. If there is, replace it with [URL] or block it if disallowed
    $i = 0;
    $ShoutNew = '';
	$ShoutNew = [];
    $ShoutArray = explode(" ",$ShoutComment);
    foreach($ShoutArray as $ShoutPart) {
        if (is_array($ShoutPart) == TRUE) { $ShoutPart = $ShoutPart[0]; }
        if (preg_match("#http://#i", $ShoutPart)) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            // fix for users adding text to the beginning of links: HACKhttp://www.website.com
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"http://");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
        } elseif (preg_match("#ftp://#i", $ShoutPart)) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"ftp://");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">FTP</a>&#93;";
        } elseif (preg_match("#irc://#i", $ShoutPart)) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"irc://");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">IRC</a>&#93;";
        } elseif (preg_match("#teamspeak://#i", $ShoutPart)) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"teamspeak://");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">TeamSpeak</a>&#93;";
        } elseif (preg_match("#aim:goim#i", $ShoutPart)) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"aim:goim");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">AIM</a>&#93;";
        } elseif (preg_match("#gopher://#i", $ShoutPart)) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"gopher://");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">Gopher</a>&#93;";
        } elseif (preg_match("#mailto:#i", $ShoutPart)) {
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"mailto:");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            // email encoding to stop harvesters
            $ShoutPart = bin2hex($ShoutPart);
            $ShoutPart = chunk_split($ShoutPart, 2, '%');
            $ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
            $ShoutNew[$i] = "&#91;<a href=\"$ShoutPart\">E-Mail</a>&#93;";
        } elseif (preg_match("#www.#i", $ShoutPart)) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            $ShoutPartL = strtolower($ShoutPart);
            $spot = strpos($ShoutPartL,"www.");
            if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
            $ShoutPart = "http://" . $ShoutPart;
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
        } elseif (preg_match('#@#i', $ShoutPart) AND preg_match('/[\.]/i', $ShoutPart)) {
            //     \b[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}\b

            // email encoding to stop harvesters
            $ShoutPart = bin2hex($ShoutPart);
            $ShoutPart = chunk_split($ShoutPart, 2, '%');
            $ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
            $ShoutNew[$i] = "&#91;<a href=\"mailto:$ShoutPart\">E-Mail</a>&#93;";
        } elseif ((preg_match("/\.(us|tv|cc|ws|ca|de|jp|ro|be|fm|ms|tc|ph|dk|st|ac|gs|vg|sh|kz|as|lt|to)/i", substr("$ShoutPart", -3,3))) OR (preg_match("/\.(com|net|org|mil|gov|biz|pro|xxx)/i", substr("$ShoutPart", -4,4))) OR (preg_match("/\.(info|name|mobi)/i", substr("$ShoutPart", -5,5))) OR (preg_match("/\.(co\.uk|co\.za|co\.nz|co\.il)/i", substr("$ShoutPart", -6,6)))) {
            if ($conf['urlonoff'] == "no") { $ShoutError = _URLNOTALLOWED; break; }
            $ShoutPart = "http://" . $ShoutPart;
            $ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
        } elseif (strlen(html_entity_decode($ShoutPart, ENT_QUOTES)) > 21) {
            $ShoutNew[$i] = htmlspecialchars(wordwrap(html_entity_decode($ShoutPart, ENT_QUOTES), 21, " ", 1), ENT_QUOTES);
            $ShoutNew[$i] = str_replace("[ b]", " [b]",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[b ]", " [b]",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[ /b]", "[/b] ",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[/ b]", "[/b] ",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[/b ]", "[/b] ",$ShoutNew[$i]);

            $ShoutNew[$i] = str_replace("[ i]", " [i]",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[i ]", " [i]",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[ /i]", "[/i] ",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[/ i]", "[/i] ",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[/i ]", "[/i] ",$ShoutNew[$i]);

            $ShoutNew[$i] = str_replace("[ u]", " [u]",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[u ]", " [u]",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[ /u]", "[/u] ",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[/ u]", "[/u] ",$ShoutNew[$i]);
            $ShoutNew[$i] = str_replace("[/u ]", "[/u] ",$ShoutNew[$i]);
        } else { $ShoutNew[$i] = $ShoutPart; }
        $i++;
    }
    if (empty($ShoutError)) { $ShoutComment = implode(" ",$ShoutNew); }

    //Smilies from database
	$ShoutArrayReplace = [];
    $ShoutArrayReplace = explode(" ",$ShoutComment);
    $ShoutArrayScan = $ShoutArrayReplace;
    $sql = "SELECT * FROM `".$prefix."_shoutbox_emoticons`";
    $eresult = $db->sql_query($sql);
    while ($emoticons = $db->sql_fetchrow($eresult)) {
        $i = 0;
        foreach($ShoutArrayScan as $ShoutPart) {
            if ($ShoutPart == $emoticons['text']) { $ShoutArrayReplace[$i] = $emoticons['image']; }
            $i++;
        }
    }
    $db->sql_freeresult($eresult);
    $ShoutComment = implode(" ",$ShoutArrayReplace);

    //look for bad words, then censor them.
    if($conf['censor'] == "yes") {
        $ShoutArrayReplace = explode(" ",$ShoutComment);
        $ShoutArrayScan = $ShoutArrayReplace;
        $sql = "SELECT * FROM `".$prefix."_shoutbox_censor`";
        $cresult = $db->sql_query($sql);
        while ($censor = $db->sql_fetchrow($cresult)) {
            $i = 0;
            if (is_array($ShoutArray)) {
                foreach($ShoutArrayScan as $ShoutPart) {
                    $ShoutPart = strtolower($ShoutPart);
                    $censor['text'] = strtolower($censor['text']);
                    if ($ShoutPart == $censor['text']) { $ShoutArrayReplace[$i] = $censor['replacement']; }
                    $i++;
                }
            }
        }
        $db->sql_freeresult($cresult);
        $ShoutComment = implode(" ",$ShoutArrayReplace);

        /*
        // Phrase censor - Needs work before implementing
        $sql = "SELECT * FROM ".$prefix."_shoutbox_emoticons";
        $eresult = $db->sql_query($sql);
        while ($emoticons = $db->sql_fetchrow($eresult)) {
            $ShoutComment = str_replace($emoticons[1],$emoticons[2],$ShoutComment);
        }
        */
    }

    if (!$ShoutError) {
        $sql = "UPDATE `".$prefix."_shoutbox_shouts` SET `comment`='$ShoutComment' WHERE `id`='$shoutID'";
        $db->sql_query($sql);
    } else {
        header("Location: ".$admin_file.".php?op=shout&Submit=ShoutEdit&shoutID=$shoutID&page=$page&ShoutError=$ShoutError");
        exit;
    }
    header("Location: ".$admin_file.".php?op=shout&Submit=manageShouts&page=$page");
    exit;
}

function shremove($page, $sr, $shr,$listnum) {
    global $prefix, $db, $admin_file;
    for ($x = 1; $x <= $listnum; $x++) {
        if ($shr[$x] == 'on') {
            $sql = "DELETE FROM `".$prefix."_shoutbox_shouts` WHERE `id`='$sr[$x]'";
            $db->sql_query($sql);
        }
    }
    header("Location: ".$admin_file.".php?op=shout&Submit=manageShouts&page=$page");
    exit;
}

function adminDropCount($aCount, $page) {
    global $prefix, $db, $admin_file, $admin;
    $sql = "UPDATE `".$prefix."_shoutbox_manage_count` SET `aCount`='$aCount' WHERE `admin`='$admin[0]'";
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=manageShouts&page=$page");
    exit;
}

// End 'Manage Shouts' code

// Start 'Layout' code

function ShoutBoxLayout() {
    global $prefix, $db, $admin_file, $sbURL, $shout_conf, $rowColor;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $conf = $shout_conf;
    $ShoutMenuOptionActive = 2;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    ShoutBoxAdminMonitor();
    OpenTable();
    echo "<form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><table align=\"center\" width=\"95%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._DISPLAYDATEANDTIMEOFSHOUT."</td><td width=\"30%\" valign=\"middle\" nowrap=\"nowrap\"><select name=\"daten\">";
    if ($conf['date'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['date'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"yes\"$SEL1>"._YES."</option><option value=\"no\"$SEL2>"._NO."</option></select>";
    echo "</td></tr>\n";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._NUMBEROFSHOUTSINBLOCK."</td><td valign=\"middle\"><input type=\"text\" name=\"numbern\" value=\"".$conf['number']."\" /></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._NUMBEROFSHOUTSINHISTORY."</td><td valign=\"middle\"><input type=\"text\" name=\"shoutsperpagehistory\" value=\"".$conf['shoutsperpage']."\" /></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._TABLEHEIGHT."</td><td valign=\"middle\"><input type=\"text\" name=\"heightn\" value=\"".$conf['height']."\" /></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._BLOCKINPUTBOXWIDTH."</td><td valign=\"middle\"><input type=\"text\" name=\"textboxwidth\" value=\"".$conf['textWidth']."\" /></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._SMILIESPERROW."</td><td valign=\"middle\"><input type=\"text\" name=\"smiliesperrow\" value=\"".$conf['smiliesPerRow']."\" /></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._SHOUTSORDER."</td><td valign=\"middle\"><select name=\"reverseshouts\">";
    if ($conf['reversePosts'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['reversePosts'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"yes\"$SEL1>"._OLDESTFIRST."</option><option value=\"no\"$SEL2>"._NEWESTFIRST."</option></select></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._POINTSPERSHOUT."</td><td valign=\"middle\"><input type=\"text\" name=\"pointspershout\" value=\"".$conf['pointspershout']."\" /></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._SAVEABOVESET.":</td><td valign=\"middle\"><input type=\"hidden\" name=\"Submit\" value=\"ShoutBoxLayoutSet\" /><input type=\"submit\" name=\"button\" value=\""._SAVESETS."\" /></td></tr></table></form>";

    CloseTable();
    
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function ShoutBoxLayoutSet($daten, 
                         $numbern, 
						 $heightn, 
					$textboxwidth, 
				   $smiliesperrow, 
				   $reverseshouts, 
				  $pointspershout, 
		    $shoutsperpagehistory, 
			      $serverTimezone) 
{
    global $prefix, $db, $admin_file, $cache;

    $sql = "UPDATE `".$prefix."_shoutbox_conf` 
	
	SET date='$daten', 
	`number`='$numbern', 
	`height`='$heightn', 
	`textWidth`='$textboxwidth', 
	`smiliesPerRow`='$smiliesperrow', 
	`reversePosts`='$reverseshouts', 
	`pointspershout`='$pointspershout', 
	`shoutsperpage`='$shoutsperpagehistory', 
	`serverTimezone`='$serverTimezone' 
	
	WHERE `id`=1";
    
	$db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxLayout");
    exit;
}

function ShoutBoxAdminMonitor() {
    global $prefix, $db, $admin_file, $module_name, $cache;
    OpenTable();
    // Warnings to admins if something isn't set right.
    echo "<p align=\"center\" class=\"content\"><strong>"._SETUPANDSECURITY."</strong></p>";

    CloseTable();
    
}

function shoutHealth($SBhealthCount) 
{
    global $prefix, $db, $admin_file, $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $ShoutMenuOptionActive = 2;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    OpenTable();
    // Warnings to admins if something isn't set right or files are missing.
    echo "<p align=\"center\" class=\"content\"><strong>"._SETUPANDSECURITY."</strong></p>";
    echo "<p align=\"center\" class=\"content\">"._CURRENTCOND.": ";

    if ($SBhealthCount == 0) 
	{ 
	  echo "<strong>"._SBEXCELLENT."</strong>/"._SBMARGINAL."/"._SBCRITICAL."</p>"; 
	}
    elseif ($SBhealthCount == 1) 
	{ 
	  echo _SBEXCELLENT."/<strong>"._SBMARGINAL."</strong>/"._SBCRITICAL."</p>"; 
	}
    elseif ($SBhealthCount == 2) 
	{ 
	  echo _SBEXCELLENT."/"._SBMARGINAL."/<strong>"._SBCRITICAL."</strong></p>"; 
	}

    // Level 1 checks (Marginal)
    $filename = "modules/$module_name/language/index.html";
    if (file_exists($filename) != TRUE) 
	{ 
	   echo "<p class=\"content\"><strong>Missing security file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This security file is used to keep individuals from browsing the backend of your website. Its a 0 byte size file, which gives them a blank screen if they try to browse the directory it is in. You can usually find this file within another directory of your installation of PHP-Nuke and just copy it into this directory.</p>";    }
    
    $filename = "images/blocks/shout_box/index.html";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing security file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This security file is used to keep individuals from browsing the backend of your website. Its a 0 byte size file, which gives them a blank screen if they try to browse the directory it is in. You can usually find this file within another directory of your installation of PHP-Nuke and just copy it into this directory.</p>"; }
    
	$filename = "images/admin/shoutbox.png";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing image file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This image file is used in the PHP-Nuke admin area. It is a good idea to have this uploaded, even if you are using the admin area without images, because you may change your mind later and use admin images. You can obtain this image from the Shout Box installation zip file.</p>"; }

    // Level 2 checks (Critical)
    $filename = "modules/$module_name";
    if (is_dir($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing critical directory:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This directory contains the Shout Box module files. Without it, half of the Shout Box is unavailable for use by the people on your website. Create this directory using cpanel, FTP, or other method.</p>"; }
    
	$filename = "includes/shoutbox.js";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing critical file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This file contains the Shout Box JavaScript code. It is critical to the operation of this Shout Box. You can obtain this file from the Shout Box installation zip file. Then install it into your PHP-Nuke root folder where mainfile.php is.</p>"; }
    
	$filename = "modules/$module_name/copyright.php";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing critical file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This file contains the Shout Box copyright information. It is both legally required and critical to the success of this Shout Box and OurScripts.net. You can obtain this file from the Shout Box installation zip file.</p>"; }
    
	$filename = "modules/$module_name/index.php";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing critical file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This file contains the Shout Box shout history. Without it, half of the Shout Box features are unavailable for use by the people on your website. You can obtain this file from the Shout Box installation zip file.</p>"; }
    
	$filename = "modules/$module_name/language/lang-english.php";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing critical file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This file contains the Shout Box shout history english language definitions. Even if you are not using them at this time, in the future, you may go multi-lingual. You can obtain this file from the Shout Box installation zip file.</p>"; }
    
	$filename = "blocks/block-Titanium_Shout_Box.php";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing critical file:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This file is the core of the Shout Box. Without it, the users on your site will not be able to shout. You can obtain this file from the Shout Box installation zip file.</p>"; }
    
	$filename = "modules/$module_name/images/paypal.gif";
    if (file_exists($filename) != TRUE) { echo "<p class=\"content\"><strong>Missing critical image:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> This image is part of the Shout Box copyright. It is both legally required and critical to the success of this Shout Box and OurScripts.net. You can obtain this file from the Shout Box installation zip file.</p>"; }
    
	$sql = "SELECT * FROM ".$prefix."_shoutbox_shouts";
    $result = $db->sql_query($sql);
    if ($result == NULL) { echo "<p class=\"content\"><strong>Missing critical SQL table:</strong> ".$prefix."_shoutbox_shouts&nbsp;&nbsp;<strong>Recommendation:</strong> Upload the Shout Box SQL installer (SB_SQL_installer.php) and run it to repair the SQL tables. You can obtain this file from the Shout Box installation zip file in the SQL directory. For security reasons, once repaired, delete the SQL installer from your server.</p>"; }
    
	$sql = "SELECT * FROM ".$prefix."_shoutbox_censor";
    $result = $db->sql_query($sql);
    if ($result == NULL) { echo "<p class=\"content\"><strong>Missing critical SQL table:</strong> ".$prefix."_shoutbox_censor&nbsp;&nbsp;<strong>Recommendation:</strong> Upload the Shout Box SQL installer (SB_SQL_installer.php) and run it to repair the SQL tables. You can obtain this file from the Shout Box installation zip file in the SQL directory. For security reasons, once repaired, delete the SQL installer from your server.</p>"; }
    
	$sql = "SELECT * FROM ".$prefix."_shoutbox_conf";
    $result = $db->sql_query($sql);
    if ($result == NULL) { echo "<p class=\"content\"><strong>Missing critical SQL table:</strong> ".$prefix."_shoutbox_conf&nbsp;&nbsp;<strong>Recommendation:</strong> Upload the Shout Box SQL installer (SB_SQL_installer.php) and run it to repair the SQL tables. You can obtain this file from the Shout Box installation zip file in the SQL directory. For security reasons, once repaired, delete the SQL installer from your server.</p>"; }
    
	$sql = "SELECT * FROM ".$prefix."_shoutbox_emoticons";
    $result = $db->sql_query($sql);
    if ($result == NULL) { echo "<p class=\"content\"><strong>Missing critical SQL table:</strong> ".$prefix."_shoutbox_emoticons&nbsp;&nbsp;<strong>Recommendation:</strong> Upload the Shout Box SQL installer (SB_SQL_installer.php) and run it to repair the SQL tables. You can obtain this file from the Shout Box installation zip file in the SQL directory. For security reasons, once repaired, delete the SQL installer from your server.</p>"; }
    
	$sql = "SELECT * FROM ".$prefix."_shoutbox_ipblock";
    $result = $db->sql_query($sql);
    if ($result == NULL) { echo "<p class=\"content\"><strong>Missing critical SQL table:</strong> ".$prefix."_shoutbox_ipblock&nbsp;&nbsp;<strong>Recommendation:</strong> Upload the Shout Box SQL installer (SB_SQL_installer.php) and run it to repair the SQL tables. You can obtain this file from the Shout Box installation zip file in the SQL directory. For security reasons, once repaired, delete the SQL installer from your server.</p>"; }
    
	$sql = "SELECT * FROM ".$prefix."_shoutbox_nameblock";
    $result = $db->sql_query($sql);
    if ($result == NULL) { echo "<p class=\"content\"><strong>Missing critical SQL table:</strong> ".$prefix."_shoutbox_nameblock&nbsp;&nbsp;<strong>Recommendation:</strong> Upload the Shout Box SQL installer (SB_SQL_installer.php) and run it to repair the SQL tables. You can obtain this file from the Shout Box installation zip file in the SQL directory. For security reasons, once repaired, delete the SQL installer from your server.</p>"; }
    
	$filename = 'SB_SQL_installer.php';
    $sql = "SELECT * FROM ".$prefix."_shoutbox_version";
    $result = $db->sql_query($sql);
    if ($result == NULL) { echo "<p class=\"content\"><strong>Missing critical SQL table:</strong> ".$prefix."_shoutbox_version&nbsp;&nbsp;<strong>Recommendation:</strong> Upload the Shout Box SQL installer (SB_SQL_installer.php) and run it to repair the SQL tables. You can obtain this file from the Shout Box installation zip file in the SQL directory. For security reasons, once repaired, delete the SQL installer from your server.</p>"; }
	if (file_exists($filename) == TRUE) { echo "<p class=\"content\"><strong>SQL installer for Shout Box exists:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> For security reasons, once you have finished installing, upgrading, or repairing the Shout Box SQL tables, delete the SQL installer from your server.</p>"; }
    
	$filename = 'shout_box_sql_install.php';
    if (file_exists($filename) == TRUE) { echo "<p class=\"content\"><strong>SQL installer for Shout Box exists:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> For security reasons, delete this SQL installer from your server. It is no longer used.</p>"; }

    $filename = 'shout4.6to5.0.php';
    if (file_exists($filename) == TRUE) { echo "<p class=\"content\"><strong>SQL installer for Shout Box exists:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> For security reasons, delete this SQL installer from your server. It is no longer used.</p>"; }

    $filename = 'shout4.0to4.5.php';
    if (file_exists($filename) == TRUE) { echo "<p class=\"content\"><strong>SQL installer for Shout Box exists:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> For security reasons, delete this SQL installer from your server. It is no longer used.</p>"; }

    $filename = 'shout3.5to4.0.php';
    if (file_exists($filename) == TRUE) { echo "<p class=\"content\"><strong>SQL installer for Shout Box exists:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> For security reasons, delete this SQL installer from your server. It is no longer used.</p>"; }

    $filename = 'shout3.01to3.5.php';
    if (file_exists($filename) == TRUE) { echo "<p class=\"content\"><strong>SQL installer for Shout Box exists:</strong> $filename&nbsp;&nbsp;<strong>Recommendation:</strong> For security reasons, delete this SQL installer from your server. It is no longer used.</p>"; }
    $sqlCheck = "SELECT * FROM ".$prefix."_blocks WHERE blockfile='block-$module_name.php'";
    $resultCheck = $db->sql_query($sqlCheck);
    $numrowsCheck = $db->sql_numrows($resultCheck);
    if ($numrowsCheck != 1) {
        echo "<p class=\"content\"><strong>Shout Box block not added:</strong> block-$module_name.php&nbsp;&nbsp;<strong>Recommendation:</strong> You have not added the Shout Box block into PHP-Nuke. Click the Blocks icon in the admin area, scroll down the 'Add a new block' area. In the filename drop down, choose block-$module_name.php. Set 'Who can view this' as 'All Visitors', and click the 'Create Block' button.</p>";
    }
    $rowCheck = $db->sql_fetchrow($resultCheck);
    if (!isset($rowCheck['active'])) 
	{
        echo "<p class=\"content\"><strong>Shout Box block not active:</strong> block-$module_name.php&nbsp;&nbsp;<strong>Recommendation:</strong> Click the Blocks icon in the admin area, scroll down to the 'Blocks Administration' area. In the Functions column and Shout Box row, choose 'Activate'. In the following page, choose 'Yes' to activate the block.</p>";
    }
    if (isset($rowCheck['view']) && ($rowCheck['view'] != 1)) 
	{
        echo "<p class=\"content\"><strong>Shout Box block not publicly viewable:</strong> block-$module_name.php&nbsp;&nbsp;<strong>Recommendation:</strong> Click the Blocks icon in the admin area, scroll down to the 'Blocks Administration' area. In the Functions column and Shout Box row, choose 'Edit'. In the following page, set 'Who can view this' as 'All Visitors', and click the 'Save Block' button.</p>";
    }
    $sqlCheck = "SELECT * FROM ".$prefix."_modules WHERE title='$module_name'";
    $resultCheck = $db->sql_query($sqlCheck);
    $numrowsCheck = $db->sql_numrows($resultCheck);
    if ($numrowsCheck != 1) {
        echo "<p class=\"content\"><strong>Shout Box module not added:</strong> $module_name.php&nbsp;&nbsp;<strong>Recommendation:</strong> You have not added the Shout Box module into PHP-Nuke. Upload the files into the modules directory. You can obtain the files from the Shout Box installation zip file. Once they are uploaded, Click the Modules icon in PHP-Nuke administration. In the Functions column and Shout Box row, choose 'Activate'. In the Functions column and Shout Box row, choose 'Edit'. In the following page, set 'Who can view this' as 'All Visitors', and click the 'Save Changes' button.</p>";
    }
    $rowCheck = $db->sql_fetchrow($resultCheck);
    if ($rowCheck['active'] != 1) {
        echo "<p class=\"content\"><strong>Shout Box module not active:</strong> $module_name&nbsp;&nbsp;<strong>Recommendation:</strong> Click the Modules icon in PHP-Nuke administration. In the Functions column and Shout Box row, choose 'Activate'.</p>";
    }
    if (($rowCheck['view'] != 0) AND ($rowCheck['view'] != 1)) {
        echo "<p class=\"content\"><strong>Shout Box module not publicly viewable:</strong> block-$module_name.php&nbsp;&nbsp;<strong>Recommendation:</strong> Click the Modules icon in PHP-Nuke administration. In the Functions column and Shout Box row, choose 'Edit'. In the following page, set 'Who can view this' as 'All Visitors', and click the 'Save Changes' button.</p>";
    }

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

// End 'Layout' code

// Start Themeing code

function ShoutBoxThemeing() {
    global $prefix, $db, $admin_file, $sbURL, $module_name, $rowColor;
    include_once(NUKE_BASE_DIR.'header.php');
    
	$rowColor['border'] = $rowColor['border'] ?? 'none';
	$rowColor['menuColor2'] = $rowColor['menuColor2'] ?? '#000000';
	$rowColor['menuColor1'] = $rowColor['menuColor1'] ?? '#000000';
	$themeRow['blockBackgroundImage'] = $themeRow['blockBackgroundImage'] ?? '';
	
	LinkAdmin();
    $ShoutMenuOptionActive = 3;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    OpenTable();
    $themelist = '';
    echo "<p align=\"center\" class=\"content\"><strong>"._SB_THEMECOLORING."</strong></p>";

    echo "<form name=\"shoutadmin10\" action=\"\" method=\"post\" style=\"margin-bottom: 0px; margin-top: 0px;\">";
    echo "<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"95%\"><tr><td style=\"background-color: $rowColor[border];\"><table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\">";

    echo "<tr style=\"background-color: ".$rowColor['menuColor1'].";\"><td align=\"center\" width=\"15%\" nowrap=\"nowrap\"><strong>"._SB_THEME."</strong></td><td align=\"center\" nowrap=\"nowrap\" width=\"17%\"><strong>"._SHOUTBOX." 1</strong></td><td align=\"center\" nowrap=\"nowrap\" width=\"17%\"><strong>"._SHOUTBOX." 2</strong></td><td align=\"center\" nowrap=\"nowrap\" width=\"17%\"><strong>"._SB_BORDER."</strong></td><td align=\"center\" nowrap=\"nowrap\" width=\"17%\"><strong>"._SB_MENU."/"._SB_ROW." 1</strong></td><td align=\"center\" nowrap=\"nowrap\" width=\"17%\"><strong>"._SB_MENU."/"._SB_ROW." 2</strong></td></tr>";

    $totalThemes = 0;
    // Start of code from PHP-Nuke 'Your Account' module.
    $handle=opendir('themes');
    while ($file = readdir($handle)) {
        if ( (!preg_match("/[\.]/",$file) AND file_exists(NUKE_THEMES_DIR.$file."/theme.php")) ) {
            $themelist .= "$file ";
        }
    }
    closedir($handle);
    $themelist = explode(" ", $themelist);
    sort($themelist);
    for ($i=0; $i < sizeof($themelist); $i++) {
        if(!empty($themelist[$i])) {
            // End of code from PHP-Nuke 'Your Account' module.
            // Insert default colors to SQL when a new theme is found
            $sql = "SELECT * FROM `".$prefix."_shoutbox_themes` WHERE `themeName`='$themelist[$i]'";
            $result = $db->sql_query($sql);
            $themeRow = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);
            if (empty($themeRow)) {
                $sql = "INSERT INTO `".$prefix."_shoutbox_themes` (themeName, blockColor1, blockColor2, border, menuColor1, menuColor2) VALUES ('$themelist[$i]','#EBEBEB','#FFFFFF','#BBBBBB','#EBEBEB','#FFFFFF')";
                $db->sql_query($sql);
            }
            // End default colors
            $sql = "SELECT * FROM `".$prefix."_shoutbox_themes` WHERE `themeName`='$themelist[$i]'";
            $result = $db->sql_query($sql);
            $themeRow = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);
            echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1'].";\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td align=\"center\" nowrap=\"nowrap\">$themelist[$i]<input type=\"hidden\" name=\"themeName$i\" value=\"$themelist[$i]\" /></td><td align=\"center\"><input type=\"text\" name=\"blockColor1Theme$i\" size=\"11\" value=\"".$themeRow['blockColor1']."\" maxlength=\"15\" /></td><td align=\"center\"><input type=\"text\" name=\"blockColor2Theme$i\" size=\"11\" value=\"".$themeRow['blockColor2']."\" maxlength=\"15\" /></td><td align=\"center\"><input type=\"text\" name=\"borderTheme$i\" size=\"11\" value=\"".$themeRow['border']."\" maxlength=\"15\" /></td><td align=\"center\"><input type=\"text\" name=\"menuColor1Theme$i\" size=\"11\" value=\"".$themeRow['menuColor1']."\" maxlength=\"15\" /></td><td align=\"center\"><input type=\"text\" name=\"menuColor2Theme$i\" size=\"11\" value=\"".$themeRow['menuColor2']."\" maxlength=\"15\" /></td></tr>";
            $totalThemes++;
        }
    }

    echo "</table></td></tr></table>";
    echo "<br /><center><input type=\"hidden\" name=\"totalThemes\" value=\"$totalThemes\" /><input type=\"hidden\" name=\"Submit\" value=\"themeSubmit\" /><input type=\"submit\" name=\"button\" value=\""._SB_SAVECOLORVALUES."\" /></center></form>";
    echo "<br /><center>[ <a target=\"blank\" href=\"".$sbURL."http://www.w3schools.com/css/css_colors.asp\">"._SB_HELPWITHCOLORS."</a> ] [ <a target=\"blank\" href=\"".$sbURL."http://www.nattyware.com/pixie.html\">Pixie</a> ]</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function themeSubmit($themeColorValues, $totalThemes) 
{
    global $prefix, $db, $admin_file, $cache, $ThemeSel;

    for ($x = 0; $x <= $totalThemes; $x++) 
	{
        $themeCurrent = $themeColorValues["themeName"][$x];
        $blockColor1 = $themeColorValues[$themeCurrent]["block1"];
        $blockColor2 = $themeColorValues[$themeCurrent]["block2"];
        $border = $themeColorValues[$themeCurrent]["border"];
        $menuColor1 = $themeColorValues[$themeCurrent]["menu1"];
        $menuColor2 = $themeColorValues[$themeCurrent]["menu2"];
    
	    $sql = "UPDATE `".$prefix."_shoutbox_themes` 
		
		SET `blockColor1`='$blockColor1', 
		    `blockColor2`='$blockColor2', 
			`border`='$border', 
			`menuColor1`='$menuColor1', 
			`menuColor2`='$menuColor2' 
		
		WHERE `themeName`='$themeCurrent'";
        
		$db->sql_query($sql);
        $cache->delete('theme_'.$ThemeSel, 'titanium_shoutbox');
        $cache->resync();
    }
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxThemeing");
    exit;
}

function themeImageSubmit($themeImageValues, $totalThemes) {
    global $prefix, $db, $admin_file;
    for ($x = 0; $x <= $totalThemes; $x++) {
        $themeCurrent = $themeImageValues["themeName"][$x];
        $blockArrowColor = $themeImageValues[$themeCurrent]["blockArrowColor"];
        $blockBackgroundImage = $themeImageValues[$themeCurrent]["blockBackgroundImage"];
        $sql = "UPDATE `".$prefix."_shoutbox_theme_images` SET `blockArrowColor`='$blockArrowColor', `blockBackgroundImage`='$blockBackgroundImage' WHERE `themeName`='$themeCurrent'";
        $db->sql_query($sql);
    }
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxThemeing");
    exit;
}
// End Themeing code

// Start 'Permissions' code

function ShoutBoxPermissions() {
    global $prefix, $db, $admin_file, $shout_conf, $rowColor;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $conf = $shout_conf;
    $ShoutMenuOptionActive = 4;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    OpenTable();
    echo "<table align=\"center\" width=\"95%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._ALLOWANONURLTAGS."</td><td width=\"30%\" valign=\"middle\"><form class=\"content\" name=\"allowurloption\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"urlonoffn\">";
    if ($conf['urlanononoff'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['urlanononoff'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=allowanonurloption&amp;urloption=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=allowanonurloption&amp;urloption=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._ALLOWREGURLTAGS."</td><td width=\"30%\" valign=\"middle\"><form class=\"content\" name=\"allowurloption\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"urlonoffn\">";
    if ($conf['urlonoff'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['urlonoff'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=allowurloption&amp;urloption=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=allowurloption&amp;urloption=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._SB_BLOCKXXX."</td><td width=\"30%\" valign=\"middle\"><form class=\"content\" name=\"blockxxxoption\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"blockxxx\">";
    if ($conf['blockxxx'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['blockxxx'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=blockxxxoption&amp;blockxxx=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=blockxxxoption&amp;blockxxx=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._ALLOWREGDELETE."</td><td width=\"30%\" valign=\"middle\"><form name=\"allowdeloption\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"delyourlastpostn\">";
    if ($conf['delyourlastpost'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['delyourlastpost'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=allowdeloption&amp;deloption=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=allowdeloption&amp;deloption=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._ALLOWANONSSHOUT."</td><td width=\"30%\" valign=\"middle\"><form name=\"allowanonoption\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"anonymouspostn\">";
    if ($conf['anonymouspost'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['anonymouspost'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=allowanonoption&amp;anonoption=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=allowanonoption&amp;anonoption=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr>";

    echo "</table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function allowurloption($urloption) 
{
    global $prefix, $db, $admin_file, $cache;

    $sql = "UPDATE `".$prefix."_shoutbox_conf` SET `urlonoff`='$urloption' WHERE `id`=1";

    $db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxPermissions");
    exit;
}

function blockxxxoption($blockxxx) 
{
    global $prefix, $db, $admin_file, $cache;

    $sql = "UPDATE `".$prefix."_shoutbox_conf` set `blockxxx`='$blockxxx' WHERE `id`=1";

    $db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxPermissions");
    exit;
}

function allowanonurloption($urloption) 
{
    global $prefix, $db, $admin_file, $cache;

    $sql = "UPDATE `".$prefix."_shoutbox_conf` SET `urlanononoff`='$urloption' WHERE `id`=1";
    $db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxPermissions");
    exit;
}

function allowdeloption($deloption) 
{
    global $prefix, $db, $admin_file, $cache;

    $sql = "UPDATE `".$prefix."_shoutbox_conf` SET `delyourlastpost`='$deloption' WHERE `id`=1";

    $db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxPermissions");
    exit;
}

function allowanonoption($anonoption) 
{
    global $prefix, $db, $admin_file, $cache;

    $sql = "UPDATE `".$prefix."_shoutbox_conf` set `anonymouspost`='$anonoption' WHERE `id`=1";

    $db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxPermissions");
    exit;
}

// End 'Permissions' code

// Start 'Emoticons' code

function manageemoticons() {
    global $prefix, $db, $admin_file;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $ShoutMenuOptionActive = 5;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    //Emoticons Here
    $sql = "SELECT * FROM `".$prefix."_shoutbox_emoticons`";
    $nameresult = $db->sql_query($sql);
    $numrows = $db->sql_numrows($nameresult);
    if ($numrows > 0) {
        OpenTable();
        echo "<form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
        for ($shx = 1; $emoticons = $db->sql_fetchrow($nameresult); $shx++) {
            $comment = str_replace('src=', 'src="', $emoticons['image']);
            $comment = str_replace('.gif>', '.gif" alt="" />', $comment);
            $comment = str_replace('.jpg>', '.jpg" alt="" />', $comment);
            $comment = str_replace('.png>', '.png" alt="" />', $comment);
            $comment = str_replace('.bmp>', '.bmp" alt="" />', $comment);
            echo "<tr><td valign=\"middle\">"._EMOTICON.":</td><td><input type=\"text\" name=\"textn$shx\" value=\"".$emoticons['text']."\" />
            <input type=\"hidden\" name=\"idn$shx\" value=\"".$emoticons['id']."\" /><input type=\"hidden\" name=\"idnn$shx\" value=\"".$emoticons['image']."\" />
            - $comment -- <a href=\"".$admin_file.".php?op=shout&amp;Submit=emoticonremove&amp;emoticonremove=".$emoticons['id']."\">"._BBAREMOVE."</a></td></tr>";
        }
        $shx = $shx - 1;
        echo "<tr><td valign=\"middle\">"._UPDATE.":</td><td><input type=\"hidden\" name=\"listnum\" value=\"$shx\" /><input type=\"hidden\" name=\"Submit\" value=\"updateemoticon\" /><input type=\"submit\" name=\"button\" value=\""._UPDATE."\" /></td></tr></table></form>";
        CloseTable();
        
    }
    $db->sql_freeresult($nameresult);
    OpenTable();
    echo "<form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td valign=\"middle\">"._ADDEMOTICON."</td><td><input type=\"text\" name=\"addemoticontext\" value=\"\" /></td>
        </tr><tr><td valign=\"middle\">"._IMAGESOURCE.":</td><td><select name=\"addemoticonimage\">";
    $names = array();
    $handle = opendir(NUKE_IMAGES_DIR."blocks/shout_box");
    while ($file = readdir($handle)) { if ($file != '.' AND $file != '..' AND $file != 'index.html') { array_push($names,$file); } }
    closedir($handle);
    foreach($names as $name) { echo "<option value=\"$name\">$name</option>"; }
    echo "</select></td></tr><tr><td valign=\"middle\">"._UPDATE.":</td><td><input type=\"hidden\" name=\"Submit\" value=\"addemoticon\" /><input type=\"submit\" name=\"button\" value=\""._ADD."\" /></td></tr></table></form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function addemoticon($addemoticonimage, $addemoticontext) {
    global $prefix, $db, $admin_file;
    $addemoticonimage = "<img src=images/blocks/shout_box/$addemoticonimage>";
    $sql = "INSERT INTO `".$prefix."_shoutbox_emoticons` (text, image) VALUES ('$addemoticontext','$addemoticonimage')";
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=manageemoticons");
    exit;
}

function updateemoticon($idn, $textn, $idnn, $listnum) {
    global $prefix, $db, $admin_file;
    for ($x = 1; $x <= $listnum; $x++) {
        $sql = "UPDATE `".$prefix."_shoutbox_emoticons` SET `id`='$idn[$x]', `text`='$textn[$x]', `image`='$idnn[$x]' WHERE `id`='$idn[$x]'";
        $db->sql_query($sql);
    }
    header("Location: ".$admin_file.".php?op=shout&Submit=manageemoticons");
    exit;
}

function emoticonremove($emoticonremove) {
    global $prefix, $db, $admin_file;
    $sql = "DELETE FROM `".$prefix."_shoutbox_emoticons` WHERE `id`='$emoticonremove'";
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=manageemoticons");
    exit;
}

// End 'Emoticons' code

// Start 'Censor' code

function managecensor() {
    global $prefix, $db, $admin_file, $shout_conf, $rowColor;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $conf = $shout_conf;
    $ShoutMenuOptionActive = 6;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    OpenTable();
    echo "<table align=\"center\" width=\"95%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n";
    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._CENSORTEXTONOFF."</td><td width=\"30%\" valign=\"middle\"><form name=\"censoractive\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"censor1\">";
    if ($conf['censor'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['censor'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=censoractive&amp;censoroption=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=censoractive&amp;censoroption=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr></table>";
    CloseTable();
    
    $sql = "SELECT * FROM `".$prefix."_shoutbox_censor`";
    $nameresult = $db->sql_query($sql);
    $numrows = $db->sql_numrows($nameresult);
    if ($numrows > 0) {
        //Bad Words Here
        OpenTable();
        echo "<form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
        echo "<tr><td valign=\"top\">"._CENSOR."</td><td>"._EDITCENSOR."</td></tr>";
        for ($shx = 1; $censor = $db->sql_fetchrow($nameresult); $shx++) {
            echo "<tr><td valign=\"top\">"._REPLACEMENT.":</td><td>
            <input type=\"text\" name=\"censornw$shx\" value=\"".$censor['text']."\" /> -
            <input type=\"text\" name=\"censornr$shx\" value=\"".$censor['replacement']."\" />
            <input type=\"hidden\" name=\"idn$shx\" value=\"$censor[id]\" />
            - <a href=\"".$admin_file.".php?op=shout&amp;Submit=censorremove&amp;censorremove=".$censor['id']."\">"._BBAREMOVE."</a></td></tr>";
        }
        $shx = $shx - 1;
        echo "<tr><td valign=\"top\">"._UPDATE.":</td><td><input type=\"hidden\" name=\"listnum\" value=\"$shx\" /><input type=\"hidden\" name=\"Submit\" value=\"updatecensor\" /><input type=\"submit\" name=\"button\" value=\""._UPDATE."\" /></td></tr></table></form>";
        CloseTable();
        
    }
    $db->sql_freeresult($nameresult);
    OpenTable();
    echo "<form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td valign=\"top\">"._WORDTOCENSOR."</td><td><input type=\"text\" name=\"addcensor\" value=\"\" /></td>
        </tr><tr><td valign=\"top\">"._REPLACEWITH."</td><td><input type=\"text\" name=\"addcensorr\" value=\"\" /></td>
        </tr><tr><td valign=\"top\">"._UPDATE.":</td><td><input type=\"hidden\" name=\"Submit\" value=\"addcensor\" /><input type=\"submit\" name=\"button\" value=\""._ADD."\" /></td></tr></table></form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function censoractive($censoroption) {
    global $prefix, $db, $admin_file;
    $sql = "UPDATE `".$prefix."_shoutbox_conf` SET `censor`='$censoroption' WHERE `id`=1";
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=managecensor");
    exit;
}

function addcensor($addcensor, $addcensorr) 
{
    global $prefix, $db, $admin_file, $cache;

    $sql = "INSERT INTO `".$prefix."_shoutbox_censor` (text, replacement) VALUES ('$addcensor','$addcensorr')";
    $db->sql_query($sql);
    $cache->delete('censor', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=managecensor");
    exit;
}

function updatecensor($censornr, $idn, $censornw, $listnum) {
    global $prefix, $db, $admin_file, $cache;
    for ($x = 1; $x <= $listnum; $x++) {
        $sql = "UPDATE `".$prefix."_shoutbox_censor` SET `id`='$idn[$x]', `text`='$censornw[$x]', `replacement`='$censornr[$x]' WHERE `id`='$idn[$x]'";
        $db->sql_query($sql);
    }
    $cache->delete('censor', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=managecensor");
    exit;
}

function censorremove($censorremove) {
    global $prefix, $db, $admin_file, $cache;
    $sql = "DELETE FROM `".$prefix."_shoutbox_censor` WHERE `id`='$censorremove'";
    $db->sql_query($sql);
    $cache->delete('censor', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=managecensor");
    exit;
}

// End 'Censor' code

// Start 'Bans' code

function ShoutBoxBans() {
    global $prefix, $db, $admin_file, $shout_conf, $rowColor;
    include_once(NUKE_BASE_DIR.'header.php');
    LinkAdmin();
    $conf = $shout_conf;

    $ShoutMenuOptionActive = 7;
    ShoutBoxAdminMenu($ShoutMenuOptionActive);
    OpenTable();
    echo "<table align=\"center\" width=\"95%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td width=\"70%\" valign=\"middle\">"._BANIPONOFF."</td><td width=\"30%\" valign=\"middle\"><form class=\"content\" name=\"ipbanactive\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"ipban1\">";
    if ($conf['ipblock'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['ipblock'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=ipbanactive&amp;banoption=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=ipbanactive&amp;banoption=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr>";

    echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\" onmouseover=\"this.style.backgroundColor='".$rowColor['menuColor1']."';\" onmouseout=\"this.style.backgroundColor='".$rowColor['menuColor2']."';\"><td valign=\"middle\">"._BANNAMEONOFF."</td><td valign=\"middle\"><form name=\"namebanactive\" method=\"post\" action=\"\" style=\"margin-bottom: 0px;\"><select onchange=\"top.location.href=this.options[this.selectedIndex].value\" name=\"nameban1\">";
    if ($conf['nameblock'] == 'yes') { $SEL1 = " selected=\"selected\""; } else { $SEL1 = ''; }
    if ($conf['nameblock'] == 'no') { $SEL2 = " selected=\"selected\""; } else { $SEL2 = ''; }
    echo "<option value=\"".$admin_file.".php?op=shout&amp;Submit=namebanactive&amp;banoption=yes\"$SEL1>"._YES."</option><option value=\"".$admin_file.".php?op=shout&amp;Submit=namebanactive&amp;banoption=no\"$SEL2>"._NO."</option>";
    echo "</select></form></td></tr>";

    echo "</table>";
    CloseTable();
    
    // BANS
    OpenTable();
    echo "<table align=\"center\" width=\"95%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">";

    // banned IPs
    echo "<tr style=\"background-color: ".$rowColor['menuColor1'].";\"><td width=\"70%\" valign=\"middle\">"._ADDIPTOBAN."</td>
        <td width=\"30%\"  valign=\"middle\" nowrap=\"nowrap\"><form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><input type=\"text\" name=\"banip\" value=\"\" />&nbsp;<input type=\"hidden\" name=\"Submit\" value=\"banip\" /><input type=\"submit\" name=\"button\" value=\""._ADD."\" /></form></td></tr>\n";

    $sql = "SELECT * FROM ".$prefix."_shoutbox_ipblock";
    $ipresult = $db->sql_query($sql);
    $numrows = $db->sql_numrows($ipresult);
    if ($numrows > 0) {
        echo "<tr><td colspan=\"2\"><form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\"><tr style=\"background: ".$rowColor['menuColor2'].";\"><td width=\"70%\" valign=\"middle\">"._BANNEDIP."</td><td width=\"30%\" valign=\"middle\" nowrap=\"nowrap\">"._EDITADDRESS."</td></tr>\n";
        for ($shx = 1; $badips = $db->sql_fetchrow($ipresult); $shx++) {
            echo "<tr style=\"background: ".$rowColor['menuColor2'].";\"><td valign=\"middle\">"._IPBANNED.":</td><td valign=\"middle\" nowrap=\"nowrap\"><input type=\"text\" name=\"ipn$shx\" value=\"$badips[name]\" />
            <input type=\"hidden\" name=\"idn$shx\" value=\"$badips[0]\" />- <a href=\"".$admin_file.".php?op=shout&amp;Submit=ipremove&amp;ipremove=".$badips['id']."\">"._BBAREMOVE."</a>
            </td></tr>\n";
        }
        $shx = $shx - 1;
        echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\"><td valign=\"middle\">"._UPDATE.":</td><td valign=\"middle\"><input type=\"hidden\" name=\"listnum\" value=\"$shx\" /><input type=\"hidden\" name=\"Submit\" value=\"updateip\" /><input type=\"submit\" name=\"button\" value=\""._UPDATEIP."\" /></td></tr></table></form></td></tr>\n";
    }
    $db->sql_freeresult($ipresult);

    //Banned names
    if ($numrows > 0) {
        echo "<tr style=\"background-color: ".$rowColor['menuColor1'].";\">";
    } else {
        echo "<tr style=\"background-color: ".$rowColor['menuColor2'].";\">";
    }
    echo "<td valign=\"middle\">"._ADDNAMETOBAN."</td>
        <td valign=\"middle\" nowrap=\"nowrap\"><form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><input type=\"text\" name=\"addname\" value=\"\" />&nbsp;<input type=\"hidden\" name=\"Submit\" value=\"addname\" /><input type=\"submit\" name=\"button\" value=\""._ADD."\" /></form></td></tr>\n";

    $sql = "SELECT * FROM ".$prefix."_shoutbox_nameblock";
    $nameresult = $db->sql_query($sql);
    $numrows = $db->sql_numrows($nameresult);
    if ($numrows > 0) {
        echo "<tr><td colspan=\"2\"><form action=\"\" method=\"post\" style=\"margin-bottom: 0px;\"><table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\"><tr style=\"background: ".$rowColor['menuColor2'].";\"><td width=\"70%\" valign=\"middle\">"._BANNEDNAMES."</td><td width=\"30%\" valign=\"middle\">"._EDITNAME."</td></tr>\n";
        for ($shx = 1; $badnames = $db->sql_fetchrow($nameresult); $shx++) {
            echo "<tr style=\"background: ".$rowColor['menuColor2'].";\"><td valign=\"middle\">"._NAMEBANNED.":</td><td valign=\"middle\" nowrap=\"nowrap\"><input type=\"text\" name=\"namen$shx\" value=\"$badnames[name]\" />
                <input type=\"hidden\" name=\"idn$shx\" value=\"".$badnames['id']."\" />
                - <a href=\"".$admin_file.".php?op=shout&amp;Submit=nameremove&amp;nameremove=".$badnames['id']."\" class=\"content\">"._BBAREMOVE."</a></td></tr>\n";
        }
        $shx = $shx - 1;
        echo "<tr style=\"background: ".$rowColor['menuColor2'].";\"><td valign=\"middle\">"._UPDATE.":</td><td valign=\"middle\"><input type=\"hidden\" name=\"listnum\" value=\"$shx\" /><input type=\"hidden\" name=\"Submit\" value=\"updatename\" /><input type=\"submit\" name=\"button\" value=\""._UPDATENAME."\" /></td></tr></table></form></td></tr>\n";
    }
    $db->sql_freeresult($nameresult);
    echo "</table>";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
}

function namebanactive($banoption) {
    global $prefix, $db, $admin_file, $cache;
    $sql = "UPDATE `".$prefix."_shoutbox_conf` SET `nameblock`='$banoption' WHERE id=1";
    $db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

function ipbanactive($banoption) {
    global $prefix, $db, $admin_file, $cache;
    $sql = "UPDATE `".$prefix."_shoutbox_conf` SET `ipblock`='$banoption' WHERE id=1";
    $db->sql_query($sql);
    $cache->delete('conf', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

function addname($addname) {
    global $prefix, $db, $admin_file, $cache;
    $sql = "INSERT INTO `".$prefix."_shoutbox_nameblock` (name) VALUES ('$addname')";
    $db->sql_query($sql);
    $cache->delete('nameblock', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

function updatename($idn, $namen, $listnum) {
    global $prefix, $db, $admin_file, $cache;
    for ($x = 1; $x <= $listnum; $x++) {
        $sql = "UPDATE `".$prefix."_shoutbox_nameblock` SET `id`='$idn[$x]', `name`='$namen[$x]' WHERE `id`='$idn[$x]'";
        $db->sql_query($sql);
    }
    $cache->delete('nameblock', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

function nameremove($nameremove) {
    global $prefix, $db, $admin_file, $cache;
    $sql = "DELETE FROM `".$prefix."_shoutbox_nameblock` WHERE `id`='$nameremove'";
    $db->sql_query($sql);
    $cache->delete('nameblock', 'titanium_shoutbox');
    $cache->resync();
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

function banip($banip) { // From Bans tab
    global $prefix, $db, $admin_file;
    $sql = "INSERT INTO `".$prefix."_shoutbox_ipblock` (name) VALUES ('$banip')";
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

function addip($addip, $page) { // From Manage shouts tab
    global $prefix, $db, $admin_file;
    $sql = "INSERT INTO `".$prefix."_shoutbox_ipblock` (name) VALUES ('$addip')";
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=manageShouts&page=$page");
    exit;
}

function updateip($ipn, $idn, $listnum) {
    global $prefix, $db, $admin_file;
    for ($x = 1; $x <= $listnum; $x++) {
        $sql = "UPDATE `".$prefix."_shoutbox_ipblock` set `id`='$idn[$x]', `name`='$ipn[$x]' WHERE `id`='$idn[$x]'";
        $db->sql_query($sql);
    }
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

function ipremove($ipremove) {
    global $prefix, $db, $admin_file;
    $sql = "DELETE FROM `".$prefix."_shoutbox_ipblock` WHERE `id`='$ipremove'";
    $db->sql_query($sql);
    header("Location: ".$admin_file.".php?op=shout&Submit=ShoutBoxBans");
    exit;
}

// End 'Bans' code

$page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : '';
$aCount = (isset($_REQUEST['aCount'])) ? $_REQUEST['aCount'] : '';
$Submit = (isset($_REQUEST['Submit'])) ? $_REQUEST['Submit'] : '';
$SBhealthCount = (isset($_REQUEST['SBhealthCount'])) ? $_REQUEST['SBhealthCount'] : '';
$addemoticonimage = (isset($_REQUEST['addemoticonimage'])) ? $_REQUEST['addemoticonimage'] : '';
$addemoticontext = (isset($_REQUEST['addemoticontext'])) ? $_REQUEST['addemoticontext'] : '';
$addemoticontext = (isset($_REQUEST['addemoticontext'])) ? $_REQUEST['addemoticontext'] : '';
$listnum = (isset($_REQUEST['listnum'])) ? (int)$_REQUEST['listnum'] : 0;
$emoticonremove = (isset($_REQUEST['emoticonremove'])) ? $_REQUEST['emoticonremove'] : '';
$addcensor = (isset($_REQUEST['addcensor'])) ? $_REQUEST['addcensor'] : '';
$addcensorr = (isset($_REQUEST['addcensorr'])) ? $_REQUEST['addcensorr'] : '';
$censorremove = (isset($_REQUEST['censorremove'])) ? $_REQUEST['censorremove'] : '';
$banoption = (isset($_REQUEST['banoption'])) ? $_REQUEST['banoption'] : '';
$censoroption = (isset($_REQUEST['censoroption'])) ? $_REQUEST['censoroption'] : '';

switch($Submit) {

    case "adminDropCount":
    adminDropCount($aCount, $page);
    break;

    case "ShoutBoxLayout":
    ShoutBoxLayout();
    break;

    case "ShoutBoxThemeing":
    ShoutBoxThemeing();
    break;

    case "ShoutBoxPermissions":
    ShoutBoxPermissions();
    break;

    case "manageemoticons":
    manageemoticons();
    break;

    case "shoutHealth":
    shoutHealth($SBhealthCount);
    break;

    case "addemoticon":
    addemoticon($addemoticonimage, $addemoticontext);
    break;

    case "updateemoticon":
    for ($x = 1; $x <= $listnum; $x++) {
        $idn[$x] = ${"idn$x"};
        $textn[$x] = ${"textn$x"};
        $idnn[$x] = ${"idnn$x"};
    }
    updateemoticon($idn, $textn, $idnn, $listnum);
    break;

    case "emoticonremove":
    emoticonremove($emoticonremove);
    break;

    case "managecensor":
    managecensor();
    break;

    case "addcensor":
    addcensor($addcensor, $addcensorr);
    break;

    case "updatecensor":
    for ($x = 1; $x <= $listnum; $x++) {
        $censornr[$x] = ${"censornr$x"};
        $idn[$x] = ${"idn$x"};
        $censornw[$x] = ${"censornw$x"};
    }
    updatecensor($censornr, $idn, $censornw, $listnum);
    break;

    case "censorremove":
    censorremove($censorremove);
    break;

    case "ShoutBoxBans":
    ShoutBoxBans();
    break;

    case "namebanactive":
    namebanactive($banoption);
    break;

    case "ipbanactive":
    ipbanactive($banoption);
    break;

    case "censoractive":
    censoractive($censoroption);
    break;

    case "allowanonurloption":
    allowanonurloption($urloption);
    break;

    case "allowurloption":
    allowurloption($urloption);
    break;

    case "blockxxxoption":
    blockxxxoption($blockxxx);
    break;

    case "allowdeloption":
    allowdeloption($deloption);
    break;

    case "allowanonoption":
    allowanonoption($anonoption);
    break;

    case "addname":
    addname($addname);
    break;

    case "ShoutBoxLayoutSet":
    ShoutBoxLayoutSet($daten, $numbern, $heightn, $textboxwidth, $smiliesperrow, $reverseshouts, $pointspershout, $shoutsperpagehistory, $serverTimezone);
    break;

    case "themeSubmit":
    for ($x = 0; $x <= $totalThemes; $x++) {
        $themeColorValues["themeName"][$x] = ${"themeName$x"};
        $themeColorValues["${"themeName$x"}"]["block1"] = ${"blockColor1Theme$x"};
        $themeColorValues["${"themeName$x"}"]["block2"] = ${"blockColor2Theme$x"};
        $themeColorValues["${"themeName$x"}"]["border"] = ${"borderTheme$x"};
        $themeColorValues["${"themeName$x"}"]["menu1"] = ${"menuColor1Theme$x"};
        $themeColorValues["${"themeName$x"}"]["menu2"] = ${"menuColor2Theme$x"};
    }
    themeSubmit($themeColorValues, $totalThemes);
    break;

    case "themeImageSubmit":
    for ($x = 0; $x <= $totalThemes; $x++) {
        $themeImageValues["themeName"][$x] = ${"themeName$x"};
        $themeImageValues["${"themeName$x"}"]["blockArrowColor"] = ${"blockArrowColorTheme$x"};
        $themeImageValues["${"themeName$x"}"]["blockBackgroundImage"] = ${"blockBackgroundImageTheme$x"};
    }
    themeImageSubmit($themeImageValues, $totalThemes);
    break;

    case "updatename":
    for ($x = 1; $x <= $listnum; $x++) {
        $idn[$x] = ${"idn$x"};
        $namen[$x] = ${"namen$x"};
    }
    updatename($idn, $namen, $listnum);
    break;

    case "nameremove":
    nameremove($nameremove);
    break;

    case "banip":
    banip($banip);
    break;

    case "ban":
    $sql = "SELECT ip FROM ".$prefix."_shoutbox_shouts WHERE id='$bid'";
    $idresult = $db->sql_query($sql);
    $banip = $db->sql_fetchrow($idresult);
    $addip = $banip['ip'];
    addip($addip, $page);
    break;

    case "updateip":
    for ($x = 1; $x <= $listnum; $x++) {
        $idn[$x] = ${"idn$x"};
        $ipn[$x] = ${"ipn$x"};
    }
    updateip($ipn, $idn, $listnum);
    break;

    case "ipremove":
    ipremove($ipremove);
    break;

    case "shremove":
    for ($x = 1; $x <= $listnum; $x++) {
        $shr[$x] = ${"shr$x"};
        $sr[$x] = ${"sr$x"};
    }
    shremove($page, $sr, $shr, $listnum);
    break;

    case "ShoutEdit":
    if (empty($ShoutError)) { $ShoutError = 'none'; }
    ShoutEdit($shoutID, $page, $ShoutError);
    break;

    case "ShoutSave":
    ShoutSave($shoutID, $ShoutComment, $page);
    break;

    case "manageShouts":
    if (empty($page)) { $page = "1"; }
    if (empty($pruned)) { $pruned = "0"; }
    manageShouts($page, $pruned);
    break;

    case "stickySubmit":
    stickySubmit($stickyShout, $stickyUsername, $stickySlot, $page);
    break;

    case "pruneSubmit":
    pruneSubmit($pruneDays, $page);
    break;

    default:
    if (empty($page)) { $page = "1"; }
    if (empty($pruned)) { $pruned = "0"; }
    manageShouts($page, $pruned);
    break;
}

?>