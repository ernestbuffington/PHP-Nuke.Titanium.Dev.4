<?php
/***************************************************************************
 *                            functions_userdel.php
 *   MOD: Admin delete user with all postings
 *                            -------------------
 *   begin                : Saturday, Feb 28, 2006
 *   copyright            : (C) 2006 Sergei Sekirin
 *   email                : sergei-vs@mail.ru
 *
 *   $Id: functions_userdel.php, v 1.0.5  2006/08/18 sergei-vs Exp $
 *   NOTE: v.1.0.5 tested on phpBB 2.0.19
 ***************************************************************************/

//
// Recync functions
//

// get the post count for the user
function get_post_count($recync_user_id)
{
	global $db;
	$sql = "SELECT COUNT(*) as numrows
		FROM " . POSTS_TABLE . "
		WHERE poster_id = $recync_user_id";

	$result = $db->sql_query($sql);
	if( !$result )
	{
		message_die(GENERAL_ERROR, "Could not obtain the new post count", "", __LINE__, __FILE__, $sql);
	}
	$post_count = $db->sql_fetchrow($result);
	return $post_count['numrows'];
}


// Set Post Count
function set_post_count($recync_user_id, $post_count)
{
	global $db;

	$sql = "UPDATE " . USERS_TABLE . "
		SET user_posts = $post_count
		WHERE user_id = $recync_user_id";
	$result = $db->sql_query($sql);
	if( !$result )
	{
		message_die(GENERAL_ERROR, "Could not update post count", "", __LINE__, __FILE__, $sql);
	}
}

//Set correct last post to topic
function topic_max_post_recync($recync_topic_id)
{
	global $db;
    $sql = "SELECT topic_moved_id
    	FROM " . TOPICS_TABLE . "
    	WHERE topic_id = $recync_topic_id";
    	$result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Не могу получить данные о теме!", "", __LINE__, __FILE__, $sql);
    	$topic = $db->sql_fetchrow($result);
    	$topic_moved = $topic['topic_moved_id'];
        if($topic_moved > '0')
        {
          	$topic_id = $topic['topic_moved_id'];
        }
        else
        {
         	$topic_id = $recync_topic_id;
        }

	$sql = "SELECT MAX(post_id) as last_post
		FROM " . POSTS_TABLE . "
		WHERE topic_id = " . $topic_id;
       $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not obtain topic MAX post_id!", "", __LINE__, __FILE__, $sql);
	   $new_id = $db->sql_fetchrow($result);

	$sql = 'UPDATE ' . TOPICS_TABLE . '
		SET topic_last_post_id = ' . $new_id['last_post']. '
		WHERE topic_id = ' . $recync_topic_id;
        $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not update topic_last_post_id!", "", __LINE__, __FILE__, $sql);
}

//Set correct first post to topic
function topic_min_post_recync($recync_topic_id)
{
	global $db;

    $sql = "SELECT topic_moved_id
    	FROM " . TOPICS_TABLE . "
    	WHERE topic_id = $recync_topic_id";
    	$result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Не могу получить данные о теме!", "", __LINE__, __FILE__, $sql);
    	$topic = $db->sql_fetchrow($result);
    	$topic_moved = $topic['topic_moved_id'];
        if($topic_moved > '0')
        {
          	$topic_id = $topic['topic_moved_id'];
        }
        else
        {
         	$topic_id = $recync_topic_id;
        }

	  $sql = "SELECT MIN(post_id) as first_post
		FROM " . POSTS_TABLE . "
		WHERE topic_id = $topic_id";
      $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not obtain topic MIN post_id", "", __LINE__, __FILE__, $sql);
	  $new_id = $db->sql_fetchrow($result);
      $new_fp_id = $new_id['first_post'];

	  $sql = "UPDATE " . TOPICS_TABLE . "
		SET topic_first_post_id = $new_fp_id
		WHERE topic_id = $recync_topic_id";
      $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not update topic_first_post_id", "", __LINE__, __FILE__, $sql);
}


