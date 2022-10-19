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
      Lazy Google Tap                          v1.0.0       01/27/2006
      URL Check                                v1.0.0       07/01/2005
 ************************************************************************/

if(!defined('IN_SETTINGS')) {
  exit('Access Denied');
}

global $sitename, $nukeurl, $site_logo, $slogan, $startdate, $adminmail, $top, $storyhome, $oldnum, $ultramode, $anonpost, $language, $locale, $admlang;
echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead" colspan="3" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['preferences']['general'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['global']['sitename'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xsitename" value="'.$sitename.'" maxlength="255" style="width: 350px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['global']['siteurl'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xnukeurl" value="'.$nukeurl.'" maxlength="255" style="width: 350px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['site_logo'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xsite_logo" value="'.$site_logo.'" maxlength="255" style="width: 350px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['site_slogon'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xslogan" value="'.$slogan.'" maxlength="255" style="width: 350px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['start_date'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xstartdate" value="'.$startdate.'" maxlength="255" style="width: 350px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['admin_email'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xadminmail" value="'.$adminmail.'" maxlength="255" style="width: 350px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['items'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xtop" value="'.$top.'" maxlength="255" style="width: 100px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['stories'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xstoryhome" value="'.$storyhome.'" maxlength="255" style="width: 100px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['blogs_old'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xoldnum" value="'.$oldnum.'" maxlength="255" style="width: 100px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['ultra_mode'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xultramode', $ultramode).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['guests_post'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xanonpost', $anonpost).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['preferences']['locale_format'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xlocale" value="'.$locale.'" maxlength="255" style="width: 350px;" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '      </table>'.PHP_EOL;

?>