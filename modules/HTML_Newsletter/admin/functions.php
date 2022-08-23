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
* Rev Date			Change ID				Description
* -----------		--------------	-----------------------------------------
* 16-MAR-2006		MSNL_010301_06	Date format function breaks non-English sites.
* 12-MAR-2006		MSNL_010301_03	Minor chg in mail headers.
* 12-MAR-2006		MSNL_010301_02	Blank subject line fix.
************************************************************************/

/************************************************************************
* FUNCTIONS DEFINED IN THIS SCRIPT:
*
* FUNCTION NAME							BRIEF DISCRIPTION
* ========================	=========================================
* msnl_fFormatDate					For formatting of dates based on user or site preferences.
* msnl_fMenuAdm							Shows the Administration Main Menu.
* msnl_fGetNbrRecipients		Returns potential number of recipients.
* msnl_fGetSendTo						Returns the option list for "Who to Send the Newsletter To".
* msnl_fGetNSNGroups				Shows the options list for the various NSN Groups.
* msnl_fAddNls							Adds the newsletter meta-data to the database.
* msnl_fSendNls							Does the physical submittal of the email.
* msnl_fGetCategories				Returns a SELECT object of newsletter categories.
* msnl_fShowBtnAdd					Shows standard ADD button.
* msnl_fShowBtnSave					Shows standard SAVE button.
* msnl_fGrpsExplode					To explore out a string of NSN Groups to an array.
* msnl_fGrpsImplode					To implode an array of NSN Group numbers into a string.
************************************************************************/

if ( !defined( 'MSNL_LOADED' ) ) { die( "Illegal File Access" ); }

/************************************************************************
* Initialize and assign key module variables.
************************************************************************/

//Get phpBB configuration information to assist with date/time conversions

$msnl_asPHPBBCfg = array();

$sql = "SELECT `config_name`, `config_value` FROM `".$prefix."_bbconfig`";

$result		= msnl_fSQLCall( $sql );

if ( !$result ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_COM_ERR_DBGETPHPBB );	

} else { //Successful SQL call

	while ( $row = $db->sql_fetchrow( $result ) )	{

		$msnl_asPHPBBCfg[ $row['config_name'] ] = $row['config_value'];

	}
	
}

/************************************************************************
* Function:		msnl_fFormatDate
* Inputs:			$format		= TBD
* 						$gmepoch		= TBD
* 						$tz				= TBD
* Returns:		A string with the formatted date
* Usage:			Copied from phpBB functions.php and modified for our use for
* 						correct date conversions.
************************************************************************/

function msnl_fFormatDate( $format, $gmepoch, $tz ) {

	global $msnl_asPHPBBCfg, $lang;

	static $translate;

/* MSNL_010301_06
	if ( empty( $translate ) && $msnl_asPHPBBCfg['default_lang'] != 'english' ) {

		@reset( $lang['datetime'] );

		while ( list( $match, $replace ) = @each( $lang['datetime'] ) ) {

			$translate[$match] = $replace;

		}

	}
*/

	return ( !empty( $translate ) ) ? strtr( @gmdate( $format, $gmepoch + (3600 * $tz) ), $translate ) : @gmdate( $format, $gmepoch + (3600 * $tz) );

} //End of function msnl_fFormatDate()

/************************************************************************
* Function:		msnl_fMenuAdm
* Inputs:			None
* Returns:		None
* Usage:			Shows the Administration Main Menu.
************************************************************************/

