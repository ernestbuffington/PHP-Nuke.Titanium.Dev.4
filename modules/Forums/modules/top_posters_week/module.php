<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

 /*****[CHANGES]**********************************************************
 -=[Mod]=-
       Advanced Username Color                  v1.0.5       08/08/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//
// Top Posting Users This Week (History Mod adaption)
//
$core->start_module(true);

$core->set_content('bars');

$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 5);

$core->define_view('set_columns', array(
    $core->pre_defined('rank'),
    'username' => $lang['Username'],
    'posts' => $lang['Posts'],
    $core->pre_defined('percent'),
    $core->pre_defined('graph'))
);

$content->percentage_sign = TRUE;

// $board_config['board_timezone']
// Use local time offset

$current_time = 0;
$minutes = array();
$hour_now = 0;
$dato = 0;
$time_today = 0;
$time_thisweek = 0;

$current_time = time();
$minutes = date('is', $current_time);
$hour_now = $current_time - (60*(intval($minutes[0]).intval($minutes[1]))) - (intval($minutes[2]).intval($minutes[3]));
$dato = date('H', $current_time);
$time_today = $hour_now - (3600 * intval($dato));
$time_thisweek = $time_today - ((date('w', $time_today)-1) * 86400);

//$l_this_day = create_date('D', $time_today, $board_config['board_timezone']);
//$l_this_week = create_date('D', $time_thisweek, $board_config['board_timezone']);
$l_this_day = date('D', $time_today);
$l_this_week = date('D', $time_thisweek);

$core->set_header($lang['module_name'] . ' [' . $l_this_week . ' - ' . $l_this_day . ']');

$core->assign_defined_view('align_rows', array(
    'left',
    'left',
    'center',
    'center',
    'left')
);

if ($time_thisweek > $time_today)
{
    $time_thisweek -= 604800;
}

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
$sql = "SELECT u.user_id, u.user_color_gc, u.username, count(u.user_id) as user_posts
FROM " . USERS_TABLE . " u, " . POSTS_TABLE . " p
WHERE (u.user_id = p.poster_id) AND (p.post_time > '" . intval($time_thisweek) . "') AND (u.user_id <> " . ANONYMOUS . ")
GROUP BY user_id, username
ORDER BY user_posts DESC
LIMIT " . $core->return_limit;
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

$result = $core->sql_query($sql, 'Couldn\'t retrieve topposters data');

$user_count = $core->sql_numrows($result);
$user_data = $core->sql_fetchrowset($result);

$total_posts_thisweek = 0;

for ($i = 0; $i < $user_count; $i++)
{
    $total_posts_thisweek += intval($user_data[$i]['user_posts']);
}

$content->init_math('user_posts', $user_data[0]['user_posts'], $total_posts_thisweek);
$core->set_data($user_data);

$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->generate_link(append_sid(\'profile.php?mode=viewprofile&amp;u=\' . $core->data(\'user_id\')), $core->data(\'username\'), \'target="_blank"\')',
    '$core->data(\'user_posts\')',
    '$core->pre_defined()',
    '$core->pre_defined()')
);

$core->run_module();

?>