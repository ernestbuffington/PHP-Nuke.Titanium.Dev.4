<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                               functions.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: functions.php,v 1.133.2.35 2005/07/19 20:01:11 acydburn Exp
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
      Advanced Username Color                  v1.0.5       06/11/2005
      Simply Merge Threads                     v1.0.1       06/12/2005
      Global Announcements                     v1.2.8       06/13/2005
      Topic display order                      v1.0.2       06/15/2005
      Ranks summarize                          v1.0.4       06/24/2005
      Goto Specific Page                       v1.0.0       06/24/2005
      Advanced Time Management                 v2.2.0       07/26/2005
      XData                                    v1.0.3       02/08/2007
      At a Glance Options                      v1.0.0       08/17/2005
      Log Actions Mod - Topic View             v2.0.0       09/18/2005
      Remote Avatar Resize                     v1.1.4       11/19/2005
	  Forumtitle as Weblink                    v1.2.2
	  Thank You Mod                            v1.1.8
	  Post Icons                               v1.0.1
-=[Last Updated]=-
      12/12/2022 10:51 am Ernest Allen Buffington      	  
 ************************************************************************/

if (!defined('IN_PHPBB') && !defined('NUKE_EVO'))
{
    die('Hacking attempt');
}

/**
* set_var
*
* Set variable, used by {@link request_var the request_var function}
*
* @access: private
*/
function set_var(&$result, $var, $type, $multibyte = false)
{

	settype($var, $type);

	$result = $var;

	if ($type == 'string')
	{
		$result = trim(htmlspecialchars(str_replace(["\r\n", "\r"], ["\n", "\n"], (string) $result)));

		//$result = (STRIP) ? stripslashes($result) : $result;
		// Check for possible multibyte characters to save a preg_replace call if nothing is in there...
		if ($multibyte && str_contains($result, '&amp;#'))
		{
			$result = preg_replace('#&amp;(\#[0-9]+;)#', '&\1', $result);
		}
	}
}

/**
* request_var
*
* Used to get passed variable
*/
function request_var($var_name, $default, $multibyte = false)
{
	if (!isset($_REQUEST[$var_name]) || (is_array($_REQUEST[$var_name]) && !is_array($default)) || (is_array($default) && !is_array($_REQUEST[$var_name])))
	{
		return (is_array($default)) ? [] : $default;
	}

	$var = $_REQUEST[$var_name];

	if (!is_array($default))
	{
	  $type = gettype($default);
	}
	else
	{
      $key_type = key($default);
      $type = current($default);
      next($default);
	  $type = gettype($type);
	  $key_type = gettype($key_type);
	}

	if (is_array($var))
	{
		$_var = $var;

		$var = [];

		foreach ($_var as $k => $v)
		{

			if (is_array($v))
			{
				foreach ($v as $_k => $_v)
				{
					set_var($k, $k, $key_type);

					set_var($_k, $_k, $key_type);

					set_var($var[$k][$_k], $_v, $type, $multibyte);
				}

			}
			else
			{
				set_var($k, $k, $key_type);

				set_var($var[$k], $v, $type, $multibyte);

			}
		}
	}
	else
	{
		set_var($var, $var, $type, $multibyte);
	}

	return $var;
}

/*****[BEGIN]******************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/
function get_forum_display_sort_option($selected_row=0, $action='list', $list='sort')
{
    global $lang;

    $forum_display_sort = ['lang_key'    => ['Last_Post', 'Sort_Topic_Title', 'Sort_Time', 'Sort_Author'], 'fields'    => ['t.topic_last_post_id', 't.topic_title', 't.topic_time', 'u.username']];

    $forum_display_order = ['lang_key'    => ['Sort_Descending', 'Sort_Ascending'], 'fields'    => ['DESC', 'ASC']];

    // get the good list

    $list_name = 'forum_display_' . $list;

    $listrow = ${$list_name};

    // init the result

    $res = '';

    if ( $selected_row > (is_countable($listrow['lang_key']) ? count($listrow['lang_key']) : 0) )
    {
        $selected_row = 0;
    }

    // build list
    if ($action == 'list')
    {
        for ($i=0; $i < (is_countable($listrow['lang_key']) ? count($listrow['lang_key']) : 0); $i++)
        {
            $selected = ($i==$selected_row) ? ' selected="selected"' : '';

            $l_value = $lang[$listrow['lang_key'][$i]] ?? $listrow['lang_key'][$i];

            $res .= '<option value="' . $i . '"' . $selected . '>' . $l_value . '</option>';
        }
    }
    else
    {
        // field
        $res = $listrow['fields'][$selected_row];
    }

    return $res;

}

/*****[END]********************************************
 [ Mod:    Topic display order                 v1.0.2 ]
 ******************************************************/

 

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
function get_icon_title($icon, $empty=0, $topic_type=-1, $admin=false)
{

 $icones = [];

 $icon_defined_special = [];

 $res = null;

 global $lang, $images, $phpEx, $phpbb_root_path;

	// get icons parameters
	include(NUKE_INCLUDE_DIR . 'posting_icons.' . $phpEx);

	// admin path
	$admin_path = ($admin) ? '../../../' : './';

    switch ($empty)
	{
		case 1:
			$align= 'middle';
			break;
		case 2:
			$align= 'bottom';
			break;
		default:
			$align = 'absbottom';
			break;
	}

	// find the icon
	$found = false;

	$icon_map = -1;

	for ($i=0; ($i < count($icones)) && !$found; $i++)
	{
		if ($icones[$i]['ind'] == $icon)
		{
			$found = true;

			$icon_map = $i;

		}
	}

	// icon not found : try a default value
	if (!$found || ($found && empty($icones[$icon_map]['img'])))
	{
		$change = true;

		switch($topic_type)
		{
			case POST_NORMAL:
				$icon = $icon_defined_special['POST_NORMAL']['icon'];
				break;

			case POST_STICKY:
				$icon = $icon_defined_special['POST_STICKY']['icon'];
				break;

			case POST_ANNOUNCE:
				$icon = $icon_defined_special['POST_ANNOUNCE']['icon'];
				break;

			case POST_GLOBAL_ANNOUNCE:
				$icon = $icon_defined_special['POST_GLOBAL_ANNOUNCE']['icon'];
				break;

			case POST_BIRTHDAY:
				$icon = $icon_defined_special['POST_BIRTHDAY']['icon'];
				break;

			case POST_CALENDAR:
				$icon = $icon_defined_special['POST_CALENDAR']['icon'];
				break;

			case POST_PICTURE:
				$icon = $icon_defined_special['POST_PICTURE']['icon'];
				break;

			case POST_ATTACHMENT:
				$icon = $icon_defined_special['POST_ATTACHEMENT']['icon'];
				break;

			default:
				$change=false;
				break;
		}

		// a default icon has been sat
		if ($change)
		{
			// find the icon
			$found = false;

			$icon_map = -1;

			for ($i=0; ($i < count($icones)) && !$found; $i++)
			{
				if ($icones[$i]['ind'] == $icon)
				{
					$found = true;

					$icon_map = $i;
				}
			}
		}
	}

	// build the icon image
	if (!$found || ($found && empty($icones[$icon_map]['img'])))
	{
		switch ($empty)
		{
			case 0:
				$res = '';
				break;

			case 1:
				$res = '<img height="20" align="' . $align . '" src="' . $admin_path . $images['spacer'] . '" alt="">';
				break;

			case 2:
				$res = $lang[ $icones[$icon_map]['alt'] ] ?? $icones[$icon_map]['alt'];
				break;
		}
	}
	else
	{
		$res = '<img height="20" align="' . $align . '" src="' . ( isset($images[ $icones[$icon_map]['img'] ]) ? $admin_path . $images[ $icones[$icon_map]['img'] ] : $admin_path . $icones[$icon_map]['img'] ) . '" alt="' . ( $lang[ $icones[$icon_map]['alt'] ] ?? $icones[$icon_map]['alt'] ) . '">';

	}

	return $res;
}
/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

