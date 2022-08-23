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

    if (is_active("Private_Messages") AND ($username == $cookie[1]) AND ($usrinfo['user_password'] == $cookie[2])) {
        echo "<br />";
        OpenTable();
      
        if (is_active("Members_List")) {
            $mem_list = "<a href=\"modules.php?name=Members_List\">"._BROWSEUSERS."</a>";
        } else {
            $mem_list = "";
        }
        if (is_active("Search")) {
            $mod_search = "<a href=\"modules.php?name=Search&amp;type=users\">"._SEARCHUSERS."</a>";
        } else {
            $mod_search = "";
        }
        if (!empty($mem_list) AND !empty($mod_search)) { $a = " | "; } else { $a = ""; }
        if (!empty($mem_list) OR !empty($mod_search)) {
            $links = "[ $mem_list $a $mod_search ]";
        } elseif (empty($mem_list) AND empty($mod_search)) {
            $links = "";
        }
        $ya_memname = htmlspecialchars($username);
        list($uid) = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$ya_memname'"));
        $uid = intval($uid);
        $ya_newpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='1' OR privmsgs_type='5')"));
        $ya_savpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND privmsgs_type='3'"));
        $ya_oldpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND privmsgs_type='0'"));
        $ya_outpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_from_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_from_userid='$uid' AND privmsgs_type='1'"));
        $ya_newpms = intval($ya_newpms);
        $ya_oldpms = intval($ya_oldpms);
        $ya_savpms = intval($ya_savpms);
        $ya_totpms = $ya_newpms + $ya_oldpms + $ya_savpms;

    // menelaos: function changed to reflect the default phpbb2 style icons (in a future version they will show the users phpnuke forum theme icons)
    $bbconfig = $board_config;
    $bbstyle    = $bbconfig['default_style'];

    $sql        = "SELECT template_name FROM ".$prefix."_bbthemes WHERE themes_id='$bbstyle'";
    $result  = $db->sql_query($sql);
    $row     = $db->sql_fetchrow($result);
    $bbtheme = $row['template_name'];
    
    //escudero: modification to get the theme FROM nukemods
    if (file_exists("./themes/$ThemeSel/forums/images/whosonline.gif")) {
        $imagedir = "./themes/$ThemeSel/forums/images";
    } else {
        $imagedir = "./modules/Forums/templates/$bbtheme/images";
    }

    echo "<table align=\"center\"><tr><td><strong>"._YAMESSAGES."</strong></td></tr></table>\n";
    echo "<table align=\"center\" border=\"0\"><tr align=\"center\">";
    echo "<td align=\"left\"><a href=\"modules.php?name=Private_Messages\"><img src=\"$imagedir/msg_inbox.gif\" style=\"border:none;\" alt=\""._YAPM."\"></a></td>";
    echo "<td valign=\"middle\"><a href=\"modules.php?name=Private_Messages\"><strong>"._YAPM.":&nbsp;$ya_totpms</strong></a><br /></td><td width=\"25%\">&nbsp;</td>\n";
    echo "<td><a href=\"modules.php?name=Private_Messages\"><img src=\"$imagedir/msg_inbox.gif\" style=\"border:none;\" alt=\""._YAUNREAD."\"></a></td>";
    echo "<td valign=\"middle\"><a href=\"modules.php?name=Private_Messages\"><strong>"._YAUNREAD.":&nbsp;$ya_newpms</strong></a></td><td width=\"25%\">&nbsp;</td>\n";
    echo "<td><a href=\"modules.php?name=Private_Messages\"><img src=\"$imagedir/msg_inbox.gif\" style=\"border:none;\" alt=\""._YAREAD."\"></a></td>";
    echo "<td valign=\"middle\"><a href=\"modules.php?name=Private_Messages\"><strong>"._YAREAD.":&nbsp;$ya_oldpms</strong></a></td><td width=\"25%\">&nbsp;</td>\n";
    echo "<td><a href=\"modules.php?name=Private_Messages&amp;file=index&amp;folder=savebox\"><img src=\"$imagedir/msg_savebox.gif\" style=\"border:none;\" alt=\""._YASAVED."\"></a></td>";
    echo "<td valign=\"middle\"><a href=\"modules.php?name=Private_Messages&amp;file=index&amp;folder=savebox\"><strong>"._YASAVED.":&nbsp;$ya_savpms</strong></a></td>\n";
    echo "<td width=\"25%\">&nbsp;</td><td><a href=\"modules.php?name=Private_Messages&amp;file=index&amp;folder=outbox\"><img src=\"$imagedir/msg_inbox.gif\" style=\"border:none;\" alt=\""._YAOUTBOX."\"></a></td>";
    echo "<td valign=\"middle\"><a href=\"modules.php?name=Private_Messages&amp;file=index&amp;folder=outbox\"><strong>"._YAOUTBOX.":&nbsp;$ya_outpms</strong></a></td></tr>\n";
    echo "</table>\n";
    CloseTable();
    }

?>