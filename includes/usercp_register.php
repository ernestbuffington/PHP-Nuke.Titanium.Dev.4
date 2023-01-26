<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
/***************************************************************************
 *                            usercp_register.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: usercp_register.php,v 1.20.2.61 2005/06/26 12:03:44 acydburn Exp
 ***************************************************************************/
/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/
/*
	This code has been modified from its original form by psoTFX @ phpbb.com
	Changes introduce the back-ported phpBB 2.2 visual confirmation code.

	NOTE: Anyone using the modified code contained within this script MUST include
	a relevant message such as this in usercp_register.php ... failure to do so
	will affect a breach of Section 2a of the GPL and our copyright

	png visual confirmation system : (c) phpBB Group, 2003 : All Rights Reserved
*/
/*****[CHANGES]**********************************************************
-=[Base]=-
	  Evolution Functions                      v1.5.0       12/20/2005
-=[Mod]=-
	  Super Quick Reply                        v1.3.2       09/08/2005
	  Force Word Wrapping - Configurator       v1.0.16      06/15/2005
	  View/Disable Avatars/Signatures          v1.1.2       06/16/2005
	  Signature Editor/Preview Deluxe          v1.0.0       06/22/2005
	  Custom mass PM                           v1.4.7       07/04/2005
	  Advanced Time Management                 v2.2.0       07/26/2005
	  YA Merge                                 v1.0.0       07/28/2005
	  XData                                    v1.0.3       02/08/2007
	  Hide Images                              v1.0.0       09/02/2005
	  Initial Usergroup                        v1.0.1       09/02/2005
	  At a Glance Options                      v1.0.0       09/02/2005
	  Remote Avatar Resize                     v2.0.0       11/19/2005
	  Theme Management                         v1.0.2       12/14/2005
	  Welcome PM                               v2.0.0       07/22/2005
	  XData Date Conversion                    v0.1.1       05/04/2006
	  Member Country Flags                     v2.0.7
	  Gender                                   v1.2.6
	  Birthdays                                v3.0.0
 ************************************************************************/

if (!defined('IN_PHPBB'))
exit('Hacking attempt');

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

# Load agreement template since user has not yet
# agreed to registration conditions/coppa
function show_coppa()
{
	global $userdata, $template, $lang, $phpbb_root_path, $phpEx;

	$template->set_filenames(array(
			'body' => 'agreement.tpl')
	);
	$template->assign_vars(array(
		'REGISTRATION' => $lang['Registration'],
		'AGREEMENT' => $lang['Reg_agreement'],
		"AGREE_OVER_13" => $lang['Agree_over_13'],
		"AGREE_UNDER_13" => $lang['Agree_under_13'],
		'DO_NOT_AGREE' => $lang['Agree_not'],

		"U_AGREE_OVER13" => append_sid("profile.$phpEx?mode=register&amp;agreed=true"),
		"U_AGREE_UNDER13" => append_sid("profile.$phpEx?mode=register&amp;agreed=true&amp;coppa=true"))
	);

	$template->pparse('body');
}

$error = FALSE;
$error_msg = '';
$page_title = ( $mode == 'editprofile' ) ? $lang['Edit_profile'] : $lang['Register'];
$verification = null;

 # Mod: YA Merge v1.0.0 START
 if($mode === 'register' && isset($check_num)): 
	# Check the users verification check number, if it doesn't match trigger an error
	$verified = $db->sql_query(
		sprintf('SELECT username, 
		                realname, 
					  user_email, 
				   user_password, 
				   user_password 
				   
				 FROM %s_users_temp 
				 WHERE check_num = "%s"', $user_prefix, $db->sql_escapestring($check_num)));
				 
	if(!$verified || $db->sql_numrows($verified) === 0) 
	message_die(GENERAL_ERROR, sprintf($lang['Error_Check_Num'], append_sid('modules.php?name=Your_Account&op=new_user')));
	# The user exists, lets keep moving on
	$verification = $db->sql_fetchrow($verified);
	$template->assign_block_vars('switch_silent_password', array());
 else: 
	$template->assign_block_vars('switch_ya_merge', array());
 endif;
 # Mod: YA Merge v1.0.0 END

# Mod: Initial Usergroup v1.0.1 START
function init_group($uid) 
{
	global $prefix, $db, $board_config;

	if($board_config['initial_group_id'] != "0" && $board_config['initial_group_id'] != NULL): 
		$initialusergroup = intval($board_config['initial_group_id']);
		if($initialusergroup == 0) 
		return;
		$db->sql_query("INSERT INTO ".$prefix."_bbuser_group (group_id, user_id, user_pending) VALUES ('$initialusergroup', $uid, '0')");
		add_group_attributes($uid, $initialusergroup);
	endif;
}
# Mod: Initial Usergroup v1.0.1 END

# Mod: Welcome PM v2.0.0 START
function change_post_msg($message,$ya_username)
{
	   $message = str_replace("%NAME%", $ya_username, $message);

	   return $message;
}

function send_pm($new_uid,$ya_username)
{
	global $db, $prefix, $user_prefix, $board_config;

	if($board_config['welcome_pm'] != '1') 
	return; 

	$privmsgs_date = time();

	$sql = "SELECT * FROM ".$prefix."_welcome_pm";

	if(!($result = $db->sql_query($sql)))
    echo "Could not obtain private message";
	
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	$message = $row['msg'];
	$subject = $row['subject'];
	
	if(empty($message) || empty($subject))
	return;
	
	$message = change_post_msg($message,$ya_username);
	$subject = change_post_msg($subject,$ya_username);
	$bbcode_uid = make_bbcode_uid();
	$privmsg_message = prepare_message($message, 1, 1, 1, $bbcode_uid);
	
	$sql = "INSERT INTO ".$prefix."_bbprivmsgs (privmsgs_type, 
	                                         privmsgs_subject, 
										 privmsgs_from_userid, 
										   privmsgs_to_userid, 
										        privmsgs_date ) 
			VALUES ('1', '".$subject."', '2', '".$new_uid."', ".$privmsgs_date.")";
	
	if(!$db->sql_query($sql))
	echo "Could not insert private message sent info";

	$privmsg_sent_id = $db->sql_nextid();
	$privmsg_message = addslashes($privmsg_message);

	$sql = "INSERT INTO ".$prefix."_bbprivmsgs_text (privmsgs_text_id, 
	                                              privmsgs_bbcode_uid, 
												        privmsgs_text) 
			VALUES ('".$privmsg_sent_id."', '".$bbcode_uid."', '".$privmsg_message."')";
			
	if(!$db->sql_query($sql))
    echo "Could not insert private message sent text";

	$sql = "UPDATE ".$user_prefix."_users
			SET user_new_privmsg = user_new_privmsg + 1,  user_last_privmsg = '".time()."'
			WHERE user_id = $new_uid";
	
	if(!($result = $db->sql_query($sql)))
    echo "Could not update users table";

}
# Mod: Welcome PM v2.0.0 END

$coppa = ( empty($_POST['coppa']) && empty($_GET['coppa']) ) ? 0 : TRUE;

