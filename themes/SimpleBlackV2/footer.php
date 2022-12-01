<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
 ************************************************************************/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {

    exit('Access Denied');

}

global $ThemeInfo;
global $index, $user, $cookie, $banners, $prefix, $db, $admin,  $adminmail, $nukeurl, $theme_name;

    $maxshow = 0;        // Number of downloads to display in the block.

    $a = 1;
    $result = $db->sql_query("SELECT did, title, hits FROM ".$prefix."_file_repository_items ORDER BY date DESC limit 0,$maxshow", $dbi);
    while(list($did, $title, $hits) = $db->sql_fetchrow($result)) 
    {
        $title2 = str_replace("_", " ", "<b>$title</b>");
        $show2 .= $a.': <a href="modules.php?name=File_Repository&amp;action=view&amp;did='.$did.'#'.$did.'">'.$title2.'&nbsp;</a>'.$hits.'<br>';
        $showdownloads = " <A name= \"scrollingCodedownloads\"></A><MARQUEE behavior= \"scroll\" align= \"up\" direction= \"up\" width=\"130\" height=\"63\" scrollamount= \"1\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'><table width=\"100%\"><tr>           <td></td></tr>$show2</table></marquee>";
        $a++;
    }

$maxshow = 0;        // Number of weblinks to dispaly in the block.
$a = 1;

$result = $db->sql_query("select lid, title, hits from ".$prefix."_links_links order by date DESC limit 0,$maxshow", $dbi);
while(list($lid, $title, $hits) = $db->sql_fetchrow($result, $dbi)) {
$title2 = ereg_replace("_", " ", "<b>$title</b>");
$show .= " $a: <a href=\"tblules.php?name=Web_Links&l_op=viewlinkdetails&lid=$lid&ttitle=$title\">&nbsp$title2&nbsp;</a><b><font class=\"content\">$hits</b><font class=\"copyright\"><br>";
$showlinks = " <A name= \"scrollingCode\"></A><MARQUEE behavior= \"scroll\" align= \"up\" direction= \"up\" width=\"130\" height=\"63\" scrollamount= \"1\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>$show";
$a++;

}
    // Banner in the middle of the site

    if (blocks_visible('right') && !defined('ADMIN_FILE')) {
        echo "</td>\n";
        echo "        <td style=\"width: 10px;\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"10\" height=\"1\" /></td>\n";
        echo "       <td style=\"width: 168px;\" valign=\"top\">\n";
        blocks('right');
    }
    echo "        </td>\n";
    echo "        <td style=\"width: 42px; background-image: url(themes/SimpleBlackV2/images/right.png)\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\"  width=\"42\" height=\"11\" /></td>\n";
    echo "        </tr>\n";
    echo "</table>\n\n\n";

echo "<table width=\"" . $ThemeInfo['sitewidth'] . "\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\"><tr><td>";
echo "<table width=\"100%\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"headerexpand\"><tr><td>";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "  <td>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"43\"><img src=\"themes/SimpleBlackV2/images/ft/ft_02.png\" width=\"43\" height=\"30\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV2/images/ft/ft_03.png)\"><img src=\"themes/SimpleBlackV2/images/ft/ft_03.png\" width=\"1\" height=\"30\" alt=\"DFG\"></td>\n";
echo "    <td width=\"43\"><img src=\"themes/SimpleBlackV2/images/ft/ft_05.png\" width=\"43\" height=\"30\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"43\"><img src=\"themes/SimpleBlackV2/images/ft/ft_06.png\" width=\"43\" height=\"74\" alt=\"DFG\"></td>\n";
echo "    <td width=\"144\" style=\"background-image:url(themes/SimpleBlackV2/images/ft/ft_07.png)\"><div align=\"center\">$showdownloads</div></td>\n";
echo "    <td width=\"8\"><img src=\"themes/SimpleBlackV2/images/ft/ft_08.png\" width=\"8\" height=\"74\" alt=\"DFG\"></td>\n";
//COPYRIGHT: DO NOT REMOVE, EDIT, MODIFY, OR DELETE, MUST STAY INTACT
echo "		<td style=\"width: 100%; background-image: url(themes/SimpleBlackV2/images/ft/ft_09.png)\" height=\"74\" />\n";
echo "<center><font color=\"#CCCCCC\" class=\"ftrt\"><strong><a href=\"http://www.phpnuke.org\" target=\"_blank\">PHP-Nuke</a> Copyright &copy; 2006 By: Francisco Burzi.<br />
SimpleBlack V2 By: Killigan @ <a href=\"http://www.darkforgegfx.com\" target=\"_blank\">DarkForge Graphics</a><br />Powered By: <a href=\"http://www.evolution-xtreme.com\">Evolution-Xtreme</a></strong></font></center></td>\n";
echo "		<td>\n";
echo "    <td width=\"8\"><img src=\"themes/SimpleBlackV2/images/ft/ft_11.png\" width=\"8\" height=\"74\" alt=\"DFG\"></td>\n";
echo "    <td width=\"144\" style=\"background-image:url(themes/SimpleBlackV2/images/ft/ft_12.png)\"><div align=\"center\">$showlinks</div></td>\n";
echo "    <td width=\"43\"><img src=\"themes/SimpleBlackV2/images/ft/ft_13.png\" width=\"43\" height=\"74\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"43\"><img src=\"themes/SimpleBlackV2/images/ft/ft_14.png\" width=\"43\" height=\"19\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV2/images/ft/ft_15.png)\"><img src=\"themes/SimpleBlackV2/images/ft/ft_15.png\" width=\"1\" height=\"19\" alt=\"DFG\"></td>\n";
echo "    <td width=\"43\"><img src=\"themes/SimpleBlackV2/images/ft/ft_18.png\" width=\"43\" height=\"19\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "</td>\n";
echo "</tr>\n";
echo "</table></center>\n";

?>
