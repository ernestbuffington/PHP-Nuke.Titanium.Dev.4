<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : posts.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Forum Posts Module
************************************************************************/
if(!defined('NUKE_EVO')) 
exit ("Illegal File Access");

global $evouserinfo_addons, $evouserinfo_posts;

function evouserinfo_total_posts() 
{
    global $titanium_db, $titanium_prefix;
    
    $sql = "SELECT COUNT(*) FROM ".$titanium_prefix."_bbposts";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    
    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_total_topics() 
{
    global $titanium_db, $titanium_prefix;
    
    $sql = "SELECT COUNT(*) FROM ".$titanium_prefix."_bbtopics";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    
    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_ur_total_topics() 
{
    global $titanium_db, $titanium_prefix, $userinfo;
    
    $sql = "SELECT COUNT(*) FROM ".$titanium_prefix."_bbtopics WHERE topic_poster='".$userinfo['user_id']."'";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    
    return (isset($row[0])) ? number_format($row[0]) : '?';
}

function evouserinfo_posts() 
{
    global $evouserinfo_posts, $titanium_lang_evo_userblock, $userinfo;
    
    $phpbb2_topics = evouserinfo_total_topics();
    $phpbb2_posts = evouserinfo_total_posts();
    
    $evouserinfo_posts = '<div style="font-weight: bold">'.$titanium_lang_evo_userblock['BLOCK']['POSTS']['FORUMS'].'</div>';

    $evouserinfo_posts .= '<div style="padding-left: 10px;">';
    $evouserinfo_posts .= '  <font color="red"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['POSTS']['POSTS'].'<span style="float:right">'.number_format($phpbb2_posts).'&nbsp;&nbsp;</span>';
    $evouserinfo_posts .= '</div>';

    $evouserinfo_posts .= '<div style="padding-left: 10px;">';
    $evouserinfo_posts .= '  <font color="yellow"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['POSTS']['TOPICS'].'<span style="float:right">'.number_format($phpbb2_topics).'&nbsp;&nbsp;</span>';
    $evouserinfo_posts .= '</div>';

    if (is_user()):

      $evouserinfo_posts .= '<div style="padding-left: 10px;">';
      $evouserinfo_posts .= '  <font color="lime"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;'.$titanium_lang_evo_userblock['BLOCK']['POSTS']['UR_TOPICS'].'<span style="float:right">'.evouserinfo_ur_total_topics().'&nbsp;&nbsp;</span>';
      $evouserinfo_posts .= '</div>';

      $evouserinfo_posts .= '<div style="padding-left: 10px;">';
      $evouserinfo_posts .= '  <font color="orange"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></font>&nbsp;<a href="modules.php?name=Forums&file=search&search_id=egosearch">'.$titanium_lang_evo_userblock['BLOCK']['POSTS']['UR_POSTS'].
	  '</a><span style="float:right">'.number_format($userinfo['user_posts']).'&nbsp;&nbsp;</span>';
      $evouserinfo_posts .= '</div>';

    endif;

}
evouserinfo_posts();
?>
