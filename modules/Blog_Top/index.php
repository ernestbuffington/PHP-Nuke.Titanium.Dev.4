<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/
/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Updated                         v3.0.0       08/26/2019
 ************************************************************************/
if (!defined('MODULE_FILE'))

exit('You can\'t access this file directly...');

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

include_once(NUKE_BASE_DIR.'header.php');

global $titanium_prefix, $titanium_db, $textcolor1, $fieldset_color, $fieldset_border_width, $digits_color;

title($sitename.' '.'Blogs Top 10');

if($multilingual == 1): 
    $queryalang = "WHERE (alanguage='$currentlang' OR alanguage='')"; /* top stories */
    $querya1lang = "WHERE (alanguage='$currentlang' OR alanguage='') AND"; /* top stories */
    $queryslang = "WHERE slanguage='$currentlang' "; /* top section articles */
    $queryplang = "WHERE planguage='$currentlang' "; /* top polls */
    $queryrlang = "WHERE rlanguage='$currentlang' "; /* top reviews */
else: 
    $queryalang = '';
    $querya1lang = 'WHERE';
    $queryslang = '';
    $queryplang = '';
    $queryrlang = '';
endif;

OpenTable();

$top = '100';
##############################################################################################################################################################################
# Top 10 read Blogs 
##############################################################################################################################################################################
echo '<br />';

echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';

echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; 
      margin-bottom: 0px; font-weight: bold;"><font color="'.$textcolor1.'">'.$top.' '._MOST_READ_BLOG_POSTS.'</font></strong></legend>';

echo '<br />';
$result = $titanium_db->sql_query("SELECT sid, title, counter FROM ".$titanium_prefix."_stories $queryalang ORDER BY counter DESC LIMIT 0,$top");

if($titanium_db->sql_numrows($result) > 0): 

    echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
    echo '<ol>';
    
	while ($row = $titanium_db->sql_fetchrow($result)) 
	{
        $sid = intval($row['sid']);
        $title = stripslashes(check_html($row['title'], "nohtml"));
        $counter = intval($row['counter']);

	    if($counter>0) 
		{
            echo '<li> <i class="bi bi-arrow-right-square"></i>&nbsp;';
			echo ' <a href="modules.php?name=Blog&amp;file=article&amp;sid='.$sid.'"> '.$title.'</a> ';
			echo ' - ( <strong><font color="'.$digits_color.'">'.$counter.'</font></strong> '.BLOG_POST_READS.' )</li>';
        }
    }
    
	echo "</ol></div></legend></fieldset>";
	echo '<br />';

endif;
$titanium_db->sql_freeresult($result);

