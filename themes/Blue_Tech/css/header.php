<?php
global $theme_name;
echo "/* Loading themes/".$theme_name."/css/header.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n"; 
global $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5, $fieldset_border_width, $locked_width;
$bgcolor5 ='#262525';
?>
/**
 * Stylesheet for the Titanium Core Theme
 *
 * @filename:  header.php
 * @author  :  TheGhost
 * @version :  3.0
 * @date    :  11/22/2022 (DD/MM/YYY)
 * @license :  Copyright (c) 2022 The 86it Developers Network under the MIT license
 * @notes   :  n/a
 *
 * -- -------------------------------------------------------------------
 * \/ STYLESHEET NAVIGATION
 * -- -------------------------------------------------------------------
 *
 *  1.  Reset CSS
 *  2.  Primary page styles
 *  3.  Page elements
 *  4.  Page header
 *  5.  Center Blocks
 *  6.  Side Blocks
 *  7.  Page footer
 *  8.  User interaction
 *  9.  Body content wrappers
 * 10.  Side body blocks
 * 11.  Center content wrapper
 * 12.  Story content wrapper
 * 13.  Inputs
 * 14.  Clearfix
 * 15.  Forums Page Styles
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

/* By adding the following CSS properties we can prevent the odd rendering: PHONES */
html{
  -moz-text-size-adjust: none;
  -webkit-text-size-adjust: none;
  text-size-adjust: none;
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

.hover_effect {
  height: auto;
  width: 64px;
  cursor: pointer; 
}
 
.hover_effect:hover {
  height: auto;
  width: 64px;
  cursor: pointer;
  animation: wiggle 2s linear infinite;
}

/* Keyframes */
@keyframes wiggle {
  0%, 7% {
    transform: rotateZ(0);
  }
  15% {
    transform: rotateZ(-15deg);
  }
  20% {
    transform: rotateZ(10deg);
  }
  25% {
    transform: rotateZ(-10deg);
  }
  30% {
    transform: rotateZ(6deg);
  }
  35% {
    transform: rotateZ(-4deg);
  }
  40%, 100% {
    transform: rotateZ(0);
  }
}

mark {
	background-color: #ff9;
	color: #000;
	font-style: italic;
	font-weight: bold;
}

del { text-decoration: line-through; }

abbr[title], dfn[title] { border-bottom: 1px dotted; cursor: help; }

select { cursor: pointer; }

input, select { vertical-align: middle; }
label.radio { cursor: pointer; }
input[type='checkbox']
{
  width:17px;height:17px;
  cursor: pointer;
}

/*
 * 2. Primary page styles
 *----------------------------------------
 */

#flex-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    background-color: transparent;
}

#flex-item {

}

.container {
	margin: 0 auto;
}

input[type="radio"]{
    vertical-align: bottom;
}

.absmiddle{
    vertical-align: middle;
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

}

hr {
	background-color: #262626;
	border: 0;
	height: 3px;
	margin: 0px 0px;
	width: 100%;
    #opacity: 0.4;

}

fieldset {
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
padding: 6px;
}

body {	
	font-size: 14px;
	color: #fff;
	font-family: "Open Sans", sans-serif;
	text-rendering: optimizeLegibility;
    overflow-y: scroll; /* Show vertical scrollbar */
    /* overflow-x: scroll;  Show horizontal scrollbar */
    background-color: black !important;
}


a {
 color: <?=$textcolor1?>;
 text-decoration: none;
 font-size: 1rem;
}

a:link {
 color: <?=$textcolor1?>;
 text-decoration: none;
}

a:visited {
 color: <?=$textcolor1?>;
 text-decoration: none;
}

a:focus {
 color: <?=$textcolor1?>;
 text-decoration: none;
}

a:hover {
 color: white;
 text-decoration: none;
}

a:active {
 color: <?=$textcolor1?>;
 text-decoration: none;
}
  

a.bbcode-href:active { 
	color: <?=$textcolor1?>;
}

a.bbcode-href:hover { 
	color: white;
}

a.bbcode-href {
	color: <?=$textcolor1?>;
}

