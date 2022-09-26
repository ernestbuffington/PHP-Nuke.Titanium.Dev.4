<?php
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# GitHub Theme v1.0 (Fixed & Full Width)                                                #
#                                                                                       #
# Final Build Date 09/24/2022 Saturday 12:54am                                          #
#                                                                                       #
# A Very Nice Coder Theme Design                                                        #
# Copyright © 2021 By: TheGhost AKA EA Buffington                                       #
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
# Purpose: PHP-Nuke Titanium                                                            #
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


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

/*--------------------------*/
/* function OpenTable3() 
/*--------------------------*/
function OpenTable3() 
{
global $theme_name;

echo '<middle>';
echo '<table border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';
echo '<td><img name="tlc" src="themes/'.$theme_name.'/center/tlc.gif" width="20" height="25" border="0" alt=""></td>';
echo '<td width="100%" background="themes/'.$theme_name.'/center/tm.gif"><img name="tm" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="trc" src="themes/'.$theme_name.'/center/trc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td background="themes/'.$theme_name.'/center/left_side.gif"><img name="leftside" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '<td id="middlebg" class="topics_middleflames" height"0" valign="top" >';

echo '<div align="center" id="locator" class="title"><strong></strong></div>';
echo '<div align="left" id="text">'; 
echo '</div>';	
}
?>

