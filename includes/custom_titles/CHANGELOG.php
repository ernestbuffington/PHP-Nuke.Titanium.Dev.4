<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
global $domain;

$newpagetitle = $sitename." &raquo; PHP-Nuke Titanium &raquo; CHANGELOG";

$facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name\" />\n";  	 	 

$facebook_ogdescription = "<meta property=\"og:description\" content=\"PHP-Nuke Titanium CHANGELOG v6.0 for $domain. Written in PHP by Ernest Allen Buffington. Copyright 2017 -   THERE ARE SOME NEW SOURCE CODE UPDATES... Find Out Now :)\" />\n"; 
?>