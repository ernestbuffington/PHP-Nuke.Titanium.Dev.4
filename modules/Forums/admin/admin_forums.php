<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                             admin_forums.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_forums.php,v 1.40.2.12 2005/05/06 22:58:19 acydburn Exp
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
      Caching System                           v1.0.0       12/20/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Topic display order                      v1.0.2       06/15/2005
	  Simple Subforums                         v1.0.1
	  Colorize Forumtitle                      v1.0.0
	  Forumtitle as Weblink                    v1.2.2
	  Forum Icons                              v1.0.4
	  Thank You Mod                            v1.1.8
 ************************************************************************/
if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
        $file = basename(__FILE__);

        $module['Forums']['Manage'] = $file;

        return;
}

//
// Load default header
//
$phpbb_root_path = "./../";

require($phpbb_root_path . 'extension.inc');

require('./pagestart.' . $phpEx);

include("../../../includes/functions_admin.php");



$forum_auth_ary = array(
        "auth_view" => AUTH_ALL,
        "auth_read" => AUTH_ALL,
        "auth_post" => AUTH_REG,
        "auth_reply" => AUTH_REG,
        "auth_edit" => AUTH_REG,
        "auth_delete" => AUTH_REG,
        "auth_sticky" => AUTH_MOD,
        "auth_announce" => AUTH_MOD,
        "auth_vote" => AUTH_REG,
        "auth_pollcreate" => AUTH_REG
);

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

$forum_auth_ary['auth_attachments'] = AUTH_REG;

$forum_auth_ary['auth_download'] = AUTH_REG;

/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

//
// Mode setting
//
if( isset($_POST['mode']) || isset($HTTP_GET_VARS['mode']) )
{
        $mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $HTTP_GET_VARS['mode'];

        $mode = htmlspecialchars($mode);
}
else
{
        $mode = "";
}

// ------------------
// Begin function block
//
function get_info($mode, $id)
{
        global $db;

        switch($mode)
        {

                case 'category':

                        $table = CATEGORIES_TABLE;

                        $idfield = 'cat_id';

                        $namefield = 'cat_title';

                        break;



                case 'forum':

                        $table = FORUMS_TABLE;

                        $idfield = 'forum_id';

                        $namefield = 'forum_name';

                        break;



                default:

                        message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);

                        break;

        }

        $sql = "SELECT count(*) as total

                FROM $table";

        if( !$result = $db->sql_query($sql) )
        {
                message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);
        }

        $count = $db->sql_fetchrow($result);

        $count = $count['total'];



        $sql = "SELECT *

                FROM $table

                WHERE $idfield = $id";



        if( !$result = $db->sql_query($sql) )
        {
                message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);
        }

        if( $db->sql_numrows($result) != 1 )
        {
                message_die(GENERAL_ERROR, "Forum/Category doesn't exist or multiple forums/categories with ID $id", "", __LINE__, __FILE__);
        }

        $return = $db->sql_fetchrow($result);

        $return['number'] = $count;

        return $return;

}



function get_list($mode, $id, $select)

{
        global $db;

        switch($mode)
        {
                case 'category':

                        $table = CATEGORIES_TABLE;

                        $idfield = 'cat_id';

                        $namefield = 'cat_title';

                        break;


                case 'forum':

                        $table = FORUMS_TABLE;

                        $idfield = 'forum_id';

                        $namefield = 'forum_name';

                        break;


                default:

                        message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);

                        break;
        }


        $sql = "SELECT *

                FROM $table";

        if( $select == 0 )
        {
                $sql .= " WHERE $idfield <> $id";
        }

        if( !$result = $db->sql_query($sql) )
        {
                message_die(GENERAL_ERROR, "Couldn't get list of Categories/Forums", "", __LINE__, __FILE__, $sql);
        }

        $cat_list = "";

        while( $row = $db->sql_fetchrow($result) )
        {
                $s = "";

                if ($row[$idfield] == $id)
                {
                        $s = " selected=\"selected\"";
                }

                $catlist .= "<option value=\"$row[$idfield]\"$s>" . $row[$namefield] . "</option>\n";

        }

        return($catlist);
}

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
function get_list_cat($id, $parent, $forum_id)
{

	global $db;

	// Get categories

	$sql = 'SELECT * FROM ' . CATEGORIES_TABLE . ' ORDER BY cat_order ASC';

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't get list of categories", '', __LINE__, __FILE__, $sql);
	}

	$cat_list = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		$cat_list[] = $row;
	}

	$db->sql_freeresult($result);

	// Get all forums and check if forum has subforums
	$has_sub = false;

	$sql = 'SELECT forum_id, cat_id, forum_name, forum_parent FROM ' . FORUMS_TABLE . ' ORDER BY forum_order ASC';

	

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't get list of forums", '', __LINE__, __FILE__, $sql);
	}

	$forums_list = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		if( $row['forum_parent'] > 0 && $row['forum_parent'] == $forum_id )
		{
			$has_sub = true;
		}

		if( !$row['forum_parent'] )
		{
			$forums_list[] = $row;
		}
	}

	$db->sql_freeresult($result);

	// Generate select
	if(isset($cat_list)):
	for( $i = 0; $i < count($cat_list); $i++ )
	{
		$cat_id = $cat_list[$i]['cat_id'];

		$selected = ( $id == $cat_id && $parent == 0 ) ? ' selected="selected"' : '';
        $str = $str ?? '';
		$str .= '<option value="' . $cat_id . '"' . $selected . '>' . $cat_list[$i]['cat_title'] . '</option>';

		if( !$has_sub )
		{
			for( $j = 0; $j < count($forums_list); $j++)
			{

				if( $forums_list[$j]['cat_id'] == $cat_id && $forums_list[$j]['forum_id'] != $forum_id )
				{
					$forum_id2 = $forums_list[$j]['forum_id'];

					$selected = ( $id == $cat_id && $parent == $forum_id2 ) ? ' selected="selected"' : '';

					$str .= '<option value="' . $cat_id . ',' . $forum_id2 . '"' . $selected . '>- ' . $forums_list[$j]['forum_name'] . '</option>';
				}
			}
		}
	}
    endif;
	return $str;

}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

