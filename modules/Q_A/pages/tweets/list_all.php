<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/tweets.php');

  $tweets = getAllTweets();  
  
  foreach ($tweets as $key => $tweet) {
    unset($photo);
    if (file_exists($BASE_DIR.'images/users/'.$tweet['username'].'.png'))
      $photo = 'images/users/'.$tweet['username'].'.png';
    if (file_exists($BASE_DIR.'images/users/'.$tweet['username'].'.jpg'))
      $photo = 'images/users/'.$tweet['username'].'.jpg';
    if (!$photo) $photo = 'images/assets/default.png';
    $tweets[$key]['photo'] = $photo;
  }
    
  $smarty->assign('last_tweet_id', $tweets[0]['id']);  
  
  $smarty->assign('tweets', $tweets);
  $smarty->display('tweets/list.tpl');
?>
