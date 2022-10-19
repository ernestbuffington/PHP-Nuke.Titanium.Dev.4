<?php
#---------------------------------------------------------------------------------------#
# function themesidebox                                                                 #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* 
/*--------------------------*/
function themesidebox($title, $content, $bid = 0) 
{
global $theme_name;

echo '<aside>'; //side block class to add flames to bottom and glass curve to top
echo '<table class="sideblock" border="0" width="320px" cellspacing="0" cellpadding="0">';
echo '';
echo '<tr>';
echo '<td align="left" width="38" height="62"><img border="0" src="themes/'.$theme_name.'/center/top_left_corner.png" /></td>';
echo '<td background="themes/'.$theme_name.'/center/top_middle.png" ></td>';
echo '<td height="62" background="themes/'.$theme_name.'/center/top_middle.png" align="center" valign="bottom"></td>';
echo '<td background="themes/'.$theme_name.'/center/top_middle.png" align="center" ></td>';
echo '<td align="right" width="38"><img border="0" src="themes/'.$theme_name.'/center/top_right_corner.png" width="38" height="62" /></td>';
echo '</tr>';
echo '';
echo '<tr>';
echo '<td background="themes/'.$theme_name.'/center/left_side.png" width="38"></td>';
echo '<td ></td>';
echo '<td >';
echo '';
echo '';

echo '<table border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';

echo '<td><img name="tlc" src="themes/'.$theme_name.'/center/tlc.gif" width="20" height="25" border="0" alt=""></td>';

echo '<td width="100%" background="themes/'.$theme_name.'/center/tm.gif"><img name="tm" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '<td><img name="trc" src="themes/'.$theme_name.'/center/trc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr>';
echo '<tr>';
echo '<td background="themes/'.$theme_name.'/center/left_side.gif"><img name="leftside" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '<td id="sidebg" class="sideflames" height"0" valign="top" >';
echo '<div align="center" style="padding-top:6px;">';
echo '</div>';
echo '<div align="center" id="locator" class="title"><strong><h1 data-text="'.$title.'">'.$title.'</h1></strong></div>';
echo '<div align="left" id="text">';
echo ''.$content.'</div>';

echo '';
echo '</td>';
echo '<td background="themes/'.$theme_name.'/center/right_side.gif"><img name="rightside" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td><img name="blc" src="themes/'.$theme_name.'/center/blc.gif" width="20" height="25" border="0" alt=""></td>';
echo '';
echo '<td background="themes/'.$theme_name.'/center/tbm.gif"><img name="tbm" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="brc" src="themes/'.$theme_name.'/center/brc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr></table>';
echo '';
echo '';
echo '</td>';
echo '<td ></td>';
echo '<td class="turdball" background="themes/'.$theme_name.'/center/right_side.png" width="38"></td>';
echo '</tr>';
echo '';
echo '<tr>';
echo '<td align="left" width="38" height="62"><img border="0" src="themes/'.$theme_name.'/center/bottom_left_corner.png" /></td>';
echo '';
echo '<td background="themes/'.$theme_name.'/center/bottom_middle.png" ></td>';
echo '<td height="62" background="themes/'.$theme_name.'/center/bottom_middle.png" align="center" valign="top"><h1></h1></td>';
echo '<td height="62" background="themes/'.$theme_name.'/center/bottom_middle.png" align="center" ></td>';
echo '';
echo '<td align="right" width="38"><img border="0" src="themes/'.$theme_name.'/center/bottom_right_corner.png" width="38" height="62" /></td>';
echo '</tr>';
echo '</table>';

echo '<table>';
echo '<tr>';
echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" /></td>\n";
echo '</tr>';
echo '</table>';

echo '</aside>';
}
?>

