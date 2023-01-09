<?php
/*=======================================================================
 PHP-Nuke Titanium : Nuke-Evolution | Enhanced and Advnanced
 =======================================================================*/

/************************************************************************
   Nuke-Evolution    : Server Info Administration
   PHP-Nuke Titanium : Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
   Copyright (c) 2022 by The PHP-Nuke Titanium Group

   Filename      : avatar.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)

   Notes         : Evo User Block Forum Posts Module
************************************************************************/

if(!defined('NUKE_EVO')): 
  exit("Illegal File Access");
endif;

global $evouserinfo_addons, $evouserinfo_posts;

function evouserinfo_total_posts() 
{
    global $db, $prefix;
    
    $sql = "SELECT COUNT(*) FROM ".$prefix."_bbposts";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_total_topics()  
{
    global $db, $prefix;
    
    $sql = "SELECT COUNT(*) FROM ".$prefix."_bbtopics";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_ur_total_topics() 
{
    global $db, $prefix, $userinfo;
    
    $sql = "SELECT COUNT(*) FROM ".$prefix."_bbtopics WHERE topic_poster='".$userinfo['user_id']."'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    return (isset($row[0])) ? number_format($row[0]) : '?';
}

function evouserinfo_posts() 
{
    global $evouserinfo_posts, $lang_evo_userblock, $userinfo;
    
    $topics = evouserinfo_total_topics(); 
    $posts = evouserinfo_total_posts();
    
    $evouserinfo_posts = '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['POSTS']['FORUMS'].'</div>';

    $evouserinfo_posts .= '<div style="padding-left: 10px;">';
    $evouserinfo_posts .= '  <font color="red"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;<a class="modules" href="modules.php?name=Forums&file=search&search_id=newposts">'.$lang_evo_userblock['BLOCK']['POSTS']['POSTS'].'</a><span style="float:right">'.$posts.'&nbsp;&nbsp;</span>';
    $evouserinfo_posts .= '</div>';

    $evouserinfo_posts .= '<div style="padding-left: 10px;">';
    $evouserinfo_posts .= '  <font color="yellow"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;<a class="modules" href="modules.php?name=Forums&file=search&search_id=unanswered">'.$lang_evo_userblock['BLOCK']['POSTS']['TOPICS'].'</a><span style="float:right">'.$topics.'&nbsp;&nbsp;</span>';
    $evouserinfo_posts .= '</div>';

    if (is_user()):

      $evouserinfo_posts .= '<div style="padding-left: 10px;">';
      $evouserinfo_posts .= '  <font color="lime"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;<a class="modules" href="modules.php?name=Forums&file=search&search_author='.$userinfo['username'].'&showresults=topics">'.$lang_evo_userblock['BLOCK']['POSTS']['UR_TOPICS'].'</a><span style="float:right">'.evouserinfo_ur_total_topics().'&nbsp;&nbsp;</span>';
      $evouserinfo_posts .= '</div>';

      $evouserinfo_posts .= '<div style="padding-left: 10px;">';
      $evouserinfo_posts .= '  <font color="orange"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;<a class="modules" href="modules.php?name=Forums&file=search&search_id=egosearch">'.$lang_evo_userblock['BLOCK']['POSTS']['UR_POSTS'].
	  '</a><span style="float:right">'.$userinfo['user_posts'].'&nbsp;&nbsp;</span>';
      $evouserinfo_posts .= '</div>';

    endif;

}

evouserinfo_posts();

?>
