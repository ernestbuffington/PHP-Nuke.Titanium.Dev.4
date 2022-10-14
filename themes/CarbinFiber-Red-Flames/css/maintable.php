<?php
#---------------------------------------------------------------------------------------#
# themes/CarbonFiber/css/maintable.php                                                  #
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

echo "/* Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
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
   define('SIDEBLOCK_BACKGROUND', '"themes/'.$theme_name.'/header/2056x2056.png"');   
   define('SIDEBLOCK_CONTAIN', 'background-repeat: no-repeat;
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
                      background-position: CENTER CENTER; 
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
					                                blow-it-out: yourass;
												     visibility: inherit;
					                                         z-index: 20;
					                               background-size: auto;');
########################################################################################################
$lori_is_a_sadist_sociapath = 'block_repeat_y_fix.png';  
define('THEME_INDEX_BACKGROUND', '"themes/'.$theme_name.'/backgrounds/'.$lori_is_a_sadist_sociapath.'"'); 
define('THEME_INDEX_CONTAIN', 'background-repeat: repeat-y | repeat-x;
                                      background-position: CENTER CENTER; 
					                                          width 100%;
					                                         height 100%;
					                                        opacity: 100;
					                                blow-it-out: yourass;
												     visibility: inherit;
					                                         z-index: 20;
					                               background-size: auto;');
########################################################################################################
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
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}

.bookmark
{
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	

}

.boxtitle
{
    background: url(<?php echo BOOKMARKS_TITLE_BACKGROUND; ?>);
	<?php echo BOOKMARKS_TITLE_CONTAIN; ?> 	

}

.boxlist
{
    background: url(<?php echo BOOKMARKS_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 	
}

.flames
{
    background: url(<?php echo LOGO_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 
}

table.header {
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
table.footer {
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
table.center {
    background: url(<?php echo CENTER_BACKGROUND; ?>);
	<?php echo CENTER_CONTAIN; ?>
}

.emiddleflames
{
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
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
.topics_middleflames {
    background: url(<?php echo TABLE3_MIDDLEHEADER_BACKGROUND; ?>); /* CarbinFiber background - TheGhost add 08/04/2019 */
	<?php echo TABLE3_MIDDLEHEADER_CONTAIN; ?>
}

.themearticleflames
{
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
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}

.themeindexflames
{
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
    background: url(<?php echo SIDEBLOCK_BACKGROUND; ?>);
	<?php echo SIDEBLOCK_CONTAIN; ?>
}
<?
