<?php
global $theme_name;
echo "/* Fly Kit Body Style Sheet */\n"; 
echo "/* ".$theme_name."/css/body.php (Body Style Sheet) */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Main Theme Body                                               */
/*                                                               */
/* Designed and Coded By: Ernest Buffington aka TheGhost         */
/* Coded On: 16th October, 2022                                  */
/* Copyright © 2022 Brandon Maintenance Management               */
/*                                                               */
/* PLEASE STEAL AND/OR USE THIS CSS CODE                         */
/* NO NEED FOR WRITTEN PERMISSION                                */
/* I did not trade a goat for this code!                         */
/*---------------------------------------------------------------*/
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
/*---------------------------------------------------------------*/
/* Main Theme Body                                               */
/*---------------------------------------------------------------*/
fieldset {
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
 background-color: #00b3ff;
  border: 0;
   height: 1px;
  margin: 5px 0;
 width: 100%;
opacity: 0.4;
}

.outer_table_opacity {
 opacity: 0.9;
}

.inferno_header_table {
 opacity: 0.9;
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

/*---------------------------------------------------------------*/
/* Full Screen Video Background v1.0                             */
/*                                                               */
/* Designed and Coded By: TheGhost                               */
/* Coded On: 22nd January, 2007                                  */
/* Copyright © 2007 TheGhost All Rights Reserved                 */
/*                                                               */
/* This uses Advanced Resolution Checking v1.0                   */
/*---------------------------------------------------------------*/
.fullscreen-bg {
 position: fixed;
  top: 0;
   right: 0;
    bottom: 0;
   left: 0;
  overflow: hidden;
 z-index: -100;
}

.fullscreen-bg__video {
 position: absolute;
  top: 0;
   left: 0;
  width: 100%;
 height: <?=$screen_height?>;
}

@media (max-width: <?=$screen_width?>) {
  
  .fullscreen-bg {
  }

  .fullscreen-bg__video {
    display: none;
  }

}

body {
  background-color: black;	
}

/*
 * Body Content wrappers
 *--------------------------------------------------
*/

.body-background {
	background-color: #000000;
}

.body-background2 {
	background-color: #000000;
}

.top_and_bottom {
  background-color: black;	
    background-image: 
     url(../../../themes/<?=$theme_name?>/backgrounds/glasstop.png),
     url(../../../themes/<?=$theme_name?>/backgrounds/sidebox_bottom.png);
     background-position:
    top right,            /* this positions the first image - TheGhost add 8/2/2019 */
   bottom left;           /* this positions the second image - TheGhost add 8/2/2019 */
  background-repeat:
 no-repeat;               /* this applies to both images - TheGhost add 8/2/2019 */ 
}
<?
