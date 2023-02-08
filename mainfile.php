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
      NukeSentinel                             v2.5.08      07/11/2006
      Nuke Patched                             v3.1.0       06/26/2005
      Language Selector                        v3.0.0       12/11/2005
      Admin File Check                         v3.0.0       11/19/2005
      PHP Input Filter                         v1.2.2       10/14/2005
      HTML Parser                              v1.2.0       10/27/2005
      Caching System                           v1.0.0       10/29/2005
      Debugger                                 v1.0.0       11/14/2005
      Module Simplifications                   v1.0.0       11/17/2005
      Evolution Functions                      v1.5.0       11/24/2005
      Theme Management                         v1.0.2       12/14/2005
-=[Mod]=-
      Admin Icon/Link Pos                      v1.0.0       06/02/2005
      Advanced Username Color                  v1.0.5       06/11/2005
      Evolution Version Checker                v1.0.0       06/16/2005
      Lock Modules                             v1.0.0       08/04/2005
      Group Colors                             v1.0.0       10/20/2005
      Censor                                   v1.0.0       10/20/2005
      NBBCode                                  v9.26.0      11/23/2005
      Color Toggle                             v1.0.0       11/25/2005
      Lazy Google Tap                          v1.0.0       01/27/2005
      Switch Content Script                    v2.0.0       03/30/2006
-=[Module]=-
      CNB Your Account                         v4.4.2       06/15/2005
      Network Projects                         v11.11.11    02/12/2017
-=[Other]=-
      SSL Administration                       v1.0.0       08/29/2005
      Validation                               v1.1.0       10/17/2005
      Extra Functions                          v1.0.0       12/22/2005
	  Titanium Functions                       v1.1.1       01/01/2010 
	  NSN Center Blocks                        v2.2.1       05/26/2009
	  Theme Fly Kit                            v1.0.0       09/02/2019
	  Network Advertising                      v7.8.3.1     06/05/2019
	  Blog Signature                           v1.0.0       04/24/2021
      SiteMap Mod                              v1.0.0       04/26/2021
	  Dynamic CSS, JS and PHPCSS               v1.0.0       04/29/2021
 ************************************************************************/
if((defined('NUKE_EVO')) || (defined('NUKE_TITANIUM'))):
  return;
endif;

if(realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])):
 exit('Access Denied');
endif;

# Define File
define('NUKE_EVO', '2.0.9e');
define('NUKE_TITANIUM', '4.0.3');
define('PHPBB_TITANIUM', '2.0.25');
define('PHPBB_TITANIUM_LAST_UPDATE', 'Sunday Jan 1st, 2023');
define('TITANIUM_BUILD', '20940312032022');
define('CUR_EVO', 'NUKE_EVO');
define('CUR_TITANIUM', 'NUKE_TITANIUM');
define('EVO_EDITION', 'Xtreme');
define('TITANIUM_EDITION', 'AN602');
define('PHPVERS', phpversion());
define('EVO_VERSION', NUKE_EVO . ' ' . EVO_EDITION);
define('TITANIUM_VERSION', NUKE_TITANIUM . ' ' . TITANIUM_EDITION);
define('PHP_5', version_compare(PHPVERS, '5.0.0', '>='));

if(!ini_get('register_globals')): 
	$import = true;
	# Need register_globals so try the built in import function
	if (function_exists('import_request_variables')):
		import_request_variables('GPC');
	else: 
		function pnt_import_globals($array)
		{
			foreach ($array as $k => $v):
			  global $$k;
			  $$k = $v;
			endforeach;
		}
		if(!empty($_GET)):
		  pnt_import_globals($_GET);
		endif;
		if(!empty($_POST)):
		  pnt_import_globals($_POST);
		endif;
		if(!empty($_COOKIE)):
		  pnt_import_globals($_COOKIE);
		endif;
	endif;
endif;

$admin = (isset($_COOKIE['admin'])) ? $_COOKIE['admin'] : false;
$user = (isset($_COOKIE['user'])) ? $_COOKIE['user'] : false;

if((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_GET['name']) && !empty($_GET['name']))): 
  $name = (isset($_GET['name']) && !stristr($_GET['name'],'..') && !stristr($_GET['name'],'://')) ? addslashes(trim($_GET['name'])) : false;
else: 
  $name = (isset($_REQUEST['name']) && !stristr($_REQUEST['name'],'..') && !stristr($_REQUEST['name'],'://')) ? addslashes(trim($_REQUEST['name'])) : false;
endif;

$start_mem = function_exists('memory_get_usage') ? memory_get_usage() : 0;
$start_time = get_microtime();

# Stupid handle to create REQUEST_URI for IIS 5 servers
if(preg_match('/IIS/', $_SERVER['SERVER_SOFTWARE']) && isset($_SERVER['SCRIPT_NAME'])):
    $requesturi = $_SERVER['SCRIPT_NAME'];
    if (isset($_SERVER['QUERY_STRING'])):
      $requesturi .= '?'.$_SERVER['QUERY_STRING'];
	endif;
    $_SERVER['REQUEST_URI'] = $requesturi;
endif;

# PHP5 with register_long_arrays off?
if(PHP_5 && (!ini_get('register_long_arrays') || ini_get('register_long_arrays') == '0' || strtolower(ini_get('register_long_arrays')) == 'off')):
    $HTTP_POST_VARS =& $_POST;
    $HTTP_GET_VARS =& $_GET;
    $HTTP_SERVER_VARS =& $_SERVER;
    $HTTP_COOKIE_VARS =& $_COOKIE;
    $HTTP_ENV_VARS =& $_ENV;
    $HTTP_POST_FILES =& $_FILES;
    if(isset($_SESSION)): 
	  $HTTP_SESSION_VARS =& $_SESSION;
	endif;
endif;

