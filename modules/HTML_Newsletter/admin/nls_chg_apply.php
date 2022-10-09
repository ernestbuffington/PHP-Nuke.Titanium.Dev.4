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
* Script Initialization
************************************************************************/

opentable();

if ( !isset( $_POST['msnl_prev_cid'] ) ) { //Should not get here without a previous category id set

	opentable();
	
	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_iPrevCID	= intval( $_POST['msnl_prev_cid'] );

/************************************************************************
* Validate Newsletter Input Data
************************************************************************/

//Newsletter ID - Ensure that it is set AND an integer value.

if ( !isset( $_POST['msnl_nid'] ) ) { //Should not get here without a newsletter id set
	
	msnl_fRaiseAppError( _MSNL_NLS_ERR_INVALIDNID );	

}

$msnl_iNID	= intval( $_POST['msnl_nid'] );

//Validate the newsletter ID AND get the current category id.
$sql = "SELECT `cid` FROM `"
			.$prefix."_hnl_newsletters` WHERE `nid` = '$msnl_iNID'";

$result				= msnl_fSQLCall( $sql );
$resultcount	= $db->sql_numrows( $result );

if ( !$result || $resultcount < 1 ) { //Bad SQL call or NID was not found in the database

	msnl_fRaiseAppError( _MSNL_NLS_ERR_DBGETNLS );	

} else { //Successful SQL call

	$row						= $db->sql_fetchrow( $result );

	$msnl_iCurrCID	= intval( $row['cid'] );
	
}

//Newsletter Topic - remove HTML tags

if ( !isSet( $_POST['msnl_topic'] ) || $_POST['msnl_topic'] == "" ) {

	msnl_fSetValErr( _MSNL_ADM_LAB_TOPIC, _MSNL_COM_MSG_REQUIRED );	

} else {

	$msnl_asRec['topic'] = stripslashes( strip_tags( $_POST['msnl_topic'], "<b><i><u>" ) );

}

//Sender's Name - remove HTML tags

if ( !isSet( $_POST['msnl_sender'] ) || $_POST['msnl_sender'] == "<b><i><u>" ) {

	msnl_fSetValErr( _MSNL_ADM_LAB_SENDER, _MSNL_COM_MSG_REQUIRED );	

} else {

	$msnl_asRec['sender'] = stripslashes( strip_tags( $_POST['msnl_sender'], "" ) );

}

//Newsletter Category

if ( !isset( $_POST['msnl_cid'] ) ) { //Should not get here without a category id set
	
	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_asRec['cid']	= intval( $_POST['msnl_cid'] );

//Date Sent

if ( !isSet($_POST['msnl_datesent']) || $_POST['msnl_datesent'] == "" ) {

	msnl_fSetValErr( _MSNL_NLS_CHG_LAB_DATESENT, _MSNL_COM_MSG_REQUIRED );	

} else {

	$msnl_asRec['datesent'] = stripslashes( $_POST['msnl_datesent'] );

}

//Who Can View the Newsletter - Must be one of 0 - 4 or 99

if ( isset( $_POST['msnl_view'] ) && $_POST['msnl_view'] != "" && is_numeric(  $_POST['msnl_view'] )
		&& ( ( $_POST['msnl_view'] >= 0 && $_POST['msnl_view'] <= 5 ) || $_POST['msnl_view'] == 99 ) ) {

	$msnl_asRec['view'] = intval( $_POST['msnl_view'] );

} else {

	msnl_fSetValErr( _MSNL_NLS_CHG_LAB_WHOVIEW, _MSNL_NLS_CHG_APPLY_MSG_WHOVIEW );	

}

//NSN Groups (If turned on)

if ( $msnl_gasModCfg['nsn_groups'] == 1 ) {

	$msnl_asRec['groups']	= stripslashes( $_POST['msnl_groups'] );

} else {

	$msnl_asRec['groups']	= "";

}

//Number of Hits - Must be a numeric, integer value (if real, it will truncate it)

if ( isset( $_POST['msnl_hits'] ) && $_POST['msnl_hits'] != "" && is_numeric( $_POST['msnl_hits'] )
		&& $_POST['msnl_hits'] >= 0 ) {

	$msnl_asRec['hits'] = intval( $_POST['msnl_hits'] );

} else {

	msnl_fSetValErr( _MSNL_NLS_CHG_LAB_NBRHITS, _MSNL_COM_MSG_POSNONZEROINT );	

}

//Newsletter Filename

$msnl_asRec['filename'] = stripslashes( $_POST['msnl_filename'] );

$msnl_sFilePath	= "./modules/$msnl_sModuleNm/archive/".$msnl_asRec['filename'];

//msnl_fDebugMsg( $msnl_sFilePath );

if ( !@file_exists( $msnl_sFilePath ) ) {

	msnl_fSetValErr( _MSNL_NLS_CHG_LAB_FILENAME, _MSNL_COM_ERR_FILENOTEXIST );	

}

/************************************************************************
* Run through input and prepare it for database update
************************************************************************/

foreach ( $msnl_asRec as $key => $value ) {

		$msnl_asRec[$key]		= FixQuotes( $msnl_asRec[$key] );
		
		if ( !get_magic_quotes_gpc() ) { //If magic quotes are not on, need to escape the input
		
			$msnl_asRec[$key]		= addslashes( $msnl_asRec[$key] );

		}

} //End FOREACH to prepare the input for database update

/************************************************************************
* If had validation errors, write them out to the page, otherwise, 
* update the database.
************************************************************************/

if ( msnl_fShowValErr() ) { //Had validation errors, so display return msg

	msnl_fShowBtnGoBack();

} else { //Passed all validation edits, so write to DB

	$sql	= "UPDATE `".$prefix."_hnl_newsletters` SET "
					."`topic` = '"				.$msnl_asRec['topic']."', "
					."`sender` = '"				.$msnl_asRec['sender']."', "
					."`cid` = '"					.$msnl_asRec['cid']."', "
					."`datesent` = '"			.$msnl_asRec['datesent']."', "
					."`view` = '"					.$msnl_asRec['view']."', "
					."`hits` = '"					.$msnl_asRec['hits']."', "
					."`groups` = '"				.$msnl_asRec['groups']."', "
					."`filename` = '"			.$msnl_asRec['filename']."' "
					."WHERE `nid` = '"		.$msnl_iNID."'";

	if ( !msnl_fSQLCall( $sql ) ) { //Had an error in the UPDATE

		msnl_fRaiseAppError( _MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG );	

	} else {

		echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
		echo "<div id='msnl_div_init'>\n";
		echo "<input type='hidden' name='op' value='msnl_nls'>\n";

		if ( $msnl_asRec['cid'] != $msnl_iCurrCID ) { //Category was changed

			echo "<input type='hidden' name='msnl_cid' value='".$msnl_asRec['cid']."'>\n";

		} else { //Category was not changed, so retain the originally selected category for nls listing

			echo "<input type='hidden' name='msnl_cid' value='".msnl_iPrevCID."'>\n";

		}

		echo "</div>\n";

		echo "<div ${msnl_asCSS['BLOCK_center']}>"
					."<p><span class='title'>". _MSNL_COM_MSG_UPDSUCCESS ."</span></p>\n"
					."<p>"
						."[ <a href=\"javascript:msnl_FormHandler('msnl_nls');\" title='"._MSNL_LNK_MAINTAINNLS."'>"
								._MSNL_NLS_MSG_NLSBACK
						."</a> ] \n"
					."</p>\n"
				."</div>\n";

		echo "</form>\n";

	} //End IF check for successful DB update

} //End IF check for passing of validations

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

?>