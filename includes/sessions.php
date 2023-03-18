<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                                sessions.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: sessions.php,v 1.58.2.14 2005/05/06 20:50:11 acydburn Exp
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
-=[Mod]=-
      Better Session Handling                  v1.0.0       06/25/2005
      Advanced Time Management                 v2.2.0       07/26/2005
      PHP Patched                              v8.2.3       03/18/2023            
 ************************************************************************/

if(!defined('NUKE_EVO')) {
   die('You can\'t access this file directly...');
}

function phpBB_whoisonline($force=FALSE)
{
    global $db, $board_config, $debugger;
    //We need only one sessions_table. So we use what we have -> nuke_sessions
    $result = $db->sql_query("SELECT * FROM `"._SESSION_TABLE."` ORDER BY `time` ASC");
    $count_sess     = 1;
    $count_hidden   = 0;
    $count_reg_user = 0;
    $count_guests   = 0;
    $whoisonline_sess           = array();
    if ($db->sql_numrows($result) > 0) {
        while($sessions_all = $db->sql_fetchrow($result)) {
            $whoisonline_sess[$count_sess]['username']  = $sessions_all['uname'];
            $whoisonline_sess[$count_sess]['hostaddr']  = $sessions_all['host_addr'];
            switch($sessions_all['guest']) {
                case 0: $whoisonline_sess[$count_sess]['usertyp'] = _REGISTERED;    break;
                case 1: $whoisonline_sess[$count_sess]['usertyp'] = _GUESTS;        break;
                case 2: $whoisonline_sess[$count_sess]['usertyp'] = _REGISTERED;    break;
                case 3: $whoisonline_sess[$count_sess]['usertyp'] = _BOT;           break;
            }
            $whoisonline_sess[$count_sess]['guest']     = $sessions_all['guest'];
            $whoisonline_sess[$count_sess]['starttime'] = ($sessions_all['starttime'] > 0) ? $sessions_all['starttime'] : $sessions_all['time'];
            $whoisonline_sess[$count_sess]['lastupd']   = $sessions_all['time'];
            $whoisonline_sess[$count_sess]['url']       = $sessions_all['url'];
            $whoisonline_sess[$count_sess]['module']    = $sessions_all['module'];
            $whoisonline_sess[$count_sess]['isactive']  = (($sessions_all['time'] - $board_config['online_time']) < time()) ? TRUE : FALSE;
            if ($whoisonline_sess[$count_sess]['isactive'] == TRUE) {
                $whoisonline_sess[$count_sess]['active_time'] = time() - $whoisonline_sess[$count_sess]['starttime'];
            }
            $whoisonline_sess[$count_sess]['starttime_date']    = formatTimestamp($whoisonline_sess[$count_sess]['starttime']);
            $whoisonline_sess[$count_sess]['lastupd_date']      = formatTimestamp($sessions_all['time']);
            if ($sessions_all['guest'] == 0 || $sessions_all['guest'] == 2) {
                $whoisonline_sess[$count_sess]['username_color']    = UsernameColor($sessions_all['uname']);
                $whoisonline_sess[$count_sess]['is_hidden']         = get_user_field('user_allow_viewonline', $sessions_all['uname'], TRUE);
                $whoisonline_sess[$count_sess]['user_id']           = get_user_field('user_id', $sessions_all['uname'], TRUE);
                if ($whoisonline_sess[$count_sess]['is_hidden'] == FALSE) {
                    $count_hidden++;
                } else {
                    $count_reg_user++;
                }
            } else {
                $whoisonline_sess[$count_sess]['username_color']    = '';
                $whoisonline_sess[$count_sess]['is_hidden']         = TRUE;
                $count_guests++;
            }
            $count_sess++;
        }
        $db->sql_freeresult($result);
        $whoisonline_sess[0]['count_hidden']    = $count_hidden;
        $whoisonline_sess[0]['count_reg_user']  = $count_reg_user;
        $whoisonline_sess[0]['count_guests']    = $count_guests;
        $whoisonline_sess[0]['count_sessions']  = $count_sess;
        $whoisonline_sess[0]['stat_created']    = time();
        asort($whoisonline_sess);
        return $whoisonline_sess;
    } else {
            $db->sql_freeresult($result);
            $whoisonline_sess[0]['count_hidden']    = 0;
            $whoisonline_sess[0]['count_reg_user']  = 0;
            $whoisonline_sess[0]['count_guests']    = 0;
            $whoisonline_sess[0]['stat_created']    = time();
            $whoisonline_sess[0]['count_sessions']  = 0;
            asort($whoisonline_sess);
            return $whoisonline_sess;
    }
}

