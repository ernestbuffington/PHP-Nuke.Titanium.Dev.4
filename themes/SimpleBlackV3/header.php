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

global $ThemeInfo, $sitename, $locked_width;

# This is the flex container used to resize the layout START
echo '<section id="flex-container">'."\n";
//echo '<div class="container" style="width: '.theme_width.'">';
echo '<div class="container" style="width: '.$locked_width.'">'."\n";

echo "<table align=\"center\" width=\"1890px\"><tr><td>";
echo "<table width=\"1890px\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
echo "<table width=\"1890px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "  <td>\n";
echo "<table width=\"1890px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>  \n";
echo "    <td width=\"87\"><img src=\"themes/SimpleBlackV3/images/hd/hd_01.png\" width=\"87\" height=\"20\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV3/images/hd/hd_02.png)\"><img src=\"themes/SimpleBlackV3/images/hd/hd_02.png\" width=\"1\" height=\"20\" alt=\"DFG\"></td>\n";
echo "    <td width=\"87\"><img src=\"themes/SimpleBlackV3/images/hd/hd_04.png\" width=\"87\" height=\"20\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "<table width=\"1890px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"42\"><img src=\"themes/SimpleBlackV3/images/hd/hd_05.png\" width=\"42\" height=\"119\" alt=\"DFG\"></td>\n";
echo "    <td width=\"144\" style=\"background-image:url(themes/SimpleBlackV3/images/hd/hd_06.png)\" height=\"119\">$content1</td>\n";
echo "    <td width=\"11\"><img src=\"themes/SimpleBlackV3/images/hd/hd_07.png\" width=\"11\" height=\"119\" alt=\"DFG\"></td>\n";
echo "    <td width=\"233\"><img src=\"themes/SimpleBlackV3/images/hd/hd_08.png\" width=\"233\" height=\"119\" alt=\"DFG\"></td>\n";
$ads = ads(0);
if(empty($ads)) {
echo "    <td style=\"background-image:url(themes/SimpleBlackV3/images/hd/hd_09.png)\"><img src=\"themes/SimpleBlackV3/images/hd/hd_09.png\" width=\"1\" height=\"119\" alt=\"DFG\"></td>\n";
} else {
    echo "          <td style=\"background-image: url(themes/SimpleBlackV3/images/hd/hd_09.png)\">$ads</td>\n";
}
echo "    <td width=\"60\"><img src=\"themes/SimpleBlackV3/images/hd/hd_11.png\" width=\"60\" height=\"119\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";

?>

<table width="1890px" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="87"><img src="themes/SimpleBlackV3/images/hd/hd_12_2.png" width="87" height="48" alt="DFG"></td>
		<td style="background-image:url(themes/SimpleBlackV3/images/hd/hd_17_2.png)">
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
		<td width="87"><img src="themes/SimpleBlackV3/images/hd/hd_18_2.png" width="87" height="48" alt="DFG"></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42"><img src="themes/SimpleBlackV3/images/hd/hd_19.png" width="42" height="17" alt="DFG"></td>
    <td style="background-image:url(themes/SimpleBlackV3/images/hd/hd_20.png)"><img src="themes/SimpleBlackV3/images/hd/hd_20.png" width="1" height="17" alt="DFG"></td>
    <td width="42"><img src="themes/SimpleBlackV3/images/hd/hd_24.png" width="42" height="17" alt="DFG"></td>
  </tr>
</table></td>
</tr>
</table>

