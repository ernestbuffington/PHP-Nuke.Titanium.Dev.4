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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
   $filename = basename(__FILE__);
   $module['ad_managment']['inline_ad_config'] = $filename;

   return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
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
  if(!$result = $db->sql_query($sql))
  {
    message_die(CRITICAL_ERROR, "Could not query ad config information", "", __LINE__, __FILE__, $sql);
  }
  else
  {
    while( $row = $db->sql_fetchrow($result) )
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
        if( !$db->sql_query($sql) )
        {
          message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
        }
      }
    }
    $cache->delete('board_config', 'config');

    if( isset($HTTP_POST_VARS['submit']) )
    {
      $message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_firstpost'], "<a href=\"" . append_sid("admin_inline_ad.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

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
  if ($board_config['ad_who'] == ALL){
    $who_all = 'checked="checked"';
  }elseif ($board_config['ad_who'] == USER){
    $who_reg = 'checked="checked"';
  }else{
    $who_guest = 'checked="checked"';
  }
  $ad_new_style = '';
  $ad_old_style = '';
  if ($board_config['ad_old_style']){
    $ad_old_style = 'checked="checked"';
  }else{
    $ad_new_style = 'checked="checked"';
  }

  //generate group select box
  $ad_no_groups = '<option>' . $lang['exclude_none'] . '</option>';
  $ad_no_groups_current = explode(",", $board_config['ad_no_groups']);
  $sql = "SELECT group_id, group_name
      FROM " . GROUPS_TABLE . "
      WHERE group_single_user = 0";

  if ( !($result = $db->sql_query($sql)) )
  {
    message_die(GENERAL_ERROR, 'Could not query group information', '', __LINE__, __FILE__, $sql);
  }

  while( $row = $db->sql_fetchrow($result) )
  {
    $is_selected = (in_array($row['group_id'],$ad_no_groups_current)) ? 'selected="selected"' : '';
    $ad_no_groups .= '<option value="' . $row['group_id'] . '" ' . $is_selected . '>' . $row['group_name'] . '</option>';
  }
  $db->sql_freeresult($result);

  //generate forum select box
  $ad_no_forums = '<option>' . $lang['exclude_none'] . '</option>';
  $ad_no_forums_current = explode(",", $board_config['ad_no_forums']);
  $sql = "SELECT forum_id, forum_name
      FROM " . FORUMS_TABLE;

  if ( !($result = $db->sql_query($sql)) )
  {
    message_die(GENERAL_ERROR, 'Could not query forum information', '', __LINE__, __FILE__, $sql);
  }

  while( $row = $db->sql_fetchrow($result) )
  {
    $is_selected = (in_array($row['forum_id'],$ad_no_forums_current)) ? 'selected="selected"' : '';
    $ad_no_forums .= '<option value="' . $row['forum_id'] . '" ' . $is_selected . '>' . $row['forum_name'] . '</option>';
  }
  $db->sql_freeresult($result);

  $template->set_filenames(array(
  "body" => "admin/inline_ad_config_body.tpl")
  );
  $template->assign_vars(array(
  "AD_AFTER_POST" => $board_config['ad_after_post'],
  "AD_EVERY_POST" => $board_config['ad_every_post'],
  "AD_FORUMS" => $ad_no_forums,
  "AD_NO_GROUPS" => $ad_no_groups,
  "AD_POST_THRESHOLD" => $board_config['ad_post_threshold'],
  "AD_ALL" => $who_all,
  "AD_REG" => $who_reg,
  "AD_GUEST" => $who_guest,
  "AD_OLD_STYLE" => $ad_old_style,
  "AD_NEW_STYLE" => $ad_new_style,
  "L_CONFIGURATION_TITLE" => $lang['inline_ad_config'],
  "L_AD_AFTER_POST" => $lang['ad_after_post'],
  "L_AD_EVERY_POST" => $lang['ad_every_post'],
  "L_AD_DISPLAY" => $lang['ad_display'],
  "L_AD_ALL" => $lang['ad_all'],
  "L_AD_REG" => $lang['ad_reg'],
  "L_AD_GUEST" => $lang['ad_guest'],
  "L_AD_EXCLUDE" => $lang['ad_exclude'],
  "L_AD_FORUMS" => $lang['ad_forums'],
  "S_CONFIG_ACTION" => append_sid("admin_inline_ad.$phpEx"),
  "L_SUBMIT" => $lang['Submit'],
  "L_AD_STYLE" => $lang['ad_style'],
  "L_AD_NEW_STYLE" => $lang['ad_new_style'],
  "L_AD_OLD_STYLE" => $lang['ad_old_style'],
  "L_AD_POST_THRESHOLD" => $lang['ad_post_threshold'],
  "L_RESET" => $lang['Reset'])
  );
  $template->pparse("body");

  include('./page_footer_admin.'.$phpEx);
}
?>