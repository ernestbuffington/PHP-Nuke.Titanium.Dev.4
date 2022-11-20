<?php
/**
 * jQuery lightbox and modal window plugin.
 *
 * @package jquery-colorbox
 * @author  Jack Moore <hello@jacklmoore.com>
 * @version 1.6.4
 * @license GPL-3.0
 * @link    http://www.jacklmoore.com/colorbox
 */

if(!defined('NUKE_FILE')) 
	die('Access forbbiden');

/*
	USEAGE - SINGLE IMAGE 					: <a data-colorbox href="images/fullsize/mypicture.jpg">View my Picture</a>
	USEAGE - SINGLE IMAGE WITH CAPTION 		: <a data-colorbox title="caption will go here" href="images/fullsize/mypicture.jpg">View my Picture</a>
	
	USEAGE - MULTIPLE IMAGES 				: <a data-colorbox rel="group" href="images/fullsize/mypicture.jpg">View my Picture</a>
	USEAGE - MULTIPLE IMAGES WITH CAPTION 	: <a data-colorbox rel="group" title="caption will go here" href="images/fullsize/mypicture.jpg">View my Picture</a>
*/

# Because of the way the image viewers and been coded, Only the image viewer that you specify in the plugin area of the ACP,
# will be active, But not to worry you can force the load of this image viewer by adding the following to your mod.
# define('_force_colorbox_load',true);
# Then use the examples added above to use this image viewer.

# this is just to stop any errors from occuring, DO NOT EDIT THE DEFINE BELOW
if(!defined('_force_colorbox_load')):
	define('_force_colorbox_load',false);
endif;

if ( _force_colorbox_load || get_evo_option('img_viewer') == 'colorbox' ):

	addCSSToHead(NUKE_CSS_DIR.'jquery.colorbox.min.css','file');
	addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.colorbox.min.js','file');
	$JStoHead  = '<script>'.PHP_EOL;
	$JStoHead .= 'nuke_jq(function($)'.PHP_EOL;
	$JStoHead .= '{'.PHP_EOL;
	# The following code was added so colorbox can be added dynamically to images and links
	$JStoHead .= '	$("body").on("click", "[data-colorbox]", function()'.PHP_EOL;
	$JStoHead .= '	{'.PHP_EOL;
    $JStoHead .= '		$("[data-colorbox]").colorbox({'.PHP_EOL;
    $JStoHead .= '			maxWidth: "100%",'.PHP_EOL;
	$JStoHead .= '			maxHeight: "100%",'.PHP_EOL;
	$JStoHead .= '			loop: false,'.PHP_EOL;
	$JStoHead .= '			transition: "elastic",'.PHP_EOL;
	$JStoHead .= '			speed: "350",'.PHP_EOL;
    $JStoHead .= '		});'.PHP_EOL;
	$JStoHead .= '	});'.PHP_EOL;
	$JStoHead .= '});'.PHP_EOL;
	$JStoHead .= '</script>'.PHP_EOL;
	addJSToBody($JStoHead,'inline');

endif;

?>