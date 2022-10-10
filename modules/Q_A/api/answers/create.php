<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/answer.php');
include_once($BASE_DIR .'database/registered_user.php');

$USERNAME = $_SESSION['username'];

$userid = getUserByUsername($USERNAME)['userid'];
$questionid = $_POST['questionid'];
$content = $_POST['content'];


$answerid = createAnswer($questionid, $userid, $content);

echo json_encode(getAnswer($answerid));
?>