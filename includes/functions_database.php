<?php

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	exit('Access Denied');
}

/**
 * Retrieve the database variable
 *
 * @global db $db Evolution Xtreme database abstraction object.
 * @return object Database Object
 */
function _db() {
	global $db;
	return $db;
}

/**
 * Sends a MySQL query to the server
 *
 * @param mixed $query
 * @return mixed
 */
function dbquery( $query )
{
	return _db()->sql_query( $query );
}

/**
 * Returns an array of fields and values based on the arguments given in the MySQL query
 *
 * @param mixed $query
 * @return mixed
 */
function dbrow( $result ) 
{
	return _db()->sql_fetchrow( $result );
}

/**
 * Returns an array of fields and values based on the arguments given in the MySQL query
 *
 * @param mixed $query
 * @return mixed
 */
function dburow( $result ) 
{
	return _db()->sql_ufetchrow( $result );
}

/**
 * Returns an array of fields and values based on the arguments given in the MySQL query
 *
 * @param  resource $query_id
 * @return mixed
 */
function dbrowset( $result ) 
{
	return _db()->sql_fetchrowset( $result );
}

function dburowset( $result )
{
	return _db()->sql_ufetchrowset( $result );
}

# Gets the total number of rows in the query and returns the value
function dbnumrows( $result ) 
{
	return _db()->sql_numrows( $result );
}

function dbunumrows( $result ) 
{
	return _db()->sql_unumrows( $result );
}

function dbescape( $result ) 
{
	return _db()->sql_escapestring( $result );
}

/**
 * If the table has an AUTO_INCREMENT row present the MySQL server will return the next integer for the newly inserted row
 *
 * @return int
 */	
function dbnextid()
{
	return _db()->sql_nextid();
}

function dbfree( $result ) 
{
	return _db()->sql_freeresult( $result );
}

function dboptimize( $table_name = '' )
{
	return _db()->sql_optimize( $table_name );
}

function dbdebug()
{
	return _db()->print_debug();
}

function dbclose()
{
	return _db()->sql_close();
}

?>