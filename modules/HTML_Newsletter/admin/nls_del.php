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
* FORM variable validation and cleansing
************************************************************************/

if ( !isset( $_POST['msnl_nid'] ) ) { //Should not get here without a newsletter id set

	msnl_fRaiseAppError( _MSNL_NLS_ERR_INVALIDNID );	

}

$msnl_iNID	= intval( $_POST['msnl_nid'] );

if ( !isset( $_POST['msnl_cid'] ) ) { //Should not get here without a category id selected

	opentable();
	
	msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

}

$msnl_iCID	= intval( $_POST['msnl_cid'] );

/************************************************************************
* Show confirmation message to ensure they really, really, really want to delete.
************************************************************************/

echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
echo "<div id='msnl_div_init'>\n";
echo "<input type='hidden' name='op' value='msnl_nls'>\n";
echo "<input type='hidden' name='msnl_nid' value='".$msnl_iNID."'>\n";
echo "<input type='hidden' name='msnl_cid' value='".$msnl_iCID."'>\n";
echo "</div>\n";

echo "<div ${msnl_asCSS['BLOCK_center']}>"
			."<p><span class='title'>". _MSNL_COM_MSG_WARNING ."</span></p>\n"
			."<p><strong>"._MSNL_NLS_DEL_MSG_DELIMPACT."</strong></p>\n"
			."<p>"._MSNL_NLS_DEL_MSG_DELIMPACT1."</p>"
			."<p>"
				."[ "
					."<a href=\"javascript:msnl_FormHandler('msnl_nls_del_apply');\" "
						."title='"._MSNL_COM_LNK_CONTINUE."'>"._MSNL_COM_LAB_YES
					."</a>\n"
				." | "
					."<a href=\"javascript:msnl_FormHandler('msnl_nls');\" "
						."title='"._MSNL_COM_LNK_CANCEL."'>"._MSNL_COM_LAB_NO
					."</a>\n"
				." ]\n"
			."</p>\n"
		."</div>\n";

echo "</form>\n";

/************************************************************************
* Close up the web page.
************************************************************************/

closetable();

?>