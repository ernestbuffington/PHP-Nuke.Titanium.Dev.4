<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
	Filename      : styles.php
	Author        : The Nuke-Evolution Team
	Version       : 1.5.0
	Date          : 12.14.2005 (mm.dd.yyyy)

	Notes         : Miscellaneous CSS
 ************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
exit('Access Denied');

global $ThemeInfo;

/* here are the core forum css changes */
$core_css  = '<style>'."\n";

# The below css is for use with admin/blocks.php & admin/modules.php
if (defined('ADMIN_FILE')) 
{
    $core_css .= '#l, #c, #d, #r, #new { width: 200px; float: left; margin-left: 5px; }' . "\n";
    $core_css .= '#new { float: none; }' . "\n";
    $core_css .= 'div.menu { list-style-type: none; position: relative; padding: 4px 4px 0 4px; margin: 0px; width: 200px; font-size: 13px; font-family: Arial, sans-serif; border: 1px solid #ccc; }' . "\n";

    $core_css .= 'ul.sortable { min-height: 30px; }'."\n";

    $core_css .= 'ul.sortable li { position: relative; }' . "\n";
    $core_css .= 'ul.boxy { list-style-type: none; padding: 4px 4px 0 4px; margin: 0px; width: 13em; font-size: 13px; border: 1px solid #ccc; text-align: left; }' . "\n";
    // $core_css .= 'li.active { cursor: move; margin-bottom: 4px; padding: 2px 2px; border: 1px solid #ccc; }' . "\n";
    $core_css .= 'li.inactive { cursor: move; margin-bottom: 4px; padding: 2px; border: 1px solid #ccc; background-color: #bf0909; }' . "\n";
    $core_css .= 'ul.boxy li { cursor: move; margin-bottom: 4px; padding: 2px 2px; border: 1px solid #ccc; }' . "\n";
    $core_css .= '#left_col { width: 180px; float: left; margin-left: 5px; }' . "\n";
    $core_css .= '#center { width: 180px; float: left;  margin-left: 5px; }' . "\n";
    $core_css .= '#right_col { width: 180px; float: left;  margin-left: 5px; }' . "\n";
    $core_css .= '#sajax1 { width: 180px;  float: left;  margin-left: 5px; }' . "\n";
    $core_css .= '#sajax2 {  width: 180px; float: left;  margin-left: 5px; }'. "\n";
}

$core_css .= '.forum-emoticon.pointer {cursor:pointer}';

// $core_css .= '.user_tooltip        {padding-left: 10px}';
$core_css .= '.user_tooltip > span {float:right}'."\n";

$core_css .= '.textmed            { font-size: 11px }'."\n";
$core_css .= '.textbold           { font-weight: bold; }'."\n";
$core_css .= '.texterror          { font-weight: bold; color: #FF0000; font-size: large; }'."\n";
$core_css .= '.texterrorcenter    { font-weight: bold;  color: #FF0000; text-align: center; font-size: large; }'."\n";
$core_css .= '.nuketitle          { font-weight: bold; text-align: center; font-size: x-large; }'."\n";
$core_css .= '.switchcontent      { border-top-width: 0; }'."\n";
$core_css .= '.switchclosecontent { border-top-width: 0; display: none; }'."\n";

$core_css .= 'td.cat, td.catHead, td.catSides, td.catLeft, td.catRight, td.catBottom, td.row1, td.row2, td.row3 { margin-left: 4px; height: 30px; }'."\n";

$core_css .= '.float-right        { float: right; }'."\n";

$core_css .= '.acenter            { text-align: center; }'."\n";
$core_css .= '.acenteru           { text-align: center; text-transform: uppercase; }'."\n";
$core_css .= '.aright             { text-align: right; }'."\n";
$core_css .= '.arightu            { text-align: right; text-transform: uppercase; }'."\n";
$core_css .= '.aleft              { text-align: left; }'."\n";
$core_css .= '.aleftu             { text-align: left; text-transform: uppercase; }'."\n";
$core_css .= '.tfixed             { table-layout: fixed; word-wrap: break-word; }'."\n";
$core_css .= '.clear              { clear: both; }'."\n";
$core_css .= '.helpline           { cursor: help; width: 99.8% !important; padding-left: 7px; }'."\n";

/**
 * Customize css: Style individual font awesome icons.
 * @since 2.0.9e
 */
