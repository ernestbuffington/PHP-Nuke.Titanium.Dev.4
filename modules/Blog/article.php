<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
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
/************************************************************************/
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

global $cookie, $userinfo, $theme_name;

$optionbox = "";

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

// we only show the left blocks, else the page gets messed up
$showblocks = 1;

if (isset($sid)) 
$sid = intval($sid); 
else 
$sid = ""; 

if (stristr($_SERVER['REQUEST_URI'],"mainfile")) 
redirect_titanium("modules.php?name=$titanium_module_name&file=article&sid=$sid");
else
if (empty($sid) && !isset($tid)) 
redirect_titanium("index.php");

if(is_user()) 
{
    if(!isset($mode)) 
	$mode = $userinfo['umode']; 
    
	if(!isset($order)) 
	$order = $userinfo['uorder']; 
    
	if(!isset($thold)) 
	$thold = $userinfo['thold']; 
    
	$titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET umode='$mode', uorder='$order', thold='$thold' where user_id=".intval($cookie[0]));
}

if ($op == "Reply") 
{
    $display = "";
    
	if(isset($mode)) 
	$display .= "&mode=".$mode; 
    
	if(isset($order)) 
	$display .= "&order=".$order; 
    
	if(isset($thold)) 
	$display .= "&thold=".$thold; 
    
	redirect_titanium("modules.php?name=$titanium_module_name&file=comments&op=Reply&pid=0&sid=".$sid.$display);
}

$result = $titanium_db->sql_query("select catid, aid, datePublished, dateModified, title, counter, hometext, bodytext, topic, informant, notes, acomm, haspoll, pollID, score, ratings, ticon FROM ".$titanium_prefix."_stories where sid='$sid'");

$numrows = $titanium_db->sql_numrows($result);

if (!empty($sid) && $numrows != 1) 
redirect_titanium("index.php");

$row = $titanium_db->sql_fetchrow($result);
$titanium_db->sql_freeresult($result);
$aaid = stripslashes($row['aid']);
$catid = intval($row["catid"]);

$time = $row["datePublished"];
$modified = $row["dateModified"];

$title = stripslashes(check_html($row["title"], "nohtml"));
$counter = $row["counter"];

/*****[BEGIN]******************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
$hometext = decode_bbcode(set_smilies(stripslashes($row["hometext"])), 1, true);
$bodytext = decode_bbcode(set_smilies(stripslashes($row["bodytext"])), 1, true);
/*****[END]********************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
$hometext = evo_img_tag_to_resize($hometext);
$bodytext = evo_img_tag_to_resize($bodytext);

$topic = intval($row["topic"]);
$informant = stripslashes($row["informant"]);
$notes = stripslashes($row["notes"]);
$acomm = intval($row["acomm"]);
$haspoll = intval($row["haspoll"]);
$pollID = intval($row["pollID"]);
$score = intval($row["score"]);
$ratings = intval($row["ratings"]);
$topic_icon = intval($row["ticon"]);

if (empty($aaid)) 
redirect_titanium("modules.php?name=".$titanium_module_name);

$titanium_db->sql_query("UPDATE ".$titanium_prefix."_stories SET counter=counter+1 where sid='$sid'");

$artpage = 1;

$pagetitle = "- $title";

include(NUKE_BASE_DIR."header.php");

$artpage = 0;

formatTimestamp($time);

$title = stripslashes(check_html($title, "nohtml"));
$counter = stripslashes($counter);
$hometext = stripslashes($hometext);
$bodytext = stripslashes($bodytext);
$notes = stripslashes($notes);

if (!empty($notes)) 
$notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>";
else 
$notes = "";

if(empty($bodytext)) 
$bodytext = "$hometext$notes";
else 
$bodytext = "$hometext<br /><br />$bodytext$notes";

if(empty($informant)) 
$informant = $anonymous;

getTopics($sid);

if ($catid != 0) {
    $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("select title from ".$titanium_prefix."_stories_cat where catid='$catid'"));
    $title1 = stripslashes(check_html($row2["title"], "nohtml"));
    $title = "<a href=\"modules.php?name=$titanium_module_name&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: $title";
}

if($topic_icon == 1)
$topicimage = '';

echo "<table width=\"100%\" ><tr><td valign=\"top\" width=\"100%\">\n";

themearticle($aaid, $informant, $datetime, $modified, $title, $counter, $bodytext, $topic, $topicname, $topicimage, $topictext);

include_once("modules/$titanium_module_name/associates.php");

if (((empty($mode) OR ($mode != "nocomments")) OR ($acomm == 0)) OR ($articlecomm == 1)) 
@include_once("modules/$titanium_module_name/comments.php");

echo "</td><td>&nbsp;</td><td valign=\"top\">\n";

if ($multilingual == 1) 
    $querylang = "AND (blanguage='$currentlang' OR blanguage='')";
else 
    $querylang = "";

/* Determine if the article has attached a poll */
if ($haspoll == 1) 
{
    $url = sprintf("modules.php?name=Surveys&amp;op=results&amp;pollID=%d", $pollID);
    $boxContent = "<form action=\"modules.php?name=Surveys\" method=\"post\">";
    $boxContent .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
    $boxContent .= "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">";
    $row3 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT pollTitle, voters FROM ".$titanium_prefix."_poll_desc WHERE pollID='$pollID'"));
    $pollTitle = stripslashes(check_html($row3["pollTitle"], "nohtml"));
    $voters = $row3["voters"];
    $boxTitle = _ARTICLEPOLL;
    $boxContent .= "<span class=\"content\"><strong>$pollTitle</strong></span><br /><br />\n";
    $boxContent .= "<table  width=\"100%\">";

    for($i = 1; $i <= 12; $i++) 
	{
      $result4 = $titanium_db->sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$titanium_prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')");
      $row4 = $titanium_db->sql_fetchrow($result4);
      $numrows = $titanium_db->sql_numrows($result4);
      $titanium_db->sql_freeresult($result4);
      
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
      $row5 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT optionCount FROM ".$titanium_prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')"));
      $optionCount = $row5["optionCount"];
      $sum = (int)$sum+$optionCount;
    }
    $boxContent .= "<span class=\"content\">[ <a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=".$userinfo['umode']."&amp;order=".$userinfo['uorder']."&amp;thold=".$userinfo['thold']."\"><strong>"._RESULTS."</strong></a> | <a href=\"modules.php?name=Surveys\"><strong>"._POLLS."</strong></a> ]<br />";

    if ($pollcomm) 
	{
      $result6 = $titanium_db->sql_query("select * from ".$titanium_prefix."_pollcomments where pollID='$pollID'");
      $numcom = $titanium_db->sql_numrows($result6);
      $titanium_db->sql_freeresult($result6);
      $boxContent .= "<br />"._VOTES.": <strong>$sum</strong><br />"._PCOMMENTS." <strong>$numcom</strong>\n\n";
    } 
	else 
      $boxContent .= "<br />"._VOTES." <strong>$sum</strong>\n\n";
   
	$boxContent .= "</span></div></form>\n\n";

    themesidebox($boxTitle, $boxContent, "poll1");
}

