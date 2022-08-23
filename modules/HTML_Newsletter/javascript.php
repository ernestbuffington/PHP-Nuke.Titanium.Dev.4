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

if ( !defined( 'MSNL_LOADED' ) and !defined( 'BLOCK_FILE' ) and !defined( 'NUKE_FILE' ) ) {
	die( "Illegal File Access" );
}

/************************************************************************
* This script writes out the key Javascript functions that are used in 
* the module and admin.
************************************************************************/

echo "<script type='text/javascript'>\n";
echo "<!-- Javascript functions for HTML Newsletter Admin tools\n";

//Try and stop the preview pop-up when using the history(-1) function

echo "msnl_iPreviewON = 1;\n";

/************************************************************************
* Function: msnl_FormHandler()
* Inputs:		msnl_sOP	= The operation to pass into the form submit
* Usage: 		Used to change a page's form operation based on different
* 					page links (functions).
************************************************************************/

echo "function msnl_FormHandler(msnl_sOP) {\n";
echo "	document.msnl_frm.op.value = msnl_sOP;\n";
echo "	document.msnl_frm.submit();\n";
echo "}\n";

/************************************************************************
* Function: msnl_ObjHandler()
* Inputs:		msnl_sOP	= The operation to pass into the form submit
* 					msnl_sVAR	= The specific form variable to change the value for
* 					msnl_iID	= The ID value to change the variable to (integer
* 						value ONLY)
* Usage: 		This function is similar to msnl_FormHandler except that it
* 					has further granular control over the form variable being
* 					modified and is primarily used for object level maintainance
* 					functions.
************************************************************************/

echo "function msnl_ObjHandler(msnl_sOP, msnl_sVAR, msnl_iID) {\n";
echo "	eval('document.msnl_frm.' + msnl_sVAR + '.value = msnl_iID');\n";
echo "	msnl_FormHandler(msnl_sOP);\n";
echo "}\n";

/************************************************************************
* Function: msnl_ObjFocus()
* Inputs:		msnl_sField	= The form field to set focus on
* Usage: 		Used to set the focus on the provided form field upon
* 					completing the writing of the page.
************************************************************************/

echo "function msnl_ObjFocus(msnl_sField) {\n";
echo "	eval('document.msnl_frm.' + msnl_sField + '.focus()');\n";
echo "}\n";

/************************************************************************
* Function: msnl_OpenWindow()
* Inputs:		msnl_sURL	= The URL to open in the new window
* Usage: 		Used to pop-up a new window and pass a URL to it.  This is
* 					used for the view newsletter function in the block and archives.
************************************************************************/
/*
echo "function msnl_OpenWindow(msnl_sURL) {\n";
echo "  alert(msnl_sURL);";
echo "	ViewNls=window.open(msnl_sURL,'ViewNewsletter','width=800,height=600,menubar,scrollbars,resizable,left=0,top=0');\n";
echo "}\n";
*/
/************************************************************************
* Function: msnl_OpenNew()
* Inputs:		msnl_sURL	= The URL to open in the new window
* Usage: 		Used to pop-up a new window and pass a URL to it.
************************************************************************/
/*
echo "function msnl_OpenNew(msnl_sURL) {\n";
echo "	ViewNls=window.open(msnl_sURL,'ViewNewWindow', '');\n";
echo "}\n";
*/
//Close the javascript hide tag

echo "-->\n";
echo "</script>\n";
				
?>