<?php 
global $theme_name;
echo "/* themes/".$theme_name."/css/links.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n"; 

global $font_color, $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
global $font_colorH, $font_colorV, $font_colorA, $font_colorL, $body_color; 

?>
/**
 * Stylesheet for the Titanium Core Theme
 *
 * @filename:  links.php
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
 *  1.  Links for Entire Website
 * --- -------------------------------------------------------------------
 */

/*
 * 1. Links for Entire Website
 *----------------------------------------
 */
/* Modules Link START */
a.modules,input.modules
{
 display:inline-block;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: grey;
 
 text-align:center;
 transition: all 0.2s;
}
a.modules:hover,input.modules:hover
{
  /* Main Font Color */
  color: #1f7097;
 /* Highlight Color On Hover */
}

@media all and (max-width:30em)
{
  a.modules, input.modules
  {
    display:block;
  }
}
/* Modules Link END */

.circle {

}

/* Project Link Active Project START */
a.projectlinkactive,input.projectlkactive
{
 display:inline-block;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: #66FF00;
 
 text-align:center;
 transition: all 0.2s;
}
a.projectlinkactive:hover,input.projectlinkactive:hover
{
  /* Main Font Color */
  color:white;
 /* Highlight Color On Hover */
}

@media all and (max-width:30em)
{
  a.projectlinkactive, input.projectlinkactive
  {
    display:block;
  }
}
/* Project Link Active Project END */

/* Project Link InActive Project START */
a.projectlinkinactive,input.projectlinkinactive
{
 display:inline-block;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: grey;
 
 text-align:center;
 transition: all 0.2s;
}

a.projectlinkinactive:hover,input.projectlinkinactive:hover
{
  /* Main Font Color */
  color:white;
 /* Highlight Color On Hover */
}

@media all and (max-width:30em)
{
  a.projectlinkinactive, input.projectlinkinactive
  {
    display:block;
  }
}
/* Project Link InActive Project END */

/* Project Link Pending Project START */
a.projectlinkpending,input.projectlinkpending
{
 display:inline-block;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: #66FFFF;
 
 text-align:center;
 transition: all 0.2s;
}
a.projectlinkpending:hover,input.projectlinkpending:hover
{
  /* Main Font Color */
  color:white;
 /* Highlight Color On Hover */
}

@media all and (max-width:30em)
{
  a.projectlinkpending, input.projectlinkpending
  {
    display:block;
  }
}
/* Project Link Pending Project END */


/* Project Link Released Project START */
a.projectlinkreleased,input.projectlinkreleased
{
 display:inline-block;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: #FF3366;
 
 text-align:center;
 transition: all 0.2s;
}
a.projectlinkreleased:hover,input.projectlinkreleased:hover
{
  /* Main Font Color */
  color:white;
 /* Highlight Color On Hover */
}

@media all and (max-width:30em)
{
  a.projectlinkreleased, input.projectlinkreleased
  {
    display:block;
  }
}
/* Project Link Released Project END */


/* Regular Project Link */
a.projectlink,input.projectlink
{
 display:inline-block;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: white;
 
 text-align:center;
 transition: all 0.2s;
}
a.projectlink:hover,input.projectlink:hover
{
  /* Main Font Color */
  color:white;
 /* Highlight Color On Hover */
}

@media all and (max-width:30em)
{
  a.projectlink, input.projectlink
  {
    display:block;
  }
}

<?
