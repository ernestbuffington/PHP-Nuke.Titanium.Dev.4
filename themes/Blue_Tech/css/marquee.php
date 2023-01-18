<?php 
global $theme_name;
echo "/* Fly Kit Marquee Style Sheet */\n"; 
echo "/* ".$theme_name."/css/marquee.php (Scrolling Marquees) */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Marquee CSS                                                   */
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
/* Marquee CSS                                                   */
/*---------------------------------------------------------------*/

blink {
 animation: blinker 0.6s linear infinite;
  color: #1c87c9;
}

@keyframes blinker {  
  50% { opacity: 0; }
}

.blink-one {
  animation: blinker-one 1s linear infinite;
}

@keyframes blinker-one 
{  
  0% { opacity: 0; }
}

.blink-two {
  animation: blinker-two 1.4s linear infinite;
}

@keyframes blinker-two {  
  100% { opacity: 0; }
}

@import url(//db.onlinewebfonts.com/c/783dd6c2d08bdc67012a0eec73fc1702?family=80sPXLW00-Thin);

@font-face {font-family: "80sPXLW00-Thin"; src: url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.eot"); src: url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.woff") format("woff"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.svg#80sPXLW00-Thin") format("svg"); }

.marquee_one {
  left: 0;
  display: block;
  margin: 10px 0px 0px 10px;
  font-family: "80sPXLW00-Thin";
  width: 484px;
  height: 20px;
  overflow: hidden;
  border: 1px solid #404040;
  background: black;
  color: rgb(104, 182, 4);
}

.marquee_two {
  right: 0;
  display: block;
  margin: 10px 0px 0px 89px;
  font-family: "80sPXLW00-Thin";
  width: 484px;
  height: 20px;
  overflow: hidden;
  border: 1px solid #404040;
  background: black;
  color: rgb(104, 182, 4);
}
<?
