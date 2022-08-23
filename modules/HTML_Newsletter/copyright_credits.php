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

//For Copyright:

$msnl_sAuthorNm				= "Rob Herder (aka: montego)";
$msnl_sAuthorEmail		= "montego _(at)_ montegoscripts {DOT} com";
$msnl_sAuthorURL 			= "http://montegoscripts.com";
$msnl_sDocsURL				= "http://wiki.montegoscripts.com";
$msnl_sLicense				= "GNU/GPL - Provided with Download";
$msnl_sDownloadURL		= "http://montegoscripts.com/downloads-cat9.html";
$msnl_sDocsURL				= "http://wiki.montegoscripts.com";
$msnl_sModDesc				= "Allows a Nuke site admin to send out HTML "
												."formatted newsletters plus an extensive archiving system. "
												."Visit <a href=\"http://montegoscripts.com\" "
												."title=\"Home of the HTML Newsletter for PHP-Nuke\">"
												."Montego Scripts</a> for a full list of features.";

//For Credits:

$msnl_sOrigAuth				= "The original 1.0 version was written by <b>mangaman</b> from "
											. "<a href=\"http://www.nukeworks.biz\" title=\"\"> NukeWorks</a>. "
											. "It looks as though it was based on the original PHP-Nuke Newsletter "
											. "module as well as had some concepts from Fancy Newsletter, but not "
											. "100% sure on that.";
$msnl_sCurrAuth				= "<b>montego</b> from <a href=\"http://montegoscripts.com\" "
											. "title=\"Home of the HTML Newsletter for PHP-Nuke\">"
											. "Montego Scripts</a> is the current author.";
$msnl_sTranslations		= "The following translations were done for version 1.3:<br /><br />"
											. "<b>German</b>: Marco Wiesler from <a href=\"http://www.warp-speed.de\" "
												."title=\"http://www.warp-speed.de\">"
												."http://www.warp-speed.de</a>.<br /><br />"
											. "<b>Persian</b>: Izone from <a href=\"http://www.iranyad.com\" "
												."title=\"http://www.iranyad.com\">"
												."http://www.iranyad.com</a>.<br /><br />"
											. "<b>Spanish</b>: (in progress) kenspa from <a href=\"http://www.amercham.com/kenspa/\" "
												."title=\"http://www.amercham.com/kenspa/\">"
												."http://www.amercham.com/kenspa/</a>.<br /><br />"
											. "As new translations come available, this text will be "
											. "updated with the appropriate credits and released as a separate "
											. "update and download as well as included in the main download pack.";
$msnl_sOther					= "Additional thanks go to the following people for their help along the "
											. "way:<br /><br />"
											. "<b>Raven</b> from <a href=\"http://ravenphpscripts.com\" "
												."title=\"PHP Web Host - Quality Web Hosting and Scripts\">"
												."http://ravenphpscripts.com</a> for his excellent support "
												."site, excellent web hosting and encouragement along the way.<br /><br />"
											. "<b>Guardian</b> from <a href=\"http://www.code-authors.com\" "
											  ."title=\"http://www.code-authors.com\">"
											  ."http://www.code-authors.com</a> "
											  ."for his constant nagging ( LOL ) for new releases, a few "
											  ."bug fixes, for his help in testing, helping to keep an eye "
											  ."on the support forums, and as a contributing editor to the "
											  ."on-line documentation!<br /><br />"
											. "<b>Kguske</b> from <a href=\"http://nukeseo.com\" "
											  ."title=\"http://nukeseo.com\">"
											  ."http://nukeSEO.com</a> "
											  ."for his excellent integration of the FCKEditor into PHP-Nuke "
											  ."by way of his tool nukeWYSIWYG!<br /><br />"
											. "<b>Izone</b> from <a href=\"http://www.iranyad.com\" "
											  ."title=\"www.iranyad.com\">"
											  ."http://www.iranyad.com</a> "
											  ."for his modifications to the base distribution to make the "
											  ."module pages and templates display properly in the Persian "
											  ."language.";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

