<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                           admin_stats_config.php
*                            -------------------
*   begin                : Sat, Jan 04, 2003
*   copyright            : (C) 2003 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: admin_stats_config.php,v 1.9 2003/02/12 16:41:34 acydburn Exp $
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
    $module['Statistics']['Stats_configuration'] = $filename . '?mode=config';
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

if ($submit)
{
    $message = '';
    $config_update = FALSE;

    // Go through all configuration settings
    if ( (intval($stats_config['return_limit']) != intval($HTTP_POST_VARS['return_limit'])) )
    {
        $sql = "UPDATE " . STATS_CONFIG_TABLE . " SET config_value = '" . trim($HTTP_POST_VARS['return_limit']) . "' WHERE config_name = 'return_limit'";

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update statistics config table', '', __LINE__, __FILE__, $sql);
        }
        
        $config_update = TRUE;
    }

    if ($config_update)
    {
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

        $message = ($message == '') ? $message . $lang['Msg_config_updated'] : $message . '<br />' . $lang['Msg_config_updated'];
    }

    // Reset Settings
    if (isset($HTTP_POST_VARS['reset_view_count']))
    {
        $sql = "UPDATE " . STATS_CONFIG_TABLE . " SET config_value = '0' WHERE config_name = 'page_views'";

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update statistics config table', '', __LINE__, __FILE__, $sql);
        }

        $message = ($message == '') ? $message . $lang['Msg_reset_view_count'] : $message . '<br />' . $lang['Msg_reset_view_count'];
    }

    // Reset Settings
    if (isset($HTTP_POST_VARS['reset_install_date']))
    {
        $sql = "UPDATE " . STATS_CONFIG_TABLE . " SET config_value = '" . time() . "' WHERE config_name = 'install_date'";

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update statistics config table', '', __LINE__, __FILE__, $sql);
        }

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

        $message = ($message == '') ? $message . $lang['Msg_reset_install_date'] : $message . '<br />' . $lang['Msg_reset_install_date'];
    }

    // Reset Cache
    if (isset($HTTP_POST_VARS['reset_cache']))
    {
        // Clear Module Cache
        $sql = "UPDATE " . CACHE_TABLE . " SET module_cache_time = 0, db_cache = '', priority = 0";

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update cache table', '', __LINE__, __FILE__, $sql);
        }

        // Clear the Smilies Cache
        $sql = "DELETE FROM " . SMILIE_INDEX_TABLE;

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update smiley index table', '', __LINE__, __FILE__, $sql);
        }

        $sql = "UPDATE " . SMILIE_INFO_TABLE . " SET last_post_id = 0, last_update_time = 0";

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to update smiley info table', '', __LINE__, __FILE__, $sql);
        }

        // Clear Cache Directory
        clear_directory('modules/cache');

        $message = ($message == '') ? $message . $lang['Msg_reset_cache'] : $message . '<br />' . $lang['Msg_reset_cache'];
    }

    // Delete Module Directory
    if (isset($HTTP_POST_VARS['purge_module_directory']))
    {
        clear_directory('modules');

        $message = ($message == '') ? $message . $lang['Msg_purge_modules'] : $message . '<br />' . $lang['Msg_purge_modules'];
    }

}

if ($mode == 'config')
{
    $template->set_filenames(array(
        'body' => 'admin/stat_config_body.tpl')
    );

    $template->assign_vars(array(
        'L_SUBMIT' => $lang['Submit'],
        'L_RESET' => $lang['Reset'],
        'L_MESSAGES' => $lang['Messages'],
        'L_CONFIGURATION' => $lang['Stats_configuration'],
        'L_CONFIG_TITLE' => $lang['Config_title'],
        'L_CONFIG_EXPLAIN' => $lang['Config_explain'],
        'L_RETURN_LIMIT' => $lang['Return_limit'],
        'L_PURGE_MODULE_DIRECTORY' => $lang['Purge_module_dir'],
        'L_PURGE_MODULE_DIRECTORY_EXPLAIN' => $lang['Purge_module_dir_explain'],
        'L_RETURN_LIMIT_EXPLAIN' => $lang['Return_limit_explain'],
        'L_RESET_SETTINGS_TITLE' => $lang['Reset_settings_title'],
        'L_RESET_VIEW_COUNT' => $lang['Reset_view_count'],
        'L_RESET_VIEW_COUNT_EXPLAIN' => $lang['Reset_view_count_explain'],
        'L_RESET_INSTALL_DATE' => $lang['Reset_install_date'],
        'L_RESET_INSTALL_DATE_EXPLAIN' => $lang['Reset_install_date_explain'],
        'L_RESET_CACHE' => $lang['Reset_cache'],
        'L_RESET_CACHE_EXPLAIN' => $lang['Reset_cache_explain'],
    
        'RETURN_LIMIT' => $stats_config['return_limit'],
        'MODULE_PAGINATION' => $stats_config['modules_per_page'],
        'S_ACTION' => append_sid('admin_stats.'.$phpEx.'?mode='.$mode),
        'MESSAGE' => $message)
    );
}

$template->assign_vars(array(
    'VIEWED_INFO' => sprintf($lang['Viewed_info'], $stats_config['page_views']),
    'INSTALL_INFO' => sprintf($lang['Install_info'], create_date($board_config['default_dateformat'], $stats_config['install_date'], $board_config['board_timezone'])),
    'VERSION_INFO' => sprintf($lang['Version_info'], $stats_config['version']))
);

$template->pparse('body');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>