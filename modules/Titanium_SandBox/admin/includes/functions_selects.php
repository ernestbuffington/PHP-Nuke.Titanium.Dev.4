<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            function_selects.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: functions_selects.php,v 1.3.2.4 2002/12/22 12:20:35 psotfx Exp
 *
 ***************************************************************************/

/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
***************************************************************************/

/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
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
      Theme Management                         v1.0.2       12/14/2005
-=[Mod]=-
      Super Quick Reply                        v1.3.0       06/14/2005
      Advanced Time Management                 v2.2.0       07/26/2005
      At a Glance Options                      v1.0.0       08/17/2005
      Group Colors and Ranks                   v1.0.0       08/24/2005
      Log Actions Mod - Topic View             v2.0.0       09/18/2005
	  Birthdays                                v3.0.0
 ************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

//
// Pick a language, any language ...
//
function language_select($default, $select_name = "language", $dirname="modules/Forums/language")
{
        global $phpEx;

        $dir = @opendir($dirname);

        $titanium_lang = array();
        while ( $file = @readdir($dir) )
        {
                if ( preg_match("/^lang_/i", $file) && !is_file($dirname . "/" . $file) && !is_link($dirname . "/" . $file) )
                {
                        $filename = trim(str_replace("lang_", "", $file));
                        $displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
                        $displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
                        $titanium_lang[$displayname] = $filename;
                }
        }

        @closedir($dir);

        @asort($titanium_lang);
        @reset($titanium_lang);

        $titanium_lang_select = '<select class="form-control" name="' . $select_name . '" id="'.$select_name.'">';
        while ( list($displayname, $filename) = @each($titanium_lang) )
        {
                $selected = ( strtolower($default) == strtolower($filename) ) ? ' selected="selected"' : '';
                $titanium_lang_select .= '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
        }
        $titanium_lang_select .= '</select>';

        return $titanium_lang_select;
}

//
// Pick a template/theme combo,
//
/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
function style_select($name="default_Theme")
{
    $themes = get_themes('active');
    $select = "<select class=\"form-control\" name=\"" . $name . "\" id=\"" . $name . "\" $extra>";
    foreach($themes as $theme) {
        $name = (!empty($theme['custom_name'])) ? $theme['custom_name'] : $theme['theme_name'];
        $selected = (is_default($theme['theme_name'])) ? "selected" : "";
        $select .= "<option value=\"" . $theme['theme_name'] . "\" $selected>" . $name . "</option>";
    }
    $select .= "</select>";

    return $select;
}
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

//
// Pick a timezone
//
function tz_select($default, $select_name = 'timezone')
{
        global $sys_timezone, $titanium_lang;

        if ( !isset($default) )
        {
                $default == $sys_timezone;
        }
        $tz_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';

        while( list($offset, $zone) = @each($titanium_lang['tz']) )
        {
                $selected = ( $offset == $default ) ? ' selected="selected"' : '';
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
                $tz_select .= '<option value="' . $offset . '"' . $selected . '>' . str_replace('GMT', 'UTC', $zone) . '</option>';
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
        }
        $tz_select .= '</select>';

        return $tz_select;
}

/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.0 ]
 ******************************************************/