# Check and initialize some variables if needed
# Mod: Custom mass PM v1.4.7 START
include($phpbb_root_path . 'language/lang_'.$board_config['default_lang'].'/lang_mass_pm.'.$phpEx);
# Mod: Custom mass PM v1.4.7 END
if(
isset($_POST['submit']) ||
isset($_POST['avatargallery']) ||
isset($_POST['submitavatar']) ||
isset($_POST['cancelavatar']) ||
$mode == 'register' ):

	include("includes/functions_validate.php");
	include("includes/bbcode.php");
	include("includes/functions_post.php");

	if ($mode == 'editprofile'):
		$user_id = intval($_POST['user_id']);
		$current_email = trim(htmlspecialchars($_POST['current_email']));
	endif;

    # Mod: At a Glance Options v1.0.0 START
    # Mod: Birthdays v3.0.0 START
	$strip_var_list = array('email' => 'email', 
	                     'bday_day' => 'bday_day', 
					   'bday_month' => 'bday_month', 
					    'bday_year' => 'bday_year', 
						 'facebook' => 'facebook', 
						  'website' => 'website', 
						 'location' => 'location', 
					   'occupation' => 'occupation', 
					    'interests' => 'interests', 
					 'confirm_code' => 'confirm_code', 
					  'glance_show' => 'glance_show');
    # Mod: At a Glance Options v1.0.0 END
    # Mod: Birthdays v3.0.0 END

	# Strip all tags from data ... may p**s some people off, bah, strip_tags is
	# doing the job but can still break HTML output ... have no choice, have
	# to use htmlspecialchars ... be prepared to be moaned at.
    foreach($strip_var_list as $var => $param): 
      if(!empty($_POST[$param])):
  		${$var} = trim((string) htmlspecialchars((string) $_POST[$param]));
  	  endif;
    endforeach;
	$username = (!empty($_POST['username'])) ? phpbb_clean_username($_POST['username']) : '';
	$trim_var_list = array('cur_password' => 'cur_password', 
	                       'new_password' => 'new_password', 
					   'password_confirm' => 'password_confirm', 
					          'signature' => 'signature');

	foreach($trim_var_list as $var => $param): 
      if(!empty($_POST[$param])):
  		${$var} = trim((string) $_POST[$param]);
  	  endif;
    endforeach;

	$signature = (isset($signature)) ? str_replace('<br />', "\n", $signature) : '';
	$signature_bbcode_uid = '';
    
	# Mod: Gender v1.2.6 START
	$gender = ( isset($_POST['gender']) ) ? intval ($_POST['gender']) : 0;
	# Mod: Gender v1.2.6 END

    # Mod: Custom mass PM v1.4.7 START
	$allow_mass_pm = ( isset($_POST['allow_mass_pm']) ) ? intval ($_POST['allow_mass_pm']) : 2;
    # Mod: Custom mass PM v1.4.7 END

	# Run some validation on the optional fields. These are pass-by-ref, so they'll be changed to
	# empty strings if they fail.
	validate_optional_fields($website, $location, $occupation, $interests, $signature, $facebook);

    # Mod: XData v1.0.3 START
	$xdata = array();
	$xd_meta = get_xd_metadata();

	foreach($xd_meta as $name => $info):
		if(isset($_POST[$name]) && $info['handle_input']):
			$xdata[$name] = trim($_POST[$name]);
			$xdata[$name] = str_replace('<br />', "\n", $xdata[$name]);
			# Mod: XData Date Conversion v0.1.1 START
			if($info['field_type'] == 'date'):
			 list ($day, $month, $year) = split ('[/.-]', $xdata[$name]);
			  if (checkdate((int)$month, (int)$day, (int)$year))
			  $xdata[$name] = mktime(0,0,0,$month,$day,$year);
			endif;
			# Mod: XData Date Conversion v0.1.1 END
		endif;
	endforeach;
    # Mod: XData v1.0.3 END

	$viewemail = (isset($_POST['viewemail'])) ? (($_POST['viewemail']) ? TRUE : 0) : 0;
    
	# Mod: Hide Images v1.0.0 START
	$hide_images = (isset($_POST['hide_images'])) ? (($_POST['hide_images']) ? TRUE : 0) : 0;
	# Mod: Hide Images v1.0.0 END

	$allowviewonline = (isset($_POST['hideonline'])) ? (($_POST['hideonline']) ? 0 : TRUE) : TRUE;
	$notifyreply = (isset($_POST['notifyreply'])) ? (($_POST['notifyreply']) ? TRUE : 0) : 0;
	$notifypm = (isset($_POST['notifypm'])) ? (($_POST['notifypm']) ? TRUE : 0) : TRUE;
	$popup_pm = (isset($_POST['popup_pm'])) ? (($_POST['popup_pm']) ? TRUE : 0) : TRUE;
	$sid = (isset($_POST['sid'])) ? $_POST['sid'] : 0;

	if($mode == 'register'):
		$attachsig = (isset($_POST['attachsig'])) ? ((intval($_POST['attachsig'])) ? TRUE : 0) : $board_config['allow_sig'];
		$allowhtml = (isset($_POST['allowhtml'])) ? ((intval($_POST['allowhtml'])) ? TRUE : 0) : $board_config['allow_html'];
		$allowbbcode = (isset($_POST['allowbbcode'])) ? ((intval($_POST['allowbbcode'])) ? TRUE : 0) : $board_config['allow_bbcode'];
		$allowsmilies = (isset($_POST['allowsmilies'])) ? ((intval($_POST['allowsmilies'])) ? TRUE : 0) : $board_config['allow_smilies'];

		# Mod: View/Disable Avatars/Signatures v1.1.2 START
		$showavatars = (isset($_POST['showavatars'])) ? (($_POST['showavatars']) ? TRUE : 0) : TRUE;
		$showsignatures = (isset($_POST['showsignatures'])) ? (($_POST['showsignatures']) ? TRUE : 0) : TRUE;
		# Mod: View/Disable Avatars/Signatures v1.1.2 END

        # Mod: YA Merge v1.0.0 START
		if ($verification !== null):
			$username = $verification['username'];
			$rname = $verification['realname'];
			$email = $verification['user_email'];
			$new_password = $verification['user_password'];
			$password_confirm = $verification['user_password'];
		endif;
        # Mod: YA Merge v1.0.0 END
	else:
		$attachsig = (isset($_POST['attachsig'])) ? (($_POST['attachsig']) ? TRUE : 0) : $userdata['user_attachsig'];
		$allowhtml = (isset($_POST['allowhtml'])) ? ((intval($_POST['allowhtml'])) ? TRUE : 0) : $userdata['user_allowhtml'];
		$allowbbcode = (isset($_POST['allowbbcode'])) ? ((intval($_POST['allowbbcode'])) ? TRUE : 0) : $userdata['user_allowbbcode'];
		$allowsmilies = (isset($_POST['allowsmilies'])) ? ((intval($_POST['allowsmilies'])) ? TRUE : 0) : $userdata['user_allowsmile'];

        # Mod: View/Disable Avatars/Signatures v1.1.2 START
		$showavatars = (isset($_POST['showavatars'])) ? (($_POST['showavatars']) ? TRUE : 0) : $userdata['user_showavatars'];
		$showsignatures = (isset($_POST['showsignatures'])) ? (($_POST['showsignatures']) ? TRUE : 0) : $userdata['user_showsignatures'];
        # Mod: View/Disable Avatars/Signatures v1.1.2 END
        # Mod: View/Disable Avatars/Signatures v1.1.2 END
	endif;

    # Mod: Force Word Wrapping - Configurator v1.0.16 START
	$user_wordwrap = (isset($_POST['user_wordwrap'])) ? intval($_POST['user_wordwrap']) : $board_config['wrap_def'];
    # Mod: Force Word Wrapping - Configurator v1.0.16 END

    # Mod: Birthdays v3.0.0 START
	$birthday_display = (isset($_POST['birthday_display'])) ? intval($_POST['birthday_display']) : 0;
	$birthday_greeting = (isset($_POST['birthday_greeting'])) ? intval($_POST['birthday_greeting']) : 0;
    # Mod: Birthdays v3.0.0 END

	$user_style = (isset($_POST['style'])) ? $_POST['style'] : '';

	if(!empty($_POST['language'])):
		if(preg_match('/^[a-z_]+$/i',$_POST['language'])):
		$user_lang = htmlspecialchars($_POST['language']);
		else:
		$error = true;
		$error_msg = $lang['Fields_empty'];
		endif;
	else:
		$user_lang = $board_config['default_lang'];
	endif;

	$user_timezone = (isset($_POST['timezone'])) ? doubleval($_POST['timezone']) : $board_config['board_timezone'];
    
	# Mod: Member Country Flags v2.0.7 START
	$user_flag = (!empty($_POST['user_flag'])) ? $_POST['user_flag'] : '';
	# Mod: Member Country Flags v2.0.7 END

    # Mod: Advanced Time Management v2.2.0 START
	$time_mode = (isset($_POST['time_mode'])) ? intval($_POST['time_mode']) : $board_config['default_time_mode'];

	if(preg_match("/[^0-9]/i",$_POST['dst_time_lag']) || $dst_time_lag<0 || $dst_time_lag>120):
	
		$error = TRUE;
		$error_msg .= ((isset($error_msg)) ? '<br />' : '' ).$lang['dst_time_lag_error'];
	
	else:
	
		$dst_time_lag = (isset($_POST['dst_time_lag'])) ? intval($_POST['dst_time_lag']) : $board_config['default_dst_time_lag'];
	endif;
    # Mod: Advanced Time Management v2.2.0 END

	$user_dateformat = (!empty($_POST['dateformat'])) ? trim(htmlspecialchars($_POST['dateformat'])) : $board_config['default_dateformat'];

    # Mod: Super Quick Reply v1.3.2 START
	$user_show_quickreply = (isset($_POST['show_quickreply'])) ? intval($_POST['show_quickreply']) : 1;
	$user_quickreply_mode = (isset($_POST['quickreply_mode'])) ? (( $_POST['quickreply_mode']) ? TRUE : 0) : TRUE;
	$user_open_quickreply = (isset($_POST['open_quickreply'])) ? (( $_POST['open_quickreply']) ? TRUE : 0) : TRUE;
    # Mod: Super Quick Reply v1.3.2 END

    $sceditor = (isset($_POST['sceditor_in_source'])) ? intval($_POST['sceditor_in_source']) : 1;

    # Mod: YA Merge v1.0.0 START
	if($mode != 'register') 
    $rname = (isset($_POST['rname'])) ? $_POST['rname'] : ''; 
	
	$extra_info = (isset($_POST['extra_info'])) ? $_POST['extra_info'] : '';
	$newsletter = (isset($_POST['newsletter'])) ? intval($_POST['newsletter']) : 0;
    # Mod: YA Merge v1.0.0 END

	$user_avatar_local = (isset($_POST['avatarselect']) 
	&& !empty($_POST['submitavatar']) 
	&& $board_config['allow_avatar_local']) 
	? htmlspecialchars($_POST['avatarselect']) : ((isset($_POST['avatarlocal'])) ? htmlspecialchars($_POST['avatarlocal']) : '');
	
	$user_avatar_category = (isset($_POST['avatarcatname']) && $board_config['allow_avatar_local']) ? htmlspecialchars($_POST['avatarcatname']) : '';

	$user_avatar_remoteurl = (!empty($_POST['avatarremoteurl']) ) ? trim(htmlspecialchars($_POST['avatarremoteurl'])) : '';

	$user_avatar_upload = (!empty($_POST['avatarurl'])) 
	? trim($_POST['avatarurl']) : (($_FILES['avatar']['tmp_name'] != "none") ? $_FILES['avatar']['tmp_name'] : '');

	$user_avatar_name = (!empty($_FILES['avatar']['name'])) ? $_FILES['avatar']['name'] : '';
	$user_avatar_size = (!empty($_FILES['avatar']['size'])) ? $_FILES['avatar']['size'] : 0;
	$user_avatar_filetype = (!empty($_FILES['avatar']['type'])) ? $_FILES['avatar']['type'] : '';

	$user_avatar = (empty($user_avatar_local) && $mode == 'editprofile') ? $userdata['user_avatar'] : 'blank.png';
	$user_avatar_type = (empty($user_avatar_local) && $mode == 'editprofile') ? $userdata['user_avatar_type'] : '0';

	if((isset($_POST['avatargallery']) || isset($_POST['submitavatar']) || isset($_POST['cancelavatar'])) && (!isset($_POST['submit']))):
		$username = stripslashes($username);
		$email = stripslashes($email);
		$cur_password = htmlspecialchars(stripslashes($cur_password));
		$new_password = htmlspecialchars(stripslashes($new_password));
		$password_confirm = htmlspecialchars(stripslashes($password_confirm));
		$facebook = stripslashes($facebook);
		$website = stripslashes($website);
		$location = stripslashes($location);
		$occupation = stripslashes($occupation);
		$interests = stripslashes($interests);

        # Mod: At a Glance Options v1.0.0 START
		$glance_show = stripslashes($glance_show);
        # Mod: At a Glance Options v1.0.0 END

		$signature = htmlspecialchars(stripslashes($signature));
		$sceditor = stripslashes($sceditor);
		$user_lang = stripslashes($user_lang);
		$user_dateformat = stripslashes($user_dateformat);

        # Mod: XData v1.0.3 START
		reset($xdata);
        foreach($xdata as $code_name => $value): 
          $xdata[$code_name] = stripslashes((string) $value);
        endforeach;        
		# Mod: XData v1.0.3 END

		if(!isset($_POST['cancelavatar'])):
			$user_avatar = $user_avatar_category . '/' . $user_avatar_local;
			$user_avatar_type = USER_AVATAR_GALLERY;
		endif;
	endif;
endif;


# Let's make sure the user isn't logged in while registering,
# and ensure that they were trying to register a second time
# (Prevents double registrations)
if($verification !== null && ($userdata['session_logged_in'] || $username === $userdata['username'])) 
message_die(GENERAL_MESSAGE, $lang['Username_taken'], '', __LINE__, __FILE__);

