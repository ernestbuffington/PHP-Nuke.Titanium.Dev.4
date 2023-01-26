<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Patched                         v4.0.3       01/25/2023

-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * LongArrayToShortArrayRector
 * AddDefaultValueForUndefinedVariableRector (https://github.com/vimeo/psalm/blob/29b70442b11e3e6611
 * TernaryToNullCoalescingRector
 * ListToArrayDestructRector (https://wiki.php.net/rfc/short_list_syntax https://www.php.net/manual/
 * NullCoalescingOperatorRector (https://wiki.php.net/rfc/null_coalesce_equal_operator)
 * ChangeSwitchToMatchRector (https://wiki.php.net/rfc/match_expression_v2)
 * NullToStrictStringFuncCallArgRector  
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(__DIR__);
get_lang($module_name);

function select_month() 
{
    $month = null;
    global $prefix, $user_prefix, $db, $module_name;

    include_once(NUKE_BASE_DIR.'header.php');

    OpenTable();
    
	echo '<div align="center"><span class="title"><strong>'._BLOGS_ARCHIVE.'</strong></span><br /><br /></div>';
	echo '<div align="center"><span class="content">'._SELECTMONTH2VIEW.'</span><br /><br /></div><br /><br />';
    
	$result = $db->sql_query("SELECT datePublished FROM ".$prefix."_blogs ORDER BY datePublished DESC");
    
	echo "<ul>";

    $thismonth = '';
    
	while([$time] = $db->sql_fetchrow($result)) 
	{
        preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/i", (string) $time, $getdate);

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
        
		    echo "<img align=\"absmiddle\" width=\"20\" src=\"".img('calender-icon.png','Blog_Archive')."\"> <a 
			href=\"modules.php?name=$module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a><br />";
        
		    $thismonth = $month;
        }
    }
    $db->sql_freeresult($result);
    
	echo "</ul>"
    ."<br /><br /><br /><div align=\"center\">"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\"> "
    ."<input type=\"submit\" value=\""._SEARCH."\">"
    ."</form><br /><br />"
    ."[ <a href=\"modules.php?name=$module_name&amp;sa=show_all\">"._SHOW_ALL_BLOGS."</a> ]</div><br />";
    
	CloseTable();
    
	include_once(NUKE_BASE_DIR.'footer.php');
}

function show_month($year, $month, $month_l) 
{
    global $userinfo, $prefix, $user_prefix, $db, $bgcolor1, $bgcolor2, $user, $cookie, $sitename, $multilingual, $language, $module_name, $articlecomm;
    
	$year = intval($year);
    $month = htmlentities((string) $month);
    $month_l = htmlentities((string) $month_l);

    include_once(NUKE_BASE_DIR.'header.php');
    
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

    echo '<div align="center"><strong>'._BLOGS_ARCHIVE.'</strong></div>';    
	echo '<div align="center"><strong>'.$month_title.'</strong></div><br />';    
	
	echo "<table border=\"0\" width=\"100%\"><tr>"
		."<td bgcolor=\"$bgcolor2\" align=\"left\"><strong>"._BLOGS."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._COMMENTS."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._READS."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._USCORE."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._DATE."</strong></td>"
        ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ACTIONS."</strong></td></tr>";
    
	$result = $db->sql_query("SELECT sid, 
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
	FROM ".$prefix."_blogs 
	WHERE datePublished >= '$year-$month-01 00:00:00' AND datePublished <= '$year-$month-31 23:59:59' ORDER BY sid DESC");
    
	while ($row = $db->sql_fetchrow($result)) 
	{
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = stripslashes((string) check_html($row['title'], "nohtml"));
		
        $time = $row['datePublished'];
		$modified = $row['dateModified'];
        
		$comments = stripslashes((string) $row['comments']);
        $counter = intval($row['counter']);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $time = explode(" ", (string) $time);
        
		$actions = "<a href=\"modules.php?name=Blogs&amp;file=print&amp;sid=$sid\"><i class=\"fa fa-print\"></i></a>&nbsp;<a 
		href=\"modules.php?name=Blogs&amp;file=friend&amp;op=FriendSend&amp;sid=$sid\"><i class=\"fa fa-envelope\"></i></a>";
        
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
            $title = "<a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        } 
		elseif ($catid != 0) 
		{
            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_blogs_cat WHERE catid='$catid'"));
            $cat_title = $row_res['title'];
            $title = "<a href=\"modules.php?name=Blogs&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><i>$cat_title</i></a>: <a 
			href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        }
        
		if ($multilingual == 1)
		 {
            if (empty($alanguage)) 
			{
			  $alanguage = $language;
            }

            $alt_language = ucfirst((string) $alanguage);
            $lang_img = 'Language: '.$alanguage.' -';
        } 
		else 
		{
            $lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        
		if ($articlecomm == 0) 
		{
            $comments = 0;
        }
        
		echo "<tr>"
            ."<td bgcolor=\"$bgcolor1\" align=\"left\">$lang_img $title</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$comments</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$counter</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$rated</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$time[0]</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$actions</td></tr>";
    }
    $db->sql_freeresult($result);
    
	echo "</table>"
    ."<br /><br /><br /><hr size=\"1\" noshade>"
    ."<span class=\"content\">"._SELECTMONTH2VIEW."</span><br /><br />";
    
	$result2 = $db->sql_query("SELECT datePublished FROM ".$prefix."_blogs ORDER BY datePublished DESC");
    
	echo "<ul>";
    
	$thismonth = '';
    
	while($row2 = $db->sql_fetchrow($result2)) 
	{
        $time = $row2['datePublished'];
        
		preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/i", (string) $time, $getdate);
    
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
            
			echo "<img align=\"absmiddle\" width=\"20\" src=\"".img('calender-icon.png','Blog_Archive')."\"> <a 
			href=\"modules.php?name=$module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a><br />";
            
			$thismonth = $month;
        }
    }
    $db->sql_freeresult($result2);
    
	echo "</ul><br /><br /><div align=\"center\">"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\"> "
    ."<input type=\"submit\" value=\""._SEARCH."\">"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name\">"._BLOGS_INDEX."</a> | <a href=\"modules.php?name=$module_name&amp;sa=show_all\">"._SHOW_ALL_BLOGS."</a> ]</div><br />";
    
	CloseTable();
    
	include_once(NUKE_BASE_DIR.'footer.php');
}

function show_all($min) 
{
    $month = null;
    global $prefix, $user_prefix, $db, $bgcolor1, $bgcolor2, $user, $cookie, $sitename, $multilingual, $language, $module_name, $userinfo;

    if (!isset($min) || (!is_numeric($min) || ((int)$min) != $min)) 
	{
        $min = 0;
    }
    else 
	$min = (int)($min);
    $max = 250;
    
	include_once(NUKE_BASE_DIR.'header.php');
    
	$showall_title = $sitename.': '._ALL_BLOGS_SEARCH;    
	
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
    
    echo '<div align="center"><strong>'._BLOGS_ARCHIVE.'</strong></div>';    
	echo '<div align="center"><strong>'.$showall_title.'</strong></div><br />';    
	
	echo "<table border=\"0\" width=\"100%\"><tr>"
    ."<td bgcolor=\"$bgcolor2\" align=\"left\"><strong>"._BLOGS."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._COMMENTS."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._READS."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._USCORE."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._DATE."</strong></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._ACTIONS."</strong></td></tr>";
    
	$result = $db->sql_query("SELECT sid, catid, title, datePublished, dateModified, comments, counter, topic, alanguage, score, ratings FROM ".$prefix."_blogs ORDER BY sid DESC LIMIT $min,$max");
    
	$numrows = $db->sql_numrows($db->sql_query("select * FROM ".$prefix."_blogs"));
    
	while($row = $db->sql_fetchrow($result)) 
	{
        $sid = intval($row['sid']);
        $catid = intval($row['catid']);
        $title = stripslashes((string) check_html($row['title'], "nohtml"));
		
        $time = $row['datePublished'];
		$modified = $row['dateModified'];
        
		$comments = stripslashes((string) $row['comments']);
        $counter = intval($row['counter']);
        $topic = intval($row['topic']);
        $alanguage = $row['alanguage'];
        $score = intval($row['score']);
        $ratings = intval($row['ratings']);
        $time = explode(" ", (string) $time);
        $actions = "<a href=\"modules.php?name=Blogs&amp;file=print&amp;sid=$sid\"><i class=\"fa fa-print\"></i></a>&nbsp;<a 
		href=\"modules.php?name=Blogs&amp;file=friend&amp;op=FriendSend&amp;sid=$sid\"><i class=\"fa fa-envelope\"></i></a>";

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
            $title = "<a href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        } 
		elseif ($catid != 0) 
		{
            $row_res = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_blogs_cat WHERE catid='$catid'"));
            $cat_title = stripslashes((string) $row_res['title']);
            $title = "<a href=\"modules.php?name=Blogs&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><i>$cat_title</i></a>: <a 
			href=\"modules.php?name=Blogs&amp;file=article&amp;sid=$sid$r_options\">$title</a>";
        }
        
		if ($multilingual == 1) 
		{
            if (empty($alanguage)) 
			{
                $alanguage = $language;
            }
            
            $alt_language = ucfirst((string) $alanguage);
            $lang_img = 'Language: '.$alanguage.' -';
            
        } 
		else 
		{
            $lang_img = "<strong><big><strong>&middot;</strong></big></strong>";
        }
        
		echo "<tr>"
        ."<td bgcolor=\"$bgcolor1\" align=\"left\">$lang_img $title</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$comments</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$counter</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$rated</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$time[0]</td>"
        ."<td bgcolor=\"$bgcolor1\" align=\"center\">$actions</td></tr>";
    }
    $db->sql_freeresult($result);
    
	echo "</table>"
    ."<br /><br /><br />";
    $a = 0;
    if (($numrows > 250) && ($min == 0)) 
	{
        $min = $min+250;
        $a++;
        echo "<div align=\"center\">[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</div><br />";
    }
    
	if (($numrows > 250) && ($min >= 250) && ($a != 1)) 
	{
        $pmin = $min-250;
        $min = $min+250;
        $a++;
        echo "<div align=\"center\">[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> | <a 
		href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$min\">"._NEXTPAGE."</a> ]</div><br />";
    }
    
	if (($numrows <= 250) && ($a != 1) && ($min != 0)) 
	{
        $pmin = $min-250;
        echo "<div align=\"center\">[ <a href=\"modules.php?name=$module_name&amp;sa=show_all&amp;min=$pmin\">"._PREVIOUSPAGE."</a> ]</div><br />";
    }
    
	echo "<hr size=\"1\" noshade>"
    ."<span class=\"content\">"._SELECTMONTH2VIEW."</span><br /><br />";
   
    $result2 = $db->sql_query("SELECT datePublished FROM ".$prefix."_blogs ORDER BY datePublished DESC");
   
    echo "<ul>";
   
    $thismonth = "";
   
    while([$time] = $db->sql_fetchrow($result)) 
	{
        preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/i", (string) $time, $getdate);
    
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
            
			echo "<img align=\"absmiddle\" width=\"20\" src=\"".img('calender-icon.png','Blog_Archive')."\"> <a 
			href=\"modules.php?name=$module_name&amp;sa=show_month&amp;year=$year&amp;month=$getdate[2]&amp;month_l=$month\">$month, $year</a><br />";
            
			$thismonth = $month;
        }
    }
    $db->sql_freeresult($result2);
    
	echo "</ul><br /><br /><div align=\"center\">"
    ."<form action=\"modules.php?name=Search\" method=\"post\">"
    ."<input type=\"text\" name=\"query\" size=\"30\"> "
    ."<input type=\"submit\" value=\""._SEARCH."\">"
    ."</form><br />"
    ."[ <a href=\"modules.php?name=$module_name\">"._BLOGS_INDEX."</a> ]</div><br />";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

$sa ??= '';
$min = isset($min) ? intval($min) : 0;
$year = isset($year) ? intval($year) : 0;
$month = isset($month) ? intval($month) : 0;
$month_l = isset($month_l)? Fix_Quotes($month_l) : "";

match ($sa) {
    "show_all" => show_all($min),
    "show_month" => show_month($year, $month, $month_l),
    default => select_month(),
};