function quick_reply_select($default, $select_name = "show_quickreply")
{
    global $titanium_lang;

    $sqr_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';

    while( list($value, $mode) = @each($titanium_lang['sqr']) )
    {
        $selected = ( $value == $default ) ? ' selected="selected"' : '';
        $sqr_select .= '<option value="' . $value . '"' . $selected . '>' . $mode . '</option>';
    }

    $sqr_select .= '</select>';

    return $sqr_select;

}
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
function glance_option_select($default, $select_name = "glance_show")
{
global $titanium_lang;

    $g_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';

    while( list($value, $text) = @each($titanium_lang['show_glance_option']) )
    {
        $selected = ( $value == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $value . '"' . $selected . '>' . $text . '</option>';
    }

    $g_select .= '</select>';

    return $g_select;
}
/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/
function auc_colors_select($default, $select_name = "color_groups", $value = "group_id")
{
global $titanium_db, $titanium_prefix;

    $g_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';
    $sql = "SELECT * FROM " . $titanium_prefix . "_bbadvanced_username_color  ORDER BY group_name ASC";
    if (!$result = $titanium_db->sql_query($sql)) {
        die(mysql_error());
    }
    $selected = (!$defualt) ? "selected=\"selected\"" : "";
    $g_select .= '<option value="0" '.$selected.'>None</option>';
    while( $row = $titanium_db->sql_fetchrow($result) )
    {
        $selected = ( $row['group_id'] == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $row[$value] . '"' . $selected . '>' . $row['group_name'] . '</option>';
    }
    $titanium_db->sql_freeresult($result);

    $g_select .= '</select>';

    return $g_select;
}

function ranks_select($default, $select_name = "ranks", $value = "rank_id")
{
    global $titanium_db, $titanium_prefix;

    $g_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';
    $sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special = 1 ORDER BY rank_title ASC";
    if (!$result = $titanium_db->sql_query($sql)) {
        die(mysql_error());
    }
    $selected = (!$defualt) ? "selected=\"selected\"" : "";
    $g_select .= '<option value="0" '.$selected.'>None</option>';
    while( $row = $titanium_db->sql_fetchrow($result) )
    {
        $selected = ( $row['rank_id'] == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $row[$value] . '"' . $selected . '>' . $row['rank_title'] . '</option>';
    }
    $titanium_db->sql_freeresult($result);

    $g_select .= '</select>';

    return $g_select;
}
/*****[BEGIN]******************************************
 [ Mod:     Group Colors and Ranks             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Actions Mod - Topic View       v2.0.0 ]
 ******************************************************/
function allow_view_select($default)
{
global $titanium_lang;

    $g_select = '<select class="form-control" name="logs_view_level" id="logs_view_level">';

    while( list($value, $text) = @each($titanium_lang['logs_view_level']) )
    {
        $selected = ( $value == $default ) ? ' selected="selected"' : '';
        $g_select .= '<option value="' . $value . '"' . $selected . '>' . $text . '</option>';
    }

    $g_select .= '</select>';

    return $g_select;
}
/*****[END]********************************************
 [ Mod:     Log Actions Mod - Topic View       v2.0.0 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
function bday_month_select($default, $select_name = 'bday_month')
{
	global $titanium_lang;
	static $translate = array();

	if ( empty($translate) )
	{
		$translate = array(
			$titanium_lang['Default_Month'],
			$titanium_lang['datetime']['January'],
			$titanium_lang['datetime']['February'],
			$titanium_lang['datetime']['March'],
			$titanium_lang['datetime']['April'],
			$titanium_lang['datetime']['May'],
			$titanium_lang['datetime']['June'],
			$titanium_lang['datetime']['July'],
			$titanium_lang['datetime']['August'],
			$titanium_lang['datetime']['September'],
			$titanium_lang['datetime']['October'],
			$titanium_lang['datetime']['November'],
			$titanium_lang['datetime']['December']
		);
	}

	if ( !isset($default) )
	{
		$default = 0;
	}
	$bday_month_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';

	foreach ($translate as $num => $month)
	{
		$selected = ( $num == $default ) ? ' selected="selected"' : '';
		$bday_month_select .= '<option value="' . $num . '"' . $selected . '>' . $month . '</option>';
	}
	$bday_month_select .= '</select>';

	return $bday_month_select;
}

function bday_day_select($default, $select_name = 'bday_day')
{
	global $titanium_lang;
	static $options;

	if ( empty($options) )
	{
		$options = array($titanium_lang['Default_Day']);
		for ($i=0; $i<31; $i++)
		{
			$options[] = $i + 1;
		}
	}

	if ( !isset($default) )
	{
		$default = 0;
	}
	$bday_day_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';

	foreach ($options as $num => $day)
	{
		$selected = ( $num == $default ) ? ' selected="selected"' : '';
		$bday_day_select .= '<option value="' . $num . '"' . $selected . '>' . $day . '</option>';
	}
	$bday_day_select .= '</select>';

	return $bday_day_select;
}

function bday_year_select($default, $select_name = 'bday_year')
{
	global $phpbb2_board_config, $titanium_lang;

	if ( !isset($default) )
	{
		$default = 0;
	}
	$phpbb2_bday_year_select = '<select class="form-control" name="' . $select_name . '" id="' . $select_name . '">';

	$phpbb2_end = gmdate('Y') - $phpbb2_board_config['bday_min'];
	$phpbb2_start = gmdate('Y') - $phpbb2_board_config['bday_max'] - 1;

	$selected = ( !$default ) ? ' selected="selected"' : '';
	$phpbb2_bday_year_select .= '<option value="0"' . $selected . '>' . $titanium_lang['Default_Year'] . '</option>';

	for ($i=$phpbb2_end;$i>=$phpbb2_start;$i--)
	{
		$selected = ( $i == $default ) ? ' selected="selected"' : '';
		$phpbb2_bday_year_select .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
	}
	$phpbb2_bday_year_select .= '</select>';

	return $phpbb2_bday_year_select;
}
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

?>