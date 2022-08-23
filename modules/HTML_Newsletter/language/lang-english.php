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
* Function: Common Use Defines
************************************************************************/

define("_MSNL_COM_LAB_SQL",								"SQL");
define("_MSNL_COM_LAB_GOBACK",						"GO BACK");
define("_MSNL_COM_LAB_ERRMSG",						"ERROR MSG");
define("_MSNL_COM_LAB_HELPLEGENDTXT",			"Hover your cursor over these icons for detailed "
	."help text"
	);

define("_MSNL_COM_LNK_GOBACK",						"Click to go back to previous page");

define("_MSNL_COM_ERR_SQL",								"ENCOUNTERED ERROR IN SQL");
define("_MSNL_COM_ERR_MODULE",						"ERROR IN MODULE");
define("_MSNL_COM_ERR_VALMSG",						"THE FOLLOWING FIELDS FAILED VALIDATION");
define("_MSNL_COM_ERR_VALWARNMSG",				"THE FOLLOWING FIELDS HAD WARNINGS");
define("_MSNL_COM_ERR_DBGETCFG", 					"Failed to get module configuration information!");

define("_MSNL_COM_HLP_HELPLEGENDTXT",			"Yes, that is how it is done!");

/************************************************************************
* Function: Common use defines between module and block
************************************************************************/

define("_MSNL_NLS_LAB_MORENLS",						"More Newsletters...");
define("_MSNL_NLS_LAB_HIT",								"hit");
define("_MSNL_NLS_LAB_HITS",							"hits");
define("_MSNL_NLS_LAB_SENTON",						"sent on");
define("_MSNL_NLS_LAB_SENDER",						"sender");

define("_MSNL_NLS_LNK_VIEWNL",						"View newsletter - may open new window");
define("_MSNL_NLS_LNK_VIEWNLARCHS",				"View newsletter archives");

/************************************************************************
* Function: msnl_nls_list
************************************************************************/

define("_MSNL_NLS_LST_LAB_ARCHTITL",			"Archived Newsletters");
define("_MSNL_NLS_LST_LAB_ADMNLS",				"Administer Newsletter");

define("_MSNL_NLS_LST_LNK_ADMNLS",				"Go to module administration");

define("_MSNL_NLS_LST_MSG_NONLS",					"No Newsletters to View");

/************************************************************************
* Function: msnl_nls_view
************************************************************************/

define("_MSNL_NLS_VIEW_ERR_DBGETNL",			"Failed to get Newsletter information");
define("_MSNL_NLS_VIEW_ERR_CANNOTFIND",		"Cannot find selected Newsletter file");
define("_MSNL_NLS_VIEW_ERR_NOTAUTH",			"You are not authorized to view this newsletter "
	."or this newsletter does not exist!");

/************************************************************************
* Function: msnl_copyright_view
************************************************************************/

define("_MSNL_CPY_LAB_COPYTITLE",					"Module Copyright &copy; and Credits");
define("_MSNL_CPY_LAB_MODULEFOR",					"module for");
define("_MSNL_CPY_LAB_COPY",							"Copyright Information");
define("_MSNL_CPY_LAB_CREDITS",						"Credit Information");
define("_MSNL_CPY_LAB_MODNAME",						"Module Name");
define("_MSNL_CPY_LAB_MODVER",						"Module Version");
define("_MSNL_CPY_LAB_MODDESC",						"Module Description");
define("_MSNL_CPY_LAB_LICENSE",						"License");
define("_MSNL_CPY_LAB_AUTHORNM",					"Author Name");
define("_MSNL_CPY_LAB_AUTHOREMAIL",				"Author Email");
define("_MSNL_CPY_LAB_AUTHORWEB",					"Author Home Page");
define("_MSNL_CPY_LAB_MODDL",							"Module Download");
define("_MSNL_CPY_LAB_DOCS",							"Support/Help Documentation");
define("_MSNL_CPY_LAB_ORIGAUTHOR",				"Original Author(s)");
define("_MSNL_CPY_LAB_CURRENTAUTHOR",			"Current Author(s)");
define("_MSNL_CPY_LAB_TRANSLATIONS",			"Translation Author(s)");
define("_MSNL_CPY_LAB_OTHER",							"Additional Thanks");

define("_MSNL_CPY_LNK_VIEWCOPYRIGHT",			"View copyright and credits");
define("_MSNL_CPY_LNK_PHPNUKE",						"Go to PHP-Nuke website - will leave this site");
define("_MSNL_CPY_LNK_AUTHORHOME",				"Go to Author's website - will leave this site");
define("_MSNL_CPY_LNK_DOWNLOAD",					"Go to Downloads website - will leave this site");
define("_MSNL_CPY_LNK_DOCS",							"Go to Documentation website - will leave this site");

?>