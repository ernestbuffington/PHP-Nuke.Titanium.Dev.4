<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                             sql_parse.php
*                              -------------------
*     begin                : Thu May 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*     $Id: sql_parse.php,v 1.8 2002/03/18 23:53:12 psotfx Exp $
*
****************************************************************************/

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

/***************************************************************************
*
*        These functions are mainly for use in the db_utilities under the admin
*        however in order to make these functions available elsewhere, specifically
*        in the installation phase of phpBB I have seperated out a couple of
*        functions into this file.  JLH
*
\***************************************************************************/

 /*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//
// remove_comments will strip the sql comment lines out of an uploaded sql file
// specifically for mssql and postgres type files in the install....
//
function remove_comments(&$output)
{
        $lines = explode("\n", $output);
        $output = "";

        // try to keep mem. use down
        $linecount = count($lines);

        $in_comment = false;
        for($i = 0; $i < $linecount; $i++)
        {
                if( preg_match("/^\/\*/", preg_quote($lines[$i])) )
                {
                        $in_comment = true;
                }

                if( !$in_comment )
                {
                        $output .= $lines[$i] . "\n";
                }

                if( preg_match("/\*\/$/", preg_quote($lines[$i])) )
                {
                        $in_comment = false;
                }
        }

        unset($lines);
        return $output;
}

//
// remove_remarks will strip the sql comment lines out of an uploaded sql file
//
function remove_remarks($sql)
{
        include_once(NUKE_CLASSES_DIR.'class.database.php');
        return DB::remove_remarks($sql);
}

//
// split_sql_file will split an uploaded sql file into single sql statements.
// Note: expects trim() to have already been run on $sql.
//
function split_sql_file(&$sql, $delimiter)
{
        include_once(NUKE_CLASSES_DIR.'class.database.php');
        return DB::split_sql_file($sql, $delimiter);
}

?>