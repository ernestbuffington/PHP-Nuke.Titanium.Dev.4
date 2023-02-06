<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                             (admin) index.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: index.php,v 1.40.2.7 2005/02/21 18:37:02 acydburn Exp
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/24/2005
-=[Mod]=-
      Recent Topics                            v1.2.4       06/11/2005
      Cache phpBB version in ACP               v1.0.0       06/15/2005
      Staff Site                               v2.0.3       06/24/2005
      Better Session Handling                  v1.0.0       06/25/2005
      Forum ACP Administration Links           v1.0.0       06/26/2005
      Advanced Username Color                  v1.0.5       07/25/2005
      DHTML Slide Menu for ACP                 v1.0.0       07/30/2005
      Advance Admin Index Stats                v1.0.0       08/02/2005
      Log Moderator Actions                    v1.1.6       08/06/2005
      Online Time                              v1.0.0       08/21/2005
      Admin IP Lock                            v2.0.1       11/17/2005
	  Arcade                                   v3.0.2       05/29/2009
 ************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
include(NUKE_BASE_DIR.'includes/functions_log.php');
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
// Begin functions
function inarray($needle, $haystack)
{
    for($i = 0; $i < count($haystack); $i++ )
    {
            if( $haystack[$i] == $needle )
            {
                    return true;
            }
    }
    return false;
}
/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
    $q = "SELECT forum_id, forum_name
          FROM ". FORUMS_TABLE ."";
    $forums_data = $db->sql_ufetchrowset($q);

    $q = "SELECT username, user_id
          FROM ". USERS_TABLE ."";
    $users_data = $db->sql_ufetchrowset($q);

    $q = "SELECT topic_id, topic_title
          FROM ". TOPICS_TABLE ."";
    $topics_data = $db->sql_ufetchrowset($q);

    $q = "SELECT cat_id, cat_title
          FROM ". CATEGORIES_TABLE ."";
    $cats_data = $db->sql_ufetchrowset($q);
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
//
// End functions
// -------------

