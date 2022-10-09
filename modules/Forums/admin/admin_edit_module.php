<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                           admin_edit_module.php
*                            -------------------
*   begin                : Fri, Jan 24, 2003
*   copyright            : (C) 2003 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: admin_edit_module.php,v 1.10 2003/03/16 19:38:27 acydburn Exp $
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

define('IN_PHPBB', true);

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
if (!empty($board_config))
{
    @include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
}

if( !empty($setmodules) )
{
    $filename = basename(__FILE__);
    $module['Statistics']['Edit_module'] = $filename . '?mode=select_module';
    return;
}

require('pagestart.' . $phpEx);

if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
    $mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
    $mode = '';
}

$submit = (isset($HTTP_POST_VARS['submit'])) ? TRUE : FALSE;
$cancel = ( isset($HTTP_POST_VARS['cancel']) ) ? TRUE : FALSE;

if ($cancel)
{
    $no_page_header = TRUE;
}

@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
include($phpbb_root_path . 'stats_mod/includes/constants.'.$phpEx);

$sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
     
if ( !($result = $db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

$stats_config = array();

while ($row = $db->sql_fetchrow($result))
{
    $stats_config[$row['config_name']] = trim($row['config_value']);
}

include($phpbb_root_path . 'stats_mod/includes/lang_functions.'.$phpEx);
include($phpbb_root_path . 'stats_mod/includes/stat_functions.'.$phpEx);
include($phpbb_root_path . 'stats_mod/includes/admin_functions.'.$phpEx);

$message = '';

if ($mode == 'mod_edit')
{
    if( isset($HTTP_POST_VARS['module']) || isset($HTTP_GET_VARS['module']) )
    {
        $module_id = ( isset($HTTP_POST_VARS['module']) ) ? intval($HTTP_POST_VARS['module']) : intval($HTTP_GET_VARS['module']);
    }
    else
    {
        message_die(GENERAL_ERROR, 'Unable to edit Module.');
    }

    $template->set_filenames(array(
        'body' => 'admin/stat_edit_module.tpl')
    );

    $sql = "SELECT m.*, i.* FROM " . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i WHERE i.module_id = m.module_id AND m.module_id = " . $module_id;

    if (!($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }

    if ($db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_MESSAGE, 'Module not found.');
    }

    $mod_info = $db->sql_fetchrow($result);
    $mod_info_changed = FALSE;
}

if ($submit && $mode == 'mod_edit')
{
    if (isset($HTTP_POST_VARS['update_time']))
    {
        if (intval($mod_info['update_time']) != intval($HTTP_POST_VARS['update_time']))
        {
            $sql = "UPDATE " . MODULES_TABLE . " SET update_time = " . intval($HTTP_POST_VARS['update_time']) . " WHERE module_id = " . $module_id;

            if ( !($result = $db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Unable to update modules table', '', __LINE__, __FILE__, $sql);
            }
    
            $mod_info_changed = TRUE;
            $message = ($message == '') ? $message . $lang['Msg_changed_update_time'] : $message . '<br />' . $lang['Msg_changed_update_time'];
        }
    }

    if (isset($HTTP_POST_VARS['clear_module_cache']))
    {
        $sql = "UPDATE " . CACHE_TABLE . " SET module_cache_time = 0, db_cache = '', priority = 0 WHERE module_id = " . $module_id;

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update modules cache table', '', __LINE__, __FILE__, $sql);
        }
    
        $message = ($message == '') ? $message . $lang['Msg_cleared_module_cache'] : $message . '<br />' . $lang['Msg_cleared_module_cache'];
    }

    // Permission Updates
    $update_sql = '';
    $perm_array = array('perm_all', 'perm_reg', 'perm_mod', 'perm_admin');

    for ($i = 0; $i < count($perm_array); $i++)
    {
        if (isset($HTTP_POST_VARS[$perm_array[$i]]))
        {
            $update_sql .= ($update_sql == '') ? $perm_array[$i] . ' = 1' : ', ' . $perm_array[$i] . ' = 1';
        }
        else
        {
            $update_sql .= ($update_sql == '') ? $perm_array[$i] . ' = 0' : ', ' . $perm_array[$i] . ' = 0';
        }
    }

    if ($update_sql != '')
    {
        $sql = "UPDATE " . MODULES_TABLE . " SET " . $update_sql . " WHERE module_id = " . $module_id;

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update Permissions', '', __LINE__, __FILE__, $sql);
        }

        $message = ($message == '') ? $message . $lang['Msg_permissions_updated'] : $message . '<br />' . $lang['Msg_permissions_updated'];
        $mod_info_changed = TRUE;
    }
    
    // Admin Panel Integration fields
    // Get Module Variables
    $sql = "SELECT * FROM " . MODULE_ADMIN_TABLE . " WHERE module_id = " . $module_id;

    if (!$result = $db->sql_query($sql))
    {
        message_die(GENERAL_ERROR, 'Could not find Module Admin Table', '', __LINE__, __FILE__, $sql);
    }
    
    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);

    $admin_update = FALSE;

    for ($i = 0; $i < $num_rows; $i++)
    {
        if (isset($HTTP_POST_VARS[trim($rows[$i]['config_name'])]))
        {
            if (trim($HTTP_POST_VARS[trim($rows[$i]['config_name'])]) != trim($rows[$i]['config_value']))
            {
                $sql = "UPDATE " . MODULE_ADMIN_TABLE . " SET config_value = '" . trim($HTTP_POST_VARS[trim($rows[$i]['config_name'])]) . "' 
                WHERE config_name = '" . trim($rows[$i]['config_name']) . "' AND module_id = " . $module_id;
    
                if ( !($result = $db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, 'Unable to update modules cache table', '', __LINE__, __FILE__, $sql);
                }
                $admin_update = TRUE;
            }            
        }
    }

    if ($admin_update)
    {
        $message = ($message == '') ? $message . $lang['Msg_module_fields_updated'] : $message . '<br />' . $lang['Msg_module_fields_updated'];
    }
}