$boxtitle = ""._RELATED."";
$boxstuff = "<span class=\"content\"><br />";

$url_result = $titanium_db->sql_query("select name, url from ".$titanium_prefix."_related where tid='$topic'");

while ($row_eight = $titanium_db->sql_fetchrow($url_result)) 
{
    $name = stripslashes($row_eight["name"]);
    $url = stripslashes($row_eight["url"]);
    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$url."\" target=\"new\">".$name."</a><br />\n";
}

$titanium_db->sql_freeresult($url_result);

$boxstuff .= "<hr noshade width=\"95%\" size=\"1\"><div align=\"center\"><strong>"._MOREABOUT."<strong><br /><a href=\"modules.php?name=Search&amp;topic=$topic\">[ $topictext ]</a><br />\n";
$boxstuff .= "<hr noshade width=\"95%\" size=\"1\">"._NEWSBY."<br /><a href=\"modules.php?name=Search&amp;author=$aaid\">[ $aaid ]</a></div>\n";

$boxstuff .= "</span><hr noshade width=\"95%\" size=\"1\"><div align=\"center\"><span class=\"content\"><strong>Current Blog Topic<br/> ( $topictext )</strong><br />\n";

global $multilingual, $currentlang;
    
if ($multilingual == 1) 
$querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
else 
$querylang = "";

$row9 = $titanium_db->sql_fetchrow($titanium_db->sql_query("select sid, title from ".$titanium_prefix."_stories where topic='$topic' $querylang order by counter desc limit 0,1"));
$topstory = intval($row9["sid"]);
$ttitle = stripslashes(check_html($row9["title"], "nohtml")); 

$boxstuff .= "<hr noshade width=\"95%\" size=\"1\">Blog Subject<br /><a href=\"modules.php?name=$titanium_module_name&amp;file=article&amp;sid=$topstory\">$ttitle</a></span></div><br />\n";

themesidebox($boxtitle, $boxstuff, "newstopic");

global $use_xtreme_voting;