function get_db_stat($mode)
{
    $sql = null;

    global $db;

    switch( $mode )
    {

        case 'usercount':
            $sql = "SELECT COUNT(user_id) AS total
                FROM ".USERS_TABLE."
                WHERE user_id <> ".ANONYMOUS;
            break;

        # If THE LATEST REGISTERED USER IS IN GHOST MODE 
		# DO NOT SHOW THEM AS THE LATEST REGISTERED USER.
        case 'newestuser':
            $sql = "SELECT user_id, username
                FROM ".USERS_TABLE."
                WHERE user_id <> ".ANONYMOUS."
                AND user_allow_viewonline = 1 ORDER BY user_id DESC
                LIMIT 1";
            break;

        case 'postcount':
        case 'topiccount':
            $sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total
                FROM ".FORUMS_TABLE;
            break;
}

    if(!($result = $db->sql_query($sql)))
    {
        return false;
    }

    $row = $db->sql_fetchrow($result);

    switch ( $mode )
    {
        case 'usercount':
            return $row['total'];
            break;
        case 'newestuser':
            return $row;
            break;
        case 'postcount':
            return $row['post_total'];
            break;
        case 'topiccount':
            return $row['topic_total'];
            break;
    }

    return false;

}

// added at phpBB 2.0.11 to properly format the username
function phpbb_clean_username($username)
{

    $username = substr(htmlspecialchars(str_replace("\'", "'", trim((string) $username))), 0, 25);

    $username = phpbb_rtrim($username, "\\");

    $username = str_replace("'", "\'", (string) $username);

    return $username;
}

/**
* This function is a wrapper for ltrim, as charlist is only supported in php >= 4.1.0
* Added in phpBB 2.0.18
*/
function phpbb_ltrim($str, $charlist = false)
{

    if($charlist === false)
    {
        return ltrim((string) $str);
    }

    $php_version = explode('.', PHP_VERSION);

    // php version < 4.1.0
    if((int)$php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
    {
        while($str[0] == $charlist)
        {
            $str = substr((string) $str, 1);
        }
    }
    else
    {
        $str = ltrim((string) $str, $charlist);
    }

    return $str;
}

// added at phpBB 2.0.12 to fix a bug in PHP 4.3.10 (only supporting charlist in php >= 4.1.0)
function phpbb_rtrim($str, $charlist = false)
{
    if($charlist === false)
    {
        return rtrim((string) $str);
    }

    $php_version = explode('.', PHP_VERSION);

    // php version < 4.1.0
    if((int)$php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
    {
        while($str[strlen((string) $str)-1] == $charlist)
        {
            $str = substr((string) $str, 0, strlen((string) $str)-1);
        }
    }
    else
    {
        $str = rtrim((string) $str, $charlist);
    }

    return $str;
}

/**
* Our own generator of random values
* This uses a constantly changing value as the base for generating the values
* The board wide setting is updated once per page if this code is called
* With thanks to Anthrax101 for the inspiration on this one
* Added in phpBB 2.0.20
*/
function dss_rand()
{
	global $db, $board_config, $dss_seeded;

	$val = $board_config['rand_seed'] . microtime();

	$val = md5($val);

	$board_config['rand_seed'] = md5($board_config['rand_seed'] . $val . 'a');

	if($dss_seeded !== true)
	{
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . $board_config['rand_seed'] . "'
			WHERE config_name = 'rand_seed'";

		if(!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Unable to reseed PRNG", "", __LINE__, __FILE__, $sql);
		}

		$dss_seeded = true;
	}

	return substr($val, 4, 16);
}

//
// Get Userdata, $user can be username or user_id. If force_str is true, the username will be forced.
//
function get_userdata($user, $force_str = false) 
{
    global $db;
    
	$row = [];
    
	$user = (!is_numeric($user) || $force_str) ? phpbb_clean_username($user) : intval($user);

    $sql = "SELECT * FROM ".USERS_TABLE." WHERE ";

    $sql .= (( is_integer($user)) ? "user_id = $user" : "username = '".str_replace("\'", "''", (string) $user)."'" )." AND user_id <> ".ANONYMOUS;

    if(!($result = $db->sql_query($sql))) 
	{
        message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
    }
	
    return ($row = $db->sql_fetchrow($result)) ? $row : false;
}

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
/**
 * FUNCTION set_user_xdata
 *
 * Sets a specefic custom profile field ($which_xdata) to the specefied
 * value ($value) for the user ($user).
 *
 * @param int|string $user        - user_id or username of the user we're editing
 * @param int|string $which_xdata - the profile field being changed
 * @param mixed $value            - value to assign
 * @global class $db
 * @return null
 */
function set_user_xdata(int|string $user, int|string $which_xdata, mixed $value)
{
    $lang = [];

    global $db;

//    $value = trim(htmlspecialchars($value));

    $value = str_replace("\\'", "'", (string) $value);
    $value = str_replace("'", "\\'", $value);

    $user_is_name = (!is_numeric($user)) ? true : false;

	$xd_is_name = (!is_numeric($which_xdata)) ? true : false;

    if($user_is_name)
    {
        $user = phpbb_clean_username($user);
    }

    $user_where = ($user_is_name) ? ('u.username = \''.$user.'\'') : ('u.user_id = '.$user);

	$field_where = ($xd_is_name) ? ('xf.code_name = \''.$which_xdata.'\'') : ('xf.field_id = '.$which_xdata);

    $sql = "SELECT u.user_id, xf.field_id FROM ("
        .USERS_TABLE. " AS u, ".XDATA_FIELDS_TABLE." AS xf)
        WHERE " .$user_where. " AND ".$field_where."
        LIMIT 1";

    if(!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, $lang['XData_error_obtaining_userdata'], '', __LINE__, __FILE__, $sql);
    }

     $row = $db->sql_fetchrow($result);

    $sql = "DELETE FROM ".XDATA_DATA_TABLE."

        WHERE user_id = ".$row['user_id']." AND field_id = ".$row['field_id']."

        LIMIT 1";

    if(!($db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, $lang['XData_failure_removing_data'], '', __LINE__, __FILE__, $sql);
    }

    if($value !== '')
    {
        $sql = "INSERT INTO ".XDATA_DATA_TABLE."

            (user_id, field_id, xdata_value)

            VALUES (" . $row['user_id'] . ", ".$row['field_id'].", '".$value."')";

        if(!($db->sql_query($sql)))
        {
               message_die(GENERAL_ERROR, $lang['XData_failure_inserting_data'], '', __LINE__, __FILE__, $sql);
        }
    }
}

/**
 * FUNCTION get_user_xdata
 *
 * retrieves the custom profile field data for the user ($user)
 * similar to get_userdata
 *
 * @param int|string $user
 * @param bool $force_str
 * @global class $db
 * @global array $lang
 * @return array $data
 */
function get_user_xdata(int|string $user, $force_str = false)
{
    $lang = [];

    global $db;

    $is_name = ((intval($user) == 0) || $force_str);

    if(!isset($user) || empty($user)) return '';

    if($is_name)
    {
        $user = trim(htmlspecialchars($user));

        $user = substr(str_replace("\\'", "'", $user), 0, 25);

        $user = str_replace("'", "\\'", $user);

        $sql = "SELECT xf.field_type, xf.code_name, xd.xdata_value

				FROM ".XDATA_DATA_TABLE." xd, ".USERS_TABLE." u, ".XDATA_FIELDS_TABLE." xf

 				WHERE xf.field_id = xd.field_id AND xd.user_id = u.user_id AND u.username = '".$user."'";
    }
    else
    {
        $user = intval($user);

        $sql = "SELECT xf.field_type, xf.code_name, xd.xdata_value

				FROM ".XDATA_DATA_TABLE." xd, ".XDATA_FIELDS_TABLE." xf

				WHERE xf.field_id = xd.field_id AND xd.user_id = ".$user;
    }

    if(!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, $lang['XData_error_obtaining_user_xdata'], '', __LINE__, __FILE__, $sql);
    }

    $data = [];

    while($row = $db->sql_fetchrow($result))
    {
        $data[$row['code_name']] = ($row['field_type'] != 'checkbox') ? $row['xdata_value'] : (($row['xdata_value'] == 1) ? $lang['true'] : $lang['false']);
    }

    $db->sql_freeresult($result);

    return $data;
}

