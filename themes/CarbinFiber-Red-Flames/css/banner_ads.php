<?php
#---------------------------------------------------------------------------------------#
# HEADER                                                                                # 
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Inferno Theme v1.0 (Fixed & Full Width)                                               #
#                                                                                       #
# Final Build Date 10/09/2022 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Gold Template Theme                                                       #
# Copyright © 2021 : Brandon Maintenance Management                                     #
# e-Mail : brandon.maintenance.management@gmail.com                                     #
#---------------------------------------------------------------------------------------#
# Designed By: Ernest Buffington                                                        #
# Web Site: https://www.theghost.86it.us                                                #
# Purpose: PHP-Nuke Titanium v4.0.2                                                     #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2002    : Francisco Burzi phpnuke.org                          #
# Nuke Evolution Xtreme (c) 2010 : Enhanced PHP-Nuke Web Portal System                  #
# PHP-Nuke Titanium (c) 2022     : Enhanced and Advanced PHP-Nuke Web Portal System     #
#---------------------------------------------------------------------------------------#
#                                                                                       #
# Special Honorable Mentions                                                            #
#---------------------------------------------------------------------------------------#
# killigan                                                                              # 
# -[04/17/2010] Updated Nuke Sentinel to version 2.6.01                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# SgtLegend                                                                             #   
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
# -[04/18/2010] Updated the installer/upgrade files and display                         #
# -[04/19/2010] Improved load time for global variables                                 #
# -[04/21/2010] Upgraded Swift mail to version 4.0.6                                    #
# -[04/21/2010] Upgraded HTML Purifier to version 4                                     # 
#---------------------------------------------------------------------------------------#
# Technocrat                                                                            # 
# -[04/22/2010] Added speed tweaks to the cache and PHP version compare                 #  
#---------------------------------------------------------------------------------------#
# Eyecu                                                                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# Wolfstar                                                                              # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#

global $theme_name;

echo "\n\n/* themename/css/banner_ads.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
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
  left: 0;
  display: block;
  margin: 10px 0px 0px 9px;
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
  margin: 10px 0px 0px 86px;
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
margin: 92px 95px 15px 95px;
left: 0;
display:inline;
z-index: 9999;
}

.banner_right {
position: absolute;
margin: 15px 95px 15px 10px;
right: 0;
display:inline;
z-index: 9999;
}

@import url('https://fonts.googleapis.com/css?family=Pirata+One|Rubik:900');

h1 {
text-transform: Uppercase;
margin-bottom: .5em;
font-family: 'Rubik', sans-serif;
font-size: 6rem;
color: #E4E5E6; }

h1 {
position: relative;
background: linear-gradient(to right, gold, red, gold);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent; }

h1:before,
h1:after {
content: attr(data-text);
position: absolute;
top: 0;
left: 0; }

h1:before {
z-index: -1;
text-shadow: -0.001em -0.001em 1px rgba(255,255,255,.15)}

h1:after {
z-index: -2;
text-shadow: 10px 10px 10px rgba(0,0,0,.5), 20px 20px 20px rgba(0,0,0,.4), 30px 30px 30px rgba(0,0,0,.1);
mix-blend-mode: multiply; }

h2 {
margin-top: -1.15em;
font-family: 'Pirata One', cursive;
font-size: 3rem;
color: #E44D26;
text-align: center;}

h2 spam {
  font-size: 1.4em; 
}
<?
