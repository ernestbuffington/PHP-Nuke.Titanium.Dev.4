<?php
/**
 * New Private message alert
 *
 * Original concept came from coRpSE, This is a modification/re-write of the original mod.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @author coRpSE <https://www.headshotdomain.net>
 * @version 1.0.0
 * @license GPL-3.0
 */

if(!defined('NUKE_FILE')) 
	die('Access forbbiden');

global $name, $userinfo, $nukeurl;

# check the total number of private messages you have, that are unread.
$newpms = has_new_or_unread_private_messages();

if ( !defined('_disable_default_evo_pm_alert') ):

	# if the plugin is active and the cookie does not exist, show the alert.
	if (get_evo_option('pm_alert_status','int') == 1 && !isset($_COOKIE[get_evo_option('pm_cookie_name')]) && is_active('Private_Messages') == 1 && $name == '' && !defined('ADMIN_FILE') && $newpms > 0 && $userinfo['user_notify_pm'] == 1):

		addCSSToHead(NUKE_CSS_DIR.'jquery.private.messages.alert.min.css?v=1.0.0','file');
		$CSStoHead  = '<style>'.PHP_EOL;
		$CSStoHead .= '.private-msg-overlay-button'.PHP_EOL;
		$CSStoHead .= '{'.PHP_EOL;
		$CSStoHead .= '	background: '.get_evo_option('pm_button_color').';'.PHP_EOL;
		$CSStoHead .= '}'.PHP_EOL;
		$CSStoHead .= '.private-msg-overlay-button:hover'.PHP_EOL;
		$CSStoHead .= '{'.PHP_EOL;
		$CSStoHead .= '	background: '.get_evo_option('pm_button_color2').';'.PHP_EOL;
		$CSStoHead .= '	background-image: -webkit-linear-gradient(top, '.get_evo_option('pm_button_color2').', '.get_evo_option('pm_button_color').');'.PHP_EOL;
		$CSStoHead .= '	background-image: linear-gradient(to bottom, '.get_evo_option('pm_button_color2').', '.get_evo_option('pm_button_color').');'.PHP_EOL;
		$CSStoHead .= '	text-decoration: none;'.PHP_EOL;
		$CSStoHead .= '}'.PHP_EOL;	
		$CSStoHead .= '</style>'.PHP_EOL;
		addCSSToHead($CSStoHead,'inline');

		$JStoHead  = '<script>'.PHP_EOL;
		$JStoHead .= '	var pm_alert_status = "'.get_evo_option('pm_alert_status','int').'";'.PHP_EOL;
		$JStoHead .= '	var pm_delay_timing = "'.get_evo_option('pm_cookie_seconds','int').'";'.PHP_EOL;
		$JStoHead .= '	var pm_alert_message = "'.sprintf((($newpms > 1) ? $customlang['private_msg']['messages'] : $customlang['private_msg']['message']),$newpms).'";'.PHP_EOL;
		
		if(!isset($pm_cookie_minutes))
		$pm_cookie_minutes = 0;
		
		if($pm_cookie_minutes <> 0):
			$JStoHead .= '  var pm_cookie_message = "'.sprintf(((get_evo_option('pm_cookie_minutes','int') > 1) ? $customlang['private_msg']['cookie_msg2'] : $customlang['private_msg']['cookie_msg']),get_evo_option('pm_cookie_minutes','int'),((get_evo_option('pm_cookie_minutes','int') > 1) ? $customlang['private_msg']['cookie_msg2'] : $customlang['private_msg']['cookie_msg'])).'";'.PHP_EOL;
		else:
			$JStoHead .= '	var pm_cookie_message = "";'.PHP_EOL;
		endif;
		$JStoHead .= '	var pm_overlay_color = "'.get_evo_option('pm_overlay_color').'";'.PHP_EOL;
		$JStoHead .= '	var pm_button_color = "'.get_evo_option('pm_button_color').'";'.PHP_EOL;
		$JStoHead .= '	var pm_button_color2 = "'.get_evo_option('pm_button_color2').'";'.PHP_EOL;
		$JStoHead .= '	var pm_alert_sound = "'.get_evo_option('pm_alert_sound','int').'";'.PHP_EOL;
		$JStoHead .= '	var pm_nukeurl = "'.$nukeurl.'";'.PHP_EOL;
		$JStoHead .= '</script>'.PHP_EOL;
		addJSToBody($JStoHead,'inline');
		addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.private.messages.alert.min.js?v=1.0.0','file');
		# store a cookie in the browser allowing you to delay how long between notifications of new private messages
		if(get_evo_option('pm_cookie_minutes','int') <> 0):
			setcookie(get_evo_option('pm_cookie_name'), true, time() + (60 * get_evo_option('pm_cookie_minutes','int')), '/');
		endif;

	endif;

endif;

?>