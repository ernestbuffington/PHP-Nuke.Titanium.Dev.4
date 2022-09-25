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
 *   Id: page_tail.php,v 1.27.2.3 2004/12/22 02:04:00 psotfx Exp
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
      Report Posts                             v1.2.3       08/30/2005
 ************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

//
// Show the overall footer.
//
global $popup, $admin_file, $cache;
$admin_link = ( $userdata['user_level'] == ADMIN ) ? '<a href="modules/Forums/admin/index.php">' . $titanium_lang['Admin_panel'] . '</a><br /><br />' : '';

/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
include_once('includes/functions_report.'.$phpEx);

if ( $userdata['user_level'] >= ADMIN )
{
    $open_reports = reports_count();
    if ( $open_reports == 0 )
    {
        $open_reports = sprintf($titanium_lang['Post_reports_none_cp'],$open_reports);
    }
    else 
    {
        $open_reports = sprintf(( ($open_reports == 1) ? $titanium_lang['Post_reports_one_cp'] : $titanium_lang['Post_reports_many_cp']), $open_reports);
        $open_reports = '<span style="color:#' . $theme['fontcolor2'] . '">' . $open_reports . '</span>';
    }

    $report_link = '&nbsp; <a href="' . append_titanium_sid('viewpost_reports.'.$phpEx) . '">' . $open_reports . '</a> &nbsp;';
}
else
{
    $report_link = '';
}
/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/

$phpbb2_template->set_filenames(array(
        'overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl')
);

$phpbb2_template->assign_vars(array(
        'TRANSLATION_INFO' => (isset($titanium_lang['TRANSLATION_INFO'])) ? $titanium_lang['TRANSLATION_INFO'] : ((isset($titanium_lang['TRANSLATION'])) ? $titanium_lang['TRANSLATION'] : ''),
/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
        'REPORT_LINK' => $report_link,
        'ADMIN_LINK' => $admin_link)
/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
);

$phpbb2_template->pparse('overall_footer');
CloseTable();
//
// Close our DB connection.
//
if ($popup != 1) {
    include_once("footer.php");
} else {
     $cache->resync();
     $titanium_db->sql_close();
}

//
// Compress buffered output if required and send to browser
//

?>