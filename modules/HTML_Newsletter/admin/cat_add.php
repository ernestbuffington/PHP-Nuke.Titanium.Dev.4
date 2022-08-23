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

/************************************************************************
* FORM variable validation and cleansing
************************************************************************/

/************************************************************************
* Write out the page title, table headers, and set up the input form.
************************************************************************/

opentable();

msnl_fShowSubTitle( _MSNL_CAT_ADD_LAB_CATADD );

echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
echo "<div id='msnl_div_init'>\n";
echo "<input type='hidden' name='op' value='msnl_cat'>";
echo "</div>\n";

/************************************************************************
* Write out the category information data entry fields.
************************************************************************/

echo "<div id='msnl_div_main'>";
echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

//Category Title

echo "<tr ${msnl_asCSS['TR_top']}>\n"
			."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
				.msnl_fShowHelp( _MSNL_CAT_HLP_CATTITLE, _MSNL_CAT_LAB_CATTITLE )
				._MSNL_CAT_LAB_CATTITLE.":&nbsp;"
			."</td>\n"
			."<td>\n"
				."<input type='text' name='msnl_ctitle' size='50' maxlength='50' "
					."value=\"\">\n"
			."</td>\n"
		."</tr>\n";
			
//Category Description

echo "<tr ${msnl_asCSS['TR_top']}>\n"
			."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
				.msnl_fShowHelp( _MSNL_CAT_HLP_CATDESC, _MSNL_CAT_LAB_CATDESC )
				._MSNL_CAT_LAB_CATDESC.":&nbsp;"
			."</td>\n"
			."<td>\n"
				."<textarea name='msnl_cdescription' cols='50' rows='10'>"
				."</textarea>\n"
			."</td>\n"
		."</tr>\n";

//Block Limit

echo "<tr ${msnl_asCSS['TR_top']}>\n"
			."<td ${msnl_asCSS['TD_hdr_adm']}>\n"
				.msnl_fShowHelp( _MSNL_CAT_HLP_CATBLOCKLMT.MSNL_DEFAULT_BLOCKLMT."</b>.", 
							_MSNL_CAT_LAB_CATBLOCKLMT )
				._MSNL_CAT_LAB_CATBLOCKLMT.":&nbsp;"
			."</td>\n"
			."<td>\n"
				."<input type=\"text\" name=\"msnl_cblocklimit\" size=\"2\" "
					."maxlength=\"4\" value=\"\">\n"
			."</td>\n"
		."</tr>\n";

//End of form fields

echo "</table>\n</div>\n";
			
/************************************************************************
* Close up the Form and the web page.
************************************************************************/

msnl_fShowBtnAdd( 'msnl_cat_add_apply' );

echo "</form>\n";

closetable();

//Make pop-up HELP available to the page
echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";
//Set the focus on the desired form field
echo "<script type='text/javascript'>msnl_ObjFocus('msnl_ctitle');</script>\n";

?>