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
add_css_to_head(NUKE_CSS_DIR.'fontawesome/all.css','file', '5.8.1');
echo "\n<!-- LOADED includes/css/fontawesome/all.css -->\n";
# Devicon 2.0
# Devicon is a set of icons representing programming languages, designing & 
# development tools. You can use it as a font or directly copy/paste the 
# svg code into your project.
addCSSToHead('//cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css','file');
echo "<!-- LOADED //cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css -->\n";

add_css_to_head(NUKE_CSS_DIR.'fontawesome/font-awesome-animation.min.css','file');
echo "<!-- LOADED includes/fontawesome/font-awesome-animation.min.css FROM includes/js/jquery.php -->\n";

if(defined('ENABLE_JQUERY_UI')):
add_css_to_head(NUKE_CSS_DIR.'jquery.ui.css','file', '1.12.0');
echo "<!-- LOADED  includes/css/jquery.ui.css FROM includes/js/jquery.php -->\n";
else:
echo "<!-- NOT LOADED includes/css/jquery.ui.css (ENABLE_JQUERY_UI not defined!) FROM includes/js/jquery.php -->\n";
endif;

addJSToHead('//code.jquery.com/jquery-compat-git.js','file');
echo "<!-- LOADED //code.jquery.com/jquery-compat-git.js FROM includes/js/jquery.php -->\n";

addJSToHead('//rawgithub.com/tobia/Pause/master/jquery.pause.js','file');
echo "<!-- LOADED //rawgithub.com/tobia/Pause/master/jquery.pause.js FROM includes/js/jquery.php -->\n";

addJSToHead('//cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js','file');
echo "<!-- LOADED //cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js FROM includes/js/jquery.php -->\n";

$JStoHead  = '<script type="text/javascript">//<![CDATA['.PHP_EOL;
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
echo "<!-- LOADED marquee_one FROM includes/js/jquery.php -->\n";

$JStoHead  = '<script type="text/javascript">//<![CDATA['.PHP_EOL;
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
echo "<!-- LOADED marquee_two FROM includes/js/jquery.php -->\n";

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'html5shiv.min.js','file','3.7.3');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."html5shiv.min.js FROM includes/js/jquery.php -->\n";

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.min.js','file','3.5.1');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery.min.js FROM includes/js/jquery.php -->\n";

if(defined('ENABLE_JQUERY_UI')):
add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery-ui.min.js','file','1.12.0');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery-ui.min.js FROM includes/js/jquery.php -->\n";
else:
echo "<!-- NOT LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery-ui.min.js ENABLE_JQUERY_UI not defined! FROM includes/js/jquery.php -->\n";
endif;

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery-migrate.min.js','file','3.0.0');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery-migrate.min.js FROM includes/js/jquery.php -->\n";

$JStoHead  = '<script type="text/javascript">'.PHP_EOL;
$JStoHead .= 'var nuke_jq = jQuery.noConflict();'.PHP_EOL;
if(is_admin()):
$JStoHead .= 'var admin_file = "'.$admin_file.'";'.PHP_EOL;
echo "<!-- ADDED var admin_file = ".$admin_file."; WE ARE LOGGED IN AS ADMIN FROM includes/js/jquery.php -->\n";
endif;
$JStoHead .= '</script>'.PHP_EOL;
add_js_to_head($JStoHead,'inline');
echo "<!-- ADDED var nuke_jq = jQuery.noConflict(); FROM includes/js/jquery.php -->\n";

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.easing.min.js','file');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery.easing.min.js FROM includes/js/jquery.php -->\n";

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.fn.extend.js','file');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery.fn.extend.js FROM includes/js/jquery.php -->\n";

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.core.js','file');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery.core.js FROM includes/js/jquery.php -->\n";

add_css_to_head(NUKE_CSS_DIR.'cookieconsent.min.css','file');
echo "<!-- LOADED ".NUKE_CSS_DIR."cookieconsent.min.css FROM includes/js/jquery.php -->\n";

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'cookieconsent.min.js','file');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."cookieconsent.min.js FROM includes/js/jquery.php -->\n";

$cookieconsent_inline  = '<script>';
$cookieconsent_inline .= 'window.addEventListener("load", function(){';
$cookieconsent_inline .= 'window.cookieconsent.initialise({';
$cookieconsent_inline .= '"palette": {';
$cookieconsent_inline .= '"popup": {';
$cookieconsent_inline .= '"background": "#000",';
$cookieconsent_inline .= '"text": "#0f0"';
$cookieconsent_inline .= '},';
$cookieconsent_inline .= '"button": {';
$cookieconsent_inline .= '"background": "#0f0"';
$cookieconsent_inline .= '}';
$cookieconsent_inline .= '},';
$cookieconsent_inline .= '"theme": "classic"';
$cookieconsent_inline .= '})});';
$cookieconsent_inline .= '</script>';
add_js_to_head($cookieconsent_inline,'inline');
echo "<!-- LOADED Event Listener for Cookie Consent FROM includes/js/jquery.php -->\n";

$progress_bar_loading  = '<script type="text/javascript">'.PHP_EOL;
$progress_bar_loading .= 'nuke_jq(function($)';
$progress_bar_loading .= '{';
$progress_bar_loading .= '$(".progress-bar > span").each(function() {$(this).width(0).animate({width: $(this).data("percentage")+"%"}, 1200);});';
$progress_bar_loading .= '});';
$progress_bar_loading .= '</script>'.PHP_EOL;
add_js_to_body($progress_bar_loading,'inline');
echo "<!-- LOADED Event Listener for Progress Bar FROM includes/js/jquery.php -->\n";

add_js_to_head(NUKE_JQUERY_SCRIPTS_DIR.'jquery.marquee.js','file');
echo "<!-- LOADED ".NUKE_JQUERY_SCRIPTS_DIR."jquery.marquee.js FROM includes/js/jquery.php -->\n";

$jquery_marquee  = '<script type="text/javascript">'.PHP_EOL;
$jquery_marquee .= 'nuke_jq("[data-marquee]").marquee({
    direction: "up",
});';
$jquery_marquee .= '</script>'.PHP_EOL;
add_js_to_body($jquery_marquee,'inline');
echo "<!-- LOADED Inline Marquee FROM includes/js/jquery.php -->";
?>
