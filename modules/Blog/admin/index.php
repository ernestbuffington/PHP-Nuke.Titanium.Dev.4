<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
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
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/ 

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
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
 ************************************************************************/
if (!defined('ADMIN_FILE')) die('Access Denied');

global $titanium_prefix, $titanium_db, $admdata;

$titanium_module_name = basename(dirname(dirname(__FILE__)));

if(is_mod_admin($titanium_module_name)) 
{
  include_once(NUKE_INCLUDE_DIR.'nsnne_func.php');

  $blog_config = blog_get_configs();

/*********************************************************/
/* Story/Blogs Functions                                 */
/*********************************************************/
function topicicon($topic_icon) 
{
    echo "<br /><strong>"._DISPLAY_T_ICON."</strong>&nbsp;&nbsp;";
    
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

    echo "<br /><strong>"._ACTIVATECOMMENTS."</strong>&nbsp;&nbsp;";
    
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

function deleteStory($qid) 
{
    global $titanium_prefix, $titanium_db, $admin_file, $cache;
    $qid = intval($qid);
    $result = $titanium_db->sql_query("delete from ".$titanium_prefix."_queue where qid='$qid'");

    if (!$result) 
    return;

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaits', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

    redirect_titanium($admin_file.".php?op=submissions");
}

function SelectCategory($cat) 
{
    global $titanium_prefix, $titanium_db, $admin_file;
    $selcat = $titanium_db->sql_query("select catid, title from ".$titanium_prefix."_stories_cat order by title");
    $a = 1;
    echo "<strong>"._BLOG_POST_CATEGORY."</strong> ";
    echo "<select name=\"catid\">";

    if ($cat == 0) 
        $sel = "selected";
	else 
        $sel = "";
    
	echo "<option name=\"catid\" value=\"0\" $sel>"._ARTICLES."</option>";
    
	while(list($catid, $title) = $titanium_db->sql_fetchrow($selcat)) 
	{
        $catid = intval($catid);
    
	    if ($catid == $cat) 
            $sel = "selected";
		else 
            $sel = "";
        
		echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
        $a++;
    }
    
	echo "</select> [ <a href=\"".$admin_file.".php?op=AddCategory\">"._ADD."</a> | <a href=\"".$admin_file.".php?op=EditCategory\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=DelCategory\">"._DELETE."</a> ]";
}

function putpoll($pollTitle, $optionText) 
{
    OpenTable();

    echo "<div style=\"text-align: center\"><span class=\"title\"><strong>"._ATTACHAPOLL."</strong></span><br />"
        ."<span class=\"tiny\">"._LEAVEBLANKTONOTATTACH."</span><br />"
        ."<br /><br />"._POLLTITLE.": <input type=\"text\" name=\"pollTitle\" size=\"50\" maxlength=\"100\" value=\"$pollTitle\"><br /><br />"
        ."<font class=\"content\">"._POLLEACHFIELD."</font><br />"
        ."<table border=\"0\" style=\"margin:auto;\">";

    for($i = 1; $i <= 12; $i++)        
	{
        $optional = isset($optionText[$i]) ? $optionText[$i] : '';
    
	    echo "<tr>"
            ."<td>"._OPTION." $i:</td><td><input type=\"text\" name=\"optionText[$i]\" size=\"50\" maxlength=\"50\" value=\"".$optional."\"></td>"
            ."</tr>";
    }
    
	echo "</table>";
    echo "</div>";
    
	CloseTable();
}

function AddCategory () 
{
    global $admin_file;

    include(NUKE_BASE_DIR.'header.php');

    OpenTable();

    echo "<div align=\"center\"><span class=\"option\"><strong>"._CATEGORYADD."</strong></span><br /><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<strong>"._CATNAME.":</strong> "
        ."<input type=\"text\" name=\"title\" size=\"22\" maxlength=\"20\"> "
        ."<input type=\"hidden\" name=\"op\" value=\"SaveCategory\">"
        ."<input type=\"submit\" value=\""._SAVE."\">"
        ."</form></div>";
   
   echo '<br /><br />';

    CloseTable();

    include(NUKE_BASE_DIR.'footer.php');
}

function EditCategory($catid) 
{
    global $titanium_prefix, $titanium_db, $admin_file;

    $catid = intval($catid);
    $result = $titanium_db->sql_query("select title from ".$titanium_prefix."_stories_cat where catid='$catid'");
    
	list($title) = $titanium_db->sql_fetchrow($result);
    
	include(NUKE_BASE_DIR.'header.php');

    OpenTable();
    
	echo "<div align=\"center\"><span class=\"option\"><strong>"._EDITCATEGORY."</strong></span><br /><br />";
    
	if (!$catid) 
	{
        $selcat = $titanium_db->sql_query("select catid, title from ".$titanium_prefix."_stories_cat");
        
		echo "<form action=\"".$admin_file.".php\" method=\"post\">";
        echo "<strong>"._ASELECTCATEGORY."</strong>";
        echo "<select name=\"catid\">";
        echo "<option name=\"catid\" value=\"0\" $sel>Blogs</option>";
    
	    while(list($catid, $title) = $titanium_db->sql_fetchrow($selcat)) 
		{
            $catid = intval($catid);
            echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
        }
        
		echo "</select>";
        echo "<input type=\"hidden\" name=\"op\" value=\"EditCategory\">";
        echo "<input type=\"submit\" value=\""._EDIT."\"><br /><br />";
        echo ""._NOBLOGEDIT."";
    } 
	else 
	{
        echo "<form action=\"".$admin_file.".php\" method=\"post\">";
        echo "<strong>"._CATEGORYNAME.":</strong> ";
        echo "<input type=\"text\" name=\"title\" size=\"22\" maxlength=\"20\" value=\"$title\"> ";
        echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
        echo "<input type=\"hidden\" name=\"op\" value=\"SaveEditCategory\">";
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
    global $titanium_prefix, $titanium_db, $admin_file;

    $cat = intval($cat);
    $result = $titanium_db->sql_query("select title from ".$titanium_prefix."_stories_cat where catid='$cat'");
    list($title) = $titanium_db->sql_fetchrow($result);

    include(NUKE_BASE_DIR.'header.php');

    OpenTable();
    
	echo "<div align=\"center\"><span class=\"option\"><strong>"._DELETECATEGORY."</strong></span><br /><br />";

    if (!$cat) 
	{
        $selcat = $titanium_db->sql_query("select catid, title from ".$titanium_prefix."_stories_cat");
    
	    echo "<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<strong>"._SELECTCATDEL.": </strong>"
            ."<select name=\"cat\">";
    
	    while(list($catid, $title) = $titanium_db->sql_fetchrow($selcat)) 
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
        $result2 = $titanium_db->sql_query("select * from ".$titanium_prefix."_stories where catid='$cat'");
        $numrows = $titanium_db->sql_numrows($result2);
        
		if ($numrows == 0) 
		{
            $titanium_db->sql_query("delete from ".$titanium_prefix."_stories_cat where catid='$cat'");
            echo "<br /><br />"._CATDELETED."<br /><br />"._GOTOADMIN."";
        } 
		else 
		{
            echo "<br /><br /><strong>"._WARNING.":</strong> "._THECATEGORY." <strong>$title</strong> "._HAS." <strong>$numrows</strong> "._STORIESINSIDE."<br />"
                .""._DELCATWARNING1."<br />"
                .""._DELCATWARNING2."<br /><br />"
                .""._DELCATWARNING3."<br /><br />"
                ."<strong>[ <a href=\"".$admin_file.".php?op=YesDelCategory&amp;catid=$cat\">"._YESDEL."</a> | "
                ."<a href=\"".$admin_file.".php?op=NoMoveCategory&amp;catid=$cat\">"._NOMOVE."</a> ]</strong>";
        }
    }
    
	echo "</div>";
    
	CloseTable();
    
    include(NUKE_BASE_DIR.'footer.php');
}

function YesDelCategory($catid) 
{
    global $titanium_prefix, $titanium_db, $admin_file;

    $catid = intval($catid);
    $titanium_db->sql_query("delete from ".$titanium_prefix."_stories_cat where catid='$catid'");
    $result = $titanium_db->sql_query("select sid from ".$titanium_prefix."_stories where catid='$catid'");

    while(list($sid) = $titanium_db->sql_fetchrow($result)) 
	{
        $sid = intval($sid);
        $titanium_db->sql_query("delete from ".$titanium_prefix."_stories where catid='$catid'");
        $titanium_db->sql_query("delete from ".$titanium_prefix."_comments where sid='$sid'");
    }
    
	redirect_titanium($admin_file.".php?op=adminStory");
}

function NoMoveCategory($catid, $newcat) 
{
    global $titanium_prefix, $titanium_db, $admin_file;

    $catid = intval($catid);
    $result = $titanium_db->sql_query("select title from ".$titanium_prefix."_stories_cat where catid='$catid'");

    list($title) = $titanium_db->sql_fetchrow($result);

    include(NUKE_BASE_DIR.'header.php');

    echo "<div align=\"center\"> enter><span class=\"option\"><strong>"._MOVESTORIES."</strong></span></div><br /><br />";

    if (!$newcat) 
	{
        echo ""._ALLSTORIES." <strong>$title</strong> "._WILLBEMOVED."<br /><br />";
        $selcat = $titanium_db->sql_query("select catid, title from ".$titanium_prefix."_stories_cat");
        echo "<form action=\"".$admin_file.".php\" method=\"post\">";
        echo "<strong>"._SELECTNEWCAT.":</strong> ";
        echo "<select name=\"newcat\">";
        echo "<option name=\"newcat\" value=\"0\">"._ARTICLES."</option>";
    
	    while(list($newcat, $title) = $titanium_db->sql_fetchrow($selcat)) 
		{
          echo "<option name=\"newcat\" value=\"$newcat\">$title</option>";
        }
        
		echo "</select>";
        echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
        echo "<input type=\"hidden\" name=\"op\" value=\"NoMoveCategory\">";
        echo "<input type=\"submit\" value=\""._OK."\">";
        echo "</form>";
    } 
	else 
	{
        $resultm = $titanium_db->sql_query("select sid from ".$titanium_prefix."_stories where catid='$catid'");
    
	    while(list($sid) = $titanium_db->sql_fetchrow($resultm)) 
		{
          $sid = intval($sid);
          $titanium_db->sql_query("update ".$titanium_prefix."_stories set catid='$newcat' where sid='$sid'");
        }
        
		$titanium_db->sql_query("delete from ".$titanium_prefix."_stories_cat where catid='$catid'");

        echo ""._MOVEDONE."";
    }
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function SaveEditCategory($catid, $title) 
{
    global $titanium_prefix, $titanium_db, $admin_file;

    $title = str_replace("\"","",$title);
    $result = $titanium_db->sql_query("select catid from ".$titanium_prefix."_stories_cat where title='$title'");
    $catid = intval($catid);
    $check = $titanium_db->sql_numrows($result);

    if ($check) 
	{
        $what1 = _CATEXISTS;
        $what2 = _GOBACK;
    } 
	else 
	{
        $what1 = _CATSAVED;
        $what2 = "[ <a href=\"".$admin_file.".php\">"._GOTOADMIN."</a> ]";
        $result = $titanium_db->sql_query("update ".$titanium_prefix."_stories_cat set title='$title' where catid='$catid'");
    
	    if (!$result) 
        return;
    }
    
	include(NUKE_BASE_DIR.'header.php');
    
    OpenTable();
    
	echo "<div align=\"center\"><span class=\"title\"><strong>"._CATEGORIESADMIN."</strong></span></div><br />";
	echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

    echo "<div align=\"center\"><span class=\"content\"><strong>$what1</strong></span><br /><br />";
    echo "$what2</div>";
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function SaveCategory($title) 
{
    global $titanium_prefix, $titanium_db, $admin_file;

    $title = str_replace("\"","",$title);
    $result = $titanium_db->sql_query("select catid from ".$titanium_prefix."_stories_cat where title='$title'");
    $check = $titanium_db->sql_numrows($result);
 
    if ($check) 
	{
        $what1 = _CATEXISTS;
        $what2 = _GOBACK;
    } 
	else 
	{
        $what1 = _CATADDED;
        $what2 = _GOTOADMIN;
        $result = $titanium_db->sql_query("insert into ".$titanium_prefix."_stories_cat values (NULL, '$title', '0')");
    
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

function autodelete($anid) 
{
    global $titanium_prefix, $titanium_db, $admin_file;
    $anid = intval($anid);
    $titanium_db->sql_query("delete from ".$titanium_prefix."_autonews where anid='$anid'");
    redirect_titanium($admin_file.".php?op=adminStory");
}

function autoEdit($anid) 
{
    global $aid, $bgcolor1, $bgcolor2, $titanium_prefix, $titanium_db, $multilingual, $admin_file, $titanium_module_name;

    $sid = intval($sid);
    $aid = substr($aid, 0,25);

    list($aaid) = $titanium_db->sql_ufetchrow("SELECT aid from ".$titanium_prefix."_stories WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr($aaid, 0,25);

    if (is_mod_admin($titanium_module_name)) 
	{
      include(NUKE_BASE_DIR.'header.php');

      $result = $titanium_db->sql_query("SELECT 
	                            
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
								
								FROM ".$titanium_prefix."_autonews 
								
								WHERE anid='$anid'");
								
      list($catid, 
	         $aid, 
		   $title, 
		    $time, 
	    $modified, 
		$hometext, 
		$bodytext, 
		   $topic, 
	   $informant, 
	       $notes, 
		   $ihome, 
	   $alanguage, 
	       $acomm, 
	  $topic_icon, 
	      $writes) = $titanium_db->sql_fetchrow($result);

      $catid = intval($catid);
      $aid = substr($aid, 0,25);
      $informant = substr($informant, 0,25);
      $ihome = intval($ihome);
      $acomm = intval($acomm);
      $topic_icon = intval($topic_icon);
      $writes = intval($writes);
      
	  preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $time, $datetime);

      OpenTable();
	  
      echo "<div align=\"center\"><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></div><br />";
	  echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
	  echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div>";
      
	  $today = getdate();
      $tday = $today[mday];
      
	  if ($tday < 10)
      $tday = "0$tday";
      
	  $tmonth = $today[month];
      $tyear = $today[year];
      $thour = $today[hours];
      
	  if ($thour < 10)
      $thour = "0$thour";
      
	  $tmin = $today[minutes];
      
	  if ($tmin < 10)
      $tmin = "0$tmin";

      $tsec = $today[seconds];

      if ($tsec < 10)
      $tsec = "0$tsec";

      $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<div align=\"center\"><span class=\"option\"><strong>"._AUTOSTORYEDIT."</strong></span></div><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">";

    $title = stripslashes($title);
    $hometext = stripslashes($hometext);
    $bodytext = stripslashes($bodytext);
    $notes = stripslashes($notes);
    $result=$titanium_db->sql_query("select topicimage from ".$titanium_prefix."_topics where topicid='$topic'");

    list($topicimage) = $titanium_db->sql_fetchrow($result);
    
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
    
	$hometext_bb = evo_img_tag_to_resize($hometext_bb);
    $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);
    
	themepreview($subject, $hometext_bb, $bodytext_bb);
    
	echo "</td></tr></table></td></tr></table>"
        ."<br /><br /><strong>"._TITLE."</strong><br />"
        ."<input type=\"text\" name=\"title\" size=\"50\" value=\"$title\"><br /><br />"
        ."<strong>"._TOPIC."</strong> <select name=\"topic\">";
 
    $toplist = $titanium_db->sql_query("select topicid, topictext from ".$titanium_prefix."_topics order by topictext");
    
	echo "<option value=\"\">"._ALLTOPICS."</option>\n";
 
    while(list($topicid, $phpbb2_topics) = $titanium_db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
    
	    if ($topicid==$topic) 
        $sel = "selected "; 
	    
        echo "<option $sel value=\"$topicid\">$phpbb2_topics</option>\n";
        $sel = "";
    }
    
	echo "</select><br /><br />";
    $cat = $catid;
    
	SelectCategory($cat);
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
        
		$titanium_languages = lang_list();
        
		echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = count($titanium_languages); $i < $j; $i++) 
		{
            if ($titanium_languages[$i] != '') 
            echo '<option value="'.$titanium_languages[$i].'"'.(($alanguage == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
        }

        echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";

    echo "<br /><br /><strong>"._STORYTEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postnews');
    echo "<strong>"._EXTENDEDTEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postnews');
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
    <input type=\"hidden\" name=\"op\" value=\"autoSaveEdit\">
    <input type=\"submit\" value=\""._SAVECHANGES."\">
    </form>";
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');

        OpenTable();

        echo "<div align=\"center\"><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></div><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

        echo "<div align=\"center\"><strong>"._NOTAUTHORIZED1."</strong></div><br /><br />"
            .""._NOTAUTHORIZED2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    }
}

function autoSaveEdit($anid, $year, $day, $month, $hour, $min, $title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes) 
{
    global $aid, $ultramode, $titanium_prefix, $titanium_db, $admin_file, $titanium_module_name;

    $sid = intval($sid);
    $aid = substr($aid, 0,25);
	
    list($aaid) = $titanium_db->sql_ufetchrow("SELECT aid from ".$titanium_prefix."_stories WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr($aaid, 0,25);

    if (is_mod_admin($titanium_module_name)) 
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
    
	  $result = $titanium_db->sql_query("UPDATE ".$titanium_prefix."_autonews set 
	 
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
     
     redirect_titanium($admin_file.".php?op=adminStory");
    } 
   else 
	{
        include(NUKE_BASE_DIR.'header.php');
    
        OpenTable();

        echo "<div align=\"center\"><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></div><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
        echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";
   
        echo "<center><strong>"._NOTAUTHORIZED1."</strong><br /><br />"
            .""._NOTAUTHORIZED2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    }
}

function displayStory($qid) 
{
    global $titanium_user, $admin_file, $subject, $story, $bgcolor1, $bgcolor2, $anonymous, $titanium_user_prefix, $titanium_prefix, $titanium_db, $multilingual;

    include(NUKE_BASE_DIR.'header.php');

	$today = getdate();
    $tday = $today[mday];
    
	if ($tday < 10)
    $tday = "0$tday";
    
	$tmonth = $today[month];
    $ttmon = $today[mon];
    
	if ($ttmon < 10)
    $ttmon = "0$ttmon";
    
	$tyear = $today[year];
    $thour = $today[hours];
    
	if ($thour < 10)
    $thour = "0$thour";
    
	$tmin = $today[minutes];
    
	if ($tmin < 10)
    $tmin = "0$tmin";
    
	$tsec = $today[seconds];
    
	if ($tsec < 10)
    $tsec = "0$tsec";
    
	$date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    $qid = intval($qid);
    
	$result = $titanium_db->sql_query("SELECT qid, 
	                                 uid, 
								   uname, 
								 subject, 
								   story, 
								storyext, 
								   topic, 
							    alanguage 
								
								FROM ".$titanium_prefix."_queue 
								
								WHERE qid='$qid'");

    list($qid, $uid, $uname, $subject, $story, $storyext, $topic, $alanguage) = $titanium_db->sql_fetchrow($result);

    $qid = intval($qid);
    $uid = intval($uid);
    $subject = stripslashes($subject);
    $story = stripslashes($story);
    $storyext = stripslashes($storyext);

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    $storyext_bb = decode_bbcode(set_smilies(stripslashes($storyext)), 1, true);
    $story_bb = decode_bbcode(set_smilies(stripslashes($story)), 1, true);
    $storyext_bb = evo_img_tag_to_resize($storyext_bb);
    $story_bb = evo_img_tag_to_resize($story_bb);
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/

    OpenTable();
    
	echo "<div align=\"center\"><span class=\"title\"><strong>"._SUBMISSIONSADMIN."</strong></span></div><br />";
 	echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
 	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<font class=\"content\">"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
        ."<strong>"._NAME."</strong><br />"
        ."<input type=\"text\" NAME=\"author\" size=\"25\" value=\"$uname\">";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    if ($uname != $anonymous) 
	{
      $res = $titanium_db->sql_query("SELECT user_email from ".$titanium_user_prefix."_users WHERE username='$uname'");
      
	  list($email) = $titanium_db->sql_fetchrow($res);
      
	  echo "&nbsp;&nbsp;<span class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._EMAILUSER."</a> | <a href='modules.php?name=Your_Account&op=userinfo&username=$uname'>"._USERPROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</span>";
    }
    
	echo "<br /><br /><strong>"._TITLE."</strong><br />"
        ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br /><br />";
    
	if(empty($topic)) 
    $topic = 1;
    
	$result = $titanium_db->sql_query("select topicimage from ".$titanium_prefix."_topics where topicid='$topic'");

    list($topicimage) = $titanium_db->sql_fetchrow($result);

    echo "<table border=\"0\" width=\"70%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>"
        ."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor=\"$bgcolor1\"><tr><td>";

    if ($topic_icon == 0) 
    echo "<img src=\"images/Blog_Topics/$topicimage\" border=\"0\" align=\"right\" alt=\"\">";

    $storypre = "$story_bb<br /><br />$storyext_bb";

/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    themepreview($subject, $storypre);

    echo "</td></tr></table></td></tr></table>"
        ."<br /><strong>"._TOPIC."</strong> <select name=\"topic\">";

    $toplist = $titanium_db->sql_query("select topicid, topictext from ".$titanium_prefix."_topics order by topictext");

    echo "<option value=\"\">"._SELECTTOPIC."</option>\n";

    while(list($topicid, $phpbb2_topics) = $titanium_db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
        
		if ($topicid==$topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$phpbb2_topics</option>\n";
        $sel = "";
    }

    echo "</select>";
    echo "<br /><br />";
    echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
        ."<table border='1' cellspacing='3' cellpadding='8'><tr>";

    $sql = "SELECT topicid, topictext FROM ".$titanium_prefix."_topics ORDER BY topictext";
    $result = $titanium_db->sql_query($sql);
    $a = 0;
    
	while ($row = $titanium_db->sql_fetchrow($result)) 
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
    
	SelectCategory($cat);
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
        $titanium_languages = lang_list();

        echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = count($titanium_languages); $i < $j; $i++) 
		{
            if ($titanium_languages[$i] != '') 
            echo '<option value="'.$titanium_languages[$i].'"'.(($alanguage == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
        }
        
		echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";
    
	echo "<br /><br /><strong>"._STORYTEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $story, 'postnews');
    echo "<strong>"._EXTENDEDTEXT."</strong>";
    Make_TextArea('bodytext', $storyext, 'postnews');
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
    $year = $date[year];

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
        ."<option value=\"DeleteStory\">"._DELETESTORY."</option>"
        ."<option value=\"PreviewAgain\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostStory\">"._POSTSTORY."</option>"
        ."</select>"
        ."<input type=\"submit\" value=\""._OK."\">&nbsp;&nbsp;[ <a href=\"".$admin_file.".php?op=DeleteStory&qid=$qid\">"._DELETE."</a> ]";

        CloseTable();

    putpoll($pollTitle, $optionText);

    echo "</form>";

    include(NUKE_BASE_DIR.'footer.php');
}

function previewStory($automated, 
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
    global $titanium_user, $admin_file, $boxstuff, $anonymous, $bgcolor1, $bgcolor2, $titanium_user_prefix, $titanium_prefix, $titanium_db, $multilingual, $Version_Num;

    include(NUKE_BASE_DIR.'header.php');

    $today = getdate();
    $tday = $today[mday];
    
	if ($tday < 10)
    $tday = "0$tday";
    
	$tmonth = $today[month];
    $tyear = $today[year];
    $thour = $today[hours];
    
	if ($thour < 10)
    $thour = "0$thour";
    
	$tmin = $today[minutes];
    
	if ($tmin < 10)
    $tmin = "0$tmin";
    
	$tsec = $today[seconds];
    
	if ($tsec < 10)
    $tsec = "0$tsec";
    
	$date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    $subject = stripslashes($subject);
    $hometext = stripslashes($hometext);
    $bodytext = stripslashes($bodytext);
    $notes = stripslashes($notes);
    
	OpenTable();
	
    echo "<div align=\"center\"><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></div><br />";
	echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<font class=\"content\">"
        ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
        ."<strong>"._NAME."</strong><br />"
        ."<input type=\"text\" name=\"author\" size=\"25\" value=\"$author\">";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/

    if ($author != $anonymous) 
	{
        $res = $titanium_db->sql_query("select user_id, user_email from ".$titanium_user_prefix."_users where username='$author'");
        list($pm_userid, $email) = $titanium_db->sql_fetchrow($res);
        $pm_userid = intval($pm_userid);
        echo "&nbsp;&nbsp;<span class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._EMAILUSER."</a> | <a href='modules.php?name=Your_Account&op=userinfo&username=$author'>"._USERPROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</span>";
    }
    
	echo "<br /><br /><strong>"._TITLE."</strong><br />"
        ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br /><br />";

    $result = $titanium_db->sql_query("select topicimage from ".$titanium_prefix."_topics where topicid='$topic'");

    list($topicimage) = $titanium_db->sql_fetchrow($result);

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

    $hometext_bb = evo_img_tag_to_resize($hometext_bb);
    $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);

    themepreview($subject, $hometext_bb, $bodytext_bb, $notes);

    echo "</td></tr></table></td></tr></table>"
        ."<br /><strong>"._TOPIC."</strong> <select name=\"topic\">";
    
	$toplist = $titanium_db->sql_query("SELECT topicid, topictext FROM ".$titanium_prefix."_topics order by topictext");
    
	echo "<option value=\"\">"._ALLTOPICS."</option>\n";

    while(list($topicid, $phpbb2_topics) = $titanium_db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
    
	    if ($topicid==$topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$phpbb2_topics</option>\n";
        $sel = "";
    }
    
	echo "</select>";
    echo "<br /><br />";
    
    if($Version_Num >= 6.6) 
	{
        for ($i=0; $i<count($assotop); $i++) 
	    $associated .= "$assotop[$i]-"; 
    
	    $asso_t = explode("-", $associated);

        echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";

        $sql = "SELECT topicid, topictext FROM ".$titanium_prefix."_topics ORDER BY topictext";
        $result = $titanium_db->sql_query($sql);
        $a = 0;
    
	    while ($row = $titanium_db->sql_fetchrow($result)) 
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
    SelectCategory($cat);
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
        $titanium_languages = lang_list();
        echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = count($titanium_languages); $i < $j; $i++) 
		{
            if ($titanium_languages[$i] != '') 
            echo '<option value="'.$titanium_languages[$i].'"'.(($alanguage == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
        }
        echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"$titanium_language\">";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<br /><br /><strong>"._STORYTEXT."</strong>";


/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postnews');
    echo "<strong>"._EXTENDEDTEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postnews');
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
        ."<option value=\"DeleteStory\">"._DELETESTORY."</option>"
        ."<option value=\"PreviewAgain\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostStory\">"._POSTSTORY."</option>"
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
    global $aid, $admin_file, $ultramode, $titanium_prefix, $titanium_db, $titanium_user_prefix, $Version_Num, $blog_config, $adminmail, $sitename, $nukeurl, $cache;

    // Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_Num >= 6.6) 
	{ 
	   for ($i=0; $i<count($assotop); $i++) 
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
        $new_sql  = "INSERT INTO ".$titanium_prefix."_autonews values (NULL, 
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
		
        $result = $titanium_db->sql_query($new_sql);
        
		// Copyright (c) 2000-2005 by NukeScripts Network ??
        if (!$result) 
	    return; 
		
        $result = $titanium_db->sql_query("SELECT sid from ".$titanium_prefix."_stories WHERE title='$subject' order by time DESC limit 0,1");
        
		list($artid) = $titanium_db->sql_fetchrow($result);
        
		$artid = intval($artid);
        
		if ($uid != 1) 
		{
            $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET counter=counter+1 WHERE user_id='$uid'");
            
			// Copyright (c) 2000-2005 by NukeScripts Network
            if($blog_config["notifyauth"] == 1) 
			{
                $urow = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT username, user_email FROM ".$titanium_user_prefix."_users WHERE user_id='$uid'"));
                $Mto = $urow["username"]." <".$urow["user_email"].">";
                $Msubject = _NE_ARTPUB;
                $Mbody = _NE_HASPUB."\n$nukeurl/modules.php?name=Blog&file=article&sid=$artid";
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
        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
	    blog_ultramode(); 
        
		$qid = intval($qid);
        $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_queue WHERE qid='$qid'");

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('numwaits', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

        redirect_titanium($admin_file.".php?op=submissions");
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
        
		    if(!$titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_poll_desc VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$alanguage', '0')")) 
            return;
            
			$object = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT pollID FROM ".$titanium_prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
            $id = $object["pollID"];
            $id = intval($id);
            
			for($i = 1, $maxi = count($optionText); $i <= $maxi; $i++) 
			{
                if(!empty($optionText[$i])) 
                $optionText[$i] = Fix_Quotes($optionText[$i]);
                
				if(!$titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_poll_data (pollID, optionText, optionCount, voteID) VALUES ('$id', '$optionText[$i]', '0', '$i')")) 
                return;
            }
        } 
		else 
		{
            $haspoll = 0;
            $id = 0;
        }

        // Copyright (c) 2000-2005 by NukeScripts Network
        $new_sql  = "INSERT INTO ".$titanium_prefix."_stories VALUES (NULL, 
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
														 '$author', 
														  '$notes', 
														  '$ihome', 
													  '$alanguage', 
													      '$acomm', 
													    '$haspoll', 
													         '$id', 
															   '0', 
															   '0'";
        $new_sql .= ", '$associated'";
        $new_sql .= ",'$topic_id', '$writes')";
        $result = $titanium_db->sql_query($new_sql);
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        $result = $titanium_db->sql_query("SELECT sid from ".$titanium_prefix."_stories WHERE title='$subject' order by time DESC limit 0,1");
       
	    list($artid) = $titanium_db->sql_fetchrow($result);
       
	    $artid = intval($artid);
        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_poll_desc SET artid='$artid' WHERE pollID='$id'");
        
		if (!$result) 
	    return; 
       
		if ($uid != 1) 
		{
            $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET counter=counter+1 WHERE user_id='$uid'");
            
			// Copyright (c) 2000-2005 by NukeScripts Network
		    if($blog_config["notifyauth"] == 1) 
			{
                $urow = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT username, user_email FROM ".$titanium_user_prefix."_users WHERE user_id='$uid'"));
                $Mto = $urow["username"]." <".$urow["user_email"].">";
                $Msubject = _NE_ARTPUB;
                $Mbody = _NE_HASPUB."\n$nukeurl/modules.php?name=Blog&file=article&sid=$artid";
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
            $titanium_db->sql_query("UPDATE ".$titanium_user_prefix."_users SET counter=counter+1 WHERE user_id='$uid'");
        }
        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
	    blog_ultramode(); 
        
		deleteStory($qid);
    }
}

function editStory($sid) 
{
    global $titanium_user, $admin_file, $bgcolor1, $bgcolor2, $aid, $titanium_prefix, $titanium_db, $multilingual, $Version_Num, $titanium_module_name;

    $aid = substr($aid, 0,25);
    $sid = intval($sid);
    
	list($aaid) = $titanium_db->sql_ufetchrow("SELECT aid FROM ".$titanium_prefix."_stories WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr($aaid, 0,25);

    if (is_mod_admin($titanium_module_name)) 
	{
        include(NUKE_BASE_DIR.'header.php');
    
        $result = $titanium_db->sql_query("SELECT catid, 
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
	    FROM ".$titanium_prefix."_stories 
		WHERE sid='$sid'");
		
        list($catid, 
		   $subject, 
		  $hometext, 
		  $bodytext, 
		     $topic, 
			 $notes, 
			 $ihome, 
		 $alanguage, 
		     $acomm, 
		$topic_icon, 
		    $writes, 
			   $aid, 
		 $informant, 
		      $time,
		  $modified,  
			   $sid) = $titanium_db->sql_fetchrow($result);
        
		$catid = intval($catid);
        $subject = stripslashes($subject);
        $hometext = stripslashes($hometext);
        $bodytext = stripslashes($bodytext);
        $notes = stripslashes($notes);
        $ihome = intval($ihome);
        $acomm = intval($acomm);
        $aid = $aid;
        $topic_icon = intval($topic_icon);
        $writes = intval($writes);
        
		$result2=$titanium_db->sql_query("SELECT topicimage from ".$titanium_prefix."_topics WHERE topicid='$topic'");
        
		list($topicimage) = $titanium_db->sql_fetchrow($result2);
        
		OpenTable();

	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\"><strong>Admin - Edit Blog Module</strong></a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";
        echo "<div align=\"center\"><span class=\"option\"><strong>"._EDITARTICLE."</strong></span></div>";

/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
        $hometext_bb = decode_bbcode(set_smilies(stripslashes(nl2br($hometext))), 1, true);
        $bodytext_bb = decode_bbcode(set_smilies(stripslashes(nl2br($bodytext))), 1, true);
        $hometext_bb = evo_img_tag_to_resize($hometext_bb);
        $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);
        
		if($writes == 0) 
        define_once('WRITES', true);
        
		getTopics($sid);
        
		global $topicname, $topicimage, $topictext;
        
		if ($topic_icon != 0) 
        $topicimage = $topicname = $topictext = '';
        
		$informant = UsernameColor($informant);
        
		themearticle($aid, $informant, $time, $modified, $subject, $counter, $hometext_bb, $topic, $topicname, $topicimage, $topictext);
        
		echo "<br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
            ."<strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br /><br />"
            ."<strong>"._TOPIC."</strong> <select name=\"topic\">";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
        $toplist = $titanium_db->sql_query("select topicid, topictext from ".$titanium_prefix."_topics order by topictext");
        
		echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        
		while(list($topicid, $phpbb2_topics) = $titanium_db->sql_fetchrow($toplist)) 
		{
           $topicid = intval($topicid);
           
		   if ($topicid==$topic) 
		   $sel = "selected "; 
			
		  echo "<option $sel value=\"$topicid\">$phpbb2_topics</option>\n";
          $sel = "";
        }
        
		echo "</select>";
        echo "<br /><br />";
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        if($Version_Num >= 6.6) 
		{
            $asql = "SELECT associated FROM ".$titanium_prefix."_stories WHERE sid='$sid'";
            $aresult = $titanium_db->sql_query($asql);
            $arow = $titanium_db->sql_fetchrow($aresult);
            $asso_t = explode("-", $arow['associated']);
        
		    echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
                ."<table border='1' cellspacing='3' cellpadding='8'><tr>";
   
            $sql = "SELECT topicid, topictext FROM ".$titanium_prefix."_topics ORDER BY topictext";
            $result = $titanium_db->sql_query($sql);
            $a = 0;
        
		    while ($row = $titanium_db->sql_fetchrow($result)) 
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
        SelectCategory($cat);
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
   
            $titanium_languages = lang_list();
   
            echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
        
		    for ($i=0, $j = count($titanium_languages); $i < $j; $i++) 
			{
                if ($titanium_languages[$i] != '') 
                echo '<option value="'.$titanium_languages[$i].'"'.(($alanguage == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
            }
            
			echo '</select>';
        } 
		else 
        echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";

        echo "<br /><br /><strong>"._STORYTEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postnews');
    echo "<strong>"._EXTENDEDTEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postnews');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
 
        echo "<span class=\"content\">"._AREYOUSURE."</span><br /><br />"
            ."<strong>"._NOTES."</strong><br />"
            ."<textarea style=\"wrap:virtual\" cols=\"50\" rows=\"4\" name=\"notes\">$notes</textarea><br /><br />"
            ."<input type=\"hidden\" NAME=\"sid\" size=\"50\" value=\"$sid\">"
            ."<input type=\"hidden\" name=\"op\" value=\"ChangeStory\">"
            ."<input type=\"submit\" value=\""._SAVECHANGES."\">"
            ."</form>";
        CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');
        
        OpenTable();
        
		echo "<div align=\"center\"><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></div><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

        echo "<div align=\"center\"><strong>"._NOTAUTHORIZED1."</strong></div><br /><br />"
            .""._NOTAUTHORIZED2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    }
}

function removeStory($sid, $ok=0) 
{
    global $ultramode, $aid, $titanium_prefix, $titanium_db, $admin_file, $titanium_module_name;
    
	$sid = intval($sid);
    $aid = substr($aid, 0,25);
    
	list($aaid) = $titanium_db->sql_ufetchrow("SELECT aid from ".$titanium_prefix."_stories WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr($aaid, 0,25);

    if (is_mod_admin($titanium_module_name)) 
	{
        if($ok) 
		{
			list($counter) = $titanium_db->sql_ufetchrow("SELECT counter from ".$titanium_prefix."_authors WHERE aid='$aaid'", SQL_NUM);
            $counter--;
    
	        $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_stories WHERE sid='$sid'");
            $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_comments WHERE sid='$sid'");
            $titanium_db->sql_query("UPDATE ".$titanium_prefix."_poll_desc SET artid='0' where artid='$sid'");
           
		    $result = $titanium_db->sql_query("UPDATE ".$titanium_prefix."_authors SET counter='$counter' WHERE aid='$aaid'");
        
		    if ($ultramode) 
            blog_ultramode();

            redirect_titanium("modules.php?name=Blog");
        } 
		else 
		{
            include(NUKE_BASE_DIR.'header.php');
        
            OpenTable();
	
	        echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory&amp;sid=$sid\"><strong>Back To Current Blog</strong></a></div>";
	        echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

            echo "<div align=\"center\"><strong>"._REMOVESTORY." $sid "._ANDCOMMENTS."</strong>";
           	echo "<br /><br />[ <a href=\"".$admin_file.".php?op=adminStory\">"._NO."</a> | <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid&amp;ok=1\">"._YES."</a> ]</div>";
    
	        CloseTable();

            include(NUKE_BASE_DIR.'footer.php');
        }
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');

        OpenTable();
        
		echo "<div align=\"center\"><span class=\"title\"><strong>"._ARTICLEADMIN."</strong></span></div><br /><br />";
	    echo "<div align=\"center\"><a href=\"$admin_file.php?op=adminStory\">" . _NEWS_ADMIN_HEADER . "</a></div>";
	    echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";
        echo "<div align=\"center\"><strong>"._NOTAUTHORIZED1."</strong></div><br /><br />"
            .""._NOTAUTHORIZED2."<br /><br />"
            .""._GOBACK."";
        
		CloseTable();
        
		@include(NUKE_BASE_DIR.'footer.php');
    }
}

function changeStory($sid, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $assotop) 
{

    global $aid, $ultramode, $titanium_prefix, $titanium_db, $Version_Num, $admin_file, $titanium_module_name;
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($version_Num >= 6.6) 
	{ 
	  for ($i=0; $i<count($assotop); $i++) 
      $associated .= "$assotop[$i]-"; 
	}
    // Copyright (c) 2000-2005 by NukeScripts Network
    
	$sid = intval($sid);
    $aid = substr($aid, 0,25);
    
	list($aaid) = $titanium_db->sql_ufetchrow("SELECT aid from ".$titanium_prefix."_stories WHERE sid='$sid'", SQL_NUM);
    
	$aaid = substr($aaid, 0,25);
    
	if (is_mod_admin($titanium_module_name)) 
	{
        $subject = Fix_Quotes($subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        $topic = (empty($topic)) ? '1' : $topic;
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_stories SET catid='$catid', 
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
        
		$titanium_db->sql_query("UPDATE ".$titanium_prefix."_stories SET associated='$associated' WHERE sid='$sid'");
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        if ($ultramode) { blog_ultramode(); }
        redirect_titanium($admin_file.".php?op=adminStory");
    }
}

function lastTwenty()
{
    global $titanium_prefix, $titanium_db, $titanium_language, $multilingual, $Version_Num, $admin_file, $aid, $titanium_module_name, $bgcolor1;

    include(NUKE_BASE_DIR.'header.php');
/*****[BEGIN]******************************************
 [ Other:    Blogs Fix                          v1.0.0 ]
 ******************************************************/
    OpenTable();    
    
	echo "<div align=\"center\"><strong>Admin "._LAST." 100 "._ARTICLES."</strong></div>";
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=adminStory\"><strong>Add New Blog</strong></a></div><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";
    
	$result6 = $titanium_db->sql_query("SELECT sid, 
	                                  aid, 
									title, 
							datePublished, 
							 dateModified, 
							        topic, 
								informant, 
								alanguage 
							   
							   FROM ".$titanium_prefix."_stories 
							   
							   ORDER BY datePublished DESC LIMIT 0,100");
    
	echo "<div align=\"center\"><table border=\"1\" width=\"100%\">";
    
	while ($row6 = $titanium_db->sql_fetchrow($result6)) 
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
        $row7 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT topicname FROM ".$titanium_prefix."_topics WHERE topicid='$topic'"));
        $topicname = $row7["topicname"];
    
	    if (empty($alanguage)) 
        $alanguage = ""._ALL."";
        
		formatTimestamp($time);
        
		echo "<tr><td class=\"catHead\" align=\"right\"><strong>$sid</strong>" 
            ."</td><td class=\"row1\" width=\"65.3%\" align=\"left\" width=\"100%\"><img class=\"icons\" align=\"absmiddle\" width=\"16\" src=\"".img('topic-16.png','Blog_Topics')."\"> <a href=\"modules.php?name=Blog&amp;file=article&amp;sid=$sid\">$title</a>"
            ."</td><td class=\"catHead\" align=\"center\">$alanguage"
            ."</td><td class=\"row1\" align=\"right\">$topicname";
        
		if (is_mod_admin('Blog')) 
		{
            if ($aid == $said) 
			{
                echo "</td><td class=\"catHead\" width=\"5.3%\" align=\"right\" nowrap>(<a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a>)"
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

    if (is_mod_admin($titanium_module_name)) 
	{
      echo "<br /><div align=\"center\">"
          ."<form action=\"".$admin_file.".php\" method=\"post\">"
          .""._STORYID.": <input type=\"text\" NAME=\"sid\" SIZE=\"10\">"
          ."<select name=\"op\">"
          ."<option value=\"EditStory\" SELECTED>"._EDIT."</option>"
          ."<option value=\"RemoveStory\">"._DELETE."</option>"
          ."</select>"
          ."<input type=\"submit\" value=\""._GO."\">"
          ."</form></div><br />";
    }
    
	CloseTable();
    
	include(NUKE_BASE_DIR.'footer.php');
}

function programmedBlogs()
{
    global $titanium_prefix, $titanium_db, $titanium_language, $multilingual, $Version_Num, $admin_file, $aid, $titanium_module_name, $bgcolor1;
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
        $result5 = $titanium_db->sql_query("SELECT anid, 
		                                   aid, 
										 title, 
								 datePublished, 
									 alanguage 
									 
									FROM ".$titanium_prefix."_autonews $queryalang ORDER BY datePublished ASC");

        while (list($anid, $aid, $listtitle, $time, $alanguage) = $titanium_db->sql_fetchrow($result5)) 
		{
            $anid = intval($anid);
            $said = substr($aid, 0,25);
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
                
				$time = str_replace(" ", "@", $time);
                
				if (is_mod_admin('Blog')) 
				{
                    if ($aid == $said) 
                        echo "<tr><td nowrap>&nbsp;(<a href=\"".$admin_file.".php?op=autoEdit&amp;anid=$anid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=autoDelete&amp;anid=$anid\">"._DELETE."</a>)&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; 
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


function adminStory() 
{
    global $titanium_prefix, $titanium_db, $titanium_language, $multilingual, $Version_Num, $admin_file, $aid, $titanium_module_name, $bgcolor1;

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
        echo "<div align=\"center\"><span class=\"option\"><strong>"._ADDARTICLE."</strong></span></div><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
            ."<strong>"._TITLE."</strong><br />"
            ."<input type=\"text\" name=\"subject\" size=\"50\"><br /><br />"
            ."<strong>"._TOPIC."</strong> ";
/*****[END]********************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
    $toplist = $titanium_db->sql_query("SELECT topicid, topictext from ".$titanium_prefix."_topics ORDER by topictext");
    
	echo "<select name=\"topic\">";
    echo "<option value=\"\">"._SELECTTOPIC."</option>\n";
    
	while(list($topicid, $phpbb2_topics) = $titanium_db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
        
		if ($topicid == $topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$phpbb2_topics</option>\n";
        
		$sel = "";
    }
    echo "</select><br /><br />";
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_Num >= 6.6) 
	{
        echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";
        $sql = "SELECT topicid, topictext FROM ".$titanium_prefix."_topics ORDER BY topictext";
        $result = $titanium_db->sql_query($sql);
        $a = 0;
    
	    while ($row = $titanium_db->sql_fetchrow($result)) 
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
    }
    // Copyright (c) 2000-2005 by NukeScripts Network

    $cat = 0;
    SelectCategory($cat);
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

        $titanium_languages = lang_list();

        echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = count($titanium_languages); $i < $j; $i++) 
		{
            if ($titanium_languages[$i] != '') 
            echo '<option value="'.$titanium_languages[$i].'"'.(($alanguage == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
        }

        echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"$titanium_language\">";

    echo "<br /><br /><strong>"._STORYTEXT."</strong>";

/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', '', 'postnews');
    echo "<strong>"._EXTENDEDTEXT."</strong>";
    Make_TextArea('bodytext', '', 'postnews');
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
        ."<option value=\"PreviewAdminStory\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostAdminStory\">"._POSTSTORY."</option>"
        ."</select>"
        ."<input type=\"submit\" value=\""._OK."\">";

    CloseTable();

    putpoll('', '');

    echo "</form>";

    include(NUKE_BASE_DIR.'footer.php');
}

function previewAdminStory($automated, 
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
    global $titanium_user, $admin_file, $bgcolor1, $bgcolor2, $titanium_prefix, $titanium_db, $alanguage, $multilingual, $Version_Num;
    
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

	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=adminStory\"><strong>Preview Currrent Blog<strong></a></div>\n";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div>";

    echo "<form action=\"".$admin_file.".php\" method=\"post\" name=\"postnews\">"
        ."<input type=\"hidden\" name=\"catid\" value=\"$catid\">";

    $subject = stripslashes($subject);
    $subject = str_replace("\"", "''", $subject);
    $hometext = stripslashes($hometext);
    $bodytext = stripslashes($bodytext);
    $result=$titanium_db->sql_query("select topicimage, topicname, topictext  from ".$titanium_prefix."_topics where topicid='$topic'");

    list($topicimage, $topicname, $topictext) = $titanium_db->sql_fetchrow($result);

/*****[BEGIN]******************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
    $hometext_bb = decode_bbcode(set_smilies(stripslashes($hometext)), 1, true);
    $bodytext_bb = decode_bbcode(set_smilies(stripslashes($bodytext)), 1, true);
/*****[END]********************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/

    $hometext_bb = evo_img_tag_to_resize($hometext_bb);
    $bodytext_bb = evo_img_tag_to_resize($bodytext_bb);

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
    
	$toplist = $titanium_db->sql_query("SELECT topicid, topictext FROM ".$titanium_prefix."_topics ORDER by topictext");
    
	echo "<option value=\"\">"._ALLTOPICS."</option>\n";
    
	while(list($topicid, $phpbb2_topics) = $titanium_db->sql_fetchrow($toplist)) 
	{
        $topicid = intval($topicid);
    
	    if ($topicid==$topic) 
        $sel = "selected ";
        
		echo "<option $sel value=\"$topicid\">$phpbb2_topics</option>\n";
        $sel = "";
    }

    echo "</select><br /><br />";
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_num >= 6.6) 
	{
        for ($i=0; $i<count($assotop); $i++) 
		{ 
		  $associated .= "$assotop[$i]-"; 
		}
        
		$asso_t = explode("-", $associated);
        
		echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><strong>"._ASSOTOPIC."</strong></td><td width='100%'>"
            ."<table border='1' cellspacing='3' cellpadding='8'><tr>";

        $sql = "SELECT topicid, topictext FROM ".$titanium_prefix."_topics ORDER BY topictext";
        $result = $titanium_db->sql_query($sql);
        
		while ($row = $titanium_db->sql_fetchrow($result)) 
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
    SelectCategory($cat);
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
    
	    $titanium_languages = lang_list();
    
	    echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
    
	    for ($i=0, $j = count($titanium_languages); $i < $j; $i++) 
		{
            if ($titanium_languages[$i] != '') 
            echo '<option value="'.$titanium_languages[$i].'"'.(($alanguage == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
        }
        
		echo '</select>';
    } 
	else 
    echo "<input type=\"hidden\" name=\"alanguage\" value=\"$titanium_language\">";

    echo "<br /><br /><strong>"._STORYTEXT."</strong>";


/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'hometext,bodytext';
    Make_TextArea('hometext', $hometext, 'postnews');
    echo "<strong>"._EXTENDEDTEXT."</strong>";
    Make_TextArea('bodytext', $bodytext, 'postnews');
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
        ."<option value=\"PreviewAdminStory\" selected>"._PREVIEWSTORY."</option>"
        ."<option value=\"PostAdminStory\">"._POSTSTORY."</option>"
        ."</select>"
        ."<input type=\"submit\" value=\""._OK."\">";

    CloseTable();

    putpoll($pollTitle, $optionText);

    echo "</form>";
    include(NUKE_BASE_DIR.'footer.php');
}

function postAdminStory($automated, 
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
    global $ultramode, $aid, $titanium_prefix, $titanium_db, $Version_Num, $admin_file;
    
	// Copyright (c) 2000-2005 by NukeScripts Network
    if($Version_Num >= 6.6) 
	{ 
	  for ($i=0; $i<count($assotop); $i++) 
	  { 
	    $associated .= "$assotop[$i]-"; 
	  } 
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
        $subject = str_replace("\"", "''", $subject);
        $hometext = Fix_Quotes($hometext);
        $bodytext = Fix_Quotes($bodytext);
        $notes = Fix_Quotes($notes);
        
		// Copyright (c) 2000-2005 by NukeScripts Network
        $new_sql  = "INSERT INTO ".$titanium_prefix."_autonews values (NULL, 
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
        $result = $titanium_db->sql_query($new_sql);
        // Copyright (c) 2000-2005 by NukeScripts Network

        if (!$result) 
	    exit(); 
        
		$result = $titanium_db->sql_query("UPDATE ".$titanium_prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
        blog_ultramode();
        
		redirect_titanium($admin_file.".php?op=adminStory");
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

            if(!$titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_poll_desc VALUES (NULL, '$pollTitle', 
			                                                                    '$timeStamp', 
																				         '0', 
																				'$alanguage', 
																				         '0')")) 
                                                                                  return;
            
			$object = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT pollID FROM ".$titanium_prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
            
			$id = $object["pollID"];
            $id = intval($id);
            
			for($i = 1, $maxi = count($optionText); $i <= $maxi; $i++) 
			{
                if(!empty($optionText[$i])) 
                $optionText[$i] = Fix_Quotes($optionText[$i]);
                
				if(!$titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_poll_data (pollID, 
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
        $new_sql  = "INSERT INTO ".$titanium_prefix."_stories values (NULL, 
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
        $result = $titanium_db->sql_query($new_sql);
		
        // Copyright (c) 2000-2005 by NukeScripts Network

        $result = $titanium_db->sql_query("SELECT sid from ".$titanium_prefix."_stories WHERE title='$subject' ORDER by datePublished DESC limit 0,1");
        
		list($artid) = $titanium_db->sql_fetchrow($result);
        
		$artid = intval($artid);
        
		$titanium_db->sql_query("UPDATE ".$titanium_prefix."_poll_desc SET artid='$artid' WHERE pollID='$id'");
       
	    if (!$result) 
        exit();
        
		$result = $titanium_db->sql_query("UPDATE ".$titanium_prefix."_authors SET counter=counter+1 WHERE aid='$aid'");
        
		if ($ultramode) 
        blog_ultramode();
        
		redirect_titanium($admin_file.".php?op=adminStory");
    }
}

function submissions() 
{
    global $admin, $admin_file, $bgcolor1, $bgcolor2, $titanium_prefix, $titanium_db, $anonymous, $multilingual, $titanium_module_name;

    $dummy = 0;

    include(NUKE_BASE_DIR.'header.php');

    OpenTable();

	echo "<div align=\"center\"><a href=\"$admin_file.php?op=submissions\"><strong>Blog Submissions</strong></a></div>"; 
	echo "<div align=\"center\">[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

    $result = $titanium_db->sql_query("SELECT qid, uid, uname, subject, timestamp, alanguage FROM ".$titanium_prefix."_queue order by timestamp DESC");
        
		if($titanium_db->sql_numrows($result) == 0) 
            echo "<table width=\"100%\"><tr><td align=\"center\"><strong>"._NOSUBMISSIONS."</strong></td></tr></table>\n";
		else 
		{
            echo "<center><span class=\"content\"><strong>"._NEWSUBMISSIONS."</strong></span><form action=\"".$admin_file.".php\" method=\"post\"><table width=\"100%\" border=\"1\" bgcolor=\"$bgcolor2\"><tr><td><strong>&nbsp;"._TITLE."&nbsp;</strong></td>";
        
		    if ($multilingual == 1) 
            echo "<td><center><strong>&nbsp;"._LANGUAGE."&nbsp;</strong></center></td>";

            echo "<td><center><strong>&nbsp;"._AUTHOR."&nbsp;</strong></center></td><td><center><strong>&nbsp;"._DATE."&nbsp;</strong></center></td><td><center><strong>&nbsp;"._FUNCTIONS."&nbsp;</strong></center></td></tr>\n";
            
			while (list($qid, $uid, $uname, $subject, $timestamp, $alanguage) = $titanium_db->sql_fetchrow($result)) 
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
                echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayStory&amp;qid=$qid\">"._NOSUBJECT."</a></span>\n";
				else 
                echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayStory&amp;qid=$qid\">$subject</a></span>\n";
                
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
                
				$timestamp = explode(" ", $timestamp);
                echo "</td><td align=\"right\" nowrap><span class=\"content\">&nbsp;$timestamp[0]&nbsp;</span></td><td align=\"center\"><font class=\"content\">&nbsp;<a href=\"".$admin_file.".php?op=DeleteStory&amp;qid=$qid\">"._DELETE."</a>&nbsp;</td></tr>\n";
                $dummy++;
            }
            
			if ($dummy < 1) 
            echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\"><strong>"._NOSUBMISSIONS."</strong></form></td></tr></table>\n";
			else 
            echo "</table></form>\n";
        }
       
	      if (is_mod_admin($titanium_module_name)) 
		  {
             echo "<br /><center>"
            ."[ <a href=\"".$admin_file.".php?op=subdelete\">"._DELETE."</a> ]"
            ."</center><br />";
    }
    
	CloseTable();

    include(NUKE_BASE_DIR.'footer.php');
}

function subdelete() 
{
    global $titanium_prefix, $titanium_db, $admin_file, $cache;
    $titanium_db->sql_query("delete from ".$titanium_prefix."_queue");

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaits', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

    redirect_titanium($admin_file.".php?op=adminStory");
}

switch($op) 
{
    # Written by Ernest Allen Buffington 08/27/2019	
	case "LastTwenty":
	lastTwenty();
	break;
	# Written by Ernest Allen Buffington 08/27/2019	
	
	# Written by Ernest Allen Buffington 08/27/2019	
    case "ProgrammedBlogs":
	programmedBlogs();
	break;
	# Written by Ernest Allen Buffington 08/27/2019	
	
    case "EditCategory":
    EditCategory($catid);
    break;

    case "subdelete":
    subdelete();
    break;

    case "DelCategory":
    DelCategory($cat);
    break;

    case "YesDelCategory":
    YesDelCategory($catid);
    break;

    case "NoMoveCategory":
    NoMoveCategory($catid, $newcat);
    break;

    case "SaveEditCategory":
    SaveEditCategory($catid, $title);
    break;

    case "SelectCategory":
    SelectCategory($cat);
    break;

    case "AddCategory":
    AddCategory();
    break;

    case "SaveCategory":
    SaveCategory($title);
    break;

    case "DisplayStory":
    displayStory($qid);
    break;

    case "PreviewAgain":
    previewStory($automated, 
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

    case "PostStory":
    break;

    case "EditStory":
    editStory($sid);
    break;

    case "RemoveStory":
    removeStory($sid, $ok);
    break;

    case "ChangeStory":
    changeStory($sid, 
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

    case "DeleteStory":
    deleteStory($qid);
    break;

    case "adminStory":
    adminStory($sid);
    break;

    case "PreviewAdminStory":
    previewAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $pollTitle, $optionText, $assotop);
    break;

    case "PostAdminStory":
    postAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes, $pollTitle, $optionText, $assotop);
    break;

    case "autoDelete":
    autodelete($anid);
    break;

    case "autoEdit":
    autoEdit($anid);
    break;

    case "autoSaveEdit":
    autoSaveEdit($anid, $year, $day, $month, $hour, $min, $title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $topic_icon, $writes);
    break;

    case "submissions":
    submissions();
    break;

    case "NENewsConfig":
        $pagetitle = ": "._NE_NEWSCONFIG;
        
		include(NUKE_BASE_DIR.'header.php');
        
        $blog_config = blog_get_configs();

        OpenTable();
	    
		echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NENewsConfig\"><strong>Blogs Main Configuration</strong></a></div>";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _NEWS_RETURNMAIN . "</a> ]</div><br />";

        echo "<form action='".$admin_file.".php?op=NENewsConfigSave' method='post'>\n";
        echo "<center>\n<table border='0' cellpadding='2' cellspacing='2'>\n";

        echo "<tr>\n<td align='right'><strong>"._NE_DISPLAYTYPE.":</strong></td>\n<td><select name='xcolumns'>";
        
		if ($blog_config["columns"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._NE_SINGLE."</option>\n<option value='1'$ck2>"._NE_DUAL."</option>\n</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right'><strong>"._NE_READLINK.":</strong></td>\n<td><select name='xreadmore'>";
        
		if ($blog_config["readmore"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._NE_PAGE."</option>\n<option value='1'$ck2>"._NE_POPUP."</option>\n</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right'><strong>"._NE_TEXTTYPE.":</strong></td>\n<td><select name='xtexttype'>";
        
		if ($blog_config["texttype"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._NE_COMPLETE."</option>\n<option value='1'$ck2>"._NE_TRUNCATE."</option>\n</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right' valign='top'><strong>"._NE_NOTIFYAUTH.":</strong></td>\n<td><select name='xnotifyauth'>";
        
		if ($blog_config["notifyauth"] == 0) 
		{ 
		  $ck1 = " selected"; 
		  $ck2 = ""; 
		} 
		else 
		{ 
		  $ck1 = ""; 
		  $ck2 = " selected"; 
		}
        
		echo "<option value='0'$ck1>"._NE_NO."</option>\n<option value='1'$ck2>"._NE_YES."</option>\n</select><br />\n("._NE_NOTIFYAUTHNOTE.")</td>\n</tr>\n";

        echo "<tr>\n<td align='right'><strong>"._NE_HOMETOPIC.":</strong></td>\n<td><select name='xhometopic'>";
        echo "<option value='0'";
        
		if ($blog_config["hometopic"] == 0) 
		echo " selected"; 
        
		echo ">"._NE_ALLTOPICS."</option>\n";
        $result = $titanium_db->sql_query("SELECT topicid, topictext FROM ".$titanium_prefix."_topics ORDER BY topictext");
        
		while(list($topicid, $topicname) = $titanium_db->sql_fetchrow($result)) 
		{
            echo "<option value='$topicid'";
        
		    if ($blog_config["hometopic"] == $topicid) 
			echo " selected"; 
            
			echo">$topicname</option>\n";
        }
        
		echo "</select></td>\n</tr>\n";

        echo "<tr>\n<td align='right' valign='top'><strong>"._NE_HOMENUMBER.":</strong></td>\n<td><select name='xhomenumber'>\n";
        echo "<option value='0'";
        
		if ($blog_config["homenumber"] == 0) 
		echo " selected"; 
        
		echo ">"._NE_NUKEDEFAULT."</option>\n";
        $i = 1;
        
		while ($i <= 10) 
		{
            $k = $i * 5;
        
		    echo "<option value='$k'";
        
		    if ($blog_config["homenumber"] == $k) 
			echo " selected"; 
        
		    echo">$k "._NE_ARTICLES."</option>\n";
            $i++;
        }
        
		echo "</select><br />\n("._NE_HOMENUMNOTE.")</td>\n</tr>\n";

        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._NE_SAVECHANGES."'></td></tr>";
        echo "</table>\n</center>\n</form>\n";
        
		CloseTable();
        
		include(NUKE_BASE_DIR.'footer.php');
    break;

    case "NENewsConfigSave":
        blogs_save_config('columns', $xcolumns);
        blogs_save_config('readmore', $xreadmore);
        blogs_save_config('texttype', $xtexttype);
        blogs_save_config('notifyauth', $xnotifyauth);
        blogs_save_config('homenumber', $xhomenumber);
        blogs_save_config('hometopic', $xhometopic);

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        global $cache;
        $cache->delete('news', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

        redirect_titanium($admin_file.".php?op=NENewsConfig");
    break;
  }
} 
else 
DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$titanium_module_name\"");
?>

