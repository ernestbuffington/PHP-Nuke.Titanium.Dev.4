<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Merged with new SQL Layer by Quake                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('NUKE_EVO')) {
    die("You can't access this file directly...");
}

if(!defined("SQL_LAYER")) {
  require_once(NUKE_DB_DIR."db.php");
}

function sql_logout($id)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_close($id);
}

function sql_query($query, $id="")
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_query($query);
}

function sql_num_rows($res)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_numrows($res);
}

function sql_fetch_row(&$res, $nr=0)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_fetchrow($res);
}

function sql_fetch_array(&$res, $nr=0)
{
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_fetchrow($res);
}

function sql_fetch_object(&$res, $nr=0) {
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function sql_free_result($res) {
  global $db, $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $db->sql_freeresult($res);
}

?>