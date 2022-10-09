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

if ( isSet( $_POST['msnl_cid'] ) ) { //Take category ID if passed

	$msnl_iCID = intval( $_POST['msnl_cid'] );
	
} else {  //Otherwise, default it

	$msnl_iCID = 1;
	
}

opentable();

msnl_fShowSubTitle( _MSNL_NLS_LAB_NLSCFG );

/************************************************************************
* Get the HTML for the SELECT object of categories.
************************************************************************/

$msnl_asHTML['SELECT'] = msnl_fGetCategories( $msnl_iCID, MSNL_SHOW_ALL_ON );

/************************************************************************
* Build the SQL for the newsletters to display.
************************************************************************/

$sql = "SELECT a.`nid`, a.`cid`, b.`ctitle`, a.`topic`, a.`sender`, a.`datesent` "
			."FROM `".$prefix."_hnl_newsletters` a, `".$prefix."_hnl_categories` b ";

if ( $msnl_iCID == 0 ) {  //Pull all newsletters regardless of category

	$sql .= "WHERE a.`cid` = b.`cid` ";

} else { //Pull only newsletters for the selected category

	$sql .= "WHERE a.`cid` = '$msnl_iCID' AND a.`cid` = b.`cid` ";

}

$sql	.= "ORDER BY `datesent` DESC";

$result 				= msnl_fSQLCall( $sql );
$resultcount		= $db->sql_numrows( $result );

/************************************************************************
* Check if there was an error getting the newsletters, and if not, write them
* out to the screen.
************************************************************************/

if ( !$result ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_NLS_ERR_DBGETNLSS );	

} else { //Successful SQL call

	/************************************************************************
	* If we found newsletters, write them out along with respective actions.
	************************************************************************/

	echo "\n<form method=\"post\" action=\"$admin_file.php\" name=\"msnl_frm\">\n";
	echo "<div id=\"msnl_div_init\">\n";
	echo "<input type='hidden' name='op' value='msnl_nls'>";
	echo "<input type='hidden' name='msnl_nid' value='0'>";
	echo "</div>\n";

	//Write out SELECT object for newsletter categories that was built previously

	echo "<div ${msnl_asCSS['BLOCK_center']}>\n"
				._MSNL_NLS_LAB_CURRENTCAT.":&nbsp;\n";

	echo $msnl_asHTML['SELECT'];

	echo "<input type='button' value='". _MSNL_COM_LAB_GO ."' title='"._MSNL_NLS_LNK_GETNLS."' "
					."onclick=\"javascript:msnl_FormHandler('msnl_nls');\">\n"
			."</div>\n";

	//Write out the table of newsletters

	echo "<div id='msnl_div_main'><br>\n";

	echo "<table ${msnl_asCSS['TABLE_data']}>\n"
				."<tr ${msnl_asCSS['TR_hdr']}>"
					."<td>"._MSNL_ADM_LAB_TOPIC."</td>"
					."<td>"._MSNL_ADM_LAB_SENDER."</td>"
					."<td>"._MSNL_NLS_LAB_DATESENT."</td>"
					."<td>"._MSNL_NLS_LAB_CATEGORY."</td>"
					."<td>"._MSNL_COM_LAB_ACTIONS
						.msnl_fShowHelp( _MSNL_COM_HLP_ACTIONS, _MSNL_COM_LAB_ACTIONS)
					."</td>"
				."</tr>\n";

	/************************************************************************
	* Cycle through the result set.
	************************************************************************/

	while (	$row = $db->sql_fetchrow( $result ) ) { 

			$msnl_asRec['nid']						= intval( $row['nid'] );
			$msnl_asRec['cid']						= intval( $row['cid'] );
			$msnl_asRec['ctitle']					= stripslashes( $row['ctitle'] );
			$msnl_asRec['topic']					= $row['topic'];
			$msnl_asRec['sender']					= stripslashes( $row['sender'] );
			$msnl_asRec['datesent']				= $row['datesent'];

		/************************************************************************
		* Write out the list of categories found.
		************************************************************************/

		echo "<tr ${msnl_asCSS['TR_rows']} onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\">\n"
					."<td ${msnl_asCSS['TD_left_nw']}><b>".$msnl_asRec['topic']."</b></td>"
					."<td ${msnl_asCSS['TD_left_nw']}>".$msnl_asRec['sender']."</td>"
					."<td ${msnl_asCSS['TD_center_nw']}>".$msnl_asRec['datesent']."</td>"
					."<td ${msnl_asCSS['TD_left_nw']}>".$msnl_asRec['ctitle']."</td>"
					."<td ${msnl_asCSS['TD_left_nw']}>";

		$msnl_sURL = "./modules.php?name=$msnl_sModuleNm&amp;op=msnl_nls_view&amp;msnl_nid=".$msnl_asRec['nid'];

		echo "<a href=\"$msnl_sURL\" onclick=\"window.open(this.href, 'ViewNewsletter'); return false\">"
					."<img ${msnl_asCSS['IMG_def']} src=\"./modules/$msnl_sModuleNm/images/view.png\" height='16' width='16' "
							."alt=\"". _MSNL_NLS_LNK_VIEWNL ."\">"
				."</a>&nbsp;\n";

		if ( $msnl_asRec['nid'] > 2 ) {

			echo "<a href=\"javascript:msnl_ObjHandler('msnl_nls_chg','msnl_nid','".$msnl_asRec['nid']."');\" "
							."title=''>"
						."<img ${msnl_asCSS['IMG_def']} src='./modules/$msnl_sModuleNm/images/change.png' height='16' width='16' "
							."alt='"._MSNL_NLS_LNK_NLSCHG."'>"
					."</a>\n"
					."&nbsp;&nbsp;"
					."<a href=\"javascript:msnl_ObjHandler('msnl_nls_del','msnl_nid','".$msnl_asRec['nid']."');\" "
							."title=''>"
						."<img ${msnl_asCSS['IMG_def']} src='./modules/$msnl_sModuleNm/images/delete.png' height='16' width='16' "
							."alt='"._MSNL_NLS_LNK_NLSDEL."'>"
					."</a>"
					."&nbsp;&nbsp;";

		}

		echo "</td></tr>\n";

	} //End WHILE loop

	echo "</table>\n";
	
	if ( $resultcount < 1 ) { //No rows to display
	
		echo "<p><b>"._MSNL_NLS_MSG_NONLSS."</b><p>";
		
	}

	echo "</div>\n</form>\n";

} //End IF for SQL call

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

//Make pop-up HELP available to the page
echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";

?>