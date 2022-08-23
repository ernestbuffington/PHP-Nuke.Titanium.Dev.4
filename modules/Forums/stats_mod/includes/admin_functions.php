<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             admin_functions.php
 *                            -------------------
 *   begin                : Sat, Jan 04, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: admin_functions.php,v 1.13 2003/03/16 18:38:30 acydburn Exp $
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

// Build and install Module
function build_module($info_array, $lang_array, $php_file, $module_id = -1)
{
    global $directory_mode, $file_mode, $phpbb_root_path, $db, $lang;
    
    if ($module_id == -1)
    {
        $sql = "SELECT short_name FROM " . MODULES_TABLE . " WHERE short_name = '" . trim($info_array['short_name']) . "'";

        if (!($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to get short name', '', __LINE__, __FILE__, $sql);
        }
    
        if ($db->sql_numrows($result) > 0)
        {
            message_die(GENERAL_ERROR, sprintf($lang['Inst_module_already_exist'], trim($info_array['short_name'])));
        }
    }
    else
    {
        $sql = "SELECT * FROM " . MODULES_TABLE . " WHERE module_id = " . $module_id;

        if (!($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
        }
    
        if ($db->sql_numrows($result) == 0)
        {
            message_die(GENERAL_ERROR, 'Unable to get Module ' . $module_id);
        }
        
        $update_module_row = $db->sql_fetchrow($result);

        if (trim($update_module_row['short_name']) != trim($info_array['short_name']))
        {
            message_die(GENERAL_ERROR, $lang['Incorrect_update_module']);
        }
    }

    $directory = $phpbb_root_path . 'modules/' . trim($info_array['short_name']);

    if (!file_exists($directory))
    {
        @umask(0);
        mkdir($directory, $directory_mode);
    }
    else
    {
        chmod($directory, $directory_mode);
    }

    // Write module.php
    $module = $directory . '/module.php';

    if (file_exists($module))
    {
        chmod($module, $directory_mode);
    }

    if (!($fp = fopen($module, 'wt')))
    {
        message_die(GENERAL_MESSAGE, 'Unable to write ' . $module);
    }

    $php_file = trim($php_file);
    fwrite($fp, $php_file, strlen($php_file));
    
    fclose($fp);

    chmod($module, $file_mode);
    chmod($directory, $directory_mode);

    $short_name = trim($info_array['short_name']);

    // Write Language File
    @reset($lang_array);
    while (list($key, $data) = @each($lang_array))
    {
        $language = trim($key);
        $language_dir = $phpbb_root_path . 'modules/language';
        $language_file = $phpbb_root_path . 'modules/language/' . $language . '/lang_modules.php';

        if (!file_exists($language_dir))
        {
            @umask(0);
            mkdir($language_dir, $directory_mode);
        }
        else
        {
            chmod($language_dir, $directory_mode);
        }
        
        if (!file_exists($language_dir . '/' . $language))
        {
            @umask(0);
            mkdir($language_dir . '/' . $language, $directory_mode);
        }
        else
        {
            chmod($language_dir . '/' . $language, $directory_mode);
        }
        
        if (!file_exists($language_file))
        {
            $contents = "<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
\n\n\n?>";
        }
        else
        {
            chmod($language_file, $file_mode);
            $contents = implode('', @file($language_file));
            
            if ($module_id != -1)
            {
                $contents = delete_language_block($contents, $short_name);
            }
        }
        
        $contents = str_replace('?>', '', $contents);
        $contents = trim($contents) . "\n";

        // add the BEGIN
        $contents .= "\n// [" . $short_name . "]\n";
        $contents .= "\$" . $short_name . " = array();\n\n";
        // add the language file
        $contents = $contents . str_replace('$lang', '$' . $short_name, $data) . "\n";
        // add the END and closing tag
        $contents .= "// [/" . $short_name . "]\n\n";
        $contents .= "?>";

        if (!($fp = fopen($language_file, 'wt')))
        {
            message_die(GENERAL_ERROR, 'Unable to write to: ' . $language_file);
        }

        fwrite($fp, $contents, strlen($contents));
        fclose($fp);

        chmod($language_file, $file_mode);
        chmod($language_dir . '/' . $language, $directory_mode);
        chmod($language_dir, $directory_mode);
    }

    // If we have not quit yet, let us add the info to the database too. ;)
    $add_info_array = array(
        'long_name' => 'name', 
        'author' => 'author',
        'email' => 'email',
        'url' => 'url',
        'version' => 'version',
        'update_site' => 'check_update_site',
        'extra_info' => 'extra_info'
    );

    // determine default update time
    $update_time = 0;
    if (!isset($info_array['update_time']))
    {
        $update_time = 0;
    }
    else if (strstr($info_array['update_time'], 'update_time_from'))
    {
        $update_time_module = explode("\n", $info_array['update_time']);
        $update_time_module = preg_replace("/(.*?)update_time_from(.*?)/", "\\2", $update_time_module[0]);
        $update_time_module = trim($update_time_module);
        
        if ($update_time_module != '')
        {
            $sql = "SELECT update_time FROM " . MODULES_TABLE . " WHERE short_name = '" . $update_time_module . "'";

            if (!($result = $db->sql_query($sql)))
            {
                message_die(GENERAL_ERROR, 'Unable to get update time', "", __LINE__, __FILE__, $sql);
            }
        
            if ($db->sql_numrows($result) > 0)
            {
                $row = $db->sql_fetchrow($result);
                $update_time = intval($row['update_time']);
            }
            else
            {
                $update_time_module = explode("\n", $info_array['update_time']);
                $update_time = intval($update_time_module[1]);
            }
        }
    }
    else
    {
        $update_time = intval($info_array['update_time']);
    }

    if ($module_id == -1)
    {
        $sql = "SELECT max(module_order) as max_order FROM " . MODULES_TABLE;

        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to get maximum module order', '', __LINE__, __FILE__, $sql);
        }

        if ($db->sql_numrows($result) > 0)
        {
            $row = $db->sql_fetchrow($result);
            $next_order = intval($row['max_order']) + 10;
        }
        else
        {
            $next_order = 10;
        }

        // Fill Module Table
        $sql = "INSERT INTO " . MODULES_TABLE . " (short_name, update_time, module_order, active)
        VALUES ('" . trim($info_array['short_name']) . "', " . $update_time . ", " . $next_order . ", 0)";

        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to insert module', '', __LINE__, __FILE__, $sql);
        }

        $next_module_id = $db->sql_nextid($result);
    }
    else
    {
        // Fill Module Table
        $sql = "UPDATE " . MODULES_TABLE . " SET update_time = " . $update_time . " WHERE module_id = " . $module_id;

        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to update module', '', __LINE__, __FILE__, $sql);
        }
    }
    
    // Fill Info-Table
    $keys = '';
    $values = '';
    @reset($add_info_array);
    while (list($key, $value) = @each($add_info_array))
    {
        if (!isset($info_array[$value]))
        {
            $info_bit = '';
        }
        else
        {
            if ($value == 'extra_info')
            {
                $info_bit = trim($info_array[$value]);
            }
            else
            {
                $info_bit = explode("\n", $info_array[$value]);
                $info_bit = trim($info_bit[0]);
            }
        }
    
        $keys .= ', ' . $key;
        $values .= ', \'' . sql_quote(htmlspecialchars($info_bit)) . '\'';
    }

    if (($keys == '') || ($values == ''))
    {
        message_die(GENERAL_ERROR, 'Unable to install Module, not enough informations');
    }

    if ($module_id == -1)
    {
        $keys = 'module_id' . $keys;
        $values = $next_module_id . $values;

        $sql = "INSERT INTO " . MODULE_INFO_TABLE . " (" . $keys . ") VALUES (" . $values . ")";
    
        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to insert module', '', __LINE__, __FILE__, $sql);
        }
    }
    else
    {
        $update_query = '';
        $keys = explode(', ', $keys);
        $values = explode(', ', $values);
        
        for ($i = 0; $i < count($keys); $i++)
        {
            if ( (trim($keys[$i]) != '') && (trim($values[$i]) != '') )
            {
                $update_query .= (($update_query == '') ? ($keys[$i] . ' = ' . $values[$i]) : (', ' . $keys[$i] . ' = ' . $values[$i]));
            }
        }

        $sql = "UPDATE " . MODULE_INFO_TABLE . " SET " . $update_query . " WHERE module_id = " . $module_id;
    
        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to update module', '', __LINE__, __FILE__, $sql);
        }
    }

    if ($module_id == -1)
    {
        $sql = "INSERT INTO " . CACHE_TABLE . " (module_id, module_cache_time, db_cache, priority)
        VALUES (" . $next_module_id . ", 0, '', 0)";

        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to insert module cache', '', __LINE__, __FILE__, $sql);
        }
    }
    else
    {
        $sql = "UPDATE " . CACHE_TABLE . " SET module_cache_time = 0, db_cache = '', priority = 0 WHERE module_id = " . $module_id;

        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to update module cache', '', __LINE__, __FILE__, $sql);
        }
    }

    // Admin Panel Integration
    if ($module_id != -1)
    {
        $sql = "DELETE FROM " . MODULE_ADMIN_TABLE . " WHERE module_id = " . $module_id;

        if (!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Unable to delete admin panel entries', '', __LINE__, __FILE__, $sql);
        }
    }
    else
    {
        $module_id = $next_module_id;
    }

    if ( (isset($info_array['admin_panel'])) && (trim($info_array['admin_panel']) != '') )
    {

        $entries = explode("\n", trim($info_array['admin_panel']));

        for ($i = 0; $i < count($entries); $i++)
        {
            $config_array = array();

            $vars = explode(' ', $entries[$i]);
            for ($j = 0; $j < count($vars); $j++)
            {
                $values = explode(':', $vars[$j]);
                $config_array[trim($values[0])] = trim($values[1]);
            }

            $sql = "INSERT INTO " . MODULE_ADMIN_TABLE . " (module_id, config_name, config_value, config_type, config_title, config_explain, config_trigger) 
            VALUES (" . $module_id . ", '" . $config_array['option'] . "', '" . $config_array['default'] . "', '" . $config_array['type'] . "', '" . $config_array['title'] . "', '" . $config_array['explain'] . "', '" . $config_array['trigger'] . "')";

            if (!($result = $db->sql_query($sql)))
            {
                message_die(GENERAL_ERROR, 'Unable to insert admin panel entry', '', __LINE__, __FILE__, $sql);
            }
        }
    }
}

