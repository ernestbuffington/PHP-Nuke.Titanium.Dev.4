<?php
  
  function createUser($realname, $titanium_username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?)");
    $stmt->execute(array($titanium_username, $realname, sha1($password)));
  }

  function isLoginCorrect($titanium_username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE username = ? AND password = ?");
    $stmt->execute(array($titanium_username, sha1($password)));
    return $stmt->fetch() == true;
  }
?>
