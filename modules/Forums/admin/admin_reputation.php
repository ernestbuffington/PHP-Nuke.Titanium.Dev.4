<?php
/***************************************************************************
 *                             admin_reputation.php
 *                            -------------------
 *   begin                : Wednesday, February 03, 2006
 *   copyright            : (C) 2006 Anton Granik
 *   email                : anton@granik.com
 *   web                : http://granik.com
 *
 *   $Id: reputation.php, v.1.0.0 2006/Apr/22 00:29:00 antongranik Exp $
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

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
  $file = basename(__FILE__);
  $titanium_module['Reputation']['Configuration'] = $file;
  return;
}

//
// Let's set the root dir for phpBB
//
$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Pull all config data
//
$sql = "SELECT * FROM " . REPUTATION_CONFIG_TABLE;
if(!$result = $titanium_db->sql_query($sql))
{
  message_die(CRITICAL_ERROR, "Could not query config information in admin_board", "", __LINE__, __FILE__, $sql);
}
else
{
  while( $row = $titanium_db->sql_fetchrow($result) )
  {
    $config_name = $row['config_name'];
    $config_value = $row['config_value'];
    $default_config[$config_name] = isset($HTTP_POST_VARS['submit']) ? str_replace("'", "\'", $config_value) : $config_value;

    $new[$config_name] = ( isset($HTTP_POST_VARS[$config_name]) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];

    if( isset($HTTP_POST_VARS['submit']) )
    {
      $sql = "UPDATE " . REPUTATION_CONFIG_TABLE . " SET
        config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
        WHERE config_name = '$config_name'";
      if( !$titanium_db->sql_query($sql) )
      {
        message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
      }
    }
  }

  if( isset($HTTP_POST_VARS['submit']) )
  {
    $message = $titanium_lang['Rep_config_updated'] . "<br /><br />" . sprintf($titanium_lang['Click_return_rep_config'], "<a href=\"" . append_titanium_sid("admin_reputation.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

    message_die(GENERAL_MESSAGE, $message);
  }
}

$phpbb2_template->set_filenames(array(
  "body" => "admin/reputation_config_body.tpl")
);

$disable_rep_yes = ( $new['rep_disable'] ) ? "checked=\"checked\"" : "";
$disable_rep_no = ( !$new['rep_disable'] ) ? "checked=\"checked\"" : "";

$disable_rep_yes = ( $new['rep_disable'] ) ? "checked=\"checked\"" : "";
$disable_rep_no = ( !$new['rep_disable'] ) ? "checked=\"checked\"" : "";

$graphic_version_yes = ( $new['graphic_version'] ) ? "checked=\"checked\"" : "";
$graphic_version_no = ( !$new['graphic_version'] ) ? "checked=\"checked\"" : "";

$show_stats_to_mods_yes = ( $new['show_stats_to_mods'] ) ? "checked=\"checked\"" : "";
$show_stats_to_mods_no = ( !$new['show_stats_to_mods'] ) ? "checked=\"checked\"" : "";

$pm_notify_yes = ( $new['pm_notify'] ) ? "checked=\"checked\"" : "";
$pm_notify_no = ( !$new['pm_notify'] ) ? "checked=\"checked\"" : "";

$phpbb2_template->assign_vars(array(
  "S_CONFIG_ACTION" => append_titanium_sid("admin_reputation.$phpEx"),
  "S_DISABLE_REP_SYSTEM_YES" => $disable_rep_yes,
  "S_DISABLE_REP_SYSTEM_NO" => $disable_rep_no,
  "S_GRAPHIC_VERSION_YES" => $graphic_version_yes,
  "S_GRAPHIC_VERSION_NO" => $graphic_version_no,
  "S_SHOW_STATS_TO_MODS_YES" => $show_stats_to_mods_yes,
  "S_SHOW_STATS_TO_MODS_NO" => $show_stats_to_mods_no,
  "S_PM_NOTIFY_YES" => $pm_notify_yes,
  "S_PM_NOTIFY_NO" => $pm_notify_no,

  "L_DISABLE_REP_SYSTEM" => $titanium_lang['Disable_rep'],
  "L_POSTS_TO_EARN" => $titanium_lang['Posts_to_earn'],
  "L_DAYS_TO_EARN" => $titanium_lang['Days_to_earn'],
  "L_FLOOD_CONTROL_TIME" => $titanium_lang['Flood_control_time'],
  "L_SHOW_STATS_TO_MODS" => $titanium_lang['Show_stats_to_mods'],
  "L_GRAPHIC_VERSION" => $titanium_lang['Graphic_version'],
  "L_MEDAL1_TO_EARN" => $titanium_lang['Medal1_to_earn'],
  "L_MEDAL2_TO_EARN" => $titanium_lang['Medal2_to_earn'],
  "L_MEDAL3_TO_EARN" => $titanium_lang['Medal3_to_earn'],
  "L_MEDAL4_TO_EARN" => $titanium_lang['Medal4_to_earn'],
  "L_GIVEN_REP_TO_EARN" => $titanium_lang['Given_rep_to_earn'],
  "L_REPSUM_LIMIT" => $titanium_lang['Repsum_limit'],
  "L_PM_NOTIFY" => $titanium_lang['PM_notify'],
  "L_DEFAULT_AMOUNT" => $titanium_lang['Default_amount'],

  "L_YES" => $titanium_lang['Yes'],
  "L_NO" => $titanium_lang['No'],
  "L_REPUTATION_CONFIG_TITLE" => $titanium_lang['Reputation_Config_Title'],
  "L_REPUTATION_CONFIG_EXPLAIN" => $titanium_lang['Reputation_Config_Explain'],
  "L_SUBMIT" => $titanium_lang['Submit'],
  "L_RESET" => $titanium_lang['Reset'],

  "POSTS_TO_EARN" => $new['posts_to_earn'],
  "DAYS_TO_EARN" => $new['days_to_earn'],
  "FLOOD_CONTROL_TIME" => $new['flood_control_time'],
  "MEDAL1_TO_EARN" => $new['medal1_to_earn'],
  "MEDAL2_TO_EARN" => $new['medal2_to_earn'],
  "MEDAL3_TO_EARN" => $new['medal3_to_earn'],
  "MEDAL4_TO_EARN" => $new['medal4_to_earn'],
  "GIVEN_REP_TO_EARN" => $new['given_rep_to_earn'],
  "REPSUM_LIMIT" => $new['repsum_limit'],
  "DEFAULT_AMOUNT" => $new['default_amount'],
));


$phpbb2_template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>