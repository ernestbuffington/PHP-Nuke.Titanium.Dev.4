<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/********************************************************/
/* NSN Blogs                                            */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* Contributer(s): Ernest Buffington aka TheGhost       */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Patched                         v3.0.0       08/26/2019
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
 ************************************************************************/
 
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

global $cookie, $userinfo, $theme_name;

$optionbox = "";

$module_name = basename(__DIR__);

get_lang($module_name);

// we only show the left blocks, else the page gets messed up
$showblocks = 1;

$sid = isset($sid) ? (int) $sid : ""; 

if (stristr((string) $_SERVER['REQUEST_URI'],"mainfile")) {
    redirect("modules.php?name=$module_name&file=article&sid=$sid");
} elseif (empty($sid) && !isset($tid)) {
    redirect("index.php");
}

if(is_user()) 
{
    if(!isset($mode)) 
	$mode = $userinfo['umode']; 
    
	if(!isset($order)) 
	$order = $userinfo['uorder']; 
    
	if(!isset($thold)) 
	$thold = $userinfo['thold']; 
    
	$db->sql_query("UPDATE ".$user_prefix."_users SET umode='$mode', uorder='$order', thold='$thold' WHERE user_id=".(int) $cookie[0]);
}

if (isset($op) && $op == "Reply") 
{
    $display = "";
    
	if(isset($mode)) 
	$display .= "&mode=".$mode; 
    
	if(isset($order)) 
	$display .= "&order=".$order; 
    
	if(isset($thold)) 
	$display .= "&thold=".$thold; 
    
	redirect("modules.php?name=$module_name&file=comments&op=Reply&pid=0&sid=".$sid.$display);
}

