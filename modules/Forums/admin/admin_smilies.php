<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                               admin_smilies.php
*                              -------------------
*     begin                : Thu May 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*     Id: admin_smilies.php,v 1.22.2.14 2005/05/06 20:50:09 acydburn Exp
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/**************************************************************************
*        This file will be used for modifying the smiley settings for a board.
**************************************************************************/

define('IN_PHPBB2', 1);

//
// First we do the setmodules stuff for the admin cp.
//
if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $titanium_module['General']['Smilies'] = $filename;

        return;
}

$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');

$cancel = ( isset($HTTP_POST_VARS['cancel']) || isset($_POST['cancel']) ) ? true : false;
$no_page_header = $cancel;

//
// Load default header
//
if ((!empty($HTTP_GET_VARS['export_pack']) && $HTTP_GET_VARS['export_pack'] == 'send') || (!empty($_GET['export_pack']) && $_GET['export_pack'] == 'send'))
{
	$no_page_header = true;
}

require('./pagestart.' . $phpEx);
if ($cancel)
{
	redirect_titanium(append_titanium_sid("admin_smilies.$phpEx", true));
}
$smilie_tmp = $phpbb2_board_config['smilies_path'];
$phpbb2_board_config['smilies_path'] = str_replace("modules/Forums/", "", "$smilie_tmp");
//
// Check to see what mode we should operate in.
//
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
        $mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
        $mode = htmlspecialchars($mode);
}
else
{
        $mode = "";
}

$delimeter  = '=+:';

//
// Read a listing of uploaded smilies for use in the add or edit smliey code...
//
$dir = @opendir($phpbb2_root_path . $phpbb2_board_config['smilies_path']);

while($file = @readdir($dir))
{
        if( !@is_dir(phpbb_realpath($phpbb2_root_path . $phpbb2_board_config['smilies_path'] . '/' . $file)) )
        {
                $img_size = @getimagesize($phpbb2_root_path . $phpbb2_board_config['smilies_path'] . '/' . $file);

                if( $img_size[0] && $img_size[1] )
                {
                        $smiley_images[] = $file;
                }
                else if( preg_match('/\.pak$/i', $file) )
                {
                        $smiley_paks[] = $file;
                }
        }
}

@closedir($dir);

