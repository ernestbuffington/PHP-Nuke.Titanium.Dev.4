<?php
/*=======================================================================================
 PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System : Using the PHP-Nuke Titanium Core
 ========================================================================================*/
/*****************************************************************************************/
/* MNS-Cortex v.3.0 theme designed by Ernest "TheGhost" Buffington                       */
/* This theme was designed to fit the new generation wide screen monitors                */
/*                                                                                       */
/* MNS-Cortex v.3.0 is a free public theme package designed for PHP-Nuke Titanium        */
/* Copyright (c) 2009 by TheGhost All Rights Reserved                                    */
/*****************************************************************************************/
/* For more commercial and public themes, custom graphics and photoshop tutorials        */
/* visit www.mynetworkspace.in                                                           */
/*****************************************************************************************/
/* For support of this great CMS visit MyNetworkSpace http://www.mynetworkspace.in       */
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
 
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));

function OpenTable()
{
  global $name, $title, $theme_name;
  
  if (($name == 'Forums') || ($name == 'Private_Messages'))
  {
  
   ?>
    <table class=otthree border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
    <td width="15" height="15">
  <img src="themes/<?=$theme_name?>/tables/OpenTable3/Curve-TL.png" width="31" height="31"></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable3/up2.png" align="center" width="100%" height="15">&nbsp;</td>
    <td>
  <img src="themes/<?=$theme_name?>/tables/OpenTable3/Curve-TR.png" width="31" height="31"></td></tr>
    <tr>
    <td background="themes/<?=$theme_name?>/tables/OpenTable3/left2.png" width="15">&nbsp;</td>
    <td width="100%">
	<?
 
  
  }
  else
  {
?>

<table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2"><img src="themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
<td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" width="100%"></td>
<td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
<img src="themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
</tr>
<tr>
<td width="15" background="themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>

<td width="24"></td>

<td width="100%">



<?

 }
}


function CloseTable()
{

  global $name, $theme_name;
  
  if (($name == 'Forums') || ($name == 'Private_Messages'))
  {
  
    ?>
	</td>
    <td background="themes/<?=$theme_name?>/tables/CloseTable3/Curve_Right.png">&nbsp;</td></tr>
    <tr>
      <td>
  <img src="themes/<?=$theme_name?>/tables/CloseTable3/Curve-BL.png" width="31" height="31"></td>
  <td background="themes/<?=$theme_name?>/tables/CloseTable3/Curve-Bottom.png">&nbsp;</td><td>
  <img src="themes/<?=$theme_name?>/tables/CloseTable3/Curve-BR.png" width="31" height="31"></td>
  </tr>
    </td></tr></table>
    <br>
	<?
  
  
  }
  else
  {

?>

</td>

<td width="25"></td>

<td width="15" background="themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td>
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="100%">&nbsp;</td>
		<td align="right" width="39" colspan="2"><img src="themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
	</tr>
</table><br />

<?

 }
}


function OpenTable3() {

 global $theme_name;
 
  ?>
    <table class=otthree border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
    <td width="15" height="15">
  <img src="themes/<?=$theme_name?>/tables/OpenTable3/Curve-TL.png" width="31" height="31"></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable3/up2.png" align="center" width="100%" height="15">&nbsp;</td>
    <td>
  <img src="themes/<?=$theme_name?>/tables/OpenTable3/Curve-TR.png" width="31" height="31"></td></tr>
    <tr>
    <td background="themes/<?=$theme_name?>/tables/OpenTable3/left2.png" width="15">&nbsp;</td>
    <td width="100%">
	<?
}

    
function CloseTable3() {

 global $theme_name;

    ?>
	</td>
    <td background="themes/<?=$theme_name?>/tables/CloseTable3/Curve_Right.png">&nbsp;</td></tr>
    <tr>
      <td>
  <img src="themes/<?=$theme_name?>/tables/CloseTable3/Curve-BL.png" width="31" height="31"></td>
  <td background="themes/<?=$theme_name?>/tables/CloseTable3/Curve-Bottom.png">&nbsp;</td><td>
  <img src="themes/<?=$theme_name?>/tables/CloseTable3/Curve-BR.png" width="31" height="31"></td>
  </tr>
    </td></tr></table>
    <br>
	<?
}


function OpenTable4() {

 global $theme_name;

  ?>

  <?
}

    
function CloseTable4() {

 global $theme_name;

    ?>

	<?
}

function OpenTable2() {

 global $theme_name;

  ?>

  <?
}

    
function CloseTable2() {

 global $theme_name;

    ?>

	<?
}

?>