// Read pak file Header
function read_pak_header($fp)
{
    $header = fread($fp, 5);
    $mpak_header = fread($fp, 4);
    if ($mpak_header != 'MPAK')
    {
        message_die(GENERAL_ERROR, 'Invalid Module Pak File');
    }

    if (intval($header[0]) < 3)
    {
        message_die(GENERAL_ERROR, 'Invalid Module Pak File');
    }
}

// Read Language PAK file Header
function read_lang_pak_header($fp)
{
    $header = fread($fp, 3);
    $mpak_header = fread($fp, 8);
    if ($mpak_header != 'LANGPACK')
    {
        message_die(GENERAL_ERROR, 'Invalid Module Pak File');
    }
}

// Read next file from pak file stream
function read_pak_file($stream, $file_ident)
{

    $ident = 'ÿüÌ' . $file_ident . 'Ìüÿ';
    $end_ident = 'ÌÌÿ' . $file_ident . 'ÿÌÌ'; 

    $begin = strpos($stream, $ident);
    $begin += strlen($ident);
    $length = strpos($stream, $end_ident);
    $length = $length - $begin;

    $content = substr($stream, $begin, $length);
    return ($content);
}

// Move Module one up
function move_up($module_id)
{
    global $db;

    // Select current module order
    $sql = "SELECT module_order FROM " . MODULES_TABLE . " WHERE module_id = " . $module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to select module order', '', __LINE__, __FILE__, $sql);
    }

    $row = $db->sql_fetchrow($result);
    $old_module_order = intval($row['module_order']);
    
    // Select Module in order before the current one
    $sql = "SELECT module_id, module_order FROM " . MODULES_TABLE . " WHERE module_order < " . $old_module_order . " ORDER BY module_order DESC LIMIT 1";

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to select module order', '', __LINE__, __FILE__, $sql);
    }

    if ($db->sql_numrows($result) == 0)
    {
        return;
    }
    
    $row = $db->sql_fetchrow($result);
    $new_module_order = intval($row['module_order']);
    $replaced_module_id = intval($row['module_id']);

    // Assign current module order to the one before
    $sql = "UPDATE " . MODULES_TABLE . " SET module_order = " . $old_module_order . " WHERE module_id = " . $replaced_module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to update module order', '', __LINE__, __FILE__, $sql);
    }

    // Assign the new module order to the current module
    $sql = "UPDATE " . MODULES_TABLE . " SET module_order = " . $new_module_order . " WHERE module_id = " . $module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to update module order', '', __LINE__, __FILE__, $sql);
    }

    return;
}

