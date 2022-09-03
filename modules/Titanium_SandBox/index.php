<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
$pagetitle = 'facebook SandBox v6.0';
$title = 'facebook SandBox odule v6.0';
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
$index = 0;

//load the style sheet for your module
//only needed if you tables require special colors or code
echo "<link rel=\"StyleSheet\" href=\"modules/Titanium_SandBox/css/style.css\" type=\"text/css\">\n\n\n";

//this should always be loaded for use in switch statements - start
if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
else
$mode = '0';

global $domain, $facebookappid, $module_name, $ThemeSel, $name; //these globals are almost always needed 

include (MODULES.'Titanium_SandBox/includes/functions.php'); //this must be loaded for facebook purposes
#########################################################################
# Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
if(!function_exists('OpenTableModule'))
{
  OpenTable();
  echo '<div align="center"><h1>Titanium SandBox '.NUKE_TITANIUM.'</h1></div>';
}
else
OpenTable();
#########################################################################	
	
$titanium_browser = new Browser();
//echo "<br />";
OpenTable2();

#-------------------------#
# Theme Colors Definition #
#-------------------------#
$digits_txt_color ='yellow';  # Reads
$digits_color ='#FF0000';     # How many reads

$fieldset_border_width = '1px'; 
$fieldset_color = '#4e4e4e';

$define_theme_xtreme_209e = false;
$avatar_overide_size = '150';
$make_xtreme_avatar_small = true;
$use_xtreme_voting = false;

$bgcolor1   = $ThemeInfo['bgcolor1'];
$bgcolor2   = $ThemeInfo['bgcolor2'];
$bgcolor3   = $ThemeInfo['bgcolor3'];
$bgcolor4   = $ThemeInfo['bgcolor4'];
$textcolor1 = $ThemeInfo['textcolor1'];
$textcolor2 = $ThemeInfo['textcolor2'];

?>
<table class="tabletwo" width="100%" cellspacing="2" cellpadding="2" >
<tr>
<td class="tabletwo" width="199" valign="top" cellspacing="2" cellpadding="2">
</td>
<td align="left" width="100%" valign="top" >
        <?
        echo '<hr /><font size="3" color="'.$bgcolor1.'">The <strong>Titanium </strong> Sandbox Module '
		. ' v'.NUKE_TITANIUM.' : This module is only for <strong>PHP-Nuke Titanium</strong> '
		. 'application builders. A sandbox is a testing environment that isolates '
		. 'untested code changes. This module was designed for the developers over at The 86it Developers Network, it gives the user a place to test random PHP code and is a good way '
		. 'to start learning PHP-Nuke Titanium, PHP, Java, cURL or just about any online programming language you can think of. There are no limits when it comes to The 86it Developers Network, they allow you full '
		. 'access to any programming language that you would like to explore.<hr>'
		
		
		. '<div align="center"><strong>Languages Available:</strong> '
		. 'HTML - HyperText Markup Language, CGI - Common Gateway Interface, Javascript, Java, PHP, XML - eXtensible Markup Language, Perl, Python, '
		. 'cURL, Linux C</div>'
		. '<hr />'
		
		. 'Below you will find links that will load the example templates. You can open the corresponding PHP files in Dream Weaver or Visual Studio Coode to explore and learn new ways to code.'
		. 'Click on any of the links and then scroll down the page, and you will see that it has loaded the example for you to view before you explore the source code!'
		. '</font>';
		
		?>
</td>
</tr>
<td colspan="2">
<?

echo "</table>";
CloseTable2();
##########################################################
# Choices are:                                           #
# 'development' - 'testing' and 'production'             ################ SET YOUR ENVIRONMENT
define('DEV_ENVIRONMENT', 'development');                #
##########################################################

#############################################################
# Test Code Example File Names                              #              ###################################################################################################
# 0. $testfile = 'x-clean_slate_template.php';              ##9/15/2017    #
# 1. $testfile = '';                                        #              # You would load you proect file here (somefilename.php) model it oafter the template.php file
# 2. $testfile = 'php5_audiotag_example.php';               ################ SET THE NAME OF THE FILE YOU ARE WORKING IN (this file resides in the root of Titanium_SandBox)
# 3. $testfile = 'host_information.php';                    #              ###################################################################################################
# 4. $testfile = 'x-browser_check.php';                     # 
# 5. $testfile = 'project_template.php';              <---- ##### Added 1/8/2012 by Ernest Buffington 
# 6. $testfile = 'facebook_testing_template.php';     <---- ##### Added 4/5/2012 by Ernest Buffington 
# 7. $testfile = 'x-file_get_contents_example.php';   <---- ##### Added 9/5/2017 by Ernest Buffington 
#############################################################
global $testfile;

if ($mode == 0)
$testfile = 'x-clean_slate_template.php';
if ($mode == 1)
$testfile = 'x-fullscreen_shockwave_example.php';
if ($mode == 2)
$testfile = 'facebook_testing_template.php';
if ($mode == 3)
$testfile = 'host_information.php';     
if ($mode == 4)
$testfile = 'x-browser_check.php';        
if ($mode == 5) 
$testfile ='project_template.php';
if ($mode == 6)
$testfile ='php5_audiotag_example.php';
if ($mode == 7)
$testfile ='x-file_get_contents_example.php';



