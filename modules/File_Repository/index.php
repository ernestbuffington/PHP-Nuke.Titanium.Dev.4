<?php

/*
	Author: Lonestar
	Author Email: crazycoder@live.co.uk
	Author URI: http://lonestar-modules.com
	Copyright Header: Module Copyright © Information
	Module Description: This module brings you an advanced file manager, Has been developed to be as user friendly as possible..
	Module Download Path: https://lonestar-modules.com/modules.php?name=File_Repository&action=view&did=21
	Module Name: File Repository	
	Module Version: 1.1.0	
*/


/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|	VERSION 			:	1.0.0
|----------------------------------------------------------------------
*/

if (!defined('MODULE_FILE')) 
	die("You can't access this file directly...");

$module_name = basename(dirname(__FILE__));
require_once('mainfile.php');

define('IN_FILE_REPOSITORY', TRUE);

if(file_exists(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$currentlang.'.php'))
	include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$currentlang.'.php');
else
	include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-english.php');

include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

get_header();

include_once(NUKE_MODULES_DIR.$module_name.'/public/index.php');

_copyright_popup_display();
get_footer();

?>