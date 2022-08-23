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
* Ensure that the module is not being called directly and then set up
* application level define that is used throughout the module to ensure
* no script is called outside of THIS index.php script.
************************************************************************/

if ( !defined('MODULE_FILE') ) { die("You can't access this file directly..."); }

define('MSNL_LOADED', true);
define('NW_HNL_LOADED', true);	//This is here for compatibility purposes with v1.2 newsletters

$msnl_sModuleNm	= "HTML_Newsletter";	//If you change the module directory, change every instance of this definition

/************************************************************************
* Initialize and assign key module variables.
************************************************************************/

global $msnl_sModuleNm, $index, $msnl_gasModCfg;

@require_once( "./modules/$msnl_sModuleNm/functions.php" );
@require_once( "./modules/$msnl_sModuleNm/config.php" );
@include( "./modules/$msnl_sModuleNm/style.php" );

if ( $msnl_gasModCfg['show_blocks'] == 1 ) {

	$index = 1;											//Here for compatibility with patches below 3.1
	define('INDEX_FILE', true);			//Here for a nuke patched 3.1+
	
} else {

	$index = 0;
	
}

@require_once( "mainfile.php" );

/************************************************************************
* Main "switch" code to control what the module is to do
************************************************************************/

switch( $op ) {

	case "msnl_nls_view":
		@include( "modules/$msnl_sModuleNm/nls_view.php" );
		break;

	case "msnl_copyright_credits":
		@include( "modules/$msnl_sModuleNm/copyright_credits.php" );
		break;

	default:
		@include( "modules/$msnl_sModuleNm/nls_list.php" );
		break;

}

?>