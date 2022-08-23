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

/************************************************************************
* FORM variable validation and cleansing
************************************************************************/

if ( !isset($_POST['msnl_cid']) ) { //Should not get here without a category id set

	opentable();
	
	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_iCID	= intval($_POST['msnl_cid']);

/************************************************************************
* Write out the page title, table headers, and set up the input form.
************************************************************************/

opentable();

msnl_fShowSubTitle( _MSNL_CAT_CHG_LAB_CATCHG );

/************************************************************************
* Get how many newsletters will be impacted by this change.
************************************************************************/

$sql = "SELECT COUNT(`nid`) as msnl_cnt FROM `"
			.$prefix."_hnl_newsletters` WHERE `cid` = '$msnl_iCID'";

$result	= msnl_fSQLCall( $sql );

if ( !$result ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_CAT_ERR_DBGETCNT );	

} else { //Successful SQL call

	$row = $db->sql_fetchrow( $result ); 

	$msnl_iCnt	= intval( $row['msnl_cnt'] );

}

/************************************************************************
* Build the SQL to bring in the Role information to display.
************************************************************************/

$sql = "SELECT `ctitle`, `cdescription`, `cblocklimit` FROM `"
			.$prefix."_hnl_categories` WHERE `cid` = '$msnl_iCID'";

$result1	= msnl_fSQLCall( $sql );

/************************************************************************
* Check if there was an error getting the role information and if not,
* write out the fields to the page.
************************************************************************/

if ( !$result1 ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_CAT_ERR_DBGETCAT );	

} else { //Successful SQL call

	echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
	echo "<div id='msnl_div_init'>\n";
	echo "<input type='hidden' name='op' value='msnl_cat_chg_apply'>";
	echo "<input type='hidden' name='msnl_cid' value='$msnl_iCID'>\n";
	echo "</div>\n";

	$row1 = $db->sql_fetchrow( $result1 ); 

	$msnl_asRec['ctitle']						= stripslashes( check_html( $row1['ctitle'], "nohtml" ) );
	$msnl_asRec['cdescription']			= stripslashes( check_html( $row1['cdescription'], "nohtml" ) );
	$msnl_asRec['cblocklimit'] 			= intval( $row1['cblocklimit'] );

	/************************************************************************
	* Write out the newsletter category information.
	************************************************************************/

	echo "<div id='msnl_div_main'>";
	echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

	//Category Title

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_CAT_HLP_CATTITLE, _MSNL_CAT_LAB_CATTITLE )
					._MSNL_CAT_LAB_CATTITLE.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type='text' name='msnl_ctitle' size='50' maxlength='50' "
						."value=\"".$msnl_asRec['ctitle']."\">\n"
				."</td>\n"
			."</tr>\n";

	//Category Description

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_CAT_HLP_CATDESC, _MSNL_CAT_LAB_CATDESC )
					._MSNL_CAT_LAB_CATDESC.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<textarea name='msnl_cdescription' cols='50' rows='10'>"
						.$msnl_asRec['cdescription']
					."</textarea>\n"
				."</td>\n"
			."</tr>\n";

	//Block Limit

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_CAT_HLP_CATBLOCKLMT.MSNL_DEFAULT_BLOCKLMT."</b>.", 
								_MSNL_CAT_LAB_CATBLOCKLMT )
					._MSNL_CAT_LAB_CATBLOCKLMT.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type=\"text\" name=\"msnl_cblocklimit\" size=\"2\" "
						."maxlength=\"4\" value=\"".$msnl_asRec['cblocklimit']."\">\n"
				."</td>\n"
			."</tr>\n";

	//End of form fields

	echo "</table>\n</div>\n";

	//Show how many newsletters will be impacted by this change.
	
	echo "<p><strong>$msnl_iCnt ". _MSNL_CAT_CHG_MSG_CHGIMPACT ."</strong></p>\n";
	
	//Now show the Save button and close up the form.
	
	msnl_fShowBtnSave('msnl_cat_chg_apply');

	echo "</form>\n";
	
} //End IF for SQL call

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

//Make pop-up HELP available to the page
echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";

?>