//
// Generate relevant output
//
if( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'left' )
{

    $dir = opendir(".");

    $setmodules = 1;
    while( $file = readdir($dir) )
    {
        if( preg_match("/^admin_.*?\." . $phpEx . "$/", $file) )
        {
            include('./' . $file);
        }
    }

    closedir($dir);

    unset($setmodules);

        include('./page_header_admin.'.$phpEx);

        $template->set_filenames(array(
                "body" => "admin/index_navigate.tpl")
        );

        $template->assign_vars(array(
                "U_FORUM_INDEX" => append_sid("index.$phpEx"),
                "U_FORUM_PREINDEX" => append_sid("index.$phpEx"),
                "U_ADMIN_INDEX" => append_sid("index.$phpEx?pane=right"),

/*****[BEGIN]******************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/
                "COOKIE_NAME"    => $board_config['cookie_name'],
                "COOKIE_PATH"    => $board_config['cookie_path'],
                "COOKIE_DOMAIN"    => $board_config['cookie_domain'],
                "COOKIE_SECURE"    => $board_config['cookie_secure'],
/*****[END]********************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/
                "U_ADMIN_NUKE" => ADMIN_NUKE,
                "U_HOME_NUKE" => HOME_NUKE,
/*****[END]********************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/

                "L_FORUM_INDEX" => $lang['Main_index'],
                "L_ADMIN_INDEX" => $lang['Admin_Index'],
                "L_PREVIEW_FORUM" => $lang['Preview_forum'],
/*****[BEGIN]******************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/
                "L_ADMIN_NUKE" => $lang['Admin_Nuke'],
                "L_HOME_NUKE" => $lang['Home_Nuke'],)
/*****[END]********************************************
 [ Mod:     Forum ACP Administration Links     v1.0.0 ]
 ******************************************************/

        );

        ksort($module);

/*****[BEGIN]******************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/
    $menu_cat_id = 0;
/*****[END]********************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/
//while( list($cat, $action_array) = each($module) )
foreach ($module as $cat => $action_array)
{
    $cat = ( !empty($lang[$cat]) ) ? $lang[$cat] : preg_replace("/_/", " ", $cat);

    $template->assign_block_vars("catrow", array(

/*****[BEGIN]******************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/
                    "MENU_CAT_ID" => $menu_cat_id,
                    "MENU_CAT_ROWS" => count($action_array),
/*****[END]********************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/

                     "ADMIN_CATEGORY" => $cat)
    );

    ksort($action_array);

    $row_count = 0;
    //while( list($action, $file)   = each($action_array) )
	foreach ($action_array as $action => $file)
    {
        $row_color = ( !($row_count%2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($row_count%2) ) ? $theme['td_class1'] : $theme['td_class2'];

        $action = ( !empty($lang[$action]) ) ? $lang[$action] : preg_replace("/_/", " ", $action);

        $template->assign_block_vars("catrow.modulerow", array(

/*****[BEGIN]******************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/
            "ROW_COUNT" => $row_count,
/*****[END]********************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/

             "ROW_COLOR" => "#" . $row_color,
            "ROW_CLASS" => $row_class,

            "ADMIN_MODULE" => $action,
            "U_ADMIN_MODULE" => append_sid($file))
        );
        $row_count++;
    }
/*****[BEGIN]******************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/
    $menu_cat_id++;
/*****[END]********************************************
 [ Mod:     DHTML Slide Menu for ACP           v1.0.0 ]
 ******************************************************/
}
        $template->pparse("body");

        include('./page_footer_admin.'.$phpEx);
}
elseif( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'right' )
{
        include('./page_header_admin.'.$phpEx);

        $template->set_filenames(array(
                "body" => "admin/index_body.tpl")
        );
/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
        $admin_ip_lock_img = '';
        if(defined('ADMIN_IP_LOCK')) {
            $admin_ip_lock = $lang['ADMIN_IP_LOCK_ON'];
            // $admin_ip_lock_img = '../../../images/thumb_up.png';
        } else {
            $admin_ip_lock = $lang['ADMIN_IP_LOCK_OFF'];
            // $admin_ip_lock_img = '../../../images/thumb_down.png';
        }
/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
        $template->assign_vars(array(
                "L_WELCOME" => $lang['Welcome_phpBB'],
                "L_ADMIN_INTRO" => $lang['Admin_intro'],
                "L_FORUM_STATS" => $lang['Forum_stats'],
                "L_WHO_IS_ONLINE" => $lang['Who_is_Online'],
                "L_USERNAME" => $lang['Username'],
                "L_LOCATION" => $lang['Location'],
                "L_LAST_UPDATE" => $lang['Last_updated'],
                "L_IP_ADDRESS" => $lang['IP_Address'],
                "L_STATISTIC" => $lang['Statistic'],
                "L_VALUE" => $lang['Value'],
                "L_NUMBER_POSTS" => $lang['Number_posts'],
                "L_POSTS_PER_DAY" => $lang['Posts_per_day'],
                "L_NUMBER_TOPICS" => $lang['Number_topics'],
                "L_TOPICS_PER_DAY" => $lang['Topics_per_day'],
                "L_NUMBER_USERS" => $lang['Number_users'],
                "L_USERS_PER_DAY" => $lang['Users_per_day'],
                "L_BOARD_STARTED" => $lang['Board_started'],
                "L_AVATAR_DIR_SIZE" => $lang['Avatar_dir_size'],
                "L_DB_SIZE" => $lang['Database_size'],
                "L_FORUM_LOCATION" => $lang['Forum_Location'],
                "L_STARTED" => $lang['Login'],
/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
                "L_NUMBER_DEACTIVATED_USERS" => $lang['Thereof_deactivated_users'],
                "L_NAME_DEACTIVATED_USERS" => $lang['Deactivated_Users'],
                "L_NUMBER_MODERATORS" => $lang['Thereof_Moderators'],
                "L_NAME_MODERATORS" => $lang['Users_with_Mod_Privileges'],
                "L_NUMBER_ADMINISTRATORS" => $lang['Thereof_Administrators'],
                "L_NAME_ADMINISTRATORS" => $lang['Users_with_Admin_Privileges'],
                "L_DB_SIZE" => $lang['DB_size'],
                "L_PHPBB_VERSION" => $lang['Version_of_board'],
                "L_PHP_VERSION" => $lang['Version_of_PHP'],
                "L_MYSQL_VERSION" => $lang['Version_of_MySQL'],
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
                "L_ADMIN_IP_LOCK" => $lang['ADMIN_IP_LOCK'],
                "ADMIN_IP_LOCK_IMAGE" => $admin_ip_lock_img,
                "ADMIN_IP_LOCK_ED" => $admin_ip_lock,
/*****[END]********************************************
 [ Mod:    Admin IP Lock                       v2.0.1 ]
 ******************************************************/
                 "L_GZIP_COMPRESSION" => $lang['Gzip_compression'])

        );

        //
        // Get forum statistics
        //
        $total_posts = get_db_stat('postcount');
        $total_users = get_db_stat('usercount');
        $total_topics = get_db_stat('topiccount');
/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
$sql = "SELECT COUNT(user_id) AS total
                    FROM " . USERS_TABLE . "
                    WHERE user_active = 0
                        AND user_id <> " . ANONYMOUS;
            if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR,"Couldn't get statistic data!", __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result) )
            {
                    $total_deactivated_users = $row['total'];
            }
            else
            {
                    message_die(GENERAL_ERROR,"Couldn't update pending information!", __LINE__, __FILE__, $sql);
            }
                $db->sql_freeresult($result);
                $deactivated_names = '';
            $sql = "SELECT username
                    FROM " . USERS_TABLE . "
                    WHERE user_active = 0
                        AND user_id <> " . ANONYMOUS . "
                    ORDER BY username";
            if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR,"Couldn't get statistic data!", __LINE__, __FILE__, $sql);
            }
            
			while ( $row = $db->sql_fetchrow($result) )
            {
                    $deactivated_names .= (($deactivated_names == '') ? '' : ', ') . UsernameColor($row['username']);
            }
                $db->sql_freeresult($result);
                $sql = "SELECT COUNT(user_id) AS total
                    FROM " . USERS_TABLE . "
                    WHERE user_level = " . MOD . "
                        AND user_id <> " . ANONYMOUS;
            if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR,"Couldn't get statistic data!", __LINE__, __FILE__, $sql);
            }
            if ( $row = $db->sql_fetchrow($result) )
            {
                    $total_moderators = $row['total'];
            }
            else
            {
                    message_die(GENERAL_ERROR,"Couldn't update pending information!", __LINE__, __FILE__, $sql);
            }
                $db->sql_freeresult($result);
                $moderator_names = '';
                $sql = "SELECT username
                    FROM " . USERS_TABLE . "
                    WHERE user_level = " . MOD . "
                        AND user_id <> " . ANONYMOUS . "
                    ORDER BY username";
                if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR,"Couldn't get statistic data!", __LINE__, __FILE__, $sql);
            }
                while ( $row = $db->sql_fetchrow($result) )
            {
                    $moderator_names .= (($moderator_names == '') ? '' : ', ') . UsernameColor($row['username']);
            }
                $db->sql_freeresult($result);
