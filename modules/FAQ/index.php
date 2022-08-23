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
/* ======================                                               */
/* Based on Automated FAQ                                               */
/* Copyright (c) 2001 by                                                */
/*    Richard Tirtadji AKA King Richard (rtirtadji@hotmail.com)         */
/*    Hutdik Hermawan AKA hotFix (hutdik76@hotmail.com)                 */
/* http://www.phpnuke.web.id                                            */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = '- '.$module_name;

function ShowFaq($id_cat, $categories) 
{
    global $bgcolor2, $sitename, $prefix, $db, $module_name;
    $categories = htmlentities($categories);
    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n"; 
    print '</div>'."\n";
	
    echo"<center><span class=\"content\"><strong>$sitename "._FAQ2."</strong></span></center><br /><br />"
        ."<a name=\"top\"></a><br />" /* Bug fix : added missing closing hyperlink tag messes up display */
        .""._CATEGORY.": <a href=\"modules.php?name=$module_name\">"._MAIN."</a> -> $categories"
        ."<br /><br />"
        ."<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"
        ."<tr bgcolor=\"$bgcolor2\"><td colspan=\"2\"><span class=\"option\"><strong>"._QUESTION."</strong></span></td></tr><tr><td colspan=\"2\">";
    
	$id_cat = intval($id_cat);
    $result = $db->sql_query("SELECT id, id_cat, question, answer FROM ".$prefix."_faqanswer WHERE id_cat='$id_cat'");

    while ($row = $db->sql_fetchrow($result)):
        $id = intval($row['id']);
        $id_cat = intval($row['id_cat']);
        $question = stripslashes(check_html($row['question'], "nohtml"));
        $answer = stripslashes($row['answer']);
        echo"<strong><big>&middot;</big></strong>&nbsp;&nbsp;<a href=\"#$id\">$question</a><br />";
    endwhile;

    echo "</td></tr></table>
    <br />";
}

function ShowFaqAll($id_cat) 
{
    global $bgcolor2, $prefix, $db, $module_name;
    $id_cat = intval($id_cat);

    echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"
        ."<tr bgcolor=\"$bgcolor2\"><td colspan=\"2\"><span class=\"option\"><strong>"._ANSWER."</strong></span></td></tr>";
    $result = $db->sql_query("SELECT id, id_cat, question, answer FROM ".$prefix."_faqanswer WHERE id_cat='$id_cat'");

    while ($row = $db->sql_fetchrow($result)): 
	
        $id = intval($row['id']);
        $id_cat = intval($row['id_cat']);
         $question = stripslashes(check_html($row['question'], "nohtml"));
         $answer = stripslashes($row['answer']);
         $answer = decode_bbcode(set_smilies(stripslashes($answer)), 1, true);
    
	    echo"<tr><td><a name=\"$id\"></a>"
            ."<strong><big>&middot;</big></strong>&nbsp;&nbsp;<strong>$question</strong>"
            ."<p align=\"justify\">$answer</p>"
            ."[ <a href=\"#top\">"._BACKTOTOP."</a> ]"
            ."<br /><br />"
            ."</td></tr>";
    
	endwhile;
    
	echo "</table><br /><br />"
        ."<div align=\"center\"><strong>[ <a href=\"modules.php?name=$module_name\">"._BACKTOFAQINDEX."</a> ]</strong></div>";
}

if (!isset($myfaq)): 

    global $currentlang, $multilingual;

    if ($multilingual == 1) 
        $querylang = "WHERE flanguage='$currentlang'";
	else 
        $querylang = "";

    include_once(NUKE_BASE_DIR.'header.php');

    OpenTable();
    
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";
		
	echo "<center><span class=\"option\"><h1>"._FAQ2."</h1></span></center><br /><br />"
    ."<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"
    ."<tr><td bgcolor=\"$bgcolor2\"><span class=\"option\"><strong>"._CATEGORIES."</strong></span></td></tr><tr><td>";
    $result2 = $db->sql_query("SELECT id_cat, categories FROM ".$prefix."_faqcategories $querylang");

    while ($row2 = $db->sql_fetchrow($result2)):
     $id_cat = intval($row2['id_cat']);
     $categories = stripslashes(check_html($row2['categories'], "nohtml"));
     $catname = urlencode($categories);
     echo"<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;myfaq=yes&amp;id_cat=$id_cat&amp;categories=$catname\">$categories</a><br />";
    endwhile;
	
    echo "</td></tr></table>";
	
   # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";
	
    CloseTable();

    include_once(NUKE_BASE_DIR.'footer.php');
else:
    include_once(NUKE_BASE_DIR.'header.php');
    ShowFaq($id_cat, $categories);
    ShowFaqAll($id_cat);
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
endif;
?>
