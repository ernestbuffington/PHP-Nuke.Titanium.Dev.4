<?php
#---------------------------------------------------------------------------------------#
# HEADER                                                                                #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Inferno Theme v1.0 (Fixed & Full Width)                                               #
#                                                                                       #
# Final Build Date 03/16/2021 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Fire and Brimstone Theme Design.                                          #
# Copyright © 2021 By: TheGhost AKA EABuffington                                        #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 03/16/2021 Tuesday 12:54am (v1.0)                                         #
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

echo "\n\n/* themename/css/menu.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
/* .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: <?=$bgcolor3?> !important;
}
 */
?>
.over-ride{
font-size:4.6mm;
vertical-align: middle;
color: #cccccc;
}

.btn-hover-one {
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: transparent;
  border: 1px solid <?=$bgcolor1?>;
  border-radius: 1.0em;
  color: <?=$bgcolor4?>;
  cursor: pointer;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-self: center;
  -ms-flex-item-align: center;
  align-self: center;
  font-size: 0.5rem;
  font-weight: 400;
  line-height: 1;
  margin: 1px;
  padding: 1.2em 2.8em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
  background-color: <?=$bgcolor1?> !important;
  border-color: <?=$bgcolor2?>;
 -webkit-transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
  transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out; 
  display:inline-block;   
}

.btn-hover-one:hover {
    background-color: <?=$bgcolor2?> !important;
    # button border
    border-color: <?=$textcolor1?>;
    color: #CCC;
    outline: 1;
    # box background
    box-shadow: 0 0 40px 40px <?=$bgcolor2?> inset;
    display:inline-block;
}

.btn-hover-two {
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: transparent;
  border: 1px solid <?=$bgcolor4?>;
  border-radius: 1.9em;
  color: <?=$bgcolor1?>;
  cursor: pointer;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-self: center;
  -ms-flex-item-align: center;
  align-self: center;
  font-size: 0.5rem;
  font-weight: 400;
  line-height: 1;
  margin: 1px;
  padding: 1.2em 2.8em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
  background-color: <?=$bgcolor4?> !important;
  border-color: <?=$bgcolor2?>;
 -webkit-transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
  transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out; 
  display:inline-block;   
}

.btn-hover-two:hover {
    background-color: <?=$bgcolor3?> !important;
    # button border
    border-color: <?=$textcolor1?>;
    color: #CCC;
    outline: 1;
    # box background
    box-shadow: 0 0 40px 40px <?=$bgcolor2?> inset;
    display:inline-block;
}

/* Dropdown Button */
.dropbtn {
  background-color: <?=$bgcolor1?>;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: <?=$bgcolor1?>;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover 
{
  background-color: <?=$bgcolor2?>;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content 
{
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn 
{
  background-color: <?=$bgcolor1?>;
}

/* Dropdown Button */
.adropbtn {
  background-color: <?=$bgcolor2?>;
  border: none;
}

/* Dropdown Button */
.adropbtn-admin {
  background-color: none;
  border: none;
}


/* Change the background color of the dropdown button when the dropdown content is shown */
.adropdown:hover .adropbtn 
{
  color: <?=$bgcolor1?> !important;
  background-color: <?=$bgcolor4?>;
}


#ul.dropdown-content a:hover 
#{ 
#  color: <?=$bgcolor1?> !important;
#  background-color: <?=$bgcolor4?>; 
#}
<?


