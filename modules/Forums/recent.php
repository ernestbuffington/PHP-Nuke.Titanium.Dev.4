<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/12/2005
      Smilies in Topic Titles                  v1.0.0       08/23/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ($popup != "1"){
    $titanium_module_name = basename(dirname(__FILE__));
    require("modules/".$titanium_module_name."/nukebb.php");
}
else
{
    $phpbb2_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB2', true);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/
include('includes/bbcode.'.$phpEx);
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/

// ############         Edit below         ########################################
$topic_length = '40';     // length of topic title
$topic_limit = '10';      // limit of displayed topics per page
$special_forums = '0';    // specify forums ('0' = no; '1' = yes)
$phpbb2_forum_ids = '';          // IDs of forums; separate them with a comma
$set_mode = 'today';      // set default mode ('today', 'yesterday', 'last24', 'lastweek', 'lastXdays')
$set_days = '3';          // set default days (used for lastXdays mode)
// ############         Edit above         ########################################

$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_RECENT);
titanium_init_userprefs($userdata);

$phpbb2_start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

if( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
    $mode = ( isset($HTTP_GET_VARS['mode']) ) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
}
else
{
    $mode = $set_mode;
}

if( isset($HTTP_GET_VARS['amount_days']) || isset($HTTP_POST_VARS['amount_days']) )
{
    $amount_days = ( isset($HTTP_GET_VARS['amount_days']) ) ? $HTTP_GET_VARS['amount_days'] : $HTTP_POST_VARS['amount_days'];
}
else
{
    $amount_days = $set_days;
}

$phpbb2_page_title = $titanium_lang['Recent_topics'];
include("includes/page_header.php");

$sql_auth = "SELECT * FROM ". FORUMS_TABLE;
if( !$result_auth = $titanium_db->sql_query($sql_auth) )
{
    message_die(GENERAL_ERROR, 'could not query forums information.', '', __LINE__, __FILE__, $sql_auth);
}
$forums = array();
while( $row_auth = $titanium_db->sql_fetchrow($result_auth) )
{
    $forums[] = $row_auth;
}
$titanium_db->sql_freeresult($result_auth);

$phpbb2_is_auth_ary = array();
$phpbb2_is_auth_ary = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);

$except_forums = '\'start\'';
for( $f = 0; $f < count($forums); $f++ )
{
    if( (!$phpbb2_is_auth_ary[$forums[$f]['forum_id']]['auth_read']) || (!$phpbb2_is_auth_ary[$forums[$f]['forum_id']]['auth_view']) )
    {
        if( $except_forums == '\'start\'' )
        {
            $except_forums = $forums[$f]['forum_id'];
        }
        else
        {
            $except_forums .= ','. $forums[$f]['forum_id'];
        }
    }
}

$where_forums = ( $special_forums == '0' ) ? 't.forum_id NOT IN ('. $except_forums .')' : 't.forum_id NOT IN ('. $except_forums .') AND t.forum_id IN ('. $phpbb2_forum_ids .')';

$sql_start = "SELECT t.*, p.poster_id, p.post_username AS last_poster_name, p.post_id, p.post_time, f.forum_name, f.forum_id, u.username AS last_poster, u.user_id AS last_poster_id, u2.username AS first_poster, u2.user_id AS first_poster_id, p2.post_username AS first_poster_name
           FROM (". TOPICS_TABLE ." t, ". POSTS_TABLE ." p, ". POSTS_TABLE ." p2,  ". FORUMS_TABLE ." f, ". USERS_TABLE ." u, ". USERS_TABLE ." u2)
           WHERE
            (p2.post_id = t.topic_first_post_id
            AND p.forum_id = f.forum_id
            AND p.poster_id = u.user_id
            AND u2.user_id = t.topic_poster)
           AND
           ($where_forums)
           AND p.post_id = t.topic_last_post_id AND "; 

$sql_end = "  ORDER BY t.topic_last_post_id DESC LIMIT $phpbb2_start, $topic_limit";