if (isset($HTTP_POST_VARS['add_group']) && $mode == 'mod_edit')
{
    $group_id = intval($HTTP_POST_VARS['group']);

    if ( (!$group_id) || (empty($group_id)) )
    {
        message_die(GENERAL_MESSAGE, 'Wrong Group ID submitted, hacking attempt ?');
    }

    if( isset($HTTP_POST_VARS['module']) || isset($HTTP_GET_VARS['module']) )
    {
        $module_id = ( isset($HTTP_POST_VARS['module']) ) ? intval($HTTP_POST_VARS['module']) : intval($HTTP_GET_VARS['module']);
    }
    else
    {
        message_die(GENERAL_ERROR, 'Unable to edit Module.');
    }

    $sql = "INSERT INTO " . MODULE_GROUP_AUTH_TABLE . " (module_id, group_id) VALUES (" . $module_id . ", " . $group_id . ")";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't insert Group", "", __LINE__, __FILE__, $sql);
    }
}

if (isset($HTTP_POST_VARS['delete_group']) && $mode == 'mod_edit')
{
    $group_id = intval($HTTP_POST_VARS['added_group']);

    if ( (!$group_id) || (empty($group_id)) )
    {
        message_die(GENERAL_MESSAGE, 'Wrong Group ID submitted, hacking attempt ?');
    }

    if( isset($HTTP_POST_VARS['module']) || isset($HTTP_GET_VARS['module']) )
    {
        $module_id = ( isset($HTTP_POST_VARS['module']) ) ? intval($HTTP_POST_VARS['module']) : intval($HTTP_GET_VARS['module']);
    }
    else
    {
        message_die(GENERAL_ERROR, 'Unable to edit Module.');
    }

    $sql = "DELETE FROM " . MODULE_GROUP_AUTH_TABLE . " WHERE module_id = " . $module_id . " AND group_id = " . $group_id;

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't delete Group", "", __LINE__, __FILE__, $sql);
    }
}

