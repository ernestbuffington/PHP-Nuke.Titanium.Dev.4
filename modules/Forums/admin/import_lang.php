<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                           import_lang.php
*                            -------------------
*   begin                : Sat, Jan 04, 2003
*   copyright            : (C) 2003 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: import_lang.php,v 1.1 2003/03/16 18:38:29 acydburn Exp $
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

global $directory_mode;

define('IN_PHPBB2', true);

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

$submit = (isset($HTTP_POST_VARS['submit'])) ? TRUE : FALSE;
$cancel = ( isset($HTTP_POST_VARS['cancel']) ) ? TRUE : FALSE;

if ($cancel)
{
    $no_page_header = TRUE;
}

@include_once($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
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

include($phpbb2_root_path . 'stats_mod/includes/stat_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/admin_functions.'.$phpEx);
include($phpbb2_root_path . 'stats_mod/includes/lang_functions.'.$phpEx);

if ($cancel)
{
    $url = 'admin/' . append_titanium_sid("admin_stats_lang.$phpEx?mode=select", true);
    
    /*$server_protocol = ($phpbb2_board_config['cookie_secure']) ? 'https://' : 'http://';
    $server_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($phpbb2_board_config['server_name']));
    $server_port = ($phpbb2_board_config['server_port'] <> 80) ? ':' . trim($phpbb2_board_config['server_port']) . '/' : '/';
    $script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($phpbb2_board_config['script_path']));*/
    $url = preg_replace('/^\/?(.*?)\/?$/', '/\1', trim($url));

    // Redirect via an HTML form for PITA webservers
    if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
    {
        header('Refresh: 0; URL=' . $url);
        echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><meta http-equiv="refresh" content="0; url=' . $url . '"><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $url . '">HERE</a> to be redirected</div></body></html>';
        exit;
    }

    // Behave as per HTTP/1.1 spec for others
    redirect_titanium($url);
    exit;
}

if ($mode == 'import_new_lang' && $submit)
{
    $phpbb2_template->set_filenames(array(
        'body' => 'admin/stat_import_language.tpl')
    );

    if (isset($HTTP_POST_VARS['install_language']))
    {
        $filename = trim(stripslashes(htmlspecialchars($HTTP_POST_VARS['filename'])));
        
        if (!($fp = fopen($filename, 'r')) )
        {
            message_die(GENERAL_ERROR, 'Unable to open ' . $filename);
        }

        read_lang_pak_header($fp);
        fclose($fp);

        if (strstr($filename, 'test.pak'))
        {
            unlink($filename);
        }

        $stream = implode('', @file($filename));
        $titanium_lang_file = read_pak_file($stream, 'LANGPACK');

        // Prepare the Data
        $titanium_lang_array = parse_lang_file($titanium_lang_file);

        $titanium_languages = get_all_installed_languages();
        $inst_langs = array();
        @reset($titanium_lang_array);
        while (list($titanium_language, $content) = each($titanium_lang_array))
        {
            if (!in_array($titanium_language, $titanium_languages))
            {
                $inst_langs[$titanium_language] = $content;
            }
        }

        if (count($inst_langs) == 0)
        {
            message_die(GENERAL_ERROR, 'All Languages enclosed within this Language Pack are already installed.');
        }

        $titanium_lang_array = $inst_langs;

        @reset($titanium_lang_array);
        while (list($key, $data) = @each($titanium_lang_array))
        {
            $titanium_modules = get_modules_from_lang_block($data);
            add_new_language_predefined($key, $titanium_modules);
        }
        
        message_die(GENERAL_MESSAGE, $titanium_lang['Language_pak_installed']);
    }

    if ( isset($HTTP_POST_VARS['fileselect']) )
    {
        $filename = $phpbb2_root_path . 'modules/pakfiles/' . trim($HTTP_POST_VARS['selected_pak_file']);
    }
    else if (isset($HTTP_POST_VARS['fileupload']))
    {
        $filename = $HTTP_POST_FILES['package']['tmp_name'];

        // check php upload-size
        if ( ($filename == 'none') || ($filename == '') )
        {
            message_die(GENERAL_ERROR, 'Unable to upload file, please use the pak file selector');
        }

        $contents = @implode('', @file($filename));

        if ($contents == '')
        {
            message_die(GENERAL_ERROR, 'Unable to upload file, please use the pak file selector');
        }

        if (!file_exists($phpbb2_root_path . 'modules/cache'))
        {
            @umask(0);
            mkdir($phpbb2_root_path . 'modules/cache', $directory_mode);
        }
        
        if (!($fp = fopen($phpbb2_root_path . 'modules/cache/temp.pak', 'wt')))
        {
            message_die(GENERAL_ERROR, 'Unable to write temp file');
        }

        fwrite($fp, $contents, strlen($contents));
        fclose($fp);

        $filename = $phpbb2_root_path . 'modules/cache/temp.pak';
    }
    else
    {
        message_die(GENERAL_ERROR, 'Unable to find Module Package');
    }

    if (!($fp = fopen($filename, 'r')) )
    {
        message_die(GENERAL_ERROR, 'Unable to open ' . $filename);
    }
    
    read_lang_pak_header($fp);
    fclose($fp);

    $stream = implode('', @file($filename));
    $titanium_lang_file = read_pak_file($stream, 'LANGPACK');

    $s_hidden_fields = '<input type="hidden" name="filename" value="' . $filename . '">';

    // Prepare the Data
    $titanium_lang_array = parse_lang_file($titanium_lang_file);

    $titanium_languages = get_all_installed_languages();
    $inst_langs = array();
    @reset($titanium_lang_array);
    while (list($titanium_language, $content) = each($titanium_lang_array))
    {
        if (!in_array($titanium_language, $titanium_languages))
        {
            $inst_langs[$titanium_language] = $content;
        }
    }

    if (count($inst_langs) == 0)
    {
        message_die(GENERAL_ERROR, 'All Languages enclosed within this Language Pack are already installed.');
    }

    $titanium_lang_array = $inst_langs;

    // Prepare Template
    $phpbb2_template->assign_block_vars('switch_install_language', array());

    $phpbb2_template->assign_vars(array(
        'L_IMPORT_LANGUAGE' => $titanium_lang['Import_new_language'],
        'L_IMPORT_LANGUAGE_EXPLAIN' => $titanium_lang['Import_new_language_explain'],
        'L_INSTALL_LANGUAGE' => $titanium_lang['Install_language'],
        'L_INSTALL' => $titanium_lang['Install'],
        'L_LANGUAGE' => $titanium_lang['Language'],
        'L_MODULES' => $titanium_lang['Modules'])
    );

    @reset($titanium_lang_array);
    while (list($key, $data) = @each($titanium_lang_array))
    {
        $titanium_language = str_replace('lang_', '', $key);

        $phpbb2_template->assign_block_vars('languages', array(
            'LANGUAGE' => $titanium_language)
        );

        $titanium_modules = get_modules_from_lang_block($data);
        @reset($titanium_modules);
        while (list($titanium_module_name, $titanium_module_data) = each($titanium_modules))
        {
            $phpbb2_template->assign_block_vars('languages.modules', array(
                'MODULE' => $titanium_module_name)
            );
        }
    }

    $s_hidden_fields .= '<input type="hidden" name="install_language" value="1">';

    $phpbb2_template->assign_vars(array(
        'S_HIDDEN_FIELDS' => $s_hidden_fields)
    );
}

if (($mode == 'import_new_lang') && (!$submit))
{
    $phpbb2_template->set_filenames(array(
        'body' => 'admin/stat_import_language.tpl')
    );

    if ( (!isset($HTTP_POST_VARS['fileupload'])) && (!isset($HTTP_POST_VARS['fileselect'])) )
    {
        $titanium_lang_paks = array();
    
        $dir = @opendir($phpbb2_root_path . 'modules/pakfiles');

        while($file = @readdir($dir))
        {
            if( !@is_dir($phpbb2_root_path . 'modules/pakfiles' . '/' . $file) )
            {
                if ( preg_match('/\.pak$/i', $file) )
                {
                    $titanium_lang_paks[] = $file;
                }
            }
        }

        @closedir($dir);

        if (count($titanium_lang_paks) > 0)
        {
            $phpbb2_template->assign_block_vars('switch_select_lang', array());

            $titanium_module_select_field = '<select name="selected_pak_file">';

            for ($i = 0; $i < count($titanium_module_paks); $i++)
            {
                $selected = ($i == 0) ? ' selected="selected"' : '';

                $titanium_module_select_field .= '<option value="' . $titanium_lang_paks[$i] . '"' . $selected . '>' . $titanium_lang_paks[$i] . '</option>';
            }
    
            $titanium_module_select_field .= '</select>';
            
            $s_hidden_fields = '<input type="hidden" name="fileselect" value="1">';

            $phpbb2_template->assign_vars(array(
                'L_SELECT_LANGUAGE' => $titanium_lang['Select_language_pak'],
                'S_SELECT_LANGUAGE' => $titanium_module_select_field,
                'S_SELECT_HIDDEN_FIELDS' => $s_hidden_fields)
            );
        
        }

        $phpbb2_template->assign_block_vars('switch_upload_lang', array());

        $s_hidden_fields = '<input type="hidden" name="fileupload" value="1">';

        $phpbb2_template->assign_vars(array(
            'L_IMPORT_LANGUAGE' => $titanium_lang['Import_new_language'],
            'L_IMPORT_LANGUAGE_EXPLAIN' => $titanium_lang['Import_new_language_explain'],
            'L_UPLOAD_LANGUAGE' => $titanium_lang['Upload_language_pak'],
            'L_SUBMIT' => $titanium_lang['Submit'],
            'S_ACTION' => append_titanium_sid($phpbb2_root_path . 'admin/import_lang.'.$phpEx.'?mode='.$mode),
            'S_UPLOAD_HIDDEN_FIELDS' => $s_hidden_fields)
        );

    }
}

$phpbb2_template->pparse('body');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>