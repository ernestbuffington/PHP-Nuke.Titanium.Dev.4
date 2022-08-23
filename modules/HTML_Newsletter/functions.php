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

/************************************************************************
* FUNCTIONS DEFINED IN THIS SCRIPT:
*
* FUNCTION NAME							BRIEF DISCRIPTION
* ========================	=========================================
* msnl_fGetModCfg						Retrieves module configuration data
* msnl_fSQLCall							Module Wrapper for ALL SQL calls
* msnl_fDebugMsg						Configuration switch controlled output log
* msnl_fRaiseAppError				Wrapper for presenting hard errors
* msnl_fSetValErr						Pushes validation errors onto an array "stack"
* msnl_fShowValErr					Presents the validation error array stack
* msnl_fSetValWarn					Pushes a warning message onto the warning message "stack"
* msnl_fShowValWarn					Displays the "stack" of validation warnings
* msnl_fGetHTML							Retrieves key HTML from output buffer
* msnl_fShowHelp						Shows standard help image, link and text
* msnl_fShowHelpLegend			Shows a standard legend for use of the pop-up help icon
* msnl_fShowBtnGoBack				Shows standard GO BACK link and javascript
* msnl_fPrintHTML						Misc commonly used HTML to display
* msnl_fIsViewable					Determines if user has permissions to view a given newsletter
* msnl_fGetBlockRow					Produces the row for the block and/or module
* msnl_fShowSubTitle				Shows title for sub-menu
************************************************************************/

if ( !defined( 'MSNL_LOADED' ) and !defined( 'BLOCK_FILE' ) and !defined( 'NUKE_FILE' ) ) {
	die( "Illegal File Access" );
}

/************************************************************************
* Function:		msnl_fGetModCfg
* Inputs:			None
* Returns:		Array of string key/value pairs
* Usage:			Used to grab module configuration data.
************************************************************************/

function msnl_fGetModCfg() {

	global $prefix, $db;
	
	$asModCfg	= array();

	$sql = "SELECT * FROM `".$prefix."_hnl_cfg`";

	$result = msnl_fSQLCall( $sql );

	if ( !$result ) {		//DB call was not successful, so raise an application error

		msnl_fRaiseAppError( _MSNL_COM_ERR_DBGETCFG );	

	} else { //DB Call was successful

		while ( list( $cfg_nm, $cfg_val ) = $db->sql_fetchrow( $result ) ) {

			$asModCfg[$cfg_nm] 		= $cfg_val;

		}
		
		return $asModCfg;

	}

}	//End of function msnl_fGetModCfg()

/************************************************************************
* Function:		msnl_fSQLCall
* Inputs:			sql	= The sql to execute
* Returns:		DB connection handle
* Usage:			Used to wrap the PHP-Nuke SQL calls to add a layer of 
* 						application level debug messaging.
************************************************************************/

function msnl_fSQLCall( $sql ) {

	global $msnl_gasModCfg, $db;
	
	$result = $db->sql_query( $sql );
	
	if ( $result ) {

		msnl_fDebugMsg( "<b>"._MSNL_COM_LAB_SQL." = </b>".$sql );

		return $result;

	} else {

		if ( $msnl_gasModCfg['debug_mode'] != MSNL_OFF )	{

			$sql_error = $db->sql_error();

			echo "<p><b>"._MSNL_COM_ERR_SQL.": </b>".$sql_error['message']."</p>\n";
			echo "<p><b>"._MSNL_COM_LAB_SQL." = </b>".$sql."</p>\n";

		}

		return $result;

	}
	
}	//End of function msnl_fSQLCall()

/************************************************************************
* Function:		msnl_fDebugMsg
* Inputs:			$msnl_gasModCfg[]	= Array string of module config data
* 						sDebugMsg					= The message to display
* Usage:			Used to provide more verbose debug messaging if debug mode
* 						is turned on.  Is also configurable as to where to write
* 						the debug message to.
************************************************************************/

