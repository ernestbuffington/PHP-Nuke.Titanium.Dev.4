<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/question_rating.php');
include_once($BASE_DIR .'database/registered_user.php');

$USERNAME = $_SESSION['username'];

$userid = getUserByUsername($USERNAME)['userid'];

if(getQuestionRating($_GET['question'], $userid) == false){
	createQuestionRating($_GET['question'], $userid, $_GET['upvote'] == "true");
}else{
	updateQuestionRating($_GET['question'], $userid, $_GET['upvote'] == "true");
}

echo json_encode(calculateQuestionRating($_GET['question']));
?>