<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : counter.php
   Author        : Quake (www.nuke-evolution.com)
   Version       : 2.0.0
   Date          : 5/10/2005 (dd-mm-yyyy)

   Notes         : Counter for Stats module. Tracks with thanks to the Identify Class
                   Also tracks search bots.
************************************************************************/

if(defined('COUNTER')) {
    return;
}
define('COUNTER', 1);

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
    exit('Access Denied');

global $prefix, $db, $browser, $agent;

if(!empty($agent['engine']) && $agent['engine'] == 'bot'):
    $browser = 'Bot';
elseif(!empty($agent['ua'])):
    $browser = $agent['ua'];
else:
    $browser = 'Other';
endif;

if (!empty($agent['os'])):
    $os = $agent['os'];
else:
    $os = 'Other';
endif;

$now = explode('-',date('d-m-Y-H'));
$result = $db->sql_query('UPDATE '.$prefix."_counter SET count=count+1 WHERE (var='$browser' AND type='browser') OR (var='$os' AND type='os') OR (type='total' AND var='hits')");
$db->sql_freeresult($result);

if (!$db->sql_query('UPDATE '.$prefix."_stats_hour SET hits=hits+1 WHERE (year='$now[2]') AND (month='$now[1]') AND (date='$now[0]') AND (hour='$now[3]')") || !$db->sql_affectedrows()) {
    $db->sql_query('INSERT INTO '.$prefix."_stats_hour VALUES ('$now[2]','$now[1]','$now[0]','$now[3]','1')");
}
$db->sql_freeresult($result);

?>