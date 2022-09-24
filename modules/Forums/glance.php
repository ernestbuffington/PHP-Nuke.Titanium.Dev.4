<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                 glance.php
 *                            -------------------
 *   begin                : Monday, Apr 07, 2001
 *   copyright            : blulegend, Jack Kan
 *   contact              : www.phpbb.com, member: blulegend
 *   version              : 2.2.1
 *
 *   modified by          : netclectic - http://www.netclectic.com/forums/viewtopic.php?t=257
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
 -=[Mod]=-
       Advanced Username Color                  v1.0.5       08/08/2005
       Smilies in Topic Titles                  v1.0.0       09/10/2005
       Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
 ************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
include('includes/posting_icons.'. $phpEx);
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

    $glance_forum_dir = 'modules.php?name=Forums&amp;file=';
    $glance_news_forum_id = $phpbb2_board_config['glance_news_id'];
    $glance_num_news = intval($phpbb2_board_config['glance_num_news']);
    $glance_num_recent = intval($phpbb2_board_config['glance_num']);
    $glance_recent_ignore = $phpbb2_board_config['glance_ignore_forums'];
    $glance_news_heading = $titanium_lang['glance_news_heading'];
    $glance_recent_heading = $titanium_lang['glance_recent_heading'];
    $glance_table_width = $phpbb2_board_config['glance_table_width'];
    $glance_show_new_bullets = true;
    $glance_track = true;
    $glance_auth_read = intval($phpbb2_board_config['glance_auth_read']);
    $glance_topic_length = intval($phpbb2_board_config['glance_topic_length']);
    //
    // GET USER LAST VISIT
    //
    $glance_last_visit = $userdata['user_lastvisit'];
    $glance_recent_offset = (isset($HTTP_GET_VARS['glance_recent_offset'])) ? intval($HTTP_GET_VARS['glance_recent_offset']) : 0;
    $glance_news_offset = (isset($HTTP_GET_VARS['glance_news_offset'])) ? intval($HTTP_GET_VARS['glance_news_offset']) : 0;

    //
    // MESSAGE TRACKING
    //
    if ( !isset($phpbb2_tracking_topics) && $glance_track ) $phpbb2_tracking_topics = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) : '';

    // CHECK FOR BAD WORDS
    //
    // Define censored word matches
    //
    $orig_word = array();
    $replacement_word = array();
    obtain_word_list($orig_word, $replacement_word);

    // set the topic title sql depending on the character limit    set in glance_config
    $sql_title = ($glance_topic_length) ? ", LEFT(t.topic_title, " . $glance_topic_length . ") as topic_title" : ", t.topic_title";

    //
    // GET THE LATEST NEWS TOPIC
    //
    if ( $glance_num_news )
    {
        $news_data = $titanium_db->sql_fetchrow($result);
         $sql = "
            SELECT
                f.forum_id, f.forum_name, f.forum_color" . $sql_title . ", t.topic_id, t.topic_last_post_id, t.topic_poster, t.topic_views, t.topic_replies, t.topic_type, t.topic_status, t.topic_icon,
                p2.post_time, p2.poster_id, p2.post_username, p.post_username,

                u.username as last_username,
                u2.username as author_username
            FROM "
                . FORUMS_TABLE . " f, "
                . POSTS_TABLE . " p, "
                . TOPICS_TABLE . " t, "
                . POSTS_TABLE . " p2, "
                . USERS_TABLE . " u, "
                . USERS_TABLE . " u2
            WHERE
                f.forum_id IN (" . $glance_news_forum_id . ")
                AND t.forum_id = f.forum_id
                AND p.post_id = t.topic_first_post_id
                AND p2.post_id = t.topic_last_post_id
                AND t.topic_moved_id = 0
                AND p2.poster_id = u.user_id
                AND t.topic_poster = u2.user_id
                ORDER BY t.topic_glance_priority DESC, t.topic_last_post_id DESC";

        $sql .= ($glance_news_offset) ? " LIMIT " . $glance_news_offset . ", " . $glance_num_news : " LIMIT " . $glance_num_news;

        if( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query new news information", "", __LINE__, __FILE__, $sql);
        }
        $latest_news = array();
        while ( $topic_row = $titanium_db->sql_fetchrow($result) )
        {
            $topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_row['topic_title']) : $topic_row['topic_title'];
            $latest_news[] = $topic_row;
        }
        $titanium_db->sql_freeresult($result);

        // MOD NAV BEGIN
        // obtain the total number of topic for our news topic navigation bit
        $sql = "SELECT SUM(forum_topics) as topic_total FROM " . FORUMS_TABLE . " f WHERE f.forum_id IN (" . $glance_news_forum_id . ")";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query total topics information", "", __LINE__, __FILE__, $sql);
        }
        $row = $titanium_db->sql_fetchrow($result);
        $overall_news_topics = $row['topic_total'];
        $titanium_db->sql_freeresult($result);
        // MOD NAV END
    }

    //
    // GET THE LAST 5 TOPICS
    //
    if ( $glance_num_recent )
    {
        $glance_auth_level = ( $glance_auth_read ) ? AUTH_VIEW : AUTH_ALL;
        $phpbb2_is_auth_ary = auth($glance_auth_level, AUTH_LIST_ALL, $userdata);

        $forumsignore = $glance_news_forum_id;
        if ( $num_forums = count($phpbb2_is_auth_ary) )
        {
            while ( list($phpbb2_forum_id, $auth_mod) = each($phpbb2_is_auth_ary) )
            {
                $unauthed = false;
                if ( !$auth_mod['auth_view'] )
                {
                    $unauthed = true;
                }
                if ( !$glance_auth_read && !$auth_mod['auth_read'] )
                {
                    $unauthed = true;
                }
                if ( $unauthed )
                {
                    $forumsignore .= ($forumsignore) ? ',' . $phpbb2_forum_id : $phpbb2_forum_id;
                }
            }
        }

        $forumsignore .= ($forumsignore && $glance_recent_ignore) ? ',' : '';
        $glance_recent_ignore = ($glance_recent_ignore) ? $glance_recent_ignore : '';

         $sql = "
            SELECT
                f.forum_id, f.forum_name, f.forum_color" . $sql_title . ", t.topic_id, t.topic_last_post_id, t.topic_poster, t.topic_views, t.topic_replies, t.topic_type, t.topic_status, t.topic_icon,
                p2.post_time, p2.poster_id, p2.post_username, p.post_username,

                u.username as last_username,
                u2.username as author_username
            FROM "
                . FORUMS_TABLE . " f, "
                . POSTS_TABLE . " p, "
                . TOPICS_TABLE . " t, "
                . POSTS_TABLE . " p2, "
                . USERS_TABLE . " u, "
                . USERS_TABLE . " u2
            WHERE
                f.forum_id NOT IN (" . $forumsignore . $glance_recent_ignore . ")
                AND t.forum_id = f.forum_id
                AND p.post_id = t.topic_first_post_id
                AND p2.post_id = t.topic_last_post_id
                AND t.topic_moved_id = 0
                AND p2.poster_id = u.user_id
                AND t.topic_poster = u2.user_id
                ORDER BY t.topic_glance_priority DESC, t.topic_last_post_id DESC";

        $sql .= ($glance_recent_offset) ? " LIMIT " . $glance_recent_offset . ", " . $glance_num_recent : " LIMIT " . $glance_num_recent;

        if( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query latest topic information", "", __LINE__, __FILE__, $sql);
        }
        $latest_topics = array();
        $latest_anns = array();
        $latest_stickys = array();
        while ( $topic_row = $titanium_db->sql_fetchrow($result) )
        {
            $topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_row['topic_title']) : $topic_row['topic_title'];
            switch ($topic_row['topic_type'])
                {
                    case POST_GLOBAL_ANNOUNCE:
                    case POST_ANNOUNCE:
                        $latest_anns[] = $topic_row;
                        break;
                    case POST_STICKY:
                        $latest_stickys[] = $topic_row;
                        break;
                    default:
                        $latest_topics[] = $topic_row;
                        break;
                }
        }
        $latest_topics = array_merge($latest_anns, $latest_stickys, $latest_topics);
        $titanium_db->sql_freeresult($result);

        // MOD NAV BEGIN
        // obtain the total number of topic for our recent topic navigation bit
        $sql = "SELECT SUM(forum_topics) as topic_total FROM " . FORUMS_TABLE . " f WHERE f.forum_id NOT IN (" . $forumsignore . $glance_recent_ignore . $glance_news_forum_id . ")";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query total topics information", "", __LINE__, __FILE__, $sql);
        }
        $row = $titanium_db->sql_fetchrow($result);
        $overall_total_topics = $row['topic_total'];
        $titanium_db->sql_freeresult($result);
        // MOD NAV END
    }

    //
    // BEGIN OUTPUT
    //
    $phpbb2_template->set_filenames(array(
        'glance_output' => 'glance_body.tpl')
    );

    if ( $glance_num_news )
    {
        if ( !empty($latest_news) )
        {
            $bullet_pre = '<img src="';

            for ( $i = 0; $i < count($latest_news); $i++ )
            {
                if ( $userdata['session_logged_in'] )
                {
                    $phpbb2_unread_topics = false;
                    $glance_topic_id = $latest_news[$i]['topic_id'];
                    if ( $latest_news[$i]['post_time'] > $glance_last_visit )
                    {
                        $phpbb2_unread_topics = true;
                        if( !empty($phpbb2_tracking_topics[$glance_topic_id]) && $glance_track )
                        {
                            if( $phpbb2_tracking_topics[$glance_topic_id] >= $latest_news[$i]['post_time'] )
                            {
                                $phpbb2_unread_topics = false;
                            }
                        }
                    }
                    $shownew = $phpbb2_unread_topics;
                }
                else
                {
                    $phpbb2_unread_topics = false;
                    $shownew = ($phpbb2_board_config['time_today'] < $latest_news[$i]['post_time']);
                }

                $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ?  $images['folder_announce_new'] :  $images['folder_announce'] ) . '" border="0" alt="" />';

                $newest_code = ( $phpbb2_unread_topics && $glance_show_new_bullets ) ? '&amp;view=newest' : '';

                $topic_link = $glance_forum_dir . 'viewtopic&amp;t=' . $latest_news[$i]['topic_id'] . $newest_code;

                if ($phpbb2_board_config['glance_rowclass'] == 1):
                    $row_class = ($count_topics % 2) ? "row3" : "row1";
                    $count_topics += 1;
                else:
                    $row_class = 'row1';
                endif;

                //
                // MOD TODAY AT BEGIN
                //
                //if ( $phpbb2_board_config['time_today'] < $latest_news[$i]['post_time'])
                //{
                //    $phpbb2_last_post_time = sprintf($titanium_lang['Today_at'], create_date($phpbb2_board_config['default_timeformat'], $latest_news[$i]['post_time'], $phpbb2_board_config['board_timezone']));
                //}
                //else if ( $phpbb2_board_config['time_yesterday'] < $latest_topics[$i]['post_time'])
                //{
                //    $phpbb2_last_post_time = sprintf($titanium_lang['Yesterday_at'], create_date($phpbb2_board_config['default_timeformat'], $latest_news[$i]['post_time'], $phpbb2_board_config['board_timezone']));
                //}
                // MOD TODAY AT END

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                 $guest = (!empty($latest_topics[$i]['post_username'])) ? $latest_topics[$i]['post_username'] : $latest_topics[$i]['last_username'] . ' ';
                $phpbb2_last_poster = ($latest_news[$i]['poster_id'] == ANONYMOUS ) ? ( ($latest_news[$i]['last_username'] != '' ) ? $guest : $titanium_lang['Guest'] . ' ' ) : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_news[$i]['poster_id']) . '">' . UsernameColor($latest_news[$i]['last_username']) . '</a> ';

                $phpbb2_last_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $latest_news[$i]['topic_last_post_id']) . '#' . $latest_news[$i]['topic_last_post_id'] . '"><i class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$titanium_lang['View_latest_post'].'"></i></a>';

                $topic_poster = ($latest_news[$i]['topic_poster'] == ANONYMOUS ) ? ( ($latest_news[$i]['author_username'] != '' ) ? $guest : $titanium_lang['Guest'] . ' ' ) : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_news[$i]['topic_poster']) . '">' . UsernameColor($latest_news[$i]['author_username']) . '</a> ';

                $phpbb2_last_post_time = create_date($phpbb2_board_config['default_dateformat'], $latest_news[$i]['post_time'], $phpbb2_board_config['board_timezone']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
                $topic_icon = get_icon_title($latest_news[$i]['topic_icon']);
                $topic_icon_id = $latest_news[$i]['topic_icon'];
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

                $phpbb2_template->assign_block_vars('news', array(

                    'ROW_CLASS' => $row_class,

                    'BULLET' => $bullet_full,
                    'TOPIC_TITLE' => $latest_news[$i]['topic_title'],
                    'TOPIC_LINK' => $topic_link,
                    'TOPIC_TIME' => $phpbb2_last_post_time,
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
                    'ICON' => $topic_icon,
                    'ICON_ID' => $topic_icon_id,
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
                    'TOPIC_POSTER' => sprintf($titanium_lang['Recent_started_by'],$topic_poster),
                    'TOPIC_VIEWS' => $latest_news[$i]['topic_views'],
                    'TOPIC_REPLIES' => $latest_news[$i]['topic_replies'],
                    'LAST_POSTER' => sprintf(trim($titanium_lang['Recent_first_poster']),$phpbb2_last_poster),
                    'LAST_POST_IMG' => $phpbb2_last_post_img,
                    'FORUM_TITLE' => $latest_news[$i]['forum_name'],
                    'FORUM_COLOR' => ' style="color: #'.$latest_news[$i]['forum_color'].';"',
                    'FORUM_LINK' => $glance_forum_dir . 'viewforum&amp;f=' . $latest_news[$i]['forum_id'])

                    );
            }
            // MOD NAV BEGIN
            if (($glance_news_offset > 0) or ($glance_news_offset+$glance_num_news < $overall_news_topics))
            {
                $new_url = '<a href="' . $glance_forum_dir . 'index&amp;glance_news_offset=';
                if ($glance_news_offset > 0)
                {
                    // if we're not on the first record, we can always go backwards
                    $prev_news_url = ($glance_recent_offset > 0) ? $new_url . ($glance_news_offset-$glance_num_news) . '&amp;glance_recent_offset=' . $glance_recent_offset . '" class="th">&lt;&lt; Prev ' . $glance_num_news . '</a>' : $new_url . ($glance_news_offset-$glance_num_news).'" class="th">&lt;&lt; Prev ' . $glance_num_news . '</a>';
                }
                if ($glance_news_offset+$glance_num_news < $overall_news_topics)
                {
                    // offset + limit gives us the maximum record number
                    // that we could have displayed on this page. if it's
                    // less than the total number of entries, that means
                    // there are more entries to see, and we can go forward
                    $next_news_url = ($glance_recent_offset > 0) ? $new_url . ($glance_news_offset+$glance_num_news) . '&amp;glance_recent_offset=' . $glance_recent_offset . '" class="th">Next ' . $glance_num_news . ' &gt;&gt;</a>' : $new_url . ($glance_news_offset+$glance_num_news).'" class="th">Next ' . $glance_num_news . ' &gt;&gt;</a>';
                }
            }
            // MOD NAV END
        }
        else
        {
            $phpbb2_template->assign_block_vars('news', array(
            'BULLET' => '<img src="' . $images['folder'] . '" border="0" alt="" />', $glance_recent_bullet_old,

            'TOPIC_TITLE' => 'None')
            );
        }
    }

    if ( $glance_num_recent )
    {
        $glance_info = 'counted recent';
        $bullet_pre = '<img src="';
        if ( !empty($latest_topics) )
        {
            for ( $i = 0; $i < count($latest_topics); $i++ )
            {
                if ( $userdata['session_logged_in'] )
                {
                    $phpbb2_unread_topics = false;
                    $glance_topic_id = $latest_topics[$i]['topic_id'];
                    if ( $latest_topics[$i]['post_time'] > $glance_last_visit )
                    {
                        $phpbb2_unread_topics = true;
                        if( !empty($phpbb2_tracking_topics[$glance_topic_id]) && $glance_track )
                        {
                            if( $phpbb2_tracking_topics[$glance_topic_id] >= $latest_topics[$i]['post_time'] )
                            {
                                $phpbb2_unread_topics = false;
                            }
                        }
                    }
                    $shownew = $phpbb2_unread_topics;
                }
                else
                {
                    $phpbb2_unread_topics = false;
                    $shownew = ($phpbb2_board_config['time_today'] < $latest_topics[$i]['post_time']);
                }
                switch ($latest_topics[$i]['topic_type'])
                {
                    case POST_GLOBAL_ANNOUNCE:
                        $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_global_announce_new'] :  $images['folder_global_announce'] ) . '" border="0" alt="" />';
                        break;
                    case POST_ANNOUNCE:
                        $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_announce_new'] :  $images['folder_announce'] ) . '" border="0" alt="" />';
                        break;
                    case POST_STICKY:
                        $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $images['folder_sticky_new'] :  $images['folder_sticky'] ) . '" border="0" alt="" />';
                        break;
                    default:
                        if ($latest_topics[$i]['topic_status'] == TOPIC_LOCKED)
                        {
                            $folder = $images['folder_locked'];
                            $folder_new = $images['folder_locked_new'];
                        }
                        else if ($latest_topics[$i]['topic_replies'] >= $phpbb2_board_config['hot_threshold'])
                        {
                            $folder = $images['folder_hot'];
                            $folder_new = $images['folder_hot_new'];
                        }
                        else
                        {
                            $folder = $images['folder'];
                            $folder_new = $images['folder_new'];
                        }

                        $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $folder_new :  $folder ) . '" border="0" alt="" />';
                        break;
                }
                $newest_code = ( $phpbb2_unread_topics && $glance_show_new_bullets ) ? '&amp;view=newest' : '';

                $topic_link = $glance_forum_dir . 'viewtopic&amp;t=' . $latest_topics[$i]['topic_id'] . $newest_code;

                if ($phpbb2_board_config['glance_rowclass'] == 1):
                    $row_class = ($count_topics % 2) ? "row3" : "row1";
                    $count_topics += 1;
                else:
                    $row_class = 'row1';
                endif;

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $guest = (!empty($latest_topics[$i]['post_username'])) ? $latest_topics[$i]['post_username'] : $latest_topics[$i]['last_username'] . ' ';

                $topic_poster = ($latest_topics[$i]['topic_poster'] == ANONYMOUS ) ? ( ($latest_topics[$i]['author_username'] != '' ) ? $guest : $titanium_lang['Guest'] . ' ' ) : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topics[$i]['topic_poster']) . '">' . UsernameColor($latest_topics[$i]['author_username']) . '</a> ';

                $phpbb2_last_post_time = create_date($phpbb2_board_config['default_dateformat'], $latest_topics[$i]['post_time'], $phpbb2_board_config['board_timezone']);
                $phpbb2_last_poster = ($latest_topics[$i]['poster_id'] == ANONYMOUS ) ? ( ($latest_topics[$i]['last_username'] != '' ) ? $guest : $titanium_lang['Guest'] . ' ' ) : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topics[$i]['poster_id']) . '">' . UsernameColor($latest_topics[$i]['last_username']) . '</a> ';

