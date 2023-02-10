<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             admin_groups.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_groups.php,v 1.25.2.9 2004/03/25 15:57:20 acydburn Exp
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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Evolution Functions                      v1.5.0       10/24/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Custom mass PM                           v1.4.7       07/04/2005
      Group Colors and Ranks                   v1.0.0       08/24/2005
      Initial Usergroup                        v1.0.1       08/25/2005
      Auto Group                               v1.2.2       11/06/2006
 ************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if ( !empty($setmodules) )
{
    $filename = basename(__FILE__);
    $module['Groups']['Manage'] = $filename;
    return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
/*****[BEGIN]******************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 ******************************************************/
include('../../../includes/functions_selects.php');
/*****[END]********************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_mass_pm.' . $phpEx);
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
if ( isset($_POST[POST_GROUPS_URL]) || isset($_GET[POST_GROUPS_URL]) )
{
    $group_id = ( isset($_POST[POST_GROUPS_URL]) ) ? intval($_POST[POST_GROUPS_URL]) : intval($_GET[POST_GROUPS_URL]);
}
else
{
    $group_id = 0;
}

if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
    $mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
    $mode = htmlspecialchars($mode);
}
else
{
    $mode = '';
}

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
if(isset($_POST['group_update']))
attachment_quota_settings('group', $_POST['group_update'], $mode);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

if ( isset($_POST['edit']) || isset($_POST['new']) )
{
        //
        // Ok they are editing a group or creating a new group
        //
        $template->set_filenames(array(
                'body' => 'admin/group_edit_body.tpl')
        );

        if ( isset($_POST['edit']) )
        {
                //
                // They're editing. Grab the vars.
                //
                $sql = "SELECT *
                        FROM " . GROUPS_TABLE . "
                        WHERE group_single_user <> " . TRUE . "
                        AND group_id = $group_id";
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
                }

                if ( !($group_info = $db->sql_fetchrow($result)) )
                {
                        message_die(GENERAL_MESSAGE, $lang['Group_not_exist']);
                }
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                 v1.0.1  ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                $initialgroup = $board_config['initial_group_id'];
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
                if ($initialgroup == NULL)
                {
                        message_die(GENERAL_ERROR, 'Error getting initial group information', '', __LINE__, __FILE__, $sql);
                }

                if (intval($initialgroup) == $group_id) {
                   $yesno = 1;
                } else {
                   $yesno = 0;
                }
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

                $mode = 'editgroup';
                $template->assign_block_vars('group_edit', array());

        }
        else if ( isset($_POST['new']) )
        {
                $group_info = array (
                        'group_name' => '',
                        'group_description' => '',
                        'group_moderator' => '',
 /*****[BEGIN]******************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
                        'group_color' => '',
                        'group_rank' => '',
                        'group_count' => '99999999',
                        'group_count_max' => '99999999',
                        'group_count_enable' => '0',
/*****[END]********************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                          'max_inbox' => $board_config['max_inbox_privmsgs'],
                          'max_sentbox' => $board_config['max_sentbox_privmsgs'],
                          'max_savebox' => $board_config['max_savebox_privmsgs'],
                          'override_max_inbox' => '',
                          'override_max_sentbox' => '',
                          'override_max_savebox' => '',
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                        'group_allow_pm' => AUTH_ADMIN,
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                        'group_type' => GROUP_OPEN);
                $group_open = ' checked="checked"';

                $mode = 'newgroup';

        }

        //
        // Ok, now we know everything about them, let's show the page.
        //
     	if ($group_info['group_moderator'] != '')
      	{
     		$sql = "SELECT `user_id`, `username` FROM `".USERS_TABLE."` WHERE `user_id` = '".$group_info['group_moderator']."'";
     		if ( !($result = $db->sql_query($sql)) )
     		{
     			message_die(GENERAL_ERROR, 'Could not obtain user info for moderator list', '', __LINE__, __FILE__, $sql);
     		}
     
     		if ( !($row = $db->sql_fetchrow($result)) )
     		{
     			message_die(GENERAL_ERROR, $group_info['group_moderator'], '', __LINE__, __FILE__, $sql);
     		}
     
     		$group_moderator = $row['username'];
     	}
     	else
     	{
     		$group_moderator = '';
      	}
  
    	$group_open = ( $group_info['group_type'] == GROUP_OPEN ) ? ' checked="checked"' : '';
        $group_closed = ( $group_info['group_type'] == GROUP_CLOSED ) ? ' checked="checked"' : '';
        $group_hidden = ( $group_info['group_type'] == GROUP_HIDDEN ) ? ' checked="checked"' : '';
/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
        $group_count_enable_checked = ( $group_info['group_count_enable'] ) ? ' checked="checked"' : '';
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ] yes is 1 no 0
 ******************************************************/
		 if(!isset($initialgroup_yes))
		 $initialgroup_yes = '';
		 
		 if(!isset($initialgroup_no))
		 $initialgroup_no = '';
         
		 if(!isset($yesno))
		 $yesno = '';
		 
		 $initialgroup_yes = ( $yesno == GROUP_INITIAL_YES ) ? ' checked="checked"' : '';
         $initialgroup_no = ( $yesno == GROUP_INITIAL_NO ) ? ' checked="checked"' : '';
		 
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

 /*****[BEGIN]******************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 ******************************************************/
        $group_color = auc_colors_select($group_info['group_color'], "group_color", "group_id");
        $group_rank = ranks_select($group_info['group_rank'], "group_rank", "rank_id");
/*****[END]********************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 ******************************************************/

 /*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                   v1.0.0 ]
 ******************************************************/
              $max_inbox = $group_info['max_inbox'];
              $max_sentbox = $group_info['max_sentbox'];
              $max_savebox = $group_info['max_savebox'];
              $override_max_inbox = ( $group_info['override_max_inbox'] == 1 ) ? ' checked="checked"' : '';
              $override_max_sentbox = ( $group_info['override_max_sentbox'] == 1 ) ? ' checked="checked"' : '';
              $override_max_savebox = ( $group_info['override_max_savebox'] == 1 ) ? ' checked="checked"' : '';
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        $group_allow_pm_all = ( $group_info['group_allow_pm'] == AUTH_ALL ) ? ' checked="checked"' : '';
        $group_allow_pm_reg = ( $group_info['group_allow_pm'] == AUTH_REG ) ? ' checked="checked"' : '';
        $group_allow_pm_private = ( $group_info['group_allow_pm'] == AUTH_ACL ) ? ' checked="checked"' : '';
        $group_allow_pm_mod = ( $group_info['group_allow_pm'] == AUTH_MOD ) ? ' checked="checked"' : '';
        $group_allow_pm_admin = ( $group_info['group_allow_pm'] == AUTH_ADMIN ) ? ' checked="checked"' : '';
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';

        $template->assign_vars(array(
                'GROUP_NAME' => $group_info['group_name'],
                'GROUP_DESCRIPTION' => $group_info['group_description'],
                'GROUP_MODERATOR' => $group_moderator,
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
                'GROUP_COUNT' => $group_info['group_count'], 
                'GROUP_COUNT_MAX' => $group_info['group_count_max'], 
                'GROUP_COUNT_ENABLE_CHECKED' => $group_count_enable_checked,

                'L_GROUP_COUNT' => $lang['group_count'],
                'L_GROUP_COUNT_MAX' => $lang['group_count_max'],
                'L_GROUP_COUNT_EXPLAIN' => $lang['group_count_explain'],
                'L_GROUP_COUNT_ENABLE' => $lang['Group_count_enable'],
                'L_GROUP_COUNT_UPDATE' => $lang['Group_count_update'],
                'L_GROUP_COUNT_DELETE' => $lang['Group_count_delete'],
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/

 /*****[BEGIN]******************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 ******************************************************/
                'GROUP_COLOR' => $group_color,
                'L_GROUP_COLOR' => $lang['group_color'],
                'GROUP_RANK' => $group_rank,
                'L_GROUP_RANK' => $lang['group_rank'],
/*****[END]********************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 ******************************************************/
                'GROUP_ALLOW_PM' => $group_info['group_allow_pm'],

                'L_GROUP_ALLOW_PM' => $lang['group_allow_pm'],
                'L_GROUP_ALLOW_PM_EXPLAIN' => $lang['group_allow_pm_explain'],
                'L_GROUP_ALL_ALLOW_PM' => ucfirst(strtolower($lang['Forum_ALL'])),
                'L_GROUP_REG_ALLOW_PM' => ucfirst(strtolower($lang['Forum_REG'])),
                'L_GROUP_PRIVATE_ALLOW_PM' => ucfirst(strtolower($lang['Forum_PRIVATE'])),
                'L_GROUP_MOD_ALLOW_PM' => ucfirst(strtolower($lang['Forum_MOD'])),
                'L_GROUP_ADMIN_ALLOW_PM' => ucfirst(strtolower($lang['Forum_ADMIN'])),

                'S_GROUP_ALL_ALLOW_PM_CHECKED' => $group_allow_pm_all,
                'S_GROUP_REG_ALLOW_PM_CHECKED' => $group_allow_pm_reg,
                'S_GROUP_PRIVATE_ALLOW_PM_CHECKED' => $group_allow_pm_private,
                'S_GROUP_MOD_ALLOW_PM_CHECKED' => $group_allow_pm_mod,
                'S_GROUP_ADMIN_ALLOW_PM_CHECKED' => $group_allow_pm_admin,
                'S_GROUP_ALL_ALLOW_PM' => AUTH_ALL,
                'S_GROUP_REG_ALLOW_PM' => AUTH_REG,
                'S_GROUP_PRIVATE_ALLOW_PM' => AUTH_ACL,
                'S_GROUP_MOD_ALLOW_PM' => AUTH_MOD,
                'S_GROUP_ADMIN_ALLOW_PM' => AUTH_ADMIN,
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

                'L_GROUP_TITLE' => $lang['Group_administration'],
                'L_GROUP_EDIT_DELETE' => ( isset($_POST['new']) ) ? $lang['New_group'] : $lang['Edit_group'],
                'L_GROUP_NAME' => $lang['group_name'],
                'L_GROUP_DESCRIPTION' => $lang['group_description'],
                'L_GROUP_MODERATOR' => $lang['group_moderator'],
                'L_FIND_USERNAME' => $lang['Find_username'],
                'L_GROUP_STATUS' => $lang['group_status'],
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                'L_GROUP_INITIAL' => $lang['Initial_user_group'],
                'L_GROUP_INITIAL_EXPLAIN' => $lang['Initial_user_group_explain'],
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                'L_GROUP_OPEN' => $lang['group_open'],
                'L_GROUP_CLOSED' => $lang['group_closed'],
                'L_GROUP_HIDDEN' => $lang['group_hidden'],
                'L_GROUP_DELETE' => $lang['group_delete'],
                'L_GROUP_DELETE_CHECK' => $lang['group_delete_check'],
                'L_SUBMIT' => $lang['Submit'],
                'L_RESET' => $lang['Reset'],
                'L_DELETE_MODERATOR' => $lang['delete_group_moderator'],
                'L_DELETE_MODERATOR_EXPLAIN' => $lang['delete_moderator_explain'],
/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                'L_MAX_INBOX' => $lang['max_inbox'],
                'L_MAX_SENTBOX' => $lang['max_sentbox'],
                'L_MAX_SAVEBOX' => $lang['max_savebox'],
                'MAX_INBOX' => $max_inbox,
                'MAX_SENTBOX' => $max_sentbox,
                'MAX_SAVEBOX' => $max_savebox,
                'L_OVERRIDE_MAX' => $lang['override_max'],
                'OVERRIDE_MAX_INBOX' => $override_max_inbox,
                'OVERRIDE_MAX_SENTBOX' => $override_max_sentbox,
                'OVERRIDE_MAX_SAVEBOX' => $override_max_savebox,
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                'L_YES' => $lang['Yes'],
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                'L_NO' => $lang['No'],
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

                'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser&popup=1&menu=1"),

                'S_GROUP_OPEN_TYPE' => GROUP_OPEN,
                'S_GROUP_CLOSED_TYPE' => GROUP_CLOSED,
                'S_GROUP_HIDDEN_TYPE' => GROUP_HIDDEN,
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                'S_GROUP_INITIAL_YES_TYPE' => GROUP_INITIAL_YES,
                'S_GROUP_INITIAL_NO_TYPE' => GROUP_INITIAL_NO,
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                'S_GROUP_OPEN_CHECKED' => $group_open,
                'S_GROUP_CLOSED_CHECKED' => $group_closed,
                'S_GROUP_HIDDEN_CHECKED' => $group_hidden,
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                'S_GROUP_INITIAL_YES_CHECKED' => $initialgroup_yes,
                'S_GROUP_INITIAL_NO_CHECKED' => $initialgroup_no,
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                'S_GROUP_ACTION' => append_sid("admin_groups.$phpEx"),
                'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );

        $template->pparse('body');

}
else if ( isset($_POST['group_update']) )
{
        //
        // Ok, they are submitting a group, let's save the data based on if it's new or editing
        //
        if ( isset($_POST['group_delete']) )
        {
                //
                // Reset User Moderator Level
                //

                // Is Group moderating a forum ?
                $sql = "SELECT auth_mod FROM " . AUTH_ACCESS_TABLE . "
                        WHERE group_id = " . $group_id;
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not select auth_access', '', __LINE__, __FILE__, $sql);
                }

                $row = $db->sql_fetchrow($result);
                if (intval(isset($row['auth_mod'])) == 1)
                {
                        // Yes, get the assigned users and update their Permission if they are no longer moderator of one of the forums
                        $sql = "SELECT user_id FROM " . USER_GROUP_TABLE . "
                                WHERE group_id = " . $group_id;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not select user_group', '', __LINE__, __FILE__, $sql);
                        }

                        $rows = $db->sql_fetchrowset($result);
                        for ($i = 0; $i < count($rows); $i++)
                        {
                                $sql = "SELECT g.group_id FROM " . AUTH_ACCESS_TABLE . " a, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug
                                WHERE (a.auth_mod = 1) AND (g.group_id = a.group_id) AND (a.group_id = ug.group_id) AND (g.group_id = ug.group_id)
                                        AND (ug.user_id = " . intval($rows[$i]['user_id']) . ") AND (ug.group_id <> " . $group_id . ")";
                                if ( !($result = $db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not obtain moderator permissions', '', __LINE__, __FILE__, $sql);
                                }

                                if ($db->sql_numrows($result) == 0)
                                {
                                        $sql = "UPDATE " . USERS_TABLE . " SET user_level = " . USER . "
                                        WHERE user_level = " . MOD . " AND user_id = " . intval($rows[$i]['user_id']);

                                        if ( !$db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not update moderator permissions', '', __LINE__, __FILE__, $sql);
                                        }
                                }
                        }
                }

                //
                // Delete Group
                //
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                $sql = "SELECT config_value
                        FROM " . CONFIG_TABLE . "
                        WHERE config_name='initial_group_id'";
                $result = $db->sql_query($sql);
                $row = $db->sql_fetchrow($result);
                $initialgroup = $row[0];

                if ($initialgroup == $group_id) {

                    $sql = "UPDATE
                        " . CONFIG_TABLE . "
                        SET config_value = '0'
                        WHERE config_name ='initial_group_id'";
                        $result = $db->sql_query($sql);

                    if ( !$db->sql_query($sql) )
                    {
                            message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
                    }
                }
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

                $sql = "DELETE FROM " . GROUPS_TABLE . "
                        WHERE group_id = " . $group_id;
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                        WHERE group_id = " . $group_id;
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update user_group', '', __LINE__, __FILE__, $sql);
                }

                $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                        WHERE group_id = " . $group_id;
                if ( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, 'Could not update auth_access', '', __LINE__, __FILE__, $sql);
                }

                $message = $lang['Deleted_group'] . '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . append_sid("admin_groups.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

                message_die(GENERAL_MESSAGE, $message);
        }
        else
        {
                $group_type = isset($_POST['group_type']) ? intval($_POST['group_type']) : GROUP_OPEN;
                $group_name = isset($_POST['group_name']) ? htmlspecialchars(trim($_POST['group_name'])) : '';
                $group_description = isset($_POST['group_description']) ? trim($_POST['group_description']) : '';
                $group_moderator = isset($_POST['username']) ? $_POST['username'] : '';
                $delete_old_moderator = isset($_POST['delete_old_moderator']) ? 1 : 0;
/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
                $group_count = isset($_POST['group_count']) ? intval($_POST['group_count']) : 0;
                $group_count_max = isset($_POST['group_count_max']) ? intval($_POST['group_count_max']) : 0;
                $group_count_enable = isset($_POST['group_count_enable']) ? 1 : 0;
                $group_count_update = isset($_POST['group_count_update']) ? 1 : 0;
                $group_count_delete = isset($_POST['group_count_delete']) ? 1 : 0;
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
 /*****[BEGIN]******************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 ******************************************************/
                $group_color = isset($_POST['group_color']) ? intval($_POST['group_color']) : '';
                $group_rank = isset($_POST['group_rank']) ? intval($_POST['group_rank']) : '';
/*****[END]********************************************
 [ Mod:     Group Colors                       v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
		$max_inbox = isset($_POST['max_inbox']) ? intval($_POST['max_inbox']) : '';
		$max_sentbox = isset($_POST['max_sentbox']) ? intval($_POST['max_sentbox']) : '';
		$max_savebox = isset($_POST['max_savebox']) ? intval($_POST['max_savebox']) : '';
                $override_max_inbox = isset($_POST['override_max_inbox']) ? 1 : 0;
                $override_max_sentbox = isset($_POST['override_max_sentbox']) ? 1 : 0;
                $override_max_savebox = isset($_POST['override_max_savebox']) ? 1 : 0;
/*****[END]********************************************
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                $group_allow_pm = isset($_POST['group_allow_pm']) ? intval($_POST['group_allow_pm']) : AUTH_ADMIN;
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/

                if ( $group_name == '' )
                {
                        message_die(GENERAL_MESSAGE, $lang['No_group_name']);
                }
                else if ( $group_moderator == '' )
                {
                        message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
                }

                $this_userdata = get_userdata($group_moderator, true);
                $group_moderator = $this_userdata['user_id'];

                if ( !$group_moderator )
                {
                        message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
                }

                if( $mode == "editgroup" )
                {
                        $sql = "SELECT *
                                FROM " . GROUPS_TABLE . "
                                WHERE group_single_user <> " . TRUE . "
                                AND group_id = " . $group_id;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
                        }

                        if( !($group_info = $db->sql_fetchrow($result)) )
                        {
                                message_die(GENERAL_MESSAGE, $lang['Group_not_exist']);
                        }
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                 v1.0.1 ]
 ******************************************************/
                        if(isset($_POST['initial_group'])) {
                            if($_POST['initial_group'] == 1) {
                                $sql = $sql = "UPDATE
                                " . CONFIG_TABLE . "
                                 SET config_value = '".$group_id."'
                                WHERE config_name ='initial_group_id'";
                                $result = $db->sql_query($sql);

                                if ( !($result = $db->sql_query($sql)) )
                                {
                                    message_die(GENERAL_ERROR, 'Error getting initial group id information', '', __LINE__, __FILE__, $sql);
                                }
                            } else {
                                $sql = "SELECT config_value
                                        FROM " . CONFIG_TABLE . "
                                        WHERE config_name='initial_group_id'";
                                $result = $db->sql_query($sql);
                                $row = $db->sql_fetchrow($result);
                                $initialgroup = $row[0];

                                if ($initialgroup == NULL)
                                {
                                        message_die(GENERAL_ERROR, 'Error getting initial group information', '', __LINE__, __FILE__, $sql);
                                }

                                if (intval($initialgroup) == $group_id) {
                                    $sql = $sql = "UPDATE
                                    " . CONFIG_TABLE . "
                                     SET config_value = '0'
                                    WHERE config_name ='initial_group_id'";
                                    $result = $db->sql_query($sql);

                                    if ( !($result = $db->sql_query($sql)) )
                                    {
                                        message_die(GENERAL_ERROR, 'Error getting initial group id information', '', __LINE__, __FILE__, $sql);
                                    }
                                }
                            }
                        }
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

                        if ( $group_info['group_moderator'] != $group_moderator )
                        {
                                if ( $delete_old_moderator )
                                {
                                        $sql = "DELETE FROM " . USER_GROUP_TABLE . "
                                                WHERE user_id = " . $group_info['group_moderator'] . "
                                                        AND group_id = " . $group_id;
                                        if ( !$db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not update group moderator', '', __LINE__, __FILE__, $sql);
                                        }
                                }

                                $sql = "SELECT user_id
                                        FROM " . USER_GROUP_TABLE . "
                                        WHERE user_id = $group_moderator
                                                AND group_id = $group_id";
                                if ( !($result = $db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, 'Failed to obtain current group moderator info', '', __LINE__, __FILE__, $sql);
                                }

                                if ( !($row = $db->sql_fetchrow($result)) )
                                {
                                        $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                                                VALUES (" . $group_id . ", " . $group_moderator . ", 0)";
                                        if ( !$db->sql_query($sql) )
                                        {
                                                message_die(GENERAL_ERROR, 'Could not update group moderator', '', __LINE__, __FILE__, $sql);
                                        }
                                }
                        }
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                        $sql = "UPDATE " . GROUPS_TABLE . " SET group_type = $group_type, group_name = '" . str_replace("\'", "''", $group_name) . "', group_description = '" . str_replace("\'", "''", $group_description) . "', group_moderator = $group_moderator, group_count='$group_count', group_count_max='$group_count_max', group_count_enable='$group_count_enable', group_allow_pm = '$group_allow_pm', group_rank = '$group_rank', group_color = '$group_color', max_inbox = '$max_inbox', max_sentbox = '$max_sentbox', max_savebox = '$max_savebox', override_max_inbox = '$override_max_inbox', override_max_sentbox = '$override_max_sentbox', override_max_savebox = '$override_max_savebox' WHERE group_id = $group_id";
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
                        }

