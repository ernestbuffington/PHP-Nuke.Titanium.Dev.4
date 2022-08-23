<?php 
#---------------------------------------------------------------------------------------#
# FOOTER                                                                                #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Universal Theme v1.0 (Fixed & Full Width)                                             #
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

#-----------------------------#
# Inferno Footer Section      #
#-----------------------------#
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
	    $user, 
	 $banners, 
	  $cookie, 
         $dbi, 
		  $db, 
	   $admin, 
   $adminmail, 
  $total_time, 
  $start_time, 
       $foot1, 
	   $foot2, 
	   $foot3, 
	   $foot4,
	   $foot5, 
	 $nukeurl, 
	      $ip, 
  $theme_name, 
   $ThemeInfo,
      $prefix;


if(blocks_visible('right')) 
{
  echo "</td>\n";
  echo "<td style=\"width: 5px;\" valign=\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"5\" height=\"1\" /></td>\n";
  echo "<td style=\"width: 170px;\" valign=\"top\">\n";

  blocks('right');
}

echo "</td>\n";
echo "<td valign=\"top\"></td>\n";
echo "</tr>\n";
echo "</table>\n\n\n";
    
echo '<table class="outer_table_opacity" border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';

echo '<td><img name="tlc" src="themes/'.$theme_name.'/footer/tlc.gif" width="20" height="25" border="0" alt=""></td>';

echo '<td width="100%" background="themes/'.$theme_name.'/footer/tm.gif"><img name="tm" src="themes/'.$theme_name.'/footer/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

# top right corner of table 2
echo '<td><img name="trc" src="themes/'.$theme_name.'/footer/trc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr>';
echo '<tr>';

# left side of table 2
echo '<td background="themes/'.$theme_name.'/footer/left_side.gif"><img name="leftside" src="themes/'.$theme_name.'/footer/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '<td id="bg" class="inferno_footer_table" height"0" valign="top" >';
echo '<div align="center">';
footmsg();
echo '</div>'; 
//echo '<div class="flex-item" style="width: 58px; height: 71px; background-image: url('.theme_ftr_images.'FTR_Copyright.png); padding-right: 20px;">';

echo '<section id="flex-container">';
echo '<div class="flex-item" style="width: 100%; height: 0px; ">';
//echo '<div class="tooltip-html center" style="font-size: 1;" title="'.theme_copyright.'"><span style="color: #ffffff;">'.str_replace('<br />', '', 'Universal Theme Design By The 86it Developers Network &copy; 2019-2021').'</span></div>';
echo '</div>';
echo '</section>';
//echo '<div align="center" style="padding-top:5px;">';
//echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myCopyRight">&copy; '.THEME.' by The 86it Developers Network</button><br />';
//echo '</div>';
//echo '<div align="center" style="padding-top:15px;">';
//echo '</div>';

//echo '<a class="copyright" href="javascript: void(0)" onclick="window.open(\''.theme_dir.'copyrights.php\', \'windowname1\', \'width=800, height=500\'); return false;">';
//echo '<span class="tooltip-html" title="'.theme_copyright_click.'"><strong>Universal Theme Design By The 86it Developers Network &copy; 2019-2021</strong></span>';
//echo '</a>';

echo '<div align="center" style="padding-top:3px;">';
echo '</div>';
echo '</td>';

# right side of table 2
echo '<td background="themes/'.$theme_name.'/footer/right_side.gif"><img name="rightside" src="themes/'.$theme_name.'/footer/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';

# bottom lefft corner of table 2
echo '<td><img name="blc" src="themes/'.$theme_name.'/footer/blc.gif" width="20" height="25" border="0" alt=""></td>';

# bottom middle of table 2
echo '<td background="themes/'.$theme_name.'/footer/tbm.gif"><img name="tbm" src="themes/'.$theme_name.'/footer/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

# bottom right corner of table 2
echo '<td><img name="brc" src="themes/'.$theme_name.'/footer/brc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr></table>';

echo '</tr>';
echo '</table><br /><br />';

echo '<div align="center" style="padding-top:3956px;">';
echo '</div>';
global $powered_by;
echo '<div align="center">'.$powered_by.'</div>';

echo '<!-- FOOTER END -->';
echo '</td>';
echo '</tr>';

echo '</table>';
echo '</div>';
//echo '</footer>';
echo '</div>';
    if (!empty($banners)):
        echo '<div class="center">'.ads(1).'</div>';
endif;

?>
