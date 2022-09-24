<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/answer_rating.php');
include_once($BASE_DIR .'database/registered_user.php');

$USERNAME = $_SESSION['username'];

$titanium_userid = getUserByUsername($USERNAME)['userid'];

if(getAnswerRating($_GET['answer'], $titanium_userid) == false){
	createAnswerRating($_GET['answer'], $titanium_userid, $_GET['upvote'] == "true");
}else{
	updateAnswerRating($_GET['answer'], $titanium_userid, $_GET['upvote'] == "true");
}

echo json_encode(calculateAnswerRating($_GET['answer']));
?>