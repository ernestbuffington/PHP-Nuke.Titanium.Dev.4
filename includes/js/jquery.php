<?php
/*
|-----------------------------------------------------------------------
|	AUTHOR 				:	jQuery
|	VERSION 			:	3.5.1
|----------------------------------------------------------------------
*/
if(!defined('NUKE_FILE')) 
die('Access forbbiden');

global $fwysiwyg, $wysiwyg;
echo "\n<!-- Loading Font Awesome Solid + Brands from includes/js/jquery.php -->\n";
add_css_to_head('assets/fontawesome-free-6.2.0-web/css/all.css','file', '5.8.1');
add_css_to_head('assets/fontawesome-free-6.2.0-web/css/all.min.css','file');

echo "<!-- Loading Bootstrap Icons v1.9.1 from includes/js/jquery.php -->\n";
add_css_to_head('assets/bootstrap-icons-1.9.1/bootstrap-icons.css','file');

# Devicon 2.0
# Devicon is a set of icons representing programming languages, designing & 
# development tools. You can use it as a font or directly copy/paste the 
# svg code into your project.
echo "<!-- Loading Devicon v2.15.1 from CDN includes/js/jquery.php -->\n";
addCSSToHead('//cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css','file');

echo "<!-- Loading font-awesome-animation.min.css from includes/js/jquery.php -->\n";
add_css_to_head(NUKE_CSS_DIR.'fontawesome/font-awesome-animation.min.css','file');

if(defined('ENABLE_JQUERY_UI')):
 echo "<!-- Loading jquery.ui.css from includes/js/jquery.php (ENABLE_JQUERY_UI is defined)-->\n";
 add_css_to_head(NUKE_CSS_DIR.'jquery.ui.css','file', '1.12.0');
endif;

 echo "<!-- Loading jquery-migrate-3.4.0.min.js from includes/js/jquery.php -->\n";
# addJSToHead('//code.jquery.com/jquery-compat-git.js','file'); # Original loaded with Evo 2.x
#add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery-migrate-3.4.0.js','file','3.4.0'); # Development Migrate 11/19/2022
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery-migrate-3.4.0.min.js','file','3.4.0'); # Production Migrate 11/19/2022

#addJSToHead('//code.jquery.com/jquery-compat-git.js','file'); # This is same as jquery-migrate-3.4.0.min.js

echo "<!-- Loading jquery.pause.js from CDN includes/js/jquery.php -->\n";
addJSToHead('//rawgithub.com/tobia/Pause/master/jquery.pause.js','file');

echo "<!-- Loading jquery.marquee.min.js v1.3.1 from CDN includes/js/jquery.php -->\n";
addJSToHead('//cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js','file');

echo "<!-- Loading Marquee inline JavaScript from includes/js/jquery.php -->\n";
$JStoHead  = '<script>//<![CDATA['.PHP_EOL;
$JStoHead .= '$(window).on("load", function() {'.PHP_EOL;
$JStoHead .= '$(function () {'.PHP_EOL;
$JStoHead .= '$(".marquee_one").marquee({'.PHP_EOL;
$JStoHead .= 'speed: 5000,'.PHP_EOL;
$JStoHead .= 'gap: 481,'.PHP_EOL;
$JStoHead .= 'delayBeforeStart: 0,'.PHP_EOL;
$JStoHead .= 'direction: "left",'.PHP_EOL;
$JStoHead .= 'duplicated: false,'.PHP_EOL;
$JStoHead .= 'pauseOnHover: true'.PHP_EOL;
$JStoHead .= '});'.PHP_EOL;
$JStoHead .= '});'.PHP_EOL;
$JStoHead .= '});'.PHP_EOL;
$JStoHead .= '//]]></script>'.PHP_EOL;
addJSToHead($JStoHead,'inline');
$JStoHead  = '<script>//<![CDATA['.PHP_EOL;
$JStoHead .= '$(window).on("load", function() {'.PHP_EOL;
$JStoHead .= '$(function () {'.PHP_EOL;
$JStoHead .= '$(".marquee_two").marquee({'.PHP_EOL;
$JStoHead .= 'speed: 5000,'.PHP_EOL;
$JStoHead .= 'gap: 481,'.PHP_EOL;
$JStoHead .= 'delayBeforeStart: 0,'.PHP_EOL;
$JStoHead .= 'direction: "left",'.PHP_EOL;
$JStoHead .= 'duplicated: false,'.PHP_EOL;
$JStoHead .= 'pauseOnHover: true'.PHP_EOL;
$JStoHead .= '});'.PHP_EOL;
$JStoHead .= '});'.PHP_EOL;
$JStoHead .= '});'.PHP_EOL;
$JStoHead .= '//]]></script>'.PHP_EOL;
addJSToHead($JStoHead,'inline');

