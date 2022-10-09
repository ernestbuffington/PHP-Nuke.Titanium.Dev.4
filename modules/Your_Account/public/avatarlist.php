<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

    include_once(NUKE_BASE_DIR.'header.php');
    $avatarcatname = str_replace ("_", "&nbsp;", $avatarcategory);
    title($avatarcategory." "._YA_AVATARGALL);
    Opentable();
    nav();
    CloseTable();
    echo "<br />";
    Opentable();
    echo "<center><span class=\"title\"><strong>"._AVAILABLEAVATARS." "._YA_ONCAT." ".$avatarcatname."</strong></span><br /><br />"; 
    echo "<strong>"._YA_TOSELCTAVAT."</strong><br /><br /></center>";
    Opentable2();
    echo "<center>";
    
    //avatarfix by menelaos dot hetnet dot nl
    $direktori = $board_config['avatar_gallery_path'];
    $d = dir("$direktori/$avatarcategory");
    
    $temcount = 1;
    while (false !== ($entry = $d->read())) {
        if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $entry) ) {
            if( $entry != '.' && $entry != '..' && !is_file($d . '/' . $entry) && !is_link($d . '/' . $entry) ) {
                $patterns[0] = "/\.gif/";
                $patterns[1] = "/\.png/";
                $patterns[2] = "/\.jpg/";
                $patterns[3] = "/\.jpeg/";
                $patterns[4] = "/-/";
                $patterns[5] = "/_/";
                $replacements[5] = "";
                $replacements[4] = "&nbsp;";
                $replacements[3] = "";
                $replacements[2] = "";
                $replacements[1] = "";
                $replacements[0] = "";
                ksort($patterns);
                ksort($replacements);
                $entryname =  preg_replace($patterns, $replacements, $entry);
                $a=1;
                
                //avatarfix by menelaos dot hetnet dot nl
                echo "<a href=\"modules.php?name=$module_name&amp;op=avatarsave&amp;category=$avatarcategory&amp;avatar=$entry\"><img src=\"$direktori/$avatarcategory/$entry\" border=\"0\" alt=\"$entryname\" title=\"$entryname\" hspace=\"10\" vspace=\"10\"></a>";
            }
            if ($temcount == 10) {
                echo "<br />";
                $temcount -= 10;
            }
            $temcount ++;
        }
    }
    echo "</center>";
    CloseTable2();
    echo "<center><br />"._GOBACK."<br /></center>";
    $d->close();
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

?>