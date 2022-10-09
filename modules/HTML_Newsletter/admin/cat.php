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

msnl_fShowSubTitle( _MSNL_CAT_LAB_CATCFG );

/************************************************************************
* Build the SQL for the categories to display.
************************************************************************/

$sql = "SELECT * FROM ".$prefix."_hnl_categories";

$result 				= msnl_fSQLCall( $sql );
$resultcount		= $db->sql_numrows( $result );

/************************************************************************
* Check if there was an error getting the categories, and if not, write them
* out to the screen.
************************************************************************/

if ( !$result ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_CAT_ERR_DBGETCATS );	

} else { //Successful SQL call

	echo "\n<form method=\"post\" action=\"$admin_file.php\" name=\"msnl_frm\">\n";
	echo "<div id=\"msnl_div_init\">\n";
	echo "<input type='hidden' name='op' value='msnl_cat'>";
	echo "<input type='hidden' name='msnl_cid' value='0'>\n";
	echo "</div>\n";

	echo "<div ${msnl_asCSS['BLOCK_right']}>\n"
				."<input type='button' value='". _MSNL_CAT_LAB_ADDCAT ."' title='"._MSNL_CAT_LNK_ADDCAT."' "
					."onclick=\"javascript:msnl_FormHandler('msnl_cat_add');\">\n"
			."</div>\n";

	echo "<div id='msnl_div_main'><br>\n";

	/************************************************************************
	* If we found categories, write them out along with respective actions.
	************************************************************************/

	if ( $resultcount < 1 ) { //Display No rows message

		msnl_fRaiseAppError( _MSNL_CAT_ERR_NOCATS );	

	} else {

		echo "<table ${msnl_asCSS['TABLE_data']}>\n"
					."<tr ${msnl_asCSS['TR_hdr']}>"
						."<td>"._MSNL_CAT_LAB_CATTITLE."</td>"
						."<td>"._MSNL_CAT_LAB_CATDESC."</td>"
						."<td>"._MSNL_CAT_LAB_CATBLOCKLMT."</td>"
						."<td>"._MSNL_COM_LAB_ACTIONS
							.msnl_fShowHelp( _MSNL_COM_HLP_ACTIONS, _MSNL_COM_LAB_ACTIONS)
						."</td>"
					."</tr>\n";

		/************************************************************************
		* Cycle through the result set.
		************************************************************************/

		while (	$row = $db->sql_fetchrow( $result ) ) { 

				$msnl_asRec['cid']						= intval($row['cid']);
				$msnl_asRec['ctitle']					= stripslashes(check_html($row['ctitle'], "nohtml"));
				$msnl_asRec['cdescription']		= stripslashes(check_html($row['cdescription'], "nohtml"));
				$msnl_asRec['cblocklimit']		= intval($row['cblocklimit']);

			/************************************************************************
			* Write out the list of categories found.
			************************************************************************/

			echo "<tr ${msnl_asCSS['TR_rows']} onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\">\n"
						."<td ${msnl_asCSS['TD_left_nw']}><b>".$msnl_asRec['ctitle']."</b></td>"
						."<td>".$msnl_asRec['cdescription']."</td>"
						."<td ${msnl_asCSS['TD_center_nw']}>".$msnl_asRec['cblocklimit']."</td>"
						."<td ${msnl_asCSS['TD_center_nw']}>";

			if ( $msnl_asRec['cid'] > 1 ) {

				echo "<a href=\"javascript:msnl_ObjHandler('msnl_cat_chg','msnl_cid','".$msnl_asRec['cid']."');\" "
								."title=''>"
							."<img ${msnl_asCSS['IMG_def']} src='./modules/$msnl_sModuleNm/images/change.png' height='16' width='16' "
								."alt='"._MSNL_CAT_LNK_CATCHG."'>"
						."</a>\n"
						."&nbsp;&nbsp;"
						."<a href=\"javascript:msnl_ObjHandler('msnl_cat_del','msnl_cid','".$msnl_asRec['cid']."');\" "
								."title=''>"
							."<img ${msnl_asCSS['IMG_def']} src='./modules/$msnl_sModuleNm/images/delete.png' height='16' width='16' "
								."alt='"._MSNL_CAT_LNK_CATDEL."'>"
						."</a>";

			}

			echo "</td></tr>\n";

		} //End WHILE loop

		echo "</table>\n";

	} //End IF for check of no rows

	echo "</div>\n</form>\n";

} //End IF for SQL call

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

//Make pop-up HELP available to the page
echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";

?>