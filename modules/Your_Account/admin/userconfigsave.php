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
    die ('Access Denied');
}

if (!defined('YA_ADMIN')) {
    die('CNBYA admin protection');
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(is_mod_admin($module_name)) {

    $tmp_nick = explode("\r\n",$xbad_nick);
    rsort($tmp_nick);
    for ($i=count($tmp_nick)-1; $i > -1; $i--) {
        if (empty($tmp_nick[$i])) { array_pop($tmp_nick); }
    }
    sort($tmp_nick);
    $xbad_nick = implode("\r\n",$tmp_nick);
    $tmp_mail = explode("\r\n",$xbad_mail);
    rsort($tmp_mail);
    for ($i=count($tmp_mail)-1; $i > -1; $i--) {
        if (empty($tmp_mail[$i])) { array_pop($tmp_mail); }
    }
    sort($tmp_mail);
    $xbad_mail = implode("\r\n",$tmp_mail);
    ya_save_config('sendaddmail', $xsendaddmail, 'nohtml');
    ya_save_config('allowuserdelete', $xallowuserdelete);
    ya_save_config('doublecheckemail', $xdoublecheckemail);

    ya_save_config('coppa', $xcoppa);
    ya_save_config('tos', $xtos);
    ya_save_config('tosall', $xtosall);

    ya_save_config('senddeletemail', $xsenddeletemail);
    ya_save_config('allowusertheme', $xallowusertheme);
    ya_save_config('allowuserreg', $xallowuserreg);
    ya_save_config('allowmailchange', $xallowmailchange);
    ya_save_config('emailvalidate', $xemailvalidate);
    ya_save_config('requireadmin', $xrequireadmin);
    ya_save_config('servermail', $xservermail);
    ya_save_config('useactivate', $xuseactivate);
    ya_save_config('usegfxcheck', $xusegfxcheck);
    ya_save_config('autosuspend', $xautosuspend);
    ya_save_config('perpage', $xperpage);
    ya_save_config('expiring', $xexpiring);

    ya_save_config('bad_nick', $xbad_nick, 'nohtml');
    ya_save_config('bad_mail', $xbad_mail, 'nohtml');
    ya_save_config('nick_min', $xnick_min);
    ya_save_config('nick_max', $xnick_max);
    ya_save_config('pass_min', $xpass_min);
    ya_save_config('pass_max', $xpass_max);

    ya_save_config('codesize', $xcodesize);
    ya_save_config('autosuspendmain', $xautosuspendmain);

/*****['BEGIN']****************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    global $cache;
    $cache->delete('ya_config', 'config');
/*****['END']******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

//    echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=modules.php?name=$module_name&famp;ile=admin&amp;op=UsersConfig\">";

    $pagetitle = ": "._USERADMIN." - "._YA_USERS;
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	echo "<div align=\"center\">\n<a href=\"modules.php?name=Your_Account&amp;file=admin\">" . _USER_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _USER_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    title(_USERADMIN.": "._YA_USERS);
    amain();
    echo "<br />\n";
    OpenTable();
    echo "<center><h4>"._YACONFIGSAVED."</h4></center>";
    echo "<table align=\"center\"><tr><td><form><input type=\"button\" value=\""._USERSCONFIG."\" onclick=\"javascript:location='modules.php?name=".$module_name."&amp;file=admin&amp;op=UsersConfig';\"></form></td></tr></table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');

}

?>