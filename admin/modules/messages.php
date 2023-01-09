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
-=[Mod]=-
      phpBB User Groups Integration            v1.0.0       08/26/2005
      Messages BBCodes                         v1.0.1       11/14/2005
      Custom Text Area                         v1.0.0       11/23/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $prefix, $db, $admdata;
if ($admdata['radminsuper'] == 1) {

/*********************************************************/
/* Messages Functions                                    */
/*********************************************************/

function MsgDeactive($mid) {
    global $prefix, $db, $admin_file;
    $mid = intval($mid);
    $db->sql_query("update " . $prefix . "_message set active='0' WHERE mid='$mid'");
    Header("Location: ".$admin_file.".php?op=messages");
}

function messages() {
    $mview = null;
    $mactive = null;
    $languageslist = [];
    global $admin, $admlanguage, $language, $prefix, $db, $multilingual, $admin_file, $admlang;
    include(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=messages\">" . $admlang['messages']['header'] . "</a></div>\n";
    echo "<br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $admlang['global']['header_return'] . "</a> ]</div>\n";
    CloseTable();
   // echo "<br />";
    if (empty($admlanguage)) {
        $admlanguage = $language; /* This to make sure some language is pre-selected */
    }
    OpenTable();
    echo "<center><span class=\"title\"><strong>" . $admlang['messages']['all'] . "</strong></span><br /><br /><table border=\"1\" width=\"100%\">"
    ."<tr><td align=\"center\"><strong>" . $admlang['global']['ID'] . "</strong></td>"
    ."<td align=\"center\"><strong>" . $admlang['global']['title'] . "</strong></td>"
    ."<td align=\"center\">&nbsp;<strong>" . $admlang['global']['language'] . "</strong>&nbsp;</td>"
    ."<td  align=\"center\" nowrap>&nbsp;<strong>" . $admlang['messages']['view'] . "</strong>&nbsp;</td>"
    ."<td align=\"center\">&nbsp;<strong>" . $admlang['global']['active'] . "</strong>&nbsp;</td>"
    ."<td align=\"center\">&nbsp;<strong>" . $admlang['global']['functions'] . "</strong>&nbsp;</td></tr>";
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    $result = $db->sql_query("SELECT * from " . $prefix . "_message");
    while ($row = $db->sql_fetchrow($result)) {
    $groups = $row['groups'];
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    $mid = intval($row['mid']);
    $title = $row['title'];
    $content = $row['content'];
    $mdate = $row['date'];
    $expire = intval($row['expire']);
    $active = intval($row['active']);
    $view = intval($row['view']);
    $mlanguage = $row['mlanguage'];
    if ($active == 1) {
    $mactive = _YES;
    } elseif ($active == 0) {
    $mactive = _NO;
    }
    if ($view == 1) {
   $mview = $admlang['global']['all_visitors'];
    } elseif ($view == 2) {
   $mview = $admlang['global']['guests_only'];
    } elseif ($view == 3) {
   $mview = $admlang['global']['users_only'];
    } elseif ($view == 4) {
   $mview = $admlang['global']['admins_only'];
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    } elseif ($view > 5) {
    $mview = $admlang['global']['groups_only'];
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    }
    if (empty($mlanguage)) {
    $mlanguage = $admlang['global']['all'];
    }
    echo "<tr><td align=\"right\"><strong>$mid</strong>"
        ."</td><td align=\"left\" width=\"100%\"><strong>$title</strong>"
        ."</td><td align=\"center\">$mlanguage"
        ."</td><td align=\"center\" nowrap>$mview"
        ."</td><td align=\"center\">$mactive"
        ."</td><td align=\"right\" nowrap>(<a href=\"".$admin_file.".php?op=editmsg&amp;mid=$mid\">" . $admlang['global']['edit'] . "</a>-<a href=\"".$admin_file.".php?op=deletemsg&amp;mid=$mid\">" . $admlang['global']['delete'] . "</a>)"
        ."</td></tr>";

    }
    echo "</table></center><br />";
    CloseTable();
    //echo "<br />";
    OpenTable();
    echo "<center><span class=\"title\"><strong>" . $admlang['messages']['add'] . "</strong></span></center><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"message\">"
    ."<br /><strong>" . $admlang['global']['title'] . ":</strong><br />"
    ."<input type=\"text\" name=\"add_title\" value=\"\" size=\"50\" maxlength=\"100\"><br /><br />"
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    ."<strong>" . $admlang['global']['content'] . ":</strong><br />";
    Make_TextArea('add_content', '', 'message');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    if ($multilingual == 1) {
    echo "<strong>" . $admlang['global']['language'] . ": </strong>"
        ."<select name=\"add_mlanguage\">";
    $handle=opendir('language');
    while ($file = readdir($handle)) {
        if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
            $langFound = $matches[1];
            $languageslist .= $langFound.' ';
        }
    }
    closedir($handle);
    $languageslist = explode(" ", (string) $languageslist);
    sort($languageslist);
    for ($i=0; $i < count($languageslist); $i++) {
        if($languageslist[$i]!="") {
        echo "<option value=\"$languageslist[$i]\" ";
        if($languageslist[$i]==$language) echo "selected";
        echo ">".ucfirst($languageslist[$i])."</option>\n";
        }
    }
    echo "<option value=\"\">" . _ALL . "</option></select><br /><br />";
    } else {
    echo "<input type=\"hidden\" name=\"add_mlanguage\" value=\"\">";
    }
    $now = time();
    echo "<strong>" . $admlang['global']['expiration'] . ":</strong> <select name=\"add_expire\">"
    ."<option value=\"86400\" >1 " . $admlang['global']['day'] . "</option>"
    ."<option value=\"172800\" >2 " . $admlang['global']['days'] . "</option>"
    ."<option value=\"432000\" >5 " . $admlang['global']['days'] . "</option>"
    ."<option value=\"1296000\" >15 " . $admlang['global']['days'] . "</option>"
    ."<option value=\"2592000\" >30 " . $admlang['global']['days'] . "</option>"
    ."<option value=\"0\" >" . $admlang['global']['unlimited'] . "</option>"
    ."</select><br /><br />"
    ."<strong>" . $admlang['global']['active'] . "?</strong> <input type=\"radio\" name=\"add_active\" value=\"1\" checked>" . _YES . " "
    ."<input type=\"radio\" name=\"add_active\" value=\"0\" >" . _NO . "";
    echo "<br /><br /><strong>" . $admlang['global']['who_view'] . "</strong> <select name=\"add_view\">"
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
     ."<option value=\"1\" >" . $admlang['global']['all_visitors'] . "</option>"
     ."<option value=\"2\" >" . $admlang['global']['guests_only'] . "</option>"
     ."<option value=\"3\" >" . $admlang['global']['users_only'] . "</option>"
     ."<option value=\"4\" >" . $admlang['global']['admins_only'] . "</option>"
    ."<option value=\"6\">".$admlang['global']['groups_only']."</option>"
     ."</select><br /><br />"
    ."<span class='tiny'>"._WHATGRDESC."</span><br /><strong>"._WHATGROUPS."</strong> <select name='add_groups[]' multiple size='5'>\n";
     $groupsResult = $db->sql_query("select group_id, group_name from ".$prefix."_bbgroups where group_description <> 'Personal User'");
     while([$gid, $gname] = $db->sql_fetchrow($groupsResult)) { echo "<OPTION VALUE='$gid'>$gname</option>\n"; }
     echo "</select><br /><br />\n"
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    ."<input type=\"hidden\" name=\"op\" value=\"addmsg\">"
    ."<input type=\"hidden\" name=\"add_mdate\" value=\"$now\">"
    ."<input type=\"submit\" value=\"" . $admlang['messages']['add'] . "\">"
    ."</form>";
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

function editmsg($mid) {
    $asel1 = null;
    $asel2 = null;
    $sel6 = null;
    global $admin, $prefix, $db, $multilingual, $admin_file, $admlang;
    include(NUKE_BASE_DIR.'header.php');
    $mid = intval($mid);
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=messages\">" . $admlang['messages']['header'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $admlang['global']['header_return'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    $row = $db->sql_fetchrow($db->sql_query("SELECT * from " . $prefix . "_message WHERE mid='$mid'"));
    $groups = $row['groups'];
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    $title = $row['title'];
    $content = $row['content'];
    $mdate = $row['date'];
    $expire = intval($row['expire']);
    $active = intval($row['active']);
    $view = intval($row['view']);
    $mlanguage = $row['mlanguage'];
    OpenTable();
    echo "<center><span class=\"title\"><strong>" . $admlang['messages']['edit'] . "</strong></span></center>";
    if ($active == 1) {
    $asel1 = "checked";
    $asel2 = "";
    } elseif ($active == 0) {
    $asel1 = "";
    $asel2 = "checked";
    }
    $sel1 = $sel2 = $sel3 = $sel4 = $sel5 = "";
    if ($view == 1) {
    $sel1 = 'selected';
    } elseif ($view == 2) {
    $sel2 = 'selected';
    } elseif ($view == 3) {
    $sel3 = 'selected';
    } elseif ($view == 4) {
    $sel4 = 'selected';
    } elseif ($view == 5) {
    $sel5 = 'selected';
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    } elseif ($view > 5) {
    $sel6 = 'selected';
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    }
    $esel1 = $esel2 = $esel3 = $esel4 = $esel5 = $esel6 = "";
    if ($expire == 86400) {
    $esel1 = 'selected';
    } elseif ($expire == 172800) {
    $esel2 = 'selected';
    } elseif ($expire == 432000) {
    $esel3 = 'selected';
    } elseif ($expire == 1_296_000) {
    $esel4 = 'selected';
    } elseif ($expire == 2_592_000) {
    $esel5 = 'selected';
    } elseif ($expire == 0) {
    $esel6 = 'selected';
    }
    echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"message\">"
    ."<br /><strong>" . $admlang['global']['title'] . ":</strong><br />"
    ."<input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br /><br />"
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    ."<strong>" . $admlang['global']['content'] . ":</strong><br />";
    Make_TextArea('content', $content, 'message');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    if ($multilingual == 1) {
    echo "<strong>" . $admlang['global']['language'] . ": </strong>"
        ."<select name=\"mlanguage\">";
    $handle=opendir('language');
    while ($file = readdir($handle)) {
        if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
            $langFound = $matches[1];
            $languageslist .= "$langFound ";
        }
    }
    closedir($handle);
    $languageslist = explode(" ", (string) $languageslist);
    sort($languageslist);
    for ($i=0; $i < count($languageslist); $i++) {
        if(!empty($languageslist[$i])) {
        echo "<option value=\"$languageslist[$i]\" ";
        if($languageslist[$i]==$mlanguage) echo "selected";
        echo ">".ucfirst($languageslist[$i])."</option>\n";
        }
    }
    if (empty($mlanguage)) {
        $sellang = 'selected';
    } else {
            $sellang = '';
    }
    echo "<option value=\"\" $sellang>" . $admlang['global']['all'] . "</option></select><br /><br />";
    } else {
    echo "<input type=\"hidden\" name=\"mlanguage\" value=\"\">";
    }
    echo "<strong>" . $admlang['global']['expiration'] . ":</strong> <select name=\"expire\">"
    ."<option name=\"expire\" value=\"86400\" $esel1>1 " . $admlang['global']['day'] . "</option>"
    ."<option name=\"expire\" value=\"172800\" $esel2>2 " . $admlang['global']['days'] . "</option>"
    ."<option name=\"expire\" value=\"432000\" $esel3>5 " . $admlang['global']['days'] . "</option>"
    ."<option name=\"expire\" value=\"1296000\" $esel4>15 " . $admlang['global']['days'] . "</option>"
    ."<option name=\"expire\" value=\"2592000\" $esel5>30 " . $admlang['global']['days'] . "</option>"
    ."<option name=\"expire\" value=\"0\" $esel6>" . $admlang['global']['unlimited'] . "</option>"
    ."</select><br /><br />"
    ."<strong>" . $admlang['global']['active'] . "?</strong> <input type=\"radio\" name=\"active\" value=\"1\" $asel1>" . $admlang['global']['yes'] . " "
    ."<input type=\"radio\" name=\"active\" value=\"0\" $asel2>" . $admlang['global']['no'] . "";
    if ($active == 1) {
    echo "<br /><br /><strong>" . $admlang['messages']['change_date'] . "</strong>"
        ."<input type=\"radio\" name=\"chng_date\" value=\"1\">" . $admlang['global']['yes'] . " "
        ."<input type=\"radio\" name=\"chng_date\" value=\"0\" checked>" . $admlang['global']['no'] . "<br /><br />";
    } elseif ($active == 0) {
    echo "<br /><span class=\"tiny\">" . $admlang['messages']['active'] . "</span><br /><br />"
        ."<input type=\"hidden\" name=\"chng_date\" value=\"1\">";
    }
    echo "<strong>" . $admlang['global']['who_view'] . "</strong> <select name=\"view\">"
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    ."<option name=\"view\" value=\"1\" $sel1>" . $admlang['global']['all_visitors'] . "</option>"
    ."<option name=\"view\" value=\"2\" $sel2>" . $admlang['global']['guests_only'] . "</option>"
    ."<option name=\"view\" value=\"3\" $sel3>" . $admlang['global']['users_only'] . "</option>"
    ."<option name=\"view\" value=\"4\" $sel4>" . $admlang['global']['admins_only'] . "</option>"
        ."<option name=\"view\" value=\"6\" $sel6>".$admlang['global']['groups_only']."</option>"
    ."</select><br /><br />"
        ."<span class='tiny'>"._WHATGRDESC."</span><br /><strong>"._WHATGROUPS."</strong> <select name='groups[]' multiple size='5'>";
    $ingroups = explode("-",(string) $groups);
    $groupsResult = $db->sql_query("select group_id, group_name from ".$prefix."_bbgroups where group_description <> 'Personal User'");
    while([$gid, $gname] = $db->sql_fetchrow($groupsResult)) {
        if(in_array($gid,$ingroups) AND $view > 5) { $sel = " selected"; } else { $sel = ""; }
        echo "<OPTION VALUE='$gid'$sel>$gname</option>";
    }
    echo "</select><br /><br />"
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    ."<input type=\"hidden\" name=\"mdate\" value=\"$mdate\">"
    ."<input type=\"hidden\" name=\"mid\" value=\"$mid\">"
    ."<input type=\"hidden\" name=\"op\" value=\"savemsg\">"
    ."<input type=\"submit\" value=\"" . $admlang['global']['save_changes'] . "\">"
    ."</form>";
    CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
}

/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
function savemsg($mid, $title, $content, $mdate, $expire, $active, $view, $groups, $chng_date, $mlanguage) 
{
    $newdate = null;
    $ingroups = null;
    global $prefix, $db, $admin_file;

    if($view == 6) 
	{ 
	  $ingroups = implode("-",$groups); 
	}
    
	if($view < 6) 
	{ 
	  $ingroups = ""; 
	}

    $mid = intval($mid);
    $title = Fix_Quotes($title);
    $content = Fix_Quotes($content);

    if ($chng_date == 1) 
	{
        $newdate = time();
    } 
	elseif ($chng_date == 0) 
	{
        $newdate = $mdate;
    }

    $result = $db->sql_query("UPDATE ".$prefix."_message SET title='$title', 
	                                                     content='$content', 
														    date='$newdate', 
														   expire='$expire', 
														   active='$active', 
														       view='$view',
														 groups='$ingroups', 
													  mlanguage='$mlanguage' 
													  WHERE 
													  mid='$mid'");

    Header("Location: ".$admin_file.".php?op=messages");
}

/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
function addmsg($add_title, $add_content, $add_mdate, $add_expire, $add_active, $add_view, $add_groups, $add_mlanguage) {
    $ingroups = null;
    global $prefix, $db, $admin_file;
    if($add_view == 6) { $ingroups = implode("-",$add_groups); }
    if($add_view < 6) { $ingroups = ""; }
    $title = Fix_Quotes($add_title);
    $content = Fix_Quotes($add_content);
    $result = $db->sql_query("insert into " . $prefix . "_message values (NULL, '$add_title', '$add_content', '$add_mdate', '$add_expire', '$add_active', '$add_view', '$ingroups', '$add_mlanguage')");
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    if (!$result) {
        exit();
    }
    Header("Location: ".$admin_file.".php?op=messages");
}

function deletemsg($mid, $ok=0) {
    global $prefix, $db, $admin_file, $admlang;
    if($ok) {
    $result = $db->sql_query("delete from " . $prefix . "_message where mid='$mid'");
        if (!$result) {
        return;
        }
    Header("Location: ".$admin_file.".php?op=messages");
    } else {
    include(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=messages\">" . $admlang['messages']['header'] . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $admlang['global']['header_return'] . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center>" . $admlang['messages']['remove'] . "";
    echo "<br /><br />[ <a href=\"".$admin_file.".php?op=messages\">" . $admlang['global']['no'] . "</a> | <a href=\"".$admin_file.".php?op=deletemsg&amp;mid=$mid&amp;ok=1\">" . $admlang['global']['yes'] . "</a> ]</center>";
        CloseTable();
    include(NUKE_BASE_DIR.'footer.php');
    }
}
if (!isset($title)) { $title = ''; }
if (!isset($content)) { $content = ''; }
if (!isset($mdate)) { $mdate = ''; }
if (!isset($expire)) { $expire = ''; }
if (!isset($active)) { $active = ''; }
if (!isset($view)) { $view = ''; }
if (!isset($chng_date)) { $chng_date = ''; }
if (!isset($mlanguage)) { $mlanguage = ''; }
if (!isset($ok)) { $ok = ''; }

switch ($op){

    case "messages":
    messages();
    break;

    case "editmsg":
    editmsg($mid);
    break;

    case "addmsg":
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    addmsg($add_title, $add_content, $add_mdate, $add_expire, $add_active, $add_view, $add_groups, $add_mlanguage);
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    break;

    case "deletemsg":
    deletemsg($mid, $ok);
    break;

    case "savemsg":
/*****[BEGIN]******************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    savemsg($mid, $title, $content, $mdate, $expire, $active, $view, $groups, $chng_date, $mlanguage);
/*****[END]********************************************
 [ Mod:    phpBB User Groups Integration       v1.0.0 ]
 ******************************************************/
    break;

}

} else {
    echo "Access Denied";
}

?>