switch( $mode )
{
    case 'today':
        $sql = $sql_start ."FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = 0". $sql_end;
        $phpbb2_template->assign_vars(array('STATUS' => $titanium_lang['Recent_today']));
        $where_count = "$where_forums AND FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = 0";
        $l_mode = $titanium_lang['Recent_title_today'];
        break;

    case 'yesterday':
        $sql = $sql_start ."FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = -1". $sql_end;
        $phpbb2_template->assign_vars(array('STATUS' => $titanium_lang['Recent_yesterday']));
        $where_count = "$where_forums AND FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = -1";
        $l_mode = $titanium_lang['Recent_title_yesterday'];
        break;

    case 'last24':
        $sql = $sql_start ."UNIX_TIMESTAMP(NOW()) - p.post_time < 86400". $sql_end;
        $phpbb2_template->assign_vars(array('STATUS' => $titanium_lang['Recent_last24']));
        $where_count = "$where_forums AND UNIX_TIMESTAMP(NOW()) - p.post_time < 86400";
        $l_mode = $titanium_lang['Recent_title_last24'];
        break;

    case 'lastweek':
        $sql = $sql_start ."UNIX_TIMESTAMP(NOW()) - p.post_time < 691200". $sql_end;
        $phpbb2_template->assign_vars(array('STATUS' => $titanium_lang['Recent_lastweek']));
        $where_count = "$where_forums AND UNIX_TIMESTAMP(NOW()) - p.post_time < 691200";
        $l_mode = $titanium_lang['Recent_title_lastweek'];
        break;

    case 'lastXdays':
        if(!$amount_days || !ctype_digit($amount_days)) {
            $message = 'You must enter a valid day<br /><br />'. sprintf($titanium_lang['Recent_click_return'], '<a href="'. append_titanium_sid("recent.$phpEx") .'">', '</a>') .'<br />'. sprintf($titanium_lang['Click_return_index'], '<a href="'. append_titanium_sid("index.$phpEx") .'">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
            break;
        }
        $sql = $sql_start ."UNIX_TIMESTAMP(NOW()) - p.post_time < 86400 * $amount_days". $sql_end;
        $phpbb2_template->assign_vars(array('STATUS' => sprintf($titanium_lang['Recent_lastXdays'], $amount_days)));
        $where_count = "$where_forums AND UNIX_TIMESTAMP(NOW()) - p.post_time < 86400 * $amount_days";
        $l_mode = sprintf($titanium_lang['Recent_title_lastXdays'], $amount_days);
        break;

    default:
        $message = $titanium_lang['Recent_wrong_mode'] .'<br /><br />'. sprintf($titanium_lang['Recent_click_return'], '<a href="'. append_titanium_sid("recent.$phpEx") .'">', '</a>') .'<br />'. sprintf($titanium_lang['Click_return_index'], '<a href="'. append_titanium_sid("index.$phpEx") .'">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
        break;
}
if( !$result = $titanium_db->sql_query($sql) )
{
    message_die(GENERAL_ERROR, 'could not obtain main information.', '', __LINE__, __FILE__, $sql);
}
$line = array();
while( $row = $titanium_db->sql_fetchrow($result) )
{
    $line[] = $row;
}
$titanium_db->sql_freeresult($result);
        
$phpbb2_template->set_filenames(array('body' => 'recent_body.tpl'));

$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

$phpbb2_tracking_topics = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] .'_t']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] .'_t']) : array();
$phpbb2_tracking_forums = ( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] .'_f']) ) ? unserialize($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] .'_f']) : array();
for( $i = 0; $i < count($line); $i++ )
{
    $phpbb2_forum_id = $line[$i]['forum_id'];
    $forum_url = append_titanium_sid("viewforum.$phpEx?". POST_FORUM_URL ."=$phpbb2_forum_id");
    $topic_id = $line[$i]['topic_id'];
    $topic_url = append_titanium_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id");

    $word_censor = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $line[$i]['topic_title']) : $line[$i]['topic_title'];
    $topic_title = ( strlen($line[$i]['topic_title']) < $topic_length ) ? $word_censor : substr(stripslashes($word_censor), 0, $topic_length) .'...';