//
// Select main mode
//
if( isset($HTTP_GET_VARS['import_pack']) || isset($HTTP_POST_VARS['import_pack']) )
{
        //
        // Import a list a "Smiley Pack"
        //
        $smile_pak = ( isset($HTTP_POST_VARS['smile_pak']) ) ? $HTTP_POST_VARS['smile_pak'] : $HTTP_GET_VARS['smile_pak'];
        $clear_current = ( isset($HTTP_POST_VARS['clear_current']) ) ? $HTTP_POST_VARS['clear_current'] : $HTTP_GET_VARS['clear_current'];
        $replace_existing = ( isset($HTTP_POST_VARS['replace']) ) ? $HTTP_POST_VARS['replace'] : $HTTP_GET_VARS['replace'];

        if ( !empty($smile_pak) )
        {
                //
                // The user has already selected a smile_pak file.. Import it.
                //
                if( !empty($clear_current)  )
                {
                        $sql = "DELETE
                                FROM " . SMILIES_TABLE;
                        if( !$result = $titanium_db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't delete current smilies", "", __LINE__, __FILE__, $sql);
                        }
                }
                else
                {
                        $sql = "SELECT code
                                FROM ". SMILIES_TABLE;
                        if( !$result = $titanium_db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't get current smilies", "", __LINE__, __FILE__, $sql);
                        }

                        $cur_smilies = $titanium_db->sql_fetchrowset($result);

                        for( $i = 0; $i < count($cur_smilies); $i++ )
                        {
                                $k = $cur_smilies[$i]['code'];
                                $smiles[$k] = 1;
                        }
                }

                $fcontents = @file($phpbb2_root_path . $phpbb2_board_config['smilies_path'] . '/'. $smile_pak);

                if( empty($fcontents) )
                {
                        message_die(GENERAL_ERROR, "Couldn't read smiley pak file", "", __LINE__, __FILE__, $sql);
                }

                for( $i = 0; $i < count($fcontents); $i++ )
                {
                        $smile_data = explode($delimeter, trim(addslashes($fcontents[$i])));

                        for( $j = 2; $j < count($smile_data); $j++)
                        {
                                //
                                // Replace > and < with the proper html_entities for matching.
                                //
                                $smile_data[$j] = str_replace("<", "&lt;", $smile_data[$j]);
                                $smile_data[$j] = str_replace(">", "&gt;", $smile_data[$j]);
                                $k = $smile_data[$j];

                                if( $smiles[$k] == 1 )
                                {
                                        if( !empty($replace_existing) )
                                        {
                                                $sql = "UPDATE " . SMILIES_TABLE . "
                                                        SET smile_url = '" . str_replace("\'", "''", $smile_data[0]) . "', emoticon = '" . str_replace("\'", "''", $smile_data[1]) . "'
                                                        WHERE code = '" . str_replace("\'", "''", $smile_data[$j]) . "'";
                                        }
                                        else
                                        {
                                                $sql = '';
                                        }
                                }
                                else
                                {
                                        $sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon)
                                                VALUES('" . str_replace("\'", "''", $smile_data[$j]) . "', '" . str_replace("\'", "''", $smile_data[0]) . "', '" . str_replace("\'", "''", $smile_data[1]) . "')";
                                }

                                if( $sql != '' )
                                {
                                        $result = $titanium_db->sql_query($sql);
                                        if( !$result )
                                        {
                                                message_die(GENERAL_ERROR, "Couldn't update smilies!", "", __LINE__, __FILE__, $sql);
                                        }
                                }
                        }
                }

                $message = $titanium_lang['smiley_import_success'] . "<br /><br />" . sprintf($titanium_lang['Click_return_smileadmin'], "<a href=\"" . append_titanium_sid("admin_smilies.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

                message_die(GENERAL_MESSAGE, $message);

        }
        else
        {
                //
                // Display the script to get the smile_pak cfg file...
                //
                $smile_paks_select = "<select name='smile_pak'><option value=''>" . $titanium_lang['Select_pak'] . "</option>";
                while( list($key, $value) = @each($smiley_paks) )
                {
                        if ( !empty($value) )
                        {
                                $smile_paks_select .= "<option>" . $value . "</option>";
                        }
                }
                $smile_paks_select .= "</select>";

                $hidden_vars = "<input type='hidden' name='mode' value='import'>";

                $phpbb2_template->set_filenames(array(
                        "body" => "admin/smile_import_body.tpl")
                );

                $phpbb2_template->assign_vars(array(
                        "L_SMILEY_TITLE" => $titanium_lang['smiley_title'],
                        "L_SMILEY_EXPLAIN" => $titanium_lang['smiley_import_inst'],
                        "L_SMILEY_IMPORT" => $titanium_lang['smiley_import'],
                        "L_SELECT_LBL" => $titanium_lang['choose_smile_pak'],
                        "L_IMPORT" => $titanium_lang['import'],
                        "L_CONFLICTS" => $titanium_lang['smile_conflicts'],
                        "L_DEL_EXISTING" => $titanium_lang['del_existing_smileys'],
                        "L_REPLACE_EXISTING" => $titanium_lang['replace_existing'],
                        "L_KEEP_EXISTING" => $titanium_lang['keep_existing'],

                        "S_SMILEY_ACTION" => append_titanium_sid("admin_smilies.$phpEx"),
                        "S_SMILE_SELECT" => $smile_paks_select,
                        "S_HIDDEN_FIELDS" => $hidden_vars)
                );

                $phpbb2_template->pparse("body");
        }
}
else if( isset($HTTP_POST_VARS['export_pack']) || isset($HTTP_GET_VARS['export_pack']) )
{
        //
        // Export our smiley config as a smiley pak...
        //
        if ( $HTTP_GET_VARS['export_pack'] == "send" )
        {
                $sql = "SELECT *
                        FROM " . SMILIES_TABLE;
                if( !$result = $titanium_db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, "Could not get smiley list", "", __LINE__, __FILE__, $sql);
                }

                $resultset = $titanium_db->sql_fetchrowset($result);

                $smile_pak = "";
                for($i = 0; $i < count($resultset); $i++ )
                {
                        $smile_pak .= $resultset[$i]['smile_url'] . $delimeter;
                        $smile_pak .= $resultset[$i]['emoticon'] . $delimeter;
                        $smile_pak .= $resultset[$i]['code'] . "\n";
                }

                header("Content-Type: text/x-delimtext; name=\"smiles.pak\"");
                header("Content-disposition: attachment; filename=smiles.pak");

                echo $smile_pak;

                exit;
        }

        $message = sprintf($titanium_lang['export_smiles'], "<a href=\"" . append_titanium_sid("admin_smilies.$phpEx?export_pack=send", true) . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_smileadmin'], "<a href=\"" . append_titanium_sid("admin_smilies.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);

}
else if( isset($HTTP_POST_VARS['add']) || isset($HTTP_GET_VARS['add']) )
{
        //
        // Admin has selected to add a smiley.
        //

        $phpbb2_template->set_filenames(array(
                "body" => "admin/smile_edit_body.tpl")
        );

        $filename_list = "";
        for( $i = 0; $i < count($smiley_images); $i++ )
        {
                $filename_list .= '<option value="' . $smiley_images[$i] . '">' . $smiley_images[$i] . '</option>';
        }

        $s_hidden_fields = '<input type="hidden" name="mode" value="savenew" />';

        $phpbb2_template->assign_vars(array(
                "L_SMILEY_TITLE" => $titanium_lang['smiley_title'],
                "L_SMILEY_CONFIG" => $titanium_lang['smiley_config'],
                "L_SMILEY_EXPLAIN" => $titanium_lang['smile_desc'],
                "L_SMILEY_CODE" => $titanium_lang['smiley_code'],
                "L_SMILEY_URL" => $titanium_lang['smiley_url'],
                "L_SMILEY_EMOTION" => $titanium_lang['smiley_emot'],
                "L_SUBMIT" => $titanium_lang['Submit'],
                "L_RESET" => $titanium_lang['Reset'],

                "SMILEY_IMG" => $phpbb2_root_path . $phpbb2_board_config['smilies_path'] . '/' . $smiley_images[0],

                "S_SMILEY_ACTION" => append_titanium_sid("admin_smilies.$phpEx"),
                "S_HIDDEN_FIELDS" => $s_hidden_fields,
                "S_FILENAME_OPTIONS" => $filename_list,
                "S_SMILEY_BASEDIR" => $phpbb2_root_path . $phpbb2_board_config['smilies_path'])
        );

        $phpbb2_template->pparse("body");
}
else if ( $mode != "" )
{
        switch( $mode )
        {
                case 'delete':
                        //
                        // Admin has selected to delete a smiley.
                        //

                        $smiley_id = ( !empty($HTTP_POST_VARS['id']) ) ? $HTTP_POST_VARS['id'] : $HTTP_GET_VARS['id'];
  			$smiley_id = intval($smiley_id);

     			$confirm = isset($HTTP_POST_VARS['confirm']);

     			if( $confirm )
      			{
     				$sql = "DELETE FROM " . SMILIES_TABLE . "
     					WHERE smilies_id = " . $smiley_id;
     				$result = $titanium_db->sql_query($sql);
     				if( !$result )
     				{
     					message_die(GENERAL_ERROR, "Couldn't delete smiley", "", __LINE__, __FILE__, $sql);
     				}

     				$message = $titanium_lang['smiley_del_success'] . "<br /><br />" . sprintf($titanium_lang['Click_return_smileadmin'], "<a href=\"" . append_titanium_sid("admin_smilies.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

     				message_die(GENERAL_MESSAGE, $message);
     			}
     			else
     			{
     				// Present the confirmation screen to the user
     				$phpbb2_template->set_filenames(array(
     					'body' => 'admin/confirm_body.tpl')
     				);

     				$hidden_fields = '<input type="hidden" name="mode" value="delete" /><input type="hidden" name="id" value="' . $smiley_id . '" />';

     				$phpbb2_template->assign_vars(array(
     					'MESSAGE_TITLE' => $titanium_lang['Confirm'],
     					'MESSAGE_TEXT' => $titanium_lang['Confirm_delete_smiley'],

     					'L_YES' => $titanium_lang['Yes'],
     					'L_NO' => $titanium_lang['No'],

     					'S_CONFIRM_ACTION' => append_titanium_sid("admin_smilies.$phpEx"),
     					'S_HIDDEN_FIELDS' => $hidden_fields)
     				);
     				$phpbb2_template->pparse('body');
     			}
      			break;

                case 'edit':
                        //
                        // Admin has selected to edit a smiley.
                        //

                        $smiley_id = ( !empty($HTTP_POST_VARS['id']) ) ? $HTTP_POST_VARS['id'] : $HTTP_GET_VARS['id'];
                        $smiley_id = intval($smiley_id);
                        $sql = "SELECT *
                                FROM " . SMILIES_TABLE . "
                                WHERE smilies_id = " . $smiley_id;
                        $result = $titanium_db->sql_query($sql);
                        if( !$result )
                        {
                                message_die(GENERAL_ERROR, 'Could not obtain emoticon information', "", __LINE__, __FILE__, $sql);
                        }
                        $smile_data = $titanium_db->sql_fetchrow($result);

                        $filename_list = "";
                        for( $i = 0; $i < count($smiley_images); $i++ )
                        {
                                if( $smiley_images[$i] == $smile_data['smile_url'] )
                                {
                                        $smiley_selected = "selected=\"selected\"";
                                        $smiley_edit_img = $smiley_images[$i];
                                }
                                else
                                {
                                        $smiley_selected = "";
                                }

                                $filename_list .= '<option value="' . $smiley_images[$i] . '"' . $smiley_selected . '>' . $smiley_images[$i] . '</option>';
                        }

                        $phpbb2_template->set_filenames(array(
                                "body" => "admin/smile_edit_body.tpl")
                        );

                        $s_hidden_fields = '<input type="hidden" name="mode" value="save" /><input type="hidden" name="smile_id" value="' . $smile_data['smilies_id'] . '" />';

                        $phpbb2_template->assign_vars(array(
                                "SMILEY_CODE" => $smile_data['code'],
                                "SMILEY_EMOTICON" => $smile_data['emoticon'],

                                "L_SMILEY_TITLE" => $titanium_lang['smiley_title'],
                                "L_SMILEY_CONFIG" => $titanium_lang['smiley_config'],
                                "L_SMILEY_EXPLAIN" => $titanium_lang['smile_desc'],
                                "L_SMILEY_CODE" => $titanium_lang['smiley_code'],
                                "L_SMILEY_URL" => $titanium_lang['smiley_url'],
                                "L_SMILEY_EMOTION" => $titanium_lang['smiley_emot'],
                                "L_SUBMIT" => $titanium_lang['Submit'],
                                "L_RESET" => $titanium_lang['Reset'],

                                "SMILEY_IMG" => $phpbb2_root_path . $phpbb2_board_config['smilies_path'] . '/' . $smiley_edit_img,

                                "S_SMILEY_ACTION" => append_titanium_sid("admin_smilies.$phpEx"),
                                "S_HIDDEN_FIELDS" => $s_hidden_fields,
                                "S_FILENAME_OPTIONS" => $filename_list,
                                "S_SMILEY_BASEDIR" => $phpbb2_root_path . $phpbb2_board_config['smilies_path'])
                        );

                        $phpbb2_template->pparse("body");
                        break;

                case "save":
                        //
                        // Admin has submitted changes while editing a smiley.
                        //

                        //
                        // Get the submitted data, being careful to ensure that we only
                        // accept the data we are looking for.
                        //
                        $smile_code = ( isset($HTTP_POST_VARS['smile_code']) ) ? trim($HTTP_POST_VARS['smile_code']) : '';
             			$smile_url = ( isset($HTTP_POST_VARS['smile_url']) ) ? trim($HTTP_POST_VARS['smile_url']) : '';
              			$smile_url = phpbb_ltrim(basename($smile_url), "'");
             			$smile_emotion = ( isset($HTTP_POST_VARS['smile_emotion']) ) ? htmlspecialchars(trim($HTTP_POST_VARS['smile_emotion'])) : '';
             			$smile_id = ( isset($HTTP_POST_VARS['smile_id']) ) ? intval($HTTP_POST_VARS['smile_id']) : 0;
             			$smile_code = trim($smile_code);
             			$smile_url = trim($smile_url);

                        // If no code was entered complain ...
                        if ($smile_code == '' || $smile_url == '')
                        {
                                message_die(GENERAL_MESSAGE, $titanium_lang['Fields_empty']);
                        }

                        //
                        // Convert < and > to proper htmlentities for parsing.
                        //
                        $smile_code = str_replace('<', '&lt;', $smile_code);
                        $smile_code = str_replace('>', '&gt;', $smile_code);

                        //
                        // Proceed with updating the smiley table.
                        //
                        $sql = "UPDATE " . SMILIES_TABLE . "
                                SET code = '" . str_replace("\'", "''", $smile_code) . "', smile_url = '" . str_replace("\'", "''", $smile_url) . "', emoticon = '" . str_replace("\'", "''", $smile_emotion) . "'
                                WHERE smilies_id = $smile_id";
                        if( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't update smilies info", "", __LINE__, __FILE__, $sql);
                        }

                        $message = $titanium_lang['smiley_edit_success'] . "<br /><br />" . sprintf($titanium_lang['Click_return_smileadmin'], "<a href=\"" . append_titanium_sid("admin_smilies.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

                        message_die(GENERAL_MESSAGE, $message);
                        break;

                case "savenew":
                        //
                        // Admin has submitted changes while adding a new smiley.
                        //

                        //
                        // Get the submitted data being careful to ensure the the data
                        // we receive and process is only the data we are looking for.
                        //
                        $smile_code = ( isset($HTTP_POST_VARS['smile_code']) ) ? $HTTP_POST_VARS['smile_code'] : '';
             			$smile_url = ( isset($HTTP_POST_VARS['smile_url']) ) ? $HTTP_POST_VARS['smile_url'] : '';
              			$smile_url = phpbb_ltrim(basename($smile_url), "'");
             			$smile_emotion = ( isset($HTTP_POST_VARS['smile_emotion']) ) ? htmlspecialchars(trim($HTTP_POST_VARS['smile_emotion'])) : '';
              			$smile_code = trim($smile_code);
              			$smile_url = trim($smile_url);

                        // If no code was entered complain ...
                        if ($smile_code == '' || $smile_url == '')
                        {
                                message_die(GENERAL_MESSAGE, $titanium_lang['Fields_empty']);
                        }

                        //
                        // Convert < and > to proper htmlentities for parsing.
                        //
                        $smile_code = str_replace('<', '&lt;', $smile_code);
                        $smile_code = str_replace('>', '&gt;', $smile_code);

                        //
                        // Save the data to the smiley table.
                        //
                        $sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon)
                                VALUES ('" . str_replace("\'", "''", $smile_code) . "', '" . str_replace("\'", "''", $smile_url) . "', '" . str_replace("\'", "''", $smile_emotion) . "')";
                        $result = $titanium_db->sql_query($sql);
                        if( !$result )
                        {
                                message_die(GENERAL_ERROR, "Couldn't insert new smiley", "", __LINE__, __FILE__, $sql);
                        }

                        $message = $titanium_lang['smiley_add_success'] . "<br /><br />" . sprintf($titanium_lang['Click_return_smileadmin'], "<a href=\"" . append_titanium_sid("admin_smilies.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

                        message_die(GENERAL_MESSAGE, $message);
                        break;
        }
}
else
{

        //
        // This is the main display of the page before the admin has selected
        // any options.
        //
        $sql = "SELECT *
                FROM " . SMILIES_TABLE;
        $result = $titanium_db->sql_query($sql);
        if( !$result )
        {
                message_die(GENERAL_ERROR, "Couldn't obtain smileys from database", "", __LINE__, __FILE__, $sql);
        }

        $smilies = $titanium_db->sql_fetchrowset($result);

        $phpbb2_template->set_filenames(array(
                "body" => "admin/smile_list_body.tpl")
        );

        $phpbb2_template->assign_vars(array(
                "L_ACTION" => $titanium_lang['Action'],
                "L_SMILEY_TITLE" => $titanium_lang['smiley_title'],
                "L_SMILEY_TEXT" => $titanium_lang['smile_desc'],
                "L_DELETE" => $titanium_lang['Delete'],
                "L_EDIT" => $titanium_lang['Edit'],
                "L_SMILEY_ADD" => $titanium_lang['smile_add'],
                "L_CODE" => $titanium_lang['Code'],
                "L_EMOT" => $titanium_lang['Emotion'],
                "L_SMILE" => $titanium_lang['Smile'],
                "L_IMPORT_PACK" => $titanium_lang['import_smile_pack'],
                "L_EXPORT_PACK" => $titanium_lang['export_smile_pack'],

                "S_HIDDEN_FIELDS" => $s_hidden_fields,
                "S_SMILEY_ACTION" => append_titanium_sid("admin_smilies.$phpEx"))
        );

        //
        // Loop throuh the rows of smilies setting block vars for the template.
        //
        for($i = 0; $i < count($smilies); $i++)
        {
                //
                // Replace htmlentites for < and > with actual character.
                //
                $smilies[$i]['code'] = str_replace('&lt;', '<', $smilies[$i]['code']);
                $smilies[$i]['code'] = str_replace('&gt;', '>', $smilies[$i]['code']);

                $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                $phpbb2_template->assign_block_vars("smiles", array(
                        "ROW_COLOR" => "#" . $row_color,
                        "ROW_CLASS" => $row_class,

                        "SMILEY_IMG" =>  $phpbb2_root_path . $phpbb2_board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'],
                        "CODE" => $smilies[$i]['code'],
                        "EMOT" => $smilies[$i]['emoticon'],

                        "U_SMILEY_EDIT" => append_titanium_sid("admin_smilies.$phpEx?mode=edit&amp;id=" . $smilies[$i]['smilies_id']),
                        "U_SMILEY_DELETE" => append_titanium_sid("admin_smilies.$phpEx?mode=delete&amp;id=" . $smilies[$i]['smilies_id']))
                );
        }

        //
        // Spit out the page.
        //
        $phpbb2_template->pparse("body");
}

$cache->delete('smilies', 'config');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>