function renumber_order($mode, $cat = 0)
{

        global $db;

        switch($mode)
        {
                case 'category':

                        $table = CATEGORIES_TABLE;

                        $idfield = 'cat_id';

                        $orderfield = 'cat_order';

                        $cat = 0;

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                        global $cache;

                        $cache->delete('category_rows', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                        break;

                case 'forum':

                        $table = FORUMS_TABLE;

                        $idfield = 'forum_id';

                        $orderfield = 'forum_order';

                        $catfield = 'cat_id';

                        break;

                default:

                        message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);

                        break;
        }

        $sql = "SELECT * FROM $table";

        if( $cat != 0)
        {
                $sql .= " WHERE $catfield = $cat";
        }

        $sql .= " ORDER BY $orderfield ASC";

        if( !$result = $db->sql_query($sql) )
        {
                message_die(GENERAL_ERROR, "Couldn't get list of Categories", "", __LINE__, __FILE__, $sql);
        }

        $i = 10;

        $inc = 10;

        while( $row = $db->sql_fetchrow($result) )
        {

                $sql = "UPDATE $table

                        SET $orderfield = $i

                        WHERE $idfield = " . $row[$idfield];

                if( !$db->sql_query($sql) )
                {
                        message_die(GENERAL_ERROR, "Couldn't update order fields", "", __LINE__, __FILE__, $sql);
                }

                $i += 10;
        }

}
//
// End function block
// ------------------

//
// Begin program proper
//
if( isset($_POST['addforum']) || isset($_POST['addcategory']) )
{
        $mode = ( isset($_POST['addforum']) ) ? "addforum" : "addcat";

        if( $mode == "addforum" )
        {
                //list($cat_id) = each($_POST['addforum']);
				foreach (array_keys($_POST['addforum']) as $cat_id)

                $cat_id = intval($cat_id);

                //
                // stripslashes needs to be run on this because slashes are added when the forum name is posted
                //

                $forumname = stripslashes($_POST['forumname'][$cat_id]);
        }

}

if( !empty($_POST['password']) )
{
	if( !preg_match("#^[A-Za-z0-9]{3,20}$#si", $_POST['password']) )
	{
		message_die(GENERAL_MESSAGE, $lang['Only_alpha_num_chars']);
	}
}

