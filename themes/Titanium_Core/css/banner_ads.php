<?php
global $theme_name;

echo "\n\n/* themes/".$theme_name."/css/banner_ads.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
/* <?=$bgcolor1?> */
?>
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

.logo {
float: center;
position: relative;
margin: 0px 0px 0px 0px;
z-index: 777;
}

@import url(//db.onlinewebfonts.com/c/783dd6c2d08bdc67012a0eec73fc1702?family=80sPXLW00-Thin);

@font-face {font-family: "80sPXLW00-Thin"; src: url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.eot"); src: url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.woff") format("woff"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/783dd6c2d08bdc67012a0eec73fc1702.svg#80sPXLW00-Thin") format("svg"); }

.marquee_one {
  font-family: "80sPXLW00-Thin";
  width: 484px;
  height: 20px;
  overflow: hidden;
  border: 1px solid #404040;
  background: black;
  color: rgb(104, 182, 4);
}

.marquee_two {
  font-family: "80sPXLW00-Thin";
  width: 484px;
  height: 20px;
  overflow: hidden;
  border: 1px solid #404040;
  background: black;
  color: rgb(104, 182, 4);

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

.banner_box
{
z-index: 780;
color: rgb(104, 182, 4);
opacity: 9.0;
}

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
