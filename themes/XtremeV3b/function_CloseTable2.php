<?php
#---------------------------------------------------------------------------------------#
# function CloseTable2                                                                  #
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
/* function CloseTable2() 
/*--------------------------*/
# I missed these out on purpose, they will be deprecated in the next update.
function CloseTable2() 
{
	global $theme_name;
	
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

echo '<table>';
echo '<tr>';
echo '<td style="width: 1px;" valign ="top"><img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="1" height="1" border="0" /></td>';
echo '</tr>';
echo '</table>';
echo '</middle>';
}
?>
