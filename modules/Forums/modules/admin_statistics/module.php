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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
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
    @include_once($phpbb2_root_path . 'attach_mod/includes/functions_admin.'.$phpEx);
}

$sql = "SELECT COUNT(user_id) AS total
FROM " . USERS_TABLE . "
WHERE user_id <> " . ANONYMOUS;

$result = $core->sql_query($sql, 'Unable to get user count');
$row = $core->sql_fetchrow($result);

$phpbb2_total_users = $row['total'];

$sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total
FROM " . FORUMS_TABLE;

$result = $core->sql_query($sql, 'Unable to get topic and post count');
$row = $core->sql_fetchrow($result);

$phpbb2_total_posts = $row['post_total'];
$total_phpbb2_topics = $row['topic_total'];

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
$phpbb2_newest_userdata = $core->sql_fetchrow($result);

$phpbb2_start_date = create_date($phpbb2_board_config['default_dateformat'], $phpbb2_board_config['board_startdate'], $phpbb2_board_config['board_timezone']);

$boarddays = max(1, round( ( time() - $phpbb2_board_config['board_startdate'] ) / 86400 ));

$phpbb2_posts_per_day = sprintf('%.2f', $phpbb2_total_posts / $boarddays);
$phpbb2_topics_per_day = sprintf('%.2f', $total_phpbb2_topics / $boarddays);
$titanium_users_per_day = sprintf('%.2f', $phpbb2_total_users / $boarddays);

$avatar_dir_size = 0;

if ($avatar_dir = @opendir($phpbb2_board_config['avatar_path']))
{
    while( $file = @readdir($avatar_dir) )
    {
        if( $file != '.' && $file != '..' )
        {
            $avatar_dir_size += @filesize($phpbb2_board_config['avatar_path'] . '/' . $file);
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
            $avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . ' ' . $titanium_lang['MB'];
        }
        else if($avatar_dir_size >= 1024)
        {
            $avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . ' ' . $titanium_lang['KB'];
        }
        else
        {
            $avatar_dir_size = $avatar_dir_size . ' ' . $titanium_lang['Bytes'];
        }
    }

}
else
{
    $avatar_dir_size = $titanium_lang['Not_available'];
}

if ($phpbb2_posts_per_day > $phpbb2_total_posts)
{
    $phpbb2_posts_per_day = $phpbb2_total_posts;
}

if ($phpbb2_topics_per_day > $total_phpbb2_topics)
{
    $phpbb2_topics_per_day = $total_phpbb2_topics;
}

if ($titanium_users_per_day > $phpbb2_total_users)
{
    $titanium_users_per_day = $phpbb2_total_users;
}

//
// DB size ... MySQL only
//
// This code is heavily influenced by a similar routine
// in phpMyAdmin 2.2.0
//
$titanium_dbsize = 0;

if( preg_match("/^mysql/", SQL_LAYER) )
{
    $sql = "SELECT VERSION() AS mysql_version";
    if ($result = $titanium_db->sql_query($sql))
    {
        $row = $titanium_db->sql_fetchrow($result);
        $version = $row['mysql_version'];

        if( preg_match("/^(3\.23|4\.)/", $version) )
        {
            $titanium_db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)/", $version) ) ? "`$titanium_dbname`" : $titanium_dbname;

            $sql = "SHOW TABLE STATUS
            FROM " . $titanium_db_name;
            if($result = $titanium_db->sql_query($sql))
            {
                $tabledata_ary = $titanium_db->sql_fetchrowset($result);

                $titanium_dbsize = 0;
                for($i = 0; $i < count($tabledata_ary); $i++)
                {
                    if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
                    {
                        if( $table_prefix != "" )
                        {
                            if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
                            {
                                $titanium_dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                            }
                        }
                        else
                        {
                            $titanium_dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                        }
                    }
                }
            }
        }
    }
}

$titanium_dbsize = intval($titanium_dbsize);