/*
 * 3. Page elements
 *--------------------------------------------------
*/
textarea, select, input {
	background-color: <?=$bgcolor5?>;
	color: #fff;
	font-family: "Open Sans", sans-serif;
	letter-spacing: 0px;
	margin: 0px 1px 1px;
	padding: 4px;
	border: 1px solid <?=$bgcolor1?>;
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
h2 { font-size: 20px; margin-bottom: 5.5px; }
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

/* REG TABLES 100% Width */
.table1859
{
  table-layout: auto;
  width: 1859px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

.table100
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

.table100bg
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0px;

  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  
  background: repeat-x;
  background: repeat-y;
  text-align: center; 
  background-image: url('themes/<?=$theme_name?>/images/BACKGROUNDS/151515.png');
}

.visitorName
{
  border: 0px solid #f00;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  vertical-align: bottom;
  text-align: bottom;
  height: 0px;
  width: 0px;
  display: box;
  justify-content: box-end;
  align-items: box-end;
}

.sendMessage
{
  border: 0px solid #f00;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  vertical-align: bottom;
  text-align: top;
  height: 0px;
  width: 0px;
  display: box;
  justify-content: box-end;
  align-items: box-end;
}

.tableVisotrLog
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0px;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  text-align: center;
  background-color: #000000; 
}

td.table1_width_definedLSM
{
  table-layout: auto;
  width: 39px;
  height: 100%;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/TABLES/left_side_middle_151515.png');
}

td.table1_width_definedRSM
{
  table-layout: auto;
  width: 39px;
  height: 100%;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/TABLES/right_side_middle_151515.png');
}

td.table1_width_definedBM
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x;
  text-align: center; 
  background-image: url('themes/<?=$theme_name?>/images/TABLES/bottom_middle_piece.png');
}

td.opentable_width_definedTM
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x;
  text-align: center; 
  background-image: url('themes/<?=$theme_name?>/images/TABLES/top_middle_piece.png');
}

td.BackgroundColor4
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: <?=$bgcolor4?>;
}

.header_table_opacity
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
  /* opacity: 0.9; */
}

.header_table_two
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

td.TopLeftCorner
{
  table-layout: auto;
  width: 29px;
  height: 216px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/PHP-CarterPhone_top_left_corner_02.png');
}


td.header_table_twoTL
{
  table-layout: auto;
  width: 39px;
  height: 50px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/HEADER/top_left_corner.png');
}

td.td1748
{
  table-layout: auto;
  width: 1748px;
  height: auto;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x; 
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/page_template_r2_c3.png');
}

td.td1725
{
  table-layout: auto;
  width: 1725px;
  height: 83px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x; 
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/page_template_r6_c4.png');
}

td.td65
{
  table-layout: auto;
  width: 65px;
  height: 83px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/PHP-CarterPhone_left_bottom_corner_04.png');
}

td.td69
{
  table-layout: auto;
  width: 69px;
  height: 83px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/PHP-CarterPhone_right_bottom_corner_10.png');
}

td.td1802
{
  table-layout: auto;
  width: 1802px;
  height: 27px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x; 
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/page_template_r4_c2.png');
}

td.td746LT
{
  table-layout: auto;
  width: 29px;
  height: auto;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/PHP-CarterPhone_left_middle_07.png');
}

td.td746RT
{
  table-layout: auto;
  width: 28px;
  height: auto;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-y; 
  background-image: url('themes/<?=$theme_name?>/blackjack/main_background/PHP-CarterPhone_right_middle_14.png');
}

td.td1802headerTD
{
  table-layout: auto;
  width: 1802px;
  height: auto;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-size: 100% auto, cover;
  /* background-attachment: fixed; */
  background-repeat: repeat-y;
  /* background-image: url('themes/<?=$theme_name?>/blackjack/main_background/black_glass_1820z.png'); */
  background-color: black;
}


td.header_table_twoTM
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x; 
  background-image: url('themes/<?=$theme_name?>/images/HEADER/top_middle_piece.png');
}

td.header_table_twoTR
{
  table-layout: auto;
  width: 39px;
  height: 50px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/HEADER/top_right_corner_10.png');
}

td.header_table_twoLSM
{
  table-layout: auto;
  width: 39px;
  height: 100%;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 39px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/HEADER/left_side_middle_151515.png');
}

/* Used To Slide Banner Ads In TO View */
@-webkit-keyframes pulsate {
    0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;}
    50% {opacity: 1.0;}
    100% {-webkit-transform: scale(1.2, 1.2); opacity: 0.0;}
}

