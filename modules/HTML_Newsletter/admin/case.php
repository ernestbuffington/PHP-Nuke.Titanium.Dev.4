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

if ( !defined('ADMIN_FILE') ) {	die("Illegal File Access"); }

$msnl_sModuleNm = "HTML_Newsletter";

@include_once( "modules/$msnl_sModuleNm/admin/language/lang-".$currentlang.".php" );

switch( $op ) {

	case "msnl_admin":
	case "msnl_admin_preview":
	case "msnl_admin_send_mail":
	case "msnl_admin_send_tested":
	case "msnl_cfg":
	case "msnl_cfg_apply":
	case "msnl_cat":
	case "msnl_cat_add":
	case "msnl_cat_add_apply":
	case "msnl_cat_chg":
	case "msnl_cat_chg_apply":
	case "msnl_cat_del":
	case "msnl_cat_del_apply":
	case "msnl_nls":
	case "msnl_nls_chg":
	case "msnl_nls_chg_apply":
	case "msnl_nls_del":
	case "msnl_nls_del_apply":
  @include( "modules/$msnl_sModuleNm/admin/index.php" );
	break;
	
}

?>