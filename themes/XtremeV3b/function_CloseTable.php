<?php
#---------------------------------------------------------------------------------------#
# function CloseTable                                                                   #
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

#--------------------------#
# function CloseTable() 
#--------------------------#
function CloseTable()
{

  global $name, $ThemeSel, $theme_name;
  
?>
</td>
<td width="25"></td>
<td width="15" background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td>
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="100%"></td>
<td align="right" width="39" colspan="2"><img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
</tr>
</table>
<?
 print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/invisible_pixel.gif" height=6><br>'."\n";
}
?>
