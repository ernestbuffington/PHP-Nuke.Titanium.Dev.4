<?

function createAnswerRating($answerid, $userid, $up){
	if($up){
		$rating = 1;
	}else $rating = -1;

	global $conn;
	$stmt = $conn->prepare('INSERT INTO answer_rating(answer, createdby, rating) VALUES (?, ?, ?)');
	return $stmt->execute(array($answerid, $userid, $rating));
}

function updateAnswerRating($answerid, $userid, $up){
	if($up){
		$rating = 1;
	}else $rating = -1;
	
	global $conn;
	$stmt = $conn->prepare('UPDATE answer_rating SET rating = ? WHERE answer = ? AND createdby = ?');
	return $stmt->execute(array($rating, $answerid, $userid));
}

function getAnswerRating($answerid, $userid){
	global $conn;
	$stmt = $conn->prepare('SELECT * FROM answer_rating WHERE answer = ? AND createdby = ?');
	$stmt->execute(array($answerid, $userid));
	return $stmt->fetch();
}

function calculateAnswerRating($answerid){
	global $conn;
	$stmt = $conn->prepare('SELECT COALESCE(SUM(rating), 0) AS rating FROM answer_rating WHERE answer = ? ');
	$stmt->execute(array($answerid));
	return $stmt->fetch();		
}

?>