.banneradLT
{
  table-layout: auto;
  width: 100%;
  height: 165px;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  /* filter: drop-shadow(1px 1px 6px #87774b); */
}

td.bannerLeftSide
{
  table-layout: auto;
  width: 25%;
  height: 79px;
  border-collapse: collapse;
  padding-top: 8px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  text-align: left;
  vertical-align: top;
  /* -webkit-border-radius: 6px; */
  /* -webkit-animation: pulsate 1s ease-in; */
  /* -webkit-animation-iteration-count: 1; */
  /* 0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;} */
  /* 50% {opacity: 1.0;} */
  /* 100% {-webkit-transform: scale(1.2, 1.2); opacity: 0.0;} */

}

td.stacklogos
{
  table-layout: auto;
  width: 33.3%;
  height: auto;
  border-collapse: collapse;
  padding-top: 10px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  text-align: center;
  vertical-align: top;
}

.banneradRT
{
  table-layout: auto;
  width: 100%;
  height: 165px;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  /* filter: drop-shadow(1px 1px 6px #87774b); */
}

td.bannerRightSide
{
  table-layout: auto;
  width: 25%;
  height: 79px;
  border-collapse: collapse;
  padding-top: 8px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  text-align: right;
  vertical-align: top;
  -webkit-border-radius: 6px;
  -webkit-animation: pulsate 1s ease-in;
  -webkit-animation-iteration-count: 1; 
  0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;}
  50% {opacity: 1.0;}
  100% {-webkit-transform: scale(1.2, 1.2); opacity: 0.0;}
}

td.undermarqueeLT
{
  table-layout: auto; 
  width: 25%; 
  height: 14px;
  border-collapse: collapse;
  padding-top: 5px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  text-align: left;
  vertical-align: bottom;
}

td.abovemarqueeLT
{
  table-layout: auto;
  width: 25%;
  height: 30px;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 5px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  text-align: center !important;
  vertical-align: bottom;
  font: bold 13px Georgia, sans-serif;
  color:#b8a265; 
}

td.abovemarqueeRT
{
  table-layout: auto;
  width: 25%;
  height:60px;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 5px !important;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  text-align: center !important;
  vertical-align: bottom;
  font: bold 13px Georgia, sans-serif;
}


td.abovemarqueeRT
{
  table-layout: auto;
  width: 25%;
  height: 30px;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-color: transparent;
  text-align: left;
  vertical-align: bottom;
}

/*
 * 5. Center Blocks
 *--------------------------------------------------
 */
td.tableCB_width_definedRT
{
  table-layout: auto;
  width: 39px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

td.tableCB_width_definedLT
{
  table-layout: auto;
  width: 39px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

td.tableCB_width_definedTM
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x;
  text-align: center; 
  background-image: url('themes/<?=$theme_name?>/images/CENTERBLOCKS/top_middle_piece.png');
}

td.tableCB_width_definedLSM
{
  table-layout: auto;
  width: 23px;
  height: 100%;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/CENTERBLOCKS/left_side_middle_151515.png');
}

td.tableCB_width_definedRSM
{
  table-layout: auto;
  width: 23px;
  height: 100%;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/CENTERBLOCKS/right_side_middle_151515.png');
}

td.tableCB_width_definedBM
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x;
  text-align: center; 
  background-image: url('themes/<?=$theme_name?>/images/CENTERBLOCKS/bottom_middle_piece.png');
}


/*
 * 6. Side Blocks
 *--------------------------------------------------
 */

/* Side Block */
td.tableSB_width_definedTM
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x;
  text-align: center; 
  background-image: url('themes/<?=$theme_name?>/images/SIDEBLOCKS/top_middle_piece.png');
}

/* Side Block */
td.tableSB_width_definedBM
{
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background: repeat-x;
  text-align: center; 
  background-image: url('themes/<?=$theme_name?>/images/SIDEBLOCKS/bottom_middle_piece.png');
}

/* Side Block */
td.tableSB_width_definedLSM
{
  table-layout: auto;
  width: 23px;
  height: 100%;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/SIDEBLOCKS/left_side_middle_151515.png');
}

/* Side Block */
td.tableSB_width_definedRSM
{
  table-layout: auto;
  width: 23px;
  height: 100%;
  border-collapse: collapse;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 0px;
  padding-right: 0px;
  border-spacing: 0px;
  background-image: url('themes/<?=$theme_name?>/images/SIDEBLOCKS/right_side_middle_151515.png');
}

