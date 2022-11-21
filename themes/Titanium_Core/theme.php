<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
exit('Access Denied');
endif;

             global $locked_width, 
	              $theme_business, 
		             $theme_title, 
			        $theme_author, 
			          $theme_date, 
			          $theme_name, 
 $theme_download_link,$powered_by, 
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
	                 $portaladmin,
			             $opacity,
        $make_xtreme_avatar_small,
                 $poweredby_color,
	           $menu_image_height,
                              $db;

$theme_name = basename(dirname(__FILE__));

echo "<!-- Loading theme_info.php from themes/".$theme_name."/theme.php -->\n";
include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');

#-----------------------------#
# Theme Copyright Information #
#-----------------------------#
//$locked_width = "1633px"; is as small as this theme can go without messing things up
$locked_width = "1840px";
echo "<!-- Setting locked THEME width to ".$locked_width," in themes/".$theme_name."/theme.php -->\n";

$theme_business = 'Brandon Maintenance Management, LLC';
echo "<!-- Setting THEME Business to ".$theme_business," in themes/".$theme_name."/theme.php -->\n";

# Theme Name
$theme_title = '<u>GoldBar Theme v3.0 &copy; 2022</u>';
echo "<!-- Setting THEME name to ".$theme_title," in themes/".$theme_name."/theme.php -->\n";
define('THEME', $theme_title);

$theme_overview = 'BOOTSTRAP 3.4.1 / HTML5 / XHTML5';
echo "<!-- Setting Features to ".$theme_overview," in themes/".$theme_name."/theme.php -->\n";
define('THEME_OVERVIEW', $theme_overview);

# Theme Author
$theme_author = 'Ernest Allen Buffington';
echo "<!-- Setting THEME Author to ".$theme_author," in themes/".$theme_name."/theme.php -->\n";
define('THEME_AUTHOR', $theme_author);

# Theme creation date
$theme_date = '11/01/2022';
echo "<!-- Setting THEME DATE to ".$theme_date," in themes/".$theme_name."/theme.php -->\n";
define('THEME_DATE', $theme_date);

$theme_download_link = '#myCopyRight';
echo "<!-- Setting THEME DOWNLOAD LINK to ".$theme_download_link," in themes/".$theme_name."/theme.php -->\n";
define('THEME_DOWNLOAD_LINK', $theme_download_link);

#--------------------------#
# Theme Management Section #
#--------------------------#

# your admin id - this will normally be 2 Set this to the MAIN ADMIN NUMBER
$portaladmin = 3;
echo "<!-- Setting MAIN ADMIN TO ".$portaladmin." in themes/".$theme_name."/theme.php -->\n";

/*
    list($portaladminname, 
	              $avatar, 
				   $email) = $db->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `nuke_users` WHERE `user_id`=$portaladmin", SQL_NUM);

$eighty_six_it = '<div class="eightysixit1stline"><a href="https://www.86it.us" target="_blank" rel="noopener noreferrer">Programmers Making Connections. Coders Making a Difference.</a></div>';
$my_welcome_message = '<div class="eightysixit2ndline"><a href="'.HTTPS.'"><font color="#FF9900" size="5">PHP-Nuke Titanium</font> </a><font align="absmiddle" color="#FF9900" size="1">(Desktop Version)</font></div>';
*/

$opacity = '0.9';
echo "<!-- Setting Main Opacity to ".$opacity." in themes/".$theme_name."/theme.php -->\n";

# This is to tell the main portal menu to look for the images
# in the theme dir "theme_name/images/menu"
global $use_theme_image_dir_for_portal_menu;
$use_theme_image_dir_for_portal_menu = false;

if ($use_theme_image_dir_for_portal_menu === true):
echo "<!-- Setting Load Menu Images From THEME dir in themes/".$theme_name."/theme.php -->\n";
else:
echo "<!-- Setting Load Menu Images From ROOT dir in themes/".$theme_name."/theme.php -->\n";
endif;

#---------------------------------#
# Adjust T images for Portal Menu #
#---------------------------------#
$menu_image_height = '24';
echo "<!-- Setting Menu image height to ".$menu_image_height." in themes/".$theme_name."/theme.php -->\n";