if(isset($_COOKIE['DONATION'])):
  setcookie('DONATION', null, time()-3600);
  $type = preg_match('/IIS|Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ? 'Refresh: 0; URL=' : 'Location: ';
  $url = str_replace('&amp;', "&", $url);
  header($type . 'modules.php?name=Donations&op=thankyou');
endif;

# Absolute Path Mod - 01/01/2012 by Ernest Allen Buffington START
$rel_path=[];
$rel_path['file']   = str_replace('\\', "/", realpath(__DIR__));
$server_ary         = pathinfo(realpath(basename((string) $_SERVER['PHP_SELF'])));
$rel_path['server'] = str_replace('\\', "/", $server_ary['dirname']);
$rel_path['uri']    = realpath(basename(substr((string) $_SERVER['REQUEST_URI'], 0, strpos((string) $_SERVER['REQUEST_URI'], '?'))));
$script_abs_path    = pathinfo(realpath($_SERVER['SCRIPT_FILENAME']));
$rel_path['script'] = str_replace('\\', "/",$script_abs_path['dirname']);

if(($rel_path['file'] === $rel_path['script']) && (strlen((string) $_SERVER['DOCUMENT_ROOT']) < strlen($script_abs_path['dirname']))): 

    $href_path = '/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $rel_path['script']);

    if (substr($href_path, 0, 2) == '//'): 
    $href_path = substr($href_path, 1);
	endif;

elseif(strlen($rel_path['file']) == (strlen((string) $_SERVER['DOCUMENT_ROOT']) - 1)): 

    $href_path = '';

elseif(strlen($rel_path['script']) > strlen((string) $_SERVER['DOCUMENT_ROOT']) && (strlen((string) $_SERVER['DOCUMENT_ROOT']) > strlen($rel_path['file']))): 

    $href_path = '';

elseif(strlen($rel_path['file']) > strlen((string) $_SERVER['DOCUMENT_ROOT'])):

	$href_path = '/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $rel_path['file']);

	if(substr($href_path, 0, 2) == '//'): 
        $href_path = substr($href_path, 1);
	endif;

else: 

    $href_path = 'https://'.$_SERVER['SERVER_NAME'];
	$href_path_http = 'http://'.$_SERVER['SERVER_NAME'];

endif;

unset ($rel_path);
unset ($server_ary);
unset ($script_abs_path);

# BASE Directory
define('TITANIUM_BASE_DIR', __DIR__ . '/');

# HTTP & HTTPS
define('HTTPS', $href_path . '/');
define('HTTP', $href_path_http . '/');

# Modules Directory
define('MODULES', TITANIUM_BASE_DIR . 'modules/');

# ADMIN Directory
define('TITANIUM_ADMIN_DIR', TITANIUM_BASE_DIR . 'admin/'); 
define('TITANIUM_ADMIN_MODULE_DIR', TITANIUM_ADMIN_DIR . 'modules/');

# INCLUDES Directories
define('TITANIUM_INCLUDE_DIR', TITANIUM_BASE_DIR . 'includes/');
define('TITANIUM_INCLUDE_HREF_DIR', $href_path . '/includes/');

# CSS Directory
define('TITANIUM_CSS_DIR', TITANIUM_INCLUDE_DIR . 'css/');

# CERT Directory
define('TITANIUM_CERT_DIR', TITANIUM_INCLUDE_DIR . 'certs'); // pem directory

# GLOBAL CSS DIR
define('TITANIUM_CSS_HREF_DIR', $href_path . '/includes/css/');

# lytebox
define('TITANIUM_LYTEBOX_HREF_DIR', $href_path . '/includes/lytebox/');

# lightbox
define('TITANIUM_LIGHTBOX_HREF_DIR', $href_path . '/includes/lightbox/');

# cache
define('TITANIUM_CACHE_DIR', TITANIUM_INCLUDE_DIR . 'cache/');

# classes
define('TITANIUM_CLASSES_DIR', TITANIUM_INCLUDE_DIR . 'classes/');

# DB Directory
define('TITANIUM_DB_DIR', TITANIUM_INCLUDE_DIR . 'db/');

# MODULES Directory
define('TITANIUM_HREF_MODULES_DIR', $href_path . '/modules/'); 
define('TITANIUM_MODULES_DIR', TITANIUM_BASE_DIR . 'modules/');
define('TITANIUM_MODULES_IMAGE_DIR', $href_path . '/modules/');
# BLOCKS Directory
define('TITANIUM_BLOCKS_DIR', TITANIUM_BASE_DIR . 'blocks/');
# IMAGES Directory
define('TITANIUM_IMAGES_DIR', TITANIUM_BASE_DIR . '/images/');
define('TITANIUM_IMAGES_BASE_DIR', $href_path . '/images/');
# LANGUAGE Directory
define('TITANIUM_LANGUAGE_DIR', TITANIUM_BASE_DIR . 'language/');
define('TITANIUM_LANGUAGE_CUSTOM_DIR', TITANIUM_LANGUAGE_DIR . 'custom/');
# STYLE Directory
define('TITANIUM_THEMES_DIR', TITANIUM_BASE_DIR . 'themes/');
define('TITANIUM_THEMES_IMAGE_DIR', $href_path . '/themes/');
define('TITANIUM_THEMES_MAIN_DIR',  $href_path . '/themes/');
# FORUMS Directory
define('TITANIUM_FORUMS_DIR', TITANIUM_MODULES_DIR . 'Forums/');
define('TITANIUM_FORUMS_ADMIN_DIR', TITANIUM_FORUMS_DIR . 'admin/');
define('TITANIUM_FORUMS_ADMIN_HREF_DIR', $href_path . '/modules/Forums/admin/');
# OTHER Directories
define('TITANIUM_RSS_DIR', TITANIUM_INCLUDE_DIR . 'rss/');
define('TITANIUM_STATS_DIR', TITANIUM_THEMES_DIR);
# Absolute Path Mod - 01/01/2012 by Ernest Allen Buffington END

# Inspired by phoenix-cms at website-portals.net
# Absolute Nuke directory
define('NUKE_BASE_DIR', __DIR__ . '/');
# Absolute Nuke directory + includes
define('NUKE_VENDOR_DIR', NUKE_BASE_DIR . 'includes/vendor/');
define('NUKE_ZEND_DIR', NUKE_BASE_DIR . 'includes/Zend/');

define('NUKE_BLOCKS_DIR', NUKE_BASE_DIR . 'blocks/');

define('NUKE_CSS_DIR', 'includes/css/');

define('NUKE_IMAGES_DIR', NUKE_BASE_DIR . 'images/');

define('NUKE_INCLUDE_DIR', NUKE_BASE_DIR . 'includes/');

define('NUKE_JQUERY_INCLUDE_DIR', 'includes/js/');

define('NUKE_JQUERY_SCRIPTS_DIR', 'includes/js/scripts/');

define('NUKE_LANGUAGE_DIR', NUKE_BASE_DIR . 'language/');

define('NUKE_MODULES_DIR', NUKE_BASE_DIR . 'modules/');

define('NUKE_THEMES_DIR', NUKE_BASE_DIR . 'themes/');

define('NUKE_THEMES_SAVE_DIR', NUKE_INCLUDE_DIR . 'saved_themes/');

define('NUKE_ADMIN_DIR', NUKE_BASE_DIR . 'admin/');

define('NUKE_RSS_DIR', NUKE_INCLUDE_DIR . 'rss/');

define('NUKE_DB_DIR', NUKE_INCLUDE_DIR . 'db/');

define('NUKE_ADMIN_MODULE_DIR', NUKE_ADMIN_DIR . 'modules/');

define('NUKE_FORUMS_DIR', (defined("IN_ADMIN") ? './../' : 'modules/Forums/'));

define('NUKE_CACHE_DIR', NUKE_INCLUDE_DIR . 'cache/');
define('NUKE_CACHE_DELETE_DIR', NUKE_INCLUDE_DIR . 'cache');


define('NUKE_CLASSES_DIR', NUKE_INCLUDE_DIR . 'classes/');

define('NUKE_CLASS_EXCEPTION_DIR',  NUKE_CLASSES_DIR . 'exceptions/');

# define the INCLUDE PATH
define('INCLUDE_PATH', NUKE_BASE_DIR);

define('GZIPSUPPORT', extension_loaded('zlib'));
define('GDSUPPORT', extension_loaded('gd'));
define('CAN_MOD_INI', !stristr(ini_get('disable_functions'), 'ini_set'));

# If a class hasn't been loaded yet find the required file on the server and load
# it in using the special autoloader detection built into PHP5+
if(!function_exists('classAutoloader')): 

    function classAutoloader($class) 
    {
        # Set the class file path
        if(preg_match('/Exception/', (string) $class)): 
          $file = NUKE_CLASS_EXCEPTION_DIR . strtolower((string) $class) . '.php';
        else:
          $file = NUKE_CLASSES_DIR . 'class.' . strtolower((string) $class) . '.php';
		endif;

		if(!class_exists($class, false) && file_exists($file)):
          require_once($file);
		endif;
    }
    spl_autoload_register('classAutoloader');
endif;

if(CAN_MOD_INI):
    ini_set('zlib.output_compression', 0);
endif;

# Vendor Autoload - only if vendor directory exists with an autoload file! START
if(file_exists(NUKE_VENDOR_DIR.'autoload.php')):
  require_once(NUKE_VENDOR_DIR.'autoload.php');
endif;  
# Vendor Autoload - only if vendor directory exists with an autoload file! END

use function PHP81_BC\strftime;

# Enable 86it Network Support START
if (file_exists(NUKE_BASE_DIR.'nconfig.php')):  
  global $dbpass2, $dbhost2, $dbname2, $dbuname2, $db2, $network_prefix;
  require_once(NUKE_BASE_DIR.'nconfig.php');

  if(defined('network')):
  
    if(!isset($dbname2) || empty($dbname2)): 
      die('$dbname2 <- your network database name is not configured in your ROOT nbconfig.php file!');
	endif;
    
	if(!isset($dbuname2) || empty($dbuname2)): 
      die('$dbuname2 <- your network database user name is not configured in your ROOT nbconfig.php file!');
	endif;
    
	if(!isset($dbpass2) || empty($dbpass2)): 
      die('$dbpass2 <- your network database password is not configured in your ROOT nbconfig.php file!');
	endif;
    
	if(!isset($network_prefix) || empty($network_prefix)): 
      die('$network_prefix <- your network prefix is not configured in your ROOT nbconfig.php file!');
	endif;
  
  endif;
endif;
# Enable 86it Network Support END 

# Include config file
require_once(NUKE_BASE_DIR.'config.php');

if(!$directory_mode):
  $directory_mode = 0777;
else:
  $directory_mode = 0755;
endif;

if(!$file_mode):
  $file_mode = 0666;
else:
  $file_mode = 0644;
endif;

# Core exceptions handler
include_once(NUKE_INCLUDE_DIR . 'exception.php');
include_once(NUKE_INCLUDE_DIR . 'abstract/abstract.exception.php');

# Include the required files
require_once(NUKE_DB_DIR.'db.php');
require_once(NUKE_DB_DIR.'MysqliDb.php');
# $db->debug = true;
# Include Error Logger and identify class
require_once(NUKE_CLASSES_DIR.'class.identify.php');
global $agent;

$identify = new identify();
$agent = $identify->identify_agent();

require_once(NUKE_INCLUDE_DIR.'log.php');

if(ini_get('output_buffering') && !isset($agent['bot'])):
  ob_end_clean();
  header('Content-Encoding: none');
endif;

$do_gzip_compress = false;

if (GZIPSUPPORT && !ini_get('zlib.output_compression') 
&& isset($_SERVER['HTTP_ACCEPT_ENCODING']) 
&& preg_match('/gzip/i', $_SERVER['HTTP_ACCEPT_ENCODING'])):
    
	if (version_compare(PHPVERS, '4.3.0', '>=')): # PHP 4.2.x seems to give memleak
        ob_start('ob_gzhandler');
    else:
        $do_gzip_compress = true;
        ob_start();
        ob_implicit_flush(0);
        header('Content-Encoding: gzip');
    endif;

else:
    ob_start();
    ob_implicit_flush(0);
endif;

include_once(NUKE_INCLUDE_DIR.'constants.php');

require_once(NUKE_CLASSES_DIR.'class.cache.php');

require_once(NUKE_CLASSES_DIR.'class.debugger.php');

include_once(NUKE_CLASSES_DIR.'class.zip.php');

require_once(NUKE_INCLUDE_DIR.'functions_database.php');

require_once(NUKE_INCLUDE_DIR.'functions_cache.php');

# Network Support START
# PHP-Nuke Titanium v3.0.0 START
require_once(NUKE_INCLUDE_DIR.'function_img.php');                
require_once(NUKE_INCLUDE_DIR.'functions_titanium.php');          
require_once(NUKE_INCLUDE_DIR.'functions_titanium_custom.php');
# Network Support END
# PHP-Nuke Titanium END

require_once(NUKE_INCLUDE_DIR.'functions_evo.php');
require_once(NUKE_INCLUDE_DIR.'functions_evo_custom.php');

include_once(NUKE_INCLUDE_DIR.'validation.php');

# We globalize the $cookie and $userinfo variables,
# so that they dont have to be called each time
# And as you can see, getusrinfo() is now deprecated.
# Because you dont have to call it anymore, just call $userinfo
if(is_user()):
  $cookie = cookiedecode();
  $userinfo = get_user_field('*', $cookie[1], true);
else:
  $cookie = [];
  $userinfo = get_user_field('*', 'Anonymous', true);
endif;

# If they have been deactivated send them to logout to kill their cookie and sessions
if (is_array($userinfo) && isset($userinfo['user_active']) 
&& $userinfo['user_id'] != 1 && $userinfo['user_id'] != 0 
&& $userinfo['user_active'] == 0 && $_GET['name'] != 'Your_Account'):
  redirect('modules.php?name=Your_Account&op=logout');
  die();
endif;

if(stristr($_SERVER['REQUEST_URI'], '.php/')):
  redirect(str_replace('.php/', '.php', $_SERVER['REQUEST_URI']));
endif;

include_once(NUKE_MODULES_DIR.'Your_Account/includes/mainfileend.php');

if(isset($_POST['clear_cache'])):
  $cache->clear();
endif;

define('NUKE_FILE', true);

$dbi = $db->db_connect_id;
$badreasons = 4;
$sitekey = md5((string) $_SERVER['HTTP_HOST']);
$gfx_chk = 0;
$tipath = 'modules/Blog_Topics/images/topics/';
$reasons = ['As Is', 'Offtopic', 'Flamebait', 'Troll', 'Redundant', 'Insighful', 'Interesting', 'Informative', 'Funny', 'Overrated', 'Underrated'];
$AllowableHTML = ['p'=>1, 'b'=>1, 'i'=>1, 'a'=>2, 'em'=>1, 'br'=>1, 'strong'=>1, 'figure'=>1, 'blockquote'=>1, 'tt'=>1, 'li'=>1, 'ol'=>1, 'ul'=>1, 'pre'=>1];

$nukeconfig = load_nukeconfig();

foreach($nukeconfig as $var => $value):
  $$var = $value;
endforeach;

# Base: Language Selector v3.0.0 START
require_once(NUKE_INCLUDE_DIR.'language.php');
# Base: Language Selector v3.0.0 END
 
$adminmail = stripslashes((string) $adminmail);
$foot1 = stripslashes((string) $foot1);
$foot2 = stripslashes((string) $foot2);
$foot3 = stripslashes((string) $foot3);
$commentlimit = (int) $commentlimit;
$minpass = (int) $minpass;
$pollcomm = (int) $pollcomm;
$articlecomm = (int) $articlecomm;
$my_headlines = (int) $my_headlines;
$top = (int) $top;
$storyhome = (int) $storyhome;
$user_news = (int) $user_news;
$oldnum = (int) $oldnum;
$ultramode = (int) $ultramode;
$banners = (int) $banners;
$multilingual = (int) $multilingual;
$useflags = (int) $useflags;
$notify = (int) $notify;
$moderate = (int) $moderate;
$admingraphic = (int) $admingraphic;
$httpref = (int) $httpref;
$httprefmax = (int) $httprefmax;
$domain = str_replace('http://', '', (string) $nukeurl);

if(isset($default_Theme)): 
  $Default_Theme = $default_Theme;
endif;

if(CAN_MOD_INI): 
  ini_set('sendmail_from', $adminmail);
endif;

# Base: Evolution Functions v1.5.0 START
$evoconfig = load_evoconfig();
$board_config = load_board_config();
# Base: Evolution Functions v1.5.0 END

# Mod: Lock Modules v1.0.0 START
# Mod: Queries Count v2.0.0 START
# Other: SSL Administration v1.0.0 START
# Base: Censor v1.0.0 START
# Base: Caching System  v3.0.0 START
# Mod: Color Toggle v1.0.0 START
# Mod: Lazy Google Tap v1.0.0 START
# Base: Switch Content Script v2.0.0 START
$lock_modules = (int) $evoconfig['lock_modules'];
$queries_count = (int) $evoconfig['queries_count'];
$adminssl = (int) $evoconfig['adminssl'];
$censor_words = $evoconfig['censor_words'];
$censor = (int) $evoconfig['censor'];
$usrclearcache = (int) $evoconfig['usrclearcache'];
$use_colors = (int) $evoconfig['use_colors'];
$lazy_tap = (int) $evoconfig['lazy_tap'];
$img_resize = (int) $evoconfig['img_resize'];
$img_width = (int) $evoconfig['img_width'];
$img_height = (int) $evoconfig['img_height'];
$wysiwyg = $evoconfig['textarea'];
$capfile = $evoconfig['capfile'];
$collapse = (int) $evoconfig['collapse'];
$collapsetype = (int) $evoconfig['collapsetype'];
$module_collapse = (int) $evoconfig['module_collapse'];
$evouserinfo_ec = (int) $evoconfig['evouserinfo_ec'];
$analytics = $evoconfig['analytics'];
$html_auth = $evoconfig['html_auth'];
$more_js = '';
$more_styles = '';
# Mod: Lock Modules v1.0.0 END
# Mod: Queries Count v2.0.0 END
# Other: SSL Administration v1.0.0 END
# Base: Censor v1.0.0 END
# Base: Caching System  v3.0.0 END
# Mod: Color Toggle v1.0.0 END
# Mod: Lazy Google Tap v1.0.0 END
# Base: Switch Content Script v2.0.0 END

# Mod: Browsers v1.0 START
# Mod: Lazy Google Tap v1.0.0 START
# Base: Theme Management v1.0.2 START
# Base: NukeSentinel v2.5.08 START
# Mod: Custom Text Area v1.0.0 START
require_once(NUKE_INCLUDE_DIR.'functions_browser.php');
require_once(NUKE_INCLUDE_DIR.'themes.php');
include_once(NUKE_INCLUDE_DIR.'functions_tap.php');

if(!defined('NO_SENTINEL')): 
  require_once(NUKE_INCLUDE_DIR.'nukesentinel.php');
endif;

require_once(NUKE_CLASSES_DIR.'class.variables.php');
include_once(NUKE_CLASSES_DIR.'class.wysiwyg.php');
# Mod: Browsers v1.0 END
# Mod: Lazy Google Tap v1.0.0 END
# Base: Theme Management v1.0.2 END
# Base: NukeSentinel v2.5.08 END
# Mod: Custom Text Area v1.0.0 END

include_once(NUKE_INCLUDE_DIR.'json.php');
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

# Mod: Shoutbox v8.5.2 START
include_once(NUKE_MODULES_DIR.'Shout_Box/shout.php');
# Mod: Shoutbox v8.5.2 END

if(file_exists(NUKE_INCLUDE_DIR.'custom_files/custom_mainfile.php')):
  require_once(NUKE_INCLUDE_DIR.'custom_files/custom_mainfile.php');
endif;

if(!defined('FORUM_ADMIN') && !isset($ThemeSel) && !defined('RSS_FEED')):
  $ThemeSel = get_theme();
  include_once(NUKE_THEMES_DIR . $ThemeSel . '/theme.php');
endif;

# Base: Admin File Check v3.0.0 START
if(!defined('FORUM_ADMIN')):

  global $admin_file;

    if(!isset($admin_file) || empty($admin_file)): 
      die('You must set a value for $admin_file in config.php');
    elseif(!empty($admin_file) && !file_exists(NUKE_BASE_DIR.$admin_file.'.php')):
      die('The $admin_file you defined in config.php does not exist');
    endif;

endif;
# Base: Admin File Check v3.0.0 END

function define_once($constant, $value) 
{
    if(!defined($constant)): 
      define($constant, $value);
	endif;
}

function is_admin($trash=0) 
{
    static $adminstatus;

	if(isset($adminstatus)): 
	  return $adminstatus;
	endif;

	$admincookie = $_COOKIE['admin'] ?? false;

	if(!$admincookie): 
	  return $adminstatus = 0; 
	endif;

	$admincookie = (is_array($admincookie)) ? $admincookie : explode(':', base64_decode((string) $admincookie));
    $aid = $admincookie[0];
    $pwd = $admincookie[1];
    $aid = substr(addslashes((string) $aid), 0, 25);

    if(!empty($aid) && !empty($pwd)):

        if (!function_exists('get_admin_field')):
            global $db, $prefix;
            $pass = $db->sql_ufetchrow("SELECT `pwd` FROM `" . $prefix . "_authors` WHERE `aid` = '" .  str_replace("\'", "''", $aid) . "'", SQL_ASSOC);
            $pass = $pass['pwd'] ?? '';
        else:
            $pass = get_admin_field('pwd', $aid);
        endif;

        if($pass == $pwd && !empty($pass)): 
          return $adminstatus = 1;
		endif;

	endif;

	return $adminstatus = 0;
}

function is_god_admin($trash=0) 
{
    static $godadminstatus;

    if(isset($godadminstatus)): 
	  return $godadminstatus;
	endif;

    $godadmincookie = $_COOKIE['admin'] ?? false;

	if(!$godadmincookie): 
	  return $godadminstatus = 0; 
    endif;

	$godadmincookie = (is_array($godadmincookie)) ? $godadmincookie : explode(':', base64_decode((string) $godadmincookie));
    $aid = $godadmincookie[0];
    $pwd = $godadmincookie[1];
    $godaid = substr(addslashes((string) $aid), 0, 25);

    if(!empty($godaid) && !empty($pwd)):

	  if (!function_exists('get_admin_field')):
        global $db;
          $pass    = $db->sql_ufetchrow("SELECT `pwd` FROM `" . _AUTHOR_TABLE."` WHERE `aid` = '" .  str_replace("\'", "''", $godaid) . "'", SQL_ASSOC);
          $godname = $db->sql_ufetchrow("SELECT `name` FROM `" . _AUTHOR_TABLE."` WHERE `aid` = '" .  str_replace("\'", "''", $godaid) . "'", SQL_ASSOC);
          $pass    = $pass['pwd'] ?? '';
          $godname = $godname['name'] ?? '';
      else:
          $pass    = get_admin_field('pwd', $godaid);
          $godname = get_admin_field('name', $godaid);
      endif;

	 if(($pass == $pwd && !empty($pass)) && ( $godname == 'God')):  
       return $godadminstatus = 1;
	 endif;

    endif;

	return $godadminstatus = 0;
}

function is_user($trash=0) 
{
    static $userstatus;

	if(isset($userstatus)): 
	  return $userstatus;
	endif;

	$usercookie = $_COOKIE['user'] ?? false;

	if(!$usercookie): 
	  return $userstatus = 0; 
	endif;

	$usercookie = (is_array($usercookie)) ? $usercookie : explode(':', base64_decode((string) $usercookie));
    $uid = $usercookie[0];
    $pwd = $usercookie[2];
    $uid = (int) $uid;

    if(!empty($uid) && !empty($pwd)):
      $user_password = get_user_field('user_password', $uid);

	  if($user_password == $pwd && !empty($user_password)):
        return $userstatus = 1;
	  endif;

	endif;

	return $userstatus = 0;
}

function cookiedecode($trash=0) 
{
    global $cookie;

	static $rcookie;

    if(isset($rcookie)): 
	  return $rcookie; 
	endif;

    $usercookie = $_COOKIE['user'];
    $rcookie = (is_array($usercookie)) ? $usercookie : explode(':', base64_decode((string) $usercookie));
    $pass = get_user_field('user_password', $rcookie[1], true);

    if($rcookie[2] == $pass && !empty($pass)):
      return $cookie = $rcookie;
	endif;

    return false;
}

/* IMAGE HACK
 * You can't run Rector on mainfile.php it has no earthly idea
 * what to do when it gets to this function as it has never seen anything
 * like this and is unable to factor or refactor from here!
 */
function title($text) 
{
  return;	
  
  global $name;

    # Opera Hack as images were not showing up
    if($name == 'Advertising'):
      $icon = img('AdvertisngFixed.png', $name); 
    # Opera Hack as images were not showing up
    elseif ($name == 'Network_Advertising'):
      $icon = img('NetworkAdvertisingFixed.png', $name); 
    else:

	   if(!isset($name) || empty($name)):
       # Index Hack as images were not showing up	   
	   else:
	   $icon = img($name.'.png', $name); 
	   endif;

	endif;

    if(!isset($name) || empty($name)):
	# Index Hack as images were not showing up
    else:
    OpenTable();
    echo '<br /><div align="center"><a alt="'.$text.'" href="modules.php?name='.$name.'"><img alt="'.$text.'" style="height: 50px;" src="'.$icon.'" border="0"></a></div><br/>';
    CloseTable();
	endif;
}

/**
* @get active module
* @version 4.0.3
* @cache zf1-future
* @author Ernest Allen Buffington
*/
function is_active($module) 
{
    global $prefix, $db, $cache;
    static $active_modules;

	if(is_array($active_modules)): 
      return(isset($active_modules[$module]) ? 1 : 0);
	endif;

	if((($active_modules = $cache->load('titanium_active_modules', 'config')) === false) || empty($active_modules)):

		$active_modules = [];
        $result = $db->sql_query('SELECT `title` FROM `'.$prefix.'_modules` WHERE `active`="1"');

		while([$title] = $db->sql_fetchrow($result, SQL_NUM)):
            $active_modules[$title] = 1;
        endwhile;

		$db->sql_freeresult($result);
        $cache->save('titanium_active_modules', 'config', $active_modules);

	endif;

	return (isset($active_modules[$module]) ? 1 : 0);
}

function render_blocks($side, $block) 
{
	global $plus_minus_images, $currentlang, $collapse, $collapsetype;

	define_once('BLOCK_FILE', true);

	# Include the block lang files
    if(file_exists(NUKE_LANGUAGE_DIR.'blocks/lang-'.$currentlang.'.php')): 
      include_once(NUKE_LANGUAGE_DIR.'blocks/lang-'.$currentlang.'.php');
    else:
      include_once(NUKE_LANGUAGE_DIR.'blocks/lang-english.php');
	endif;

	# Mod: Switch Content Script v2.0.0 START
    if($collapse): 

		if(!$collapsetype):
            $block['title'] = $block['title']."&nbsp;&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']
			."\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'block".$block['bid']."')\" alt=\"\" style=\"cursor: pointer;\" />";
        else: 
            $block['title'] = "<a href=\"javascript:expandcontent(this, 'block".$block['bid']."')\">".$block['title']."</a>";
        endif;

		$block['content'] = "<div id=\"block".$block['bid']."\" class=\"switchcontent\">".$block['content']."</div>";

	endif;
	# Mod: Switch Content Script v2.0.0 END

    if (empty($block['url'])): 

		if (empty($block['blockfile'])): 
            if ($side == 'c' || $side == 'd'): 
                themecenterbox($block['title'], decode_bbcode($block['content'], 1, true));
			else: 
                themesidebox($block['title'], decode_bbcode($block['content'], 1, true), $block['bid']);
            endif;
		else: 
            blockfileinc($block['title'], $block['blockfile'], $side, $block['bid']);
		endif;

	else: 
        headlines($block['bid'], $side, $block);
	endif;
}

function blocks_visible($side): bool 
{
    global $showblocks;

    $showblocks = ($showblocks == null) ? 3 : $showblocks;

    $side = strtolower((string) $side[0]);

    # If there are no blocks for this module && not admin file
    if(!$showblocks && !defined('ADMIN_FILE')): 
	  return false;
	endif;

    # If in the admin show l blocks
    if (defined('ADMIN_FILE')): 
      return true;
	endif;

    # If set to 3 its all blocks
    if($showblocks == 3): 
	  return true;
	endif;

    # Count the blocks on the side
    $blocks = blocks($side, true);

    # If there are no blocks
    if(!$blocks):
      return false;
	endif;
    # Check for blocks to show
    return ($showblocks == 1 && $side == 'l') || ($showblocks == 2 && $side == 'r');
}

/**
* @get blocks information
* @version 4.0.3
* @cache zf1-future
* @author Ernest Allen Buffington
*/
function blocks($side, $count=false) 
{
    global $prefix, $multilingual, $currentlang, $db, $userinfo, $cache;

	static $blocks;

	$querylang = ($multilingual) ? 'AND (`blanguage`="'.$currentlang.'" OR `blanguage`="")' : '';

	$side = strtolower((string) $side[0]);

	if(!($blocks = $cache->load('blocks', 'config'))): 

	    $sql = 'SELECT * FROM `'.$prefix.'_blocks` WHERE `active`="1" '.$querylang.' ORDER BY `weight` ASC';
        $result = $db->sql_query($sql);

	    while($row = $db->sql_fetchrow($result, SQL_ASSOC)): 
            $blocks[$row['bposition']][] = $row;
        endwhile;

		$db->sql_freeresult($result);
        $cache->save('blocks', 'config', $blocks);

	endif;

	if($count): 
        return (isset($blocks[$side]) ? count($blocks[$side]) : 0);
    endif;

	$blockrow = $blocks[$side] ?? [];

	foreach ($blockrow as $i => $singleBlockrow) {
     $bid = (int) $singleBlockrow['bid'];
     $view = $singleBlockrow['view'];
     $expire = isset($singleBlockrow['expire']) ? (int) $singleBlockrow['expire'] : '';
     if(isset($singleBlockrow['action'])): 
               $action = $singleBlockrow['action'];
               $action = substr((string) $action, 0,1);
   		else: 
               $action = '';
           endif;
     $now = time();
     if($expire != 0 && $expire <= $now): 

   	        if($action == 'd'): 
                   $db->sql_query('UPDATE `'.$prefix.'_blocks` SET `active`="0", `expire`="0" WHERE `bid`="'.$bid.'"');
                   $cache->delete('blocks', 'config');
                   return;
   			elseif($action == 'r'): 
                   $db->sql_query('DELETE FROM `'.$prefix.'_blocks` WHERE `bid`="'.$bid.'"');
                   $cache->delete('blocks', 'config');
                   return;
               endif;

   	    endif;
     if(empty($singleBlockrow['bkey'])): 

   	        if (($view == '0' || $view == '1') ||
                 (($view == '3' && is_user())) ||
                 ($view == '4' && is_admin()) ||
                 (($view == '2' && !is_user()))) {
                render_blocks($side, $singleBlockrow);
            } elseif (substr((string) $view, strlen((string) $view)-1) == '-') {
                $ingroups = explode('-', (string) $view);
                if(is_array($ingroups)): 
                                  $cnt = 0;
          						foreach($ingroups as $group): 
                                      if(isset($userinfo['groups'][($group)])): 
                                        $cnt++;
                                      endif;
                                  endforeach;
          					if($cnt != 0):
                                render_blocks($side, $singleBlockrow);
                              endif;
          	              endif;
            }
           endif;
 }
    return;
} 

function blockfileinc($blockfiletitle, $blockfile, $side=1,$bid = 0) {
    global $collapse;

    if (!file_exists(NUKE_BLOCKS_DIR.$blockfile)) {
        $content = _BLOCKPROBLEM;
    } else {
        include(NUKE_BLOCKS_DIR.$blockfile);
    }
    if (empty($content)) {
        $content = _BLOCKPROBLEM2;
    }
/*****[BEGIN]******************************************
 [ Mod:     Switch Content Script              v2.0.0 ]
 ******************************************************/
    if($collapse) {
        $content = "&nbsp;<div id=\"block".$bid."\" class=\"switchcontent\">".$content."</div>";
    }
/*****[END]********************************************
 [ Mod:     Switch Content Script              v2.0.0 ]
 ******************************************************/
    if ($side == 'r' || $side == 'l') {
        themesidebox($blockfiletitle, $content, $bid);
    } else {
        themecenterbox($blockfiletitle, $content);
    }
}

function rss_content($url) 
{
    if(!web_site_up($url)): 
	  return false;
	endif;

	require_once(NUKE_CLASSES_DIR.'class.rss.php');

	if ($rss = RSS::read($url)):

	    $items =& $rss['items'];
        $site_link =& $rss['link'];
        $content = '';

	    foreach ($items as $i => $item) {
         $link = $item['link'];
         $title2 = $item['title'];
         $content .= "<strong><big>&middot;</big></strong> <a href=\"$link\" target=\"new\">$title2</a><br />\n";
     }

	    if(!empty($site_link)): 
          $content .= "<br /><a href=\"$site_link\" target=\"_blank\"><strong>"._HREADMORE.'</strong></a>';
		endif;

        return $content;

	endif;

  return false;
}

function headlines($bid, $side=0, $row='') 
{
    global $prefix, $db, $my_headlines, $cache;

    if(!$my_headlines): 
	  return;
	endif;

	$bid = (int) $bid;

	if(!is_array($row)): 
      $row = $db->sql_ufetchrow('SELECT `title`, `content`, `url`, `refresh`, `time` FROM `'.$prefix.'_blocks` WHERE `bid`='.$bid, SQL_ASSOC);
    endif;

	$content =& trim((string) $row['content']);

    if($row['time'] < (time()-$row['refresh']) || empty($content)):
      $content = rss_content($row['url']);
      $btime = time();
      $db->sql_query("UPDATE `".$prefix."_blocks` SET `content`='".Fix_Quotes($content)."', `time`='$btime' WHERE `bid`='$bid'");
      $cache->delete('blocks', 'config');
    endif;

    if(empty($content)): 
      $content = _RSSPROBLEM.' ('.$row['title'].')';
	endif;

    $content = '<span class="content">'.$content.'</span>';

	if($side == 'c' || $side == 'd'): 
      themecenterbox($row['title'], $content);
    else: 
      themesidebox($row['title'], $content, $bid);
    endif;
}

function blog_ultramode() 
{
    $content = null;

    global $db, $prefix, $multilingual, $currentlang;
    
	if($multilingual == 1)
	$querylang = '';
	else
	$querylang = "AND s.alanguage = ''";
    
	$sql = "SELECT `s`.`sid`, 
	             `s`.`catid`, 
				   `s`.`aid`, 
				 `s`.`title`, 
		 `s`.`datePublished`, 
		  `s`.`dateModified`, 
		      `s`.`hometext`, 
			  `s`.`comments`, 
			     `s`.`topic`, 
				 `s`.`ticon`, 
		     `t`.`topictext`, 
		    `t`.`topicimage` 
			
	FROM `".$prefix."_blogs` `s` 
	
	LEFT JOIN `".$prefix."_blogs_topics` `t` 
	
	ON `t`.`topicid` = `s`.`topic` 
	
	WHERE `s`.`ihome` = '0' ".$querylang." 
	
	ORDER BY `s`.`datePublished` DESC LIMIT 0,10";
    
	$result = $db->sql_query($sql);
    
	while($row = $db->sql_fetchrow($result, SQL_ASSOC)): 
      $rsid = $row['sid'];
      $raid = $row['aid'];
      $rtitle = htmlspecialchars(stripslashes((string) $row['title']));

	  $rtime = $row['datePublished'];
	  $rmodified = $row['dateModified'];
      $rcomments = $row['comments'];
      $topictext = $row['topictext'];
      $topicimage = ($row['ticon']) ? stripslashes((string) $row['topicimage']) : '';
      $rtime = formatTimestamp($rtime, 'l, F d');
      $content .= "%%\n".$rtitle."\n/modules.php?name=Blogs&file=article&sid=".$rsid."\n".$rtime."\n".$raid."\n".$topictext."\n".$rcomments."\n".$topicimage."\n";
    endwhile;
	
    $db->sql_freeresult($result);
    
	if(file_exists(NUKE_BASE_DIR."ultramode.txt") && is_writable(NUKE_BASE_DIR."ultramode.txt")): 
      $file = fopen(NUKE_BASE_DIR."ultramode.txt", "w");
      fwrite($file, "General purpose self-explanatory file with headlines\n".$content);
      fclose($file);
	else: 
      global $debugger;
      $debugger->handle_error('Unable to write ultramode content to file', 'Error');
    endif;
}

function ultramode() 
{
    global $db, $prefix, $multilingual, $currentlang;

	if($multilingual == 1)
	$querylang = '';
	else
	$querylang = "AND s.alanguage = ''";
    
	$sql = "SELECT `s`.`sid`, 
	             `s`.`catid`, 
				   `s`.`aid`, 
				 `s`.`title`, 
		 `s`.`datePublished`, 
		  `s`.`dateModified`, 
		      `s`.`hometext`, 
			  `s`.`comments`, 
			     `s`.`topic`, 
				 `s`.`ticon`, 
		     `t`.`topictext`, 
		    `t`.`topicimage` 
			
	FROM `".$prefix."_blogs` `s` 
	
	LEFT JOIN `".$prefix."_blogs_topics` `t` 
	
	ON `t`.`topicid` = `s`.`topic` 
	
	WHERE `s`.`ihome` = '0' ".$querylang." 
	
	ORDER BY `s`.`datePublished` DESC LIMIT 0,10";
    
	$result = $db->sql_query($sql);

    while ($row = $db->sql_fetchrow($result, SQL_ASSOC)):
      $rsid = $row['sid'];
      $raid = $row['aid'];
      $rtitle = htmlspecialchars(stripslashes($row['title']));
      $rtime = $row['datePublished'];
	  $rmodified = $row['dateModified'];
	  $rcomments = $row['comments'];
      $topictext = $row['topictext'];
      $topicimage = ($row['ticon']) ? stripslashes($row['topicimage']) : '';
      $rtime = formatTimestamp($rtime, 'l, F d');
      $content .= "%%\n".$rtitle."\n/modules.php?name=News&file=article&sid=".$rsid."\n".$rtime."\n".$raid."\n".$topictext."\n".$rcomments."\n".$topicimage."\n";
    endwhile;
	
    $db->sql_freeresult($result);

    if(file_exists(NUKE_BASE_DIR."ultramode.txt") && is_writable(NUKE_BASE_DIR."ultramode.txt")):
      $file = fopen(NUKE_BASE_DIR."ultramode.txt", "w");
      fwrite($file, "General purpose self-explanatory file with headlines\n".$content);
      fclose($file);
    else:
      global $debugger;
      $debugger->handle_error('Unable to write ultramode content to file', 'Error');
    endif;
}

# Adds slashes to string and strips PHP+HTML for SQL insertion and hack prevention
# $str: the string to modify
# $nohtml: strip PHP+HTML tags, false=no, true=yes, default=false
function Fix_Quotes($str, $nohtml=false) 
{
    if($nohtml): 
	  $str = strip_tags($str);
	endif;
    
	return $str;
}

function Remove_Slashes($str) 
{
    global $_GETVAR;
    
	return $_GETVAR->stripSlashes($str);
}

/*
* check_words function by ReOrGaNiSaTiOn and Ernest Buffington
* @Date 01/25/2023 1:44 am
* @Since v4.0.3
**/
function check_words($message) 
{
    global $censor_words;

    $censor_words = [];

    if(empty($message)): 
      return '';
	endif;
    
	if(empty($censor_words)): 
      return $message;
	endif;
    
	$orig_word = [];
    $replacement_word = [];
         
	foreach($censor_words as $word => $replacement ): 
      $orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote((string) $word, '#')) . ')\b#i';
      $replacement_word[] = $replacement;
    endforeach;
    
	$return_message = preg_replace($orig_word, $replacement_word, (string) $message);

    return $return_message;
}

