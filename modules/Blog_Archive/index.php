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
/* Version 1.0b                                                         */
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

$titanium_module_name = basename(dirname(__FILE__));
get_lang($titanium_module_name);

function select_month() 
{
    global $titanium_prefix, $titanium_user_prefix, $titanium_db, $titanium_module_name;

    include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.' '._STORIESARCHIVE);
    OpenTable();
    
	echo '<div align="center"><span class="title"><strong>'._STORIESARCHIVE.'</strong></span><br /><br /></div>';
	echo '<div align="center"><span class="content">'._SELECTMONTH2VIEW.'</span><br /><br /></div><br /><br />';
    
	$result = $titanium_db->sql_query("SELECT datePublished FROM ".$titanium_prefix."_stories ORDER BY datePublished DESC");
    
	echo "<ul>";

    $thismonth = '';
    
	while(list($time) = $titanium_db->sql_fetchrow($result)) 
	{
        preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/i", $time, $getdate);

        if ($getdate[2] == "01") 
		{ 
		   $month = _JANUARY; 
		} 
		elseif ($getdate[2] == "02") 
		{ 
		   $month = _FEBRUARY; 
		} 
		elseif ($getdate[2] == "03") 
		{ 
		   $month = _MARCH; 
		} 
		elseif ($getdate[2] == "04") 
		{ 
		   $month = _APRIL; 
		} 
		elseif ($getdate[2] == "05") 
		{ 
		   $month = _MAY; 
		} 
		elseif ($getdate[2] == "06") 
		{ 
		   $month = _JUNE; 
		} 
		elseif ($getdate[2] == "07") 
		{ 
		   $month = _JULY; 
		} 
		elseif ($getdate[2] == "08") 
		{ 
		   $month = _AUGUST; 
		} 
		elseif ($getdate[2] == "09") 
		{ 
		   $month = _SEPTEMBER; 
		} 
		elseif ($getdate[2] == "10") 
		{ 
		   $month = _OCTOBER; 
		} 
		elseif ($getdate[2] == "11") 
		{ 
		   $month = _NOVEMBER; 
		} 
		elseif ($getdate[2] == "12") 
		{ 
		   $month = _DECEMBER; 
		}

        if ($month != $thismonth) 
		{
            $year = $getdate[1];
        
		    echo "<img align=\"absmiddle\" width=\"20\" src=\"".img('calender-icon.png','Blog_Archive')."\"> <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a><br />";
        
		    $thismonth = $month;
        }
    }
    $titanium_db->sql_freeresult($result);
    
	echo "</ul>"
    ."<br /><br /><br /><div align=\"center\">"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\"> "
    ."<input type=\"submit\" value=\""._SEARCH."\">"
    ."</form><br /><br />"
    ."[ <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_all\">"._SHOWALLSTORIES."</a> ]</div><br />";
    
	CloseTable();
    
	include_once(NUKE_BASE_DIR.'footer.php');
}

