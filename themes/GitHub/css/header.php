<?php
#---------------------------------------------------------------------------------------#
# HEADER FLYKIT CSS                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Right White Theme v1.0 (Fixed & Full Width)                                           #
#                                                                                       #
# Final Build Date 09/24/2022 Saturday 12:54am                                          #
#                                                                                       #
# A Very Nice White Theme Design.                                                       #
# Copyright © 2021 By: TheGhost AKA EABuffington                                        #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 09/24/2022 Saturday 12:54am (v1.0)                                        #
#                                                                                       #
# Credit goes to Lonestar On: 1st August, 2019 (v3.0)                                   #
# HTML5 Theme Code By: Lonestar (Lonestar-Modules.com)                                  #
#                                                                                       #
# Credit goes to TheMortal                                                              #
# For his CSS MENU                                                                      #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost & Sebastian                                                     #
# Web Site: https://www.86it.us                                                         #
# Purpose: PHP-Nuke Titanium | Nuke Evolution Xtreme                                    #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# Nuke Evolution Xtreme (c) 2010 : Enhanced PHP-Nuke Web Portal System                  #
# PHP-Nuke Titanium (c) 2021     : Enhanced PHP-Nuke Web Portal System                  #
#---------------------------------------------------------------------------------------#
#                                                                                       #
# Special Honorable Mentions                                                            #
#---------------------------------------------------------------------------------------#
# killigan                                                                              # 
# -[04/17/2010] Updated Nuke Sentinel to version 2.6.01                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# SgtLegend                                                                             #   
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
# -[04/18/2010] Updated the installer/upgrade files and display                         #
# -[04/19/2010] Improved load time for global variables                                 #
# -[04/21/2010] Upgraded Swift mail to version 4.0.6                                    #
# -[04/21/2010] Upgraded HTML Purifier to version 4                                     # 
#---------------------------------------------------------------------------------------#
# Technocrat                                                                            # 
# -[04/22/2010] Added speed tweaks to the cache and PHP version compare                 #  
#---------------------------------------------------------------------------------------#
# Eyecu                                                                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# Wolfstar                                                                              # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#

global $theme_name;

echo "\n\n/* Universal/css/header.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $font_color, $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
global $font_colorH, $font_colorV, $font_colorA, $font_colorL, $body_color; 


?>

input[type="radio"]{
    vertical-align: bottom;
}

.absmiddle{
    vertical-align: absmiddle;
}

/*---------------------------------------------------------------*/
/* Forum Attachements                                            */
/*---------------------------------------------------------------*/
td.attachrowZ        
{ 
#font: normal 11px Verdana, Arial, Helvetica, sans-serif; color : <?=$textcolor1?>; 
border-color : <?=$bgcolor4?>; 
}
td.attachheaderZ     
{ 
#font: normal 11px Verdana, Arial, Helvetica, sans-serif; color : <?=$textcolor1?>; 
border-color : <?=$bgcolor4?>; 
background-color: <?=$bgcolor1?>; 
}
table.attachtableZ    
{ 
#font: normal 12px Verdana, Arial, Helvetica, sans-serif; color : <?=$textcolor1?>; 
border-color : <?=$bgcolor4?>;    
border-collapse : collapse; 
}
/*---------------------------------------------------------------*/
/* Main Theme Body                                               */
/*---------------------------------------------------------------*/
.button {
  background-color: <?=$bgcolor1?>;
  border: none;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}

a.redalert:link {text-decoration: underline; color: crimson;}
a.redalert:visited {text-decoration: underline; color: crimson;}
a.redalert:hover {text-decoration: underline; color: green;}

.alert {
  position: absolute;
  top: 217px; // Should be same as the height of the header
  width: 100%;
}

fieldset 
{
	display: block; 
	margin-left: 2px; 
	margin-right: 2px; 
	padding-top: 0.15em; 
	padding-bottom: 0.625em; 
	padding-left: 0.75em; 
	padding-right: 0.75em; 
	border: 2px groove (internal value);

   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;

}