function msnl_fMenuAdm() {

	global $admin_file, $msnl_sModuleNm, $msnl_gasModCfg, $msnl_asCSS;

	$url = "http://wiki.montegoscripts.com/w/HTML_Newsletter";

	echo "<div id='msnl_div_adm_menu'>\n";

	opentable();

	echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
					."<span class='title'>"
						.ucwords(str_replace("_"," ", $msnl_sModuleNm)) ." " . _MSNL_LAB_ADMIN
					."</span>\n"
				."<br>"
				."( "._MSNL_COM_LAB_VERSION." ${msnl_gasModCfg['version']} )"
				."<br><br>\n";

	echo  "[ <a href=\"".$admin_file.".php?op=msnl_admin\" title=\""._MSNL_LNK_CREATENL."\">". _MSNL_LAB_CREATENL ."</a>\n"
			." | <a href=\"".$admin_file.".php?op=msnl_admin_send_tested\" title=\""._MSNL_LNK_SENDTESTED."\">". _MSNL_LAB_SENDTESTED ."</a>\n"
			." | <a href=\"".$admin_file.".php?op=msnl_cfg\" title=\""._MSNL_LNK_MAINCFG."\">". _MSNL_LAB_MAINCFG ."</a>\n"
			." | <a href=\"".$admin_file.".php?op=msnl_cat\" title=\""._MSNL_LNK_CATEGORYCFG."\">". _MSNL_LAB_CATEGORYCFG ."</a>\n"
			." | <a href=\"".$admin_file.".php?op=msnl_nls&amp;cid=1\" title=\""._MSNL_LNK_MAINTAINNLS."\">". _MSNL_LAB_MAINTAINNLS ."</a>\n"
			." | <a href=\"".$admin_file.".php\" title=\""._MSNL_LNK_SITEADMIN."\">". _MSNL_LAB_SITEADMIN ."</a>\n"
			." | <a href=\"modules.php?name=HTML_Newsletter\" title=\""._MSNL_LNK_NLARCHIVES."\">". _MSNL_LAB_NLARCHIVES ."</a>\n"
			." | <a href=\"$url\" title=\""._MSNL_LNK_NLDOCS."\" onclick=\"window.open(this.href, 'NewsletterWiki'); return false\">". _MSNL_LAB_NLDOCS ."</a>\n"
			." ]";

	echo "</p>\n";

	closetable();

	echo "<br></div>\n";

}  //End of function msnl_fMenuAdm()

/************************************************************************
* Function:		msnl_fGetNbrRecipients
* Inputs:			$msnl_op		= the list to send emails to
* 						$gid			= the NSN Group number
* Returns:		Nbr of recipients
* Usage:			Centralizes the logic for returning the appropriate number
* 						of potential email recipients.
************************************************************************/

function msnl_fGetNbrRecipients( $msnl_op, $gid ) {

	global $prefix, $db;

	$gid = intval( $gid );

	switch( $msnl_op ) {

		case "newsletter": //Newsletter subscribers
			$sql = "SELECT count(`newsletter`) AS r_cnt FROM `".$prefix."_users` WHERE `newsletter` = '1'";
			break;

		case "massmail":  //All registered users
			$sql = "SELECT count(`user_email`) AS r_cnt FROM `".$prefix."_users` WHERE `user_email` > ''";
			break;

		case "paidsubscribers":  //Only paid subscribers to the web site
			$sql = "SELECT count(`userid`) AS r_cnt FROM `".$prefix."_subscriptions`";
			break;

		case "nsngroups":  //For a particular NSN Group
			$sql = "SELECT count(`uid`) AS r_cnt FROM `".$prefix."_nsngr_users` WHERE `gid` = '$gid'";
			break;

		default:
			die("Access to function denied!!");
			break;

	}

	$result = msnl_fSQLCall( $sql );

	if ( !$result ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_COM_ERR_DBGETRECIPIENTS."&nbsp;".$msnl_op );	

	} else { //Successful SQL call

		$row = $db->sql_fetchrow( $result );

		$nbrusers = intval( $row['r_cnt'] );

		return $nbrusers;
	
	}

} //End of function msnl_fGetNbrRecipients()

/************************************************************************
* Function:		msnl_fGetSendTo
* Inputs:			None
* Returns:		HTML string for:
* Usage:			Shows the options list for "Who to Send the Newsletter To".
************************************************************************/