function check_html($str, $strip='') 
{
   # do not filter strings for the admins! (Test This Later)        
	if(is_mod_admin('super')):
      $str = Fix_Quotes($str, !empty($strip));
      return $str;
	endif;
    
	# Base: PHP Input Filter v1.2.2 START
    if(defined('INPUT_FILTER')): 
	
		if($strip == 'nohtml'):
          global $AllowableHTML;
		endif;
	
	    if(!is_array($AllowableHTML)): 
        
		  $html = '';
		
		else: 
          
		  $html = '';
          
		  foreach($AllowableHTML as $type => $key):
          
		  if($key == 1): 
            $html[] = $type;
		  endif;
          
		  endforeach;
        
		endif;
        
		$html_filter = new InputFilter($html, "", 0, 0, 1);
        $str = $html_filter->process($str);
	else: 
    # Base: PHP Input Filter v1.2.2 END

    $str = Fix_Quotes($str, !empty($strip));

    # Base: PHP Input Filter v1.2.2 START
    endif;
    # Base: PHP Input Filter v1.2.2 START

    return $str;
}

function filter_text($Message, $strip='') {
    $Message = check_words($Message);
    $Message = check_html($Message, $strip);
    return $Message;
}

# actualTime function by ReOrGaNiSaTiOn
# currently not being used anywhere as of 1/13/2023
function actualTime() {
  $date = date('Y-m-d H:i:s');
  $actualTime_tempdate = formatTimestamp($date, $format='Y-m-d H:i:s');
  return $actualTime_tempdate;
}

