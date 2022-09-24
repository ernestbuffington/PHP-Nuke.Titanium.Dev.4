<?php
/***************************************************************************
 *                              admin_flags.php
 *                            -------------------
 *   begin                : Thursday, February 6, 2003
 *   written by Nuttzy
 *
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

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$titanium_module['Users']['Flags'] = "$file";
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

if( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ($HTTP_GET_VARS['mode']) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
}
else 
{
	//
	// These could be entered via a form button
	//
	if( isset($HTTP_POST_VARS['add']) )
	{
		$mode = "add";
	}
	else if( isset($HTTP_POST_VARS['save']) )
	{
		$mode = "save";
	}
	else
	{
		$mode = "";
	}
}

// if we are are doing a delete make sure we got confirmation
if ( $mode == 'do_delete')
{
	// user bailed out, return to flag admin
	if ( !$HTTP_POST_VARS['confirm'] )
	{
		$mode = '' ;
	}
}


if( $mode != "" )
{
	if( $mode == "edit" || $mode == "add" )
	{
		//
		// They want to add a new flag, show the form.
		//
		$flag_id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : 0;
		
		$s_hidden_fields = "";
		
		if( $mode == "edit" )
		{
			if( empty($flag_id) )
			{
				message_die(GENERAL_MESSAGE, $titanium_lang['Must_select_flag']);
			}

			$sql = "SELECT * FROM " . FLAG_TABLE . "
				WHERE flag_id = $flag_id";
			if(!$result = $titanium_db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Couldn't obtain flag data", "", __LINE__, __FILE__, $sql);
			}
			
			$flag_info = $titanium_db->sql_fetchrow($result);
			$s_hidden_fields .= '<input type="hidden" name="id" value="' . $flag_id . '" />';

		}

		$s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';

		$phpbb2_template->set_filenames(array(
			"body" => "admin/flags_edit_body.tpl")
		);

		$phpbb2_template->assign_vars(array(
			"FLAG" => $flag_info['flag_name'],
			"IMAGE" => ( $flag_info['flag_image'] != "" ) ? $flag_info['flag_image'] : "",
			// "IMAGE_DISPLAY" => ( $flag_info['flag_image'] != "" ) ? '<img src="../../../images/flags/' . $flag_info['flag_image'] . '" />' : "",
			"IMAGE_DISPLAY" => str_replace(array('.png',' '),array('','_'),$flag_rows[$i]['flag_image']),
			
			"L_FLAGS_TITLE" => $titanium_lang['Flags_title'],
			"L_FLAGS_TEXT" => $titanium_lang['Flags_explain'],
			"L_FLAG_NAME" => $titanium_lang['Flag_name'],
			"L_FLAG_IMAGE" => $titanium_lang['Flag_image'],
			"L_FLAG_IMAGE_EXPLAIN" => $titanium_lang['Flag_image_explain'],
			"L_SUBMIT" => $titanium_lang['Submit'],
			"L_RESET" => $titanium_lang['Reset'],
			
			"S_FLAG_ACTION" => append_titanium_sid("admin_flags.$phpEx"),
			"S_HIDDEN_FIELDS" => $s_hidden_fields)
		);
		
	}
	else if( $mode == "save" )
	{
		//
		// Ok, they sent us our info, let's update it.
		//
		
		$flag_id = ( isset($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : 0;
		$flag_name = ( isset($HTTP_POST_VARS['title']) ) ? trim($HTTP_POST_VARS['title']) : "";
		$flag_image = ( (isset($HTTP_POST_VARS['flag_image'])) ) ? trim($HTTP_POST_VARS['flag_image']) : "";

		if( $flag_name == "" )
		{
			message_die(GENERAL_MESSAGE, $titanium_lang['Must_select_flag']);
		}

		//
		// The flag image has to be a jpg, gif or png
		//
		if($flag_image != "")
		{
			if ( !preg_match("/(\.gif|\.png|\.jpg)$/is", $flag_image))
			{
				$flag_image = "";
			}
		}

		if ($flag_id)
		{
			$sql = "UPDATE " . FLAG_TABLE . "
				SET flag_name = '" . str_replace("\'", "''", $flag_name) . "', flag_image = '" . str_replace("\'", "''", $flag_image) . "'
				WHERE flag_id = $flag_id";

			$message = $titanium_lang['Flag_updated'];
		}
		else
		{
			$sql = "INSERT INTO " . FLAG_TABLE . " (flag_name, flag_image)
				VALUES ('" . str_replace("\'", "''", $flag_name) . "', '" . str_replace("\'", "''", $flag_image) . "')";

			$message = $titanium_lang['Flag_added'];
		}
		
		if( !$result = $titanium_db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't update/insert into flags table", "", __LINE__, __FILE__, $sql);
		}

		$message .= "<br /><br />" . sprintf($titanium_lang['Click_return_flagadmin'], "<a href=\"" . append_titanium_sid("admin_flags.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);

	}
	else if( $mode == 'delete' )
	{
		if( isset($HTTP_POST_VARS['id']) || isset($HTTP_GET_VARS['id']) )
		{
			$flag_id = ( isset($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : intval($HTTP_GET_VARS['id']);
		}
		else
		{
			$flag_id = 0;
		}
		$hidden_fields = '<input type="hidden" name="id" value="' . $flag_id . '" /><input type="hidden" name="mode" value="do_delete" />';

		//
		// Set template files
		//
		$phpbb2_template->set_filenames(array(
			'body' => 'confirm_body.tpl')
		);

		$phpbb2_template->assign_vars(array(
			'MESSAGE_TITLE' => $titanium_lang['Flag_confirm'],
			'MESSAGE_TEXT' => $titanium_lang['Confirm_delete_flag'],

			'L_YES' => $titanium_lang['Yes'],
			'L_NO' => $titanium_lang['No'],

			'S_CONFIRM_ACTION' => append_titanium_sid("admin_flags.$phpEx"),
			'S_HIDDEN_FIELDS' => $hidden_fields)
		);

	}
	else if( $mode == 'do_delete' )
	{

		//
		// Ok, they want to delete their flag
		//
		
		if( isset($HTTP_POST_VARS['id']) || isset($HTTP_GET_VARS['id']) )
		{
			$flag_id = ( isset($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : intval($HTTP_GET_VARS['id']);
		}
		else
		{
			$flag_id = 0;
		}
		
		if( $flag_id )
		{
			// get the doomed flag's info
			$sql = "SELECT * FROM " . FLAG_TABLE . " 
				WHERE flag_id = $flag_id" ;
			if( !$result = $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't get flag data", "", __LINE__, __FILE__, $sql);
			}
			$row = $titanium_db->sql_fetchrow($result);
			$flag_image = $row['flag_image'] ;


			// delete the flag
			$sql = "DELETE FROM " . FLAG_TABLE . "
				WHERE flag_id = $flag_id";
			
			if( !$result = $titanium_db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete flag data", "", __LINE__, __FILE__, $sql);
			}


			// update the users who where using this flag			
			$sql = "UPDATE " . USERS_TABLE . " 
				SET user_from_flag = 'blank.gif' 
				WHERE user_from_flag = '$flag_image'";
			if( !$result = $titanium_db->sql_query($sql) ) 
			{
				message_die(GENERAL_ERROR, $titanium_lang['No_update_flags'], "", __LINE__, __FILE__, $sql);
			}

			$message = $titanium_lang['Flag_removed'] . "<br /><br />" . sprintf($titanium_lang['Click_return_flagadmin'], "<a href=\"" . append_titanium_sid("admin_flags.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

		}
		else
		{
			message_die(GENERAL_MESSAGE, $titanium_lang['Must_select_flag']);
		}
	}
	else
	{
		//
		// They didn't feel like giving us any information. Oh, too bad, we'll just display the
		// list then...
		//
		$phpbb2_template->set_filenames(array(
			"body" => "admin/flags_list_body.tpl")
		);
		
		$sql = "SELECT * FROM " . FLAG_TABLE . "
			ORDER BY flag_name";
		if( !$result = $titanium_db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain flags data", "", __LINE__, __FILE__, $sql);
		}
		
		$flag_rows = $titanium_db->sql_fetchrowset($result);
		$flag_count = count($flag_rows);
		
		$phpbb2_template->assign_vars(array(
			"L_FLAGS_TITLE" => $titanium_lang['Flags_title'],
			"L_FLAGS_TEXT" => $titanium_lang['Flags_explain'],
			"L_FLAG" => $titanium_lang['Flag_name'],

			"L_EDIT" => $titanium_lang['Edit'],
			"L_DELETE" => $titanium_lang['Delete'],
			"L_ADD_FLAG" => $titanium_lang['Add_new_flag'],
			"L_ACTION" => $titanium_lang['Action'],
			
			"S_FLAGS_ACTION" => append_titanium_sid("admin_flags.$phpEx"))
		);
		
		for( $i = 0; $i < $flag_count; $i++)
		{
			$flag = $flag_rows[$i]['flag_name'];
			$flag_id = $flag_rows[$i]['flag_id'];
			
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	
			$phpbb2_template->assign_block_vars("flags", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,

				"FLAG" => $flag,
				// "IMAGE_DISPLAY" => ( $flag_rows[$i]['flag_image'] != "" ) ? '<img src="../../../images/flags/' . $flag_rows[$i]['flag_image'] . '" />' : "",
				"IMAGE_DISPLAY" => str_replace(array('.png',' '),array('','_'),$flag_rows[$i]['flag_image']),

				"U_FLAG_EDIT" => append_titanium_sid("admin_flags.$phpEx?mode=edit&amp;id=$flag_id"),
				"U_FLAG_DELETE" => append_titanium_sid("admin_flags.$phpEx?mode=delete&amp;id=$flag_id"))
			);
		}
	}
}
else
{
	//
	// Show the default page
	//
	$phpbb2_template->set_filenames(array(
		"body" => "admin/flags_list_body.tpl")
	);
	
	$sql = "SELECT * FROM " . FLAG_TABLE . "
		ORDER BY flag_name ASC";
	if( !$result = $titanium_db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain flags data", "", __LINE__, __FILE__, $sql);
	}
	$flag_count = $titanium_db->sql_numrows($result);

	$flag_rows = $titanium_db->sql_fetchrowset($result);
	
	$phpbb2_template->assign_vars(array(
		"L_FLAGS_TITLE" => $titanium_lang['Flags_title'],
		"L_FLAGS_TEXT" => $titanium_lang['Flags_explain'],
		"L_FLAG" => $titanium_lang['Flag_name'],
		"L_FLAG_PIC" => $titanium_lang['Flag_pic'],
		"L_EDIT" => $titanium_lang['Edit'],
		"L_DELETE" => $titanium_lang['Delete'],
		"L_ADD_FLAG" => $titanium_lang['Add_new_flag'],
		"L_ACTION" => $titanium_lang['Action'],
		
		"S_FLAGS_ACTION" => append_titanium_sid("admin_flags.$phpEx"))
	);
	
	for($i = 0; $i < $flag_count; $i++)
	{
		$flag = $flag_rows[$i]['flag_name'];
		$flag_id = $flag_rows[$i]['flag_id'];
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$phpbb2_template->assign_block_vars("flags", array(
			"ROW_COLOR" => "#" . $row_color,
			"ROW_CLASS" => $row_class,
			"FLAG" => $flag,
			// "IMAGE_DISPLAY" => ( $flag_rows[$i]['flag_image'] != "" ) ? '<img src="../../../images/flags/' . $flag_rows[$i]['flag_image'] . '" />' : "",
			"IMAGE_DISPLAY" => str_replace(array('.png',' '),array('','_'),$flag_rows[$i]['flag_image']),

			"U_FLAG_EDIT" => append_titanium_sid("admin_flags.$phpEx?mode=edit&amp;id=$flag_id"),
			"U_FLAG_DELETE" => append_titanium_sid("admin_flags.$phpEx?mode=delete&amp;id=$flag_id"))
		);
	}
}

$phpbb2_template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>
