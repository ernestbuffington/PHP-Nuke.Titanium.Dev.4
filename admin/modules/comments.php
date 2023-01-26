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
if (!defined('ADMIN_FILE')) 
die ("Illegal File Access");

global $prefix, $db;

if (is_mod_admin()) 
{
/*********************************************************/
/* Comments Delete Function                              */
/*********************************************************/

/* Thanks to Oleg [Dark Pastor] Martos from http://www.rolemancer.ru */
/* to code the comments childs deletion function!                    */
function removeSubComments($tid) 
{
    global $prefix, $db;

    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid from ".$prefix."_blogs_comments where pid='$tid'");
    $numrows = $db->sql_numrows($result);

    if($numrows>0) 
	{
	    while ($row = $db->sql_fetchrow($result)) 
	    {
            $stid = intval($row['tid']);
            removeSubComments($stid);
            $stid = intval($stid);
            $db->sql_query("delete from ".$prefix."_blogs_comments where tid='$stid'");
        }
    }
    
	$db->sql_query("delete from ".$prefix."_blogs_comments where tid='$tid'");
}

function removeComment ($tid, $sid, $ok=0) 
{
    global $ultramode, $prefix, $db, $admin_file;

    if($ok) 
	{
        $tid = intval($tid);
		
        $result = $db->sql_query("SELECT datePublished from ".$prefix."_blogs_comments WHERE pid='$tid'");
        
		$numresults = $db->sql_numrows($result);
        
		$sid = intval($sid);
        
		$db->sql_query("UPDATE ".$prefix."_blogs SET comments=comments-1-'$numresults' where sid='$sid'");
        
		removeSubComments($tid);
    
	    if ($ultramode) 
        blog_ultramode();
        
		redirect("modules.php?name=Blogs&file=article&sid=$sid");
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');
     
	    GraphicAdmin();
     
	    title( _REMOVECOMMENTS);
     
	    OpenTable();
        echo "<div align=\"center\">" . _SURETODELCOMMENTS;
        echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid&amp;ok=1\">" . _YES . "</a> ]</div>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }
}

function removePollSubComments($tid) 
{
    global $prefix, $db;

    $tid = intval($tid);
    $result = $db->sql_query("SELECT tid from ".$prefix."_pollcomments where pid='$tid'");
    $numrows = $db->sql_numrows($result);

    if($numrows>0) 
	{
        while ($row = $db->sql_fetchrow($result)) 
		{
            $stid = intval($row['tid']);
            removePollSubComments($stid);
            $db->sql_query("delete from ".$prefix."_pollcomments where tid='$stid'");
        }
    }
    
	$db->sql_query("delete from ".$prefix."_pollcomments where tid='$tid'");
}

function RemovePollComment ($tid, $pollID, $ok=0) 
{
    global $admin_file;

    if($ok) 
	{
        removePollSubComments($tid);
        redirect("modules.php?name=Surveys&op=results&pollID=$pollID");
    } 
	else 
	{
        include(NUKE_BASE_DIR.'header.php');
        GraphicAdmin();
        title("<div align=\"center\"><span class=\"title\"><strong>" . _REMOVECOMMENTS . "</strong></span></div>");
        OpenTable();
        echo "<div align=\"center\">"._SURETODELCOMMENTS."";
        echo "<br /><br />[ <a href=\"javascript:history.go(-1)\">"._NO."</a> | <a href=\"".$admin_file.".php?op=RemovePollComment&amp;tid=$tid&amp;pollID=$pollID&amp;ok=1\">"._YES."</a> ]</div>";
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
    }
}

    switch($op) 
    {
       case "RemoveComment":
	   if(!isset($ok))
	   $ok = '';
       removeComment ($tid, $sid, $ok);
       break;
       case "removeSubComments":
       removeSubComments($tid);
       break;
       case "removePollSubComments":
       removePollSubComments($tid);
       break;
       case "RemovePollComment":
       RemovePollComment($tid, $pollID, $ok);
       break;
    }

} 
else 
echo "Access Denied";
?>