<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/question.php');
include_once($BASE_DIR .'database/registered_user.php');
include_once($BASE_DIR .'database/question_rating.php');
include_once($BASE_DIR .'database/answer_rating.php');
include_once($BASE_DIR .'database/answer.php');

$questionId = $_GET['id'];
$USERNAME = $_SESSION['username'];

if(!$questionId){
  header('Location: ' . $BASE_URL);
}else{
  $question = getQuestionById($questionId);
  $tags= getQuestionTagsById($questionId);
  $createdUser = getUserById($question['createdby']);
  $answers = getQuestionAnswers($questionId);
  $rating = calculateQuestionRating($_GET['id'])['rating'];

  $loggedUser = getUserByUsername($USERNAME);

  $loggedUserRating = getQuestionRating($questionId, $loggedUser['userid'])['rating'];

  if(!$loggedUserRating) $loggedUserRating = 0;

  if(isset($loggedUser)){
    foreach ($answers as $key => $answer) {
      $titanium_userRating = getAnswerRating($answer['answerid'], $loggedUser['userid'])['rating'];
      if(!$titanium_userRating) $titanium_userRating = 0;
      $answers[$key]['userRating'] = $titanium_userRating;
    }
  }

  $smarty->assign('loggedIn', isset($USERNAME));
  $smarty->assign('userRating', $loggedUserRating);
  $smarty->assign('rating', $rating);
  $smarty->assign('question', $question);
  $smarty->assign('tags', $tags);
  $smarty->assign('createdUser', $createdUser);
  $smarty->assign('answers', $answers);
  $smarty->display('question/view.tpl');
}


?>
