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

if ( !defined( 'MSNL_LOADED' ) ) { die( "Illegal File Access" ); }

/************************************************************************
* Initialize and assign key module variables.
************************************************************************/

$msnl_asHadChg	= array();  //Used to determine which Latest vars have changed

/************************************************************************
* Do Not check certain options if we are sending an already tested email.
************************************************************************/

if ( !defined( 'MSNL_SENDTESTED') ) {  //Extra checks for untested newsletters

	/************************************************************************
	* Strip and clean input
	************************************************************************/

	$_POST['msnl_stats']			= stripslashes( $_POST['msnl_stats'] );
	$_POST['msnl_toc']				= stripslashes( $_POST['msnl_toc'] );
	$_POST['msnl_banner']			= intval( $_POST['msnl_banner'] );
//	$_POST['msnl_textbody']		= str_replace( "\"", "&quot;", stripslashes( $_POST['msnl_textbody'] ) );
	$_POST['msnl_topic']			= str_replace( "\"", "&quot;", stripslashes( strip_tags( $_POST['msnl_topic'], "<b><i><u>" ) ) );
	$_POST['msnl_template']		= stripslashes( $_POST['msnl_template'] );

	//Need to create a more robust stripping of quotes, double quotes and special chars.
	//It can fail with some mail sending programs.  This code is to be expanded upon in
	//future versions.

	$_POST['msnl_sender']			= str_replace( "\"", "", stripslashes( strip_tags( $_POST['msnl_sender'], "<b><i><u>" ) ) );

	/************************************************************************
	* Check Latest for values - if none, pull from saved config values
	************************************************************************/

	if ( $_POST['msnl_news'] == "" ) {

		$_POST['msnl_news'] = $msnl_gasModCfg['latest_news'];

	} else {

		$_POST['msnl_news'] = intval( $_POST['msnl_news'] );
		
		if ( $_POST['msnl_news'] != $msnl_gasModCfg['latest_news'] ) { 

			$msnl_asHadChg['latest_news'] = $_POST['msnl_news'];

		}		

	} //End validation of msnl_news

	if ( $_POST['msnl_downloads'] == "" ) {

		$_POST['msnl_downloads'] = $msnl_gasModCfg['latest_downloads'];

	} else {

		$_POST['msnl_downloads'] = intval( $_POST['msnl_downloads'] );
		
		if ( $_POST['msnl_downloads'] != $msnl_gasModCfg['latest_downloads'] ) { 

			$msnl_asHadChg['latest_downloads'] = $_POST['msnl_downloads'];

		}		

	} //End validation of msnl_downloads

	if ( $_POST['msnl_weblinks'] == "" ) {

		$_POST['msnl_weblinks'] = $msnl_gasModCfg['latest_links'];

	} else {

		$_POST['msnl_weblinks'] = intval( $_POST['msnl_weblinks'] );
		
		if ( $_POST['msnl_weblinks'] != $msnl_gasModCfg['latest_links'] ) { 

			$msnl_asHadChg['latest_links'] = $_POST['msnl_weblinks'];

		}		

	} //End validation of msnl_weblinks

	if ( $_POST['msnl_forums'] == "" ) {

		$_POST['msnl_forums'] = $msnl_gasModCfg['latest_forums'];

	} else {

		$_POST['msnl_forums'] = intval( $_POST['msnl_forums'] );
		
		if ( $_POST['msnl_forums'] != $msnl_gasModCfg['latest_forums'] ) { 

			$msnl_asHadChg['latest_forums'] = $_POST['msnl_forums'];

		}		

	} //End validation of msnl_forums

	if ( $_POST['msnl_reviews'] == "" ) {

		$_POST['msnl_reviews'] = $msnl_gasModCfg['latest_reviews'];

	} else {

		$_POST['msnl_reviews'] = intval( $_POST['msnl_reviews'] );
		
		if ( $_POST['msnl_reviews'] != $msnl_gasModCfg['latest_reviews'] ) { 

			$msnl_asHadChg['latest_reviews'] = $_POST['msnl_reviews'];

		}		

	} //End validation of msnl_reviews

	/************************************************************************
	* Check for additional field errors
	************************************************************************/

	if ( $_POST['msnl_topic'] == "" ) {

		msnl_fSetValErr( _MSNL_ADM_LAB_TOPIC, _MSNL_COM_MSG_REQUIRED );	

	}

	if ( $_POST['msnl_sender'] == "" ) {

		msnl_fSetValErr( _MSNL_ADM_LAB_SENDER, _MSNL_COM_MSG_REQUIRED );	

	}

	if ( $_POST['msnl_textbody'] == "" ) {

		msnl_fSetValErr( _MSNL_ADM_LAB_TEXTBODY, _MSNL_COM_MSG_REQUIRED );	

	}

	if ( $_POST['msnl_template'] == "" ) {

		msnl_fRaiseAppError( _MSNL_ADM_ERR_NOTEMPLATE );	

	}

	if ( $_POST['msnl_sendemail'] == "" ) {

		msnl_fRaiseAppError( _MSNL_ADM_ERR_NOSENDTO );	

	}

	/************************************************************************
	* Save off Latest xxxxxx values to _hnl_cfg
	************************************************************************/
	
	foreach( $msnl_asHadChg as $msnl_sKey => $msnl_sValue ) {

		$sql = "UPDATE `".$prefix."_hnl_cfg` SET `cfg_val` = '$msnl_sValue' "
					."WHERE `cfg_nm` = '$msnl_sKey'";

		if ( !msnl_fSQLCall( $sql ) ) { //Had an error in the UPDATE

			msnl_fRaiseAppError( _MSNL_ADM_ERR_DBUPDLATEST." - $msnl_sLatest" );	

		} //End IF
		
	} //End of foreach

}  //End of checks that are only for untested Newsletters

/************************************************************************
* These checks shall be done each and every time
************************************************************************/

//Validate who to send to

$_POST['msnl_sendemail'] = stripslashes( $_POST['msnl_sendemail'] );

if ( $_POST['msnl_sendemail'] == "" || ( $_POST['msnl_sendemail'] != "testemail" 
		&& $_POST['msnl_sendemail'] != "newsletter" && $_POST['msnl_sendemail'] != "massmail" 
		&& $_POST['msnl_sendemail'] != "anonymous" && $_POST['msnl_sendemail'] != "paidsubscribers" 
		&& $_POST['msnl_sendemail'] != "nsngroups" && $_POST['msnl_sendemail'] != "adhoc" ) ) {

	msnl_fRaiseAppError( _MSNL_ADM_ERR_NOSENDTO );	

}

//Validate that a NSN Group has been checked IF elected to use them

if ( $msnl_gasModCfg['nsn_groups'] == 1 && $_POST['msnl_sendemail'] == "nsngroups" 
		&& !isSet( $_POST['msnl_nsngroupid'] ) ) {

	msnl_fSetValErr( _MSNL_ADM_LAB_NSNGRPS, _MSNL_ADM_VAL_NONSNGRP );	

}

//Do a little cleansing of the ad-hoc email list (very minimal!)
//NOTE: This was a quick-fix to a few minor data entry issues... need to be more complete and use
//a more robust filtering/fixing routine that is not str_replace based.

if ( $_POST['msnl_sendemail'] == "adhoc" ) {

	$_POST['msnl_sendemail']	= str_replace( " ", "", $_POST['msnl_sendemail'] ); //Remove spaces
	$_POST['msnl_sendemail']	= str_replace( ";", ",", $_POST['msnl_sendemail'] ); //Change semicolons
	
}

?>