# Did the user submit? In this case build a query to update the users profile in the DB
if(isset($_POST['submit'])):

	include("includes/usercp_avatar.php");
	$passwd_sql = '';
	
	if($mode == 'editprofile'):
		if($user_id != $userdata['user_id']):
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Wrong_Profile'];
		endif;
	elseif($mode == 'register'):
		if(empty($username) || empty($new_password) || empty($password_confirm) || empty($email)):
		
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
		endif;
	endif;

	if($board_config['enable_confirm'] && $mode == 'register'):
	
		if(empty($_POST['confirm_id'])):
		
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
		
		else:
		
			$confirm_id = htmlspecialchars($_POST['confirm_id']);
			
			if(!preg_match('/^[A-Za-z0-9]+$/', $confirm_id))
			$confirm_id = '';

			$sql = 'SELECT code
			FROM ' . CONFIRM_TABLE . "
			WHERE confirm_id = '$confirm_id'
			AND session_id = '" . $userdata['session_id'] . "'";
			
			if(!($result = $db->sql_query($sql)))
			message_die(GENERAL_ERROR, 'Could not obtain confirmation code', '', __LINE__, __FILE__, $sql);

			if($row = $db->sql_fetchrow($result)):
				if($row['code'] != $confirm_code):
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
				else:
					$sql = 'DELETE FROM ' . CONFIRM_TABLE . "
						WHERE confirm_id = '$confirm_id'
						AND session_id = '" . $userdata['session_id'] . "'";
					if (!$db->sql_query($sql))
						message_die(GENERAL_ERROR, 'Could not delete confirmation code', '', __LINE__, __FILE__, $sql);
				endif;
			else:
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
			endif;
			$db->sql_freeresult($result);
		endif;
	endif;

	$passwd_sql = '';
	if(!empty($new_password) && !empty($password_confirm)):
	
		if($new_password != $password_confirm):
		
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		
		elseif(strlen($new_password) > 32):
		
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_long'];
		
		else:

			if($mode == 'editprofile'):

				$sql = "SELECT user_password
				FROM " . USERS_TABLE . "
				WHERE user_id = '$user_id'";

				if(!($result = $db->sql_query($sql)))
				message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);

				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				# Base: Evolution Functions v1.5.0 START
				if($row['user_password'] != md5($cur_password)):
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
				endif;
				# Base: Evolution Functions v1.5.0 END
			endif;

			# Base: Evolution Functions v1.5.0 START
			if(!$error):
			  if($mode != 'register') { $new_password = md5($new_password); }
			  $passwd_sql = "user_password = '$new_password', ";
			endif;
			# Base: Evolution Functions v1.5.0 END
			# Base: Evolution Functions v1.5.0 END
		endif;
	
	elseif((empty($new_password) && !empty($password_confirm)) || (!empty($new_password) && empty($password_confirm))):
		$error = TRUE;
		$error_msg .= (( isset($error_msg)) ? '<br />' : '' ).$lang['Password_mismatch'];
	endif;

	# Do a ban check on this email address
	if($email != $userdata['user_email'] || $mode == 'register'):
		$result = validate_email($email);
		
		if($result['error']):
			$email = $userdata['user_email'];
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
		endif;

		if($mode == 'editprofile'):
			$sql = "SELECT user_password
			FROM " . USERS_TABLE . "
			WHERE user_id = '$user_id'";

			if(!($result = $db->sql_query($sql)))
			message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);

			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			# Base: Evolution Functions v1.5.0 START
			if($row['user_password'] != md5($cur_password)):
				$email = $userdata['user_email'];
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
			endif;
			# Base: Evolution Functions v1.5.0 END
		endif;
	endif;

	$username_sql = '';
	if($board_config['allow_namechange'] || $mode == 'register'):
		if(empty($username)):
			# Error is already triggered, since one field is empty.
			$error = TRUE;
		elseif($username != $userdata['username'] || $mode == 'register'):
			if(strtolower($username) != strtolower($userdata['username']) || $mode == 'register'):
				$result = validate_username($username);
				if($result['error']):
				
					$error = TRUE;
					$error_msg .= (( isset($error_msg)) ? '<br />' : '' ).$result['error_msg'];
				endif;
			endif;

			if(!$error)
			$username_sql = "username = '" . str_replace("\'", "''", $username) . "', ";
		endif;
	endif;

    # Mod: Birthdays v3.0.0 START
	$bday_locked = $board_config['bday_lock'] && $userdata['user_birthday'] != 0;

	if(!$bday_locked):
		$empty_month = empty($bday_month) || $bday_month == $lang['Default_Month'];
		$empty_day = empty($bday_day) || $bday_day == $lang['Default_Day'];
		$empty_year = empty($bday_year) || $bday_year == $lang['Default_Year'];
	else:
		$empty_month = false;
		$empty_day = false;
		$empty_year = false;
		# we set the following to 1 since otherwise we'd be assigning undefined variables to $temp_*
		$bday_month = $bday_day = $bday_year = 1;
	endif;

	$temp_month = $empty_month ? 1 : $bday_month;
	$temp_day = $empty_day ? 1 : $bday_day;
	$temp_year = $empty_year ? 4 : $bday_year;

	switch(true):
		case $board_config['bday_require'] && $board_config['bday_year'] && ($empty_month || $empty_day || $empty_year):
		case $board_config['bday_require'] && !$board_config['bday_year'] && ($empty_month || $empty_day):
		case !$board_config['bday_require'] && $board_config['bday_year'] && (($empty_month != $empty_day) || ($empty_day != $empty_year)):
		case !$board_config['bday_require'] && !$board_config['bday_year'] && (($empty_month != $empty_day) || ($empty_day && !$empty_year)):
		case !@checkdate( $temp_month, $temp_day, $temp_year ):
			$error = TRUE;
			$error_msg .= ((!empty($error_msg)) ? '<br />' : '' ).$lang['Birthday_invalid'];
			break;
		case !$empty_month && !$empty_day && !$empty_year && !$bday_locked:
			$age = gmdate('Y') - $bday_year - ( sprintf('%02d%02d',$bday_month,$bday_day) > gmdate('md',time()) );
			if($board_config['bday_min'] > $age || $age > $board_config['bday_max']):
				$error = TRUE;
				$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . sprintf($lang['Birthday_range'],$board_config['bday_min'],$board_config['bday_max']);
			endif;
	endswitch;

	$user_birthday = sprintf('%02d%02d%04d',$bday_month,$bday_day,$bday_year);
	$user_birthday2 = ($birthday_display 
	                   != BIRTHDAY_DATE 
	                   && $birthday_display 
	                   != BIRTHDAY_NONE 
					   && !$empty_month 
					   && !$empty_day 
					   && !$empty_year) ? sprintf('%04d%02d%02d',$bday_year,$bday_month,$bday_day) : 'NULL';

	$birthday_greeting = ( isset($_POST['bday_greeting']) ) ? intval($_POST['bday_greeting']) : 0;
	
	if($birthday_greeting && !($board_config['bday_greeting'] & 1<<($birthday_greeting-1)))
	$birthday_greeting = 0;
    # Mod: Birthdays v3.0.0 END

	if($signature != ''):
		if(strlen($signature) > $board_config['max_sig_chars']):
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ).$lang['Signature_too_long'];
		endif;
		if(!isset($signature_bbcode_uid) || $signature_bbcode_uid == '')
		$signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
		$signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies, $signature_bbcode_uid);
	endif;

        # Mod: XData v1.0.3 START
        $xd_meta = get_xd_metadata();
		foreach($xd_meta as $code_name => $meta): 
          if($meta['field_type'] == 'checkbox'):
   			$xdata[$code_name] = ( isset($xdata[$code_name]) ) ? 1 : 0;
   		  endif;
		  if($meta['handle_input'] && ( ($mode == 'register' && $meta['default_auth'] == XD_AUTH_ALLOW) || ($mode != 'register' ? xdata_auth($code_name, $user_id) : 0) || $userdata['user_level'] == ADMIN )):
   		  
   			 if(($meta['field_length'] > 0) && (strlen((string) $xdata[$code_name]) > $meta['field_length'])):
   				$error = TRUE;
   				$error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_too_long'], $meta['field_name']);
   			 endif;
   			 if(((is_countable($meta['values_array']) ? count($meta['values_array']) : 0) > 0 ) && ( ! in_array($xdata[$code_name], $meta['values_array']))):
   			    $error = TRUE;
   				$error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
   			 endif;
  			 if($meta['manditory'] && (strlen((string) $xdata[$code_name]) < 1)):
   				$error = TRUE;
   				$error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
   			 endif;
   			 if((strlen((string) $meta['field_regexp']) > 0 ) && ( ! preg_match($meta['field_regexp'], (string) $xdata[$code_name]) ) && (strlen((string) $xdata[$code_name]) > 0)):
   				$error = TRUE;
   				$error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['XData_invalid'], $meta['field_name']);
   			 endif;
   			 if($meta['allow_bbcode']):
   				if (!$userdata['xdata_bbcode'] && $mode != 'register'): 
   				  $xdata_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
					if($allowbbcode && !empty($xdata_bbcode_uid)): 
   					  $db->sql_query('UPDATE `'.USERS_TABLE.'` SET xdata_bbcode="'.$xdata_bbcode_uid.'" WHERE `user_id` ='.$userdata['user_id']);
   					endif;
				else: 
   					$xdata_bbcode_uid = $userdata['xdata_bbcode'];
   				endif;
   			 endif;
   				$xdata[$code_name] = prepare_message($xdata[$code_name], $meta['allow_html'], $meta['allow_bbcode'], $meta['allow_smilies'], $xdata_bbcode_uid);
   			endif;
       endforeach;
       # Mod: XData v1.0.3 END

    # Mod: Force Word Wrapping - Configurator v1.0.16 START
	if ( $user_wordwrap < $board_config['wrap_min'] || $user_wordwrap > $board_config['wrap_max'] )
	{
		$error = TRUE;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Word_Wrap_Error'];
	}
    # Mod: Force Word Wrapping - Configurator v1.0.16 END

	if($website != '')
	rawurlencode($website);
	$avatar_sql = '';

    if(!isset($_POST['avatardel']))
	$_POST['avatardel'] = '';
	
	if ($_POST['avatardel'] == 1 && $mode == 'editprofile')
	{
		$avatar_sql = user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
	}
	elseif((!empty($user_avatar_upload) || !empty($user_avatar_name) ) && $board_config['allow_avatar_upload'])
	{
		if(!empty($user_avatar_upload)):
			$avatar_mode = (empty($user_avatar_name)) ? 'remote' : 'local';
			$avatar_sql = user_avatar_upload($mode, 
			                          $avatar_mode, 
						  $userdata['user_avatar'], 
					 $userdata['user_avatar_type'], 
									        $error, 
										$error_msg, 
							   $user_avatar_upload, 
							     $user_avatar_name, 
								 $user_avatar_size, 
							 $user_avatar_filetype);
		
		elseif(!empty($user_avatar_name)):
			$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));
			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $l_avatar_size;
		endif;
	}
	elseif($user_avatar_remoteurl != '' && $board_config['allow_avatar_remote'])
	{
		user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
		$avatar_sql = user_avatar_url($mode, $error, $error_msg, $user_avatar_remoteurl);
	}
	elseif($user_avatar_local != '' && $board_config['allow_avatar_local'])
	{
		user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
		$avatar_sql = user_avatar_gallery($mode, $error, $error_msg, $user_avatar_local, $user_avatar_category);
	}
	
	if(!$error)
	{
		if(empty($avatar_sql))
		$avatar_sql = ( $mode == 'editprofile' ) ? '' : "'', " . USER_AVATAR_NONE;

		if($mode == 'editprofile')
		{
			if($email != $userdata['user_email'] && $board_config['require_activation'] != USER_ACTIVATION_NONE && $userdata['user_level'] != ADMIN):
				$user_active = 0;
				$user_actkey = gen_rand_string(true);
				$key_len = 54 - ( strlen($server_url) );
				$key_len = ( $key_len > 6 ) ? $key_len : 6;
				$user_actkey = substr($user_actkey, 0, $key_len);

				if($userdata['session_logged_in']):
				session_end($userdata['sid'], $userdata['user_id']);
				endif;
			else:
				$user_active = 1;
				$user_actkey = '';
			endif;

            # Mod: Birthdays v3.0.0 START
			$birthday_sql = '';
			if(!$board_config['bday_lock'] || $userdata['user_birthday'] == 0)
			$birthday_sql = "user_birthday = $user_birthday, user_birthday2 = $user_birthday2, ";
			# Mod: Birthdays v3.0.0 END

            # Mod: Force Word Wrapping - Configurator v1.0.16 START
            # Mod: Super Quick Reply v1.3.2 START
            # Mod: View/Disable Avatars/Signatures v1.1.2 START
            # Mod: Advanced Time Management v2.2.0 START
            # Mod: YA Merge v1.0.0 START
            # Mod: Signature Editor/Preview Deluxe v1.0.0 START
            # Mod: At a Glance Options v1.0.0 START
            # Mod: Hide Images v1.0.0 START
            # Mod: Member Country Flags v2.0.7 START
            # Mod: Gender v1.2.6 START
            # Mod: Birthdays v3.0.0 START
			$sql = "UPDATE ".USERS_TABLE."
			SET ".$username_sql.$passwd_sql." user_email = '".str_replace("\'", "''", $email)."', ".$birthday_sql
			."birthday_display = $birthday_display, birthday_greeting = $birthday_greeting, user_facebook = '"
			.str_replace("\'", "''", str_replace(' ', '+', $facebook))."', user_website = '".str_replace("\'", "''", $website)
			."', user_occ = '".str_replace("\'", "''", $occupation)."', user_from = '".str_replace("\'", "''", $location) 
			."',user_from_flag = '$user_flag', user_interests = '".str_replace("\'", "''", $interests)."', 
			user_glance_show = '".intval($glance_show)."', user_viewemail = '$viewemail', user_attachsig = $attachsig, user_allowsmile = 
			'$allowsmilies', user_showavatars = '$showavatars', user_showsignatures = '$showsignatures', user_allowhtml 
			= '$allowhtml', user_allowbbcode = '$allowbbcode', user_allow_viewonline = '$allowviewonline', user_notify 
			= '$notifyreply', user_notify_pm = '$notifypm', user_allow_mass_pm = '$allow_mass_pm', user_popup_pm 
			= '$popup_pm', user_timezone = '$user_timezone', user_time_mode = $time_mode, user_dst_time_lag = $dst_time_lag, user_dateformat 
			= '".str_replace("\'", "''",$user_dateformat)."', user_show_quickreply = '$user_show_quickreply', sceditor_in_source 
			= '$sceditor', user_quickreply_mode = '$user_quickreply_mode', user_wordwrap = '" . str_replace("\'", "''", $user_wordwrap) 
			. "', user_open_quickreply = $user_open_quickreply, user_lang = '".str_replace("\'", "''", $user_lang)."', theme 
			= '$user_style', user_active = '$user_active', user_actkey = '".str_replace("\'", "''", $user_actkey)."'".$avatar_sql.", user_gender 
			= '$gender', name = '".$rname."', newsletter = '".$newsletter."', bio = '".$extra_info."', user_hide_images = '$hide_images'
			WHERE user_id = '$user_id'";
            # Mod: Force Word Wrapping - Configurator v1.0.16 END
            # Mod: Super Quick Reply v1.3.2 END
            # Mod: View/Disable Avatars/Signatures v1.1.2 END
            # Mod: Advanced Time Management v2.2.0 END
            # Mod: YA Merge v1.0.0 END
            # Mod: Signature Editor/Preview Deluxe v1.0.0 END
            # Mod: At a Glance Options v1.0.0 END
            # Mod: Hide Images v1.0.0 END
            # Mod: Member Country Flags v2.0.7 END
            # Mod: Gender v1.2.6 END
            # Mod: Birthdays v3.0.0 END

			if(!($result = $db->sql_query($sql))):
				message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql);
			else: 
				global $userinfo;
				$userinfo['theme'] = $user_style;
				UpdateCookie();
			endif;

			# We remove all stored login keys since the password has been updated
			# and change the current one (if applicable)
			if(!empty($passwd_sql))
			session_reset_keys($user_id, $user_ip);

            # Mod: XData v1.0.3 START
			foreach($xdata as $code_name => $value):
			set_user_xdata($user_id, $code_name, $value);
			endforeach;
            # Mod: XData v1.0.3 END

			# Commented code below for testing purposes only.
			if(!$user_active):

				# The users account has been deactivated, send them an email with a new activation key
				include("includes/emailer.php");
				$emailer = new emailer($board_config['smtp_delivery']);

				 if($board_config['require_activation'] != USER_ACTIVATION_ADMIN)
				 {
					 $emailer->from($board_config['board_email']);
					 $emailer->replyto($board_config['board_email']);

					 $emailer->use_template('user_activate', stripslashes($user_lang));
					 $emailer->email_address($email);
					 $emailer->set_subject($lang['Reactivate']);

					 $emailer->assign_vars(array(
						 'SITENAME' => $board_config['sitename'],
						 'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
						 'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',

						 'U_ACTIVATE' => $server_url . '&mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
					 );
					 $emailer->send();
					 $emailer->reset();
				 }
				 elseif($board_config['require_activation'] == USER_ACTIVATION_ADMIN)
				 {
					 $sql = 'SELECT user_email, user_lang
						 FROM ' . USERS_TABLE . '
						 WHERE user_level = ' . ADMIN;

					 if ( !($result = $db->sql_query($sql)) )
					 {
						 message_die(GENERAL_ERROR, 'Could not select Administrators', '', __LINE__, __FILE__, $sql);
					 }

					 while ($row = $db->sql_fetchrow($result))
					 {
						 $emailer->from($board_config['board_email']);
						 $emailer->replyto($board_config['board_email']);

						 $emailer->email_address(trim($row['user_email']));
						 $emailer->use_template("admin_activate", $row['user_lang']);
						 $emailer->set_subject($lang['Reactivate']);

						 $emailer->assign_vars(array(
							 'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
							 'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),

							 'U_ACTIVATE' => $server_url . '&mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
						 );
						 $emailer->send();
						 $emailer->reset();
					 }
					 $db->sql_freeresult($result);
				 }
				//evcz mod=>logout
				global $userinfo;
				$r_uid = $userinfo['user_id'];
				$r_username = $userinfo['username'];
				setcookie("user");
				$db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_username'");
				$db->sql_query("DELETE FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'");
				$user = "";
				//fine evcz mod=>logout
				if (is_active("Forums")) 
				$message = $lang['Profile_updated_inactive'].'<br /><br />'.sprintf($lang['Click_return_index'],  '<a href="'.append_sid("index.$phpEx").'">', '</a>');
				else 
				$message = $lang['Profile_updated_inactive'].'<br /><br />'.sprintf($lang['Click_return_index'],  '<a href="index.php">', '</a>');

			else:
				if(is_active("Forums")): 
					$message = $lang['Profile_updated'] . '<br /><br />'.sprintf($lang['Click_return_index'],  '<a href="'.append_sid("index.$phpEx").'">', '</a>');
					$message .= '<br /><br />'.sprintf($lang['Click_return_profile'],  '<a href='
					.append_sid('profile.php?mode=viewprofile&amp;u='.$userdata['user_id']).'>', '</a>');
				else:
					$message = $lang['Profile_updated'].'<br /><br />'.sprintf($lang['Click_return_index'],  '<a href="index.php">', '</a>');
				endif;
				# redirect(append_sid('profile.php?mode=viewprofile&amp;u='.$userdata['user_id']));
				# redirect(append_sid('profile.php?mode=viewprofile&amp;u='.$userdata['user_id']));
			endif;


			# Coding added for use with the responsive theme breadcrumb navigation.
			if ( defined( 'BOOTSTRAP' ) ):
				$message_title = $lang['Profile'];
			else:
				$message_title = '';
			endif;

			message_die(GENERAL_MESSAGE, $message, $message_title);
		}
		else
		{
			$sql = "SELECT MAX(user_id) AS total
			FROM ".USERS_TABLE;

			if(!($result = $db->sql_query($sql)))
			message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);

			if(!($row = $db->sql_fetchrow($result)))
			message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);

			$db->sql_freeresult($result);
			$user_id = $row['total'] + 1;

		    # Get current date
			$reg_date = date("M d, Y");

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 [ Mod:     Advanced Time Management           v2.2.0 ]
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Mod:     Hide Images                        v1.0.0 ]
 [ Mod:     Member Country Flags               v2.0.7 ]
 [ Mod:     Gender                             v1.2.6 ]
 [ Mod:     Birthdays                          v3.0.0 ]
 ******************************************************/
			$sql = "INSERT INTO " . USERS_TABLE . " (user_id, 
			                                        username, 
												user_regdate, 
											   user_password, 
											      user_email, 
											   user_birthday, 
											  user_birthday2, 
											birthday_display, 
										   birthday_greeting, 
										        user_website, 
												    user_occ, 
												   user_from, 
											  user_from_flag, 
											  user_interests, 
											user_glance_show, 
											        user_sig, 
										 user_sig_bbcode_uid, 
										         user_avatar, 
											user_avatar_type, 
											  user_viewemail, 
											   user_facebook, 
											  user_attachsig, 
											 user_allowsmile, 
											user_showavatars, 
										 user_showsignatures, 
										      user_allowhtml, 
											user_allowbbcode, 
									   user_allow_viewonline, 
									             user_notify, 
											  user_notify_pm, 
										  user_allow_mass_pm, 
										       user_popup_pm, 
											   user_timezone, 
											  user_time_mode, 
										   user_dst_time_lag, 
										     user_dateformat, 
										user_show_quickreply, 
										user_quickreply_mode, 
										       user_wordwrap, 
									    user_open_quickreply, 
										           user_lang, 
												       theme, 
												  user_level, 
											   user_allow_pm, 
											            name, 
												  newsletter, 
												         bio, 
											user_hide_images, 
											     user_gender, 
												 user_active, 
												 user_actkey)

			VALUES ('$user_id', '".str_replace("\'", "''", $username)."', '".$reg_date."', 
			                    '".str_replace("\'", "''", $new_password) . "', 
								'".str_replace("\'", "''", $email)."', $user_birthday, 
								              $user_birthday2, 
											$birthday_display, 
										   $birthday_greeting, 
								'".str_replace("\'", "''", $website) . "', 
								'".str_replace("\'", "''", $occupation) . "', 
								'".str_replace("\'", "''", $location) . "','$user_flag', 
								'" . str_replace("\'", "''", $interests) . "', 
								'" . str_replace("\'", "''", $glance_show) . "', 
								'" . str_replace("\'", "''", $signature) . "', 

								'$signature_bbcode_uid', 
								         '$user_avatar', 
									'$user_avatar_type', 
									       '$viewemail', 

								'" . str_replace("\'", "''", $facebook)."', 

								   '$attachsig', 
								'$allowsmilies', 
								 '$showavatars', 
							  '$showsignatures', 
							       '$allowhtml', 
								  '$allowbbcode', 
							  '$allowviewonline', 
							      '$notifyreply', 
								     '$notifypm', 
								'$allow_mass_pm', 
								     '$popup_pm', 
								'$user_timezone', 
								    '$time_mode', 
								 '$dst_time_lag', 

								 '" . str_replace("\'", "''", $user_dateformat)."', 

								 '$user_show_quickreply', 
								 '$user_quickreply_mode', 

								 '" . str_replace("\'", "''", $user_wordwrap)."', $user_open_quickreply, 
								 '".str_replace("\'", "''", $user_lang)."', '$user_style', '1', '1', 
								 '".$realname."', 
								 '".$newsletter."', 
								 '".$extra_info."', 

								 '$hide_images', 
								      '$gender', ";
/*****[END]********************************************
 [ Mod:     Birthdays                          v3.0.0 ]
 [ Mod:     Gender                             v1.2.6 ]
 [ Mod:     Member Country Flags               v2.0.7 ]
 [ Mod:     Hide Images                        v1.0.0 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:     Advanced Time Management           v2.2.0 ]
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
			if ( $board_config['require_activation'] == USER_ACTIVATION_SELF || $board_config['require_activation'] == USER_ACTIVATION_ADMIN || $coppa )
			{
				$user_actkey = gen_rand_string(true);
				$key_len = 54 - (strlen($server_url));
				$key_len = ( $key_len > 6 ) ? $key_len : 6;
				$user_actkey = substr($user_actkey, 0, $key_len);
				$sql .= "0, '" . str_replace("\'", "''", $user_actkey) . "')";
			}
			else
			{
				$sql .= "1, '')";
			}
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into users table', '', __LINE__, __FILE__, $sql);
			}

			$sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
			VALUES ('', 'Personal User', '1', '0')";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql);
			}

			$group_id = $db->sql_nextid();

			$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
				VALUES ('$user_id', '$group_id', '0')";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql);
			}

			// Delete the temporary user now if we are going through the verification stage of registration
			$db->sql_query(sprintf('DELETE FROM %s_users_temp WHERE username = "%s"', $user_prefix, $username));

/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
			init_group($user_id);
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
			send_pm($user_id,str_replace("\'", "''", $username));
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
			foreach ($xdata as $code_name => $value)
			{
				set_user_xdata($user_id, $code_name, $value);
			}
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

			if ( $coppa )
			{
				$message = $lang['COPPA'];
				$email_template = 'coppa_welcome_inactive';
			}
			else if ( $board_config['require_activation'] == USER_ACTIVATION_SELF )
			{
				$message = $lang['Account_inactive'];
				$email_template = 'user_welcome_inactive';
			}
			else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
			{
				$message = $lang['Account_inactive_admin'];
				$email_template = 'admin_welcome_inactive';
			}
			else
			{
				$message = $lang['Account_added'];
				$email_template = 'user_welcome';
			}

			if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
			{
				$sql = "SELECT user_email, user_lang
				FROM " . USERS_TABLE . "
				WHERE user_level = " . ADMIN;

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not select Administrators', '', __LINE__, __FILE__, $sql);
				}

				while ($row = $db->sql_fetchrow($result))
				{
					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);

					$emailer->email_address(trim($row['user_email']));
					$emailer->use_template("admin_activate", $row['user_lang']);
					$emailer->set_subject($lang['New_account_subject']);

					$emailer->assign_vars(array(
					'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
					'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),

					'U_ACTIVATE' => $server_url . '&mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
					);
					$emailer->send();
					$emailer->reset();
				}
				$db->sql_freeresult($result);
			}
			$message = $message . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		} // if mode == register
	}
endif; // End of submit

if ( $error )
{
	//
	// If an error occured we need to stripslashes on returned data
	//
	$username = stripslashes($username);
	$email = stripslashes($email);
	$cur_password = '';
	$new_password = '';
	$password_confirm = '';
	$facebook = stripslashes($facebook);
	$website = stripslashes($website);
	$location = stripslashes($location);
	$occupation = stripslashes($occupation);
	$interests = stripslashes($interests);
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 ******************************************************/
	$glance_show = stripslashes($glance_show);
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
	$hide_images = stripslashes($hide_images);
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
	$signature = stripslashes($signature);
	$signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $signature) : $signature;

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
	@reset($xdata);
    foreach($xdata as $code_name => $value): 
      $xdata[$code_name] = stripslashes((string) $value);
	  if($xd_meta[$code_name]['allow_bbcode']):
  		$xdata[$code_name] = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', (string) $value) : $value;
  	  endif;
    endforeach;
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
	$user_wordwrap = stripslashes($user_wordwrap);
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
	$user_lang = stripslashes($user_lang);
	$user_dateformat = stripslashes($user_dateformat);

}
else if ( $mode == 'editprofile' && !isset($_POST['avatargallery']) && !isset($_POST['submitavatar']) && !isset($_POST['cancelavatar']) )
{
	$user_id = $userdata['user_id'];
	$username = $userdata['username'];
	$email = $userdata['user_email'];
	$cur_password = '';
	$new_password = '';
	$password_confirm = '';

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
	preg_match('/(..)(..)(....)/', sprintf('%08d',$userdata['user_birthday']), $bday_parts);
	$bday_month = $bday_parts[1];
	$bday_day = $bday_parts[2];
	$bday_year = $bday_parts[3];
	$birthday_display = $userdata['birthday_display'];
	$birthday_greeting = $userdata['birthday_greeting'];
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
	$facebook = $userdata['user_facebook'];
	$website = $userdata['user_website'];
	if(isset($userdata['user_from']))
	$userdata['user_from'] = str_replace(".gif", "", $userdata['user_from']);
	$location = $userdata['user_from'];
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
	$user_flag = $userdata['user_from_flag'];
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
	$occupation = $userdata['user_occ'];
	$interests = $userdata['user_interests'];
/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
	$gender = $userdata['user_gender'];
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 ******************************************************/
	$glance_show = $userdata['user_glance_show'];
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
	$hide_images = $userdata['user_hide_images'];
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
	$allow_mass_pm=$userdata['user_allow_mass_pm'];
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
	$signature_bbcode_uid = $userdata['user_sig_bbcode_uid'];
	$signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $userdata['user_sig']) : $userdata['user_sig'];

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
	$xd_meta = get_xd_metadata();
	$xdata = get_user_xdata($userdata['user_id']);
	foreach ($xdata as $name => $value)
	{
/*****[ANFANG]*****************************************
 [ Mod:    XData Date Conversion               v0.1.1 ]
 ******************************************************/

				if ($xd_meta[$name]['field_type'] == 'date')
				{
						$xdata[$name] = date("d.m.Y", $xdata[$name]);
				}

/*****[ENDE]*******************************************
 [ Mod:    XData Date Conversion               v0.1.1 ]
 ******************************************************/
		if ($xd_meta[$name]['allow_bbcode'])
		{
			$xdata[$name] = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $value) : $value;
		}
	}
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

	$viewemail = $userdata['user_viewemail'];
	$notifypm = $userdata['user_notify_pm'];
	$popup_pm = $userdata['user_popup_pm'];
	$notifyreply = $userdata['user_notify'];
	$attachsig = $userdata['user_attachsig'];
	$allowhtml = $userdata['user_allowhtml'];
	$allowbbcode = $userdata['user_allowbbcode'];
	$allowsmilies = $userdata['user_allowsmile'];