/**
 * FUNCTION get_xd_metadata
 *
 * get a list of xdata fields
 *
 * @param boolean $force_refresh    - if true then we reselect the data from the db.
 *									- otherwise we use the data selected before
 * @static array $meta 				- stores the previous selections
 * @return array $meta				- the data of the fields.
 */
function get_xd_metadata($force_refresh = false)
{
    $lang = [];

    global $db;

    static $meta = false;

    if(!is_array($meta) || $force_refresh)
    {
        $sql = "SELECT
                field_id,
                field_name,
                field_desc,
                field_type,
                field_order,
                code_name,
                field_length,
                field_values,
                field_regexp,
                default_auth,
                display_viewprofile,
                display_register,
                display_posting,
                handle_input,
                allow_bbcode,
                allow_smilies,
                allow_html,
                viewtopic,
                signup

            FROM " . XDATA_FIELDS_TABLE . "

            ORDER BY field_order ASC";

        if(!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_field_data'], '', __LINE__, __FILE__, $sql);
        }

        $data = [];

        while($row = $db->sql_fetchrow($result))
        {
            $data[$row['code_name']] = $row;

            if($row['field_values'] != '')
            {

                $data[$row['code_name']]['values_array'] = ['toast'];

				$values = [];

				preg_match_all("/(?<!\\\)'(.*?)(?<!\\\)'/", (string) $row['field_values'], $values);

				$data[$row['code_name']]['values_array'] = array_map(fn($a) => str_replace("\\'", "'", (string) $a), $values[1]);

            }
            else
            {
                $data[$row['code_name']]['values_array'] = [];
            }
        }

        $meta = $data;
    }

    return $meta;
}

function xdata_auth($fields, $userid, $meta = false)
{
    $field_id = null;

    $field_sql = null;

    $lang = [];

    global $db;

    if(!isset($userid) || empty($userid)) return '';

    if ($field_id == false)
    {
        $field_sql = '1';
    }
    elseif (is_array($fields))
    {
        $field_sql = 'xf.code_name IN(' . implode(', ', $fields) . ')';
    }
    else
    {
        $fields_sql = "xf.code_name = '$fields'";
    }

    if($meta == false)
    {
        $sql = "SELECT xf.default_auth AS default_auth, xf.code_name AS code_name FROM ".XDATA_FIELDS_TABLE." xf

				WHERE $field_sql";

        if(!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_field_data'], '', __LINE__, __FILE__, $sql);
        }

        $meta = [];

        while($data = $db->sql_fetchrow($result))
        {
            $meta[$data['code_name']]['default_auth'] = $data['default_auth'];
        }
    }

    $sql = "SELECT xf.code_name, xa.auth_value, g.group_single_user

			FROM ".XDATA_FIELDS_TABLE." xf, ".XDATA_AUTH_TABLE." xa, ".USER_GROUP_TABLE." ug, ".GROUPS_TABLE." g

			WHERE xf.field_id = xa.field_id

			  AND xa.group_id = ug.group_id

			  AND xa.group_id = g.group_id

			  AND ug.user_id = $userid

			  AND $field_sql

			ORDER BY g.group_single_user ASC";

   if(!($result = $db->sql_query($sql)))
   {
        message_die(GENERAL_ERROR, $lang['XData_failure_obtaining_field_auth'], '', __LINE__, __FILE__, $sql);
   }

   $auth = [];

   foreach($meta as $key => $value)
   {
        $auth[$key] = $value['default_auth'];
   }

   while($data = $db->sql_fetchrow($result))
   {
        $auth[$data['code_name']] = ( $data['auth_value'] == XD_AUTH_ALLOW);
   }

   if(!is_array($fields))
   {
        return $auth[$fields];
   }

   return $auth;

}

/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

function make_jumpbox($action, $match_forum_id = 0)
{
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
	$list = [];

	return make_jumpbox_ref($action, $match_forum_id, $list);
}

function make_jumpbox_ref($action, $match_forum_id, &$forums_list)
{

$boxstring = null;
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
    global $template, $userdata, $lang, $db, $nav_links, $phpEx, $SID;
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
    $is_auth = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);
/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 [ Mod:     Forumtitle as Weblink              v1.2.2 ]
 ******************************************************/
    $sql = "SELECT c.cat_id, c.cat_title, c.cat_order

        FROM (".CATEGORIES_TABLE." c, ".FORUMS_TABLE." f)

        WHERE f.cat_id = c.cat_id

		AND f.title_is_link = 0

        ".(($userdata['user_level'] == ADMIN)? "" : " AND c.cat_id<>'".HIDDEN_CAT."'" )."

        GROUP BY c.cat_id, c.cat_title, c.cat_order

        ORDER BY c.cat_order";
