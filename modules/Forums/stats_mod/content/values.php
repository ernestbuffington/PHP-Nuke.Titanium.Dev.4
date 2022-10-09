<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                values.php
 *                            -------------------
 *   begin                : Fri, Jan 03, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: values.php,v 1.4 2003/02/05 16:44:23 acydburn Exp $
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

class Content_values
{
    var $columns = -1;
    var $num_blocks = -1;
    var $num_columns = 0;
    var $value_order = '';
    var $column_data = array();
    var $width_step = array();
    var $align = 'center';

    function __construct()
    {
    }

    function set_columns($data)
    {
        global $stats_template;

        if (($this->columns == -1) || ($this->num_blocks <= 0))
        {
            die('Invalid Call(' . get_class($content) . '): set_columns before set_view or num_blocks <= 0');
        }
        
        @reset($data);
        $i = 0;
        while (list($key, $value) = each($data))
        {
            $this->column_data[$i]['key'] = $key;
            $this->column_data[$i]['value'] = $value;
            $i++;
        }

        $this->num_columns = $this->columns * $this->num_blocks;
        $stats_template->assign_vars(array(
            'NUM_COLUMNS' => $this->num_columns)
        );

        $width = round(100 / $this->num_columns);
        $this->width_step = array();
        
        if ($width * $this->num_columns > 100)
        {
            $step = ($width * $this->num_columns) - 100;
            for ($i = 0; $i < $this->num_columns; $i+=$step)
            {
                $this->width_step[] = $width-1;
                for ($j = 0; $j < $step-1; $j++)
                {
                    $this->width_step[] = $width;
                }
            }
        }
        else
        {
            for ($i = 0; $i < $this->num_columns; $i++)
            {
                $this->width_step[] = $width;
            }
        }

        $c = 0;
        for ($i = 1; $i <= $this->num_blocks; $i++)
        {
            for ($j = 1; $j <= $this->columns; $j++)
            {
                $first_column = ($i*$j == 1) ? TRUE : FALSE;
                $last_column = ($i*$j == $this->num_columns) ? TRUE : FALSE;

                $stats_template->assign_block_vars('column', array(
                    'FIRST_COLUMN' => $first_column,
                    'LAST_COLUMN' => $last_column,
                    'WIDTH' => $this->width_step[$c],
                    'VALUE' => $this->column_data[$j-1]['value'])
                );

                $c++;
            }
        }
    }

    function value_array($data)
    {
        $data_return = array();
        
        for ($i = 0; $i < count($data); $i++)
        {
            for ($j = 0; $j < count($data[$i]); $j++)
            {
                $data_return[$j][$i] = $data[$i][$j];
            }
        }

        return ($data_return);
    }

    function iterate_values()
    {
        global $core, $stats_template, $phpbb_root_path, $phpEx, $stat_functions, $lang;

        // make global...
        if (count($core->global_array) > 0)
        {
            eval('global ' . implode(', ', $core->global_array) . ';');
        }

        if ($this->value_order == 'up_down')
        {
            $one_block = count($core->calculation_data) / $this->num_blocks;
            $one_block = intval($one_block);
            $one_block += count($core->calculation_data) % $this->num_blocks;
        }
        else if ($this->value_order == 'left_right')
        {
            $one_block = $this->num_blocks;
        }

        $iteration = 0;

        for ($i = 0; $i < count($core->calculation_data); $i = $i + $this->num_blocks)
        {
            $w_iteration = 0;
            
            $stats_template->assign_block_vars('row', array(
                'ROW' => $i)
            );

            $row_value = array();

            $num = 0;

            for ($j = 0; $j < $this->num_blocks; $j++)
            {
                for ($k = 0; $k < $this->columns; $k++)
                {
                    if ($this->value_order == 'up_down')
                    {
                        $row_value[$num] = $core->calculation_data[$iteration+($one_block*$j)][$k];
                    }
                    else if ($this->value_order == 'left_right')
                    {
                        $row_value[$num] = $core->calculation_data[$j+($iteration*$one_block)][$k];
                    }
                    $num++;
                }
            }

            for ($j = 0; $j < $this->num_columns; $j++)
            {
                $first_column = ($j == 0) ? TRUE : FALSE;
                $last_column = ($j == $this->num_columns-1) ? TRUE : FALSE;

                $stats_template->assign_block_vars('row.row_column', array(
                    'FIRST_COLUMN' => $first_column,
                    'LAST_COLUMN' => $last_column,
                    'ROW' => $j,
                    'WIDTH' => $this->width_step[$w_iteration],
                    'ALIGN' => $this->align,
                    'VALUE' => $row_value[$j])
                );
                
                $w_iteration++;
            }

            $iteration++;
        }
    }

}

?>