<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                           admin_stats_lang.php
*                            -------------------
*   begin                : Sat, Jan 04, 2003
*   copyright            : (C) 2003 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: admin_stats_lang.php,v 1.8 2003/03/16 18:38:29 acydburn Exp $
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

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

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
    $module['Statistics']['Stats_langcp'] = $filename . '?mode=select';
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

if( isset($HTTP_POST_VARS['m_mode']) || isset($HTTP_GET_VARS['m_mode']) )
{
    $m_mode = ( isset($HTTP_POST_VARS['m_mode']) ) ? $HTTP_POST_VARS['m_mode'] : $HTTP_GET_VARS['m_mode'];
}
else
{
    $m_mode = '';
}

$lang_decollapse = (isset($HTTP_GET_VARS['d_lang'])) ? trim($HTTP_GET_VARS['d_lang']) : '';
$submit = (isset($HTTP_POST_VARS['submit'])) ? TRUE : FALSE;
@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_statistics.' . $phpEx);
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

$update_list = ( isset($HTTP_POST_VARS['update']) ) ? $HTTP_POST_VARS['update'] : array();
$delete_list = ( isset($HTTP_POST_VARS['delete']) ) ? $HTTP_POST_VARS['delete'] : array();
$lang_entry = ( isset($HTTP_POST_VARS['lang_entry']) ) ? $HTTP_POST_VARS['lang_entry'] : array();
$update_all_lang = ( isset($HTTP_POST_VARS['update_all_lang']) ) ? TRUE : FALSE;
$add_new_key = ( isset($HTTP_POST_VARS['add_new_key']) ) ? $HTTP_POST_VARS['add_new_key'] : array();
$add_key = ( isset($HTTP_POST_VARS['add_key']) ) ? trim(htmlspecialchars($HTTP_POST_VARS['add_key'])) : '';
$add_value = ( isset($HTTP_POST_VARS['add_value']) ) ? trim($HTTP_POST_VARS['add_value']) : '';

$new_lang_submit = ( isset($HTTP_POST_VARS['new_lang_submit']) ) ? TRUE : FALSE;
$new_language = ( isset($HTTP_POST_VARS['new_language']) ) ? trim($HTTP_POST_VARS['new_language']) : '';

$delete_complete_lang = ( isset($HTTP_POST_VARS['delete_complete_lang']) ) ? $HTTP_POST_VARS['delete_complete_lang'] : array();

if (($new_lang_submit) && ($new_language != ''))
{
    if (!strstr($new_language, 'lang_'))
    {
        message_die(GENERAL_MESSAGE, 'Please specify a valid Language to be created');
    }

    $installed_languages = get_all_installed_languages();

    if (count($installed_languages) > 0)
    {
        if (in_array($new_language, $installed_languages))
        {
            message_die(GENERAL_MESSAGE, 'The Language ' . $new_language . ' already exist.');
        }

        if (in_array('lang_english', $installed_languages))
        {
            $preset = 'lang_english';
        }
        else
        {
            $preset = $installed_languages[0];
        }
    }
    else
    {
        $preset = '';
    }

    if ($preset != '')
    {
        add_new_language($new_language, $preset);
    }
    else
    {
        add_empty_language($new_language);
    }
    
    $mode = 'select';
    $m_mode = 'edit';
    $HTTP_GET_VARS['lang'] = $new_language;
}
else if (count($delete_complete_lang) > 0)
{
    @reset($delete_complete_lang);
    list($language, $value) = each($delete_complete_lang);

    $language = trim($language);

    delete_complete_language($language);
    $m_mode = '';
}

if (count($update_list) > 0)
{
    @reset($update_list);
    list($language, $v_array) = each($update_list);
    list($module_id, $v2_array) = each($v_array);
    list($key, $value) = each($v2_array);

    set_lang_entry($language, $module_id, $key, $lang_entry[$language][$module_id][$key]);
}
else if ($update_all_lang)
{
    @reset($lang_entry);

    // Begin Language
    while (list($language, $v_array) = each($lang_entry))
    {
        // Begin Modules
        while (list($module_id, $v2_array) = each($v_array))
        {
            $lang_block = '';
            // Begin Language Entries
            while (list($key, $value) = each($v2_array))
            {
                $lang_block .= '$lang[\'' . trim($key) . '\'] = \'' . trim($value) . '\';';
                $lang_block .= "\n";
            }
            set_lang_block($language, $module_id, $lang_block);
        }
    }
}
else if (($add_key != '') && (count($add_new_key) > 0))
{
    @reset($add_new_key);
    list($language, $v_array) = each($add_new_key);
    list($module_id, $value) = each($v_array);
    
    lang_add_new_key($language, $module_id, $add_key, $add_value);
}
else if (count($delete_list) > 0)
{
    @reset($delete_list);
    list($language, $v_array) = each($delete_list);
    list($module_id, $v2_array) = each($v_array);
    list($key, $value) = each($v2_array);

    delete_lang_key($language, $module_id, $key);
}