function topic_replyes_count_decrease($post_id)
{
	global $db;
	  // Get forum id
      $sql = 'SELECT t.topic_id, t.topic_replies, t.topic_moved_id
      FROM '. POSTS_TABLE . ' AS p, '. TOPICS_TABLE . ' AS t
      WHERE p.post_id =' . $post_id . '
      AND (p.topic_id = t.topic_id OR p.topic_id = t.topic_moved_id)';
      $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not get topic_replyes data for this topic by its post", "", __LINE__, __FILE__, $sql);
      if (($row = $db->sql_numrows($result)) > '0' )
      {
	       	$replyes_num = $db->sql_fetchrowset($result);
         	foreach($replyes_num as $val)
         	{
	            $topic_id = $val['topic_id'];
	            $new_post_count = $val['topic_replies'];
                if ($new_post_count != '0')
                {
	                $new_post_count = ($new_post_count-1);
	                //Set new post count
	                $sql = 'UPDATE '. TOPICS_TABLE . '
	                Set topic_replies = ' . $new_post_count . '
	                WHERE topic_id =' . $topic_id;
	                $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not update replyes count for this topic by its post", "", __LINE__, __FILE__, $sql);
				}
            }
      }
}

//	    AND (p.topic_id = t.topic_id OR p.topic_id = t.topic_moved_id)
// Уменьшает счётчик сообщений форума при удалении поста в теме.
function forum_postscount_decrease_by_post_id($post_id)
{
	global $db;
		// Get forum id
	    $sql = 'SELECT p.topic_id, t.forum_id, t.topic_moved_id, f.forum_posts
	    FROM '. POSTS_TABLE . ' AS p, '. TOPICS_TABLE . ' AS t, '. FORUMS_TABLE . ' AS f
	    WHERE p.post_id =' . $post_id . '
	    AND p.topic_id = t.topic_id
	    AND f.forum_id = t.forum_id';
    	$result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not get forum data for this post!", "", __LINE__, __FILE__, $sql);
     	if (($row = $db->sql_numrows($result)) > '0' )
     	{
	      	$forums = $db->sql_fetchrowset($result);
        	foreach($forums as $val)
        	{
	        	$forum_id = $val['forum_id'];
	            $post_count = $val['forum_posts'];
				if ($new_post_count != '0')
                {
	                //Set new post count
	                $new_post_count = ( $post_count - 1 );
	                $sql = 'UPDATE '. FORUMS_TABLE . '
	                Set forum_posts = ' . $new_post_count . '
	                WHERE forum_id =' . $forum_id;
	                $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not update posts count for this forum!", "", __LINE__, __FILE__, $sql);
				}
	        }
     }
}


function set_forum_last_post($recynced_forum_id)
{
	global $db;
    // Get last_post
	$sql = "SELECT MAX(post_id) as last_post
	  FROM " . POSTS_TABLE . "
	  WHERE forum_id = $recynced_forum_id";
      $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not obtain forum MAX post_id", "", __LINE__, __FILE__, $sql);
	  $lastpost = $db->sql_fetchrow($result);
      //
      // Исли в форуме нет более постов, то назначаем '0', иначе будет ошибка
      //
      $new_forumlastpost_id = (($lastpost['last_post'] == '') ? '0': $lastpost['last_post']);
    //Set it
	$sql = "UPDATE " . FORUMS_TABLE . "
	  SET forum_last_post_id = $new_forumlastpost_id
	  WHERE forum_id = $recynced_forum_id";
      $result = $db->sql_query($sql) or message_die(GENERAL_ERROR, "Could not update forum_last_post_id", "", __LINE__, __FILE__, $sql);
}


function forum_topics_count_minus_one($forum_id)
{
	global $db;
      //Get present topics count
      $sql = 'SELECT forum_topics
      FROM '. FORUMS_TABLE . '
      WHERE forum_id =' . $forum_id;
   	  $result = $db->sql_query($sql);
	    if( !$result )
	    {
		    message_die(GENERAL_ERROR, "Could not get topics count for this forum", "", __LINE__, __FILE__, $sql);
	    }
	    $topics = $db->sql_fetchrow($result);
      $new_topic_count = $topics['forum_topics'];

      //Set new topic count
      $new_topic_count = ($new_topic_count-1);
			$sql = 'UPDATE '. FORUMS_TABLE . '
      Set forum_topics = ' . $new_topic_count . '
      WHERE forum_id =' . $forum_id;
	    $result = $db->sql_query($sql);
	    if( !$result )
	    {
		    message_die(GENERAL_ERROR, "Could not update this forum topics count", "", __LINE__, __FILE__, $sql);
	    }
}

//
// END - Recync functions
//

?>