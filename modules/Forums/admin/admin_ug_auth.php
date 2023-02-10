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

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $module['Users']['Permissions'] = $filename . "?mode=user";
        $module['Groups']['Permissions'] = $filename . "?mode=group";

        return;
}

//
// Load default header
//
$no_page_header = TRUE;

$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require(__DIR__ . '/pagestart.' . $phpEx);

$params = ['mode' => 'mode', 'user_id' => POST_USERS_URL, 'group_id' => POST_GROUPS_URL, 'adv' => 'adv'];

//while( [$var, $param] = @each($params) )
foreach ($params as $var => $param)
{
        if ( !empty($_POST[$param]) || !empty($_GET[$param]) )
        {
                ${$var} = ( empty($_POST[$param]) ) ? $_GET[$param] : $_POST[$param];
        }
        else
        {
                ${$var} = "";
        }
}

$user_id = (int) $user_id;
$group_id = (int) $group_id;
$adv = (int) $adv;
$mode = htmlspecialchars((string) $mode);

//
// Start program - define vars
//
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$forum_auth_fields = ['auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_vote', 'auth_pollcreate', 'auth_globalannounce'];
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

$auth_field_match = [
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
    'auth_globalannounce' => AUTH_GLOBALANNOUNCE,
];
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

$field_names = [
    'auth_view' => $lang['View'],
    'auth_read' => $lang['Read'],
    'auth_post' => $lang['Post'],
    /*--FNA--*/
    'auth_reply' => $lang['Reply'],
    'auth_edit' => $lang['Edit'],
    'auth_delete' => $lang['Delete'],
    'auth_sticky' => $lang['Sticky'],
    'auth_announce' => $lang['Announce'],
    'auth_vote' => $lang['Vote'],
    'auth_pollcreate' => $lang['Pollcreate'],
    /*****[BEGIN]******************************************
     [ Mod:     Global Announcements               v1.2.8 ]
     ******************************************************/
    'auth_globalannounce' => $lang['Globalannounce'],
];
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

        if( count($u_access) > 0 )
        {
                foreach ($u_access as $j => $singleU_access) {
                    $result = 0;
                    switch($type)
                    {
                            case AUTH_ACL:
                                    $result = $singleU_access[$key];

                            case AUTH_MOD:
                                    $result = $result || $singleU_access['auth_mod'];

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

if (isset($_POST['submit']) && ( ( $mode == 'user' && $user_id ) || ( $mode == 'group' && $group_id ) )) {
    $user_level = '';
    if ( $mode == 'user' )
    {
            //
            // Get group_id for this user_id
            //
            $sql = "SELECT g.group_id, u.user_level
                        FROM " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u, " . GROUPS_TABLE . " g
                        WHERE u.user_id = '$user_id'
                                AND ug.user_id = u.user_id
                                AND g.group_id = ug.group_id
                                AND g.group_single_user = " . TRUE;
            if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR, 'Could not select info from user/user_group table', '', __LINE__, __FILE__, $sql);
            }

            $row = $db->sql_fetchrow($result);

            $group_id = (int) $row['group_id'];
            $user_level = (int) $row['user_level'];

            $db->sql_freeresult($result);
    }
    //
    // Carry out requests
    //
    if ( $mode == 'user' && $_POST['userlevel'] == 'admin' && $user_level != ADMIN )
    {
            //
            // Make user an admin (if already user)
            //
        if ( $userdata['user_id'] != $user_id )

            {
                    $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . ADMIN . "
                                WHERE user_id = '$user_id'";
                    if ( !($result = $db->sql_query($sql)) )
                    {
                            message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                    }

                    $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
                                WHERE group_id = '$group_id'
                                        AND auth_mod = '0'";
                    if ( !($result = $db->sql_query($sql)) )
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
                    if ( !($result = $db->sql_query($sql)) )
                    {
                            message_die(GENERAL_ERROR, "Couldn't update auth access", "", __LINE__, __FILE__, $sql);
                    }
            }

            $message = $lang['Auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_userauth'], '<a href="' . append_sid("admin_ug_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
            message_die(GENERAL_MESSAGE, $message);
    }
    else
    {
            if ( $mode == 'user' && $_POST['userlevel'] == 'user' && $user_level == ADMIN )
            {
                    //
                    // Make admin a user (if already admin) ... ignore if you're trying
                    // to change yourself from an admin to user!
                    //
                    if ( $userdata['user_id'] != $user_id )
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
                            if ( !($result = $db->sql_query($sql)) )
                            {
                                    message_die(GENERAL_ERROR, 'Could not update auth access', '', __LINE__, __FILE__, $sql);
                            }

                            //
                            // Update users level, reset to USER
                            //
                            $sql = "UPDATE " . USERS_TABLE . "
                                        SET user_level = " . USER . "
                                        WHERE user_id = '$user_id'";
                            if ( !($result = $db->sql_query($sql)) )
                            {
                                    message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
                            }
                    }

                    $message = $lang['Auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_userauth'], '<a href="' . append_sid("admin_ug_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
            }
            else
            {

                    $change_mod_list = $_POST['moderator'] ?? [];

        			if ( empty($adv) )
        			{
        				$sql = "SELECT f.*
            					FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
            					WHERE f.cat_id = c.cat_id
            					ORDER BY c.cat_order, f.forum_order ASC";
        				if ( !($result = $db->sql_query($sql)) )
        				{
        					message_die(GENERAL_ERROR, "Couldn't obtain forum information", "", __LINE__, __FILE__, $sql);
        				}

        				$forum_access = $forum_auth_level_fields = [];
        				while( $row = $db->sql_fetchrow($result) )
        				{
        					$forum_access[] = $row;
        				}
        				$db->sql_freeresult($result);

        				foreach ($forum_access as $i => $singleForum_access) {
                $forum_id = $singleForum_access['forum_id'];
                foreach ($forum_auth_fields as $j => $forum_auth_field) {
                    $forum_auth_level_fields[$forum_id][$forum_auth_fields[$j]] = $singleForum_access[$forum_auth_field] == AUTH_ACL;
                }
            }

        				//while( [$forum_id, $value] = @each($_POST['private']) )
					  if(isset($_POST['private'])){
						foreach ($_POST['private'] as $forum_id => $value)
        				{
        					//while( [$auth_field, $exists] = @each($forum_auth_level_fields[$forum_id]) )
							foreach ($forum_auth_level_fields[$forum_id] as $auth_field => $exists)
        					{
        						if ($exists)
        						{
        							$change_acl_list[$forum_id][$auth_field] = $value;
        						}
        					}
        				}
					  }
                    }
                    else
                    {
                            $change_acl_list = [];
                            foreach ($forum_auth_fields as $j => $forum_auth_field) {
                                $auth_field = $forum_auth_field;
                                //while( [$forum_id, $value] = @each($_POST['private_' . $auth_field]) )
								if (isset($_POST['private_' . $auth_field]))
								{
								  foreach ($_POST['private_' . $auth_field] as $forum_id => $value)
                                  {
                                        $change_acl_list[$forum_id][$auth_field] = $value;
                                  }
								}
                            }
                    }

        $sql = 'SELECT f.*
                FROM ' . FORUMS_TABLE . ' f, ' . CATEGORIES_TABLE . ' c
                WHERE f.cat_id = c.cat_id
                ORDER BY c.cat_order, f.forum_order';

                    if ( !($result = $db->sql_query($sql)) )
                    {
                            message_die(GENERAL_ERROR, "Couldn't obtain forum information", "", __LINE__, __FILE__, $sql);
                    }

                    $forum_access = [];
                    while( $row = $db->sql_fetchrow($result) )
                    {
                            $forum_access[] = $row;
                    }
                    $db->sql_freeresult($result);

                    $sql = ( $mode == 'user' ) ? "SELECT aa.* FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g WHERE ug.user_id = $user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = " . TRUE : "SELECT * FROM " . AUTH_ACCESS_TABLE . " WHERE group_id = '$group_id'";
                    if ( !($result = $db->sql_query($sql)) )
                    {
                            message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
                    }

                    $auth_access = [];
                    while( $row = $db->sql_fetchrow($result) )
                    {
                            $auth_access[$row['forum_id']] = $row;
                    }
                    $db->sql_freeresult($result);

                    $forum_auth_action = [];
                    $update_acl_status = [];
                    $update_mod_status = [];

                    foreach ($forum_access as $i => $singleForum_access) {
                        $forum_id = $singleForum_access['forum_id'];
                        if (
                                ( isset($auth_access[$forum_id]['auth_mod']) && $change_mod_list[$forum_id] != $auth_access[$forum_id]['auth_mod'] ) ||
            					( !isset($auth_access[$forum_id]['auth_mod']) && !empty($change_mod_list[$forum_id]) )
            				)
            				{
            					$update_mod_status[$forum_id] = $change_mod_list[$forum_id];

                                if (!$update_mod_status[$forum_id]) {
                                    $forum_auth_action[$forum_id] = 'delete';
                                } elseif (!isset($auth_access[$forum_id]['auth_mod'])) {
                                    $forum_auth_action[$forum_id] = 'insert';
                                } else
                                {
                                        $forum_auth_action[$forum_id] = 'update';
                                }
                        }
                        foreach ($forum_auth_fields as $j => $forum_auth_field) {
                            $auth_field = $forum_auth_field;
                            if( $singleForum_access[$auth_field] == AUTH_ACL && isset($change_acl_list[$forum_id][$auth_field]) )
                            {
                                    if (( empty($auth_access[$forum_id]['auth_mod']) &&
                                            ( isset($auth_access[$forum_id][$auth_field]) && $change_acl_list[$forum_id][$auth_field] != $auth_access[$forum_id][$auth_field] ) ||
                                            ( !isset($auth_access[$forum_id][$auth_field]) && !empty($change_acl_list[$forum_id][$auth_field]) ) ) ||
                                            !empty($update_mod_status[$forum_id])) {
                                        $update_acl_status[$forum_id][$auth_field] = ( empty($update_mod_status[$forum_id]) ) ? $change_acl_list[$forum_id][$auth_field] :  0;
                                        if (isset($auth_access[$forum_id][$auth_field]) && empty($update_acl_status[$forum_id][$auth_field]) && $forum_auth_action[$forum_id] != 'insert' && $forum_auth_action[$forum_id] != 'update') {
                                            $forum_auth_action[$forum_id] = 'delete';
                                        } elseif (!isset($auth_access[$forum_id][$auth_field]) && !( $forum_auth_action[$forum_id] == 'delete' && empty($update_acl_status[$forum_id][$auth_field]) )) {
                                            $forum_auth_action[$forum_id] = 'insert';
                                        } elseif (isset($auth_access[$forum_id][$auth_field]) && !empty($update_acl_status[$forum_id][$auth_field])) {
                                            $forum_auth_action[$forum_id] = 'update';
                                        }
                                    } elseif (( empty($auth_access[$forum_id]['auth_mod']) &&
                                            ( isset($auth_access[$forum_id][$auth_field]) && $change_acl_list[$forum_id][$auth_field] == $auth_access[$forum_id][$auth_field] ) ) && $forum_auth_action[$forum_id] == 'delete') {
                                        $forum_auth_action[$forum_id] = 'update';
                                    }
                            }
                        }
                    }

                    //
                    // Checks complete, make updates to DB
                    //
                    $delete_sql = '';
                    //while( [$forum_id, $action] = @each($forum_auth_action) )
					foreach ($forum_auth_action as $forum_id => $action)
                    {
                            if ( $action == 'delete' )
                            {
                                    $delete_sql .= ( ( $delete_sql != '' ) ? ', ' : '' ) . $forum_id;
                            }
                            else
                            {
                                    if ( $action == 'insert' )
                                    {
                                            $sql_field = '';
                                            $sql_value = '';
                                            //while ( [$auth_type, $value] = @each($update_acl_status[$forum_id]) )
											if(isset($update_acl_status[$forum_id]))
											{
											  foreach ($update_acl_status[$forum_id] as $auth_type => $value)
                                              {
                                                    $sql_field .= ( ( $sql_field != '' ) ? ', ' : '' ) . $auth_type;
                                                    $sql_value .= ( ( $sql_value != '' ) ? ', ' : '' ) . $value;
                                              }
											}
                                            $sql_field .= ( ( $sql_field != '' ) ? ', ' : '' ) . 'auth_mod';
                                            $sql_value .= ( ( $sql_value != '' ) ? ', ' : '' ) . ( $update_mod_status[$forum_id] ?? 0);

                                            $sql = "INSERT INTO " . AUTH_ACCESS_TABLE . " (forum_id, group_id, $sql_field)
                                                        VALUES ($forum_id, $group_id, $sql_value)";
                                    }
                                    else
                                    {
                                            $sql_values = '';
                                            //while ( [$auth_type, $value] = @each($update_acl_status[$forum_id]) )
											foreach ($update_acl_status[$forum_id] as $auth_type => $value)
                                            {
                                                    $sql_values .= ( ( $sql_values != '' ) ? ', ' : '' ) . $auth_type . ' = ' . $value;
                                            }
                                            $sql_values .= ( ( $sql_values != '' ) ? ', ' : '' ) . 'auth_mod = ' . ( $update_mod_status[$forum_id] ?? 0);

                                            $sql = "UPDATE " . AUTH_ACCESS_TABLE . "
                                                        SET $sql_values
                                                        WHERE group_id = '$group_id'
                                                                AND forum_id = '$forum_id'";
                                    }
                                    if( !($result = $db->sql_query($sql)) )
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
                            if( !($result = $db->sql_query($sql)) )
                            {
                                    message_die(GENERAL_ERROR, "Couldn't delete permission entries", "", __LINE__, __FILE__, $sql);
                            }
                    }

                    $l_auth_return = ( $mode == 'user' ) ? $lang['Click_return_userauth'] : $lang['Click_return_groupauth'];
                    $message = $lang['Auth_updated'] . '<br /><br />' . sprintf($l_auth_return, '<a href="' . append_sid("admin_ug_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
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
            if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
            }

            $set_mod = '';
            while( $row = $db->sql_fetchrow($result) )
            {
                    $set_mod .= ( ( $set_mod != '' ) ? ', ' : '' ) . $row['user_id'];
            }
            $db->sql_freeresult($result);

            $sql = match (SQL_LAYER) {
                'postgresql' => "SELECT u.user_id
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
                                        )",
                'oracle' => "SELECT u.user_id
                                        FROM " . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug, " . AUTH_ACCESS_TABLE . " aa
                                        WHERE ug.user_id = u.user_id(+)
                                                AND aa.group_id = ug.group_id(+)
                                                AND u.user_level NOT IN (" . USER . ", " . ADMIN . ")
                                        GROUP BY u.user_id
                                        HAVING SUM(aa.auth_mod) = 0",
                default => "SELECT u.user_id
                                        FROM ( ( " . USERS_TABLE . " u
                                        LEFT JOIN " . USER_GROUP_TABLE . " ug ON ug.user_id = u.user_id )
                                        LEFT JOIN " . AUTH_ACCESS_TABLE . " aa ON aa.group_id = ug.group_id )
                                        WHERE u.user_level NOT IN (" . USER . ", " . ADMIN . ")
                                        GROUP BY u.user_id
                                        HAVING SUM(aa.auth_mod) = 0",
            };
            if ( !($result = $db->sql_query($sql)) )
            {
                    message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
            }

            $unset_mod = "";
            while( $row = $db->sql_fetchrow($result) )
            {
                    $unset_mod .= ( ( $unset_mod != '' ) ? ', ' : '' ) . $row['user_id'];
            }
            $db->sql_freeresult($result);

            if ( $set_mod != '' )
            {
                    $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . MOD . "
                                WHERE user_id IN ($set_mod)";
                    if( !($result = $db->sql_query($sql)) )
                    {
                            message_die(GENERAL_ERROR, "Couldn't update user level", "", __LINE__, __FILE__, $sql);
                    }
            }

            if ( $unset_mod != '' )
            {
                    $sql = "UPDATE " . USERS_TABLE . "
                                SET user_level = " . USER . "
                                WHERE user_id IN ($unset_mod)";
                    if( !($result = $db->sql_query($sql)) )
                    {
                            message_die(GENERAL_ERROR, "Couldn't update user level", "", __LINE__, __FILE__, $sql);
                    }
            }
            
    $sql = 'SELECT user_id FROM ' . USER_GROUP_TABLE . "
            WHERE group_id = $group_id";
    $result = $db->sql_query($sql);

    $group_user = [];
    while ($row = $db->sql_fetchrow($result))
    {
        $group_user[$row['user_id']] = $row['user_id'];
    }
    $db->sql_freeresult($result);
    
if(!empty($group_user)):
	
    $sql = "SELECT ug.user_id, COUNT(auth_mod) AS is_auth_mod
            FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug
            WHERE ug.user_id IN (" . implode(', ', $group_user ?? '') . ")
                AND aa.group_id = ug.group_id
                AND aa.auth_mod = 1
            GROUP BY ug.user_id";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Please add someone to this group, we could not obtain moderator status', '', __LINE__, __FILE__, $sql);
    }

    while ($row = $db->sql_fetchrow($result))
    {
        if ($row['is_auth_mod'])
        {
            unset($group_user[$row['user_id']]);
        }
    }
    $db->sql_freeresult($result);
    
endif;
    
	if ($group_user !== [])
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
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
        }
    }

            message_die(GENERAL_MESSAGE, $message);
            $cache->delete('forum_moderators', 'config');
    }
} elseif (( $mode == 'user' && ( isset($_POST['username']) || $user_id ) ) || ( $mode == 'group' && $group_id )) {
    if ( isset($_POST['username']) )
    {
            $this_userdata = get_userdata($_POST['username'], true);
            if ( !is_array($this_userdata) )
            {
                    message_die(GENERAL_MESSAGE, $lang['No_such_user']);
            }
            $user_id = $this_userdata['user_id'];
    }
    //
    // Front end
    //
    $sql = "SELECT f.*
                FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
                WHERE f.cat_id = c.cat_id
                ORDER BY c.cat_order, f.forum_order ASC";
    if ( !($result = $db->sql_query($sql)) )
    {
            message_die(GENERAL_ERROR, "Couldn't obtain forum information", "", __LINE__, __FILE__, $sql);
    }
    $forum_access = [];
    while( $row = $db->sql_fetchrow($result) )
    {
            $forum_access[] = $row;
    }
    $db->sql_freeresult($result);
    if( empty($adv) )
    {
            foreach ($forum_access as $i => $singleForum_access) {
                $forum_id = $singleForum_access['forum_id'];
                $forum_auth_level[$forum_id] = AUTH_ALL;
                foreach ($forum_auth_fields as $j => $forum_auth_field) {
                    $singleForum_access[$forum_auth_field] . ' :: ';
                    if ( $singleForum_access[$forum_auth_field] == AUTH_ACL )
                    {
                            $forum_auth_level[$forum_id] = AUTH_ACL;
                            $forum_auth_level_fields[$forum_id][] = $forum_auth_field;
                    }
                }
            }
    }
    //
    // Check if a private user group existis for this user and if not, create one.
    //
    $sql = "SELECT user_id FROM " . USER_GROUP_TABLE . " WHERE user_id = '$user_id'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    
	if (!isset($row['user_id']))
	$row['user_id'] ='';
	
	$user_check = $row['user_id'];
    
	if ( $user_check != $user_id )
    {
        $sql = "SELECT MAX(group_id) AS total
                    FROM " . GROUPS_TABLE;
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not select last group_id information', '', __LINE__, __FILE__, $sql);
        }
        if ( !($row = $db->sql_fetchrow($result)) )
        {
            message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sql);
        }
        $group_id = $row['total'] + 1;
        $sql = "INSERT INTO " . GROUPS_TABLE . " (group_id, group_name, group_description, group_single_user, group_moderator)
                    VALUES ('$group_id', '', 'Personal User', '1', '0')";
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not create private group', '', __LINE__, __FILE__, $sql);
        }
        $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
                    VALUES ('$group_id', '$user_id', '0')";
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not create private group', '', __LINE__, __FILE__, $sql);
        }
    }
    //
    //  End Private group check.
    //
    $sql = "SELECT u.user_id, u.username, u.user_level, g.group_id, g.group_name, g.group_single_user, ug.user_pending FROM " . USERS_TABLE . " u, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug WHERE ";
    $sql .= ( $mode == 'user' ) ? "u.user_id = '$user_id' AND ug.user_id = u.user_id AND g.group_id = ug.group_id" : "g.group_id = '$group_id' AND ug.group_id = g.group_id AND u.user_id = ug.user_id";
    if ( !($result = $db->sql_query($sql)) )
    {
            message_die(GENERAL_ERROR, "Couldn't obtain user/group information", "", __LINE__, __FILE__, $sql);
    }
    $ug_info = [];
    while( $row = $db->sql_fetchrow($result) )
    {
            $ug_info[] = $row;
    }
    $db->sql_freeresult($result);
    $sql = ( $mode == 'user' ) ? "SELECT aa.*, g.group_single_user FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g WHERE ug.user_id = $user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = 1" : "SELECT * FROM " . AUTH_ACCESS_TABLE . " WHERE group_id = '$group_id'";
    if ( !($result = $db->sql_query($sql)) )
    {
            message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
    }
    $auth_access = [];
    $auth_access_count = [];
    while( $row = $db->sql_fetchrow($result) )
    {
		    if(!isset($auth_access_count[$row['forum_id']]))
			$auth_access_count[$row['forum_id']] = 0;
			
            $auth_access[$row['forum_id']][] = $row;
            $auth_access_count[$row['forum_id']]++;
    }
    $db->sql_freeresult($result);
    $is_admin = ( $mode == 'user' ) ? ( ( $ug_info[0]['user_level'] == ADMIN && $ug_info[0]['user_id'] != ANONYMOUS ) ? 1 : 0 ) : 0;
    foreach ($forum_access as $i => $singleForum_access) {
        $forum_id = $singleForum_access['forum_id'];
        unset($prev_acl_setting);
        foreach ($forum_auth_fields as $j => $forum_auth_field) {
            $key = $forum_auth_field;
            $value = $singleForum_access[$key];
            switch( $value )
            {
                    case AUTH_ALL:
                    case AUTH_REG:
                            $auth_ug[$forum_id][$key] = 1;
                            break;

                    case AUTH_ACL:
                            $auth_ug[$forum_id][$key] = ( empty($auth_access_count[$forum_id]) ) ? 0 : check_auth(AUTH_ACL, $key, $auth_access[$forum_id], $is_admin);
                            $auth_field_acl[$forum_id][$key] = $auth_ug[$forum_id][$key];

                            if ( isset($prev_acl_setting) && ($prev_acl_setting != $auth_ug[$forum_id][$key] && empty($adv)) )
                            {
                                    $adv = 1;
                            }

                            $prev_acl_setting = $auth_ug[$forum_id][$key];

                            break;

                    case AUTH_MOD:
                            $auth_ug[$forum_id][$key] = ( empty($auth_access_count[$forum_id]) ) ? 0 : check_auth(AUTH_MOD, $key, $auth_access[$forum_id], $is_admin);
                            break;

                    case AUTH_ADMIN:
                            $auth_ug[$forum_id][$key] = $is_admin;
                            break;

                    default:
                            $auth_ug[$forum_id][$key] = 0;
                            break;
            }
        }
        //
        // Is user a moderator?
        //
        $auth_ug[$forum_id]['auth_mod'] = ( empty($auth_access_count[$forum_id]) ) ? 0 : check_auth(AUTH_MOD, 'auth_mod', $auth_access[$forum_id], 0);
    }
    $i = 0;
    reset($auth_ug);
    //while( [$forum_id, $user_ary] = @each($auth_ug) )
	foreach ($auth_ug as $forum_id => $user_ary)
    {
            if ( empty($adv) )
            {
                    if ( $forum_auth_level[$forum_id] == AUTH_ACL )
                    {
                            $allowed = 1;
                            $itemsCount = is_countable($forum_auth_level_fields[$forum_id]) ? count($forum_auth_level_fields[$forum_id]) : 0;

                            for($j = 0; $j < $itemsCount; $j++)
                            {
                                    if ( !$auth_ug[$forum_id][$forum_auth_level_fields[$forum_id][$j]] )
                                    {
                                            $allowed = 0;
                                    }
                            }

                            $optionlist_acl = '<select name="private[' . $forum_id . ']">';

                            if ($is_admin || $user_ary['auth_mod']) {
                                $optionlist_acl .= '<option value="1">' . $lang['Allowed_Access'] . '</option>';
                            } elseif ($allowed) {
                                $optionlist_acl .= '<option value="1" selected="selected">' . $lang['Allowed_Access'] . '</option><option value="0">'. $lang['Disallowed_Access'] . '</option>';
                            } else
                            {
                                    $optionlist_acl .= '<option value="1">' . $lang['Allowed_Access'] . '</option><option value="0" selected="selected">' . $lang['Disallowed_Access'] . '</option>';
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
                    foreach ($forum_access as $j => $singleForum_access) {
                        if ( $singleForum_access['forum_id'] == $forum_id )
                        {
                                $forum_auth_fieldsCount = count($forum_auth_fields);
                                for($k = 0; $k < $forum_auth_fieldsCount; $k++)
                                {
                                        $field_name = $forum_auth_fields[$k];

                                        if( $singleForum_access[$field_name] == AUTH_ACL )
                                        {
                                                $optionlist_acl_adv[$forum_id][$k] = '<select name="private_' . $field_name . '[' . $forum_id . ']">';

                                                if (isset($auth_field_acl[$forum_id][$field_name]) && (!$is_admin && !$user_ary['auth_mod'])) {
                                                    if( !$auth_field_acl[$forum_id][$field_name] )
                                                    {
                                                            $optionlist_acl_adv[$forum_id][$k] .= '<option value="1">' . $lang['ON'] . '</option><option value="0" selected="selected">' . $lang['OFF'] . '</option>';
                                                    }
                                                    else
                                                    {
                                                            $optionlist_acl_adv[$forum_id][$k] .= '<option value="1" selected="selected">' . $lang['ON'] . '</option><option value="0">' . $lang['OFF'] . '</option>';
                                                    }
                                                } elseif ($is_admin || $user_ary['auth_mod']) {
                                                    $optionlist_acl_adv[$forum_id][$k] .= '<option value="1">' . $lang['ON'] . '</option>';
                                                } else
                                                {
                                                        $optionlist_acl_adv[$forum_id][$k] .= '<option value="1">' . $lang['ON'] . '</option><option value="0" selected="selected">' . $lang['OFF'] . '</option>';
                                                }

                                                $optionlist_acl_adv[$forum_id][$k] .= '</select>';

                                        }
                                }
                        }
                    }
            }

            $optionlist_mod = '<select name="moderator[' . $forum_id . ']">';
            $optionlist_mod .= ( $user_ary['auth_mod'] ) ? '<option value="1" selected="selected">' . $lang['Is_Moderator'] . '</option><option value="0">' . $lang['Not_Moderator'] . '</option>' : '<option value="1">' . $lang['Is_Moderator'] . '</option><option value="0" selected="selected">' . $lang['Not_Moderator'] . '</option>';
            $optionlist_mod .= '</select>';

            $row_class = ( $i % 2 === 0 ) ? 'row2' : 'row1';
            $row_color = ( $i % 2 ) ? $theme['td_color2'] : $theme['td_color1'];

            $template->assign_block_vars('forums', ['ROW_COLOR' => '#' . $row_color, 'ROW_CLASS' => $row_class, 'FORUM_NAME' => $forum_access[$i]['forum_name'], 'U_FORUM_AUTH' => append_sid("admin_forumauth.$phpEx?f=" . $forum_access[$i]['forum_id']), 'S_MOD_SELECT' => $optionlist_mod]
            );

            if( $adv === 0 )
            {
                    $template->assign_block_vars('forums.aclvalues', ['S_ACL_SELECT' => $optionlist_acl]
                    );
            }
            else
            {
                    foreach (array_keys($forum_auth_fields) as $j) {
                        if(!isset($optionlist_acl_adv[$forum_id][$j]))
						$optionlist_acl_adv[$forum_id][$j] = '';
						$template->assign_block_vars('forums.aclvalues', ['S_ACL_SELECT' => $optionlist_acl_adv[$forum_id][$j]]
                        );
                    }
            }

            $i++;
    }
    //@reset($auth_user);
	if (!isset($ug_info[0]['group_name']))
	$ug_info[0]['group_name'] = '';

    if ( $mode == 'user' )
    {
            $t_username = $ug_info[0]['username'];
            $s_user_type = ( $is_admin ) ? '<select name="userlevel"><option value="admin" selected="selected">' . $lang['Auth_Admin'] . '</option><option value="user">' . $lang['Auth_User'] . '</option></select>' : '<select name="userlevel"><option value="admin">' . $lang['Auth_Admin'] . '</option><option value="user" selected="selected">' . $lang['Auth_User'] . '</option></select>';
    }
    else
    {
            $t_groupname = $ug_info[0]['group_name'];
    }
    $name = [];
    $id = [];
    foreach ($ug_info as $i => $singleUg_info) {

	if (!isset($singleUg_info['username']))
	$singleUg_info['username'] = '';

	if (!isset($singleUg_info['user_id']))
	$singleUg_info['user_id'] = 0;

        if( ( $mode == 'user' && !$singleUg_info['group_single_user'] ) || $mode == 'group' )
        {
                $name[] = ( $mode == 'user' ) ? $singleUg_info['group_name'] :  $singleUg_info['username'];
                $id[] = ( $mode == 'user' ) ? (int) $singleUg_info['group_id'] : (int) $singleUg_info['user_id'];
        }
    }
    $t_usergroup_list = $t_pending_list = '';
    if( $name !== [] )
    {
        foreach ($ug_info as $i => $singleUg_info) {

	    if (!isset($singleUg_info['user_pending']))
	    $singleUg_info['user_pending'] = '';
        
		    $ug = ( $mode == 'user' ) ? 'group&amp;' . POST_GROUPS_URL : 'user&amp;' . POST_USERS_URL;
            if (!$singleUg_info['user_pending'])
            {
            /*****[BEGIN]******************************************
             [ Mod:    Advanced Username Color             v1.0.5 ]
             ******************************************************/
           $t_usergroup_list .= ( ( $t_usergroup_list != '' ) ? ', ' : '' ) . '<a href="' . append_sid("admin_ug_auth.$phpEx?mode=$ug=" . $id[$i] = $id[$i] ?? '') . '">' . UsernameColor($name[$i] = $name[$i] ?? '') . '</a>';
           /*****[END]********************************************
            [ Mod:    Advanced Username Color             v1.0.5 ]
            ******************************************************/
            }
            else
            {
           $t_pending_list .= ( ( $t_pending_list != '' ) ? ', ' : '' ) . '<a href="' . append_sid("admin_ug_auth.$phpEx?mode=$ug=" . $id[$i]) . '">' . $name[$i] . '</a>';
            }
        }
        }
    $t_usergroup_list = ($t_usergroup_list == '') ? $lang['None'] : $t_usergroup_list;
    $t_pending_list = ($t_pending_list == '') ? $lang['None'] : $t_pending_list;
    $s_column_span = 2;
    // Two columns always present
    if( $adv === 0 )
    {
            $template->assign_block_vars('acltype', ['L_UG_ACL_TYPE' => $lang['Simple_Permission']]
            );
            $s_column_span++;
    }
    else
    {
            foreach ($forum_auth_fields as $i => $forum_auth_field) {
                $cell_title = $field_names[$forum_auth_field];
                $template->assign_block_vars('acltype', ['L_UG_ACL_TYPE' => $cell_title]
                );
                $s_column_span++;
            }
    }
    //
    // Dump in the page header ...
    //
    include(__DIR__ . '/page_header_admin.'.$phpEx);
    $template->set_filenames(["body" => 'admin/auth_ug_body.tpl']
    );
    $adv_switch = ( empty($adv) ) ? 1 : 0;
    $u_ug_switch = ( $mode == 'user' ) ? POST_USERS_URL . "=" . $user_id : POST_GROUPS_URL . "=" . $group_id;
    $switch_mode = append_sid("admin_ug_auth.$phpEx?mode=$mode&amp;" . $u_ug_switch . "&amp;adv=$adv_switch");
    $switch_mode_text = ( empty($adv) ) ? $lang['Advanced_mode'] : $lang['Simple_mode'];
    $u_switch_mode = '<a href="' . $switch_mode . '">' . $switch_mode_text . '</a>';
    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="adv" value="' . $adv . '" />';
    $s_hidden_fields .= ( $mode == 'user' ) ? '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $user_id . '" />' : '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
    if ( $mode == 'user' )
    {
            $template->assign_block_vars('switch_user_auth', []);

            $template->assign_vars(['USERNAME' => $t_username, 'USER_LEVEL' => $lang['User_Level'] . " : " . $s_user_type, 'USER_GROUP_MEMBERSHIPS' => $lang['Group_memberships'] . ' : ' . $t_usergroup_list]
            );
    }
    else
    {
            $template->assign_block_vars("switch_group_auth", []);

            $template->assign_vars([
                /*****[BEGIN]******************************************
                 [ Mod:    Group Colors                        v1.0.0 ]
                 ******************************************************/
                'USERNAME' => GroupColor($t_groupname),
                /*****[END]********************************************
                 [ Mod:    Group Colors                        v1.0.0 ]
                 ******************************************************/
                'GROUP_MEMBERSHIP' => $lang['Usergroup_members'] . ' : ' . $t_usergroup_list . '<br />' . $lang['Pending_members'] . ' : ' . $t_pending_list,
            ]
            );
    }
    $template->assign_vars(['L_USER_OR_GROUPNAME' => ( $mode == 'user' ) ? $lang['Username'] : $lang['Group_name'], 'L_AUTH_TITLE' => ( $mode == 'user' ) ? $lang['Auth_Control_User'] : $lang['Auth_Control_Group'], 'L_AUTH_EXPLAIN' => ( $mode == 'user' ) ? $lang['User_auth_explain'] : $lang['Group_auth_explain'], 'L_MODERATOR_STATUS' => $lang['Moderator_status'], 'L_PERMISSIONS' => $lang['Permissions'], 'L_SUBMIT' => $lang['Submit'], 'L_RESET' => $lang['Reset'], 'L_FORUM' => $lang['Forum'], 'U_USER_OR_GROUP' => append_sid("admin_ug_auth.$phpEx"), 'U_SWITCH_MODE' => $u_switch_mode, 'S_COLUMN_SPAN' => $s_column_span, 'S_AUTH_ACTION' => append_sid("admin_ug_auth.$phpEx"), 'S_HIDDEN_FIELDS' => $s_hidden_fields]
    );
} else
{
        //
        // Select a user/group
        //
        include(__DIR__ . '/page_header_admin.'.$phpEx);

        $template->set_filenames(['body' => ( $mode == 'user' ) ? 'admin/user_select_body.tpl' : 'admin/auth_select_body.tpl']
        );

        if ( $mode == 'user' )
        {
                $template->assign_vars(['L_FIND_USERNAME' => $lang['Find_username'], 'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser&popup=1&menu=1")]
                );
        }
        else
        {
                $sql = "SELECT group_id, group_name
                        FROM " . GROUPS_TABLE . "
                        WHERE group_single_user <> " . TRUE;
                if ( !($result = $db->sql_query($sql)) )
                {
                        message_die(GENERAL_ERROR, "Couldn't get group list", "", __LINE__, __FILE__, $sql);
                }

                if ( $row = $db->sql_fetchrow($result) )
                {
                        $select_list = '<select name="' . POST_GROUPS_URL . '">';
                        do
                        {
                                $select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
                        }
                        while ( $row = $db->sql_fetchrow($result) );
                        $select_list .= '</select>';
                }

                $template->assign_vars(['S_AUTH_SELECT' => $select_list]
                );
        }

        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';

        $l_type = ( $mode == 'user' ) ? 'USER' : 'AUTH';

        $template->assign_vars(['L_' . $l_type . '_TITLE' => ( $mode == 'user' ) ? $lang['Auth_Control_User'] : $lang['Auth_Control_Group'], 'L_' . $l_type . '_EXPLAIN' => ( $mode == 'user' ) ? $lang['User_auth_explain'] : $lang['Group_auth_explain'], 'L_' . $l_type . '_SELECT' => ( $mode == 'user' ) ? $lang['Select_a_User'] : $lang['Select_a_Group'], 'L_LOOK_UP' => ( $mode == 'user' ) ? $lang['Look_up_User'] : $lang['Look_up_Group'], 'S_HIDDEN_FIELDS' => $s_hidden_fields, 'S_' . $l_type . '_ACTION' => append_sid("admin_ug_auth.$phpEx")]
        );

}

$template->pparse('body');

include(__DIR__ . '/page_footer_admin.'.$phpEx);

?>
