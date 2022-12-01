<?php
/*=======================================================================
              PHP-Nuke Titanium | Nuke-Evolution Basic
 =======================================================================*/

/*****************************************************************************************/
/* For more commercial and public themes, custom graphics and photoshop tutorials        */
/* visit www.darkforgegfx.com                                                            */
/*****************************************************************************************/
/* For support of this great CMS visit Nuke-Evolution http://www.nuke-evolution.com      */
/* For Nuke Evolution blocks, mods and addons, please visit http://darkforgegfx.com      */
/*****************************************************************************************/
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi http://phpnuke.org                     */
/*****************************************************************************************/
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
		   $poweredby_hover_color,
	           $menu_image_height,
			    $side_block_width,
                              $db;

$theme_name = basename(dirname(__FILE__));

define('pagination', 'enabled');

echo "<!-- Loading theme_info.php from themes/".$theme_name."/theme.php -->\n";
include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');

#-----------------------------#
# Theme Copyright Information #
#-----------------------------#
//$locked_width = "1890px"; The is the only size this theme supports
$locked_width = "1890px";
echo "<!-- Setting locked THEME width to ".$locked_width," in themes/".$theme_name."/theme.php -->\n";

$side_block_width = "295px";
echo "<!-- Setting Side Block THEME width to ".$side_block_width," in themes/".$theme_name."/theme.php -->\n";

$theme_business = 'Brandon Maintenance Management, LLC';
echo "<!-- Setting THEME Business to ".$theme_business," in themes/".$theme_name."/theme.php -->\n";

# Theme Name
$theme_title = '<u>SimpleBlack Theme v3.0 &copy; 2022</u>';
echo "<!-- Setting THEME name to ".$theme_title," in themes/".$theme_name."/theme.php -->\n";
define('THEME', $theme_title);

$theme_overview = 'BOOTSTRAP 3.4.1 / HTML 4.01 Transitional';
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

#--------------------------#
# Theme Management Section #
#--------------------------#

# your admin id - this will normally be 2 Set this to the MAIN ADMIN NUMBER
global $portaladmin, $above_marquee_left, $above_marquee_right;
$portaladmin = 3;
echo "<!-- Setting MAIN ADMIN TO ".$portaladmin." in themes/".$theme_name."/theme.php -->\n";
$above_marquee_left = '<span style="color:#b8a265"><strong>Welcome to PHP-Nuke Titanium, Please Enjoy Your Visit...</strong></span>';
$above_marquee_right = '<span style="color:#b8a265"><strong>This is the Sponsor Tron for the PHP-Nuke Titanium Project...</strong></span>';

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

$poweredby_color = 'grey';
echo "<!-- Setting THEME Powered By Text color to ".$poweredby_color." in themes/".$theme_name."/theme.php -->\n";

$poweredby_hover_color = '#337ab7';
echo "<!-- Setting THEME Powered By Text Hover color to ".$poweredby_hover_color." in themes/".$theme_name."/theme.php -->\n";

$menu_text_color = 'white';
echo "<!-- Setting THEME Menu Text to ".$digits_color." in themes/".$theme_name."/theme.php -->\n";

$fieldset_border_width = '1px'; 
echo "<!-- Setting THEME fieldset border width to ".$fieldset_border_width." in themes/".$theme_name."/theme.php -->\n";

$fieldset_color = '#4e4e4e';
echo "<!-- Setting THEME fieldset color to ".$fieldset_color." in themes/".$theme_name."/theme.php -->\n";

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

/************************************************************/
/* Setting Up Directory Structure                           */
/************************************************************/
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

/************************************************************/
/* Theme Width Control                                      */
/************************************************************/
if(empty($locked_width)):
 define('theme_width', ((substr($ThemeInfo['themewidth'], -1) == '%') ? str_replace('%','',($ThemeInfo['themewidth'])).'%' : str_replace('px','',($ThemeInfo['themewidth'])).'px'));
 echo "<!-- Setting THEME WIDTH to ".theme_width." in themes/".$theme_name."/theme.php -->\n";
endif;

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