/*****[END]********************************************
 [ Mod:     Forumtitle as Weblink              v1.2.2 ]
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
    $category_rows = $db->sql_ufetchrowset($sql);

    if ( $total_categories = is_countable($category_rows) ? count($category_rows) : 0 )
    {
/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
        $sql = "SELECT *

            FROM ".FORUMS_TABLE."

			WHERE title_is_link = 0

            ORDER BY cat_id, forum_order";
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
        if(!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
        }

        $boxstring = '<select name="'.POST_FORUM_URL.'" onchange="if(this.options[this.selectedIndex].value 

		!= -1){ forms[\'jumpbox\'].submit() }"><option value="-1">'.$lang['Select_forum'].'</option>';

        $forum_rows = [];

        while($row = $db->sql_fetchrow($result))
        {
            $forum_rows[] = $row;
/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
            $forums_list[] = $row;
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
        }

        $db->sql_freeresult($result);

        if($total_forums = count($forum_rows))
        {
            for($i = 0; $i < $total_categories; $i++)
            {
                $boxstring_forums = '';

                for($j = 0; $j < $total_forums; $j++)
                {
                    if ( !$forum_rows[$j]['forum_parent'] && $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$j]['auth_view'] <= AUTH_REG )
                    {

//                    if ( !$forum_rows[$j]['forum_parent'] &&  $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $is_auth[$forum_rows[$j]['forum_id']]['auth_view'] )

//                    {

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
							$id = $forum_rows[$j]['forum_id'];
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

                        $selected = ( $forum_rows[$j]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';

                        $boxstring_forums .=  '<option value="' . $forum_rows[$j]['forum_id'] . '"' . $selected . '>' . $forum_rows[$j]['forum_name'] . '</option>';

                        //
                        // Add an array to $nav_links for the Mozilla navigation bar.
                        // 'chapter' and 'forum' can create multiple items, therefore we are using a nested array.
                        //
                        $nav_links['chapter forum'][$forum_rows[$j]['forum_id']] = ['url' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$j]['forum_id']), 'title' => $forum_rows[$j]['forum_name']];

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

						for( $k = 0; $k < $total_forums; $k++ )
						{
							if ( $forum_rows[$k]['forum_parent'] == $id && $forum_rows[$k]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$k]['auth_view'] <= AUTH_REG )
							{

//							if ( $forum_rows[$k]['forum_parent'] == $id && $forum_rows[$k]['cat_id'] == $category_rows[$i]['cat_id'] && $is_auth[$forum_rows[$k]['forum_id']]['auth_view'] )

//							{
								$selected = ( $forum_rows[$k]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';

								$boxstring_forums .=  '<option value="' . $forum_rows[$k]['forum_id'] . '"' . $selected . '>-- ' . $forum_rows[$k]['forum_name'] . '</option>';

								//
								// Add an array to $nav_links for the Mozilla navigation bar.
								// 'chapter' and 'forum' can create multiple items, therefore we are using a nested array.
								//
								$nav_links['chapter forum'][$forum_rows[$k]['forum_id']] = ['url' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$k]['forum_id']), 'title' => $forum_rows[$k]['forum_name']];

							}
						}
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
                    }
                }

                if ( !empty($boxstring_forums) )
                {

                    $boxstring .= '<option value="-1">&nbsp;</option>';

                    $boxstring .= '<option value="-1">' . $category_rows[$i]['cat_title'] . '</option>';

                    $boxstring .= '<option value="-1">----------------</option>';

                    $boxstring .= $boxstring_forums;

                }
            }
        }

        $boxstring .= '</select>';
    }
    else
    {
        $boxstring .= '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"></select>';
    }

    // Let the jumpbox work again in sites having additional session id checks.
//    if ( !empty($SID) )
//    {

        $boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

//    }
    $template->set_filenames(['jumpbox' => 'jumpbox.tpl']

    );

    $template->assign_vars(['L_GO' => $lang['Go'], 'L_JUMP_TO' => $lang['Jump_to'], 'L_SELECT_FORUM' => $lang['Select_forum'], 'S_JUMPBOX_SELECT' => $boxstring, 'S_JUMPBOX_ACTION' => append_sid($action)]

    );

    $template->assign_var_from_handle('JUMPBOX', 'jumpbox');

    return;
}

//
// Initialise user settings on page load
function init_userprefs($userdata)
{
    $default_lang = null;

    global $board_config, $theme, $images, $template, $lang, $phpEx, $phpbb_root_path, $db, $nav_links;

/*****[BEGIN]******************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/

	global $db, $mods, $list_yes_no, $userdata;

	//	get all the mods settings

	$dir = opendir(NUKE_INCLUDE_DIR . 'mods_settings');

	while( $file = readdir($dir) )
	{
		if( preg_match("/^mod_.*?\." . $phpEx . "$/", $file) )
		{
			include_once(NUKE_INCLUDE_DIR . 'mods_settings/' . $file);
		}
	}

	closedir($dir);

/*****[END]********************************************
 [ Mod:     Post Icons                         v1.0.1 ]
 ******************************************************/
    if ( $userdata['user_id'] != ANONYMOUS )
    {
        if ( !empty($userdata['user_lang']))
        {
            $default_lang = phpbb_ltrim(basename((string) phpbb_rtrim($userdata['user_lang'])), "'");
        }

        if ( !empty($userdata['user_dateformat']) )
        {
            $board_config['default_dateformat'] = $userdata['user_dateformat'];
        }

        if ( isset($userdata['user_timezone']) )
        {
            $board_config['board_timezone'] = $userdata['user_timezone'];
        }
    }
    else
	{
		$default_lang = phpbb_ltrim(basename((string) phpbb_rtrim($board_config['default_lang'])), "'");
	}

	if ( !file_exists(phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
	{
		if ( $userdata['user_id'] != ANONYMOUS )
		{
			// For logged in users, try the board default language next
			$default_lang = phpbb_ltrim(basename((string) phpbb_rtrim($board_config['default_lang'])), "'");
		}
		else
		{
			// For guests it means the default language is not present, try english
			// This is a long shot since it means serious errors in the setup to reach here,
			// but english is part of a new install so it's worth us trying
			$default_lang = 'english';
		}

		if ( !file_exists(phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
		{
			message_die(CRITICAL_ERROR, 'Could not locate valid language pack');
		}
	}

	// If we've had to change the value in any way then let's write it back to the database
	// before we go any further since it means there is something wrong with it
	if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . USERS_TABLE . "

			SET user_lang = '" . $default_lang . "'

			WHERE user_lang = '" . $userdata['user_lang'] . "'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}

		$board_config['default_lang'] = $default_lang;

		$userdata['user_lang'] = $default_lang;
	}
	elseif ( $board_config['default_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . CONFIG_TABLE . "

			SET config_value = '" . $default_lang . "'

			WHERE config_name = 'default_lang'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}

		$board_config['default_lang'] = $default_lang;
	}

    include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.' . $phpEx);

    /*--FNA #1--*/
    if ( defined('IN_ADMIN') )
    {
        if( !file_exists(phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.'.$phpEx)) )
        {
            $board_config['default_lang'] = 'english';
        }

       include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);
    }

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
    include_attach_lang();
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Simply Merge Threads                v1.0.1 ]
 [ Mod:    Ranks summarize                     v1.0.4 ]
 ******************************************************/
    include(NUKE_INCLUDE_DIR."lang_extend_mac.$phpEx");
/*****[END]********************************************
 [ Mod:    Ranks summarize                     v1.0.4 ]
 [ Mod:    Simply Merge Threads                v1.0.1 ]
 ******************************************************/

    //
    // Set up style
    //
    if ( !$board_config['override_user_style'] )
    {
        if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_style'] > 0 )
        {
            if ( $theme = setup_style($userdata['user_style']) )
            {
                return;
            }
        }
    }

    $theme = setup_style($board_config['default_style']);

    //
    // Mozilla navigation bar
    // Default items that should be valid on all pages.
    // Defined here to correctly assign the Language Variables
    // and be able to change the variables within code.
    //

        $nav_links['top'] = ['url' => append_sid("index.$phpEx"), 'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])];

        $nav_links['search'] = ['url' => append_sid("search.$phpEx"), 'title' => $lang['Search']];

        $nav_links['help'] = ['url' => append_sid("faq.$phpEx"), 'title' => $lang['FAQ']];

        $nav_links['author'] = ['url' => append_sid("memberlist.$phpEx"), 'title' => $lang['Memberlist']];

    return;
}

function setup_style($style)
{
    global $db, $prefix, $board_config, $template, $images, $phpbb_root_path, $name, $user, $cookie;

    if($name == "Forums"){

        $default_style=$board_config['default_style'];

        if(empty($cookie[1]) AND $style != $default_style) {

            $style = $default_style;

        }
    }

    $sql = "SELECT * FROM " . THEMES_TABLE . " WHERE themes_id = ". (int) $style;

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(CRITICAL_ERROR, 'Could not query database for theme info');
    }

    if ( !($row = $db->sql_fetchrow($result)) )
    {
 		// We are trying to setup a style which does not exist in the database
 		// Try to fallback to the board default (if the user had a custom style)
 		// and then any users using this style to the default if it succeeds
 		if ( $style != $board_config['default_style'])
 		{
 			$sql = 'SELECT *

 				FROM ' . THEMES_TABLE . '

 				WHERE themes_id = ' . (int) $board_config['default_style'];

 			if ( !($result = $db->sql_query($sql)) )
 			{
 				message_die(CRITICAL_ERROR, 'Could not query database for theme info');
 			}

 			if ( $row = $db->sql_fetchrow($result) )
 			{
 				$db->sql_freeresult($result);

 				$sql = 'UPDATE ' . USERS_TABLE . '

 					SET user_style = ' . (int) $board_config['default_style'] . "

 					WHERE user_style = $style";

 				if ( !($result = $db->sql_query($sql)) )
 				{
 					message_die(CRITICAL_ERROR, 'Could not update user theme info');
 				}
 			}
 			else
 			{
 				message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
 			}
 		}
 		else
 		{
 			message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
 		}
    }

    $db->sql_freeresult($result);

    $ThemeSel = get_theme();

    if (file_exists("themes/$ThemeSel/forums/index_body.tpl")) {

        $template_name = "forums";

        $template_path = "themes/$ThemeSel/";

    } else {

        $template_name = $row['template_name'];

        $template_path = $phpbb_root_path . 'templates/';

    }

    $template = new Template($template_path . $template_name, $board_config, $db);

    if ( $template )
    {
        $current_template_path = $template_path . $template_name;

        $ThemeSel = get_theme();

        if (file_exists("themes/$ThemeSel/$template_name/index_body.tpl")) {

            include($template_path . $template_name . '/' . $template_name . '.cfg');

        } else {

            include($template_path . $template_name . '/' . $template_name . '.cfg');

        }

        if ( !defined('TEMPLATE_CONFIG') )
        {
            message_die(CRITICAL_ERROR, "Could not open $template_name template config file", '', __LINE__, __FILE__);
        }

        //$img_lang = ( file_exists(phpbb_realpath($phpbb_root_path . $current_template_path . '/images/lang_' . $board_config['default_lang'])) ) ? $board_config['default_lang'] : 'english';
        $img_lang = ( file_exists(phpbb_realpath($current_template_path . '/images/lang_' . $board_config['default_lang'])) ) ? $board_config['default_lang'] : 'english';

        foreach ($images as $key => $value) {

            if ( !is_array($value) )
            {
                $images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, (string) $value);
            }
        }
    }
    return $row;
}

