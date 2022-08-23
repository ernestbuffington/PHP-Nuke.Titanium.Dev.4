<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
############################################################################################
    if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript_body_facebook.php'))  #
	{                                                                                      #Added by Ernest Buffington
       require_once(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript_body_facebook.php');   #facebook Mod v4.6
    }                                                                                      #Oct 10th 2012
############################################################################################	
global $domain, $facebook_plugin_width, $facebookappid, $module_name, $ThemeSel, $name; //globals 
include (TITANIUM_MODULES_DIR.$module_name.'/includes/facebook_connector.php'); //loaded for facebook purposes
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name); 
$index = 0;

echo "<link rel=\"StyleSheet\" href=\"modules/ArrangeItems/styles/buttons-layers.css\" type=\"text/css\">";

include (TITANIUM_MODULES_DIR.$module_name.'/includes/isNumber.php');

   include("header.php"); 
   $pagetitle = 'Arrange Items';
   $title = 'Arrange Items';
    if(!function_exists('OpenTableMessage')) // we check here to see if there is a function running called OpenTableMessage(); if not we load OpenTable($title)
    OpenTable($title);
	else		
   OpenTableMessage($title);                                                                                                                

// define allowed username/password pair
define('ALLOWED_MIN', '3');
define('ALLOWED_MAX', '999999');

// create reference to form based on the form method used
$form =& $_POST;

//Show a login form
if ($form['nthnumber'] == "" )
{
   // OPEN TABLE CASE 1
   echo "<center><table bgcolor=\"FA5F19\" width=\"40%\" height=\"600\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\" background=\"http://www.scottybcoder.com/public_html/modules/Proof Of God/images/.jpg\"><tr><td>";  
   // OPEN TABLE FOR USER INPUT  
   echo "<center><table bgcolor=\"FFFFCC\" width=\"70%\" height=\"500\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";

   // OPEN FORM
   echo "<form name=\"frmMain\" action=\"arrangeNum.php\"  method=\"post\">";
   // ROW 1
   echo "<tr><td>Enter The Number Of Items:&nbsp;&nbsp;<input type=\"text\" name=\"nthnumber\"></td></tr>";
   // END ROW 1
   // ROW 2
   echo "<tr><td><input type=\"submit\" value=\"Calc\"></td></tr>";
   // END ROW 2
   echo "</form>";
   // CLOSE FORM

   echo "<tr><td><h5>This program calculates the number of ways to arrange a number of items.</h5><td><tr>";
   echo "<tr><td><h6>Here is an example for 4 items (the items being 1, 2, 3, and 4).</h6><td><tr>";
   echo "<pre>";
   echo "<tr><td>As you can see, there are 24 ways to arraing 4 items.</h6><td><tr>";
   echo "<tr><td>&nbsp;&nbsp;(1) 1,2,3,4&nbsp; ____ (07) 2,1,3,4&nbsp; ____ (13) 3,1,2,4&nbsp; ____ (19) 4,1,2,3</h6><td><tr>";
   echo "<tr><td>&nbsp;&nbsp;(2) 1,2,4,3&nbsp; ____ (08) 2,1,4,3&nbsp; ____ (14) 3,1,4,2&nbsp; ____ (20) 4,1,3,2</h6><td><tr>";
   echo "<tr><td>&nbsp;&nbsp;(3) 1,3,2,4&nbsp; ____ (09) 2,3,1,4&nbsp; ____ (15) 3,2,1,4&nbsp; ____ (21) 4,2,1,3</h6><td><tr>";
   echo "<tr><td>&nbsp;&nbsp;(4) 1,3,4,2&nbsp; ____ (10) 2,3,4,1&nbsp; ____ (16) 3,2,4,1&nbsp; ____ (22) 4,2,3,1</h6><td><tr>";
   echo "<tr><td>&nbsp;&nbsp;(5) 1,4,2,3&nbsp; ____ (11) 2,4,1,3&nbsp; ____ (17) 3,4,1,2&nbsp; ____ (23) 4,3,1,2</h6><td><tr>";
   echo "<tr><td>&nbsp;&nbsp;(6) 1,4,3,2&nbsp; ____ (12) 2,4,3,1&nbsp; ____ (18) 3,4,2,1&nbsp; ____ (24) 4,3,2,1</h6><td><tr>";
   echo "</pre>";
   echo "<tr><td><h5>Enter a number between 3 and 999999:</h5></td></tr>";

   echo "<tr><td><h5>Formula:  n + (n * (n-1)) + (n * (n-2)) ... repeating until (n-x) = 0<br><br> Using this formula, we see that there are approximately 250 trillion,
         trillion, trillion,   trillion, trillion ways to arrange the four nitrogen-containing bases found in the DNA double helix structure.<br><br>Carbon-dating of
		 substances on earth, imply that the earth hasn't been around long enough for DNA to accidentally get arranged into humans.</td></tr>";

   echo "<a href=\"http://en.wikipedia.org/wiki/Double_helix\" _self>DNA</a>";
} 
else
{
   // is_num() comes from isNumber.php, it returns one if char entered is not 0123456789 or .
   $itemNum = is_num($form['nthnumber']);
   if ($itemNum == 0) 
   { 
      $form['nthnumber'] = 9999;
   }
   if ( ($form['nthnumber'] > (ALLOWED_MIN-1)) && ($form['nthnumber'] < (ALLOWED_MAX + 1)) )
   {
      $numToCalc = $form['nthnumber'];
      $numTotal = nthNumber($numToCalc);
      $numToCalc = number_format($numToCalc,0,'.',',');		  
      $numTotal = number_format($numTotal,0,'.',',');		  
      // verified ok; return protected page

      echo"<tr><td><h5>You entered this number: $numToCalc</h5><br></td></tr>";
      
	  // OPEN FORM
	  echo "<form name=\"frmAnswer\" method=\"post\" action=\"arrangeNum.php\">";
      echo "<tr><td><input type=\"submit\" name=\"Back\" value=\"Back\"><\td><\tr>";
      echo "</form>";
	  // CLOSE FORM
      echo "<tr><td><h5>This is the maximum number of ways to arrange $numToCalc items = $numTotal</h5></td></tr>";
   }  
   else
   {
      echo "<tr><td><h5>Enter a number between 3 and 999999:</h5></td></tr>";
      echo "<tr><td><h5>The number must be between 3 and 999999.  No commas, please.</h5></td></tr>";
      echo "<form name=\"frmError\" method=\"post\" action=\"arrangeNum.php\">";
      echo "<tr><td>Number of Items: <input type=\"text\" name=\"nthnumber\"></td></tr>";
      echo "<td><tr><input type=\"submit\" value=\"Send\"></td></tr>";
      echo "</form>";
   }
}

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

/* Number formatting
   For english style formating
   four args are the number, the num of decimals, the thousands seperator
   1.  the number
   2.  the number of decimal places to output
   3.  the decimal seperator  (.)
   4.  the thousands seperator (,)
   $newNum = number_format($newNum,0,'.',',');
*/
?>