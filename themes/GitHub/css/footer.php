<?php
#---------------------------------------------------------------------------------------#
# FOOTER FLYKIT CSS                                                                     # 
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Right White Theme v1.0 (Fixed & Full Width)                                           #
#                                                                                       #
# Final Build Date 09/24/2022 Saturday 12:54am                                          #
#                                                                                       #
# A Very Nice White Theme Design.                                                       #
# Copyright © 2021 By: TheGhost AKA EABuffington                                        #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 09/24/2022 Saturday 12:54am (v1.0)                                        #
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

global $theme_name;

echo "\n\n/* Universal/css/footer.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height;
global $choose, $filename1;
   
  
   $filename1 = 'black_glass_once_piece_header.png'; 
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"'); 
   define('CONTAIN', 'background-repeat: no-repeat;
                background-position: center center; 
					                    width 100%;
					                  height 115px;
					                  z-index: 780;
					        background-size: cover;					                  
							          opacity: 1.0;');
?>
.flames
{
    background: url(<?php echo LOGO_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 
}

.inferno_footer_table
{
opacity: 0.9;
background-color: black; 
background-image: 
url(themes/<?=$theme_name?>/backgrounds/top_box.png),       /* top black glass - TheGhost add 03/19/2021 */
url(themes/<?=$theme_name?>/backgrounds/box_bottom.png);    /* bottom flames   - TheGhost add 03/19/2021 */
background-position:
top right, 
bottom left; 
background-repeat: 
repeat-x; /* this makes the top glass block and the bottom flame block repeat from left to right and vice vs - TheGhost add 08/04/2019 */ 
}

<?
