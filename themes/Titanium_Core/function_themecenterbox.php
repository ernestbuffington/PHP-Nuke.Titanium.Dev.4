<?php
#---------------------------------------------------------------------------------------#
# function themecenterbox                                                               #
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Titanium_Core Theme v2.0 (Fixed & Full Width)                                         #
#                                                                                       #
# Final Build Date 03/16/2021 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Gold Theme Design.                                                        #
# Copyright © 2021 By: TheGhost AKA EA Buffington                                       #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

/*--------------------------*/
/* Theme CenterBox 
/*--------------------------*/
function themecenterbox($title, $content) 
{
 # This stays no matter what START --------------------------------------------------------------------------------------------------------------------------
# check for invisible facebook blocks START
# we do not draw tables fo invisible facebook blocks!
global $invisble_facebook_block;
if ($invisble_facebook_block == true):
echo $content;
$invisble_facebook_block =  false;
else:
# check for invisible facebook blocks END
 # This stays no matter what END -----------------------------------------------------------------------------------------------------------------------------
#
#
#
######################################################################################
# Top of center table START (this is where you edit for each theme design)           # CUT START
######################################################################################

global $theme_name;	
global $bgcolor4;
# top half of center table START
print '<table bgcolor="'.$bgcolor4.'" class="blockz" cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";
# invisble image spacer for top right table image!
print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/invisible_pixel.gif);">'."\n";
# top left corner of center table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/top_left_corner.png" border="0" width="39" height="50"></td>'."\n";
# top middle piece for center table
print '<td valign="top" align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/top_middle_piece.png);"><br><strong>'.$title.'</strong></td>'."\n";
print '<td align="right" width="39">'."\n";
# top right corner of center table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/top_right_corner_10.png" border="0" width="39" height="50"></td>'."\n";
print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";
print '<tr>'."\n";
# table left middle side
print '<td width="23" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/left_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/left_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";
print '<td width="100%">'."\n";
######################################################################################
# bottom half of center table END (this is where you edit for each theme design)     # CUT END
######################################################################################
#
 #
 #
# This stays no matter what START ------------------------------------------------------------------------------------------------------------------------------
echo "<!-- CONTENT START -->\n\n\n\n\n";
print '<table bgcolor="'.$bgcolor4.'" style="background-color: '.$bgcolor4.'; cellSpacing="0" cellPadding="8" width="100%" border="5" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";
print '<div align="center">';

print '<table bgcolor="'.$bgcolor4.'" style="background-color: '.$bgcolor4.'; height:100%; width:99%;" class="centerblock" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="centerblok">';
print '<tbody>';
print '<tr>';
print '<td>';
echo '<div align="left" id="text">';
echo ''.$content.'</div>';
print '</td>';
print '</tr>';
print '</tbody>';
print '</table>';
print '</div>';
echo "\n\n\n\n\n<!-- CONTENT END -->\n";
# This stays no matter what END	---------------------------------------------------------------------------------------------------------------------------------
 #
 #
#
######################################################################################
# bottome half of center table START (this is where you edit for each theme design)  # CUT START
######################################################################################
print '</td>';
print '</tr>';
print '</table>';

print '</td>';
print '<td width="23" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/right_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/right_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";
print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/bottom_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/bottom_middle_piece.png"></td>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/bottom_right_corner.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
######################################################################################
# bottome half of center table END (this is where you edit for each theme design)    # CUT END
######################################################################################
#
#
#
 # This stays no matter what START ---------------------------------------------------------------------------------------------------------------------------------	
# check for invisible facebook blocks START
endif;
# check for invisible facebook blocks END

# This sets the space between center tables listed START
print '<div align="center" style="padding-top:6px;">';
print '</div>';
# This sets the space between center tables listed END 
 # This stays no matter what END ------------------------------------------------------------------------------------------------------------------------------------	
}
?>
