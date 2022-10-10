<?php
#---------------------------------------------------------------------------------------#
# function CloseTable                                                                   #
#---------------------------------------------------------------------------------------#
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

#--------------------------#
# function CloseTable() 
#--------------------------#
function CloseTable() 
{
global $theme_name;

 global $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor2, $pagetitle; 

echo "\n\n\n\n\n<!-- function_CloseTable top START -->\n";
print '</td>';
print '</tr>';
print '</table>';
print '</td>';

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/right_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/right_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/TABLES/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/bottom_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/bottom_middle_piece.png"></td>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/TABLES/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/bottom_right_corner.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
	
print '<div align="center" style="padding-top:6px;">'."\n";
print '</div>'."\n";

//echo '<img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="1" height="4" border="0" />';

echo "<!-- function_CloseTable END -->\n\n\n";
}
?>