echo "<!-- Loading html5shiv.min.js v3.7.3 from includes/js/jquery.php -->\n";
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'html5shiv.min.js','file','3.7.3');

echo "<!-- Loading jquery.min.js v3.5.1 from includes/js/jquery.php -->\n";
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.min.js','file','3.5.1');

if ( defined('ENABLE_JQUERY_UI') ):
 echo "<!-- Loading jquery-ui.min.js v1.12.0 from includes/js/jquery.php (ENABLE_JQUERY_UI is enabked)-->\n";
 add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery-ui.min.js','file','1.12.0');
endif;

//add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery-migrate.min.js','file','3.0.0');

$JStoHead  = '<script>'.PHP_EOL;
$JStoHead .= 'var nuke_jq = jQuery.noConflict();'.PHP_EOL;

if(is_admin())
$JStoHead .= 'var admin_file = "'.$admin_file.'";'.PHP_EOL;

$JStoHead .= '</script>'.PHP_EOL;
add_js_to_head($JStoHead,'inline');

echo "<!-- Loading jquery.easing.min.js v0 from includes/js/jquery.php -->\n";
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.easing.min.js','file');

echo "<!-- Loading jquery.fn.extend.js v0 from includes/js/jquery.php -->\n";
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.fn.extend.js','file');

echo "<!-- Loading jquery.core.js v0 from includes/js/jquery.php -->\n";
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.core.js','file');

echo "<!-- Loading cookieconsent.min.css v0 from includes/js/jquery.php -->\n";
add_css_to_head(NUKE_CSS_DIR.'cookieconsent.min.css','file');

echo "<!-- Loading cookieconsent.min.js v0 from includes/js/jquery.php -->\n";
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'cookieconsent.min.js','file');

echo "<!-- Loading Cookie Consent JavaScript from includes/js/jquery.php -->\n";
$cookieconsent_inline  = '<script>'.PHP_EOL;
$cookieconsent_inline .= 'window.addEventListener("load", function(){'.PHP_EOL;
$cookieconsent_inline .= 'window.cookieconsent.initialise({'.PHP_EOL;
$cookieconsent_inline .= '"palette": {'.PHP_EOL;
$cookieconsent_inline .= '"popup": {'.PHP_EOL;
$cookieconsent_inline .= '"background": "#000",'.PHP_EOL;
$cookieconsent_inline .= '"text": "#0f0"'.PHP_EOL;
$cookieconsent_inline .= '},'.PHP_EOL;
$cookieconsent_inline .= '"button": {'.PHP_EOL;
$cookieconsent_inline .= '"background": "#0f0"'.PHP_EOL;
$cookieconsent_inline .= '}'.PHP_EOL;
$cookieconsent_inline .= '},'.PHP_EOL;
$cookieconsent_inline .= '"theme": "classic"'.PHP_EOL;
$cookieconsent_inline .= '})});'.PHP_EOL;
$cookieconsent_inline .= '</script>'.PHP_EOL;
add_js_to_head($cookieconsent_inline,'inline');

echo "<!-- Loading Progress Bar JavaScript from includes/js/jquery.php -->\n";
$progress_bar_loading  = '<script>'.PHP_EOL;
$progress_bar_loading .= 'nuke_jq(function($)'.PHP_EOL;
$progress_bar_loading .= '{'.PHP_EOL;
$progress_bar_loading .= '$(".progress-bar > span").each(function() {$(this).width(0).animate({width: $(this).data("percentage")+"%"}, 1200);});'.PHP_EOL;
$progress_bar_loading .= '});'.PHP_EOL;
$progress_bar_loading .= '</script>'.PHP_EOL;
add_js_to_body($progress_bar_loading,'inline');

echo "<!-- Loading jquery.marquee.js from includes/js/jquery.php -->\n";
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.marquee.js','file');

$jquery_marquee  = '<script>'.PHP_EOL;
$jquery_marquee .= 'nuke_jq("[data-marquee]").marquee({
    direction: "up",
});';
$jquery_marquee .= '</script>'.PHP_EOL;
add_js_to_body($jquery_marquee,'inline');
?>