# formatTimestamp function by ReOrGaNiSaTiOn
function formatTimestamp($time, $format='', $dateonly='') 
{
    global $datetime, $locale, $userinfo, $board_config;
  
        if(isset($userinfo['user_dateformat']) && !empty($userinfo['user_dateformat'])): 
          $format = $userinfo['user_dateformat'];
		elseif (isset($board_config['default_dateformat']) && !empty($board_config['default_dateformat'])): 
          $format = $board_config['default_dateformat'];
		else: 
          $format = 'D M d, Y g:i a';
		endif;

	if(!empty($dateonly)): 
      $replaces = ['a', 'A', 'B', 'c', 'D', 'g', 'G', 'h', 'H', 'i', 'I', 'O', 'r', 's', 'U', 'Z', ':'];
      $format = str_replace($replaces, '', (string) $format);
    endif;

	if((isset($userinfo['user_timezone']) && !empty($userinfo['user_timezone'])) && $userinfo['user_id'] > 1): 
      $tz = $userinfo['user_timezone'];
	elseif (isset($board_config['board_timezone']) && !empty($board_config['board_timezone'])): 
      $tz = $board_config['board_timezone'];
	else: 
     $tz = '10';
	endif;

    setlocale(LC_TIME, $locale);

	if(!is_numeric($time)):
	  # https://stackoverflow.com/questions/5145133/preg-match-for-mysql-date-format
	  $adate= date_create($time); //date format that you don't want
      $mysqldate = $adate->format($format);//date format that you do want
	  $datetime = $mysqldate;
 	  //preg_match('/(\d{4})-(\d{1,2})-(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})/', (string) $time, $datetime);
      //$time = gmmktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
	else:
	  $datetime = FormatDate($format, $time, $tz);
	endif;
	//
	return $datetime;
}

