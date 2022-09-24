<?php

global $blockslang, $admin, $titanium_db, $userinfo;

/**
 *	Choose whether or not when clicking the topic title, it shoudl take you to first post or last.
 *
 *	Possible values - [ 'first', 'last' ]
 */

$linkStart = 'first';

if ( defined('BOOTSTRAP') ):
	$colClass1 = 'col-sm-12 col-lg-1';
	// $colClass2 = 'col-sm-12 col-lg-2';
	$colClass3 = 'col-sm-12 col-lg-3';

	// $colClass5 = 'col-sm-12 col-lg-5';
	$colClass6 = 'col-sm-12 col-lg-6';


	$colClass8 = 'col-sm-12 col-lg-8';
	$colClass12 = 'col-12';
	$colFlex   = 'table-flex row mx-0';
	$bsCol12   = '';
	$btnClass  = 'btn btn-primary';

	$hdr__backwardsCompat = ' block-header-topic-col';
	$bg__backwardsCompat = ' block-latest-posts-bg';
	$br__backwardsCompat = ' block-latest-post-replies-borders';
else:
	$colClass1 = 'col-1';
	// $colClass2 = 'col-2';
	$colClass3 = 'col-3';

	// $colClass5 = 'col-5';
	$colClass6 = 'col-6';


	$colClass8 = 'col-8';
	$colClass12 = 'col-12';
	$colFlex   = 'table-flex';
	$bsCol12   = ' bs-col-12';
	$btnClass  = 'btn-submit';

	$hdr__backwardsCompat = ' catHead';
	$bg__backwardsCompat = ' row1';
	$br__backwardsCompat = '';
endif;

?>

<style>

.block-latest-post-replies-borders {
	border-left: 1px solid #000;
	border-right: 1px solid #000;
}

.block-latest-posts-bg {
	/*border: 1px solid #000;*/
	background-color: #212528;
}

.block-latest-posts-wrap {
	display: flex;
	/*border: 1px solid #000;*/
}

<?php if ( defined('BOOTSTRAP') ): ?>

.block-latest-posts-wrap {
	border: 1px solid #000;
}

<?php else: ?>

.block-latest-posts-wrap {
	margin:1px;
}

<?php endif; ?>

/**
 *	Remove the border from all child elements, then re-add the border for the last child,
 *	Only for bootstrap themes.
 */
<?php if ( defined('BOOTSTRAP') ): ?>

.block-latest-posts-wrap:nth-child(n+1) {
	border-bottom: 0;
}

.block-latest-posts-wrap:last-child {
	border-bottom: 1px solid #000;
}

<?php endif; ?>

.block-latest-post {
	padding: 9px;
	display: flex;
    align-items: center;
}

.block-latest-post-inner {
	margin-left: 10px; 
	margin-right:10px;
}

.block-latest-post-replies {
	display: flex;
	flex-direction: column;
	align-items: center;
    justify-content: center;
	text-align: center;	
}

/**
 *	Only show the margin when the theme is not bootstrap related.
 */
<?php if ( !defined('BOOTSTRAP') ): ?>

.block-latest-post-replies {
	margin-left: 1px;
	margin-right: 1px;
}

<?php endif; ?>

.block-latest-post-last {
	padding: 9px;
}

.last-post-link {
	display: none;
	font-size: 12px;
}


/**
 *	Hide the section that are not to be shown when responsive.
 */
@media (max-width: 768px)
{
	.block-header-topic-replies,
	.block-header-topic-lastpost,
	.block-latest-post-replies,
	.block-latest-post-last {
		display: none;
	}

	.last-post-link {
		display: inline-block;		
		float: right;
	    position: absolute;
	    right: 15px;
	    top: 35%;
	    transform: translateY(35%);
	}
}

/*@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape)
and (-webkit-min-device-pixel-ratio: 1)
{
	.block-header-topic-replies,
	.block-header-topic-lastpost,
	.block-latest-post-replies,
	.block-latest-post-last {
		display: none;
	}
}*/

@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) 
and (-webkit-min-device-pixel-ratio: 1)
{
	.block-header-topic-replies,
	.block-header-topic-lastpost,
	.block-latest-post-replies,
	.block-latest-post-last {
		display: none;
	}

	.last-post-link {
		font-size: 24px;
		display: inline-block;
		float: right;
	    position: absolute;
	    right: 15px;
	    top: 15%;
	    transform: translateY(40%);
	}
}