if (defined('DEV_ENVIRONMENT'))
{
	switch (DEV_ENVIRONMENT)
	{
		case 'development':
		echo "<hr><br />";
		echo '<center><h1>CURRENT SELECTED TEMPLATE FILE IS <font color=cc0000>'.$testfile.'</font></h1></center>'; 
        include (MODULES.'Titanium_SandBox/'.$testfile);
		echo '<center><h1>Titanium SandBox Files & Information</h1></center>';
        include (MODULES.'Titanium_SandBox/includes/file_information_loader.php');
		break;
		case 'testing':
		echo '<b>SandBox mode : TESTING</b><br />';
        include (MODULES.'Titanium_SandBox/'.$testfile);
		echo "<br /><hr>";
        include (MODULES.'Titanium_SandBox/includes/file_information_loader.php');
		case 'production':
		echo '<b>SandBox mode : PRODUCTION</b><br />';
        include (MODULES.'Titanium_SandBox/'.$testfile);
		echo "<br /><hr>";
        include (MODULES.'Titanium_SandBox/includes/file_information_loader.php');
		break;
		default:
			exit('The application environment is not set correctly.');
	}
}


$fpr = img('finger-pointing-right-icon.png', 'Titanium_SandBox');
$fpr_img = "<img align=\"absbottom\" width=\"25\" src=\"$fpr\" border=\"0\">";                                      

global $domain;

echo '<span class=\"supersmall\">';
OpenTable();

echo '<b>[ SANDBOX EXAMPLE LINKS ] CLICK ON ONE OF THE FOLLOWING LINKS TO LOAD THE EXAMPLE TEMPLATE!</b><br>';

## 0 (x-clean_slate_template.php)
echo  "<hr><font class=\"supersmall\">This files can be found in the folder \"</font><font class=\"supersmall\" color=\"#326b21\">$domain/modules/Titanium_SandBox/x-clean_slate_template.php</color><font color=\"#000000\">\"</color></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=0"> Click Here -> [ CLEAN SLATE TEMPLATE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 7/30/2013</br>';


## 1 (does not exist)
echo  "<hr>Thise files can be found in the folder \"<font color=\"#326b21\">$domain/modules/Titanium_SandBox/x-fullscreen_shockwave_example.php</color><font color=\"#000000\">\"</color></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=1"> Click Here -> [ FULL SCREEN SHOCKWAVE EXAMPLE TEMPLATE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 9/15/2017</br>';


## 2 (php5_audiotag_example.php)
echo  "<hr>Thise files can be found in the folder \"<font color=\"#326b21\">$domain/modules/Titanium_SandBox/php5_audiotag_example.php</color><font color=\"#000000\">\"</color></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=2"> Click Here -> [ FACEBOOK CODE EXAMPLE TEMPLATE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 7/30/2013</br>';

## 3 (host_information.php)
echo  "<hr>Thise files can be found in the folder \"<font color=\"#326b21\">$domain/modules/Titanium_SandBox/host_information.php</color><font color=\"#000000\">\"</color></br>";
echo $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=3">Click Here -> [ HOST INFORMATION TEMPLATE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 6/20/2012</br>';

## 4 (x-browser_check.php)
echo  "<hr>Thise files can be found in the folder \"<font color=\"#326b21\">$domain/modules/Titanium_SandBox/x-browser_check.php</color><font color=\"#000000\">\"</color></br>";
echo $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=4">Click Here -> [ BROWSER CHECK TEMPLATE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 1/1/2010</br>';

## 5 (project_template.php)
echo  "<hr>Thise files can be found in the folder \"<font color=\"#326b21\">$domain/modules/Titanium_SandBox/project_template.php</color><font color=\"#000000\">\"</color></br>";
echo $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=5">Click Here -> [ FLASH DISPLAY EXAMPLE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 3/01/2012</br>';        

## 6 (facebook_testing_template.php)
echo  "<hr>Thise files can be found in the folder \"<font color=\"#326b21\">$domain/modules/Titanium_SandBox/facebook_testing_template.php</color><font color=\"#000000\">\"</color></br>";
echo $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=6">Click Here -> [ HTML 5 AUDIO EXAMPLE TEMPLATE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 6/20/2012</br>';

## 7 (x-file_get_contents_example.php)
echo  "<hr>Thise files can be found in the folder \"<font color=\"#326b21\">$domain/modules/Titanium_SandBox/x-file_get_contents_example.php</color><font color=\"#000000\">\"</color></br>";
echo $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=7">Click Here -> [ cURL EXAMPLE TEMPLATE ]</a> <font color="#C00000">Written by Ernest Allen Buffington</font> 9/05/2017</br>';

CloseTable();
echo "</span>";

//include (MODULES.'Titanium_SandBox/facebook/custom_share_axample_01.php'); //this must be loaded for facebook purposes
//include (MODULES.'Titanium_SandBox/facebook/standard_comments.php'); //this must be loaded for facebook purposes 	
CloseTable();
include("footer.php");	
?> 
