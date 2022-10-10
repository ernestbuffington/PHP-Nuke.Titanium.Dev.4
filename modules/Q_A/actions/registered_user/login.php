<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/registered_user.php');

  $arguments = array('email', 'password');
  $valid = true;
  foreach($arguments as $argument){
    if(!$_POST[$argument]){
      $_SESSION['error_messages'][] = 'All fields are mandatory (' . $argument . ')';
      $valid = false;
      break;
    }
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  if (isLoginCorrect($email, $password)) {
    $_SESSION['username'] = getUsernameByEmail($email)['username'];
    $_SESSION['success_messages'][] = 'Login successful';
  } else {
    $_SESSION['error_messages'][] = 'Login failed';
    header('Location: ' .'error');
    exit;
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
