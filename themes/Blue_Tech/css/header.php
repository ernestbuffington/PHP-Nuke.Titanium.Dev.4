<?php
global $theme_name;
echo "/* Fly Kit CSS Header Style Sheet */\n"; 
echo "/* ".$theme_name."/css/header.php (Header Style Sheet) */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Header Style Sheet                                            */
/*                                                               */
/* Designed and Coded By: Ernest Buffington aka TheGhost         */
/* Coded On: 16th October, 2022                                  */
/* Copyright © 2022 Brandon Maintenance Management               */
/*                                                               */
/* PLEASE STEAL AND/OR USE THIS CSS CODE                         */
/* NO NEED FOR WRITTEN PERMISSION                                */
/* I did not trade a goat for this code!                         */
/*---------------------------------------------------------------*/

/*---------------------------------------------------------------*/
/* Header Style Sheet                                            */
/*---------------------------------------------------------------*/

@import url('//fonts.googleapis.com/css?family=Dosis|Faster+One|Montserrat|Open+Sans|Yanone+Kaffeesatz|Kanit|Roboto');

/*
 * Reset CSS
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
fieldset, form, label, legend,
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

input[type='checkbox'] { cursor: pointer; }

/*
 * Page Logo
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

/* Border Line & Background Color Round the Entire Page */
.bodyline {
	background-color: #2c2c2c;
	border: 0 solid #000;
}
<?
