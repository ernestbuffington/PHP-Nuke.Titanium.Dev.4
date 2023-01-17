<?php 
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 - 2014 coRpSE	                                    */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
exit('Access Denied');
}
global $prefix, $db, $admin_file, $currentlang;
if (file_exists(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php')) {
include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php');
}else{
include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-english.php');
}
$date = date("F j, Y, g:i A");
$ip = $_SERVER['REMOTE_ADDR'];
$XMAIL = urlencode($ya_user_email);

$result = $db->sql_query("SELECT usehp, check1, check2, check3, check4, check5, check6, c7opt1, c7opt2, c7amount, c8opt1, c8opt2, usebsapi, c8apikey, fs9opt1, fs9opt2, fs9apikey, check3time, check4question, check4answer, usefeedback, email FROM ".$prefix."_honeypot_config");
list($usehp, $check1, $check2, $check3, $check4, $check5, $check6, $c7opt1, $c7opt2, $c7amount, $c8opt1, $c8opt2, $usebsapi, $c8apikey, $fs9opt1, $fs9opt2, $fs9apikey, $check3time, $check4question, $check4answer, $usefeedback, $email) = $db->sql_fetchrow($result);

echo '<style>
    .center{
		text-align:center;
		}
	</style>' , PHP_EOL;

/************************************************************************/
// [ Begin ] HoneyPot Blacklist Check
/************************************************************************/
$result1 = $db->sql_query("SELECT COUNT(ip) FROM `". $prefix ."_honeypot` WHERE ip = '$ip'");
list($resip) = $db->sql_fetchrow($result1);
$db->sql_freeresult($result1);

$result2 = $db->sql_query("SELECT COUNT(email) FROM `". $prefix ."_honeypot` WHERE email ='$ya_user_email'");
list($resemail) = $db->sql_fetchrow($result2);
$db->sql_freeresult($result2);

if ($c7opt2 == 1){
 if (($resip >= $c7amount) && ($resemail < $c7amount || $c7opt1 == 0)){
OpenTable();
echo "<div style=\"text-align:center;\">"._HONEYPOT_BL_MESSAGE_START_1."<br>" , PHP_EOL
 , _HONEYPOT_BL_MESSAGE_IPOF."$ip"._HONEYPOT_BL_MESSAGE_ISFOUND."$resip"._HONEYPOT_BL_MESSAGE_END_1 , PHP_EOL
 , _HONEYPOT_BL_INFO_NEEDED."</div>" , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>" , PHP_EOL;
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
 }
}

if ($c7opt1 == 1){
 if (($resemail >= $c7amount) && ($resip < $c7amount || $c7opt2 == 0)){
OpenTable();
echo "<div style=\"text-align:center;\">"._HONEYPOT_BL_MESSAGE_START_2."<br>" , PHP_EOL
 , _HONEYPOT_BL_MESSAGE_EMAILOF."$ya_user_email"._HONEYPOT_BL_MESSAGE_ISFOUND."$resemail"._HONEYPOT_BL_MESSAGE_END_2 , PHP_EOL
 , _HONEYPOT_BL_INFO_NEEDED."</div>" , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>" , PHP_EOL;
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
 }
}

if ($c7opt1 == 1 && $c7opt2 == 1){
 if ($resip >= $c7amount && $resemail >= $c7amount){
OpenTable();
echo "<div style=\"text-align:center;\">"._HONEYPOT_BL_MESSAGE_START."<br><br>" , PHP_EOL
 , _HONEYPOT_BL_MESSAGE_IPOF."$ip"._HONEYPOT_BL_MESSAGE_ISFOUND."$resip"._HONEYPOT_BL_MESSAGE_TIMESFAILED."<br>" , PHP_EOL
 , _HONEYPOT_BL_MESSAGE_EMAILOF."$ya_user_email"._HONEYPOT_BL_MESSAGE_ISFOUND."$resemail"._HONEYPOT_BL_MESSAGE_TIMESFAILED."<br>" , PHP_EOL
 , "<br>"._HONEYPOT_BL_MESSAGE_END , PHP_EOL
 , _HONEYPOT_BL_INFO_NEEDED."</div>" , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>";
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
 }
}
/************************************************************************/
// [ End ] HoneyPot Blacklist Check
/************************************************************************/

if ($check3 == 1){
$loadtime = $_POST['loadtime'];
$totaltime = time() - $loadtime;
$ourtime = $check3time + 1;
if($totaltime < $ourtime){
$potnum = "0";
$reason = _HONEYPOT_SUBMITTEDIN." $totaltime "._HONEYPOT_SEC;
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES (NULL, '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");
OpenTable();
echo "<p class='center'>"._HONEYPOT_YOUAREABOT."$check3time"._HONEYPOT_YOUAREABOT2."</p>" , PHP_EOL
 , '<br /><br /><br />' , PHP_EOL
 , '<div style="text-align:center;">' , _GOBACK , '</div>' , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>" , PHP_EOL;
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit;
}
}


if ($check2 == 1){
$botblock2 = $_POST["company"];
if (!empty($botblock2)) {
$reason = $botblock2;
$potnum = "1";
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES (NULL, '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");

OpenTable();
if (file_exists('./includes/honeypot/flash.js')) {
echo "<script type=\"text/javascript\" src=\"./includes/honeypot/flash.js\"></script>";
}
echo"<style type=\"text/css\">
.blink {
display: inline;
}
</style>";
echo "<body onload=\"blink();\">";
echo "<style type=\"text/css\">
.hpfont {
color:#FF0000;
font-weight:700;
font-size:15px;
}
</style>";
echo "<div align=\"center\">"._HONEYPOT_YOUHAVEFAILED."<br>"._HONEYPOT_YOUSHOULDHAVEDEL."<br><br><div class=\"hpfont\"><span class=\"blink\">$reason</p></div><br>"._HONEYPOT_ANDLEFTITBLANK."<br>"._HONEYPOT_GOBACKANDTRYAGAIN."</div>" , PHP_EOL
 , '<br /><br /><br />' , PHP_EOL
 , '<div style="text-align:center;">' , _GOBACK , '</div>' , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>" , PHP_EOL;
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
}
}

$botblock = '';

if(!isset($_POST["addition"]))
$_POST["addition"] = '';

if ($check1 == 1){
$botblock = strtolower($_POST["addition"]);

if (!empty($botblock)) {

$reason = _HONEYPOT_ANSWEREDWITH." $botblock";
$potnum = "2";

$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES (NULL, '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");

OpenTable();
echo "<p class='center'>"._HONEYPOT_YOUHAVEFAILED." <br /> "._HONEYPOT_HOEYPOT."</p>" , PHP_EOL
 , '<br /><br /><br />' , PHP_EOL
 , '<div style="text-align:center;">' , _GOBACK , '</div>' , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>" , PHP_EOL;
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');	
exit ();
}
}


if ($check4 == 1){
$givenanswer = strtolower($_POST["check4question"]);
$answercheck = strtolower($check4answer);
if ($givenanswer != $answercheck) {

$reason = _HONEYPOT_ANSWEREDWITH." \" $givenanswer \"";
$potnum = "3";

$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES (NULL, '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");

OpenTable();
echo "<p class='center'>"._HONEYPOT_QUESTIONCHECK_FAILED."</p>" , PHP_EOL
 , '<br /><br /><br />' , PHP_EOL
 , '<div style="text-align:center;">' , _GOBACK , '</div>' , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>";
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
}
}


//Check possiable new users agienst stopforumspam API
if ($check5 == 1 || $check6 == 1){

$sfsapiquery = "http://www.stopforumspam.com/api";
if($check6 == 1 && $check5 == 0){$sfsapiquery = $sfsapiquery."?email=".$XMAIL;}
elseif($check6 == 0 && $check5 == 1){$sfsapiquery = $sfsapiquery."?ip=".$ip;}
elseif($check6 == 1 && $check5 == 1){$sfsapiquery = $sfsapiquery."?ip=".$ip."&email=".$XMAIL;}

if(function_exists('file_get_contents')){
	$sfsresponse = file_get_contents($sfsapiquery);
}else{
	$ch = curl_init($sfsapiquery);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$sfsresponse = curl_exec($ch);
	curl_close($ch);
}

$pattern = '/<appears>yes<\/appears>/';
if (preg_match($pattern, $sfsresponse)) {
$potnum = "4";
$reason = _HONEYPOT_SFS_API_CHECK;

$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES (NULL, '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");

OpenTable();
echo '<div style="text-align:center;">' , _HONEYPOT_SFS_API_BLOCKED , '</div>' , PHP_EOL
 , '<br /><br /><br />' , PHP_EOL
 , '<div style="text-align:center;">' , _GOBACK , '</div>' , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>" , PHP_EOL;
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
}
}


//Check possiable new users agienst fspamlist.com API

if ($fs9opt1 == 1 || $fs9opt2 == 1 && !empty($fs9apikey)){
	
$fsapiquery = "http://www.fspamlist.com/api.php?key=".$fs9apikey;
if($fs9opt1 == 1 && $fs9opt2 == 0){$fsapiquery = $fsapiquery."&spammer=".$XMAIL;}
elseif($fs9opt1 == 0 && $fs9opt2 == 1){$fsapiquery = $fsapiquery."&spammer=".$ip;}
elseif($fs9opt1 == 1 && $fs9opt2 == 1){$fsapiquery = $fsapiquery."&spammer=".$XMAIL.",".$ip;}

if(function_exists('file_get_contents')){
	$fsresponse = file_get_contents($fsapiquery);
}else{
	$ch = curl_init($fsapiquery);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$fsresponse = curl_exec($ch);
	curl_close($ch);
}

$pattern = '/<isspammer>true<\/isspammer>/';
if (preg_match($pattern, $fsresponse)) {
$potnum = "7";
$reason = _HONEYPOT_BSREASON;

$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES (NULL, '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");

OpenTable();
echo '<div style="text-align:center;">' , _HONEYPOT_FS_BLOCKED , '</div>' , PHP_EOL
 , '<br /><br />' , PHP_EOL
 , '<div style="text-align:center;">' , _GOBACK , '</div>' , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>";
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>";
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
}
}


//Check possiable new users agienst botscout.com API

if ($c8opt1 == 1 || $c8opt2 == 1){

$apiquery = "http://botscout.com/test/";
if($c8opt1 == 1 && $c8opt2 == 0){$apiquery = "$apiquery?mail=$XMAIL";}
elseif($c8opt1 == 0 && $c8opt2 == 1){$apiquery = "$apiquery?ip=$ip";}
elseif($c8opt1 == 1 && $c8opt2 == 1){$apiquery = "$apiquery?multi&mail=$XMAIL&ip=$ip";}
////////////////////////
if($usebsapi ==1 && $c8apikey != ''){$apiquery = "$apiquery&key=$c8apikey";}

if(function_exists('file_get_contents')){
	$returned_data = file_get_contents($apiquery);
}else{
	$ch = curl_init($apiquery);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$returned_data = curl_exec($ch);
	curl_close($ch);
}

$botdata = explode('|', $returned_data); 

if(($c8opt1 == 1 && $c8opt2 == 0) || ($c8opt1 == 0 && $c8opt2 == 1)){$botdatattype = ($botdata[2] > 0);}
elseif($c8opt1 == 1 && $c8opt2 == 1){$botdatattype = ($botdata[3] > 0 || $botdata[5] > 0);}

if($botdatattype){
$potnum = "6";
$reason = _HONEYPOT_BSREASON;

$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES (NULL, '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");

OpenTable();
echo '<div style="text-align:center;">' , _HONEYPOT_BS_BLOCKED , '</div>' , PHP_EOL
 , '<br /><br /><br />' , PHP_EOL
 , '<div style="text-align:center;">' , _GOBACK , '</div>' , PHP_EOL;
CloseTable();
if ($usefeedback == 0){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKMODULE."</p>" , PHP_EOL;
CloseTable();
}elseif ($usefeedback == 1){
OpenTable();
echo "<p class='center'>"._HONEYPOT_FEEDBACKEMAIL1 , $email , _HONEYPOT_FEEDBACKEMAIL2 , $email , _HONEYPOT_FEEDBACKEMAIL3."</p>" , PHP_EOL;
CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
exit ();
}
}
?>