<?

function createQuestionRating($questionid, $pnt_userid, $up){
	if($up){
		$rating = 1;
	}else $rating = -1;

	global $conn;
	$stmt = $conn->prepare('INSERT INTO question_rating(question, createdby, rating) VALUES (?, ?, ?)');
	return $stmt->execute(array($questionid, $pnt_userid, $rating));
}

function updateQuestionRating($questionid, $pnt_userid, $up){
	if($up){
		$rating = 1;
	}else $rating = -1;
	
	global $conn;
	$stmt = $conn->prepare('UPDATE question_rating SET rating = ? WHERE question = ? AND createdby = ?');
	return $stmt->execute(array($rating, $questionid, $pnt_userid));
}

function getQuestionRating($questionid, $pnt_userid){
	global $conn;
	$stmt = $conn->prepare('SELECT * FROM question_rating WHERE question = ? AND createdby = ?');
	$stmt->execute(array($questionid, $pnt_userid));
	return $stmt->fetch();
}

function calculateQuestionRating($questionid){
	global $conn;
	$stmt = $conn->prepare('SELECT COALESCE(SUM(rating), 0) AS rating FROM question_rating WHERE question = ? ');
	$stmt->execute(array($questionid));
	return $stmt->fetch();		
}

?>