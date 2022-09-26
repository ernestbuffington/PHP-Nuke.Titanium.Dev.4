<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/**
*
* This file is part of the Titanium SandBox package.
*
* @copyright (c) PHP-Nuke Titanium 2022 
* <https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

/**
*/
if (!defined('MODULE_FILE')) { 
    Header("Location: /index.php");
	exit();
}         
$pagetitle = 'Titanium SandBox '.NUKE_TITANIUM;
$title = 'Titanium SandBox Module '.NUKE_TITANIUM;

require_once("mainfile.php");

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

include("header.php");

$index = 0;

# load the style sheet for your module
# only needed if you tables require special colors or code
echo "<link rel=\"StyleSheet\" href=\"modules/Titanium_SandBox/css/style.css\" type=\"text/css\">\n\n\n";

# this should always be loaded for use in switch statements - start
if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
else
$mode = '0';

# these globals are almost always needed 
global $domain, $facebookappid, $titanium_module_name, $ThemeSel, $name; 

# this must be loaded for facebook purposes
include (MODULES.'Titanium_SandBox/includes/functions.php'); 

#########################################################################
# Table Header Module     Fix Start - by TheGhost   v1.0.0              # 01/30/2012 Checks for OpenTableModule
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

OpenTable2();

#-------------------------#
# Theme Colors Definition ## Just here for reference
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

$fpr = img('finger-pointing-right-icon.png', 'Titanium_SandBox');
$fpr_img = "<img align=\"absbottom\" width=\"25\" src=\"$fpr\" border=\"0\">";                                      

?>
<table class="tabletwo" width="100%" cellspacing="2" cellpadding="2" >
<tr>
<td class="tabletwo" width="199" valign="top" cellspacing="2" cellpadding="2">
</td>
<td align="left" width="100%" valign="top" >
        <?
        echo '<fieldset style="border-color: '.$textcolor1.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
        echo '<br /><font size="3" color="'.$textcolor1.'">The <strong>Titanium </strong> Sandbox Module '
		. ' v'.NUKE_TITANIUM.' : This module is only for <strong>PHP-Nuke Titanium</strong> '
		. 'application builders. A sandbox is a testing environment that isolates '
		. 'untested code changes. This module was designed for the developers over at The 86it Developers Network, it gives the user a place to test random PHP code and is a good way '
		. 'to start learning PHP-Nuke Titanium, PHP, Java, cURL or just about any online programming language you can think of. There are no limits when it comes to The 86it Developers Network, they allow you full '
		. 'access to any programming language that you would like to explore.<br /><br />'
		
		
		. '<div align="left"><strong>Languages Available:</strong> '
		. 'HTML - HyperText Markup Language, CGI - Common Gateway Interface, Javascript, Java, PHP, XML - eXtensible Markup Language, Perl, Python, '
		. 'cURL, Linux C</div>'
		. '<br />'
		
		. 'Below you will find links that will load the example templates. You can open the corresponding PHP files in Dream Weaver or Visual Studio Coode to explore and learn new ways to code.'
		. 'Click on any of the links and then scroll down the page, and you will see that it has loaded the example for you to view before you explore the source code!'
		. '</font>';
		
        echo '</fieldset">';
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
# This is where you add your files STEP 1                   #
#############################################################
# Test Code Example File Names                              #              ###################################################################################################
# 0. $testfile = 'x-clean_slate_template.php';              ##9/15/2017    #
# 1. $testfile = 'x-fullscreen_shockwave_example.php';      #              # You would load your project file here (somefilename.php) model it oafter the template file
# 2. $testfile = 'x-php5_audiotag_example.php';             ################ SET THE NAME OF THE FILE YOU ARE WORKING IN (this file resides in the root of Titanium_SandBox)
# 3. $testfile = 'x-host_information.php';                  #              ###################################################################################################
# 4. $testfile = 'x-browser_check.php';                     # 
# 5. $testfile = 'x-project_template.php';            <---- ##### Added 1/8/2012 by Ernest Buffington 
# 6. $testfile = 'x-facebook_testing_template.php';   <---- ##### Added 4/5/2012 by Ernest Buffington 
# 7. $testfile = 'x-file_get_contents_example.php';   <---- ##### Added 9/5/2017 by Ernest Buffington
# 7. $testfile = 'x-bootstrap_4_modal.php';           <---- ##### Added 9/5/2022 by Ernest Buffington
#############################################################
global $testfile;

