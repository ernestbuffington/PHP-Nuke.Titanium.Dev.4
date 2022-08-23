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

msnl_fShowSubTitle( _MSNL_CFG_LAB_MAINCFG );
msnl_fShowHelpLegend();

echo "\n<form method=\"post\" action=\"$admin_file.php\" name=\"msnl_frm\">\n";
echo "<div id=\"msnl_div_init\">\n";
echo "<input type='hidden' name='op' value='msnl_cfg_apply'>";
echo "</div>\n";

/************************************************************************
* Module Options section of configuration options
************************************************************************/

echo "<div id='msnl_div_module'>\n";

opentable();

echo "<p><strong>"._MSNL_CFG_LAB_MODULEOPT."</strong></p>\n";

echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

//Debug Mode - OFF = no debug messaging at all; ERROR = only msg upon an error; VERBOSE = msg on everything!

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				. msnl_fShowHelp( _MSNL_CFG_HLP_DEBUGMODE, _MSNL_CFG_LAB_DEBUGMODE )
				. _MSNL_CFG_LAB_DEBUGMODE
				.":&nbsp;"
			."</td>"
			."<td>"
				."&nbsp;<select name='msnl_debug_mode'>";
			
echo "<option value='".MSNL_OFF."'";
if ( $msnl_gasModCfg['debug_mode'] == MSNL_OFF ) { echo " SELECTED"; }
echo ">"._MSNL_CFG_LAB_DEBUGMODE_OFF."</option>\n";

echo "<option value='".MSNL_ERROR."'";
if ( $msnl_gasModCfg['debug_mode'] == MSNL_ERROR ) { echo " SELECTED"; }
echo ">"._MSNL_CFG_LAB_DEBUGMODE_ERR."</option>\n";

echo "<option value='".MSNL_VERBOSE."'";
if ( $msnl_gasModCfg['debug_mode'] == MSNL_VERBOSE ) { echo " SELECTED"; }
echo ">"._MSNL_CFG_LAB_DEBUGMODE_VER."</option>\n";

echo "</select></td></tr>\n";

//Debug Output - DISPLAY = output debug statements to the browser; 
//LOGFILE = output to a log file (not implemented yet)

/* TBD: Need to write the LOGFILE option as yet so comment this out for now
echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_DEBUGOUTPUT, _MSNL_CFG_LAB_DEBUGOUTPUT )
				. _MSNL_CFG_LAB_DEBUGOUTPUT
				.":&nbsp;"
			."</td>"
			."<td>"
				."&nbsp;<select name='msnl_debug_output'>";
			
echo "<option value='".MSNL_DISPLAY."'";
if ( $msnl_gasModCfg['debug_output'] == MSNL_DISPLAY ) { echo " SELECTED"; }
echo ">"._MSNL_CFG_LAB_DEBUGOUTPUT_DIS."</option>\n";

echo "<option value='".MSNL_LOGFILE."'";
if ( $msnl_gasModCfg['debug_output'] == MSNL_LOGFILE ) { echo " SELECTED"; }
echo ">"._MSNL_CFG_LAB_DEBUGOUTPUT_LOG."</option>\n";

echo "<option value='".MSNL_BOTH."'";
if ( $msnl_gasModCfg['debug_output'] == MSNL_BOTH ) { echo " SELECTED"; }
echo ">"._MSNL_CFG_LAB_DEBUGOUTPUT_BTH."</option>\n";

echo "</select></td></tr>\n";
*/

//Show Blocks - 1 = show right-hand blocks; 0 = hide right-hand blocks

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_SHOWBLOCKS, _MSNL_CFG_LAB_SHOWBLOCKS )
				. _MSNL_CFG_LAB_SHOWBLOCKS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type='checkbox' name='msnl_show_blocks' value='YES'";

if ( $msnl_gasModCfg['show_blocks'] == "1") { echo " CHECKED"; }

echo "></td></tr>\n";

