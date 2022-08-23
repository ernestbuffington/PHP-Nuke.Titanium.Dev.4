<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             stat_functions.php
 *                            -------------------
 *   begin                : Sat, Jan 04, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: stat_functions.php,v 1.18 2003/02/12 16:41:35 acydburn Exp $
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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

function sql_quote($data)
{
    $data = str_replace("'", "\'", $data);
    return ($data);
}

function clear_directory($file = 'modules/cache') 
{
    global $directory_mode, $phpbb_root_path;

    if (file_exists($phpbb_root_path . $file)) 
    {
        @chmod($phpbb_root_path . $file, $directory_mode);
            
        if (is_dir($phpbb_root_path . $file))
        {
            $dir = opendir($phpbb_root_path . $file); 
            while ($filename = readdir($dir)) 
            {
                if ($filename != '.' && $filename != '..' && $filename != '.htaccess' && $filename != 'CVS' && $filename != 'pakfiles') 
                {
                    clear_directory($file . '/' . $filename);
                }
            }
            closedir($dir);
            if ($file != 'modules')
            {
                @rmdir($phpbb_root_path . $file);
            }
        } 
        else 
        {
            @unlink($phpbb_root_path . $file);
        }
    }
}

// 
// Check if a user is within Group
//
function user_is_within_group($user_id, $group_id)
{
    global $db;

    if ((empty($user_id)) || (empty($group_id)))
    {
        return (FALSE);
    }
    
    $sql = "SELECT u.group_id FROM " . USER_GROUP_TABLE . " u, " . GROUPS_TABLE . " g 
    WHERE (g.group_single_user = 0) AND (u.group_id = g.group_id) AND (u.user_id = " . $user_id . ") AND (g.group_id = " . $group_id . ")
    LIMIT 1";
            
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get User Group', '', __LINE__, __FILE__, $sql);
    }

    if ($db->sql_numrows($result) == 0)
    {
        return (FALSE);
    }
    else
    {
        return (TRUE);
    }
}

