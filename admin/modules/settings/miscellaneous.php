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
-=[Other]=-
      SSL Administration                       v1.0.0       08/29/2005
-=[Mod]=-
      Lock Modules                             v1.0.0       08/04/2005
      Queries Count                            v2.0.0       08/19/2005
      Custom Text Area                         v1.0.0       11/23/2005
      Color Toggle                             v1.0.0       11/25/2005
 ************************************************************************/

if(!defined('IN_SETTINGS'))exit('Access Denied');

      global $admin, 
           $httpref, 
        $httprefmax, 
          $pollcomm, 
       $articlecomm, 
           $minpass, 
      $my_headlines, 
         $user_news, 
          $adminssl, 
     $queries_count, 
        $use_colors, 
      $lock_modules, 
           $banners, 
	      $lazy_tap, 
	       $wysiwyg, 
        $img_resize, 
         $img_width, 
        $img_height, 
          $collapse, 
      $collapsetype, 
         $analytics, 
        $use_stream, 
         $html_auth, 
$use_floating_admin, 
       $arrow_color, 
	    $img_viewer, 
		   $admLang;

if(!isset($admlang['misc']['header']))
$admlang['misc']['header'] = '';

echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead" colspan="3" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['misc']['header'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['referers'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xhttpref', $httpref).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['referers_max'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="xhttprefmax" value="'.$httprefmax.'" maxlength="4" style="width: 100px;"></td>'.PHP_EOL;
echo '        </tr>';
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['poll_comments'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xpollcomm', $pollcomm).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['poll_comments_active'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xarticlecomm', $articlecomm).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['myheadlines'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xmy_headlines', $my_headlines).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['ssl_admin'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xadminssl', $adminssl).'&nbsp;&nbsp;<span class="tiny">[ '.$admlang['misc']['ssl_admin_warn'].' ]</span></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['queries'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xqueries_count', $queries_count).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['colors'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xuse_colors', $use_colors).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['lock_modules'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xlock_modules', $lock_modules).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['banners'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xbanners', $banners).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;

# Mod:     Custom Text Area
$admin_wysiwyg = new Wysiwyg('','');
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">Blog Area Editor</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admin_wysiwyg->getSelect().'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
# Base:    HTMLPurifier God Admin Bypass

if (is_god($admin)) 
{
  echo '        <tr>'.PHP_EOL;
  echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['html_bypass'].'</td>'.PHP_EOL;
  echo '          <td class="row1" style="width: 50%;">'.yesno_option('xhtml_auth', $html_auth).'</td>'.PHP_EOL;
  echo '        </tr>'.PHP_EOL;
}
# Mod:     Lazy Google Tap
if(!isset($admlang['preferences']['lazy_tap_admin']))
$admlang['preferences']['lazy_tap_admin'] = '';

echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['lazy_tap'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.select_box('xlazytap',$lazy_tap,array(0 => $admlang['global']['disabled'], 1 => $admlang['misc']['lazy_tap_bots'], 2 => $admlang['misc']['lazy_tap_everyone'], 3 => $admlang['preferences']['lazy_tap_admin'])).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
# Mod:     Image Resize Mod
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['image_resize'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('ximg_resize', $img_resize).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['image_resize_width'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="ximg_width" value="'.$img_width.'" size="5" maxlength="5"></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['image_resize_height'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="ximg_height" value="'.$img_height.'" size="5" maxlength="5"></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
# Base:    Switch Content Script
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['collapse'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('xcollapse', $collapse).'&nbsp;|&nbsp;'.select_box('xcollapsetype',$collapsetype,array(0 => _COLLAPSE_ICON, 1 => _COLLAPSE_TITLE)).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;


echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['cache_time'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">';

echo "<select name='xblock_cachetime'>\n";
echo "<option value='0'";
if ( get_evo_option( 'block_cachetime' ) == 0) { echo " selected='selected'"; }
echo ">".$admlang['misc']['cache_deactivated']."</option>\n";
$i = 300;
while ($i <= 86400) {
    echo "<option value='$i'";
    if ( get_evo_option( 'block_cachetime' ) == $i ) { echo " selected='selected'"; }
    if ($i <= 3300 ) {
        $k = ($i/60);
        echo">$k ".$admlang['misc']['cache_minutes']."</option>\n";
        $i = $i + 300;
    } else {
        $k = ($i/3600);
        echo">$k ".$admlang['misc']['cache_hours']."</option>\n";
        $i = $i + 3600;
    }
}
echo "</select>";

echo '          </td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;


//echo '        <tr>'.PHP_EOL;
//echo '          <td class="row1" style="width: 50%;">'.$admlang['misc']['analytics'].'</td>'.PHP_EOL;
//echo '          <td class="row1" style="width: 50%;"><input type="text" name="xanalytics" value="'.$analytics.'" size="25" maxlength="50"></td>'.PHP_EOL;
//echo '        </tr>'.PHP_EOL;
echo '      </table>'.PHP_EOL;
//echo '    </td>'.PHP_EOL;
//echo '  </tr>'.PHP_EOL;

?>