$result = $db->sql_query("SELECT `catid`, 
                                   `aid`, 
						 `datePublished`, 
						  `dateModified`, 
						         `title`, 
							   `counter`, 
							  `hometext`, 
							  `bodytext`, 
							     `topic`, 
							 `informant`, 
							     `notes`, 
								 `acomm`, 
							   `haspoll`, 
							    `pollID`, 
								 `score`, 
							   `ratings`, 
							     `ticon` 

FROM ".$prefix."_blogs WHERE sid='$sid'");

$numrows = $db->sql_numrows($result);

if (!empty($sid) && $numrows != 1) 
redirect("index.php");

$row = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
$aaid = stripslashes((string) $row['aid']);
$catid = (int) $row["catid"];

$time = $row["datePublished"];
$modified = $row["dateModified"];

$title = stripslashes((string) check_html($row["title"], "nohtml"));
$counter = $row["counter"];

/*****[BEGIN]******************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
$hometext = decode_bbcode(set_smilies(stripslashes((string) $row["hometext"])), 1, true);
$bodytext = decode_bbcode(set_smilies(stripslashes((string) $row["bodytext"])), 1, true);
/*****[END]********************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
$hometext = img_tag_to_resize($hometext);
$bodytext = img_tag_to_resize($bodytext);

$topic = (int) $row["topic"];
$informant = stripslashes((string) $row["informant"]);
$notes = stripslashes((string) $row["notes"]);
$acomm = (int) $row["acomm"];
$haspoll = (int) $row["haspoll"];
$pollID = (int) $row["pollID"];
$score = (int) $row["score"];
$ratings = (int) $row["ratings"];
$topic_icon = (int) $row["ticon"];

if (empty($aaid)) 
redirect("modules.php?name=".$module_name);

$db->sql_query("UPDATE ".$prefix."_blogs SET counter=counter+1 WHERE sid='$sid'");

$artpage = 1;

$pagetitle = "- $title";

include(NUKE_BASE_DIR."header.php");

$artpage = 0;

formatTimestamp($time);

$title = stripslashes((string) check_html($title, "nohtml"));
$counter = stripslashes((string) $counter);
$hometext = stripslashes((string) $hometext);
$bodytext = stripslashes((string) $bodytext);
$notes = stripslashes($notes);

$notes = empty($notes) ? "" : "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>";

$bodytext = empty($bodytext) ? "$hometext$notes" : "$hometext<br /><br />$bodytext$notes";

if(empty($informant)) 
$informant = $anonymous;

getTopics($sid);

if ($catid != 0) {
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_blogs_cat WHERE catid='$catid'"));
    $title1 = stripslashes((string) check_html($row2["title"], "nohtml"));
    $title = "<a href=\"modules.php?name=$module_name&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: $title";
}

if($topic_icon == 1)
$topicimage = '';

echo "<table width=\"100%\" ><tr><td valign=\"top\" width=\"100%\">\n";

themearticle($aaid, $informant, $datetime, $modified, $title, $counter, $bodytext, $topic, $topicname, $topicimage, $topictext);

include_once("modules/$module_name/associates.php");

//if (empty($mode) || $mode != "nocomments" || $acomm == 0 || $articlecomm == 1) 
//include_once("modules/$module_name/comments.php");

echo "</td><td>&nbsp;</td><td valign=\"top\">\n";

$querylang = $multilingual == 1 ? "AND (blanguage='$currentlang' OR blanguage='')" : "";

/* Determine if the article has attached a poll */
if ($haspoll == 1) 
{
    $url = sprintf("modules.php?name=Surveys&amp;op=results&amp;pollID=%d", $pollID);
    $boxContent = "<form action=\"modules.php?name=Surveys\" method=\"post\">";
    $boxContent .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
    $boxContent .= "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">";
    $row3 = $db->sql_fetchrow($db->sql_query("SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID='$pollID'"));
    $pollTitle = stripslashes((string) check_html($row3["pollTitle"], "nohtml"));
    $voters = $row3["voters"];
    $boxTitle = _ARTICLEPOLL;
    $boxContent .= "<span class=\"content\"><strong>$pollTitle</strong></span><br /><br />\n";
    $boxContent .= "<table  width=\"100%\">";

    for($i = 1; $i <= 12; $i++) 
	{
      $result4 = $db->sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')");
      $row4 = $db->sql_fetchrow($result4);
      $numrows = $db->sql_numrows($result4);
      $db->sql_freeresult($result4);
      
	  if($numrows != 0) 
	  {
        $optionText = $row4["optionText"];
      
	    if(!empty($optionText)) 
        $boxContent .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><span class=\"content\">$optionText</span></td></tr>\n";
      }
    }
    $boxContent .= "</table><br /><div align=\"center\"><span class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></span><br />";
    
	for($i = 0; $i < 12; $i++) 
	{
      $row5 = $db->sql_fetchrow($db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')"));
      $optionCount = $row5["optionCount"];
      $sum = (int)$sum+$optionCount;
    }
    $boxContent .= "<span class=\"content\">[ <a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=".$userinfo['umode']."&amp;order=".$userinfo['uorder']."&amp;thold=".$userinfo['thold']."\"><strong>"._RESULTS."</strong></a> | <a href=\"modules.php?name=Surveys\"><strong>"._POLLS."</strong></a> ]<br />";

    if ($pollcomm) 
	{
      $result6 = $db->sql_query("SELECT * FROM ".$prefix."_pollcomments WHERE pollID='$pollID'");
      $numcom = $db->sql_numrows($result6);
      $db->sql_freeresult($result6);
      $boxContent .= "<br />"._VOTES.": <strong>$sum</strong><br />"._PCOMMENTS." <strong>$numcom</strong>\n\n";
    } 
	else 
      $boxContent .= "<br />"._VOTES." <strong>$sum</strong>\n\n";
   
	$boxContent .= "</span></div></form>\n\n";

    themesidebox($boxTitle, $boxContent, "poll1");
}

$boxtitle = ""._RELATED."";
$boxstuff = "<span class=\"content\"><br />";

$url_result = $db->sql_query("SELECT name, url FROM ".$prefix."_related WHERE tid='$topic'");

while ($row_eight = $db->sql_fetchrow($url_result)) 
{
    $name = stripslashes((string) $row_eight["name"]);
    $url = stripslashes((string) $row_eight["url"]);
    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$url."\" target=\"new\">".$name."</a><br />\n";
}

$db->sql_freeresult($url_result);

$boxstuff .= "<hr noshade width=\"95%\" size=\"1\"><div align=\"center\"><strong>"._MOREABOUT."<strong><br /><a href=\"modules.php?name=Search&amp;topic=$topic\">[ $topictext ]</a><br />\n";
$boxstuff .= "<hr noshade width=\"95%\" size=\"1\">"._BLOG_BY."<br /><a href=\"modules.php?name=Search&amp;author=$aaid\">[ $aaid ]</a></div>\n";

$boxstuff .= "</span><hr noshade width=\"95%\" size=\"1\"><div align=\"center\"><span class=\"content\"><strong>Current Blog Topic<br/> ( $topictext )</strong><br />\n";

global $multilingual, $currentlang;
    
$querylang = $multilingual == 1 ? "AND (alanguage='$currentlang' OR alanguage='')" : "";

$row9 = $db->sql_fetchrow($db->sql_query("select sid, title from ".$prefix."_blogs where topic='$topic' $querylang order by counter desc limit 0,1"));
$topstory = (int) $row9["sid"];
$ttitle = stripslashes((string) check_html($row9["title"], "nohtml")); 

$boxstuff .= "<hr noshade width=\"95%\" size=\"1\">Blog Subject<br /><a href=\"modules.php?name=$module_name&amp;file=article&amp;sid=$topstory\">$ttitle</a></span></div><br />\n";

themesidebox($boxtitle, $boxstuff, "newstopic");

global $use_xtreme_voting;

if ($use_xtreme_voting == true) {
    if ($ratings != 0) 
    {
       $rate = substr($score / $ratings, 0, 4);
       $r_image = round($rate);
 
       if ($r_image == 1):
         $the_image = the_rating('large',1,_BAD);
       elseif ($r_image == 2):
         $the_image = the_rating('large',2,_REGULAR);
       elseif ($r_image == 3):
         $the_image = the_rating('large',3,_GOOD);
       elseif ($r_image == 4):
         $the_image = the_rating('large',4,_VERYGOOD);
       elseif ($r_image == 5):
         $the_image = the_rating('large',5,_EXCELLENT);
       endif;
   } 
   else 
   {
     $rate = 0;
     $the_image = "<br />";
   }
} elseif ($ratings != 0) {
    $rate = substr($score / $ratings, 0, 4);
    $r_image = round($rate);
    $temp_image ="";
    if ($r_image == 1) {
        if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-1.png"))
    	   {
    	     $temp_image = "themes/".$theme_name."/images/articles/stars-1.png";
    		 $the_image = "<img src=$temp_image><br />";
    	   }
    	   else
    	   $the_image = "<img src=\"images/articles/stars-1.gif\"><br />";
    } elseif ($r_image == 2) {
        if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-2.png"))
    	   {
    	     $temp_image = "themes/".$theme_name."/images/articles/stars-2.png";
    	     $the_image = "<img src=$temp_image><br />";
    	   }
    	   else
    	   $the_image = "<img src=\"images/articles/stars-2.gif\" ><br />";
    } elseif ($r_image == 3) {
        if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-3.png"))
    	   {
    	     $temp_image = "themes/".$theme_name."/images/articles/stars-3.png";
    	     $the_image = "<br /><br /><img src=$temp_image><br />";
    	   }
    	   else
    	   $the_image = "<img src=\"images/articles/stars-3.gif\" border=\"1\"><br />";
    } elseif ($r_image == 4) {
        if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-4.png"))
    	   {
    	     $temp_image = "themes/".$theme_name."/images/articles/stars-4.png";
    	     $the_image = "<img src=$temp_image><br />";
    	   }
    	   else
    	   $the_image = "<img src=\"images/articles/stars-4.gif\"><br />";
    } elseif ($r_image == 5) {
        if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-5.png"))
       	{
       	  $temp_image = "themes/".$theme_name."/images/articles/stars-5.png";
       	  $the_image = "<img src=$temp_image><br />";
       	}
       	else
       	$the_image = "<img src=\"images/articles/stars-5.gif\"><br />";
    }
} else 
{
    $rate = 0;
    $the_image = "<br />";
}

if ($use_xtreme_voting == true)
{
$ratetitle = ""._RATEARTICLE."";
$ratecontent = "<div align=\"center\">"._AVERAGESCORE.": <strong>$rate</strong><br />"._VOTES.": <strong>$ratings</strong>$the_image";
$ratecontent .= "<form action=\"modules.php?name=$module_name\" method=\"post\"><center>"._RATETHISARTICLE."</div><br />";
$ratecontent .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
$ratecontent .= "<input type=\"hidden\" name=\"op\" value=\"rate_article\">";	
}
else
{
  $ratetitle = ""._RATEARTICLE."<br/>";
  if ($ratings == 1)
  $ratecontent = "<div align=\"center\"><strong>This Blog has a<br/>$rate Star Rating</strong><br/><img src=\"modules/Blogs/images/blockspacer.png\" alt=\"\" width=\"10\" 
  height=\"5\" ><br/><strong>$ratings person has<br/>voted for this Blog</strong><br/><img src=\"modules/Blogs/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" >";
  else
  $ratecontent = "<div align=\"center\"><strong>This Blog has a<br/>$rate Star Rating</strong><br/><img src=\"modules/Blogs/images/blockspacer.png\" alt=\"\" width=\"10\" 
  height=\"5\" ><br/><strong>$ratings people have<br/>voted for this Blog</strong><br/><img src=\"modules/Blogs/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" >";
  
  $ratecontent .= "<form action=\"modules.php?name=$module_name\" method=\"post\"><img src=\"modules/Blogs/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"10\" ><br /><div align=center>"._RATETHISARTICLE."</div><br />";
  $ratecontent .= "<img src=\"modules/Blogs/images/blockspacer.png\" alt=\"stars\" width=\"20\" height=\"20\" ><br />$the_image<br/><img src=\"modules/Blogs/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" ><br />";
  $ratecontent .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
  $ratecontent .= "<input type=\"hidden\" name=\"op\" value=\"rate_article\">";
}
if ($use_xtreme_voting == true)
{
  $ratecontent .= '<input type="radio" name="score" value="5"> '.the_rating('small',5,_EXCELLENT).'<br />';
  $ratecontent .= '<input type="radio" name="score" value="4"> '.the_rating('small',4,_VERYGOOD).'<br />';
  $ratecontent .= '<input type="radio" name="score" value="3"> '.the_rating('small',3,_GOOD).'<br />';
  $ratecontent .= '<input type="radio" name="score" value="2"> '.the_rating('small',2,_REGULAR).'<br />';
  $ratecontent .= '<input type="radio" name="score" value="5"> '.the_rating('small',1,_BAD).'<br /><br />';
}
else
{
    $temp_ratecontent ="";

	if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-5.png"))
	{
	  $temp_ratecontent = "themes/".$theme_name."/images/articles/stars-5.png";
      $ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=$temp_ratecontent  alt=\""._EXCELLENT."\" title=\""._EXCELLENT."\"><br />";
    }
	else
	$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=\"images/articles/stars-5.gif\"  alt=\""._EXCELLENT."\" title=\""._EXCELLENT."\"><br />";
	

	if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-4.png"))
	{
	  $temp_ratecontent = "themes/".$theme_name."/images/articles/stars-4.png";
      $ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=$temp_ratecontent  alt=\""._VERYGOOD."\" title=\""._VERYGOOD."\"><br />";
    }
	else
	$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=\"images/articles/stars-4.gif\"  alt=\""._VERYGOOD."\" title=\""._VERYGOOD."\"><br />";


	if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-3.png"))
	{
	  $temp_ratecontent = "themes/".$theme_name."/images/articles/stars-3.png";
      $ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=$temp_ratecontent  alt=\""._GOOD."\" title=\""._GOOD."\"><br />";
    }
	else
	$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=\"images/articles/stars-3.gif\"  alt=\""._GOOD."\" title=\""._GOOD."\"><br />";


	if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-2.png"))
	{
	  $temp_ratecontent = "themes/".$theme_name."/images/articles/stars-2.png";
      $ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=$temp_ratecontent  alt=\""._REGULAR."\" title=\""._REGULAR."\"><br />";
    }
	else
	$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=\"images/articles/stars-2.gif\"  alt=\""._REGULAR."\" title=\""._REGULAR."\"><br />";


	if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-1.png"))
	{
	  $temp_ratecontent = "themes/".$theme_name."/images/articles/stars-1.png";
      $ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=$temp_ratecontent  alt=\""._BAD."\" title=\""._BAD."\"><br />";
    }
	else
	$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=\"images/articles/stars-1.gif\"  alt=\""._BAD."\" title=\""._BAD."\"><br />";
	
	$ratecontent .= "<br/>";
}

$ratecontent .= "<input type=\"submit\" value=\""._CASTMYVOTE."\"></form><br />";
$ratecontent .= "<img src=\"modules/Blogs/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"1\" ></div>";

themesidebox($ratetitle, $ratecontent, "blogsvote");

$optiontitle = ""._OPTIONS."";
$optionbox = "<br />";
$optionbox .= '&nbsp;<a href="modules.php?name='.the_module().'&amp;file=print&amp;sid='.$sid.'"><i class="fa fa-print"></i></a>&nbsp;<a 
               href="modules.php?name='.the_module().'&amp;file=print&amp;sid='.$sid.'">'._PRINTER_FRIENDLY_BLOG_POST_VIEW.'</a><br />'."\n";
$optionbox .= '&nbsp;<a href="modules.php?name='.the_module().'&amp;file=friend&amp;op=FriendSend&amp;sid='.$sid.'"><i class="fa fa-envelope"></i></a> <a href="modules.php?name='.the_module().'&amp;file=friend&amp;op=FriendSend&amp;sid='.$sid.'">'._SEND_BLOG_TO_FRIEND.'</a><br /><br />'."\n";

if (is_mod_admin($module_name)) 
{
    $optionbox .= '<div class="acenter">'.$customlang['global']['admin'].'<br />[ <a href="'.$admin_file.'.php?op=adminBlog">'.$customlang['global']['add'].'</a> | <a 
	href="'.$admin_file.'.php?op=EditBlog&amp;sid='.$sid.'">'.$customlang['global']['edit'].'</a> | <a href="'.$admin_file.'.php?op=RemoveBlog&amp;sid='.$sid.'">'.$customlang['global']['delete'].'</a> ]</div>';
}

themesidebox($optiontitle, $optionbox, "newsopt");

echo "</td></tr></table>\n";

include_once(NUKE_BASE_DIR.'footer.php');

