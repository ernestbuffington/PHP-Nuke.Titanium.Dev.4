<?php

/* -- -----------------------------------------------------------
 * // Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 * -- -----------------------------------------------------------
 *
 * >> Database
 *
 * @filename    mysql.php
 * @author      The Nuke Evolution Xtreme Team and The phpBB Group
 * @version     1.17
 * @date        Feb 25, 2012
 * @notes       n/a
 *
 * -- -----------------------------------------------------------
 * // Legal Stuff
 * -- -----------------------------------------------------------
 *
 * (c) Copyright 2001 The phpBB Group
 * support@phpbb.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 */

if (!defined('SQL_LAYER')) {
	define('SQL_LAYER', 		'mysql');
	define('SQL_NUM', 			MYSQL_NUM);
	define('SQL_BOTH', 			MYSQL_BOTH);
	define('SQL_ASSOC', 		MYSQL_ASSOC);
	define('END_TRANSACTION',	2);

	class sql_db {
		/*!
		 * @public var $mysql_version
		 *
		 * The current MySQL server version
		 */
		public $mysql_version;

		/*!
		 * @public var $db_connect_id
		 *
		 * The unique indentifier for the current database connection
		 */
		public $db_connect_id;

		/*!
		 * @public var $num_queries
		 *
		 * Total number of queries that were processed by this instance of the
		 * database connection
		 */
		public $num_queries = 0;

		/*!
		 * @public var $time
		 *
		 * Total time in miliseconds it took to run all the queries by this instance
		 * of the database connection
		 */
		public $time;

		/*!
		 * @public var $debug
		 *
		 * Can be used to check for invalid MySQL queries once they have been run
		 */
		public $debug = false;

		/*!
		 * @public var $saved
		 *
		 * Storage for MySQL query debugging
		 */
		public $saved = '';

		/*!
		 * @public var $querylist
		 *
		 * A cached list of queries that can be stored internally by Nuke
		 */
		public $querylist = array();

		/*!
		 * @public var $file
		 *
		 * A string that represents a cache file
		 */
		public $file;

		/*!
		 * @public var $line
		 *
		 * General use throughout the instance of this class
		 */
		public $line;

		/*!
		 * @public var $qtime
		 *
		 * An array that stores the total time it took for each MySQL query to
		 * complete
		 */
		public $qtime = array();

		/*!
		 * @public var $query_result
		 *
		 * Use of this property should be avoided but it can be used to stored a
		 * MySQL resource for use within this instance of the database connection
		 */
		public $query_result;

		/*!
		 * @private var $_queries
		 *
		 * Storage for all the queries been handled by the current instance of the
		 * MySQL class
		 */
		private $_queries = array();

		/*!
		 * Creates a new connection to the MySQL server
		 *
		 * @public function __construct
		 * @param  string   $server
		 * @param  string   $username
		 * @param  string   $password
		 * @param  string   $database
		 * @param  boolean  $persistency
		 * @return resource
		 */
		public function __construct($server, $username, $password, $database, $persistency = true) {
			$type = ($persistency) ? 'mysql_pconnect' : 'mysql_connect';

			try {
				// Connect to the MySQL database
				$this->db_connect_id = $type($server, $username, $password);

				mysql_select_db($database);
				$this->mysql_version = mysql_get_server_info($this->db_connect_id);

				return $this->db_connect_id;
			} catch (DBException $ex) {
				throw new DBException(DBException::CONNECTIONFAILED, mysql_error());
			}
		}

		/*!
		 * Closes the current connection to the MySQL server
		 *
		 * @public function sql_close
		 * @return mixed
		 */
		public function sql_close() {
			if ($this->db_connect_id) {
				if ($this->is_resource($this->query_result)) {
					mysql_free_result($this->query_result);
				}

				return mysql_close($this->db_connect_id);
			} else {
				return false;
			}
		}

		/*!
		 * Sends a MySQL query to the server
		 *
		 * @public function sql_query
		 * @param  string  $query
		 * @param  boolean $transaction
		 * @return mixed
		 */
		public function sql_query($query = null, $transaction = false) {
		    // Get time before query
	        $stime = get_microtime();
	        $qtime = get_microtime();

			// Remove any pre-existing queries
			if ($this->query_result !== false) {
				$this->query_result = false;
			}

			if ($query !== '') {
	            $this->union_secure($query);

	            if ($this->debug) {
	                $this->saved .= $query . '<br />';
	            }

	            $this->num_queries++;

	            // Store the query
				$this->query_result = mysql_query($query, $this->db_connect_id);
			}

			if ($this->query_result) {
				// Get the query id
				$query_id = (int) $this->query_result;

				// Cache the query
				$this->_queries[$query_id] = array(
					'result' => $this->query_result,
					'query'  => $query
				);

				// Clear any cached form of this query
	            $this->check_query($query);

	            // Set the overall query time
	            $this->time += (get_microtime() - $stime);
	            $this->qtime[] = (get_microtime() - $qtime);

				$this->_backtrace_log($query, false, $query_id);

				if (isset($this->_queries[$query_id][0]['row'])) {
					unset($this->_queries[$query_id][0]['row']);
				}

				if (isset($this->_queries[$query_id][0]['rowset'])) {
					unset($this->_queries[$query_id][0]['rowset']);
				}

				// Return the query result
				return $this->query_result;
			} else {
				$this->_queries[(int) $this->db_connect_id] = array(
					'result' => $this->db_connect_id,
					'query'  => $query
				);

	            $sqlerror = $this->sql_error((int) $this->db_connect_id);
	            $this->_backtrace();

	            $logdata = array(
	            	'File: '. $this->file,
	            	'Line: '. $this->line,
	            	'Message: ' . $sqlerror['message'],
	            	'Code: ' . $sqlerror['code'],
	            	'Query: ' . $query
	            );

	            if (function_exists('log_write')) {
	                log_write('error', $logdata, 'SQL Error');
	            }

	            throw new DBException(DBException::QUERYFAILED, mysql_error());

				$this->_backtrace_log($query, true);
	            $this->time += (get_microtime() - $stime);

				return ($transaction == END_TRANSACTION) ? true : false;
			}
		}

		/*!
		 * Creates secure query to be used in a MySQL query
		 *
		 * @public function union_secure
		 * @param string $query
		 */
		public function union_secure($query) {
	        // Check if it is a SELECT query
	        if (strtoupper($query[0]) == 'S') {
	            // Split when theres 'UNION (ALL|DISTINT|SELECT)'
	            $query_parts = preg_split('/(union)([\s\ \*\/]+)(all|distinct|select)/i', $query, -1, PREG_SPLIT_NO_EMPTY);

	            // and then merge the query_parts:
	            if (count($query_parts) > 1) {
	                $query = '';

	                foreach($query_parts AS $part) {
	                    $query .= 'UNI0N SELECT'; // A Zero
	                    $query .= $part;
	                }
	            }
	        }
	    }

	    /*!
		 * A helper function, no need to say anymore
		 *
		 * @public function sql_uquery
		 * @param  string   $query
		 * @return resource
		 */
		public function sql_uquery($query) {
	        return $this->sql_query($query, true);
	    }

	    /*!
		 * Checks the current query for a cache version of the return value, if it
		 * exists in the cache delete it
		 *
		 * @public function check_query
		 * @param  string $query
		 * @return null
		 */
		public function check_query($query) {
	        global $db, $cache;

	        if (!stristr($query, 'UPDATE') && !stristr($query, 'INSERT') && !stristr($query, 'DELETE')) {
	        	return;
	        }

	        $tables = array(
				'nukeconfig' 	=> $db->prefix . '_config',
				'evoconfig' 	=> $db->prefix . '_evolution',
				'board_config' 	=> $db->prefix . '_bbconfig',
				'blocks' 		=> $db->prefix . '_blocks',
				'ya_config' 	=> $db->prefix . '_cnbya_config',
				'block_modules' => $db->prefix . '_modules'
			);

            foreach ($tables as $file => $table) {
            
			  if (stristr((string) $query, (string) $table)) {
				$cache->delete($file, 'config');
	            }
            }
	        return;
	    }

	    /*!
		 * Gets the total number of rows in the query and returns the value
		 *
		 * @public function sql_numrows
		 * @param  resource $query_id
		 * @return mixed
		 */
		public function sql_numrows($query_id = false) {
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					return mysql_num_rows($query[0]['result']);
				} else {
					return false;
				}
			}
			else
			{
				return false;
			}
		}

		/*!
		 * Frees the given resource from the MySQL cache
		 *
		 * @public function sql_freeresult
		 * @param  resource $query_id
		 * @return boolean
		 */
		public function sql_freeresult($query_id = false) {
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					if (isset($this->_queries[$query[1]][0]['row'])) {
						unset($this->_queries[$query[1]][0]['row']);
					}

					if (isset($this->_queries[$query[1]][0]['rowset'])) {
						unset($this->_queries[$query[1]][0]['rowset']);
					}

					if (isset($this->querylist[$this->file][$query[1]])) {
					    $this->querylist[$this->file][$query[1]] .= '<span style="color: #0000FF; font-weight: bold;"> *</span>';
					}

					mysql_free_result($query[0]['result']);
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * Sets the database charset for the current instance
		 *
		 * @public function set_charset
		 * @return mixed
		 */
		public function set_charset() {
		    if (function_exists('mysql_set_charset')) {
		        if (mysql_set_charset('utf8', $this->db_connect_id)) {
		            return;
		        }
		    }

		    $this->sql_uquery('SET NAMES utf8');
		}

		/*!
		 * Returns an array of rows that were altered during previous MySQL
		 * queries to the server
		 *
		 * @public function sql_affectedrows
		 * @return mixed
		 */
		public function sql_affectedrows() {
			if ($this->db_connect_id) {
				return mysql_affected_rows($this->db_connect_id);
			} else {
				return false;
			}
		}

		/*!
		 * Gets the total number of fields that exist in the table for the supplied
		 * MySQL query
		 *
		 * @public function sql_numfields
		 * @param  resource $query_id
		 * @return mixed
		 */
		public function sql_numfields($query_id = false) {
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					return mysql_num_fields($query[0]['result']);
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * Returns the name of the table field based on the integer given in the
		 * MySQL query
		 *
		 * @public function sql_fieldname
		 * @param  int      $offset
		 * @param  resource $query_id
		 * @return mixed
		 */
		public function sql_fieldname($offset, $query_id = false) {
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					return mysql_field_name($query[0]['result'], $offset);
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * Returns the type value for the field specified in the MySQL query
		 *
		 * @public function sql_fieldtype
		 * @param  int      $offset
		 * @param  resource $query_id
		 * @return mixed
		 */
		public function sql_fieldtype($offset, $query_id = false) {
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					return mysql_field_type($query[0]['result'], $offset);
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * Returns an array of fields and values based on the arguments given in
		 * the MySQL query
		 *
		 * @public function sql_fieldtype
		 * @param  resource $query_id
		 * @param  int      $trash
		 * @return mixed
		 */
		public function sql_fetchrow($query_id = false, $trash = 0) {
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					$stime = get_microtime();
					$this->_queries[$query[1]][0]['row'] = mysql_fetch_array($query[0]['result']);
					$this->time += (get_microtime() - $stime);

					return $this->_queries[$query[1]][0]['row'];
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * Returns an array of fields and values based on the arguments given in
		 * the MySQL query
		 *
		 * @public function sql_fetchrowset
		 * @param  resource $query_id
		 * @return mixed
		 */
		public function sql_fetchrowset($query_id = false) {
		    if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					$stime = get_microtime();

					if (isset($this->_queries[$query[1]][0]['row'])) {
						unset($this->_queries[$query[1]][0]['row']);
					}

					if (isset($this->_queries[$query[1]][0]['rowset'])) {
						unset($this->_queries[$query[1]][0]['rowset']);
					}

					$result = array();

					while ($this->_queries[$query[1]][0]['rowset'] = mysql_fetch_array($query[0]['result'])) {
						$result[] = $this->_queries[$query[1]][0]['rowset'];
					}

					$this->time += (get_microtime() - $stime);

					return $result;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * Either searches the database of query cache for a specified field in the
		 * requested MySQL query
		 *
		 * @public function sql_fetchfield
		 * @param  string   $field
		 * @param  int      $rownum
		 * @param  resource $query_id
		 * @return mixed
		 */
		public function sql_fetchfield($field, $rownum = -1, $query_id = false) {
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					if ($rownum > -1) {
						$result = mysql_result($query[0]['result'], $rownum, $field);
					} else {
						if (empty($this->_queries[$query[1]][0]['row']) && empty($this->_queries[$query[1]][0]['rowset'])) {
							if ($this->sql_fetchrow($query[0]['result'])) {
								$result = $this->_queries[$query[1]][0]['row'][$field];
							}
						} else {
							if (isset($this->_queries[$query[1]][0]['rowset'][$field])) {
								$result = $this->_queries[$query[1]][0]['rowset'][$field];
							} else if (isset($this->_queries[$query[1]][0]['row'][$field])) {
								$result = $this->_queries[$query[1]][0]['row'][$field];
							} else {
								return false;
							}
						}
					}

					return $result;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * Creates a collection of data based on the MySQL query given and a specific
		 * row number to search in
		 *
		 * @public function sql_rowseek
		 * @param  int      $rownum
		 * @param  resource $query_id
		 * @return mixed
		 */
		public function sql_rowseek($rownum, $query_id = false){
			if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					return mysql_data_seek($query[0]['result'], $rownum);
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		/*!
		 * If the table has an AUTO_INCREMENT row present the MySQL server will
		 * return the next integer for the newly inserted row
		 *
		 * @public function sql_nextid
		 * @return mixed
		 */
		public function sql_nextid(){
			if ($this->db_connect_id) {
				return mysql_insert_id($this->db_connect_id);
			}

		    return false;
		}

		/*!
		 * To prevent MySQL injection attacks we can use this method to escape a
		 * given query to prevent un-wanted union attacks and such
		 *
		 * @public function sql_escapestring
		 * @param  string $query
		 * @return string
		 */
		public function sql_escapestring($query) {
	        return $this->sql_addq($query);
	    }

	    /*!
		 * This method escapes a given query which eliminates the risk of a MySQL
		 * injection attack on the server
		 *
		 * @public function sql_addq
		 * @param  string $query
		 * @return string
		 */
		public function sql_addq($query) {
	        static $magic_quotes;

	        if (!isset($magic_quotes)) {
	        	$magic_quotes = get_magic_quotes_gpc();
	        }

	        if ($magic_quotes) {
	        	$query = stripslashes($query);
	        }

	        return (version_compare(phpversion(), '4.3.0', '>=')) ? mysql_real_escape_string($query, $this->db_connect_id) : mysql_escape_string($query);
	    }

	    /*!
		 * Based on the query resource given this method will return a more well formed
		 * MySQL error which includes both the error message and code
		 *
		 * @public function sql_error
		 * @param  resource $query_id
		 * @return array
		 */
		public function sql_error($query_id = false) {
	        if (!$query_id && $this->query_result !== false) {
				$query_id = $this->query_result;
			}

			// Only continue if the query id is not a boolean value
			if ($query_id && !is_bool($query_id)) {
				// Check if the query is in the cache
				if (($query = $this->get_query_by_res($query_id)) !== false) {
					return array(
						'message' => mysql_error($query[0]['result']),
						'code'    => mysql_errno($query[0]['result'])
					);
				} else {
					return false;
				}
			} else {
				return false;
			}
	    }

	    /*!
		 * Performs both a MySQL query and fetchrow function which is great for small
		 * queries to the database
		 *
		 * @public function sql_ufetchrow
		 * @param  string   $query
		 * @param  constant $type
		 * @return mixed
		 */
		public function sql_ufetchrow($query = false, $type = SQL_BOTH) {
			// Ensure a query string was passed
			if (!$query) {
				return false;
			}

			if (!$query_id = $this->sql_query($query, true)) {
	        	$error = $this->sql_error($query_id);
	        	trigger_error($error['message'], E_USER_WARNING);
	        }

	        $result = $this->sql_fetchrow($query_id, $type);
	        $this->sql_freeresult($query_id);

	        return $result;
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
		public function sql_fetchtables($database = '', $nuke_only = false) {
	        global $db;

	        $result = $this->sql_query(empty($database) ? 'SHOW TABLES' : 'SHOW TABLES FROM ' . $database);
	        $tables = array();

	        while (list($name) = $this->sql_fetchrow($result)) {
	            if ($nuke_only) {
	                if (stristr($name, $db->prefix . '_')) {
	                    $tables[$name] = $name;
	                }
	            } else {
	                $tables[$name] = $name;
	            }
	        }

	        $this->sql_freeresult($result);

	        return $tables;
	    }

	    /*!
		 * Allows a specified table to be optimized for performance and indexing or
		 * if $table_name is blank optimize the entire database
		 *
		 * @public function sql_optimize
		 * @param  string  $table_name
		 * @return boolean
		 */
		public function sql_optimize($table_name = false) {
	        global $dbname;

	        $error = false;

	        if (!$table_name) {
	            $nuke_tables = $this->sql_fetchtables($dbname, true);

	            foreach ($nuke_tables as $table) {
	                if (!$result = $this->sql_query('OPTIMIZE TABLE ' . $table)) {
	                    $error = true;
	                }

	                $this->sql_freeresult($result);
	            }
	        } else {
	            if (!$result = $this->sql_query('OPTIMIZE TABLE ' . $table_name)) {
	                $error = true;
	            }

	            $this->sql_freeresult($result);
	        }

			return !$error ? true : false;
	    }

	    /*!
		 * This method lists out all the database associated with the current MySQL
		 * server user
		 *
		 * @public function sql_fetchdatabases
		 * @return array $databases
		 */
		public function sql_fetchdatabases() {
	        $result    = $this->sql_query('SHOW DATABASES');
	        $databases = array();

	        while (list($name) = $this->sql_fetchrow($result)) {
	            $databases[$name] = $name;
	        }

	        $this->sql_freeresult($result);
	        return $databases;
	    }

	    /*!
		 * Performs a 2 in 1 query action that returns an array of fields and values
		 * based on the second argument which accepts a MySQL constant
		 *
		 * @public function sql_ufetchrowset
		 * @param  string   $query
		 * @param  constant $type
		 * @return mixed
		 */
		public function sql_ufetchrowset($query = false, $type = SQL_BOTH) {
			// Ensure a query string was passed
			if (!$query) {
				return false;
			}

	        if (!$query_id = $this->sql_query($query, true)) {
	        	$error = $this->sql_error($query_id);
	        	throw new DBException(DBException::QUERYFAILED, $error['message']);
	        }

	        return $this->sql_fetchrowset($query_id, $type);
	    }

	    /*!
		 * Prints the debug response of all the stored MySQL queries
		 *
		 * @public function print_debug
		 * @return string
		 */
		public function print_debug() {
	        if ($this->debug && strlen(trim($this->saved)) > 0) {
	            return $this->saved;
	        }

	        return '';
	    }

	    /*!
		 * Stores the MySQL query in an array that can be used later on for tracing
		 * MySQL queries back to there origin
		 *
		 * @public function _backtrace_log
		 * @param  string  $query
		 * @param  boolean $failed
		 * @param  int     $queryid
		 */
		public function _backtrace_log($query, $failed = false, $queryid = 0) {
			global $debug;

			if (!is_bool($debug) && $debug == 'full') {
				$this->_backtrace();

				if ($failed) {
					$this->querylist[$this->file][] = '<span style="color: #FF0000; font-weight: bold;">FAILED LINE '.$this->line.':</span> ' . htmlspecialchars($query);
				} else {
	    			$this->querylist[$this->file][$queryid] = '<span style="font-weight: bold;">LINE '.$this->line.':</span> '.htmlspecialchars($query);

	    			if (isset($this->qtime[$queryid])) {
	        			$time = isset($this->qtime[$queryid]) ? ' QTIME:' . substr($this->qtime[$queryid], 0, 5) : '';
	        			$this->querylist[$this->file][$queryid] .= $time;
	    			}
				}
			}
		}

		/*!
		 * If the PHP version for the server is greater then 4.3.0 we have the
		 * ability to backtrace where the MySQL query was called
		 *
		 * @public function _backtrace
		 */
		public function _backtrace() {
			$this->file = 'unknown';
			$this->line = 0;

			if (version_compare(phpversion(), '4.3.0', '>=')) {
				$tmp = debug_backtrace();

				for ($i = 0; $i < count($tmp); ++$i) {
					if (!preg_match('#[\\\/]{1}includes[\\\/]{1}db[\\\/]{1}[a-z_]+.php$#', $tmp[$i]['file'])) {
						$this->file = $tmp[$i]['file'];
						$this->line = $tmp[$i]['line'];
						break;
					}
				}
			}
		}

		/*!
		 * Checks if the resource gievn is a valid MySQL query
		 *
		 * @private function is_resource
		 * @param   mixed $resource
		 * @return  boolean
		 */
		private function is_resource($resource = false) {
			if (!$resource || ($resource && (is_bool($resource) || !is_resource($resource)))) {
				return false;
			}

			return true;
		}

		/*!
		 * Detects the query id for the supplied resource and returns a cached
		 * version of the query to prevent overhead and memory loss
		 *
		 * @private function get_query_by_res
		 * @param   resource $resource
		 * @return  mixed
		 */
		private function get_query_by_res($resource) {
			// Only continue if the resource is a valid MySQL result
			if (!$this->is_resource($resource)) {
				return false;
			}

			// Convert the resource into a query id
			$query_id_num = (int) $resource;

			// Get the cached version of the query
			if (isset($this->_queries[$query_id_num])) {
				return array(
					$this->_queries[$query_id_num],
					$query_id_num
				);
			} else {
				return false;
			}
		}
	}
}