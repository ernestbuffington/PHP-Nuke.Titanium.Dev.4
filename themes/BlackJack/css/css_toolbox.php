<?php
global $theme_name; 
echo "/* themes/".$theme_name."/css/css_toolbox.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n";
global $bottun_hover_color, $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5, $fieldset_border_width, $locked_width;

$button_hover_border_color = '#1f7097';
$button_border_color = '#262525';
######################################################################################################
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('BOOKMARKS_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/blackbar.png"'); 
   define('BOOKMARKS_CONTAIN', 'background-repeat: no-repeat;
                          background-position: center center; 
					                              width 100%;
					                            height 115px;
					                            opacity: 100;
					                     visibility: inherit;
					                             z-index: 20;
					                  background-size: cover;');
######################################################################################################
   define('BOOKMARKS_TITLE_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/newredbar.png"'); 
   define('BOOKMARKS_TITLE_CONTAIN', 'background-repeat: no-repeat;
                                background-position: center center; 
					                                    width 100%;
					                                  height 115px;
					                                  opacity: 100;
					                           visibility: inherit;
					                                   z-index: 20;
					                        background-size: cover;');
######################################################################################################
define('HEADER_BACKGROUND', '"../../../themes/'.$theme_name.'/header/2056x2056.png"');
define('HEADER_CONTAIN', 'background-repeat: no-repeat;
                    background-position: center center; 
					                        width 100%;
					                      height 115px;
					                      opacity: 100;
					               visibility: inherit;
					                       z-index: 20;
					            background-size: cover;');
########################################################################################################
   define('SIDEBLOCK_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/2560x1080.png"');   
   define('SIDEBLOCK_CONTAIN', 'background-repeat: repeat-y;
                         background-position: center center; 
					                           opacity: 100;
					             background-size: auto auto');
########################################################################################################
define('FOOTER_BACKGROUND', '"../../../themes/'.$theme_name.'/header/2056x2056.png"');
define('FOOTER_CONTAIN', 'background-repeat: no-repeat;
                    background-position: center center; 
					                        width 100%;
					                      height 115px;
					                      opacity: 100;
					               visibility: inherit;
					                       z-index: 20;
					            background-size: cover;');
########################################################################################################
define('CENTER_BACKGROUND', '"../../../themes/'.$theme_name.'/header/2056x2056.png"');
define('CENTER_CONTAIN', 'background-repeat: no-repeat;
                    background-position: center center; 
					                        width 100%;
					                      height 115px;
					                      opacity: 100;
					               visibility: inherit;
					                       z-index: 20;
					            background-size: cover;');
########################################################################################################
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('E_MIDDLEHEADER_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/block_repeat_y_fix.png"'); 
   define('E_MIDDLEHEADER_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                         background-position: center center; 
					                                             width 100%;
					                                            height 100%;
					                                           opacity: 100;
					                                    visibility: inherit;
					                                            z-index: 20;
					                                  background-size: auto;');
					  
$filename_seven = 'dark.png';  
define('TABLE3_MIDDLEHEADER_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/'.$filename_seven.'"'); 
########################################################################################################
$filename2 = 'block_repeat_y_fix.png';  
define('THEME_ARTICLE_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/'.$filename2.'"'); 
define('THEME_ARTICLE_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                     background-position: CENTER CENTER; 
					                                         width 100%;
					                                        height 100%;
					                                       opacity: 100;
											        visibility: inherit;
					                                        z-index: 20;
					                              background-size: auto;');
########################################################################################################
$filename = 'block_repeat_y_fix.png';  
define('THEME_INDEX_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/'.$filename.'"'); 
define('THEME_INDEX_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                   background-position: center center; 
					                                       width 100%;
					                                       eight 100%;
					                                     opacity: 100;
											      visibility: inherit;
					                                      z-index: 20;
					                            background-size: auto;');
########################################################################################################
define('BODY_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/black_red_flame_borders_fixed.png"');
define('BODY_CONTAIN', 'background-size: 100% auto, cover;
                             background-attachment: fixed;
                              background-repeat: repeat-y;'); // stretch this whore out
?>
/*
 * COMMENT SYSTEM IN BLOG ARTICLES
 *----------------------------------------
 */
#respond {
  margin-top: 40px;
}

#respond input[type='text'],
#respond input[type='email'],
#respond textarea {
  margin-bottom: 10px;
  display: block;
  width: 100%;

  border: 1px solid rgba(0, 0, 0, 0.1);
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -o-border-radius: 5px;
  -ms-border-radius: 5px;
  -khtml-border-radius: 5px;
  border-radius: 5px;

  line-height: 1.4em;
}

/**
 * Stylesheet for the Titanium Core Theme
 *
 * @filename:  css_toolbox.php
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
 *  1. Footer Message Code 
 *  2. Bookmarks Code 
 *  3. function OpenTable() Code  
 *  4. Misc Test CSS
 * --- -------------------------------------------------------------------
 */

/*
 * 1. Footer Message Code
 *----------------------------------------
 */

a.googleminds:link {
  font-size:20px; !important;
  font-weight: 100 400;
}

a.googleminds:hover {
  font-size:20px; !important;
  font-weight: 100 400;
}

/*
 * 2. Bookmarks Code
 *----------------------------------------
 */

.bookmark
{
    /* opacity: 0.9; */
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	
}

.boxtitle
{
    /* opacity: 0.9; */
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	
}

.boxlist
{
    /* opacity: 0.9; */
    background: url(<?php echo BOOKMARKS_BACKGROUND; ?>);
	<?php echo BOOKMARKS_CONTAIN; ?> 	
}

/*
 * 3. function OpenTable3() Code
 *----------------------------------------
 */

.opentable_three {
  /* opacity: 0.9; */
  background: url(<?php echo TABLE3_MIDDLEHEADER_BACKGROUND; ?>); 
  background-repeat: repeat-y | repeat-x;
}

/*
 * 4. Misc Test CSS
 *----------------------------------------
 */

#borderSideBlocks {
border: 4px solid <?=$bgcolor5?>;
border-radius: 11px;
margin-left: 6px;
margin-right: 6px;
padding: 5px;
width: 220px;
background-color: black;
}

#borderCenterBlocks {
margin-left: 6px;
margin-right: 6px;
border: 4px solid <?=$bgcolor5?>;
border-radius: 11px;
background-color: black;
}

#borderFunctionOpenTable {
margin-left: 6px;
margin-right: 6px;
border: 4px solid <?=$bgcolor5?>;
border-radius: 11px;
padding: 16px;
background-color: black;
}


#borderThemeIndex {
margin-left: 6px;
margin-right: 6px;
border: 4px solid <?=$bgcolor5?>;
border-radius: 11px;
padding: 16px;
background-color: black;
}

#borderThemeArticle {
margin-left: 6px;
margin-right: 6px;
border: 4px solid <?=$bgcolor5?>;
border-radius: 11px;
padding: 16px;
background-color: black;
}

/* New Pagination */
.pagination_section{
  display: inline-block;
}

.pagination_section a {
  color: green;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination_section a.active {
  background-color: <?=$bgcolor5?>;
  color: white;
}

.pagination_section a:hover:not(.active) {background-color: <?=$bgcolor5?>;}

.pagination_section a {
  border-radius: 5px;
}

.pagination_section a.active {
  border-radius: 5px;
}

.pagination_section a {
  transition: background-color .3s;
}

.pagination_section a {
  border: 1px solid #ddd; /* Gray */
}

.pagination_section a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination_section a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}

.pagination_section a {
  margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
}

.pagination_section a {
  font-size: 22px;
}

.center {
  text-align: center;
}
/* Fancy Border Around Buttons                                  */
/* <button class="btn draw-border modules">Draw Border</button> */
.draw-border {
  box-shadow: inset 0 0 0 3px <?=$button_border_color?>;
  color: <?=$button_border_color?>;
  transition: color 0.25s 0.0833333333s;
  position: relative;
  border-radius: 6px;
}
.draw-border::before, .draw-border::after {
  border: 0 solid transparent;
  box-sizing: border-box;
  content: "";
  pointer-events: none;
  position: absolute;
  width: 0;
  height: 0;
  bottom: 0;
  right: 0;
  border-radius: 6px;
}
.draw-border::before {
  border-bottom-width: 4px;
  border-left-width: 4px;
  border-radius: 6px;
}
.draw-border::after {
  border-top-width: 4px;
  border-right-width: 4px;
  border-radius: 6px;
}
.draw-border:hover {
  color: <?=$button_hover_border_color?>;
  border-radius: 6px;
  box-shadow: inset 0 0 0 1px 1px;
}
.draw-border:hover::before, .draw-border:hover::after {
  border-color: <?=$button_hover_border_color?>;
  transition: border-color 0s, width 0.25s, height 0.25s;
  width: 100%;
  height: 100%;
  border-radius: 6px;
  box-shadow: inset 0 0 0 1px 1px;
}
.draw-border:hover::before {
  transition-delay: 0s, 0s, 0.25s;
  border-radius: 6px;
  box-shadow: inset 0 0 0 1px 1px;
}
.draw-border:hover::after {
  transition-delay: 0s, 0.25s, 0s;
  border-radius: 6px;
  box-shadow: inset 0 0 0 1px 1px;
}

.btn86 {
  cursor: pointer;
  line-height: 1.5;
  font: 700 1.2rem "Roboto Slab", sans-serif;
  padding: 6px 6px;
  letter-spacing: 0.05rem;
  border-radius: 6px;
}
.btn86:focus {
  outline: 2px dotted #55d7dc;
  border-radius: 6px;
}

body {

}

input[type='text'] {
    color: <?=$textcolor1?>;
    border: 1px solid silver;
    font-family:'Montserrat', sans-serif;
    text-align: left;
    line-height: 1;
    font-size: 12px;
    background-color : <?=$button_border_color?>;
    padding: 6px;
    outline: none;
    border-radius: 6px;
 }

input[type='email'] {
    color: <?=$textcolor1?>;
    border: 1px solid silver;
    font-family:'Montserrat', sans-serif;
    text-align: left;
    line-height: 1;
    font-size: 12px;
    background-color : <?=$button_border_color?>;
    padding: 6px;
    outline: none;
    border-radius: 6px;
 }

textarea[name='message'] {
    color: <?=$textcolor1?>;
    border: 1px solid silver;
    font-family:'Montserrat', sans-serif;
    text-align: left;
    line-height: 1;
    font-size: 12px;
    background-color : <?=$button_border_color?>;
    padding: 6px;
    outline: none;
    border-radius: 6px;
 }
input[type='radio']
{
  width:18px;
  height:18px;
}

input[type='radio'] {
    color: <?=$textcolor1?>  !important;
    border: 1px solid silver;
    font-family:'Montserrat', sans-serif;
    text-align: left;
    line-height: 1;
    font-size: 12px;
    background-color : <?=$button_border_color?>  !important;
    padding: 6px;
    outline: none;
    border-radius: 6px;
 }

.forum_footer_icons
{
  table-layout: auto;
  width: 50%;
  border-collapse: collapse;
  padding: 0px;
  border-spacing: 0px;
  background-color: #151515;
}

input[type='button'] {
    transition: all .5s ease;
    color: white;
    border: 1px solid #bfbfbf;
    font-family:'Montserrat', sans-serif;
    text-transform: uppercase;
    text-align: center;
    line-height: 1;
    font-size: 12px;
    font-weight: bold;
    background-color : black;
    padding: 6px;
    outline: none;
    border-radius: 4px;
}
input[type='button']:hover {
    color: goldenrod;
    border: 1px solid <?=$button_hover_border_color?>;
    background-color: #151515;
    font-weight: bold;
}

input[type='submit'] {
    transition: all .5s ease;
    color: white;
    border: 1px solid #bfbfbf;
    font-family:'Montserrat', sans-serif;
    text-transform: uppercase;
    text-align: center;
    line-height: 1;
    font-size: 12px;
    font-weight: bold;
    background-color : black;
    padding: 6px;
    outline: none;
    border-radius: 4px;
}
input[type='submit']:hover {
    color: goldenrod;
    border: 1px solid <?=$button_hover_border_color?>;
    background-color: #151515;
    font-weight: bold;
}

a.buttonlink:link {
    transition: all .5s ease;
    color: white;
    border: 1px solid #bfbfbf;
    font-family:'Montserrat', sans-serif;
    text-transform: uppercase;
    text-align: center;
    line-height: 1;
    font-size: 12px;
    font-weight: bold;
    background-color : black;
    padding: 6px;
    outline: none;
    border-radius: 4px;
}
a.buttonlink:hover {
    color: goldenrod;
    border: 1px solid <?=$button_hover_border_color?>;
    background-color: #151515;
    font-weight: bold;
}

a.SMALLbuttonlink:link {
    transition: all .5s ease;
    color: <?=$textcolor1?>;
    border: 0.1px solid <?=$button_border_color?>;
    font-family:'Montserrat', sans-serif;
    text-transform: uppercase;
    text-align: center;
    line-height: 1;
    font-size: 8px;
    font-weight: bold;
    background-color : black;
    padding: 6px;
    outline: none;
    border-radius: 4px;
}
a.SMALLbuttonlink:hover {
    color: green;
    background-color: #151515;
    font-weight: bold;
}

/* Add a link anywhere on page */
.btn-overlay {
    position: absolute;
    padding: 0;
    top: 0;
    left: 0;
    background-color: #ffffff;
    opacity: 0.5;
    transition: opacity .5s;
}

.fit-top-center 
{
  object-position: top center;
}
.fitted-image 
{
  width: 100%;
  height: 100vh;
  object-fit: cover; 
}

.linkUSlegend{
  margin-top: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  margin-right: 0px;
  
  
}

#linkUSfieldset{
  padding-left: 6px;
  padding-right: 6px;
  padding-top: 6px;
  padding-bottom: 6px;
  margin-top: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  margin-right: 0px;
}


.linkUStable{
  padding-left: 6px;
  padding-right: 6px;
  padding-top: 6px;
  padding-bottom: 6px;
  margin-top: 6px;
  margin-bottom: 6px;
  margin-left: 6px;
  margin-right: 6px;
}

td.HeightController{
  height: 205px !important;
  overflow: hidden;
  padding-left: 8px;
  padding-right: 8px;
  padding-top: 8px;
  padding-bottom: 8px;
  margin-top: 8px;
  margin-bottom: 8px;
  margin-left: 8px;
  margin-right: 8px;
}

.progress-bar
{
	position: relative;
	margin:0 auto; 
	width: 98%; 
	height: 25px;
	padding: 1px; 
	border: 2px solid silver;
	box-shadow: 0 0 2px #333;
}

.progress-bar > span 
{
	display: block;
	height: 100%;
	max-width:100%;
	background: green;
	position: relative;
	overflow: hidden;
	width: 50%;
	transition: width 0.8s;
}

.progress-bar > span.upload 
{
	display: block;
	height: 100%;
	background: green;
	position: relative;
	overflow: hidden;
	width: 0%;
	transition: width 0.8s;
}

