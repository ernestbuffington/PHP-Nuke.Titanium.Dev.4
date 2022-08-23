<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                functions.php
 *                            -------------------
 *   begin                : Wed, Jan 01, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: functions.php,v 1.4 2003/02/05 16:55:50 acydburn Exp $
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

// Class for 'standard' functions...
class StatisticsFUNCTIONS
{
    // forum auth variables <- forum_auth()
//    var $auth_loaded = FALSE;
//    var $previous_auth = AUTH_VIEW;
    var $auth_data_sql = '';

    // Sort multi-dimensional array
    function sort_data ($sort_array, $key, $sort_order, $pre_string_sort = -1) 
    {
        $last_element = count($sort_array) - 1;

        if ($pre_string_sort == -1)
        {
            $string_sort = ( is_string($sort_array[$last_element-1][$key]) ) ? TRUE : FALSE;
        }
        else
        {
            $string_sort = $pre_string_sort;
        }

        for ($i = 0; $i < $last_element; $i++) 
        {
            $num_iterations = $last_element - $i;

            for ($j = 0; $j < $num_iterations; $j++) 
            {
                $next = 0;

                // do checks based on key
                $switch = FALSE;
                if ( !($string_sort) )
                {
                    if ( ( ($sort_order == 'DESC') && (intval($sort_array[$j][$key]) < intval($sort_array[$j + 1][$key])) ) || ( ($sort_order == 'ASC') &&    (intval($sort_array[$j][$key]) > intval($sort_array[$j + 1][$key])) ) )
                    {
                        $switch = TRUE;
                    }
                }
                else
                {
                    if ( ( ($sort_order == 'DESC') && (strcasecmp($sort_array[$j][$key], $sort_array[$j + 1][$key]) < 0) ) || ( ($sort_order ==   'ASC') && (strcasecmp($sort_array[$j][$key], $sort_array[$j + 1][$key]) > 0) ) )
                    {
                        $switch = TRUE;
                    }
                }

                if ($switch)
                {
                    $temp = $sort_array[$j];
                    $sort_array[$j] = $sort_array[$j + 1];
                    $sort_array[$j + 1] = $temp;
                }
            }
        }

        return ($sort_array);
    }

    // Generate a link
    function generate_link($url, $placeholder, $append = '')
    {
        return ('<a href="' . $url . '" ' . $append . '>' . $placeholder . '</a>');
    }

    // Generate Image Source link
    function generate_image_link($url, $alt, $append = '')
    {
        return ('<img src="' . $url . '" alt="' . $alt . '" ' . $append . '>');
    }

/*    //
    // Forum Auth (Returns an Forum SQL ID String)
    //
    function forum_auth($userdata, $auth = AUTH_VIEW)
    {
        global $db;

        if (($this->auth_loaded) && ($this->previous_auth == $auth))
        {
            return ($this->auth_data_sql);
        }
        
        $this->auth_data_sql = '';

        $is_auth_ary = auth($auth, AUTH_LIST_ALL, $userdata);

        $sql = 'SELECT forum_id 
        FROM ' . FORUMS_TABLE;

        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Couldn\'t retrieve forum_id data', '', __LINE__, __FILE__, $sql);
        }

        while ( $row = $db->sql_fetchrow($result)) 
        {
            if ($is_auth_ary[$row['forum_id']]['auth_view'])
            {
                $this->auth_data_sql .= ( $this->auth_data_sql != '') ? ', ' . intval($row['forum_id']) : intval($row['forum_id']);
            }
        }
    
        $this->auth_loaded = TRUE;
        $this->previous_auth = $auth;
        return ($this->auth_data_sql);
    }*/

    //
    // Init Authorization Settings for use in Modules
    //
    function init_auth_settings($userdata)
    {
        global $db;

        $this->auth_data_sql = array();

        $auth_ary = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);

        @reset($auth_ary);

        // Generate the Forum Authorization Level
        while (list($forum_id, $auth_setting) = each($auth_ary))
        {
            $this->auth_data_sql['forum'][$forum_id] = $auth_setting;
        }
        
        $this->auth_loaded = TRUE;
        return;
    }

    //
    // Clean Authorization, adjust it to the current iteration
    //
    function clean_auth_values($auth_data)
    {
        $auth_return = array();
        // Get Values out of array
        $auth_return['auth_key'] = $auth_data[0]; // '$core->data(\'forum_id\')'
        $auth_condition = $auth_data[1]; // 'auth_view AND auth_read'
        $auth_type = trim($auth_data[2]); // 'forum'
        $auth_return['auth_replacement'] = $auth_data[3]; // array('', '$core->data(\'topic_replies\')', '$lang[\'Hidden_from_public_view\']')

        $auth_return['auth_check'] = array();
        if ($auth_type == 'forum')
        {
            // ok, check the condition
            if (strstr($auth_condition, 'AND'))
            {
                $split = 'AND';
                $split_cond = '&&';
            }
            else if (strstr($auth_condition, 'OR'))
            {
                $split = 'OR';
                $split_cond = '||';
            }
            else
            {
                $split = '';
                $auth_condition = trim($auth_condition);
                @reset($this->auth_data_sql[$auth_type]);
                while (list($forum_id, $auth_cond) = each($this->auth_data_sql[$auth_type]))
                {
                    $auth_return['auth_check'][$forum_id] = $this->auth_data_sql[$auth_type][$forum_id][$auth_condition];
                }
            }

            if ($split != '')
            {
                $if_eval = '';
                $pattern = explode($split, $auth_condition);
                for ($i = 0; $i < count($pattern); $i++)
                {
                    $if_eval .= ($i == 0) ? '($this->auth_data_sql[$auth_type][$forum_id][\'' . trim($pattern[$i]) . '\'])' : ' ' . $split_cond . ' ($this->auth_data_sql[$auth_type][$forum_id][\'' . trim($pattern[$i]) . '\'])';
                }

                @reset($this->auth_data_sql[$auth_type]);
                while (list($forum_id, $auth_cond) = @each($this->auth_data_sql[$auth_type]))
                {
                    eval('$val = (' . $if_eval . ');');
                    $auth_return['auth_check'][$forum_id] = $val;
                }
            }
        }
    
        return ($auth_return);
    }

}

?>