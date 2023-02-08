<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Debugger                                 v1.0.0       11/14/2005
      Auto Optimize                            v1.0.0       11/19/2005
      Module Simplifications                   v1.0.0       11/19/2005
-=[Other]=-
      DB Connector                             v1.0.0       06/07/2005
      Queries Count                            v2.0.1       08/21/2005
-=[Mod]=-
      Admin Icon/Link Pos                      v1.0.0       06/07/2005
	  NSN Center Blocks                        v2.2.1       05/26/2009
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

if(!defined('HEADER')) return;

define('NUKE_FOOTER', true);

function footmsg() 
{
    global $foot1, 
	       $foot2, 
		   $foot3,
		   $foot4, 
	   $copyright, 
	  $total_time, 
	  $start_time, 
	     $footmsg, 
		      $db,
			 $db2, 
   $queries_count, 
   $usrclearcache, 
        $debugger, 
		   $debug, 
		   $cache, 
	   $use_cache,
	       $index,
	      $prefix,
		    $user, 
	 $user_prefix,
	      $cookie,
	    $storynum,
   $Default_Theme,
            $home,
			$name,
		   $admin,
     $persistency, 
$do_gzip_compress, 
	   $start_mem;

static $has_echoed;

if(isset($has_echoed) && $has_echoed == 1) return; 

# powered by information and credits START
global $powered_by, $ThemeSel;
	
$powered_by = '<font size="3">PHP-Nuke Titanium (US Version) Copyright &copy; 2010 2021<br /> by Ernest Allen Buffington and The 86it Developers Network.<br /> 
 All logos, trademarks and posts in this site are property of their respective owners, all the rest <br />&copy; '.date('l jS \of F Y h:i:s A').' by Brandon Maintenance Management, LLC.<br />
 Powered by PHP-Nuke Titanium v4.0.0b (US Version)<br /><br />
 <strong>CREDITS</strong><br />
 PHP-Nuke Copyright &copy; 2006 by Francisco Burzi.<br /> 
 Bob Marion of NukeScripts.Net<br />  
 Ernest Allen Buffington of 86it.us<br>
 PHP-Nuke Evolution Basic<br /> 
 PHP-Nuke Evolution Xtreme UK Version<br />
 PHP-Nuke Evolution Xtreme US Version<br />
 </font>
 ';
# powered by information and credits END

# footer messages span class START
$footmsg = "<span class=\"footmsg\">\n";

# Google Site Map v1.0 START	    
$footmsg .= '<a class="googleminds" href="modules.php?name=Google-Site-Map" target="_self"><span style="color:#4285f4">G</span><span style="color:#ea4335">o</span><span style="color:"#fbbc05">o</span><span style="color:#4285f4">g</span><span style="color:#34a853">l</span><span style="color:#ea4335">e</span> <span style="color:#4285f4">S</span><span style="color:#ea4335">i</span><span style="color:#fbbc05">t</span><span style="color:#4285f4">e</span><span style="color:#ea4335">m</span><span style="color:#34a853">a</span><span style="color:#ea4335">p</span></a><br />';
# Google Site Map v1.0 END

# footer messages from database START
if (!empty($foot1)) 
$footmsg .= $foot1."<br/>";
if (!empty($foot2)) 
$footmsg .= $foot2."<br/>";
# footer messages from database END

# START user clear cache updated 09/12/2019 Ernest Allen Buffington
if($use_cache && $usrclearcache): 
$footmsg .= "<form method='post' name='clear_cache' action='".$_SERVER['REQUEST_URI']."'>";
$footmsg .= "<input type='hidden' name='clear_cache' value='1'>";
$footmsg .= ""._SITECACHED . "</span> <a class=\"poweredby\" href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
$footmsg .= "</form>";
endif;
# END user clear cache updated 09/12/2019 Ernest Allen Buffington

# Copyright Information START
# DO NOT REMOVE THE FOLLOWING COPYRIGHT LINES. YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS.
# IF YOU NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION YOU CAN:
# PLAY FAIR AND SUPPORT THE DEVELOPERS, PLEASE!
global $theme_business, $theme_title, $theme_author, $theme_date, $theme_name, $theme_download_link, $name; 
if(($name) && $name === 'Forums'):
$footmsg .= '<a class="poweredby" href="http://www.php-nuke-titanium.86it.us/" target="_blank">Forums Powered by phpBB Titanium v'.PHPBB_TITANIUM.'</a> | <a class="poweredby" href="https://www.phpbb.com/about/" target="_blank">phpBB v2.0.23 Core &copy; 2001 - 2022 phpBB Limited</a><br />';
endif;

$footmsg .= '<a class="tooltip-html copyright" href="'.$theme_download_link.'" data-toggle="modal" data-target="'.$theme_download_link.'" title="'.$theme_title; 
$footmsg .= '<br/>Designed By '.$theme_author.'<br />Created '.$theme_date.'<br />'.$theme_business.'<br/>All Rights Reserved">'.$theme_title.'</a><br />';
# Copyright Information END
		
# Network About us START
$footmsg .= "<span style=\"font-size: 14px\">";
$footmsg .= "[ "
         . "<a class='disclaimer' href=\"".HTTPS."modules.php?name=Network&file=about\">"
         . "About Us</a> ] - [ "
         . "<a class='disclaimer' href=\"".HTTPS."modules.php?name=Network&file=disclaimer\">"
         . "Disclaimer Statement</a> ] - [ "
         . "<a class='disclaimer' href=\"".HTTPS."modules.php?name=Network&file=privacy\">"
         . "Privacy Statement</a> ] - [ "
         . "<a class='disclaimer' href=\"".HTTPS."modules.php?name=Network&file=terms\">"
         . "Terms of Use</a> ]\n";
$footmsg .= "</span><br>";
# Network About us END

# footer message 3 from the database START
if (!empty($foot3)) 
$footmsg .= $foot3."<br/><br/>";
# footer message 3 from the database END

global $digits_color;
$total_time = (get_microtime() - $start_time);                                              
$total_time = '<span class="copyright"> '._PAGEGENERATION.'<strong><span style="color:'.$digits_color.'"> '.substr($total_time,0,4).'</span></strong> '._SECONDS.'';
        
if ($start_mem > 0): 
$total_mem = memory_get_usage()-$start_mem;
$total_time .= ' | Memory Usage: <strong><span style="color:'.$digits_color.'">'.(($total_mem >= 1048576) 
? round((round($total_mem / 1048576 * 100) / 100), 2).'</span></strong> MB<strong><span style="color:'.$digits_color.'">' : (($total_mem >= 1024) 
? round((round($total_mem / 1024 * 100) / 100), 2).'</span></strong> KB<strong><span style="color:'.$digits_color.'">' : $total_mem.'</span></strong> Bytes<strong><span style="color:'.$digits_color.'">')); 
$total_time .= '</span></strong>';
endif;

# MariaDB version at bottom of footer START
$footmsg .= $db->mariadb_version().'<br/>';
# MariaDB version at bottom of footer END

# START Queries Count v2.0.1
if($queries_count):
$total_time .= ' | DB Queries: <strong><span style="color:'.$digits_color.'">' . $db->num_queries;
$total_time .= '</span></strong>';
endif;
# END Queries Count v2.0.1

# Auto Optimize v1.0.0 START
if(is_admin()): 
 $first_time = false;
  if (!($last_optimize = $cache->load('last_optimize', 'config'))): 
   $last_optimize = time();
    $first_time = true;
  endif;			
     //For information on how to change the auto-optimize intervals
     //Please see www.php.net/strtotime
     //Default: -1 day
     //$interval = strtotime('-1 day');
	 $interval = strtotime('-1 day');
       if (($last_optimize <= $interval) || ($first_time && $cache->valid && $use_cache)):
         if ($db->sql_optimize()):
           $cache->save('last_optimize', 'config', time());
             $total_time .= "<br />Database Optimized";
         endif;
       endif;
           
# Module Simplifications v1.0.0 START 
update_modules();
# Module Simplifications v1.0.0 END 

endif;
# Auto Optimize v1.0.0 END
	
    $footmsg .= $total_time."<br />\n</span>\n";

    # START Debugger v1.0.0
    if(is_admin() && $debugger->debug && count($debugger->errors) > 0): 
       $footmsg .= "<br /><div align=\"center\"><strong>Debugging:</strong></div>";
       $footmsg .= "<table style='width: 80%; text-align: center; border-collapse: collapse;'><tr><td>";
       $footmsg .= $debugger->return_errors();
       $footmsg .= "</td></tr></table>";
    endif;
    
	if (is_admin()) 
	{
      echo $db->print_debug();
    }
    # END Debugger v1.0.0
	
	$debug_sql = false;
	
	if (is_admin() && !is_bool($debug) && $debug == 'full') 
	{
		    $strstart = strlen(NUKE_BASE_DIR);
			$debug_sql = '<span class="genmed" style="font-weight: bold;">SQL Debug:</span><br /><br />';
			
			foreach ($db->querylist as $file => $queries) 
			{
				$file = substr($file, $strstart);
				if (empty($file)) $file = 'unknown file';
				$debug_sql .= '<span style="font-weight: bold;">'.$file.'</span><ul>';
				foreach ($queries as $query) { $debug_sql .= "<li>$query</li>"; }
				$debug_sql .= '</ul>';
			}
			$debug_sql .= '<span style="color: #0000FF; font-weight: bold;">*</span> - Result freed<br /><br />';
	}
	echo $debug_sql;
	unset($debug_sql);

	global $browser;
	
	# with this span tag it is invisible to the main website
	if ($browser == 'Bot' || $browser == 'Other') 
    {
        $footmsg .= '<span style="display:none;"><a href="includes/trap.php">Do Not Click</a></span>'.PHP_EOL;
    }
	# with this span tag it is invisible to the main website
	
	echo $footmsg;
    $has_echoed = 1;
}