if ($use_xtreme_voting == true)
{
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
}
else
{
if ($ratings != 0) 
{
    $rate = substr($score / $ratings, 0, 4);
    $r_image = round($rate);
    $temp_image ="";
	
	if ($r_image == 1) 
	{
	   if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-1.png"))
	   {
	     $temp_image = "themes/".$theme_name."/images/articles/stars-1.png";
		 $the_image = "<img src=$temp_image><br />";
	   }
	   else
	   $the_image = "<img src=\"images/articles/stars-1.gif\"><br />";
    } 
	else
	if ($r_image == 2) 
	{
	   if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-2.png"))
	   {
	     $temp_image = "themes/".$theme_name."/images/articles/stars-2.png";
	     $the_image = "<img src=$temp_image><br />";
	   }
	   else
	   $the_image = "<img src=\"images/articles/stars-2.gif\" ><br />";
    } 
	else
	if ($r_image == 3) 
	{
	   if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-3.png"))
	   {
	     $temp_image = "themes/".$theme_name."/images/articles/stars-3.png";
	     $the_image = "<br /><br /><img src=$temp_image><br />";
	   }
	   else
	   $the_image = "<img src=\"images/articles/stars-3.gif\" border=\"1\"><br />";
    } 
	else
	if ($r_image == 4) 
	{
	   if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-4.png"))
	   {
	     $temp_image = "themes/".$theme_name."/images/articles/stars-4.png";
	     $the_image = "<img src=$temp_image><br />";
	   }
	   else
	   $the_image = "<img src=\"images/articles/stars-4.gif\"><br />";
    } 
	else
	if ($r_image == 5) 
	{
	if (file_exists(NUKE_THEMES_DIR.$theme_name."/images/articles/stars-5.png"))
	{
	  $temp_image = "themes/".$theme_name."/images/articles/stars-5.png";
	  $the_image = "<img src=$temp_image><br />";
	}
	else
	$the_image = "<img src=\"images/articles/stars-5.gif\"><br />";
    }
} 
else 
{
    $rate = 0;
    $the_image = "<br />";
}
}

if ($use_xtreme_voting == true)
{
$ratetitle = ""._RATEARTICLE."";
$ratecontent = "<div align=\"center\">"._AVERAGESCORE.": <strong>$rate</strong><br />"._VOTES.": <strong>$ratings</strong>$the_image";
$ratecontent .= "<form action=\"modules.php?name=$titanium_module_name\" method=\"post\"><center>"._RATETHISARTICLE."</div><br />";
$ratecontent .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
$ratecontent .= "<input type=\"hidden\" name=\"op\" value=\"rate_article\">";	
}
else
{
  $ratetitle = ""._RATEARTICLE."<br/>";
  if ($ratings == 1)
  $ratecontent = "<div align=\"center\"><strong>This Blog has a<br/>$rate Star Rating</strong><br/><img src=\"modules/Blog/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" ><br/><strong>$ratings person has<br/>voted for this Blog</strong><br/><img src=\"modules/Blog/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" >";
  else
  $ratecontent = "<div align=\"center\"><strong>This Blog has a<br/>$rate Star Rating</strong><br/><img src=\"modules/Blog/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" ><br/><strong>$ratings people have<br/>voted for this Blog</strong><br/><img src=\"modules/Blog/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" >";
  
  $ratecontent .= "<form action=\"modules.php?name=$titanium_module_name\" method=\"post\"><img src=\"modules/Blog/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"10\" ><br /><div align=center>"._RATETHISARTICLE."</div><br />";
  $ratecontent .= "<img src=\"modules/Blog/images/blockspacer.png\" alt=\"stars\" width=\"20\" height=\"20\" ><br />$the_image<br/><img src=\"modules/Blog/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"5\" ><br />";
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
$ratecontent .= "<img src=\"modules/Blog/images/blockspacer.png\" alt=\"\" width=\"10\" height=\"1\" ></div>";

themesidebox($ratetitle, $ratecontent, "newsvote");

$optiontitle = ""._OPTIONS."";
$optionbox = "<br />";
$optionbox .= '&nbsp;<a href="modules.php?name='.the_module().'&amp;file=print&amp;sid='.$sid.'"><i class="fa fa-print"></i></a>&nbsp;<a href="modules.php?name='.the_module().'&amp;file=print&amp;sid='.$sid.'">'._PRINTER.'</a><br />'."\n";
$optionbox .= '&nbsp;<a href="modules.php?name='.the_module().'&amp;file=friend&amp;op=FriendSend&amp;sid='.$sid.'"><i class="fa fa-envelope"></i></a> <a href="modules.php?name='.the_module().'&amp;file=friend&amp;op=FriendSend&amp;sid='.$sid.'">'._FRIEND.'</a><br /><br />'."\n";

if (is_mod_admin($titanium_module_name)) 
{
    $optionbox .= '<div class="acenter">'.$customlang['global']['admin'].'<br />[ <a href="'.$admin_file.'.php?op=adminStory">'.$customlang['global']['add'].'</a> | <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'.$customlang['global']['edit'].'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'.$customlang['global']['delete'].'</a> ]</div>';
}

themesidebox($optiontitle, $optionbox, "newsopt");

echo "</td></tr></table>\n";

include_once(NUKE_BASE_DIR.'footer.php');
?>
