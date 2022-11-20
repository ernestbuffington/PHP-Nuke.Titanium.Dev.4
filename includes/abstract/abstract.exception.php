<?php

/* -- -----------------------------------------------------------
 * // PHP-Nuke Titanium: Enhanced and Advanced
 * -- -----------------------------------------------------------
 *
 * >> Exception Handler
 *
 * @filename    abstract.exception.php
 * @author      SgtLegend
 * @version     0.1
 * @date        July 11, 2013
 * @notes       Abstract class for core exceptions
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

abstract class aException extends Exception {
	/**
	 * The constructor for the exception handler
	 *
	 * @public function __construct
	 * @param string $errorCode
	 * @param mixed $extras
	 */
	public function __construct($errorCode = self::UNKNOWN, $extras = false) {
		parent::__construct($this->getError($errorCode, $extras), $errorCode);
	}
}