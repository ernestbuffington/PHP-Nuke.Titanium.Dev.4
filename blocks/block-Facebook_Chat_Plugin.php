<?php
/*=======================================================================  
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System  
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

# we tell the block loader that we do not want tables
# drawn arounf out block by setting this to TRUE
global $invisble_facebook_block;
$invisble_facebook_block = true;

// Now show it
$content  = '<div class="fb-customerchat"';
$content .= 'attribution="page_inbox"';
$content .= 'page_id="">';
$content .= '</div>';
?> 
