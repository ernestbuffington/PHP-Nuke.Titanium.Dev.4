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
      Advanced Security Code Control           v1.0.0       12/17/2005
 ************************************************************************/

if(!defined('IN_SETTINGS')) {
  exit('Access Denied');
}

global $admlang;

/**
 * Mod: Admin failed login checker. (Tracks the amount of times an admin fails to login.)
 * @since 2.0.9e
 */
echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead acenter" colspan="3">'.$admlang['preferences']['security'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="catHead acenter" colspan="2">'.$admlang['adminfail']['title'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>';
echo '          <td class="row1">';
echo '            <span title="'.$admlang['adminfail']['status_explain'].'">'.$admlang['adminfail']['status'].'</span>';
echo '            <span class="tooltip-html evo-sprite about float-right" title="'.$admlang['adminfail']['status_explain'].'"></span>';
echo '          </td>';
echo '          <td class="row1">'.yesno_option('admin_fc_status', get_evo_option('admin_fc_status', 'int')).'</td>';
echo '        </tr>';
echo '        <tr>';
echo '          <td class="row1" style="width: 50%;">';
echo '            <span title="'.$admlang['adminfail']['max_attempts_explain'].'">'.$admlang['adminfail']['max_attempts'].'</span>'.PHP_EOL;
echo '            <span class="tooltip-html evo-sprite about float-right" title="'.$admlang['adminfail']['max_attempts_explain'].'"></span>';
echo '          </td>'.PHP_EOL;
echo '          <td class="row1"><input type="text" name="admin_fc_attempts" value="'.get_evo_option('admin_fc_attempts', 'int').'" size="5" maxlength="2" /></td>';
echo '        </tr>';
echo '        <tr>';
echo '          <td class="row1">';
echo '            <span title="'.$admlang['adminfail']['status_explain'].'">'.$admlang['adminfail']['timeout'].'</span>';
echo '            <span class="tooltip-html evo-sprite about float-right" title="'.$admlang['adminfail']['timeout_explain'].'"></span>';
echo '          </td>';
echo '          <td class="row1"><input type="text" name="admin_fc_timeout" value="'.get_evo_option('admin_fc_timeout', 'int').'" size="5" maxlength="3" /></td>';
echo '        </tr>';

/**
 * Mod: IPHUB (Allows the blocking of VPN/PROXY Servers.)
 * @since 2.0.9e
 */
echo '        <tr>'.PHP_EOL;
echo '          <td class="catHead acenter" colspan="2">'.$admlang['iphub']['title'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr'.((get_evo_option('iphub_key')) ? ' style="display: none"' : '').'>'.PHP_EOL;
echo '          <td class="row2 acenter" colspan="2">'.$admlang['iphub']['api_warn'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">';
echo '            <span style="display: inline-block; float: left; margin-top: 2px;">'.$admlang['iphub']['key'].'</span>'.PHP_EOL;
echo '            <span class="tooltip-interact evo-sprite about float-right" title="'.$admlang['iphub']['key_explain'].'"></span>';
echo '          </td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="password" name="admin_iphub_key" value="'.get_evo_option('iphub_key').'" size="60" maxlength="100" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr'.((get_evo_option('iphub_key')) ? '' : ' style="display: none"').'>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['iphub']['status'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.yesno_option('admin_iphub_status', get_evo_option('iphub_status', 'int')).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr'.((get_evo_option('iphub_key')) ? '' : ' style="display: none"').'>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">';
echo '            <span style="display: inline-block; float: left; margin-top: 2px;">'.$admlang['iphub']['cookie'].'</span>'.PHP_EOL;
echo '            <span class="tooltip-html evo-sprite about float-right" title="'.$admlang['iphub']['add_explain'].'"></span>';
echo '          </td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="admin_iphub_ctime" value="'.get_evo_option('iphub_cookietime').'" size="3" maxlength="3" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;

/**
 * Mod: reCaptcha (Complete replacement for the GD2 captcha system.)
 * @since 2.0.9e
 */
echo '        <tr>'.PHP_EOL;
echo '          <td class="catHead acenter" colspan="2">'.$admlang['reCaptcha']['options'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr'.((get_evo_option('recap_site_key') && get_evo_option('recap_priv_key')) ? ' style="display: none"' : '').'>'.PHP_EOL;
echo '          <td class="row2 acenter" colspan="2">'.$admlang['reCaptcha']['api_warn'].'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">';
echo '            <span style="display: inline-block; float: left; margin-top: 2px;">'.$admlang['reCaptcha']['site_key'].'</span>'.PHP_EOL;
echo '            <span class="tooltip-interact evo-sprite about float-right" title="'.$admlang['reCaptcha']['site_key_explain'].'"></span>';
echo '          </td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="password" name="recap_skey" value="'.get_evo_option('recap_site_key').'" size="60" maxlength="100" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['reCaptcha']['secret_key'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="password" name="recap_pkey" value="'.get_evo_option('recap_priv_key').'" size="60" maxlength="100" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;

$reCaptcha_options = array(
	0 => $admlang['reCaptcha']['no_checking'],
	1 => $admlang['reCaptcha']['admin_login_only'],
	2 => $admlang['reCaptcha']['user_login_only'],
	3 => $admlang['reCaptcha']['user_reg_only'],
	4 => $admlang['reCaptcha']['both'],
	5 => $admlang['reCaptcha']['admin_and_user_login'],
	6 => $admlang['reCaptcha']['admin_and_new_users'],
	7 => $admlang['reCaptcha']['everywhere']
);

echo '        <tbody'.((get_evo_option('recap_site_key') && get_evo_option('recap_priv_key')) ? '' : ' style="display: none"').'>';
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.$admlang['reCaptcha']['check'].'</td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">'.select_box('xusegfxcheck', get_evo_option('usegfxcheck'), $reCaptcha_options).'</td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;">';
echo '            <span style="display: inline-block; float: left; margin-top: 2px;">'.$admlang['reCaptcha']['language'].'</span>'.PHP_EOL;
echo '            <span class="tooltip-interact evo-sprite about float-right" title="'.$admlang['reCaptcha']['language_explain'].'"></span>';
echo '          </td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="recap_lang" value="'.get_evo_option('recap_lang').'" size="6" maxlength="6" /></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '        </tbody>';
echo '      </table>'.PHP_EOL;

?>