# START Admin Icon/Link Pos v1.0.0
if ( defined('ADMIN_FILE') && defined('ADMIN_POS') && is_admin())
{
    global $admin;
    $admin1 = base64_decode($admin);
    $admin1 = addslashes($admin1);
    $admin1 = explode(':', $admin1);
    $aid = $admin1[0];
    unset($admin1);
    echo "<br />";
    GraphicAdmin(0);
}
# END Admin Icon/Link Pos v1.0.0

# START NSN Center Blocks v2.2.1
if (defined('HOME_FILE')) 
{
    blocks('Down');
	
	// If you want either of the following on all pages simply
	// move the include to before if (defined('HOME_FILE'))
	//
	// Visit www.evolution-xtreme.com for support if your stuck, oh wait you can't becuase it does not exists anymore!
	include(NUKE_INCLUDE_DIR.'cblocks3.php');
	include(NUKE_INCLUDE_DIR.'cblocks4.php');
}
# END NSN Center Blocks v2.2.1
global $module_name;
# look to see if a copyright file exist for the currently displayed module START
$pageURL = "".HTTPS."modules/".$module_name."/copyright.php";

if (defined('MODULE_FILE') && !defined("HOME_FILE") AND file_exists("modules/".$module_name."/copyright.php")) 
{
    echo "<script>\n";
    echo "<!--\n";
    echo "function openwindow(w,h){\n";
    echo "var left = (screen.width/2)-(w/2);\n";
    echo "var top = (screen.height/2)-(h/2);\n";

    if ($name == 'Groups')
    {
       echo "window.open ('".HTTPS."modules/Groups/copyright.php','Copyright','toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width='+w+',height='+h+', top='+top+', left='+left);\n";
    }
    else
    if ($name == 'Members_List')
    {
       echo "window.open ('".HTTPS."modules/Members_List/copyright.php','Copyright','toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width='+w+',height='+h+', top='+top+', left='+left);\n";
    }
    else
    if ($name == 'FAQ')
	{
       echo "<div align=\"right\"><a href=\"javascript:openwindow(400,200)\">86it Network FAQ's &copy;</a></div>";
	}
    else
	if ($name == 'Members_List')
	{
       echo "<div align=\"right\"><a href=\"javascript:openwindow(400,200)\">86it Users List &copy;</a></div>";
	}
    else
	if ($name == 'Groups')
	{
       echo "<div align=\"right\"><a href=\"javascript:openwindow(400,200)\">86it Network Groups &copy;</a></div>";
	}
    else
    {
       echo "window.open ('$pageURL','Copyright','toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width='+w+',height='+h+', top='+top+', left='+left);\n";
    }

echo "}\n";
echo "//-->\n";
echo "</script>\n\n";
}

