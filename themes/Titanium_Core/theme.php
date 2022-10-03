<?php
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Titanium_Core Theme v2.0 (Fixed & Full Width)                                         #
#                                                                                       #
# Final Build Date 03/16/2021 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Gold Theme Design.                                                        #
# Copyright © 2021 By: TheGhost AKA EA Buffington                                       #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 03/16/2021 Tuesday 12:54am (v1.0)                                         #
#                                                                                       #
# Credit goes to Lonestar On: 1st August, 2019 (v3.0)                                   #
# HTML5 Theme Code By: Lonestar (Lonestar-Modules.com)                                  #
#                                                                                       #
# Credit goes to TheMortal                                                              #
# For his CSS MENU                                                                      #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost & Sebastian                                                     #
# Web Site: https://www.86it.us                                                         #
# Purpose: PHP-Nuke Titanium                                                            #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# Nuke Evolution Xtreme (c) 2010 : Enhanced PHP-Nuke Web Portal System                  #
# PHP-Nuke Titanium (c) 2021     : Enhanced PHP-Nuke Web Portal System                  #
#---------------------------------------------------------------------------------------#
#                                                                                       #
# Special Honorable Mentions                                                            #
#---------------------------------------------------------------------------------------#
# killigan                                                                              # 
# -[04/17/2010] Updated Nuke Sentinel to version 2.6.01                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# SgtLegend                                                                             #   
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
# -[04/18/2010] Updated the installer/upgrade files and display                         #
# -[04/19/2010] Improved load time for global variables                                 #
# -[04/21/2010] Upgraded Swift mail to version 4.0.6                                    #
# -[04/21/2010] Upgraded HTML Purifier to version 4                                     # 
#---------------------------------------------------------------------------------------#
# Technocrat                                                                            # 
# -[04/22/2010] Added speed tweaks to the cache and PHP version compare                 #  
#---------------------------------------------------------------------------------------#
# Eyecu                                                                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# Wolfstar                                                                              # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');

#000000
#11111
#222222
#333333

#-----------------------------#
# Theme Copyright Information #
#-----------------------------#
global $locked_width, $theme_business, $theme_title, $theme_author, $theme_date, $theme_name, $theme_download_link;
//$locked_width = "1633px"; is as small as this theme can go without messing things up
$locked_width = "1840px";
$theme_business = 'Brandon Maintenance Management, LLC';
# Theme Name
$theme_title = '<u>PHP-Nuke Titanium Core Theme v2.0 &copy; 2022</u>';
define('THEME', $theme_title);
# Theme Author
$theme_author = 'Ernest Allen Buffington';
define('THEME_AUTHOR', $theme_author);
# Theme creation date
$theme_date = '05/04/2021';
define('THEME_DATE', $theme_date);
$theme_download_link = '#myCopyRight';
define('THEME_DOWNLOAD_LINK', $theme_download_link);


$theme_name = basename(dirname(__FILE__));

#--------------------------#
# Theme Management Section #
#--------------------------#
include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');

# your admin id - this will normally be 2
$portaladmin = 2;

       global $powered_by, 
      $my_welcome_message, 
           $eighty_six_it, 
	        $digits_color,
		$digits_txt_color, 
   $fieldset_border_width, 
          $fieldset_color, 
$define_theme_xtreme_209e, 
     $avatar_overide_size, 
	           $ThemeInfo, 
	   $use_xtreme_voting, 
$make_xtreme_avatar_small,
                      $titanium_db;

    list($portaladminname, 
	              $avatar, 
				   $email) = $titanium_db->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `titanium_users` WHERE `user_id`=$portaladmin", SQL_NUM);
				   
# be sure and set your user number in the config.php file.
//$my_welcome_message = '<a class = "welcome" href="'.$domain.'">Welcome to The 86it Developers Network</a>';
//$my_welcome_message = '<a class = "welcome" href="'.$domain.'">Welcome to The Groom Lake Developers Facilty <font color="#FF9900" size="1.2">86it™</font></a>';
$my_welcome_message = '<a class = "welcome" href="'.HTTPS.'">PHP-Nuke Titanium Dev 4 <font color="#FF9900" size="1">(Desktop Version)</font></a>';

# This is to tell the main portal menu to look for the images
# in the theme dir "theme_name/images/menu"
global $use_theme_image_dir_for_portal_menu;
$use_theme_image_dir_for_portal_menu = false;

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

define('theme_dir', 'themes/'.$theme_name.'/');
define('theme_images_dir', theme_dir.'images/');
define('theme_style_dir', theme_dir.'style/');

define('theme_phpstyle_dir', theme_dir.'css/'); 

define('theme_js_dir', theme_style_dir.'js/');
define('theme_hdr_images', theme_images_dir.'hdr/');
define('theme_ftr_images', theme_images_dir.'ftr/');

define('theme_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));

define('theme_copyright', ''.$theme_title.' Designed By: TheGhost<br />Copyright &copy '.date('Y').' The 86it Developers Network<br />All Rights Reserved');
define('theme_copyright_click', 'Click the Link to Display Copyrights');

addCSSToHead(theme_style_dir.'style.css','file');
addCSSToHead(theme_style_dir.'menu.css','file');

#-------------------#
# FlyKit Mod v1.0   #
#-------------------#
addPHPCSSToHead(theme_phpstyle_dir.'banner_ads.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'menu.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'header.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'scrollbars.php','file'); 
addPHPCSSToHead(theme_phpstyle_dir.'sideblocks.php','file'); 
addPHPCSSToHead(theme_phpstyle_dir.'body.php','file');       
addPHPCSSToHead(theme_phpstyle_dir.'footer.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'maintable.php','file');  
addPHPCSSToHead(theme_phpstyle_dir.'CKeditor.php','file');   
addPHPCSSToHead(theme_phpstyle_dir.'jquery_floating_admin.php','file');    
#-------------------#
# OpenTable Section #
#-------------------#
include_once(theme_dir.'function_OpenTable.php');
include_once(theme_dir.'function_CloseTable.php');
include_once(theme_dir.'function_OpenTable2.php');
include_once(theme_dir.'function_CloseTable2.php');
include_once(theme_dir.'function_OpenTable3.php');
include_once(theme_dir.'function_CloseTable3.php');
include_once(theme_dir.'function_OpenTable4.php');
include_once(theme_dir.'function_CloseTable4.php');

#---------------------#
# FormatStory Section #
#---------------------#
include_once(theme_dir.'function_FormatStory.php');

#----------------#
# Header Section #
#----------------#
function themeheader(){	include_once(theme_dir.'header.php'); }

#----------------#
# Footer Section #
#----------------#
function themefooter(){ include_once(theme_dir.'footer.php'); }

#--------------------#
# News Index Section #
#--------------------#
include_once(theme_dir.'function_themeindex.php');

#----------------------#
# News Article Section #
#----------------------#
include_once(theme_dir.'function_themearticle.php');

#-------------------#
# Centerbox Section #
#-------------------#
include_once(theme_dir.'function_themecenterbox.php');

#-----------------#
# Preview Section #
#-----------------#
include_once(theme_dir.'function_themepreview.php');

#-----------------#
# Sidebox Section #
#-----------------#
include_once(theme_dir.'function_themesidebox.php');
?>
