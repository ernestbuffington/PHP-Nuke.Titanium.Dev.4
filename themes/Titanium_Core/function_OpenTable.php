<?php
#---------------------------------------------------------------------------------------#
# function OpenTable                                                                    #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Titanium Core Theme v2.0 (Fixed & Full Width)                                         #
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


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

/*--------------------------*/
/* function OpenTable() 
/*--------------------------*/
function OpenTable() 
{
global $theme_name, $bgcolor4;

echo "\n\n<!-- function_OpenTable START -->\n";
print '<table class=table100">'."\n";

print '<tr><td class="tableSB_width_definedLT">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/top_left_corner.png" width="39px" height="50px"></td>'."\n";

print '<td class="opentable_width_definedTM"></td>'."\n";

print '<td class="tableSB_width_definedLT">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/top_right_corner_10.png" width="39px" height="50px"></td>'."\n";

print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table class="table100">'."\n";
print '<tr>'."\n";

print '<td class="table1_width_definedLSM">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/left_side_middle_151515.png" width="39px" height="3px"></td>'."\n";

print '<td width="100%">'."\n";
print '<table class="table100">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";
echo "<!-- function_OpenTable top END -->\n\n\n\n\n";
}
?>