function get_microtime() 
{
    list($usec, $sec) = explode(' ', microtime());
    return ($usec + $sec);
}

# Mod: Blog Signature v1.0.0 START
function blog_signature($aid) 
{
    global $user_prefix, $db, $userinfo;
    static $users;

    if(is_array(isset($users[$aid]))):
        $row = $users[$aid];
    else:
        $row = get_admin_field('*', $aid);
        $users[$aid] = $row;
    endif;

	  # webmaster
       [$username, $avatar, $email, $name, $bio, $admin_notes, $user_occ] = $db->sql_ufetchrow('SELECT `username`,
		                                         `user_avatar`, 
												  `user_email`, 
												        `name`, 
														 `bio`, 
											`user_admin_notes`,
											        `user_occ` 

											FROM `'.$user_prefix.'_users` WHERE `username`="'.$aid.'"', SQL_NUM);
     # added for blog preview START     
	 if(!isset($name))
	 $name = $userinfo['username'];
	 if(!isset($avatar))
     $avatar = 'blank.png';
	 if(!isset($email))
     $email = $userinfo['user_email'];
     # added for blog preview END     
	 
	 $aid  = '';
	 
	 if($name == 'Francisco Burzi')
	 $aid .= 'Adiós Cordialmente,<br />';				   
     else	 
     $aid .= 'Sincerely,<br />';
     $aid .= $name.'<br />';				   				   
     $aid .= '<br />';				   
     $aid .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" height="0">';
     $aid .= '<tr>';

	 $aid .= '<td valign="top" height="80" width="80" height="200"><img width="90" class="rounded-corners" style="max-height: 150px; max-width: 150px;" 
	 src="modules/Forums/images/avatars/'.$avatar.'" alt="avatar" border="0"></td>';

	 $aid .= '<td align="top">';
     $aid .= '&nbsp;&nbsp;<strong>'.$user_occ.'</strong><br />';
     $aid .= '&nbsp;&nbsp;name: '.$name.'<br />';
     $aid .= '&nbsp;&nbsp;email: '.str_replace("@", "[at]", (string) $email).'<br />';
     $aid .= $bio.'';
     $aid .= '</td>';
     $aid .= '</tr>';

	return $aid . '</table>';
}
# Mod: Blog Signature v1.0.0 END

function get_author($aid) 
{
    global $user_prefix, $db;
    
	static $users;
    
	if(!isset($users[$aid]))
	$users[$aid] = null;
    
	if(is_array($users[$aid])): 
        $row = $users[$aid];
	else: 
        $row = get_admin_field('*', $aid);
        $users[$aid] = $row;
    endif;
	
    $result = $db->sql_query('SELECT `user_id` from `'.$user_prefix.'_users` WHERE `username`="'.$aid.'"');
    $userid = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
	# Mod: Advanced Username Color v1.0.5 START
    if(isset($userid[0])): 
      $aid = "<a href=\"modules.php?name=Profile&amp;mode=viewprofile&amp;u=".$userid[0]."\">".UsernameColor($aid)."</a>";
	elseif(isset($row['url']) && $row['url'] != 'http://'): 
      $aid = "<a href=\"".$row['url']."\">".UsernameColor($aid)."</a>";
	else: 
      $aid = UsernameColor($aid);
	endif;
	# Mod: Advanced Username Color v1.0.5 END

    return $aid;
}

function getTopics($s_sid) 
{
    global $topicname, $topicimage, $topictext, $db;
    $sid = (int) $s_sid;

	$sql = 'SELECT t.`topicname`, t.`topicimage`, t.`topictext` 
	FROM (`'._BLOGS_TABLE.'` s 
	LEFT JOIN `'._BLOG_TOPICS_TABLE.'` t 
	ON t.`topicid` = s.`topic`) 
	WHERE s.`sid` = "'.$sid.'"';

	$result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $topicname = $row['topicname'] ?? '';
    $topicimage = $row['topicimage'] ?? '';
	if(isset($row['topictext']))
    $topictext = stripslashes((string) $row['topictext']);
}

/*****[BEGIN]******************************************
 [ Module:    Advertising                    v7.8.3.1 ]
 ******************************************************/
function ads($position) 
{
    global $prefix, $db, $sitename, $adminmail, $nukeurl, $banners;

    if(!$banners): 
	  return ''; 
	endif;
    
	$position = (int) $position;
   
	$result = $db->sql_query("SELECT * FROM `".$prefix."_banner` WHERE `position`='$position' AND `active`='1' ORDER BY RAND() LIMIT 0,1");
    
	$numrows = $db->sql_numrows($result);
    
	if($numrows < 1): 
	  return '';
	endif;
    
	$row = $db->sql_fetchrow($result, SQL_ASSOC);
    
	$db->sql_freeresult($result);
    
	foreach($row as $var => $value): 
	
	  if(isset($$var)): 
		unset($$var);
	  endif;
    
	    $$var = $value;
    
	endforeach;
	
	$bid = (int) $bid;
    
	if(!is_admin()): 
      $db->sql_query("UPDATE `".$prefix."_banner` SET `impmade`=" . $impmade . "+1 WHERE `bid`='$bid'");
    endif;
    
	$sql2 = "SELECT `cid`, `imptotal`, `impmade`, `clicks`, `date`, `ad_class`, `ad_code`, `ad_width`, `ad_height`, `clickurl` FROM `".$prefix."_banner` WHERE `bid`='$bid'";
    $result2 = $db->sql_query($sql2);
    
    [$cid, $imptotal, $impmade, $clicks, $date, $ad_class, $ad_code, $ad_width, $ad_height, $clickurl] = $db->sql_fetchrow($result2, SQL_NUM);
    
	$db->sql_freeresult($result2);
    $cid = (int) $cid;
    $imptotal = (int) $imptotal;
    $impmade = (int) $impmade;
    $clicks = (int) $clicks;

    
	# Check if this impression is the last one and print the banner #
    if(($imptotal <= $impmade) && ($imptotal != 0)): 
	
        $db->sql_query("UPDATE `".$prefix."_banner` SET `active`='0' WHERE `bid`='$bid'");
        $sql3 = "SELECT `name`, `contact`, `email` FROM `".$prefix."_banner_clients` WHERE `cid`='$cid'";
        $result3 = $db->sql_query($sql3);
    
		[$c_name, $c_contact, $c_email] = $db->sql_fetchrow($result3, SQL_NUM);
    
	    $db->sql_freeresult($result3);
    
	    if(!empty($c_email)):
          $from = $sitename.' <'.$adminmail.'>';
          $to = $c_contact.' <'.$c_email.'>';
          $message = _HELLO." $c_contact:\n\n";
          $message .= _THISISAUTOMATED."\n\n";
          $message .= _THERESULTS."\n\n";
          $message .= _TOTALIMPRESSIONS." $imptotal\n";
          $message .= _CLICKSRECEIVED." $clicks\n";
          $message .= _IMAGEURL." $imageurl\n";
          $message .= _CLICKURL." $clickurl\n";
          $message .= _ALTERNATETEXT." $alttext\n\n";
          $message .= _HOPEYOULIKED."\n\n";
          $message .= _THANKSUPPORT."\n\n";
          $message .= "- $sitename "._TEAM."\n";
          $message .= $nukeurl;
          $subject = $sitename.': '._BANNERSFINNISHED;
          $mailcommand = evo_mail($to, $subject, $message, "From: $from\nX-Mailer: PHP/" . PHPVERS);
          $mailcommand = removecrlf($mailcommand);
        endif;
		
    endif;
    
	if($ad_class == "code"): 
      $ad_code = stripslashes($ad_code);
      $ads = "<div align=\"center\">$ad_code</div>";
	else: 
	  
	   if ($clickurl == 'index.php'):
      
	   $ads = '<a href="index.php?op=ad_click&amp;bid='.$bid.'" target="_self"><img src="'.$imageurl.'" width="'.$ad_width.'" height="'
	   .$ad_height.'" border="0" alt="'.$alttext.'" title="'.$alttext.'"></a>';
	  
	   else:
      
	   $ads = '<a href="index.php?op=ad_click&amp;bid='.$bid.'" target="_blank"><img src="'.$imageurl.'" width="'.$ad_width.'" height="'
	   .$ad_height.'" border="0" alt="'.$alttext.'" title="'.$alttext.'"></a>';
	  
	   endif;
    
	endif;
    
	return $ads;
}

function network_ads($position) 
{
    global $network_prefix, $db2, $sitename, $adminmail, $nukeurl, $banners;

if(defined('network')):

    echo "\n\n\n<!-- function network_ads START -->\n";
    echo "<!-- function network_ads LOADING -->\n";
	
	if(!$banners): 
      return '';
	endif; 
    
	$position = intval($position);
    $result = $db2->sql_query("SELECT * FROM `".$network_prefix."_banner` WHERE `position`='$position' AND `active`='1' ORDER BY RAND() LIMIT 0,1");
    $numrows = $db2->sql_numrows($result);
    
	if($numrows < 1): 
	  return '';
	endif;
    
	$row = $db2->sql_fetchrow($result, SQL_ASSOC);
    $db2->sql_freeresult($result);
    
	foreach($row as $var => $value): 
      
	  if(isset($$var)): 
	    unset($$var);
	  endif;
	
		$$var = $value;
    
	endforeach;
    
	$bid = (int) $bid;
    
	if(!is_admin()): 
      $db2->sql_query("UPDATE `".$network_prefix."_banner` SET `impmade`=" . $impmade . "+1 WHERE `bid`='$bid'");
    endif;
    
	$sql2 = "SELECT `cid`, 
	           `imptotal`, 
			    `impmade`, 
				 `clicks`, 
				   `date`, 
			   `ad_class`, 
			    `ad_code`, 
			   `ad_width`, 
			  `ad_height` 
			  
			  FROM `".$network_prefix."_banner` WHERE `bid`='$bid'";
    
	$result2 = $db2->sql_query($sql2);

    [$cid, $imptotal, $impmade, $clicks, $date, $ad_class, $ad_code, $ad_width, $ad_height] = $db2->sql_fetchrow($result2, SQL_NUM);

    $cid = (int) $cid;
    $imptotal = (int) $imptotal;
    $impmade = (int) $impmade;
    $clicks = (int) $clicks;
     
	# Check if this impression is the last one and print the banner #
    if(($imptotal <= $impmade) && ($imptotal != 0)): 
	
        $db2->sql_query("UPDATE `".$network_prefix."_banner` SET `active`='0' WHERE `bid`='$bid'");
        $sql3 = "SELECT `name`, `contact`, `email` FROM `".$network_prefix."_banner_clients` WHERE `cid`='$cid'";
        $result3 = $db->sql_query($sql3);
    
 	    [$c_name, $c_contact, $c_email] = $db->sql_fetchrow($result3, SQL_NUM);
    
	    $db2->sql_freeresult($result3);
        
		if(!empty($c_email)): 
          $from = $sitename.' <'.$adminmail.'>';
          $to = $c_contact.' <'.$c_email.'>';
          $message = _HELLO." $c_contact:\n\n";
          $message .= _THISISAUTOMATED."\n\n";
          $message .= _THERESULTS."\n\n";
          $message .= _TOTALIMPRESSIONS." $imptotal\n";
          $message .= _CLICKSRECEIVED." $clicks\n";
          $message .= _IMAGEURL." $imageurl\n";
          $message .= _CLICKURL." $clickurl\n";
          $message .= _ALTERNATETEXT." $alttext\n\n";
          $message .= _HOPEYOULIKED."\n\n";
          $message .= _THANKSUPPORT."\n\n";
          $message .= "- $sitename "._TEAM."\n";
          $message .= $nukeurl;
          $subject = $sitename.': '._BANNERSFINNISHED;
          $mailcommand = evo_mail($to, $subject, $message, "From: $from\nX-Mailer: PHP/" . PHPVERS);
          $mailcommand = removecrlf($mailcommand);
        endif;
    
	endif;
	
	if($ad_class == "code"): 
    
	    $ad_code = stripslashes($ad_code);
        $ads = '<div align="center">'.$ad_code.'</div>';
    
	else:
		# this opens the ad from the main hub - https://hub.86it.us
        $ads = '<a href="https://hub.86it.us/index.php?op=ad_network_click&amp;bid='.$bid.'" target="_blank"><img src="'.$imageurl.'" width="'.$ad_width.'" height="'
		.$ad_height.'" border="0" alt="'.$alttext.'" title="'.$alttext.'"></a>';
	endif;
    
	echo "<!-- function network_ads DONE -->\n\n\n";
  
  return $ads;

endif;
}
/*****[END]********************************************
 [ Module:    Advertising                    v7.8.3.1 ]
 ******************************************************/

if(!function_exists('themeindex')) 
{
  function themeindex($aid, $informant, $time, $modified, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext, $writes = false) 
  {
    global $anonymous, $blogadmin, $tipath, $theme_name, $sid, $ThemeSel, $nukeurl, $customlang;
    global $digits_color, $digits_txt_color;

    if(!empty($topicimage)):
    
        $t_image = (file_exists(carbinfiber_red_flames_images_dir.'topics/'.$topicimage)) ? carbinfiber_red_flames_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
        $topic_img = '<td class="col-3 extra" style="text-align:center;"><a href="modules.php?name=Blogs&new_topic='.$topic.'"><img src="'
		.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'"></a></td>';

    else:
        
		$topic_img = '';
    
	endif;

    $notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
    $content = '';

    if($aid == $informant):
      
	    $content = $thetext.$notes;
    
	else: 

        if ($writes):

            if (!empty($informant)) :
    
	            $content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='
				.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
    
	        else:
    
	            $content = $anonymous.' ';
    
	        endif;
    
	        $content .= _WRITES.' '.$thetext.$notes;

        else:
    
	        $content .= $thetext.$notes;
    
	    endif;

    endif;

   $posted = sprintf($customlang['global']['posted_by'], get_author($aid), $time);
   $datetime = substr($morelink, 0, strpos($morelink, '|')-strlen($morelink));
   $morelink = substr($morelink, strlen($datetime)+2);
   $reads = '( <span style="color: yellow;">'.$customlang['global']['reads'].'</span>: <span style="color: '.$digits_color.';">'.$counter.'</span> )';

   OpenTable();

   # title
   # space at the top of the page
   echo '<div align="center" id="locator" class="title"><img src="themes/'
   .$theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /><strong><h1 data-text="'.$title.'">'.$title.'</h1></strong><br /></div>';

   print '<div align="center" style="padding-top:6px;">';
   print '</div>';

   print ''.$posted.'';

   print '<div align="center" style="padding-top:6px;">';
   print '</div>';

   # content
   echo '<div align="left" id="text">';
   echo ''.$content.'</div>';

   print blog_signature($aid);	

   echo '<div align="center">'.$datetime.' '.$topictext.' | '.$morelink.' '.$reads.'<img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /></div>';
   
   CloseTable();

  }
}

if(!function_exists('OpenTableModule')) 
{
   function OpenTableModule() 
   {
      print '<div id="borderFunctionOpenTable">'."\n";
   }
}

if(!function_exists('themeindex')) 
{
    function themeindex($title, $hometext, $bodytext='', $notes='') 
	{
		OpenTable();
        
		echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
    
	    if(!empty($bodytext)): 
		
            echo '<br /><br />'.$bodytext;
        
		endif;
        
		if(!empty($notes)): 
		
            echo '<br /><br /><strong>'._NOTE.'</strong> <i>'.$notes.'</i>';
        
		endif;
		
		CloseTable();
    }
}


if(!function_exists('themepreview')) 
{
    function themepreview($title, $hometext, $bodytext='', $notes='') 
	{
        echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
    
	    if(!empty($bodytext)): 
		
            echo '<br /><br />'.$bodytext;
        
		endif;
        
		if(!empty($notes)): 
		
            echo '<br /><br /><strong>'._NOTE.'</strong> <i>'.$notes.'</i>';
        endif;
    }
}

if(!function_exists('themecenterbox')) 
{
    function themecenterbox($title, $content) 
	{
        OpenTable();
        echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
        CloseTable();
    }
}


/*
 * functions added to support dynamic and ordered loading of CSS, PHPCSS, and JS in <HEAD> and before </BODY>
 * Code origin Raven Nuke CMS (http://www.ravenphpscripts.com)
 * addons by Ernest Buffington aka TheGhost https://theghost.86it.us
 */

# START for Theme Fly Kit by Ernest Buffington - 09/02/2019
function addPHPCSSToHead($content, $type='file')
{
    global $headPHPCSS;
    
if(($type == 'file') 
 	&& (is_array($headPHPCSS) 
//	&& count($headPHPCSS) > 0) 
//	&& (in_array(array($type, $content), $headPHPCSS))): 
	&& $headPHPCSS !== []) 
	&& (in_array([$type, $content], $headPHPCSS))): 
 	  return;
 	endif;
 	
//	$headPHPCSS[] = array($type, $content);
	$headPHPCSS[] = [$type, $content];
     
 	return;
}
# END for Theme Fly Kit by Ernest Buffington - 09/02/2019

 
function addCSSToHead($content, $type='file') 
{
    global $headCSS;
    
if (($type == 'file') 
 	&& (is_array($headCSS) 
	&& $headCSS !== []) 
	&& (in_array([$type, $content], $headCSS))): 
 	 return;
 	endif;
     
	$headCSS[] = [$type, $content];
     
 	return;
}

function addJSToHead($content, $type='file') 
{
    global $headJS;
    
 	if (($type == 'file') 
 	&& (is_array($headJS) 
	&& $headJS !== []) 
	&& (in_array([$type, $content], $headJS))): 
 	  return;
 	endif;
     
	$headJS[] = [$type, $content];
     
 	return;
}

function addJSToBody($content, $type='file') 
{
    global $bodyJS;
    
	if (($type == 'file') 
	&& (is_array($bodyJS) 
	&& count($bodyJS) > 0) 
	//&& (in_array(array($type, $content), $bodyJS))):
	&& (in_array([$type, $content], $bodyJS))): 
 
	  return;
	endif;
    
	//$bodyJS[] = array($type, $content);
	$bodyJS[] = [$type, $content];

    
	return;
}

function writeHEAD() 
{
    global $headPHPCSS, $headCSS, $headJS;
    
    # START for Theme Fly Kit by Ernest Buffington - 09/02/2019
	if(is_array($headPHPCSS) && count($headPHPCSS) > 0):
      
	    foreach($headPHPCSS AS $php):
      
	        if($php[0]=='file'):
			  echo "<style>\n";
              include($php[1]);
			  echo "</style>\n";
			else: 
			  echo "<style>\n";
              include($php[1]);
			  echo "</style>\n"; 
            endif;
        
		endforeach;
    
	endif;
    # END for Theme Fly Kit by Ernest Buffington - 09/02/2019
	
	if(is_array($headCSS) && count($headCSS) > 0):
      
	    foreach($headCSS AS $css):
    
	        if($css[0]=='file'): 
              echo '<link rel="stylesheet" href="' . $css[1] . '" type="text/css" />' . "\n";
            else:
              echo $css[1];
			endif;
        
		endforeach;
    
	endif;

    if(is_array($headJS) && count($headJS) > 0):
      
	    foreach($headJS AS $js):
          
		  if($js[0] == 'file'): 
            echo '<script src="' . $js[1] . '"></script>' . "\n";
          else:
            echo $js[1];
		  endif;
        
		endforeach;
    
	endif;
  
  return;
}

function writeBODYJS() 
{
    global $bodyJS;
    
	if(is_array($bodyJS) && count($bodyJS) > 0): 
      
	    foreach($bodyJS AS $js):
    
	        if($js[0] == 'file'): 
              echo '<script src="' . $js[1] . '"></script>' . "\n";
            else:
              echo $js[1];
			endif;
    
	    endforeach;
    
	endif;
	
  return;
}

function makePass() 
{
    $con = [];
    $voc = [];	

    $cons = 'bcdfghjklmnpqrstvwxyz';
    $vocs = 'aeiou';

    for($x=0; $x < 6; $x++):
      //mt_srand ((double) microtime() * 1000000);
	  mt_srand(0, MT_RAND_MT19937);
      //$con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
      //$voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
      $con[$x] = substr($cons, random_int(0, strlen($cons)-1), 1);
      $voc[$x] = substr($vocs, random_int(0, strlen($vocs)-1), 1);	  
    endfor;

    //mt_srand((double)microtime()*1000000);
	mt_srand(0, MT_RAND_MT19937);
    //$num1 = mt_rand(0, 9);
    //$num2 = mt_rand(0, 9);
    $num1 = random_int(0, 9);
    $num2 = random_int(0, 9);	
    $makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];

    return $makepass;
}

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 [ Base:    Evolution Functions                v1.5.0 ]
 ******************************************************/
