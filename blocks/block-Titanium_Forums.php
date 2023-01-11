<?php

if(!defined('NUKE_EVO')): 
 exit;
endif;

global $db, $block_title, $user_prefix, $prefix, $cache, $blockslang, $images, $board_config, $board_config, $userinfo;

define('forum_board_icon_path','themes/'.get_theme().'/forums');

$block_title = 'Last 10 Forums Post\'s';
$last_new_topics     = 5;
$show_started_by	 = true;
$alternate_row_class = true;

$table  = '<div style="padding: 6px;" align="center">';
$table .= '<table style="padding: 3px; width: 99%; margin-left: auto; margin-right: auto;" class="forumline rounded-corners" cellpadding="6">'.PHP_EOL;
$table .= '  <tr>'.PHP_EOL;
$table .= '    <td class="catHead" style="width: "></td>'.PHP_EOL;
$table .= '    <td class="catHead" style="width: 500px;">'.$blockslang['forums']['topic'].'</td>'.PHP_EOL;
$table .= '    <td class="catHead" colspan="2" style="width: 330px">'.$blockslang['forums']['forum'].'</td>'.PHP_EOL;
$table .= '    <td class="catHead" style="width: 195px">'.$blockslang['forums']['last_post'].'</td>'.PHP_EOL;
$table .= '  </tr>'.PHP_EOL;

