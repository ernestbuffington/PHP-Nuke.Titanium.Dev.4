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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

# Show the overall footer.
global $popup, $admin_file, $cache;
$admin_link = ( $userdata['user_level'] == ADMIN ) ? '<a href="modules/Forums/admin/index.php" target="_blank">' . $lang['Admin_panel'] . '</a><br /><br />' : '';

# Mod: Report Posts v1.2.3 START
include_once(NUKE_BASE_DIR . '/includes/functions_report.'.$phpEx);

if ( $userdata['user_level'] >= ADMIN )
{
    $open_reports = reports_count();
    if ( $open_reports == 0 )
    {
        $open_reports = sprintf($lang['Post_reports_none_cp'],$open_reports);
    }
    else 
    {
        $open_reports = sprintf(( ($open_reports == 1) ? $lang['Post_reports_one_cp'] : $lang['Post_reports_many_cp']), $open_reports);
        $open_reports = '<span style="color:#' . $theme['fontcolor2'] . '">' . $open_reports . '</span>';
    }

    $report_link = '&nbsp; <a href="' . append_sid('viewpost_reports.'.$phpEx) . '">' . $open_reports . '</a> &nbsp;';
}
else
{
    $report_link = '';
}
# Mod: Report Posts v1.2.3 END

$template->set_filenames(['overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl']
);

$template->assign_vars([
    'TRANSLATION_INFO' => $lang['TRANSLATION_INFO'] ?? $lang['TRANSLATION'] ?? '',
     # Mod: Report Posts v1.2.3 START
    'REPORT_LINK' => $report_link,
    'ADMIN_LINK' => $admin_link,
     # Mod: Report Posts v1.2.3 END
]
);

$template->pparse('overall_footer');

CloseTable();

# Close our DB connection.
if (!isset($popup)) {
    include_once(NUKE_BASE_DIR . "/footer.php");
} else {
     $cache->resync();
     $db->sql_close();
}

# Compress buffered output if required and send to browser

?>
