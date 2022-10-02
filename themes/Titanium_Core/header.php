<?php
#---------------------------------------------------------------------------------------#
# HEADER                                                                                #
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Titanium_Core Theme v2.0 (Fixed & Full Width)                                         #
#                                                                                       #
# Final Build Date 03/16/2021 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Gold Theme Design.                                                        #
# Copyright © 2021 By: TheGhost AKA EA Buffington                                       #
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
# Purpose: PHP-Nuke Titanium                                                            #
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
# Titanium Core Header Section      #
#-----------------------------------#
# Fixed & Full Width Style    #
#-----------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');

global $locked_width,
         $screen_res, 
         $textcolor1, 
	     $textcolor2, 
	       $bgcolor1,
		   $bgcolor2,
		   $bgcolor3,
		   $bgcolor4,
		   $bgcolor5,  
		   $sitename, 
		     $slogan, 
		       $name, 
		    $banners, 
		 $titanium_db, 
$titanium_user_prefix, 
	 $titanium_prefix, 
	      $admin_file, 
   $userinfo, 
		   $ThemeInfo,
    $titanium_browser, 
	      $theme_name;

echo "\n\n<!-- THEME HEADER START -->\n"; # set background here in themes/Inferno/css/maintable.php

# Check if a Registered User is Logged-In
$titanium_username = is_user() ? $userinfo['username'] : _ANONYMOUS;

