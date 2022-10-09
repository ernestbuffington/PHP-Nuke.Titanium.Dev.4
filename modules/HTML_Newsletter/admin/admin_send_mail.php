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

$msnl_sFileTestEmail	= "./modules/$msnl_sModuleNm/archive/testemail.php";
$msnl_sFileTmp				= "./modules/$msnl_sModuleNm/archive/tmp.php";

/************************************************************************
* Determine if we're in batch send mode. Does nothing right now!
************************************************************************/

if ( isSet( $_POST['msnl_op'] ) AND $_POST['msnl_op'] == "hnlnxt" ) { 

	define('MSNL_BATCH_NEXT', true);

}

/************************************************************************
* Make sure incoming POST variables are OK and validate certain conditions
************************************************************************/

@include_once( "modules/$msnl_sModuleNm/admin/admin_check_post.php" );

if ( sizeof( $msnl_asERR ) != 0 ) { //Had validation errors so display them

	opentable();
	msnl_fShowValErr();
	msnl_fShowBtnGoBack();
	closetable();

} else {  //Did not have errors so proceed to newsletter send

	opentable();
	msnl_fShowSubTitle( _MSNL_ADM_SEND_LAB_SENDNL );

	/************************************************************************
	* Either get existing file or generate Newsletter file and also key
	* newsletter variables.
	************************************************************************/

	if ( defined( 'MSNL_SENDTESTED' ) ) { //Test newsletter was already created and sent so use it

		if ( @file_exists( $msnl_sFileTestEmail ) ) { //Make sure the file still exists

			@include_once( $msnl_sFileTestEmail );	

			$msnl_sTopic					= stripslashes(	FixQuotes( $ftopic ) );
			$msnl_sSender					= stripslashes(	FixQuotes( $fsender ) );
			$msnl_iCID						= intval(	$fcid	);
			$msnl_sEmailText			= $emailfile;

		} else {  //Does not exist!  

			msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_NOTESTEMAIL );	

		}

	} else {  //Had not previously created and sent, so create it

			@include_once( "modules/$msnl_sModuleNm/admin/admin_make_nls.php" );

	}

	/************************************************************************
	* If using ad-hoc email addresses, set the variable here.
	************************************************************************/

	if ( isset( $_POST['msnl_emailaddresses'] ) ) {

			$msnl_sEmailAddresses	= stripslashes( $_POST['msnl_emailaddresses'] );

	} else {

			$msnl_sEmailAddresses	= "";
			
	}

	/************************************************************************
	* Determine the proper View settings.
	************************************************************************/

	if ( $_POST['msnl_sendemail'] == "anonymous" ) {

		$msnl_iView = 0;

	} elseif ( $_POST['msnl_sendemail'] == "massmail" ) {

		$msnl_iView = 1;

	} elseif ( $_POST['msnl_sendemail'] == "newsletter" ) {

		$msnl_iView = 2;

	} elseif ( $_POST['msnl_sendemail'] == "paidsubscribers" ) {

		$msnl_iView = 3;

	} elseif ( $_POST['msnl_sendemail'] == "nsngroups" ) {

		$msnl_iView = 4;

	} elseif ( $_POST['msnl_sendemail'] == "adhoc" ) {

		$msnl_iView = 5;

	} elseif ( $_POST['msnl_sendemail'] == "testemail" ) {

		$msnl_iView = 99;

	} else {

		msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_INVALIDVIEW );	

	}

	msnl_fDebugMsg( "msnl_iView = $msnl_iView" );

	/************************************************************************
	* If NSN Groups were selected, determine proper groups setting.
	************************************************************************/

	msnl_fDebugMsg ( $msnl_nsngroupid );

	$msnl_sGroups = "";

	if ( $msnl_iView == 4 ) {  //Ignore group input if NSN Groups option is not selected

			$msnl_sGroups = msnl_fGrpsImplode( $msnl_nsngroupid );

	}

	msnl_fDebugMsg( "msnl_sGroups = $msnl_sGroups" );

	/************************************************************************
	* Build datesent and filename strings and write the newsletter file.
	************************************************************************/

	$msnl_sDatesent = date( "Y-m-d" );
	
	if ( $msnl_iView >= 90 ) { //Sending testemail to the Admin

		$msnl_sFilename		= "testemail.php";		

	} else { //Real newsletter filename needed

		$msnl_sFilename		= time() . ".php";

	}

	$msnl_sFFilename = "./modules/$msnl_sModuleNm/archive/" . $msnl_sFilename;

	msnl_fDebugMsg( "msnl_sFFilename = $msnl_sFFilename" );

	if ( !@file_exists( $msnl_sFFilename ) ) { //File does not exist so need to create it

		@touch( $msnl_sFFilename );
		
	}

	chmod( $msnl_sFFilename, 0766 );

	msnl_fDebugMsg( "msnl_sFileTestEmail = $msnl_sFileTestEmail" );

	if ( defined( 'MSNL_SENDTESTED' ) ) {  //If using existing NL, copy it to new file

		if ( @file_exists( $msnl_sFileTestEmail ) ) {

			if ( !@copy( $msnl_sFileTestEmail, $msnl_sFFilename ) ) {

				msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_CREATENL );	

			}

		} else {

				msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_NOTESTEMAIL );	

		}

	} else {  //Have to create new file

		if ( file_exists( $msnl_sFFilename ) ) { //File exists already so make sure can write to it

			@chmod( $msnl_sFFilename, 0766 );
		
		}

		$msnl_oFile = fopen( $msnl_sFFilename, "w" );

		@fwrite( $msnl_oFile, $msnl_sNewsletter );

		@fclose( $msnl_oFile );

	}

	@chmod( $msnl_sFFilename, 0664 );

	msnl_fDebugMsg( "msnl_sFilename = $msnl_sFilename" );

	/************************************************************************
	* Add newsletter entry into the database.
	************************************************************************/

	if ( $msnl_iView < 90 ) { //Do not insert if sending testemail to Admin ONLY

		$msnl_iNID = msnl_fAddNls( $msnl_iCID, $msnl_sTopic, $msnl_sSender, $msnl_sFilename, 
															$msnl_sDatesent, $msnl_iView, $msnl_sGroups );

	} else {
	
		$msnl_iNID = 2;
		
	}
	
	/************************************************************************
	* Build recipient email SQL string.
	************************************************************************/

	if ( $msnl_iView == 1 ) {  //All registered users

			$sql = "SELECT `user_id`, `user_email` FROM `".$prefix."_users` WHERE `user_email` > ''";

	} elseif ( $msnl_iView == 2 ) {  //Newsletter subscribers

			$sql = "SELECT `user_id`, `user_email` FROM `".$prefix."_users` "
						."WHERE `user_email` > '' AND `newsletter` = '1'";

	} elseif ( $msnl_iView == 3 ) {  //Paid subscribers

			$sql = "SELECT `user_id`, `user_email` FROM `"
						.$prefix."_users` a, `"
						.$prefix."_subscriptions` b "
						."WHERE `user_email` > '' AND a.`user_id` = b.`userid`";

	} elseif ( $msnl_iView == 4 ) {  //NSN Groups users

		$nsngrpstr = "'". str_replace("-", "','", $msnl_sGroups) ."'";

		$sql = "SELECT DISTINCT `user_id`, `user_email` FROM `"
					.$prefix."_users` a, `"
					.$prefix."_nsngr_users` b "
					."WHERE b.`uid` = a.`user_id` AND `gid` IN (". $nsngrpstr .") "
					."ORDER BY a.`user_id`";

	}	elseif ( $msnl_iView == 5 ) {  //Send to Ad-Hoc email address list

		$sql = "adhoc";

	}	elseif ( $msnl_iView == 99 ) {  //Send to Admin ONLY

		$sql = "testemail";

	}	
	
	/************************************************************************
	* Send out the newsletter!
	************************************************************************/

	$msnl_sURL		= "./modules.php?name=".$msnl_sModuleNm
									."&amp;op=msnl_nls_view&amp;msnl_nid=".$msnl_iNID;

	$msnl_sNlsLnk	= "<p><a href=\"$msnl_sURL\" title=\""._MSNL_NLS_LNK_VIEWNL."\" "
									."onclick=\"window.open(this.href, 'ViewNewsletter'); return false\">"
									.$msnl_sTopic."</p>";

	if ( $msnl_iView == 0 ) {  //All Visitors - no send of email necessary

		echo "<p>". _MSNL_ADM_SEND_MSG_ANONYMOUS ."</p>\n";

	} else {

		$msnl_iUserID = msnl_fSendNls( $msnl_sEmailText, $msnl_sSender, $sql, $msnl_sEmailAddresses );

		if ( $msnl_iUserID ) { //A newsletter was sent!

			echo "<p>"._MSNL_ADM_SEND_MSG_SENDSUCCESS ."</p>\n";

		} else {  //Newsletter failed to send

			echo "<p>"._MSNL_ADM_SEND_MSG_SENDFAILURE."</p>\n";

		} //End check if newsletter was sent
		
	} //End check if view is of send type
	
	echo $msnl_sNlsLnk;
	
	/************************************************************************
	* Clean up temporary newsletter files.
	************************************************************************/

	if ( defined( 'MSNL_SENDTESTED' ) ) {

		if ( @file_exists( $msnl_sFileTestEmail ) ) {

			if ( !@unlink( $msnl_sFileTestEmail ) ) {

				msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_DELFILETEST );	

			}

		}

	} //End IF to check if sending a tested email

	if ( @file_exists( $msnl_sFileTmp ) ) {

		if ( !@unlink( $msnl_sFileTmp ) ) {

			msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_DELFILETMP );	

		}

	}

	closetable();

	unset( $_POST );

}  //End of IF from checking errors on the POST variables

?>