/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
                    if ($group_count_delete)
        			{
        			    remove_group_attributes('', $group_id);
        				//removing old users
        				$sql = "DELETE FROM " . USER_GROUP_TABLE . "
        					WHERE group_id=$group_id 
        					AND user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
        				if ( !$db->sql_query($sql) )
        				{
        					message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
        				}
        				$group_count_remove=$db->sql_affectedrows();
        			}
        			if ( $group_count_update)
        			{
        				//finding new users
        				$sql = "SELECT u.user_id FROM " . USERS_TABLE . " u
        					LEFT JOIN " . USER_GROUP_TABLE ." ug ON u.user_id=ug.user_id AND ug.group_id='$group_id'
        					WHERE u.user_posts>='$group_count' AND u.user_posts<'$group_count_max'
        					AND ug.group_id is NULL
        					AND u.user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
        				if ( !($result = $db->sql_query($sql)) )
        				{
        					message_die(GENERAL_ERROR, $sql.'Could not select new users, group count', '', __LINE__, __FILE__, $sql);
        				}
        				//inserting new users
        				$group_count_added=0;
        				while ( ($new_members = $db->sql_fetchrow($result)) )
        				{
        					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
        						VALUES ($group_id, " . $new_members['user_id'] . ", 0)";
        					if ( !($result2 = $db->sql_query($sql)) )
        					{
        						message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql);
        					}
        					add_group_attributes($new_members['user_id'], $group_id);
        					$group_count_added++;
        				}
        			}
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
                        if(!isset($group_count_remove))
						$group_count_remove = '';

                        if(!isset($group_count_added))
						$group_count_added = '';
						
                        $message = $lang['Updated_group'] .'<br />'.sprintf($lang['group_count_updated'],$group_count_remove,$group_count_added). '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . append_sid("admin_groups.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');;

                        message_die(GENERAL_MESSAGE, $message);
                }
                else if( $mode == 'newgroup' )
                {
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                        $sql = "INSERT INTO " . GROUPS_TABLE . " (group_type, group_name, group_description, group_moderator, group_count, group_count_max, group_count_enable, group_rank, group_color, group_allow_pm, group_single_user, max_inbox, max_sentbox, max_savebox, override_max_inbox, override_max_sentbox, override_max_savebox)
                                VALUES ($group_type, '" . str_replace("\'", "''", $group_name) . "', '" . str_replace("\'", "''", $group_description) . "', $group_moderator, '$group_count','$group_count_max','$group_count_enable', '$group_rank', '$group_color', '$group_allow_pm', '0', '$max_inbox', '$max_sentbox', '$max_savebox', '$override_max_inbox', '$override_max_sentbox', '$override_max_savebox')";
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 [ Mod:     Enhanced BBGroups                  v1.0.0 ]
 ******************************************************/
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not insert new group', '', __LINE__, __FILE__, $sql);
                        }
                        $new_group_id = $db->sql_nextid();

                        $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                                VALUES ($new_group_id, $group_moderator, 0)";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not insert new user-group info', '', __LINE__, __FILE__, $sql);
                        }
