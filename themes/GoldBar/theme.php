<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

#-----------------------------#
# Theme Copyright Information #
#-----------------------------#
global $locked_width, $theme_business, $theme_title, $theme_author, $theme_date, $theme_name, $theme_download_link;
//$locked_width = "1633px"; is as small as this theme can go without messing things up
$locked_width = "1840px";
$theme_business = 'Brandon Maintenance Management, LLC';
# Theme Name
$theme_title = '<u>PHP-Nuke Titanium Template Theme v2.0 &copy; 2022</u>';
define('THEME', $theme_title);
# Theme Author
$theme_author = 'Ernest Allen Buffington';
define('THEME_AUTHOR', $theme_author);
# Theme creation date
$theme_date = '10/09/2022';
define('THEME_DATE', $theme_date);
$theme_download_link = '#myCopyRight';
define('THEME_DOWNLOAD_LINK', $theme_download_link);
$theme_name = basename(dirname(__FILE__));

/*--------------------------*/
/* Theme Management Section */
/*--------------------------*/
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
                      $db;

    list($portaladminname, 
	              $avatar, 
				   $email) = $db->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `nuke_users` WHERE `user_id`=$portaladmin", SQL_NUM);
				   
$my_welcome_message = '<a class = "welcome" href="'.HTTPS.'">PHP-Nuke Titanium <font color="#FF9900" size="1">(Desktop Version)</font></a>';

/*-------------------------*/
/* Theme Colors Definition */
/*-------------------------*/
global $opacity, $digits_color, $fieldset_border_width, $fieldset_color, $define_theme_xtreme_209e, $avatar_overide_size, $ThemeInfo, $use_xtreme_voting, $make_xtreme_avatar_small;

$opacity = '0.9';
# This is to tell the main portal menu to luook for the images
# in the theme dir "theme_name/images/menu"
global $use_theme_image_dir_for_portal_menu;
$use_theme_image_dir_for_portal_menu = false;

$digits_color ='#ffb825';
$fieldset_border_width = '1px'; 
$fieldset_color = '#4e4e4e';
$define_theme_xtreme_209e = true;
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

define('theme_copyright', 'Gold Bar Theme Designed By: Ernest Allen Buffington<br />Copyright &copy '.date('Y').' Brandon Maintenance Management<br />All Rights Reserved');
define('theme_copyright_click', 'Click the Link to Display Copyrights');

addCSSToHead(theme_style_dir.'style.css','file');
addCSSToHead(theme_style_dir.'menu.css','file');

#-------------------#
# FlyKit Mod v1.0   #
#-------------------#
addPHPCSSToHead(theme_phpstyle_dir.'style.php','file');
addPHPCSSToHead(theme_phpstyle_dir.'body.php','file');
addPHPCSSToHead(theme_phpstyle_dir.'banner_ads.php','file');              
addPHPCSSToHead(theme_phpstyle_dir.'modal.php','file');
addPHPCSSToHead(theme_phpstyle_dir.'menu.php','file');       
addPHPCSSToHead(theme_phpstyle_dir.'scrollbars.php','file');              
addPHPCSSToHead(theme_phpstyle_dir.'CKeditor.php','file');              

/*-------------------*/
/* OpenTable Section */
/*-------------------*/
include_once(theme_dir.'function_OpenTable.php');
include_once(theme_dir.'function_CloseTable.php');

include_once(theme_dir.'function_OpenTable2.php');
include_once(theme_dir.'function_CloseTable2.php');

/*---------------------*/
/* FormatStory Section */
/*---------------------*/
function FormatStory($thetext, $notes, $aid, $informant) {

  global $anonymous;

  $notes = !empty($notes) ? '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>' : '';	

  if ($aid == $informant) 
  { 
    echo '<span class="content" color="#505050">'.$thetext.$notes.'</span>'; 
  } 
  else 
  {
     if (defined('WRITES')) 
	 {
	    if (!empty($informant)): 
         if ( is_array($informant) ): $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a>'; else:
            $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>';
         endif;
        else:
            $boxstuff = $anonymous.' ';
        endif;
            $boxstuff .= _WRITES.' <em>'.$thetext.'</em>'.$notes;
     } 
     else 
     {
            $boxstuff .= $thetext . $notes;
     }
      
	  echo '<span class="content" color="#505050">' . $boxstuff . '</span>';
   }
}

/*----------------*/
/* Header Section */
/*----------------*/
function themeheader() {
include_once(theme_dir.'header.php');
}

/*----------------*/
/* Footer Section */
/*----------------*/
function themefooter() {
include_once(theme_dir.'footer.php');
}

/*--------------------*/
/* News Index Section */
/*--------------------*/
include_once(theme_dir.'function_themeindex.php');

/*----------------------*/
/* News Article Section */
/*----------------------*/
include_once(theme_dir.'function_themearticle.php');

/*-------------------*/
/* Centerbox Section */
/*-------------------*/
include_once(theme_dir.'function_themecenterbox.php');

/*-----------------*/
/* Preview Section */
/*-----------------*/
function themepreview($title, $hometext, $bodytext='', $notes='') 
{
echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
echo (!empty($bodytext)) ? '<br /><br />'.$bodytext : '';
echo (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>' : '';
}

/*-----------------*/
/* Sidebox Section */
/*-----------------*/
include_once(theme_dir.'function_themesidebox.php');
?>
