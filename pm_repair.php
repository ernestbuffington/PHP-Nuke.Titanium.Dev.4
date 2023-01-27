<?php
//=========================================
// DO NOT EDIT ANYTHING BELOW!!!
//=========================================
//Created by coRpSE - www.headshotdomain.net
//Use Case: 
//=========================================

require_once('mainfile.php');
include_once(NUKE_BASE_DIR.'header.php');
if(!is_admin()) {
	OpenTable();
	echo 'Get Lost...<br />Only Admins can run this script.';
	CloseTable();
	exit();
 }
	global $prefix, $db;
?>
<style>
.heading{
	font-weight:600;
	font-size: 16px;
	letter-spacing:1px;
}

.pmbgc1{ background-color: #111; }

.pmbgc2{ background-color: #181818;}

.success{color: #00FF00; font-weight: 900;}

.fail{color: #F00; font-weight: 900;}

.div-table {
  display: table;
  width:80%;
  min-width: 700px;
  border: 1px solid;
  margin:auto;
  font-size:16px;
  letter-spacing:1px;
  border-spacing: 5px; /* cellspacing:poor IE support for  this */
}
.div-table-row {
  display: table-row;
  width: auto;
  clear: both;
}
.div-table-col {
  float: left; /* fix for  buggy browsers */
  display: table-column;
  width: 200px;
}
.div1 {
	width: 45%;
	border-right: 0px solid #555;
}
.div2, .div3 {
	width: 25%;
	border-right: 0px solid #555;
	padding-left: 5px;
}
.div4 {
	width: 5%;
	text-align: center;
}

</style>
<?PHP


//Fix everyone
	$count = "0";
	$bgc = "0";
	//$db->sql_query("UPDATE `". $prefix ."_users` SET `user_unread_privmsg` = '0' WHERE `user_id` = '1'");
	$result = $db->sql_query( "select * from `". $prefix ."_users`");
	while( $row = $db->sql_fetchrow($result)){
		$uid = $row['user_id'];
		$pmcount1 = $row['user_new_privmsg'];
		$pmcount2 = $row['user_unread_privmsg'];
		$pmcount = $pmcount1 + $pmcount2;
		$result2 = $db->sql_query("SELECT COUNT(*) FROM `". $prefix ."_bbprivmsgs` WHERE (privmsgs_type = '1' OR privmsgs_type = '5') AND privmsgs_to_userid = $uid");
		list($pmunread) = $db->sql_fetchrow($result2);
		if ($pmcount != $pmunread){
			if ($uid != "1"){
			$upresult = $db->sql_query("UPDATE `". $prefix ."_users` SET `user_new_privmsg` = '$pmunread', `user_unread_privmsg` = '0' WHERE `user_id` = '$uid'");
			$checkres = ($upresult) ? 'success' : 'fail';
			}else{
				$db->sql_query("UPDATE `". $prefix ."_bbprivmsgs` SET `privmsgs_type` = '2' WHERE privmsgs_to_userid = '1'");
				$upresult = $db->sql_query("UPDATE `". $prefix ."_users` SET `user_new_privmsg` = '0', `user_unread_privmsg` = '0' WHERE `user_id` = '1'");
				$checkres = ($upresult) ? 'success' : 'fail';
			}
			$bgColor = ($bgc == 1) ? 'pmbgc1' : 'pmbgc2';
			$username .= '<div class="div-table-row '.$bgColor.'">';
			$username .= '<div class="div-table-col div1">';
			$username .= '<a href="/modules.php?name=Profile&mode=viewprofile&u='.$uid.'" target="_blank"> '.$row['username'].'</a></div>';
			$username .= '<div class="div-table-col div2"> '.$pmcount.'</div><div class="div-table-col div3"> '.$pmunread.'</div>';
			$username .= '<div class="div-table-col div4 '.$checkres.'">&nbsp;&check;&nbsp;</div></div>';
			$bgc = ($bgc == 1) ? 0 : 1;
			$count++;
			};
  };
//Display everything
	OpenTable();
	if ($count > 0 || $anon > 0):
		echo '<div style="text-align: center;"><H2 style="text-align: center;">';
		echo '<span style="color: #f0d50f;">'.$count . '</span> Total people had PM issues. </H2>';
		echo '<span class="success">&check;</span> Means they were fixed.<br />';
		echo '<span class="fail">&check;</span> Means they wern\'t fixed.</div>';
		CloseTable();
		OpenTable();
		echo '<div class="div-table">';
		echo '<div class="div-table-row" style="height:35px; background-color: #252525; color: #FFF;">';
		echo '<div class="div-table-col heading div1"> Username</div><div class="div-table-col div2 heading"> False PM Count</div><div class="div-table-col div3 heading"> True UnRead PM\'s</div><div class="div-table-col div4" sytle="text-align:center; padding: 0px 5px; width: 25px;">&nbsp;&nbsp;&nbsp;</div></div>';
		echo $username;
		echo '</div>';
	else:
		echo '<div style="padding: 10px;"><br />Everyone is all set. There are no discrepancies with any PM\'s on this site.<br />Any questions, feel free to contact coRpSE at <a href="https://evolution-xtreme.co.uk" target=_blank">evolution-xtreme.co.uk</a>.</div><br />' ;
	endif;
  CloseTable();

//Copyright
echo '<div style="float: right;">&copy; '.date('Y').' <a href="https://www.headshotdomain.net" target="_blank">HeadShotDomain.net</a></div>';
include_once(NUKE_BASE_DIR.'footer.php');
?>