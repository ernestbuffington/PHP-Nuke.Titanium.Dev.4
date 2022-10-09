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
* FORM variable validation and cleansing
************************************************************************/

if ( !isset( $_POST['msnl_nid'] ) ) { //Should not get here without a newsletter id set

	msnl_fRaiseAppError( _MSNL_NLS_ERR_INVALIDNID );	

}

$msnl_iNID	= intval( $_POST['msnl_nid'] );

if ( !isset( $_POST['msnl_cid'] ) ) { //Should not get here without a category id set

	opentable();
	
	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_iCID	= intval( $_POST['msnl_cid'] );

/************************************************************************
* Get the filename for the newsletter to delete.
************************************************************************/

$sql	= "SELECT `filename` "
			. "FROM `".$prefix."_hnl_newsletters` "
			. "WHERE `nid` = '$msnl_iNID'";

$result	= msnl_fSQLCall( $sql );

if ( !$result ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_NLS_ERR_DBGETNLS );	

} else { //Successful SQL call

	$row = $db->sql_fetchrow( $result ); 

	$msnl_asRec['filename']		= stripslashes( $row['filename'] );

}

/************************************************************************
* Delete the newsletter file first.
************************************************************************/

$msnl_sFilePath	= "./modules/$msnl_sModuleNm/archive/".$msnl_asRec['filename'];

if ( !@file_exists( $msnl_sFilePath ) ) {

	msnl_fRaiseAppError( _MSNL_COM_ERR_FILENOTEXIST );	

} else { //File exists so try and delete it

	if ( !@unlink( $msnl_sFilePath ) ) { //Had error upon attempting to delete

		msnl_fRaiseAppError( _MSNL_NLS_DEL_APPLY_ERR_FILEDEL );	

	}
	
} //End IF check on if file to be deleted exists

/************************************************************************
* Perform the delete.
************************************************************************/

$sql	= "DELETE FROM `".$prefix."_hnl_newsletters` "
				."WHERE `nid` = '$msnl_iNID'";

if ( !msnl_fSQLCall($sql) ) { //Had an error in the DELETE

	msnl_fRaiseAppError( _MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL );	

} else {

	echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
	echo "<div id='msnl_div_init'>\n";
	echo "<input type='hidden' name='op' value='msnl_nls'>\n";
	echo "<input type='hidden' name='msnl_cid' value='".$msnl_iCID."'>\n";
	echo "</div>\n";

	echo "<div ${msnl_asCSS['BLOCK_center']}>"
				."<p><span class='title'>". _MSNL_COM_MSG_DELSUCCESS ."</span></p>\n"
					."<p>"
						."[ <a href=\"javascript:msnl_FormHandler('msnl_nls');\" title='"._MSNL_LNK_MAINTAINNLS."'>"
								._MSNL_NLS_MSG_NLSBACK
						."</a> ] \n"
					."</p>\n"
				."</div>\n";

	echo "</form>\n";

} //End IF check for successful DB update

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

?>