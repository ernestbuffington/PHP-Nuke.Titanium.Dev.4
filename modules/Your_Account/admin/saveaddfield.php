<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die ('Access Denied');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(is_mod_admin($module_name)) {

if (count($field_name) > 0) {
  foreach ($field_name as $key => $var) { 
    $field_size[$key] = intval($field_size[$key]);
    $field_pos[$key] = intval($field_pos[$key]);
    $field_name[$key] = addslashes($field_name[$key]);
    $field_value[$key] = addslashes($field_value[$key]);
    //$result = $db -> sql_query("SELECT '".$field_name[$key]."' FROM ".$user_prefix."_users");
    //$num = $db -> sql_numrows($result);
    $db->sql_query("UPDATE ".$user_prefix."_cnbya_field SET name='$field_name[$key]', value='$field_value[$key]',size='$field_size[$key]',need='$field_need[$key]',pos='$field_pos[$key]', public='$field_public[$key]' WHERE fid='$key'");
  }
}
if (!empty($mfield_name)) {
    $mfield_size = intval($mfield_size);
    $mfield_pos = intval($mfield_pos);
    $mfield_name = addslashes($mfield_name);
    $mfield_value = addslashes($mfield_value);  
    //$result = $db -> sql_query("SELECT '".$mfield_name."' FROM ".$user_prefix."_users");
    //$num = $db -> sql_numrows($result);
    $db->sql_query("INSERT INTO ".$user_prefix."_cnbya_field (name, value, size, need, pos, public) VALUES ('$mfield_name','$mfield_value','$mfield_size','$mfield_need','$mfield_pos','$mfield_public')");
}
    redirect("modules.php?name=$module_name&file=admin&op=addField");
}

?>