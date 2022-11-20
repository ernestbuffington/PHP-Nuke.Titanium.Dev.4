<?php
/**
 * A flexible and extensible jQuery plugin for modern tooltips.
 *
 * @package tooltipster
 * @author  Caleb Jacob <hello@calebjacob.com>
 * @version 4.2.6
 * @license MIT
 * @link    https://github.com/iamceege/tooltipster
 */

if(!defined('NUKE_FILE')) die('Access forbbiden');

/*
	USEAGE - DEFAULT 				: <span class="tooltip" title="This is my span's tooltip message!">Some text</span>
	USEAGE - MAKE TOOLTIP INTERACT 	: <span class="tooltip-interact" title="This is my span's tooltip message!">Some text</span>
	USEAGE - DISPLAY HTML 			: <span class="tooltip-html" title="This is my span's tooltip message!">Some text</span>
*/
addCSSToHead(NUKE_CSS_DIR.'jquery.tooltipster.bundle.min.css','file');
addCSSToHead(NUKE_CSS_DIR.'jquery.tooltipster-sideTip-light.min.css','file');
addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.tooltipster.bundle.min.js','file', true);
$JStoHead  = '<script>'.PHP_EOL;
$JStoHead .= '	nuke_jq(function($)'.PHP_EOL;
$JStoHead .= '	{'.PHP_EOL;
$JStoHead .= '		$(".tooltip").tooltipster({'.PHP_EOL;
$JStoHead .= '			theme: "tooltipster-'.(($ThemeInfo['recaptcha_skin'] == 'white') ? 'light' : 'default').'",'.PHP_EOL;
$JStoHead .= '			animation: "grow",'.PHP_EOL;
$JStoHead .= '		});'.PHP_EOL;

$JStoHead .= '		$(".tooltip-left").tooltipster({'.PHP_EOL;
$JStoHead .= '			theme: "tooltipster-'.(($ThemeInfo['recaptcha_skin'] == 'white') ? 'light' : 'default').'",'.PHP_EOL;
$JStoHead .= '			animation: "grow",'.PHP_EOL;
$JStoHead .= '			side: "left",'.PHP_EOL;
$JStoHead .= '		});'.PHP_EOL;

# interact normal
$JStoHead .= '		$(".tooltip-interact").tooltipster({'.PHP_EOL;
$JStoHead .= '			theme: "tooltipster-'.(($ThemeInfo['recaptcha_skin'] == 'white') ? 'light' : 'default').'",'.PHP_EOL;
$JStoHead .= '			contentAsHTML: true,'.PHP_EOL;
$JStoHead .= '			animation: "grow",'.PHP_EOL;
$JStoHead .= '			interactive: true'.PHP_EOL;
$JStoHead .= '		});'.PHP_EOL;

$JStoHead .= '		$(".tooltip-html").tooltipster({'.PHP_EOL;
$JStoHead .= '			theme: "tooltipster-'.(($ThemeInfo['recaptcha_skin'] == 'white') ? 'light' : 'default').'",'.PHP_EOL;
$JStoHead .= '			contentAsHTML: true,'.PHP_EOL;
$JStoHead .= '			animation: "grow",'.PHP_EOL;
$JStoHead .= '		});'.PHP_EOL;

$JStoHead .= '		$(".tooltip-html-side").tooltipster({'.PHP_EOL;
$JStoHead .= '			theme: "tooltipster-'.(($ThemeInfo['recaptcha_skin'] == 'white') ? 'light' : 'default').'",'.PHP_EOL;
$JStoHead .= '			contentAsHTML: true,'.PHP_EOL;
$JStoHead .= '			animation: "grow",'.PHP_EOL;
$JStoHead .= '			side: "left",'.PHP_EOL;
$JStoHead .= '		});'.PHP_EOL;

$JStoHead .= '		$(".tooltip-html-side-interact").tooltipster({'.PHP_EOL;
$JStoHead .= '			theme: "tooltipster-'.(($ThemeInfo['recaptcha_skin'] == 'white') ? 'light' : 'default').'",'.PHP_EOL;
$JStoHead .= '			contentAsHTML: true,'.PHP_EOL;
$JStoHead .= '			animation: "grow",'.PHP_EOL;
$JStoHead .= '			interactive: true,'.PHP_EOL;
$JStoHead .= '			side: "left",'.PHP_EOL;
$JStoHead .= '		});'.PHP_EOL;

$JStoHead .= '	});'.PHP_EOL;
$JStoHead .= '</script>'.PHP_EOL;
addJSToBody($JStoHead,'inline');

?>