function msnl_fDebugMsg( $sDebugMsg ) {

	global $msnl_gasModCfg;
	
	if ( $msnl_gasModCfg['debug_mode'] == MSNL_VERBOSE )	{

//Commented out code below will become future functionality to be able to log output to display, 
//to a logfile, or both.
//		if ( ($msnl_gasModCfg['DebugOutput'] == MSNL_DISPLAY) || ($msnl_gasModCfg['DebugOutput'] == MSNL_BOTH) ) { //Send back to client

			if ( is_array( $sDebugMsg ) ) {
			
				echo "<p>";
				print_r( $sDebugMsg );
				echo "</p>";

			} else {
			
				echo "<p>";
				echo $sDebugMsg;
				echo "</p>";
				
			}

//		} elseif ( ($msnl_gasModCfg['DebugOutput'] == MSNL_LOGFILE) || ($msnl_gasModCfg['DebugOutput'] == MSNL_BOTH) ) { //Write to logfile

//			echo "Need to write code to log to logfile<br />";

//		}

	}
	
}	//End of function msnl_fDebugMsg()

/************************************************************************
* Function: 	msnl_fRaiseAppError
* Inputs:			ErrMsg
* Usage: 			If an error occurs, build page approprialy but with error msg.
************************************************************************/

function msnl_fRaiseAppError( $ErrMsg ) {

	global $msnl_sModuleNm, $msnl_giHeadersSent;

	echo "<p><b>"._MSNL_COM_ERR_MODULE.": </b>".$msnl_sModuleNm."</p>\n"
			."<p><b>"._MSNL_COM_LAB_ERRMSG.": </b>".$ErrMsg."</p>\n";

			
	if ( $msnl_giHeadersSent ) {
	
		closetable();
		
		echo "<!-- MSNL_END -->\n";

		@include( "footer.php" );

	}
	
	die();

}  //End of function msnl_fRaiseAppError()

/************************************************************************
* Function: 	msnl_fSetValErr
* Inputs:			sFieldNm	= The name of the field that had the error
* 						sErrMsg		= The error string to "push" onto the stack
* Usage: 			Pushes an error message onto the error message "stack".
* 						Typically called from validation routines where hard errors
* 						like msnl_fRaiseAppErr() are not appropriate.
************************************************************************/

function msnl_fSetValErr( $sFieldNm='', $sErrMsg='' ) {

	global $msnl_asERR;

	if ( $sFieldNm != "" && $sErrMsg != "" ) {
	
		array_push( $msnl_asERR, array( $sFieldNm, $sErrMsg ) );
		
	}

}  //End of function msnl_fSetValErr()

/************************************************************************
* Function: 	msnl_fShowValErr
* Inputs:			N/A
* Returns:		0 = Had no validation errors on the "stack"
* 						1 = Had errors, so display them.
* Usage: 			Displays the "stack" of validation errors provided in the
* 						array
************************************************************************/

function msnl_fShowValErr() {

	global $msnl_asERR;
	
	$iReturn	= 0;
	$sHTML		= "";
	
	if ( sizeof( $msnl_asERR ) > 0 ) {

		$sHTML	.= "<p>"
								."<strong>"._MSNL_COM_ERR_VALMSG.":</strong>\n"
							."</p>\n"
							."<p>\n";
							
		foreach ( $msnl_asERR as $key => $saErr) {
		
			$sHTML	.= "<b>".$saErr[0]."</b>:&nbsp;".$saErr[1]."<br />\n";
		
		}
		
		$sHTML	.= "</p>\n";

		$iReturn	= 1;
		
	}

	echo $sHTML;
	
	return $iReturn;

}  //End of function msnl_fShowValErr()

/************************************************************************
* Function: 	msnl_fSetValWarn
* Inputs:			sWarnMsg		= The warning string to "push" onto the stack
* Usage: 			Pushes a warning message onto the warning message "stack".
* 						Typically called from validation routines where hard errors
* 						like msnl_fRaiseAppErr() and msnl_fShowValErr are not
* 						appropriate.
************************************************************************/

function msnl_fSetValWarn( $sWarnMsg='' ) {

	global $msnl_asWARN;

	if ( $sWarnMsg != "" ) {
	
		array_push( $msnl_asWARN, $sWarnMsg );
		
	}

}  //End of function msnl_fSetValWarn()

/************************************************************************
* Function: 	msnl_fShowValWarn
* Inputs:			N/A
* Returns:		0 = Had no validation errors on the "stack"
* 						1 = Had errors, so display them.
* Usage: 			Displays the "stack" of validation warnings provided in the
* 						array
************************************************************************/

