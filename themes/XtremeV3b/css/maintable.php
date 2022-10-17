<?php
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Inferno Theme v1.0 (Fixed & Full Width)                                               #
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

global $theme_name;

echo "/* Inferno/css/maintable.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $choose, $filename1;
   
  
   $filename1 = 'black_glass_flames.png'; 
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"'); 
   define('CONTAIN', 'background-repeat: no-repeat;
                background-position: center center; 
					                    width 100%;
					                  height 115px;
					                  opacity: 100;
					           visibility: inherit;
					                   z-index: 20;
					        background-size: cover;');
######################################################################################################
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('BOOKMARKS_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/blackbar.png"'); 
   define('BOOKMARKS_CONTAIN', 'background-repeat: no-repeat;
                          background-position: center center; 
					                              width 100%;
					                            height 115px;
					                            opacity: 100;
					                     visibility: inherit;
					                             z-index: 20;
					                  background-size: cover;');
					  
######################################################################################################
   define('BOOKMARKS_TITLE_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/newredbar.png"'); 
   define('BOOKMARKS_TITLE_CONTAIN', 'background-repeat: no-repeat;
                                background-position: center center; 
					                                    width 100%;
					                                  height 115px;
					                                  opacity: 100;
					                           visibility: inherit;
					                                   z-index: 20;
					                        background-size: cover;');

//maintable css
echo "/* Sets the Header Background Elements */\n"; 
######################################################################################################
define('HEADER_BACKGROUND', '"../../../themes/'.$theme_name.'/header/2056x2056.png"');
define('HEADER_CONTAIN', 'background-repeat: no-repeat;
                    background-position: center center; 
					                        width 100%;
					                      height 115px;
					                      opacity: 100;
					               visibility: inherit;
					                       z-index: 20;
					            background-size: cover;');
########################################################################################################
   define('SIDEBLOCK_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/2560x1080.png"');   
   define('SIDEBLOCK_CONTAIN', 'background-repeat: repeat-y;
                         background-position: center center; 
					                           opacity: 100;
					             background-size: auto auto');
########################################################################################################
define('FOOTER_BACKGROUND', '"../../../themes/'.$theme_name.'/header/2056x2056.png"');
define('FOOTER_CONTAIN', 'background-repeat: no-repeat;
                    background-position: center center; 
					                        width 100%;
					                      height 115px;
					                      opacity: 100;
					               visibility: inherit;
					                       z-index: 20;
					            background-size: cover;');
########################################################################################################
define('CENTER_BACKGROUND', '"../../../themes/'.$theme_name.'/header/2056x2056.png"');
define('CENTER_CONTAIN', 'background-repeat: no-repeat;
                    background-position: center center; 
					                        width 100%;
					                      height 115px;
					                      opacity: 100;
					               visibility: inherit;
					                       z-index: 20;
					            background-size: cover;');
########################################################################################################
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('E_MIDDLEHEADER_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/block_repeat_y_fix.png"'); 
   define('E_MIDDLEHEADER_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                         background-position: center center; 
					                                             width 100%;
					                                            height 100%;
					                                           opacity: 100;
					                                    visibility: inherit;
					                                            z-index: 20;
					                                  background-size: auto;');
					  
$blow_it_out_your_ass = 'dark.png';  
define('TABLE3_MIDDLEHEADER_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/'.$blow_it_out_your_ass.'"'); 
define('TABLE3_MIDDLEHEADER_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                           background-position: CENTER CENTER; 
					                                               width 100%;
					                                              height 100%;
					                                             opacity: 100;
					                                     blow-it-out: yourass;
												          visibility: inherit;
					                                              z-index: 20;
					                                    background-size: auto;');
########################################################################################################
$blow_it_out_your_ass2 = 'block_repeat_y_fix.png';  
define('THEME_ARTICLE_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/'.$blow_it_out_your_ass2.'"'); 
define('THEME_ARTICLE_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                     background-position: CENTER CENTER; 
					                                         width 100%;
					                                        height 100%;
					                                       opacity: 100;
											        visibility: inherit;
					                                        z-index: 20;
					                              background-size: auto;');
########################################################################################################
$lori_is_a_sadist_sociapath = 'block_repeat_y_fix.png';  
define('THEME_INDEX_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/'.$lori_is_a_sadist_sociapath.'"'); 
define('THEME_INDEX_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                   background-position: center center; 
					                                       width 100%;
					                                       eight 100%;
					                                     opacity: 100;
											      visibility: inherit;
					                                      z-index: 20;
					                            background-size: auto;');
########################################################################################################
define('BODY_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/black_red_flame_borders_fixed.png"');
define('BODY_CONTAIN', 'background-size: 100% auto, cover;
                             background-attachment: fixed;
                              background-repeat: repeat-y;'); // stretch this whore out
?>
<?
echo 'greatminds {'."\n";
echo 'font-size:14px;'."\n";
echo 'font-weight:bold;'."\n";
echo 'font-size-adjust:!important;'."\n";   
echo '}'."\n";
?>

.sideflames
{
   opacity: 0.9;
   background-color: black;	
   background-image: 
   url(../../../themes/<?=$theme_name?>/backgrounds/glasstop.png),
   url(../../../themes/<?=$theme_name?>/backgrounds/sidebox_bottom.png);
  background-position:
    top right, /* this positions the first image - TheGhost add 8/2/2019 */
    bottom left; /* this positions the second image - TheGhost add 8/2/2019 */
  background-repeat:
    no-repeat; /* this applies to both images - TheGhost add 8/2/2019 */ 
}

table.sideblock {
    opacity: 0.9;
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}

.bookmark
{
    opacity: 0.9;
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	

}

.boxtitle
{
    opacity: 0.9;
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	

}

.boxlist
{
    opacity: 0.9;
    background: url(<?php echo BOOKMARKS_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 	
}

.flames
{
    background: url(<?php echo LOGO_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 
}

table.header {
    opacity: 0.9;
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
table.footer {
    opacity: 0.9;
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
table.center {
    opacity: 0.9;
    background: url(<?php echo CENTER_BACKGROUND; ?>);
	<?php echo CENTER_CONTAIN; ?>
}

.infernoheader
{
opacity: 0.9;
background-image: 
url(themes/<?=$theme_name?>/backgrounds/topright.png),       /* top black glass - TheGhost add 08/04/2019 */
url(themes/<?=$theme_name?>/backgrounds/sidebox_bottom.png); /* bottom flames - TheGhost add 08/04/2019 */
background-position:
top right, 
bottom left; 
background-repeat: 
repeat-x; /* this makes the top glass block and the bottom flame block repeat from left to right and vice vs - TheGhost add 08/04/2019 */ 
}

.emiddleflames
{
opacity: 0.9;
background-color: black;	
background-image: 
url(themes/<?=$theme_name?>/backgrounds/topright.png),       /* top black glass - TheGhost add 08/04/2019 */
url(themes/<?=$theme_name?>/backgrounds/sidebox_bottom.png); /* bottom flames - TheGhost add 08/04/2019 */
background-position:
top right, 
bottom left; 
background-repeat: 
repeat-x; /* this makes the top glass block and the bottom flame block repaete from left to right and vice vs - TheGhost add 08/04/2019 */ 
	
}

table.emiddleblock {
    opacity: 0.9;
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
.topics_middleflames {
    opacity: 0.9;
    background: url(<?php echo TABLE3_MIDDLEHEADER_BACKGROUND; ?>); /* CarbinFiber background - TheGhost add 08/04/2019 */
	<?php echo TABLE3_MIDDLEHEADER_CONTAIN; ?>
}

.themearticleflames
{
opacity: 0.9;
background-color: black;	
background-image: 
    url(themes/<?=$theme_name?>/backgrounds/topright.png), /* top black glass - TheGhost add 08/04/2019 */
    url(themes/<?=$theme_name?>/backgrounds/sidebox_bottom.png); /* bottom flames - TheGhost add 08/04/2019 */
  background-position:
    top right, 
    bottom left; 
  background-repeat: 
    repeat-x; /* this makes the top glass block and the bottom flame block repaete from left to right and vice vs - TheGhost add 08/04/2019 */ 
	
}

table.themearticleblock {
    opacity: 0.9;
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}

.themeindexflames
{
opacity: 0.9;
background-color: black;	
background-image: 
    url(themes/<?=$theme_name?>/backgrounds/topright.png), /* top black glass - TheGhost add 08/04/2019 */
    url(themes/<?=$theme_name?>/backgrounds/sidebox_bottom.png); /* bottom flames - TheGhost add 08/04/2019 */
  background-position:
    top right, 
    bottom left; 
  background-repeat: 
    repeat-x; /* this makes the top glass block and the bottom flame block repaete from left to right and vice vs - TheGhost add 08/04/2019 */ 
	
}

table.themeindexblock {
    opacity: 0.9;
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
<?