function msnl_fGetSendTo() {

	global $prefix, $db, $msnl_gasModCfg, $msnl_asCSS, $msnl_asHTML;

	$sHTML	= "<div id='msnl_div_sendto'>\n"
							."<br />"
							.$msnl_asHTML['OPEN']
							."<p><strong>"._MSNL_ADM_LAB_WHOSNDTO."</strong></p>\n"
								."<table ${msnl_asCSS['TABLE_adm']}>\n"
									."<tr ${msnl_asCSS['TR_top']}>\n"
										."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
											. _MSNL_ADM_LAB_CHOOSESENDTO
											.":&nbsp;"
										."</td>\n"
										."<td></td>\n"
									."<tr ${msnl_asCSS['TR_top']}>\n"
										."<td ${msnl_asCSS['TD_left_nw']} colspan=\"2\">\n";

	//Current subscribers to the site Newsletter
	
	$sHTML	.=  msnl_fShowHelp( _MSNL_ADM_HLP_WHOSNDTONLSUBS, _MSNL_ADM_LAB_WHOSNDTONLSUBS )
						."<input type=\"radio\" name=\"msnl_sendemail\" value=\"newsletter\"";

	if ( $_POST['msnl_sendemail'] == "newsletter" ) { $sHTML .= " CHECKED"; }
	
	$sHTML	.= " />&nbsp;". _MSNL_ADM_LAB_WHOSNDTONLSUBS ." ( "
						. msnl_fGetNbrRecipients( "newsletter", NULL ) ." "
						. _MSNL_ADM_LAB_SUBSCRIBEDUSRS ." )<br />\n";

	//All registered users
	
	$sHTML	.= msnl_fShowHelp( _MSNL_ADM_HLP_WHOSNDTOALLREG, _MSNL_ADM_LAB_WHOSNDTOALLREG )
						."<input type=\"radio\" name=\"msnl_sendemail\" value=\"massmail\"";

	if ( $_POST['msnl_sendemail'] == "massmail" ) { $sHTML .= " CHECKED"; }

	$sHTML	.= " />&nbsp;". _MSNL_ADM_LAB_WHOSNDTOALLREG ." ( "
						. msnl_fGetNbrRecipients( "massmail", NULL ) ." ". _MSNL_ADM_LAB_USERS ." )<br />\n";

	//Users with paid subscriptions -- RLH: need to look into if date is a factor
	
	$sHTML	.= msnl_fShowHelp( _MSNL_ADM_HLP_WHOSNDTOPAID, _MSNL_ADM_LAB_WHOSNDTOPAID )
						."<input type=\"radio\" name=\"msnl_sendemail\" value=\"paidsubscribers\"";
	
	if ( $_POST['msnl_sendemail'] == "paidsubscribers" ) { $sHTML .= " CHECKED"; }
	
	$sHTML	.= " />&nbsp;". _MSNL_ADM_LAB_WHOSNDTOPAID ." ( "
						. msnl_fGetNbrRecipients( "paidsubscribers", NULL ) ." "
						. _MSNL_ADM_LAB_PAIDUSRS ." )<br />\n";

	//Users in a particular NSN Groups group
	
	if ( $msnl_gasModCfg['nsn_groups'] == 1 ) {

		$sHTML	.= msnl_fShowHelp( _MSNL_ADM_HLP_NSNGRPUSRS, _MSNL_ADM_LAB_NSNGRPUSRS )
							."<input type=\"radio\" name=\"msnl_sendemail\" value=\"nsngroups\"";

		if ( $_POST['msnl_sendemail'] == "nsngroups" ) { $sHTML .= " CHECKED"; }

		$sHTML	.= " />&nbsp;". _MSNL_ADM_LAB_WHOSNDTONSNGRPS ."<br />\n";

	}

	//Post Anonymous Newsletter -- i.e., for ALL to see in the Archives
	
	$sHTML	.= msnl_fShowHelp( _MSNL_ADM_HLP_WHOSNDTOANONYV, _MSNL_ADM_LAB_WHOSNDTOANONYV )
						."<input type=\"radio\" name=\"msnl_sendemail\" value=\"anonymous\"";

	if ( $_POST['msnl_sendemail'] == "anonymous" ) { $sHTML .= " CHECKED"; }

	$sHTML	.= " />&nbsp;". _MSNL_ADM_LAB_WHOSNDTOANONY ."<br />\n";

	//Admin Test Email
	
	if (!defined('MSNL_SENDTESTED')) { //Do not show the Admin Only option if sending a tested NL

		$sHTML	.= msnl_fShowHelp( _MSNL_ADM_HLP_WHOSNDTOADM, _MSNL_ADM_LAB_WHOSNDTOADM )
							."<input type=\"radio\" name=\"msnl_sendemail\" value=\"testemail\"";

		if ( $_POST['msnl_sendemail'] == "testemail" ) {

			$sHTML	.= " CHECKED";

		} elseif ( !isset( $_POST['msnl_sendemail'] ) ) {

			$sHTML	.= " CHECKED";

		}

		$sHTML	.= " />&nbsp;". _MSNL_ADM_LAB_WHOSNDTOADM ."<br />\n";

	}
	
	//Ad-Hoc Email Distribution List
	
	$sHTML	.= msnl_fShowHelp( _MSNL_ADM_HLP_WHOSNDTOADHOC, _MSNL_ADM_LAB_WHOSNDTOADHOC )
						."<input type=\"radio\" name=\"msnl_sendemail\" value=\"adhoc\"";

	if ( $_POST['msnl_sendemail'] == "adhoc" ) { $sHTML .= " CHECKED"; }

	$sHTML	.= " />&nbsp;". _MSNL_ADM_LAB_WHOSNDTOADHOC ."&nbsp;"
						."<input type=\"text\" name=\"msnl_emailaddresses\" size=\"60\" "
							."maxlength=\"1000\" value=\"".stripslashes( $_POST['msnl_emailaddresses'] )."\" /><br />\n";

	//Close out this section

	$sHTML	.= "</td></tr></table>\n";

	$sHTML	.=	$msnl_asHTML['CLOSE'];

	$sHTML	.= "</div>\n";
	
	return $sHTML;

}  //End of function msnl_fGetSendTo()

