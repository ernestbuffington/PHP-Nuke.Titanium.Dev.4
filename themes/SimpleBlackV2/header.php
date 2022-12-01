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

global $ThemeInfo, $sitename;
global $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $theme_name;
echo "<body>\n";

//FORUM POSTS
$count = 1;
$amount = 18;
$content1 = "<A name= \"scrollingCode\"></A>";
$content1 .="<div style=\"padding-top:12px;\"><font size=\"1\" color=\"#FFFFFF\" face=\"verdana\"><MARQUEE behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"140\" height=\"100\" scrollamount= \"1\" scrolldelay= \"90\" onmouseover='this.stop()' onmouseout='this.start()'>";
$result1 = $db->sql_query("SELECT topic_id, topic_last_post_id, topic_title FROM ".$prefix."_bbtopics ORDER BY topic_last_post_id DESC LIMIT $amount");
$content .= "<br />";
while(list($topic_id, $topic_last_post_id, $topic_title) = $db->sql_fetchrow($result1)) {
$result2 = $db->sql_query("SELECT topic_id, poster_id, FROM_UNIXTIME(post_time,'%b %d, %Y at %T') as post_time FROM ".$prefix."_bbposts where post_id='$topic_last_post_id'");
list($topic_id, $poster_id, $post_time)=$db->sql_fetchrow($result2);

$result3 = $db->sql_query("SELECT username, user_id FROM ".$prefix."_users where user_id='$poster_id'");
list($username, $user_id)=$db->sql_fetchrow($result3);

$content1 .= "<br />&raquo;&nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$topic_last_post_id#$topic_last_post_id\"STYLE=\"font-family: verdana; font-size: 9px;\"><strong>$topic_title</strong></a>&nbsp;<br />";
$count = $count + 1;
}
$content1 .="</center></MARQUEE></font></div></center>\n";

echo "<table width=\"" . $ThemeInfo['sitewidth'] . "\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\"><tr><td>";
echo "<table width=\"100%\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"headerexpand\"><tr><td>";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "  <td>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>  \n";
echo "    <td width=\"87\"><img src=\"themes/SimpleBlackV2/images/hd/hd_01.png\" width=\"87\" height=\"20\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV2/images/hd/hd_02.png)\"><img src=\"themes/SimpleBlackV2/images/hd/hd_02.png\" width=\"1\" height=\"20\" alt=\"DFG\"></td>\n";
echo "    <td width=\"87\"><img src=\"themes/SimpleBlackV2/images/hd/hd_04.png\" width=\"87\" height=\"20\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"42\"><img src=\"themes/SimpleBlackV2/images/hd/hd_05.png\" width=\"42\" height=\"119\" alt=\"DFG\"></td>\n";
echo "    <td width=\"144\" style=\"background-image:url(themes/SimpleBlackV2/images/hd/hd_06.png)\" height=\"119\">$content1</td>\n";
echo "    <td width=\"11\"><img src=\"themes/SimpleBlackV2/images/hd/hd_07.png\" width=\"11\" height=\"119\" alt=\"DFG\"></td>\n";
echo "    <td width=\"233\"><img src=\"themes/SimpleBlackV2/images/hd/hd_08.png\" width=\"233\" height=\"119\" alt=\"DFG\"></td>\n";
$ads = ads(0);
if(empty($ads)) {
echo "    <td style=\"background-image:url(themes/SimpleBlackV2/images/hd/hd_09.png)\"><img src=\"themes/SimpleBlackV2/images/hd/hd_09.png\" width=\"1\" height=\"119\" alt=\"DFG\"></td>\n";
} else {
    echo "          <td style=\"background-image: url(themes/SimpleBlackV2/images/hd/hd_09.png)\">$ads</td>\n";
}
echo "    <td width=\"60\"><img src=\"themes/SimpleBlackV2/images/hd/hd_11.png\" width=\"60\" height=\"119\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="87"><img src="themes/SimpleBlackV2/images/hd/hd_12_2.png" width="87" height="48" alt="DFG"></td>
		<td style="background-image:url(themes/SimpleBlackV2/images/hd/hd_17_2.png)">
			<ul class="sb-navigation">
				<li class="sb-nav-item"><a href="<?php echo $ThemeInfo['link1'] ?>"><?php echo $ThemeInfo['link1text'] ?></a></li>
				<li class="sb-nav-item"><a href="<?php echo $ThemeInfo['link2'] ?>"><?php echo $ThemeInfo['link2text'] ?></a></li>
				<li class="sb-nav-item"><a href="<?php echo $ThemeInfo['link3'] ?>"><?php echo $ThemeInfo['link3text'] ?></a></li>
				<li class="sb-nav-item"><a href="<?php echo $ThemeInfo['link4'] ?>"><?php echo $ThemeInfo['link4text'] ?></a></li>
				<li class="sb-nav-item"><a href="<?php echo $ThemeInfo['link5'] ?>"><?php echo $ThemeInfo['link5text'] ?></a></li>
				<li class="sb-nav-item"><a href="<?php echo $ThemeInfo['link6'] ?>"><?php echo $ThemeInfo['link6text'] ?></a></li>
				<li class="sb-nav-item"><a href="<?php echo $ThemeInfo['link7'] ?>"><?php echo $ThemeInfo['link7text'] ?></a></li>
			</ul>
		</td>
		<td width="87"><img src="themes/SimpleBlackV2/images/hd/hd_18_2.png" width="87" height="48" alt="DFG"></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42"><img src="themes/SimpleBlackV2/images/hd/hd_19.png" width="42" height="17" alt="DFG"></td>
    <td style="background-image:url(themes/SimpleBlackV2/images/hd/hd_20.png)"><img src="themes/SimpleBlackV2/images/hd/hd_20.png" width="1" height="17" alt="DFG"></td>
    <td width="42"><img src="themes/SimpleBlackV2/images/hd/hd_24.png" width="42" height="17" alt="DFG"></td>
  </tr>
</table></td>
</tr>
</table></center>
<?php
    echo "\n<table width=\"" . $ThemeInfo['sitewidth'] . "\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
  //  echo "\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
    echo "        <tr valign=\"top\">\n";
    echo "        <td style=\"width: 42px; background-image: url(themes/SimpleBlackV2/images/left.png)\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" width=\"42\" height=\"11\" border=\"0\" alt=\"\" /></td>\n";
    echo "        <td valign=\"top\">\n";

    if(blocks_visible('left')) {
        blocks('left');
        echo "    </td>\n";
        echo " <td style=\"width: 10px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"10\" height=\"1\" border=\"0\" /></td>\n";
        echo " <td width=\"100%\">\n";
    } else {
        echo "    </td>\n";
        echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" /></td>\n";
        echo " <td width=\"100%\">\n";
    }