# just a  normal module load without it being displayed by default when index.php loads, look to see if a copyright file exist for the currently displayed module START
#	 $cpname = preg_replace("/_/", " ", $module_name);
#     echo "<div align=\"right\"><a href=\"javascript:openwindow(420,200)\">$cpname &copy;</a></div>";
# just a  normal module load without it being displayed by default when index.php loads, look to see if a copyright file exist for the currently displayed module END

global $name;
# This loads the admin panel when you goto the admin area START
if (!defined('HOME_FILE') AND defined('MODULE_FILE') AND (file_exists(NUKE_MODULES_DIR.$name.'/admin/panel.php') && is_admin())) 
{
    OpenTable();
    include_once(NUKE_MODULES_DIR . $name . '/admin/panel.php');
    CloseTable();
}
# This loads the admin panel when you goto the admin area END
themefooter();

# needed for the forum admin area START
if (!defined('IN_PHPBB')) 
echo "<div style=\"display:none\" id=\"resizemod\"></div>";
# needed for the forum admin area END

# you can include a custom footer if you so choose, this really has no real use but was put in a previous version of Nuke! START
if (file_exists(NUKE_INCLUDE_DIR . 'custom_files/custom_footer.php')) 
include_once(NUKE_INCLUDE_DIR . 'custom_files/custom_footer.php');
# you can include a custom footer if you so choose, this really has no real use but was put in a previous version of Nuke! END

