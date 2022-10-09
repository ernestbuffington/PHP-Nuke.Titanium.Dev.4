<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                db_cache.php
 *                            -------------------
 *   begin                : Wed, Jan 01, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: db_cache.php,v 1.3 2003/02/09 18:08:14 acydburn Exp $
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

//
// cached database results
//
class cached_db
{
    var $n = array();
    var $fs = array();
    var $f = array();

    function __construct($numrows, $fetchrowset, $fetchrow)
    {
        $this->n = $numrows;
        $this->fs = $fetchrowset;
        $this->f = $fetchrow;
    }
}

class StatisticsDB
{
    var $db_result = array();
    var $index = -2;
    var $numrows_data = array();
    var $fetchrowset_data = array();
    var $fetchrow_data = array();
    var $use_cache = FALSE;
    var $curr_n_row = 0;
    var $curr_fs_row = 0;
    var $curr_f_row = 0;

    // DEBUG
    var $num_queries = 0;
    var $sql_time = 0;
    var $sql_report = '';

    function __construct()
    {
    }

    function begin_cached_query($cache_enabled = FALSE, $cached_data = '')
    {
        $this->db_result = array();
        $this->numrows_data = array();
        $this->fetchrowset_data = array();
        $this->fetchrow_data = array();
        $this->index = -1;
        $this->use_cache = FALSE;
    
        if ($cache_enabled)
        {
            $this->use_cache = TRUE;
            $data = unserialize(stripslashes($cached_data));
            $this->numrows_data = $data->n;
            $this->fetchrowset_data = $data->fs;
            $this->fetchrow_data = $data->f;
            $this->curr_n_row = 0;
            $this->curr_fs_row = 0;
            $this->curr_f_row = 0;
        }
    }

    function begin_new_transaction()
    {
    }
    
    function end_previous_transaction()
    {
    }

    function sql_query($query = "", $transaction = FALSE)
    {
        global $db, $dbms;

        if ($this->index == -2)
        {
            // Not called begin_cached_query... we will do it then
            $this->begin_cached_query();
        }

        if ($this->index > 0)
        {
            $this->end_previous_transaction();
        }
        
        $this->index++;

        if (!$this->use_cache)
        {
            $this->num_queries++;

            if ( STATS_DEBUG )
            {
                global $stats_starttime;
                $curtime = explode(' ', microtime());
                $curtime = $curtime[0] + $curtime[1] - $stats_starttime;
            }

            $db_result = $db->sql_query($query, $transaction);

            if ( STATS_DEBUG )
            {
                $endtime = explode(' ', microtime());
                $endtime = $endtime[0] + $endtime[1] - $stats_starttime;

                $this->sql_report .= "<pre>Query:\t" . htmlspecialchars(preg_replace('/[\s]*[\n\r\t]+[\n\r\s\t]*/', "\n\t", $query)) . "\n\n";
                $affected_rows = $db->sql_affectedrows($db_result);
                if ($db_result)
                {
                    $this->sql_report .= "Time before:  $curtime\nTime after:   $endtime\nElapsed time: <strong>" . ($endtime - $curtime) . "</strong>\n</pre>";
                }
                else
                {
                    $error = $db->sql_error();
                    $this->sql_report .= '<strong>FAILED</strong> - MySQL Error ' . $error['code'] . ': ' . htmlspecialchars($error['message']) . '<br /><br /><pre>';
                }
                $this->sql_time += $endtime - $curtime;

                if ( (($dbms == 'mysql') || ($dbms == 'mysql4')) && (function_exists('mysql_fetch_assoc')) )
                {
                    if (preg_match('/^SELECT/', $query))
                    {
                        $html_table = FALSE;
                        if ($result = mysql_query("EXPLAIN $query", $db->db_connect_id))
                        {
                            $i = 0;
                            while ($row = mysql_fetch_assoc($result))
                            {
                                $extra = array_pop($row);
                                if (!$html_table && count($row))
                                {
                                    $html_table = TRUE;
                                    $this->sql_report .= "<table width=100% border=1 cellpadding=2 cellspacing=1>\n";
                                    $this->sql_report .= "<tr>\n<td><strong>" . implode("</strong></td>\n<td><strong>", array_keys($row));
                                    $this->sql_report .= "</strong></td>\n<td><strong>affected_rows";
                                    $this->sql_report .= "</strong></td>\n<td><strong>Extra"    . "</strong></td>\n</tr>\n";
                                }
                                $this->sql_report .= "<tr>\n<td>" . implode("&nbsp;</td>\n<td>", array_values($row));
                                $this->sql_report .= "&nbsp;</td>\n<td>" . ( ($i == 0) ? $affected_rows : '' );
                                $this->sql_report .= "&nbsp;</td>\n<td>" . $extra . "&nbsp;</td>\n</tr>\n";
                                $i++;
                            }
                        }
                        if ($html_table)
                        {
                            $this->sql_report .= '</table><br />';
                        }
                    }
                    $this->sql_report .= "<hr />\n";
                }
            }
        }
        else
        {
            $db_result = $this->index;
            $this->curr_n_row = 0;
            $this->curr_fs_row = 0;
            $this->curr_f_row = 0;
        }

        $this->db_result[$this->index] = $db_result;

        $this->begin_new_transaction();
        
        if (!$this->use_cache)
        {
            return ($db_result);
        }
        else
        {
            return (TRUE);
        }
    }

    function sql_numrows($query_id = 0)
    {
        global $db;

        if (!$this->use_cache)
        {
            $result = $db->sql_numrows($query_id);
            $this->numrows_data[$this->index][] = $result;
        }
        else
        {
            $result = $this->numrows_data[$this->index][$this->curr_n_row++];
        }

        return ($result);
    }

    function sql_fetchrowset($query_id = 0)
    {
        global $db;

        if (!$this->use_cache)
        {
            $result = $db->sql_fetchrowset($query_id);
            $this->fetchrowset_data[$this->index][] = $result;
        }
        else
        {
            $result = $this->fetchrowset_data[$this->index][$this->curr_fs_row++];
        }

        return ($result);
    }

    function sql_fetchrow($query_id = 0)
    {
        global $db;

        if (!$this->use_cache)
        {
            $result = $db->sql_fetchrow($query_id);
            $this->fetchrow_data[$this->index][] = $result;
        }
        else
        {
            $result = $this->fetchrow_data[$this->index][$this->curr_f_row++];
        }

        return ($result);
    }

    function end_cached_query($module_id, $empty_cache = false)
    {
        global $db;

        if ($this->use_cache)
        {
            return;
        }
        
        if ($empty_cache)
        {
            $sql = "UPDATE " . CACHE_TABLE . "
            SET db_cache = ''
            WHERE module_id = " . $module_id;
        }
        else
        {
            $data = new cached_db($this->numrows_data, $this->fetchrowset_data, $this->fetchrow_data);
    
            $sql = "UPDATE " . CACHE_TABLE . "
            SET db_cache = '" . sql_quote(serialize($data)) . "',
            module_cache_time = " . time() . "
            WHERE module_id = " . $module_id;
        }

        if (!$db->sql_query($sql))
        {
            message_die(GENERAL_ERROR, 'Unable to update DB Cache', '', __LINE__, __FILE__, $sql);
        }
    }
}

?>