<?php
#---------------------------------------------------------------------------------------#
# function OpenTable                                                                    #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

/*--------------------------*/
/* function OpenTable() 
/*--------------------------*/
function OpenTable() 
{
global $theme_name;

echo '<middle>';
echo '<table class="emiddleblock" border="0" width="100%" cellspacing="0" cellpadding="0">';
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



echo '<table class="" border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';
echo '<td><img name="tlc" src="themes/'.$theme_name.'/center/tlc.gif" width="20" height="25" border="0" alt=""></td>';
echo '<td width="100%" background="themes/'.$theme_name.'/center/tm.gif"><img name="tm" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="trc" src="themes/'.$theme_name.'/center/trc.gif" width="20" height="25" border="0" alt=""></td>';
echo '</tr>';
echo '<tr>';
echo '<td background="themes/'.$theme_name.'/center/left_side.gif"><img name="leftside" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '<td id="middlebg" class="emiddleflames" height"0" valign="top" >';

echo '<div align="center" id="locator" class="title"><strong> </strong></div>';
echo '<div align="left" id="text">';
echo '</div>';	
}
?>