/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $phpbb2_last_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $latest_topics[$i]['topic_last_post_id']) . '#' . $latest_topics[$i]['topic_last_post_id'] . '"><i class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$titanium_lang['View_latest_post'].'"></i></a>';

                //
                // MOD TODAY AT BEGIN
                //
                //if ( $phpbb2_board_config['time_today'] < $latest_topics[$i]['post_time'])
                //{
                //    $phpbb2_last_post_time = sprintf($titanium_lang['Today_at'], create_date($phpbb2_board_config['default_timeformat'], $latest_topics[$i]['post_time'], $phpbb2_board_config['board_timezone']));
                //}
                //else if ( $phpbb2_board_config['time_yesterday'] < $latest_topics[$i]['post_time'])
                //{
                //    $phpbb2_last_post_time = sprintf($titanium_lang['Yesterday_at'], create_date($phpbb2_board_config['default_timeformat'], $latest_topics[$i]['post_time'], $phpbb2_board_config['board_timezone']));
                //}
                // MOD TODAY AT END

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
                $topic_icon = get_icon_title($latest_topics[$i]['topic_icon']);
                $topic_icon_id = $latest_topics[$i]['topic_icon'];
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

                $phpbb2_template->assign_block_vars('recent', array(

                    'ROW_CLASS' => $row_class,

                    'BULLET' => $bullet_full,
                    'TOPIC_LINK' => $topic_link,
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
                    'TOPIC_TITLE' => ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($latest_topics[$i]['topic_title']) : $latest_topics[$i]['topic_title'],
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
                    'ICON' => $topic_icon,
                    'ICON_ID' => $topic_icon_id,
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
                    // 'TOPIC_POSTER' => $topic_poster,
                    'TOPIC_POSTER' => sprintf($titanium_lang['Recent_started_by'],$topic_poster),
                    'TOPIC_VIEWS' => $latest_topics[$i]['topic_views'],
                    'TOPIC_REPLIES' => $latest_topics[$i]['topic_replies'],
                    'LAST_POST_TIME' => $phpbb2_last_post_time,
                    'LAST_POSTER' => sprintf(trim($titanium_lang['Recent_first_poster']),$phpbb2_last_poster),
                    'LAST_POST_IMG' => $phpbb2_last_post_img,
                    'FORUM_TITLE' => $latest_topics[$i]['forum_name'],
                    'FORUM_COLOR' => ' style="color: #'.$latest_topics[$i]['forum_color'].';"',
                    'FORUM_LINK' => $glance_forum_dir . 'viewforum&amp;f=' . $latest_topics[$i]['forum_id'])
                );
            }

            // MOD NAV BEGIN
            if (($glance_recent_offset > 0) or ($glance_recent_offset+$glance_num_recent < $overall_total_topics))
            {
                $new_url = '<a href="' . $glance_forum_dir . 'index&amp;glance_recent_offset=';
                if ($glance_recent_offset > 0)
                {
                    // if we're not on the first record, we can always go backwards
                    $prev_recent_url = ($glance_news_offset > 0) ? $new_url . ($glance_recent_offset-$glance_num_recent) . '&amp;glance_news_offset=' . $glance_news_offset . '" class="th">&lt;&lt; Prev ' . $glance_num_recent . '</a>' : $new_url . ($glance_recent_offset-$glance_num_recent).'" class="th">&lt;&lt; Prev ' . $glance_num_recent . '</a>';
                }
                if ($glance_recent_offset+$glance_num_recent < $overall_total_topics)
                {
                    // offset + limit gives us the maximum record number
                    // that we could have displayed on this page. if it's
                    // less than the total number of entries, that means
                    // there are more entries to see, and we can go forward
                    $next_recent_url = ($glance_news_offset > 0) ? $new_url . ($glance_recent_offset+$glance_num_recent) . '&amp;glance_news_offset=' . $glance_news_offset . '" class="th">Next ' . $glance_num_recent . ' &gt;&gt;</a>' : $new_url . ($glance_recent_offset+$glance_num_recent).'" class="th">Next ' . $glance_num_recent . ' &gt;&gt;</a>';
                }
            }
            // MOD NAV END
        }
        else
        {
            $phpbb2_template->assign_block_vars('recent', array(
            'BULLET' => '<img src="' . $images['forum'] . '" border="0" alt="" />', $glance_recent_bullet_old,

            'TOPIC_TITLE' => 'None')
            );
        }
    }

    if ( $glance_num_news )
    {
        $phpbb2_template->assign_block_vars('switch_glance_news', array(
            'NEXT_URL' => $next_news_url,
            'PREV_URL' => $prev_news_url)
        );

        // MOD CAT ROLLOUT BEGIN
        //$news_on = !isset($HTTP_COOKIE_VARS['phpbbGlance_news']) || !empty($HTTP_COOKIE_VARS['phpbbGlance_news']) ? true : false;
        //if( $news_on )
        //{
        //   $phpbb2_template->assign_block_vars('switch_glance_news.switch_news_on', array());
        //}
        //else
        //{
        //    $phpbb2_template->assign_block_vars('switch_glance_news.switch_news_off', array());
        //}
        // MOD CAT ROLLOUT END
    }
    if ( $glance_num_recent )
    {
        $next_recent_url = (isset($next_recent_url)) ? $next_recent_url : '';
        $prev_recent_url = (isset($prev_recent_url)) ? $prev_recent_url : '';

        $phpbb2_template->assign_block_vars('switch_glance_recent', array(
            'NEXT_URL' => $next_recent_url,
            'PREV_URL' => $prev_recent_url)
        );

        // MOD CAT ROLLOUT BEGIN
        //$recent_on = !isset($HTTP_COOKIE_VARS['phpbbGlance_recent']) || !empty($HTTP_COOKIE_VARS['phpbbGlance_recent']) ? true : false;
        //if( $recent_on )
        //{
        //    $phpbb2_template->assign_block_vars('switch_glance_recent.switch_recent_on', array());
        //}
        //else
        //{
        //   $phpbb2_template->assign_block_vars('switch_glance_recent.switch_recent_off', array());
        //}
        // MOD CAT ROLLOUT END
    }

    $phpbb2_template->assign_vars(array(
        'GLANCE_TABLE_WIDTH' =>    $glance_table_width,
        'RECENT_HEADING' => $glance_recent_heading,
        'NEWS_HEADING' => $glance_news_heading,

        'L_TOPICS' => $titanium_lang['Topics'],
        'L_REPLIES' => $titanium_lang['Replies'],
        'L_VIEWS' => $titanium_lang['Views'],
        'L_LASTPOST' => $titanium_lang['Last_Post'],
        'L_FORUM' => $titanium_lang['Forum'],
        'L_AUTHOR' => $titanium_lang['Author'])
        );

    $phpbb2_template->assign_var_from_handle('GLANCE_OUTPUT', 'glance_output');

// THE END

?>