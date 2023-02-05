<?php

/**
*****************************************************************************************
** PHP-Nuke Titanium v4.0.4 - Project Start Date 11/04/2022 Friday 4:09 am             **
*****************************************************************************************
** https://www.php-nuke-titanium.86it.us
** https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4
** https://www.php-nuke-titanium.86it.us/index.php (DEMO)
** Apache License, Version 2.0. MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts/Black_Heart) for Bit Torrent Manager Contribution!
** And Technocrat for the Nuke Evolution Contributions
** And The Mortal, and CoRpSE for the Nuke Evolution Xtreme Contributions
** Project Leaders: TheGhost, NukeSheriff, TheWolf, CodeBuzzard, CyBorg, and  Pipi
** File index.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

require_once("setup_config.php");
require_once("functions.php");
require_once(SETUP_NUKE_INCLUDES_DIR.'functions_selects.php');

$nuke_name = "PHP-Nuke Titanium Dev 4 (US Version) ";
$sql_version = '10.3.37-MariaDB'; //mysqli_get_server_info();

if (!isset($_SESSION['language']) || $_SESSION['language'] == 'english'){
    $_SESSION['language'] = $_POST['language'] ?? 'english';
}

if ($_SESSION['language']){
    if (is_file(BASE_DIR.'language/lang_' . $_SESSION['language'] . '/lang-install.php')){
        include(BASE_DIR.'language/lang_' . $_SESSION['language'] . '/lang-install.php');
    } else {
        include(BASE_DIR.'language/lang_english/lang-install.php');
    }
}

error_reporting(E_ALL ^ E_NOTICE);

if(defined('IN_NUKE')):
  die ("Error 404 - Page Not Found");
endif;

define("IN_NUKE",true);
define('INSETUP',true);

if(function_exists('ob_gzhandler') && !ini_get('zlib.output_compression')):
  ob_start('ob_gzhandler');
else:
  ob_start();
endif;

ob_implicit_flush(0);

define("_VERSION","3.0.1");

if(!ini_get("register_globals")): 
  if (phpversion() < '5.4'): 
    import_request_variables('GPC');
  else:
    # EXTR_PREFIX_SAME will extract all variables, and only prefix ones that exist in the current scope.
	extract($_REQUEST, EXTR_PREFIX_SAME,'GPS');
  endif;
endif;

$step = $_REQUEST['step'] ?? 0;

if(!isset($step) OR !is_numeric($step)): 
  $step = 0;
endif;

$total_steps = '10';
$next_step = $step+1;
$continue_button = '<input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" class="button" name="submit" value="'.$install_lang['continue'].' '.$next_step.'" />';
check_required_files();
$safemodcheck = ini_get('safe_mod');

if ($safemodcheck == 'On' || $safemodcheck == 'on' || $safemodcheck == true){
    echo '<table id="menu" border="1" width="100%">';
    echo '  <tr>';
    echo '    <th id="rowHeading" align="center">'.$nuke_name.' '.$install_lang['installer_heading'].' '.$install_lang['failed'].'</th>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td align="center"><span style="color: #ff0000;"><strong>'.$install_lang['safe_mode'].'</strong></span></td>';
    echo '  </tr>';
    echo '</table>';
    exit;
}

if (isset($_POST['download_file']) && !empty($_SESSION['configData']) && !$_POST['continue']){
    header("Content-Type: text/x-delimtext; name=config.php");
    header("Content-disposition: attachment; filename=config.php");
    $configData = $_SESSION['configData'];
    echo $configData;
    exit;
}

/**
 * Operating System Analysis
 * Useful for setup help
 */
if(strtoupper(substr(PHP_OS,0,3)) == "WIN"): 
  $os = "Windows";
else: 
  $os = "Linux";
endif;

require_once(SETUP_GRAPHICS_DIR."graphics.php");

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
echo "<link rel=\"StyleSheet\" href=\"graphics/style.css\" type=\"text/css\">\n";

if (isset($language) AND $language != "" AND is_readable(SETUP_LANGUAGE_DIR."".$language.".php")) {
        require_once(SETUP_LANGUAGE_DIR.$language.".php");
        $langpic = "language/".$language.".png";
} else $langpic = "graphics/blank.gif";

echo "<script src=\"include/js/overlib.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";
echo "<script src=\"include/js/overlib_shadow.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";

?>
<script>
function expand(id) {
  var i=1;
  var obj;

  while (obj = document.getElementById(id+"_"+i)) 
  {
    if (obj.className == 'show') 
	{
      obj.className = 'hide';
    } 
	else 
	{
      obj.className = 'show';
    }
      i++;
  }

}
</script>
<?

echo "</head>\n";


echo "<body>\n";
echo "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>\n";
echo "<table width=782 border=0 cellpadding=0 cellspacing=0 align=\"center\">\n";
echo "<tr><td>";
makeheader();
echo "</td>\n</tr>\n";
echo "<tr><td>\n";


#HERE COMES THE SCRIPT
echo "<table>\n";
echo "<tr><td width=\"259\">\n";
#LEFT SIDE

$stepimg = stepimage();
$stepimg = "graphics/".$stepimg;

echo "<table border=\"0\" width=\"100%\">\n";
echo "<tr>\n";
echo "<td colspan=1 style=\"background:url(graphics/r4.jpg)\" width=135 height=66><div align=\"center\"><img src=\"".$langpic."\" alt=\"Language\" width=\"48\" height=\"48\" /></div></td>\n";
echo "<td colspan=1 style=\"background:url(graphics/r5.jpg)\" width=124 height=66></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td colspan=1 style=\"background:url(graphics/r6.jpg)\" width=135 height=62><div align=\"center\"><img src=\"".$stepimg."\" alt=\"Current Step\" width=\"48\" height=\"48\" /></div></td>\n";
echo "<td colspan=1 style=\"background:url(graphics/r7.jpg)\" width=124 height=62></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td colspan=1 style=\"background:url(graphics/r8.jpg)\" width=135 height=65><div align=\"center\"><img src=\"graphics/".$os.".png\" alt=\"Operating System\" width=\"48\" height=\"48\" /></div></td>\n";
echo "<td colspan=1 style=\"background:url(graphics/r9.jpg)\" width=124 height=65></td>\n";
echo "</tr>\n";
echo "</table>";

echo "</td>\n<td width=\"512\">\n";

echo "<form name=\"formdata\" action=\"index.php\" method=\"POST\">\n";
if (isset($language)) 
echo "<input type=\"hidden\" name=\"language\" value=\"".$language."\" />\n";


#INTERFACE HERE
require_once(SETUP_STEPS_DIR.$step.".php");

echo "</form>\n";
echo "</td>\n</tr>";
echo "</table>\n";

/*
DEBUG INFORMATION

echo "<p>Debug: GET = ";
print_r($_GET);
echo " POST = ";
print_r($_POST);
echo "</p>";
*/

echo "</td>\n<tr><td>";
makefooter();
echo "</td>\n</tr>\n";
echo "</table>\n";
echo "</body>\n";
echo "</html>";
ob_end_flush();
die();

