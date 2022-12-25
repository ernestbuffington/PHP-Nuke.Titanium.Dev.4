<?php

/*
   ________  ___  ___  _____  _____  ______ ___________ _____ _____ _____ _____ _____________   __
  |_   _|  \/  | / _ \|  __ \|  ___| | ___ \  ___| ___ \  _  /  ___|_   _|_   _|  _  | ___ \ \ / /
    | | | .  . |/ /_\ \ |  \/| |__   | |_/ / |__ | |_/ / | | \ `--.  | |   | | | | | | |_/ /\ V / 
    | | | |\/| ||  _  | | __ |  __|  |    /|  __||  __/| | | |`--. \ | |   | | | | | |    /  \ /  
   _| |_| |  | || | | | |_\ \| |___  | |\ \| |___| |   \ \_/ /\__/ /_| |_  | | \ \_/ / |\ \  | |  
   \___/\_|  |_/\_| |_/\____/\____/  \_| \_\____/\_|    \___/\____/ \___/  \_/  \___/\_| \_| \_/  
 
	Author: Lonestar
	Author Email: crazycoder@live.co.uk
	Author URI: http://lonestar-modules.com
	Copyright Header: Copyright (c) 2015-2017 by lonestar-modules.com
	Module Description: Allows the upload of image's via jquery.
	Module Download Path: http://lonestar-modules.com/modules.php?name=File_Repository&action=view&did=21
	Module Name: Image Repository	
	Module Version: 1.1.0	
*/

/************************************************************************
    Nuke-Evolution: Image Repository
    ======================================================
    Copyright (c) 2015 by lonestar-modules.com
    Author        : Lonestar
    Version       : 1.1.0
    Developer     : Lonestar - www.lonestar-modules.com				
    Notes         : N/A
************************************************************************/

if (!defined('MODULE_FILE'))
	die('NICE TRY, BETTER LUCK NEXT TIME!');

define('_IMAGE_REPOSITORY_INDEX', TRUE);
//-------------------------------------------------------------------------
//	INCLUDE THE LANGUAGE FILES FOR THIS MODULE.
//-------------------------------------------------------------------------
if(file_exists(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$userinfo['user_lang'].'.php'))
	include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$userinfo['user_lang'].'.php');
else
	include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-english.php');
//-------------------------------------------------------------------------
//	INCLUDE THE LANGUAGE FILES FOR THIS MODULE.
//-------------------------------------------------------------------------

//-------------------------------------------------------------------------
//	INCLUDE ALL THE FUNCTION WE NEED THROUGHOUT THE MODULE.
//-------------------------------------------------------------------------
include_once(NUKE_MODULES_DIR.$module_name.'/includes/functions.php');

$settings = image_repo_settings_variables();

if(!is_dir(_IREPOSITORY_USER_FOLDER) && is_user())
	image_repo_users_preferences();
//-------------------------------------------------------------------------

# OVERWRITE THE RIGHT BLOCKS
// $showblocks = 1;
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	include_once(NUKE_BASE_DIR.'header.php');
}

addJSToHead(_IREPOSITORY_JS.'jquery.lonestar.js','file');

switch($op)
{
	default:
		include_once(NUKE_MODULES_DIR.$module_name.'/public/index.php');
		break;
}

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	_copyright_modal();	
	include_once(NUKE_BASE_DIR.'footer.php');
}


?>
