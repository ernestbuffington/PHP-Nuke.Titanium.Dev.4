<?php
/***************************************************************************
*                          admin_firstpost_ad.php
*                            -------------------
*   begin                : (Saturday, Oct 16, 2004)
*   copyright            : (C) (2004) (geocator)
*   email                : (geocator@gmail.com)
*
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
   $filename = basename(__FILE__);
   $titanium_module['ad_managment']['inline_ad_config'] = $filename;

   return;
}

//
// Load default header
//
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

if ( isset($HTTP_POST_VARS['submit']))
{
  //we must put the groups and forums arrays into comma seperated lists
  if(isset($HTTP_POST_VARS['ad_no_groups']) && $HTTP_POST_VARS['ad_no_groups'][0] != 0)
  {
  $ad_no_groups = implode(',', $HTTP_POST_VARS['ad_no_groups']);
  }
  else
  {
    $ad_no_groups = '';
  }
  if(isset($HTTP_POST_VARS['ad_no_forums']) && $HTTP_POST_VARS['ad_no_forums'][0] != 0)
  {
  $ad_no_forums = implode(',', $HTTP_POST_VARS['ad_no_forums']);
  }
  else
  {
    $ad_no_forums = '';
  }

  //This code is modified from admin_board.php
  //Update the Database
  $sql = "SELECT *
  FROM " . CONFIG_TABLE . "
  WHERE config_name LIKE 'ad_%'";
  if(!$result = $titanium_db->sql_query($sql))
  {
    message_die(CRITICAL_ERROR, "Could not query ad config information", "", __LINE__, __FILE__, $sql);
  }
  else
  {
    while( $row = $titanium_db->sql_fetchrow($result) )
    {
      $config_name = $row['config_name'];
      $config_value = $row['config_value'];
      $default_config[$config_name] = isset($HTTP_POST_VARS['submit']) ? str_replace("'", "\'", $config_value) : $config_value;

      if ($config_name == 'ad_no_groups')
      {
        $new[$config_name] = $ad_no_groups;
      }
      elseif ($config_name == 'ad_no_forums')
      {
        $new[$config_name] = $ad_no_forums;
      }
      else
      {
        $new[$config_name] = ( isset($HTTP_POST_VARS[$config_name]) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];
      }

      if( isset($HTTP_POST_VARS['submit']) )
      {
        $sql = "UPDATE " . CONFIG_TABLE . " SET
          config_value = '" . str_replace("\'", "''", htmlspecialchars($new[$config_name])) . "'
          WHERE config_name = '$config_name'";
        if( !$titanium_db->sql_query($sql) )
        {
          message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
        }
      }
    }
    $titanium_cache->delete('board_config', 'config');

    if( isset($HTTP_POST_VARS['submit']) )
    {
      $message = $titanium_lang['Config_updated'] . "<br /><br />" . sprintf($titanium_lang['Click_return_firstpost'], "<a href=\"" . append_titanium_sid("admin_inline_ad.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($titanium_lang['Click_return_admin_index'], "<a href=\"" . append_titanium_sid("index.$phpEx?pane=right") . "\">", "</a>");

      message_die(GENERAL_MESSAGE, $message);
    }
  }

}
else
{
  //Display the page
  $who_all = '';
  $who_reg = '';
  $who_guest = '';
  if ($phpbb2_board_config['ad_who'] == ALL){
    $who_all = 'checked="checked"';
  }elseif ($phpbb2_board_config['ad_who'] == USER){
    $who_reg = 'checked="checked"';
  }else{
    $who_guest = 'checked="checked"';
  }
  $ad_new_style = '';
  $ad_old_style = '';
  if ($phpbb2_board_config['ad_old_style']){
    $ad_old_style = 'checked="checked"';
  }else{
    $ad_new_style = 'checked="checked"';
  }

  //generate group select box
  $ad_no_groups = '<option>' . $titanium_lang['exclude_none'] . '</option>';
  $ad_no_groups_current = explode(",", $phpbb2_board_config['ad_no_groups']);
  $sql = "SELECT group_id, group_name
      FROM " . GROUPS_TABLE . "
      WHERE group_single_user = 0";

  if ( !($result = $titanium_db->sql_query($sql)) )
  {
    message_die(GENERAL_ERROR, 'Could not query group information', '', __LINE__, __FILE__, $sql);
  }

  while( $row = $titanium_db->sql_fetchrow($result) )
  {
    $is_selected = (in_array($row['group_id'],$ad_no_groups_current)) ? 'selected="selected"' : '';
    $ad_no_groups .= '<option value="' . $row['group_id'] . '" ' . $is_selected . '>' . $row['group_name'] . '</option>';
  }
  $titanium_db->sql_freeresult($result);

  //generate forum select box
  $ad_no_forums = '<option>' . $titanium_lang['exclude_none'] . '</option>';
  $ad_no_forums_current = explode(",", $phpbb2_board_config['ad_no_forums']);
  $sql = "SELECT forum_id, forum_name
      FROM " . FORUMS_TABLE;

  if ( !($result = $titanium_db->sql_query($sql)) )
  {
    message_die(GENERAL_ERROR, 'Could not query forum information', '', __LINE__, __FILE__, $sql);
  }

  while( $row = $titanium_db->sql_fetchrow($result) )
  {
    $is_selected = (in_array($row['forum_id'],$ad_no_forums_current)) ? 'selected="selected"' : '';
    $ad_no_forums .= '<option value="' . $row['forum_id'] . '" ' . $is_selected . '>' . $row['forum_name'] . '</option>';
  }
  $titanium_db->sql_freeresult($result);

  $phpbb2_template->set_filenames(array(
  "body" => "admin/inline_ad_config_body.tpl")
  );
  $phpbb2_template->assign_vars(array(
  "AD_AFTER_POST" => $phpbb2_board_config['ad_after_post'],
  "AD_EVERY_POST" => $phpbb2_board_config['ad_every_post'],
  "AD_FORUMS" => $ad_no_forums,
  "AD_NO_GROUPS" => $ad_no_groups,
  "AD_POST_THRESHOLD" => $phpbb2_board_config['ad_post_threshold'],
  "AD_ALL" => $who_all,
  "AD_REG" => $who_reg,
  "AD_GUEST" => $who_guest,
  "AD_OLD_STYLE" => $ad_old_style,
  "AD_NEW_STYLE" => $ad_new_style,
  "L_CONFIGURATION_TITLE" => $titanium_lang['inline_ad_config'],
  "L_AD_AFTER_POST" => $titanium_lang['ad_after_post'],
  "L_AD_EVERY_POST" => $titanium_lang['ad_every_post'],
  "L_AD_DISPLAY" => $titanium_lang['ad_display'],
  "L_AD_ALL" => $titanium_lang['ad_all'],
  "L_AD_REG" => $titanium_lang['ad_reg'],
  "L_AD_GUEST" => $titanium_lang['ad_guest'],
  "L_AD_EXCLUDE" => $titanium_lang['ad_exclude'],
  "L_AD_FORUMS" => $titanium_lang['ad_forums'],
  "S_CONFIG_ACTION" => append_titanium_sid("admin_inline_ad.$phpEx"),
  "L_SUBMIT" => $titanium_lang['Submit'],
  "L_AD_STYLE" => $titanium_lang['ad_style'],
  "L_AD_NEW_STYLE" => $titanium_lang['ad_new_style'],
  "L_AD_OLD_STYLE" => $titanium_lang['ad_old_style'],
  "L_AD_POST_THRESHOLD" => $titanium_lang['ad_post_threshold'],
  "L_RESET" => $titanium_lang['Reset'])
  );
  $phpbb2_template->pparse("body");

  include('./page_footer_admin.'.$phpEx);
}
?>