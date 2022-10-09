<?php
/***************************************************************************
 *                             admin_xdata_auth.php
 *                            ------------------------
 *   begin                : Monday, Jul 24, 2006
 *   email                : noobarmy@phpbbmodders.com
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['XData']['User_Permissions'] = $filename . '?type=user';
    	$module['XData']['Group_Permissions'] = $filename . '?type=group';

	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// include language file (borrowed mercilessly from CyberAlien's eXtreme Styles MOD)
//
if(!defined('XD_LANG_INCLUDED'))
{
	$xs_lang_file = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_xd.'.$phpEx;
	if( !@file_exists($xs_lang_file) )
	{	// load english version if there is no translation to current language
		$xs_lang_file = $phpbb_root_path . 'language/lang_english/lang_xd.'.$phpEx;
	}
	@include($xs_lang_file);
	define('XD_LANG_INCLUDED', true);
}

/*
 Set mode & type
*/
if( isset( $HTTP_POST_VARS['mode'] ) || isset( $HTTP_GET_VARS['mode'] ) )
{
	$mode = ( isset( $HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
	$mode = '';
}

if( isset( $HTTP_POST_VARS['type'] ) || isset( $HTTP_GET_VARS['type'] ) )
{
	$type = ( isset( $HTTP_POST_VARS['type']) ) ? htmlspecialchars($HTTP_POST_VARS['type']) : htmlspecialchars($HTTP_GET_VARS['type']);
}
else
{
	$type = '';
}

/*
// Begin program
*/
if ($type == 'user')
{
	if ( ( $mode == 'edit' || $mode == 'save' ) && ( isset($HTTP_POST_VARS['username']) || isset($HTTP_GET_VARS[POST_USERS_URL]) || isset( $HTTP_POST_VARS[POST_USERS_URL]) ) )
	{
		$xd_meta = get_xd_metadata();

	    if ( isset($HTTP_POST_VARS['username']) )
		{
			$this_userdata = get_userdata($HTTP_POST_VARS['username'], true);
			if ( !is_array($this_userdata) )
			{
				message_die(GENERAL_MESSAGE, $lang['No_such_user']);
			}
			$user_id = $this_userdata['user_id'];
		}
		else
		{
			$user_id = ( isset($HTTP_POST_VARS[POST_USERS_URL]) ) ? intval($HTTP_POST_VARS[POST_USERS_URL]) : intval($HTTP_GET_VARS[POST_USERS_URL]);
		}

		if ( ! isset($HTTP_POST_VARS['submit']) )
		{
			/*
			 Show the edit form
			*/

			$template->set_filenames( array(
				'body' => 'admin/xd_auth_body.tpl'
				)
			);

			$template->assign_vars( array(
				'L_AUTH_TITLE' => $lang['xd_permissions'],
				'L_USERNAME' => $lang['Username'],
				'L_PERMISSIONS' => $lang['Permissions'],
				'L_AUTH_EXPLAIN' => $lang['xd_permissions_describe'],
				'L_FIELD_NAME' => $lang['field_name'],
				'L_ALLOW' => $lang['Allow'],
				'L_DEFAULT' => $lang['Default'],
				'L_DENY' => $lang['Deny'],
				'L_SUBMIT' => $lang['Submit'],
				'L_RESET' => $lang['Reset'],

				'AUTH_ALLOW' => XD_AUTH_ALLOW,
				'AUTH_DENY' => XD_AUTH_DENY,
				'AUTH_DEFAULT' => XD_AUTH_DEFAULT,

				'USERNAME' => $username,
				'S_HIDDEN_FIELDS' => '<input type="hidden" name="'.POST_USERS_URL.'" value="'.$user_id.'" /><input type="hidden" name="mode" value="save" /><input type="hidden" name="type" value="user" />',
				'S_AUTH_ACTION' => append_sid('admin_xdata_auth.'.$phpEx)
				)
			);

			while ( list($code_name, $meta) = each($xd_meta) )
			{
				$sql = "SELECT xa.auth_value
						FROM " . XDATA_AUTH_TABLE . " xa, " . USER_GROUP_TABLE . " ug
						WHERE xa.field_id = {$meta['field_id']}
							AND xa.group_id = ug.group_id
							AND ug.user_id = {$user_id}";

				if ( ! ( $result = $db->sql_query($sql) ) )
				{
	            	message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_user_auth'], "", __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);

				$auth = isset($row['auth_value']) ? $row['auth_value'] : XD_AUTH_DEFAULT;

				$template->assign_block_vars( 'xdata', array(
					'CODE_NAME' => $code_name,
					'NAME' => $meta['field_name'],

					'ALLOW_CHECKED' => ( ( $auth == XD_AUTH_ALLOW ) ? 'checked="checked" ' : '' ),
					'DENY_CHECKED' => ( ( $auth == XD_AUTH_DENY ) ? 'checked="checked" ' : '' ),
					'DEFAULT_CHECKED' => ( ($auth == XD_AUTH_DEFAULT ) ? 'checked="checked" ' : '')
					)
				);

			}

			$template->pparse('body');
		}
		else
		{
			/*
			 Save the settings
			*/

			$sql = "SELECT g.group_id
					FROM " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug
			        WHERE g.group_id = ug.group_id AND ug.user_id = $user_id";

			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, $lang['XData_error_obtaining_usergroup'], "", __LINE__, __FILE__, $sql);
			}
			$personal_group = $db->sql_fetchrow($result);
			$personal_group = $personal_group['group_id'];

			while ( list($code_name, $meta) = each($xd_meta) )
			{
				$auth = str_replace("\'", "''", htmlspecialchars($HTTP_POST_VARS["xd_$code_name"]) );

	            $sql = "DELETE FROM " . XDATA_AUTH_TABLE . "
					WHERE group_id = $personal_group
					AND field_id = {$meta['field_id']}";

	            if (! $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
				}

				if ( $auth != XD_AUTH_DEFAULT )
				{

					$sql = "INSERT INTO " . XDATA_AUTH_TABLE . "
						(group_id, field_id, auth_value)
						VALUES ({$personal_group}, {$meta['field_id']}, {$auth})";

					if (! $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
					}
				}
			}

		    $message = sprintf($lang['XData_success_updating_permissions'],"<a href=\"" . append_sid("admin_xdata_auth.$phpEx?type=user") . "\">","</a>");
			$message .= sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else
	{
		/*
		 Default user selection box
		*/
		$template->set_filenames(array(
			'body' => 'admin/user_select_body.tpl')
		);

		$template->assign_vars(array(
			'L_USER_TITLE' => $lang['xd_permissions'],
			'L_USER_EXPLAIN' => $lang['xd_permissions_describe'],
			'L_USER_SELECT' => $lang['Select_a_User'],
			'L_LOOK_UP' => $lang['Look_up_user'],
			'L_FIND_USERNAME' => $lang['Find_username'],

			'U_SEARCH_USER' => append_sid($phpbb_root_path . "search.$phpEx?mode=searchuser"),

			'S_USER_ACTION' => append_sid($phpbb_root_path . "admin/admin_xdata_auth.$phpEx?type=user"),
			'S_USER_SELECT' => $select_list
			)
		);

		$template->pparse('body');
	}
}
elseif ($type == 'group')
{
	if ( ( $mode == 'edit' || $mode == 'save' ) && ( isset($HTTP_POST_VARS['group']) || isset($HTTP_GET_VARS[POST_GROUPS_URL]) || isset( $HTTP_POST_VARS[POST_GROUPS_URL]) ) )
	{

    	$xd_meta = get_xd_metadata();

	    if ( isset($HTTP_POST_VARS['group']) )
		{
			$group_id = intval($HTTP_POST_VARS['group']);
		}
		else
		{
			$group_id = ( isset($HTTP_POST_VARS[POST_GROUPS_URL]) ) ? intval($HTTP_POST_VARS[POST_GROUPS_URL]) : intval($HTTP_GET_VARS[POST_GROUPS_URL]);
		}

		if ( ! isset($HTTP_POST_VARS['submit']) )
		{
			/*
			 Show the edit form
			*/

			$template->set_filenames( array(
				'body' => 'admin/xd_auth_body.tpl'
				)
			);

			$sql = "SELECT group_name FROM " . GROUPS_TABLE . "
			        WHERE group_id = {$group_id}";

			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, $lang['XData_error_obtaining_group_data'], "", __LINE__, __FILE__, $sql);
			}
			$group_name = $db->sql_fetchrow($result);
			$group_name = $group_name['group_name'];

			$template->assign_vars( array(
				'L_AUTH_TITLE' => $lang['xd_group_permissions'],
				'L_USERNAME' => $lang['group_name'],
				'L_PERMISSIONS' => $lang['Permissions'],
				'L_AUTH_EXPLAIN' => $lang['xd_group_permissions_describe'],
				'L_FIELD_NAME' => $lang['field_name'],
				'L_ALLOW' => $lang['Allow'],
				'L_DEFAULT' => $lang['Default'],
				'L_DENY' => $lang['Deny'],
				'L_SUBMIT' => $lang['Submit'],
				'L_RESET' => $lang['Reset'],

				'AUTH_ALLOW' => XD_AUTH_ALLOW,
				'AUTH_DENY' => XD_AUTH_DENY,
				'AUTH_DEFAULT' => XD_AUTH_DEFAULT,

				'USERNAME' => $group_name,
				'S_HIDDEN_FIELDS' => '<input type="hidden" name="'.POST_GROUPS_URL.'" value="'.$group_id.'" /><input type="hidden" name="mode" value="save" /><input type="hidden" name="type" value="group" />',
				'S_AUTH_ACTION' => append_sid('admin_xdata_auth.'.$phpEx)
				)
			);

			while ( list($code_name, $meta) = each($xd_meta) )
			{
				$sql = "SELECT xa.auth_value FROM " . XDATA_AUTH_TABLE . " xa
					WHERE xa.field_id = {$meta['field_id']}
					AND xa.group_id = {$group_id}";

				if ( ! ( $result = $db->sql_query($sql) ) )
				{
	            	message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_user_auth'], "", __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);

				$auth = isset($row['auth_value']) ? $row['auth_value'] : XD_AUTH_DEFAULT;

				$template->assign_block_vars( 'xdata', array(
					'CODE_NAME' => $code_name,
					'NAME' => $meta['field_name'],

					'ALLOW_CHECKED' => ( ( $auth == XD_AUTH_ALLOW ) ? 'checked="checked" ' : '' ),
					'DENY_CHECKED' => ( ( $auth == XD_AUTH_DENY ) ? 'checked="checked" ' : '' ),
					'DEFAULT_CHECKED' => ( ($auth == XD_AUTH_DEFAULT ) ? 'checked="checked" ' : '')
					)
				);

			}

			$template->pparse('body');
		}
		else
		{
        		/*
			 Save the settings
			*/

			while ( list($code_name, $meta) = each($xd_meta) )
			{
				$auth = htmlspecialchars($HTTP_POST_VARS["xd_$code_name"]);

	            $sql = "DELETE FROM " . XDATA_AUTH_TABLE . "
					WHERE group_id = $group_id
					AND field_id = {$meta['field_id']}";

	            if (! $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
				}

				if ( $auth != XD_AUTH_DEFAULT )
				{

					$sql = "INSERT INTO " . XDATA_AUTH_TABLE . "
						(group_id, field_id, auth_value)
						VALUES ({$group_id}, {$meta['field_id']}, {$auth})";

					if (! $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, $lang['XData_error_updating_auth'], "", __LINE__, __FILE__, $sql);
					}
				}
			}

		    $message = sprintf($lang['XData_success_updating_permissions'],"<a href=\"" . append_sid("admin_xdata_auth.$phpEx?type=user") . "\">","</a>");
			$message .= sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else
	{
    		/*
		 Select a user/group

		include('./page_header_admin.'.$phpEx);
		*/
		$template->set_filenames( array('body' => 'admin/auth_select_body.tpl') );

		$sql = "SELECT group_id, group_name
			FROM " . GROUPS_TABLE . "
			WHERE group_single_user <> " . TRUE;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, $lang['XData_error_obtaining_group_data'], "", __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$select_list = '<select name="' . POST_GROUPS_URL . '">';
			do
			{
				$select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
			}
			while ( $row = $db->sql_fetchrow($result) );
			$select_list .= '</select>';
		}

		$template->assign_vars(array(
			'S_AUTH_SELECT' => $select_list)
		);

		$s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="type" value="group" />';

		$template->assign_vars(array(
			'L_AUTH_TITLE' => $lang['XD_auth_Control_Group'],
			'L_AUTH_EXPLAIN' => $lang['XD_roup_auth_explain'],
			'L_AUTH_SELECT' => $lang['Select_a_Group'],
			'L_LOOK_UP' => $lang['Look_up_Group'],

			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_AUTH_ACTION' => append_sid("admin_xdata_auth.$phpEx"))
		);

        $template->pparse('body');
	}
}

include('./page_footer_admin.'.$phpEx);

?>