#############################################################
# This is where you add your files STEP 2                   #
#############################################################
$testfile = '';

if ($mode == 0) # default page for SandBoX
$testfile = 'x-clean_slate_template.php';
if ($mode == 1)
$testfile = 'x-fullscreen_shockwave_example.php';
if ($mode == 2)
$testfile = 'x-facebook_testing_template.php';
if ($mode == 3)
$testfile = 'x-host_information.php';     
if ($mode == 4)
$testfile = 'x-browser_check.php';        
if ($mode == 5) 
$testfile ='x-project_template.php';
if ($mode == 6)
$testfile ='x-php5_audiotag_example.php';
if ($mode == 7)
$testfile ='x-file_get_contents_example.php';
if ($mode == 8)
$testfile ='x-bootstrap_4_modal.php';



if (defined('DEV_ENVIRONMENT'))
{
	switch (DEV_ENVIRONMENT)
	{
		case 'development':
		echo "<br />";
        echo '<fieldset style="border-color: green; border-width: '.$fieldset_border_width.'; border-style: solid;">';

        include (MODULES.'Titanium_SandBox/'.$testfile);

        echo "<br />";
		
        echo '<span class=\"supersmall\">';

        echo '<div align="center"><strong>[ SANDBOX TEST LINKS ]</strong></div><br>';

############################################
# This is where you add you files STEP 3   #
######################################################################################################################################################################################
## 0 (x-clean_slate_template.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/$titanium_module_name/x-clean_slate_template.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=0"> [ CLEAN SLATE TEMPLATE ]</a> <font color="orange">Written by Ernest Allen Buffington</font> 9/15/2017</br>';
echo "</fieldset><br />";
######################################################################################################################################################################################
## 1 (does not exist)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-fullscreen_shockwave_example_description</br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=1">[ FULLS SCREEN SWF DISPLAY ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 7/30/2013</br>';
echo "</fieldset><br />";
######################################################################################################################################################################################
## 2 (x-facebook_testing_template.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-facebook_testing_template.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=2">[ FACEBOOK LOGIN CODE EXAMPLE ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 6/20/2012</br>';
echo "</fieldset><br />";
######################################################################################################################################################################################
## 3 (x-host_information.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-host_information.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=3">[ GUIDE TO ABSOLUTE PATHS ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 1/1/2010</br>';
echo "</fieldset><br />";
######################################################################################################################################################################################
## 4 (x-browser_check.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-browser_check.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=4">[ BROWSER AND OS CHECK EXAMPLE CODE ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 3/1/2012</br>';
echo "</fieldset><br />";
######################################################################################################################################################################################
## 5 (x-project_template.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-project_template.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=5">[ FLASH LAYOUT CODE EXAMPLES ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 9/5/2017</br>';
echo "</fieldset><br />";
######################################################################################################################################################################################
## 6 (x-php5_audiotag_example.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-php5_audiotag_example.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=6">[ HTML 5 AUDIO TAG EXAMPLE ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 7/30/2013</br>';
echo "</fieldset><br />";
######################################################################################################################################################################################
## 7 (x-file_get_contents_example.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-file_get_contents_example.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=7">[ cURL CODE FETCH EXAMPLE ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 7/30/2013</br>';
echo "</fieldset><br />"; 
######################################################################################################################################################################################
## 7 (x-file_get_contents_example.php)
echo '<fieldset style="border-color: white; border-width: '.$fieldset_border_width.'; border-style: solid;">'; 
echo  "This files can be found in the folder: <strong>$domain/modules/Titanium_SandBox/x-bootstrap_4_modal.php<strong></br>";
echo  $fpr_img.' <a href="modules.php?name=Titanium_SandBox&mode=8">[ Loading JQuery and Bootstrap with a few Modal Examples ]</a> <font 
color="orange">Written by Ernest Allen Buffington</font> 08/05/2022</br>';
echo "</fieldset><br />"; 
######################################################################################################################################################################################

# 8 would go here !!!

echo "</span>";
		
		echo "<br />";
		echo '';
        include (MODULES.'Titanium_SandBox/includes/file_information_loader.php');
		echo "<br /><br />";
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

if ( defined('facebook') ):
include (MODULES.'Titanium_SandBox/facebook/custom_share_axample_01.php'); # this will auto load if facebook is enabled
include (MODULES.'Titanium_SandBox/facebook/standard_comments.php');       # this will auto load if facebook is enabled 	
endif;
CloseTable();
include("footer.php");	
?> 
