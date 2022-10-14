<?php
#---------------------------------------------------------------------------------------#
# HEADER FLYKIT CSS                                                                     #
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

echo "\n\n/* Universal/css/header.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $font_color, $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
global $font_colorH, $font_colorV, $font_colorA, $font_colorL, $body_color; 


?>
/**
 * Very simple jQuery plugin to keep all important admin link in a nice floating menu. 
 *
 * @package    Floating admnistration links
 * @author     Author <crazycoder@live.co.uk>
 * @copyright  2016 - 2019 by lonestar-modules.com
 * @version    2.0
 */

.toggle-menu 						
{ 
position: fixed; 
padding: 15px 20px 15px 15px; 
margin-top: 120px; 
/*color: white;*/ 
cursor: pointer; 
background-color: rgba(17,17,17,0.9); 
z-index: 1000; font-size: 2em; 
}

.toggle-menu > .fa-menu-icon 		
{ 
transition: transform .3s; color: #d8d8d8; 
}

.toggle-menu:hover > .fa-menu-icon 	
{ 
transition: transform .3s; 
transform: rotate(-180deg) scale(1); 
}

.sidebar-menu 						
{ 
position: fixed; 
width: 250px; 
z-index: 999999999; 
top: 0; 
left: 0; 
bottom: 0; 
background-color: <?=$bgcolor4?>; 
color: <?=$font_colorH?>;
height: 100vh;	
max-height: 100%; 
}

.sidebar-menu ul 					
{ 
list-style: none; 
color: <?=$font_colorH?>;
}

.fa-times-extend 					
{ 
color: <?=$font_colorH?>;
right: 10px; 
top: 8px; 
cursor: pointer; 
position: absolute; 
transition: all 0.2s ease-in-out; 
font-size: 20px; 

}

.fa-times-extend:hover 				
{ 
opacity: 1; 
color: red; 
}

.navigation-section 				
{ 
padding: 0; 
margin: 35px 0; 
display: block; 
color: <?=$font_colorH?>;
}

.navigation-item 					
{ 
font-weight: 200; 
box-sizing: border-box; 
font-size: 14px; 
transition: all 0.3s; 
cursor: pointer; 
color: <?=$font_colorH?>;
}

.navigation-item-divider 			
{ 
display: block; 
margin: 10px 20px; 
border-top: 1px solid #0a0a0a; 
-webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.04); 
box-shadow: inset 0 1px 0 rgba(255,255,255,.04); 
height: 8px; 
color: <?=$font_colorH?>;
}

.navigation-item a 					
{ 
user-select: none; 
position: relative; 
display: block; 
padding: 5px 20px; 
font-family: inherit; 
font-weight: 200; 
font-size: 14px; 
color: <?=$font_colorH?>;
}
.navigation-item a:before 			
{ 
content: ''; 
display: block; 
position: absolute; 
width: 0; 
height: 100%; 
left: 0; 
top: 0; 
-webkit-transition: width .3s; 
transition: width .3s; 
color: <?=$font_colorH?>;
}

.navigation-item a:focus:before, 
.navigation-item a:hover:before 	
{ 
width: 4px; 
color: <?=$font_colorH?>;
}

.navigation-item a .fas 			
{ 
color: <?=$font_colorH?>;
vertical-align: sub; 
text-align: left; 
font-size: 22px; 
width: 1.2857142857142858em; 
}

.navigation-section > li:hover > a, 
.navigation-section > li > a:hover 	
{ 
background-color: rgba(0,0,0,.2); 
transition: width 3s 
color: <?=$font_colorH?>;
}

.hide-menu 							
{ 
margin-left: -252px; 
color: <?=$font_colorH?>;
}

.opacity-one 						
{ 
opacity: 1; 
transition: all 0.2s; 
color: <?=$font_colorH?>;
}