if( !empty($mode) )
{
       switch($mode)
        {
                case 'addforum':

                case 'editforum':

                        //
                        // Show form to create/modify a forum
                        //
                        if ($mode == 'editforum')
                        {
                                // $newmode determines if we are going to INSERT or UPDATE after posting?
                                $l_title = $lang['Edit_forum'];

                                $newmode = 'modforum';

                                $buttonvalue = $lang['Update'];

                                $forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);

                                $row = get_info('forum', $forum_id);

                                $cat_id = $row['cat_id'];

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
								$parent_id = $row['forum_parent'];

/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                $forumname = $row['forum_name'];

                                $forumdesc = $row['forum_desc'];

                                $forumstatus = $row['forum_status'];
								$forum_password = $row['forum_password'];

/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
								$forumthank = $row['forum_thank'];
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
								$forumicon = $row['forum_icon'];
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
								$forum_is_link = $row['title_is_link'];

								$forum_weblink = $row['weblink'];

								$forum_link_icon = $row['forum_link_icon'];

								$forum_link_target = $row['forum_link_target'];
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 

/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                $forum_color = $row['forum_color'];
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                                $forum_display_sort = $row['forum_display_sort'];

                                $forum_display_order = $row['forum_display_order'];
/*****[END]********************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                                /*--FNA #1--*/
                                //
                                // start forum prune stuff.
                                //
                                if( $row['prune_enable'] )
                                {
                                       $prune_enabled = "checked=\"checked\"";

                                        $sql = "SELECT *

                                       FROM " . PRUNE_TABLE . "

                                       WHERE forum_id = $forum_id";

                                        if(!$pr_result = $db->sql_query($sql))
                                       {
                                                 message_die(GENERAL_ERROR, "Auto-Prune: Couldn't read auto_prune table.", __LINE__, __FILE__);

                                }
                                       $pr_row = $db->sql_fetchrow($pr_result);

                                }
                                else
                                {
                                        $prune_enabled = '';
                               }
                        }
                        else
                        {
                                $l_title = $lang['Create_forum'];

                                $newmode = 'createforum';

                                $buttonvalue = $lang['Create_forum'];

                                $forumdesc = '';
/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                $forum_color = '';
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                $forumstatus = FORUM_UNLOCKED;
								$forum_password = '';
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
								$forumthank = FORUM_UNTHANKABLE;
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
								$forumicon = '';
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                                $forum_display_sort = 0;

                                $forum_display_order = 0;
/*****[END]********************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                                $forum_id = '';

                                $prune_enabled = '';
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
								$parent_id = 0;
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                        }
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
						//$catlist = get_list('category', $cat_id, TRUE);
						$catlist = get_list_cat($cat_id, $parent_id, $forum_id);
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                        $forumstatus == ( FORUM_LOCKED ) ? $forumlocked = "selected=\"selected\"" : $forumunlocked = "selected=\"selected\"";
/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                        $forum_color = ( empty($forum_color) ) ? '' : $forum_color;
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                        // These two options ($lang['Status_unlocked'] and $lang['Status_locked']) seem to be missing from
                        // the language files.
						$forumunlocked = $forumunlocked ?? '';
						$forumlocked = $forumlocked ?? '';
                        $lang['Status_unlocked'] = isset($lang['Status_unlocked']) ? $lang['Status_unlocked'] : 'Unlocked';

                        $lang['Status_locked'] = isset($lang['Status_locked']) ? $lang['Status_locked'] : 'Locked';

                        $statuslist = "<option value=\"" . FORUM_UNLOCKED . "\" $forumunlocked>" . $lang['Status_unlocked'] . "</option>\n";

                        $statuslist .= "<option value=\"" . FORUM_LOCKED . "\" $forumlocked>" . $lang['Status_locked'] . "</option>\n";
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
						$thank_yes = ($forumthank) ? 'checked="checked"' : '';

						$thank_no = (!$forumthank) ? 'checked="checked"' : '';
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
                        $template->set_filenames(array(

                                "body" => "admin/forum_edit_body.tpl")

                        );
/*****[BEGIN]******************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                        $forum_display_sort_list = get_forum_display_sort_option($forum_display_sort, 'list', 'sort');

                        $forum_display_order_list = get_forum_display_sort_option($forum_display_order, 'list', 'order');
/*****[END]********************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode .'" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
                        /*--FNA #2--*/
						if(!isset($forum_is_link))
						$forum_is_link = '';
						if(!isset($forum_weblink))
                        $forum_weblink = '';
						if(!isset($forum_link_icon))
                        $forum_link_icon = '';
						
                        $template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                                'L_FORUM_DISPLAY_SORT'        => $lang['Sort_by'],
                                'S_FORUM_DISPLAY_SORT_LIST'        => $forum_display_sort_list,
                                'S_FORUM_DISPLAY_ORDER_LIST'    => $forum_display_order_list,
/*****[END]********************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
                                'S_HIDDEN_FIELDS' => $s_hidden_fields,
                                'S_SUBMIT_VALUE' => $buttonvalue,
                                'S_CAT_LIST' => $catlist,
                                'S_STATUS_LIST' => $statuslist,
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
                                'THANK_ENABLE' => $thank_yes,
                                'THANK_DISABLE' => $thank_no,
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
                                'S_PRUNE_ENABLED' => $prune_enabled,
                                'L_FORUM_TITLE' => $l_title,
/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
								'L_FORUM_IS_LINK' => $lang['Forum_is_link'],
								'L_FORUM_WEBLINK' => $lang['Forum_weblink'],
								'L_FORUM_LINK_ICON' => $lang['Forum_link_icon'],
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 

/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                'L_FORUM_COLOR' => $lang['Forum_color'],
                                'L_FORUM_COLOR_EXPLAIN' => $lang['Forum_color_explain'],
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                'L_FORUM_EXPLAIN' => $lang['Forum_edit_delete_explain'],
                                'L_FORUM_SETTINGS' => $lang['Forum_settings'],
                                'L_FORUM_NAME' => $lang['Forum_name'],
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
								//'L_CATEGORY' => $lang['Category'],
								'L_CATEGORY' => $lang['Category'] . ' / ' . $lang['Forum'],
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                                'L_FORUM_DESCRIPTION' => $lang['Forum_desc'],
                                'L_FORUM_STATUS' => $lang['Forum_status'],
								'L_PASSWORD' => $lang['Forum_password'],
/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
								'L_FORUM_THANK' => $lang['use_thank'],
								'L_YES' => $lang['Yes'],
								'L_NO' => $lang['No'],
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
								'L_FORUM_ICON' => $lang['Forum_icon'],
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
                                'L_AUTO_PRUNE' => $lang['Forum_pruning'],
                                'L_ENABLED' => $lang['Enabled'],
                                'L_PRUNE_DAYS' => $lang['prune_days'],
                                'L_PRUNE_FREQ' => $lang['prune_freq'],
                                'L_DAYS' => $lang['Days'],
                                'PRUNE_DAYS' => ( isset($pr_row['prune_days']) ) ? $pr_row['prune_days'] : 7,
                                'PRUNE_FREQ' => ( isset($pr_row['prune_freq']) ) ? $pr_row['prune_freq'] : 1,
                                'FORUM_NAME' => $forumname,
								'FORUM_PASSWORD' => $forum_password,
/*****[BEGIN]******************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/
                                'FORUM_COLOR' => $forum_color,
/*****[END]********************************************
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
								'DESCRIPTION' => $forumdesc,
								'FORUM_IS_LINK' => ($forum_is_link) ? 'checked="checked"' : '',
								'FORUM_WEBLINK' => ($forum_weblink) ? $forum_weblink : 'http://',
								'FORUM_LINK_ICON' => $forum_link_icon,
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
								'ICON' => ( $forumicon ) ? $forumicon : '', 
								'ICON_DISPLAY' => ( $forumicon ) ? '<img src="' . $phpbb_root_path . $forumicon . '" />' : '')
/*****[END]********************************************
 [ Mod:     Forum Icons                        v1.0.4 ]
 ******************************************************/
                        );

                        $template->pparse("body");

                        break;

                case 'createforum':
                        //
                        // Create a forum in the DB
                        //
                        if( trim($_POST['forumname']) == "" )
                        {
                                message_die(GENERAL_ERROR, "Can't create a forum without a name");
                        }
                        $sql = "SELECT MAX(forum_order) AS max_order

                                FROM " . FORUMS_TABLE . "

                                WHERE cat_id = " . intval($_POST[POST_CAT_URL]);

                        if( !$result = $db->sql_query($sql) )
                        {

                                message_die(GENERAL_ERROR, "Couldn't get order number from forums table", "", __LINE__, __FILE__, $sql);

                        }

                        $row = $db->sql_fetchrow($result);



                        $max_order = $row['max_order'];

                        $next_order = $max_order + 10;



                        $sql = "SELECT MAX(forum_id) AS max_id

                                FROM " . FORUMS_TABLE;

                        if( !$result = $db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't get order number from forums table", "", __LINE__, __FILE__, $sql);
                        }

                        $row = $db->sql_fetchrow($result);



                        $max_id = $row['max_id'];

                        $next_id = $max_id + 1;
                        //
                        // Default permissions of public ::
                        //
                        $field_sql = "";

                        $value_sql = "";

                        //while( list($field, $value) = each($forum_auth_ary) )
						foreach ($forum_auth_ary as $field => $value)
                        {
                                $field_sql .= ", $field";

                                $value_sql .= ", $value";
                        }
/*****[BEGIN]******************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                        $field_sql .= ', forum_display_sort';

                        $value_sql .= ', ' . intval($_POST['forum_display_sort']);

                        $field_sql .= ', forum_display_order';

                        $value_sql .= ', ' . intval($_POST['forum_display_order']);
/*****[END]********************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
						$forum_is_link = (empty($forum_is_link)) ? 0 : $forum_is_link;
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
                        // There is no problem having duplicate forum names so we won't check for it.
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 [ Mod:    Forum Icons                         v1.0.4 ]
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
						$list = explode(',', $_POST[POST_CAT_URL]);

						$new_cat = ( count($list) ) ? intval($list[0]) : intval($_POST[POST_CAT_URL]);

						$new_parent = ( isset($list[1]) ) ? intval($list[1]) : 0;
                        
						if(!isset($_POST['forum_is_link']))
                        $_POST['forum_is_link'] = '';
						
						if(!isset($_POST['forum_link_target']))
						$_POST['forum_link_target'] = '';

						if(!isset($_POST['prune_enable']))
						$_POST['prune_enable'] = '';
						
						$sql = "INSERT INTO " . FORUMS_TABLE . " (forum_id, 
						                                        forum_name, 
															 title_is_link, 
															       weblink, 
														   forum_link_icon, 
														 forum_link_target, 
														       forum_color, 
															        cat_id, 
															  forum_parent, 
															    forum_desc, 
															   forum_order, 
															  forum_status, 
															forum_password, 
															    forum_icon, 
															  prune_enable" . $field_sql . ", forum_thank)

                                    VALUES ('" . $next_id . "', 
	    '" . str_replace("\'", "''", $_POST['forumname']) . "', 
	                   " . intval($_POST['forum_is_link']) . ", 
	'" . str_replace("\'", "''", $_POST['forum_weblink']) . "', 
  '" . str_replace("\'", "''", $_POST['forum_link_icon']) . "', 
                   " . intval($_POST['forum_link_target']) . ", 
	  '" . str_replace("\'", "''", $_POST['forum_color']) . "', 
	                                          " . $new_cat . ', 
										   ' . $new_parent . ", 
		'" . str_replace("\'", "''", $_POST['forumdesc']) . "', 
		    $next_order, " . intval($_POST['forumstatus']) . ", 
		 '" . str_replace("\'", "''", $_POST['password']) . "', 
		'" . str_replace("\'", "''", $_POST['forumicon']) . "', 
		   " . intval($_POST['prune_enable']) . $value_sql . ", 
		                  " . intval($_POST['forumthank']) . ")";
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 [ Mod:    Forum Icons                         v1.0.4 ]
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                        if( !$result = $db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't insert row in forums table", "", __LINE__, __FILE__, $sql);
                        }

                        if( $_POST['prune_enable'] )
                        {
                                if( empty($_POST['prune_days']) || empty($_POST['prune_freq']) )
                                {
                                        message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
                                }

                                $sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)

                                        VALUES('" . $next_id . "', " . intval($_POST['prune_days']) . ", " . intval($_POST['prune_freq']) . ")";

                                if( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, "Couldn't insert row in prune table", "", __LINE__, __FILE__, $sql);
                                }
                        }

                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

                        message_die(GENERAL_MESSAGE, $message);

                        break;

                case 'modforum':

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
						$forum_id = intval($_POST[POST_FORUM_URL]);

						$row = get_info('forum', $forum_id);

						$list = explode(',', $_POST[POST_CAT_URL]);

						$new_cat = ( count($list) ) ? intval($list[0]) : intval($_POST[POST_CAT_URL]);

						$new_parent = ( isset($list[1]) ) ? intval($list[1]) : 0;

						if( !$row['forum_parent'] && $row['cat_id'] !== $new_cat )
						{
							// Move subforums to new category
							$sql = "UPDATE " . FORUMS_TABLE . " SET cat_id='$new_cat' WHERE forum_parent='$forum_id'";

							$db->sql_query($sql);
						}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                        /*--FNA #3--*/
                        // Modify a forum in the DB
                        if( isset($_POST['prune_enable']))
                        {
                                if( $_POST['prune_enable'] != 1 )
                                {
                                        $_POST['prune_enable'] = 0;
                                }
                        }
/*****[BEGIN]******************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 [ Mod:    Forum Icons                         v1.0.4 ]
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
                        $sql = "UPDATE " . FORUMS_TABLE . "

                        SET forum_name = '" . str_replace("\'", "''", (string) $_POST['forumname']) . "', 
						title_is_link = " . intval($_POST['forum_is_link'] = $_POST['forum_is_link'] ?? '') . ", 
						weblink = '" . str_replace("\'", "''", (string) $_POST['forum_weblink']) . "', 
						forum_link_icon = '" . str_replace("\'", "''", (string) $_POST['forum_link_icon']) . "', 
						forum_link_target = " . intval($_POST['forum_link_target'] = $_POST['forum_link_target'] ?? '') . ", 
						forum_color = '" . str_replace("\'", "''", (string) $_POST['forum_color']) . "', 
						cat_id = $new_cat, forum_parent = $new_parent, 
						forum_desc = '" . str_replace("\'", "''", (string) $_POST['forumdesc']) . "', 
						forum_status = " . intval($_POST['forumstatus']) . ", 
						forum_password = '" . str_replace("\'", "''", (string) $_POST['password']) . "', 
						forum_icon = '" . str_replace("\'", "''", (string) $_POST['forumicon']) . "', 
						forum_display_order = " . intval($_POST['forum_display_order']) . ", 
						forum_display_sort = " . intval($_POST['forum_display_sort'] = $_POST['forum_display_sort'] ?? '') . ", 
						prune_enable = " . intval($_POST['prune_enable'] = $_POST['prune_enable'] ?? '0') . ", 
						forum_thank = " . intval($_POST['forumthank']) . "


                        WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 [ Mod:    Forum Icons                         v1.0.4 ]
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 [ Mod:    Colorize Forumtitle                 v1.0.0 ]
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
                        if( !$result = $db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);
                        }

                        if( $_POST['prune_enable'] == 1 )
                        {
                                if( empty($_POST['prune_days']) || empty($_POST['prune_freq']) )
                                {
                                        message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
                                }

                                $sql = "SELECT *

                                        FROM " . PRUNE_TABLE . "

                                        WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);

                                if( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, "Couldn't get forum Prune Information","",__LINE__, __FILE__, $sql);
                                }

                                if( $db->sql_numrows($result) > 0 )
                                {
                                        $sql = "UPDATE " . PRUNE_TABLE . "

                                                SET        prune_days = " . intval($_POST['prune_days']) . ",        prune_freq = " . intval($_POST['prune_freq']) . "

                                                 WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);
                                }
                                else
                                {

                                        $sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)

                                                VALUES(" . intval($_POST[POST_FORUM_URL]) . ", " . intval($_POST['prune_days']) . ", " . intval($_POST['prune_freq']) . ")";

                                }



                               if( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, "Couldn't Update Forum Prune Information","",__LINE__, __FILE__, $sql);
                                }
                        }

                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

                        message_die(GENERAL_MESSAGE, $message);

                        break;

                case 'addcat':

                        // Create a category in the DB
                        if( trim($_POST['categoryname']) == '')
                        {
                                message_die(GENERAL_ERROR, "Can't create a category without a name");
                        }

                        $sql = "SELECT MAX(cat_order) AS max_order

                                FROM " . CATEGORIES_TABLE;

                        if( !$result = $db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't get order number from categories table", "", __LINE__, __FILE__, $sql);
                        }

                        $row = $db->sql_fetchrow($result);

                        $max_order = $row['max_order'];

                        $next_order = $max_order + 10;
                        //
                        // There is no problem having duplicate forum names so we won't check for it.
                        //
                        $sql = "INSERT INTO " . CATEGORIES_TABLE . " (cat_title, cat_order)

                                VALUES ('" . str_replace("\'", "''", $_POST['categoryname']) . "', $next_order)";

                        if( !$result = $db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't insert row in categories table", "", __LINE__, __FILE__, $sql);
                        }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                        global $cache;

                        $cache->delete('category_rows', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;

                case 'editcat':

                        //
                        // Show form to edit a category
                        //
                        $newmode = 'modcat';

                        $buttonvalue = $lang['Update'];

                        $cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);

                        $row = get_info('category', $cat_id);

                        $cat_title = $row['cat_title'];

                        $template->set_filenames(array(

                                "body" => "admin/category_edit_body.tpl")

                        );



                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $cat_id . '" />';



                        $template->assign_vars(array(

                                'CAT_TITLE' => $cat_title,



                                'L_EDIT_CATEGORY' => $lang['Edit_Category'],

                                'L_EDIT_CATEGORY_EXPLAIN' => $lang['Edit_Category_explain'],

                                'L_CATEGORY' => $lang['Category'],



                                'S_HIDDEN_FIELDS' => $s_hidden_fields,

                                'S_SUBMIT_VALUE' => $buttonvalue,

                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"))

                        );



                        $template->pparse("body");

                        break;



                case 'modcat':

                        // Modify a category in the DB

                        $sql = "UPDATE " . CATEGORIES_TABLE . "

                                SET cat_title = '" . str_replace("\'", "''", $_POST['cat_title']) . "'

                                WHERE cat_id = " . intval($_POST[POST_CAT_URL]);

                        if( !$result = $db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);
                        }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                        global $cache;

                        $cache->delete('category_rows', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

                        message_die(GENERAL_MESSAGE, $message);

                        break;

                case 'deleteforum':

                        // Show form to delete a forum
                        $forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);

                        $select_to = '<select name="to_id">';

                        $select_to .= "<option value=\"-1\"$s>" . $lang['Delete_all_posts'] . "</option>\n";

                        $select_to .= get_list('forum', $forum_id, 0);

                        $select_to .= '</select>';

                        $buttonvalue = $lang['Move_and_Delete'];

                        $newmode = 'movedelforum';

                        $foruminfo = get_info('forum', $forum_id);

                        $name = $foruminfo['forum_name'];

                        $template->set_filenames(array(

                                "body" => "admin/forum_delete_body.tpl")

                        );

                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $forum_id . '" />';

                        $template->assign_vars(array(

                                'NAME' => $name,

                                'L_FORUM_DELETE' => $lang['Forum_delete'],

                                'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'],

                                'L_MOVE_CONTENTS' => $lang['Move_contents'],

                                'L_FORUM_NAME' => $lang['Forum_name'],

                                "S_HIDDEN_FIELDS" => $s_hidden_fields,

                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),

                                'S_SELECT_TO' => $select_to,

                                'S_SUBMIT_VALUE' => $buttonvalue)

                        );

                        $template->pparse("body");

                        break;

                case 'movedelforum':

                        //
                        // Move or delete a forum in the DB
                        //
                        $from_id = intval($_POST['from_id']);

                        $to_id = intval($_POST['to_id']);

                        $delete_old = intval($_POST['delete_old']);

                        // Either delete or move all posts in a forum
                        if($to_id == -1)
                        {

                                // Delete polls in this forum
                                $sql = "SELECT v.vote_id

                                        FROM " . VOTE_DESC_TABLE . " v, " . TOPICS_TABLE . " t

                                        WHERE t.forum_id = $from_id

                                                AND v.topic_id = t.topic_id";

                                if (!($result = $db->sql_query($sql)))
                                {
                                        message_die(GENERAL_ERROR, "Couldn't obtain list of vote ids", "", __LINE__, __FILE__, $sql);
                                }

                                if ($row = $db->sql_fetchrow($result))
                                {

                                        $vote_ids = '';

                                        do
                                        {
                                                $vote_ids .= (($vote_ids != '') ? ', ' : '') . $row['vote_id'];
                                        }

                                        while ($row = $db->sql_fetchrow($result));

                                        $sql = "DELETE FROM " . VOTE_DESC_TABLE . "

                                                WHERE vote_id IN ($vote_ids)";

                                        $db->sql_query($sql);



                                        $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "

                                                WHERE vote_id IN ($vote_ids)";

                                        $db->sql_query($sql);



                                        $sql = "DELETE FROM " . VOTE_USERS_TABLE . "

                                                WHERE vote_id IN ($vote_ids)";

                                        $db->sql_query($sql);

                                }

                                $db->sql_freeresult($result);



                                include("../../../includes/prune.php");

                                prune($from_id, 0, true); // Delete everything from forum

                        }

                        else

                        {

                                $sql = "SELECT *

                                        FROM " . FORUMS_TABLE . "

                                        WHERE forum_id IN ($from_id, $to_id)";

                                if( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, "Couldn't verify existence of forums", "", __LINE__, __FILE__, $sql);
                                }

                                if($db->sql_numrows($result) != 2)
                                {
                                        message_die(GENERAL_ERROR, "Ambiguous forum ID's", "", __LINE__, __FILE__);
                                }

                                $sql = "UPDATE " . TOPICS_TABLE . "

                                        SET forum_id = $to_id

                                        WHERE forum_id = $from_id";

                                if( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, "Couldn't move topics to other forum", "", __LINE__, __FILE__, $sql);
                                }

                                $sql = "UPDATE " . POSTS_TABLE . "

                                        SET        forum_id = $to_id

                                        WHERE forum_id = $from_id";

                               if( !$result = $db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, "Couldn't move posts to other forum", "", __LINE__, __FILE__, $sql);
                                }

                                sync('forum', $to_id);

                        }

                        // Alter Mod level if appropriate - 2.0.4

                        $sql = "SELECT ug.user_id

                                FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug

                                WHERE a.forum_id <> $from_id

                                        AND a.auth_mod = 1

                                        AND ug.group_id = a.group_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);

                        }



                        if ($row = $db->sql_fetchrow($result))

                        {

                                $user_ids = '';

                                do

                                {

                                        $user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];

                                }

                                while ($row = $db->sql_fetchrow($result));



                                $sql = "SELECT ug.user_id

                                        FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug

                                        WHERE a.forum_id = $from_id

                                                AND a.auth_mod = 1

                                                AND ug.group_id = a.group_id

                                                AND ug.user_id NOT IN ($user_ids)";

                                if( !$result2 = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);

                                }



                                if ($row = $db->sql_fetchrow($result2))

                                {

                                        $user_ids = '';

                                        do

                                        {

                                                $user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];

                                        }

                                        while ($row = $db->sql_fetchrow($result2));



                                        $sql = "UPDATE " . USERS_TABLE . "

                                                SET user_level = " . USER . "

                                                WHERE user_id IN ($user_ids)

                                                        AND user_level <> " . ADMIN;

                                        $db->sql_query($sql);

                                }

                                $db->sql_freeresult($result);



                        }

                        $db->sql_freeresult($result2);



                        $sql = "DELETE FROM " . FORUMS_TABLE . "

                                WHERE forum_id = $from_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);

                        }



/*****[BEGIN]******************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/

						// Move subforums to category

						$sql = "UPDATE " . FORUMS_TABLE . " SET forum_parent = '0' WHERE forum_parent = '$from_id'";

						$db->sql_query($sql);

/*****[END]********************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/



                        $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "

                                WHERE forum_id = $from_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);

                        }



                        $sql = "DELETE FROM " . PRUNE_TABLE . "

                                WHERE forum_id = $from_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete forum prune information!", "", __LINE__, __FILE__, $sql);

                        }



                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'deletecat':

                        //

                        // Show form to delete a category

                        //

                        $cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);



                        $buttonvalue = $lang['Move_and_Delete'];

                        $newmode = 'movedelcat';

                        $catinfo = get_info('category', $cat_id);

                        $name = $catinfo['cat_title'];



                        if ($catinfo['number'] == 1)

                        {

                                $sql = "SELECT count(*) as total

                                        FROM ". FORUMS_TABLE;

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't get Forum count", "", __LINE__, __FILE__, $sql);

                                }

                                $count = $db->sql_fetchrow($result);

                                $count = $count['total'];



                                if ($count > 0)

                                {

                                        message_die(GENERAL_ERROR, $lang['Must_delete_forums']);

                                }

                                else

                                {

                                        $select_to = $lang['Nowhere_to_move'];

                                }

                        }

                        else

                        {

                                $select_to = '<select name="to_id">';

                                $select_to .= get_list('category', $cat_id, 0);

                                $select_to .= '</select>';

                        }



                        $template->set_filenames(array(

                                "body" => "admin/forum_delete_body.tpl")

                        );



                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $cat_id . '" />';



                        $template->assign_vars(array(

                                'NAME' => $name,



                                'L_FORUM_DELETE' => $lang['Forum_delete'],

                                'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'],

                                'L_MOVE_CONTENTS' => $lang['Move_contents'],

                                'L_FORUM_NAME' => $lang['Forum_name'],



                                'S_HIDDEN_FIELDS' => $s_hidden_fields,

                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),

                                'S_SELECT_TO' => $select_to,

                                'S_SUBMIT_VALUE' => $buttonvalue)

                        );



                        $template->pparse("body");

                        break;



                case 'movedelcat':

                        //

                        // Move or delete a category in the DB

                        //

                        $from_id = intval($_POST['from_id']);

                        $to_id = intval($_POST['to_id']);



                        if (!empty($to_id))

                        {

                                $sql = "SELECT *

                                        FROM " . CATEGORIES_TABLE . "

                                        WHERE cat_id IN ($from_id, $to_id)";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't verify existence of categories", "", __LINE__, __FILE__, $sql);

                                }

                                if($db->sql_numrows($result) != 2)

                                {

                                        message_die(GENERAL_ERROR, "Ambiguous category ID's", "", __LINE__, __FILE__);

                                }



                                $sql = "UPDATE " . FORUMS_TABLE . "

                                        SET cat_id = $to_id

                                        WHERE cat_id = $from_id";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't move forums to other category", "", __LINE__, __FILE__, $sql);

                                }

                        }



                        $sql = "DELETE FROM " . CATEGORIES_TABLE ."

                                WHERE cat_id = $from_id";



                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete category", "", __LINE__, __FILE__, $sql);

                        }

/*****[BEGIN]******************************************

 [ Base:    Caching System                     v3.0.0 ]

 ******************************************************/

                        global $cache;

                        $cache->delete('category_rows', 'config');

/*****[END]********************************************

 [ Base:    Caching System                     v3.0.0 ]

 ******************************************************/

                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'forum_order':

                        //

                        // Change order of forums in the DB

                        //

                        $move = intval($HTTP_GET_VARS['move']);

                        $forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);



                        $forum_info = get_info('forum', $forum_id);



                        $cat_id = $forum_info['cat_id'];



