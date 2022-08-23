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

define('MSNL_SENDTESTED', true);

/************************************************************************
* Are we processing the SendMail or are we getting the admin's options?
************************************************************************/

if ( $_POST['msnl_sendemail'] != "" ) {  //We are sending the testemail out

	@include_once( "modules/$msnl_sModuleNm/admin/admin_send_mail.php" );

} else {  //We are displaying the options to the user for sending the tested email out

	opentable();

	msnl_fShowSubTitle( _MSNL_LAB_SENDTESTED );
	msnl_fShowHelpLegend();

	/************************************************************************
	* Provide a link to the Admin to the Tested Newsletter in case they
	* wish to verify what they will be sending.
	************************************************************************/

	$msnl_sURL	= "./modules.php?name=".$msnl_sModuleNm."&amp;op=msnl_nls_view&amp;msnl_nid=2";

	echo "<div id=\"msnl_div_preview\">\n"
				."<a href=\"$msnl_sURL\" title=\""._MSNL_NLS_LNK_VIEWNL."\" "
					."onclick=\"window.open(this.href, 'ViewNewsletter'); return false\">"
					._MSNL_ADM_TEST_LAB_PREVNL
				."</a>\n"
			."</div>\n";

	/************************************************************************
	* Get both the Send To options and NSN Groups if it is active
	************************************************************************/

	msnl_fDebugMsg( "Start of Build SENDTO HTML" );

	$msnl_asHTML['SENDTO']	= msnl_fGetSendTo();

	msnl_fDebugMsg( "Start of Build NSNGRPS HTML" );

	$msnl_asHTML['NSNGRPS']	= msnl_fGetNSNGroups();

	/************************************************************************
	* Set up form and display the Send Tested options
	************************************************************************/

	echo "\n<form method=\"post\" action=\"$admin_file.php\" name=\"msnl_frm\">\n";
	echo "<div id=\"msnl_div_init\">\n";
	echo "<input type='hidden' name='op' value='msnl_admin_send_tested'>";
	echo "</div>\n";

	/************************************************************************
	* Display options list for who to send the newsletter to
	************************************************************************/

	echo $msnl_asHTML['SENDTO'];

	/************************************************************************
	* If NSN Groups are to be used, then list the groups in a new section
	************************************************************************/

	echo $msnl_asHTML['NSNGRPS'];

	/************************************************************************
	* Show the GO Button
	************************************************************************/

	echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
					."<input type=hidden name=msnl_op value=\"hnltst\">\n"
					."<input type=submit value=\"". _MSNL_COM_LAB_SEND ."\" title='"._MSNL_COM_LNK_SEND."'>\n"
			."</p>\n";

	echo "</form>\n";

	closetable();

	//Make pop-up HELP available to the page
	echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";
	
} //End IF check if sending out the test email.

?>