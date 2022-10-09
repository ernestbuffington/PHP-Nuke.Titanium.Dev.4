<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/tweets.php');

  if (!$_GET['username']) {
    $_SESSION['error_messages'][] = 'Undefined username';
    header("Location: $BASE_URL");
    exit;
  }
  
  $username = $_GET['username'];
  
  $tweets = getUserTweets($username);  
  
  foreach ($tweets as $key => $tweet) {
    unset($photo);
    if (file_exists($BASE_DIR.'images/users/'.$tweet['username'].'.png'))
      $photo = 'images/users/'.$tweet['username'].'.png';
    if (file_exists($BASE_DIR.'images/users/'.$tweet['username'].'.jpg'))
      $photo = 'images/users/'.$tweet['username'].'.jpg';
    if (!$photo) $photo = 'images/assets/default.png';
    $tweets[$key]['photo'] = $photo;
  }  
  
  $smarty->assign('tweets', $tweets);
  $smarty->display('tweets/list.tpl');
?>
