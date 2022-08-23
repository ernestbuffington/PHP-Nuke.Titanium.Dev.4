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

global $notify, $notify_email, $notify_subject, $notify_message, $notify_from;
echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead" colspan="3" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['preferences']['submissions'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['submissions']['notify'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xnotify', $notify).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['submissions']['email'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xnotify_email" value="'.$notify_email.'" maxlength="100" style="width: 350px;"></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['submissions']['subject'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xnotify_subject" value="'.$notify_subject.'" maxlength="100" style="width: 350px;"></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['submissions']['message'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><textarea name="xnotify_message" style="box-sizing: border-box; cursor: auto; height: 120px; letter-spacing: 1px; min-height: 90px; padding: 5px; resize: vertical; width: 100%;">'.$notify_message.'</textarea></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['submissions']['from'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xnotify_from" value="'.$notify_from.'" maxlength="100" style="width: 350px;"></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '      </table>'.PHP_EOL;

?>