/**
 *	block header
 */

div.catHead {
	padding: 9px !important;
}

div.row1 {
	padding: 9px !important;
}

.block-header-wrap {
	display: flex;
	/*margin: 1px;*/
}

.block-header-topic-replies {
	padding: 9px; 
	text-align: center;
}

<?php if ( defined('BOOTSTRAP') ): ?>
.block-header-wrap {
	border: 1px solid #000;
	border-bottom: 0;
}

.block-header-topic-replies {
	border-left: 1px solid #000; 
	border-right: 1px solid #000; 
	padding: 9px; 
	text-align: center;
}

.block-header-topic-col {
	background: url(themes/LM-BlackMagic/images/dotted.png) repeat #222;
}

<?php else: ?>

.block-header-wrap {
	margin: 1px;
}

<?php endif; ?>

.block-header-topic-col {
	background-color: #1a1d1f; 
	padding: 9px;
}

.block-header-topic-col-inner {
	margin-left: 10px;
}


<?php if ( !defined('BOOTSTRAP') ): ?>

.block-header-topic-replies {
	margin-left: 1px;
	margin-right: 1px;
}


<?php endif; ?>

.block-header-topic-lastpost {
	padding: 9px;
}
</style>

<?php

	$last_new_topics    = 10;
	$show_started_by	= true;
	$alternate_row_class = true;

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if (!$phpbb2_topic_data = titanium_cache_load('TopicData', 'home')):
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
	$phpbb2_topic_data = array();
	$result = dbquery("SELECT t.topic_id, t.topic_type, t.topic_attachment, f.forum_name, f.forum_color, f.forum_id, t.topic_last_post_id, t.topic_first_post_id, t.topic_title, t.topic_poster, t.topic_views, t.topic_replies, t.topic_status, p.post_time, p.poster_id, pu.username as postername, u.username, u.user_id FROM `".TOPICS_TABLE."` t, `".FORUMS_TABLE."` f, `".POSTS_TABLE."` p, `".USERS_TABLE."` u, `".USERS_TABLE."` pu WHERE t.forum_id=f.forum_id AND p.post_id=t.topic_last_post_id AND u.user_id=t.topic_poster AND pu.user_id=p.poster_id AND t.topic_moved_id = '0' ORDER BY topic_last_post_id DESC LIMIT $last_new_topics");

	while ( list( $topic_id, $topic_type, $topic_attachment, $forum_name, $forum_color, $phpbb2_forum_id, $topic_last_post_id, $topic_first_post_id, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_status, $post_time, $poster_id, $poster_name, $titanium_username, $titanium_user_id ) = dbrow( $result)) 
	{
	        $phpbb2_topic_data[$topic_id]['topic_id'] 			 = $topic_id;
	        $phpbb2_topic_data[$topic_id]['topic_type'] 		 = $topic_type;
			$phpbb2_topic_data[$topic_id]['topic_attachment'] 	 = $topic_attachment;
	        $phpbb2_topic_data[$topic_id]['forum_name'] 		 = $forum_name;
			$phpbb2_topic_data[$topic_id]['forum_color'] 		 = $forum_color;
	        $phpbb2_topic_data[$topic_id]['forum_id'] 			 = $phpbb2_forum_id;
	        $phpbb2_topic_data[$topic_id]['topic_last_post_id']  = $topic_last_post_id;
	        $phpbb2_topic_data[$topic_id]['topic_first_post_id'] = $topic_first_post_id;
	        $phpbb2_topic_data[$topic_id]['topic_title'] 		 = $topic_title;
	        $phpbb2_topic_data[$topic_id]['topic_poster'] 		 = $topic_poster;
	        $phpbb2_topic_data[$topic_id]['topic_views'] 		 = $topic_views;
	        $phpbb2_topic_data[$topic_id]['topic_replies'] 		 = $topic_replies;
			$phpbb2_topic_data[$topic_id]['topic_status'] 		 = $topic_status;
	        $phpbb2_topic_data[$topic_id]['post_time'] 			 = $post_time;
	        $phpbb2_topic_data[$topic_id]['poster_id'] 			 = $poster_id;
	        $phpbb2_topic_data[$topic_id]['poster_name'] 		 = $poster_name;
	        $phpbb2_topic_data[$topic_id]['username'] 			 = $titanium_username;
	        $phpbb2_topic_data[$topic_id]['user_id'] 			 = $titanium_user_id;
	}
	dbfree($result);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
	titanium_cache_set('TopicData', 'home', $phpbb2_topic_data);	
