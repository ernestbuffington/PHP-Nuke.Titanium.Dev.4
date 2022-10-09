<?php
######################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System            #
######################################################################
# CHANGES                                                            #
# Dynamic facebook meta tagging                    v1.0 Jan 1st 2012 #
###################################################################### 
/********************************************************************/
/* SN Dynamic Titles Addon                                          */
/* ===========================                                      */
/* Copyright (c) 2003 by Greg Schoper                               */
/* http://nuke.schoper.net                                          */
/*                                                                  */
/* Based on code from PHP-Nuke                                      */
/* Copyright (c) 2002 by Francisco Burzi                            */
/* http://phpnuke.org                                               */
/*                                                                  */
/* This program is free software. You can redistribute it and/or    */
/* modify it under the terms of the GNU General Public License as   */
/* published by the Free Software Foundation; either version 2 of   */
/* the License.                                                     */
/********************************************************************/
/* Credit to unknown author of original forums code in              */
/* includes/dynamic_titles.php.                                     */
/********************************************************************/
/*==================================================================
 PHP-Nuke Titanium Network : Enhanced PHP-Nuke Web Portal System
 ===================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) { exit('Access Denied'); }

            global $name, 
                      $u, 
             $admin_file, 
                 $prefix, 
	        $musicprefix, 
	                $db3, 
			         $db, 
         $network_prefix, 
            $user_prefix, 
	             $cookie, 
		         $slogan, 
	          $pagetitle, 
       $facebook_ogimage,
$facebook_ogimage_normal,
 $facebook_ogimage_width,
$facebook_ogimage_height,
	           $sitename, 
	             $domain;

// Item Delimiters
$spacer = "-]";
$lft = "-]";
$rgt = "[-";
$dash = "-";
$item_delim = "&raquo;";

// new page title
$newpagetitle = "-] Page Title Is Missing [-";

//facebook page image
global $portaladmin;

$facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/$portaladmin.png\" />\n";
$facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/$portaladmin.png\" />\n";
$facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
$facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
$facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";

//facebook link to current page
$facebook_ogurl = "<meta property=\"og:url\" content=\"$newpagetitle\" />\n";
//facebook pagetitle 	 	 
$facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
//facebook description
$facebook_ogdescription = "<meta property=\"og:description\" content=\"$newpagetitle\" />\n";

if ($name == 'facebook_SandBox')
{ 
  include_once(NUKE_TITLES_DIR.'facebook_SandBox.php');   	  
  $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."modules/facebook_SandBox/images/sandbox.png\" />\n";
  $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."modules/facebook_SandBox/images/sandbox.png\" />\n";
  $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
}
else
if ($name == 'Private_Messages')
{ 
  include_once(NUKE_TITLES_DIR.'Private_Messages.php');
}
else
if ($name == 'Network_Members')
{ 
  include_once(NUKE_TITLES_DIR.'Members_List.php');   	  
}
else
if ($name == 'Profile')
{ 
  include_once(NUKE_TITLES_DIR.'Profile.php');   	  
}
else
if ($name == 'Network_Groups')
{ 
  include_once(NUKE_TITLES_DIR.'Groups.php');   	  
}
else
if ($name == 'Your_Account')
{ 
  include_once(NUKE_TITLES_DIR.'Your_Account.php');   	  
}
else
if ($name == 'FAQ')
{ 
  include_once(NUKE_TITLES_DIR.'FAQ.php');   	  
}
else
if ($name == 'Site_Map')
{ 
  include_once(NUKE_TITLES_DIR.'Site_Map.php');   	  
}
else
if ($name == 'Diamond_Mine')
{ 
  include_once(NUKE_TITLES_DIR.'Diamond_Mine.php');   	  
}
else
if ($name == 'Forums')
{ 
  include_once(NUKE_TITLES_DIR.'Forums.php');   	  
}
else
if ($name == 'Blog')
{ 
  include_once(NUKE_TITLES_DIR.'Blog.php');   	  
}
else
if ($name == 'Blog_Topics')
{ 
  include_once(NUKE_TITLES_DIR.'Blog_Topics.php');   	  
}
else
if ($name == 'Blog_Top_100')
{ 
  include_once(NUKE_TITLES_DIR.'Blog_Top_100.php');   	  
}
else
if ($name == 'Blog_Search')
{ 
  include_once(NUKE_TITLES_DIR.'Blog_Search.php');   	  
}
else
if ($name == 'CHANGELOG')
{ 
  include_once(NUKE_TITLES_DIR.'CHANGELOG.php');   
  $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."modules/$name/images/changelog.png\" />\n";
  $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."modules/$name/images/changelog.png\" />\n";
  $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
  $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
  $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
}
else
if ($name == 'Music')
{
  include_once(NUKE_TITLES_DIR.'Music.php');
}
else
if ($name == 'Music_Topics_Extended')
{ 
  include_once(NUKE_TITLES_DIR.'Music_Topics_Extended.php');
}
else
if ($name == 'Music_Topics')
{ 
  include_once(NUKE_TITLES_DIR.'Music_Topics.php');
}
else
if ($name == 'Music_Archive')
{ 
  include_once(NUKE_TITLES_DIR.'Music_Archive.php');
}
else
if ($name == 'Music_Top')
{ 
  include_once(NUKE_TITLES_DIR.'Music_Top_100.php');
}
else
if ($name == 'Web_Links')
{ 
  include_once(NUKE_TITLES_DIR.'Web_Links.php');
}
else
if ($name == 'Downloads') 
{
  include_once(NUKE_TITLES_DIR.'Downloads.php');
}
else
if ($name == 'Reviews')
{
  include_once(NUKE_TITLES_DIR.'Reviews.php');
}
else
if ($name == 'Blog_Archive')
{
  include_once(NUKE_TITLES_DIR.'Blog_Archive.php');
}
else
{
  //catch all 	
  include_once(NUKE_TITLES_DIR.'default.php');
}

if(defined('ADMIN_FILE'))
{ 
  include_once(NUKE_TITLES_DIR.'admin_file.php');
}
else
if (defined('HOME_FILE'))
{ 
    include_once(NUKE_TITLES_DIR.'home_file.php');
}
else
{
  $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
}

echo $facebook_ogdescription;
echo $facebook_ogimage_normal;
echo $facebook_ogimage; 
echo $facebookimagetype;
echo $facebook_ogimage_width;
echo $facebook_ogimage_height;
echo $facebook_ogurl;
echo $facebook_ogtitle;
echo "<title>$newpagetitle</title>\n";
?>