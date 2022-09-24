<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             lang_functions.php
 *                            -------------------
 *   begin                : Sat, Jan 04, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: lang_functions.php,v 1.5 2003/03/16 18:38:31 acydburn Exp $
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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

//
// Delete Language Variables within a given Block
// $contents == Language File; $short_name == Module Name
// This function is mainly for deleting blocks out of already parsed language files
//
function delete_language_block($contents, $short_name)
{
    $new_content = '';

    $new_content = preg_replace("/\n\/\/([ ]+)\[" . preg_quote($short_name) . "\](.*?)\[\/" . preg_quote($short_name) . "\]\n/s", "", $contents);
    return ($new_content);    
}

// This is for parsing the imported Language Packs... module rows are set as [module:module_name]
function get_modules_from_lang_block($titanium_lang_block)
{
    $ret_array = array();

    $in_block = FALSE;
    $block_name = '';
    $content = explode("\n", $titanium_lang_block);
    @reset($content);

    while (list($key, $data) = @each($content))
    {
        if (!$in_block)
        {
            if (preg_match("/(.*?)\[module:(.*?)\]/", $data))
            {
                $in_block = TRUE;
                $block_name = preg_replace("/(.*?)\[module:(.*?)\]/", "\\2", $data);
                $block_name = trim($block_name);
                $ret_array[$block_name] = '';
            }
        }
        else
        {
            if (preg_match("/\[\/module:" . preg_quote($block_name) . "\]/", $data))
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

// Get provided Languages from an Module
function get_module_languages($short_name)
{
    global $phpbb2_root_path;

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';
    $titanium_languages = array();

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    if( $dir = @opendir($titanium_language_directory) )
    {
        while( $sub_dir = @readdir($dir) )
        {
            if( !is_file($titanium_language_directory . '/' . $sub_dir) && !is_link($titanium_language_directory . '/' . $sub_dir) && $sub_dir != "." && $sub_dir != ".." && $sub_dir != "CVS" )
            {
                if (strstr($sub_dir, 'lang_'))
                {
                    $titanium_languages[] = trim($sub_dir);
                }
            }
        }
        
        closedir($dir);
    }

    $found_languages = array();

    // Ok, go through all Languages and generate the Language Array
    for ($i = 0; $i < count($titanium_languages); $i++)
    {
        $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_languages[$i] . '/lang_modules.php';
        $file_content = implode('', file($titanium_language_file));
        if (trim($file_content) != '')
        {
            // Get Content and find out if this Module is there
            if ((preg_match("/.*?\/\/[ ]\[" . preg_quote($short_name) . "\]./si", $file_content)) && (preg_match("/.*?\/\/[ ]\[\/" . preg_quote($short_name) . "\]./si", $file_content)) )
            {
                $found_languages[] = str_replace('lang_', '', $titanium_languages[$i]);
            }
        }
    }

    return ($found_languages);
}

// Get Languages available on this system
function get_all_installed_languages()
{
    global $phpbb2_root_path;

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';
    $titanium_languages = array();

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    if( $dir = @opendir($titanium_language_directory) )
    {
        while( $sub_dir = @readdir($dir) )
        {
            if( !is_file($titanium_language_directory . '/' . $sub_dir) && !is_link($titanium_language_directory . '/' . $sub_dir) && $sub_dir != "." && $sub_dir != ".." && $sub_dir != "CVS" )
            {
                if (strstr($sub_dir, 'lang_'))
                {
                    $titanium_languages[] = trim($sub_dir);
                }
            }
        }
        
        closedir($dir);
    }

    $found_languages = array();

    // Ok, go through all Languages and generate the Language Array
    for ($i = 0; $i < count($titanium_languages); $i++)
    {
        $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_languages[$i] . '/lang_modules.php';
        if (file_exists($titanium_language_file))
        {
            $found_languages[] = $titanium_languages[$i]; 
        }
    }

    return ($found_languages);
}

// has module content within this language ?
function module_is_in_lang($short_name, $titanium_language)
{
    global $phpbb2_root_path;

    $found = FALSE;
    
    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';
    $file_content = implode('', file($titanium_language_file));
    if (trim($file_content) != '')
    {
        // Get Content and find out if this Module is there
        if ((preg_match("/.*?\/\/[ ]\[" . preg_quote(trim($short_name)) . "\]./si", $file_content)) && (preg_match("/.*?\/\/[ ]\[\/" . preg_quote(trim($short_name)) . "\]./si", $file_content)) )
        {
            $found = TRUE;
        }
    }

    return ($found);
}

// Get Language Entries from given Module and Language
function get_lang_entries($short_name, $titanium_language)
{
    global $phpbb2_root_path;

    $titanium_lang_entries = array();
    
    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';
    include($titanium_language_file);
    $keys = array();
    eval('$current_lang = $' . trim($short_name) . ';');
        
    if (is_array($current_lang))
    {
        $i = 0;
        foreach ($current_lang as $key => $value)
        {
            $titanium_lang_entries[$i]['key'] = $key;
            $titanium_lang_entries[$i]['value'] = $value;
            $i++;
        }
    }

    return ($titanium_lang_entries);
}

// Set specific language key, $value is the new key value
function set_lang_entry($titanium_language, $titanium_module_id, $key, $value)
{
    global $directory_mode, $file_mode, $titanium_db, $phpbb2_root_path;

    $titanium_language = trim($titanium_language);
    $titanium_module_id = intval($titanium_module_id);
    $titanium_lang_key = trim($key);
    $titanium_lang_value = trim($value);

    $sql = "SELECT short_name FROM " . MODULES_TABLE . " WHERE module_id = " . $titanium_module_id;

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
    }
    
    if ($titanium_db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_ERROR, 'Unable to get Module ' . $titanium_module_id);
    }
        
    $row = $titanium_db->sql_fetchrow($result);
    $short_name = trim($row['short_name']);
    $titanium_lang_entries = array();

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';
    include($titanium_language_file);
    $keys = array();
    eval('$current_lang = $' . trim($short_name) . ';');
        
    if (is_array($current_lang))
    {
        $i = 0;
        foreach ($current_lang as $key => $value)
        {
            if (trim($key) == $titanium_lang_key)
            {
                $titanium_lang_entries[$i]['key'] = trim($titanium_lang_key);
                $titanium_lang_entries[$i]['value'] = trim($titanium_lang_value);
                $i++;
            }
            else
            {
                $titanium_lang_entries[$i]['key'] = trim($key);
                $titanium_lang_entries[$i]['value'] = trim($value);
                $i++;
            }
        }
    }

    // Write Language File
    $data = '';
    for ($i = 0; $i < count($titanium_lang_entries); $i++)
    {
        $data .= '$titanium_lang[\'' . $titanium_lang_entries[$i]['key'] . '\'] = \'' . $titanium_lang_entries[$i]['value'] . '\';';
        $data .= "\n";
    }
    
    chmod($titanium_language_directory, $directory_mode);
        
    if (!file_exists($titanium_language_directory . '/' . $titanium_language))
    {
        @umask(0);
        mkdir($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
    else
    {
        chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
        
    if (!file_exists($titanium_language_file))
    {
        $contents = "<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
\n\n\n?>";
    }
    else
    {
        chmod($titanium_language_file, $file_mode);
        $contents = implode('', @file($titanium_language_file));
        $contents = delete_language_block($contents, $short_name);
    }
        
    $contents = str_replace('?>', '', $contents);
    $contents = trim($contents) . "\n";

    // add the BEGIN
    $contents .= "\n// [" . $short_name . "]\n";
    $contents .= "\$" . $short_name . " = array();\n\n";
    // add the language file
    $contents = $contents . str_replace('$titanium_lang', '$' . $short_name, $data) . "\n";
    // add the END and closing tag
    $contents .= "// [/" . $short_name . "]\n\n";
    $contents .= "?>";

    if (!($fp = fopen($titanium_language_file, 'wt')))
    {
        message_die(GENERAL_ERROR, 'Unable to write to: ' . $titanium_language_file);
    }

    fwrite($fp, $contents, strlen($contents));
    fclose($fp);

    chmod($titanium_language_file, $file_mode);
    chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    chmod($titanium_language_directory, $directory_mode);
}

// Set specific language block, $titanium_lang_block is the new language definition block as string
function set_lang_block($titanium_language, $titanium_module_id, $titanium_lang_block)
{
    global $directory_mode, $file_mode, $titanium_db, $phpbb2_root_path;

    $titanium_language = trim($titanium_language);
    $titanium_module_id = intval($titanium_module_id);
    $titanium_lang_block = trim($titanium_lang_block);

    $sql = "SELECT short_name FROM " . MODULES_TABLE . " WHERE module_id = " . $titanium_module_id;

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
    }
    
    if ($titanium_db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_ERROR, 'Unable to get Module ' . $titanium_module_id);
    }
        
    $row = $titanium_db->sql_fetchrow($result);
    $short_name = trim($row['short_name']);
    $titanium_lang_entries = array();

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';

    // Write Language File
    chmod($titanium_language_directory, $directory_mode);
        
    if (!file_exists($titanium_language_directory . '/' . $titanium_language))
    {
        @umask(0);
        mkdir($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
    else
    {
        chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
        
    if (!file_exists($titanium_language_file))
    {
        $contents = "<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
\n\n\n?>";
    }
    else
    {
        chmod($titanium_language_file, $file_mode);
        $contents = implode('', @file($titanium_language_file));
        $contents = delete_language_block($contents, $short_name);
    }
        
    $contents = str_replace('?>', '', $contents);
    $contents = trim($contents) . "\n";

    // add the BEGIN
    $contents .= "\n// [" . $short_name . "]\n";
    $contents .= "\$" . $short_name . " = array();\n\n";
    // add the language file
    $contents = $contents . str_replace('$titanium_lang', '$' . $short_name, $titanium_lang_block) . "\n";
    // add the END and closing tag
    $contents .= "// [/" . $short_name . "]\n\n";
    $contents .= "?>";

    if (!($fp = fopen($titanium_language_file, 'wt')))
    {
        message_die(GENERAL_ERROR, 'Unable to write to: ' . $titanium_language_file);
    }

    fwrite($fp, $contents, strlen($contents));
    fclose($fp);

    chmod($titanium_language_file, $file_mode);
    chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    chmod($titanium_language_directory, $directory_mode);
}

// Add new key to a modules language block
function lang_add_new_key($titanium_language, $titanium_module_id, $add_key, $add_value)
{
    global $directory_mode, $file_mode, $titanium_db, $phpbb2_root_path;

    $titanium_language = trim($titanium_language);
    $titanium_module_id = intval($titanium_module_id);
    $add_key = trim($add_key);
    $add_value = trim($add_value);

    $sql = "SELECT short_name FROM " . MODULES_TABLE . " WHERE module_id = " . $titanium_module_id;

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
    }
    
    if ($titanium_db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_ERROR, 'Unable to get Module ' . $titanium_module_id);
    }
        
    $row = $titanium_db->sql_fetchrow($result);
    $short_name = trim($row['short_name']);
    $titanium_lang_entries = array();

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';
    include($titanium_language_file);
    $keys = array();
    eval('$current_lang = $' . trim($short_name) . ';');
        
    if (is_array($current_lang))
    {
        $i = 0;
        foreach ($current_lang as $key => $value)
        {
            if (trim($key) == $add_key)
            {
                return (FALSE);
            }
            else
            {
                $titanium_lang_entries[$i]['key'] = trim($key);
                $titanium_lang_entries[$i]['value'] = trim($value);
                $i++;
            }
        }
    }

    // Write Language File
    $data = '';
    for ($i = 0; $i < count($titanium_lang_entries); $i++)
    {
        $data .= '$titanium_lang[\'' . $titanium_lang_entries[$i]['key'] . '\'] = \'' . $titanium_lang_entries[$i]['value'] . '\';';
        $data .= "\n";
    }
    
    $data .= '$titanium_lang[\'' . $add_key . '\'] = \'' . $add_value . '\';';
    $data .= "\n";

    chmod($titanium_language_directory, $directory_mode);
        
    if (!file_exists($titanium_language_directory . '/' . $titanium_language))
    {
        @umask(0);
        mkdir($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
    else
    {
        chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
        
    if (!file_exists($titanium_language_file))
    {
        $contents = "<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
\n\n\n?>";
    }
    else
    {
        chmod($titanium_language_file, $file_mode);
        $contents = implode('', @file($titanium_language_file));
        $contents = delete_language_block($contents, $short_name);
    }
        
    $contents = str_replace('?>', '', $contents);
    $contents = trim($contents) . "\n";

    // add the BEGIN
    $contents .= "\n// [" . $short_name . "]\n";
    $contents .= "\$" . $short_name . " = array();\n\n";
    // add the language file
    $contents = $contents . str_replace('$titanium_lang', '$' . $short_name, $data) . "\n";
    // add the END and closing tag
    $contents .= "// [/" . $short_name . "]\n\n";
    $contents .= "?>";

    if (!($fp = fopen($titanium_language_file, 'wt')))
    {
        message_die(GENERAL_ERROR, 'Unable to write to: ' . $titanium_language_file);
    }

    fwrite($fp, $contents, strlen($contents));
    fclose($fp);

    chmod($titanium_language_file, $file_mode);
    chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    chmod($titanium_language_directory, $directory_mode);
}

// Delete key out of language block
function delete_lang_key($titanium_language, $titanium_module_id, $key_name)
{
    global $directory_mode, $file_mode, $titanium_db, $phpbb2_root_path;

    $titanium_language = trim($titanium_language);
    $titanium_module_id = intval($titanium_module_id);
    $key_name = trim($key_name);

    $sql = "SELECT short_name FROM " . MODULES_TABLE . " WHERE module_id = " . $titanium_module_id;

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
    }
    
    if ($titanium_db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_ERROR, 'Unable to get Module ' . $titanium_module_id);
    }
        
    $row = $titanium_db->sql_fetchrow($result);
    $short_name = trim($row['short_name']);
    $titanium_lang_entries = array();

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';
    include($titanium_language_file);
    $keys = array();
    eval('$current_lang = $' . trim($short_name) . ';');
        
    if (is_array($current_lang))
    {
        $i = 0;
        foreach ($current_lang as $key => $value)
        {
            if (trim($key) != $key_name)
            {
                $titanium_lang_entries[$i]['key'] = trim($key);
                $titanium_lang_entries[$i]['value'] = trim($value);
                $i++;
            }
        }
    }

    // Write Language File
    $data = '';
    for ($i = 0; $i < count($titanium_lang_entries); $i++)
    {
        $data .= '$titanium_lang[\'' . $titanium_lang_entries[$i]['key'] . '\'] = \'' . $titanium_lang_entries[$i]['value'] . '\';';
        $data .= "\n";
    }
    
    chmod($titanium_language_directory, $directory_mode);
        
    if (!file_exists($titanium_language_directory . '/' . $titanium_language))
    {
        @umask(0);
        mkdir($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
    else
    {
        chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
        
    if (!file_exists($titanium_language_file))
    {
        $contents = "<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
\n\n\n?>";
    }
    else
    {
        chmod($titanium_language_file, $file_mode);
        $contents = implode('', @file($titanium_language_file));
        $contents = delete_language_block($contents, $short_name);
    }
        
    $contents = str_replace('?>', '', $contents);
    $contents = trim($contents) . "\n";

    // add the BEGIN
    $contents .= "\n// [" . $short_name . "]\n";
    $contents .= "\$" . $short_name . " = array();\n\n";
    // add the language file
    $contents = $contents . str_replace('$titanium_lang', '$' . $short_name, $data) . "\n";
    // add the END and closing tag
    $contents .= "// [/" . $short_name . "]\n\n";
    $contents .= "?>";

    if (!($fp = fopen($titanium_language_file, 'wt')))
    {
        message_die(GENERAL_ERROR, 'Unable to write to: ' . $titanium_language_file);
    }

    fwrite($fp, $contents, strlen($contents));
    fclose($fp);

    chmod($titanium_language_file, $file_mode);
    chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    chmod($titanium_language_directory, $directory_mode);
}

// Add Empty Language
function add_empty_language($new_language)
{
    global $directory_mode, $file_mode, $titanium_db, $phpbb2_root_path, $titanium_lang;

    $titanium_language = trim($new_language);

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    chmod($titanium_language_directory, $directory_mode);

    if (!file_exists($titanium_language_directory . '/' . $titanium_language))
    {
        @umask(0);
        mkdir($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
    else
    {
        chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';

    $sql = "SELECT short_name FROM " . MODULES_TABLE;

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
    }
    
    if ($titanium_db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_ERROR, 'Unable to get Modules');
    }
        
    $rows = $titanium_db->sql_fetchrowset($result);
    $num_rows = $titanium_db->sql_numrows($result);

    for ($i = 0; $i < $num_rows; $i++)
    {
        $short_name = trim($rows[$i]['short_name']);

        if (!file_exists($titanium_language_file))
        {
            $contents = "<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
\n\n\n?>";
        }
        else
        {
            chmod($titanium_language_file, $file_mode);
            $contents = implode('', @file($titanium_language_file));
            $contents = delete_language_block($contents, $short_name);
        }
        
        $contents = str_replace('?>', '', $contents);
        $contents = trim($contents) . "\n";

        // add the BEGIN
        $contents .= "\n// [" . $short_name . "]\n";
        $contents .= "\$" . $short_name . " = array();\n\n";
        // add the END and closing tag
        $contents .= "// [/" . $short_name . "]\n\n";
        $contents .= "?>";

        if (!($fp = fopen($titanium_language_file, 'wt')))
        {
            message_die(GENERAL_ERROR, 'Unable to write to: ' . $titanium_language_file);
        }

        fwrite($fp, $contents, strlen($contents));
        fclose($fp);
    }

    chmod($titanium_language_file, $file_mode);
    chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    chmod($titanium_language_directory, $directory_mode);

}

// Add new Language, use schema
function add_new_language($new_language, $titanium_lang_schema)
{
    global $directory_mode, $file_mode, $titanium_db, $phpbb2_root_path, $titanium_lang;

    $titanium_language = trim($new_language);
    $titanium_lang_schema = trim($titanium_lang_schema);

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    $schema_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_lang_schema . '/lang_modules.php';

    if (!file_exists($schema_language_file))
    {
        add_empty_language($new_language);
        return;
    }
    
    chmod($titanium_language_directory, $directory_mode);

    if (!file_exists($titanium_language_directory . '/' . $titanium_language))
    {
        @umask(0);
        mkdir($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
    else
    {
        chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';
    $contents = implode('', @file($schema_language_file));

    if (file_exists($titanium_language_file))
    {
        chmod($titanium_language_file, $file_mode);
    }

    if (!($fp = fopen($titanium_language_file, 'wt')))
    {
        message_die(GENERAL_ERROR, 'Unable to write to: ' . $titanium_language_file);
    }

    fwrite($fp, $contents, strlen($contents));
    fclose($fp);

    chmod($titanium_language_file, $file_mode);
    chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    chmod($titanium_language_directory, $directory_mode);
}

// Add Language, Language Content is provided
function add_new_language_predefined($new_language, $titanium_modules)
{
    global $directory_mode, $file_mode, $titanium_db, $phpbb2_root_path, $titanium_lang;

    // Module content is defined as array(short_name, content)

    $titanium_language = trim($new_language);

    $titanium_language_directory = $phpbb2_root_path . 'modules/language';

    if (!file_exists($titanium_language_directory))
    {
        message_die(GENERAL_ERROR, 'Unable to find Language Directory');
    }

    chmod($titanium_language_directory, $directory_mode);

    if (!file_exists($titanium_language_directory . '/' . $titanium_language))
    {
        @umask(0);
        mkdir($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }
    else
    {
        chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    }

    $titanium_language_file = $phpbb2_root_path . 'modules/language/' . $titanium_language . '/lang_modules.php';

    @reset($titanium_modules);
    while (list($short_name, $titanium_lang_content) = each($titanium_modules))
    {
        $short_name = trim($short_name);

        if (!file_exists($titanium_language_file))
        {
            $contents = "<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
\n\n\n?>";
        }
        else
        {
            chmod($titanium_language_file, $file_mode);
            $contents = implode('', @file($titanium_language_file));
            $contents = delete_language_block($contents, $short_name);
        }
        
        $contents = str_replace('?>', '', $contents);
        $contents = trim($contents) . "\n";

        // add the BEGIN
        $contents .= "\n// [" . $short_name . "]\n";
        $contents .= "\$" . $short_name . " = array();\n\n";
        // add the END and closing tag
        $contents .= trim(str_replace('$titanium_lang', '$' . $short_name, $titanium_lang_content));
        $contents .= "\n\n// [/" . $short_name . "]\n\n";
        $contents .= "?>";

        if (!($fp = fopen($titanium_language_file, 'wt')))
        {
            message_die(GENERAL_ERROR, 'Unable to write to: ' . $titanium_language_file);
        }

        fwrite($fp, $contents, strlen($contents));
        fclose($fp);
    }

    chmod($titanium_language_file, $file_mode);
    chmod($titanium_language_directory . '/' . $titanium_language, $directory_mode);
    chmod($titanium_language_directory, $directory_mode);
}

function delete_complete_language($titanium_language)
{
    global $titanium_db, $phpbb2_root_path;

    $titanium_language = trim($titanium_language);

    clear_directory('modules/language/' . $titanium_language);
}

?>