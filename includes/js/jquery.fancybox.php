<?php
/**
 * Touch enabled, responsive and fully customizable jQuery lightbox script.
 *
 * @package @fancyapps/fancybox
 * @author  fancyApps
 * @version 3.5.7
 * @license GPL-3.0
 * @link    https://fancyapps.com/fancybox/3/
 */

if(!defined('NUKE_FILE')) die('Access forbbiden');

/*
	USEAGE - SINGLE IMAGE 					: <a data-fancybox data-caption="My caption" href="image.jpg"><img src="large_image.jpg" alt="" /></a>
	USEAGE - SINGLE IMAGE THUMBNAILS		: <a data-fancybox data-caption="My caption" href="large_image.jpg"><img src="thumbnail_image.jpg" alt="" /></a>

	USEAGE - MULTIPLE IMAGES 				: <a data-fancybox="group" data-caption="Caption #1" href="image_1.jpg"><img src="image_1.jpgg" alt="" /></a>
	USEAGE - MULITPLE IMAGES THUMBNAILS 	: <a href="image.jpg" data-fancybox="images" data-caption="My caption"><img src="thumbnail.jpg" alt="" /></a>
	USEAGE - MULITPLE IMAGES WITH SIZES 	: <a href="image.jpg" data-fancybox="images" data-width="1920" data-height="1080"><img src="thumbnail.jpg" /></a>

	USEAGE - AJAX REQUEST 					: <a data-fancybox data-type="ajax" data-src="my_page.com/path/to/ajax/" href="javascript:;">AJAX content</a>
	USEAGE - IFRAME WEBPAGE 				: <a data-fancybox data-type="iframe" data-src="http://codepen.io/fancyapps/full/jyEGGG/" href="javascript:;">Webpage</a>
	USEAGE - IFRAME PDF 					: <a data-fancybox data-type="iframe" data-src="https://mozilla.github.io/pdf.js/web/viewer.html" href="javascript:;">Sample PDF</a>
	USEAGE - YOUTUBE VIDEO 					: <a data-fancybox href="https://www.youtube.com/watch?v=_sI_Ps7JSEk">YouTube video</a>
	USEAGE - VIMEO VIDEO 					: <a data-fancybox href="https://vimeo.com/191947042">Vimeo video</a>
	USEAGE - GOOGLE MAPS 					: <a data-fancybox href="https://www.google.com/maps/place/Googleplex/@37.4220041,-122.0833494,17z/data=!4m5!3m4!1s0x0:0x6c296c66619367e0!8m2!3d37.4219998!4d-122.0840572">Google Map</a>
	USEAGE - INSTAGRAM PHOTO 				: <a data-fancybox href="https://www.instagram.com/p/BNXYW8-goPI/?taken-by=jamesrelfdyer" data-caption="<span title=&quot;Edited&quot;>balloon rides at dawn ✨🎈<br>was such a magical experience floating over napa valley as the golden light hit the hills.<br><a href=&quot;https://www.instagram.com/jamesrelfdyer/&quot;>@jamesrelfdyer</a></span>">
	Instagram photo</a>
*/

# Because of the way the image viewers and been coded, Only the image viewer that you specify in the plugin area of the ACP,
# will be active, But not to worry you can force the load of this image viewer by adding the following to your mod.
# define('_force_fancybox_load',true);
# Then use the examples added above to use this image viewer.

# this is just to stop any errors from occuring, DO NOT EDIT THE DEFINE BELOW
if(!defined('_force_fancybox_load')):
	define('_force_fancybox_load',false);
endif;

if ( _force_fancybox_load || get_evo_option('img_viewer') == 'fancybox' ):

	addCSSToHead(NUKE_CSS_DIR.'jquery.fancybox.css','file');
	addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.fancybox.js','file');
	$JStoHead  = '<!-- Inline jQuery for Fancybox v3.1.20 -->';
	$JStoHead .= '<script>'.PHP_EOL;
	$JStoHead .= 'nuke_jq(function($)'.PHP_EOL;
	$JStoHead .= '{'.PHP_EOL;
	$JStoHead .= '	$("[data-fancybox]").fancybox({'.PHP_EOL;
	// opent he thumbnail navigation by default
	$JStoHead .= '	thumbs : {'.PHP_EOL;
	$JStoHead .= '		autoStart : false'.PHP_EOL;
	$JStoHead .= '	},'.PHP_EOL;
	// Open/close animation type
	// Possible values:
	//   false              - disable
	//   "zoom"             - (default) zoom images from/to thumbnail
	//   "fade"
	//   "zoom-in-out"
	$JStoHead .= '		animationEffect: "zoom",'.PHP_EOL;
	// Possible values:
	//   false              - disable
	//   "fade' 			- default
	//   "slide'
	//   "circular'
	//   "tube'
	//   "zoom-in-out'
	//   "rotate'
	//
	$JStoHead .= '		transitionEffect : "fade",'.PHP_EOL;
	// Disable right-click and use simple image protection for images
	$JStoHead .= '		protect: true'.PHP_EOL;
	$JStoHead .= '	});'.PHP_EOL;
	$JStoHead .= '});'.PHP_EOL;
	$JStoHead .= '</script>'.PHP_EOL;
	addJSToBody($JStoHead,'inline');

endif;

?>