$count_topics = 0;
// $where = ($SplitAnnouncements) ? "AND t.topic_type != '2' AND t.topic_type != '3'" : "";
// $where .= ($HideViewReadOnly) ? " AND f.auth_view = '0' AND f.auth_read = '0'" : "";

	$topic_data = array();
	$result = $db->sql_query("SELECT t.topic_id, 
	                               t.topic_type, 
							 t.topic_attachment, 
							       f.forum_name, 
								  f.forum_color, 
								     f.forum_id, 
						   t.topic_last_post_id, 
						  t.topic_first_post_id, 
						          t.topic_title, 
								 t.topic_poster, 
								  t.topic_views, 
								t.topic_replies, 
								 t.topic_status, 
								    p.post_time, 
									p.poster_id, 
									pu.username as postername, 
									               u.username, 
												    u.user_id FROM ".$prefix."_bbtopics t, 
													               ".$prefix."_bbforums f, 
																   ".$prefix."_bbposts p, 
																   ".$user_prefix."_users u, 
																   ".$user_prefix."_users pu WHERE t.forum_id=f.forum_id 
																   
																   AND p.post_id=t.topic_last_post_id 
																   
																   AND u.user_id=t.topic_poster 
																   
																   AND pu.user_id=p.poster_id 
																   
																   AND t.topic_moved_id = '0' 
																   
																   ORDER BY topic_last_post_id DESC LIMIT $last_new_topics");

	while ( list( $topic_id, 
	            $topic_type, 
		  $topic_attachment, 
		        $forum_name, 
			   $forum_color, 
			      $forum_id, 
	    $topic_last_post_id, 
	   $topic_first_post_id, 
	           $topic_title, 
			  $topic_poster, 
			   $topic_views, 
			 $topic_replies, 
			  $topic_status, 
			     $post_time, 
				 $poster_id, 
			   $poster_name, 
			      $username, 
				   $user_id ) = $db->sql_fetchrow( $result)) 
	{
	        $topic_data[$topic_id]['topic_id'] 			  = $topic_id;
	        $topic_data[$topic_id]['topic_type'] 		  = $topic_type;
			$topic_data[$topic_id]['topic_attachment'] 	  = $topic_attachment;
	        $topic_data[$topic_id]['forum_name'] 		  = $forum_name;
			$topic_data[$topic_id]['forum_color'] 		  = $forum_color;
	        $topic_data[$topic_id]['forum_id'] 			  = $forum_id;
	        $topic_data[$topic_id]['topic_last_post_id']  = $topic_last_post_id;
	        $topic_data[$topic_id]['topic_first_post_id'] = $topic_first_post_id;
	        $topic_data[$topic_id]['topic_title'] 		  = $topic_title;
	        $topic_data[$topic_id]['topic_poster'] 		  = $topic_poster;
	        $topic_data[$topic_id]['topic_views'] 		  = $topic_views;
	        $topic_data[$topic_id]['topic_replies'] 	  = $topic_replies;
			$topic_data[$topic_id]['topic_status'] 		  = $topic_status;
	        $topic_data[$topic_id]['post_time'] 		  = $post_time;
	        $topic_data[$topic_id]['poster_id'] 		  = $poster_id;
	        $topic_data[$topic_id]['poster_name'] 		  = $poster_name;
	        $topic_data[$topic_id]['username'] 			  = $username;
	        $topic_data[$topic_id]['user_id'] 			  = $user_id;
	}
	$db->sql_freeresult($result);

if ($topic_data):

	$topic_data = (is_array($topic_data)) ? $topic_data : array();
	foreach($topic_data as $topic_info):

		$row_class = ($count_topics % 2 && $alternate_row_class) ? "row3" : "row1";
		$count_topics += 1;

		$startedby = ($show_started_by == true) ? '<br /><span class="textmed">'.sprintf($blockslang['forums']['started'],'<a 
		href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$topic_info['user_id'].'">'.UsernameColor($topic_info['username']).'</a>').'</span>' : '';

		$img_hot = ( file_exists(forum_board_icon_path.'/images/board/folder_hot.png') ) ? '/images/board/folder_hot.png' : '/images/board/folder_hot.gif';
		$img     = ( file_exists(forum_board_icon_path.'/images/board/folder.png') ) ? '/images/board/folder.png' : '/images/board/folder.gif';

		$forum_img = ($topic_info['topic_replies'] >= $board_config['hot_threshold']) ? $img_hot : $img;


		$topic_info['forum_name'] = ($topic_info['forum_color']) ? '<span style="color: #'.$topic_info['forum_color'].'">'.$topic_info['forum_name'].'</span>' : $topic_info['forum_name'];

		$table .= '  <tr>'.PHP_EOL;
		$table .= '    <td class="'.$row_class.' acenter"><img style="width: 25px; height: 25px" src="'.forum_board_icon_path.$forum_img.'" border="0" /></td>'.PHP_EOL;
		$table .= '    <td class="'.$row_class.'"><a href="modules.php?name=Forums&amp;file=viewtopic&amp;p='.$topic_info['topic_first_post_id'].'">'.$topic_info['topic_title'].'</a>'.$startedby.'</td>'.PHP_EOL; // 
		$table .= '    <td class="'.$row_class.'"><a href="modules.php?name=Forums&amp;file=viewforum&amp;f='.$topic_info['forum_id'].'">'.$topic_info['forum_name'].'</a></td>'.PHP_EOL;
		$table .= '    <td class="'.$row_class.'" nowrap>'.$topic_info['topic_replies'].'&nbsp;'.$blockslang['global']['replies'].'<br />'.$topic_info['topic_views'].'&nbsp;'.$blockslang['global']['views'].'</td>'.PHP_EOL;

		$table .= '    <td class="'.$row_class.' lastpost" nowrap><a href="modules.php?name=Forums&amp;file=viewtopic&amp;p='.$topic_info['topic_last_post_id'].'#'.$topic_info['topic_last_post_id'].'"><i 
		class="fa fa-arrow-right tooltip-html-side-interact" aria-hidden="true" title="'.$blockslang['forums']['view_latest'].'"></i></a>'.FormatDate( 'M jS Y g:i a' , $topic_info['post_time'] , $userinfo['user_timezone'] ).'
		<br />'.sprintf($blockslang['forums']['by'],'<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$topic_info['poster_id'].'">'.UsernameColor($topic_info['poster_name']).'</a>').'</td>'.PHP_EOL;

		$table .= '  </tr>'.PHP_EOL;

	endforeach;

else:

	$table .= '  <tr>'.PHP_EOL;
	$table .= '    <td class="row1" style="text-align: center" colspan="5">'.$blockslang['forums']['none'].'</td>'.PHP_EOL;
	$table .= '  </tr>'.PHP_EOL;

endif;

$table .= '</table><div style="padding-top: 6px"></div>'.PHP_EOL;
$table .= '</div>'.PHP_EOL;
$content = $table;
?>