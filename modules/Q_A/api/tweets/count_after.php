<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/tweets.php');

  $count = getTweetCountAfter($_GET['id']);  
  
  echo json_encode($count);
?>
