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

msnl_fShowSubTitle( _MSNL_ADM_PREV_LAB_VALPREVNL );

/************************************************************************
* Check for user input errors
************************************************************************/

@include_once( "modules/$msnl_sModuleNm/admin/admin_check_post.php" );

if ( sizeof( $msnl_asERR ) == 0 ) { //Had no validation errors so make the NL and provide the link

	//Make the temporary newsletter file

	@include_once( "modules/$msnl_sModuleNm/admin/admin_make_nls.php" );

	$msnl_sTmpFile = "./modules/$msnl_sModuleNm/archive/tmp.php";

	@touch( $msnl_sTmpFile );

	@chmod( $msnl_sTmpFile, 0766 );

	$msnl_hFile1 = @fopen( $msnl_sTmpFile, "w" );

	@fwrite( $msnl_hFile1, $msnl_sNewsletter );

	@fclose( $msnl_hFile1 );

	//Provide a link to the just created newsletter file

	$msnl_sURL	= "./modules.php?name=".$msnl_sModuleNm."&amp;op=msnl_nls_view&amp;msnl_nid=1";

	echo "<div id=\"msnl_div_preview\">\n"
				."<b>"._MSNL_ADM_PREV_MSG_SUCCESS."</b><br /><br />\n"
				."<a href=\"$msnl_sURL\" title=\""._MSNL_NLS_LNK_VIEWNL."\" "
					."onclick=\"window.open(this.href, 'ViewNewsletter'); return false\">"
					._MSNL_ADM_PREV_LAB_PREVNL
				."</a>\n"
			."</div>\n";

} else {	//Had validation errors so show them

	msnl_fShowValErr();

}  //End IF for error check

/************************************************************************
* Reset all the POST variables so do not lose what the user input was 
* upon returning back to the Create Newsletter screen.
************************************************************************/

$msnl_sGroups	= msnl_fGrpsImplode( $msnl_nsngroupid );

msnl_fDebugMsg( "msnl_sGroups = $msnl_sGroups" );

$msnl_sTopic	= str_replace( "\"", "&quot;", stripslashes( $_POST['msnl_topic'] ) );

msnl_fDebugMsg( "msnl_sTopic = $msnl_sTopic" );

$msnl_sSender	= $_POST['msnl_sender'];

msnl_fDebugMsg( "msnl_sSender = $msnl_sSender" );

$msnl_sTextBody	= str_replace( "\"", "&quot;", stripslashes( $_POST['msnl_textbody'] ) );

msnl_fDebugMsg( "msnl_sTextBody = $msnl_sTextBody" );

echo "\n<form method=\"post\" action=\"$admin_file.php\" name=\"msnl_frm\">\n";
echo "<div id=\"msnl_div_resetvars\">\n";
echo "<input type=\"hidden\" name=\"op\" value=\"msnl_admin\">\n";
echo "<input type=\"hidden\" name=\"msnl_banner\" value=\"".$_POST['msnl_banner']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_cid\" value=\"".$_POST['msnl_cid']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_downloads\" value=\"".$_POST['msnl_downloads']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_forums\" value=\"".$_POST['msnl_forums']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_news\" value=\"".$_POST['msnl_news']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_nsngroups\" value=\"".$msnl_sGroups."\">\n";
echo "<input type=\"hidden\" name=\"msnl_reviews\" value=\"".$_POST['msnl_reviews']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_sendemail\" value=\"".$_POST['msnl_sendemail']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_sender\" value=\"".$msnl_sSender."\">\n";
echo "<input type=\"hidden\" name=\"msnl_stats\" value=\"".$_POST['msnl_stats']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_template\" value=\"".$_POST['msnl_template']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_textbody\" value=\"".$msnl_sTextBody."\">\n";
echo "<input type=\"hidden\" name=\"msnl_toc\" value=\"".$_POST['msnl_toc']."\">\n";
echo "<input type=\"hidden\" name=\"msnl_topic\" value=\"".$msnl_sTopic."\">\n";
echo "<input type=\"hidden\" name=\"msnl_weblinks\" value=\"".$_POST['msnl_weblinks']."\">\n";
echo "</div>\n";

/************************************************************************
* Display the GO BACK button that is really a submit button for the form
************************************************************************/

echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
			."<input type=\"submit\" value=\""._MSNL_COM_LAB_GOBACK."\">\n"
		."</p>\n";

/************************************************************************
* Close up the page
************************************************************************/

echo "</form>\n";

closetable();

?>