<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/question.php');
include_once($BASE_DIR .'database/registered_user.php');

$questionId = $_GET['id'];

if(!$questionId){
  header('Location: ' . $BASE_URL);
}else{
  $question = getQuestionById($questionId);
  $tags= getQuestionTagsById($questionId);
  $createdUser = getUserById($question['createdby']);

  $smarty->assign('question', $question);
  $smarty->assign('tags', $tags);
  $smarty->assign('createdUser', $createdUser);
  $smarty->display('question/edit_question.tpl');
}


?>