/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
    $topic_title = ($phpbb2_board_config['smilies_in_titles']) ? smilies_pass($topic_title) : $topic_title;
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/

    $topic_type =  ( $line[$i]['topic_type'] == POST_ANNOUNCE ) ? $titanium_lang['Topic_Announcement'] .' ': '';
    $topic_type .= ( $line[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE ) ? $titanium_lang['Topic_global_announcement'] .' ': '';
    $topic_type .= ( $line[$i]['topic_type'] == POST_STICKY ) ? $titanium_lang['Topic_Sticky'] .' ': '';
    $topic_type .= ( $line[$i]['topic_vote'] ) ? $titanium_lang['Topic_Poll'] .' ': '';

    $views = $line[$i]['topic_views'];
    $replies = $line[$i]['topic_replies'];
    if( ( $replies + 1 ) > $phpbb2_board_config['posts_per_page'] )
    {
        $total_phpbb2_pages = ceil( ( $replies + 1 ) / $phpbb2_board_config['posts_per_page'] );
        $goto_page = ' [ ';
        $times = '1';
        for( $j = 0; $j < $replies + 1; $j += $phpbb2_board_config['posts_per_page'] )
        {
            $goto_page .= '<a href="'. append_titanium_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=". $topic_id ."&amp;start=$j") .'">'. $times .'</a>';
            if( $times == '1' && $total_phpbb2_pages > '4' )
            {
                $goto_page .= ' ... ';
                $times = $total_phpbb2_pages - 3;
                $j += ( $total_phpbb2_pages - 4 ) * $phpbb2_board_config['posts_per_page'];
            }
            else if( $times < $total_phpbb2_pages )
            {
                $goto_page .= ', ';
            }
            $times++;
        }
        $goto_page .= ' ] ';
    }
    else
    {
        $goto_page = '';
    }

    if( $line[$i]['topic_status'] == TOPIC_LOCKED )
    {
        $folder = $images['folder_locked'];
        $folder_new = $images['folder_locked_new'];
    }
    else if( $line[$i]['topic_type'] == POST_ANNOUNCE )
    {
        $folder = $images['folder_announce'];
        $folder_new = $images['folder_announce_new'];
    }
    else if( $line[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE )
    {
        $folder = $images['folder_global_announce'];
        $folder_new = $images['folder_global_announce_new'];
    }
    else if( $line[$i]['topic_type'] == POST_STICKY )
    {
        $folder = $images['folder_sticky'];
        $folder_new = $images['folder_sticky_new'];
    }
    else
    {
        if( $replies >= $phpbb2_board_config['hot_threshold'] )
        {
            $folder = $images['folder_hot'];
            $folder_new = $images['folder_hot_new'];
        }
        else
        {
            $folder = $images['folder'];
            $folder_new = $images['folder_new'];
        }
    }

    $newest_img = '';
    if( $userdata['session_logged_in'] )
    {
        if( $line[$i]['post_time'] > $userdata['user_lastvisit'] ) 
        {
            if( !empty($phpbb2_tracking_topics) || !empty($phpbb2_tracking_forums) || isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] .'_f_all']) )
            {
                $phpbb2_unread_topics = true;
                if( !empty($phpbb2_tracking_topics[$topic_id]) )
                {
                    if( $phpbb2_tracking_topics[$topic_id] >= $line[$i]['post_time'] )
                    {
                        $phpbb2_unread_topics = false;
                    }
                }
                if( !empty($phpbb2_tracking_forums[$phpbb2_forum_id]) )
                {
                    if( $phpbb2_tracking_forums[$phpbb2_forum_id] >= $line[$i]['post_time'] )
                    {
                        $phpbb2_unread_topics = false;
                    }
                }
                if( isset($HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] .'_f_all']) )
                {
                    if( $HTTP_COOKIE_VARS[$phpbb2_board_config['cookie_name'] .'_f_all'] >= $line[$i]['post_time'] )
                    {
                        $phpbb2_unread_topics = false;
                    }
                }

                if( $phpbb2_unread_topics )
                {
                    $phpbb2_folder_image = $folder_new;
                    $phpbb2_folder_alt = $titanium_lang['New_posts'];
                    $newest_img = '<a href="'. append_titanium_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id&amp;view=newest") .'"><img src="'. $images['icon_newest_reply'] .'" alt="'. $titanium_lang['View_newest_post'] .'" title="'. $titanium_lang['View_newest_post'] .'" border="0" /></a> ';
                }
                else
                {
                    $phpbb2_folder_image = $folder;
                    $phpbb2_folder_alt = ( $line[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
                    $newest_img = '';
                }
            }
            else
            {
                $phpbb2_folder_image = $folder_new;
                $phpbb2_folder_alt = ( $line[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['New_posts'];
                $newest_img = '<a href="'. append_titanium_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id&amp;view=newest") .'"><img src="'. $images['icon_newest_reply'] .'" alt="'. $titanium_lang['View_newest_post'] .'" title="'. $titanium_lang['View_newest_post'] .'" border="0" /></a> ';
            }
        }
        else 
        {
            $phpbb2_folder_image = $folder;
            $phpbb2_folder_alt = ( $line[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
            $newest_img = '';
        }
    }
    else
    {
        $phpbb2_folder_image = $folder;
        $phpbb2_folder_alt = ( $line[$i]['topic_status'] == TOPIC_LOCKED ) ? $titanium_lang['Topic_locked'] : $titanium_lang['No_new_posts'];
        $newest_img = '';
    }
            
    $first_time = create_date($phpbb2_board_config['default_dateformat'], $line[$i]['topic_time'], $phpbb2_board_config['board_timezone']);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $first_author = ( $line[$i]['first_poster_id'] != ANONYMOUS ) ? '<a href="'. append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $line[$i]['first_poster_id']) .'">' . UsernameColor($line[$i]['first_poster']) .'</a>' : ( ($line[$i]['first_poster_name'] != '' ) ? $line[$i]['first_poster_name'] : $titanium_lang['Guest'] );
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $last_time = create_date($phpbb2_board_config['default_dateformat'], $line[$i]['post_time'], $phpbb2_board_config['board_timezone']);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $last_author = ( $line[$i]['last_poster_id'] != ANONYMOUS ) ? '<a href="'. append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $line[$i]['last_poster_id']) .'">' . UsernameColor($line[$i]['last_poster']) .'</a>' : ( ($line[$i]['last_poster_name'] != '' ) ? $line[$i]['last_poster_name'] : $titanium_lang['Guest'] );
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $last_url = '<a href="'. append_titanium_sid("viewtopic.$phpEx?". POST_POST_URL .'='. $line[$i]['topic_last_post_id']) .'#'. $line[$i]['topic_last_post_id'] .'"><img src="'. $images['icon_latest_reply'] .'" alt="'. $titanium_lang['View_latest_post'] .'" title="'. $titanium_lang['View_latest_post'] .'" border="0" /></a>';

    $phpbb2_template->assign_block_vars('recent', array(
        'ROW_CLASS' => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
        'TOPIC_TITLE' => $topic_title,
        'TOPIC_TYPE' => $topic_type,
        'GOTO_PAGE' => $goto_page,
        'L_VIEWS' => $titanium_lang['Views'],
        'VIEWS' => $views,
        'L_REPLIES' => $titanium_lang['Replies'],
        'REPLIES' => $replies,
        'NEWEST_IMG' => $newest_img,
        'TOPIC_FOLDER_IMG' => $phpbb2_folder_image,
        'TOPIC_FOLDER_ALT' => $phpbb2_folder_alt,
        'FIRST_TIME' => sprintf($titanium_lang['Recent_first'], $first_time),
        'FIRST_AUTHOR' => sprintf($titanium_lang['Recent_first_poster'], $first_author),
        'LAST_TIME' => $last_time,
        'LAST_AUTHOR' => $last_author,
        'LAST_URL' => $last_url,
        'FORUM_NAME' => $line[$i]['forum_name'],
        'U_VIEW_FORUM' => $forum_url,
        'U_VIEW_TOPIC' => $topic_url,
    ));
}

