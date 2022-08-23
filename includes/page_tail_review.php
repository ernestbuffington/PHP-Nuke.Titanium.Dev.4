<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                              page_tail.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: page_tail.php,v 1.27.2.1 2002/05/12 00:47:41 psotfx Exp
 *
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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//
// Show the overall footer.
//
global $popup, $admin_file;
$admin_link = ( $userdata['user_level'] == ADMIN ) ? '<a href="'.$admin_file.'.php?op=forums">' . $lang['Admin_panel'] . '</a><br /><br />' : '';

$template->set_filenames(array(
    'overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl')
);

$template->assign_vars(array(
    'PHPBB_VERSION' => '2' . $board_config['version'],
    'TRANSLATION_INFO' => ( isset($lang['TRANSLATION_INFO']) ) ? $lang['TRANSLATION_INFO'] : '',
    'ADMIN_LINK' => $admin_link)
);

//
// Close our DB connection.
//
$db->sql_close();

//
// Compress buffered output if required and send to browser
//

?>