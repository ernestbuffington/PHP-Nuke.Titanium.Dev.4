<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                core.php
 *                            -------------------
 *   begin                : Wed, Jan 01, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: core.php,v 1.9 2003/03/16 19:38:28 acydburn Exp $
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
 -=[Mod]=-
       Advanced Username Color                  v1.0.5       08/08/2005
       Smilies in Topic Titles                  v1.0.0       09/02/2005
       Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

/*
    Statistics Mod Core

    This is the heart of the Statistics Mod, here are all root classes defined.
*/

include($phpbb_root_path . 'stats_mod/content/bars.' . $phpEx);
include($phpbb_root_path . 'stats_mod/content/statistical.' . $phpEx);
include($phpbb_root_path . 'stats_mod/content/values.' . $phpEx);

// db cache
include($phpbb_root_path . 'stats_mod/db_cache.' . $phpEx);
include($phpbb_root_path . 'stats_mod/functions.' . $phpEx);

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/
include_once('includes/bbcode.' .$phpEx);
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/

//
// The Core
//
class StatisticsCORE
{
    var $template_file = ''; // content template file
    var $return_limit = 10;
    var $global_array = array();
    var $use_db_cache = false;
    var $do_not_use_cache = false; // force to not use caches at all if set to true
    var $module_reloaded = false;
    var $module_variables = array();
    var $used_language = '';

    // Informations about the currently parsed module
    var $current_module_path = '';
    var $current_module_name = '';
    var $current_module_id = 0;
    var $module_info = array(); // Additional Module Informations gathered within other positions through the process

    // Data
    var $calculation_data = array();
    var $calc_index = 0;

    // Namespaces
    var $namespace_vars = array();
    var $namespace_functions = array();

    function __construct()
    {
    }

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    function AUC_Color($num=0) {
        $i = 0;
        if(!isset($this->calculation_data) || !is_array($this->calculation_data)){
            return;
        }
        foreach ($this->calculation_data as $key) {
            if (!empty($key["username"]) && !empty($key['user_color_gc']) && strlen($key['user_color_gc']) == 6) {
                $this->calculation_data[$i]['username'] = "<font color='#". $key['user_color_gc'] ."'><strong>". $key['username'] ."</strong></font>";
            }
            $i++;
        }
        return;
    }
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/
    function topic_smiles() {
    global $board_config;
        $i = 0;
        if(!isset($this->calculation_data) || !is_array($this->calculation_data)){
            return;
        }
        foreach ($this->calculation_data as $key) {
            if (!empty($key["topic_title"]) && $board_config['smilies_in_titles']) {
                $this->calculation_data[$i]['topic_title'] = smilies_pass($key["topic_title"]);
            }
            $i++;
        }
    }
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 [ Mod:     Smilies in Topic Titles Toggle     v1.0.0 ]
 ******************************************************/

    // Init Module
    function start_module($db_cache_on = false)
    {
        global $stats_template, $theme, $stat_db;

        $this->use_db_cache = false;
        $this->module_info['next_update_time'] = 0;
        $this->module_info['last_update_time'] = 0;

        $stats_template = new Stats_template();
        $stats_template->set_template($theme['template_name']);

        $stat_db->begin_cached_query();

        if ((!$db_cache_on) || ($this->do_not_use_cache))
        {
            return;
        }

        // Now init our database cache. ;)
        $cache = '';
        $this->use_db_cache = true;

        if (module_use_db_cache($this->current_module_id, $cache))
        {
            $stat_db->begin_cached_query(true, $cache);
        }
    }

    // Run Module
    function run_module()
    {
        global $stats_template, $template, $stat_db, $board_config;

        if ($this->use_db_cache)
        {
            $stat_db->end_cached_query($this->current_module_id);
        }

        $compiled_output = $stats_template->display('body');

        if ( ($this->module_info['last_update_time'] != 0) && ($this->module_info['next_update_time'] != 0) )
        {
            $last_update_time = create_date($board_config['default_dateformat'], $this->module_info['last_update_time'], $board_config['board_timezone']);
            $next_update_time = create_date($board_config['default_dateformat'], $this->module_info['next_update_time'], $board_config['board_timezone']);
        }
        else
        {
            $last_update_time = '';
            $next_update_time = '';
        }

        // Eat this template class. :)
        $template->assign_block_vars('modules', array(
            'CURRENT_MODULE' => $compiled_output,
            'CACHED' => ($stat_db->use_cache) ? 'true' : 'false',
            'RELOADED' => (!$stat_db->use_cache && $this->use_db_cache) ? 'true' : 'false',
            'LAST_UPDATE_TIME' => $last_update_time,
            'NEXT_GUESSED_UPDATE_TIME' => $next_update_time,
            'MODULE_ID' => $this->current_module_id,
            'MODULE_SHORT_NAME' => $this->current_module_name)
        );

        if ( ($this->module_info['last_update_time'] != 0) && ($this->module_info['next_update_time'] != 0) )
        {
            $template->assign_block_vars('modules.switch_display_timestats', array());
        }

        $stats_template->destroy();
    }

