<?php
/**
 * Scroll back to top script.
 *
 * A floating button link will appear when you scroll down the page.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @filename jquery.scroll.to.top.php
 * @version 1.0.0
 * @license GPL-3.0
 */

if(!defined('NUKE_FILE')) 
	die('Access forbbiden');

global $ThemeInfo, $customlang;
$back_to_top_inline_css  = '<!-- Inline CSS for back to top v1.0 -->'.PHP_EOL;
$back_to_top_inline_css .= '<style>'.PHP_EOL;
$back_to_top_inline_css .= '#back-to-top{border-radius:100%;bottom:24px;cursor:pointer;display:block;font-size:18px;height:36px;line-height:34px;overflow:hidden;position:fixed;right:-40px;text-align:center;-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0);-webkit-transition:background-color .18s cubic-bezier(0.6,0,0.1,1),box-shadow .18s cubic-bezier(0.6,0,0.1,1),-webkit-transform .18s cubic-bezier(0.6,0,0.1,1);transition:background-color .18s cubic-bezier(0.6,0,0.1,1),box-shadow .18s cubic-bezier(0.6,0,0.1,1),transform .18s cubic-bezier(0.6,0,0.1,1);width:36px;z-index:1}'.PHP_EOL;
$back_to_top_inline_css .= '#back-to-top.btt-visible{-webkit-transform:translate3d(-58px,0,0);transform:translate3d(-58px,0,0)}'.PHP_EOL;
$back_to_top_inline_css .= '#back-to-top{background-color:#222;color:#fafafa;border:1px solid}'.PHP_EOL;
$back_to_top_inline_css .= '#back-to-top:hover{background-color: '.(($ThemeInfo['uitotophover']) ? $ThemeInfo['uitotophover'] : '#000000').';color:#FAFAFA;}'.PHP_EOL;
$back_to_top_inline_css .= '#back-to-top .fa-angle-double-up{font-size: 20px;padding:8px;}'.PHP_EOL;
$back_to_top_inline_css .= '</style>'.PHP_EOL;
addCSSToHead($back_to_top_inline_css,'inline');

$back_to_top_inline_js  = '<script>'.PHP_EOL;
$back_to_top_inline_js .= 'nuke_jq(document).ready(function($)'.PHP_EOL;
$back_to_top_inline_js .= '{'.PHP_EOL;
$back_to_top_inline_js .= '		$("body").append("<div id=\'back-to-top\'><i class=\'fa fa-angle-double-up tooltip-left\' title=\''.$customlang['back_to_top']['title'].'\'></i></div>");';
$back_to_top_inline_js .= '		$("#back-to-top").click(function(e)'.PHP_EOL;
$back_to_top_inline_js .= '		{'.PHP_EOL;
$back_to_top_inline_js .= '			e.preventDefault();'.PHP_EOL;
$back_to_top_inline_js .= '			$("html, body").animate({'.PHP_EOL;
$back_to_top_inline_js .= '				scrollTop: 0'.PHP_EOL;
$back_to_top_inline_js .= '			}, 400);'.PHP_EOL;
$back_to_top_inline_js .= '		});'.PHP_EOL;
$back_to_top_inline_js .= '		$(window).on("scroll load", function() {'.PHP_EOL;
$back_to_top_inline_js .= '			var y = $(this).scrollTop();'.PHP_EOL;
$back_to_top_inline_js .= '			if (y > 164) {'.PHP_EOL;
$back_to_top_inline_js .= '				$("#back-to-top").addClass("btt-visible");'.PHP_EOL;
$back_to_top_inline_js .= '			} else {'.PHP_EOL;
$back_to_top_inline_js .= '				$("#back-to-top").removeClass("btt-visible");'.PHP_EOL;
$back_to_top_inline_js .= '			}'.PHP_EOL;
$back_to_top_inline_js .= '		});'.PHP_EOL;
$back_to_top_inline_js .= '});'.PHP_EOL;
$back_to_top_inline_js .= '</script>'.PHP_EOL;	
addJSToBody($back_to_top_inline_js,'inline');

?>