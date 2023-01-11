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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}
global $userdata, $boardconfig;
/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
include(NUKE_BASE_DIR . '/includes/posting_icons.'. $phpEx);
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
    if(!isset($topic_icon_id))
	$topic_icon_id = '';
	
	if(!isset($recent_item['ICON_ID']))
	$recent_item['ICON_ID'] = 0;
	
    $glance_forum_dir = 'modules.php?name=Forums&amp;file=';
    $glance_news_forum_id = $board_config['glance_news_id'];
    $glance_num_news = (int) $board_config['glance_num_news'];
    $glance_num_recent = (int) $board_config['glance_num'];
    $glance_recent_ignore = $board_config['glance_ignore_forums'];
    $glance_news_heading = $lang['glance_news_heading'];
    $glance_recent_heading = $lang['glance_recent_heading'];
    $glance_table_width = $board_config['glance_table_width'];
    $glance_show_new_bullets = true;
    $glance_track = true;
    $glance_auth_read = (int) $board_config['glance_auth_read'];
    $glance_topic_length = (int) $board_config['glance_topic_length'];
    //
    // GET USER LAST VISIT
    //
    $glance_last_visit = $userdata['user_lastvisit'];
    $glance_recent_offset = (isset($_GET['glance_recent_offset'])) ? (int) $_GET['glance_recent_offset'] : 0;
    $glance_news_offset = (isset($_GET['glance_news_offset'])) ? (int) $_GET['glance_news_offset'] : 0;

    //
    // MESSAGE TRACKING
    //
    if ( !isset($tracking_topics) && $glance_track ) $tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : '';

    // CHECK FOR BAD WORDS
    //
    // Define censored word matches
    //
    $orig_word = [];
    $replacement_word = [];
    obtain_word_list($orig_word, $replacement_word);

    // set the topic title sql depending on the character limit    set in glance_config
    $sql_title = ($glance_topic_length !== 0) ? ", LEFT(t.topic_title, " . $glance_topic_length . ") as topic_title" : ", t.topic_title";

    //
    // GET THE LATEST NEWS TOPIC
    //
    if ( $glance_num_news !== 0 )
    {
        $news_data = $db->sql_fetchrow($result);
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

        $sql .= ($glance_news_offset !== 0) ? " LIMIT " . $glance_news_offset . ", " . $glance_num_news : " LIMIT " . $glance_num_news;

        if( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query new news information", "", __LINE__, __FILE__, $sql);
        }
        $latest_news = [];
        while ( $topic_row = $db->sql_fetchrow($result) )
        {
            $topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, (string) $topic_row['topic_title']) : $topic_row['topic_title'];
            $latest_news[] = $topic_row;
        }
        $db->sql_freeresult($result);

        // MOD NAV BEGIN
        // obtain the total number of topic for our news topic navigation bit
        $sql = "SELECT SUM(forum_topics) as topic_total FROM " . FORUMS_TABLE . " f WHERE f.forum_id IN (" . $glance_news_forum_id . ")";
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query total topics information", "", __LINE__, __FILE__, $sql);
        }
        $row = $db->sql_fetchrow($result);
        $overall_news_topics = $row['topic_total'];
        $db->sql_freeresult($result);
        // MOD NAV END
    }

    //
    // GET THE LAST 5 TOPICS
    //
    if ( $glance_num_recent !== 0 )
    {
        $glance_auth_level = ( $glance_auth_read !== 0 ) ? AUTH_VIEW : AUTH_ALL;
        $is_auth_ary = auth($glance_auth_level, AUTH_LIST_ALL, $userdata);

        $forumsignore = $glance_news_forum_id;
        if ( ($num_forums = is_countable($is_auth_ary) ? count($is_auth_ary) : 0) !== 0 )
        {
            foreach ($is_auth_ary as $forum_id => $auth_mod) {
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
                    $forumsignore .= ($forumsignore) ? ',' . $forum_id : $forum_id;
                }
            }
        }

        $forumsignore .= ($forumsignore && $glance_recent_ignore) ? ',' : '';
        $glance_recent_ignore = $glance_recent_ignore ?: '';

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

        $sql .= ($glance_recent_offset !== 0) ? " LIMIT " . $glance_recent_offset . ", " . $glance_num_recent : " LIMIT " . $glance_num_recent;

        if( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query latest topic information", "", __LINE__, __FILE__, $sql);
        }
        $latest_topics = [];
        $latest_anns = [];
        $latest_stickys = [];
        while ( $topic_row = $db->sql_fetchrow($result) )
        {
            $topic_row['topic_title'] = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, (string) $topic_row['topic_title']) : $topic_row['topic_title'];
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
        $latest_topics = [...$latest_anns, ...$latest_stickys, ...$latest_topics];
        $db->sql_freeresult($result);

        // MOD NAV BEGIN
        // obtain the total number of topic for our recent topic navigation bit
        $sql = "SELECT SUM(forum_topics) as topic_total FROM " . FORUMS_TABLE . " f WHERE f.forum_id NOT IN (" . $forumsignore . $glance_recent_ignore . $glance_news_forum_id . ")";
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Could not query total topics information", "", __LINE__, __FILE__, $sql);
        }
        $row = $db->sql_fetchrow($result);
        $overall_total_topics = $row['topic_total'];
        $db->sql_freeresult($result);
        // MOD NAV END
    }

    //
    // BEGIN OUTPUT
    //
    $template->set_filenames(['glance_output' => 'glance_body.tpl']
    );

    if ( $glance_num_news !== 0 )
    {
        if ( $latest_news !== [] )
        {
            $bullet_pre = '<img src="';

            foreach ($latest_news as $i => $latest_RectorPrefix202212news) {
                if ( $userdata['session_logged_in'] )
                {
                    $unread_topics = false;
                    $glance_topic_id = $latest_RectorPrefix202212news['topic_id'];
                    if ( $latest_RectorPrefix202212news['post_time'] > $glance_last_visit )
                    {
                        $unread_topics = true;
                        if( !empty($tracking_topics[$glance_topic_id]) && $glance_track && $tracking_topics[$glance_topic_id] >= $latest_RectorPrefix202212news['post_time'] )
                        {
                            $unread_topics = false;
                        }
                    }
                    $shownew = $unread_topics;
                }
                else
                {
                    $unread_topics = false;
                    $shownew = ($board_config['time_today'] < $latest_RectorPrefix202212news['post_time']);
                }
                $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ?  $images['folder_announce_new'] :  $images['folder_announce'] ) . '" border="0" alt="" />';
                $newest_code = ( $unread_topics && $glance_show_new_bullets ) ? '&amp;view=newest' : '';
                $topic_link = $glance_forum_dir . 'viewtopic&amp;t=' . $latest_RectorPrefix202212news['topic_id'] . $newest_code;
                if ($board_config['glance_rowclass'] == 1):
                    $row_class = ($count_topics % 2 !== 0) ? "row3" : "row1";
                    $count_topics += 1;
                else:
                    $row_class = 'row1';
                endif;
                //
                // MOD TODAY AT BEGIN
                //
                //if ( $board_config['time_today'] < $latest_news[$i]['post_time'])
                //{
                //    $last_post_time = sprintf($lang['Today_at'], create_date($board_config['default_timeformat'], $latest_news[$i]['post_time'], $board_config['board_timezone']));
                //}
                //else if ( $board_config['time_yesterday'] < $latest_topics[$i]['post_time'])
                //{
                //    $last_post_time = sprintf($lang['Yesterday_at'], create_date($board_config['default_timeformat'], $latest_news[$i]['post_time'], $board_config['board_timezone']));
                //}
                // MOD TODAY AT END
                /*****[BEGIN]******************************************
                 [ Mod:    Advanced Username Color             v1.0.5 ]
                 ******************************************************/
                $guest = (empty($latest_topics[$i]['post_username'])) ? $latest_topics[$i]['last_username'] . ' ' : $latest_topics[$i]['post_username'];
                $last_poster = ($latest_RectorPrefix202212news['poster_id'] == ANONYMOUS ) ? ( ($latest_RectorPrefix202212news['last_username'] != '' ) ? $guest : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_RectorPrefix202212news['poster_id']) . '">' . UsernameColor($latest_RectorPrefix202212news['last_username']) . '</a> ';
                $last_post_img = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $latest_RectorPrefix202212news['topic_last_post_id']) . '#' . $latest_RectorPrefix202212news['topic_last_post_id'] . '"><i class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$lang['View_latest_post'].'"></i></a>';
                $topic_poster = ($latest_RectorPrefix202212news['topic_poster'] == ANONYMOUS ) ? ( ($latest_RectorPrefix202212news['author_username'] != '' ) ? $guest : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_RectorPrefix202212news['topic_poster']) . '">' . UsernameColor($latest_RectorPrefix202212news['author_username']) . '</a> ';
                $last_post_time = create_date($board_config['default_dateformat'], $latest_RectorPrefix202212news['post_time'], $board_config['board_timezone']);
                /*****[END]********************************************
                 [ Mod:    Advanced Username Color             v1.0.5 ]
                 ******************************************************/
                /*****[BEGIN]******************************************
                 [ Mod:     Post Icons                         v1.0.1 ]
                 ******************************************************/
                $topic_icon = get_icon_title($latest_RectorPrefix202212news['topic_icon']);
                $topic_icon_id = $latest_RectorPrefix202212news['topic_icon'] = $latest_RectorPrefix202212news['topic_icon'] ?? '0';
                /*****[END]********************************************
                 [ Mod:     Post Icons                         v1.0.1 ]
                 ******************************************************/
                $template->assign_block_vars('news', [
                    'ROW_CLASS' => $row_class = $row_class ?? '',
                    'BULLET' => $bullet_full = $bullet_full ?? '',
                    'TOPIC_TITLE' => $latest_RectorPrefix202212news['topic_title'] = $latest_RectorPrefix202212news['topic_title'] ?? '',
                    'TOPIC_LINK' => $topic_link = $topic_link ?? '',
                    'TOPIC_TIME' => $last_post_time = $last_post_time ?? '',
                    /*****[BEGIN]******************************************
                     [ Mod:     Post Icons                         v1.0.1 ]
                     ******************************************************/
                    'ICON' => $topic_icon = $topic_icon ?? '',
                    'ICON_ID' => $topic_icon_id = $topic_icon_id ?? '0',
                    /*****[END]********************************************
                     [ Mod:     Post Icons                         v1.0.1 ]
                     ******************************************************/
                    'TOPIC_POSTER' => sprintf($lang['Recent_started_by'],$topic_poster),
                    'TOPIC_VIEWS' => $latest_RectorPrefix202212news['topic_views'],
                    'TOPIC_REPLIES' => $latest_RectorPrefix202212news['topic_replies'],
                    'LAST_POSTER' => sprintf(trim((string) $lang['Recent_first_poster']),$last_poster),
                    'LAST_POST_IMG' => $last_post_img = $last_post_img ?? '',
                    'FORUM_TITLE' => $latest_RectorPrefix202212news['forum_name'],
                    'FORUM_COLOR' => ' style="color: #'.$latest_RectorPrefix202212news['forum_color'].';"',
                    'FORUM_LINK' => $glance_forum_dir . 'viewforum&amp;f=' . $latest_RectorPrefix202212news['forum_id'],
                ]

                    );
            }
            // MOD NAV BEGIN
            if ($glance_news_offset > 0 || $glance_news_offset+$glance_num_news < $overall_news_topics)
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
            $template->assign_block_vars('news', ['BULLET' => '<img src="' . $images['folder'] . '" border="0" alt="" />', $glance_recent_bullet_old, 'TOPIC_TITLE' => 'None']
            );
        }
    }

    if ( $glance_num_recent !== 0 )
    {
        $glance_info = 'counted recent';
        $bullet_pre = '<img src="';
        if ( $latest_topics !== [] )
        {
            foreach ($latest_topics as $i => $latest_topic) {
                if ( $userdata['session_logged_in'] )
                {
                    $unread_topics = false;
                    $glance_topic_id = $latest_topic['topic_id'];
                    if ( $latest_topic['post_time'] > $glance_last_visit )
                    {
                        $unread_topics = true;
                        if( !empty($tracking_topics[$glance_topic_id]) && $glance_track && $tracking_topics[$glance_topic_id] >= $latest_topic['post_time'] )
                        {
                            $unread_topics = false;
                        }
                    }
                    $shownew = $unread_topics;
                }
                else
                {

					$unread_topics = false;
					
                    $shownew = (isset($board_config['time_today']) < $latest_topic['post_time']);
                }
                switch ($latest_topic['topic_type'])
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
                        if ($latest_topic['topic_status'] == TOPIC_LOCKED) {
                            $folder = $images['folder_locked'];
                            $folder_new = $images['folder_locked_new'];
                        } elseif ($latest_topic['topic_replies'] >= $board_config['hot_threshold']) {
                            $folder = $images['folder_hot'];
                            $folder_new = $images['folder_hot_new'];
                        } else
                        {
                            $folder = $images['folder'];
                            $folder_new = $images['folder_new'];
                        }

                        $bullet_full = $bullet_pre . ( ( $shownew && $glance_show_new_bullets ) ? $folder_new :  $folder ) . '" border="0" alt="" />';
                        break;
                }
                $newest_code = ( $unread_topics && $glance_show_new_bullets ) ? '&amp;view=newest' : '';
                $topic_link = $glance_forum_dir . 'viewtopic&amp;t=' . $latest_topic['topic_id'] . $newest_code;
                
				if(!isset($count_topics))
				$count_topics = 0;
				
				if ($board_config['glance_rowclass'] == 1):
                    $row_class = ($count_topics % 2 !== 0) ? "row3" : "row1";
                    $count_topics += 1;
                else:
                    $row_class = 'row1';
                endif;
                /*****[BEGIN]******************************************
                 [ Mod:    Advanced Username Color             v1.0.5 ]
                 ******************************************************/
                $guest = (empty($latest_topic['post_username'])) ? $latest_topic['last_username'] . ' ' : $latest_topic['post_username'];
                $topic_poster = ($latest_topic['topic_poster'] == ANONYMOUS ) ? ( ($latest_topic['author_username'] != '' ) ? $guest : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topic['topic_poster']) . '">' . UsernameColor($latest_topic['author_username']) . '</a> ';
                $last_post_time = create_date($board_config['default_dateformat'], $latest_topic['post_time'], $board_config['board_timezone']);
                $last_poster = ($latest_topic['poster_id'] == ANONYMOUS ) ? ( ($latest_topic['last_username'] != '' ) ? $guest : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $latest_topic['poster_id']) . '">' . UsernameColor($latest_topic['last_username']) . '</a> ';
                /*****[END]********************************************
                 [ Mod:    Advanced Username Color             v1.0.5 ]
                 ******************************************************/
                $last_post_img = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $latest_topic['topic_last_post_id']) . '#' . $latest_topic['topic_last_post_id'] . '"><i class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$lang['View_latest_post'].'"></i></a>';
                //
                // MOD TODAY AT BEGIN
                //
                //if ( $board_config['time_today'] < $latest_topics[$i]['post_time'])
                //{
                //    $last_post_time = sprintf($lang['Today_at'], create_date($board_config['default_timeformat'], $latest_topics[$i]['post_time'], $board_config['board_timezone']));
                //}
                //else if ( $board_config['time_yesterday'] < $latest_topics[$i]['post_time'])
                //{
                //    $last_post_time = sprintf($lang['Yesterday_at'], create_date($board_config['default_timeformat'], $latest_topics[$i]['post_time'], $board_config['board_timezone']));
                //}
                // MOD TODAY AT END
                /*****[BEGIN]******************************************
                 [ Mod:     Post Icons                         v1.0.1 ]
                 ******************************************************/
                $topic_icon = get_icon_title($latest_topic['topic_icon']);
                $topic_icon_id = $latest_topic['topic_icon'] = $latest_topic['topic_icon'] ?? '0';
                /*****[END]********************************************
                 [ Mod:     Post Icons                         v1.0.1 ]
                 ******************************************************/
                $template->assign_block_vars('recent', [
                    'ROW_CLASS' => $row_class,
                    'BULLET' => $bullet_full,
                    'TOPIC_LINK' => $topic_link,
                    /*****[BEGIN]******************************************
                     [ Mod:     Smilies in Topic Titles            v1.0.0 ]
                     [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
                     ******************************************************/
                    'TOPIC_TITLE' => ($board_config['smilies_in_titles']) ? smilies_pass($latest_topic['topic_title']) : $latest_topic['topic_title'],
                    /*****[END]********************************************
                     [ Mod:     Smilies in Topic Titles            v1.0.0 ]
                     [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
                     ******************************************************/
                    /*****[BEGIN]******************************************
                     [ Mod:     Post Icons                         v1.0.1 ]
                     ******************************************************/
                    'ICON' => $topic_icon,
                    'ICON_ID' => $topic_icon_id = $topic_icon_id ?? '0',
                    /*****[END]********************************************
                     [ Mod:     Post Icons                         v1.0.1 ]
                     ******************************************************/
                    // 'TOPIC_POSTER' => $topic_poster,
                    'TOPIC_POSTER' => sprintf($lang['Recent_started_by'],$topic_poster),
                    'TOPIC_VIEWS' => $latest_topic['topic_views'],
                    'TOPIC_REPLIES' => $latest_topic['topic_replies'],
                    'LAST_POST_TIME' => $last_post_time,
                    'LAST_POSTER' => sprintf(trim((string) $lang['Recent_first_poster']),$last_poster),
                    'LAST_POST_IMG' => $last_post_img,
                    'FORUM_TITLE' => $latest_topic['forum_name'],
                    'FORUM_COLOR' => ' style="color: #'.$latest_topic['forum_color'].';"',
                    'FORUM_LINK' => $glance_forum_dir . 'viewforum&amp;f=' . $latest_topic['forum_id'],
                ]
                );
            }

            // MOD NAV BEGIN
            if ($glance_recent_offset > 0 || $glance_recent_offset+$glance_num_recent < $overall_total_topics)
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
            $template->assign_block_vars('recent', ['BULLET' => '<img src="' . $images['forum'] . '" alt="" />', $glance_recent_bullet_old = $glance_recent_bullet_old ?? '', 'TOPIC_TITLE' => 'None']
            );
        }
    }

    if ( $glance_num_news !== 0 )
    {
        $template->assign_block_vars('switch_glance_news', ['NEXT_URL' => $next_news_url, 'PREV_URL' => $prev_news_url]
        );

        // MOD CAT ROLLOUT BEGIN
        //$news_on = !isset($HTTP_COOKIE_VARS['phpbbGlance_news']) || !empty($HTTP_COOKIE_VARS['phpbbGlance_news']) ? true : false;
        //if( $news_on )
        //{
        //   $template->assign_block_vars('switch_glance_news.switch_news_on', array());
        //}
        //else
        //{
        //    $template->assign_block_vars('switch_glance_news.switch_news_off', array());
        //}
        // MOD CAT ROLLOUT END
    }
    if ( $glance_num_recent !== 0 )
    {
        $next_recent_url ??= '';
        $prev_recent_url ??= '';

        $template->assign_block_vars('switch_glance_recent', ['NEXT_URL' => $next_recent_url, 'PREV_URL' => $prev_recent_url]
        );

        // MOD CAT ROLLOUT BEGIN
        //$recent_on = !isset($HTTP_COOKIE_VARS['phpbbGlance_recent']) || !empty($HTTP_COOKIE_VARS['phpbbGlance_recent']) ? true : false;
        //if( $recent_on )
        //{
        //    $template->assign_block_vars('switch_glance_recent.switch_recent_on', array());
        //}
        //else
        //{
        //   $template->assign_block_vars('switch_glance_recent.switch_recent_off', array());
        //}
        // MOD CAT ROLLOUT END
    }

    $template->assign_vars(['GLANCE_TABLE_WIDTH' =>    $glance_table_width, 'RECENT_HEADING' => $glance_recent_heading, 'NEWS_HEADING' => $glance_news_heading, 'L_TOPICS' => $lang['Topics'], 'L_REPLIES' => $lang['Replies'], 'L_VIEWS' => $lang['Views'], 'L_LASTPOST' => $lang['Last_Post'], 'L_FORUM' => $lang['Forum'], 'L_AUTHOR' => $lang['Author']]
        );

    $template->assign_var_from_handle('GLANCE_OUTPUT', 'glance_output');

// THE END

?>