if ($mode == 'select')
{
    $template->set_filenames(array(
        'body' => 'admin/stat_admin_lang.tpl',
        'lang_body' => 'admin/stat_edit_lang.tpl')
    );

    $template->assign_vars(array(
        'L_EDIT' => $lang['Edit'],
        'L_UPDATE' => $lang['Update'],
        'L_DELETE' => $lang['Delete'],
        'L_EXPORT_MODULE' => $lang['Export_lang_module'],
        'L_COMPLETE_LANG_EXPORT' => $lang['Export_language'],
        'L_COMPLETE_EXPORT' => $lang['Export_everything'],
        'L_LANG_CP_TITLE' => $lang['Language_cp_title'],
        'L_LANG_CP_EXPLAIN' => $lang['Language_cp_explain'],
        'L_LANGUAGE_KEY' => $lang['Language_key'],
        'L_LANGUAGE_VALUE' => $lang['Language_value'],
        'L_UPDATE_ALL' => $lang['Update_all_lang'],
        'L_ADD_NEW_KEY' => $lang['Add_new_key'],
        'L_CREATE_NEW_LANG' => $lang['Create_new_lang'],
        'L_DELETE_LANG' => $lang['Delete_language'],
        'L_IMPORT_NEW_LANGUAGE' => $lang['Import_new_language'],

        'U_NEW_LANG_IMPORT' => $phpbb_root_path . 'admin/import_lang.php?mode=import_new_lang',
        'U_LANG_COMPLETE_EXPORT' => $phpbb_root_path . 'admin/download_lang.php?mode=export_everything')
    );
    
    // Collect available Languages
    $provided_languages = get_all_installed_languages();

    $sql = "SELECT m.*, i.* FROM " . MODULES_TABLE . " m, " . MODULE_INFO_TABLE . " i WHERE i.module_id = m.module_id";

    if (!($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get Module Informations', '', __LINE__, __FILE__, $sql);
    }

    $modules = $db->sql_fetchrowset($result);

    for ($i = 0; $i < count($provided_languages); $i++)
    {
        if ($lang_decollapse == $provided_languages[$i])
        {
            $col_decol = '-';
            $link_col_decol = $phpbb_root_path . 'admin/admin_stats_lang.php?mode=select';
        }
        else
        {
            $col_decol = '+';
            $link_col_decol = $phpbb_root_path . 'admin/admin_stats_lang.php?mode=select&amp;d_lang=' . $provided_languages[$i];
        }

        $template->assign_block_vars('langrow', array(
            'LANGUAGE' => $provided_languages[$i],
            'L_COLLAPSE_DECOLLAPSE' => $col_decol,
            'U_COLLAPSE_DECOLLAPSE' => $link_col_decol,
            'U_LANG_COMPLETE_EDIT' => $phpbb_root_path . 'admin/admin_stats_lang.php?mode=select&amp;m_mode=edit&amp;lang=' . $provided_languages[$i] . '&amp;d_lang=' . $lang_decollapse,
            'U_LANG_COMPLETE_EXPORT' => $phpbb_root_path . 'admin/download_lang.php?mode=export_lang&amp;lang=' . $provided_languages[$i])
        );

        if ($lang_decollapse == $provided_languages[$i])
        {
            for ($j = 0; $j < count($modules); $j++)
            {
                $informations = ( intval($modules[$j]['active']) == 1) ? 'Active' : 'Not Active';

                if (!module_is_in_lang($modules[$j]['short_name'], $provided_languages[$i]))
                {
                    $informations .= '<br />No Content';
                }
            
                $template->assign_block_vars('langrow.modulerow', array(
                    'MODULE_NAME' => $modules[$j]['long_name'],
                    'MODULE_DESC' => $modules[$j]['extra_info'],
                    'U_LANG_EDIT' => $phpbb_root_path . 'admin/admin_stats_lang.php?mode=select&amp;m_mode=edit&amp;lang=' . $provided_languages[$i] . '&amp;module=' . $modules[$j]['module_id'] . '&amp;d_lang=' . $lang_decollapse,
                    'U_LANG_EXPORT' => $phpbb_root_path . 'admin/download_lang.php?mode=export_module&amp;lang=' . $provided_languages[$i] . '&amp;module=' . $modules[$j]['module_id'],
                    'INFORMATIONS' => $informations)
                );
            }
        }
    }
    if ($m_mode == 'edit')
    {
        $module_id = (isset($HTTP_GET_VARS['module'])) ? intval($HTTP_GET_VARS['module']) : -1;
        $language = (isset($HTTP_GET_VARS['lang'])) ? trim($HTTP_GET_VARS['lang']) : '';
        
        if ($language == '')
        {
            message_die(GENERAL_MESSAGE, 'Invalid Call, Hacking Attempt ?');
        }
        
        $current_modules = array();

        if ($module_id != -1)
        {
            for ($i = 0; $i < count($modules); $i++)
            {
                if (intval($modules[$i]['module_id']) == $module_id)
                {
                    $current_modules[0] = $modules[$i];
                    break;
                }
            }
        }
        else
        {
            $current_modules = $modules;
        }

        $template->assign_vars(array(
            'LANGUAGE' => $language)
        );

        for ($i = 0; $i < count($current_modules); $i++)
        {
            $template->assign_block_vars('modules', array(
                'MODULE_NAME' => $current_modules[$i]['long_name'],
                'MODULE_ID' => $current_modules[$i]['module_id'])
            );

            $lang_entries = get_lang_entries($current_modules[$i]['short_name'], $language);
        
            for ($j = 0; $j < count($lang_entries); $j++)
            {
                $template->assign_block_vars('modules.language_entries', array(
                    'KEY' => $lang_entries[$j]['key'],
                    'MODULE_ID' => $current_modules[$i]['module_id'],
                    'VALUE' => $lang_entries[$j]['value'])
                );
            }
        }

        $template->assign_var_from_handle('EDIT_LANG_PANEL', 'lang_body');
    }
}

$template->pparse('body');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>