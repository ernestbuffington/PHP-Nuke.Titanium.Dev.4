    <?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************

     *                                search.php

     *                            -------------------

     *   begin                : Saturday, Feb 13, 2001

     *   copyright            : (C) 2001 The phpBB Group

     *   email                : support@phpbb.com

     *

     *   Id: search.php,v 1.72.2.16 2005/03/15 18:34:34 acydburn Exp

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

          Nuke Patched                             v3.1.0       06/26/2005

    -=[Mod]=-

          Advanced Username Color                  v1.0.5       06/11/2005

          Global Announcements                     v1.2.8       06/13/2005

          Search Only Subject                      v0.9.1       06/15/2005

          Smilies in Topic Titles                  v1.0.0       07/29/2005

          Smilies in Topic Titles Toggle           v1.0.0       09/10/2005

          Hide BBCode                              v1.2.0

     ************************************************************************/
if (!defined('MODULE_FILE')) {
    die("You can't access this file directly...");
}
if ($popup != "1") {
    $titanium_module_name = basename(dirname(__FILE__));
    require ("modules/" . $titanium_module_name . "/nukebb.php");
} else {
    $phpbb2_root_path = NUKE_FORUMS_DIR;
}
define('IN_PHPBB2', true);
include ($phpbb2_root_path . 'extension.inc');
include ($phpbb2_root_path . 'common.' . $phpEx);
include ("includes/bbcode.php");
include ("includes/functions_search.php");
//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, TITANIUM_PAGE_SEARCH);
titanium_init_userprefs($userdata);
//
// End session management
//
//
// Define initial vars
//
if (isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode'])) {
    $mode = (isset($HTTP_POST_VARS['mode'])) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
} else {
    $mode = '';
}
if (isset($HTTP_POST_VARS['search_keywords']) || isset($HTTP_GET_VARS['search_keywords'])) {
    $search_keywords = (isset($HTTP_POST_VARS['search_keywords'])) ? $HTTP_POST_VARS['search_keywords'] : $HTTP_GET_VARS['search_keywords'];
} else {
    $search_keywords = '';
}
if (isset($HTTP_POST_VARS['search_author']) || isset($HTTP_GET_VARS['search_author'])) {
    $search_author = (isset($HTTP_POST_VARS['search_author'])) ? $HTTP_POST_VARS['search_author'] : $HTTP_GET_VARS['search_author'];
    $search_author = phpbb_clean_username($search_author);
} else {
    $search_author = '';
}
$search_id = (isset($HTTP_GET_VARS['search_id'])) ? $HTTP_GET_VARS['search_id'] : '';
$show_results = (isset($HTTP_POST_VARS['show_results'])) ? $HTTP_POST_VARS['show_results'] : 'posts';
$show_results = ($show_results == 'topics') ? 'topics' : 'posts';
if (isset($HTTP_POST_VARS['search_terms'])) {
    $search_terms = ($HTTP_POST_VARS['search_terms'] == 'all') ? 1 : 0;
} else {
    $search_terms = 0;
}
if (isset($HTTP_POST_VARS['search_fields'])) {
    $search_fields = ($HTTP_POST_VARS['search_fields'] == 'all') ? 1 : 0;
} else {
    $search_fields = 0;
}
$return_chars = (isset($HTTP_POST_VARS['return_chars'])) ? intval($HTTP_POST_VARS['return_chars']) : 200;
$search_cat = (isset($HTTP_POST_VARS['search_cat'])) ? intval($HTTP_POST_VARS['search_cat']) : -1;
$search_forum = (isset($HTTP_POST_VARS['search_forum'])) ? intval($HTTP_POST_VARS['search_forum']) : -1;
$sort_by = (isset($HTTP_POST_VARS['sort_by'])) ? intval($HTTP_POST_VARS['sort_by']) : 0;
if (isset($HTTP_POST_VARS['sort_dir'])) {
    $sort_dir = ($HTTP_POST_VARS['sort_dir'] == 'DESC') ? 'DESC' : 'ASC';
} else {
    $sort_dir = 'DESC';
}
if (!empty($HTTP_POST_VARS['search_time']) || !empty($HTTP_GET_VARS['search_time'])) {
    $search_time = time() - (((!empty($HTTP_POST_VARS['search_time'])) ? intval($HTTP_POST_VARS['search_time']) : intval($HTTP_GET_VARS['search_time'])) * 86400);
    $topic_days = (!empty($HTTP_POST_VARS['search_time'])) ? intval($HTTP_POST_VARS['search_time']) : intval($HTTP_GET_VARS['search_time']);
} else {
    $search_time = 0;
    $topic_days = 0;
}
$phpbb2_start = (isset($HTTP_GET_VARS['start'])) ? intval($HTTP_GET_VARS['start']) : 0;
$phpbb2_start = ($phpbb2_start < 0) ? 0 : $phpbb2_start;
$sort_by_types = array($titanium_lang['Sort_Time'], $titanium_lang['Sort_Post_Subject'], $titanium_lang['Sort_Topic_Title'], $titanium_lang['Sort_Author'], $titanium_lang['Sort_Forum']);
//
// encoding match for workaround
//
$multibyte_charset = 'utf-8, big5, shift_jis, euc-kr, gb2312';

$split_search = array();

