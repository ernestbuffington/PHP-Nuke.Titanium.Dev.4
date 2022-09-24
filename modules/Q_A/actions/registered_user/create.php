<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/registered_user.php');
$arguments = array('name', 'surname', 'email', 'username', 'password', 'company');

$valid = true;
foreach($arguments as $argument){
  if(!$_POST[$argument]){
    $_SESSION['error_messages'][] = 'All fields are mandatory (' . $argument . ')';
    $valid = false;
    break;
  }
}

$_SESSION['form_values'] = $_POST;

$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


/*if($password != $confirm_password){
$_SESSION['error_messages'][] = "Passwords don't match";
exit;
}*/

$name = strip_tags($_POST['name']);
$surname = strip_tags($_POST['surname']);
$email = strip_tags($_POST['email']);
$titanium_username = strip_tags($_POST['username']);
$company = strip_tags($_POST['company']);

try {
  createUser($name, $surname, $email, $titanium_username, $password, $company);
} catch (PDOException $e) {

  if (strpos($e->getMessage(), 'users_pkey') !== false) {
    $_SESSION['error_messages'][] = 'Duplicate username';
    $_SESSION['field_errors']['username'] = 'Username already exists';
  }
  else $_SESSION['error_messages'][] = 'Error creating user - '. $e->getMessage();

  $_SESSION['form_values'] = $_POST;

  foreach($_SESSION['error_messages'] as $error) {
    echo $error, '<br>';
  };
  exit;
}
$_SESSION['success_messages'][] = 'User registered successfully';
header("Location: $BASE_URL");

?>