hr {
	background-color: <?=$bgcolor5?>;
	border: 0;
	height: 1px;
	margin: 5px 0;
	width: 100%;
   /* #opacity: 0.4; */

}

   
.outer_table_opacity
{
  /* opacity: 0.9; */
}
.inferno_header_table
{
  /* opacity: 0.9; */
background-color: black; 
background-image: 
url(themes/<?=$theme_name?>/backgrounds/top_box.png),       /* top black glass - TheGhost add 03/19/2021 */
url(themes/<?=$theme_name?>/backgrounds/box_bottom.png);    /* bottom flames   - TheGhost add 03/19/2021 */
background-position:
top right, 
bottom left; 
background-repeat: 
repeat-x; /* this makes the top glass block and the bottom flame block repeat from left to right and vice vs - TheGhost add 08/04/2019 */ 
z-index: 780;
}

.modal-body {
#   background-image: url(themes/<?=$theme_name?>/backgrounds/1920x1080.png);
}

.modal-backdrop {
}

.modal .modal-popout-bg {
    background-image: url(themes/<?=$theme_name?>/backgrounds/modal_theme_copyright_pop_bg.png); 
}

.modal {
 
  /* Take the box out of the flow, so that it could look like a modal box */
  # position: absolute;

  /* Avoid the awkwardly stretchy box on bigger screens */
  # max-width: 550px;

  /* Aligning it to the absolute center of the page */
  # top: 50%;
  # left: 50%;
  # transform: translate(-50%, -50%);

  /* Some cosmetics */
  # border-radius: 4px;
  # background-color: rgba(0, 0, 0, .1);
  
}

.modal-hidden {
  display: none;
}

/* Make the media inside the box adapt the width of the parent */
.modal img,
.modal iframe,
.modal video 
{
  max-width: 100%;
}

/* Make the inner element relatively-positioned to contain the close button */
.modal-inner {
  position: relative;
  padding: 10px;
}

/* Close button */
.modal-close {
  font-size: 10px;

  /* Take it out of the flow, and align to the top-left corner */
  position: absolute;
  top: -10px;
  right: -10px;

  /* Size it up */
  width: 24px;
  height: 24px;

  /* Text-alignment */
  text-align: center;

  /* Cosmetics */
  color: #eee;
  border-width: 0;
  border-radius: 100%;
  background-color: black;
}
/*################################################################# Forum CSS from here down ###########################################*/
/**
 * Stylesheet for the Universal Theme
 *
 * @filename:  style.css
 * @author  :  TheGhost
 * @version :  3.0
 * @date    :  12/24/2018 (DD/MM/YYY)
 * @license :  Copyright (c) 2019 The Mortal The 86it Developers Network under the MIT license
 * @notes   :  n/a
 *
 * -- -------------------------------------------------------------------
 * \/ STYLESHEET NAVIGATION
 * -- -------------------------------------------------------------------
 *
 * 1.  Reset CSS
 * 2.  Primary page styles
 * 3.  Page elements
 * 4.  Page header
 * 5.  Page footer
 * 6.  User interaction
 * 7.  Body content wrappers
 * 8.  Side body blocks
 * 9.  Center content wrapper
 * 10. Story content wrapper
 * 11. Inputs
 * 12. Clearfix
 * 13.  Forums Page Styles
 * --- -------------------------------------------------------------------
*/

@import url('//fonts.googleapis.com/css?family=Dosis|Faster+One|Montserrat|Open+Sans|Yanone+Kaffeesatz|Kanit|Roboto');

/*
 * 1. Reset CSS
 *
 * html5doctor.com Reset Stylesheet (Eric Meyer's Reset Reloaded + HTML5 baseline)
 * v2.0 2019-01-07 | Authors: Eric Meyer
 * html5doctor.com/html-5-reset-stylesheet/
 ----------------------------------------------------------------*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	border: 0;
    font-size: 100%;
    margin: 0;
    /*padding: 0;*/
}

/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	/*line-height: 1;*/

}
a
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}

mark {
	background-color: #000000;
	color: #000;
	font-style: italic;
	font-weight: bold;
}

del { text-decoration: line-through; }

abbr[title], dfn[title] { border-bottom: 1px dotted; cursor: help; }

select { cursor: pointer; }

input, select { vertical-align: middle; }
label.radio { cursor: pointer; }

/*
 * 2. Primary page styles
 *----------------------------------------
*/

#flex-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

#flex-item {

}

.container {
	margin: 0 auto;
}