$core_css .= '.fa                       {font-size:16px; transition: all 0.3s ease-in-out;}';
$core_css .= '.fa-trash-alt:hover       {color: red !important;}';
$core_css .= '.fa-times-circle:hover    {color: red !important;}';
$core_css .= '.fa-right-arrows          {font-size: 12px !important;font-weight: bold;color: '.$ThemeInfo['uitotophover'].';}';

/**
 * Customize css: Styles the progress bar, which is used throughout the CMS.
 * @since 2.0.9e
 */
$core_css .= '.progress-bar       {background-color:#1a1a1a;height:15px;padding:1px;width:350px}'."\n";
$core_css .= '.progress-bar span  {display:inline-block;height:100%;box-shadow:0 1px 0 rgba(255,255,255,.5) inset;transition:width .4s ease-in-out}'."\n";

$core_css .= '.blue span          {background-color:#34c2e3}'."\n";
$core_css .= '.orange span        {background-color:#a07f06}'."\n";
$core_css .= '.red span           {background-color:#c30909}'."\n";
$core_css .= '.green span         {background-color:#324900}'."\n";

$core_css .= '.stripes span       {background-size:30px 30px;background-image:linear-gradient(135deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);animation:animate-stripes 3s linear infinite}'."\n";
$core_css .= '@keyframes animate-stripes {0%{background-position:0 0}100%{background-position:60px 0}}'."\n";

$core_css .= '.shine span         {position:relative}'."\n";
$core_css .= '.shine span::after  {content:\'\';opacity:0;position:absolute;top:0;right:0;bottom:0;left:0;background:#fff;animation:animate-shine 2s ease-out infinite}'."\n";
$core_css .= '.glow span          {box-shadow:0 5px 5px rgba(255,255,255,.7) inset,0 -5px 5px rgba(255,255,255,.7) inset;animation:animate-glow 1s ease-out infinite}'."\n";

$core_css .= '@keyframes animate-shine {0%{opacity:0;width:0}50%{opacity:.5}100%{opacity:0;width:95%}}'."\n";
$core_css .= '@keyframes animate-glow  {0%{box-shadow:0 5px 5px rgba(255,255,255,.7) inset,0 -5px 5px rgba(255,255,255,.7) inset}50%{box-shadow:0 5px 5px rgba(255,255,255,.3) inset,0 -5px 5px rgba(255,255,255,.3) inset}100%{box-shadow:0 5px 5px rgba(255,255,255,.7) inset,0 -5px 5px rgba(255,255,255,.7) inset}}'."\n";

$core_css .= '.col-12{width:100%}';
$core_css .= '.col-11{width:91.66666667%}';
$core_css .= '.col-10{width:83.33333333%}';
$core_css .= '.col-9{width:75%}';
$core_css .= '.col-8{width:66.66666667%}';
$core_css .= '.col-7{width:58.33333333%}';
$core_css .= '.col-6{width:50%}';
$core_css .= '.col-5{width:41.66666667%}';
$core_css .= '.col-4{width:33.33333333%}';
$core_css .= '.col-3{width:25%}';
$core_css .= '.col-2{width:16.66666667%}';
$core_css .= '.col-1{width:8.33333333%}';

$core_css .= '.text-primary{color:#007bff}';
$core_css .= '.text-secondary{color:#6c757d}';
$core_css .= '.text-success{color:#28a745}';
$core_css .= '.text-danger{color:#bd2130}';
$core_css .= '.text-warning{color:#d39e00}';
$core_css .= '.text-info{color:#17a2b8}';

$core_css .= '.marquee{overflow:hidden;text-align:center;}';

$core_css .= '.fade-effect {cursor: pointer;opacity: 0.5;transition: opacity .25s ease-in-out;-moz-transition: opacity .25s ease-in-out;-webkit-transition: opacity .25s ease-in-out;}';
$core_css .= '.fade-effect:hover {opacity: 1;}';

$core_css .= '</style>' . "\n";
addCSSToHead($core_css,'inline');

/**
 * Customize css: Added most of the icons that are used in Evolution Xtreme into a sprite.
 * @since 2.0.9e
 */
addCSSToHead(NUKE_CSS_DIR.'images.core.css','file');
addCSSToHead(NUKE_CSS_DIR.'images.16x16-flags.css','file');
addCSSToHead(NUKE_CSS_DIR.'images.rating-stars.css','file');
// addCSSToHead(NUKE_CSS_DIR.'images.user_profile.css','file');

?>