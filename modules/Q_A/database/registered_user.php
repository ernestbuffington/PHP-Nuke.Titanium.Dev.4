<?php
function isLoginCorrect($email, $password) {
	global $conn;
	$stmt = $conn->prepare("SELECT *
		FROM registered_user
		WHERE email = ? AND password = ?");
		$stmt->execute(array($email, sha1($password)));
		return $stmt->fetch() == true;
	}

	function createUser($name, $surname, $email, $titanium_username, $password, $company){
		global $conn;
		$stmt = $conn->prepare("INSERT INTO registered_user(name, surname, email, username, password, company) VALUES (?,?,?,?,?,?)");
		$stmt->execute(array($name, $surname, $email, $titanium_username, sha1($password), $company));
		return $stmt->fetch() == true;
	}

	function getUsernameByEmail($email){
		global $conn;
		$stmt = $conn->prepare("SELECT username	FROM registered_user WHERE email = ?");
		$stmt->execute(array($email));
		return $stmt->fetch();
	}

	function getUserByUsername($titanium_username){
		global $conn;
		$stmt = $conn->prepare("SELECT userid, name, surname, company, email, username FROM registered_user WHERE username = ?");
		$stmt->execute(array($titanium_username));
		return $stmt->fetch();
	}

	function getUserById($id){
		global $conn;
		$stmt = $conn->prepare("SELECT userid, name, surname, company, email, username FROM registered_user WHERE userid = ?");
		$stmt->execute(array($id));
		return $stmt->fetch();
	}
?>
