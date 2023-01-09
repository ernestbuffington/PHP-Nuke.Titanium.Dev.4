<?php

/**
*****************************************************************************************
** PHP-AN602  (Titanium Edition) v1.0.0 - Project Start Date 11/04/2022 Friday 4:09 am **
*****************************************************************************************
** https://an602.86it.us/
** https://github.com/php-an602/php-an602
** https://an602.86it.us/index.php (DEMO)
** Apache License, Version 2.0, MIT license 
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

if(!isset($step) OR !is_numeric($step)): 
  $step = 0;
endif;

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

function check_chmod($file_check)
{

}

function is__writable($path, $file = '')
{
	if($path[strlen((string) $path)-1]=='/' AND $file == ''): 
	  return is__writable($path, uniqid(random_int(0, mt_getrandmax())).'.tmp');
	endif;
	//die($path);
	if(!is_dir($path)):
	  return false;
	else:
      $path = $path.$file;
	//die($path);
	  $fp = fopen($path,"w");
	  
	  if(!$fp):
		return false;
	  else:
		if(!fputs($fp,"Test Write")):
		  return false;
		endif;
	  endif;
		unlink($path); # Deleting the mess we just done
		fclose($fp);
	endif;
  
  return true;
}

function hex_esc($matches) {
  return sprintf("%02x", ord($matches[0]));
}
function RandomAlpha($num)
{
    $set  = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvxyz0123456789";
    $resp = "";

    for($i = 1; $i <= $num; $i++):
      $char  = random_int(0, strlen($set) - 1);
      $resp .= $set[$char];
    endfor;
  
  return $resp;
}

function getscrapedata($url, $display=false, $info = false) {
	$ret = null;
 if (preg_match("/thepiratebay.org/i", (string) $url))$url = 'udp://tracker.openbittorrent.com:80';
		if(preg_match('%udp://([^:/]*)(?::([0-9]*))?(?:/)?%si', (string) $url, $m))
			{
				$tracker = 'udp://' . $m[1];
				$port = $m[2] ?? 80;
				$page = "d5:filesd";
				$transaction_id = random_int(0,65535);
				$fp = fsockopen($tracker, $port, $errno, $errstr);
				stream_set_timeout($fp, 10);
				if(!$fp)
					{
						return false;
					}
						fclose($fp);
						return true;
				$current_connid = "\x00\x00\x04\x17\x27\x10\x19\x80";
				//Connection request
				$packet = $current_connid . pack("N", 0) . pack("N", $transaction_id);
				fwrite($fp,(string) $packet);
				//Connection response
				$ret = fread($fp, 100);
				if(strlen($ret) < 1 OR strlen($ret) < 16)
					{
						die($ret);
						return false;
					}
				$retd = unpack("Naction/Ntransid",$ret);
				if($retd['action'] != 0 || $retd['transid'] != $transaction_id)
					{
						return false;
					}
				$current_connid = substr($ret,8,8);
				//Scrape request
				$hashes = '';
				foreach($info as $hash)
					{
						$hashes .= pack('H*', $hash);
					}
				$packet = $current_connid . pack("N", 2) . pack("N", $transaction_id) . $hashes;
				fwrite($fp,(string) $packet);
				//Scrape response
				$readlength = 8 + (12 * (is_countable($info) ? count($info) : 0));
				$ret = fread($fp, $readlength);
				if(strlen($ret) < 1 OR strlen($ret) < 8)
					{
						return false;
					}
					else
					{
						return true;
					}
				$retd = unpack("Naction/Ntransid",$ret);
				// Todo check for error string if response = 3
				if($retd['action'] != 2 || $retd['transid'] != $transaction_id || strlen($ret) < $readlength)
					{
						return false;
					}
				$torrents = [];
				$index = 8;
				foreach($info as $k => $hash)
					{
						$retd = unpack("Nseeders/Ncompleted/Nleechers",substr($ret,$index,12));
						$retd['infohash'] = $k;
						$torrents[$hash] = $retd;
						$index = $index + 12;
					}
				foreach($torrents as $retb)$page .= "20:".str_pad((string) $retb['infohash'], 20)."d".
				"8:completei".$retb['seeders']."e".
				"10:downloadedi".$retb['completed']."e".
				"10:incompletei".$retb['leechers']."e".
				"e";
				$page .= "ee";
			}
			else
			{
				if (!$fp = fopen($url,"rb")) return false; //Warnings are shown
					stream_set_timeout($fp, 10);
				$page = "";
				while (!feof($fp)) $page .= fread($fp,10000);
				fclose($fp);
			}
				if(strlen($page) < 1 OR strlen($page) < 16)
					{
						return false;
					}


        return $page;
}
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
echo "<html>\n";
echo "<head>\n";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">\n";
echo "<title>PHP-AN602 - Setup</title>\n";
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
if (isset($language)) echo "<input type=\"hidden\" name=\"language\" value=\"".$language."\" />\n";


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

