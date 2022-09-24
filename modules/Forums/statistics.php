<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                statistics.php
 *                            -------------------
 *   begin                : Wed, Jan 01, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: statistics.php,v 1.18 2003/03/16 19:38:28 acydburn Exp $
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
      Evolution Functions                      v1.5.0       10/24/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}
global $directory_mode;

$titanium_module_name = basename(dirname(__FILE__));
require("modules/".$titanium_module_name."/nukebb.php");

define('IN_PHPBB2', true);
//$phpbb2_root_path = "./";

include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);

$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_INDEX);
titanium_init_userprefs($userdata);

include($phpbb2_root_path . 'stats_mod/includes/constants.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/lang_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/stat_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/template.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/core.'.$phpEx);

if (STATS_DEBUG)
{
    $m_time = microtime();
    $m_time = explode(" ",$m_time);
    $m_time = $m_time[1] + $m_time[0];
    $stats_starttime = $m_time;
}

$sql = 'SELECT *
        FROM ' . STATS_CONFIG_TABLE;

if ( !($result = $titanium_db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

$stats_config = array();

while ($row = $titanium_db->sql_fetchrow($result))
{
    $stats_config[$row['config_name']] = trim($row['config_value']);
}
$titanium_db->sql_freeresult($result);

init_core();

if (isset($HTTP_GET_VARS['preview']))
{
    $preview_module = intval($HTTP_GET_VARS['preview']);
}
else
{
    $preview_module = -1;
}

if ($preview_module == -1 || $preview_module == 0 || $userdata['user_level'] != ADMIN)
{
    // Get all module informations about activated modules
    $titanium_modules = get_modules();
}
else
{
    // Get all module informations about given module_id (activated or not)
    $titanium_modules = get_modules(false, $preview_module);
    $core->do_not_use_cache = TRUE;
}

/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
$default_board_lang = trim($phpbb2_board_config['default_lang']);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/

// Include Language
$titanium_lang_failover = array($phpbb2_board_config['default_lang'], $default_board_lang, 'english');
$titanium_languages_to_include = array(
    'language/lang_xxx/lang_admin.' . $phpEx,
    'language/lang_xxx/lang_statistics.' . $phpEx,
    'modules/language/lang_xxx/lang_modules.' . $phpEx
);

for ($i = 0; $i < count($titanium_languages_to_include); $i++)
{
    $found = FALSE;

    for ($j = 0; $j < count($titanium_lang_failover) && !$found; $j++)
    {
        $titanium_language_file = $phpbb2_root_path . str_replace('xxx', $titanium_lang_failover[$j], $titanium_languages_to_include[$i]);

        if (file_exists($titanium_language_file))
        {
            @include_once($titanium_language_file);
            $found = TRUE;
            if (strstr($titanium_languages_to_include[$i], 'lang_modules'))
            {
                $core->used_language = $titanium_lang_failover[$j];
            }
        }
    }
}

if (trim($core->used_language) == '')
{
    $core->used_language = $default_board_lang;
}

$phpbb2_page_title = $titanium_lang['Board_statistics'];
include('includes/page_header.'.$phpEx);

$development = FALSE;

/*
// MDK -> Develop a Module
$development = TRUE;

$dev_module = array();

$dev_module['short_name'] = 'stats_overview';
$dev_module['location'] = 'dev';
$dev_module['lang_path'] = 'dev/language';
*/

if ($development)
{
    $first_iterate = TRUE;

    $core->current_module_path = $phpbb2_root_path . $dev_module['location'] . '/' . trim($dev_module['short_name']) . '/';
    $core->current_module_name = trim($dev_module['short_name']);
    $core->current_module_id = -1;
    $core->do_not_use_cache = TRUE;

    // Include Language File
    $titanium_language = $phpbb2_board_config['default_lang'];
    $titanium_language_file = $phpbb2_root_path . $dev_module['lang_path'] . '/lang_' . $titanium_language . '/lang_modules.' . $phpEx;

    if (!file_exists($titanium_language_file))
    {
        $titanium_language = $default_board_lang;
    }

    $titanium_language_file = $phpbb2_root_path . $dev_module['lang_path'] . '/lang_' . $titanium_language . '/lang_modules.' . $phpEx;

    include($titanium_language_file);

    include($core->current_module_path . "module.$phpEx");
}

$iterate_index = 0;
$iterate_end = count($titanium_modules);

while ($iterate_index < $iterate_end)
{
    $first_iterate = ($iterate_index == 0 && !$development) ? TRUE : FALSE;
    $last_iterate = ($iterate_index == $iterate_end-1) ? TRUE : FALSE;

    $core->current_module_path = $phpbb2_root_path . 'modules/' . trim($titanium_modules[$iterate_index]['short_name']) . '/';
    $core->current_module_name = trim($titanium_modules[$iterate_index]['short_name']);
    $core->current_module_id = intval($titanium_modules[$iterate_index]['module_id']);

    // Set Language
    $keys = array();
    eval('$current_lang = $' . $core->current_module_name . ';');

    if (is_array($current_lang))
    {
        foreach ($current_lang as $key => $value)
        {
            $titanium_lang[$key] = $value;
            $keys[] = $key;
        }
    }

    include($core->current_module_path . 'module.'.$phpEx);

    $iterate_index++;

  // Unset the language keys
    for ($i = 0; $i < count($keys); $i++)
    {
        unset($titanium_lang[$keys[$i]]);
    }
}

$sql = "UPDATE " . STATS_CONFIG_TABLE . "
SET config_value = " . (intval($stats_config['page_views']) + 1) . "
WHERE (config_name = 'page_views')";

if (!$titanium_db->sql_query($sql))
{
    message_die(GENERAL_ERROR, 'Unable to Update View Counter', '', __LINE__, __FILE__, $sql);
}

if (STATS_DEBUG)
{
    if (!file_exists($phpbb2_root_path . 'modules/cache/explain'))
    {
        @umask(0);
        mkdir($phpbb2_root_path . 'modules/cache/explain', $directory_mode);
    }

    $m_time = microtime();
    $m_time = explode(" ",$m_time);
    $m_time = $m_time[1] + $m_time[0];
    $stats_endtime = $m_time;
    $stats_totaltime = ($stats_endtime - $stats_starttime);

    $explain = ($userdata['user_level'] == ADMIN) ? $phpbb2_root_path . 'modules/cache/explain/e' . $userdata['user_id'] . '.html' : '';

    $phpbb2_template->assign_vars(array(
        'TIME' => $stats_totaltime,
        'SQL_TIME' => $stat_db->sql_time,
        'QUERY' => $stat_db->num_queries,
        'U_EXPLAIN' => $explain)
    );

    $phpbb2_template->assign_block_vars('switch_debug', array());

    if ($stat_db->sql_time > 0)
    {
        $fp = fopen($phpbb2_root_path . 'modules/cache/explain/e' . $userdata['user_id'] . '.html', 'wt');
        fwrite($fp, $stat_db->sql_report);
        $str = "<pre><strong>The Statistics Mod generated " . $stat_db->num_queries . " queries,\nspending " . $stat_db->sql_time . ' doing MySQL queries and ' . ($stats_totaltime - $stat_db->sql_time) . ' doing PHP things.</strong></pre>';
        fwrite($fp, $str);
        fclose($fp);
    }

}

$phpbb2_template->set_filenames(array(
    'body' => 'statistics.tpl')
);

$phpbb2_template->pparse('body');

include('includes/page_tail.'.$phpEx);

?>