/*****[BEGIN]******************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/

						if( !$forum_info['forum_parent'] )

						{

							// Find previous/next forum

							if( $move > 0 )

							{

								$sql = "SELECT forum_id, forum_order FROM " . FORUMS_TABLE . " WHERE cat_id = '$cat_id' AND forum_parent = '0' AND forum_order > '" . $forum_info['forum_order'] . "' ORDER BY forum_order ASC";

							}

							

							else

							{

								$sql = "SELECT forum_id, forum_order FROM " . FORUMS_TABLE . " WHERE cat_id = '$cat_id' AND forum_parent = '0' AND forum_order < '" . $forum_info['forum_order'] . "' ORDER BY forum_order DESC";

							}

							

							if( !($result = $db->sql_query($sql)) )

							{

								message_die(GENERAL_ERROR, "Couldn't change category order", '', __LINE__, __FILE__, $sql);

							}

							

							$row = $db->sql_fetchrow($result);

							$db->sql_freeresult($result);

							if($row !== false)

							{

								// Swap forum orders

								$sql = "UPDATE " . FORUMS_TABLE . " SET forum_order = '" . $row['forum_order'] . "' WHERE forum_id = '$forum_id'";

								$db->sql_query($sql);

								

								$sql = "UPDATE " . FORUMS_TABLE . " SET forum_order = '" . $forum_info['forum_order'] . "' WHERE forum_id = '" . $row['forum_id'] . "'";

								$db->sql_query($sql);

							}

						}

						

						else

						{

/*****[END]********************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/



                        $sql = "UPDATE " . FORUMS_TABLE . "

                                SET forum_order = forum_order + $move

                                WHERE forum_id = $forum_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't change category order", "", __LINE__, __FILE__, $sql);

                        }



                        renumber_order('forum', $forum_info['cat_id']);

/*****[BEGIN]******************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/

			}

/*****[END]********************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/

                        $show_index = TRUE;



                        break;



                case 'cat_order':

                        //

                        // Change order of categories in the DB

                        //

                        $move = intval($HTTP_GET_VARS['move']);

                        $cat_id = intval($HTTP_GET_VARS[POST_CAT_URL]);



                        $sql = "UPDATE " . CATEGORIES_TABLE . "

                                SET cat_order = cat_order + $move

                                WHERE cat_id = $cat_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't change category order", "", __LINE__, __FILE__, $sql);

                        }

/*****[BEGIN]******************************************

 [ Base:    Caching System                     v3.0.0 ]

 ******************************************************/

                        global $cache;

                        $cache->delete('category_rows', 'config');

