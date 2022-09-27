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

global $titanium_db, $titanium_prefix, $userinfo;
global $evouserinfo_avatar, $phpbb2_board_config, $userinfo, $bgcolor4; 

$max_height = '59';
$max_width = '59';

$z = 3;
$row1_result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT ".$z."");

$row1   = '<div align="center">';
$row1  .= '<table bgcolor="'.$bgcolor4.'" border="0" width="200">';
$row1  .= '<tr>';
$row1  .= '<td align="center">';

$row1  .= '<table bgcolor="'.$bgcolor4.'" border="0" cellpadding="0" cellspacing="0" class="visitorlog">';

while($whosbeen = $titanium_db->sql_fetchrow($row1_result)):
    
	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar'] = 'invisible.png';
	$whosbeen['user_id'] = -1;
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
		$avatar = '<td width="45px">'.( $phpbb2_board_config['allow_avatar_upload'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" border="0" /></div></td>' : '</td>';
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = '<td width="45px"><div align="center">'.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" border="0" /></div></td>';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = '<td width="45px">'. ( $phpbb2_board_config['allow_avatar_local'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.gif' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" border="0" /></td>' : '</div></td>';
		break;

	   }
	}
	
	
	$row1 .= '<td align="center" width="45px"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
    $row1 .= '<td align="left"><a class="turdball" style="text-decoration: none;" href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">
	<strong>&nbsp;&nbsp;'.UsernameColor($whosbeen['username']).'<br />&nbsp;&nbsp;<a style="text-decoration: none;" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'"><font size="5" color="orange"><i class="bi bi-envelope"></i><font color="gold" size="5"><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i></font></font>
	
	&nbsp;<br />
	&nbsp;&nbsp;<font size="5" color="gold"><i class="bi bi-arrow-up-short"></i></font><font class="gensmall">SEND PM </font></span>
	</a></td>';
	$row1 .= '<td align="center"><div align="top" style="padding-left:10px;">'.get_titanium_timeago($whosbeen['last_visit']).'</div>';
    $row1 .= '</td>';
    $row1 .= '</tr>'; 
	
   

endwhile;
    $row1 .= '</table>';

$row1 .= '</td>';
		$row1 .= '</tr>';
	$row1 .= '</table>';
$row1 .= '</div>';

$row2_result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 3, ".$z."");

$row2   = '<div align="center">';
$row2  .= '<table bgcolor="'.$bgcolor4.'" border="0" width="200">';
$row2  .= '<tr>';
$row2  .= '<td align="center">';

$row2  .= '<table border="1" cellpadding="0" cellspacing="0" class="visitorlog">';

while($whosbeen = $titanium_db->sql_fetchrow($row2_result)):

	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar'] = 'invisible.png';
	$whosbeen['user_id'] = -1;
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
		$avatar = '<td width="45px">'.( $phpbb2_board_config['allow_avatar_upload'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" border="0" /></div></td>' : '</td>';
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = '<td width="45px"><div align="center">'.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" border="0" /></div></td>';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = '<td width="45px">'. ( $phpbb2_board_config['allow_avatar_local'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.gif' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" border="0" /></td>' : '</div></td>';
		break;

	   }
	}
	
	
	$row2 .= '<td align="center" width="45px"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
    // fixed row 2 it was not aligned 8/21/2022 TheGhost
	$row2 .= '<td align="left"><a class="turdball" style="text-decoration: none;" href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">
	<strong>&nbsp;&nbsp;'.UsernameColor($whosbeen['username']).'<br />&nbsp;&nbsp;<a style="text-decoration: none;" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'"><font size="5" color="orange"><i class="bi bi-envelope"></i><font color="gold" size="5"><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i></font></font>
    <br />
	&nbsp;&nbsp;<font size="5" color="gold"><i class="bi bi-arrow-up-short"></i></font><font class="gensmall">SEND PM </font></span>
	</a></td>';
	$row2 .= '<td align="center"><div align="top" style="padding-left:10px;">'.get_titanium_timeago($whosbeen['last_visit']).'</div>';
    $row2 .= '</td>';
    $row2 .= '</tr>'; 
	
   

endwhile;
    $row2 .= '</table>';

$row2 .= '</td>';
		$row2 .= '</tr>';
	$row2 .= '</table>';
$row2 .= '</div>';

$row3_result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 6, ".$z."");

$row3   = '<div align="center">';
$row3  .= '<table bgcolor="'.$bgcolor4.'" border="0" width="200">';
$row3  .= '<tr>';
$row3  .= '<td align="center">';

$row3  .= '<table border="1" cellpadding="0" cellspacing="1" class="visitorlog">';

while($whosbeen = $titanium_db->sql_fetchrow($row3_result)):

	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar'] = 'invisible.png';
	$whosbeen['user_id'] = -1;
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
		$avatar = '<td width="45px">'.( $phpbb2_board_config['allow_avatar_upload'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" border="0" /></div></td>' : '</td>';
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = '<td width="45px"><div align="center">'.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" border="0" /></div></td>';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = '<td width="45px">'. ( $phpbb2_board_config['allow_avatar_local'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.gif' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" border="0" /></td>' : '</div></td>';
		break;

	   }
	}
	
	
	$row3 .= '<td align="center" width="45px"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
    $row3 .= '<td align="left"><a class="turdball" style="text-decoration: none;" href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">
	<strong>&nbsp;&nbsp;'.UsernameColor($whosbeen['username']).'<br />&nbsp;&nbsp;<a style="text-decoration: none;" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'"><font size="5" color="orange"><i class="bi bi-envelope"></i><font color="gold" size="5"><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i></font></font>
	
	<br />
	&nbsp;&nbsp;<font size="5" color="gold"><i class="bi bi-arrow-up-short"></i></font><font class="gensmall">SEND PM </font></span>
	</a></td>';
	$row3 .= '<td align="center"><div align="top" style="padding-left:10px;">'.get_titanium_timeago($whosbeen['last_visit']).'</div>';
    $row3 .= '</td>';
    $row3 .= '</tr>'; 
	
   