/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
	$showavatars = $userdata['user_showavatars'];
	$showsignatures = $userdata['user_showsignatures'];
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
	$allowviewonline = $userdata['user_allow_viewonline'];

	$user_avatar = ( $userdata['user_allowavatar'] ) ? $userdata['user_avatar'] : '';
	$user_avatar_type = ( $userdata['user_allowavatar'] ) ? $userdata['user_avatar_type'] : USER_AVATAR_NONE;

	$user_style = $userdata['theme'];
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
	$user_wordwrap = $userdata['user_wordwrap'];
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
	$user_lang = $userdata['user_lang'];
	$user_timezone = $userdata['user_timezone'];
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
	$time_mode=$userdata['user_time_mode'];
	$dst_time_lag=$userdata['user_dst_time_lag'];
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
	$user_dateformat = $userdata['user_dateformat'];
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
	$user_show_quickreply = $userdata['user_show_quickreply'];
	$user_quickreply_mode = $userdata['user_quickreply_mode'];
	$user_open_quickreply = $userdata['user_open_quickreply'];
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
	$rname = $userdata['name'];
	$extra_info = $userdata['bio'];
	$newsletter = $userdata['newsletter'];
/*****[END]********************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
}

//
// Default pages
//
include("includes/page_header.php");

make_jumpbox('viewforum.'.$phpEx);

if ( $mode == 'editprofile' )
{
	if ( $user_id != $userdata['user_id'] )
	{
		$error = TRUE;
		$error_msg = $lang['Wrong_Profile'];
	}
}

if( isset($_POST['avatargallery']) && !$error )
{
	include("includes/usercp_avatar.php");

	$avatar_category = ( !empty($_POST['avatarcategory']) ) ? htmlspecialchars($_POST['avatarcategory']) : '';

	$template->set_filenames(array(
			'body' => 'profile_avatar_gallery.tpl')
	);

	$allowviewonline = !$allowviewonline;

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 [ Mod:     Advanced Time Management           v2.2.0 ]
 [ Mod:     YA Merge                           v1.0.0 ]
 [ Mod:     XData                              v1.0.3 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Mod:     Hide Images                        v1.0.0 ]
 [ Mod:     Member Country Flags               v2.0.7 ]
 [ Mod:     Gender                             v1.2.6 ]
 [ Mod:     Birthdays                          v3.0.0 ]
 ******************************************************/
	display_avatar_gallery($mode, $avatar_category, $user_id, $email, $current_email, $coppa, $username, $new_password, $cur_password, $password_confirm, $website, $location, $user_flag, $occupation, $interests, $glance_show, $signature, $viewemail, $notifypm, $allow_mass_pm, $popup_pm, $notifyreply, $attachsig, $allowhtml, $allowbbcode, $allowsmilies, $showavatars, $showsignatures, $allowviewonline, $user_style, $user_wordwrap, $user_lang, $bday_month, $bday_day, $bday_year, $birthday_display, $birthday_greeting, $user_timezone, $time_mode, $dst_time_lag, $user_dateformat, $user_show_quickreply, $user_quickreply_mode, $user_open_quickreply, $userdata['session_id'], $xdata, $rname, $extra_info, $newsletter, $hide_images, $gender, $facebook);
