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
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

global $prefix, $db, $admdata;
$module_name = basename(dirname(dirname(__FILE__)));
if(is_mod_admin($module_name)) {

/*********************************************************/
/* REVIEWS Block Functions                               */
/*********************************************************/

function mod_main($title, $description) {
    global $prefix, $db, $admin_file;
    $title = Fix_Quotes($title);
    $description = Fix_Quotes($description);
    $db->sql_query("UPDATE ".$prefix."_reviews_main SET title='$title', description='$description'");
    redirect($admin_file.".php?op=reviews");
}

function reviews() {
    global $prefix, $db, $multilingual, $admin_file;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=reviews\">" . _REV_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _REV_RETURNMAIN . "</a> ]</div>\n";
	CloseTable();
	echo "<br />";
    OpenTable();
    echo "<center><span class=\"title\"><strong>"._REVADMIN."</strong></span></center>";
    CloseTable();
    echo "<br />";
    $resultrm = $db->sql_query("SELECT title, description FROM ".$prefix."_reviews_main");
    list($title, $description) = $db->sql_fetchrow($resultrm);
    $db->sql_freeresult($resultrm);
    OpenTable();
    echo "<form action=\"".$admin_file.".php\" method=\"post\">"
    ."<center>"._REVTITLE."<br />"
    ."<input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br /><br />"
    .""._REVDESC."<br />"
    ."<textarea name=\"description\" rows=\"15\" wrap=\"virtual\" cols=\"60\">$description</textarea><br /><br />"
    ."<input type=\"hidden\" name=\"op\" value=\"mod_main\">"
    ."<input type=\"submit\" value=\""._SAVECHANGES."\">"
    ."</center></form>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><span class=\"option\"><strong>"._REVWAITING."</strong></span><br />";
    $result = $db->sql_query("SELECT * FROM ".$prefix."_reviews_add order by id");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
        while(list($id, $date, $title, $text, $reviewer, $email, $score, $url, $url_title, $rlanguage) = $db->sql_fetchrow($result)) {
            $id = intval($id);
            $score = intval($score);
            $title = stripslashes($title);
            $text = stripslashes($text);
            echo "<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<hr noshade size=\"1\"><br /><table border=\"0\" cellpadding=\"1\" cellspacing=\"2\">"
            ."<tr><td><strong>"._REVIEWID.":</td><td><strong>$id</strong></td></tr>"
            ."<input type=\"hidden\" name=\"id\" value=\"$id\">"
            ."<tr><td>"._DATE.":</td><td><input type=\"text\" name=\"date\" value=\"$date\" size=\"11\" maxlength=\"10\"></td></tr>"
            ."<tr><td>"._PRODUCTTITLE.":</td><td><input type=\"text\" name=\"title\" value=\"$title\" size=\"25\" maxlength=\"40\"></td></tr>";
            if ($multilingual == 1) {
                echo "<tr><td>"._LANGUAGE.":</td><td>"
                    ."<select name=\"rlanguage\">";
                $languages = lang_list();
                echo '<option value=""'.(($rlanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
                for ($i=0, $j = count($languages); $i < $j; $i++) {
                    if ($languages[$i] != '') {
                        echo '<option value="'.$languages[$i].'"'.(($rlanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                    }
                }
                echo '</select></td></tr>';
            } else {
                echo "<input type=\"hidden\" name=\"rlanguage\" value=\"$language\">";
            }
            echo "<tr><td>"._TEXT.":</td><td><textarea name=\"text\" rows=\"6\" wrap=\"virtual\" cols=\"40\">$text</textarea></td></tr>"
            ."<tr><td>"._REVIEWER."</td><td><input type=\"text\" name=\"reviewer\" value=\"$reviewer\" size=\"41\" maxlength=\"40\"></td></tr>"
            ."<tr><td>"._EMAIL.":</td><td><input type=\"text\" name=\"email\" value=\"$email\" size=\"41\" maxlength=\"80\"></td></tr>"
            ."<tr><td>"._SCORE."</td><td><input type=\"text\" name=\"score\" value=\"$score\" size=\"3\" maxlength=\"2\"></td></tr>";
            if ($url != "") {
                echo "<tr><td>"._RELATEDLINK.":</td><td><input type=\"text\" name=\"url\" value=\"$url\" size=\"25\" maxlength=\"100\"></td></tr>"
                ."<tr><td>"._LINKTITLE.":</td><td><input type=\"text\" name=\"url_title\" value=\"$url_title\" size=\"25\" maxlength=\"50\"></td></tr>";
            }
            echo "<tr><td>"._IMAGE.":</td><td><input type=\"text\" name=\"cover\" size=\"25\" maxlength=\"100\"><br /><i>"._REVIMGINFO."</i></td></tr></table>";
            echo "<input type=\"hidden\" name=\"op\" value=\"add_review\"><input type=\"submit\" value=\""._ADDREVIEW."\"> - [ <a href=\"".$admin_file.".php?op=deleteNotice&amp;id=$id&amp;table=".$prefix."_reviews_add&amp;op_back=reviews\">"._DELETE."</a> ]</form>";
        }
        $db->sql_freeresult($result);
    } else {
        echo "<br /><br /><i>"._NOREVIEW2ADD."</i><br /><br />";
    }
    echo "<a href=\"modules.php?name=Reviews&amp;rop=write_review\">"._CLICK2ADDREVIEW."</a></center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><span class=\"option\"><strong>"._DELMODREVIEW."</strong></span><br /><br />"
    .""._MODREVINFO."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function add_review($id, $date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $rlanguage) {
    global $prefix, $db, $admin_file, $cache;

    $id = intval($id);
    $title = Fix_Quotes($title);
    $text = Fix_Quotes($text);
    $reviewer = Fix_Quotes($reviewer);
    $email = Fix_Quotes($email);
    $score = intval($score);
    $db->sql_query("insert into ".$prefix."_reviews values (NULL, '$date', '$title', '$text', '$reviewer', '$email', '$score', '$cover', '$url', '$url_title', '1', '$rlanguage')");
    $db->sql_query("delete FROM ".$prefix."_reviews_add WHERE id = '$id'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaitreviews', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    redirect($admin_file.".php?op=reviews");
}

switch ($op){

    case "reviews":
        reviews();
    break;

    case "add_review":
        add_review($id, $date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $rlanguage);
    break;

    case "mod_main":
        mod_main($title, $description);
    break;

}

} else {
    DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"");
}

?>