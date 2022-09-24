<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            functions_topics_list.php
 *                            -------------------------
 *    begin            : 02/08/2003
 *    copyright        : Ptirhiik
 *    email            : admin@rpgnet-fr.com
 *    version            : 1.1.9 - 04/11/2003
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
      Advanced Username Color                  v1.0.5       10/27/2005
 ************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

// activate this line if you want to alternate the color of each row
// define('TOPIC_ALTERNATE_ROW_CLASS', true);

// different view for the topics the user replied too
define('USER_REPLIED_ICON', true); // activate this line if you are using different folder icons for the topic the user replied too
// define('USER_REPLIED_CLASS', 'quote'); // activate this line and set the class you prefer for the the topic the user replied too

// various includes
include_once('includes/functions_post.' . $phpEx);
include_once('includes/bbcode.' . $phpEx);
@include_once('includes/functions_calendar.' . $phpEx);
@include_once('includes/functions_announces.' . $phpEx);

//--------------------------------------------------
// topic_list() : display a list of topic
// ------------
//    $box :                name of the tpl var for the box
//    $tpl :                name of the template file used (blank: topics_list_box.tpl) : do not set .tpl at the end
//    $topic_rowset :        list of the topics : note that topic_id is filled with the item type + id (ie t256)
//    $list_title :        title of the box (blank: $titanium_lang['Topics'])
//    $split_type :        if false, the topics won't be split whatever is the split topic per type setup
//    $display_nav_tree :    if true, display the forum name where stands the topic
//    $footer :            what to display at the bottom of the last box (sort by, order, etc.)
//    $inbox :            if false, the topics won't be splitted in different boxes per type
//    $select_field :        name of the select field
//    $select_type :        0: no select field, 1: checkbox field (multiple selection), 2: radio field (unique selection)
//    $select_formname :    name of the form where the select field will appear
//    $select_values :    selected values (array)
// ---------------------------------
// standard sql request in order to fill the topic_rowset array :
// ---------------------------------
// $sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time 
//    FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2
//    WHERE t.topic_poster = u.user_id
//        AND p.post_id = t.topic_first_post_id
//        AND p2.post_id = t.topic_last_post_id
//        AND u2.user_id = p2.poster_id 
//    ORDER BY t.topic_type DESC, t.topic_last_post_id DESC 
//    LIMIT $phpbb2_start, ".$phpbb2_board_config['topics_per_page'];
// ---------------------------------
// NB:
// ---------------------------------
//  topic_id should have in first position the main data row type, meaning for topics :
//    $topic_rowset[]['topic_id'] = POST_TOPIC_URL . $row['topic_id'];
//--------------------------------------------------
function topic_list($box, $tpl='', $topic_rowset, $list_title='', $split_type=false, $display_nav_tree=true, $footer='', $inbox=true, $select_field='', $select_type=0, $select_formname='', $select_values=array())
{
    global $titanium_db, $phpbb2_template, $phpbb2_board_config, $userdata, $phpEx, $titanium_lang, $images, $HTTP_COOKIE_VARS, $tree;
    static $box_id;

    // save template state
    $sav_tpl = $phpbb2_template->_tpldata;

    // init
    if (empty($tpl))
    {
        $tpl = 'topics_list_box';
    }
    if (empty($list_title))
    {
        $list_title = $titanium_lang['Topics'];
    }
    if (!empty($select_values) && !is_array($select_values) )
    {
        $s_values = $select_values;
        $select_values = array();
        $select_values[] = $s_values;
    }

    // selections
    $select_multi = false;
    $select_unique = false;
    if (!empty($select_field) && ($select_type > 0) && !empty($select_formname) )
    {
        switch ($select_type)
        {
            case 1:
                $select_multi = true;
                break;
            case 2:
                $select_unique = true;
                break;
        }
    }

    // get split params
    $switch_split_global_announce = (isset($phpbb2_board_config['split_global_announce']) && isset($titanium_lang['Post_Global_Announcement'])) ? intval($phpbb2_board_config['split_global_announce']) : false;
    $switch_split_announce = isset($phpbb2_board_config['split_announce']) ? intval($phpbb2_board_config['split_announce']) : false;
    $switch_split_sticky = isset($phpbb2_board_config['split_sticky']) ? intval($phpbb2_board_config['split_sticky']) : false;

    // set in separate table
    $split_box = $inbox && (isset($phpbb2_board_config['split_topic_split']) ? intval($phpbb2_board_config['split_topic_split']) : false);

    // take care of the context
    if (!$split_type)
    {
        $split_box = false;
        $switch_split_global_announce = false;
        $switch_split_announce = false;
        $switch_split_sticky = false;
    }

    if (!$switch_split_global_announce && !$switch_split_announce && !$switch_split_sticky)
    {
        $split_type = false;
        $split_box = false;
    }

    // Define censored word matches
    $orig_word = array();
    $replacement_word = array();
    obtain_word_list($orig_word, $replacement_word);

    // read the user cookie
    $phpbb2_tracking_topics    = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . "_t"]) : array();
    $phpbb2_tracking_forums    = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . "_f"]) : array();
    $phpbb2_tracking_all        = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all']) ) ? intval($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] . '_f_all']) : NULL;

    // categories hierarchy v 2 compliancy
    $cat_hierarchy = function_exists(get_auth_keys);
    if (!$cat_hierarchy)
    {
        // standard read
        $phpbb2_is_auth = array();
        $phpbb2_is_auth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
    }

    // topic icon present
    $phpbb2_icon_installed = function_exists(get_icon_title);

    // get a default title
    if (empty($list_title))
    {
        $list_title = $titanium_lang['forum'];
    }

    // choose template
    $phpbb2_template->set_filenames(array(
        $tpl => $tpl . '.tpl')
    );

    // check if user replied to the topics
    $titanium_user_topics = array();
    if ($userdata['user_id'] != ANONYMOUS)
    {
        // get all the topic ids to display
        $topic_ids = array();
        for ($i = 0; $i < count($topic_rowset); $i++)
        {
            $topic_item_type    = substr($topic_rowset[$i]['topic_id'], 0, 1);
            $topic_id            = intval(substr($topic_rowset[$i]['topic_id'], 1));
            if ( $topic_item_type == POST_TOPIC_URL )
            {
                $topic_ids[] = $topic_id;
            }
        }
        // check if the user replied to
        if (!empty($topic_ids))
        {
            // check the posts
            $s_topic_ids = implode(', ', $topic_ids);
            $sql = "SELECT DISTINCT topic_id FROM " . POSTS_TABLE . " 
                    WHERE topic_id IN ($s_topic_ids)
                        AND poster_id = " . $userdata['user_id'];
            if ( !($result = $titanium_db->sql_query($sql)) )
            {
               message_die(GENERAL_ERROR, 'Could not obtain post information', '', __LINE__, __FILE__, $sql);
            }
            while ($row = $titanium_db->sql_fetchrow($result))
            {
                $titanium_user_topics[POST_TOPIC_URL . $row['topic_id']] = true;
            }
        }
    }

    // initiate
    $phpbb2_template->assign_block_vars($tpl, array(
        'FORMNAME'        => $select_formname,
        'FIELDNAME'        => $select_field,
        )
    );

    // spanning of the first column (list name)
    $span_left = 1;
    if ( count($topic_rowset) > 0 )
    {
        // add folder image
        $span_left++;
    }
    if ( $phpbb2_icon_installed )
    {
        // add topic icon
        $span_left++;
    }
    if ( $select_unique )
    {
        // selection in front is asked
        $span_left++;
    }
    // spanning of the whole line (bottom row and/or empty list)
    $span_all = $span_left + 4;
    if ( $select_multi && (count($topic_rowset) >0) )
    {
        $span_all++;
    }

    // display topics
    $phpbb2_color = false;
    $prec_topic_type = '';
    $header_sent = false;
    if (!isset($box_id)) $box_id = -1;
    for ($i=0; $i < count($topic_rowset); $i++)
    {
        $topic_item_type    = substr($topic_rowset[$i]['topic_id'], 0, 1);
        $topic_id            = intval(substr($topic_rowset[$i]['topic_id'], 1));
        $topic_title        = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];
        $replies            = $topic_rowset[$i]['topic_replies'];
        $topic_type            = $topic_rowset[$i]['topic_type'];
        $titanium_user_replied        = ( !empty($titanium_user_topics) && isset($titanium_user_topics[$topic_rowset[$i]['topic_id']]) );
        $force_type_display    = false;
        $phpbb2_forum_id            = $topic_rowset[$i]['forum_id'];

        if ( defined('POST_BIRTHDAY') && ($topic_type == POST_BIRTHDAY) )
        {
            $topic_type = $titanium_lang['Birthday'] . ': ';
        }
        else if( $topic_type == POST_GLOBAL_ANNOUNCE )
        {
            $topic_type = $titanium_lang['Topic_Global_Announcement'] . ' ';
        }
        else if( $topic_type == POST_ANNOUNCE )
        {
            $topic_type = $titanium_lang['Topic_Announcement'] . ' ';
        }
        else if( $topic_type == POST_STICKY )
        {
            $topic_type = $titanium_lang['Topic_Sticky'] . ' ';
        }
        else
        {
            $topic_type = '';        
        }
        if( $topic_rowset[$i]['topic_vote'] )
        {
            $topic_type .= $titanium_lang['Topic_Poll'] . ' ';
            $force_type_display = true;
        }
        if (defined('POST_BIRTHDAY') && ($topic_rowset[$i]['topic_type'] == POST_BIRTHDAY))
        {
            $phpbb2_folder_image =  $images['folder_birthday'];
            $phpbb2_folder_alt = $titanium_lang['Happy_birthday'];
            $newest_post_img = '';
        }
        else if( $topic_rowset[$i]['topic_status'] == TOPIC_MOVED )
        {
            $topic_type = $titanium_lang['Topic_Moved'] . ' ';
            $topic_id = $topic_rowset[$i]['topic_moved_id'];
            $phpbb2_folder_image =  $images['folder'];
            $phpbb2_folder_alt = $titanium_lang['Topics_Moved'];
            $newest_post_img = '';
            $force_type_display = true;
        }
        else
        {
            if( defined('POST_BIRTHDAY') && ($topic_rowset[$i]['topic_type'] == POST_BIRTHDAY) )
            {
                $folder = $images['folder_birthday'];
                $folder_new = $images['folder_birthday'];
            }
            else if( $topic_rowset[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE )
            {
                $folder = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_global_announce'] : $images['folder_global_announce'];
                $folder_new = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_global_announce_new'] : $images['folder_global_announce_new'];
            }
            else if( $topic_rowset[$i]['topic_type'] == POST_ANNOUNCE )
            {
                $folder = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_announce'] : $images['folder_announce'];
                $folder_new = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_announce_new'] : $images['folder_announce_new'];
            }
            else if( $topic_rowset[$i]['topic_type'] == POST_STICKY )
            {
                $folder = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_sticky'] : $images['folder_sticky'];
                $folder_new = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_sticky_new'] : $images['folder_sticky_new'];
            }
            else if( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED )
            {
                $folder = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_locked'] : $images['folder_locked'];
                $folder_new = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_locked_new'] : $images['folder_locked_new'];
            }
            else
            {
                if($replies >= $phpbb2_board_config['hot_threshold'])
                {
                    $folder = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_hot'] : $images['folder_hot'];
                    $folder_new = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_hot_new'] : $images['folder_hot_new'];
                }
                else
                {
                    $folder = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder'] : $images['folder'];
                    $folder_new = ($titanium_user_replied && defined('USER_REPLIED_ICON')) ? $images['folder_new'] : $images['folder_new'];
                }
            }
            $newest_post_img = '';
            if ( $userdata['session_logged_in'] && ($topic_item_type == POST_TOPIC_URL) )
            {
                if( $topic_rowset[$i]['post_time'] > $userdata['user_lastvisit'] ) 
                {
                    if( !empty($phpbb2_tracking_topics) || !empty($phpbb2_tracking_forums) || !empty($phpbb2_tracking_all) )
                    {
                        $phpbb2_unread_topics = true;
                        if( !empty($phpbb2_tracking_topics[$topic_id]) )
                        {
                            if( $phpbb2_tracking_topics[$topic_id] >= $topic_rowset[$i]['post_time'] )
                            {
                                $phpbb2_unread_topics = false;
                            }
                        }
                        if( !empty($phpbb2_tracking_forums[$phpbb2_forum_id]) )
                        {
                            if( $phpbb2_tracking_forums[$phpbb2_forum_id] >= $topic_rowset[$i]['post_time'] )
                            {
                                $phpbb2_unread_topics = false;
                            }
                        }
                        if( !empty($phpbb2_tracking_all) )
                        {
                            if( $phpbb2_tracking_all >= $topic_rowset[$i]['post_time'] )
                            {
                                $phpbb2_unread_topics = false;
                            }
                        }
                        if ( $phpbb2_unread_topics )
                        {
                            $phpbb2_folder_image = $folder_new;
                            $phpbb2_folder_alt = $titanium_lang['New_posts'];
                            $newest_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $titanium_lang['View_newest_post'] . '" title="' . $titanium_lang['View_newest_post'] . '" border="0" /></a> ';
                        }
                        else
                        {
                            $phpbb2_folder_image = $folder;
                            $phpbb2_folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                            $newest_post_img = '';
                        }
                    }
                    else
                    {
                        $phpbb2_folder_image = $folder_new;
                        $phpbb2_folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['New_posts'];
                        $newest_post_img = '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $titanium_lang['View_newest_post'] . '" title="' . $titanium_lang['View_newest_post'] . '" border="0" /></a> ';
                    }
                }
                else 
                {
                    $phpbb2_folder_image = $folder;
                    $phpbb2_folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                    $newest_post_img = '';
                }
            }
            else
            {
                $phpbb2_folder_image = $folder;
                $phpbb2_folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                $newest_post_img = '';
            }
        }

        // generate list of page for the topic
        $goto_page = '';
        if( ( $replies + 1 ) > $phpbb2_board_config['posts_per_page'] )
        {
            $total_phpbb2_pages = ceil( ( $replies + 1 ) / $phpbb2_board_config['posts_per_page'] );
            $goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $titanium_lang['Goto_page'] . '" title="' . $titanium_lang['Goto_page'] . '" />' . $titanium_lang['Goto_page'] . ': ';
            $times = 1;
            for($j = 0; $j < $replies + 1; $j += $phpbb2_board_config['posts_per_page'])
            {
                $goto_page .= '<a href="' . append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $topic_id . "&amp;start=$j") . '">' . $times . '</a>';
                if( $times == 1 && $total_phpbb2_pages > 4 )
                {
                    $goto_page .= ' ... ';
                    $times = $total_phpbb2_pages - 3;
                    $j += ( $total_phpbb2_pages - 4 ) * $phpbb2_board_config['posts_per_page'];
                }
                else if ( $times < $total_phpbb2_pages )
                {
                    $goto_page .= ', ';
                }
                $times++;
            }
            $goto_page .= ' ] ';
        }

        $topic_author = '';
        $first_post_time = '';
        $phpbb2_last_post_time = '';
        $phpbb2_last_post_url = '';
        $views = '';
        switch ($topic_item_type)
        {
            case POST_USERS_URL:
                $view_topic_url        = append_titanium_sid("profile.$phpEx?" . POST_USERS_URL . "=$topic_id");
                break;
            default:
                $view_topic_url        = append_titanium_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");
                $topic_author        = ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $topic_rowset[$i]['user_id']) . '">' : '';
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $topic_author        .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? UsernameColor($topic_rowset[$i]['username']) : ( ( $topic_rowset[$i]['post_username'] != '' ) ? $topic_rowset[$i]['post_username'] : $titanium_lang['Guest'] );
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $topic_author        .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';
                $first_post_time    = create_date($phpbb2_board_config['default_dateformat'], $topic_rowset[$i]['topic_time'], $phpbb2_board_config['board_timezone']);
                $phpbb2_last_post_time        = create_date($phpbb2_board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $phpbb2_board_config['board_timezone']);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $phpbb2_last_post_author    = ( $topic_rowset[$i]['id2'] == ANONYMOUS ) ? ( ($topic_rowset[$i]['post_username2'] != '' ) ? $topic_rowset[$i]['post_username2'] . ' ' : $titanium_lang['Guest'] . ' ' ) : '<a href="' . append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $topic_rowset[$i]['id2']) . '">' . UsernameColor($topic_rowset[$i]['user2']) . '</a>';
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $phpbb2_last_post_url        = '<a href="' . append_titanium_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $titanium_lang['View_latest_post'] . '" title="' . $titanium_lang['View_latest_post'] . '" border="0" /></a>';
                $views                = $topic_rowset[$i]['topic_views'];
                break;
        }

        // categories hierarchy v 2 compliancy
        $nav_tree = '';
        if ( $display_nav_tree && !empty($topic_rowset[$i]['forum_id']) )
        {
            if ($cat_hierarchy)
            {
                if ($tree['auth'][POST_FORUM_URL . $topic_rowset[$i]['forum_id']]['tree.auth_view'])
                {
                    $nav_tree = make_cat_nav_tree(POST_FORUM_URL . $topic_rowset[$i]['forum_id'], '', 'gensmall');
                }
            }
            else
            {
                if ($phpbb2_is_auth[ $topic_rowset[$i]['forum_id'] ]['auth_view'])
                {
                    $nav_tree = '<a href="' . append_titanium_sid("viewforum.$phpEx?f=" . $topic_rowset[$i]['forum_id']) . '" class="gensmall">' . $topic_rowset[$i]['forum_name'] . '</a>';
                }
            }
        }
        if (!empty($nav_tree))
        {
            $nav_tree = '[ ' . $nav_tree . ' ]';
        }

        // get the type for rupture
        $topic_real_type = $topic_rowset[$i]['topic_type'];

        // if no split between global and standard announcement, group them with standard announcement
        if ( !$switch_split_global_announce && ($topic_real_type == POST_GLOBAL_ANNOUNCE) ) $topic_real_type = POST_ANNOUNCE;

        // if no split between announce and sticky, group them with sticky
        if ( !$switch_split_announce && ($topic_real_type == POST_ANNOUNCE) ) $topic_real_type = POST_STICKY;

        // if no split between sticky and normal, group them with normal
        if ( !$switch_split_sticky && ($topic_real_type == POST_STICKY) ) $topic_real_type = POST_NORMAL;

        // check if rupture
        $rupt = false;

        // split
        if ( ($i == 0) || $split_type )
        {
            if ($i == 0)
            {
                $rupt = true;
            }

            // check the rupt
            if ($prec_topic_type != $topic_real_type)
            {
                $rupt = true;
            }
        }
        $prec_topic_type = $topic_real_type;

        // header
        if ($rupt)
        {
            // close the prec box
            if ($split_box && ($i != 0))
            {
                // footer
                $phpbb2_template->assign_block_vars($tpl . '.row', array(
                    'COLSPAN'        => $span_all,
                    )
                );

                // table closure
                $phpbb2_template->assign_block_vars($tpl . '.row.footer_table', array());

                // spacing
                $phpbb2_template->assign_block_vars($tpl . '.row', array());
                $phpbb2_template->assign_block_vars($tpl . '.row.spacer', array());

                // unset header
                $header_sent = false;
            }

            // get box title
            $main_title = $list_title;
            $sub_title = $list_title;
            switch ($topic_real_type)
            {
                case POST_BIRTHDAY:
                    $sub_title = $titanium_lang['Birthday'];
                    break;
                case POST_GLOBAL_ANNOUNCE:
                    $sub_title = $titanium_lang['Post_Global_Announcement'];
                    break;
                case POST_ANNOUNCE:
                    $sub_title = $titanium_lang['Post_Announcement'];
                    break;
                case POST_STICKY:
                    $sub_title = $titanium_lang['Post_Sticky'];
                    break;
                case POST_CALENDAR:
                    $sub_title = $titanium_lang['Calendar_event'];
                    break;
                case POST_NORMAL:
                    $sub_title = $titanium_lang['Topics'];
                    break;
            }
            $phpbb2_template->assign_block_vars($tpl . '.row', array(
                'L_TITLE'        => (!$split_box) ? $main_title : $sub_title,
                'L_REPLIES'        => $titanium_lang['Replies'],
                'L_AUTHOR'        => $titanium_lang['Author'],
                'L_VIEWS'        => $titanium_lang['Views'],
                'L_LASTPOST'    => $titanium_lang['Last_Post'],
                'COLSPAN'        => $span_all,
                )
            );

            // open a new box
            if ($split_box || ($i == 0))
            {
                $box_id++;
                $phpbb2_template->assign_block_vars($tpl . '.row.header_table', array(
                    'COLSPAN'        => $span_left,
                    'BOX_ID'        => $box_id,
                    )
                );

                // selection fields
                if ($select_multi)
                {
                    $phpbb2_template->assign_block_vars($tpl . '.row.header_table.multi_selection', array());
                }

                // set header
                $header_sent = true;
            }

            // not in box, send a row title
            if ($split_type && !$split_box)
            {
                $phpbb2_template->assign_block_vars($tpl . '.row', array(
                    'L_TITLE'        => $sub_title,
                    'COLSPAN'        => $span_all,
                    )
                );
                $phpbb2_template->assign_block_vars($tpl . '.row.header_row', array());
            }
        }

        // erase the type before the title if split
        if ( $split_type && ($topic_real_type == $topic_rowset[$i]['topic_type']) && !$force_type_display)
        {
            $topic_type = '';
        }

        // get the announces dates
        $topic_announces_dates = '';
        if (function_exists(get_announces_title) && in_array( $topic_rowset[$i]['topic_type'], array(POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)))
        {
            $topic_announces_dates = get_announces_title($topic_rowset[$i]['topic_time'], $topic_rowset[$i]['topic_announce_duration']);
        }

        // get the calendar dates
        $topic_calendar_dates = '';
        if (function_exists(get_calendar_title))
        {
            $topic_calendar_dates = get_calendar_title($topic_rowset[$i]['topic_calendar_time'], $topic_rowset[$i]['topic_calendar_duration']);
        }

        // get the topic icons
        $phpbb2_icon = '';
        if ($phpbb2_icon_installed)
        {
            $type = $topic_rowset[$i]['topic_type'];
            if ($type == POST_NORMAL)
            {
                if ( defined('POST_CALENDAR') && !empty($topic_rowset[$i]['topic_calendar_time']) )
                {
                    $type = POST_CALENDAR;
                }
                if ( defined('POST_PICTURE') && !empty($topic_rowset[$i]['topic_pic_url']) )
                {
                    $type = POST_PICTURE;
                }
            }
            $phpbb2_icon = get_icon_title($topic_rowset[$i]['topic_icon'], 1, $type);
        }

        // send topic to template
        $selected = (!empty($select_values) && in_array($topic_rowset[$i]['topic_id'], $select_values));
        $phpbb2_color = !$phpbb2_color;
        $phpbb2_template->assign_block_vars( $tpl . '.row', array(
            'ROW_CLASS'                => ($phpbb2_color || !defined('TOPIC_ALTERNATE_ROW_CLASS')) ? 'row1' : 'row2',
            'ROW_FOLDER_CLASS'        => ($titanium_user_replied && defined('USER_REPLIED_CLASS')) ? USER_REPLIED_CLASS : ( ($phpbb2_color || !defined('TOPIC_ALTERNATE_ROW_CLASS')) ? 'row1' : 'row2' ),
            'FORUM_ID'                => $phpbb2_forum_id,
            'TOPIC_ID'                => $topic_id,
            'TOPIC_FOLDER_IMG'        => $phpbb2_folder_image,
            'TOPIC_AUTHOR'            => $topic_author,
            'GOTO_PAGE'                => !empty($goto_page) ? '<br />' . $goto_page : '',
            'TOPIC_NAV_TREE'        => !empty($nav_tree) ? (empty($goto_page) ? '<br />' : '') . $nav_tree : '',
            'REPLIES'                => $replies,
            'NEWEST_POST_IMG'        => $newest_post_img,
            'ICON'                    => $phpbb2_icon,
            'TOPIC_TITLE'            => $topic_title,
            'TOPIC_ANNOUNCES_DATES'    => $topic_announces_dates,
            'TOPIC_CALENDAR_DATES'    => $topic_calendar_dates,
            'TOPIC_TYPE'            => $topic_type,
            'VIEWS'                    => $views,
            'FIRST_POST_TIME'        => $first_post_time,
            'LAST_POST_TIME'        => $phpbb2_last_post_time,
            'LAST_POST_AUTHOR'        => $phpbb2_last_post_author,
            'LAST_POST_IMG'            => $phpbb2_last_post_url,
            'L_TOPIC_FOLDER_ALT'    => $phpbb2_folder_alt,
            'U_VIEW_TOPIC'            => $view_topic_url,
            'BOX_ID'                => $box_id,
            'FID'                    => $topic_rowset[$i]['topic_id'],
            'L_SELECT'                => ($selected && ($select_multi || $select_unique)) ? 'checked="checked"' : '',
            )
        );
        $phpbb2_template->assign_block_vars( $tpl . '.row.topic', array());

        // selection fields
        if ($select_multi)
        {
            $phpbb2_template->assign_block_vars($tpl . '.row.topic.multi_selection', array());
        }
        if ($select_unique)
        {
            $phpbb2_template->assign_block_vars($tpl . '.row.topic.single_selection', array());
        }

        // icons
        if ($phpbb2_icon_installed)
        {
            $phpbb2_template->assign_block_vars( $tpl . '.row.topic.icon', array());
        }

        // nav tree asked
        if ($display_nav_tree && !empty($nav_tree))
        {
            $phpbb2_template->assign_block_vars( $tpl . '.row.topic.nav_tree', array());
        }
    } // end for topic_rowset read

    // send an header if missing
    if (!$header_sent)
    {
        $phpbb2_template->assign_block_vars($tpl . '.row', array(
            'L_TITLE'        => $list_title,
            'L_REPLIES'        => $titanium_lang['Replies'],
            'L_AUTHOR'        => $titanium_lang['Author'],
            'L_VIEWS'        => $titanium_lang['Views'],
            'L_LASTPOST'    => $titanium_lang['Last_Post'],
            'COLSPAN'        => $span_all,
            )
        );

        // open a new box
        $phpbb2_template->assign_block_vars($tpl . '.row.header_table', array(
            'COLSPAN'        => $span_left,
            )
        );
    }

    // no data
    if (count($topic_rowset) == 0)
    {
        // send no topics notice
        $phpbb2_template->assign_block_vars( $tpl . '.row', array(
            'L_NO_TOPICS'    => $titanium_lang['No_search_match'],
            'COLSPAN'        => $span_all,
            )
        );
        $phpbb2_template->assign_block_vars( $tpl . '.row.no_topics', array());
    }

    // bottom line
    if (!empty($footer))
    {
        $phpbb2_template->assign_block_vars( $tpl . '.row', array(
            'COLSPAN'        => $span_all,
            'FOOTER'        => $footer,
            )
        );
        $phpbb2_template->assign_block_vars( $tpl . '.row.bottom', array());
    }

    // table closure
    $phpbb2_template->assign_block_vars( $tpl . '.row', array(
        'COLSPAN'        => $span_all,
        )
    );
    $phpbb2_template->assign_block_vars( $tpl . '.row.footer_table', array());

    // spacing
    if (empty($footer))
    {
        // spacing
        $phpbb2_template->assign_block_vars($tpl . '.row', array());
        $phpbb2_template->assign_block_vars($tpl . '.row.spacer', array());
    }

    // transfert to a var
    $phpbb2_template->assign_var_from_handle('_box', $tpl);
    $res = $phpbb2_template->_tpldata['.'][0]['_box'];

    // restore template saved state
    $phpbb2_template->_tpldata = $sav_tpl;

    // assign value to the main template
    $phpbb2_template->assign_vars(array($box => $res));
}

?>