<?php
/**
 * Lightweight, accessible and responsive lightbox.
 *
 * @package lity
 * @author  Jan Sorgalla
 * @version 2.3.1
 * @license MIT
 * @link    http://sorgalla.com/lity/
 */

if(!defined('NUKE_FILE')) 
	die('Access forbbiden');

/*	
	USEAGE - SINGLE IMAGE 					: <a data-lightbox-lite href="images/fullsize/mypicture.jpg">View my Picture</a>
	USEAGE - SINGLE IMAGE WITH TITLE 		: <a data-lightbox data-title="title/caption will go here" href="images/fullsize/mypicture.jpg">View my Picture</a>

	USEAGE - MULTIPLE IMAGES 				: <a data-lightbox="group" href="images/fullsize/mypicture.jpg">View my Picture</a>
	USEAGE - MULTIPLE IMAGES WITH TITLE 	: <a data-lightbox="group" data-title="title/caption will go here" href="images/fullsize/mypicture.jpg">View my Picture</a>
*/

# Because of the way the image viewers and been coded, Only the image viewer that you specify in the plugin area of the ACP,
# will be active, But not to worry you can force the load of this image viewer by adding the following to your mod.
# define('_force_lightbox_load',true);
# Then use the examples added above to use this image viewer.

# this is just to stop any errors from occuring, DO NOT EDIT THE DEFINE BELOW
if(!defined('_force_lightbox_lite_load')):
	define('_force_lightbox_lite_load',false);
endif;

if ( _force_lightbox_lite_load || get_evo_option('img_viewer') == 'lightbox-lite' ):

	addCSSToHead(NUKE_CSS_DIR.'jquery.lightbox.lite.min.css','file');
	addCSSToHead(NUKE_CSS_DIR.'jquery.lightbox.lite.minimal.css','file');
	addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.lightbox.lite.min.js','file');

	$lc_light_lite_inline_js  = '<!-- Inline jQuery for LC Lightbox Lite -->';
	$lc_light_lite_inline_js .= '<script>'.PHP_EOL;
	$lc_light_lite_inline_js .= 'nuke_jq(function($)'.PHP_EOL;
	$lc_light_lite_inline_js .= '{'.PHP_EOL;
	
	$lc_light_lite_inline_js .= '	lc_lightbox("[data-lightbox-lite]", {'.PHP_EOL;
	$lc_light_lite_inline_js .= '		gallery     	: true,'.PHP_EOL;
	$lc_light_lite_inline_js .= '		gallery_hook 	: "rel",'.PHP_EOL;
	$lc_light_lite_inline_js .= '		slideshow   	: true,'.PHP_EOL;
	$lc_light_lite_inline_js .= '		src_attr    	: "href",'.PHP_EOL;
	$lc_light_lite_inline_js .= '		skin			: "minimal",'.PHP_EOL;
	$lc_light_lite_inline_js .= '		mousewheel    	: true,'.PHP_EOL;
	$lc_light_lite_inline_js .= '		fullscreen    	: true,'.PHP_EOL;
	$lc_light_lite_inline_js .= '		download    	: true,'.PHP_EOL;
	$lc_light_lite_inline_js .= '	});'.PHP_EOL;

	$lc_light_lite_inline_js .= '});'.PHP_EOL;
	$lc_light_lite_inline_js .= '</script>'.PHP_EOL;
	addJSToBody($lc_light_lite_inline_js,'inline');

endif;

?>