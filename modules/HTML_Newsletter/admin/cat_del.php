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

define( 'MSNL_APPLY', true );

/************************************************************************
* Script Initialization
************************************************************************/

opentable();

/************************************************************************
* FORM variable validation and cleansing
************************************************************************/

if ( !isset($_POST['msnl_cid']) ) { //Should not get here without a category id set

	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_iCID	= intval( $_POST['msnl_cid'] );

/************************************************************************
* Check impact of deletes.
************************************************************************/

$sql	= "SELECT count(`nid`) as msnl_cnt FROM `".$prefix."_hnl_newsletters` "
				."WHERE `cid` = '$msnl_iCID'";

$result 		= msnl_fSQLCall( $sql );

if ( !$result ) {

	msnl_fRaiseAppError( _MSNL_CAT_ERR_DBGETCAT );	

} else {  //DB call was successful

	echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
	echo "<div id='msnl_div_init'>\n";
	echo "<input type='hidden' name='op' value='msnl_cat'>\n";
	echo "<input type='hidden' name='msnl_cid' value='0'>\n";
	echo "</div>\n";

	$row = $db->sql_fetchrow( $result );
	
	if ( $row['msnl_cnt'] > 0 ) { //This delete will affect current newsletters, get confirmation

		echo "<div ${msnl_asCSS['BLOCK_center']}>"
					."<p><span class='title'>". _MSNL_COM_MSG_WARNING ."</span></p>\n"
					."<p><strong>".$row['msnl_cnt']." "._MSNL_CAT_DEL_MSG_DELIMPACT."</strong></p>\n"
					."<p>"._MSNL_CAT_DEL_MSG_DELIMPACT1."</p>"
					."<p>"
						."[ "
							."<a href=\"javascript:msnl_ObjHandler('msnl_cat_del_apply','msnl_cid','$msnl_iCID');\" "
								."title='"._MSNL_COM_LNK_CONTINUE."'>"._MSNL_COM_LAB_YES
							."</a>\n"
						." | "
							."<a href=\"javascript:msnl_FormHandler('msnl_cat');\" "
								."title='"._MSNL_COM_LNK_CANCEL."'>"._MSNL_COM_LAB_NO
							."</a>\n"
						." ]\n"
					."</p>\n"
				."</div>\n";
	
	} else { //No impact, so go ahead and just do the deletes

		@include("modules/$msnl_sModuleNm/admin/cat_del_apply.php");
	
	}

	echo "</form>\n";

} //End IF check for successful DB update

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

?>