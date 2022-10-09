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
* Validate Configuration Input Data
************************************************************************/

//DebugMode - If it is not one of the defined values, error out, otherwise set it

if ( $_POST['msnl_debug_mode'] <> MSNL_OFF 
		&& $_POST['msnl_debug_mode'] <> MSNL_ERROR 
		&& $_POST['msnl_debug_mode'] <> MSNL_VERBOSE ) {

	msnl_fRaiseAppError( _MSNL_CFG_APPLY_VAL_DEBUGMODE );	

} else {

	$msnl_asRec['debug_mode'] = $_POST['msnl_debug_mode'];

}

//DebugOutput - If it is not one of the defined values, error out, otherwise set it

/* TBD: Need to write the LOGFILE option as yet so comment this out for now

if ($_POST['msnl_debug_output'] <> MSNL_DISPLAY 
		&& $_POST['msnl_debug_output'] <> MSNL_LOGFILE 
		&& $_POST['msnl_debug_output'] <> MSNL_BOTH ) {

	msnl_fRaiseAppError( _MSNL_CFG_APPLY_VAL_DEBUGOUTPUT );	

} else {

	$msnl_asRec['debug_output'] = $_POST['msnl_debug_output'];

}
*/

//Show Blocks - 1 = show right-hand blocks; 0 = hide right-hand blocks

if ( isSet($_POST['msnl_show_blocks']) ) { 

	$msnl_asRec['show_blocks'] = "1";

} else {

	$msnl_asRec['show_blocks'] = "0";

}

//Use NSN Groups - 1 = use NSN Groups; 0 = Do not use NSN Groups and/or NSN Groups is not installed

if ( isSet($_POST['msnl_nsn_groups']) ) { 

	$msnl_asRec['nsn_groups'] = "1";

} else {

	$msnl_asRec['nsn_groups'] = "0";

}

//Download Module name - most download modules model after the core nuke tables, but can have
//a different table subfix.  E.g., NSN Groups uses nsngd instead of downloads

if ( !isSet($_POST['msnl_dl_module']) || $_POST['msnl_dl_module'] == "" ) {

	msnl_fSetValErr( _MSNL_CFG_LAB_DLMODULE, _MSNL_COM_MSG_REQUIRED );	

} else {

	$msnl_asRec['dl_module'] = strip_tags($_POST['msnl_dl_module'], "");

}

//Use nukeWYSIWYG - 1 = use nukeWYSIWYG; 0 = Do not use nukeWYSIWYG and/or NSN Groups is not installed

if ( isSet($_POST['msnl_wysiwyg_on']) ) { 

	$msnl_asRec['wysiwyg_on'] = "1";

} else {

	$msnl_asRec['wysiwyg_on'] = "0";

}

//Number of rows to Show for Textbody Content

$msnl_asRec['wysiwyg_rows'] = intval( $_POST['msnl_wysiwyg_rows'] );

//Show Categories - Checked will show newsletter categories in block - Archives always show categories

if ( isSet($_POST['msnl_show_categories']) ) { 

	$msnl_asRec['show_categories'] = "1";

} else {

	$msnl_asRec['show_categories'] = "0";

}

//Show Hits - Checked will show newsletter hits in block and in archives

if ( isSet($_POST['msnl_show_hits']) ) { 

	$msnl_asRec['show_hits'] = "1";

} else {

	$msnl_asRec['show_hits'] = "0";

}

//Show Dates Sent - Checked will show the date a newsletter was sent on in both block and archives

if ( isSet($_POST['msnl_show_dates']) ) { 

	$msnl_asRec['show_dates'] = "1";

} else {

	$msnl_asRec['show_dates'] = "0";

}

//Show Sender - Checked will show the sender of the newsletter in the block and archives

if ( isSet($_POST['msnl_show_sender']) ) { 

	$msnl_asRec['show_sender'] = "1";

} else {

	$msnl_asRec['show_sender'] = "0";

}

//Newsletters to Show - The TOTAL number of newsletters to show in the block.

$msnl_asRec['blk_lmt'] = intval( $_POST['msnl_blk_lmt'] );

//Scrolling Block - Checked will cause the newsletter list in the block to scroll

if ( isSet($_POST['msnl_scroll']) ) { 

	$msnl_asRec['scroll'] = "1";

} else {

	$msnl_asRec['scroll'] = "0";

}

//Scrolling Height - The number of pixels for the scrolling height.

$msnl_asRec['scroll_height'] = intval( $_POST['msnl_scroll_height'] );

//Scrolling Amount - The number of pixels to move for each scroll.

$msnl_asRec['scroll_amt'] = intval( $_POST['msnl_scroll_amt'] );

//Scrolling Delay - Number of miliseconds to wait between scrolls.

$msnl_asRec['scroll_delay'] = intval( $_POST['msnl_scroll_delay'] );

/************************************************************************
* If had validation errors, write them out to the page, otherwise, 
* update the database.
************************************************************************/

if ( msnl_fShowValErr() ) { //Had validation errors, so display return msg

	msnl_fShowBtnGoBack();

} else { //Passed all validation edits, so write to DB

	foreach ( $msnl_asRec as $key => $value ) {

		if ( $msnl_gasModCfg['$key'] <> $value ) { //Update only if change really occurred

			$sql = "UPDATE `".$prefix."_hnl_cfg` "
						."SET `cfg_val` = '$value' "
						."WHERE `cfg_nm` = '$key'";

	
			if ( !msnl_fSQLCall($sql) ) { //Had an error in the UPDATE

				msnl_fRaiseAppError( _MSNL_CFG_APPLY_ERR_DBFAILED." for '$key'");	

			}

		}	//End IF for checking if value really changed on the screen vs. that database

	} //End of FOREACH

	echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
	echo "<div id='msnl_div_init'>\n";
	echo "<input type='hidden' name='op' value='msnl_cfg'>\n";
	echo "</div>\n";

	echo "<div ${msnl_asCSS['BLOCK_center']}>"
				."<p><span class='title'>". _MSNL_COM_MSG_UPDSUCCESS ."</span></p>\n"
				."<p>"
					."[ <a href='$admin_file.php?op=msnl_cfg' title='"._MSNL_LNK_MAINCFG."'>"
						._MSNL_CFG_APPLY_MSG_BACK
					."</a> ] \n"
				."</p>\n"
			."</div>\n";
	
	echo "</form>\n";
	
} //End IF check for passing of validations

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

?>