/************************************************************************
* Function:		msnl_fGetNSNGroups
* Inputs:			None
* Returns:		HTML string for:
* Usage:			Shows the options list for the various NSN Groups.
************************************************************************/

function msnl_fGetNSNGroups() {

	global $prefix, $db, $msnl_gasModCfg, $msnl_nsngroupid, $msnl_asHTML, $msnl_asCSS;

	$asNSNGroups	= array();

	if ( isset( $_POST['msnl_nsngroups'] ) ) {
		
		$asNSNGroups = msnl_fGrpsExplode( $_POST['msnl_nsngroups'] );
	
	}

	$sHTML	= "";

	if ( $msnl_gasModCfg['nsn_groups'] == 1 ) {

		$sHTML	.= "<div id='msnl_div_nsngrps'>\n"
								."<br />"
								.$msnl_asHTML['OPEN']
								."<p><strong>"._MSNL_ADM_LAB_CHOOSENSNGRP."</strong><br />"
									._MSNL_ADM_LAB_CHOOSENSNGRP1."\n"
								."</p>\n"
									."<table ${msnl_asCSS['TABLE_adm']}>\n"
										."<tr ${msnl_asCSS['TR_top']}>\n"
											."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
												. msnl_fShowHelp( _MSNL_ADM_HLP_CHOOSENSNGRPUSRS, _MSNL_ADM_LAB_NSNGRPUSRS )
												. _MSNL_ADM_LAB_WHONSNGRP
												.":&nbsp;"
											."</td>\n"
											."<td></td>\n"
										."<tr ${msnl_asCSS['TR_top']}>\n"
											."<td ${msnl_asCSS['TD_left_nw']} colspan=\"2\">\n";

		$i = 0;

		$sql = "SELECT `gid`, `gname` FROM `".$prefix."_nsngr_groups` ORDER BY `gname`";

		$result	= msnl_fSQLCall( $sql );

		if ( !$result ) { //Bad SQL call

			msnl_fRaiseAppError( _MSNL_ADM_ERR_DBGETNSNGRPS );	

		} else { //Successful SQL call

			while ( $row = $db->sql_fetchrow( $result ) ) {

				$gid 			= intval( $row['gid'] );

				$gname		= stripslashes( $row['gname'] );

				$sHTML	.= "<input type=\"checkbox\" name=\"msnl_nsngroupid[]\" value=\"$gid\"";

				if ( in_array( $gid, $asNSNGroups ) ) {
						
					$sHTML	.= "CHECKED"; 
						
				}

				$sHTML	.= " />&nbsp;$gname ( ". msnl_fGetNbrRecipients( "nsngroups", $gid ) ." "
									. _MSNL_ADM_LAB_NSNGRPUSRS ." )<br />\n";

			} //End of while loop
			
		} //End IF for SQL call

		//Close out this section

		$sHTML	.= "</td></tr></table>\n";

		$sHTML	.=	$msnl_asHTML['CLOSE'];

		$sHTML	.= "</div>\n";

	} //End of IF for NSN Groups

	return $sHTML;

} //End of Function msnl_fGetNSNGroups()

