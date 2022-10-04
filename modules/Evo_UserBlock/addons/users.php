<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : users.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Users Module
************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

global $evouserinfo_addons, $evouserinfo_users;

function evouserinfo_newest_user() 
{
    global $titanium_db, $titanium_user_prefix;
    # do not list the latest user if they are in ghost mode!
    $sql = "SELECT `user_id`, `username` FROM ".$titanium_user_prefix."_users WHERE user_active = 1 AND user_level > 0 AND user_allow_viewonline = 1 ORDER BY user_id DESC LIMIT 1";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);

    return (isset($row)) ? $row : '?';
}

function evouserinfo_new_today() 
{
    global $titanium_user_prefix, $titanium_db;

    $sql = "SELECT COUNT(*) FROM ".$titanium_user_prefix."_users WHERE user_regdate='".date("M d, Y")."'";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_new_yesterday() 
{
    global $titanium_user_prefix, $titanium_db;

    $sql = "SELECT COUNT(*) FROM ".$titanium_user_prefix."_users WHERE user_regdate='".date("M d, Y", time()-86400)."'";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_waiting() 
{
    global $titanium_user_prefix, $titanium_db;

    $sql = "SELECT COUNT(*) FROM ".$titanium_user_prefix."_users_temp";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_total_hidden() 
{
    global $titanium_user_prefix, $titanium_db;

    $sql = "SELECT COUNT(*) FROM ".$titanium_user_prefix."_users WHERE user_id > 1 AND user_allow_viewonline != 1";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);

    return (isset($row[0])) ? $row[0] : '?';
}

function evouserinfo_total() 
{
    global $titanium_user_prefix, $titanium_db;

    $sql = "SELECT COUNT(*) FROM ".$titanium_user_prefix."_users WHERE user_id > 1";
    $result = $titanium_db->sql_query($sql);
    $row = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);

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

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<font color="gold"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['NEW_TODAY'].'<span style="float:right">'.number_format($today).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<font color="#FF3300"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['NEW_YESTERDAY'].'<span style="float:right">'.number_format($yesterday).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<font color="#79CDCD"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['WAITING'].'<span style="float:right">'.number_format($waiting).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<font color="white"><i class="fa fa-snapchat-ghost" aria-hidden="true"></i>
</font>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['HIDDEN'].'<span style="float:right">'.number_format($hidden).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<font color="pink"><i class="fa fa-pie-chart" aria-hidden="true"></i>
</font>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['TOTAL'].'<span style="float:right">'.number_format($total).'&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';

    $evouserinfo_users .= '<div style="padding-left: 10px;">';
    $evouserinfo_users .= '<font color="#33CC00"><i class="fa fa-id-card-o" aria-hidden="true"></i>
</font>&nbsp;'.$lang_evo_userblock['BLOCK']['USERS']['LATEST']
	.'<span style="float:right"><a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$new_user_id.'">'.$new_user.'</a>&nbsp;&nbsp;</span>';
    $evouserinfo_users .= '</div>';
}

if (is_user()):
    evouserinfo_users();
endif;
?>