##############################################################################################################################################################################
# Top 10 most voted Blogs 
##############################################################################################################################################################################
$result2 = $titanium_db->sql_query("SELECT sid, title, ratings FROM ".$titanium_prefix."_stories $querya1lang score!='0' ORDER BY ratings DESC LIMIT 0,$top");
if ($titanium_db->sql_numrows($result2) > 0) 
{

echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="'.$textcolor1.'">'.$top.' '._MOST_VOTED_ON_BLOG_POSTS.'</font></strong></legend>';
echo '<br />';

    echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
    echo '<ol>';
    while ($row2 = $titanium_db->sql_fetchrow($result2)) {
        $sid = intval($row2['sid']);
        $title = stripslashes(check_html($row2['title'], "nohtml"));
        $ratings = intval($row2['ratings']);
        if($ratings>0) 
		{
            echo '<li><i class="bi bi-award"></i> <a href="modules.php?name=Blog&amp;file=article&amp;sid='.$sid.'"> '.$title.'</a> - ( <font color="'.$digits_color.'"><strong>'.$ratings.'</strong></font> '._LVOTES.' )</li>';
        }
    }
    echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$titanium_db->sql_freeresult($result2);

##############################################################################################################################################################################
# Top 10 best rated Blogs 
##############################################################################################################################################################################
$result3 = $titanium_db->sql_query("SELECT sid, title, score, ratings FROM ".$titanium_prefix."_stories $querya1lang score!='0' ORDER BY ratings+score DESC LIMIT 0,$top");
if ($titanium_db->sql_numrows($result3) > 0) 
{

echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="'.$textcolor1.'">'.$top.' '._BEST_RATED_BLOG_POSTS.'</font></strong></legend>';
echo '<br />';

    echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
    echo '<ol>';

    while ($row3 = $titanium_db->sql_fetchrow($result3)) {
        $sid = intval($row3['sid']);
        $title = stripslashes(check_html($row3['title'], "nohtml"));
        $score = intval($row3['score']);
        $ratings = intval($row3['ratings']);
        if($score>0) {
            $rate = substr($score / $ratings, 0, 4);
            echo '<li><i class="bi bi-hand-thumbs-up"></i> <a href="modules.php?name=Blog&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ( <strong><font color="'.$digits_color.'">'.$rate.'</font></strong> '._POINTS.' )</li>';
        }
    }
    echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$titanium_db->sql_freeresult($result3);

##############################################################################################################################################################################
# Top 10 commented Blogs 
##############################################################################################################################################################################
if ($articlecomm == 1) 
{
    $result4 = $titanium_db->sql_query("SELECT sid, title, comments FROM ".$titanium_prefix."_stories $queryalang ORDER BY comments DESC LIMIT 0,$top");

    if ($titanium_db->sql_numrows($result4) > 0) 
	{
        //echo "<div style=\"padding: 10px;\"><span class=\"option\"><strong>$top "._MOST_COMMENTED_ON_BLOG_POSTS."</strong></span><ol>\n";
       echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
       echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="'.$textcolor1.'">'.$top.' '._MOST_COMMENTED_ON_BLOG_POSTS.'</font></strong></legend>';
       echo '<br />';    

       echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
       echo '<ol>';

	    while ($row4 = $titanium_db->sql_fetchrow($result4)) 
		{
            $sid = intval($row4['sid']);
            $title = stripslashes(check_html($row4['title'], "nohtml"));
            $comments = intval($row4['comments']);
        
		    if($comments>0) 
			{
                echo '<li><i class="bi bi-chat-right"></i> <a href="modules.php?name=Blog&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ( <strong><font color="'.$digits_color.'">'.$comments.'</font></strong> '.BLOG_COMMENTS.' )</li>';
            }
        }
        echo "</ol></div></legend></fieldset>";
		echo '<br />';

    }
}
$titanium_db->sql_freeresult($result4);


##############################################################################################################################################################################
# Top 10 Blog categories 
##############################################################################################################################################################################
$result5 = $titanium_db->sql_query("SELECT catid, title, counter FROM ".$titanium_prefix."_stories_cat ORDER BY counter DESC LIMIT 0,$top");

if ($titanium_db->sql_numrows($result5) > 0) 
{
    //echo "<div style=\"padding: 10px;\"><span class=\"option\"><strong>$top "._MOST_ACTIVE_BLOG_POST_CATEGORIES."</strong></span><ol>\n";

    echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
    echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font color="'.$textcolor1.'">'.$top.' '._MOST_ACTIVE_BLOG_POST_CATEGORIES.'</font></strong></legend>';
    echo '<br />';
    echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
    echo '<ol>';

    while ($row5 = $titanium_db->sql_fetchrow($result5)) 
	{
        $catid = intval($row5['catid']);
        $title = stripslashes(check_html($row5['title'], "nohtml"));
        $counter = intval($row5['counter']);
    
	    if($counter>0) 
		{
            echo '<li><i class="bi bi-fire"></i> <a href="modules.php?name=Blog&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'">'.$title,'</a> - ( <strong><font color="'.$digits_color.'">'.$counter.'</font></strong> '._HITS.' )</li>';
        }
    }
    echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$titanium_db->sql_freeresult($result5);


##############################################################################################################################################################################
# Top 10 user blog submitters 
##############################################################################################################################################################################
$result7 = $titanium_db->sql_query("SELECT username, counter FROM ".$titanium_user_prefix."_users WHERE counter > '0' ORDER BY counter DESC LIMIT 0,$top");

if ($titanium_db->sql_numrows($result7) > 0) 
{
    echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
    
	echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;">';
	echo '<font color="'.$textcolor1.'">'.$top.' '._MOST_ACTIVE_BLOG_AUTHORS.'</font></strong></legend>';
    
	echo '<br />';

    echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
    echo '<ol>';

	while ($row7 = $titanium_db->sql_fetchrow($result7)): 
	
        $uname = stripslashes($row7['username']);
        $counter = intval($row7['counter']);
    

	    if($counter > 0): 
            echo '<li><i class="bi bi-person-bounding-box"></i>  ';
			echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname">'.$uname.'</a> - ( <strong>';
			echo '<font color="'.$digits_color.'">'.$counter,'</font></strong> '._BLOG_POSTS_SENT.' )</li>';
		endif;
    endwhile;

	echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$titanium_db->sql_freeresult($result7);
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
?>