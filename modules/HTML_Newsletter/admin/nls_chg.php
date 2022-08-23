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

if ( !isset( $_POST['msnl_nid'] ) ) { //Should not get here without a newsletter id set

	opentable();
	
	msnl_fRaiseAppError( _MSNL_NLS_ERR_INVALIDNID );	

}

$msnl_iNID	= intval( $_POST['msnl_nid'] );

if ( !isset( $_POST['msnl_cid'] ) ) { //Should not get here without a category id set

	opentable();
	
	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_iPrevCID	= intval( $_POST['msnl_cid'] );

/************************************************************************
* Write out the page title, table headers, and set up the input form.
************************************************************************/

opentable();

msnl_fShowSubTitle( _MSNL_NLS_CHG_LAB_NLSCHG );

/************************************************************************
* Build the SQL to bring in the newsletter information to display.
************************************************************************/

$sql = "SELECT `cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, `filename` FROM `"
			.$prefix."_hnl_newsletters` WHERE `nid` = '$msnl_iNID'";

$result	= msnl_fSQLCall( $sql );

/************************************************************************
* Check if there was an error getting the newsletter information and if not,
* write out the fields to the page.
************************************************************************/

if ( !$result ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_NLS_ERR_DBGETNLS );	

} else { //Successful SQL call

	echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
	echo "<div id='msnl_div_init'>\n";
	echo "<input type='hidden' name='op' value='msnl_nls'>";
	echo "<input type='hidden' name='msnl_nid' value='$msnl_iNID'>\n";
	echo "<input type='hidden' name='msnl_prev_cid' value='$msnl_iPrevCID'>\n";
	echo "</div>\n";

	$row = $db->sql_fetchrow( $result ); 

	$msnl_asRec['cid']							= intval( $row['cid'] );
	$msnl_asRec['topic']						= stripslashes( $row['topic'] );
	$msnl_asRec['sender']						= stripslashes( $row['sender'] );
	$msnl_asRec['datesent']					= stripslashes( $row['datesent'] );
	$msnl_asRec['view']							= intval( $row['view'] );
	$msnl_asRec['groups']						= stripslashes( $row['groups'] );
	$msnl_asRec['hits']							= intval( $row['hits'] );
	$msnl_asRec['filename']					= stripslashes( $row['filename'] );

	/************************************************************************
	* Write out the newsletter information.
	************************************************************************/

	echo "<div id='msnl_div_main'>";
	echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

	//Newsletter Topic

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_ADM_HLP_TOPIC, _MSNL_ADM_LAB_TOPIC )
					._MSNL_ADM_LAB_TOPIC.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type='text' name='msnl_topic' size='50' maxlength='100' "
						."value=\"".$msnl_asRec['topic']."\">\n"
				."</td>\n"
			."</tr>\n";

	//Sender's Name

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_ADM_HLP_SENDER, _MSNL_ADM_LAB_SENDER )
					._MSNL_ADM_LAB_SENDER.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type='text' name='msnl_sender' size='20' maxlength='20' "
						."value=\"".$msnl_asRec['sender']."\">\n"
				."</td>\n"
			."</tr>\n";

	//Newsletter Category

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_ADM_HLP_NLSCAT, _MSNL_ADM_LAB_NLSCAT )
					._MSNL_ADM_LAB_NLSCAT.":&nbsp;"
				."</td>\n"
				."<td>\n";
				
	echo msnl_fGetCategories( $msnl_asRec['cid'], MSNL_SHOW_ALL_OFF );
	
	echo "</td>\n"
				."</tr>\n";

	//Date Sent

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_NLS_CHG_HLP_DATESENT, _MSNL_NLS_CHG_LAB_DATESENT )
					._MSNL_NLS_CHG_LAB_DATESENT.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type='text' name='msnl_datesent' size='20' maxlength='20' "
						."value=\"".$msnl_asRec['datesent']."\">\n"
				."</td>\n"
			."</tr>\n";
			
	//Cautionary Note about system assigned values
	
	echo "<tr><td colspan='2'>&nbsp;</td></tr>\n";
	echo "<tr><td colspan='2'><strong>"._MSNL_NLS_CHG_LAB_CAUTION."</strong></td></tr>\n";
	echo "<tr><td colspan='2'>&nbsp;</td></tr>\n";

	//Who Can View the Newsletter

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_NLS_CHG_HLP_WHOVIEW, _MSNL_NLS_CHG_LAB_WHOVIEW )
					._MSNL_NLS_CHG_LAB_WHOVIEW.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type='text' name='msnl_view' size='4' maxlength='4' "
						."value=\"".$msnl_asRec['view']."\">\n"
				."</td>\n"
			."</tr>\n";

	//NSN Groups (If turned on)
	
	if ( $msnl_gasModCfg['nsn_groups'] == 1 ) {

		echo "<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						.msnl_fShowHelp( _MSNL_NLS_CHG_HLP_NSNGRPS, _MSNL_NLS_CHG_LAB_NSNGRPS )
						._MSNL_NLS_CHG_LAB_NSNGRPS.":&nbsp;"
					."</td>\n"
					."<td>\n"
						."<input type='text' name='msnl_groups' size='30' maxlength='50' "
							."value=\"".$msnl_asRec['groups']."\">\n"
					."</td>\n"
				."</tr>\n";

	}

	//Number of Hits

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_NLS_CHG_HLP_NBRHITS, _MSNL_NLS_CHG_LAB_NBRHITS )
					._MSNL_NLS_CHG_LAB_NBRHITS.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type='text' name='msnl_hits' size='8' maxlength='8' "
						."value=\"".$msnl_asRec['hits']."\">\n"
				."</td>\n"
			."</tr>\n";

	//Newsletter Filename

	echo "<tr ${msnl_asCSS['TR_top']}>\n"
				."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
					.msnl_fShowHelp( _MSNL_NLS_CHG_HLP_FILENAME, _MSNL_NLS_CHG_LAB_FILENAME )
					._MSNL_NLS_CHG_LAB_FILENAME.":&nbsp;"
				."</td>\n"
				."<td>\n"
					."<input type='text' name='msnl_filename' size='32' maxlength='32' "
						."value=\"".$msnl_asRec['filename']."\">\n"
				."</td>\n"
			."</tr>\n";

	/************************************************************************
	* End of FORM fields.
	************************************************************************/

	echo "</table>\n</div>\n";

	//Now show the Save button and close up the form.
	
	msnl_fShowBtnSave('msnl_nls_chg_apply');

	echo "</form>\n";
	
} //End IF for SQL call

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

//Make pop-up HELP available to the page
echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";

?>