$sql = "SELECT COUNT(user_id) AS total
                    FROM " . USERS_TABLE . "
                    WHERE user_level = " . ADMIN . "
                        AND user_id <> " . ANONYMOUS;
                if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR,"Couldn't get statistic data!", __LINE__, __FILE__, $sql);
            }
                if ( $row = $db->sql_fetchrow($result) )
            {
                    $total_administrators = $row['total'];
            }
                else
            {
                    message_die(GENERAL_ERROR,"Couldn't update pending information!", __LINE__, __FILE__, $sql);
            }
                $db->sql_freeresult($result);
                $administrator_names = '';
            $sql = "SELECT username
                    FROM " . USERS_TABLE . "
                    WHERE user_level = " . ADMIN . "
                        AND user_id <> " . ANONYMOUS . "
                    ORDER BY username";
                if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR,"Couldn't get statistic data!", __LINE__, __FILE__, $sql);
            }
                while ( $row = $db->sql_fetchrow($result) )
            {
                    $administrator_names .= (($administrator_names == '') ? '' : ', ') . UsernameColor($row['username']);
            }
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
        global $board_config;
		
		if(empty($board_config['board_startdate']))
        $board_config['board_startdate'] = '1672571760';

        $start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);
		$boarddays = ( time() - $board_config['board_startdate'] ) / 86400;

        $posts_per_day = sprintf("%.2f", $total_posts / $boarddays);
        $topics_per_day = sprintf("%.2f", $total_topics / $boarddays);
        $users_per_day = sprintf("%.2f", $total_users / $boarddays);

        $avatar_dir_size = 0;

        if ($avatar_dir = opendir(NUKE_BASE_DIR . $board_config['avatar_path']))
        {
                while( $file = readdir($avatar_dir) )
                {
                        if( $file != "." && $file != ".." )
                        {
                                $avatar_dir_size += filesize(NUKE_BASE_DIR . $board_config['avatar_path'] . "/" . $file);
                        }
                }
                closedir($avatar_dir);

                /*
                 * This bit of code translates the avatar directory size into human readable format
                 * Borrowed the code from the PHP.net annoted manual, origanally written by:
                 * Jesse (jesse@jess.on.ca)
                 */
                if($avatar_dir_size >= 1048576)
                {
                  $avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . " MB";
                }
                else if($avatar_dir_size >= 1024)
                {
                  $avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . " KB";
                }
                else
                {
                  $avatar_dir_size = $avatar_dir_size . " Bytes";
                }

        }
        else
        {
                // Couldn't open Avatar dir.
                $avatar_dir_size = $lang['Not_available'];
        }

        if($posts_per_day > $total_posts)
        {
                $posts_per_day = $total_posts;
        }

        if($topics_per_day > $total_topics)
        {
                $topics_per_day = $total_topics;
        }

        if($users_per_day > $total_users)
        {
                $users_per_day = $total_users;
        }

        /*
         * DB size ... MySQL only
         *
         * This code is heavily influenced by a similar routine
         * in phpMyAdmin 2.2.0
         */
        if( preg_match("/^mysql/", SQL_LAYER) )
        {
                $sql = "SELECT VERSION() AS mysql_version";
                if($result = $db->sql_query($sql))
                {
                        $row = $db->sql_fetchrow($result);
                        $version = $row['mysql_version'];

                        if( preg_match("/^(3\.23|4\.|5\.)/", $version) )
                        {
                                $db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)|(5\.)/", $version) ) ? "`$dbname`" : $dbname;

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
                                } // Else we couldn't get the table status.
                        }
                        else
                        {
                                $dbsize = $lang['Not_available'];
                        }
                }
                else
                {
                        $dbsize = $lang['Not_available'];
                }
        }
        else if( preg_match("/^mssql/", SQL_LAYER) )
        {
                $sql = "SELECT ((SUM(size) * 8.0) * 1024.0) as dbsize
                        FROM sysfiles";
                if( $result = $db->sql_query($sql) )
                {
                        $dbsize = ( $row = $db->sql_fetchrow($result) ) ? intval($row['dbsize']) : $lang['Not_available'];
                }
                else
                {
                        $dbsize = $lang['Not_available'];
                }
        }
        else
        {
                $dbsize = $lang['Not_available'];
        }

        if ( is_integer($dbsize) )
        {
                if( $dbsize >= 1048576 )
                {
                        $dbsize = sprintf("%.2f MB", ( $dbsize / 1048576 ));
                }
                else if( $dbsize >= 1024 )
                {
                        $dbsize = sprintf("%.2f KB", ( $dbsize / 1024 ));
                }
                else
                {
                        $dbsize = sprintf("%.2f Bytes", $dbsize);
                }
        }