# Setup the Welcome Information for the User
if ($titanium_username === _ANONYMOUS)
{
   $theuser  = '<div align="center">Please <a href="modules.php?name=Your_Account"><u>Login</u></a> or <a href="modules.php?name=Your_Account&amp;op=new_user"><u>Register</u></a>&nbsp;&nbsp;</div>';
   # start 4th line of header
   $theuser .= '<div align="center" id="locator">Monitor Resolution '.$screen_res.'</div>';
   # end 4th line of header
   $newmessages = 'Please <a href="modules.php?name=Your_Account"><u>Login</u></a> or <a href="modules.php?name=Your_Account&amp;op=new_user"><u>Register</u></a>';
}
else
{
    if(intval($userinfo['user_new_privmsg']) == 1 )
	{
	  $theuser  .= '<div align="center" id="theuser"><strong>';
      $theuser  .= sprintf(_YOUHAVE_1_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	  $theuser  .= '</strong></div>';
	  $newmessages = sprintf(_YOUHAVE_1_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	}
	else
	if(intval($userinfo['user_new_privmsg']) > 1 )
	{
	  $theuser  .= '<div align="center" id="theuser"><strong>';
	  $theuser  .= sprintf(_YOUHAVE_X_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	  $theuser  .= '</strong></div>';
	  $newmessages = sprintf(_YOUHAVE_X_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	}
	else
	{
	  $theuser  .= '<div align="center" id="theuser"><strong>';
	  $theuser  .= sprintf(_YOUHAVE_NO_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	//$theuser .= '<br /><a href="modules.php?name=Profile&amp;mode=editprofile">'._EDIT_PROFILE.'</a> | ';
    //$theuser .= '<a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a>';
    # start 4th line of header
      $theuser  .= '<div align="center" id="resolution">Monitor Resolution '.$screen_res.'</div>';
	  $theuser  .= '</strong></div>';
	  $newmessages = sprintf(_YOUHAVE_NO_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
    # end 4th line of header
	}
}

#chrome canary 64bit 91.0.4446.3
if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '91.0.4446.3') // Chrome Canary (x64bit) version as of 3/16/2021
$scrollmsg .= "<img border=\"0\" align=\"absmiddle\" height=\"15\" src=\"https://www.86it.us/images/browsers/current-channel-logo@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome Canary (64-bit) We are glad you keep up with the times on a nightly basis!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '89.0.4389.90') // MicroSoft Edge (x64bit) version as of 3/5/2021
$scrollmsg .= "<img border=\"0\" align=\"absmiddle\" height=\"16\" src=\"https://www.86it.us/images/browsers/edge-beta@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Microsoft Edge (64-bit), Looks like Microsoft finally pulled their head out of their ass!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '89.0.4389.82') // MicroSoft Edge (x64bit) version as of 3/5/2021
$scrollmsg .= "<img border=\"0\" align=\"absmiddle\" height=\"16\" src=\"https://www.86it.us/images/browsers/edge-beta@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Microsoft Edge (64-bit), Looks like Microsoft finally pulled their head out of their ass!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '88.0.4324.182') // MicroSoft Edge (x64bit) version as of 3/5/2021
$scrollmsg .= "<img border=\"0\" align=\"absmiddle\" height=\"16\" src=\"https://www.86it.us/images/browsers/edge-beta@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Microsoft Edge (64-bit), Looks like Microsoft finally pulled their head out of their ass!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '89.0.4389.114') // Chrome (x64bit) version as of 3/5/2021
$scrollmsg .= "<img border=\"0\" align=\"top\" height=\"16\" src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&width=32 alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome, you have great taste... Chrome is the #1 browsing solution in the world! When you are using Chrome it doesnt get any better!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '89.0.4389.72') // Chrome (x64bit) version as of 3/5/2021
$scrollmsg .= "<img border=\"0\" align=\"top\" height=\"16\" src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&width=32 alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome, you have great taste... Chrome is the #1 browsing solution in the world! When you are using Chrome it doesnt get any better!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '77.0.3865.75') // MicroSoft Edge (x64bit) Beta
$scrollmsg .= "<img border=\"0\" align=\"absmiddle\" height=\"16\" src=\"https://www.86it.us/images/browsers/edge-beta@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Microsoft Edge Beta (64-bit), Looks like Microsoft finally pulled their head out of their ass!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '70.0.3538.102') // MicroSoft Edge (x64bit) 
$scrollmsg .= "<img border=\"0\" align=\"absmiddle\" height=\"16\" src=\"https://www.86it.us/images/browsers/edge.png\" alt=\"\" title=\"\"> <strong>Thanks for using Microsoft Edge (64-bit)</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '79.0.3917.0') // Chrome Canary Nightly Build 
$scrollmsg .= "<img border=\"0\" align=\"absmiddle\" height=\"15\" src=\"https://www.86it.us/images/browsers/current-channel-logo@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome Canary (64-bit) We are glad you keep up with the times on a nightly basis!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '76.0.3809.132') // Chrome Official Release (x64bit) 
$scrollmsg .= "<img border=\"0\" align=\"top\" height=\"16\" src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&width=32 alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome, you have great taste... Chrome is the #1 browsing solution in the world! When you are using Chrome it doesnt get any better!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_OPR) // Browser Opera (x64bit) Official Release Build
$scrollmsg .= "<img src=\"https://addons-static.operacdn.com/static/header-footer/css/img/opera-icon-header.c6f9a9d4173c.png\" srcset=\"https://addons-static.operacdn.com/static/header-footer/css/img/opera-icon-header.c6f9a9d4173c.png 1x, https://addons-static.operacdn.com/static/header-footer/css/img/opera-icon-header@2x.417c6a4c023a.png 2x\" alt=\"Opera Software logo\" height=\"15\" align=\"absmiddle\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Opera, it is one of the few acceptable browsers that are actually worth a shit! Here on The 86it Developers Network we like to see folks using thee ole noggin!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_MAXTHON) // browser Maxthon Cloud
$scrollmsg .= "<img style=\"vertical-align:middle\" border=\"0\" height=\"16\"  src=\"https://nukescripts.86it.us/images/browsers/logo-maxthon.png\" alt=\"Browser\" title=\"Browser\"><br><br><strong>Thanks for using Maxthon</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_FIREFOX && $titanium_browser->getVersion() == '69.0') // Official FireFox Quantum Release - CURRENTLY BROKEN BY THE DEVELOPERS as of 9/21/2017
{
$scrollmsg .= "<img style=\"vertical-align:middle\" border=\"0\" height=\"16\"  src=\"https://addons.cdn.mozilla.net/static/img/icons/firefox.png?b=54591c07-59b80978\" alt=\"Browser\" title=\"Browser\"><strong> Thanks for using FireFox Quantum</strong> ";
$scrollmsg .= '<span class="blink-one">This version of <strong>FireFox</strong> does break websites so please use at your own RISK!</span>'; // 0%
}

if( $titanium_browser->getBrowser() == Browser::BROWSER_FIREFOX) // Other FireFox - CURRENTLY BROKEN BY THE DEVELOPERS as of 9/21/2017
{
$scrollmsg .= "<img style=\"vertical-align:middle\" border=\"0\" height=\"16\"  src=\"https://addons.cdn.mozilla.net/static/img/icons/firefox.png?b=54591c07-59b80978\" alt=\"Browser\" title=\"Browser\"><strong> Thanks for using FireFox</strong> ";
$scrollmsg .= '<span class="blink-one"> - This version of <strong>FireFox</strong> does break websites so please use at your own RISK!</span>';
}

if($titanium_browser->getBrowser() == Browser::BROWSER_MOZILLA && $titanium_browser->getVersion() == 5) // Maxthon Cloud (x64bit) Now is Garbage
{
$scrollmsg .= "<img style=\"vertical-align:absmiddle\" border=\"0\" height=\"10\"  src=\"https://www.86it.us/images/browsers/logo-maxthon.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Maxthon</strong> ";
$scrollmsg .= '<span class="blink-one">This version of <strong>Maxthon</strong> does break websites so please use at your own RISK!</span>'; // 0%
}

global $connected;

$moreuser_info .= '';
$moreuser_info .= '';

# check to see if user is logged into facebook
if(isset($_COOKIE['fbsr_' . $appID])):
$marquee_one .= ' Thanks for taking the time to login to our facebook app now you will be able to use the like and comments sections of this web portal...';
else:
$marquee_one .= ' login to our facebook app and you will be able to use the like and comments sections of this web portal...';
endif;

$date .= '::: QUOTE OF THE DAY "Stop Fixing Shit That Is Not Broken! by ErnStoy" ::: Todays date <font color="'.$textcolor2.'">'.date('m-d-Y').'</font>';

if ($titanium_username === _ANONYMOUS)
$moreuser_info .= '::: There is so much more here to see, it takes 30 seconds to register an account and we don\'t even verify with e-mail! Just register we promise you won\'t be sorry...';

if ($titanium_username === _ANONYMOUS)
$marquee_one = $moreuser_info.' ::: Your Monitor Resolution is <font color="'.$textcolor2.'">'.$screen_res.'</font> ::: '.$newmessages.'';
else
$marquee_one = $date.' '.$connected.' Welcome back <strong><font color='.$textcolor2.'><span class="blink-one">'.$titanium_username.'</span></font></strong> It\'s quite awesome to see you my friend! We are so glad you could make it back over to visit... We know with your super tight busy schedule and all, it most certainly must have been quite a task! ::: '.$newmessages.' ::: Your current Monitor Resolution is <font color='.$textcolor2.'>'.$screen_res.'</font> '.$moreuser_info.' ::: Your current browser version is <font color="'.$textcolor2.'">'.$titanium_browser->getVersion().'</font> ::: '.$scrollmsg.'</div>';

//$bullshit2 = 'Sept 28th 2019, Oct 4th 2019, Oct 5th 2019, Oct 11th 2019, Oct 13th 2019, Oct 14th 2019 Oct 20th 2019, Oct 22nd 2019, Oct 24th 2019';
# right finger
$lfinger = '<img border="0" align="absmiddle" height="16" src="themes/'.$theme_name.'/images/finger-pointing-left-icon.png" alt="Look at this!" title="Look at this!">';
$rfinger = '<img border="0" align="absmiddle" height="16" src="themes/'.$theme_name.'/images/finger-pointing-right-icon.png" alt="Look at this!" title="Look at this!">';

$marquee_two = '
               <strong>IPHub is an IP lookup website featuring Proxy/VPN detection. 
			   A free API is available, so you can perform fraud checks on online stores, 
			   detect malicious players on online games and much more! <a href="https://iphub.info" target="new">'.$rfinger.' Click here '.$lfinger.' to sign up for FREE today at ipHub</a></strong>
              <strong>::: <font color='.$textcolor2.'><a href="https://soulcircuscowboys.com" target="_blank">Country Music: The Soul Circus Cowboys</a></font></strong>
              <strong>::: <font color='.$textcolor2.'><a href="https://facebook.com/brandon.maintenance" target="_blank">Sponsor: Brandon Maintenance Management, LLC Phone: 813-846-2865</a></font></strong>
              <strong>::: <font color='.$textcolor2.'><a href="https://bigcountryradio.net" target="_blank">Sponsor: Big Country Radio - The EJ Morning Show</a></font> :::</strong>';


#-----------------#
# RD Scripts v1.0 #
#-----------------#
//addJSToBody(theme_js_dir.'menu.min.js');


# This is where we set the poster background and full screen video START
echo '<div class="fullscreen-bg">';
echo '<video muted loop autoplay class="fullscreen-bg__video">';
//echo '<video loop autoplay class="fullscreen-bg__video">';
//echo '<source src="themes/'.$theme_name.'/video/ready_for_it.mp4" type="video/mp4">';


//echo '<source src="themes/'.$theme_name.'/video/spinning_black_wave_lines.mp4" type="video/mp4">';
//echo '<source src="themes/'.$theme_name.'/video/abstract_liquid.mp4" type="video/mp4">'; // Ypp slow but pretty
//echo '<source src="themes/'.$theme_name.'/video/abstract_geometric_grid.mp4" type="video/mp4">';
//echo '<source src="themes/'.$theme_name.'/video/abstract_red_neon_frame.mp4" type="video/mp4">'; ### Very Cool ###
//echo '<source src="themes/'.$theme_name.'/video/abstract_blue_neon_frame.mp4" type="video/mp4">'; ### Very Cool ###
//echo '<source src="themes/'.$theme_name.'/video/abstract_purple_green_neon_frame.mp4" type="video/mp4">'; ### Very Cool ###
//echo '<source src="themes/'.$theme_name.'/video/abstract_retro_laser_neon_flourescent_line_beams_geometric_motion_moving.mp4" type="video/mp4">'; ### 1 to 10  THis is a 10 ###
//echo '<source src="themes/'.$theme_name.'/video/neon_lines_saber_abstract_background_animated.mp4" type="video/mp4">'; ### 1 to 10  This is a 2 ###
//echo '<source src="themes/'.$theme_name.'/video/retro_neon_hypnotic_orange_white.mp4" type="video/mp4">'; ### 1 to 10  This is a 9 ###
//echo '<source src="themes/'.$theme_name.'/video/abstract_x_neon.mp4" type="video/mp4">'; ### 1 to 10  This is a 1 ###

#### PHP-Nuke Titanium
echo '<source src="themes/'.$theme_name.'/video/aqua_fresh.mp4" type="video/mp4">'; // $$$ Top 10 - 01
//echo '<source src="themes/'.$theme_name.'/video/abstract_neon_reflections_circular_particles_3D_light_moving.mp4" type="video/mp4">'; ### 1 to 10  This is a 8 ### Bad Ass
//echo '<source src="themes/'.$theme_name.'/video/abstract_modern_Liquid_U_trend_aurora_gradien.mp4" type="video/mp4">'; ### 1 to 10  This is a 5 ###
//echo '<source src="themes/'.$theme_name.'/video/futuristic_gold_abstract_3D_tunnel_1.49gb.mp4" type="video/mp4">'; ### 1 to 10  This is a 10 ### BEST SO FAR
//echo '<source src="themes/'.$theme_name.'/video/abstract_bright_neon_moving_geometric_lines_gradient.mp4" type="video/mp4">'; ### 1 to 10  This is a 6 ### 
//echo '<source src="themes/'.$theme_name.'/video/abstract_3D_tunnel_motion.mp4" type="video/mp4">'; ### 1 to 10  This is a 5 ### 
//echo '<source src="themes/'.$theme_name.'/video/abstract_trendy_gradient_glowing_pink_moving_geometric_circles_spheres.mp4" type="video/mp4">'; ### 1 to 10  This is a 7 ### VEry Cool
//echo '<source src="themes/'.$theme_name.'/video/abstract_retro_laser_neon_flourescent_line_beams_geometric_motion_moving_02.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### Bad as fuck 

### Electrical field frame - Maybe good for a theme that could be built arounf the way it looks
//echo '<source src="themes/'.$theme_name.'/video/electrical_frame.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### Bad as fuck  


//echo '<source src="themes/'.$theme_name.'/video/futuristic_crystal_landscape_abstract_3D_neon.mp4" type="video/mp4">'; ### 1 to 10  This is a 4 ### 
//echo '<source src="themes/'.$theme_name.'/video/red_glowing_neon_frame_border_twitching_lines.mp4" type="video/mp4">'; ### 1 to 10  This is a 7 ### VEry Cool
//echo '<source src="themes/'.$theme_name.'/video/trending_abstract_blue_gradient_moving_geometric_circle_sphere.mp4" type="video/mp4">'; ### 1 to 10  This is a 7 ### VEry Cool

//echo '<source src="themes/'.$theme_name.'/video/abstract_gaming_animated_digital_grid_tech_neon_moving.mp4" type="video/mp4">'; ### 1 to 4  This is a 8 ok
//echo '<source src="themes/'.$theme_name.'/video/abstract_hexagonal_geometric_animated_neon.mp4" type="video/mp4">'; ### 1 to 10  This is a 8 ### Bad Ass MAybe FOr ANother Color Theme
//echo '<source src="themes/'.$theme_name.'/video/red_neon_abstract_moving_geometric_circles.mp4" type="video/mp4">'; ### 1 to 10 This is a 5 ###  

//echo '<source src="themes/'.$theme_name.'/video/cinematic_motion_2020.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### GEars SPinning - More for a bronze theme  VEry Cools

//echo '<source src="themes/'.$theme_name.'/video/techno_matrix_numbers.mp4" type="video/mp4">'; ### 1 to 10 This is a 6 ### GEars SPinning - More for a green theme 
//echo '<source src="themes/'.$theme_name.'/video/birthday.mp4" type="video/mp4">'; ### 1 to 10 This is a 6 ### GEars SPinning - lightning no audio 

## Best out of all - American Flag 
//echo '<source src="themes/'.$theme_name.'/video/USA_Flag.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### FLAG - BAd As Fuck 

## Raining Money
//echo '<source src="themes/'.$theme_name.'/video/money_falling.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### Bad As Fuck - Riaing Money

## Music Videos
//echo '<source src="themes/'.$theme_name.'/video/Blackway_and_Black_Caviar_Whats_Up_Danger.mp4" type="video/mp4">'; ### 1 to 10 This is a 6 ### GEars SPinning - BAd as Fuck 
//echo '<source src="themes/'.$theme_name.'/video/Arctic_Monkeys_-_Do_I_Wanna_Know.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### Bad As Fuck 

## Loading Screens
//echo '<source src="themes/'.$theme_name.'/video/Loading_Screen_001.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### Loading Screen Only - Video has to be loop off ### cool as fauck 

//echo '<source src="themes/'.$theme_name.'/video/black_psychedelic_abstract.mp4" type="video/mp4">'; ### 1 to 0 This is a 10 ### jumps NOT A LOOP

## Hacker at computer - Hacking Music
//echo '<source src="themes/'.$theme_name.'/video/Programming_Coding_Hacking_music_vol.18_ANONYMOUS_HEADQUARTERS.mp4" type="video/mp4">'; ### 1 to 0 This is a 10 ### jumps NOT A LOOP

## Red Cross
//echo '<source src="themes/'.$theme_name.'/video/red_cross_motion.mp4" type="video/mp4">'; ### 1 to 10 This is a 10 ### Bad as fuck 


echo '</video>';
echo '</div>';
# This is where we set the poster background and full screen video END

# This is the flex container used to resize the layout START
echo '<section id="flex-container">';
//echo '<div class="container" style="width: '.theme_width.'">';
echo '<div class="container" style="width: '.$locked_width.'">';



# space at the top of the page
echo '<div align="center" style="padding-top:6px;">';
echo '</div>';

# This stays always
echo '<table class= "outer_table_opacity" border="0" width="100%" cellspacing="0" cellpadding="0">';
echo '<tr>';
echo '<td>';

# add the top of your tabel here
echo "\n\n<!-- HEADER TOP START -->\n";

global $bgcolor4;
# top of awesome table
print '<table bgcolor="'.$bgcolor4.'" class="blockz" cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";
# invisble pixel set to width 39
print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/HEADER/invisible_pixel.gif);">'."\n";
# left corner of awesome table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/top_left_corner.png" border="0" width="39" height="50"></td>'."\n";
# top middle repeat image for stretch of table
print '<td align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/HEADER/top_middle_piece.png);"></td>'."\n";
print '<td align="right" width="39">'."\n";
# top right corner of awesome table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/top_right_corner_10.png" border="0" width="39" height="50"></td>'."\n";
print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";


print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";

///////////////////////
print '<tr>'."\n";
#left middle side of awesome table
print '<td width="23" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/left_side_middle_151515.png">'."\n"; 
# left middle side of awesome table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/left_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";
//////////////////////

print '<td width="100%">'."\n";
# end top half of table HERE
//echo '<div class="marquee_one"><font color="#ffc62a" size="2"><strong>TEST</strong></font></div>'."\n\n";
//echo '<div align="center" class="marquee_two"><font color="#ffc62a" size="2"><strong>TEST</strong></font></div>'."\n\n";

print '<table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";

echo "<!-- HEADER TOP END -->\n\n\n\n\n";

# ad banner for left side of header - 86it ads only! CELL ONE @ 33.3% START
echo '<table border="0" width="100%" height="165">';
echo '<tr>';
echo '<td align="left" width="25%" valign="top">';
echo '<div align="center" style="padding-top:17px;">';
echo '</div>';
echo ''.ads(0).'';
echo '</td>';
# ad banner for left side of header - 86it ads only! CELL ONE @ 33.3% END

//echo '<table border="0" width="100%" height="165">';
//echo '<tr>';
//echo '<td align="left" width="25%" valign="top">';
//echo '</div>';
//echo '<div class="banner_left"><img src="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/future_02.png" width="350" alt="Xtreme" longdesc="PHP-Nuke Evolution Xtreme" />';
//echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.HTTPS.'themes/'.$theme_name.'/header/buzzard2.png" width="92" alt="Buzzard" longdesc="Buzzard (Patients My Ass)" /></div>';
//echo '</td>';

# programming logos start

# center CELL TWO @ 33.3% START
echo '<td align="center" valign="top" rowspan="4">';

# space at the top of header inside graphics area!
if($_COOKIE["titanium_resolution_width"] > 1366):
echo '<div align="center" style="padding-top:10px;">';
echo '</div>';
?>
<div align="center" class="logo" id="logo"><svg width="64" viewBox="0 0 128 128">
<path d="M3.68 98.837c1.197-.2 2.767-.37 4.764-.37 2.453 0 4.25.57 5.392 1.597 1.056.913 1.684 2.31 1.684 4.023 0 1.74-.514 3.11-1.483 4.11-1.313 1.397-3.453 2.11-5.878 2.11-.743 0-1.427-.03-1.998-.17v7.703H3.68V98.837zm2.48 9.273c.543.143 1.228.2 2.056.2 2.996 0 4.822-1.456 4.822-4.11 0-2.538-1.798-3.765-4.537-3.765-1.084 0-1.91.086-2.34.2v7.475zM18.626 97.58h2.51v8.618h.058a4.666 4.666 0 0 1 1.797-1.77c.743-.427 1.628-.713 2.57-.713 1.855 0 4.822 1.14 4.822 5.907v8.217H27.87v-7.933c0-2.226-.827-4.11-3.195-4.11-1.627 0-2.91 1.142-3.367 2.512-.143.342-.17.713-.17 1.198v8.332h-2.512V97.58zM34.457 108.538c0-1.77-.057-3.195-.114-4.508h2.255l.114 2.37h.057c1.026-1.685 2.652-2.684 4.906-2.684 3.34 0 5.85 2.825 5.85 7.02 0 4.963-3.025 7.418-6.277 7.418-1.827 0-3.425-.8-4.254-2.17h-.056v7.505h-2.482v-14.952zm2.483 3.68c0 .372.057.714.114 1.028.457 1.74 1.97 2.94 3.766 2.94 2.653 0 4.195-2.17 4.195-5.336 0-2.768-1.456-5.136-4.11-5.136-1.71 0-3.308 1.227-3.795 3.11-.085.314-.17.685-.17 1.027v2.37zM50.632 113.36c1.17.6 2.968 1.2 4.822 1.2 1.997 0 3.053-.828 3.053-2.084 0-1.2-.912-1.883-3.225-2.71-3.195-1.114-5.278-2.883-5.278-5.68 0-3.28 2.738-5.79 7.275-5.79 2.168 0 3.765.456 4.908.97l-.97 3.51a9.133 9.133 0 0 0-4.024-.915c-1.883 0-2.797.858-2.797 1.856 0 1.227 1.085 1.77 3.567 2.71 3.396 1.256 4.994 3.025 4.994 5.736 0 3.225-2.482 5.964-7.76 5.964-2.198 0-4.366-.57-5.45-1.17l.884-3.596zM70.46 99.893v3.994h3.11v3.196h-3.11v5.05c0 1.683.4 2.454 1.712 2.454.542 0 .97-.057 1.284-.114l.028 3.28c-.57.23-1.598.372-2.825.372-1.398 0-2.568-.485-3.253-1.2-.798-.826-1.198-2.168-1.198-4.136v-5.708h-1.856v-3.196h1.855v-3.024l4.25-.97zM89.716 110.707c0 5.107-3.623 7.447-7.36 7.447-4.08 0-7.22-2.682-7.22-7.19 0-4.51 2.968-7.39 7.447-7.39 4.28 0 7.133 2.938 7.133 7.133zm-10.1.142c0 2.395 1 4.193 2.853 4.193 1.683 0 2.767-1.683 2.767-4.194 0-2.084-.798-4.196-2.768-4.196-2.083 0-2.854 2.14-2.854 4.195zM92.396 108.48c0-2.053-.057-3.394-.114-4.593h3.737l.14 2.568h.115c.715-2.025 2.426-2.88 3.766-2.88.4 0 .6 0 .915.056v4.08a6.22 6.22 0 0 0-1.17-.113c-1.598 0-2.683.856-2.967 2.197a5.125 5.125 0 0 0-.086.97v7.076h-4.336v-9.36zM103.236 108.338c0-1.74-.057-3.224-.114-4.45h3.652l.2 1.882h.084c.6-.884 1.826-2.197 4.223-2.197 1.8 0 3.226.913 3.824 2.368h.057a6.238 6.238 0 0 1 1.8-1.682c.77-.457 1.625-.685 2.652-.685 2.68 0 4.708 1.883 4.708 6.05v8.216h-4.223v-7.59c0-2.026-.656-3.196-2.055-3.196-1 0-1.712.685-1.997 1.512-.114.314-.17.77-.17 1.113v8.16h-4.224v-7.82c0-1.768-.626-2.967-1.995-2.967-1.113 0-1.77.856-2.027 1.57-.142.342-.17.74-.17 1.083v8.132h-4.223v-9.5z"></path><path fill="#5058A6" d="M66.257 69.99c1.415 1.838 2.833 2.626 4.538 2.626 2.962 0 5.543-2.54 5.543-6.38V55.99c0-4.542-2.29-7.04-5.543-7.04-1.83 0-3.83 1.04-5.168 3.286V49.57h-5.704v34.44H30.16V69.99c1.414 1.838 2.834 2.626 4.54 2.626 2.96 0 5.543-2.54 5.543-6.38V55.99c0-4.542-2.287-7.04-5.542-7.04-1.832 0-3.833 1.04-5.167 3.286V49.57h-5.706v34.44H19.24V33.53h22.624v38.462h6.333V56.197c0-1.293.536-2.083 1.75-2.083 1.086 0 1.664.666 1.664 2.083v15.795h6.338V54.03c0-3.5-2.335-5.082-5.046-5.082-1.67 0-3.46.54-4.706 2.12V33.532h24.39c-.003.087-.01.154-.01.24l.07 2.147c0 3.138 1.513 6.986 2.26 8.693 0 0 2.148 4.405 3.81 6.135 1.66 1.725 2.883 3.018 4.293 4.378 1.304 1.25 2.53 2.438 3.192 3.254 1.1 1.358 1.168 2.518 1.267 4.204.194 3.286-1.014 5.194-2.88 7.734-1.897 2.59-2.94 3.71-4.144 5.007-.604.655-1.236 1.334-1.992 2.208l-.608.704c-1.215 1.4-2.242 2.59-3.11 3.682l-1.947 2.093h-6.534V69.99zm3.746-5.043V56.86c0-1.79-.624-2.746-1.87-2.746-1.254 0-1.876.956-1.876 2.747v8.087c0 1.793.622 2.627 1.875 2.627 1.247 0 1.87-.833 1.87-2.627zm-36.097 0V56.86c0-1.79-.622-2.746-1.87-2.746-1.25 0-1.877.956-1.877 2.747v8.087c0 1.793.625 2.627 1.876 2.627 1.248 0 1.87-.833 1.87-2.627z"></path><path fill="#F58A1F" d="M103.69 16.55c1.454-1.684 2.654-3.048 3.64-4.288H85.257c-1.312 1.677-3.98 4.908-5.502 7.775-2.01 3.794-3.666 6.642-3.828 13.628l.07 2.253c0 3.33 2.387 8.22 2.387 8.22.372.87 1.63 2.7 2.436 3.82h-.018c.267.354.44.58.44.58 2.38 2.725 5.98 5.77 7.568 7.727 1.858 2.297 1.906 4.445 2.003 6.116.273 4.522-1.56 7.25-3.518 9.92-2.957 4.036-4.025 4.785-6.3 7.425-1.455 1.68-2.65 3.044-3.635 4.285h22.8c1.338-1.723 3.238-4.89 4.77-7.775 2.01-3.794 3.668-6.644 3.83-13.624l-.073-2.252c0-3.33-2.38-8.225-2.38-8.225-.375-.868-1.634-2.692-2.445-3.82h.017c-.26-.348-.44-.58-.44-.58-2.373-2.723-5.978-5.768-7.562-7.725-1.86-2.293-1.91-4.44-2.01-6.118-.27-4.52 1.56-7.25 3.517-9.92 2.962-4.032 4.03-4.786 6.304-7.42z"></path>
</svg> <svg width="64" viewBox="0 0 128 128">
<path fill-rule="evenodd" clip-rule="evenodd" fill="#68B604" d="M53.607 57.793c-8.247.028-16.494.207-24.741.207h-1.186c11.396-16 22.632-31.211 33.949-46.722-.384-.026-.569-.144-.754-.144-17.851-.002-35.701-.046-53.552-.06-.627 0-.842.137-.836.798.031 3.689.015 7.367.015 11.057 0 1.052.001 1.047 1.067 1.047 9.034.001 18.068-.003 27.102.001.355 0 .711.046 1.256.086-11.441 15.61-22.757 31.05-34.146 46.588l.584.033c17.146.001 34.291-.003 51.436.017.701.001.794-.281.791-.866-.018-3.744-.03-7.393.009-11.136.007-.779-.206-.908-.994-.906zM60.364 27.487c.027.71.442.513.869.513h24.828c4.178 0 8.357.116 12.536.091 4.555-.027 9.12.124 13.662-.146 4.703-.279 8.459-2.475 11.051-6.493 1.743-2.702 2.514-5.711 2.896-8.863.104-.861-.447-.742-.963-.742-16.172.001-32.344-.018-48.517.034-1.793.006-3.633.191-5.37.638-6.242 1.602-11.236 8.491-10.992 14.968zM76 32.988c-2.638.003-5.18.517-7.503 1.791-5.405 2.962-7.481 7.921-8.119 13.723-.084.766.38.745.905.744 4.312-.007 8.623-.004 12.935-.004 1.464 0 2.929.021 4.393-.004 3.222-.054 6.464.069 9.661-.248 4.157-.412 7.536-2.437 9.939-5.917 1.889-2.735 2.833-5.812 3.162-9.103.096-.965.135-.985-.804-.986-8.19-.001-16.38-.006-24.569.004zM84.882 54.699c-.004-.574-.228-.675-.722-.672-2.494.016-4.989-.023-7.482.021-1.157.021-2.323.12-3.466.299-8.958 1.396-12.3 8.892-12.836 15.287-.048.573.158.762.729.75 1.491-.03 2.982-.011 4.473-.011l.003.083c2.027-.09 4.073-.036 6.079-.295 7.531-.971 13.28-7.764 13.222-15.462zM33.72 103.333c-.092-.279-.233-.37-.512-.366-.938.012-1.875.018-2.813-.003-.342-.007-.488.115-.595.44-1.208 3.696-2.433 7.387-3.655 11.077-.199.6-.408 1.195-.649 1.9l-4.28-5.52.303-.206c1.25-.733 2.08-1.759 2.238-3.243.197-1.842-.329-3.343-2.345-4.108-.503-.19-1.07-.283-1.61-.295-2.008-.042-4.018-.025-6.026-.043-.329-.003-.471.07-.47.445.013 4.286.012 8.572.001 12.858-.001.349.125.426.444.418.788-.019 1.578-.025 2.366.003.399.014.542-.085.534-.514-.028-1.368-.014-2.738-.004-4.107.001-.146.038-.358.136-.424.319-.214 1.154.007 1.393.327 1.083 1.457 2.16 2.918 3.259 4.362.124.164.37.33.562.332 2.128.023 4.256.009 6.384.021.287.002.39-.114.458-.363l.598-2.051c.083-.306.24-.431.566-.426 1.161.015 2.322.014 3.482 0 .333-.005.469.134.552.44.186.688.395 1.369.621 2.044.046.137.208.33.321.333 1.024.025 2.048.015 3.109.015l-.062-.329c-1.438-4.336-2.878-8.675-4.306-13.017zm-14.434 5.629c-.771.211-1.606.199-2.415.254-.069.005-.215-.218-.221-.34-.024-.535-.01-1.07-.01-1.606 0-.505.006-1.012-.003-1.517-.004-.228.052-.387.313-.376.696.027 1.401.004 2.086.106.817.122 1.257.647 1.324 1.399.093 1.024-.254 1.855-1.074 2.08zm11.018 2.038c.467-1 .915-2.811 1.362-4.287l.137-.106c.449 1.477.898 3.394 1.368 4.394l-2.867-.001zM84.599 102.97c-.818.006-1.638.024-2.455-.009-.39-.016-.512.152-.582.491-.478 2.308-.966 4.613-1.454 6.92-.12.566-.25 1.131-.376 1.695-.145-.146-.189-.283-.222-.424-.648-2.757-1.301-5.513-1.933-8.273-.073-.32-.215-.407-.514-.402-.803.012-1.608.023-2.411-.006-.372-.013-.521.128-.604.475-.533 2.235-1.081 4.468-1.628 6.7-.155.633-.324 1.263-.486 1.894l-.131-.006c-.106-.498-.219-.995-.319-1.495-.482-2.397-.957-4.796-1.45-7.191-.028-.136-.199-.343-.307-.346-1.037-.027-2.075-.016-3.142-.016l.049.398c1.07 4.317 2.144 8.635 3.212 12.954.063.253.174.366.457.36.937-.018 1.875-.027 2.812.004.373.012.515-.11.6-.464.528-2.206 1.076-4.408 1.62-6.61.109-.441.233-.878.351-1.317l.111.016.117.377c.647 2.513 1.3 5.024 1.929 7.543.084.338.208.463.562.453.922-.023 1.846-.021 2.768 0 .324.008.467-.091.547-.413 1.057-4.307 2.124-8.61 3.2-12.912.08-.329-.036-.398-.321-.396zM53.288 103.43c0-.347-.108-.472-.461-.465-.967.019-1.935.02-2.902-.001-.347-.007-.528.101-.669.432-.775 1.817-1.577 3.624-2.371 5.434l-.428.924-.276-.546c-.857-1.944-1.718-3.887-2.562-5.837-.124-.286-.273-.411-.594-.405-.997.018-1.994.015-2.991.002-.325-.005-.474.064-.473.443.013 4.285.012 8.572.001 12.859-.001.347.122.428.442.419.729-.019 1.459-.026 2.188.003.401.017.677-.09.674-.516-.021-2.664.132-5.328.132-7.992v-.461c0 .135.117.285.182.443.663 1.59 1.263 3.177 1.905 4.776.146.364.304.502.691.473.444-.033.876-.023 1.322-.002.3.014.445-.101.556-.378.397-.993.813-1.977 1.225-2.964l.984-2.376.136.022v.469c0 2.664.015 5.328 0 7.992-.002.376.078.531.492.514.772-.033 1.549-.025 2.323-.002.343.01.474-.083.473-.445-.009-4.271-.008-8.544.001-12.815zM109.094 110.783l.108-.076c1.376-.771 2.22-1.893 2.347-3.505.12-1.526-.316-2.795-1.744-3.623-.686-.397-1.442-.563-2.218-.575-2.008-.03-4.017-.02-6.025-.037-.33-.004-.47.074-.469.446.013 4.285.012 8.57.001 12.855 0 .345.12.428.441.42.803-.019 1.608-.028 2.41.004.411.017.496-.131.49-.511-.021-1.384-.011-2.768-.002-4.151 0-.133.033-.325.122-.387.291-.202 1.149.008 1.366.299 1.083 1.456 2.169 2.909 3.243 4.372.192.262.391.387.735.378 1.026-.026 2.053-.009 3.08-.01l.494-.027-4.459-5.76.08-.112zm-2.544-1.641c-.572.069-1.154.062-1.73.102-.321.022-.408-.123-.397-.421.018-.504.005-1.01.005-1.515 0-.535-.014-1.07.012-1.604.006-.112.164-.312.25-.311.71.005 1.431-.021 2.126.095.952.16 1.378.805 1.332 1.804-.046.988-.67 1.736-1.598 1.85zM94.664 102.962c-1.035-.308-2.092-.373-3.171-.242-1.455.177-2.72.72-3.72 1.811-1.37 1.495-1.763 3.321-1.828 5.281.081.691.109 1.394.252 2.071.457 2.169 1.59 3.823 3.725 4.659.972.381 1.99.436 3.022.416 2.535-.047 4.646-1.5 5.506-3.882.757-2.096.762-4.235.064-6.338-.624-1.89-1.905-3.2-3.85-3.776zm.29 9.894c-.523.982-1.298 1.563-2.442 1.574-1.167.012-1.998-.561-2.47-1.583-.275-.596-.476-1.255-.555-1.904-.166-1.364-.124-2.731.472-4.015.386-.831.962-1.466 1.899-1.668 1.288-.278 2.428.254 3.06 1.433.533.996.679 2.077.644 3.19.027 1.039-.111 2.04-.608 2.973zM125.93 116.062c-1.438-2.115-2.871-4.234-4.323-6.34-.203-.295-.21-.491.009-.778 1.363-1.785 2.707-3.585 4.058-5.379l.442-.587c-1.285 0-2.472-.01-3.658.015-.133.002-.294.177-.389.31-1.003 1.404-1.995 2.816-2.991 4.225l-.983 1.448-.096-.039v-.473c0-1.667-.055-3.334-.033-5 .005-.403-.149-.512-.532-.499-.758.024-1.528.028-2.287-.002-.418-.016-.565.098-.563.542.017 4.226.012 8.452 0 12.679-.001.38.079.527.489.51.772-.032 1.547-.03 2.319-.001.399.015.545-.086.534-.514-.03-1.146.032-2.294-.026-3.437-.035-.689.287-1.146.731-1.643l.276.363c1.015 1.539 2.045 3.069 3.03 4.628.278.438.565.632 1.101.607 1.063-.049 2.131-.015 3.292-.015l-.4-.62zM64.809 102.964c-2.708.014-5.416.016-8.124-.002-.429-.003-.514.149-.511.543.017 2.113.008 4.226.008 6.338 0 2.129.001 4.256-.001 6.384 0 .248-.028.464.349.462 2.812-.012 5.624-.009 8.436-.001.287 0 .353-.119.348-.376-.012-.565-.027-1.132.004-1.695.021-.387-.128-.474-.486-.47-1.622.016-3.243-.001-4.865.013-.344.003-.475-.099-.465-.458.022-.893.025-1.786-.001-2.679-.012-.389.101-.514.5-.507 1.458.022 2.916-.001 4.374.015.336.004.446-.108.434-.437-.02-.55-.022-1.102 0-1.651.015-.354-.115-.456-.465-.451-1.413.017-2.581.007-3.995.007-.594 0-.349-.001-.349-.573v-1.339c0-.624-.245-.626.402-.626 1.562-.001 3.001-.011 4.563.006.375.005.434-.119.414-.487-.028-.504-.064-1.013-.03-1.517.027-.407-.161-.501-.54-.499zM11.491 103.452c.018-.368-.113-.489-.484-.487-2.679.012-5.357.013-8.036-.001-.379-.002-.474.129-.471.49.015 2.128.007 4.257.007 6.385 0 2.114.008 4.228-.008 6.341-.003.376.074.53.488.513.787-.032 1.578-.032 2.366 0 .413.018.493-.135.489-.513-.019-1.666.001-3.333-.015-5-.003-.365.101-.49.476-.485l4.286.017c.362.005.469-.12.456-.462-.02-.535-.025-1.072.002-1.606.019-.379-.127-.478-.49-.473l-4.241.014c-.359.004-.509-.088-.489-.472.029-.549.007-1.102.007-1.651 0-.597.001-.6.583-.601 1.518-.002 3.036-.01 4.554.006.375.004.547-.086.521-.497-.03-.505-.025-1.013-.001-1.518zM31.398 95.384l-.116.014-.246-.46c-1.646-3.299-3.293-6.596-4.928-9.899-.159-.321-.339-.472-.712-.444-.489.036-.983.033-1.473.001-.406-.027-.53.096-.529.517.017 4.033.01 8.067.01 12.1 0 1.118 0 1.102 1.139 1.113.401.004.481-.131.479-.515-.012-3.543-.022-7.085-.022-10.628v-.527l.122-.028.2.33c1.705 3.385 3.453 6.752 5.091 10.169.441.92.926 1.367 1.966 1.205.601-.095.621-.019.621-.619v-12.055c0-1.06-.005-1.038-1.05-1.066-.422-.011-.525.126-.523.528.015 3.26.008 6.519.006 9.778l-.035.486zM35.876 97.841c0 .286.027.488.399.478 1.59-.047 3.187.001 4.768-.133 1.909-.161 3.384-1.133 4.374-2.791 1.032-1.729 1.209-3.604.878-5.549-.49-2.88-2.513-4.929-5.745-5.146-1.378-.094-2.765-.055-4.146-.106-.41-.014-.537.108-.533.521.018 2.114.008 4.227.009 6.341 0 2.128.002 4.256-.004 6.385zm1.753-11.482l.038-.212c1.355.009 2.706-.135 4.011.36 1.698.646 2.592 1.922 2.877 3.664.187 1.141.147 2.281-.172 3.399-.499 1.75-1.993 3.008-3.803 3.163-.857.073-1.721.065-2.582.102-.25.011-.379-.051-.378-.341.008-3.377.006-6.757.009-10.135zM20.336 98.312c1.113-.003.941.16.982-.964.017-.441-.142-.552-.562-.548-1.86.02-3.72.001-5.58.015-.375.003-.521-.093-.514-.501.024-1.427.009-2.856.011-4.284l.026-.214c.184-.008.343.184.503.184h4.643c1.03 0 1.015-.207 1.026-1.252.004-.381-.099-.618-.501-.613-1.755.021-3.511-.049-5.267-.038-.323.002-.445-.118-.438-.458.02-.996.022-2.006-.001-3.003-.008-.373.114-.489.481-.486 1.696.017 3.393.003 5.089.003 1.094 0 1.079-.001 1.083-1.08.001-.375-.122-.479-.488-.476-2.455.014-4.91.015-7.365-.004-.408-.003-.529.106-.527.521.015 4.226.014 8.451 0 12.678-.001.407.112.535.524.531 2.292-.017 4.583-.003 6.875-.011zM10.03 98.314c.997 0 .976-.001 1-.987.01-.419-.129-.529-.532-.526-2.114.017-4.227.009-6.341.005-.178 0-.355-.039-.597-.067l.289-.443c2.114-3.042 4.212-6.096 6.357-9.114.465-.655.708-1.294.652-2.096-.028-.397-.134-.493-.518-.491-2.44.015-4.881.008-7.322.008-1.052 0-1.034 0-1.056 1.053-.008.394.105.433.5.429 1.95-.02 3.9-.084 5.85-.084h.62c-.145 0-.219.453-.307.58-2.101 3.033-4.188 6.112-6.315 9.126-.442.627-.677 1.258-.635 2.029.024.454.143.583.587.579 2.588-.02 5.178-.001 7.768-.001z"></path>
</svg> <svg width="64" viewBox="0 0 128 128">
<path fill="#00618A" d="M2.001 90.458h4.108v-16.223l6.36 14.143c.75 1.712 1.777 2.317 3.792 2.317s3.003-.605 3.753-2.317l6.36-14.143v16.223h4.108v-16.196c0-1.58-.632-2.345-1.936-2.739-3.121-.974-5.215-.131-6.163 1.976l-6.241 13.958-6.043-13.959c-.909-2.106-3.042-2.949-6.163-1.976-1.304.395-1.936 1.159-1.936 2.739v16.197zM33.899 77.252h4.107v8.938c-.038.485.156 1.625 2.406 1.661 1.148.018 8.862 0 8.934 0v-10.643h4.117c.019 0-.004 14.514-.004 14.574.022 3.58-4.441 4.357-6.499 4.417h-12.972v-2.764c.022 0 12.963.003 12.995-.001 2.645-.279 2.332-1.593 2.331-2.035v-1.078h-8.731c-4.062-.037-6.65-1.81-6.683-3.85-.002-.187.089-9.129-.001-9.219z"></path><path fill="#E48E00" d="M56.63 90.458h11.812c1.383 0 2.727-.289 3.793-.789 1.777-.816 2.646-1.922 2.646-3.372v-3.002c0-1.185-.987-2.292-2.923-3.028-1.027-.396-2.292-.605-3.517-.605h-4.978c-1.659 0-2.449-.5-2.646-1.606-.039-.132-.039-.237-.039-.369v-1.87c0-.105 0-.211.039-.342.197-.843.632-1.08 2.094-1.212l.395-.026h11.733v-2.738h-11.535c-1.659 0-2.528.105-3.318.342-2.449.764-3.517 1.975-3.517 4.082v2.396c0 1.844 2.095 3.424 5.61 3.793.396.025.79.053 1.185.053h4.267c.158 0 .316 0 .435.025 1.304.105 1.856.343 2.252.816.237.237.315.475.315.737v2.397c0 .289-.197.658-.592.974-.355.316-.948.527-1.738.58l-.435.026h-11.338v2.738zM100.511 85.692c0 2.817 2.094 4.397 6.32 4.714.395.026.79.052 1.185.052h10.706v-2.738h-10.784c-2.41 0-3.318-.606-3.318-2.055v-14.168h-4.108v14.195zM77.503 85.834v-9.765c0-2.48 1.742-3.985 5.186-4.46.356-.053.753-.079 1.108-.079h7.799c.396 0 .752.026 1.147.079 3.444.475 5.187 1.979 5.187 4.46v9.765c0 2.014-.74 3.09-2.445 3.792l4.048 3.653h-4.771l-3.274-2.956-3.296.209h-4.395c-.752 0-1.543-.105-2.414-.343-2.613-.712-3.88-2.085-3.88-4.355zm4.434-.237c0 .132.039.265.079.423.237 1.135 1.307 1.768 2.929 1.768h3.732l-3.428-3.095h4.771l2.989 2.7c.552-.295.914-.743 1.041-1.32.039-.132.039-.264.039-.396v-9.368c0-.105 0-.238-.039-.37-.238-1.056-1.307-1.662-2.89-1.662h-6.216c-1.82 0-3.008.792-3.008 2.032v9.288z"></path><path fill="#00618A" d="M122.336 66.952c-2.525-.069-4.454.166-6.104.861-.469.198-1.216.203-1.292.79.257.271.297.674.502 1.006.394.637 1.059 1.491 1.652 1.938.647.489 1.315 1.013 2.011 1.437 1.235.754 2.615 1.184 3.806 1.938.701.446 1.397 1.006 2.082 1.509.339.247.565.634 1.006.789v-.071c-.231-.294-.291-.698-.503-1.006l-.934-.934c-.913-1.212-2.071-2.275-3.304-3.159-.982-.705-3.18-1.658-3.59-2.801l-.072-.071c.696-.079 1.512-.331 2.154-.503 1.08-.29 2.045-.215 3.16-.503l1.508-.432v-.286c-.563-.578-.966-1.344-1.58-1.867-1.607-1.369-3.363-2.737-5.17-3.879-1.002-.632-2.241-1.043-3.304-1.579-.356-.181-.984-.274-1.221-.575-.559-.711-.862-1.612-1.293-2.441-.9-1.735-1.786-3.631-2.585-5.458-.544-1.245-.9-2.473-1.579-3.59-3.261-5.361-6.771-8.597-12.208-11.777-1.157-.677-2.55-.943-4.021-1.292l-2.37-.144c-.481-.201-.983-.791-1.436-1.077-1.802-1.138-6.422-3.613-7.756-.358-.842 2.054 1.26 4.058 2.011 5.099.527.73 1.203 1.548 1.58 2.369.248.54.29 1.081.503 1.652.521 1.406.976 2.937 1.651 4.236.341.658.718 1.351 1.149 1.939.264.36.718.52.789 1.077-.443.62-.469 1.584-.718 2.369-1.122 3.539-.699 7.938.934 10.557.501.805 1.681 2.529 3.303 1.867 1.419-.578 1.103-2.369 1.509-3.95.092-.357.035-.621.215-.861v.072l1.293 2.585c.957 1.541 2.654 3.15 4.093 4.237.746.563 1.334 1.538 2.298 1.867v-.073h-.071c-.188-.291-.479-.411-.719-.646-.562-.551-1.187-1.235-1.651-1.867-1.309-1.776-2.465-3.721-3.519-5.745-.503-.966-.94-2.032-1.364-3.016-.164-.379-.162-.953-.502-1.148-.466.72-1.149 1.303-1.509 2.154-.574 1.36-.648 3.019-.861 4.739l-.144.071c-1.001-.241-1.352-1.271-1.724-2.154-.94-2.233-1.115-5.83-.287-8.401.214-.666 1.181-2.761.789-3.376-.187-.613-.804-.967-1.148-1.437-.427-.579-.854-1.341-1.149-2.011-.77-1.741-1.129-3.696-1.938-5.457-.388-.842-1.042-1.693-1.58-2.441-.595-.83-1.262-1.44-1.724-2.442-.164-.356-.387-.927-.144-1.293.077-.247.188-.35.432-.431.416-.321 1.576.107 2.01.287 1.152.479 2.113.934 3.089 1.58.468.311.941.911 1.508 1.077h.646c1.011.232 2.144.071 3.088.358 1.67.508 3.166 1.297 4.524 2.155 4.139 2.614 7.522 6.334 9.838 10.772.372.715.534 1.396.861 2.154.662 1.528 1.496 3.101 2.154 4.596.657 1.491 1.298 2.996 2.227 4.237.488.652 2.374 1.002 3.231 1.364.601.254 1.585.519 2.154.861 1.087.656 2.141 1.437 3.16 2.155.509.362 2.076 1.149 2.154 1.798zM90.237 39.593c-.526-.01-.899.058-1.293.144v.071h.072c.251.517.694.849 1.005 1.293l.719 1.508.071-.071c.445-.313.648-.814.646-1.58-.179-.188-.205-.423-.359-.646-.204-.3-.602-.468-.861-.719z"></path>
</svg> <svg width="64" viewBox="0 0 128 128">
<path fill="#F0DB4F" d="M2 1v125h125v-125h-125zm66.119 106.513c-1.845 3.749-5.367 6.212-9.448 7.401-6.271 1.44-12.269.619-16.731-2.059-2.986-1.832-5.318-4.652-6.901-7.901l9.52-5.83c.083.035.333.487.667 1.071 1.214 2.034 2.261 3.474 4.319 4.485 2.022.69 6.461 1.131 8.175-2.427 1.047-1.81.714-7.628.714-14.065-.001-10.115.046-20.188.046-30.188h11.709c0 11 .06 21.418 0 32.152.025 6.58.596 12.446-2.07 17.361zm48.574-3.308c-4.07 13.922-26.762 14.374-35.83 5.176-1.916-2.165-3.117-3.296-4.26-5.795 4.819-2.772 4.819-2.772 9.508-5.485 2.547 3.915 4.902 6.068 9.139 6.949 5.748.702 11.531-1.273 10.234-7.378-1.333-4.986-11.77-6.199-18.873-11.531-7.211-4.843-8.901-16.611-2.975-23.335 1.975-2.487 5.343-4.343 8.877-5.235l3.688-.477c7.081-.143 11.507 1.727 14.756 5.355.904.916 1.642 1.904 3.022 4.045-3.772 2.404-3.76 2.381-9.163 5.879-1.154-2.486-3.069-4.046-5.093-4.724-3.142-.952-7.104.083-7.926 3.403-.285 1.023-.226 1.975.227 3.665 1.273 2.903 5.545 4.165 9.377 5.926 11.031 4.474 14.756 9.271 15.672 14.981.882 4.916-.213 8.105-.38 8.581z"></path>
</svg> <svg width="64" viewBox="0 0 128 128">
<path fill="#E44D26" d="M19.569 27l8.087 89.919 36.289 9.682 36.39-9.499 8.096-90.102h-88.862zm72.041 20.471l-.507 5.834-.223 2.695h-42.569l1.017 12h40.54l-.271 2.231-2.615 28.909-.192 1.69-22.79 6.134v-.005l-.027.012-22.777-5.916-1.546-17.055h11.168l.791 8.46 12.385 3.139.006-.234v.012l12.412-2.649 1.296-13.728h-38.555l-2.734-30.836-.267-3.164h55.724000000000004l-.266 2.471zM27.956 1.627h5.622v5.556h5.144v-5.556h5.623v16.822h-5.623v-5.633h-5.143v5.633h-5.623v-16.822zM51.738 7.206h-4.95v-5.579h15.525v5.579h-4.952v11.243h-5.623v-11.243zM64.777 1.627h5.862l3.607 5.911 3.603-5.911h5.865v16.822h-5.601v-8.338l-3.867 5.981h-.098l-3.87-5.981v8.338h-5.502v-16.822zM86.513 1.627h5.624v11.262h7.907v5.561h-13.531v-16.823z"></path>
</svg> <svg width="64" viewBox="0 0 128 128">
<path fill="#1572B6" d="M19.67 26l8.069 90.493 36.206 10.05 36.307-10.063 8.078-90.48h-88.66zm69.21 50.488l-2.35 21.892.009 1.875-22.539 6.295v.001l-.018.015-22.719-6.225-1.537-17.341h11.141l.79 8.766 12.347 3.295-.004.015v-.032l12.394-3.495 1.308-14.549h-25.907000000000004l-.222-2.355-.506-5.647-.265-2.998h27.886000000000003l1.014-11h-42.473l-.223-2.589-.506-6.03-.265-3.381h55.597l-.267 3.334-2.685 30.154"></path><path fill="#1572B6" d="M89 14.374l-7.149-8.374h7.149v-5h-16v4.363l8.39 7.637h-8.39v5h16zM70 14.374l-6.807-8.374h6.807v-5h-15v4.363l7.733 7.637h-7.733v5h15zM52 13h-8v-7h8v-5h-14v17h14z"></path>
</svg> <svg width="64" viewBox="0 0 128 128">
<path fill="#0074BD" d="M52.581 67.817s-3.284 1.911 2.341 2.557c6.814.778 10.297.666 17.805-.753 0 0 1.979 1.237 4.735 2.309-16.836 7.213-38.104-.418-24.881-4.113zM50.522 58.402s-3.684 2.729 1.945 3.311c7.28.751 13.027.813 22.979-1.103 0 0 1.373 1.396 3.536 2.157-20.352 5.954-43.021.469-28.46-4.365z"></path><path fill="#EA2D2E" d="M67.865 42.431c4.151 4.778-1.088 9.074-1.088 9.074s10.533-5.437 5.696-12.248c-4.519-6.349-7.982-9.502 10.771-20.378.001 0-29.438 7.35-15.379 23.552z"></path><path fill="#0074BD" d="M90.132 74.781s2.432 2.005-2.678 3.555c-9.716 2.943-40.444 3.831-48.979.117-3.066-1.335 2.687-3.187 4.496-3.576 1.887-.409 2.965-.334 2.965-.334-3.412-2.403-22.055 4.719-9.469 6.762 34.324 5.563 62.567-2.506 53.665-6.524zM54.162 48.647s-15.629 3.713-5.534 5.063c4.264.57 12.758.439 20.676-.225 6.469-.543 12.961-1.704 12.961-1.704s-2.279.978-3.93 2.104c-15.874 4.175-46.533 2.23-37.706-2.038 7.463-3.611 13.533-3.2 13.533-3.2zM82.2 64.317c16.135-8.382 8.674-16.438 3.467-15.353-1.273.266-1.845.496-1.845.496s.475-.744 1.378-1.063c10.302-3.62 18.223 10.681-3.322 16.345 0 0 .247-.224.322-.425z"></path><path fill="#EA2D2E" d="M72.474 1.313s8.935 8.939-8.476 22.682c-13.962 11.027-3.184 17.313-.006 24.498-8.15-7.354-14.128-13.828-10.118-19.852 5.889-8.842 22.204-13.131 18.6-27.328z"></path><path fill="#0074BD" d="M55.749 87.039c15.484.99 39.269-.551 39.832-7.878 0 0-1.082 2.777-12.799 4.981-13.218 2.488-29.523 2.199-39.191.603 0 0 1.98 1.64 12.158 2.294z"></path><path fill="#EA2D2E" d="M94.866 100.181h-.472v-.264h1.27v.264h-.47v1.317h-.329l.001-1.317zm2.535.066h-.006l-.468 1.251h-.216l-.465-1.251h-.005v1.251h-.312v-1.581h.457l.431 1.119.432-1.119h.454v1.581h-.302v-1.251zM53.211 115.037c-1.46 1.266-3.004 1.978-4.391 1.978-1.974 0-3.045-1.186-3.045-3.085 0-2.055 1.146-3.56 5.738-3.56h1.697v4.667h.001zm4.031 4.548v-14.077c0-3.599-2.053-5.973-6.997-5.973-2.886 0-5.416.714-7.473 1.622l.592 2.493c1.62-.595 3.715-1.147 5.771-1.147 2.85 0 4.075 1.147 4.075 3.521v1.779h-1.424c-6.921 0-10.044 2.685-10.044 6.723 0 3.479 2.058 5.456 5.933 5.456 2.49 0 4.351-1.028 6.088-2.533l.316 2.137h3.163v-.001zM70.694 119.585h-5.027l-6.051-19.689h4.391l3.756 12.099.835 3.635c1.896-5.258 3.24-10.596 3.912-15.733h4.271c-1.143 6.481-3.203 13.598-6.087 19.688zM89.982 115.037c-1.465 1.266-3.01 1.978-4.392 1.978-1.976 0-3.046-1.186-3.046-3.085 0-2.055 1.149-3.56 5.736-3.56h1.701v4.667h.001zm4.033 4.548v-14.077c0-3.599-2.059-5.973-6.999-5.973-2.889 0-5.418.714-7.475 1.622l.593 2.493c1.62-.595 3.718-1.147 5.774-1.147 2.846 0 4.074 1.147 4.074 3.521v1.779h-1.424c-6.923 0-10.045 2.685-10.045 6.723 0 3.479 2.056 5.456 5.93 5.456 2.491 0 4.349-1.028 6.091-2.533l.318 2.137h3.163v-.001zM37.322 122.931c-1.147 1.679-3.005 3.008-5.037 3.757l-1.989-2.345c1.547-.794 2.872-2.075 3.489-3.269.532-1.063.753-2.43.753-5.701v-22.482h4.284v22.173c0 4.375-.348 6.144-1.5 7.867z"></path>
</svg>
</div>
<?
endif;
if($_COOKIE["titanium_resolution_width"] > 1366):
global $eighty_six_it, $my_welcome_message;
echo '<div align="center"><strong><font color="#e48e00"></font>'.$my_welcome_message.'</strong></div>';
echo '<div align="center"><strong><font color="#1572b6">'.$eighty_six_it.'</font></strong></div>';
echo '<div align="center" style="padding-top:5px;">';
echo '</div>';
endif;
# MENU SYSTEM
#######################################################################################################################################################
//echo '<div class="box_bottom" style="width: 100%; height: 45px;>';                                                                                  #
include(theme_dir.'menu.php');                                                                                                                        #
//echo '</div>';                                                                                                                                      #
#######################################################################################################################################################

# logo end
echo '</td>';

# ad banner for right side of header - 86it ads only! 
echo '<td align="right" width="25%" valign="top">';
echo '<div align="right">'; 
echo '<div align="center" style="padding-top:17px;">'; 
echo '</div>';
echo ''.network_ads(0).''; 
echo '</div>';
echo '</td>';
echo '</tr>';

echo '<tr>';
echo '<td align="left" height="30" width="25%" valign="middle">   </td>';



echo '<td align="left" width="25%" valign="middle"></td>';

echo '</tr>';

# left and right marquee START
echo '<tr>';
echo '<td align="left" width="25%" valign="bottom" height="20"><div class="marquee_one"><font color="#008000" size="2"><strong>'.$marquee_one.'</strong></font></div></td>';
echo '<td align="right" width="25%" valign="bottom" height="20"><div class="marquee_two"><font color="#008000" size="2"><strong>'.$marquee_two.'</strong></font></div></td>';
echo '</tr>';
# left and right marquee END

echo '<tr>';
echo '<td align="left" height="13" width="25%" valign="middle"></td>';
echo '<td align="right" height="13" width="25%" valign="middle"></td>';
echo '</tr>';


echo '</table>';



if (!is_user()):
echo '<div align="center">';
echo '<div class="alert alert-danger fade in alert-dismissible role="alert">';
echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
echo '  <strong>Alert!</strong> You are not logged in, please <a style="cursor:help" class="redalert" href="modules.php?name=Your_Account&op=new_user">create an account</a> or <a style="cursor:help" class="redalert" href="modules.php?name=Your_Account">login!</a>';
echo '</div>';

echo '</div>';
endif;

echo '<div align="center" style="padding-top:1px;">';
echo '</div>';

echo "\n\n\n\n\n<!-- function_CloseTable top START -->\n";
print '</td>';
print '</tr>';
print '</table>';

/////////////////////////////
print '</td>';
# middle repeat image for ride side of the table
print '<td width="23" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/right_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/right_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";
//print '</tr>'."\n";
/////////////////////////////

print '</table>'."\n"; 

print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

# invisble gif used in the awesome table
print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/HEADER/invisible_pixel.gif);">'."\n";

# left bottom corner of the awesome table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/bottom_left_corner.png" border="0" width="39" height="50"></td>'."\n";

# bottom middle piece for awesome table
print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/bottom_middle_piece.png"></td>'."\n";



# bottom right corner of awesome table
print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/HEADER/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/HEADER/bottom_right_corner.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";


echo "<img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"1\" height=\"6\" border=\"0\" />";


echo "<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
echo "<tr valign=\"top\">\n";
echo "<td valign=\"top\"></td>\n";
echo "<td valign=\"top\">\n";

if(blocks_visible('left')) 
{
  blocks('left');
  echo "</td>\n";
  // space between the left blocks and the left side of the center block
  echo "<td style=\"width: 6px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"6\" height=\"0\" border=\"0\" /></td>\n";
  echo " <td width=\"100%\">\n";

} 
else  
{
  echo "</td>\n";
  echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"0\" height=\"0\" border=\"0\" /></td>\n";
  echo " <td width=\"100%\">\n";
}

echo "\n<!-- THEME HEADER END -->\n\n\n";
?>