/*****[END]********************************************
 [ Mod:     Birthdays                          v3.0.0 ]
 [ Mod:     Gender                             v1.2.6 ]
 [ Mod:     Member Country Flags               v2.0.7 ]
 [ Mod:     Hide Images                        v1.0.0 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Mod:     XData                              v1.0.3 ]
 [ Mod:     YA Merge                           v1.0.0 ]
 [ Mod:     Advanced Time Management           v2.2.0 ]
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

}
else
{
	include("includes/functions_selects.php");

	if ( !isset($coppa) )
	{
		$coppa = FALSE;
	}

	if ( !isset($user_style) )
	{
		$user_style = $board_config['default_style'];
	}

	$avatar_img = '<img style="max-height: '.$board_config['avatar_max_height'].'px; max-width: '.$board_config['avatar_max_width'].'px;" src="' . $board_config['avatar_gallery_path'] . '/blank.png" alt="" border="0" />';
	if ( $user_avatar_type )
	{
		switch( $user_avatar_type )
		{
			# user_allowavatar = 1
			case USER_AVATAR_UPLOAD:
				$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img class="rounded-corners-usercp_register" style="max-height: '.$board_config['avatar_max_height'].'px; max-width: '.$board_config['avatar_max_width'].'px;" src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" border="0" />' : '';
				break;

			# user_allowavatar = 2
			case USER_AVATAR_REMOTE:
				// $avatar_img = resize_avatar($user_avatar);
				$avatar_img = '<img class="rounded-corners-usercp_register" style="max-height: '.$board_config['avatar_max_height'].'px; max-width: '.$board_config['avatar_max_width'].'px;" src="' . resize_avatar($user_avatar) . '" alt="" border="0" />';
				break;

			# user_allowavatar = 3
			case USER_AVATAR_GALLERY:
				$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img class="rounded-corners-usercp_register" style="max-height: '.$board_config['avatar_max_height'].'px; max-width: '.$board_config['avatar_max_width'].'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($user_avatar == 'blank.png' || $user_avatar == 'gallery/blank.png') ? 'blank.png' : $user_avatar) . '" alt="" border="0" />' : '';
				break;
		}
	}

	$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" />';
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

	if( $mode == 'editprofile' )
	{
		$s_hidden_fields .= '<input type="hidden" name="user_id" value="' . $userdata['user_id'] . '" />';
	//
	// Send the users current email address. If they change it, and account activation is turned on
	// the user account will be disabled and the user will have to reactivate their account.
	//
		$s_hidden_fields .= '<input type="hidden" name="current_email" value="' . $userdata['user_email'] . '" />';
	}

	if ( !empty($user_avatar_local) )
	{
		$s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local . '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category . '" />';
	}

	$html_status =  ( $userdata['user_allowhtml'] && $board_config['allow_html'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
	$bbcode_status = ( $userdata['user_allowbbcode'] && $board_config['allow_bbcode']  ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
	$smilies_status = ( $userdata['user_allowsmile'] && $board_config['allow_smilies']  ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];

/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
	/**
	 * changes made to support responsive themes.
	 */
	$gender_no_specify_checked 	= ( $gender == 0 ) ? ' checked' : '';
	$gender_male_checked 		= ( $gender == 1 ) ? ' checked' : '';
	$gender_female_checked 		= ( $gender == 2 ) ? ' checked' : '';

	$gender_no_specify_selected	= ( $gender == 0 ) ? ' selected' : '';
	$gender_male_selected 		= ( $gender == 1 ) ? ' selected' : '';
	$gender_female_selected 	= ( $gender == 2 ) ? ' selected' : '';
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
	$l_time_mode_0 = "";
	$l_time_mode_1 = "";
	$l_time_mode_2 = $lang['time_mode_dst_server'];
	$l_time_mode_3 = $lang['time_mode_full_server'];
	$l_time_mode_4 = $lang['time_mode_server_pc'];
	$l_time_mode_6 = $lang['time_mode_full_pc'];

	switch ($board_config['default_time_mode'])
	{
		case MANUAL_DST:
			$l_time_mode_1 = $l_time_mode_1 . "*";
		break;
		case SERVER_SWITCH:
			$l_time_mode_2 = $l_time_mode_2 . "*";
		break;
		case FULL_SERVER:
			$l_time_mode_3 = $l_time_mode_3 . "*";
		break;
		case SERVER_PC:
			$l_time_mode_4 = $l_time_mode_4 . "*";
		break;
		case FULL_PC:
			$l_time_mode_6 = $l_time_mode_6 . "*";
		break;
		default:
			$l_time_mode_0 = $l_time_mode_0 . "*";
		break;
	}

	switch ($time_mode)
	{
		case MANUAL_DST:
			$time_mode_manual_dst_checked = 'checked';
			$time_mode_manual_dst_selected = 'selected';
		break;
		case SERVER_SWITCH:
			$time_mode_server_switch_checked='checked';
			$time_mode_server_switch_selected = 'selected';
		break;
		case FULL_SERVER:
			$time_mode_full_server_checked = 'checked';
			$time_mode_full_server_selected = 'selected';
		break;
		case SERVER_PC:
			$time_mode_server_pc_checked = 'checked';
			$time_mode_server_pc_selected = 'selected';
		break;
		case FULL_PC:
			$time_mode_full_pc_checked = ' checked';
			$time_mode_full_pc_selected = 'selected';
		break;
		default:
			$time_mode_manual_checked = 'checked"';
			$time_mode_manual_selected = 'selected';
		break;
	}
