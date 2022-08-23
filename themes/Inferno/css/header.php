<?php
#---------------------------------------------------------------------------------------#
# HEADER FLYKIT CSS                                                                     #
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

echo "\n\n/* Universal/css/header.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height;

?>

img.rounded-corners {
  border-radius: 20px; 
}

img.rounded-corners-last-vistors {
  border-radius: 9px; 
}

img.rounded-corners-user-info {
  border-radius: 20px; 
}

.frame {
  background-clip: padding-box;
}

fieldset 
{
	display: block; 
	margin-left: 2px; 
	margin-right: 2px; 
	padding-top: 0.15em; 
	padding-bottom: 0.625em; 
	padding-left: 0.75em; 
	padding-right: 0.75em; 
	border:2px solid;
   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;
}

.banner_box
{
z-index: 780;
color: rgb(104, 182, 4);
opacity: 9.0;
}

.outer_table_opacity
{
  opacity: 0.9;
}
.inferno_header_table
{
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

.modal-body {
#   background-image: url(themes/<?=$theme_name?>/backgrounds/1920x1080.png);
}

.modal-backdrop {
}

.modal .modal-popout-bg {
    background-image: url(themes/<?=$theme_name?>/backgrounds/modal_theme_copyright_pop_bg.png); 
}

.modal {
 
  /* Take the box out of the flow, so that it could look like a modal box */
  # position: absolute;

  /* Avoid the awkwardly stretchy box on bigger screens */
  # max-width: 550px;

  /* Aligning it to the absolute center of the page */
  # top: 50%;
  # left: 50%;
  # transform: translate(-50%, -50%);

  /* Some cosmetics */
  # border-radius: 4px;
  # background-color: rgba(0, 0, 0, .1);
  
}

.modal-hidden {
  display: none;
}

/* Make the media inside the box adapt the width of the parent */
.modal img,
.modal iframe,
.modal video 
{
  max-width: 100%;
}

/* Make the inner element relatively-positioned to contain the close button */
.modal-inner {
  position: relative;
  padding: 10px;
}

/* Close button */
.modal-close {
  font-size: 10px;

  /* Take it out of the flow, and align to the top-left corner */
  position: absolute;
  top: -10px;
  right: -10px;

  /* Size it up */
  width: 24px;
  height: 24px;

  /* Text-alignment */
  text-align: center;

  /* Cosmetics */
  color: #eee;
  border-width: 0;
  border-radius: 100%;
  background-color: black;
}
<?
