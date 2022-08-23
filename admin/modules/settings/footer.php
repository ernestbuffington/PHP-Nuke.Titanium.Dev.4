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
 ************************************************************************/

if(!defined('IN_SETTINGS'))
	exit('Access Denied');

global $foot1, $foot2, $foot3;
echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead" colspan="3" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['footer']['title'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="catHead" colspan="2" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['footer']['line1'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" colspan="2" style="text-align: center;"><textarea data-autoresize name="xfoot1" style="box-sizing: border-box; cursor: auto; height: 150px; letter-spacing: 1px; min-height: 150px; padding: 5px; resize: vertical; width: 100%;">'.$foot1.'</textarea></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="catHead" colspan="2" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['footer']['line2'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" colspan="2" style="text-align: center;"><textarea data-autoresize name="xfoot2" style="box-sizing: border-box; cursor: auto; height: 150px; letter-spacing: 1px; min-height: 150px; padding: 5px; resize: vertical; width: 100%;">'.$foot2.'</textarea></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="catHead" colspan="2" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['footer']['line3'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" colspan="2" style="text-align: center;"><textarea data-autoresize name="xfoot3" style="box-sizing: border-box; cursor: auto; height: 150px; letter-spacing: 1px; min-height: 150px; padding: 5px; resize: vertical; width: 100%;">'.$foot3.'</textarea></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '      </table>'.PHP_EOL;

?>