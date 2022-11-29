<?php
global $theme_name;

echo "\n\n/* themes/".$theme_name."/css/body.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
if(empty($screen_width))
$screen_width = '1280px';

if(empty($screen_height))
$screen_height = '1024px';

?>
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

body{
background-color: black;
}
<?
