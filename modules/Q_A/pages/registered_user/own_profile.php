<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/registered_user.php');
  if($_SESSION['username']){
    $pnt_user = getUserByUsername($_SESSION['username']);
    $smarty->assign('user', $pnt_user);
    $smarty->display('registered_user/own_profile.tpl');
  }else header('Location: ' . $BASE_URL)
?>
