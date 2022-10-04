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

if(!defined('IN_SETTINGS')) {
  exit('Access Denied');
}

global $multilingual, $useflags, $language, $admlang;
$languageslist = lang_list();
echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead" colspan="3" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['preferences']['language_opts'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['language']['select'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.PHP_EOL;
echo '            <select name="xlanguage">';
for ($i=0, $maxi=count($languageslist); $i < $maxi; $i++) 
{
    if(!empty($languageslist[$i])) 
    {
        echo '              <option name="xlanguage" value="'.$languageslist[$i].'"'.(($languageslist[$i]==$language) ? ' selected="selected"' : '').'>'.ucwords($languageslist[$i]).'</option>';     
    }
}
echo '            </select>';
echo '          </td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['language']['multi'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xmultilingual', $multilingual).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['language']['use_flags'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xuseflags', $useflags).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '      </table>'.PHP_EOL;

?>