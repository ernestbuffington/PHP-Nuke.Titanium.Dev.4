<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
 
/************************************************************************
   PHP-Nuke Titanium v3.0.0
   ======================================================================
   Copyright (c) 2019 by The PHP-Nuke Titanium Team
  
   Filename      : block-Titanium_Last_Seen.php
   Author        : Ernest Buffington / lonestar 
   Websites      : (hub.86it,us)     /(lonestar-modules.com)
   Version       : 3.0.0
   Date          : 08.13.2019 (mm.dd.yyyy)
                                                                        
   Notes         : Simple block to allow people to see who was last seen 
                 : on the website.
************************************************************************/
defined('NUKE_EVO') or die('Just go away, Shit Head!');

global $db, $prefix, $userinfo;
global $evouserinfo_avatar, $board_config, $userinfo; 

$max_height = '60';
$max_width = '';

$result = $db->sql_query("SELECT * FROM `".$prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 10");

$content  = '<table border="0" cellpadding="0" cellspacing="1" class="col-12">';
while($whosbeen = $db->sql_fetchrow($result)):

	if($whosbeen['user_from_flag'] ):
	$whosbeen['user_from_flag'] = str_replace('.png','',$whosbeen['user_from_flag']);
	else:
	$whosbeen['user_from_flag'] = 'unknown';
	endif;

	if($whosbeen['user_avatar_type']):
	$whosbeen['user_avatar_type'] = str_replace('.png','',$whosbeen['user_avatar_type']);
	else:
	$whosbeen['user_avatar_type'] = '3';
	endif;

    $content .= '<td></td>';
	$content .= '<tr>';
	$content .= '</tr>';
	$content .= '<tr>';
	
    if($whosbeen['user_avatar'])
    {
	   switch($whosbeen['user_avatar_type'])
	   {
		# user_allowavatar = 1
		case USER_AVATAR_UPLOAD:
		$avatar = '<td width="45px">'.( $board_config['allow_avatar_upload'] ) 
		? '<div align="center"><img class="rounded-corners-last-vistors" style="max-height: '.$max_height.'px;" src="' . $board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" border="0" /></div></td>' : '</td>';
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = '<td width="45px"><div align="center">'.'<img class="rounded-corners-last-vistors" style="max-height: '.$max_height.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" border="0" /></div></td>';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = '<td width="45px">'. ( $board_config['allow_avatar_local'] ) 
		? '<div align="center"><img class="rounded-corners-last-vistors" style="max-height: '.$max_height.'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.png' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" border="0" /></td>' : '</div></td>';
		break;

	   }
	}
	
    # testing database lookup <span class="countries '.$whosbeen['user_from_flag'].'"></span>
	//list($shit) = $db->sql_ufetchrow("SELECT `user_id` FROM `".$prefix."_users` WHERE `username`='".$whosbeen['username']."'", SQL_NUM);
	//list($notes) = $db->sql_ufetchrow("SELECT `user_admin_notes` FROM `".$prefix."_users` WHERE `user_id`='".$shit."'", SQL_NUM);
	
	$content .= '<td width="45px"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
    $content .= '<td><a class="visitorName" style="text-decoration: none;" href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">
	<strong>&nbsp;&nbsp;'.UsernameColor($whosbeen['username']).'<br />&nbsp;&nbsp;<a style="text-decoration: none;" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'"><font size="5" color="orange"><i class="bi bi-envelope"></i>&nbsp;<font color="gold" size="5"><i class="bi bi-mailbox"></i></font></font>
	
	&nbsp;<br />
	&nbsp;&nbsp;&nbsp;&nbsp;<font size="3" color="gold"><i class="bi bi-arrow-90deg-up"></i></font><font class="gensmall"> PM </font></span>
	</a></td>';
	$content .= '<td><div align="top" style="padding-left:10px;"><br />'.get_titanium_timeago($whosbeen['last_visit']).'<br /></div></td>';
	$content .= '</tr>'; 

endwhile;
$content .= '</table>';
?>