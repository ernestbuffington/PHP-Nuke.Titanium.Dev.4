<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : mostever.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Most Ever Online Module
************************************************************************/

if(!defined('NUKE_EVO'))
    die ("Illegal File Access");

global $evouserinfo_addons, $evouserinfo_mostever;

function evouserinfo_get_mostonline () 
{
    global $db, $prefix;    
    $result = $db->sql_query("SELECT total, members, nonmembers FROM ".$prefix."_mostonline");
    $mostonline = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    $out['total'] = (is_integer(intval($mostonline['total']))) ? intval($mostonline['total']) : 0;
    $out['members'] = (is_integer(intval($mostonline['members']))) ? intval($mostonline['members']) : 0;
    $out['nonmembers'] = (is_integer(intval($mostonline['nonmembers']))) ? intval($mostonline['nonmembers']) : 0;

    $result = $db->sql_query("SELECT COUNT(*) FROM `".$prefix."_session` WHERE `guest`='0' OR `guest`='2'");
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $users = $row[0];

    $result = $db->sql_query("SELECT COUNT(*) FROM `".$prefix."_session` WHERE `guest`='1' OR `guest`='3'");
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $guests = $row[0];

    $total = $users + $guests;
    
    if ($total > $out['total']):

        $db->sql_query("DELETE FROM `".$prefix."_mostonline` WHERE `total`='".$out['total']."' LIMIT 1");
        $db->sql_query("INSERT INTO `".$prefix."_mostonline` VALUES ('".$total."','".$users."','".$guests."')");

    endif;

    return $out;
}


global $userinfo, $lang_evo_userblock;
$block_mostever = evouserinfo_get_mostonline();

$evouserinfo_mostever .= '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['MOST']['MOST'].'</div>';
$evouserinfo_mostever .= '<div style="padding-left: 10px;">';
$evouserinfo_mostever .= '<font color="gold"><i class="fas fa-radiation-alt" 
aria-hidden="true"></i></font>&nbsp;'.$lang_evo_userblock['BLOCK']['ONLINE']['GUESTS'].'<span style="float:right">'.number_format($block_mostever['nonmembers']).'&nbsp;&nbsp;</span>';
$evouserinfo_mostever .= '</div>';

$evouserinfo_mostever .= '<div style="padding-left: 10px;">';
$evouserinfo_mostever .= '<font color="gold"><i class="fas fa-radiation-alt" 
aria-hidden="true"></i></font>&nbsp;'.$lang_evo_userblock['BLOCK']['ONLINE']['MEMBERS'].'<span style="float:right">'.number_format($block_mostever['members']).'&nbsp;&nbsp;</span>';
$evouserinfo_mostever .= '</div>';

$evouserinfo_mostever .= '<div style="padding-left: 10px;">';
$evouserinfo_mostever .= '<font color="gold"><i class="fas 
fa-radiation-alt" aria-hidden="true"></i></font>&nbsp;'.$lang_evo_userblock['BLOCK']['ONLINE']['TOTAL'].'<span style="float:right">'.number_format($block_mostever['total']).'&nbsp;&nbsp;</span>';
$evouserinfo_mostever .= '</div>';

?>