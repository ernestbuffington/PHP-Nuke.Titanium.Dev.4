<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.1b : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/ 
 
/************************************************************************
   PHP-Nuke Titanium v3.0.1b
   ======================================================================
   Copyright (c) 2019 by The PHP-Nuke Titanium Team
  
   Filename      : block-Titanium_Visitor_Log_Center.php
   Author        : Ernest Buffington / lonestar 
   Websites      : (hub.86it,us) /(lonestar-modules.com)
   Version       : 3.0.1b
   Date          : 04.21.2021 (mm.dd.yyyy)
                                                                        
   Notes         : Simple block to allow people to see who was last seen 
                 : on the website.
************************************************************************/
defined('NUKE_EVO') or die('Just go away, Shit Head!');

global $db, $prefix, $userinfo;
global $evouserinfo_avatar, $board_config, $userinfo, $bgcolor4; 

$max_height = '80';
$max_width = '100';

$z = 3;
$row1_result = $db->sql_query("SELECT * FROM `".$prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT ".$z."");

$row1   = '<div align="center">';
$row1  .= '<table class="tableVisotrLog">';
$row1  .= '<tr>';
$row1  .= '<td align="center">';

$row1  .= '<table width="260">';

while($whosbeen = $db->sql_fetchrow($row1_result)):
    
	if (strlen($whosbeen['username']) > 15)
    $whosbeen['username'] = substr($whosbeen['username'], 0, 9) . '...';
	
	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar_type'] = 4;
	$whosbeen['user_id'] = 1;
	endif;
	
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

    $row1 .= '<td><br /></td>';
	$row1 .= '<tr>';
	$row1 .= '</tr>';
	$row1 .= '<tr>';

	
    if($whosbeen['user_avatar'])
    {
	   switch($whosbeen['user_avatar_type'])
	   {
		# user_allowavatar = 1
		case USER_AVATAR_UPLOAD:
		$avatar = ''.( $board_config['allow_avatar_upload'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" />' : '';
	
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = ''.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" />';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = ''. ( $board_config['allow_avatar_local'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.png' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" />' : '';
		break;
		# user_allowavatar = 4
		case 4:
		$avatar = '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/invisible.png" alt="" />';
		break;

	   }
	}
	
	
	
	
	
	$row1 .= '<tr>';
	$row1 .= '<td width="81" rowspan="3" align="center"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
	$row1 .= '<td width="100%" align="left" valign="bottom">&nbsp;&nbsp;<a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'"><span style="font-weight: bold; text-shadow: 3px 0px 7px rgba(81,67,21,0.8), -3px 0px 7px rgba(81,67,21,0.8), 0px 4px 7px rgba(81,67,21,0.8);">'.UsernameColor($whosbeen['username']).'</span></a></td>';
	$row1 .= '<td width="81" rowspan="3" align="center">'.get_titanium_timeago($whosbeen['last_visit']).'';
	$row1 .= '</td>';
	$row1 .= '</tr>';
	$row1 .= '<tr>';
	$row1 .= '<td width="356" align="left" valign="bottom" height="2">&nbsp;&nbsp;<a class="modules" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'">
	<i class="bi bi-envelope"></i><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i>';
	$row1 .= '</td>';
	$row1 .= '</tr>';
	$row1 .= '<tr>';
	$row1 .= '<td width="356" valign="top">&nbsp;&nbsp;<i class="fa-solid fa-desktop"></i>&nbsp;<span style="color:gold">'.$whosbeen['resolution'].'</span></td>';
	$row1 .= '</tr>';

endwhile;

$row1 .= '</table>';
$row1 .= '</td>';
$row1 .= '</tr>';
$row1 .= '</table>';
$row1 .= '</div>';

$row2_result = $db->sql_query("SELECT * FROM `".$prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 3, ".$z."");

$row2   = '<div align="center">';
$row2  .= '<table class="tableVisotrLog">';
$row2  .= '<tr>';
$row2  .= '<td align="center">';

$row2  .= '<table width="260">';

while($whosbeen = $db->sql_fetchrow($row2_result)):

	if (strlen($whosbeen['username']) > 15)
    $whosbeen['username'] = substr($whosbeen['username'], 0, 9) . '...';

	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar_type'] = 4;
	$whosbeen['user_id'] = 1;
	endif;
	
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

    $row2 .= '<td><br /></td>';
	$row2 .= '<tr>';
	$row2 .= '</tr>';
	$row2 .= '<tr>';

    if($whosbeen['user_avatar'])
    {
	   switch($whosbeen['user_avatar_type'])
	   {
		# user_allowavatar = 1
		case USER_AVATAR_UPLOAD:
		$avatar = ''.( $board_config['allow_avatar_upload'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" />' : '';
	
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = ''.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" />';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = ''. ( $board_config['allow_avatar_local'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.png' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" />' : '';
		break;
		# user_allowavatar = 4
		case 4:
		$avatar = '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/invisible.png" alt="" />';
		break;

	   }
	}
	
	$row2 .= '<tr>';
	$row2 .= '<td width="81" rowspan="3" align="center"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
	$row2 .= '<td width="100%" align="left" valign="bottom">&nbsp;&nbsp;<a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'"><span style="font-weight: bold; text-shadow: 3px 0px 7px rgba(81,67,21,0.8), -3px 0px 7px rgba(81,67,21,0.8), 0px 4px 7px rgba(81,67,21,0.8);">'.UsernameColor($whosbeen['username']).'</span></a></td>';
	$row2 .= '<td width="81" rowspan="3" align="center">'.get_titanium_timeago($whosbeen['last_visit']).'';
	$row2 .= '</td>';
	$row2 .= '</tr>';
	$row2 .= '<tr>';
	$row2 .= '<td width="356" align="left" valign="bottom" height="2">&nbsp;&nbsp;<a class="modules" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'">
	<i class="bi bi-envelope"></i><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i>';
	$row2 .= '</td>';
	$row2 .= '</tr>';
	$row2 .= '<tr>';
	$row2 .= '<td width="356" valign="top">&nbsp;&nbsp;<i class="fa-solid fa-desktop"></i>&nbsp;<span style="color:gold">'.$whosbeen['resolution'].'</span></td>';
	$row2 .= '</tr>';

endwhile;

$row2 .= '</table>';
$row2 .= '</td>';
$row2 .= '</tr>';
$row2 .= '</table>';
$row2 .= '</div>';

$row3_result = $db->sql_query("SELECT * FROM `".$prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 6, ".$z."");

$row3   = '<div align="center">';
$row3  .= '<table class="tableVisotrLog">';
$row3  .= '<tr>';
$row3  .= '<td align="center">';

$row3  .= '<table width="260">';

while($whosbeen = $db->sql_fetchrow($row3_result)):

	if (strlen($whosbeen['username']) > 15)
    $whosbeen['username'] = substr($whosbeen['username'], 0, 9) . '...';

	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar_type'] = 4;
	$whosbeen['user_id'] = 1;
	endif;
	
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

    $row3 .= '<td><br /></td>';
	$row3 .= '<tr>';
	$row3 .= '</tr>';
	$row3 .= '<tr>';
	
    if($whosbeen['user_avatar'])
    {
	   switch($whosbeen['user_avatar_type'])
	   {
		# user_allowavatar = 1
		case USER_AVATAR_UPLOAD:
		$avatar = ''.( $board_config['allow_avatar_upload'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" />' : '';
	
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = ''.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" />';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = ''. ( $board_config['allow_avatar_local'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.png' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" />' : '';
		break;
		# user_allowavatar = 4
		case 4:
		$avatar = '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/invisible.png" alt="" />';
		break;

	   }
	}
	
	$row3 .= '<tr>';
	$row3 .= '<td width="81" rowspan="3" align="center"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
	$row3 .= '<td width="100%" align="left" valign="bottom">&nbsp;&nbsp;<a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'"><span style="font-weight: bold; text-shadow: 3px 0px 7px rgba(81,67,21,0.8), -3px 0px 7px rgba(81,67,21,0.8), 0px 4px 7px rgba(81,67,21,0.8);">'.UsernameColor($whosbeen['username']).'</span></a></td>';
	$row3 .= '<td width="81" rowspan="3" align="center">'.get_titanium_timeago($whosbeen['last_visit']).'';
	$row3 .= '</td>';
	$row3 .= '</tr>';
	$row3 .= '<tr>';
	$row3 .= '<td width="356" align="left" valign="bottom" height="2">&nbsp;&nbsp;<a class="modules" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'">
	<i class="bi bi-envelope"></i><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i>';
	$row3 .= '</td>';
	$row3 .= '</tr>';
	$row3 .= '<tr>';
	$row3 .= '<td width="356" valign="top">&nbsp;&nbsp;<i class="fa-solid fa-desktop"></i>&nbsp;<span style="color:gold">'.$whosbeen['resolution'].'</span></td>';
	$row3 .= '</tr>';

endwhile;

$row3 .= '</table>';
$row3 .= '</td>';
$row3 .= '</tr>';
$row3 .= '</table>';
$row3 .= '</div>';

$row4_result = $db->sql_query("SELECT * FROM `".$prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 9, ".$z."");

$row4   = '<div align="center">';
$row4  .= '<table class="tableVisotrLog">';
$row4  .= '<tr>';
$row4  .= '<td align="center">';

$row4  .= '<table width="260">';

while($whosbeen = $db->sql_fetchrow($row4_result)):

	if (strlen($whosbeen['username']) > 15)
    $whosbeen['username'] = substr($whosbeen['username'], 0, 9) . '...';

	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar_type'] = 4;
	$whosbeen['user_id'] = 1;
	endif;
	
	if($whosbeen['user_from_flag']):
	$whosbeen['user_from_flag'] = str_replace('.png','',$whosbeen['user_from_flag']);
	else:
	$whosbeen['user_from_flag'] = 'unknown';
	endif;

	if($whosbeen['user_avatar_type']):
	$whosbeen['user_avatar_type'] = str_replace('.png','',$whosbeen['user_avatar_type']);
	else:
	$whosbeen['user_avatar_type'] = '3';
	endif;

    $row4 .= '<td><br /></td>';
	$row4 .= '<tr>';
	$row4 .= '</tr>';
	$row4 .= '<tr>';
	
    if($whosbeen['user_avatar'])
    {
	   switch($whosbeen['user_avatar_type'])
	   {
		# user_allowavatar = 1
		case USER_AVATAR_UPLOAD:
		$avatar = ''.( $board_config['allow_avatar_upload'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" />' : '';
	
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = ''.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" />';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = ''. ( $board_config['allow_avatar_local'] ) 
		? '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.png' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" />' : '';
		break;
		# user_allowavatar = 4
		case 4:
		$avatar = '<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $board_config['avatar_gallery_path'] . '/invisible.png" alt="" />';
		break;

	   }
	}
	
	$row4 .= '<tr>';
	$row4 .= '<td width="81" rowspan="3" align="center"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
	$row4 .= '<td width="100%" align="left" valign="bottom">&nbsp;&nbsp;<a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'"><span style="font-weight: bold; text-shadow: 3px 0px 7px rgba(81,67,21,0.8), -3px 0px 7px rgba(81,67,21,0.8), 0px 4px 7px rgba(81,67,21,0.8);">'.UsernameColor($whosbeen['username']).'</span></a></td>';
	$row4 .= '<td width="81" rowspan="3" align="center">'.get_titanium_timeago($whosbeen['last_visit']).'';
	$row4 .= '</td>';
	$row4 .= '</tr>';
	$row4 .= '<tr>';
	$row4 .= '<td width="356" align="left" valign="bottom" height="2">&nbsp;&nbsp;<a class="modules" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'">
	<i class="bi bi-envelope"></i><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i>';
	$row4 .= '</td>';
	$row4 .= '</tr>';
	$row4 .= '<tr>';
	$row4 .= '<td width="356" valign="top">&nbsp;&nbsp;<i class="fa-solid fa-desktop"></i>&nbsp;<span style="color:gold">'.$whosbeen['resolution'].'</span></td>';
	$row4 .= '</tr>';

endwhile;

$row4 .= '</table>';
$row4 .= '</td>';
$row4 .= '</tr>';
$row4 .= '</table>';
$row4 .= '</div>';

global $screen_width;
$content = '<div align="center">';

if($screen_width < 1920):
$content .= '<table class="tableVisotrLog">';
$content .= '	<tr>';
$content .= '		<td style="padding-top: 6px; padding-bottom: 25px;" width="251" valign="top">'.$row1.'</td>';
$content .= '		<td style="padding-top: 6px; padding-bottom: 25px;" width="251" valign="top">'.$row2.'</td>';
$content .= '		<td style="padding-top: 6px; padding-bottom: 25px;" width="251" valign="top">'.$row3.'</td>';
$content .= '	</tr>';
endif;

if($screen_width >= 1920):
$content .= '<table class="tableVisotrLog">';
$content .= '	<tr>';
$content .= '		<td style="padding-top: 6px; padding-bottom: 25px;" width="25%" valign="top">'.$row1.'</td>';
$content .= '		<td style="padding-top: 6px; padding-bottom: 25px;" width="25%" valign="top">'.$row2.'</td>';
$content .= '		<td style="padding-top: 6px; padding-bottom: 25px;" width="25%" valign="top">'.$row3.'</td>';
$content .= '		<td style="padding-top: 6px; padding-bottom: 25px;" width="25%" valign="top">'.$row4.'</td>';
$content .= '	</tr>';
$content .= '</table>';
endif;


$content .= '</div>';

?>