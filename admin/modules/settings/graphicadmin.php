<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

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
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Admin Icon/Link Pos                      v1.0.0       06/15/2005
 ************************************************************************/

if(!defined('IN_SETTINGS')) { 
  exit('Access Denied');
}

global $admingraphic, $admin_pos;
$value 			= ($admin_pos>0) ? 1 : 0;
$sel[$value] 	= ' checked="checked"';

if(!isset($admlang['global']['up']))
$admlang['global']['up'] = '';
if(!isset($admlang['global']['down']))
$admlang['global']['down'] = '';
if(!isset($sel[1]))
$sel[1] = '';
if(!isset($sel[0]))
$sel[0] = '';

echo '<tr>'.PHP_EOL;
echo '<td class="catHead" colspan="3" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['graphics']['position'].'</td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td class="row1" colspan="3">'.PHP_EOL;
echo '<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td class="row1" style="width: 50%;">'.$admlang['graphics']['show'].'</td>'.PHP_EOL;
echo '<td class="row1" style="width: 50%;">'.yesno_option('xadmingraphic', $admingraphic).'</td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td class="row1" style="width: 50%;">'.$admlang['graphics']['position_opt'].'</td>'.PHP_EOL;
echo '<td class="row1" style="width: 50%;"><input type="radio" name="xadmin_pos" value="1"'.$sel[1].' />&nbsp;'.$admlang['global']['up'].'&nbsp;<input type="radio" name="xadmin_pos" value="0" '.$sel[0].' />&nbsp;'.$admlang['global']['down'].'</td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;
