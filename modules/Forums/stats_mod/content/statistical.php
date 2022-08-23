<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                statistical.php
 *                            -------------------
 *   begin                : Wed, Jan 01, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: statistical.php,v 1.4 2003/02/06 01:02:59 acydburn Exp $
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

class Content_statistical
{
/*    var $column_header = 0; // Number of Column Headers
    var $columns = array(); // Number of columns per column header
    var $rows = array(); // Number of maximum rows per column header
*/
    var $columns = 0;
    var $rows = 0;
    var $column_data = array();
    var $align = array();
    var $width = array();

    function __construct()
    {
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

    function width_rows($data)
    {
        $this->width = $data;
    }

    function set_rows($data, $auth_data)
    {
        global $core, $stats_template, $phpbb_root_path, $phpEx, $stat_functions, $lang;

        $core->calculation_data = array();

        // make global...
        if (count($core->global_array) > 0)
        {
            eval('global ' . implode(', ', $core->global_array) . ';');
        }

        $width = array();

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

            $stats_template->assign_block_vars('row', array());
            $row_value = array();
            $auth_replace = array();

            for ($j = 0; $j < $this->columns; $j++)
            {
                $auth_replace[$j]['replace'] = FALSE;
                $auth_replace[$j]['lang'] = FALSE;

                eval('$result = ' . $data[$j] . ';');

                $rank_column[$j] = FALSE;

                if (empty($this->align[$j]))
                {
                    $this->align[$j] = 'center';
                }

                if (($this->width[$j] == '') || (empty($this->width[$j])) )
                {
                    $width[$j] = '';
                }
                else
                {
                    $width[$j] = 'width="' . $this->width[$j] . '"';
                }

                if ($result == '__PRE_DEFINED_VALUE__')
                {
                    if ($this->column_data[$j]['key'] == '__PRE_DEFINE_RANK__')
                    {
                        $row_value[$j] = $i+1;
                        $rank_column[$j] = TRUE;
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
                    'ROW' => $i,
                    'VALUE' => $row_value[$j],
                    'ALIGNMENT' => $this->align[$j],
                    'WIDTH' => $width[$j],
                    'AUTH_REPLACEMENT' => $auth_replace[$j]['replace'],
                    'AUTH_LANG_ENTRY' => $auth_replace[$j]['lang'])
                );
            }
        
            $core->calc_index++;
        }
    }
}

?>