<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                  faq.php
 *                            -------------------
 *   begin                : Sunday, Jul 8, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: faq.php,v 1.14.2.2 2004/07/11 16:46:15 acydburn Exp
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
      FAQ Admin Addon                          v1.0.0       07/08/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
require("modules/".$module_name."/nukebb.php");

define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_FAQ);
init_userprefs($userdata);
//
// End session management
//
// Set vars to prevent naughtiness
$faq = array();
//
// Load the appropriate faq file
//
/*if( isset($HTTP_GET_VARS['mode']) )
{*/
$mode = request_var('mode', '');
        switch(isset($HTTP_GET_VARS['mode']))
        {
                case 'bbcode':
                        $lang_file = 'lang_bbcode';
                        $l_title = $lang['BBCode_guide'];
                        break;
/*****[BEGIN]******************************************
 [ Mod:    FAQ Admin Addon                     v1.0.0 ]
 ******************************************************/
                case 'faq_attach':
                        $lang_file = 'lang_faq_attach';
                        $l_title = $lang['BBCode_attach'];
                        break;
                case 'rules':
                        $lang_file = 'lang_rules';
                        $l_title = $lang['BBCode_rules'];
                        break;
/*****[END]********************************************
 [ Mod:    FAQ Admin Addon                     v1.0.0 ]
 ******************************************************/
                default:
                        $lang_file = 'lang_faq';
                        $l_title = $lang['FAQ'];
                        break;
        }
/*}
else
{
        $lang_file = 'lang_faq';
        $l_title = $lang['FAQ'];
}*/
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/' . $lang_file . '.' . $phpEx);

/*****[BEGIN]******************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/
attach_faq_include($lang_file);
/*****[END]********************************************
 [ Mod:    Attachment Mod                      v2.4.1 ]
 ******************************************************/

//
// Pull the array data from the lang pack
//
$j = 0;
$counter = 0;
$counter_2 = 0;
$faq_block = array();
$faq_block_titles = array();

for($i = 0; $i < count($faq); $i++)
{
        if( $faq[$i][0] != '--' )
        {
                $faq_block[$j][$counter]['id'] = $counter_2;
                $faq_block[$j][$counter]['question'] = $faq[$i][0];
                $faq_block[$j][$counter]['answer'] = $faq[$i][1];

                $counter++;
                $counter_2++;
        }
        else
        {
                $j = ( $counter != 0 ) ? $j + 1 : 0;

                $faq_block_titles[$j] = $faq[$i][1];

                $counter = 0;
        }
}

//
// Lets build a page ...
//
$page_title = $l_title;
include("includes/page_header.php");

$template->set_filenames(array(
        'body' => 'faq_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
        'L_FAQ_TITLE' => $l_title,
        'L_BACK_TO_TOP' => $lang['Back_to_top'])
);

for($i = 0; $i < count($faq_block); $i++)
{
        if( count($faq_block[$i]) )
        {
                $template->assign_block_vars('faq_block', array(
                        'BLOCK_TITLE' => $faq_block_titles[$i])
                );
                $template->assign_block_vars('faq_block_link', array(
                        'BLOCK_TITLE' => $faq_block_titles[$i])
                );

                for($j = 0; $j < count($faq_block[$i]); $j++)
                {
                        $row_color = ( !($j % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                        $row_class = ( !($j % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                        $template->assign_block_vars('faq_block.faq_row', array(
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'FAQ_QUESTION' => $faq_block[$i][$j]['question'],
                                'FAQ_ANSWER' => $faq_block[$i][$j]['answer'],

                                'U_FAQ_ID' => $faq_block[$i][$j]['id'])
                        );

                        $template->assign_block_vars('faq_block_link.faq_row_link', array(
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'FAQ_LINK' => $faq_block[$i][$j]['question'],

                                'U_FAQ_LINK' => '#' . $faq_block[$i][$j]['id'])
                        );
                }
        }
}

$template->pparse('body');

include("includes/page_tail.php");

?>