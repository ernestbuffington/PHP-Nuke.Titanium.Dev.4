<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/question.php');

$page = $_GET['page'];

$questions = listQuestions($page);

$numberOfPages = ceil(getNumberOfQuestions()[0]['count'] / 15);
$USERNAME = $_SESSION['username'];

$smarty->assign('page', $page);
$smarty->assign('numberOfPages', $numberOfPages);
$smarty->assign('questions', $questions);
$smarty->display('question/list.tpl');
?>
