<?php 
/*========================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 ========================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

global $screen_res, $screen_width, $screen_height;

if(!isset($_COOKIE["theme_resolution"])):
?>
<script language="javascript">
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
</script>
<?php
else: 
  $theme["theme_res"] = $_COOKIE["theme_resolution"]; 
endif;

if(!isset($_COOKIE["titanium_resolution"])): 
?>
<script language="javascript">
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
//-->
</script>
<?
$screen_res = $_COOKIE["titanium_resolution"];
$screen_res_tmp = explode("x", $screen_res);
$screen_width = $screen_res_tmp[0];
$screen_height = $screen_res_tmp[1];
$_COOKIE["titanium_resolution_width"] = $screen_width;
$_COOKIE["titanium_resolution_height"] = $screen_height;
$url = $_SERVER['REQUEST_URI'];
echo "<meta http-equiv='refresh' content='0;URL=$url'>";

else: 
$screen_res = $_COOKIE["titanium_resolution"];
$screen_res_tmp = explode("x", $screen_res);
$screen_width = $screen_res_tmp[0];
$screen_height = $screen_res_tmp[1];
$_COOKIE["titanium_resolution_width"] = $screen_width;
$_COOKIE["titanium_resolution_height"] = $screen_height;
endif;

// MY CELL PHONE
if ($screen_width == "360")
{

}

// DADS TV
if ($screen_width == "1421")
{

}


// DADS LAPTOP
if ($screen_width == "1537")
{

}


//TESTED
if ($screen_width == "1680")
{

}

//TESTED LORI
if ($screen_width == "1366")
{

}

//TESTED ERNIE WORKING
if ($screen_width == "1920")
{

}
?>