function encode_ip($dotquad_ip)
{
    $ip_sep = explode('.', (string) $dotquad_ip);

    return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}

function decode_ip($int_ip)
{
    $hexipbang = explode('.', chunk_split((string) $int_ip, 2, '.'));
    if(!isset($hexipbang[0]))
	$hexipbang[0] = '';
    if(!isset($hexipbang[1]))
	$hexipbang[1] = '';
    if(!isset($hexipbang[2]))
	$hexipbang[2] = '';
    if(!isset($hexipbang[3]))
	$hexipbang[3] = '';
    return hexdec($hexipbang[0]). '.' . hexdec($hexipbang[1]) . '.' . hexdec($hexipbang[2]) . '.' . hexdec($hexipbang[3]);
}

# Create date/time from format and timezone
function create_date($format, $gmepoch, $tz)
{
    global $board_config, $lang, $userdata, $pc_dateTime;

    static $translate;

    if(empty($translate) && $board_config['default_lang'] != 'english'):

		reset($lang['datetime']);

		foreach ($lang['datetime'] as $match => $replace):

            $translate[$match] = $replace;

        endforeach;

		unset($replace); // break the reference with the last element

    endif;

   if(isset($userdata['user_id']) && $userdata['user_id'] != ANONYMOUS):

      switch($userdata['user_time_mode']):

	  case MANUAL_DST:
	  $dst_sec = $userdata['user_dst_time_lag'] * 60;
      return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
      break;

	  case SERVER_SWITCH:
	  if(!empty($gmepoch) && is_long($gmepoch)): 
      $dst_sec = date('I', $gmepoch) * $userdata['user_dst_time_lag'] * 60;
	  else: 
      $dst_sec = date('I') * $userdata['user_dst_time_lag'] * 60;
      endif;
	  return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
      break;

	  case FULL_SERVER:
      return ( !empty($translate) ) ? strtr(date((string)$format, (int)$gmepoch), (string)$translate) : date((string)$format, (int)$gmepoch);
      break;

	  case SERVER_PC:
	  if(isset($pc_dateTime['pc_timezoneOffset'])):
      $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
	  else:
      $user_pc_timeOffsets = explode("/", (string) $userdata['user_pc_timeOffsets']);
      $tzo_sec = $user_pc_timeOffsets[0];
      endif;
      return ( !empty($translate) ) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
      break;

	  case FULL_PC:
	  if(isset($pc_dateTime['pc_timeOffset'])):
      $tzo_sec = $pc_dateTime['pc_timeOffset'];
	  else:
      $user_pc_timeOffsets = explode("/", (string) $userdata['user_pc_timeOffsets']);
      $tzo_sec = $user_pc_timeOffsets[1] ?? '';
      endif;
	  return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
      break;

	  default:
      return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz)), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz));
      break;

	endswitch;

else:

    switch ($board_config['default_time_mode']):

	case MANUAL_DST:
	$dst_sec = $board_config['default_dst_time_lag'] * 60;
	return (!empty($translate) ) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
	break;

	case SERVER_SWITCH:
    if(!empty($gmepoch) && is_long($gmepoch)): 
    $dst_sec = date('I', $gmepoch) * $userdata['user_dst_time_lag'] * 60;
	else: 
    $dst_sec = date('I') * $userdata['user_dst_time_lag'] * 60;
    endif;
	return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
	break;

	case FULL_SERVER:
    return ( !empty($translate) ) ? strtr(date((string)$format, (int)$gmepoch), (string)$translate) : date((string)$format, (int)$gmepoch);
    break;

    case SERVER_PC:
    if(isset($pc_dateTime['pc_timezoneOffset'])):
    $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
    else:
    $tzo_sec = 0;
    endif;
	return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
	break;

	case FULL_PC:
	if(isset($pc_dateTime['pc_timeOffset'])):
    $tzo_sec = $pc_dateTime['pc_timeOffset'];
	else:
    $tzo_sec = 0;
    endif;
    return ( !empty($translate) ) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
	break;

	default:
    return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz)), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz));
    break;

    endswitch;

  endif;
}

/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
function get_page($num_items, $per_page, $start_item)
{
	$total_pages = ceil($num_items/$per_page);

	if ( $total_pages == 1 )
	{
		return '1';

		exit;
	}

	$on_page = floor($start_item / $per_page) + 1;

	$page_string = '';

	for($i = 0; $i < $total_pages + 1; $i++)
	{
		if( $i == $on_page ) 
		{
			$page_string = $i;
		}
	}

	return $page_string;
}
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

