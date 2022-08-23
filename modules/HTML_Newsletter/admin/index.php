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
* Version:		1.3.1
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

if ( !defined('ADMIN_FILE') ) { die("Illegal File Access"); }

define('MSNL_LOADED', true);
define('NW_MSNL_LOADED', true);	//This is here for compatibility purposes with v1.2 newsletters

$msnl_sModuleNm	= "HTML_Newsletter";	//If you change the module directory, change every instance of this definition

/************************************************************************
* Initialize and assign key module variables.
************************************************************************/

global $db, $prefix;

@require_once( "./modules/$msnl_sModuleNm/functions.php" );
@require_once( "./modules/$msnl_sModuleNm/config.php" );
@require_once( "./modules/$msnl_sModuleNm/admin/functions.php" );
@include( "./modules/$msnl_sModuleNm/style.php" );

/************************************************************************
* Determine if the user is logged in as an admin / author.
* Moved here from ../config.php per: MSNL_010301_04
************************************************************************/

$aid = substr( "$aid", 0, 25 );

$msnl_iAuthUser	= 0;

$sql 						= "SELECT `name`, `radminsuper` FROM `".$prefix."_authors` WHERE `aid`='$aid'";
$result 				= msnl_fSQLCall( $sql );
$row						= $db->sql_fetchrow( $result );

if ( $row['radminsuper'] == 1 ) {  //No need to go any further - we have a super admin

	$msnl_iAuthUser = 1;

} else { //Ok, do not have a super admin, so need to check for module admin

	if ( defined( 'MSNL_PRE75_LOADED' ) ) { //Need to do this the "old" way

		$sql 						= "SELECT `name`, `radminsuper`, `radminnewsletter` FROM `".$prefix."_authors` WHERE `aid`='$aid'";
		$result1 				= msnl_fSQLCall( $sql );
		$row1						= $db->sql_fetchrow( $result1 );

		if ( $row1['radminsuper'] == 1 || $row1['radminnewsletter'] == 1 ) {
		
			$msnl_iAuthUser = 1;
			
		}

	} else { //Do it the 75 and greater method

		$sql						= "SELECT `title`, `admins` FROM `".$prefix."_modules` WHERE `title`='$msnl_sModuleNm'";
		$result1 				= msnl_fSQLCall( $sql );
		$row1						= $db->sql_fetchrow( $result1 );

		$msnl_asAdmins	= explode( ",", $row1['admins'] );

		for ($i=0; $i < sizeof( $msnl_asAdmins ); $i++) {

				if ( $row['name'] == "$msnl_asAdmins[$i]" AND $row1['admins'] != "" ) {

						$msnl_iAuthUser = 1;

				}

		} //End FOR

	} //End IF for check if we are pre nuke 7.5 version installed

} //End IF for check of superadmin

if ( $msnl_iAuthUser == 1 ) {

	define( "MSNL_ADMIN", true );
	
}

/************************************************************************
* Main "switch" code to control what the module is to do
************************************************************************/

@include( "header.php" );

$msnl_asHTML				= msnl_fGetHTML(); //Get OpenTable and CloseTable HTML

$msnl_giHeadersSent	= 1;

//If you are not an admin, no can do! You're outta here...
			
if ( !defined( 'MSNL_ADMIN' ) ) { //User is not an author/admin, so kick them out of here

	GraphicAdmin();
	
	opentable();

	msnl_fRaiseAppError( _MSNL_ERR_NOTAUTHORIZED );	

} else { //User is an admin, so let them Administer the module!

	msnl_fPrintHTML( "BEGIN" ); //Mark the beginning of the module HTML for W3C Compliance checking

	@require_once( "./modules/$msnl_sModuleNm/javascript.php" );

	msnl_fMenuAdm();

	switch( $op ) {

		case "msnl_admin":
			if ( $_POST['msnl_action'] == _MSNL_COM_LAB_SEND ) {
				@include( "modules/$msnl_sModuleNm/admin/admin_send_mail.php" );
			} else {
				@include( "modules/$msnl_sModuleNm/admin/admin.php" );
			}
			break;
		case "msnl_admin_preview":
			@include( "modules/$msnl_sModuleNm/admin/admin_preview.php" );
			break;
		case "msnl_admin_send_mail": 
			@include( "modules/$msnl_sModuleNm/admin/admin_send_mail.php" );
			break;
		case "msnl_admin_send_tested": 
			@include( "modules/$msnl_sModuleNm/admin/admin_send_tested.php" );
			break;
		case "msnl_cfg":
			@include( "modules/$msnl_sModuleNm/admin/cfg.php" );
			break;
		case "msnl_cfg_apply":
			@include( "modules/$msnl_sModuleNm/admin/cfg_apply.php" );
			break;
		case "msnl_cat":
			@include( "modules/$msnl_sModuleNm/admin/cat.php" );
			break;
		case "msnl_cat_add":
			@include( "modules/$msnl_sModuleNm/admin/cat_add.php" );
			break;
		case "msnl_cat_add_apply":
			@include( "modules/$msnl_sModuleNm/admin/cat_add_apply.php" );
			break;
		case "msnl_cat_chg":
			@include( "modules/$msnl_sModuleNm/admin/cat_chg.php" );
			break;
		case "msnl_cat_chg_apply":
			@include( "modules/$msnl_sModuleNm/admin/cat_chg_apply.php" );
			break;
		case "msnl_cat_del":
			@include( "modules/$msnl_sModuleNm/admin/cat_del.php" );
			break;
		case "msnl_cat_del_apply":
			@include( "modules/$msnl_sModuleNm/admin/cat_del_apply.php" );
			break;
		case "msnl_nls":
			@include( "modules/$msnl_sModuleNm/admin/nls.php" );
			break;
		case "msnl_nls_chg":
			@include( "modules/$msnl_sModuleNm/admin/nls_chg.php" );
			break;
		case "msnl_nls_chg_apply":
			@include( "modules/$msnl_sModuleNm/admin/nls_chg_apply.php" );
			break;
		case "msnl_nls_del":
			@include( "modules/$msnl_sModuleNm/admin/nls_del.php" );
			break;
		case "msnl_nls_del_apply":
			@include( "modules/$msnl_sModuleNm/admin/nls_del_apply.php" );
			break;

	}

}

msnl_fPrintHTML( "END" );	//Mark the end of the module HTML for W3C Compliance checking

@include( "footer.php" );

?>