<?php
/***************************************************************************
 *                                 mysqli.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: mysqli.php,v 1.16 2006/11/02 20:04:36 Revolution Exp $
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

if(!defined("SQL_LAYER"))
{

define("SQL_LAYER","mysqli");
define("SQL_NUM", "MYSQL_NUM");
define("SQL_BOTH", "MYSQL_BOTH");
define("SQL_ASSOC", "MYSQL_ASSOC");
define('END_TRANSACTION', "2");

class sql_db
{
	public $mysql_version;
	public $db_connect_id;
	public $query_result;
	public $row = [];
	public $rowset = [];
	public $num_queries = 0;
    public $time;
    public $debug = 0;
    public $saved = '';
    public $connect_id;
	public $querylist = [];
	public $file;
	public $line;
	public $qtime;
	public $persistency;
	public $user;
	public $password;
	public $server;
	public $dbname;

	function _backtrace_log($query, $failed=false, $queryid=0)
	{
		global $debug;
		if (!is_bool($debug) && $debug == 'full') {
			$this->_backtrace();
			if ($failed) {
				$this->querylist[$this->file][] = '<span style="color: #FF0000; font-weight: bold;">FAILED LINE '.$this->line.':</span> '.htmlspecialchars($query);
			} else {
    			$this->querylist[$this->file][(int)$this->num_queries] = '<span style="font-weight: bold;">LINE '.$this->line.':</span> '.htmlspecialchars($query);
    			if (isset($this->qtime[(int)$this->num_queries])) {
        			$time = (isset($this->qtime[(int)$this->num_queries])) ? ' QTIME:'.substr($this->qtime[(int)$this->num_queries],0,5) : '';
        			$this->querylist[$this->file][(int)$this->num_queries] .= $time;
    			}
			}
		}
	}

	function _backtrace()
	{
		$this->file = 'unknown';
		$this->line = 0;
		if (version_compare(phpversion(), '4.3.0', '>=')) {
			$tmp = debug_backtrace();
			for ($i=0; $i<count($tmp); ++$i) {
				if (!preg_match('#[\\\/]{1}includes[\\\/]{1}db[\\\/]{1}[a-z_]+.php$#', $tmp[$i]['file'])) {
					$this->file = $tmp[$i]['file'];
					$this->line = $tmp[$i]['line'];
					break;
				}
			}
		}
	}

	# Constructor
	function __construct($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
	{
		$this->persistency = $persistency;
		$this->user = $sqluser;
		$this->password = $sqlpassword;
		$this->server = $sqlserver;
		$this->dbname = $database;

		if ($this->dbname != '') {
			//$this->db_connect_id = mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$this->db_connect_id = mysqli_connect($this->server, $this->user, $this->password, $this->dbname);

			if ($this->db_connect_id)
			{
				# Determine what version we are using and if it natively supports UNICODE
				//$this->mysql_version = mysqli_get_server_info($this->db_connect_id);

				# not sure why this was removed i see no explanation, Thanks Dick!
				/*if (version_compare($this->mysql_version, '4.1.3', '>='))
				{
					mysqli_query("SET NAMES 'utf8'", $this->db_connect_id);
					mysqli_query("SET CHARACTER SET 'utf8'", $this->db_connect_id);
				}*/
				$this->connect_id = $this->db_connect_id;
				return $this->db_connect_id;
			}
			else
			{
				header('Location: install.php');
				die();
			}
		}

		return false;
	}

	# Other base methods
	function sql_close()
	{
		if($this->db_connect_id)
		{
			if($this->query_result)
			{
				//mysqli_free_result($this->query_result); # removed for php 8
			}
			$result = mysqli_close($this->db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}

    function check_query($query) {
        global $prefix, $cache;
        if (!stristr($query, "UPDATE") && !stristr($query, "INSERT") && !stristr($query, "DELETE")) { return; }
        $tables = ['nukeconfig' => $prefix . '_config', 
		           'evoconfig' => $prefix . '_evolution', 
				   'titanium_evoconfig' => $prefix . '_evolution', 
				   'board_config' => $prefix . '_bbconfig', 
				   'blocks' => $prefix . '_blocks', 
				   'tianium_blocks' => $prefix . '_blocks', 
				   'ya_config' => $prefix . '_cnbya_config', 
				   'block_modules' => $prefix . '_modules'];
				   
        foreach( $tables as $file => $table )
        {
            if (stristr($query, $table)) {
				$cache->delete($file, 'config');
            }
        }
        return;
    }

    function union_secure($query) {
         # check if it is a SELECT query
//        if (strtoupper($query[0]) == 'S') {
          if (strtoupper((string) $query[0]) == 'S') {
             # SPLIT when theres 'UNION (ALL|DISTINT|SELECT)'
//           $query_parts = preg_split('/(union)([\s\ \*\/]+)(all|distinct|select)/i', $query, -1, PREG_SPLIT_NO_EMPTY);
             $query_parts = preg_split('#(union)([\s\ \*\/]+)(all|distinct|select)#i', (string) $query, -1, PREG_SPLIT_NO_EMPTY);
             # and then merge the query_parts:
             if ((is_countable($query_parts) ? count($query_parts) : 0) > 1) 
			 {
                 $query = '';
             
			    foreach($query_parts AS $part) {
                    $query .= 'UNI0N SELECT'; // A Zero
                    $query .= $part;
                }
            }
        }
    }

	# Base query method
	function sql_query($query = "", $transaction = FALSE)
	{
	    // Get time before query
        $stime = get_microtime();
        $qtime = get_microtime();

		// Remove any pre-existing queries
		if (isset($this->query_result)) 
		unset($this->query_result);

        if(!isset($query))
		$query = '';
		
		if ($query != '')
		{
            if(SQL_LAYER == 'mysqli') {
                $this->union_secure($query);
            }
            if($this->debug) {
                $this->saved .= $query . "<br />";
            }
            $this->num_queries++; # I have gotten errors on query!
			$this->query_result = mysqli_query($this->db_connect_id, $query); 
		}

		if ($this->query_result)
		{
		    //Check query to clear cache?
            $this->check_query($query);
            $this->time += (get_microtime()-$stime);
            $this->qtime[(int) $this->num_queries] = (get_microtime()-$qtime);
			$this->_backtrace_log($query, false, (int) $this->num_queries);
			if (isset($this->row[(int) $this->num_queries])) unset($this->row[(int) $this->num_queries]);
			if (isset($this->rowset[(int) $this->num_queries])) unset($this->rowset[(int) $this->num_queries]);
			return $this->query_result;
		}
		else
		{
            //Get the error array
            $sqlerror = $this->sql_error();

            $this->_backtrace();
            $logdata = ['File: '. $this->file, 'Line: '. $this->line, 'Message: ' . $sqlerror['message'], 'Code: ' . $sqlerror['code'], 'Query: ' . $query];
            //Log error
            if (function_exists('log_write')) {
                //Log error
                log_write('error', $logdata, 'SQL Error');
            } else {
                die('SQL Error: '.$query.'<br />'.$sqlerror['message']);
            }

			// backtrace
			$this->_backtrace_log($query, true);
            //Calc runtime
            $this->time += (get_microtime()-$stime);

 
//			return ( $transaction == END_TRANSACTION ) ? true : false;
			return $transaction == END_TRANSACTION;		
	  }
	}

    function sql_uquery($query)
    {
        return $this->sql_query($query, true);
    }

    /**
	 * Performs a simple select query.
	 *
	 * @param string $table The table name to be queried.
	 * @param string $fields Comma delimetered list of fields to be selected.
	 * @param string $conditions SQL formatted list of conditions to be matched.
	 * @param array $options List of options: group by, order by, order direction, limit, limit start.
	 * @return mysqli_result The query data.
	 */
    function sql_simple_select($table, $fields="*", $conditions="", $options=[])
	{
		$query = "SELECT ".$fields." FROM ".$table;

		if($conditions != "")
		{
			$query .= " WHERE ".$conditions;
		}

		if(isset($options['group_by']))
		{
			$query .= " GROUP BY ".$options['group_by'];
		}

		if(isset($options['order_by']))
		{
			$query .= " ORDER BY ".$options['order_by'];
			if(isset($options['order_dir']))
			{
				$query .= " ".strtoupper($options['order_dir']);
			}
		}

		if(isset($options['limit_start']) && isset($options['limit']))
		{
			$query .= " LIMIT ".$options['limit_start'].", ".$options['limit'];
		}
		else if(isset($options['limit']))
		{
			$query .= " LIMIT ".$options['limit'];
		}

		return $this->sql_query($query);
	}

	function sql_usimple_select($table, $fields="*", $conditions="", $options=[], $type=SQL_BOTH)
	{
		$query = "SELECT ".$fields." FROM ".$table;

		if($conditions != "")
		{
			$query .= " WHERE ".$conditions;
		}

		if(isset($options['group_by']))
		{
			$query .= " GROUP BY ".$options['group_by'];
		}

		if(isset($options['order_by']))
		{
			$query .= " ORDER BY ".$options['order_by'];
			if(isset($options['order_dir']))
			{
				$query .= " ".strtoupper($options['order_dir']);
			}
		}

		if(isset($options['limit_start']) && isset($options['limit']))
		{
			$query .= " LIMIT ".$options['limit_start'].", ".$options['limit'];
		}
		else if(isset($options['limit']))
		{
			$query .= " LIMIT ".$options['limit'];
		}

		$query_id = $this->sql_query($query, true);
        $result = $this->sql_fetchrow($query_id, $type);
        $this->sql_freeresult($query_id);
        return $result;
	}

	# Other query methods
	function sql_numrows($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = mysqli_num_rows($query_id);
			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_unumrows($query) {
		return $this->sql_numrows($this->sql_query($query, true));
	}

	function sql_affectedrows()
	{
		if($this->db_connect_id)
		{
			$result = mysqli_affected_rows($this->db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_numfields($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = mysqli_num_fields($query_id);
			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_fieldname($offset, $query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = mysqli_fetch_field_direct($query_id, $offset);
			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_fieldtype($offset, $query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = mysqli_fetch_field_direct($query_id, $offset);
			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_fetchrow($query_id = 0, $trash=0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
		    $stime = get_microtime();
			$this->row[(int) $this->num_queries] = mysqli_fetch_array($query_id);
			$this->time += (get_microtime()-$stime);
			return $this->row[(int) $this->num_queries];
		}
		else
		{
			return false;
		}
	}

	function sql_fetchrowset($query_id = 0)
	{
	    $stime = get_microtime();
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			if (isset($this->rowset[(int) $this->num_queries])) unset($this->rowset[(int) $this->num_queries]);
			if (isset($this->row[(int) $this->num_queries])) unset($this->row[(int) $this->num_queries]);
			$result = null;
			while($this->rowset[$this->num_queries] = mysqli_fetch_array($query_id))
			{
				$result[] = $this->rowset[(int) $this->num_queries];
			}
			$this->time += (get_microtime()-$stime);
			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_fetchfield()
    {
        return false;
    }

	function sql_rowseek($rownum, $query_id = 0){
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = mysqli_data_seek($query_id, $rownum);
			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_nextid(){
		if($this->db_connect_id)
		{
			$result = mysqli_insert_id($this->db_connect_id);
			return $result;
		}
	    return false;
	}

	function sql_freeresult($query_id = 0){
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		if ( $query_id )
		{
		    if (isset($this->row[(int) $this->num_queries])) 
			unset($this->row[(int) $this->num_queries]);

			if (isset($this->rowset[(int) $this->num_queries])) 
			unset($this->rowset[(int) $this->num_queries]);

			//mysqli_free_result($this->num_queries); # removed for php 8

			if (isset($this->querylist[$this->file][(int)$this->num_queries])) 
			{
			    $this->querylist[$this->file][(int)$this->num_queries] .= '<span style="color: #0000FF; font-weight: bold;"> *</span>';
			}

			return true;
		}
		else
		{
			return false;
		}
	}

	function sql_escapestring($string)
    {
        return $this->sql_addq($string);
    }

	function sql_addq($string)
    {
        static $magic_quotes;
        if ($magic_quotes) $string = stripslashes($string);
        return (version_compare(phpversion(), '4.3.0', '>=')) ? mysqli_real_escape_string($this->db_connect_id, $string) : mysqli_escape_string($this->db_connect_id, $string);
    }

	function sql_error($query_id = 0)
    {
        return ['message' => mysqli_error($this->db_connect_id), 'code' => mysqli_errno($this->db_connect_id)];
    }

	function sql_ufetchrow($query = "", $type=SQL_BOTH)
    {
        $query_id = $this->sql_query($query, true);
        $result = $this->sql_fetchrow($query_id, $type);
        $this->sql_freeresult($query_id);
        return $result;
    }

	function sql_optimize($table_name="")
    {
        $result = null;
        global $dbname;
        $error = false;
        if (empty($table_name)) {
            $nuke_tables = $this->sql_fetchtables($dbname, true);
            foreach($nuke_tables as $table) {
                if(!$result = $this->sql_query('OPTIMIZE TABLE ' . $table)) {
                    $error = true;
                }
                $this->sql_freeresult($result);
            }
        } else {
            if(!$result = $this->sql_query('OPTIMIZE TABLE ' . $table_name)) {
                $error = true;
            }
            $this->sql_freeresult($result);
        }
        $this->sql_freeresult($result);
		return ((!$error) ? true : false);
    }

	/*!
	* Performs a search on the current/chosen database and returns all tables
	* associated with it
	*
	* @public function sql_fetchtables
	* @param  string  $database
	* @param  boolean $nuke_only
	* @return array   $tables
	*/	
	function sql_fetchtables($database="", $nuke_only=false)
    {
        global $prefix;
        $result = $this->sql_query(empty($database) ? 'SHOW TABLES' : 'SHOW TABLES FROM '.$database);
        $tables = [];
        while ([$name] = $this->sql_fetchrow($result)) {
            if ($nuke_only) {
                if(stristr($name, $prefix.'_')) {
                    $tables[$name] = $name;
                }
            } else {
                $tables[$name] = $name;
            }
        }
        $this->sql_freeresult($result);
        return $tables;
    }

	function sql_fetchdatabases()
    {
        $result = $this->sql_query('SHOW DATABASES');
        $databases = [];
        while ([$name] = $this->sql_fetchrow($result)) {
            $databases[$name] = $name;
        }
        $this->sql_freeresult($result);
        return $databases;
    }

    function sql_ufetchrowset($query = '', $type=SQL_BOTH)
    {
        $query_id = $this->sql_query($query, true);
        return $this->sql_fetchrowset($query_id);
    }

    # print debug
    function print_debug() {
        if ($this->debug) {
            return $this->saved;
        }
        return '';
    }

    function mariadb_short_version()
	{
		global $heading_color;
	  if($this->db_connect_id):
	  $result  = '<hr><span style="color:'.$heading_color.';">Database Server</span></br>';
	  $result .= mysqli_get_server_info($this->db_connect_id);
	  return $result;
		else:
			return false;
		endif;
	}

	# added by Ernest Allen Buffington 4/29/2021 Thursday 9:05pm
    function mariadb_version()
	{
	  if($this->db_connect_id):
	  $result  = '<div class="poweredby"> <a class="poweredby" href="http://www.php-nuke-titanium.86it.us/" target="_blank">Powered by PHP-Nuke Titanium v'.NUKE_TITANIUM.' | &copy; 2005, 2022 PHP-Nuke Titanium Group</a></div>';
	  $result .= 'MySQL Database Server: ';
	  $result .= mysqli_get_server_info($this->db_connect_id);
	  return $result;
		else:
			return false;
		endif;
	}

} // class sql_db

} // if ... define