#-------------------------#
# Theme Colors Definition #
#-------------------------#
$digits_txt_color ='yellow';  # Reads
echo "<!-- Setting THEME digits text color to ".$digits_txt_color." in themes/".$theme_name."/theme.php -->\n";

$digits_color ='#FF0000';     # How many reads
echo "<!-- Setting THEME digits color to ".$digits_color." in themes/".$theme_name."/theme.php -->\n";

$poweredby_color = 'goldenrod';
echo "<!-- Setting THEME Powered By Text color to ".$digits_color." in themes/".$theme_name."/theme.php -->\n";

$menu_text_color = 'white';
echo "<!-- Setting THEME Menu Text to ".$digits_color." in themes/".$theme_name."/theme.php -->\n";

$fieldset_border_width = '1px'; 
echo "<!-- Setting THEME filedset border width to ".$fieldset_border_width." in themes/".$theme_name."/theme.php -->\n";

$fieldset_color = '#4e4e4e';
echo "<!-- Setting THEME filedset color to ".$fieldset_color." in themes/".$theme_name."/theme.php -->\n";

$define_theme_xtreme_209e = false;
echo "<!-- Setting THEME Xtreme Conversion to FALSE in themes/".$theme_name."/theme.php -->\n";

$make_xtreme_avatar_small = true;
echo "<!-- Setting THEME avatar to SMALL in themes/".$theme_name."/theme.php -->\n";

$avatar_overide_size = '150'; # do not add px to the end!
echo "<!-- Setting THEME Avatar Override size to ".$avatar_overide_size." in themes/".$theme_name."/theme.php -->\n";

$use_xtreme_voting = false;
echo "<!-- Setting THEME Xtreme Style Voting to FALSE in themes/".$theme_name."/theme.php -->\n";

$bgcolor1   = $ThemeInfo['bgcolor1'];
echo "<!-- Setting THEME Background Color 1 to ".$bgcolor1." in themes/".$theme_name."/theme.php -->\n";

$bgcolor2   = $ThemeInfo['bgcolor2'];
echo "<!-- Setting THEME Background Color 2 to ".$bgcolor2." in themes/".$theme_name."/theme.php -->\n";

$bgcolor3   = $ThemeInfo['bgcolor3'];
echo "<!-- Setting THEME Background Color 3 to ".$bgcolor3." in themes/".$theme_name."/theme.php -->\n";

$bgcolor4   = $ThemeInfo['bgcolor4'];
echo "<!-- Setting THEME Background Color 4 to ".$bgcolor4." in themes/".$theme_name."/theme.php -->\n";

$textcolor1 = $ThemeInfo['textcolor1'];
echo "<!-- Setting THEME Text Color 1 to ".$textcolor1." in themes/".$theme_name."/theme.php -->\n";

$textcolor2 = $ThemeInfo['textcolor2'];
echo "<!-- Setting THEME Text Color 2 to ".$textcolor2." in themes/".$theme_name."/theme.php -->\n";

define('theme_dir', 'themes/'.$theme_name.'/');
echo "<!-- Setting THEME DIR to ".theme_dir." in themes/".$theme_name."/theme.php -->\n";

define('theme_images_dir', theme_dir.'images/');
echo "<!-- Setting THEME IMAGES DIR to ".theme_images_dir." in themes/".$theme_name."/theme.php -->\n";

define('theme_style_dir', theme_dir.'style/');
echo "<!-- Setting THEME STYLE DIR to ".theme_style_dir." in themes/".$theme_name."/theme.php -->\n";

define('theme_js_dir', theme_style_dir.'js/');
echo "<!-- Setting THEME STYLE JS DIR to ".theme_js_dir." in themes/".$theme_name."/theme.php -->\n";

define('theme_hdr_images', theme_images_dir.'hdr/');
echo "<!-- Setting THEME HEADER IMAGES DIR to ".theme_hdr_images." in themes/".$theme_name."/theme.php -->\n";

define('theme_ftr_images', theme_images_dir.'ftr/');
echo "<!-- Setting THEME FOOTER IMAGES DIR to ".theme_ftr_images." in themes/".$theme_name."/theme.php -->\n";

