<?php

/* -- -----------------------------------------------------------
 * // Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 * -- -----------------------------------------------------------
 *
 * >> Exception Handler
 *
 * @filename    dbexception.php
 * @author      SgtLegend
 * @version     0.2
 * @date        Aug 10, 2012
 * @notes       An exception handler for the database
 *
 * -- -----------------------------------------------------------
 * // Legal Stuff
 * -- -----------------------------------------------------------
 *
 * (c) Copyright 2000-11 Francisco Burzi
 * http://www.phpnuke.org
 *
 * This program is free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the license.
 */

if (!defined('NUKE_EVO')) {
	die('You can\'t access this file directly...');
}

class DBException extends aException {
	const EXCEPTION_NAME	= 'Database';


	/**
	 * @public static var $validDBTypes
	 *
	 * The currently valid database class types that have been integrated with the Nuke Evolution
	 * Xtreme Core
	 */
	public static $validDBTypes = array('MySQL', 'MySQLi');


	/**
	 * Codes for the database errors
	 */
	const UNKNOWN 			= 100;
	const UNKNOWNDATATYPE 	= 101;
	const INVALIDVERSION 	= 102;
	const INVALIDCREDS 		= 103;
	const CONNECTIONFAILED 	= 104;
	const QUERYFAILED 		= 105;


	/**
	 * Retrieves the error message based on the error code given
	 *
	 * @protected function getError
	 * @param int $errorCode
	 * @param mixed $extras
	 * @param string $error
	 * @return string $message
	 */
	protected function getError($errorCode, $extras) {
		switch ($errorCode) {
			case 100:
				$message = 'An unknown error has occurred, error code: ' . $errorCode;
			break;
			case 101:
				$message = 'The database type ( <strong>' . $extras . '</strong> ) is invalid and can\'t be used as a database connection source, valid database types are: ( ' . join(', ', self::$validDBTypes) . ' )';
			break;
			case 102:
				$message = 'You seem to be using a version of MySQL that Nuke Evolution Xtreme doesn\'t support, please ask your host to upgrade to MySQL 5 and above.';
			break;
			case 103:
				$message = 'While the database connection settings have been validated we found a problem with one or more of them!';
			break;
			case 104:
				$message = 'An error occurred while attempting to establish a connection to the MySQL database!<br><br>' . $extras;
			break;
			case 105:
				return 'An error occurred while attempting to run a query on the database!<br><br>' . $extras;
			break;
		}

		return $message;
	}
}