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
.above_banner_left {
position: absolute;
margin: 0px 0px 0px 82px;
left: 0;
display:inline;
z-index: 9999;
}

.above_banner_right {
position: absolute;
margin: 0px 82px 0px 0px;
right: 0;
display:inline;
z-index: 9999;
}

.above_marquee_one {
  width: 484px;
  height: 23px;
  overflow: hidden;
  color: #d1d8da;
  font-family: 'Roboto Mono', monospace;
  border-radius: 4px;
  text-align: center;
  font-size: 1.2em;
  font-weight: 900;
  text-shadow: 2px 2px #000000;
}

.above_marquee_two {
  width: 484px;
  height: 23px;
  margin-top: 0px;
  margin-bottom: 0px;
  margin-left: 97px;
  margin-right: 0px;
  overflow: hidden;
  color: #d1d8da;
  font-family: 'Roboto Mono', monospace;
  border-radius: 4px;
  text-align: center;
  font-size: 1.2em;
  font-weight: 900;
  text-shadow: 2px 2px #000000;
}

.marquee_one {
  width: 484px;
  height: 23px;
  overflow: hidden;
  border: 1px solid silver;
  background: #151515;
  color: #d1d8da;
  font-family: 'Roboto Mono', monospace;
  border-radius: 4px;
}

.marquee_two {
  margin-top: 0px;
  margin-bottom: 0px;
  margin-left: 97px;
  margin-right: 0px;
  width: 484px;
  height: 23px;
  overflow: hidden;
  border: 1px solid silver;
  background: #151515;
  color: #d1d8da;
  font-family: 'Roboto Mono', monospace;
  border-radius: 4px;
}

/*
 * 3. Banner Ad Settings
 *----------------------------------------
 */

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

td.marquee_left {
display: inline-block;
margin-top: 20px;
margin-bottom: 0px;
margin-left: 0px;
margin-right: 0px;
}

td.marquee_right {
display: inline-block;
margin-top: 20px;
margin-left: 29px;
}

.banner_left {
position: absolute;
margin: 0px 0px 0px 82px;
left: 0;
display:inline;
z-index: 9999;
}

.banner_right {
position: absolute;
margin: 0px 82px 0px 0px;
right: 0;
display:inline;
z-index: 9999;
}

<?
