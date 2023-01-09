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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

define_once('HEADER_INC', true);

//
// gzip_compression
//
$do_gzip_compress = FALSE;

$template->set_filenames(['header' => 'printer_header.tpl']
);

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', (string) $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];
//
// The following assigns all _common_ variables that may be used at any point
// in a template. Note that all URL's should be wrapped in append_sid, as
// should all S_x_ACTIONS for forms.
//
if(!isset($lang['Private_msgs']))
$lang['Private_msgs'] = 'Private Messages';
if(!isset($lang['by']))
$lang['by'] = 'By';

$template->assign_vars(['SITENAME' => $board_config['sitename'], 
                        'PAGE_TITLE' => $page_title, 
						'L_ADMIN' => $lang['Admin'], 
						'L_USERNAME' => $lang['Username'], 
						'L_PASSWORD' => $lang['Password'], 
						'L_INDEX' => $lang['Forum_Index'], 
						'L_REGISTER' => $lang['Register'], 
						'L_PROFILE' => $lang['Profile'], 
						'L_SEARCH' => $lang['Search'], 
						'L_PRIVATEMSGS' => $lang['Private_msgs'], 
						'L_MEMBERLIST' => $lang['Memberlist'], 
						'L_FAQ' => $lang['FAQ'], 
						'L_USERGROUPS' => $lang['Usergroups'], 'L_FORUM' => $lang['Forum'], 
						'L_TOPICS' => $lang['Topics'], 
						'L_REPLIES' => $lang['Replies'], 
						'L_VIEWS' => $lang['Views'], 
						'L_POSTS' => $lang['Posts'], 
						'L_LASTPOST' => $lang['Last_Post'], 
						'L_MODERATOR' => $lang['Moderator'], 
						'L_NONEWPOSTS' => $lang['No_new_posts'], 
						'L_NEWPOSTS' => $lang['New_posts'], 
						'L_POSTED' => $lang['Posted'], 
						'L_JOINED' => $lang['Joined'], 
						'L_AUTHOR' => $lang['Author'], 
						'L_MESSAGE' => $lang['Message'], 
						'L_BY' => $lang['by'], 'L_MESSAGES' => $lang['All_Messages'], 
						'L_FROM' => $lang['From'], 
						'L_FAQ' => $lang['FAQ'], 
						'L_SELECT_MESSAGES_FROM' => $lang['printertopic_Select_messages_from'], 
						'L_SELECT_THROUGH' => $lang['printertopic_through'], 
						'L_BOX1_DESC' => $lang['printertopic_box1_desc'], 
						'L_BOX2_DESC' => $lang['printertopic_box2_desc'], 
						'L_SHOW' => $lang['printertopic_Show'], 
						'L_PRINT' => $lang['printertopic_Print'], 
						'L_PRINT_DESC' => $lang['printertopic_Print_desc'], 
						'U_INDEX' => append_sid('index.'.$phpEx), 
						'U_FAQ' => append_sid('faq.'.$phpEx), 
						'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone), 
						'S_LOGIN_ACTION' => append_sid('../login.'.$phpEx), 
						'S_JUMPBOX_ACTION' => append_sid('../viewforum.'.$phpEx), 
						'S_CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])), 
						'S_CONTENT_DIRECTION' => $lang['DIRECTION'], 
						'S_CONTENT_ENCODING' => $lang['ENCODING'], 
						'S_CONTENT_DIR_LEFT' => $lang['LEFT'], 
						'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'], 
						'T_HEAD_STYLESHEET' => $theme['head_stylesheet'], 
						'T_BODY_BACKGROUND' => "", 
						'T_BODY_BGCOLOR' => '#ffffff', 
						'T_BODY_TEXT' => '#000000', 
						'T_BODY_LINK' => '#000000', 
						'T_BODY_VLINK' => '#000000', 
						'T_BODY_ALINK' => '#000000', 
						'T_BODY_HLINK' => '#000000', 
						'T_TR_COLOR1' => '#ffffff', 
						'T_TR_COLOR2' => '#ffffff', 
						'T_TR_COLOR3' => '#ffffff', 
						'T_TR_CLASS1' => "", 
						'T_TR_CLASS2' => "", 
						'T_TR_CLASS3' => "", 
						'T_TH_COLOR1' => '#ffffff', 
						'T_TH_COLOR2' => '#ffffff', 
						'T_TH_COLOR3' => '#ffffff', 
						'T_TH_CLASS1' => "", 
						'T_TH_CLASS2' => "", 
						'T_TH_CLASS3' => "", 
						'T_TD_COLOR1' => '#ffffff', 
						'T_TD_COLOR2' => '#ffffff', 
						'T_TD_COLOR3' => '#ffffff', 
						'T_TD_CLASS1' => "", 
						'T_TD_CLASS2' => "", 
						'T_TD_CLASS3' => "", 
						'T_FONTFACE1' => "Verdana, Arial, Helvetica, sans-serif", 
						'T_FONTFACE2' => "Trebuchet MS", 
						'T_FONTFACE3' => "Courier, Courier New, sans-serif", 
						'T_FONTSIZE1' => "10", 
						'T_FONTSIZE2' => "11", 
						'T_FONTSIZE3' => "12", 
						'T_FONTCOLOR1' => '#444444', 
						'T_FONTCOLOR2' => '#000000', 
						'T_FONTCOLOR3' => '#000000', 
						'T_SPAN_CLASS1' => "", 
						'T_SPAN_CLASS2' => "", 
						'T_SPAN_CLASS3' => ""]);

$template->pparse('header');

?>
