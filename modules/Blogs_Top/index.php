<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
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
	  Titanium Patched                         v4.0.3       08/26/2019
 ************************************************************************/
if (!defined('MODULE_FILE'))
exit('You can\'t access this file directly...');

$module_name = basename(__DIR__);

get_lang($module_name);

include_once(NUKE_BASE_DIR.'header.php');

global $fieldset_color, $fieldset_border_width, $digits_color;
global $prefix, $db, $textcolor1;

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

$top = '10';
########################
# Top 10 read stories 
########################
echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><span 
      style="color:'.$textcolor1.'"><h1>'.$top.' '._MOST_READ_BLOG_POSTS.'</h1></span></strong></legend>';

//echo '<br />';
$result = $db->sql_query("SELECT `sid`, `title`, `counter` FROM `".$prefix."_blogs` $queryalang ORDER BY `counter` DESC LIMIT 0,$top");

if ($db->sql_numrows($result) > 0) 
{
    echo "<div style=\"padding-top: 5px;\"><span class=\"option\"></span>";
    echo '<ol>';
    while ($row = $db->sql_fetchrow($result)) 
	{
        $sid = (int) $row['sid'];
        $title = stripslashes((string) check_html($row['title'], "nohtml"));
        $counter = (int) $row['counter'];

	    if($counter > 0) 
		{
            echo '<li><img class="icons" align="absmiddle" width="16" src="'.img('reads-icon-16.png','Blogs_Top').'"> <a 
			href="modules.php?name=Blogs&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ( <strong><span style="color:'.$digits_color.'">'.$counter.'</span></strong> '.BLOG_POST_READS.' )</li>';
        }
    }

	echo '<br />';
	echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$db->sql_freeresult($result);

##############################
# Top 10 most voted stories 
##############################
$result2 = $db->sql_query("SELECT `sid`, `title`, `ratings` FROM `".$prefix."_blogs` $querya1lang score!='0' ORDER BY `ratings` DESC LIMIT 0,$top");
if ($db->sql_numrows($result2) > 0) 
{

echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><span 
     style="color:'.$textcolor1.'"><h1>'.$top.' '._MOST_VOTED_ON_BLOG_POSTS.'</h1></span></strong></legend>';

    echo "<div style=\"padding-top: 5px;\"><span class=\"option\"></span>";
    echo '<ol>';

    while ($row2 = $db->sql_fetchrow($result2)) {
        $sid = (int) $row2['sid'];
        $title = stripslashes((string) check_html($row2['title'], "nohtml"));
        $ratings = (int) $row2['ratings'];
        if($ratings>0) 
		{
            echo '<li><img class="icons" align="absmiddle" width="16" src="'.img('speedometer-16.png','Blogs_Top').'"> <a href="modules.php?name=Blogs&amp;file=article&amp;sid='.$sid.'"> '.$title.'</a> - ( <span 
			     style="color:'.$digits_color.'"><strong>'.$ratings.'</strong></span> '._LVOTES.' )</li>';
        }
    }

	echo '<br />';
    echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$db->sql_freeresult($result2);

##############################
# Top 10 best rated stories 
##############################
$result3 = $db->sql_query("SELECT sid, title, score, ratings FROM ".$prefix."_blogs $querya1lang score!='0' ORDER BY ratings+score DESC LIMIT 0,$top");
if ($db->sql_numrows($result3) > 0) 
{

echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><span 
      style="color:'.$textcolor1.'"><h1>'.$top.' '._BEST_RATED_BLOG_POSTS.'</h1></span></strong></legend>';

    echo "<div style=\"padding-top: 5px;\"><span class=\"option\"></span>";
    echo '<ol>';

    while ($row3 = $db->sql_fetchrow($result3)) {
        $sid = (int) $row3['sid'];
        $title = stripslashes((string) check_html($row3['title'], "nohtml"));
        $score = (int) $row3['score'];
        $ratings = (int) $row3['ratings'];
        if($score>0) {
            $rate = substr($score / $ratings, 0, 4);
            echo '<li><img class="icons" align="absmiddle" width="16" src="'.img('thumbs-up-16.png','Blogs_Top').'"> <a 
			href="modules.php?name=Blogs&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ( <strong><span style="color:'.$digits_color.'">'.$rate.'</span></strong> '._POINTS.' )</li>';
        }
    }
    echo '<br />';
    echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$db->sql_freeresult($result3);

#############################
# Top 10 commented stories 
#############################
if ($articlecomm == 1) 
{
    $result4 = $db->sql_query("SELECT sid, title, comments FROM ".$prefix."_blogs $queryalang ORDER BY comments DESC LIMIT 0,$top");

    if ($db->sql_numrows($result4) > 0) 
	{
        echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
        echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><span 
	          style="color:'.$textcolor1.'"><h1>'.$top.' '._MOST_COMMENTED_ON_BLOG_POSTS.'</h1></span></strong></legend>';

        echo "<div style=\"padding-top: 5px;\"><span class=\"option\"></span>";
        echo '<ol>';

	    while ($row4 = $db->sql_fetchrow($result4)) 
		{
            $sid = (int) $row4['sid'];
            $title = stripslashes((string) check_html($row4['title'], "nohtml"));
            $comments = (int) $row4['comments'];
        
		    if($comments>0) 
			{
                echo '<li><img class="icons" align="absmiddle" width="16" src="'.img('comments-16.png','Blogs_Top').'"> <a href="modules.php?name=Blogs&amp;file=article&amp;sid='.$sid.'">'.$title.'</a> - ( <strong><font color="'.$digits_color.'">'.$comments.'</font></strong> '.BLOG_COMMENTS.' )</li>';
            }
        }
        
		echo '<br />';    
        echo "</ol></div></legend></fieldset>";
		echo '<br />';

    }
}
$db->sql_freeresult($result4);


######################
# Top 10 categories 
######################
$result5 = $db->sql_query("SELECT catid, title, counter FROM ".$prefix."_blogs_cat ORDER BY counter DESC LIMIT 0,$top");
if ($db->sql_numrows($result5) > 0) 
{
    echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
    echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><span 
	     style="color:'.$textcolor1.'"><h1>'.$top.' '._MOST_ACTIVE_BLOG_POST_CATEGORIES.'</h1></span></strong></legend>';

    echo "<div style=\"padding-top: 5px;\"><span class=\"option\"></span>";
    echo '<ol>';

    while ($row5 = $db->sql_fetchrow($result5)) 
	{
        $catid = (int) $row5['catid'];
        $title = stripslashes((string) check_html($row5['title'], "nohtml"));
        $counter = (int) $row5['counter'];
    
	    if($counter>0) 
		{
            echo '<li><img class="icons" align="absmiddle" width="16" src="'.img('comment-square-16.png','Blogs_Top').'"> <a 
			href="modules.php?name=Blogs&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'">'.$title,'</a> - ( <strong><span 
			style="color:'.$digits_color.'">'.$counter.'</span></strong> '._HITS.' )</li>';
        }
    }

    echo '<br />';
    echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$db->sql_freeresult($result5);


##############################################################################################################################################################################
# Top 10 users submitters 
##############################################################################################################################################################################
/*
$result7 = $db->sql_query("SELECT username, counter FROM ".$user_prefix."_users WHERE counter > '0' ORDER BY counter DESC LIMIT 0,$top");
if ($db->sql_numrows($result7) > 0) 
{
    echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
    echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font 
	color="'.$textcolor1.'">'.$top.' '._MOST_ACTIVE_BLOG_AUTHORS.'</font></strong></legend>';
    echo '<br />';

    echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
    echo '<ol>';

    while ($row7 = $db->sql_fetchrow($result7)) 
	{
        $uname = stripslashes((string) $row7['username']);
        $counter = (int) $row7['counter'];
    
	    if($counter>0) 
		{
            echo '<li><img class="icons" align="absmiddle" width="16" 
			src="'.img('submit-icon-16.png','Blogs_Top').'"> <a 
			href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname">'.$uname.'</a> - ( <strong><font color="'.$digits_color.'">'.$counter,'</font></strong> '
			._BLOG_POSTS_SENT.' )</li>';
        }
    }
    
	echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$db->sql_freeresult($result7);
*/
##############################################################################################################################################################################
# Top 10 Polls 
##############################################################################################################################################################################
//$result8 = $db->sql_query("select * from ".$prefix."_poll_desc $queryplang");
//if ($db->sql_numrows($result8)>0) 
//{
//
//    echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
//    echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;">'.$top.' '._VOTEDPOLLS.'</strong></legend>';

//    echo "<div style=\"padding: 0px;\"><span class=\"option\"></span>";
//    echo '<ol>';

    
//	$result9 = $db->sql_query("SELECT pollID, pollTitle, timeStamp, voters FROM ".$prefix."_poll_desc $queryplang order by voters DESC limit 0,$top");
//    $counter = 0;

//    while($row9 = $db->sql_fetchrow($result9)) 
//	{
//        $resultArray[$counter] = array($row9['pollID'], $row9['pollTitle'], $row9['timeStamp'], $row9['voters']);
//        $counter++;
//    }
//    $db->sql_freeresult($result9);
//    
//	for ($count = 0; $count < count($resultArray); $count++) 
//	{
//        $id = $resultArray[$count][0];
//        $pollTitle = $resultArray[$count][1];
//        $voters = $resultArray[$count][3];
//        
//		for($i = 0; $i < 12; $i++) 
//		{
//            $result10 = $db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID='$id') AND (voteID='$i')");
//            $row10 = $db->sql_fetchrow($result10);
//            $optionCount = $row10['optionCount'];
//        
//		    if(!isset($sum)) 
//			{
//                $sum = 0;
//            }
//            
//			$sum = (int)$sum+$optionCount;
//        }
//        echo '<li><img class="icons" align="absmiddle" width="16" src="'.img('speedometer-16.png','Blogs_Top').'"> <a href="modules.php?name=Surveys&amp;pollID='.$id.'">'.$pollTitle.'</a> - ( '.$sum.' '._LVOTES.' )</li>';
        
//		$sum = 0;
//    }
//    echo "</ol></div></legend></fieldset>";
//}
//$db->sql_freeresult($result8);


####################
# Top 10 authors 
####################
$result11 = $db->sql_query("SELECT aid, counter FROM ".$prefix."_authors ORDER BY counter DESC LIMIT 0,$top");
if ($db->sql_numrows($result11) > 0) 
{
    echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
    echo '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-weight: bold;"><font 
	color="'.$textcolor1.'">'.$top.' '._MOST_ACTIVE_BLOG_AUTHORS.'</font></strong></legend>';
    
    echo "<div style=\"padding-top: 5px;\"><span class=\"option\"></span>";
    echo '<ol>';

    while ($row11 = $db->sql_fetchrow($result11)) 
	{
        $aid = stripslashes((string) $row11['aid']);
        $counter = (int) $row11['counter'];
    
	    if($counter>0) 
		{
            echo '<li><img style="padding-top: 3px; vertical-align: top;" class="icons" align="absmiddle" width="16" src="'.img('admin-16.png','Blogs_Top').'"> <a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$aid.'">'.$aid.'</a> - ( <span 
			style="color:'.$digits_color.'"><strong>'.$counter.'</strong></span> '._NEWSPUBLISHED.' )</li>';
        }
    }
    
    echo '<br />';
	echo "</ol></div></legend></fieldset>";
	echo '<br />';

}
$db->sql_freeresult($result11);

/* Top 10 reviews */
//$result12 = $db->sql_query("SELECT id, title, hits FROM ".$prefix."_reviews $queryrlang ORDER BY hits DESC LIMIT 0,$top");
//if ($db->sql_numrows($result12) > 0) {
//    echo "<div style=\"padding: 10px;\"><span class=\"option\"><strong>$top "._READREVIEWS."</strong></span><ol>\n";
//    while ($row12 = $db->sql_fetchrow($result12)) {
//        $id = intval($row12['id']);
//        $title = stripslashes(check_html($row12['title'], "nohtml"));
//        $hits = intval($row12['hits']);
//        if($hits>0) {
//            echo "<li><a href=\"modules.php?name=Reviews&amp;op=showcontent&amp;id=$id\">$title</a> - ($hits ".BLOG_POST_READS.")</li>\n";
//        }
//    }
//    echo "</ol></div>\n";
//}
//$db->sql_freeresult($result12);


/* Top 10 downloads */
//$result13 = $db->sql_query("SELECT lid, cid, title, hits FROM ".$prefix."_nsngd_downloads ORDER BY hits DESC LIMIT 0,$top");
//if ($db->sql_numrows($result13) > 0) {
//    echo "<div style=\"padding: 10px;\"><span class=\"option\"><strong>$top "._DOWNLOADEDFILES."</strong></span><ol>\n";
//    while ($row13 = $db->sql_fetchrow($result13)) {
//        $lid = intval($row13['lid']);
//        $cid = intval($row13['cid']);
//        $title = stripslashes(check_html($row13['title'], "nohtml"));
//        $hits = intval($row13['hits']);
//        if($hits>0) {
//            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_nsngd_categories WHERE cid='$cid'"));
//            $ctitle = stripslashes(check_html($row_res['title'], "nohtml"));
//            $utitle = str_replace(" ", "_", $title);
//            echo "<li><a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$lid&amp;ttitle=$utitle\">$title</a> ("._BLOG_POST_CATEGORY.": $ctitle) - ($hits "._LDOWNLOADS.")</li>\n";
//        }
//    }
//    echo "</ol></div>\n\n";
//}
//$db->sql_freeresult($result13);

/* Top 10 Pages in Content */
//$result14 = $db->sql_query("SELECT pid, title, counter FROM ".$prefix."_pages WHERE active='1' ORDER BY counter DESC LIMIT 0,$top");
//if ($db->sql_numrows($result14) > 0) {
//    echo "<div style=\"padding: 10px;\"><span class=\"option\"><strong>$top "._MOSTREADPAGES."</strong></span><ol>\n";
//    while ($row14 = $db->sql_fetchrow($result14)) {
//        $pid = intval($row14['pid']);
//        $title = stripslashes(check_html($row14['title'], "nohtml"));
//        $counter = intval($row14['counter']);
//        if($counter>0) {
//            echo "<li><a href=\"modules.php?name=Content&amp;pa=showpage&amp;pid=$pid\">$title</a> ($counter ".BLOG_POST_READS.")</li>\n";
//        }
//    }
//    echo "</ol></div>\n\n";
//}
//$db->sql_freeresult($result14);

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

