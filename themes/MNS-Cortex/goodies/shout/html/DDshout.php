<?php

/************************************************************************/
/* PHP-NUKE: DD Shout Admin for PHP-Nuke                          		*/
/* ============================================                			*/
/* Copyright (c) 2004 by ZoNE&Vision                                     */
/* http://www.DestineDesigns.com                                        */
/* Made for PHP-NUKE Advanced Content Management System 				*/
/************************************************************************/

include("config.php");
include("mainfile.php");

$link = mysql_connect($dbhost, $dbuname, $dbpass);
@mysql_select_db($dbname);
cookiedecode($user);


switch($op){

case write:



$msg = $_POST['shout'];
$time = time();

$user = $cookie[1];
if ($user == "") {
$user = "Anonymous";
}
$result =  mysql_query("INSERT INTO ".$prefix."_shout (UID, PDT, MSG)
VALUES ('$user', '$time', '$msg')") or die(mysql_error());


case read:


$query = mysql_query("select * from ".$prefix."_shout ORDER BY PID DESC");
$nrows = mysql_num_rows($query);
$msg = "output=";
for($i = 0; $i < $nrows; $i++) {
	$row = mysql_fetch_array($query);
	$time = strftime("%a %m/%d/%y %H:%M", $row['PDT']);
	$msg .= "<p class=\"output1\">" . $row['UID'] . " " . $time . "</p>";
	$msg .= "<p class=\"output2\">".$row['MSG'] . "</p>";
	$msg .= "<p class=\"output1\">-----------------------------------------</p><br>";

}


$msg .= "";
echo $msg;

$user = $cookie[1];
if ($user == "") {
$user = "Anonymous";
}
$msg2 = "&username=";
$msg2 .= $user;
echo $msg2;


break;


default:

	die ("You can't access this file directly...");
}
mysql_close($link);
?>