if ($titanium_dbsize != 0)
{
    if ($attachment_mod_installed)
    {
        if( $titanium_dbsize >= 1048576 )
        {
            $titanium_dbsize = sprintf('%.2f ' . $titanium_lang['MB'], ( $titanium_dbsize / 1048576 ));
        }
        else if( $titanium_dbsize >= 1024 )
        {
            $titanium_dbsize = sprintf('%.2f ' . $titanium_lang['KB'], ( $titanium_dbsize / 1024 ));
        }
        else
        {
            $titanium_dbsize = sprintf('%.2f ' . $titanium_lang['Bytes'], $titanium_dbsize);
        }
    }
    else
    {
        if( $titanium_dbsize >= 1048576 )
        {
            $titanium_dbsize = sprintf('%.2f MB', ( $titanium_dbsize / 1048576 ));
        }
        else if( $titanium_dbsize >= 1024 )
        {
            $titanium_dbsize = sprintf('%.2f KB', ( $titanium_dbsize / 1024 ));
        }
        else
        {
            $titanium_dbsize = sprintf('%.2f Bytes', $titanium_dbsize);
        }
    }
}
else
{
    $titanium_dbsize = $titanium_lang['Not_available'];
}

//
// Newest user data
//
$phpbb2_newest_user = $phpbb2_newest_userdata['username'];
$phpbb2_newest_uid = $phpbb2_newest_userdata['user_id'];

$sql = 'SELECT user_regdate
FROM ' . USERS_TABLE . '
WHERE user_id = ' . $phpbb2_newest_uid . '
LIMIT 1';

$result = $core->sql_query($sql, 'Couldn\'t retrieve users data');
$row = $core->sql_fetchrow($result);
$phpbb2_newest_user_date = $row['user_regdate'];

//
// Most Online data
//
$sql = "SELECT *
FROM " . CONFIG_TABLE . "
WHERE config_name = 'record_online_users' OR config_name = 'record_online_date'";

$result = $core->sql_query($sql, 'Couldn\'t retrieve configuration data');

$row = $core->sql_fetchrowset($result);
$most_users_date = $titanium_lang['Not_available'];
$most_users = $titanium_lang['Not_available'];

for ($i = 0; $i < count($row); $i++)
{
    if ( (intval($row[$i]['config_value']) > 0) && ($row[$i]['config_name'] == 'record_online_date') )
    {
        $most_users_date = create_date($phpbb2_board_config['default_dateformat'], intval($row[$i]['config_value']), $phpbb2_board_config['board_timezone']);
    }
    else if ( (intval($row[$i]['config_value']) > 0) && ($row[$i]['config_name'] == 'record_online_users') )
    {
        $most_users = intval($row[$i]['config_value']);
    }
}

$statistic_array = array($titanium_lang['Number_posts'], $titanium_lang['Posts_per_day'], $titanium_lang['Number_topics'], $titanium_lang['Topics_per_day'], $titanium_lang['Number_users'], $titanium_lang['Users_per_day'], $titanium_lang['Board_started'], $titanium_lang['Board_Up_Days'], $titanium_lang['Database_size'], $titanium_lang['Avatar_dir_size'], $titanium_lang['Latest_Reg_User_Date'], $titanium_lang['Latest_Reg_User'], $titanium_lang['Most_Ever_Online_Date'], $titanium_lang['Most_Ever_Online'], $titanium_lang['Gzip_compression']);

$value_array = array($phpbb2_total_posts, $phpbb2_posts_per_day, $total_phpbb2_topics, $phpbb2_topics_per_day, $phpbb2_total_users, $titanium_users_per_day, $phpbb2_start_date, sprintf('%.2f', $boarddays), $titanium_dbsize, $avatar_dir_size, $phpbb2_newest_user_date, sprintf('<a href="' . append_titanium_sid('profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $phpbb2_newest_uid) . '">' . $phpbb2_newest_user . '</a>'), $most_users_date, $most_users, ( $phpbb2_board_config['gzip_compress'] ) ? $titanium_lang['Enabled'] : $titanium_lang['Disabled']);

//
// Disk Usage, if Attachment Mod is installed
//
if ( $attachment_mod_installed )
{
    $disk_usage = get_formatted_dirsize();

    $statistic_array[] = $titanium_lang['Disk_usage'];
    $value_array[] = $disk_usage;
}

$core->set_view('columns', 2);
$core->set_view('num_blocks', 2);
$core->set_view('value_order', 'left_right');
//$core->set_view('value_order', 'up_down');

$core->define_view('set_columns', array(
    'stats' => $titanium_lang['Statistic'],
    'value' => $titanium_lang['Value'])
);

$core->set_header($titanium_lang['module_name']);

$data = $core->assign_defined_view('value_array', array($statistic_array, $value_array));

$core->set_data($data);

$core->define_view('iterate_values', array());

$core->run_module();

?>