// Move Module one down
function move_down($module_id)
{
    global $db;

    // Select current module order
    $sql = "SELECT module_order FROM " . MODULES_TABLE . " WHERE module_id = " . $module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to select module order', '', __LINE__, __FILE__, $sql);
    }

    $row = $db->sql_fetchrow($result);
    $old_module_order = intval($row['module_order']);
    
    // Select Module in order after the current one
    $sql = "SELECT module_id, module_order FROM " . MODULES_TABLE . " WHERE module_order > " . $old_module_order . " ORDER BY module_order ASC LIMIT 1";

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to select module order', '', __LINE__, __FILE__, $sql);
    }

    if ($db->sql_numrows($result) == 0)
    {
        return;
    }
    
    $row = $db->sql_fetchrow($result);
    $new_module_order = intval($row['module_order']);
    $replaced_module_id = intval($row['module_id']);

    // Assign current module order to the one before
    $sql = "UPDATE " . MODULES_TABLE . " SET module_order = " . $old_module_order . " WHERE module_id = " . $replaced_module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to update module order', '', __LINE__, __FILE__, $sql);
    }

    // Assign the new module order to the current module
    $sql = "UPDATE " . MODULES_TABLE . " SET module_order = " . $new_module_order . " WHERE module_id = " . $module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to update module order', '', __LINE__, __FILE__, $sql);
    }

    return;
}

// activate module
function activate($module_id)
{
    global $db;

    $sql = "UPDATE " . MODULES_TABLE . " SET active = 1 WHERE module_id = " . $module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to activate module', '', __LINE__, __FILE__, $sql);
    }

    return;
}

// deactivate module
function deactivate($module_id)
{
    global $db;

    $sql = "UPDATE " . MODULES_TABLE . " SET active = 0 WHERE module_id = " . $module_id;

    if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Unable to deactivate module', '', __LINE__, __FILE__, $sql);
    }

    return;
}

// Resync Module Order
function resync_module_order()
{
    global $db;

    $sql = "SELECT * FROM " . MODULES_TABLE . " ORDER BY module_order ASC";

    if( !$result = $db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, "Couldn't get list of Modules", "", __LINE__, __FILE__, $sql);
    }

    $i = 10;
    $inc = 10;

    while( $row = $db->sql_fetchrow($result) )
    {
        $sql = "UPDATE " . MODULES_TABLE . "
            SET module_order = $i
            WHERE module_id = " . intval($row['module_id']);
        if( !$db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, "Couldn't update order fields", "", __LINE__, __FILE__, $sql);
        }
        $i += $inc;
    }
}

?>