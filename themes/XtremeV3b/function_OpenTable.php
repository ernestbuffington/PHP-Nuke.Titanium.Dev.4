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
  ?>
  <table class="maintable" border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
  <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50">
  </td>

  <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" width="100%">
  <span class="blocktitle"><div align="center"><?=$block_title?></div></span>
  </td>

  <td background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
  <img src="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50">
  </td>

  </tr>
  <tr>

  <td width="15" background="<?=HTTPS?>themes/<?=$theme_name?>/tables/OpenTable/leftside.png">
  </td>

  <td width="24">
  </td>
  <td width="100%">
  <?
}
?>