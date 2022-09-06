<?php
/**

*/
if (!defined('MODULE_FILE')) { 
    Header("Location: /index.php");
	exit();
}         
$pagetitle = 'facebook SandBox v6.0';
$title = 'facebook SandBox odule v6.0';
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
$index = 0;


include("header.php");
 //header('Location: pages/home/home.php');
?>
