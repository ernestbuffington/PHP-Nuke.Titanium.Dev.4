<?php
#########################################################################
# Titanium cPanel Login v2.0                                            #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
#########################################################################
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

global $module_name;

if(!isset($module_name) || empty($module_name))
{
  $module_name = basename(dirname(__FILE__));
}

error_reporting(E_ALL ^ E_NOTICE);

//Here we check if any field was missed / left empty and act accordingly
if ($_POST['domain'] && $_POST['username'] && $_POST['pass'] && !($_GET['failed'] == "1"))
{
   switch ($_POST['login_option'])
   {
     case "2082": $port = "2082";
     $protocol = "http://";
     break;
     case "2083": $port = "2083";
     $protocol = "https://";
     break;
     case "2086": $port = "2086";
     $protocol = "http://";
     break;
     case "2087": $port = "2087";
     $protocol = "https://";
     break;
     case "2095": $port = "2095";
     $protocol = "http://";
     break;
     case "2096": $port = "2096";
     $protocol = "https://";
     break;
}

if ( isset($HTTP_GET_VARS['domain']) || isset($HTTP_POST_VARS['domain']) )
{

        $redirectlocation = $protocol.$_POST['domain'].":".$port."/login/?user=".$_POST['username']."&pass=".$_POST['pass']."&failurl=".$_POST['failurl'];
}
else
{
        $redirectlocation = $protocol.$domain.":".$port."/login/?user=".$_POST['username']."&pass=".$_POST['pass']."&failurl=".$_POST['failurl'];
}

header ("Location: ".$redirectlocation);
}
else
{
$error = 1;
header ("Location: ".$_POST['failurl']);
}
?>
