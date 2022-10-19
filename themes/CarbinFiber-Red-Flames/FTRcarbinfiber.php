<?php 
#---------------------------------------------------------------------------------------#
# FOOTER                                                                                #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# CarbinFiber Theme v1.0 (Fixed & Full Width)                                           #
#                                                                                       #
# Final Build Date 08/17/2019 Saturday 7:40pm                                           #
#                                                                                       #
# A Very Nice Black Carbin Fiber Styled Design.                                         #
# Copyright © 2019 By: TheGhost AKA Ernest Allen Bffington                              #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 1st August, 2019 (v1.0)                                                   #
#                                                                                       #
# Updated On: 1st August, 2019 (v3.0)                                                   #
# HTML5 Theme Code Updated By: Lonestar (Lonestar-Modules.com)                          #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost                                                                 #
# Web Site: https://theghost.86it.us                                                    #
# Purpose: PHP-Nuke Titanium | Xtreme Evo                                               #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# PHP-Nuke Titanium (c) 2019 : Enhanced PHP-Nuke Web Portal System                      #
#---------------------------------------------------------------------------------------#

#-----------------------------#
# CarbinFiber Footer Section  #
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
    
echo '<table class="footer" border="0" width="100%" cellspacing="0" cellpadding="0">';
echo '<tr>';

# top left corner of 1st table
echo '<td align="left" width="38" height="62"><img border="0" src="themes/'.$theme_name.'/footer/top_left_corner.png" /></td>';

# top middle of 1st table
echo '<td background="themes/'.$theme_name.'/footer/top_middle.png" ></td>';
echo '<td height="62" background="themes/'.$theme_name.'/footer/top_middle.png" align="center" valign="bottom"></td>';
echo '<td background="themes/'.$theme_name.'/footer/top_middle.png" align="center" ></td>';

# top right corner of table 1
echo '<td align="right" width="38"><img border="0" src="themes/'.$theme_name.'/footer/top_right_corner.png" width="38" height="62" /></td>';

echo '</tr>';
echo '<tr>';

# left side of table 1
echo '<td background="themes/'.$theme_name.'/footer/left_side.png" width="38"></td>';

echo '<td ></td>';
echo '<td >';


echo '<table border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';

# top left corner of table 2
echo '<td><img name="tlc" src="themes/'.$theme_name.'/footer/tlc.gif" width="20" height="25" border="0" alt=""></td>';

# top middle of table 2
echo '<td width="100%" background="themes/'.$theme_name.'/footer/tm.gif"><img name="tm" src="themes/'.$theme_name.'/footer/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

# top right corner of table 2
echo '<td><img name="trc" src="themes/'.$theme_name.'/footer/trc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr>';
echo '<tr>';

# left side of table 2
echo '<td background="themes/'.$theme_name.'/footer/left_side.gif"><img name="leftside" src="themes/'.$theme_name.'/footer/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '<td id="bg" class="flames" height"0" valign="top" >';
echo '<div align="center">';
footmsg();
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

echo '</td>';
echo '<td ></td>';

# bottom right side of table 1
echo '<td class="turdball" background="themes/'.$theme_name.'/footer/right_side.png" width="38"></td>';

echo '</tr>';
echo '<tr>';

# bottom left side of table 1
echo '<td align="left" width="38" height="62"><img border="0" src="themes/'.$theme_name.'/footer/bottom_left_corner.png" /></td>';

# bottom middle of table 1
echo '<td background="themes/'.$theme_name.'/footer/bottom_middle.png" ></td>';
echo '<td height="62" background="themes/'.$theme_name.'/footer/bottom_middle.png" align="center" valign="top"><h1></h1></td>';
echo '<td height="62" background="themes/'.$theme_name.'/footer/bottom_middle.png" align="center" ></td>';

# bottom right corner of table 1
echo '<td align="right" width="38"><img border="0" src="themes/'.$theme_name.'/footer/bottom_right_corner.png" width="38" height="62" /></td>';
echo '</tr>';

echo '</table>';
echo '<!-- FOOTER END -->';

echo '</td>';
echo '</tr>';

echo '</table>';

echo '</div>';

echo '</footer>';

echo '</div>';

    if (!empty($banners)):
        echo '<div class="center">'.ads(1).'</div>';
endif;
?>