function msnl_fShowValWarn() {

	global $msnl_asWARN;
	
	$iReturn	= 0;
	$sHTML		= "";
	

	if ( sizeof( $msnl_asWARN ) > 0 ) {

		$sHTML	.= "<p>"
								."<strong>"._MSNL_COM_ERR_VALWARNMSG.":</strong>\n"
							."</p>\n"
							."<p>\n";
							
		$sTmp		= implode("<br />\n", $msnl_asWARN);
		
		$sHTML	.= $sTmp."</p>\n";

		$iReturn	= 1;
		
	}

	echo $sHTML;
	
	return $iReturn;

}  //End of function msnl_fShowValWarn()

/************************************************************************
* Function: msnl_fGetHTML
* Inputs:		None
* Usage: 		Generates and stores key HTML used throughout the tool.
************************************************************************/

function msnl_fGetHTML() {

	$sHTMLArray					= array();

	//Get the OpenTable HTML
	ob_start();
	opentable();
	$sHTMLArray['OPEN']	= ob_get_contents();
	ob_clean();

	//Get the CloseTable HTML
	closetable();
	$sHTMLArray['CLOSE']	= ob_get_contents();
	ob_end_clean();

	return $sHTMLArray;

} //End of function msnl_fGetHTML()

/************************************************************************
* Function: msnl_fShowHelp
* Inputs:		$sHelpTxt	= The help text to display in the pop-up
*						$sFieldNm	= The field name to display in bold text
* Returns:	HTML code for the IMG tag to show the pop-up help icon.
* Usage: 		To ensure consistency in showing the help icon throughout.
************************************************************************/

function msnl_fShowHelp( $sHelpTxt='', $sFieldNm='' ) {

	global $msnl_sModuleNm, $msnl_asCSS;
	$sHTMLTmp = "";

	$sHTML	= "&nbsp;<img ${msnl_asCSS['IMG_hlp']} src='./modules/$msnl_sModuleNm/images/question.png' "
							."height='12' width='12' alt='' "
							."onmouseover=\"return escape('";

	if ( $sFieldNm != "" ) {

		$sHTMLTmp	.= "<strong>$sFieldNm:</strong>&nbsp;";

	}

	$sHTMLTmp		.= $sHelpTxt;
	

	$sHTMLTmp		= str_replace("\"", "&quot;", $sHTMLTmp);
	$sHTMLTmp		= str_replace("\'", "&acute;", $sHTMLTmp);
//	$sHTMLTmp		= rawurlencode( $sHTMLTmp );

	$sHTML	.= addslashes( $sHTMLTmp ) ."')\">&nbsp;\n";

	return $sHTML;

} //End of function msnl_fShowHelp()

/************************************************************************
* Function: msnl_fShowHelpLegend
* Inputs:		None
* Returns:	HTML code for the IMG tag to show the pop-up help icon legend.
* Usage: 		Shows a standard legend for use of the pop-up help icon.
************************************************************************/

function msnl_fShowHelpLegend() {

	global $msnl_asCSS, $msnl_sModuleNm;

	$sHTML	= "<p>" . msnl_fShowHelp( _MSNL_COM_HLP_HELPLEGENDTXT, '' );

	$sHTML	.= " = " . _MSNL_COM_LAB_HELPLEGENDTXT ."</p>\n";

	echo $sHTML;
	
	return;

} //End of function msnl_fShowHelp()

/************************************************************************
* Function:	msnl_fShowBtnGoBack
* Inputs:		N/A
* Usage:		Shows the GO BACK Button and link.
************************************************************************/

function msnl_fShowBtnGoBack() {

	global $msnl_asCSS;

	echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
				."<input type='button' value='"._MSNL_COM_LAB_GOBACK."' title='"._MSNL_COM_LNK_GOBACK."' "
				."onclick=\"javascript:history.go(-1);\">\n"
			."</p>\n";

} //End of function msnl_fShowBtnGoBack()

/************************************************************************
* Function: msnl_fPrintHTML()
* Inputs:		sHTML
* Usage: 		Echos out the provided HTML based on what is passed to it.
************************************************************************/

