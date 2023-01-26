<?php 
/*=======================================================================
 PHP-Nuke Titanium : Enhanced and Advanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
  PHP-Nuke Titanium / Nuke-Evolution: Advanced Installer
  ============================================
  Copyright (c) 2023 by The Titanium Group

  Filename           : functions.php
  Author             : Technocrat, The Mortal, Ernest Allen Buffington
  Design Layout      : The Mortal (RealmDesignz.com)
  Version            : 4.0.3
  Date               : 01.26.2023 (mm.dd.yyyy)

  Notes              : You may NOT use this installer for your own
                       needs or script. It is written specifically
                       for PHP-Nuke Titanium, Nuke-Evolution and/or Xtreme

************************************************************************/
global $cookiedata_admin, $cookiedata;

if(!isset($cookiedata_admin))
$cookiedata_admin = '';
if(!isset($cookiedata))
$cookiedata = '';
if(!isset($cookie_location))
$cookie_location = (string) $_SERVER['PHP_SELF'];

setcookie('admin',$cookiedata_admin, ['expires' => time()+2_592_000, 'path' => $cookie_location]);
setcookie('user',$cookiedata, ['expires' => time()+2_592_000, 'path' => $cookie_location]);

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
echo '<title>PHP-Nuke Titanium (US Version) Installer</title>';
echo '<link rel="stylesheet" type="text/css" href="install/style.css" />';
echo '</head>';
echo '<body>';
echo '<div id="install_wrap">';
echo '<div id="left_wrap">';
echo '<div class="top_wrap">';
echo '<div id="top_left_corner"></div>';
echo '<div id="top_mid"></div>';
echo '</div>';
echo '<div class="top_wrap">';
echo '<div id="logo_left"></div>';
echo '<div id="logo_content_bg"><br />';
echo '<div id="logo"></div>';
echo '</div>';
echo '</div>';
echo '<div class="top_wrap">';
echo '<div id="main_content">';
echo '<div class="mcontent wrappermcontent">';
	