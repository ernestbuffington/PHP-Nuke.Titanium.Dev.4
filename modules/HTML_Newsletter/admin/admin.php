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

msnl_fShowSubTitle( _MSNL_LAB_CREATENL );
msnl_fShowHelpLegend();

/************************************************************************
* Get the sponsor banners HTML - placed here to ensure any issues are 
* addressed up-front.
************************************************************************/

msnl_fDebugMsg( "Start of Build Banner HTML" );

$msnl_asHTML['BANNERS']	= "";

$sql			= "SELECT `bid`, `imageurl`, `clickurl`, `alttext` FROM `"
					.$prefix."_banner`";

$result		= msnl_fSQLCall( $sql );

if ( !$result ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_ADM_ERR_DBGETBANNERS );	

} else { //Successful SQL call

		while (	$row = $db->sql_fetchrow( $result ) ) { 

			$msnl_asRec['bid']				= intval( $row['bid'] );
			$msnl_asRec['imageurl']		= stripslashes( $row['imageurl'] );
			$msnl_asRec['clickurl']		= stripslashes( $row['clickurl'] );
			$msnl_asRec['alttext']		= stripslashes( $row['alttext'] );

			$msnl_asHTML['BANNERS']	.= "<input type=\"radio\" name=\"msnl_banner\" value=\""
																	.$msnl_asRec['bid']."\"";

			if ( $_POST['msnl_banner'] == $msnl_asRec['bid'] ) {

				$msnl_asHTML['BANNERS']	.= " CHECKED";

			}

			$msnl_asHTML['BANNERS']	.= " />\n"
					."<a href=\"".$msnl_asRec['clickurl']."\">"
					."<img ${msnl_asCSS['IMG_def']} src=\"".$msnl_asRec['imageurl']."\" alt=\"".$msnl_asRec['alttext']."\">"
					."</a><br /><br />\n";

		} //End While for getting sponsor banners HTML

} //End IF of SQL call check

/************************************************************************
* Get both the Send To options and NSN Groups if it is active
************************************************************************/

msnl_fDebugMsg( "Start of Build SENDTO HTML" );

$msnl_asHTML['SENDTO']	= msnl_fGetSendTo();

msnl_fDebugMsg( "Start of Build NSNGRPS HTML" );

$msnl_asHTML['NSNGRPS']	= msnl_fGetNSNGroups();

/************************************************************************
* Set up form and display main Letter options such as Topic, Sender, 
* Categories and Body Text.
************************************************************************/

echo "\n<form method=\"post\" action=\"$admin_file.php\" name=\"msnl_frm\">\n";
echo "<div id=\"msnl_div_init\">\n";
echo "<input type='hidden' name='op' value='msnl_admin'>";
echo "</div>\n";

echo "<div id='msnl_div_letter'>\n";

opentable();

echo "<p><strong>"._MSNL_ADM_LAB_LETTER."</strong></p>\n";

echo "<table border=\"1\" width=\"100%\">\n";

//Topic - Newsletter topic text

if ( isset( $_POST['msnl_topic'] ) ) {

	$msnl_sTopic	= str_replace( "\"", "&quot;", stripslashes( $_POST['msnl_topic'] ) );

} else {

	$msnl_sTopic	= "";
	
}

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_TOPIC, _MSNL_ADM_LAB_TOPIC )
				. _MSNL_ADM_LAB_TOPIC
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_topic\" size=\"40\" "
					."maxlength=\"50\" value=\"".$msnl_sTopic."\">\n"
			."</td></tr>\n";

//Sender - The friendly name of the sender of the newsletter.

if ( isset( $_POST['msnl_sender'] ) ) {

	$msnl_sSender	= str_replace( "\"", "&quot;", stripslashes( $_POST['msnl_sender'] ) );

} else {

	$msnl_sSender	= "";
	
}

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_SENDER, _MSNL_ADM_LAB_SENDER )
				. _MSNL_ADM_LAB_SENDER
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_sender\" size=\"30\" "
					."maxlength=\"50\" value=\"".$msnl_sSender."\">\n"
			."</td></tr>\n";

//Newsletter Category

echo "<tr ${msnl_asCSS['TR_top']}>\n"
			."<td>\n"
				.msnl_fShowHelp( _MSNL_ADM_HLP_NLSCAT, _MSNL_ADM_LAB_NLSCAT )
				._MSNL_ADM_LAB_NLSCAT.":&nbsp;"
			."</td>\n"
			."<td>\n";

echo msnl_fGetCategories( intval( $_POST['msnl_cid'] ), MSNL_SHOW_ALL_OFF );

echo "</td>\n"
			."</tr>\n";

//Newsletter Body

