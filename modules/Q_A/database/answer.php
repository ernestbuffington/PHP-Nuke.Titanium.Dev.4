<?php

function createAnswer($questionid, $titanium_userid, $content){
	global $conn;
	$stmt = $conn->prepare('INSERT INTO answer(question, createdby, content) VALUES (?, ? ,?)');
	$stmt->execute(array($questionid, $titanium_userid, $content));
	return $conn->lastInsertId('answer_answerid_seq');
};

function getAnswer($answerid){
	global $conn;
	$stmt = $conn->prepare('SELECT answer.answerid, answer.content, answer.createdby AS authorid, registered_user.username AS authorname
		FROM answer, registered_user WHERE answerid = ? AND answer.createdby = registered_user.userid');
	$stmt->execute(array($answerid));
	return $stmt->fetch();
}

function getQuestionAnswers($questionid){
	global $conn;
	$stmt = $conn->prepare('SELECT answer_with_ratings.*, registered_user.username AS authorname FROM 
      (SELECT answer.answerid, answer.question, answer.content, answer.createdby AS authorid, COALESCE(SUM(rating), 0) AS rating 
        FROM answer, answer_rating WHERE
        answer.answerid = answer_rating.answer AND answer.question = ? GROUP BY(answer.answerid) ORDER BY (answerid))
      AS answer_with_ratings, registered_user
      WHERE answer_with_ratings.authorid = registered_user.userid ORDER BY (answer_with_ratings.answerid)');
	$stmt->execute(array($questionid));
	return $stmt->fetchAll();

}
?>