/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
function select_session_url($session_page, $url_qs, $url_ps, $specific, $level, $id, $forum_data, $topic_data, $user_data, $cat_data)
{
    global $lang, $phpEx, $userdata, $phpbb_root_path;
    include_once(NUKE_INCLUDE_DIR.'constants.'. $phpEx);
    unset($location);

        if ($session_page > '0')
            {
        $specific     = intval($session_page);
        $url_qs     = POST_FORUM_URL .'='. intval($session_page);
        $url_ps        = '/modules.php?name=Forums&file=viewforum';
            }

        if ( (strstr($url_qs, POST_FORUM_URL .'=')) && (strstr($url_ps, 'viewforum.')) )
            {
            for ($z = 0; $z < count($forum_data); $z++)
                {
                if (!$forum_data[$z]['forum_id'])
                    break;

                if ($specific == $forum_data[$z]['forum_id'])
                    {
                $forum_name = $forum_data[$z]['forum_name'];
                break;
                    }
                }
        $location = str_replace('%f%', '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">'. $forum_name .'</a>', $lang['BSH_Viewing_Forums']);
            }

        if ( (strstr($url_qs, POST_TOPIC_URL .'=')) && (strstr($url_ps, 'viewtopic.')) )
            {
            for ($z = 0; $z < count($topic_data); $z++)
                {
                if (!$topic_data[$z]['topic_id'])
                    break;

                if ($specific == $topic_data[$z]['topic_id'])
                    {
                $topic_name = $topic_data[$z]['topic_title'];
                break;
                    }
                }
        $location = str_replace('%t%', '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">'. $topic_name .'</a>', $lang['BSH_Viewing_Topic']);
            }

        if ( (strstr($url_qs, POST_USERS_URL .'=')) && (strstr($url_ps, 'profile.')) )
            {
            for ($z = 0; $z < count($user_data); $z++)
                {
                if (!$user_data[$z]['user_id'])
                    break;

                if ($specific == $user_data[$z]['user_id'])
                    {
                $username = $user_data[$z]['username'];
                break;
                    }
                }
        $location = str_replace('%u%', '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">'. $username .'</a>', $lang['BSH_Viewing_Profile']);
            }

        if ( (strstr($url_qs, POST_CAT_URL .'=')) && (strstr($url_ps, 'index.')) )
            {
            for ($z = 0; $z < count($cat_data); $z++)
                {
                if (!$cat_data[$z]['cat_id'])
                    break;

                if ($specific == $cat_data[$z]['cat_id'])
                    {
                $cat_name = $cat_data[$z]['cat_title'];
                break;
                    }
                }
        //$location = str_replace('%c%', '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">'. $cat_name .'</a>', $lang['BSH_Viewing_Category']);
            }

           if(!isset($location))
		   $location = '';
           
		   if (!$location)
            {
            if ( (strstr($url_qs, POST_POST_URL .'=')) && (strstr($url_ps, 'viewtopic.')) )
                $location = sprintf($lang['BSH_Viewing_Post'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif (strstr($url_ps, 'groupcp.'))
                $location = sprintf($lang['BSH_Viewing_Groups'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif (strstr($url_ps, 'search.'))
                $location = sprintf($lang['BSH_Searching_Forums'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif (strstr($url_ps, 'viewonline.'))
                $location = sprintf($lang['BSH_Viewing_Onlinelist'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif ( (strstr($url_ps, 'privmsg.')) && ($userdata['user_id'] != ANONYMOUS) )
                $location = sprintf($lang['BSH_Viewing_Messages'], '<a href="privmsg.'. $phpEx .'?mode=inbox" class="copyright">', '</a>');
            elseif ( (strstr($url_ps, 'privmsg.')) && ($userdata['user_id'] == ANONYMOUS) )
                $location = sprintf($lang['BSH_Viewing_Messages'], '', '');
            elseif (strstr($url_ps, 'memberlist.'))
                $location = sprintf($lang['BSH_Viewing_Memberlist'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif ( (strstr($url_ps, 'profile.')) && (strstr($url_qs, 'mode=editprofile')) )
                $location = sprintf($lang['BSH_Editing_Profile'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif ( (strstr($url_ps, 'login.')) && ($userdata['user_id'] != ANONYMOUS) )
                $location = sprintf($lang['BSH_Login'], '', '');
            elseif ( (strstr($url_ps, 'login.')) && ($userdata['user_id'] == ANONYMOUS) )
                $location = sprintf($lang['BSH_Logout'], '', '');
            elseif (strstr($url_ps, 'admin/'))
                $location = sprintf($lang['BSH_Viewing_ACP'], '', '');
            elseif ( (strstr($url_ps, 'modcp.')) && ($userdata['user_level'] != ADMIN) )
                $location = sprintf($lang['BSH_Moderating_Forum'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif ( (strstr($url_ps, 'modcp.')) && ($userdata['user_level'] != ADMIN) )
                $location = sprintf($lang['BSH_Moderating_Forum'], '', '');
            elseif (strstr($url_ps, 'faq.'))
                $location = sprintf($lang['BSH_Viewing_FAQ'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');

            #==== Start: Integrations For Other Mods
            elseif ( (strstr($url_ps, 'index.')) && (strstr($url_qs, 'mode=tree')) )
                $location = sprintf($lang['BSH_Viewing_Tree'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif ( (strstr($url_ps, 'index.')) && (strstr($url_qs, 'mode=spiders')) )
                $location = sprintf($lang['BSH_Viewing_Spiders'], '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">', '</a>');
            elseif (strstr($url_ps, 'BlendAdmin/'))
                $location = sprintf($lang['BSH_Viewing_BACP'], '', '');

            $new_url     = explode('.', $url_ps);
            $page        = str_replace('/', '', $new_url[0]);
            $location    = ($location) ? $location : '<a href="'. (($url_qs) ? $url_ps .'?'. $url_qs : $url_ps) .'" class="copyright">'. ucwords(strtolower($page)) .'</a>';

			#==== End: Integration For Other Mods
            }

            $location     = trim($location);
            $url_qs     = trim($url_qs );
            $url_ps     = trim($url_ps);
            
			if (!$location || ( (!$url_qs) && (!$url_ps) ) )
            $location = sprintf($lang['BSH_Index'], '<a href="index.'. $phpEx .'" class="copyright">', '</a>');

            return '<span class="gensmall">'. $location .'</span>';
        }

        function strip_session_sid()
        {
           global $HTTP_SERVER_VARS;

           if (isset($HTTP_SERVER_VARS['QUERY_STRING']))
            $qs = str_replace('%09', '%20', $HTTP_SERVER_VARS['QUERY_STRING']);
           elseif (getenv('QUERY_STRING'))
            $qs = str_replace('%09', '%20', getenv('QUERY_STRING'));
           else
            $qs = 'unknown';

            if (strstr($qs, '?sid=') || strstr($qs, '&sid='))
            {
                if (strstr($qs, '?sid='))
                {
                  $new_qs = explode('?sid=', $qs);
                  return $new_qs[0];
                }
                
				if (strstr($qs, '&sid='))
                {
                  $new_qs = explode('&sid=', $qs);
                  return $new_qs[0];
                }
            }
           elseif ($qs != 'unknown') 
           return $qs;
           else
           return '';
        }

        function set_session_url($id)
        {
          global $db;
          global $HTTP_GET_VARS, $HTTP_SERVER_VARS;

          $php_self         = $HTTP_SERVER_VARS['PHP_SELF'];
          $query_string     = strip_session_sid();

          if (isset($HTTP_GET_VARS[POST_USERS_URL]))
            $specific = intval($HTTP_GET_VARS[POST_USERS_URL]);

          if (isset($HTTP_GET_VARS[POST_FORUM_URL]))
            $specific = intval($HTTP_GET_VARS[POST_FORUM_URL]);

          if (isset($HTTP_GET_VARS[POST_GROUPS_URL]))
            $specific = intval($HTTP_GET_VARS[POST_GROUPS_URL]);

          if (isset($HTTP_GET_VARS[POST_CAT_URL]))
            $specific = intval($HTTP_GET_VARS[POST_CAT_URL]);

          if (isset($HTTP_GET_VARS[POST_TOPIC_URL]))
            $specific = intval($HTTP_GET_VARS[POST_TOPIC_URL]);

          if (isset($HTTP_GET_VARS[POST_POST_URL]))
            $specific = intval($HTTP_GET_VARS[POST_POST_URL]);

          if (!isset($specific))
            $specific = 0;

    $q = "UPDATE ". SESSIONS_TABLE ." SET session_url_qs = '$query_string', session_url_ps = '$php_self', session_url_specific = '$specific' WHERE session_id = '$id'";
    $db->sql_query($q);
}
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

//
// Adds/updates a new session to the database for the given userid.
// Returns the new session ID on success.
//
function session_begin($user_id, $user_ip, $page_id, $auto_create = 0, $enable_autologin = 0, $admin = 0)
{
    global $db, $board_config, $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $SID;

    $cookiename = $board_config['cookie_name'];
    $cookiepath = $board_config['cookie_path'];
    $cookiedomain = $board_config['cookie_domain'];
    $cookiesecure = $board_config['cookie_secure'];

    if ( isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) || isset($HTTP_COOKIE_VARS[$cookiename . '_data']) )
    {
        $session_id = isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) ? $HTTP_COOKIE_VARS[$cookiename . '_sid'] : '';
        $sessiondata = isset($HTTP_COOKIE_VARS[$cookiename . '_data']) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$cookiename . '_data'])) : array();
        $sessionmethod = SESSION_METHOD_COOKIE;
    }
    else
    {
        $sessiondata = array();
        $session_id = ( isset($HTTP_GET_VARS['sid']) ) ? $HTTP_GET_VARS['sid'] : '';
        $sessionmethod = SESSION_METHOD_GET;
    }

    //
    if (!preg_match('/^[A-Za-z0-9]*$/', $session_id))
    {
        $session_id = '';
    }

    $page_id = (int) $page_id;

    $last_visit = 0;
    $current_time = time();

    //
    // Are auto-logins allowed?
    // If allow_autologin is not set or is true then they are
    // (same behaviour as old 2.0.x session code)
    //
    if (isset($board_config['allow_autologin']) && !$board_config['allow_autologin'])
    {
        $enable_autologin = $sessiondata['autologinid'] = false;
    }

    //
    // First off attempt to join with the autologin value if we have one
    // If not, just use the user_id value
    //
    $userdata = array();

    if ($user_id != ANONYMOUS)
    {
        if (isset($sessiondata['autologinid']) && (string) $sessiondata['autologinid'] != '' && $user_id)
        {
            $sql = 'SELECT u.*
                FROM (' . USERS_TABLE . ' u, ' . SESSIONS_KEYS_TABLE . ' k)
                WHERE u.user_id = ' . (int) $user_id . "
                    AND u.user_active = 1
                    AND k.user_id = u.user_id
                    AND k.key_id = '" . md5($sessiondata['autologinid']) . "'";
            if (!($result = $db->sql_query($sql, true)))
            {
                message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
            }

            $userdata = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);

            $enable_autologin = $login = 1;
        }
        else if (!$auto_create)
        {
            $sessiondata['autologinid'] = '';
            $sessiondata['userid'] = $user_id;

            $sql = 'SELECT *
                FROM ' . USERS_TABLE . '
                WHERE user_id = ' . (int) $user_id . '
                    AND user_active = 1';
            if (!($result = $db->sql_query($sql, true)))
            {
                message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
            }

            $userdata = $db->sql_fetchrow($result);
            $db->sql_freeresult($result);

            $login = 1;
        }
    }

    //
    // At this point either $userdata should be populated or
    // one of the below is true
    // * Key didn't match one in the DB
    // * User does not exist
    // * User is inactive
    //
    if (!count($userdata) || !is_array($userdata) || !$userdata)
    {
        $sessiondata['autologinid'] = '';
        $sessiondata['userid'] = $user_id = ANONYMOUS;
        $enable_autologin = $login = 0;

        $sql = 'SELECT *
            FROM ' . USERS_TABLE . '
            WHERE user_id = ' . (int) $user_id;
        if (!($result = $db->sql_query($sql, true)))
        {
            message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
        }

        $userdata = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
    }

    //
    // Initial ban check against user id, IP and email address
    //
    preg_match('/(..)(..)(..)(..)/', $user_ip, $user_ip_parts);

    $sql = "SELECT ban_ip, ban_userid, ban_email
        FROM " . BANLIST_TABLE . "
        WHERE ban_ip IN ('" . $user_ip_parts[1] . $user_ip_parts[2] . $user_ip_parts[3] . $user_ip_parts[4] . "', '" . $user_ip_parts[1] . $user_ip_parts[2] . $user_ip_parts[3] . "ff', '" . $user_ip_parts[1] . $user_ip_parts[2] . "ffff', '" . $user_ip_parts[1] . "ffffff')
            OR ban_userid = '$user_id'";
    if ( $user_id != ANONYMOUS )
    {
        $sql .= " OR ban_email LIKE '" . str_replace("\'", "''", $userdata['user_email']) . "'
            OR ban_email LIKE '" . substr(str_replace("\'", "''", $userdata['user_email']), strpos(str_replace("\'", "''", $userdata['user_email']), "@")) . "'";
    }
    if ( !($result = $db->sql_query($sql, true)) )
    {
        message_die(CRITICAL_ERROR, 'Could not obtain ban information', '', __LINE__, __FILE__, $sql);
    }

    if ( $ban_info = $db->sql_fetchrow($result) )
    {
        if ( $ban_info['ban_ip'] || $ban_info['ban_userid'] || $ban_info['ban_email'] )
        {
            message_die(CRITICAL_MESSAGE, 'You_been_banned');
        }
    }

    //
    // Create or update the session
    //
    $sql = "UPDATE " . SESSIONS_TABLE . "
        SET session_user_id = $user_id, session_start = $current_time, session_time = $current_time, session_page = $page_id, session_logged_in = $login, session_admin = $admin
        WHERE session_id = '" . $session_id . "'
            AND session_ip = '$user_ip'";
    if ( !$db->sql_query($sql) || !$db->sql_affectedrows() )
    {
        $session_id = md5(dss_rand());

        $sql = "INSERT INTO " . SESSIONS_TABLE . "
            (session_id, session_user_id, session_start, session_time, session_ip, session_page, session_logged_in, session_admin)
            VALUES ('$session_id', '$user_id', '$current_time', '$current_time', '$user_ip', '$page_id', '$login', '$admin')";
        if ( !$db->sql_query($sql) )
        {
                $error = TRUE;
                if (SQL_LAYER == "mysql" || SQL_LAYER == "mysql4" || SQL_LAYER == "mysqli")
                {
                    $sql_error = $db->sql_error($result);
                    if ($sql_error["code"] == 1114)
                    {
                        $result = $db->sql_query('SHOW TABLE STATUS LIKE "'.SESSIONS_TABLE.'"');
                        $row = $db->sql_fetchrow($result);
                        if ($row["Type"] == "HEAP")
                        {
                            if ($row["Rows"] > 2500)
                            {
                                $delete_order = (SQL_LAYER=="mysql4") ? " ORDER BY session_time ASC" : "";
                                $db->sql_query("DELETE QUICK FROM ".SESSIONS_TABLE."$delete_order LIMIT 50");
                            }
                            else
                            {
                                $db->sql_query("ALTER TABLE ".SESSIONS_TABLE." MAX_ROWS=".($row["Rows"]+50));
                            }
                            if ($db->sql_query($sql))
                            {
                                $error = FALSE;
                            }
                        }
                    }
                }
                if ($error)
                {
                    message_die(CRITICAL_ERROR, "Error creating new session", "", __LINE__, __FILE__, $sql);
                }
                }
    }

    if ( $user_id != ANONYMOUS )
    {
        $last_visit = ( $userdata['user_session_time'] > 0 ) ? $userdata['user_session_time'] : $current_time;
        if (!$admin)
        {

        $sql = "UPDATE " . USERS_TABLE . "
            SET user_session_time = $current_time, user_session_page = $page_id, user_lastvisit = $last_visit
            WHERE user_id = '$user_id'";
        if ( !$db->sql_query($sql) )
        {
            message_die(CRITICAL_ERROR, 'Error updating last visit time', '', __LINE__, __FILE__, $sql);
        }

        }

        $userdata['user_lastvisit'] = $last_visit;

        //
        // Regenerate the auto-login key
        //
        if ($enable_autologin)
        {
            $auto_login_key = dss_rand() . dss_rand();

            if (isset($sessiondata['autologinid']) && (string) $sessiondata['autologinid'] != '')
            {
                $sql = 'UPDATE ' . SESSIONS_KEYS_TABLE . "
                    SET last_ip = '$user_ip', key_id = '" . md5($auto_login_key) . "', last_login = $current_time
                    WHERE key_id = '" . md5($sessiondata['autologinid']) . "'";
            }
            else
            {
                $sql = 'INSERT INTO ' . SESSIONS_KEYS_TABLE . "(key_id, user_id, last_ip, last_login)
                    VALUES ('" . md5($auto_login_key) . "', $user_id, '$user_ip', $current_time)";
            }

            if ( !$db->sql_query($sql) )
            {
                message_die(CRITICAL_ERROR, 'Error updating session key', '', __LINE__, __FILE__, $sql);
            }

            $sessiondata['autologinid'] = $auto_login_key;
            unset($auto_login_key);
        }
        else
        {
            $sessiondata['autologinid'] = '';
        }

//        $sessiondata['autologinid'] = (!$admin) ? (( $enable_autologin && $sessionmethod == SESSION_METHOD_COOKIE ) ? $auto_login_key : '') : $sessiondata['autologinid'];
        $sessiondata['userid'] = $user_id;
    }

    $userdata['session_id'] = $session_id;
    $userdata['session_ip'] = $user_ip;
    $userdata['session_user_id'] = $user_id;
    $userdata['session_logged_in'] = $login;
    $userdata['session_page'] = $page_id;
    $userdata['session_start'] = $current_time;
    $userdata['session_time'] = $current_time;
    $userdata['session_admin'] = $admin;
    $userdata['session_key'] = $sessiondata['autologinid'];
    setcookie($cookiename . '_data', serialize($sessiondata), $current_time + 31536000, $cookiepath, $cookiedomain, $cookiesecure);
    setcookie($cookiename . '_sid', $session_id, 0, $cookiepath, $cookiedomain, $cookiesecure);
	setcookie($cookiename . '_fpass', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
	// Add the session_key to the userdata array if it is set
    $SID = 'sid=' . $session_id;

    return $userdata;
}

//
// Checks for a given user session, tidies session table and updates user
// sessions at each page refresh
//
// modded by Quake for NOT using $nukeuser
function session_pagestart($user_ip, $thispage_id, $trash=0)
{
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
    ini_set('arg_separator.output', '&amp;');
    session_start();
    global $db, $lang, $board_config, $session_id, $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $SID, $pc_dateTime, $HTTP_SESSION_VARS, $cookie;
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/

    $cookiename = $board_config['cookie_name'];
    $cookiepath = $board_config['cookie_path'];
    $cookiedomain = $board_config['cookie_domain'];
    $cookiesecure = $board_config['cookie_secure'];

    $current_time = time();
    unset($userdata);

    if ( isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) || isset($HTTP_COOKIE_VARS[$cookiename . '_data']) )
    {
        $sessiondata = isset( $HTTP_COOKIE_VARS[$cookiename . '_data'] ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$cookiename . '_data'])) : array();
        $session_id = isset( $HTTP_COOKIE_VARS[$cookiename . '_sid'] ) ? $HTTP_COOKIE_VARS[$cookiename . '_sid'] : '';
        $sessionmethod = SESSION_METHOD_COOKIE;
    }
    else
    {
        $sessiondata = array();
        $session_id = ( isset($HTTP_GET_VARS['sid']) ) ? $HTTP_GET_VARS['sid'] : '';
        $sessionmethod = SESSION_METHOD_GET;
    }
   if (!preg_match('/^[A-Za-z0-9]*$/', $session_id))
   {
      $session_id = '';
   }
   if (!empty($cookie) && empty($userdata['session_logged_in'])) {
       bblogin($session_id);
   } else {
       $thispage_id = intval($thispage_id);
   }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
$pc_dateTime_update = False;

if ( isset($HTTP_GET_VARS['pc_tzo']) )
{
    $HTTP_SESSION_VARS['pc_timezoneOffset'] = intval($HTTP_GET_VARS['pc_tzo']);
    $pc_dateTime['pc_timezoneOffset'] = $HTTP_SESSION_VARS['pc_timezoneOffset'];

    $server_time = gmdate('G')*3600 + gmdate('i')*60 + gmdate('s');

    if ( intval($HTTP_GET_VARS['pc_d']) == gmdate('Ymd') )
    {
        $HTTP_SESSION_VARS['pc_timeOffset'] = intval($HTTP_GET_VARS['pc_t']) - $server_time;
    } else
    {
		if ( intval($HTTP_GET_VARS['pc_d']) > gmdate(Ymd) )
		{
			$HTTP_SESSION_VARS['pc_timeOffset'] = (86400 - $server_time) + intval($HTTP_GET_VARS['pc_t']);
		} else
		{
			$HTTP_SESSION_VARS['pc_timeOffset'] = - ((86400 - intval($HTTP_GET_VARS['pc_t'])) + $server_time);
		}
    }

    $pc_dateTime['pc_timeOffset'] = $HTTP_SESSION_VARS['pc_timeOffset'];

    $pc_dateTime_update = True;

} else if ( isset($HTTP_SESSION_VARS['pc_timezoneOffset']) )
{
    $pc_dateTime['pc_timezoneOffset'] = $HTTP_SESSION_VARS['pc_timezoneOffset'];
    $pc_dateTime['pc_timeOffset'] = $HTTP_SESSION_VARS['pc_timeOffset'];
}
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
    //
    // Does a session exist?
    //
    if ( !empty($session_id) )
    {
        //
        // session_id exists so go ahead and attempt to grab all
        // data in preparation
        //
        $sql = "SELECT u.*, s.*
            FROM (" . SESSIONS_TABLE . " s, " . USERS_TABLE . " u)
            WHERE s.session_id = '$session_id'
                AND u.user_id = s.session_user_id";
        if ( !($result = $db->sql_query($sql, true)) )
        {
            message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch', '', __LINE__, __FILE__, $sql);
        }

        $userdata = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);

/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
        set_session_url($session_id);
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

        //
        // Did the session exist in the DB?
        //
        if ( isset($userdata['user_id']) )
        {
            //
            // Do not check IP assuming equivalence, if IPv4 we'll check only first 24
            // bits ... I've been told (by vHiker) this should alleviate problems with
            // load balanced et al proxies while retaining some reliance on IP security.
            //
            $ip_check_s = substr($userdata['session_ip'], 0, 6);
            $ip_check_u = substr($user_ip, 0, 6);

            if ($ip_check_s == $ip_check_u)
            {
                $SID = ($sessionmethod == SESSION_METHOD_GET || defined('IN_ADMIN')) ? 'sid=' . $session_id : '';

                //
                // Only update session DB a minute or so after last update
                //
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                if ( $current_time - $userdata['session_time'] > 60 || $pc_dateTime_update == True)
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                {
                    // A little trick to reset session_admin on session re-usage
                    $update_admin = (!defined('IN_ADMIN') && $current_time - $userdata['session_time'] > ($board_config['session_length']+60)) ? ', session_admin = 0' : '';

                    $sql = "UPDATE " . SESSIONS_TABLE . "
                        SET session_time = '$current_time', session_page = $thispage_id$update_admin
                        WHERE session_id = '" . $userdata['session_id'] . "'";
                    if ( !$db->sql_query($sql) )
                    {
                        message_die(CRITICAL_ERROR, 'Error updating sessions table', '', __LINE__, __FILE__, $sql);
                    }

                    if ( $userdata['user_id'] != ANONYMOUS )
                    {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                        if ( isset($pc_dateTime['pc_timeOffset']) )
                        {
                            $update_pc_timeOffsets = ", user_pc_timeOffsets = '" . $pc_dateTime['pc_timezoneOffset'] . "/" . $pc_dateTime['pc_timeOffset'] . "'";
                        } else
                        {
                            $update_pc_timeOffsets = "";
                        }
                        $sql = "UPDATE " . USERS_TABLE . "
                            SET user_session_time = '$current_time', user_session_page = '$thispage_id' " . $update_pc_timeOffsets . "
                            WHERE user_id = " . $userdata['user_id'];
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                        if ( !$db->sql_query($sql) )
                        {
                            message_die(CRITICAL_ERROR, 'Error updating sessions table', '', __LINE__, __FILE__, $sql);
                        }
                    }

                    //
                    session_clean($userdata['session_id']);

                    setcookie($cookiename . '_data', serialize($sessiondata), $current_time + 31536000, $cookiepath, $cookiedomain, $cookiesecure);
                    setcookie($cookiename . '_sid', $session_id, 0, $cookiepath, $cookiedomain, $cookiesecure);
					setcookie($cookiename . '_fpass', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
                }

				// Add the session_key to the userdata array if it is set
				if ( isset($sessiondata['autologinid']) && $sessiondata['autologinid'] != '' )
				{
					$userdata['session_key'] = $sessiondata['autologinid'];
				}

                return $userdata;
            }
        }
    }

    //
    // If we reach here then no (valid) session exists. So we'll create a new one,
    // using the cookie user_id if available to pull basic user prefs.
    //
    $user_id = ( isset($sessiondata['userid']) ) ? intval($sessiondata['userid']) : ANONYMOUS;

    if ( !($userdata = session_begin($user_id, $user_ip, $thispage_id, TRUE)) )
    {
        message_die(CRITICAL_ERROR, 'Error creating user session', '', __LINE__, __FILE__, $sql);
    }
    global $userinfo;
    if (!empty($userinfo) && is_array($userinfo)) {
        $userdata =& $userinfo;
    }

    return $userdata;

}

/**
* Terminates the specified session
* It will delete the entry in the sessions table for this session,
* remove the corresponding auto-login key and reset the cookies
*/
function session_end($session_id, $user_id)
{
    global $db, $lang, $board_config, $userdata;
    global $HTTP_COOKIE_VARS, $HTTP_GET_VARS, $SID;

    $cookiename = $board_config['cookie_name'];
    $cookiepath = $board_config['cookie_path'];
    $cookiedomain = $board_config['cookie_domain'];
    $cookiesecure = $board_config['cookie_secure'];

    $current_time = time();

    if (!preg_match('/^[A-Za-z0-9]*$/', $session_id))
    {
        return;
    }

    //
    // Delete existing session
    //
    $sql = 'DELETE FROM ' . SESSIONS_TABLE . "
        WHERE session_id = '$session_id'
            AND session_user_id = $user_id";
    if ( !$db->sql_query($sql) )
    {
        message_die(CRITICAL_ERROR, 'Error removing user session', '', __LINE__, __FILE__, $sql);
    }

    //
    // Remove this auto-login entry (if applicable)
    //
    if ( isset($userdata['session_key']) && $userdata['session_key'] != '' )
    {
        $autologin_key = md5($userdata['session_key']);
        $sql = 'DELETE FROM ' . SESSIONS_KEYS_TABLE . '
            WHERE user_id = ' . (int) $user_id . "
                AND key_id = '$autologin_key'";
        if ( !$db->sql_query($sql) )
        {
            message_die(CRITICAL_ERROR, 'Error removing auto-login key', '', __LINE__, __FILE__, $sql);
        }
    }

    //
    // We expect that message_die will be called after this function,
    // but just in case it isn't, reset $userdata to the details for a guest
    //
    $sql = 'SELECT *
        FROM ' . USERS_TABLE . '
        WHERE user_id = ' . ANONYMOUS;
    if ( !($result = $db->sql_query($sql, true)) )
    {
        message_die(CRITICAL_ERROR, 'Error obtaining user details', '', __LINE__, __FILE__, $sql);
    }
    if ( !($userdata = $db->sql_fetchrow($result)) )
    {
        message_die(CRITICAL_ERROR, 'Error obtaining user details', '', __LINE__, __FILE__, $sql);
    }
    $db->sql_freeresult($result);
    setcookie($cookiename . '_data', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);
    setcookie($cookiename . '_sid', '', $current_time - 31536000, $cookiepath, $cookiedomain, $cookiesecure);

    return true;
}

/**
* Removes expired sessions and auto-login keys from the database
*/
function session_clean($session_id)
{
    global $board_config, $db;

    //
    // Delete expired sessions
    //
    $sql = 'DELETE FROM ' . SESSIONS_TABLE . '
        WHERE session_time < ' . (time() - (int) $board_config['session_length']) . "
            AND session_id <> '$session_id'";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(CRITICAL_ERROR, 'Error clearing sessions table', '', __LINE__, __FILE__, $sql);
    }
    $db->sql_freeresult($result);

    //
    // Delete expired auto-login keys
    // If max_autologin_time is not set then keys will never be deleted
    // (same behaviour as old 2.0.x session code)
    //
    if (!empty($board_config['max_autologin_time']) && $board_config['max_autologin_time'] > 0)
    {
        $sql = 'DELETE FROM ' . SESSIONS_KEYS_TABLE . '
            WHERE last_login < ' . (time() - (86400 * (int) $board_config['max_autologin_time']));
        $db->sql_query($sql);
    }

    return true;
}

/**
* Reset all login keys for the specified user
* Called on password changes
*/
function session_reset_keys($user_id, $user_ip)
{
	global $db, $userdata, $board_config;

	$key_sql = ($user_id == $userdata['user_id'] && !empty($userdata['session_key'])) ? "AND key_id != '" . md5($userdata['session_key']) . "'" : '';

	$sql = 'DELETE FROM ' . SESSIONS_KEYS_TABLE . '
		WHERE user_id = ' . (int) $user_id . "
			$key_sql";

	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, 'Error removing auto-login keys', '', __LINE__, __FILE__, $sql);
	}

	$where_sql = 'session_user_id = ' . (int) $user_id;
	$where_sql .= ($user_id == $userdata['user_id']) ? " AND session_id <> '" . $userdata['session_id'] . "'" : '';
	$sql = 'DELETE FROM ' . SESSIONS_TABLE . "
		WHERE $where_sql";
	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, 'Error removing user session(s)', '', __LINE__, __FILE__, $sql);
	}

	if ( !empty($key_sql) )
	{
		$auto_login_key = dss_rand() . dss_rand();

		$current_time = time();

		$sql = 'UPDATE ' . SESSIONS_KEYS_TABLE . "
			SET last_ip = '$user_ip', key_id = '" . md5($auto_login_key) . "', last_login = $current_time
			WHERE key_id = '" . md5($userdata['session_key']) . "'";

		if ( !$db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, 'Error updating session key', '', __LINE__, __FILE__, $sql);
		}

		// And now rebuild the cookie
		$sessiondata['userid'] = $user_id;
		$sessiondata['autologinid'] = $auto_login_key;
		$cookiename = $board_config['cookie_name'];
		$cookiepath = $board_config['cookie_path'];
		$cookiedomain = $board_config['cookie_domain'];
		$cookiesecure = $board_config['cookie_secure'];

		setcookie($cookiename . '_data', serialize($sessiondata), $current_time + 31536000, $cookiepath, $cookiedomain, $cookiesecure);

		$userdata['session_key'] = $auto_login_key;
		unset($sessiondata);
		unset($auto_login_key);
	}
}

//
// Append $SID to a url. Borrowed from phplib and modified. This is an
// extra routine utilised by the session code above and acts as a wrapper
// around every single URL and form action. If you replace the session
// code you must include this routine, even if it's empty.
//
function append_sid($url, $non_html_amp = false)
{
    global $SID, $admin, $userdata;
    if (preg_match("/admin=1/", $url) || preg_match("/admin\_/", $url) || preg_match("/pane=/", $url)){
                                //  The format is fine, don't change a thing.
    } else if (preg_match("/Your\_Account/", $url)){
            $url = str_replace(".php", "", $url);         //  Strip the .php from all the files,
            $url = str_replace("modules", "modules.php", $url); //  and put it back for the modules.php
    }
    else if (preg_match("/redirect/", $url))
    {
            $url = str_replace("login.php", "modules.php?name=Your_Account", $url);         //  Strip the .php from all the files,
            $url = str_replace(".php", "", $url);         //  Strip the .php from all the files,
            $url = ($non_html_amp) ? str_replace("?redirect", "&redirect", $url) : str_replace("?redirect", "&amp;redirect", $url);         //  Strip the .php from all the files,
            $url = str_replace("modules", "modules.php", $url); //  and put it back for the modules.php
    }
    else if (preg_match("/menu=1/", $url))
    {
            $url = ($non_html_amp) ? str_replace("?", "&", $url) : str_replace("?", "&amp;", $url); // As we are already in nuke, change the ? to &
            $url = str_replace(".php", "", $url);         //  Strip the .php from all the files,
            if($url != "index") {
                    $url = ($non_html_amp) ? '../../../modules.php?name=Forums&file='.$url : '../../../modules.php?name=Forums&amp;file='.$url; //Change to Nuke format
            } else {
                    $url = "../../../modules.php?name=Forums";
            }
    }
    else if ((preg_match("/privmsg/", $url)) && (!preg_match("/highlight=privmsg/", $url))) {
            $url = ($non_html_amp) ? str_replace("?", "&", $url) : str_replace("?", "&amp;", $url); // As we are already in nuke, change the ? to &
            $url = str_replace("privmsg.php", "modules.php?name=Private_Messages", $url); //  and put it back for the modules.php
    }
/*****[BEGIN]******************************************
 [ Mod:   Groups as own module                 v1.0.0 ]
 ******************************************************/
    else if ((preg_match("/groupcp/", $url)) && (!preg_match("/highlight=groupc/", $url))) {
            $url = ($non_html_amp) ? str_replace("?", "&", $url) : str_replace("?", "&amp;", $url); // As we are already in nuke, change the ? to &
            $url = str_replace("groupcp.php", "modules.php?name=Groups", $url); //  and put it back for the modules.php
    }
/*****[END]********************************************
 [ Mod:   Groups as own module                 v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:   Profile as own module                 v1.0.0 ]
 ******************************************************/
    else if ((preg_match("/profile/", $url)) && (!preg_match("/highlight=profile/", $url))) {
            $url = ($non_html_amp) ? str_replace("?", "&", $url) : str_replace("?", "&amp;", $url); // As we are already in nuke, change the ? to &
            $url = str_replace("profile.php", "modules.php?name=Profile", $url); //  and put it back for the modules.php
            $dummy = 1;
    }
/*****[END]********************************************
 [ Mod:   Profile as own module                v1.0.0 ]
 ******************************************************/
    else if ((preg_match("/memberlist/", $url)) && (!preg_match("/highlight=memberlist/", $url))) {
            $url = ($non_html_amp) ? str_replace("?", "&", $url) : str_replace("?", "&amp;", $url); // As we are already in nuke, change the ? to &
            $url = str_replace("memberlist.php", "modules.php?name=Members_List", $url); //  and put it back for the modules.php
    } else {
            $url = ($non_html_amp) ? str_replace("?", "&", $url) : str_replace("?", "&amp;", $url); // As we are already in nuke, change the ? to &
            $url = str_replace(".php", "", $url);
            if($url != "index") {
                    $url = ($non_html_amp) ? "modules.php?name=Forums&amp;file=".$url : "modules.php?name=Forums&amp;file=".$url; //Change to Nuke format
            } else {
                    $url = "modules.php?name=Forums";
            }
    }
    global $agent;
    
	if (isset($agent['engine']) && $agent['engine'] == 'bot') 
	return $url;

    if (isset($userdata['user_level']) && $userdata['user_level'] > 1) {
        if ( !empty($SID) && !preg_match('/sid=/i', $url) )
        {
            $url .= ( ( strpos($url, '?') !== false ) ?  ( ( $non_html_amp ) ? '&' : '&amp;' ) : '?' ) . $SID;
        }
    }
    return($url);
}

function admin_sid($url, $non_html_amp = false)
{
    global $SID;
    if($url != "index") {
            $url = "../../../modules.php?name=Forums&file=".$url;
    } else {
            $url = "../../../modules.php?name=Forums";
    }

    if ( !empty($SID) && !preg_match('/sid=/i', $url) )
    {
        $url .= ( ( strpos($url, '?') != false ) ?  ( ( $non_html_amp ) ? '&' : '&amp;' ) : '?' ) . $SID;
    }

    return $url;
}

?>