//
// Pagination routine, generates
// page number sequence
//
function generate_pagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE)
{
    global $lang;

    $total_pages = ceil($num_items/$per_page);

    if ( $total_pages == 1 )
    {
        return '';
    }

    $on_page = floor($start_item / $per_page) + 1;

    $page_string = '';

    if ( $total_pages > 10 )
    {
        $init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;

        for($i = 1; $i < $init_page_max + 1; $i++)
        {
            // $page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>' : '<a class="page-link" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
            $page_string .= '<a class="page-link'.(( $i == $on_page ) ? ' active' : '').'" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';

            if ( $i <  $init_page_max && !defined('BOOTSTRAP') )
            {
                $page_string .= ", ";
            }
        }

        if ( $total_pages > 3 )
        {
            if ( $on_page > 1  && $on_page < $total_pages )
            {
                $page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';

                $init_page_min = ( $on_page > 4 ) ? $on_page : 5;

                $init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;

                for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
                {
                    // $page_string .= ($i == $on_page) ? '<strong>' . $i . '</strong>' : '<a class="page-link" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                    $page_string .= '<a class="page-link'.(( $i == $on_page ) ? ' active' : '').'" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';

                    if ( $i <  $init_page_max + 1 && !defined('BOOTSTRAP') )
                    {
                        $page_string .= ', ';
                    }
                }

                $page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
            }
            else
            {
                $page_string .= ' ... ';
            }

            for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
            {

                // $page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>'  : '<a class="page-link" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                $page_string .= '<a class="page-link'.(( $i == $on_page ) ? ' active' : '').'" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';

                if ( $i <  $total_pages && !defined('BOOTSTRAP') )
                {
                    $page_string .= ", ";
                }
            }
        }
    }
    else
    {
        for($i = 1; $i < $total_pages + 1; $i++)
        {
            // $page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>' : '<a class="page-link" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
            $page_string .= '<a class="page-link'.(( $i == $on_page ) ? ' active' : '').'" href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';

            if ( $i <  $total_pages && !defined('BOOTSTRAP') )
            {
                $page_string .= ', ';
            }
        }
    }

    if ( $add_prevnext_text )
    {
        // if ( $on_page > 1 )
        // {
            if( !defined('BOOTSTRAP') ) 
            {
                if( $on_page > 1 )
                {
                    $page_string = ' <a href="' . append_sid($base_url . "&amp;start=" . ( ( $on_page - 2 ) * $per_page ) ) . '">' . $lang['Previous'] . '</a>&nbsp;&nbsp;' . $page_string;
                }
            } else {

                $page_string = '  <a class="page-link'.(( $on_page == 1 ) ? ' disabled' : '').'" href="' . append_sid($base_url . "&amp;start=" . ( ( $on_page - 2 ) * $per_page ) ) . '">&lt;</a>' . $page_string;

            }
        // }
        // if ( $on_page < $total_pages )
        // {
            if( !defined('BOOTSTRAP') ) 
            {
                if( $on_page < $total_pages )
                {
                    $page_string .= '&nbsp;&nbsp;<a href="' . append_sid($base_url . "&amp;start=" . ( $on_page * $per_page ) ) . '">' . $lang['Next'] . '</a>';
                }
            } else {

                $page_string .= '  <a class="page-link'.(( $on_page == $total_pages ) ? ' disabled' : '').'" href="' . append_sid($base_url . "&amp;start=" . ( $on_page * $per_page ) ) . '">&gt;</a>';

            }
        // }

    }

/*****[BEGIN]******************************************
 [ Mod:    Goto specific page                  v1.0.0 ]
 ******************************************************/
    if ( $total_pages > 5 )
    {
        $select_page = ' <select name="generate_pagination" onChange="if(this.options[this.selectedIndex].value != -1){ window.location = this.options[this.selectedIndex].value; }">';

        for($i = 1; $i <= $total_pages; $i++)
        {
            $selected = ( $i == $on_page ) ? ' selected="selected"' : ''; // highlight current page by default

            $select_page .= '<option value="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) )  . '"' . $selected . '>' . $i . '</option>';
        }

        $select_page .= '</select>:';
    }
    else
        $select_page = '';

    // $page_string = $lang['Goto_page'] . $select_page . ' ' . $page_string;
/*****[END]********************************************
 [ Mod:    Goto specific page                  v1.0.0 ]
 ******************************************************/

    return $page_string;
}

//
// This does exactly what preg_quote() does in PHP 4-ish
// If you just need the 1-parameter preg_quote call, then don't bother using this.
//
function phpbb_preg_quote($str, $delimiter)
{
    $text = preg_quote((string) $str);

    $text = str_replace($delimiter, '\\' . $delimiter, $text);

    return $text;
}

//
// Obtain list of naughty words and build preg style replacement arrays for use by the
// calling script, note that the vars are passed as references this just makes it easier
// to return both sets of arrays
//
function obtain_word_list(&$orig_word, &$replacement_word)
{
    global $db;

    //
    // Define censored word matches
    //
    $sql = "SELECT word, replacement

        FROM  " . WORDS_TABLE;

    if( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
    }

    if ( $row = $db->sql_fetchrow($result) )
    {
        do
        {
            $orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote((string) $row['word'], '#')) . ')\b#i';

            $replacement_word[] = $row['replacement'];
        }

        while ( $row = $db->sql_fetchrow($result) );

        $db->sql_freeresult($result);
    }

    return true;
}

