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
// Administrative Statistics
//

$core->start_module(true);

$core->set_content('values');

$attachment_mod_installed = ( defined('ATTACH_VERSION') ) ? TRUE : FALSE;
$attachment_version = ($attachment_mod_installed) ? ATTACH_VERSION : '';

if ( $attachment_mod_installed )
{
    @include_once($phpbb_root_path . 'attach_mod/includes/functions_admin.'.$phpEx);
}

$sql = "SELECT COUNT(user_id) AS total
FROM " . USERS_TABLE . "
WHERE user_id <> " . ANONYMOUS;

$result = $core->sql_query($sql, 'Unable to get user count');
$row = $core->sql_fetchrow($result);

$total_users = $row['total'];

$sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total
FROM " . FORUMS_TABLE;

$result = $core->sql_query($sql, 'Unable to get topic and post count');
$row = $core->sql_fetchrow($result);

$total_posts = $row['post_total'];
$total_topics = $row['topic_total'];

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
$sql = "SELECT user_id, user_color_gc, username
FROM " . USERS_TABLE . "
WHERE user_id <> " . ANONYMOUS . "
ORDER BY user_id DESC
LIMIT 1";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

$result = $core->sql_query($sql, 'Unable to get newest user data');
$newest_userdata = $core->sql_fetchrow($result);

$start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);

$boarddays = max(1, round( ( time() - $board_config['board_startdate'] ) / 86400 ));

$posts_per_day = sprintf('%.2f', $total_posts / $boarddays);
$topics_per_day = sprintf('%.2f', $total_topics / $boarddays);
$users_per_day = sprintf('%.2f', $total_users / $boarddays);

$avatar_dir_size = 0;

if ($avatar_dir = @opendir($board_config['avatar_path']))
{
    while( $file = @readdir($avatar_dir) )
    {
        if( $file != '.' && $file != '..' )
        {
            $avatar_dir_size += @filesize($board_config['avatar_path'] . '/' . $file);
        }
    }
    @closedir($avatar_dir);

    //
    // This bit of code translates the avatar directory size into human readable format
    // Borrowed the code from the PHP.net annoted manual, origanally written by:
    // Jesse (jesse@jess.on.ca)
    //
    if (!$attachment_mod_installed)
    {
        if($avatar_dir_size >= 1048576)
        {
            $avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . ' MB';
        }
        else if($avatar_dir_size >= 1024)
        {
            $avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . ' KB';
        }
        else
        {
            $avatar_dir_size = $avatar_dir_size . ' Bytes';
        }
    }
    else
    {
        if($avatar_dir_size >= 1048576)
        {
            $avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . ' ' . $lang['MB'];
        }
        else if($avatar_dir_size >= 1024)
        {
            $avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . ' ' . $lang['KB'];
        }
        else
        {
            $avatar_dir_size = $avatar_dir_size . ' ' . $lang['Bytes'];
        }
    }

}
else
{
    $avatar_dir_size = $lang['Not_available'];
}

if ($posts_per_day > $total_posts)
{
    $posts_per_day = $total_posts;
}

if ($topics_per_day > $total_topics)
{
    $topics_per_day = $total_topics;
}

if ($users_per_day > $total_users)
{
    $users_per_day = $total_users;
}

//
// DB size ... MySQL only
//
// This code is heavily influenced by a similar routine
// in phpMyAdmin 2.2.0
//
$dbsize = 0;

if( preg_match("/^mysql/", SQL_LAYER) )
{
    $sql = "SELECT VERSION() AS mysql_version";
    if ($result = $db->sql_query($sql))
    {
        $row = $db->sql_fetchrow($result);
        $version = $row['mysql_version'];

        if( preg_match("/^(3\.23|4\.)/", $version) )
        {
            $db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)/", $version) ) ? "`$dbname`" : $dbname;

            $sql = "SHOW TABLE STATUS
            FROM " . $db_name;
            if($result = $db->sql_query($sql))
            {
                $tabledata_ary = $db->sql_fetchrowset($result);

                $dbsize = 0;
                for($i = 0; $i < count($tabledata_ary); $i++)
                {
                    if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
                    {
                        if( $table_prefix != "" )
                        {
                            if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
                            {
                                $dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                            }
                        }
                        else
                        {
                            $dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                        }
                    }
                }
            }
        }
    }
}

