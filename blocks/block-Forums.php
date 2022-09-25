<?php

if(!defined('NUKE_EVO')) 
	exit;

global $titanium_db, $block_title, $titanium_user_prefix, $titanium_prefix, $cache, $blockslang, $images, $phpbb2_board_config, $phpbb2_board_config, $userinfo;

define('forum_board_icon_path','themes/'.get_theme().'/forums');

$block_title = 'Last 10 Forums Post\'s';
$last_new_topics     = 10;
$show_started_by	 = true;
$alternate_row_class = true;

$table  = '<br /><table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width:100%">'.PHP_EOL;
$table .= '  <tr>'.PHP_EOL;
$table .= '    <td style="width: 4%"></td>'.PHP_EOL;
$table .= '    <td style="width: 46%">'.$blockslang['forums']['topic'].'</td>'.PHP_EOL;
$table .= '    <td colspan="2" style="width: 25%">'.$blockslang['forums']['forum'].'</td>'.PHP_EOL;
$table .= '    <td style="width: 25%">'.$blockslang['forums']['last_post'].'</td>'.PHP_EOL;
$table .= '  </tr>'.PHP_EOL;

$count_topics = 0;
// $where = ($SplitAnnouncements) ? "AND t.topic_type != '2' AND t.topic_type != '3'" : "";
// $where .= ($HideViewReadOnly) ? " AND f.auth_view = '0' AND f.auth_read = '0'" : "";

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
// if (!$phpbb2_topic_data = $cache->load('topic_data', 'home')):
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
	$phpbb2_topic_data = array();
	$result = $titanium_db->sql_query("SELECT t.topic_id, t.topic_type, t.topic_attachment, f.forum_name, f.forum_color, f.forum_id, t.topic_last_post_id, t.topic_first_post_id, t.topic_title, t.topic_poster, t.topic_views, t.topic_replies, t.topic_status, p.post_time, p.poster_id, pu.username as postername, u.username, u.user_id FROM ".$titanium_prefix."_bbtopics t, ".$titanium_prefix."_bbforums f, ".$titanium_prefix."_bbposts p, ".$titanium_user_prefix."_users u, ".$titanium_user_prefix."_users pu WHERE t.forum_id=f.forum_id AND p.post_id=t.topic_last_post_id AND u.user_id=t.topic_poster AND pu.user_id=p.poster_id AND t.topic_moved_id = '0' ORDER BY topic_last_post_id DESC LIMIT $last_new_topics");

	while ( list( $topic_id, $topic_type, $topic_attachment, $forum_name, $forum_color, $phpbb2_forum_id, $topic_last_post_id, $topic_first_post_id, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_status, $post_time, $poster_id, $poster_name, $titanium_username, $titanium_user_id ) = $titanium_db->sql_fetchrow( $result)) 
	{
	        $phpbb2_topic_data[$topic_id]['topic_id'] 			  = $topic_id;
	        $phpbb2_topic_data[$topic_id]['topic_type'] 		  = $topic_type;
			$phpbb2_topic_data[$topic_id]['topic_attachment'] 	  = $topic_attachment;
	        $phpbb2_topic_data[$topic_id]['forum_name'] 		  = $forum_name;
			$phpbb2_topic_data[$topic_id]['forum_color'] 		  = $forum_color;
	        $phpbb2_topic_data[$topic_id]['forum_id'] 			  = $phpbb2_forum_id;
	        $phpbb2_topic_data[$topic_id]['topic_last_post_id']  = $topic_last_post_id;
	        $phpbb2_topic_data[$topic_id]['topic_first_post_id'] = $topic_first_post_id;
	        $phpbb2_topic_data[$topic_id]['topic_title'] 		  = $topic_title;
	        $phpbb2_topic_data[$topic_id]['topic_poster'] 		  = $topic_poster;
	        $phpbb2_topic_data[$topic_id]['topic_views'] 		  = $topic_views;
	        $phpbb2_topic_data[$topic_id]['topic_replies'] 	  = $topic_replies;
			$phpbb2_topic_data[$topic_id]['topic_status'] 		  = $topic_status;
	        $phpbb2_topic_data[$topic_id]['post_time'] 		  = $post_time;
	        $phpbb2_topic_data[$topic_id]['poster_id'] 		  = $poster_id;
	        $phpbb2_topic_data[$topic_id]['poster_name'] 		  = $poster_name;
	        $phpbb2_topic_data[$topic_id]['username'] 			  = $titanium_username;
	        $phpbb2_topic_data[$topic_id]['user_id'] 			  = $titanium_user_id;
	}
	$titanium_db->sql_freeresult($result);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
	// $cache->save('topic_data', 'home', $phpbb2_topic_data);	