/*****[END]********************************************

 [ Base:    Caching System                     v3.0.0 ]

 ******************************************************/

                        renumber_order('category');

                        $show_index = TRUE;



                        break;



                case 'forum_sync':

                        sync('forum', intval($HTTP_GET_VARS[POST_FORUM_URL]));

                        $show_index = TRUE;



                        break;



                default:

                        message_die(GENERAL_MESSAGE, $lang['No_mode']);

                        break;

        }



        if (isset($show_index) && $show_index != TRUE)

        {

                include('./page_footer_admin.'.$phpEx);

                exit;

        }

}



//

// Start page proper

//

$template->set_filenames(array(

        "body" => "admin/forum_admin_body.tpl")

);



$template->assign_vars(array(

        'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),

        'L_FORUM_TITLE' => $lang['Forum_admin'],

        'L_FORUM_EXPLAIN' => $lang['Forum_admin_explain'],

        'L_CREATE_FORUM' => $lang['Create_forum'],

        'L_CREATE_CATEGORY' => $lang['Create_category'],

        'L_EDIT' => $lang['Edit'],

        'L_DELETE' => $lang['Delete'],

        'L_MOVE_UP' => $lang['Move_up'],

        'L_MOVE_DOWN' => $lang['Move_down'],

        'L_RESYNC' => $lang['Resync'])

);



