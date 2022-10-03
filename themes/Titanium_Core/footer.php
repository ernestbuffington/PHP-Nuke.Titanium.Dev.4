<?php 
#---------------------------------------------------------------------------------------#
# FOOTER                                                                                #
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
# Titanium Core Footer Section      #
#-----------------------------------#
# Fixed & Full Width Style    #
#-----------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

global $customlang, 
        $ThemeInfo, 
		  $banners, 
	   $theme_name;

//if(blocks_visible('right') && !defined('ADMIN_FILE')):

echo '<!-- FOOTER START -->';
global 
	   $index, 
	    $titanium_user, 
	 $banners, 
	  $cookie, 
         $titanium_dbi, 
		  $titanium_db, 
	   $admin, 
   $adminmail, 
  $total_phpbb2_time, 
  $phpbb2_start_time, 
       $foot1, 
	   $foot2, 
	   $foot3, 
	   $foot4,
	   $foot5, 
	 $nukeurl, 
	      $ip, 
  $theme_name, 
   $ThemeInfo,
    $bgcolor4,
      $titanium_prefix;


if(blocks_visible('right')) 
{
  echo "</td>\n";
  
  echo "<td style=\"width: 5px;\" valign=\"top\"><img src=\"themes/".$theme_name."/images/FOOTER/invisible_pixel.gif\" alt=\"\" width=\"5\" height=\"1\" /></td>\n";
  
  echo "<td style=\"width: 170px;\" valign=\"top\">\n";

  blocks('right');
}

echo "</td>\n";
echo "<td valign=\"top\"></td>\n";
echo "</tr>\n";
echo "</table>\n\n\n";
    
echo "\n\n<!-- Top Footer START -->\n";
print '<table class=blockz cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";

print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/top_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/top_middle_piece.png);"></td>'."\n";

print '<td align="right" width="39">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/top_right_corner_10.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";
print '<tr>'."\n";

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/left_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/left_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '<td width="100%">'."\n";
print '<table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";
echo "<!-- Top Footer END -->\n\n\n\n\n";


echo '<div align="center">';
footmsg();
echo '</div>'; 

//echo '<section id="flex-container">';
//echo '<div class="flex-item" style="width: 100%; height: 0px; ">';
//echo '<div class="tooltip-html center" style="font-size: 1;" title="'.theme_copyright.'"><span style="color: #ffffff;">'.str_replace('<br />', '', 'Universal Theme Design By The 86it Developers Network &copy; 2019-2021').'</span></div>';
//echo '</div>';
//echo '</section>';

//echo '<div align="center" style="padding-top:5px;">';
//echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myCopyRight">&copy; '.THEME.' by The 86it Developers Network</button><br />';
//echo '</div>';
echo '<div align="center" style="padding-top:5px;">';
echo '</div>';


//echo '<div class="center">'.ads(3).'</div>';

//echo '<a class="copyright" href="javascript: void(0)" onclick="window.open(\''.theme_dir.'copyrights.php\', \'windowname1\', \'width=800, height=500\'); return false;">';
//echo '<span class="tooltip-html" title="'.theme_copyright_click.'"><strong>Universal Theme Design By The 86it Developers Network &copy; 2019-2021</strong></span>';
//echo '</a>';

echo "\n\n\n\n\n<!-- function_CloseTable top START -->\n";
print '</td>';
print '</tr>';
print '</table>';
print '</td>';

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/right_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/right_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/bottom_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/bottom_middle_piece.png"></td>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/bottom_right_corner.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";

# do not remove anything from here down when making a theme! The theme will not show up correctly
echo '</td>';
echo '</tr>';
echo '</table><br /><br />';
echo '<div align="center" style="padding-top:3956px;">';
echo '</div>';
global $powered_by;
echo '<div align="center">'.$powered_by.'</div>';
echo '<div align="center" style="padding-top:256px;">';
echo '</div>';
echo '</td>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '<!-- FOOTER END -->';

?>
