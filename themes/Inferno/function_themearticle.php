<?php
# THEME INFO                                                                            #
# Inferno Theme v1.3 (Fixed & Full Width)                                               #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* Theme Article 
/*--------------------------*/
function themearticle($aid, $informant, $datetime, $modified, $title, $counter, $thetext, $topic, $topicname, $topicimage, $topictext, $writes = false) 
{
    global $admin, $sid, $tipath, $theme_name, $appID, $my_url;
    global $digits_color, $digits_txt_color;

echo "\n\n<!-- function themearticle START -->\n";

if (!empty($topicimage)) 
{
 $t_image = (file_exists(theme_images_dir.'topics/'.$topicimage)) ? theme_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
 $topic_img = '<td width="25%" align="center" class="extra"><a href="modules.php?name=Blog&new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'"></a></td>';
	} 
	else 
	$topic_img = '';
	
	$notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
	$content = '';
	
	if ($aid == $informant) 
	    $content = $thetext.$notes;
	else 
	{
		if ($writes)
		{
			if (!empty($informant)) 
			{
				$content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
			}
			else 
				$content = $anonymous.' ';
			
			$content .= _WRITES.' '.$thetext.$notes;
		} 
		else 
			$content .= $thetext.$notes;
	}

$posted = _POSTEDON.' '.$datetime.' '._BY.' ';
$posted .= get_author($aid);
$reads = '( <span style="color: '.$digits_txt_color.';">Reads</span>: <span style="color: '.$digits_color.';">'.$counter.'</span> )';

echo '<table class="emiddleflames" border="0" align=center cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';

echo '<td><img name="tlc" src="themes/'.$theme_name.'/center/tlc.gif" width="20" height="25" border="0" alt=""></td>';
echo '<td width="100%" background="themes/'.$theme_name.'/center/tm.gif"><img name="tm" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="trc" src="themes/'.$theme_name.'/center/trc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr>';
echo '<tr>';

echo '<td background="themes/'.$theme_name.'/center/left_side.gif"><img name="leftside" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

//this is where we add the class name for the innermost cell of the 2 tables - top glass and bottom flame repeat-x
echo '<td id="middlebg" class="themearticleflames" height"0" valign="top" >';
//title
echo '<div align="left" id="locator" class="title"><img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /><strong>'.$title.'</strong><br /></div>';

//content
echo '<div align="left" id="text">';
echo '<hr />'.$content.'<hr /></div>';
print blog_signature($aid);
echo "\n\n<!-- facebook functions START -->\n";
facebook_likes();
facebook_comments();
echo "<!-- facebook functions END -->\n\n\n";
	
echo '<div align="right">'.$posted.'<img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /><br />'.$reads.'<img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="1" height="1" border="0" /></div>';

echo '</td>';

echo '<td background="themes/'.$theme_name.'/center/right_side.gif"><img name="rightside" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';

echo '</tr>';
echo '<tr>';

echo '<td><img name="blc" src="themes/'.$theme_name.'/center/blc.gif" width="20" height="25" border="0" alt=""></td>';

echo '<td background="themes/'.$theme_name.'/center/tbm.gif"><img name="tbm" src="themes/'.$theme_name.'/center/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>';
echo '<td><img name="brc" src="themes/'.$theme_name.'/center/brc.gif" width="20" height="25" border="0" alt=""></td>';

echo '</tr>';
echo '</table>';

echo '<div align="center" style="padding-top:6px;">';
echo '</div>';

//invisible spacer for tables instead of <br/>
//echo '<table>';
//echo '<tr>';
// space between article and comments table
//echo '<td style="width: 1px;" valign ="top"><img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="1" height="5" border="0" /></td>';
//echo '</tr>';
//echo '</table>';

echo "\n<!-- function themearticle END -->\n\n\n";
}
?>
