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
*   $Id: download_lang.php,v 1.4 2003/03/16 18:38:29 acydburn Exp $
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

define('IN_PHPBB2', true);

global $file_mode;

//
// Let's set the root dir for phpBB
//
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
if (!empty($phpbb2_board_config))
{
    @include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
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

$no_page_header = true;

@include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
@include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_statistics.' . $phpEx);
include($phpbb2_root_path . 'stats_mod/includes/constants.'.$phpEx);

$sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
     
if ( !($result = $titanium_db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

$stats_config = array();

while ($row = $titanium_db->sql_fetchrow($result))
{
    $stats_config[$row['config_name']] = trim($row['config_value']);
}

include($phpbb2_root_path . 'stats_mod/includes/lang_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/stat_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/admin_functions.'.$phpEx);

if ($mode == 'export_module')
{
    $titanium_module_id = (isset($HTTP_GET_VARS['module'])) ? intval($HTTP_GET_VARS['module']) : -1;
    $titanium_language = (isset($HTTP_GET_VARS['lang'])) ? trim($HTTP_GET_VARS['lang']) : '';
        
    if (($titanium_language == '') || ($titanium_module_id == -1))
    {
        message_die(GENERAL_MESSAGE, 'Invalid Call, Hacking Attempt ?');
    }
        
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
    
    if (!($fp = fopen($phpbb2_root_path . 'modules/cache/temp.pak', 'wb')))
    {
        message_die(GENERAL_ERROR, 'Unable to write Package File to cache.');
    }

    $titanium_language_content = get_lang_entries($short_name, $titanium_language);

    fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
    fwrite($fp, 'LANGPACK', 8);
    fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
    
    $content = '<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
' . "\n\n";
    $content .= '// [' . $titanium_language . ']' . "\n";
    $content .= '// [module:' . $short_name . ']' . "\n";

    for ($i = 0; $i < count($titanium_language_content); $i++)
    {
        $content .= '$titanium_lang[\'' . $titanium_language_content[$i]['key'] . '\'] = \'' . $titanium_language_content[$i]['value'] . '\';' . "\n";
    }

    $content .= '// [/module:' . $short_name . ']' . "\n";
    $content .= '// [/' . $titanium_language . ']' . "\n\n";
    $content .= '?>';

    $size = strlen($content);
    fwrite($fp, $content, $size);
    fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
    fwrite($fp, 'LANGPACK', 8);
    fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);

    fclose($fp);

    $content = implode('', file($phpbb2_root_path . 'modules/cache/temp.pak'));
    
    @chmod($phpbb2_root_path . 'modules/cache/temp.pak', $file_mode);
    @unlink($phpbb2_root_path . 'modules/cache/temp.pak');

    $filename = $short_name . '_' . str_replace('lang_', '', $titanium_language) . '.pak';
    
    header("Content-Type: text/x-delimtext; name=\"" . $filename . "\"");
    header("Content-disposition: attachment; filename=" . $filename);

    echo $content;
}
else if ($mode == 'export_lang')
{
    $titanium_language = (isset($HTTP_GET_VARS['lang'])) ? trim($HTTP_GET_VARS['lang']) : '';
        
    if ($titanium_language == '')
    {
        message_die(GENERAL_MESSAGE, 'Invalid Call, Hacking Attempt ?');
    }
        
    $sql = "SELECT short_name FROM " . MODULES_TABLE;

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
    }
    
    if ($titanium_db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_ERROR, 'Unable to get Modules.');
    }
        
    $rows = $titanium_db->sql_fetchrowset($result);
    $num_rows = $titanium_db->sql_numrows($result);
    
    if (!($fp = fopen($phpbb2_root_path . 'modules/cache/temp.pak', 'wb')))
    {
        message_die(GENERAL_ERROR, 'Unable to write Package File to cache.');
    }

    fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
    fwrite($fp, 'LANGPACK', 8);
    fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
    $content = '<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
' . "\n\n";
    $content .= '// [' . $titanium_language . ']' . "\n";

    for ($i = 0; $i < $num_rows; $i++)
    {
        $short_name = trim($rows[$i]['short_name']);
        $titanium_language_content = get_lang_entries($short_name, $titanium_language);
    
        $content .= '// [module:' . $short_name . ']' . "\n";

        for ($j = 0; $j < count($titanium_language_content); $j++)
        {
            $content .= '$titanium_lang[\'' . $titanium_language_content[$j]['key'] . '\'] = \'' . $titanium_language_content[$j]['value'] . '\';' . "\n";
        }

        $content .= '// [/module:' . $short_name . ']' . "\n\n";
    }

    $content .= '// [/' . $titanium_language . ']' . "\n\n";
    $content .= '?>';

    $size = strlen($content);
    fwrite($fp, $content, $size);
    fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
    fwrite($fp, 'LANGPACK', 8);
    fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);

    fclose($fp);

    $content = implode('', file($phpbb2_root_path . 'modules/cache/temp.pak'));
    
    @chmod($phpbb2_root_path . 'modules/cache/temp.pak', $file_mode);
    @unlink($phpbb2_root_path . 'modules/cache/temp.pak');

    $filename = $titanium_language . '.pak';
    
    header("Content-Type: text/x-delimtext; name=\"" . $filename . "\"");
    header("Content-disposition: attachment; filename=" . $filename);

    echo $content;
}
else if ($mode == 'export_everything')
{
    $sql = "SELECT short_name FROM " . MODULES_TABLE;

    if (!($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
    }
    
    if ($titanium_db->sql_numrows($result) == 0)
    {
        message_die(GENERAL_ERROR, 'Unable to get Modules.');
    }
        
    $rows = $titanium_db->sql_fetchrowset($result);
    $num_rows = $titanium_db->sql_numrows($result);
    
    $titanium_languages = get_all_installed_languages();
        
    if (!($fp = fopen($phpbb2_root_path . 'modules/cache/temp.pak', 'wb')))
    {
        message_die(GENERAL_ERROR, 'Unable to write Package File to cache.');
    }

    fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
    fwrite($fp, 'LANGPACK', 8);
    fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
    $content = '<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
' . "\n\n";
    
    foreach ($titanium_languages as $titanium_language)
    {
        $content .= '// [' . $titanium_language . ']' . "\n";

        for ($i = 0; $i < $num_rows; $i++)
        {
            $short_name = trim($rows[$i]['short_name']);
            $titanium_language_content = get_lang_entries($short_name, $titanium_language);
    
            $content .= '// [module:' . $short_name . ']' . "\n";

            for ($j = 0; $j < count($titanium_language_content); $j++)
            {
                $content .= '$titanium_lang[\'' . $titanium_language_content[$j]['key'] . '\'] = \'' . $titanium_language_content[$j]['value'] . '\';' . "\n";
            }

            $content .= '// [/module:' . $short_name . ']' . "\n\n";
        }

        $content .= '// [/' . $titanium_language . ']' . "\n\n";
    }
    
    $content .= '?>';

    $size = strlen($content);
    fwrite($fp, $content, $size);
    fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
    fwrite($fp, 'LANGPACK', 8);
    fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);

    fclose($fp);

    $content = implode('', file($phpbb2_root_path . 'modules/cache/temp.pak'));
    
    @chmod($phpbb2_root_path . 'modules/cache/temp.pak', $file_mode);
    @unlink($phpbb2_root_path . 'modules/cache/temp.pak');

    $filename = 'statsv3_lang.pak';
    
    header("Content-Type: text/x-delimtext; name=\"" . $filename . "\"");
    header("Content-disposition: attachment; filename=" . $filename);

    echo $content;
}
exit;

?>