/* Side Block */
.tableSB_width_defined
{
  table-layout: auto;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

/* Side Block */
td.tableSB_width_definedLT
{
  table-layout: auto;
  width: 39px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

/* Side Block */
td.tableSB_width_definedRT
{
  table-layout: auto;
  width: 39px;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: transparent;
}

/*
 * Proof Of God Style Sheet Cell Colors and Backgrounds
 *--------------------------------------------------
 */
td.proof_of_god_row1 {
	background: <?=$bgcolor2?>;
	border: 1px solid #212f47;
	padding: 4px;
}

td.proof_of_god_row2 {
	border: 1px solid #212f47;
	padding: 14px;
}

td.proof_of_god_row3 {
	background-color: <?=$bgcolor4?>;
	border: 1px solid <?=$bgcolor3?>;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

/*
 * Nuke_Projects Style Sheet Cell Colors and Backgrounds
 *--------------------------------------------------
 */
td.projects_row1 {
	background: <?=$bgcolor2?>;
	border: 1px solid #212f47;
	padding: 4px;
}

td.projects_row2 {
	border: 1px solid #212f47;
	padding: 14px;
}

td.projects_row3 {
	background-color: <?=$bgcolor4?>;
	border: 1px solid <?=$bgcolor3?>;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

/*
 * 7. Page Footer
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
 * 8. User interaction
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
 * 9. Body Content wrappers
 *--------------------------------------------------
*/
.body-background {
    background-color: black;
}

.body-background2 {
    background-color: black;
}

/*
 * 10. Inputs
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

input.button{
  color: green;
  font-size: 13px;
}

/* Submit Buttons */ 
input.mainoption{
  color: green;
  font-size: 16px;
} 

input.liteoption {
	color: orange;
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
 * 11. Clearfix
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
 * 12. FORUMS CSS Coding Begins Here
 *--------------------------------------------------
*/

/* Border Line & Background Color Round the Entire Page */
.bodyline {
	background-color: #2c2c2c;
	border: 0 solid #000;
}

/* The Outline Round the Main Forum Tables UPDATED */
.forumline {
  table-layout: auto;
  width: 100%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: <?=$bgcolor5?>;
  background: <?=$bgcolor5?>;
  border: #222 0px solid;
}

/* Main table cell colours and backgrounds */
td.row1 {
	background: #0c0c0c;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

td.row2 {
	background-color: <?=$bgcolor2?>;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

td.row3 {
	background-color: #151515;
	border: 1px solid <?=$bgcolor3?>;
	border: 1px solid <?=$bgcolor3?>;
	padding: 4px;
}

/* Category Row Right */
td.rowpic {
	background: <?=$bgcolor2?>;
	border: 1px solid <?=$bgcolor3?>;
	padding-left: 2px;
	padding-right: 2px;
	padding-bottom: 2px;
}

/* Recent Topics Row*/
th {
	color: #FFF;
	border: 1px solid #151515;
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
	background-color: #151515;
	color: #FFF;
	border: 1px solid <?=$bgcolor5?>;
	white-space: nowrap;
	padding: 4px;
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
	font-size: 16px;
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
    color: <?=$textcolor1?>;
	font-weight: bold;
	font-size: 18px;
	line-height: 120%;
	color: #CCC;
	text-decoration: none;
}
a.maintitle:link {
	color: <?=$textcolor1?>;
	font-size: 18px;
	text-decoration: none;
}
a.maintitle:visited {
	color: <?=$textcolor1?>;
	font-size: 18px;
	text-decoration: none;
}
a.maintitle:hover {
	color: green;
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
	color: <?=$textcolor1?>;
	font-size: 25px !important;
	letter-spacing: 1px;
}
a.cattitle3 {
	color: <?=$textcolor1?>;
	text-decoration: none;
}
a.cattitle3:hover {
	color: green;
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
input[type='submit'],input[type='checkbox'],input[type='radio']
{
  cursor:pointer;
}

select{color: #fff;border:1px solid <?=$bgcolor1?>;cursor:pointer;margin:0 1px 1px;box-sizing:border-box;}

input{color: #fff;border:1px solid <?=$bgcolor1?>;box-sizing:border-box;letter-spacing:1px;margin:0 1px 1px;padding:5px;box-sizing:border-box;}

span.uppercase{text-transform:uppercase;}

td.forums,th.forums{padding-left:5px;}
td.threads,th.threads{width:80px;}
td.last_post,th.last_post{width:200px;padding-left:5px;}


input[type='checkbox']{width:18px;height:18px;}
input[type='image']{border:none;padding:0;}

progress{background-color:<?=$bgcolor2?>;border:0;height:18px;}

.codebox {
	display: grid;
	border-style: solid;
	padding: 10px;
	border: 1px solid grey;
	background-color: #151515;
	position: relative;
	overflow: hidden;
    border-radius: 11px;
}

.codebox .code-icon {
	display: inline-block;
	position: absolute;
	bottom: -36px;
	right: 3px;
}

.codebox .code-icon i {
	font-size: 180px;
	color: #808080;
	opacity: .2;
	line-height: 1;
	vertical-align: baseline;
}

.codebox p {
	margin:0;
}

.codebox pre {
	color: black;
}

/** 
 * Spoiler Fix
 */
.spoiltitle input {
	width: 60%;
    padding: 10px;
}
.spoildiv div {
	text-align: left;
}

.codebox pre code {
	display: block;
	font: 1em Monaco,"Open Sans",sans-serif !important;
	max-height: 500px;
	max-width: 100%;
	overflow: auto;
	margin: 0;
	padding: 5px 3px;
	white-space: normal;
}

.phpcodebox {background-color:#fdf6e3;}
.phpcodebox p{color:<?=$bgcolor5?> ;}

.code_select 
{
  text-shadow: none !important;
  color: red;
}

.code_select:link 
{
  text-shadow: none !important;
  color: red;
}

.code_select:hover 
{
  text-shadow: none !important;
  color: green;
}

.code_selection 
{
  text-shadow: none !important;
  color: red;
}

.code_selection:link 
{
  text-shadow: none !important;
  color: red;
}

.code_selection:hover 
{
  text-shadow: none !important;
  color: green;
}

/* SHIT START */
phpbb-block-quote {
	position: relative;
	overflow: hidden;
}

.phpbb-block-quote .quote-left-icon {
	display: inline-block;
	position: absolute;
	top: -36px;
	left: 3px;
}

.phpbb-block-quote .quote-right-icon,
.php-code-box .php-icon {
	display: inline-block;
	position: absolute;
	bottom: -36px;
	right: 3px;
}

.phpbb-block-quote .quote-left-icon i,
.phpbb-block-quote .quote-right-icon  {
	font-size: 180px;
	color: #808080;
	opacity: .2;
	line-height: 1;
	vertical-align: baseline;
}

.php-code-box .php-icon i {
	font-size: 180px;
	color: #808080;
	opacity: .2;
	line-height: 1;
	vertical-align: baseline;
}

.embed-responsive .embed-responsive-item, .embed-responsive embed, .embed-responsive iframe, .embed-responsive object, .embed-responsive video {
	width: 640px;
	height: 360px;
}
/* SHIT END*/

.notepaper
{
position:relative;
margin:auto;
padding:10px 15px 7px 40px;
width:90%;
line-height:15px;
color: <?=$textcolor1?>;
text-shadow: 0 1px 1px <?=$bgcolor4?>; 
background-color:transparent;

background-image:-webkit-radial-gradient(center,cover,rgba(166,139,67,0.7) 0%,rgba(166,139,67,0.1) 90%),-webkit-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 0px); 

background-image:-moz-radial-gradient(center,cover,rgba(166,139,67,0.7) 0%,rgba(166,139,67,0.1) 90%),-moz-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 30px);

background-image:-o-radial-gradient(center,cover,rgba(205,179,109,0.1) 0%,rgba(255,255,255,0.1) 90%),-o-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 30px);border:1px solid #c3baaa;border-color:rgba(195,186,170,0.9);

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

.visitors:hover
{
  transform: rotate(360deg);
  transition: transform .8s ease-in-out;
  cursor: pointer;
}
.visitors
{
  transition: all .2s ease-in-out;
  max-width: 100vmin;
  max-height: 70vmin;
  box-shadow: 0 0.2rem 1rem rgba(0, 0, 0, 0.2);
  border-radius: 100%;
}

<?