function get_theme() 
{
    global $Default_Theme, $cookie;

    static $ThemeSel;

    if(isset($ThemeSel)): 
	  return $ThemeSel;
	endif;

    #Quick Theme Change - Theme Management (JeFFb68CAM)
    if(isset($_REQUEST['chngtheme']) && is_user()):
      ChangeTheme($_REQUEST['theme'], $cookie[0]);
	endif;

    #Theme Preview Mod - Theme Management (JeFFb68CAM)
    if(isset($_REQUEST['tpreview']) && ThemeAllowed($_REQUEST['tpreview'])): 
	
        $ThemeSel = $_REQUEST['tpreview'];
    
	    if(!is_user()): 
          //setcookie('guest_theme', $ThemeSel, time()+84600);
          setcookie('guest_theme', (string) $ThemeSel, ['expires' => time()+84600]);

		endif;

        return $ThemeSel;

    endif;

    #Theme Preview for guests Mod - Theme Management (JeFFb68CAM)
    if(isset($_COOKIE['guest_theme']) && !is_user()): 
      return (ThemeAllowed($_COOKIE['guest_theme']) ? $_COOKIE['guest_theme'] : $Default_Theme);
	endif;

    #New feature to grab a backup theme if the one we are trying to use does not exist, no more missing theme errors :)
    //$ThemeSel = (ThemeAllowed($nTheme = (isset($cookie[9]) ? $cookie[9] : $Default_Theme))) ? $nTheme : ThemeBackup($nTheme);
    $ThemeSel = (ThemeAllowed($nTheme = ($cookie[9] ?? $Default_Theme))) ? $nTheme : ThemeBackup($nTheme);

    return $ThemeSel;
}
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 [ Base:    Evolution Functions                v1.5.0 ]
 ******************************************************/

