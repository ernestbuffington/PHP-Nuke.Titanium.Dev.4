<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            admin_ug_auth.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_ug_auth.php,v 1.13.2.9 2005/07/19 20:01:05 acydburn Exp
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
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Global Announcements                     v1.2.8       06/13/2005
      Advanced Username Color                  v1.0.5       06/13/2005
      Group Colors                             v1.0.0       10/20/2005
************************************************************************/

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $titanium_module['Users']['Permissions'] = $filename . "?mode=user";
        $titanium_module['Groups']['Permissions'] = $filename . "?mode=group";

        return;
}

//
// Load default header
//
$no_page_header = TRUE;

$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

$params = array('mode' => 'mode', 'user_id' => POST_USERS_URL, 'group_id' => POST_GROUPS_URL, 'adv' => 'adv');

while( list($var, $param) = @each($params) )
{
        if ( !empty($_POST[$param]) || !empty($_GET[$param]) )
        {
                $$var = ( !empty($_POST[$param]) ) ? $_POST[$param] : $_GET[$param];
        }
        else
        {
                $$var = "";
        }
}

$titanium_user_id = intval($titanium_user_id);
$group_id = intval($group_id);
$adv = intval($adv);
$mode = htmlspecialchars($mode);

//
// Start program - define vars
//
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$forum_auth_fields = array('auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_vote', 'auth_pollcreate', 'auth_globalannounce');
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

$auth_field_match = array(
        'auth_view' => AUTH_VIEW,
        'auth_read' => AUTH_READ,
        'auth_post' => AUTH_POST,
        'auth_reply' => AUTH_REPLY,
        'auth_edit' => AUTH_EDIT,
        'auth_delete' => AUTH_DELETE,
        'auth_sticky' => AUTH_STICKY,
        'auth_announce' => AUTH_ANNOUNCE,
        'auth_vote' => AUTH_VOTE,
        'auth_pollcreate' => AUTH_POLLCREATE,
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
        'auth_globalannounce' => AUTH_GLOBALANNOUNCE);
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

$field_names = array(
        'auth_view' => $titanium_lang['View'],
        'auth_read' => $titanium_lang['Read'],
        'auth_post' => $titanium_lang['Post'],
        /*--FNA--*/
        'auth_reply' => $titanium_lang['Reply'],
        'auth_edit' => $titanium_lang['Edit'],
        'auth_delete' => $titanium_lang['Delete'],
        'auth_sticky' => $titanium_lang['Sticky'],
        'auth_announce' => $titanium_lang['Announce'],
        'auth_vote' => $titanium_lang['Vote'],
        'auth_pollcreate' => $titanium_lang['Pollcreate'],
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
        'auth_globalannounce' => $titanium_lang['Globalannounce']);
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
attach_setup_usergroup_auth($forum_auth_fields, $auth_field_match, $field_names);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

// ---------------
// Start Functions
//
function check_auth($type, $key, $u_access, $is_admin)
{
        $auth_user = 0;

        if( count($u_access) )
        {
                for($j = 0; $j < count($u_access); $j++)
                {
                        $result = 0;
                        switch($type)
                        {
                                case AUTH_ACL:
                                        $result = $u_access[$j][$key];

                                case AUTH_MOD:
                                        $result = $result || $u_access[$j]['auth_mod'];

                                case AUTH_ADMIN:
                                        $result = $result || $is_admin;
                                        break;
                        }

                        $auth_user = $auth_user || $result;
                }
        }
        else
        {
                $auth_user = $is_admin;
        }

        return $auth_user;
}
//
// End Functions
// -------------