body {	
	font-size: 14px;
	font-family: "Open Sans", sans-serif;
	text-rendering: optimizeLegibility;
    background-color: <?=$body_color?>;
    color: <?=$font_colorA?>;
}

a { 
	color: <?=$font_colorA?>;
	text-decoration: none;
}

a:active,
a.bbcode-href:active { 
	color: <?=$font_colorA?>;
}

a:hover,
a.bbcode-href:hover { 
	color: <?=$font_colorH?>;
}

a.bbcode-href {
	color: <?=$font_colorL?>;
}

/*
 * 3. Page elements
 *--------------------------------------------------
*/
textarea, select, input {
	background-color: <?=$body_color?>;
	color: #fff;
	font-family: "Open Sans", sans-serif;
	letter-spacing: 0px;
	margin: 0px 1px 1px;
	padding: 4px;
	border: 1px solid <?=$font_colorL?>;
	resize: vertical;
	box-sizing: border-box;
}

p { padding-bottom: 5px; text-decoration: none; }
p, table { text-decoration: none; }

ul {
	list-style-type: disc;
}

h1, h2, h3, h4, h5, h6 {
	color: #999;
	font-weight: normal;
}
h1 { font-size: 30px; line-height: 1; margin-bottom: 5px; }
h2 { font-size: 20px; margin-bottom: 7.5px; }
h3 { font-size: 15px; line-height: 1; margin-bottom: 10px; }
h4 { font-size: 12px; line-height: 1.25; margin-bottom: 12.5px; }
h5 { font-size: 10px; font-weight: bold; margin-bottom: 15px; }
h6 { font-size: 10px; font-weight: bold; }

.bviewed {
	font-size: 14px;
	color: #303030;
	text-decoration: none;
	padding-top: 14px;
}

/*
 * 4. Page Header
 *--------------------------------------------------
*/
.wrapLogo {
	background-image: url('../images/hdr/Text-Logo.png');
	float: left;
	height: 110px;
	padding: 0;
	text-indent: -9999px;
	width: 400px;
	margin: 20px 15px 0 0;
}

#hdr-banner-ads {
	width: 468px;
	height: 60px;
	float: right;
	clear: right;
	margin: 40px 15px 0 0;
}

/*
 * 5. Page Footer
 *--------------------------------------------------
*/
.copyright,
a.copyright,
a.copyright:link,
a.copyright:active,
a.copyright:visited {
	font-size: 14px;
	color: <?=$textcolor1?>;
	text-decoration: none;
}
a.copyright:hover {
	font-size: 14px;
	color: <?=$textcolor2?>;
	text-decoration: none;
}

.ftr-banner-ads {
	width: 468px;
	height: 60px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 5px;
	margin-bottom: 5px;
}

/*
 * 6. User interaction
 *--------------------------------------------------
*/
.welcomebg {
	background: url('../images/hdr/Usernav_01.png') no-repeat;
	height: 60px;
	min-width: 280px;
	width: 280px;
	color: <?=$bgcolor1?>;
	text-indent: 96px;
}
.userlinksbg {
	background: url('../images/hdr/Usernav_03.png') no-repeat;
	height: 60px;
	min-width: 280px;
	width: 280px;
	color: <?=$bgcolor1?>;
	text-indent: -80px;
}

/*
 * 7. Body Content wrappers
 *--------------------------------------------------
*/
.body-background {
	background-color: <?=$bgcolor4?>;
}

.body-background2 {
	background-color: <?=$bgcolor4?>;
}

/*
 * 8. Side Body Blocks
 *--------------------------------------------------
*/
.blocktitle {
	font-weight: bold;
	font-size: 12px;
	color: <?=$bgcolor1?>;
	letter-spacing: 0px;
	text-decoration: none;
	text-shadow: 0px 0px 5px #636363, 0px 0px 4px #A20303;
	text-transform: uppercase;
}
.bl1 {
	background: url('../images/blocks/Blocks_01.png') no-repeat;
	height: 50px;
	width: 218px;
}
.bl2 {
	background: url('../images/blocks/Blocks_02.png') repeat-y;
	height: auto;
	width: 218px;
}
.bl3 {
	background: url('../images/blocks/Blocks_03.png') no-repeat;
	height: 20px;
	width: 218px;
}
.bl5 {
	background-color: #202020;
}

