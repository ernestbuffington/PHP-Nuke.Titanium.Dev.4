<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                  rules.php
 *                            -------------------
 *
 *   copyright            : (C) 2002 Dimitri Seitz
 *   email                : dwing@weingarten-net.de <http://www.dseitz.de>
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
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

$phpbb2_root_path = NUKE_FORUMS_DIR;
define('IN_PHPBB2', true);
include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);
include("includes/bbcode.php");
include(NUKE_BASE_DIR."header.php");
//
// Start session management
//
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_FAQ);
titanium_init_userprefs($userdata);
//
// End session management
//

//
// Load the appropriate Rules file
//
$titanium_lang_file = 'lang_rules';
$l_title = $titanium_lang['rules'];

//
// Include the rules settings
//
include($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/' . $titanium_lang_file . '.' . $phpEx);

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
$phpbb2_page_title = $l_title;
include('includes/page_header.'.$phpEx);

$phpbb2_template->set_filenames(array(
    'body' => 'rules_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx, $phpbb2_forum_id);

$phpbb2_template->assign_vars(array(
    'L_FAQ_TITLE' => $l_title, 
    'L_BACK_TO_TOP' => $titanium_lang['Back_to_top'])
);

for($i = 0; $i < count($faq_block); $i++)
{
    if( count($faq_block[$i]) )
    {
        $phpbb2_template->assign_block_vars('faq_block', array(
            'BLOCK_TITLE' => $faq_block_titles[$i])
        );
        $phpbb2_template->assign_block_vars('faq_block_link', array( 
            'BLOCK_TITLE' => $faq_block_titles[$i])
        );

        for($j = 0; $j < count($faq_block[$i]); $j++)
        {
            $row_color = ( !($j % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($j % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
      $message = bbencode_first_pass($faq_block[$i][$j]['answer'], $bbcode_uid);
      //$bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
      $message = bbencode_second_pass($message, $bbcode_uid);
            $phpbb2_template->assign_block_vars('faq_block.faq_row', array(
                'ROW_COLOR' => '#' . $row_color,
                'ROW_CLASS' => $row_class,
                'FAQ_QUESTION' => $faq_block[$i][$j]['question'], 
                'FAQ_ANSWER' => $message,
                'U_FAQ_ID' => $faq_block[$i][$j]['id'])
            );

            $phpbb2_template->assign_block_vars('faq_block_link.faq_row_link', array(
                'ROW_COLOR' => '#' . $row_color,
                'ROW_CLASS' => $row_class,
                'FAQ_LINK' => $faq_block[$i][$j]['question'], 
                'U_FAQ_LINK' => '#' . $faq_block[$i][$j]['id'])
            );
        }
    }
}

$phpbb2_template->pparse('body');

include('includes/page_tail.'.$phpEx);

?>