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
-=[Last Update]=-
      11/29/2022 2:01 pm Ernest Allen Buffington	  
 ************************************************************************/
if(!defined('MODULE_FILE')):
  die ("You can't access this file directly...");
endif;

if($popup != "1"):
    $module_name = basename(dirname(__FILE__));
    require("modules/".$module_name."/nukebb.php");
else:
    $phpbb_root_path = NUKE_FORUMS_DIR;
endif;

define('IN_PHPBB', true);

include($phpbb_root_path . 'extension.inc');

include($phpbb_root_path . 'common.'.$phpEx);

# Mod: Smilies in Topic Titles v1.0.0
include('includes/bbcode.'.$phpEx);
# Mod: Smilies in Topic Titles v1.0.0 

############ Edit below ########################################
$topic_length = '40';   #  length of topic title
$topic_limit = '10';    #  limit of displayed topics per page
$special_forums = '0';  #  specify forums ('0' = no; '1' = yes)
$forum_ids = '';        #  IDs of forums; separate them with a comma
$set_mode = 'today';    #  set default mode ('today', 'yesterday', 'last24', 'lastweek', 'lastXdays')
$set_days = '3';        #  set default days (used for lastXdays mode)
############ Edit above ########################################

$userdata = session_pagestart($user_ip, PAGE_RECENT);

init_userprefs($userdata);

$start = (isset($HTTP_GET_VARS['start'])) ? intval($HTTP_GET_VARS['start']) : 0;

if(isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode'])):
    $mode = ( isset($HTTP_GET_VARS['mode']) ) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
else:
    $mode = $set_mode;
endif;

if(isset($HTTP_GET_VARS['amount_days']) || isset($HTTP_POST_VARS['amount_days'])):
    $amount_days = ( isset($HTTP_GET_VARS['amount_days']) ) ? $HTTP_GET_VARS['amount_days'] : $HTTP_POST_VARS['amount_days'];
else:
    $amount_days = $set_days;
endif;

$page_title = $lang['Recent_topics'];

include("includes/page_header.php");

$sql_auth = "SELECT * FROM ". FORUMS_TABLE;

if(!$result_auth = $db->sql_query($sql_auth)):
    message_die(GENERAL_ERROR, 'could not query forums information.', '', __LINE__, __FILE__, $sql_auth);
endif;

$forums = array();

while($row_auth = $db->sql_fetchrow($result_auth)):
    $forums[] = $row_auth;
endwhile;

$db->sql_freeresult($result_auth);

$is_auth_ary = array();

$is_auth_ary = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);

$except_forums = '\'start\'';

for($f = 0; $f < count($forums); $f++):
    if((!$is_auth_ary[$forums[$f]['forum_id']]['auth_read']) || (!$is_auth_ary[$forums[$f]['forum_id']]['auth_view'])):
        if($except_forums == '\'start\''):
            $except_forums = $forums[$f]['forum_id'];
        else:
            $except_forums .= ','. $forums[$f]['forum_id'];
        endif;
    endif;
endfor;

$where_forums = ( $special_forums == '0' ) ? 't.forum_id NOT IN ('. $except_forums .')' : 't.forum_id NOT IN ('. $except_forums .') AND t.forum_id IN ('. $forum_ids .')';

$sql_start = "SELECT t.*, p.poster_id, p.post_username 

AS last_poster_name, p.post_id, p.post_time, f.forum_name, f.forum_id, u.username 

AS last_poster, u.user_id 

AS last_poster_id, u2.username 

AS first_poster, u2.user_id 

AS first_poster_id, p2.post_username 

AS first_poster_name

FROM (". TOPICS_TABLE ." t, ". POSTS_TABLE ." p, ". POSTS_TABLE ." p2,  ". FORUMS_TABLE ." f, ". USERS_TABLE ." u, ". USERS_TABLE ." u2)

WHERE (p2.post_id = t.topic_first_post_id

AND p.forum_id = f.forum_id

AND p.poster_id = u.user_id

AND u2.user_id = t.topic_poster)

AND ($where_forums)

AND p.post_id = t.topic_last_post_id AND "; 

$sql_end = "  ORDER BY t.topic_last_post_id DESC LIMIT $start, $topic_limit";

