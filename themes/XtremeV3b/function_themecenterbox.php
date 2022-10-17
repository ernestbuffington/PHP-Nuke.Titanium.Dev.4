<?php
#---------------------------------------------------------------------------------------#
# function themecenterbox                                                               #
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
/* function themecenterbox             THIS DOES NOT APPEAR TO BEING USED
/*--------------------------*/
function themecenterbox($title, $content) 
{
    global $theme_name, $main_blocks_table_width;
    global $textcolor1, $textcolor2, $ThemeSel, $theme_name, $screen_width, $sideboxwidth;

   echo "\n\n<!-- function themecenterbox START -->\n";
   echo"<table class=block cellSpacing=\"0\" cellPadding=\"0\" border=\"0\" width=\"100%\">"
     . "<tr >"
     . "<td background=\"".HTTPS."themes/".$theme_name."/tables/OpenTable/topmiddle.png\">"
     . "<img src=\"".HTTPS."themes/".$theme_name."/tables/OpenTable/leftcorner.png\" border=\"0\" width=\"39\" height=\"50\"></td>"
     . "<td width=\"0\" align=\"center\" background=\"".HTTPS."themes/".$theme_name."/tables/OpenTable/topmiddle.png\">"
	 . "<span class=\"blocktitle\" ><div align=\"center\"><strong>".$title."</strong></div></span></td>"
     . "<td>"
     . "<img src=\"".HTTPS."themes/".$theme_name."/tables/OpenTable/rightcorner.png\" border=\"0\" width=\"39\" height=\"50\"></td>"
     . "</tr>"
     . "<tr>"
     . "<td colSpan=\"3\">"
     . "<table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">"
     . "<tr>"
     . "<td width=\"0\" background=\"".HTTPS."themes/".$theme_name."/tables/OpenTable/leftside.png\">"
     . "<img src=\"".HTTPS."themes/".$theme_name."/tables/OpenTable/leftside.png\" border=\"0\" width=\"15\" height=\"4\"></td>"
     . "<td width=\"100%\" >"
     . "<table cellSpacing=\"0\" cellPadding=\"8\" width=\"100%\" border=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\">"
     . "<tr>"
     . "<td width=\"$main_blocks_table_width\">"
     . "$content         </td>"
     . "</tr>"
     . "</table>"
     . "</td>"
     . "<td width=\"0\" background=\"".HTTPS."themes/".$theme_name."/tables/CloseTable/rightside.png\">"
     . "<img src=\"".HTTPS."themes/".$theme_name."/tables/CloseTable/rightside.png\" border=\"0\" width=\"15\" height=\"4\"></td>"
     . "</tr>"
     . "</table>"
     . "</td>"
     . "</tr>"
     . "<tr>"
     . "<td width=\"39\" height=\"52\">"
     . "<img src=\"".HTTPS."themes/".$theme_name."/tables/CloseTable/leftbottomcorner.png\" border=\"0\" width=\"39\" height=\"52\"></td>"
     . "<td width=\"0\" height=\"27\" background=\"".HTTPS."themes/".$theme_name."/tables/CloseTable/bottommiddle.png\">        </td>"
     . "<td width=\"39\" height=\"27\">"
     . "<img src=\"".HTTPS."themes/".$theme_name."/tables/CloseTable/bottomrightcorner.png\" border=\"0\" width=\"39\" height=\"52\"></td>"
     . "</tr>"
     . "</table>";

   //global $ThemeSel;  
   //echo "<img src=\"".HTTPS."themes/".$ThemeSel."/header/spacer.png\" height=7><br>\n";
   echo '<div align="center" style="padding-top:6px;">';
   echo '</div>';
   
   echo "\n<!-- function themecenterbox END -->\n\n\n";
}
