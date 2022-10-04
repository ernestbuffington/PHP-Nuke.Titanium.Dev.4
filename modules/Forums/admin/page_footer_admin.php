<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                           page_footer_admin.php
 *                            -------------------
 *   begin                : Saturday, Jul 14, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: page_footer_admin.php,v 1.9.2.3 2005/04/15 20:15:47 acydburn Exp
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

global $do_gzip_compress, $phpbb2_template, $cache, $userdata, $titanium_db, $lang, $phpbb2_board_config;
//
// Show the overall footer.
//
$phpbb2_template->set_filenames(array(
        'page_footer' => 'admin/page_footer.tpl')
);

$phpbb2_template->assign_vars(array(
    'PHPBB_VERSION' => ($userdata['user_level'] == ADMIN && $userdata['user_id'] != ANONYMOUS) ? '2' . $phpbb2_board_config['version'] : '',
        'TRANSLATION_INFO' => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''))
);

$phpbb2_template->pparse('page_footer');

//
// Resync changed chache
//
$cache->resync();

//
// Close our DB connection.
//
$titanium_db->sql_close();

//
// Compress buffered output if required
// and send to browser
//
if( $do_gzip_compress )
{
        //
        // Borrowed from php.net!
        //
        $gzip_contents = ob_get_contents();
        ob_end_clean();

        $gzip_size = strlen($gzip_contents);
        $gzip_crc = crc32($gzip_contents);

        $gzip_contents = gzcompress($gzip_contents, 9);
        $gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

        echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
        echo $gzip_contents;
        echo pack('V', $gzip_crc);
        echo pack('V', $gzip_size);
}

exit;

?>