endif;
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

$content  =  '
<div class="block-header-wrap">

	<div class="'.$colClass8.$hdr__backwardsCompat.'">
		<div class="block-header-topic-col-inner">
			'.$blockslang['forums']['topic'].'
		</div>
	</div>

	<div class="'.$colClass1.$hdr__backwardsCompat.' block-header-topic-replies">
		Replies
	</div>

	<div class="'.$colClass3.$hdr__backwardsCompat.' block-header-topic-lastpost">
		'.$blockslang['forums']['last_post'].'
	</div>

</div>';

if ($phpbb2_topic_data):

	$count_topics = 0;
	$phpbb2_topic_data = (is_array($phpbb2_topic_data)) ? $phpbb2_topic_data : array();
	foreach($phpbb2_topic_data as $topic_info):

		$row_class = ($count_topics % 2 && $alternate_row_class) ? "row3" : "row1";
		$count_topics += 1;

		$phpbb2_startedby = ($show_started_by == true) ? sprintf($blockslang['forums']['started'],'<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$topic_info['user_id'].'">'.UsernameColor($topic_info['username']).'</a>') : '';

		$topic_info['forum_name'] = ($topic_info['forum_color']) ? '<span style="color: #'.$topic_info['forum_color'].'">'.$topic_info['forum_name'].'</span>' : $topic_info['forum_name'];

		if ( $linkStart == 'first' ):

			$post_id = $topic_info['topic_first_post_id'];

		else:

			$post_id = $topic_info['topic_last_post_id'].'#'.$topic_info['topic_last_post_id'];

		endif;

		$content .=  '
		<div class="block-latest-posts-wrap">

			<div class="'.$colClass8.' block-latest-post '.$bg__backwardsCompat.'">
				<div class="block-latest-post-inner text-truncate">
					<a href="modules.php?name=Forums&file=viewtopic&p='.$post_id.'">'.$topic_info['topic_title'].'</a><br />
					<small>'.$phpbb2_startedby.' in <a href="modules.php?name=Forums&amp;file=viewforum&amp;f='.$topic_info['forum_id'].'">'.$topic_info['forum_name'].'</a> <a href="modules.php?name=Forums&amp;file=viewtopic&amp;p='.$topic_info['topic_last_post_id'].'#'.$topic_info['topic_last_post_id'].'"><i class="fas fa-arrow-right last-post-link" data-toggle="btn-tooltip" data-placement="top" aria-hidden="true" title="'.$blockslang['forums']['view_latest'].'"></i></a></small>
				</div>
			</div>

			<div class="'.$colClass1.' text-center block-latest-post-replies '.$bg__backwardsCompat.''.$br__backwardsCompat.'">
				'.$topic_info['topic_replies'].'
			</div>

			<div class="'.$colClass3.' block-latest-post-last '.$bg__backwardsCompat.'">
				<div class="block-latest-post-time">'.EvoDate( 'M jS Y g:i a' , $topic_info['post_time'] , $userinfo['user_timezone'] ).'</div>
				<div class="block-latest-post-author">'.sprintf($blockslang['forums']['by'],'<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$topic_info['poster_id'].'">'.UsernameColor($topic_info['poster_name']).'</a>').' <a href="modules.php?name=Forums&amp;file=viewtopic&amp;p='.$topic_info['topic_last_post_id'].'#'.$topic_info['topic_last_post_id'].'"><i class="fas fa-arrow-right" data-toggle="btn-tooltip" data-placement="top" aria-hidden="true" title="'.$blockslang['forums']['view_latest'].'"></i></a></div>
			</div>

		</div>';

	endforeach;

else:

	$content .=  '<div class="block-latest-posts-wrap p-2">';
	$content .=  '	<div class="'.$colClass12.' '.$bg__backwardsCompat.'">'.$blockslang['forums']['none'].'</div>';
	$content .=  '</div>';

endif;


?>