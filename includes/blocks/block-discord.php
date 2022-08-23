<?PHP
/************************************************************************/
/* Discord Block				                                        */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2003 - 2019 coRpSE	                                    */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

require_once('../../mainfile.php');
global $admin_file, $currentlang, $prefix;
	$result3 = $db->sql_query("SHOW TABLES LIKE '".$prefix."_discord_config'");
	$tableExists = $db->sql_numrows($result3);
	if ($tableExists != 0){
function dis_config()
{
	global $db;
	static $disconfig;

	if(isset($disconfig) && is_array($disconfig))
		return $disconfig;

	$result = $db->sql_query("SELECT `config_value`, `config_name` FROM `nuke_discord_config`");
	while ($row = $db->sql_fetchrow($result))
		$disconfig[$row['config_name']] = $row['config_value'];
	$db->sql_freeresult($result);
	return $disconfig;
}
$disconfig 	= dis_config();

$discordadmins = explode(', ', $disconfig['disadmin']);

	if (file_exists(NUKE_INCLUDE_DIR.'/blocks/discord/language/lang-'.$currentlang.'.php')) 
		{
			include_once(NUKE_INCLUDE_DIR.'/blocks/discord/language/lang-'.$currentlang.'.php');
		} else {
			include_once(NUKE_INCLUDE_DIR.'/blocks/discord/language/lang-english.php');
		}

//current page URL
function curPageURL() {
 $pageURL = 'http';
 if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

$side = substr(curPageURL(), strpos(curPageURL(), "?") + 1);
$side = (($side == 1) || ($side == 0)) ? $side : "0";
$css = ($side == 1) ? 'side' : 'center';
$tborder = ($disconfig["zone8b"] == 0) ? "0" : $disconfig["zone8b"] + 1;
if (!empty($disconfig['jsonurl'])){
echo '<!DOCTYPE html>' , PHP_EOL
, '<html lang="en">' , PHP_EOL
, '<head>' , PHP_EOL
, '<title>Discord Block</title>' , PHP_EOL
, '<link rel="stylesheet" href="./discord/css/'.$css.'.css"/>' , PHP_EOL
, '<script src="./discord/js/jquery-3.3.1.min.js"></script>' , PHP_EOL
, '<script src="./discord/js/jquery.nicescroll.min.js"></script>' , PHP_EOL
, '<script>' , PHP_EOL
, '$(document).ready(function() {' , PHP_EOL
, '		var nice = $("html").niceScroll();  // The document page (body)' , PHP_EOL
, '		$("#mainbody").html($("#mainbody").html()+\' \'+nice.version);' , PHP_EOL
, '		$("#boxscroll").niceScroll({cursorcolor:"'.$disconfig["zone5"].'", cursorwidth:"10px", cursorborder: "1px solid #333", boxzoom:false, autohidemode: false});' , PHP_EOL
, '		$("#boxscroll2").niceScroll({cursorcolor:"'.$disconfig["zone5"].'", cursorwidth:"10px", cursorborder: "1px solid #333", boxzoom:false, autohidemode: false});' , PHP_EOL
, '});' , PHP_EOL
, '</script>' , PHP_EOL
//Let get the styling from the database and add it to our theme
, '<style>' , PHP_EOL
, '.heading, .channel, #bottomh {color: '.$disconfig["zone1"].' !IMPORTANT;}' , PHP_EOL
, '.mstatus {color: '.$disconfig["zone1"].' !IMPORTANT;}' , PHP_EOL
, '.div-link, .username, .desc, .bottomu {color: '.$disconfig["zone2"].' !IMPORTANT;}' , PHP_EOL
, '.div-link {background-color: '.$disconfig["zone3"].' !IMPORTANT;}' , PHP_EOL
, '.div-link:hover {color: '.$disconfig["zone4"].' !IMPORTANT;}' , PHP_EOL
, '.div-link:hover {background-color: '.$disconfig["zone5"].' !IMPORTANT;}' , PHP_EOL
, '#mainbody, .heading, .content, .channel-parent, .bcontent, .bottomu {background-color: '.$disconfig["zone6"].' !IMPORTANT;}' , PHP_EOL
, '.channels, #td-left, .myBox2 {background-color: '.$disconfig["zone7"].' !IMPORTANT;}' , PHP_EOL
, '#ser-empty {color: '.$disconfig["zone2"].' !IMPORTANT;}' , PHP_EOL
, '.xinfo-box {background-color: '.$disconfig["zone7"].'!IMPORTANT;}' , PHP_EOL
, '.div-link, label, #td-left, #td-right {border: '.$disconfig["zone8b"].'px solid '.$disconfig["zone8"].' !IMPORTANT;}', PHP_EOL
, '#bottomh {border-bottom: '.$disconfig["zone8b"].'px solid '.$disconfig["zone8"].'; border-top: '.$disconfig["zone8b"].'px solid '.$disconfig["zone8"].' !IMPORTANT;}', PHP_EOL
, '#mainbody {border: '.$tborder.'px solid '.$disconfig["zone8"].' !IMPORTANT;}', PHP_EOL
, '</style>' , PHP_EOL
, '</head>' , PHP_EOL
, '<body>' , PHP_EOL
, '<div id="mainbody">' , PHP_EOL;

header( "refresh:180;" ); //refreshes the data in seconds.  

//discords API call
$discord = json_decode(file_get_contents($disconfig['jsonurl']));

// Let determin if we should use the small images or the larger images pending if its the side or center.
$size = ($side == 0) ? "large" : "small";
$logo = $disconfig['discordlogo'];
$icons = ($disconfig['discordicons'] == 1) ? 'dark' : 'light';

echo '<div class="heading">' , PHP_EOL;
if ($side == 0) { echo '<div class="h-left">' , PHP_EOL; }
echo $discord->name, PHP_EOL
, '<br>' , PHP_EOL
, '<span class="desc">' , PHP_EOL;
//What image to use?
if ($logo == '1'){ $ic = 'light';}else if($logo == '2'){$ic = 'dark';}else{$ic = 'blue';}
echo '<img class="discord-icon" src="./discord/images/discord_icon_'.$ic.'.png" alt="icon"/> '._DISCORD_VOICE.'</span>' , PHP_EOL;

	if ($side == 0) {
		echo '</div>' , PHP_EOL
		, '<div class="h-right">' , PHP_EOL;
	}

if (isset($discord->instant_invite)){
echo '<a href="'.$discord->instant_invite.'" target="_blank" class="div-link"><div>'._DISCORD_JOIN.'</div></a>' , PHP_EOL;
}

if ($side == 0) { echo '</div>' , PHP_EOL; }
echo '</div>' , PHP_EOL;
			 if ($side == 0){
				 echo '<table id="dtable">' , PHP_EOL
				 , '<tr>' , PHP_EOL
				 , '<td id="td-left">' , PHP_EOL
				 , '<div class="channels-parent">' , PHP_EOL;
			}
	echo '<div class="myBox2" id="boxscroll2">' , PHP_EOL;
function cmp($a, $b)
{
	if ($a->position == $b->position) {
		return 0;
	}
	return ($a->position < $b->position) ? -1 : 1;
}
$channels = $discord->channels;
usort($channels, 'cmp');
$mn = 0;
$bleh = 1;
if ($discord->channels) {

	foreach ($discord->members as $member) {
		if (!empty($member->channel_id)) {
			$channel_members[$member->channel_id][] = $member->username;
		}
	}
	$cnt =0;
	foreach ($channels as &$channel) {
		$empty = ($disconfig['showempty'] == 0) ? !empty($channel_members[$channel->id]) : $bleh == 1;

			if ($empty) {  // This one to hide empty channels
				echo '<div class="channels">' , PHP_EOL;
				$channel_name = $channel->name;
				$bsize = ($side == 0) ? 40 : 20;
				echo '<span class="channel">&nbsp;&nbsp;'.mb_strimwidth($channel_name, 0, $bsize, " ...").'</span></div>' , PHP_EOL;

				foreach($discord->members as $m) {
					if(!empty($m->channel_id) && $m->channel_id == $channel->id) {
						$cnt++;
						if(isset($m->game->name)){
								echo '<div class="content parent-game">' , PHP_EOL;
							}else{
								echo '<div class="content">' , PHP_EOL;
							}
						if ($side == 0){ echo '&nbsp;&nbsp;&nbsp;&nbsp;<img class="avatar" src="'.$m->avatar_url.'" alt="">' , PHP_EOL;}
						if (isset($m->nick)) {
									if ($side == 0){
										echo '&nbsp;' , PHP_EOL
										, '<img class="d-status" src="./discord/images/'.$m->status.'_'.$size.'.png" alt="'.$m->status.'" title="'.$m->status.'">' , PHP_EOL
										, '&nbsp;<span class="username">'.$m->nick.'</span>' , PHP_EOL;
									}else{
										echo '<span class="raquo">&raquo;</span>' , PHP_EOL
										, '<span class="username">'.mb_strimwidth($m->nick, 0, 15, " ...").'</span>' , PHP_EOL;
									}
								} else {
									if ($side == 0){
										echo '&nbsp;' , PHP_EOL
										, '<img class="d-status" src="./discord/images/'.$m->status.'_'.$size.'.png" alt="'.$m->status.'" title="'.$m->status.'">' , PHP_EOL
										, '&nbsp;' , PHP_EOL
										, '<span class="username">'.$m->username.'</span>' , PHP_EOL;
									}else{
										echo '<span class="raquo">&raquo;</span>' , PHP_EOL
										, '<span class="username">'.mb_strimwidth($m->username, 0, 15, " ...").'</span>' , PHP_EOL;
									}
								}
								$mn++;
								if (in_array($m->id, $discordadmins)) {
										if ($side == 0){
											echo '<span class="admin">'._DISCORD_ADM.'</span>' , PHP_EOL;
										}else{
											echo '&nbsp;<img class="admin" src="./discord/images/admin.png" alt="Admin" title="ADMIN">' , PHP_EOL;
										}
									}
								if ($side == 0){
									switch ($m->self_mute) {
										case "true":
										echo '&nbsp;<img class="mutedeaf" src="./discord/images/mute-'.$icons.'.png" alt="Muted" title="Muted">' , PHP_EOL;
									}
								switch ($m->self_deaf) {
										case "true":
											echo '&nbsp;<img class="mutedeaf" src="./discord/images/deaf-'.$icons.'.png" alt="Deafen" title="Deafen">' , PHP_EOL;
									}
								}
								if(isset($m->bot)) {
									if ($side == 0){
										echo '<span class="bot">'._DISCORD_BOT.'</span>' , PHP_EOL;
									}else{
										echo '<span><img class="bot" src="./discord/images/bot.png" alt="Bot" title="Bot"></span>' , PHP_EOL;
									}
								}
									if ($side == 0){
										if (isset($m->game->name)) { $m->game->name = (mb_strlen($m->game->name) > 25) ? mb_substr($m->game->name, 0, 25) . '...' : $m->game->name;
											echo '&nbsp;&nbsp;' , PHP_EOL
											, '<span class="game">' , PHP_EOL
											, '<strong>'._DISCORD_INGAME.'</strong>' , PHP_EOL
											, ':&nbsp;'. ucwords(strtolower($m->game->name)) .'</span>' , PHP_EOL;
										}
									}else{
										if (isset($m->game->name)) { $m->game->name = (mb_strlen($m->game->name) > 18) ? mb_substr($m->game->name, 0, 18) . '...' : $m->game->name;
											echo '&nbsp;<img class="ingame" src="./discord/images/ingame.png" alt="In Game" title="In Gmae">' , PHP_EOL
											, '<div class="hidden-game">' , PHP_EOL
											, '<strong>'._DISCORD_GAME.'</strong> '.ucwords(strtolower($m->game->name)).'</div>' , PHP_EOL;
										}
									}
						echo "</div>" , PHP_EOL;
					}
				}
           }
       }
     if ($cnt == 0 && ($disconfig['showempty'] == 0)){
		 echo '<div class="channels" id="ser-empty">' , PHP_EOL
		 , '<br><strong>'._DISCORD_NOBODY.'<br><br>' , PHP_EOL
		 , ' <img class="ingame" src="./discord/images/sad-discord.png" style="width:100px; height:74px;" alt="Nobody Online &#9785;" title="Nobody Online &#9785;"><br><br>' , PHP_EOL
		 , _DISCORD_ON_SERVER.'</strong><br><br>' , PHP_EOL
		 , '</div>' , PHP_EOL;
	}
}
			echo '</div>' , PHP_EOL;
			if ($side == 0){ echo '</div>' , PHP_EOL
			, '</td><td id="td-right">' , PHP_EOL; }
//Lets get the stats to display
$totalm_online = count($discord->members);
$tig = 0;
$tic = 0;
foreach ($discord->members as $mcount){
	if(isset($mcount->game->name) && !isset($mcount->bot)){
		$tig++;
	}
	if(isset($mcount->channel_id)){
		$tic++;
	}
}
$totalm_ingame = $tig;
$totalm_invoice = $tic;
//Done getting the stats to display
$space = ($side == 0) ? "&nbsp;" : "<br>";
if ($side == 0){
	echo '<div class="bcontent">' , PHP_EOL;
}else{
	echo '<div class="content">' , PHP_EOL;
}
	echo '<div id="bottomh">', PHP_EOL
	, '<table style="width:100%;"><tr><td style="width:33%;" class="xinfo-box">' , PHP_EOL
	, '<span class="xinfo">'._DISCORD_ONLINE.'</span>'.$space.'<span class="username">'.$totalm_online.'</span></td>', PHP_EOL
	, '<td style="width:34%;" class="xinfo-box"><span class="xinfo">'._DISCORD_INGAME.'</span>'.$space.'<span class="username">'.$totalm_ingame.'</span></td>', PHP_EOL
	, '<td style="width:33%;" class="xinfo-box"><span class="xinfo">'._DISCORD_INVOICE.'</span>'.$space.'<span class="username">'.$totalm_invoice.'</span></td></tr></table>' , PHP_EOL
	, '</div>' , PHP_EOL;
	echo '<div class="myBox" id="boxscroll">' , PHP_EOL;
foreach ($discord->members as $mem) {

		$name = (isset($mem->nick)) ? $mem->nick : $mem->username;
		$name = ($side == 0) ? ((isset($mem->bot)) ? mb_strimwidth($name, 0, 18, '...') : mb_strimwidth($name, 0, 22, '...')) : ((isset($mem->bot)) ? mb_strimwidth($name, 0, 12, '...') : mb_strimwidth($name, 0, 16, '...'));
		$mstatus = isset($mem->game->name) ? $mem->game->name : $mem->status;
		$imgside = ($side == 0) ? '2' : '';
	echo '<div class="bottomu">' , PHP_EOL;
	if ($side == 0){ echo '<table style="width:100%;">' , PHP_EOL
	, '	<tr>' , PHP_EOL
	, '		<td style="width:30px;">' , PHP_EOL;
	}
	echo '<img class="avatar'.$imgside.'" src="'.$mem->avatar_url.'" alt="">&nbsp;' , PHP_EOL
	, '<img class="d-status'.$imgside.'" src="./discord/images/'.$mem->status.'_'.$size.'.png" alt="'.$mem->status.'" title="'.$mem->status.'">' , PHP_EOL;
	if ($side == 0){
		echo '		</td>' , PHP_EOL
	, '		<td>'.$name , PHP_EOL;
	}else{
		echo '&nbsp;'.$name.'&nbsp;&nbsp;' , PHP_EOL;
	}
		if (in_array($mem->id, $discordadmins)) {
			echo '&nbsp;<img class="admin-img'.$imgside.'" src="./discord/images/admin.png" alt="Admin" title="Admin">' , PHP_EOL;
		}
			if(isset($mem->bot)) {
				if ($side == 0){
					echo '<span class="bot">'._DISCORD_BOT.'</span>' , PHP_EOL;
				}else{
					echo '<span class="helper"><img class="bot" src="./discord/images/bot.png" alt="Bot" title="Bot"></span>' , PHP_EOL;
				}
			}
			if(!empty($mem->channel_id) && $side == 0){
					echo '<span class="helper"><img class="ingame-img" src="./discord/images/inchat.png" alt="In Channel" title="In Channel"></span>' , PHP_EOL;
				}
			if ($side == 0){
				echo  '<br><span style="font-size: 11px;" class="mstatus">'.$mstatus.'</span>' , PHP_EOL
				, '		</td>' , PHP_EOL
				,'	</tr>' , PHP_EOL
				,'</table>' , PHP_EOL;
			}
		echo '</div>' , PHP_EOL;
		
	}
	echo '</div>' , PHP_EOL
	, '</div>' , PHP_EOL;
			if ($side == 0){
					echo '</td>' , PHP_EOL
					 , '</tr>' , PHP_EOL
				, '</table>' , PHP_EOL;
			}
			echo '<br>' , PHP_EOL
		, '</div>' , PHP_EOL
	, '</body>' , PHP_EOL
, '</html>' , PHP_EOL;
}else{
	print '<div style="width:100%; color:#F00; font-size:18px; text-align:center; border:2px solid #F00; background-color:#000; border-radius:10px;">Need to input the Discord JSON api url.</div>';
}
	}else{
print '<div style="width:100%; color:#F00; font-size:18px; text-align:center; border:2px solid #F00; background-color:#000; border-radius:10px;">Database does not exist.</div>';
	}
?>
