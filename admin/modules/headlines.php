<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $prefix, $db, $admin_file;
if (is_mod_admin()) {

if (isset($_POST['save'])) {
    $xsitename = str_replace(' ', '', Fix_Quotes($_POST['xsitename']));
    $headlinesurl = Fix_Quotes($_POST['headlinesurl']);
    $db->sql_query('UPDATE '.$prefix."_headlines SET sitename='$xsitename', headlinesurl='$headlinesurl' where hid=".intval($_POST['save']));
    redirect($admin_file.'.php?op=headlines');
} else if (isset($_POST['addHeadline'])) {
    $xsitename = str_replace(' ', '', Fix_Quotes($_POST['xsitename']));
    $headlinesurl = Fix_Quotes($_POST['headlinesurl']);
    $db->sql_query('INSERT INTO '.$prefix."_headlines VALUES (NULL, '$xsitename', '$headlinesurl')");
    redirect($admin_file.'.php?op=headlines');
} elseif (isset($_GET['edit'])) {
    $hid = intval($_GET['edit']);
    include_once(NUKE_BASE_DIR.'header.php');
    // GraphicAdmin();
    list($xsitename, $headlinesurl) = $db->sql_ufetchrow("SELECT sitename, headlinesurl FROM ".$prefix."_headlines WHERE hid='$hid'",SQL_NUM);
    OpenTable();
    echo '<span class="genmed"><strong>'.$admlang['headlines']['header'].'</strong></span><br /><br />
    <fieldset><legend>'.$admlang['headlines']['edit'].'</legend><form method="post" action="'.$admin_file.'.php?op=headlines">
    <label class="ulog" for="xsitename">'.$admlang['global']['sitename'].'</label>
    <input type="text" name="xsitename" size="50" maxlength="30" value="'.htmlentities($xsitename).'" /><br />
    <label class="ulog" for="headlinesurl">'.$admlang['global']['rss'].'</label>
    <input type="text" name="headlinesurl" size="50" maxlength="200" value="'.$headlinesurl.'" /><br /><br />
    <input type="hidden" name="save" value="'.$hid.'" />
    <input type="submit" value="'.$admlang['global']['save_changes'].'" /></form></fieldset>';
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} else if (isset($_GET['del'])) {
    if (isset($_POST['cancel'])) { redirect($admin_file.'.php?op=headlines'); }
    if (isset($_POST['confirm'])) {
        $db->sql_query('DELETE FROM '.$prefix."_headlines WHERE hid='".intval($_GET['del'])."'");
        redirect($admin_file.'.php?op=headlines');
    }
    confirm_msg($admin_file.'.php?op=headlines&amp;del='.intval($_GET['del']), $admlang['headlines']['delete_warn']);
} else {
    include_once(NUKE_BASE_DIR.'header.php');
    // GraphicAdmin();
    OpenTable();
    echo '<span class="genmed"><strong>'.$admlang['headlines']['header'].'</strong></span><br /><br />
    <table border="0" width="100%">
     <tr bgcolor="'.$bgcolor2.'">
       <td><strong>'.$admlang['global']['sitename'].'</strong></td>
       <td><strong>'.$admlang['global']['url'].'</strong></td>
       <td><strong>'.$admlang['global']['functions'].'</strong></td>
     </tr>';
    $result = $db->sql_uquery("SELECT hid, sitename, headlinesurl FROM ".$prefix."_headlines ORDER BY hid");
    $bgcolor = $bgcolor3;
    while (list($hid, $sitename, $headlinesurl) = $db->sql_fetchrow($result)) {
        $bgcolor = ($bgcolor == '') ? ' bgcolor="'.$bgcolor3.'"' : '';
        echo '
     <tr'.$bgcolor.'">
       <td>'.$sitename.'</td>
       <td><a href="'.$headlinesurl.'" target="new">'.$headlinesurl.'</a></td>
       <td><a href="'.$admin_file.'.php?op=headlines&amp;edit='.$hid.'">'.$admlang['global']['edit'].'</a> / <a href="'.$admin_file.'.php?op=headlines&amp;del='.$hid.'">'.$admlang['global']['delete'].'</a></td>
     </tr>';
     }
     echo '</table><br /><br />
     <fieldset><legend>'.$admlang['headlines']['add'].'</legend><form method="post" action="'.$admin_file.'.php?op=headlines">
     <label class="ulog" for="xsitename">'.$admlang['global']['sitename'].'</label>
      <input type="text" name="xsitename" size="50" maxlength="30" /><br />
     <label class="ulog" for="headlinesurl">'.$admlang['global']['rss'].'</label>
      <input type="text" name="headlinesurl" size="50" maxlength="200" /><br /><br />
     <input type="submit" name="addHeadline" value="'.$admlang['headlines']['add'].'" /></form></fieldset>';
     CloseTable();
     include_once(NUKE_BASE_DIR.'footer.php');
}

} else {
    echo "Access Denied";
}

?>