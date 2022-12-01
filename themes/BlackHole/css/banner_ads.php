<?php
global $theme_name;

echo "/* themes/".$theme_name."/css/banner_ads.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
/* <?=$bgcolor1?> */
?>
/**
 * Stylesheet for the Titanium Core Theme
 *
 * @filename:  banner_ads.php
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
 *  1.  Blinker
 *  2.  Marquee Settings
 *  3.  Banner Ad Settings
 * --- -------------------------------------------------------------------
 */

/*
 * 1. Blink Text
 *----------------------------------------
 */
 
blink{
animation: blinker 0.6s linear infinite;
color: #1c87c9;
}

@keyframes blinker {  
50% { opacity: 0; }
}

.blink-one {
animation: blinker-one 1s linear infinite;
}

@keyframes blinker-one {  
0% { opacity: 0; }
}

.blink-two {
animation: blinker-two 1.4s linear infinite;
}

@keyframes blinker-two {  
100% { opacity: 0; }
}

/*
 * 2. Marquee Settings
 *----------------------------------------
 */

.marquee_one {
  width: 484px;
  height: 23px;
  overflow: hidden;
  border: 1px solid #8c7c4e;
  background: #000000;
  color: #d1d8da;
  font-family: 'Roboto Mono', monospace;
  border-radius: 4px;
}

.marquee_two {
  width: 484px;
  height: 23px;
  overflow: hidden;
  border: 1px solid #8c7c4e;
  background: #000000;
  color: #d1d8da;
  font-family: 'Roboto Mono', monospace;
  border-radius: 4px;
}

/*
 * 3. Banner Ad Settings
 *----------------------------------------
 */



.banner_left {
position: absolute;
margin: 13px 115px 15px 115px;
left: 0;
display:inline;
z-index: 9999;
}

.banner_right {
position: absolute;
margin: -61px 115px 15px 10px;
right: 0;
display:inline;
z-index: 9999;
}

<?
