<?php

include_once('../../config/init.php');
include_once($BASE_DIR .'database/question.php');
include_once($BASE_DIR .'database/registered_user.php');
$arguments = array('content', 'title');

$USERNAME = $_SESSION['username'];


if(!$USERNAME) header('Location: ' . $BASE_URL . '?error=nosession');

$valid = true;
foreach($arguments as $argument){
  if(!$_POST[$argument]){
    $_SESSION['error_messages'][] = 'Missing mandatory field (' . $argument . ')';
    $valid = false;
    break;
  }
}

$title = $_POST['title'];
$content = $_POST['content'];
$tags = explode(',', $_POST['tags']);
$titanium_user = getUserByUsername($USERNAME);


$questionId = createQuestion($title, $content, $titanium_user['userid'], $tags);


if($questionId != 0){
  header('Location: ' . $BASE_URL . 'pages/question/view.php?id=' . $questionId);
} else header('Location: ' . $BASE_URL . '?error=questioncreateerror');
?>
