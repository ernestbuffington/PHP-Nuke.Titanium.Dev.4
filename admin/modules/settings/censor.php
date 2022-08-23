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
      Censor                                   v1.0.0       10/20/2005
 ************************************************************************/

if(!defined('IN_SETTINGS'))
	exit('Access Denied');

global $censor_words, $censor, $admLang;
$censor_words = str_replace(" ", "\n", $censor_words);
echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead acenter" colspan="3">'.$admlang['censor']['title'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['censor']['words'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><textarea name="xcensor_words" cols="40" rows="8" style="min-height:100px;">'.$censor_words.'</textarea></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['censor']['settings'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.select_box('xcensor',$censor,array(0 => $admlang['censor']['off'], 1 => $admlang['censor']['whole'], 2 => $admlang['censor']['partial'])).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '      </table>'.PHP_EOL;

?>