// Get module informations
function get_modules($activated = true, $module_id = -1)
{
    global $db, $stats_config, $userdata;

    $where_statement = ($activated) ? 'WHERE active = 1 ' : '';
    if ($module_id != -1)
    {
        $where_statement .= (($where_statement == '') ? 'WHERE module_id = ' . intval($module_id) . ' ' : 'AND module_id = ' . intval($module_id) . ' ');
    }

    // Now let us get them in correct order
    $sql = "SELECT * FROM " . MODULES_TABLE . " " . $where_statement . "
    ORDER BY module_order ASC";

    if (!($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get module informations', "", __LINE__, __FILE__, $sql);
    }

    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);

    // Check Group
    $sql = "SELECT * FROM " . MODULE_GROUP_AUTH_TABLE;

    if (!($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get Permission informations', '', __LINE__, __FILE__, $sql);
    }
            
    $g_rows = $db->sql_fetchrowset($result);
    $g_num_rows = $db->sql_numrows($result);
    $authed_groups = array();

    for ($i = 0; $i < $g_num_rows; $i++)
    {
        $authed_groups[$g_rows[$i]['module_id']][] = $g_rows[$i]['group_id'];
    }

    $modules = array();

    // Check Authentication
    for ($i = 0; $i < $num_rows; $i++)
    {
        $authed = FALSE;

        if (intval($rows[$i]['perm_all']) == 1)
        {
            $authed = TRUE;
        }
        
        if (intval($rows[$i]['perm_reg']) == 1)
        {
            if ($userdata['user_id'] != ANONYMOUS)
            {
                $authed = TRUE;
            }
        }
    
        if (intval($rows[$i]['perm_mod']) == 1)
        {
            if ($userdata['user_level'] == MOD)
            {
                $authed = TRUE;
            }
        }

        if (intval($rows[$i]['perm_admin']) == 1)
        {
            if ($userdata['user_level'] == ADMIN)
            {
                $authed = TRUE;
            }
        }
    
        if (!$authed)
        {
            for ($j = 0; $j < count($authed_groups[$rows[$i]['module_id']]) && !$authed; $j++)
            {
                if (user_is_within_group($userdata['user_id'], $authed_groups[$rows[$i]['module_id']][$j]))
                {
                    $authed = TRUE;
                }
            }
        }

        if ($authed)
        {
            $modules[] = $rows[$i];
        }
    }

    return ($modules);
}

function get_num_modules($activated = true)
{
    global $db, $stats_config;

    $where_statement = ($activated) ? 'WHERE active = 1 ' : '';

    $sql = "SELECT COUNT(*) as total FROM " . MODULES_TABLE . " " . $where_statement;

    if (!($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get module informations', "", __LINE__, __FILE__, $sql);
    }

    $row = $db->sql_fetchrow($result);

    return(intval($row['total']));
}

// Determine if we have to use the db cache
function module_use_db_cache($module_id, &$cache)
{
    global $db, $core;

    $core->module_info['last_update_time'] = 0;
    $core->module_info['next_update_time'] = 0;
    
    $sql = "SELECT c.*, m.update_time FROM " . CACHE_TABLE . " c, " . MODULES_TABLE . " m WHERE c.module_id = " . $module_id . " AND m.module_id = c.module_id";

    if (!($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get cache informations', "", __LINE__, __FILE__, $sql);
    }
    
    if ($db->sql_numrows($result) == 0)
    {
        return (false);
    }
    
    $row = $db->sql_fetchrow($result);
    $core->module_info['last_update_time'] = intval($row['module_cache_time']);
    $core->module_info['next_update_time'] = intval($row['module_cache_time']) + (intval($row['update_time']) * 60);
    
    if ((trim($row['db_cache']) == '') || (intval($row['update_time']) == 0))
    {
        return (false);
    }

    $cache = trim($row['db_cache']);

    // Determine last update time to use the cache -- determine dependencies/cache priority too
    if ((intval($row['module_cache_time']) + (intval($row['update_time']) * 60)) > time())
    {
        return (true);
    }
    
    // longer than one day not updated ?
    if ((intval($row['module_cache_time']) + (intval($row['update_time']) * 60)) < (time()+86400))
    {
        return (false);
    }

    // If another Module got re-loaded, we have to use the cache
    if ($core->module_reloaded)
    {
        set_module_cache_priority($module_id, 1);
        return (true);
    }

    $cache_priority = module_cache_priority($module_id, intval($row['priority']));
    
    if ($cache_priority == HIGHEST_PRIORITY)
    {
        $core->module_reloaded = true;
        set_module_cache_priority($module_id, (-1));
        return (false);
    }

    return (true);
}

function set_module_cache_priority($module_id, $add_value)
{
    global $db;

    if ($add_value < 0)
    {
        $set = 'priority = priority ' . intval($add_value);
    }
    else if ($add_value > 0)
    {
        $set = 'priority = priority + ' . intval($add_value);
    }
    else
    {
        return;
    }

    $sql = "UPDATE " . CACHE_TABLE . " SET " . $set . " WHERE module_id = " . intval($module_id);

    if (!$db->sql_query($sql))
    {
        message_die(GENERAL_ERROR, 'Unable to update cache priority', '', __LINE__, __FILE__, $sql);
    }

    return;
}

function reset_module_cache_priority($module_id)
{
    global $db;
    
    $sql = "UPDATE " . CACHE_TABLE . " SET priority = 0 WHERE module_id = " . intval($module_id);

    if (!$db->sql_query($sql))
    {
        message_die(GENERAL_ERROR, 'Unable to update cache priority', '', __LINE__, __FILE__, $sql);
    }

    return;
}

function module_cache_priority($module_id, $current_priority)
{
    global $db, $core, $stat_functions;

    $sql = "SELECT priority FROM " . CACHE_TABLE . " WHERE module_id <> " . $module_id . " AND priority > 0 ORDER BY priority ASC";

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to get cache priority', '', __LINE__, __FILE__, $sql);
    }
    
    $num_rows = $db->sql_numrows($result);
    $rows = $db->sql_fetchrowset($result);

    if ($num_rows == 0)
    {
        return (HIGHEST_PRIORITY);
    }

    if ($current_priority == 0)
    {
        set_module_cache_priority($module_id, 1);
        return (LOWEST_PRIORITY);
    }
    
    if ($current_priority < $rows[0]['priority'])
    {
        return (LOWEST_PRIORITY);
    }

    if ($current_priority >= $rows[$num_rows-1]['priority'])
    {
        set_module_cache_priority($module_id, (-1));
        return (HIGHEST_PRIORITY);
    }

    set_module_cache_priority($module_id, 1);
    return (EQUAL_PRIORITY);
}

// parse info file
function parse_info_file($content)
{
    $ret_array = array();

    $in_block = FALSE;
    $block_name = '';
    $content = explode("\n", $content);

    while (list($key, $data) = @each($content))
    {
        if (!$in_block)
        {
            if (preg_match("/\[name\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'name';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[short_name\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'short_name';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[author\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'author';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[email\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'email';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[url\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'url';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[version\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'version';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[stats_mod_version\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'stats_mod_version';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[update_time\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'update_time';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[check_update_site\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'check_update_site';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[extra_info\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'extra_info';
                $ret_array[$block_name] = '';
            }
            else if (preg_match("/\[admin_panel\]/", $data))
            {
                $in_block = TRUE;
                $block_name = 'admin_panel';
                $ret_array[$block_name] = '';
            }
        }
        else
        {
            if (preg_match("/\[\/" . $block_name . "\]/", $data))
            {
                $in_block = FALSE;
            }
            else
            {
                if ($ret_array[$block_name] != '')
                {
                    $ret_array[$block_name] .= "\n";
                }
                $ret_array[$block_name] .= trim($data);
            }
        }
    }

    return $ret_array;
}

// parse lang file
function parse_lang_file($content, $only_languages = array())
{
    $ret_array = array();

    $in_block = FALSE;
    $block_name = '';
    $content = explode("\n", $content);

    $choose_lang = (count($only_languages) == 0) ? FALSE : TRUE;

    while (list($key, $data) = @each($content))
    {
        if (!$in_block)
        {
            if (preg_match("/(.*?)\[lang_(.*?)\]/", $data))
            {
                $in_block = TRUE;
                $block_name = preg_replace("/(.*?)\[(.*?)\]/", "\\2", $data);
                $block_name = trim($block_name);
                if ($choose_lang)
                {
                    if (in_array($block_name, $only_languages))
                    {
                        $ret_array[$block_name] = '';
                    }
                }
                else
                {
                    $ret_array[$block_name] = '';
                }
            }
        }
        else
        {
            if (preg_match("/\[\/" . preg_quote($block_name) . "\]/", $data))
            {
                $in_block = FALSE;
            }
            else
            {
                if ($choose_lang)
                {
                    if (in_array($block_name, $only_languages))
                    {
                        if ($ret_array[$block_name] != '')
                        {
                            $ret_array[$block_name] .= "\n";
                        }
                        $ret_array[$block_name] .= trim($data);
                    }
                }
                else
                {
                    if ($ret_array[$block_name] != '')
                    {
                        $ret_array[$block_name] .= "\n";
                    }
                    $ret_array[$block_name] .= trim($data);
                }
            }
        }
    }

    return $ret_array;
}

?>