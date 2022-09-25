<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                               groupcp.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: groupcp.php,v 1.58.2.23 2005/05/06 20:50:10 acydburn Exp
 *
 *   Modifications made by the Nuke-Evolution Team
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
Advanced Username Color                  v1.0.5       06/11/2005
Group Colors and Ranks                   v1.0.0       08/24/2005
Remote Avatar Resize                     v2.0.0       11/19/2005
Online/Offline/Hidden                    v2.2.7       01/24/2006
Auto Group                               v1.2.2       11/06/2006
************************************************************************/
if(!defined('NUKE_EVO')) exit;

$titanium_module_name = basename(dirname(__FILE__));
require(NUKE_FORUMS_DIR . 'nukebb.php');
define('IN_PHPBB2', true);
include(NUKE_FORUMS_DIR . 'extension.inc');
include(NUKE_FORUMS_DIR . 'common.php');

/*****[BEGIN]******************************************
[ Mod:    Online/Offline/Hidden               v2.2.7 ]
******************************************************/
function generate_user_info(&$row, 
                     $date_format, 
					   $group_mod, 
					       &$from, 
						  &$phpbb2_posts, 
						 &$joined, 
				  &$phpbb2_poster_avatar, 
				    &$profile_img, 
					    &$profile, 
					 &$search_img, 
					     &$search, 
						 &$pm_img, 
						     &$pm, 
					  &$email_img, 
					      &$email, 
						&$www_img, 
						    &$www, 
					   &$userdata, 
			  &$online_status_img, 
			      &$online_status)
{
    global $titanium_lang, $theme_name, $images, $phpbb2_board_config, $online_color, $offline_color, $hidden_color;
    
    $titanium_username = $row['username'];
	$from = $row['user_from'].'&nbsp;';
    $joined = create_date($date_format, $row['user_regdate'], $phpbb2_board_config['board_timezone']);
    $phpbb2_posts = ($row['user_posts']) ? $row['user_posts'] : 0;
    
        # Mod: Forum Index Avatar Mod v3.0.0 START
        switch($row['user_avatar_type'])
        {
           case USER_AVATAR_UPLOAD:
           $phpbb2_poster_avatar = $phpbb2_board_config['avatar_path'] . '/' . $row['user_avatar'];
           break;
           case USER_AVATAR_REMOTE:
           $phpbb2_poster_avatar = resize_avatar($row['user_avatar']);
           break;
           case USER_AVATAR_GALLERY:
           $phpbb2_poster_avatar = $phpbb2_board_config['avatar_gallery_path'] . '/' . (($row['user_avatar'] 
			== 'blank.gif' || $row['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $row['user_avatar']);
           break;
		}
        # Mod: Forum Index Avatar Mod v3.0.0 END

	if(!empty($row['user_viewemail']) || $group_mod): 
        $email_uri = ($phpbb2_board_config['board_email_form']) ? append_titanium_sid("profile.$phpEx?mode=email&amp;".POST_USERS_URL.'='.$row['user_id']) : 'mailto:'.$row['user_email'];
		$email_img = '<a href="'.$email_uri.'"><img 
		class="tooltip-html copyright" title="Send an e-mail message to '.$titanium_username.'" src="'.$images['icon_email'].'" alt="'.sprintf($titanium_lang['Send_email'],$row['username']).'" 
		title="'.sprintf($titanium_lang['Send_email'],$row['username']).'" border="0" /></a>';
		$email = '<a href="'.$email_uri.'">'.$titanium_lang['Send_email'].'</a>';
	else: 
        $email_img = '&nbsp;';
        $email     = '&nbsp;';
    endif;
    
    $temp_url = "modules.php?name=Profile&amp;mode=viewprofile&amp;".POST_USERS_URL."=".$row['user_id'];
    $profile_img = '<a href="'.$temp_url.'"><img src="'.$images['icon_profile'].'" alt="'.$titanium_lang['Read_profile'].'" title="'.$titanium_lang['Read_profile'].'" border="0" /></a>';
    $profile = '<a href="'.$temp_url.'">'.$titanium_lang['Read_profile'].'</a>';
    
    $temp_url = "modules.php?name=Private_Messages&amp;mode=post&amp;".POST_USERS_URL."=".$row['user_id'];
    $pm_img = '<a href="'.$temp_url.'"><img class="tooltip-html copyright" title="Send a Private Message to '.$titanium_username.'" 
	src="'.$images['icon_pm'].'" alt="'.sprintf($titanium_lang['Send_private_message'],$row['username']).'" 
	title="'.sprintf($titanium_lang['Send_private_message'],$row['username']).'" border="0" /></a>';
	$pm = '<a href="'.$temp_url.'">'.$titanium_lang['Send_private_message'].'</a>';
    
	$www_img = ($row['user_website']) ? '<a href="'.$row['user_website'].'" target="_userwww"><img 
	class="tooltip-html copyright" title="Visit '.$titanium_username.'\'s Personal Portal or Website" src="'.$images['icon_www'].'" alt="'.$titanium_lang['Visit_website'].'" 
	title="'.$titanium_lang['Visit_website'].'" border="0" /></a>' : '';
    $www = ($row['user_website']) ? '<a href="'.$row['user_website'].'" target="_userwww">'.$titanium_lang['Visit_website'].'</a>' : '';
    
    $temp_url = append_titanium_sid("search.$phpEx?search_author=".urlencode($row['username'])."&amp;showresults=posts");
    $search_img = '<a href="'.$temp_url.'"><img src="'.$images['icon_search'].'" alt="'.sprintf($titanium_lang['Search_user_posts'], $row['username']).'" 
	title="'.sprintf($titanium_lang['Search_user_posts'], $row['username']).'" border="0" /></a>';
    $search = '<a href="'.$temp_url.'">'.sprintf($titanium_lang['Search_user_posts'], $row['username']).'</a>';
 
       # Mod: Online/Offline/Hidden v3.0.0 START
       if($row['user_session_time'] >= (time()-$phpbb2_board_config['online_time'])):
         $theme_name = get_theme();
		 
	     if(!$row['user_allow_viewonline']):
		 $online_status = '<img class="tooltip-html copyright" title="'.$row['username'].' is Hidden" alt="offline" 
		 width="30" height="30" src="themes/'.$theme_name.'/forums/images/status/icons8-invisible-512.png" />';
	     $online_status_img = $online_status; 
		 else:
		 $online_status = '<a href="'.append_titanium_sid("viewonline.php").'" '
		 .$online_color.'><img class="tooltip-html copyright" title="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['username']
		 .' is Currently Online<br /> CLICK TO VIEW ONLINE USER LIST!" alt="online" src="themes/'.$theme_name.'/forums/images/status/online_bgcolor_one.gif" /></a>';
		 $online_status_img = $online_status;
		 endif;

       else:
       
	   $online_status = '<img class="tooltip-html copyright" 
	   title="'.$row['username'].' is Offline"alt="offline" src="themes/'.$theme_name.'/forums/images/status/offline_bgcolor_one.gif" /></span>';
	   $online_status_img = $online_status; 

	     if(!$row['user_allow_viewonline']):
		 $online_status = '<img class="tooltip-html copyright" title="'.$row['username'].' is Hidden" alt="offline" 
		 width="30" height="30" src="themes/'.$theme_name.'/forums/images/status/icons8-invisible-512.png" />';
	     $online_status_img = $online_status;
		 endif; 
       
	   endif;
       # Mod: Online/Offline/Hidden v3.0.0 END
    
	return;
}

global $cache;

# Start session management
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_GROUPCP);
titanium_init_userprefs($userdata);
# End session management

$script_name = 'modules.php?name=' . $titanium_module_name;
$server_name = trim($phpbb2_board_config['server_name']);
$server_protocol = ($phpbb2_board_config['cookie_secure']) ? 'https://' : 'http://';
$server_port = ($phpbb2_board_config['server_port'] <> 80) ? ':' . trim($phpbb2_board_config['server_port']) . '/' : '/';
$server_url = $server_protocol . $server_name . $server_port . $script_name;

if(isset($_GET[POST_GROUPS_URL]) || isset($_POST[POST_GROUPS_URL])) 
$group_id = (isset($_POST[POST_GROUPS_URL])) ? intval($_POST[POST_GROUPS_URL]) : intval($_GET[POST_GROUPS_URL]);
else 
$group_id = '';

if(isset($_POST['mode']) || isset($_GET['mode'])): 
$mode = (isset($_POST['mode'])) ? $_POST['mode'] : $_GET['mode'];
  if (is_string($mode)): 
    $mode = htmlspecialchars($mode);
  endif;
else: 
$mode = '';
endif;

$confirm = (isset($_POST['confirm'])) ? TRUE : 0;
$cancel = (isset($_POST['cancel'])) ? TRUE : 0;
$sid = (isset($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : '';
$phpbb2_start = (isset($_GET['start'])) ? intval($_GET['start']) : 0;
$phpbb2_start = ($phpbb2_start < 0) ? 0 : $phpbb2_start;
$is_moderator = FALSE;

if(isset($_POST['groupstatus']) && $group_id) 
{
    if(!is_user()) 
    redirect_titanium(append_titanium_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));
    
    $sql = "SELECT group_moderator FROM ".GROUPS_TABLE." WHERE group_id = '$group_id'";
    
	if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
    
    $row = $titanium_db->sql_fetchrow($result);
    
	if($row['group_moderator'] != $userdata['user_id'] && $userdata['user_level'] != ADMIN): 
        $phpbb2_template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("index.$phpEx").'">'
        ));
    $message = $titanium_lang['Not_group_moderator'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id")
	.'">', '</a>').'<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
    endif;
    
    $sql = "UPDATE ".GROUPS_TABLE." SET group_type = ".intval($_POST['group_type'])." WHERE group_id = '$group_id'";
	if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
    
    $phpbb2_template->assign_vars(array(
        'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id").'">'
    ));
    
    $message = $titanium_lang['Group_type_updated'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id").'">', '</a>')
	.'<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
} 
elseif(isset($_POST['joingroup']) && $group_id) 
{
    
  # First, joining a group
  # If the user isn't logged in redirect them to login
  if (!is_user() || !$userdata['session_logged_in']) 
  redirect_titanium(append_titanium_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));
  elseif($sid !== $userdata['session_id']) 
  message_die(GENERAL_ERROR, $titanium_lang['Session_invalid']);
    
  $sql = "SELECT ug.user_id, 
               g.group_type, 
			    group_count, 
			group_count_max 
  FROM (".USER_GROUP_TABLE." ug, ".GROUPS_TABLE." g) 
  WHERE g.group_id = '$group_id' 
  AND ( g.group_type <> ".GROUP_HIDDEN." 
  OR (g.group_count <= '".$userdata['user_posts']."' 
  AND g.group_count_max > '".$userdata['user_posts']."')) 
  AND ug.group_id = g.group_id";
    
  if (!($result = $titanium_db->sql_query($sql))) 
  message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);

    # Mod: Auto Group v1.2.2 START
    if($row = $titanium_db->sql_fetchrow($result)): 
      $is_autogroup_enable = ($row['group_count'] <= $userdata['user_posts'] && $row['group_count_max'] > $userdata['user_posts']) ? true : false;
      if ($row['group_type'] == GROUP_OPEN || $is_autogroup_enable): 
    # Mod: Auto Group v1.2.2 END
            do 
			{
                if ($userdata['user_id'] == $row['user_id']): 
                    $phpbb2_template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url=' . append_titanium_sid("index.$phpEx") . '">'
                    ));
                    
					$message = $titanium_lang['Already_member_group'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?"
					.POST_GROUPS_URL."=$group_id").'">', '</a>').'<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');
                    
					message_die(GENERAL_MESSAGE, $message);
                endif;
            } 
			while ($row = $titanium_db->sql_fetchrow($result));
        
	   else: 
            $phpbb2_template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("index.$phpEx").'">'
            ));
            
            $message = $titanium_lang['This_closed_group'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id").'">', '</a>')
			.'<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
       endif;
     
	else: 
        message_die(GENERAL_MESSAGE, $titanium_lang['No_groups_exist']);
    endif;
    
    $sql = "INSERT INTO ".USER_GROUP_TABLE." (group_id, user_id, user_pending) VALUES ('$group_id', ".$userdata['user_id'].",'".(($is_autogroup_enable) ? 0 : 1)."')";
    
	if (!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, "Error inserting user group subscription", "", __LINE__, __FILE__, $sql);
    
    $sql = "SELECT u.user_email, u.username, u.user_lang, g.group_name FROM (".USERS_TABLE." u, ".GROUPS_TABLE." g) WHERE u.user_id = g.group_moderator AND g.group_id = '$group_id'";
    
	if (!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, "Error getting group moderator data", "", __LINE__, __FILE__, $sql);

    $moderator = $titanium_db->sql_fetchrow($result);

    # Mod: Auto Group v1.2.2 START
    if (!$is_autogroup_enable): 
	
    # Mod: Auto Group v1.2.2 END
      $content = str_replace('{SITENAME}', $phpbb2_board_config['sitename'], $titanium_lang['group_request_template'] );
      $content = str_replace('{GROUP_MODERATOR}', $moderator['username'], $content );
      $content = str_replace('{EMAIL_SIG}', ((!empty($phpbb2_board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $phpbb2_board_config['board_email_sig']) : ''), $content );
      
	  $content = str_replace('{U_GROUPCP}', '<a href="'.$server_url.'&'.POST_GROUPS_URL.'='.$group_id.'&validate=true">'.$server_url.'&'.POST_GROUPS_URL.'='
	  .$group_id.'&validate=true</a>', $content );
      
	  $subject = $titanium_lang['Group_request'];
      
	  $headers = array('Content-Type: text/html; charset=UTF-8', 'From: '.$phpbb2_board_config['board_email'], 'Reply-To: '.$phpbb2_board_config['board_email'], 'Return-Path: '.
	  $phpbb2_board_config['board_email']);
      
	  evo_phpmailer( $moderator['user_email'], $subject, $content, $headers );
    endif;
    
    $phpbb2_template->assign_vars(array(
        'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("index.$phpEx").'">'
    ));
    
    $message = ($is_autogroup_enable) ? $titanium_lang['Group_added'] : $titanium_lang['Group_joined'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?". 
	POST_GROUPS_URL."=$group_id").'">', '</a>').'<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
} 
elseif(isset($_POST['unsub']) || isset($_POST['unsubpending']) && $group_id) 
{
    # Second, unsubscribing from a group
    # Check for confirmation of unsub.
    if($cancel) 
    redirect_titanium(append_titanium_sid("groupcp.$phpEx", true));
	elseif(!is_user() || !$userdata['session_logged_in']) 
    redirect_titanium('modules.php?name=Your_Account&amp;redirect=groupcp.php&amp;'.POST_GROUPS_URL.'='.$group_id);
	elseif ($sid !== $userdata['session_id']) 
    message_die(GENERAL_ERROR, $titanium_lang['Session_invalid']);
    
    if($confirm): 
	
        # Mod: Group Colors and Ranks v1.0.0 START
        $sql = "UPDATE ".USERS_TABLE." SET user_color_gc = '', user_color_gi  = '', user_rank = 0 WHERE user_id = ".$userdata['user_id'];
    
	    if(!$titanium_db->sql_query($sql)) 
        message_die(GENERAL_ERROR, 'Could not remove color from user', '', __LINE__, __FILE__, $sql);

        # Base: Caching System v3.0.0 START
        $cache->delete('UserColors', 'config');
        # Base: Caching System v3.0.0 END
		
        # Mod: Group Colors and Ranks v1.0.0 END
        
        $sql = "DELETE FROM ".USER_GROUP_TABLE." WHERE user_id = ".$userdata['user_id']." AND group_id = '$group_id'";
        
		if(!($result = $titanium_db->sql_query($sql))) 
        message_die(GENERAL_ERROR, 'Could not delete group memebership data', '', __LINE__, __FILE__, $sql);
        
        if($userdata['user_level'] != ADMIN && $userdata['user_level'] == MOD): 
            $sql = "SELECT COUNT(auth_mod) AS is_auth_mod FROM (".AUTH_ACCESS_TABLE." aa, ".USER_GROUP_TABLE." ug) 
		    WHERE ug.user_id = ".$userdata['user_id']." 
		    AND aa.group_id = ug.group_id AND aa.auth_mod = '1'";
        
		    if(!($result = $titanium_db->sql_query($sql))) 
            message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
            
            if(!($row = $titanium_db->sql_fetchrow($result)) || $row['is_auth_mod'] == 0): 
                $sql = "UPDATE ".USERS_TABLE." SET user_level = ".USER." WHERE user_id = ".$userdata['user_id'];
                if (!($result = $titanium_db->sql_query($sql))) 
                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
            endif;
        endif;
        
        $phpbb2_template->assign_vars(array(
            'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("index.$phpEx").'">'
        ));
        
        $message = $titanium_lang['Unsub_success'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id") 
		.'">', '</a>').'<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
     
	else: 
	
        $unsub_msg = (isset($_POST['unsub'])) ? $titanium_lang['Confirm_unsub'] : $titanium_lang['Confirm_unsub_pending'];
        
        $s_hidden_fields = '<input type="hidden" name="'.POST_GROUPS_URL.'" value="'.$group_id.'" /><input type="hidden" name="unsub" value="1" />';
        $s_hidden_fields .= '<input type="hidden" name="sid" value="'.$userdata['session_id'].'" />';
        
        $phpbb2_page_title = $titanium_lang['Group_Control_Panel'];
        include(NUKE_INCLUDE_DIR.'page_header.'.$phpEx);
        
        $phpbb2_template->set_filenames(array(
            'confirm' => 'confirm_body.tpl'
        ));
        
        $phpbb2_template->assign_vars(array(
            'MESSAGE_TITLE' => $titanium_lang['Confirm'],
            'MESSAGE_TEXT' => $unsub_msg,
            'L_YES' => $titanium_lang['Yes'],
            'L_NO' => $titanium_lang['No'],
            'S_CONFIRM_ACTION' => append_titanium_sid("groupcp.$phpEx"),
            'S_HIDDEN_FIELDS' => $s_hidden_fields
        ));
        
        $phpbb2_template->pparse('confirm');
        include(NUKE_INCLUDE_DIR . 'page_tail.' . $phpEx);
    endif;
    
} 
elseif($group_id) 
{
    # Did the group moderator get here through an email?
    # If so, check to see if they are logged in.
    if(isset($_GET['validate'])): 
        if(!is_user()): 
          redirect_titanium(append_titanium_sid("login.$phpEx?redirect=groupcp.$phpEx&".POST_GROUPS_URL."=$group_id", true));
          exit;
        endif;
    endif;
    
    # For security, get the ID of the group moderator.
    $sql = "SELECT g.group_moderator, 
	                    g.group_type, 
						 aa.auth_mod 
			
			FROM (".GROUPS_TABLE." g 
			LEFT JOIN ".AUTH_ACCESS_TABLE." aa 
			ON aa.group_id = g.group_id) 
			WHERE g.group_id = '$group_id'";
    
	if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Could not get moderator information', '', __LINE__, __FILE__, $sql);
    
    if($group_info = $titanium_db->sql_fetchrow($result)): 
        $group_moderator = $group_info['group_moderator'];
        
        if($group_moderator == $userdata['user_id'] || $userdata['user_level'] == ADMIN) 
        $is_moderator = TRUE;
        
        # Handle Additions, removals, approvals and denials
        if(!empty($_POST['add']) || !empty($_POST['remove']) || isset($_POST['approve']) || isset($_POST['deny'])): 
        
            if(!is_user()) 
            redirect_titanium(append_titanium_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));
            elseif ($sid !== $userdata['session_id']) 
            message_die(GENERAL_ERROR, $titanium_lang['Session_invalid']);
            
            if(!$is_moderator): 
                $phpbb2_template->assign_vars(array(
                    'META' => '<meta http-equiv="refresh" content="3;url=' . append_titanium_sid("index.$phpEx") . '">'
                ));
                
                $message = $titanium_lang['Not_group_moderator'] . '<br /><br />' . sprintf($titanium_lang['Click_return_index'], '<a href="' . append_titanium_sid("index.$phpEx") . '">', '</a>');
                message_die(GENERAL_MESSAGE, $message);
            endif;
            
            if(isset($_POST['add'])): 
            
                $titanium_username = (isset($_POST['username'])) ? phpbb_clean_username($_POST['username']) : '';
                $sql = "SELECT user_id, 
				            user_email, 
							user_lang, 
						   user_level 
						
						FROM ".USERS_TABLE." 
						WHERE username = '".str_replace("\'", "''", $titanium_username) . "'";
                
				if(!($result = $titanium_db->sql_query($sql))) 
                message_die(GENERAL_ERROR, "Could not get user information", $titanium_lang['Error'], __LINE__, __FILE__, $sql);
                
                if(!($row = $titanium_db->sql_fetchrow($result))): 
                  $phpbb2_template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id").'">'
                    ));
                    
                  $message = $titanium_lang['Could_not_add_user']."<br /><br />".sprintf($titanium_lang['Click_return_group'], "<a href=\"".append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL 
				  ."=$group_id")."\">", "</a>")."<br /><br />".sprintf($titanium_lang['Click_return_index'], "<a href=\"".append_titanium_sid("index.$phpEx")."\">", "</a>");
                  
				  message_die(GENERAL_MESSAGE, $message);
                endif;
                
                if($row['user_id'] == ANONYMOUS): 
                    $phpbb2_template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id").'">'
                    ));
                    
                    $message = $titanium_lang['Could_not_anon_user'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id") 
					.'">', '</a>').'<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');                    
                    message_die(GENERAL_MESSAGE, $message);
                endif;
                
                $sql = "SELECT ug.user_id, 
				             u.user_level 
					    
						FROM (".USER_GROUP_TABLE." ug, ".USERS_TABLE." u) 
						WHERE u.user_id = ".$row['user_id']." 
						AND ug.user_id = u.user_id 
						AND ug.group_id = '$group_id'";
						
                if(!($result = $titanium_db->sql_query($sql))) 
                message_die(GENERAL_ERROR, 'Could not get user information', '', __LINE__, __FILE__, $sql);
                
                if(!($titanium_db->sql_fetchrow($result))): 
                    $sql = "INSERT INTO ".USER_GROUP_TABLE." (user_id, group_id, user_pending) VALUES (".$row['user_id'].", '$group_id', '0')";
                    if(!$titanium_db->sql_query($sql)) 
                    message_die(GENERAL_ERROR, 'Could not add user to group', '', __LINE__, __FILE__, $sql);

                    if($row['user_level'] != ADMIN && $row['user_level'] != MOD && $group_info['auth_mod']): 
                      $sql = "UPDATE ".USERS_TABLE." SET user_level = ".MOD." WHERE user_id = ".$row['user_id'];
                      if(!$titanium_db->sql_query($sql)) 
                      message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                    endif;
                    
                    # Get the group name
                    # Email the user and tell them they're in the group
                    $group_sql = "SELECT group_name FROM ".GROUPS_TABLE." WHERE group_id = '$group_id'";
                    if(!($result = $titanium_db->sql_query($group_sql))) 
                    message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
                    
                    $group_name_row = $titanium_db->sql_fetchrow($result);                    
                    $group_name = $group_name_row['group_name'];
                    
                    # Mod: Group Colors and Ranks v1.0.0 START
                    add_group_attributes($row['user_id'], $group_id);
                    # Mod: Group Colors and Ranks v1.0.0 END

                    $subject = $titanium_lang['Group_added'];
                    $content = str_replace('{SITENAME}', $phpbb2_board_config['sitename'], $titanium_lang['group_added_template'] );
                    $content = str_replace('{GROUP_NAME}', $group_name, $content );
                    
					$content = str_replace('{EMAIL_SIG}', ((!empty($phpbb2_board_config['board_email_sig'])) 
					? str_replace('<br />', "\n", "-- \n" . $phpbb2_board_config['board_email_sig']) : ''), $content );
                    
					$content = str_replace('{U_GROUPCP}', '<a href="'.$server_url.'&'.POST_GROUPS_URL.'='.$group_id.'">'.$server_url.'&'.POST_GROUPS_URL.'='.
					$group_id.'</a>', $content );
                    
					$headers = array('Content-Type: text/html; charset=UTF-8', 'From: '.$phpbb2_board_config['board_email'], 'Reply-To: '.$phpbb2_board_config['board_email'], 'Return-Path: '
					.$phpbb2_board_config['board_email']);
                    evo_phpmailer($row['user_email'],$subject,$content,$headers);
                 
                else: 
                    $phpbb2_template->assign_vars(array(
                        'META' => '<meta http-equiv="refresh" content="3;url='.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id").'">'
                    ));
                    
                    $message = $titanium_lang['User_is_member_group'].'<br /><br />'.sprintf($titanium_lang['Click_return_group'], '<a href="'.append_titanium_sid("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id") 
					.'">', '</a>'). '<br /><br />'.sprintf($titanium_lang['Click_return_index'], '<a href="'.append_titanium_sid("index.$phpEx").'">', '</a>');
                    
                    message_die(GENERAL_MESSAGE, $message);
                endif;
             
            else: 
            
                 if(((isset($_POST['approve']) || isset($_POST['deny'])) && isset($_POST['pending_members'])) || (isset($_POST['remove']) && isset($_POST['members']))): 
                                    
                    $members = (isset($_POST['approve']) || isset($_POST['deny'])) ? $_POST['pending_members'] : $_POST['members'];                    
                    $sql_in = '';
                  
				    for ($i = 0; $i < count($members); $i++): 
                        $sql_in .= (($sql_in != '') ? ', ' : '') . intval($members[$i]);
                    endfor;
                    
                    if(isset($_POST['approve'])): 
                    
                        if($group_info['auth_mod']): 
                            $sql = "UPDATE ".USERS_TABLE." SET user_level = ".MOD." WHERE user_id IN ($sql_in) AND user_level NOT IN (".MOD.", ".ADMIN.")";                            
                            if (!$titanium_db->sql_query($sql)) 
                                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                        endif;

                        # Mod: Group Colors and Ranks v1.0.0 START
                        global $titanium_prefix;
                        $sql_color = "SELECT group_color FROM " . GROUPS_TABLE . " WHERE group_id = '$group_id'";
                        if (!$result_color = $titanium_db->sql_query($sql_color)) 
                        message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);

                        $row_color = $titanium_db->sql_fetchrow($result_color);
                        $titanium_db->sql_freeresult($result_color);
                        $phpbb2_color = $row_color['group_color'];
                        
						if($phpbb2_color): 
                            $sql_color = "SELECT group_color, group_id FROM ".$titanium_prefix."_bbadvanced_username_color WHERE group_id = '$phpbb2_color'";
                            if (!$result_color = $titanium_db->sql_query($sql_color)) 
                                message_die(GENERAL_ERROR, 'Could not gather group color', '', __LINE__, __FILE__, $sql);
                            $row_color = $titanium_db->sql_fetchrow($result_color);
                            $titanium_db->sql_freeresult($result_color);
                        endif;

                        $sql_rank = "SELECT group_rank FROM ".GROUPS_TABLE." WHERE group_id = '$group_id'";
                        if (!$result_rank = $titanium_db->sql_query($sql_rank)) 
                        message_die(GENERAL_ERROR, 'Could not gather group rank', '', __LINE__, __FILE__, $sql);

                        $row_rank = $titanium_db->sql_fetchrow($result_rank);
                        $titanium_db->sql_freeresult($result_rank);
                        if ($row_rank['group_rank'] && !$row_color['group_color']) 
                        $sql = "user_rank = '".$row_rank['group_rank']."'";
                        elseif ($row_color["group_color"] && !$row_rank['group_rank']) 
                        $sql = "user_color_gc = '".$row_color["group_color"]."', user_color_gi  = '--".$row_color["group_id"]."--'";
                        elseif ($row_color['group_color'] && $row_rank['group_rank']) 
                        $sql = "user_rank = '".$row_rank['group_rank']."', user_color_gc = '".$row_color["group_color"]."', user_color_gi  = '--".$row_color["group_id"]."--'";
                        else 
                        $sql = "";
                        
                        if($sql): 
                            $sql = "UPDATE ".USERS_TABLE." 
							        SET ".$sql." 
									WHERE user_id 
									IN ($sql_in)";
									
                            if (!$titanium_db->sql_query($sql)) 
                            message_die(GENERAL_ERROR, 'Could not add color to user', '', __LINE__, __FILE__, $sql);
                            # Base: Caching System v3.0.0 START
                            $cache->delete('UserColors', 'config');
                            # Base: Caching System v3.0.0 END
                        endif;
						
                        # Mod: Group Colors and Ranks v1.0.0 END
                        
                        $sql = "UPDATE ".USER_GROUP_TABLE." SET user_pending = 0 WHERE user_id IN ($sql_in) AND group_id = '$group_id'";
                        $sql_select = "SELECT user_email FROM ".USERS_TABLE." WHERE user_id IN ($sql_in)";
                     
                 elseif(isset($_POST['deny']) || isset($_POST['remove'])): 
                        if($group_info['auth_mod']): 
                            $sql = "SELECT ug.user_id, 
							              ug.group_id
                                    
									FROM (" . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug)
                                    WHERE ug.user_id IN  ($sql_in)
                                    AND aa.group_id = ug.group_id
                                    AND aa.auth_mod = '1'
                                    GROUP BY ug.user_id, ug.group_id
                                    ORDER BY ug.user_id, ug.group_id";
                            
							if (!($result = $titanium_db->sql_query($sql))) 
                            message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
                            
                            if ($row = $titanium_db->sql_fetchrow($result)): 
                                $group_check = array();
                                $remove_mod_sql = '';
                                
                                do 
                                {
                                  $group_check[$row['user_id']][] = $row['group_id'];
                                } 
								while($row = $titanium_db->sql_fetchrow($result));
                                
                                while(list($titanium_user_id, $group_list) = @each($group_check)): 
                                    if (count($group_list) == 1) 
                                    $remove_mod_sql .= (($remove_mod_sql != '') ? ', ' : '') . $titanium_user_id;
                                endwhile;
                                
                                if($remove_mod_sql != ''): 
                                    $sql = "UPDATE ".USERS_TABLE." 
									        SET user_level = ".USER." 
											WHERE user_id 
											IN ($remove_mod_sql) 
											AND user_level 
											NOT IN (".ADMIN.")";
											
                                    if (!$titanium_db->sql_query($sql)) 
                                    message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                                endif;
                            endif;
                        endif;

                        # Mod: Group Colors and Ranks v1.0.0 START
                        $sql = "UPDATE ".USERS_TABLE." SET user_color_gc = '', user_color_gi  = '', user_rank = 0 WHERE user_id IN ($sql_in)";
                        if (!$titanium_db->sql_query($sql)) 
                        message_die(GENERAL_ERROR, 'Could not remove color from user', '', __LINE__, __FILE__, $sql);
                        # Base: Caching System v3.0.0 START
                        $cache->delete('UserColors', 'config');
                        # Base: Caching System v3.0.0 END
                        # Mod: Group Colors and Ranks v1.0.0 END
                        
                        $sql = "DELETE FROM ".USER_GROUP_TABLE." 
						        WHERE user_id 
								IN ($sql_in) 
								AND group_id = '$group_id'";
                    endif;
                    
                    if (!$titanium_db->sql_query($sql)) 
                    message_die(GENERAL_ERROR, 'Could not update user group table', '', __LINE__, __FILE__, $sql);
                    
                    # Email users when they are approved
                    if(isset($_POST['approve'])): 
                        if(!($result = $titanium_db->sql_query($sql_select))) 
                        message_die(GENERAL_ERROR, 'Could not get user email information', '', __LINE__, __FILE__, $sql);
                        
                        $bcc_list = array();
                        
						while($row = $titanium_db->sql_fetchrow($result)): 
                            $bcc_list[] = $row['user_email'];
                        endwhile;
                        
                        # Get the group name
                        $group_sql = "SELECT group_name 
						              FROM ".GROUPS_TABLE." 
									  WHERE group_id = '$group_id'";
									  
                        if(!($result = $titanium_db->sql_query($group_sql))) 
                        message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
                                                
                        $group_name_row = $titanium_db->sql_fetchrow($result);
                        $group_name = $group_name_row['group_name'];
                        $content = str_replace('{SITENAME}', $phpbb2_board_config['sitename'], $titanium_lang['group_approved_template'] );
                        $content = str_replace('{GROUP_NAME}', $group_name, $content );
                        
						$content = str_replace('{EMAIL_SIG}', ((!empty($phpbb2_board_config['board_email_sig'])) 
						? str_replace('<br />', "\n", "-- \n".$phpbb2_board_config['board_email_sig']) : ''), $content );
                        
						$content = str_replace('{U_GROUPCP}', '<a href="'.$server_url.'&'.POST_GROUPS_URL.'='.$group_id.'">'.$server_url.'&'.
						POST_GROUPS_URL.'='.$group_id.'</a>', $content );
                        
						$subject = $titanium_lang['Group_approved'];
						
                        for($i = 0; $i < count($bcc_list); $i++):
                            $headers[] = 'From: '.$phpbb2_board_config['board_email'];
                            for ($i = 0; $i < count($bcc_list); $i++):
                                $headers[] = 'Bcc: '.$bcc_list[$i];
                                $addbcc[] = $bcc_list[$i];
                            endfor;
                            $headers[] = 'Content-Type: text/html; charset=UTF-8';
                            $headers[] = 'Reply-To: '.$phpbb2_board_config['board_email'];
                            $headers[] = 'Return-Path: '.$phpbb2_board_config['board_email'];
                            evo_phpmailer( $addbcc, $subject, $content, $headers );
                        endfor;
                    endif;
                endif;
            endif;
        endif;
        # END approve or deny
        
	else: 
        message_die(GENERAL_MESSAGE, $titanium_lang['No_groups_exist']);
    endif;
    
    # Get group details
    $sql = "SELECT * FROM ".GROUPS_TABLE." WHERE group_id = '$group_id' AND group_single_user = '0'";
    if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
    
    if(!($group_info = $titanium_db->sql_fetchrow($result))) 
    message_die(GENERAL_MESSAGE, $titanium_lang['Group_not_exist']);
    
    # Get moderator details for this group
    # Mod: Online/Offline/Hidden v3.0.0 START
    $sql = "SELECT username, 
	                user_id, 
			 user_viewemail, 
			     user_posts, 
			   user_regdate, 
			      user_from,
			 user_from_flag, 
			   user_website,
                user_avatar, 
	       user_avatar_type, 
	       user_allowavatar, 			    
			     user_email, 
	  user_allow_viewonline, 
	      user_session_time
           FROM ".USERS_TABLE."
           WHERE user_id = ".$group_info['group_moderator'];
    # Mod: Online/Offline/Hidden v3.0.0 END
	
    if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Error getting user list for group', '', __LINE__, __FILE__, $sql);

    $group_moderator = $titanium_db->sql_fetchrow($result);
    
    if(!$group_moderator) 
    message_die(GENERAL_ERROR, 'Error getting moderator for group');
    
    # Get user information for this group
    # Mod: Online/Offline/Hidden v2.2.7 START
    $sql = "SELECT u.username, 
	                u.user_id, 
			 u.user_viewemail, 
			     u.user_posts, 
			   u.user_regdate, 
			      u.user_from,
			 u.user_from_flag, 
			   u.user_website, 
                u.user_avatar, 
	       u.user_avatar_type, 
	       u.user_allowavatar, 			    
			     u.user_email, 
			  ug.user_pending, 
	  u.user_allow_viewonline, 
	      u.user_session_time
           
		   FROM (".USERS_TABLE." u, ".USER_GROUP_TABLE." ug)
           WHERE ug.group_id = '$group_id'
           AND u.user_id = ug.user_id
           AND ug.user_pending = '0'
           AND ug.user_id <> ".$group_moderator['user_id']."
           ORDER BY u.username";
    # Mod: Online/Offline/Hidden v2.2.7 END

    if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Error getting user list for group', '', __LINE__, __FILE__, $sql);
        
    $group_members = $titanium_db->sql_fetchrowset($result);

    if(is_array($group_members))
    $members_count = count($group_members);
    else
   	$members_count = 0;
    $titanium_db->sql_freeresult($result);

    # get the information for the users that are pending for a group
    # Mod: Online/Offline/Hidden v3.0.0 START
    $sql = "SELECT u.username, 
	                u.user_id, 
		     u.user_viewemail, 
			     u.user_posts, 
			   u.user_regdate, 
			      u.user_from,
			 u.user_from_flag, 
			   u.user_website,
                u.user_avatar, 
	       u.user_avatar_type, 
	       u.user_allowavatar, 			    
			     u.user_email, 
	  u.user_allow_viewonline, 
	      u.user_session_time
      
	       FROM (".GROUPS_TABLE." g, ".USER_GROUP_TABLE." ug, ".USERS_TABLE." u)
           WHERE ug.group_id = '$group_id'
           AND g.group_id = ug.group_id
           AND ug.user_pending = '1'
           AND u.user_id = ug.user_id
           ORDER BY u.username";
    # Mod: Online/Offline/Hidden v3.0.0 END
    
	if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Error getting user pending information', '', __LINE__, __FILE__, $sql);
    
    $modgroup_pending_list  = $titanium_db->sql_fetchrowset($result);

    if(is_array($modgroup_pending_list))
  	$modgroup_pending_count = count($modgroup_pending_list);
    else
  	$modgroup_pending_count = 0;
    
    $titanium_db->sql_freeresult($result);
    
    $is_group_member = 0;

    if($members_count): 
        for ($i = 0; $i < $members_count; $i++): 
            if ($group_members[$i]['user_id'] == $userdata['user_id'] && is_user()) 
                $is_group_member = TRUE;
        endfor;
    endif;
    
    $is_group_pending_member = 0;
	
    # Mod: Auto Group v1.2.2 START
    $is_autogroup_enable = ($group_info['group_count'] <= $userdata['user_posts'] && $group_info['group_count_max'] > $userdata['user_posts']) ? true : false;
    # Mod: Auto Group v1.2.2 END

    if($modgroup_pending_count): 
        for ($i = 0; $i < $modgroup_pending_count; $i++):
            if($modgroup_pending_list[$i]['user_id'] == $userdata['user_id'] && is_user()) 
                $is_group_pending_member = TRUE;
        endfor;
    endif;
    
    if($userdata['user_level'] == ADMIN) 
    $is_moderator = TRUE;
    
    if($userdata['user_id'] == $group_info['group_moderator']): 
        $is_moderator = TRUE;
        $group_details = $titanium_lang['Are_group_moderator'];
        $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
	elseif($is_group_member || $is_group_pending_member): 
        $phpbb2_template->assign_block_vars('switch_unsubscribe_group_input', array());
        $group_details = ($is_group_pending_member) ? $titanium_lang['Pending_this_group'] : $titanium_lang['Member_this_group'];
        $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
	elseif($userdata['user_id'] == ANONYMOUS): 
        $group_details   = $titanium_lang['Login_to_join'];
        $s_hidden_fields = '';
	else: 
	
        if($group_info['group_type'] == GROUP_OPEN): 
            $phpbb2_template->assign_block_vars('switch_subscribe_group_input', array());
            $group_details   = $titanium_lang['This_open_group'];
            $s_hidden_fields = '<input type="hidden" name="'.POST_GROUPS_URL.'" value="'.$group_id.'"/>';
        
        # Mod: Auto Group v1.2.2 START
        elseif($group_info['group_type'] == GROUP_CLOSED): 
            if($is_autogroup_enable): 
                $phpbb2_template->assign_block_vars('switch_subscribe_group_input', array());
                $group_details   = sprintf($titanium_lang['This_closed_group'], $titanium_lang['Join_auto']);
                $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
			else: 
                $group_details   = sprintf($titanium_lang['This_closed_group'], $titanium_lang['No_more']);
                $s_hidden_fields = '';
            endif;
		elseif($group_info['group_type'] == GROUP_HIDDEN): 
		
            if ($is_autogroup_enable): 
                $phpbb2_template->assign_block_vars('switch_subscribe_group_input', array());
                $group_details   = sprintf($titanium_lang['This_hidden_group'], $titanium_lang['Join_auto']);
                $s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
			else: 
                $group_details   = sprintf($titanium_lang['This_closed_group'], $titanium_lang['No_add_allowed']);
                $s_hidden_fields = '';
            endif;
        endif;
        # Mod: Auto Group v1.2.2 END
    endif;
    
    $phpbb2_page_title = $titanium_lang['Group_Control_Panel'];
    include(NUKE_INCLUDE_DIR . 'page_header.' . $phpEx);
    
	# template array added by TheGhost
    list($the_group_name) = $titanium_db->sql_ufetchrow("SELECT `group_name` FROM ".GROUPS_TABLE." WHERE `group_id`=$group_id", SQL_NUM);

    $phpbb2_template->assign_vars(array(
	'GROUPS_LINK' => '<a href="modules.php?name=Groups">Member Groups</a> <i class="fas fa-arrow-right"></i> ',
	'GROUPS_LIST_INFO_LINK' => '<a href="modules.php?name=Groups&amp;g='.$group_id.'">'.$the_group_name.'</a>',
    'GROUPS_LIST_INFO' => '<div align="center"><h1>'.$the_group_name.' '.$titanium_lang['Group_List_Info'].'</h1></div>'
    ));
    
    # Load templates
    $phpbb2_template->set_filenames(array(
        'info' => 'groupcp_info_body.tpl',
        'pendinginfo' => 'groupcp_pending_info.tpl'
    ));
    //make_jumpbox('viewforum.'.$phpEx); 
    
    # Add the moderator
    # Mod: Advanced Username Color v1.0.5 START
    $titanium_username = UsernameColor($group_moderator['username']);
    # Mod: Advanced Username Color v1.0.5 END
	
    $titanium_user_id  = $group_moderator['user_id'];
    
	# user flag hack
	if((!empty($userdata['user_from_flag']) && ($userdata['user_from_flag'] != 'blank'))):
	$titanium_user_flag = '<span class="countries '.substr($userdata['user_from_flag'], 0, -4).'"></span> ';
	else:
	$titanium_user_flag = '<span class="countries unknown"></span> ';
	endif;
	
	# set the moderators avatar START	
    switch($group_moderator['user_avatar_type'])
    {
      case USER_AVATAR_UPLOAD:
      $modavatar = $phpbb2_board_config['avatar_path'].'/'.$group_moderator['user_avatar'];
      break;
      case USER_AVATAR_REMOTE:
      $modavatar = resize_avatar($group_moderator['user_avatar']);
      break;
      case USER_AVATAR_GALLERY:
      $modavatar = $phpbb2_board_config['avatar_gallery_path'].'/'.(($group_moderator['user_avatar'] 
	  == 'blank.gif' || $row['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $group_moderator['user_avatar']);
      break;
	}
	$mod_avatar = '<img class="rounded-corners-header" height="auto" width="30" src="'.$modavatar.'">&nbsp;';
	# set the moderators avatar END	
	
	# get the moderators information
	# Mod: Online/Offline/Hidden v3.0.0 START
    generate_user_info($group_moderator, 
	$phpbb2_board_config['default_dateformat'], 
	                      $is_moderator, 
						          $from, 
								 $phpbb2_posts, 
								$joined, 
						 $phpbb2_poster_avatar, 
						   $profile_img, 
						       $profile, 
							$search_img, 
							    $search, 
								$pm_img, 
								    $pm, 
							 $email_img, 
							     $email, 
							   $www_img, 
							       $www, 
							  $userdata, 
					 $online_status_img, 
					     $online_status);
    # Mod: Online/Offline/Hidden v3.0.0 END
	
 	$s_hidden_fields .= '<input type="hidden" name="sid" value="'.$userdata['session_id'].'" />';
	
    $phpbb2_template->assign_vars(array(
		'L_GROUP_INFORMATION' => $titanium_lang['Group_Information'],
        'L_GROUP_NAME' => $titanium_lang['Group_name'],
        'L_GROUP_DESC' => $titanium_lang['Group_description'],
        'L_GROUP_TYPE' => $titanium_lang['Group_type'],
        'L_GROUP_MEMBERSHIP' => $titanium_lang['Group_membership'],
        'L_SUBSCRIBE' => $titanium_lang['Subscribe'],
        'L_UNSUBSCRIBE' => $titanium_lang['Unsubscribe'],
        'L_JOIN_GROUP' => $titanium_lang['Join_group'],
        'L_UNSUBSCRIBE_GROUP' => $titanium_lang['Unsubscribe'],
        'L_GROUP_OPEN' => $titanium_lang['Group_open'],
        'L_GROUP_CLOSED' => $titanium_lang['Group_closed'],
        'L_GROUP_HIDDEN' => $titanium_lang['Group_hidden'],
        'L_UPDATE' => $titanium_lang['Update'],
        'L_GROUP_MODERATOR' => $titanium_lang['Group_Moderator'],
        'L_GROUP_MEMBERS' => $titanium_lang['Group_Members'],
        'L_PENDING_MEMBERS' => $titanium_lang['Pending_members'],
        'L_SELECT_SORT_METHOD' => $titanium_lang['Select_sort_method'],
        'L_PM' => $titanium_lang['PM'],
        'L_EMAIL' => $titanium_lang['Email'],
        'L_POSTS' => $titanium_lang['Posts'],
        'L_WEBSITE' => $titanium_lang['Website'],
        'L_FROM' => $titanium_lang['Location'],
        'L_ORDER' => $titanium_lang['Order'],
        'L_SORT' => $titanium_lang['Sort'],
        'L_SUBMIT' => $titanium_lang['Sort'],
        'L_SELECT' => $titanium_lang['Select'],
        'L_REMOVE_SELECTED' => $titanium_lang['Remove_selected'],
        'L_ADD_MEMBER' => $titanium_lang['Add_member'],
        'L_FIND_USERNAME' => $titanium_lang['Find_username'],
        'GROUP_NAME' => GroupColor($group_info['group_name']),
        'GROUP_DESC' => $group_info['group_description'] . "&nbsp;",
        'GROUP_DETAILS' => $group_details,
        'MOD_ROW_COLOR' => '#' . $theme['td_color1'],
        'MOD_ROW_CLASS' => $theme['td_class1'],
        'MOD_USERNAME' => $titanium_username,
        'MOD_FLAG' => $titanium_user_flag,
        'MOD_FROM' => $from,
        'MOD_JOINED' => $joined,
        'MOD_POSTS' => $phpbb2_posts,
        'MOD_AVATAR_IMG' => $mod_avatar,
        'MOD_PROFILE_IMG' => $mod_avatar,
        'MOD_PROFILE' => $profile,
        'MOD_SEARCH_IMG' => $search_img,
        'MOD_SEARCH' => $search,
        'MOD_PM_IMG' => $pm_img,
        'MOD_PM' => $pm,
        'MOD_EMAIL_IMG' => $email_img,
        'MOD_EMAIL' => $email,
        'MOD_WWW_IMG' => $www_img,
        'MOD_WWW' => $www,
        
		# Mod: Online/Offline/Hidden v3.0.0 START
        'MOD_ONLINE_STATUS_IMG' => $online_status_img,
        'MOD_ONLINE_STATUS' => $online_status,
		'MOD_CURRENT_AVATAR' => $mod_avatar,
		
        'L_ONLINE_STATUS' => $titanium_lang['Online_status'],
        # Mod: Online/Offline/Hidden v3.0.0 END
        
        'U_MOD_VIEWPROFILE' => append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=$titanium_user_id"),
        'U_SEARCH_USER' => append_titanium_sid("search.$phpEx?mode=searchuser&popup=1"),
        
        'S_GROUP_OPEN_TYPE' => GROUP_OPEN,
        'S_GROUP_CLOSED_TYPE' => GROUP_CLOSED,
        'S_GROUP_HIDDEN_TYPE' => GROUP_HIDDEN,
        'S_GROUP_OPEN_CHECKED' => ($group_info['group_type'] == GROUP_OPEN) ? ' checked="checked"' : '',
        'S_GROUP_CLOSED_CHECKED' => ($group_info['group_type'] == GROUP_CLOSED) ? ' checked="checked"' : '',
        'S_GROUP_HIDDEN_CHECKED' => ($group_info['group_type'] == GROUP_HIDDEN) ? ' checked="checked"' : '',
        'S_HIDDEN_FIELDS' => $s_hidden_fields,
        'S_MODE_SELECT' => $select_sort_mode,
        'S_ORDER_SELECT' => $select_sort_order,
        'S_GROUPCP_ACTION' => append_titanium_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id")
    ));
    
    # Dump out the remaining users - THIS EXCLUDES THE MODERATOR
    for ($i = $phpbb2_start; $i < min($phpbb2_board_config['topics_per_page'] + $phpbb2_start, $members_count); $i++): 
	
    # remove this user from public viewing, only admins can see the person exist
	if (!is_admin())
    if(!$group_members[$i]['user_allow_viewonline']) # if user is does not allow profile viewing then skip to next person in the list
	continue;
		
	# Mod: Advanced Username Color v1.0.5 START
    $titanium_username = UsernameColor($group_members[$i]['username']);
    # Mod: Advanced Username Color v1.0.5 END
		
    $titanium_user_id  = $group_members[$i]['user_id'];
    
	# the Location to The InterWebs if the user has not listed a location
	if(empty($group_members[$i]['user_from']))
	$titanium_user_from = 'The InterWebs';
	else
	$titanium_user_from = $group_members[$i]['user_from'];
	
	# set the flag for the moderator
	# user flag hack
	if((!empty($group_members[$i]['user_from_flag']) && ($group_members[$i]['user_from_flag'] != 'blank'))):
	$titanium_user_flag = '<span class="countries '.substr($group_members[$i]['user_from_flag'], 0, -4).'"></span> ';
	else:
	$titanium_user_flag = '<span class="countries unknown"></span> ';
	endif;
	
    # Mod: Forum Index Avatar Mod v3.0.0 START
    switch($group_members[$i]['user_avatar_type'])
    {
      case USER_AVATAR_UPLOAD:
      $current_avatar = $phpbb2_board_config['avatar_path'] . '/' . $group_members[$i]['user_avatar'];
      break;
      case USER_AVATAR_REMOTE:
      $current_avatar = resize_avatar($group_members[$i]['user_avatar']);
      break;
      case USER_AVATAR_GALLERY:
      $current_avatar = $phpbb2_board_config['avatar_gallery_path'] . '/' . (($group_members[$i]['user_avatar'] 
	  == 'blank.gif' || $row['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $group_members[$i]['user_avatar']);
      break;
	}
	$titanium_user_avatar = '<img class="rounded-corners-header" height="auto" width="30" src="'.$current_avatar.'">&nbsp;';
    # Mod: Forum Index Avatar Mod v3.0.0 END
        
        # Mod: Online/Offline/Hidden v3.0.0 START
        generate_user_info($group_members[$i], 
		  $phpbb2_board_config['default_dateformat'], 
		                        $is_moderator, 
								        $from, 
									   $phpbb2_posts, 
									  $joined, 
							   $phpbb2_poster_avatar, 
							     $profile_img, 
								     $profile, 
								  $search_img, 
								      $search, 
									  $pm_img, 
									      $pm, 
								   $email_img, 
								       $email, 
									 $www_img, 
									     $www, 
									$userdata, 
						   $online_status_img, 
						       $online_status);
       # Mod: Online/Offline/Hidden v3.0.0 END

       if($group_members[$i]['user_session_time'] >= (time()-$phpbb2_board_config['online_time'])):
         $theme_name = get_theme();
		 
	     if(!$group_members[$i]['user_allow_viewonline']):
		 $online_status = '<img class="tooltip-html copyright" title="'.$group_members[$i]['username'].' is Hidden" alt="offline" 
		 width="30" height="30" src="themes/'.$theme_name.'/forums/images/status/icons8-invisible-512.png" />';
	     $online_status_img = $online_status; 
		 else:
		 $online_status = '<a href="'.append_titanium_sid("viewonline.php").'" '
		 .$online_color.'><img class="tooltip-html copyright" title="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$group_members[$i]['username']
		 .' is Currently Online<br /> CLICK TO VIEW ONLINE USER LIST!" alt="online" src="themes/'.$theme_name.'/forums/images/status/online_bgcolor_one.gif" /></a>';
		 $online_status_img = $online_status;
		 endif;

       else:
       
	   $online_status = '<img class="tooltip-html copyright" 
	   title="'.$group_members[$i]['username'].' is Offline"alt="offline" src="themes/'.$theme_name.'/forums/images/status/offline_bgcolor_one.gif" /></span>';
	   $online_status_img = $online_status; 

	     if(!$group_members[$i]['user_allow_viewonline']):
		 $online_status = '<img class="tooltip-html copyright" title="'.$group_members[$i]['username'].' is Hidden" alt="offline" 
		 width="30" height="30" src="themes/'.$theme_name.'/forums/images/status/icons8-invisible-512.png" />';
	     $online_status_img = $online_status;
		 endif; 
       
	   endif;
       # Mod: Online/Offline/Hidden v3.0.0 END
  
        if($group_info['group_type'] != GROUP_HIDDEN || $is_group_member || $is_moderator): 
		
            $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];
            
            $phpbb2_template->assign_block_vars('member_row', array(
                'ROW_COLOR' => '#'.$row_color,
                'ROW_CLASS' => $row_class,
                'USERNAME' => $titanium_username,
                'FROM' => $titanium_user_flag.$titanium_user_from,
                'POSTS' => $phpbb2_posts,
                'USER_ID' => $titanium_user_id,
				'CURRENT_AVATAR' => $titanium_user_avatar,
                'PM_IMG' => $pm_img,
                'PM' => $pm,
                'EMAIL_IMG' => $email_img,
                'EMAIL' => $email,
                'WWW_IMG' => $www_img,
                'WWW' => $www,
                # Mod: Online/Offline/Hidden v3.0.0 START
                'ONLINE_STATUS' => $online_status,
                # Mod: Online/Offline/Hidden v3.0.0 END
                'U_VIEWPROFILE' => append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=$titanium_user_id")
            ));
            
           if($is_moderator) 
          $phpbb2_template->assign_block_vars('member_row.switch_mod_option', array());
       endif;
    endfor;
	
	if(!$members_count): 
        # No group members
        $phpbb2_template->assign_block_vars('switch_no_members', array());
        $phpbb2_template->assign_vars(array(
            'L_NO_MEMBERS' => $titanium_lang['No_group_members']
        ));
    endif;
    
	$current_page = (!$members_count) ? 1 : ceil($members_count / $phpbb2_board_config['topics_per_page']);
    
    $phpbb2_template->assign_vars(array(
        'PAGINATION' => generate_pagination("groupcp.$phpEx?".POST_GROUPS_URL."=$group_id", $members_count, $phpbb2_board_config['topics_per_page'], $phpbb2_start),
        'PAGE_NUMBER' => sprintf($titanium_lang['Page_of'], (floor($phpbb2_start / $phpbb2_board_config['topics_per_page']) + 1), $current_page),
        
        'L_GOTO_PAGE' => $titanium_lang['Goto_page']
    ));
    
    if($group_info['group_type'] == GROUP_HIDDEN && !$is_group_member && !$is_moderator): 
        # No group members
        $phpbb2_template->assign_block_vars('switch_hidden_group', array());
        $phpbb2_template->assign_vars(array(
            'L_HIDDEN_MEMBERS' => $titanium_lang['Group_hidden_members']
        ));
    endif;
    
    # We've displayed the members who belong to the group, now we
    # do the pending memebers...
    if($is_moderator) 
	{
        # Users pending in ONLY THIS GROUP (which is moderated by this user)
        if($modgroup_pending_count) 
		{
            for($i = 0; $i < $modgroup_pending_count; $i++) 
			{
                $titanium_username = UsernameColor($modgroup_pending_list[$i]['username']);
                $titanium_user_id  = $modgroup_pending_list[$i]['user_id'];
     
	            if(empty($modgroup_pending_list[$i]['user_from']))
	            $titanium_user_from = 'The InterWebs';
	            else
	            $titanium_user_from = $modgroup_pending_list[$i]['user_from'];
	
	            # user flag hack
				if((!empty($modgroup_pending_list[$i]['user_from_flag']) && ($modgroup_pending_list[$i]['user_from_flag'] != 'blank'))):
	            $titanium_user_flag = '<span class="countries '.substr($modgroup_pending_list[$i]['user_from_flag'], 0, -4).'"></span> ';
	            else:
	            $titanium_user_flag = '<span class="countries unknown"></span> ';
	            endif;

              # Mod: Forum Index Avatar Mod v3.0.0 START
              switch($modgroup_pending_list[$i]['user_avatar_type'])
              {
                  case USER_AVATAR_UPLOAD:
                  $current_avatar = $phpbb2_board_config['avatar_path'].'/'.$modgroup_pending_list[$i]['user_avatar'];
                  break;
                  case USER_AVATAR_REMOTE:
                  $current_avatar = resize_avatar($modgroup_pending_list[$i]['user_avatar']);
                  break;
                  case USER_AVATAR_GALLERY:
                  $current_avatar = $phpbb2_board_config['avatar_gallery_path'].'/'.(($modgroup_pending_list[$i]['user_avatar'] 
	              == 'blank.gif' || $row['user_avatar'] == 'gallery/blank.gif') ? 'blank.png' : $modgroup_pending_list[$i]['user_avatar']);
                  break;
	          }
	
	          $pending_user_avatar = '<img class="rounded-corners-header" height="auto" width="30" src="'.$current_avatar.'">&nbsp;';
              # Mod: Forum Index Avatar Mod v3.0.0 END
	            
                # Mod: Online/Offline/Hidden v2.2.7 START
                generate_user_info($modgroup_pending_list[$i], 
				          $phpbb2_board_config['default_dateformat'], 
						                        $is_moderator, 
												        $from, 
													   $phpbb2_posts, 
													  $joined, 
											   $phpbb2_poster_avatar, 
											     $profile_img, 
												     $profile, 
												  $search_img, 
												      $search, 
													  $pm_img, 
													      $pm, 
												   $email_img, 
												       $email, 
													 $www_img, 
													     $www, 
												    $userdata, 
										   $online_status_img, 
										       $online_status);
                # Mod: Online/Offline/Hidden v2.2.7 END

                $row_color = (!($i % 2)) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = (!($i % 2)) ? $theme['td_class1'] : $theme['td_class2'];
                
                $titanium_user_select = '<input type="checkbox" name="member[]" value="' . $titanium_user_id . '">';
                
                $phpbb2_template->assign_block_vars('pending_members_row', array(
                    'ROW_CLASS' => $row_class,
                    'ROW_COLOR' => '#' .$row_color,
                    'USERNAME' => $titanium_username,
                    'FROM' => $titanium_user_flag.$from,
                    'JOINED' => $joined,
                    'POSTS' => $phpbb2_posts,
                    'USER_ID' => $titanium_user_id,
                    'AVATAR_IMG' => $phpbb2_poster_avatar,
					'CURRENT_AVATAR' => $pending_user_avatar,
                    'PROFILE_IMG' => $profile_img,
                    'PROFILE' => $profile,
                    'SEARCH_IMG' => $search_img,
                    'SEARCH' => $search,
                    'PM_IMG' => $pm_img,
                    'PM' => $pm,
                    'EMAIL_IMG' => $email_img,
                    'EMAIL' => $email,
                    'WWW_IMG' => $www_img,
                    'WWW' => $www,
                    'ONLINE_STATUS_IMG' => $online_status_img,
                    'ONLINE_STATUS' => $online_status,
                    'U_VIEWPROFILE' => append_titanium_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$titanium_user_id")
                ));
            }
            
            $phpbb2_template->assign_block_vars('switch_pending_members', array());
            
            $phpbb2_template->assign_vars(array(
                'L_SELECT' => $titanium_lang['Select'],
                'L_APPROVE_SELECTED' => $titanium_lang['Approve_selected'],
                'L_DENY_SELECTED' => $titanium_lang['Deny_selected']
            ));
            
            $phpbb2_template->assign_var_from_handle('PENDING_USER_BOX', 'pendinginfo');
            
        }
    }
    
    if ($is_moderator):
        $phpbb2_template->assign_block_vars('switch_mod_option', array());
        $phpbb2_template->assign_block_vars('switch_add_member', array());
    endif;
    
    $phpbb2_template->pparse('info');
} 
else 
{
    # Show the main groupcp.php screen where the user can select a group.
    # Select all group that the user is a member of or where the user has
    # a pending membership.
    $in_group = array();

    if (is_user()) 
	{
        $sql = "SELECT g.group_id, 
		             g.group_name, 
					 g.group_type, 
				  ug.user_pending
                
				FROM (".GROUPS_TABLE." g, ".USER_GROUP_TABLE." ug)
                WHERE ug.user_id = ".$userdata['user_id']."
                AND ug.group_id = g.group_id
                AND g.group_single_user <> ".TRUE."
                ORDER BY g.group_name, ug.user_id";
        
		if(!($result = $titanium_db->sql_query($sql))) 
        message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
        
        
        if($row = $titanium_db->sql_fetchrow($result)):
            $in_group             = array();
            $s_member_groups_opt  = '';
            $s_pending_groups_opt = '';
            
            do 
			{
                $in_group[] = $row['group_id'];
                if ($row['user_pending']) 
                $s_pending_groups_opt .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
                else 
                $s_member_groups_opt .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
            } 
			while($row = $titanium_db->sql_fetchrow($result));
            
            $s_pending_groups = '<select name="' . POST_GROUPS_URL . '">' . $s_pending_groups_opt . "</select>";
            $s_member_groups  = '<select name="' . POST_GROUPS_URL . '">' . $s_member_groups_opt . "</select>";
        endif;
    }
    
    # Select all other groups i.e. groups that this user is not a member of
    $ignore_group_sql = (count($in_group)) ? "AND group_id NOT IN (".implode(', ', $in_group).")" : '';
    $sql = "SELECT group_id, 
	             group_name, 
				 group_type, 
				group_count, 
			group_count_max
            
			FROM ".GROUPS_TABLE." g
            WHERE group_single_user <> ".TRUE." $ignore_group_sql
            ORDER BY g.group_name";
    
	if(!($result = $titanium_db->sql_query($sql))) 
    message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
    
    $s_group_list_opt = '';
 
    while($row = $titanium_db->sql_fetchrow($result)): 
        # Mod: Auto Group v1.2.2 START
        $is_autogroup_enable = ($row['group_count'] <= $userdata['user_posts'] && $row['group_count_max'] > $userdata['user_posts']) ? true : false;
        # Mod: Auto Group v1.2.2 END

        if ($row['group_type'] != GROUP_HIDDEN || $userdata['user_level'] == ADMIN || $is_autogroup_enable) 
        $s_group_list_opt .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
    endwhile;
	
    $s_group_list = '<select name="'.POST_GROUPS_URL.'">'.$s_group_list_opt.'</select>';
    
    if($s_group_list_opt != '' || $s_pending_groups_opt != '' || $s_member_groups_opt != ''): 
		# Load and process templates
        $phpbb2_page_title = $titanium_lang['Group_Control_Panel'];
        include(NUKE_INCLUDE_DIR . 'page_header.' . $phpEx);
        
		# template array added by TheGhost
        $phpbb2_template->assign_vars(array(
            'GROUPS_TITLE' => '<div align="center">'.$titanium_lang['Group_List_Title'].'</div>'
        ));

        $phpbb2_template->set_filenames(array(
            'user' => 'groupcp_user_body.tpl'
        ));
        //make_jumpbox('viewforum.' . $phpEx);
        
        if($s_pending_groups_opt != '' || $s_member_groups_opt != '') 
        $phpbb2_template->assign_block_vars('switch_groups_joined', array());
        
        if($s_member_groups_opt != '') 
        $phpbb2_template->assign_block_vars('switch_groups_joined.switch_groups_member', array());
                
        if($s_pending_groups_opt != '') 
        $phpbb2_template->assign_block_vars('switch_groups_joined.switch_groups_pending', array());
                
        if($s_group_list_opt != '') 
        $phpbb2_template->assign_block_vars('switch_groups_remaining', array());
                
        $s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
        
        $phpbb2_template->assign_vars(array(
            'L_GROUP_MEMBERSHIP_DETAILS' => $titanium_lang['Group_member_details'],
            'L_JOIN_A_GROUP' => $titanium_lang['Group_member_join'],
            'L_YOU_BELONG_GROUPS' => $titanium_lang['Current_memberships'],
            'L_SELECT_A_GROUP' => $titanium_lang['Non_member_groups'],
            'L_PENDING_GROUPS' => $titanium_lang['Memberships_pending'],
            'L_SUBSCRIBE' => $titanium_lang['Subscribe'],
            'L_UNSUBSCRIBE' => $titanium_lang['Unsubscribe'],
            'L_VIEW_INFORMATION' => $titanium_lang['View_Information'],
            'S_USERGROUP_ACTION' => append_titanium_sid("groupcp.$phpEx"),
            'S_HIDDEN_FIELDS' => $s_hidden_fields,
            'GROUP_LIST_SELECT' => $s_group_list,
            'GROUP_PENDING_SELECT' => $s_pending_groups,
            'GROUP_MEMBER_SELECT' => $s_member_groups
        ));
        
        $phpbb2_template->pparse('user');
	else: 
        message_die(GENERAL_MESSAGE, $titanium_lang['No_groups_exist']);
    endif;
}
include(NUKE_INCLUDE_DIR . 'page_tail.' . $phpEx);
?>
