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
      NukeSentinel                             v2.5.00      07/11/2006
      Nuke Patched                             v3.1.0       06/26/2005
      Advanced Security Extension              v1.0.0       12/22/2005
-=[Other]=-
      Dynamic Titles                           v1.0.0       06/11/2005
-=[Mod]=-
      Collapsing Blocks                        v1.0.0       08/16/2005
	  NSN Center Blocks                        v2.2.1       05/26/2009
 ************************************************************************/

if(!defined('HEADER')): 
 define('HEADER', true); 
else: 
 return;
endif; 

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied'); 
endif;

require_once(dirname(__FILE__).'/mainfile.php');

function head() 
{
    global $define_theme_xtreme_209e,
						  $ab_config, 
						  $modheader, 
						       $name, 
							  $cache, 
						   $userinfo, 
						     $cookie, 
							$sitekey, 
							     $db, 
							$banners, 
						        $ads, 
							$browser, 
							$ThemeSel;

	$ThemeSel = get_theme();
	
	echo "<!-- Loading Auto MimeType v1.0.0 from header.php -->\n";
	if (file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/mimetype.php')):  
    include(NUKE_THEMES_DIR.$ThemeSel.'/includes/mimetype.php');
	else:  # OLD SCHOOL DEFAULT MIMETYPE START
      echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" />'."\n";
      echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'" />'."\n";
      echo '<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml" />'."\n"; 
      echo "<!-- START <head> -->\n";
      echo '<head>'."\n";
      echo '<!--[if IE]>'."\n";
      echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />'."\n";
      echo '<![endif]-->'."\n";
      echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
      echo '<meta http-equiv="Content-Language" content="'._LANGCODE.'" />'."\n";
      echo '<meta http-equiv="Content-Style-Type" content="text/css" />'."\n";
      echo '<meta http-equiv="Content-Script-Type" content="text/javascript" />'."\n";
    endif;	# OLD SCHOOL DEFAULT MIMETYPE END

	echo "<!-- Loading dynamic meta tags from database from includes/meta.php -->\n";
    include_once(NUKE_INCLUDE_DIR.'meta.php');

	echo "\n<!-- Loadiing function title_and_meta_tags(); from header.php -->\n";
 	title_and_meta_tags();

	echo "\n<!-- Loadiing includes/ruffle-core/ruffle.js from header.php -->\n";
	echo '<script src="includes/ruffle-core/ruffle.js"></script>'."\n"; 

	#################################################################
	echo "\n<!-- Loadiing class.browsers.php from header.php -->\n";#
	if (file_exists(TITANIUM_CLASSES_DIR . 'class.browsers.php'))   #      Added by Ernest Buffington
	include(TITANIUM_CLASSES_DIR . 'class.browsers.php');           #----- Load Browser class - used for checking your browser types
                                                                    #      Start date Jan 1st 2012 till Present - It is a work in progress!
    #################################################################
	echo "\n<!-- Loadiing cookies.php from header.php -->\n";       #
	if (file_exists(TITANIUM_INCLUDE_DIR . 'cookies.php'))          #            Added by Ernest Buffington Jan 1st 2012 
	include(TITANIUM_INCLUDE_DIR . 'cookies.php');                  #----------- Load the custom cookies file if it exist COOKIE CONTROL
    ########################################################################               
	echo "\n<!-- Loadiing includes/javascript.php from header.php -->\n";  #------ Javascript Loader 09/21/2019
	include_once(NUKE_INCLUDE_DIR.'javascript.php');                       #
    ######################################################################## 


	global $titanium_browser;
    $titanium_browser = new Browser();
	
    # FlyKit Mod v1.0.0 START
	# used to add rounded corners to user avatars!
	echo "<!-- Loadiing includes/css/cms_css.php from header.php -->\n";
	addPHPCSSToHead(NUKE_BASE_DIR.'includes/css/cms_css.php','file');
    # FlyKit Mod v1.0.0 END

	if (file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript.php')): # CHECK FOR THEME JAVASCRIPT Added by Ernest Buffington 3/16/2021 10:58am
	  echo "\n<!-- Loadiing themes/".$ThemeSel."/includes/javascript.php from header.php -->\n\n";
      include_once(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript.php');
	endif;

    # START Load current theme. - 09/07/2019
	echo "\n<!-- Loadiing themes/".$ThemeSel."/theme.php from header.php -->\n";
    include_once(NUKE_THEMES_DIR.$ThemeSel.'/theme.php');
	# START Load current theme. - 09/07/2019


	echo "\n<!-- Loadiing favicon from header.php -->\n\n";
    if (!($favicon = $cache->load('favicon', 'config'))): 
        if (file_exists(NUKE_BASE_DIR.'favicon.ico')) 
		$favicon = "favicon.ico";
		else 
		if (file_exists(NUKE_IMAGES_DIR.'favicon.ico')) 
		$favicon = "images/favicon.ico";
		else 
		if (file_exists(NUKE_THEMES_DIR.$ThemeSel.'/images/favicon.ico')) 
		$favicon = "themes/$ThemeSel/images/favicon.ico";
		else 
        $favicon = 'none';
		if ($favicon != 'none') 
        echo "<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\" />\n";
        $cache->save('favicon', 'config', $favicon);
	else: 
        if ($favicon != 'none') 
        echo "<link rel=\"shortcut icon\" href=\"$favicon\" type=\"image/x-icon\" />\n";
    endif;

    global $browser;
    
	echo "\n<!-- Loadiing function writeHEAD() from header.php -->\n\n";
    writeHEAD();


	if (!($custom_head = $cache->load('custom_head', 'config'))): 
    
	    $custom_head = array();

	    if (file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_head.php')): 
	       echo "\n<!-- Loadiing custom_head.php from header.php -->\n\n";
           $custom_head[] = 'custom_head';
		endif;

 		if (file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_header.php')): 
	       echo "\n<!-- Loadiing custom_header.php from header.php -->\n\n";
           $custom_head[] = 'custom_header';
		endif;

        if (!empty($custom_head)): 
          
		    foreach ($custom_head as $file):
	            echo "\n<!-- Loadiing includes/".$file.".php from header.php -->\n\n";
                include_once(NUKE_INCLUDE_DIR.'custom_files/'.$file.'.php');
            endforeach;
        
		endif;
		$cache->save('custom_head', 'config', $custom_head);
	else: 
        
		if (!empty($custom_head)): 
        
		    foreach ($custom_head as $file): 
                include_once(NUKE_INCLUDE_DIR.'custom_files/'.$file.'.php');
            endforeach;
        
		endif;
    endif;
    
	/* ----- as you can probably tell this is used for IE compatibility ----- */
    echo "\n";
	echo '<!--[if lt IE 9]><script src="includes/js/scripts/html5shiv.min.js"></script><![endif]-->'."\n\n";
    
	echo "</head>\n";
	echo "<!-- Finished Loading The Header from header.php -->\n";

	echo "\n<!-- Loading Primary Body Tag from header.php -->\n";
	echo "<body>\n";
	
	echo "\n<!-- Loadiing Facebook Root from header.php -->\n";
	global $appID;
    echo '<div id="fb-root"></div>' . "\n";
    echo '<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=' . $appID . '&autoLogAppEvents=1" nonce="uoLAf2EF"></script>' . "\n\n";

    themeheader();

	// used for class ckeditor
	if(isset($modheader)) 
	echo $modheader; 

/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
    if($ab_config['site_switch'] == 1)
    echo '<div align="center"><img src="modules/NukeSentinel/images/disabled.png" alt="'._AB_SITEDISABLED.'" title="'._AB_SITEDISABLED.'" border="0" /></div><br />';
/*****[END]********************************************
 [ Base:    NukeSentinel                      v2.5.00 ]
 ******************************************************/
}

head();

function online() 
{
    global $screen_res, $prefix, $db, $name, $board_config, $userinfo, $identify;
    $ip = $identify->get_ip();
    $url = (defined('ADMIN_FILE')) ? 'index.php' : Fix_Quotes($_SERVER['REQUEST_URI']);
    $uname = $ip;
    $guest = 1;
    $user_agent = $identify->identify_agent();
	
	if(is_user()):
	$uname = $userinfo['username'];
    $guest = 0;
	else:

	if( 
	   ($ip == '173.252.127.24') 
	|| ($ip == '173.252.127.12') 
	|| ($ip == '173.252.127.15')
	|| ($ip == '173.252.127.16')
	|| ($ip == '173.252.127.20')
	|| ($ip == '173.252.127.6')
	|| ($ip == '113.66.139.107')
	|| ($ip == '173.252.87.111')
	|| ($ip == '173.252.87.118')
	|| ($ip == '173.252.127.120')
	|| ($ip == '173.252.127.112')
	|| ($ip == '173.252.127.7')
	|| ($ip == '173.252.127.1')
	|| ($ip == '173.252.127.118')
	|| ($ip == '173.252.127.17')
	|| ($ip == '173.252.127.14')
	|| ($ip == '173.252.127.29')
	|| ($ip == '173.252.127.19')
    || ($ip == '69.171.251.9')	
    || ($ip == '69.171.251.16')	
    || ($ip == '69.171.251.19')	
    || ($ip == '69.171.251.2')	
    || ($ip == '69.171.251.1')	
    || ($ip == '69.171.251.17')	
    || ($ip == '69.171.251.10')	
    || ($ip == '69.171.251.120')	
    || ($ip == '69.171.251.119')	
	|| ($ip == '69.171.249.24')
	|| ($ip == '69.171.249.18')
	|| ($ip == '69.171.249.6')
    || ($ip == '69.171.251.18')	
    || ($ip == '69.171.251.24')	
    || ($ip == '69.171.251.11')	
    || ($ip == '69.171.251.116')	
    || ($ip == '69.171.251.22')
	){

        $uname = 'Facebook';
		$guest = 3;

	}
    # This is a Tor Exit Router
	if($ip == '173.252.127.24'){

        $uname = 'Tor Exit Router';
		$guest = 3;

	}

    # This is SoftLayer Technologies Inc.
	if($ip == '92.118.160.61'){

        $uname = 'SoftLayer Tech';
		$guest = 3;

	}


    # This is Apple Bot
	if($ip == '17.58.99.233'){

        $uname = 'Apple Bot';
		$guest = 3;

	}
    # This is a Twitter Bot
	if($ip == '199.16.157.183'){

        $uname = 'Twitter Bot';
		$guest = 3;

	}
	# Google User Accounts
	if($ip == '34.82.56.201'){

        $uname = 'Google User Accts';
		$guest = 3;

	}
	# http://www.debilsoft.de/
	# The IP Logger PRO - Your counter, your web analyzer. SAID THAT 10 People were using my ip and I am the only person here!
	if($ip == '164.132.191.163'){

        $uname = 'IP Logger Pro';
		$guest = 3;

	}

	# FRANCE 
	# The Project Honey Pot system has detected behavior from the IP address consistent with that of a rule breaker.
	if(($ip == '54.36.149.40') 
    || ($ip == '54.36.149.13')
	|| ($ip == '54.36.149.71')
	|| ($ip == '54.36.149.13')
	|| ($ip == '54.36.149.36')	
	|| ($ip == '54.36.148.112'))
	{

        $uname = '<img src="https://www.projecthoneypot.org/images/flags/fr.png" title="France" alt="France">&nbsp;France Gangster Spider';
		$guest = 3;

	}

	# Bing Bot - The MSN Bot retired in 2010 
	# Perhaps Facebook bought Bing Bot or ended up with the IP some how?
	if(($ip == '13.66.139.157') 
	|| ('13.66.139.19')
	){

        $uname = 'Bing Bot';
		$guest = 3;

	}
	
    # This is an Amazon Bot
	if(($ip == '100.25.148.103') 
	|| ($ip == '100.25.148.103')
	)
	{

        $uname = 'Amazon Bot';
		$guest = 3;

	}
		
    # This is an AWS Bot
	if(($ip == '34.233.208.215') 
	|| ($ip == '34.233.58.209')
	)
	{

        $uname = 'AWS Bot';
		$guest = 3;

	}
	# Verizon
	if($ip == '174.228.141.231'){

        $uname = 'Verizon Cell';
		$guest = 3;

	}	

	# Hetzner Online GmbH
	if(($ip == '157.90.203.58')
	|| ($ip == '116.202.175.208')
	|| ($ip == '94.130.143.149')
	)
	{

        $uname = 'Hetzner Online GmbH';
		$guest = 3;

	}	

	# Microsoft Corporation
	if(($ip == '13.66.139.107')
	|| ($ip == '157.55.39.150')
	|| ($ip == '13.68.247.245'))
	{

        $uname = 'Microsoft Corp';
		$guest = 3;

	}	

	# PRTG Network Monitor
	if($ip == '162.244.33.25'){

        $uname = 'PRTG Network Monitor';
		$guest = 3;

	}
	
	endif;
	
    $custom_title = $name;
    $url = str_replace("&amp;", "&", $url);
	$url = addslashes($url);
    $past = time() - $board_config['online_time'];
    $db->sql_query('DELETE FROM '.$prefix.'_session WHERE time < "'.$past.'"');
    $ctime = time();

    /**
     * A replace into sql command was added, to prevent the duplication of users, This also saves on several lines of code.
     *
     * @since 2.0.9E
     */
    $db->sql_query("REPLACE INTO `".$prefix."_session` (uname, 
	                                                     time, 
													starttime, 
													host_addr, 
													    guest, 
													   module, 
													      url) 
	values ('".$uname."', 
	        '".$ctime."', 
			'".$ctime."', 
			'".$ip."', 
			'".$guest."', 
			'".$custom_title."', 
			'".$url."');"); 

    /**
     * This sql replace command is to track who has been to the site and records their last visit.
     * We now add resoultion to the visitor log! 10/07/2022 TheGhost
     * @since 4.0.3
     */
     if ($guest == 0 ):
     $db->sql_query("REPLACE INTO `".$prefix."_users_who_been` (`user_ID`, 
	                                                           `username`, 
											                 `last_visit`,
															 `resolution`) 
   values ('".$userinfo['user_id']."', 
           '".$userinfo['username']."', 
		   '".time()."','".$screen_res."');");
	endif;}

online();

/*****[BEGIN]******************************************
 [ Mod:    NSN Center Blocks                   v2.2.1 ]
 ******************************************************/
if (!defined('ADMIN_FILE')):
	include_once(NUKE_INCLUDE_DIR.'counter.php');
	if (defined('HOME_FILE')):
		include_once(NUKE_INCLUDE_DIR.'messagebox.php');
		blocks('Center');
		# If you want either of the following on all pages simply, move the include to before if (defined('HOME_FILE'))
		include(NUKE_INCLUDE_DIR.'cblocks1.php');
		include(NUKE_INCLUDE_DIR.'cblocks2.php');
    endif;
endif;
/*****[END]********************************************
 [ Mod:    NSN Center Blocks                   v2.2.1 ]
 ******************************************************/
