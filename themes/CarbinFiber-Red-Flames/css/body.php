<?php
#---------------------------------------------------------------------------------------#
# themes/CarbonFiber/css/body.php                                                       #
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
global $theme_name;

echo "\n\n/* Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
global $choose, $filename1;
   
   //carbon fiber background
   //$filename1 = 'header_background2.png';
   
   //another carbon fiber background
   // $filename1 = 'header_2028.png';

   //cool flickerin green background with lights
   //$filename1 = 'light_long_hallway.gif';    
   
   //cool light with grey background flikering on and off
   //$filename1 = 'blink182.gif';
   
   //anotheranimated green shakey walking background
   //$filename1 = 'shakey.gif';
   
   //lotsa purple and orange fire like 
   //$filename1 = 'tubefire.png';
   
   $choose = '23';
   
   switch ($choose)
   {
   case 1:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center bottom'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 2:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center bottom'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 3:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center bottom'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 4:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 5:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 6:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 7:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 8:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 9:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 10:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 11:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 1080px, cover;'); // stretch this whore out
   break;
   case 12:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 13:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 14:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 15:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 16:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 17:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 18:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 19:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 20:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 21:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 22:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CENTER', 'center middle'); 
   define('CONTAIN', 'background-size: 100% 100%, cover;'); // stretch this whore out
   break;
   case 23:
   //$filename1 = 'flaming-sky.png';
   //$filename1 = 'exact_match_dark_red.png';
   
   $filename1 = 'black_glass_flames.png'; 
   //$filename1 = 'red_glass.png';
   //$filename1 = 'aluminum5.png';
   
   
   //USE background-position: CENTER CENTER; to squuze top to bottom 
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"'); 
   define('CONTAIN', 'background-repeat: no-repeat;
                background-position: center center; 
					                    width 100%;
					                  height 115px;
					                  opacity: 100;
					           visibility: inherit;
					                   z-index: 20;
					        background-size: cover;');
   break;
   case 0:
   //How to position a background-image to be centered at top:
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CONTAIN', 'background-repeat: no-repeat;
                      background-attachment: fixed; 
	               background-position: center top;');
                                             break;
                                           default:
   //make background-image responsive after resize windows with specific width: 
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"');
   define('CONTAIN', 'background-repeat: no-repeat;
                background-position: center center;
				 	        background-size: cover;');
                                             break;

}
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
//	background-image: url('../style/images/black.png');
//	/*background-image: url('../style/images/bg2.jpg');*/
//	/*background-image: url('../style/images/bg3.jpg');*/
//	background-repeat: no-repeat;
//	background-attachment: fixed;
//	background-position: top center;
//	background-color: #000000;
define('BODY_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/black_red_flame_borders_fixed.png"');
define('BODY_CONTAIN', 'background-size: 100% auto, cover;
                             background-attachment: fixed;
                              background-repeat: repeat-y;'); // stretch this whore out




?>
img.rounded-corners {
  border-radius: 20px; 
}

img.rounded-corners-last-vistors {
  border-radius: 9px; 
}

img.rounded-corners-user-info {
  border-radius: 20px; 
}

body{
background-color: black;	
}

.top_and_bottom{
background-color: black;	
background-image: 
url(../../../themes/<?=$theme_name?>/backgrounds/glasstop.png),
url(../../../themes/<?=$theme_name?>/backgrounds/sidebox_bottom.png);
background-position:
top right,                   /* this positions the first image - TheGhost add 8/2/2019 */
bottom left;                 /* this positions the second image - TheGhost add 8/2/2019 */
background-repeat:
no-repeat;                   /* this applies to both images - TheGhost add 8/2/2019 */ 
}

body7 {
background: url(<?php echo BODY_BACKGROUND; ?>);
<?php echo BODY_CONTAIN; ?>
}
<?