addPHPCSSToHead(theme_phpstyle_dir.'buttons.php','file');     
echo "<!-- Setting Loading themes/".$theme_name."/css/buttons.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'scrollbars.php','file'); 
echo "<!-- Setting Loading themes/".$theme_name."/css/scrollbars.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'sideblocks.php','file'); 
//echo "<!-- Setting Loading themes/".$theme_name."/css/sideblocks.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'full_screen_video_background.php','file');       
echo "<!-- Setting Loading themes/".$theme_name."/css/full_screen_video_background.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'footer.php','file'); 
//echo "<!-- Setting Loading themes/".$theme_name."/css/footer.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'drop_down_menu.php','file'); # enable for drop_down_menu         
//echo "<!-- Setting Loading themes/".$theme_name."/css/drop_down_menu.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addPHPCSSToHead(theme_phpstyle_dir.'scss_menu.php','file'); # enable for SCSS drop_down_menu         
//echo "<!-- Setting Loading themes/".$theme_name."/css/scss_menu.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'css3_menu.php','file'); # enable for css3 menu
echo "<!-- Setting Loading themes/".$theme_name."/css/css3_menu.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'css_toolbox.php','file');  
echo "<!-- Setting Loading themes/".$theme_name."/css/css_toolbox.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'arcade_tables.php','file');  
echo "<!-- Setting Loading themes/".$theme_name."/css/arcade_tables.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'CKeditor.php','file');   
echo "<!-- Setting Loading themes/".$theme_name."/css/CKeditor.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addPHPCSSToHead(theme_phpstyle_dir.'links.php','file'); 
echo "<!-- Setting Loading themes/".$theme_name."/css/links.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addJSToBody(theme_phpinclude_js_dir.'drop_down_menu.js','file'); # enable for drop_down_menu  
//echo "<!-- Setting Loading themes/".$theme_name."/includes/js/drop_down_menu.js in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addJSToBody(theme_phpinclude_js_dir.'css3_menu.js','file'); # enable for css3 menu
echo "<!-- Setting Loading themes/".$theme_name."/includes/js/css3_menu.js in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

addJSToBody(theme_phpinclude_js_dir.'Hover.js','file'); # jQuery Hover
echo "<!-- Setting Loading themes/".$theme_name."/includes/js/Hover.js in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";

//addCSSToHead(theme_style_dir.'style.css','file');

//addCSSToHead(theme_style_dir.'menu.css','file');

addPHPCSSToHead(theme_phpstyle_dir.'jquery_floating_admin.php','file');  
echo "<!-- Setting Loading themes/".$theme_name."/css/jquery_floating_admin.php in themes/".$theme_name."/theme.php (PHP FlyKit v1.0 Mod) -->\n";
/************************************************************/
/* OpenTable Functions                                      */
/************************************************************/

//addCSSToHead( 'themes/'.$theme_name.'/style/style.css', 'file' );

function OpenTable() {
    global $bgcolor1, $bgcolor2, $theme_name;


echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "  <td>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_03.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV2/images/tbl/tbl_04.png)\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_04.png\" width=\"1\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_06.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"8\" style=\"background-image:url(themes/SimpleBlackV2/images/tbl/tbl_08.png)\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_08.png\" width=\"8\" height=\"1\" alt=\"DFG\"></td>\n";
echo "          <td style=\"background-color: #010101;\">";
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;

    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\"><tr><td class=\"extras\">\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" ><tr><td>\n";
}

function CloseTable() {
    global $theme_name;
    echo "</td>\n";
echo "    <td width=\"8\" style=\"background-image:url(themes/SimpleBlackV2/images/tbl/tbl_11.png)\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_11.png\" width=\"8\" height=\"1\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_14.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV2/images/tbl/tbl_15.png)\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_15.png\" width=\"1\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_16.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "</td>\n";
echo "</tr>\n";
echo "</table>\n";

print '<div align="center" style="padding:6px;">'.PHP_EOL;
print '</div>'.PHP_EOL;

}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

