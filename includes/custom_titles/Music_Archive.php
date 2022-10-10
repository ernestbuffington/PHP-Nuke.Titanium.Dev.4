<?php
/*======================================================================= 
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $sa, $year, $month_l, $module_title, $domain, $sitename;

$name = $module_title;

if($sa == 'show_month')
{ 
  $newpagetitle = "$sitename $item_delim Titanium Tune Archives $item_delim $month_l, $year";  
}
else
$newpagetitle = "$sitename $item_delim Titanium Tune Archives";

$facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=Music_Archive\" />\n";

//facebook description
$facebook_ogdescription = "<meta property=\"og:description\" content=\"-] $sitename &raquo; Titanium Tune Archives [-\" />\n";

$facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";
?>