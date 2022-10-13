<?php

/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*----[ Welcome! ] ---------------------------------------
| Welcome to PHP-Nuke Titanium, an advanced content       |
| management system based on PHP-Nuke                     |
---------------------------------------------------------*/

/*----[ $pnt_dbhost ] -------------------------------
| Your database host, normally 'localhost'                |
|                                                         |
| Default: localhost                                      |
---------------------------------------------------------*/
$pnt_dbhost = '%dbhost%';
/*----[ $pnt_dbname ] -------------------------------
| The name of your database that will hold Evo's tables   |
---------------------------------------------------------*/
$pnt_dbname = '%dbname%';

/*----[ $pnt_dbuname ] ------------------------------
| The username linked to your database, must have correct |
| permissions                                             |
---------------------------------------------------------*/
$pnt_dbuname = '%dbuname%';

/*----[ $pnt_dbpass ] -------------------------------
| The password associated with your db usersname          |
---------------------------------------------------------*/
$pnt_dbpass = '%dbpass%';

/*----[ $pnt_dbtype ] -------------------------------
| The type of SQL server you prefer to use                |
|                                                         |
| Choose from the following (case-sensitive):             |
|    - mysql (4.x or later)                               |
|    - mysqli (PHP must be compiled with "System Mysql")  |
|                                                         |
| Default: mysqli                                         |
---------------------------------------------------------*/
$pnt_dbtype = '%dbtype%';

/*----[ $pnt_prefix ] -------------------------------
| The prefix for your PHP-Nuke Titanium tables            |
|                                                         |
| Default: titanium                                       |
---------------------------------------------------------*/
$pnt_prefix = '%prefix%';

/*----[ $pnt_user_prefix ] --------------------------
| The prefix for your PHP-Nuke Titanium user-related      |
| tables Do not change this unless it is really needed    |
|                                                         |
| Default: titanium                                       |
---------------------------------------------------------*/
$pnt_user_prefix = '%user_prefix%';

/*----[ $admin_file ] ------------------------------------
| The filename of your Admin File                         |
|                                                         |
| If you change this to something other than it's default |
| value, you must also rename the file called 'admin.php' |
| to the new value you assigned to this variable          |
|                                                         |
| Default: admin                                          |
---------------------------------------------------------*/
$admin_file = 'admin';

/*----[ $directory_mode ] ------------------------------------------
| permissions - by default, we will create new folders with the     |
| permissions set with the following settings.  NOTE: do NOT use    |
| quotes around this value or it will not work.                     |
| Examples:                                                         |
| Server API = Apache = 0777                                        |
| Server API = CGI = 0755                                           |
-------------------------------------------------------------------*/
$directory_mode = 0777;

/*----[ $file_mode ] -------------------------------------------------- 
| file permissions mode - by default, we will create all new files     |
| with the permissions that are provided here.  NOTE: do NOT use any   |
| quotes (single or double) around this value or it will not work.     |
| Examples:                                                            |
| Server API = Apache = 0666                                           |
| Server API = CGI = 0644                                              |
----------------------------------------------------------------------*/
$file_mode = 0666;

/*----[ $debug ] -----------------------------------------
| Debugging Status of your website                        |
|                                                         |
| If you want errors being shown, set this to true.       |
| It will also display evo notices at the footer,         |
| but that's visible for admins only.                     |
| If you dont want any errors being shown,                |
| set this to false.                                      |
|                                                         |
| Default: true                                           |
---------------------------------------------------------*/
$debug = true;

/*----[ $use_cache ] -----=-------------------------------
| Use caching of database fetched data                    |
|                                                         |
| You can choose between these options:                   |
|   0: Cache Off                                          |
|   1: File Cache                                         |
|       - Faster load, more server usage                  |
|         We recommend you use SQL cache if you have      |
|         problems with the File Cache                    |
|   2: SQL Cache                                          |
|       - One more query per page, less server usage      |
|                                                         |
| Default: 1 (File Cache)                                 |
---------------------------------------------------------*/
$use_cache = 1;

/*----[ $persistency ] -----------------------------------
| Allow persistent database connections                   |
| true = On                                               |
| false = Off                                             |
---------------------------------------------------------*/
$persistency = false;

/*********************************************************************/
/* You have finished configuration of your site. Now you can change  */
/* all you want in the Administration Section. To enter just launch  */
/* your web browser pointing to http://yourdomain.com/admin.php      */
/* (or whatever you have setup in $admin_file)                       */
/*                                                                   */
/* Remember to go to the Settings section where you can configure    */
/* your new site.                                                    */
/*                                                                   */
/* Congratulations! Now you have the webs best portal installed!     */
/* Thanks for choosing PHP-Nuke Titanium: The Future of the Web!     */
/*********************************************************************/
?>
