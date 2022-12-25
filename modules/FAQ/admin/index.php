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
/* ========================                                             */
/* Based on PHP-Nuke Add-On                                             */
/* Copyright (c) 2001 by Richard Tirtadji AKA King Richard              */
/*                       (rtirtadji@hotmail.com)                        */
/*                       Hutdik Hermawan AKA hotFix                     */
/*                       (hutdik76@hotmail.com)                         */
/* http://www.nukeaddon.com                                             */
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
   die('Access Denied');
}

global $prefix, $db, $admdata;
$module_name = basename(dirname(dirname(__FILE__)));
if(is_mod_admin($module_name)) {

/*********************************************************/
/* Faq Admin Function                                    */
/*********************************************************/

    function FaqAdmin() {
        global $admin, $bgcolor2, $prefix, $db, $currentlang, $multilingual, $admin_file;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=FaqAdmin\">" . _FAQ_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _FAQ_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    //echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . _FAQADMIN . "</strong></span></center>";
        CloseTable();
        //echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _ACTIVEFAQS . "</strong></span></center><br />"
        ."<table border=\"1\" width=\"100%\" align=\"center\"><tr>"
        ."<td align=\"center\"><strong>" . _ID . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CATEGORIES . "</strong></td>"
        ."<td align=\"center\"><strong>" . _LANGUAGE . "</strong></td>"
        ."<td align=\"center\"><strong>" . _FUNCTIONS . "</strong></td></tr>";
        $result = $db->sql_query("select id_cat, categories, flanguage from ".$prefix."_faqcategories order by id_cat");
        while ($row = $db->sql_fetchrow($result)) {
            $id_cat = $row['id_cat'];
            $categories = $row['categories'];
            $flanguage = $row['flanguage'];
            if (empty($flanguage)) {
                $flanguage = _ALL;
            }
            echo "<tr><td align=\"center\">$id_cat</td>"
                ."<td align=\"center\">$categories</td>"
                ."<td align=\"center\">$flanguage</td>"
                ."<td align=\"center\">[ <a href=\"".$admin_file.".php?op=FaqCatGo&amp;id_cat=$id_cat\">" . _CONTENT . "</a> | <a href=\"".$admin_file.".php?op=FaqCatEdit&amp;id_cat=$id_cat\">" . _EDIT . "</a> | <a href=\"".$admin_file.".php?op=FaqCatDel&amp;id_cat=$id_cat&amp;ok=0\">" . _DELETE . "</a> ]</td></tr>";
        }
        echo "</table>";
        CloseTable();
        //echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _ADDCATEGORY . "</strong></span></center><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<table border=\"0\" width=\"100%\"><tr><td>"
        ."" . _CATEGORIES . ":</td><td><input type=\"text\" name=\"categories\" size=\"30\"></td></tr>";
        if ($multilingual == 1) {
            echo "<tr><td>" . _LANGUAGE . ":</td><td>"
                ."<select name=\"flanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($currentlang == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($currentlang == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select></td></tr>';
        }
        echo "</table>";
        if ($multilingual != 1) {
            echo "<input type=\"hidden\" name=\"flanguage\" value=\"$currentlang\">";
        }
        echo "<input type=\"hidden\" name=\"op\" value=\"FaqCatAdd\">"
        ."<input type=\"submit\" value=" . _SAVE . ">"
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function FaqCatGo($id_cat) {
        global $admin, $bgcolor2, $prefix, $db, $admin_file;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=FaqAdmin\">" . _FAQ_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _FAQ_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . _FAQADMIN . "</strong></span></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _QUESTIONS . "</strong></span></center><br />"
        ."<table border=\"1\" width=\"100%\" align=\"center\"><tr>"
        ."<td align=\"center\">" . _CONTENT . "</td>"
        ."<td align=\"center\">" . _FUNCTIONS . "</td></tr>";
        $id_cat = intval($id_cat);
        $result = $db->sql_query("select id, question, answer from ".$prefix."_faqanswer where id_cat='$id_cat' order by id");
        while ($row = $db->sql_fetchrow($result)) {
            $id = intval($row['id']);
            $question = $row['question'];
            $answer = $row['answer'];
            $answer_bb = decode_bbcode(set_smilies(stripslashes($answer)), 1, true);
            echo "<tr><td><i>$question</i><br /><br />$answer_bb"
                ."</td><td align=\"center\">[ <a href=\"".$admin_file.".php?op=FaqCatGoEdit&amp;id=$id\">" . _EDIT . "</a> | <a href=\"".$admin_file.".php?op=FaqCatGoDel&amp;id=$id&amp;ok=0\">" . _DELETE . "</a> ]</td></tr>";
        }
        $db->sql_freeresult($result);
        echo "</table>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _ADDQUESTION . "</strong></span></center><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"faq\">"
        ."<table border=\"0\" width=\"100%\"><tr><td>"
        ."" . _QUESTION . ":</td><td><input type=\"text\" name=\"question\" size=\"40\"></td></tr><tr><td>"
        ."" . _ANSWER . " </td><td>";
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
         Make_TextArea('answer', '', 'faq');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
        echo "</td></tr></table>"
        ."<input type=\"hidden\" name=\"id_cat\" value=\"$id_cat\">"
        ."<input type=\"hidden\" name=\"op\" value=\"FaqCatGoAdd\">"
        ."<input type=\"submit\" value=" . _SAVE . "> " . _GOBACK . ""
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function FaqCatEdit($id_cat) {
        global $admin, $db, $multilingual, $admin_file, $prefix;

        include(NUKE_BASE_DIR.'config.php');
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=FaqAdmin\">" . _FAQ_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _FAQ_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . _FAQADMIN . "</strong></span></center>";
        CloseTable();
        echo "<br />";
        $id_cat = intval($id_cat);
        $row = $db->sql_fetchrow($db->sql_query("SELECT categories, flanguage from " . $prefix . "_faqcategories where id_cat='$id_cat'"));
        $categories = $row['categories'];
        $flanguage = $row['flanguage'];
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _EDITCATEGORY . "</strong></span></center>"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<input type=\"hidden\" name=\"id_cat\" value=\"$id_cat\">"
        ."<table border=\"0\" width=\"100%\"><tr><td>"
        ."" . _CATEGORIES . ":</td><td><input type=\"text\" name=\"categories\" size=\"31\" value='$categories'></td>";
        if ($multilingual == 1) {
            echo "<tr><td>" . _LANGUAGE . ":</td><td>"
                ."<select name=\"flanguage\">";
            $languages = lang_list();
            echo '<option value=""'.(($flanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
            for ($i=0, $j = count($languages); $i < $j; $i++) {
                if ($languages[$i] != '') {
                    echo '<option value="'.$languages[$i].'"'.(($flanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($languages[$i])."</option>\n";
                }
            }
            echo '</select></td>';
        } else {
            echo "<input type=\"hidden\" name=\"flanguage\" value=\"$currentlang\">";
        }
        echo "</tr></table>"
        ."<input type=\"hidden\" name=\"op\" value=\"FaqCatSave\">"
        ."<input type=\"submit\" value=\""._SAVE."\"> "._GOBACK.""
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function FaqCatGoEdit($id) {
        global $admin, $bgcolor2, $prefix, $db, $admin_file;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=FaqAdmin\">" . _FAQ_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _FAQ_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>" . _FAQADMIN . "</strong></span></center>";
        CloseTable();
        echo "<br />";
        $id = intval($id);
        $row = $db->sql_fetchrow($db->sql_query("SELECT question, answer from " . $prefix . "_faqanswer where id='$id'"));
        $question = $row['question'];
        $answer = $row['answer'];
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _EDITQUESTIONS . "</strong></span></center>"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"faq\">"
        ."<input type=\"hidden\" name=\"id\" value=\"$id\">"
        ."<table border=\"0\" width=\"100%\"><tr><td>"
        ."" . _QUESTION . ":</td><td><input type=\"text\" name=\"question\" size=\"31\" value=\"$question\"></td></tr><tr><td>"
        ."" . _ANSWER . ":</td><td>";
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
         Make_TextArea('answer', $answer, 'faq');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
        echo "</td></tr></table>"
        ."<input type=\"hidden\" name=\"op\" value=\"FaqCatGoSave\">"
        ."<input type=\"submit\" value=" . _SAVE . "> " . _GOBACK . ""
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    function FaqCatSave($id_cat, $categories, $flanguage) {
        global $prefix, $db, $admin_file;

        $categories = Fix_Quotes($categories);
        $id_cat = intval($id_cat);
        $db->sql_query("update ".$prefix."_faqcategories set categories='$categories', flanguage='$flanguage' where id_cat='$id_cat'");
        redirect($admin_file.".php?op=FaqAdmin");
    }

    function FaqCatGoSave($id, $question, $answer) {
        global $prefix, $db, $admin_file;

        $question = Fix_Quotes($question);
        $answer = Fix_Quotes($answer);
        $id = intval($id);
        $db->sql_query("update ".$prefix."_faqanswer set question='$question', answer='$answer' where id='$id'");
        redirect($admin_file.".php?op=FaqAdmin");
    }

    function FaqCatAdd($categories, $flanguage) {
        global $prefix, $db, $admin_file;

        $categories = Fix_Quotes($categories);
        $db->sql_query("insert into ".$prefix."_faqcategories values (NULL, '$categories', '$flanguage')");
        redirect($admin_file.".php?op=FaqAdmin");
    }

    function FaqCatGoAdd($id_cat, $question, $answer) {
        global $prefix, $db, $admin_file;

        $question = Fix_Quotes($question);
        $answer = Fix_Quotes($answer);
        $db->sql_query("insert into ".$prefix."_faqanswer values (NULL, '$id_cat', '$question', '$answer')");
        redirect($admin_file.".php?op=FaqCatGo&id_cat=$id_cat");
    }

    function FaqCatDel($id_cat, $ok=0) {
        global $prefix, $db, $admin_file;

        if($ok==1) {
            $id_cat = intval($id_cat);
            $db->sql_query("delete from ".$prefix."_faqcategories where id_cat='$id_cat'");
            $db->sql_query("delete from ".$prefix."_faqanswer where id_cat='$id_cat'");
            redirect($admin_file.".php?op=FaqAdmin");
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=FaqAdmin\">" . _FAQ_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
	        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _FAQ_RETURNMAIN . "</a> ]</div>\n";
	        CloseTable();
	        echo "<br />";
            OpenTable();
            echo "<center><span class=\"title\"><strong>" . _FAQADMIN . "</strong></span></center>";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<br /><center><strong>" . _FAQDELWARNING . "</strong><br /><br />";
        }
        echo "[ <a href=\"".$admin_file.".php?op=FaqCatDel&amp;id_cat=$id_cat&amp;ok=1\">" . _YES . "</a> | <a href=\"".$admin_file.".php?op=FaqAdmin\">" . _NO . "</a> ]</center><br /><br />";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function FaqCatGoDel($id, $ok=0) {
        global $prefix, $db, $admin_file;

        if($ok==1) {
            $id = intval($id);
            $db->sql_query("delete from ".$prefix."_faqanswer where id='$id'");
            redirect($admin_file.".php?op=FaqAdmin");
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=FaqAdmin\">" . _FAQ_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
	        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _FAQ_RETURNMAIN . "</a> ]</div>\n";
	        CloseTable();
	        echo "<br />";
            OpenTable();
            echo "<center><span class=\"title\"><strong>" . _FAQADMIN . "</strong></span></center>";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<br /><center><strong>" . _QUESTIONDEL . "</strong><br /><br />";
        }
        echo "[ <a href=\"".$admin_file.".php?op=FaqCatGoDel&amp;id=$id&amp;ok=1\">" . _YES . "</a> | <a href=\"".$admin_file.".php?op=FaqAdmin\">" . _NO . "</a> ]</center><br /><br />";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    switch($op) {

        case "FaqCatSave":
            FaqCatSave($id_cat, $categories, $flanguage); /* Multilingual Code : added variable */
        break;

        case "FaqCatGoSave":
            FaqCatGoSave($id, $question, $answer);
        break;

        case "FaqCatAdd":
            FaqCatAdd($categories, $flanguage); /* Multilingual Code : added variable */
        break;

        case "FaqCatGoAdd":
            FaqCatGoAdd($id_cat, $question, $answer);
        break;

        case "FaqCatEdit":
            FaqCatEdit($id_cat);
        break;

        case "FaqCatGoEdit":
            FaqCatGoEdit($id);
        break;

        case "FaqCatDel":
            FaqCatDel($id_cat, $ok);
        break;

        case "FaqCatGoDel":
            FaqCatGoDel($id, $ok);
        break;

        case "FaqAdmin":
            FaqAdmin();
        break;

        case "FaqCatGo":
            FaqCatGo($id_cat);
        break;
    }
} else {
    DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"");
}

?>