.bl5-content {
	padding-left: 20px; 
	padding-right: 20px;
}



/*
 * 10. News Story Content Wrapper
 *--------------------------------------------------
*/

article:first-of-type, .news-article {
	padding-top: 10px;
}

article:last-of-type, .news-article {
	padding-top: 0;
	padding-bottom: 10px;
}

.storytitle-wrapper {
	padding-top: 14px;
}

.storytitle {
	font-weight: bold;
	font-size: 12px;
	color: #FACD8F;
	letter-spacing: 0px;
	text-decoration: none;
}

.postedoption {
	padding-bottom:6px; 
	float: right;
	text-align: right;
}

.st1 {
	background: url('../images/news/News_01.png') no-repeat;
	height: 50px;
	min-width: 32px;
	width: 32px;
}
.st2 {
	background: url('../images/news/News_02.png') repeat-x;
	height: 50px;
	width: 100%;
}
.st3 {
	background: url('../images/news/News_03.png') no-repeat;
	height: 50px;
	min-width: 38px;
	width: 38px;
}
.st4 {
	background: url('../images/news/News_04.png') repeat-y;
	width: 20px;
}
.st6 {
	background: url('../images/news/News_06.png') repeat-y;
	width: 20px;
}
.st5 {
	background-color: #202020;
	height: auto;
	width: 96%;
}
.st7 {
	background: url('../images/news/News_07.png') no-repeat;
	height: 60px;
	min-width: 32px;
	width: 32px;
}
.st8 {
	background: url('../images/news/News_08.png') repeat-x;
	height: 60px;
	width: 100%;
}
.st9 {
	background: url('../images/news/News_09.png') no-repeat;
	height: 60px;
	min-width: 32px;
	width: 32px;
}
.story-bd article {
	margin: 0 16px;
	overflow: hidden;
	position: relative;
	text-align: left;
	z-index: 1;
}


/*
 * 11. Inputs
 *--------------------------------------------------
*/
input {
	color: <?=$bgcolor1?>;
	font-size: 13px;
	border: 1px solid #858585;
	padding: 4px;
	letter-spacing: 1px;
	box-sizing: border-box;
}
input.noborder {
	color: #fff;
	font: 11px arial, helvetica, sans-serif;
	border: 0 solid #fff;
}
input.sub {
	color: <?=$bgcolor1?>;
	font-size: 11px;
	background-color: <?=$bgcolor1?>;
	border: 1px solid #858585;
}

input.button, input.mainoption, input.liteoption {
	color: <?=$bgcolor1?>;
	font-size: 13px;
}

