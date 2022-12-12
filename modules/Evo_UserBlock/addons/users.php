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

   Filename      : users.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)

   Notes         : Evo User Block Users Module
************************************************************************/

if(!defined('NUKE_EVO')):
 die ("Illegal File Access");
endif;

global $evouserinfo_addons, $evouserinfo_users;

function evouserinfo_newest_user() 
{
    global $db, $user_prefix;
 
    # do not list the latest user if they are in ghost mode!
    $sql = "SELECT `user_id`, `username` FROM ".$user_prefix."_users WHERE user_active = 1 AND user_level > 0 AND user_allow_viewonline = 1 ORDER BY user_id DESC LIMIT 1";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row)) ? $row : '?';
}

function evouserinfo_new_today() 
{
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_regdate='".date("M d, Y")."'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_new_yesterday() 
{
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_regdate='".date("M d, Y", time()-86400)."'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_waiting() 
{
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users_temp";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_total_hidden() 
{
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_id > 1 AND user_allow_viewonline != 1";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_total() 
{
    global $user_prefix, $db;

    $sql = "SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_id > 1";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_users() 
{
    global $evouserinfo_users, $lang_evo_userblock;

    $today = evouserinfo_new_today();
    $yesterday = evouserinfo_new_yesterday();
    $new_user_id = evouserinfo_newest_user()[0];
    $new_user = UsernameColor(evouserinfo_newest_user()[1]);
    $waiting = evouserinfo_waiting();
    $total = evouserinfo_total();
	$hidden = evouserinfo_total_hidden();

    $evouserinfo_users = '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['USERS']['MEMBERSHIPS'].'</div>';

    # New Today
    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<span style="color: gold;"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</span>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['NEW_TODAY'].'<span style="float:right">'.number_format($today).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';
    
	# New Yesterday
    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<span style="color: #FF3300;"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</span>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['NEW_YESTERDAY'].'<span style="float:right">'.number_format($yesterday).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    # Waiting
    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<span style="color: #79CDCD;"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</span>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['WAITING'].'<span style="float:right">'.number_format($waiting).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    # Ghost Mode
    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<span style="color: white;"><img style="padding-bottom: 3px;" width="16" height="19" src = "images/ico/snapchat-002.ico" alt="Ghost Mode"/>
</span>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['HIDDEN'].'<span style="float:right">'.number_format($hidden).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    # Total users
    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<span style="color: pink;"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</span>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['TOTAL'].'<span style="float:right">'.number_format($total).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    # newest user
    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<span style="color: #33CC00;"><i class="bi bi-person fa-lg" aria-hidden="true"></i>
</span>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['LATEST']
	.'<span style="float:right"><a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$new_user_id.'">'.$new_user.'</a>&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';
}

if(is_user()):
  evouserinfo_users();
endif;

?>