//
// Begin core code
//
if ($mode == 'searchuser') {
    //
    // This handles the simple windowed user search functions called from various other scripts
    //
    if (isset($HTTP_POST_VARS['search_username'])) {
        username_search($HTTP_POST_VARS['search_username']);
    } else {
        username_search('');
    }
    exit;
} else if ($search_keywords != '' || $search_author != '' || $search_id) {
    $store_vars = array('search_results', 'total_match_count', 'split_search', 'sort_by', 'sort_dir', 'show_results', 'return_chars');
    $search_results = '';
    //
    // Search ID Limiter, decrease this value if you experience further timeout problems with searching forums
    $limiter = 5000;
    $current_time = time();
    //
    // Cycle through options ...
    //
    if ($search_id == 'newposts' || $search_id == 'egosearch' || $search_id == 'unanswered' || $search_keywords != '' || $search_author != '') {
        //
        // Flood control
        //
        $where_sql = ($userdata['user_id'] == ANONYMOUS || empty($userdata['user_id'])) ? "se.session_ip = '$titanium_user_ip'" : 'se.session_user_id = ' . $userdata['user_id'];
        $sql = 'SELECT MAX(sr.search_time) AS last_search_time

             FROM ' . SEARCH_TABLE . ' sr, ' . SESSIONS_TABLE . " se

             WHERE sr.session_id = se.session_id

             AND $where_sql";
        if ($result = $titanium_db->sql_query($sql)) {
            if ($row = $titanium_db->sql_fetchrow($result)) {
                if (intval($row['last_search_time']) > 0 && ($current_time - intval($row['last_search_time'])) < intval($phpbb2_board_config['search_flood_interval'])) {
                    message_die(GENERAL_MESSAGE, $titanium_lang['Search_Flood_Error']);
                }
            }
        }
        if ($search_id == 'newposts' || $search_id == 'egosearch' || ($search_author != '' && $search_keywords == '')) {
            if ($search_id == 'newposts') {
                if ($userdata['session_logged_in']) {
                    $sql = "SELECT post_id

                    FROM " . POSTS_TABLE . "

                    WHERE post_time >= " . $userdata['user_lastvisit'];
                } else {
                    redirect_titanium(append_titanium_sid("login.$phpEx?redirect=search.$phpEx&search_id=newposts", true));
                }
                $show_results = 'topics';
                $sort_by = 0;
                $sort_dir = 'DESC';
            } else if ($search_id == 'egosearch') {
                if ($userdata['session_logged_in']) {
                    $sql = "SELECT post_id

                    FROM " . POSTS_TABLE . "

                    WHERE poster_id = " . $userdata['user_id'];
                } else {
                    redirect_titanium(append_titanium_sid("login.$phpEx?redirect=search.$phpEx&search_id=egosearch", true));
                }
                $show_results = 'topics';
                $sort_by = 0;
                $sort_dir = 'DESC';
            } else {
                $search_author = str_replace('*', '%', trim($search_author));
                if ((strpos($search_author, '%') !== false) && (strlen(str_replace('%', '', $search_author)) < $phpbb2_board_config['search_min_chars'])) {
                    $search_author = '';
                }
                $sql = "SELECT user_id

            FROM " . USERS_TABLE . "

            WHERE username LIKE '" . str_replace("\'", "''", $search_author) . "'";
                if (!($result = $titanium_db->sql_query($sql))) {
                    message_die(GENERAL_ERROR, "Couldn't obtain list of matching users (searching for: $search_author)", "", __LINE__, __FILE__, $sql);
                }
                $matching_userids = '';
                if ($row = $titanium_db->sql_fetchrow($result)) {
                    do {
                        $matching_userids.= (($matching_userids != '') ? ', ' : '') . $row['user_id'];
                    } while ($row = $titanium_db->sql_fetchrow($result));
                } else {
                    message_die(GENERAL_MESSAGE, $titanium_lang['No_search_match']);
                }
                $sql = "SELECT post_id

            FROM " . POSTS_TABLE . "

            WHERE poster_id IN ($matching_userids)";
                if ($search_time) {
                    $sql.= " AND post_time >= " . $search_time;
                }
            } if (!($result = $titanium_db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not obtain matched posts list', '', __LINE__, __FILE__, $sql);
            }
            $search_ids = array();
            while ($row = $titanium_db->sql_fetchrow($result)) {
                $search_ids[] = $row['post_id'];
            }
            $titanium_db->sql_freeresult($result);
            $total_phpbb2_match_count = count($search_ids);
        } else if ($search_keywords != '') {
            $stopword_array = @file($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/search_stopwords.txt');
            $synonym_array = @file($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/search_synonyms.txt');
            $split_search = array();
            $stripped_keywords = stripslashes($search_keywords);
            $split_search = (!strstr($multibyte_charset, $titanium_lang['ENCODING'])) ? split_words(clean_words('search', $stripped_keywords, $stopword_array, $synonym_array), 'search') : split(' ', $search_keywords);
            unset($stripped_keywords);
            /*****[BEGIN]******************************************
            
            [ Mod:    Search Only Subject                 v0.9.1 ]
            
            ******************************************************/
            $search_fields = ($HTTP_POST_VARS['search_fields'] == 'all') ? 1 : (($HTTP_POST_VARS['search_fields'] == 'subjonly') ? 2 : 0);
            switch ($search_fields) {
                case 0:
                    $search_msg_only = "AND m.title_match = 0";
                break;
                case 1:
                    $search_msg_only = "";
                break;
                case 2:
                    $search_msg_only = "AND m.title_match > 0";
                break;
                default:
                    $search_msg_only = "AND m.title_match = 0";
            }
            /*****[END]********************************************
            
            [ Mod:    Search Only Subject                 v0.9.1 ]
            
            ******************************************************/
            $word_count = 0;
            $current_match_type = 'or';
            $word_match = array();
            $result_list = array();
            for ($i = 0;$i < count($split_search);$i++) {
                if (strlen(str_replace(array('*', '%'), '', trim($split_search[$i]))) < $phpbb2_board_config['search_min_chars']) {
                    $split_search[$i] = '';
                    continue;
                }
                switch ($split_search[$i]) {
                    case 'and':
                        $current_match_type = 'and';
                    break;
                    case 'or':
                        $current_match_type = 'or';
                    break;
                    case 'not':
                        $current_match_type = 'not';
                    break;
                    default:
                        if (!empty($search_terms)) {
                            $current_match_type = 'and';
                        }
                        if (!strstr($multibyte_charset, $titanium_lang['ENCODING'])) {
                            $match_word = str_replace('*', '%', $split_search[$i]);
                            $sql = "SELECT m.post_id

                FROM " . SEARCH_WORD_TABLE . " w, " . SEARCH_MATCH_TABLE . " m

                WHERE w.word_text LIKE '$match_word'

                AND m.word_id = w.word_id

                AND w.word_common <> '1'

                $search_msg_only";
                        } else {
                            $match_word = addslashes('%' . str_replace('*', '', $split_search[$i]) . '%');
                            $search_msg_only = ($search_fields) ? "OR post_subject LIKE '$match_word'" : '';
                            $sql = "SELECT post_id

                FROM " . POSTS_TEXT_TABLE . "

                WHERE post_text LIKE '$match_word'

                $search_msg_only";
                        }
                        if (!($result = $titanium_db->sql_query($sql))) {
                            message_die(GENERAL_ERROR, 'Could not obtain matched posts list', '', __LINE__, __FILE__, $sql);
                        }
                        $row = array();
                        while ($temp_row = $titanium_db->sql_fetchrow($result)) {
                            $row[$temp_row['post_id']] = 1;
                            if (!$word_count) {
                                $result_list[$temp_row['post_id']] = 1;
                            } else if ($current_match_type == 'or') {
                                $result_list[$temp_row['post_id']] = 1;
                            } else if ($current_match_type == 'not') {
                                $result_list[$temp_row['post_id']] = 0;
                            }
                        }
                        if ($current_match_type == 'and' && $word_count) {
                            @reset($result_list);
                            while (list($post_id, $match_count) = @each($result_list)) {
                                if (!$row[$post_id]) {
                                    $result_list[$post_id] = 0;
                                }
                            }
                        }
                        $word_count++;
                        $titanium_db->sql_freeresult($result);
                    }
                }
                @reset($result_list);
                $search_ids = array();
                while (list($post_id, $matches) = each($result_list)) {
                    if ($matches) {
                        $search_ids[] = $post_id;
                    }
                }
                unset($result_list);
                $total_phpbb2_match_count = count($search_ids);
        }
        //
        // If user is logged in then we'll check to see which (if any) private
        // forums they are allowed to view and include them in the search.
        //
        // If not logged in we explicitly prevent searching of private forums
        //
        $passdata = (isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_fpass'])) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_fpass'])) : '';
        $auth_sql = '';
        if ($search_forum != - 1) {
            $phpbb2_is_auth = auth(AUTH_ALL, $search_forum, $userdata);
            $has_access = true;
            if (!$phpbb2_is_auth['auth_mod'] && $userdata['user_level'] != ADMIN) {
                $sql = "SELECT forum_password FROM " . FORUMS_TABLE . " WHERE forum_id = " . $search_forum;
                if (!$result = $titanium_db->sql_query($sql)) {
                    message_die(GENERAL_ERROR, 'Could not retrieve forum password information', '', __LINE__, __FILE__, $sql);
                }
                $row = $titanium_db->sql_fetchrow($result);
                $titanium_db->sql_freeresult($result);
                if ($row['forum_password'] != '' && $passdata[$key] != md5($row['forum_password'])) {
                    $has_access = false;
                }
            }
            if (!$phpbb2_is_auth['auth_read'] || !$has_access) {
                message_die(GENERAL_MESSAGE, $titanium_lang['No_searchable_forums']);
            }
            $auth_sql = "f.forum_id = $search_forum";
        } else {
            $phpbb2_is_auth_ary = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
            if ($search_cat != - 1) {
                $auth_sql = "f.cat_id = $search_cat";
            }
            $ignore_forum_sql = '';
            while (list($key, $value) = each($phpbb2_is_auth_ary)) {
                $has_access = true;
                if (!$phpbb2_is_auth['auth_mod'] && $userdata['user_level'] != ADMIN) {
                    $sql = "SELECT forum_password FROM " . FORUMS_TABLE . " WHERE forum_id = " . $key;
                    if (!$result = $titanium_db->sql_query($sql)) {
                        message_die(GENERAL_ERROR, 'Could not retrieve forum password information', '', __LINE__, __FILE__, $sql);
                    }
                    $row = $titanium_db->sql_fetchrow($result);
                    $titanium_db->sql_freeresult($result);
                    if ($row['forum_password'] != '' && $passdata[$key] != md5($row['forum_password'])) {
                        $has_access = false;
                    }
                }
                if (!$value['auth_read'] || !$has_access) {
                    $ignore_forum_sql.= (($ignore_forum_sql != '') ? ', ' : '') . $key;
                }
            }
            if ($ignore_forum_sql != '') {
                $auth_sql.= ($auth_sql != '') ? " AND f.forum_id NOT IN ($ignore_forum_sql) " : "f.forum_id NOT IN ($ignore_forum_sql) ";
            }
        }
        //
        // Author name search
        //
        if ($search_author != '') {
            $search_author = str_replace('*', '%', trim($search_author));
            if ((strpos($search_author, '%') !== false) && (strlen(str_replace('%', '', $search_author)) < $phpbb2_board_config['search_min_chars'])) {
                $search_author = '';
            }
        }
        if ($total_phpbb2_match_count) {
            if ($show_results == 'topics') {
                //
                // This one is a beast, try to seperate it a bit (workaround for connection timeouts)
                //
                $search_id_chunks = array();
                $count = 0;
                $chunk = 0;
                if (count($search_ids) > $limiter) {
                    for ($i = 0;$i < count($search_ids);$i++) {
                        if ($count == $limiter) {
                            $chunk++;
                            $count = 0;
                        }
                        $search_id_chunks[$chunk][$count] = $search_ids[$i];
                        $count++;
                    }
                } else {
                    $search_id_chunks[0] = $search_ids;
                }
                $search_ids = array();
                for ($i = 0;$i < count($search_id_chunks);$i++) {
                    $where_sql = '';
                    if ($search_time) {
                        $where_sql.= ($search_author == '' && $auth_sql == '') ? " AND post_time >= '$search_time' " : " AND p.post_time >= '$search_time' ";
                    }
                    if ($search_author == '' && $auth_sql == '') {
                        $sql = "SELECT topic_id

                    FROM " . POSTS_TABLE . "

                    WHERE post_id IN (" . implode(", ", $search_id_chunks[$i]) . ")

                    $where_sql

                    GROUP BY topic_id";
                    } else {
                        $from_sql = POSTS_TABLE . " p";
                        if ($search_author != '') {
                            $from_sql.= ", " . USERS_TABLE . " u";
                            $where_sql.= " AND u.user_id = p.poster_id AND u.username LIKE '$search_author' ";
                        }
                        if ($auth_sql != '') {
                            $from_sql.= ", " . FORUMS_TABLE . " f";
                            $where_sql.= " AND f.forum_id = p.forum_id AND $auth_sql";
                        }
                        $sql = "SELECT p.topic_id

                    FROM $from_sql

                    WHERE p.post_id IN (" . implode(", ", $search_id_chunks[$i]) . ")

                    $where_sql

                    GROUP BY p.topic_id";
                    }
                    if (!($result = $titanium_db->sql_query($sql))) {
                        message_die(GENERAL_ERROR, 'Could not obtain topic ids', '', __LINE__, __FILE__, $sql);
                    }
                    while ($row = $titanium_db->sql_fetchrow($result)) {
                        $search_ids[] = $row['topic_id'];
                    }
                    $titanium_db->sql_freeresult($result);
                }
                $total_phpbb2_match_count = count($search_ids);
            } else if ($search_author != '' || $search_time || $auth_sql != '') {
                $search_id_chunks = array();
                $count = 0;
                $chunk = 0;
                if (count($search_ids) > $limiter) {
                    for ($i = 0;$i < count($search_ids);$i++) {
                        if ($count == $limiter) {
                            $chunk++;
                            $count = 0;
                        }
                        $search_id_chunks[$chunk][$count] = $search_ids[$i];
                        $count++;
                    }
                } else {
                    $search_id_chunks[0] = $search_ids;
                }
                $search_ids = array();
                for ($i = 0;$i < count($search_id_chunks);$i++) {
                    $where_sql = ($search_author == '' && $auth_sql == '') ? 'post_id IN (' . implode(', ', $search_id_chunks[$i]) . ')' : 'p.post_id IN (' . implode(', ', $search_id_chunks[$i]) . ')';
                    $select_sql = ($search_author == '' && $auth_sql == '') ? 'post_id' : 'p.post_id';
                    $from_sql = ($search_author == '' && $auth_sql == '') ? POSTS_TABLE : POSTS_TABLE . ' p';
                    if ($search_time) {
                        $where_sql.= ($search_author == '' && $auth_sql == '') ? " AND post_time >= $search_time " : " AND p.post_time >= $search_time";
                    }
                    if ($auth_sql != '') {
                        $from_sql.= ", " . FORUMS_TABLE . " f";
                        $where_sql.= " AND f.forum_id = p.forum_id AND $auth_sql";
                    }
                    if ($search_author != '') {
                        $from_sql.= ", " . USERS_TABLE . " u";
                        $where_sql.= " AND u.user_id = p.poster_id AND u.username LIKE '$search_author'";
                    }
                    $sql = "SELECT " . $select_sql . "

                FROM ($from_sql)

                WHERE $where_sql";
                    if (!($result = $titanium_db->sql_query($sql))) {
                        message_die(GENERAL_ERROR, 'Could not obtain post ids', '', __LINE__, __FILE__, $sql);
                    }
                    while ($row = $titanium_db->sql_fetchrow($result)) {
                        $search_ids[] = $row['post_id'];
                    }
                    $titanium_db->sql_freeresult($result);
                }
                $total_phpbb2_match_count = count($search_ids);
            }
        } else if ($search_id == 'unanswered') {
            if ($auth_sql != '') {
                $sql = "SELECT t.topic_id, f.forum_id

            FROM (" . TOPICS_TABLE . "  t, " . FORUMS_TABLE . " f)

            WHERE t.topic_replies = '0'

            AND t.forum_id = f.forum_id

            AND t.topic_moved_id = '0'

            AND $auth_sql";
            } else {
                $sql = "SELECT topic_id

            FROM " . TOPICS_TABLE . "

            WHERE topic_replies = '0'

            AND topic_moved_id = '0'";
            }
            if (!($result = $titanium_db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not obtain post ids', '', __LINE__, __FILE__, $sql);
            }
            $search_ids = array();
            while ($row = $titanium_db->sql_fetchrow($result)) {
                $search_ids[] = $row['topic_id'];
            }
            $titanium_db->sql_freeresult($result);
            $total_phpbb2_match_count = count($search_ids);
            //
            // Basic requirements
            //
            $show_results = 'topics';
            $sort_by = 0;
            $sort_dir = 'DESC';
        } else {
            message_die(GENERAL_MESSAGE, $titanium_lang['No_search_match']);
        }
        //
        // Delete old data from the search result table
        //
        $sql = 'DELETE FROM ' . SEARCH_TABLE . '

    WHERE search_time < ' . ($current_time - (int)$phpbb2_board_config['session_length']);
        if (!$result = $titanium_db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not delete old search id sessions', '', __LINE__, __FILE__, $sql);
        }
        //
        // Store new result data
        //
        $search_results = implode(', ', $search_ids);
        $per_page = ($show_results == 'posts') ? $phpbb2_board_config['posts_per_page'] : $phpbb2_board_config['topics_per_page'];
        //
        // Combine both results and search data (apart from original query)
        // so we can serialize it and place it in the DB
        //
        $store_search_data = array();
        //
        // Limit the character length (and with this the results displayed at all following pages) to prevent
        // truncated result arrays. Normally, search results above 12000 are affected.
        // - to include or not to include
        /*
        
            $max_result_length = 60000;
        
            if (strlen($search_results) > $max_result_length)
        
            {
        
                $search_results = substr($search_results, 0, $max_result_length);
        
                $search_results = substr($search_results, 0, strrpos($search_results, ','));
        
                $total_phpbb2_match_count = count(explode(', ', $search_results));
        
            }
        
        */
        for ($i = 0;$i < count($store_vars);$i++) {
            $store_search_data[$store_vars[$i]] = $$store_vars[$i];
        }
        $result_array = serialize($store_search_data);
        unset($store_search_data);
        mt_srand((double)microtime() * 1000000);
        $search_id = mt_rand();
        $sql = "UPDATE " . SEARCH_TABLE . "

            SET search_id = $search_id, search_time = $current_time, search_array = '" . str_replace("\'", "''", $result_array) . "'

            WHERE session_id = '" . $userdata['session_id'] . "'";
        if (!($result = $titanium_db->sql_query($sql)) || !$titanium_db->sql_affectedrows()) {
            $sql = "INSERT INTO " . SEARCH_TABLE . " (search_id, session_id, search_time, search_array)

                VALUES($search_id, '" . $userdata['session_id'] . "', $current_time, '" . str_replace("\'", "''", $result_array) . "')";
            if (!($result = $titanium_db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not insert search results', '', __LINE__, __FILE__, $sql);
            }
        }
    } else {
        $search_id = intval($search_id);
        if ($search_id) {
            $sql = "SELECT search_array

                FROM " . SEARCH_TABLE . "

                WHERE search_id = '$search_id'

                AND session_id = '" . $userdata['session_id'] . "'";
            if (!($result = $titanium_db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not obtain search results', '', __LINE__, __FILE__, $sql);
            }
            if ($row = $titanium_db->sql_fetchrow($result)) {
                $search_data = unserialize($row['search_array']);
                for ($i = 0;$i < count($store_vars);$i++) {
                    $$store_vars[$i] = $search_data[$store_vars[$i]];
                }
            }
        }
    }
    //
    // Look up data ...
    //
    if ($search_results != '') {
        if ($show_results == 'posts') {
            /*****[BEGIN]******************************************
            
            [ Mod:    Advanced Username Color             v1.0.5 ]
            
            ******************************************************/
            $sql = "SELECT pt.post_text, pt.bbcode_uid, pt.post_subject, p.*, f.forum_id, f.forum_name, t.*, u.username, u.user_id, u.user_color_gc, u.user_sig, u.user_sig_bbcode_uid

     FROM (" . FORUMS_TABLE . " f, " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TEXT_TABLE . " pt)

     WHERE p.post_id IN ($search_results)

     AND pt.post_id = p.post_id

     AND f.forum_id = p.forum_id

     AND p.topic_id = t.topic_id

     AND p.poster_id = u.user_id";
            /*****[END]********************************************
            
            [ Mod:    Advanced Username Color             v1.0.5 ]
            
            ******************************************************/
        } else {
            /*****[BEGIN]******************************************
            
            [ Mod:    Advanced Username Color             v1.0.5 ]
            
            ******************************************************/
            $sql = "SELECT t.*, f.forum_id, f.forum_name, u.username, u.user_id, u.user_color_gc as color1, u2.user_color_gc as color2, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time

     FROM (" . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2)

     WHERE t.topic_id IN ($search_results)

     AND t.topic_poster = u.user_id

     AND f.forum_id = t.forum_id

     AND p.post_id = t.topic_first_post_id

     AND p2.post_id = t.topic_last_post_id

     AND u2.user_id = p2.poster_id";
            /*****[END]********************************************
            
            [ Mod:    Advanced Username Color             v1.0.5 ]
            
            ******************************************************/
        }
        $per_page = ($show_results == 'posts') ? $phpbb2_board_config['posts_per_page'] : $phpbb2_board_config['topics_per_page'];
        $sql.= " ORDER BY ";
        switch ($sort_by) {
            case 1:
                $sql.= ($show_results == 'posts') ? 'pt.post_subject' : 't.topic_title';
            break;
            case 2:
                $sql.= 't.topic_title';
            break;
            case 3:
                $sql.= 'u.username';
            break;
            case 4:
                $sql.= 'f.forum_id';
            break;
            default:
                $sql.= ($show_results == 'posts') ? 'p.post_time' : 'p2.post_time';
            break;
        }
        $sql.= " $sort_dir LIMIT $phpbb2_start, " . $per_page;
        if (!$result = $titanium_db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not obtain search results', '', __LINE__, __FILE__, $sql);
        }
        $searchset = array();
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $searchset[] = $row;
        }
        $titanium_db->sql_freeresult($result);
        //
        // Define censored word matches
        //
        $orig_word = array();
        $replacement_word = array();
        obtain_word_list($orig_word, $replacement_word);
        //
        // Output header
        //
        $phpbb2_page_title = $titanium_lang['Search'];
        include ("includes/page_header.$phpEx");
        if ($show_results == 'posts') {
            $phpbb2_template->set_filenames(array('body' => 'search_results_posts.tpl'));
        } else {
            $phpbb2_template->set_filenames(array('body' => 'search_results_topics.tpl'));
        }
        make_jumpbox('viewforum.' . $phpEx);
        $l_search_matches = ($total_phpbb2_match_count == 1) ? sprintf($titanium_lang['Found_search_match'], $total_phpbb2_match_count) : sprintf($titanium_lang['Found_search_matches'], $total_phpbb2_match_count);
        $phpbb2_template->assign_vars(array('L_SEARCH_MATCHES' => $l_search_matches, 'L_TOPIC' => $titanium_lang['Topic']));
        $highlight_active = '';
        $highlight_match = array();

        for ($j = 0;$j < count($split_search);$j++) {
            $split_word = $split_search[$j];
            if ($split_word != 'and' && $split_word != 'or' && $split_word != 'not') {
                $highlight_match[] = '#\b(' . str_replace("*", "([\w]+)?", $split_word) . ')\b#is';
                $highlight_active.= " " . $split_word;
                for ($k = 0;$k < count($synonym_array);$k++) {
                    list($replace_synonym, $match_synonym) = explode(' ', trim(strtolower($synonym_array[$k])));
                    if ($replace_synonym == $split_word) {
                        $highlight_match[] = '#\b(' . str_replace("*", "([\w]+)?", $replace_synonym) . ')\b#is';
                        $highlight_active.= ' ' . $match_synonym;
                    }
                }
            }
        }
        $highlight_active = urlencode(trim($highlight_active));
        $phpbb2_tracking_topics = (isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t'])) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) : array();
        $phpbb2_tracking_forums = (isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f'])) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f']) : array();
        for ($i = 0;$i < count($searchset);$i++) {
            /*****[BEGIN]******************************************
            
            [ Base:    Nuke Patched                       v3.1.0 ]
            
            ******************************************************/
            $forum_url = "modules.php?name=Forums&amp;file=viewforum&amp;" . POST_FORUM_URL . "=" . $searchset[$i]['forum_id'] . "";
            $topic_url = "modules.php?name=Forums&amp;file=viewtopic&amp;" . POST_TOPIC_URL . "=" . $searchset[$i]['topic_id'] . "&amp;highlight=$highlight_active";
            $post_url = "modules.php?name=Forums&amp;file=viewtopic&amp;" . POST_POST_URL . "=" . $searchset[$i]['post_id'] . "&amp;highlight=$highlight_active#" . $searchset[$i]['post_id'] . "";
            /*****[END]********************************************
            
            [ Base:    Nuke Patched                       v3.1.0 ]
            
            ******************************************************/
            $post_date = create_date($phpbb2_board_config['default_dateformat'], $searchset[$i]['post_time'], $phpbb2_board_config['board_timezone']);
            $message = $searchset[$i]['post_text'];
            /*****[BEGIN]******************************************
            
            [ Mod:     Smilies in Topic Titles            v1.0.0 ]
            
            [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
            
            ******************************************************/
            $topic_title = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($searchset[$i]['topic_title']) : $searchset[$i]['topic_title'];
            /*****[END]********************************************
            
            [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
            
            [ Mod:     Smilies in Topic Titles            v1.0.0 ]
            
            ******************************************************/
            $phpbb2_forum_id = $searchset[$i]['forum_id'];
            $topic_id = $searchset[$i]['topic_id'];
            if ($show_results == 'posts') {
                if (isset($return_chars)) {
                    $bbcode_uid = $searchset[$i]['bbcode_uid'];
                    /*****[BEGIN]******************************************
                    
                    [ Mod:    Hide Mod                            v1.2.0 ]
                    
                    ******************************************************/
                    //
                    // If the board has HTML off but the post has HTML
                    // on then we process it, else leave it alone
                    //
                    if ($return_chars == - 1)
                    /*****[END]********************************************
                    
                    [ Mod:    Hide Mod                            v1.2.0 ]
                    
                    ******************************************************/ {
                        $message = strip_tags($message);
                        $message = preg_replace("/\[.*?:$bbcode_uid:?.*?\]/si", '', $message);
                        $message = preg_replace('/\[url\]|\[\/url\]/si', '', $message);
                        $message = (strlen($message) > $return_chars) ? substr($message, 0, $return_chars) . ' ...' : $message;
                    } else {
                        if (!$phpbb2_board_config['allow_html']) {
                            if ($postrow[$i]['enable_html']) {
                                $message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
                            }
                        }
                        /*****[BEGIN]******************************************
                        
                        [ Mod:    Hide Mod                            v1.2.0 ]
                        
                        ******************************************************/
                        if ($bbcode_uid != '') {
                            $message = ($phpbb2_board_config['allow_bbcode']) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
                            $message = bbencode_third_pass($message, $bbcode_uid, FALSE);
                        }
                        /*****[END]********************************************
                        
                        [ Mod:    Hide Mod                            v1.2.0 ]
                        
                        ******************************************************/
                        $message = make_clickable($message);
                        if ($highlight_active) {
                            if (preg_match('/<.*>/', $message)) {
                                $message = preg_replace($highlight_match, '<!-- #sh -->\1<!-- #eh -->', $message);
                                $phpbb2_end_html = 0;
                                $phpbb2_start_html = 1;
                                $temp_message = '';
                                $message = ' ' . $message . ' ';
                                while ($phpbb2_start_html = strpos($message, '<', $phpbb2_start_html)) {
                                    $grab_length = $phpbb2_start_html - $phpbb2_end_html - 1;
                                    $temp_message.= substr($message, $phpbb2_end_html + 1, $grab_length);
                                    if ($phpbb2_end_html = strpos($message, '>', $phpbb2_start_html)) {
                                        $length = $phpbb2_end_html - $phpbb2_start_html + 1;
                                        $hold_string = substr($message, $phpbb2_start_html, $length);
                                        if (strrpos(' ' . $hold_string, '<') != 1) {
                                            $phpbb2_end_html = $phpbb2_start_html + 1;
                                            $phpbb2_end_counter = 1;
                                            while ($phpbb2_end_counter && $phpbb2_end_html < strlen($message)) {
                                                if (substr($message, $phpbb2_end_html, 1) == '>') {
                                                    $phpbb2_end_counter--;
                                                } else if (substr($message, $phpbb2_end_html, 1) == '<') {
                                                    $phpbb2_end_counter++;
                                                }
                                                $phpbb2_end_html++;
                                            }
                                            $length = $phpbb2_end_html - $phpbb2_start_html + 1;
                                            $hold_string = substr($message, $phpbb2_start_html, $length);
                                            $hold_string = str_replace('<!-- #sh -->', '', $hold_string);
                                            $hold_string = str_replace('<!-- #eh -->', '', $hold_string);
                                        } else if ($hold_string == '<!-- #sh -->') {
                                            $hold_string = str_replace('<!-- #sh -->', '<span style="color:#' . $theme['fontcolor3'] . '"><strong>', $hold_string);
                                        } else if ($hold_string == '<!-- #eh -->') {
                                            $hold_string = str_replace('<!-- #eh -->', '</strong></span>', $hold_string);
                                        }
                                        $temp_message.= $hold_string;
                                        $phpbb2_start_html+= $length;
                                    } else {
                                        $phpbb2_start_html = strlen($message);
                                    }
                                }
                                $grab_length = strlen($message) - $phpbb2_end_html - 1;
                                $temp_message.= substr($message, $phpbb2_end_html + 1, $grab_length);
                                $message = trim($temp_message);
                            } else {
                                $message = preg_replace($highlight_match, '<span style="color:#' . $theme['fontcolor3'] . '"><strong>\1</strong></span>', $message);
                            }
                        }
                    }
                    if (count($orig_word)) {
                        $topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
                        $post_subject = ($searchset[$i]['post_subject'] != "") ? preg_replace($orig_word, $replacement_word, $searchset[$i]['post_subject']) : $topic_title;
                        $message = preg_replace($orig_word, $replacement_word, $message);
                    } else {
                        $post_subject = ($searchset[$i]['post_subject'] != '') ? $searchset[$i]['post_subject'] : $topic_title;
                    }
                    if ($phpbb2_board_config['allow_smilies'] && $searchset[$i]['enable_smilies']) {
                        $message = smilies_pass($message);
                    }
                    $message = str_replace("\n", '<br />', $message);
                }
                $poster = ($searchset[$i]['user_id'] != ANONYMOUS) ? '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $searchset[$i]['user_id']) . '">' : '';
                /*****[BEGIN]******************************************                
                [ Mod:    Advanced Username Color             v1.0.5 ]                
                ******************************************************/
                $poster.= ($searchset[$i]['user_id'] != ANONYMOUS) ? UsernameColor($searchset[$i]['user_color_gc'], $searchset[$i]['username']) : ((UsernameColor($searchset[$i]['user_color_gc'], $searchset[$i]['post_username']) != "") ? UsernameColor($searchset[$i]['user_color_gc'], $searchset[$i]['post_username']) : $titanium_lang['Guest']);
                /*****[END]********************************************                
                [ Mod:    Advanced Username Color             v1.0.5 ]                
                ******************************************************/
                $poster.= ($searchset[$i]['user_id'] != ANONYMOUS) ? '</a>' : '';
                if ($userdata['session_logged_in'] && $searchset[$i]['post_time'] > $userdata['user_lastvisit']) {
                    if (!empty($phpbb2_tracking_topics[$topic_id]) && !empty($phpbb2_tracking_forums[$phpbb2_forum_id])) {
                        $topic_last_read = ($phpbb2_tracking_topics[$topic_id] > $phpbb2_tracking_forums[$phpbb2_forum_id]) ? $phpbb2_tracking_topics[$topic_id] : $phpbb2_tracking_forums[$phpbb2_forum_id];
                    } else if (!empty($phpbb2_tracking_topics[$topic_id]) || !empty($phpbb2_tracking_forums[$phpbb2_forum_id])) {
                        $topic_last_read = (!empty($phpbb2_tracking_topics[$topic_id])) ? $phpbb2_tracking_topics[$topic_id] : $phpbb2_tracking_forums[$phpbb2_forum_id];
                    }
                    if ($searchset[$i]['post_time'] > $topic_last_read) {
                        $mini_post_img = $images['icon_minipost_new'];
                        $mini_post_alt = $titanium_lang['New_post'];
                    } else {
                        $mini_post_img = $images['icon_minipost'];
                        $mini_post_alt = $titanium_lang['Post'];
                    }
                } else {
                    $mini_post_img = $images['icon_minipost'];
                    $mini_post_alt = $titanium_lang['Post'];
                }

                $phpbb2_folder_image = $images['icon_minipost'];

                /*--FNA #1--*/
                $phpbb2_template->assign_block_vars("searchresults", array(
                        'TOPIC_TITLE' => $topic_title, 
                        'FORUM_NAME' => $searchset[$i]['forum_name'], 
                        'POST_SUBJECT' => $post_subject, 
                        'POST_DATE' => $post_date, 
                        'POSTER_NAME' => $poster, 
                        'TOPIC_REPLIES' => $searchset[$i]['topic_replies'], 
                        'TOPIC_VIEWS' => $searchset[$i]['topic_views'], 
                        'MESSAGE' => $message, 
                        'MINI_POST_IMG' => $mini_post_img, 
                        'L_MINI_POST_ALT' => $mini_post_alt, 
                        'U_POST' => $post_url, 
                        'U_TOPIC' => $topic_url, 
                        'U_FORUM' => $forum_url,
                        'FORUM_FOLDER_IMG' => $phpbb2_folder_image
                    )
                );
            } else {
                $message = '';
                if (count($orig_word)) {
                    $topic_title = preg_replace($orig_word, $replacement_word, $searchset[$i]['topic_title']);
                }
                $topic_type = $searchset[$i]['topic_type'];
                /*****[BEGIN]******************************************
                
                [ Mod:     Global Announcements               v1.2.8 ]
                
                ******************************************************/
                if ($topic_type == POST_GLOBAL_ANNOUNCE) {
                    $topic_type = $titanium_lang['Topic_global_announcement'] . " ";
                } else
                /*****[END]********************************************
                
                [ Mod:     Global Announcements               v1.2.8 ]
                
                ******************************************************/
                if ($topic_type == POST_ANNOUNCE) {
                    $topic_type = $titanium_lang['Topic_Announcement'] . ' ';
                } else if ($topic_type == POST_STICKY) {
                    $topic_type = $titanium_lang['Topic_Sticky'] . ' ';
                } else {
                    $topic_type = '';
                }
                if ($searchset[$i]['topic_vote']) {
                    $topic_type.= $titanium_lang['Topic_Poll'] . ' ';
                }
                $views = $searchset[$i]['topic_views'];
                $replies = $searchset[$i]['topic_replies'];
                if (($replies + 1) > $phpbb2_board_config['posts_per_page']) {
                    $total_phpbb2_pages = ceil(($replies + 1) / $phpbb2_board_config['posts_per_page']);
                    $goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $titanium_lang['Goto_page'] . '" title="' . $titanium_lang['Goto_page'] . '" />' . $titanium_lang['Goto_page'] . ': ';
                    $times = 1;
                    for ($j = 0;$j < $replies + 1;$j+= $phpbb2_board_config['posts_per_page']) {
                        $goto_page.= '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $topic_id . "&amp;start=$j") . '">' . $times . '</a>';
                        if ($times == 1 && $total_phpbb2_pages > 4) {
                            $goto_page.= ' ... ';
                            $times = $total_phpbb2_pages - 3;
                            $j+= ($total_phpbb2_pages - 4) * $phpbb2_board_config['posts_per_page'];
                        } else if ($times < $total_phpbb2_pages) {
                            $goto_page.= ', ';
                        }
                        $times++;
                    }
                    $goto_page.= ' ] ';
                } else {
                    $goto_page = '';
                }
                if ($searchset[$i]['topic_status'] == TOPIC_MOVED) {
                    $topic_type = $titanium_lang['Topic_Moved'] . ' ';
                    $topic_id = $searchset[$i]['topic_moved_id'];
                    $phpbb2_folder_image = '<img src="' . $images['folder'] . '" alt="' . $titanium_lang['No_new_posts'] . '" />';
                    $newest_post_img = '';
                } else {
                    if ($searchset[$i]['topic_status'] == TOPIC_LOCKED) {
                        $folder = $images['folder_locked'];
                        $folder_new = $images['folder_locked_new'];
                    }
                    /*****[BEGIN]******************************************
                    
                    [ Mod:     Global Announcements               v1.2.8 ]
                    
                    ******************************************************/
                    else if ($searchset[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE) {
                        $folder = $images['folder_global_announce'];
                        $folder_new = $images['folder_global_announce_new'];
                    }
                    /*****[END]********************************************
                    
                    [ Mod:     Global Announcements               v1.2.8 ]
                    
                    ******************************************************/
                    else if ($searchset[$i]['topic_type'] == POST_ANNOUNCE) {
                        $folder = $images['folder_announce'];
                        $folder_new = $images['folder_announce_new'];
                    } else if ($searchset[$i]['topic_type'] == POST_STICKY) {
                        $folder = $images['folder_sticky'];
                        $folder_new = $images['folder_sticky_new'];
                    } else {
                        if ($replies >= $phpbb2_board_config['hot_threshold']) {
                            $folder = $images['folder_hot'];
                            $folder_new = $images['folder_hot_new'];
                        } else {
                            $folder = $images['folder'];
                            $folder_new = $images['folder_new'];
                        }
                    }
                    if ($userdata['session_logged_in']) {
                        if ($searchset[$i]['post_time'] > $userdata['user_lastvisit']) {
                            if (!empty($phpbb2_tracking_topics) || !empty($phpbb2_tracking_forums) || isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all'])) {
                                $phpbb2_unread_topics = true;
                                if (!empty($phpbb2_tracking_topics[$topic_id])) {
                                    if ($phpbb2_tracking_topics[$topic_id] > $searchset[$i]['post_time']) {
                                        $phpbb2_unread_topics = false;
                                    }
                                }
                                if (!empty($phpbb2_tracking_forums[$phpbb2_forum_id])) {
                                    if ($phpbb2_tracking_forums[$phpbb2_forum_id] > $searchset[$i]['post_time']) {
                                        $phpbb2_unread_topics = false;
                                    }
                                }
                                if (isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all'])) {
                                    if ($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all'] > $searchset[$i]['post_time']) {
                                        $phpbb2_unread_topics = false;
                                    }
                                }
                                if ($phpbb2_unread_topics) {
                                    $phpbb2_folder_image = $folder_new;
                                    $phpbb2_folder_alt = $titanium_lang['New_posts'];
                                    $newest_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $titanium_lang['View_newest_post'] . '" title="' . $titanium_lang['View_newest_post'] . '" border="0" /></a> ';
                                } else {
                                    $phpbb2_folder_alt = ($searchset[$i]['topic_status'] == TOPIC_LOCKED) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                                    $phpbb2_folder_image = $folder;
                                    $phpbb2_folder_alt = $phpbb2_folder_alt;
                                    $newest_post_img = '';
                                }
                            } else if ($searchset[$i]['post_time'] > $userdata['user_lastvisit']) {
                                $phpbb2_folder_image = $folder_new;
                                $phpbb2_folder_alt = $titanium_lang['New_posts'];
                                $newest_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $titanium_lang['View_newest_post'] . '" title="' . $titanium_lang['View_newest_post'] . '" border="0" /></a> ';
                            } else {
                                $phpbb2_folder_image = $folder;
                                $phpbb2_folder_alt = ($searchset[$i]['topic_status'] == TOPIC_LOCKED) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                                $newest_post_img = '';
                            }
                        } else {
                            $phpbb2_folder_image = $folder;
                            $phpbb2_folder_alt = ($searchset[$i]['topic_status'] == TOPIC_LOCKED) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                            $newest_post_img = '';
                        }
                    } else {
                        $phpbb2_folder_image = $folder;
                        $phpbb2_folder_alt = ($searchset[$i]['topic_status'] == TOPIC_LOCKED) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                        $newest_post_img = '';
                    }
                }
                $topic_author = ($searchset[$i]['user_id'] != ANONYMOUS) ? '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $searchset[$i]['user_id']) . '">' : '';
                /*****[BEGIN]******************************************
                
                [ Mod:    Advanced Username Color             v1.0.5 ]
                
                ******************************************************/
                $topic_author.= ($searchset[$i]['user_id'] != ANONYMOUS) ? UsernameColor($searchset[$i]['color1'], $searchset[$i]['username']) : ((UsernameColor($searchset[$i]['color1'], $searchset[$i]['post_username']) != '') ? UsernameColor($searchset[$i]['color1'], $searchset[$i]['post_username']) : $titanium_lang['Guest']);
                /*****[END]********************************************
                
                [ Mod:    Advanced Username Color             v1.0.5 ]
                
                ******************************************************/
                $topic_author.= ($searchset[$i]['user_id'] != ANONYMOUS) ? '</a>' : '';
                $first_post_time = create_date($phpbb2_board_config['default_dateformat'], $searchset[$i]['topic_time'], $phpbb2_board_config['board_timezone']);
                $phpbb2_last_post_time = create_date($phpbb2_board_config['default_dateformat'], $searchset[$i]['post_time'], $phpbb2_board_config['board_timezone']);
                /*****[BEGIN]******************************************
                
                [ Mod:    Advanced Username Color             v1.0.5 ]
                
                ******************************************************/
                $phpbb2_last_post_author = ($searchset[$i]['id2'] == ANONYMOUS) ? (($searchset[$i]['post_username2'] != '') ? $searchset[$i]['post_username2'] . ' ' : $titanium_lang['Guest'] . ' ') : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $searchset[$i]['id2']) . '">' . UsernameColor($searchset[$i]['color2'], $searchset[$i]['user2']) . '</a>';
                /*****[END]********************************************
                
                [ Mod:    Advanced Username Color             v1.0.5 ]
                
                ******************************************************/
                $phpbb2_last_post_url = '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $searchset[$i]['topic_last_post_id']) . '#' . $searchset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $titanium_lang['View_latest_post'] . '" title="' . $titanium_lang['View_latest_post'] . '" border="0" /></a>';
                /*--FNA #2--*/
                $phpbb2_template->assign_block_vars('searchresults', array('FORUM_NAME' => $searchset[$i]['forum_name'], 'FORUM_ID' => $phpbb2_forum_id, 'TOPIC_ID' => $topic_id, 'FOLDER' => $phpbb2_folder_image, 'NEWEST_POST_IMG' => $newest_post_img, 'TOPIC_FOLDER_IMG' => $phpbb2_folder_image, 'GOTO_PAGE' => $goto_page, 'REPLIES' => $replies, 'TOPIC_TITLE' => $topic_title, 'TOPIC_TYPE' => $topic_type, 'VIEWS' => $views, 'TOPIC_AUTHOR' => $topic_author, 'FIRST_POST_TIME' => $first_post_time, 'LAST_POST_TIME' => $phpbb2_last_post_time, 'LAST_POST_AUTHOR' => $phpbb2_last_post_author, 'LAST_POST_IMG' => $phpbb2_last_post_url, 'L_TOPIC_FOLDER_ALT' => $phpbb2_folder_alt, 'U_VIEW_FORUM' => $forum_url, 'U_VIEW_TOPIC' => $topic_url));
            }
        }
        $base_url = "search.$phpEx?search_id=$search_id";
        $phpbb2_template->assign_vars(array('PAGINATION' => generate_pagination($base_url, $total_phpbb2_match_count, $per_page, $phpbb2_start), 'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], (floor($phpbb2_start / $per_page) + 1), ceil($total_phpbb2_match_count / $per_page)), 'L_AUTHOR' => $titanium_lang['Author'], 'L_MESSAGE' => $titanium_lang['Message'], 'L_FORUM' => $titanium_lang['Forum'], 'L_TOPICS' => $titanium_lang['Topics'], 'L_REPLIES' => $titanium_lang['Replies'], 'L_VIEWS' => $titanium_lang['Views'], 'L_POSTS' => $titanium_lang['Posts'], 'L_LASTPOST' => $titanium_lang['Last_Post'], 'L_POSTED' => $titanium_lang['Posted'], 'L_SUBJECT' => $titanium_lang['Subject'], 'L_GOTO_PAGE' => $titanium_lang['Goto_page']));
        $phpbb2_template->pparse('body');
        include ("includes/page_tail.$phpEx");
    } else {
        message_die(GENERAL_MESSAGE, $titanium_lang['No_search_match']);
    }
}
//
// Search forum
//
$sql = "SELECT c.cat_title, c.cat_id, f.forum_name, f.forum_id, f.forum_parent

    FROM (" . CATEGORIES_TABLE . " c, " . FORUMS_TABLE . " f)

    WHERE f.cat_id = c.cat_id

    " . (($userdata['user_level'] == ADMIN) ? "" : " AND c.cat_id<>'" . HIDDEN_CAT . "'") . "

    ORDER BY c.cat_id, f.forum_order";
$result = $titanium_db->sql_query($sql);
if (!$result) {
    message_die(GENERAL_ERROR, 'Could not obtain forum_name/forum_id', '', __LINE__, __FILE__, $sql);
}
$phpbb2_is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);
$s_forums = '';
/*****[BEGIN]******************************************

     [ Mod:    Simple Subforums                    v1.0.1 ]

     ******************************************************/
$list = array();
/*****[END]********************************************

     [ Mod:    Simple Subforums                    v1.0.1 ]

     ******************************************************/
while ($row = $titanium_db->sql_fetchrow($result)) {
    if ($phpbb2_is_auth_ary[$row['forum_id']]['auth_read']) {
        /*****[BEGIN]******************************************
        
        [ Mod:    Simple Subforums                    v1.0.1 ]
        
        ******************************************************/
        $list[] = $row;
    }
}
for ($i = 0;$i < count($list);$i++) {
    if (!$list[$i]['forum_parent']) {
        $row = $list[$i];
        /*****[END]********************************************
        
        [ Mod:    Simple Subforums                    v1.0.1 ]
        
        ******************************************************/
        $s_forums.= '<option value="' . $row['forum_id'] . '">' . $row['forum_name'] . '</option>';
        if (empty($list_cat[$row['cat_id']])) {
            $list_cat[$row['cat_id']] = $row['cat_title'];
        }
        /*****[BEGIN]******************************************
        
        [ Mod:    Simple Subforums                    v1.0.1 ]
        
        ******************************************************/
        $phpbb2_parent_id = $row['forum_id'];
        for ($j = 0;$j < count($list);$j++) {
            if ($list[$j]['forum_parent'] == $phpbb2_parent_id) {
                $row = $list[$j];
                $s_forums.= '<option value="' . $row['forum_id'] . '">-- ' . $row['forum_name'] . '</option>';
            }
        }
        /*****[END]********************************************
        
        [ Mod:    Simple Subforums                    v1.0.1 ]
        
        ******************************************************/
    }
}
$titanium_db->sql_freeresult($result);
if ($s_forums != '') {
    $s_forums = '<option value="-1">' . $titanium_lang['All_available'] . '</option>' . $s_forums;
    //
    // Category to search
    //
    $s_categories = '<option value="-1">' . $titanium_lang['All_available'] . '</option>';
    while (list($cat_id, $cat_title) = @each($list_cat)) {
        $s_categories.= '<option value="' . $cat_id . '">' . $cat_title . '</option>';
    }
} else {
    message_die(GENERAL_MESSAGE, $titanium_lang['No_searchable_forums']);
}
//
// Number of chars returned
//
$s_characters = '<option value="-1">' . $titanium_lang['All_available'] . '</option>';
$s_characters.= '<option value="0">0</option>';
$s_characters.= '<option value="25">25</option>';
$s_characters.= '<option value="50">50</option>';
for ($i = 100;$i < 1100;$i+= 100) {
    $selected = ($i == 200) ? ' selected="selected"' : '';
    $s_characters.= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
}
//
// Sorting
//
$s_sort_by = "";
for ($i = 0;$i < count($sort_by_types);$i++) {
    $s_sort_by.= '<option value="' . $i . '">' . $sort_by_types[$i] . '</option>';
}
//
// Search time
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($titanium_lang['All_Posts'], $titanium_lang['1_Day'], $titanium_lang['7_Days'], $titanium_lang['2_Weeks'], $titanium_lang['1_Month'], $titanium_lang['3_Months'], $titanium_lang['6_Months'], $titanium_lang['1_Year']);
$s_time = '';
for ($i = 0;$i < count($previous_days);$i++) {
    $selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
    $s_time.= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
//
// Output the basic page
//
$phpbb2_page_title = $titanium_lang['Search'];
include ("includes/page_header.$phpEx");
$phpbb2_template->set_filenames(array('body' => 'search_body.tpl'));
make_jumpbox('viewforum.' . $phpEx);
$phpbb2_template->assign_vars(array('L_SEARCH_QUERY' => $titanium_lang['Search_query'], 'L_SEARCH_OPTIONS' => $titanium_lang['Search_options'], 'L_SEARCH_KEYWORDS' => $titanium_lang['Search_keywords'], 'L_SEARCH_KEYWORDS_EXPLAIN' => $titanium_lang['Search_keywords_explain'], 'L_SEARCH_AUTHOR' => $titanium_lang['Search_author'], 'L_SEARCH_AUTHOR_EXPLAIN' => $titanium_lang['Search_author_explain'], 'L_SEARCH_ANY_TERMS' => $titanium_lang['Search_for_any'], 'L_SEARCH_ALL_TERMS' => $titanium_lang['Search_for_all'], 'L_SEARCH_MESSAGE_ONLY' => $titanium_lang['Search_msg_only'],
/*****[BEGIN]******************************************

     [ Mod:    Search Only Subject                 v0.9.1 ]

     ******************************************************/
'L_SEARCH_MESSAGE_SUBJECT_ONLY' => $titanium_lang['Search_subject_only'],
/*****[END]********************************************

     [ Mod:    Search Only Subject                 v0.9.1 ]

     ******************************************************/
'L_SEARCH_MESSAGE_TITLE' => $titanium_lang['Search_title_msg'], 'L_CATEGORY' => $titanium_lang['Category'], 'L_RETURN_FIRST' => $titanium_lang['Return_first'], 'L_CHARACTERS' => $titanium_lang['characters_posts'], 'L_SORT_BY' => $titanium_lang['Sort_by'], 'L_SORT_ASCENDING' => $titanium_lang['Sort_Ascending'], 'L_SORT_DESCENDING' => $titanium_lang['Sort_Descending'], 'L_SEARCH_PREVIOUS' => $titanium_lang['Search_previous'], 'L_DISPLAY_RESULTS' => $titanium_lang['Display_results'], 'L_FORUM' => $titanium_lang['Forum'], 'L_TOPICS' => $titanium_lang['Topics'], 'L_POSTS' => $titanium_lang['Posts'], 'S_SEARCH_ACTION' => append_titanium_sid("search.$phpEx?mode=results"), 'S_CHARACTER_OPTIONS' => $s_characters, 'S_FORUM_OPTIONS' => $s_forums, 'S_CATEGORY_OPTIONS' => $s_categories, 'S_TIME_OPTIONS' => $s_time, 'S_SORT_OPTIONS' => $s_sort_by, 'S_HIDDEN_FIELDS' => ''));
$phpbb2_template->pparse('body');
include ("includes/page_tail.$phpEx");
?>