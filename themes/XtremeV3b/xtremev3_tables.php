<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));

/********************************************************************************************************************************************************/
function MusicTopicsExtendedOpen() 
{
  global $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor2, $pagetitle;
  
echo"<table class=\"maintable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
  . "<tr>"
  . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
  . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
  
  . "<td valign=\"middle\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
  . "<center><strong><font color =\"$textcolor1\">$pagetitle</font></strong></center>"
  . "</td>"
  
  . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
  . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
  . "</tr>"
  . "<tr>"
  . "<td width=\"15\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
  . "<td width=\"24\"></td>"
  . "<td width=\"100%\">";

}

    
function MusicTopicsExtendedClose() 
{
        global $theme_name, $screen_res, $screen_width, $screen_height;
		
?>

</td>

<td width="25"></td>

<td width="15" background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td> 
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="100%">&nbsp;</td>
		<td align="right" width="39" colspan="2"><img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
	</tr>
</table>
<?
global $ThemeSel;  
echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" height=7><br>\n";
}

#########################################################################
# Table Header Message Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
function OpenTableSurvey($title='')
{
  global $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor1, $sitename;
  
echo"<table class=\"maintable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
  . "<tr>"
  . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
  . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
  
  . "<td valign=\"middle\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
  . "<center><strong><font color =\"$textcolor1\">$title</font></strong></center>"
  . "</td>"
  
  . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
  . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
  . "</tr>"
  . "<tr>"
  . "<td width=\"15\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
  . "<td width=\"24\"></td>"
  . "<td width=\"100%\">";
}
#######################################################################
# Table Header Message Fix End - by TheGhost   v1.0.0     01/30/2012
#######################################################################

#########################################################################
# Table Header Message Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
function OpenTableMessage($title='')
{
  global $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor1, $sitename;
  
echo"<table class=\"maintable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
  . "<tr>"
  . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
  . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
  
  . "<td valign=\"middle\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
  . "<center><strong><font color =\"$textcolor1\">$sitename » $title</font></strong></center>"
  . "</td>"
  
  . "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
  . "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
  . "</tr>"
  . "<tr>"
  . "<td width=\"15\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
  . "<td width=\"24\"></td>"
  . "<td width=\"100%\">";
}
#######################################################################
# Table Header Message Fix End - by TheGhost   v1.0.0     01/30/2012
#######################################################################

#########################################################################
# Table Header Module Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
function OpenTableModule()  
{
  global $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor2, $pagetitle;

echo "<opentablemodule>";  
echo "<table class=\"maintable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr>";
echo "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">";
echo "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>";
echo "<td valign=\"middle\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">";
echo "<center><strong><font color =\"$textcolor1\">$pagetitle</font></strong></center>";
echo "</td>";
echo "<td background=\"".HTTPS."themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">";
echo "<img src=\"".HTTPS."themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>";
echo "</tr>";
echo "<tr>";
echo "<td width=\"15\" background=\"".HTTPS."themes/$theme_name/tables/OpenTable/leftside.png\"></td>";
echo "<td width=\"24\"></td>";
echo "<td width=\"100%\">";
echo "</opentablemodule>";  
}


#######################################################################
# Table Header Module Fix End - by TheGhost   v1.0.0     01/30/2012
#######################################################################


function OpenTable()
{
  global $name, $title, $theme_name;
  
  if (($name == 'A') || ($name == 'Z'))
  {
  
   ?>


  <?
 
  
  }
  else
  {
?>

<table class="maintable" border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">
<img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
<td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" width="100%"></td>
<td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
<img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
</tr>
<tr>
<td width="15" background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>
<td width="24"></td>
<td width="100%">



<?

 }
}


function CloseTable()
{

  global $name, $ThemeSel, $theme_name;
  
?>
</td>
<td width="25"></td>
<td width="15" background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td>
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="100%">&nbsp;</td>
<td align="right" width="39" colspan="2"><img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
</tr>
</table>
<?
  echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" height=7><br>\n";
}

function OpenFancyTable() 
{
 global $theme_name;
 $ThemeSel = get_theme();
  
  ?>
    <table class="jason" border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
    <td width="15" height="15">
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/Curve-TL.png" width="31" height="31"></td>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/up2.png" align="center" width="100%" height="15">&nbsp;</td>
    <td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/Curve-TR.png" width="31" height="31"></td></tr>
    <tr>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/left2.png" width="15">&nbsp;</td>
    <td width="100%"> 
	<?
}


function OpenTable3() 
{
 global $theme_name;
 $ThemeSel = get_theme();
  
  ?>
    <table class="fancytable" border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
    <td width="15" height="15">
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/Curve-TL.png" width="31" height="31"></td>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/up2.png" align="center" width="100%" height="15">&nbsp;</td>
    <td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/Curve-TR.png" width="31" height="31"></td></tr>
    <tr>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/left2.png" width="15">&nbsp;</td>
    <td width="100%"> 
	<?

}

    
function CloseTable3() 
{
 global $theme_name;
   ?>
	</td>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve_Right.png">&nbsp;</td></tr>
    <tr>
      <td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-BL.png" width="31" height="31"></td>
  <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-Bottom.png">&nbsp;</td><td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-BR.png" width="31" height="31"></td>
  </tr>
    </td></tr></table>
	<?
   global $ThemeSel;  
   echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" height=7><br>\n";
}

function AdminTableOpen()
{
 global $theme_name;
 $ThemeSel = get_theme();
  
  ?>
    <table class="admintable" border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
    <td width="15" height="15">
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/Curve-TL.png" width="31" height="31"></td>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/up2.png" align="center" width="100%" height="15">&nbsp;</td>
    <td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/Curve-TR.png" width="31" height="31"></td></tr>
    <tr>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable3/left2.png" width="15">&nbsp;</td>
    <td width="100%"> 
	<?
}

function AdminTableClose()
{
 global $theme_name;
   ?>
	</td>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve_Right.png">&nbsp;</td></tr>
    <tr>
      <td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-BL.png" width="31" height="31"></td>
  <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-Bottom.png">&nbsp;</td><td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-BR.png" width="31" height="31"></td>
  </tr>
    </td></tr></table>
    <br>
	<?
}

function CloseFancyTable() 
{
 global $theme_name;
   ?>
	</td>
    <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve_Right.png">&nbsp;</td></tr>
    <tr>
      <td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-BL.png" width="31" height="31"></td>
  <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-Bottom.png">&nbsp;</td><td>
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable3/Curve-BR.png" width="31" height="31"></td>
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
  <table class="code" border="0" width="100%">
  <tr>
  <td>
  <?
}

    
function CloseTable2() {

 global $theme_name;

    ?>
    </td>
	</tr>
    </table>
	<?
}
//global $ThemeSel;  
//echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" height=7><br>\n";
?>