$sql = "SELECT cat_id, cat_title, cat_order

        FROM " . CATEGORIES_TABLE . "

        ORDER BY cat_order";

if( !$q_categories = $db->sql_query($sql) )

{

        message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);

}



if( $total_categories = $db->sql_numrows($q_categories) )

{

        $category_rows = $db->sql_fetchrowset($q_categories);



        $sql = "SELECT *

                FROM " . FORUMS_TABLE . "

                ORDER BY cat_id, forum_order";

        if(!$q_forums = $db->sql_query($sql))

        {

                message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);

        }



        if( $total_forums = $db->sql_numrows($q_forums) )

        {

                $forum_rows = $db->sql_fetchrowset($q_forums);

        }



        //

        // Okay, let's build the index

        //

        $gen_cat = array();



        for($i = 0; $i < $total_categories; $i++)

        {

                $cat_id = $category_rows[$i]['cat_id'];



                $template->assign_block_vars("catrow", array(

                        'S_ADD_FORUM_SUBMIT' => "addforum[$cat_id]",

                        'S_ADD_FORUM_NAME' => "forumname[$cat_id]",



                        'CAT_ID' => $cat_id,

                        'CAT_DESC' => $category_rows[$i]['cat_title'],



                        'U_CAT_EDIT' => append_sid("admin_forums.$phpEx?mode=editcat&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_CAT_DELETE' => append_sid("admin_forums.$phpEx?mode=deletecat&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_CAT_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=-15&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_CAT_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=15&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_VIEWCAT' => ("../../../modules.php?name=Forums&file=index&c=$cat_id"))

                );



                for($j = 0; $j < $total_forums; $j++)

                {

                        $forum_id = $forum_rows[$j]['forum_id'];



                        if ($forum_rows[$j]['cat_id'] == $cat_id && $forum_rows[$j]['forum_parent'] == 0)

                        {



                                $template->assign_block_vars("catrow.forumrow",        array(

                                        'FORUM_NAME' => $forum_rows[$j]['forum_name'],

/*****[BEGIN]******************************************

 [ Mod:    Colorize Forumtitle                 v1.0.0 ]

 ******************************************************/

                                        'FORUM_COLOR' => ( $forum_rows[$j]['forum_color'] != '' ) ? 'style="font-weight:bold; color: #'.$forum_rows[$j]['forum_color'].'"' : '',

/*****[END]********************************************

 [ Mod:    Colorize Forumtitle                 v1.0.0 ]

 ******************************************************/

                                        'FORUM_DESC' => $forum_rows[$j]['forum_desc'],

/*****[BEGIN]******************************************

 [ Mod:     Forum Icons                        v1.0.4 ]

 ******************************************************/

										'FORUM_ICON_IMG' => ( $forum_rows[$j]['forum_icon'] ) ? '<img src="' . $phpbb_root_path . $forum_rows[$j]['forum_icon'] . '" alt="'.$forum_data[$j]['forum_name'] = $forum_data[$j]['forum_name'] ?? ''.'" title="'.$forum_data[$j]['forum_name'] = $forum_data[$j]['forum_name'] ?? ''.'" />' : '',

/*****[END]********************************************

 [ Mod:     Forum Icons                        v1.0.4 ]

 ******************************************************/

                                        'ROW_COLOR' => $row_color = $row_color ?? '',

/*****[BEGIN]******************************************

 [ Mod:    Forumtitle as Weblink               v1.2.2 ]

 ******************************************************/ 

										'NUM_TOPICS' => ($forum_rows[$j]['forum_link_icon'] && $forum_rows[$j]['title_is_link']) ? ((substr($forum_rows[$j]['forum_link_icon'],0,4) == 'http' || substr($forum_rows[$j]['forum_link_icon'],0,4) == 'HTTP' ) ? '<img src="'.$forum_rows[$j]['forum_link_icon'].'" border="0">' : '<img src="./../' . $forum_rows[$j]['forum_link_icon'] . '" border="0">') : $forum_rows[$j]['forum_topics'],

										'NUM_POSTS' => ($forum_rows[$j]['forum_link_icon'] && $forum_rows[$j]['title_is_link']) ? '' : $forum_rows[$j]['forum_posts'],



										'U_VIEWFORUM' => ($forum_rows[$j]['title_is_link']) ? $forum_rows[$j]['weblink'] : ("../../../modules.php?name=Forums&file=viewforum&amp;" . POST_FORUM_URL . "=$forum_id"),

/*****[END]********************************************

 [ Mod:    Forumtitle as Weblink               v1.2.2 ]

 ******************************************************/ 

                                        'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$forum_id"),

                                        'U_FORUM_DELETE' => append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$forum_id"),

                                        'U_FORUM_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$forum_id"),

                                        'U_FORUM_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$forum_id"),

                                        'U_FORUM_RESYNC' => append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$forum_id"))

                                );

/*****[BEGIN]******************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/

								for( $k = 0; $k < $total_forums; $k++ )

								{

									$forum_id2 = $forum_rows[$k]['forum_id'];

									if ( $forum_rows[$k]['forum_parent'] == $forum_id )

									{

										$template->assign_block_vars("catrow.forumrow",	array(

											'FORUM_NAME' => $forum_rows[$k]['forum_name'],

/*****[BEGIN]******************************************

 [ Mod:    Colorize Forumtitle                 v1.0.0 ]

 ******************************************************/

                                        	'FORUM_COLOR' => ( $forum_rows[$k]['forum_color'] != '' ) ? 'style="font-weight:bold; color: #'.$forum_rows[$k]['forum_color'].'"' : '',

/*****[END]********************************************

 [ Mod:    Colorize Forumtitle                 v1.0.0 ]

 ******************************************************/

											'FORUM_DESC' => $forum_rows[$k]['forum_desc'],

											'ROW_COLOR' => $row_color,

											'NUM_TOPICS' => $forum_rows[$k]['forum_topics'],

											'NUM_POSTS' => $forum_rows[$k]['forum_posts'],

											'STYLE' => ' style="padding-left: 20px;" ',



											'U_VIEWFORUM' => ("../../../modules.php?name=Forums&file=viewforum&amp;" . POST_FORUM_URL . "=$forum_id2"),

											'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$forum_id2"),

											'U_FORUM_DELETE' => append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$forum_id2"),

											'U_FORUM_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$forum_id2"),

											'U_FORUM_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$forum_id2"),

											'U_FORUM_RESYNC' => append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$forum_id2"))

										);



									}



								} // for ... forums

/*****[END]********************************************

 [ Mod:    Simple Subforums                    v1.0.1 ]

 ******************************************************/



                        }// if ... forumid == catid



                } // for ... forums



        } // for ... categories



}// if ... total_categories



$template->pparse("body");



include('./page_footer_admin.'.$phpEx);



?>