    // Make data global to the content class
    function make_global($data)
    {
        $this->global_array = $data;
    }

    // Set and init the content class and define all namespaces
    function set_content($content_template)
    {
        global $stats_template;

        if ($content_template == 'bars')
        {
            global $content, $content_bars;

            if (empty($content_bars))
            {
                $content_bars = new Content_bars;
                $content = $content_bars;
            }
            else
            {
                $content = $content_bars;
            }

            $this->template_file = 'content_bars.tpl';
            $vars = get_class_vars(get_class($content));
            $this->namespace_vars = array();

            foreach ($vars as $name => $value )
            {
                $this->namespace_vars[] = $name;
            }

            $this->namespace_functions = get_class_methods(get_class($content));

            $stats_template->set_filenames(array(
                'body' => $this->template_file)
            );

            // Init some standard things based on the template
            $content->init_bars(array(
                'left' => 'images/vote_lcap.gif',
                'right' => 'images/vote_rcap.gif',
                'bar' => 'images/voting_bar.gif')
            );

        }
        else if ($content_template == 'statistical')
        {
            global $content, $content_statistical;

            if (empty($content_statistical))
            {
                $content_statistical = new Content_statistical;
                $content = $content_statistical;
            }
            else
            {
                $content = $content_statistical;
            }

            $this->template_file = 'content_statistical.tpl';
            $vars = get_class_vars(get_class($content));
            $this->namespace_vars = array();

            foreach ($vars as $name => $value )
            {
                $this->namespace_vars[] = $name;
            }

            $this->namespace_functions = get_class_methods(get_class($content));

            $stats_template->set_filenames(array(
                'body' => $this->template_file)
            );

            // Init some standard things based on the template
        }
        else if ($content_template == 'values')
        {
            global $content, $content_values;

            if (empty($content_values))
            {
                $content_values = new Content_values;
                $content = $content_values;
            }
            else
            {
                $content = $content_values;
            }

            $this->template_file = 'content_values.tpl';
            $vars = get_class_vars(get_class($content));
            $this->namespace_vars = array();

            foreach ($vars as $name => $value )
            {
                $this->namespace_vars[] = $name;
            }

            $this->namespace_functions = get_class_methods(get_class($content));

            $stats_template->set_filenames(array(
                'body' => $this->template_file)
            );

            // Init some standard things based on the template
        }
    }

    // Set current data elements
    function set_data($data, $limit = -1)
    {
        if ($limit != -1)
        {
            $this->calculation_data = array();

            for ($i = 0; $i < $limit; $i++)
            {
                $this->calculation_data[$i] = $data[$i];
            }
        }
        else
        {
            $this->calculation_data = $data;
        }

/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        $this->AUC_Color();
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

        $this->calc_index = 0;
    }

    // Return the current data element
    function data($key)
    {
        return ($this->calculation_data[$this->calc_index][$key]);
    }

    // Set and return a pre-defined variable
    // Those pre-defined variables are for special conditions and content related output
    function pre_defined($variable = '')
    {
        global $lang;

        if ($variable == 'rank')
        {
            return (array('__PRE_DEFINE_RANK__' => $lang['Rank']));
        }
        else if ($variable == 'percent')
        {
            return (array('__PRE_DEFINE_PERCENT__' => $lang['Percent']));
        }
        else if ($variable == 'graph')
        {
            return (array('__PRE_DEFINE_GRAPH__' => $lang['Graph']));
        }
        else
        {
            return ('__PRE_DEFINED_VALUE__');
        }
    }

    // Set the content view
    function set_view($var_name, $var_value)
    {
        global $content;

        if (!in_array($var_name, $this->namespace_vars))
        {
            $this->error_handler('Invalid Call (' . get_class($content) . '): set_view -> <strong>' . $var_name . '</strong>');
        }

        $content->$var_name = $var_value;
    }

