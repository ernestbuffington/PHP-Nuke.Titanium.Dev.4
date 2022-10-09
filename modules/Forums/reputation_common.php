<?php
/***************************************************************************
 *                 reputation_common.php
 *                            -------------------
 *   begin                : Wednesday, February 03, 2006
 *   copyright            : (C) 2006 Anton Granik
 *   email                : anton@granik.com
 *   web                : http://granik.com
 *
 *   $Id: reputation.php, v.1.0.0 2006/Apr/22 00:30:00 antongranik Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
  die('Hacking attempt');
}

$sql = "SELECT * FROM ". REPUTATION_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
  message_die(GENERAL_ERROR, "Could not query reputation config information", "", __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
  $rep_config_name = $row['config_name'];
  $rep_config_value = $row['config_value'];
  $rep_config[$rep_config_name] = $rep_config_value;
}
?>