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
if(!defined('HEADER')) {
    define('HEADER', true);
} else {
    return;
}

//if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 

if (realpath(__FILE__) == realpath($_SERVER['DOCUMENT_ROOT'].$_SERVER['SCRIPT_NAME']))
exit('Access Denied'); 

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
						$titanium_db, 
							$banners, 
						        $ads, 
							$browser, 
							$ThemeSel;

    global $eighty_six_it;
	$eighty_six_it = '<a class = "small" href="https://www.86it.us" target="_self">Programmers Making Connections. Coders Making a Difference.</a>';
    
	# Auto MimeType v1.0.0 START
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/mimetype.php')):  
    include(NUKE_THEMES_DIR.$ThemeSel.'/includes/mimetype.php');
	else: 
      echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" />'."\n";
      echo '<!DOCTYPE html>'."\n";
	  
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
    endif;	
	# Auto MimeType v1.0.0 END

    include_once(NUKE_INCLUDE_DIR.'meta.php');

    # START function to grab the page title. - 09/07/2019
 	echo "\n<!-- START function title_and_meta_tags(); -->\n";
 	title_and_meta_tags();
    echo "<!-- END function title_and_meta_tags(); -->\n";
    # END function to grab the page title. - 09/07/2019

	################################################################
	if (@file_exists(TITANIUM_CLASSES_DIR . 'class.autoflash.php'))#      Added by Ernest Buffington
	include(TITANIUM_CLASSES_DIR . 'class.autoflash.php');         ###### Load Browser class - used for checking your browser types
    #                                                              #      Start date Jan 1st 2012 till Present - It is a work in progress!
    ################################################################
	################################################################
	if (@file_exists(TITANIUM_CLASSES_DIR . 'class.browsers.php')) #      Added by Ernest Buffington
	include(TITANIUM_CLASSES_DIR . 'class.browsers.php');          ###### Load Browser class - used for checking your browser types
    #                                                              #      Start date Jan 1st 2012 till Present - It is a work in progress!
    ################################################################
	if (@file_exists(TITANIUM_INCLUDE_DIR . 'cookies.php')) #            Added by Ernest Buffington
	include(TITANIUM_INCLUDE_DIR . 'cookies.php');          ############ Load the custom cookies file if it exist COOKIE CONTROL
    #########################################################            Jan 1st 2012 
	include_once(NUKE_INCLUDE_DIR.'javascript.php');        ####### Javascript Loader 09/21/2019
    ######################################################### 

    echo "\n\n<!-- CHECKING FOR pre 2019 themes -> javascript.php in Theme Dir START -->\n";   # Used for PHP-Nuke Titanium pre 2019 themes.
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript.php')) # CHECK FOR THEME JAVASCRIPT Added by Ernest Buffington 3/16/2021 10:58am
    include_once(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript.php');
    echo "<!-- CHECKING FOR pre 2019 themes -> javascript.php in Theme Dir END -->\n\n";
    echo '<script src="includes/ruffle-core/ruffle.js"></script>';
	global $titanium_browser;
    $titanium_browser = new Browser();
	
    # FlyKit Mod v1.0.0 START
	# used to add rounded corners to user avatars!
	addPHPCSSToHead(NUKE_BASE_DIR.'includes/css/cms_css.php','file');
    # FlyKit Mod v1.0.0 END

    # START Load current theme. - 09/07/2019
    echo "\n\n<!-- START Load current theme. -->\n\n";
    include_once(NUKE_THEMES_DIR.$ThemeSel.'/theme.php');
    echo "\n\n<!-- END Load current theme. -->\n\n";
	# START Load current theme. - 09/07/2019

    echo "\n\n<!-- START Load favicon. -->\n\n";
    if ((($favicon = $cache->load('favicon', 'config')) === false) || empty($favicon)): 
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
    echo "\n<!-- END Load favicon. -->\n\n";

    global $browser;
    
    /*
	echo "\n\n<!-- START custom_head -->\n\n";
	if ((($custom_head = $cache->load('custom_head', 'config')) === false) || empty($custom_head)): 
        $custom_head = array();
	    if (file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_head.php')) 
        $custom_head[] = 'custom_head';
 		if (file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_header.php')) 
        $custom_head[] = 'custom_header';
        if (!empty($custom_head)): 
            foreach ($custom_head as $file):
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
    echo "\n<!-- END custom_head -->\n\n";
    */

    
	/* ----- as you can probably tell this is used for IE compatibility ----- */
    echo '<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->'."\n";
    echo "</head>\n";
    echo "\n<!-- END </head> -->\n\n";
	echo "\n<!-- START Top Primary Body Tags -->\n";
	echo "<html>\n";
	echo "<body>\n";
	echo "<!-- END Top Primary Body Tags -->\n\n";

	$ThemeSel = get_theme();

    echo "\n\n<!-- START writeHEAD() -->\n\n";
    writeHEAD();
    echo "\n<!-- END writeHEAD() -->\n\n";

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
    global $screen_res, $titanium_prefix, $titanium_db, $name, $phpbb2_board_config, $userinfo, $identify;
    $ip = $identify->get_ip();
    $url = (defined('ADMIN_FILE')) ? 'index.php' : Fix_Quotes($_SERVER['REQUEST_URI']);
    $uname = $ip;
    $guest = 1;
    $titanium_user_agent = $identify->identify_agent();
	
	if(is_user()):
	$uname = $userinfo['username'];
    $guest = 0;
	else:

    //if(($titanium_user_agent['engine'] == 'bot')):
    //$uname = $titanium_user_agent['bot'];
	//$guest = 3;
    //endif;
    
	//if(($titanium_user_agent['engine'] == '')):
	//endif;
    # Facebook IP Range

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
    # This is a Tor Exit Router
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
	
    # This is Amazon
	if(($ip == '100.25.148.103') 
	|| ($ip == '100.25.148.103')
	)
	{

        $uname = 'Amazon Bot';
		$guest = 3;

	}
		
    # This is AWS
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
	|| ('157.55.39.150')
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
    $past = time() - $phpbb2_board_config['online_time'];
	
	# This was changed to prevent Deadlock found when trying to get lock;
    # Guy like me gets it done! TheGhost 9/20/2022 2:42pm
	$titanium_db->sql_query('DELETE FROM `'.$titanium_prefix.'_session` WHERE `time` < "'.$past.'" - INTERVAL 900 SECOND ORDER BY `time` ASC');
    $ctime = time();

    /**
     * A replace into sql command was added, to prevent the duplication of users, This also saves on several lines of code.
     *
     * @since 2.0.9f
     */
    $titanium_db->sql_query("REPLACE INTO `".$titanium_prefix."_session` (uname, 
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
     *
     * @since 2.0.9f
     */
	
    if ( $guest == 0 ):
        $titanium_db->sql_query("REPLACE INTO `".$titanium_prefix."_users_who_been` (`user_ID`, 
		                                                                            `username`, 
																                  `last_visit`,
																				  `resolution`) 
   values ('".$userinfo['user_id']."', 
           '".$userinfo['username']."', 
		   '".time()."','".$screen_res."');                                                  ");
	endif;
}

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