/************************************************************************
* Function:		msnl_fAddNls
* Inputs:			Same as the target database fields
* Returns:		$nid		= The id number that was assigned to the new newsletter
* Usage:			Adds the newsletter meta-data to the database.
************************************************************************/

function msnl_fAddNls( $msnl_iCID, $msnl_sTopic, $msnl_sSender, $msnl_sFilename, 
											$msnl_sDatesent, $msnl_iView, $msnl_sGroups ) {

	global $prefix, $db;

	$nid = 0;

	$sql = "INSERT INTO `". $prefix ."_hnl_newsletters` "
				."VALUES ("
					."NULL, "
					."'$msnl_iCID', "
					."'$msnl_sTopic', "
					."'$msnl_sSender', "
					."'$msnl_sFilename', "
					."'$msnl_sDatesent', "
					."'$msnl_iView', "
					."'$msnl_sGroups', "
					."'0'"
				.")";

	$result = msnl_fSQLCall( $sql );

	if ( !$result ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_DBNLSINSERT );	

	} else { //Successful SQL call

		//Now get the nid of the newsletter that was just inserted (for batch send purposes)

		$sql = "SELECT MAX(`nid`) AS nid FROM `". $prefix ."_hnl_newsletters`";

		$result1 = msnl_fSQLCall( $sql );

		if ( !$result1 ) { //Bad SQL call

			msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_DBNLSMAXID );	

		} else { //Successful SQL call

			$row = $db->sql_fetchrow( $result1 );

			$nid = intval( $row['nid'] );
			
		}

	}

	return $nid;

} //End of function msnl_fAddNls()

/************************************************************************
* Function:		msnl_fSendNls
* Inputs:			$emailfile						= the HTML to send
*							$msnl_sSender					= the sender
*							$sql									= the SQL to use to get the list of recipients
* 						$msnl_sEmailaddresses	= adhoc list of email addresses
* Returns:		An integer of either 1, or the user_id that was last sent to
* Usage:			Does the physical submittal of the email.
************************************************************************/

