<?php
/*=======================================================================
 PHP-Nuke Titanium | Nuke-Evolution Basic : Enhanced and Advanced
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

/********************************************************/
/* NSN Blogs                                            */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* Contributer(s): Ernest Buffington aka TheGhost       */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
	  Titanium Patched                         v4.0.3       01/25/2023
-=[Other]=-
      Blogs Fix                                 v1.0.0      06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
      Custom Text Area                         v1.0.0       11/23/2005
	  Titanium Patched                         v3.0.0       08/26/2019
	  New Blogs Last 100 Admin Mod             v3.0.0       08/27/2019
	  New Blogs Programmed Admin Mod           v3.0.0       08/27/2019
-=[Applied Rules]=-	  
 * LongArrayToShortArrayRector
 * AddDefaultValueForUndefinedVariableRector (https://github.com/vimeo/psalm/blob/29b70442b11e3e66113935a2ee22e165a70c74a4/docs/fixing_code.md#possiblyundefinedvariable)
 * MultiDirnameRector
 * TernaryToNullCoalescingRector
 * CountOnNullRector (https://3v4l.org/Bndc9)
 * RemoveExtraParametersRector (https://www.reddit.com/r/PHP/comments/a1ie7g/is_there_a_linter_for_argumentcounterror_for_php/)
 * ListToArrayDestructRector (https://wiki.php.net/rfc/short_list_syntax https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.symmetric-array-destructuring)
 * SensitiveConstantNameRector (https://wiki.php.net/rfc/case_insensitive_constant_deprecation)
 * NullToStrictStringFuncCallArgRector	  
 ************************************************************************/
if (!defined('ADMIN_FILE')) die('Access Denied');

global $prefix, $db, $admdata;

$module_name = basename(dirname(__FILE__, 2));

if(is_mod_admin($module_name)) 
{
  include_once(NUKE_INCLUDE_DIR.'functions_blog.php');

  $pnt_blogs_config = get_blog_configs();

/*********************************************************/
/* Story/Blogs Functions                                 */
/*********************************************************/
function topicicon($topic_icon) 
{
    $sel1 = null;
    $sel2 = null;
    echo "<br /><strong>"._DISPLAY_TOPIC_ICON."</strong>&nbsp;&nbsp;";
    
	if (($topic_icon == 0) OR (empty($topic_icon))) 
	{
        $sel1 = "checked";
        $sel2 = "";
    }
    
	if ($topic_icon == 1) 
	{
        $sel1 = "";
        $sel2 = "checked";
    }

    echo "<input type=\"radio\" name=\"topic_icon\" value=\"0\" $sel1>"._YES."&nbsp;"
        ."<input type=\"radio\" name=\"topic_icon\" value=\"1\" $sel2>"._NO;
}


function writes($writes) 
{
    $sel1 = null;
    $sel2 = null;
    echo "<br /><strong>"._DISPLAY_WRITES."</strong>&nbsp;&nbsp;";

    if (($writes == 1) || (!is_int($writes))) 
	{
        $sel1 = "";
        $sel2 = "checked";
    } 
	else 
	if (($writes == 0)) 
	{
        $sel1 = "checked";
        $sel2 = "";
    }
    
	echo "<input type=\"radio\" name=\"writes\" value=\"0\" $sel1>"._YES."&nbsp;"
        ."<input type=\"radio\" name=\"writes\" value=\"1\" $sel2>"._NO;
}

function puthome($ihome, $acomm) 
{
    $sel1 = null;
    $sel2 = null;
    echo "<br /><strong>"._PUBLISHINHOME."</strong>&nbsp;&nbsp;";

    if (($ihome == 0) OR (empty($ihome))) 
	{
        $sel1 = "checked";
        $sel2 = "";
    }
    
	if ($ihome == 1) 
	{
        $sel1 = "";
        $sel2 = "checked";
    }

    echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1>"._YES."&nbsp;"
        ."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2>"._NO.""
        ."&nbsp;&nbsp;<span class=\"content\">[ "._ONLYIFCATSELECTED." ]</span><br />";

    echo "<br /><strong>"._ACTIVATE_BLOG_COMMENTS."</strong>&nbsp;&nbsp;";
    
	if (($acomm == 0) OR (empty($acomm))) 
	{
        $sel1 = "checked";
        $sel2 = "";
    }
    
	if ($acomm == 1) 
	{
        $sel1 = "";
        $sel2 = "checked";
    }

    echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>"._YES."&nbsp;"
        ."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>"._NO."</font><br /><br />";

}

function deleteBlog($qid) 
{
    global $prefix, $db, $admin_file, $cache;
    $qid = intval($qid);
    $result = $db->sql_query("delete from ".$prefix."_blogs_queue where qid='$qid'");

    if (!$result) 
    return;

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaits', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

    redirect($admin_file.".php?op=submissions");
}

function SelectBlogCategory($cat) 
{
    global $prefix, $db, $admin_file;
    $selcat = $db->sql_query("select catid, title from ".$prefix."_blogs_cat order by title");
    $a = 1;
    echo "<strong>"._BLOG_POST_CATEGORY."</strong> ";
    echo "<select name=\"catid\">";

    if ($cat == 0) 
        $sel = "selected";
	else 
        $sel = "";
    
	echo "<option name=\"catid\" value=\"0\" $sel>"._BLOGS."</option>";
    
	while([$catid, $title] = $db->sql_fetchrow($selcat)) 
	{
        $catid = intval($catid);
    
	    if ($catid == $cat) 
            $sel = "selected";
		else 
            $sel = "";
        
		echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
        $a++;
    }
    
	echo "</select> [ <a href=\"".$admin_file.".php?op=AddBlogCategory\">"._ADD."</a> | <a href=\"".$admin_file.".php?op=EditBlogCategory\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=DelCategory\">"._DELETE."</a> ]";
}

function putpoll($pollTitle, $optionText) 
{
    OpenTable();

    echo "<div style=\"text-align: center\"><span class=\"title\"><strong>"._ATTACHA_BLOG_POLL."</strong></span><br />"
        ."<span class=\"tiny\">"._LEAVEBLANKTONOTATTACH."</span><br />"
        ."<br /><br />"._POLLTITLE.": <input type=\"text\" name=\"pollTitle\" size=\"50\" maxlength=\"100\" value=\"$pollTitle\"><br /><br />"
        ."<font class=\"content\">"._POLLEACHFIELD."</font><br />"
        ."<table border=\"0\" style=\"margin:auto;\">";

    for($i = 1; $i <= 12; $i++)        
	{
        $optional = $optionText[$i] ?? '';
    
	    echo "<tr>"
            ."<td>"._OPTION." $i:</td><td><input type=\"text\" name=\"optionText[$i]\" size=\"50\" maxlength=\"50\" value=\"".$optional."\"></td>"
            ."</tr>";
    }
    
	echo "</table>";
    echo "</div>";
    
	CloseTable();
}

function AddBlogCategory () 
{
    global $admin_file;

    include(NUKE_BASE_DIR.'header.php');

    OpenTable();

    echo "<div align=\"center\"><span class=\"option\"><strong>"._CATEGORYADD."</strong></span><br /><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<strong>"._CATNAME.":</strong> "
        ."<input type=\"text\" name=\"title\" size=\"22\" maxlength=\"20\"> "
        ."<input type=\"hidden\" name=\"op\" value=\"SaveBlogCategory\">"
        ."<input type=\"submit\" value=\""._SAVE."\">"
        ."</form></div>";
   
   echo '<br /><br />';

    CloseTable();

    include(NUKE_BASE_DIR.'footer.php');
}

function EditBlogCategory($catid) 
{
    $sel = null;
    global $prefix, $db, $admin_file;

    $catid = intval($catid);
    $result = $db->sql_query("select title from ".$prefix."_blogs_cat where catid='$catid'");
    
	[$title] = $db->sql_fetchrow($result);
    
	include(NUKE_BASE_DIR.'header.php');

    OpenTable();
    
	echo "<div align=\"center\"><span class=\"option\"><strong>"._EDITCATEGORY."</strong></span><br /><br />";
    
	if (!$catid) 
	{
        $selcat = $db->sql_query("select catid, title from ".$prefix."_blogs_cat");
        
		echo "<form action=\"".$admin_file.".php\" method=\"post\">";
        echo "<strong>"._ASELECTCATEGORY."</strong>";
        echo "<select name=\"catid\">";
        echo "<option name=\"catid\" value=\"0\" $sel>Blogs</option>";
    
	    while([$catid, $title] = $db->sql_fetchrow($selcat)) 
		{
            $catid = intval($catid);
            echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
        }
        
		echo "</select>";
        echo "<input type=\"hidden\" name=\"op\" value=\"EditBlogCategory\">";
        echo "<input type=\"submit\" value=\""._EDIT."\"><br /><br />";
        echo ""._NOBLOGEDIT."";
    } 
	else 
	{
        echo "<form action=\"".$admin_file.".php\" method=\"post\">";
        echo "<strong>"._CATEGORYNAME.":</strong> ";
        echo "<input type=\"text\" name=\"title\" size=\"22\" maxlength=\"20\" value=\"$title\"> ";
        echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
        echo "<input type=\"hidden\" name=\"op\" value=\"SaveEditBlogCategory\">";
        echo "<input type=\"submit\" value=\""._SAVECHANGES."\"><br /><br />";
        echo ""._NOARTCATEDIT."";
        echo "</form>";
    }
    
	echo "</div>";
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function DelCategory($cat) 
{
    global $prefix, $db, $admin_file;

    $cat = intval($cat);
    $result = $db->sql_query("select title from ".$prefix."_blogs_cat where catid='$cat'");
    [$title] = $db->sql_fetchrow($result);

    include(NUKE_BASE_DIR.'header.php');

    OpenTable();
    
	echo "<div align=\"center\"><span class=\"option\"><strong>"._DELETECATEGORY."</strong></span><br /><br />";

    if (!$cat) 
	{
        $selcat = $db->sql_query("select catid, title from ".$prefix."_blogs_cat");
    
	    echo "<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<strong>"._SELECTCATDEL.": </strong>"
            ."<select name=\"cat\">";
    
	    while([$catid, $title] = $db->sql_fetchrow($selcat)) 
		{
            $catid = intval($catid);
            echo "<option name=\"cat\" value=\"$catid\">$title</option>";
        }
        
		echo "</select>"
            ."<input type=\"hidden\" name=\"op\" value=\"DelCategory\">"
            ."<input type=\"submit\" value=\"Delete\">"
            ."</form><br />";
    } 
	else 
	{
        $result2 = $db->sql_query("select * from ".$prefix."_blogs where catid='$cat'");
        $numrows = $db->sql_numrows($result2);
        
		if ($numrows == 0) 
		{
            $db->sql_query("delete from ".$prefix."_blogs_cat where catid='$cat'");
            echo "<br /><br />"._CATDELETED."<br /><br />"._GOTOADMIN."";
        } 
		else 
		{
            echo "<br /><br /><strong>"._WARNING.":</strong> "._THECATEGORY." <strong>$title</strong> "._HAS." <strong>$numrows</strong> "._STORIESINSIDE."<br />"
                .""._DELCATWARNING1."<br />"
                .""._DELCATWARNING2."<br /><br />"
                .""._DELCATWARNING3."<br /><br />"
                ."<strong>[ <a href=\"".$admin_file.".php?op=YesDelBlogCategory&amp;catid=$cat\">"._YESDEL."</a> | "
                ."<a href=\"".$admin_file.".php?op=NoMoveBlogCategory&amp;catid=$cat\">"._NOMOVE."</a> ]</strong>";
        }
    }
    
	echo "</div>";
    
	CloseTable();
    
    include(NUKE_BASE_DIR.'footer.php');
}

function YesDelBlogCategory($catid) 
{
    global $prefix, $db, $admin_file;

    $catid = intval($catid);
    $db->sql_query("delete from ".$prefix."_blogs_cat where catid='$catid'");
    $result = $db->sql_query("select sid from ".$prefix."_blogs where catid='$catid'");

    while([$sid] = $db->sql_fetchrow($result)) 
	{
        $sid = intval($sid);
        $db->sql_query("delete from ".$prefix."_blogs where catid='$catid'");
        $db->sql_query("delete from ".$prefix."_blogs_comments where sid='$sid'");
    }
    
	redirect($admin_file.".php?op=adminBlog");
}

function NoMoveBlogCategory($catid, $newcat) 
{
    global $prefix, $db, $admin_file;

    $catid = intval($catid);
    $result = $db->sql_query("select title from ".$prefix."_blogs_cat where catid='$catid'");

    [$title] = $db->sql_fetchrow($result);

    include(NUKE_BASE_DIR.'header.php');

    echo "<div align=\"center\"> enter><span class=\"option\"><strong>"._MOVE_BLOGS."</strong></span></div><br /><br />";

    if (!$newcat) 
	{
        echo ""._ALL_BLOGS." <strong>$title</strong> "._WILLBEMOVED."<br /><br />";
        $selcat = $db->sql_query("select catid, title from ".$prefix."_blogs_cat");
        echo "<form action=\"".$admin_file.".php\" method=\"post\">";
        echo "<strong>"._SELECTNEWCAT.":</strong> ";
        echo "<select name=\"newcat\">";
        echo "<option name=\"newcat\" value=\"0\">"._BLOGS."</option>";
    
	    while([$newcat, $title] = $db->sql_fetchrow($selcat)) 
		{
          echo "<option name=\"newcat\" value=\"$newcat\">$title</option>";
        }
        
		echo "</select>";
        echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
        echo "<input type=\"hidden\" name=\"op\" value=\"NoMoveBlogCategory\">";
        echo "<input type=\"submit\" value=\""._OK."\">";
        echo "</form>";
    } 
	else 
	{
        $resultm = $db->sql_query("select sid from ".$prefix."_blogs where catid='$catid'");
    
	    while([$sid] = $db->sql_fetchrow($resultm)) 
		{
          $sid = intval($sid);
          $db->sql_query("update ".$prefix."_blogs set catid='$newcat' where sid='$sid'");
        }
        
		$db->sql_query("delete from ".$prefix."_blogs_cat where catid='$catid'");

        echo ""._MOVEDONE."";
    }
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function SaveEditBlogCategory($catid, $title) 
{
    global $prefix, $db, $admin_file;

    $title = str_replace("\"","",(string) $title);
    $result = $db->sql_query("select catid from ".$prefix."_blogs_cat where title='$title'");
    $catid = intval($catid);
    $check = $db->sql_numrows($result);

    if ($check) 
	{
        $what1 = _CATEXISTS;
        $what2 = _GOBACK;
    } 
	else 
	{
        $what1 = _CATSAVED;
        $what2 = "[ <a href=\"".$admin_file.".php\">"._GOTOADMIN."</a> ]";
        $result = $db->sql_query("update ".$prefix."_blogs_cat set title='$title' where catid='$catid'");
    
	    if (!$result) 
        return;
    }
    
	include(NUKE_BASE_DIR.'header.php');
    
    OpenTable();
    
	echo "<div align=\"center\"><span class=\"title\"><strong>"._CATEGORIESADMIN."</strong></span></div><br />";
	echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

    echo "<div align=\"center\"><span class=\"content\"><strong>$what1</strong></span><br /><br />";
    echo "$what2</div>";
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function SaveBlogCategory($title) 
{
    global $prefix, $db, $admin_file;

    $title = str_replace("\"","",(string) $title);
    $result = $db->sql_query("select catid from ".$prefix."_blogs_cat where title='$title'");
    $check = $db->sql_numrows($result);
 
    if ($check) 
	{
        $what1 = _CATEXISTS;
        $what2 = _GOBACK;
    } 
	else 
	{
        $what1 = _CATADDED;
        $what2 = _GOTOADMIN;
        $result = $db->sql_query("insert into ".$prefix."_blogs_cat values (NULL, '$title', '0')");
    
	    if (!$result) 
        return;
    }
    
	include(NUKE_BASE_DIR.'header.php');
    
    OpenTable();
    
	echo "<center><span class=\"content\"><strong>$what1</strong></span><br /><br />";
    echo "$what2</center>";
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function autodeleteblog($anid) 
{
    global $prefix, $db, $admin_file;
    $anid = intval($anid);
    $db->sql_query("delete from ".$prefix."_blogs_autoblog where anid='$anid'");
    redirect($admin_file.".php?op=adminBlog");
}

function autoEditBlog($anid) 
{
    $sid = null;
    $subject = null;
    $sel = null;
    global $aid, $bgcolor1, $bgcolor2, $prefix, $db, $multilingual, $admin_file, $module_name;

    $sid = intval($sid);
    $aid = substr((string) $aid, 0,25);

    [$aaid] = $db->sql_ufetchrow("SELECT aid from ".$prefix."_blogs WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr((string) $aaid, 0,25);

    if (is_mod_admin($module_name)) 
	{
      include(NUKE_BASE_DIR.'header.php');

      $result = $db->sql_query("SELECT 
	                            
								 catid, 
								   aid, 
								 title, 
						 datePublished, 
						  dateModified, 
						      hometext, 
							  bodytext, 
							     topic, 
							 informant, 
							     notes, 
								 ihome, 
							 alanguage, 
							     acomm, 
								 ticon, 
								writes 
								
								FROM ".$prefix."_blogs_autoblog 
								
								WHERE anid='$anid'");
								
      [$catid, $aid, $title, $time, $modified, $hometext, $bodytext, $topic, $informant, $notes, $ihome, $alanguage, $acomm, $topic_icon, $writes] = $db->sql_fetchrow($result);

      $catid = intval($catid);
      $aid = substr((string) $aid, 0,25);
      $informant = substr((string) $informant, 0,25);
      $ihome = intval($ihome);
      $acomm = intval($acomm);
      $topic_icon = intval($topic_icon);
      $writes = intval($writes);
      
	  preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", (string) $time, $datetime);

      OpenTable();
	  
      echo "<div align=\"center\"><span class=\"title\"><strong>"._BLOG_ADMIN."</strong></span></div><br />";
	  echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
	  echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div>";
      
	  $today = getdate();
      $tday = $today[\MDAY];
      
	  if ($tday < 10)
      $tday = "0$tday";
      
	  $tmonth = $today[\MONTH];
      $tyear = $today[\YEAR];
      $thour = $today[\HOURS];
      
	  if ($thour < 10)
      $thour = "0$thour";
      
	  $tmin = $today[\MINUTES];
      
	  if ($tmin < 10)
      $tmin = "0$tmin";

      $tsec = $today[\SECONDS];

      if ($tsec < 10)
      $tsec = "0$tsec";

      $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<div align=\"center\"><span class=\"option\"><strong>"._AUTOSTORYEDIT."</strong></span></div><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postblog\">";

    $title = stripslashes((string) $title);
    $hometext = stripslashes((string) $hometext);
    $bodytext = stripslashes((string) $bodytext);
    $notes = stripslashes((string) $notes);
    $result=$db->sql_query("select topicimage from ".$prefix."_blogs_topics where topicid='$topic'");

    [$topicimage] = $db->sql_fetchrow($result);
    
	echo "<table border=\"0\" width=\"75%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>"
        ."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor=\"$bgcolor1\"><tr><td>";

    if ($topic_icon == 0) 
    echo "<img src=\"images/Blog_Topics/$topicimage\" border=\"0\" align=\"right\" alt=\"\">";
    
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
	$hometext_bb = decode_bbcode(set_smilies(stripslashes($hometext)), 1, true);
    $bodytext_bb = decode_bbcode(set_smilies(stripslashes($bodytext)), 1, true);
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    
	$hometext_bb = img_tag_to_resize($hometext_bb);
    $bodytext_bb = img_tag_to_resize($bodytext_bb);
    
	themepreview($subject, $hometext_bb, $bodytext_bb);
    
	echo "</td></tr></table></td></tr></table>"
        ."<br /><br /><strong>"._TITLE."</strong><br />"
        ."<input type=\"text\" name=\"title\" size=\"50\" value=\"$title\"><br /><br />"
        ."<strong>"._TOPIC."</strong> <select name=\"topic\">";
 
    $toplist = $db->sql_query("select topicid, topictext from ".$prefix."_blogs_topics order by topictext");
    
	echo "<option value=\"\">"._ALLTOPICS."</option>\n";
 
    while([$topicid, $topics] = $db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
    
	    if ($topicid==$topic) 
        $sel = "selected "; 
	    
        echo "<option $sel value=\"$topicid\">$topics</option>\n";
        $sel = "";
    }
    
	echo "</select><br /><br />";
    $cat = $catid;
    
	SelectBlogCategory($cat);
    echo '<br />';
    topicicon($topic_icon);
    echo '<br />';
    writes($writes);
    echo "<br />";
    puthome($ihome, $acomm);

    if ($multilingual == 1) 
	{
        echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"alanguage\">";
        
		$languages = lang_list();
        
		echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) 
		{
            if ($languages[$i] != '') 
            echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
        }

        echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";

    echo "<br /><br /><strong>"._BLOG_TEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postblog');
    echo "<strong>"._EXTENDED_BLOG_TEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postblog');
    echo "<span class=\"content\">"._ARESUREURL."</span><br /><br />";
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/

    if ($aid != $informant) 
	{
        echo "<strong>"._NOTES."</strong><br />
        <textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\">$notes</textarea><br /><br />";
    }
    echo "<br /><strong>"._CHNGPROGRAMSTORY."</strong><br /><br />"
        .""._NOWIS.": $date<br /><br />";
    
	$xday = 1;
    
	echo ""._DAY.": <select name=\"day\">";
    
	while ($xday <= 31) 
	{
        if ($xday == $datetime[3]) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"day\" $sel>$xday</option>";
        $xday++;
    }
    
	echo "</select>";

    $xmonth = 1;

    echo ""._UMONTH.": <select name=\"month\">";
    
	while ($xmonth <= 12) 
	{
        if ($xmonth == $datetime[2]) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"month\" $sel>$xmonth</option>";
        $xmonth++;
    }
    
	echo "</select>";
    echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$datetime[1]\" size=\"5\" maxlength=\"4\">";
    echo "<br />"._HOUR.": <select name=\"hour\">";
    
	$xhour = 0;
    $cero = "0";
    
	while ($xhour <= 23) 
	{
        $dummy = $xhour;
    
	    if ($xhour < 10) 
        $xhour = "$cero$xhour";
        
		if ($xhour == $datetime[4]) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"hour\" $sel>$xhour</option>";

        $xhour = $dummy;
        $xhour++;
    }

    echo "</select>";
    echo ": <select name=\"min\">";

    $xmin = 0;
    
	while ($xmin <= 59) 
	{
        if (($xmin == 0) OR ($xmin == 5)) 
        $xmin = "0$xmin";
        
		if ($xmin == $datetime[5]) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"min\" $sel>$xmin</option>";
        $xmin = $xmin + 5;
    }
    
	echo "</select>";
    echo ": 00<br /><br />
    
	<input type=\"hidden\" name=\"anid\" value=\"$anid\">
    <input type=\"hidden\" name=\"op\" value=\"autoSaveEditBlog\">
    <input type=\"submit\" value=\""._SAVECHANGES."\">
    </form>";
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');

        OpenTable();

        echo "<div align=\"center\"><span class=\"title\"><strong>"._BLOG_ADMIN."</strong></span></div><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

        echo "<div align=\"center\"><strong>"._NOTAUTHORIZED_EDIT1."</strong></div><br /><br />"
            .""._NOTAUTHORIZED_EDIT2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    }
}

function autoSaveEditBlog($anid, $year, $day, $month, $hour, $min, $title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes) 
{
    $sid = null;
    global $aid, $ultramode, $prefix, $db, $admin_file, $module_name;

    $sid = intval($sid);
    $aid = substr((string) $aid, 0,25);
	
    [$aaid] = $db->sql_ufetchrow("SELECT aid from ".$prefix."_blogs WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr((string) $aaid, 0,25);

    if (is_mod_admin($module_name)) 
	{
	  if ($day < 10) 
      $day = "0$day";
    
	  if ($month < 10) 
      $month = "0$month";
   
	  $sec = "00";
      $date = "$year-$month-$day $hour:$min:$sec";
      $title = Fix_Quotes($title);
	  $modified = NULL;
      $hometext = Fix_Quotes($hometext);
      $bodytext = Fix_Quotes($bodytext);
      $notes = Fix_Quotes($notes);
    
	  $result = $db->sql_query("UPDATE ".$prefix."_blogs_autoblog set 
	 
	       catid='$catid', 
	       title='$title', 
	datePublished='$date',
 dateModified='$modified',   
     hometext='$hometext', 
     bodytext='$bodytext', 
           topic='$topic', 
		   notes='$notes', 
		   ihome='$ihome', 
   alanguage='$alanguage', 
           acomm='$acomm', 
	  ticon='$topic_icon', 
	     writes='$writes' 
	 
	 WHERE anid='$anid'");

     if (!$result) 
     exit();
     
	 if ($ultramode) 
     blog_ultramode();
     
     redirect($admin_file.".php?op=adminBlog");
    } 
   else 
	{
        include(NUKE_BASE_DIR.'header.php');
    
        OpenTable();

        echo "<div align=\"center\"><span class=\"title\"><strong>"._BLOG_ADMIN."</strong></span></div><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
        echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";
   
        echo "<center><strong>"._NOTAUTHORIZED_EDIT1."</strong><br /><br />"
            .""._NOTAUTHORIZED_EDIT2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    }
}

function displayBlog($qid) 
{
    $sel = null;
    global $user, $admin_file, $subject, $story, $bgcolor1, $bgcolor2, $anonymous, $user_prefix, $prefix, $db, $multilingual;

    include(NUKE_BASE_DIR.'header.php');

	$today = getdate();
    $tday = $today['mday'];
    
	if ($tday < 10)
    $tday = "0$tday";
    
	$tmonth = $today['month'];
    $ttmon = $today['mon'];
    
	if ($ttmon < 10)
    $ttmon = "0$ttmon";
    
	$tyear = $today['year'];
    $thour = $today['hours'];
    
	if ($thour < 10)
    $thour = "0$thour";
    
	$tmin = $today['minutes'];
    
	if ($tmin < 10)
    $tmin = "0$tmin";
    
	$tsec = $today['seconds'];
    
	if ($tsec < 10)
    $tsec = "0$tsec";
    
	$date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    $qid = intval($qid);
    
	$result = $db->sql_query("SELECT qid, 
	                                 uid, 
								   uname, 
								 subject, 
								   story, 
								storyext, 
								   topic, 
							    alanguage 
								
								FROM ".$prefix."_blogs_queue 
								
								WHERE qid='$qid'");

    [$qid, $uid, $uname, $subject, $story, $storyext, $topic, $alanguage] = $db->sql_fetchrow($result);

    $qid = intval($qid);
    $uid = intval($uid);
    $subject = stripslashes((string) $subject);
    $story = stripslashes((string) $story);
    $storyext = stripslashes((string) $storyext);

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    $storyext_bb = decode_bbcode(set_smilies(stripslashes($storyext)), 1, true);
    $story_bb = decode_bbcode(set_smilies(stripslashes($story)), 1, true);
    $storyext_bb = img_tag_to_resize($storyext_bb);
    $story_bb = img_tag_to_resize($story_bb);
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/

    OpenTable();
    
	echo "<div align=\"center\"><span class=\"title\"><strong>"._BLOG_SUBMISSIONSADMIN."</strong></span></div><br />";
 	echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
 	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<font class=\"content\">"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postblog\">"
        ."<strong>"._NAME."</strong><br />"
        ."<input type=\"text\" NAME=\"author\" size=\"25\" value=\"$uname\">";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    if ($uname != $anonymous) 
	{
      $res = $db->sql_query("SELECT user_email from ".$user_prefix."_users WHERE username='$uname'");
      
	  [$email] = $db->sql_fetchrow($res);
      
	  echo "&nbsp;&nbsp;<span class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._EMAILUSER."</a> | <a href='modules.php?name=Your_Account&op=userinfo&username=$uname'>"._USERPROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</span>";
    }
    
	echo "<br /><br /><strong>"._TITLE."</strong><br />"
        ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br /><br />";
    
	if(empty($topic)) 
    $topic = 1;
    
	$result = $db->sql_query("select topicimage from ".$prefix."_blogs_topics where topicid='$topic'");

    [$topicimage] = $db->sql_fetchrow($result);

    echo "<table border=\"0\" width=\"70%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>"
        ."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor=\"$bgcolor1\"><tr><td>";

    if (isset($topic_icon) && $topic_icon == 0) 
    echo "<img src=\"images/Blog_Topics/$topicimage\" border=\"0\" align=\"right\" alt=\"\">";

    $storypre = "$story_bb<br /><br />$storyext_bb";

/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    themepreview($subject, $storypre);

    echo "</td></tr></table></td></tr></table>"
        ."<br /><strong>"._TOPIC."</strong> <select name=\"topic\">";

    $toplist = $db->sql_query("select topicid, topictext from ".$prefix."_blogs_topics order by topictext");

    echo "<option value=\"\">"._SELECT_BLOG_TOPIC."</option>\n";

    while([$topicid, $topics] = $db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
        
		if ($topicid==$topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$topics</option>\n";
        $sel = "";
    }

    echo "</select>";
    echo "<br /><br />";
    echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOCIATED_BLOG_TOPICS."</strong></td><td width='100%'>"
        ."<table border='1' cellspacing='3' cellpadding='8'><tr>";

    $sql = "SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER BY topictext";
    $result = $db->sql_query($sql);
    $a = 0;
    
	while ($row = $db->sql_fetchrow($result)) 
	{
        if ($a == 3) 
		{
            echo "</tr><tr>";
            $a = 0;
        }

        echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."'>".$row["topictext"]."</td>";
        $a++;
    }

    echo "</tr></table></td></tr></table><br /><br />";
    
	if(!isset($cat))
	$cat = '';

	if(!isset($topic_icon))
	$topic_icon = '';

	if(!isset($writes))
	$writes = '';

	if(!isset($ihome))
	$ihome = '';

	if(!isset($acomm))
	$acomm = '';
	
	SelectBlogCategory($cat);
    echo '<br />';
    topicicon($topic_icon);
    echo '<br />';
    writes($writes);
    echo "<br />";
    puthome($ihome, $acomm);

    if ($multilingual == 1) 
	{
        echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"alanguage\">";
        $languages = lang_list();

        echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) 
		{
            if ($languages[$i] != '') 
            echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
        }
        
		echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";
    
	echo "<br /><br /><strong>"._BLOG_TEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $story, 'postblog');
    echo "<strong>"._EXTENDED_BLOG_TEXT."</strong>";
    Make_TextArea('bodytext', $storyext, 'postblog');
    echo "<span class=\"content\">"._ARESUREURL."</span><br /><br />";
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/

    echo "<span class=\"content\">"._AREYOUSURE."</span><br /><br />"
        ."<strong>"._NOTES."</strong><br />"
        ."<textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\"></textarea><br />"
        ."<input type=\"hidden\" NAME=\"qid\" size=\"50\" value=\"$qid\">"
        ."<input type=\"hidden\" NAME=\"uid\" size=\"50\" value=\"$uid\">"
        ."<br /><strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
        ."<input type=\"radio\" name=\"automated\" value=\"1\">"._YES." &nbsp;&nbsp;"
        ."<input type=\"radio\" name=\"automated\" value=\"0\" checked>"._NO."<br /><br />"
        .""._NOWIS.": $date<br /><br />";

    $day = 1;

    echo ""._DAY.": <select name=\"day\">";
    
	while ($day <= 31) 
	{
        if ($tday==$day) 
        $sel = "selected";
		else 
        $sel = "";

        echo "<option name=\"day\" $sel>$day</option>";
        $day++;
    }

    echo "</select>";

    $month = 1;

    echo ""._UMONTH.": <select name=\"month\">";
    
	while ($month <= 12) 
	{
        if ($ttmon==$month) 
        $sel = "selected";
		else 
        $sel = "";

        echo "<option name=\"month\" $sel>$month</option>";
        $month++;
    }
    
	echo "</select>";

    $date = getdate();
    $year = $date['year'];

    echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">";
    echo "<br />"._HOUR.": <select name=\"hour\">";

    $hour = 0;
    $cero = "0";
    
	while ($hour <= 23) 
	{
        $dummy = $hour;
        
		if ($hour < 10) 
        $hour = "$cero$hour";
        
		echo "<option name=\"hour\">$hour</option>";
        
		$hour = $dummy;
        $hour++;
    }
    
	echo "</select>";
    echo ": <select name=\"min\">";

    $min = 0;
    
	while ($min <= 59) 
	{
        if (($min == 0) OR ($min == 5)) 
        $min = "0$min";
        
		echo "<option name=\"min\">$min</option>";
        $min = $min + 5;
    }
    
	echo "</select>";
    echo ": 00<br /><br />"
        ."<select name=\"op\">"
        ."<option value=\"DeleteBlog\">"._DELETEBLOG."</option>"
        ."<option value=\"PreviewBlogAgain\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostBlog\">"._POSTSTORY."</option>"
        ."</select>"
        ."<input type=\"submit\" value=\""._OK."\">&nbsp;&nbsp;[ <a href=\"".$admin_file.".php?op=DeleteBlog&qid=$qid\">"._DELETE."</a> ]";

        CloseTable();

    if(!isset($pollTitle))
    $pollTitle = '';

    if(!isset($optionText))
    $optionText = '';

    putpoll($pollTitle, $optionText);

    echo "</form>";

    include(NUKE_BASE_DIR.'footer.php');
}

function previewBlog($automated, 
                           $year, 
						    $day, 
						  $month, 
						   $hour, 
						    $min, 
						    $qid, 
							$uid, 
						 $author, 
						$subject, 
					   $hometext, 
					   $bodytext, 
					      $topic, 
						  $notes, 
						  $catid, 
						  $ihome, 
					  $alanguage, 
					      $acomm, 
					 $topic_icon, 
					     $writes, 
					  $pollTitle, 
					 $optionText, 
					    $assotop) 
{
    $sel = null;
    $associated = null;
    $checked = null;
    $language = null;
    global $user, $admin_file, $boxstuff, $anonymous, $bgcolor1, $bgcolor2, $user_prefix, $prefix, $db, $multilingual, $Version_Num;

    include(NUKE_BASE_DIR.'header.php');

    $today = getdate();
    $tday = $today['mday'];
    
	if ($tday < 10)
    $tday = "0$tday";
    
	$tmonth = $today['month'];
    $tyear = $today['year'];
    $thour = $today['hours'];
    
	if ($thour < 10)
    $thour = "0$thour";
    
	$tmin = $today['minutes'];
    
	if ($tmin < 10)
    $tmin = "0$tmin";
    
	$tsec = $today['seconds'];
    
	if ($tsec < 10)
    $tsec = "0$tsec";
    
	$date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    $subject = stripslashes((string) $subject);
    $hometext = stripslashes((string) $hometext);
    $bodytext = stripslashes((string) $bodytext);
    $notes = stripslashes((string) $notes);
    
	OpenTable();
	
    echo "<div align=\"center\"><span class=\"title\"><strong>"._BLOG_ADMIN."</strong></span></div><br />";
	echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<font class=\"content\">"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postblog\">"
        ."<strong>"._NAME."</strong><br />"
        ."<input type=\"text\" name=\"author\" size=\"25\" value=\"$author\">";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/

    if ($author != $anonymous) 
	{
        $res = $db->sql_query("select user_id, user_email from ".$user_prefix."_users where username='$author'");
        [$pm_userid, $email] = $db->sql_fetchrow($res);
        $pm_userid = intval($pm_userid);
        echo "&nbsp;&nbsp;<span class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._EMAILUSER."</a> | <a href='modules.php?name=Your_Account&op=userinfo&username=$author'>"._USERPROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</span>";
    }
    
	echo "<br /><br /><strong>"._TITLE."</strong><br />"
        ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br /><br />";

    $result = $db->sql_query("select topicimage from ".$prefix."_blogs_topics where topicid='$topic'");

    [$topicimage] = $db->sql_fetchrow($result);

    echo "<table width=\"70%\" bgcolor=\"$bgcolor2\" cellpadding=\"0\" cellspacing=\"1\" border=\"0\"align=\"center\"><tr><td>"
        ."<table width=\"100%\" bgcolor=\"$bgcolor1\" cellpadding=\"8\" cellspacing=\"1\" border=\"0\"><tr><td>";
    
	if ($topic_icon == 0) 
    echo "<img src=\"images/Blog_Topics/$topicimage\" border=\"0\" align=\"right\" alt=\"\">";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    $bodytext_bb = decode_bbcode(set_smilies(stripslashes($bodytext)), 1, true);
    $hometext_bb = decode_bbcode(set_smilies(stripslashes($hometext)), 1, true);
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/

    $hometext_bb = img_tag_to_resize($hometext_bb);
    $bodytext_bb = img_tag_to_resize($bodytext_bb);

    themepreview($subject, $hometext_bb, $bodytext_bb, $notes);

    echo "</td></tr></table></td></tr></table>"
        ."<br /><strong>"._TOPIC."</strong> <select name=\"topic\">";
    
	$toplist = $db->sql_query("SELECT topicid, topictext FROM ".$prefix."_blogs_topics order by topictext");
    
	echo "<option value=\"\">"._ALLTOPICS."</option>\n";

    while([$topicid, $topics] = $db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
    
	    if ($topicid==$topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$topics</option>\n";
        $sel = "";
    }
    
	echo "</select>";
    echo "<br /><br />";
    
    if($Version_Num >= 6.6) 
	{
        for ($i=0; $i<(is_countable($assotop) ? count($assotop) : 0); $i++) 
	    $associated .= "$assotop[$i]-"; 
    
	    $asso_t = explode("-", $associated);

        echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOCIATED_BLOG_TOPICS."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";

        $sql = "SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER BY topictext";
        $result = $db->sql_query($sql);
        $a = 0;
    
	    while ($row = $db->sql_fetchrow($result)) 
		{
            if ($a == 3) 
			{
                echo "</tr><tr>";
                $a = 0;
            }
            
			for ($i=0; $i<count($asso_t); $i++) 
			{
                if ($asso_t[$i] == $row["topicid"]) 
				{
                    $checked = "CHECKED";
                    break;
                }
            }

            echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."' $checked>".$row["topictext"]."</td>";

            $checked = "";
            $a++;
        }
        
		echo "</tr></table></td></tr></table><br /><br />";
    }
    // Copyright (c) 2000-2005 by NukeScripts Network
    $cat = $catid;
    SelectBlogCategory($cat);
    echo '<br />';
    topicicon($topic_icon);
    echo '<br />';
    writes($writes);
    echo "<br />";
    puthome($ihome, $acomm);

    if ($multilingual == 1) 
	{
        echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"alanguage\">";
        $languages = lang_list();
        echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) 
		{
            if ($languages[$i] != '') 
            echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
        }
        echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\">";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<br /><br /><strong>"._BLOG_TEXT."</strong>";


/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postblog');
    echo "<strong>"._EXTENDED_BLOG_TEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postblog');
    echo "<span class=\"content\">"._ARESUREURL."</span><br /><br />";
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/

    echo "<strong>"._NOTES."</strong><br />"
        ."<textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\">$notes</textarea><br /><br />"
        ."<input type=\"hidden\" NAME=\"qid\" size=\"50\" value=\"$qid\">"
        ."<input type=\"hidden\" NAME=\"uid\" size=\"50\" value=\"$uid\">";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    if ($automated == 1) 
	{
        $sel1 = "checked";
        $sel2 = "";
    } 
	else 
	{
        $sel1 = "";
        $sel2 = "checked";
    }
    
	echo "<strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
        ."<input type=\"radio\" name=\"automated\" value=\"1\" $sel1>"._YES." &nbsp;&nbsp;"
        ."<input type=\"radio\" name=\"automated\" value=\"0\" $sel2>"._NO."<br /><br />"
        .""._NOWIS.": $date<br /><br />";
    
	$xday = 1;
    
	echo ""._DAY.": <select name=\"day\">";
    
	while ($xday <= 31) 
	{
        if ($xday == $day) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"day\" $sel>$xday</option>";
        $xday++;
    }

    echo "</select>";

    $xmonth = 1;

    echo ""._UMONTH.": <select name=\"month\">";
    
	while ($xmonth <= 12) 
	{
        if ($xmonth == $month) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"month\" $sel>$xmonth</option>";

        $xmonth++;
    }

    echo "</select>";
    echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">";
    echo "<br />"._HOUR.": <select name=\"hour\">";

    $xhour = 0;
    $cero = "0";
    
	while ($xhour <= 23) 
	{
        $dummy = $xhour;
    
	    if ($xhour < 10) 
        $xhour = "$cero$xhour";
        
		if ($xhour == $hour) 
        $sel = "selected";
		else 
        $sel = "";

        echo "<option name=\"hour\" $sel>$xhour</option>";
        $xhour = $dummy;
        $xhour++;
    }

    echo "</select>";
    echo ": <select name=\"min\">";

    $xmin = 0;
    
	while ($xmin <= 59) 
	{
        if (($xmin == 0) OR ($xmin == 5)) 
        $xmin = "0$xmin";
        
		if ($xmin == $min) 
        $sel = "selected";
		else 
        $sel = "";

        echo "<option name=\"min\" $sel>$xmin</option>";
        $xmin = $xmin + 5;
    }

    echo "</select>";

    echo ": 00<br /><br />"
        ."<select name=\"op\">"
        ."<option value=\"DeleteBlog\">"._DELETEBLOG."</option>"
        ."<option value=\"PreviewBlogAgain\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostBlog\">"._POSTSTORY."</option>"
        ."</select>"
        ."<input type=\"submit\" value=\""._OK."\">";

    CloseTable();

    putpoll($pollTitle, $optionText);

    echo "</form>";

    include(NUKE_BASE_DIR.'footer.php');
}

function postStory($automated, 
                        $year, 
						 $day, 
					   $month, 
					    $hour, 
						 $min, 
						 $qid, 
						 $uid, 
					  $author, 
					 $subject, 
					$hometext, 
					$bodytext, 
					   $topic, 
					   $notes, 
					   $catid, 
					   $ihome, 
				   $alanguage, 
				       $acomm, 
				  $topic_icon, 
				      $writes, 
				   $pollTitle, 
				  $optionText, 
				     $assotop) 
{
    $associated = null;
    global $aid, $admin_file, $ultramode, $prefix, $db, $user_prefix, $Version_Num, $pnt_blogs_config, $adminmail, $sitename, $nukeurl, $cache;

    // Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_Num >= 6.6) 
	{ 
	   for ($i=0; $i<(is_countable($assotop) ? count($assotop) : 0); $i++) 
       $associated .= "$assotop[$i]-"; 
	     
	}
    // Copyright (c) 2000-2005 by NukeScripts Network

    if ($automated == 1) 
	{
        if ($day < 10) 
        $day = "0$day";
        
		if ($month < 10) 
        $month = "0$month";
        
		$sec = "00";
        $date = "$year-$month-$day $hour:$min:$sec";
        
		$modified = "$year-$month-$day $hour:$min:$sec";
		
		if ($uid == 1) 
		$author = "";
        
		if ($hometext == $bodytext) 
		$bodytext = "";
        
		$subject = Fix_Quotes($subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        $new_sql  = "INSERT INTO ".$prefix."_blogs_autoblog values (NULL, 
		                                                   '$catid', 
														     '$aid', 
														 '$subject', 
														    '$date',
													    '$modified', 
													    '$hometext', 
													    '$bodytext', 
													       '$topic', 
														  '$author', 
														   '$notes', 
														   '$ihome', 
													   '$alanguage', 
													       '$acomm', 
													  '$topic_icon', 
													      '$writes'";
        
		$new_sql .= ", '$associated'";
 		$new_sql .= ")";
		
        $result = $db->sql_query($new_sql);
        
		// Copyright (c) 2000-2005 by NukeScripts Network ??
        if (!$result) 
	    return; 
		
        $result = $db->sql_query("SELECT sid from ".$prefix."_blogs WHERE title='$subject' order by time DESC limit 0,1");
        
		[$artid] = $db->sql_fetchrow($result);
        
		$artid = intval($artid);
        
		if ($uid != 1) 
		{
            $db->sql_query("UPDATE ".$user_prefix."_users SET counter=counter+1 WHERE user_id='$uid'");

			// Copyright (c) 2000-2005 by NukeScripts Network
            if($pnt_blogs_config["notifyauth"] == 1) 
			{
                $urow = $db->sql_fetchrow($db->sql_query("SELECT username, user_email FROM ".$user_prefix."_users WHERE user_id='$uid'"));
                $Mto = $urow["username"]." <".$urow["user_email"].">";
                $Msubject = _BLOG_ARTPUB;
                $Mbody = _BLOG_HASPUB."\n$nukeurl/modules.php?name=Blogs&file=article&sid=$artid";
                $Mheaders  = "From: ".$sitename." <$adminmail>\r\n";
                $Mheaders .= "Reply-To: $adminmail\r\n";
                $Mheaders .= "Return-Path: $adminmail\r\n";
                $Mheaders .= "Organization: $sitename\r\n";
                $Mheaders .= "MIME-Version: 1.0\r\n";
                $Mheaders .= "Content-Type: text/plain\r\n";
                $Mheaders .= "Content-Transfer-Encoding: 8bit\r\n";
                $Mheaders .= "X-MSMail-Priority: High\r\n";
                $Mheaders .= "X-Mailer: Titanium Blogs          \r\n";
                @evo_mail($Mto, $Msubject, $Mbody, $Mheaders);
            }
            // Copyright (c) 2000-2005 by NukeScripts Network
        }
        $db->sql_query("UPDATE ".$prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
	    blog_ultramode(); 
        
		$qid = intval($qid);
        $db->sql_query("DELETE FROM ".$prefix."_blogs_queue WHERE qid='$qid'");

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('numwaits', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

        redirect($admin_file.".php?op=submissions");
    } 
	else 
	{
        if ($uid == 1) 
		$author = "";
        
		if ($hometext == $bodytext) 
		$bodytext = "";
        
		$subject = Fix_Quotes($subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        
		if ((!empty($pollTitle)) AND (!empty($optionText[1])) AND (!empty($optionText[2]))) 
		{
            $haspoll = 1;
            $timeStamp = time();
            $pollTitle = Fix_Quotes($pollTitle);
        
		    if(!$db->sql_query("INSERT INTO ".$prefix."_poll_desc VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$alanguage', '0')")) 
            return;
            
			$object = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
            $id = $object["pollID"];
            $id = intval($id);
            
			for($i = 1, $maxi = is_countable($optionText) ? count($optionText) : 0; $i <= $maxi; $i++) 
			{
                if(!empty($optionText[$i])) 
                $optionText[$i] = Fix_Quotes($optionText[$i]);
                
				if(!$db->sql_query("INSERT INTO ".$prefix."_poll_data (pollID, optionText, optionCount, voteID) VALUES ('$id', '$optionText[$i]', '0', '$i')")) 
                return;
            }
        } 
		else 
		{
            $haspoll = 0;
            $id = 0;
        }

    // Copyright (c) 2000-2005 by NukeScripts Network
	if(!isset($topic_id))
	$topic_id = 0;														   
															   
   $new_sql = "INSERT INTO `".$prefix."_blogs` (`sid`, 
		                                      `catid`, 
											    `aid`, 
											  `title`, 
									  `datePublished`, 
									   `dateModified`, 
									       `hometext`, 
										   `bodytext`, 
										   `comments`, 
										    `counter`, 
											  `topic`, 
										  `informant`, 
										      `notes`, 
											  `ihome`, 
										  `alanguage`, 
										      `acomm`, 
											`haspoll`, 
											 `pollID`, 
											  `score`, 
											`ratings`, 
										 `associated`, 
										      `ticon`, 
											 `writes`) VALUES (NULL, 
											               '$catid', 
												             '$aid', 
									                     '$subject', 
										                      now(), 
									  	                      now(), 
												        '$hometext', 
												        '$bodytext', 
												                  0, 
												                  0, 
												           '$topic', 
												          '$author', 
												           '$notes', 
												             $ihome, 
												       '$alanguage', 
												             $acomm, 
												           $haspoll, 
												                $id, 
												                  0, 
												                  0, 
												      '$associated', 
												        '$topic_id', 
												           $writes);"; 													   
															   
		$result = $db->sql_query($new_sql);
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        $result = $db->sql_query("SELECT sid from ".$prefix."_blogs WHERE title='$subject' order by datePublished DESC limit 0,1");
       
	    [$artid] = $db->sql_fetchrow($result);
       
	    $artid = intval($artid);
        $db->sql_query("UPDATE ".$prefix."_poll_desc SET artid='$artid' WHERE pollID='$id'");
        
		if (!$result) 
	    return; 
       
		if ($uid != 1) 
		{
            $db->sql_query("UPDATE ".$user_prefix."_users SET counter=counter+1 WHERE user_id='$uid'");
            global $sitename;
			// Copyright (c) 2000-2005 by NukeScripts Network
		    if($pnt_blogs_config["notifyauth"] == 1) 
			{
                $urow = $db->sql_fetchrow($db->sql_query("SELECT username, user_email FROM ".$user_prefix."_users WHERE user_id='$uid'"));
                $Mto = $urow["user_email"];
                $Msubject = $sitename.' - '._BLOG_ARTPUB;
                $Mbody = $sitename.' - '._BLOG_HASPUB."\n$nukeurl/modules.php?name=Blogs&file=article&sid=$artid";
                $Mheaders  = "From: ".$sitename." <$adminmail>\r\n";
                $Mheaders .= "Reply-To: $adminmail\r\n";
                $Mheaders .= "Return-Path: $adminmail\r\n";
                $Mheaders .= "Organization: $sitename\r\n";
                $Mheaders .= "MIME-Version: 1.0\r\n";
                $Mheaders .= "Content-Type: text/plain\r\n";
                $Mheaders .= "Content-Transfer-Encoding: 8bit\r\n";
                $Mheaders .= "X-MSMail-Priority: High\r\n";
                $Mheaders .= "X-Mailer: Titanium Blogs          \r\n";
                @evo_mail($Mto, $Msubject, $Mbody, $Mheaders);
            }
            // Copyright (c) 2000-2005 by NukeScripts Network
            $db->sql_query("UPDATE ".$user_prefix."_users SET counter=counter+1 WHERE user_id='$uid'");
        }
        $db->sql_query("UPDATE ".$prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
	    blog_ultramode(); 
        
		deleteBlog($qid);
    }
}

function editBlog($sid) 
{
    $sel = null;
    global $user, $admin_file, $bgcolor1, $bgcolor2, $aid, $prefix, $db, $multilingual, $Version_Num, $module_name;

    $aid = substr((string) $aid, 0,25);
    $sid = intval($sid);
    
	[$aaid] = $db->sql_ufetchrow("SELECT aid FROM ".$prefix."_blogs WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr((string) $aaid, 0,25);

    if (is_mod_admin($module_name)) 
	{
        include(NUKE_BASE_DIR.'header.php');
    
        $result = $db->sql_query("SELECT catid, 
		                                 title, 
									  hometext, 
									  bodytext, 
									     topic, 
										 notes, 
										 ihome, 
									 alanguage, 
									     acomm, 
										 ticon, 
										writes, 
										   aid, 
									 informant, 
								 datePublished,
								  dateModified, 
										   sid 
	    FROM ".$prefix."_blogs 
		WHERE sid='$sid'");
		
        [$catid, $subject, $hometext, $bodytext, $topic, $notes, $ihome, $alanguage, $acomm, $topic_icon, $writes, $aid, $informant, $time, $modified, $sid] = $db->sql_fetchrow($result);
        
		$catid = intval($catid);
        $subject = stripslashes((string) $subject);
        $hometext = stripslashes((string) $hometext);
        $bodytext = stripslashes((string) $bodytext);
        $notes = stripslashes((string) $notes);
        $ihome = intval($ihome);
        $acomm = intval($acomm);
        $aid = $aid;
        $topic_icon = intval($topic_icon);
        $writes = intval($writes);
        
		$result2=$db->sql_query("SELECT topicimage from ".$prefix."_blogs_topics WHERE topicid='$topic'");
        
		[$topicimage] = $db->sql_fetchrow($result2);
        
		OpenTable();

	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\"><strong>Admin - Edit Blog Module</strong></a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";
        echo "<div align=\"center\"><span class=\"option\"><strong>"._EDITBLOGPOST."</strong></span></div>";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
        $hometext_bb = decode_bbcode(set_smilies(stripslashes(nl2br($hometext))), 1, true);
        $bodytext_bb = decode_bbcode(set_smilies(stripslashes(nl2br($bodytext))), 1, true);
        $hometext_bb = img_tag_to_resize($hometext_bb);
        $bodytext_bb = img_tag_to_resize($bodytext_bb);
        
		if($writes == 0) 
        define_once('WRITES', true);
        
		getTopics($sid);
        
		global $topicname, $topicimage, $topictext, $counter;
        
		if ($topic_icon != 0) 
        $topicimage = $topicname = $topictext = '';
        
		$informant = UsernameColor($informant);
		
		if(!isset($counter))
        $counter = 0;
		
		themearticle($aid, $informant, $time, $modified, $subject, $counter, $hometext_bb, $topic, $topicname, $topicimage, $topictext);
        
		echo "<br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postblog\">"
            ."<strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br /><br />"
            ."<strong>"._TOPIC."</strong> <select name=\"topic\">";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
        $toplist = $db->sql_query("SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER BY topictext");
        
		echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        
		while([$topicid, $topics] = $db->sql_fetchrow($toplist)) 
		{
           $topicid = intval($topicid);
           
		   if ($topicid==$topic) 
		   $sel = "selected "; 
			
		  echo "<option $sel value=\"$topicid\">$topics</option>\n";
          $sel = "";
        }
        
		echo "</select>";
        echo "<br /><br />";
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        if($Version_Num >= 6.6) 
		{
            $asql = "SELECT associated FROM ".$prefix."_blogs WHERE sid='$sid'";
            $aresult = $db->sql_query($asql);
            $arow = $db->sql_fetchrow($aresult);
            $asso_t = explode("-", (string) $arow['associated']);
        
		    echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOCIATED_BLOG_TOPICS."</strong></td><td width='100%'>"
                ."<table border='1' cellspacing='3' cellpadding='8'><tr>";
   
            $sql = "SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER BY topictext";
            $result = $db->sql_query($sql);
            $a = 0;
        
		    while ($row = $db->sql_fetchrow($result)) 
			{
                if ($a == 3) 
				{
                    echo "</tr><tr>";
                    $a = 0;
                }
                
				$checked = '';
                
				for ($i=0; $i<count($asso_t); $i++) 
				{
                    if ($asso_t[$i] == $row["topicid"]) 
					{
                        $checked = "CHECKED";
                        break;
                    }
                }
                echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."' $checked>".$row["topictext"]."</td>";
                $checked = "";
                $a++;
            }
            
			echo "</tr></table></td></tr></table><br /><br />";
        }
        // Copyright (c) 2000-2005 by NukeScripts Network
        $cat = $catid;
        SelectBlogCategory($cat);
        echo '<br />';
        topicicon($topic_icon);
        echo '<br />';
        writes($writes);
        echo "<br />";
        puthome($ihome, $acomm);

        if ($multilingual == 1) 
		{
            echo "<br /><strong>"._LANGUAGE.": </strong>"
                ."<select name=\"alanguage\">";
   
            $languages = lang_list();
   
            echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
        
		    for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) 
			{
                if ($languages[$i] != '') 
                echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
            }
            
			echo '</select>';
        } 
		else 
        echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";

        echo "<br /><br /><strong>"._BLOG_TEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postblog');
    echo "<strong>"._EXTENDED_BLOG_TEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postblog');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
 
        echo "<span class=\"content\">"._AREYOUSURE."</span><br /><br />"
            ."<strong>"._NOTES."</strong><br />"
            ."<textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\">$notes</textarea><br /><br />"
            ."<input type=\"hidden\" NAME=\"sid\" size=\"50\" value=\"$sid\">"
            ."<input type=\"hidden\" name=\"op\" value=\"ChangeBlog\">"
            ."<input type=\"submit\" value=\""._SAVECHANGES."\">"
            ."</form>";
        CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');
        
        OpenTable();
        
		echo "<div align=\"center\"><span class=\"title\"><strong>"._BLOG_ADMIN."</strong></span></div><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

        echo "<div align=\"center\"><strong>"._NOTAUTHORIZED_EDIT1."</strong></div><br /><br />"
            .""._NOTAUTHORIZED_EDIT2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    }
}

function removeBlog($sid, $ok=0) 
{
    global $ultramode, $aid, $prefix, $db, $admin_file, $module_name;
    
	$sid = intval($sid);
    $aid = substr((string) $aid, 0,25);
    
	[$aaid] = $db->sql_ufetchrow("SELECT aid from ".$prefix."_blogs WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr((string) $aaid, 0,25);

    if (is_mod_admin($module_name)) 
	{
        if($ok) 
		{
			[$counter] = $db->sql_ufetchrow("SELECT counter from ".$prefix."_authors WHERE aid='$aaid'", SQL_NUM);
            $counter--;
    
	        $db->sql_query("DELETE FROM ".$prefix."_blogs WHERE sid='$sid'");
            $db->sql_query("DELETE FROM ".$prefix."_blogs_comments WHERE sid='$sid'");
            $db->sql_query("UPDATE ".$prefix."_poll_desc SET artid='0' where artid='$sid'");
           
		    $result = $db->sql_query("UPDATE ".$prefix."_authors SET counter='$counter' WHERE aid='$aaid'");
        
		    if ($ultramode) 
            blog_ultramode();

            redirect("modules.php?name=Blogs");
        } 
		else 
		{
            include(NUKE_BASE_DIR.'header.php');
        
            OpenTable();
	
	        echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog&amp;sid=$sid\"><strong>Back To Current Blog</strong></a></div>";
	        echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

            echo "<div align=\"center\"><strong>"._REMOVESTORY." $sid "._ANDCOMMENTS."</strong>";
           	echo "<br /><br />[ <a href=\"".$admin_file.".php?op=adminBlog\">"._NO."</a> | <a href=\"".$admin_file.".php?op=RemoveBlog&amp;sid=$sid&amp;ok=1\">"._YES."</a> ]</div>";
    
	        CloseTable();

            include(NUKE_BASE_DIR.'footer.php');
        }
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');

        OpenTable();
        
		echo "<div align=\"center\"><span class=\"title\"><strong>"._BLOG_ADMIN."</strong></span></div><br /><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminBlog\">" . _BLOGS_ADMIN_HEADER . "</a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";
        echo "<div align=\"center\"><strong>"._NOTAUTHORIZED_EDIT1."</strong></div><br /><br />"
            .""._NOTAUTHORIZED_EDIT2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		@include(NUKE_BASE_DIR.'footer.php');
    }
}

function changeBlog($sid, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $assotop) 
{

    $version_Num = null;
    $associated = null;
    global $aid, $ultramode, $prefix, $db, $Version_Num, $admin_file, $module_name;
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($version_Num >= 6.6) 
	{ 
	  for ($i=0; $i<(is_countable($assotop) ? count($assotop) : 0); $i++) 
      $associated .= "$assotop[$i]-"; 
	}
    // Copyright (c) 2000-2005 by NukeScripts Network
    
	$sid = intval($sid);
    $aid = substr((string) $aid, 0,25);
    
	[$aaid] = $db->sql_ufetchrow("SELECT aid from ".$prefix."_blogs WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr((string) $aaid, 0,25);
    
	if (is_mod_admin($module_name)) 
	{
        $subject = Fix_Quotes($subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        $topic = (empty($topic)) ? '1' : $topic;
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        $db->sql_query("UPDATE ".$prefix."_blogs SET catid='$catid', 
		                                             title='$subject', 
												 hometext='$hometext', 
												 bodytext='$bodytext', 
												       topic='$topic', 
													   notes='$notes', 
													   ihome='$ihome', 
											   alanguage='$alanguage', 
											           acomm='$acomm', 
												  ticon='$topic_icon', 
												     writes='$writes' 
												
												    WHERE sid='$sid'");
        
		$db->sql_query("UPDATE ".$prefix."_blogs SET associated='$associated' WHERE sid='$sid'");
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        if ($ultramode) { blog_ultramode(); }
        redirect($admin_file.".php?op=adminBlog");
    }
}

function lastTwentyBlogs()
{
    global $prefix, $db, $language, $multilingual, $Version_Num, $admin_file, $aid, $module_name, $bgcolor1;

    include(NUKE_BASE_DIR.'header.php');
/*****[BEGIN]******************************************
 [ Other:    Blogs Fix                          v1.0.0 ]
 ******************************************************/
    OpenTable();    
    
	echo "<div align=\"center\"><strong>Admin "._LAST." 100 "._BLOGS."</strong></div>";
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=adminBlog\"><strong>Add New Blog</strong></a></div><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";
    
	$result6 = $db->sql_query("SELECT sid, 
	                                  aid, 
									title, 
							datePublished, 
							 dateModified, 
							        topic, 
								informant, 
								alanguage 
							   
							   FROM ".$prefix."_blogs 
							   
							   ORDER BY datePublished DESC LIMIT 0,100");
    
	echo "<div align=\"center\"><table border=\"1\" width=\"100%\">";
    
	while ($row6 = $db->sql_fetchrow($result6)) 
	{
        $sid = intval($row6["sid"]);
        $aid = $row6["aid"];
        $said = substr("$aid", 0,25);
        $title = $row6["title"];
        
		$time = $row6["datePublished"];
		$modified = $row6["dateModified"];
        
		$topic = $row6["topic"];
        $informant = $row6["informant"];
        $alanguage = $row6["alanguage"];
        $row7 = $db->sql_fetchrow($db->sql_query("SELECT topicname FROM ".$prefix."_blogs_topics WHERE topicid='$topic'"));
        $topicname = $row7["topicname"];
    
	    if (empty($alanguage)) 
        $alanguage = ""._ALL."";
        
		formatTimestamp($time);
        
		echo "<tr><td class=\"catHead\" align=\"right\"><strong>$sid</strong>" 
            ."</td><td class=\"row1\" width=\"65.3%\" align=\"left\" width=\"100%\"><img class=\"icons\" align=\"absmiddle\" width=\"16\" src=\"".img('topic-16.png','Blog_Topics')."\"> <a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid\">$title</a>"
            ."</td><td class=\"catHead\" align=\"center\">$alanguage"
            ."</td><td class=\"row1\" align=\"right\">$topicname";
        
		if (is_mod_admin('Blog')) 
		{
            if ($aid == $said) 
			{
                echo "</td><td class=\"catHead\" width=\"5.3%\" align=\"right\" nowrap>(<a href=\"".$admin_file.".php?op=EditBlog&amp;sid=$sid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=RemoveBlog&amp;sid=$sid\">"._DELETE."</a>)"
                     ."</td></tr>";
            } 
			else 
			{
                echo "</td><td align=\"right\" nowrap><span class=\"content\"><i>("._NOFUNCTIONS.")</i></span>"
                    ."</td></tr>";
            }
        } 
		else 
        echo "</td></tr>";
    }

    echo "</table></div>";

    if (is_mod_admin($module_name)) 
	{
      echo "<br /><div align=\"center\">"
          ."<form action=\"".$admin_file.".php\" method=\"post\">"
          .""._STORYID.": <input type=\"text\" NAME=\"sid\" SIZE=\"10\">"
          ."<select name=\"op\">"
          ."<option value=\"EditBlog\" SELECTED>"._EDIT."</option>"
          ."<option value=\"RemoveBlog\">"._DELETE."</option>"
          ."</select>"
          ."<input type=\"submit\" value=\""._GO."\">"
          ."</form></div><br />";
    }
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function programmedBlogs()
{
    global $prefix, $db, $language, $multilingual, $Version_Num, $admin_file, $aid, $module_name, $bgcolor1;
    include(NUKE_BASE_DIR.'header.php');

    if (!empty($admlanguage)) 
    $queryalang = "WHERE alanguage='$admlanguage' ";
	else 
    $queryalang = "";

    if (is_active("Blog")) 
    {
        OpenTable();

        echo "<div align=\"center\"><strong>"._AUTOMATEDARTICLES."</strong></div><br />";
        
		$count = 0;
        $result5 = $db->sql_query("SELECT anid, 
		                                   aid, 
										 title, 
								 datePublished, 
									 alanguage 
									 
									FROM ".$prefix."_blogs_autoblog $queryalang ORDER BY datePublished ASC");

        while ([$anid, $aid, $listtitle, $time, $alanguage] = $db->sql_fetchrow($result5)) 
		{
            $anid = intval($anid);
            $said = substr((string) $aid, 0,25);
            $title = $listtitle;
        
		    if (empty($alanguage)) 
            $alanguage = ""._ALL."";
            
			if (!empty($anid)) 
			{
                if ($count == 0) 
				{
                    echo "<table border=\"1\" width=\"100%\">";
                    $count = 1;
                }

				$time = str_replace(" ", "@", (string) $time);

				if (is_mod_admin('Blog')) 
				{
                    if ($aid == $said) 
                        echo "<tr><td nowrap>&nbsp;(<a href=\"".$admin_file.".php?op=autoEditBlog&amp;anid=$anid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=autoDeleteBlog&amp;anid=$anid\">"._DELETE."</a>)&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; 
					/* Multilingual Code : added column to display language */
					else 
                        echo "<tr><td>&nbsp;("._NOFUNCTIONS.")&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; 
				   /* Multilingual Code : added column to display language */
                } 
				else 
                    echo "<tr><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
            }
        }
        
		if ((empty($anid)) AND ($count == 0)) 
        echo "<center><i>"._NOAUTOARTICLES."</i></center>";
        
		if ($count == 1) 
        echo "</table>";
        
		CloseTable();
    }

    include(NUKE_BASE_DIR.'footer.php');
}


function adminBlog() 
{
    $topic = null;
    $sel = null;
    $alanguage = null;
    global $prefix, $db, $language, $multilingual, $Version_Num, $admin_file, $aid, $module_name, $bgcolor1;

    include(NUKE_BASE_DIR.'header.php');

    if (!empty($admlanguage)) 
    $queryalang = "WHERE alanguage='$admlanguage' ";
	else 
    $queryalang = "";

/*****[END]********************************************
 [ Other:    Blog Fix                          v1.0.0 ]
 ******************************************************/
    $today = getdate();
    $tday = $today['mday'];

    if ($tday < 10)
	{ 
	$tday = "0$tday"; 
	}
    
	$tmonth = $today['month'];
    $ttmon = $today['mon'];
    
	if ($ttmon < 10)
	{ 
	$ttmon = "0$ttmon"; 
	}
    
	$tyear = $today['year'];
    $thour = $today['hours'];
    
	if ($thour < 10)
	$thour = "0$thour"; 
    
	$tmin = $today['minutes'];
    
	if ($tmin < 10)
	$tmin = "0$tmin"; 
    
	$tsec = $today['seconds'];
    
	if ($tsec < 10)
	$tsec = "0$tsec"; 
    
	$date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";

    OpenTable();
/*****[BEGIN]******************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
        echo "<div align=\"center\"><span class=\"option\"><strong>"._ADD_BLOG."</strong></span></div><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postblog\">"
            ."<strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\"><br /><br />"
            ."<strong>"._TOPIC."</strong> ";
/*****[END]********************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
    $toplist = $db->sql_query("SELECT topicid, topictext from ".$prefix."_blogs_topics ORDER by topictext");
    
	echo "<select name=\"topic\">";
    echo "<option value=\"\">"._SELECT_BLOG_TOPIC."</option>\n";
    
	while([$topicid, $topics] = $db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
        
		if ($topicid == $topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$topics</option>\n";
        
		$sel = "";
    }
    echo "</select><br /><br />";
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_Num >= 6.6) 
	{
        echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOCIATED_BLOG_TOPICS."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";
        $sql = "SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER BY topictext";
        $result = $db->sql_query($sql);
        $a = 0;
    
	    while ($row = $db->sql_fetchrow($result)) 
		{
            if ($a == 3) 
			{
                echo "</tr><tr>";
                $a = 0;
            }
            # updated 10/15/2022 1:10pm TheGhost - this is where i set the spaces between the check boxws and also the topics
			echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."'>&nbsp;&nbsp;".$row["topictext"]."&nbsp;&nbsp;</td>";
            $a++;
        }
        
		echo "</tr></table></td></tr></table><br /><br />";
    }
    // Copyright (c) 2000-2005 by NukeScripts Network

    $cat = 0;
    SelectBlogCategory($cat);
    echo "<br />";
    topicicon('');
    echo '<br />';
    writes('');
    echo '<br />';
    puthome('', '');

    if ($multilingual == 1) 
	{
        echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"alanguage\">";

        $languages = lang_list();

        echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) 
		{
            if ($languages[$i] != '') 
            echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
        }

        echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\">";

    echo "<br /><br /><strong>"._BLOG_TEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', '', 'postblog');
    echo "<strong>"._EXTENDED_BLOG_TEXT."</strong>";
    Make_TextArea('bodytext', '', 'postblog');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/

    echo "<span class=\"content\">"._ARESUREURL."</span>"
        ."<br /><br /><strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
        ."<input type=radio name=automated value=1>"._YES." &nbsp;&nbsp;"
        ."<input type=radio name=automated value=0 checked>"._NO."<br /><br />"
        .""._NOWIS.": $date<br /><br />";

    $day = 1;

    echo ""._DAY.": <select name=\"day\">";

    while ($day <= 31) 
	{
        if ($tday==$day) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"day\" $sel>$day</option>";
        $day++;
    }

    echo "</select>";

    $month = 1;
    
	echo ""._UMONTH.": <select name=\"month\">";
    
	while ($month <= 12) 
	{
        if ($ttmon==$month) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"month\" $sel>$month</option>";
        $month++;
    }

    echo "</select>";
    
	$date = getdate();
    $year = $date['year'];
    
	echo _YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">"
        ."<br />"._HOUR.": <select name=\"hour\">";

    $hour = 0;
    $cero = "0";
    
	while ($hour <= 23) 
	{
        $dummy = $hour;
    
	    if ($hour < 10) 
        $hour = "$cero$hour";
        
		echo "<option name=\"hour\">$hour</option>";

        $hour = $dummy;
        $hour++;
    }
    
	echo "</select>"
        .": <select name=\"min\">";

    $min = 0;
    
	while ($min <= 59) 
	{
        if (($min == 0) OR ($min == 5)) 
        $min = "0$min";
        
		echo "<option name=\"min\">$min</option>";
        $min = $min + 5;
    }
    
	echo "</select>";

    echo ": 00<br /><br />"
        ."<select name=\"op\">"
        ."<option value=\"PreviewAdminBlog\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostAdminBlog\">"._POSTSTORY."</option>"
        ."</select>"
        ."<input type=\"submit\" value=\""._OK."\">";

    CloseTable();

    putpoll('', '');

    echo "</form>";

    include(NUKE_BASE_DIR.'footer.php');
}

function previewAdminBlog($automated, 
                                $year, 
								 $day, 
							   $month, 
							    $hour, 
								 $min, 
							 $subject, 
							$hometext, 
							$bodytext, 
							   $topic, 
							   $catid, 
							   $ihome, 
						   $alanguage, 
						       $acomm, 
						  $topic_icon, 
						      $writes, 
						   $pollTitle, 
						  $optionText, 
						     $assotop) 
{
    $sid = null;
    $informant = null;
    $aid = null;
    $time = null;
    $modified = null;
    $counter = null;
    $sel = null;
    $Version_num = null;
    $associated = null;
    $a = null;
    $checked = null;
    $language = null;
    global $user, $admin_file, $bgcolor1, $bgcolor2, $prefix, $db, $alanguage, $multilingual, $Version_Num;
    
	include(NUKE_BASE_DIR.'header.php');

    if ($topic<1) 
    $topic = 1;
    
    $today = getdate();
    $tday = $today['mday'];

    if ($tday < 10)
	{ 
	$tday = "0$tday"; 
	}
    
	$tmonth = $today['month'];
    $tyear = $today['year'];
    $thour = $today['hours'];
    
	if ($thour < 10)
	$thour = "0$thour"; 
    
	$tmin = $today['minutes'];
    
	if ($tmin < 10)
	$tmin = "0$tmin"; 
    
	$tsec = $today['seconds'];
    
	if ($tsec < 10)
	$tsec = "0$tsec"; 
    
	$date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    
	OpenTable();

	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=adminBlog\"><strong>Preview Currrent Blog<strong></a></div>\n";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div>";

    echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"postblog\">"
        ."<input type=\"hidden\" name=\"catid\" value=\"$catid\">";

    $subject = stripslashes((string) $subject);
    $subject = str_replace("\"", "''", $subject);
    $hometext = stripslashes((string) $hometext);
    $bodytext = stripslashes((string) $bodytext);
    $result=$db->sql_query("select topicimage, topicname, topictext  from ".$prefix."_blogs_topics where topicid='$topic'");

    [$topicimage, $topicname, $topictext] = $db->sql_fetchrow($result);

/*****[BEGIN]******************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
    $hometext_bb = decode_bbcode(set_smilies(stripslashes($hometext)), 1, true);
    $bodytext_bb = decode_bbcode(set_smilies(stripslashes($bodytext)), 1, true);
/*****[END]********************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/

    $hometext_bb = img_tag_to_resize($hometext_bb);
    $bodytext_bb = img_tag_to_resize($bodytext_bb);

    if($writes == 0) 
    define_once('WRITES', true);

    getTopics($sid);
    
	if ($topic_icon != 0) 
    $topicimage = $topicname = $topictext = '';

    $informant = UsernameColor($informant);
    
	themearticle($aid, $informant, $time, $modified, $subject, $counter, $hometext_bb, $topic, $topicname, $topicimage, $topictext);
    
	echo "<br /><br /><strong>"._TITLE."</strong><br />"
        ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br /><br />"
        ."<strong>"._TOPIC."</strong><select name=\"topic\">";
    
	$toplist = $db->sql_query("SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER by topictext");
    
	echo "<option value=\"\">"._ALLTOPICS."</option>\n";
    
	while([$topicid, $topics] = $db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
    
	    if ($topicid==$topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$topics</option>\n";
        $sel = "";
    }

    echo "</select><br /><br />";
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_num >= 6.6) 
	{
        for ($i=0; $i<(is_countable($assotop) ? count($assotop) : 0); $i++) 
		{ 
		  $associated .= "$assotop[$i]-"; 
		}
        
		$asso_t = explode("-", $associated);
        
		echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOCIATED_BLOG_TOPICS."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";

        $sql = "SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER BY topictext";
        $result = $db->sql_query($sql);
        
		while ($row = $db->sql_fetchrow($result)) 
		{
            if ($a == 3) 
			{
                echo "</tr><tr>";
                $a = 0;
            }
            
			for ($i=0; $i<count($asso_t); $i++) 
			{
                if ($asso_t[$i] == $row["topicid"]) 
				{
                    $checked = "CHECKED";
                    break;
                }
            }
            
			echo "<td><input type='checkbox' name='assotop[]' value='".intval($row["topicid"])."' $checked>".$row["topictext"]."</td>"; 
            $checked = "";
            $a++;
        }
        
		echo "</tr></table></td></tr></table><br /><br />";
    }
    // Copyright (c) 2000-2005 by NukeScripts Network
    $cat = $catid;
    SelectBlogCategory($cat);
    echo '<br />';
    topicicon($topic_icon);
    echo '<br />';
    writes($writes);
    echo "<br />";
    puthome($ihome, $acomm);

    if ($multilingual == 1) 
	{
        echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"alanguage\">";
    
	    $languages = lang_list();
    
	    echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) 
		{
            if ($languages[$i] != '') 
            echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
        }
        
		echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\">";

    echo "<br /><br /><strong>"._BLOG_TEXT."</strong>";


/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postblog');
    echo "<strong>"._EXTENDED_BLOG_TEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postblog');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/

    if ($automated == 1) 
	{
        $sel1 = "checked";
        $sel2 = "";
    } 
	else 
	{
        $sel1 = "";
        $sel2 = "checked";
    }
    
	echo "<br /><strong>"._PROGRAMSTORY."</strong>&nbsp;&nbsp;"
        ."<input type=\"radio\" name=\"automated\" value=\"1\" $sel1>"._YES." &nbsp;&nbsp;"
        ."<input type=\"radio\" name=\"automated\" value=\"0\" $sel2>"._NO."<br /><br />"
        .""._NOWIS.": $date<br /><br />";
    
	$xday = 1;
    
	echo ""._DAY.": <select name=\"day\">";
    
	while ($xday <= 31) 
	{
        if ($xday == $day) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"day\" $sel>$xday</option>";
        $xday++;
    }
    
	echo "</select>";
    
	$xmonth = 1;
    
	echo ""._UMONTH.": <select name=\"month\">";
    
	while ($xmonth <= 12) 
	{
        if ($xmonth == $month) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"month\" $sel>$xmonth</option>";
        $xmonth++;
    }
    
	echo "</select>";
    echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">";
    echo "<br />"._HOUR.": <select name=\"hour\">";
    
	$xhour = 0;
    $cero = "0";
    
	while ($xhour <= 23) 
	{
        $dummy = $xhour;
    
	    if ($xhour < 10) 
        $xhour = "$cero$xhour";
        
		if ($xhour == $hour) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"hour\" $sel>$xhour</option>";
        
		$xhour = $dummy;
        $xhour++;
    }

    echo "</select>";
    echo ": <select name=\"min\">";

    $xmin = 0;
    
	while ($xmin <= 59) 
	{
        if (($xmin == 0) OR ($xmin == 5)) 
        $xmin = "0$xmin";
        
		if ($xmin == $min) 
        $sel = "selected";
		else 
        $sel = "";
        
		echo "<option name=\"min\" $sel>$xmin</option>";
        $xmin = $xmin + 5;
    }

    echo "</select>";

    echo ": 00<br /><br />"
        ."<select name=\"op\">"
        ."<option value=\"PreviewAdminBlog\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostAdminBlog\">"._POSTSTORY."</option>"
        ."</select>"
        ."<input type=\"submit\" value=\""._OK."\">";

    CloseTable();

    putpoll($pollTitle, $optionText);

    echo "</form>";
    include(NUKE_BASE_DIR.'footer.php');
}

function postAdminBlog($automated, 
                             $year, 
							  $day, 
							$month, 
							 $hour, 
							  $min, 
						  $subject, 
						 $hometext, 
						 $bodytext, 
						    $topic, 
							$catid, 
							$ihome, 
						$alanguage, 
						    $acomm, 
					   $topic_icon, 
					       $writes, 
						$pollTitle, 
					   $optionText, 
					      $assotop) 
{
    $associated = null;
    $notes = null;
    global $ultramode, $aid, $prefix, $db, $Version_Num, $admin_file;
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_Num >= 6.6) 
	{ 
	  if (is_countable($assotop) && count($assotop) > 0):
	    for ($i=0; $i<count($assotop); $i++): 
	      $associated .= "$assotop[$i]-"; 
	    endfor; 
	  endif;
	}

    // Copyright (c) 2000-2005 by NukeScripts Network
	if ($automated == 1) 
	{
        if ($day < 10) 
        $day = "0$day";
        
		if ($month < 10) 
        $month = "0$month";
        
		$sec = "00";
        
		$date = "$year-$month-$day $hour:$min:$sec";
		$modified = "$year-$month-$day $hour:$min:$sec";
        
		$notes = "";
        $author = $aid;
        $subject = Fix_Quotes($subject);
        $subject = str_replace("\"", "''", (string) $subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        $new_sql  = "INSERT INTO ".$prefix."_blogs_autoblog values (NULL, 
		                                                   '$catid', 
														     '$aid', 
													     '$subject', 
														    '$date',
														'$modified', 
													    '$hometext', 
														'$bodytext', 
														   '$topic', 
														  '$author', 
														   '$notes', 
														   '$ihome', 
													   '$alanguage', 
													       '$acomm', 
													  '$associated', 
													  '$topic_icon', 
													      '$writes')";
        $result = $db->sql_query($new_sql);
        // Copyright (c) 2000-2005 by NukeScripts Network

        if (!$result) 
	    exit(); 
        
		$result = $db->sql_query("UPDATE ".$prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
        blog_ultramode();
        
		redirect($admin_file.".php?op=adminBlog");
    } 
	else 
	{
        $subject  = Fix_Quotes($subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
    
	    if ((!empty($pollTitle)) AND (!empty($optionText[1])) AND (!empty($optionText[2]))) 
		{
            $haspoll = 1;
            $timeStamp = time();
            $pollTitle = Fix_Quotes($pollTitle);

            if(!$db->sql_query("INSERT INTO ".$prefix."_poll_desc VALUES (NULL, '$pollTitle', 
			                                                                    '$timeStamp', 
																				         '0', 
																				'$alanguage', 
																				         '0')")) 
                                                                                  return;
            
			$object = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
            
			$id = $object["pollID"];
            $id = intval($id);
            
			for($i = 1, $maxi = is_countable($optionText) ? count($optionText) : 0; $i <= $maxi; $i++) 
			{
                if(!empty($optionText[$i])) 
                $optionText[$i] = Fix_Quotes($optionText[$i]);
                
				if(!$db->sql_query("INSERT INTO ".$prefix."_poll_data (pollID, 
				                                                   optionText, 
																  optionCount, 
																       voteID) 
																	    
												  VALUES 
															('$id', 
												 '$optionText[$i]', 
												               '0', 
															  '$i')")) 
                                                  return;
            }
        } 
		else 
		{
            $haspoll = 0;
            $id = 0;
        }
        
		
		// Copyright (c) 2000-2005 by NukeScripts Network 
        $new_sql  = "INSERT INTO ".$prefix."_blogs values (NULL, 
		                                                 '$catid', 
														   '$aid', 
													   '$subject', 
													        now(),
														    now(),		 
													  '$hometext', 
													  '$bodytext', 
													          '0', 
															  '0', 
														 '$topic', 
														   '$aid', 
														 '$notes', 
														 '$ihome', 
													 '$alanguage', 
													     '$acomm', 
													   '$haspoll', 
													        '$id', 
															  '0', 
															  '0', 
													'$associated', 
													'$topic_icon', 
													    '$writes')";
        $result = $db->sql_query($new_sql);
		
        // Copyright (c) 2000-2005 by NukeScripts Network

        $result = $db->sql_query("SELECT sid from ".$prefix."_blogs WHERE title='$subject' ORDER by datePublished DESC limit 0,1");
        
		[$artid] = $db->sql_fetchrow($result);
        
		$artid = intval($artid);
        
		$db->sql_query("UPDATE ".$prefix."_poll_desc SET artid='$artid' WHERE pollID='$id'");
       
	    if (!$result) 
        exit();
        
		$result = $db->sql_query("UPDATE ".$prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
        blog_ultramode();
        
		redirect($admin_file.".php?op=adminBlog");
    }
}

function blog_submissions() 
{
    global $admin, $admin_file, $bgcolor1, $bgcolor2, $prefix, $db, $anonymous, $multilingual, $module_name;

    $dummy = 0;

    include(NUKE_BASE_DIR.'header.php');

    OpenTable();

	echo "<div align=\"center\"><a href=\"$admin_file.php?op=submissions\"><strong>Blog Submissions</strong></a></div>"; 
	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

    $result = $db->sql_query("SELECT qid, uid, uname, subject, timestamp, alanguage FROM ".$prefix."_blogs_queue order by timestamp DESC");
        
		if($db->sql_numrows($result) == 0) 
            echo "<table width=\"100%\"><tr><td align=\"center\"><strong>"._NO_BLOG_SUBMISSIONS."</strong></td></tr></table>\n";
		else 
		{
            echo "<center><span class=\"content\"><strong>"._NEW_BLOG_SUBMISSIONS."</strong></span><form action=\"".$admin_file.".php\" method=\"post\"><table width=\"100%\" border=\"1\" bgcolor=\"$bgcolor2\"><tr><td><strong>&nbsp;"._TITLE."&nbsp;</strong></td>";
        
		    if ($multilingual == 1) 
            echo "<td><center><strong>&nbsp;"._LANGUAGE."&nbsp;</strong></center></td>";

            echo "<td><center><strong>&nbsp;"._AUTHOR."&nbsp;</strong></center></td><td><center><strong>&nbsp;"._DATE."&nbsp;</strong></center></td><td><center><strong>&nbsp;"._FUNCTIONS."&nbsp;</strong></center></td></tr>\n";
            
			while ([$qid, $uid, $uname, $subject, $timestamp, $alanguage] = $db->sql_fetchrow($result)) 
			{
                $qid = intval($qid);
                $uid = intval($uid);
                /*
                $hour = "AM";
                preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $timestamp, $datetime);
                if ($datetime[4] > 12) { $datetime[4] = $datetime[4]-12; $hour = "PM"; }
                $datetime = date(""._DATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
                */
                echo "<tr>\n";
                echo "<td width=\"100%\"><span class=\"content\">\n";
            
			    if (empty($subject)) 
                echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayBlog&amp;qid=$qid\">"._NOSUBJECT."</a></span>\n";
				else 
                echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayBlog&amp;qid=$qid\">$subject</a></span>\n";
                
				if ($multilingual == 1) 
				{
                   if (empty($alanguage)) 
                   $alanguage = _ALL;
                  
				   echo "</td><td align=\"center\"><font size=\"2\">&nbsp;$alanguage&nbsp;</font>\n";
                }
                
				if ($uname != $anonymous) 
				{
                  $uname_color = UsernameColor($uname);
                  echo "</td><td align=\"center\" nowrap><font size=\"2\">&nbsp;<a href='modules.php?name=Your_Account&op=userinfo&username=$uname'>$uname_color</a>&nbsp;</font>\n";
                } 
				else 
                echo "</td><td align=\"center\" nowrap><font size=\"2\">&nbsp;$uname&nbsp;</font>\n";
                
				$timestamp = explode(" ", (string) $timestamp);
                echo "</td><td align=\"right\" nowrap><span class=\"content\">&nbsp;$timestamp[0]&nbsp;</span></td><td align=\"center\"><font class=\"content\">&nbsp;<a href=\"".$admin_file.".php?op=DeleteBlog&amp;qid=$qid\">"._DELETE."</a>&nbsp;</td></tr>\n";
                $dummy++;
            }
            
			if ($dummy < 1) 
            echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\"><strong>"._NO_BLOG_SUBMISSIONS."</strong></form></td></tr></table>\n";
			else 
            echo "</table></form>\n";
        }
       
	      if (is_mod_admin($module_name)) 
		  {
             echo "<br /><center>"
            ."[ <a href=\"".$admin_file.".php?op=subdelete\">"._DELETE."</a> ]"
            ."</center><br />";
    }
    
	CloseTable();

    include(NUKE_BASE_DIR.'footer.php');
}

function blog_subdelete() 
{
    global $prefix, $db, $admin_file, $cache;
    $db->sql_query("delete from ".$prefix."_blogs_queue");

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaits', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

    redirect($admin_file.".php?op=adminBlog");
}

switch($op) 
{
    # Written by Ernest Allen Buffington 08/27/2019	
	case "LastTwentyBlogs":
	lastTwentyBlogs();
	break;
	# Written by Ernest Allen Buffington 08/27/2019	
	
	# Written by Ernest Allen Buffington 08/27/2019	
    case "ProgrammedBlogs":
	programmedBlogs();
	break;
	# Written by Ernest Allen Buffington 08/27/2019	
	
    case "EditBlogCategory":
    EditBlogCategory($catid);
    break;

    case "subdelete":
    blog_subdelete();
    break;

    case "DelCategory":
    DelCategory($cat);
    break;

    case "YesDelBlogCategory":
    YesDelBlogCategory($catid);
    break;

    case "NoMoveBlogCategory":
    NoMoveBlogCategory($catid, $newcat);
    break;

    case "SaveEditBlogCategory":
    SaveEditBlogCategory($catid, $title);
    break;

    case "SelectBlogCategory":
    SelectBlogCategory($cat);
    break;

    case "AddBlogCategory":
    AddBlogCategory();
    break;

    case "SaveBlogCategory":
    SaveBlogCategory($title);
    break;

    case "DisplayBlog":
    displayBlog($qid);
    break;

    case "PreviewBlogAgain":
	if(!isset($assotop))
	$assotop = '';
    previewBlog($automated, 
	                  $year, 
					   $day, 
					 $month, 
					  $hour, 
					   $min, 
					   $qid, 
					   $uid, 
					$author, 
				   $subject, 
				  $hometext, 
				  $bodytext, 
				     $topic, 
					 $notes, 
					 $catid, 
					 $ihome, 
				 $alanguage, 
				     $acomm, 
			    $topic_icon, 
				    $writes, 
				 $pollTitle, 
				$optionText, 
				   $assotop);
    break;

    case "PostBlog":
//postAdminBlog($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $pollTitle, $optionText, $assotop);
      postStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $pollTitle, $optionText, $assotop); 
	break;

    case "EditBlog":
    editBlog($sid);
    break;

    case "RemoveBlog":
	if(!isset($ok))
	$ok = '';
    removeBlog($sid, $ok);
    break;

    case "ChangeBlog":
    changeBlog($sid, 
	        $subject, 
		   $hometext, 
		   $bodytext, 
		      $topic, 
			  $notes, 
			  $catid, 
			  $ihome, 
		  $alanguage, 
		      $acomm, 
		 $topic_icon, 
		     $writes, 
			$assotop);
    break;

    case "DeleteBlog":
    deleteBlog($qid);
    break;

    case "adminBlog":
    adminBlog();
    break;

    case "PreviewAdminBlog":
	if(!isset($assotop))
	$assotop = '';
    previewAdminBlog($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $pollTitle, $optionText, $assotop);
    break;

    case "PostAdminBlog":
    postAdminBlog($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $pollTitle, $optionText, $assotop);
    break;

    case "autoDeleteBlog":
    autodeleteblog($anid);
    break;

    case "autoEditBlog":
    autoEditBlog($anid);
    break;

    case "autoSaveEditBlog":
    autoSaveEditBlog($anid, $year, $day, $month, $hour, $min, $title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes);
    break;

    case "submissions":
    blog_submissions();
    break;

    case "BlogsConfig":
        $pagetitle = ": "._BLOGS_CONFIG;
        
		include(NUKE_BASE_DIR.'header.php');
        
        $pnt_blogs_config = get_blog_configs();

        OpenTable();
	    
		echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=BlogsConfig\"><strong>Blogs Main Configuration</strong></a></div>";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BLOGS_RETURNMAIN . "</a> ]</div><br />";

        echo "<form action='".$admin_file.".php?op=BlogsConfigSave' method='post'>\n";
        echo "<center>\n<table border='0' cellpadding='2' cellspacing='2'>\n";

        echo "<tr>\n<td align='right'><strong>"._BLOG_DISPLAYTYPE.":</strong></td>\n<td><select name='xcolumns'>";
        
		if ($pnt_blogs_config["columns"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._BLOG_SINGLE."</option>\n<option value='1'$ck2>"._BLOG_DUAL."</option>\n</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right'><strong>"._BLOG_READLINK.":</strong></td>\n<td><select name='xreadmore'>";
        
		if ($pnt_blogs_config["readmore"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._BLOG_PAGE."</option>\n<option value='1'$ck2>"._BLOG_POPUP."</option>\n</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right'><strong>"._BLOG_TEXTTYPE.":</strong></td>\n<td><select name='xtexttype'>";
        
		if ($pnt_blogs_config["texttype"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._BLOG_COMPLETE."</option>\n<option value='1'$ck2>"._BLOG_TRUNCATE."</option>\n</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right' valign='top'><strong>"._BLOG_NOTIFYAUTH.":</strong></td>\n<td><select name='xnotifyauth'>";
        
		if ($pnt_blogs_config["notifyauth"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._BLOG_NO."</option>\n<option value='1'$ck2>"._BLOG_YES."</option>\n</select><br />\n("._BLOG_NOTIFYAUTHNOTE.")</td>\n</tr>\n";

        echo "<tr>\n<td align='right'><strong>"._BLOG_HOMETOPIC.":</strong></td>\n<td><select name='xhometopic'>";
        echo "<option value='0'";
        
		if ($pnt_blogs_config["hometopic"] == 0) 
		echo " selected"; 
        
		echo ">"._BLOG_ALLTOPICS."</option>\n";
        $result = $db->sql_query("SELECT topicid, topictext FROM ".$prefix."_blogs_topics ORDER BY topictext");
        
		while([$topicid, $topicname] = $db->sql_fetchrow($result)) 
		{
            echo "<option value='$topicid'";
        
		    if ($pnt_blogs_config["hometopic"] == $topicid) 
			echo " selected"; 
            
			echo">$topicname</option>\n";
        }
        
		echo "</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right' valign='top'><strong>"._BLOG_HOMENUMBER.":</strong></td>\n<td><select name='xhomenumber'>\n";
        echo "<option value='0'";
        
		if ($pnt_blogs_config["homenumber"] == 0) 
		echo " selected"; 
        
		echo ">"._BLOG_NUKEDEFAULT."</option>\n";
        $i = 1;
        
		while ($i <= 10) 
		{
            $k = $i * 5;
        
		    echo "<option value='$k'";
        
		    if ($pnt_blogs_config["homenumber"] == $k) 
			echo " selected"; 
        
		    echo">$k "._BLOG_ARTICLES."</option>\n";
            $i++;
        }
        
		echo "</select><br />\n("._BLOG_HOMENUMNOTE.")</td>\n</tr>\n";

        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BLOG_SAVECHANGES."'></td></tr>";
        echo "</table>\n</center>\n</form>\n";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    break;

    case "BlogsConfigSave":
        blog_save_config('columns', $xcolumns);
        blog_save_config('readmore', $xreadmore);
        blog_save_config('texttype', $xtexttype);
        blog_save_config('notifyauth', $xnotifyauth);
        blog_save_config('homenumber', $xhomenumber);
        blog_save_config('hometopic', $xhometopic);

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        global $cache;
        $cache->delete('blogs', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

        redirect($admin_file.".php?op=BlogsConfig");
    break;
  }
} 
else 
DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"");
?>