//
// This is general replacement for die(), allows templated
// output in users (or default) language, etc.
//
// $msg_code can be one of these constants:
//
// GENERAL_MESSAGE : Use for any simple text message, eg. results
// of an operation, authorisation failures, etc.
//
// GENERAL ERROR : Use for any error which occurs _AFTER_ the
// common.php include and session code, ie. most errors in
// pages/functions
//
// CRITICAL_MESSAGE : Used when basic config data is available but
// a session may not exist, eg. banned users
//
// CRITICAL_ERROR : Used when config data cannot be obtained, eg
// no database connection. Should _not_ be used in 99.5% of cases
//
function message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '')
{
    global $db, $template, $board_config, $theme, $lang, $phpEx, $phpbb_root_path, $nav_links, $gen_simple_header, $images, $userdata, $user_ip, $session_length, $starttime;

    static $has_died, $msg_history;

	if ( !isset($msg_history) || ( isset($msg_history) && !is_array($msg_history) ) )
	{
		$msg_history = [];
	}

	$msg_history[] = ['msg_code'	=> $msg_code, 'msg_text'	=> $msg_text, 'msg_title'	=> $msg_title, 'err_line'	=> $err_line, 'err_file'	=> $err_file, 'sql'		=> $sql];

	// Write the error to the evo log only if the error message
	// code is not equal to 200
	$error_message  = 'Error Code: ' . $msg_code . "\n";
	$error_message .= 'Error Message : ' . $msg_text . "\n";
	$error_message .= 'Error Title: ' . $msg_title . "\n";
	$error_message .= 'Error Line: ' . $err_line . "\n";
	$error_message .= 'Error File: ' . $err_file . "\n";
	$error_message .= 'Error SQL: ' . $sql . "\n";

	if ($msg_code != GENERAL_MESSAGE) {

		log_write('error', $error_message, 'Message die() called multiple times');

	}

    if ( $has_died == 1 && !$board_config['board_disable'] )
    {
		//
		// This message is printed at the end of the report.
		// Of course, you can change it to suit your own needs. ;-)
		//
		OpenTable();

		$custom_error_message = 'Ooops, something has gone wrong that should not have happended, please contact the %swebmaster%s about the errors you are getting.<br /><br />';

		if ( !empty($board_config) && !empty($board_config['board_email']) )
		{
			$custom_error_message = sprintf($custom_error_message, '<a href="mailto:' . $board_config['board_email'] . '">', '</a>');
		}
		else
		{
			$custom_error_message = sprintf($custom_error_message, 'site', ' webmaster');
		}

		$custom_error_message .= '<strong>Critical Error!</strong><br />message_die() was called multiple times.<br /><br />';

		$error_messages = '';

		for ( $i = 0; $i < count($msg_history); $i++ )
		{
			$error_messages .= '<strong>Error #' . ($i + 1) . "</strong>\n<br />\n";

			if ( !empty($msg_history[$i]['msg_title']) )
			{
				$error_messages .= '<strong>' . $msg_history[$i]['msg_title'] . "</strong>\n<br />\n";
			}

			$error_messages .= $msg_history[$i]['msg_text'] . "\n<br /><br />\n";

			if ( !empty($msg_history[$i]['err_line']) )
			{
				$error_messages .= '<strong>Line:</strong> ' . $msg_history[$i]['err_line'] . '<br /><strong>File :</strong> ' . $msg_history[$i]['err_file'] . "</strong>\n<br />\n";
			}

			if ( !empty($msg_history[$i]['sql']) )
			{
				$error_messages .= '<strong>SQL:</strong> ' . $msg_history[$i]['sql'] . "\n<br />\n";
			}
		}

		echo $custom_error_message . $error_messages;

		CloseTable();

		include_once(NUKE_BASE_DIR . 'footer.php');

		exit;
    }

    $has_died = 1;

    $sql_store = $sql;

    //
	// Get SQL error if we are debugging. Do this as soon as possible to prevent
    // subsequent queries from overwriting the status of sql_error()
    //
    if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
    {
        $sql_error = $db->sql_error();

        $debug_text = '';

        if ( !empty($sql_error['message']) )
        {
            $debug_text .= '<br /><br />SQL Error : ' . $sql_error['code'] . ' ' . $sql_error['message'];
        }

        if ( !empty($sql_store) )
        {
            $debug_text .= "<br /><br />$sql_store";
        }

        if ( !empty($err_line) && !empty($err_file) )
        {
            $debug_text .= '<br /><br />Line : ' . $err_line . '<br />File : ' . basename((string) $err_file);
        }
    }

    if( empty($userdata) && ( $msg_code == GENERAL_MESSAGE || $msg_code == GENERAL_ERROR ) )
    {
		$userdata = session_pagestart($user_ip, PAGE_INDEX);

		init_userprefs($userdata);
    }

    //
    // If the header hasn't been output then do it
    //
    if ( !defined('HEADER_INC') && $msg_code != CRITICAL_ERROR )
    {
        if ( empty($lang) )
        {
            if ( !empty($board_config['default_lang']) )
            {
                include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.'.$phpEx);
                /*--FNA #2--*/
            }
            else
            {
                include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);
                /*--FNA #3--*/
            }
        }

/*****[BEGIN]******************************************
 [ Mod:    Simply Merge Threads                v1.0.1 ]
 [ Mod:    Ranks summarize                     v1.0.4 ]
 ******************************************************/
    include(NUKE_INCLUDE_DIR."lang_extend_mac.$phpEx");
/*****[END]********************************************
 [ Mod:    Ranks summarize                     v1.0.4 ]
 [ Mod:    Simply Merge Threads                v1.0.1 ]
 ******************************************************/
        /*if ( empty($template) )
        {
            $ThemeSel = get_theme();

            if (file_exists("themes/$ThemeSel/forums/".$board_config['board_template']."/index_body.tpl")) {
                $template = new Template("themes/$ThemeSel/forums/".$board_config['board_template']."");
            } else {
                $template = new Template($phpbb_root_path . 'templates/' . $board_config['board_template']);
            }
        }*/
        if ( empty($theme) )
        {
            $theme = setup_style($board_config['default_style']);
        }

        //
        // Load the Page Header
        //
        if ( !defined('IN_ADMIN') )
        {
           include("includes/page_header.$phpEx");

        }
        else
        {
            include($phpbb_root_path . 'admin/page_header_admin.'.$phpEx);
        }
    }

    switch($msg_code)
    {
        case GENERAL_MESSAGE:
            if ( empty($msg_title) )
            {
                $msg_title = $lang['Information'];
            }
            break;

        case CRITICAL_MESSAGE:
            if ( empty($msg_title) )
            {
                $msg_title = $lang['Critical_Information'];
            }
            break;

        case GENERAL_ERROR:
            if ( empty($msg_text) )
            {
                $msg_text = $lang['An_error_occured'];
            }

            if ( empty($msg_title) )
            {
                $msg_title = $lang['General_Error'];
            }
            break;

        case CRITICAL_ERROR:
            //
            // Critical errors mean we cannot rely on _ANY_ DB information being
            // available so we're going to dump out a simple echo'd statement
            //
            if (file_exists($phpbb_root_path . 'language/lang_' . $lang . 'lang_main.' . $phpEx))
            {
                include($phpbb_root_path . 'language/lang_' . $lang . 'lang_main.' . $phpEx);
            }
            else
            {
                include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);
            }
            //include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);

            if ( empty($msg_text) )
            {
                $msg_text = $lang['A_critical_error'];
            }

            if ( empty($msg_title) )
            {
                $msg_title = 'phpBB : <strong>' . $lang['Critical_Error'] . '</strong>';
            }
            break;
    }

    //
    // Add on DEBUG info if we've enabled debug mode and this is an error. This
    // prevents debug info being output for general messages should DEBUG be
    // set TRUE by accident (preventing confusion for the end user!)
    //
    if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
    {
        if ( !empty($debug_text) )
        {
            $msg_text = $msg_text . '<br /><br /><strong><u>DEBUG MODE</u></strong>' . $debug_text;
        }
    }

    if ( $msg_code != CRITICAL_ERROR )
    {
        if ( !empty($lang[$msg_text]) )
        {
            $msg_text = $lang[$msg_text];
        }

        if ( !defined('IN_ADMIN') )
        {
            $template->set_filenames(['message_body' => 'message_body.tpl']

            );
        }
        else
        {
            $template->set_filenames(['message_body' => 'admin/admin_message_body.tpl']

            );
        }

        $template->assign_vars(['MESSAGE_TITLE' => $msg_title, 'MESSAGE_TEXT' => $msg_text]

        );

        $template->pparse('message_body');

        if ( !defined('IN_ADMIN') )
        {
           include("includes/page_tail.php");
        }
        else
        {
           include($phpbb_root_path . 'admin/page_footer_admin.'.$phpEx);
        }
    }
    else
    {
        echo "<html>\n<body>\n" . $msg_title . "\n<br /><br />\n" . $msg_text . "</body>\n</html>";
    }

    exit;
}

//
// This function is for compatibility with PHP 4.x's realpath()
// function.  In later versions of PHP, it needs to be called
// to do checks with some functions.  Older versions of PHP don't
// seem to need this, so we'll just return the original value.
// dougk_ff7 <October 5, 2002>
function phpbb_realpath($path)
{
    global $phpbb_root_path, $phpEx;

    return (!function_exists('realpath') || !realpath($phpbb_root_path . 'includes/functions.'.$phpEx)) ? $path : realpath($path);
}

// modded by Quake for NOT using $nukeuser
function bblogin($session_id) {

        $board_config = [];

        $phpEx = null;

        $lang = [];

        $redirect = null;

        global $userdata, $board_config, $user_ip, $session_length, $session_id, $db, $nuke_file_path, $cookie;

        define_once("IN_LOGIN", true);

        $nuid = $cookie[0];

        $sql = "SELECT s.*

                FROM " . SESSIONS_TABLE . " s

                WHERE s.session_id = '$session_id'

                AND s.session_ip = '$user_ip'";

        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(CRITICAL_ERROR, 'Error doing DB query userdata row fetch : session_pagestar');
        }
        
		$logindata = [];
        
		$logindata = $db->sql_fetchrow($result);

        $db->sql_freeresult($result);
        
		if(!isset($logindata['session_user_id']))
		$logindata['session_user_id'] = '';

        if(isset($nuid) && $nuid  != $logindata['session_user_id'] ) {

            $nusername = $cookie[1];

            $sql = "SELECT user_id, username, user_password, user_active, user_level

                    FROM ".USERS_TABLE."

                    WHERE username = '" . str_replace("\'", "''", (string) $nusername) . "'";

            $result = $db->sql_query($sql);

            if(!$result) {

                message_die(GENERAL_ERROR, "Error in obtaining userdata : login", "", __LINE__, __FILE__, $sql);

            }

            $rowresult = $db->sql_fetchrow($result);

            $db->sql_freeresult($result);

            $password = $cookie[2];
		    
			if(!isset($rowresult))
		    $rowresult = 0;

            if(is_countable($rowresult) ? count($rowresult) : 0 ) {

				if( $rowresult['user_level'] != ADMIN && $board_config['board_disable'] ) {

                    redirect(append_sid("index.$phpEx", true));

                } else {

                    if( $password == $rowresult['user_password'] && $rowresult['user_active'] ) {

                        $autologin = 0;

                        $userdata = session_begin($rowresult['user_id'], $user_ip, PAGE_INDEX, $session_length, FALSE, $autologin);

                        $session_id = $userdata['session_id'];

                        if(!$session_id ) {

                            message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);

                        } else {

                        }

                    } else {

                        $message = $lang['Error_login'] . "<br /><br />" . sprintf($lang['Click_return_login'], "<a 
						href=\"" . append_sid("login.$phpEx?$redirect") . "\">", "</a> ") . "<br /><br />" .  sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.$phpEx") . "\">", "</a> ");

                        message_die(GENERAL_MESSAGE, $message);

                    }

                }

            } else {

                $message = $lang['Error_login'] . "<br /><br />" . sprintf($lang['Click_return_login'], "<a 
				href=\"" . append_sid("login.$phpEx?$redirect") . "\">", "</a> ") . "<br /><br />" .  sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.$phpEx") . "\">", "</a> ");

                message_die(GENERAL_MESSAGE, $message);

            }
        }
}