$dbsize = intval($dbsize);

if ($dbsize != 0)
{
    if ($attachment_mod_installed)
    {
        if( $dbsize >= 1048576 )
        {
            $dbsize = sprintf('%.2f ' . $lang['MB'], ( $dbsize / 1048576 ));
        }
        else if( $dbsize >= 1024 )
        {
            $dbsize = sprintf('%.2f ' . $lang['KB'], ( $dbsize / 1024 ));
        }
        else
        {
            $dbsize = sprintf('%.2f ' . $lang['Bytes'], $dbsize);
        }
    }
    else
    {
        if( $dbsize >= 1048576 )
        {
            $dbsize = sprintf('%.2f MB', ( $dbsize / 1048576 ));
        }
        else if( $dbsize >= 1024 )
        {
            $dbsize = sprintf('%.2f KB', ( $dbsize / 1024 ));
        }
        else
        {
            $dbsize = sprintf('%.2f Bytes', $dbsize);
        }
    }
}
else
{
    $dbsize = $lang['Not_available'];
}

//
// Newest user data
//
$newest_user = $newest_userdata['username'];
$newest_uid = $newest_userdata['user_id'];

$sql = 'SELECT user_regdate
FROM ' . USERS_TABLE . '
WHERE user_id = ' . $newest_uid . '
LIMIT 1';

$result = $core->sql_query($sql, 'Couldn\'t retrieve users data');
$row = $core->sql_fetchrow($result);
$newest_user_date = $row['user_regdate'];

//
// Most Online data
//
$sql = "SELECT *
FROM " . CONFIG_TABLE . "
WHERE config_name = 'record_online_users' OR config_name = 'record_online_date'";

$result = $core->sql_query($sql, 'Couldn\'t retrieve configuration data');

$row = $core->sql_fetchrowset($result);
$most_users_date = $lang['Not_available'];
$most_users = $lang['Not_available'];

for ($i = 0; $i < count($row); $i++)
{
    if ( (intval($row[$i]['config_value']) > 0) && ($row[$i]['config_name'] == 'record_online_date') )
    {
        $most_users_date = create_date($board_config['default_dateformat'], intval($row[$i]['config_value']), $board_config['board_timezone']);
    }
    else if ( (intval($row[$i]['config_value']) > 0) && ($row[$i]['config_name'] == 'record_online_users') )
    {
        $most_users = intval($row[$i]['config_value']);
    }
}

$statistic_array = array($lang['Number_posts'], $lang['Posts_per_day'], $lang['Number_topics'], $lang['Topics_per_day'], $lang['Number_users'], $lang['Users_per_day'], $lang['Board_started'], $lang['Board_Up_Days'], $lang['Database_size'], $lang['Avatar_dir_size'], $lang['Latest_Reg_User_Date'], $lang['Latest_Reg_User'], $lang['Most_Ever_Online_Date'], $lang['Most_Ever_Online'], $lang['Gzip_compression']);

$value_array = array($total_posts, $posts_per_day, $total_topics, $topics_per_day, $total_users, $users_per_day, $start_date, sprintf('%.2f', $boarddays), $dbsize, $avatar_dir_size, $newest_user_date, sprintf('<a href="' . append_sid('profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $newest_uid) . '">' . $newest_user . '</a>'), $most_users_date, $most_users, ( $board_config['gzip_compress'] ) ? $lang['Enabled'] : $lang['Disabled']);

//
// Disk Usage, if Attachment Mod is installed
//
if ( $attachment_mod_installed )
{
    $disk_usage = get_formatted_dirsize();

    $statistic_array[] = $lang['Disk_usage'];
    $value_array[] = $disk_usage;
}

$core->set_view('columns', 2);
$core->set_view('num_blocks', 2);
$core->set_view('value_order', 'left_right');
//$core->set_view('value_order', 'up_down');

$core->define_view('set_columns', array(
    'stats' => $lang['Statistic'],
    'value' => $lang['Value'])
);

$core->set_header($lang['module_name']);

$data = $core->assign_defined_view('value_array', array($statistic_array, $value_array));

$core->set_data($data);

$core->define_view('iterate_values', array());

$core->run_module();

?>