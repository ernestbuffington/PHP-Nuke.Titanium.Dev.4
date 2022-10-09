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
      Evolution Functions                      v1.5.0       12/20/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die ('Access Denied');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(is_mod_admin($module_name)) {

    $stop = '';
    if ($chng_uname != $old_uname) { ya_userCheck($chng_uname); }
    if ($chng_email != $old_email) { ya_mailCheck($chng_email); }
    if (!empty($chng_pass) OR !empty($chng_pass2)) { ya_passCheck($chng_pass, $chng_pass2); }
    $chng_uname = ya_fixtext($chng_uname);
    $chng_name = ya_fixtext($chng_name);
    $chng_email = ya_fixtext($chng_email);
    $chng_femail = ya_fixtext($chng_femail);
    $chng_url = ya_fixtext($chng_url);
    $chng_user_occ = ya_fixtext($chng_user_occ);
    $chng_user_from = ya_fixtext($chng_user_from);
    $chng_user_intrest = ya_fixtext($chng_user_intrest);
    $chng_avatar = ya_fixtext($chng_avatar);
    $chng_user_viewemail = intval($chng_user_viewemail);
    $chng_user_sig = ya_fixtext($chng_user_sig);
    $chng_newsletter = intval($chng_newsletter);
    $chng_points = 0;

    if (empty($stop)) 
    {
        if (!empty($chng_pass)) 
        {
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $cpass = md5($chng_pass);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $db->sql_query("UPDATE ".$user_prefix."_users SET username='$chng_uname', name='$chng_name', user_email='$chng_email', femail='$chng_femail', user_website='$chng_url', user_from='$chng_user_from', user_occ='$chng_user_occ', user_interests='$chng_user_interests', user_viewemail='$chng_user_viewemail', user_avatar='$chng_avatar', user_sig='$chng_user_sig', user_password='$cpass', newsletter='$chng_newsletter' WHERE user_id='$chng_uid'");
            if ($Version_Num > 6.9) { $db->sql_query("UPDATE ".$user_prefix."_users SET points='$chng_points' WHERE user_id='$chng_uid'"); }
        } else {
            $db->sql_query("UPDATE ".$user_prefix."_users SET username='$chng_uname', name='$chng_name', user_email='$chng_email', femail='$chng_femail', user_website='$chng_url', user_from='$chng_user_from', user_occ='$chng_user_occ', user_interests='$chng_user_interests', user_viewemail='$chng_user_viewemail', user_avatar='$chng_avatar', user_sig='$chng_user_sig', newsletter='$chng_newsletter' WHERE user_id='$chng_uid'");
            if ($Version_Num > 6.9) { $db->sql_query("UPDATE ".$user_prefix."_users SET points='$chng_points' WHERE user_id='$chng_uid'"); }
        }

        if (is_array($nfield)):

            if (count($nfield) > 0) 
            {
                foreach ($nfield as $key => $var) 
                {
                    $nfield[$key] = ya_fixtext($nfield[$key]);
                    if (($db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_value WHERE fid='$key' AND uid = '$chng_uid'"))) == 0) 
                    {
                        $sql = "INSERT INTO ".$user_prefix."_cnbya_value (uid, fid, value) VALUES ('$chng_uid', '$key','$nfield[$key]')";
                        $db->sql_query($sql);
                    }
                    else 
                    {
                        $db->sql_query("UPDATE ".$user_prefix."_cnbya_value SET value='$nfield[$key]' WHERE fid='$key' AND uid = '$chng_uid'");
                    }
                }
            }

        endif;

        $pagetitle = ": "._USERADMIN." - "._ACCTMODIFY;
        include_once(NUKE_BASE_DIR.'header.php');
		OpenTable();
	    echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        amain();
        echo "<br />\n";
        OpenTable();
        echo "<center><table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
        if (isset($query)) { echo "<input type='hidden' name='query' value='$query'>\n"; }
        if (isset($min)) { echo "<input type='hidden' name='min' value='$min'>\n"; }
        if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop'>\n"; }
        echo "<tr><td align='center'><strong>"._ACCTMODIFY."</strong></td></tr>\n";
        echo "<tr><td align='center'><input type='submit' value='"._RETURN2."'></td></tr>\n";
        echo "</form>\n";
        echo "</table></center>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        $pagetitle = ": "._USERADMIN;
        include_once(NUKE_BASE_DIR.'header.php');
		OpenTable();
	    echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        title(_USERADMIN);
        amain();
        echo "<br />\n";
        OpenTable();
        echo "<strong>$stop</strong>\n";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        return;
    }

}

?>