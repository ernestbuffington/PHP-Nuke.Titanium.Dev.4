<?php
/**
*****************************************************************************************
** PHP-AN602  (Titanium Edition) v1.0.0 - Project Start Date 11/04/2022 Friday 4:09 am **
*****************************************************************************************
** https://an602.86it.us/
** https://github.com/php-an602/php-an602
** https://an602.86it.us/index.php (DEMO)
** Apache License, Version 2.0, MIT license 
** Copyright (C) 2021
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts/Black_Heart) for Bit Torrent Manager Contribution!
** And Technocrat for the Nuke Evolution Contributions
** And The Mortal, and CoRpSE for the Nuke Evolution Xtreme Contributions
** Project Leaders: TheGhost, NukeSheriff, TheWolf, CodeBuzzard, CyBorg, and  Pipi
** File include/configdata.php 2020-12-22 00:00:00 Black_Heart
**
**/

if (!defined('IN_NUKE'))
{
    die ('Error 404 - Page Not Found');
}

/* ---------------------------------
Database Configuration
You have to Configure your Database
Connection Here. Here is a Quick
Explanation:

db_type: your Database Type
    Possible Options:
        MySQL
        MySQL4
        MySQLi
        Postgres
        MSSQL
        Oracle
        MSAccess
        MSSQL-ODBC
        DB2

db_host     : Host where your Database Runs
db_port     : Not Used
db_user     : Database Username
db_password : Database Password
db_name     : Database Name on Server
db_prefix   : Prefix for Tables
persistency : Connection Persistency
--------------------------------- */
$db_type        = "MySQLi";
$db_host        = "localhost";
$db_user        = "phpnuke_user";
$db_pass        = "xwdNPADv86pn";
$db_name        = "phpnuke_db2";
$db_prefix      = "nuke"; //Without "_"
$db_persistency = false;

/* ---------------------------------
RSA Engine Configuration
Make sure you ran rsa_keygen BEFORE
Configuring RSA. You NEED a VALID
Key Pair to Enable RSA.
You can Copy & Paste the rsa_keygen Output
--------------------------------- */
$use_rsa     = false;
$rsa_modulo  = 32366461;
$rsa_public  = 9059;
$rsa_private = 28279883;

/*----------------------------------
Torrent Upload Directory
You can Change the Default Setting,
but Remember that it MUST be Writeable
by httpd/IUSR_MACHINE User
----------------------------------*/
$uploads_dir = "uploads";

?>