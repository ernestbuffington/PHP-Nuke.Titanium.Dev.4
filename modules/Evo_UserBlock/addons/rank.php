<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : rank.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block User Rank Module
************************************************************************/
if(!defined('NUKE_EVO'))
exit ("Illegal File Access");

global $evouserinfo_rank;

function evouserinfo_rank() 
{
    global $evouserinfo_addons, $pnt_db, $pnt_prefix, $userinfo, $evouserinfo_rank;
   # Mod: Multiple Ranks And Staff View v2.0.3 START
   require_once(NUKE_INCLUDE_DIR.'functions_mg_ranks.php');
   $ranks_sql = query_ranks();

   $pnt_user_ranks = generate_ranks($userinfo, $ranks_sql);

   $pnt_user_rank_01 = ($pnt_user_ranks['rank_01'] == '' || $evouserinfo_addons['rank_show_title'] == 'no') ? '' : ($pnt_user_ranks['rank_01'].'<br />');
   $pnt_user_rank_01_img = ($pnt_user_ranks['rank_01_img'] == '') ? '' : ($pnt_user_ranks['rank_01_img'] . '<br />');

   $pnt_user_rank_02 = ($pnt_user_ranks['rank_02'] == '' || $evouserinfo_addons['rank_show_title'] == 'no') ? '' : ($pnt_user_ranks['rank_02'].'<br />');
   $pnt_user_rank_02_img = ($pnt_user_ranks['rank_02_img'] == '') ? '' : ($pnt_user_ranks['rank_02_img'] . '<br />');

   $pnt_user_rank_03 = ($pnt_user_ranks['rank_03'] == '' || $evouserinfo_addons['rank_show_title'] == 'no') ? '' : ($pnt_user_ranks['rank_03'].'<br />');
   $pnt_user_rank_03_img = ($pnt_user_ranks['rank_03_img'] == '') ? '' : ($pnt_user_ranks['rank_03_img'] . '<br />');

   $pnt_user_rank_04 = ($pnt_user_ranks['rank_04'] == '' || $evouserinfo_addons['rank_show_title'] == 'no') ? '' : ($pnt_user_ranks['rank_04'].'<br />');
   $pnt_user_rank_04_img = ($pnt_user_ranks['rank_04_img'] == '') ? '' : ($pnt_user_ranks['rank_04_img'] . '<br />');

   $pnt_user_rank_05 = ($pnt_user_ranks['rank_05'] == '' || $evouserinfo_addons['rank_show_title'] == 'no') ? '' : ($pnt_user_ranks['rank_05'].'<br />');
   $pnt_user_rank_05_img = ($pnt_user_ranks['rank_05_img'] == '') ? '' : ($pnt_user_ranks['rank_05_img'] . '<br />');
   # Mod: Multiple Ranks And Staff View v2.0.3 END

   $evouserinfo_rank  = '<div style="text-align: center">';
   $evouserinfo_rank .= $pnt_user_rank_01_img.$pnt_user_rank_01;
   
   if($evouserinfo_addons['rank_show_2nd'] == 'yes')
   $evouserinfo_rank .= $pnt_user_rank_02_img.$pnt_user_rank_02;
   
   if($evouserinfo_addons['rank_show_3rd'] == 'yes')
   $evouserinfo_rank .= $pnt_user_rank_03_img.$pnt_user_rank_03;
   
   if($evouserinfo_addons['rank_show_4th'] == 'yes')
   $evouserinfo_rank .= $pnt_user_rank_04_img.$pnt_user_rank_04;
   
   if($evouserinfo_addons['rank_show_5th'] == 'yes')
   $evouserinfo_rank .= $pnt_user_rank_05_img.$pnt_user_rank_05;
   
   $evouserinfo_rank .= '</div>';
}

if(is_user()) 
evouserinfo_rank();
else 
$evouserinfo_rank = '';
?>