echo "<tr ${msnl_asCSS['TR_top']}>\n"
			."<td>\n"
				.msnl_fShowHelp( _MSNL_ADM_HLP_TEXTBODY, _MSNL_ADM_LAB_TEXTBODY )
				._MSNL_ADM_LAB_TEXTBODY.":&nbsp;"
			."</td>\n"
			."<td>"._MSNL_ADM_LAB_HTMLOK."</td>\n"
		."</tr>";

	echo "<tr ${msnl_asCSS['TR_top']}>\n";
	echo "<td colspan=\"2\">\n";
	//echo "<textarea name='msnl_textbody' cols='100' rows='".$msnl_gasModCfg['wysiwyg_rows']."'>";
	echo Make_TextArea('msnl_textbody', $_POST['msnl_textbody'], 'PHPNukeAdmin', '100%');
	//echo stripslashes( $_POST['msnl_textbody'] )."</textarea>\n";
	echo "</td>\n</tr>\n";
	echo "</table>\n";

//Close out this section

closetable();

echo "</div>\n";

/************************************************************************
* Display options list for the Templates
************************************************************************/

echo "<div id='msnl_div_templates'>\n";

echo "<br>";
opentable();

echo "<p><strong>"._MSNL_ADM_LAB_TEMPLATES."</strong></p>\n";

echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

echo "<tr ${msnl_asCSS['TR_top']}>\n"
			."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
				.msnl_fShowHelp( _MSNL_ADM_HLP_TEMPLATES, _MSNL_ADM_LAB_CHOOSETMPLT )
				. _MSNL_ADM_LAB_CHOOSETMPLT
				.":&nbsp;"
			."</td>\n"
			."<td></td>\n"
		."<tr ${msnl_asCSS['TR_top']}>\n"
			."<td ${msnl_asCSS['TD_left_nw']} colspan=\"2\">\n";

echo "<input type=\"radio\" name=\"msnl_template\" value=\"notemplate\"\n";

if ( $_POST['msnl_template'] == "notemplate" || $_POST['msnl_template'] == "" ) {

	echo " CHECKED";

}

echo ">&nbsp;No Template<br>\n";

//Write out list of template options based on the templates directory folder names

$msnl_sTmpltDir	= "./modules/$msnl_sModuleNm/templates/";

if ( @is_dir( $msnl_sTmpltDir ) ) { //First make sure the templates directory exists

	if ( $msnl_hDir1 = @opendir( $msnl_sTmpltDir ) ) {

		while ( ( $msnl_sFile = @readdir( $msnl_hDir1 ) ) !== false ) { //Continue until no more files exist

			if ( substr( $msnl_sFile, 0, 1 ) != "." && @is_dir( $msnl_sTmpltDir.$msnl_sFile ) ) { //Pick up only directories!

				$msnl_sFileNm = str_replace("_", " ", $msnl_sFile);

				echo "<input type=radio name=\"msnl_template\" value=\"$msnl_sFile\"";

				if ( $_POST['msnl_template'] == $msnl_sFile ) { //If option was already checked by the user

					echo " CHECKED";

				}

				echo ">&nbsp;$msnl_sFileNm&nbsp;";

				$msnl_sFileImg	= "./modules/$msnl_sModuleNm/templates/$msnl_sFile/ss.jpg";

				if ( @file_exists( $msnl_sFileImg ) ) {  //Display sample template image only if it exists

					echo "<a href=\"$msnl_sFileImg\" title=\"\" onclick=\"window.open(this.href, 'ViewSample'); return false\">"
								."<img ${msnl_asCSS['IMG_def']} src=\"./modules/$msnl_sModuleNm/images/view.png\" "
								."alt=\""._MSNL_ADM_LNK_SHOWTEMPLATE."\">"
							."</a>\n";

					echo "<br>\n";

				}

			} //End IF check to ignore certain file names

		} //End WHILE loop to cycle through the directory listing

		@closedir( $msnl_hDir1 );

	} //End IF on check of opening directory listing

} //End IF on check that the templates directory exists

echo "</td></tr>\n";

//Close out this section

echo "</table>\n";

closetable();

echo "</div>\n";

/************************************************************************
* Display options list for Statistics and TOC
************************************************************************/

echo "<div id='msnl_div_includes'>\n";

echo "<br>";
opentable();

echo "<p><strong>"._MSNL_ADM_LAB_STATS."</strong></p>\n";

echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

//Include Site Statistics

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_INCLSTATS, _MSNL_ADM_LAB_INCLSTATS )
				. _MSNL_ADM_LAB_INCLSTATS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type='checkbox' name='msnl_stats' value='yes'";

if ( $_POST['msnl_stats'] == "yes") { echo " CHECKED"; }

echo "></td></tr>\n";

//Include Table of Contents (TOC)

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_INCLTOC, _MSNL_ADM_LAB_INCLTOC )
				. _MSNL_ADM_LAB_INCLTOC
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type='checkbox' name='msnl_toc' value='yes'";

if ( $_POST['msnl_toc'] == "yes") { echo " CHECKED"; }

echo "></td></tr>\n";

//Close out this section

echo "</table>\n";

closetable();

echo "</div>\n";

/************************************************************************
* Display options list for what to include and how many
************************************************************************/

echo "<div id='msnl_div_latest'>\n";

echo "<br>";
opentable();

echo "<p><strong>"._MSNL_ADM_LAB_INCLLATEST."</strong></p>\n";

echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

//If user didn't enter values into the fields, default to last saved

if ( $_POST['msnl_news'] == "" ) {

	$_POST['msnl_news'] = $msnl_gasModCfg['latest_news'];

}

if ( $_POST['msnl_downloads'] == "" ) {

	$_POST['msnl_downloads'] = $msnl_gasModCfg['latest_downloads'];

}

if ( $_POST['msnl_weblinks'] == "" ) {

	$_POST['msnl_weblinks'] = $msnl_gasModCfg['latest_links'];

}

if ( $_POST['msnl_forums'] == "" ) {

	$_POST['msnl_forums'] = $msnl_gasModCfg['latest_forums'];

}

if ( $_POST['msnl_reviews'] == "" ) {

	$_POST['msnl_reviews'] = $msnl_gasModCfg['latest_reviews'];

}

//Latest News

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_INCLLATESTNEWS, _MSNL_ADM_LAB_INCLLATESTNEWS )
				. _MSNL_ADM_LAB_INCLLATESTNEWS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_news\" size=\"2\" "
					."maxlength=\"2\" value=\"".stripslashes( $_POST['msnl_news'] )."\">\n"
			."</td></tr>\n";

//Latest Downloads

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_INCLLATESTDLS, _MSNL_ADM_LAB_INCLLATESTDLS )
				. _MSNL_ADM_LAB_INCLLATESTDLS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_downloads\" size=\"2\" "
					."maxlength=\"2\" value=\"".stripslashes( $_POST['msnl_downloads'] )."\">\n"
			."</td></tr>\n";

//Latest Web Links

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_INCLLATESTWLS, _MSNL_ADM_LAB_INCLLATESTWLS )
				. _MSNL_ADM_LAB_INCLLATESTWLS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_weblinks\" size=\"2\" "
					."maxlength=\"2\" value=\"".stripslashes( $_POST['msnl_weblinks'] )."\">\n"
			."</td></tr>\n";

//Latest Web Links

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_INCLLATESTFORS, _MSNL_ADM_LAB_INCLLATESTFORS )
				. _MSNL_ADM_LAB_INCLLATESTFORS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_forums\" size=\"2\" "
					."maxlength=\"2\" value=\"".stripslashes( $_POST['msnl_forums'] )."\">\n"
			."</td></tr>\n";

//Latest Reviews

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_ADM_HLP_INCLLATESTREVS, _MSNL_ADM_LAB_INCLLATESTREVS )
				. _MSNL_ADM_LAB_INCLLATESTREVS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_reviews\" size=\"2\" "
					."maxlength=\"2\" value=\"".stripslashes( $_POST['msnl_reviews'] )."\">\n"
			."</td></tr>\n";

//Close out this section

echo "</table>\n";

closetable();

echo "</div>\n";

/************************************************************************
* Display options list for Site Sponsors
************************************************************************/

echo "<div id='msnl_div_sponsors'>\n";

echo "<br>";
opentable();

echo "<p><strong>"._MSNL_ADM_LAB_SPONSORS."</strong></p>\n";

echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

echo "<tr ${msnl_asCSS['TR_top']}>\n"
			."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
				.msnl_fShowHelp( _MSNL_ADM_HLP_CHOOSESPONSOR, _MSNL_ADM_LAB_CHOOSESPONSOR )
				. _MSNL_ADM_LAB_CHOOSESPONSOR
				.":&nbsp;"
			."</td>\n"
			."<td></td>\n"
		."<tr ${msnl_asCSS['TR_top']}>\n"
			."<td ${msnl_asCSS['TD_left_nw']} colspan=\"2\">\n"
				."<input type=\"radio\" name=\"msnl_banner\" value=\"0\"";

if ( !isset( $_POST['msnl_banner'] ) || $_POST['msnl_banner'] == "" || $_POST['msnl_banner'] == 0 ) {

	echo " CHECKED";

}

echo " />"._MSNL_ADM_LAB_NOSPONSOR."<br /><br />\n";

echo $msnl_asHTML['BANNERS'];

//Close out this section

echo "</td></tr></table>\n";

closetable();

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
* Show the list of valid Submit options and close out the page
************************************************************************/

echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
				."<input type=\"hidden\" name=\"msnl_op\" value=\"hnladm\">\n"
				."<input name=\"msnl_action\" type=\"button\" value=\"". _MSNL_COM_LAB_PREVIEW ."\" title=\""._MSNL_COM_LNK_PREVIEW."\" "
					."onclick=\"javascript:msnl_FormHandler('msnl_admin_preview');\">\n"
				."<input name=\"msnl_action\" type=\"button\" value=\"". _MSNL_COM_LAB_SEND ."\" title=\""._MSNL_COM_LNK_SEND."\" "
					."onclick=\"javascript:msnl_FormHandler('msnl_admin_send_mail');\">\n";

/************************************************************************
* Close up the form and page
************************************************************************/

echo "</form>\n";

closetable();

//Make pop-up HELP available to the page
echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";

?>