    // Define content view
    function define_view($function_call, $data, $auth_data = 0)
    {
        global $content;

        if (!in_array($function_call, $this->namespace_functions))
        {
            $this->error_handler('Invalid Call(' . get_class($content) . '): define_view -> <strong>' . $function_call . '</strong>');
        }

        // bar content class: set_columns
        return ($content->$function_call($data, $auth_data));
    }

    // Assign specific things to current content view
    function assign_defined_view($function_call, $data)
    {
        global $content;

        if (!in_array($function_call, $this->namespace_functions))
        {
            $this->error_handler('Invalid Call(' . get_class($content) . '): assign_defined_view -> <strong>' . $function_call . '</strong>');
        }

        // bar content class: align_rows
        return ($content->$function_call($data));
    }

    // Set content Header
    function set_header($header_lang)
    {
        global $stats_template;

        $stats_template->assign_vars(array(
            'MODULE_NAME' => $header_lang)
        );
    }

    // Statistics Mod Error Handler
    function error_handler($msg, $debug_info = '')
    {
        // TODO
        // Here have to be something to stop the module and procceed with the next one.
        die('<br />' . $msg . '<br />' . $debug_info . '<br />');
    }

    // Get all defines
    function get_user_defines()
    {
        return ($this->module_variables[$this->current_module_id]);
    }

    //
    // STAT_FUNCTIONS
    //

    // $stat_functions->sort_data()
    function sort_data ($sort_array, $key, $sort_order, $pre_string_sort = -1)
    {
        global $stat_functions;

        return ($stat_functions->sort_data($sort_array, $key, $sort_order, $pre_string_sort));
    }

    // $stat_functions->generate_link()
    function generate_link($url, $placeholder, $append = '')
    {
        global $stat_functions;

        return ($stat_functions->generate_link($url, $placeholder, $append));
    }

    // $stat_functions->generate_image_link()
    function generate_image_link($url, $alt, $append = '')
    {
        global $stat_functions;

        return ($stat_functions->generate_image_link($url, $alt, $append));
    }

    /* $stat_functions->forum_auth()
    function forum_auth($userdata, $auth = AUTH_VIEW)
    {
        global $stat_functions;

        return ($stat_functions->forum_auth($userdata, $auth));
    }*/

    //
    // STAT_DB
    //

    // $stat_db->sql_query()
    function sql_query($sql_statement, $error_message, $transaction = FALSE)
    {
        global $stat_db, $db;

        $result = $stat_db->sql_query($sql_statement, $transaction);

        if (!$result)
        {
            $error = $db->sql_error();
            $this->error_handler($error_message, $error['message'] . '<br />SQL Statement: ' . $sql_statement);
        }
        return $result;
    }

    // $stat_db->sql_fetchrow()
    function sql_fetchrow($database_id)
    {
        global $stat_db;

        return ($stat_db->sql_fetchrow($database_id));
    }

    // $stat_db->sql_fetchrowset()
    function sql_fetchrowset($database_id)
    {
        global $stat_db;

        return ($stat_db->sql_fetchrowset($database_id));
    }

    // $stat_db->sql_numrows()
    function sql_numrows($database_id)
    {
        global $stat_db;

        return ($stat_db->sql_numrows($database_id));
    }

}

$core = '';
$stat_db = '';
$stat_functions = '';
$content = '';
$content_bars = '';
$content_statistical = '';
$content_values = '';

function init_core()
{
    global $stats_config, $core, $stat_db, $stat_functions, $db, $userdata;

    $core = new StatisticsCORE;

    if ($stats_config['return_limit'] != '')
    {
        $core->return_limit = intval($stats_config['return_limit']);
    }

    // Get Module Variables
    $sql = "SELECT module_id, config_name, config_value, config_type FROM " . MODULE_ADMIN_TABLE;

    if (!$result = $db->sql_query($sql))
    {
        message_die(GENERAL_ERROR, 'Could not find Module Admin Table', '', __LINE__, __FILE__, $sql);
    }

    $rows = $db->sql_fetchrowset($result);
    $num_rows = $db->sql_numrows($result);

    for ($i = 0; $i < $num_rows; $i++)
    {
        $module_id = intval($rows[$i]['module_id']);

        switch (trim($rows[$i]['config_type']))
        {
            case 'number':
                $core->module_variables[$module_id][trim($rows[$i]['config_name'])] = intval($rows[$i]['config_value']);
                break;
        }
    }

    $stat_db = new StatisticsDB;
    $stat_functions = new StatisticsFUNCTIONS;

    $stat_functions->init_auth_settings($userdata);

}

?>