function msnl_fPrintHTML( $sHTML='' ) {

global $msnl_sModuleNm, $msnl_asCSS, $op;

switch( $sHTML ) {

	case "BEGIN":

		//Write out the start "TAG" for the module as well as pull in common javascript functions
		
		echo "\n\n<!-- MSNL_BEGIN: http://montegoscripts.com -->\n\n";
		
		break;

	case "END":

		//Write out the ending "TAGS" for the module
		
		if ( $op != "msnl_copyright_credits" ) { 

			echo "<div id=\"msnl_div_copyright\" ${msnl_asCSS['BLOCK_right']}>\n"
						."<br />"
						."<a href=\"modules.php?name=$msnl_sModuleNm&amp;op=msnl_copyright_credits\" "
							."title=\""._MSNL_CPY_LNK_VIEWCOPYRIGHT."\">"
								. str_replace( "_", " ", $msnl_sModuleNm) ."&nbsp;&copy;</a>"
						."<br /><br />\n"
					."</div>\n";
					
		}

		echo "\n\n<!-- MSNL_END -->\n\n";
		
		break;

	default:

		echo "";
		
		break;
		
	} //End of SWITCH


} //End of function msnl_fPrintHTML()

/************************************************************************
* Function: msnl_fIsViewable()
* Inputs:		view			= What category of user was sent the newsletter
* 					nsngroups	= Whether or not NSN Groups are to be used
* 					cid				= ??
* 					groups		= The NSN Groups the user has been given access to
* Usage: 		Determines if Newsletter should be viewable to the user.
************************************************************************/

function msnl_fIsViewable( $view, $cid, $groups ) {

	global $admin, $user, $userinfo, $msnl_gasModCfg;

	//NOTE: only Admins should be allowed to see the first category which is reserved for *Unassigned*

	$viewable = 0;

	if ( $cid <> 1 AND $view == 0 ) {  //Anonymous

			$viewable = 1;

	} elseif ( is_admin( $admin ) ) {  //Administrators should see ALL Newsletters

			$viewable = 1;

	} elseif ( $cid <> 1 AND $view == 1 AND is_user( $user ) ) {  //Registered User

			$viewable = 1;

	} elseif ( $cid <> 1 AND $view == 2 AND is_user( $user ) AND $userinfo[newsletter] == 1 ) {  //Subscribed (Newsletter) User

			$viewable = 1;

	} elseif ( $cid <> 1 AND $view == 3 AND is_user( $user ) AND paid() ) {  //Paid subscribers

			$viewable = 1;

	} elseif ( $cid <> 1 AND $view == 3 AND is_user( $user ) AND $msnl_gasModCfg['nsn_groups'] == 1 ) {  //NSN Groups Only

			if ( in_groups( $groups ) ) {

				$viewable = 1;

			}

	}

	return $viewable;

} //End of function msnl_fIsViewable()

/************************************************************************
* Function: msnl_fGetBlockRow()
* Inputs:		TBD
* Usage: 		Produces the row for the block.
************************************************************************/

function msnl_fGetBlockRow( $idx_nl_nbr, $nid, $topic, $sender, $hits, $datesent ) {

	global $msnl_sModuleNm, $msnl_gasModCfg;

	$row = "";
	$url = "modules.php?name=$msnl_sModuleNm&amp;op=msnl_nls_view&amp;msnl_nid=$nid";

	$row .= "$idx_nl_nbr.&nbsp;"
					."<a href=\"$url\" title=\""._MSNL_NLS_LNK_VIEWNL."\" "
					."onclick=\"window.open(this.href, 'ViewNewsletter'); return false\">$topic";

	if ( $msnl_gasModCfg['show_hits'] == 1 ) {

		if ( $hits == 1 ) {

			$row .= " ($hits "._MSNL_NLS_LAB_HIT.")";

		} else {

			$row .= " ($hits "._MSNL_NLS_LAB_HITS.")";

		}

	}

	if ( $msnl_gasModCfg['show_dates'] == 1 ) {

		$sentdate = date( 'D M d, Y', strtotime( $datesent ) );

		$row .= " ("._MSNL_NLS_LAB_SENTON.": $sentdate)";

	}

	if ( $msnl_gasModCfg['show_sender'] == 1 ) {

		$row .= " ("._MSNL_NLS_LAB_SENDER.": $sender)";

	}

	$row .= "</a>\n<br>";

	return $row;

} //End of function msnl_fGetBlockRow()

/************************************************************************
* Function:	msnl_fShowSubTitle
* Inputs:		$sTitle	= The name of the config sub-menu that was selected
* Usage:		Shows a standard format for the chosen sub-menu.
************************************************************************/

function msnl_fShowSubTitle( $sTitle='' ) {

	global $msnl_gasModCfg, $msnl_asCSS;

	echo "\n<p ${msnl_asCSS['BLOCK_center']}>"
					."<span class='title'>"
						. $sTitle 
					."</span>"
			."</p>\n";

}  //End of function msnl_fShowSubTitle()

?>