if ( isset($_POST['submit']) && ( ( $mode == 'user' && $titanium_user_id ) || ( $mode == 'group' && $group_id ) ) )
{
        $titanium_user_level = '';
        if ( $mode == 'user' )
        {
                //
                // Get group_id for this user_id
                //
                $sql = "SELECT g.group_id, u.user_level
                        FROM " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u, " . GROUPS_TABLE . " g
                        WHERE u.user_id = '$titanium_user_id'
                                AND ug.user_id = u.user_id
                                AND g.group_id = ug.group_id
                                AND g.group_single_user = " . TRUE;
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, 'Could not select info from user/user_group table', '', __LINE__, __FILE__, $sql);
                }

                $row = $titanium_db->sql_fetchrow($result);

                $group_id = intval($row['group_id']);
                $titanium_user_level = intval($row['user_level']);

                $titanium_db->sql_freeresult($result);
        }

        //
        // Carry out requests
        //
        if ( $mode == 'user' && $_POST['userlevel'] == 'admin' && $titanium_user_level != ADMIN )
        {
                //
                // Make user an admin (if already user)
                //
            if ( $userdata['user_id'] != $titanium_user_id )

                {
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . ADMIN . "
                                WHERE user_id = '$titanium_user_id'";
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                        }

                        $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                                WHERE group_id = '$group_id'
                                        AND auth_mod = '0'";
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't delete auth access info", "", __LINE__, __FILE__, $sql);
                        }

                        //
                        // Delete any entries in auth_access, they are not required if user is becoming an
                        // admin
                        //
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
                        $sql = "UPDATE " . AUTH_ACCESS_TABLE . "
                                SET auth_view = '0', auth_read = '0', auth_post = '0', auth_reply = '0', auth_edit = '0', auth_delete = '0', auth_sticky = '0', auth_announce = '0', auth_globalannounce = 0
                                WHERE group_id = '$group_id'";
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't update auth access", "", __LINE__, __FILE__, $sql);
                        }
                }

                $message = $titanium_lang['Auth_updated'] . '<br /><br />' . sprintf($titanium_lang['Click_return_userauth'], '<a href="' . append_titanium_sid("admin_ug_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($titanium_lang['Click_return_admin_index'], '<a href="' . append_titanium_sid("index.$phpEx?pane=right") . '">', '</a>');
                message_die(GENERAL_MESSAGE, $message);
        }
        else
        {
                if ( $mode == 'user' && $_POST['userlevel'] == 'user' && $titanium_user_level == ADMIN )
                {
                        //
                        // Make admin a user (if already admin) ... ignore if you're trying
                        // to change yourself from an admin to user!
                        //
                        if ( $userdata['user_id'] != $titanium_user_id )
                        {
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
                                $sql = "UPDATE " . AUTH_ACCESS_TABLE . "
                                        SET auth_view = '0', auth_read = '0', auth_post = '0', auth_reply = '0', auth_edit = '0', auth_delete = '0', auth_sticky = '0', auth_announce = '0', auth_globalannounce = 0
                                        WHERE group_id = '$group_id'";
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
                                if ( !($result = $titanium_db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not update auth access', '', __LINE__, __FILE__, $sql);
                                }

                                //
                                // Update users level, reset to USER
                                //
                                $sql = "UPDATE " . USERS_TABLE . "
                                        SET user_level = " . USER . "
                                        WHERE user_id = '$titanium_user_id'";
                                if ( !($result = $titanium_db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                                }
                        }

                        $message = $titanium_lang['Auth_updated'] . '<br /><br />' . sprintf($titanium_lang['Click_return_userauth'], '<a href="' . append_titanium_sid("admin_ug_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($titanium_lang['Click_return_admin_index'], '<a href="' . append_titanium_sid("index.$phpEx?pane=right") . '">', '</a>');
                }
                else
                {

                        $change_mod_list = ( isset($_POST['moderator']) ) ? $_POST['moderator'] : array();

            			if ( empty($adv) )
            			{
            				$sql = "SELECT f.*
            					FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
            					WHERE f.cat_id = c.cat_id
            					ORDER BY c.cat_order, f.forum_order ASC";
            				if ( !($result = $titanium_db->sql_query($sql)) )
            				{
            					message_die(GENERAL_ERROR, "Couldn't obtain forum information", "", __LINE__, __FILE__, $sql);
            				}

            				$forum_access = $forum_auth_level_fields = array();
            				while( $row = $titanium_db->sql_fetchrow($result) )
            				{
            					$forum_access[] = $row;
            				}
            				$titanium_db->sql_freeresult($result);

            				for($i = 0; $i < count($forum_access); $i++)
            				{
            					$phpbb2_forum_id = $forum_access[$i]['forum_id'];

            					for($j = 0; $j < count($forum_auth_fields); $j++)
            					{
            						$forum_auth_level_fields[$phpbb2_forum_id][$forum_auth_fields[$j]] = $forum_access[$i][$forum_auth_fields[$j]] == AUTH_ACL;
            					}
            				}

            				while( list($phpbb2_forum_id, $value) = @each($_POST['private']) )
            				{
            					while( list($auth_field, $exists) = @each($forum_auth_level_fields[$phpbb2_forum_id]) )
            					{
            						if ($exists)
            						{
            							$change_acl_list[$phpbb2_forum_id][$auth_field] = $value;
            						}
            					}
            				}
                        }
                        else
                        {
                                $change_acl_list = array();
                                for($j = 0; $j < count($forum_auth_fields); $j++)
                                {
                                        $auth_field = $forum_auth_fields[$j];

                                        while( list($phpbb2_forum_id, $value) = @each($_POST['private_' . $auth_field]) )
                                        {
                                                $change_acl_list[$phpbb2_forum_id][$auth_field] = $value;
                                        }
                                }
                        }

            $sql = 'SELECT f.*
                FROM ' . FORUMS_TABLE . ' f, ' . CATEGORIES_TABLE . ' c
                WHERE f.cat_id = c.cat_id
                ORDER BY c.cat_order, f.forum_order';

                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't obtain forum information", "", __LINE__, __FILE__, $sql);
                        }

                        $forum_access = array();
                        while( $row = $titanium_db->sql_fetchrow($result) )
                        {
                                $forum_access[] = $row;
                        }
                        $titanium_db->sql_freeresult($result);

                        $sql = ( $mode == 'user' ) ? "SELECT aa.* FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g WHERE ug.user_id = $titanium_user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = " . TRUE : "SELECT * FROM " . AUTH_ACCESS_TABLE . " WHERE group_id = '$group_id'";
                        if ( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
                        }

                        $auth_access = array();
                        while( $row = $titanium_db->sql_fetchrow($result) )
                        {
                                $auth_access[$row['forum_id']] = $row;
                        }
                        $titanium_db->sql_freeresult($result);

                        $forum_auth_action = array();
                        $update_acl_status = array();
                        $update_mod_status = array();

                        for($i = 0; $i < count($forum_access); $i++)
                        {
                                $phpbb2_forum_id = $forum_access[$i]['forum_id'];

                                if (
                                        ( isset($auth_access[$phpbb2_forum_id]['auth_mod']) && $change_mod_list[$phpbb2_forum_id] != $auth_access[$phpbb2_forum_id]['auth_mod'] ) ||
                    					( !isset($auth_access[$phpbb2_forum_id]['auth_mod']) && !empty($change_mod_list[$phpbb2_forum_id]) )
                    				)
                    				{
                    					$update_mod_status[$phpbb2_forum_id] = $change_mod_list[$phpbb2_forum_id];

                                        if ( !$update_mod_status[$phpbb2_forum_id] )
                                        {
                                                $forum_auth_action[$phpbb2_forum_id] = 'delete';
                                        }
                                        else if ( !isset($auth_access[$phpbb2_forum_id]['auth_mod']) )
                                        {
                                                $forum_auth_action[$phpbb2_forum_id] = 'insert';
                                        }
                                        else
                                        {
                                                $forum_auth_action[$phpbb2_forum_id] = 'update';
                                        }
                                }

                                for($j = 0; $j < count($forum_auth_fields); $j++)
                                {
                                        $auth_field = $forum_auth_fields[$j];

                                        if( $forum_access[$i][$auth_field] == AUTH_ACL && isset($change_acl_list[$phpbb2_forum_id][$auth_field]) )
                                        {
                                                if ( ( empty($auth_access[$phpbb2_forum_id]['auth_mod']) &&
                                                        ( isset($auth_access[$phpbb2_forum_id][$auth_field]) && $change_acl_list[$phpbb2_forum_id][$auth_field] != $auth_access[$phpbb2_forum_id][$auth_field] ) ||
                                                        ( !isset($auth_access[$phpbb2_forum_id][$auth_field]) && !empty($change_acl_list[$phpbb2_forum_id][$auth_field]) ) ) ||
                                                        !empty($update_mod_status[$phpbb2_forum_id])
                                                )
                                                {
                                                        $update_acl_status[$phpbb2_forum_id][$auth_field] = ( !empty($update_mod_status[$phpbb2_forum_id]) ) ? 0 :  $change_acl_list[$phpbb2_forum_id][$auth_field];

                                                        if ( isset($auth_access[$phpbb2_forum_id][$auth_field]) && empty($update_acl_status[$phpbb2_forum_id][$auth_field]) && $forum_auth_action[$phpbb2_forum_id] != 'insert' && $forum_auth_action[$phpbb2_forum_id] != 'update' )
                                                        {
                                                                $forum_auth_action[$phpbb2_forum_id] = 'delete';
                                                        }
                                                        else if ( !isset($auth_access[$phpbb2_forum_id][$auth_field]) && !( $forum_auth_action[$phpbb2_forum_id] == 'delete' && empty($update_acl_status[$phpbb2_forum_id][$auth_field]) ) )
                                                        {
                                                                $forum_auth_action[$phpbb2_forum_id] = 'insert';
                                                        }
                                                        else if ( isset($auth_access[$phpbb2_forum_id][$auth_field]) && !empty($update_acl_status[$phpbb2_forum_id][$auth_field]) )
                                                        {
                                                                $forum_auth_action[$phpbb2_forum_id] = 'update';
                                                        }
                                                }
                                                else if ( ( empty($auth_access[$phpbb2_forum_id]['auth_mod']) &&
                                                        ( isset($auth_access[$phpbb2_forum_id][$auth_field]) && $change_acl_list[$phpbb2_forum_id][$auth_field] == $auth_access[$phpbb2_forum_id][$auth_field] ) ) && $forum_auth_action[$phpbb2_forum_id] == 'delete' )
                                                {
                                                        $forum_auth_action[$phpbb2_forum_id] = 'update';
                                                }
                                        }
                                }
                        }

                        //
                        // Checks complete, make updates to DB
                        //
                        $delete_sql = '';
                        while( list($phpbb2_forum_id, $action) = @each($forum_auth_action) )
                        {
                                if ( $action == 'delete' )
                                {
                                        $delete_sql .= ( ( $delete_sql != '' ) ? ', ' : '' ) . $phpbb2_forum_id;
                                }
                                else
                                {
                                        if ( $action == 'insert' )
                                        {
                                                $sql_field = '';
                                                $sql_value = '';
                                                while ( list($auth_type, $value) = @each($update_acl_status[$phpbb2_forum_id]) )
                                                {
                                                        $sql_field .= ( ( $sql_field != '' ) ? ', ' : '' ) . $auth_type;
                                                        $sql_value .= ( ( $sql_value != '' ) ? ', ' : '' ) . $value;
                                                }
                                                $sql_field .= ( ( $sql_field != '' ) ? ', ' : '' ) . 'auth_mod';
                                                $sql_value .= ( ( $sql_value != '' ) ? ', ' : '' ) . ( ( !isset($update_mod_status[$phpbb2_forum_id]) ) ? 0 : $update_mod_status[$phpbb2_forum_id]);

                                                $sql = "INSERT INTO " . AUTH_ACCESS_TABLE . " (forum_id, group_id, $sql_field)
                                                        VALUES ($phpbb2_forum_id, $group_id, $sql_value)";
                                        }
                                        else
                                        {
                                                $sql_values = '';
                                                while ( list($auth_type, $value) = @each($update_acl_status[$phpbb2_forum_id]) )
                                                {
                                                        $sql_values .= ( ( $sql_values != '' ) ? ', ' : '' ) . $auth_type . ' = ' . $value;
                                                }
                                                $sql_values .= ( ( $sql_values != '' ) ? ', ' : '' ) . 'auth_mod = ' . ( ( !isset($update_mod_status[$phpbb2_forum_id]) ) ? 0 : $update_mod_status[$phpbb2_forum_id]);

                                                $sql = "UPDATE " . AUTH_ACCESS_TABLE . "
                                                        SET $sql_values
                                                        WHERE group_id = '$group_id'
                                                                AND forum_id = '$phpbb2_forum_id'";
                                        }
                                        if( !($result = $titanium_db->sql_query($sql)) )
                                        {
                                                message_die(GENERAL_ERROR, "Couldn't update private forum permissions", "", __LINE__, __FILE__, $sql);
                                        }
                                }
                        }

                        if ( $delete_sql != '' )
                        {
                                $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                                        WHERE group_id = '$group_id'
                                                AND forum_id IN ($delete_sql)";
                                if( !($result = $titanium_db->sql_query($sql)) )
                                {
                                        message_die(GENERAL_ERROR, "Couldn't delete permission entries", "", __LINE__, __FILE__, $sql);
                                }
                        }

                        $l_auth_return = ( $mode == 'user' ) ? $titanium_lang['Click_return_userauth'] : $titanium_lang['Click_return_groupauth'];
                        $message = $titanium_lang['Auth_updated'] . '<br /><br />' . sprintf($l_auth_return, '<a href="' . append_titanium_sid("admin_ug_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($titanium_lang['Click_return_admin_index'], '<a href="' . append_titanium_sid("index.$phpEx?pane=right") . '">', '</a>');
                }

                //
                // Update user level to mod for appropriate users
                //
                $sql = "SELECT u.user_id
                        FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u
                        WHERE ug.group_id = aa.group_id
                                AND u.user_id = ug.user_id
                                AND ug.user_pending = 0
                                AND u.user_level NOT IN (" . MOD . ", " . ADMIN . ")
                        GROUP BY u.user_id
                        HAVING SUM(aa.auth_mod) > 0";
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
                }

                $set_mod = '';
                while( $row = $titanium_db->sql_fetchrow($result) )
                {
                        $set_mod .= ( ( $set_mod != '' ) ? ', ' : '' ) . $row['user_id'];
                }
                $titanium_db->sql_freeresult($result);

                //
                // Update user level to user for appropriate users
                //
                switch ( SQL_LAYER )
                {
                        case 'postgresql':
                                $sql = "SELECT u.user_id
                                        FROM " . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug, " . AUTH_ACCESS_TABLE . " aa
                                        WHERE ug.user_id = u.user_id
                                                AND aa.group_id = ug.group_id
                                                AND u.user_level NOT IN (" . USER . ", " . ADMIN . ")
                                        GROUP BY u.user_id
                                        HAVING SUM(aa.auth_mod) = 0
                                        UNION (
                                                SELECT u.user_id
                                                FROM " . USERS_TABLE . " u
                                                WHERE NOT EXISTS (
                                                        SELECT aa.auth_mod
                                                        FROM " . USER_GROUP_TABLE . " ug, " . AUTH_ACCESS_TABLE . " aa
                                                        WHERE ug.user_id = u.user_id
                                                                AND aa.group_id = ug.group_id
                                                )
                                                AND u.user_level NOT IN (" . USER . ", " . ADMIN . ")
                                                GROUP BY u.user_id
                                        )";
                                break;
                        case 'oracle':
                                $sql = "SELECT u.user_id
                                        FROM " . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug, " . AUTH_ACCESS_TABLE . " aa
                                        WHERE ug.user_id = u.user_id(+)
                                                AND aa.group_id = ug.group_id(+)
                                                AND u.user_level NOT IN (" . USER . ", " . ADMIN . ")
                                        GROUP BY u.user_id
                                        HAVING SUM(aa.auth_mod) = 0";
                                break;
                        default:
                                $sql = "SELECT u.user_id
                                        FROM ( ( " . USERS_TABLE . " u
                                        LEFT JOIN " . USER_GROUP_TABLE . " ug ON ug.user_id = u.user_id )
                                        LEFT JOIN " . AUTH_ACCESS_TABLE . " aa ON aa.group_id = ug.group_id )
                                        WHERE u.user_level NOT IN (" . USER . ", " . ADMIN . ")
                                        GROUP BY u.user_id
                                        HAVING SUM(aa.auth_mod) = 0";
                                break;
                }
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
                }

                $unset_mod = "";
                while( $row = $titanium_db->sql_fetchrow($result) )
                {
                        $unset_mod .= ( ( $unset_mod != '' ) ? ', ' : '' ) . $row['user_id'];
                }
                $titanium_db->sql_freeresult($result);

                if ( $set_mod != '' )
                {
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . MOD . "
                                WHERE user_id IN ($set_mod)";
                        if( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't update user level", "", __LINE__, __FILE__, $sql);
                        }
                }

                if ( $unset_mod != '' )
                {
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . USER . "
                                WHERE user_id IN ($unset_mod)";
                        if( !($result = $titanium_db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't update user level", "", __LINE__, __FILE__, $sql);
                        }
                }
                
        $sql = 'SELECT user_id FROM ' . USER_GROUP_TABLE . "
            WHERE group_id = $group_id";
        $result = $titanium_db->sql_query($sql);

        $group_user = array();
        while ($row = $titanium_db->sql_fetchrow($result))
        {
            $group_user[$row['user_id']] = $row['user_id'];
        }
        $titanium_db->sql_freeresult($result);

        $sql = "SELECT ug.user_id, COUNT(auth_mod) AS is_auth_mod
            FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug
            WHERE ug.user_id IN (" . implode(', ', $group_user) . ")
                AND aa.group_id = ug.group_id
                AND aa.auth_mod = 1
            GROUP BY ug.user_id";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Please add someone to this group, we could not obtain moderator status', '', __LINE__, __FILE__, $sql);
        }

        while ($row = $titanium_db->sql_fetchrow($result))
        {
            if ($row['is_auth_mod'])
            {
                unset($group_user[$row['user_id']]);
            }
        }
        $titanium_db->sql_freeresult($result);

        if (count($group_user))
        {
/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
            $sql = "UPDATE " . USERS_TABLE . "
                SET user_level = " . USER . "
                WHERE user_id IN (" . implode(', ', $group_user) . ") AND user_level = " . MOD;
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
            if ( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
            }
        }

                message_die(GENERAL_MESSAGE, $message);
                $cache->delete('forum_moderators', 'config');
        }
}
else if ( ( $mode == 'user' && ( isset($_POST['username']) || $titanium_user_id ) ) || ( $mode == 'group' && $group_id ) )
{
        if ( isset($_POST['username']) )
        {
                $this_userdata = get_userdata($_POST['username'], true);
                if ( !is_array($this_userdata) )
                {
                        message_die(GENERAL_MESSAGE, $titanium_lang['No_such_user']);
                }
                $titanium_user_id = $this_userdata['user_id'];
        }

        //
        // Front end
        //
        $sql = "SELECT f.*
                FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
                WHERE f.cat_id = c.cat_id
                ORDER BY c.cat_order, f.forum_order ASC";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Couldn't obtain forum information", "", __LINE__, __FILE__, $sql);
        }

        $forum_access = array();
        while( $row = $titanium_db->sql_fetchrow($result) )
        {
                $forum_access[] = $row;
        }
        $titanium_db->sql_freeresult($result);

        if( empty($adv) )
        {
                for($i = 0; $i < count($forum_access); $i++)
                {
                        $phpbb2_forum_id = $forum_access[$i]['forum_id'];

                        $forum_auth_level[$phpbb2_forum_id] = AUTH_ALL;

                        for($j = 0; $j < count($forum_auth_fields); $j++)
                        {
                                $forum_access[$i][$forum_auth_fields[$j]] . ' :: ';
                                if ( $forum_access[$i][$forum_auth_fields[$j]] == AUTH_ACL )
                                {
                                        $forum_auth_level[$phpbb2_forum_id] = AUTH_ACL;
                                        $forum_auth_level_fields[$phpbb2_forum_id][] = $forum_auth_fields[$j];
                                }
                        }
                }
        }

//
// Check if a private user group existis for this user and if not, create one.
//
        $sql = "SELECT user_id FROM " . USER_GROUP_TABLE . " WHERE user_id = '$titanium_user_id'";
        $result = $titanium_db->sql_query($sql);
        $row = $titanium_db->sql_fetchrow($result);
        $titanium_user_check = $row['user_id'];
        if ( $titanium_user_check != $titanium_user_id )
        {
            $sql = "SELECT MAX(group_id) AS total
                    FROM " . GROUPS_TABLE;
            if ( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not select last group_id information', '', __LINE__, __FILE__, $sql);
            }
            if ( !($row = $titanium_db->sql_fetchrow($result)) )
            {
                message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sql);
            }
            $group_id = $row['total'] + 1;
            $sql = "INSERT INTO " . GROUPS_TABLE . " (group_id, group_name, group_description, group_single_user, group_moderator)
                    VALUES ('$group_id', '', 'Personal User', '1', '0')";
            if ( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not create private group', '', __LINE__, __FILE__, $sql);
            }
            $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                    VALUES ('$group_id', '$titanium_user_id', '0')";
            if ( !($result = $titanium_db->sql_query($sql)) )
            {
                message_die(GENERAL_ERROR, 'Could not create private group', '', __LINE__, __FILE__, $sql);
            }
        }
//
//  End Private group check.
//
        $sql = "SELECT u.user_id, u.username, u.user_level, g.group_id, g.group_name, g.group_single_user, ug.user_pending FROM " . USERS_TABLE . " u, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug WHERE ";
        $sql .= ( $mode == 'user' ) ? "u.user_id = '$titanium_user_id' AND ug.user_id = u.user_id AND g.group_id = ug.group_id" : "g.group_id = '$group_id' AND ug.group_id = g.group_id AND u.user_id = ug.user_id";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Couldn't obtain user/group information", "", __LINE__, __FILE__, $sql);
        }
        $ug_info = array();
        while( $row = $titanium_db->sql_fetchrow($result) )
        {
                $ug_info[] = $row;
        }
        $titanium_db->sql_freeresult($result);

        $sql = ( $mode == 'user' ) ? "SELECT aa.*, g.group_single_user FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g WHERE ug.user_id = $titanium_user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = 1" : "SELECT * FROM " . AUTH_ACCESS_TABLE . " WHERE group_id = '$group_id'";
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
        }

        $auth_access = array();
        $auth_access_count = array();
        while( $row = $titanium_db->sql_fetchrow($result) )
        {
                $auth_access[$row['forum_id']][] = $row;
                $auth_access_count[$row['forum_id']]++;
        }
        $titanium_db->sql_freeresult($result);

        $is_admin = ( $mode == 'user' ) ? ( ( $ug_info[0]['user_level'] == ADMIN && $ug_info[0]['user_id'] != ANONYMOUS ) ? 1 : 0 ) : 0;

        for($i = 0; $i < count($forum_access); $i++)
        {
                $phpbb2_forum_id = $forum_access[$i]['forum_id'];

                unset($prev_acl_setting);
                for($j = 0; $j < count($forum_auth_fields); $j++)
                {
                        $key = $forum_auth_fields[$j];
                        $value = $forum_access[$i][$key];

                        switch( $value )
                        {
                                case AUTH_ALL:
                                case AUTH_REG:
                                        $auth_ug[$phpbb2_forum_id][$key] = 1;
                                        break;

                                case AUTH_ACL:
                                        $auth_ug[$phpbb2_forum_id][$key] = ( !empty($auth_access_count[$phpbb2_forum_id]) ) ? check_auth(AUTH_ACL, $key, $auth_access[$phpbb2_forum_id], $is_admin) : 0;
                                        $auth_field_acl[$phpbb2_forum_id][$key] = $auth_ug[$phpbb2_forum_id][$key];

                                        if ( isset($prev_acl_setting) )
                                        {
                                                if ( $prev_acl_setting != $auth_ug[$phpbb2_forum_id][$key] && empty($adv) )
                                                {
                                                        $adv = 1;
                                                }
                                        }

                                        $prev_acl_setting = $auth_ug[$phpbb2_forum_id][$key];

                                        break;

                                case AUTH_MOD:
                                        $auth_ug[$phpbb2_forum_id][$key] = ( !empty($auth_access_count[$phpbb2_forum_id]) ) ? check_auth(AUTH_MOD, $key, $auth_access[$phpbb2_forum_id], $is_admin) : 0;
                                        break;

                                case AUTH_ADMIN:
                                        $auth_ug[$phpbb2_forum_id][$key] = $is_admin;
                                        break;

                                default:
                                        $auth_ug[$phpbb2_forum_id][$key] = 0;
                                        break;
                        }
                }

                //
                // Is user a moderator?
                //
                $auth_ug[$phpbb2_forum_id]['auth_mod'] = ( !empty($auth_access_count[$phpbb2_forum_id]) ) ? check_auth(AUTH_MOD, 'auth_mod', $auth_access[$phpbb2_forum_id], 0) : 0;
        }

        $i = 0;
        @reset($auth_ug);
        while( list($phpbb2_forum_id, $titanium_user_ary) = @each($auth_ug) )
        {
                if ( empty($adv) )
                {
                        if ( $forum_auth_level[$phpbb2_forum_id] == AUTH_ACL )
                        {
                                $allowed = 1;

                                for($j = 0; $j < count($forum_auth_level_fields[$phpbb2_forum_id]); $j++)
                                {
                                        if ( !$auth_ug[$phpbb2_forum_id][$forum_auth_level_fields[$phpbb2_forum_id][$j]] )
                                        {
                                                $allowed = 0;
                                        }
                                }

                                $optionlist_acl = '<select name="private[' . $phpbb2_forum_id . ']">';

                                if ( $is_admin || $titanium_user_ary['auth_mod'] )
                                {
                                        $optionlist_acl .= '<option value="1">' . $titanium_lang['Allowed_Access'] . '</option>';
                                }
                                else if ( $allowed )
                                {
                                        $optionlist_acl .= '<option value="1" selected="selected">' . $titanium_lang['Allowed_Access'] . '</option><option value="0">'. $titanium_lang['Disallowed_Access'] . '</option>';
                                }
                                else
                                {
                                        $optionlist_acl .= '<option value="1">' . $titanium_lang['Allowed_Access'] . '</option><option value="0" selected="selected">' . $titanium_lang['Disallowed_Access'] . '</option>';
                                }

                                $optionlist_acl .= '</select>';
                        }
                        else
                        {
                                $optionlist_acl = '&nbsp;';
                        }
                }
                else
                {
                        for($j = 0; $j < count($forum_access); $j++)
                        {
                                if ( $forum_access[$j]['forum_id'] == $phpbb2_forum_id )
                                {
                                        for($k = 0; $k < count($forum_auth_fields); $k++)
                                        {
                                                $field_name = $forum_auth_fields[$k];

                                                if( $forum_access[$j][$field_name] == AUTH_ACL )
                                                {
                                                        $optionlist_acl_adv[$phpbb2_forum_id][$k] = '<select name="private_' . $field_name . '[' . $phpbb2_forum_id . ']">';

                                                        if( isset($auth_field_acl[$phpbb2_forum_id][$field_name]) && !($is_admin || $titanium_user_ary['auth_mod']) )
                                                        {
                                                                if( !$auth_field_acl[$phpbb2_forum_id][$field_name] )
                                                                {
                                                                        $optionlist_acl_adv[$phpbb2_forum_id][$k] .= '<option value="1">' . $titanium_lang['ON'] . '</option><option value="0" selected="selected">' . $titanium_lang['OFF'] . '</option>';
                                                                }
                                                                else
                                                                {
                                                                        $optionlist_acl_adv[$phpbb2_forum_id][$k] .= '<option value="1" selected="selected">' . $titanium_lang['ON'] . '</option><option value="0">' . $titanium_lang['OFF'] . '</option>';
                                                                }
                                                        }
                                                        else
                                                        {
                                                                if( $is_admin || $titanium_user_ary['auth_mod'] )
                                                                {
                                                                        $optionlist_acl_adv[$phpbb2_forum_id][$k] .= '<option value="1">' . $titanium_lang['ON'] . '</option>';
                                                                }
                                                                else
                                                                {
                                                                        $optionlist_acl_adv[$phpbb2_forum_id][$k] .= '<option value="1">' . $titanium_lang['ON'] . '</option><option value="0" selected="selected">' . $titanium_lang['OFF'] . '</option>';
                                                                }
                                                        }

                                                        $optionlist_acl_adv[$phpbb2_forum_id][$k] .= '</select>';

                                                }
                                        }
                                }
                        }
                }

                $optionlist_mod = '<select name="moderator[' . $phpbb2_forum_id . ']">';
                $optionlist_mod .= ( $titanium_user_ary['auth_mod'] ) ? '<option value="1" selected="selected">' . $titanium_lang['Is_Moderator'] . '</option><option value="0">' . $titanium_lang['Not_Moderator'] . '</option>' : '<option value="1">' . $titanium_lang['Is_Moderator'] . '</option><option value="0" selected="selected">' . $titanium_lang['Not_Moderator'] . '</option>';
                $optionlist_mod .= '</select>';

                $row_class = ( !( $i % 2 ) ) ? 'row2' : 'row1';
                $row_color = ( !( $i % 2 ) ) ? $theme['td_color1'] : $theme['td_color2'];

                $phpbb2_template->assign_block_vars('forums', array(
                        'ROW_COLOR' => '#' . $row_color,
                        'ROW_CLASS' => $row_class,
                        'FORUM_NAME' => $forum_access[$i]['forum_name'],

                        'U_FORUM_AUTH' => append_titanium_sid("admin_forumauth.$phpEx?f=" . $forum_access[$i]['forum_id']),

                        'S_MOD_SELECT' => $optionlist_mod)
                );

                if( !$adv )
                {
                        $phpbb2_template->assign_block_vars('forums.aclvalues', array(
                                'S_ACL_SELECT' => $optionlist_acl)
                        );
                }
                else
                {
                        for($j = 0; $j < count($forum_auth_fields); $j++)
                        {
                                $phpbb2_template->assign_block_vars('forums.aclvalues', array(
                                        'S_ACL_SELECT' => $optionlist_acl_adv[$phpbb2_forum_id][$j])
                                );
                        }
                }

                $i++;
        }
        //@reset($auth_user);

        if ( $mode == 'user' )
        {
                $t_username = $ug_info[0]['username'];
                $s_user_type = ( $is_admin ) ? '<select name="userlevel"><option value="admin" selected="selected">' . $titanium_lang['Auth_Admin'] . '</option><option value="user">' . $titanium_lang['Auth_User'] . '</option></select>' : '<select name="userlevel"><option value="admin">' . $titanium_lang['Auth_Admin'] . '</option><option value="user" selected="selected">' . $titanium_lang['Auth_User'] . '</option></select>';
        }
        else
        {
                $t_groupname = $ug_info[0]['group_name'];
        }

        $name = array();
        $id = array();
        for($i = 0; $i < count($ug_info); $i++)
        {
                if( ( $mode == 'user' && !$ug_info[$i]['group_single_user'] ) || $mode == 'group' )
                {
                        $name[] = ( $mode == 'user' ) ? $ug_info[$i]['group_name'] :  $ug_info[$i]['username'];
                        $id[] = ( $mode == 'user' ) ? intval($ug_info[$i]['group_id']) : intval($ug_info[$i]['user_id']);
                }
        }

    $t_usergroup_list = $t_pending_list = '';
    if( count($name) )
    {
        for($i = 0; $i < count($ug_info); $i++)
        {
               $ug = ( $mode == 'user' ) ? 'group&amp;' . POST_GROUPS_URL : 'user&amp;' . POST_USERS_URL;

               if (!$ug_info[$i]['user_pending'])
               {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
              $t_usergroup_list .= ( ( $t_usergroup_list != '' ) ? ', ' : '' ) . '<a href="' . append_titanium_sid("admin_ug_auth.$phpEx?mode=$ug=" . $id[$i]) . '">' . UsernameColor($name[$i]) . '</a>';
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
               }
               else
               {
              $t_pending_list .= ( ( $t_pending_list != '' ) ? ', ' : '' ) . '<a href="' . append_titanium_sid("admin_ug_auth.$phpEx?mode=$ug=" . $id[$i]) . '">' . $name[$i] . '</a>';
               }
        }
        }
    $t_usergroup_list = ($t_usergroup_list == '') ? $titanium_lang['None'] : $t_usergroup_list;
    $t_pending_list = ($t_pending_list == '') ? $titanium_lang['None'] : $t_pending_list;
        $s_column_span = 2; // Two columns always present
        if( !$adv )
        {
                $phpbb2_template->assign_block_vars('acltype', array(
                        'L_UG_ACL_TYPE' => $titanium_lang['Simple_Permission'])
                );
                $s_column_span++;
        }
        else
        {
                for($i = 0; $i < count($forum_auth_fields); $i++)
                {
                        $cell_title = $field_names[$forum_auth_fields[$i]];

                        $phpbb2_template->assign_block_vars('acltype', array(
                                'L_UG_ACL_TYPE' => $cell_title)
                        );
                        $s_column_span++;
                }
        }

        //
        // Dump in the page header ...
        //
        include('./page_header_admin.'.$phpEx);

        $phpbb2_template->set_filenames(array(
                "body" => 'admin/auth_ug_body.tpl')
        );

        $adv_switch = ( empty($adv) ) ? 1 : 0;
        $u_ug_switch = ( $mode == 'user' ) ? POST_USERS_URL . "=" . $titanium_user_id : POST_GROUPS_URL . "=" . $group_id;
        $switch_mode = append_titanium_sid("admin_ug_auth.$phpEx?mode=$mode&amp;" . $u_ug_switch . "&amp;adv=$adv_switch");
        $switch_mode_text = ( empty($adv) ) ? $titanium_lang['Advanced_mode'] : $titanium_lang['Simple_mode'];
        $u_switch_mode = '<a href="' . $switch_mode . '">' . $switch_mode_text . '</a>';

        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="adv" value="' . $adv . '" />';
        $s_hidden_fields .= ( $mode == 'user' ) ? '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $titanium_user_id . '" />' : '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';

        if ( $mode == 'user' )
        {
                $phpbb2_template->assign_block_vars('switch_user_auth', array());

                $phpbb2_template->assign_vars(array(
                        'USERNAME' => $t_username,
                        'USER_LEVEL' => $titanium_lang['User_Level'] . " : " . $s_user_type,
                        'USER_GROUP_MEMBERSHIPS' => $titanium_lang['Group_memberships'] . ' : ' . $t_usergroup_list)
                );
        }
        else
        {
                $phpbb2_template->assign_block_vars("switch_group_auth", array());

                $phpbb2_template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/
                        'USERNAME' => GroupColor($t_groupname),
/*****[END]********************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/
                        'GROUP_MEMBERSHIP' => $titanium_lang['Usergroup_members'] . ' : ' . $t_usergroup_list . '<br />' . $titanium_lang['Pending_members'] . ' : ' . $t_pending_list)
                );
        }

        $phpbb2_template->assign_vars(array(
                'L_USER_OR_GROUPNAME' => ( $mode == 'user' ) ? $titanium_lang['Username'] : $titanium_lang['Group_name'],

                'L_AUTH_TITLE' => ( $mode == 'user' ) ? $titanium_lang['Auth_Control_User'] : $titanium_lang['Auth_Control_Group'],
                'L_AUTH_EXPLAIN' => ( $mode == 'user' ) ? $titanium_lang['User_auth_explain'] : $titanium_lang['Group_auth_explain'],
                'L_MODERATOR_STATUS' => $titanium_lang['Moderator_status'],
                'L_PERMISSIONS' => $titanium_lang['Permissions'],
                'L_SUBMIT' => $titanium_lang['Submit'],
                'L_RESET' => $titanium_lang['Reset'],
                'L_FORUM' => $titanium_lang['Forum'],

                'U_USER_OR_GROUP' => append_titanium_sid("admin_ug_auth.$phpEx"),
                'U_SWITCH_MODE' => $u_switch_mode,

                'S_COLUMN_SPAN' => $s_column_span,
                'S_AUTH_ACTION' => append_titanium_sid("admin_ug_auth.$phpEx"),
                'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );
}
else
{
        //
        // Select a user/group
        //
        include('./page_header_admin.'.$phpEx);

        $phpbb2_template->set_filenames(array(
                'body' => ( $mode == 'user' ) ? 'admin/user_select_body.tpl' : 'admin/auth_select_body.tpl')
        );

        if ( $mode == 'user' )
        {
                $phpbb2_template->assign_vars(array(
                        'L_FIND_USERNAME' => $titanium_lang['Find_username'],

                        'U_SEARCH_USER' => append_titanium_sid("search.$phpEx?mode=searchuser&popup=1&menu=1"))
                );
        }
        else
        {
                $sql = "SELECT group_id, group_name
                        FROM " . GROUPS_TABLE . "
                        WHERE group_single_user <> " . TRUE;
                if ( !($result = $titanium_db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, "Couldn't get group list", "", __LINE__, __FILE__, $sql);
                }

                if ( $row = $titanium_db->sql_fetchrow($result) )
                {
                        $select_list = '<select name="' . POST_GROUPS_URL . '">';
                        do
                        {
                                $select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
                        }
                        while ( $row = $titanium_db->sql_fetchrow($result) );
                        $select_list .= '</select>';
                }

                $phpbb2_template->assign_vars(array(
                        'S_AUTH_SELECT' => $select_list)
                );
        }

        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';

        $l_type = ( $mode == 'user' ) ? 'USER' : 'AUTH';

        $phpbb2_template->assign_vars(array(
                'L_' . $l_type . '_TITLE' => ( $mode == 'user' ) ? $titanium_lang['Auth_Control_User'] : $titanium_lang['Auth_Control_Group'],
                'L_' . $l_type . '_EXPLAIN' => ( $mode == 'user' ) ? $titanium_lang['User_auth_explain'] : $titanium_lang['Group_auth_explain'],
                'L_' . $l_type . '_SELECT' => ( $mode == 'user' ) ? $titanium_lang['Select_a_User'] : $titanium_lang['Select_a_Group'],
                'L_LOOK_UP' => ( $mode == 'user' ) ? $titanium_lang['Look_up_User'] : $titanium_lang['Look_up_Group'],

                'S_HIDDEN_FIELDS' => $s_hidden_fields,
                'S_' . $l_type . '_ACTION' => append_titanium_sid("admin_ug_auth.$phpEx"))
        );

}

$phpbb2_template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>