writeBODYJS();

echo "\n<!-- START Bottom Primary Body Tags -->\n";
#main <body> closing tag!
echo '</body>'."\n";
#main <html> closing tag!
echo '</html>'."\n";
echo "<!-- END Bottom Primary Body Tags -->\n\n";

# ReSync the website cache!
# Set up the cache class reference
global $use_cache;
$cache = new cache($use_cache);
$cache->resync();

/*****[BEGIN]******************************************
 [ Other:   DB Connectors                      v2.0.0 ]
 [ Other:   Persistent DB Connection           v2.0.0 ]
 ******************************************************/
global $db2, $db;
if(is_object($db))
$db->sql_close(); //close local database
if(is_object($db2))
$db2->sql_close(); //close network user database
//if(is_object($db3))
//$db3->sql_close(); //close music database
/*****[END]********************************************
 [ Other:   DB Connectors                      v2.0.0 ]
 [ Other:   Persistent DB Connection           v2.0.0 ]
 ******************************************************/
global $do_gzip_compress;
if(GZIPSUPPORT && $do_gzip_compress) 
{
    $gzip_contents = ob_get_contents();
    ob_end_clean();
    $gzip_size = strlen($gzip_contents);
    $gzip_crc = crc32($gzip_contents);
    $gzip_contents = gzcompress($gzip_contents, 9);
    $gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
    echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
    echo $gzip_contents;
    echo pack('V', $gzip_crc);
    echo pack('V', $gzip_size);
}
ob_end_flush();
exit;