/*****[END]********************************************
 [ Mod:    Advanced Time Management             v2.1.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
	$allow_mass_pm_checked 			= ( $allow_mass_pm == 2 ) ? ' checked' : '';
	$allow_mass_pm_notify_checked 	= ( $allow_mass_pm == 4 ) ? ' checked' : '';
	$disable_mass_pm_checked 		= ( $allow_mass_pm == 0 ) ? ' checked' : '';

	$allow_mass_pm_selected			= ( $allow_mass_pm == 4 ) ? ' selected' : '';
	$allow_mass_pm_notify_selected	= ( $allow_mass_pm == 2 ) ? ' selected' : '';
	$disable_mass_pm_selected	 	= ( $allow_mass_pm == 0 ) ? ' selected' : '';
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

	if ( $error )
	{
		$template->set_filenames(array(
			'reg_header' => 'error_body.tpl')
			);
		$template->assign_vars(array(
			'ERROR_MESSAGE' => $error_msg)
			);
		$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
	}

	$template->set_filenames(array(
	'body' => 'profile_add_body.tpl')
	);
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
	// Who can disable receiving mass PM ?
	// Set 'A' for Admins, 'M' for admins+Mods or 'U' for all Users
	//
	$can_disable_mass_pm = 'U';

	switch ( $can_disable_mass_pm )
	{
		case 'A':
			if ( $userdata['user_level'] == ADMIN )
			{
				$template->assign_block_vars('switch_can_disable_mass_pm', array());
			} else
			{
				$template->assign_block_vars('switch_can_not_disable_mass_pm', array());
			}
		break;

		case 'M':
			if ( $userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD )
			{
				$template->assign_block_vars('switch_can_disable_mass_pm', array());
			} else
			{
				$template->assign_block_vars('switch_can_not_disable_mass_pm', array());
			}
		break;

		default:
			$template->assign_block_vars('switch_can_disable_mass_pm', array());
		break;
	}
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

	if ( $mode == 'editprofile' )
	{
		$template->assign_block_vars('switch_edit_profile', array());
	}

/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
	$sql = "SELECT * FROM `".FLAG_TABLE."` ORDER BY `flag_name`";
	if ( !$flags_result = $db->sql_query( $sql ) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain flags information.", "", __LINE__, __FILE__, $sql);
	}

	$default_flag_image = 'unknown.png';

	$selected = ( isset($user_flag) ) ? '' : ' selected';

	$flag_select  = '<select class="user_from_flag_select" name="user_flag">';
	$flag_select .= '	<option value="blank"'.$selected.'>'.$lang['Select_Country'].'</option>';
	while ( $flag_row = $db->sql_fetchrow($flags_result) ):

		/**
		 *	coding added to add new reponsive theme support
		 */
		$template->assign_block_vars('country_flags', array(

			'FLAG_NAME' 	=> str_replace('_', ' ', $flag_row['flag_name']),
			'FLAG_IMAGE' 	=> $flag_row['flag_image'],
			'FLAG_SELECTED' => ( isset( $user_flag) ) ? ((str_replace('.png', '', $user_flag) == str_replace('.png', '', $flag_row['flag_image'])) ? ' selected' : '' ) : ''

		));

		$selected = ( isset( $user_flag) ) ? ((str_replace('.png','',$user_flag) == str_replace('.png', '', $flag_row['flag_image'])) ? ' selected' : '' ) : '';
		$flag_select .= '	<option value="'.$flag_row['flag_image'].'"'.$selected.'>'.$flag_row['flag_name'].'</option>';

        if(isset($user_flag))
		$flag_start_image = str_replace('.png', '', $user_flag);
		else
		$flag_start_image = 'countries blank';

	endwhile;
	$flag_select .= '</select>';
	
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/

	if ( ($mode == 'register') || ($board_config['allow_namechange']) )
	{
		$template->assign_block_vars('switch_namechange_allowed', array());
	}
	else
	{
		$template->assign_block_vars('switch_namechange_disallowed', array());
	}

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
	$xd_meta = get_xd_metadata();
	foreach ($xd_meta as $code_name => $info) 
	{
      if(xdata_auth($code_name, $userdata['user_id']) || intval($userdata['user_level']) == ADMIN)
   	  {
   		if ($info['display_register'] == XD_DISPLAY_NORMAL)
   		{
   				$template->assign_block_vars('xdata', ['CODE_NAME' => $code_name, 'NAME' => $info['field_name'], 'DESCRIPTION' => $info['field_desc'], 'VALUE' => isset($xdata[$code_name]) ? str_replace('"', '&quot;', (string) $xdata[$code_name]) : '', 'MAX_LENGTH' => ( $info['field_length'] > 0) ? ( $info['field_length'] ) : '']
   				);

   				switch ($info['field_type'])
   				{
   					case 'text':
   						$template->assign_block_vars('xdata.switch_type_text', []);
   						break;

   					case 'checkbox':
   					   $template->assign_block_vars('xdata.switch_type_checkbox', ['CHECKED' => ($xdata[$code_name] == 1) ? ' checked="checked"' : '']);
   					   break;

   					case 'textarea':
   						$template->assign_block_vars('xdata.switch_type_textarea', []);
   						break;

   					case 'radio':
   						$template->assign_block_vars('xdata.switch_type_radio', []);

   						foreach ($info['values_array'] as $option) {
             $template->assign_block_vars('xdata.switch_type_radio.options', ['OPTION' => $option, 'CHECKED' => ($xdata[$code_name] == $option) ? 'checked="checked"' : '']
      							);
         }
   						break;

   					case 'select':
   						$template->assign_block_vars('xdata.switch_type_select', []);

   						foreach ($info['values_array'] as $option) {
             $template->assign_block_vars('xdata.switch_type_select.options', ['OPTION' => $option, 'SELECTED' => ($xdata[$code_name] == $option) ? 'selected="selected"' : '']
      							);
         }
   						break;
   /*****[ANFANG]*****************************************
    [ Mod:    XData Date Conversion               v0.1.1 ]
    ******************************************************/
   					case 'date':
   						$template->assign_block_vars('xdata.switch_type_date', []);
   						break;

   /*****[ENDE]*******************************************
    [ Mod:    XData Date Conversion               v0.1.1 ]
    ******************************************************/
   				}
   			}
   			elseif ($info['display_register'] == XD_DISPLAY_ROOT)
   			{
   				$template->assign_block_vars('xdata',
   					['CODE_NAME' => $code_name, 'NAME' => $xd_meta[$code_name]['field_name'], 'DESCRIPTION' => $xd_meta[$code_name]['field_desc'], 'VALUE' => isset($xdata[$code_name]) ? str_replace('"', '&quot;', (string) $xdata[$code_name]) : ''] );
   				$template->assign_block_vars('xdata.switch_is_'.$code_name, []);

   				switch ($info['field_type'])
   				{
   					case 'checkbox':
   						$template->assign_block_vars('xdata.switch_type_checkbox', ['CHECKED' => ($xdata[$code_name] == $lang['true']) ? ' checked="checked"' : '']);
   						break;

   					case 'radio':

   						foreach ($info['values_array'] as $option) {
             $template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', ['OPTION' => $option, 'CHECKED' => ($xdata[$code_name] == $option) ? 'checked="checked"' : '']
      							);
         }
   						break;

   					case 'select':

   						foreach ($info['values_array'] as $option) {
             $template->assign_block_vars('xdata.switch_is_'.$code_name.'.options', ['OPTION' => $option, 'SELECTED' => ($xdata[$code_name] == $option) ? 'selected="selected"' : '']
      							);
         }
   						break;
   				}
   			}
   		}
 }
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
	// Visual Confirmation
	$confirm_image = '';
	if (!empty($board_config['enable_confirm']) && $mode == 'register')
	{
		$sql = 'SELECT session_id
			FROM ' . SESSIONS_TABLE;
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not select session data', '', __LINE__, __FILE__, $sql);
		}

		if ($row = $db->sql_fetchrow($result))
		{
			$confirm_sql = '';
			do
			{
				$confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] . "'";
			}
			while ($row = $db->sql_fetchrow($result));

			$sql = 'DELETE FROM ' .  CONFIRM_TABLE . "
				WHERE session_id NOT IN ($confirm_sql)";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete stale confirm data', '', __LINE__, __FILE__, $sql);
			}
		}
		$db->sql_freeresult($result);

		$sql = 'SELECT COUNT(session_id) AS attempts
			FROM ' . CONFIRM_TABLE . "
			WHERE session_id = '" . $userdata['session_id'] . "'";
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain confirm code count', '', __LINE__, __FILE__, $sql);
		}

		if ($row = $db->sql_fetchrow($result))
		{
			if ($row['attempts'] > 3)
			{
				message_die(GENERAL_MESSAGE, $lang['Too_many_registers']);
			}
		}
		$db->sql_freeresult($result);

		// Generate the required confirmation code
		// NB 0 (zero) could get confused with O (the letter) so we make change it
		$code = dss_rand();
		$code = strtoupper(str_replace('0', 'o', substr($code, 0, 6)));

		$confirm_id = md5(uniqid($user_ip));

		$sql = 'INSERT INTO ' . CONFIRM_TABLE . " (confirm_id, session_id, code)
			VALUES ('$confirm_id', '". $userdata['session_id'] . "', '$code')";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not insert new confirm code information', '', __LINE__, __FILE__, $sql);
		}

		unset($code);

		$confirm_image = (GZIPSUPPORT) ? '<img src="' . append_sid("usercp_confirm.$phpEx?id=$confirm_id") . '" alt="" title="" />' : '<img src="' . append_sid("usercp_confirm.$phpEx?id=$confirm_id&amp;c=1") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.$phpEx?id=$confirm_id&amp;c=2") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.$phpEx?id=$confirm_id&amp;c=3") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.$phpEx?id=$confirm_id&amp;c=4") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.$phpEx?id=$confirm_id&amp;c=5") . '" alt="" title="" /><img src="' . append_sid("usercp_confirm.$phpEx?id=$confirm_id&amp;c=6") . '" alt="" title="" />';
		$s_hidden_fields .= '<input type="hidden" name="confirm_id" value="' . $confirm_id . '" />';

		$template->assign_block_vars('switch_confirm', array());
	}

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
	if ( $board_config['wrap_enable'] )
	{
		$template->assign_block_vars('force_word_wrapping',array());
	}
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

	//
		// Let's do an overall check for settings/versions which would prevent
		// us from doing file uploads....
		//
	$ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
	$form_enctype = ( @$ini_val('file_uploads') == '0' || strtolower(@$ini_val('file_uploads') == 'off') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';

	$template->assign_vars(array(
				'USERNAME' => isset($username) ? $username : '',
				'CUR_PASSWORD' => isset($cur_password) ? $cur_password : '',
				'NEW_PASSWORD' => isset($new_password) ? $new_password : '',
				'PASSWORD_CONFIRM' => isset($password_confirm) ? $password_confirm : '',
				'EMAIL' => isset($email) ? $email : '',
/*****[BEGIN]******************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
				'SIG_EDIT_LINK' => append_sid("profile.$phpEx?mode=signature"),
				'SIG_DESC' => $lang['sig_description'],
				'SIG_BUTTON_DESC' => $lang['sig_edit'],
/*****[END]********************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
				'CONFIRM_IMG' => $confirm_image,
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				// 'BDAY_MONTH' => ($bday_month != 0) ? $bday_month : $lang['Default_Month'],
				// 'BDAY_DAY' => ($bday_day != 0) ? $bday_day : $lang['Default_Day'],
				// 'BDAY_YEAR' => ($bday_year != 0) ? $bday_year : $lang['Default_Year'],

 				'BDAY_MONTH' => ($bday_month != 0) ? $bday_month : '',
				'BDAY_DAY' => ($bday_day != 0) ? $bday_day : '',
				'BDAY_YEAR' => ($bday_year != 0) ? $bday_year : '',

				'BIRTHDAY_ALL' => BIRTHDAY_ALL,
				'BIRTHDAY_ALL_SELECTED' => ( $birthday_display == BIRTHDAY_ALL ) ? ' selected="selected"' : '',
				'BIRTHDAY_DATE' => BIRTHDAY_DATE,
				'BIRTHDAY_DATE_SELECTED' => ( $birthday_display == BIRTHDAY_DATE ) ? ' selected="selected"' : '',
				'BIRTHDAY_AGE' => BIRTHDAY_AGE,
				'BIRTHDAY_AGE_SELECTED' => ( $birthday_display == BIRTHDAY_AGE ) ? ' selected="selected"' : '',
				'BIRTHDAY_NONE' => BIRTHDAY_NONE,
				'BIRTHDAY_NONE_SELECTED' => ( $birthday_display == BIRTHDAY_NONE ) ? ' selected="selected"' : '',
				'BDAY_NONE_ENABLED' => ( !$birthday_greeting ) ? ' checked="checked"' : '',
				'BDAY_EMAIL' => BIRTHDAY_EMAIL,
				'BDAY_EMAIL_ENABLED' => ( $birthday_greeting == BIRTHDAY_EMAIL ) ? ' checked="checked"' : '',
				'BDAY_PM' => BIRTHDAY_PM,
				'BDAY_PM_ENABLED' => ( $birthday_greeting == BIRTHDAY_PM ) ? ' checked="checked"' : '',
				'BDAY_POPUP' => BIRTHDAY_POPUP,
				'BDAY_POPUP_ENABLED' => ( $birthday_greeting == BIRTHDAY_POPUP ) ? ' checked="checked"' : '',
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'FACEBOOK' => $facebook,
				'OCCUPATION' => $occupation,
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
				'ALLOW_MASS_PM' =>$allow_mass_pm,
				'ALLOW_MASS_PM_CHECKED' => $allow_mass_pm_checked,
				'ALLOW_MASS_PM_NOTIFY_CHECKED' => $allow_mass_pm_notify_checked,
				'DISABLE_MASS_PM_CHECKED' => $disable_mass_pm_checked,
				/**
				 *	New changes for use with responsive themes
				 */
				'ALLOW_MASS_PM_SELECTED' => $allow_mass_pm_selected,
				'ALLOW_MASS_PM_NOTIFY_SELECTED' => $allow_mass_pm_notify_selected,
				'DISABLE_MASS_PM_SELECTED' => $disable_mass_pm_selected,
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
				'INTERESTS' => $interests,
/*****[BEGIN]******************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/
				 'GLANCE_SHOW' => glance_option_select($glance_show, 'glance_show'),
				'L_GLANCE_SHOW' => $lang['glance_show'],
/*****[END]********************************************
 [ Mod:    At a Glance Options                 v1.0.0 ]
 *****************************************************/

 /*****[BEGIN]******************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
				'HIDE_IMAGES_YES' => ( $hide_images ) ? 'checked="checked"' : '',
				'HIDE_IMAGES_NO' => ( !$hide_images ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'HIDE_IMAGES_YES_SELECTED' => ( $hide_images ) ? ' selected' : '',
				'HIDE_IMAGES_NO_SELECTED' => ( !$hide_images ) ? ' selected' : '',
				'L_HIDE_IMAGES' => $lang['user_hide_images'],
/*****[END]********************************************
 [ Mod:    Hide Images                         v1.0.0 ]
 ******************************************************/
				'LOCATION' => $location,
/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
				'L_FLAG' => $lang['Country_Flag'],
				/**
				 *	New changes for use with responsive themes
				 */
				'L_FLAG_SELECT' => $lang['Select_Country'],
				'FLAG_SELECT' => $flag_select,
				'FLAG_START' => $flag_start_image,
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/

 				'L_SCEDITOR_PANEL' => $lang['sceditor_options'],
				'L_SCEDITOR_STATE' => $lang['sceditor_state'],
				'SCEDITOR_SELECT' => select_box('sceditor_in_source', $userinfo['sceditor_in_source'], array('0' => $lang['sceditor_display_mode'], '1' => $lang['sceditor_editor_mode'])),
				'SCEDITOR_STATE' => $wysiwyg,

				'WEBSITE' => $website,
				'SIGNATURE' => str_replace('<br />', "\n", $signature ?? ''),
/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
				'GENDER' => $gender,
				'GENDER_NO_SPECIFY_CHECKED' => $gender_no_specify_checked,
				'GENDER_MALE_CHECKED' => $gender_male_checked,
				'GENDER_FEMALE_CHECKED' => $gender_female_checked,
				/**
				 *	The option below were added, just incase theme designers want to changed the birthday selection type.
				 */
				'GENDER_NO_SPECIFY_SELECTED' 	=> $gender_no_specify_selected,
				'GENDER_MALE_SELECTED' 			=> $gender_male_selected,
				'GENDER_FEMALE_SELECTED' 		=> $gender_female_selected,
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
				'VIEW_EMAIL_YES' => ( $viewemail ) ? 'checked="checked"' : '',
				'VIEW_EMAIL_NO' => ( !$viewemail ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'VIEW_EMAIL_YES_SELECTED' => ( $viewemail ) ? ' selected' : '',
				'VIEW_EMAIL_NO_SELECTED' => ( !$viewemail ) ? ' selected' : '',

				'HIDE_USER_YES' => ( !$allowviewonline ) ? 'checked="checked"' : '',
				'HIDE_USER_NO' => ( $allowviewonline ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'HIDE_USER_YES_SELECTED' => ( !$allowviewonline ) ? ' selected' : '',
				'HIDE_USER_NO_SELECTED' => ( $allowviewonline ) ? ' selected' : '',

				'NOTIFY_PM_YES' => ( $notifypm ) ? 'checked="checked"' : '',
				'NOTIFY_PM_NO' => ( !$notifypm ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'NOTIFY_PM_YES_SELECTED' => ( $notifypm ) ? ' selected' : '',
				'NOTIFY_PM_NO_SELECTED' => ( !$notifypm ) ? ' selected' : '',

				'POPUP_PM_YES' => ( $popup_pm ) ? 'checked="checked"' : '',
				'POPUP_PM_NO' => ( !$popup_pm ) ? 'checked="checked"' : '',

				'ALWAYS_ADD_SIGNATURE_YES' => ( $attachsig ) ? 'checked="checked"' : '',
				'ALWAYS_ADD_SIGNATURE_NO' => ( !$attachsig ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'ALWAYS_ADD_SIGNATURE_YES_SELECTED' => ( $attachsig ) ? ' selected' : '',
				'ALWAYS_ADD_SIGNATURE_NO_SELECTED' => ( !$attachsig ) ? ' selected' : '',

				'NOTIFY_REPLY_YES' => ( $notifyreply ) ? 'checked="checked"' : '',
				'NOTIFY_REPLY_NO' => ( !$notifyreply ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'NOTIFY_REPLY_YES_SELECTED' => ( $notifyreply ) ? ' selected' : '',
				'NOTIFY_REPLY_NO_SELECTED' => ( !$notifyreply ) ? ' selected' : '',	

				'ALWAYS_ALLOW_BBCODE_YES' => ( $allowbbcode ) ? 'checked="checked"' : '',
				'ALWAYS_ALLOW_BBCODE_NO' => ( !$allowbbcode ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'ALWAYS_ALLOW_BBCODE_YES_SELECTED' => ( $allowbbcode ) ? ' selected' : '',
				'ALWAYS_ALLOW_BBCODE_NO_SELECTED' => ( !$allowbbcode ) ? ' selected' : '',

				'ALWAYS_ALLOW_HTML_YES' => ( $allowhtml ) ? 'checked="checked"' : '',
				'ALWAYS_ALLOW_HTML_NO' => ( !$allowhtml ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'ALWAYS_ALLOW_HTML_YES_SELECTED' => ( $allowhtml ) ? ' selected' : '',
				'ALWAYS_ALLOW_HTML_NO_SELECTED' => ( !$allowhtml ) ? ' selected' : '',

				'ALWAYS_ALLOW_SMILIES_YES' => ( $allowsmilies ) ? 'checked="checked"' : '',
				'ALWAYS_ALLOW_SMILIES_NO' => ( !$allowsmilies ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'ALWAYS_ALLOW_SMILIES_YES_SELECTED' => ( $allowsmilies ) ? ' selected' : '',
				'ALWAYS_ALLOW_SMILIES_NO_SELECTED' => ( !$allowsmilies ) ? ' selected' : '',

/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
				'SHOW_AVATARS_YES' => ( $showavatars ) ? 'checked="checked"' : '',
				'SHOW_AVATARS_NO' => ( !$showavatars ) ? 'checked="checked"' : '',
				'SHOW_SIGNATURES_YES' => ( $showsignatures ) ? 'checked="checked"' : '',
				'SHOW_SIGNATURES_NO' => ( !$showsignatures ) ? 'checked="checked"' : '',
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
				'ALLOW_AVATAR' => $board_config['allow_avatar_upload'],
				'AVATAR' => $avatar_img,
				'AVATAR_SIZE' => $board_config['avatar_filesize'],
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
				'L_WORD_WRAP' => $lang['Word_Wrap'],
				'L_WORD_WRAP_EXPLAIN' => $lang['Word_Wrap_Explain'],
				'L_WORD_WRAP_EXTRA' => strtr($lang['Word_Wrap_Extra'],array('%min%' => $board_config['wrap_min'], '%max%' => $board_config['wrap_max'])),
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
				'L_BOARD_LANGUAGE' => $lang['Board_lang'],
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
				'WRAP_ROW' => ( $mode == 'register' ) ? $board_config['wrap_def'] : $user_wordwrap,
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
				'LANGUAGE_SELECT' => language_select($user_lang, 'language'),
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'BIRTHMONTH_SELECT' => bday_month_select($bday_month, 'bday_month'),
				'BIRTHDAY_SELECT' => bday_day_select($bday_day, 'bday_day'),
				'BIRTHYEAR_SELECT' => bday_year_select($bday_year, 'bday_year'),

				/**
				 *	New changes for use with responsive themes
				 */
				'BIRTHDAY_REQUIRED' => ( $board_config['bday_require'] == true ) ? ' required' : '',
				'BIRTHDAY_YEAR_REQUIRED' => ( $board_config['bday_year'] == 1 ) ? ' required' : '',

				'MONTH_DEFAULT'		 => ( $bday_month == 0 ) ? ' selected' : '',
				'MONTH_JAN_SELECTED' => ( $bday_month == 1 ) ? ' selected' : '',
				'MONTH_FEB_SELECTED' => ( $bday_month == 2 ) ? ' selected' : '',
				'MONTH_MAR_SELECTED' => ( $bday_month == 3 ) ? ' selected' : '',
				'MONTH_APR_SELECTED' => ( $bday_month == 4 ) ? ' selected' : '',
				'MONTH_MAY_SELECTED' => ( $bday_month == 5 ) ? ' selected' : '',
				'MONTH_JUN_SELECTED' => ( $bday_month == 6 ) ? ' selected' : '',
				'MONTH_JUL_SELECTED' => ( $bday_month == 7 ) ? ' selected' : '',
				'MONTH_AUG_SELECTED' => ( $bday_month == 8 ) ? ' selected' : '',
				'MONTH_SEP_SELECTED' => ( $bday_month == 9 ) ? ' selected' : '',
				'MONTH_OCT_SELECTED' => ( $bday_month == 10 ) ? ' selected' : '',
				'MONTH_NOV_SELECTED' => ( $bday_month == 11 ) ? ' selected' : '',
				'MONTH_DEC_SELECTED' => ( $bday_month == 12 ) ? ' selected' : '',
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
				'STYLE_SELECT' => GetThemeSelect('style'),
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
				'TIMEZONE_SELECT' => tz_select($user_timezone, 'timezone'),
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
				'TIME_MODE' => $time_mode,
	
				'TIME_MODE_MANUAL_DST_CHECKED' => isset($time_mode_manual_dst_checked) ? $time_mode_manual_dst_checked : '',
				'TIME_MODE_MANUAL_CHECKED' => isset($time_mode_manual_checked) ? $time_mode_manual_checked : '',				
				'TIME_MODE_SERVER_SWITCH_CHECKED' => isset($time_mode_server_switch_checked) ? $time_mode_server_switch_checked : '',
				
				'TIME_MODE_FULL_PC_CHECKED' => isset($time_mode_full_pc_checked) ? $time_mode_full_pc_checked : '',
				'TIME_MODE_SERVER_PC_CHECKED' => isset($time_mode_server_pc_checked) ? $time_mode_server_pc_checked : '',
				'TIME_MODE_FULL_SERVER_CHECKED' => isset($time_mode_full_server_checked) ? $time_mode_full_server_checked : '',

				/**
				 *	Code changes made to be compatible with responsive themes
				 */
				'TIME_MODE_MANUAL_DST_SELECTED' => isset($time_mode_manual_dst_selected) ? $time_mode_manual_dst_selected : '',
				'TIME_MODE_MANUAL_SELECTED' => isset($time_mode_manual_selected) ? $time_mode_manual_selected : '',				
				'TIME_MODE_SERVER_SWITCH_SELECTED' => isset($time_mode_server_switch_selected) ? $time_mode_server_switch_selected : '',
				
				'TIME_MODE_FULL_PC_SELECTED' => isset($time_mode_full_pc_selected) ? $time_mode_full_pc_selected : '',
				'TIME_MODE_SERVER_PC_SELECTED' => isset($time_mode_server_pc_selected) ? $time_mode_server_pc_selected : '',
				'TIME_MODE_FULL_SERVER_SELECTED' => isset($time_mode_full_server_selected) ? $time_mode_full_server_selected : '',

				'DST_TIME_LAG' => $dst_time_lag,
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
				'DATE_FORMAT' => $user_dateformat,
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
				'QUICK_REPLY_SELECT' => quick_reply_select($user_show_quickreply, 'show_quickreply'),
				'QUICK_REPLY_MODE_BASIC' => ( $user_quickreply_mode==0 ) ? 'checked="checked"' : '',
				'QUICK_REPLY_MODE_ADVANCED' => ( $user_quickreply_mode!=0 ) ? 'checked="checked"' : '',
				'OPEN_QUICK_REPLY_YES' => ( $user_open_quickreply ) ? 'checked="checked"' : '',
				'OPEN_QUICK_REPLY_NO' => ( !$user_open_quickreply ) ? 'checked="checked"' : '',
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
				'RNAME' => $rname,
				'EXTRA_INFO' => $extra_info,
				'NEWSLETTER_YES' => ( $newsletter == 0 ) ? '' : 'checked="checked"',
				'NEWSLETTER_NO' => ( $newsletter == 0 ) ? 'checked="checked"' : '',
				/**
				 *	New changes for use with responsive themes
				 */
				'NEWSLETTER_YES_SELECTED' => ( $newsletter == 0 ) ? '' : ' selected',
				'NEWSLETTER_NO_SELECTED' => ( $newsletter == 0 ) ? ' selected' : '',
/*****[END]********************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
				'HTML_STATUS' => $html_status,
				'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
				'SMILIES_STATUS' => $smilies_status,
				'L_PAGE_TITLE' => $page_title,

				'L_CURRENT_PASSWORD' => $lang['Current_password'],
				'L_NEW_PASSWORD' => ( $mode == 'register' ) ? $lang['Password'] : $lang['New_password'],
				'L_CONFIRM_PASSWORD' => $lang['Confirm_password'],
				'L_CONFIRM_PASSWORD_EXPLAIN' => ( $mode == 'editprofile' ) ? $lang['Confirm_password_explain'] : '',
				'L_PASSWORD_IF_CHANGED' => ( $mode == 'editprofile' ) ? $lang['password_if_changed'] : '',
				'L_PASSWORD_CONFIRM_IF_CHANGED' => ( $mode == 'editprofile' ) ? $lang['password_confirm_if_changed'] : '',
/*****[BEGIN]******************************************
 [ Mod:    Password security                   v1.1.0 ]
 ******************************************************/
				 'L_PASSWORD_SECURITY_LEVEL1' => $lang['password_security_level1'],
				 'L_PASSWORD_SECURITY_LEVEL2' => $lang['password_security_level2'],
				 'L_PASSWORD_SECURITY_LEVEL3' => $lang['password_security_level3'],
				 'L_PASSWORD_SECURITY_LEVEL4' => $lang['password_security_level4'],
				 'L_PASSWORD_SECURITY_LEVEL5' => $lang['password_security_level5'],
				 'L_PASSWORD_SECURITY_EXPLAIN' => $lang['password_security_explain'],
/*****[END]********************************************
 [ Mod:    Password security                   v1.1.0 ]
 ******************************************************/
				'L_SUBMIT' => $lang['Submit'],
				'L_RESET' => $lang['Reset'],
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'L_CLEAR' => $lang['Clear'],
				'L_BIRTHDAY' => $lang['Birthday'],
				'L_MONTH' => $lang['Month'],
				'L_DAY' => $lang['Day'],
				'L_YEAR' => ( $board_config['bday_year'] ) ? $lang['Year'] : $lang['Year_Optional'],
				'L_OPTIONAL' => ( $board_config['bday_year'] ) ? '' : $lang['Optional'],
				'L_BIRTHDAY_DISPLAY' => $lang['Birthday_Display'],
				'L_BIRTHDAY_ALL' => $lang['Display_all'],
				'L_BIRTHDAY_YEAR' => $lang['Display_day_and_month'],
				'L_BIRTHDAY_AGE' => $lang['Display_age'],
				'L_BIRTHDAY_NONE' => $lang['Display_nothing'],
				'L_BDAY_SEND_GREETING' => $lang['bday_send_greeting'],
				'L_BDAY_SEND_GREETING_EXPLAIN' => $lang['bday_send_greeting_user_explain'],
				'L_NONE' => $lang['Do_not_send'],
				'L_EMAIL' => $lang['Email'],
				'L_PM' => $lang['PM'],
				'L_POPUP' => $lang['Popup'],
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
				'L_WEBSITE' => $lang['Website'],
				'L_FACEBOOK' => $lang['facebook'],
				'L_FACEBOOK_EXPLAIN' => $lang['facebook_explain'],
				'L_LOCATION' => $lang['Location'],
				'L_OCCUPATION' => $lang['Occupation'],
				//'L_BOARD_LANGUAGE' => $lang['Board_lang'],
				'L_BOARD_STYLE' => $lang['Theme'],
				'L_TIMEZONE' => $lang['Timezone'],
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
				'L_TIME_MODE' => $lang['time_mode'],
				'L_TIME_MODE_TEXT' => $lang['time_mode_text'],
				'L_TIME_MODE_MANUAL' => $lang['time_mode_manual'],
				'L_TIME_MODE_DST' => $lang['time_mode_dst'],
				'L_TIME_MODE_DST_OFF' => $l_time_mode_0,
				'L_TIME_MODE_DST_ON' => $l_time_mode_1,
				'L_TIME_MODE_DST_SERVER' => $l_time_mode_2,
				'L_TIME_MODE_DST_TIME_LAG' => $lang['time_mode_dst_time_lag'],
				'L_TIME_MODE_DST_MN' => $lang['time_mode_dst_mn'],
				'L_TIME_MODE_TIMEZONE' => $lang['time_mode_timezone'],
				'L_TIME_MODE_AUTO' => $lang['time_mode_auto'],
				'L_TIME_MODE_FULL_SERVER' => $l_time_mode_3,
				'L_TIME_MODE_SERVER_PC' => $l_time_mode_4,
				'L_TIME_MODE_FULL_PC' => $l_time_mode_6,
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
				'L_DATE_FORMAT' => $lang['Date_format'],
				'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'],
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
				'L_QUICK_REPLY_PANEL' => $lang['Quick_reply_panel'],
				'L_SHOW_QUICK_REPLY' => $lang['Show_quick_reply'],
				'L_QUICK_REPLY_MODE' => $lang['Quick_reply_mode'],
				'L_QUICK_REPLY_MODE_BASIC' => $lang['Quick_reply_mode_basic'],
				'L_QUICK_REPLY_MODE_ADVANCED' => $lang['Quick_reply_mode_advanced'],
				'L_OPEN_QUICK_REPLY' => $lang['Open_quick_reply'],
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
				 'L_NAME' => $lang['Real_Name'],
				 'L_NEWSLETTER' => $lang['Newsletter'],
				 'L_EXTRA_INFO' => $lang['Extra_Info'],
/*****[END]********************************************
 [ Mod:    YA Merge                            v1.0.0 ]
 ******************************************************/
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],
				'L_INTERESTS' => $lang['Interests'],

/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
				'L_GENDER' =>$lang['Gender'],
				'L_GENDER_MALE' =>$lang['Male'],
				'L_GENDER_FEMALE' =>$lang['Female'],
				'L_GENDER_NOT_SPECIFY' =>$lang['No_gender_specify'],
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
				'L_ENABLE_MASS_PM' =>$lang['Enable_mass_pm'],
				'L_ENABLE_MASS_PM_EXPLAIN' =>$lang['Enable_mass_pm_explain'],
				'L_NO_MASS_PM' => $lang['No_mass_pm'],
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
				'L_ALWAYS_ALLOW_SMILIES' => $lang['Always_smile'],
				'L_ALWAYS_ALLOW_BBCODE' => $lang['Always_bbcode'],
				'L_ALWAYS_ALLOW_HTML' => $lang['Always_html'],
				'L_HIDE_USER' => $lang['Hide_user'],
				'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],
/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
				'L_SHOW_AVATARS' => $lang['Show_avatars'],
				'L_SHOW_SIGNATURES' => $lang['Show_signatures'],
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/

				'L_AVATAR_PANEL' => $lang['Avatar_panel'],
				'L_AVATAR_EXPLAIN' => sprintf($lang['Avatar_explain'], $board_config['avatar_max_width'], $board_config['avatar_max_height'], (round($board_config['avatar_filesize'] / 1024))),
				'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'],
				'L_UPLOAD_AVATAR_URL' => $lang['Upload_Avatar_URL'],
				'L_UPLOAD_AVATAR_URL_EXPLAIN' => $lang['Upload_Avatar_URL_explain'],
				'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
				'L_SHOW_GALLERY' => $lang['View_avatar_gallery'],
				'L_LINK_REMOTE_AVATAR' => $lang['Link_remote_Avatar'],
				'L_LINK_REMOTE_AVATAR_EXPLAIN' => $lang['Link_remote_Avatar_explain'],
				'L_DELETE_AVATAR' => $lang['Delete_Image'],
				'L_CURRENT_IMAGE' => $lang['Current_Image'],

		        'L_SIGNATURE' => $lang['Signature'],
				'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config['max_sig_chars']),
				'L_NOTIFY_ON_REPLY' => $lang['Always_notify'],
				'L_NOTIFY_ON_REPLY_EXPLAIN' => $lang['Always_notify_explain'],
				'L_NOTIFY_ON_PRIVMSG' => $lang['Notify_on_privmsg'],
				'L_POPUP_ON_PRIVMSG' => $lang['Popup_on_privmsg'],
				'L_POPUP_ON_PRIVMSG_EXPLAIN' => $lang['Popup_on_privmsg_explain'],
				'L_PREFERENCES' => $lang['Preferences'],
				'L_PUBLIC_VIEW_EMAIL' => $lang['Public_view_email'],
				'L_ITEMS_REQUIRED' => $lang['Items_required'],
				'L_REGISTRATION_INFO' => $lang['Registration_info'],
				'L_PROFILE_INFO' => $lang['Profile_info'],
				'L_PROFILE_INFO_NOTICE' => $lang['Profile_info_warn'],
				'L_PROFILE_PASSWORD' => $lang['Password_change'],
				'L_EMAIL_ADDRESS' => $lang['Email_address'],

				'L_CONFIRM_CODE_IMPAIRED' => sprintf($lang['Confirm_code_impaired'], '<a href="mailto:' . $board_config['board_email'] . '">', '</a>'),
				'L_CONFIRM_CODE' => $lang['Confirm_code'],
				'L_CONFIRM_CODE_EXPLAIN' => $lang['Confirm_code_explain'],

				'S_ALLOW_AVATAR_UPLOAD' => $board_config['allow_avatar_upload'],
				'S_ALLOW_AVATAR_LOCAL' => $board_config['allow_avatar_local'],
				'S_ALLOW_AVATAR_REMOTE' => $board_config['allow_avatar_remote'],
				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_FORM_ENCTYPE' => $form_enctype,
				'S_PROFILE_ACTION' => append_sid("profile.$phpEx"))
		);

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
		if ( !$board_config['bday_lock'] || $userdata['user_birthday'] == 0 )
		{
			$block = ( $board_config['bday_require'] == TRUE ) ? 'birthday_required' : 'birthday_optional';
			$template->assign_block_vars($block, array());
			$template->birthday_interface();
		}

		if ( $board_config['bday_greeting'] != 0 )
		{
			$template->assign_block_vars('birthdays_greeting',array());
			if ($board_config['bday_greeting'] & (1<<(BIRTHDAY_EMAIL-1)))
			{
				$template->assign_block_vars('birthdays_greeting.birthdays_email',array());
			}
			if ($board_config['bday_greeting'] & (1<<(BIRTHDAY_PM-1)))
			{
				$template->assign_block_vars('birthdays_greeting.birthdays_pm',array());
			}
			if ($board_config['bday_greeting'] & (1<<(BIRTHDAY_POPUP-1)))
			{
				$template->assign_block_vars('birthdays_greeting.birthdays_popup',array());
			}
		}
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

		//
		// This is another cheat using the block_var capability
		// of the templates to 'fake' an IF...ELSE...ENDIF solution
		// it works well :)
		//
		if ( $mode != 'register' )
		{
				if ( $userdata['user_allowavatar'] && ( $board_config['allow_avatar_upload'] || $board_config['allow_avatar_local'] || $board_config['allow_avatar_remote'] ) )
				{
						$template->assign_block_vars('switch_avatar_block', array() );

						if ( $board_config['allow_avatar_upload'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_path'])) )
						{
								if ( !empty($form_enctype) )
								{
										$template->assign_block_vars('switch_avatar_block.switch_avatar_local_upload', array() );
								}
								$template->assign_block_vars('switch_avatar_block.switch_avatar_remote_upload', array() );
						}

						if ( $board_config['allow_avatar_remote'] )
						{
								$template->assign_block_vars('switch_avatar_block.switch_avatar_remote_link', array() );
						}

						if ( $board_config['allow_avatar_local'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_gallery_path'])) )
						{
								$template->assign_block_vars('switch_avatar_block.switch_avatar_local_gallery', array() );
						}
				}
		}
}

$template->pparse('body');

include("includes/page_tail.php");


