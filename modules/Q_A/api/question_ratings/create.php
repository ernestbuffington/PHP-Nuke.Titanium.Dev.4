<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/question_rating.php');
include_once($BASE_DIR .'database/registered_user.php');

$USERNAME = $_SESSION['username'];

$pnt_userid = getUserByUsername($USERNAME)['userid'];

if(getQuestionRating($_GET['question'], $pnt_userid) == false){
	createQuestionRating($_GET['question'], $pnt_userid, $_GET['upvote'] == "true");
}else{
	updateQuestionRating($_GET['question'], $pnt_userid, $_GET['upvote'] == "true");
}

echo json_encode(calculateQuestionRating($_GET['question']));
?>