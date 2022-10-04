<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            admin_forumauth.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_forumauth.php,v 1.23.2.5 2004/03/25 15:57:19 acydburn Exp
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
  -=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Global Announcements                     v1.2.8       06/13/2005
 ************************************************************************/

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $titanium_module['Forums']['Permissions']   = $filename;

        return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Start program - define vars
//
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
//                View      Read      Post      Reply     Edit     Delete    Sticky   Announce    Vote      Poll      Global Announcement
$simple_auth_ary = array(
        0  => array(AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_MOD),
        1  => array(AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_MOD),
        2  => array(AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_MOD),
        3  => array(AUTH_ALL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ACL, AUTH_ACL, AUTH_MOD),
        4  => array(AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ACL, AUTH_ACL, AUTH_MOD),
        5  => array(AUTH_ALL, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD),
        6  => array(AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD),
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
);

$simple_auth_types = array($lang['Public'], $lang['Registered'], $lang['Registered'] . ' [' . $lang['Hidden'] . ']', $lang['Private'], $lang['Private'] . ' [' . $lang['Hidden'] . ']', $lang['Moderators'], $lang['Moderators'] . ' [' . $lang['Hidden'] . ']');

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$forum_auth_fields = array('auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_vote', 'auth_pollcreate', 'auth_globalannounce');
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

$field_names = array(
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
        'auth_globalannounce' => $lang['Globalannounce']);
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

$forum_auth_levels = array('ALL', 'REG', 'PRIVATE', 'MOD', 'ADMIN');
$forum_auth_const = array(AUTH_ALL, AUTH_REG, AUTH_ACL, AUTH_MOD, AUTH_ADMIN);

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
attach_setup_forum_auth($simple_auth_ary, $forum_auth_fields, $field_names);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

if(isset($HTTP_GET_VARS[POST_FORUM_URL]) || isset($HTTP_POST_VARS[POST_FORUM_URL]))
{
        $phpbb2_forum_id = (isset($HTTP_POST_VARS[POST_FORUM_URL])) ? intval($HTTP_POST_VARS[POST_FORUM_URL]) : intval($HTTP_GET_VARS[POST_FORUM_URL]);
        $forum_sql = "AND forum_id = $phpbb2_forum_id";
}
else
{
        unset($phpbb2_forum_id);
        $forum_sql = '';
}

if( isset($HTTP_GET_VARS['adv']) )
{
        $adv = intval($HTTP_GET_VARS['adv']);
}
else
{
        unset($adv);
}

//
// Start program proper
//
if( isset($HTTP_POST_VARS['submit']) )
{
        $sql = '';

        if(!empty($phpbb2_forum_id))
        {
                if(isset($HTTP_POST_VARS['simpleauth']))
                {
         $simple_ary = $simple_auth_ary[intval($HTTP_POST_VARS['simpleauth'])];

         for($i = 0; $i < count($simple_ary); $i++)
         {
            $sql .= ( ( $sql != '' ) ? ', ' : '' ) . $forum_auth_fields[$i] . ' = ' . $simple_ary[$i];
         }

         if (is_array($simple_ary))
         {
            $sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $phpbb2_forum_id";
         }
      }
      else
      {
         for($i = 0; $i < count($forum_auth_fields); $i++)
         {
            $value = intval($HTTP_POST_VARS[$forum_auth_fields[$i]]);

                                if ( $forum_auth_fields[$i] == 'auth_vote' )
                                {
                                        if ( $HTTP_POST_VARS['auth_vote'] == AUTH_ALL )
                                        {
                                                $value = AUTH_REG;
                                        }
                                }

                                $sql .= ( ( $sql != '' ) ? ', ' : '' ) .$forum_auth_fields[$i] . ' = ' . $value;
                        }

                        $sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $phpbb2_forum_id";
                }

                if ( $sql != '' )
                {
                        if ( !$titanium_db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update auth table', '', __LINE__, __FILE__, $sql);
                        }
                }

                $forum_sql = '';
                $adv = 0;
        }

        $phpbb2_template->assign_vars(array(
                'META' => '<meta http-equiv="refresh" content="3;url=' . append_titanium_sid("admin_forumauth.$phpEx?" . POST_FORUM_URL . "=$phpbb2_forum_id") . '">')
        );
        $message = $lang['Forum_auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumauth'],  '<a href="' . append_titanium_sid("admin_forumauth.$phpEx") . '">', "</a>");
        message_die(GENERAL_MESSAGE, $message);

} // End of submit

//
// Get required information, either all forums if
// no id was specified or just the requsted if it
// was
//
$sql = "SELECT f.*
        FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
        WHERE c.cat_id = f.cat_id
        $forum_sql
        ORDER BY c.cat_order ASC, f.forum_order ASC";
if ( !($result = $titanium_db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, "Couldn't obtain forum list", "", __LINE__, __FILE__, $sql);
}

$forum_rows = $titanium_db->sql_fetchrowset($result);
$titanium_db->sql_freeresult($result);

