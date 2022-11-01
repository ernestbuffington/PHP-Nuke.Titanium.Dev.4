<?php
/*======================================================================= 
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $db2;

list($portaladminname, 
              $avatar, 
			   $email) = $db2->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `".$network_prefix."_users` WHERE `user_id`='$portaladmin'", SQL_NUM);


$newpagetitle = "An 86it Web Developer Portal ($sitename) Owner ($portaladminname) Email ($email)";
$facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";

//added the facebook og url 01/08/2012
$facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."index.php\" />\n";
//facebook page image
global $portaladmin;
$facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/$portaladmin.png\" />\n";
$facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/$portaladmin.png\" />\n";
$facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
$facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
$facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
    
global $db, $prefix;
//put the site description into the facebook og meta tag 10/11/2012
list($description) = $db->sql_ufetchrow("SELECT `meta_content` FROM `".$prefix."_meta` WHERE `meta_name`='description'", SQL_NUM);
//added the facebook dexription meta tag, as it was missing. 10/11/2012
$facebook_ogdescription = "<meta property=\"og:description\" content=\"-] $description [-\" />\n";
?>