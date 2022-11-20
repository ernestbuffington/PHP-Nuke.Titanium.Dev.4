<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2017 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	jQuery News Feed
|----------------------------------------------------------------------
*/

// if(!defined('NUKE_FILE')) die('Access forbbiden');

//---------------------------------------------------------------------
//  JQUERY FLOATING ADMIN MENU
//---------------------------------------------------------------------
global $ThemeSel, $img_resize, $ThemeSel;
if ($img_resize) 
{
	global $img_width, $img_height, $board_config;
	$JStoBody  = '<script>'.PHP_EOL;

	if (!defined('IN_PHPBB'))
		$JStoBody .= '  var reimg_maxWidth          = '.$img_width.', reimg_maxHeight = '.$img_height.', reimg_relWidth = 0;'.PHP_EOL;
	else
		$JStoBody .= '  var reimg_maxWidth          = '.$board_config['image_resize_width'].', reimg_maxHeight = '.$board_config['image_resize_height'].', reimg_relWidth = 0;'.PHP_EOL;
	$JStoBody .= '  var reimg_swapPortrait      = true;'.PHP_EOL;
	$JStoBody .= '  var reimg_loadingImg        = "images/spacer.gif";'.PHP_EOL;
	$JStoBody .= '  var reimg_loadingStyle      = "width: 126px; height: 22px; background: url(./includes/css/images/reimg-image-resizer/loading.gif) top left no-repeat;";'.PHP_EOL;
	$JStoBody .= '  var reimg_loadingAlt        = "Loading...";'.PHP_EOL;
	$JStoBody .= '  var reimg_borderBackground  = true;'.PHP_EOL;
	$JStoBody .= '  var reimg_autoLink          = true;'.PHP_EOL;
	$JStoBody .= '  var reimg_zoomImg           = false;'.PHP_EOL; # USE THE FOLLOWING IF YOU WANNA SHOW THE BUTTON "images/spacer.gif"
	$JStoBody .= '  var reimg_zoomStyle         = "margin-top:8px; margin-left:8px; background-image: url(./includes/css/images/reimg-image-resizer/button.png); background-repeat: no-repeat; display: block; width: 48px; height: 39px; background-position: 0 0;";'.PHP_EOL;
	$JStoBody .= '  var reimg_zoomHover         = "margin-top:8px; margin-left:8px; background-image: url(./includes/css/images/reimg-image-resizer/button.png); background-repeat: no-repeat; display: block; width: 48px; height: 39px; background-position: -48px 0;";'.PHP_EOL;
	$JStoBody .= '  var reimg_zoomAlt           = "Zoom in (real dimensions: %1$d x %2$d)";'.PHP_EOL;
	$JStoBody .= '  var reimg_zoomTarget        = "_blank";'.PHP_EOL;

	$JStoBody .= '  var reimage_viewer			= "'.get_evo_option('img_viewer').'";'.PHP_EOL;

	$JStoBody .= '  function reimg(img, width, height)'.PHP_EOL;
	$JStoBody .= '  {'.PHP_EOL;
	$JStoBody .= '      if (window.reimg_version)'.PHP_EOL;
	$JStoBody .= '      {'.PHP_EOL;
	$JStoBody .= '          reimg_resize(img, width, height);'.PHP_EOL;
	$JStoBody .= '      }'.PHP_EOL;
	$JStoBody .= '  }'.PHP_EOL;	
	$JStoBody .= '</script>'.PHP_EOL;
	addJSToHead($JStoBody,'inline');
	addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'jquery.reimg.image.resizer.js','file');
}

?>