/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
$sql = "SELECT VERSION() AS mysql_version";
                $result = $db->sql_query($sql);
                if ( !$result )
            {
                    message_die(GENERAL_ERROR,"Couldn't obtain MySQL Version", __LINE__, __FILE__, $sql);
            }
                $row = $db->sql_fetchrow($result);
                $mysql_version = $row['mysql_version'];
                $db->sql_freeresult($result);
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
           $template->assign_vars(array(
                "NUMBER_OF_POSTS" => $total_posts,
                "NUMBER_OF_TOPICS" => $total_topics,
                "NUMBER_OF_USERS" => $total_users,
                "START_DATE" => $start_date,
                "POSTS_PER_DAY" => $posts_per_day,
                "TOPICS_PER_DAY" => $topics_per_day,
                "USERS_PER_DAY" => $users_per_day,
                "AVATAR_DIR_SIZE" => $avatar_dir_size,
                "DB_SIZE" => $dbsize,
/*****[BEGIN]******************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
                //"PHPBB_VERSION" => '2' . $board_config['version'],
                "PHP_VERSION" => phpversion(),
                "MYSQL_VERSION" => $mysql_version,
                "NUMBER_OF_DEACTIVATED_USERS" => $total_deactivated_users,
                "NUMBER_OF_MODERATORS" => $total_moderators,
                "NUMBER_OF_ADMINISTRATORS" => $total_administrators,
                "NAMES_OF_ADMINISTRATORS" => $administrator_names,
                "NAMES_OF_MODERATORS" => $moderator_names,
                "NAMES_OF_DEACTIVATED" => $deactivated_names,
/*****[END]********************************************
 [ Mod:    Advance Admin Index Stats           v1.0.0 ]
 ******************************************************/
                "GZIP_COMPRESSION" => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'])
        );
        //
        // End forum statistics
        //

        //
        // Get users online information.
        //
/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/
        $sql = "SELECT u.user_id, u.username, u.user_session_time, u.user_session_page, s.session_url_qs, s.session_url_ps, s.session_url_specific, s.session_logged_in, s.session_ip, s.session_start
                FROM " . USERS_TABLE . " u, " . SESSIONS_TABLE . " s
                WHERE s.session_logged_in = " . TRUE . "
                        AND u.user_id = s.session_user_id
                        AND u.user_id <> " . ANONYMOUS . "
                        AND s.session_time >= " . ( time() - $board_config['online_time'] ) . "
                ORDER BY u.user_session_time DESC";
/*****[END]********************************************
 [ Mod:    Online Time                         v1.0.0 ]
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
        $onlinerow_reg = $db->sql_ufetchrowset($sql);
/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
        $sql = "SELECT session_page, session_logged_in, session_time, session_ip, session_start, session_url_qs, session_url_ps, session_url_specific
                FROM " . SESSIONS_TABLE . "
                WHERE session_logged_in = 0
                        AND session_time >= " . ( time() - 300 ) . "
                ORDER BY session_time DESC";
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
        $onlinerow_guest = $db->sql_ufetchrowset($sql);

        $sql = "SELECT forum_name, forum_id
                FROM " . FORUMS_TABLE;
        if($forums_result = $db->sql_query($sql))
        {
                while($forumsrow = $db->sql_fetchrow($forums_result))
                {
                        $forum_data[$forumsrow['forum_id']] = $forumsrow['forum_name'];
                }
        }
        else
        {
                message_die(GENERAL_ERROR, "Couldn't obtain user/online forums information.", "", __LINE__, __FILE__, $sql);
        }

        $reg_userid_ary = array();

        if( count($onlinerow_reg) )
        {
                $registered_users = 0;

                for($i = 0; $i < count($onlinerow_reg); $i++)
                {
                        if( !inarray($onlinerow_reg[$i]['user_id'], $reg_userid_ary) )
                        {
                                $reg_userid_ary[] = $onlinerow_reg[$i]['user_id'];

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                $username = UsernameColor($onlinerow_reg[$i]['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                                if(!isset($onlinerow_reg[$i]['user_allow_viewonline']))
								$onlinerow_reg[$i]['user_allow_viewonline'] = '';
								
								if(!isset($hidden_users))
								$hidden_users = 0;
                                
								if( $onlinerow_reg[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
                                {
                                        $registered_users++;
                                        $hidden = FALSE;
                                }
                                else
                                {
                                        $hidden_users++;
                                        $hidden = TRUE;
                                }

                                if( $onlinerow_reg[$i]['user_session_page'] < 1 )
                                {
                                        switch($onlinerow_reg[$i]['user_session_page'])
                                        {
                                                case PAGE_INDEX:
                                                        $location = $lang['Forum_index'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_POSTING:
                                                        $location = $lang['Posting_message'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_LOGIN:
                                                        $location = $lang['Logging_on'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_SEARCH:
                                                        $location = $lang['Searching_forums'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_PROFILE:
                                                        $location = $lang['Viewing_profile'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_VIEWONLINE:
                                                        $location = $lang['Viewing_online'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_VIEWMEMBERS:
                                                        $location = $lang['Viewing_member_list'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_PRIVMSGS:
                                                        $location = $lang['Viewing_priv_msgs'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_FAQ:
                                                        $location = $lang['Viewing_FAQ'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                                                case PAGE_REPUTATION:
                                                        $location = $lang['Reputation'];
                                                        $location_url = "reputation.$phpEx";
                                                        break;
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
                                                case PAGE_GAME:
                                                        $location = $lang['Playing_game'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_ARCADES:
                                                        $location = $lang['Viewing_arcades'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_TOPARCADES:
                                                        $location = $lang['Viewing_toparcades'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_STATARCADES:
                                                        $location = $lang['watchingstats'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
                                                case PAGE_SCOREBOARD:
                                                        $location = $lang['watchingboard'];
                                                        $location_url = "index.$phpEx?pane=right";
                                                        break;
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
                                                case PAGE_STAFF:
                                                        $location = $lang['Staff'];
                                                        $location_url = "../staff.$phpEx";
                                                        break;
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
                                                case PAGE_RECENT:
                                                        $location = $lang['Recent_topics'];
                                                        $location_url = "../recent.$phpEx";
                                                        break;
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
                                                default:
                                                        $location = $lang['Forum_index'];
                                                        $location_url = "index.$phpEx?pane=right";
                                        }
                                }
                                else
                                {
                                        $location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_reg[$i]['user_session_page']);
                                        $location = $forum_data[$onlinerow_reg[$i]['user_session_page']];
                                }
/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
                                if(!isset($onlinerow_reg[$i]['session_page']))
								$onlinerow_reg[$i]['session_page'] = '';

								$BSH = select_session_url($onlinerow_reg[$i]['session_page'], $onlinerow_reg[$i]['session_url_qs'], $onlinerow_reg[$i]['session_url_ps'], $onlinerow_reg[$i]['session_url_specific'], $userdata['user_level'], $onlinerow_reg[$i]['user_id'], $forums_data, $topics_data, $users_data, $cats_data);
                                $location = $BSH;
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

                                $row_color = ( $registered_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
                                $row_class = ( $registered_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

                                $reg_ip = decode_ip($onlinerow_reg[$i]['session_ip']);

                                $template->assign_block_vars("reg_user_row", array(
                                        "ROW_COLOR" => "#" . $row_color,
                                        "ROW_CLASS" => $row_class,
                                        "USERNAME" => $username,
                                        "STARTED" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['session_start'], $board_config['board_timezone']),
                                        "LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['user_session_time'], $board_config['board_timezone']),
                                        "FORUM_LOCATION" => $location,
                                        "IP_ADDRESS" => $reg_ip,

                                        "U_WHOIS_IP" => "http://dnsstuff.com/tools/whois.ch?cache=off&ip=$reg_ip",
                                        "U_USER_PROFILE" => append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $onlinerow_reg[$i]['user_id']),
                                        "U_FORUM_LOCATION" => append_sid($location_url))
                                );
                        }
                }

        }
        else
        {
                $template->assign_vars(array(
                        "L_NO_REGISTERED_USERS_BROWSING" => $lang['No_users_browsing'])
                );
        }

        //
        // Guest users
        //
        $onlinerow_guest = array();
        if( count($onlinerow_guest) )
        {
                $guest_users = 0;

                for($i = 0; $i < count($onlinerow_guest); $i++)
                {
                        $guest_userip_ary[] = $onlinerow_guest[$i]['session_ip'];
                        $guest_users++;

                        if( $onlinerow_guest[$i]['session_page'] < 1 )
                        {
                                switch( $onlinerow_guest[$i]['session_page'] )
                                {
                                        case PAGE_INDEX:
                                                $location = $lang['Forum_index'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_POSTING:
                                                $location = $lang['Posting_message'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_LOGIN:
                                                $location = $lang['Logging_on'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_SEARCH:
                                                $location = $lang['Searching_forums'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_PROFILE:
                                                $location = $lang['Viewing_profile'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_VIEWONLINE:
                                                $location = $lang['Viewing_online'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_VIEWMEMBERS:
                                                $location = $lang['Viewing_member_list'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_PRIVMSGS:
                                                $location = $lang['Viewing_priv_msgs'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_FAQ:
                                                $location = $lang['Viewing_FAQ'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
                                        case PAGE_REPUTATION:
                                                $location = $lang['Reputation'];
                                                $location_url = "reputation.$phpEx";
                                                break;
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
                                        case PAGE_GAME:
                                                $location = $lang['Playing_game'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_ARCADES:
                                                $location = $lang['Viewing_arcades'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_TOPARCADES:
                                                $location = $lang['Viewing_toparcades'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_STATARCADES:
                                                $location = $lang['watchingstats'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
                                        case PAGE_SCOREBOARD:
                                                $location = $lang['watchingboard'];
                                                $location_url = "index.$phpEx?pane=right";
                                                break;
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
                                        case PAGE_STAFF:
                                                $location = $lang['Staff'];
                                                $location_url = "../staff.$phpEx";
                                                break;
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
                                        case PAGE_RECENT:
                                                $location = $lang['Recent_topics'];
                                                $location_url = "../recent.$phpEx";
                                                break;
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
                                        default:
                                                $location = $lang['Forum_index'];
                                                $location_url = "index.$phpEx?pane=right";
                                }
                        }
                        else
                        {
                                $location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_guest[$i]['session_page']);
                                $location = $forum_data[$onlinerow_guest[$i]['session_page']];
                        }

/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
                        $BSH = select_session_url($onlinerow_guest[$i]['session_page'], $onlinerow_guest[$i]['session_url_qs'], $onlinerow_guest[$i]['session_url_ps'], $onlinerow_guest[$i]['session_url_specific'], $userdata['user_level'], $onlinerow_guest[$i]['user_id'], $forums_data, $topics_data, $users_data, $cats_data);
                        $location = $BSH;
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

                        $row_color = ( $guest_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
                        $row_class = ( $guest_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

                        $guest_ip = decode_ip($onlinerow_guest[$i]['session_ip']);

                        $template->assign_block_vars("guest_user_row", array(
                                "ROW_COLOR" => "#" . $row_color,
                                "ROW_CLASS" => $row_class,
                                "USERNAME" => $lang['Guest'],
                                "STARTED" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_start'], $board_config['board_timezone']),
                                "LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_time'], $board_config['board_timezone']),
                                "FORUM_LOCATION" => $location,
                                "IP_ADDRESS" => $guest_ip,

                                "U_WHOIS_IP" => "http://dnsstuff.com/tools/whois.ch?cache=off&ip=$guest_ip",
                                "U_FORUM_LOCATION" => append_sid($location_url))
                        );
                }

        }
        else
        {
                $template->assign_vars(array(
                        "L_NO_GUESTS_BROWSING" => $lang['No_users_browsing'])
                );
        }
    // Check for new version
    $current_version = explode('.', '2' . $board_config['version']);
    $minor_revision = (int) $current_version[2];

/*****[BEGIN]******************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/
    // we don't want to check at every time : do it only once a day
    define('VERSION_CHECK_DELAY', 86400);
    $now = time();
    $version_check_delay = intval($board_config['version_check_delay']);
    
	if(!isset($HTTP_GET_VARS['vchk']))
	$HTTP_GET_VARS['vchk'] = '';
	
	if ( intval($HTTP_GET_VARS['vchk']) || empty($version_check_delay) || (($version_check_delay - $now) > VERSION_CHECK_DELAY) )
    {
        if ( isset($board_config['version_check_delay']) )
        {
            $sql = 'UPDATE ' . CONFIG_TABLE . '
                        SET config_value = ' . $now . '
                        WHERE config_name = \'version_check_delay\'';
        }
        else
        {
            $sql = 'INSERT INTO ' . CONFIG_TABLE . '(config_name, config_value)
                        VALUES(\'version_check_delay\', ' . $now . ')';
        }
        $db->sql_query($sql);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('board_config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
/*****[END]********************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/

    $errno = 0;
    $errstr = $version_info = '';

    if ($fsock = fsockopen('www.php-nuke-titanium.86it.us', 80, $errno, $errstr, 10))  
    {
        fputs($fsock, "GET /versions/20x.txt HTTP/1.1\r\n");
        fputs($fsock, "HOST: www.php-nuke-titanium.86it.us\r\n");
        fputs($fsock, "Connection: close\r\n\r\n"); 

        $get_info = false;
        while (!feof($fsock))
        {
            if ($get_info)
            {
                $version_info .= fread($fsock, 1024);
            }
            else
            {
                if (fgets($fsock, 1024) == "\r\n")
                {
                    $get_info = true;
                }
            }
        }
        fclose($fsock);

        $version_info = explode("\n", $version_info);
        $latest_head_revision = (int) $version_info[0];
        $latest_minor_revision = (int) $version_info[2];
        $latest_version = (int) $version_info[0] . '.' . (int) $version_info[1] . '.' . (int) $version_info[2];

        if ($latest_head_revision == 2 && $minor_revision == $latest_minor_revision)
        {
            $version_info = '<p style="color:green">' . $lang['Version_up_to_date'] . '</p>';
        }
        else
        {
            $version_info = '<p style="color:red">' . $lang['Version_not_up_to_date'];
            $version_info .= '<br />' . sprintf($lang['Latest_version_info'], $latest_version) . ' ' . sprintf($lang['Current_version_info'], '2' . $board_config['version']) . '</p>';
        }
    }
    else
    {
        if ($errstr)
        {
            $version_info = '<p style="color:red">' . sprintf($lang['Connect_socket_error'], $errstr) . '</p>';
        }
        else
        {
            $version_info = '<p>' . $lang['Socket_functions_disabled'] . '</p>';
        }
    }

/*****[BEGIN]******************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/
    }
    else
    {
        $version_info = '<p style="color:blue">' . sprintf($lang['Current_version_info'], '2' . $board_config['version']) . '</a></p>';
    }
/*****[END]********************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/

    $version_info .= '<p>' . $lang['Mailing_list_subscribe_reminder'] . '</p>';
    $template->assign_vars(array(
        'VERSION_INFO'    => $version_info,
        'L_VERSION_INFORMATION'    => $lang['Version_information'])
    );

        $template->pparse("body");

        include('./page_footer_admin.'.$phpEx);

}
else
{
        //
        // Generate frameset
        //
        $template->set_filenames(array(
                "body" => "admin/index_frameset.tpl")
        );

        if(isset($_GET['op']) && $_GET['op'] == "Groups") {
            $mainframe = append_sid("admin_groups.".$phpEx);
        } else {
            $mainframe = append_sid("index.$phpEx?pane=right");
        }

        $template->assign_vars(array(
                "S_FRAME_NAV" => append_sid("index.$phpEx?pane=left"),
                "S_FRAME_MAIN" => $mainframe)
        );

        header ("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
        header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

        $template->pparse("body");
/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
        log_action('Accessed Forum Admin', '', '', $cookie[0], '', '');
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
        $db->sql_close();
        exit;

}

?>