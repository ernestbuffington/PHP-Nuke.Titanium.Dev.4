<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                        lang_extend_mac.php
 *                        -------------------
 *    begin            : 16/10/2003
 *    copyright        : Ptirhiik
 *    email            : ptirhiik@clanmckeen.com
 *
 *    version            : v 1.0.0 - 16/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Simply Merge Threads                     v1.0.1       06/12/2005
      Ranks summarize                          v1.0.4       06/24/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

/*****[BEGIN]******************************************
 [ Mod:    Simply Merge Threads                v1.0.1 ]
 [ Mod:    Ranks summarize                     v1.0.4 ]
 ******************************************************/
if ( !defined('LANG_EXTEND_DONE') )
{
    // check for admin part
    $lang_extend_admin = defined('IN_ADMIN');

    // get the english settings
    if ( $board_config['default_lang'] != 'english' )
    {
        $dir = @opendir($phpbb_root_path . 'language/lang_english');
        while( $file = @readdir($dir) )
        {
            if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
            {
                @include_once($phpbb_root_path . 'language/lang_english/' . $file);
            }
        }
        // include the personalisations
        @include_once($phpbb_root_path . 'language/lang_english/lang_extend.' . $phpEx);
        @closedir($dir);
    }

    // get the user settings
    if ( !empty($board_config['default_lang']) )
    {
        $dir = @opendir($phpbb_root_path . 'language/lang_' . $board_config['default_lang']);
        while( $file = @readdir($dir) )
        {
            if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
            {
                @include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/' . $file);
            }
        }
        // include the personalisations
        if(file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_extend.' . $phpEx)) {
		@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_extend.' . $phpEx);
		}
        @closedir($dir);
    }
    define('LANG_EXTEND_DONE', true);
}
/*****[END]********************************************
 [ Mod:    Ranks summarize                     v1.0.4 ]
 [ Mod:    Simply Merge Threads                v1.0.1 ]
 ******************************************************/

?>