<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
$pagetitle = 'Proof Of God';
$title = 'Proof Of God';
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
$index = 0;

global $domain, $facebook_plugin_width, $facebookappid, $module_name, $ThemeSel, $name; //globals 

include (TITANIUM_MODULES_DIR.$module_name.'/includes/isNumber.php');

echo "<link rel=\"StyleSheet\" href=\"modules/Proof Of God/styles/buttons-layers.css\" type=\"text/css\">";
echo "<link rel=\"StyleSheet\" href=\"modules/Proof Of God/styles/Jackies.css\" type=\"text/css\">";

define('ALLOWED_MIN', '3');
define('ALLOWED_MAX', '999999');

OpenTable();
echo '<div align="center"><strong>'.$title.'</strong></div>';
echo '<br />';
$form =& $_POST; 

   echo "<style type=\"text/css\">"; 
      echo "input.centerInput{";
      echo "    text-align:center;"; 
      echo "    font-weight:bold;";
      echo "    color:green;";
      echo "    background-color:#DDDDDD;";
      echo "}";
   echo "</style>";

   //echo "<div id=\"LmessageBackgrnd\">";
   //echo "<table><tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><b><font size=\"5\">Proof Of God:</font></b></td></tr>";
   //echo "<tr><td align=\"center\" height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Some think of Jackie Evancho.</font></td></tr>";   
   //echo "<tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Some think of the rose.</font></td></tr>";
   //echo "<tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Some think of the DNA math.</font></td></tr>";
   //echo "<tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Click the DNA link for more info.</font></td></tr></table>";
   //echo "</div>";     

                 
   //echo "<div id=\"LmessageBackgrnd2\">";
   //echo "<table><tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><b><font size=\"5\">DNA Base Pairs:</font></b></td></tr>";
   //echo "<tr><td align=\"center\" height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Bacteria have 600,000.</font></td></tr>";   
   //echo "<tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Humans have 3 billion.</font></td></tr>";
   //echo "<tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Mice have 3 billion.</font></td></tr>";
   //echo "<tr><td height=\"15\"></td></tr>";
   //echo "<tr><td align=\"center\"><font color=\"#FFFFFF\"><b>Click the DNA link for more info.</font></td></tr></table>";
   //echo "</div>";     


   //echo "<div id=\"LbuttonTwo\">";
   //   echo "<button style=\"height: 25px; width: 150px\" onclick=openNewWin();>Experience Jackie</button>";
   //echo "</div>";

   //echo "<div id=\"LDNAlink\">";
    //  echo "<button style=\"height: 25px; width: 60px\" onclick=openNewWin2();>DNA</button>";
   //echo "</div>";

   //echo "<div id=\"LDNAlink2\">";
   //   echo "<button style=\"height: 25px; width: 60px\" onclick=openNewWin2();>DNA</button>";
   //echo "</div>";





   //echo "<script>";

      //echo "function openNewWin()";
      //echo "{";
      //echo "var newWindow;";
      //echo "newWindow = window.open(\"/modules/Proof Of God/JackiesWindow.html\",\"myWindow\",\"width=690,height=880\");";
      //echo "newWindow.moveTo(100,100)";
      //echo "}";

      //echo "function openNewWin2()"; 
      //echo "{";
      //echo "var newWindow2;";
      //echo "newWindow2 = window.open(\"http://en.wikipedia.org/wiki/Double_helix\",\"myWindow2\",\"width=1200,height=1000\");";
      //echo "newWindow2.moveTo(15,15)";
      //echo "}";

   /* echo "</script>"; */

   //echo "<div id=\"Ldarwin\"></div>"; 
   //echo "<div id=\"Ldna\"></div>";

   echo "<div align=\"center\"><table bgcolor=\"FA5F19\" width=\"70%\" height=\"650\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\"><tr><td>";  

   //Show a login form
   if ($form['nthnumber'] == "" )
   {
      $pagetitle = 'Proof Of God';
      $title = 'Proof Of God';
      // OPEN TABLE
      echo "<div align=\"center\"><table bgcolor=\"FFFFCC\" width=\"85%\" height=\"225\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">"; 
      // ROW 1
      echo "<tr><td align=\"center\"><font size =4 color=\"#800000\"><b>This program calculates the possible number of ways to arrange a number of items.</font></td></tr>"; 
      // ROW 2
      echo "<tr><td align=\"center\"><font size =4 color=\"#800000\">Enter a number between 3 and 999,999 (no commas):</font><br>";
      // OPEN FORM
      echo "<form name=\"frmMain\" method=\"post\" action=\"$PHP_SELF\">";
      // ROW 3
      echo "<input type=\"text\" class=\"centerInput\" name=\"nthnumber\"></td></tr>";
      // ROW 4
      echo "<tr><td align=\"center\"><input type=\"submit\" value=\"Calc\"></td></tr>";
      echo "</form>";
      // CLOSE FORM
      echo "</table></div>";
      // CLOSE TABLE

      // OPEN TABLE
      echo "<div align=\"center\"><table bgcolor=\"FA5F19\" width=\"85%\" height=\"225\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";
      echo "<tr><td align=\"center\"><BR><font size =4 color=\"#800000\"><b>Here is an example for 4 items (the items being 1, 2, 3, and 4).<br>";
      // ROW 1
      echo "<tr><td align=\"center\"><font size =4 color=\"#800000\">";
      echo "Formula: (n * (n-3)) + (n * (n-2)) + (n * (n-1)) ... repeating until the x = 0<font size =\"2\">&nbsp;&nbsp;(the x in n-x)</font></td></tr>";
      // ROW 2
      echo "<tr><td align=\"center\"><font size =3 color=\"#800000\">As you can see, there are 24 ways to arrange 4 items.</font></td></tr>";
      // ROW 3
      echo "<tr><td align=\"center\"><font size =3 color=\"#800000\">&nbsp;&nbsp;(1) 1,2,3,4&nbsp; ____ (07) 2,1,3,4&nbsp; ____ (13) 3,1,2,4&nbsp; ____ (19) 4,1,2,3<br>"; 
      // ROW 4
      echo "&nbsp;&nbsp;(2) 1,2,4,3&nbsp; ____ (08) 2,1,4,3&nbsp; ____ (14) 3,1,4,2&nbsp; ____ (20) 4,1,3,2<br>";
      // ROW 5
      echo "&nbsp;&nbsp;(3) 1,3,2,4&nbsp; ____ (09) 2,3,1,4&nbsp; ____ (15) 3,2,1,4&nbsp; ____ (21) 4,2,1,3<br>";
      // ROW 6
      echo "&nbsp;&nbsp;(4) 1,3,4,2&nbsp; ____ (10) 2,3,4,1&nbsp; ____ (16) 3,2,4,1&nbsp; ____ (22) 4,2,3,1<br>";
      // ROW 7
      echo "&nbsp;&nbsp;(5) 1,4,2,3&nbsp; ____ (11) 2,4,1,3&nbsp; ____ (17) 3,4,1,2&nbsp; ____ (23) 4,3,1,2<br>";
      // ROW 8
      echo "&nbsp;&nbsp;(6) 1,4,3,2&nbsp; ____ (12) 2,4,3,1&nbsp; ____ (18) 3,4,2,1&nbsp; ____ (24) 4,3,2,1</font></td></tr>"; 
      // ROW 9
      echo "</table></div><br><br>";
      // CLOSE TABLE

      echo "<div align=\"center\"><table width=\"100%\">";    
      // ROW 1
      echo "<tr><td align=\"center\"><b><font size=3><p>There are about 250 trillion, trillion, trillion, trillion, trillion ways to arrange the four nitrogen-containing bases
      found in the DNA double helix structure.</p>";
      echo "<p>Carbon-dating of earth substances indicates that DNA has <font color=\"white\"><b>not</font> been around long enough to evolve into humans by \"natural selection\".</p>";
      echo "<p>Intelligent choice was involved at some point.  Possibly at the beginning?</p>";
	  echo "<p>250,000,000,000,000,000,000,000,000</p></font></td></tr></table></div>";
   }  
   else
   {
      $pagetitle = 'Proof Of God';
      $title = 'Proof Of God';
      $itemNum = is_num($form['nthnumber']);
      if ( ($form['nthnumber'] > (ALLOWED_MIN-1)) && ($form['nthnumber'] < (ALLOWED_MAX + 1)) )
      {
         $numToCalc = $form['nthnumber'];
         $numTotal = nthNumber($numToCalc);
         $numToCalc = number_format($numToCalc,0,'.',',');		  
         $numTotal = number_format($numTotal,0,'.',',');		  

         // OPEN TABLE
         echo "<div align=\"center\"><table bgcolor=\"FFFFCC\" width=\"50%\" height=\"200\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";
  	     // ROW 1
         echo"<tr><td align=\"center\"><font color=\"#800000\"><b>You entered this number:&nbsp;&nbsp;<b>$numToCalc</font></td></tr>";
         // OPEN FORM
         echo "<form name=\"frmAnswer\" method=\"post\" action=\"$PHP_SELF\">";
         // ROW 2
         echo "<tr><td align=\"center\"><font color=\"#800000\"><b>This is the maximum number of ways to arrange&nbsp;$numToCalc&nbsp;";
		 echo "items =&nbsp;&nbsp;&nbsp;&nbsp;<b>$numTotal</font></td></tr>";
         // ROW 3
         echo "<tr><td align=\"center\"><input type=\"submit\" name=\"Back\" value=\"Back\"></td></tr>";
         echo "</form>";
         // CLOSE FORM
         echo "</table></div>";
         // CLOSE TABLE
      }  
      else
      {
         // OPEN TABLE
         echo "<div align=\"center\"><table bgcolor=\"FFFFCC\" width=\"70%\" height=\"225\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";
 	     // ROW 1
         echo "<tr><td align=\"center\"><font color=\"#800000\"><b>Enter a number between 3 and 999,999 with no commas:</font></td></tr>";
         echo "<form name=\"frmMain\" method=\"post\" action=\"$PHP_SELF\">"; 
         // ROW 3
         echo "<tr><td align=\"center\"><font color=#800000><b>Number of Items:&nbsp;&nbsp;</font><input type=\"text\" class=\"centerInput\" name=\"nthnumber\"></td></tr>";
         // ROW 4
         echo "<tr><td align=\"center\"><input type=\"submit\" name=\"Back\" value=\"Back\"></td></tr>";
         echo "</form>";
         // CLOSE FORM
         echo "</table></div>";
         // CLOSE TABLE
      }
   }// END FIRST IF

/* 
   PRE:  pass the number to calculate as parameter
   PST:  return value
*/
function nthNumber($intVar)
{
 $counter = 1;
	  while ( $counter < $intVar)
	     { 
		    $total += ($intVar * ($intVar-$counter));
			$counter++;
		 }
 return $total;
}

/*********************************************************************** Number formatting
   For english style formating

   1.  the number
   2.  the number of decimal places to output
   3.  the decimal seperator  (.)
   4.  the thousands seperator (,)

   EXAMPLE:  $newNum = number_format($newNum,0,'.',',');
 *****************************************************************************************/

echo "</td></tr></table>";
echo '<br /><br />';
CloseTable();                                                                                                                    
include("footer.php");
?>
