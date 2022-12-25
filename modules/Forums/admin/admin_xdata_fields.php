<?php

/**
 * admin_xdata_fields.php
 *
 * @package xData
 * @author Noobarmy < noobarmy@phpbbmodders.net > (Anthony Chu)
 *
 */

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['XData']['Manage_Fields'] = $file;
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require(__DIR__ . '/pagestart.' . $phpEx);
include(__DIR__ . '/../../../includes/functions_admin.'.$phpEx);

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
 Mode setting
*/
if( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? htmlspecialchars((string) $_POST['mode']) : htmlspecialchars((string) $_GET['mode']);
}
else
{
	$mode = "view";
}

//
// Get the metadata
//
$xd_meta = get_xd_metadata();

/*
 Main program
*/
switch ($mode)
{
	case 'up':
	case 'down':

		if ( ! isset($_GET['name']) )
		{
			message_die(GENERAL_ERROR, $lang['XData_no_field_selected']);
		}
		else
		{
			$name = htmlspecialchars((string) $_GET['name']);

			if ( ! isset($xd_meta[$name]) )
			{
				message_die(GENERAL_ERROR, $lang['XData_field_non_existant']);
			}
		}

		$swap1 = $xd_meta[$name];

		$sql = "SELECT field_id, field_order
			FROM " . XDATA_FIELDS_TABLE ."
			WHERE field_order " . ( ($mode == 'up') ? '<' : '>' ) . $swap1['field_order'] . "
			ORDER BY field_order " . ( ($mode == 'up') ? 'DESC' : 'ASC' ) . "
			LIMIT 1";

		if ( !( $result = $db->sql_query($sql) ) )
		{
			message_die(GENERAL_ERROR, $lang['XData_unable_to_switch_fields'], '', __LINE__, __FILE__, $sql);
		}

		$swap2 = $db->sql_fetchrow($result);

		if ($swap1 && $swap2)
		{
			$sql = "UPDATE " . XDATA_FIELDS_TABLE . "
				SET field_order = " . $swap2['field_order'] . "
				WHERE field_id = " . $swap1['field_id'];

			if ( ! $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['XData_unable_to_switch_fields'], '', __LINE__, __FILE__, $sql);
			}

		    $sql = "UPDATE " . XDATA_FIELDS_TABLE . "
				SET field_order = " . $swap1['field_order'] . "
				WHERE field_id = " . $swap2['field_id'];

			if ( ! $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['XData_unable_to_switch_fields'], '', __LINE__, __FILE__, $sql);
			}
		}

		$mode = 'view';
		$xd_meta = get_xd_metadata(true);
		break;

	case 'edit':

    	if( isset($_POST['name']) || isset($_GET['name']) )
		{
			$name = ( isset($_POST['name']) ) ? htmlspecialchars((string) $_POST['name']) : htmlspecialchars((string) $_GET['name']);
		}
		else
		{
			message_die(GENERAL_ERROR, 'No field was specified.');
		}

		if ( ! isset($xd_meta[$name]) )
		{
			message_die(GENERAL_ERROR, 'That field does not exist.');
		}

		if ( ! isset($_POST['submit']) )
		{
			/*
			Show the edit form
			*/

			$meta = $xd_meta[$name];

			if ($meta['field_type'] != 'special')
			{
				$template->set_filenames( ['body' => 'admin/xd_edit_body.tpl'] );
			}
			else
			{
				$template->set_filenames( ['body' => 'admin/xd_edit_body_limited.tpl'] );
			}

			switch ( $meta['field_regexp'] )
			{
				case '':
										$regexp_none = true;
				break;
				case XD_REGEXP_NUMBERS:
										$regexp_numbers = true;
				break;
				case XD_REGEXP_LETTERS:
										$regexp_letters = true;
				break;
				default:
										$regexp_custom = true;
				break;
			}

			$manditory = (isset($meta['manditory'])) ? (int) $meta['manditory'] : 0;

			$template->assign_vars(['NAME' => $meta['field_name'], 'CODE_NAME' => $meta['code_name'], 'DESCRIPTION' => $meta['field_desc'], 'TYPE' => $meta['field_type'], 'LENGTH' => $meta['field_length'], 'VALUES' => $meta['field_values'], 'MANDITORY_YES_CHECKED' => ($manditory == 1) ? ' checked="checked"' : '', 'MANDITORY_NO_CHECKED' => ($manditory == 0) ? ' checked="checked"' : '', 'REGEXP_NONE_CHECKED' => ($regexp_none) ? ' checked="checked"': '', 'REGEXP_NUMBERS_CHECKED' => ( $regexp_numbers ) ? ' checked="checked"' : '', 'REGEXP_LETTERS_CHECKED' => ( $regexp_letters ) ? ' checked="checked"' : '', 'REGEXP_CUSTOM_CHECKED' => ( $regexp_custom ) ? ' checked="checked"' : '', 'REGEXP_CUSTOM' => ( $regexp_custom ) ? $meta['field_regexp'] : '', 'TEXT_SELECTED' => ( $meta['field_type'] == 'text' ) ? ' selected="selected"' : '', 'TEXTAREA_SELECTED' => ( $meta['field_type'] == 'textarea' ) ? ' selected="selected"' : '', 'RADIO_SELECTED' => ( $meta['field_type'] == 'radio' ) ? ' selected="selected"' : '', 'SELECT_SELECTED' => ( $meta['field_type'] == 'select' ) ? ' selected="selected"' : '', 'CHECKBOX_SELECTED' => ( $meta['field_type'] == 'checkbox' ) ? ' selected="selected"' : '', 'CUSTOM_SELECTED' => ( $meta['field_type'] == 'custom' ) ? ' selected="selected"' : '', 'DATE_SELECTED' => ( $meta['field_type'] == 'date' ) ? ' selected="selected"' : '', 'DEFAULT_AUTH_ALLOW_CHECKED' => ( $meta['default_auth'] == 1 ) ? ' checked="checked"' : '', 'DEFAULT_AUTH_DENY_CHECKED' => ( $meta['default_auth'] == 0 ) ? ' checked="checked"' : '', 'DISPLAY_REGISTER_NORMAL_CHECKED' => ( $meta['display_register'] == XD_DISPLAY_NORMAL ) ? ' checked="checked"' : '', 'DISPLAY_REGISTER_NONE_CHECKED' => ( $meta['display_register'] == XD_DISPLAY_NONE ) ? ' checked="checked"' : '', 'DISPLAY_REGISTER_ROOT_CHECKED' => ( $meta['display_register'] == XD_DISPLAY_ROOT ) ? ' checked="checked"' : '', 'DISPLAY_POSTING_NORMAL_CHECKED' => ( $meta['display_posting'] == XD_DISPLAY_NORMAL ) ? ' checked="checked"' : '', 'DISPLAY_POSTING_NONE_CHECKED' => ( $meta['display_posting'] == XD_DISPLAY_NONE ) ? ' checked="checked"' : '', 'DISPLAY_POSTING_ROOT_CHECKED' => ( $meta['display_posting'] == XD_DISPLAY_ROOT ) ? ' checked="checked"' : '', 'DISPLAY_PROFILE_NORMAL_CHECKED' => ( $meta['display_viewprofile'] == XD_DISPLAY_NORMAL ) ? ' checked="checked"' : '', 'DISPLAY_PROFILE_NONE_CHECKED' => ( $meta['display_viewprofile'] == XD_DISPLAY_NONE ) ? ' checked="checked"' : '', 'DISPLAY_PROFILE_ROOT_CHECKED' => ( $meta['display_viewprofile'] == XD_DISPLAY_ROOT ) ? ' checked="checked"' : '', 'HANDLE_INPUT_YES_CHECKED' => ( $meta['handle_input'] == 1 ) ? ' checked="checked"' : '', 'HANDLE_INPUT_NO_CHECKED' => ( $meta['handle_input'] == 0 ) ? ' checked="checked"' : '', 'ALLOW_BBCODE_YES_CHECKED' => ( $meta['allow_bbcode'] == 1 ) ? ' checked="checked"' : '', 'ALLOW_BBCODE_NO_CHECKED' => ( $meta['allow_bbcode'] == 0 ) ? 'checked="checked"' : '', 'ALLOW_SMILIES_YES_CHECKED' => ( $meta['allow_smilies'] == 1 ) ? ' checked="checked"' : '', 'ALLOW_SMILIES_NO_CHECKED' => ( $meta['allow_smilies'] == 0 ) ? ' checked="checked"' : '', 'ALLOW_HTML_YES_CHECKED' => ( $meta['allow_html'] == 1 ) ? ' checked="checked"' : '', 'ALLOW_HTML_NO_CHECKED' => ( $meta['allow_html'] == 0 ) ? ' checked="checked"' : '', 'VIEWTOPIC_YES_CHECKED' => ( $meta['viewtopic'] == 1 ) ? ' checked="checked"' : '', 'VIEWTOPIC_NO_CHECKED' => ( $meta['viewtopic'] == 0 ) ? ' checked="checked"' : '', 'SIGNUP_YES_CHECKED' => ( $meta['signup'] == 1 ) ? ' checked="checked"' : '', 'SIGNUP_NO_CHECKED' => ( $meta['signup'] == 0 ) ? ' checked="checked"' : '', 'AUTH_ALLOW' => XD_AUTH_ALLOW, 'AUTH_DENY' => XD_AUTH_DENY, 'S_HIDDEN_FIELDS' => '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="name" value="'.$name.'" />']
			);

			$template->assign_vars(['L_BASIC_OPTIONS' => $lang['Basic_Options'], 'L_ADVANCED_OPTIONS' => $lang['Advanced_Options'], 'L_ADVANCED_NOTICE' => $lang['Advanced_warning'], 'L_XDATA_ADMIN' => $lang['edit_xdata_field'], 'L_NAME' => $lang['Name'], 'L_DESCRIPTION' => $lang['xd_description'], 'L_TYPE' => $lang['type'], 'L_TEXT' => $lang['Text'], 'L_TEXTAREA' => $lang['Text_area'], 'L_SELECT' => $lang['Select'], 'L_RADIO' => $lang['Radio'], 'L_DATE' => $lang['Date'], 'L_CHECKBOX' => $lang['Checkbox'], 'L_CUSTOM' => $lang['Custom'], 'L_LENGTH' => $lang['Length'], 'L_LENGTH_EXPLAIN' => $lang['Length_explain'], 'L_VALUES' => $lang['Values'], 'L_VALUES_EXPLAIN' => $lang['Values_explain'], 'L_DEFAULT_AUTH' => $lang['Default_auth'], 'L_DEFAULT_AUTH_EXPLAIN' => $lang['Default_auth_explain'], 'L_ALLOW_BBCODE' => $lang['Allow_BBCode'], 'L_ALLOW_SMILIES' => $lang['Allow_smilies'], 'L_ALLOW_HTML' => $lang['Allow_html'], 'L_DISPLAY_TYPE' => $lang['Display_type'], 'L_DISPLAY_REGISTER_EXPLAIN' => $lang['Display_register_explain'], 'L_DISPLAY_PROFILE_EXPLAIN' => $lang['Display_viewprofile_explain'], 'L_DISPLAY_POSTING_EXPLAIN' => $lang['Display_viewtopic_explain'], 'L_SIGNUP' => $lang['Signup'], 'L_VIEWTOPIC' => $lang['Viewtopic'], 'L_NORMAL' => $lang['Display_normal'], 'L_NONE' => $lang['Display_none'], 'L_ROOT' => $lang['Display_root'], 'L_CODE_NAME' => $lang['Code_name'], 'L_CODE_NAME_EXPLAIN' => $lang['Code_name_explain'], 'L_REGEXP' => $lang['Regexp'], 'L_REGEXP_EXPLAIN' => $lang['Regexp_explain'], 'L_HANDLE_INPUT' => $lang['handle_input'], 'L_HANDLE_INPUT_EXPLAIN' => $lang['handle_input_explain'], 'L_SUBMIT' => $lang['Submit'], 'L_RESET' => $lang['Reset'], 'L_ALLOW' => $lang['Allow'], 'L_DENY' => $lang['Deny'], 'L_YES' => $lang['Yes'], 'L_NO' => $lang['No'], 'L_NONE' => $lang['none'], 'L_MANDITORY' => $lang['manditory'], 'L_NUMBERS' => $lang['numbers'], 'L_LETTERS' => $lang['letters'], 'L_CUSTOM' => $lang['custom']]
			);

			$template->pparse('body');

		}
		else
		{
			/*
			 The data has been submitted, so update it in the DB
			*/

			$code_name = ( isset($_POST['name']) ) ? htmlspecialchars((string) $_POST['name']) : '';
			$new_code_name = ( isset($_POST['new_code_name']) ) ? htmlspecialchars((string) $_POST['new_code_name']) : '';
			$field_name = ( isset($_POST['field_name']) ) ? htmlspecialchars((string) $_POST['field_name']) : '';
			$field_desc = ( isset($_POST['field_desc']) ) ? htmlspecialchars((string) $_POST['field_desc']) : '';
			$type = ( isset($_POST['field_type']) ) ? htmlspecialchars((string) $_POST['field_type']) : '';
			$field_length = (int) (( isset($_POST['field_length']) ) ? (int) $_POST['field_length']: '');
			$field_values = ( isset($_POST['field_values']) ) ? htmlspecialchars((string) $_POST['field_values']) : '';

			switch ( $_POST['regexp'] )
			{
				case 'none':
						$field_regexp = '';
				break;
				case 'numbers':
						$field_regexp = XD_REGEXP_NUMBERS;
				break;
				case 'letters':
						$field_regexp = XD_REGEXP_LETTERS;
				break;
				case 'custom':
						$field_regexp = $_POST['regexp_custom'];
				break;
			}
            $signup = ( isset($_POST['signup']) ) ? (int) $_POST['signup'] : 0;
            $viewtopic = ( isset($_POST['viewtopic']) ) ? (int) $_POST['viewtopic'] : 0;
			$default_auth = ( isset($_POST['default_auth']) ) ? htmlspecialchars((string) $_POST['default_auth']) : '';
			$display_register = ( isset($_POST['display_register']) ) ? (int) $_POST['display_register'] : XD_DISPLAY_NORMAL;
			$display_viewprofile = ( isset($_POST['display_viewprofile']) ) ? (int) $_POST['display_viewprofile'] : XD_DISPLAY_NORMAL;
			$display_posting = ( isset($_POST['display_posting']) ) ? (int) $_POST['display_posting'] : XD_DISPLAY_NORMAL;
			$handle_input = ( isset($_POST['handle_input']) ) ? (int) $_POST['handle_input'] : 1;
			$allow_bbcode =  (isset($_POST['allow_bbcode']) ) ? (int) $_POST['allow_bbcode'] : 1;
			$allow_smilies =  ( isset($_POST['allow_smilies']) ) ? (int) $_POST['allow_smilies'] : 1;
   			$allow_html =( isset($_POST['allow_html']) ) ? (int) $_POST['allow_html'] : 1;

			$manditory = (isset($_POST['manditory'])) ? (int) $_POST['manditory'] : 0;

			if ( $code_name == '' )
			{
            			message_die(GENERAL_ERROR, 'No field specified.');
			}
			elseif ( ! isset($xd_meta[$code_name]) )
			{
				message_die(GENERAL_ERROR, 'The field you were editing does not exist.');
			}

			if ( strlen((string) $field_regexp) > 0 )
			{
				$check = function ($errno, $errstr, $errfile, $errline) {
        message_die("GENERAL_ERROR", "You have an error in your regular expression syntax:<br /><br />{$errstr}");
    };
				set_error_handler($check);
				$test = preg_match($field_regexp, 'this is a test to see whether the regexp will compile properly');
				restore_error_handler();
			}

			$sql = "UPDATE " . XDATA_FIELDS_TABLE . "
				SET field_name = '" . $field_name . "',
				" . "field_desc = '" . $field_desc . "',
				" . "field_type = '" . $type . "',
				" . "manditory = '" . $manditory . "',
				" . "field_length = '" . $field_length . "',
				" . "field_values = '" . $field_values . "',
				" . "field_regexp = '" . $field_regexp . "',
				" . "default_auth = " . $default_auth . ",
				" . "display_register = " . $display_register . ",
				" . "display_viewprofile = " . $display_viewprofile . ",
				" . "display_posting = " . $display_posting . ",
				" . "handle_input = " . $handle_input . ",
				" . "allow_bbcode = " . $allow_bbcode . ",
				" . "allow_smilies = " . $allow_smilies . ",
				" . "allow_html = " . $allow_html . ",
				" . "viewtopic = " . $viewtopic . ",
                " . "signup = " . $signup . ",
				" . "code_name = '"
				. ( ( ( strlen($new_code_name) > 0 ) && ( $new_code_name !== $code_name ) ) ? $new_code_name : $code_name )
				. "'
				WHERE code_name = '" . $code_name . "'";

			if ( ! $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['XData_error_updating_fields'], '', __LINE__, __FILE__, $sql);
			}

           	 $message = $lang['Edit_success'] . "<br /><br />" . sprintf($lang['Click_return_fields'], "<a href=\"" . append_sid("admin_xdata_fields.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);
		}

		break;

	case 'add':

		if ( ! isset($_POST['submit']) )
		{
			/*
			Show the form
			*/

			$template->set_filenames( ['body' => 'admin/xd_edit_body.tpl'] );

        	$template->assign_vars(['DEFAULT_AUTH_ALLOW_CHECKED' => ' checked="checked"', 'AUTH_ALLOW' => XD_AUTH_ALLOW, 'AUTH_DENY' => XD_AUTH_DENY, 'DISPLAY_REGISTER_NORMAL_CHECKED' => ' checked="checked"', 'DISPLAY_PROFILE_NORMAL_CHECKED' => ' checked="checked"', 'DISPLAY_POSTING_NORMAL_CHECKED' => ' checked="checked"', 'HANDLE_INPUT_YES_CHECKED' => ' checked="checked"', 'ALLOW_BBCODE_YES_CHECKED' => ' checked="checked"', 'ALLOW_SMILIES_YES_CHECKED' => ' checked="checked"', 'ALLOW_HTML_NO_CHECKED' => ' checked="checked"', 'MANDITORY_YES_CHECKED' => ' checked="checked"', 'REGEXP_NONE_CHECKED' => ' checked="checked"', 'VIEWTOPIC_NO_CHECKED' => ' checked="checked"', 'SIGNUP_NO_CHECKED' => ' checked="checked"', 'L_BASIC_OPTIONS' => $lang['Basic_Options'], 'L_ADVANCED_OPTIONS' => $lang['Advanced_Options'], 'L_ADVANCED_NOTICE' => $lang['Advanced_warning'], 'L_XDATA_ADMIN' => $lang['add_xdata_field'], 'L_NAME' => $lang['Name'], 'L_DESCRIPTION' => $lang['xd_description'], 'L_TYPE' => $lang['type'], 'L_TEXT' => $lang['Text'], 'L_TEXTAREA' => $lang['Text_area'], 'L_SELECT' => $lang['Select'], 'L_RADIO' => $lang['Radio'], 'L_DATE' => $lang['Date'], 'L_CHECKBOX' => $lang['Checkbox'], 'L_CUSTOM' => $lang['Custom'], 'L_LENGTH' => $lang['Length'], 'L_LENGTH_EXPLAIN' => $lang['Length_explain'], 'L_VALUES' => $lang['Values'], 'L_VALUES_EXPLAIN' => $lang['Values_explain'], 'L_DEFAULT_AUTH' => $lang['Default_auth'], 'L_DEFAULT_AUTH_EXPLAIN' => $lang['Default_auth_explain'], 'L_ALLOW_BBCODE' => $lang['Allow_BBCode'], 'L_ALLOW_SMILIES' => $lang['Allow_smilies'], 'L_ALLOW_HTML' => $lang['Allow_html'], 'L_DISPLAY_TYPE' => $lang['Display_type'], 'L_DISPLAY_REGISTER_EXPLAIN' => $lang['Display_register_explain'], 'L_DISPLAY_PROFILE_EXPLAIN' => $lang['Display_viewprofile_explain'], 'L_DISPLAY_POSTING_EXPLAIN' => $lang['Display_viewtopic_explain'], 'L_VIEWTOPIC' => $lang['Viewtopic'], 'L_SIGNUP' => $lang['Signup'], 'L_NORMAL' => $lang['Display_normal'], 'L_NONE' => $lang['Display_none'], 'L_ROOT' => $lang['Display_root'], 'L_CODE_NAME' => $lang['Code_name'], 'L_CODE_NAME_EXPLAIN' => $lang['Code_name_explain'], 'L_REGEXP' => $lang['Regexp'], 'L_REGEXP_EXPLAIN' => $lang['Regexp_explain'], 'L_HANDLE_INPUT' => $lang['handle_input'], 'L_HANDLE_INPUT_EXPLAIN' => $lang['handle_input_explain'], 'L_SUBMIT' => $lang['Submit'], 'L_RESET' => $lang['Reset'], 'L_ALLOW' => $lang['Allow'], 'L_DENY' => $lang['Deny'], 'L_YES' => $lang['Yes'], 'L_NO' => $lang['No'], 'L_NONE' => $lang['none'], 'L_MANDITORY' => $lang['manditory'], 'L_NUMBERS' => $lang['numbers'], 'L_LETTERS' => $lang['letters'], 'L_CUSTOM' => $lang['custom']]
			);

			$template->pparse('body');
  		}
  		else
  		{
  			/*
			The data has been submitted, so add it to the DB
			*/

			$field_name = ( isset($_POST['field_name']) ) ? htmlspecialchars((string) $_POST['field_name']) : '';
			$new_code_name = ( isset($_POST['new_code_name']) ) ? htmlspecialchars((string) $_POST['new_code_name']) : '';
			$field_desc = ( isset($_POST['field_desc']) ) ? htmlspecialchars((string) $_POST['field_desc']) : '';
			$field_type = ( isset($_POST['field_type']) ) ? htmlspecialchars((string) $_POST['field_type']) : '';
			$field_length = (int) (( isset($_POST['field_length']) ) ? (int) $_POST['field_length'] : '');
			$field_values = ( isset($_POST['field_values']) ) ? htmlspecialchars((string) $_POST['field_values']) : '';

			switch ( $_POST['regexp'] )
			{
				case 'none':
						$field_regexp = '';
				break;
				case 'numbers':
						$field_regexp = XD_REGEXP_NUMBERS;
				break;
				case 'letters':
						$field_regexp = XD_REGEXP_LETTERS;
				break;
				case 'custom':
						$field_regexp = $_POST['regexp_custom'];
				break;
			}
            $signup = ( isset($_POST['signup']) ) ? (int) $_POST['signup'] : 0;
            $viewtopic = ( isset($_POST['viewtopic']) ) ? (int) $_POST['viewtopic'] : 0;
			$default_auth = ( isset($_POST['default_auth']) ) ? htmlspecialchars((string) $_POST['default_auth']) : '';
			$display_register = ( isset($_POST['display_register']) ) ? (int) $_POST['display_register'] : XD_DISPLAY_NORMAL;
			$display_viewprofile = ( isset($_POST['display_viewprofile']) ) ? (int) $_POST['display_viewprofile'] : XD_DISPLAY_NORMAL;
			$display_posting = ( isset($_POST['display_posting']) ) ? (int) $_POST['display_posting'] : XD_DISPLAY_NORMAL;
         	$handle_input = ( isset($_POST['handle_input']) ) ? (int) $_POST['handle_input'] : 1;
			$allow_bbcode = ( isset($_POST['allow_bbcode']) ) ? (int) $_POST['allow_bbcode'] : 0;
			$allow_smilies = ( isset($_POST['allow_smilies']) ) ? (int) $_POST['allow_smilies'] : 0;
            $allow_html =  ( isset($_POST['allow_html']) ) ? (int) $_POST['allow_html'] : 1;

			$manditory = (isset($_POST['manditory'])) ? (int) $_POST['manditory'] : 0;

			if ( strlen((string) $field_regexp) > 0 )
			{
				$check = function ($errno, $errstr, $errfile, $errline) use ($lang) {
        message_die("GENERAL_ERROR", $lang['Regexp_error'] . "<br /><br />{$errstr}");
    };
				set_error_handler($check);
				$test = preg_match($field_regexp, 'this is a test to see whether the regexp will compile properly');
				restore_error_handler();
			}

			$sql = "SELECT MAX(field_id)+1 AS field_id, MAX(field_order)+1 AS field_order
			        FROM " . XDATA_FIELDS_TABLE;

			if ( !($result = $db->sql_query($sql)) )
			{
            			message_die(GENERAL_ERROR, $lang['XData_error_obtaining_new_field_info'], '', __LINE__, __FILE__, $sql);
			}

			$new_info = $db->sql_fetchrow($result);
			$field_id = $new_info['field_id'];
			$field_order = $new_info['field_order'];

			$code_name = ( $new_code_name == '' ) ? "xd_$field_id" : $new_code_name;

            		if ( isset($xd_meta[$new_code_name]) )
			{
				message_die(GENERAL_ERROR, $lang['XD_duplicate_name']);
			}

			$sql = "INSERT INTO " . XDATA_FIELDS_TABLE . "
				(field_id, field_name, field_desc, field_type, field_length, field_values, field_regexp, field_order, code_name, default_auth, display_register, display_viewprofile, display_posting, handle_input, allow_bbcode, allow_smilies, allow_html, manditory, viewtopic, signup)
				VALUES
				($field_id, '$field_name', '$field_desc', '$field_type', $field_length, '$field_values', '$field_regexp', $field_order, '$code_name', $default_auth, $display_register, $display_viewprofile, $display_posting, $handle_input, $allow_bbcode, $allow_smilies, $allow_html, $manditory, $viewtopic, $signup)";

			if ( ! $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['XData_failure_inserting_data'], '', __LINE__, __FILE__, $sql);
			}

           		 $message = $lang['Add_success'] . "<br /><br />" . sprintf($lang['Click_return_fields'], "<a href=\"" . append_sid("admin_xdata_fields.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);
		}

		break;

	case 'delete':

		if ( ! isset($_POST['yes']) && ! isset($_POST['no']) )
		{

	        /*
	        Show the confirm message
	        */

			if( isset($_POST['name']) || isset($_GET['name']) )
			{
				$code_name = $_POST['name'] ?? $_GET['name'];
			}
			else
			{
				message_die(GENERAL_ERROR, $lang['XData_no_field_selected'] );
			}

            if ( ! isset($xd_meta[$code_name]) )
			{
				message_die(GENERAL_ERROR, $lang['XData_field_non_existant']);
			}

			$template->set_filenames( ['body' => 'admin/xd_confirm_delete.tpl'] );

			$template->assign_vars( ['S_HIDDEN_VARS' => '<input type="hidden" name="name" value="' . $code_name . '" /><input type="hidden" name="mode" value="delete" />', 'U_FORM_ACTION' => append_sid("admin_xdata_fields.$phpEx?name=$name")]
			);

			$template->assign_vars( ['L_CONFIRM' => $lang['Confirm'], 'L_ARE_YOU_SURE' => sprintf($lang['Are_you_sure'], $xd_meta[$name]['field_name']), 'L_YES' => $lang['Yes'], 'L_NO' => $lang['No']]
			);

			$template->pparse('body');
		}
		elseif ( isset($_POST['yes'] ) )
		{
			//
			// Already confirmed, so do the delete
			//

			if( isset($_POST['name']) || isset($_GET['name']) )
			{
				$code_name = ( isset($_POST['name']) ) ? htmlspecialchars((string) $_POST['name']) : htmlspecialchars((string) $_GET['name']);
			}
			else
			{
				message_die(GENERAL_ERROR, $lang['XData_no_field_selected']);
			}

            		if ( ! isset($xd_meta[$code_name]) )
			{
				message_die(GENERAL_ERROR, $lang['XData_field_non_existant']);
			}

			$sql = "DELETE FROM " . XDATA_DATA_TABLE . "
				WHERE field_id = " . $xd_meta[$code_name]['field_id'];

			if ( ! $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['XData_failure_removing_data'], "", __LINE__, __FILE__, $sql);
			}

          		  $sql = "DELETE FROM " . XDATA_AUTH_TABLE . "
				WHERE field_id = " . $xd_meta[$code_name]['field_id'];

			if ( ! $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['XData_failure_removing_data'], "", __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . XDATA_FIELDS_TABLE . "
				WHERE code_name = '" . $code_name . "'";

			if ( ! $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['XData_failure_removing_data'], "", __LINE__, __FILE__, $sql);
			}

			$message = $lang['Delete_success'] . "<br /><br />" . sprintf($lang['Click_return_fields'], "<a href=\"" . append_sid("admin_xdata_fields.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);

		}
		else
		{
			$mode = 'view';
		}

		break;
}

if ($mode == 'view')
{


	$template->set_filenames( ['body' => 'admin/xd_view_body.tpl'] );

	if ((is_countable($xd_meta) ? count($xd_meta) : 0) == 0)
	{
		$template->assign_block_vars('switch_no_fields', []);
	}
	else
	{
		foreach ($xd_meta as $code_name => $meta) {
      $template->assign_block_vars('xd_field', ['FIELD_NAME' => $meta['field_name'], 'FIELD_TYPE' => $meta['field_type'], 'U_MOVE_UP' => append_sid('admin_xdata_fields.'.$phpEx.'?mode=up&name='.$code_name), 'U_MOVE_DOWN' => append_sid('admin_xdata_fields.'.$phpEx.'?mode=down&name='.$code_name), 'U_EDIT' => append_sid('admin_xdata_fields.'.$phpEx.'?mode=edit&name='.$code_name), 'U_DELETE' => append_sid('admin_xdata_fields.'.$phpEx.'?mode=delete&name='.$code_name)]
     	);
      if ($meta['field_type'] != 'special')
			{
				$template->assign_block_vars('xd_field.normal', []);
			}
  }
	}

	$template->assign_vars(['L_XDATA_ADMIN' => $lang['Profile_admin'], 'L_FORM_DESCRIPTION' => $lang['Xdata_view_description'], 'L_FIELD_NAME' => $lang['Name'], 'L_FIELD_TYPE' => $lang['type'], 'L_MOVE' => $lang['xd_move'], 'L_OPERATIONS' => $lang['xd_operations'], 'L_MOVE_UP' => $lang['xd_move_up'], 'L_MOVE_DOWN' => $lang['xd_move_down'], 'L_EDIT' => $lang['Edit_field'], 'L_DELETE' => $lang['Delete_field'], 'L_NO_FIELDS' => $lang['No_fields'], 'L_ADD_FIELD' => $lang['Add_field'], 'U_ADD_FIELD' => append_sid("admin_xdata_fields.$phpEx?mode=add")]
	);

	$template->pparse('body');
}

include(__DIR__ . '/page_footer_admin.'.$phpEx);

?>
