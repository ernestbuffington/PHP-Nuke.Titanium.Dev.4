<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                bars.php
 *                            -------------------
 *   begin                : Wed, Jan 01, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: bars.php,v 1.4 2003/02/06 01:02:59 acydburn Exp $
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

class Content_bars
{
    var $columns = 0; // Number of columns
    var $rows = 0; // Number of maximum rows
    var $column_data = array();
    var $align = array();
    var $percentage_sign = FALSE; // Display % after percentage

    // init_bar Variables
    var $bar_loaded = FALSE;
    var $loaded_bar_images = array();
    var $current_template_path = '';

    // math values
    var $math_calculation_key = '';
    var $math_min_value = 0;
    var $math_max_value = 0;
    var $percentage = 0;
    var $bar_percent = 0;
    
    function __construct()
    {
    }

    function init_bars($bars = '')
    {
        global $board_config, $userdata, $theme, $db, $stats_template, $phpbb_root_path;
        
        if (is_array($bars))
        {
            $this->loaded_bar_images['left'] = $bars['left'];
            $this->loaded_bar_images['right'] = $bars['right'];
            $this->loaded_bar_images['bar'] = $bars['bar'];
        }

        if ($this->bar_loaded)
        {
            $stats_template->assign_vars(array(
                'LEFT_GRAPH_IMAGE' => $phpbb_root_path . $this->current_template_path . $this->loaded_bar_images['left'],
                'RIGHT_GRAPH_IMAGE' => $phpbb_root_path . $this->current_template_path . $this->loaded_bar_images['right'],
                'GRAPH_IMAGE' => $phpbb_root_path . $this->current_template_path . $this->loaded_bar_images['bar'])
            );

            return;
        }

        //
        // Getting voting bar info
        //
        if( !$board_config['override_user_style'] )
        {
            if( ($userdata['user_id'] != ANONYMOUS) && (isset($userdata['user_style'])) )
            {
                $style = $userdata['user_style'];
                if( !$theme )
                {
                    $style =  $board_config['default_style'];
                }
            }
            else
            {
                $style =  $board_config['default_style'];
            }
        }
        else
        {
            $style =  $board_config['default_style'];
        }

        $sql = 'SELECT * 
        FROM ' . THEMES_TABLE . ' 
        WHERE themes_id = ' . $style;

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(CRITICAL_ERROR, 'Couldn\'t query database for theme info.');
        }
        $ThemeSel = get_theme();
                if (file_exists("themes/$ThemeSel/forums/index_body.tpl")) 
                {
                    $this->current_template_path = '../../themes/'.$ThemeSel.'/forums/';
                }
                else 
                {
                    $this->current_template_path = 'templates/' . $row['template_name'] . '/';
                }

        $stats_template->assign_vars(array(
            'LEFT_GRAPH_IMAGE' => $phpbb_root_path . $this->current_template_path . $this->loaded_bar_images['left'],
            'RIGHT_GRAPH_IMAGE' => $phpbb_root_path . $this->current_template_path . $this->loaded_bar_images['right'],
            'GRAPH_IMAGE' => $phpbb_root_path . $this->current_template_path . $this->loaded_bar_images['bar'])
        );