if ($mode == 'mod_edit')
{
    if( isset($HTTP_POST_VARS['module']) || isset($HTTP_GET_VARS['module']) )
    {
        $module_id = ( isset($HTTP_POST_VARS['module']) ) ? intval($HTTP_POST_VARS['module']) : intval($HTTP_GET_VARS['module']);
    }
    else
    {
        message_die(GENERAL_ERROR, 'Unable to edit Module.');
    }

    $template->set_filenames(array(
        'body' => 'admin/stat_edit_module.tpl')
    );

    if ($mod_info_changed)
    {
        $sql = "SELECT m.*, i.* FROM " . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i WHERE i.module_id = m.module_id AND m.module_id = " . $module_id;

        if (!($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
        }

        if ($db->sql_numrows($result) == 0)
        {
            message_die(GENERAL_MESSAGE, 'Module not found.');
        }

        $mod_info = $db->sql_fetchrow($result);
    }

    $s_hidden_fields = '<input type="hidden" name="module" value="' . $module_id . '" />';

    $module_langs = get_module_languages(trim($mod_info['short_name']));
    $module_languages = '';
    
    for ($i = 0; $i < count($module_langs); $i++)
    {
        $module_languages .= ( ($module_languages == '') ? $module_langs[$i] : ', ' . $module_langs[$i]);
    }

    $yes_no_switches = array('perm_all', 'perm_reg', 'perm_mod', 'perm_admin');

    for ($i = 0; $i < count($yes_no_switches); $i++)
    {
        eval("\$" . $yes_no_switches[$i] . " = ( intval(\$mod_info['" . $yes_no_switches[$i] . "']) != 0 ) ? 'checked=\"checked\"' : '';");
    }

    $sql = "SELECT group_id, group_name
    FROM " . GROUPS_TABLE . "
    WHERE group_single_user = 0
    ORDER BY group_name";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't query Groups Table", "", __LINE__, __FILE__, $sql);
    }

    $num_groups = $db->sql_numrows($result);
    $group_name = $db->sql_fetchrowset($result);

    $group_ids = array();
    for ($i = 0; $i < $num_groups; $i++)
    {
        $group_ids[] = $group_name[$i]['group_id'];
    }

    $sql = "SELECT g.group_id, g.group_name
    FROM " . GROUPS_TABLE . " g, " . MODULE_GROUP_AUTH_TABLE . " m
    WHERE m.group_id = g.group_id AND m.module_id = " . intval($mod_info['module_id']) . "
    ORDER BY group_name";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't query Groups Table", "", __LINE__, __FILE__, $sql);
    }

    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);

    // Rebuild Auth Table, maybe the user have deleted groups
    if (($num_groups > 0) && ($num_rows > 0))
    {
        for ($i = 0; $i < $num_rows; $i++)
        {
            if (!in_array($rows[$i]['group_id'], $group_ids))
            {
                $sql = "DELETE FROM " . MODULE_GROUP_AUTH_TABLE . " WHERE module_id = " . $module_id . " AND group_id = " . $rows[$i]['group_id'];
            
                if ( !($result = $db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, "Couldn't delete Group", "", __LINE__, __FILE__, $sql);
                }
            }
        }
    }

    $added_groups = array();

    for ($i = 0; $i < $num_rows; $i++)
    {
        $added_groups['group_id'][] = $rows[$i]['group_id'];
        $added_groups['group_name'][] = $rows[$i]['group_name'];
    }

    $act_group = 0;
    if ( $num_groups > 0 )
    {
        $group_select = '<select name="group">';

        for($i = 0; $i < count($group_name); $i++)
        {
            $add = FALSE;

            if (count($added_groups['group_id']) == 0)
            {
                $add = TRUE;
            }
            else if (!in_array($group_name[$i]['group_id'], $added_groups['group_id']))
            {
                $add = TRUE;
            }

            if ($add)
            {
                $selected = ($act_group == 0) ? ' selected="selected"' : '';
                $group_select .= '<option value="' . $group_name[$i]['group_id'] . '"' . $selected . '>' . $group_name[$i]['group_name'] . '</option>';
                $act_group++;
            }
        }
        $group_select .= '</select>';
    }
    
    if ($act_group == 0)
    {
        $group_select = $lang['No_groups_to_add'];
    }
    else
    {
        $template->assign_block_vars('switch_groups_there', array());
    }

    if (count($added_groups['group_id']) == 0)
    {
        $group_added_select = $lang['No_groups_selected'];
    }
    else
    {
        $template->assign_block_vars('switch_groups_selected', array());
        $group_added_select = '<select name="added_group">';

        for($i = 0; $i < count($added_groups['group_id']); $i++)
        {
            $selected = ($i == 0) ? ' selected="selected"' : '';
            $group_added_select .= '<option value="' . $added_groups['group_id'][$i] . '"' . $selected . '>' . $added_groups['group_name'][$i] . '</option>';
        }
        $group_added_select .= '</select>';
    }
    // Module Edit Panel
    $template->assign_vars(array(
        'L_EDIT_MODULE' => $lang['Edit_module'],
        'L_EDIT_MODULE_EXPLAIN' => $lang['Edit_module_explain'],
        'L_MODULE_INFORMATIONS' => $lang['Module_informations'],
        'L_MODULE_NAME' => $lang['Module_name'],
        'L_MODULE_DESCRIPTION' => $lang['Module_description'],
        'L_MODULE_VERSION' => $lang['Module_version'],
        'L_MODULE_AUTHOR' => $lang['Module_author'],
        'L_AUTHOR_EMAIL' => $lang['Author_email'],
        'L_MODULE_URL' => $lang['Module_url'],
        'L_UPDATE_URL' => $lang['Update_url'],
        'L_MODULE_LANGUAGES' => $lang['Module_languages'],
        'L_MODULE_STATUS' => $lang['Module_status'],
        'L_MESSAGES' => $lang['Messages'],
        'L_PREVIEW_MODULE' => $lang['Preview_module'],
        'L_CONFIGURATION' => $lang['Module_configuration'],
        'L_UPDATE_TIME' => $lang['Update_time'],
        'L_UPDATE_TIME_EXPLAIN' => $lang['Update_time_explain'],
        'L_UPDATE_MODULE' => $lang['Update_module'],
        'L_CLEAR_MODULE_CACHE' => $lang['Clear_module_cache'],
        'L_CLEAR_MODULE_CACHE_EXPLAIN' => $lang['Clear_module_cache_explain'],
        'L_SUBMIT' => $lang['Submit'],
        'L_RESET' => $lang['Reset'],
        'L_UPDATE' => $lang['Update'],
    
        'L_PERMISSIONS' => $lang['Permissions'],
        'L_PERMISSIONS_TITLE' => $lang['Set_permissions_title'],
        'L_PERM_ALL' => $lang['Perm_all'],
        'L_PERM_REG' => $lang['Perm_reg'],
        'L_PERM_MOD' => $lang['Perm_mod'],
        'L_PERM_ADMIN' => $lang['Perm_admin'],
        'L_GROUPS' => $lang['Perm_group'],
        'L_ADDED_GROUPS' => $lang['Added_groups'],
        'L_GROUPS_TITLE' => $lang['Perm_groups_title'],
        'L_ADD' => $lang['Perm_add_group'],
        'L_REMOVE' => $lang['Perm_remove_group'],
        
        'PERM_ALL' => $perm_all,
        'PERM_REG' => $perm_reg,
        'PERM_MOD' => $perm_mod,
        'PERM_ADMIN' => $perm_admin,
        'S_GROUP_SELECT' => $group_select,
        'S_SELECTED_GROUPS' => $group_added_select,

        'MODULE_NAME' => nl2br($mod_info['long_name']),
        'MODULE_DESCRIPTION' => nl2br($mod_info['extra_info']),
        'MODULE_AUTHOR' => trim($mod_info['author']),
        'MODULE_VERSION' => trim($mod_info['version']),
        'AUTHOR_EMAIL' => trim($mod_info['email']),
        'MODULE_URL' => trim($mod_info['url']),
        'MODULE_STATUS' => (intval($mod_info['active']) == 1) ? $lang['Active'] : $lang['Not_active'],
        'U_MODULE_URL' => trim($mod_info['url']),
        'UPDATE_URL' => trim($mod_info['update_site']),
        'U_UPDATE_URL' => trim($mod_info['update_site']),
        'MODULE_LANGUAGES' => $module_languages,
        'MESSAGE' => $message,
        'S_HIDDEN_FIELDS' => $s_hidden_fields,
        'UPDATE_TIME' => intval($mod_info['update_time']),
        'S_ACTION' => append_sid('admin_edit_module.'.$phpEx.'?mode='.$mode),
        'U_PREVIEW_MODULE' =>'../../../modules.php?name=Forums&amp;file=statistics&amp;preview='.$module_id)
    );

    // Admin Panel Integration fields
    // Get Module Variables
    $sql = "SELECT * FROM " . MODULE_ADMIN_TABLE . " WHERE module_id = " . $module_id;

    if (!$result = $db->sql_query($sql))
    {
        message_die(GENERAL_ERROR, 'Could not find Module Admin Table', '', __LINE__, __FILE__, $sql);
    }
    
    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);

    if ($num_rows > 0)
    {
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $default_board_lang = trim($board_config['default_lang']);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/

        $language = $board_config['default_lang'];
        $language_file = $phpbb_root_path . 'modules/language/lang_' . $language . '/lang_modules.' . $phpEx;

        if ( !@file_exists(@realpath($language_file)) )
        {
            $language = $default_board_lang;
        }

        $language_file = $phpbb_root_path . 'modules/language/lang_' . $language . '/lang_modules.' . $phpEx;

        include($language_file);

        // Set Language
        $keys = array();
        eval('\$current_lang = $' . $mod_info['short_name'] . ';');
        
        if (is_array($current_lang))
        {
            foreach ($current_lang as $key => $value)
            {
                $lang[$key] = $value;
                $keys[] = $key;
            }
        }
    }

    for ($i = 0; $i < $num_rows; $i++)
    {
        $lang_title = $lang[trim($rows[$i]['config_title'])];
        $lang_explain = (isset($lang[trim($rows[$i]['config_explain'])])) ? $lang[trim($rows[$i]['config_explain'])] : '';

        switch (trim($rows[$i]['config_trigger']))
        {
            case 'enum':
                $option_field = '<input type="radio" name="' . trim($rows[$i]['config_name']) . '" value="1" ';
                if (intval($rows[$i]['config_value']) == 1)
                {
                    $option_field .= 'checked=\"checked\" ';
                }
                $option_field .= ' /> ' . $lang['Yes'] . '&nbsp;&nbsp;<input type="radio" name="' . trim($rows[$i]['config_name']) . '" value="0" ';
                if (intval($rows[$i]['config_value']) == 0)
                {
                    $option_field .= 'checked=\"checked\" ';
                }
                $option_field .= ' /> ' . $lang['No'];
                break;
            case 'integer':
                $option_field = '<input type="text" name="' . trim($rows[$i]['config_name']) . '" value="' . intval($rows[$i]['config_value']) . '" />';
                break;
        }

        $template->assign_block_vars('module_admin_fields', array(
            'L_TITLE' => $lang_title,
            'L_EXPLAIN' => $lang_explain,
            'S_OPTION_FIELD' => $option_field)
        );
    }

    if ( (!isset($HTTP_POST_VARS['fileupload'])) && (!isset($HTTP_POST_VARS['fileselect'])) )
    {
        $module_paks = array();
    
        $dir = @opendir($phpbb_root_path . 'modules/pakfiles');

        while($file = @readdir($dir))
        {
            if( !@is_dir($phpbb_root_path . 'modules/pakfiles' . '/' . $file) )
            {
                if ( preg_match('/\.pak$/i', $file) )
                {
                    $module_paks[] = $file;
                }
            }
        }

        @closedir($dir);

        if (count($module_paks) > 0)
        {
            $module_select_field = '<select name="selected_pak_file">';

            for ($i = 0; $i < count($module_paks); $i++)
            {
                $selected = ($i == 0) ? ' selected="selected"' : '';

                $module_select_field .= '<option value="' . $module_paks[$i] . '"' . $selected . '>' . $module_paks[$i] . '</option>';
            }
    
            $module_select_field .= '</select>';
            
            $s_hidden_fields = '<input type="hidden" name="fileselect" value="1" />';
        }
        else
        {
            $module_select_field = $lang['No_module_packages_found'];
            $s_hidden_fields = '';
        }

        $template->assign_vars(array(
            'L_SELECT_MODULE' => $lang['Select_module_pak'],
            'S_SELECT_MODULE' => $module_select_field,
            'S_SELECT_HIDDEN_FIELDS' => $s_hidden_fields)
        );

        $s_hidden_fields = '<input type="hidden" name="fileupload" value="1" /><input type="hidden" name="update_id" value="' . $module_id . '" />';

        $template->assign_vars(array(
            'L_INSTALL_MODULE' => $lang['Install_module'],
            'L_INSTALL_MODULE_EXPLAIN' => $lang['Install_module_explain'],
            'L_UPLOAD_MODULE' => $lang['Upload_module_pak'],
            'L_SUBMIT' => $lang['Submit'],
            'S_ACTION_UPDATE' => append_sid($phpbb_root_path . 'admin/admin_statistics.'.$phpEx.'?mode=mod_install'),
            'S_UPLOAD_HIDDEN_FIELDS' => $s_hidden_fields)
        );

    }

}
else if ($mode == 'select_module')
{
    $template->set_filenames(array(
        'body' => 'admin/stat_select_module.tpl')
    );

    $sql = "SELECT m.module_id, i.long_name FROM " . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i WHERE i.module_id = m.module_id ORDER BY long_name ASC";

    if (!($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }

    if ($db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_MESSAGE, 'No installed Modules found.');
    }

    $rows = $db->sql_fetchrowset($result);
    
    $module_select_field = '<select name="module">';

    for ($i = 0; $i < count($rows); $i++)
    {
        $selected = ($i == 0) ? ' selected="selected"' : '';

        $module_select_field .= '<option value="' . $rows[$i]['module_id'] . '"' . $selected . '>' . $rows[$i]['long_name'] . '</option>';
    }
    
    $module_select_field .= '</select>';
    
    $template->assign_vars(array(
        'L_SELECT_MODULE_TITLE' => $lang['Module_select_title'],
        'L_SELECT_MODULE_EXPLAIN' => $lang['Module_select_explain'],
        'L_MODULE_SELECT' => $lang['Module_select_title'],
        'L_EDIT' => $lang['Edit'],
        'S_ACTION' => append_sid('admin_edit_module.'.$phpEx.'?mode=mod_edit'),
        'S_MODULE_SELECT' => $module_select_field)
    );

}

$template->pparse('body');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>