<?php
#---------------------------------------------------------------------------------------#
# HEADER                                                                                # 
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Right White Theme v1.0 (Fixed & Full Width)                                           #
#                                                                                       #
# Final Build Date 09/24/2022 Saturday 12:54am                                          #
#                                                                                       #
# A Very Nice White Theme Design.                                                       #
# Copyright © 2021 By: TheGhost AKA EABuffington                                        #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 09/24/2022 Saturday 12:54am (v1.0)                                        #
#                                                                                       #
# Credit goes to Lonestar On: 1st August, 2019 (v3.0)                                   #
# HTML5 Theme Code By: Lonestar (Lonestar-Modules.com)                                  #
#                                                                                       #
# Credit goes to TheMortal                                                              #
# For his CSS MENU                                                                      #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost & Sebastian                                                     #
# Web Site: https://www.86it.us                                                         #
# Purpose: PHP-Nuke Titanium | Nuke Evolution Xtreme                                    #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# Nuke Evolution Xtreme (c) 2010 : Enhanced PHP-Nuke Web Portal System                  #
# PHP-Nuke Titanium (c) 2021     : Enhanced PHP-Nuke Web Portal System                  #
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
