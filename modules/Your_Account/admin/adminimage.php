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

/*if (!defined('MODULE_FILE')) {
    die ('Access Denied');
}*/

    $codeimg    = "http://nexus.flexihostings.net/~magnolia/onvergetelijk/images/admin/users.png";
    $code        = "4.4";
    include("themes/$ThemeSel/theme.php");
    $tcolor    = str_replace("#", "", $textcolor1);
    $tc_r    = hexdec(substr($tcolor, 0, 2));
    $tc_g    = hexdec(substr($tcolor, 2, 2));
    $tc_b    = hexdec(substr($tcolor, 4, 2));
    $image = ImageCreateFromPNG($codeimg);
    $text_color = ImageColorAllocate($image, $tc_r, $tc_g, $tc_b);
    Header("Content-type: image/png");
    ImageString ($image, 2, 3, 20, $code, $text_color);
    ImagePNG($image, '', 75);
    ImageDestroy($image);
//    exit;
//    break;

?>