//Use NSN Groups - 1 = use NSN Groups; 0 = Do not use NSN Groups and/or NSN Groups is not installed

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_NSNGRPS, _MSNL_CFG_LAB_NSNGRPS )
				. _MSNL_CFG_LAB_NSNGRPS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type='checkbox' name='msnl_nsn_groups' value='YES'";

if ( $msnl_gasModCfg['nsn_groups'] == "1") { echo " CHECKED"; }

echo "></td></tr>\n";

//Download Module name - most download modules model after the core nuke tables, but can have
//a different table subfix.  E.g., NSN Groups uses nsngd instead of downloads

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_DLMODULE, _MSNL_CFG_LAB_DLMODULE )
				. _MSNL_CFG_LAB_DLMODULE
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_dl_module\" size=\"50\" "
					."maxlength=\"50\" value=\"".$msnl_gasModCfg['dl_module']."\">\n"
			."</td></tr>\n";

//Use nukeWYSIWYG - 1 = use nukeWYSIWYG; 0 = Do not use nukeWYSIWYG and/or NSN Groups is not installed

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_WYSIWYGON, _MSNL_CFG_LAB_WYSIWYGON )
				. _MSNL_CFG_LAB_WYSIWYGON
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type='checkbox' name='msnl_wysiwyg_on' value='YES'";

if ( $msnl_gasModCfg['wysiwyg_on'] == "1") { echo " CHECKED"; }

echo "></td></tr>\n";

//Number of rows to Show for Textbody Content

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_WYSIWYGROWS, _MSNL_CFG_LAB_WYSIWYGROWS )
				. _MSNL_CFG_LAB_WYSIWYGROWS
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_wysiwyg_rows\" size=\"2\" "
					."maxlength=\"2\" value=\"".$msnl_gasModCfg['wysiwyg_rows']."\">\n"
			."</td></tr>\n";

//Close out this section

echo "</table>\n";

closetable();

echo "</div>\n";

/************************************************************************
* Show Options section of configuration options
************************************************************************/

echo "<div id='msnl_div_show'>\n";

echo "<br>";
opentable();

echo "<p><strong>"._MSNL_CFG_LAB_SHOWOPT."</strong></p>\n";

echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

//Show Categories - Checked will show newsletter categories in block - Archives always show categories

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				. msnl_fShowHelp( _MSNL_CFG_HLP_SHOWCATS, _MSNL_CFG_LAB_SHOWCATS )
				. _MSNL_CFG_LAB_SHOWCATS
				.":&nbsp;"
			."</td>"
			."<td>"
				."&nbsp;<input type=\"checkbox\" name=\"msnl_show_categories\" value=\"1\"";
				
if ( $msnl_gasModCfg['show_categories'] == "1" ) { echo " CHECKED"; }

echo "></td></tr>\n";

//Show Hits - Checked will show newsletter hits in block and in archives

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				. msnl_fShowHelp( _MSNL_CFG_HLP_SHOWHITS, _MSNL_CFG_LAB_SHOWHITS )
				. _MSNL_CFG_LAB_SHOWHITS
				.":&nbsp;"
			."</td>"
			."<td>"
				."&nbsp;<input type=\"checkbox\" name=\"msnl_show_hits\" value=\"1\"";
				
if ( $msnl_gasModCfg['show_hits'] == "1" ) { echo " CHECKED"; }

echo "></td></tr>\n";

//Show Dates Sent - Checked will show the date a newsletter was sent on in both block and archives

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				. msnl_fShowHelp( _MSNL_CFG_HLP_SHOWDATES, _MSNL_CFG_LAB_SHOWDATES )
				. _MSNL_CFG_LAB_SHOWDATES
				.":&nbsp;"
			."</td>"
			."<td>"
				."&nbsp;<input type=\"checkbox\" name=\"msnl_show_dates\" value=\"1\"";
				
if ( $msnl_gasModCfg['show_dates'] == "1" ) { echo " CHECKED"; }

echo "></td></tr>\n";

