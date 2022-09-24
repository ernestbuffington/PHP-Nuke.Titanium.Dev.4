<?php
#---------------------------------------------------------------------------------------#
# function themeindex                                                                   #
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* Theme Index
/*--------------------------*/
function themeindex($aid, $informant, $time, $modified, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext, $writes = false) 
{
    global $bgcolor4, $anonymous, $blogadmin, $tipath, $theme_name, $sid, $ThemeSel, $nukeurl, $customlang;
    global $digits_color, $digits_txt_color;

    if (!empty($topicimage)):
    
        $t_image = (file_exists(theme_images_dir.'topics/'.$topicimage)) ? theme_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
        $topic_img = '<td class="col-3 extra" style="text-align:center;"><a href="modules.php?name=Blog&new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.        $topictext.'"></a></td>';
    else:
        $topic_img = '';
    endif;

    $notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
    $content = '';

    if ($aid == $informant):
        $content = $thetext.$notes;
    else: 

        if ($writes):

            if (!empty($informant)) :
                $content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
            else:
                $content = $anonymous.' ';
            endif;
            $content .= _WRITES.' '.$thetext.$notes;

        else:
            $content .= $thetext.$notes;
        endif;

    endif;

$posted = '<strong>Posted by '.get_author($aid).' '.$time.'</strong>';
$datetime = substr($morelink, 0, strpos($morelink, '|')-strlen($morelink));
$morelink = substr($morelink, strlen($datetime)+2);
$reads = '( <span style="color: '.$digits_txt_color.';">'.$customlang['global']['reads'].'</span>: <span style="color: '.$digits_color.';"><strong>'.$counter.'</strong></span> )';

echo "\n\n<!-- function themeindex START -->\n";

print '<table class=blockz cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";

print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/top_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td valign="top" align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/top_middle_piece.png);"><br>PHP-Nuke Titanium (US Version)</td>'."\n";

print '<td align="right" width="39">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/top_right_corner_10.png" border="0" width="39" height="50"></td>'."\n";
print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";
print '<tr>'."\n";

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/left_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/left_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '<td width="100%">'."\n";
print '<table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";

# This stays no matter what START
echo "<!-- CONTENT START -->\n\n\n\n\n";
print '<div align="center">';
print '<table style="background-color: none; height:100%; width:99%;" class="theme_index" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="theme_index">';
print '<tbody>';
print '<tr>';
print '<td>';

print '<div align="center" style="padding-top:14px;">';
print '</div>';

echo '<div align="center" id="text"><h1><font size="6"><strong>'.$title.'</strong></font></h1>';
print '</div>';

print '<div align="center" style="padding-top:6px;">';
print '</div>';

print ''.$posted.'';

print '<div align="center" style="padding-top:6px;">';
print '</div>';

//content
echo '<div align="left" id="text">';
echo ''.$content.'</div>';	

print blog_signature($aid);

echo '<div align="center"><br />'.$datetime.' '.$topictext.' | '.$morelink.' '.$reads.'<img src="themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif" alt="" width="4" height="1" border="0" /></div>';

print '<div align="center" style="padding-top:14px;">';
print '</div>';

print '</td>';
print '</tr>';
print '</tbody>';
print '</table>';
print '</div>';

echo "\n\n\n\n\n<!-- CONTENT END -->\n";
# This stays no matter what END

print '</td>';
print '</tr>';
print '</table>';
print '</td>';

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/right_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/right_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/bottom_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/bottom_middle_piece.png"></td>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/bottom_right_corner.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";

# This sets the space between blogs listed START
print '<div align="center" style="padding-top:6px;">';
print '</div>';
# This sets the space between blogs listed END

echo "\n<!-- function themeindex END -->\n\n\n";
}
?>
