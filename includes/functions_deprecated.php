<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Deprecated Functions
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : functions_deprecated.php
   Author        : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 11.21.2005 (mm.dd.yyyy)

   Notes         : Deprecated Functions
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

// Here go the deprecated functions

$mainfile = true;
$nukeuser = (isset($_COOKIE['user'])) ? explode(':', addslashes(base64_decode($_COOKIE['user']))) : '';

require_once(NUKE_INCLUDE_DIR.'sql_layer.php');

function is_group($user, $name) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
}

function update_points($id){
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
}

function public_message(){
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
}

function stripos_clone($haystack, $needle, $offset=0) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return stristr($haystack, $needle);
}

function formatAidHeader($aid) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  echo get_author($aid);
}

function FixQuotes($what = '') {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  $what = Fix_Quotes($what);
  return $what;
}

function selectlanguage() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function userblock() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function loginbox() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function adminblock() {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return;
}

function delQuotes($string) {
  global $debugger;
  $debugger->handle_error("Use of deprecated function <strong>".__FUNCTION__."</strong>");
  return $string;
}

function getusrinfo($trash=0, $force=false) {
  global $userinfo, $debugger;
  return $userinfo;
}

?>