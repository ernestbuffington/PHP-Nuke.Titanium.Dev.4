<?php 
/*=======================================================================    
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/ 
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {  
    exit('Access Denied');
}

global $name, $sitename, $module_title, $facebook_ogtitle;

$newpagetitle = $sitename.' &raquo; '.$module_title;

$facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name\" />\n"; 	 	 

$facebook_ogtitle = "<meta property=\"og:title\" content=\"-] $sitename &raquo; $module_title [-\" />\n"; 

$facebook_ogdescription = "<meta property=\"og:description\" content=\"-] $sitename &raquo; $module_title [-\" />\n";
?>