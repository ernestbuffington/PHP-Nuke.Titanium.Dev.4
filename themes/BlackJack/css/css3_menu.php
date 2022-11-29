<?php
global $theme_name;
echo "/* themes/".$theme_name."/css/css3_menu.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n"; 
global $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $menu_text_color; 

$menu_bar_background_color = '#202020';
$menu_bar_background_color_hover = '#000000';
$menu_background_color = '#202020';
$menu_background_color_hover = '#151515';
$menu_background_color_hover_sub_menu = '#000000';
?>
/**
 * Stylesheet for the Titanium Core Theme
 *
 * @filename:  css3_menu.php
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
 *  1.  Menu for Titanium Core Header
 *  2.  
 *  3.  
 * --- -------------------------------------------------------------------
 */

/*
 * 1. Menu for Titanium Core Header
 *----------------------------------------
 */
#menu {
	background: <?=$menu_background_color?>;
	background: linear-gradient(to bottom,  <?=$menu_background_color?>,  <?=$menu_background_color_hover?>);
	color: <?=$menu_text_color?>;
	height: 33px;
    width: 597px;
	padding-left: 18px;
	border-radius: 10px;
}
#menu ul, #menu li {
	margin: 0 auto;
	padding: 0;
	list-style: none
}
#menu ul {
	width: 100%;
}
#menu li {
	float: left;
	display: inline;
	position: relative;
}
#menu a {
	display: block;
	line-height: 33px;
	padding: 0 14px;
	text-decoration: none;
	color: <?=$menu_text_color?>;
	font-size: 16px;
}
#menu a.dropdown-arrow:after {
	content: "\25BE";
	margin-left: 5px;
}
#menu li a:hover {
	color: <?=$menu_text_color?>;
	background: <?=$menu_bar_background_color_hover?>;
}
#menu input {
	display: none;
	margin: 0;
	padding: 0;
	height: 33px;
	width: 100%;
	opacity: 0;
	cursor: pointer
}
#menu label {
	display: none;
	line-height: 33px;
	text-align: center;
	position: absolute;
	left: 35px
}
#menu label:before {
	font-size: 1.6em;
	content: "\2261"; 
	margin-left: 20px;
}
#menu ul.sub-menus{
	height: auto;
	overflow: hidden;
	width: 170px;
	background: <?=$menu_background_color?>;
	position: absolute;
	z-index: 99;
	display: none;
}
#menu ul.sub-menus li {
	display: block;
	width: 100%;
}
#menu ul.sub-menus a {
	color: <?=$menu_text_color?>;
	font-size: 16px;
}
#menu li:hover ul.sub-menus {
	display: block
}
#menu ul.sub-menus a:hover{
	background: <?=$menu_background_color_hover_sub_menu?>;
	color: <?=$menu_text_color?>;
}
@media screen and (max-width: 800px){
	#menu {position:relative}
	#menu ul {background:#111;position:absolute;top:100%;right:0;left:0;z-index:3;height:auto;display:none}
	#menu ul.sub-menus {width:100%;position:static;}
	#menu ul.sub-menus a {padding-left:30px;}
	#menu li {display:block;float:none;width:auto;}
	#menu input, #menu label {position:absolute;top:0;left:0;display:block}
	#menu input {z-index:4}
	#menu input:checked + label {color:white}
	#menu input:checked + label:before {content:"\00d7"}
	#menu input:checked ~ ul {display:block}
}

<?
