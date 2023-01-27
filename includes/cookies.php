<?php 
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   PHP-Nuke Titanium: Cookie Functions
   ============================================
   Copyright (c) 2022 by The Titanium Group

   Filename      : includes/cookies.php
   Author        : Ernest Allen Buffington (www.php-nuke-titanium.86it.us)
   Version       : 4.0.3
   Date          : 12.28.2022 (mm.dd.yyyy)

   Notes         : cookie specific functions
************************************************************************/
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])): 
  exit('Access Denied');
endif;

global $screen_res, $screen_width, $screen_height;

if(!isset($_COOKIE["theme_resolution"])):
echo '<script>
<!--
writeCookie();
function writeCookie() 
{
  var today = new Date();
  var the_date = new Date("June 16, 2023");
  var the_cookie_date = the_date.toGMTString();
  var the_cookie = "theme_resolution="+ screen.width +"x"+ screen.height +"x"+ screen.colorDepth;
  var the_cookie = the_cookie + ";expires=" + the_cookie_date;
  document.cookie=the_cookie;
}
//-->
</script>';
else: 
  $theme["theme_res"] = $_COOKIE["theme_resolution"]; 
endif;

if(!isset($_COOKIE["titanium_resolution"])): 
echo '<script>
<!--
function writeCookie() 
{
  var today = new Date();
  var the_date = new Date("December 31, 2023");
  var the_cookie_date = the_date.toGMTString();
  var the_cookie = "titanium_resolution="+ screen.width +"x"+ screen.height;
  var the_cookie = the_cookie + ";expires=" + the_cookie_date;
  document.cookie=the_cookie
}
writeCookie();
location.reload();
//-->
</script>';
$screen_res = '';
$screen_res = isset($_COOKIE["titanium_resolution"]);
$screen_res_tmp = explode("x", $screen_res);
$screen_width = isset($screen_res_tmp[0]);
$screen_height = isset($screen_res_tmp[1]);
$_COOKIE["titanium_resolution_width"] = $screen_width;
$_COOKIE["titanium_resolution_height"] = $screen_height;
else: 
$screen_res = $_COOKIE["titanium_resolution"];
$screen_res_tmp = explode("x", $screen_res);
$screen_width = $screen_res_tmp[0];
$screen_height = $screen_res_tmp[1];
$_COOKIE["titanium_resolution_width"] = $screen_width;
$_COOKIE["titanium_resolution_height"] = $screen_height;
endif;