function show_month($year, $month, $month_l) 
{
    global $userinfo, $titanium_prefix, $titanium_user_prefix, $titanium_db, $bgcolor1, $bgcolor2, $titanium_user, $cookie, $sitename, $multilingual, $titanium_language, $titanium_module_name, $articlecomm;
    
	$year = intval($year);
    $month = htmlentities($month);
    $month_l = htmlentities($month_l);

    include_once(NUKE_BASE_DIR.'header.php');
    
	title($sitename.' '._STORIESARCHIVE);
    
	$month_title = "$sitename: $month_l $year";
	
	$r_options = '';
    
	if(is_user()) 
	{
      if (isset($userinfo['umode'])) 
	  { 
	    $r_options .= "&amp;mode=".$userinfo['umode']; 
	  }
      
	  if (isset($userinfo['uorder'])) 
	  { 
	    $r_options .= "&amp;order=".$userinfo['uorder']; 
	  }
      
	  if (isset($userinfo['thold'])) 
	  { 
	    $r_options .= "&amp;thold=".$userinfo['thold']; 
	  }
    }
    
	OpenTable();

    echo '<div align="center"><strong>'._STORIESARCHIVE.'</strong></div>';    
	echo '<div align="center"><strong>'.$month_title.'</strong></div><br />';    
	
	echo "<table border=\"0\" width=\"100%\"><tr>"
		."<td bgcolor=\"$bgcolor2\" align=\"left\"><strong>"._ARTICLES."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._COMMENTS."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._READS."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._USCORE."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._DATE."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ACTIONS."</strong></td></tr>";
    
	$result = $titanium_db->sql_query("SELECT sid, 
	                               catid, 
								   title, 
						   datePublished, 
						    dateModified, 
							    comments, 
								 counter, 
								   topic, 
							   alanguage, 
							       score, 
								 ratings 
	FROM ".$titanium_prefix."_stories 
	WHERE datePublished >= '$year-$month-01 00:00:00' AND datePublished <= '$year-$month-31 23:59:59' ORDER BY sid DESC");
    
	while ($row = $titanium_db->sql_fetchrow($result)) 
	{
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = stripslashes(check_html($row['title'], "nohtml"));
		
        $time = $row['datePublished'];
		$modified = $row['dateModified'];
        
		$comments = stripslashes($row['comments']);
        $counter = intval($row['counter']);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $time = explode(" ", $time);
        
		$actions = "<a href=\"modules.php?name=Blog&amp;file=print&amp;sid=$sid\"><i class=\"fa fa-print\"></i></a>&nbsp;<a href=\"modules.php?name=Blog&amp;file=friend&amp;op=FriendSend&amp;sid=$sid\"><i class=\"fa fa-envelope\"></i></a>";
        
		if ($score != 0) 
		{
            $rated = substr($score / $ratings, 0, 4);
        } 
		else 
		{
            $rated = 0;
        }
        
		if ($catid == 0) 
		{
            $title = "<a href=\"modules.php?name=Blog&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        } 
		elseif ($catid != 0) 
		{
            $row_res = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT title FROM ".$titanium_prefix."_stories_cat WHERE catid='$catid'"));
            $cat_title = $row_res['title'];
            $title = "<a href=\"modules.php?name=Blog&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><i>$cat_title</i></a>: <a href=\"modules.php?name=Blog&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        }
        
		if ($multilingual == 1)
		 {
            if (empty($alanguage)) 
			{
			  $alanguage = $titanium_language;
            }

            $alt_language = ucfirst($alanguage);
            //$titanium_lang_img = "<img src=\"images/language/flag-$alanguage.png\" border=\"0\" hspace=\"2\" alt=\"$alt_language\" title=\"$alt_language\">";
            $titanium_lang_img = 'Language: '.$alanguage.' -';
        } 
		else 
		{
            $titanium_lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        
		if ($articlecomm == 0) 
		{
            $comments = 0;
        }
        
		echo "<tr>"
            ."<td bgcolor=\"$bgcolor1\" align=\"left\">$titanium_lang_img $title</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$comments</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$counter</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$rated</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$time[0]</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$actions</td></tr>";
    }
    $titanium_db->sql_freeresult($result);
    
	echo "</table>"
    ."<br /><br /><br /><hr size=\"1\" noshade>"
    ."<span class=\"content\">"._SELECTMONTH2VIEW."</span><br /><br />";
    
	$result2 = $titanium_db->sql_query("SELECT datePublished FROM ".$titanium_prefix."_stories ORDER BY datePublished DESC");
    
	echo "<ul>";
    
	$thismonth = '';
    
	while($row2 = $titanium_db->sql_fetchrow($result2)) 
	{
        $time = $row2['datePublished'];
        
		preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/i", $time, $getdate);
    
	    if ($getdate[2] == "01") 
		{ 
		   $month = _JANUARY; 
		} 
		elseif ($getdate[2] == "02") 
		{ 
		   $month = _FEBRUARY; 
		} 
		elseif ($getdate[2] == "03") 
		{ 
		   $month = _MARCH; 
		} 
		elseif ($getdate[2] == "04") 
		{ 
		   $month = _APRIL; 
		} 
		elseif ($getdate[2] == "05") 
		{ 
		   $month = _MAY; 
		} 
		elseif ($getdate[2] == "06") 
		{ 
		   $month = _JUNE; 
		} 
		elseif ($getdate[2] == "07") 
		{ 
		   $month = _JULY; 
		} 
		elseif ($getdate[2] == "08") 
		{ 
		   $month = _AUGUST; 
		} 
		elseif ($getdate[2] == "09") 
		{ 
		   $month = _SEPTEMBER; 
		} 
		elseif ($getdate[2] == "10") 
		{ 
		   $month = _OCTOBER; 
		} 
		elseif ($getdate[2] == "11") 
		{ 
		   $month = _NOVEMBER; 
		} 
		elseif ($getdate[2] == "12") 
		{ 
		   $month = _DECEMBER; 
		}
    
	    if ($month != $thismonth) 
		{
            $year = $getdate[1];
            echo "<img align=\"absmiddle\" width=\"20\" src=\"".img('calender-icon.png','Blog_Archive')."\"> <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a><br />";
            $thismonth = $month;
        }
    }
    $titanium_db->sql_freeresult($result2);
    
	echo "</ul><br /><br /><div align=\"center\">"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\"> "
    ."<input type=\"submit\" value=\""._SEARCH."\">"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$titanium_module_name\">"._ARCHIVESINDEX."</a> | <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_all\">"._SHOWALLSTORIES."</a> ]</div><br />";
    
	CloseTable();
    
	include_once(NUKE_BASE_DIR.'footer.php');
}

function show_all($min) 
{
    global $titanium_prefix, $titanium_user_prefix, $titanium_db, $bgcolor1, $bgcolor2, $titanium_user, $cookie, $sitename, $multilingual, $titanium_language, $titanium_module_name, $userinfo;

    if (!isset($min) || (!is_numeric($min) || ((int)$min) != $min)) 
	{
        $min = 0;
    }
    else 
	$min = (int)($min);
    $max = 250;
    
	include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.' '._STORIESARCHIVE);

	//title(_STORIESARCHIVE);
    //title($sitename.': '._ALLSTORIESARCH);
    
	$showall_title = $sitename.': '._ALLSTORIESARCH;    
	
	$r_options = '';
    
	if(is_user()) 
	{
      if (isset($userinfo['umode'])) 
	  { 
	     $r_options .= "&amp;mode=".$userinfo['umode']; 
	  }
      
	  if (isset($userinfo['uorder'])) 
	  { 
	     $r_options .= "&amp;order=".$userinfo['uorder']; 
	  }
      
	  if (isset($userinfo['thold'])) 
	  { 
	     $r_options .= "&amp;thold=".$userinfo['thold']; 
	  }
    }
    
	OpenTable();
    
    echo '<div align="center"><strong>'._STORIESARCHIVE.'</strong></div>';    
	echo '<div align="center"><strong>'.$showall_title.'</strong></div><br />';    
	
	echo "<table border=\"0\" width=\"100%\"><tr>"
    ."<td bgcolor=\"$bgcolor2\" align=\"left\"><strong>"._ARTICLES."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._COMMENTS."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._READS."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._USCORE."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._DATE."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ACTIONS."</strong></td></tr>";
    
	$result = $titanium_db->sql_query("SELECT sid, catid, title, datePublished, dateModified, comments, counter, topic, alanguage, score, ratings FROM ".$titanium_prefix."_stories ORDER BY sid DESC LIMIT $min,$max");
    
	$numrows = $titanium_db->sql_numrows($titanium_db->sql_query("select * FROM ".$titanium_prefix."_stories"));
    
	while($row = $titanium_db->sql_fetchrow($result)) 
	{
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = stripslashes(check_html($row['title'], "nohtml"));
		
        $time = $row['datePublished'];
		$modified = $row['dateModified'];
        
		$comments = stripslashes($row['comments']);
        $counter = intval($row['counter']);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $time = explode(" ", $time);
        $actions = "<a href=\"modules.php?name=Blog&amp;file=print&amp;sid=$sid\"><i class=\"fa fa-print\"></i></a>&nbsp;<a href=\"modules.php?name=Blog&amp;file=friend&amp;op=FriendSend&amp;sid=$sid\"><i class=\"fa fa-envelope\"></i></a>";

	    if ($score != 0) 
		{
            $rated = substr($score / $ratings, 0, 4);
        } 
		else 
		{
            $rated = 0;
        }
        
		if ($catid == 0) 
		{
            $title = "<a href=\"modules.php?name=Blog&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        } 
		elseif ($catid != 0) 
		{
            $row_res = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT title FROM ".$titanium_prefix."_stories_cat WHERE catid='$catid'"));
            $cat_title = stripslashes($row_res['title']);
            $title = "<a href=\"modules.php?name=Blog&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><i>$cat_title</i></a>: <a href=\"modules.php?name=Blog&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        }
        
		if ($multilingual == 1) 
		{
            if (empty($alanguage)) 
			{
                $alanguage = $titanium_language;
            }
            
            $alt_language = ucfirst($alanguage);
            //$titanium_lang_img = "<img src=\"images/language/flag-$alanguage.png\" border=\"0\" hspace=\"2\" alt=\"$alt_language\" title=\"$alt_language\">";
            $titanium_lang_img = 'Language: '.$alanguage.' -';
            
        } 
		else 
		{
            $titanium_lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        
		echo "<tr>"
        ."<td bgcolor=\"$bgcolor1\" align=\"left\">$titanium_lang_img $title</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$comments</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$counter</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$rated</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$time[0]</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$actions</td></tr>";
    }
    $titanium_db->sql_freeresult($result);
    
	echo "</table>"
    ."<br /><br /><br />";
    $a = 0;
    if (($numrows > 250) && ($min == 0)) 
	{
        $min = $min+250;
        $a++;
        echo "<div align=\"center\">[ <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</div><br />";
    }
    
	if (($numrows > 250) && ($min >= 250) && ($a != 1)) 
	{
        $pmin = $min-250;
        $min = $min+250;
        $a++;
        echo "<div align=\"center\">[ <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> | <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</div><br />";
    }
    
	if (($numrows <= 250) && ($a != 1) && ($min != 0)) 
	{
        $pmin = $min-250;
        echo "<div align=\"center\">[ <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> ]</div><br />";
    }
    
	echo "<hr size=\"1\" noshade>"
    ."<span class=\"content\">"._SELECTMONTH2VIEW."</span><br /><br />";
   
    $result2 = $titanium_db->sql_query("SELECT datePublished FROM ".$titanium_prefix."_stories ORDER BY datePublished DESC");
   
    echo "<ul>";
   
    $thismonth = "";
   
    while(list($time) = $titanium_db->sql_fetchrow($result)) 
	{
        preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/i", $time, $getdate);
    
	    if ($getdate[2] == "01") 
		{ 
		   $month = _JANUARY; 
		} 
		elseif ($getdate[2] == "02") 
		{ 
		   $month = _FEBRUARY; 
		} 
		elseif ($getdate[2] == "03") 
		{ 
		   $month = _MARCH; 
		} 
		elseif ($getdate[2] == "04") 
		{ 
		   $month = _APRIL; 
		} 
		elseif ($getdate[2] == "05") 
		{ 
		   $month = _MAY; 
		} 
		elseif ($getdate[2] == "06") 
		{ 
		   $month = _JUNE; 
		} 
		elseif ($getdate[2] == "07") 
		{ 
		   $month = _JULY; 
		} 
		elseif ($getdate[2] == "08") 
		{ 
		   $month = _AUGUST; 
		} 
		elseif ($getdate[2] == "09") 
		{ 
		   $month = _SEPTEMBER; 
		} 
		elseif ($getdate[2] == "10") 
		{ 
		   $month = _OCTOBER; 
		} 
		elseif ($getdate[2] == "11") 
		{ 
		   $month = _NOVEMBER; 
		} 
		elseif ($getdate[2] == "12") 
		{ 
		   $month = _DECEMBER; 
		}
        
		if ($month != $thismonth) 
		{
            $year = $getdate[1];
            echo "<img align=\"absmiddle\" width=\"20\" src=\"".img('calender-icon.png','Blog_Archive')."\"> <a href=\"modules.php?name=$titanium_module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a><br />";
            $thismonth = $month;
        }
    }
    $titanium_db->sql_freeresult($result2);
    
	echo "</ul><br /><br /><div align=\"center\">"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\"> "
    ."<input type=\"submit\" value=\""._SEARCH."\">"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$titanium_module_name\">"._ARCHIVESINDEX."</a> ]</div><br />";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$sa = isset($sa) ? $sa : '';
$min = isset($min) ? intval($min) : 0;
$year = isset($year) ? intval($year) : 0;
$month = isset($month) ? intval($month) : 0;
$month_l = isset($month_l)? Fix_Quotes($month_l) : "";

switch($sa) 
{
    case "show_all":
        show_all($min);
    break;
    case "show_month":
        show_month($year, $month, $month_l);
    break;
    default:
        select_month();
    break;
}
?>
