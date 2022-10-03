<?php 
/*===================================================================== */
/* PHP-Nuke Titanium | Nuke-Evolution Xtreme : A PHP-Nuke Fork          */
/* ==================================================================== */
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');
# Default API version 3.4
use Vimeo\Vimeo;
global $client, $client_id, $client_secret, $access_token;
$client_id = 'yourclientidgoeshere';
$client_secret = 'yourclientsecretgoeshere';
$access_token = 'youraccesstokengoeshere';
$client = new Vimeo("$client_id","$client_secret","$access_token");