function msnl_fSendNls( $emailfile, $msnl_sSender, $sql, $msnl_sEmailaddresses ) {

	global $sitename, $adminmail, $REMOTE_ADDR, $prefix, $db, $admin_file, $msnl_gasModCfg;

	//Define the email headers once since they are the same for each send option.

	//MSNL_010301_03 - replaced original headers
	$headers		= "MIME-Version: 1.0\n" 
								."Content-Type: text/html; charset=iso-8859-1\r\n" 
								."From: $msnl_sSender<$adminmail>\r\n" 
								."Return-Path: $adminmail\r\n" 
								."Reply-To: $adminmail\r\n" 
								."X-Mailer: MSHNL\r\n" 
								."X-Sender-IP: $REMOTE_ADDR\r\n" 
								."X-Priority: 6\r\n"; 

	//Send newsletter depending on Send To option selected

	if ( $sql == "testemail" ) {  //Send to Admin ONLY

		$emailtitle		= _MSNL_ADM_SEND_LAB_TESTNLFROM." ".$sitename;

		if ( $msnl_gasModCfg['debug_mode'] != MSNL_VERBOSE ) {  //Do not mail if in verbose debug mode

			if ( !@mail( $adminmail, $emailtitle, $emailfile, $headers ) ) { //Mail and test if succesful

				msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_MAIL." ".$adminmail );	//MSNL_010301_02

			}

		}

		return 1;

	} elseif ( $sql == "adhoc" ) {  //Sending to an ad-hoc list of email addresses

		$emailtitle		= _MSNL_ADM_SEND_LAB_NLFROM." ".$sitename;
		
		$msnl_sEmailaddresses		= str_replace( " ", "", $msnl_sEmailaddresses );

		$msnl_asEmailaddresses	= explode( ",", $msnl_sEmailaddresses );
		
		foreach ( $msnl_asEmailaddresses as $user_email ) { //Cycle through each ad-hoc email address

			msnl_fDebugMsg( $user_email );

			if ( $msnl_gasModCfg['debug_mode'] != MSNL_VERBOSE ) {  //Do not mail if in verbose debug mode

				if ( !@mail( $user_email, $emailtitle, $emailfile, $headers ) ) { //Mail and test if successful

					msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_MAIL." ".$user_email );	//MSNL_010301_02

				}

			} //End IF check to see if in VERBOSE debug mode
			
		} //End foreach

		return 1;

	} else { //Actually sending to a selected list of recipients

		$result				= msnl_fSQLCall( $sql );
		$numofusers		= $db->sql_numrows( $result );
		$numofusers		= intval( $numofusers );

		if ( $numofusers > MSNL_MAX_BATCH_SIZE ) {

			echo "<p><b>"._MSNL_ADM_SEND_MSG_TOTALSENT ."</b>: $numofusers</p>\n"
					."<p><b>". _MSNL_ADM_SEND_MSG_LOTSSENT ."</b></p>\n";

		} else {

			echo "<p><b>"._MSNL_ADM_SEND_MSG_TOTALSENT ."</b>: $numofusers</p>\n";

		}

		$emailtitle		= _MSNL_ADM_SEND_LAB_NLFROM." ".$sitename;  //MSNL_010301_02

		$prev_user_id = 1;

		while( $row = $db->sql_fetchrow( $result ) ) { //Cycle through the recipients and send

			$user_id			= intval( $row['user_id'] );

			$user_email		= stripslashes( $row['user_email'] );

			$prev_user_id = $user_id;

			msnl_fDebugMsg( $user_email );

			if ( $msnl_gasModCfg['debug_mode'] != MSNL_VERBOSE ) {  //Do not mail if in verbose debug mode

				if ( !@mail( $user_email, $emailtitle, $emailfile, $headers ) ) { //Mail and test if successful

					msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_MAIL." ".$user_email );	//MSNL_010301_02

				}

			} //End IF check to see if in VERBOSE debug mode

		} //End while mail loop

		return $prev_user_id;

	}  //End of Test of Send Type

} //End of Function msnl_fSendNls()

/************************************************************************
* Function:		msnl_fGetCategories
* Inputs:			$iCatID		= the default category to have selected in the list.
* 						$iInclAll	= 1, if should also include the *show ALL* option
* 												0, otherwise
* Returns:		$sHTML		= of HTML for the SELECT object.
* Usage:			Builds an HTML SELECT object of newsletter categories.  If
* 						passed a Category ID, then it will have that option selected.
************************************************************************/