/************************************************************/
/* Function FormatStory()                                   */
/************************************************************/
function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if (!empty($notes)) {
        $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ($aid == $informant) {
        echo "<span class=\"content\" color=\"#505050\">$thetext$notes</span>\n";
    } else {
        if(defined('WRITES')) {
            if(!empty($informant)) {
                if(is_array($informant)) {
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } else {
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } else {
                $boxstuff = "$anonymous ";
            }
            $boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        } else {
            $boxstuff .= "$thetext$notes\n";
        }

        echo "<span class=\"content\" color=\"#505050\">$boxstuff</span>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/************************************************************/
function themeheader() {
    global $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $theme_name;

    echo "<body>\n";
/*****[BEGIN]************************************************/
/* [ Base:    Theme Management                   v1.0.2 ]	*/
/* **********************************************************/
//$ftm = $ThemeInfo['ftm'];
/*****[END]**************************************************/
/* [ Base:    Theme Management                   v1.0.2 ]	*/
/* **********************************************************/

//FORUM POSTS
$count = 1;
$amount = 18;
$content1 = "<A name= \"scrollingCode\"></A>";
$content1 .="<div style=\"padding-top:12px;\"><font size=\"1\" color=\"#FFFFFF\" face=\"verdana\"><MARQUEE behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"140\" height=\"100\" scrollamount= \"1\" scrolldelay= \"90\" onmouseover='this.stop()' onmouseout='this.start()'>";
$result1 = $db->sql_query("SELECT topic_id, topic_last_post_id, topic_title FROM ".$prefix."_bbtopics ORDER BY topic_last_post_id DESC LIMIT $amount");
$content .= "<br />";
while(list($topic_id, $topic_last_post_id, $topic_title) = $db->sql_fetchrow($result1)) {
$result2 = $db->sql_query("SELECT topic_id, poster_id, FROM_UNIXTIME(post_time,'%b %d, %Y at %T') as post_time FROM ".$prefix."_bbposts where post_id='$topic_last_post_id'");
list($topic_id, $poster_id, $post_time)=$db->sql_fetchrow($result2);

$result3 = $db->sql_query("SELECT username, user_id FROM ".$prefix."_users where user_id='$poster_id'");
list($username, $user_id)=$db->sql_fetchrow($result3);

$content1 .= "<br />&raquo;&nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$topic_last_post_id#$topic_last_post_id\"STYLE=\"font-family: verdana; font-size: 9px;\"><strong>$topic_title</strong></a>&nbsp;<br />";
$count = $count + 1;
}
$content1 .="</center></MARQUEE></font></div></center>\n";



    include_once(NUKE_THEMES_DIR.$theme_name."/header.php");

    echo "\n<table width=\"" . $ThemeInfo['sitewidth'] . "\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
  //  echo "\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
    echo "        <tr valign=\"top\">\n";
    echo "        <td style=\"width: 42px; background-image: url(themes/SimpleBlackV2/images/left.png)\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" width=\"42\" height=\"11\" border=\"0\" alt=\"\" /></td>\n";
    echo "        <td valign=\"top\">\n";

    if(blocks_visible('left')) {
        blocks('left');
        echo "    </td>\n";
        echo " <td style=\"width: 10px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"10\" height=\"1\" border=\"0\" /></td>\n";
        echo " <td width=\"100%\">\n";
    } else {
        echo "    </td>\n";
        echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" /></td>\n";
        echo " <td width=\"100%\">\n";
    }
}

/************************************************************/
/* Function themefooter()                                   */
/************************************************************/
function themefooter() 
{
    global $index, $user, $cookie, $banners, $prefix, $db, $admin,  $adminmail, $nukeurl, $theme_name;

    $maxshow = 0;        // Number of downloads to display in the block.

    $a = 1;
    $result = $db->sql_query("SELECT did, title, hits FROM ".$prefix."_file_repository_items ORDER BY date DESC limit 0,$maxshow", $dbi);
    while(list($did, $title, $hits) = $db->sql_fetchrow($result)) 
    {
        $title2 = str_replace("_", " ", "<b>$title</b>");
        $show2 .= $a.': <a href="modules.php?name=File_Repository&amp;action=view&amp;did='.$did.'#'.$did.'">'.$title2.'&nbsp;</a>'.$hits.'<br>';
        $showdownloads = " <A name= \"scrollingCodedownloads\"></A><MARQUEE behavior= \"scroll\" align= \"up\" direction= \"up\" width=\"130\" height=\"63\" scrollamount= \"1\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'><table width=\"100%\"><tr>           <td></td></tr>$show2</table></marquee>";
        $a++;
    }

$maxshow = 0;        // Number of weblinks to dispaly in the block.
$a = 1;

$result = $db->sql_query("select lid, title, hits from ".$prefix."_links_links order by date DESC limit 0,$maxshow", $dbi);
while(list($lid, $title, $hits) = $db->sql_fetchrow($result, $dbi)) {
$title2 = ereg_replace("_", " ", "<b>$title</b>");
$show .= " $a: <a href=\"tblules.php?name=Web_Links&l_op=viewlinkdetails&lid=$lid&ttitle=$title\">&nbsp$title2&nbsp;</a><b><font class=\"content\">$hits</b><font class=\"copyright\"><br>";
$showlinks = " <A name= \"scrollingCode\"></A><MARQUEE behavior= \"scroll\" align= \"up\" direction= \"up\" width=\"130\" height=\"63\" scrollamount= \"1\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>$show";
$a++;

}
    // Banner in the middle of the site

    if (blocks_visible('right') && !defined('ADMIN_FILE')) {
        echo "</td>\n";
        echo "        <td style=\"width: 10px;\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"10\" height=\"1\" /></td>\n";
        echo "       <td style=\"width: 168px;\" valign=\"top\">\n";
        blocks('right');
    }
    echo "        </td>\n";
    echo "        <td style=\"width: 42px; background-image: url(themes/SimpleBlackV2/images/right.png)\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\"  width=\"42\" height=\"11\" /></td>\n";
    echo "        </tr>\n";
    echo "</table>\n\n\n";

    include_once(NUKE_THEMES_DIR.$theme_name."/footer.php");

}

/************************************************************/
/* Function themeindex()                                    */
/* This function format the stories on the Homepage         */
/************************************************************/
#--------------------#
# News Index Section #
#--------------------#
include_once(theme_dir.'function_themeindex.php');
/************************************************************/
/* Function themearticle()                                  */
/************************************************************/
#----------------------#
# News Article Section #
#----------------------#
include_once(theme_dir.'function_themearticle.php');

function themecenterbox($title, $content) {
    OpenTable();
    echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
    CloseTable();
}

function themepreview($title, $hometext, $bodytext='', $notes='') {
    echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
    if (!empty($bodytext)) {
        echo '<br /><br />'.$bodytext;
    }
    if (!empty($notes)) {
        echo '<br /><br /><strong>'._NOTE.'</strong> <i>'.$notes.'</i>';
    }
}

/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/
function themesidebox($title, $content, $bid=0) {
    global $theme_name;
    $tmpl_file = NUKE_THEMES_DIR.$theme_name."/blocks.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    echo $r_file;
}

?>
