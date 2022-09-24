<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                           page_header_printer.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *   modified             : (C) 2003 Svyatozar svyatozar@pochtamt.ru
 *                          for a new mod 'printer_topic'
 *
 *   page_header_printer.php,v 2.0 2003/11/13
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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

define('HEADER_INC', true);

//
// gzip_compression
//
$do_gzip_compress = FALSE;

$phpbb2_template->set_filenames(array(
    'header' => 'printer_header.tpl')
);

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $phpbb2_board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $titanium_lang[sprintf('%.1f', $phpbb2_board_config['board_timezone'])] : $titanium_lang[number_format($phpbb2_board_config['board_timezone'])];
//
// The following assigns all _common_ variables that may be used at any point
// in a template. Note that all URL's should be wrapped in append_titanium_sid, as
// should all S_x_ACTIONS for forms.
//

$phpbb2_template->assign_vars(array(
    'SITENAME' => $phpbb2_board_config['sitename'],
    'PAGE_TITLE' => $phpbb2_page_title,

    'L_ADMIN' => $titanium_lang['Admin'],
    'L_USERNAME' => $titanium_lang['Username'],
    'L_PASSWORD' => $titanium_lang['Password'],
    
	'L_INDEX' => $titanium_lang['Forum_Index'],
	'L_INDEXHOME' => $titanium_lang['Home_Index'],
    
	'L_REGISTER' => $titanium_lang['Register'],
    'L_PROFILE' => $titanium_lang['Profile'],
    'L_SEARCH' => $titanium_lang['Search'],
    'L_PRIVATEMSGS' => $titanium_lang['Private_msgs'],
    'L_MEMBERLIST' => $titanium_lang['Memberlist'],
    'L_FAQ' => $titanium_lang['FAQ'],
    'L_USERGROUPS' => $titanium_lang['Usergroups'],
    'L_FORUM' => $titanium_lang['Forum'],
    'L_TOPICS' => $titanium_lang['Topics'],
    'L_REPLIES' => $titanium_lang['Replies'],
    'L_VIEWS' => $titanium_lang['Views'],
    'L_POSTS' => $titanium_lang['Posts'],
    'L_LASTPOST' => $titanium_lang['Last_Post'],
    'L_MODERATOR' => $titanium_lang['Moderator'],
    'L_NONEWPOSTS' => $titanium_lang['No_new_posts'],
    'L_NEWPOSTS' => $titanium_lang['New_posts'],
    'L_POSTED' => $titanium_lang['Posted'],
    'L_JOINED' => $titanium_lang['Joined'],
    'L_AUTHOR' => $titanium_lang['Author'],
    'L_MESSAGE' => $titanium_lang['Message'],
    'L_BY' => $titanium_lang['by'],
    'L_MESSAGES' => $titanium_lang['All_Messages'],
    'L_FROM' => $titanium_lang['From'],
    'L_FAQ' => $titanium_lang['FAQ'],
    'L_SELECT_MESSAGES_FROM' => $titanium_lang['printertopic_Select_messages_from'],
    'L_SELECT_THROUGH' => $titanium_lang['printertopic_through'],
    'L_BOX1_DESC' => $titanium_lang['printertopic_box1_desc'],
    'L_BOX2_DESC' => $titanium_lang['printertopic_box2_desc'],
    'L_SHOW' => $titanium_lang['printertopic_Show'],
    'L_PRINT' => $titanium_lang['printertopic_Print'],
    'L_PRINT_DESC' => $titanium_lang['printertopic_Print_desc'],
    'U_INDEX' => append_titanium_sid('index.'.$phpEx),

    # Home Index Mod START
	'U_HINDEX' => titanium_home_sid('index.'.$phpEx),
    # Home Index Mod END

	'U_FAQ' => append_titanium_sid('faq.'.$phpEx),
    'S_TIMEZONE' => sprintf($titanium_lang['All_times'], $l_timezone),
    'S_LOGIN_ACTION' => append_titanium_sid('../login.'.$phpEx),
    'S_JUMPBOX_ACTION' => append_titanium_sid('../viewforum.'.$phpEx),
    'S_CURRENT_TIME' => sprintf($titanium_lang['Current_time'], create_date($phpbb2_board_config['default_dateformat'], time(), $phpbb2_board_config['board_timezone'])),
    'S_CONTENT_DIRECTION' => $titanium_lang['DIRECTION'],
    'S_CONTENT_ENCODING' => $titanium_lang['ENCODING'],
    'S_CONTENT_DIR_LEFT' => $titanium_lang['LEFT'],
    'S_CONTENT_DIR_RIGHT' => $titanium_lang['RIGHT'],

    'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
    'T_BODY_BACKGROUND' => "",
    'T_BODY_BGCOLOR' => '#'."ffffff",
    'T_BODY_TEXT' => '#'."000000",
    'T_BODY_LINK' => '#'."000000",
    'T_BODY_VLINK' => '#'."000000",
    'T_BODY_ALINK' => '#'."000000",
    'T_BODY_HLINK' => '#'."000000",
    'T_TR_COLOR1' => '#'."ffffff",
    'T_TR_COLOR2' => '#'."ffffff",
    'T_TR_COLOR3' => '#'."ffffff",
    'T_TR_CLASS1' => "",
    'T_TR_CLASS2' => "",
    'T_TR_CLASS3' => "",
    'T_TH_COLOR1' => '#'."ffffff",
    'T_TH_COLOR2' => '#'."ffffff",
    'T_TH_COLOR3' => '#'."ffffff",
    'T_TH_CLASS1' => "",
    'T_TH_CLASS2' => "",
    'T_TH_CLASS3' => "",
    'T_TD_COLOR1' => '#'."ffffff",
    'T_TD_COLOR2' => '#'."ffffff",
    'T_TD_COLOR3' => '#'."ffffff",
    'T_TD_CLASS1' => "",
    'T_TD_CLASS2' => "",
    'T_TD_CLASS3' => "",
    'T_FONTFACE1' => "Verdana, Arial, Helvetica, sans-serif",
    'T_FONTFACE2' => "Trebuchet MS",
    'T_FONTFACE3' => "Courier, Courier New, sans-serif",
    'T_FONTSIZE1' => "10",
    'T_FONTSIZE2' => "11",
    'T_FONTSIZE3' => "12",
    'T_FONTCOLOR1' => '#'."444444",
    'T_FONTCOLOR2' => '#'."000000",
    'T_FONTCOLOR3' => '#'."000000",
    'T_SPAN_CLASS1' => "",
    'T_SPAN_CLASS2' => "",
    'T_SPAN_CLASS3' => "")
);

$phpbb2_template->pparse('header');

?>