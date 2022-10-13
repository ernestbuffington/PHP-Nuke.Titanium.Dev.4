<?php
/*=======================================================================================
 PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System : Using the Nuke-Evolution Core
 ========================================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));

/********************************************************************************************************************************************************/
function MusicTopicsExtendedOpen() 
{
  global $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor2, $pagetitle;
  
echo"<table class=\"maintable\"border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
  . "<tr>"
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
  
  . "<td valign=\"middle\" background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
  . "<div class=\"typeface-js\" style=\"font-family: Helvetiker\" align=\"center\"><strong><font color =\"$textcolor1\">$pagetitle</font></strong></div>"
  . "</td>"
  
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
  . "</tr>"
  . "<tr>"
  . "<td width=\"15\" background=\"themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
  . "<td width=\"24\"></td>"
  . "<td width=\"100%\">";

}

    
function MusicTopicsExtendedClose() 
{
        global $theme_name, $screen_res, $screen_width, $screen_height;
		
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
</table>
<br />
<?
}

#########################################################################
# Table Header Message Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
function OpenTableSurvey($title='')
{
  global $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor1, $sitename;
  
echo"<table class=\"maintable\"border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
  . "<tr>"
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
  
  . "<td valign=\"middle\" background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
  . "<div class=\"typeface-js\" style=\"font-family: Helvetiker\" align=\"center\"><strong><font color =\"$textcolor1\">$title</font></strong></div>"
  . "</td>"
  
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
  . "</tr>"
  . "<tr>"
  . "<td width=\"15\" background=\"themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
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
  
echo"<table class=\"maintable\"border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
  . "<tr>"
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
  
  . "<td valign=\"middle\" background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
  . "<div class=\"typeface-js\" style=\"font-family: Helvetiker\" align=\"center\"><strong><font color =\"$textcolor1\">$sitename » $title</font></strong></div>"
  . "</td>"
  
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
  . "</tr>"
  . "<tr>"
  . "<td width=\"15\" background=\"themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
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
  
echo"<table class=\"maintable\"border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
  . "<tr>"
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
  
  . "<td valign=\"middle\" background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
  . "<div class=\"typeface-js\" style=\"font-family: Helvetiker\" align=\"center\"><strong><font color =\"$textcolor1\">$pagetitle</font></strong></div>"
  . "</td>"
  
  . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
  . "<img src=\"themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
  . "</tr>"
  . "<tr>"
  . "<td width=\"15\" background=\"themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
  . "<td width=\"24\"></td>"
  . "<td width=\"100%\">";
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
<td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">
<img src="themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
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
  
  if (($name == 'A') || ($name == 'Z'))
  {
  
    ?>

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
</table>

<?

 }
}


function OpenTable3() {

 global $theme_name, $browser;
 
 $ThemeSel = get_theme();

 $style = "<link rel=\"stylesheet\" href=\"themes/$ThemeSel/style/style.css\" type=\"text/css\">\n";
 
 if ($browser == 'ie' || $browser == 'konqueror' || $browser == 'MSIE')
 {
        if (file_exists('themes/'.$ThemeSel.'/style/style_ie.css')) 
		{
            $style = "<link rel=\"stylesheet\" href=\"themes/$ThemeSel/style/style_ie.css\" type=\"text/css\">\n";
        }
    } 
	else 
	if ($browser == 'Mozilla' || $browser == 'Firefox' || $browser == 'Gecko' || $browser == 'Netscape') 
	{
        if (file_exists('themes/'.$ThemeSel.'/style/style_moazilla.css')) {
            $style = "<link rel=\"stylesheet\" href=\"themes/$ThemeSel/style/style_mozilla.css\" type=\"text/css\">\n";
        }
    } 
	else 
	if ($browser == 'Opera') 
	{
        if (file_exists('themes/'.$ThemeSel.'/style/style_opera.css')) 
		{
            $style = "<link rel=\"stylesheet\" href=\"themes/$ThemeSel/style/style_opera.css\" type=\"text/css\">\n";
        }
    }

  echo $style;

  global $screen_res, $screen_width, $screen_height;
		
		if ($screen_width >= '1680')
	    {
 
  ?>
    <table class=maintable border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
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
    <table class="boxtitle" width="100%" border="2">
    <tr>
    <td>
	<?
	
	
	}
}

    
function CloseTable3() {

 global $theme_name;

   		global $screen_res, $screen_width, $screen_height;
		
		if ($screen_width >= '1680')
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
     </tr>
     </table> 		
	 <?   
	 }
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
  <table class="code" border="1" width="100%">
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

?>