if( empty($phpbb2_forum_id) )
{
        //
        // Output the selection table if no forum id was
        // specified
        //
        $phpbb2_template->set_filenames(array(
                'body' => 'admin/auth_select_body.tpl')
        );

        $select_list = '<select name="' . POST_FORUM_URL . '">';
        for($i = 0; $i < count($forum_rows); $i++)
        {
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
		if( !$forum_rows[$i]['forum_parent'] )
		{
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                $select_list .= '<option value="' . $forum_rows[$i]['forum_id'] . '">' . $forum_rows[$i]['forum_name'] . '</option>';
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
			$phpbb2_parent_id = $forum_rows[$i]['forum_id'];
			for( $j = 0; $j < count($forum_rows); $j++ )
			{
				if( $forum_rows[$j]['forum_parent'] == $phpbb2_parent_id )
				{
					$select_list .= '<option value="' . $forum_rows[$j]['forum_id'] . '">-- ' . $forum_rows[$j]['forum_name'] . '</option>';
				}
			}
		}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
        }
        $select_list .= '</select>';

        $phpbb2_template->assign_vars(array(
                'L_AUTH_TITLE' => $lang['Auth_Control_Forum'],
                'L_AUTH_EXPLAIN' => $lang['Forum_auth_explain'],
                'L_AUTH_SELECT' => $lang['Select_a_Forum'],
                'L_LOOK_UP' => $lang['Look_up_Forum'],

                'S_AUTH_ACTION' => append_titanium_sid("admin_forumauth.$phpEx"),
                'S_AUTH_SELECT' => $select_list)
        );

}
else
{
        //
        // Output the authorisation details if an id was
        // specified
        //
        $phpbb2_template->set_filenames(array(
                'body' => 'admin/auth_forum_body.tpl')
        );

        $forum_name = $forum_rows[0]['forum_name'];

        @reset($simple_auth_ary);
        while( list($key, $auth_levels) = each($simple_auth_ary))
        {
                $matched = 1;
                for($k = 0; $k < count($auth_levels); $k++)
                {
                        $matched_type = $key;

                        if ( $forum_rows[0][$forum_auth_fields[$k]] != $auth_levels[$k] )
                        {
                                $matched = 0;
                        }
                }

                if ( $matched )
                {
                        break;
                }
        }

        //
        // If we didn't get a match above then we
        // automatically switch into 'advanced' mode
        //
        if ( !isset($adv) && !$matched )
        {
                $adv = 1;
        }

        $s_column_span == 0;

        if ( empty($adv) )
        {
                $simple_auth = '<select name="simpleauth">';

                for($j = 0; $j < count($simple_auth_types); $j++)
                {
                        $selected = ( $matched_type == $j ) ? ' selected="selected"' : '';
                        $simple_auth .= '<option value="' . $j . '"' . $selected . '>' . $simple_auth_types[$j] . '</option>';
                }

                $simple_auth .= '</select>';

                $phpbb2_template->assign_block_vars('forum_auth_titles', array(
                        'CELL_TITLE' => $lang['Simple_mode'])
                );
                $phpbb2_template->assign_block_vars('forum_auth_data', array(
                        'S_AUTH_LEVELS_SELECT' => $simple_auth)
                );

                $s_column_span++;
        }
        else
        {
                //
                // Output values of individual
                // fields
                //
                for($j = 0; $j < count($forum_auth_fields); $j++)
                {
                        $custom_auth[$j] = '&nbsp;<select name="' . $forum_auth_fields[$j] . '">';

                        for($k = 0; $k < count($forum_auth_levels); $k++)
                        {
                                $selected = ( $forum_rows[0][$forum_auth_fields[$j]] == $forum_auth_const[$k] ) ? ' selected="selected"' : '';
                                $custom_auth[$j] .= '<option value="' . $forum_auth_const[$k] . '"' . $selected . '>' . $lang['Forum_' . $forum_auth_levels[$k]] . '</option>';
                        }
                        $custom_auth[$j] .= '</select>&nbsp;';

                        $cell_title = $field_names[$forum_auth_fields[$j]];

                        $phpbb2_template->assign_block_vars('forum_auth_titles', array(
                                'CELL_TITLE' => $cell_title)
                        );
                        $phpbb2_template->assign_block_vars('forum_auth_data', array(
                                'S_AUTH_LEVELS_SELECT' => $custom_auth[$j])
                        );

                        $s_column_span++;
                }
        }

        $adv_mode = ( empty($adv) ) ? '1' : '0';
        $switch_mode = append_titanium_sid("admin_forumauth.$phpEx?" . POST_FORUM_URL . "=" . $phpbb2_forum_id . "&adv=". $adv_mode);
        $switch_mode_text = ( empty($adv) ) ? $lang['Advanced_mode'] : $lang['Simple_mode'];
        $u_switch_mode = '<a href="' . $switch_mode . '">' . $switch_mode_text . '</a>';

        $s_hidden_fields = '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $phpbb2_forum_id . '">';

        $phpbb2_template->assign_vars(array(
                'FORUM_NAME' => $forum_name,

                'L_FORUM' => $lang['Forum'],
                'L_AUTH_TITLE' => $lang['Auth_Control_Forum'],
                'L_AUTH_EXPLAIN' => $lang['Forum_auth_explain'],
                'L_SUBMIT' => $lang['Submit'],
                'L_RESET' => $lang['Reset'],

                'U_SWITCH_MODE' => $u_switch_mode,

                'S_FORUMAUTH_ACTION' => append_titanium_sid("admin_forumauth.$phpEx"),
                'S_COLUMN_SPAN' => $s_column_span,
                'S_HIDDEN_FIELDS' => $s_hidden_fields)
        );

}

include('./page_header_admin.'.$phpEx);

$phpbb2_template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>