// Function to translate Datestrings
function translate($phrase) 
{
	//switch($phrase):
    //  case'xdatestring': $tmp='%A, %B %d @ %T %Z'; break;
    //  case'linksdatestring': $tmp='%d-%b-%Y'; break;
    //  case'xdatestring2': $tmp='%A, %B %d'; break;
    //  default: $tmp=$phrase; break;
    //endswitch;

	$tmp = match ($phrase) {
     'xdatestring' => '%A, %B %d @ %T %Z',
     'linksdatestring' => '%d-%b-%Y',
     'xdatestring2' => '%A, %B %d',
     default => $phrase,
 };	
    return $tmp;
}

function removecrlf($str) 
{
    return strtr($str, '\015\012', ' ');
}

function validate_mail($email) 
{
    //if(strlen($email) < 7 || !preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', $email)):
    if(strlen((string) $email) < 7 || !preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', (string) $email)): 
 
	
        DisplayError(_ERRORINVEMAIL);
        return false;
     
	else: 
        return $email;
	endif;
}

function encode_mail($email) 
{
    $finished = '';

  //for($i=0, $j = strlen($email); $i<$j; ++$i):
  //      $n = mt_rand(0, 1);
		
    for($i=0, $j = strlen((string) $email); $i<$j; ++$i):
        $n = random_int(0, 1);
		
        $finished .= ($n) ? '&#x'.sprintf('%X',ord($email[$i])).';' : '&#'.ord($email[$i]).';';
    endfor;

    return $finished;
}

/**
* @get user name colors
* @Alternative, saves user colors in seperate cache files!
* @version 4.0.3
* @cache zf1-future
* @author Ernest Allen Buffington
*/
function UsernameColorBBC($username, $old_name=false) {
    global $db, $user_prefix, $use_colors, $cache;
	
	$cached_names = [];
    static $cached_names;

	$horndonkle_username = md5($username); 

    if($old_name) { $username = $old_name; }
    
    if ((($cached_names = $cache->load('Horndonkle_UserColors', 'config'.$horndonkle_username)) === false) || empty($cached_names) && !isset($cached_names)) 
	{
	        list($user_color, $uname) = $db->sql_ufetchrow("SELECT `user_color_gc`, `username` FROM `" . $user_prefix . "_users` WHERE `username` = '" . str_replace("'", "\'", $username) . "'", SQL_NUM);

         if(isset($uname)):  
            if(isset($user_color)):
			$username = '<span style="color: #'. $user_color .'">'. $uname .'</span>';
            else:
			$username = $uname;
			endif;
 			$cached_names = $username;
            $cache->save('Horndonkle_UserColors', 'config'.$horndonkle_username, $cached_names);
		endif;
    }

  
  return $cached_names;
    
}

/**
* @Horndonkle user name colors
* @saves user colors in seperate cache files!
* @version 4.0.3
* @cache zf1-future
* @author Ernest Allen Buffington
*/
function UsernameColor($username, $old_name=false) 
{
    global $db, $user_prefix, $use_colors, $cache;

    static $cached_names;
	$horndonkle_name = '';
	
	$cached_names = [];
	
	if(!isset($plain_username))
	$plain_username = '';
	
    if($old_name): 
	  $username = $old_name; 
	endif;

    if(!$use_colors): 
	  return $username;
	endif;

    if(isset($username)):
	  $horndonkle_name = md5((string) $username);
      $plain_username = strtolower((string) $username);
    endif;
    
	if(isset($cached_names[$plain_username])):
	  if(isset($plain_username) && ($cached_names[$plain_username])): 
        return $cached_names[$plain_username];
	  endif;
    endif;
    
	if(!is_array($cached_names)): 
      $cached_names = $cache->load('Horndonkle_UserNameColors_'.$horndonkle_name, 'config');
    endif;

   if (!($cached_names = $cache->load('Horndonkle_UserNameColors_'.$horndonkle_name, 'config'))):
    if (!isset($cached_names[$plain_username])):
        $cached_names = [];
		[$user_color, $uname] = $db->sql_ufetchrow("SELECT `user_color_gc`, `username` FROM `" . $user_prefix . "_users` WHERE `username` = '" . str_replace("'", "\'", (string) $username) . "'", SQL_NUM);
		$uname = (empty($uname)) ? $username : $uname;
        $username = (strlen((string) $user_color) == 6) ? '<span style="color: #'. $user_color .'">'. $uname .'</span>' : $uname;
        if(!empty($username))
		$cached_names[$plain_username] = $username;
        $cache->save('Horndonkle_UserNameColors_'.$horndonkle_name, 'config', $cached_names);
	endif;
   endif;

    return $cached_names[$plain_username] = $cached_names[$plain_username] ?? $username;
}

/**
* @get group colors
* @version 4.0.3
* @cache zf1-future
* @author Ernest Allen Buffington
*/
function GroupColor($group_name, $short=0) {
    global $db, $use_colors, $cache;
    static $cached_groups;
	$cached_groups = [];
    if(!$use_colors) return $group_name;
    $plaingroupname = ( $short !=0 ) ? $group_name.'_short' : $group_name;
    if (!empty($cached_groups[$plaingroupname])) {
        return $cached_groups[$plaingroupname];
    }
    if ((($cached_groups = $cache->load('titanium_GroupNameColors', 'config')) === false) || empty($cached_groups)) {
        $cached_groups = array();
        $sql = 'SELECT `auc`.`group_color` 
		
		AS `group_color`, `gr`.`group_name` as`group_name` 
		FROM ( `'.GROUPS_TABLE.'` `gr` 
		LEFT JOIN  `' . AUC_TABLE . '` `auc` 
		ON `gr`.`group_color` =  `auc`.`group_id`) 
		WHERE `gr`.`group_description` <> "Personal User" 
		ORDER BY `gr`.`group_name` ASC';
        
		$result = $db->sql_query($sql);
        while (list($group_color, $groupcolor_name) = $db->sql_fetchrow($result)) {
            $colorgroup_short = (strlen($groupcolor_name) > 13) ? substr($groupcolor_name,0,10).'...' : $groupcolor_name;
            $colorgroup_name  = $groupcolor_name;
            $cached_groups[$groupcolor_name.'_short'] = (strlen($group_color) == 6) ? '<span style="color: #'. $group_color .'"><strong>'. $colorgroup_short .'</strong></span>' : $colorgroup_short;
            $cached_groups[$groupcolor_name] = (strlen($group_color) == 6) ? '<span style="color: #'. $group_color .'"><strong>'. $colorgroup_name .'</strong></span>' : $colorgroup_name;
        }
        $db->sql_freeresult($result);
        $cache->save('titanium_GroupNameColors', 'config', $cached_groups);
    }
    if (!empty($cached_groups[$plaingroupname])) {
        return $cached_groups[$plaingroupname];
    } else {
        return $plaingroupname;
    }
}

function check_priv_mess($user_id) 
{
    global $db;

    if(empty($user_id) || !is_numeric($user_id)): 
      return false;
	endif;
    
 	$pms = $db->sql_ufetchrow("SELECT COUNT(privmsgs_id) as no FROM ".PRIVMSGS_TABLE." WHERE privmsgs_to_userid='".$user_id."' AND (privmsgs_type='5' OR privmsgs_type='1')");
    
	return $pms['no'];
}

/*****[BEGIN]******************************************
 [ Mod:     NBBCode                           v9.21.0 ]
 ******************************************************/
include_once(NUKE_INCLUDE_DIR.'nbbcode.php');
/*****[END]********************************************
 [ Mod:     NBBCode                           v9.21.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
function get_plus_minus_image () 
{
    static $theme;
    
	static $image;

    if(isset($image) && is_array($image)): 
	  return $image;
	endif;

    if(empty($theme)): 
      if(function_exists('get_theme')): 
        $theme = get_theme();
	  endif;
	endif;

    //$theme_folder = (!empty($theme)) ? ((defined(NUKE_THEMES_DIR)) ? NUKE_THEMES_DIR.$theme.'/images/' : dirname(__FILE__) . '/themes/'.$theme.'/images/') : '';
    $theme_folder = (!empty($theme)) ? ((defined(NUKE_THEMES_DIR)) ? NUKE_THEMES_DIR.$theme.'/images/' : __DIR__ . '/themes/'.$theme.'/images/') : '';

    $image['plus'] = (file_exists($theme_folder.'plus.gif')) ? 'themes/'.$theme.'/images/plus.gif' : 'images/plus.gif';
    $image['minus'] = (file_exists($theme_folder.'minus.gif')) ? 'themes/'.$theme.'/images/minus.gif' : 'images/minus.gif';

    return $image;
}

$plus_minus_images = get_plus_minus_image();
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/

referer();

function block_vpn_proxy_user()
{
  if(get_evo_option('iphub_status', 'int') == 1):
    include_once(NUKE_INCLUDE_DIR.'iphub.novpn.php');
  endif;
}

/*****[BEGIN]******************************************
[ Mod:    NSN Center Blocks                    v2.2.1 ]
******************************************************/
include_once(NUKE_INCLUDE_DIR."nsncb_func.php");
/*****[END]********************************************
[ Mod:    NSN Center Blocks                    v2.2.1 ]
******************************************************/

/*****[BEGIN]******************************************
 [ Module:  Network Projects                v11.11.11 ]
 ******************************************************/
include_once(NUKE_INCLUDE_DIR.'nsnpj_func.php');
/*****[END]********************************************
 [ Module:  Network Projects                v11.11.11 ]
 ******************************************************/
 
 /*****[BEGIN]******************************************
 [ Include:  Zip Class                                ]
 ******************************************************/
include_once(NUKE_CLASSES_DIR.'class.zip.php');
/*****[END]********************************************
 [ Include:  Zip Class                                ]
 ******************************************************/