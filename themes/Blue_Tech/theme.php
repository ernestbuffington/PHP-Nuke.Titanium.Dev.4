<?php
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) { exit('Access Denied'); }

#-----------------------------#
# Theme Globals               #
#-----------------------------#

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
            $locked_width,
			      $domain,
				$bgcolor1,
                $bgcolor2,
                $bgcolor3,
                $bgcolor4,
              $textcolor1,
              $textcolor2,
		   $marquee_color,
                      $db;

#-----------------------------#
# Setup Admin ID              #
#-----------------------------#
    $portaladmin = 2; # This should be in your config file! Define Here if as a catch all...

    list($portaladminname, 
	              $avatar, 
				   $email) = $db->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `nuke_users` WHERE `user_id`=$portaladmin", SQL_NUM);

#-----------------------------#
# Theme Copyright Information #
#-----------------------------#
$theme_business = 'Brandon Maintenance Management, LLC';
# Theme Name
$theme_title = '<u>Blue Tech v1.0 &copy; 2022</u>';
define('THEME', $theme_title);
# Theme Author
$theme_author = 'Ernest Allen Buffington';
define('THEME_AUTHOR', $theme_author);
# Theme creation date
$theme_date = '10/16/2022';
define('THEME_DATE', $theme_date);
$theme_download_link = '#myCopyRight';
define('THEME_DOWNLOAD_LINK', $theme_download_link);

#-----------------------------#
# Theme Directory Setup       #
#-----------------------------#
$theme_name = basename(dirname(__FILE__));

#--------------------------#
# Theme Management Section #
#--------------------------#
include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');


#--------------------------#
# Theme Welcome Message    #
#--------------------------#
$my_welcome_message = '<a class = "welcome" href="'.$domain.'">Welcome to PHP-Nuke Titanium</a>';

#-------------------------------------------------------------#
# This is to tell the main portal menu to look for the images #
# in the theme dir "theme_name/images/menu"                   #
# Set if theme needs special images for the Portal Menu       #
#-------------------------------------------------------------#
global $use_theme_image_dir_for_portal_menu;
$use_theme_image_dir_for_portal_menu = false;

#-------------------------#
# Locked Desktop Width    #
#-------------------------#
$locked_width = "1827px";

#---------------------------------------------#
# Set to True if you ported a Evolution Theme #
#---------------------------------------------#
$define_theme_xtreme_209e = false;
$use_xtreme_voting = false;
$make_xtreme_avatar_small = true;
$avatar_overide_size = '150';

#-------------------------#
# Theme Colors Definition #
#-------------------------#
$digits_txt_color ='yellow';  # Reads
$digits_color ='#FF0000';     # How many reads
$fieldset_border_width = '1px'; 
$fieldset_color = '#4e4e4e';
$marquee_color = '#3b6c91';
$bgcolor1   = $ThemeInfo['bgcolor1'];
$bgcolor2   = $ThemeInfo['bgcolor2'];
$bgcolor3   = $ThemeInfo['bgcolor3'];
$bgcolor4   = $ThemeInfo['bgcolor4'];
$textcolor1 = $ThemeInfo['textcolor1'];
$textcolor2 = $ThemeInfo['textcolor2'];

#---------------------------------#
# Setup Theme Directory Structure #
#---------------------------------#
define('theme_dir', 'themes/'.$theme_name.'/');
define('theme_images_dir', theme_dir.'images/');
define('theme_style_dir', theme_dir.'style/');
define('theme_phpstyle_dir', theme_dir.'css/'); 
define('theme_js_dir', theme_style_dir.'js/');
define('theme_hdr_images', theme_images_dir.'hdr/');
define('theme_ftr_images', theme_images_dir.'ftr/');

#---------------------------------#--- You assholes that want to use cell phones, Z-Gen dispshits, get a clue! Buy A Computer with a decent monitor!
# Setup Container Width           #--- Not Needed for Desktop Applications (we use locked container width to keep from distorting the layout!)
#---------------------------------#--- This is not a cell phone theme it is for people who can afford computerswith a decent monitor!
define('theme_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));

#-------------------#
# Standard CSS      #--- This is where we move everything once the theme design is finished!
#-------------------#
# addCSSToHead(theme_style_dir.'style.css','file');
# addCSSToHead(theme_style_dir.'menu.css','file');

#-------------------#
# FlyKit Mod v1.0   #
#-------------------#
addPHPCSSToHead(theme_phpstyle_dir.'header.php','file');
addPHPCSSToHead(theme_phpstyle_dir.'primary_page_styles.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'tables.php','file');          
addPHPCSSToHead(theme_phpstyle_dir.'modal.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'scrollbars.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'banner_ads.php','file');
addPHPCSSToHead(theme_phpstyle_dir.'marquee.php','file');          
addPHPCSSToHead(theme_phpstyle_dir.'menu.php','file');          
addPHPCSSToHead(theme_phpstyle_dir.'body.php','file');       
addPHPCSSToHead(theme_phpstyle_dir.'sideblocks.php','file'); 
addPHPCSSToHead(theme_phpstyle_dir.'maintable.php','file');  
addPHPCSSToHead(theme_phpstyle_dir.'CKeditor.php','file');   
addPHPCSSToHead(theme_phpstyle_dir.'footer.php','file');     
addPHPCSSToHead(theme_phpstyle_dir.'Nuke_Projects.php','file');
addPHPCSSToHead(theme_phpstyle_dir.'avatar_overide.php','file');          
addPHPCSSToHead(theme_phpstyle_dir.'forum.php','file');          

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