        $this->bar_loaded = TRUE;
    }

    function init_math($key, $min, $max)
    {
        $this->math_calculation_key = $key; // 'user_posts'
        $this->math_min_value = intval($min);
        $this->math_max_value = intval($max);
    }

    function set_columns($data)
    {
        global $stats_template;

        @reset($data);
        $i = 0;
        while (list($key, $value) = each($data))
        {
            // check pre-defined value
            if (is_array($value))
            {
                list($this->column_data[$i]['key'], $this->column_data[$i]['value']) = each($value);
            }
            else
            {
                $this->column_data[$i]['key'] = $key;
                $this->column_data[$i]['value'] = $value;
            }
            $i++;
        }

        $stats_template->assign_vars(array(
            'NUM_COLUMNS' => $this->columns)
        );

        // to the run_module part ?
        for ($i = 0; $i < $this->columns; $i++)
        {
            $first_column = ($i == 0) ? TRUE : FALSE;
            $last_column = ($i == $this->columns-1) ? TRUE : FALSE;

            $stats_template->assign_block_vars('column', array(
                'FIRST_COLUMN' => $first_column,
                'LAST_COLUMN' => $last_column,
                'VALUE' => $this->column_data[$i]['value'])
            );
        }
    }

    function align_rows($data)
    {
        // Default: center
        $this->align = $data;
    }

    function do_math($value)
    {
        $cst = ($this->math_min_value > 0) ? 90 / $this->math_min_value : 90;

        if ($value != 0)
        {
            $this->percentage = ( $this->math_max_value ) ? round( min(100, ($value / $this->math_max_value) * 100)) : 0;
        }
        else
        {
            $this->percentage = 0;
        }

        $this->bar_percent = round($value * $cst);
    }

    function set_rows($data)
    {
        global $core, $stats_template, $phpbb_root_path, $phpEx, $stat_functions, $lang;

        $core->calculation_data = array();

        // make global...
        if (count($core->global_array) > 0)
        {
            eval('global ' . implode(', ', $core->global_array) . ';');
        }

        // If we are in an auth condition, please clean them first
        $auth_array = array();
        $authed = FALSE;
        if ($auth_data)
        {
            $auth_array = $stat_functions->clean_auth_values($auth_data);
            $authed = TRUE;
        }

        for ($i = 0; $i < count($core->calculation_data); $i++)
        {
            $rank_column = array();
            $graph_column = array();

            $core->calc_index = $i;
            $this->do_math(intval($core->data($this->math_calculation_key)));

            $stats_template->assign_block_vars('row', array());
            $row_value = array();
            $auth_replace = array();

            for ($j = 0; $j < $this->columns; $j++)
            {
                eval('$result = ' . $data[$j] . ';');

                $rank_column[$j] = FALSE;
                $graph_column[$j] = FALSE;

                if (empty($this->align[$j]))
                {
                    $this->align[$j] = 'center';
                }

                if ($result == '__PRE_DEFINED_VALUE__')
                {
                    if ($this->column_data[$j]['key'] == '__PRE_DEFINE_RANK__')
                    {
                        $row_value[$j] = $i+1;
                        $rank_column[$j] = TRUE;
                    }
                    else if ($this->column_data[$j]['key'] == '__PRE_DEFINE_PERCENT__')
                    {
                        $row_value[$j] = $this->percentage;
                        if ($this->percentage_sign)
                        {
                            $row_value[$j] .= '%';
                        }
                    }
                    else if ($this->column_data[$j]['key'] == '__PRE_DEFINE_GRAPH__')
                    {
                        $row_value[$j] = $this->bar_percent;
                        $graph_column[$j] = TRUE;
                    }
                }
                else
                {
                    if (!$authed)
                    {
                        $row_value[$j] = $result;
                    }
                    else
                    {
                        eval('$auth_key = ' . $auth_array['auth_key'] . ';');
                        if ($auth_array['auth_check'][$auth_key])
                        {
                            $row_value[$j] = $result;
                        }
                        else
                        {
                            eval('$result = ' . $auth_array['auth_replacement'][$j] . ';');
                            $auth_replace[$j]['replace'] = TRUE;
                            if ( (is_string($auth_array['auth_replacement'][$j])) && (strstr($auth_array['auth_replacement'][$j], '$lang')) )
                            {
                                $auth_replace[$j]['lang'] = TRUE;
                            }

                            $row_value[$j] = $result;
                        }
                    }
                }
            }

            for ($j = 0; $j < $this->columns; $j++)
            {
                $first_column = ($j == 0) ? TRUE : FALSE;
                $last_column = ($j == $this->columns-1) ? TRUE : FALSE;

                $stats_template->assign_block_vars('row.row_column', array(
                    'FIRST_COLUMN' => $first_column,
                    'LAST_COLUMN' => $last_column,
                    'RANK_COLUMN' => $rank_column[$j],
                    'GRAPH_COLUMN' => $graph_column[$j],
                    'ROW' => $i,
                    'VALUE' => $row_value[$j],
                    'ALIGNMENT' => $this->align[$j],
                    'AUTH_REPLACEMENT' => $auth_replace[$j]['replace'],
                    'AUTH_LANG_ENTRY' => $auth_replace[$j]['lang'])
                );
            }

            $core->calc_index++;
        }
    }
}

?>