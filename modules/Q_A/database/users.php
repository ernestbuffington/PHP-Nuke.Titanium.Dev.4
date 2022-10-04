<?php
  
  function createUser($realname, $pnt_username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?)");
    $stmt->execute(array($pnt_username, $realname, sha1($password)));
  }

  function isLoginCorrect($pnt_username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE username = ? AND password = ?");
    $stmt->execute(array($pnt_username, sha1($password)));
    return $stmt->fetch() == true;
  }
?>