/*****[BEGIN]******************************************
 [ Base:    At a Glance                        v2.2.1 ]
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
function show_glance($where) {

    $where_array = [];

    global $userdata, $board_config;

    $mode = ($board_config['glance_show_override']) ? $board_config['glance_show'] : $userdata['user_glance_show'];

    if(intval($mode) == 0) {

        return false;

    }

    $where_array['index'] = [GLANCE_INDEX, GLANCE_INDEX_AND_FORUMS, GLANCE_INDEX_AND_TOPICS, GLANCE_ALL];

    $where_array['forums'] = [GLANCE_FORUMS, GLANCE_INDEX_AND_FORUMS, GLANCE_FORUMS_AND_TOPICS, GLANCE_ALL];

    $where_array['topics'] = [GLANCE_TOPICS, GLANCE_INDEX_AND_TOPICS, GLANCE_FORUMS_AND_TOPICS, GLANCE_ALL];

    if (in_array($mode, $where_array[$where])) {

        return true;
    }

    return false;
}

/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 [ Base:    At a Glance                        v2.2.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/
function allow_log_view($user_level) {

    global $board_config, $userdata;

      if ($board_config['logs_view_level'] == ADMIN && $user_level == ADMIN) {

           return true;

           exit;

      } elseif ($board_config['logs_view_level'] == MOD && ($user_level == MOD || $user_level == ADMIN)) {

           return true;

           exit;

      } elseif ($board_config['logs_view_level'] == USER && $user_level >= USER && $userdata['user_id'] != ANONYMOUS) {

           return true;

           exit;

      } elseif ($board_config['logs_view_level'] == "0") {

           return true;

           exit;

      } else {

           return false;

           exit;

      }

   return false;

}

function show_log($type){

   $show = null;

   global $board_config;

        $show = match ($type) {

            'lock' => ($board_config['show_locked_logs']) ? true : false,

            'edit' => ($board_config['show_edited_logs']) ? true : false,

            'move' => ($board_config['show_moved_logs']) ? true : false,

            'split' => ($board_config['show_splitted_logs']) ? true : false,

            'unlock' => ($board_config['show_unlocked_logs']) ? true : false,

            default => $show,
        };

    return $show;
}
/*****[END]********************************************
 [ Mod:   Log Actions Mod - Topic View         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
function resize_avatar($avatar_url) {
    //moved to functions_evo.php
    return avatar_resize($avatar_url);
}
/*****[END]********************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
function get_cfi_cookie_name()
{
	global $board_config, $_GET;

	$k = $board_config['cookie_name'].'_CFI_cats';

	if( isset($board_config['sub_forum']) )
	{
		$k .= '_'.isset($board_config['sub_forum']);

		if( isset($_GET['c']) )
		{
			$k .= '_'.$_GET['c'];
		}
	}

	return $k;
}

function is_category_collapsed($cat_id)
{
	global $board_config, $_COOKIE;

	static $collapsed_cats = false;

    if(!isset($board_config['sub_forum']))
	$board_config['sub_forum'] = 0;

	if( intval($board_config['sub_forum']) == 2 )
	{
		return false;
	}

	if( !is_array($collapsed_cats) )
	{
		if( isset($_COOKIE[get_cfi_cookie_name()]) )
		{
			$collapsed_cats = explode(':', (string) $_COOKIE[get_cfi_cookie_name()]);
		}
		else
		{
			$collapsed_cats = [];
		}
	}

	return in_array($cat_id, $collapsed_cats) ? true : false;
}
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/

//
// Password-protected topics/forums
//
function password_check ($mode, $id, $password, $redirect)
{
	$savename = null;

    global $userdata, $db, $template, $theme, $board_config, $lang, $phpEx, $phpbb_root_path, $gen_simple_header;
	
	//global $_COOKIE; <- dumb ass

	$cookie_name = $board_config['cookie_name'];

	$cookie_path = $board_config['cookie_path'];

	$cookie_domain = $board_config['cookie_domain'];

	$cookie_secure = $board_config['cookie_secure'];

	switch($mode)
	{
		case 'topic':
			$sql = "SELECT topic_password AS password FROM " . TOPICS_TABLE . " WHERE topic_id = $id";
			$passdata = ( isset($_COOKIE[$cookie_name . '_tpass']) ) ? unserialize(stripslashes((string) $_COOKIE[$cookie_name . '_tpass'])) : '';
			$savename = $cookie_name . '_tpass';
			break;

		case 'forum':
			$sql = "SELECT forum_password AS password FROM " . FORUMS_TABLE . " WHERE forum_id = $id";
			$passdata = ( isset($_COOKIE[$cookie_name . '_fpass']) ) ? unserialize(stripslashes((string) $_COOKIE[$cookie_name . '_fpass'])) : '';
			$savename = $cookie_name . '_fpass';
			break;

		default:
			$sql = '';
			$passdata = '';
	}

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve password', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	if( $password != $row['password'] )
	{
		$message = ( $mode == 'topic' ) ? $lang['Incorrect_topic_password'] : $lang['Incorrect_forum_password'];

		message_die(GENERAL_MESSAGE, $message);
	}

	$passdata = [];
	$passdata[$id] = (string) $password;

	setcookie($savename, serialize($passdata), ['expires' => 0, 'path' => (string) $cookie_path, 'domain' => (string) $cookie_domain, 'secure' => $cookie_secure]);

	$template->assign_vars(['META' => '<meta http-equiv="refresh" content="3; url="' . $redirect . '" />']

	);

	$message = $lang['Password_login_success'] . '<br /><br />' . sprintf($lang['Click_return_page'], '<a href="' . $redirect . '">', '</a>');

	message_die(GENERAL_MESSAGE, $message);

}

function password_box ($mode, $s_form_action)
{

	global $db, $template, $theme, $board_config, $lang, $phpEx, $phpbb_root_path, $gen_simple_header;

	global $userdata;
    
	if(!isset($lang['Enter_forum_password']))
	$lang['Enter_forum_password'] = 'Please Enter The Forum Password';

	if(!isset($lang['Enter_topic_password']))
	$lang['Enter_topic_password'] = 'Please Enter The Topic Password';
	
	$l_enter_password = ( $mode == 'topic' ) ? $lang['Enter_topic_password'] : $lang['Enter_forum_password'];

	$page_title = $l_enter_password;

	include('includes/page_header.php');

	$template->set_filenames(['body' => 'password_body.tpl']

	);

	$template->assign_vars(['L_ENTER_PASSWORD' => $l_enter_password, 'L_SUBMIT' => $lang['Submit'], 'L_CANCEL' => $lang['Cancel'], 'S_FORM_ACTION' => $s_form_action]

	);

	$template->pparse('body');

	include('includes/page_tail.php');
}

?>