function msnl_fGetCategories( $iCatID=0, $iInclAll=MSNL_SHOW_ALL_OFF ) {

	global $prefix, $db;

	$sql		= "SELECT `cid`, `ctitle` FROM `".$prefix."_hnl_categories` ORDER BY `ctitle`";

	$result	= msnl_fSQLCall( $sql );

	if ( !$result ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_COM_ERR_DBGETCATS );	

	} else { //Successful SQL call

		//Setup the SELECT object

		$sHTML	= "<select name=\"msnl_cid\">\n";
		
		if ( $iInclAll == MSNL_SHOW_ALL_ON ) { //Include the *Show ALL* option
		
			$sHTML	.= "<option value=\"0\"";

			if ( $iCatID == 0 ) {

				$sHTML	.= " SELECTED";

			}

			$sHTML	.= ">". _MSNL_COM_LAB_SHOW_ALL ."</option>\n";
		
		} //End IF to show ALL option or not.

		//Now build the options

		while (	$row = $db->sql_fetchrow( $result ) ) { 

			$iLstCID		= intval( $row['cid'] );
			$sLstTitle	= stripslashes( $row['ctitle'] );

			$sHTML		.= "<option value=\"". $iLstCID ."\"";

			if ( $iLstCID == $iCatID ) {

				$sHTML	.= " SELECTED";

			}

			$sHTML		.= ">$sLstTitle</option>\n";

		} //End while

		//Close the SELECT object

		$sHTML		.= "</select>\n";

	} //End IF for bad SQL call check
	
	return $sHTML;

} //End of Function msnl_fGetCategories()

/************************************************************************
* Function:	msnl_fShowBtnAdd
* Inputs:		$sOP	= the operation to perform for a given form.
* Usage:		Shows the ADD Button.
************************************************************************/

function msnl_fShowBtnAdd( $sOP ) {

	global $msnl_asCSS;

	echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
				."<input type='button' value='". _MSNL_COM_LAB_ADD ."' title='"._MSNL_COM_LNK_ADD."' onclick=\"javascript:msnl_FormHandler('$sOP');\">\n"
			."</p>\n";

} //End of function msnl_fShowBtnAdd()

/************************************************************************
* Function:	msnl_fShowBtnSave
* Inputs:		$sOP	= the operation to perform for a given form.
* Usage:		Shows the SAVE Button.
************************************************************************/

function msnl_fShowBtnSave( $sOP ) {

	global $msnl_asCSS;

	echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
				."<input type='button' value='". _MSNL_COM_LAB_SAVE ."' title='"._MSNL_COM_LNK_SAVE."' onclick=\"javascript:msnl_FormHandler('$sOP');\">\n"
			."</p>\n";

} //End of function msnl_fShowBtnSave()

/************************************************************************
* Function:	msnl_fGrpsExplode
* Inputs:		$sGroups	= the string of groups separated by dashes.
* Returns:	$saGroups	= an array of group numbers.
* Usage:		To explore out a string of NSN Groups to an array.
************************************************************************/

function msnl_fGrpsExplode( $sGroups ) {

	$asNSNGroups	= array();
	
	$asNSNGroups	= explode( "-", $sGroups );
	
	return $asNSNGroups;

} //End of function msnl_fGrpsExplode()

/************************************************************************
* Function:	msnl_fGrpsImplode
* Inputs:		$asGroups	= the array of NSN groups.
* Returns:	$sGroups	= a string with the groups separated with a dash.
* Usage:		To implode an array of NSN Group numbers into a string with
* 					each group number separated with a dash.
************************************************************************/

function msnl_fGrpsImplode( $asGroups ) {

	$sGroups = "";
	
	sort( $asGroups );

	$j = count( $asGroups );

	for ( $i=0; $i < $j; $i++ ) {

		if ( $sGroups != "" ) {

			$sGroups .= "-";

		}

		$sGroups .= $asGroups[$i];

	}
	
	return $sGroups;

} //End of function msnl_fGrpsImplode()

?>