.language-css { color: #cd6a51; }

.left { text-align: left; }
.center { text-align: center; }
.justify { text-align: justify; }
.right { text-align: right; }

/* Changes Color for: Story Box - Post By Line */
td.content {
	color: #fff;
	font-size: 11px;
	text-decoration: none;
}
td.extra {
	border: 0 solid #131313;
	border-right-color: #898989;
	border-bottom-color: #898989;
}

.heading {
	font-weight: bold;
	font-size: 11px;
	color: #fff;
	letter-spacing: 0;
	text-decoration: none;
}


/*
 * 12. Clearfix
 *
 * The Magnificent Clearfix: Updated to prevent margin-collapsing on child elements.
 * j.mp/bestclearfix
 *--------------------------------------------------
*/
.clearfix:before,
.clearfix:after {
	content: "\0020";
	display: block;
	height: 0;
	overflow: hidden;
}
.clearfix:after { clear: both; }
.clearfix { zoom: 1; }


/*
 * 13. FORUMS CSS Coding Begins Here
 *--------------------------------------------------
*/

/* Border Line & Background Color Round the Entire Page */
.bodyline {
	background-color: #2c2c2c;
	border: 0 solid #000;
}

/* The Outline Round the Main Forum Tables */
.forumline {
  background: <?=$bgcolor4?>;
  border: #222 0px solid;
}

/* Main table cell colours and backgrounds */
td.row1 {
	background: <?=$bgcolor2?>;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

td.row2 {
	background-color: <?=$bgcolor2?>;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

td.row3 {
	background-color: <?=$bgcolor4?>;
	border: 1px solid border: 1px solid <?=$bgcolor3?>;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

/* Category Row Right */
td.rowpic {
	background: <?=$bgcolor2?>;
	border: <?=$bgcolor3?> 1px solid;
	padding-left: 2px;
	padding-right: 2px;
	padding-bottom: 2px;
}

/* Recent Topics Row*/
th {
	color: #FFF;
	border: 1px solid #222;
	border-bottom-width: 0;
	font-size: 10px;
	background-color: #3d3d3d;
	white-space: nowrap;
	text-align: center;
}

th.bar {
	background: <?=$bgcolor5?>;
	border: #222 1px solid;
	color: #ddd;
	font-size: 11px;
	font-weight: bold;
	text-align: center;
}

/* Category Row Left */
td.cat, td.catHead, td.catSides, td.catLeft, td.catRight, td.catBottom {
	background-color: <?=$bgcolor2?>;
	color: #FFF;
	border: 1px solid <?=$bgcolor3?>;
	white-space: nowrap;
	padding: 4px;
}

td.cat, td.catHead, td.catBottom {
	background-color: <?=$bgcolor1?>;
	color: #FFF;
	border: 1px solid <?=$bgcolor3?>;
	white-space: nowrap;
}

/*
 * Setting additional nice inner borders for the main table cells.
 * The names indicate which sides the border will be on.
 * Don't worry if you don't understand this, just ignore it :-)
 *----------------------------------------------------------------
*/


/* Recent Topics, Row1, Viewforum_Body.tpl */
th.thHead, th.thSides, th.thTop, th.thLeft, th.thRight, th.thBottom, th.thCornerL, th.thCornerR {
	color: #F1F1F1;
	border: 1px solid #222;
	border-bottom-width: 0;
	font-size: 10px;
	background-color: <?=$bgcolor1?>;
	white-space: nowrap;
}

/* Forum_Body.tpl - Last Column */
td.row3Right, td.spaceRow {
	height: 25px;
	color: #F1F1F1;
	border: 1px solid #222;
	border-bottom-width: 0;
	font-size: 10px;
	background-color: <?=$bgcolor1?>;
	white-space: nowrap;
}

/* The Largest Text Used in the Index Page Title & Toptic Title Etc. */
.maintitle, h1, h2 {
	font-weight: bold;
	font-size: 18px;
	line-height: 120%;
	color: <?=$textcolor1?>;
	text-decoration: none;
}
a.maintitle:link {
	color: <?=$$textcolor1?>;
	font-size: 18px;
	text-decoration: none;
}
a.maintitle:visited {
	color: <?=$textcolor1?>;
	font-size: 18px;
	text-decoration: none;
}
a.maintitle:hover {
	color: <?=$textcolor1?>;
	font-size: 18px;
	text-decoration: none;
}

/* General Text */
.gen {
	font-size: 13px;
	color: #FFF;
}
.genmed {
	font-size: 12px;
}
.gensmall {
	font-size: 10px;
}
.gen, .genmed, .gensmall {
	color: #FFF;
}
a.gen, a.genmed, a.gensmall {
	background: transparent;
	color: #FFF;
	text-decoration: none;
}
a.gen:hover, a.genmed:hover, a.gensmall:hover {
	color: <?=$bgcolor1?>;
	text-decoration: none;
}

/* The Register, Login, Search, Etc, Links at the Top of the Page */
.mainmenu {
	color: #FFF;
}
a.mainmenu {
	color: #FFF;
	text-decoration: none;
}
a.mainmenu:hover {
	color: #bbbbbb;
	text-decoration: none;
}

/* Forum Cattitle & Description Text */
.cattitle {
	font-size: 13px !important;
	letter-spacing: 1px;
}
a.cattitle {
	color: #AFAFAF;
	text-decoration: none;
}
a.cattitle:hover {
	color: <?=$bgcolor1?>;
	text-decoration: none;
}

.cattitle3 {
	color: #FED192;
	font-size: 13px !important;
	letter-spacing: 1px;
}
a.cattitle3 {
	color: #AFAFAF;
	text-decoration: none;
}
a.cattitle3:hover {
	color: <?=$bgcolor1?>;
	text-decoration: none;
}

/* Forum title: Text and link to the forums used in: index.php */
.forumlink {
	font-weight: bold;
	font-size: 11px;
	color: #FFF;
}
a.forumlink {
	color: #999;
	text-decoration: none;
}
a.forumlink:hover {
	color: #6a0000;
	text-decoration: none;
}

/* Used for the Navigation text, (Page 1,2,3 etc) & the navigation bar when in a forum */
.nav {
	font-weight: bold; font-size: 11px; color: #999;
}
a.nav {
	color: #999; text-decoration: none;
}
a.nav:hover {
	color: #999; text-decoration: none;
}

/* Titles for the Topics: Could specify viewed link color too */
.topictitle {
	color: #DDD;
}
a.topictitle:link {
	color: #999;
	text-decoration: none;
}
a.topictitle:visited {
	color: #999;
	text-decoration: none;
}
a.topictitle:hover {
	color: #cb5858;
	text-decoration: none;
}

/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name {
	font-size: 11px;
	color: #FFF;
}

/* Location, number of posts, post date etc */
.postdetails {
	font-size: 10px;
	color: #FFF;
}

/* The content of the posts (body of text) */
.postbody {
	font-size: 15px;
	color: #D3D3D3;
}

a.postlink:link {
	color: #FED192;
	text-decoration: none;
}
a.postlink:visited,
a.postlink:hover {
	color: <?=$bgcolor1?>;
	text-decoration: underline;
}


.fa-angle-double-up {
	text-shadow: 0px 0px 5px #636363, 0px 0px 4px #A20303;
}

/*--------------------------------------------------------------*/
/* Everything Below this Line Needs to be Added to Other Themes */
/*--------------------------------------------------------------*/
input[type='submit'],input[type='radio']{cursor:pointer;}
select{color: #fff;border:1px solid <?=$bgcolor1?>;cursor:pointer;margin:0 1px 1px;box-sizing:border-box;}
input{color: #fff;border:1px solid <?=$bgcolor1?>;box-sizing:border-box;letter-spacing:1px;margin:0 1px 1px;padding:5px;box-sizing:border-box;}
span.uppercase{text-transform:uppercase;}

td.forums,th.forums{padding-left:5px;}
td.threads,th.threads{width:80px;}
td.last_post,th.last_post{width:200px;padding-left:5px;}

input[type='radio']{background-color:transparent!important;width:18px;height:18px;}
input[type='image']{border:none;padding:0;}

progress{background-color:<?=$bgcolor2?>;border:0;height:18px;}

.codebox{border-style:solid;display:block;padding: 10px;;border:1px solid #b5b7b9;background-color:<?=$bgcolor2?>;}
.codebox code{display:block;font:1em Monaco,"Open Sans",sans-serif;max-height:500px;max-width:100%;overflow:auto;margin:0;padding: 5px 3px;}
.codebox p{display:block;font-weight:600;border-bottom:1px solid #ccc;text-transform:uppercase;}

.phpcodebox {background-color:#fdf6e3;}
.phpcodebox p{color:<?=$bgcolor5?> ;}
.code_select {color:<?=$bgcolor2?>;}
.code_select:hover {color: <?=$bgcolor1?>;}

.notepaper
{
position:relative;
margin:auto;
padding:10px 15px 7px 40px;
width:90%;
line-height:15px;
color:<?=$textcolor1?>;text-shadow:0 1px 1px <?=$bgcolor4?>; 
background-color:none;

background-image:-webkit-radial-gradient(center,cover,rgba(166,139,67,0.7) 0%,rgba(166,139,67,0.1) 90%),-webkit-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 0px); 

background-image:-moz-radial-gradient(center,cover,rgba(166,139,67,0.7) 0%,rgba(166,139,67,0.1) 90%),-moz-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 30px); background-image:-o-radial-gradient(center,cover,rgba(205,179,109,0.1) 0%,rgba(255,255,255,0.1) 90%),-o-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 30px);border:1px solid #c3baaa;border-color:rgba(195,186,170,0.9);

-webkit-box-sizing:border-box;
-moz-box-sizing:border-box;
box-sizing:border-box;
-webkit-box-shadow:inset 0 1px rgba(166,139,67,0.5),inset 0 0 5px #d8e071,0 0 1px rgba(0,0,0,0.1),0 2px rgba(0,0,0,0.02);box-shadow:inset 0 1px rgba(166,139,67,0.5),inset 0 0 0px  #d8e071,0 0 1px rgba(0,0,0,0.1),0 0px rgba(0,0,0,0.02)
}

.notepaper:before,.notepaper:after
{
  content:'';position:absolute;top:0;bottom:0;
}

.notepaper:before
{
left:28px;width:2px;border:solid #8c7433;
border-color:rgba(239,207,173,0.9);
border-width:0 0px;
}

.notepaper:after
{
z-index:-1;
left:0;right:0;
background:rgba(242,246,193,0.9);
border:1px solid rgba(170,157,134,0.7);
-webkit-transform:rotate(2deg);
-moz-transform:rotate(2deg);
-ms-transform:rotate(2deg);
-o-transform:rotate(2deg);
transform:rotate(2deg)
}

.curly-quotes:before,.curly-quotes:after
{
display:inline-block;
vertical-align:top;
height:30px;line-height:48px;
font-size:50px;opacity:.2;
}

.curly-quotes:before
{
content:'\201C';
margin-right:4px;
margin-left:-8px;
}

.curly-quotes:after
{
content:'\201D';
margin-left:4px;
padding-top:14px;
margin-right:-8px;
}

.quote-by
{
display:block;
padding-bottom:10px;
padding-right:10px;
font-size:13px;
font-style:italic;color:<?=$textcolor1?>;
}

.lt-ie8 .notepaper{padding:15px 25px;}

.lastpost .fa{float:right;padding:10px;transition:all .2s ease-in-out;}
.left{text-align:left;}
.center{text-align:center;}
.justify{text-align:justify;}
.right{text-align:right;}

.forum-ranks {margin-bottom: 2px;}
.forum-avatar {padding-bottom: 5px;}

/* THIS IS THE NEW SHIT */
/* Progress Bar Rules START */
progress {
  /* style rules */
  border: 0;
  height: 5px;
  border-radius: 5px;  
}
progress::-webkit-progress-bar {
  /* style rules */
  border: 0;
  height: 5px;
  border-radius: 5px;
}
progress::-webkit-progress-value {
  /* style rules */
  border: 0;
  height: 5px;
  border-radius: 5px;
}
progress::-moz-progress-bar {
  /* style rules */
  border: 0;
  height: 5px;
  border-radius: 5px;
}
/* Progress Bar Rules END */
.menuwrap {


}

.blocks {
 display:inline-block;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: grey;
 
 text-align:center;
 transition: all 0.2s;
}

a.titaniumbutton,input.titaniumbutton
{
 display:inline-block;
 padding:0.35em 1.2em;
 border:0.1em solid #212f47;
 margin:0 0.3em 0.3em 0;
 border-radius:0.12em;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: grey;
 background-color: black;
 
 text-align:center;
 transition: all 0.2s;
}
a.titaniumbutton:hover,input.titaniumbutton:hover
{
  /* Main Font Color */
  color:white;
 /* Highlight Color On Hover */
  background-color: black;
}

@media all and (max-width:30em)
{
  a.titaniumbutton, input.titaniumbutton
  {
    display:block;
    margin:0.4em auto;
  }
}


.forumline th, .forumline td 
{
  -moz-border-radius: 5px !important;
}

.forumline 
{
  border-spacing: 0;
  border-collapse: separate;
  border-radius: 10px;
  border: 1px solid black;
}

.forumline th, .forumline td 
{
  -moz-border-radius: 5px !important;
}
.theme_index{
padding-top: 2em;
padding-right: 2em;
padding-bottom: 2em;
padding-left: 2em;
}

.theme_header
{
padding-top: 2em;
padding-right: 2em;
padding-bottom: 2em;
padding-left: 2em;
}

.visitors:hover
{
/* filter: grayscale(0%); */
  filter: saturate(5px);
  transform: rotate(360deg);
  transition: transform .8s ease-in-out;
  cursor: pointer;
}
.visitors
{
/* filter: grayscale(100%); */
  transition: all .2s ease-in-out;
  max-width: 100vmin;
  max-height: 70vmin;
  box-shadow: 0 0.2rem 1rem rgba(0, 0, 0, 0.2);
  border-radius: 100%;
}

<?



