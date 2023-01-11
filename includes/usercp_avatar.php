<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                             usercp_avatar.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: usercp_avatar.php,v 1.8.2.21 2005/07/19 20:01:16 acydburn Exp
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
-=[Mod]=-
	  Super Quick Reply                        v1.3.2       09/08/2005
	  Force Word Wrapping - Configurator       v1.0.16      06/15/2005
	  Custom mass PM                           v1.4.7       07/04/2005
	  Advanced Time Management                 v2.2.0       07/26/2005
	  YA Merge                                 v1.0.0       07/28/2005
	  XData                                    v1.0.3       02/08/2007
	  Hide Images                              v1.0.0       09/02/2005
	  Member Country Flags                     v2.0.7
	  Gender                                   v1.2.6
	  Birthdays                                v3.0.0
-=[Last Update]=-
      10/05/2022 1:05 am Ernest Allen Buffington	  
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

function check_image_type(&$type, &$error, &$error_msg)
{
		global $lang;

		switch( $type )
		{
				case 'jpeg':
				case 'pjpeg':
				case 'jpg':
						return '.jpg';
						break;
				case 'gif':
						return '.gif';
						break;
				case 'png':
						return '.png';
						break;
		        case 'webp':
						return '.webp';
						break;
				default:
						$error = true;
						$error_msg = (!empty($error_msg)) ? $error_msg . '<br />' . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
						break;
		}

		return false;
}

function user_avatar_delete($avatar_type, $avatar_file)
{
		global $board_config, $userdata;
	    $avatar_file = basename($avatar_file);

		if($avatar_type == USER_AVATAR_UPLOAD && !empty($avatar_file) )
		{
				if (file_exists(phpbb_realpath('./' . $board_config['avatar_path'] . '/' . $avatar_file)) )
				{
					unlink('./' . $board_config['avatar_path'] . '/' . $avatar_file);
				}
		}

		return ", user_avatar = '', user_avatar_type = " . USER_AVATAR_NONE;
}

function user_avatar_gallery($mode, &$error, &$error_msg, $avatar_filename, $avatar_category)
{
	global $board_config;

	$avatar_filename = phpbb_ltrim(basename($avatar_filename), "'");
	$avatar_category = phpbb_ltrim(basename($avatar_category), "'");

	if(!preg_match('/(\.gif$|\.png$|\.jpg|\.webp|\.jpeg)$/is', $avatar_filename))
	{
		return '';
	}

	if (empty($avatar_filename) || empty($avatar_category))
	{
		return '';
	}

	if (file_exists(phpbb_realpath($board_config['avatar_gallery_path'] . '/' . $avatar_category . '/' . $avatar_filename)) && ($mode == 'editprofile') )
	{
		$return = ", user_avatar = '" . str_replace("\'", "''", $avatar_category . '/' . $avatar_filename) . "', user_avatar_type = " . USER_AVATAR_GALLERY;
	}
	else
	{
		$return = '';
	}
	return $return;
}

function user_avatar_url($mode, &$error, &$error_msg, $avatar_filename)
{
	global $lang;

		if(!preg_match('#^(http)|(ftp):\/\/#i', $avatar_filename) )
		{
				$avatar_filename = 'http://' . $avatar_filename;
		}

		$avatar_filename = substr($avatar_filename, 0, 100);

		if(!preg_match("#^((ht|f)tp://)([^ \?&=\#\"\n\r\t<]*?(\.(jpg|jpeg|webp|gif|png))$)#is", $avatar_filename) )
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Wrong_remote_avatar_format'] : $lang['Wrong_remote_avatar_format'];
			return;
		}

		return ( $mode == 'editprofile' ) ? ", user_avatar = '" . str_replace("\'", "''", $avatar_filename) . "', user_avatar_type = " . USER_AVATAR_REMOTE : '';

}

