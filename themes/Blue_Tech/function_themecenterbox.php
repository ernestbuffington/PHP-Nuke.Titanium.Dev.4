<?php
# THEME INFO                                                                            #
# Template Theme v1.0 (Fixed & Full Width)                                              #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

/*--------------------------*/
/* Theme CenterBox 
/*--------------------------*/
function themecenterbox($title, $content) 
{
 # This stays no matter what START
# check for invisible facebook blocks START
# we do not draw tables fo invisible facebook blocks!
global $invisble_facebook_block;
if ($invisble_facebook_block == true):
echo $content;
$invisble_facebook_block =  false;
else:
# check for invisible facebook blocks END
 # This stays no matter what END
#
#
#
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
# Top of center table START (this is where you edit for each theme design)
global $theme_name;	
print '<table class=blockz cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";
print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/tlc.png" border="0" width="39" height="50"></td>'."\n";

print '<td valign="top" align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/topmiddle.png);"><br><strong>'.$title.'</strong></td>'."\n";

print '<td align="right" width="39">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/trc.png" border="0" width="39" height="50"></td>'."\n";
print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";
print '<tr>'."\n";
print '<td width="23" height="3" background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/leftside.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/leftside.png" border="0" width="23" height="3"></td>'."\n";
print '<td width="100%">'."\n";
# Top of center table END  (this is where you edit for each theme design)
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#
#
#
#
# This stays no matter what START ---------------------------------------------------------------------------------------------------------------------------------
echo "<!-- CONTENT START -->\n\n\n\n\n";
print '<table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="#0b151f">'."\n";

print '<div align="center">';
print '<table style="background-color: none; height:100%; width:99%;" class="googlesitemap" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="googlesitemap">';
print '<tbody>';
print '<tr>';
print '<td>';

//content START
echo '<div align="left" id="text">';
echo ''.$content.'</div>';
//content END

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
#
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
# bottome of center table START (this is where you edit for each theme design)
print '</td>';
print '</tr>';
print '</table>';

print '</td>';
print '<td width="23" height="3" background="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/rightside.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/rightside.png" border="0" width="23" height="3"></td>'."\n";
print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/lbc.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/bm.png"></td>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/brc.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
# bottome of center table END (this is where you edit for each theme design)
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#
#
#
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
# This sets the space between center tables listed END -------------------------------------------------------------------------------------------------------------
 # This stays no matter what END	
}
?>