/************************************************************************
* Start displaying copyright and credit information
************************************************************************/

@include( "header.php" );

$msnl_giHeadersSent	= 1;
msnl_fPrintHTML( "BEGIN" );
@require_once( "./modules/$msnl_sModuleNm/javascript.php" );

echo "<div id='msnl_div_title'>\n";

opentable();

echo "\n<p ${msnl_asCSS['BLOCK_center']}>\n"
				."<span class='title'>"
					._MSNL_CPY_LAB_COPYTITLE
				."</span><br />\n"
				.str_replace( "_", " ", $msnl_sModuleNm ) . "&nbsp;" ._MSNL_CPY_LAB_MODULEFOR
					." <a href=\"http://phpnuke.org\" title=\""._MSNL_CPY_LNK_PHPNUKE."\">PHP-Nuke</a><br /><br />\n"
			."</p>\n";

closetable();

echo "<br /></div>\n";

/************************************************************************
* Show details of the copyright information 
************************************************************************/

echo "<div id='msnl_div_copy'>\n";

opentable();

msnl_fShowSubTitle( _MSNL_CPY_LAB_COPY );

echo "\n<div>\n"
			."<table ${msnl_asCSS['TABLE_adm']}>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_MODNAME.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						.str_replace( "_", " ", $msnl_sModuleNm )."\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_MODVER.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						.$msnl_gasModCfg['version']."\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_MODDESC.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						."$msnl_sModDesc\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_LICENSE.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						."$msnl_sLicense\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_AUTHORNM.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						."$msnl_sAuthorNm\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_AUTHOREMAIL.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						."$msnl_sAuthorEmail\n"
					."</td>\n"
				."</tr>\n"
			."</table>\n"
			."<p  ${msnl_asCSS['BLOCK_center']}>\n"
				."[ <a href=\"$msnl_sAuthorURL\" title=\""._MSNL_CPY_LNK_AUTHORHOME."\">"
					._MSNL_CPY_LAB_AUTHORWEB."</a>\n"
				."| <a href=\"$msnl_sDownloadURL\" title=\""._MSNL_CPY_LNK_DOWNLOAD."\">"
					._MSNL_CPY_LAB_MODDL."</a>\n"
				."| <a href=\"$msnl_sDocsURL\" title=\""._MSNL_CPY_LNK_DOCS."\">"
					._MSNL_CPY_LAB_DOCS."</a>\n"
				."]\n"
			."</p>\n"
			."<br />\n"
		."</div>\n";

closetable();

echo "<br /></div>\n";

/************************************************************************
* Show details of the credit information 
************************************************************************/

echo "<div id='msnl_div_credit'>\n";

opentable();

msnl_fShowSubTitle( _MSNL_CPY_LAB_CREDITS );

echo "\n<div>\n"
			."<table ${msnl_asCSS['TABLE_adm']}>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_ORIGAUTHOR.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						.$msnl_sOrigAuth."\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_CURRENTAUTHOR.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						.$msnl_sCurrAuth."\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_TRANSLATIONS.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						.$msnl_sTranslations."\n"
					."</td>\n"
				."</tr>\n"
				."<tr ${msnl_asCSS['TR_top']}>\n"
					."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
						."<img src=\"./images/arrow.gif\" ${msnl_asCSS['IMG_def']} alt=\"\">\n"
							."&nbsp;<b>"._MSNL_CPY_LAB_OTHER.":&nbsp;</b>"
					."</td>"
					."<td>\n"
						.$msnl_sOther."\n"
					."</td>\n"
				."</tr>\n"
			."</table>\n"
		."</div>\n";

closetable();

echo "<br /></div>\n";

msnl_fShowBtnGoBack();

msnl_fPrintHTML("END");

@include( "footer.php" );

?>