function user_avatar_upload($mode, $avatar_mode, &$current_avatar, &$current_type, &$error, &$error_msg, $avatar_filename, $avatar_realname, $avatar_filesize, $avatar_filetype)
{
	global $board_config, $lang;

	function getimg($url) 
	{         
	    $headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';              
	    $headers[] = 'Connection: Keep-Alive';         
	    $headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';         
	    $user_agent = 'php';         
	    $process = curl_init($url);         
	    curl_setopt($process, CURLOPT_HTTPHEADER, $headers);         
	    curl_setopt($process, CURLOPT_HEADER, 0);         
	    curl_setopt($process, CURLOPT_USERAGENT, $user_agent); //check here         
	    curl_setopt($process, CURLOPT_TIMEOUT, 30);         
	    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);         
	    curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);         
	    $return = curl_exec($process);         
	    curl_close($process);         
	    return $return;     
	}

	$error = FALSE;

	$allowedAvatarTypes = ['image/gif', 'image/x-bitmap', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/webp'];

	$avatar_image 	= getimagesize( $avatar_filename );
	$imageMime      = $avatar_image['mime'];

	if($avatar_mode == 'remote' ):

		$headers 	   = get_headers( $avatar_filename, TRUE );
		$imageFilesize = $headers['Content-Length'];
		// $imageMime     = $headers['Content-Type'];

	else:

		$imageFilesize = filesize( $avatar_filename );
		// $imageMime     = $avatar_image['mime'];

	endif;

	# Give the copied avatar a new unique name, Should prevent overwriting other users avatars if named similarly.
	$new_filename = uniqid(rand()).'.'.get_file_extension($avatar_filename);

	if ( $imageFilesize <= $board_config['avatar_filesize'] && $imageFilesize > 0 )
	{
		if( $avatar_mode == 'remote' ):

			if ( $avatar_image[0] > 0 && $avatar_image[1] > 0 && $avatar_image[0] <= $board_config['avatar_max_width'] && $avatar_image[1] <= $board_config['avatar_max_height'] && in_array($imageMime, $allowedAvatarTypes) ):

				if ( $mode == 'editprofile' && $current_type == USER_AVATAR_UPLOAD && !empty($current_avatar) )
				{
					user_avatar_delete($current_type, $current_avatar);
				}

				$image = getimg($avatar_filename);
				file_put_contents('./' . trailingslashit($board_config['avatar_path']).$new_filename, $image);

			else:

				$l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);
				$error = true;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;

			endif;

		else:

			if (!is_uploaded_file($avatar_filename))
			{
				message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
			}

			move_uploaded_file($avatar_filename, trailingslashit($board_config['avatar_path']).$new_filename);

		endif;
		$avatar_sql = ( $mode == 'editprofile' ) ? ", user_avatar = '$new_filename', user_avatar_type = " . USER_AVATAR_UPLOAD : "'$new_filename', " . USER_AVATAR_UPLOAD;
	}
	else
	{
		$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));
		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
		return;
	}

	return $avatar_sql;

}

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
function display_avatar_gallery($mode, 
                            $category, 
							 $user_id, 
							   $email, 
					   $current_email, 
					           $coppa, 
							$username, 
					    $new_password, 
						$cur_password, 
				    $password_confirm, 
					         $website, 
							$location, 
						   $user_flag, 
						  $occupation, 
						   $interests, 
						 $glance_show, 
						   $signature, 
						   $viewemail, 
						    $notifypm, 
					   $allow_mass_pm, 
					        $popup_pm, 
						 $notifyreply, 
						   $attachsig, 
						   $allowhtml, 
						 $allowbbcode, 
						$allowsmilies, 
						 $showavatars, 
					  $showsignatures, 
					      $hideonline, 
						       $style, 
							    $wrap, 
							$language, 
						  $bday_month, 
						    $bday_day, 
						   $bday_year, 
					$birthday_display, 
				   $birthday_greeting, 
				            $timezone, 
						   $time_mode, 
						$dst_time_lag, 
						  $dateformat, 
					 $show_quickreply, 
					 $quickreply_mode, 
				$user_open_quickreply, 
				          $session_id, 
				 string $xdata = null, 
					           $rname, 
						  $extra_info, 
						  $newsletter, 
						 $hide_images, 
						      $gender, 
							$facebook)
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
{
		global $board_config, $db, $template, $lang, $images, $theme, $phpbb_root_path, $phpEx, $userdata;

		$dir = opendir($board_config['avatar_gallery_path']);

		$avatar_images = array();
		
		while( $file = readdir($dir) )
		{
				if( $file != '.' && $file != '..' && !is_file($board_config['avatar_gallery_path'] . '/' . $file) && !is_link($board_config['avatar_gallery_path'] . '/' . $file) )
				{
						$sub_dir = opendir($board_config['avatar_gallery_path'] . '/' . $file);

						$avatar_row_count = 0;
						$avatar_col_count = 0;
						while( $sub_file = @readdir($sub_dir) )
						{
								if( preg_match('/(\.gif$|\.webp$|\.png$|\.jpg|\.jpeg)$/is', $sub_file) )
								{
										$avatar_images[$file][$avatar_row_count][$avatar_col_count] = $sub_file;
										$avatar_name[$file][$avatar_row_count][$avatar_col_count] = ucfirst(str_replace("_", " ", preg_replace('/^(.*)\..*$/', '\1', $sub_file)));

										$avatar_col_count++;
										if( $avatar_col_count == 5 )
										{
												$avatar_row_count++;
												$avatar_col_count = 0;
										}
								}
						}
				}
		}

		closedir($dir);

		ksort($avatar_images);
		reset($avatar_images);

		if( empty($category) )
		{
				//list($category, ) = each($avatar_images);
                $category = key($avatar_images);
		}
		reset($avatar_images);

		$s_categories = '<select name="avatarcategory">';
        
		foreach (array_keys($avatar_images) as $key) {
          $selected = ( $key == $category ) ? ' selected="selected"' : '';
            if( (is_countable($avatar_images[$key]) ? count($avatar_images[$key]) : 0) > 0 )
 			{
			  $s_categories .= '<option value="' . $key . '"' . $selected . '>' . ucfirst((string) $key) . '</option>';
			}
        }

		$s_categories .= '</select>';

		$s_colspan = 0;
		
		for($i = 0; $i < count($avatar_images[$category]); $i++)
		{
				$template->assign_block_vars("avatar_row", array());

				$s_colspan = max($s_colspan, count($avatar_images[$category][$i]));

				for($j = 0; $j < count($avatar_images[$category][$i]); $j++)
				{
						$template->assign_block_vars('avatar_row.avatar_column', array(
								"AVATAR_IMAGE" => $board_config['avatar_gallery_path'] . '/' . $category . '/' . $avatar_images[$category][$i][$j],
								"AVATAR_NAME" => $avatar_name[$category][$i][$j])
						);

						$template->assign_block_vars('avatar_row.avatar_option_column', array(
								"S_OPTIONS_AVATAR" => $avatar_images[$category][$i][$j])
						);
				}
		}

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 [ Mod:     Advanced Time Management           v2.2.0 ]
 [ Mod:     YA Merge                           v1.0.0 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Mod:     Hide Images                        v1.0.0 ]
 [ Mod:     Member Country Flags               v2.0.7 ]
 [ Mod:     Gender                             v1.2.6 ]
 [ Mod:     Birthdays                          v3.0.0 ]
 ******************************************************/
		$params = array('coppa', 'user_id', 'username', 'email', 'current_email', 'cur_password', 'new_password', 'password_confirm', 'website', 'location', 'user_flag', 'occupation', 'interests', 'glance_show', 'signature', 'viewemail', 'notifypm', 'allow_mass_pm', 'popup_pm', 'notifyreply', 'attachsig', 'allowhtml', 'allowbbcode', 'allowsmilies', 'showavatars', 'showsignatures', 'hideonline', 'style', 'wrap', 'language', 'bday_month', 'bday_day', 'bday_year', 'birthday_display', 'birthday_greeting', 'timezone', 'time_mode', 'dst_time_lag', 'dateformat', 'show_quickreply', 'quickreply_mode', 'rname', 'extra_info', 'newsletter', 'hide_images', 'user_open_quickreply', 'gender', 'facebook');
/*****[END]********************************************
 [ Mod:     Birthdays                          v3.0.0 ]
 [ Mod:     Gender                             v1.2.6 ]
 [ Mod:     Member Country Flags               v2.0.7 ]
 [ Mod:     Hide Images                        v1.0.0 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Mod:     YA Merge                           v1.0.0 ]
 [ Mod:     Advanced Time Management           v2.2.0 ]
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

		$s_hidden_vars  = '<input type="hidden" name="sid" value="' . $session_id . '" />';
		$s_hidden_vars .= '<input type="hidden" name="agreed" value="true" />';
		$s_hidden_vars .= '<input type="hidden" name="avatarcatname" value="' . $category . '" />';

		for($i = 0; $i < count($params); $i++)
		{
			$s_hidden_vars .= '<input type="hidden" name="' . $params[$i] . '" value="' . ${$params[$i]} . '" />';
		}

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
		 if (!is_array($xdata))
 		{
			$xdata = [];
 		}
 
 		$xd_meta = get_xd_metadata();
		foreach (array_keys($xd_meta) as $code_name) {
      if ( isset($xdata[$code_name]) )
   			{
   				$s_hidden_vars .= '<input type="hidden" name="'. $code_name . '" value="' . str_replace('"', '&quot;', (string) $xdata[$code_name]) . '" />';
   			}
  }

/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

		$template->assign_vars(array(
				'L_USERID' => $s_hidden_vars,
				'L_AVATAR_GALLERY' => $lang['Avatar_gallery'],
				'L_SELECT_AVATAR' => $lang['Select_avatar'],
				'L_RETURN_PROFILE' => $lang['Return_profile'],
				'L_CATEGORY' => $lang['Select_category'],

				'S_CATEGORY_SELECT' => $s_categories,
				'S_COLSPAN' => $s_colspan,
				'S_PROFILE_ACTION' => append_sid("profile.$phpEx?mode=$mode"),
				'S_HIDDEN_FIELDS' => $s_hidden_vars)
		);

		return;
}

?>