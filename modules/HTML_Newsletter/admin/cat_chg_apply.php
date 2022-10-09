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

/************************************************************************
* Validate Category Input Data
************************************************************************/

//Category ID - Ensure that it is set AND an integer value.

if ( !isset($_POST['msnl_cid']) ) { //Should not get here without a category id set
	
	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_iCID	= intval( $_POST['msnl_cid'] );

//Category Title - Cleanse it of HTML tags.

if ( !isSet( $_POST['msnl_ctitle'] ) || $_POST['msnl_ctitle'] == "" ) {

	msnl_fSetValErr( _MSNL_CAT_LAB_CATTITLE, _MSNL_COM_MSG_REQUIRED );	

} else {

	$msnl_asRec['ctitle'] = strip_tags( $_POST['msnl_ctitle'], "" );

}

//Category Description - Cleanse it of HTML tags.

if ( !isSet( $_POST['msnl_cdescription'] ) || $_POST['msnl_cdescription'] == "" ) {

	msnl_fSetValErr( _MSNL_CAT_LAB_CATDESC, _MSNL_COM_MSG_REQUIRED );	

} else {

	$msnl_asRec['cdescription'] = strip_tags( $_POST['msnl_cdescription'], "" );

}

//Block Limit - Make sure it is an integer value.

if ( !isSet( $_POST['msnl_cblocklimit'] ) || $_POST['msnl_cblocklimit'] == "" ) {

	$msnl_asRec['cblocklimit']	= MSNL_DEFAULT_BLOCKLMT;	

} else {

	if ( $_POST['msnl_cblocklimit'] < 1 ) {

		msnl_fSetValErr( _MSNL_CAT_LAB_CATBLOCKLMT, _MSNL_COM_MSG_POSNONZEROINT );	

	} else {

		$msnl_asRec['cblocklimit']	= intval( $_POST['msnl_cblocklimit'] );
	
	}

}

/************************************************************************
* Run through input and prepare it for database update
************************************************************************/

foreach ( $msnl_asRec as $key => $value ) {

		$msnl_asRec[$key]		= FixQuotes($msnl_asRec[$key]);
		
		if ( !get_magic_quotes_gpc() ) { //If magic quotes are not on, need to escape the input
		
			$msnl_asRec[$key]		= addslashes($msnl_asRec[$key]);

		}

} //End FOREACH to prepare the input for database update

/************************************************************************
* If had validation errors, write them out to the page, otherwise, 
* update the database.
************************************************************************/

if ( msnl_fShowValErr() ) { //Had validation errors, so display return msg

	msnl_fShowBtnGoBack();

} else { //Passed all validation edits, so write to DB

	$sql	= "UPDATE `".$prefix."_hnl_categories` SET "
					."`ctitle` = '"					.$msnl_asRec['ctitle']."', "
					."`cdescription` = '"		.$msnl_asRec['cdescription']."', "
					."`cblocklimit` = '"		.$msnl_asRec['cblocklimit']."' "
					."WHERE `cid` = '"			.$msnl_iCID."'";

	if ( !msnl_fSQLCall($sql) ) { //Had an error in the UPDATE

		msnl_fRaiseAppError( _MSNL_CAT_CHG_APPLY_ERR_DBCATCHG );	

	} else {

		echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
		echo "<div id='msnl_div_init'>\n";
		echo "<input type='hidden' name='op' value='msnl_cat'>\n";
		echo "</div>\n";

		echo "<div ${msnl_asCSS['BLOCK_center']}>"
					."<p><span class='title'>". _MSNL_COM_MSG_UPDSUCCESS ."</span></p>\n"
					."<p>"
						."[ <a href=\"javascript:msnl_FormHandler('msnl_cat');\" title='"._MSNL_LNK_CATEGORYCFG."'>"
								._MSNL_CAT_MSG_CATBACK
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