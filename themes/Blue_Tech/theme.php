<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) { exit('Access Denied'); }

#-----------------------------#
# Theme Globals               #
#-----------------------------#

       global $powered_by,
	          $theme_name, 
	   $menu_image_height,
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
$locked_width = "1890px";
echo "<!-- Setting locked THEME width to ".$locked_width," in themes/".$theme_name."/theme.php -->\n";

$side_block_width = "295px";
echo "<!-- Setting Side Block THEME width to ".$side_block_width," in themes/".$theme_name."/theme.php -->\n";

$theme_business = 'Brandon Maintenance Management, LLC';
echo "<!-- Setting THEME Business to ".$theme_business," in themes/".$theme_name."/theme.php -->\n";

# Theme Name
$theme_title = '<u>Blue Tech Theme v1.0 &copy; 2022</u>';
echo "<!-- Setting THEME name to ".$theme_title," in themes/".$theme_name."/theme.php -->\n";
define('THEME', $theme_title);

$theme_overview = 'BOOTSTRAP 3.4.1 / XHTML 1.0';
echo "<!-- Setting Features to ".$theme_overview," in themes/".$theme_name."/theme.php -->\n";
define('THEME_OVERVIEW', $theme_overview);

# Theme Author
$theme_author = 'Ernest Allen Buffington';
echo "<!-- Setting THEME Author to ".$theme_author," in themes/".$theme_name."/theme.php -->\n";
define('THEME_AUTHOR', $theme_author);

# Theme creation date
$theme_date = '11/29/2022';
echo "<!-- Setting THEME DATE to ".$theme_date," in themes/".$theme_name."/theme.php -->\n";
define('THEME_DATE', $theme_date);

$theme_download_link = '#myCopyRight';
echo "<!-- Setting THEME DOWNLOAD LINK to ".$theme_download_link," in themes/".$theme_name."/theme.php -->\n";
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

#---------------------------------#
# Adjust T images for Portal Menu #
#---------------------------------#
$menu_image_height = '24';
echo "<!-- Setting Menu image height to ".$menu_image_height." in themes/".$theme_name."/theme.php -->\n";

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
function themeheader()
{	
include_once(theme_dir.'copyright.php'); 
include_once(theme_dir.'header.php'); 
}

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