//Show Sender - Checked will show the sender of the newsletter in the block and archives

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				. msnl_fShowHelp( _MSNL_CFG_HLP_SHOWSENDER, _MSNL_CFG_LAB_SHOWSENDER )
				. _MSNL_CFG_LAB_SHOWSENDER
				.":&nbsp;"
			."</td>"
			."<td>"
				."&nbsp;<input type=\"checkbox\" name=\"msnl_show_sender\" value=\"1\"";
				
if ( $msnl_gasModCfg['show_sender'] == "1" ) { echo " CHECKED"; }

echo "></td></tr>\n";

//Close out this section

echo "</table>\n";

closetable();

echo "</div>\n";

/************************************************************************
* Block Options section of configuration options
************************************************************************/

echo "<div id='msnl_div_block'>\n";

echo "<br>";
opentable();

echo "<p><strong>"._MSNL_CFG_LAB_BLKOPT."</strong></p>\n";

echo "<table ${msnl_asCSS['TABLE_adm']}>\n";

//Newsletters to Show - The TOTAL number of newsletters to show in the block.

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_BLKLMT, _MSNL_CFG_LAB_BLKLMT )
				. _MSNL_CFG_LAB_BLKLMT
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_blk_lmt\" size=\"2\" "
					."maxlength=\"2\" value=\"".$msnl_gasModCfg['blk_lmt']."\">\n"
			."</td></tr>\n";

//Scrolling Block - Checked will cause the newsletter list in the block to scroll

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				. msnl_fShowHelp( _MSNL_CFG_HLP_SCROLL, _MSNL_CFG_LAB_SCROLL )
				. _MSNL_CFG_LAB_SCROLL
				.":&nbsp;"
			."</td>"
			."<td>"
				."&nbsp;<input type=\"checkbox\" name=\"msnl_scroll\" value=\"1\"";
				
if ( $msnl_gasModCfg['scroll'] == "1" ) { echo " CHECKED"; }

echo "></td></tr>\n";

//Scrolling Height - The number of pixels for the scrolling height.

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_SCROLLHEIGHT, _MSNL_CFG_LAB_SCROLLHEIGHT )
				. _MSNL_CFG_LAB_SCROLLHEIGHT
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_scroll_height\" size=\"2\" "
					."maxlength=\"4\" value=\"".$msnl_gasModCfg['scroll_height']."\">\n"
			."</td></tr>\n";

//Scrolling Amount - The number of pixels to move for each scroll.

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_SCROLLAMT, _MSNL_CFG_LAB_SCROLLAMT )
				. _MSNL_CFG_LAB_SCROLLAMT
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_scroll_amt\" size=\"2\" "
					."maxlength=\"4\" value=\"".$msnl_gasModCfg['scroll_amt']."\">\n"
			."</td></tr>\n";

//Scrolling Delay - Number of miliseconds to wait between scrolls.

echo "<tr ${msnl_asCSS['TR_top']}>"
			."<td ${msnl_asCSS['TD_hdr_adm']}>"
				.msnl_fShowHelp( _MSNL_CFG_HLP_SCROLLDELAY, _MSNL_CFG_LAB_SCROLLDELAY )
				. _MSNL_CFG_LAB_SCROLLDELAY
				.":&nbsp;"
			."</td>"
			."<td>"
				."<input type=\"text\" name=\"msnl_scroll_delay\" size=\"2\" "
					."maxlength=\"4\" value=\"".$msnl_gasModCfg['scroll_delay']."\">\n"
			."</td></tr>\n";

//Close out this section

echo "</table>\n";

closetable();

echo "</div>\n";

/************************************************************************
* Close up the Form and the web page.
************************************************************************/

msnl_fShowBtnSave('msnl_cfg_apply');

echo "</form>\n";

closetable();

//Make pop-up HELP available to the page
echo "<script type='text/javascript' src='./modules/$msnl_sModuleNm/wz_tooltip.js'></script>\n";

?>