// endif;
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

if ($phpbb2_topic_data):

	$phpbb2_topic_data = (is_array($phpbb2_topic_data)) ? $phpbb2_topic_data : array();
	foreach($phpbb2_topic_data as $topic_info):

		$row_class = ($count_topics % 2 && $alternate_row_class) ? "row3" : "row1";
		$count_topics += 1;

		$phpbb2_startedby = ($show_started_by == true) ? '<br /><span class="textmed">'.sprintf($blockslang['forums']['started'],'<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$topic_info['user_id'].'">'.UsernameColor($topic_info['username']).'</a>').'</span>' : '';

		$img_hot = ( file_exists(forum_board_icon_path.'/images/board/folder_hot.png') ) ? '/images/board/folder_hot.png' : '/images/board/folder_hot.gif';
		$img     = ( file_exists(forum_board_icon_path.'/images/board/folder.png') ) ? '/images/board/folder.png' : '/images/board/folder.gif';

		$forum_img = ($topic_info['topic_replies'] >= $phpbb2_board_config['hot_threshold']) ? $img_hot : $img;


		$topic_info['forum_name'] = ($topic_info['forum_color']) ? '<span style="color: #'.$topic_info['forum_color'].'">'.$topic_info['forum_name'].'</span>' : $topic_info['forum_name'];

		$table .= '  <tr>'.PHP_EOL;
		$table .= '    <td class="'.$row_class.' acenter"><img style="width: 25px; height: 25px" src="'.forum_board_icon_path.$forum_img.'" border="0" /></td>'.PHP_EOL;
		$table .= '    <td class="'.$row_class.'"><a href="modules.php?name=Forums&amp;file=viewtopic&amp;p='.$topic_info['topic_first_post_id'].'">'.$topic_info['topic_title'].'</a>'.$phpbb2_startedby.'</td>'.PHP_EOL; // #'.$topic_info['topic_first_post_id'].'
		$table .= '    <td class="'.$row_class.'"><a href="modules.php?name=Forums&amp;file=viewforum&amp;f='.$topic_info['forum_id'].'">'.$topic_info['forum_name'].'</a></td>'.PHP_EOL;
		$table .= '    <td class="'.$row_class.'" nowrap>'.$topic_info['topic_replies'].'&nbsp;'.$blockslang['global']['replies'].'<br />'.$topic_info['topic_views'].'&nbsp;'.$blockslang['global']['views'].'</td>'.PHP_EOL;
		$table .= '    <td class="'.$row_class.' lastpost" nowrap><a href="modules.php?name=Forums&amp;file=viewtopic&amp;p='.$topic_info['topic_last_post_id'].'#'.$topic_info['topic_last_post_id'].'"><i class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$blockslang['forums']['view_latest'].'"></i></a>'.EvoDate( 'M jS Y g:i a' , $topic_info['post_time'] , $userinfo['user_timezone'] ).'<br />'.sprintf($blockslang['forums']['by'],'<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$topic_info['poster_id'].'">'.UsernameColor($topic_info['poster_name']).'</a>').'</td>'.PHP_EOL;
		$table .= '  </tr>'.PHP_EOL;

	endforeach;

else:

	$table .= '  <tr>'.PHP_EOL;
	$table .= '    <td class="row1" style="text-align: center" colspan="5">'.$blockslang['forums']['none'].'</td>'.PHP_EOL;
	$table .= '  </tr>'.PHP_EOL;

endif;

$table .= '</table><br />'.PHP_EOL;
$content = $table;
?>