$sql = "SELECT count(t.topic_id) AS total_topics FROM ". TOPICS_TABLE ." t , ". POSTS_TABLE ." p
           WHERE $where_count AND p.post_id = t.topic_last_post_id";
if( !($result = $titanium_db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'error getting total topics.', '', __LINE__, __FILE__, $sql);
}
if( $total = $titanium_db->sql_fetchrow($result) )
{
    $total_phpbb2_topics = $total['total_topics'];
    $pagination = generate_pagination("recent.$phpEx?amount_days=$amount_days&amp;mode=$mode", $total_phpbb2_topics, $topic_limit, $phpbb2_start) .'&nbsp;';
}

if( $total_phpbb2_topics == '0' )
{
    $phpbb2_template->assign_block_vars('switch_no_topics', array());
}

$phpbb2_template->assign_vars(array(
    'L_RECENT_TITLE' => ( $total_phpbb2_topics == '1' ) ? sprintf($titanium_lang['Recent_title_one'], $total_phpbb2_topics, $l_mode) : sprintf($titanium_lang['Recent_title_more'], $total_phpbb2_topics, $l_mode),
    'L_TODAY' => $titanium_lang['Recent_today'],
    'L_YESTERDAY' => $titanium_lang['Recent_yesterday'],
    'L_LAST24' => $titanium_lang['Recent_last24'],
    'L_LASTWEEK' => $titanium_lang['Recent_lastweek'],
    'L_LAST' => $titanium_lang['Recent_last'],
    'L_DAYS' => $titanium_lang['Recent_days'],
    'L_SELECT_MODE' => $titanium_lang['Recent_select_mode'],
    'L_SHOWING_POSTS' => $titanium_lang['Recent_showing_posts'],
    'L_NO_TOPICS' => $titanium_lang['Recent_no_topics'],
    'AMOUNT_DAYS' => $amount_days,
    'FORM_ACTION' => append_titanium_sid("recent.$phpEx"),
    'PAGINATION' => ( $total_phpbb2_topics != '0' ) ? $pagination : '',
    'PAGE_NUMBER' => ( $total_phpbb2_topics != '0' ) ? sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $topic_limit ) + 1 ), ceil( $total_phpbb2_topics / $topic_limit )) : '',
));

$phpbb2_template->pparse('body');
include("includes/page_tail.php");

?>