if(empty($locked_width)):
 define('theme_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));
 echo "<!-- Setting THEME WIDTH to ".theme_width." in themes/".$theme_name."/theme.php -->\n";
endif;

//addCSSToHead(theme_style_dir.'style.css','file');

//addCSSToHead(theme_style_dir.'menu.css','file');

#-------------------#
# FlyKit Mod v1.0   #
#-------------------#
define('theme_phpstyle_dir', theme_dir.'css/'); 
echo "\n<!-- Setting THEME PHP STYLE DIR to ".theme_phpstyle_dir." in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

define('theme_phpinclude_js_dir', theme_dir.'includes/js/'); 
echo "<!-- Setting THEME INCLUDES JS DIR to ".theme_phpinclude_js_dir." in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'header.php','file');     
echo "<!-- Setting Loading themes/".$theme_name."/css/header.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'banner_ads.php','file');     
echo "<!-- Setting Loading themes/".$theme_name."/css/banner_ads.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'menu.php','file');     
echo "<!-- Setting Loading themes/".$theme_name."/css/menu.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'scrollbars.php','file'); 
echo "<!-- Setting Loading themes/".$theme_name."/css/scrollbars.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'sideblocks.php','file'); 
//echo "<!-- Setting Loading themes/".$theme_name."/css/sideblocks.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'body.php','file');       
echo "<!-- Setting Loading themes/".$theme_name."/css/body.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'footer.php','file'); 
//echo "<!-- Setting Loading themes/".$theme_name."/css/footer.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'drop_down_menu.php','file'); # enable for drop_down_menu         
//echo "<!-- Setting Loading themes/".$theme_name."/css/drop_down_menu.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'scss_menu.php','file'); # enable for SCSS drop_down_menu         
//echo "<!-- Setting Loading themes/".$theme_name."/css/scss_menu.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'css3_menu.php','file'); # enable for css3 menu
echo "<!-- Setting Loading themes/".$theme_name."/css/css3_menu.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'maintable.php','file');  
echo "<!-- Setting Loading themes/".$theme_name."/css/maintable.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'arcade_tables.php','file');  
echo "<!-- Setting Loading themes/".$theme_name."/css/arcade_tables.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'CKeditor.php','file');   
echo "<!-- Setting Loading themes/".$theme_name."/css/CKeditor.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'Nuke_Projects.php','file'); 
echo "<!-- Setting Loading themes/".$theme_name."/css/Nuke_Projects.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addJSToBody(theme_phpinclude_js_dir.'drop_down_menu.js','file'); # enable for drop_down_menu  
//echo "<!-- Setting Loading themes/".$theme_name."/includes/js/drop_down_menu.js in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addJSToBody(theme_phpinclude_js_dir.'css3_menu.js','file'); # enable for css3 menu
echo "<!-- Setting Loading themes/".$theme_name."/includes/js/css3_menu.js in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addJSToBody(theme_phpinclude_js_dir.'Hover.js','file'); # jQuery Hover
echo "<!-- Setting Loading themes/".$theme_name."/includes/js/Hover.js in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

#-------------------#
# OpenTable Section #
#-------------------#
include_once(theme_dir.'function_OpenTable.php');
echo "<!-- Loading function_OpenTable.php from themes/".$theme_name."/theme.php -->\n";

include_once(theme_dir.'function_CloseTable.php');
echo "<!-- Loading function_OpenTable.php from themes/".$theme_name."/theme.php -->\n";

include_once(theme_dir.'function_OpenTable2.php');
echo "<!-- Loading function_OpenTable2.php from themes/".$theme_name."/theme.php -->\n";

include_once(theme_dir.'function_CloseTable2.php');
echo "<!-- Loading function_CloseTable2.php from themes/".$theme_name."/theme.php -->\n";

include_once(theme_dir.'function_OpenTable3.php');
echo "<!-- Loading function_OpenTable3.php from themes/".$theme_name."/theme.php -->\n";

include_once(theme_dir.'function_CloseTable3.php');
echo "<!-- Loading function_CloseTable3.php from themes/".$theme_name."/theme.php -->\n";

include_once(theme_dir.'function_OpenTable4.php');
echo "<!-- Loading function_OpenTable4.php from themes/".$theme_name."/theme.php -->\n";

include_once(theme_dir.'function_CloseTable4.php');
echo "<!-- Loading function_CloseTable4.php from themes/".$theme_name."/theme.php -->\n";

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