endwhile;
    $row3 .= '</table>';

$row3 .= '</td>';
		$row3 .= '</tr>';
	$row3 .= '</table>';
$row3 .= '</div>';

$row4_result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_users_who_been` as whb, `".USERS_TABLE."` as u WHERE whb.username = u.username AND whb.username != '".$userinfo['username']."' ORDER BY `last_visit` DESC LIMIT 9, ".$z."");

$row4   = '<div align="center">';
$row4  .= '<table bgcolor="'.$bgcolor4.'" border="0" width="200">';
$row4  .= '<tr>';
$row4  .= '<td align="center">';

$row4  .= '<table bgcolor="'.$bgcolor4.'" border="1" cellpadding="0" cellspacing="1" class="visitorlog">';

while($whosbeen = $titanium_db->sql_fetchrow($row4_result)):

	if(!is_admin())
	if($whosbeen['user_allow_viewonline'] == 0):
	$whosbeen['username'] = 'Ghost Mode';
	$whosbeen['user_avatar'] = 'invisible.png';
	$whosbeen['user_id'] = -1;
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
		$avatar = '<td width="45px">'.( $phpbb2_board_config['allow_avatar_upload'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_path'] . '/' . $whosbeen['user_avatar'] . '" alt="" border="0" /></div></td>' : '</td>';
		break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
		$avatar = '<td width="45px"><div align="center">'.'<img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;"  src="'.avatar_resize($whosbeen['user_avatar']).'" alt="" border="0" /></div></td>';
		break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
		$avatar = '<td width="45px">'. ( $phpbb2_board_config['allow_avatar_local'] ) 
		? '<div align="center"><img class="visitors rounded-corners-last-vistors" style="max-height: '.$max_height.'px; max-width: '.$max_width.'px;" src="' . $phpbb2_board_config['avatar_gallery_path'] . '/' . (($whosbeen['user_avatar'] == 'blank.gif' || $whosbeen['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $whosbeen['user_avatar']) . '" alt="" border="0" /></td>' : '</div></td>';
		break;

	   }
	}
	
	
	$row4 .= '<td align="center" width="45px"><a href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">'.$avatar.'</a></td>';
    $row4 .= '<td align="left"><a class="turdball" style="text-decoration: none;" href="modules.php?name=Profile&mode=viewprofile&u='.$whosbeen['user_id'].'">
	<strong>&nbsp;&nbsp;'.UsernameColor($whosbeen['username']).'<br />&nbsp;&nbsp;<a style="text-decoration: none;" href="modules.php?name=Private_Messages&mode=post&u='.$whosbeen['user_id'].'"><font size="5" color="orange"><i class="bi bi-envelope"></i><font color="gold" size="5"><i class="bi bi-arrow-right-short"></i><i class="bi bi-mailbox"></i></font></font>
	
	<br />
	&nbsp;&nbsp;<font size="5" color="gold"><i class="bi bi-arrow-up-short"></i></font><font class="gensmall">SEND PM </font></span>
	</a></td>';
	$row4 .= '<td align="center"><div align="top" style="padding-left:10px;">'.get_titanium_timeago($whosbeen['last_visit']).'</div>';
    $row4 .= '</td>';
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
$content .= '<table bgcolor="'.$bgcolor4.'" border="1" width="100%">';
$content .= '	<tr>';
$content .= '		<td width="251" valign="top">'.$row1.'</td>';
$content .= '		<td width="251" valign="top">'.$row2.'</td>';
$content .= '		<td width="251" valign="top">'.$row3.'</td>';
$content .= '	</tr>';

$content .= '	<tr>';
$content .= '		<td width="251" valign="top">&nbsp;</td>';
$content .= '		<td width="251" valign="top">&nbsp;</td>';
$content .= '		<td width="251" valign="top">&nbsp;</td>';
$content .= '	</tr>';
$content .= '</table>';
endif;

if($screen_width >= 1920):
$content .= '<table bgcolor="'.$bgcolor4.'" border="1" width="100%">';
$content .= '	<tr>';
$content .= '		<td width="25%" valign="top">'.$row1.'</td>';
$content .= '		<td width="25%" valign="top">'.$row2.'</td>';
$content .= '		<td width="25%" valign="top">'.$row3.'</td>';
$content .= '		<td width="25%" valign="top">'.$row4.'</td>';
$content .= '	</tr>';

$content .= '	<tr>';
$content .= '		<td width="251" valign="top">&nbsp;</td>';
$content .= '		<td width="251" valign="top">&nbsp;</td>';
$content .= '		<td width="251" valign="top">&nbsp;</td>';
$content .= '		<td width="251" valign="top">&nbsp;</td>';
$content .= '	</tr>';
$content .= '</table>';
endif;


$content .= '</div>';
?>