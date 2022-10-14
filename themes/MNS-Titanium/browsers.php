<?php
/*=======================================================================================
 PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System : Using the Nuke-Evolution Core
 ========================================================================================*/
/*****************************************************************************************/
/* MNS-CarbinFiber v.3.0 theme designed by Ernest "TheGhost" Buffington                  */
/* This theme was designed to fit the new generation wide screen monitors                */
/*                                                                                       */
/* MNS-CarbinFiber v.3.0  is a free public theme package designed for PHP-Nuke Titanium  */
/* Copyright (c) 2009 by TheGhost All Rights Reserved                                    */
/*****************************************************************************************/
/* For more commercial and public themes, custom graphics and photoshop tutorials        */
/* visit www.mynetworkedspace.com                                                        */
/*****************************************************************************************/
/* For support of this great CMS visit MyNetworkedSpace http://www.mynetworkedspace.com  */
/*****************************************************************************************/
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi http://phpnuke.org                     */
/*****************************************************************************************/
/*****[CHANGES]*****************************************************************************************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
      Theme Management                         v1.0.2       12/14/2005       
	  MyNetworkSpace Patched                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  SWF Header Class                         v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Resolution Checker                       v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Detect Browser Type                      v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Page Loading Animation                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Safari Browser Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  FireFox Browser Support                  v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Internet Explorer Support                v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  File Extension Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
 ********************************************************************************************************************************************************/
include(dirname(dirname(dirname(__FILE__))).'/mainfile.php');

$theme_name = basename(dirname(__FILE__));

global $domain;

echo "<LINK REL=\"StyleSheet\" HREF=\"../../themes/".$theme_name."/style/style.css\" TYPE=\"text/css\">\n\n\n";


?>
<style type="text/css">
<!--
.otthree tr td center strong {
	color: #FFF;
}
-->
</style>
<table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td background="../../themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2"><img src="../../themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
<td background="../../themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" width="100%">
<center><strong><?=$theme_name?> 4.0 Design and Development Information</strong></center>
</td>
<td background="../../themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
<img src="../../themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
</tr>
<tr>
<td width="15" background="../../themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>

<td width="24"></td>

<td width="100%">
<?
echo "         <img src=\"http://".$domain."/images/admin/surveys.png\"><br />";

echo "<strong>Design and Development Information</strong><br /><br />";
echo "This theme is still being designed and developed. MyNetworkedSpace is always under construction. As changes are made to the internal network, we will try to make sure that all of our MyNetworkedSpace themes are updated accordingly. If you have a theme that you would like to use here at MyNetworkedSpace and it has not already been made available or ported, you may submit a request to have it ported. Look around on the internet for custom PHP-Nuke themes or custom Nuke-Evolution Themes and when you find one that you like just let us know. You can send requests to the MyNetworkedSpace Webmaster, you can do so by clicking on the following link. <br />
<a href=\"http://".$domain."/modules.php?name=Private_Messages&mode=post&u=2\">CLICK HERE</a> <font color=\"#FF0000\"> ( Note : You must have an account and be logged in to use 
this link )</font><br /><br />";
echo "<strong>Software used in the development of the MNS-Titanium theme</strong><br /><br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Adobe Dreamweaver CS5 v11 Build 4993<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Microsoft Frontpage 2003 (11.8164.8221)<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  PaintShop Pro v9.01<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Ultra Edit v15<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Flash FXP v 4.3.5 (used to upload and download files via FTP)<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  VMware Worksation build-126130 (used to run multiple copies of Dreamweaver)<br />";

echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Windows 7 Ultimate Edition<br />";

echo "<br />This theme was designed by Ernest \"TheGhost\" Buffington<br>";
echo "Website : http://theghost.mynetworkedspace.com<br>";
echo "E-Mail : theghost[at]mynetworkedspace[dot]com<br><br>";

//echo "<br /><br />This theme was built with the graphics design assistance of Dave \"Ph03niX\" Schmidt<br>";
//echo "Website : http://www.onlinegamerzhq.com<br>";
//echo "E-Mail : ph03nix[at]underground51[dot]com<br><br>";


?>
</td>
<td width="25"></td>
<td width="15" background="../../themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td>
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="../../themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="../../themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="100%">&nbsp;</td>
<td align="right" width="39" colspan="2"><img src="../../themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
</tr>
</table><br />
<?
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<style type="text/css">
<!--
.otthree tr td center strong {
	color: #FFF;
}
-->
</style>
<table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td background="../../themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2"><img src="../../themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
<td background="../../themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" width="100%">
<center><strong><?=$theme_name?> v4.0 Browser Compatibility Information</strong></center>
</td>
<td background="../../themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
<img src="../../themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
</tr>
<tr>
<td width="15" background="../../themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>

<td width="24"></td>

<td width="100%">
<?
echo "         <img src=\"http://".$domain."/images/admin/weblinks.png\"><br />";

echo "<strong>100% Compatible Browsers</strong><br /><br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Safari v4.0.3 (531.9.1)<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Maxthon v2.5.8.1332 UNICODE<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  FireFox v7.0.1<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Opera v11.51 Build 1750<br />";
echo "<img src=\"http://".$domain."/images/titanium_user_info/orange.png\">";
echo "  Chrome v15.0.874.83 beta-m<br />";


?>
</td>
<td width="25"></td>
<td width="15" background="../../themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td>
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="../../themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="../../themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="100%">&nbsp;</td>
<td align="right" width="39" colspan="2"><img src="../../themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
</tr>
</table><br />
<?
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>