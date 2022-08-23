<?php

if(!defined('IN_SETTINGS'))
	exit('Access Denied');

global $admlang;
/*****[START]******************************************
 [ Mod:     Private Message Alert              v1.0.0 ]
 ******************************************************/

$color_datalist = array(
	'#7A7474', '#555151', '#464444', '#302E2E', '#000000',
	'#e90000', '#d40000', '#bf0000', '#aa0000', '#940000',
	'#ff6600', '#e95d00', '#d45500', '#bf4c00', '#aa4400',
	'#5de900', '#54d400', '#4cbf00', '#44aa00', '#3b9400',
	'#006de9', '#0063d4', '#0059bf', '#004faa', '#004594',
	'#e900e9', '#d400d4', '#bf00bf', '#aa00aa', '#940094'
);

echo '  <tr>';
echo '    <td class="catHead center" colspan="3">'.$admlang['plugins']['header'].'</td>';
echo '  </tr>';
echo '  <tr>';
echo '    <td class="row1" colspan="3">';
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline col-12">';
echo '        <tr>';
echo '          <td class="catHead center" colspan="2">'.$admlang['pm_alert']['title'].'</td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">'.$admlang['pm_alert']['status'].'</td>';
echo '          <td class="row1 col-6">'.yesno_option('pm_alert_status', get_evo_option('pm_alert_status','int'), true).'</td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">'.$admlang['pm_alert']['cookie'].'</td>';
echo '          <td class="row1 col-6"><input type="text" name="pm_cookie_name" value="'.get_evo_option('pm_cookie_name').'" size="20" maxlength="20" /></td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">';
echo '            <span style="display: inline-block; float: left; margin-top: 2px;">'.$admlang['pm_alert']['refresh'].'</span>';
echo '            <span class="tooltip-html icon-sprite icon-info" title="'.$admlang['pm_alert']['refresh_explain'].'"></span>';
echo '          </td>';
echo '          <td class="row1 col-6"><input type="text" name="pm_cookie_minutes" value="'.get_evo_option('pm_cookie_minutes','int').'" size="5" maxlength="1" /></td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">';
echo '            <span style="display: inline-block; float: left; margin-top: 2px;">'.$admlang['pm_alert']['alert'].'</span>';
echo '            <span class="tooltip-html icon-sprite icon-info" title="'.$admlang['pm_alert']['alert_explain'].'"></span>';
echo '          </td>';
echo '          <td class="row1 col-6"><input type="text" name="pm_cookie_seconds" value="'.get_evo_option('pm_cookie_seconds','int').'" size="5" maxlength="1" /></td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">'.$admlang['pm_alert']['sound'].'</td>';
echo '          <td class="row1 col-6">'.yesno_option('pm_alert_sound', get_evo_option('pm_alert_sound','int'), true).'</td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">'.$admlang['pm_alert']['background'].'</td>';
echo '          <td class="row1 col-6"><input type="color" name="pm_overlay_color" style="padding: 0px; width: 56px; height: 28px;" value="'.get_evo_option('pm_overlay_color').'"></td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">'.$admlang['pm_alert']['color'].'</td>';
echo '          <td class="row1 col-6"><input type="color" name="pm_button_color" style="padding: 0px; width: 56px; height: 28px;" value="'.get_evo_option('pm_button_color').'"></td>';
echo '        </tr><tr>';
echo '          <td class="row1 col-6">'.$admlang['pm_alert']['hover'].'</td>';
echo '          <td class="row1 col-6"><input type="color" name="pm_button_color2" style="padding: 0px; width: 56px; height: 28px;" value="'.get_evo_option('pm_button_color2').'"></td>';
echo '        </tr>';


// echo '      </table>'.PHP_EOL;
/*****[END]********************************************
 [ Mod:     Private Message Alert              v1.0.0 ]
 ******************************************************/
// echo '<br />'; # Let's seperate the plugins sections
/*****[START]******************************************
 [ Mod:     Image Viewer Class                 v1.0.0 ]
 ******************************************************/
// echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
echo '        <tr>';
echo '          <td class="catHead acenter" colspan="2">'.$admlang['viewer']['title'].'</td>';
echo '        </tr>';
echo '        <tr>';
echo '          <td class="row1" style="width: 50%;">'.$admlang['viewer']['select'].'</td>';
echo '          <td class="row1" style="width: 50%;">';
echo '            <select name="img_viewer">';
echo '              <option value="colorbox" '.((get_evo_option('img_viewer') == 'colorbox')?' selected="selected"':'').'>'.$admlang['viewer']['colorbox'].'</option>';
echo '              <option value="fancybox" '.((get_evo_option('img_viewer') == 'fancybox')?' selected="selected"':'').'>'.$admlang['viewer']['fancybox'].'</option>';
echo '              <option value="lightbox-lite" '.((get_evo_option('img_viewer') == 'lightbox-lite')?' selected="selected"':'').'>'.$admlang['viewer']['lightboxlite'].'</option>';
echo '              <option value="lightbox" '.((get_evo_option('img_viewer') == 'lightbox')?' selected="selected"':'').'>'.$admlang['viewer']['lightbox'].'</option>';
echo '            </select>';
echo '          </td>';
echo '        </tr>';
echo '      </table>';
/*****[END]********************************************
 [ Mod:     Image Viewer Class                 v1.0.0 ]
 ******************************************************/

?>