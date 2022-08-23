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
* Version:		1.3.0
* Author:			Rob Herder (aka: montego) of montegoscripts.com
* Contact:		montego@montegoscripts.com
* Copyright:	Copyright © 2006 by Montego Scripts
* License:		GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

if ( !defined( 'BLOCK_FILE' ) and !defined( 'NUKE_FILE' ) ) {
	Header( "Location: index.php" );
	die();
}

/************************************************************************
* Initialize and assign key block variables.
************************************************************************/

global $db, $prefix, $msnl_gasModCfg, $msnl_sModuleNm;

$msnl_sModuleNm	= "HTML_Newsletter";	//If you change the module directory, change every instance of this definition

@require_once( "./modules/$msnl_sModuleNm/javascript.php" );
@require_once( "./modules/$msnl_sModuleNm/functions.php" );
@require_once( "./modules/$msnl_sModuleNm/config.php" );
@include( "./modules/$msnl_sModuleNm/style.php" );

/************************************************************************
* Build block content.
************************************************************************/

$content = "<p>";

if ( $msnl_gasModCfg['scroll'] == 1 ) {

	$content .="<marquee behavior=\"scroll\" align=\"center\" direction=\"up\" "
						."height=\"".$msnl_gasModCfg['scroll_height']."\" "
						."scrollamount=\"".$msnl_gasModCfg['scroll_amt']."\" "
						."scrolldelay=\"".$msnl_gasModCfg['scroll_delay']."\" "
						."onmouseover='this.stop()' onmouseout='this.start()'>\n";

}

/* Get Newsletter List and build the block content */

if ( $msnl_gasModCfg['show_categories'] == 1 ) {  //Build SQL for displaying categories

	$sql = "SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, "
				."`ctitle`, `cblocklimit`  FROM `"
				.$prefix."_hnl_newsletters` as nl, `"
				.$prefix."_hnl_categories` nc WHERE nl.`cid` = nc.`cid` "
				."ORDER BY `ctitle` ASC, `datesent` DESC";

} else {  //Build SQL for displaying just date sorted list of newsletters

	$sql = "SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, "
				."`ctitle`, `cblocklimit`  FROM `"
				.$prefix."_hnl_newsletters` as nl, `"
				.$prefix."_hnl_categories` nc WHERE nl.`cid` = nc.`cid` ORDER BY `datesent` DESC";

}

$msnl_result2 = msnl_fSQLCall( $sql );

$msnl_iTotNls		= 1;	//Index for total number of newsletters displayed
$msnl_iNbrNls		= 1;	//Index for number of newsletters displayed within a category
$msnl_sPrevCat	= "";	//For determining category breaks
$msnl_iMoreNls	= 0;	//Flag for when to display the "More Newsletters..." link

while ( $row = $db->sql_fetchrow( $msnl_result2 ) ) {

	$msnl_iNID					= intval( $row['nid'] );
	$msnl_iCID					= intval( $row['cid'] );
	$msnl_sTopic				= stripslashes( $row['topic'] );
	$msnl_sSender				= stripslashes( $row['sender'] );
	$msnl_sDatesent			= $row['datesent'];
	$msnl_iView					= intval( $row['view'] );
	$msnl_sGroups 			= stripslashes( $row['groups'] );
	$msnl_iHits 				= intval( $row['hits'] );
	$msnl_sCtitle 			= stripslashes( $row['ctitle'] );
	$msnl_iCblocklimit 	= intval( $row['cblocklimit'] );

	if ( $msnl_gasModCfg['show_categories'] == 1 ) { //Need to do more work if we are to place newsletters in categories

		if ( msnl_fIsViewable( $msnl_iView, $msnl_iCID, $msnl_sGroups ) ) {  //Is the newsletter viewable by the user?

			if ( $msnl_iTotNls <= $msnl_gasModCfg['blk_lmt'] ) {  //Can still fit more newsletters in the block?

				if ( $msnl_sCtitle <> $msnl_sPrevCat ) {  //Do we need to write out a new category heading?

					$content .= "</p>\n<p ${msnl_asCSS['BLOCK_center']}>\n<strong>"
										."<a href=\"modules.php?name=$msnl_sModuleNm\" "
										."title=\""._MSNL_NLS_LNK_VIEWNLARCHS."\">$msnl_sCtitle</a></strong>\n</p>\n<p>\n";

					$msnl_sPrevCat = $msnl_sCtitle;

					$msnl_iNbrNls = 1;

				}

				if ( $msnl_iNbrNls <= $msnl_iCblocklimit ) {  //Can still fit more newsletters into the category display?

					$content .= msnl_fGetBlockRow( $msnl_iNbrNls, $msnl_iNID, $msnl_sTopic, $msnl_sSender, $msnl_iHits, $msnl_sDatesent ) . "<br>";

					$msnl_iNbrNls++;

					$msnl_iTotNls++;

				} else {

					$msnl_iMoreNls = 1;

				}

			} else {  //Have reached the limit on number of newsletters allowed in the block

				$msnl_iMoreNls = 1;  //Flag that we still have more viewable newsletters than can fit in the block

				break;

			}

		}

	} else {  //No categories

		if ( msnl_fIsViewable( $msnl_iView, $msnl_gasModCfg['nsn_groups'], $msnl_iCID, $msnl_sGroups ) ) {  //Check if newsletter is viewable by the user

			if ( $msnl_iNbrNls <= $msnl_gasModCfg['blk_lmt'] ) {  //Can still fit more newsletters in the block

				$content .= msnl_fGetBlockRow( $msnl_iNbrNls, $msnl_iNID, $msnl_sTopic, $msnl_sSender, $msnl_iHits, $msnl_sDatesent ) . "<br>";

				$msnl_iNbrNls++;

				$msnl_iTotNls++;

			} else {  //Have reached the limit on number of newsletters allowed in the block

				$msnl_iMoreNls = 1;  //Flag that we still have more viewable newsletters than can fit in the block

				break;

			}

		}

	} //End of showcategories IF

} //End of while loop for list of newsletters

if ( $msnl_iTotNls == 0 ) {  //There were no newsletters to view

	$content .= "</p><p ${msnl_asCSS['BLOCK_center']}><strong>". _MSNL_NLS_LST_MSG_NONLS ."</strong>";

}

if ( $msnl_iMoreNls ) {

	$content .= "</p><p ${msnl_asCSS['BLOCK_center']}><strong>"
							."<a href=\"./modules.php?name=$msnl_sModuleNm\" "
							."title=\""._MSNL_NLS_LNK_VIEWNLARCHS."\">"._MSNL_NLS_LAB_MORENLS."</a></strong>";

}

if ( $msnl_gasModCfg['scroll'] == 1 ) {

	$content .="</marquee>\n";

}

$content .= "</p>";

?>