switch($mode):
    case 'today':
        $sql = $sql_start ."FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = 0". $sql_end;
        $template->assign_vars(array('STATUS' => $lang['Recent_today']));
        $where_count = "$where_forums AND FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = 0";
        $l_mode = $lang['Recent_title_today'];
        break;
    case 'yesterday':
        $sql = $sql_start ."FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = -1". $sql_end;
        $template->assign_vars(array('STATUS' => $lang['Recent_yesterday']));
        $where_count = "$where_forums AND FROM_UNIXTIME(p.post_time,'%Y%m%d') - FROM_UNIXTIME(unix_timestamp(NOW()),'%Y%m%d') = -1";
        $l_mode = $lang['Recent_title_yesterday'];
        break;
    case 'last24':
        $sql = $sql_start ."UNIX_TIMESTAMP(NOW()) - p.post_time < 86400". $sql_end;
        $template->assign_vars(array('STATUS' => $lang['Recent_last24']));
        $where_count = "$where_forums AND UNIX_TIMESTAMP(NOW()) - p.post_time < 86400";
        $l_mode = $lang['Recent_title_last24'];
        break;
    case 'lastweek':
        $sql = $sql_start ."UNIX_TIMESTAMP(NOW()) - p.post_time < 691200". $sql_end;
        $template->assign_vars(array('STATUS' => $lang['Recent_lastweek']));
        $where_count = "$where_forums AND UNIX_TIMESTAMP(NOW()) - p.post_time < 691200";
        $l_mode = $lang['Recent_title_lastweek'];
        break;
    case 'lastXdays':
        if(!$amount_days || !ctype_digit($amount_days)) {
            $message = 'You must enter a valid day<br /><br />'. sprintf($lang['Recent_click_return'], '<a href="'. append_sid("recent.$phpEx") .'">', '</a>') .'<br />'. sprintf($lang['Click_return_index'], '<a 
			href="'. append_sid("index.$phpEx") .'">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
            break;
        }
        $sql = $sql_start ."UNIX_TIMESTAMP(NOW()) - p.post_time < 86400 * $amount_days". $sql_end;
        $template->assign_vars(array('STATUS' => sprintf($lang['Recent_lastXdays'], $amount_days)));
        $where_count = "$where_forums AND UNIX_TIMESTAMP(NOW()) - p.post_time < 86400 * $amount_days";
        $l_mode = sprintf($lang['Recent_title_lastXdays'], $amount_days);
        break;
    default:
        $message = $lang['Recent_wrong_mode'] .'<br /><br />'. sprintf($lang['Recent_click_return'], '<a href="'. append_sid("recent.$phpEx") .'">', '</a>') .'<br />'. sprintf($lang['Click_return_index'], '<a 
		href="'. append_sid("index.$phpEx") .'">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
        break;
endswitch;

if(!$result = $db->sql_query($sql)):
    message_die(GENERAL_ERROR, 'could not obtain main information.', '', __LINE__, __FILE__, $sql);
endif;

$line = array();

while($row = $db->sql_fetchrow($result)):
    $line[] = $row;
endwhile;

$db->sql_freeresult($result);
        
$template->set_filenames(array('body' => 'recent_body.tpl'));

$orig_word = array();

$replacement_word = array();

obtain_word_list($orig_word, $replacement_word);

$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_t']) : array();
$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f']) : array();

for($i = 0; $i < count($line); $i++):

    $forum_id = $line[$i]['forum_id'];
    $forum_url = append_sid("viewforum.$phpEx?". POST_FORUM_URL ."=$forum_id");
    $topic_id = $line[$i]['topic_id'];
    $topic_url = append_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id");

    $word_censor = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $line[$i]['topic_title']) : $line[$i]['topic_title'];
    $topic_title = ( strlen($line[$i]['topic_title']) < $topic_length ) ? $word_censor : substr(stripslashes($word_censor), 0, $topic_length) .'...';
    
	# Mod: Smilies in Topic Titles v1.0.0 
    # Mod: Smilies in Topic Titles Toggle v1.0.0 
    $topic_title = ($board_config['smilies_in_titles']) ? smilies_pass($topic_title) : $topic_title;
    # Mod: Smilies in Topic Titles Toggle v1.0.0 
    # Mod: Smilies in Topic Titles v1.0.0

    $topic_type =  ( $line[$i]['topic_type'] == POST_ANNOUNCE ) ? $lang['Topic_Announcement'] .' ': '';
    $topic_type .= ( $line[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE ) ? $lang['Topic_global_announcement'] .' ': '';
    $topic_type .= ( $line[$i]['topic_type'] == POST_STICKY ) ? $lang['Topic_Sticky'] .' ': '';
    $topic_type .= ( $line[$i]['topic_vote'] ) ? $lang['Topic_Poll'] .' ': '';

    $views = $line[$i]['topic_views'];
    $replies = $line[$i]['topic_replies'];
	
    if(($replies + 1) > $board_config['posts_per_page']):
    
        $total_pages = ceil( ( $replies + 1 ) / $board_config['posts_per_page']);
        $goto_page = ' [ ';
        $times = '1';
		
        for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page']):
        
            $goto_page .= '<a href="'. append_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=". $topic_id ."&amp;start=$j") .'">'. $times .'</a>';
            
			if($times == '1' && $total_pages > '4'):
                $goto_page .= ' ... ';
                $times = $total_pages - 3;
                $j += ( $total_pages - 4 ) * $board_config['posts_per_page'];
            elseif($times < $total_pages):
                $goto_page .= ', ';
            endif;
			
            $times++;
        
		endfor;
        
		$goto_page .= ' ] ';
    
    else:
        $goto_page = '';
    endif;

    if($line[$i]['topic_status'] == TOPIC_LOCKED):
        $folder = $images['folder_locked'];
        $folder_new = $images['folder_locked_new'];
    elseif($line[$i]['topic_type'] == POST_ANNOUNCE):
        $folder = $images['folder_announce'];
        $folder_new = $images['folder_announce_new'];
    elseif($line[$i]['topic_type'] == POST_GLOBAL_ANNOUNCE):
        $folder = $images['folder_global_announce'];
        $folder_new = $images['folder_global_announce_new'];
    elseif($line[$i]['topic_type'] == POST_STICKY):
        $folder = $images['folder_sticky'];
        $folder_new = $images['folder_sticky_new'];
    else:
        if($replies >= $board_config['hot_threshold']):
            $folder = $images['folder_hot'];
            $folder_new = $images['folder_hot_new'];
        else:
            $folder = $images['folder'];
            $folder_new = $images['folder_new'];
        endif;
    endif;

    $newest_img = '';
	
    if($userdata['session_logged_in']):
        if($line[$i]['post_time'] > $userdata['user_lastvisit']): 
            if(!empty($tracking_topics) || !empty($tracking_forums) || isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f_all'])):
            
                $unread_topics = true;
              
			    if(!empty($tracking_topics[$topic_id])):
                    if($tracking_topics[$topic_id] >= $line[$i]['post_time']):
                        $unread_topics = false;
                    endif;
                endif;
              
			    if(!empty($tracking_forums[$forum_id])):
                    if($tracking_forums[$forum_id] >= $line[$i]['post_time']):
                        $unread_topics = false;
                    endif;
                endif;
              
			    if(isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f_all'])):
                    if($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f_all'] >= $line[$i]['post_time']):
                        $unread_topics = false;
                    endif;
                endif;

                if($unread_topics):
                    $folder_image = $folder_new;
                    $folder_alt = $lang['New_posts'];
                    $newest_img = '<a href="'. append_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id&amp;view=newest") .'"><img 
					src="'. $images['icon_newest_reply'] .'" alt="'. $lang['View_newest_post'] .'" title="'. $lang['View_newest_post'] .'" border="0" /></a> ';
                else:
                    $folder_image = $folder;
                    $folder_alt = ($line[$i]['topic_status'] == TOPIC_LOCKED) ? $lang['Topic_locked'] : $lang['No_new_posts'];
                    $newest_img = '';
                endif;
            
            else:
                $folder_image = $folder_new;
                $folder_alt = ($line[$i]['topic_status'] == TOPIC_LOCKED) ? $lang['Topic_locked'] : $lang['New_posts'];
                $newest_img = '<a href="'. append_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id&amp;view=newest") .'"><img 
				src="'. $images['icon_newest_reply'] .'" alt="'. $lang['View_newest_post'] .'" title="'. $lang['View_newest_post'] .'" border="0" /></a> ';
            endif;
        
        else: 
            $folder_image = $folder;
            $folder_alt = ($line[$i]['topic_status'] == TOPIC_LOCKED) ? $lang['Topic_locked'] : $lang['No_new_posts'];
            $newest_img = '';
        endif;
    else:
        $folder_image = $folder;
        $folder_alt = ($line[$i]['topic_status'] == TOPIC_LOCKED) ? $lang['Topic_locked'] : $lang['No_new_posts'];
        $newest_img = '';
    endif;
            
    $first_time = create_date($board_config['default_dateformat'], $line[$i]['topic_time'], $board_config['board_timezone']);
    
	# Mod: Advanced Username Color v1.0.5 START
    $first_author = ( $line[$i]['first_poster_id'] != ANONYMOUS ) ? '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $line[$i]['first_poster_id']) .'">' 
	. UsernameColor($line[$i]['first_poster']) .'</a>' : ( ($line[$i]['first_poster_name'] != '' ) ? $line[$i]['first_poster_name'] : $lang['Guest'] );
    # Mod: Advanced Username Color v1.0.5 END
    
	$last_time = create_date($board_config['default_dateformat'], $line[$i]['post_time'], $board_config['board_timezone']);

    # Mod: Advanced Username Color v1.0.5 START
    $last_author = ( $line[$i]['last_poster_id'] != ANONYMOUS ) ? '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $line[$i]['last_poster_id']) .'">' 
	. UsernameColor($line[$i]['last_poster']) .'</a>' : ( ($line[$i]['last_poster_name'] != '' ) ? $line[$i]['last_poster_name'] : $lang['Guest'] );
    # Mod: Advanced Username Color v1.0.5 END
    
	$last_url = '<a href="'. append_sid("viewtopic.$phpEx?". POST_POST_URL .'='. $line[$i]['topic_last_post_id']) .'#'. $line[$i]['topic_last_post_id'] .'"><img src="'
	. $images['icon_latest_reply'] .'" alt="'. $lang['View_latest_post'] .'" title="'. $lang['View_latest_post'] .'" border="0" /></a>';

    $template->assign_block_vars('recent', array(
        'ROW_CLASS' => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
        'TOPIC_TITLE' => $topic_title,
        'TOPIC_TYPE' => $topic_type,
        'GOTO_PAGE' => $goto_page,
        'L_VIEWS' => $lang['Views'],
        'VIEWS' => $views,
        'L_REPLIES' => $lang['Replies'],
        'REPLIES' => $replies,
        'NEWEST_IMG' => $newest_img,
        'TOPIC_FOLDER_IMG' => $folder_image,
        'TOPIC_FOLDER_ALT' => $folder_alt,
        'FIRST_TIME' => sprintf($lang['Recent_first'], $first_time),
        'FIRST_AUTHOR' => sprintf($lang['Recent_first_poster'], $first_author),
        'LAST_TIME' => $last_time,
        'LAST_AUTHOR' => $last_author,
        'LAST_URL' => $last_url,
        'FORUM_NAME' => $line[$i]['forum_name'],
        'U_VIEW_FORUM' => $forum_url,
        'U_VIEW_TOPIC' => $topic_url,
    ));
endfor;

$sql = "SELECT count(t.topic_id) 

AS total_topics 

FROM ". TOPICS_TABLE ." t , ". POSTS_TABLE ." p

WHERE $where_count 

AND p.post_id = t.topic_last_post_id";

if(!($result = $db->sql_query($sql))):
    message_die(GENERAL_ERROR, 'error getting total topics.', '', __LINE__, __FILE__, $sql);
endif;

if($total = $db->sql_fetchrow($result)):
    $total_topics = $total['total_topics'];
    $pagination = generate_pagination("recent.$phpEx?amount_days=$amount_days&amp;mode=$mode", $total_topics, $topic_limit, $start) .'&nbsp;';
endif;

if($total_topics == '0'):
    $template->assign_block_vars('switch_no_topics', array());
endif;

$template->assign_vars(array(
    'L_RECENT_TITLE' => ( $total_topics == '1' ) ? sprintf($lang['Recent_title_one'], $total_topics, $l_mode) : sprintf($lang['Recent_title_more'], $total_topics, $l_mode),
    'L_TODAY' => $lang['Recent_today'],
    'L_YESTERDAY' => $lang['Recent_yesterday'],
    'L_LAST24' => $lang['Recent_last24'],
    'L_LASTWEEK' => $lang['Recent_lastweek'],
    'L_LAST' => $lang['Recent_last'],
    'L_DAYS' => $lang['Recent_days'],
    'L_SELECT_MODE' => $lang['Recent_select_mode'],
    'L_SHOWING_POSTS' => $lang['Recent_showing_posts'],
    'L_NO_TOPICS' => $lang['Recent_no_topics'],
    'AMOUNT_DAYS' => $amount_days,
    'FORM_ACTION' => append_sid("recent.$phpEx"),
    'PAGINATION' => ( $total_topics != '0' ) ? $pagination : '',
    'PAGE_NUMBER' => ( $total_topics != '0' ) ? sprintf($lang['Page_of'], ( floor( $start / $topic_limit ) + 1 ), ceil( $total_topics / $topic_limit )) : '',
));

$template->pparse('body');

include("includes/page_tail.php");

?>
