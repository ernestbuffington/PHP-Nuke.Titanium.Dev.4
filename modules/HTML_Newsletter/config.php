<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright © 2004 by NukeWorks                                        */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright © 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Script:			HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:		01.03.01
* Author:			Rob Herder (aka: montego) of montegoscripts.com
* Contact:		montego@montegoscripts.com
* Copyright:	Copyright © 2006 by Montego Scripts
* License:		GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
/************************************************************************
* Rev Date			Change ID				Description
* -----------		--------------	-----------------------------------------
* 12-MAR-2006		MSNL_010301_04	Move admin check to admin scripts for 7.4
************************************************************************/

if ( !defined('MSNL_LOADED') and !defined('BLOCK_FILE') and !defined('NUKE_FILE') ) {
	die("Illegal File Access");
}

global $admin_file, $aid, $prefix, $db, $admin;

get_lang( $msnl_sModuleNm );

if ( !isset( $admin_file ) || $admin_file == "" ) {

	$admin_file = "admin";

}

/************************************************************************
* Initialization and assignment of key "global" variables and CONSTANTS
************************************************************************/

unset( $result );
unset( $resultcount );

$msnl_asRec											= array();	//Used for capturing cleansed DB field values
$msnl_asHTML										= array();	//Used for storing bits of HTML code for later use
$msnl_asHREF										= array();	//Used for storing strings of href/src links
$msnl_asTIT											= array();	//Used for storing link/graphic alt and title text
$msnl_asERR											= array();	//Used for an error message "stack" in validation routines
$msnl_asWARN										= array();	//Used for an warning message "stack" in validation routines
$msnl_gasModCfg									= array();	//Used to store module configuration data

$msnl_giHeadersSent							= 0;
$msnl_gasUserInfo								= getusrinfo($user);
$msnl_giUid											= $msnl_gasUserInfo['user_id'];
$msnl_gsUserName								= $msnl_gasUserInfo['username'];

define("MSNL_OFF", 							"OFF");				//Do NOT Change - debugging will break if you do!
define("MSNL_ERROR", 						"ERROR");			//Do NOT Change - debugging will break if you do!
define("MSNL_VERBOSE", 					"VERBOSE");		//Do NOT Change - debugging will break if you do!
define("MSNL_BOTH", 						"BOTH");			//Do NOT Change - debugging will break if you do!
define("MSNL_DISPLAY", 					"DISPLAY");		//Do NOT Change - debugging will break if you do!
define("MSNL_LOGFILE", 					"LOGFILE");		//Do NOT Change - debugging will break if you do!
define("MSNL_SEPARATOR_MAJOR",	"|");
define("MSNL_SEPARATOR_MINOR",	"=");
define("MSNL_MAX_STRING",				255);
define("MSNL_DEFAULT_BLOCKLMT",	5);
define("MSNL_SHOW_ALL_ON",			1);
define("MSNL_SHOW_ALL_OFF",			0);
define("MSNL_MAX_BATCH_SIZE",		500);
define("MSNL_MAX_ADHOC_SIZE",		1000);

/************************************************************************
* Get module configuration variables
************************************************************************/

$msnl_gasModCfg			= msnl_fGetModCfg();

msnl_fDebugMsg( $msnl_gasModCfg );

/************************************************************************
* Determine if the user is logged in as an admin / author.
* Moved to admin/index.php per: MSNL_010301_04
************************************************************************/

?>