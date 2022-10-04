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
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion  */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE') || !defined('CNBYA') || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('You can\'t access this file directly...');
}

$pnt_username = $pnt_db->sql_escapestring($_POST['username']);

if (empty($pnt_username)) 
{
    echo '';
} 
elseif (strlen($pnt_username) <= 3) 
{
    echo '&nbsp;<img src="images/not-available.png" alt"" height="16" width="16" style="vertical-align: middle;">&nbsp;';
    echo '<span style="color: #FF9E00; font-weight: bold;">' . _TOOSHORT . '</span>';
} 
else 
{
	$query = $pnt_db->sql_numrows($pnt_db->sql_query("SELECT username FROM `" . $pnt_user_prefix . "_users` WHERE LCASE(username)='" . $pnt_username . "'"));
    $result = $pnt_db->sql_query("SELECT `username` FROM `" . $pnt_user_prefix . "_users` WHERE LCASE(username) = '".strtolower($pnt_username)."'");
	$totalCount = $pnt_db->sql_numrows($result);

    if ($totalCount == 0) 
	{
        echo '&nbsp;<img src="images/available.png" alt"" height="16" width="16" style="vertical-align: middle;">&nbsp;';
        echo '<span style="color: #18B300; font-weight: bold;">' . _NOTAVAILABLE . '</span>';
    } 
	else 
	{
        echo '&nbsp;<img src="images/not-available.png" alt"" height="16" width="16" style="vertical-align: middle;">&nbsp;';
        echo '<span style="color: #FF0000; font-weight: bold;">' . _AVALIABLE . '</span>';
    }

    $pnt_db->sql_freeresult($result);
}

die();