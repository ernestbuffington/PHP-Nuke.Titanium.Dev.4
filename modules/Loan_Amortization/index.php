<?php
/*======================================================================
  PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *   copyright            : (C) ESO Software Inc.
 *   email                : scottybcoder@gmail.com
 ***************************************************************************/

if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); }
global $domain, $ThemeSel, $name; 
require_once("mainfile.php");
$this_title = 'The 30/360 US Rule';
//panacure c kills cancer
//1366 x 768
$titanium_module_name = basename(dirname(__FILE__));
get_lang($titanium_module_name); 
$index = 0;
include (TITANIUM_MODULES_DIR.$titanium_module_name.'/includes/Array-Months.php');
include (TITANIUM_MODULES_DIR.$titanium_module_name.'/includes/func-isNumber.php');
include (TITANIUM_MODULES_DIR.$titanium_module_name.'/includes/func-makeSeperator.php'); 
include (TITANIUM_MODULES_DIR.$titanium_module_name.'/includes/func-padMe.php');
include (TITANIUM_MODULES_DIR.$titanium_module_name.'/includes/objLoan.php');  

$ins =& $_POST;

switch($ins['step'])
{
/**************************************************************************  
  START CASE 1     (build user input page)  Posts: input data, step = 2   * 
 **************************************************************************/
   case 1:
   default: //here we have told PHP that this will be the default load  case
   /// here we are loading teh header for the page that this cae is loading
   include("header.php"); 
   // here we are choosing a page title
   $pagetitle = 'Loan Aromatization - The 30/360 US Rule';
   // This is additional title information
   $title = 'New Loan';
   
   $bgcolor1   = $ThemeInfo['bgcolor1'];
   $bgcolor2   = $ThemeInfo['bgcolor2'];
   $bgcolor3   = $ThemeInfo['bgcolor3'];
   $bgcolor4   = $ThemeInfo['bgcolor4'];
   $textcolor1 = $ThemeInfo['textcolor1'];
   $textcolor2 = $ThemeInfo['textcolor2'];
   title($sitename.' '.$title);
   OpenTable();

   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";
   
   global $fieldset_color, $fieldset_border_width; 
   echo '<fieldset style="border-color: '.$textcolor2.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
   echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="white">'.$pagetitle.' :: '.$title.'</font></strong></legend>';
   echo '<br />';

   echo "<div align=\"center\"><table class=\"scottybcoder\" width=\"50%\" height=\"600\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\"><tr><td>";
   // OPEN TABLE FOR USER INPUT 
   echo "<div align=\"center\"><table bgcolor=\"FFFFCC\" width=\"70%\" height=\"500\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";
 
   $temp1 = $ins['principle'];
   $temp2 = $ins['interest'];
   $temp3 = $ins['term'];
?>
<style type="text/css"> 

.scottybcoder
{
	background-color:#F60
	!important
}
input.centerInput
{
text-align:center; 
font-weight:bold;
color:green;
background-color:#DDDDDD;
} 
</style>
<?
   // OPEN FORM
   echo "<form action=\"$PHP_SELF\" method=\"post\">"; 
   // ROW 1   
   echo "<tr>";
   echo "<input type=\"hidden\" name=\"step\" value=\"2\">"; 
   echo "<td align=\"center\"><strong><font color=\"white\"><strong>Principle</strong></font></strong></td>";
   
   #this is my first use of a sub for 'input' fields  
   echo "<td align=\"center\"><input type=\"text\" class=\"centerInput\" name=\"principle\" type=\"text\" value=\"$temp1\" tabindex=\"1\" size=\"10\"></td>";
   
   
   echo "<td align=\"center\"><font color=\"black\"><strong>( No Commas )</strong></font></td>"; 
   echo "</tr>";
   // END ROW 1   

   //ROW 2
   echo "<tr>";        
   echo "<td align=\"center\"><strong><font color=\"white\"><strong>Interest</strong></font></strong></td>";
   echo "<td align=\"center\"><input name=\"interest\" type=\"text\" class=\"centerInput\" value=\"$temp2\" tabindex=\"2\" size=\"4\"></td>";
   echo "<td align=\"center\"><font color=\"black\"><strong>( Example: 6.25 )</strong></font></td>";
   echo "</tr>";
   // END ROW 2

   // ROW 3
   echo "<tr>"; 
   echo "<td align=\"center\"><strong><font color=\"white\"><strong>Term</strong></font></strong></td>"; 
   echo "<td align=\"center\"><input name=\"term\" type=\"text\" class=\"centerInput\" value=\"$temp3\" tabindex=\"3\" size=\"4\"></td>";
   echo "<td align=\"center\"><font color=\"black\"><strong>( In Years )</strong></font></td></b>"; 
   echo "</tr>";   
   // END ROW 3 

   // ROW 4   
   echo "<tr>";
   echo "<td align=\"center\" colspan=\"3\"><input type=\"submit\" name=\"Submit\" value=\"Calc\" tabindex=\"4\" size=\"4\"></td>";
   echo "</tr>";  
   // END ROW 4

   echo "</form>";
   // CLOSE FORM 

   echo "</table></div>";
   // CLOSE TABLE FOR USER INPUT

   echo "</td></tr></table></fieldset></div>";
   // CLOSE OPEN TABLE CASE 1

   global $domain, $name, $facebook_plugin_width;
   echo '<br />';
   echo '<div align="center">Written by: Truman "ScottyBcoder" Buffington</div>';

   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";
   
   CloseTable();                                                                                                                    #
   include("footer.php");

   break; // END CASE 1 or default for switch($form['step'])
/****************  
  END CASE 1
 ****************/

/**************** 
  START CASE 2  (calculations, review loan page)  Posts: step = 4, data
 ****************/
   case 2:
   include("header.php"); 
   $pagetitle = 'PHP-Nuke Titanium :: Loan Data Calculations';
   $title = 'Review Your Loan';

?>
<style type="text/css"> 

.scottybcoder
{
	background-color:#F60
	!important
}
input.centerInput
{
text-align:center; 
font-weight:bold;
color:green;
background-color:#DDDDDD;
} 
</style>
<?
   title($sitename.' '.$title);
   OpenTable();	

   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";

   echo '<fieldset style="border-color: '.$textcolor2.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
   echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="white">'.$pagetitle.' :: '.$title.'</font></strong></legend>';
   echo '<br />';

   //echo '<div align="center"><strong>'.$pagetitle.' :: '.$title.'</strong></div><br />';
   //echo "<link rel=\"StyleSheet\" href=\"modules/Loan/styles/Loan.css\" type=\"text/css\">";

   // OPEN TABLE CASE 2
   echo "<div align=\"center\"><table class=\"scottybcoder\" width=\"40%\" height=\"550\" border=\"10\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#CD853F\"><td>";

   // OPEN TABLE FOR USER INPUT
   
   echo "<div align=\"center\"><table bgcolor=\"FFFFCC\" width=\"70%\" border=\"0\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";
   
   // calculations  
   $str1 = $ins['interest'];
   $str2 = $ins['principle'];
   $str3 = $ins['term'];   
   $principleBool = is_num($ins['principle']);
   $interestBool = is_num($ins['interest']);
   $termBool = is_num($ins['term']);

   if ( $principleBool == 1 || $interestBool == 1 || $termBool == 1)
   {
      echo "<tr><td colspan=\"3\" align=\"center\">";
	  echo "<img src=\"modules/Loan/images/LoanError.jpg\">";
      echo "</td></tr>";
   }
   elseif ( $str1 == "" || $str2 == "" || $str3 == "" )
   {   
      echo "<tr><td colspan=\"3\" align=\"center\">";
      echo "<img src=\"modules/Loan/images/LoanError.jpg\">";
      echo "</td></tr>";
   }
   else
   {
      $objLoan = new Loan;
      $objLoan->InitData($ins['principle'],$ins['interest'],$ins['term']); 
      $objLoan->CalcData();

      $temp1 = $ins['principle'];
      $temp2 = $ins['interest']; 
      $temp3 = $ins['term'];
 
   }

    // ROW 'Review Your Loan'

   echo "<tr><td align=\"center\" valign=\"middle\" bgcolor=\"CD853F\">";  
   echo "<font size =5><b>Review</b></font></td></tr>";
   // END ROW 
   
   // ROW  'Principle'
   echo "<tr><td align=\"center\" valign=\"middle\" bgcolor=\"F4A460\">";   
   echo "<font size =3>Principle =&nbsp;";
   echo $objLoan->Principle; 
   echo "</font></td></tr>";
   // END ROW 

   // ROW 'Interest'
   echo "<tr><td align=\"center\" bgcolor=\"F4A460\"><font size =3>Interest =&nbsp;&nbsp;" . $ins['interest'] . ' %'; 
   echo "</font></td></tr>";
   // END ROW 

   // ROW 'Term' 
   echo "<tr><td align=\"center\" bgcolor=\"F4A460\">";  
   echo "<font size =3>Term =&nbsp;";
   echo $ins['term'] . ' Yrs';
   echo "</font></td></tr>";
   // END ROW 

   // ROW 'Number of Payments'
   echo "<tr><td align=\"center\" bgcolor=\"F4A460\"><font size =3>";  
   echo "Number of Payments =&nbsp;";
   echo $objLoan->NumPayments;
   echo "</font></td></tr>";
   // END ROW 

   // ROW 'Total Interest'       
   echo "<tr><td align=\"center\"bgcolor=\"F4A460\"><font size =3>";  
   echo "Total Interest =&nbsp;";
   echo $objLoan->TotalInterest; 
   echo "<font></td></tr>";
   // END ROW 

   // ROW 'Total Loan'
   echo "<tr><td align=\"center\"bgcolor=\"F4A460\"><font size =3>";  
   echo "Total Loan =&nbsp;";		 
   echo $objLoan->TotalDebt; 
   echo "</font></td></tr>";
   // END ROW 

   // ROW 'Monthly Payment
   echo "<tr><td align=\"center\"bgcolor=\"F4A460\"><font size =3>";   
   echo "Monthly Payment =&nbsp;";
   echo $objLoan->Payment;
   echo "</font></td></tr>";
   // END ROW 

   $temp1 = $ins['principle'];
   $temp2 = $ins['interest'];
   $temp3 =$ins['term'];

   // OPEN FORM (Done button)
   echo "<form action=\"$PHP_SELF\" method=\"post\">";
   // ROW 10
   echo "<tr><td align=\"center\" bgcolor=\"CD853F\">";
   echo "<input type=\"hidden\" name=\"step\" value=\"3\">";
   echo "<input type=\"hidden\" name=\"principle\" value=\"$temp1\">";
   echo "<input type=\"hidden\" name=\"interest\" value=\"$temp2\">";
   echo "<input type=\"hidden\" name=\"term\" value=\"$temp3\">";
   echo "<input type=\"submit\" name=\"Back\" value=\"Finished\" style=\"height: 25px; width: 100px\">";
   echo "</td></tr>";  
   // END ROW 
   echo "</form>";
   // CLOSE FORM
   
   $temp1 = $ins['principle'];
   $temp2 = $ins['interest'];
   $temp3 = $ins['term'];
   
   // OPEN FORM (Back button)
   echo "<form action=\"$PHP_SELF\" method=\"post\">";
   // ROW 11
   echo "<tr><td align=\"center\" bgcolor=\"CD853F\">";
   echo "<input type=\"hidden\" name=\"step\" value=\"1\">";
   echo "<input type=\"hidden\" name=\"principle\" value=\"$temp1\">";
   echo "<input type=\"hidden\" name=\"interest\" value=\"$temp2\">";
   echo "<input type=\"hidden\" name=\"term\" value=\"$temp3\">";
   echo "<input type=\"submit\" name=\"Submit\" value=\"New Loan\" style=\"height: 25px; width: 100px\">"; 
   echo "</td></tr>";  
   // END ROW 
   echo "</form>";
   // CLOSE FORM
   
   // OPEN FORM (create an amortization schedule)
   echo "<form action=\"$PHP_SELF\" method=\"post\">";
   // ROW 'Create Amortization Schedule and GO button
   echo "<tr><td align=\"center\" bgcolor=\"CD853F\">";
   
   echo "<input type=\"hidden\" name=\"step\" value=\"4\">";
   echo "<input type=\"hidden\" name=\"print\" value=\"YES\">";
   echo "<input type=\"hidden\" name=\"principle\" value=\"$temp1\">";
   echo "<input type=\"hidden\" name=\"interest\" value=\"$temp2\">";
   echo "<input type=\"hidden\" name=\"term\" value=\"$temp3\"><font size =3>";
   echo "Create Amortization Schedule?&nbsp;&nbsp;</font></td></tr>";
   echo "<tr><td align=\"center\"><input type=\"submit\" value=\"YES\" ></td></tr>";
   // END ROW 
   echo "</form>"; 
   // CLOSE FORM

   echo "</table></div></span>";
   // CLOSE TABLE LOAN PROGRAM
   echo "</td></tr></table></fieldset></div>";
   // CLOSE TABLE CASE 2
   echo '<br />';
   echo '<div align="center">Written by: Truman "ScottyBcoder" Buffington</div>';

   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";
   
   CloseTable();                                                                                                                    #
   include("footer.php");

   break; // end of case 2 for switch ($ins['step'])
   // END CASE 2
/***************************************************************************************************************************************************************   
 BEGIN CASE 3  Builds a thank you page, Posts: step = 1 
/***************************************************************************************************************************************************************/ 
   case 3: 
   //include (TITANIUM_MODULES_DIR.$titanium_module_name.'/includes/LoanNdxScroll.php');
   include("header.php"); 
   $pagetitle = 'PHP-Nuke Titanium :: Loan Calculator';
   $title = 'Thank You';
?>
<style type="text/css"> 

.scottybcoder
{
	background-color:#F60
	!important
}
input.centerInput
{
text-align:center; 
font-weight:bold;
color:green;
background-color:#DDDDDD;
} 
</style>
<?
   title($sitename.' '.$title);
   OpenTable();
   
   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";
   	

   echo '<fieldset style="border-color: '.$textcolor2.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
   echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="white">'.$pagetitle.' :: '.$title.'</font></strong></legend>';
   echo '<br />';
   
   //echo "<link rel=\"StyleSheet\" href=\"modules/Loan/styles/Loan.css\" type=\"text/css\">";

   $temp1 = $ins['principle'];
   $temp2 = $ins['interest'];
   $temp3 =$ins['term'];

   // OPEN TABLE FOR CASE 3
   echo "<div align=\"center\"><table width=\"29.5%\" height=\"395\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\"><tr><td>"; 
   // OPEN TABLE FOR THANK YOU MESSAGE AND BACK BUTTON
   echo "<div align=\"center\"><table bgcolor=\"FFFFCC\" width=\"85%\" height=\"200\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";

   // ROW MESSAGE
   echo "<tr>"; 
   echo "<td align=\"center\" bgcolor=\"CD853F\"><font size =3>Change Detail and Recalculate?</font></td></tr>"; 
   // END ROW 1   

   // OPEN FORM
    echo "<form name=\"frmAnswer\" method=\"post\" action=\"$PHP_SELF\">";
   // ROW BACK BUTTON 
   echo "<tr><td align=\"center\" bgcolor=\"CD853F\">";
   echo "<input type=\"hidden\" name=\"principle\" value=\"$temp1\">";
   echo "<input type=\"hidden\" name=\"interest\" value=\"$temp2\">";
   echo "<input type=\"hidden\" name=\"term\" value=\"$temp3\">";
   echo "<input type=\"hidden\" name=\"step\" value=\"1\">";
   echo "<input type=\"submit\" name=\"Back\" value=\"Yes\">";
   echo "</td></tr>";
   // END ROW
   echo "</form>";
   // CLOSE FORM 

  // OPEN FORM (create an amortization schedule)
   echo "<form action=\"$PHP_SELF\" method=\"post\">";
   // ROW 'Create Amortization Schedule and GO button
   echo "<tr><td align=\"center\" bgcolor=\"CD853F\">";
   echo "<input type=\"hidden\" name=\"step\" value=\"4\">";
   echo "<input type=\"hidden\" name=\"print\" value=\"YES\">";
   echo "<input type=\"hidden\" name=\"principle\" value=\"$temp1\">";
   echo "<input type=\"hidden\" name=\"interest\" value=\"$temp2\">";
   echo "<input type=\"hidden\" name=\"term\" value=\"$temp3\"><font size =3>";
   echo "Create Payment Schedule?&nbsp;&nbsp;</font></td></tr>";
   echo "<tr><td align=\"center\" bgcolor=\"CD853F\"><input type=\"submit\" value=\"YES\"></td></tr>";
   // END ROW 
   echo "</form>"; 
   // CLOSE FORM

   echo "</table></div>";
   // CLOSE TABLE MESSAGE AND BACK BUTTON 
   echo "</td></tr></table></fieldset></div>";
   // CLOSE TABLE THANK YOU MESSAGE PAGE
   echo '<br />';
   echo '<div align="center">Written by: Truman "ScottyBcoder" Buffington</div>';

   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";

   CloseTable();                                                                                                                    #
   include("footer.php");

   break;
/***************************************************************************************************************************************************************    
 BEGIN CASE 4    Recalcs loan and creates a FULL AMORTIZATION SCEDULE
 **************************************************************************************************************************************************************/
   case 4:
   include("header.php"); 
   $pagetitle = 'PHP-Nuke Titanium :: Loan Amortization';
   $title = 'Loan Schedule';
?>
<style type="text/css"> 

.scottybcoder
{
	background-color:#F60
	!important
}
input.centerInput
{
text-align:center; 
font-weight:bold;
color:green;
background-color:#DDDDDD;
} 
</style>
<?
   title($sitename.' '.$title);
   OpenTable();

   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";

   echo '<fieldset style="border-color: '.$textcolor2.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
   echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="white">'.$pagetitle.' :: '.$title.'</font></strong></legend>';
   echo '<br />';
   //echo "<link rel=\"StyleSheet\" href=\"modules/Loan/styles/Loan.css\" type=\"text/css\">";

   $ins =& $_POST;

   // instantiating the object and using the posted data for calculations
   $objPrnLoan = new Loan;
   $objPrnLoan->InitData($ins['principle'],$ins['interest'],$ins['term']);
   $objPrnLoan->CalcData();

   $temp1 = $ins['principle'];
   $temp2 = $ins['interest'];
   $temp3 = $ins['term'];

   // OPEN TABLE CASE 4
   echo "<div align=\"center\"><table class=\"scottybcoder\" width=\"70%\" height=\"600\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\"><tr><td>";
   // OPEN TABLE FOR href AND, NEW LOAN BUTTON, LOAN DESCRIPTION AND AMORTIZATION SCHEDULE
   //echo "<div align=\"center\"><table bgcolor=\"FFFFCC\" width=\"68%\" height=\"500\" border=\"4\" cellpadding=\"4\" cellspacing=\"4\" bordercolor=\"#FF8080\">";

  echo "<div align=\"center\"><a name=\"topPage\"></a></div>";
  echo "<div align=\"center\"><a href=\"#bottomPage\" target=\"_self\"><strong>Bottom of Schedule</strong></a></div>";

  echo "<div align=\"center\"><form name=\"frmFirstPage1\" method=\"post\" action=\"$PHP_SELF\">";
  echo "<input type=\"hidden\" name=\"principle\" value=\"$temp1\">";
  echo "<input type=\"hidden\" name=\"interest\" value=\"$temp2\">";
  echo "<input type=\"hidden\" name=\"term\" value=\"$temp3\">";
  echo "<input type=\"hidden\" name=\"step\" value=\"1\">";
  echo "<a name=\"topPage\"></a>";
  echo "<input type=\"submit\" name=\"Submit\" value=\"New Loan\" style=\"height: 25px; width: 100px\">";
  echo "</form></div>";
  echo "<div align=\"center\">";
/****************************************************************************
 Look in ../_inc/isDate.php for description of what is returned by getdate()
 ****************************************************************************
 Put a fictional 0 element in these arrays so element 1 is actual 1, not 0
 ****************************************************************************/

   // initializing the data
   $today = getdate();
   $lineCntr = 0;
   $seperator = makeSeperator('-', 16);
   $padString="";
   $padChar = " "; 
   $padLen = 15; 
   $headerStr="   Payment Num   Loan Value     Payment     Interest      Date       Balance";
   // converting 'mon' and 'year' to numbers for incrementing month and year in output
   $monthName = $today['mon'];
   $yearName = $today['year'];
   $yearCnt = number_format($yearName,0,'','');		
   $monthCnt = number_format($monthName,0,'','');		

   $loanString = 'Principle:&nbsp;&nbsp;' . $objPrnLoan->Principle .'&nbsp;&nbsp;&nbsp;&nbsp;Rate:&nbsp;&nbsp;' . $objPrnLoan->Interest . '%&nbsp;&nbsp;&nbsp;&nbsp;Interest:&nbsp;&nbsp;'
    . $objPrnLoan->TotalInterest . '<br><br>  Loan Value:&nbsp;&nbsp;' . $objPrnLoan->TotalDebt . '&nbsp;&nbsp;&nbsp;&nbsp;Term:&nbsp;&nbsp;' .$objPrnLoan->Term
	. '&nbsp;&nbsp;Years&nbsp;&nbsp;&nbsp;&nbsp;Payment:&nbsp;&nbsp;' . $objPrnLoan->Payment . '';		  

   echo '<h2>';
   echo '<br>Amortization Date:&nbsp;&nbsp;' .$today['weekday'] . ',&nbsp;' . $today['month'] . ',&nbsp;' . $today['mday'] . ',&nbsp;' . $today['year'] . '<br><br>';
 
   echo $loanString;
   echo '</h2>';
   echo '</h7>';

   echo '<pre>' . $headerStr . '<br>' . $seperator . '<br>';     
 
   $lineCntr = 4;
 
   for ( $i=0;$i<$objPrnLoan->NumPayments;$i++)
   {
      echo '<pre>';
      $lineCntr++;
   
      if ( $lineCntr % 30 == 0 )
      {
         echo '</pre><pre>' . $headerStr . '<br>' . $seperator . '<br>';    
         $lineCntr += 3;
      }
       
      // 1. payment number
      $padString = $i + 1 . '.';
      $padString = padMe($padString,1,14,$padChar);
      $padString = $padString;
      echo $padString;
      // 2.  remaining loan value
      $padString = $objPrnLoan->LoanValue[$i];		
      $padString =  '$' . number_format($padString,2,'.',',');
      $padString = padMe($padString,1,$padLen,$padChar);
      echo $padString;
      // 3.  payment column
      $padString = $objPrnLoan->Payment;		
      $padString = padMe($padString,1,12,$padChar);
      echo $padString;
      // 4.  interest column
      $padString = $objPrnLoan->AccruedInterest[$i];
      $padString =  '$' . number_format($padString,2,'.',',');
      $padString = padMe($padString,1,12,$padChar);
      echo $padString;
      // 5.  month and year column
      $padString = $monthNames[$monthCnt] . '&nbsp;' . $yearCnt;
      $padString = padMe($padString,1,18,$padChar);
      $padString = $padString;
      echo $padString;

      $monthCnt++;
   
      if ($monthCnt == 13)
      {
         $monthCnt = 1;
         $yearCnt++;
      }

      // 6.  balance column
      $padString = $objPrnLoan->Balance[$i];
      $padString = '$' . number_format($padString,2,'.',',');
      $padString = padMe($padString,1,14,$padChar);
      echo $padString . '<br>';
   
      echo $seperator . '<br>';
      echo '</pre>';
   }

   echo '</h7>';
   echo '</pre>';
   
   $temp1 = $ins['principle']; 
   $temp2 = $ins['interest'];
   $temp3 =$ins['term'];
 
   // LINK TO CALL BOTTOM OF PAGE
   echo "<div align=\"center\"><a name=\"bottomPage\"></a></div>";
   echo "<div align=\"center\"><a href=\"#topPage\" target=\"_self\"><strong>Back To Top</strong></a></div>";
   // FORM FOR NEW LOAN BUTTON
   echo "<div align=\"center\"><form name=\"frmFirstPage\" method=\"post\" action=\"$PHP_SELF\">";
   echo "<input type=\"hidden\" name=\"principle\" value=\"$temp1\">";
   echo "<input type=\"hidden\" name=\"interest\" value=\"$temp2\">";
   echo "<input type=\"hidden\" name=\"term\" value=\"$temp3\">";
   echo "<input type=\"hidden\" name=\"step\" value=\"1\">";
   echo "<input type=\"submit\" name=\"Submit\" value=\"New Loan\" style=\"height: 25px; width: 100px\">";
   echo "</form></div>";
   // CLOSE FORM 
   
   // CLOSE TABLE
   echo "</td></tr></table></fieldset></div></div>";
   echo '<br />';
   echo '<div align="center">Written by: Truman "ScottyBcoder" Buffington</div>';
   
   # stop using <br /> use a div tag with padding whenever it's possible!
   print '<div align="center" style="padding-top:13px;">'."\n";
   print '</div>'."\n";
   
   CloseTable();                                                                                                                    #
   include("footer.php");
   break;
}
?>