/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
                		if ($group_count_delete)
                			{
                				//removing old users
                				$sql = "DELETE FROM " . USER_GROUP_TABLE . "
                					WHERE group_id=$new_group_id 
                					AND user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
                				if ( !$db->sql_query($sql) )
                				{
                					message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
                				}
                				$group_count_remove=$db->sql_affectedrows();
                			}
                			if ( $group_count_update)
                			{
                				//finding new users
                				$sql = "SELECT u.user_id FROM " . USERS_TABLE . " u
                					LEFT JOIN " . USER_GROUP_TABLE ." ug ON u.user_id=ug.user_id AND ug.group_id='$new_group_id'
                					WHERE u.user_posts>='$group_count' AND u.user_posts<'$group_count_max'
                					AND ug.group_id is NULL
                					AND u.user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
                				if ( !($result = $db->sql_query($sql)) )
                				{
                					message_die(GENERAL_ERROR, $sql.'Could not select new users, group count', '', __LINE__, __FILE__, $sql);
                				}
                				//inserting new users
                				$group_count_added=0;
                				while ( ($new_members = $db->sql_fetchrow($result)) )
                				{
                					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
                						VALUES ($new_group_id, " . $new_members['user_id'] . ", 0)";
                					if ( !($result2 = $db->sql_query($sql)) )
                					{
                						message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql);
                					}
                					$group_count_added++;
                				}
                			}
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/
                        if(isset($_POST['initial_group'])) {
                            if($_POST['initial_group'] == 1) {

                            $sql = $sql = "UPDATE
                            " . CONFIG_TABLE . "
                            SET config_value = '$new_group_id'
                            WHERE config_name ='initial_group_id'";
                            $result = $db->sql_query($sql);

                            if ( !$db->sql_query($sql) )
                            {
                                    message_die(GENERAL_ERROR, 'Could not insert new user-group info', '', __LINE__, __FILE__, $sql);
                            }
                            }
                        }
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 ******************************************************/

                        $message = $lang['Added_new_group'] .'<br />'.sprintf($lang['group_count_updated'],$group_count_remove = $group_count_remove ?? '',$group_count_added = $group_count_added ?? ''). '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . append_sid("admin_groups.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');;

                        message_die(GENERAL_MESSAGE, $message);

                }
                else
                {
                        message_die(GENERAL_MESSAGE, $lang['No_group_action']);
                }
        }
}
else
{
        $sql = "SELECT group_id, group_name
                FROM " . GROUPS_TABLE . "
                WHERE group_single_user <> " . TRUE . "
                ORDER BY group_name";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not obtain group list', '', __LINE__, __FILE__, $sql);
        }

        $select_list = '';
        if ( $row = $db->sql_fetchrow($result) )
        {
                $select_list .= '<select name="' . POST_GROUPS_URL . '">';
                do
                {
                        $select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
                }
                while ( $row = $db->sql_fetchrow($result) );
                $select_list .= '</select>';
        }

        $template->set_filenames(array(
                'body' => 'admin/group_select_body.tpl')
        );

        $template->assign_vars(array(
                'L_GROUP_TITLE' => $lang['Group_administration'],
                'L_GROUP_EXPLAIN' => $lang['Group_admin_explain'],
                'L_GROUP_SELECT' => $lang['Select_group'],
                'L_LOOK_UP' => $lang['Look_up_group'],
                'L_CREATE_NEW_GROUP' => $lang['New_group'],

                'S_GROUP_ACTION' => append_sid("admin_groups.$phpEx"),
                'S_GROUP_SELECT' => $select_list)
        );

        if ( $select_list != '' )
        {
                $template->assign_block_vars('select_box', array());
        }

        $template->pparse('body');
}

include('./page_footer_admin.'.$phpEx);

?>